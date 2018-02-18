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
    <?php //$this->load->view('template/v_header'); ?>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/invoice-pos.css');?>">
    </head>
    <body>
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
							'01' => 'Januari',
							'02' => 'Februari',
							'03' => 'Maret',
							'04' => 'April',
							'05' => 'Mei',
							'06' => 'Juni',
							'07' => 'Juli',
							'08' => 'Agustus',
							'09' => 'September',
							'10' => 'Oktober',
							'11' => 'November',
							'12' => 'Desember',
							);
						?>
			<div id="invoice-POS">
				<center id="top">
					<div class="logo"></div>
					<div class="info"> 
						<p style="margin-bottom:0px;">JASA PRIMA MEDICAL CENTRE</p>
						<small>Jl. Pilang Raya No.147 Cirebon</small>
					</div><!--End Info-->
				</center><!--End InvoiceTop-->
				<div id="mid">
					<div class="info">
						<p class="itemtext"> 
								<b>Kasir</b> : <?= $this->session->userdata['simklinik']['ap_name'];?></br>
                <b>No. Struk</b>: <?= $detail_pemasukan->no_kuitansi;?></br>
                <b>Nama Paisen</b>: <?= $pasien->nama_pasien;?></br>
                <b>Waktu Daftar</b>:  <?php
                  $tgl = date('d-M-Y',strtotime($pasien->tgl_registrasi));
                  echo $tgl.' '.$pasien->jam_registrasi;
                  ?>
						</p>
					</div>
				</div><!--End Invoice Mid-->
				<div id="bot">
							<div id="table">
								<table>
									<tr class="tabletitle">
										<td class="item"><h2>Item</h2></td>
										<td class="Hours"><h2>Qty</h2></td>
										<td class="Rate"><h2>Sub Total</h2></td>
									</tr>
                  <?php foreach($detail_berobat as $key => $row):?>
                  <?php
                          $harga = $this->M_base->currformat2($row->harga);
                          $harga = substr($harga,0,-3);
                          $total = $this->M_base->currformat2($row->total_harga);
                          $total = substr($total,0,-3);
                        ?>
									<tr class="service">
										<td class="tableitem">
											<p class="itemtext"><?= $row->nama_item;?></p>
										</td>
										<td class="tableitem">
										<p class="itemtext"><?= intval($row->qty);?></p>
										</td>
										<td class="tableitem">
										<p class="itemtext"><?= $total;?></p>
										</td>
									</tr>
									<?php endforeach;?>
								</table>
								<table>
								<tr class="tabletitle">
										<!-- <td></td> -->
										<td class="Rate" style="text-align:right;" colspan='2'><h2>Total</h2></td>
										<td class="payment" style="text-align:center;"><h2>Rp. <?=	substr($this->M_base->currFormat2($detail_pemasukan->total_pemasukan), 0, -3);?></h2></td>
									</tr>
									<tr class="tabletitle">
										<!-- <td></td> -->
										<td class="Rate" style="text-align:right;" colspan='2'><h2>Tunai</h2></td>
										<td class="payment" style="text-align:center;"><h2>Rp. <?=	substr($this->M_base->currFormat2($detail_pemasukan->uang_bayar), 0, -3);?></h2></td>
									</tr>
									<tr class="tabletitle">
										<!-- <td></td> -->
										<td class="Rate" style="text-align:right;" colspan='2'><h2>Kembalian</h2></td>
										<td class="payment" style="text-align:center;"><h2>Rp. <?=	substr($this->M_base->currFormat2($detail_pemasukan->uang_kembalian), 0, -3);?></h2></td>
									</tr>
								</table>
							</div><!--End Table-->

							<div id="legalcopy">
								<p class="legal" style="text-align:center;">
									<strong>=======Terimakasih=======<br>====Semoga Lekas Sembuh====</strong><br>
									<small><?= date('d').' '.$bulan[date('m')].' '.date('Y').'  '.date('H:i:s');?></small>
								</p>
							</div>

						</div><!--End InvoiceBot-->
			</div><!--End Invoice-->

			<!-- ./wrapper -->
    </body>
		<script type="text/javascript">
window.print();
window.onfocus=function(){ window.close();}
</script>
</html>
