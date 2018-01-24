<?php

defined('BASEPATH') OR exit('No direct script access allowed'); 

$menusid = $this->M_crud->get_by_param("menu", 'name', "LaporanJurnalPendapatan");
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
					  <h3 class="box-title">Laporan Jurnal Pendapatan</h3>
					</div>					
					<div class="box-body">
						<br>
						<form id="formAct" action="<?php echo base_url('Keuangan/cetak_laporanjurnalpendapatan'); ?>" method="post" class="form-horizontal form-label-left">
							<div class="form-group">
								<input type="hidden" id="valType" name="valType">
								<input type="hidden" id="formType" name="formType" value="<?= $formType; ?>">
								<input type="hidden" id="valYear" name="valYear" value="<?= $tahun; ?>">
								<label class="control-label col-lg-1" style="text-align: right; padding-top: 10px;">Bulan<sup style="color:red;">*</sup></label>
								<div class="col-lg-2">
									<select name="Bulan" id="Bulan" class="form-control" required="required">
										<option value=""></option>
	                                    <option value="1" <?php if($bulan == "1") { ?> selected="selected" <?php } ?>>Januari</option>
	                                    <option value="2" <?php if($bulan == "2") { ?> selected="selected" <?php } ?>>Pebruari</option>
	                                    <option value="3" <?php if($bulan == "3") { ?> selected="selected" <?php } ?>>Maret</option>
	                                    <option value="4" <?php if($bulan == "4") { ?> selected="selected" <?php } ?>>April</option>
	                                    <option value="5" <?php if($bulan == "5") { ?> selected="selected" <?php } ?>>Mei</option>
	                                    <option value="6" <?php if($bulan == "6") { ?> selected="selected" <?php } ?>>Juni</option>
	                                    <option value="7" <?php if($bulan == "7") { ?> selected="selected" <?php } ?>>Juli</option>
	                                    <option value="8" <?php if($bulan == "8") { ?> selected="selected" <?php } ?>>Agustus</option>
	                                    <option value="9" <?php if($bulan == "9") { ?> selected="selected" <?php } ?>>September</option>
	                                    <option value="10" <?php if($bulan == "10") { ?> selected="selected" <?php } ?>>Oktober</option>
	                                    <option value="11" <?php if($bulan == "11") { ?> selected="selected" <?php } ?>>Nopember</option>
	                                    <option value="12" <?php if($bulan == "12") { ?> selected="selected" <?php } ?>>Desember</option>
	                                </select>
								</div>		
								<label class="control-label col-lg-1" style="text-align: right; padding-top: 10px;">Tahun<sup style="color:red;">*</sup></label>
								<div class="col-lg-2">
									<select name="Tahun" id="Tahun" class="form-control" required="required">
	                                    <option value=""></option>
	                                </select>
								</div>	
								<div class="col-lg-1" style="width: 0.667%;"></div>
								<div class="col-lg-1">
									<button type="submit" class="btn btn-primary" id="btnTampil" onclick="ocShow()"><i class="fa fa-search"></i> Tampil</button>
								</div>
								<div class="col-lg-1">
									<button type="submit" class="btn btn-default" id="btnPrint" onclick="ocCetak()"><i class="fa fa-print"></i> Cetak</button>
								</div>
								<div class="col-lg-1">
									<a href="<?php echo base_url('Keuangan/jurnalpendapatan'); ?>" class="btn btn-warning"><i class="fa fa-refresh"></i> Reset</a>
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
						  			<th width=10% style="border: 1px solid #e3e3e3; text-align:center; background: #F6F5FA;">Tgl.</th>
						  			<th style="border: 1px solid #e3e3e3; text-align:center; background: #F6F5FA;">Keterangan</th>
						  			<th width=20% style="border: 1px solid #e3e3e3; text-align:center; background: #F6F5FA;">No. Kuitansi</th>
						  			<th width=20% style="border: 1px solid #e3e3e3; text-align:center; background: #F6F5FA;">Piutang</th>
						  			<th width=20% style="border: 1px solid #e3e3e3; text-align:center; background: #F6F5FA;">Pendapatan</th>
						  		</tr>
						  	</thead>
						  	<tbody>
						  		<?php $total = 0; ?>
						  		<?php foreach($details as $key){ ?>
						  		  <tr>
						  			<td style="border: 1px solid #e3e3e3; text-align:left; padding-left:5px;"><?php echo date('d-m-Y', strtotime($key->tgl_pemasukan)); ?></td>
						  			<td style="border: 1px solid #e3e3e3; text-align:left; padding-left:5px;"><?php echo $key->nama_pemasukan; ?></td>
						  			<td style="border: 1px solid #e3e3e3; text-align:left; padding-left:5px;"><?php echo $key->no_kuitansi; ?></td>
						  			<td style="border: 1px solid #e3e3e3; text-align:right; padding-right:5px;"><?php echo "Rp. ".number_format($key->total_pemasukan,0,",","."); ?></td>
						  			<td style="border: 1px solid #e3e3e3; text-align:right; padding-right:5px;"><?php echo "Rp. ".number_format($key->total_pemasukan,0,",","."); ?></td>
						  			<?php $total = $total + $key->total_pemasukan; ?>
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
    	$('#mnLaporanJurnalPendapatan').addClass('active');

    	var valYear = $("#valYear").val();
    	var min = new Date().getFullYear();
    	max = min + 10;
    	min = min - 5;
    	select = document.getElementById('Tahun');	
    	for(var i = min; i<=max; i++){
    		var opt = document.createElement('option');
    		opt.value = i;
    		opt.innerHTML = i;
    		if(i == valYear){
        		opt.selected = "selected";
    		}
    		select.appendChild(opt);
    	}
    });

    $(function () {
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "info": false,
          "autoWidth": true,
          "columnDefs": [{
              "targets": [ 0, 1, 2, 3, 4, -1],
              "orderable": false,
      		}],
        });
      });

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

