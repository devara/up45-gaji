<script type="text/javascript">
function cekData(){
	var periode = $('#idPer').val();
	var jabatan = $('#kd_jabatan').val();
	var $btnsmt = $('#btnsimpan');
	$.ajax({
		type  : "POST",
		url   : "<?php echo karyawan()?>kabag/penilaian_kerja/cek",
		dataType : "json",
		data : {per:periode, jab:jabatan},
		beforeSend: function(){
			showSpinningProgressLoading();
		},
		success: function(response){
			hideSpinningProgressLoading();
			if (response[0].code==500) {
				$("#cekloading").html(alert_red(response[0].status));
				$btnsmt.removeClass('btn-success').addClass('btn-danger');
				document.getElementById('btnsimpan').disabled = true;
			}
			else if (response[0].code==200) {
				$("#cekloading").html("");
				$btnsmt.removeClass('btn-danger').addClass('btn-success');
				document.getElementById('btnsimpan').disabled = false;
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
			showSpinningProgressLoading();
			$("#tabel_penilaian").html("");
		},
		success: function(response){
			hideSpinningProgressLoading();
			if (response[0].code==200) {
				$("#tabel_penilaian").html(response[0].tabel);
				$("#loading").html("");
			}
			else{
				$("#loading").html(alert_red(response[0].message));
			}
		}
	});
	e.preventDefault();
});
</script>
