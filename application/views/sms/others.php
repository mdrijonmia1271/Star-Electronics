<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Control Panel</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<style type="text/css">
		.card-head>h4{
			padding: 10px 25px;
			color: #000;
		}
		.nav-link.active{
		    background: #fbfbfb!important;
		}
		.card-head>h4 {
            padding: 19px 25px;
            color: #000;
            margin: 0;
        }
        .label {
            font-weight: bold;
            font-size: 14px;
            color: #4a4a4a;
        }
	</style>
</head>
<body style="background: #dee2e6;">
	<div class="container">
		<div class="card mt-3" style="min-height: 95vh;">
			<div class="card-head" style="background: #f0f3f5;">
			    <h4>CONTROL PANEL <small><a href="<?php echo site_url('smsControl/logout');?>" class="float-right">Logout</a></small></h4>
			</div>
			<div class="card-body">
			    <form action="" method="POST">
    				<div class="row">
    				    <div class="col-md-12 mb-2">
    				        <ul class="nav nav-tabs">
                              <li class="nav-item">
                                <a class="nav-link" href="<?=site_url('/smsControl/deshboard')?>">Deshboard</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" href="<?=site_url('/smsControl/advance')?>">Advance</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link active" href="">Regards/Notice</a>
                              </li>
                            </ul>
    				    </div>
    					<div class="col-md-6">
    					    <div class="form-group">
    					        <label class="label">SMS REGARDS</label>
    					        <div class="input-group">
        					        <input type="text" name="sms_regards" id="sms_regards" value="<?=($smr ? $smr->sms_regards : '')?>" class="form-control">
        					        <div class="input-group-append">
                                        <span class="input-group-text" id="addon"><?=strlen(($smr ? $smr->sms_regards : ''))?></span>
                                    </div>
                                </div>
    					    </div>
    				    </div>
    					<div class="col-md-6">
    					    <div class="form-group">
    					        <label class="label">REGISTERED ON:</label>
    					        <div class="input-group">
        					        <input type="date" name="since" id="since" value="<?=($smr ? $smr->since : '')?>" class="form-control">
                                </div>
    					    </div>
    				    </div>
    				    <div class="col-md-6">
    					    <div class="form-group">
    					        <label class="label">MIN SMS NOTICE</label>
    					        <textarea class="form-control" name="min_sms_notice" placeholder="@sms replace with real sms length" rows="5"><?=($smr ? $smr->min_sms_notice : '')?></textarea>
    					    </div>
    				    </div>
    				    <div class="col-md-6">
    					    <div class="form-group">
    					        <label class="label">SERVICE CHARGE NOTICE</label>
    					        <textarea class="form-control" name="service_notice" rows="5"><?=($smr ? $smr->service_notice : '')?></textarea>
    					    </div>
    				    </div>
    				    <div class="col-md-6">
    					    <div class="form-group">
    					        <label class="label">PAYMENT NOTICE</label>
    					        <textarea class="form-control" name="payment_notice" rows="5"><?=($smr ? $smr->payment_notice : '')?></textarea>
    					    </div>
    				    </div>
    				    <div class="col-md-6">
    					    <div class="form-group">
    					        <label class="label">SUPPRT NOTICE</label>
    					        <textarea class="form-control" name="support_notice" rows="5"><?=($smr ? $smr->support_notice : '')?></textarea>
    					    </div>
    				    </div>
    				    <div class="col-md-12">
    					    <div class="form-group">
    					        <label class="label">RENEWAL NOTICE</label>
    					        <textarea class="form-control" name="renewal_notice" rows="5"><?=($smr ? $smr->renewal_notice : '')?></textarea>
    					    </div>
    				    </div>
    				    <div class="col-md-12">
    					    <div class="form-group">
    					        <input type="submit" value="update" class="btn btn-success float-right"/>
    					    </div>
    					</div>
    				</div>
    			</form>
			</div>
		</div>
	</div>	
	<script>
	    sms_regards.oninput=function(){
	        addon.innerHTML = this.value.length;
	    }
	</script>
</body>
</html>
