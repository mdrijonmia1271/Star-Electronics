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
                    <h1>Edit Attendance </a></h1>

                </div>
            </div>

            <div class="panel-body" ng-cloak>
    		    <div class="row">
                <?php 
                    $attr = array('class' => 'form-horizontal');
                    echo form_open_multipart('', $attr); 
                ?>
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Date </th>
                                <th>Employee Name</th>
                                <th>Code</th>
                                <th>Entry Time</th>
                                <th>Exit Time</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        
                        <tr>
                            <td width="70"><input type="text" name="emp_name" value="<?php echo $employeeInfo[0]->date; ?>" class="form-control" readonly></td>
                            <td width="120"><input type="text" name="emp_name" value="<?php echo $employeeInfo[0]->emp_name; ?>" class="form-control" readonly></td>
                            <td width="120"><input type="text" name="emp_id" value="<?php echo $employeeInfo[0]->emp_id; ?>" class="form-control" readonly></td>
                            
                            <td width="120">
                                <div class="input-group date control-label pull-left" id="startdatetimepicker" style="border: 1px solid #ccc; border-radius: 0 5px 5px 0; margin: 3px; padding-top: 0px;">
                                    <input type="text" name="start_time" class="form-control" value="<?php echo $employeeInfo[0]->start_time;?>">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                </div>
                            </td>
                            
                            <td width="120">
                                <div class="input-group date control-label pull-left" id="enddatetimepicker" style="border: 1px solid #ccc; border-radius: 0 5px 5px 0; margin: 3px; padding-top: 0px;">
                                    <input type="text" name="end_time" class="form-control" value="<?php echo $employeeInfo[0]->end_time;?>">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                </div>
                            </td>
                            
                            <td width="50" class="text-center">
                                <input type="checkbox" name="status" value="yes" <?php if($employeeInfo[0]->status == 'yes'){echo 'checked';}?> > Yes<br>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="col-md-12 none">
                    <div class="btn-group pull-right">
                        <input type="submit" value="Update" name="update" class="btn btn-success"> 
                    </div>
                </div>
                <?php echo form_close(); ?>

            </div>
        </div>
        <div class="panel-footer none">&nbsp;</div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        
        $('#startdatetimepicker').datetimepicker({
            format: 'h:mm'
        });
        
        $('#enddatetimepicker').datetimepicker({
            format: 'h:mm'
        });
        
    });
</script>
