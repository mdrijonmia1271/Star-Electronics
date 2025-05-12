<script src="<?php echo site_url('private/js/ngscript/productEditCtrl.js') ?>"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" />

<div class="container-fluid" ng-init="id='<?php echo $id;?>';" ng-model="id">
    <div class="row" ng-controller="productEditCtrl" ng-cloak>
        <?php echo $this->session->flashdata('confirmation'); ?>
        <div class="panel panel-default">
            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1>Edit Product</h1>
                </div>
            </div>
            <div class="panel-body">
                <?php $attr = array('class' => 'form-horizontal');
                echo form_open('', $attr); ?>
                
                <input type="hidden" name="product_code" ng-value="product.product_code" class="form-control" readonly>
                <input type="hidden" name="product_name" value="" class="form-control">
                <!-- <div class="form-group">
                    <label class="col-md-2 control-label">Product Name </label>
                    <div class="col-md-5">
                        <input type="text" name="product_name" ng-value="product.product_name" class="form-control" required>
                    </div>
                </div> -->
                
                <div class="form-group">
                    <label class="col-md-2 control-label">Product Model </label>
                    <div class="col-md-5">
                        <input type="text" name="product_model" ng-value="product.product_model" class="form-control" required>
                    </div>
                </div>
                
                <!--<div class="form-group">
                    <label class="col-md-2 control-label">Category<span class="req">*</span></label>
                    <div class="col-md-5">
                        <select name="category" ng-model="category" ng-change="getAllSubcategory()" class="form-control">
                            <option value="" disabled selected> &nbsp;</option>
                            <?php if($allCategory != null){ foreach ($allCategory as $key => $value) { ?>
                            <option value="<?php echo $value->category; ?>" > <?php echo filter($value->category); ?></option>
                            <?php } } ?>
                        </select>
                    </div>
                </div>-->
                
                <div class="form-group">
                    <label class="col-md-2 control-label">Category<span class="req">*</span></label>
                    <div class="col-md-5">
                        <select name="category" class="selectpicker form-control" data-show-subtext="true" data-live-search="true">
                            <option value="" disabled selected> &nbsp;</option>
                            <?php if($allCategory != null){ foreach ($allCategory as $key => $value) { ?>
                            <option <?php if($value->category == $allProduct[0]->product_cat){echo 'selected';} ?> value="<?php echo $value->category; ?>" > <?php echo filter($value->category); ?></option>
                            <?php } } ?>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-md-2 control-label">Subcategory<span class="req">*</span></label>
                    <div class="col-md-5">
                        <select name="sub_category" class="selectpicker form-control" data-show-subtext="true" data-live-search="true">
                            <option value="" disabled selected> &nbsp;</option>
                            <?php if($allSubcategory != null){ foreach ($allSubcategory as $key => $value) { ?>
                            <option <?php if($value->subcategory == $allProduct[0]->subcategory){echo 'selected';} ?> value="<?php echo $value->subcategory; ?>" > <?php echo filter($value->subcategory); ?></option>
                            <?php } } ?>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-md-2 control-label">Brand<span class="req">*</span></label>
                    <div class="col-md-5">
                        <select name="brand" class="selectpicker form-control" data-show-subtext="true" data-live-search="true">
                            <option value="" disabled selected> &nbsp;</option>
                            <?php if($allBrand != null){ foreach ($allBrand as $key => $value) { ?>
                            <option <?php if($value->brand == $allProduct[0]->brand){echo 'selected';} ?> value="<?php echo $value->brand; ?>" > <?php echo filter($value->brand); ?></option>
                            <?php } } ?>
                        </select>
                    </div>
                </div>

                <!--<div class="form-group">
                    <label class="col-md-2 control-label">Brand<span class="req"> *</span></label>
                    <div class="col-md-5">
                        <select name="sub_category" ng-model="subcategory" class="form-control" required>
                            <option ng-repeat="row in allSubCategory" value="{{ row.subcategory }}">{{ row.subcategory | removeUnderScore}}</option>
                        </select>
                    </div>
                </div>-->
                
                
                <div class="form-group">
                    <label class="col-md-2 control-label">Purchase Price</label>
                    <div class="col-md-5 input-group">
                        <input type="number" name="purchase_price" min="0" ng-value="product.purchase_price" class="form-control" step="any">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Sale Price </label>
                    <div class="col-md-5 input-group">
                        <input type="number" name="sale_price" min="0" ng-value="product.sale_price"  class="form-control" step="any">
                    </div>
                </div>
                
                 <div class="form-group">
                    <label class="col-md-2 control-label">Dealer Sale Price </label>
                    <div class="col-md-5 input-group">
                        <input type="number" name="dealer_sale_price" min="0" ng-value="product.dealer_sale_price"  class="form-control" step="any">
                    </div>
                </div>
                
                
                <div class="form-group">
                    <label class="col-md-2 control-label">Unit</label>
                    <div class="col-md-5 input-group">
                        <select name="unit" class="form-control" ng-model="unit" required>
                            <?php foreach(config_item('unit') as $key=> $value) { ?>
                            <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Status </label>
                    <div class="col-md-5">
                        <label class="radio-inline">
                            <input type="radio" name="status" ng-model="status" value="available" ng-checked="status=='available'"> Available
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="status" ng-model="status" value="notavailable" ng-checked="status=='notavailable'"> Not Available
                        </label>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="btn-group pull-right">
                        <input type="submit" value="Update " name="update" class="btn btn-primary">
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
