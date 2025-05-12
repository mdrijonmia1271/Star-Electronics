<?php

class Employee extends Admin_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('action');
        $this->load->library('upload');
    }
   
  public function index() {
        $this->data['meta_title'] = '';
        $this->data['active'] = 'data-target="employee_menu"';
        $this->data['subMenu'] = 'data-target="add-new"';
        $this->data['confirmation'] = null;
    
       $this->form_validation->set_rules('mobile_number', 'Mobile Number', 'trim|required|min_length[11]|is_unique[employee.mobile]');

        if ($this->input->post("add_emp")) {         

            if($this->form_validation->run() == FALSE){
                $msg_array=array(
                    "title"=>"Error",
                    "emit"=>validation_errors(),
                    "btn"=>true
                );
                $this->data['confirmation']=message("warning",$msg_array);
            } else{
                //Image Upload Start here
                if ($_FILES["attachFile"]["name"]!=null or $_FILES["attachFile"]["name"]!="" ) {

                    $config['upload_path'] = './public/employee';
                    $config['allowed_types'] = 'png|jpeg|jpg|gif';
                    $config['max_size'] = '4096';
                    $config['max_width'] = '3000'; /* max width of the image file */
                    $config['max_height'] = '3000';
                    $config['file_name'] ="employee_".rand(1111,99999)."_".strtotime('now');
                    $config['overwrite']=true;   
                    
                    $this->upload->initialize($config);
                   
                    
                    if ($this->upload->do_upload("attachFile")){
                        $upload_data=$this->upload->data();
                        $photo="public/employee/".$upload_data['file_name'];
                    }

                }         
               


                $data=array(
                    "date"             =>date("Y-m-d"),
                    "name"             =>$this->input->post("full_name"),
                    "joining_date"     =>$this->input->post('joining_date'),                    
                    "gender"           =>$this->input->post("gender"),
                    "mobile"           =>$this->input->post("mobile_number"),
                    "email"            =>$this->input->post("email"),
                    "overtime"         =>$this->input->post("overtime"),
                    "entry_time"       =>$this->input->post("start_time"),
                    "exit_time"        =>$this->input->post("end_time"),
                    "present_address"  =>$this->input->post("present_address"),
                    "permanent_address"=>$this->input->post("permanent_address"),
                    "designation"      =>$this->input->post("designation"),
                    "employee_salary"  =>$this->input->post("salary"),
                    "status"  =>$this->input->post("status"),
                    "godown_code"  =>$this->input->post("godown_code"),
                    "path"             =>$photo                   
                );
                
                $id = $this->action->addAndGetID("employee",$data);
                $emp_id = date('y').str_pad($id,3,0,STR_PAD_LEFT);
                $this->action->update("employee",array("emp_id" => $emp_id),array("id" => $id));

                 $msg_array=array(
                    "title"=>"Success",
                    "emit" =>"Employee Successfully Saved and ID is  ".$emp_id,
                    "btn"  =>true
                );

                $this->data['confirmation']=message('success', $msg_array);   

            }
            
            $this->session->set_flashdata("confirmation",$this->data['confirmation']);
            redirect("employee/employee","refresh");
        }
       

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/employee/employee-nav', $this->data);
        $this->load->view('components/employee/add-employee', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }
   
    public function show_employee() {
        $this->data['meta_title'] = '';
        $this->data['active'] = 'data-target="employee_menu"';
        $this->data['subMenu'] = 'data-target="all"';
        $this->data['confirmation'] = null;

        $this->data['emp_info']= get_result('employee');

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/employee/employee-nav', $this->data);
        $this->load->view('components/employee/show-employee', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }

    //----------------------------------------------------------------------------------------------
    //------------------------------------------View Employee end here------------------------------
    //----------------------------------------------------------------------------------------------

    //----------------------------------------------------------------------------------------------
    //------------------------------------------View profile start here-----------------------------
    //----------------------------------------------------------------------------------------------

    public function profile() {
        $this->data['meta_title'] = '';
        $this->data['active'] = 'data-target="employee_menu"';
        $this->data['subMenu'] = 'data-target="all"';
        $this->data['confirmation'] = null;
       
        $this->data['emp_info']= $this->action->read('employee', array('id'=> $this->input->get("id")));

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/employee/employee-nav', $this->data);
        $this->load->view('components/employee/profile', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }

    //----------------------------------------------------------------------------------------------
    //------------------------------------------View profile end here-------------------------------
    //----------------------------------------------------------------------------------------------

    public function edit_employee() {
        $this->data['meta_title'] = '';
        $this->data['active'] = 'data-target="employee_menu"';
        $this->data['subMenu'] = 'data-target="all"';
        $this->data['confirmation'] = null;

        //-------------------------------------------------------------------------------------------
        //-----------------------------------update employee Start here-------------------------------------
         $where = array("id"=> $this->input->get('id'));
         $this->data['emp_info']= $this->action->read('employee', $where);

         $this->form_validation->set_rules('mobile_number', 'Mobile Number', 'trim|required|min_length[11]');


        if ($this->input->post("update_emp")) {         
        // print_r($this->input->post("start_time")); die;
            if($this->form_validation->run() == FALSE){
                $msg_array=array(
                    "title"=>"Error",
                    "emit"=>validation_errors(),
                    "btn"=>true
                );
                $this->data['confirmation']=message("warning",$msg_array);
            } else{
                  $photo=NULL;
                //Image Upload Start here
                if ($_FILES["attachFile"]["name"]!=null or $_FILES["attachFile"]["name"]!="" ) {

                    $config['upload_path'] = './public/employee';
                    $config['allowed_types'] = 'png|jpeg|jpg|gif';
                    $config['max_size'] = '4096';
                    $config['max_width'] = '3000'; /* max width of the image file */
                    $config['max_height'] = '3000';
                    $config['file_name'] ="employee_".rand(1111,99999)."_".$this->input->post("emp_id");
                    $config['overwrite']=true;   
                    
                    $this->upload->initialize($config);
                   
                    
                    if ($this->upload->do_upload("attachFile")){
                        $upload_data=$this->upload->data();
                        $photo="public/employee/".$upload_data['file_name'];
                    }

                }
                //Image Upload End here         
      
           if($photo != NULL){
                $data=array(
                    "emp_id"           =>$this->input->post('emp_id'),
                    "name"             =>$this->input->post("full_name"),
                    "joining_date"     =>$this->input->post('joining_date'),                    
                    "gender"           =>$this->input->post("gender"),
                    "mobile"           =>$this->input->post("mobile_number"),
                    "email"            =>$this->input->post("email"),
                    "overtime"         =>$this->input->post("overtime"),
                    "entry_time"       =>$this->input->post("start_time"),
                    "exit_time"        =>$this->input->post("end_time"),
                    "present_address"  =>$this->input->post("present_address"),
                    "permanent_address"=>$this->input->post("permanent_address"),
                    "designation"      =>$this->input->post("designation"),
                    "employee_salary"  =>$this->input->post("salary"),
                    "godown_code"  =>$this->input->post("godown_code"),
                    "status"  =>$this->input->post("status"),
                    "path"             =>$photo                    
                );

              }else{
                $data=array(
                    "emp_id"           =>$this->input->post('emp_id'),
                    "name"             =>$this->input->post("full_name"),
                    "joining_date"     =>$this->input->post('joining_date'),                    
                    "gender"           =>$this->input->post("gender"),
                    "mobile"           =>$this->input->post("mobile_number"),
                    "email"            =>$this->input->post("email"),
                    "overtime"         =>$this->input->post("overtime"),
                    "entry_time"       =>$this->input->post("start_time"),
                    "exit_time"        =>$this->input->post("end_time"),
                    "present_address"  =>$this->input->post("present_address"),
                    "permanent_address"=>$this->input->post("permanent_address"),
                    "designation"      =>$this->input->post("designation"),
                    "status"  =>$this->input->post("status"),
                    "godown_code"  =>$this->input->post("godown_code"),
                    "employee_salary"  =>$this->input->post("salary")                    
                      
                  );
             }
              $msg_array=array(
                "title"=>"Success",
                "emit"=>"Employee Successfully Updated!",
                "btn"=>true
                );

                $this->data['confirmation']=message($this->action->update("employee",$data, $where), $msg_array);  
                $this->session->set_flashdata("confirmation", $this->data['confirmation']);
                redirect("employee/employee/show_employee","refresh"); 

            }
        }

            //------------------------------------Update employee End here--------------------------------------
            //---------------------------------------------------------------------------------------------

    

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/employee/employee-nav', $this->data);
        $this->load->view('components/employee/edit-employee', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }


     public function delete($id=NULL){ 

        $info=$this->action->read('employee',array('id'=>$id));
        if($info != NULL){
            unlink($info[0]->path);           
        }  

        $options= array(
            'title' => 'delete',
            'emit'  => 'Employee Successfully Deleted!',
            'btn'   => true
        );

       $this->data['confirmation']=message($this->action->deletedata('employee', array('id' => $id)), $options);
       $this->session->set_flashdata("confirmation",$this->data['confirmation']);
       redirect("employee/employee/show_employee","refresh");
    }


    public function salary($emit = NULL) {
        $this->data['meta_title'] = '';
        $this->data['active'] = 'data-target="employee_menu"';
        $this->data['subMenu'] = 'data-target=""';
        $this->data['confirmation'] = null;

        $where=array("id"=>$emit);
        $this->data['emp_info']= $this->action->read('employee',$where);

        $data=array(
            'emp_id'        =>$emit,
            'salary_amount' =>$this->input->post('salary_amount'),
            'bonus'         =>$this->input->post('bonus'),
            'issue_date'    =>$this->input->post('issue_date'),
            'payment_year'  =>$this->input->post('payment_year'),
            'payment_month' =>$this->input->post('payment_month'),
            'payment_type'  =>$this->input->post('payment_type'),
            'bank_name'     =>$this->input->post('bank_name'),
            'account_number'=>$this->input->post('account_number')
        );

        if($this->input->post("submit")){
            $msg_array= array(
                'title' => 'delete',
                'emit'  => 'Data Successfully Saved!',
                'btn'   => true
            );

            $this->data['confirmation']=message($this->action->add('salary',$data), $msg_array);
            $this->session->set_flashdata("confirmation",$this->data['confirmation']);
            redirect("employee/employee/salary/".$emit,"refresh");
        }

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/employee/employee-nav', $this->data);
        $this->load->view('components/employee/salary', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }

    public function ad_salary($emit = NULL) {
        $this->data['meta_title'] = '';
        $this->data['active'] = 'data-target="employee_menu"';
        $this->data['subMenu'] = 'data-target=""';
        $this->data['confirmation'] = null;

        $where=array("id"=>$emit);
        $this->data['emp_info']= $this->action->read('employee',$where);

        if($this->input->post("submit")){

            $data=array(
                'emp_id'          =>$this->input->post('emp_id'),
                'date'            =>$this->input->post('date'),
                'advance_amount'  =>$this->input->post('advance_amount')
            );
            $msg_array= array(
                'title' => 'Success',
                'emit'  => 'Data Successfully Saved!',
                'btn'   => true
            );

            $this->data['confirmation']=message($this->action->add('ad_salary',$data), $msg_array);
            $this->session->set_flashdata("confirmation",$this->data['confirmation']);
            redirect("employee/employee/ad_salary/".$emit,"refresh");
        }

        if($this->input->post("submit_pay")){

            $data=array(
                'emp_id'      =>$this->input->post('emp_id'),
                'date'        =>$this->input->post('date'),
                'pay_amount'  =>$this->input->post('pay_amount')
            );
            $msg_array= array(
                'title' => 'delete',
                'emit'  => 'Payment Successfully Saved!',
                'btn'   => true
            );

            $this->data['confirmation']=message($this->action->add('ad_pay',$data), $msg_array);
            $this->session->set_flashdata("confirmation",$this->data['confirmation']);
            redirect("employee/employee/ad_salary/".$emit,"refresh");
        }

        //Calculation Start here
            $where = array("emp_id"=>$emit);

            $all_advance = $this->action->read('ad_salary',$where);
            $all_advance_pay = $this->action->read('ad_pay',$where);

            $total_advance=0;
            $total_advance_pay=0;

            foreach ($all_advance as $key => $all_advance) {
                $total_advance+=$all_advance->advance_amount;
            }

            foreach ($all_advance_pay as $key => $all_advance_pay) {
                $total_advance_pay+=$all_advance_pay->pay_amount;
            }

            $this->data['total_advance']=$total_advance;
            $this->data['total_advance_pay']=$total_advance_pay;

        //Calculation End here 

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/employee/employee-nav', $this->data);
        $this->load->view('components/employee/ad-salary', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }

    public function salary_history($emit = NULL) {
        $this->data['meta_title'] = '';
        $this->data['active'] = 'data-target="employee_menu"';
        $this->data['subMenu'] = 'data-target=""';
        $this->data['confirmation'] = null;

        $where=array("id"=>$emit);
        $this->data['emp_info']= $this->action->read('employee',$where);

        $where=array("emp_id"=>$emit);
        $this->data['salarys']= $this->action->read('salary',$where);
        $this->data['ad_salary']= $this->action->read('ad_salary',$where);
        $this->data['ad_pay']= $this->action->read('ad_pay',$where);

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/employee/employee-nav', $this->data);
        $this->load->view('components/employee/history', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }

    public function hash($string) {
        return hash('md5', $string . config_item('encryption_key'));
    }

    public function read_leftJoin_profile($val){
        $sql= "select * from employee LEFT JOIN users ON employee.employee_mobile=users.mobile where employee_mobile='$val' ";
        $query=$this->db->query($sql);
        return $query->result();
    }

    public function read_leftJoin_teacher($val){
        $sql= "select * from employee LEFT JOIN users ON employee.employee_mobile=users.mobile where employee_type='$val' ";
        $query=$this->db->query($sql);
        return $query->result();
    }



}