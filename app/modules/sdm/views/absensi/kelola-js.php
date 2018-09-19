<script type="text/javascript">
function tampil_data()
{

}
function tampil()
{
	var idPer = $('#idPer').val();
	var nip = $('#pegawai').val();
	$.ajax({
		type  : "POST",
		url   : "<?php echo sdm()?>absensi/kelola/tampil",
		dataType : "json",
		data : {per:idPer, nip:nip},
		beforeSend: function(){
			showSpinningProgressLoading();
			$("#tampilAbsensi").html("");
		},
		success: function(response){
			hideSpinningProgressLoading();
			if (response[0].code==200) {
				$("#loading").html("");
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
}

function modal_edit(id)
{
	$.ajax({
    url: "<?php echo sdm().'absensi/kelola/tampil_edit/'; ?>"+id,
    beforeSend: function(){
      $("#loading-edit").html(loader_green);
    },
    success: function(response){
      $("#loading-edit").html("");
      if (response[0].code==200) {
      	$('#idabsensi').val(response[0].id);
      	$('#id_periode').val(response[0].periode);
      	$('#nip').val(response[0].nip);
      	$('#nama_karyawan').val(response[0].nama);
      	$('#tgl_absensi').val(response[0].tanggal);
      	$('#hari_absensi').val(response[0].hari);
      	$('#datang').val(response[0].datang);
      	$('#pulang').val(response[0].pulang);
      	$('#ket_absensi').val(response[0].keterangan);
      } else{
        $("#loading-edit").html(alert_red(response[0].message));
      }
    }
  });
}


</script>
