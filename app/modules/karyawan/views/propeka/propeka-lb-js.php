<script type="text/javascript">
$('#tampilLH').click(function(e){
	var idPer = $('#cekPer').val();
	var nip = $('#nipPegawai').val();
	$.ajax({
		type  : "POST",
		url   : "<?php echo karyawan()?>propeka/laporan/tampil",
		dataType : "json",
		data : {per:idPer, nip:nip},
		beforeSend: function(){
			$("#loading").html(loader_green);
			$("#tabelLH").html("");
		},
		success: function(response){
			$("#loading").html("");
			if (response[0].code==200) {
				$("#tabelLH").html(response[0].tabel);
			}
			else{
				$("#loading").html(alert_red(response[0].message));
			}
		}
	});
	e.preventDefault();
});

function getChecklist(){
	var nip = $('#nip').val();
	var per = $('#periode').val();
	$.ajax({
		url: "<?php echo karyawan().'propeka/laporan/get_checklist_by_periode/'; ?>"+per,
		beforeSend: function(){
			$("#tampilDetail").html(loader_green);
		},
		success: function(response){
			$("#tampilDetail").html("");
			if (response[0].code!=404) {
				$("#tampilDetail").html(response[0].form);
			} else{
				
			}
		}
	});
}
</script>
