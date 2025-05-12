<style>
    .table tr td{
        vertical-align: middle !important;
    }
    .dailysale-footer{
        text-align: center;
        border-top: 2px solid #9e1a16;
        margin-top: 10px;
    }
    table td {
        	padding:0 10px ;
        }
        table td input,
        table td select{
        	border:0 !important;
        	
        }
        table thead th{
        	text-align:center;
    }
    .table-bordered>tbody>tr>td{
        padding: 0 8px !important;
    }
    .table-bordered .form-control{
        padding: 0 10px;
        height: 28px;
    }
</style>
<div class="container-fluid">
    <div class="row">
        <?php
            echo $confirmation;
            echo $this->session->flashdata('confirmation');
        ?>

        <div class="panel panel-default">
            <div class="panel-heading panal-header none">
                <div class="panal-header-title ">
                    <h1>Add Attendance </a></h1>

                </div>
            </div>

            <div class="panel-body" ng-cloak>
    		    <div class="row">
		        <?php 
                    $attr = array('class' => 'form-horizontal');
                    echo form_open_multipart('', $attr); 
                ?>
                    <div class="col-xs-12">     
                        <div class="form-group">
                            <label class="col-xs-2 control-label control-label-left">Date  <span class="req">*</span></label>
                            
                            <div class="input-group date col-xs-4 control-label pull-left" id="datetimepicker">
                                <input type="text" name="present_date" class="form-control" value="<?php echo date('Y-m-d');?>" placeholder="" required>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                            
                            <div class="col-xs-1" style="margin-top: 7px;">
                                <input type="submit" value="Show" name="show" class="btn btn-primary">
                            </div>
                        </div>
                    </div>
                    
                <?php echo form_close(); ?>
                </div><br>

                <?php 
                    $attr = array('class' => 'form-horizontal');
                    echo form_open_multipart('', $attr); 
                ?>
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>SL </th>
                                <th>Employee Name</th>
                                <th>Employee ID</th>
                                <th>Entry Time</th>
                                <th>Exit Time</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        
                        <?php 
                            if($allEmployees != null){
                                foreach($allEmployees as $key => $value) { 
                        ?>
                        <tr>
                            <input type="hidden" name="date[]" value="<?php echo $present_date; ?>">
                            <td width="40" class="text-center"><?php echo $key+1; ?></td>
                            <td width="120"><input type="text" name="emp_name[]" value="<?php echo $value->name; ?>" class="form-control" readonly></td>
                            <td width="120"><input type="text" name="emp_id[]" value="<?php echo $value->emp_id; ?>" class="form-control" readonly></td>
                            
                            <td width="120">
                                <div class="input-group date control-label pull-left" id="startdatetimepicker<?php echo $key+1; ?>" style="border: 1px solid #ccc; border-radius: 0 5px 5px 0; margin: 3px; padding-top: 0px;">
                                    <input type="text" name="start_time[]" class="form-control" value="<?php echo date('h:i:s');?>">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                </div>
                            </td>
                            
                            <td width="120">
                                <div class="input-group date control-label pull-left" id="enddatetimepicker<?php echo $key+1; ?>" style="border: 1px solid #ccc; border-radius: 0 5px 5px 0; margin: 3px; padding-top: 0px;">
                                    <input type="text" name="end_time[]" class="form-control" value="<?php echo date('h:i:s');?>">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                </div>
                            </td>
                            
                            <td width="40">
                                <input type="checkbox" name="status[]" value="yes" class="form-control">
                            </td>
                        </tr>
                        <?php }} ?>
                    </table>
                </div>

                <div class="col-md-12 none">
                    <div class="btn-group pull-right">
                        <input type="submit" value="Save " name="save" class="btn btn-success"> 
                    </div>
                </div>
                <?php echo form_close(); ?>

            </div>

            <div class="panel-footer none">&nbsp;</div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#datetimepicker').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        
        //Start Time Query
        var i = 1;
        var range = "<?php echo $key+1; ?>";
        //console.log(i);
        for(i; i <= range; i++ ){
            $('#startdatetimepicker'+i).datetimepicker({
                format: 'h:mm'
            });
        }
        
        //End Time Query
        var j = 1;
        var range2 = "<?php echo $key+1; ?>";
        //console.log(j);
        for(j; j <= range2; j++ ){
            $('#enddatetimepicker'+j).datetimepicker({
                format: 'h:mm'
            });
        }

    });
</script>
