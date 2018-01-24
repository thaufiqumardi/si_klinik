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
							  <h3 class="box-title">Input Data Ruangan</h3>
							</div>								
							<form class="form-horizontal" method="post" action="<?php echo base_url().(isset($id_kamar) ? 'Kamar/update' : 'Kamar/insert'); ?>">
							  <?php
								if(isset($id_kamar))
								{
									echo "<input type='hidden' name='id' value='".$id_kamar."'>";
								}
							  ?>
							  <div  class="box-body">
								<div class="form-group">
								  <label for="inputEmail3" class="col-sm-2 control-label">Nama Ruangan<sup style="color:red;">*</sup></label>
				
								  <div class="col-sm-4">
									<input type="text" name="nama_ruangan" class="form-control" value="<?php echo (isset($nama_ruangan) ? $nama_ruangan : ''); ?>" placeholder="Masukan Nama Ruangan..." required="required">
								  </div>
								</div>
								
								<div class="form-group">
								  <label for="inputEmail3" class="col-sm-2 control-label">Kelas<sup style="color:red;">*</sup></label>
				
								  <div class="col-sm-4">
										<select name='kelas' class="form-control" required="required">
											<option value=''>-Pilih Kelas-</option>
											<option value='1' <?php echo (isset($kelas) ? ($kelas == 1 ? 'selected' : '') : ''); ?>>VIP</option>
											<option value='2' <?php echo (isset($kelas) ? ($kelas == 2 ? 'selected' : '') : ''); ?>>Kelas 1</option>
											<option value='3' <?php echo (isset($kelas) ? ($kelas == 3 ? 'selected' : '') : ''); ?>>Kelas 2</option>
											<option value='4' <?php echo (isset($kelas) ? ($kelas == 4 ? 'selected' : '') : ''); ?>>Kelas 3</option>
										</select>
								  </div>
								</div>				
								
								<div class="form-group">
								  <label for="inputEmail3" class="col-sm-2 control-label">Jumlah Bed<sup style="color:red;">*</sup></label>
				
								  <div class="col-sm-2">
									<div class="input-group">
										<span class="input-group-addon">#</span><input type="text" name="jumlah" placeholder="" value="<?php echo (isset($jumlah) ? $jumlah : ''); ?>" class="span8 form-control" onkeypress='return isNumberKey(event);' required="required">
									</div>
								  </div>
								</div>
								
								<div class="form-group">
								  <label for="inputEmail3" class="col-sm-2 control-label">Tarif<sup style="color:red;">*</sup></label>
				
								  <div class="col-sm-2">
									<div class="input-group">
										<span class="input-group-addon">Rp</span><input type="text" name="tarif" id="tarif" placeholder="" value="<?php echo (isset($tarif) ? $tarif : ''); ?>" class="span8 form-control" required="required">
									</div>
								  </div>
								</div>
							  
							  <div class="box-footer">
							  	<div class="pull-left">
									<p>Yang bertanda <span style="color: red;">(*)</span> wajib di isi.</p>
								</div>
								<div class="pull-right">
									<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
									<a href="<?php echo base_url(); ?>Kamar" class="btn btn-warning"><i class="fa fa-close"></i> Batal</a>
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
    	$('#mnRuangan').addClass('active');

    	$('#alert').delay(10000).fadeOut("slow");
    });

    function isNumberKey(evt)
    {
       var charCode = (evt.which) ? evt.which : event.keyCode
       if (charCode > 31 && (charCode < 48 || charCode > 57))
          return false;
       return true;
    }

    $('#tarif').inputmask("numeric", {
        radixPoint: ".",
        groupSeparator: ",",
        digits: 2,
        autoGroup: true,
        rightAlign: false,
        oncleared: function () { self.Value(''); }
    });
	</script>
</html>