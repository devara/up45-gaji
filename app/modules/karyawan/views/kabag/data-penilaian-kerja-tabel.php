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
		</table>		
		<br>
	</div>
	<table id="tblLembur" class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Nama Pegawai</th>
				<th>40 jam/minggu</th>
				<th>Kedisiplinan</th>
				<th>Loyalitas</th>
				<th>Pelayanan</th>
				<th>Propeka</th>
				<th>Total Nilai</th>
				<th>Rangking</th>
			</tr>
		</thead>
		<tbody>
			<?php if($penilaian): foreach ($penilaian as $row): ?>
				<tr>
					<td><?=$row->nama?></td>
					<td><?=$row->jam?></td>
					<td><?=$row->kedisiplinan?></td>
					<td><?=$row->loyalitas?></td>
					<td><?=$row->pelayanan?></td>
					<td><?=$row->propeka?></td>
					<td><?=$row->total?></td>
					<td><?=$row->ranking?></td>
				</tr>
			<?php endforeach; 
			else: ?>
				<tr>
					<td colspan="8" align="center">Anda belum memberikan penilaian untuk periode ini</td>
				</tr>
			<?php endif; ?>
		</tbody>
	</table>
