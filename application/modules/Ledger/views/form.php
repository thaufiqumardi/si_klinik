<?php

defined('BASEPATH') OR exit('No direct script access allowed'); 

if(isset($edit))
{
	$data = current($edit);
		
	if($data->kode_header_akun == 0 && $data->kode_akun == 0)
	{
		$code = substr($data->kode_header,1,1);
	}
	elseif($data->kode_akun == 0 && $data->kode_header_akun != 0)
	{
		$code = substr($data->kode_header_akun,2,1);
	}
	elseif($data->kode_akun != 0 && $data->kode_header_akun != 0)
	{
		if(substr($data->kode_akun,4,1) > 0)
		{
			$code = substr($data->kode_akun,3,2);
		}
		else
		{
			$code = substr($data->kode_akun,3,1);
		}
	}
		
		
}

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
							  <h3 class="box-title">Input Data Kode Akun</h3>
							</div>								
							<form class="form-horizontal" method="post" action="<?php echo base_url().(isset($edit) ? 'Ledger/update' : 'Ledger/insert'); ?>">
							  <?php
								if(isset($edit))
								{
									echo "<input type='hidden' name='id' value='".$data->id."'>";
								}
							  ?>
							  <div  class="box-body">
								<div class="form-group">
								  <label for="inputEmail3" class="col-sm-2 control-label">Pilih Akun<sup style="color:red;">*</sup></label>
				
								  <div class="col-sm-4">
								  	<select name='akun' class="form-control" required="required">
										<option value="">Pilih Akun</option>
										<option value="1" <?php echo (isset($edit) ? (substr($data->kode_header,0,1) == 1 ? "selected" : "")  : ''); ?>>Aktiva</option>
										<option value="2" <?php echo (isset($edit) ? (substr($data->kode_header,0,1) == 2 ? "selected" : "")  : ''); ?>>Pasiva</option>
										<option value="3" <?php echo (isset($edit) ? (substr($data->kode_header,0,3) == 3 ? "selected" : "")  : ''); ?>>Modal</option>
										<option value="4" <?php echo (isset($edit) ? (substr($data->kode_header,0,4) == 4 ? "selected" : "")  : ''); ?>>Pendapatan</option>
										<option value="5" <?php echo (isset($edit) ? (substr($data->kode_header,0,5) == 5 ? "selected" : "")  : ''); ?>>Beban</option>
									</select>
								  </div>
								</div>
								
								<div class="form-group">
								  <label for="inputEmail3" class="col-sm-2 control-label">Header<sup style="color:red;">*</sup></label>
				
								  <div class="col-sm-4">
								  	<select name='header' id="akun_head" class="form-control" required="required">
										<option value="1" id="radio1" <?php echo (isset($edit) ? ($data->kode_header_akun == 0 && $data->kode_akun == 0 ? "selected" : "")  : 'seleted'); ?>>Header</option>
										<option value="2" id="radio2" <?php echo (isset($edit) ? ($data->kode_akun == 0 && $data->kode_header_akun != 0 ? "selected" : "")  : ''); ?>>Sub Header</option>
										<option value="3" id="radio3" <?php echo (isset($edit) ? ($data->kode_akun != 0 && $data->kode_header_akun != 0 ? "selected" : "")  : ''); ?>>Sub</option>
									</select>
								  </div>
								</div>		
								
								<div class="form-group akun1">
								  <label for="inputEmail3" class="col-sm-2 control-label">Pilih Header</label>
				
								  <div class="col-sm-4">
										<select name='header1' class="form-control">
											<option value=''>Pilih Header</option>
											<?php
												foreach($akun1 as $akn1)
												{
													echo '<option value="'.$akn1->kode_header.'" '.(isset($edit) ? ($data->kode_header == $akn1->kode_header ? "selected" : "")  : '').'>'.$akn1->nama.'</option>';
												}
											?>
										</select>
								  </div>
								</div>		
								
								<div class="form-group akun2">
								  <label for="inputEmail3" class="col-sm-2 control-label">Pilih Header</label>
				
								  <div class="col-sm-4">
										<select name='header2' class="form-control">
											<option value=''>Pilih Header</option>
											<?php
												foreach($akun2 as $akn2)
												{
													echo '<option value="'.$akn2->kode_header_akun.'" '.(isset($edit) ? ($data->kode_header_akun == $akn2->kode_header_akun ? "selected" : "")  : '').'>'.$akn2->nama.'</option>';
												}
											?>
										</select>
								  </div>
								</div>			
								
								<div class="form-group">
								  <label for="inputEmail3" class="col-sm-2 control-label">Kode Akun<sup style="color:red;">*</sup></label>
				
								  <div class="col-sm-3">
									<div class="input-group">
										<span class="input-group-addon">#</span><input type="text" name="kd_akn" value="<?php echo (isset($edit) ? $code : ''); ?>" class="span8 form-control" required="required">
									</div>
								  </div>
								</div>
								
								<div class="form-group">
								  <label for="inputEmail3" class="col-sm-2 control-label">Nama Akun<sup style="color:red;">*</sup></label>
				
								  <div class="col-sm-2">
									<div class="input-group">
										<input class="form-control" type="text" name='name' value="<?php echo (isset($edit) ? $data->nama : ''); ?>" required="required">
									</div>
								  </div>
								</div>
							  
							  <div class="box-footer">
							  	<div class="pull-left">
									<p>Yang bertanda <span style="color: red;">(*)</span> wajib di isi.</p>
								</div>
								<div class="pull-right">
									<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
									<a href="<?php echo base_url(); ?>Ledger" class="btn btn-warning"><i class="fa fa-close"></i> Batal</a>
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
    	$('#mnKodeAkun').addClass('active');

    	$('#alert').delay(10000).fadeOut("slow");

    	$('#radio2').click(function(){
         	$('.akun1').show();
         	$('.akun2').hide();
         });

         $('#radio3').click(function(){
         	$('.akun1').hide();
         	$('.akun2').show();
         });

         $('#radio1').click(function(){
         	$('.akun1').hide();
         	$('.akun2').hide();
         });

    	if($('#akun_head').val() == 1){
    		$('.akun1').hide();
         	$('.akun2').hide();
    	}
    	
    	if($('#akun_head').val() == 2){
    		$('.akun1').show();
         	$('.akun2').hide();
    	}
    	
    	if($('#akun_head').val() == 3){
    		$('.akun1').hide();
         	$('.akun2').show();
    	}
    });

    function isNumberKey(evt)
    {
       var charCode = (evt.which) ? evt.which : event.keyCode
       if (charCode > 31 && (charCode < 48 || charCode > 57))
          return false;
       return true;
    }
	</script>
</html>