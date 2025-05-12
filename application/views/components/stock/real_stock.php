<!-- Select Option 2 Stylesheet -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" />
<style>
    @media print{
        aside, nav, .none, .panel-heading, .panel-footer{display: none !important;}
        .panel{border: 1px solid transparent;left: 0px;position: absolute;top: 0px;width: 100%;}
        .hide{display: block !important;}
        .table.table-bordered tr th, .table.table-bordered tr td {
            padding: 1px 2px;
            font-size: 13px;
        }
    }
    .wid-100{width: 100px;}
    #loading{text-align: center;}
    #loading img{display: inline-block;}
    
</style>

<div class="container-fluid">
    <div class="row">

        <div class="panel panel-default none">

            <div class="panel-heading">
                <div class="panal-header-title pull-left">
                    <h1>Search Datewise Stock</h1>
                </div>
            </div>

            <div class="panel-body">
                <?php
                    echo $this->session->flashdata('deleted');
                    $attr = array("class" => "form-horizontal");
                    echo form_open("", $attr);
                    
                    if($this->data['privilege'] == 'super') {
                        $godown = 'yes';
                        $column = '2';
                    }else{
                        $godown = 'no';
                        $column = '3';
                    }
                ?>

                <div class="form-group">
                    
                    <?php if($godown == 'yes') { ?>
                    <div class="col-md-2">
                        <select name="godown_code" class="selectpicker form-control" data-show-subtext="true" data-live-search="true" >
                            <option value="" selected disabled>-- Select Showroom --</option>
                            <option value="all">All Showroom</option>
                            <?php if(!empty($allGodowns)){ foreach($allGodowns as $row){ ?>
                            <option value="<?php echo $row->code; ?>">
                                <?php echo filter($row->name)." ( ".$row->address." ) "; ?>
                            </option>
                            <?php } } ?>
                        </select>
                    </div>
                    <?php } ?>
                    
                    
                    <div class="col-md-2">
                        <select name="search[code]" class="selectpicker form-control" data-show-subtext="true" data-live-search="true">
                            <option value="" selected disabled>-- Select Name --</option>
                            <?php if($productInfo != null){ foreach($productInfo as $key => $row){ ?>
                            <option value="<?php echo $row->code; ?>">
                                <?php echo filter($row->product_model); ?>
                            </option>
                            <?php }} ?>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <select name="search[category]" class="selectpicker form-control" data-show-subtext="true" data-live-search="true">
                            <option value="" selected disabled>-- Category --</option>
                            <?php if($category != null){ foreach($category as $key => $row){ ?>
                            <option value="<?php echo $row->category; ?>">
                                <?php echo filter($row->category); ?>
                            </option>
                            <?php }} ?>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <select name="search[subcategory]" class="selectpicker form-control" data-show-subtext="true" data-live-search="true">
                            <option value="" selected disabled>-- Manufacturer --</option>
                            <?php if($subcategory != null){ foreach($subcategory as $key => $row){ ?>
                            <option value="<?php echo $row->subcategory; ?>">
                                <?php echo filter($row->subcategory); ?>
                            </option>
                            <?php }} ?>
                        </select>
                    </div>
                    
                    <div class="col-md-2">
                          <input type="date" name="from_date"  class="form-control" >
                    </div>
                    
                    
                    <div class="col-md-2">
                        <input type="date" name="to_date"  class="form-control" value="<?php echo date('Y-m-d'); ?>">
                    </div>
                    
                    
                    

                    <div class="btn-group">
                        <input type="hidden" name="report" value="init_stock">
                        <input type="submit" name="show" value="Show" class="btn btn-primary">
                    </div>
                </div>

                <?php echo form_close(); ?>
            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panal-header-title">
                    <h1 class="pull-left">Datewise Stock </h1>
                    <a class="btn btn-primery pull-right" style="font-size: 14px; margin-top: 0;" onclick="window.print()">
                        <i class="fa fa-print"></i> Print
                    </a>
                </div>
            </div>

            <div class="panel-body">
                <!-- Banner Start Here -->
                <?php $this->load->view('print', $this->data); ?>
                <!-- Banner End Here -->

                <h4 class="hide text-center" style="margin-top: 0px;">Stock</h4>
                 <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th style="width: 40px;">SL</th>
                            <th>Model</th>
                            <!--<th>Category</th>
                            <th>Subcategory</th>-->
                            <th>Opening<br>Stock</th>
                            <th>Purchase</th>
                            <th>Purchase<br>Return</th>
                            <th>Sale</th>
                            <th>Sale<br>Return</th>
                            <th>Current<br>Stock</th>
                            <th>Purchase Price</th>
                            <th>Sell Price</th>
                            <th>Amount</th>
                        </tr>
                        <?php 
                        $totalSellPrice = 0.00;
                        $total_pcs = 0.00;
                        $total_currnet_stock = 0;
                        $total_today_sale =0;
                        $total_today_sale_return =0;
                        $total_today_purchase =0;
                        $total_today_purchase_return =0;
                        $pack_size = null;
                        //print_r($result);
                        foreach ($result as $key => $value){ 
                       
                        $size = $this->action->read('products',array('product_code'=>$value->code));
                        if(!empty($size[0]->pack_size)){
                            $pack_size = ' ('.$size[0]->pack_size.')';
                        }else{
                            $pack_size = '';
                        }
                        ?>
                        
                        <style>.red{ color: red;}.blue{ color: #00A8FF;}</style>
                        <tr>
                            <td><?php echo $key+1; ?></td>
                            <td><?php echo filter($value->product_model);  ?></td>
                           <!-- <td><?php echo filter($value->category); ?></td>
                            <td><?php echo filter($value->subcategory); ?></td>-->
                            <td>
                                <?php
                                     
                                     if(!empty($_POST['from_date'])){
                                        $from = $_POST['from_date'];
                                     }else{
                                         $from = '2010-01-01';
                                     }
                                     
                                     
                                     if(!empty($_POST['to_date'])){
                                        $to = $_POST['to_date'];
                                     }else{
                                         $to = date('Y-m-d');
                                     }     
                                    
                                     
                                     // until yesterday total purchase productwise
                                     
                                     $until_yesterday_purchase_qty = [];
                                     if(!empty($_POST['godown_code']) && ($_POST['godown_code'] != 'all')){
                                          $until_yesterday_purchase_qty = $this->action->read_sum('sapitems','quantity',array('product_code' =>$value->code,'sap_at >=' => $from,'sap_at <=' => $to,'status' => 'purchase','godown_code'=> $_POST['godown_code'],'trash'=> 0));
                                     }else{
                                           $until_yesterday_purchase_qty = $this->action->read_sum('sapitems','quantity',array('product_code' =>$value->code,'sap_at >=' => $from,'sap_at <=' => $to,'status' => 'purchase','trash'=> 0));
                                     }
                                     
  
                                     if(!empty($until_yesterday_purchase_qty)){
                                         $until_yesterday_purchase_qty = $until_yesterday_purchase_qty[0]->quantity;
                                     }else{
                                         $until_yesterday_purchase_qty = 0;
                                     }
                                     
                                    
                                     // until yesterday total purchase return purchase productwise
                                     $until_yesterday_purchase_return_qty = [];
                                     if(!empty($_POST['godown_code']) && ($_POST['godown_code'] != 'all')){
                                           $until_yesterday_purchase_return_qty = $this->action->read_sum('purchase_return','quantity',array('product_code' =>$value->code,'date >=' => $from,'date <=' => $to,'godown_code'=> $_POST['godown_code']));
                                     }else{
                                           $until_yesterday_purchase_return_qty = $this->action->read_sum('purchase_return','quantity',array('product_code' =>$value->code,'date >=' => $from,'date <=' => $to));
                                     }
                                     
                                     
                                     $until_yesterday_purchase_return_qty = [];
                                     if(!empty($until_yesterday_purchase_return_qty)){
                                         $until_yesterday_purchase_return_qty = $until_yesterday_purchase_return_qty[0]->quantity;
                                     }else{
                                         $until_yesterday_purchase_return_qty = 0;
                                     }
                                    
                                    
                                     // until yesterday total sale productwise
                                     $until_yesterday_sale_qty = [];
                                     if(!empty($_POST['godown_code']) && ($_POST['godown_code'] != 'all')){
                                        $until_yesterday_sale_qty = $this->action->read_sum('sapitems','quantity',array('product_code'=>$value->code,'sap_at >=' => $from,'sap_at <=' => $to,'status' => 'sale','trash'=> 0,'godown_code'=> $_POST['godown_code']));
                                     }else{
                                        $until_yesterday_sale_qty = $this->action->read_sum('sapitems','quantity',array('product_code'=>$value->code,'sap_at >=' => $from,'sap_at <=' => $to,'status' => 'sale','trash'=> 0)); 
                                     }
                                     
                                     if(!empty($until_yesterday_sale_qty)){
                                         $until_yesterday_sale_qty = $until_yesterday_sale_qty[0]->quantity;
                                     }else{
                                         $until_yesterday_sale_qty = 0;
                                     }
                                     
                                     
                                     // until yesterday total sale return purchase productwise
                                     $until_yesterday_sale_return_qty = [];
                                     if(!empty($_POST['godown_code']) && ($_POST['godown_code'] != 'all')){
                                          $until_yesterday_sale_return_qty = $this->action->read_sum('sale_return','quantity',array('product_code' =>$value->code,'date >=' => $from,'date <=' => $to,'trash'=> 0,'godown_code'=> $_POST['godown_code']));
                                     }else{
                                          $until_yesterday_sale_return_qty = $this->action->read_sum('sale_return','quantity',array('product_code' =>$value->code,'date >=' => $from,'date <=' => $to,'trash'=> 0));
                                     }
                                     
                                     if(!empty($until_yesterday_sale_return_qty)){
                                         $until_yesterday_sale_return_qty = $until_yesterday_sale_return_qty[0]->quantity;
                                     }else{
                                         $until_yesterday_sale_return_qty = 0;
                                     }
                                     
                                     
                                    /* echo 'pq='.$until_yesterday_purchase_qty.'<br>';
                                     echo 'sq='.$until_yesterday_sale_qty.'<br>';
                                     echo 'iq='.$value->initial_stock.'<br>';
                                     echo 'prq='.$until_yesterday_purchase_return_qty.'<br>';
                                     echo 'srq='.$until_yesterday_sale_return_qty.'<br>';*/
                                     
                                     
                                     $opening_stock = 0;
                                     if($from == '2010-01-01'){
                                       $opening_stock = 0;
                                     }else{
                                          $opening_stock = $until_yesterday_purchase_qty - $until_yesterday_sale_qty  -$until_yesterday_purchase_return_qty +$until_yesterday_sale_return_qty;
                                     }
                                    
                                     echo $opening_stock;
                                ?>
                            </td>
                            
                            <td>
                                <?php
                                     // today total purchase productwise
                                     
                                     if(!empty($_POST['godown_code']) && ($_POST['godown_code'] != 'all')){
                                         $today_purchase_qty = $this->action->read_sum('sapitems','quantity',array('product_code' =>$value->code,'sap_at >=' => $from,'sap_at <=' => $to,'status' => 'purchase','godown_code'=> $_POST['godown_code'],'trash'=> 0));
                                     }else{
                                         $today_purchase_qty = $this->action->read_sum('sapitems','quantity',array('product_code' =>$value->code,'sap_at >=' => $from,'sap_at <=' => $to,'status' => 'purchase','trash'=> 0));
                                     }
                                     
                                     
                                     
                                     if(!empty($today_purchase_qty)){
                                         $today_purchase_qty = $today_purchase_qty[0]->quantity;
                                     }else{
                                         $today_purchase_qty = 0;
                                     }
                                     
                                    
                                     // today total sale productwise
                                     if(!empty($_POST['godown_code']) && ($_POST['godown_code'] != 'all')){
                                        $today_sale_qty = $this->action->read_sum('sapitems','quantity',array('product_code'=>$value->code,'sap_at >=' => $from,'sap_at <=' => $to,'status' => 'sale','godown_code'=> $_POST['godown_code'],'trash'=> 0));
                                     }else{
                                        $today_sale_qty = $this->action->read_sum('sapitems','quantity',array('product_code'=>$value->code,'sap_at >=' => $from,'sap_at <=' => $to,'status' => 'sale','trash'=> 0));
                                     }     
                                    
                                    if(!empty($today_sale_qty)){
                                         $today_sale_qty = $today_sale_qty[0]->quantity;
                                     }else{
                                         $today_sale_qty = 0;
                                     }
                                     
                                     echo $today_purchase_qty;
                                     
                                ?>
                                
                            </td>
                            <td>
                                <?php
                                     
                                     
                                     // today total purchase return purchase productwise
                                         
                                     if(!empty($_POST['godown_code']) && ($_POST['godown_code'] != 'all')){
                                        $today_purchase_return_qty = $this->action->read_sum('purchase_return','quantity',array('product_code' =>$value->code,'date >=' => $from,'date <=' => $to,'godown_code'=> $_POST['godown_code']));
                                     }else{
                                        $today_purchase_return_qty = $this->action->read_sum('purchase_return','quantity',array('product_code' =>$value->code,'date >=' => $from,'date <=' => $to));
                         
                                     }
                                     
                                     if(!empty($today_purchase_return_qty)){
                                         $today_purchase_return_qty = $today_purchase_return_qty[0]->quantity;
                                     }else{
                                         $today_purchase_return_qty = 0;
                                     }
                                     
                                     echo $today_purchase_return_qty;
                                     
                                     
                                ?>
                            </td>
                            <td>
                                <?php  echo $today_sale_qty; ?>
                            </td>
                            <td>
                                <?php
                                     
                                     
                                     // today total sale return purchase productwise
                                     if(!empty($_POST['godown_code']) && ($_POST['godown_code'] != 'all')){
                                        $today_sale_return_qty = $this->action->read_sum('sale_return','quantity',array('product_code' =>$value->code,'date >=' => $from,'date <=' => $to,'godown_code'=> $_POST['godown_code']));
                                     }else{
                                        $today_sale_return_qty = $this->action->read_sum('sale_return','quantity',array('product_code' =>$value->code,'date >=' => $from,'date <=' => $to));                                          
                                     }
                                     
                                     if(!empty($today_sale_return_qty)){
                                         $today_sale_return_qty = $today_sale_return_qty[0]->quantity;
                                     }else{
                                         $today_sale_return_qty = 0;
                                     }
                                     
                                     echo $today_sale_return_qty;
                                     
                                     
                                ?>
                                
                            </td>
                            <td>
                                <?php
                                    $current_stock = $opening_stock + $today_purchase_qty -$today_sale_qty -$today_purchase_return_qty +$today_sale_return_qty;
                                    
                                    if($current_stock != $value->quantity){
                                        echo '<span style="color:red">'.$current_stock.'</span>';
                                    }else{
                                        echo $current_stock;
                                    }
                                ?>
                            </td>
                            <td>
                            <?php 
                                echo $value->purchase_price;
                            ?>
                            </td>
                            
                            <td>
                            <?php
                                echo $value->sell_price;
                            ?>
                            </td>
                            
                            <td>
                            <?php
                                
                                $sell =  ($value->purchase_price * $current_stock); 
                                    echo $sell;
                            ?>
                            </td>
                            
                        </tr>
                        <?php 
                            $totalSellPrice += $sell;
                            
                            $total_currnet_stock += $current_stock;
                            $total_today_sale += $today_sale_qty;
                            $total_today_sale_return += $today_sale_return_qty;
                            $total_today_purchase += $today_purchase_qty;
                            $total_today_purchase_return += $today_purchase_return_qty;
                            
                        } ?>
                        <tr>
                            <td colspan="2"><b class="pull-right">Total </b></td>
                            <td></td>
                            <td><?php echo $total_today_purchase;  ?></td>
                            <td><?php echo $total_today_purchase_return;  ?></td>
                            <td><?php echo $total_today_sale;  ?></td>
                            <td><?php echo $total_today_sale_return;  ?></td>
                            <td><?php echo $total_currnet_stock;  ?></td>
                            <td></td>
                            <td></td>
                            <td><b><?php echo $totalSellPrice.' TK'; ?></b></td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>
<!-- Select Option 2 Script -->

<script type="text/javascript">
  $(document).ready(function(){
    $('#datetimepicker').datetimepicker({
      format: 'YYYY-MM-DD'
    });
    
    $('#datetimepickerTo').datetimepicker({
      format: 'YYYY-MM-DD'
    });
    
    
  });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>