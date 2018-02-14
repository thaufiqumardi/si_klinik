<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$menusid = $this->M_crud->get_by_param("menu", 'name', "Kasir");
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
        <section class="content-header">
          <!-- <div class="pull-right"> -->
            <a href="../pemeriksaan" class="btn btn-warning btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
          <!-- </div> -->
        </section>
    		<section class="content">
					<div class="box box-primary box-solid">
						<div class="box-header" style="text-align:left;">
							<div class="row">
								<div class="col-md-3 pull-left">
									<h4>Form Kasir</h4>
								</div>
								<br>
							<div class="col-md-2 pull-right">
							<small>No. Transaksi : <?=$no_kuitansi;?></small>
							</div>
							</div>
						</div>
						<div class="box-body">
							<div class="row">
								<div class="col-md-4">
									<dl class="dl-horizontal">
                    <dt>Nomor Registrasi : </dt>
                    <dd><?= $pasien->no_registrasi;?></dd>
                    <dt>Tanggal Registrasi : </dt>
                    <dd><?= $pasien->tgl_registrasi;?></dd>
                    <dt>Nama Pasien : </dt>
                    <dd><?= $pasien->nama_pasien;?></dd>
                    <dt>Nama Dokter Pemeriksa : </dt>
                    <dd><?= $pasien->nama_dokter;?></dd>
                  </dl>
								</div>
								<div class="col-md-8">
									<table class="table table-striped tableData table-hover table-bordered">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>Nama Item</th>
                        <th>Tarif / Harga</th>
                        <th>Qty</th>
                        <th>Total Harga</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($detail_pembiayaan as $key => $row):?>
                        <?php
                          $harga = $this->M_base->currformat2($row->harga);
                          $harga = substr($harga,0,-3);
                          $total = $this->M_base->currformat2($row->total_harga);
                          $total = substr($total,0,-3);
                        ?>
                        <tr>
                          <td><?= ++$key;?></td>
                          <td><?= $row->nama_item;?></td>
                          <td><?= $harga;?></td>
                          <td><?= $row->qty;?></td>
                          <td><?= $total;?></td>
                        </tr>
                      <?php endforeach;?>
                    </tbody>
                  </table>
								</div>
							</div>
						</div>
					</div>
					<div class='alert alert-info TotalBayar'>
										<h2>Total : Rp. <span class="sub_total" id="sub_total"></span></h2>
									</div>
					<div class="box box-primary box-solid">
						<div class="box-body">
							<div class="row ">

								<div class="col-md-6 pull-right">
								<!-- <div class="pull-right"> -->
									<form class="form-horizontal" id="formPemasukan" method="post" action="<?=site_url('Kasir/simpanPemasukan');?>" target="_blank">
										<input type="text" name="no_kuitansi_pemasukan" value="<?=$no_kuitansi;?>" />
										<input type="text" name="id_registrasi" value="<?=$pasien->id_registrasi;?>">
										<div class="form-group">
											<label class="control-label col-md-3 col-md-offset-3">Total Bayar:</label>
											<div class="col-md-6 pull-right">
                      <?php
                        // $sub = $this->M_base->currformat2($sub_total);
                        // $sub = substr($sub,0,-3);
                      ?>
													<input type="text" name="total_bayar" readonly id="total_bayar" class="form-control input-lg">
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3 col-md-offset-3">Jumlah Bayar :</label>
											<div class="col-md-6 pull-right">
												<input type="text" name="jmlh_bayar" autocomplete="off" required id="UangCash" class="form-control input-lg " />
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3 col-md-offset-3">Kembalian :</label>
											<div class="col-md-6 pull-right">
												<input type="text" name="kembalian" id="UangKembali" class="form-control input-lg" readonly>
											</div>
										</div>
										<div class="form-group col-md-9 pull-right">
											<div class="row">
												<div class="col-md-6">
														<button type="button" onclick="window.history.back();" class="btn btn-warning btn-flat btn-block" id="btnRefresh"><i class="fa fa-arrow-left"></i> Kembali</button>
												</div>
												<div class="col-md-4">
													<button class="btn btn-primary btn-flat" type="submit" id="btnSimpan"><i class="fa fa-money"></i> Simpan Transaksi</button>
												</div>
											</div>
										</div>
									</form>
								<!-- </div> -->
							</div>
						</div>
					</div>
				</section>
    	</div>
		<?php $this->load->view('template/v_copyright'); ?>
    </body>
    <?php $this->load->view('template/v_footer'); ?>
    <script type="text/javascript">
    var nomor = 0;
    var total = 0;
    var kembalian = -1;
		var nomor_kuitansi = $("input[name='no_kuitansi_pemasukan']").val();
    $(document).ready(function(){
      $('#mnKasir').addClass('active');
      $('.tableData').DataTable({
        'lengthChange':false,
        'info':false,
        'searching':false,
        'pageLength':100,
        'paging':false,
      });

      total = <?= $sub_total;?>;
      $('.sub_total').text(to_rupiah(total));
      $('#total_bayar').val(to_rupiah(total));

			$('#btnRefresh').hide();
			$('#btnSimpan').click(function(){
				if($('#UangCash').val()==''){
					alert("Mohon Isi Jumlah Uang Bayar Terlebih Dulu")
				}
				else{
					$(this).hide();
					$('#btnRefresh').show();
				}
			});
			$("input[name='no_kuitansi_pemasukan']").val(nomor_kuitansi);
			$('#formPemasukan').submit(function(e){
				window.location.reload();
			})
			function to_rupiah(angka){
        var rev     = parseInt(angka, 10).toString().split('').reverse().join('');
        var rev2    = '';
        for(var i = 0; i < rev.length; i++){
            rev2  += rev[i];
            if((i + 1) % 3 === 0 && i !== (rev.length - 1)){
                rev2 += '.';
            }
        }
        return rev2.split('').reverse().join('');
    	}
			$(document).on('keyup', '#UangCash', function(){
    	HitungTotalKembalian();
			var kembali = $('#UangKembali').val();
			if(kembali==''|| kembali<0){
				$('#btnSimpan').attr('disabled',true);
			}
			else{
				$('#btnSimpan').attr('disabled',false);
			}
    });
    function HitungTotalKembalian()
    {
    	var uang = $('#UangCash').val().replace(",","");
    	uang = uang.split('.').join('');
    	var cash = parseFloat(uang);
    	if(cash >= total){
    		var selisih = cash - total;
    		kembalian = selisih;
    		$('#UangKembali').val(to_rupiah(kembalian));
    	} else {
    		$('#UangKembali').val('');
    		kembalian = -1;
    	}
    }
		$('#UangCash').inputmask("numeric",{
	        radixPoint: ".",
	        groupSeparator: ".",
	        digits: 2,
	        autoGroup: true,
	        rightAlign: false,
	        oncleared: function () { self.Value(''); }
	      });
			});
		</script>

</html>
