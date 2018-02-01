<?php
		$menusid = $this->M_crud->get_by_param("menu", 'name', "PendaftaranPasien");
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
		// die;
		?>
<!DOCTYPE HTML>
<html>
	<head>
		<?php $this->load->view('template/v_header');?>
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
					<?php echo $msg['msg'];
					if(isset($msg['no_kartu'])){
						?>
						<p>
							No. Kartu Pasien: <?= $msg['no_kartu'];?>
						</p>
					<?php
					}
					?>
			</div>
			<?php
		}
		?>
	<div class="row">
		<div class="col-md-8">
			<div class="box box-primary box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Pendaftaran Pemeriksaan Pasien</h3>
					<div class="box-tools pull-right">
		                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
		                </button>
              		</div>
				</div>
			<form method="POST" class="formPendaftaran form-horizontal" action="<?php echo site_url('Pasien/pendaftaran_pasien');?>">
			<?php
				if(empty($pasiens)){
					?>
					<div class="box-body">
						<div class="alert bg-warning text-center">
               	 			<h4>Belum Ada Pasien</h4>
                			<p>Anda Belum pernah Menambahkan pasien sebelumnya. Silahkan menambahkan pasien dulu sebelum melakukan pendaftaran pasien.</p>
                			<a style="text-decoration:none;" href="<?php echo site_url('pasien/tambah');?>" class="btn btn-lg btn-primary">Tambahkan Pasien</a>
              			</div>
					</div>
					<?php
				}
				else{
					?>
			<div class="box-body">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-4">Cari Pasien</label>
							<!-- <input type="text" name="id_pasien" class="form-control" placeholder="Nama Pasien / No. Kartu / No.Rm"> -->
							<div class="col-md-8">
								<select required class="form-control selectOption" name="id_pasien" id="id_pasien">
								<option selected disabled value="">Nama Pasien / No. Kartu</option>
								<?php foreach ($pasiens as $pasien):?>
									<option	value="<?php echo $pasien['id_pasien'];?>" <?php echo set_select('id_pasien',$pasien['id_pasien']);?>>
										<?php echo $pasien['nama_pasien'].' / '.$pasien['no_kartu'];?></option>
								<?php endforeach;?>
							</select>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-4">Dokter</label>
							<div class="col-md-8">
								<select class="form-control selectOption" name="id_dokter" required>
									<option selected disabled value="">
										Pilih Dokter
									</option>
									<?php foreach($dokters as $dokter):?>
										<option value="<?=$dokter->id_dokter;?>" <?php echo set_select('id_dokter',$dokter->id_dokter);?>><?= $dokter->nama_dokter;?></option>
									<?php endforeach;?>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-4">Tanggal Daftar</label>
							<div class="col-md-8">
								<input type="text" name="tgl_daftar" class="form-control" value="<?php $now = date('d-m-Y'); echo $now;?>" readonly/>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-4">No. Rekam Medik</label>
							<div class="col-md-8">
								<input type="text" placeholder="Nomor Rekam Medik" class="form-control" readonly name="no_rekam_medik" <?php if(!empty(set_value('no_rekam_medik'))){echo "value='".set_value('no_rekam_medik')."'";} ?> id="no_rm" >
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-4">Nama Pasien</label>
							<div class="col-md-8">
							<input type="text" class="form-control" placeholder="Nama Pasien" id="nama" readonly <?php if(!empty(set_value('nama_pasien'))){echo "value='".set_value('nama_pasien')."'";} ?> name="nama_pasien">
						</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-4">Alamat</label>
							<div class="col-md-8">
								<textarea class="form-control" id="alamat" rows="5" readonly placeholder="Alamat" name="alamat"  ><?php if(!empty(set_value('alamat'))){echo set_value('alamat');} ?></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-4">Umur</label>
							<div class="col-md-8">
								<input type="text"  name="umur" class="form-control" readonly <?php if(!empty(set_value('umur'))){echo "value='".set_value('umur')."'";} ?>/>
							</div>
						</div>
					</div>
				</div>
				<div class="box-footer">
					<div class="pull-left">
						<a href="<?php echo site_url('pasien/form');?>" class="btn btn-primary btn-sm">
							<i class="fa fa-plus"></i> Tambahkan Pasien Baru
						</a>
					</div>
					<div class="pull-right">
						<!-- <div class="form-group"> -->
							<button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Simpan</button>
							<a href="<?= site_url('pendaftaran_pasien');?>" class="btn btn-danger btn-sm" type="reset" id="resetBtn"><i class="fa fa-close"></i> Batal</a>
						<!-- </div> -->
					</div>
				</div>
			</div>
			</form>
		</div>
		<?php
				}
			?>

	</div>
	<div class="col-md-4">
		<div class="box box-primary box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">Antrian</h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
				</div>
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
					<ul class="todo-list">
						<li>
							<strong>Tanggal: </strong><?= date('d').' '.$bulan[date('m')].' '.date('Y');?>
						</li>
						<li>
							<strong>Antrian Pasien Hari Ini: </strong> <?php echo count($antrian);?>
						</li>
						<li>
							<strong>Pasien Terpanggil: </strong><?= count($antrian_terlayani)==0?"Belum Ada":count($antrian_terlayani);?>
						</li>
						<li>
							<strong>Sisa Antrian: </strong> <?= count($antrian_belum_terlayani);?>
							<!-- <input type="hidden" id="sisa_antrian" value="<?= count($antrian_belum_terlayani);?>"> -->
						</li>
					</ul>
			</div>
			<div class="box-footer">
				<div class="col-lg-6">
						<button type="button" class="btn btn-danger btn-block"><i class="fa fa-refresh"></i> Refresh</button>
				</div>
				<div class="col-lg-6">
					<a type="button" id="btnNextAntrian" class="btn btn-primary btn-block"><i class="fa fa-tv"></i> Next</a>
				</div>
			</div>
		</div>
	</div>
</div>
	<div class="row">
	<div class="box-body">
		<div class="row">
			<div class="col-md-12">
			<div class="box box-success box-solid">
				<div class="box-header">
					<h3 class="box-title">Pasien Terdaftar Hari Ini</h3>
					<div class="box-tools pull-right">
	                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
	                </button>
	              </div>
				</div>
				<div class="box-body">
					<table class="table table-bordered table-hover DataTable">
						<thead>
							<tr>
								<!-- <th rowspan="2" style="width: 4px;height: 2px">#</th> -->
								<!-- <th>Nomor Registrasi</th> -->
								<th class="col-md-2">Nomor Antrian</th>
								<th class="col-md-2">Nomor Kartu</th>
								<th class="col-md-2">Nomor Registrasi</th>
								<th>Nama</th>
								<th style="width:50px;">Status</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($registered as $row):?>
							<tr>
								<!-- <td><?php echo $row['no_registrasi'];?></td> -->
								<td><?php echo $row['no_antrian'];?></td>
								<td><?php echo $row['no_kartu'];?></td>
								<td><?php echo $row['no_registrasi'];?></td>
								<td><?php echo $row['nama_pasien'];?></td>
								<td><span class="label <?=$row['status_antrian']==0?'label-warning':'label-success';?>"><?= $row['status_antrian']==0?'Menunggu':'Terlayani';?></span></td>
							</tr>
						<?php endforeach;?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		</div>
	</div>
	</div>
		<div class="modal fade" id="confirmHapus"  data-backdrop="static" data-keyboard="false">
			<div class="modal-dialog">
				<div class="modal-content" style="margin-top:100px;">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" style="text-align:center;">
							Hapus <span class="grt"></span> dari antrian?
						</h4>
					</div>
					<div class="modal-footer">
						<span id="preloader-delete"></span>
						<br><a class="btn btn-primary" id="delete_link_m_n" href="">Delete</a>
						<button type="button" class="btn btn-default" data-dismiss="modal" id="delete_cancel_link">
							Cancel
						</button>
					</div>
				</div>
			</div>
		</div>

			</section>
		</div>
		<script>
	function confirm_delete(delete_url,title)
	{
		jQuery('#confirmHapus').modal('show', {backdrop: 'static',keyboard :false});
		jQuery("#confirmHapus .grt").text(title);
		document.getElementById('delete_link_m_n').setAttribute("href" , delete_url );
		// document.getElementById('delete_link_m_n').focus();
	}
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#mnPendaftaranPasien').addClass('active');
  });

</script>
<!-- ThaufiqUmardi's Script -->
<script type="text/javascript">
	$(document).ready(function(){
		$('#ruangan').hide();
		$('#bed').hide();
		$('#paket').hide();
		$('#containerLayanan').hide();
		$("select[name='id_paket']").attr('disabled',false);
    $("[data-mask]").inputmask();
    $('.DataTable').DataTable({});
    $('.datepicker').datepicker({
           format:'dd/mm/yyyy',
           todayHighlight:true,
           containter:true,
        });
    $("#btnExportExcell").click(function(e) {
      e.preventDefault();

      $('#opsi').remove();
      $('.opsiTd').remove();
      //getting data from our table
      var data_type = 'data:application/vnd.ms-excel';
      var table_div = document.getElementById('tablePasien');
      var table_html = table_div.outerHTML.replace(/ /g, '%20');

      var a = document.createElement('a');
      a.href = data_type + ', ' + table_html;
      var today = new Date();
	    var dd = today.getDate();
	    var mm = today.getMonth()+1; //January is 0!

	    var yyyy = today.getFullYear();
	    if(dd<10){
	        dd='0'+dd;
	    }
	    if(mm<10){
	        mm='0'+mm;
	    }
	    var today = dd+'/'+mm+'/'+yyyy;
	      a.download = 'Data Pasien' + dd +'-'+ mm +'-'+yyyy+ '.xls';
	      a.click();
	      location.reload();
	    });
	    $('#tgl_lahir').change(function(data){
	      var tgl_lahir=$(this).val().split('/');
	      var today = new Date();
	      var year = today.getFullYear();
	      var umur = year - tgl_lahir[2];
	      $('#umur').val(umur);
    });
    $('#id_pasien').change(function(data){
      var id = data.target.value;
      var url = "<?php echo site_url('Pasien/getPasienById');?>";
      $.get(url + '/' + id, function(data) {
				console.log(data);
				var splited = data.tgl_lahir.split('-');
				console.log(splited);
				var umur = 2017-splited[0];
				$("input[name='umur']").val(umur);
        $('#nama').val(data.nama_pasien);
        // $('#nama').attr('readonly',true);
        $('#alamat').val(data.jalan+'\n'+'Rt/Rw: '+data.rtrw+'\n'+data.kelurahan+'\n'+data.kecamatan+'\n'+data.kota);
        $('#no_rm').val(data.no_rm);
      }, "JSON");
    });
		$('.selectOption').select2();
		var sisa_antrian = $('#sisa_antrian').val();
		if(sisa_antrian == 0){
			$("#btnNextAntrian").addClass('disabled').removeAttr("href");
		}else{
			$("#btnNextAntrian").removeClass("disabled").attr("href", "<?= site_url('Pasien/nextAntrian');?>");
		}
  });
</script>
<?php
	if(!empty($this->session->flashdata('alert'))){
		$msg = $this->session->flashdata('alert');
		if(empty($msg['no_kartu'])){
		?>
		<script type="text/javascript">
			$('#alert').delay(7000).fadeOut("slow");
		</script>
		<?php
		}
	}
 ?>
<!-- End of ThaufiqUmardi's Script -->
	<?php $this->load->view('template/v_copyright'); ?>
	</body>
	<?php $this->load->view('template/v_footer'); ?>
</html>
