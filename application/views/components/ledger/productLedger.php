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
                    <h1>Product Ledger</h1>
                </div>
            </div>

            <div class="panel-body" ng-controller="allSaleCtrl" ng-cloak>
                <?php
                echo $this->session->flashdata('deleted');
                $attr = array("class" => "form-horizontal");
                echo form_open("", $attr);
                
                ?>

                <div class="form-group">
                    
                    <div class="col-md-2">
                        <select name="godown_code" id="godown_code"  class="form-control">
                            <option value="" selected >-- Select Showroom --</option>
                            <option value="all">All Showroom</option>
                            <?php 
                                $allGodowns = $this->action->read('godowns');
                                if(!empty($allGodowns)){ foreach($allGodowns as $row){
                            ?>
                            <option value="<?php echo $row->code; ?>">
                                <?php echo filter($row->name)." ( ".$row->address." ) "; ?>
                            </option>
                            <?php } } ?>
                        </select>
                    </div>
                    
                     <div class="col-md-3">
                        <select ui-select2="{ allowClear: true}" ng-model='category' ng-change="getAllProducts()" class="form-control" data-placeholder="Select Category">
                            <option value="" selected disabled></option>
                            <?php if(!empty($category)){ 
                                foreach($category as $key => $value ){ ?>
                                    <option value="<?php echo $value->category; ?>"><?php echo filter($value->category); ?></option>
                            <?php }} ?>
                        </select>
                    </div>
                    
                    <div class="col-md-2">
                        <select name="search[product_code]" ui-select2="{ allowClear: true}" class="form-control" ng-model='product_code' ng-change="addNewProductFn()" data-placeholder="Select Product"  required>
                            <option value="" selected disable> </option>
                            <option ng-repeat="product in productList" value="{{product.code}}">{{product.product_model}}</option>
                        </select>
                    </div>
                    

                    <div class="col-md-2">
                        <div class="input-group date" id="datetimepickerSMSFrom">
                            <input type="text" name="from" class="form-control"   placeholder="From">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>


                    <div class="col-md-2">
                        <div class="input-group date" id="datetimepickerSMSTo">
                            <input type="text" name="to" class="form-control"   placeholder="To">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>


                    <div class="btn-group">
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
                    <h1 class=" pull-left">Search Product Ledger (<?php if(!empty($_POST['search']['product_code'])){ echo get_name('products','product_model',['product_code' => $_POST['search']['product_code']]); } ?> )</h1>
                    <a class="btn btn-primery pull-right" style="font-size: 14px; margin-top: 0;" onclick="window.print()"><i class="fa fa-print"></i> Print</a>
                </div>
            </div>

            <div class="panel-body">
                <?php if(!empty($result)){ ?>
                <h4 class="hide text-center" style="margin-top: 0px;">
                     Product Ledger
                </h4>
                 <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th style="width: 40px;">SL</th>
                            <th>Date</th>
                            <th>Voucher No</th>
                            <th>Details</th>
                            <th>Stock Quantity</th>

                            <th>PQ</th>
                            <th>SQ</th>
                            <th>PRQ</th>
                            <th>SRQ</th>
                            <th>Stock</th>
                        </tr>
                        <?php 
                        $total_qty = 0;
                        $total_purchase_qty = $total_sale_qty = $total_pur_ret_qty = $total_sal_ret_qty = 0;
                        foreach ($result as $key => $value){ 
                           
                        ?>
                            <tr>
                                <td><?php echo $key+1; ?></td>
                                <td><?php echo $value->sap_at;  ?></td>
                                <td><?php echo $value->voucher_no; ?></td>
                                <td>
                                    <?php 
                                        if($value->sap_type == 'cash'){
                                            echo get_name('saprecords','party_code',['voucher_no' => $value->voucher_no]);
                                        }else{
                                            $party_code = get_name('saprecords','party_code',['voucher_no' => $value->voucher_no]);
                                            echo get_name('parties','name',['code' => $party_code]);
                                        }
                                    ?>
                                </td>

                                 <?php  
                                        if($value->status == 'purchase'){
                                             $total_qty += $value->quantity;
                                        }
                                        if($value->status == 'sale'){
                                             $total_qty -= $value->quantity;
                                        }
                                        
                                        
                                ?>
                                
                                
                                 <td>
                                    <input type="number" class="form-control" 
                                        ng-model="item.stock_qty" readonly>
                                </td> 
                                
                                <td> <?php if($value->status == 'purchase'){ echo number_format($value->quantity,0); $total_purchase_qty += $value->quantity; } ?> </td>
                                <td> <?php if($value->status == 'sale'){ echo number_format($value->quantity,0); $total_sale_qty += $value->quantity; } ?> </td>
                                <td></td>
                                <td></td>
                                <td> <?php echo $total_qty; ?></td>
                            </tr>
                        <?php } ?>
                        
                        
                        
                        <?php
                            if(!empty($PurchaseReturnresult)){ 
                                foreach ($PurchaseReturnresult as $key => $pr_value){ 
                        
                            ?>
                                <tr>
                                    <td><?php echo $key+1; ?></td>
                                    <td><?php echo $pr_value->date;  ?></td>
                                    <td><?php echo $pr_value->voucher_no; ?></td>
                                    <td>
                                        <?php 
                                            if(!empty($pr_value->party_code)){
                                                echo get_name('parties','name',['code' => $pr_value->party_code]);
                                            }    
                                           
                                        ?>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <?php  
                                            $total_pur_ret_qty += $pr_value->quantity;
                                            echo $pr_value->quantity;;
                                            
                                        ?>
                                    </td>
                                    <td></td>
                                     <td>
                                        <?php  
                                            $total_qty -= $pr_value->quantity;
                                            echo $total_qty;
                                            
                                        ?>
                                    </td>    
                                </tr>
                            <?php }} ?>
                            
                            
                         <?php
                            if(!empty($SaleReturnresult)){ 
                                foreach ($SaleReturnresult as $key => $sr_value){ 
                        
                            ?>
                                <tr>
                                    <td><?php echo $key+1; ?></td>
                                    <td><?php echo $sr_value->date;  ?></td>
                                    <td><?php echo $sr_value->return_no; ?></td>
                                    <td>
                                        <?php 
                                            if(!empty($sr_value->party_code)){
                                                echo get_name('parties','name',['code' => $sr_value->party_code]);
                                            }    
                                           
                                        ?>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><?php $total_sal_ret_qty += $sr_value->quantity;echo number_format($sr_value->quantity,0);  ?></td>
                                    <td>
                                        <?php  
                                            $total_qty += $sr_value->quantity;
                                            echo number_format($total_qty,0);
                                            
                                        ?>
                                    </td>
                                </tr>
                            <?php }} ?>                            
                        
                        <tr>
                            <td colspan="4"><b class="pull-right">Total  </b></td>
                            <td><b><?php echo $total_purchase_qty; ?></b></td>
                            <td><b><?php echo $total_sale_qty; ?></b></td>
                            <td><b><?php echo $total_pur_ret_qty; ?></b></td>
                            <td><b><?php echo $total_sal_ret_qty; ?></b></td>
                            <td><b><?php echo $total_qty; ?></b></td>

                        </tr>
                    </table>
                </div>
                <?php  } else {
                    echo '<p class="text-center"> <strong> No data found! </strong> </p>';
                }?>
            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>
<!-- Select Option 2 Script -->
<script>
    app.controller('allSaleCtrl',function($scope, $http){
    
    // Get product list in gorup by
        $scope.productList = [];
        
        
        $scope.$watch('category', function (godown_code){
            var where = {
                table: "stock",
                cond: {
                    'category': $scope.category,
                },
                select: ['code', 'product_model']
            }
            $http({
                method: "POST",
                url: url + "result",
                data: where
            }).success(function(response){
                if(response.length > 0){
                    $scope.productList = response;
                }else{
                    $scope.productList = [];
                }
            });
        });
    
    });
</script>




<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
<script>
// linking between two date
$('#datetimepickerSMSFrom').datetimepicker({
    format: 'YYYY-MM-DD',
    useCurrent: false
});
$('#datetimepickerSMSTo').datetimepicker({
    format: 'YYYY-MM-DD',
    useCurrent: false
});
$("#datetimepickerSMSFrom").on("dp.change", function (e) {
    $('#datetimepickerSMSTo').data("DateTimePicker").minDate(e.date);
});
$("#datetimepickerSMSTo").on("dp.change", function (e) {
    $('#datetimepickerSMSFrom').data("DateTimePicker").maxDate(e.date);
});
</script>