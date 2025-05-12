<?php

class Client_profit extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->model('action');

        $this->data['meta_title'] = 'Report';
        $this->data['active']     = 'data-target="report-menu"';
    }

    public function index()
    {
        $this->data['meta_title'] = 'Profit Report';
        $this->data['active']     = 'data-target="report_menu"';
        $this->data['subMenu']    = 'data-target="client_profit"';
        $this->data['resultInfo'] = null;


        // show result
        $this->data['resultInfo'] = $this->search();
        //$this->data['result'] = get_result('sapitems', $where);
        $this->load->view($this->data['privilege'] . '/includes/header', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/aside', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/headermenu', $this->data);
        // $this->load->view('components/report/profit_nav', $this->data);
        $this->load->view('components/report/client_profit', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/footer', $this->data);
    }

    private function search()
    {

        $where = ['status' => 'sale', 'trash' => 0];
        $where_cost = [];
        if (isset($_POST['show'])) {

            if (isset($_POST['search'])) {
                foreach ($_POST['search'] as $key => $value) {
                    if (!empty($value)) {
                        $where[$key] = $value;
                        $where_cost[$key] = $value;
                        $where_cost[$key] = $value;
                        
                    }
                }
            }

            if (!empty($_POST['godown_code'])) {
                if ($_POST['godown_code'] != 'all') {
                    $where['godown_code'] = $_POST['godown_code'];
                    $where_cost['godown_code'] = $_POST['godown_code'];
                }
            } else {
                $where['godown_code'] = $this->data['branch'];
                $where_cost['godown_code'] = $_POST['godown_code'];
            }

            if (isset($_POST['date'])) {
                foreach ($_POST['date'] as $key => $value) {
                    if (!empty($value) && $key == "from") {
                        $where['sap_at >='] = $value;
                        $where_cost['date >='] = $value;
                    }

                    if (!empty($value) && $key == "to") {
                        $where['sap_at <='] = $value;
                        $where_cost['date <='] = $value;
                    }
                }
            }
        } else {
            $where["godown_code"] = $this->data['branch'];
            $where['sap_at']      = date('Y-m-d');
            $where_cost['date']   = date('Y-m-d');
        }

        
        $data   = [];
        $result = $this->action->read('sapitems',$where);
        if (!empty($result)) {
            foreach ($result as $_key => $item) {


                //$purchase_price       = custom_query("SELECT SUM(purchase_price * quantity) AS total_purchase_price FROM sapitems WHERE voucher_no='$item->voucher_no' AND status='sale' AND trash=0 GROUP BY voucher_no");
                //$total_purchase_price = (!empty($purchase_price) ? $purchase_price[0]->total_purchase_price : 0);

                $data[$_key]['sap_at']          = $item->sap_at;
                $data[$_key]['voucher_no']      = $item->voucher_no;
                $data[$_key]['product_model']   = $item->product_model;
                $data[$_key]['quantity']        = $item->quantity;
                $data[$_key]['purchase_price']  = $item->purchase_price;
                $data[$_key]['sale_price']      = $item->sale_price;
                $data[$_key]['discount']        = $item->discount;
                
                $total = ($data[$_key]['sale_price'] - $data[$_key]['purchase_price'])*$data[$_key]['quantity'] - $data[$_key]['discount'];

                if ($total < 0) {
                    $data[$_key]['profit'] = 0;
                    $data[$_key]['loss']   = abs($total);
                } else {
                    $data[$_key]['profit'] = $total;
                    $data[$_key]['loss']   = 0;
                }
                
               
                //$data[$_key]['party_code'] = $item->party_code;

                /*if ($item->sap_type == 'credit' || $item->sap_type == 'dealer') {
                    $partyInfo              = get_row('parties', ['code' => $item->party_code, 'trash' => 0], ['name', 'address']);
                    $data[$_key]['name']    = (!empty($partyInfo) ? check_null($partyInfo->name) : 'N/A');
                    $data[$_key]['address'] = (!empty($partyInfo) ? check_null($partyInfo->address) : 'N/A');
                } else {
                    $partyInfo              = json_decode($item->address, true);
                    $data[$_key]['name']    = check_null($item->party_code);
                    $data[$_key]['address'] = (!empty($partyInfo) ? check_null($partyInfo['address']) : 'N/A');
                }

                $data[$_key]['total_quantity']       = $item->total_quantity;
                $data[$_key]['total_purchase_price'] = $total_purchase_price;

                if ($item->sap_type == 'credit') {
                    $data[$_key]['total_sale_price'] = $item->hire_price;
                } elseif ($item->sap_type == 'dealer') {
                    $data[$_key]['total_sale_price'] = $item->total_bill;
                } else {
                    $data[$_key]['total_sale_price'] = $item->total_bill;
                }

                $data[$_key]['total_discount'] = $item->total_discount;
                */
               
            }
        }

        return $data;
    }
}
