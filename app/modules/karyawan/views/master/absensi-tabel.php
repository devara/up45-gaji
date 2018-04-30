	<div class="col-md-7">
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
	<div class="col-md-5">
		<button type="button" id="printAbsensi" class="btn btn-sm btn-primary"><i class="fa fa-print"></i> Cetak</button>
	</div>
<div class="printArea">
	<table id="tblabsensi" class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Tanggal</th>
				<th>Hari</th>
				<th>Time IN</th>
				<th>Time OUT</th>
				<th>Lama Kerja</th>
				<th>Keterangan</th>
				</tr>
			</thead>
		<tbody>
			<?php if($absensi): foreach ($absensi as $row): ?>
				<tr>
					<td><?=$row->tanggal?></td>
					<td><?=$row->hari?></td>
					<td><?=$row->datang?></td>
					<td><?=$row->pulang?></td>
					<td><?=$row->lama_kerja?></td>
					<td><?=$row->keterangan?></td>
				</tr>
			<?php endforeach; endif; ?>
		</tbody>
	</table>
</div>
<script type="text/javascript">
	$('#printAbsensi').on("click", function () {
      $('.printArea').printThis({
      	header: "<h4>Data Absensi <?php echo $this->session->userdata('nama'); ?></h4><br/><h5><?php echo "".$per->bulan." ".$per->tahun." ( ".$mulai." - ".$akhir." )"; ?></h5>",
      });
    });
</script>