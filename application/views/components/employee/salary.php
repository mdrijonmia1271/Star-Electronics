<style>
    #account,#bank_name{
        display: none;
    }
</style>
<div class="container-fluid">
    <div class="row">
    <?php echo $this->session->flashdata('confirmation');?>
        <div class="panel panel-default">

            <div class="panel-heading">
                <div class="panal-header-title pull-left">
                    <h1><?php echo caption('Pay_Salary') ;?></h1>
                </div>
            </div>

            <div class="panel-body">
                <?php $attr = array(
                    'class' => 'form-horizontal'
                ); echo form_open('', $attr); ?>

                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('Salary') ;?> <span class="req">&nbsp;</span></label>
                        <div class="col-md-5">
                            <input type="text" name="salary_amount" value="<?php echo $emp_info[0]->employee_salary; ?>" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('Bonus') ;?> <span class="req">&nbsp;</span></label>
                        <div class="col-md-5">
                            <input type="text" name="bonus" Placeholder="0.00" class="form-control">
                        </div>
                    </div>

                   <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('Issue_Date') ;?> <span class="req">*</span></label>
                        <div class="input-group date col-md-5" id="datetimepicker">
                            <input type="text" name="issue_date" class="form-control" value="<?php echo date('Y-m-d'); ?>" <?php if($privilege == 'user'){ echo 'disabled'; } ?> required>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('Payment_Date') ;?> <span class="req">*</span></label>
                        <div class="col-md-3">
                            <select name="payment_year" class="form-control" required>
                                <option value="">-- <?php echo caption('Year') ;?> --</option>
                                <?php 
                                   for($i=date('Y')-1; $i <= date('Y')+2; $i++ ) { ?>
                                       <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php } ?>
                                   
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select name="payment_month" class="form-control" required>
                                <option value="">-- <?php echo caption('Month') ;?> --</option>
                                <?php  $months = config_item('months');
                                    foreach ($months as $key => $value) { ?>
                                    <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                                <?php } ?>                                   
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('Type_of_Payment') ;?> <span class="req">*</span></label>
                        <div class="col-md-5">
                            <select name="payment_type" class="form-control" required>
                                <option value="" selected disabled>-- <?php echo caption('Select') ;?> --</option>
                                <option value="cash">Cash</option>
                                <option value="check">Check</option>
                                <option value="bank">Bank</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group" id="bank_name">
                        <label class="col-md-2 control-label"><?php echo caption('Bank') ;?> <span class="req">&nbsp;</span></label>
                        <div class="col-md-5">
                            <select name="bank_name" class="form-control">
                                <option value="" selected disabled>-- <?php echo caption('Select') ;?> --</option>
                                <?php foreach (config_item('banks') as $key => $bank) {  ?>
                                <option value="<?php echo $bank; ?>"><?php echo filter($bank); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group" id="account">
                        <label class="col-md-2 control-label"><?php echo caption('Account_Number') ;?> <span class="req">&nbsp;</span></label>
                        <div class="col-md-5">
                            <input type="text" name="account_number" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-7">
                        <div class="btn-group pull-right">
                            <input type="submit" value="<?php echo caption('Save') ;?>" name="submit" class="btn btn-primary">
                        </div>
                    </div>
                <?php echo form_close(); ?>

            </div>
            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){

        $('#datetimepicker').datetimepicker({
            format: 'YYYY-MM-DD'
        });  

        $('select[name="payment_type"]').on('change', function() {
           if($(this).val()=="bank"){
                $('#bank_name').slideDown('slow',function(){
                    $('#account').slideDown('slow');
                });
           }else{
                $('#account').slideUp('slow',function(){
                    $('#bank_name').slideUp('slow');
                });
           }
        });
    });
</script>

