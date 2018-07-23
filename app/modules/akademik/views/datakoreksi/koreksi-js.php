<script type="text/javascript">
$(document).ready(function() {
  $('#tblujian').dataTable();
  
});

function get_ujian(){
	var periode = $('#periode').val();
	$.ajax({
		url: "<?php echo akademik();?>koreksi/get_ujian/"+periode+"",
		dataType:"json",
		beforeSend: function(){
      $("#loadujian").html(loader_green);
    },
    success: function(data){
      $("#loadujian").html("");
      if (data[0].code==200) {
        var html = '';
        var i;
        var jum = data.length;
        for(i=0; i<jum; i++){
        	html += '<option value="'+data[i].id_ujian+'">';
        	html += ''+data[i].nama_ujian+'';
        	html += '</option>';
        }
        $('#ujianlist').html(html);
      } else{
      	$('#ujianlist').html('<option selected="" disabled="">Pilih Ujian</option>');
        $("#loadujian").html(alert_red(data[0].message));
      }
    }
	});
}

$('#btn_cek').click(function(e){
  var idPer = $('#cekPeriode').val();
  var nip = $('#cekPeg').val();
  $.ajax({
    type  : "POST",
    url   : "<?php echo akademik()?>koreksi/cek_data_korektor",
    dataType : "json",
    data : {per:idPer, nip:nip},
    beforeSend: function(){
      $("#cekloading").html(loader_green);
      $("#tampilCekKorektor").html("");
    },
    success: function(response){
      $("#cekloading").html("");
      if (response[0].code==200) {
        $("#tampilCekKorektor").html(response[0].tabel);
        $('#tblCekKorektor').dataTable({
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
        $("#cekloading").html(alert_red(response[0].message));
      }
    }
  });
  e.preventDefault();
});
</script>
