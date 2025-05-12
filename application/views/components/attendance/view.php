<style>
    .table>tbody>tr>td {padding: 2px;}
    @media print{
        aside, nav, .none, .panel-heading, .panel-footer { display: none !important; }
        .panel {
            border: 1px solid transparent;
            left: 0px;
            position: absolute;
            top: 0px;
            width: 100%;
        }
        .hide{display: block !important;}
        .panel-body {height: 96vh;}
        .table-bordered, .print-font { font-size: 14px !important; }
        
    }
</style>

<div class="container-fluid">
    <div class="row">

        <div class="panel panel-default ">
            <div class="panel-heading none">
                <div class="panal-header-title">
                    <h1 class="pull-left">ভাউচার</h1>
                    <a class="btn btn-primery pull-right" style="font-size: 14px; margin-top: 0;" onclick="window.print()"><i class="fa fa-print"></i> Print</a>
                </div>
            </div>

            <!--pre><?php //print_r($result); ?></pre-->

            <div class="panel-body">
                
                <!--Print Banner Start Here-->
                
                <?php $banner_info = $this->action->read("banner"); ?>
                <img class="img-responsive print-banner hide" src="<?php echo site_url($banner_info[0]->path); ?>" alt="">
                
                <!--Print Banner End Here-->
                

                <div class="row">
                	<div class="col-xs-4 print-font">
                       
                        <label>নাম : <?php echo $records[0]->custommer_name;?></label> <br>
                        <label>মোবাইল  : <?php echo $records[0]->mobile;?> </label><br>
                	</div>

                	<div class="col-xs-4 print-font">
                			
                	<label style="margin-bottom: 10px;">
                            ভাউচার নং  : <?php echo $records[0]->voucher;?>
                    </label> <br>
                    <label>ঠিকানা  : <?php echo $records[0]->address;?>  </label>

                     </div>

                	<div class="col-xs-4 print-font">
                		<label>তারিখ : <?php echo $records[0]->date;?></label> <br>
                		<label>প্রিন্টের সময়  : <?php echo date('Y-m-d');?></label>
                    </div>
                </div>

                <table class="table table-bordered">
                    <tr>
                        <th>ক্র.ম</th>
                        <th>মালের বিবরণ</th>
                        <th>পরিমান</th>
                        <th>পরিমান (%) </th>
                        <th>দর</th>
                        <th>প্রোটিন(%)</th>
                        <th>টাকা</th>
                    </tr>

                    <?php
                        $totalQty = $totalPrice = 0.00;
                        foreach($records as $key => $row){
                            $totalQty += $row->qty;
                            $totalPrice += $row->price;
                    ?>
                        <tr>
                            <td class="text-center" style="width: 40px;"><?php echo ($key + 1); ?></td>
                            <td><?php echo filter($row->name); ?></td>
                            <td><?php echo $row->qty; ?></td>
                            <td><?php echo $row->protein_percent; ?></td>
                            <td><?php echo $row->price; ?></td>
                            <td><?php echo $row->protein_percent; ?></td>
                            <td><?php echo $row->amount; ?></td>
                            
                        </tr>                    
                    <?php } ?>
                    <tr>
                        <td colspan="2" class="text-right">
                            <strong>মোট = </strong>
                        </td>
                        <td>
                            <strong><?php echo f_number($totalQty); ?> </strong>
                        </td>
                        <td class="text-right"></td>
                        <td>
                            <strong><?php echo f_number($totalPrice); ?> Tk</strong>
                        </td>
                        <td class="text-right"></td>
                        <td><strong><?php echo f_number($records[0]->grandTotal); ?></strong> Tk</td>
                    </tr>
                    
                </table>
                
                
               	<div class="pull-left hide">
                    <h4 style="margin-top: 40px;" class="text-center print-font">
                    --------------------------------- <br>
                     Signature of Customer
                   
                    </h4>
                </div>

                <div class="pull-right hide">
                    <h4 style="margin-top: 40px;" class="text-center print-font">
                    -------------------------------- <br>
                    Signature of authority
                    </h4>
                </div>
            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?php echo site_url("private/js/inworden.js"); ?>"></script>
<script type="text/javascript">
    $(document).ready(function(){$("#inword").html(inWorden(<?php echo $records[0]->grandTotal; ?>));});
</script>
