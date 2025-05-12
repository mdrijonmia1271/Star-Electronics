<?php

class productLedger extends Admin_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('action');
    }

    public function index(){
   
        $this->data['meta_title']   = 'Stock';
        $this->data['active']       = 'data-target="ledger"';
        $this->data['subMenu']      = 'data-target="productLedger"';
        $this->data['confirmation'] = null;
        
     

        $where = array();
        $where['quantity >'] = 0;
        $where_sale_return["trash"] = 0;
        $this->data['productInfo'] = $this->action->readGroupBy("stock", "code", []);

        $this->data['category'] = $this->action->read_distinct("stock", $where, "category");

        /*$this->data['subcategory'] = $this->action->read_distinct("stock", $where, "subcategory");*/

        if(isset($_POST['show'])){

            if(isset($_POST['search'])){
                foreach($_POST['search'] as $key => $val){
                    if($val != null){
                        $where["$key"] = $val;
                        $where_purchase_return["$key"] = $val;
                        $where_sale_return["$key"] = $val;
                    }
                }
                if(!empty($_POST['godown_code']) && $_POST['godown_code']!='all'){
                    $where['godown_code'] = $_POST['godown_code'];
                    $where_purchase_return['godown_code'] = $_POST['godown_code'];
                    $where_sale_return['godown_code'] = $_POST['godown_code'];
                }
                if(!empty($_POST['from']) && !empty($_POST['to'])){
                    $where["sap_at >="] = $_POST['from'];
                    $where["sap_at <="] = $_POST['to'];
                    
                    $where_purchase_return["date >="] = $_POST['from'];
                    $where_purchase_return["date <="] = $_POST['to'];
                    
                    $where_sale_return["date >="] = $_POST['from'];
                    $where_sale_return["date <="] = $_POST['to'];
                }
                
            }
            
          $this->data['result'] = $this->action->readOrderBy("sapitems", 'sap_at', $where);
          $this->data['PurchaseReturnresult'] = $this->action->readOrderBy("purchase_return", 'date', $where_purchase_return);
          $this->data['SaleReturnresult'] = $this->action->readOrderBy("sale_return", 'date', $where_sale_return);
        }
          
        
        
      

        $this->load->view($this->data['privilege'] . '/includes/header', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/aside', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/headermenu', $this->data);
        $this->load->view('components/ledger/nav', $this->data);
        $this->load->view('components/ledger/productLedger', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/footer', $this->data);
    }

}