<?php

defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE HTML>
<html>
	<head>
		<!-- <link  rel="shortcut icon" type="image/x-icon" href="</?php echo config_item('images'); ?>e-icon.ico" /> -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php echo config_item('web_title'); ?></title>
		<link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css');?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/plugins/font-awesome/css/font-awesome.min.css');?>">
		<script src="<?php echo base_url('assets/plugins/jQuery/jquery-2.2.3.min.js');?>"></script>
		<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js');?>"></script>
		<style type="text/css">
			.four{
					text-align: center;
					    padding: 3em 0;
				}
			.hvr-shutter-in-horizontal {
				  display: inline-block;
				  vertical-align: middle;
				  -webkit-transform: translateZ(0);
				  transform: translateZ(0);
				  box-shadow: 0 0 1px rgba(0, 0, 0, 0);
				  -webkit-backface-visibility: hidden;
				  backface-visibility: hidden;
				  -moz-osx-font-smoothing: grayscale;
				  position: relative;
				  background: #d95459;
				  -webkit-transition-property: color;
				  transition-property: color;
				  -webkit-transition-duration: 0.3s;
				  transition-duration: 0.3s;
				   width: 100%;
				}
				.hvr-shutter-in-horizontal:before {
				  content: "";
				  position: absolute;
				  z-index: -1;
				  top: 0;
				  bottom: 0;
				  left: 0;
				  right: 0;
				  background: #1abc9c;
				  -webkit-transform: scaleX(1);
				  transform: scaleX(1);
				  -webkit-transform-origin: 50%;
				  transform-origin: 50%;
				  -webkit-transition-property: transform;
				  transition-property: transform;
				  -webkit-transition-duration: 0.3s;
				  transition-duration: 0.3s;
				  -webkit-transition-timing-function: ease-out;
				  transition-timing-function: ease-out;
				}
				.hvr-shutter-in-horizontal:hover, .hvr-shutter-in-horizontal:focus, .hvr-shutter-in-horizontal:active {
				  color: white;
				}
				.hvr-shutter-in-horizontal:hover:before, .hvr-shutter-in-horizontal:focus:before, .hvr-shutter-in-horizontal:active:before {
				  -webkit-transform: scaleX(0);
				  transform: scaleX(0);
				}
				.copy-right {
				    padding-top: 5em;
				    text-align: center;
				}
				.four a {
				    font-size: 0.9em;
				    padding: 0.5em 1em;
				    color: #fff;
				    display: block;
				    text-decoration: none;
				    background: #d95459;
				    margin: 0 auto;
				    width: 10%;
				}
		</style>
	</head>
<body>
	<div class="four">
		<img src="<?php echo config_item('images'); ?>404.png" alt="" />
		<a href="<?php echo site_url('beranda'); ?>" class="hvr-shutter-in-horizontal">KEMBALI</a>
		<div class="copy-right">
            <p><?php echo config_item('web_footer'); ?></p>	
    	</div>
	</div>
</body>
</html>