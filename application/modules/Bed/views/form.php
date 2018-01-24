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
							  <h3 class="box-title">Input Data Bed</h3>
							</div>								
							<form class="form-horizontal" method="post" action="<?php echo base_url().(isset($id_bed) ? 'Bed/update' : 'Bed/insert'); ?>">
							  <?php
								if(isset($id_bed))
								{
									echo "<input type='hidden' name='id' value='".$id_bed."'>";
								}
							  ?>
							  <div  class="box-body">
							  	<div class="form-group">
								  <label for="inputEmail3" class="col-sm-2 control-label">Bed<sup style="color:red;">*</sup></label>
				
								  <div class="col-sm-4">
									<input type="text" name="nama_bed" class="form-control" value="<?php echo (isset($nama_bed) ? $nama_bed : ''); ?>" placeholder="Masukan Bed..." required="required">
								  </div>
								</div>
								
								<div class="form-group">
								  <label for="inputEmail3" class="col-sm-2 control-label">Ruangan<sup style="color:red;">*</sup></label>
				
								  <div class="col-sm-4">
										<select class="form-control" name="id_kamar" id="id_kamar" required="required">
											<option value = ''>-Pilih Ruangan-</option>
											<?php 
												foreach($arr_kamar as $row)
												{ 
													if($row->id_kamar == $id_kamar){
														echo '<option value="'.$row->id_kamar.'" selected>'.$row->nama_ruangan.'</option>';
													}else{
												   		echo '<option value="'.$row->id_kamar.'">'.$row->nama_ruangan.'</option>';							           			
													}
												}
					            			?>
										</select>
								  </div>
								</div>				
								
								<div class="form-group">
								  <label for="inputEmail3" class="col-sm-2 control-label">Status Bed<sup style="color:red;">*</sup></label>
				
								  <div class="col-sm-2">
										<select name='status_isi' class="form-control" required="required">
											<option value=''>-Pilih Status-</option>
											<option value='Kosong' <?php echo (isset($status_isi) ? ($status_isi == 'Kosong' ? 'selected' : '') : ''); ?>>Kosong</option>
											<option value='Isi' <?php echo (isset($status_isi) ? ($status_isi == 'Isi' ? 'selected' : '') : ''); ?>>Isi</option>
										</select>
								  </div>
								</div>
							  
							  <div class="box-footer">
							  	<div class="pull-left">
									<p>Yang bertanda <span style="color: red;">(*)</span> wajib di isi.</p>
								</div>
								<div class="pull-right">
									<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
									<a href="<?php echo base_url(); ?>Bed" class="btn btn-warning"><i class="fa fa-close"></i> Batal</a>
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
    	$('#mnMasterRuangan').addClass('active');
    	$('#mnBed').addClass('active');

    	$('#alert').delay(10000).fadeOut("slow");
    });
	</script>
</html>