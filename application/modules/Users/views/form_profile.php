<?php

defined('BASEPATH') OR exit('No direct script access allowed');

?>

<!DOCTYPE html>
<html>
	<head>
		<?php $this->load->view('template/v_header'); ?>
    </head>
    <body class="fixed hold-transition skin-blue-light ">
    	<?php $this->load->view('template/v_left_menu'); ?>
    	<div class="content-wrapper">
    		<section class="content">
    			<?php
						if(!empty($this->session->flashdata('alert'))){
							$msg=$this->session->flashdata('alert');
							?>
						<div id="alert" class="alert <?php echo ($msg['class'] == 0 ? 'alert-danger' : 'alert-success'); ?> alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<h4><i class="icon fa fa-<?php echo ($msg['class'] == 0 ? 'ban' : 'check'); ?>"></i> <?php echo ($msg['class'] == 0 ? 'Alert!' : 'Berhasil!'); ?></h4>
								<?php echo $msg['msg']; ?>
						</div>
					<?php
				}
				?>
    			<div class="row">
						<div class="col-md-12">
							<div class="box box-primary box-solid">
							<div class="box-header with-border">
								  <h3 class="box-title">Profile Pengguna</h3>
								</div>
								<form class="form-horizontal" method="post" action="<?php echo base_url('Users/update_profile'); ?>" enctype="multipart/form-data">
								  <input type="hidden" name="id" value="<?= $user_id ?>">
								  <div  class="box-body">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-2 control-label">Nama Pengguna</label>
									  <div class="col-sm-4">
										<input type="text" name="username" class="form-control" value="<?php echo (isset($username) ? $username : ''); ?>" placeholder="Masukan Nama Pengguna..." required="required">
									  </div>
									</div>

									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-2 control-label">Kata Kunci</label>
									  <div class="col-sm-4">
										<input type="password" name="password" id="password" class="form-control"
												placeholder="Masukan Kata Kunci..." onblur="cekpassword()"
										<?php
										if(!isset($user_id)){
										?>
											required="required">
										<?php
										}else{
										?>
											>
										<?php
										}
										?>
									  </div>
									</div>

									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-2 control-label">Konfirmasi Kata Kunci</label>
									  <div class="col-sm-4">
										<input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Masukan Konfirmasi Kata Kunci...">
									  </div>
									</div>

									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label">Photo</label>
										<div class="col-sm-3">
											<div class="input-group">
												<input type="file" name="user_photo" accept="image/*" class="form-control" id="image-source" onchange="previewImage();">
									 			<br />
												<img width="150px" height="150px" id="image-preview" alt="image preview" src="<?php echo base_url().'assets/userphoto/'.$user_photo; ?>"/>
											</div>
										</div>
									</div>

								  <div class="box-footer">
									<div  class="form-group">
								  		<label for="inputEmail3" class="col-sm-2 control-label"></label>
								  		<div  class="col-sm-10">
								  			<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
								  		</div>
								  	</div>
								  </div>
								  </div>
								</form>

							</div>
						</div>
				</div>
    		</section>
    	</div>
		<?php $this->load->view('template/v_copyright'); ?>
    </body>

    <?php $this->load->view('template/v_footer'); ?>

    <script type="text/javascript">
    $(document).ready(function() {
        $('#alert').delay(10000).fadeOut("slow");
    });

    function cekpassword(){
	    var pswd = $('#password').val();
	    if(pswd != ""){
	    	$("#confirm_password").attr('required', '');
	    }else{
	    	$("#confirm_password").removeAttr('required');
	    }
    }

    function previewImage() {
		document.getElementById("image-preview").style.display = "block";
		var oFReader = new FileReader();
					oFReader.readAsDataURL(document.getElementById("image-source").files[0]);
				oFReader.onload = function(oFREvent) {
					document.getElementById("image-preview").src = oFREvent.target.result;
			};
	};
    </script>
</html>
