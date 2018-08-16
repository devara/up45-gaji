<script type="text/javascript">
$('#btn_tampil').click(function(e){
  var nip = $('#nip').val();
	var idPer = $('#periode').val();
	$.ajax({
		type  : "POST",
		url   : "<?php echo karyawan()?>penggajian/slip/tampil_data",
		dataType : "json",
		data : {nip:nip, per:idPer},
		beforeSend: function(){
			showSpinningProgressLoading();
			$("#loading").html("");
			$("#tabel_gaji").html("");
		},
		success: function(response){
			hideSpinningProgressLoading();
			if (response[0].code==200) {
				$("#loading").html("");
				$("#tabel_gaji").html(response[0].tabel);        
			}
			else if (response[0].code==500) {
				$("#loading").html(alert_orange(response[0].message));
			}
			else{
				$("#loading").html(alert_red(response[0].message));
			}
		}
	});
	e.preventDefault();
});
</script>
