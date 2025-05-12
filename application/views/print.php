<?php
    $banner_images = get_result('banner');
    if(isset($meta->header)){$header_info = json_decode($meta->header,true);}
	if(isset($meta->footer)){$footer_info = json_decode($meta->footer,true);}
	$logo_data  = json_decode($meta->logo,true);
?>

<div class="__print-border hide">
    <?php
        $this->load->helper('url');
        $module = $this->uri->segment(1);
    ?>
    <div class="__info">
        <?php  
            $branch = $this->session->userdata('branch');
            if($branch){$branch_info =$this->action->read('godowns',array('code' => $branch));}
            if(!empty($branch_info)){
        ?>
            <!--<h2 class="site_name"><?php echo strtoupper($header_info['site_name']); ?></h2>-->
            <h2 class="site_name"><?php echo $branch_info[0]->name; ?></h2>
    	    <!--<p>Showroom:<?php echo $branch_info[0]->name; ?></p>-->
    	    <p>  <?php echo $branch_info[0]->address; ?></p>
    	    <p>  <?php  echo $branch_info[0]->mobile; ?></p>
	    <?php }else{ ?>
    	    <h2 class="site_name"><?php echo strtoupper($header_info['site_name']); ?></h2>
    	    <p><?php echo $header_info['place_name'];?></p>
    	    <p id="_mobile_"><?php echo $footer_info['addr_moblile']; ?> || <?php echo $footer_info['addr_email']; ?></p>
	    <?php } ?>
    </div>
</div>
<!--<div class="__print-border hide">
    <div class="print_banner">
        <img src="<?php echo site_url($banner_images[0]->path); ?>" alt="Banner">
    </div>
</div>-->

<style>
    .__print-border {
        margin-bottom: 25px;
        padding: 10px 0;
        text-align: center;
    }
    .print_banner {
        margin: -8px 0 0;
        width: 100%;
    }
    .print_banner img {
        max-height: 180px;
        max-width: 100%;
        width: 100%;
    }
    .__logo img {margin-top: 10px;}
    .__info h2, .__info p {margin: 0;}
    .hide {display: none;}
    .site_name {
        color: red !important;
        font-weight: 700;
        font-size: 32px;
    }
</style>