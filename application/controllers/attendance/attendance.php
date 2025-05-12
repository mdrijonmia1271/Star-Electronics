<?php

class Attendance extends Admin_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('action');
        $this->load->library('upload');
    }

    public function index() {
        $this->data['meta_title']   = 'Attendance';
        $this->data['active']       = 'data-target="attendance_menu"';
        $this->data['subMenu']      = 'data-target="add-new"';
        $this->data['confirmation'] = $this->data['allEmployees'] = $matchDate = null;
        $this->data['result'] = null;
        
        
        
        // after submit
        if(isset($_POST['show'])){
            
            $this->data['result'] = array();
            
            // fetch all employees
            $allEmployees = $this->action->read('employee',array('status' => 'active'));
            
            // check attendance already take or not in that given date
            $givenDate = $this->input->post('present_date');
            
            foreach($allEmployees as $key => $employee){
                $where = array(
                    'emp_id' => $employee->emp_id,
                    'date'  => $givenDate
                );
                $record = $this->action->read('attendance',$where);
                if($record){
                    $this->data['result'][$key]['emp_id']     = $employee->emp_id;
                    $this->data['result'][$key]['name']       = $employee->name;
                    $this->data['result'][$key]['start_time'] = $record[0]->start_time;
                    $this->data['result'][$key]['end_time']   = $record[0]->end_time;
                    $this->data['result'][$key]['status']     = $record[0]->status;
                }else{
                    $this->data['result'][$key]['emp_id']     = $employee->emp_id;
                    $this->data['result'][$key]['name']       = $employee->name;
                    $this->data['result'][$key]['start_time'] = $employee->entry_time; 
                    $this->data['result'][$key]['end_time']   = $employee->exit_time;
                    $this->data['result'][$key]['status']     = '';
                }
            }
            
            
            
            //previous code section-------------------------
            
            /*
            $this->data['allEmployees'] = $this->action->read('employee');
            
            $info = $this->action->read_distinct('attendance', array(), 'date');
            foreach($info as $key => $value){
                if($value->date == $givenDate){
                    $matchDate = $value->date;
                }else{
                    $matchDate = null;
                }
            }*/
            
            
           /* 
            if($matchDate != null){
                $msg_array=array(
                    'title' =>'warning',
                    'emit'  =>'Attendance Already Taken !!!',
                    'btn'   => true
                );
       
                $this->data['confirmation'] = message('warning', $msg_array);
                $this->session->set_flashdata('confirmation',$this->data['confirmation']);
                redirect('attendance/attendance/','refresh');
            }else{
                
                $this->data['present_date'] = $givenDate;
            }*/
            
            
            //previous code section end--------------------
            
        }
        
        if(isset($_POST['save'])){
            $this->data['confirmation'] = $this->create();
        }

        
        
        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/attendance/nav', $this->data);
        $this->load->view('components/attendance/add', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }


    private function create(){
        $data = null;
        
        foreach ($_POST['emp_id'] as $key => $value) {
            $status = 'No';
            
            if(isset($_POST['status'])){
                    foreach($_POST['status'] as $index => $value){
                        if ($_POST['emp_id'][$key] == $index) {
                            $status = 'yes';
                        }
                    }
            }
            
            
            $data = array(
                'date'         => $_POST['date'][$key],
                'start_time'   => $_POST['start_time'][$key],
                'end_time'     => $_POST['end_time'][$key],
                'emp_id'       => $_POST['emp_id'][$key],
                'emp_name'     => $_POST['emp_name'][$key],
                'status'       => $status
            );
            
            
            // if already attendance taken in that day then update otherwise add
            $where = array(
                'date'   =>  $_POST['date'][$key],
                'emp_id' => $_POST['emp_id'][$key]
            );
            
            if($this->action->exists('attendance',$where) ){
                $this->action->update('attendance',$data,$where);
            }else{
                $this->action->add('attendance',$data);
            }
            
            $msg_array=array(
                'title' =>'success',
                'emit'  =>'Attendance Successfully Taken !',
                'btn'   => true
            );
   
            $this->data['confirmation'] = message('success',$msg_array);
            $this->session->set_flashdata('confirmation',$this->data['confirmation']);
        }
        redirect('attendance/attendance','refresh');
    }
    
    
    
    public function all() {
        
        $this->data['meta_title']   = '';
        $this->data['active']       = 'data-target="attendance_menu"';
        $this->data['subMenu']      = 'data-target="all"';
        $this->data['confirmation'] = $this->data['attendanceInfo'] = null;       
        
        $this->data['employeeInfo'] = $this->action->readGroupBy('attendance', 'emp_id');
        
        if(isset($_POST['show'])){
            //echo 'ok';
            $where = array();

            if($this->input->post('search') !=null){
                foreach($_POST['search'] as $key => $val) {
                    if($val != null){
                        $where[$key] = $val;
                    }
                }
            }

            foreach($_POST['date'] as $key => $val) {
                if($val != null && $key == 'from') {
                    $where['date >='] = $val;
                }

                if($val != null && $key == 'to') {
                    $where['date <='] = $val;
                }
            }
            $where['trash'] = 0;
            $where['status'] = 'yes';
            
            $this->data['attendanceInfo'] = $this->action->readGroupBy('attendance','date', $where);   
        }
        
        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/attendance/nav', $this->data);
        $this->load->view('components/attendance/all', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }
    
    
    public function view($id=null) {
        $this->data['active']       = 'data-target="attendance_menu"';
        $this->data['subMenu']      = 'data-target="all"';
        $this->data['confirmation'] = null;

        //$where = array('id'   => $id);
        //$this->data['records'] = $this->action->read('attendance',$where);

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/attendance/nav', $this->data);
        $this->load->view('components/attendance/view', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }
    
    
    public function edit($id=null) {

        $this->data['active']       = 'data-target="attendance_menu"';
        $this->data['subMenu']      = 'data-target="all"';
        $this->data['confirmation'] = null;
        
        $where = array('id' => $id);
        $this->data['employeeInfo'] = $this->action->read('attendance', $where);
        
        if(isset($_POST['update'])){
            $this->data['confirmation'] = $this->update($id);
        }
       
        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/attendance/nav', $this->data);
        $this->load->view('components/attendance/edit', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }
    
    
    private function update($id){
        $data = null;
        $where = array('id' => $id);

        if(isset($_POST['status'])){
            $data = array(
                'start_time'   => $_POST['start_time'],
                'end_time'     => $_POST['end_time'],
                'emp_id'       => $_POST['emp_id'],
                'emp_name'     => $_POST['emp_name'],
                'status'       => $_POST['status']
            );
        }else{
            $data = array(
                'start_time'   => $_POST['start_time'],
                'end_time'     => $_POST['end_time'],
                'emp_id'       => $_POST['emp_id'],
                'emp_name'     => $_POST['emp_name'],
                'status'       => ''
            );
        }
        
        $msg_array=array(
            'title' =>'success',
            'emit'  =>'Successfully Updated!',
            'btn'   => true
        );

        $this->data['confirmation']=message($this->action->update('attendance', $data, $where), $msg_array);
        $this->session->set_flashdata('confirmation',$this->data['confirmation']);
        redirect('attendance/attendance/edit/'.$id,'refresh');
    }

    
    public function delete($id = NULL){

        $where = array('id'   => $id);
        
        $data=array(
            "trash" => 1
        );

        $msg_array=array(
            "title" =>"delete",
            "emit"  =>"Attendance Successfully Deleted",
            "btn"   =>true
        );
        
        $this->data['confirmation']=message($this->action->update('attendance',$data,$where),$msg_array);
        $this->session->set_flashdata("confirmation",$this->data['confirmation']);
        redirect("attendance/attendance/all","refresh");
    }

}
