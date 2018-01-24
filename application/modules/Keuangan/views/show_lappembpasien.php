<?php

defined('BASEPATH') OR exit('No direct script access allowed'); 

$menusid = $this->M_crud->get_by_param("menu", 'name', "LaporanPembayaranPasien");
if(!empty($menusid)){
	$akses = $this->M_crud->get_select_to_row('hak_akses_create, hak_akses_update, hak_akses_delete', 'hak_akses', null, null, 'hak_akses_role', $this->session->userdata['simklinik']['ap_role'], 'hak_akses_menu', $menusid->id_menu);
	if(count($akses) == 0)
	{
		$mnCreate = 0;
		$mnUpdate = 0;
		$mnDelete = 0;
	}else{
		$mnCreate = $akses->hak_akses_create;
		$mnUpdate = $akses->hak_akses_update;
		$mnDelete = $akses->hak_akses_delete;
	}
}else{
	$mnCreate = 0;
	$mnUpdate = 0;
	$mnDelete = 0;
}
?>

<!DOCTYPE html>
<html>
	<head>
		<?php $this->load->view('template/v_header_keuangan'); ?>
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
					  <h3 class="box-title">Laporan Pembayaran Pasien</h3>
					</div>					
					<div class="box-body">
						<br>
						<form id="formAct" action="<?php echo base_url('Keuangan/cetak_laporanpembayaranpasien'); ?>" method="post" class="form-horizontal form-label-left" onsubmit="return validate()">
							<div class="form-group">
								<input type="hidden" id="valType" name="valType">
								<input type="hidden" id="formType" name="formType" value="<?= $formType; ?>">
								<label class="control-label col-lg-2" style="text-align: right; padding-top: 10px;">Periode Awal<sup style="color:red;">*</sup></label>
								<div class="col-lg-2">
									<input type="text" class="form-control" name="TglAwal" id="TglAwal" required="required" readonly="readonly" value="<?= $tgl_awal; ?>">
								</div>	
								<label class="control-label col-lg-2" style="text-align: right; padding-top: 10px;">Periode Akhir<sup style="color:red;">*</sup></label>
								<div class="col-lg-2">
									<input type="text" class="form-control" name="TglAkhir" id="TglAkhir" required="required" readonly="readonly" value="<?= $tgl_akhir; ?>">
								</div>	
								<div class="col-lg-1" style="width: 0.667%;"></div>
								<div class="col-lg-1">
									<button type="submit" class="btn btn-primary" id="btnTampil" onclick="ocShow()"><i class="fa fa-search"></i> Tampil</button>
								</div>
								<div class="col-lg-1">
									<button type="submit" class="btn btn-default" id="btnPrint" onclick="ocCetak()"><i class="fa fa-print"></i> Cetak</button>
								</div>
								<div class="col-lg-1">
									<a href="<?php echo base_url('Keuangan/pembayaranpasien'); ?>" class="btn btn-warning"><i class="fa fa-refresh"></i> Reset</a>
								</div>
							</div>						
							<div class="pull-left">
								<p>Yang bertanda <span style="color: red;">(*)</span> wajib di isi.</p>
							</div>
						</form>
						<br>
						<?php
							if(isset($details)){
						?>
						<table id="example2" class="table table-bordered table-striped">
							<thead>
								<tr>
						  			<th width=5% style="border: 1px solid #e3e3e3; text-align:center; background: #F6F5FA;">No.</th>
						  			<th style="border: 1px solid #e3e3e3; text-align:center; background: #F6F5FA;">No. Pendaftaran</th>
						  			<th style="border: 1px solid #e3e3e3; text-align:center; background: #F6F5FA;">Tgl.</th>
						  			<th width=5% style="border: 1px solid #e3e3e3; text-align:center; background: #F6F5FA;">No.</th>
						  			<th style="border: 1px solid #e3e3e3; text-align:center; background: #F6F5FA;">Nama Item</th>
						  			<th style="border: 1px solid #e3e3e3; text-align:center; background: #F6F5FA;">Harga</th>
						  			<th style="border: 1px solid #e3e3e3; text-align:center; background: #F6F5FA;">Qty</th>
						  			<th style="border: 1px solid #e3e3e3; text-align:center; background: #F6F5FA;">Sub Total</th>
						  			<th style="border: 1px solid #e3e3e3; text-align:center; background: #F6F5FA;">Status Bayar</th>
						  		</tr>
							</thead>
							<tbody>
								<?php $no=0; ?>
						  		<?php $nodetail=1; ?>
						  		<?php $nopendaftaran = ""; ?>
						  		<?php $total=0; ?>
						  		<?php $status_bayar="Belum Bayar"; ?>
						  		<?php foreach($details as $key){ ?>
						  		  <tr>
						  		  	<?php if($key->no_registrasi !== $nopendaftaran) { $nopendaftaran = ""; }?>
						  		  	<?php if($nopendaftaran === "")  { $no++; $nodetail=1; ?>
						  			<td style="border: 1px solid #e3e3e3; text-align:center;"><?php echo $no; ?></td>
						  			<td style="border: 1px solid #e3e3e3; text-align:left; padding-left:5px;"><?php echo $key->no_registrasi; ?></td>
						  			<td style="border: 1px solid #e3e3e3; text-align:left; padding-left:5px;"><?php echo date('d-m-Y', strtotime($key->tgl_registrasi)); ?></td>
						 			<?php }else{ ?>
						 			<td style="border: 1px solid #e3e3e3; text-align:center;"></td>
						  			<td style="border: 1px solid #e3e3e3; text-align:left; padding-left:5px;"></td>
						  			<td style="border: 1px solid #e3e3e3; text-align:left; padding-left:5px;"></td>
						 			<?php } ?>
						 			<?php $nopendaftaran = $key->no_registrasi; ?>
						  			<td style="border: 1px solid #e3e3e3; text-align:center;"><?php echo $nodetail; ?></td>
						  			<td style="border: 1px solid #e3e3e3; text-align:left; padding-left:5px;"><?php echo $key->nama_item; ?></td>
						  			<td style="border: 1px solid #e3e3e3; text-align:right; padding-right:5px;"><?php echo "Rp. ".number_format($key->harga,0,",","."); ?></td>
						  			<?php 
							  			$qty = $this->M_base->currFormat0($key->qty);
										$qty = str_replace(".00", "", $qty);
										if($key->status_bayar == "0"){
											$status_bayar="Belum Bayar";
										}else{
											$status_bayar="Sudah Bayar";
										}
						  			?>
						  			<td style="border: 1px solid #e3e3e3; text-align:right; padding-right:5px;"><?php echo $qty; ?></td>
						  			<td style="border: 1px solid #e3e3e3; text-align:right; padding-right:5px;"><?php echo "Rp. ".number_format($key->total_harga,0,",","."); ?></td>
						  			<td style="border: 1px solid #e3e3e3; text-align:left; padding-left:5px;"><?php echo $status_bayar; ?></td>
						  			<?php $nodetail++; ?>
						  		  </tr>
						  		<?php } ?>
							</tbody>
						</table>
						<?php
							}
						?>
					</div>
				</div>
    		</section>
    	</div>
		<?php $this->load->view('template/v_copyright'); ?>
    </body>
    
    <?php $this->load->view('template/v_footer_keuangan'); ?>
    
    <script type="text/javascript">
    $(document).ready(function() {
    	$('#mnKeuangan').addClass('active');
    	$('#mnLaporanPembayaranPasien').addClass('active');

    	$('#TglAwal').datetimepicker({
    		lang:'en',
    		timepicker:false,
    		format:'d-m-Y'
    	}).on('change', function(){
    		$('#TglAwal').datetimepicker('hide');
        });    	

    	$('#TglAkhir').datetimepicker({
    		lang:'en',
    		timepicker:false,
    		format:'d-m-Y'
    	}).on('change', function(){
    		$('#TglAkhir').datetimepicker('hide');
        });

    	var formType = $("#formType").val();
    	if(formType == ""){        	
        	$("#TglAwal").val('');
        	$("#TglAkhir").val('');
    	}
    });

    /* $(function () {
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "info": false,
          "autoWidth": true,
          "columnDefs": [{
              "targets": [ 0, 1, 2, 3, 4, 5, 6, 7, -1],
              "orderable": false,
      		}],
        });
      }); */

    function validate() {
        if (document.getElementById("TglAwal").value == "" || document.getElementById("TglAkhir").value == "") {
             alert("Masukan periode awal dan periode akhir.");
             return false;
        } else {
            return true;
        }
    }

    function ocShow() {
    	var curlink = document.getElementById("formAct");
    	$("#valType").val('show');
    	curlink.removeAttribute("target");
    }

    function ocCetak() {
    	var curlink = document.getElementById("formAct");
    	$("#valType").val('cetak');
    	curlink.setAttribute("target", "_blank");
    }
	</script>
    
</html>

