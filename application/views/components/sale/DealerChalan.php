<?php 	
    if(isset($meta->header)){$header_info = json_decode($meta->header,true);}
    if(isset($meta->footer)){$footer_info = json_decode($meta->footer,true);}
    $logo_data  = json_decode($meta->logo,true); 
?>
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" />
<style>
    @media print {

        aside,
        nav,
        .none,
        .panel-heading,
        .panel-footer {
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

        .print_banner_logo {
            width: 19%;
            float: left;
        }

        .print_banner_logo img {
            margin-top: 10px;
        }

        .print_banner_text {
            width: 80%;
            float: right;
            text-align: center;
        }

        .print_banner_text h2 {
            margin: 0;
            line-height: 38px;
            text-transform: uppercase !important;
        }

        .print_banner_text p {
            margin-bottom: 5px !important;
        }

        .print_banner_text p:last-child {
            padding-bottom: 0 !important;
            margin-bottom: 0 !important;
        }
    }
</style>
<div class="container-fluid">
    <div class="row">
        <?php echo $this->session->flashdata('confirmation'); ?>
        <div class="panel panel-default none">
            <div class="panel-heading">
                <div class="panal-header-title pull-left">
                    <h1>View Dealer Chalan</h1>
                </div>
            </div>
            <div class="panel-body">
                <?php
                $attr = array("class" => "form-horizontal");
                echo form_open("", $attr);
                ?>
                <div class="form-group">

                    <?php if(checkAuth('super')) { ?>
                    <div class="col-md-3">
                        <select name="godown_code" class="form-control">
                            <option value="" selected disabled>-- Select Showroom --</option>
                            <option value="all">All Showroom</option>
                            <?php if(!empty($allGodowns)){ foreach($allGodowns as $row){ ?>
                            <option value="<?php echo $row->code; ?>">
                                <?php echo filter($row->name)." ( ".$row->address." ) "; ?>
                            </option>
                            <?php } } ?>
                        </select>
                    </div>
                    <?php } ?>

                    <div class="col-md-3">
                        <input type="text" name="search[voucher_no]" class="form-control" placeholder="Voucher No">
                    </div>

                    <!-- <label class="col-md-2 control-label">Client's Name</label> -->
                    <div class="col-md-3">
                        <select name="search[party_code]" class="selectpicker form-control" data-show-subtext="true"
                            data-live-search="true">
                            <option value="" selected disabled>-- Select Client's Name --</option>
                            <?php foreach ($allClients as $key => $client) { ?>
                            <option value="<?php echo $client->code; ?>">
                                <?php echo $client->code."-".filter($client->name)."-".$client->mobile; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <!-- <label class="col-md-2 control-label">From </label> -->
                    <div class="col-md-3">
                        <div class="input-group date" id="datetimepickerFrom">
                            <input type="text" name="date[from]" class="form-control" placeholder="From">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>

                    <!-- <label class="col-md-2 control-label">To </label> -->
                    <div class="col-md-3">
                        <div class="input-group date" id="datetimepickerTo">
                            <input type="text" name="date[to]" class="form-control" placeholder="To">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="btn-group">
                            <input type="submit" name="show" value="Show" class="btn btn-primary">
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
            <div class="panel-footer">&nbsp;</div>
        </div>
        <?php if(!empty($result)){ ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panal-header-title ">
                    <h1 class="pull-left">Show Result &nbsp;&nbsp; Total Invoice Found(<?php echo count($result); ?>)
                    </h1>
                    <a class="btn btn-primery pull-right" style="font-size: 14px; margin-top: 0;"
                        onclick="window.print()"><i class="fa fa-print"></i> Print</a>
                </div>
            </div>
            <div class="panel-body">
                <!-- Print banner Start Here -->
                <?php $this->load->view('print', $this->data); ?>
                <!-- Print banner End Here -->
                <h4 class="text-center hide" style="margin-top: 0px;">All Chalan</h4>
                <table class="table table-bordered table2">
                    <tr>
                        <th>SL</th>
                        <th width="90">Date</th>
                        <th>Client's Name</th>
                        <th width="100">Voucher No</th>
                        <th>Sale Type</th>
                        <th>Qty</th>
                        <th>Total</th>
                        <!--<th>Discount</th>-->
                        <th>Paid</th>
                        <th>Due</th>
                        <?php if(checkAuth('super')) { ?>
                        <th>Showroom</th>
                        <?php } ?>
                        <th width="60px" class="none">Action</th>
                    </tr>
                    <?php
                    $total_bill = 0.0;
                    $total_discount = 0.00;
                    $amount = $total_paid = $total_due = 0.00;
                    foreach($result as $key => $row){
                        //$due = $row->total_bill - $row->paid;
                    ?>
                    <tr>
                        <td style="width: 50px;"> <?php echo ($key + 1); ?> </td>
                        <td> <?php echo $row->sap_at; ?> </td>
                        <td>
                            <?php
                            if($row->sap_type != "cash" && $row->sap_type != "special"){
                                $where = array('trash'=>0, 'code' => $row->party_code);
                                $party_info = $this->action->read('parties', $where);
                                if ($party_info != null) {
                                    echo filter($party_info[0]->name);}else{echo "N/A";
                                }
                            } else {
                                    echo filter($row->party_code);
                                }
                            ?>
                        </td>
                        <td><?php echo $row->voucher_no; ?> </td>
                        <td>
                            <?php
                            
                                if($row->sap_type == 'cash'){
                                    echo "Retail";
                                }else if($row->sap_type == 'credit'){
                                    echo "Hire";
                                }else{
                                    echo filter($row->sap_type);
                                }
                            ?>

                        </td>
                        <td><?php echo $row->total_quantity; ?> </td>
                        <td>
                            <?php
                            $total = $row->total_bill;
                            $total_bill += $total;
                            echo  f_number($total);
                            ?>
                        </td>
                        <!--td><?php
                           // $total_discount +=$row->total_discount;
                           // echo $row->total_discount;
                            ?>
                        </td-->

                        <td>
                            <?php
                                if($row->sap_type == 'cash'){
                                    $due_paid = $due = 0.00;
                                    $where = array('voucher_no' => $row->voucher_no);
                                    $due_paid_sum = $this->action->read_sum('due_collect','paid',$where);
                                    $due_remission_sum = $this->action->read_sum('due_collect','remission',$where);
                                    
                                    $total_paid += $row->paid + $due_paid_sum[0]->paid;
                                    echo f_number($row->paid + $due_paid_sum[0]->paid);
                                }else{
                                    $total_paid += $row->paid;
                                    echo f_number($row->paid);
                                }
                            ?>
                        </td>

                        <td>
                            <?php
                                if($row->sap_type =='cash'){
                                    $due = $row->total_bill - ( $row->paid + $due_paid_sum[0]->paid + $due_remission_sum[0]->remission);
                                    echo f_number($due);
                                    $total_due += $due;
                                }else{
                                    echo f_number($row->due); 
                                    $total_due += $row->due;
                                }
                            ?>
                        </td>
                        <?php if(checkAuth('super')) { ?>
                        <td><?php echo $row->godown_name; ?></td>
                        <?php } ?>
                        <td class="none">
                            <a title="View" class="btn btn-primary"
                                href="<?php echo site_url('sale/DealerChalan/view').'?vou='.$row->voucher_no; ?>">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="6" class="text-right"><strong>Total</strong> </td>
                        <th><?php echo f_number($total_bill); ?> TK</th>
                        <!-- <th><?php //echo f_number($total_discount); ?> TK</th>-->
                        <th><?php echo f_number($total_paid); ?> TK</th>
                        <td><strong><?php echo f_number($total_due); ?> TK</strong> </td>
                        <th class="none">&nbsp;</th>
                        <th class="none">&nbsp;</th>
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