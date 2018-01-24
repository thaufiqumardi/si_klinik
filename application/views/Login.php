<!DOCTYPE html>
<html>
	<head>
        <?php $this->load->view('template/v_header'); ?>
    </head>
	<body class="hold-transition login-page">
		<div class="login-box">
			<div style="text-align: center;">
				<img src="<?php echo base_url('logo/KMB_Logo.png');?>">
			</div>
		  <div class="login-logo">			
		  </div>
		  <div class="login-box-body">
    		<p class="login-box-msg" id='ResponseInput'>
    			<?php echo $this->session->flashdata('notif') ?>
    		</p>
    		<form action="<?php site_url('Login');?>" method="post">
      			<div class="form-group has-feedback">
        			<input type="text" class="form-control" name="username" id="username" placeholder="Nama Pengguna" required="required">
        			<span class="glyphicon glyphicon-user form-control-feedback"></span>
      			</div>
      			<div class="form-group has-feedback">
					<input type="password" class="form-control" name="password" id="password" placeholder="Kata Sandi" required="required">
        			<span class="glyphicon glyphicon-lock form-control-feedback"></span>
      			</div>
      			<div class="row">
	        		<div class="col-xs-4 pull-right">
	          			<button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
	        		</div>
      			</div>
    		</form>
  		  </div>
	   </div>
		<?php $this->load->view('template/v_footer'); ?>
	</body>
</html>
