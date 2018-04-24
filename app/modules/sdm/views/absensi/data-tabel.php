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