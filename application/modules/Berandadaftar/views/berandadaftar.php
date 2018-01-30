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


	<div class="box-body">
		<div class="row">
			<div class="col-md-12">
			<div class="box box-primary box-solid">
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
								<th class="col-md-2">No. Antrian</th>
								<th class="col-md-2">No. Kartu</th>
								<th class="col-md-3">Nama Pasien</th>
								<th class="col-md-3">Dokter</th>

								<th>
									Status
								</th>
							</tr>
						</thead>
						<tbody>

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
