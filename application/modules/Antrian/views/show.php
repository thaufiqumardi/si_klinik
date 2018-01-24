<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$menusid = $this->M_crud->get_by_param("menu", 'name', "AntrianPasien");
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
		<?php $this->load->view('template/v_header'); ?>
    </head>
    <body class="fixed hold-transition skin-blue-light sidebar-mini">
    	<?php $this->load->view('template/v_left_menu'); ?>
    	<div class="content-wrapper">
    		<section class="content">
    		<div class="row">
					<div class="col-lg-12">
						<div class="box box-widget">
							<div class="box-header with-border">
							  <h3 class="box-title">Antrian</h3>
							</div>
							<div class="box-body">
								<?php
		              $now = date('D');
		              $hari = array(
		                'Sun'=>'Minggu',
		                'Mon' => 'Senin',
		                'Tue' => 'Selasa',
		                'Wed' => 'Rabu',
		                'Thu' => 'Kamis',
		                'Fri' => "Jum'at",
		                'Sat' => 'Sabtu'
		              );
		              $bulan = array(
		              	'01' => 'JANUARI',
		              	'02' => 'FEBRUARI',
		              	'03' => 'MARET',
		              	'04' => 'APRIL',
		              	'05' => 'MEI',
		              	'06' => 'JUNI',
		              	'07' => 'JULI',
		              	'08' => 'AGUSTUS',
		                '09' => 'SEPTEMBER',
		                '10' => 'OKTOBER',
		                '11' => 'NOVEMBER',
		                '12' => 'DESEMBER',
		                );
		             	?>
									<dl class="dl-horizontal">
										<dt style="width:250px;">
											Tanggal&nbsp;&nbsp;&nbsp;&nbsp;:
										</dt>
										<dd>
											&nbsp;&nbsp;&nbsp;<?= date('d').' '.$bulan[date('m')].' '.date('Y');?>
										</dd>
										<dt style="width:250px;">
											Antrian Pasien Hari Ini&nbsp;&nbsp;&nbsp;&nbsp;:
											</dt>
										<dd>
											&nbsp;&nbsp;&nbsp;<?php echo count($antrian);?>
										</dd>
										<dt style="width:250px;">
											Pasien Terpanggil&nbsp;&nbsp;&nbsp;&nbsp;:
										</dt>
										<dd>
											&nbsp;&nbsp;&nbsp;<?= count($antrian_terlayani)==0?"Belum Ada":count($antrian_terlayani);?>
										</dd>
										<dt style="width:250px;">
											Sisa Antrian Pasien&nbsp;&nbsp;&nbsp;&nbsp;:
										</dt>
										<dd>
											&nbsp;&nbsp;&nbsp;<?= count($antrian_belum_terlayani);?>
										</dd>
										<!-- <dt style="width:250px;">
											Nomor Antrian Sedang Diperiksa&nbsp;&nbsp;&nbsp;&nbsp;:
										</dt>
										<dd>
											</?php
												if(!empty($antrian_belum_terlayani)){
													echo "&nbsp;&nbsp;&nbsp;".$antrian_belum_terlayani[0]->no_antrian;
												}
												else{
													echo "&nbsp;&nbsp;&nbsp;Belum Ada";
												}
											 ?>
										</dd> -->
									</dl>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6">
						<a type="button" href="<?= site_url('antrian/nextAntrian');?>" class="btn btn-primary btn-block"><i class="fa fa-tv"></i> Tampilkan Antrian Selanjutnya Ke Layar</a>
					</div>
					<div class="col-lg-6">
						<button type="button" class="btn btn-danger btn-block"><i class="fa fa-refresh"></i> Refresh Halaman</button>
					</div>
				</div>
    		</section>
    	</div>
		<?php $this->load->view('template/v_copyright'); ?>
    </body>
    <?php $this->load->view('template/v_footer'); ?>
    <script type="text/javascript">
    $(document).ready(function() {
    	$('#mnPemeriksaanPasien').addClass('active');
    	$('#mnAntrianPasien').addClass('active');
    	$('#alert').delay(10000).fadeOut("slow");
    });
	</script>

</html>
