<?php

defined('BASEPATH') OR exit('No direct script access allowed');

?>

<!DOCTYPE html>
<html>
	<head>
		<?php $this->load->view('template/v_header'); ?>
    </head>
    <body class="fixed hold-transition skin-blue-light sidebar-mini">
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
								  <h3 class="box-title">Input Data Pengguna</h3>
								</div>
								<form autocomplete="off" class="form-horizontal" method="post" action="<?php echo base_url().(isset($user_id) ? 'Users/update' : 'Users/insert'); ?>" enctype="multipart/form-data">
								  <?php
									if(isset($user_id))
									{
										echo "<input type='hidden' name='id' value='".$user_id."'>";
									}
								  ?>
								  <input name="foilautofill" style="display: none;" type="password" />
								  <div  class="box-body">
										<div class="form-group">
										  <label for="inputEmail3" class="col-sm-2 control-label">Nama Lengkap<sup style="color:red;">*</sup></label>
										  <div class="col-sm-4">
											<input type="text" name="fullname" class="form-control" value="<?php echo (isset($name) ? $name : ''); ?>" placeholder="Masukan Nama Lengkap..." required="required">
										  </div>
										</div>
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-2 control-label">Nama Pengguna<sup style="color:red;">*</sup></label>
									  <div class="col-sm-4">
										<input type="text" name="nama" class="form-control" value="<?php echo (isset($username) ? $username : ''); ?>" placeholder="Masukan Nama Pengguna..." required="required">
									  </div>
									</div>

									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-2 control-label">Kata Kunci<sup style="color:red;">*</sup></label>
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
										<label for="inputEmail3" class="col-sm-2 control-label">Tipe Akses<sup style="color:red;">*</sup></label>
										  <div class="col-sm-4">
											<select class="form-control" name="role_id" id="role_id" required="required">
												<option value = ''>-Pilih Tipe Akses-</option>
												<?php
													foreach($arr_role as $row)
													{
														if($row->role_id == $role_id){
															echo '<option value="'.$row->role_id.'" selected>'.$row->role_name.'</option>';
														}else{
													   		echo '<option value="'.$row->role_id.'">'.$row->role_name.'</option>';
														}
													}
						            			?>
											</select>
										  </div>
									</div>

									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-2 control-label">Status<sup style="color:red;">*</sup></label>

									  <div class="col-sm-2">
											<select name='status' class="form-control" required="required">
												<option value=''>-Pilih Status-</option>
												<option value='Aktif' <?php echo (isset($status) ? ($status == 'Aktif' ? 'selected' : '') : ''); ?>>Aktif</option>
												<option value='Tidak Aktif' <?php echo (isset($status) ? ($status == 'Tidak Aktif' ? 'selected' : '') : ''); ?>>Tidak Aktif</option>
											</select>
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
								  	<div class="pull-left">
										<p>Yang bertanda <span style="color: red;">(*)</span> wajib di isi.</p>
									</div>
									<div class="pull-right">
										<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
										<a href="<?php echo base_url(); ?>Users" class="btn btn-warning"><i class="fa fa-close"></i> Batal</a>
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
    	$('#mnPengaturan').addClass('active');
    	$('#mnUsers').addClass('active');

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
