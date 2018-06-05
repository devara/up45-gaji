<div class="row">
	<div class="col-md-12">
		<button type="button" id="printAbsensi" class="btn btn-sm btn-primary"><i class="fa fa-print"></i> Cetak</button>
	</div>
</div>
</br>
<div class="printArea">
	<div class="row">
		<div class="col-md-5">
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
	</div>
	<div class="row">
		<div class="col-md-12">
			<table id="tblCekRapat" class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Tanggal</th>
						<th>Hari</th>
						<th>Kode Mata Kuliah</th>
						<th>Nama Mata Kuliah</th>
						<th>Tipe Ujian</th>
					</tr>
				</thead>
				<tbody>
					<?php if($cekData): foreach ($cekData as $row): ?>
						<tr>
							<td><?=tanggal_indo($row->tanggal);?></td>
							<td><?=hari_indo($row->tanggal);?></td>
							<td><?=$row->kode_matakuliah?></td>
							<td><?=$row->nama_matakuliah?></td>
							<td style="text-transform: uppercase;"><?=$row->tipe?></td>
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
</div>
<script type="text/javascript">
	$('#printAbsensi').on("click", function () {
      $('.printArea').printThis({
      	header: "<h4>Data Rapat Pegawai</h5>",
      });
    });
</script>
