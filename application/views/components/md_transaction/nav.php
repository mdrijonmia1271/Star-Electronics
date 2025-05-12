<div class="container-fluid none" <?php echo $subMenu; ?> style="margin-bottom: 10px;">
    <div class="row">		
		<?php if(ck_action("md_transaction_menu","field")){ ?>
    		<a href="<?php echo site_url('md_transaction/fixed_assate'); ?>" class="btn btn-default">
                <i class="fa fa-angle-right"></i>
                Add New Investor
            </a>
		<?php } ?>
		<?php if(ck_action("md_transaction_menu","all")){ ?>
    		<a href="<?php echo site_url('md_transaction/md_transaction'); ?>" class="btn btn-default" >
    			New Md Transaction
    		</a>
		<?php } ?>
		
        <?php if(ck_action("md_transaction_menu","all_trx")){ ?>
    		<a href="<?php echo site_url('md_transaction/md_transaction/allMd_transaction'); ?>" class="btn btn-default" >
    			All Md Transaction
    		</a>
		<?php } ?>
		
		 <?php if(ck_action("md_transaction_menu","balance")){ ?>
    		 <a href="<?php echo site_url('md_transaction/md_transaction/balance_report'); ?>" class="btn btn-default">
                <i class="fa fa-angle-right"></i>
                Balance Report
            </a>
        <?php } ?>
    </div>
</div>