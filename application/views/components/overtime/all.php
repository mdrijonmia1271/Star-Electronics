<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css"/>


<style>
    @media print {
        aside, nav, .none, .panel-heading, .panel-footer {
            display: none !important;
        }

        .panel {
            border: 1px solid transparent;
            left: 0px;
            position: absolute;
            top: 0px;
            width: 100%;
        }

        .hide {
            display: block !important;
        }

        .block-hide {
            display: none;
        }
    }
</style>


<div class="container-fluid block-hide">
    <div class="row">

        <?php echo $this->session->flashdata('confirmation'); ?>

        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panal-header-title pull-left">
                    <h1>Show Overtime</h1>
                </div>
            </div>

            <div class="panel-body">

                <!-- horizontal form -->
                <?php
                $attribute = array('name' => '', 'class' => 'form-horizontal', 'id' => '');
                echo form_open_multipart('', $attribute);
                ?>

                <div class="form-group">
                    <label class="col-md-3 control-label">Name</label>
                    <div class="col-md-4">
                        <select name="search[emp_id]" class="form-control selectpicker" data-show-subtext="true"
                                data-live-search="true" required>
                            <option value="">-- Select Employee --</option>
                            <?php if (!empty($employee)) {
                                foreach ($employee as $key => $value) {
                                    echo '<option value="' . $value->emp_id . '">' . get_filter($value->name) . '</option>';
                                }
                            } ?>
                        </select>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-md-3 control-label">Form</label>
                    <div class="input-group date col-md-4" id="datetimepickerFrom">
                        <input type="text" name="date[from]" placeholder="From" class="form-control">
                        <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">To</label>
                    <div class="input-group date col-md-4" id="datetimepickerTo">
                        <input type="text" name="date[to]" placeholder="To" class="form-control">
                        <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-7">
                        <div class="btn-group pull-right">
                            <input class="btn btn-primary" type="submit" name="show" value="Show">
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">&nbsp;</div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>


<div class="container-fluid">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading none">
                <div class="panal-header-title pull-left">
                    <h1>All Overtime</h1>
                </div>
                <a href="#" class="pull-right none" style="margin-top: 0px; font-size: 14px;"
                   onclick="window.print()"><i class="fa fa-print"></i> Print</a>
            </div>

            <div class="panel-body">
                <!--Print Banner Start Here-->

                <?php $banner_info = $this->action->read("banner"); ?>
                <img class="img-responsive print-banner hide" src="<?php echo site_url($banner_info[0]->path); ?>"
                     alt="">

                <!--Print Banner End Here-->

                <h4 class="hide text-center">All Overtime</h4>
                <?php if (!empty($result)) { ?>
                    <table class="table table-bordered">
                        <tr>
                            <th>SL</th>
                            <th>Date</th>
                            <th>Employee Name</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Total Hour</th>
                            <th>Hourly Rate</th>
                            <th>Total Amount</th>
                            <th class="none text-center">Action</th>
                        </tr>
                        <?php
                        $grand_total = 0.00;
                        foreach ($result as $key => $row) {
                            $hour = 0;
                            $hour        = hour_difference($row->start_time, $row->end_time);
                            $totalAmount = $hour * $row->hourly_rate;
                            $grand_total += $totalAmount;
                            ?>
                            <tr>
                                <td><?= ($key + 1) ?></td>
                                <td><?= $row->date ?></td>
                                <td><?= filter($row->name) ?></td>
                                <td><?= date('h:i:A', strtotime($row->start_time)) ?></td>
                                <td><?= date('h:i:A', strtotime($row->end_time)) ?></td>
                                <td><?= $hour ?></td>
                                <td><?= $row->hourly_rate ?></td>
                                <td><?= $totalAmount ?></td>
                                <td class="none text-center">
                                    <a title="Delete"
                                       class="btn btn-danger"
                                       onclick="return confirm('Do you want to delete this Informatio?');"
                                       href="<?php echo site_url('overtime/overtime/delete/' . $row->id); ?>">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <th class="text-right" colspan="7" align="right">Total</th>
                            <th><?php echo f_number($grand_total); ?> Tk</th>
                            <td class="none"></td>
                        </tr>
                    </table>
                <?php } else {
                    echo '<p class="text-center"> <strong>No data found....!</strong> </p>';
                } ?>
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


<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>

