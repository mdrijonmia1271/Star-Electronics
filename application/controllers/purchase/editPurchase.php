<?php

class EditPurchase extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->model('action');
    }

    public function index()
    {
        $this->data['meta_title']   = 'Purchase';
        $this->data['active']       = 'data-target="purchase_menu"';
        $this->data['subMenu']      = 'data-target="all"';
        $this->data['confirmation'] = null;
        $this->data['info']         = null;

        // get all vendors
        $this->data['allParty'] = $this->getAllparty();

        // get all products
        $this->data['allProducts'] = $this->getAllProduct();


        if (!empty($_GET['vno'])) {
            $this->data['info'] = get_row_join('saprecords', 'parties', 'saprecords.party_code=parties.code', ['saprecords.voucher_no' => $_GET['vno'], 'saprecords.trash' => 0], ['saprecords.*', 'parties.name', 'parties.mobile', 'parties.address']);
        }

        if (isset($_POST['save'])) {
            $this->session->set_flashdata('confirmation', $this->edit());
            redirect("purchase/editPurchase?vno=" . $this->input->get('vno'), "refresh");
        }

        $this->load->view($this->data['privilege'] . '/includes/header', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/aside', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/headermenu', $this->data);
        $this->load->view('components/purchase/nav', $this->data);
        $this->load->view('components/purchase/edit', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/footer');
    }

    private function edit()
    {
        // update purchase record
        $total_quantity = 0;
        foreach ($_POST['product_name'] as $key => $value) {

            $data = $where = [];

            // calculate total quantity
            $total_quantity += $_POST['quantity'][$key];

            // set data
            $data['sap_at']              = $this->input->post('date');
            $data['purchase_commission'] = $_POST['purchase_commission'][$key];
            $data['purchase_price']      = $_POST['purchase_price'][$key];
            $data['sale_price']          = $_POST['sale_price'][$key];
            $data['quantity']            = $_POST['quantity'][$key];

            if (!empty($_POST['id'][$key])) {

                $where['id'] = $_POST['id'][$key];

            } else {

                $data['voucher_no']    = $this->input->post('voucher_no');
                $data['product_code']  = $_POST['product_code'][$key];
                $data['product_model'] = $_POST['product_model'][$key];
                $data['unit']          = $_POST['unit'][$key];
                $data['godown_code']   = $_POST['godown_code'];
                $data['status']        = 'purchase';
            }
            

            // save and update sapitems
            save_data('sapitems', $data, $where);

            // update and insert stock
            $this->handelStock($key);
        }

        // update bill record
        $previous_balance = ($_POST['previous_sign'] == 'Receivable' ? $_POST['previous_balance'] : - $_POST['previous_balance']);

        $data = [
            'sap_at'         => $this->input->post('date'),
            'change_at'      => date('Y-m-d'),
            'total_quantity' => $total_quantity,
            'total_bill'     => $this->input->post('grand_total'),
            'total_discount' => $this->input->post('total_discount'),
            'party_balance'  => $previous_balance,
            'paid'           => $this->input->post('paid')    
        ];

        $where  = [
            'voucher_no' => $this->input->get('vno'), 
            'trash' => 0
        ];
        
        save_data('saprecords', $data, $where);

        $this->handelPartyTransaction();

        $options = array(
            'title' => 'Updated',
            'emit'  => 'Purchase successfully changed!',
            'btn'   => true
        );

        return message('success', $options);
    }

    private function handelStock($index)
    {
        // get stock info
        $where = $data = [];

        $where['code']        = $_POST['product_code'][$index];
        $where['godown_code'] = $_POST['godown_code'];
        
        
        // get stock info
        $stockInfo = get_row('stock', $where, 'quantity');

        if (!empty($stockInfo)) {

            // calculate quantity
            $newQuantity = $_POST['quantity'][$index] - $_POST['old_quantity'][$index];
            $quantity    = $stockInfo->quantity + $newQuantity;

            $data = [
                'purchase_price' => $_POST['purchase_price'][$index],
                'sell_price'     => $_POST['sale_price'][$index],
                'quantity'       => $quantity,
            ];

        } else {

            $where = [];

            $data = [
                'code'           => $_POST['product_code'][$index],
                'product_model'  => $_POST['product_model'][$index],
                'name'           => $_POST['product_name'][$index],
                'category'       => $_POST['product_cat'][$index],
                'subcategory'    => $_POST['subcategory'][$index],
                'quantity'       => $_POST['quantity'][$index],
                'purchase_price' => $_POST['purchase_price'][$index],
                'sell_price'     => $_POST['sale_price'][$index],
                'godown_code'    => $_POST['godown_code'],
                'unit'           => $_POST['unit'][$index],
            ];
        }

        save_data('stock', $data, $where);
    }

    private function handelPartyTransaction()
    {
        $previous_balance = ($_POST['previous_sign'] == 'Receivable' ? +$_POST['previous_balance'] : -$_POST['previous_balance']);
        $current_balance  = ($_POST['current_sign'] == 'Receivable' ? +$_POST['current_balance'] : -$_POST['current_balance']);

        $data = [
            'transaction_at'   => $this->input->post('date'),
            'change_at'        => date('Y-m-d'),
            'credit'           => $this->input->post('grand_total'),
            'debit'            => $this->input->post('paid'),
            'previous_balance' => $previous_balance,
            'current_balance'  => $current_balance,
        ];
        
        $where = [
            'relation' => 'purchase:' . $this->input->post('voucher_no'),
            'trash' => 0
        ];

        save_data('partytransaction', $data, $where);

        return true;
    }

    private function getAllparty()
    {
        $where = array(
            "type"   => "supplier",
            "status" => "active",
            "trash"  => 0
        );
        $party = $this->action->read("parties", $where);
        return $party;
    }

    private function getAllProduct()
    {
        $result = get_result("products", ["status" => "available"], ['product_code', 'product_name', 'product_model']);
        return $result;
    }
}
