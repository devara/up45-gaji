<div class="row">
	<div class="col-md-12">
		<form id="demo-form" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="<?=karyawan()?>kabag/insentif_op/input_insentif">
			<input type="hidden" name="periode" value="<?=$periode->row('id_periode')?>">
			<input type="hidden" name="jabatan" value="<?=$this->session->userdata('jabatan')?>">
			<table class="table table-striped table-bordered">
			<?php foreach($pegawai as $peg): ?>
				<tr>
					<td>
						<input type="hidden" name="nip[]" value="<?=$peg->nip?>">
						<input type="hidden" name="kd_unit[]" value="<?=$peg->kode_unit?>">
						<?=$peg->nama?><br>( <?=$peg->nama_jabatan?> )
					</td>
					<td>
						<input type="number" name="penilaian[]" class="form-control" placeholder="penilaian" required=""><br>
						<p>Keterangan: Ranking <?=$this->my_lib->get_row('data_penilaian',array('id_periode'=>$periode->row('id_periode'),'nip'=>$peg->nip),'ranking')?></p>
					</td>
					<td>
						<input type="number" name="tepatwaktu[]" class="form-control" placeholder="tepat waktu" required=""><br>
						<p>Keterangan: <?=$this->my_lib->get_row('absensi_rekap',array('id_periode'=>$periode->row('id_periode'),'nip'=>$peg->nip),'tepat_waktu')?> kali</p>
					</td>
					<td><input type="number" name="propeka[]" class="form-control" placeholder="propeka" required=""></td>
					<td><input type="number" name="mt[]" class="form-control" placeholder="MT" required=""></td>
				</tr>
			<?php endforeach; ?>
			</table>
			<div class="form-group">
				<div class="col-md-4">
					<button type="submit" id="btnSubmit" class="btn btn-sm btn-primary">Simpan Insentif Operasional</button>
				</div>
			</div>
		</form>
	</div>
</div>
