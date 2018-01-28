<!DOCTYPE HTML>
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
					<div class="alert <?php echo ($msg['class'] == 0 ? 'alert-danger' : 'alert-success'); ?> alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-<?php echo ($msg['class'] == 0 ? 'ban' : 'check'); ?>"></i> <?php echo ($msg['class'] == 0 ? 'Gagal' : 'Berhasil!'); ?></h4>
							<?php
							if(isset($msg['msg'])){
								echo $msg['msg'];
							}else{
								echo "Penambahan Dokter Gagal, Karena : <br>".validation_errors();
							}
							?>
					</div>
					<?php
				}
			?>
			<div class="row">
				<div  class="col-md-10">
					<div class="box box-primary box-solid">
						<div class="box-header with-border">
							<h3 class="box-title">Input Diagnosa Pasien</h3>
						</div>
						<form method="POST" class="formDokter form-horizontal" action="<?=site_url('rekammedik/form').'/'.$pasien->id_pasien;?>">
						<div class="box-body">
							<div class="form-group">
								<label class="control-label col-md-3">No. Rekam Medik </label>
								<div class="col-md-9">
									<input type="text" name="no_izin_praktek" value="<?= $pasien->no_rm;?>" class="form-control" disabled >
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">No. Kartu</label>
								<div class="col-md-9">
									<input type="text" name="nama" class="form-control" value="<?= $pasien->no_kartu;?>" disabled>
								</div>
							</div>
              <div class="form-group">
								<label class="control-label col-md-3">Nama Pasien</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="nama_pasien" value="<?= $pasien->nama_pasien;?>" disabled>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Tgl. Rekam Medik</label>
								<div class="col-md-3">
											<input type="text" name="tgl_rekam_medik" value="<?= date('d-M-Y');?>"  class="form-control" disabled
											/>
										</div>
								</div>

              <div class="form-group">
								<label class="control-label col-md-3">Dokter</label>
								<div class="col-md-9">
									<input type="text" class="form-control" value="<?= $pasien->nama_dokter;?>" name="dokter" disabled >
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Diagnosa</label>
								<div class="col-md-9">
									<textarea class="form-control" name="diagnosa"rows="3"></textarea>
								</div>
							</div>
							<div class="box-footer">
								<div class="pull-right">
									<button type="submit" class="btn btn-success

                  "><i class="fa fa-save"></i> Simpan</button>
									<a href="<?php echo base_url(); ?>Dokter" class="btn btn-danger"><i class="fa fa-close"></i> Batal</a>
								</div>
							  </div>
						</div>
					</form>
					</div>
				</div>
			</div>

      <div class="row">
				<div  class="col-md-12">
					<div class="box box-primary box-solid">
						<div class="box-header with-border">
							<h3 class="box-title">Riwayat Pasien</h3>
						</div>
						<form method="POST" class="formDokter form-horizontal" action="
						<?php
							if(isset($dokter['id_dokter'])){
								echo site_url('dokter/edit').'/'.$dokter['id_dokter'];
							}
							else{
								echo site_url('dokter/form');
							}
						?>">
						<div class="box-body">
              <table id="example2" style="border: 2" class="table table-bordered table-striped DataTable">
  							<thead>
  								<tr>
  									<th style="width: 5%;" class="text-center">No.</th>
  									<th class="text-center">No. Rekam Medik</th>
  									<th class="text-center">No. Kartu</th>
  									<th class="text-center">Nama Pasien</th>
  									<th class="text-center">Dokter</th>
                    <th class="text-center">Tgl. Rekammedik</th>
                    <th class="text-center">Diagnosa</th>
  									<th style="width: 10%;" class="text-center">Aksi</th>
  								</tr>
  							</thead>
  							<tbody>

  							</tbody>
  						</table>
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
	$(document).ready(function(){
		$('#mnMasterPegawai').addClass('active');
	  	$('#mnDokter').addClass('active');
		$('#resetBtn').click(function() {
        $('.formDokter').data('bootstrapValidator').resetForm(true);
    });
    	$("[data-mask]").inputmask();
    	$('.datepicker').datepicker({
           format:'dd/mm/yyyy',
           todayHighlight:true,
           containter:true,
        });
        $('.selectOption').select2();
        $('#alert').delay(10000).fadeOut("slow");
	});
</script>
