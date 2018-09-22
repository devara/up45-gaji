<style type="text/css">
	.table {
    border-collapse: collapse !important;
  }
  .table td,
  .table th {
    background-color: #fff !important;
		padding: 3px;
  }
  .table-bordered th,
  .table-bordered td {
    border: 1px solid #ddd !important;
  }
.table-bordered {
  border: 1px solid #ddd;
}
.table-bordered  > tr > th,
.table-bordered  > tr > td {
  border: 1px solid #ddd;
}
</style>
<table class="table table-bordered" style="border-collapse: collapse !important;border: 1px solid #ddd;">
	<tr style="border: 1px solid #ddd;">
		<td>Periode</td>
		<td align="center">:</td>
		<td><?=$slipgaji->row('bulan')?> <?=$slipgaji->row('tahun')?></td>
	</tr>
	<tr style="border: 1px solid #ddd;">
		<td>Nama</td>
		<td align="center">:</td>
		<td><?=$slipgaji->row('nama')?></td>
	</tr>
	<tr style="border: 1px solid #ddd;">
		<td>Jabatan</td>
		<td align="center">:</td>
		<td><?=$this->my_lib->get_row('master_jabatan',array('kode_jabatan'=>$slipgaji->row('kode_jabatan')),'nama_jabatan')?></td>
	</tr>
</table>
<table class="table table-bordered" style="border-collapse: collapse !important;border: 1px solid #ddd;">
	<tr style="border: 1px solid #ddd;">
		<td colspan="4" align="center"><strong>Penerimaan</strong></td>
	</tr>
	<tr>
		<td style="border: 1px solid #ddd;">Gaji Pokok</td>
		<td style="border: 1px solid #ddd;" align="center">:</td>
		<td style="border: 1px solid #ddd;" align="center">Rp.</td>
		<td style="border: 1px solid #ddd;" align="right"><?=number_format($slipgaji->row('gaji_pokok'),2,',','.')?></td>
	</tr>
	<tr>
		<td style="border: 1px solid #ddd;">TGPPW</td>
		<td style="border: 1px solid #ddd;" align="center">:</td>
		<td style="border: 1px solid #ddd;" align="center">Rp.</td>
		<td style="border: 1px solid #ddd;" align="right"><?=number_format($slipgaji->row('tgppw'),2,',','.')?></td>
	</tr>
	<tr>
		<td style="border: 1px solid #ddd;">TPD</td>
		<td style="border: 1px solid #ddd;" align="center">:</td>
		<td style="border: 1px solid #ddd;" align="center">Rp.</td>
		<td style="border: 1px solid #ddd;" align="right"><?=number_format($slipgaji->row('tpd'),2,',','.')?></td>
	</tr>
	<tr>
		<td>Tunjangan Jabatan</td>
		<td style="border: 1px solid #ddd;"  align="center">:</td>
		<td style="border: 1px solid #ddd;"  align="center">Rp.</td>
		<td style="border: 1px solid #ddd;"  align="right"><?=number_format($slipgaji->row('tunj_jabatan'),2,',','.')?></td>
	</tr>
	<tr>
		<td style="border: 1px solid #ddd;" >Tunjangan Fungsional</td>
		<td style="border: 1px solid #ddd;"  align="center">:</td>
		<td style="border: 1px solid #ddd;"  align="center">Rp.</td>
		<td style="border: 1px solid #ddd;"  align="right"><?=number_format($slipgaji->row('tunj_fungsional'),2,',','.')?></td>
	</tr>
	<tr>
		<td style="border: 1px solid #ddd;" >Tunjangan BPJS</td>
		<td style="border: 1px solid #ddd;"  align="center">:</td>
		<td style="border: 1px solid #ddd;"  align="center">Rp.</td>
		<td style="border: 1px solid #ddd;"  align="right"><?=number_format($slipgaji->row('tunj_bpjs'),2,',','.')?></td>
	</tr>
	<tr>
		<td style="border: 1px solid #ddd;" >Tunjangan SKS</td>
		<td style="border: 1px solid #ddd;"  align="center">:</td>
		<td style="border: 1px solid #ddd;"  align="center">Rp.</td>
		<td style="border: 1px solid #ddd;"  align="right"><?=number_format($slipgaji->row('tunj_sks'),2,',','.')?></td>
	</tr>
	<tr>
		<td style="border: 1px solid #ddd;" >Transport Mengajar</td>
		<td style="border: 1px solid #ddd;"  align="center">:</td>
		<td style="border: 1px solid #ddd;"  align="center">Rp.</td>
		<td style="border: 1px solid #ddd;"  align="right"><?=number_format($slipgaji->row('transport'),2,',','.')?></td>
	</tr>
	<tr>
		<td style="border: 1px solid #ddd;" >Tunjangan Operasional</td>
		<td style="border: 1px solid #ddd;"  align="center">:</td>
		<td style="border: 1px solid #ddd;"  align="center">Rp.</td>
		<td style="border: 1px solid #ddd;"  align="right"><?=number_format($slipgaji->row('tunj_op'),2,',','.')?></td>
	</tr>
	<tr>
		<td style="border: 1px solid #ddd;" >Insentif Operasional</td>
		<td style="border: 1px solid #ddd;"  align="center">:</td>
		<td style="border: 1px solid #ddd;"  align="center">Rp.</td>
		<td style="border: 1px solid #ddd;"  align="right"><?=number_format($slipgaji->row('insentif_op'),2,',','.')?></td>
	</tr>
	<tr>
		<td style="border: 1px solid #ddd;" >Hal Khusus</td>
		<td style="border: 1px solid #ddd;"  align="center">:</td>
		<td style="border: 1px solid #ddd;"  align="center">Rp.</td>
		<td style="border: 1px solid #ddd;"  align="right"><?=number_format($slipgaji->row('hal_khusus'),2,',','.')?></td>
	</tr>
	<tr>
		<td style="border: 1px solid #ddd;" >Rapat</td>
		<td style="border: 1px solid #ddd;"  align="center">:</td>
		<td style="border: 1px solid #ddd;"  align="center">Rp.</td>
		<td style="border: 1px solid #ddd;"  align="right"><?=number_format($slipgaji->row('upah_rapat'),2,',','.')?></td>
	</tr>
	<tr>
		<td style="border: 1px solid #ddd;" >Lembur</td>
		<td style="border: 1px solid #ddd;"  align="center">:</td>
		<td style="border: 1px solid #ddd;"  align="center">Rp.</td>
		<td style="border: 1px solid #ddd;"  align="right"><?=number_format($slipgaji->row('upah_lembur'),2,',','.')?></td>
	</tr>
	<tr>
		<td style="border: 1px solid #ddd;" >Pengawas UTS/UAS</td>
		<td style="border: 1px solid #ddd;"  align="center">:</td>
		<td style="border: 1px solid #ddd;"  align="center">Rp.</td>
		<td style="border: 1px solid #ddd;"  align="right"><?=number_format($slipgaji->row('upah_pengawas'),2,',','.')?></td>
	</tr>
	<tr>
		<td style="border: 1px solid #ddd;" >Korektor UTS/UAS</td>
		<td style="border: 1px solid #ddd;"  align="center">:</td>
		<td style="border: 1px solid #ddd;"  align="center">Rp.</td>
		<td style="border: 1px solid #ddd;"  align="right"><?=number_format($slipgaji->row('upah_korektor'),2,',','.')?></td>
	</tr>
	<tr>
		<td style="border: 1px solid #ddd;" >THR</td>
		<td style="border: 1px solid #ddd;"  align="center">:</td>
		<td style="border: 1px solid #ddd;"  align="center">Rp.</td>
		<td style="border: 1px solid #ddd;"  align="right"><?=number_format(0,2,',','.')?></td>
	</tr>
	<tr>
		<td style="border: 1px solid #ddd;" ><strong>Total Penerimaan</strong></td>
		<td style="border: 1px solid #ddd;"  align="center">:</td>
		<td style="border: 1px solid #ddd;"  align="center">Rp.</td>
		<td style="border: 1px solid #ddd;"  align="right"><?=number_format($slipgaji->row('gaji_bruto'),2,',','.')?></td>
	</tr>
	<tr>
		<td colspan="4" align="center"><strong>Potongan</strong></td>
	</tr>
	<tr>
		<td style="border: 1px solid #ddd;" >Biaya Transfer</td>
		<td style="border: 1px solid #ddd;"  align="center">:</td>
		<td style="border: 1px solid #ddd;"  align="center">Rp.</td>
		<td style="border: 1px solid #ddd;"  align="right"><?=number_format($slipgaji->row('biaya_transfer'),2,',','.')?></td>
	</tr>
	<tr>
		<td style="border: 1px solid #ddd;" >BPJS Kesehatan</td>
		<td style="border: 1px solid #ddd;"  align="center">:</td>
		<td style="border: 1px solid #ddd;"  align="center">Rp.</td>
		<td style="border: 1px solid #ddd;"  align="right"><?=number_format($slipgaji->row('pot_bpjs'),2,',','.')?></td>
	</tr>
	<tr>
		<td>Koperasi</td>
		<td style="border: 1px solid #ddd;"  align="center">:</td>
		<td style="border: 1px solid #ddd;"  align="center">Rp.</td>
		<td style="border: 1px solid #ddd;"  align="right"><?=number_format($slipgaji->row('koperasi'),2,',','.')?></td>
	</tr>
	<tr>
		<td style="border: 1px solid #ddd;" >Pinjaman</td>
		<td style="border: 1px solid #ddd;"  align="center">:</td>
		<td style="border: 1px solid #ddd;"  align="center">Rp.</td>
		<td align="right"><?=number_format($slipgaji->row('pinjaman'),2,',','.')?></td>
	</tr> 
	<tr>
		<td style="border: 1px solid #ddd;" ><strong>Total Potongan</strong></td>
		<td style="border: 1px solid #ddd;"  align="center">:</td>
		<td style="border: 1px solid #ddd;"  align="center">Rp.</td>
		<td style="border: 1px solid #ddd;"  align="right"><?=number_format($slipgaji->row('jml_potongan'),2,',','.')?></td>
	</tr>
	<tr>
		<td><strong>Gaji Diterima</strong></td>
		<td style="border: 1px solid #ddd;"  align="center">:</td>
		<td style="border: 1px solid #ddd;"  align="center">Rp.</td>
		<td style="border: 1px solid #ddd;"  align="right"><?=number_format($slipgaji->row('gaji_bersih'),2,',','.')?></td>
	</tr>
</table>
