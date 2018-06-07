<?php if($status == 1): ?>
<h4>Laporan Harian untuk tanggal <?php echo $this->lib_calendar->convert($tanggal);?></h4>
<form method="POST" action="<?=karyawan()?>propeka/lh/buat_lh">
	<input type="hidden" name="tanggal" value="<?=$tanggal?>">
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th rowspan="2" class="text-center" style="vertical-align: middle;">No</th>
				<th rowspan="2" class="text-center" style="vertical-align: middle;">Kegiatan</th>
				<th colspan="2" class="text-center" style="vertical-align: middle;">Rencana (jam)</th>
				<th colspan="2" class="text-center" style="vertical-align: middle;">Realisasi (jam)</th>
				<th rowspan="2" class="text-center" style="vertical-align: middle;">Keterangan</th>
			</tr>
			<tr>
				<th class="text-center">Dari</th>
				<th class="text-center">Sampai</th>
				<th class="text-center" style="vertical-align: middle;">Dari</th>
				<th class="text-center" style="vertical-align: middle;">Sampai</th>
			</tr>
		</thead>
		<tbody>
		<?php $no=1; foreach($detail as $row): ?>
			<tr>
				<input type="hidden" name="id[]" value="<?=$row->id_rkhlh_detail?>">
				<td><?=$no?></td>
				<td><?=$row->kegiatan?></td>
				<td align="center"><?=$row->dari?></td>
				<td align="center"><?=$row->sampai?></td>
				<td width="100px"><input type="number" min="8" max="21" name="lh_mulai[]" class="form-control" required="required"></td>
				<td width="100px"><input type="number" name="lh_sampai[]" class="form-control" required="required"></td>
				<td><textarea name="ket[]" class="form-control" required="required"></textarea></td>
			</tr>
		<?php $no++; endforeach; ?>
		</tbody>
	</table>
	<div class="pull-right">
		<button type="submit" class="btn btn-sm btn-success">Submit LH</button>
	</div>
</form>
<?php elseif($status == 2): ?>
<div class="col-md-offset-2 col-md-5">
	<div class="alert alert-success alert-dismissable">
	  <button type="button" class="close" data-dismiss="alert">&times;</button>
	  <h4>Perhatian</h4>
	  Laporan Harian (LH) untuk tanggal <?php echo $this->lib_calendar->convert($tanggal);?> sudah Anda buat
	</div>
	
</div>
<?php else: ?>
<div class="col-md-offset-2 col-md-5">
	<div class="alert alert-danger alert-dismissable">
	  <button type="button" class="close" data-dismiss="alert">&times;</button>
	  <h4>Perhatian</h4>
	  Anda belum membuat Rencana Kerja Harian (RKH) untuk tanggal <?php echo $this->lib_calendar->convert($tanggal);?>
	</div>
	
</div>
<?php endif; ?>
