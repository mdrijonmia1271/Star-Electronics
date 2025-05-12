<style>
    @media print{
        aside, nav, .none, .panel-heading, .panel-footer{
            display: none !important;
        }
        .panel{
            border: 1px solid transparent;
            left: 0px;
            position: absolute;
            top: 0px;
            width: 100%;
        }
        .hide{
            display: block !important;
        }
    }
    .table tr td{
        vertical-align: middle !important;
    }
   
</style>

<div class="container-fluid">
    <div class="row">
    <?php echo $this->session->flashdata('confirmation'); ?>

                <div class="panel panel-default none">
            <div class="panel-heading">
                <div class="panal-header-title pull-left">
                    <h1>All Attendance</h1>
                </div>
            </div>

            <div class="panel-body">
                <?php
                $attr = array("class" => "form-horizontal");
                echo form_open("", $attr);
                ?>

                <div class="form-group">
                    <!--<label class="col-md-2 control-label">Employee Name</label>-->
                    <div class="col-md-3">
                        <select name="search[emp_id]" class="selectpicker form-control" data-show-subtext="true" data-live-search="true" required>
                            <option value="" selected disabled>-- Select Employee Name --</option>
                            <?php foreach ($employeeInfo as $key => $name) { ?>
                            <option value="<?php echo $name->emp_id; ?>" >
                                  <?php echo filter($name->emp_name).' ( '.$name->emp_id.' ) '; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                    
                    <div class="col-md-3">
                        <!--<label class="col-md-2 control-label">From </label>-->
                        <div class="input-group date" id="datetimepickerFrom">
                            <input type="text" name="date[from]" class="form-control" placeholder="From">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <!--<label class="col-md-2 control-label">To </label>-->
                        <div class="input-group date" id="datetimepickerTo">
                            <input type="text" name="date[to]" class="form-control" placeholder="To">
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
                <div class="panal-header-title ">
                    <h1 class="pull-left">Result <h1>
                    <a class="btn btn-primery pull-right" style="font-size: 14px; margin-top: 0;" onclick="window.print()"><i class="fa fa-print"></i> Print</a>
                </div>
            </div>

            <div class="panel-body">

                
                <!--Print Banner Start Here-->
                
                <?php $banner_info = $this->action->read("banner"); ?>
                <img class="img-responsive print-banner hide" src="<?php echo site_url($banner_info[0]->path); ?>" alt="">
                
                <!--Print Banner End Here-->
                

                <h4 class="text-center hide" style="margin-top: 0px;"> Result </h1>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th width="50" >SL </th>
                            <th>Date</th>
                            <th>Employee name</th>
                            <th>Employee ID</th>
                            <th>Entry Time</th>
                            <th>Exit Time</th>
                            <th>Time</th>
                            <th>Status</th>
                            <th class="none" width="110">Action </th>
                        </tr>
                        <?php
                            $total_active = 0;
                            if($attendanceInfo != null){
                                foreach($attendanceInfo as $key => $value){

                            //Getting time Difference start here --->
                            $from_time = strtotime($value->start_time);
                            $to_time = strtotime($value->end_time);
                        
                            if($to_time > $from_time){
                                $dateDiff = intval(($to_time - $from_time)/60);
                                $hours = intval($dateDiff / 60);
                                $minutes = $dateDiff % 60;
                            }elseif($to_time < $from_time){
                                $to_time = strtotime('+12 hours', strtotime($value->end_time));
                                $dateDiff = intval(($to_time - $from_time)/60);
                                $hours = intval($dateDiff / 60);
                                $minutes = $dateDiff % 60;
                            }else{
                                $hours = intval(0 / 60);
                                $minutes = 0 % 60;
                            }
                            //Getting time Difference end here --->
                        ?>
                        <tr>
                            <td><?php echo (1+$key); ?></td>
                            <td><?php echo $value->date; ?></td>
                            <td><?php echo filter($value->emp_name); ?></td>
                            <td><?php echo $value->emp_id; ?></td>
                            <td><?php echo $value->start_time; ?></td>
                            <td><?php echo $value->end_time; ?></td>
                            <td><?php echo $hours. ' hour(s) '.$minutes.' min(s) '; ?></td>
                            <td><?php if($value->status == 'yes'){echo 'Yes'; $total_active+=count($value->status);}else{echo 'No';} ?></td>
                            <td class="none">
                                <!--<a class="btn btn-primary" title="view" href="<?php //echo site_url('attendance/attendance/view/'.$value->id); ?>"><i class="fa fa-eye" aria-hidden="true"></i></a>-->
                                <a class="btn btn-warning" title="Edit" href="<?php echo site_url('attendance/attendance/edit/'.$value->id); ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                <a class="btn btn-danger" title="Delete" onclick="return confirm('Are you sure to delete this data?');" href="<?php echo site_url('attendance/attendance/delete/'.$value->id) ;?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                        <?php } } ?>
                        <tr class="none">
                            <td class="text-right"><strong></strong></td>
                            <td colspan="8"><strong><?php echo $total_active;?></strong> &nbsp; Active Day(s)</td>
                        </tr>

                    </table>
                    
                </div>

            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>

<script>
        $('#datetimepickerFrom').datetimepicker({
        format: 'YYYY-MM-DD',
        useCurrent: false
    });

    $('#datetimepickerTo').datetimepicker({
        format: 'YYYY-MM-DD',
        useCurrent: false
    });
</script>
