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
								  <h3 class="box-title">Input Data Hak Akses</h3>
								</div>								
								<form class="form-horizontal" method="post" action="<?php echo base_url().(isset($id_hak_akses) ? 'Previlleges/update' : 'Previlleges/insert'); ?>">
								  <?php
									if(isset($id_hak_akses))
									{
										echo "<input type='hidden' name='id' value='".$id_hak_akses."'>";
									}
								  ?>		
								  <div  class="box-body">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-2 control-label">Tipe Akses<sup style="color:red;">*</sup></label>
									  <div class="col-sm-4">
										<select class="form-control" name="hak_akses_role" id="hak_akses_role"
										<?php 
										if(isset($id_hak_akses)){
											echo 'disabled="disabled"';
										}else{
											echo 'required="required"';
										}
										?>
										>
											<option value = ''>-Pilih Tipe Akses-</option>
											<?php 
												foreach($arr_role as $row)
												{ 
													if($row->role_id == $hak_akses_role){
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
									  <label for="inputEmail3" class="col-sm-2 control-label">Menu<sup style="color:red;">*</sup></label>
									  <div class="col-sm-4">
										<select class="form-control" name="hak_akses_menu" id="hak_akses_menu"
										<?php 
										if(isset($id_hak_akses)){
											echo 'disabled="disabled"';
										}else{
											echo 'required="required"';
										}
										?>
										>
											<option value = ''>-Pilih Menu-</option>
											<?php 
												foreach($arr_menu as $row)
												{ 
													if($row->id_menu == $hak_akses_menu){
														echo '<option value="'.$row->id_menu.'" selected>'.$row->title.'</option>';
													}else{
												   		echo '<option value="'.$row->id_menu.'">'.$row->title.'</option>';							           			
													}
												}
					            			?>
										</select>
									  </div>
									</div>		
									
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-2 control-label">Hak Akses</label>
									  <div class="col-sm-4">
									  	<input type="checkbox" class="css-checkbox" id="hak_akses_retrive"
					                            name="hak_akses_retrive" value="0" <?php if($hak_akses_retrive=='1') { echo "checked='checked'";}?> />
					    				<label for="hak_akses_retrive" style="vertical-align: middle; font-weight: normal;">Tampil</label>
									  </div>
									</div>	
									
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-2 control-label"></label>
									  <div class="col-sm-4">
									  	<input type="checkbox" class="css-checkbox-prev" id="hak_akses_create"
					                            name="hak_akses_create" value="0" <?php if($hak_akses_create=='1') { echo "checked='checked'";}?> />
					    				<label for="hak_akses_create" style="vertical-align: middle; font-weight: normal;">Tambah</label>
									  </div>
									</div>
									
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-2 control-label"></label>
									  <div class="col-sm-4">
									  	<input type="checkbox" class="css-checkbox-prev" id="hak_akses_update"
					                            name="hak_akses_update" value="0" <?php if($hak_akses_update=='1') { echo "checked='checked'";}?> />
					    				<label for="hak_akses_update" style="vertical-align: middle; font-weight: normal;">Ubah</label>
									  </div>
									</div>
									
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-2 control-label"></label>
									  <div class="col-sm-4">
									  	<input type="checkbox" class="css-checkbox-prev" id="hak_akses_delete"
					                            name="hak_akses_delete" value="0" <?php if($hak_akses_delete=='1') { echo "checked='checked'";}?> />
					    				<label for="hak_akses_delete" style="vertical-align: middle; font-weight: normal;">Hapus</label>
									  </div>
									</div>	
								  
								  <div class="box-footer">
								  	<div class="pull-left">
										<p>Yang bertanda <span style="color: red;">(*)</span> wajib di isi.</p>
									</div>
									<div class="pull-right">
										<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
										<a href="<?php echo base_url(); ?>Previlleges" class="btn btn-warning"><i class="fa fa-close"></i> Batal</a>
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
    	$('#mnHakAkses').addClass('active');

        $('#alert').delay(10000).fadeOut("slow");
    });
	</script>
</html>