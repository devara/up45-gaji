	<div class="col-md-6">
		<table class="table table-striped table-bordered">
			<?php foreach ($cekPegawai as $peg) { ?>
			<tr>
				<td width="100px">NIP</td>
				<td><?=$peg->nip?></td>
			</tr>
			<tr>
				<td width="100px">Nama</td>
				<td><?=$peg->nama?></td>
			</tr>
			<?php } ?>
		</table>		
		<br>
	</div>
	<table id="tblCekKorektor" class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Nama Ujian</th>
				<th>Tanggal</th>
				<th>Hari</th>
				<th>Keterangan</th>
				</tr>
			</thead>
		<tbody>
			<?php if($cekKorektor): foreach ($cekKorektor as $row): ?>
				<tr>
					<td><?=field_value('master_matakuliah','kode_matakuliah',$row->kode_matakuliah,'nama_matakuliah');?></td>
					<td><?=tanggal_indo($row->tanggal);?></td>
					<td><?=hari_indo($row->tanggal);?></td>
					<td><?=$row->keterangan?></td>
				</tr>
			<?php endforeach; endif; ?>
		</tbody>
	</table>