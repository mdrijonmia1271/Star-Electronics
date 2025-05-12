<div class="container-fluid">
    <div class="row">
	<?php echo $this->session->flashdata('confirmation'); ?>
        <div class="panel panel-default">

            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1>Add Zone</h1>
                </div>
            </div>

            <div class="panel-body">

                <?php $attr = array(
                    'class' =>'form-horizontal'
                    );
	            echo form_open('zone/zone/addzone',$attr); ?>


                <?php if(checkAuth('super')) { ?>
                <div class="form-group">
                    <label class="col-md-3 control-label"> Showroom <span class="req">*</span></label>
                    <div class="col-md-4">
                        <select name="godown_code" class="form-control">
                            <option value="" selected>-- Select showroom --</option>
                            <?php 
                            if(!empty($allGodown)){
                                foreach($allGodown as $item){
                                    echo '<option value="'. $item->code .'" '. (!empty($this->data['branch']) && $this->data['branch'] == $item->code ? "selected" : "") .'>'. $item->name .' - '. $item->address .' </opton>';
                                }
                            } ?>
                        </select>
                    </div>
                </div>
                <?php }else{ ?>
                    <input type="hidden" name="godown_code" value="<?php echo $this->data['branch']; ?>">
                <?php } ?>
                
                
                <div class="form-group">
                    <label class="col-md-3 control-label"> Zone Name <span class="req">*</span></label>
                    <div class="col-md-4">
                        <input type="text" name="zone" placeholder="" class="form-control" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-7">
                        <input type="submit" value="Save" name="catetory_submit" class="btn btn-primary pull-right">
                    </div>
                </div>

                <?php echo form_close(); ?>

            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>

