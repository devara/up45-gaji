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
</div>
<div class="row">
	<div class="col-md-12">
		<p style="color: red;">Note: Apabila data alamat email tidak ada, maka pengiriman email akan gagal.</p>
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Nama</th>
					<th>Email</th>
					<th>Penerimaan</th>
					<th>Potongan</th>
					<th>Gaji Bersih</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
			<?php if($pegawai): foreach($pegawai as $peg):
			$slip = $this->my_lib->get_data_row('data_slip_gaji',array('id_periode'=>$IDper,'nip'=>$peg->nip)); ?>
				<tr>
				<?php if($slip): ?>
					<td><?=$peg->nama?></td>
					<td><?=$peg->email?></td>
					<td><?=$slip->row('gaji_bruto')?></td>
					<td><?=$slip->row('jml_potongan')?></td>
					<td><?=$slip->row('gaji_bersih')?></td>
					<td align="center">
						<a class="btn btn-success btn-xs" onclick="tampil_detail(<?=$slip->row('id_slip_gaji')?>)" data-toggle="modal" data-target="#ModalDetail"><i class="fa fa-eye"></i>&nbsp;Detail</a>
						<a class="btn btn-warning btn-xs"><i class="fa fa-envelope"></i>&nbsp;Kirim Email</a>
					</td>
				<?php else: ?>
					<td><?=$peg->nama?></td>
					<td colspan="5" align="center">Belum ada data</td>
				<?php endif; ?>
				</tr>
			<?php endforeach; endif; ?>
			</tbody>
		</table>
	</div>
</div>
	<div class="modal fade bs-example-modal-md" id="ModalDetail" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
	        </button>
	        <h4 class="modal-title" id="myModalLabel">Detail Slip Gaji</h4>
	      </div>
	      <div class="modal-body">
	      	<div id="loading-detail"></div>
	      	<div id="detail_slip">
	      		
	      	</div>
	      </div>
			</div>
		</div>
	</div>
