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
							<h4>Form Kasir</h4>
						</div>
						<div class="box-body">
							<div class="row">
								<div class="col-md-4">
									<form class="form-horizontal">
										<div class="form-group">
											<label class="control-label col-md-2">Kd_Obat</label>
											<div class="col-md-10">
												<div class="input-group input-group-sm">
													<input type="text" name="kode_barang" class="form-control" />
													<span class="input-group-btn">
														<button type="button" id="searchBarang" class="btn btn-small btn-primary btn-flat"><i class="fa fa-search"></i></button>
													</span>
												</div>

											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-2">Nama</label>
											<div class="col-md-10">
												<input type="text" name="nama_barang" class="form-control" readonly  />
											</div>
										</div>
										<div class="form-group">
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
												<button class="btn btn-block btn-primary"><i class="fa fa-send"></i> Masukan</button>
											</div>
										</div>
									</form>
								</div>
								<div class="col-md-8">
									<table class="table table-bordered">
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
					<div class="box box-primary box-solid">
						<div class="box-body">
							<div class="row ">

								<div class="col-md-6 pull-right">
								<!-- <div class="pull-right"> -->

									<form class="form-horizontal">
										<div class="form-group">
											<label class="control-label col-md-3 col-md-offset-3">Sub Total :</label>
											<div class="col-md-6 pull-right">
											<label class="control-label pull-right "> Rp. XXXXXXX </label>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3 col-md-offset-3">Jumlah Bayar</label>
											<div class="col-md-6 pull-right">
												<input type="text" name="jmlh_bayar" class="form-control ">
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3 col-md-offset-3">Kembalian</label>
											<div class="col-md-6 pull-right">
												<input type="text" name="kembalian" class="form-control " readonly>
											</div>
										</div>
										<div class="form-group col-md-9 pull-right">
											<button class="btn btn-primary btn-block">Bayar</button>
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
    	$('#mnKasir').addClass('active');
    	$('#btnNew').show();
    	$('#btnPrint').hide();
    	$('#btnSimpan').show();

    	$('#alert').delay(10000).fadeOut("slow");

    	$('.selectOption').select2();

    	$("select[name='no_registrasi']").change(function(data){
			var no_registrasi = $(this).val();
			var url = "<?= site_url('Kasir/getPasienByNoRegistrasi');?>";
			$.get(url+'/'+no_registrasi,function(data){
				var tgl_lahir_splited = data.tgl_lahir_pasien.split('-');
				var umur = 2017-tgl_lahir_splited[0];
				$("input[name='no_reg']").val(data.no_registrasi);
				$("input[name='no_rm']").val(data.no_rm);
				$("input[name='id_reg']").val(data.id_registrasi);
				$("input[name='tgl_registrasi']").val(data.tgl_registrasi);
				$("input[name='no_rm']").val(data.no_rm);
				$("input[name='nama_pasien']").val(data.nama_pasien);
				$("input[name='jk_pasien']").val(data.jenis_kelamin_pasien);
				$("input[name='alamat_pasien']").val(data.jalan);
			},"JSON");

			$.ajax({
	            url : "<?php echo site_url('Kasir/getdetail')?>" + "/" + no_registrasi,
	            type: "GET",
	            dataType: "JSON",
	            success: function(data)
	            {
		            total = 0;
            		deletes();
	            	for (i = 0; i < data.length; i++) {
	            		var mySplitResult = data[i];
	            		nomor++;
	 	            	$('#orderItem').append(
	 		    	        	'<tr class="baris" id="baris_'+ nomor +'">'
	 		    	            + '<input type="hidden" name="nomor[]" value="'+ nomor +'">'
	 		    	        	+ '<input type="hidden" id="id_pembiayaan'+ nomor +'" name="id_pembiayaan'+ nomor +'" value="'+ mySplitResult[0] +'">'
	 		    	            + '<td><label style="font-weight: normal;">'+ mySplitResult[1] +'</label></td>'
	 		    	            + '<td><label style="font-weight: normal;">'+ parseFloat(mySplitResult[2]).toFixed(2).replace(".", ",").replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.") +'</label></td>'
	 		    	            + '<td><label style="font-weight: normal;">'+ mySplitResult[3] +'</label></td>'
	 		    	            + '<td><label style="font-weight: normal;">'+ parseFloat(mySplitResult[4]).toFixed(2).replace(".", ",").replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.") +'</label></td>'
	 		    	            + '<td><label style="font-weight: normal;">'+ parseFloat(mySplitResult[5]).toFixed(2).replace(".", ",").replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.") +'</label></td>'
	 		    	            + '</tr>'
	 		    	        );
	 	            	total = total + parseFloat(mySplitResult[5]);
	                }
	            	$('[name="UangTotal"]').val(parseFloat(total).toFixed(2).replace(".", ",").replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));
	            	$('[name="UangCash"]').val('');
	            	$('[name="UangKembali"]').val('');
	            	document.getElementById("TotalBayar").innerHTML = "Rp. " + parseFloat(total).toFixed(2).replace(".", ",").replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
	            }
	        });

		});
    });

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

    function deletes(){
    	var cnt = nomor;
    	for (i = 0; i <= cnt; i++) {
    		$('#baris_'+i).remove();
    	}
    }

    function savetrx()
    {
    	if(nomor == 0){
    		$('#ResponseInput').html("<div id='alert' class='alert alert-danger alert-dismissible pesan-status'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><h4><i class='icon fa fa-ban')></i> Item transaksi harus terisi.</h4></div>");
    		$(".pesan-status").fadeTo(4000, 0).slideUp(500, function(){
    	        $(this).remove();
    	    });
        }
    	else if(kembalian >= 0)
    	{
    		$('[name=UangTotal]').prop('disabled',false);

    		$.ajax({
    	        url : "<?php echo site_url('Kasir/SimpanTransaksi')?>",
    	        type: "POST",
    	        data:$('#formMain').serialize(),
    	        dataType: "JSON",
    	        success: function(data)
    	        {
    	        	if(data.status)
    	        	{
    	        		$('[name=UangTotal]').prop('disabled',"disabled");
    	        		$('[name=UangCash]').prop('disabled',"disabled");
    	        		$('[name=no_registrasi]').prop('disabled',"disabled");
    	        		$('#ResponseInput').html("<div id='alert' class='alert alert-success alert-dismissible pesan-status'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><h4><i class='icon fa fa-check')></i> Transaksi Berhasil.</h4></div>");
    	        		$(".pesan-status").fadeTo(4000, 0).slideUp(500, function(){
    	        	        $(this).remove();
    	        	    });

    	        		$('#btnPrint').show();
    	        		$('#btnSimpan').hide();
    	        		$('#btnNew').show();
    	        		$("#btnPrint").attr("href", "<?php echo base_url('Kasir/CetakTransaksi')?>"+"/"+data.no_kuitansi);
    	        	}
    	        }
    		});
    	}else{
    		$('#ResponseInput').html("<div id='alert' class='alert alert-danger alert-dismissible pesan-status'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><h4><i class='icon fa fa-ban')></i> Jumlah bayar tidak boleh kurang dari total bayar.</h4></div>");
    		$(".pesan-status").fadeTo(4000, 0).slideUp(500, function(){
    	        $(this).remove();
    	    });
        }
    }
	</script>

</html>
