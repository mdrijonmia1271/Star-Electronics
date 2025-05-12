<div class="container-fluid none" <?php echo $subMenu; ?> style="margin-bottom: 10px;">
    <div class="row">
        <?php if(ck_action("sale_menu","add-new")){ ?>
		<!--<a href="<?php echo site_url('sale/sale'); ?>" class="btn btn-default" id="add-new">
			Add Sale
		</a>-->
		<?php } ?>
		
		<?php if(ck_action("sale_menu","retail")){ ?>
		<a href="<?php echo site_url('sale/retail_sale'); ?>" class="btn btn-default" id="retail">
			Retail Sale
		</a>
		<?php } ?>	
		
		<?php if(ck_action("sale_menu","hire")){ ?>
		<a href="<?php echo site_url('sale/hire_sale'); ?>" class="btn btn-default" id="hire">
			Hire Sale
		</a>
		<?php } ?>
		
	
		
	
		<?php if(ck_action("sale_menu","weekly")){ ?>
		<a href="<?php echo site_url('sale/weekly_sale'); ?>" class="btn btn-default" id="weekly">
			Weekly Sale
		</a>
		<?php } ?>
		
		<?php if(ck_action("sale_menu", "dealer")){ ?>
		<a href="<?php echo site_url('sale/dealerSale'); ?>" class="btn btn-default" id="dealer">
			Dealer Sale
		</a>
		<?php } ?>
		
		
	    <?php if(ck_action("sale_menu", "quotation")){ ?>
    		<a href="<?php echo site_url('/sale/quotation'); ?>" class="btn btn-default" id="quotation">
    			Quotation
    		</a>
		<?php } ?>
		
		
		<?php if(ck_action("sale_menu", "d_c")){ ?>
		<a href="<?php echo site_url('sale/DealerChalan'); ?>" class="btn btn-default" id="d_c">
			Dealer Chalan
		</a>
		<?php } ?>
		
        <?php if(ck_action("sale_menu","all")){ ?>
		<a href="<?php echo site_url('sale/search_sale'); ?>" class="btn btn-default" id="all">
			All Sale
		</a>
		<?php } ?>
		
		<?php if(ck_action("sale_menu","hire-all")){ ?>
		<a href="<?php echo site_url('sale/search_sale/hireSale'); ?>" class="btn btn-default" id="hire-all">
			All Hire Sale
		</a>
		<?php } ?>
		
		<?php if(ck_action("sale_menu","all_quotation")){ ?>
    		<a href="<?php echo site_url('sale/all_quotation'); ?>" class="btn btn-default" id="all_quotation">
    			All Quotation
    		</a>
		<?php } ?>
		
		
		
        <?php if(ck_action("sale_menu","wise")){ ?>
		<a href="<?php echo site_url('sale/sale/itemWise'); ?>" class="btn btn-default" id="wise">
			Item Wise
		</a>
        <?php } ?>
        
        <?php if(ck_action("sale_menu","client_search")){ ?>
		<a href="<?php echo site_url('sale/client_search'); ?>" class="btn btn-default" id="client_search">
			Client Wise
		</a>
		<?php } ?>
        
        <?php if(ck_action("sale_menu","multi-return")){ ?>
        <a href="<?php echo site_url('sale/multiSaleReturn'); ?>" class="btn btn-default" id="multi-return">
			Sale Return
		</a>
		<?php } ?>
		
		<?php if(ck_action("sale_menu","multi-return-all")){ ?>
		<a href="<?php echo site_url('sale/multiSaleReturn/all'); ?>" class="btn btn-default" id="multi-return-all">
			All Sale Return
		</a>
        <?php } ?>
		
		<!--<a href="<?php //echo site_url('sale/deleted_sale'); ?>" class="btn btn-default" id="all-deleted">
			Deleted Sale
		</a>-->
		
    </div>
</div>
