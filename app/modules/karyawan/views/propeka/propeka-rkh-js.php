<script type="text/javascript">
$('#tampilRKH').click(function(e){
  var idPer = $('#cekPer').val();
  var nip = $('#nipPegawai').val();
  $.ajax({
    type  : "POST",
    url   : "<?php echo karyawan()?>propeka/rkh/tampil",
    dataType : "json",
    data : {per:idPer, nip:nip},
    beforeSend: function(){
      $("#loading").html(loader_green);
      $("#tabelRKH").html("");
    },
    success: function(response){
      $("#loading").html("");
      if (response[0].code==200) {
        $("#tabelRKH").html(response[0].tabel);
      }
      else{
        $("#loading").html(alert_red(response[0].message));
      }
    }
  });
  e.preventDefault();
});

$('#btnTambah').click(function(e){
	var isi = '';
	isi += '<div class="form-group">';
		isi += '<div class="col-md-offset-1 col-md-6 col-sm-6 col-xs-12">';
		isi += '<input type="text" name="keg[]" class="form-control" placeholder="Nama Kegiatan">';
		isi += '</div>';
		isi += '<div class="col-md-2">';
		isi += '<input type="number" max="21" min="8" name="dari[]" class="form-control" placeholder="Dari jam">';
		isi += '</div>';
		isi += '<div class="col-md-2">';
		isi += '<input type="number" max="21" min="8" name="sampai[]" class="form-control" placeholder="Sampai jam">';
		isi += '</div>';
		isi += '</div>';
	$("#formAdd").append(isi);
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
function cekRKH(){
	var per = $('#periode').val();
	var nip = $('#pegawai').val();
	var tgl = $('#tanggal').val();
	var $btnsmt = $('#btnSubmit');
	$.ajax({
    type  : "POST",
    url   : "<?php echo karyawan()?>propeka/rkh/cek",
    dataType : "json",
    data : {per:per, nip:nip, tgl:tgl},
    beforeSend: function(){
    	$("#cekloading").html(loader_green);
    },
    success: function(response){
    	$("#cekloading").html("");
      if (response[0].code==200) {
      	$("#cekloading").html(alert_red(response[0].status));
        $("#formAdd").hide();
        $btnsmt.removeClass('btn-success').addClass('btn-danger');
        document.getElementById('btnSubmit').disabled = true;
      }
      else if (response[0].code==500) {      	
				$("#formAdd").show();
				$btnsmt.removeClass('btn-danger').addClass('btn-success');
				document.getElementById('btnSubmit').disabled = false;
      }
      else{
        $("#loading").html(alert_red(response[0].message));
      }
    }
  });
}
</script>