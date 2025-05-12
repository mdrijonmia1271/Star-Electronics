<?php

class Due_list extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('action');
    }

    /**
     * Fetch all voucher which has due
     * @return [type] Data array
     */
    public function index()
    {
        $this->data['meta_title'] = 'Cash Client Due';
        $this->data['active']     = 'data-target="due_list_menu"';
        $this->data['subMenu']    = 'data-target="cash"';
        $this->data['result']     = null;

        // get all godowns
        $this->data['allGodowns'] = getAllGodown();

        $where = ['trash' => 0, "sap_type" => "cash", "due_status" => "due"];

        if (isset($_POST['show'])) {

            if (!empty($_POST['client'])) {
                $where = ['party_code' => $this->input->post('client')];
            }

            if (!empty($_POST['godown_code'])) {
                if ($_POST['godown_code'] != 'all') {
                    $where['godown_code'] = $_POST['godown_code'];
                }
            } else {
                $where['godown_code'] = $this->data['branch'];
            }
            
            
            if(!empty($_POST['dateFrom'])){
                
                $dateFrom  = explode('-', $_POST['dateFrom']);
                
                $where['YEAR(sap_at) >='] = $dateFrom[0];
                $where['Month(sap_at) >='] = $dateFrom[1];
            }
            
            if(!empty($_POST['dateTo'])){
                
                $dateTo  = explode('-', $_POST['dateTo']);
                
                $where['YEAR(sap_at) <='] = $dateTo[0];
                $where['Month(sap_at) <='] = $dateTo[1];
            }

        } else {

            $where['godown_code'] = $this->data['branch'];
        }


        $allVoucher = get_result('saprecords', $where);

        foreach ($allVoucher as $key => $value) {

            //read info from due_collection table
            $due_paid = $due = 0;
            $dueInfo  = get_result('due_collect', ['voucher_no' => $value->voucher_no], "SUM(paid + remission) AS totalPaid");


            $due_paid   = (!empty($dueInfo) ? $dueInfo[0]->totalPaid : 0);
            $total_paid = $value->paid + $due_paid;
            $due        = ($value->total_bill - $total_paid);

            $this->data['result'][$key]['voucher_no']   = $value->voucher_no;
            $this->data['result'][$key]['party_code']   = $value->party_code;
            $this->data['result'][$key]['address']      = $value->address;
            $this->data['result'][$key]['total_bill']   = $value->total_bill;
            $this->data['result'][$key]['paid']         = $total_paid;
            $this->data['result'][$key]['due']          = $due;
            $this->data['result'][$key]['sap_at']       = $value->sap_at;
            $this->data['result'][$key]['promise_date'] = $value->promise_date;

        }

        //print_r($this->data['allVoucher']);

        $this->load->view($this->data['privilege'] . '/includes/header', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/aside', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/headermenu', $this->data);
        $this->load->view('components/due_list/nav', $this->data);
        $this->load->view('components/due_list/client', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/footer');
    }

    public function retail_due_collection()
    {
        $this->data['meta_title'] = 'Cash Client Due';
        $this->data['active']     = 'data-target="due_list_menu"';
        $this->data['subMenu']    = 'data-target="retail_due_collection"';
        $this->data['result']     = null;

        // get all godowns
        $this->data['allGodowns'] = getAllGodown();

        if (isset($_POST['show'])) {

            $where = [];

            if (!empty($_POST['godown_code'])) {
                if ($_POST['godown_code'] != 'all') {
                    $where['godown_code'] = $_POST['godown_code'];
                }
            } else {
                $where['godown_code'] = $this->data['branch'];
            }

            if (!empty($_POST['search'])) {
                foreach ($_POST['search'] as $_key => $value) {
                    if (!empty($value)) {
                        $where[$_key] = $value;
                    }
                }
            }

            $this->data['result'] = get_result('due_collect', $where);
        }


        $this->load->view($this->data['privilege'] . '/includes/header', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/aside', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/headermenu', $this->data);
        $this->load->view('components/due_list/nav', $this->data);
        $this->load->view('components/due_list/retail-due-collection', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/footer');
    }


    public function dealer_due()
    {

        $this->data['meta_title'] = 'Dealer Due';
        $this->data['active']     = 'data-target="due_list_menu"';
        $this->data['subMenu']    = 'data-target="dealer_list"';


        $where = [
            'parties.type'          => 'client',
            'parties.customer_type' => 'dealer',
            'parties.trash'         => 0
        ];

        // search all dealer due
        if (isset($_POST['show'])) {

            if (!empty($_POST['code'])) {
                $where['parties.code'] = $this->input->post('code');
            }

            if (!empty($_POST['zone'])) {
                if ($_POST['zone'] == 'zone_null') {
                    $where['parties.zone'] = '';
                } else {
                    $where['parties.zone'] = $_POST['zone'];
                }
            }

            if (!empty($_POST['dealer_type'])) {
                $where['parties.dealer_type'] = $this->input->post('dealer_type');
            }

            if (!empty($_POST['godown_code'])) {
                if ($_POST['godown_code'] != 'all') {
                    $where['parties.godown_code'] = $_POST['godown_code'];
                }
            }


        } else {
            $where['parties.godown_code'] = $this->data['branch'];
        }

        $this->data['allPartyInfo'] = $this->allClientDue($where);


        $this->load->view($this->data['privilege'] . '/includes/header', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/aside', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/headermenu', $this->data);
        $this->load->view('components/due_list/nav', $this->data);
        $this->load->view('components/due_list/dealer_list', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/footer');

    }
    
    
     public function delete($id=NULL){

        $info = get_row('due_collect', ['id'=>$id]);

        print_r($info);
      
         // get balance info
         $balanceInfo = get_cashclient_balance($info->voucher_no);


         $due = $balanceInfo['balance'] + ($info->paid + $info->remission);
      
        // update due status
        if ($due > 0) {
            save_data('saprecords', ['due_status' => 'due'], ['voucher_no' => $info->voucher_no]);
        }
        $this->action->deleteData('due_collect', ['id'=>$id]);
    
        $options  = array(
            "title" => "Success",
            "emit"  => "Due Successfully Collect !",
            "btn"   => true
        );

        
        $this->data['confirmation'] = message('success', $options);
        $this->session->set_flashdata('confirmation', $this->data['confirmation']);

        redirect('due_list/due_list/retail_due_collection/', 'refresh');
    }
    
    public function weekli_due()
    {

        $this->data['meta_title'] = 'Dealer Due';
        $this->data['active']     = 'data-target="due_list_menu"';
        $this->data['subMenu']    = 'data-target="weekli_list"';


        $where = [
            'parties.type'          => 'client',
            'parties.customer_type' => 'weekly',
            'parties.trash'         => 0
        ];

        // search all weekly due
        if (isset($_POST['show'])) {


            if (!empty($_POST['zone'])) {
                if ($_POST['zone'] == 'zone_null') {
                    $where['parties.zone'] = '';
                } else {
                    $where['parties.zone'] = $_POST['zone'];
                }
            }

            if (!empty($_POST['code'])) {
                $where['parties.code'] = $this->input->post('code');
            }

            if (!empty($_POST['godown_code'])) {
                if ($_POST['godown_code'] != 'all') {
                    $where['parties.godown_code'] = $_POST['godown_code'];
                }
            }
            
            
            //date filter
            
            if(!empty($_POST['dateFrom'])){
                
                $dateFrom  = explode('-', $_POST['dateFrom']);
                
                $where['YEAR(parties.opening) >='] = $dateFrom[0];
                $where['Month(parties.opening) >='] = $dateFrom[1];
            }
            
            if(!empty($_POST['dateTo'])){
                
                $dateTo  = explode('-', $_POST['dateTo']);
                
                $where['YEAR(parties.opening) <='] = $dateTo[0];
                $where['Month(parties.opening) <='] = $dateTo[1];
            }

        } else {
            $where['parties.godown_code'] = $this->data['branch'];
        }

        $this->data['allPartyInfo'] = $this->allClientDue($where);


        $this->load->view($this->data['privilege'] . '/includes/header', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/aside', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/headermenu', $this->data);
        $this->load->view('components/due_list/nav', $this->data);
        $this->load->view('components/due_list/weekli_list', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/footer');

    }

    public function credit()
    {
        $this->data['meta_title'] = 'Credit Client Due';
        $this->data['active']     = 'data-target="due_list_menu"';
        $this->data['subMenu']    = 'data-target="credit"';
        $this->data['result']     = null;

        $where = [
            'parties.type'          => 'client',
            'parties.customer_type' => 'hire',
            'parties.trash'         => 0
        ];

        // search all hire due
        if (isset($_POST['show'])) {

            if (!empty($_POST['code'])) {
                $where['parties.code'] = $this->input->post('code');
            }


            if (!empty($_POST['godown_code'])) {
                if ($_POST['godown_code'] != 'all') {
                    $where['parties.godown_code'] = $_POST['godown_code'];
                }
            }

            if (!empty($_POST['zone'])) {
                if ($_POST['zone'] == 'zone_null') {
                    $where['parties.zone'] = '';
                } else {
                    $where['parties.zone'] = $_POST['zone'];
                }
            }
            
            //date filter
            
            if(!empty($_POST['dateFrom'])){
                $where['parties.opening >='] = date('Y-m-01', strtotime($_POST['dateFrom'])) ;
            }
            
            if(!empty($_POST['dateTo'])){
                $where['parties.opening <='] = date('Y-m-t', strtotime($_POST['dateTo']));
            }
            
            //dd($where);

        } else {

            if (!empty($this->data['branch'])) {
                $where['parties.godown_code'] = $this->data['branch'];
            }
        }
       

        $this->data['allPartyInfo'] = $this->allClientDue($where);


        $this->load->view($this->data['privilege'] . '/includes/header', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/aside', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/headermenu', $this->data);
        $this->load->view('components/due_list/nav', $this->data);
        $this->load->view('components/due_list/credit_client', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/footer');

    }


    // get all client due
    private function allClientDue($where)
    {
        $select    = ['parties.code', 'parties.name', 'parties.address', 'parties.mobile', 'parties.initial_balance', 'parties.path', 'godowns.name as godown_name'];
        $partyInfo = get_join('parties', 'godowns', 'godowns.code=parties.godown_code', $where, $select);
        $dueInfo   = [];
        if (!empty($partyInfo)) {
            foreach ($partyInfo as $_key => $party_item) {


                $balanceInfo = custom_query("SELECT IFNULL(SUM(debit), 0) AS debit, IFNULL(SUM(credit + remission + adjustment), 0) AS credit FROM partytransaction WHERE party_code='$party_item->code' AND trash=0", true);

                $balance = $party_item->initial_balance + $balanceInfo->debit - $balanceInfo->credit;

                if ($balance > 0) {

                    $dueInfo[$_key]['code']        = $party_item->code;
                    $dueInfo[$_key]['name']        = $party_item->name;
                    $dueInfo[$_key]['address']     = $party_item->address;
                    $dueInfo[$_key]['mobile']      = $party_item->mobile;
                    $dueInfo[$_key]['photo']       = $party_item->path;
                    $dueInfo[$_key]['balance']     = $balance;
                    $dueInfo[$_key]['godown_name'] = $party_item->godown_name;
                }


                /*$tranInfo = get_result('partytransaction', ['trash' => 0, 'party_code' => $party_item->code], ['credit', 'debit', 'remission']);
                $debit    = $credit = $remission = $currentBalance = 0;
                if (!empty($tranInfo)) {

                    // calculate transaction
                    foreach ($tranInfo as $tran_item) {
                        $debit     += $tran_item->debit;
                        $credit    += $tran_item->credit;
                        $remission += $tran_item->remission;
                    }

                    if ($party_item->initial_balance < 0) {
                        $currentBalance = $debit - ($credit + $remission + abs($party_item->initial_balance));
                    } else {
                        $currentBalance = ($debit + $party_item->initial_balance) - ($credit + $remission);
                    }

                    if ($currentBalance > 0) {
                        $dueInfo[$_key]['code']        = $party_item->code;
                        $dueInfo[$_key]['name']        = $party_item->name;
                        $dueInfo[$_key]['address']     = $party_item->address;
                        $dueInfo[$_key]['mobile']      = $party_item->mobile;
                        $dueInfo[$_key]['photo']       = $party_item->path;
                        $dueInfo[$_key]['balance']     = $currentBalance;
                        $dueInfo[$_key]['godown_name'] = $party_item->godown_name;
                    }
                } else {
                    if ($party_item->initial_balance > 0) {
                        $dueInfo[$_key]['code']        = $party_item->code;
                        $dueInfo[$_key]['name']        = $party_item->name;
                        $dueInfo[$_key]['address']     = $party_item->address;
                        $dueInfo[$_key]['mobile']      = $party_item->mobile;
                        $dueInfo[$_key]['photo']       = $party_item->path;
                        $dueInfo[$_key]['balance']     = $party_item->initial_balance;
                        $dueInfo[$_key]['godown_name'] = $party_item->godown_name;
                    }
                }*/
            }
        }

        return $dueInfo;
    }


    public function due_collect()
    {

        $this->data['meta_title'] = 'Due Collect';
        $this->data['active']     = 'data-target="due_list_menu"';
        $this->data['subMenu']    = 'data-target="client"';
        $this->data['result']     = [];

        // get voucher no
        $voucher_no = $this->input->get('vno');
        $where      = ['voucher_no' => $voucher_no];

        // get voucher info
        $voucherInfo = get_row('saprecords', $where);

        // get balance info
        $balanceInfo = get_cashclient_balance($voucher_no);

        $this->data['result']['voucher_no']   = $voucherInfo->voucher_no;
        $this->data['result']['sap_type']     = $voucherInfo->sap_type;
        $this->data['result']['party_code']   = $voucherInfo->party_code;
        $this->data['result']['address']      = $voucherInfo->address;
        $this->data['result']['sap_at']       = $voucherInfo->sap_at;
        $this->data['result']['remission']    = $balanceInfo['total_remission'];
        $this->data['result']['total_bill']   = $voucherInfo->total_bill;
        $this->data['result']['paid']         = ($balanceInfo['total_paid'] + $balanceInfo['total_remission']);
        $this->data['result']['due']          = $balanceInfo['balance'];
        $this->data['result']['promise_date'] = $voucherInfo->promise_date;
        $this->data['result']['godown_code']  = $voucherInfo->godown_code;

        if ($this->input->post('save')) {
            $data = array(
                'date'          => $this->input->post('collection_date'),
                'voucher_no'    => $this->input->post('voucher_no'),
                'party_code'    => $this->input->post('party_code'),
                'godown_code'   => $this->input->post('godown_code'),
                'total_bill'    => $this->input->post('total_bill'),
                'previous_paid' => $this->input->post('previous_paid'),
                'paid'          => $this->input->post('paid'),
                'due'           => $this->input->post('due'),
                'remission'     => $this->input->post('remission')
            );
            // add record to due_collect table
            $dueID = save_data('due_collect', $data, '', true);

            //update promise date
            save_data('saprecords', ['promise_date' => $_POST['promise_date']], $where);

            // update due status
            if ($_POST['due'] <= 0) {
                save_data('saprecords', ['due_status' => 'paid'], $where);
            }

            // update partyTransaction
            $tranData = [
                'debit'     => $this->input->post('total_paid'),
                'remission' => $this->input->post('total_remission')
            ];
            save_data('partytransaction', $tranData, ["relation" => "sales:$voucher_no"]);

            $options                    = array(
                "title" => "Success",
                "emit"  => "Due Successfully Collect !",
                "btn"   => true
            );
            $this->data['confirmation'] = message("success", $options);
            $this->session->set_flashdata('confirmation', $this->data['confirmation']);
            redirect('due_list/due_list/due_voucher/' . $dueID, 'refresh');
        }

        $this->load->view($this->data['privilege'] . '/includes/header', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/aside', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/headermenu', $this->data);
        $this->load->view('components/due_list/due_collect', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/footer');

    }

    public function due_voucher($id = null)
    {

        $this->data['meta_title'] = 'Due Collect';
        $this->data['active']     = 'data-target="due_list_menu"';
        $this->data['subMenu']    = 'data-target="retail_due_collection"';
        $this->data['result']     = [];

        if (!empty($id)) {
            $select               = ['saprecords.*', 'due_collect.date', 'due_collect.paid AS d_paid', 'due_collect.paid AS d_previous_paid', 'due_collect.remission AS d_remission'];
            $this->data['result'] = get_row_join('due_collect', 'saprecords', 'due_collect.voucher_no=saprecords.voucher_no', ['due_collect.id' => $id], $select);
        } else {
            redirect('due_list/due_list', 'refresh');
        }

        $this->load->view($this->data['privilege'] . '/includes/header', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/aside', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/headermenu', $this->data);
        $this->load->view('components/due_list/nav', $this->data);
        $this->load->view('components/due_list/voucher', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/footer');

    }


    public function supplier()
    {
        $this->data['meta_title'] = 'All Supplier Dues';
        $this->data['active']     = 'data-target="due_list_menu"';
        $this->data['subMenu']    = 'data-target="supplier"';
        $this->data['result']     = null;


        $this->load->view($this->data['privilege'] . '/includes/header', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/aside', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/headermenu', $this->data);
        $this->load->view('components/due_list/nav', $this->data);
        $this->load->view('components/due_list/supplier', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/footer');
    }

    /**
     * fetch data from `parties` table
     * @param  [type] string
     * @return [type] data array
    */
    private function getParty($type)
    {
        $where  = array(
            'type'   => $type,
            'trash'  => 0,
            'status' => 'active'
        );
        $result = $this->action->read('parties', $where);
        return $result;
    }


    public function due_client_send_sms()
    {

        //Sending SMS Start
        $v_no    = $this->input->get('vno');
        $address = $this->action->read('saprecords', array('voucher_no' => $v_no));
        if (!empty($address)) {
            $due = $address[0]->due;
            $mbl = explode('"', $address[0]->address);
            $num = $mbl[3];

            if ($num) {
                $content = "Dear Sir,Your Current Due Balance Is: " . $due . " Tk. Thanks, Rafiq Electronics.";
                $message = send_sms($num, $content);

                $insert = array(
                    'delivery_date'    => date('Y-m-d'),
                    'delivery_time'    => date('H:i:s'),
                    'mobile'           => $num,
                    'message'          => $content,
                    'total_characters' => strlen($content),
                    'total_messages'   => message_length(strlen($content), $message),
                    'delivery_report'  => $message
                );

                if ($message) {
                    $this->action->add('sms_record', $insert);
                    $options                    = array(
                        "title" => "Success",
                        "emit"  => "Sms Send Successfully!",
                        "btn"   => true
                    );
                    $this->data['confirmation'] = message('success', $options);
                    $this->session->set_flashdata('confirmation', $this->data['confirmation']);
                } else {

                    $options                    = array(
                        "title" => "Success",
                        "emit"  => "Sms Can not Send!",
                        "btn"   => true
                    );
                    $this->data['confirmation'] = message('warning', $options);
                    $this->session->set_flashdata('confirmation', $this->data['confirmation']);
                    //Sending SMS End
                }
            }
        }

        redirect('due_list/due_list', 'refresh');
    }
}