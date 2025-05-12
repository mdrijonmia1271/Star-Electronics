<script src="<?php echo site_url('private/js/ngscript/stockTransfer.js?').time(); ?>"></script>
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" />
<style>
    .table2 tr td {
        padding: 0 !important;
    }

    .table2 tr td input {
        border: 1px solid transparent;
    }

    .new-row-1 .col-md-4 {
        margin-bottom: 8px;
    }

    .red,
    .red:focus {
        border-color: red;
    }

    .green,
    .green:focus {
        border-color: green;
    }
</style>
<div class="container-fluid" ng-controller="stockTransfer" ng-cloak>
    <div class="row">
        <?php echo $confirmation; ?>
        <div class="panel panel-default">
            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1>Stock Transfer</h1>
                </div>
            </div>
            <div class="panel-body">
                <!-- horizontal form -->
                <?php
                $attr = array("class" => "form-horizontal");
                echo form_open('', $attr);
                ?>


                <div class="row new-row-1">
                    
                    <div class="col-md-3">
                        <div class="input-group date" id="datetimepicker">
                            <input type="text" name="date" class="form-control" <?php echo ($this->session->userdata['privilege']=='user' ? 'readonly' : ' '); ?> value="<?php echo date('Y-m-d');?>"
                                placeholder="Date" required>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <select class="form-control" name="godown_code_from" ng-model="godown_code_from"  required>
                            <option value="" selected disabled>-- Showroom From--</option>
                            <?php if (!empty($allGodowns)) {
                                foreach ($allGodowns as $row) { ?>
                                    <option value="<?php echo $row->code; ?>">
                                        <?php echo filter($row->name); ?>
                                    </option>
                                <?php }
                            } ?>
                        </select>
                    </div>
                    
                    <div class="col-md-3">
                        <select class="form-control" name="godown_code_to"  required>
                            <option value="" selected disabled>-- Showroom To --</option>
                            <?php if (!empty($allGodowns)) {
                                foreach ($allGodowns as $row) { ?>
                                    <option value="<?php echo $row->code; ?>">
                                        <?php echo filter($row->name); ?>
                                    </option>
                                <?php }
                            } ?>
                        </select>
                    </div>
                    
                    <div class="col-md-3">
                        <select name="product_from" class="selectpicker form-control" data-show-subtext="true"
                            data-live-search="true" ng-model="product" ng-change="addNewProductFn()" required>
                            <option value="" selected disabled>-- Select Product --</option>
                            <?php if(!empty($allStock)){ foreach($allStock as $key => $row){ ?>
                            <option value="<?php echo $row->code; ?>">
                                <?php echo filter($row->product_model); ?>
                            </option>
                            <?php }} ?>
                        </select>
                    </div>
                    
                    </div>
                    
                <hr>
                <table class="table table-bordered table2">
                    <tr>
                        <th width="45px">SL</th>
                        <th>Product Name</th>
                        <th>Model</th>
                        <th>Stock Quantity</th>
                        <th width="100">Qty</th>
                        <th width="60">Action</th>
                    </tr>
                    <tr ng-repeat="item in cart">
                        <td style="padding: 6px 8px !important;">{{ $index + 1 }}</td>
                        <td style="padding: 6px 8px !important; background-color: #eee;">
                            {{item.product_cat | textBeautify}}
                        </td>

                        <td>
                            <input type="text" name="product_model[]" class="form-control" ng-model="item.product_model"
                                readonly>
                            <input type="hidden" name="product[]" class="form-control" ng-value="item.product" readonly>
                            <input type="hidden" name="product_code[]" ng-value="item.product_code">
                            <input type="hidden" name="product_cat[]" ng-value="item.product_cat">
                            <input type="hidden" name="product_subcat[]" ng-value="item.product_subcat">
                            <input type="hidden" name="product_brand[]" ng-value="item.product_brand">
                            <input type="hidden" name="unit[]" class="form-control" ng-value="item.unit">
                            <input type="hidden" name="purchase_price[]" class="form-control" min="0" ng-value="item.price" step="any">
                            <input type="hidden" name="sale_price[]" class="form-control" ng-value="item.sale_price">
                            <input type="hidden" name="total_qty" class="form-control" ng-value="getTotalFn()">
                        </td>
                       
                        <td>
                            <input type="number" class="form-control" 
                                ng-model="item.stock_qty" readonly>
                        </td> 
                        
                        <td>
                            <input type="number" name="quantity[]" class="form-control" min="1"
                                ng-model="item.quantity">
                        </td>

                        <td class="text-center">
                            <a title="Delete" class="btn btn-danger" ng-click="deleteItemFn($index)">
                                <i class="fa fa-times fa-lg"></i>
                            </a>
                        </td>
                    </tr>
                </table>
                
                <div class="btn-group pull-right">
                    <input type="submit" name="save" value="Save" class="btn btn-primary">
                </div>
                <?php echo form_close(); ?>
            </div>
            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
<script>
    // linking between two date
    $('#datetimepicker').datetimepicker({
        format: 'YYYY-MM-DD',
    });
</script>