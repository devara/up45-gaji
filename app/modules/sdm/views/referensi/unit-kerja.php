<?php include_once( APPPATH.'views/partial/header.php' ); ?>
<div class="right_col" role="main">
	<div>
		<div class="page-title">
			<div class="title_left">
				<h3>Unit Kerja</h3>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>List Unit Kerja <small>Berdasar database sistem</small></h2>
						<ul class="nav navbar-right panel_toolbox">
							<li>
								<a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
							</li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#ModalaAdd"><i class="fa fa-plus"></i> Tambah Unit Kerja</a>
						<br/><br/>
						<div id="reload">
							<table id="table-jab" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>Kode Unit</th>
										<th>Nama Unit Kerja</th>
										<th>Bidang</th>
										<th>Pilihan</th>
									</tr>
								</thead>
								<tbody id="show_data">
								<?php if($unit): foreach($unit as $row): ?>
									<tr>
										<td><?=$row->kode_unit?></td>
										<td><?=$row->nama_unit?></td>
										<td>
											<?php if($row->kode_bidang == 'BD1'): ?>
												Bidang 1
											<?php elseif($row->kode_bidang == 'BD2'): ?>
												Bidang 2
											<?php else: ?>
												Bidang 3
											<?php endif; ?>
										</td>
										<td align="center">
											<a class="btn btn-success btn-xs item_edit" onclick="edit_unit(<?=$row->id_unit?>)" data-toggle="modal" data-target="#ModalEdit"><i class="fa fa-pencil"></i> Edit</a>
											<a class="btn btn-danger btn-xs item_hapus" onclick="del_unit(<?=$row->id_unit?>)" data-toggle="modal" data-target="#DelUnit"><i class="fa fa-trash"></i> Hapus</a>
										</td>
									</tr>
								<?php endforeach; endif; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade bs-example-modal-md" id="ModalaAdd" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Tambah Unit Kerja</h4>
			</div>
			<div class="modal-body">
				<div id="loading"></div>
				<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="kd_unit">Kode Unit <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" id="kd_unit" name="kd_unit" required="required" class="form-control col-md-7 col-xs-12">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="bidang">Pilih Bidang <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<select class="form-control" id="bidang" required="required">
								<option selected="" disabled="">Pilih</option>
								<option value="BD1">Bidang 1</option>
								<option value="BD2">Bidang 2</option>
								<option value="BD3">Bidang 3</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nm_unit">Nama Unit <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" id="nm_unit" name="nm_unit" required="required" class="form-control col-md-7 col-xs-12">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="ket_unit">Keterangan <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<textarea class="form-control" id="ket_unit" name="ket_unit" required="required"></textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
							<button type="button" class="btn btn-sm btn-success" id="btn_simpan">Simpan</button>
							<a class="btn btn-sm btn-danger" data-dismiss="modal">Batal</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade bs-example-modal-md" id="ModalEdit" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Edit Unit Kerja</h4>
			</div>
			<div class="modal-body">
				<div id="editloading"></div>
				<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
					<input type="hidden" name="id_unit1" id="id_unit1">
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="kd_unit1">Kode Unit <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" id="kd_unit1" name="kd_unit1" required="required" class="form-control col-md-7 col-xs-12" disabled="">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="bidang1">Pilih Bidang <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<select class="form-control" id="bidang1" required="required">
								<option selected="" disabled="">Pilih</option>
								<option value="BD1">Bidang 1</option>
								<option value="BD2">Bidang 2</option>
								<option value="BD3">Bidang 3</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nm_unit1">Nama Unit <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" id="nm_unit1" name="nm_unit1" required="required" class="form-control col-md-7 col-xs-12">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="ket_unit1">Keterangan <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<textarea class="form-control" id="ket_unit1" name="ket_unit1" required="required"></textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
							<button type="button" class="btn btn-sm btn-success" id="btn_edit">Update</button>
							<a class="btn btn-sm btn-danger" data-dismiss="modal">Batal</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php include_once( APPPATH.'views/partial/footer.php' ); ?>
