<?php include_once( APPPATH.'views/partial/header.php' ); ?>
<div class="right_col" role="main">
	<div>
		<div class="page-title">
			<div class="title_left">
				<h3>Data Pegawai</h3>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>List Pegawai <small>Berdasar database sistem</small></h2>
						<ul class="nav navbar-right panel_toolbox">
              <li>
              	<a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
					</div>
					<div class="x_content">
						<a href="" class="btn btn-danger">Tambah Data Pegawai</a>
						<br/><br/>
						<table id="tablepegawai" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>Nama</th>
									<th>NIP</th>
									<th>Unit Kerja</th>
									<th>Nomor Telp</th>
									<th>Pilihan</th>
								</tr>
							</thead>
							<tbody>
								<?php if($pegawai): foreach($pegawai as $row): 
								$unit = $row->kode_unit; ?>
								<tr>
									<td>
										<?php echo $row->nama ?>										
									</td>
									<td><?php echo $row->nip ?></td>									
									<td><?php echo $row->nama_unit ?></td>
									<td><?php echo $row->hp ?></td>
									<td align="center">
										<a class="btn btn-success btn-xs item_edit" onclick="detail_peg(<?php echo $row->id ?>)" data-toggle="modal" data-target="#ModalDetail"><i class="fa fa-eye"></i> </a>
										<a href="javascript:;" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit</a>
										<a href="javascript:;" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Hapus</a>
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

<div class="modal fade bs-example-modal-lg" id="ModalDetail" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title">Detail Pegawai</h4>
      </div>
      <div class="modal-body">
      	<div id="loading"></div>
      	<div class="row">
      		<div class="col-md-8">
      			<div>
      				<p>NIP : <b id="peg_nip"></b> </p>
      				<p>Nama : <b id="peg_nama"></b></p>
      				<p>Unit Kerja : <b id="peg_unit"></b></p>
      				<p>Jabatan : <b id="peg_jab"></b></p>
      			</div>
      		</div>
      		<div class="col-md-4">
      			<div class="foto-profil">
      				<img src="<?php echo base_url()?>assets/images/img.jpg" alt="Profile Image" />
      			</div>
      		</div>
      	</div>
      </div>
		</div>
	</div>
</div>

<div class="modal fade bs-example-modal-lg" id="ModalEdit" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Edit Unit Kerja</h4>
      </div>
      <div class="modal-body">
        <div id="editloading"></div>
        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
          <input type="hidden" name="id_peg" id="id_peg">
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nip_peg">NIP <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="nip_peg" name="nip_peg" required="required" class="form-control col-md-7 col-xs-12" disabled="">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nm_peg">Nama Pegawai <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="nm_peg" name="nm_peg" required="required" class="form-control col-md-7 col-xs-12" disabled="">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="unit_peg">Unit Kerja <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="unit_peg" name="unit_peg" required="required" class="form-control col-md-7 col-xs-12" disabled="">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="jab_peg">Jabatan <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="jab_peg" name="jab_peg" required="required" class="form-control col-md-7 col-xs-12">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php include_once( APPPATH.'views/partial/footer.php' ); ?>