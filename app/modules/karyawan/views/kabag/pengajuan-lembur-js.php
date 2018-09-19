<script type="text/javascript">
function cek()
{
	var periode = $('#idPer').val();
	var jabatan = $('#kd_jabatan').val();
	$.ajax({
		type  : "POST",
		url   : "<?php echo karyawan()?>kabag/pengajuan_lembur/cek_pengajuan",
		dataType : "json",
		data : {per:periode, jab:jabatan},
		beforeSend: function(){
			showSpinningProgressLoading();
			$("#tabel_pengajuan").html("");
		},
		success: function(response){
			hideSpinningProgressLoading();
			if (response[0].code==200) {
				$("#loading").html("");
				$("#tabel_pengajuan").html(response[0].tabel);        
			}
			else{
				$("#loading").html(alert_red(response[0].message));
			}
		}
	});
}
function modal_acc(id)
{
	$('#lembur_id').val(id);
}
</script>
