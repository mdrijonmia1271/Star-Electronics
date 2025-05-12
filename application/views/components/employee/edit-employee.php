<div class="container-fluid">
    <div class="row">
<?php //echo "<pre>"; print_r($emp_info); echo "</pre>"; ?>
<?php echo $confirmation; ?>

        <div class="panel panel-default">
            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1>Edit</h1>
                </div>
            </div>

            <div class="panel-body">
                <?php
                $attr=array(
                    "class"=>"form-horizontal"
                    );
                echo form_open_multipart("employee/employee/edit_employee?id=".$this->input->get("id"),$attr);?>
                    
                    <div class="form-group">
                        <label class="col-md-2 control-label">&nbsp; </label>
                        <div class="col-md-5">
                            <img src="<?php echo base_url($emp_info[0]->path); ?>" width="80px" height="80px" alt="">
                        </div>
                    </div>


<?php 
                        $privilege = $this->session->userdata('privilege');
                        $branch = $this->session->userdata('branch');
                        $godowns = $this->action->read('godowns',[]);
                    ?>
                  <?php if($privilege == 'super'){  ?>
                        <div class="form-group">
                            <label for="" class="col-md-2 control-label">Showroom</label>
                            <div class="col-md-5">
                                <select name="godown_code" class="selectpicker form-control" data-show-subtext="true" data-live-search="true" required>
                                    <option value="" selected disabled>&nbsp;</option>
                                    <?php foreach ($godowns as $key => $value) { ?>
                                    <option value="<?php echo $value->code; ?>"  <?php if($emp_info[0]->godown_code == $value->code){ echo 'Selected'; } ?> ><?php echo filter($value->name); ?></option>
                                    <?php } ?>                             
                                </select> 
                            </div>
                        </div>
                    <?php }else{ ?>
                        <div class="form-group">
                            <label for="" class="col-md-2 control-label">Showroom</label>
                            <div class="col-md-5">
                                <?php echo get_name('godowns','name',['code' => $branch]); ?>
                                <input type="hidden" name="godown_code" value="<?php echo $branch; ?>">
                            </div>
                        </div>
                        
                        
                    <?php  } ?>




                    <div class="form-group">
                        <label class="col-md-2 control-label">Employee ID </label>
                        <div class="col-md-5">
                            <input type="text" name="emp_id" placeholder="Type Employee ID" value="<?php echo $emp_info[0]->emp_id; ?>" class="form-control" readonly required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Name </label>
                        <div class="col-md-5">
                            <input type="text" name="full_name" placeholder="Type Full Name" value="<?php echo $emp_info[0]->name; ?>" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Joining Date </label>
                        <div class="input-group date col-md-5" id="datetimepicker">
                            <input type="text" name="joining_date" placeholder="YYYY-MM-YY" class="form-control" value="<?php echo $emp_info[0]->joining_date; ?>" required>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>

                    <script type="text/javascript">
                            $(document).ready(function(){
		                $('#datetimepicker').datetimepicker({
		                    format: 'YYYY-MM-DD'
		                });
		            });
                    </script>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Gender <span class="req">*</span></label>
                        <div class="col-md-5">
                            <label class="radio-inline">
                                <input <?php if($emp_info[0]->gender=="Male"){echo "checked";}?> type="radio" name="gender" value="Male"> Male
                            </label>
                            <label class="radio-inline">
                                <input <?php if($emp_info[0]->gender=="Female"){echo "checked";}?> type="radio" name="gender" value="Female"> Female
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Mobile_Number </label>
                        <div class="col-md-5">
                            <input type="text" name="mobile_number" placeholder="without +88" value="<?php echo $emp_info[0]->mobile; ?>" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Email </label>
                        <div class="col-md-5">
                            <input type="email" name="email" placeholder="Type your Email" value="<?php echo $emp_info[0]->email; ?>" class="form-control">
                        </div>
                    </div>
                    

                    <div class="form-group">
                        <label class="col-md-2 control-label">Present Address </label>
                        <div class="col-md-5">
                            <textarea name="present_address" placeholder="Type Present Address" class="form-control" cols="30" rows="5" required><?php echo $emp_info[0]->present_address; ?></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Permanent Address </label>
                        <div class="col-md-5">
                            <textarea name="permanent_address" placeholder="Type Permanent Address" class="form-control" cols="30" rows="5" required><?php echo $emp_info[0]->permanent_address; ?></textarea>
                        </div>
                    </div>



                    <div class="form-group teachers_option">
                        <label class="col-md-2 control-label">Designation </label>
                        <div class="col-md-5">
                            <input text name="designation" class="form-control" value="<?php echo $emp_info[0]->designation; ?>">
                          
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Salary </label>
                        <div class="col-md-5">
                            <input type="text" name="salary" value="<?php echo $emp_info[0]->employee_salary; ?>" placeholder="Amount in Tk" class="form-control" required>
                        </div>
                    </div>
                    
                    <div class="form-group" >
                        <label class="col-md-2 control-label">Overtime(hourly) <span class="req">*</span></label>
                        <div class="col-md-5">
                            <input type="number" name="overtime" value="<?php echo $emp_info[0]->overtime; ?>" required class="form-control">
                        </div>
                    </div>
                    
                    <div class="form-group" >
                        <label class="col-md-2 control-label">Entry Time <span class="req">*</span></label>
                        <div class="col-md-5">
                            <div class="input-group date control-label pull-left" id="startdatetimepicker" style="border: 1px solid #ccc; border-radius: 0 5px 5px 0; margin: 3px; padding-top: 0px;">
                                <input type="text" name="start_time" class="form-control" value="<?php echo $emp_info[0]->entry_time; ?>">
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
                                <input type="text" name="end_time" class="form-control" value="<?php echo $emp_info[0]->exit_time; ?>">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Image</label>
                        <div class="col-md-5">
                            <input id="input-test" type="file" name="attachFile" class="form-control file" data-show-preview="false" data-show-upload="false" data-show-remove="false">
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-2 control-label">Status <span class="req">*</span></label>
                        <div class="col-md-5">
                            <select name="status" class="form-control" required>
                                <option value="<?php echo $emp_info[0]->status; ?>" selected>
                                    <?php echo $emp_info[0]->status; ?>
                                </option> 
                                <option value="active" > Active</option>
                                <option value="inactive">Inactive</option>
                            </select>    
                        </div>
                    </div>

                    <div class="col-md-7">
                        <div class="btn-group pull-right">
                            <input type="submit" name="update_emp" value="Update" class="btn btn-success">
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
