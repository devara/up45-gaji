<script type="text/javascript">

$('#btn_tampil').click(function(e){
  var nip = $('#nip').val();
  var idPer = $('#idPer').val();
  $.ajax({
    type  : "POST",
    url   : "<?php echo karyawan()?>master/rapat/tampil",
    dataType : "json",
    data : {nip:nip, per:idPer},
    beforeSend: function(){
      showSpinningProgressLoading();
      $("#tampilRapat").html("");
    },
    success: function(response){
    	hideSpinningProgressLoading();
      if (response[0].code==200) {
      	$("#loading").html("");
        $("#tampilRapat").html(response[0].tabel);
        
      }
      else{
        $("#loading").html(alert_red(response[0].message));
      }
    }
  });
  e.preventDefault();
});


</script>
