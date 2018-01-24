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
					<?php echo $msg['msg']; ?>
			</div>
			<?php
		}
		?>
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Pendaftaran Pasien</h3>
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
						<div class="callout callout-warning text-center">
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
								<option selected disabled value="">Nama Pasien / No. Kartu / No.Rm</option>
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
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-4">Jenis Pembayaran</label>
							<div class="col-md-8">
								<select class="form-control selectOption" name="jenis_pembayaran" required>
									<option selected disabled value="">Pilih Jenis Pembayaran</option>
									<option value="UMUM" <?php echo set_select('jenis_pembayaran','UMUM');?>>UMUM</option>
									<option value="BPJS" <?php echo set_select('jenis_pembayaran','BPJS');?>>BPJS</option>
								</select>
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
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-4">Jenis Rawat</label>
							<div class="col-md-8">
								<select class="form-control selectOption" name="jenis_rawat" id="jenis_rawat" required>
									<option disabled selected value="">Pilih Jenis Rawat</option>
									<option value="RAWAT INAP" <?php echo set_select('jenis_rawat','RAWAT INAP');?>>Rawat Inap</option>
									<option value="RAWAT JALAN" <?php echo set_select('jenis_rawat','RAWAT JALAN');?>>Rawat Jalan</option>
								</select>
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
					<div class="col-md-6" id="paket">
						<div class="form-group">
							<label class="control-label col-md-4">Paket</label>
							<div class="col-md-8">
								<select class="form-control selectOption selectPaket" style="width:100%;" disabled name="id_paket">
									<option selected disabled value="">
										Pilih Paket Layanan
									</option>
									<?php foreach($pakets as $paket):?>
										<option value="<?= $paket->paket_layanan_id;?>"><?= $paket->nama_paket_layanan;?></option>
									<?php endforeach;?>
								</select>
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
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group" id="ruangan">
									<label class="control-label col-md-4">Ruangan</label>
									<div class="col-md-8">
										<input type="text" name="id_kamar" class="form-control" readonly/>
										<!-- <select class="form-control selectOption " disabled name="id_kamar">
											<option selected disabled>Pilih Ruangan</option>
											<?php foreach($ruangan as $r):?>
												<option value="<?php echo $r['id_kamar'];?>"><?php echo $r['nama_ruangan'];?></option>
											<?php endforeach;?>
										</select> -->
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group" id="bed">
								  <label class="control-label col-md-4">Nomor Bed</label>
		  						<div class="col-md-8">
		  							<select class="form-control selectOption" style="width:100%;" disabled name="id_bed" onclick="alert()">
		  								<!-- <option selected disabled>Pilih Nomor Bed</option> -->
		  							</select>
		  						</div>
								</div>
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
					<div  id="divLayanan" >
						<div class="col-md-6" id="containerLayanan">
							<div class="form-group">
								<label class="control-label col-md-4">Layanan Pemeriksaan</label>
								<div class="col-md-8">
									<select required class="form-control selectOption pilihanLayanan" multiple="multiple" style="width:100%;" name="layanan[]" id="selectLayanan" data-placeholder="Pilih Layanan">
										<?php foreach($layanans as $layanan):?>
											<option value="<?= $layanan->id_layanan;?>"><?= $layanan->nama;?></option>
										<?php endforeach;?>
									</select>
								</div>
								<!-- <div class="col-md-2">
									<button type="button" class="btn btn-default" id="btnTambahLayanan"><i class="fa fa-plus"></i></button>
								</div> -->
							</div>
						</div>
					</div>

				</div>
				<div id="wrapperPilihLayanan">

				</div>
				<div class="box-footer">
					<div class="pull-left">
						<a href="<?php echo site_url('pasien/form');?>" class="btn btn-warning btn-sm">
							<i class="fa fa-plus"></i> Tambahkan Pasien Baru
						</a>
					</div>
					<div class="pull-right">
						<!-- <div class="form-group"> -->
							<button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Simpan</button>
							<a href="<?= site_url('pendaftaran_pasien');?>" class="btn btn-default btn-sm" type="reset" id="resetBtn"><i class="fa fa-close"></i> Batal</a>
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
								<th>Nomor Registrasi</th>
								<th>Nomor Kartu</th>
								<th>Nama</th>
								<th>Nomor Antrian</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($registered as $row):?>
							<tr>
								<td><?php echo $row['no_registrasi'];?></td>
								<td><?php echo $row['no_kartu'];?></td>
								<td><?php echo $row['nama_pasien'];?></td>
								<td><?php echo $row['no_antrian'];?></td>
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
function validator(){
	$('.formPendaftaran').bootstrapValidator({
		message: 'This value is not valid',
				feedbackIcons: {
						valid: 'glyphicon glyphicon-ok',
						invalid: 'glyphicon glyphicon-remove',
						validating: 'glyphicon glyphicon-refresh'
				},
				fields:{
					id_pasien:{
						message:'Pasien Tidak Valid',
						validators:{
							notEmpty:{
								message:'Pasien Harus Dipilih'
							}
						}
					},
					no_kartu: {
								message: 'Nomor Kartu Tidak Valid',
								validators: {
										notEmpty: {
												message: 'Nomor Kartu Tidak Boleh Kosong'
										},
										regexp:{
											regexp:/^[0-9 ]+$/,
											message:'Nomor Kartu Tidak Diperkenankan Diisi Dengan Abjad'
										},
								}
						},
						nama_pasien:{
							message: 'Nama Pasien Tidak Valid',
							validators:{
								notEmpty:{
									message: 'Nama Pasien Tidak Boleh Kosong'
								},
								// regexp:{
								// 	regexp:/^[a-zA-z ]+$/,
								// 	message:'Nama Pasien Tidak Diperkenankan selain A-Z'
								// }
							}
						},
						alamat:{
							message:'Tidak Valid',
							validators:{
								notEmpty:{
									message:'Tidak Boleh Kosong'
								},
							}
						},
					no_rekam_medik:{
						message:'Nomor Rekam Medik Tidak Valid',
						validators:{
							notEmpty:{
								message:'Nomor Rekam Medik Harus Terisi'
							}
						}
					},
					jenis_pembayaran:{
						message:'Jenis Pembayaran Harus Terisi',
						validators:{
							notEmpty:{
									message:'Tidak Boleh Kosong'
								},
						}
					},
					id_kamar:{
						// message:'Tidak Valid',
					 //  	validators:{
					 //  		notEmpty:{
					 //  			message:'Tidak Boleh Kosong'
					 //  		},
					 //  	}
					},
					id_bed:{
						message:'Tidak Valid',
							// validators:{
							// 	notEmpty:{
							// 		message:'Tidak Boleh Kosong'
							// 	},
							// }
					},
					jenis_rawat:{
						message:'Tidak Valid',
							validators:{
								notEmpty:{
									message:'Tidak Boleh Kosong'
								},
							}
					},
				}
	});
}
$("select[name='layanan[]']").attr('disabled',true);
$('.selectPaket').change(function(data){
	var selectBed = $("select[name='id_bed']");
	$(selectBed).find('option')
							.remove()
							.end()
							.append("<option selected disabled value=''>Pilih Bed</option>");
	var id_paket = data.target.value;
	var url = "<?php echo site_url('Pasien/getRuanganByPaketId');?>";
	$("select[name='id_bed']").attr('disabled',false);
	$.get(url+'/'+id_paket,function(data){
		console.log(data);
		getKamar(data.item_id);
	},"JSON");
});
function getKamar(id){
	var url ="<?php echo site_url('Pasien/getKamarById');?>";
	$.get(url+'/'+id,function(data){
		console.log(data);
		$("input[name='id_kamar']").val(data.nama_ruangan);
		getBed(data.id_kamar);
	},"JSON");
}
function getBed(id){
	var url="<?php echo site_url('Pasien/getEmptyBedByIdKamar');?>";
	$.get(url+'/'+id,function(data){
		console.log(data);
		if(data.length==0){
			$("select[name='id_bed']").append("<option selected disabled class='text-danger'>Tidak Ada Bed yang Kosong</option>");
		}
		else{
			$.each(data,function(i,data){
				$("select[name='id_bed']").append("<option value='"+data.id_bed+"'>"+data.nama_bed+" (KOSONG)</option>");
			// console.log(data.nomor_bed);
		});
		}
	},"JSON")
}
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
    $('.status').change(function(data){
      var stat= data.target.value;
      var x = document.getElementById('pernikahan');
      // console.log(stat);
      if(stat=="Menikah"){
              x.style.display = "block";
      }
      else{
        x.style.display = "none";
      }
    });
    var jk=$('.jk').val();
    // console.log(jk);
    if(jk == 'Laki-Laki'){
        $('.suamiIstri').text("Istri");
      }
      else{
        $('.suamiIstri').text("Suami");
      }
    $('.jk').change(function(data){
      var jenis= data.target.value;
      // console.log(jenis);
      if(jenis == 'Laki-Laki'){
        $('.suamiIstri').text("Istri");
      }
      else{
        $('.suamiIstri').text("Suami");
      }
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
			// validator();
    });
		if($("select[name='jenis_rawat']").val()==="RAWAT JALAN"){

			hapusKomponenRawatInap();
		}
    $('#jenis_rawat').change(function(data){
      var jenis=data.target.value;
      if(jenis=="RAWAT JALAN"){
				$("select[name='layanan[]']").attr('disabled',false);
				$('#containerLayanan').show();
				hapusKomponenRawatInap();
      }
      else{
				$('#ruangan').show();
				$('#bed').show();
				$('#paket').show();
				$("select[name='id_paket']").attr('disabled',false);
				$('#divLayanan').hide();

      }
    });
		function hapusKomponenRawatInap(){
			$("select[name='id_paket']").find('option')
									.hide()
									.end();
			$("input[name='id_kamar']").val("");
			$("select[name='id_bed']").find('option')
									.remove()
									.end()
									.append("<option selected disabled value=''>Pilih Bed</option>");;
			$('#ruangan').hide();
			$('#paket').hide();
			$('#bed').hide();
			$('#divLayanan').show();
		}
    $('#ruangan').change(function(data){
      var id_kamar = data.target.value;
      // console.log(id_kamar);
      var url="<?php echo site_url('Pasien/getEmptyBedByIdKamar');?>";
      $.get(url+'/'+id_kamar,function(data){
        if(data.length==0){
          $('#bed').append("<option selected disabled class='text-danger'>Tidak Ada Bed yang Kosong</option>");
        }
        else{
          $.each(data,function(i,data){
            $("select[name='id_bed']").append("<option value='"+data.nama_bed+"'>"+data.nama_bed+"</option>");
          // console.log(data.nomor_bed);
        });
        }
      },"JSON")
    });
    $('#alert').delay(10000).fadeOut("slow");
		$('#btnTambahLayanan').click(function(){
			// alert("hahaha");
			var max_layanan =10;
			var allowNew = false;

			var inputLayanan = document.getElementsByName('layanan[]');
			var arrInput =[];
			for(var i=0; i< inputLayanan.length; i++){
				var valInputLayanan = inputLayanan[i];
				if(valInputLayanan.value =="" || valInputLayanan.value =="0"){
					allowNew = false;
				}
				else{
					arrInput[i]=parseInt(valInputLayanan.value);
					// console.log("isian ke:"+i+" "+valInputLayanan.value)
					allowNew = true;
				}
			}
			if(allowNew === true){
				var html = "<div class='row' id='idTambahan'>"+
					"<div class='col-md-6'>"+
					"</div>"+
					"<div class='col-md-6'>"+
						"<div class='form-group'>"+
							"<label class='control-label col-md-4'></label>"+
							"<div class='col-md-6' >"+
								"<select class='form-control selectLay pilihanLayanan'style='margin-top:5px' name='layanan[]'>"+
								"<option selected disabled>PilihLayanan</option>"+
								<?php foreach($layanans as $layanan):?>
									"<option value='<?=$layanan->id_layanan;?>'><?=$layanan->nama;?></option>"+
								<?php endforeach;?>
								"</select>"+
							"</div>"+
							"<div class='col-md-2'>"+
							"<button type='button' class='btn btn-danger' id='btnHapusLayanan'><i class='fa fa-trash'></i></button>"+
							"</div>"+
						"</div>"+
					"</div>"+
				"</div>";
				$('#wrapperPilihLayanan').append(html);
				$('.selectLay').select2();
				$('#wrapperPilihLayanan').on("click","#btnHapusLayanan",function(e){
					e.preventDefault();
					$(this).closest('#idTambahan').remove();
				});
			}
			else{
				alert("Layanan Sebelumnya Harus Terisi Sebelum Menambahkan Yang Baru");
			}
		});

		$('.selectOption').select2();
  });
</script>
<!-- End of ThaufiqUmardi's Script -->
	<?php $this->load->view('template/v_copyright'); ?>
	</body>
	<?php $this->load->view('template/v_footer'); ?>
</html>
