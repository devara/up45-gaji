<script type="text/javascript">

$('#btn_tampil').click(function(e){
	var nip = $('#nip').val();
	var idPer = $('#idPer').val();
	$.ajax({
		type  : "POST",
		url   : "<?php echo karyawan()?>master/lembur/tampil",
		dataType : "json",
		data : {nip:nip, per:idPer},
		beforeSend: function(){
			$("#loading").html(loader_green);
			$("#tampilLembur").html("");
		},
		success: function(response){
			$("#loading").html("");
			if (response[0].code==200) {
				$("#tampilLembur").html(response[0].tabel);
				
			}
			else{
				$("#loading").html(alert_red(response[0].message));
			}
		}
	});
	e.preventDefault();
});


</script>