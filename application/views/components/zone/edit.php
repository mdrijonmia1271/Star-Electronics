<div class="container-fluid">
    <div class="row">
     <?php  echo $this->session->flashdata('confirmation'); ?>
        <div class="panel panel-default">
            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                   <h1>Edit Zone</h1>
                </div>
            </div>

            <div class="panel-body">
                <?php 
                $attr=array('class'=>"form-horizontal"); 
                echo form_open(site_url('zone/zone/edit/'. $info->id), $attr);?>
                
                <?php if(checkAuth('super')) { ?>
                <div class="form-group">
                    <label class="col-md-3 control-label"> Showroom <span class="req">*</span></label>
                    <div class="col-md-4">
                        <select name="godown_code" class="form-control">
                            <option value="" selected>-- Select showroom --</option>
                            <?php 
                            if(!empty($allGodown)){
                                foreach($allGodown as $item){
                                    echo '<option value="'. $item->code .'" '. (!empty($info) && $info->godown_code == $item->code ? "selected" : "") .'>'. $item->name .' - '. $item->address .' </opton>';
                                }
                            } ?>
                        </select>
                    </div>
                </div>
                <?php }else{ ?>
                    <input type="hidden" name="godown_code" value="<?php echo $info->godown_code; ?>">
                <?php } ?>

                <div class="form-group">
                    <label class="col-md-3 control-label">Zone Name <span class="req">&nbsp;*</span></label>
                    <div class="col-md-4">
                        <input type="text" name="zone"  required value="<?php echo filter($info->zone); ?>" class="form-control">
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

