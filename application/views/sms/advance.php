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
                                <a class="nav-link active" href="<?=site_url('/smsControl/advance')?>">Advance</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" href="<?=site_url('/smsControl/others')?>">Regards/Notice</a>
                              </li>
                            </ul>
    				    </div>
    				    
    					<div class="col-md-6 mt-3">
    					   <table>
    					       <tr>
    					           <td>Software Disabled</td>
    					           <td>&nbsp;<input type="checkbox" name="disabled" id="disabled" <?=($smr ? ($smr->disabled==1?'checked':''):'')?> onchange="setValue()"></td>
    					       </tr>
    					       <tr>
    					           <td>Payment Notice</td>
    					           <td>&nbsp;<input type="checkbox" name="is_payment" id="is_payment" <?=($smr ? ($smr->is_payment==1?'checked':''):'')?> onchange="setValue()"></td>
    					       </tr>
    					       <tr>
    					           <td>Support Notice</td>
    					           <td>&nbsp;<input type="checkbox" name="is_support" id="is_support" <?=($smr ? ($smr->is_support==1?'checked':''):'')?> onchange="setValue()"></td>
    					       </tr>
    					   </table>
    				    </div>
    				</div>
    			</form>
			</div>
		</div>
	</div>	
	<script>
	    function setValue(){
	        let disabled = document.querySelector('#disabled');
	        let is_support = document.querySelector('#is_support');
	        
	        let data = new FormData();
	        data.append('disabled', (disabled.checked ? 1:0));
	        data.append('is_support', (is_support.checked ? 1:0));
	        data.append('is_payment', (is_payment.checked ? 1:0));
	        
	        let xml = new XMLHttpRequest();
	        xml.open('POST','<?=site_url('/smsControl/fetch')?>', true);
	        xml.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                //   console.log(this.responseText);
                }
             };
	        xml.send(data);
	    }
	</script>
</body>
</html>
