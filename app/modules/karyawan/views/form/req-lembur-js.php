<script type="text/javascript">
$('#btn_tampil').click(function(e){
	var idPer = $('#cekPer').val();
	var nip = $('#nipPegawai').val();
	$.ajax({
		type  : "POST",
		url   : "<?php echo karyawan()?>form/req_lembur/status",
		dataType : "json",
		data : {per:idPer, nip:nip},
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

function getTanggal(){
	var per = $('#idPeriode').val();
	$.ajax({
		url: "<?php echo ajaxpublic_url().'cekper/'; ?>"+per,
		beforeSend: function(){
			$("#tanggal").disabled = true;
		},
		success: function(response){      
			if (response[0].code!=404) {
				document.getElementById("tanggal").disabled = false;
				document.getElementById("tanggal").min = response[0].min;
				document.getElementById("tanggal").max = response[0].max;
			} else{
				$("#tanggal").disabled = true;
			}
		}
	});
}

$('#begin').datetimepicker({
	format: 'HH:mm:ss'
});
$('#end').datetimepicker({
	format: 'HH:mm:ss'
});
</script>
