<?php include_once( APPPATH.'views/partial/header.php' ); ?>
<div class="right_col" role="main">
	<div>
		<div class="page-title">
			<div class="title_left">
				<h3>Jabatan</h3>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div id="page_loader"></div>
				<div class="x_panel" id="data_list">
					<div class="x_title">
						<h2>List Jabatan/Posisi <small>Berdasar database sistem</small></h2>
						<ul class="nav navbar-right panel_toolbox">
              <li>
              	<a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
					</div>
					<div class="x_content">
						<a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#ModalAdd"><i class="fa fa-plus"></i> Tambah Jabatan</a>
						<br/><br/>
						<table id="tablejab" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>Nama Jabatan</th>
									<th>Tunjangan Jabatan</th>
									<th>Dibawahi oleh</th>
									<th>Pilihan</th>
								</tr>
							</thead>
							<tbody>
								<?php if($jabatan): foreach($jabatan as $row): 
								$und = $row->under_of_jabatan; ?>
								<tr>
									<td><?php echo $row->nama_jabatan ?></td>
									<td><?php echo $row->tunjangan_jabatan ?></td>									
									<td><?php echo field_value('master_jabatan','kode_jabatan',$und,'nama_jabatan'); ?></td>
									<td align="center">
										<a class="btn btn-success btn-xs item_edit" onclick="edit_jab(<?php echo $row->id_jabatan ?>)" data-toggle="modal" data-target="#ModalEdit"><i class="fa fa-pencil"></i> Edit</a>
										<a class="btn btn-danger btn-xs item_hapus" onclick="del_jab(<?php echo $row->id_jabatan ?>)" data-toggle="modal" data-target="#DelUnit"><i class="fa fa-trash"></i> Hapus</a>
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
        <h4 class="modal-title" id="myModalLabel">Tambah Jabatan</h4>
      </div>
      <div class="modal-body">
        <div id="loading"></div>
        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
          <div class="form-group">
		        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="addkd_jab">Kode Jabatan <span class="required">*</span>
		        </label>
		        <div class="col-md-6 col-sm-6 col-xs-12">
		          <input type="text" id="addkd_jab" name="addkd_jab" required="required" class="form-control col-md-7 col-xs-12">
		        </div>
		      </div>
		      <div class="form-group">
		      	<label class="control-label col-md-4 col-sm-3 col-xs-12" for="addnm_jab">Nama Jabatan <span class="required">*</span>
		        </label>
		        <div class="col-md-6 col-sm-6 col-xs-12">
		          <input type="text" id="addnm_jab" name="addnm_jab" required="required" class="form-control col-md-7 col-xs-12">
		        </div>
		      </div>
		      <div class="form-group">
		        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="addtunj_jab">Tunjangan Jabatan <span class="required">*</span>
		        </label>
		        <div class="col-md-6 col-sm-6 col-xs-12">
		          <input type="text" id="addtunj_jab" name="addtunj_jab" required="required" class="form-control has-feedback-left">
		          <span class="form-control-feedback left" aria-hidden="true">Rp</span>
		        </div>
		      </div>
		      <div class="form-group">
		        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="addunder_jab">Dibawahi oleh <span class="required">*</span>
		        </label>
		        <div class="col-md-6 col-sm-6 col-xs-12">
		          <select name="addunder_jab" id="addunder_jab" class="select2_single form-control" required="required" title="Pilih" style="width: 100% !important;padding: 0;">
		          	<option selected="" disabled="">Pilih</option>
		            <?php 
		            $jab = $this->my_lib->get_data('master_jabatan','','nama_jabatan ASC');
		            foreach ($jab as $val) { ?>
		              <option value="<?=$val->kode_jabatan?>"><?=$val->nama_jabatan?></option>
		            <?php } ?>
		          </select>
		        </div>
		      </div>
		      <div class="form-group">
		       	<label class="control-label col-md-4 col-sm-3 col-xs-12" for="addkap_jab">Kapasitas <span class="required">*</span>
		        </label>
		      	<div class="col-md-6 col-sm-6 col-xs-12">
		      	 	<select class="form-control" name="addkap_jab" id="addkap_jab" required="required">
		        		<option selected="" disabled="">Pilih</option>
		         		<option value="ya">Satu orang</option>
		         		<option value="tidak">Lebih dari satu orang</option>
		         	</select>
		        </div>
		      </div>
		      <div class="form-group">
		        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="addket_jab">Keterangan <span class="required">*</span>
		        </label>
		        <div class="col-md-6 col-sm-6 col-xs-12">
		         	<textarea class="form-control" id="addket_jab" name="addket_jab" required="required"></textarea>
		        </div>
		      </div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-4">
              <button type="button" class="btn btn-sm btn-success" id="btn_tambah">Simpan</button>
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
        <h4 class="modal-title" id="myModalLabel">Edit Jabatan</h4>
      </div>
      <div class="modal-body">
        <div id="editloading"></div>
        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
        	<input type="hidden" name="id_jab" id="id_jab">
          <div class="form-group">
		        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kd_jab">Kode Jabatan <span class="required">*</span>
		        </label>
		        <div class="col-md-6 col-sm-6 col-xs-12">
		          <input type="text" id="kd_jab" name="kd_jab" required="required" class="form-control col-md-7 col-xs-12" disabled="">
		        </div>
		      </div>
		      <div class="form-group">
		      	<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nm_jab">Nama Jabatan <span class="required">*</span>
		        </label>
		        <div class="col-md-6 col-sm-6 col-xs-12">
		          <input type="text" id="nm_jab" name="nm_jab" required="required" class="form-control col-md-7 col-xs-12">
		        </div>
		      </div>
		      <div class="form-group">
		        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tunj_jab">Tunjangan Jabatan <span class="required">*</span>
		        </label>
		        <div class="col-md-6 col-sm-6 col-xs-12">
		          <input type="text" id="tunj_jab" name="tunj_jab" required="required" class="form-control has-feedback-left">
		          <span class="form-control-feedback left" aria-hidden="true">Rp</span>
		        </div>
		      </div>
		      <div class="form-group">
		        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="under_jab">Dibawahi oleh <span class="required">*</span>
		        </label>
		        <div class="col-md-6 col-sm-6 col-xs-12">
		          <select name="under_jab" id="under_jab" class="form-control" required="required" title="Pilih">
		            <?php 
		            $jab = $this->my_lib->get_data('master_jabatan','','nama_jabatan ASC');
		            foreach ($jab as $val) { ?>
		              <option value="<?=$val->kode_jabatan?>"><?=$val->nama_jabatan?></option>
		            <?php } ?>
		          </select>
		        </div>
		      </div>
		      <div class="form-group">
		       	<label class="control-label col-md-3 col-sm-3 col-xs-12" for="kap_jab">Kapasitas <span class="required">*</span>
		        </label>
		      	<div class="col-md-6 col-sm-6 col-xs-12">
		      	 	<select class="form-control" name="kap_jab" id="kap_jab" required="required">
		        		<option selected="" disabled="">Pilih</option>
		         		<option value="ya">Satu orang</option>
		         		<option value="tidak">Lebih dari satu orang</option>
		         	</select>
		        </div>
		      </div>
		      <div class="form-group">
		        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ket_jab">Keterangan <span class="required">*</span>
		        </label>
		        <div class="col-md-6 col-sm-6 col-xs-12">
		         	<textarea class="form-control" id="ket_jab" name="ket_jab" required="required"></textarea>
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