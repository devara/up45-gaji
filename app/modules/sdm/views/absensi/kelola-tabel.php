<div class="row">
	<div class="col-md-6 col-sm-6">
		<table class="table table-striped table-bordered">
			<tr>
				<td>Periode</td>
				<td>
					<?php foreach ($periode as $per) { 
					$mulai = $this->lib_calendar->convert($per->mulai);
					$akhir = $this->lib_calendar->convert($per->akhir); ?>
					<?php echo "".$per->bulan." ".$per->tahun." ( ".$mulai." - ".$akhir." )"; ?>
					<?php } ?>
				</td>
			</tr>
			<?php foreach ($pegawai as $peg) { ?>
			<tr>
				<td>NIP</td>
				<td><?=$peg->nip?></td>
			</tr>
			<tr>
				<td>Nama</td>
				<td><?=$peg->nama?></td>
			</tr>
			<?php } ?>			
		</table>		
		<br>
	</div>
	<div class="col-md-6 col-sm-6">
		<table class="table table-striped table-bordered">
		<?php if($rekap): ?>
			<?php foreach ($rekap as $re) { 
					$total_jam = explode(':', $re->total_jam);
					$rerata = explode(':', $re->rerata);
					$jam = $total_jam[0];
					$menit = $total_jam[1];
					$detik = $total_jam[2];
					$jam1 = $rerata[0];
					$menit1 = $rerata[1];
					$detik1 = $rerata[2]; ?>
			<tr>
				<td>Total Jam</td>
				<td><?php echo "".$jam." jam ".$menit." menit ".$detik." detik"; ?></td>
			</tr>
			<tr>
				<td>Rata-rata</td>
				<td><?php echo "".$jam1." jam ".$menit1." menit ".$detik1." detik"; ?></td>
			</tr>
			<tr>
				<td>Tepat Waktu</td>
				<td><?=$re->tepat_waktu?> kali</td>
			</tr>
			<?php } ?>
		<?php else: ?>
			<tr>
				<td>Total Jam</td>
				<td>Belum ada data</td>
			</tr>
			<tr>
				<td>Rata-rata</td>
				<td>Belum ada data</td>
			</tr>
			<tr>
				<td>Tepat Waktu</td>
				<td>Belum ada data</td>
			</tr>
		<?php endif; ?>
		</table>
	</div>
	<div class="col-md-12 col-sm-12">
		<div class="table-responsive">
			<table id="tblabsensi2" class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>No</th>
						<th>Tanggal</th>
						<th>Hari</th>
						<th>Time IN</th>
						<th>Time OUT</th>
						<th>Lama Kerja</th>
						<th>Keterangan</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php if($absensi): $no = 1; foreach ($absensi as $row): ?>
						<tr>
							<td><?=$no?></td>
							<td><?=$row->tanggal?></td>
							<td><?=$row->hari?></td>
							<td><?=$row->datang?></td>
							<td><?=$row->pulang?></td>
							<td><?=$row->lama_kerja?></td>
							<td><?=$row->keterangan?></td>
							<td>
								<a class="btn btn-success btn-xs item_edit" data-toggle="modal" data-target="#ModalEdit" onclick="modal_edit(<?=$row->id_absensi?>)"><i class="fa fa-edit"></i>&nbsp;Edit Absensi</a>
							</td>
						</tr>
					<?php $no++; endforeach; endif; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="modal fade bs-example-modal-md" id="ModalEdit" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Edit Absensi Pegawai</h4>
      </div>
      <div class="modal-body">
      	<div id="loading-edit"></div>
      	<div id="form-edit">
	      	<form id="editform" data-parsley-validate class="form-horizontal form-label-left">
	      		<input type="hidden" name="idabsensi" id="idabsensi">
	      		<input type="hidden" name="id_periode" id="id_periode">
						<input type="hidden" name="nip" id="nip">
	      		<div class="form-group">
			        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tgl_absensi">Tanggal</label>
			        <div class="col-md-4 col-sm-6 col-xs-12">
			          <input type="date" id="tgl_absensi" name="tgl_absensi" required="required" class="form-control col-md-7 col-xs-12" readonly="">
			        </div>
			      </div>
			      <div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hari_absensi">Hari</label>
							<div class="col-md-4 col-sm-6 col-xs-6">
								<input type="text" name="hari_absensi" id="hari_absensi" class="form-control" readonly>
							</div>
						</div>
			      <div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="datang">Time IN</label>
							<div class="col-md-4 col-sm-4">
		           	<div class='input-group' id='in'>
		              <input type="text" name="datang" id="datang" class="form-control"/>
		              <span class="input-group-addon">
		               	<span class="glyphicon glyphicon-time"></span>
		             	</span>
		            </div>
		          </div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="pulang">Time OUT</label>
							<div class="col-md-4 col-sm-4">
		           	<div class='input-group' id='out'>
		          	  <input type="text" name="pulang" id="pulang" class="form-control"/>
		              <span class="input-group-addon">
		               	<span class="glyphicon glyphicon-time"></span>
		             	</span>
		            </div>
		          </div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="ket_absensi">Keterangan</label>
							<div class="col-md-4 col-sm-6 col-xs-6">
								<textarea class="form-control" name="ket_absensi" id="ket_absensi"></textarea>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-4 col-md-offset-3 col-sm-4 col-sm-offset-3">
								<button type="button" class="btn btn-sm btn-success" id="btn_edit">Update</button>
							</div>
						</div>
	      	</form>
      	</div>
      </div>
		</div>
	</div>
</div>

<script type="text/javascript">
$('#in').datetimepicker({
  format: 'HH:mm:ss'
});
$('#out').datetimepicker({
  format: 'HH:mm:ss'
});
$('#btn_edit').click(function(e){
		var $form = get_formdata($("#editform"));
		$.ajax({
			type  : "POST",
			url   : "<?php echo sdm()?>absensi/kelola/update_absensi",
			dataType : "json",
			data : $form,
			beforeSend: function(){
				$("#loading-edit").html(loader_green);
			},
			success: function(response){
				$("#loading-edit").html("");
				if (response[0].code==200) {
					swal({
						type: 'success',
						title: 'Berhasil',
						html: ""+response[0].message+"",
						showConfirmButton: true,
						allowOutsideClick: false
					}).then(function(){
						$("#ModalEdit").on("hidden.bs.modal", function () {
						  tampil();
						});
					})
				} else if(response[0].code==404){
					
					swal({
						type: 'error',
						title: 'Gagal',
						text: ''+response[0].message+'',
						showConfirmButton: true,
						allowOutsideClick: false
					})
				}
				else{
					$("#loading-edit").html(alert_red(response[0].message));
				}
			}
		});
		e.preventDefault();
	});
</script>
