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
								  <h3 class="box-title">Input Data Kategori</h3>
								</div>
								<form class="form-horizontal" method="post" action="<?php echo base_url().(isset($id_kategori) ? 'Kategoriobat/update' : 'Kategoriobat/insert'); ?>">
								  <?php
									if(isset($id_kategori))
									{
										echo "<input type='hidden' name='id' value='".$id_kategori."'>";
									}
								  ?>
								<div  class="box-body">
									<div class="form-group">
									  <label for="inputEmail3" class="col-sm-2 control-label">Kategori<sup style="color:red;">*</sup></label>
					
									  <div class="col-sm-4">
										<input type="text" name="nama_kategori" class="form-control" value="<?php echo (isset($nama_kategori) ? $nama_kategori : ''); ?>" placeholder="Masukan Nama Kategori..." required="required">
									  </div>
									</div>
								  
								  <div class="box-footer">
								  	<div class="pull-left">
										<p>Yang bertanda <span style="color: red;">(*)</span> wajib di isi.</p>
									</div>
									<div class="pull-right">
										<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
										<a href="<?php echo base_url(); ?>Kategoriobat" class="btn btn-warning"><i class="fa fa-close"></i> Batal</a>
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
    	$('#mnMasterObat').addClass('active');
    	$('#mnKategoriObat').addClass('active');

    	$('#alert').delay(10000).fadeOut("slow");
    });
	</script>
</html>