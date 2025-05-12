<?php
    require_once('application/smr/smr.php');
    new Smr('deshboard');
?>
<style>
    ul li a span.icon {
        margin-right: 20px;
        float: right;
    }
    .aside-head {
        position: fixed;
        z-index: 2;
        width: 150px;
    }
    .sidebar-brand {
        position: absolute;
        width: 250px;
        z-index: 2;
        transition: all 0.4s ease-in-out;
    }
    .sidebar-brand.sidebar-slide {
        transition: all 0.4s ease-in-out;
        transform: translateX(-100%);
    }
    .aside-nav {
        margin-top: 65px;
        z-index: -3;
    }
    @media screen and (max-width: 768px){
        .sidebar-brand {
            transition: all 0.4s ease-in-out;
            transform: translateX(-100%);
        }
        .sidebar-brand.sidebar-slide {
            transition: all 0.4s ease-in-out;
            transform: translateX(0%);
        }
    }
</style>

<aside id="sidebar-wrapper">
    <div class="sidebar-nav">
        <h3 class="sidebar-brand <?php if($this->data['width'] == 'full-width') {echo 'sidebar-slide';} ?>">
			<a style="font-size: 23px !important;" href="<?php echo site_url('super/dashboard'); ?>">Admin <span>Panel</span></a>
		</h3>
    </div>
    <nav class="aside-nav">
        <ul class="sidebar-nav">
            <li id="dashboard">
                <a href="<?php echo site_url('super/dashboard'); ?>">
                    <i class="fa fa-home" aria-hidden="true"></i> Dashboard
                </a>
            </li>
            
            <li id="category_menu">
                <a href="#category" data-toggle="collapse">
                    <i class="fa fa-product-hunt" aria-hidden="true"></i> Category
                    <span class="icon"><i class="fa fa-sort-desc"></i></span>
                </a>
                <ul id="category" class="sidebar-nav collapse">
                    <li>
                        <a href="<?php echo site_url('category/category'); ?>">
                            <i class="fa fa-angle-right"></i>
                            Add New
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo site_url('category/category/allCategory'); ?>">
                            <i class="fa fa-angle-right"></i>
                            View All
                        </a>
                    </li>
                </ul>
            </li>
            
            
            <li id="subCategory_menu">
                <a href="#subCategory" data-toggle="collapse">
                    <i class="fa fa-product-hunt" aria-hidden="true"></i> Subcategory
                    <span class="icon"><i class="fa fa-sort-desc"></i></span>
                </a>
                <ul id="subCategory" class="sidebar-nav collapse">
                    <li>
                        <a href="<?php echo site_url('subCategory/subCategory'); ?>">
                            <i class="fa fa-angle-right"></i>
                            Add New
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo site_url('subCategory/subCategory/all_subcategory'); ?>">
                            <i class="fa fa-angle-right"></i>
                            View All
                        </a>
                    </li>
                </ul>
            </li>


            <li id="brand_menu">
                <a href="#brand" data-toggle="collapse">
                    <i class="fa fa-product-hunt" aria-hidden="true"></i> Brand
                    <span class="icon"><i class="fa fa-sort-desc"></i></span>
                </a>
                <ul id="brand" class="sidebar-nav collapse">
                    <li>
                        <a href="<?php echo site_url('brand/brand'); ?>">
                            <i class="fa fa-angle-right"></i>
                            Add New
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo site_url('brand/brand/all_brand'); ?>">
                            <i class="fa fa-angle-right"></i>
                            View All
                        </a>
                    </li>
                </ul>
            </li>

            <li id="fixed_assate_menu">
                <a href="#fixed_assate" data-toggle="collapse">
                    <i class="fa fa-bar-chart"></i> Fixed assate
                    <span class="icon"><i class="fa fa-sort-desc"></i></span>
                </a>
                <ul id="fixed_assate" class="sidebar-nav collapse">
                    <li>
                        <a href="<?php echo site_url('fixed_assate/fixed_assate'); ?>">
                            <i class="fa fa-angle-right"></i> Field of Fixed Assate
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo site_url('fixed_assate/fixed_assate/newfixed_assate'); ?>">
                            <i class="fa fa-angle-right"></i> New Fixed Assate
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo site_url('fixed_assate/fixed_assate/allfixed_assate'); ?>">
                            <i class="fa fa-angle-right"></i> All Fixed Assate
                        </a>
                    </li>
                </ul>
            </li>
            
            
            <li id="product_menu">
                <a href="#product" data-toggle="collapse">
                    <i class="fa fa-product-hunt" aria-hidden="true"></i> Product
                    <span class="icon"><i class="fa fa-sort-desc"></i></span>
                </a>
                <ul id="product" class="sidebar-nav collapse">
                    <li>
                        <a href="<?php echo site_url('product/product'); ?>">
                            <i class="fa fa-angle-right"></i>
                            Add Product
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo site_url('product/product/allProduct'); ?>">
                            <i class="fa fa-angle-right"></i>
                            All Product
                        </a>
                    </li>
                </ul>
            </li>
            

            <li id="supplier-menu">
                <a href="#company" data-toggle="collapse">
                    <i class="fa fa-building-o"></i> Supplier
                    <span class="icon"><i class="fa fa-sort-desc"></i></span>
                </a>
                <ul id="company" class="sidebar-nav collapse">
                    <li>
                        <a href="<?php echo site_url('supplier/supplier');?>">
                            <i class="fa fa-angle-right"></i>
                            Add Supplier
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo site_url('supplier/supplier/view_all'); ?>">
                            <i class="fa fa-angle-right"></i>
                            All Supplier
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo site_url('supplier/transaction/'); ?>">
                            <i class="fa fa-angle-right"></i>
                            Add Transaction
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo site_url('supplier/all_transaction'); ?>">
                            <i class="fa fa-angle-right"></i>
                            All Transaction
                        </a>
                    </li>
                </ul>
            </li>


            <li id="client_menu">
                <a href="#client" data-toggle="collapse">
                    <i class="fa fa-users"></i> Customer
                    <span class="icon"><i class="fa fa-sort-desc"></i></span>
                </a>
                <ul id="client" class="sidebar-nav collapse">
                    <li>
                        <a href="<?php echo site_url('zone/zone'); ?>">
                            <i class="fa fa-angle-right"></i>
                            Add Zone
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo site_url('zone/zone/allzone'); ?>">
                            <i class="fa fa-angle-right"></i>
                            All Zone
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo site_url('client/client');?>">
                            <i class="fa fa-angle-right"></i>
                            Add Customer
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo site_url('client/client/view_all'); ?>">
                            <i class="fa fa-angle-right"></i>
                            All Customer
                        </a>
                    </li>
                    
                     <li>
                        <a href="<?php echo site_url('client/transaction/'); ?>">
                            <i class="fa fa-angle-right"></i>
                            Payment Collection
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo site_url('client/all_transaction'); ?>">
                            <i class="fa fa-angle-right"></i>
                            All Payment Collection
                        </a>
                    </li>
                </ul>
            </li>
            
            
            <li id="dsr_menu">
                <a href="#dsr" data-toggle="collapse">
                    <i class="fa fa-product-hunt" aria-hidden="true"></i> Sales Person
                    <span class="icon"><i class="fa fa-sort-desc"></i></span>
                </a>
                <ul id="dsr" class="sidebar-nav collapse">
                    <li>
                        <a href="<?php echo site_url('dsr/dsr'); ?>">
                            <i class="fa fa-angle-right"></i>
                            Add New
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('dsr/dsr/allDsr'); ?>">
                            <i class="fa fa-angle-right"></i>
                            View All
                        </a>
                    </li>
                </ul>
            </li>
            
            
            <li id="commitment_menu">
                <a href="#commitment" data-toggle="collapse" title="Customer Commitment">
                    <i class="fa fa-users"></i> Customer Com. 
                    <span class="icon"><i class="fa fa-sort-desc"></i></span>
                </a>
                <ul id="commitment" class="sidebar-nav collapse">
                    <li>
                        <a href="<?php echo site_url('client/commitment');?>">
                            <i class="fa fa-angle-right"></i>
                            Add New
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo site_url('client/commitment/view_all'); ?>">
                            <i class="fa fa-angle-right"></i>
                            View All
                        </a>
                    </li>
                </ul>
            </li>


            <li id="purchase_menu">
                <a href="#purchase" data-toggle="collapse">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> Purchase
                    <span class="icon"><i class="fa fa-sort-desc"></i></span>
                </a>
                <ul id="purchase" class="sidebar-nav collapse">
                    <li>
                        <a href="<?php echo site_url('purchase/purchase'); ?>">
                            <i class="fa fa-angle-right"></i>
                            Add Purchase
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo site_url('purchase/purchase/show_purchase'); ?>">
                            <i class="fa fa-angle-right"></i>
                            All Purchase
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo site_url('purchase/purchase/itemWise'); ?>">
                            <i class="fa fa-angle-right"></i>
                            Item Wise
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo site_url('purchase/productReturn'); ?>">
                            <i class="fa fa-angle-right"></i>
                            Add Purchase Return
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo site_url('purchase/productReturn/allReturn'); ?>">
                            <i class="fa fa-angle-right"></i>
                            All Purchase Return
                        </a>
                    </li>
                </ul>
            </li>


            <li id="raw_stock_menu">
                <a href="<?php echo site_url('stock/stock'); ?>">
                    <i class="fa fa-bar-chart" aria-hidden="true"></i> Stock
                </a>
            </li>
            
            
            <li id="stock_transfer_menu">
                <a href="<?php echo site_url('stock/stock/transfer'); ?>">
                    <i class="fa fa-bar-chart" aria-hidden="true"></i> Stock Transfer
                </a>
            </li>
            
            
             <li id="raw_stock_menu_date">
                <a href="<?php echo site_url('stock/real_stock'); ?>">
                    <i class="fa fa-bar-chart" aria-hidden="true"></i>
                    Datewise Real Stock
                </a>
            </li>
            

            <li id="sale_menu">
                <a href="#sales" data-toggle="collapse">
                    <i class="fa fa-shopping-cart"></i> Sale
                    <span class="icon"><i class="fa fa-sort-desc"></i></span>
                </a>
                <ul id="sales" class="sidebar-nav collapse">
                    <li>
                        <a href="<?php echo site_url('sale/retail_sale'); ?>">
                            <i class="fa fa-angle-right"></i>
                            Retail Sale
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo site_url('sale/hire_sale'); ?>">
                            <i class="fa fa-angle-right"></i>
                            Hire Sale
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo site_url('sale/quotation'); ?>">
                            <i class="fa fa-angle-right"></i>
                             Quotation
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo site_url('sale/weekly_sale'); ?>">
                            <i class="fa fa-angle-right"></i>
                            Weekly Sale
                        </a>
                    </li> 
                    
                    <li>
                        <a href="<?php echo site_url('sale/dealerSale'); ?>">
			                <i class="fa fa-angle-right"></i>
			                Dealer Sale
		                </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo site_url('sale/DealerChalan'); ?>">
			                <i class="fa fa-angle-right"></i>
			                Dealer Chalan
		                </a>
                    </li>

                    <li>
                        <a href="<?php echo site_url('sale/search_sale'); ?>">
                            <i class="fa fa-angle-right"></i>
                            View All
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo site_url('sale/search_sale/hireSale'); ?>">
                            <i class="fa fa-angle-right"></i>
                            All Hire Sale
                        </a>
                    </li>
                    
                     <li>
                        <a href="<?php echo site_url('sale/all_quotation'); ?>">
                            <i class="fa fa-angle-right"></i>
                             All Quotation
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo site_url('sale/sale/itemWise'); ?>">
                            <i class="fa fa-angle-right"></i>
                            Search Item Wise
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo site_url('sale/client_search'); ?>">
                            <i class="fa fa-angle-right"></i>
                            Search Client Wise
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo site_url('sale/multiSaleReturn'); ?>">
                            <i class="fa fa-angle-right"></i>
                            Sale Return
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo site_url('sale/multiSaleReturn/all'); ?>">
                            <i class="fa fa-angle-right"></i>
                            All Sale Return
                        </a>
                    </li>
                </ul>
            </li>
            
            
            <li id="income_menu">
                <a href="#income" data-toggle="collapse">
                    <i class="fa fa-money"></i> Income
                    <span class="icon"><i class="fa fa-sort-desc"></i></span>
                </a>
                <ul id="income" class="sidebar-nav collapse">
                    <li>
                        <a href="<?php echo site_url('income/income'); ?>">
                            <i class="fa fa-angle-right"></i> Field of Income
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo site_url('income/income/newIncome'); ?>">
                            <i class="fa fa-angle-right"></i>
                            New Income
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo site_url('income/income/all'); ?>">
                            <i class="fa fa-angle-right"></i>
                            All Income
                        </a>
                    </li>
                </ul>
            </li>
            

            <li id="cost_menu">
                <a href="#cost" data-toggle="collapse">
                    <i class="fa fa-money"></i> Cost
                    <span class="icon"><i class="fa fa-sort-desc"></i></span>
                </a>
                <ul id="cost" class="sidebar-nav collapse">
                    <li>
                        <a href="<?php echo site_url('cost_category/cost_category'); ?>">
                            <i class="fa fa-angle-right"></i>
                            Cost Category
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo site_url('cost/cost'); ?>">
                            <i class="fa fa-angle-right"></i>
                            Field of Cost
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo site_url('cost/cost/newcost'); ?>">
                            <i class="fa fa-angle-right"></i>
                            New Cost
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo site_url('cost/cost/allcost'); ?>">
                            <i class="fa fa-angle-right"></i>
                            All Cost
                        </a>
                    </li>
                </ul>
            </li>
            
            
            <li id="md_transaction_menu">
                <a href="#md_transaction" data-toggle="collapse">
                    <i class="fa fa-bar-chart"></i> Md Transaction
                    <span class="icon"><i class="fa fa-sort-desc"></i></span>
                </a>
                <ul id="md_transaction" class="sidebar-nav collapse">
                    
                     <li>
                        <a href="<?php echo site_url('md_transaction/fixed_assate'); ?>">
                            <i class="fa fa-angle-right"></i>
                            Add New Investor
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo site_url('md_transaction/md_transaction'); ?>">
                            <i class="fa fa-angle-right"></i>
                            New Md Transaction
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo site_url('md_transaction/md_transaction/allMd_transaction'); ?>">
                            <i class="fa fa-angle-right"></i>
                            All Md Transaction
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo site_url('md_transaction/md_transaction/balance_report'); ?>">
                            <i class="fa fa-angle-right"></i>
                            Balance Report
                        </a>
                    </li>
                </ul>
            </li>
            

            <li id="due_list_menu">
                <a href="#due_list" data-toggle="collapse">
                    <i class="fa fa-male"></i> Due List
                    <span class="icon"><i class="fa fa-sort-desc"></i></span>
                </a>
                <ul id="due_list" class="sidebar-nav collapse">
                    <li>
                        <a href="<?php echo site_url('due_list/due_list'); ?>">
                            <i class="fa fa-angle-right"></i>
                            Retail Due
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo site_url('due_list/due_list/retail_due_collection'); ?>">
                            <i class="fa fa-angle-right"></i>
                            Retail Due Colle.
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php  echo site_url('due_list/due_list/dealer_due'); ?>">
                            <i class="fa fa-angle-right"></i>
                            Dealer Due
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo site_url('due_list/due_list/credit'); ?>">
                            <i class="fa fa-angle-right"></i>
                            Hire Due
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php  echo site_url('due_list/due_list/weekli_due'); ?>">
                            <i class="fa fa-angle-right"></i>
                            Weekly Due
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo site_url('supplier/supplier/view_all/due'); ?>">
                            <i class="fa fa-angle-right"></i>
                            Supplier Due
                        </a>
                    </li>
                </ul>
            </li>


            <li id="bank_menu">
                <a href="#bank" data-toggle="collapse">
                    <i class="fa fa-university"></i> Banking
                    <span class="icon"><i class="fa fa-sort-desc"></i></span>
                </a>
                <ul id="bank" class="sidebar-nav collapse">
                    <li>
                        <a href="<?php echo site_url('bank/bankInfo/add_bank'); ?>">
                            <i class="fa fa-angle-right"></i>
                            Add Bank
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo site_url('bank/bankInfo'); ?>">
                            <i class="fa fa-angle-right"></i>
                            Add Account
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo site_url('bank/bankInfo/all_account'); ?>">
                            <i class="fa fa-angle-right"></i>
                            All Account
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo site_url('bank/bankInfo/transaction'); ?>">
                            <i class="fa fa-angle-right"></i>
                            Add Transaction
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo site_url('bank/bankInfo/ledger'); ?>">
                            <i class="fa fa-angle-right"></i>
                            Bank Ledger
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo site_url('bank/bankInfo/all_transaction'); ?>">
                            <i class="fa fa-angle-right"></i>
                            all Transaction
                        </a>
                    </li>
                </ul>
            </li>
            
            
            <li id="employee_menu">
                <a href="#employee" data-toggle="collapse">
                    <i class="fa fa-male"></i> Employee
                    <span class="icon"><i class="fa fa-sort-desc"></i></span>
                </a>
                <ul id="employee" class="sidebar-nav collapse">
                    <li>
                        <a href="<?php echo site_url('employee/employee');?>">
                            <i class="fa fa-angle-right"></i>
                            Add New
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo site_url('employee/employee/show_employee'); ?>">
                            <i class="fa fa-angle-right"></i>
                            View All
                        </a>
                    </li>
                </ul>
            </li>
            
            

            <li id="attendance_menu">
                <a href="#attendance" data-toggle="collapse">
                    <i class="fa fa-male"></i> Employee Attendance
                    <span class="icon"><i class="fa fa-sort-desc"></i></span>
                </a>
                <ul id="attendance" class="sidebar-nav collapse">
                    <li>
                        <a href="<?php echo site_url('attendance/attendance');?>">
                            <i class="fa fa-angle-right"></i>
                            Add Attendance
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo site_url('attendance/attendance/all'); ?>">
                            <i class="fa fa-angle-right"></i>
                            All Attendance
                        </a>
                    </li>
                </ul>
            </li>


            <li id="salary_menu">
                <a href="#salary" data-toggle="collapse">
                    <i class="fa fa-money"></i> Salary
                    <span class="icon"><i class="fa fa-sort-desc"></i></span>
                </a>
                <ul id="salary" class="sidebar-nav collapse">
                    <li>
                        <a href="<?php echo site_url('salary/salary');?>">
                            <i class="fa fa-angle-right"></i>
                            Basic
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo site_url('salary/salary/bonus'); ?>">
                            <i class="fa fa-angle-right"></i>
                            Bonus
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo site_url('salary/salary/advanced'); ?>">
                            <i class="fa fa-angle-right"></i>
                            Advanced
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo site_url('salary/payment'); ?>">
                            <i class="fa fa-angle-right"></i>
                            Payment
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo site_url('salary/payment/all_payment'); ?>">
                            <i class="fa fa-angle-right"></i>
                            All Payment
                        </a>
                    </li>
                </ul>
            </li>


            <li id="overtime_menu">
                <a href="#overtime" data-toggle="collapse">
                    <i class="fa fa-male"></i> Overtime
                    <span class="icon"><i class="fa fa-sort-desc"></i></span>
                </a>
                <ul id="overtime" class="sidebar-nav collapse">
                    <li>
                        <a href="<?php echo site_url('overtime/overtime');?>">
                            <i class="fa fa-angle-right"></i>
                            Add New
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo site_url('overtime/overtime/all'); ?>">
                            <i class="fa fa-angle-right"></i>
                            View All
                        </a>
                    </li>

                </ul>
            </li>


            <li id="leave_menu">
                <a href="#leave" data-toggle="collapse">
                    <i class="fa fa-paper-plane"></i> leave management
                    <span class="icon"><i class="fa fa-sort-desc"></i></span>
                </a>
                <ul id="leave" class="sidebar-nav collapse">
                    <li>
                        <a href="<?php echo site_url('leave_management/leaveView');?>">
                            <i class="fa fa-angle-right"></i>
                            Add New
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo site_url('leave_management/leaveView/show');?>">
                            <i class="fa fa-angle-right"></i>
                            Show Leave
                        </a>
                    </li>
                </ul>
            </li>
            
            
            <li id="loan-menu">
                <a href="#loan" data-toggle="collapse">
                    <i class="fa fa-money" aria-hidden="true"></i> Loan
                    <span class="icon"><i class="fa fa-sort-desc"></i></span>
                </a>
                <ul id="loan" class="sidebar-nav collapse">
                    <li>
                        <a href="<?php echo site_url('loan_new/loan_new'); ?>">
                            <i class="fa fa-angle-right"></i>
                            New Loan
                        </a>
                    </li>
            
                    <li>
                        <a href="<?php echo site_url('loan_new/loan_new/all'); ?>">
                            <i class="fa fa-angle-right"></i>
                            All Loan
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo site_url('loan_new/loan_new/add_trx'); ?>">
                            <i class="fa fa-angle-right"></i>
                            Add Transaction
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo site_url('loan_new/loan_new/all_trx'); ?>">
                            <i class="fa fa-angle-right"></i>
                            All Transaction
                        </a>
                    </li>
                    
                </ul>
            </li>
            

            <li id="ledger">
                <a href="#ledger-menu" data-toggle="collapse">
                    <i class="fa fa-money"></i> Ledger
                    <span class="icon"><i class="fa fa-sort-desc"></i></span>
                </a>
                <ul id="ledger-menu" class="sidebar-nav collapse">
                    <li>
                        <a href="<?php echo site_url('ledger/companyLedger'); ?>">
                            <i class="fa fa-angle-right"></i>
                            Supplier Ledger
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo site_url('ledger/clientLedger'); ?>">
                            <i class="fa fa-angle-right"></i>
                            All Customer Ledger
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo site_url('ledger/clientLedger?type=hire'); ?>">
                            <i class="fa fa-angle-right"></i>
                            Hire Ledger
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo site_url('ledger/clientLedger?type=weekly'); ?>">
                            <i class="fa fa-angle-right"></i>
                            Weekly Ledger
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo site_url('ledger/clientLedger?type=dealer'); ?>">
                            <i class="fa fa-angle-right"></i>
                            Dealer Ledger
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo site_url('ledger/productLedger'); ?>">
                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                            Product Ledger
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo site_url('ledger/categoryLedger'); ?>">
                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                            Category Ledger
                        </a>
                    </li>
                </ul>
            </li>
            

            <li id="report_menu">
                <a href="#report" data-toggle="collapse">
                    <i class="fa fa-money"></i> Report
                    <span class="icon"><i class="fa fa-sort-desc"></i></span>
                </a>
                <ul id="report" class="sidebar-nav collapse">
                    <li>
                        <a href="<?php echo site_url('report/purchase_report');?>">
                            <i class="fa fa-angle-right"></i>
                            Purchase Report
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo site_url('report/sales_report');?>">
                            <i class="fa fa-angle-right"></i>
                            Sales Report
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo site_url('report/income_report');?>">
                            <i class="fa fa-angle-right"></i>
                            Income Report
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo site_url('report/cost_report');?>">
                            <i class="fa fa-angle-right"></i>
                            Cost Report
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo site_url('report/client_profit');?>">
                            <i class="fa fa-angle-right"></i>
                            Profit / Loss
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo site_url('report/sale_profit');?>">
                            <i class="fa fa-angle-right"></i>
                            Sale Profit
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo site_url('report/balance_report');?>">
                            <i class="fa fa-angle-right"></i>
                            Cash Book
                        </a>
                    </li>
                </ul>
            </li>
            
            
            <li id="analytical_report_menu">
                <a href="#analytical_report" data-toggle="collapse">
                    <i class="fa fa-money"></i> Analytical Report
                    <span class="icon"><i class="fa fa-sort-desc"></i></span>
                </a>
                <ul id="analytical_report" class="sidebar-nav collapse">
                    <li>
                        <a href="<?php echo site_url('report/analytical_report');?>">
                            <i class="fa fa-angle-right"></i>
                            Sales Report
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo site_url('report/analytical_report/client_collection');?>">
                            <i class="fa fa-angle-right"></i>
                            Collection Report
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo site_url('report/analytical_report/supplier_purchase');?>">
                            <i class="fa fa-angle-right"></i>
                            Purchase Report
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo site_url('report/analytical_report/supplier_payment');?>">
                            <i class="fa fa-angle-right"></i>
                            Payment Report
                        </a>
                    </li>
                </ul>
            </li>
            
            
            <li id="sms_menu">
                <a href="#sms" data-toggle="collapse">
                    <i class="fa fa-envelope-o"></i> Mobile SMS
                    <span class="icon"><i class="fa fa-sort-desc"></i></span>
                </a>
                <ul id="sms" class="sidebar-nav collapse">
                    <li>
                        <a href="<?php echo site_url('sms/sendSms');?>">
                            <i class="fa fa-angle-right"></i>
                            Send
                        </a>
                    </li>
            
                    <li>
                        <a href="<?php echo site_url('sms/sendSms/send_custom_sms'); ?>">
                            <i class="fa fa-angle-right"></i>
                            Custom
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo site_url('sms/sendSms/sms_report'); ?>">
                            <i class="fa fa-angle-right"></i>
                            Report
                        </a>
                    </li>
                </ul>
            </li>
            
            
            <li id="complain_menu">
                <a href="#complain" data-toggle="collapse">
                    <i class="fa fa-calendar-times-o"></i> Complain
                    <span class="icon"><i class="fa fa-sort-desc"></i></span>
                </a>
                <ul id="complain" class="sidebar-nav collapse">
                    <li>
                        <a href="<?php echo site_url('new_complain/new_complain');?>">
                            <i class="fa fa-angle-right"></i>
                            Add Complain
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo site_url('new_complain/new_complain/all');?>">
                            <i class="fa fa-angle-right"></i>
                            All complain
                        </a>
                    </li>
                </ul>
            </li>
            
            
            <li id="access_info">
                <a href="<?php echo site_url('access_info/access_info');?>">
                    <i class="fa fa-cog"></i> Access Info
                </a>
            </li>
            
            
            <li id="privilege-menu">
                <a href="<?php echo site_url('privilege/privilege');?>">
                    <i class="fa fa-cog"></i> Privilege
                </a>
            </li>
            
            
            <li id="theme_menu">
                <a href="#theme" data-toggle="collapse">
                    <i class="fa fa-cog"></i> Settings
                    <span class="icon"><i class="fa fa-sort-desc"></i></span>
                </a>
                <ul id="theme" class="sidebar-nav collapse">
                    <li>
                        <a href="<?php echo site_url('theme/themeSetting');?>">
                            <i class="fa fa-angle-right"></i>
                            Banner/Icons
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo site_url('theme/themeSetting/theme_tools');?>">
                            <i class="fa fa-angle-right"></i>
                            Theme Tools
                        </a>
                    </li>
                </ul>
            </li>
            
            
            <!--<li id="backup_menu">
                <a href="#backup" data-toggle="collapse">
                    <i class="fa fa-database"></i> Data Backup
                    <span class="icon"><i class="fa fa-sort-desc"></i></span>
                </a>
                <ul id="backup" class="sidebar-nav collapse">
                    <li>
                        <a href="<?php echo site_url('data_backup');?>">
                            <i class="fa fa-angle-right"></i>
                            Export Data
                        </a>--->
                    </li>
                </ul>
            </li>
            

            <li>&nbsp;</li>
            <li>&nbsp;</li>
            <li>&nbsp;</li>
            <li>&nbsp;</li>
        </ul>
        
        <style>
            .support_btn a.btn_support:focus, .support_btn a.btn_support:hover,
            .support_btn a.btn_support:active, .support_btn a.btn_support:visited,
            .support_btn a.btn_support {
                overflow: hidden;
                outline: none;
                border: none;
                clear: both;
            }
            .support_btn {
                position: fixed;
                left: 0;
                bottom: 0;
                width: 250px;
            }
            .support_btn a.btn_support {
                background: #1A237E;
                font-size: 19px;
                width: 100%;
                color: #fff;
                transition: all 0.4s ease-in-out;
            }
            .support_btn a.btn_support:hover {
                background: #5C6BC0;
                color: #eee;
            }
        </style>
        <div class="support_btn">
            <a href="<?php echo site_url('support'); ?>" class="btn btn_support">
                <i class="fa fa-question-circle" aria-hidden="true"></i> Support
            </a>
        </div>
    </nav>
</aside>


<style>
    .warning {
        background: rgba(255, 255, 255, 0.85);
        justify-content: center;
        align-items: center;
        height: 100vh;
        display: flex;
        width: 100%;
        position: fixed;
        z-index: 99999;
        top: 0;
        left: 0;
        color: red;
        display: none;
        user-select: none;
        font-family: serif;
    }
</style>

<div class="warning">
    <div>
        <h1>YOU'R OFFLINE</h1>
    </div>
</div>

<script>
    if(navigator.connection) {
        navigator.connection.onchange = function () {
            var warning = document.querySelector('.warning');
            if (navigator.onLine) {
                warning.style.display = 'none';
            } else {
                warning.style.display = 'flex';
            }
        }
    }
</script>