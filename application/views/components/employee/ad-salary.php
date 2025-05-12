<div class="container-fluid">
    <div class="row">
    <?php echo $this->session->flashdata('confirmation');?>
        <div class="panel panel-default">

            <div class="panel-heading">
                <div class="panal-header-title pull-left">
                    <h1><?php echo caption('Advance') ;?> Salary</h1>
                </div>
            </div>

            <div class="panel-body">

                <div class="row">
                    <?php $attr = array(
                        'class' => 'form-horizontal'
                    ); echo form_open('', $attr); ?>
                    <input type="hidden" value="<?php echo $emp_info[0]->id; ?>" name="emp_id">
                    <div class="col-sm-7">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Name <span class="req">*</span></label>
                            <div class="col-md-8">
                                <input type="text" name="name" value="<?php echo $emp_info[0]->name; ?>" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Current_Due <span class="req">&nbsp;</span></label>
                            <div class="col-md-8">
                                <input type="text" value="<?php echo $total_advance-$total_advance_pay; ?>" class="form-control" readonly>
                            </div>
                        </div>

                       <div class="form-group">
                            <label class="col-md-4 control-label">Date <span class="req">*</span></label>
                            <div class="input-group date col-md-8" id="datetimepicker">
                                <input type="text" name="date" class="form-control" value="<?php echo date('Y-m-d'); ?>" <?php if($privilege == 'user'){ echo 'disabled'; } ?> required>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Advance <span class="req">*</span></label>
                            <div class="col-md-8">
                                <input type="text" name="advance_amount" class="form-control" required>
                            </div>
                        </div>

                    </div>

                    <div class="col-sm-2">
                        <img class="thumbnail" src="<?php echo site_url($emp_info[0]->path); ?>" alt="Photo not found....!" width="120px" height="130px">
                    </div>
             

                    <div class="col-md-7">
                        <div class="btn-group pull-right">
                            <input type="submit" value="Save" name="submit" class="btn btn-primary">
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>

            </div>
            <div class="panel-footer">&nbsp;</div>
        </div>



        <div class="panel panel-default">

            <div class="panel-heading">
                <div class="panal-header-title pull-left">
                    <h1>Pay Advance</h1>
                </div>
            </div>

            <div class="panel-body">

                <div class="row">
                    <?php $attr = array(
                        'class' => 'form-horizontal'
                    ); echo form_open('', $attr); ?>
                    <input type="hidden" value="<?php echo $emp_info[0]->id; ?>" name="emp_id">
                    <div class="col-sm-7">
                       <div class="form-group">
                            <label class="col-md-4 control-label">Date <span class="req">*</span></label>
                            <div class="input-group date col-md-8" id="datetimepicker1">
                                <input type="text" name="date" class="form-control" value="<?php echo date('Y-m-d'); ?>" <?php if($privilege == 'user'){ echo 'disabled'; } ?> required>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Total Paid <span class="req">*</span></label>
                            <div class="col-md-8">
                                <input type="text" value="<?php echo $total_advance_pay; ?>" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Amount <span class="req">*</span></label>
                            <div class="col-md-8">
                                <input type="number" name="pay_amount" max="<?php echo $total_advance-$total_advance_pay; ?>" class="form-control" required>
                            </div>
                        </div>

                    </div>            

                    <div class="col-md-7">
                        <div class="btn-group pull-right">
                            <input type="submit" value="Save" name="submit_pay" class="btn btn-primary">
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>

            </div>
            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>

<script type="text/javaScript">
    $(document).ready(function(){

        $('#datetimepicker').datetimepicker({
            format: 'YYYY-MM-DD'
        });  

        $('#datetimepicker1').datetimepicker({
            format: 'YYYY-MM-DD'
        }); 

    });
</script>
