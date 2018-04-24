<script type="text/javascript">
function jumKeg() {
	var jum = $('#jum').val();
	var isi = '';
  var i;
	for (i=0; i<jum; i++) {
		isi += '<div class="form-group">';
		isi += '<div class="col-md-offset-2 col-md-6 col-sm-6 col-xs-12">';
		isi += '<input type="text" name="keg[]" class="form-control" placeholder="Nama Kegiatan" required="required">';
		isi += '</div>';
		isi += '<div class="col-md-2">';
		isi += '<input type="number" max="21" min="8" name="dari[]" class="form-control" placeholder="Dari jam" required="required">';
		isi += '</div>';
		isi += '<div class="col-md-2">';
		isi += '<input type="number" max="21" min="8" name="sampai[]" class="form-control" placeholder="Sampai jam" required="required">';
		isi += '</div>';
		isi += '</div>';
	}

	$("#formAdd").html(isi);
}

function tglRKH(){
	var per = $('#periode').val();
	$.ajax({
    url: "<?php echo sdm().'rkhlh/cekper/'; ?>"+per,
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

function getPer(){
	var per = $('#cekPer').val();
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

function getTanggal(){
	var tgl = $('#tgl').val();
	$.ajax({
    url: "<?php echo sdm().'rkhlh/getrkh_by_tgl/'; ?>"+tgl,
    beforeSend: function(){
      $("#tampilDetail").html(loader_green);
    },
    success: function(response){
    	$("#tampilDetail").html("");
      if (response[0].code!=404) {
      	$("#tampilDetail").html(response[0].form);
      } else{
        
      }
    }
  });
}

function getDetail(){
	var id_rkh = $('#rkh').val();
	$.ajax({
    url: "<?php echo sdm().'rkhlh/getrkh/'; ?>"+id_rkh,
    beforeSend: function(){
      $("#tampilDetail").html(loader_green);
    },
    success: function(response){
    	$("#tampilDetail").html("");
      if (response[0].code!=404) {
      	$("#tampilDetail").html(response[0].form);
      } else{
        
      }
    }
  });
}

</script>