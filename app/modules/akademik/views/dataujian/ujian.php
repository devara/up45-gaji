<?php include_once( APPPATH.'views/partial/header.php' ); ?>

<div class="right_col" role="main">
	<div>
		<div class="page-title">
			<div class="title_left">
				<h3>Data Ujian</h3>
			</div>
		</div>
		<div class="clearfix"></div>

		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Manajemen Data Ujian (UTS/UAS)</h2>
						<ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
            </ul>
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
							    <h4 id="msgTitle"><?=$msgHeader['title'];?></h4>
							    <?=$msgHeader['message'];?>
							</div>				                
							<?php	
							}
							?>
						</div>
						<div class="" role="tabpanel" data-example-id="togglable-tabs">
							<ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
								<li role="presentation" class="<?php if($aktifTab == 'data'): ?> active <?php endif; ?>" id="li-data">
                	<a href="#data" role="tab" id="data-tab" data-toggle="tab" aria-expanded="true">Data UTS/UAS</a>
                </li>
                <li role="presentation" class="" id="li-pengawas">
                	<a href="#pengawas" id="pengawas-tab" role="tab" data-toggle="tab" aria-expanded="false">Pengawas UTS/UAS</a>
                </li>
              </ul>
              <div id="myTabContent" class="tab-content">
              	<div role="tabpanel" class="tab-pane fade <?php if($aktifTab == 'data'): ?> active in <?php endif; ?>" id="data" aria-labelledby="data-tab">
              		<a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#ModalAdd"><i class="fa fa-plus"></i> Tambah Ujian</a>
									<br/>
									<div><button type="button" onclick="showData()" class="btn btn-sm btn-primary">Refresh</button></div>
									<br/>
									<div id="dataUjian">
										<table id="tblujian" class="table table-striped table-bordered">
										<thead>
											<tr>
												<th>Periode</th>
												<th>Tanggal</th>
												<th>Tipe Ujian</th>
												<th>Mata Kuliah</th>
												<th>Pengawas</th>
												<th>Pilihan</th>
											</tr>
										</thead>
										<tbody>
											<?php if($ujian): foreach($ujian as $row): 
											$kode = $row->kode_matakuliah;
											$per = $row->id_periode; ?>
											<tr>
												<td>
													<?php $getPer = $this->my_lib->get_data('master_periode',array('id_periode'=>$per)); ?>
													<?php foreach($getPer as $p): ?>
													<b><?=$p->bulan.' '.$p->tahun?></b>
													<?php endforeach; ?>
												</td>
												<td><?=$row->tanggal?></td>
												<td style="text-transform: uppercase;"><?=$row->tipe?></td>
												<td><?=field_value('master_matakuliah','kode_matakuliah',$kode,'nama_matakuliah');?></td>
												<td>
												<?php $peng = $this->my_lib->get_data('data_ujian_pengawas',array('id_ujian'=>$row->id_ujian));
												if ($peng) { ?>
													<ul>
													<?php foreach ($peng as $pe) { 
													$nm_pegawai = field_value('data_pegawai','nip',$pe->nip,'nama'); ?>
														<li><?=$nm_pegawai?></li>
												<?php	} ?>
												 	</ul>
												<?php } else { ?>
													Belum di input
												<?php } ?>
												</td>
												<td align="center">
													<a class="btn btn-success btn-xs item_edit" onclick="edit_ujian(<?=$row->id_ujian?>)" data-toggle="modal" data-target="#ModalEdit"><i class="fa fa-pencil"></i> Edit</a>
													<a class="btn btn-danger btn-xs item_hapus" onclick="del_ujian(<?=$row->id_ujian?>)" data-toggle="modal" data-target="#DelUnit"><i class="fa fa-trash"></i> Hapus</a>
												</td>
											</tr>
											<?php endforeach; endif; ?>
										</tbody>
									</table>
									</div>
              	</div>

              	<div role="tabpanel" class="tab-pane fade" id="pengawas" aria-labelledby="pengawas-tab">
              		<form id="demo-form" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="<?=akademik()?>ujian/input_pengawas">
              			<div class="form-group">
              				<label for="ujianlist" class="control-label col-md-2 col-sm-3 col-xs-12">Pilih Ujian <span class="required">*</span></label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select name="ujianlist" id="ujianlist" class="select2_single form-control" required="required" title="Pilih Ujian" style="width: 100% !important;padding: 0;">
                        	<option selected="" disabled="">Pilih Ujian</option>
                        <?php 
                        $listujian = $this->my_lib->get_data('data_ujian',array('selesai'=>'belum'));
                        if($listujian):
                        foreach ($listujian as $u) { 
                        	$nm = field_value('master_matakuliah','kode_matakuliah',$u->kode_matakuliah,'nama_matakuliah');?> ?>
                          <option value="<?=$u->id_ujian?>"><?=$nm?></option>
                        <?php } endif; ?>
                       	</select>
                      </div>
              			</div>
              			<div class="form-group">
              				<label for="middle-name" class="control-label col-md-2 col-sm-3 col-xs-12">Pilih Pegawai <span class="required">*</span></label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select name="peg_ganda[]" id="peg_ganda" class="select2_single form-control" multiple required="required" title="Pilih Pegawai" style="width: 100% !important;padding: 0;">
                        <?php 
                        $pegawai = $this->my_lib->get_data('data_pegawai','','nama ASC');
                        foreach ($pegawai as $row) { ?>
                          <option value="<?=$row->nip?>"><?=$row->nama?></option>
                        <?php } ?>
                       	</select>
                      </div>
              			</div>
              			<div class="form-group">
              				<div class="col-md-offset-2 col-md-6">
              					<button type="submit" class="btn btn-sm btn-success">Simpan</button>
              					<b class="red">Pastikan data sudah valid</b>
              				</div>
              			</div>
              		</form>
              	</div>
              </div>
						</div>
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
        <h4 class="modal-title" id="myModalLabel">Input Data Ujian</h4>
      </div>
      <div class="modal-body">
        <div id="loading"></div>
        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
          <div class="form-group">
		        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id_per">Periode <span class="required">*</span>
		        </label>
		        <div class="col-md-8 col-sm-6 col-xs-12">
		          <select class="form-control select2_single" name="id_per" id="id_per" required="required" style="width: 100% !important;padding: 0;" onchange="cekPer()">
		        		<option value="0" selected="" disabled="">Pilih</option>
		         		<?php foreach ($periode as $per) { 
							  	$mulai = $this->lib_calendar->convert($per->mulai);
							  	$akhir = $this->lib_calendar->convert($per->akhir);
							  ?>
							  	<option value="<?=$per->id_periode?>">Periode <?php echo "".$per->bulan." ".$per->tahun." ( ".$mulai." - ".$akhir." )"; ?></option>
							  <?php } ?>
		         	</select>
		        </div>
		      </div>
		      <div class="form-group">
		      	<label class="control-label col-md-3 col-sm-3 col-xs-12" for="tgl">Tanggal Ujian <span class="required">*</span>
		        </label>
		        <div class="col-md-4 col-sm-6 col-xs-12">
		          <input type="date" id="tgl" name="tgl" required="required" class="form-control col-md-7 col-xs-12">
		        </div>
		      </div>
		      <div class="form-group">
		        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tipe">Jam Ujian <span class="required">*</span>
		        </label>
		        <div class="col-md-4 col-sm-6 col-xs-12">
		          <select class="form-control" name="jam" id="jam" required="required">
		        		<option selected="" disabled="">Pilih</option>
		         		<option value="reguler">Jam Reguler</option>
		         		<option value="malam">Jam Malam</option>
		         	</select>
		        </div>
		      </div>
		      <div class="form-group">
		        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tipe">Tipe Ujian <span class="required">*</span>
		        </label>
		        <div class="col-md-4 col-sm-6 col-xs-12">
		          <select class="form-control" name="tipe" id="tipe" required="required">
		        		<option selected="" disabled="">Pilih</option>
		         		<option value="UTS">Ujian Tengah Semester (UTS)</option>
		         		<option value="UAS">Ujian Akhir Semester (UAS)</option>
		         	</select>
		        </div>
		      </div>
		      <div class="form-group">
		        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="prodi">Program Studi <span class="required">*</span>
		        </label>
		        <div class="col-md-8 col-sm-6 col-xs-12">
		          <select name="prodi" id="prodi" class="select2_single form-control" required="required" title="Pilih" style="width: 100% !important;padding: 0;" onchange="get_makul()">
		          	<option value="0" selected="" disabled="">Pilih</option>
		            <?php 
		            $prodi = $this->my_lib->get_data('master_program_studi','','nama_program_studi ASC');
		            foreach ($prodi as $val) { ?>
		              <option value="<?=$val->kode_program_studi?>"><?=$val->nama_program_studi?></option>
		            <?php } ?>
		          </select>
		        </div>
		      </div>
		      <div id="loadmakul"></div>
		      <div class="form-group">
		        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="makul">Mata Kuliah <span class="required">*</span>
		        </label>
		        <div class="col-md-8 col-sm-6 col-xs-12">
		          <select name="makul" id="makul" class="select2_single form-control" required="required" title="Pilih" style="width: 100% !important;padding: 0;">
		          	<option selected="" disabled="">Pilih</option>
		            
		          </select>
		        </div>
		      </div>
		      <div class="form-group">
		      	<label class="control-label col-md-3 col-sm-3 col-xs-12" for="addjum">Jumlah Mahasiswa <span class="required">*</span>
		        </label>
		        <div class="col-md-3">
		        	<input type="number" name="addjum" id="addjum" class="form-control" required="required">
		        </div>
		      </div>
		      <div class="form-group">
		        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="addket">Keterangan <span class="required">*</span>
		        </label>
		        <div class="col-md-6 col-sm-6 col-xs-12">
		         	<textarea class="form-control" id="addket" name="addket" required="required"></textarea>
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
