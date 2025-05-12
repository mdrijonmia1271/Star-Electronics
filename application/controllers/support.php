<?php

class Support extends Admin_Controller {

    function __construct() {
        parent::__construct();
        
        $this->load->library('email');
    }

    public function index() {
        $this->data['meta_title'] = 'add';
        $this->data['active'] = 'data-target="cheque-menu"';
        $this->data['subMenu'] = 'data-target=" "';
        
        $this->load->view($this->data['privilege'] . '/includes/header', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/aside', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/headermenu', $this->data);
        $this->load->view('components/support', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/footer');
    }

    public function sendEmail() {
        
        if(isset($_POST['submit'])){
            
            // config email
            $config['protocol']     = 'sendmail';
            $config['charset']      = 'utf-8';
            $config['newline']      = "\r\n";
            $config['mailtype']     = 'html'; // text/html
            $config['wordwrap']     = TRUE; // TRUE/FALSE  
            $config['validation']   = TRUE; // TRUE/FALSE  
    
            $this->email->initialize($config);
            
            $this->email->from('contact@rafiqelectronicsbd.com', config_item('site_name'));
            $this->email->to('mrskuet08@gmail.com');
            $this->email->subject('FIT Support');
            $this->email->message($this->input->post('message'));
            
            $this->email->send();
            
            $msg = [
                "title" => "success",
                "emit"  => "Your message successfully sent. We will reply as soon as possible.",
                "btn"   => true
            ];
    
            $this->session->set_flashdata('confirmation', message('success', $msg)); 
        }
        
        redirect('support', 'refresh');
    }
}
