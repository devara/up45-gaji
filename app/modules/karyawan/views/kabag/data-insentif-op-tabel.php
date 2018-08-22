<div class="printArea">
<form method="POST" action="<?=karyawan()?>kabag/insentif_op/edit_insentif">
	<input type="hidden" name="periode" value="<?=$periode->row('id_periode')?>">
	<div class="row">
		<div class="col-md-6">
			<table class="table table-striped table-bordered">
				<tr>
					<td>Periode</td>
					<td>
					<?php	$mulai = $this->lib_calendar->convert($periode->row('mulai'));
						$akhir = $this->lib_calendar->convert($periode->row('akhir')); ?>
						<?php echo "".$periode->row('bulan')." ".$periode->row('tahun')." ( ".$mulai." - ".$akhir." )"; ?>
					</td>
				</tr>		
			</table>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<table id="tblLembur" class="table table-striped table-bordered">
				<thead>
					<tr>
						<th width="200">Nama Karyawan</th>
						<th>Ins. Penilaian</th>
						<th>Ins. Tepat Waktu</th>
						<th>Ins. Propeka</th>
						<th>Ins. MT</th>
						<th>Total</th>
					</tr>
				</thead>
				<tbody>
					<?php if($insentif): foreach ($insentif as $row): ?>
						<tr>
							<td><?=$row->nama?> <input type="hidden" name="nip[]" value="<?=$row->nip?>"> </td>
							<td><input type="number" class="form-control" name="penilaian[]" value="<?=$row->ins_penilaian?>"></td>
							<td><input type="number" class="form-control" name="tepatwaktu[]" value="<?=$row->ins_tepat_waktu?>"></td>
							<td><input type="number" class="form-control" name="propeka[]" value="<?=$row->ins_propeka?>"></td>
							<td><input type="number" class="form-control" name="mt[]" value="<?=$row->ins_mt?>"></td>
							<td><?=$row->total_insentif?></td>
						</tr>
					<?php endforeach; ?>
						<tr>
							<td colspan="6" align="center"><button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Perbarui</button></td>
						</tr>
					<?php else: ?>
						<tr>
							<td colspan="6" align="center">Anda belum memberikan insentif operasional untuk periode ini</td>
						</tr>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
	</div>
</form>
</div>
