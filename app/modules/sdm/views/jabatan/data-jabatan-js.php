<script type="text/javascript">
$(document).ready(function() {
	$('#tablejab').dataTable({
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
});

$('#btn_tambah').click(function(e){
		var kode = $('#addkd_jab').val();
		var nama = $('#addnm_jab').val();
		var tunj = $('#addtunj_jab').val();
		var under = $('#addunder_jab').val();
		var kap = $('#addkap_jab').val();
		var ket = $('#addket_jab').val();
		$.ajax({
			type  : "POST",
			url   : "<?php echo sdm()?>jabatan/tambah",
			dataType : "json",
			data : {kode:kode , nama:nama, tunj:tunj, under:under, kap:kap, ket:ket},
			beforeSend: function(){
				$("#loading").html(loader_green);
			},
			success: function(response){
				$("#loading").html("");
				if (response[0].code==200) {
					$('#addkd_jab').val("");
					$('#addnm_jab').val("");
					$('#addtunj_jab').val("");
					$('#addunder_jab').val("");
					$('#addkap_jab').val("");
					$('#addket_jab').val("");
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

$('#btn_edit').click(function(e){
		var $form = get_formdata($("#editform"));
		$.ajax({
			type  : "POST",
			url   : "<?php echo sdm()?>jabatan/edit",
			dataType : "json",
			data : $form,
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
					$("#loading").html(alert_red(response[0].message));
				}
			}
		});
		e.preventDefault();
	});

function edit_jab(kode){
	$.ajax({
		url: "<?php echo sdm().'jabatan/cek_edit/'; ?>"+kode,
		beforeSend: function(){
			$("#editloading").html(loader_green);
		},
		success: function(response){
			$("#editloading").html("");
			if (response[0].code!=404) {
				$('#id_jab').val(response[0].id);
				$('#kd_jab').val(response[0].kode);
				$('#nm_jab').val(response[0].nama);
				$('#tunj_jab').val(response[0].tunj);
				$('#under_jab').val(response[0].under);
				$('#kap_jab').val(response[0].max);
				$('#ket_jab').val(response[0].ket);
			} else{
				$("#editloading").html(alert_red(response[0].message));
			}
		}
	});
}

function del_jab(kode){
	$.ajax({
		url: "<?php echo sdm().'jabatan/cek_hapus/'; ?>"+kode,
		beforeSend: function(){
			show_preload();
		},
		success: function(response){
			var idJab = response[0].id;
			var namaJab = response[0].nama;
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
					type: 'warning',title: 'Jabatan Terisi',html: ''+isi+'',
					showConfirmButton: true,allowOutsideClick: false
				})
			} else if (response[0].code==404){
				swal({
					type: 'error',title: 'Gagal',text: ''+response[0].message+'',
					showConfirmButton: true,allowOutsideClick: false
				})
			} else{
				swal({
					title: 'Peringatan!',type: 'warning',html: "Anda yakin ingin menghapus jabatan "+response[0].nama+" ?",				  
					showCancelButton: true,buttonsStyling: false,reverseButtons: true,showLoaderOnConfirm: true,allowOutsideClick: false,
					confirmButtonText: 'Ya!',cancelButtonText: 'Batal!',confirmButtonClass: 'btn btn-success',cancelButtonClass: 'btn btn-danger',				  
				}).then((result) => {
					if (result.value) {
						$.ajax({
							type  : "POST",
							url   : "<?php echo sdm()?>jabatan/hapus",
							dataType : "json",
							data : {id:idJab, nama:namaJab},
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

function show_preload(){
	$("#delloading").show();
	$("#delloading").hide();
}
</script>
