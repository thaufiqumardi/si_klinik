<?php

defined('BASEPATH') OR exit('No direct script access allowed');

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
								<h4><i class="icon fa fa-<?php echo ($msg['class'] == 0 ? 'ban' : 'check'); ?>"></i> <?php echo ($msg['class'] == 0 ? 'Peringatan!' : 'Berhasil!'); ?></h4>
								<?php echo "Penambahan paket gagal, karena : ".validation_errors(); ?>
						</div>
						<?php
					}
				?>
    			<div class="row">
						<div class="col-md-12">
							<div class="box box-primary box-solid">
								<div class="box-header with-border">
								  <h3 class="box-title">Input Data Paket</h3>
								</div>
								<form method="POST" class="formPasien form-horizontal" action="<?=(isset($paket)?site_url('paket/edit').'/'.$paket->paket_layanan_id:site_url('paket/tambah') );?>">
									<div class="row">
										<div class="col-md-6">
											<div class="box box box-solid">
												<input type="hidden" name="id_paket" class="form-control" required="required"
												<?php
													if(isset($paket)){
														echo("value='".$paket->paket_layanan_id."'");
													}
													else{
														echo "value='".set_value('id_paket')."'";
													}
												?>
												>
												<div class="box-header with-border">
											    <h3 class="box-title"><strong>Nama Paket &amp; Total Harga</strong></h3>
											    <!-- <div class="box-tools pull-right">
											      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
											      </button>
											    </div> -->
											  </div>
												<div class="box-body">
											    <div class="row">
											      <div class="col-md-12">
											        <div class="form-group">
											          <label class="control-label col-md-3">Nama Paket<sup style="color:red;">*</sup></label>
											          <div class="col-md-8">
											            <input type="text" name="nama_paket" class="form-control" required="required"
																	<?php
																		if(isset($paket)){
																			echo("value='".$paket->nama_paket_layanan."'");
																		}
																		else{
																			echo "value='".set_value('nama_paket')."'";
																		}
																	?>
																	>
											          </div>
											        </div>
											        <div class="form-group">
											          <label class="control-label col-md-3">Harga Paket<sup style="color:red;">*</sup></label>
											          <div class="col-md-8">
															<div class="input-group">
																<span class="input-group-addon">Rp.</span>
																<input type="text" name="total_harga" class="form-control" required="required" <?php
																	if(isset($paket)){
																		echo("value='".$paket->total_harga."'");
																	}
																	else{
																		echo "value='".set_value('total_harga')."'";
																	}
																?>>
															</div>
											          </div>
											        </div>
											      </div>
											    </div>
											  </div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="box box-solid">
											  <div class="box-header with-border">
											    <h3 class="box-title"><strong>Ruangan</strong></h3>
											    <!-- <div class="box-tools pull-right">
											      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
											      </button>
											    </div> -->
											  </div>
											  <div class="box-body">
											  	<div class="row">
											  		<div class="col-md-12">
											  			<div class="form-group">
											  				<label class="control-label col-md-3">Ruangan<sup style="color:red;">*</sup></label>
											  				<div class="col-md-8">
														        <select name="ruangan" class="form-control selectOption selectRuangan" required="required">
														        <option value="" selected disabled>-Pilih Ruangan-</option>
														          <?php foreach($ruangans as $row):?>
														            <option value="<?= $row->id_kamar.','.$row->nama_ruangan;
																				if(isset($detail_paket_ruangan)){
																					// foreach( $detail_paket_ruangan as $detail_ruangan){
																						echo($detail_paket_ruangan->item_id == $row->id_kamar?','.$detail_paket_ruangan->detail_paket_id:'');
																					// }
																				}
																				?>"
																					<?php
																					echo (isset($detail_paket_ruangan)? ($detail_paket_ruangan->item_id==$row->id_kamar?'selected':''):set_select('ruangan',$row->id_kamar.','.$row->nama_ruangan));
																				?>><?= $row->nama_ruangan;?></option>
														          <?php endforeach;?>
														        </select>
											  				</div>
											  			</div>
											  			<div class="form-group">
											  				<label class="control-label col-md-3">Tarif</label>
											  				<div class="col-md-8">
											        		<input type="text" name="tarif_ruangan" class="form-control" readonly
																	<?php
																		if(isset($detail_paket_ruangan)){
																			echo("value='".$detail_paket_ruangan->harga_item."'");
																		}
																		else{
																			echo "value='".set_value('tarif_ruangan')."'";
																		}
																	?>
																	>
											  				</div>
											  			</div>
											  		</div>
											  	</div>
											  </div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="box box-solid">
											  <div class="box-header with-border">
											    <h3 class="box-title"><strong>Obat</strong></h3>
											    <!-- <div class="box-tools pull-right">
											              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
											              </button>
											            </div> -->
											  </div>
											  <div class="box-body">
													<select class="form-control selectOption" name="obat[]" onchange="sumSelectedItem()" multiple="multiple" data-placeholder="Pilih Obat Dengan Mengetikan Nama Obat" style="width: 100%;">
														<?php foreach ($obats as $key => $obat):?>
															<option value='<?php echo($obat->id_obat.','.$obat->nama_obat.','.$obat->harga_jual1);
																if(isset($detail_paket_obat)){
																	foreach($detail_paket_obat as $detail_obat){
																		echo($detail_obat->item_id == $obat->id_obat?','.$detail_obat->detail_paket_id:'');
																	}
																}
															?>'
																<?php
																if(isset($detail_paket_obat)){
																	foreach($detail_paket_obat as $detail_obat){
																		echo($detail_obat->item_id == $obat->id_obat?'selected':'');

																	}
																}
																else{
																	set_select('obat[]',$obat->id_obat);
																}
																?>
																><?=$obat->nama_obat;?></option>
														<?php endforeach;?>
													</select>
											    <!-- <table class="table DataTable table-bordered table-striped">
											      <thead>
											        <tr>
												        <th>
												          #
												        </th>
												        <th>
												          Nama Obat
												        </th>
												        <th>
												          Harga Obat
												        </th>
												        <th style="width:30px;">
												          Masukan ke Paket
												        </th>
											        </tr>
											      </thead>
											      <tbody>
											        <?php foreach($obats as $key => $o):
											          $tarif_obat = $this->M_base->currFormat2($o->harga_jual1);
											          $tarif_obat = str_replace(".00","",$tarif_obat);
											          $tarif_obat = "Rp. ".$tarif_obat;?>
											          <tr>
											            <td style="width:5px;">
											              <?=++$key;?>
											            </td>
											            <td>
											              <?= $o->nama_obat;?>
											            </td>
											            <td>
											              <?= $tarif_obat;?>
											            </td>
											            <td>
											              <input type="checkbox" name="obat[]" onclick="sumSelectedItem()" value="<?= $o->id_obat.','.$o->nama_obat.','.$o->harga_jual1;?>" />
											            </td>
											          </tr>
											        <?php endforeach;?>
											      </tbody>
											    </table> -->
											  </div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="box box-solid">
											  <div class="box-header with-border">
											    <h3 class="box-title"><strong>Layanan</strong></h3>
											    <!-- <div class="box-tools pull-right">
											              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
											              </button>
											            </div> -->
											  </div>
											  <div class="box-body">
													<select class="form-control selectOption" name="layanan[]" onchange="sumSelectedItem()" multiple="multiple" data-placeholder="Pilih Layanan Dengan Mengetikan Nama Layanan" style="width: 100%;">
														<?php foreach($layanans as $row):?>
															<option value="<?= $row->id_layanan.','.$row->tarif.','.$row->nama;
															if(isset($detail_paket_layanan)){
																foreach($detail_paket_layanan as $detail_layanan){
																	echo($detail_layanan->item_id == $row->id_layanan?','.$detail_layanan->detail_paket_id:'');
																}
															}
															?>"
																<?php
																if(isset($detail_paket_layanan)){
																	foreach($detail_paket_layanan as $detail_layanan){
																		echo($detail_layanan->item_id == $row->id_layanan?'selected':'');
																	}
																}
																else{
																	set_select('layanan[]',$row->id_layanan.','.$row->tarif.','.$row->nama);
																}
																?>
																> <?= $row->nama;?></option>
														<?php endforeach;?>
													</select>
											    <!-- <table class="table table-bordered table-striped DataTable">
											      <thead>
											        <tr>
											          <th style="width:5px;">
											            <b>#</b>
											          </th>
											          <th>
											            Nama Layanan
											          </th>
											          <th>
											            Tarif
											          </th>
											          <th style="width:30px;">
											            Masukan ke Paket
											          </th>
											        </tr>
											      </thead>
											      <tbody>
											        <?php $i=1; foreach($layanans as $row):
											          $tarif_layanan = $this->M_base->currFormat2($row->tarif);
											          $tarif_layanan = str_replace(".00","",$tarif_layanan);
											          $tarif_layanan = "Rp. ".$tarif_layanan;
											        ?>
											        <tr>
											          <td>
											            <?= $i;?>
											          </td>
											          <td>
											            <?= $row->nama;?>
											          </td>
											          <td>
											            <?= $tarif_layanan;?>
											          </td>
											          <td>
											            <input type="checkbox" name="layanan[]" onclick="sumSelectedItem()" value="<?= $row->id_layanan.','.$row->tarif.','.$row->nama;?>"/>
											          </td>
											        </tr>
											      <?php $i++; endforeach;?>
											      </tbody>
											    </table> -->
											  </div>
											</div>
										</div>
									</div>

								  <!-- </section> -->
								  <div class="box-footer">
								  	<div class="pull-left">
										<p>Yang bertanda <span style="color: red;">(*)</span> wajib di isi.</p>
									</div>
								  	<div class="pull-right">
										<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
										<a href="<?php echo base_url(); ?>Paket" class="btn btn-warning"><i class="fa fa-close"></i> Batal</a>
									</div>
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
    var obat;
    var layanan;
    var harga_obat=0;
    var harga_layanan=0;
		var harga_ruangan;
		var id_paket = $("input[name='id_paket']").val();
		if(id_paket == "" || id_paket == "0"){
			harga_ruangan = 0;
		}
  	else{
			harga_ruangan = parseInt($("input[name='tarif_ruangan']").val());
		}
    var totalbanget = 0;
		// sumTotalBanget();
    	function sumTotalBanget(){
    		totalbanget = harga_obat+harga_layanan+harga_ruangan;
    		var totaltarif = $("input[name='total_harga']");
    		$(totaltarif).val(totalbanget.toLocaleString());
    	}
    	function sumSelectedItem(){
				// console.log($("select[name='obat[]']").val());
    		obat = $("select[name='obat[]']")
    								.map(function(){
    									return $(this).val();
    								}).get();
    		harga_obat=0;
    		for(var i = 0; i < obat.length; i++){
    			var xx = obat[i].split(',');
    			harga_obat += parseInt(xx[2]);
    		}
    		layanan = $("select[name='layanan[]']")
    							.map(function(){
    								return $(this).val();
    							}).get();
    		// console.log(layanan);
    		harga_layanan = 0;
    		for(var i=0; i < layanan.length;i++){
    			var xx = layanan[i].split(',');
    			harga_layanan += parseInt(xx[1]);
    		}
    		sumTotalBanget();
    	}
      $(document).ready(function(){
				var tarif_ruangan = document.getElementsByName('tarif_ruangan');
				$(tarif_ruangan).val(parseInt(harga_ruangan).toLocaleString());
				// console.log(harga_ruangan);
				sumSelectedItem();
				// sumTotalBanget();
    	$('#mnMasterLayanan').addClass('active');
      $('#mnPaket').addClass('active');
    	$('.selectRuangan').change(function(data){
    		var ruangan = data.target.value;
    		var id_ruangan = ruangan.split(',');
    		// console.log(id_ruangan[0]);
    		var url= "<?php echo site_url('Paket/getRuanganById');?>";
    		$.get(url+'/'+id_ruangan[0],function(data){
    			// console.log(data);
    			var tarif_ruangan = document.getElementsByName('tarif_ruangan');
    			$(tarif_ruangan).val(parseInt(data.tarif).toLocaleString());
    			harga_ruangan = parseInt(data.tarif);
    			sumTotalBanget();
    		},"JSON");
    	})
    	$('.DataTable').DataTable({
				searching:false,
				render: function (row, type, val, meta) {
							 return  '<input type="checkbox"/>';
						 }
			});
    	$('.selectOption').select2({});
			// var id_paket = $("input[name='id_paket']").val();
			// if(id_paket==""){

			// }

    });
	</script>
</html>
