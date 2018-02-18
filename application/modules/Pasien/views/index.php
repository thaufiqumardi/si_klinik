<?php
		$menusid = $this->M_crud->get_by_param("menu", 'name', "DataPasien");
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
    <body class="fixed hold-transition skin-blue-light ">
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
							<h3 class="box-title">Daftar Pasien</h3>
						</div>
						<div class="box-body">
							<a href="<?php echo site_url('Pasien/cetak');?>" target="_blank" class="btn btn-default pull-right"><i class="fa fa-print"></i> Cetak</a>
			              	<a href="<?php echo site_url('Pasien/doexport');?>" style="margin-right: 10px;" target="_blank" class="btn btn-success pull-right">
			              	  <i class="fa fa-file-excel-o"></i> Export Excell</a>
							  <?php if($this->session->userdata['simklinik']['ap_is_admin'] == 1 || $mnCreate == 1){
			              	  ?>
			              	  <a href="<?php echo base_url(); ?>Pasien/form" style="margin-right: 10px;" class="btn btn-primary pull-right">
			              	  <i class="fa fa-plus"></i> Tambah Data</a><br><br>
			              	  <?php
			              	  } else {
													echo "<br><br>";
												}
			              	  ?>
							<table id="example2" style="border: 2" class="table table-bordered table-striped DataTable">
								<thead>
									<tr>
										<th style="width: 5%;" class="text-center">No.</th>
										<th class="text-center">No. Rm</th>
							            <th class="text-center">No Kartu</th>
							            <th class="text-center">Nama</th>
							            <th class="text-center">Tempat, Tgl Lahir</th>
							            <th class="text-center col-md-3">Alamat</th>
							            <!-- <th class="text-center">Alamat</th> -->
										<th style="width: 10%;" class="text-center">Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php $i=1; foreach($pasiens as $pasien):?>
									<tr>
										<td><?php echo $i++;?></td>
										<td><?php echo $pasien['no_rm'];?></td>
										<td><?php echo $pasien['no_kartu'];?></td>
										<td><?php echo $pasien['nama_pasien'];?></td>
										<td class="col-md-2"><?php
			              					echo $pasien['tempat_lahir'].', '.date('d-M-Y',strtotime($pasien['tgl_lahir']));
			              					?>
			              				</td>
										<td><?php echo $pasien['jalan']." Rt/Rw:".$pasien['rtrw']." Kelurahan:".$pasien['kelurahan']." Kecamatan:".$pasien['kecamatan']." Kota:".$pasien['kota']?></td>
										<td class="opsiTd">
											<!-- <a class="btn btn-success btn-xs" href="#" title="Lihat Detail"><i class="fa fa-eye"></i></a> -->
											<a class="btn btn-warning btn-xs" href="<?php echo site_url('pasien/edit\/').$pasien['id_pasien'];?>"><i class="fa fa-edit" title="Edit"></i></a>
											<a class="btn btn-danger btn-xs" title="Hapus" href="" data-toggle="modal" onclick="confirm_delete('<?php echo site_url('pasien/hapus').'/'.$pasien['id_pasien'];?>','<?php echo $pasien['nama_pasien'];?>');"><i class="fa fa-trash"></i></a>
											<a class="btn btn-default btn-xs" title="Cetak" href="<?php echo site_url('pasien/cetak_detail\/').$pasien['id_pasien'];?>" target="_blank"><i class="fa fa-print" title="Cetak"></i></a>
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
			<div class="modal fade" id="confirmHapus"  data-backdrop="static" data-keyboard="false">
					<div class="modal-dialog">
						<div class="modal-content" style="margin-top:100px;">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title" style="text-align:center;">
									Anda Yakin Akan menghapus <span class="grt"></span>?
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
    	<?php $this->load->view('template/v_copyright'); ?>
    </body>

    <?php $this->load->view('template/v_footer'); ?>

	<script type="text/javascript">
  		function confirm_delete(delete_url,title)
		  {
		    jQuery('#confirmHapus').modal('show', {backdrop: 'static',keyboard :false});
		    jQuery("#confirmHapus .grt").text(title);
		    document.getElementById('delete_link_m_n').setAttribute("href" , delete_url );
		  }
	  $(document).ready(function(){
		$('#mnMasterPasien').addClass('active');
	  	$('#mnPasienTerdaftar').addClass('active');

	    $("[data-mask]").inputmask();
	    $('.selectOption').select2();
	    $('.datepicker').datepicker({
	        format:'dd/mm/yyyy',
	   		todayHighlight:true,
	        containter:true,
	    });

	    $('#alert').delay(10000).fadeOut("slow");

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
	      var url = "<?php echo site_url('pasien/getPasienById');?>";
	      $.get(url + '/' + id, function(data) {
	        $('#nama').val(data.nama_pasien);
	        // $('#nama').attr('readonly',true);
	        $('#alamat').val(data.alamat);
	        $('#no_rm').val(data.no_rekam_medik);
	      }, "JSON");
	    });

	    $('#jenis_rawat').change(function(data){
	      var jenis=data.target.value;
	      if(jenis=="RAWAT JALAN"){
	        $('#ruangan').attr('disabled',true);
	        $('#bed').attr('disabled',true);
	      }
	      else{
	        $('#ruangan').attr('disabled',false);
	        $('#bed').attr('disabled',false);
	      }
	    });

	    $('#ruangan').change(function(data){
	      var id_kamar = data.target.value;
	      // console.log(id_kamar);
	      var url="<?php echo site_url('pasien/getEmptyBedByIdKamar');?>";
	      $.get(url+'/'+id_kamar,function(data){
	        if(data.length==0){
	          $('#bed').append("<option selected disabled class='text-danger'>Tidak Ada Bed yang Kosong</option>");
	        }
	        else{
	          $.each(data,function(i,data){

	            $('#bed').append("<option value='"+data.nomor_bed+"'>"+data.nomor_bed+"</option>");
	          // console.log(data.nomor_bed);
	        });
	        }
	      },"JSON")
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
	  });
	</script>
</html>
