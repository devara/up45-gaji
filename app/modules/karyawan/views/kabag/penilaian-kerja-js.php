<script type="text/javascript">
function cekData(){
	var periode = $('#idPer').val();
	var jabatan = $('#kd_jabatan').val();
	var $btnsmt = $('#btnSubmit');
	$.ajax({
		type  : "POST",
		url   : "<?php echo karyawan()?>kabag/penilaian_kerja/cek",
		dataType : "json",
		data : {per:periode, jab:jabatan},
		beforeSend: function(){
			$("#cekloading").html(loader_green);
		},
		success: function(response){
			$("#cekloading").html("");
			if (response[0].code==500) {
				$("#cekloading").html(alert_red(response[0].status));
				$btnsmt.removeClass('btn-success').addClass('btn-danger');
				document.getElementById('btnSubmit').disabled = true;
			}
			else if (response[0].code==200) {
				$btnsmt.removeClass('btn-danger').addClass('btn-success');
				document.getElementById('btnSubmit').disabled = false;
			}
			else{
				$("#cekloading").html(alert_red(response[0].message));
			}
		}
	});
}

$('#btnSubmit').click(function(e){
	var periode = $('#idPer').val();
	var jabatan = $('#kd_jabatan').val();
	$.ajax({
		type  : "POST",
		url   : "<?php echo karyawan()?>kabag/data_penilaian_kerja/lihat_penilaian",
		dataType : "json",
		data : {per:periode, jab:jabatan},
		beforeSend: function(){
			$("#loading").html(loader_green);
			$("#tabel_penilaian").html("");
		},
		success: function(response){
			$("#loading").html("");
			if (response[0].code==200) {
				$("#tabel_penilaian").html(response[0].tabel);
			}
			else{
				$("#loading").html(alert_red(response[0].message));
			}
		}
	});
	e.preventDefault();
});
</script>
