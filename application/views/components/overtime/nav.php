<div class="container-fluid none" <?php echo $subMenu; ?> style="margin-bottom: 10px;">
    <div class="row">
        <?php if(ck_action("overtime_menu","add-new")){ ?>
		<a href="<?php echo site_url('overtime/overtime'); ?>" class="btn btn-default" id="add-new">
			Add New 
		</a>
		<?php } ?>
		
        <?php if(ck_action("overtime_menu","all")){ ?>
		<a href="<?php echo site_url('overtime/overtime/all'); ?>" class="btn btn-default" id="all">
			View All
		</a>
		<?php } ?>
		
		<?php /*if(ck_action("overtime_menu","amount_set")){ */?><!--
		<a href="<?php /*echo site_url('overtime/overtime/amount_set'); */?>" class="btn btn-default" id="amount_set">
			Amount Set
		</a>
		--><?php /*} */?>
    </div>
</div>