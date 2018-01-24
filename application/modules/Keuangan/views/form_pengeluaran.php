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
							  <h3 class="box-title">Input Data Pengeluaran</h3>
							</div>								
							<form class="form-horizontal" method="post" action="<?php echo base_url().(isset($pengeluaran_id) ? 'keuangan/update_pengeluaran' : 'keuangan/insert_pengeluaran'); ?>">
							  <?php
								if(isset($pengeluaran_id))
								{
									echo "<input type='hidden' name='id' value='".$pengeluaran_id."'>";
								}
							  ?>
							  <div  class="box-body">
								<div class="form-group">
								  <label for="inputEmail3" class="col-sm-2 control-label">No. Kuitansi<sup style="color:red;">*</sup></label>
				
								  <div class="col-sm-3">
									<input type="text" name="no_pengeluaran" class="form-control" value="<?php echo (isset($no_pengeluaran) ? $no_pengeluaran : ''); ?>" placeholder="Masukan No. Kuitansi..." required="required">
								  </div>
								</div>
								
								<div class="form-group">
								  <label for="inputEmail3" class="col-sm-2 control-label">Tgl. Pengeluaran<sup style="color:red;">*</sup></label>
				
								  <div class="col-sm-3">
									<input type="text" name="tgl_pengeluaran" placeholder="Tgl. Pengeluaran" required="required" class="form-control datepicker" data-mask data-inputmask='"mask":"99/99/9999"'
										<?php 
											if(isset($tgl_pengeluaran)){
												$tgl=explode('-',$tgl_pengeluaran);
												$dt = substr($tgl[2], 0, 2);
												echo "value='$tgl[1].$dt.$tgl[0]'";
											}
											else{
												echo "value='".set_value('tgl_pengeluaran')."'";
											}
										?>
									/>
								  </div>
								</div>			
								
								<div class="form-group">
								  <label for="inputEmail3" class="col-sm-2 control-label">Nama Item<sup style="color:red;">*</sup></label>
				
								  <div class="col-sm-6">
									<input type="text" name="nama_pengeluaran" class="form-control" value="<?php echo (isset($nama_pengeluaran) ? $nama_pengeluaran : ''); ?>" placeholder="Masukan Nama Item..." required="required">
								  </div>
								</div>	
								
								<div class="form-group">
								  <label for="inputEmail3" class="col-sm-2 control-label">Qty<sup style="color:red;">*</sup></label>
				
								  <div class="col-sm-2">
									<div class="input-group">
										<span class="input-group-addon">#</span><input type="text" name="qty_pengeluaran" placeholder="" value="<?php echo (isset($qty_pengeluaran) ? $qty_pengeluaran : ''); ?>" class="span8 form-control" onkeypress='return isNumberKey(event);' required="required">
									</div>
								  </div>
								</div>
								
								<div class="form-group">
								  <label for="inputEmail3" class="col-sm-2 control-label">Harga<sup style="color:red;">*</sup></label>
				
								  <div class="col-sm-2">
									<div class="input-group">
										<span class="input-group-addon">Rp</span><input type="text" name="harga_pengeluaran" id="harga_pengeluaran" placeholder="" value="<?php echo (isset($harga_pengeluaran) ? $harga_pengeluaran : ''); ?>" class="span8 form-control" required="required">
									</div>
								  </div>
								</div>
							  
							  <div class="box-footer">
							  	<div class="pull-left">
									<p>Yang bertanda <span style="color: red;">(*)</span> wajib di isi.</p>
								</div>
								<div class="pull-right">
									<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
									<a href="<?php echo base_url(); ?>keuangan/datapengeluaran" class="btn btn-warning"><i class="fa fa-close"></i> Batal</a>
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
    	$('#mnKeuangan').addClass('active');
    	$('#mnDataPengeluaran').addClass('active');

    	$('#alert').delay(10000).fadeOut("slow");

    	$("[data-mask]").inputmask();
        $('.selectOption').select2();
        $('.DataTable').DataTable({});
        $('.datepicker').datepicker({
               format:'dd/mm/yyyy',
               todayHighlight:true,
               containter:true,
            });
    });

    function isNumberKey(evt)
    {
       var charCode = (evt.which) ? evt.which : event.keyCode
       if (charCode > 31 && (charCode < 48 || charCode > 57))
          return false;
       return true;
    }

    $('#harga_pengeluaran').inputmask("numeric", {
        radixPoint: ".",
        groupSeparator: ",",
        digits: 2,
        autoGroup: true,
        rightAlign: false,
        oncleared: function () { self.Value(''); }
    });
	</script>
</html>