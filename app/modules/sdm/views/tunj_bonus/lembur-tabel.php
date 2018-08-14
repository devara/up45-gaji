<?php if($jenis == 'all_unit'): ?>
<div class="row">
	<div class="col-md-12">
		<button type="button" id="printAllUnit" class="btn btn-sm btn-primary"><i class="fa fa-print"></i> Cetak</button>
	</div>
</div>
</br>
<div class="allunit_area">
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
			</table>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="table-responsive">
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
								<td><?=tanggal_indo($row->tgl_lembur)?></td>
								<td><?=$row->nama?></td>
								<td><?=$row->jam_mulai?></td>
								<td><?=$row->jam_selesai?></td>
								<td><?=$row->durasi?></td>
								<td><?=$row->keterangan?></td>
							</tr>
						<?php endforeach; endif; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
	
<?php elseif($jenis == 'one_unit'): ?>
<div class="row">
	<div class="col-md-12">
		<button type="button" id="printOneUnit" class="btn btn-sm btn-primary"><i class="fa fa-print"></i> Cetak</button>
	</div>
</div>
</br>
<div class="oneunit_area">
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
					<td>Kode Unit</td>
					<td><?=$unit->row('kode_unit')?></td>
				</tr>
				<tr>
					<td>Nama Unit</td>
					<td><?=$unit->row('nama_unit')?></td>
				</tr>
			</table>		
			<br>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
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
							<td><?=tanggal_indo($row->tgl_lembur)?></td>
							<td><?=$row->nama?></td>
							<td><?=$row->jam_mulai?></td>
							<td><?=$row->jam_selesai?></td>
							<td><?=$row->durasi?></td>
							<td><?=$row->keterangan?></td>
						</tr>
					<?php endforeach; endif; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php elseif($jenis == 'one_person'): ?>
<div class="row">
	<div class="col-md-12">
		<button type="button" id="printOnePerson" class="btn btn-sm btn-primary"><i class="fa fa-print"></i> Cetak</button>
		<a href="" class="btn btn-sm btn-danger" title="PDF"><i class="fa fa-file-pdf-o"></i>&nbsp;Download PDF</a>
	</div>
</div>
<div class="oneperson_area">
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
	</div>
	<div class="row">
		<div class="col-md-12">
			<table id="tblLembur" class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Hari, Tanggal Lembur</th>
						<th>Dari Jam</th>
						<th>Sampai Jam</th>
						<th>Total Jam</th>
						<th>Keterangan</th>
						</tr>
					</thead>
				<tbody>
					<?php if($cekLembur): foreach ($cekLembur as $row): ?>
						<tr>
							<td><?=hari_indo($row->tgl_lembur)?>, <?=tanggal_indo($row->tgl_lembur)?></td>
							<td><?=$row->jam_mulai?></td>
							<td><?=$row->jam_selesai?></td>
							<td><?=$row->durasi?></td>
							<td><?=$row->keterangan?></td>
						</tr>
					<?php endforeach; endif; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php endif; ?>	
<script type="text/javascript">
  $('#printAllUnit').on("click", function () {
    $('.allunit_area').printThis({
     	header: "<h4>Data Lembur Pegawai</h5>",
    });
  });
  $('#printOneUnit').on("click", function () {
    $('.oneunit_area').printThis({
     	header: "<h4>Data Lembur Pegawai</h5>",
    });
  });
  $('#printOnePerson').on("click", function () {
    $('.oneperson_area').printThis({
     	header: "<h4>Data Lembur Pegawai</h5>",
    });
  });
</script>
