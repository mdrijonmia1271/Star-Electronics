<div class="container-fluid">
    <div class="row">
     <?php  echo $this->session->flashdata('confirmation'); ?>
        <div class="panel panel-default">
            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                   <h1>Edit SR</h1>
                </div>
            </div>

            <div class="panel-body">
                <?php 
                $attr=array('class'=>"form-horizontal"); 
                echo form_open(site_url('dsr/dsr/edit/'.$id), $attr);?>
                
                <div class="form-group">
                    <label class="col-md-3 control-label"> Code <span class="req">*</span></label>
                    <div class="col-md-4">
                        <input type="text" name="code" value="<?php echo $dsr[0]->code; ?>" class="form-control" required readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Name <span class="req">&nbsp;*</span></label>
                    <div class="col-md-4">
                        <input type="text" name="name" value="<?php echo filter($dsr[0]->name); ?>" class="form-control" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Mobile <span class="req">&nbsp;*</span></label>
                    <div class="col-md-4">
                        <input type="text" name="mobile" value="<?php echo filter($dsr[0]->mobile); ?>" class="form-control" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Address <span class="req">&nbsp;*</span></label>
                    <div class="col-md-4">
                        <input type="text" name="address" value="<?php echo filter($dsr[0]->address); ?>" class="form-control" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Area <span class="req">&nbsp;*</span></label>
                    <div class="col-md-4">
                        <input type="text" name="area" value="<?php echo filter($dsr[0]->area); ?>" class="form-control" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-7">
                        <input type="submit" value="Update" class="btn btn-primary pull-right">
                    </div>
                </div>
               <?php  echo form_close();?>
            </div>
            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>

