<script type="text/javascript">
$(document).ready(function() {
	//datatables
	tampil_data_jabatan();
  $('#table-jab').dataTable();

});
  function tampil_data_jabatan(){
    $.ajax({
      type  : 'ajax',
      url   : '<?php echo sdm()?>unit_kerja/ajax_list',
      async : false,
      dataType : 'json',
      success : function(data){
        var html = '';
        var i;
        var jum = data.length;
        for(i=0; i<jum; i++){
          html += '<tr>'+
          '<td>'+data[i].kode_unit+'</td>'+
          '<td>'+data[i].nama_unit+'</td>'+
          '<td>'+data[i].keterangan+'</td>'+
          '<td style="text-align:center;">'+
          '<a class="btn btn-success btn-xs item_edit" onClick="edit_unit(\''+data[i].id_unit+'\')" data-toggle="modal" data-target="#ModalEdit"><i class="fa fa-pencil"></i> Edit</a>'+' '+
          '<a class="btn btn-danger btn-xs item_hapus" onClick="del_unit(\''+data[i].id_unit+'\')" data-toggle="modal" data-target="#DelUnit"><i class="fa fa-trash"></i> Hapus</a>'+
          '</td>'+
          '</tr>';
        }
        $('#show_data').html(html);
      }
 
    });
  }

$('#btn_simpan').click(function(e){
    var kode = $('#kd_unit').val();
    var bidang = $('#bidang').val();
    var nama = $('#nm_unit').val();
    var ket = $('#ket_unit').val();
    $.ajax({
      type  : "POST",
      url   : "<?php echo sdm()?>unit_kerja/tambah",
      dataType : "json",
      data : {kode:kode , bidang:bidang, nama:nama, ket:ket},
      beforeSend: function(){
        $("#loading").html(loader_green);
      },
      success: function(response){
        $("#loading").html("");
        if (response[0].code==200) {          
          $('#kd_unit').val("");
          $('#nm_unit').val("");
          $('#ket_unit').val("");
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
function edit_unit(id){
  $.ajax({
    url: "<?php echo sdm().'unit_kerja/cek_edit/'; ?>"+id,
    beforeSend: function(){
      $("#editloading").html(loader_green);
    },
    success: function(response){
      $("#editloading").html("");
      if (response[0].code!=404) {
        $('#id_unit1').val(response[0].id);
        $('#kd_unit1').val(response[0].kode);
        $('#bidang1').val(response[0].bidang);
        $('#nm_unit1').val(response[0].nama);
        $('#ket_unit1').val(response[0].ket);
      } else{
        $("#editloading").html(alert_red(response[0].message));
      }
    }
  });
}
$('#btn_edit').click(function(e){
    var id = $('#id_unit1').val();
    var kode = $('#kd_unit1').val();
    var bidang = $('#bidang1').val();
    var nama = $('#nm_unit1').val();
    var ket = $('#ket_unit1').val();
    $.ajax({
      type  : "POST",
      url   : "<?php echo sdm()?>unit_kerja/edit",
      dataType : "json",
      data : {id:id, kode:kode , bidang:bidang, nama:nama, ket:ket},
      beforeSend: function(){
        $("#editloading").html(loader_green);
      },
      success: function(response){
        $("#editloading").html("");
        if (response[0].code==200) {
          swal({
            type: 'success',
            title: 'Berhasil',
            html: ""+response[0].message+"",
            showConfirmButton: true,
            allowOutsideClick: false
          }).then(function(){
            location.reload();
          })
        } else if(response[0].code==500){
          swal({
            type: 'error',
            title: 'Gagal',
            text: ''+response[0].message+'',
            showConfirmButton: true,
            allowOutsideClick: false
          })
        }
        else{
          $("#editloading").html(alert_red(response[0].message));
        }
      }
    });
    e.preventDefault();
  });
function del_unit(id){
  $.ajax({
    url: "<?php echo sdm().'unit_kerja/cek_hapus/'; ?>"+id,
    success: function(response){
      var idUnit = response[0].id;
      var nmUnit = response[0].nama;
      if (response[0].code==500) {
        var isi = '';
        var i;
        var jum = response[0].list.length;
        isi += '<p>Berisi '+jum+' pegawai :</p>';
        isi += '<table class="table table-striped table-bordered"><tbody>';
        for (i=0; i<jum; i++) {
          isi += '<tr>';
          isi += '<td>'+response[0].list[i].nama+'</td>';
          isi += '</tr>';
        }
        isi += '</tbody></table>';
        swal({
          type: 'warning',title: 'Unit Kerja Terisi',html: ''+isi+'',
          showConfirmButton: true,allowOutsideClick: false
        })
      }
      else if (response[0].code==404) {
        swal({
          type: 'error',title: 'Gagal',text: ''+response[0].message+'',
          showConfirmButton: true,allowOutsideClick: false
        })
      }
      else {
        swal({
          title: 'Peringatan!',type: 'warning',html: "Anda yakin ingin menghapus unit kerja "+response[0].nama+" ?",         
          showCancelButton: true,buttonsStyling: false,reverseButtons: true,showLoaderOnConfirm: true,allowOutsideClick: false,
          confirmButtonText:'Ya!',cancelButtonText:'Batal!',confirmButtonClass:'btn btn-success',cancelButtonClass:'btn btn-danger',          
        }).then((result) => {
          if (result.value) {
            $.ajax({
              type  : "POST",
              url   : "<?php echo sdm()?>unit_kerja/hapus",
              dataType : "json",
              data : {id:idUnit, nama:nmUnit},
              success: function(resp){
                if (resp[0].code==200) {
                  swal({
                    type: 'success',title: 'Berhasil',html: ""+resp[0].message+"",
                    showConfirmButton: true,allowOutsideClick: false
                  }).then(function(){
                    location.reload();
                  })
                }
                else {
                  swal({
                    type: 'error',title: 'Gagal',html: ""+resp[0].message+"",
                    showConfirmButton: true,allowOutsideClick: false
                  })
                }
              }
            });
          }
        })
      }
    }
  });
}
</script>