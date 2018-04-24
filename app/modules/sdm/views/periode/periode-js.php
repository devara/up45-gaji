<script type="text/javascript">
$(document).ready(function() {
  $('#tblPeriode').dataTable();
});

$('#btn_tambah').click(function(e){
    var tahun = $('#addtahun').val();
    var bulan = $('#addbulan').val();
    var mulai = $('#addmulai').val();
    var akhir = $('#addakhir').val();
    var jumlah = $('#jumhari').val();
    var pembagi = $('#pembagi').val();
    $.ajax({
      type  : "POST",
      url   : "<?php echo sdm()?>periode/tambah",
      dataType : "json",
      data : {thn:tahun, bln:bulan, mulai:mulai, akhir:akhir, jum:jumlah, pemb:pembagi},
      beforeSend: function(){
        $("#loading").html(loader_green);
      },
      success: function(response){
        $("#loading").html("");
        if (response[0].code==200) {
          $('#addtahun').val("");
          $('#addbulan').val("");
          $('#addmulai').val("");
          $('#addakhir').val("");
          $('#jumhari').val("");
          $('#pembagi').val("");
          swal({
					  type: 'success',
					  title: 'Berhasil',
					  html: ''+response[0].message+'',
					  showConfirmButton: true,
					  allowOutsideClick: false
					}).then(function(){
						location.reload();
					})
        } else if(response[0].code==500){
          
          swal({
					  type: 'error',
					  title: 'Gagal',
					  html: ''+response[0].message+'',
					  showConfirmButton: true,
					  allowOutsideClick: false
					})
        }
        else{
          $("#loading").html(alert_red(response[0].message));
        }
      }
    });
    e.preventDefault();
  });
</script>