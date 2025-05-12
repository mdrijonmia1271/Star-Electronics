<?php

class categoryLedger extends Admin_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('action');
    }

    public function index(){
   
        $this->data['meta_title']   = 'Stock';
        $this->data['active']       = 'data-target="ledger"';
        $this->data['subMenu']      = 'data-target="categoryLedger"';
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
                    if($val != null && $val != 'all'){
                        $where["$key"] = $val;
                        $where_purchase_return["$key"] = $val;
                        $where_sale_return["$key"] = $val;
                    }
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
          
            
            $tableTo                = ['products'];
            $joinCond               = ['products.product_code = sapitems.product_code'];
            $select                 = ['sapitems.product_model','sum(quantity) as quantity','sapitems.status'];
            $this->data['result']   = get_join("sapitems", $tableTo, $joinCond, $where, $select, ["products.product_cat","sapitems.product_code","sapitems.status"]);
          
          
            $tableTo = [];
            $joinCond = [];
            
            $tableTo                                = ['products'];
            $joinCond                               = ['products.product_code = purchase_return.product_code'];
            $select_purchase_return                 = ['products.product_model','sum(quantity) as quantity'];
            $this->data['PurchaseReturnresult']     = get_join("purchase_return", $tableTo, $joinCond, $where_purchase_return, $select_purchase_return, ["products.product_cat","purchase_return.product_code"]);
          
         
           
            $tableTo = [];
            $joinCond = [];
            
            $tableTo                                = ['products'];
            $joinCond                               = ['products.product_code = sale_return.product_code'];
            $select_sale_return                     = ['products.product_model','sum(quantity) as quantity'];
            $this->data['SaleReturnresult']         = get_join("sale_return", $tableTo, $joinCond, $where_sale_return, $select_sale_return, ["products.product_cat","sale_return.product_code"]);
           
        }
          
        
        
      

        $this->load->view($this->data['privilege'] . '/includes/header', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/aside', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/headermenu', $this->data);
        $this->load->view('components/ledger/nav', $this->data);
        $this->load->view('components/ledger/categoryLedger', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/footer', $this->data);
    }

}