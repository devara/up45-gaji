<script type="text/javascript">
$('#btn_tampil').click(function(e){
  var idPer = $('#cekPer').val();
  var unit = $('#cekUnit').val();
  $.ajax({
    type  : "POST",
    url   : "<?php echo sdm()?>tunjangan_bonus/lembur/tampil",
    dataType : "json",
    data : {per:idPer, unit:unit},
    beforeSend: function(){
      $("#loading").html(loader_green);
      $("#tampilLembur").html("");
    },
    success: function(response){
      $("#loading").html("");
      if (response[0].code==200) {
        $("#tampilLembur").html(response[0].tabel);
        $('#tblLembur').dataTable({
          "pageLength": 10,
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

$('#btnSimpan').click(function(e){
	var $form = get_formdata($("#demo-form"));
  $.ajax({
    type  : "POST",
    url   : "<?php echo sdm()?>tunjangan_bonus/lembur/input",
    dataType : "json",
    data : $form,
    beforeSend: function(){
      $("#inputloading").html(loader_green);
    },
    success: function(response){
      $("#inputloading").html("");
      if (response[0].code==200) {
        $("#inputloading").html(alert_green(response[0].message));
        $('#idPeriode').val(0);
			  $('#tanggal').val("");
			  $('#idPegawai').val(0);
			  $('#addmulai').val("");
			  $('#addsampai').val("");
			  $('#addket').val("");
      }
      else{
        $("#inputloading").html(alert_red(response[0].message));
      }
    }
  });
  e.preventDefault();
});

function getTanggal(){
	var per = $('#idPeriode').val();
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

$('#begin').datetimepicker({
  format: 'HH:mm:ss'
});
$('#end').datetimepicker({
  format: 'HH:mm:ss'
});
</script>
