<?php

defined('BASEPATH') OR exit('No direct script access allowed');

?>

<!DOCTYPE html>
<html>
	<head>
		<?php $this->load->view('template/v_header'); ?>
    </head>
    <body class="fixed hold-transition skin-blue-light">
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
							  <h3 class="box-title">Input Data Menu</h3>
							</div>
							<form class="form-horizontal" method="post" action="<?php echo base_url().(isset($id_menu) ? 'Menu/update' : 'Menu/insert'); ?>">
							  <?php
								if(isset($id_menu))
								{
									echo "<input type='hidden' name='id' value='".$id_menu."'>";
								}
							  ?>
								<div  class="box-body">
								<div class="form-group">
								  <label for="inputEmail3" class="col-sm-2 control-label">Title</label>

								  <div class="col-sm-4">
									<input type="text" name="menu_title" class="form-control" value="<?php echo (isset($menu_title) ? $menu_title : ''); ?>" placeholder="Masukan Nama Menu..." required="required">
								  </div>
								</div>

								<div class="form-group">
								  <label for="inputEmail3" class="col-sm-2 control-label">Icon</label>

								  <div class="col-sm-3">
									<div class="input-group">
										<input data-placement="bottomRight" name="icon" class="form-control icp icp-auto" value="<?php echo (isset($icon) ? $icon : 'fa-archive'); ?>" type="text" required="required" />
										<span class="input-group-addon"></span>
									</div>
								  </div>
								</div>

								<div class="form-group">
									<label for="inputEmail3" class="col-sm-2 control-label">Urutan</label>
									<div class="col-sm-3">
										<div class="input-group">
											<input type="text" name="urutan" id="urutan" class="form-control" value="<?php echo (isset($urutan) ? $urutan : ''); ?>"
												placeholder="Masukan Urutan Menu..." onkeypress='return isNumberKey(event);' required="required">
										</div>
									</div>
								</div>

							  <div class="box-footer">
								<div  class="form-group">
							  		<label for="inputEmail3" class="col-sm-2 control-label"></label>
							  		<div  class="col-sm-10">
							  			<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
										<a href="<?php echo base_url(); ?>Menu" class="btn btn-warning"><i class="fa fa-close"></i> Batal</a>
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
    $(document).ready(function() {
    	$('#mnPengaturan').addClass('active');
    	$('#mnMenu').addClass('active');

    	$('#alert').delay(10000).fadeOut("slow");
    });

	function isNumberKey(evt)
	{
	   var charCode = (evt.which) ? evt.which : event.keyCode
	   if (charCode > 31 && (charCode < 48 || charCode > 57))
	      return false;
	   return true;
	}
	</script>

	<script>
	  $(function() {
	    $('.action-destroy').on('click', function() {
	      $.iconpicker.batch('.icp.iconpicker-element', 'destroy');
	    });
	    // Live binding of buttons
	    $(document).on('click', '.action-placement', function(e) {
	      $('.action-placement').removeClass('active');
	      $(this).addClass('active');
	      $('.icp-opts').data('iconpicker').updatePlacement($(this).text());
	      e.preventDefault();
	      return false;
	    });
	    $(document).ready(function() {
	      $('.icp-auto').iconpicker();

	      $('.icp-dd').iconpicker({
	        //title: 'Dropdown with picker',
	        //component:'.btn > i'
	      });

	      $('.icp-glyphs').iconpicker({
	        title: 'Prepending glypghicons',
	        icons: $.merge(['glyphicon-home', 'glyphicon-repeat', 'glyphicon-search',
	          'glyphicon-arrow-left', 'glyphicon-arrow-right', 'glyphicon-star'], $.iconpicker.defaultOptions.icons),
	        fullClassFormatter: function(val){
	          if(val.match(/^fa-/)){
	            return 'fa '+val;
	          }else{
	            return 'glyphicon '+val;
	          }
	        }
	      });
	      $('.icp-opts').iconpicker({
	        title: 'With custom options',
	        icons: ['fa-github', 'fa-heart', 'fa-html5', 'fa-css3'],
	        selectedCustomClass: 'label label-success',
	        mustAccept: true,
	        placement: 'bottomRight',
	        showFooter: true,
	        // note that this is ignored cause we have an accept button:
	        hideOnSelect: true,
	        templates: {
	          footer: '<div class="popover-footer">' +
	              '<div style="text-align:left; font-size:12px;">Placements: \n\
	      <a href="#" class=" action-placement">inline</a>\n\
	      <a href="#" class=" action-placement">topLeftCorner</a>\n\
	      <a href="#" class=" action-placement">topLeft</a>\n\
	      <a href="#" class=" action-placement">top</a>\n\
	      <a href="#" class=" action-placement">topRight</a>\n\
	      <a href="#" class=" action-placement">topRightCorner</a>\n\
	      <a href="#" class=" action-placement">rightTop</a>\n\
	      <a href="#" class=" action-placement">right</a>\n\
	      <a href="#" class=" action-placement">rightBottom</a>\n\
	      <a href="#" class=" action-placement">bottomRightCorner</a>\n\
	      <a href="#" class=" active action-placement">bottomRight</a>\n\
	      <a href="#" class=" action-placement">bottom</a>\n\
	      <a href="#" class=" action-placement">bottomLeft</a>\n\
	      <a href="#" class=" action-placement">bottomLeftCorner</a>\n\
	      <a href="#" class=" action-placement">leftBottom</a>\n\
	      <a href="#" class=" action-placement">left</a>\n\
	      <a href="#" class=" action-placement">leftTop</a>\n\
	      </div><hr></div>'}
	      }).data('iconpicker').show();
	    }).trigger('click');


	    // Events sample:
	    // This event is only triggered when the actual input value is changed
	    // by user interaction
	    $('.icp').on('iconpickerSelected', function(e) {
	      $('.lead .picker-target').get(0).className = 'picker-target fa-3x ' +
	          e.iconpickerInstance.options.iconBaseClass + ' ' +
	          e.iconpickerInstance.options.fullClassFormatter(e.iconpickerValue);
	    });
	  });
	</script>
</html>
