
<div class="container-fluid none" <?php echo $subMenu; ?> style="margin-bottom: 10px;">
    <div class="row">
        <?php if(ck_action("attendance_menu","add-new")){ ?>
		<a href="<?php echo site_url('attendance/attendance'); ?>" class="btn btn-default" id="add-new">
		    Add Attendance
		</a>
		<?php } ?>
		
        <?php if(ck_action("attendance_menu","all")){ ?>
		<a href="<?php echo site_url('attendance/attendance/all'); ?>" class="btn btn-default" id="all">
			All Attendance
		</a>
		<?php } ?>
    </div>
</div>
