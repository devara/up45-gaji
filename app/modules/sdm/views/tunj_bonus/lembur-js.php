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
</script>