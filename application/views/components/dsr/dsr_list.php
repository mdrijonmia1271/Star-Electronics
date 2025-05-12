<?php if (isset($meta->header)) {
        $header_info = json_decode($meta->header, true);
    }
    if (isset($meta->footer)) {
        $footer_info = json_decode($meta->footer, true);
    }
    $logo_data = json_decode($meta->logo, true);
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css"/>

<style>
    .td_action .btn {padding: 3px 8px !important;}
</style>

<div class="container-fluid">
    <div class="row">
        <?php echo $this->session->flashdata('confirmation'); ?>
        <div class="panel panel-default none">
            <div class="panel-heading">
                <div class="panal-header-title pull-left">
                    <h1>SR Commission List</h1>
                </div>
            </div>
            
            <div class="panel-body">
                <?php
                    $attr = array("class" => "form-horizontal");
                    echo form_open("", $attr);
                ?>
                <div class="form-group">

                    <?php if (checkAuth('super')) { ?>
                        <div class="col-md-3">
                            <select name="godown_code" id="godown_code" class="form-control">
                                <option value="" selected>-- Select Showroom --</option>
                                <option value="all">All Showroom</option>
                                <?php if (!empty($allGodowns)) {
                                    foreach ($allGodowns as $row) { ?>
                                        <option value="<?php echo $row->code; ?>">
                                            <?php echo filter($row->name) . " ( " . $row->address . " ) "; ?>
                                        </option>
                                    <?php }
                                } ?>
                            </select>
                        </div>
                    <?php } ?>

                    <div class="col-md-3">
                        <select name="search[dsr]" class="selectpicker form-control" data-show-subtext="true" data-live-search="true">
                            <option value="" selected>-- Select SR</option>
                            <?php foreach ($allDsr as $key => $value) { ?>
                                <option value="<?php echo $value->code; ?>">
                                    <?php echo filter($value->name) . " - " . $value->mobile . " - " . $value->area; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <input type="text" name="search[voucher_no]" class="form-control" placeholder="Voucher No">
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-md-3">
                        <div class="input-group date" id="datetimepickerFrom">
                            <input type="text" name="date[from]"  class="form-control" autocomplete="off" <?php echo (checkAuth('user') ? 'readonly' : ''); ?> placeholder="From">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="input-group date" id="datetimepickerTo">
                            <input type="text" name="date[to]"  class="form-control" autocomplete="off" <?php echo (checkAuth('user') ? 'readonly' : ''); ?> placeholder="To">
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


        <?php if ($result != null) { ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panal-header-title ">
                        <h1 class="pull-left">Show Result &nbsp;&nbsp; Total Invoice Found(<?php echo count($result); ?>
                            )
                        </h1>
                        <a class="btn btn-primery pull-right" style="font-size: 14px; margin-top: 0;"
                           onclick="window.print()"><i class="fa fa-print"></i> Print</a>
                    </div>
                </div>
                
                <div class="panel-body">
                    <!-- Print banner Start Here -->
                    <?php $this->load->view('print', $this->data); ?>
                    <!-- Print banner End Here -->
                    
                    <h4 class="text-center hide" style="margin-top: 0px;">All SR Commission</h4>
                    <table class="table table-bordered table2">
                        <tr>
                            <th>SL</th>
                            <th width="90">Date</th>
                            <th width="100">Voucher No</th>
                            <th>SR Name</th>
                            <th>Mobile</th>
                            <th>Com. Per Qty.</th>
                            <th>Commission Amount</th>
                            <th>Paid</th>
                            <th>Remaining</th>
                            <th width="50px" class="none text-right">Action</th>
                        </tr>
                        <?php
                            $total_com = $total_paid = $total_remaning = 0.00;
                            foreach ($result as $key => $row) { 
                                $total_com += $row->dsr_commission;
                        ?>
                            <tr>
                                <td style="width: 50px;"> <?php echo($key + 1); ?> </td>
                                <td><?php echo $row->sap_at; ?> </td>
                                <td><?php echo $row->voucher_no; ?> </td>
                                <td><?php echo filter($row->dsr_name); ?> </td>
                                <td><?php echo $row->dsr_mobile; ?> </td>
                                <td><?php echo $row->dsr_per; ?> </td>
                                <td><?php echo $row->dsr_commission; ?> </td>
                                <?php 
                                    $dsrPaid          = get_sum('dsr_payment', 'dsr_paid', ['voucher_no' => $row->voucher_no, 'trash' => 0]);
                                    $dsrRemaining     = $row->dsr_commission - $dsrPaid;
                                    $total_paid      += $dsrPaid;
                                    $total_remaning  += $dsrRemaining;
                                ?>
                                <td><?php echo $dsrPaid; ?> </td>
                                <td><?php echo $dsrRemaining; ?> </td>
                                <td class="none td_action text-center">
                                    <a title="Payment" class="btn btn-success"
                                        onclick="return confirm('Are you sure want to payment this SR?');"
                                        href="<?php echo site_url('dsr/dsr_payment/payment_form/'.$row->voucher_no); ?>">
                                        <i class="fa fa-dollar" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <th colspan="6" class="text-right"><strong>Total</strong></th>
                            <th><?php echo f_number($total_com); ?> TK</th>
                            <th><?php echo f_number($total_paid); ?> TK</th>
                            <th><?php echo f_number($total_remaning); ?> TK</th>
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
    
    
    $("#datetimepickerSMSFrom").on("dp.change", function (e) {
        $('#datetimepickerSMSTo').data("DateTimePicker").minDate(e.date);
    });
    
    $("#datetimepickerSMSTo").on("dp.change", function (e) {
        $('#datetimepickerSMSFrom').data("DateTimePicker").maxDate(e.date);
    });


    $("#godown_code").change(function () {
        var godown_code = $("#godown_code").val();
        $.post("<?php echo site_url('sale/search_sale/client_godown_wise');  ?>",
            {godown_code: godown_code},
            function (data, success) {
                $('#client_dropdown').empty();
                $('#client_dropdown').append(data);
            });
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>