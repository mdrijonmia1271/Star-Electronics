<style>
      @media print{
        aside{
            display: none !important;
        }
        nav{
            display: none;
        }
        .panel{
            border: 1px solid transparent;
            width: 100%;
            top: 0;
            left: 0;
            position: absolute;
        }
        .none{
            display: none;
        }
        .panel-heading{
            display: none;
        }
        .panel-footer{
            display: none;
        }
        .hide{
            display: block !important;
        }
    }
</style>

<div class="container-fluid">
    <div class="row">

        <div class="panel panel-default none">

            <div class="panel-heading">
                <div class="panal-header-title pull-left">
                    <h1>All Leave list</h1>
                </div>
            </div>

            <div class="panel-body">
                <!-- horizontal form -->
                <?php 
                $attribute = array("class" => "form-horizontal");
                echo form_open('', $attribute);
                ?>
                <div>
                    <label class="col-md-2 control-label">
                        Employee Name
                        <span class="req">*</span>
                    </label>

                    <div class="col-md-5">
                        <select name="id" class="form-control" required>
                            <option value="">&nbsp;</option>
                            <?php 
                            if($employee != null){
                                foreach($employee as $key => $row){
                            ?>
                            <option value="<?php echo $row->emp_id; ?>">
                                <?php echo $row->name; ?>
                            </option>
                            <?php }} ?>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <div class="btn-group">
                            <input type="submit" value="Show" name="show" class="btn btn-primary">
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>

            </div>
            <div class="panel-footer">&nbsp;</div>
        </div>


        <?php if($leave != null){ ?>
        <div class="panel panel-default">
            <div class="panel-heading none">
                <div class="panal-header-title">
                    <h1 class="pull-left">Show Result</h1>
                    <a class="btn btn-primery pull-right" style="font-size: 14px; margin-top: 0;" onclick="window.print()"><i class="fa fa-print"></i> Print</a>
                </div>
            </div>

            <div class="panel-body">
                
                <!--Print Banner Start Here-->
                
                <?php $banner_info = $this->action->read("banner"); ?>
                <img class="img-responsive print-banner hide" src="<?php echo site_url($banner_info[0]->path); ?>" alt="">
                
                <!--Print Banner End Here-->
                
                <!-- Print Banner -->
              <!--   <img class="img-responsive print-banner hide" src="<?php echo site_url('private/images/print-banner.jpg'); ?>" alt="Photo not found...!"> -->

                <h4 class="hide text-center" style="margin-top: 0;">Leave List</h4>

                <table class="table table-bordered">
                    <tr>
                        <th></th>
                        <th>Form</th>
                        <th>To</th>
                        <th>Day</th>
                        <th>For the holidays</th>
                        <th style="width: 60px;" class="none">Action</th>
                    </tr>

                    <?php 
                        $total = 0;
                        foreach($leave as $key => $val){ 
                    ?>
                    <tr>
                        <td><?php echo ($key + 1); ?></td>
                        <td><?php echo $val->date_from; ?></td>
                        <td><?php echo $val->date_to; ?></td>
                        <td>
                        <?php 
                        $from = date_create($val->date_from);
                        $to = date_create($val->date_to);
                        $diff = date_diff($from, $to);
                        echo ($diff->days + 1) . " Days";
                        // echo $diff->format("%a days");
                        $total += $diff->days + 1;
                        ?>
                        </td>
                        <td><?php echo $val->cause; ?></td>
                        <td class="none" ‍style="width: 60px;">
                            <a class="btn btn-danger" href="<?php echo site_url('leave_management/leaveView/delete?id=' . $val->id); ?>" onclick="return confirm('Are you sure?')">
                               <i class="fa fa-trash-o" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="2"></td>
                        <td><strong>Total</strong></td>
                        <td><strong><?php echo $total.' Days'; ?></strong></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            </div>
            <div class="panel-footer">&nbsp;</div>
        </div>
        <?php } ?>

    </div>
</div>

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

