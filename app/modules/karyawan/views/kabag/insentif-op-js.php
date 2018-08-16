<script type="text/javascript">
function cekData(){
	var periode = $('#idPer').val();
	var jabatan = $('#kd_jabatan').val();
	$.ajax({
		type  : "POST",
		url   : "<?php echo karyawan()?>kabag/insentif_op/cek",
		dataType : "json",
		data : {per:periode, jab:jabatan},
		beforeSend: function(){
			$("#form-insentif").html("");
			showSpinningProgressLoading();
		},
		success: function(response){
			hideSpinningProgressLoading();
			if (response[0].code==500) {
				$("#cekloading").html(alert_red(response[0].status));
			}
			else if (response[0].code==200) {
				$("#cekloading").html("");
				$("#form-insentif").html(response[0].form);
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
		url   : "<?php echo karyawan()?>kabag/data_insentif_op/lihat_insentif",
		dataType : "json",
		data : {per:periode, jab:jabatan},
		beforeSend: function(){
			showSpinningProgressLoading();
			$("#tabel_insentif").html("");
		},
		success: function(response){
			hideSpinningProgressLoading();
			if (response[0].code==200) {
				$("#tabel_insentif").html(response[0].tabel);
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
