<?php 	if(isset($meta->header)){$header_info = json_decode($meta->header,true);}
    	if(isset($meta->footer)){$footer_info = json_decode($meta->footer,true);}
    	$logo_data  = json_decode($meta->logo,true); ?>

    <div class="row">
        <div class="col-xs-12">
            <div class="__print-border hide">
                <div class="row">
                    
                    <?php 
                            $this->load->helper('url');
                            $module = $this->uri->segment(1);
                            
                    ?>

                        <div class="col-xs-12">
                    
                        <div class="__info">
                            <?php  
                                $branch = $this->session->userdata('branch');
                                if($branch){
                                    $branch_info =$this->action->read('godowns',array('code' => $branch));
                                    
                                }
                                if(!empty($branch_info)){
                            ?>
                                <h2 class="site_name"><?php echo strtoupper($header_info['site_name']); ?></h2>
                        	    <p>All kinds of goods whole seller & retailer</p>
                        	    <p>Showroom:<?php echo $branch_info[0]->name; ?></p>
                        	    <p>Mobile No :<?php  echo $branch_info[0]->mobile;  echo ' || ';  ?>  Address : <?php echo $branch_info[0]->address; ?></p>
                    	        <!--<p>Mail :<?php //echo $footer_info['addr_email']; ?></p>-->
                    	    <?php }else{ ?>
                        	    <h2 class="site_name"><?php echo strtoupper($header_info['site_name']); ?></h2>
                        	    <p><?php echo $header_info['place_name'];?></p>
                        	    <p id="_mobile_"><?php  echo $footer_info['addr_moblile']; ?>  <!--<?php //echo $footer_info['addr_email']; ?>--></p>
                    	    <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <style>
        .hide > h3, .hide > h4 {
            margin: 2px 0 10px 0;
        }
        .__print-border {
            padding: 5px 0;
        }
        .__logo img {
            margin-top: 10px;
        }
        .__info h2, .__info p {
            margin: 0;
        }
        .hide {
            display: none;
        }
         @media print{
            aside, nav, .none, .panel-heading, .panel-footer, .company_btn{
                display: none !important;
            }
            .panel{
                border: 1px solid transparent;
                left: 0px;
                position: absolute;
                top: 0px;
                width: 100%;
            }
            .hide{
                display: block !important;
            }
            .site_name {
                color: red !important;
                font-weight: 700;
            }
        }
    </style>