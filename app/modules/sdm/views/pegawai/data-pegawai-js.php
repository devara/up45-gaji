<script type="text/javascript">
$(document).ready(function() {
  $('#tablepegawai').dataTable({
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

function detail_peg(id){
  $.ajax({
    url: "<?php echo sdm().'data_pegawai/detail/';?>"+id,
    beforeSend: function(){
      $("#loading").html(loader_green);
    },
    success: function(response){
      $("#loading").html("");
      if (response[0].code!=404) {
        $('#peg_nip').html(response[0].nip);
        $('#peg_nama').html(response[0].nama);
        $('#peg_unit').html(response[0].unit);
        $('#peg_jab').html(response[0].jabatan);
      } else{
        $("#loading").html(alert_red(response[0].message));
      }
    }
  });
}
</script>
