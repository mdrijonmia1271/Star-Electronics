<link rel="stylesheet"
      href="/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css"/>
<div class="container-fluid">
    <div class="row">

        <?= $this->session->flashdata('confirmation'); ?>

        <div class="panel panel-default">

            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1>Add New Overtime </h1>
                </div>
            </div>

            <div class="panel-body">


                <!-- horizontal form -->
                <?php
                $attr = array("class" => "form-horizontal");
                echo form_open('overtime/overtime/store', $attr);
                ?>

                <div class="form-group">
                    <label class="col-md-3 control-label">Date <span class="req">*</span></label>
                    <div class="input-group date col-md-4" id="datetimepicker1">
                        <input type="text" name="date" class="form-control" value="<?php echo date('Y-m-d'); ?>"
                               required>
                        <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Employee Name <span class="req">*</span></label>
                    <div class="col-md-4">
                        <select name="emp_id" class="form-control selectpicker" data-show-subtext="true"
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
                    <label class="col-md-3 control-label">Start Time <span class="req">*</span></label>
                    <div class='input-group date col-md-4' id='datetimepicker2'>
                        <input type='text' name="start_time" class="form-control"/>
                        <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">End Time <span class="req">*</span></label>
                    <div class='input-group date col-md-4' id='datetimepicker3'>
                        <input type='text' name="end_time" class="form-control"/>
                        <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Hourly Rate <span class="req">*</span></label>
                    <div class="col-md-4">
                        <input type="number" name="hourly_rate" class="form-control" value="50" required>
                    </div>
                </div>


                <div class="col-md-7">
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

<script type="text/javascript" src="/scripts/bootstrap-datetimepicker.*js"></script>

<script>
    $(document).ready(function () {

        $('#datetimepicker').datetimepicker({
            format: 'YYYY-MM-DD',
        });

        $('#datetimepicker2').datetimepicker({
            format: 'YYYY-MM-DD LT',
        });

        $('#datetimepicker3').datetimepicker({
            format: 'YYYY-MM-DD LT',
        });

    });

</script>

