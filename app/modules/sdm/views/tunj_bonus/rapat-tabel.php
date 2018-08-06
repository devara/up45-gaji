<?php if($jenis=='multiple'): ?>
<div class="row">
	<div class="col-md-12">
		<button type="button" id="printAll" class="btn btn-sm btn-primary"><i class="fa fa-print"></i> Cetak</button>
		<a href="" class="btn btn-sm btn-danger" title="PDF"><i class="fa fa-file-pdf-o"></i>&nbsp;Download PDF</a>
	</div>
</div>
<br>
<div class="all_area">
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
			<table id="tblCekRapat" class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Hari, Tanggal</th>
						<th>Nama Rapat</th>
						<th>Peserta</th>
						<th>Keterangan</th>
					</tr>
				</thead>
				<tbody>
					<?php if($rapat): foreach ($rapat as $row): ?>
						<tr>
							<td><?=hari_indo($row->tanggal_rapat)?>, <?=tanggal_indo($row->tanggal_rapat)?></td>
							<td><?=$row->nama_rapat?></td>
							<td>
							<?php $peserta = $this->my_lib->get_data('data_rapat_peserta',array('id_rapat'=>$row->id_rapat));
								if ($peserta): ?>
									<ul>
									<?php foreach ($peserta as $pe) { ?>
										<li><?=field_value('data_pegawai','nip',$pe->nip,'nama')?></li>
									<?php	} ?>
								 	</ul>
								<?php else: ?>
									Belum di input
							<?php endif; ?>
							</td>
							<td><?=$row->keterangan?></td>
						</tr>
					<?php endforeach; endif; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php else: ?>
<div class="row">
	<div class="col-md-12">
		<button type="button" id="printOnePerson" class="btn btn-sm btn-primary"><i class="fa fa-print"></i> Cetak</button>
		<a href="" class="btn btn-sm btn-danger" title="PDF"><i class="fa fa-file-pdf-o"></i>&nbsp;Download PDF</a>
	</div>
</div>
<br>
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
					<td width="100px">NIP</td>
					<td><?=$pegawai->row('nip')?></td>
				</tr>
				<tr>
					<td width="100px">Nama</td>
					<td><?=$pegawai->row('nama')?></td>
				</tr>
			</table>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Hari, Tanggal</th>
						<th>Nama Rapat</th>
						<th>Keterangan</th>
						</tr>
					</thead>
				<tbody>
					<?php if($rapat): foreach ($rapat as $row): ?>
						<tr>
							<td><?=hari_indo($row->tanggal_rapat)?>, <?=tanggal_indo($row->tanggal_rapat)?></td>
							<td><?=$row->nama_rapat?></td>
							<td><?=$row->keterangan?></td>
						</tr>
					<?php endforeach;
					else: ?>
						<tr>
							<td colspan="3" align="center">Belum ada data</td>
						</tr>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php endif; ?>
