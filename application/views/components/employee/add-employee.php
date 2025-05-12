<div class="container-fluid">
    <div class="row">
    <?php echo $this->session->flashdata("confirmation"); ?>
        <div class="panel panel-default">

            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1>Add Employee </h1>
                </div>
            </div>

            <div class="panel-body">


                <!-- horizontal form -->
                <?php
                    $attr=array("class"=>"form-horizontal");
                    echo form_open_multipart('', $attr);
                ?>

                <?php 
                        $privilege = $this->session->userdata('privilege');
                        $branch = $this->session->userdata('branch');
                        $godowns = $this->action->read('godowns',[]);
                    ?>
                  <?php if($privilege == 'super'){  ?>
                        <div class="form-group">
                            <label for="" class="col-md-2 control-label">Select Showroom</label>
                            <div class="col-md-5">
                                <select name="godown_code" class="selectpicker form-control" data-show-subtext="true" data-live-search="true" required>
                                    <option value="" selected disabled>&nbsp;</option>
                                    <?php foreach ($godowns as $key => $value) { ?>
                                    <option value="<?php echo $value->code; ?>"><?php echo filter($value->name); ?></option>
                                    <?php } ?>                             
                                </select> 
                            </div>
                        </div>
                    <?php }else{ ?>
                        <div class="form-group">
                            <label for="" class="col-md-2 control-label">Showroom</label>
                            <div class="col-md-2">
                                <?php echo get_name('godowns','name',['code' => $branch]); ?>
                                <input type="hidden" name="godown_code" value="<?php echo $branch; ?>">
                            </div>
                        </div>
                        
                        
                    <?php  } ?>

                    
                    
                    
                    <div class="form-group">
                        <label class="col-md-2 control-label">Name <span class="req">*</span></label>
                        <div class="col-md-5">
                            <input type="text" name="full_name" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Joining Date <span class="req">*</span></label>
                        <div class="input-group date col-md-5" id="datetimepicker1">
                            <input type="text" name="joining_date" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                    
                    <script type="text/javascript">
                            $(document).ready(function(){
		                $('#datetimepicker1').datetimepicker({
		                    format: 'YYYY-MM-DD'
		                });
		            });
                    </script>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Gender <span class="req">*</span></label>
                        <div class="col-md-5">
                            <label class="radio-inline">
                                <input type="radio" name="gender" value="Male" checked>Male
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="gender" value="Female" > Female
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Mobile Number <span class="req">*</span></label>
                        <div class="col-md-5">
                            <input type="text" name="mobile_number" class="form-control" placeholder="At least 11 digits" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Email <span class="req">&nbsp; </span></label>
                        <div class="col-md-5">
                            <input type="text" name="email" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Present Address <span class="req">*</span></label>
                        <div class="col-md-5">
                            <textarea name="present_address" id="pre_addr" class="form-control" cols="30" rows="5" required></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Permanent Address<span class="req">*</span></label>
                        <div class="col-md-5">
                            <input type="checkbox" id="permanent_address" value="0"> <label for="permanent_address">Same As Present Address </label>
                            <textarea name="permanent_address" id="per_addr" class="form-control" cols="30" rows="5" required></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Designation <span class="req">*</span></label>
                        <div class="col-md-5" >
                            
                            <input type="text" name="designation" class="form-control">
                            <!--<select name="designation" class="form-control" >
                                <option value="">--Select--</option>
                                <?php// foreach (config_item('desigation') as $value) { ?>
                                    <option value="<?php// echo $value; ?>"><?php// echo $value; ?></option>
                            <?php// } ?>

                            </select>-->
                        </div>
                    </div>

                    <div class="form-group" >
                        <label class="col-md-2 control-label">Salary <span class="req">*</span></label>
                        <div class="col-md-5">
                            <input type="number" name="salary" value="0" required class="form-control">
                        </div>
                    </div>
                    
                    <div class="form-group" >
                        <label class="col-md-2 control-label">Overtime(hourly) <span class="req">*</span></label>
                        <div class="col-md-5">
                            <input type="number" name="overtime" value="0" required class="form-control">
                        </div>
                    </div>
                    
                    <div class="form-group" >
                        <label class="col-md-2 control-label">Entry Time <span class="req">*</span></label>
                        <div class="col-md-5">
                            <div class="input-group date control-label pull-left" id="startdatetimepicker" style="border: 1px solid #ccc; border-radius: 0 5px 5px 0; margin: 3px; padding-top: 0px;">
                                <input type="text" name="start_time" class="form-control" value="<?php echo date('h:i:s');?>">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group" >
                        <label class="col-md-2 control-label">Exit Time <span class="req">*</span></label>
                        <div class="col-md-5">
                            <div class="input-group date control-label pull-left" id="enddatetimepicker" style="border: 1px solid #ccc; border-radius: 0 5px 5px 0; margin: 3px; padding-top: 0px;">
                                <input type="text" name="end_time" class="form-control" value="<?php echo date('h:i:s');?>">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Image  <span class="req">*</span></label>
                        <div class="col-md-5">
                            <input id="input-test" type="file" name="attachFile" class="form-control file" data-show-preview="true" data-show-upload="false" data-show-remove="false">
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-2 control-label">Status <span class="req">*</span></label>
                        <div class="col-md-5">
                            <select name="status" class="form-control" required>
                                <option value="active" selected> Active</option>
                                <option value="inactive">Inactive</option>
                            </select>    
                        </div>
                    </div>


                    <div class="col-md-7">
                        <div class="btn-group pull-right">
                            <input type="submit" name="add_emp" value="Save" class="btn btn-primary">
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
        $("#permanent_address").on("click",function(){
            if ($(this).is(":checked")) {
                $("#per_addr").val($("#pre_addr").val());
            }
            else{
                $("#per_addr").val("");
            }
        });
    });
    
    
    $(document).ready(function(){
        $('#startdatetimepicker').datetimepicker({
            //format: 'LT'
            format: 'HH:mm'
        });
    });
    
    $(document).ready(function(){
        $('#enddatetimepicker').datetimepicker({
            //format: 'LT'
            format: 'HH:mm'
        });
    });
    
</script>
