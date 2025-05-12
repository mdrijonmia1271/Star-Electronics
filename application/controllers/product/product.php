<?php
class Product extends Admin_Controller {

     function __construct() {
        parent::__construct();
        $this->load->model('action');
        $this->load->library('upload');
    }

    public function index() {
        $this->data['meta_title'] = 'Product';
        $this->data['active'] = 'data-target="product_menu"';
        $this->data['subMenu'] = 'data-target="add-new"';
        $this->data['confirmation'] = null;

        //get all category
        $this->data['allCategory'] = $this->action->read('category');
        
        //get all subcategory
        $this->data['allSubcategory'] = $this->action->readGroupBy('subcategory', 'subcategory', array('trash' => 0));
        
        //get all brand
        $this->data['allBrand'] = $this->action->readGroupBy('brand', 'brand', array('trash' => 0));

        if ($this->input->post('product_add')) {
            $data = array(
                'product_name'   => $this->input->post('product_name'),
                'product_model'   => $this->input->post('product_model'),
                'product_code'   => $this->input->post('product_code'),
                'product_cat'    => $this->input->post('category'),
                'subcategory'    => $this->input->post('sub_category'),
                'brand'          => $this->input->post('brand'),
                'purchase_price' => $this->input->post('purchase_price'),
                'sale_price'     => $this->input->post('sale_price'),
                'dealer_sale_price' => $this->input->post('dealer_sale_price'),
                'unit'           => $this->input->post('unit'),
                'status'         => $this->input->post('status')
            );

            $exists_data = array('product_code'  => $this->input->post('product_code'));

            if($this->action->exists("products", $exists_data)){
                $options = array(
                    "title" => "warning",
                    "emit"  => "This Product already Exists!",
                    "btn"   => true
                );
              $this->data['confirmation'] = message("warning", $options);
            }else{
                $options = array(
                    "title" => "Success",
                    "emit"  => "Product Successfully Added!",
                    "btn"   => true
                );
                $this->data['confirmation'] = message($this->action->add("products", $data), $options);
           }
           
            $this->session->set_flashdata('confirmation',$this->data['confirmation']);
            redirect('product/product','refresh');
        }
        
        $this->load->view($this->data['privilege'] . '/includes/header', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/aside', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/headermenu', $this->data);
        $this->load->view('components/product/nav', $this->data);
        $this->load->view('components/product/add', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/footer');
    }

    public function allProduct() {
        $this->data['meta_title']   = 'Product';
        $this->data['active']       = 'data-target="product_menu"';
        $this->data['subMenu']      = 'data-target="all"';
        $this->data['confirmation'] = null;

        $this->load->view($this->data['privilege'] . '/includes/header', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/aside', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/headermenu', $this->data);
        $this->load->view('components/product/nav', $this->data);
        $this->load->view('components/product/view-all', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/footer',$this->data);
    }

    public function edit($id=null) {
        $this->data['meta_title']   = 'Product';
        $this->data['active']       = 'data-target="product_menu"';
        $this->data['subMenu']      = 'data-target="all"';
        $this->data['confirmation'] = null;

        $this->data['id'] = $id;
        $where = array('id' => $id );
        $this->data['allProduct'] = $this->action->read('products', $where);

        //get all category
        $this->data['allCategory'] = $this->action->read('category');
        
        //get all subcategory
        $this->data['allSubcategory'] = $this->action->readGroupBy('subcategory', 'subcategory', array('trash' => 0));
        
        //get all brand
        $this->data['allBrand'] = $this->action->readGroupBy('brand', 'brand', array('trash' => 0));

        if ($this->input->post('update')) {
            
            $data = [
                'product_name'   => $this->input->post('product_name'),
                'product_model'  => $this->input->post('product_model'),
                'product_cat'    => $this->input->post('category'),
                'subcategory'    => $this->input->post('sub_category'),
                'brand'          => $this->input->post('brand'),
                'purchase_price' => $this->input->post('purchase_price'),
                'sale_price'     => $this->input->post('sale_price'),
                'dealer_sale_price' => $this->input->post('dealer_sale_price'),
                'unit'           => $this->input->post('unit'),
                'status'         => $this->input->post('status')  
            ];
            
            $msg = [
                'title' =>'update',
                'emit'  =>'Product Successfully Updated!',
                'btn'   =>true
            ];
            
            // Update info in `stock` table
           $stock_data = array(
                'name'        => $this->input->post('product_name'),
                'category'    => $this->input->post('category'),
                'subcategory' => $this->input->post('sub_category'),
                'brand'          => $this->input->post('brand'),
                'sell_price'  => $this->input->post('sale_price'),
                'dealer_sale_price' => $this->input->post('dealer_sale_price')
            );
            
            
            $stock_where = array('code' => $this->input->post('product_code'));
            
            //dd($stock_where);
            $this->action->update('stock', $stock_data, $stock_where);
            // Update stock info end here
            
            $this->data['confirmation'] = message($this->action->update('products', $data, $where), $msg);
            $this->session->set_flashdata('confirmation', $this->data['confirmation']);
            redirect('product/product/allProduct', 'refresh');
        }

        $this->load->view($this->data['privilege'] . '/includes/header', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/aside', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/headermenu', $this->data);
        $this->load->view('components/product/nav', $this->data);
        $this->load->view('components/product/edit', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/footer');
    }


    public function delete($id = NULL){

        $where = array("id" =>$id);

        //$data = array("trash" => 1 );

        $msg_array=array(
            "title" =>"delete",
            "emit"  =>"Product Successfully Deleted",
            "btn"   =>true
        );

        $this->data['confirmation'] = message($this->action->deleteData('products',$where),$msg_array);
        $this->session->set_flashdata("confirmation",$this->data['confirmation']);

        redirect("product/product/allProduct","refresh");
    }
}
