<style>
    /* texteditor style */
#mceu_22{
    border: 1px solid #eee !important;
}
</style>

<div class="container-fluid">
    <div class="row">
        <?php echo $confirmation; ?>

        <div class="panel panel-default">
            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1>Add New</h1>
                </div>
            </div>

            <div class="panel-body">
                <?php 
                $attribute = array('class' => '');
                echo form_open('', $attribute);
                ?>
                <div class="form-group row">
                    <label class="control-label col-md-2"> Employee Name <span class="req">*</span></label>
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
                </div>

                <div class="form-group row">
                    <label class="control-label col-md-2">
                        Form <span class="req">*</span>
                    </label>
                    <div class="col-md-5">
                        <div class="input-group date" id="datetimepickerSMSFrom">
                            <input type="text" name="date_from" class="form-control" placeholder="YYYY-MM-DD">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label col-md-2">To <span class="req">*</span></label>
                    <div class="col-md-5">
                        <div class="input-group date" id="datetimepickerSMSTo">
                            <input type="text" name="date_to" class="form-control" placeholder="YYYY-MM-DD">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label col-md-2">For the holidays <span class="req">*</span></label>
                    <div class="col-md-5">
                        <textarea name="cause" id="tinyTextarea" class="form-control" style="height: 100px;"></textarea>
                    </div>
                </div>
                
                <!-- <div class="form-group">
                    <label class="control-label">For the holidays <span class="req">*</span></label>
                    <textarea name="cause" id="tinyTextarea" class="form-control" cols="30" rows="15"></textarea>
                </div> -->

                <div class="form-group row">
                    <div class="col-md-7">
                        <input type="submit" value="Save" name="save" class="btn btn-primary pull-right">
                    </div>
                </div>
                
                <?php echo form_close(); ?>
            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
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

