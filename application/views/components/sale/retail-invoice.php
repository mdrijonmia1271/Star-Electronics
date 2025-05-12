<?php
    if (isset($meta->header)) {$header_info = json_decode($meta->header, true);}
    if (isset($meta->footer)) {$footer_info = json_decode($meta->footer, true);}
    $logo_data = json_decode($meta->logo, true);
?>
<style>
    .table > tbody > tr > td {padding: 2px;}
    @media print {
        aside, nav, .none, .panel-heading, .panel-footer {display: none !important;}
        .panel {
            border: 1px solid transparent;
            left: 0px;
            position: absolute;
            top: 0px;
            width: 100%;
        }
        .hide {display: block !important;}
    }
    .wid-100 {width: 100px;}
    .custom-table > tbody > tr > th, .custom-table > tbody > tr > td {border: none;line-height: 18px;padding: 4px !important;}
    .custom-table > tbody > tr > th {width: 140px;}
    .view {font-family: 'Raleway', sans-serif;}
    ._tbl tr th, ._tbl tr td {vertical-align: text-top;padding: 3px 10px 3px 0;}
</style>
<div class="container-fluid">
    <div class="row">
        <div class="panel panel-default ">
            <div class="panel-heading none">
                <div class="panal-header-title">
                    <h1 class="pull-left">Voucher</h1>
                    <a class="btn btn-primery pull-right" style="font-size: 14px; margin-top: 0;"
                       onclick="window.print()"><i class="fa fa-print"></i> Print</a>
                </div>
            </div>
            <div class="panel-body">
                <!-- Print banner Start Here -->
                <?php $this->load->view('print', $this->data); ?>
                <!-- Print banner End Here -->
                <div class="col-md-12 invoice hide">
                    <h4 class="text-center">Cash Sale Invoice</h4>
                </div>
                <div class="row">
                    <div class="col-xs-8 print-font">
                        <?php
                            $address  = "N/A";
                            $patyInfo = json_decode($info->address);
                        ?>
                        <table class="_tbl">
                            <tr>
                                <th width="125">Name</th>
                                <th>:</th>
                                <td><?php echo filter($info->party_code); ?></td>
                            </tr>
                            <tr>
                                <th>Mobile</th>
                                <th>:</th>
                                <td><?php echo $patyInfo->mobile; ?></td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <th>:</th>
                                <td><?php echo $patyInfo->address; ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-xs-4 print-font">
                        <table class="_tbl">
                            <tr>
                                <th width="125">Voucher No</th>
                                <th>:</th>
                                <td><?php echo $info->voucher_no; ?></td>
                            </tr>
                            <tr>
                                <th>Date</th>
                                <th>:</th>
                                <td><?php echo $info->sap_at; ?></td>
                            </tr>
                            
                            <tr>
                                <th width="125">Sales Person</th>
                                <th>:</th>
                                <td>
                                    <?php 
                                        echo get_name('dsr','name',['code'=>$info->dsr]);
                                    ?>
                                </td>
                            </tr>
                            
                            <tr>
                                <th>Print Time</th>
                                <th>:</th>
                                <td><?php echo(date("h:i:s A",time())); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive none">
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 05%;"> SL </th>
                                    <th style="width: 20%;"> Product Name </th>
                                    <th style="width: 10%;"> Model </th>
                                    <th style="width: 10%;"> Brand </th>
                                    <th style="width: 10%;"> Serial </th>
                                    <th style="width: 07%; text-align: center;"> Qty </th>
                                    <th style="width: 08%;"> Price </th>
                                    <th style="width: 10%;"> Dis (%) </th>
                                    <th style="width: 15%;"> Dis (Tk) </th>
                                    <th style="width: 15%;"> Flat Dis (Tk) </th>
                                    <th style="width: 15%;"> Total (TK) </th>
                                </tr>
                                <?php
                                    $total_sub = $total_dis =  $total_flat_discount = 0;
                                    $where     = [
                                        'sapitems.voucher_no' => $info->voucher_no,
                                        'sapitems.trash'      => 0,
                                    ];
                                    $select = ['sapitems.*', 'products.product_name', 'products.product_cat',  'products.subcategory', 'products.brand'];
                                    $saleInfo  = get_join('sapitems', 'products', 'sapitems.product_code=products.product_code', $where, $select);
                                    foreach ($saleInfo as $key => $row) {
                                        $total_dis += $row->discount;
                                        $subtotal  = ($row->sale_price * $row->quantity) - $row->discount - $row->flat_discount;
                                        $total_sub += $subtotal;
                                        $total_flat_discount += $row->flat_discount;
                                    ?>
                                    <tr>
                                        <td style="width: 50px;"> <?php echo($key + 1); ?> </td>
                                        <td> <?php echo filter($row->subcategory); ?> </td>
                                        <td> <?php echo filter($row->product_model); ?> </td>
                                        <td> <?php echo $row->brand; ?> </td>
                                        <td> <?php echo $row->product_serial; ?>&nbsp; </td>
                                        <td class="text-center"> <?php echo number_format($row->quantity, 0); ?>&nbsp; </td>
                                        <td class="text-right"> <?php echo $row->sale_price; ?> &nbsp; </td>
                                        <td class="text-right"> <?php echo $row->discount_percentage; ?> &nbsp; </td>
                                        <td class="text-right"> <?php echo $row->discount; ?> </td>
                                        <td class="text-right"> <?php echo $row->flat_discount; ?> </td>
                                        <td class="text-right"> <?php echo f_number($subtotal, 2); ?>&nbsp; </td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <th colspan="5" class="text-right"> Total Qty </th>
                                    <td class="text-center"> <?php echo $info->total_quantity; ?>&nbsp; </td>
                                    <th colspan="2" class="text-right"> Sub Total </th>
                                    <td class="text-right"> <?php echo f_number($total_dis); ?> &nbsp; </td>
                                    <td class="text-right"> <?php echo f_number($total_flat_discount); ?> &nbsp; </td>
                                    <td class="text-right"> <?php echo f_number($total_sub); ?> &nbsp; </td>
                                </tr>

                                <tr>
                                    <th rowspan="6" colspan="7" style="padding-top: 55px;">
                                        In Word : <span id="inword"></span> Taka Only.
                                    </th>
                                </tr>

                                <tr>
                                    <th colspan="3">
                                        Discount(%) &nbsp;
                                    </th>
                                    <td class="text-right">
                                        <?php
                                            $total_discount = $info->total_discount;
                                            echo f_number($info->total_discount, 2);
                                        ?> &nbsp;
                                    </td>
                                </tr>
                                
                                <tr>
                                    <th colspan="3">
                                        Flat Discount &nbsp;
                                    </th>
                                    <td class="text-right">
                                        <?php
                                           
                                            echo f_number($total_flat_discount, 2);
                                        ?> &nbsp;
                                    </td>
                                </tr>

                                <tr>
                                    <th colspan="3">Grand Total</th>
                                    <td class="text-right">
                                        <?php
                                            $total = $info->total_bill;
                                            echo f_number($total, 2);
                                        ?> &nbsp;
                                    </td>
                                </tr>

                                <tr>
                                    <th colspan="3">Paid</th>
                                    <td class="text-right">
                                        <?php echo f_number($info->paid) . " &nbsp";; ?> &nbsp;
                                    </td>
                                </tr>

                                <tr>
                                    <th colspan="3">Due</th>
                                    <td class="text-right">
                                        <?php echo f_number($info->due) . " &nbsp"; ?>&nbsp;
                                    </td>
                                </tr>

                                <tr>
                                    <th colspan="3">Remark</th>
                                    <td class="text-right">
                                        <?php echo $info->comment; ?>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="table-responsive hide">
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 05%;">SL</th>
                                    <th style="width: 20%;">Product</th>
                                    <th style="width: 10%;">Product Model</th>
                                    <th style="width: 10%;">Product Serial</th>
                                    <th style="width: 07%; text-align:center;">Qty</th>
                                    <th style="width: 08%;">Price</th>
                                    <th style="width: 10%;">Dis (%)</th>
                                    <th style="width: 15%;">Dis (Tk)</th>
                                    <th style="width: 15%;">Total (TK)</th>
                                </tr>

                                <?php
                                $total_sub = $total_dis = 0;
                                foreach ($saleInfo as $key => $row) {
                                    $total_dis += $row->discount;
                                    $subtotal  = ($row->sale_price * $row->quantity) - $row->discount;
                                    $total_sub += $subtotal;
                                    ?>
                                    <tr>
                                        <td><?php echo($key + 1); ?></td>
                                        <td> <?php echo filter($row->subcategory); ?>
                                        </td>
                                        <td><?php echo filter($row->product_model); ?> &nbsp; </td>
                                        <td><?php echo $row->product_serial; ?>&nbsp;</td>
                                        <td class="text-center"><?php echo $row->quantity; ?>&nbsp;</td>
                                        <td class="text-left">&nbsp; <?php echo $row->sale_price; ?></td>
                                        <td class="text-left">&nbsp; <?php echo $row->discount_percentage; ?></td>
                                        <td class="text-left">&nbsp; <?php echo $row->discount; ?></td>
                                        <td class="text-right"> <?php echo f_number($subtotal, 2); ?>&nbsp;</td>
                                    </tr>
                                <?php } ?>

                                <tr>
                                    <th colspan="4" class="text-right">Total Qty</th>
                                    <td class="text-center"><?php echo $info->total_quantity; ?>&nbsp;</td>
                                    <th colspan="2" class="text-right">Sub Total</th>
                                    <td class="text-right"><?php echo f_number($total_dis, 2); ?> &nbsp;</td>
                                    <td class="text-right"><?php echo f_number($total_sub, 2); ?> &nbsp;</td>
                                </tr>

                                <tr>
                                    <th rowspan="6" colspan="6" style="padding-top: 55px;">
                                        In Word : <span id="inwords"></span> Taka Only.
                                    </th>
                                </tr>

                                <tr>
                                    <th colspan="2">
                                        Discount (<?php //echo $info->commission_percentage; ?>%)
                                    </th>
                                    <td class="text-right">
                                        <?php
                                            $total_discount = $info->total_discount;
                                            echo f_number($info->total_discount, 2);
                                        ?> &nbsp;
                                    </td>
                                </tr>

                                <tr>
                                    <th colspan="2">Grand Total</th>
                                    <td class="text-right">
                                        <?php
                                            $gtotal = $total = $info->total_bill;
                                            echo f_number($total); 
                                        ?> &nbsp;
                                    </td>
                                </tr>

                                <tr>
                                    <th colspan="2">Paid</th>
                                    <td class="text-right">
                                        <?php echo f_number($info->paid); ?> &nbsp;
                                    </td>
                                </tr>

                                <tr>
                                    <th colspan="2">Due</th>
                                    <td class="text-right">
                                        <?php echo f_number($info->due) . " &nbsp"; ?>&nbsp;
                                    </td>
                                </tr>

                                <tr>
                                    <th colspan="2">Remark</th>
                                    <td class="text-right">
                                        <?php echo $info->comment; ?>
                                    </td>
                                </tr>

                            </table>
                        </div>
                    </div>
                </div>
                <?php $userName = get_name("sapmeta", "meta_value", ["meta_key" => "sale_by", "voucher_no" => $info->voucher_no]); ?>
                <style>
                    .bi_border {
                        display: inline-block;
                        border: 1px solid #000;
                        border-radius: 10px;
                        padding: 3px 5px;
                        margin-bottom: -7px;
                    }
                </style>

                <div class="col-xs-4">
                    <h4 style="margin-top: 40px;" class="text-center print-font">
                        ------------------------------ <br>
                        Signature of Customer
                    </h4>
                </div>

                <div class="col-xs-4">&nbsp;</div>

                <div class="col-xs-4">
                    <h4 style="margin-top: 40px;" class="text-center print-font">
                        ------------------------------ <br>
                        <?php echo $userName; ?>
                    </h4>
                </div>
                <!--<small class="insert_name hide">Software by Freelance iT Lab</small>-->
            </div>
            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>
<style>
@page {size: A4; margin: 11mm 17mm 17mm 17mm;}
@media print {
    .panel-body {position: relative; height: 97vh;}
    .insert_name {position: absolute; bottom: -53px; display: block; width: 100%; text-align: center;}
    .panel-body{page-break-inside: avoid;}
    html, body{width: 210mm; height: 297mm;}
}
</style>
<script type="text/javascript" src="<?php echo site_url("private/js/inworden.js"); ?>"></script>
<script type="text/javascript">
    $(document).ready(function (){$("#inword").html(inWorden(<?php echo $gtotal; ?>));});
    $(document).ready(function (){$("#inwords").html(inWorden(<?php echo $gtotal; ?>));});
</script>