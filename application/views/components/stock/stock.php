<!-- Select Option 2 Stylesheet -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" />
<style>
    @media print{
        aside, nav, .none, .panel-heading, .panel-footer{display: none !important;}
        .panel{border: 1px solid transparent;left: 0px;position: absolute;top: 0px;width: 100%;}
        .hide{display: block !important;}
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
                    <h1>Search Stock</h1>
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
                    <div class="col-md-3">
                        <select name="godown_code" class="form-control">
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
                    
                    <div class="col-md-3">
                        <select name="search[code]" class="selectpicker form-control" data-show-subtext="true" data-live-search="true">
                            <option value="" selected disabled>-- Select Name --</option>
                            <?php if($productInfo != null){ foreach($productInfo as $key => $row){ ?>
                            <option value="<?php echo $row->code; ?>">
                                <?php echo filter($row->name) .' - '. $row->product_model; ?>
                            </option>
                            <?php }} ?>
                        </select>
                    </div>

                    <div class="col-md-<?php echo $column; ?>">
                        <select name="search[category]" class="selectpicker form-control" data-show-subtext="true" data-live-search="true">
                            <option value="" selected disabled>-- Category --</option>
                            <?php if($category != null){ foreach($category as $key => $row){ ?>
                            <option value="<?php echo $row->category; ?>">
                                <?php echo filter($row->category); ?>
                            </option>
                            <?php }} ?>
                        </select>
                    </div>
                    <div class="col-md-<?php echo $column; ?>">
                        <select name="search[subcategory]" class="selectpicker form-control" data-show-subtext="true"
                                data-live-search="true">
                            <option value="" selected>-- Select Subcategory --</option>
                            <?php
                            if (!empty($subcategory)) {
                                foreach ($subcategory as $row) {
                                    echo '<option value="' . $row->subcategory . '"> ' . $row->subcategory . ' </option>';
                                }
                            } ?>
                        </select>
                    </div>
                    <div class="col-md-<?php echo $column; ?>">
                        <select name="search[brand]" class="selectpicker form-control" data-show-subtext="true" data-live-search="true">
                            <option value="" selected disabled>-- Brand  Name--</option>
                            <?php if($brand != null){ foreach($brand as $key => $row){ ?>
                            <option value="<?php echo $row->brand; ?>">
                                <?php echo filter($row->brand); ?>
                            </option>
                            <?php }} ?>
                        </select>
                    </div>

                    
                </div>
                <div class="form-group">
                    <div class="col-md-3">
                    <div class="btn-group mt-3">
                        <input type="submit" name="show" value="Show" class="btn btn-primary">
                    </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panal-header-title">
                    <h1 class=" pull-left">Stock
                        <?php 
                             $code = $this->input->post('godown_code');
                            if($code !='' && $code !='all'){
                                echo '-';
                                echo get_name('godowns','name',array('code' => $code));
                            }
                        ?>
                    </h1>
                    <a class="btn btn-primery pull-right" style="font-size: 14px; margin-top: 0;" onclick="window.print()"><i class="fa fa-print"></i> Print</a>
                </div>
            </div>

            <div class="panel-body">
                <!-- Print banner -->
                <!-- <img class="img-responsive print-banner hide" src="<?php // echo site_url($banner_info[0]->path); ?>" > -->
                <?php $this->load->view('print', $this->data); ?>
                <?php if(!empty($result)){ ?>
                <h4 class="hide text-center" style="margin-top: 0px;">
                    Stock  
                    <?php 
                         $code = $this->input->post('godown_code');
                        if($code !='' && $code !='all'){
                            echo '-';
                            echo get_name('godowns','name',array('code' => $code));
                        }
                    ?> 
                </h4>
                <table class="table table-bordered">
                    <tr>
                        <th style="width: 40px;">SL</th>
                        <!-- <th>Name</th> -->
                        <th>Model</th>
                        <th width="135">Category</th>
                        <th>Subcategory</th>
                        <th>Brand</th>
                        <th width="70">Qty.</th>
                        <th>Purchase Price</th>
                        <th>Sell Price</th>
                        <th>Purchase Amount</th>
                        <th>Sell Amount</th>
                        <?php if(checkAuth('super')) { ?>
                        <th width="130" class="none">Showroom</th>
                        <?php } ?>
                    </tr>
                    <?php 
                    $totalSellPrice = $totalAmount = $totalPurchasePrice = 0.00;
                    $total_pcs = 0.00;
                    $total_purchase_amount = $total_sale_amount = 0;
                    foreach ($result as $key => $value){ 
                        //if($value->quantity > 0){
                        
                            $purchase =  ($value->purchase_price * $value->quantity);  
                            $sell =  ($value->sell_price * $value->quantity);  
                    ?>
                    <style>.red{ color: red; font-weight:bold; }</style>
                    <tr>
                        <td><?php echo $key+1; ?></td>
                        <!-- <td><?php // echo filter($value->name); ?></td> -->
                        <td><?php echo $value->product_model; ?></td>
                        <td><?php echo filter($value->category); ?></td>
                        <td><?php echo filter($value->subcategory); ?></td>
                        <td><?php echo filter($value->brand); ?></td>
                        <td <?php if($value->quantity < 10){ echo "class='red'";}; ?>><?php echo $value->quantity . " " . $value->unit; $total_pcs += $value->quantity; ?></td>
                        <td><?php echo $value->purchase_price; ?></td>
                        <td><?php echo $value->sell_price; ?></td>
                        <td><?php echo $purchase; $total_purchase_amount += $purchase; ?></td>
                        <td><?php echo $sell; $total_sale_amount += $sell; ?></td>
                        <?php if(checkAuth('super')) { ?>
                         <td class="none"><?php echo filter($value->godown_name); ?></td>
                        <?php  ?>
                    </tr>
                    <?php 
                        $totalPurchasePrice += $value->purchase_price;
                        $totalSellPrice += $value->sell_price;
                    } } ?>
                    <tr>
                        <td colspan="5"><b class="pull-right">Total  </b></td>
                        <td><b><?php echo $total_pcs.' '; ?></b></td>
                        <td>&nbsp;</td>
                        <td><b><?php //echo $totalPurchasePrice.' TK'; ?></b></td>
                        <td><b><?php echo $total_purchase_amount.' TK'; ?></b></td>
                        <td><b><?php echo $total_sale_amount.' TK'; ?></b></td>
                        <td class="none">&nbsp;</td>
                    </tr>
                </table>
                <?php } else {
                    echo '<p class="text-center"> <strong> No data found! </strong> </p>';
                }?>
            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>
<!-- Select Option 2 Script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>