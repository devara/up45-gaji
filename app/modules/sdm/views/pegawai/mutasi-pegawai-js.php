<script type="text/javascript">
function cek(){
	var nip = $('#pegawai').val();
	$.ajax({
		type: "POST",
		url: "<?php echo sdm();?>mutasi_pegawai/cek/",
		dataType:"json",
		data : {nip:nip},
		beforeSend: function(){
      $("#loading").html(loader_green);
    },
    success: function(response){
      $("#loading").html("");
      if (response[0].code!=404) {
        $('#posisi').val(response[0].unit);
        $('#jabatan').val(response[0].jab);
      } else{
        $("#loading").html(alert_red(response[0].message));
      }
    }
	});
}
</script>
