<?php


/**
 * View Client transactional Histroy
 * Methods():
 *   index: View all transactional record
 *   view: view particular transactional record
 *   delete_transaction : Delete transactional record
 *
 **/
class All_transaction extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('action');
        $this->load->model('retrieve');
    }

    public function index()
    {
        $this->data['meta_title']   = 'All Transaction';
        $this->data['active']       = 'data-target="client_menu"'; // sale_menu
        $this->data['subMenu']      = 'data-target="all-transaction"';
        $this->data['confirmation'] = $this->data['transactionInfo'] = null;

        // get all godowns
        $this->data['allGodowns'] = getAllGodown();
        $this->data['customer_type'] = get_result('parties',['trash' => 0 ,'status' => 'active','type' => 'client'],['customer_type'],'customer_type');
        // Get all client branch wise
        $this->data['clientInfo'] = $this->getAllClient();


        // get all transaction and search
        $where = [
            "partytransaction.trash"          => 0,
            "partytransaction.transaction_by" => 'client'
        ];

        if (isset($_POST['show'])){

            if (!empty($_POST['search'])){
                foreach ($this->input->post('search') as $key => $value) {
                    if (!empty($value)) {
                        if($key == 'customer_type'){
                            $where["parties.$key"] = $value;
                        }else{
                            $where["partytransaction.$key"] = $value;
                        }    
                    }
                }
            }

            if (!empty($_POST['godown_code'])) {
                if ($_POST['godown_code'] != 'all') {
                    $where['partytransaction.godown_code'] = $_POST['godown_code'];
                }
            } else {
                $where['partytransaction.godown_code'] = $this->data['branch'];
            }

            if (!empty($_POST['date'])) {
                foreach ($_POST['date'] as $key => $value) {
                    if (!empty($value)) {
                        if ($key == "from") {
                            $where["partytransaction.transaction_at >="] = $value;
                        }
                        if ($key == "to") {
                            $where["partytransaction.transaction_at <="] = $value;
                        }
                    }
                }
            }


        } else {
            $where['partytransaction.transaction_at'] = date('Y-m-d');
            $where['partytransaction.godown_code']    = $this->data['branch'];
        }

        $select                        = ['partytransaction.id', 'partytransaction.transaction_at', 'partytransaction.inc_code', 'partytransaction.party_code', 'partytransaction.transaction_via', 'partytransaction.credit','partytransaction.debit', 'parties.name'];
        $this->data['transactionInfo'] = get_join('partytransaction', 'parties', 'parties.code=partytransaction.party_code', $where, $select, '', 'partytransaction.id', 'desc');

        $this->load->view($this->data['privilege'] . '/includes/header', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/aside', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/headermenu', $this->data);
        $this->load->view('components/client/nav', $this->data);
        //$this->load->view('components/sale/nav', $this->data);
        $this->load->view('components/client/allTransaction', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/footer');
    }


    public function view($id = null)
    {
        $this->data['meta_title']   = 'Voucher';
        $this->data['active']       = 'data-target="client_menu"'; // sale_menu
        $this->data['subMenu']      = 'data-target="all-transaction"';
        $this->data['confirmation'] = $this->data['transactionInfo'] = null;

        // Get transactions Info
        $select                = ['partytransaction.inc_code', 'partytransaction.transaction_at', 'partytransaction.id', 'partytransaction.party_code', 'partytransaction.remission', 'partytransaction.credit','partytransaction.debit', 'partytransaction.adjustment', 'partytransaction.transaction_via', 'partytransaction.comment', 'parties.name', 'parties.customer_type', 'parties.mobile', 'parties.address', 'parties.initial_balance'];
        $this->data['records'] = $info = get_row_join("partytransaction", 'parties', 'parties.code=partytransaction.party_code', ["partytransaction.id" => $id], $select);


        $tranInfo         = custom_query("SELECT SUM(credit + remission) AS credit, SUM(debit) AS debit, SUM(adjustment) AS adjustment FROM partytransaction WHERE id < '$id'  AND party_code='$info->party_code' AND trash=0", true);
        $credit           = (!empty($tranInfo->credit) ? $tranInfo->credit : 0);
        $debit            = (!empty($tranInfo->debit) ? $tranInfo->debit : 0);
        $adjustment       = (!empty($tranInfo->adjustment) ? $tranInfo->adjustment : 0);
        $previous_balance = $info->initial_balance + $debit - ($credit + $adjustment);

        $this->data['previousBalance'] = $previous_balance;

        $this->load->view($this->data['privilege'] . '/includes/header', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/aside', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/headermenu', $this->data);
        $this->load->view('components/client/nav', $this->data);
        //$this->load->view('components/sale/nav', $this->data);
        $this->load->view('components/client/view', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/footer');
    }


    /**
     * delete transaction info
     * table : partytransaction
     * Strategy : update coloumn trash 0 to 1 by column id
     *
     */
    public function delete_transaction($id)
    {

        $transactionInfo = get_row('partytransaction', ['id' => $id], ['transaction_type', 'credit', 'remission', 'relation']);

        if ($transactionInfo->transaction_type == 'installment') {
            // get saprecords
            $sapRecordsInfo = get_row('saprecords', ['voucher_no' => $transactionInfo->relation], ['paid', 'hire_price']);

            $paid = $sapRecordsInfo->paid - ($transactionInfo->credit + $transactionInfo->remission);

            //calculate due
            $sapRecordsData = [
                'due'  => $sapRecordsInfo->hire_price - $paid,
                'paid' => $paid
            ];

            // update saprecords due
            $this->action->update('saprecords', $sapRecordsData, ['voucher_no' => $transactionInfo->relation]);
        }


        $where          = array("id" => $id);
        $data           = array('trash' => 1);
        $transactionRec = $this->action->update('partytransaction', $data, $where);
        $msg            = array(
            "title" => "Deleted",
            "emit"  => "Transaction Successfully Deleted",
            "btn"   => true
        );
        $this->session->set_flashdata('confirmation', message("danger", $msg));

        redirect('client/all_transaction', 'refresh');
    }


    // get all clients
    private function getAllClient()
    {
        $clientWhere = [
            "type"   => "client",
            "trash"  => 0,
            "status" => "active"
        ];

        if ($this->data['privilege'] != 'super') {
            $clientWhere["godown_code"] = $this->data['branch'];
        }

        $result = get_result('parties', $clientWhere, ['code', 'name', 'mobile']);
        return $result;
    }


    public function client_info_godown_wise()
    {
        $godown_code = $this->input->post('godown_code');
        if ($godown_code == 'all') {
            $Parties = $this->action->read('parties', array('trash' => 0, 'type' => 'client'));
        } else {
            $Parties = $this->action->read('parties', array('trash' => 0, 'godown_code' => $godown_code, 'type' => 'client'));
        }

        if (!empty($Parties)) {
            echo '<option value="">Select Client</option>';
            foreach ($Parties as $val) {
                echo '<option value="' . $val->code . '" >' . $val->code . '-' . $val->name . '-' . $val->mobile . '</option>';
            }

        }
    }


}
