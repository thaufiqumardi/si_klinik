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
						<div class="box box-widget">
							<div class="box-header with-border">
								<h3 class="box-title pull-left"> Data Pemilik</h3>
							</div>
							<form class="form-group" action="<?php echo site_url('owner/update').'/'.$owner_id;?>" method="post" enctype="multipart/form-data">
							<div class="box-body">								
									<div class="row">
								 		<div class="col-md-6">
								 			<div class="form-group">
										 		<label class="control-label">Nama</label>
										 		<input type="text" name="nama_owner" class="form-control" value="<?php echo $nama_owner;?>">
								 			</div>
								 		</div>
								 		<div class="col-md-6">
								 			<div class="form-group">
								 				<label class="control-label">No. Telepon</label>
								 				<input type="text" name="no_telpon_owner" class="form-control" value="<?php echo $no_telpon_owner;?>">
								 			</div>
								 		</div>
								 	</div>
								 	<div class="row">
								 		<div class="col-md-6">
								 			<div class="form-group">
								 			<label class="control-label">Alamat</label>
								 			<textarea class="form-control" rows="3" name="alamat_owner"><?php echo $alamat_owner;?></textarea>
								 		</div>
								 		</div>
								 		<div class="col-md-6">
								 			<div class="form-group">
									 			<label class="control-label">Logo</label>
									 			<input type="file" name="logo_owner" accept="image/*" class="form-control" id="image-source" onchange="previewImage();">
									 			<br />
												<img width="150px" height="150px" id="image-preview" alt="image preview" src="<?php echo base_url(); ?><?php echo $logo_owner; ?>"/>
								 			</div>
								 		</div>
								 	</div>
							</div>
							<div class="box-footer">
								<div class="form-group">
									<button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Simpan</button>
								</div>
							</div>
							</form>
						</div>		
    		</section>
    	</div>
		<?php $this->load->view('template/v_copyright'); ?>
    </body>
    
    <?php $this->load->view('template/v_footer'); ?>
    
    <script type="text/javascript">
    $(document).ready(function() {
    	$('#mnPengaturan').addClass('active');
    	$('#mnOwner').addClass('active');

    	$('#alert').delay(10000).fadeOut("slow");
    });

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