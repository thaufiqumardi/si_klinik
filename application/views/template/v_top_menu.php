<?php

defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style type="text/css">
/* btn-signout */
.btn-signout {
    background-color: darkred !important;
    cursor: pointer;
}
.btn-signout:hover {
    background-color: maroon !important;
}
.btn-signout div {
    width: 12px;
    overflow: hidden;
    white-space: nowrap;
    /* transition */
    -webkit-transition: width 0.4s;
    -moz-transition: width 0.4s;
    -o-transition: width 0.4s;
    transition: width 0.4s;
}
.btn-signout:hover div {
    width: 70px;
}
</style>
<header class="main-header">
	<a href="index2.html" class="logo">
    	<span class="logo-mini"><b>SK</b></span>
    	<span class="logo-lg"><b>JASA PRIMA </b></span>
    </a>
    <nav class="navbar navbar-static-top">
    	<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
	    	<span class="sr-only">Toggle navigation</span>
	    </a>
	    <div class="navbar-custom-menu">
	    	<ul class="nav navbar-nav">
	    		<li class="dropdown user user-menu">
	    			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
              			<img src="<?= base_url('assets/userphoto').'/'.$this->session->userdata['simklinik']['ap_image'];?>" class="user-image" alt="">
              			<span class="hidden-xs"><?= ucfirst($this->session->userdata['simklinik']['ap_name']);?></span>
            		</a>
	    		</li>
					<li>
            <a class="btn-signout" href="<?=site_url('Master/home/logout');?>" onclick="logout()">
              <div><i class="fa fa-sign-out"></i> Log Out</div>
            </a>
          </li>
	    	</ul>
	    </div>
    </nav>
</header>
