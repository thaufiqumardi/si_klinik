
</section>
</div>
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy; 2017 <a href="<?php echo base_url(); ?>">Melati Bunda</a>.</strong> All rights reserved.
  </footer>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<!-- jQuery UI 1.11.4 -->
<!-- <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script> -->
<!-- JQuery UI -->
<script src="<?php echo base_url(); ?>assets/JUI/jquery-ui.min.js" type="text/javascript"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js');?>"></script>
<!-- datepicker -->
<script src="<?php echo base_url('assets/plugins/datepicker/js/bootstrap-datepicker.js');?>"></script>
<!-- bootstrap time picker -->
<script src="<?php echo base_url('assets/plugins/timepicker/bootstrap-timepicker.min.js');?>"></script>
<!-- InputMask-->
<script src="<?php echo base_url('assets/plugins/input-mask/jquery.inputmask.js');?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/dist/js/app.min.js');?>"></script>
<!-- Slimscroll -->
<script src="<?php echo base_url('assets/plugins/slimScroll/jquery.slimscroll.min.js');?>"></script>
<!-- Select2 -->
<script src="<?php echo base_url('assets/plugins/select2/select2.full.min.js');?>"></script>
<!-- DataTables -->
<script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js');?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js');?>"></script>
<!-- PACE -->
<script src="<?php echo base_url('assets/plugins/pace/pace.min.js');?>"></script>

<!-- TEMMY ADDED -->
<script src="<?php echo base_url(); ?>assets/plugins/icon/fontawesome-iconpicker.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/mask/datable.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/mask/jquery.masknumber.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/icon/bootstrap-select.js"></script>
<script src="<?php echo base_url('assets/plugins/datepicker/js/bootstrap-datepicker.js');?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/plugins/tableExport/tableExport.js');?>"></script>
<script type="text/javascript">
  $(document).ready(function () {

    $('[name=currency-default]').maskNumber();
    $('[name=currency-data-attributes]').maskNumber();
    $('[name=currency-configuration]').maskNumber({decimal: '_', thousands: '*'});
    $('[name=integer-default]').maskNumber({integer: true});
    $('[name=beli]').maskNumber({integer: true});
    $('[name=jual]').maskNumber({integer: true});
    $('[name=tarif_layanan]').maskNumber({integer: true});
    $('[name=tarif]').maskNumber({integer: true});
    $('[name=integer-configuration]').maskNumber({integer: true, thousands: '_'});
  });
</script>
<script type="text/javascript">
$(document).ready(function(){


     $('#radio2').click(function(){
      $('.akun1').show();
      $('.akun2').hide();
     });

     $('#radio3').click(function(){
      $('.akun1').hide();
      $('.akun2').show();
     });

     $('#radio1').click(function(){
      $('.akun1').hide();
      $('.akun2').hide();
     });
});

</script>

<script>

$(document).ready(function(){

  if($('#akun_head').val() == 1){
    $('.akun1').hide();
      $('.akun2').hide();
  }

  if($('#akun_head').val() == 2){
    $('.akun1').show();
      $('.akun2').hide();
  }

  if($('#akun_head').val() == 3){
    $('.akun1').hide();
      $('.akun2').show();
  }

});


</script>

<script>
  $('input[data-datable]').datable();
</script>

<!-- JANGAN DIHAPUS -->
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": false,
      "info": false,
      "autoWidth": true
    });
  });
</script>
<!-- JANGAN DIHAPUS -->

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
<script>
$(document).ready(function(){
      dialog = $( "#obat-dialog" ).dialog({
      autoOpen: false,
      height: 400,
      width: 600,
      modal: false,
      buttons: {
      Close: function() {
        dialog.dialog( "close" );
      }
      },
      close: function() {
      // allFields.removeClass( "ui-state-error" );
      }
    });

  // $("#obat-dialog").dialog({
    // width: 600,
    // autoOpen : false,
    // modal: false,
    // buttons: {
      // Close: function() {
        // ("#obat-dialog").dialog( "close" );
      // }
    // },
    // close: function() {
      // allFields.removeClass( "ui-state-error" );
    // }
  // });

  $("#cari_obat").click(function(){
    dialog.dialog('open');
    $('#search').focus();
    return false;
  });

  function AmbilDaftarObat(){
    $.ajax({
      type  : 'POST',
      url   : "<?php echo site_url().'Kasir/get_obat'; ?>",
      // data : "cari="+cari,
      cache : false,
      success : function(data){
        $("#daftarObat").html(data);
      }
    });
  }

});
</script>

<script>

$(document).ready(function(){
  $("#loader").hide();

  $("#search").keyup(function(){
    var txt = $(this).val();
    if( this.value.length < 3 ) return;

    if(txt != '')
    {
      $.ajax({
        url:"<?php echo base_url().'Kasir/getResultDrugs'; ?>",
        method: "POST",
        data: {search:txt},
        beforeSend: function()
        {
          $("#loader").show()
        },
        success: function(data)
        {
          $("#hasil").html(data);
          $("#loader").hide();
        }
      });
    }
    else
    {
      $("#hasil").html('');
    }
  });

});

</script>

<!-- ThaufiqUmardi's Script -->
<script type="text/javascript">
  $(document).ready(function(){
    $("[data-mask]").inputmask();
    $('.selectOption').select2();
    $('.DataTable').DataTable({});
    $('.datepicker').datepicker({
           format:'dd/mm/yyyy',
           todayHighlight:true,
           containter:true,
        });
    $("#btnExportExcell").click(function(e) {
      e.preventDefault();

      $('#opsi').remove();
      $('.opsiTd').remove();
      //getting data from our table
      var data_type = 'data:application/vnd.ms-excel';
      var table_div = document.getElementById('tablePasien');
      var table_html = table_div.outerHTML.replace(/ /g, '%20');

      var a = document.createElement('a');
      a.href = data_type + ', ' + table_html;
      var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!

    var yyyy = today.getFullYear();
    if(dd<10){
        dd='0'+dd;
    }
    if(mm<10){
        mm='0'+mm;
    }
    var today = dd+'/'+mm+'/'+yyyy;
      a.download = 'Data Pasien' + dd +'-'+ mm +'-'+yyyy+ '.xls';
      a.click();
      location.reload();
    });
    $('#tgl_lahir').change(function(data){
      var tgl_lahir=$(this).val().split('/');
      var today = new Date();
      var year = today.getFullYear();
      var umur = year - tgl_lahir[2];
      $('#umur').val(umur);
    });
    $('.status').change(function(data){
      var stat= data.target.value;
      var x = document.getElementById('pernikahan');
      // console.log(stat);
      if(stat=="Menikah"){
              x.style.display = "block";
      }
      else{
        x.style.display = "none";
      }
    });
    var jk=$('.jk').val();
    // console.log(jk);
    if(jk == 'Laki-Laki'){
        $('.suamiIstri').text("Istri");
      }
      else{
        $('.suamiIstri').text("Suami");
      }
    $('.jk').change(function(data){
      var jenis= data.target.value;
      // console.log(jenis);
      if(jenis == 'Laki-Laki'){
        $('.suamiIstri').text("Istri");
      }
      else{
        $('.suamiIstri').text("Suami");
      }
    });
    $('#id_pasien').change(function(data){
      var id = data.target.value;
      var url = "<?php echo site_url('pasien/getPasienById');?>";
      $.get(url + '/' + id, function(data) {
        $('#nama').val(data.nama_pasien);
        // $('#nama').attr('readonly',true);
        $('#alamat').val(data.alamat);
        $('#no_rm').val(data.no_rekam_medik);
      }, "JSON");
    });
    $('#jenis_rawat').change(function(data){
      var jenis=data.target.value;
      if(jenis=="RAWAT JALAN"){
        $('#ruangan').attr('disabled',true);
        $('#bed').attr('disabled',true);
      }
      else{
        $('#ruangan').attr('disabled',false);
        $('#bed').attr('disabled',false);
      }
    });
    $('#ruangan').change(function(data){
      var id_kamar = data.target.value;
      // console.log(id_kamar);
      var url="<?php echo site_url('pasien/getEmptyBedByIdKamar');?>";
      $.get(url+'/'+id_kamar,function(data){
        if(data.length==0){
          $('#bed').append("<option selected disabled class='text-danger'>Tidak Ada Bed yang Kosong</option>");
        }
        else{
          $.each(data,function(i,data){

            $('#bed').append("<option value='"+data.nomor_bed+"'>"+data.nomor_bed+"</option>");
          // console.log(data.nomor_bed);
        });
        }
      },"JSON")
    });
    $('#alert').delay(10000).fadeOut("slow");
  });
</script>
<!-- End of ThaufiqUmardi's Script -->
</body>
</html>
