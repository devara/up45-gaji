<script type="text/javascript">

$('#btn_tampil').click(function(e){
  var nip = $('#nip').val();
  var idPer = $('#idPer').val();
  $.ajax({
    type  : "POST",
    url   : "<?php echo karyawan()?>master/absensi/tampil",
    dataType : "json",
    data : {nip:nip, per:idPer},
    beforeSend: function(){
      showSpinningProgressLoading();
      $("#tampilAbsensi").html("");
    },
    success: function(response){
    	hideSpinningProgressLoading();
      if (response[0].code==200) {
      	$("#loading").html("");
        $("#tampilAbsensi").html(response[0].tabel);
        
      }
      else{
        $("#loading").html(alert_red(response[0].message));
      }
    }
  });
  e.preventDefault();
});

function modal_req(id)
{
	$.ajax({
    url: "<?php echo karyawan().'master/absensi/pengajuan/'; ?>"+id,
    beforeSend: function(){
      $("#loading-edit").html(loader_green);
    },
    success: function(response){
      $("#loading-edit").html("");
      if (response[0].code==200) {
      	$('#idabsensi').val(response[0].id);
      	$('#id_periode').val(response[0].periode);
      	$('#nip').val(response[0].nip);
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
