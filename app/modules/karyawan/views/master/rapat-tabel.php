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
				<tr>
					<td>NIP</td>
					<td><?=$pegawai->row('nip')?></td>
				</tr>
				<tr>
					<td>Nama</td>
					<td><?=$pegawai->row('nama')?></td>
				</tr>
				<tr>
					<td>Periode</td>
					<td>
						<?php	$mulai = $this->lib_calendar->convert($periode->row('mulai'));
						$akhir = $this->lib_calendar->convert($periode->row('akhir')); ?>
						<?php echo "".$periode->row('bulan')." ".$periode->row('tahun')." ( ".$mulai." - ".$akhir." )"; ?>
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
						<th>Hari, Tanggal</th>
						<th>Nama Rapat</th>
						<th>Keterangan</th>
						<th>Upah Rapat</th>
					</tr>
				</thead>
				<tbody>
					<?php if($cekRapat): foreach ($cekRapat as $row): ?>
						<tr>
							<td><?=hari_indo($row->tanggal_rapat);?>, <?=tanggal_indo($row->tanggal_rapat);?></td>
							<td><?=$row->nama_rapat?></td>
							<td><?=$row->keterangan?></td>
							<td align="right">Rp. <?=number_format($nominal->row('rapat'),2,',','.')?></td>
						</tr>
					<?php endforeach; ?>
						<tr>
							<td colspan="3" align="center">Total Upah</td>
							<td align="right">Rp. <?=number_format($this->my_lib->get_row('data_upah_rapat',array('id_periode'=>$periode->row('id_periode'),'nip'=>$pegawai->row('nip')),'jml_upah'),2,',','.')?> </td>
						</tr>
					<?php else: ?>
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
