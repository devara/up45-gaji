<div class="oneunit_area">
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
			</table>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<table id="tblLembur" class="table table-striped table-bordered">
				<thead>
					<tr>
						<th class="text-center" style="vertical-align: middle;">Tanggal Lembur</th>
						<th class="text-center" style="vertical-align: middle;">Nama Pegawai</th>
						<th class="text-center" style="vertical-align: middle;">Jam</th>
						<th class="text-center" style="vertical-align: middle;">Total Jam</th>
						<th class="text-center" style="vertical-align: middle;">Keterangan</th>
						<th class="text-center" style="vertical-align: middle;">Acc Kabag</th>
						<th class="text-center" style="vertical-align: middle;">Acc SDM</th>
						<th class="text-center" style="vertical-align: middle;">Tindakan</th>
					</tr>
				</thead>
				<tbody>
					<?php if($cekLembur): foreach ($cekLembur as $row): ?>
						<tr>
							<td><?=tanggal_indo($row->tgl_lembur)?></td>
							<td><?=$row->nama?></td>
							<td><?=$row->jam_mulai?> - <?=$row->jam_selesai?></td>
							<td><?=$row->durasi?></td>
							<td><?=$row->keterangan?></td>
							<td align="center">
								<?php if($row->acc_kabag == 'ya'): ?>
									<div class="green-text">Disetujui</div>
								<?php elseif($row->acc_kabag == 'belum'): ?>
									<div class="orange-text">Belum disetujui</div>
								<?php else: ?>
									<div class="red-text">Tidak disetujui</div>
								<?php endif; ?>
							</td>
							<td align="center">
								<?php if($row->acc == 'ya'): ?>
									<div class="green-text">Disetujui</div>
								<?php elseif($row->acc == 'belum'): ?>
									<div class="orange-text">Belum disetujui</div>
								<?php else: ?>
									<div class="red-text">Tidak disetujui</div>
								<?php endif; ?>
							</td>
							<td align="center">
								<?php if($row->acc == 'ya'): ?>
									-
								<?php elseif($row->acc == 'tidak'): ?>
									-
								<?php else: ?>
									<a class="btn btn-xs btn-primary" data-toggle="modal" data-target="#Modalacc" onclick="modal_acc(<?=$row->id_lembur?>)"><span class="caret"></span> Pilih tindakan</a>
								<?php endif; ?>								
							</td>
						</tr>
					<?php endforeach;
					else: ?>
						<tr>
							<td colspan="7" align="center">Tidak ada data untuk periode ini</td>
						</tr>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="modal fade bs-example-modal-sm" id="Modalacc" role="dialog" aria-hidden="true" style="top: 25%;">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Pengajuan Lembur</h4>
      </div>
      <div class="modal-body">
      	<div id="loading-acc"></div>
      	<form id="accform" class="form-horizontal">
      		<input type="hidden" name="lembur_id" id="lembur_id">
      		<div class="form-group">
      			<label class="control-label col-md-3">Tindakan</label>
      			<div class="col-md-9">
      				<select name="tindakan" id="tindakan" class="form-control">
      					<option value="ya">Setujui</option>
      					<option value="tidak">Tolak</option>
      				</select>
      			</div>
      		</div>
      		<div class="form-group">
      			<div class="col-md-9 col-md-offset-3">
      				<button type="button" id="btn-acc" class="btn btn-xs btn-primary"><i class="fa fa-check"></i>&nbsp;Eksekusi</button>
      				<button type="button" class="btn btn-xs btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Tutup</button>
      			</div>
      		</div>
      	</form>
      </div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('#btn-acc').click(function(e){
		var $form = get_formdata($("#accform"));
		$.ajax({
			type  : "POST",
			url   : "<?php echo karyawan()?>kabag/pengajuan_lembur/eksekusi_pengajuan_lembur",
			dataType : "json",
			data : $form,
			beforeSend: function(){
				$("#loading-acc").html(loader_green);
			},
			success: function(response){
				$("#loading-acc").html("");
				if (response[0].code==200) {
					swal({
						type: 'success',
						title: 'Berhasil',
						html: ""+response[0].message+"",
						showConfirmButton: true,
						allowOutsideClick: false
					}).then(function(){
						$("#Modalacc").on("hidden.bs.modal", function () {
						  cek();
						});
					})
				} else if(response[0].code==404){
					
					swal({
						type: 'error',
						title: 'Gagal',
						html: ''+response[0].message+'',
						showConfirmButton: true,
						allowOutsideClick: false
					})
				}
				else{
					$("#loading-acc").html(alert_red(response[0].message));
				}
			}
		});
		e.preventDefault();
	});
</script>
