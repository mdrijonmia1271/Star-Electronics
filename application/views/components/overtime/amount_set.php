<?php echo $confirmation; ?>
<div class="container-fluid block-hide">
    <div class="row">
        <?php echo $this->session->flashdata("confirmation"); ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panal-header-title pull-left">
                    <h1>Amount Set</h1>
                </div>
            </div>
            
            <div class="panel-body no-padding">
                
                <div class="no-title">&nbsp;</div>

                <!-- left side -->
                
                <div class="col-md-8">
                    <?php 
                        
                        echo form_open('', array('class' => 'form-horizontal')); 
                    ?>
                        <div class="col-md-9">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Amount: </label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="set_amount" value="<?php echo (isset($r_data[0]->amount) ? $r_data[0]->amount : 0 ) ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="btn-group">
                                <input class="btn btn-primary" type="submit" name="save" value="Save">
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>