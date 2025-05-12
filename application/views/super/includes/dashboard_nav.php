<div class="container-fluid none" <?php echo $subMenu; ?> style="margin-bottom: 10px;">
    <div class="row">

		<a href="<?php echo site_url('purchase/purchase'); ?>" class="btn btn-default" id="add-new">
			Purchase
		</a>
		
		<!-- <a href="<?php // echo site_url('production/production'); ?>" class="btn btn-default" id="add-new">
			Production
		</a> -->
		
		<a href="<?php echo site_url('stock/stock/'); ?>" class="btn btn-default" id="stoke">
           Stock</a>
		
		<a href="<?php echo site_url('sale/retail_sale/retail_sale'); ?>" class="btn btn-default" id="add-new">
			Retail Sale
		</a>
		
		<a href="<?php echo site_url('sale/hire_sale/hire_sale'); ?>" class="btn btn-default" id="add-new">
			Hire Sale
		</a>		
		
		<a href="<?php echo site_url('sale/weekly_sale/weekly_sale'); ?>" class="btn btn-default" id="add-new">
			Weekly Sale
		</a>		
		
		<a href="<?php echo site_url('sale/dealerSale'); ?>" class="btn btn-default" id="add-new">
			Dealer Sale
		</a>
		
	    <a href="<?php echo site_url('overall_report'); ?>" class="btn btn-success">
			Overall Report
		</a>
		
    </div>
</div>
