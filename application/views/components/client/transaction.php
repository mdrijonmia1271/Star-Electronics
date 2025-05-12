<script src="<?php echo site_url('private/js/ngscript/ClientTransactionCtrl.js?'.time()); ?>"></script>
<div class="container-fluid">
    <div class="row" ng-controller="ClientTransactionCtrl" ng-cloak>
        <?php echo $this->session->flashdata('confirmation'); ?>
        <div class="panel panel-default">
            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1>Payment Collection</h1>
                </div>
            </div>
            <div class="panel-body">
                <!-- horizontal form -->
                <?php
                $attr = array("class"=>"form-horizontal");
                echo form_open('', $attr);
                ?>
                
                <div class="form-group">
                    <label class="col-md-3 control-label">Date <span class="req">*</span></label>
                    <div class="col-md-5">
                        <div class="input-group date" id="datetimepicker">
                            <input type="text" name="created_at" class="form-control"
                                value="<?php echo date("Y-m-d");?>" placeholder="YYYY-MM-DD" required>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                </div>
                
               <?php if(checkAuth('super')) { ?>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Select Showroom<span class="req">&nbsp;*</span></label>
                        <div class="col-md-5">
                            <select name="godown_code" ng-model="godown_code" class="form-control" required>
                                <option value="" selected disabled>-- Select Showroom --</option>
                                <?php if(!empty($allGodowns)){ foreach($allGodowns as $row){ ?>
                                <option value="<?php echo $row->code; ?>" <?php echo ($this->data['branch'] == $row->code) ? 'selected' : ''; ?>>
                                    <?php echo filter($row->name)." ( ".$row->address." ) "; ?>
                                </option>
                                <?php } } ?>
                            </select>
                        </div>
                    </div>
                <?php } else { ?>
                        <input type="hidden" ng-model="godown_code" ng-init="godown_code = '<?php echo $this->data['branch']; ?>'" value="<?php echo $this->data['branch']; ?>" required>
                <?php } ?>
                   
				<div class="form-group">
                    <label class="col-md-3 control-label">Type<span class="req">&nbsp;*</span></label>
                    <div class="col-md-5">
                        <select name="customer_type" ng-model="customer_type" ng-change="getAllPartiesFn()" class="form-control"  required>
                            <option value="" selected>-- Select Type ---</option>
                            <option value="dealer" >Dealer</option>
                            <option value="hire">Hire</option>
                            <option value="weekly">Weekly</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                     <label class="col-md-3 control-label">Name <span class="req">*</span></label>
                    <div class="col-md-5">
                        <select ui-select2="{ allowClear: true}" class="form-control" name="code" ng-model='code'
                          data-placeholder="Select Party" ng-change="getAllVoucherFn(); getMobileFn()" required>
                          <option value="" selected disable> </option>
                          <option ng-repeat="row in clientList" value="{{row.code}}">{{ row.code }}-{{ row.name }}-{{ row.mobile }}--{{ row.address }} </option>
                        </select>
                    </div>
                </div>
                
                <input type="hidden" name="mobile_number" ng-value="mobile" class="form-control">

                <div class="form-group">
                    <label class="col-md-3 control-label">
                        Balance (TK) <span class="req">&nbsp;</span>
                    </label>
                    <div class="col-md-3">
                        <input type="number" name="balance" ng-model="balance" class="form-control" step="any" readonly>
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="sign" ng-model="sign" class="form-control" readonly>
                    </div>
                </div>

                
                <!-- for selecting Installment -->
                <div ng-show="transactionType" ng-init="transactionType = false">
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label">
                            Voucher No
                        </label>
                        <div class="col-md-5">
                            <select ui-select2="{ allowClear: true}" class="form-control" name="voucher_no" ng-model='voucher_no'
                              data-placeholder="Select Party" ng-change="getVoucherInfo()">
                              <option value="" selected disable>-- Select voucher --</option>
                              <option ng-repeat="row in voucherList" value="{{row.voucher_no}}">{{ row.voucher_no }} - (Due: {{ row.due }} Tk)</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label">
                            Due (TK)
                        </label>
                        <div class="col-md-5">
                            <input type="number" name="due_amount" ng-value="due_amount" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">
                            Installment Amount(TK)
                        </label>
                        <div class="col-md-3">
                            <input type="number" ng-model="installment_amount" class="form-control" readonly>
                        </div>
                        <div class="col-md-2">
                            <p style="martin: 0; padding: 6px 8px !important; background: #eee; height: 34px;">{{ installment_type | textBeautify }}
                        </div>
                    </div>
                    
                </div>
                <!-- installment option end  -->


                <div class="form-group">
                    <label class="col-md-3 control-label">Collection Method <span class="req">*</span></label>
                    <div class="col-md-5">
                        <select name="payment_type" ng-model="transactionBy" ng-init="transactionBy='cash'" class="form-control" required>
                            <option value="cash">Cash</option>
                            <option value="cheque">Cheque</option>
                            <option value="bkash">bKash</option>
                            <option value="bank">Bank</option>
                            <option value="dbbl">DBBL</option>
                            <option value="comission">Comission</option>
                        </select>
                    </div>
                </div>

                <!-- for selecting cheque -->
                <div ng-if="transactionBy == 'cheque'">
                    <div class="form-group">
                        <label class="col-md-3 control-label">
                            Bank name <span class="req">*</span>
                        </label>
                        <div class="col-md-5">
                            <input type="text" name="meta[bankname]" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">
                            Branch name <span class="req">*</span>
                        </label>
                        <div class="col-md-5">
                            <input type="text" name="meta[branchname]" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">
                            Account No. <span class="req">*</span>
                        </label>
                        <div class="col-md-5">
                            <input type="text" name="meta[account_no]" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">
                            Cheque No. <span class="req">*</span>
                        </label>
                        <div class="col-md-5">
                            <input type="text" name="meta[chequeno]" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">
                            Pass Date <span class="req">*</span>
                        </label>
                        <div class="col-md-5">
                            <input type="text" name="meta[passdate]" placeholder="YYYY-MM-DD" class="form-control"
                                value="<?php echo date("Y-m-d"); ?>">
                            <input type="hidden" name="meta[status]" value="pending">
                        </div>
                    </div>
                </div>
                <!-- cheque option end  -->


                <div class="form-group">
                    <label class="col-md-3 control-label">Transaction Type <span class="req">*</span></label>
                    <div class="col-md-5">
                        <select name="transaction_type" ng-model="transaction_type" class="form-control ng-not-empty ng-dirty ng-valid-parse ng-valid ng-valid-required ng-touched" required="">
                            <option value="" selected="" disabled="">&nbsp;</option>
                            <option value="receive">Receive Form Party</option>
                            <option value="payment">Paid To Party</option>
                        </select>
                    </div>
                </div>





                <div class="form-group">
                    <label class="col-md-3 control-label">Payment (TK) <span class="req">*</span></label>
                    <div class="col-md-5">
                        <input type="number" name="payment" ng-model="payment" placeholder="0" class="form-control" step="any" min="0"
                            required>
                    </div>
                </div>

                <div ng-show="transactionType" ng-init="transactionType = false">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Remission (TK) </label>
                        <div class="col-md-5">
                            <input type="text" name="remission" ng-model="remission" class="form-control" placeholder="0">
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-md-3 control-label">Adjustment (TK) </label>
                    <div class="col-md-5">
                        <input type="text" name="adjustment" ng-model="adjustment" class="form-control" placeholder="0">
                    </div>
                </div>

                
                <div class="form-group">
                    <label class="col-md-3 control-label">
                        Total Due (TK) <span class="req">&nbsp;</span>
                    </label>
                    <div class="col-md-3">
                        <input type="number" name="totalBalance" ng-value="getTotalFn()" class="form-control" step="any"
                            readonly>
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="csign" ng-model="csign" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Paid By <span class="req">&nbsp;</span></label>
                    <div class="col-md-5">
                        <input type="text" name="comment" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Send SMS <span class="req">&nbsp;</span></label>
                    <div class="col-md-1">
                         <div class="checkbox">
                            <label>
                                <input type="checkbox" name="send_sms" style="padding-left: 5px; transform: scale(2);">
                            </label>
                          </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="btn-group pull-right">
                        <input type="submit" name="save" value="Save" class="btn btn-primary">
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#datetimepicker').datetimepicker({
        format: 'YYYY-MM-DD',
        useCurrent: false
    });
</script>