<?php include_once( APPPATH.'views/partial/header.php' ); ?>

<div class="right_col" role="main">
	<div>
		<div class="page-title">
			<div class="title_left">
				<h3>Korektor Ujian</h3>
			</div>
		</div>
		<div class="clearfix"></div>

		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Manajemen Data Korektor Ujian (UTS/UAS)</h2>
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
                	<a href="#pengawas" id="pengawas-tab" role="tab" data-toggle="tab" aria-expanded="false">Korektor UTS/UAS</a>
                </li>
                <li role="presentation" class="" id="li-cekpeng">
                	<a href="#cekpeng" id="cekpeng-tab" role="tab" data-toggle="tab" aria-expanded="false">Cek Data Korektor UTS/UAS</a>
                </li>
              </ul>
              <div id="myTabContent" class="tab-content">
              	<div role="tabpanel" class="tab-pane fade <?php if($aktifTab == 'data'): ?> active in <?php endif; ?>" id="data" aria-labelledby="data-tab">
									<br/>
									<div id="dataUjian">
										<table id="tblujian" class="table table-striped table-bordered">
										<thead>
											<tr>
												<th>Periode</th>
												<th>Tanggal</th>
												<th>Tipe Ujian</th>
												<th>Mata Kuliah</th>
												<th>Korektor</th>
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
												<?php $korektor = $this->my_lib->get_data('data_ujian_korektor',array('id_ujian'=>$row->id_ujian));
												if ($korektor) { ?>
													<ul>
													<?php foreach ($korektor as $kor) { 
													$nm_pegawai = field_value('data_pegawai','nip',$kor->nip,'nama'); ?>
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
              		<form id="demo-form" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="<?=akademik()?>koreksi/input_korektor">
              			<div class="form-group">
              				<label for="ujianlist" class="control-label col-md-2 col-sm-3 col-xs-12">Pilih Ujian <span class="required">*</span></label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select name="ujianlist" id="ujianlist" class="select2_single form-control" required="required" title="Pilih Ujian" style="width: 100% !important;padding: 0;">
                        	<option selected="" disabled="">Pilih Ujian</option>
                        <?php 
                        $listujian = $this->my_lib->get_data('data_ujian',array('koreksi'=>'belum'));
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
                        <select name="peg_ganda[]" id="peg_ganda" class="select2_single form-control" required="required" title="Pilih Pegawai" style="width: 100% !important;padding: 0;">
                        <?php 
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
              	<div role="tabpanel" class="tab-pane fade" id="cekpeng" aria-labelledby="cekpeng-tab">
              		<form id="demo-form" data-parsley-validate class="form-horizontal form-label-left">
              			<div class="form-group">
                      <label class="control-label col-md-1 col-sm-3 col-xs-12" for="cekPeriode">Periode <span class="required">*</span>
                      </label>
                      <div class="col-md-5 col-sm-6 col-xs-12">
                        <select name="cekPeriode" id="cekPeriode" class="form-control select2_single" required="required" style="width: 100% !important;padding: 0;">
                          <option disabled="" selected="">Pilih Periode</option>
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
                      <label for="cekPeg" class="control-label col-md-1 col-sm-3 col-xs-12">Pegawai <span class="required">*</span></label>
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <select name="cekPeg" id="cekPeg" class="select2_single form-control" required="required" title="Pilih Pegawai" style="width: 100% !important;padding: 0;">
                        	<option selected="" disabled="">Pilih</option>
                          <?php foreach ($pegawai as $row) { ?>
                              <option value="<?=$row->nip?>"><?=$row->nama?></option>
                            <?php } ?>
                        </select>
                    	</div>
                    </div>
                    <div class="form-group">
                    	<div class="col-md-offset-1 col-md-4">
                    		<button type="button" id="btn_cek" class="btn btn-sm btn-success">Cek Data</button>
                    	</div>
                    </div>
                    <div class="form-group">
                    	<div class="col-md-offset-1 col-md-5">
                    		<div id="cekloading"></div>
                    	</div>
                    </div>
              		</form>
              		<br>
              		<br>
              		<div id="tampilCekKorektor">
              			
              		</div>
              	</div>
              </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<?php include_once( APPPATH.'views/partial/footer.php' ); ?>
