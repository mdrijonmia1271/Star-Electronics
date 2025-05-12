<?php
class Smr extends Admin_Controller {
    
    protected 
        $kernel, 
        $since, 
        $is_disabled,  
        $is_support,  
        $min_sms_notice, 
        $service_notice, 
        $payment_notice, 
        $support_notice,
        $renewal_notice;
    
    function __construct($type){
        parent::__construct();
        $this->load->model('action');
        $this->divide();
        
        $this->smsNotice();
        $this->isDisable();
        $this->isService();
        
        $this->index();
    }
    
    public function isDisable(){
        if($this->is_disabled==1){
            $content = file_get_contents('application/smr/block.php');
            echo ($content);
            die();
        }
    }
    
    public function isService(){
        $this->curHum();
        if($this->is_payment == 1){
            $this->kernel['payment_notice'] = $this->payment_notice;
        }
    }
    
    public function index(){
        echo $this->notice();
    }
    
    public function divide(){
        $this->kernel = [];
        $smr = $this->action->read('smr');
        if($smr){
            $this->is_disabled = $smr[0]->disabled;
            $this->is_payment  = $smr[0]->is_payment;
            $this->is_support  = $smr[0]->is_support;
            $this->since  = $smr[0]->since;
            $this->min_sms_notice = $smr[0]->min_sms_notice;
            $this->service_notice = $smr[0]->service_notice;
            $this->payment_notice = $smr[0]->payment_notice;
            $this->support_notice = $smr[0]->support_notice;
            $this->renewal_notice = $smr[0]->renewal_notice;
        }
    }
    
    public function notice(){
        if($this->kernel){
            $massage = "";
            foreach($this->kernel as $key=>$value){
                $massage .= "<p> $value </p>";
            }
            return " 
                <script>
                    window.addEventListener('load', function(){
                        let page_content_wrapper = document.querySelector('#page-content-wrapper');
                        let position = (window.location.pathname === '/super/dashboard' || window.location.pathname === '/admin/dashboard' || window.location.pathname === '/user/dashboard');
                         if(page_content_wrapper && position){
                         	let element = document.createElement('div');
                         	let content = `
                         		<div class='alert alert-danger' style='margin-top:64px;margin-bottom:-48px;' id='parent_tsk'>
                         			<button type='button' class='close'><span aria-hidden='true' onclick='parent_tsk.remove()'>×</span></button>
                         			$massage
                         		</div>
                         	`;
                         	element.innerHTML = content;
                         	page_content_wrapper.prepend(element);
                         }
                    });
                </script>
            ";
        }
    }
    
    public function content(){
        $content = '';
        print_r($this->kernel);
    }
    public function smsNotice(){
        $total_sent_sms = 0;
        $total_sms  = config_item('total_sms');
        
        $sent_sms_data = $this->action->read("sms_record", array("delivery_report" => "1"));
        foreach($sent_sms_data as $total_sent_sms_data){
            $total_sent_sms += $total_sent_sms_data->total_messages; 
        }
        
        if(($total_sms - $total_sent_sms) < 10){
            $this->kernel['min_sms'] = $this->min_sms_notice;
        }
    }
    public function curHum()
    {
        $date = $this->since;
        $c_year = date("Y");
        $f_date = (substr($date, 0, 4)+($c_year-substr($date, 0, 4))).substr($date, 4);
        
        $f_date;
        $c_date = date('Y-m-d');
        
        $dString1 = date_create($f_date);
        $dString2 = date_create($c_date);
        
        $diff   = date_diff($dString2, $dString1);
        $difDay = $diff->format("%R%a");
        
        if($difDay > 0 && $difDay < 8){
            $this->kernel['renewal_notice'] = $this->renewal_notice;
        }
        if($difDay < 0 && $difDay < -15 && $difDay > -22 && $this->is_support==1){
            $this->kernel['renewal_notice'] = $this->service_notice;
        }
        
    }
    
    
    
}