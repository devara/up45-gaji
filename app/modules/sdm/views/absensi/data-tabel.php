<?php if ($jenis == 'multiple') { ?>
<div class="row">
	<div class="col-md-12">
		<button type="button" id="printAllAbsensi" class="btn btn-sm btn-primary"><i class="fa fa-print"></i> Cetak</button>
	</div>
</div>
</br>
<div class="printAllArea">
	<div class="row">
		<div class="col-md-6">
			<table class="table table-striped table-bordered">
				<tr>
					<td>Periode</td>
					<td>
						<?php 
						$mulai = $this->lib_calendar->convert($periode->row('mulai'));
						$akhir = $this->lib_calendar->convert($periode->row('akhir')); ?>
						<?php echo "".$periode->row('bulan')." ".$periode->row('tahun')." ( ".$mulai." - ".$akhir." )"; ?>
					</td>
				</tr>
				<tr>
					<td>Unit Kerja</td>
					<td><?=$unit->row('nama_unit')?></td>
				</tr>
			</table>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<table id="tblAllAbsensi" class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Tanggal</th>
						<th>Hari</th>
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
							<td><?=tanggal_indo($row->tanggal)?></td>
							<td><?=$row->hari?></td>
							<td><?=$row->nama?></td>
							<td><?=$row->datang?></td>
							<td><?=$row->pulang?></td>
							<td><?=$row->lama_kerja?></td>
							<td><?=$row->keterangan?></td>
						</tr>
					<?php endforeach; endif; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
	
<?php } else { ?>
<div class="row">
	<div class="col-md-12">
		<button type="button" id="printAbsensi" class="btn btn-sm btn-primary"><i class="fa fa-print"></i> Cetak</button>
		<a href="<?=sdm()?>absensi/data/absensi_pdf?per=<?=$id_per?>&nip=<?=$nip?>&time=<?=time()?>" class="btn btn-sm btn-danger" title="PDF"><i class="fa fa-file-pdf-o"></i>&nbsp;Download PDF</a>
	</div>
</div>
<div class="printArea">
<div class="row">
	<div class="col-md-6">
		<table class="table table-striped table-bordered">
			<tr>
				<td>Periode</td>
				<td>
				<?php 
					$mulai = $this->lib_calendar->convert($periode->row('mulai'));
					$akhir = $this->lib_calendar->convert($periode->row('akhir')); ?>
				<?php echo "".$periode->row('bulan')." ".$periode->row('tahun')." ( ".$mulai." - ".$akhir." )"; ?>
				</td>
			</tr>
			<tr>
				<td>NIP</td>
				<td><?=$pegawai->row('nip')?></td>
			</tr>
			<tr>
				<td>Nama</td>
				<td><?=$pegawai->row('nama')?></td>
			</tr>
		</table>
	</div>
	<div class="col-md-6">
		<table class="table table-striped table-bordered">
		<?php if($rekap): ?>
			<?php
			$total_jam = explode(':', $rekap->row('total_jam'));
			$rerata = explode(':', $rekap->row('rerata'));
			$jam = $total_jam[0];
			$menit = $total_jam[1];
			$detik = $total_jam[2];
			$jam1 = $rerata[0];
			$menit1 = $rerata[1];
			$detik1 = $rerata[2];
			?>
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
				<td><?=$rekap->row('tepat_waktu')?> kali</td>
			</tr>
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
	<div class="col-md-12">
		<div class="table-responsive">
			<table id="tblabsensi2" class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>No</th>
						<th>Tanggal</th>
						<th>Hari</th>
						<th>Time IN</th>
						<th>Time OUT</th>
						<th>Lama Kerja</th>
						<th>Keterangan</th>
						</tr>
					</thead>
				<tbody>
					<?php if($absensi): $no = 1; foreach ($absensi as $row): ?>
						<tr>
							<td><?=$no?></td>
							<td><?=tanggal_indo($row->tanggal)?></td>
							<td><?=$row->hari?></td>
							<td><?=$row->datang?></td>
							<td><?=$row->pulang?></td>
							<td><?=$row->lama_kerja?></td>
							<td><?=$row->keterangan?></td>
						</tr>
					<?php $no++; endforeach; endif; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
</div>
	
<?php } ?>

<script type="text/javascript">
	$('#printAbsensi').on("click", function () {
    $('.printArea').printThis({
     	header: "<h4>Data Absensi Pegawai</h5>",
    });
  });
  $('#printAllAbsensi').on("click", function () {
    $('.printAllArea').printThis({
     	header: "<h4>Data Absensi Pegawai</h5>",
    });
  });
</script>
