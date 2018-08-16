<style type="text/css">
	.table .row{
		margin-bottom: 5px;
	}
</style>
<?php $IDper = $periode->row('id_periode'); ?>
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
	<div class="col-md-6">
		<form method="POST" action="<?=keuangan()?>master/generate_slip/generate">
			<input type="hidden" name="idperiode" value="<?=$periode->row('id_periode')?>">
			<input type="hidden" name="kodeunit" value="<?=$unit->row('kode_unit')?>">
			<button type="button" class="btn btn-lg btn-success" onclick="confSubmit(this.form);"><i class="fa fa-file"></i>&nbsp;&nbsp;Generate Slip Gaji</button>
		</form>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Nama</th>
					<th>Penerimaan</th>
					<th>Potongan</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
			<?php if($pegawai): foreach($pegawai as $peg): ?>
				<tr>
					<td width="300"><?=$peg->nama?></td>
						<?php 
						$param_jam = explode_time('35:00:00');
						$cek_absensi = $this->my_lib->get_data_row('absensi_rekap',array('id_periode'=>$IDper,'nip'=>$peg->nip));						
						if ($cek_absensi) {
							$rerata = explode_time($this->my_lib->get_row('absensi_rekap',array('id_periode'=>$IDper,'nip'=>$peg->nip),'rerata'));
							if ($rerata >= $param_jam) {
								$tpd = $nominal->row('tpd');
							}
							else{
								$tpd = 0;
							}
						}
						else{
							$tpd = 0;
						}
						
						$tunj_jab =  $this->my_lib->get_row('master_jabatan',array('kode_jabatan'=>$peg->kode_jabatan),'tunjangan_jabatan');
						$insentif = $this->my_lib->get_row('data_insentif_op',array('id_periode'=>$periode->row('id_periode'),'nip'=>$peg->nip),'total_insentif');
						$rapat = $this->my_lib->get_row('data_upah_rapat',array('id_periode'=>$periode->row('id_periode'),'nip'=>$peg->nip),'jml_upah');
						$lembur = $this->my_lib->get_row('data_upah_lembur',array('id_periode'=>$periode->row('id_periode'),'nip'=>$peg->nip),'jml_upah');
						$pengawas = $this->my_lib->get_row('data_upah_pengawas',array('id_periode'=>$periode->row('id_periode'),'nip'=>$peg->nip),'jml_upah');
						$korektor = $this->my_lib->get_row('data_upah_korektor',array('id_periode'=>$periode->row('id_periode'),'nip'=>$peg->nip),'jml_upah');
						?>
					<td>
						<div class="row">
							<div class="col-md-5">
								Gaji Pokok
							</div>
							<div class="col-md-1">
								:
							</div>
							<div class="col-md-6">
								Rp. <?=number_format($peg->gaji_pokok,2,',','.')?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-5">
								TGPPW
							</div>
							<div class="col-md-1">
								:
							</div>
							<div class="col-md-6">
								Rp. <?=number_format($peg->tgppw,2,',','.')?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-5">
								TPD
							</div>
							<div class="col-md-1">
								:
							</div>
							<div class="col-md-6">
								Rp. <?=number_format($tpd,2,',','.')?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-5">
								Tunjangan Jabatan
							</div>
							<div class="col-md-1">
								:
							</div>
							<div class="col-md-6">
								Rp. <?php if($tunj_jab!=0) echo number_format($tunj_jab,2,',','.'); else echo "-" ?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-5">
								Tunjangan Fungsional
							</div>
							<div class="col-md-1">
								:
							</div>
							<div class="col-md-6">
								Rp. -
							</div>
						</div>
						<div class="row">
							<div class="col-md-5">
								Tunjangan Operasional
							</div>
							<div class="col-md-1">
								:
							</div>
							<div class="col-md-6">
								Rp. -
							</div>
						</div>
						<div class="row">
							<div class="col-md-5">
								Tunjangan BPJS
							</div>
							<div class="col-md-1">
								:
							</div>
							<div class="col-md-6">
								Rp. <?=number_format($nominal->row('tunjangan_bpjs'),2,',','.')?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-5">
								Tunjangan SKS
							</div>
							<div class="col-md-1">
								:
							</div>
							<div class="col-md-6">
								Rp. -
							</div>
						</div>
						<div class="row">
							<div class="col-md-5">
								Transport Mengajar
							</div>
							<div class="col-md-1">
								:
							</div>
							<div class="col-md-6">
								Rp. -
							</div>
						</div>
						<div class="row">
							<div class="col-md-5">
								Ins. Operasional
							</div>
							<div class="col-md-1">
								:
							</div>
							<div class="col-md-6">
								Rp. <?php if($insentif) echo number_format($insentif,2,',','.'); else echo "-"; ?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-5">
								Hal Khusus
							</div>
							<div class="col-md-1">
								:
							</div>
							<div class="col-md-6">
								Rp. <?=number_format($nominal->row('hal_khusus'),2,',','.')?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-5">
								Rapat
							</div>
							<div class="col-md-1">
								:
							</div>
							<div class="col-md-6">
								Rp. <?php if($rapat) echo number_format($rapat,2,',','.'); else echo "-"; ?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-5">
								Lembur
							</div>
							<div class="col-md-1">
								:
							</div>
							<div class="col-md-6">
								Rp. <?php if($lembur) echo number_format($lembur,2,',','.'); else echo "-"; ?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-5">
								Pengawas Ujian
							</div>
							<div class="col-md-1">
								:
							</div>
							<div class="col-md-6">
								RP. <?php if($pengawas) echo number_format($pengawas,2,',','.'); else echo "-"; ?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-5">
								Korektor Ujian
							</div>
							<div class="col-md-1">
								:
							</div>
							<div class="col-md-6">
								Rp. <?php if($korektor) echo number_format($korektor,2,',','.'); else echo "-"; ?>
							</div>
						</div>
					</td>
					<td>
						<div class="row">
							<div class="col-md-5">
								Biaya Transfer
							</div>
							<div class="col-md-1">
								:
							</div>
							<div class="col-md-6">
								Rp. -
							</div>
						</div>
						<div class="row">
							<div class="col-md-5">
								BPJS Kesehatan
							</div>
							<div class="col-md-1">
								:
							</div>
							<div class="col-md-6">
								Rp. <?php if($peg->bpjs_aktif=='ya') echo number_format($nominal->row('potongan_bpjs'),2,',','.'); else echo "-";?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-5">
								Koperasi
							</div>
							<div class="col-md-1">
								:
							</div>
							<div class="col-md-6">
								Rp. <?php if($peg->koperasi_aktif=='ya') echo number_format($nominal->row('potongan_koperasi'),2,',','.'); else echo "-";?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-5">
								Pinjaman
							</div>
							<div class="col-md-1">
								:
							</div>
							<div class="col-md-6">
								Rp. -
							</div>
						</div>
					</td>
					<td align="center">
						<?php if($this->my_lib->cek('data_slip_gaji',array('id_periode'=>$IDper,'nip'=>$peg->nip)) == TRUE): ?>
							<a class="btn btn-success btn-xs"><i class="fa fa-check"></i>&nbsp;Sudah ada</a>
						<?php else: ?>
							<a class="btn btn-danger btn-xs"><i class="fa fa-close"></i>&nbsp;Belum ada</a>
						<?php endif; ?>
					</td>
				</tr>
			<?php endforeach; endif; ?>
			</tbody>
		</table>
	</div>
</div>
<script type="text/javascript">
function confSubmit(form) {
	swal({
		title: 'Peringatan!',type: 'warning',html: "Apabila data sudah ada, makan hanya akan diperbarui. Apakah Anda sudah yakin?",
		showCancelButton: true,buttonsStyling: false,reverseButtons: true,showLoaderOnConfirm: true,allowOutsideClick: false,
		confirmButtonText: 'Ya!',cancelButtonText: 'Batal!',confirmButtonClass: 'btn btn-success',cancelButtonClass: 'btn btn-danger',
	}).then((result) => {
		if (result.value) {
			form.submit();
		}
	})
}
</script>
