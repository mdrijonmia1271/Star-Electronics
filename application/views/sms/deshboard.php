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
				<div class="row">
				    <div class="col-md-12 mb-2">
				        <ul class="nav nav-tabs">
                          <li class="nav-item">
                            <a class="nav-link active" href="#">Deshboard</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="<?=site_url('/smsControl/advance')?>">Advance</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="<?=site_url('/smsControl/others')?>">Regards/Notice</a>
                          </li>
                        </ul>
				    </div>
					<div class="col-md-6">
						<div class="card">
							<div class="card-body">
    							<form method="post" action="<?php echo site_url('smsControl/SmsUpdate');?>">
    							    <div class="form-group">
    									<label for="date" class="label">Date</label>
    									<input type="date" name="date" class="form-control" value="<?php echo date('Y-m-d');?>" readonly="true">
    								</div>
    								<div class="form-group">
    									<label for="pre_sms" class="label">Previous SMS</label>
    									<input type="text" class="form-control" value="<?php echo $this->data['total_sms'][0]->sms;?>" readonly="true">
    								</div>
    								<div class="form-group">
    									<label for="Amount" class="label">Amount</label>
    									<input type="text" class="form-control" name="amount" placeholder="Enter Amount" id="amount" autocomplete="off" value="">
    								</div>
    								<div class="form-group">
    									<label for="total_sms" class="label">SMS</label>
    									<input type="text" class="form-control" name="sms" id="sms" value="0">
    								</div>
    								<div class="form-group">
    									<input type="submit" class="btn btn-success float-right" value="Submit">
    								</div>
    							</form>
							</div>
						</div>
					</div>
					<div class="col-md-6">
					    <table class="table table-bordered">
							<tr>
								<th width="10%">SL</th>
								<th>Date</th>
								<th>Amount</th>
								<th>SMS</th>
							</tr>
						    <?php 
						        $total_amount = 0;
						        $total_sms = 0;
						        foreach($this->data['sms'] as $key=>$row){ ?>
    							<tr>
    							    <td><strong><?php echo $key+1;?></strong></td>
    								<td><?php echo $row->date; ?></td>
    								<td><?php echo $row->amount; $total_amount += $row->amount; ?></td>
    								<td><?php echo $row->sms; $total_sms += $row->sms;?></td>
    							</tr>    	
							<?php } ?>
							<tr>
								<td colspan="2" class="text-right"><strong>Total</strong></td>
								<td><strong><?php echo $total_amount;?> TK</strong></td>
								<td><strong><?php echo $total_sms;?></strong></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>	
	<script>
		amount.focus();
		amount.onkeyup=function(){
			sms.value = parseInt(this.value*2);
		}
        
        sms.onkeyup=function(){
			amount.value = parseInt(this.value/2);
		}
        
	</script>
</body>
</html>
