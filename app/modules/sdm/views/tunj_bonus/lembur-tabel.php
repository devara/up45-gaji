	<table id="tblLembur" class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Tanggal Lembur</th>
				<th>Nama Pegawai</th>
				<th>Dari Jam</th>
				<th>Sampai Jam</th>
				<th>Total Jam</th>
				<th>Keterangan</th>
				</tr>
			</thead>
		<tbody>
			<?php if($cekLembur): foreach ($cekLembur as $row): ?>
				<tr>
					<td><?=$row->tgl_lembur?></td>
					<td><?=$row->nama?></td>
					<td><?=$row->jam_mulai?></td>
					<td><?=$row->jam_selesai?></td>
					<td><?=$row->durasi?></td>
					<td><?=$row->keterangan?></td>
				</tr>
			<?php endforeach; endif; ?>
		</tbody>
	</table>