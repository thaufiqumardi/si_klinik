
<div class="row">
	<div class="col-md-4">
		
		<div class="box box-widget">
			<div class="box-header with-border">
				<h3 class="box-title">Antrian Pasien</h3>
				<div class="pull-right">
					<a href="<?php echo site_url('pasien/tambah');?>" class="btn btn-primary btn-sm">Tambahkan Antrian</a>
					
				</div>
			</div>
			<div class="box-body no-padding">
				<?php 
				if(empty($antrian)){
					?>
						<div class="text-center">
							<h1><i class="fa fa-thumbs-o-up"></i></h1>
							<h2>Antrian Masih Kosong</h2>
						</div>
					<?php
				}
				?>
				<table class="table table-hover">
				<?php
					$i=1;
					foreach ($antrian as $pasien)
					{
						?>
					<tr>
					<td><span class="badge bg-yellow"><?php echo $i++;?></span></td>
					<td><?php echo $pasien['nama_pasien'];?> </td>
					<td><a title="Hapus Dari Antrian" class="btn btn-xs btn-danger" href="<?php echo site_url('Pasien/hapus_antrian').'/'.$pasien['id_pasien'];?>"><i class='fa fa-trash'></i></a></td>
				</tr>
					<?php
					}

				?>
                
              </table>
			</div>
			<div class="box-footer">

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
	</div>
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