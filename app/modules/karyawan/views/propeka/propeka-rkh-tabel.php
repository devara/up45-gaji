
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

	<table id="tblRKH" class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>No</th>
				<th>Tanggal</th>
				<th>Hari</th>
				<th>Status</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$begin = new DateTime($per->mulai);
			$end = new DateTime($per->akhir);
			$end = $end->modify('+1 day');
			$interval = DateInterval::createFromDateString('1 day');
			$period = new DatePeriod($begin, $interval, $end);
			$no = 1;
			foreach($period as $pe): ?>
			<?php if(hari_indo($pe->format("Y-m-d")) != 'Minggu'): ?>
			<tr>
				<td><?=$no?></td>
				<td><?php echo $this->lib_calendar->convert($pe->format("Y-m-d"));?></td>
				<td><?=hari_indo($pe->format("Y-m-d"))?></td>
				<td>
					<?php $cek = $this->my_lib->get_data('data_rkhlh',array('id_periode'=>$per->id_periode,'nip'=>$peg->nip,'tanggal'=>$pe->format("Y-m-d"))); 
						$id_rkh = $this->my_lib->get_row('data_rkhlh',array('id_periode'=>$per->id_periode,'nip'=>$peg->nip,'tanggal'=>$pe->format("Y-m-d")),'id_rkhlh');
					if($cek): ?>
					<a class="btn btn-xs btn-success">Ada</a> | <a href="<?=$id_rkh?>" class="blue-text">Lihat</a>
					<?php else: ?>
						<a class="btn btn-xs btn-danger">Belum ada</a>
					<?php endif; ?>
				</td>
			</tr>
			<?php $no++; ?>
			<?php endif; ?>
			<?php endforeach; ?>
		</tbody>
	</table>
