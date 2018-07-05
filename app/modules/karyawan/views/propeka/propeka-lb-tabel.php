	<div class="col-md-6">
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

	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th rowspan="2" style="text-align: center;vertical-align: middle;">No</th>
				<th rowspan="2" style="text-align: center;vertical-align: middle;">Kegiatan</th>
				<th colspan="2" style="text-align: center;">Rencana</th>
				<th colspan="2" style="text-align: center;">Realisasi</th>
				<th rowspan="2" style="text-align: center;vertical-align: middle;">Keterangan</th>
			</tr>
			<tr>
				<th style="text-align: center;">Dari</th>
				<th style="text-align: center;">Sampai</th>
				<th style="text-align: center;">Dari</th>
				<th style="text-align: center;">Sampai</th>
			</tr>
		</thead>
		<tbody>
		<?php if($laporan): $no = 1; foreach($laporan as $lap): ?>
			<tr>
				<td><?=$no?></td>
				<td><?=$lap->kegiatan?></td>
				<td>
					<?=tanggal_indo($lap->cb_tgl_mulai)?>
				</td>
				<td>
					<?=tanggal_indo($lap->cb_tgl_selesai)?>
				</td>
				<td>
					<?=tanggal_indo($lap->lb_tgl_mulai)?>
				</td>
				<td>
					<?=tanggal_indo($lap->lb_tgl_selesai)?>
				</td>
				<td><?=$lap->keterangan?></td>
			</tr>
		<?php $no++; endforeach; else: ?>
			<tr>
				<td colspan="7" align="center">Tidak ada data untuk periode ini</td>
			</tr>
		<?php endif; ?>
		</tbody>
	</table>
