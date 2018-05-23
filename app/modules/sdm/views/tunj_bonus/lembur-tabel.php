<?php if($jenis == 'all_unit'): ?>
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
<?php elseif($jenis == 'one_unit'): ?>
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
			<?php foreach ($unit as $un) { ?>
			<tr>
				<td>Kode Unit</td>
				<td><?=$un->kode_unit?></td>
			</tr>
			<tr>
				<td>Nama Unit</td>
				<td><?=$un->nama_unit?></td>
			</tr>
			<?php } ?>			
		</table>		
		<br>
	</div>
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
<?php elseif($jenis == 'one_person'): ?>
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
	<table id="tblLembur" class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Tanggal Lembur</th>
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
					<td><?=$row->jam_mulai?></td>
					<td><?=$row->jam_selesai?></td>
					<td><?=$row->durasi?></td>
					<td><?=$row->keterangan?></td>
				</tr>
			<?php endforeach; endif; ?>
		</tbody>
	</table>
<?php endif; ?>	
