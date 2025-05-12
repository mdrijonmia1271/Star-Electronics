<div class="container-fluid none" <?php echo $subMenu; ?> style="margin-bottom: 10px;">
    <div class="row">
        <?php if(ck_action("leave_menu","add-new")){ ?>
		<a href="<?php echo site_url('leave_management/leaveView'); ?>" class="btn btn-default" id="add-new">
			 Add New
		</a>
		<?php } ?>
		
		<?php if(ck_action("leave_menu","all")){ ?>
		<a href="<?php echo site_url('leave_management/leaveView/show'); ?>" class="btn btn-default" id="all">
			Show Leave
		</a>
		<?php } ?>

		<!-- <a class="btn btn-default" data-toggle="modal" data-target="#myModal">
		    Help
		</a> -->
		
    </div>
</div>



<!-- Tutorial -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Help Tutorial</h4>
      </div>
      <div class="modal-body">
        <iframe width="560" height="315" src="https://www.youtube.com/embed/hrZqiCUx6kg" frameborder="0" allowfullscreen></iframe>
      </div>
    </div>
  </div>
</div>
<!-- End -->