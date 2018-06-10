<script type="text/javascript">
$('#tampilChecklist').click(function(e){
	var idPer = $('#cekPer').val();
	var nip = $('#nipPegawai').val();
	$.ajax({
		type  : "POST",
		url   : "<?php echo karyawan()?>propeka/checklist/tampil",
		dataType : "json",
		data : {per:idPer, nip:nip},
		beforeSend: function(){
			$("#loading").html(loader_green);
			$("#tabelChecklist").html("");
		},
		success: function(response){
			$("#loading").html("");
			if (response[0].code==200) {
				$("#tabelChecklist").html(response[0].tabel);
			}
			else{
				$("#loading").html(alert_red(response[0].message));
			}
		}
	});
	e.preventDefault();
});

$('#btnTambah').click(function(e){
	var isi = '';
	isi += '<div class="form-group">';
		isi += '<div class="col-md-offset-1 col-md-5 col-sm-6 col-xs-12">';
		isi += '<input type="text" name="keg[]" class="form-control" placeholder="Nama Kegiatan" required>';
		isi += '</div>';
		isi += '<div class="col-md-3">';
		isi += '<input type="date" name="dari[]" class="form-control" placeholder="Dari tanggal" required>';
		isi += '</div>';
		isi += '<div class="col-md-3">';
		isi += '<input type="date" name="sampai[]" class="form-control" placeholder="Sampai tanggal" required>';
		isi += '</div>';
		isi += '</div>';
	$("#formAdd").append(isi);
	e.preventDefault();
});

function cekData(){
	var per = $('#periode').val();
	var nip = $('#pegawai').val();
	var $btnsmt = $('#btnSubmit');
	$.ajax({
		type  : "POST",
		url   : "<?php echo karyawan()?>propeka/checklist/cek",
		dataType : "json",
		data : {per:per, nip:nip},
		beforeSend: function(){
			$("#cekloading").html(loader_green);
		},
		success: function(response){
			$("#cekloading").html("");
			if (response[0].code==200) {
				$("#cekloading").html(alert_red(response[0].status));
				$("#formAdd").hide();
				$btnsmt.removeClass('btn-success').addClass('btn-danger');
				document.getElementById('btnSubmit').disabled = true;
			}
			else if (response[0].code==500) {      	
				$("#formAdd").show();
				$btnsmt.removeClass('btn-danger').addClass('btn-success');
				document.getElementById('btnSubmit').disabled = false;
			}
			else{
				$("#cekloading").html(alert_red(response[0].message));
			}
		}
	});
}
</script>
