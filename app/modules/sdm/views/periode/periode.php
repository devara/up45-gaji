<?php include_once( APPPATH.'views/partial/header.php' ); ?>

<div class="right_col" role="main">
	<div>
		<div class="page-title">
			<div class="title_left">
				<h3>Periode Kerja</h3>
			</div>
		</div>
		<div class="clearfix"></div>

		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Manajemen Data Periode Kerja</h2>
						<ul class="nav navbar-right panel_toolbox">
              <li>
              	<a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
					</div>
					<div class="x_content">
						<a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#ModalAdd"><i class="fa fa-plus"></i> Tambah Periode Kerja</a>
						<br/><br/>
						<table id="tblPeriode" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>Tahun</th>
									<th>Bulan</th>
									<th>Periode</th>
									<th>Hari Aktif</th>
									<th>Pembagi</th>
									<th>Status</th>
									<th>Pilihan</th>
								</tr>
							</thead>
							<tbody>
								<?php if($periode): foreach($periode as $row): 
								$id = $row->id_periode; $stat = $row->aktif; ?>
								<tr>
									<td><?=$row->tahun?></td>
									<td><?=$row->bulan?></td>									
									<td><?=$row->mulai?> - <?=$row->akhir?></td>
									<td><?=$row->hari_aktif?></td>
									<td><?=$row->pembagi?></td>
									<td>
									<?php if ($stat == 'ya') {
										echo "Periode Aktif";
									} else {
										echo "Periode Berakhir";
									} ?>
									</td>
									<td align="center">
										<a class="btn btn-success btn-xs item_edit" onclick="edit_per(<?=$id?>)" data-toggle="modal" data-target="#ModalEdit"><i class="fa fa-pencil"></i> Edit</a>
										<a class="btn btn-danger btn-xs item_hapus" onclick="del_per(<?=$id?>)" data-toggle="modal" data-target="#DelUnit"><i class="fa fa-trash"></i> Hapus</a>
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

<div class="modal fade bs-example-modal-md" id="ModalAdd" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Tambah Periode Kerja</h4>
      </div>
      <div class="modal-body">
        <div id="loading"></div>
        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
          <div class="form-group">
		        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="addtahun">Tahun <span class="required">*</span>
		        </label>
		        <div class="col-md-6 col-sm-6 col-xs-12">
		          <select class="form-control" name="addtahun" id="addtahun" required="required">
		          	<option selected="" disabled="">Pilih</option>
		          	<?php for ($i=2017; $i <2030 ; $i++) { ?>
		          		<option value="<?=$i?>"><?=$i?></option>
		          	<?php } ?>
		          </select>
		        </div>
		      </div>
		      <div class="form-group">
		        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="addbulan">Bulan <span class="required">*</span>
		        </label>
		        <div class="col-md-6 col-sm-6 col-xs-12">
		          <select class="form-control select2_single" name="addbulan" id="addbulan" style="width: 100% !important;padding: 0;" required="required">
		          	<option selected="" disabled="">Pilih</option>
		          	<option value="Januari">Januari</option>
		          	<option value="Februari">Februari</option>
		          	<option value="Maret">Maret</option>
		          	<option value="April">April</option>
		          	<option value="Mei">Mei</option>
		          	<option value="Juni">Juni</option>
		          	<option value="Juli">Juli</option>
		          	<option value="Agustus">Agustus</option>
		          	<option value="September">September</option>
		          	<option value="Oktober">Oktober</option>
		          	<option value="November">November</option>
		          	<option value="Desember">Desember</option>
		          </select>
		        </div>
		      </div>
		      <div class="form-group">
		        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="addmulai">Tanggal <span class="required">*</span>
		        </label>
		        <div class="col-md-4 col-sm-6 col-xs-12">
		          <input type="date" id="addmulai" name="addmulai" required="required" class="form-control">
		        </div>

		        <div class="col-md-4 col-sm-6 col-xs-12">
		          <input type="date" id="addakhir" name="addakhir" required="required" class="form-control">
		        </div>
		      </div>
		      <div class="form-group">
		      	<label class="control-label col-md-3 col-sm-3 col-xs-12" for="jumhari">Hari Aktif <span class="required">*</span></label>
		      	<div class="col-md-2 col-sm-6 col-xs-12">
		      		<input type="number" name="jumhari" id="jumhari" class="form-control" required="required">
		      	</div>
		      </div>
		      <div class="form-group">
		      	<label class="control-label col-md-3 col-sm-3 col-xs-12" for="pembagi">Pembagi <span class="required">*</span></label>
		      	<div class="col-md-2 col-sm-6 col-xs-12">
		      		<input type="number" name="pembagi" id="pembagi" class="form-control" required="required">
		      	</div>
		      </div>
		      
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <button type="button" class="btn btn-sm btn-success" id="btn_tambah">Simpan</button>
              <a class="btn btn-sm btn-danger" data-dismiss="modal">Batal</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include_once( APPPATH.'views/partial/footer.php' ); ?>