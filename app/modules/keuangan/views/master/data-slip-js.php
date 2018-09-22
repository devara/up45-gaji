<script type="text/javascript">
$('#btn_tampil').click(function(e){
	var idPer = $('#periode').val();
	var unit = $('#unit').val();
	$.ajax({
		type  : "POST",
		url   : "<?php echo keuangan()?>master/data_slip/tampil_data",
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
function tampil_detail(id){
	var id_slip = id;
	$.ajax({
    type  : "POST",
		url   : "<?php echo keuangan()?>master/data_slip/tampil_detail",
		dataType : "json",
		data : {id_slip:id_slip},
    beforeSend: function(){
      $("#loading-detail").html(loader_green);
    },
    success: function(response){
      $("#loading-detail").html("");
      if (response[0].code!=404) {
      	$("#detail_slip").html(response[0].detail);
      } else{
        $("#loading-detail").html(alert_red(response[0].message));
      }
    }
  });
}
function tampil_kirim(id){
	var id_slip = id;
	$.ajax({
    type  : "POST",
		url   : "<?php echo keuangan()?>master/data_slip/tampil_kirim",
		dataType : "json",
		data : {id_slip:id_slip},
    beforeSend: function(){
      $("#loading-kirim").html(loader_green);
    },
    success: function(response){
      $("#loading-kirim").html("");
      if (response[0].code!=404) {
      	$("#slipid").val(response[0].id);
      	$("#nama").val(response[0].nama);
      	$("#email").val(response[0].email);
      } else{
        $("#loading-kirim").html(alert_red(response[0].message));
      }
    }
  });
}
</script>
