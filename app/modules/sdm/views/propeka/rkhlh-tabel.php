
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
					<?php 
					$mulai = $this->lib_calendar->convert($periode->row('mulai'));
					$akhir = $this->lib_calendar->convert($periode->row('akhir')); ?>
					<?php echo "".$periode->row('bulan')." ".$periode->row('tahun')." ( ".$mulai." - ".$akhir." )"; ?>
					
				</td>
			</tr>
		</table>
	</div>

	<div class="col-md-12">
		<table id="tblRKH" class="table table-striped table-bordered">
			<thead>
				<tr>
					<th rowspan="2" class="text-center" style="vertical-align: middle;">No</th>
					<th rowspan="2" class="text-center" style="vertical-align: middle;">Tanggal</th>
					<th rowspan="2" class="text-center" style="vertical-align: middle;">Hari</th>
					<th colspan="2" class="text-center" style="vertical-align: middle;">Rencana Kerja</th>
					<th colspan="2" class="text-center" style="vertical-align: middle;">Laporan</th>
				</tr>
				<tr>
					<th class="text-center" style="vertical-align: middle;">Status</th>
					<th class="text-center" style="vertical-align: middle;">Tanggal Buat</th>
					<th class="text-center" style="vertical-align: middle;">Status</th>
					<th class="text-center" style="vertical-align: middle;">Tanggal Buat</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$begin = new DateTime($periode->row('mulai'));
				$end = new DateTime($periode->row('akhir'));
				$end = $end->modify('+1 day');
				$interval = DateInterval::createFromDateString('1 day');
				$period = new DatePeriod($begin, $interval, $end);
				$no = 1;
				foreach($period as $pe): ?>
				<?php if(hari_indo($pe->format("Y-m-d")) != 'Minggu'): ?>
				<tr>
					<td><?=$no?></td>
					<td><?php echo $this->lib_calendar->convert($pe->format("Y-m-d"));?></td>
					<td><?=hari_indo($pe->format("Y-m-d"))?></td>
					<?php $cek_rkh = $this->my_lib->get_data_row('data_rkhlh',array('id_periode'=>$periode->row('id_periode'),'tanggal'=>$pe->format("Y-m-d"),'nip'=>$pegawai->row('nip'))); ?>
					<?php if($cek_rkh): $id_rkhlh = $cek_rkh->row('id_rkhlh'); ?>
						
						<td align="center">
							<a class="btn btn-xs btn-primary">Ada</a>&nbsp;<a class="btn btn-warning btn-xs" onclick="tampil_rkh(<?=$id_rkhlh?>)" data-toggle="modal" data-target="#Modalrkh"><i class="fa fa-search"></i>&nbsp;Lihat</a>
						</td>
						<td>
							<?=tanggal_indo($cek_rkh->row('tgl_buat_rkh'))?>
						</td>
						<?php $cek_lh = $this->my_lib->cek('data_rkhlh_detail',array('id_rkhlh'=>$id_rkhlh,'rkh_lh_lengkap'=>'tidak')); ?>
						<?php if($cek_lh == TRUE): ?>
							<td align="center">
								<a class="btn btn-sm btn-danger">Belum ada</a>
							</td>
							<td> - </td>
						<?php else: ?>
							<td align="center">
								<a class="btn btn-xs btn-primary">Ada</a>&nbsp;<a class="btn btn-warning btn-xs" onclick="tampil_detail(<?=$id_rkhlh?>)" data-toggle="modal" data-target="#ModalLihat"><i class="fa fa-search"></i>&nbsp;Lihat</a>
							</td>
							<td>
								<?=tanggal_indo($cek_rkh->row('tgl_buat_lh'))?>
							</td>
						<?php endif; ?>
						
					<?php else: ?>
						<td colspan="4" align="center">Belum ada data</td>
					<?php endif; ?>
					
				</tr>
				<?php $no++; ?>
				<?php endif; ?>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>

	<div class="modal fade bs-example-modal-md" id="Modalrkh" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
	        </button>
	        <h4 class="modal-title" id="rkhlabel">Lihat Rencana Kerja Harian</h4>
	      </div>
	      <div class="modal-body">
	      	<div id="loading-rkh"></div>
	      	<div id="detailRKH">
	      		
	      	</div>
	      </div>
			</div>
		</div>
	</div>
	<div class="modal fade bs-example-modal-md" id="ModalLihat" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
	        </button>
	        <h4 class="modal-title" id="myModalLabel">Lihat Laporan Kerja Harian</h4>
	      </div>
	      <div class="modal-body">
	      	<div id="loading-detail"></div>
	      	<div id="detailLH">
	      		
	      	</div>
	      </div>
			</div>
		</div>
	</div>
