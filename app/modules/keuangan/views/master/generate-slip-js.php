<script type="text/javascript">
$('#btn_tampil').click(function(e){
  var idPer = $('#periode').val();
  var unit = $('#unit').val();
  $.ajax({
    type  : "POST",
    url   : "<?php echo keuangan()?>master/generate_slip/tampil_data",
    dataType : "json",
    data : {per:idPer, unit:unit},
    beforeSend: function(){
      showSpinningProgressLoading();
      $("#tabel_gaji").html("");
    },
    success: function(response){
      hideSpinningProgressLoading();
      if (response[0].code==200) {
      	$("#loading").html("");
        $("#tabel_gaji").html(response[0].tabel);        
      }
      else{
        $("#loading").html(alert_red(response[0].message));
      }
    }
  });
  e.preventDefault();
});
</script>
