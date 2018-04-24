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

$('#btn_cek').click(function(e){
  var idPer = $('#cekPer').val();
  var nip = $('#cekPeg').val();
  $.ajax({
    type  : "POST",
    url   : "<?php echo sdm()?>tunjangan_bonus/rapat/cek",
    dataType : "json",
    data : {per:idPer, nip:nip},
    beforeSend: function(){
      $("#loading").html(loader_green);
      $("#tampilCekRapat").html("");
    },
    success: function(response){
      $("#loading").html("");
      if (response[0].code==200) {
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