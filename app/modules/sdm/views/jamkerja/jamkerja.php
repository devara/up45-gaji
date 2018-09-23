<?php include_once( APPPATH.'views/partial/header.php' ); ?>

<div class="right_col" role="main">
	<div>
		<div class="page-title">
			<div class="title_left">
				<h3>Manajemen Jam Kerja</h3>
			</div>
		</div>
		<div class="clearfix"></div>

		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Manajemen Data Jam Kerja</h2>
            <div class="clearfix"></div>
					</div>
					<div class="x_content">
						<div>
							<?php
							$msgHeader=$this->session->flashdata('message_header');
							if(!empty($msgHeader))
							{
							$msgTipe=$msgHeader['tipe'];
							$msgIcon="";
							switch($msgTipe){
									case "danger":
										$msgIcon="fa-ban";
										break;						
									case "success":
										$msgIcon="fa-check";
										break;
									case "warning":
										$msgIcon="fa-warning";
										break;
									case "info":
										$msgIcon="fa-info";
										break;
								}
							?>
							<div class="alert alert-<?=$msgTipe;?> alert-dismissable" id="message_header">
							    <button type="button" class="close" data-dismiss="alert">&times;</button>
							    <h4><?=$msgHeader['title'];?></h4>
							    <?=$msgHeader['message'];?>
							</div>				                
							<?php	
							}
							?>
						</div>
						<div class="row">
							<div class="col-md-6">
								<a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#ModalAdd"><i class="fa fa-plus"></i> Tambah Jam Kerja</a>
							</div>
						</div>
						<br>
						<table id="tblPeriode" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>Nama Jam Kerja</th>
									<th>Jam Kerja</th>
									<th>Toleransi</th>
									<th>Jam Kerja Sabtu</th>
									<th>Toleransi Sabtu</th>
									<th>Pilihan</th>
								</tr>
							</thead>
							<tbody>
								<?php if($jamkerja): foreach($jamkerja as $row): 
								$kode = $row->kode_jam_kerja; ?>
								<tr>
									<td><?=$row->nama_jam_kerja?></td>									
									<td><?=$row->jam_datang?> - <?=$row->jam_pulang?></td>
									<td><?=$row->toleransi?></td>
									<td><?=$row->jam_datang_sabtu?> - <?=$row->jam_pulang_sabtu?></td>
									<td><?=$row->toleransi_sabtu?></td>
									<td align="center">
										<a class="btn btn-success btn-xs item_edit" onclick="edit_per(<?=$kode?>)" data-toggle="modal" data-target="#ModalEdit"><i class="fa fa-pencil"></i> Edit</a>
										<a class="btn btn-danger btn-xs item_hapus" onclick="del_per(<?=$kode?>)" data-toggle="modal" data-target="#DelUnit"><i class="fa fa-trash"></i> Hapus</a>
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
        <h4 class="modal-title" id="myModalLabel">Tambah Jam Kerja</h4>
      </div>
      <div class="modal-body">
        <div id="loading"></div>
        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
          <div class="form-group">
		        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="addtahun">Kode Jam Kerja <span class="required">*</span>
		        </label>
		        <div class="col-md-6 col-sm-6 col-xs-12">
		          <input type="text" name="addkode" id="addkode" class="form-control">
		        </div>
		      </div>
		      <div class="form-group">
		        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="addbulan">Nama Jam Kerja <span class="required">*</span>
		        </label>
		        <div class="col-md-6 col-sm-6 col-xs-12">
		          <input type="text" name="addnama" id="addnama" class="form-control">
		        </div>
		      </div>
		      <div class="form-group">
		        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="adddatang">Jam Datang <span class="required">*</span>
		        </label>
		        <div class="col-md-4 col-sm-6 col-xs-12">
		          <input type="text" id="adddatang" name="adddatang" required="required" class="form-control">
		        </div>
		      </div>
		      <div class="form-group">
		        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="addpulang">Jam Pulang <span class="required">*</span>
		        </label>
		        <div class="col-md-4 col-sm-6 col-xs-12">
		          <input type="text" id="addpulang" name="addpulang" required="required" class="form-control">
		        </div>
		      </div>
		      <div class="form-group">
		        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="addtoleransi">Toleransi <span class="required">*</span>
		        </label>
		        <div class="col-md-4 col-sm-6 col-xs-12">
		          <input type="text" id="addtoleransi" name="addtoleransi" required="required" class="form-control">
		        </div>
		      </div>
		      <div class="form-group">
		        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="addrehat">Jam Rehat <span class="required">*</span>
		        </label>
		        <div class="col-md-4 col-sm-6 col-xs-12">
		          <input type="text" id="addrehat" name="addrehat" required="required" class="form-control">
		        </div>
		      </div>
		      <div class="form-group">
		        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="adddatangsabtu">Jam Datang Sabtu<span class="required">*</span>
		        </label>
		        <div class="col-md-4 col-sm-6 col-xs-12">
		          <input type="text" id="adddatangsabtu" name="adddatangsabtu" required="required" class="form-control">
		        </div>
		      </div>
		      <div class="form-group">
		        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="addpulangsabtu">Jam Pulang Sabtu<span class="required">*</span>
		        </label>
		        <div class="col-md-4 col-sm-6 col-xs-12">
		          <input type="text" id="addpulangsabtu" name="addpulangsabtu" required="required" class="form-control">
		        </div>
		      </div>
		      <div class="form-group">
		        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="addtoleransisabtu">Toleransi Sabtu<span class="required">*</span>
		        </label>
		        <div class="col-md-4 col-sm-6 col-xs-12">
		          <input type="text" id="addtoleransisabtu" name="addtoleransisabtu" required="required" class="form-control">
		        </div>
		      </div>
		      <div class="form-group">
		        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="addrehatsabtu">Jam Rehat <span class="required">*</span>
		        </label>
		        <div class="col-md-4 col-sm-6 col-xs-12">
		          <input type="text" id="addrehatsabtu" name="addrehatsabtu" required="required" class="form-control">
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
