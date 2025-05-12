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
</style>

<div class="container-fluid">
    <div class="row">
    <?php // echo "<pre>"; print_r($emp_info); echo "</pre>"; ?>
    <?php echo $this->session->flashdata('confirmation'); ?>

        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panal-header-title ">
                    <h1 class="pull-left">All Employee  <br>  <small><?php echo count($emp_info)?> Item Found</small></h1>
                    <a class="btn btn-primery pull-right" style="font-size: 14px; margin-top: 0;" onclick="window.print()"><i class="fa fa-print"></i> Print</a>
                </div>
            </div>

            <div class="panel-body">

                <!-- Print Banner -->
                
                <!--Print Banner Start Here-->
                
                <?php $banner_info = $this->action->read("banner"); ?>
                <img class="img-responsive print-banner hide" src="<?php echo site_url($banner_info[0]->path); ?>" alt="">
                
                <!--Print Banner End Here-->
                
                

                <hr class="hide" style="border-bottom: 2px solid #ccc; margin-top: 5px;">

                <div class="">
                <table class="table table-bordered">
                    <tr>
                        <th>SL</th>
                        <th>Joining Date</th>
                        <th>Showroom</th>
                        <th>Employee ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Mobile Number</th>
                        <th>Status</th>
                        <th class="none">Action</th>
                    </tr>
                    <?php foreach ($emp_info as $key => $emp) { ?>

                    <tr>
                        <td> <?php echo $key+1; ?> </td>
                        <td style="width: 130px;"> <?php echo $emp->joining_date; ?> </td>
                        <td style="width: 130px;"> <?php echo get_name('godowns','name',['code' => $emp->godown_code]); ?> </td>
                        <td style="width: 130px;"> <?php echo $emp->emp_id; ?> </td>
                        <td style="width: 50px;"> <img src="<?php echo site_url($emp->path); ?>" width="50px" height="50px" alt=""></td>
                        <td> <?php echo filter($emp->name); ?> </td>
                        <td> <?php echo filter($emp->designation); ?></td>
                        <td> <?php echo $emp->mobile; ?></td>
                        <td> <?php if($emp->status =='inactive'){ echo  'Deactive';  }else{echo 'Active'; } ?></td>
                        <td class="none" style="width: 70px;">
                            <div class="dropdown pull-right">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-cog"></i>
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right ulbordertop">
                                    <li></li>

                                    <?php //if(ck_action("employee","view")){ ?>
                                    <li>
                                        <a href="<?php echo site_url('employee/employee/profile?id='.$emp->id);?>">View</a>
                                    </li>
                                    <?php //} ?>
                                    

                                    <?php //if(ck_action("employee","edit")){ ?>
                                    <li>
                                        <a href="<?php echo site_url('employee/employee/edit_employee?id='.$emp->id) ;?>">Edit</a>
                                    </li>
                                    <?php //} ?>                                    

                                   

                                    <?php //if(ck_action("employee","delete")){ ?>
                                    <li>
                                        <a onclick="return confirm('Are you sure to delete this data?');" href="<?php echo site_url('/employee/employee/delete/'.$emp->id) ;?>"> Delete</a>
                                    </li>
                                    <?php //} ?>                                    
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                </div>

            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>
