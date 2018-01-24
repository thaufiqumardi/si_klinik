<script type="text/javascript">
	$(document).ready(function(){
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
			console.log(stat);
			if(stat=="Menikah"){
			        x.style.display = "block";
			}
			else{
				x.style.display = "none";
			}
		});
		$('.jk').change(function(data){
			var jenis= data.target.value;
			console.log(jenis);
			if(jenis == 'Laki-Laki'){
				$('.suamiIstri').text("Istri");
			}
			else{
				$('.suamiIstri').text("Suami");
			}
		});
	});
</script>