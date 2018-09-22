<script type="text/javascript">
$('#btn_tampil').click(function(e){
	var idPer = $('#idPer').val();
	var nip = $('#pegawai').val();
	$.ajax({
		type  : "POST",
		url   : "<?php echo karyawan()?>kabag/cblb/tampil",
		dataType : "json",
		data : {per:idPer, nip:nip},
		beforeSend: function(){
			showSpinningProgressLoading();
			$("#tampilData").html("");
		},
		success: function(response){
			hideSpinningProgressLoading();
			if (response[0].code==200) {
				$("#loading").html("");
				$("#tampilData").html(response[0].tabel);
			}
			else{
				$("#loading").html(alert_red(response[0].message));
			}
		}
	});
	e.preventDefault();
});
</script>
