<script type="text/javascript">
function lisPeg(){
	var kdUnit = $('#kdUnit').val();
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
				html += '<option selected disabled>Pilih</option>';
				for(i=0; i<jum; i++){          
					html += '<option value="'+data[i].nip+'">';
					html += ''+data[i].nama+'';
					html += '</option>';
				}
				$('#pegawai').html(html);
			} else{
				$("#loadPeg").html(alert_red(response[0].message));
			}
		}
	});
}

$('#btn_tampil').click(function(e){
	var idPer = $('#idPer').val();
	var kdUnit = $('#kdUnit').val();
	var nip = $('#pegawai').val();
	$.ajax({
		type  : "POST",
		url   : "<?php echo sdm()?>propeka/cblb/tampil",
		dataType : "json",
		data : {per:idPer , unit:kdUnit, nip:nip},
		beforeSend: function(){
			showSpinningProgressLoading();
			$("#tampilData").html("");
		},
		success: function(response){
			hideSpinningProgressLoading();
			if (response[0].code==200) {
				$("#loading").html("");
				$("#tampilData").html(response[0].tabel);
			}
			else{
				$("#loading").html(alert_red(response[0].message));
			}
		}
	});
	e.preventDefault();
});
</script>
