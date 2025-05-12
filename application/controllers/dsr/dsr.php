<?php
class Dsr extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->holder();
        $this->load->model('action');
    }
    
    public function index() {
        $this->data['meta_title'] = 'Dsr';
        $this->data['active'] = 'data-target="dsr_menu"';
        $this->data['subMenu'] = 'data-target="add-new"';
        $this->data['confirmation'] = null;

        $this->load->view($this->data['privilege']. '/includes/header', $this->data);
        $this->load->view($this->data['privilege']. '/includes/aside', $this->data);
        $this->load->view($this->data['privilege']. '/includes/headermenu', $this->data);
        $this->load->view('components/dsr/nav', $this->data);
        $this->load->view('components/dsr/add', $this->data);
        $this->load->view($this->data['privilege']. '/includes/footer', $this->data);
    }
    

    public function addDsr() {  
        $this->data['confirmation'] = null;     

        $data = $_POST;

        $msg_array = array(
            'title' => 'success',
            'emit'  => 'Dsr Successfully Saved!',
            'btn'   => true
        );

        $this->data['confirmation'] = message($this->action->add('dsr', $data), $msg_array);
        $this->session->set_flashdata('confirmation', $this->data['confirmation']);
        redirect('dsr/dsr','refresh');
    }


    public function allDsr() {
        $this->data['meta_title'] = 'Dsr';
        $this->data['active'] = 'data-target="dsr_menu"';
        $this->data['subMenu'] = 'data-target="all"';
        $this->data['confirmation'] = null;  
      
        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/dsr/nav', $this->data);
        $this->load->view('components/dsr/view-all', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer', $this->data);
    }

    
    public function editDsr($id = NULL) {       
        $this->data['active'] = 'data-target="dsr_menu"';
        $this->data['subMenu'] = 'data-target="all"';
        $this->data['dsr'] = null;

        $this->data['id'] = $id;
        $this->data['dsr'] = $this->action->read("dsr", array('id' => $id));

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/dsr/nav', $this->data);
        $this->load->view('components/dsr/edit', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer', $this->data);
    }


    public function edit($id=NULL) {  
        $this->data['confirmation'] = null;
        
        $options = array(
            'title' => 'update',
            'emit'  => 'Dsr Successfully Updated!',
            'btn'   => true
        );

        $status = $this->action->update('dsr', $_POST, array('id' => $id));
        $this->data['confirmation'] = message($status, $options);
        $this->session->set_flashdata('confirmation', $this->data['confirmation']);
        
        redirect('dsr/dsr/allDsr','refresh');
    }


    public function deleteDsr($id=NULL) {  
        $this->data['confirmation'] = null;  
        
        $data  = array('trash' => 1);
        $where = array('id' => $id);

        $msg_array=array(
            'title'=>'delete',
            'emit' =>'Dsr Successfully Deleted!',
            'btn'  =>true
        );

        $this->data['confirmation'] = message($this->action->update('dsr', $data, $where), $msg_array);
        $this->session->set_flashdata('confirmation', $this->data['confirmation']);
        redirect('dsr/dsr/allDsr','refresh');

    }
    
    
    private function holder(){  
        if($this->session->userdata('holder') == null){
            $this->membership_m->logout();
            redirect('access/users/login');
        }
    }

}
