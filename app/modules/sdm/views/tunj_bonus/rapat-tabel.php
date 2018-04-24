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
	<table id="tblCekRapat" class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Tanggal</th>
				<th>Nama Rapat</th>
				<th>Keterangan</th>
				</tr>
			</thead>
		<tbody>
			<?php if($cekRapat): foreach ($cekRapat as $row): ?>
				<tr>
					<td><?=$row->tanggal_rapat?></td>
					<td><?=$row->nama_rapat?></td>
					<td><?=$row->keterangan?></td>
				</tr>
			<?php endforeach; endif; ?>
		</tbody>
	</table>