<?php

class Stock extends Admin_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('action');
    }

    public function index() {
        $this->data['meta_title']   = 'Stock';
        $this->data['active']       = 'data-target="raw_stock_menu"';
        $this->data['subMenu']      = 'data-target="add-new"';
        $this->data['confirmation'] = null;
        
        // get all godowns
        $this->data['allGodowns'] = getAllGodown();
    

        $where = [];

        $this->data['productInfo'] = $this->action->readGroupBy("stock", "code", $where);

        $this->data['category'] = $this->action->read_distinct("stock", $where, "category");

        $this->data['brand'] = $this->action->read_distinct("stock", $where, "brand");
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
      
        $this->data['result'] = get_join("stock", 'godowns', 'godowns.code=stock.godown_code', $where, ['stock.*', 'godowns.name as godown_name'], '', 'stock.category', 'ASC');
        
        
      

        $this->load->view($this->data['privilege'] . '/includes/header', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/aside', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/headermenu', $this->data);
        $this->load->view('components/stock/stock', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/footer', $this->data);
    }
    
    public function transfer(){
        $this->data['meta_title']   = 'Stock';
        $this->data['active']       = 'data-target="stock_transfer_menu"';
        $this->data['subMenu']      = 'data-target="add-new"';
        $this->data['confirmation'] = NULL;
        
          // get all products
        $this->data['allStock']     = get_result('stock', '', ['product_model', 'code'], 'code');
        $this->data['allProducts']  = $this->getAllProduct();
        // get all godowns
        $this->data['allGodowns'] = getAllGodown();
        
        if(isset($_POST['save'])){
            // insert purchase record
            $total_quantity     = 0;
            $current_stock      = 0;
            $total_stock_qty    = 0;
            
            
            $old_stock_have = get_row('stock', ['code'=>$_POST['product_from'], 'godown_code'=>$this->input->post('godown_code_from')]);
            if(!empty($old_stock_have)){
                $current_stock = $old_stock_have->quantity - $this->input->post('total_qty');
                $this->action->update('stock', ['quantity'=>$current_stock], ['code'=>$_POST['product_from'], 'godown_code'=>$this->input->post('godown_code_from')]);
            }
            
            foreach ($_POST['product_code'] as $key => $value) {
               
                $total_quantity += $_POST['quantity'][$key];
                $get_stock =  get_result('stock', ['code'=>$_POST['product_code'][$key], 'godown_code'=>$this->input->post('godown_code_to')]);
                
                if(!empty($get_stock)){
                     foreach($get_stock as $key =>$stock){
                        $total_stock_qty = $stock->quantity + $_POST['quantity'][$key];
                        
                        $this->action->update('stock', ['quantity'=>$total_stock_qty], ['code'=>$_POST['product_code'][$key], 'godown_code'=>$this->input->post('godown_code_to')]);
                    }
                }else{
                    $data = array(
                        'code'           => $_POST['product_code'][$key],
                        'product_model'  => $_POST['product_model'][$key],
                        'name'           => $_POST['product'][$key],
                        'category'       => $_POST['product_cat'][$key],
                        'subcategory'    => $_POST['product_subcat'][$key],
                        'brand'          => $_POST['product_brand'][$key],
                        'quantity'       => $_POST['quantity'][$key],
                        'purchase_price' => $_POST['purchase_price'][$key],
                        'sell_price'     => $_POST['sale_price'][$key],
                        'godown_code'    => $_POST['godown_code_to'],
                        'unit'           => $_POST['unit'][$key],
                    );
        
                    $this->action->add('stock', $data);
                }
                
                    $data = array(
                        'date'           => date('Y-m-d'),
                        'code'           => $_POST['product_code'][$key],
                        'product_model'  => $_POST['product_model'][$key],
                        'name'           => $_POST['product'][$key],
                        'category'       => $_POST['product_cat'][$key],
                        'subcategory'    => $_POST['product_subcat'][$key],
                        'quantity'       => $_POST['quantity'][$key],
                        'purchase_price' => $_POST['purchase_price'][$key],
                        'sell_price'     => $_POST['sale_price'][$key],
                        'godown_from'    => $_POST['godown_code_from'],
                        'godown_code'    => $_POST['godown_code_to'],
                        'unit'           => $_POST['unit'][$key],
                    );
                    $msg_array=array(
                        "title"=>"Success",
                        "emit"=>"Added Successfully Saved",
                        "btn"=>true
                    );

                    $this->data['confirmation']=message($this->action->add('stock_transfer', $data), $msg_array);
                
            }
        }
        

        $this->load->view($this->data['privilege'] . '/includes/header', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/aside', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/headermenu', $this->data);
        $this->load->view('components/stock/nav', $this->data);
        $this->load->view('components/stock/transfer', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/footer', $this->data);
    }
    
    public function history() {
        $this->data['meta_title']   = 'History';
        $this->data['active']       = 'data-target="raw_stock_menu"';
        $this->data['subMenu']      = 'data-target="all-history"';
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
                        $where["stock_transfer.$key"] = $val;
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
      
        $this->data['result'] = get_join("stock_transfer", 'godowns', 'godowns.code=stock_transfer.godown_code', $where, ['stock_transfer.*', 'godowns.name as godown_name']);
        
        
      

        $this->load->view($this->data['privilege'] . '/includes/header', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/aside', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/headermenu', $this->data);
        $this->load->view('components/stock/nav', $this->data);
        $this->load->view('components/stock/transfer_history', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/footer', $this->data);
    }
    
    private function getAllProduct()
    {
        $result = get_result("products", ["status" => "available"], ['product_code', 'product_name', 'product_model']);
        return $result;
    }

}