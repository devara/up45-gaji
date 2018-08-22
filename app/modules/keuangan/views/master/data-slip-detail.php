<style type="text/css">
	.table td {
		padding: 3px;
	}
</style>
<table class="table table-bordered">
	<tr>
		<td>Periode</td>
		<td align="center">:</td>
		<td><?=$slipgaji->row('bulan')?> <?=$slipgaji->row('tahun')?></td>
	</tr>
	<tr>
		<td>Nama</td>
		<td align="center">:</td>
		<td><?=$slipgaji->row('nama')?></td>
	</tr>
	<tr>
		<td>Jabatan</td>
		<td align="center">:</td>
		<td><?=$this->my_lib->get_row('master_jabatan',array('kode_jabatan'=>$slipgaji->row('kode_jabatan')),'nama_jabatan')?></td>
	</tr>
</table>
<table class="table table-bordered">
	<tr>
		<td colspan="4" align="center"><strong>Penerimaan</strong></td>
	</tr>
	<tr>
		<td>Gaji Pokok</td>
		<td align="center">:</td>
		<td align="center">Rp.</td>
		<td align="right"><?=number_format($slipgaji->row('gaji_pokok'),2,',','.')?></td>
	</tr>
	<tr>
		<td>TGPPW</td>
		<td align="center">:</td>
		<td align="center">Rp.</td>
		<td align="right"><?=number_format($slipgaji->row('tgppw'),2,',','.')?></td>
	</tr>
	<tr>
		<td>TPD</td>
		<td align="center">:</td>
		<td align="center">Rp.</td>
		<td align="right"><?=number_format($slipgaji->row('tpd'),2,',','.')?></td>
	</tr>
	<tr>
		<td>Tunjangan Jabatan</td>
		<td align="center">:</td>
		<td align="center">Rp.</td>
		<td align="right"><?=number_format($slipgaji->row('tunj_jabatan'),2,',','.')?></td>
	</tr>
	<tr>
		<td>Tunjangan Fungsional</td>
		<td align="center">:</td>
		<td align="center">Rp.</td>
		<td align="right"><?=number_format($slipgaji->row('tunj_fungsional'),2,',','.')?></td>
	</tr>
	<tr>
		<td>Tunjangan BPJS</td>
		<td align="center">:</td>
		<td align="center">Rp.</td>
		<td align="right"><?=number_format($slipgaji->row('tunj_bpjs'),2,',','.')?></td>
	</tr>
	<tr>
		<td>Tunjangan SKS</td>
		<td align="center">:</td>
		<td align="center">Rp.</td>
		<td align="right"><?=number_format($slipgaji->row('tunj_sks'),2,',','.')?></td>
	</tr>
	<tr>
		<td>Transport Mengajar</td>
		<td align="center">:</td>
		<td align="center">Rp.</td>
		<td align="right"><?=number_format($slipgaji->row('transport'),2,',','.')?></td>
	</tr>
	<tr>
		<td>Tunjangan Operasional</td>
		<td align="center">:</td>
		<td align="center">Rp.</td>
		<td align="right"><?=number_format($slipgaji->row('tunj_op'),2,',','.')?></td>
	</tr>
	<tr>
		<td>Insentif Operasional</td>
		<td align="center">:</td>
		<td align="center">Rp.</td>
		<td align="right"><?=number_format($slipgaji->row('insentif_op'),2,',','.')?></td>
	</tr>
	<tr>
		<td>Hal Khusus</td>
		<td align="center">:</td>
		<td align="center">Rp.</td>
		<td align="right"><?=number_format($slipgaji->row('hal_khusus'),2,',','.')?></td>
	</tr>
	<tr>
		<td>Rapat</td>
		<td align="center">:</td>
		<td align="center">Rp.</td>
		<td align="right"><?=number_format($slipgaji->row('upah_rapat'),2,',','.')?></td>
	</tr>
	<tr>
		<td>Lembur</td>
		<td align="center">:</td>
		<td align="center">Rp.</td>
		<td align="right"><?=number_format($slipgaji->row('upah_lembur'),2,',','.')?></td>
	</tr>
	<tr>
		<td>Pengawas UTS/UAS</td>
		<td align="center">:</td>
		<td align="center">Rp.</td>
		<td align="right"><?=number_format($slipgaji->row('upah_pengawas'),2,',','.')?></td>
	</tr>
	<tr>
		<td>Korektor UTS/UAS</td>
		<td align="center">:</td>
		<td align="center">Rp.</td>
		<td align="right"><?=number_format($slipgaji->row('upah_korektor'),2,',','.')?></td>
	</tr>
	<tr>
		<td>THR</td>
		<td align="center">:</td>
		<td align="center">Rp.</td>
		<td align="right"><?=number_format(0,2,',','.')?></td>
	</tr>
	<tr>
		<td><strong>Total Penerimaan</strong></td>
		<td align="center">:</td>
		<td align="center">Rp.</td>
		<td align="right"><?=number_format($slipgaji->row('gaji_bruto'),2,',','.')?></td>
	</tr>
	<tr>
		<td colspan="4" align="center"><strong>Potongan</strong></td>
	</tr>
	<tr>
		<td>Biaya Transfer</td>
		<td align="center">:</td>
		<td align="center">Rp.</td>
		<td align="right"><?=number_format($slipgaji->row('biaya_transfer'),2,',','.')?></td>
	</tr>
	<tr>
		<td>BPJS Kesehatan</td>
		<td align="center">:</td>
		<td align="center">Rp.</td>
		<td align="right"><?=number_format($slipgaji->row('pot_bpjs'),2,',','.')?></td>
	</tr>
	<tr>
		<td>Koperasi</td>
		<td align="center">:</td>
		<td align="center">Rp.</td>
		<td align="right"><?=number_format($slipgaji->row('koperasi'),2,',','.')?></td>
	</tr>
	<tr>
		<td>Pinjaman</td>
		<td align="center">:</td>
		<td align="center">Rp.</td>
		<td align="right"><?=number_format($slipgaji->row('pinjaman'),2,',','.')?></td>
	</tr>
	<tr>
		<td><strong>Total Potongan</strong></td>
		<td align="center">:</td>
		<td align="center">Rp.</td>
		<td align="right"><?=number_format($slipgaji->row('jml_potongan'),2,',','.')?></td>
	</tr>
	<tr>
		<td><strong>Gaji Diterima</strong></td>
		<td align="center">:</td>
		<td align="center">Rp.</td>
		<td align="right"><?=number_format($slipgaji->row('gaji_bersih'),2,',','.')?></td>
	</tr>
</table>
