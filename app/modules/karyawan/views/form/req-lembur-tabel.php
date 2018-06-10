<div class="row">
	<div class="col-md-12">
		<button type="button" id="printAbsensi" class="btn btn-sm btn-primary"><i class="fa fa-print"></i> Cetak</button>
	</div>
</div>
</br>
<div class="printArea">
	<div class="row">
		<div class="col-md-5">
			<table class="table table-striped table-bordered">
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
			</table>		
			<br>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<table id="tblCekLembur" class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Tanggal</th>
						<th>Hari</th>
						<th>Keterangan Lembur</th>
						<th>Jam Lembur</th>
						<th>Durasi</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					<?php if($cekLembur): foreach ($cekLembur as $row): ?>
						<tr>
							<td><?=tanggal_indo($row->tgl_lembur);?></td>
							<td><?=hari_indo($row->tgl_lembur);?></td>
							<td><?=$row->keterangan?></td>
							<td><?=$row->jam_mulai?> - <?=$row->jam_selesai?></td>
							<td><?=$row->durasi?></td>
							<td>
								<?php if($row->acc == 'ya'): ?>
									Pengajuan di acc
								<?php elseif($row->acc == 'tidak'): ?>
									Pengajuan di tolak
								<?php else: ?>
									Pengajuan belum di acc
								<?php endif; ?>
							</td>
						</tr>
					<?php endforeach; 
					else: ?>
						<tr>
							<td colspan="4" align="center">Tidak ada data untuk periode ini</td>
						</tr>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('#printAbsensi').on("click", function () {
      $('.printArea').printThis({
      	header: "<h4>Data Lembur Pegawai</h5>",
      });
    });
</script>
