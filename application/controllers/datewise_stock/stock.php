<?php

class Stock extends Admin_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('action');
    }

    public function index() {
        $this->data['meta_title']   = 'Stock';
        $this->data['active']       = 'data-target="raw_stock_menu_date"';
        $this->data['subMenu']      = 'data-target="add-new"';
        $this->data['confirmation'] = null;
        
        // get all godowns
        $this->data['allGodowns'] = getAllGodown();
    

        $where = array('quantity >' => 0);

        $this->data['productInfo'] = $this->action->readGroupBy("stock", "code", $where);

        $this->data['category'] = $this->action->read_distinct("stock", $where, "category");

        $this->data['subcategory'] = $this->action->read_distinct("stock", $where, "subcategory");

        $where = [];
        if(isset($_POST['show'])){

            if(isset($_POST['search'])){
                foreach($_POST['search'] as $key => $val){
                    if($val != null){
                        $where["stock.$key"] = $val;
                    }
                }
            }
            
            if(!empty($_POST['godown_code'])){
                if($_POST['godown_code'] != 'all'){
                    $where['godown_code'] = $_POST['godown_code'];
                }
            }else{
                $where['godown_code'] = $this->data['branch'];
            }
        } else {
            $where['godown_code'] = $this->data['branch'];
        }
      
        $this->data['result'] = get_join("stock", 'godowns', 'godowns.code=stock.godown_code', $where, ['stock.*', 'godowns.name as godown_name']);
        
        
      

        $this->load->view($this->data['privilege'] . '/includes/header', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/aside', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/headermenu', $this->data);
        $this->load->view('components/datewise_stock/stock', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/footer', $this->data);
    }

}