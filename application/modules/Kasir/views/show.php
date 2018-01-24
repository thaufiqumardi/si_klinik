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
    			<div class="box box-widget">
					<div class="box-header with-border">
					  <h3 class="box-title">Kasir</h3>
					</div>					
					<div class="box-body">
						<div class='row'>
							<form action="#" id="formMain">
								<div class='col-sm-3'>
									<div class="panel panel-primary">
										<div class="panel-heading">
											<i class='fa fa-file-text-o fa-fw'></i> Informasi Pasien
										</div>
										<div class="panel-body">
											<div class="form-horizontal">
												<input type="hidden" name="id_reg"/>
												<div class="form-group informasi-kasir-noreg">
													<label class="col-sm-4 informasi-kasir-noreg control-label">No. Reg/Antrian</label>
													<div class="col-sm-8">
														<select name="no_registrasi" id="no_registrasi" class="form-control selectOption">
							                       		<option disabled selected value = ''>- Pilih -</option>
							                               <?php
													            foreach($arr_no_registrasi as $row)
													            {
													              	echo '<option value="'.$row->no_registrasi.'">'.$row->no_registrasi.' / '.$row->no_antrian.'</option>';
													            }
							            					?>
								                        </select>
													</div>
												</div>
												<div class="form-group informasi-kasir">
													<label class="col-sm-4 informasi-kasir control-label">Tgl. Registrasi</label>
													<div class="col-sm-8">
														<input type='text' name='tgl_registrasi' class='form-control input-sm informasi-kasir' id='tgl_registrasi' disabled="disabled">
													</div>
												</div>
												<div class="form-group informasi-kasir">
													<label class="col-sm-4 informasi-kasir control-label">No. RM</label>
													<div class="col-sm-8">
														<input type='text' name='no_rm' class='form-control input-sm informasi-kasir' id='no_rm' disabled="disabled">
													</div>
												</div>
												<div class="form-group informasi-kasir">
													<label class="col-sm-4 informasi-kasir control-label">Nama</label>
													<div class="col-sm-8">
														<input type='text' name='nama_pasien' class='form-control input-sm informasi-kasir' id='nama_pasien' disabled="disabled">
													</div>
												</div>
												<div class="form-group informasi-kasir">
													<label class="col-sm-4 informasi-kasir control-label">JK</label>
													<div class="col-sm-8">
														<input type='text' name='jk_pasien' class='form-control input-sm informasi-kasir' id='jk_pasien' disabled="disabled">
													</div>
												</div>
												<div class="form-group informasi-kasir">
													<label class="col-sm-4 informasi-kasir control-label">Alamat</label>
													<div class="col-sm-8">
														<input type='text' name='alamat_pasien' class='form-control input-sm informasi-kasir' id='alamat_pasien' disabled="disabled">
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>								
								<div class='col-sm-9'>
									<h5 class='judul-transaksi'>
										Transaksi							
									</h5>	
									<div id="ResponseInput"></div>	
									<!-- <div class="form-vertical">
										<div class="col-lg-3" style="padding-left: 0;">
											<button type="button" class="btn btn-primary" onclick="addObat()" id="btnTambahObat" style="margin-top: -6px;"><i class="fa fa-plus"></i> Tambah Obat (F8)</button>
										</div>									
										<div class="col-lg-3" style="padding-left: 0; margin-left: -40px;">
											<button type="button" class="btn btn-warning" onclick="addLayanan()" id="btnTambahLayanan" style="margin-top: -6px;"><i class="fa fa-plus"></i> Tambah Layanan (F9)</button>
										</div>
										<div class="col-lg-6"></div>
									</div> 
									<br>-->
									<table id="table" class="table table-striped table-bordered table-hover" style="cellspacing:0; width:100%; margin-top: 25px;">
										<thead>
											<tr>
												<th style="text-align: center;">Nama Item</th>
												<th style='width:120px; text-align: center;'>Harga</th>
												<th style='width:100px; text-align: center;'>Satuan</th>
												<th style='width:75px; text-align: center;'>Qty</th>
												<th style='width:120px; text-align: center;'>Sub Total</th>
												<!-- <th style='width:40px; text-align: center;'>Aksi</th> -->
											</tr>
										</thead>
										<tbody id="orderItem"></tbody>
									</table>
									<div class='alert-kasir alert-info-kasir TotalBayar'>
										<h2>Total : <span id='TotalBayar'>Rp. 0</span></h2>
									</div>
									<div class='row'>
										<div class='col-sm-7'></div>
										<div class='col-sm-5'>
											<div class="form-horizontal">
												<div class="form-group-kasir" style="padding-bottom: 5px;">
													<label class="col-sm-6 control-label">Total Bayar</label>
													<div class="col-sm-6">
														<input type='text' id='UangTotal' name='UangTotal' class='form-control' disabled="disabled" style="margin-bottom: 10px;">
													</div>
												</div>
												<div class="form-group-kasir" style="padding-bottom: 5px;">
													<label class="col-sm-6 control-label">Jumlah Bayar</label>
													<div class="col-sm-6">
														<input type='text' name='UangCash' id='UangCash' class='form-control' style="margin-bottom: 10px;">
													</div>
												</div>
												<div class="form-group-kasir" style="padding-bottom: 15px;">
													<label class="col-sm-6 control-label">Kembali</label>
													<div class="col-sm-6">
														<input type='text' id='UangKembali' name='UangKembali' class='form-control' disabled="disabled" style="margin-bottom: 10px;">
													</div>
												</div>	
											</div>
										</div>
									</div>
									<div class='row'>
										<div class='col-sm-5'>
										</div>
										<div class='col-sm-7'>
											<div class='col-sm-4' style='padding-right: 0px;'>
												<a href="<?php echo site_url('Kasir'); ?>" class="btn btn-default btn-block" id="btnNew"><i class='fa fa-refresh'></i> Transaksi Baru</a>
											</div>
											<div class='col-sm-4' style='padding-right: 0px;'>
												<button type='button' class='btn btn-primary btn-block' id='btnSimpan' name='btnSimpan' onclick="savetrx()">
													<i class='fa fa-floppy-o'></i> Simpan
												</button>
											</div>	
											<div class='col-sm-4' style='padding-right: 0px;'>
												<a href="" target="_blank" class="btn btn-warning btn-block" id="btnPrint"><i class='fa fa-print'></i> Cetak</a>
											</div>	
										</div>
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

