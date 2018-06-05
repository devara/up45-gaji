<script type="text/javascript">
$('#btn_tampil').click(function(e){
	var idPer = $('#idPer').val();
	var nip = $('#pegawai').val();
	$.ajax({
		type  : "POST",
		url   : "<?php echo sdm()?>absensi/kelola/tampil",
		dataType : "json",
		data : {per:idPer, nip:nip},
		beforeSend: function(){
			$("#loading").html(loader_green);
			$("#tampilAbsensi").html("");
		},
		success: function(response){
			$("#loading").html("");
			if (response[0].code==200) {
				$("#tampilAbsensi").html(response[0].tabel);
				$('#tblabsensi').dataTable({
					"pageLength": 25,
					"language": {
						"lengthMenu": "Tampilkan _MENU_ data per halaman",
						"zeroRecords": "Maaf, hasil pencarian tidak ada",
						"info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
						"infoEmpty": "Tidak ada data",
						"infoFiltered": "(Filter dari _MAX_ jumlah data)",
						"search": "Cari ",
						"paginate": {
							"next":       "Selanjutnya",
							"previous":   "Sebelumnya"
						}
					},
				});
			}
			else{
				$("#loading").html(alert_red(response[0].message));
			}
		}
	});
	e.preventDefault();
});
</script>
