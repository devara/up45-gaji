<script type="text/javascript">

$('#btn_tampil').click(function(e){
	var idPer = $('#idPer').val();
	var nip = $('#pegawai').val();
	$.ajax({
		type  : "POST",
		url   : "<?php echo karyawan()?>kabag/rkhlh/tampil",
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

function tampil_rkh(id){
	$.ajax({
    url: "<?php echo karyawan().'kabag/rkhlh/lihat_rkh/'; ?>"+id,
    beforeSend: function(){
      $("#loading-rkh").html(loader_green);
    },
    success: function(response){
      $("#loading-rkh").html("");
      if (response[0].code!=404) {
      	$("#detailRKH").html(response[0].detail);
      } else{
        $("#loading-rkh").html(alert_red(response[0].message));
      }
    }
  });
}
function tampil_detail(id){
	$.ajax({
    url: "<?php echo karyawan().'kabag/rkhlh/lihat_detail/'; ?>"+id,
    beforeSend: function(){
      $("#loading-detail").html(loader_green);
    },
    success: function(response){
      $("#loading-detail").html("");
      if (response[0].code!=404) {
      	$("#detailLH").html(response[0].detail);
      } else{
        $("#loading-detail").html(alert_red(response[0].message));
      }
    }
  });
}
</script>
