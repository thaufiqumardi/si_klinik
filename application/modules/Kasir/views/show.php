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
    <body class="fixed hold-transition skin-blue-light sidebar-mini">
    	<?php $this->load->view('template/v_left_menu'); ?>
    	<div class="content-wrapper">
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
									<div class="row" style="margin-bottom:5%;">
										<div class="form-group">
											<label class="control-label col-md-2">Kd_Obat</label>
											<div class="col-md-10">
												<div class="input-group input-group-sm">
													<input type="text" name="kode_barang" id="searchByKodeBarang" class="form-control" />
													<span class="input-group-btn">
														<button type="button" id="searchBarang" class="btn btn-small btn-primary btn-flat"><i class="fa fa-search"></i></button>
													</span>
												</div>

											</div>
										</div>
									</div>
									<form id="form_transaksi" class="form-horizontal" action="<?= site_url('Kasir/transaksiBarang');?>" method="post">
										<div class="form-group">
											<label class="control-label col-md-2">Nama</label>
											<div class="col-md-10">
												<input type="hidden" name="no_kuitansi" class="ignoreReset" value="<?=$no_kuitansi;?>" />
												<input type="hidden" name="id_barang" />
												<input type="text" name="nama_barang" class="form-control" readonly  />
											</div>
										</div>
										<div class="form-group">
											<input type="hidden" name="id_satuan" />
											<label class="control-label col-md-2">Satuan</label>
											<div class="col-md-10">
												<input type="text" name="satuan_barang" class="form-control" readonly  />
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-2">Harga</label>
											<div class="col-md-10">
												<input type="text" name="harga_barang" class="form-control" readonly  />
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-2">Qty</label>
											<div class="col-md-10">
												<input type="text" name="jumlah_barang" class="form-control"   />
											</div>
										</div>
										<div class="form-group">
											<div class="col-md-12">
												<button type="submit" id="btnTrx" class="btn btn-block btn-primary"><i class="fa fa-send"></i> Masukan</button>
											</div>
										</div>
									</form>
								</div>
								<div class="col-md-8">
									<table class="table tableTransaksi">
										<thead>
											<tr>
												<th>
													No
												</th>
												<th>
													Kd_Obat
												</th>
												<th>
													Nama Barang
												</th>
												<th>
													Harga
												</th>
												<th>
													Qty
												</th>
												<th>
													Total Harga
												</th>
												<th>
													Aksi
												</th>
											</tr>
										</thead>
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
										<input type="hidden" name="no_kuitansi_pemasukan" />
										<div class="form-group">
											<label class="control-label col-md-3 col-md-offset-3">Total Bayar:</label>
											<div class="col-md-6 pull-right">

													<input type="text" name="total_bayar" readonly id="total_bayar" class="form-control input-lg ">

											<!-- <h2 style="padding:none;">Rp. 40.000</h2> -->
											<!-- <labelclass="control-label pull-right sub_total">Rp. <span class="sub_total" id="sub_total"></span></label> -->
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3 col-md-offset-3">Jumlah Bayar :</label>
											<div class="col-md-6 pull-right">
												<input type="text" name="jmlh_bayar" id="UangCash" required class="form-control input-lg ">
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
														<button type="button" onclick="window.location.reload();" class="btn btn-default btn-flat btn-block" id="btnRefresh"><i class="fa fa-refresh"></i> Transaksi Baru</button>
												</div>
												<div class="col-md-6">
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
    $(document).ready(function() {
			$('#btnRefresh').hide();
			$('#btnSimpan').click(function(){
				$(this).hide();
				$('#UangCash').attr('disabled',true);
				$('#btnRefresh').show();
			});
			$('#btnSimpan').attr('disabled',true);
			$('#btnTrx').on("click",function(){
				var kode = $('#searchByKodeBarang').val();
				if(kode==''||kode==0){
					alert("Silahkan Cari Barang dulu");
				}
			});
    	$('#mnKasir').addClass('active');
			var nomor_kuitansi = $("input[name='no_kuitansi']").val();
			if(nomor_kuitansi ==null || nomor_kuitansi==0){
				$("input[name='no_kuitansi_pemasukan']").val('0');
			}
			$("input[name='no_kuitansi_pemasukan']").val(nomor_kuitansi);
    	$('#searchByKodeBarang').keyup(function(event){
				if(event.keyCode==13){
					var data = $(this).val();
					var uri = "<?= site_url('Kasir/getObatByKd');?>";
					$.get(uri+'/'+data,function(data){
						if(data==null){
							alert("Data Obat tidak ada");
						}
						else{
							$("input[name='id_barang']").val(data.id_obat);
							$("input[name='nama_barang']").val(data.nama_obat);
							$("input[name='satuan_barang']").val(data.satuan_nama);
							$("input[name='id_satuan']").val(data.satuan_id);
							$("input[name='harga_barang']").val(data.harga_jual1);
						}
					},"JSON");
				}
			});
			$('#form_transaksi').submit(function(e){
				$('#btnSimpan').attr('disabled',false);
				e.preventDefault();
				$.ajax({
					type:"POST",
					url : "<?= site_url('Kasir/transaksiBarang');?>",
					cache:false,
					data:$(this).serialize(),
					success: function(data){
						try {
							var no_kuitansi = $("input[name='no_kuitansi']").val();
							setTableTransaksi(no_kuitansi);
							$('#form_transaksi :input:not(".ignoreReset")').val('');
							$('#searchByKodeBarang').val('');
						} catch (e) {
							alert("Transaksi Gagal");
						}
					}
					// $('#btnSimpan').attr('disabled',false);
				});
				var nomor_kuitansi = $("input[name='no_kuitansi']").val();
				var uri = "<?=site_url('Kasir/getSubTotal');?>";
				$.get(uri+'/'+nomor_kuitansi,function(data){
					total = data.sub_total;
					$('.sub_total').text(to_rupiah(total));
					$('#total_bayar').val(to_rupiah(total))
				},"JSON");
			});
			function setTableTransaksi(no_kuitansi){
				var tableTransaksi = $('.tableTransaksi').DataTable({
					"searching":false,
						"lengthChange":false,
						"retrieve":true,
						"info":false,
						"paging":false,
						"pageLength": 100,
						"columnDefs": [{
	              "targets": [ -1,-2,-3,-4,-5,-6,-7],
	              "orderable": false,

	      		}],
				});
				var url = "<?= site_url('Kasir/getTransaksiNow');?>";
				$.get(url+'/'+no_kuitansi,function(data){
					tableTransaksi.clear().draw();
					var JSONObject = data;
					var counter = 1;
					for(var key in JSONObject){
						if(JSONObject.hasOwnProperty(key)){
							var harga = JSONObject[key]["harga_barang"].toLocaleString();
							tableTransaksi.row.add([
								counter++,
								JSONObject[key]["kode_obat"],
								JSONObject[key]["nama_obat"],
								harga,
								JSONObject[key]["qty_barang"],
								JSONObject[key]["total_harga"],
								"aksi",
							]).draw(false);
						}
					}
					console.log(data);
				},"JSON");
			}
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
    });
    function HitungTotalKembalian()
    {
    	var uang = $('#UangCash').val();
    	uang = uang.split('.').join('');
    	var cash = parseFloat(uang);
    	if(cash >= total){
    		var selisih = cash - total;
    		kembalian = selisih;
    		$('#UangKembali').val(to_rupiah(selisih));
    	} else {
    		$('#UangKembali').val('');
    		kembalian = -1;
    	}
    }
			});
		</script>

</html>
