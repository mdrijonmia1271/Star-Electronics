<style>
    .modal-lg {
        width: 950px;
    }
    .modal-footer {
        text-align:left;
    }
    .company_btn{
        position: fixed;
        padding: 10px 25px;
        top: 8px;
        right: 45%;
        z-index: 999;
        color: #fff;
        background: #8C24A8;
        font-weight: bold;
    }
    .company_btn:hover {
        color: #eee !important;
        background: #9633B0;
    }
    .company_btn:focus {
        color: #eee !important;
        background: #9633B0;
    }
    .address {position: relative;}
    .address .single_pipe {
        position: absolute;
        top: 10px;
        left: 46%;
        height: 85%;
        width: 2px;
        background: #ddd;
    }
    .modal-dialog {
        border-radius: 5px;
    }
    .modal-content {
        -webkit-box-shadow: 0 5px 15px rgba(0,0,0,.5);
        box-shadow: 0 5px 15px #FE9C24;
    }
    address a {color: #222;}
    .modal .bank {
        box-shadow: 0 1px 10px 0px rgba(0,0,0,.14);
        box-sizing: border-box;
        transition: all 0.3s ease-in-out;
        height: 128px;
        overflow: hidden;
        cursor:pointer;
    }
    .modal .bank:hover{
        box-shadow: 0 2px 2px 0 rgba(0,0,0,0.14), 0 1px 5px 0 rgba(0,0,0,0.12), 0 3px 1px -2px rgba(0,0,0,0.2);
    }
    .modal .bank .bank_icon {
        width: 25%;
        float: left;
        padding-left: 15px;
    }
    .modal .bank .bank_icon img {
        margin-top: 15px;
    }
    .modal .bank .bank_info {
        width: 75%;
        float: left;
        padding: 5px 15px;
    }
    .modal .bank .bank_info .heading {
        margin-top: 10px;
    }
    .modal .bank .bank_info .desc {
        font-size: 11px;
    }
    .img-responsive {
        display: inline;
    }
    @media only screen and (max-width: 768px) {
        .modal-lg {width: 100%;}
        .img-responsive {
            width: auto !important;
            height: 100%;
        }
        .address .single_pipe {display: none;}
    }
</style>

<a href="#" class="company_btn" data-toggle="modal" data-target="#companyInfo"> MetaSoft</a>


<div class="modal fade" id="companyInfo" tabindex="-1" role="dialog" aria-labelledby="companyInfo" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h2 class="modal-title text-center" id="myModalLabel">
            <a href="http://www.metasoft.com.bd/" target="_BLANK" style="font-weight: bold;" class="btn btn-link">
               <!--<img class="img-responsive" src="<?php echo site_url('private/devoloper/logo.png'); ?>" alt="pic Not Found !">--->
            </a>
            MetaSoft
        </h2>
      </div>
      <div class="modal-body clearfix">
          
          <div class="address clearfix">
                <div class="col-sm-6 col-xs-12">
                    <h4><strong style="Color: #198BA8;">Mymensingh Office</strong></h4>
                    <address>
                        35 Gulkibari Road, Mymensingh.<br />
                        Mobile: <a href="tel:+8801710511241">01710511241 </a> <br />
                        Phone: <a href="tel:+8801718363737">01718363737 </a> <br />
                        E-mail: akmrimat@gmail.com <br />
                    </address>
                </div>
                
                <span class="single_pipe"></span>
                
                <div class="col-sm-6 col-xs-12">
                    <h4><strong style="Color: #198BA8;">Dhaka Office</strong></h4>
                    <address>
                        10/ka, PC Culture Housing Society Ltd., Ring Road, Shyamoli, Dhaka-1207<br>
                        Mobile: <a href="tel:+8801710511241">01710511241 </a> <br />
                    </address>
                </div>
          </div>
      </div>
      <div class="modal-footer">
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="bank row">
                    <figure class="bank_icon">
                        <img class="img-responsive" src="<?php echo site_url('private/devoloper/bkash.png'); ?>"
                            alt="pic Not Found !">
                    </figure>
                    <div class="bank_info">
                        <h3 class="heading">Bkash</h3>
                        <p class="desc">
                            <i style="color: #ccc;" class="fa fa-chevron-circle-right"></i>
                            &nbsp;01710511241 (Personal)
                        </p>
                        <p class="desc">
                            <i style="color: #ccc;" class="fa fa-chevron-circle-right"></i>
                            &nbsp;01710511241 (Personal)
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="bank row">
                    <figure class="bank_icon">
                        <img class="img-responsive" src="<?php echo site_url('private/devoloper/rocket.png'); ?>"
                            alt="pic Not Found !">
                    </figure>
                    <div class="bank_info">
                        <h3 class="heading">ROCKET</h3>
                        <p class="desc">
                            <i style="color: #ccc;" class="fa fa-chevron-circle-right"></i>
                            &nbsp;01910613232-0 (Personal)
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="bank row">
                    <figure class="bank_icon">
                        <img class="img-responsive" src="<?php echo site_url('private/devoloper/dbbl_bank.png'); ?>"
                            alt="pic Not Found !">
                    </figure>
                    <div class="bank_info">
	                      <h3 class="heading">IBBL Bank</h3>
	                      <p class="desc"><i style="color: #ccc;" class="fa fa-chevron-circle-right"></i> &nbsp;A/C Name: Abu Kaisar</p>
	                      <p class="desc"><i style="color: #ccc;" class="fa fa-chevron-circle-right"></i> &nbsp;A/C No: 20501400204343209</p>
                    </div>
                </div>
            </div>
      </div>
    </div>
    
  </div><div class="col-md-4 col-sm-6 col-xs-12">
                <div class="bank row">
                    <figure class="bank_icon">
                        <img class="img-responsive" src="<?php echo site_url('private/devoloper/dbbl_bank.png'); ?>"
                            alt="pic Not Found !">
                    </figure>
                    <div class="bank_info">
	                      <h3 class="heading">EBL Bank</h3>
	                      <p class="desc"><i style="color: #ccc;" class="fa fa-chevron-circle-right"></i> &nbsp;A/C Name: Abu Kaisar</p>
	                      <p class="desc"><i style="color: #ccc;" class="fa fa-chevron-circle-right"></i> &nbsp;A/C No: 1751440000411</p>
                    </div>
                </div>
            </div>
      </div>
    </div>
    
   <!-- <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="bank row">
                    <figure class="bank_icon">
                        <img class="img-responsive" src="<?php echo site_url('private/devoloper/dbbl_bank.png'); ?>"
                            alt="pic Not Found !">
                    </figure>
                    <div class="bank_info">
	                      <h3 class="heading">City Bank</h3>
	                      <p class="desc"><i style="color: #ccc;" class="fa fa-chevron-circle-right"></i> &nbsp;A/C Name: Abu Kaisar</p>
	                      <p class="desc"><i style="color: #ccc;" class="fa fa-chevron-circle-right"></i> &nbsp;A/C No: 2303470927001</p>
                    </div>
                </div>
            </div>
      </div>
    </div>
</div>--->

<!--<div class="col-md-4 col-sm-6 col-xs-12">
                <div class="bank row">
                    <figure class="bank_icon">
                        <img class="img-responsive" src="<?php echo site_url('private/devoloper/dbbl_bank.png'); ?>"
                            alt="pic Not Found !">
                    </figure>
                    <div class="bank_info">
	                      <h3 class="heading">DBBL Bank</h3>
	                      <p class="desc"><i style="color: #ccc;" class="fa fa-chevron-circle-right"></i> &nbsp;A/C Name: Dorkar Enterprise
	                      <p class="desc"><i style="color: #ccc;" class="fa fa-chevron-circle-right"></i> &nbsp;A/C No: 1561100026096</p>
                    </div>
                </div>
            </div>
      </div>
    </div>--->