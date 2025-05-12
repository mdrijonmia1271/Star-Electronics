<?php
class Dsr_payment extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->holder();
        $this->load->model('action');
    }
    
    public function index() {
        $this->data['meta_title']   = 'Dsr';
        $this->data['active']       = 'data-target="dsr_menu"';
        $this->data['subMenu']      = 'data-target="payment"';
        $this->data['confirmation'] = null;
        
        // get all godowns
        $this->data['allGodowns'] = getAllGodown();
        
        // get all dsr
        $this->data['allDsr']     = $this->action->read("dsr", array('trash' => 0));

        //Today's Data
        $where                        = [];
        $where['saprecords.status']   = 'sale';
        $where['saprecords.sap_type'] = 'dealer';
        $where['saprecords.trash']    = 0;
        
        if(isset($_POST['show'])){
            
            foreach($_POST['search'] as $key => $val) {
                if(!empty($val)){
                    $where["saprecords.$key"] = $val;
                }
            }
              
            if(!empty($_POST['godown_code'])){
                if($_POST['godown_code'] != 'all'){
                    $where['saprecords.godown_code'] = $_POST['godown_code'];
                }
            }else{
                $where['saprecords.godown_code'] = $this->data['branch'];
            }

            foreach($_POST['date'] as $key => $val) {
                if(!empty($val) && $key == 'from') {
                    $where['saprecords.sap_at >='] = $val;
                }

                if(!empty($val) && $key == 'to') {
                    $where['saprecords.sap_at <='] = $val;
                }
            }
        } else {
            $where['saprecords.sap_at']      = date("Y-m-d");
            $where['saprecords.godown_code'] = $this->data['branch'];
        }

        $tableTo              = ['godowns', 'dsr'];
        $joinCond             = ['godowns.code=saprecords.godown_code', 'saprecords.dsr=dsr.code'];
        $select               = ['saprecords.sap_at', 'saprecords.voucher_no', 'saprecords.dsr', 'saprecords.dsr_per', 'saprecords.dsr_commission', 'godowns.name as godown_name', 'dsr.name as dsr_name', 'dsr.mobile as dsr_mobile', 'dsr.area as dsr_area'];
        $this->data['result'] = get_join("saprecords", $tableTo, $joinCond, $where, $select, "voucher_no", "saprecords.id", "desc");

        $this->load->view($this->data['privilege']. '/includes/header', $this->data);
        $this->load->view($this->data['privilege']. '/includes/aside', $this->data);
        $this->load->view($this->data['privilege']. '/includes/headermenu', $this->data);
        $this->load->view('components/dsr/nav', $this->data);
        $this->load->view('components/dsr/dsr_list', $this->data);
        $this->load->view($this->data['privilege']. '/includes/footer', $this->data);
    }
    
    
    public function payment_form($vno = NULL) {
        $this->data['meta_title']   = 'Dsr';
        $this->data['active']       = 'data-target="dsr_menu"';
        $this->data['subMenu']      = 'data-target="payment"';
        $this->data['confirmation'] = null;
        
        $where = array(
            'saprecords.voucher_no' => $vno,
            'saprecords.status'     => 'sale',
            'saprecords.sap_type'   => 'dealer',
            'saprecords.trash'      => 0
        );
        
        $tableTo               = ['dsr'];
        $joinCond              = ['saprecords.dsr=dsr.code'];
        $select                = ['saprecords.dsr', 'saprecords.dsr_per', 'saprecords.dsr_commission', 'saprecords.voucher_no', 'dsr.*'];
        $this->data['dsrInfo'] = get_join("saprecords", $tableTo, $joinCond, $where, $select);

        $this->load->view($this->data['privilege']. '/includes/header', $this->data);
        $this->load->view($this->data['privilege']. '/includes/aside', $this->data);
        $this->load->view($this->data['privilege']. '/includes/headermenu', $this->data);
        $this->load->view('components/dsr/nav', $this->data);
        $this->load->view('components/dsr/add_payment', $this->data);
        $this->load->view($this->data['privilege']. '/includes/footer', $this->data);
    }
    

    public function add_payment() {  
        $this->data['confirmation'] = null;     

        $data = $_POST;

        $msg_array = array(
            'title' => 'success',
            'emit'  => 'Dsr Successfully Saved!',
            'btn'   => true
        );

        $this->data['confirmation'] = message($this->action->add('dsr_payment', $data), $msg_array);
        $this->session->set_flashdata('confirmation', $this->data['confirmation']);
        redirect('dsr/dsr_payment','refresh');
    }


    /*public function all_payment() {
        $this->data['meta_title']   = 'Dsr';
        $this->data['active']       = 'data-target="dsr_menu"';
        $this->data['subMenu']      = 'data-target="all_payment"';
        $this->data['confirmation'] = null;  
      
        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/dsr/nav', $this->data);
        $this->load->view('components/dsr/all_payment', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer', $this->data);
    }*/

    
    /*public function edit_payment($id = NULL) {       
        $this->data['active']  = 'data-target="dsr_menu"';
        $this->data['subMenu'] = 'data-target="all"';
        $this->data['dsr']     = null;

        $this->data['id']      = $id;
        $this->data['dsr']     = $this->action->read("dsr_payment", array('id' => $id));

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/dsr/nav', $this->data);
        $this->load->view('components/dsr/edit_payment', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer', $this->data);
    }*/


    /*public function edit($id=NULL) {  
        $this->data['confirmation'] = null;
        
        $options = array(
            'title' => 'update',
            'emit'  => 'Dsr Payment Successfully Updated!',
            'btn'   => true
        );

        $status = $this->action->update('dsr_payment', $_POST, array('id' => $id));
        $this->data['confirmation'] = message($status, $options);
        $this->session->set_flashdata('confirmation', $this->data['confirmation']);
        
        redirect('dsr/dsr_payment/all_payment','refresh');
    }*/


    /*public function delete_payment($id=NULL) {  
        $this->data['confirmation'] = null;  
        
        $data  = array('trash' => 0);
        $where = array('id' => $id);

        $msg_array=array(
            'title' =>'delete',
            'emit'  =>'Dsr Payment Successfully Deleted!',
            'btn'   =>true
        );

        $this->data['confirmation'] = message($this->action->update('dsr_payment', $data, $where), $msg_array);
        $this->session->set_flashdata('confirmation', $this->data['confirmation']);
        redirect('dsr/dsr_payment/all_payment','refresh');
    }*/
    
    
    private function holder(){  
        if($this->session->userdata('holder') == null){
            $this->membership_m->logout();
            redirect('access/users/login');
        }
    }

}
