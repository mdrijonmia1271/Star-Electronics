<?php 	
    if(isset($meta->header)){$header_info = json_decode($meta->header,true);}
    	if(isset($meta->footer)){$footer_info = json_decode($meta->footer,true);}
    	$logo_data  = json_decode($meta->logo,true); 
    $time = time();
?>

<script src="<?php echo site_url('private/js/ngscript/allWeekliDueCtrl.js?'.$time); ?>"></script>

<style>
    @media print {

        aside,
        .panel-heading,
        .panel-footer,
        nav,
        .none {
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

        table tr th,
        table tr td {
            font-size: 12px;
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

    .action-btn a {
        margin-right: 0;
        margin: 3px 0;
    }
</style>

<div class="container-fluid" ng-controller="allWeekliDueCtrl" ng-cloak>
    <div class="row">
        <div id="loading">
            <img src="<?php echo site_url("private/images/loading-bar.gif"); ?>" alt="Image Not found" />
        </div>

        <div class="panel panel-default loader-hide" id="data">
            <div class="panel-heading">
                <div class="panal-header-title">
                    <h1 class="pull-left">View All Weekly Due</h1>
                    <a class="btn btn-primery pull-right" style="font-size: 14px; margin-top: 0;"
                        onclick="window.print()"><i class="fa fa-print"></i> Print</a>
                </div>
            </div>

            <div class="panel-body" ng-cloak>
                <!-- Print banner Start Here -->
                    <?php $this->load->view('print', $this->data); ?>
                <!-- Print banner End Here -->
                <div class="col-md-12 text-center hide">
                    <h3>All Weekly Due</h3>
                </div>

                <div class="row none">
                    <?php echo form_open('' , ['class' => '']); ?>
                    
                    <?php if(checkAuth('super')) { ?>
                    <div class="col-md-3">
                        <div class="form-group">
                            <select class="form-control" name="godown_code" ng-init="godown_code='<?php echo $this->data['branch']; ?>'" ng-model="godown_code">
                                <option value="" selected disabled>-- Select Showroom --</option>
                                <option value="all">All Showroom</option>
                                <?php $allGodowns = getAllGodown(); if(!empty($allGodowns)){ foreach($allGodowns as $row){ ?>
                                <option value="<?php echo $row->code; ?>">
                                    <?php echo filter($row->name)." ( ".$row->address." ) "; ?>
                                </option>
                                <?php } } ?>
                            </select>
                        </div>
                    </div>
                    <?php } else { ?>
                    <input type="hidden" name="godown_code" ng-init="godown_code = '<?php echo $this->data['branch']; ?>'"
                        ng-model="godown_code" required>
                    <?php } ?>
                    
                    
                    <div class="col-md-3">
                        <div class="form-group">
                            <select ui-select2="{ allowClear: true}" class="form-control" name="code" ng-model="party_code" data-placeholder="Select Client">
                                <option value="" selected disable> </option>
                                <option ng-repeat="client in clientList" value="{{client.code}}">{{ client.code+"-"+client.name +"-"+ client.mobile}}</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="form-group">
                            <select name="zone" class="selectpicker form-control" data-show-subtext="true" data-live-search="true">
                                <option value="" >Select Zone&nbsp; </option>
                                <option value="zone_null" > Null Zone</option>
                                <?php 
                                $zone = $this->action->read('zone');
                                if(!empty($zone)){
                                foreach($zone as $zone){ ?>
                                    <option value="<?php echo $zone->zone; ?>" ><?php echo filter($zone->zone); ?></option>
                                <?php } } ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="form-group">
                            <div class="input-group date" id="datetimepickerFrom">
                                <input type="text" name="dateFrom" class="form-control" placeholder="From">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <div class="input-group date" id="datetimepickerTo">
                                <input type="text" name="dateTo" class="form-control" placeholder="To">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="submit" name="show" value="Show" class="btn btn-primary">
                        </div>
                    </div>
                    
                    <?php echo form_close(); ?>
                </div>

                <hr class="none">
                
                <?php if(!empty($allPartyInfo)) { ?>
                
                <table class="table table-bordered">

                    <tr>
                        <th width="50">SL</th>
                        <th width="75">C.ID</th>
                        <th class="none" width="60">Photo</th>
                        <th>Customer Name</th>
                        <th>Address</th>
                        <th width="120">Mobile</th>
                        <th class="none" >Last Voucher No</th>
                        <th class="none">Product Name</th>
                        <th>Installment Amount</th>
                        <th>Last Ins No</th>
                        <th>Last Paid Date</th>
                        <th>Last Paid Amount</th>
                        <th width="115">Balance</th>
                        <th class="none" >Showroom</th>
                    </tr>
                    <?php
                    $counter = 1;
                    $totalDue = $totalInstallmentAmount = 0;
                    foreach($allPartyInfo as $item){
                    ?>
                    <tr>
                        <td><?php echo $counter; ?></td>
                        <td><?php echo $item['code']; ?></td>
                        <td class="none"><img width="60" src="<?php echo site_url($item['photo']); ?>"></td>
                        <td> <?php echo wordwrap($item['name'],25,"<br>",true); ?> </td>
                        <td> <?php echo $item['address']; ?> </td>
                        <td> <?php echo $item['mobile']; ?> </td>
                        <td class="none"> 
                            <?php
                                $last_vno_no = $this->action->readOrderBy('saprecords','voucher_no',array('party_code' => $item['code'], 'installment_type' => 'weekly', 'trash' => 0),'desc');
                                if(!empty($last_vno_no[0]->voucher_no)){
                                    echo $last_vno_no[0]->voucher_no;
                                }
                            ?>
                        </td>
                        <td class="none"> 
                            <?php
                                if(!empty($last_vno_no[0]->voucher_no)){
                                    $last_vno_product = $this->action->read('sapitems',array('voucher_no' => $last_vno_no[0]->voucher_no, 'trash' => 0));
                                    if(!empty($last_vno_product)){
                                        $product_no = count($last_vno_product);
                                        foreach($last_vno_product as $keys => $val){
                                             $product_code = $val->product_code;
                                             echo get_name('products','product_model',array('product_code' => $product_code));
                                             if($product_no != $keys+1){
                                                 echo ' , ';
                                             }
                                        }
                                    }
                                }
                            ?>
                        </td>
                        <td> 
                            <?php
                                if(!empty($last_vno_no[0]->installment_amount)){
                                    echo $last_vno_no[0]->installment_amount;
                                    $totalInstallmentAmount += $last_vno_no[0]->installment_amount;
                                }
                            ?>
                        </td>
                        <td> 
                            <?php
                                if(!empty($last_vno_no[0]->installment_no)){
                                    echo $last_vno_no[0]->installment_no;
                                }
                            ?>
                        </td>
                        <td> 
                            <?php
                                $last_paid_date = $this->action->readOrderBy('partytransaction','transaction_at',array('party_code' => $item['code'], 'credit !=' => 0),'desc');
                                if(!empty($last_paid_date[0]->transaction_at)){
                                    echo $last_paid_date[0]->transaction_at;
                                }
                            ?>
                        </td>
                        <td> 
                            <?php
                                 if(!empty($last_paid_date[0]->credit)){
                                    echo $last_paid_date[0]->credit;
                                }
                            ?>
                        </td>
                        <td> <?php echo '-'.$item['balance']; $totalDue +=$item['balance'];  ?> </td>
                        <td class="none" > <?php echo $item['godown_name']; ?>  </td>
                    </tr>
                    <?php $counter++; } ?>
                    <tr>
                        <th class="none">&nbsp;</th>
                        <th class="none">&nbsp;</th>
                        <th class="none">&nbsp;</th>
                        <th colspan="5" class="text-right">Total Amount </th>
                        <th> <?php echo '-'.$totalInstallmentAmount; ?> Tk </th>
                        <th> </th>
                        <th> </th>
                        <th> </th>
                        <th> <?php echo '-'.$totalDue; ?> Tk </th>
                        <th class="none"> &nbsp;</th>
                    </tr>
                </table>
                <?php } else {
                    echo '<p class="text-center"> <strong> No data found....! </strong> </p>';
                }?>
            </div>
            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>



<script type="text/javascript">
    // linking between two date
    $('#datetimepickerFrom').datetimepicker({
        format: 'YYYY-MM',
        useCurrent: false
    });

    $('#datetimepickerTo').datetimepicker({
        format: 'YYYY-MM',
        useCurrent: false
    });

    $("#datetimepickerFrom").on("dp.change", function (e) {
        $('#datetimepickerTo').data("DateTimePicker").minDate(e.date);
    });

    $("#datetimepickerTo").on("dp.change", function (e) {
        $('#datetimepickerFrom').data("DateTimePicker").maxDate(e.date);
    });
</script>