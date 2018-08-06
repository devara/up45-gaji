<script type="text/javascript">
function lisPeg(){
	var kdUnit = $('#kdUnit').val();
	$.ajax({
		url: "<?php echo sdm();?>absensi/data/pegawai/"+kdUnit+"",
		dataType:"json",
		beforeSend: function(){
			$("#loadPeg").html(loader_green);
		},
		success: function(data){
			$("#loadPeg").html("");
			if (data[0].code!=404) {
				var html = '';
				var i;
				var jum = data.length;
				html += '<option selected disabled>Pilih</option>';
				for(i=0; i<jum; i++){          
					html += '<option value="'+data[i].nip+'">';
					html += ''+data[i].nama+'';
					html += '</option>';
				}
				$('#pegawai').html(html);
			} else{
				$("#loadPeg").html(alert_red(response[0].message));
			}
		}
	});
}

$('#btn_tampil').click(function(e){
	var idPer = $('#idPer').val();
	var kdUnit = $('#kdUnit').val();
	var nip = $('#pegawai').val();
	$.ajax({
		type  : "POST",
		url   : "<?php echo sdm()?>propeka/rkhlh/tampil",
		dataType : "json",
		data : {per:idPer , unit:kdUnit, nip:nip},
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

function tampil_detail(id){
	$.ajax({
    url: "<?php echo sdm().'propeka/rkhlh/lihat_detail/'; ?>"+id,
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
