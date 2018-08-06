<script type="text/javascript">
$(document).ready(function() {
  $('#tblrapat').dataTable({
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
});

function get_tanggal(){
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

$('#btn_cek').click(function(e){
  var idPer = $('#cekPer').val();
  var nip = $('#cekPeg').val();
  $.ajax({
    type  : "POST",
    url   : "<?php echo sdm()?>tunjangan_bonus/rapat/cek",
    dataType : "json",
    data : {per:idPer, nip:nip},
    beforeSend: function(){
      showSpinningProgressLoading();
      $("#tampilCekRapat").html("");
    },
    success: function(response){
      hideSpinningProgressLoading();
      if (response[0].code==200) {
      	$("#loading").html("");
        $("#tampilCekRapat").html(response[0].tabel);
        $('#tblCekRapat').dataTable({
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
</script>
