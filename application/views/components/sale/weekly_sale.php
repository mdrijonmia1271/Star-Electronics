<script src="<?php echo site_url('private/js/ngscript/hireSaleEntryCtrl.js?'.time()); ?>"></script>
<style>
  .table2 tr td {
    padding: 0 !important;
  }
  .table2 tr td input {
    border: 1px solid transparent;
  }
  input[type=number]::-webkit-inner-spin-button,
  input[type=number]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }
  input[type=number] {
    -moz-appearance: textfield;
  }
</style>
<div class="container-fluid" ng-controller="hireSaleEntryCtrl">
  <div class="row">
    <?php echo $confirmation; ?>
    <div class="panel panel-default">
      <div class="panel-heading panal-header">
        <div class="panal-header-title pull-left">
          <h1>Add Weekly Sale</h1>
        </div>
        <div class="panal-header-title pull-left">
          <p class="hide" style="color: red;font-weight:bold; margin-left: 25px;">
            <?php echo ($last_voucher)? "Last voucher: ".$last_voucher[0]->voucher_no : " " ;?></p>
        </div>
      </div>
      <div class="panel-body" ng-cloak>

        <!-- horizontal form -->
        <?php
        $attr = array('class' => 'form-horizontal');
        echo form_open('', $attr);
        ?>

        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                  <div class="col-md-12">
                    <div class="input-group date" id="datetimepicker">
                      <input type="text" name="date" value="<?php echo date("Y-m-d"); ?>" class="form-control"
                        placeholder="YYYY-MM-DD" required>
                      <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
    
              <?php if(checkAuth('super')) { ?>
              <div class="col-md-3">
                <select class="form-control" ng-model="godown_code" name="godown_code" ng-change="getAllProductsFn()">
                  <option value="" selected disabled>-- Select Showroom --</option>
                  <?php if(!empty($allGodowns)){ foreach($allGodowns as $row){ ?>
                  <option value="<?php echo $row->code; ?>">
                    <?php echo filter($row->name)." ( ".$row->address." ) "; ?>
                  </option>
                  <?php } } ?>
                </select>
              </div>
              <?php } else { ?>
              <input type="hidden" ng-init="godown_code = '<?php echo $this->data['branch']; ?>'" ng-model="godown_code" ng-value="godown_code"
                required>
              <?php } ?>
    
              <div class="col-md-4">
                <select ui-select2="{ allowClear: true}" class="form-control" ng-model='product_code'
                  data-placeholder="Select Product" ng-change="addNewProductFn()" required>
                  <option value="" selected disable> </option>
                  <option ng-repeat="product in allProducts" value="{{product.code}}">{{ product.product_model }}</option>
                </select>
             </div>
        </div>
        
        <hr style="margin-top: 5px;">
        
        <table class="table table-bordered table2">
          <tr>
            <th style="width: 40px;">SL</th>
            <th>Product Name</th>
            <th width="150px">Product Model</th>
            <th width="100px">Brand</th>
            <th width="150px">Serial No.</th>
            <!--<th width="80px">Unit</th>-->
            <th width="80px">Stock</th>
            <th width="80px">Quantity</th>
            <th width="100px">Sale Price</th>
            <!--<th width="50px">Dis. (%)</th>
            <th width="100px">Dis. Amount (Tk)</th>-->
            <th width="100px">Total</th>
            <th style="width: 40px;">Action</th>
          </tr>
          <tr ng-repeat="item in card">
            <td style="padding: 6px 8px !important;">{{ $index + 1 }}</td>
            <td>
              <input type="text"   name="category[]" class="form-control" ng-value="item.category | textBeautify" readonly>
              <input type="hidden" name="product[]" class="form-control" ng-value="item.product" readonly>
              <input type="hidden" name="product_code[]" value="{{ item.product_code }}">
              <input type="hidden" name="godown_code" value="{{ item.godown_code }}">
              <input type="hidden" name="unit[]" value="{{ item.unit }}">
            </td>
            <td>
            <input type="text" name="product_model[]" class="form-control" ng-value="item.product_model" readonly>
            </td>
            <td>
            {{ item.brand }}
            </td>
            <td>
              <input type="text" class="form-control" name="product_serial[]">
            </td>
            <td>
              <input type="text" class="form-control" ng-model="item.stock_qty" readonly>
            </td>
            <td>
              <input type="number" name="quantity[]" class="form-control" min="1" max="{{ item.maxQuantity }}"
                ng-model="item.quantity" step="any">
            </td>
            <td>
              <input type="number" name="sale_price[]" class="form-control" ng-model="item.sale_price"
                ng-value="item.sale_price" step="any">
              <input type="hidden" name="purchase_price[]" min="0" ng-value="item.purchase_price" step="any">
            </td>
            <!--<td>
              <input type="number" name="discount_percentage[]" class="form-control" ng-model="item.discount" min="0"
                step="any">
            </td>
            <td>
              <input type="number" name="discount[]" class="form-control" ng-value="setDiscountFn($index)" min="0"
                step="any" readonly>
            </td>-->
            <td>
              <input type="number" class="form-control" ng-value="setSubtotalFn($index)" readonly>
              <input type="hidden" ng-value="purchaseSubtotalFn($index)" step="any">
            </td>
            <td class="text-center">
              <a title="Delete" class="btn btn-danger" ng-click="deleteItemFn($index)">
                <i class="fa fa-times fa-lg"></i>
              </a>
            </td>
          </tr>
        </table>
        <hr>
        <div class="row">
          <div class="col-md-6">
            <!--<div class="form-group">
            <label class="col-md-3 control-label">Sale Type <span class="req">&nbsp;</span></label>
            <div class="col-md-9">
              <label ng-click="getsaleType('cash')">
                <input type="radio" name="stype"  ng-model="stype" checked value="cash">
                <span>Cash</span>
              </label>
              <label ng-click="getsaleType('credit')" style="margin-left: 20px;">
                <input type="radio" name="stype"  ng-model="stype" value="credit">
                <span>Credit</span>
              </label>
            </div>
          </div>-->
            <div class="form-group" ng-init="stype='credit'" style="display: none;">
              <input type="hidden" name="stype" ng-model="stype" checked value="credit">
            </div>
            <div ng-init="active1=true;" ng-show="active1">
              <div class="form-group">
                <label class="col-md-3 control-label">Client</label>
                <div class="col-md-9">
                  <select ui-select2="{ allowClear: true}" class="form-control" name="code" ng-model="party_code" ng-change="findPartyFn()"
                    data-placeholder="Select Client" required>
                    <option value="" selected disable> </option>
                    <option ng-repeat="client in clientList" value="{{client.code}}">{{ client.code+"-"+client.name +"-"+ client.mobile +"-"+ client.address}}</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">Mobile </label>
                <div class="col-md-9">
                  <input type="text" name="mobile" ng-model="partyInfo.contact" class="form-control" readonly>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">Address </label>
                <div class="col-md-9">
                  <textarea name="address" class="form-control" readonly>{{ partyInfo.address }}</textarea>
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-md-3 control-label">Note </label>
                <div class="col-md-9">
                  <textarea class="form-control" readonly>{{ partyInfo.note }}</textarea>
                </div>
              </div> 
              
              
            <?php $allDSR = get_result('dsr',['trash' => 0]); ?>
            <div class="form-group">
                <label class="col-md-3 control-label">Sales Person</label>
                <div class="col-md-9">
                    <select name="dsr" class="form-control">
                        <option value="" selected disabled>-- Select Sales Person --</option>
                        <?php if(!empty($allDSR)){ foreach($allDSR as $row){ ?>
                        <option value="<?php echo $row->code; ?>" >
                            <?php echo filter($row->name)." - ".$row->mobile." - ".$row->area; ?>
                        </option>
                        <?php } } ?>
                    </select>
                </div>
            </div>  
              
              
              <hr>
              <div class="form-group">
                <label class="col-md-3 control-label">Send Sms </label>
                <div class="col-md-2">
                  <input type="checkbox" checked name="send_sms" class="form-control">
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="col-md-4 control-label"> Total Quantity </label>
              <div class="col-md-8">
                <input type="number" name="totalqty" ng-value="getTotalQtyFn()" class="form-control" step="any" readonly>
              </div>
            </div>
            <!--<div class="form-group">
              <label class="col-md-4 control-label"> Total Discount</label>
              <div class="col-md-8">
                <input type="number" name="total_discount" ng-value="getItemWiseTotalDiscountFn()" class="form-control" readonly>
              </div>
            </div>-->
            <div class="form-group">
                <label class="col-md-4 control-label"> HMRP</label>
                <div class="col-md-8">
                    <input type="number" name="total" ng-value="getTotalFn()" class="form-control" step="any" readonly>
                    <input type="hidden" name="purchase_total" ng-value="getPurchaseTotalFn()" class="form-control" readonly>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">Previous Balance </label>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-7">
                            <input type="number" name="previous_balance" ng-model="partyInfo.balance" class="form-control" step="any" readonly>
                        </div>
                        <div class="col-md-5">
                            <input type="text" name="previous_sign" ng-value="partyInfo.sign" class="form-control" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">Down Payment</label>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-7">
                            <input type="number" name="paid" ng-model="amount.paid" class="form-control" step="any">
                        </div>
                        <div class="col-md-5">
                            <select name="method" class="form-control" ng-init="transactionBy='cash'" ng-model="transactionBy" required>
                                <option value="cash">Cash</option>
                                <option value="cheque">Cheque</option>
                                <option value="bKash">bKash</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
          <!-- for selecting cheque -->
          <div ng-if="transactionBy == 'cheque'">
            <div class="form-group">
              <label class="col-md-4 control-label">
                Bank Name <span class="req">*</span>
              </label>
              <div class="col-md-8">
                <select  name="meta[bankname]" class="form-control">
                  <option value="" selected disabled>&nbsp;</option>
                  <?php foreach (config_item("banks") as $key => $value) { ?>
                  <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label">
                Branch Name <span class="req">*</span>
              </label>
              <div class="col-md-8">
                <input type="text" name="meta[branchname]" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label">
                Cheque No <span class="req">*</span>
              </label>
              <div class="col-md-8">
                <input type="text" name="meta[chequeno]" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label">
                Pass Date <span class="req">*</span>
              </label>
              <div class="col-md-8">
                <input type="text" name="meta[passdate]" placeholder="YYYY-MM-DD" class="form-control">
                <input type="hidden" name="meta[status]" value="pending">
              </div>
            </div>
          </div>
          <div class="form-group">
            <!--label class="col-md-4 control-label">Current Balance </label-->
            <label class="col-md-4 control-label">Due</label>
            <div class="col-md-8">
              <div class="row">
                <div class="col-md-7">
                  <input type="number" name="current_balance" ng-value="getCurrentTotalFn()" class="form-control" step="any" readonly>
                </div>
                <div class="col-md-5">
                  <input type="text" name="current_sign" ng-value="partyInfo.csign" class="form-control" readonly>
                </div>
              </div>
            </div>
          </div>
            <div class="form-group">
              <label class="col-md-4 control-label">Value Add </label>
              <div class="col-md-8">
                <div class="row">
                  <div class="col-md-5">
                    <input type="number" name="commission_per" min="0" ng-model="amount.added_percentage" ng-change="calculateAddedValueFn()" class="form-control" step="any">
                  </div>
                  <div class="col-md-7">
                    <input type="text" name="added_amount" ng-model="amount.totalAddedAmount" class="form-control">
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label">Hire Outstanding</label>
              <div class="col-md-8">
                <input type="text" name="hire_price" ng-value="calculateHirePrice()" class="form-control" readonly>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label">Total Amount </label>
              <div class="col-md-8">
                <input type="number" name="grand_total" ng-value="getGrandTotalFn()" class="form-control" step="any" readonly>
              </div>
            </div>
            <input type="hidden" name="installment_type"  value="weekly">
            <input type="hidden" ng-init="customer_type='weekly'" ng-model="customer_type">
            <div class="form-group" ng-if="stype == 'credit' && partyInfo.csign=='Receivable'">
        		<label class="col-md-4 control-label">Installment Number</label>
        		<div class="col-md-8">
        		  <div class="row">
        			<div class="col-md-5">
        			     <select name="installment_number" ng-model="installment_number" ng-change="getInstallAmountFn(installment_number);" class="form-control" required>
                      <option value="" selected disabled>-- Select Installment --</option>
                      <?php for($i=1;$i<=150;$i++){ ?>
                      <option value="<?php echo $i; ?>"> <?php echo $i; ?> </option>
                      <?php } ?>
                    </select>
        			</div>
        			<div class="col-md-7">
        			    <input type="number" name="installment_amount" ng-value="installment_amount" class="form-control" readonly>
        			</div>
        		  </div>
        		</div>
        	  </div>
             <div class="form-group hide" ng-if="stype=='credit' && partyInfo.csign=='Receivable'">
                <label class="col-md-4 control-label">Installment Date</label>
                <div class="col-md-8">
                  <div class="row">
                    <div class="col-md-12">
                      <input type="text" name="installment_date" placeholder="YYYY-MM-DD" class="form-control">
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
        <div class="btn-group pull-right">
            <input type="submit" name="save" value="Save" class="btn btn-primary" ng-init="isDisabled=false;">
        </div>
        <?php echo form_close(); ?>
      </div>
      <div class="panel-footer">&nbsp;</div>
    </div>
  </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#datetimepicker').datetimepicker({
            format: 'YYYY-MM-DD'
        });
    });
</script>