<div class="row">
	<div class="col-md-6">
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
			<tr>
				<td>Tanggal Buat Checklist</td>
				<td>
					<?php if($checklist): 
					echo $checklist->row('tgl_buat_checklist'); ?>						
					<?php else: ?>
						-
					<?php endif; ?>
				</td>
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
						<th rowspan="2" class="text-center" style="vertical-align: middle;">Kegiatan</th>
						<th colspan="2" class="text-center" style="vertical-align: middle;">Checklist (Tanggal)</th>
						<th rowspan="2" class="text-center" style="vertical-align: middle;">Keterangan</th>
					</tr>
					<tr>
						<th class="text-center" style="vertical-align: middle;">Dari</th>
						<th class="text-center" style="vertical-align: middle;">Sampai</th>
					</tr>
					</thead>
				<tbody>
					<?php if($checklist): $detail = $this->my_lib->get_data('data_checklist_laporan_bulanan_detail',array('id_cb_lb'=>$checklist->row('id_cb_lb'))); foreach($detail as $row): ?>
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
	


