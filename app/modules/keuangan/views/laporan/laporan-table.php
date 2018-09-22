<?php $IDper = $periode->row('id_periode'); ?>
<div class="row">
	<div class="col-md-6">
		<table class="table table-striped table-bordered">
			<tr>
				<td>Periode</td>
				<td>
					<?php 
					$mulai = $this->lib_calendar->convert($periode->row('mulai'));
					$akhir = $this->lib_calendar->convert($periode->row('akhir')); ?>
					<?php echo "".$periode->row('bulan')." ".$periode->row('tahun')." ( ".$mulai." - ".$akhir." )"; ?>
				</td>
			</tr>
			<tr>
				<td>Unit Kerja</td>
				<td><?=$unit->row('nama_unit')?></td>
			</tr>
		</table>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<p style="color: red;">Note: Apabila data alamat email tidak ada, maka pengiriman email akan gagal.</p>
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>NIP</th>
					<th>Nama</th>
					<th>Penerimaan</th>
					<th>Potongan</th>
					<th>Gaji Bersih</th>
				</tr>
			</thead>
			<tbody>
			<?php if($pegawai): foreach($pegawai as $peg):
			$slip = $this->my_lib->get_data_row('data_slip_gaji',array('id_periode'=>$IDper,'nip'=>$peg->nip)); ?>
				<tr>
				<?php if($slip): ?>
					<td><?=$peg->nip?></td>
					<td><?=$peg->nama?></td>
					<td><?=$slip->row('gaji_bruto')?></td>
					<td><?=$slip->row('jml_potongan')?></td>
					<td><?=$slip->row('gaji_bersih')?></td>
				<?php else: ?>
					<td><?=$peg->nama?></td>
					<td colspan="5" align="center">Belum ada data</td>
				<?php endif; ?>
				</tr>
			<?php endforeach; endif; ?>
			</tbody>
		</table>
	</div>
</div>
	<div class="modal fade bs-example-modal-md" id="ModalDetail" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
	        </button>
	        <h4 class="modal-title" id="myModalLabel">Detail Slip Gaji</h4>
	      </div>
	      <div class="modal-body">
	      	<div id="loading-detail"></div>
	      	<div id="detail_slip">
	      		
	      	</div>
	      </div>
			</div>
		</div>
	</div>

	<div class="modal fade bs-example-modal-md" id="ModalKirim" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
	        </button>
	        <h4 class="modal-title" id="myModalLabel2">Kirim Slip Gaji</h4>
	      </div>
	      <div class="modal-body">
	      	<div id="loading-kirim"></div>
	      	<div id="kirim_slip">
	      		<form id="kirimform" class="form-horizontal">
	      			<input type="hidden" name="slipid" id="slipid">
	      			<div class="form-group">
	      				<label class="control-label col-md-3">Nama</label>
	      				<div class="col-md-6">
	      					<input type="text" name="nama" id="nama" class="form-control" readonly="">
	      				</div>
	      			</div>
	      			<div class="form-group">
	      				<label class="control-label col-md-3">Email</label>
	      				<div class="col-md-6">
	      					<input type="email" name="email" id="email" class="form-control">
	      				</div>
	      			</div>
	      			<div class="form-group">
	      				<div class="col-md-6 col-md-offset-3">
	      					<button type="button" id="btn_kirim" class="btn btn-warning"><i class="fa fa-send"></i>&nbsp;Kirim Email</button>
	      				</div>
	      			</div>
	      		</form>
	      	</div>
	      </div>
			</div>
		</div>
	</div>

<script type="text/javascript">
$('#btn_kirim').click(function(e){
	var $form = get_formdata($("#kirimform"));
	$.ajax({
		type  : "POST",
		url   : "<?php echo keuangan()?>master/data_slip/kirim_email_slip",
		dataType : "json",
		data : $form,
		beforeSend: function(){
			$("#loading-kirim").html(loader_green);
		},
		success: function(response){
			hideSpinningProgressLoading();
			if (response[0].code==200) {
				$("#loading-kirim").html(alert_green(response[0].message));       
			}
			else{
				$("#loading-kirim").html(alert_red(response[0].message));
			}
		}
	});
	e.preventDefault();
});
</script>
