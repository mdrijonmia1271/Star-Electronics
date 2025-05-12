<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>  
  $(document).on('mousemove', function(e) {
    var xMouse = e.pageX;
    var yMouse = e.pageY;
    if (Math.random() < 0.1) {
      setTimeout(function() {
        var l = document.createElement("DIV");
        var size = (Math.floor(Math.random() * (30 - 10)) + 10);
        l.style.width = size + "px";
        l.style.height = size + "px";
        l.style.backgroundImage = "url(https://cdn.shopify.com/s/files/1/0382/4185/files/flowers.png?14993667430825853990)";
        var bg_pos = (Math.floor(Math.random() * 4));
        l.style.backgroundPosition = "0px -"+(size*bg_pos)+"px";
        l.style.backgroundSize = size + "px "+4*size+"px"
        l.style.position = "absolute";
        l.style.left = (xMouse) + "px";
        l.style.top = (yMouse + 10) + "px";
        l.style.zIndex = 9999;
        l.style.display = 'none';
        document.body.appendChild(l);
        $(l).fadeIn(100);
        var stop = false;
        var hoaroi = function() {
          if (!stop) {
            setTimeout(function() {
              window.requestAnimationFrame(hoaroi);
            }, 20);
            l.style.top = (parseInt($(l).css('top'), 10) + 1) + "px";
            if ((parseInt($(l).css('top'), 10)) % 10 == 0) {
              if (Math.random() < 0.5) {
                l.style.left = (parseInt($(l).css('left'), 10) + 1) + "px";
              } else {
                l.style.left = (parseInt($(l).css('left'), 10) - 1) + "px";
              }
            }
          }
        }
        window.requestAnimationFrame(hoaroi);
        $(l).fadeOut((Math.floor(Math.random() * (2500 - 1000)) + 1000), function() {
          $(l).remove();
          stop = true;
        });
      }, 50);
    }
  });
  </script>
<div class="container-fluid">
    <div class="row">
	<?php echo $this->session->flashdata('confirmation'); ?>
        <div class="panel panel-default">

            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1>Add SR Payment</h1>
                </div>
            </div>

            <div class="panel-body">

                <?php $attr = array(
                    'class' =>'form-horizontal'
                    );
	            echo form_open('dsr/dsr_payment/add_payment', $attr); ?>

                <div class="form-group">
                    <label class="col-md-3 control-label"> Code <span class="req">*</span></label>
                    <div class="col-md-4">
                        <input type="text" name="dsr" value="<?php echo $dsrInfo[0]->code; ?>" class="form-control" required readonly>
                        <input type="hidden" name="pay_invoice" value="<?php echo 'SRI'.generateUniqueId('dsr_payment'); ?>" class="form-control" required readonly>
                        <input type="hidden" name="date" value="<?php echo date('Y-m-d'); ?>" class="form-control" required readonly>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-md-3 control-label"> Name <span class="req">*</span></label>
                    <div class="col-md-4">
                        <input type="text" value="<?php echo $dsrInfo[0]->name; ?>" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label"> Mobile <span class="req">*</span></label>
                    <div class="col-md-4">
                        <input type="text" value="<?php echo $dsrInfo[0]->mobile; ?>" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label"> Address <span class="req">*</span></label>
                    <div class="col-md-4">
                        <input type="text" value="<?php echo $dsrInfo[0]->address; ?>" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label"> Area <span class="req">*</span></label>
                    <div class="col-md-4">
                        <input type="text" value="<?php echo $dsrInfo[0]->area; ?>" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label"> Voucher No. <span class="req">*</span></label>
                    <div class="col-md-4">
                        <input type="text" name="voucher_no" value="<?php echo $dsrInfo[0]->voucher_no; ?>" class="form-control" required readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label"> Commission Amount <span class="req">*</span></label>
                    <div class="col-md-4">
                        <input type="number" name="dsr_bill" value="<?php echo $dsrInfo[0]->dsr_commission; ?>" class="form-control" required readonly>
                    </div>
                </div>
                
                <?php 
                    $dsrPaid = get_sum('dsr_payment', 'dsr_paid', ['voucher_no' => $dsrInfo[0]->voucher_no, 'trash' => 0]);
                    $dsrRemaining = $dsrInfo[0]->dsr_commission - $dsrPaid;
                ?>

                <div class="form-group">
                    <label class="col-md-3 control-label"> Previous Paid <span class="req">*</span></label>
                    <div class="col-md-4">
                        <input type="number" value="<?php echo $dsrPaid; ?>" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label"> Remaining Amount <span class="req">*</span></label>
                    <div class="col-md-4">
                        <input type="number" value="<?php echo $dsrRemaining; ?>" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label"> Payment <span class="req">*</span></label>
                    <div class="col-md-4">
                        <input type="number" name="dsr_paid" value="" class="form-control" required>
                    </div>
                </div>

                <!--<div class="form-group">
                    <label class="col-md-3 control-label"> Current Remaining <span class="req">*</span></label>
                    <div class="col-md-4">
                        <input type="number" name="" value="<?php echo ''; ?>" class="form-control" readonly>
                    </div>
                </div>-->

                <div class="form-group">
                    <div class="col-md-7">
                        <input type="submit" value="Save" class="btn btn-primary pull-right">
                    </div>
                </div>

                <?php echo form_close(); ?>

            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>

