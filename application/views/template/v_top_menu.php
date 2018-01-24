<?php

defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<header class="main-header">
	<a href="index2.html" class="logo">
    	<span class="logo-mini"><b>SK</b></span>
    	<span class="logo-lg"><b>SIM KLINIK</b></span>
    </a>
    <nav class="navbar navbar-static-top">
    	<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
	    	<span class="sr-only">Toggle navigation</span>
	    </a>
	    <div class="navbar-custom-menu">
	    	<ul class="nav navbar-nav">
	    		<li class="dropdown user user-menu">
	    			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
              			<!-- <img src="</?php echo base_url('assets/dist/img/user2-160x160.jpg');?>" class="user-image" alt=""> -->
              			<span class="hidden-xs">Nama Pengguna: <?php echo $this->session->userdata['simklinik']['ap_username'];?></span>
            		</a>
            		<ul class="dropdown-menu">
            			<li class="user-header">
            				<img src="<?php echo base_url('assets/dist/img/user2-160x160.jpg');?>" class="img-circle" alt="">
                			<p>
                				<?php echo $this->session->userdata['simklinik']['ap_role_name'];?>
                			</p>
            			</li>
            			<li class="user-footer">
            				<div class="pull-left">
                  				<a href="<?php echo site_url('Users/users_profile\/').$this->session->userdata['simklinik']['ap_sid'];?>" class="btn btn-default btn-flat">Profile</a>
                			</div>
                			<div class="pull-right">
                  				<a href="<?= site_url('Master/home/logout');?>" class="btn btn-default btn-flat">logout</a>
                			</div>
            			</li>
            		</ul>
	    		</li>
	    	</ul>
	    </div>
    </nav>
    
</header>