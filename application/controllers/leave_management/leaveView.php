<?php

class LeaveView extends Admin_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('action');
    }
    
    public function index($emit = NULL) {
        $this->data['meta_title'] = 'Leave Management';
        $this->data['active'] = 'data-target="leave_menu"';
        $this->data['subMenu'] = 'data-target="add-new"';
        $this->data['confirmation'] = null;

        if(isset($_POST['save'])){
            $data = array(
                'date'            => date('Y-m-d'),  
                'employee_emp_id' => $this->input->post('id'),
                'date_from'       => $this->input->post('date_from'),                     
                'date_to'         => $this->input->post('date_to'),                     
                'cause'           => $this->input->post('cause')
            );
            
            $options = array(
                "title" => "Success",
                "emit"  => "Information saved successfully!",
                "btn"   => true
            );

            $this->data['confirmation'] = message($this->action->add('employee_leave', $data), $options);
        }

        // get all employee
        $this->data['employee'] = $this->action->read('employee');

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/leave_management/leave-nav', $this->data);
        $this->load->view('components/leave_management/assign_leave', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    } 

     public function trash() {
        $this->data['meta_title'] = 'Leave Management';
        $this->data['active'] = 'data-target="leave_menu"';
        $this->data['subMenu'] = 'data-target="trash"';
        $this->data['confirmation'] = null;

       
        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/leave_management/leave-nav', $this->data);
        $this->load->view('components/leave_management/trash', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    } 


    public function show($emit = NULL) {
        $this->data['meta_title'] = 'Leave Management';
        $this->data['active'] = 'data-target="leave_menu"';
        $this->data['subMenu'] = 'data-target="all"';
        $this->data['confirmation'] = $this->data['leave'] = null;

        if(isset($_POST['show'])){
            $where = array('employee_emp_id' => $this->input->post('id'));
            $this->data['leave'] = $this->action->read('employee_leave', $where);
        }

        $this->data['employee'] = $this->action->read('employee');

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/leave_management/leave-nav', $this->data);
        $this->load->view('components/leave_management/show', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    } 

    public function delete(){
        $where = array('id' => $this->input->get('id'));
        $this->action->deleteData('employee_leave', $where);

        redirect('leave_management/leaveView/show', 'refresh');
    }


   private function holder() {
        $holder = array('super','admin', 'user');
        
        if(!(in_array($this->session->userdata('holder'), $holder)))
        {
            $this->membership_m->logout();
            redirect('access/users/login');
        }
    }

}