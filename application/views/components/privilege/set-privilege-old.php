<style>
    .delete{color: red;}
    .view{color: green;}
    .edit{color: #EC971F;}

    .checkbox-inline,
    .checkbox label,
    .radio label{
        padding-left: 0;
        padding-right: 10px;
        font-weight: bold;
    }

    .checkbox label:after,
    .radio label:after {
        content: '';
        display: table;
        clear: both;
    }

    .checkbox .cr,
    .radio .cr {
        position: relative;
        display: inline-block;
        border: 1px solid #a9a9a9;
        border-radius: .25em;
        width: 1.3em;
        height: 1.3em;
        float: left;
        margin-right: .5em;
    }

    .radio .cr {
        border-radius: 50%;
    }

    .checkbox .cr .cr-icon,
    .radio .cr .cr-icon {
        position: absolute;
        font-size: .8em;
        line-height: 0;
        top: 50%;
        left: 20%;
    }

    .radio .cr .cr-icon {
        margin-left: 0.04em;
    }

    .checkbox label input[type="checkbox"],
    .radio label input[type="radio"] {
        display: none;
    }

    .checkbox label input[type="checkbox"] + .cr > .cr-icon,
    .radio label input[type="radio"] + .cr > .cr-icon {
        transform: scale(3) rotateZ(-20deg);
        opacity: 0;
        transition: all .3s ease-in;
    }

    .checkbox label input[type="checkbox"]:checked + .cr > .cr-icon,
    .radio label input[type="radio"]:checked + .cr > .cr-icon {
        transform: scale(1) rotateZ(0deg);
        opacity: 1;
    }

    .checkbox label input[type="checkbox"]:disabled + .cr,
    .radio label input[type="radio"]:disabled + .cr {
        opacity: .5;
    }
    #progress{display: none ;}
</style>
<div class="container-fluid">
    <div class="row">
	<?php echo $this->session->flashdata('confirmation'); ?>
        <div class="panel panel-default">

            <div class="panel-heading panal-header">
                <div class="panal-header-title">
                    <h1 class="pull-left">Set Privilege</h1>
                    <img id="progress" class="pull-right" src="<?php echo site_url("private/images/loder.gif"); ?>" alt=""></span>
                </div>
            </div>

            <div class="panel-body">

                <form action="" class="form-horizontal">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Privilege  <span class="req">*</span></label>
                        <div class="col-md-5">
                            <select name="privilege" class="form-control" required>
                                <option value="">-- Select --</option>
                                <?php foreach ($privileges as $privilege) { ?>
                                <option value="<?php echo $privilege->privilege; ?>"><?php echo filter($privilege->privilege); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-7">
                            <hr style="margin-bottom: 0">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Customer </label>
                        <div class="col-md-5">
                            <div class="checkbox checkbox-inline edit">
                              <label>
                                <input type="checkbox" name="client" value="upgrade">
                                <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                Upgrade
                              </label>
                            </div>

                            <div class="checkbox checkbox-inline view">
                              <label>
                                <input type="checkbox" name="client" value="view">
                                <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                 View
                              </label>
                            </div>

                            <div class="checkbox checkbox-inline edit">
                              <label>
                                <input type="checkbox" name="client"  value="edit">
                                <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                 Edit
                              </label>
                            </div>

                            <div class="checkbox checkbox-inline delete">
                              <label>
                                <input type="checkbox" name="client"  value="delete">
                                <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                 Delete
                              </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Sale </label>
                        <div class="col-md-5">
                            <div class="checkbox checkbox-inline view">
                              <label>
                                <input type="checkbox" name="sale" value="view">
                                <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                 View
                              </label>
                            </div>

                            <div class="checkbox checkbox-inline edit">
                              <label>
                                <input type="checkbox" name="sale"  value="edit">
                                <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                 Edit
                              </label>
                            </div>

                            <div class="checkbox checkbox-inline delete">
                              <label>
                                <input type="checkbox" name="sale"  value="delete">
                                <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                 Delete
                              </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Bank Account </label>
                        <div class="col-md-5">
                            <div class="checkbox checkbox-inline edit">
                              <label>
                                <input type="checkbox" name="bank_account"  value="edit">
                                <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                 Edit
                              </label>
                            </div>

                            <div class="checkbox checkbox-inline delete">
                              <label>
                                <input type="checkbox" name="bank_account"  value="delete">
                                <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                 Delete
                              </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Order </label>
                        <div class="col-md-5">
                            <div class="checkbox checkbox-inline view">
                              <label>
                                <input type="checkbox" name="order" value="view">
                                <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                 View
                              </label>
                            </div>

                            <div class="checkbox checkbox-inline edit">
                              <label>
                                <input type="checkbox" name="order"  value="edit">
                                <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                 Edit
                              </label>
                            </div>

                            <div class="checkbox checkbox-inline delete">
                              <label>
                                <input type="checkbox" name="order"  value="delete">
                                <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                 Delete
                              </label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        //Set Privilege Data Start
        $('input[type="checkbox"]').on('change', function(event) {
            if($('select[name="privilege"]').val()!=""){
                $("#progress").fadeIn(300);
                //Collecting all data start here
                var access_item = [];
                var m_name = $(this).attr("name");
                var siblings_item = $('input[name="'+m_name+'"]');
                $.each(siblings_item,function(index, el) {
                    if($(el).is(":checked")){
                        access_item.push($(el).val());
                    }
                });
                var access = JSON.stringify(access_item);
                var privilege_name = $('select[name="privilege"]').val();
                //Collecting All data end here
                //Sending Request Start here
                $.ajax({
                    url: '<?php echo site_url("privilege/privilege/set_privilege_ajax"); ?>',
                    type: 'POST',
                    data: {
                        privilege_name: privilege_name,
                        module_name:m_name,
                        access:access
                    }
                })
                .done(function(response) {
                    //console.log(response);
                    $("#progress").fadeOut(300);
                });
                //Sending Request End here
            }else{
                alert("Please select a privilege");
                return false
            }
        });
        //Set Privilege Data End

        //Get Privilege Data Start
        $('select[name="privilege"]').on('change', function(event) {
            $('input[type="checkbox"]').prop({checked:false});
            //Sending Request Start here
            var privilege_name = $(this).val();
            $.ajax({
                url: '<?php echo site_url("privilege/privilege/get_privilege_ajax"); ?>',
                type: 'POST',
                data: {privilege_name:privilege_name}
            })
            .done(function(response) {
                if(response!="error"){
                    var data = $.parseJSON(response);
                    $.each(data,function(index, el) {
                        console.log(el);
                        var access =$.parseJSON(el.access);
                        $.each(access,function(access_index,access_val){
                            $('input[name="'+el.module_name+'"][value="'+access_val+'"]').prop({checked: true});
                        });
                    });
                }
            });
            //Sending Request End here
        });
        //Get Privilege Data End
    });
</script>
