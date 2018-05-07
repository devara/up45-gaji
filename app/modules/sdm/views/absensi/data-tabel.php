<?php if ($jenis == 'multiple') { ?>
	<table id="tblabsensi" class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Tanggal</th>
				<th>Hari</th>
				<th>NIP</th>
				<th>Nama</th>
				<th>Time IN</th>
				<th>Time OUT</th>
				<th>Lama Kerja</th>
				<th>Keterangan</th>
				</tr>
			</thead>
		<tbody>
			<?php if($absensi): foreach ($absensi as $row): ?>
				<tr>
					<td><?=$row->tanggal?></td>
					<td><?=$row->hari?></td>
					<td><?=$row->nip?></td>
					<td><?=$row->nama?></td>
					<td><?=$row->datang?></td>
					<td><?=$row->pulang?></td>
					<td><?=$row->lama_kerja?></td>
					<td><?=$row->keterangan?></td>
				</tr>
			<?php endforeach; endif; ?>
		</tbody>
	</table>
<?php } else { ?>
	<div class="col-md-6">
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
	<div class="col-md-6">
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
	<table id="tblabsensi" class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Tanggal</th>
				<th>Hari</th>
				<th>Time IN</th>
				<th>Time OUT</th>
				<th>Lama Kerja</th>
				<th>Keterangan</th>
				</tr>
			</thead>
		<tbody>
			<?php if($absensi): foreach ($absensi as $row): ?>
				<tr>
					<td><?=$row->tanggal?></td>
					<td><?=$row->hari?></td>
					<td><?=$row->datang?></td>
					<td><?=$row->pulang?></td>
					<td><?=$row->lama_kerja?></td>
					<td><?=$row->keterangan?></td>
				</tr>
			<?php endforeach; endif; ?>
		</tbody>
	</table>
<?php } ?>