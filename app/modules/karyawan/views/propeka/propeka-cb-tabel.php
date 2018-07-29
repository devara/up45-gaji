<div class="row">
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
			<tr>
				<td>Tanggal Buat Checklist</td>
				<td><?=$tgl_buat?></td>
			</tr>
		</table>		
		<br>
	</div>
</div>
<div class="row">
		<div class="col-md-12">
			<table id="tblchecklist" class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Kegiatan</th>
						<th>Dari Tanggal</th>
						<th>Sampai Tanggal</th>
						<th>Keterangan</th>
						</tr>
					</thead>
				<tbody>
					<?php if($checklist): foreach ($checklist as $row): ?>
						<tr>
							<td><?=$row->kegiatan?></td>
							<td><?=tanggal_indo($row->cb_tgl_mulai);?></td>
							<td><?=tanggal_indo($row->cb_tgl_selesai);?></td>
							<td><?=$row->keterangan?></td>
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
	


