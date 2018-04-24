<script type="text/javascript">
$(document).ready(function() {
  $('#tblabsensi').dataTable({
  	"language": {
            "lengthMenu": "Tampilkan _MENU_ data per halaman",
            "zeroRecords": "Maaf, hasil pencarian tidak ada",
            "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            "infoEmpty": "Tidak ada data",
            "infoFiltered": "(Filter dari _MAX_ jumlah data)",
            "search": "Cari ",
            "paginate": {
				        "first":      "First",
				        "last":       "Last",
				        "next":       "Selanjutnya",
				        "previous":   "Sebelumnya"
				    }
        	},
  });
});
</script>