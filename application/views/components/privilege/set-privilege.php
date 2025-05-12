<style>
    .deshitem {
        margin-bottom: 15px !important;
    }
    .delete {
        color: red;
    }
    .view {
        color: green;
    }
    .edit {
        color: #EC971F;
    }
    .checkbox-inline,
    .checkbox label,
    .radio label {
        padding-left: 0;
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
    #progress {
        display: none;
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="panel panel-default">

            <div class="panel-heading panal-header">
                <div class="panal-header-title">
                    <h1 class="pull-left">Set Privilege</h1>
                    <img id="progress" class="pull-right" src="#" alt=""></span>
                </div>
            </div>

            <div class="panel-body">
                <form action="" class="form-horizontal">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Privilege <span class="req">*</span></label>
                        <div class="col-md-5">
                            <select name="privilege" id="privilege" class="form-control" required>
                                <option value="">-- Select --</option>
                                <?php foreach ($privileges as $privilege) { ?>
                                    <option value="<?php echo $privilege->privilege; ?>"><?php echo filter($privilege->privilege); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">User Name<span class="req">*</span></label>
                        <div class="col-md-5">
                            <select name="user_id" id="user_id" class="form-control" required> </select>
                        </div>
                        <div class="col-md-12">
                            <hr style="margin-bottom: 0">
                        </div>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr class="active">
                            <th rowspan="2" width="200" class="text-center" style="vertical-align: middle;">Menu Item
                            </th>
                            <th colspan="3" class="text-center">Navbar Items</th>
                        </tr>
                        </thead>

                        <tbody>
                        <!-- Row Start here -->
                        <tr>
                            <th>
                                <div class="checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-item="menu" value="dashboard">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        <span style="margin-left: 10px;">Dashboard</span>
                                    </label>
                                </div>
                            </th>

                            <td colspan="3" width="">
                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="dashboard" data-item="action"
                                               value="purchase">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;Purchase
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="dashboard" data-item="action" value="stock">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;Stock
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="dashboard" data-item="action"
                                               value="retail_sale">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;Retail Sale
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="dashboard" data-item="action"
                                               value="hire_sale">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;Hire Sale
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="dashboard" data-item="action"
                                               value="weekly_sale">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;Weekly Sale
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="dashboard" data-item="action"
                                               value="dealer_sale">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;Dealer Sale
                                    </label>
                                </div>
                                
                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="dashboard" data-item="action"
                                               value="quotation">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;Quotation
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="dashboard" data-item="action"
                                               value="todays_purchase">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;TODAY'S PURCHASE
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="dashboard" data-item="action"
                                               value="todays_hire_sale">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;TODAY'S HIRE SALE
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="dashboard" data-item="action"
                                               value="todays_due">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;TODAY'S DUE
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="dashboard" data-item="action"
                                               value="todays_total_paid">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;TODAY'S TOTAL PAID
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="dashboard" data-item="action"
                                               value="bank_to_tt">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;BANK TO TT
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="dashboard" data-item="action"
                                               value="supplier_paid">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;SUPPLIER PAID
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="dashboard" data-item="action"
                                               value="bank_withdraw">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;BANK WITHDRAW
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="dashboard" data-item="action"
                                               value="client_collection">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;CLIENT COLLECTION
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="dashboard" data-item="action"
                                               value="bank_deposit">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;BANK DEPOSIT
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="dashboard" data-item="action"
                                               value="cash_to_tt">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;CASH TO TT
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="dashboard" data-item="action"
                                               value="todays_cost">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;TODAY'S COST
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="dashboard" data-item="action"
                                               value="todays_income">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;TODAY'S INCOME
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="dashboard" data-item="action"
                                               value="todays_installment_list">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;Today Installment's List
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="dashboard" data-item="action"
                                               value="todays_commitment_list">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;Today Commitment's List
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <!-- Row End here -->


                        <!-- Row Start here -->
                        <tr>
                            <th>
                                <div class="checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-item="menu" value="category_menu">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        <span style="margin-left: 10px;">Category</span>
                                    </label>
                                </div>
                            </th>

                            <td colspan="3" width="320">
                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="category_menu" data-item="action"
                                               value="add-new">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;Add New
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="category_menu" data-item="action" value="all">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;View All
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <!-- Row End here -->


                        <!-- Row Start here -->
                        <tr>
                            <th>
                                <div class="checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-item="menu" value="subCategory_menu">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        <span style="margin-left: 10px;">Subcategory</span>
                                    </label>
                                </div>
                            </th>

                            <td colspan="3" width="320">
                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="subCategory_menu" data-item="action"
                                               value="add-new">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;Add New
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="subCategory_menu" data-item="action"
                                               value="all">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;View All
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <!-- Row End here -->


                        <!-- Row Start here -->
                        <tr>
                            <th>
                                <div class="checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-item="menu" value="brand_menu">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        <span style="margin-left: 10px;">Brand</span>
                                    </label>
                                </div>
                            </th>

                            <td colspan="3" width="320">
                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="brand_menu" data-item="action"
                                               value="add-new">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;Add New
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="brand_menu" data-item="action" value="all">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;View All
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <!-- Row End here -->

                        <!-- Row Start here -->
                        <tr>
                            <th>
                                <div class="checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-item="menu" value="product_menu">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        <span style="margin-left: 10px;">Product</span>
                                    </label>
                                </div>
                            </th>

                            <td colspan="3" width="320">
                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="product_menu" data-item="action"
                                               value="add-new">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;Add Product
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="product_menu" data-item="action" value="all">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;All Product
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <!-- Row End here -->


                        <!-- Row Start here -->
                        <tr>
                            <th>
                                <div class="checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-item="menu" value="supplier-menu">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        <span style="margin-left: 10px;">Supplier</span>
                                    </label>
                                </div>
                            </th>

                            <td colspan="3" width="320">

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="supplier-menu" data-item="action" value="add">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;Add Supplier
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="supplier-menu" data-item="action" value="all">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;All Supplier
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="supplier-menu" data-item="action"
                                               value="transaction">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;Add Transaction
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="supplier-menu" data-item="action"
                                               value="all-transaction">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;All Transaction
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <!-- Row End here -->
                        
                        <!-- Row Start here -->
                        <tr>
                            <th>
                                <div class="checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-item="menu" value="client_menu">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        <span style="margin-left: 10px;">Customer</span>
                                    </label>
                                </div>
                            </th>

                            <td colspan="3" width="320">
                                
                                <div class="deshitem checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-menu="client_menu" data-item="action" value="add-new">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    &nbsp;Add Zone
                                  </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-menu="client_menu" data-item="action" value="all">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    &nbsp;All Zone
                                  </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="client_menu" data-item="action" value="add">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;Add Customer
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="client_menu" data-item="action" value="all">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;All Customer
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="client_menu" data-item="action"
                                               value="transaction">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;Payment Collection
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="client_menu" data-item="action"
                                               value="all-transaction">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;All Payment Collection
                                    </label>
                                </div>

                            </td>
                        </tr>
                        <!-- Row End here -->


                        <!-- Row Start here -->
                        <tr>
                            <th>
                                <div class="checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-item="menu" value="commitment_menu">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        <span style="margin-left: 10px;">Customer Commitment</span>
                                    </label>
                                </div>
                            </th>

                            <td colspan="3" width="320">
                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="commitment_menu" data-item="action"
                                               value="add">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;Add New
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="commitment_menu" data-item="action"
                                               value="all">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;View All
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <!-- Row End here -->


                        <!-- Row Start here -->
                        <tr>
                            <th>
                                <div class="checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-item="menu" value="purchase_menu">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        <span style="margin-left: 10px;">Purchase</span>
                                    </label>
                                </div>
                            </th>
                            <td colspan="3" width="320">
                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="purchase_menu" data-item="action"
                                               value="add-new">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;Add Purchase
                                    </label>
                                </div>
                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="purchase_menu" data-item="action" value="all">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;All Purchase
                                    </label>
                                </div>
                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="purchase_menu" data-item="action"
                                               value="wise">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;Item Wise
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="purchase_menu" data-item="action"
                                               value="return">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;Add Purchase Return
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="purchase_menu" data-item="action"
                                               value="all_return">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;All Purchase Return
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <!-- Row End here -->


                        <!-- Row Start here -->
                        <tr>
                            <th>
                                <div class="checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-item="menu" value="raw_stock_menu">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        <span style="margin-left: 10px;">Stock</span>
                                    </label>
                                </div>
                            </th>
                            <td colspan="3" width="320"></td>
                        </tr>
                        <!-- Row End here -->
                        
                        <!-- Stock Transfer Start -->
                        <tr>
                            <th>
                                <div class="checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-item="menu" value="stock_transfer_menu">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    <span style="margin-left: 10px;">Stock Transfer</span>
                                  </label>
                                </div>
                            </th>
                            <td colspan="3" width="320"></td>
                        </tr>
                        <!-- Stock Transfer End -->


                        <!-- Row Start here -->
                        <tr>
                            <th>
                                <div class="checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-item="menu" value="raw_stock_menu_date">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        <span style="margin-left: 10px;">Datewise Stock</span>
                                    </label>
                                </div>
                            </th>
                            <td colspan="3" width="320"></td>
                        </tr>
                        <!-- Row End here -->


                        <!-- Row Start here -->
                        <tr>
                            <th>
                                <div class="checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-item="menu" value="sale_menu">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        <span style="margin-left: 10px;">Sale </span>
                                    </label>
                                </div>
                            </th>

                            <td colspan="3" width="320">

                                <!--<div class="deshitem checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-menu="sale_menu" data-item="action" value="add-new">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    &nbsp;Add New
                                  </label>
                                </div>-->

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="sale_menu" data-item="action" value="retail">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;Retail Sale
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="sale_menu" data-item="action" value="hire">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;Hire Sale
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="sale_menu" data-item="action" value="weekly">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;Weekly Sale
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="sale_menu" data-item="action" value="dealer">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;Dealer Sale
                                    </label>
                                </div>
                                
                                
                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="sale_menu" data-item="action" value="quotation">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;Quotation
                                    </label>
                                </div>
                                
                                

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="sale_menu" data-item="action" value="d_c">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;Dealer Chalan
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="sale_menu" data-item="action" value="all">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;View All
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="sale_menu" data-item="action"
                                               value="hire-all">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;All Hire Sale
                                    </label>
                                </div>
                                
                                
                                 <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="sale_menu" data-item="action"
                                               value="all_quotation">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;All Quotation
                                    </label>
                                </div>
                                
                                

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="sale_menu" data-item="action" value="wise">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;Item Wise Search
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="sale_menu" data-item="action"
                                               value="client_search">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;Search Client Wise
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="sale_menu" data-item="action"
                                               value="multi-return">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;Sale Return
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="sale_menu" data-item="action"
                                               value="multi-return-all">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;All Sale Return
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <!-- Row End here -->


                        <!-- Row Start here -->
                        <tr>
                            <th>
                                <div class="checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-item="menu" value="income_menu">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        <span style="margin-left: 10px;">Income</span>
                                    </label>
                                </div>
                            </th>

                            <td colspan="3" width="320">

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="income_menu" data-item="action" value="field">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;Field Of Income
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="income_menu" data-item="action" value="new">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;New Income
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="income_menu" data-item="action" value="all">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;All Income
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <!-- Row End here -->


                        <!-- Row Start here -->
                        <tr>
                            <th>
                                <div class="checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-item="menu" value="cost_menu">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        <span style="margin-left: 10px;">Cost</span>
                                    </label>
                                </div>
                            </th>

                            <td colspan="3" width="320">
                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="cost_menu" data-item="action"
                                               value="all_cost_category">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;Cost Category
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="cost_menu" data-item="action" value="field">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;Field Of Cost
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="cost_menu" data-item="action" value="new">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;New Cost
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="cost_menu" data-item="action" value="all">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;All Cost
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <!-- Row End here -->
                        
                        <!-- Md Transaction Start -->
                        <tr>
                            <th>
                                <div class="checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-item="menu" value="md_transaction_menu">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    <span style="margin-left: 10px;">Md Transaction</span>
                                  </label>
                                </div>
                            </th>

                            <td colspan="3" width="320">
                                 <div class="deshitem checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-menu="md_transaction_menu" data-item="action" value="field">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    &nbsp;Add New Investor
                                  </label>
                                </div>
                                
                                <div class="deshitem checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-menu="md_transaction_menu" data-item="action" value="all">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    &nbsp;New Md Transaction
                                  </label>
                                </div>
                                
                                <div class="deshitem checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-menu="md_transaction_menu" data-item="action" value="all_trx">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    &nbsp;All Md Transaction
                                  </label>
                                </div>
                                
                                 <div class="deshitem checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-menu="md_transaction_menu" data-item="action" value="balance">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    &nbsp; Balance Report
                                  </label>
                                </div>
                                
                            </td>
                        </tr>
                        <!-- Md Transaction End -->


                        <!-- Row Start here -->
                        <tr>
                            <th>
                                <div class="checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-item="menu" value="due_list_menu">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        <span style="margin-left: 10px;">Due List</span>
                                    </label>
                                </div>
                            </th>

                            <td colspan="3" width="320">
                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="due_list_menu" data-item="action"
                                               value="cash">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;Retail Due
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="due_list_menu" data-item="action"
                                               value="retail_due_collection">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;Retail Due Colle.
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="due_list_menu" data-item="action"
                                               value="dealer_list">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;Dealer Due
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="due_list_menu" data-item="action"
                                               value="credit">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;Hire Due
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="due_list_menu" data-item="action"
                                               value="weekli_list">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;Weekly Due
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="due_list_menu" data-item="action"
                                               value="supplier_due">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;Supplier Due
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <!-- Row End here -->



   
                        <!-- Row Start here -->
                        <tr>
                            <th>
                                <div class="checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-item="menu" value="employee_menu">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    <span style="margin-left: 10px;">Employee</span>
                                  </label>
                                </div>
                            </th>

                            <td colspan="3" width="320">

                                <div class="deshitem checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-menu="employee_menu" data-item="action" value="add-new">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    &nbsp;Add New
                                  </label>
                                </div>
                                
                                <div class="deshitem checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-menu="employee_menu" data-item="action" value="all">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    &nbsp;View All
                                  </label>
                                </div>
                            </td>
                        </tr>
                        <!-- Row End here -->
                        
                        <!-- Row Start here -->
                        <tr>
                            <th>
                                <div class="checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-item="menu" value="attendance_menu">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    <span style="margin-left: 10px;">Employee Attendance</span>
                                  </label>
                                </div>
                            </th>

                            <td colspan="3" width="320">

                                <div class="deshitem checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-menu="attendance_menu" data-item="action" value="add-new">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    &nbsp;Take Attendance
                                  </label>
                                </div>
                                
                                <div class="deshitem checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-menu="attendance_menu" data-item="action" value="all">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    &nbsp;All Attendance
                                  </label>
                                </div>
                            </td>
                        </tr>
                        <!-- Row End here -->
                        
                        <!-- Row Start here -->
                        <tr>
                            <th>
                                <div class="checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-item="menu" value="salary_menu">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    <span style="margin-left: 10px;">Salary</span>
                                  </label>
                                </div>
                            </th>

                            <td colspan="3" width="320">

                               
                                <div class="deshitem checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-menu="salary_menu" data-item="action" value="salary">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    &nbsp;Basic
                                  </label>
                                </div>
                                
                                <div class="deshitem checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-menu="salary_menu" data-item="action" value="bonus">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    &nbsp;Bonus
                                  </label>
                                </div>
                                
                                <div class="deshitem checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-menu="salary_menu" data-item="action" value="advanced">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    &nbsp;Advanced
                                  </label>
                                </div>
                                
                                <div class="deshitem checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-menu="salary_menu" data-item="action" value="payment">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    &nbsp;Payment
                                  </label>
                                </div>
                                
                                <div class="deshitem checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-menu="salary_menu" data-item="action" value="all_payment">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    &nbsp;All Payment
                                  </label>
                                </div>
                            </td>
                        </tr>
                        <!-- Row End here -->
                        
                        
                        
                        <!-- Row Start here -->
                        <tr>
                            <th>
                                <div class="checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-item="menu" value="attendance_menu">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    <span style="margin-left: 10px;">Employee Attendance</span>
                                  </label>
                                </div>
                            </th>

                            <td colspan="3" width="320">

                                <div class="deshitem checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-menu="attendance_menu" data-item="action" value="add-new">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    &nbsp;Add Attendance
                                  </label>
                                </div>
                                
                                <div class="deshitem checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-menu="attendance_menu" data-item="action" value="all">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    &nbsp;All Attendance
                                  </label>
                                </div>

                            </td>
                        </tr>
                        <!-- Row End here -->
                        
                        
                        
                        <!-- Row Start here -->
                        <tr>
                            <th>
                                <div class="checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-item="menu" value="overtime_menu">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    <span style="margin-left: 10px;">Overtime</span>
                                  </label>
                                </div>
                            </th>

                            <td colspan="3" width="320">

                                <div class="deshitem checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-menu="overtime_menu" data-item="action" value="add-new">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    &nbsp;Add New
                                  </label>
                                </div>
                                
                                <div class="deshitem checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-menu="overtime_menu" data-item="action" value="all">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    &nbsp;View All
                                  </label>
                                </div>
                            </td>
                        </tr>
                        <!-- Row End here -->
                        
                        
                        
                        <!-- Row Start here -->
                        <tr>
                            <th>
                                <div class="checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-item="menu" value="leave_menu">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    <span style="margin-left: 10px;">Leave Management</span>
                                  </label>
                                </div>
                            </th>

                            <td colspan="3" width="320">

                                <div class="deshitem checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-menu="leave_menu" data-item="action" value="add-new">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    &nbsp;Add New
                                  </label>
                                </div>
                                
                                <div class="deshitem checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-menu="leave_menu" data-item="action" value="all">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    &nbsp;Show Leave
                                  </label>
                                </div>

                            </td>
                        </tr>
                        <!-- Row End here -->
                        

                        <!-- Row Start here -->
                        <tr>
                            <th>
                                <div class="checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-item="menu" value="bank_menu">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        <span style="margin-left: 10px;">Banking</span>
                                    </label>
                                </div>
                            </th>

                            <td colspan="3" width="320">
                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="bank_menu" data-item="action"
                                               value="add-bank">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;Add Bank
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="bank_menu" data-item="action" value="add-new">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;Add Account
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="bank_menu" data-item="action" value="all-acc">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;All Account
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="bank_menu" data-item="action" value="add">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;Add Transaction
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="bank_menu" data-item="action" value="ledger">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;Bank Ledger
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <!-- Row End here -->


                        <!-- Row Start here -->
                        <tr>
                            <th>
                                <div class="checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-item="menu" value="loan-menu">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        <span style="margin-left: 10px;">Loan</span>
                                    </label>
                                </div>
                            </th>

                            <td colspan="3" width="320">
                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="loan-menu" data-item="action" value="add-new">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;New Loan
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="loan-menu" data-item="action" value="all">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;All Loan
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="loan-menu" data-item="action" value="trans">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;Add Transaction
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="loan-menu" data-item="action" value="all_trx">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;All Transaction
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <!-- Row End here -->


                        <!-- Row Start here -->
                        <tr>
                            <th>
                                <div class="checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-item="menu" value="ledger">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        <span style="margin-left: 10px;">Ledger</span>
                                    </label>
                                </div>
                            </th>

                            <td colspan="3" width="320">
                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="ledger" data-item="action"
                                               value="company-ledger">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;Supplier Ledger
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="ledger" data-item="action"
                                               value="client-ledger">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;All Customer Ledger
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="ledger" data-item="action"
                                               value="customer-ledger">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;Customer Ledger
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="ledger" data-item="action"
                                               value="dealer-ledger">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;Dealer Ledger
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <!-- Row End here -->


                        <!-- Row Start here -->
                        <tr>
                            <th>
                                <div class="checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-item="menu" value="report_menu">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        <span style="margin-left: 10px;">Report</span>
                                    </label>
                                </div>
                            </th>

                            <td colspan="3" width="320">
                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="report_menu" data-item="action"
                                               value="purchase_report">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;Purchase Report
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="report_menu" data-item="action"
                                               value="purchase_report_item">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;Purchase Item Report
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="report_menu" data-item="action"
                                               value="sales_report">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;Sale Report
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="report_menu" data-item="action"
                                               value="sales_report_item">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;Sale Item Report
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="report_menu" data-item="action"
                                               value="income_report">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;Income Report
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="report_menu" data-item="action"
                                               value="cost_report">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;Cost Report
                                    </label>
                                </div>

                                <!-- <div class="deshitem checkbox checkbox-inline view">
                                  <label>
                                    <input type="checkbox" data-menu="report_menu" data-item="action" value="product_profit">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    &nbsp;Product Wise Profit/Loss
                                  </label>
                                </div> -->

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="report_menu" data-item="action"
                                               value="client_profit">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;Client Wise Profit/Loss
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="report_menu" data-item="action"
                                               value="balance_report">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;Cash Book
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <!-- Row End here -->


                        <!-- Row Start here -->
                        <tr>
                            <th>
                                <div class="checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-item="menu" value="sms_menu">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        <span style="margin-left: 10px;">Mobile SMS</span>
                                    </label>
                                </div>
                            </th>

                            <td colspan="3" width="320">

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="sms_menu" data-item="action" value="send-sms">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;Send
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="sms_menu" data-item="action"
                                               value="custom-sms">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;Custom
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="sms_menu" data-item="action"
                                               value="sms-report">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;Report
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <!-- Row End here -->


                        <!-- Row Start here -->
                        <tr>
                            <th>
                                <div class="checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-item="menu" value="complain_menu">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        <span style="margin-left: 10px;">Complain</span>
                                    </label>
                                </div>
                            </th>

                            <td colspan="3" width="320">

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="complain_menu" data-item="action" value="new">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;Add Complain
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="complain_menu" data-item="action" value="all">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;All Complain
                                    </label>
                                </div>

                            </td>
                        </tr>
                        <!-- Row End here -->


                        <!-- Row Start here -->
                        <tr>
                            <th>
                                <div class="checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-item="menu" value="access_info">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        <span style="margin-left: 10px;">Access Info</span>
                                    </label>
                                </div>
                            </th>

                            <td colspan="3" width="320"></td>
                        </tr>
                        <!-- Row End here -->


                        <!-- Row Start here -->
                        <tr>
                            <th>
                                <div class="checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-item="menu" value="privilege-menu">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        <span style="margin-left: 10px;">Privilege</span>
                                    </label>
                                </div>
                            </th>

                            <td colspan="3" width="320"></td>
                        </tr>
                        <!-- Row End here -->


                        <!-- Row Start here -->
                        <tr>
                            <th>
                                <div class="checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-item="menu" value="theme_menu">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        <span style="margin-left: 10px;"> Settings</span>
                                    </label>
                                </div>
                            </th>

                            <td colspan="3" width="320">
                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="theme_menu" data-item="action" value="logo">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;Banner / Icon
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="theme_menu" data-item="action" value="tools">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;Theme Tools
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <!-- Row End here -->


                        <!-- Row Start here -->
                        <tr>
                            <th>
                                <div class="checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-item="menu" value="backup_menu">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        <span style="margin-left: 10px;">Data Backup</span>
                                    </label>
                                </div>
                            </th>

                            <td colspan="3" width="320">

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="backup_menu" data-item="action"
                                               value="add-new">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;Export
                                    </label>
                                </div>

                                <div class="deshitem checkbox checkbox-inline view">
                                    <label>
                                        <input type="checkbox" data-menu="backup_menu" data-item="action" value="all">
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        &nbsp;Import
                                    </label>
                                </div>

                            </td>
                        </tr>
                        <!-- Row End here -->

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        // get all users
        $('select#privilege').on("change", function () {
            var data = [];
            var obj = {'privilege': $(this).val()};
            $.ajax({
                type: "POST",
                url: "<?php echo site_url("ajax/retrieveBy/users"); ?>",
                data: "condition=" + JSON.stringify(obj)
            }).done(function (response) {
                var items = $.parseJSON(response);
                data.push('<option value="">-- Select --</option>');
                $.each(items, function (i, el) {
                    data.push('<option value="' + el.id + '">' + el.username + '</option>');
                });
                $('select#user_id').html(data);
            });
        });
        $("#check_view").on('change', function (event) {
            if ($(this).is(":checked")) {
                $('input[type="checkbox"][value="view"]').prop({checked: true});
            } else {
                $('input[type="checkbox"][value="view"]').prop({checked: false});
            }
        });
        $("#check_edit").on('change', function (event) {
            if ($(this).is(":checked")) {
                $('input[type="checkbox"][value="edit"]').prop({checked: true});
            } else {
                $('input[type="checkbox"][value="edit"]').prop({checked: false});
            }
        });
        $("#check_delete").on('change', function (event) {
            if ($(this).is(":checked")) {
                $('input[type="checkbox"][value="delete"]').prop({checked: true});
            } else {
                $('input[type="checkbox"][value="delete"]').prop({checked: false});
            }
        });
        //Getting All Menu Name It's Just for use the data
        var input = $('input[type="checkbox"][data-item="menu"]');
        var list = [];
        $.each(input, function (index, el) {
            list.push($(el).val());
        });
        // console.log(list);
        //Set Privilege Data Start
        $('input[type="checkbox"]').on('change', function (event) {
            if ($('select[name="privilege"]').val() != "" && $('select[name="user_id"]').val() != "") {
                $("#progress").fadeIn(300);
                //Collecting all data start here
                var access_item = {};
                var input = $('input[type="checkbox"]');
                $.each(input, function (index, el) {
                    if ($(el).is(":checked")) {
                        //access_item.push($(el).val());
                        if ($(el).data("item") == "menu") {
                            //action data collection Start here
                            var ac_el = $('input[data-menu="' + $(el).val() + '"]');
                            var action_data = [];
                            $.each(ac_el, function (ac_i, ac_el) {
                                if ($(ac_el).is(":checked")) {
                                    action_data.push($(ac_el).val());
                                }
                            });
                            //action data collection End here
                            access_item[$(el).val()] = action_data;
                        }
                    }
                });
                //console.log(access_item);
                var access = JSON.stringify(access_item);
                //console.log(access);
                var privilege_name = $('select[name="privilege"]').val();
                var user_id = $('select[name="user_id"]').val();
                //Collecting All data end here
                //Sending Request Start here
                $.ajax({
                    url: '<?php echo site_url("privilege/privilege/set_privilege_ajax"); ?>',
                    type: 'POST',
                    data: {
                        privilege_name: privilege_name,
                        user_id: user_id,
                        access: access
                    }
                })
                    .done(function (response) {
                        //console.log(response);
                        $("#progress").fadeOut(300);
                    });
                //Sending Request End here
            } else {
                alert("Please select a Privilege and User Name.");
                return false
            }
        });
        //Set Privilege Data End
        //Get Privilege Data Start
        $('select[name="user_id"]').on('change', function (event) {
            $('input[type="checkbox"]').prop({checked: false});
            //Sending Request Start here
            var user_id = $(this).val();
            var privilege_name = $('#privilege').val();
            $.ajax({
                url: '<?php echo site_url("privilege/privilege/get_privilege_ajax"); ?>',
                type: 'POST',
                data: {user_id: user_id, privilege_name: privilege_name}
            }).done(function (response) {
                if (response != "error") {
                    var data = $.parseJSON(response);
                    access = $.parseJSON(data.access);
                    //console.log(access);
                    $.each(access, function (access_index, access_val) {
                        //console.log(access_index);
                        //data-item="menu" value="theme_ettings"
                        $('input[data-item="menu"][value="' + access_index + '"]').prop({checked: true});
                        $.each(access_val, function (action_in, action_val) {
                            $('input[data-item="action"][data-menu="' + access_index + '"][value="' + action_val + '"]').prop({checked: true});
                        });
                        //$('input[name="'+el.module_name+'"][value="'+access_val+'"]').prop({checked: true});
                    });
                }
            });
            //Sending Request End here
        });
        //Get Privilege Data End
    });
</script>