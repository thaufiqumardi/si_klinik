<?php

defined('BASEPATH') OR exit('No direct script access allowed'); 

$menusid = $this->M_crud->get_by_param("menu", 'name', "Beranda");
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
		    <section class="content-header">
		    	<h1>Beranda</h1>
		    </section>
    		<section class="content">
    			<div class="row">
			        <div class="col-lg-3 col-xs-6">
			        	<div class="small-box bg-aqua">
			        		<div class="inner">
			        			<h3><?= $pasien_rj ?></h3>
			        			<p>Pasien Rawat Jalan</p>
			        		</div>
			        		<div class="icon">
				              <i class="fa fa-wheelchair"></i>
				            </div>
				            <a href="javascript:void(0);" class="small-box-footer"><?= $curr_tgl ?></a>
			        	</div>
			        </div>
			        <div class="col-lg-3 col-xs-6">
			        	<div class="small-box bg-green">
			        		<div class="inner">
			        			<h3><?= $pasien_ri ?></h3>
			        			<p>Pasien Rawat Inap</p>
			        		</div>
			        		<div class="icon">
				              <i class="fa fa-bed"></i>
				            </div>
				            <a href="javascript:void(0);" class="small-box-footer"><?= $curr_tgl ?></a>
			        	</div>
			        </div>
			        <div class="col-lg-3 col-xs-6">
			        	<div class="small-box bg-yellow">
			        		<div class="inner">
			        			<h3><?= $pasien_umum ?></h3>
			        			<p>Pasien Umum</p>
			        		</div>
			        		<div class="icon">
				              <i class="fa fa-bed"></i>
				            </div>
				            <a href="javascript:void(0);" class="small-box-footer"><?= $curr_tgl ?></a>
			        	</div>
			        </div>
			        <div class="col-lg-3 col-xs-6">
			        	<div class="small-box bg-red">
			        		<div class="inner">
			        			<h3><?= $pasien_bpjs ?></h3>
			        			<p>Pasien BPJS</p>
			        		</div>
			        		<div class="icon">
				              <i class="fa fa-bed"></i>
				            </div>
				            <a href="javascript:void(0);" class="small-box-footer"><?= $curr_tgl ?></a>
			        	</div>
			        </div>
				</div>
    			<div class="row">
    				<div class="col-md-8">
    					<div class="box box-info">
    						<div class="box-header with-border">
    							<h3 class="box-title">Pasien Terdaftar Hari Ini</h3>
    						</div>
    						<div class="box-body">
    							<div class="table-responsive">
    								<table class="table no-margin">
    									<thead>
						                	<tr>
						                    	<th>Nomor Pendaftaran</th>
						                    	<th>Nomor Antrian</th>
						                    	<th>Nomor Rekam Medik</th>
						                    	<th>Nama Pasien</th>
						                  	</tr>
						                </thead>
						                <tbody>
						                	<?php
						                		foreach($reg_pasien as $row){
						                	?>
						                	<tr>
						                		<td><?= $row->no_registrasi ?></td>
						                		<td><?= $row->no_antrian ?></td>
						                		<td><?= $row->no_rm ?></td>
						                		<td><?= $row->nama_pasien ?></td>
						                	</tr>
						                	<?php
						                		}
						                	?>
						                </tbody>
    								</table>
    							</div>
    						</div>
    						<div class="box-footer text-center">
				              <a href="<?php echo base_url('pendaftaran_pasien'); ?>" class="uppercase">Lihat Semua Pendaftaran Pasien</a>
				            </div>
    					</div>
    				</div>
    				<div class="col-md-4">
    					<div class="box box-primary">
    						<div class="box-header with-border">
    							<h3 class="box-title">Kelahiran Bayi</h3>
    						</div>
    						<div class="box-body">
    							<ul class="products-list product-list-in-box">
    								<li class="item">
    									<div class="product-info">
                    						<a href="javascript:void(0)" class="product-title">7 Desember 2017 10:20 WIB</a>
                    							<span class="product-description">
                          							Bayi A (Laki-Laki)
                        						</span>
                  						</div>
    								</li>
    								<li class="item">
    									<div class="product-info">
                    						<a href="javascript:void(0)" class="product-title">7 Desember 2017 08:25 WIB</a>
                    							<span class="product-description">
                          							Bayi B (Perempuan)
                        						</span>
                  						</div>
    								</li>
    								<li class="item">
    									<div class="product-info">
                    						<a href="javascript:void(0)" class="product-title">7 Desember 2017 10:20 WIB</a>
                    							<span class="product-description">
                          							Bayi A (Laki-Laki)
                        						</span>
                  						</div>
    								</li>
    								<li class="item">
    									<div class="product-info">
                    						<a href="javascript:void(0)" class="product-title">7 Desember 2017 08:25 WIB</a>
                    							<span class="product-description">
                          							Bayi B (Perempuan)
                        						</span>
                  						</div>
    								</li>
    								<li class="item">
    									<div class="product-info">
                    						<a href="javascript:void(0)" class="product-title">7 Desember 2017 10:20 WIB</a>
                    							<span class="product-description">
                          							Bayi A (Laki-Laki)
                        						</span>
                  						</div>
    								</li>
    							</ul>
    						</div>
    						<div class="box-footer text-center">
				              <a href="javascript:void(0)" class="uppercase">Lihat Semua Kelahiran</a>
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
    $(document).ready(function() {
    	$('#mnBeranda').addClass('active');
    });
	</script>
</html>
