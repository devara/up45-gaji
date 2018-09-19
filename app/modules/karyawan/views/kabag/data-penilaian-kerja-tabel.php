<div class="printArea">
<form method="POST" action="<?=karyawan()?>kabag/penilaian_kerja/edit_penilaian">
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
						<th>Nama Pegawai</th>
						<th>40 jam/minggu</th>
						<th>Kedisiplinan</th>
						<th>Loyalitas</th>
						<th>Pelayanan</th>
						<th>Propeka</th>
						<th>Total Nilai</th>
						<th>Rangking</th>
					</tr>
				</thead>
				<tbody>
					<?php if($penilaian): foreach ($penilaian as $row): ?>
						<tr>
							<td><?=$row->nama?> <input type="hidden" name="nip[]" value="<?=$row->nip?>"> </td>
							<td><input type="number" class="form-control" name="jam[]" value="<?=$row->jam?>"></td>
							<td><input type="number" class="form-control" name="disiplin[]" value="<?=$row->kedisiplinan?>"></td>
							<td><input type="number" class="form-control" name="loyalitas[]" value="<?=$row->loyalitas?>"></td>
							<td><input type="number" class="form-control" name="pelayanan[]" value="<?=$row->pelayanan?>"></td>
							<td><input type="number" class="form-control" name="propeka[]" value="<?=$row->propeka?>"></td>
							<td><?=$row->total?></td>
							<td><?=$row->ranking?></td>
						</tr>
					<?php endforeach; ?>
						<tr>
							<td colspan="8" align="center"><button type="submit" class="btn btn-success">Perbarui</button></td>
						</tr>
					<?php else: ?>
						<tr>
							<td colspan="8" align="center">Anda belum memberikan penilaian untuk periode ini</td>
						</tr>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
	</div>
</form>
</div>
	
<script type="text/javascript">
	$('#printAbsensi').on("click", function () {
      $('.printArea').printThis({
      	header: "<h4>Data Penilaian Pegawai</h5>",
      });
    });
</script>
