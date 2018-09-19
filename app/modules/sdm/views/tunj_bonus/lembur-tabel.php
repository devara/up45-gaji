<?php if($jenis == 'all_unit'): ?>
<div class="row">
	<div class="col-md-12">
		<button type="button" id="printAllUnit" class="btn btn-sm btn-primary"><i class="fa fa-print"></i> Cetak</button>
	</div>
</div>
</br>
<div class="allunit_area">
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
			</table>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="table-responsive">
				<table id="tblLembur" class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>Tanggal Lembur</th>
							<th>Nama Pegawai</th>
							<th>Dari Jam</th>
							<th>Sampai Jam</th>
							<th>Total Jam</th>
							<th>Keterangan</th>
							</tr>
						</thead>
					<tbody>
						<?php if($cekLembur): foreach ($cekLembur as $row): ?>
							<tr>
								<td><?=tanggal_indo($row->tgl_lembur)?></td>
								<td><?=$row->nama?></td>
								<td><?=$row->jam_mulai?></td>
								<td><?=$row->jam_selesai?></td>
								<td><?=$row->durasi?></td>
								<td><?=$row->keterangan?></td>
							</tr>
						<?php endforeach; endif; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
	
<?php elseif($jenis == 'one_unit'): ?>
<div class="row">
	<div class="col-md-12">
		<button type="button" id="printOneUnit" class="btn btn-sm btn-primary"><i class="fa fa-print"></i> Cetak</button>
	</div>
</div>
</br>
<div class="oneunit_area">
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
					<td>Kode Unit</td>
					<td><?=$unit->row('kode_unit')?></td>
				</tr>
				<tr>
					<td>Nama Unit</td>
					<td><?=$unit->row('nama_unit')?></td>
				</tr>
			</table>		
			<br>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<table id="tblLembur" class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Tanggal Lembur</th>
						<th>Nama Pegawai</th>
						<th>Dari Jam</th>
						<th>Sampai Jam</th>
						<th>Total Jam</th>
						<th>Keterangan</th>
					</tr>
				</thead>
				<tbody>
					<?php if($cekLembur): foreach ($cekLembur as $row): ?>
						<tr>
							<td><?=tanggal_indo($row->tgl_lembur)?></td>
							<td><?=$row->nama?></td>
							<td><?=$row->jam_mulai?></td>
							<td><?=$row->jam_selesai?></td>
							<td><?=$row->durasi?></td>
							<td><?=$row->keterangan?></td>
						</tr>
					<?php endforeach;
					else: ?>
						<tr>
							<td colspan="6" align="center">Tidak ada data untuk periode ini</td>
						</tr>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php elseif($jenis == 'one_person'): ?>
<div class="row">
	<div class="col-md-12">
		<button type="button" id="printOnePerson" class="btn btn-sm btn-primary"><i class="fa fa-print"></i> Cetak</button>
		<a href="" class="btn btn-sm btn-danger" title="PDF"><i class="fa fa-file-pdf-o"></i>&nbsp;Download PDF</a>
	</div>
</div>
<div class="oneperson_area">
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
					<td>NIP</td>
					<td><?=$pegawai->row('nip')?></td>
				</tr>
				<tr>
					<td>Nama</td>
					<td><?=$pegawai->row('nama')?></td>
				</tr>			
			</table>
		</div>
		<div class="col-md-6">
			<table class="table table-striped table-bordered">
				<tr>
					<td>Total Lembur</td>
					<td>
						<?php if($upah): 
							echo $upah->row('jml_lembur'); ?> kali
						<?php else: ?>
							-
						<?php endif; ?>
					</td>
				</tr>
				<tr>
					<td>Total Upah Lembur</td>
					<td>
						<?php if($upah): 
							echo "Rp. ".number_format($upah->row('jml_upah'),2,',','.'); ?>
						<?php else: ?>
							-
						<?php endif; ?>
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
						<th>Hari, Tanggal Lembur</th>
						<th>Dari Jam</th>
						<th>Sampai Jam</th>
						<th>Total Jam</th>
						<th>Keterangan</th>
						<th>Tindakan</th>
					</tr>
				</thead>
				<tbody>
					<?php if($cekLembur): foreach ($cekLembur as $row): ?>
						<tr>
							<td><?=hari_indo($row->tgl_lembur)?>, <?=tanggal_indo($row->tgl_lembur)?></td>
							<td><?=$row->jam_mulai?></td>
							<td><?=$row->jam_selesai?></td>
							<td><?=$row->durasi?></td>
							<td><?=$row->keterangan?></td>
							<td align="center">
								<a class="btn btn-success btn-xs item_edit" data-toggle="modal" data-target="#ModalEdit" onclick="modal_edit(<?=$row->id_lembur?>)"><i class="fa fa-edit"></i></a>
								<a class="btn btn-xs btn-danger" onclick="hapus_lembur(<?=$row->id_lembur?>)"><i class="fa fa-trash"></i></a>
							</td>
						</tr>
					<?php endforeach;
					else: ?>
						<tr>
							<td colspan="6" align="center">Tidak ada data untuk periode ini</td>
						</tr>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="modal fade bs-example-modal-md" id="ModalEdit" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Edit Lembur Karyawan</h4>
      </div>
      <div class="modal-body">
      	<div id="loading-edit"></div>
      	<div id="form-edit">
	      	<form id="editform" data-parsley-validate class="form-horizontal form-label-left">
	      		<input type="hidden" name="idlembur" id="idlembur">
	      		<input type="hidden" name="id_periode" id="id_periode">
						<input type="hidden" name="nip" id="nip">
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama_karyawan">Nama</label>
							<div class="col-md-8 col-sm-8 col-xs-6">
								<input type="text" name="nama_karyawan" id="nama_karyawan" class="form-control" readonly>
							</div>
						</div>
	      		<div class="form-group">
			        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tgl_lembur">Tanggal</label>
			        <div class="col-md-8 col-sm-8 col-xs-12">
			          <input type="date" id="tgl_lembur" name="tgl_lembur" required="required" class="form-control col-md-7 col-xs-12" readonly="">
			        </div>
			      </div>
			      <div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="jam_mulai">Jam Mulai</label>
							<div class="col-md-8 col-sm-8">
		           	<div class='input-group' id='in'>
		              <input type="text" name="jam_mulai" id="jam_mulai" class="form-control"/>
		              <span class="input-group-addon">
		               	<span class="glyphicon glyphicon-time"></span>
		             	</span>
		            </div>
		          </div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="jam_selesai">Jam Selesai</label>
							<div class="col-md-8 col-sm-8">
		           	<div class='input-group' id='out'>
		          	  <input type="text" name="jam_selesai" id="jam_selesai" class="form-control"/>
		              <span class="input-group-addon">
		               	<span class="glyphicon glyphicon-time"></span>
		             	</span>
		            </div>
		          </div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="ket_lembur">Keterangan</label>
							<div class="col-md-8 col-sm-8">
								<textarea class="form-control" name="ket_lembur" id="ket_lembur"></textarea>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-8 col-md-offset-3 col-sm-8 col-sm-offset-3">
								<button type="button" class="btn btn-sm btn-success" id="btn_edit"><i class="fa fa-edit"></i> Update Lembur</button>
							</div>
						</div>
	      	</form>
      	</div>
      </div>
		</div>
	</div>
</div>
<div class="modal fade bs-example-modal-md" id="ModalHapus" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Hapus Lembur Karyawan</h4>
      </div>
      <div class="modal-body">
      	<div id="loading-hapus"></div>
      	<form id="hapusform">
      		<input type="hidden" name="idlemburhapus" id="idlemburhapus">
      	</form>
      </div>
		</div>
	</div>
</div>
<?php endif; ?>	
<script type="text/javascript">
	$('#jam_mulai').datetimepicker({
	  format: 'HH:mm:ss'
	});
	$('#jam_selesai').datetimepicker({
	  format: 'HH:mm:ss'
	});
	$('#btn_edit').click(function(e){
		var $form = get_formdata($("#editform"));
		$.ajax({
			type  : "POST",
			url   : "<?php echo sdm()?>tunjangan_bonus/lembur/update_lembur",
			dataType : "json",
			data : $form,
			beforeSend: function(){
				$("#loading-edit").html(loader_green);
			},
			success: function(response){
				$("#loading-edit").html("");
				if (response[0].code==200) {
					swal({
						type: 'success',
						title: 'Berhasil',
						html: ""+response[0].message+"",
						showConfirmButton: true,
						allowOutsideClick: false
					}).then(function(){
						$("#ModalEdit").on("hidden.bs.modal", function () {
						  tampil();
						});
					})
				} else if(response[0].code==404){
					
					swal({
						type: 'error',
						title: 'Gagal',
						text: ''+response[0].message+'',
						showConfirmButton: true,
						allowOutsideClick: false
					})
				}
				else{
					$("#loading-edit").html(alert_red(response[0].message));
				}
			}
		});
		e.preventDefault();
	});
  $('#printAllUnit').on("click", function () {
    $('.allunit_area').printThis({
     	header: "<h4>Data Lembur Pegawai</h5>",
    });
  });
  $('#printOneUnit').on("click", function () {
    $('.oneunit_area').printThis({
     	header: "<h4>Data Lembur Pegawai</h5>",
    });
  });
  $('#printOnePerson').on("click", function () {
    $('.oneperson_area').printThis({
     	header: "<h4>Data Lembur Pegawai</h5>",
    });
  });
</script>
