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
    <body class="fixed hold-transition skin-blue-light">
    	<?php $this->load->view('template/v_left_menu'); ?>
    	<div class="content-wrapper">
    		<section class="content">

    			<div class="row">
				<div class="col-md-12">
					<div class="box box-widget">
						<div class="box-header with-border">
							<h3 class="box-title">Daftar Pasien</h3>
						</div>
						<div class="box-body">

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
											<!-- <a class="btn btn-success btn-xs" href="#" title="Lihat Detail" data-togle="modal" onclick="toggle_detail()"><i class="fa fa-eye"></i></a> -->
											<!-- <a class="btn btn-warning btn-xs" href="</?php echo site_url('pasien/edit\/').$pasien['id_pasien'];?>"><i class="fa fa-edit" title="Edit"></i></a> -->
											<!-- <a class="btn btn-danger btn-xs" title="Hapus" href="" data-toggle="modal" onclick="confirm_delete('</?php echo site_url('pasien/hapus').'/'.$pasien['id_pasien'];?>','<?php echo $pasien['nama_pasien'];?>');"><i class="fa fa-trash"></i></a> -->
											<a class="btn btn-primary btn-sm" title="Lihat" href="<?php echo site_url('Rekammedik/show').'/'.$pasien['id_pasien'];?>"><i class="fa fa-list" title="Lihat"></i> Lihat</a>
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
    $('#mnrekammedik').addClass('active');
      // $('#mnRekamMedikPasien').addClass('active');
    });

    $(function () {
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": true,
          "columnDefs": [{
              "targets": [ -1],
              "orderable": false,
      		}],
          "info": false,
          "autoWidth": true
        });
      });
    </script>
</html>
