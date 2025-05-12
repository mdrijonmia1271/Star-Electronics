<style type="text/css">
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

        <div class="panel panel-default">
            <!-- Employee Information -->
            <div class="panel-heading">
                <div class="panal-header-title pull-left">
                    <h1><?php echo caption('Employee_History') ;?></h1>
                </div>
                <a class="btn btn-primery pull-right" style="font-size: 14px; margin-top: 0;" onclick="window.print()"><i class="fa fa-print"></i><?php echo caption('Print') ;?> </a>
            </div>

            <div class="panel-body">

                <!-- Print Banner -->
               
                <div class="row hide">
                    <div class="view-profile">

                        <div class="institute">
                            <h2 class="text-center title" style="margin-top: 10px; font-weight: bold;">
                                <?php $print_header = config_item('heading');echo $print_header['title']; ?>
                            </h2>
                            <h4 class="text-center" style="margin: 0;">
                                <?php $print_header = config_item('heading');echo $print_header['place']; ?>
                            </h4>
                            <h4 class="text-center" style="margin: 0;">
                              Mobile: <?php $print_header = config_item('heading');echo $print_header['mobile']; ?>
                            </h4>
                        </div>                          
                      
                    </div>
                </div>

                <table class="table table-bordered">
                    <caption><h4 class="text-center" style="margin-top: -10px;"><?php echo caption('Employee_Information') ;?></h4></caption>
                    <tr>
                        <th><?php echo caption('Name') ;?></th>
                        <th><?php echo caption('Image') ;?></th>
                        <th><?php echo caption('Joining_Date') ;?></th>
                        <th><?php echo caption('Mobile_Number') ;?></th>
                        <th><?php echo caption('Designation') ;?></th>
                    </tr>

                    <tr>
                        <td> <?php echo $emp_info[0]->name; ?> </td>
                        <td style="width: 50px;"> <img src="<?php echo base_url($emp_info[0]->path); ?>" width="50px" height="50px" alt=""></td>
                        <td> <?php echo $emp_info[0]->joining_date; ?> </td>
                        <td> <?php echo $emp_info[0]->mobile; ?> </td>
                        <td> <?php echo $emp_info[0]->designation; ?> </td>
                    </tr>
                </table>

                <table class="table table-bordered">
                    <caption><h4 class="text-center" style="margin-top: -10px;"><?php echo caption('Salary_History') ;?></h4></caption>
                    <tr>
                        <th><?php echo caption('SL') ;?></th>
                        <th><?php echo caption('Payment_Date') ;?></th>
                        <th><?php echo caption('Year') ;?></th>
                        <th><?php echo caption('Month') ;?></th>
                        <th><?php echo caption('Salary') ;?></th>
                        <th><?php echo caption('Bonus') ;?></th>
                    </tr>
                    
                    <?php 
                    $total_salery=0;
                    $total_bonus=0;
                    foreach($salarys as $s_key=>$salery_row){
                        $total_salery += $salery_row->salary_amount;
                        $total_bonus += $salery_row->bonus
                    ?>
                    <tr>
                        <td> <?php echo $s_key+1; ?> </td>
                        <td> <?php echo $salery_row->issue_date;?> </td>
                        <td> <?php echo $salery_row->payment_year;?> </td>
                        <td> <?php echo $salery_row->payment_month;?> </td>
                        <td> <?php echo $salery_row->salary_amount;?> </td>
                        <td> <?php echo $salery_row->bonus;?> </td>
                    </tr>
                    <?php } ?>

                    <tr>
                        <th colspan="4" class="text-right"><?php echo caption('Total') ;?></th>
                        <th><?php echo $total_salery; ?></th>
                        <th><?php echo $total_bonus; ?></th>
                    </tr>
                </table>

                <table class="table table-bordered">
                    <caption><h4 class="text-center" style="margin-top: -10px;"><?php echo caption('Advance_Salary_History') ;?></h4></caption>
                    <tr>
                        <th><?php echo caption('SL') ;?></th>
                        <th><?php echo caption('Date') ;?></th>
                        <th><?php echo caption('Advance') ;?></th>
                    </tr>
                <?php
                    $total_advance=0;
                    foreach ($ad_salary as $ad_key => $ad_salary) {

                    $total_advance += $ad_salary->advance_amount;
                ?>
                    <tr>
                        <td> <?php echo $ad_key+1; ?> </td>
                        <td> <?php echo $ad_salary->date; ?> </td>
                        <td> <?php echo $ad_salary->advance_amount; ?> </td>
                    </tr>
                <?php } ?>

                    <tr>
                        <th colspan="2" class="text-right"><?php echo caption('Total') ;?></th>
                        <th><?php echo $total_advance; ?></th>
                    </tr>
                </table>

                <table class="table table-bordered">
                    <caption><h4 class="text-center" style="margin-top: -10px;"><?php echo caption('Advance_Payment_History') ;?></h4></caption>
                    <tr>
                        <th><?php echo caption('SL') ;?>SL</th>
                        <th><?php echo caption('Payment_Date') ;?></th>
                        <th><?php echo caption('Payment') ;?></th>
                    </tr>
                <?php
                $total_payment=0;
                    foreach ($ad_pay as $ad_pay_key => $ad_pay) {
                    $total_payment +=  $ad_pay->pay_amount;
                ?>
                    <tr>
                        <td> <?php echo $ad_pay_key+1; ?> </td>
                        <td> <?php echo $ad_pay->date; ?> </td>
                        <td> <?php echo $ad_pay->pay_amount; ?> </td>
                    </tr>
                <?php } ?>

                    <tr>
                        <th colspan="2" class="text-right"><?php echo caption('Total') ;?></th>
                        <th><?php echo $total_payment; ?></th>
                    </tr>
                </table>

                <table class="table table-bordered">
                    <caption><h4 class="text-center" style="margin-top: -10px;"><?php echo caption('Current_Balance') ;?></h4></caption>
                    <tr>
                        <th><?php echo caption('Total_Advance') ;?></th>
                        <th><?php echo caption('Total_Payment') ;?></th>
                    </tr>

                    <tr>
                        <td> <?php echo $total_advance; ?> </td>
                        <td> <?php echo $total_payment; ?> </td>
                    </tr>
                </table>
            </div>
            <!-- End -->
            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>

