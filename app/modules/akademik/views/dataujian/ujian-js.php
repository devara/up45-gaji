<script type="text/javascript">

$(document).ready(function() {
  $('#tblujian').dataTable();
  
  	var $MY_TAB = $('#myTab');
		var $li_data = $('#li-data');
		var $li_pengawas = $('#li-pengawas');
		var $li_cek = $('#li-cekpeng');
		var $TAB_CONTENT = $('#myTabContent');
		var $tab_data = $('#data');
		var $tab_pengawas = $('#pengawas');
		var $tab_cek = $('#cekpeng');
  
});

function cekPer(){
	var per = $('#id_per').val();
	$.ajax({
    url: "<?php echo ajaxpublic_url().'cekper/'; ?>"+per,
    beforeSend: function(){
      $("#tgl").disabled = true;
    },
    success: function(response){      
      if (response[0].code!=404) {
      	document.getElementById("tgl").disabled = false;
      	document.getElementById("tgl").min = response[0].min;
      	document.getElementById("tgl").max = response[0].max;
      } else{
        $("#tgl").disabled = true;
      }
    }
  });
}

function get_makul(){
	var prodi = $('#prodi').val();
	$.ajax({
		url: "<?php echo akademik();?>ujian/getmakul/"+prodi+"",
		dataType:"json",
		beforeSend: function(){
      $("#loadmakul").html(loader_green);
    },
    success: function(data){
      $("#loadmakul").html("");
      if (data[0].code!=404) {
        var html = '';
        var i;
        var jum = data.length;
        for(i=0; i<jum; i++){
        	html += '<option value="'+data[i].kd_makul+'">';
        	html += ''+data[i].nm_makul+'';
        	html += '</option>';
        }
        $('#makul').html(html);
      } else{
        $("#loadmakul").html(alert_red(response[0].message));
      }
    }
	});
}

$('#btn_tambah').click(function(e){
	var idper = $('#id_per').val();
	var tgl = $('#tgl').val();
	var tipe = $('#tipe').val();
	var makul = $('#makul').val();
	var ket = $('#addket').val();
	$.ajax({
		type: "POST",
		url: "<?php echo akademik()?>ujian/tambah",
		dataType: "json",
		data: {idper:idper, tgl:tgl, tipe:tipe, makul:makul, ket:ket},
		beforeSend: function(){
			$("#loading").html(loader_green);
		},
		success: function(response){
			$("#loading").html("");
			if (response[0].code==200) {
				$('#id_per').val(0);
				$('#tgl').val("");
				$('#tipe').val("");
				$('#prodi').val(0);
				$('#makul').html("");
				$('#addket').val("");
				swal({
				  type: 'success',
				  title: 'Berhasil',
				  html: ''+response[0].message+'',
				  showConfirmButton: true,
				  allowOutsideClick: false
				}).then(function(){
					location.reload();
				})
			} else if (response[0].code==500) {
				swal({
				  type: 'error',
				  title: 'Gagal',
				  html: ''+response[0].message+'',
				  showConfirmButton: true,
				  allowOutsideClick: false
				})
			} else {
				$("#loading").html(alert_red(response[0].message));
			}
		}
	});
	e.preventDefault();
});

$('#btn_cek').click(function(e){
  var idPer = $('#cekPeriode').val();
  var nip = $('#cekPeg').val();
  $.ajax({
    type  : "POST",
    url   : "<?php echo akademik()?>ujian/cek_data_pengawas",
    dataType : "json",
    data : {per:idPer, nip:nip},
    beforeSend: function(){
      $("#cekloading").html(loader_green);
      $("#tampilCekPengawas").html("");
    },
    success: function(response){
      $("#cekloading").html("");
      if (response[0].code==200) {
        $("#tampilCekPengawas").html(response[0].tabel);
        $('#tblCekPengawas').dataTable({
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

function showData(){
	$.ajax({
		url: "<?php echo akademik();?>ujian/getUjian",
		dataType:"json",
		beforeSend: function(){
      $('#dataUjian').html(loader_green);
    },
    success: function(data){      
      if (data[0].code!=404) {
        $('#dataUjian').html(data[0].tabel);
        $('#tblujian').dataTable();
      } else{
        
      }
    }
	});
}

</script>