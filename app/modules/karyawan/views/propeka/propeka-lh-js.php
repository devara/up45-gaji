<script type="text/javascript">
$('#tampilLH').click(function(e){
  var idPer = $('#cekPer').val();
  var nip = $('#nipPegawai').val();
  $.ajax({
    type  : "POST",
    url   : "<?php echo karyawan()?>propeka/lh/tampil",
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

function tglRKH(){
	var per = $('#periode').val();
	$.ajax({
    url: "<?php echo ajaxpublic_url().'cekper/'; ?>"+per,
    beforeSend: function(){
      $("#tanggal").disabled = true;
    },
    success: function(response){      
      if (response[0].code!=404) {
      	document.getElementById("tanggal").disabled = false;
      	document.getElementById("tanggal").min = response[0].min;
      	document.getElementById("tanggal").max = response[0].max;
      } else{
        $("#tanggal").disabled = true;
      }
    }
  });
}

function getRKH(){
	var tgl = $('#tanggal').val();
	$.ajax({
    url: "<?php echo karyawan().'propeka/lh/getrkh_by_tgl/'; ?>"+tgl,
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
