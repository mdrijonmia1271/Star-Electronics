<div class="container-fluid none" <?php echo $subMenu; ?> style="margin-bottom: 10px;">
    <div class="row">
        <?php if(ck_action("due_list_menu","cash")){ ?>
		<a href="<?php echo site_url('due_list/due_list'); ?>" class="btn btn-default" id="cash">
			Retail Due
		</a>
		<?php } ?>

        <?php if(ck_action("due_list_menu","retail_due_collection")){ ?>
        <a href="<?php echo site_url('due_list/due_list/retail_due_collection'); ?>" class="btn btn-default" id="retail_due_collection">
            Retail Due Collections
        </a>
        <?php } ?>

        <?php if(ck_action("due_list_menu","dealer_list")){ ?>
		<a href="<?php   echo site_url('due_list/due_list/dealer_due'); ?>" class="btn btn-default" id="dealer_list">
			Dealer Due
		</a>
        <?php } ?>

		<?php if(ck_action("due_list_menu","credit")){ ?>
		<a href="<?php echo site_url('due_list/due_list/credit'); ?>" class="btn btn-default" id="credit">
			 Hire Due
		</a>
		<?php } ?>


        <?php if(ck_action("due_list_menu","weekli_list")){ ?>
		<a href="<?php  echo site_url('due_list/due_list/weekli_due'); ?>" class="btn btn-default" id="weekli_list">
			Weekly Due
		</a>
        <?php } ?>

		<?php if(ck_action("due_list_menu","supplier_due")){ ?>
    		<a href="<?php echo site_url('supplier/supplier/view_all/due'); ?>" class="btn btn-default" id="supplier_due">
    			 Supplier Due
    		</a>
		<?php } ?>
    </div>
</div>