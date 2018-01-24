<?php
		$menusid = $this->M_crud->get_by_param("menu", 'name', "RekamMedikPasien");
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
		}else{echo "b";
			$mnCreate = 0;
			$mnUpdate = 0;
			$mnDelete = 0;
		}
		// die;
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
					<div class="box box-widget">
						<div class="box-header with-border">
							<h3 class="box-title">Daftar Pasien</h3>
						</div>
						<div class="box-body">
							<!-- <a href="<?php echo site_url('Pasien/cetak');?>" target="_blank" class="btn btn-default pull-right"><i class="fa fa-print"></i> Cetak</a>
			              	<a href="<?php echo site_url('Pasien/doexport');?>" style="margin-right: 10px;" target="_blank" class="btn btn-success pull-right">
			              	  <i class="fa fa-file-excel-o"></i> Export Excell</a>
							  <?php if($this->session->userdata['simklinik']['ap_is_admin'] == 1 || $mnCreate == 1){
			              	  ?>
			              	  <a href="<?php echo base_url(); ?>Pasien/form" style="margin-right: 10px;" class="btn btn-primary pull-right">
			              	  <i class="fa fa-plus"></i> Tambah Data</a><br><br>
			              	  <?php
			              	  }
			              	  ?> -->
							<table id="example2" style="border: 2" class="table table-bordered table-striped DataTable">
								<thead>
									<tr>
										<th style="width: 5%;" class="text-center">#</th>
										<th class="text-center">No. Rm</th>
							            <th class="text-center">No Kartu</th>
							            <th class="text-center">Nama</th>
							            <th class="text-center">Tempat, Tgl Lahir</th>
										<th style="width: 8%;" class="text-center">Aksi</th>
									</tr>
								</thead>
                <tbody>
									<?php $i=1; foreach($pasiens as $pasien):?>
									<tr>
										<td><?php echo $i++;?></td>
										<td><?php echo $pasien['no_rm'];?></td>
										<td><?php echo $pasien['no_kartu'];?></td>
										<td><?php echo $pasien['nama_pasien'];?></td>
										<td><?php
			              					echo $pasien['tempat_lahir'].', '.date('d-M-Y',strtotime($pasien['tgl_lahir']));
			              					?>
			              				</td>
										<td class="opsiTd">
											<!-- <a class="btn btn-success btn-xs" href="#" title="Lihat Detail"><i class="fa fa-eye"></i></a> -->
											<a class="btn btn-success btn-xs" href="#" title="Lihat Detail" data-togle="modal" onclick="toggle_detail()"><i class="fa fa-eye"></i></a>
											<!-- <a class="btn btn-warning btn-xs" href="</?php echo site_url('pasien/edit\/').$pasien['id_pasien'];?>"><i class="fa fa-edit" title="Edit"></i></a> -->
											<!-- <a class="btn btn-danger btn-xs" title="Hapus" href="" data-toggle="modal" onclick="confirm_delete('</?php echo site_url('pasien/hapus').'/'.$pasien['id_pasien'];?>','<?php echo $pasien['nama_pasien'];?>');"><i class="fa fa-trash"></i></a> -->
											<a class="btn btn-default btn-xs" title="Cetak" href="<?php echo site_url('Rekammedik/detail\/').$pasien['id_pasien'];?>" target="_blank"><i class="fa fa-print" title="Cetak"></i></a>
										</td>
									</tr>
									<?php endforeach;?>
								</tbody>
							</table>
						</div>
						<div class="box-footer">

						</div>
					</div>
				</div>
			</div>
				<div class="modal fade" id="modal_detail_rekam_medik"  data-backdrop="static" data-keyboard="false">
						<div class="modal-dialog modal-lg">
							<div class="modal-content" style="margin-top:100px;">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<div class="pull-left">
										<h4 class="modal-title" style="text-align:center;">
											Detail Rekam Medik <span class="grt"></span>
										</h4>
									</div>
								</div>
								<div class="modal-body">
									<div class="nav-tabs-custom">
										<ul class="nav nav-tabs">
											<li class="active"><a href="#tab_tindakan" data-toggle="tab">Penyakit/ Tindakan</a></li>
											<li><a href="#tab_obat" data-toggle="tab">Resep Obat</a></li>
											<li><a href="#tab_Obsterti" data-toggle="tab">Riwayat Obsterti</a></li>
											<li><a href="#tab_Observasi" data-toggle="tab">Observasi Kala I</a></li>
											<li><a href="#tab_Kala1" data-toggle="tab">Kala I</a></li>
											<li><a href="#tab_Kala2" data-toggle="tab">Kala II</a></li>
											<li><a href="#tab_kala3" data-toggle="tab">Kala III</a></li>
											<li><a href="#tab_pasca" data-toggle="tab">Pasca Persalinan</a></li>
											<li><a href="#tab_status" data-toggle="tab">Status Pasien</a></li>
											<li><a href="#tab_resume" data-toggle="tab">Resume Medis</a></li>
										</ul>
										<div class="tab-content form-panel">
											<div class="tab-pane active" id="tab_tindakan">
												<div class="row">
													<div class="col-md-12">
														<div class="box box-widget box-solid">

															<div class="box-body">
																sdf
															</div>
														</div>
													</div>
												</div>
											</div>
									</div>
								</div>
									<button type="button" class="btn btn-primary" data-dismiss="modal" id="delete_cancel_link">Tutup</button>
								</div>
								<!-- <div class="modal-footer">
									<span id="preloader-delete"></span>
									<br><a class="btn btn-primary" id="delete_link_m_n" href="">Delete</a>
									<button type="button" class="btn btn-default" data-dismiss="modal" id="delete_cancel_link">
										Cancel
									</button>
								</div> -->
							</div>
						</div>
					</div>
    		</section>
    	</div>
    	<?php $this->load->view('template/v_copyright'); ?>
    </body>
    <?php $this->load->view('template/v_footer'); ?>
    <script type="text/javascript">
			function toggle_detail(){
				jQuery('#modal_detail_rekam_medik').modal('show',{backdrop: 'static',keyboard :false});

			}
    $(document).ready(function(){
    $('#mnMasterRekamMedik').addClass('active');
      $('#mnRekamMedikPasien').addClass('active');
    })
    </script>
</html>
