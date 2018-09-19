<script type="text/javascript">
function lisPeg(){
	var kdUnit = $('#cekUnit').val();
	$.ajax({
		url: "<?php echo ajaxpublic_url();?>get_peg_by_unit/"+kdUnit+"",
		dataType:"json",
		beforeSend: function(){
			$("#loadPeg").html(loader_green);
		},
		success: function(data){
			$("#loadPeg").html("");
			if (data[0].code!=404) {
				var html = '';
				var i;
				var jum = data.length;
				html += '<option value="all">Semua</option>';
				for(i=0; i<jum; i++){          
					html += '<option value="'+data[i].nip+'">';
					html += ''+data[i].nama+'';
					html += '</option>';
				}
				$('#pegawai').html(html);
			} else {
				$("#loadPeg").html(alert_red(data[0].message));
				$('#pegawai').html("");
			}
		}
	});
}
function tampil()
{
	var idPer = $('#cekPer').val();
	var unit = $('#cekUnit').val();  
	var nip = $('#pegawai').val();
	$.ajax({
		type  : "POST",
		url   : "<?php echo sdm()?>tunjangan_bonus/lembur/tampil",
		dataType : "json",
		data : {per:idPer, unit:unit, nip:nip},
		beforeSend: function(){
			showSpinningProgressLoading();
			$("#tampilLembur").html("");
		},
		success: function(response){
			hideSpinningProgressLoading();
			if (response[0].code==200) {
				$("#loading").html("");
				$("#tampilLembur").html(response[0].tabel);        
			}
			else{
				$("#loading").html(alert_red(response[0].message));
			}
		}
	});
}
function cek()
{
	var periode = $('#cek_periode').val();
	var unit = $('#cek_unit').val();
	$.ajax({
		type  : "POST",
		url   : "<?php echo sdm()?>tunjangan_bonus/lembur/cek_pengajuan",
		dataType : "json",
		data : {per:periode, unit:unit},
		beforeSend: function(){
			showSpinningProgressLoading();
			$("#tampilLembur").html("");
		},
		success: function(response){
			hideSpinningProgressLoading();
			if (response[0].code==200) {
				$("#loading-cek").html("");
				$("#tampilPengajuan").html(response[0].tabel);        
			}
			else{
				$("#loading-cek").html(alert_red(response[0].message));
			}
		}
	});
}

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
		url: "<?=ajaxpublic_url().'cekper/'; ?>"+per,
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
	format: 'HH:mm'
});
$('#end').datetimepicker({
	format: 'HH:mm'
});

function modal_edit(id)
{
	$.ajax({
    url: "<?php echo sdm().'tunjangan_bonus/lembur/tampil_edit/'; ?>"+id,
    beforeSend: function(){
      $("#loading-edit").html(loader_green);
    },
    success: function(response){
      $("#loading-edit").html("");
      if (response[0].code==200) {
      	$('#idlembur').val(response[0].id);
      	$('#id_periode').val(response[0].periode);
      	$('#nip').val(response[0].nip);
      	$('#nama_karyawan').val(response[0].nama);
      	$('#tgl_lembur').val(response[0].tanggal);
      	$('#jam_mulai').val(response[0].mulai);
      	$('#jam_selesai').val(response[0].selesai);
      	$('#ket_lembur').val(response[0].keterangan);
      } else{
        $("#loading-edit").html(alert_red(response[0].message));
      }
    }
  });
}
function modal_acc(id)
{
	$('#lembur_id').val(id);
}
function hapus_lembur(id)
{
	$.ajax({
		url: "<?php echo sdm().'tunjangan_bonus/lembur/cek_hapus/'; ?>"+id,
		beforeSend: function(){
			
		},
		success: function(response){
			var idlem = response[0].id;
			var per = response[0].periode;
			var nip = response[0].nip;
			swal({
				title: 'Peringatan!',type: 'warning',html: "Anda yakin ingin menghapus data lembur ini?",				  
				showCancelButton: true,buttonsStyling: false,reverseButtons: true,showLoaderOnConfirm: true,allowOutsideClick: false,
				confirmButtonText: 'Ya!',cancelButtonText: 'Batal!',confirmButtonClass: 'btn btn-success',cancelButtonClass: 'btn btn-danger'
			}).then((result) => {
				if (result.value) {
					$.ajax({
						type  : "POST",
						url   : "<?php echo sdm()?>tunjangan_bonus/lembur/hapus_lembur",
						dataType : "json",
						data : {idlembur:idlem,per:per,nip:nip},
						success: function(resp){
							if (resp[0].code==200) {
								swal({
									type: 'success',title: 'Berhasil',html: ""+resp[0].message+"",
									showConfirmButton: true,allowOutsideClick: false
								}).then(function(){
									tampil();
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
	});
}
</script>
