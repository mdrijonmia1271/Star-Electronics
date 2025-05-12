<div class="container-fluid none" <?php echo $subMenu; ?> style="margin-bottom: 10px;">
    <div class="row">
        <?php if(ck_action("ledger","company-ledger")){ ?>
		<a
			href="<?php echo site_url('ledger/companyLedger'); ?>"
			class="btn btn-default"
			id="company-ledger">

			Supplier Ledger
		</a>
        <?php } ?>

        <?php if(ck_action("ledger","client-ledger")){ ?>
		<a
			href="<?php echo site_url('ledger/clientLedger'); ?>"
			class="btn btn-default"
			id="client-ledger">

			All Customer Ledger
		</a>
        <?php } ?>

        <?php if(ck_action("ledger","hire-ledger")){ ?>
        <a
			href="<?php echo site_url('ledger/clientLedger?type=hire'); ?>"
			class="btn btn-default"
			id="hire-ledger">
			Hire Ledger
		</a>
		<?php } ?>

        <?php if(ck_action("ledger","weekly-ledger")){ ?>
        <a
			href="<?php echo site_url('ledger/clientLedger?type=weekly'); ?>"
			class="btn btn-default"
			id="weekly-ledger">
            Weekly Ledger
		</a>
        <?php } ?>

		<?php if(ck_action("ledger","dealer-ledger")){ ?>
		<a
			href="<?php echo site_url('ledger/clientLedger?type=dealer'); ?>"
			class="btn btn-default"
			id="dealer-ledger">
			Dealer Ledger
		</a>
		<?php } ?>
		
		<?php if(ck_action("ledger","productLedger")){ ?>
		  <a
			href="<?php echo site_url('ledger/productLedger'); ?>"
			class="btn btn-default"
			id="productLedger">
			Product Ledger
		 </a>
		<?php } ?>
		
		<?php if(ck_action("ledger","categoryLedger")){ ?>
    		  <a
    			href="<?php echo site_url('ledger/categoryLedger'); ?>"
    			class="btn btn-default"
    			id="categoryLedger">
    			Category Ledger
    		 </a>
		<?php } ?>
		
		
		
		
		
        
        <?php if(ck_action("ledger","hire_client_ledger")){ ?>
		<!--<a-->
		<!--	href="<?php //echo site_url('ledger/hire_client_ledger'); ?>"-->
		<!--	class="btn btn-default"-->
		<!--	id="hire_client_ledger">-->

		<!--	Hire Client Ledger-->
		<!--</a>-->
        <?php } ?>
    </div>
</div>
