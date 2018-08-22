<?php include_once( APPPATH.'views/partial/header.php' ); ?>
<div class="right_col" role="main">
	<div>
		<div class="page-title">
			<div class="title_left">
				<h3>Detail Karyawan</h3>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Detail Data Karyawan - <?=$pegawai->row('nama')?></h2>
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
					<form id="demo-form2" class="form-horizontal form-label-left" method="POST" action="<?=sdm()?>data_pegawai/edit_pegawai_submit">
						<div class="row">
							<div class="col-md-8">
								<div class="" role="tabpanel" data-example-id="togglable-tabs">
									<ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
										<li role="presentation" class="active">
											<a href="#pribadi" role="tab" id="pribadi-tab" data-toggle="tab" aria-expanded="true">Data Pribadi</a>
										</li>
										<li role="presentation" class="">
											<a href="#kontrak" role="tab" id="kontrak-tab" data-toggle="tab" aria-expanded="true">Kontrak Kerja</a>
										</li>
										<li role="presentation" class="">
											<a href="#gaji" role="tab" id="gaji-tab" data-toggle="tab" aria-expanded="true">Data Gaji</a>
										</li>
									</ul>
									<div id="myTabContent" class="tab-content">
										<div role="tabpanel" class="tab-pane fade active in" id="pribadi" aria-labelledby="pribadi-tab">
											<div class="form-group">
												<label class="control-label col-md-3">NIP</label>
												<div class="col-md-8">
													<input type="text" name="nip" class="form-control" value="<?=$pegawai->row('nip')?>" readonly>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">Nama</label>
												<div class="col-md-8">
													<input type="text" name="nama" class="form-control" value="<?=$pegawai->row('nama')?>">
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">Jenis Kelamin</label>
												<div class="col-md-8">
													<label class="radio-inline">
														<input type="radio" name="gender" id="inlineRadio1" value="L" <?php if($pegawai->row('gender') == 'L') echo "checked"; ?>> Laki-laki
													</label>
													<label class="radio-inline">
														<input type="radio" name="gender" id="inlineRadio2" value="P" <?php if($pegawai->row('gender') == 'P') echo "checked"; ?>> Perempuan
													</label>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">Agama</label>
												<div class="col-md-5">
													<select name="agama" class="form-control">
														<option selected="" disabled="">Pilih</option>
														<?php foreach($agama as $ag): ?>
															<?php if($ag->kode_agama == $pegawai->row('kode_agama')): ?>
																<option value="<?=$ag->kode_agama?>" selected><?=$ag->nama_agama?></option>
															<?php else: ?>
																<option value="<?=$ag->kode_agama?>"><?=$ag->nama_agama?></option>
															<?php endif; ?>															
														<?php endforeach; ?>
													</select>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">Tempat Lahir</label>
												<div class="col-md-5">
													<input type="text" name="tempat_lahir" class="form-control" value="<?=$pegawai->row('tempat_lahir')?>">
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">Tanggal Lahir</label>
												<div class="col-md-5">
													<input type="date" name="tgl_lahir" class="form-control" value="<?=$pegawai->row('tanggal_lahir')?>">
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">No HP</label>
												<div class="col-md-5">
													<input type="text" name="telepon" class="form-control" value="<?=$pegawai->row('hp')?>">
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">Email</label>
												<div class="col-md-5">
													<input type="email" name="email" class="form-control" value="<?=$pegawai->row('email')?>">
												</div>
											</div>
										</div>
										<div role="tabpanel" class="tab-pane fade" id="kontrak" aria-labelledby="kontrak-tab">
											<div class="form-group">
												<label class="control-label col-md-3">Tanggal Masuk</label>
												<div class="col-md-5">
													<input type="date" name="tgl_masuk" class="form-control" value="<?=$pegawai->row('tanggal_masuk')?>">
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">Nomor SK</label>
												<div class="col-md-5">
													<input type="text" name="no_sk" class="form-control" value="<?=$pegawai->row('nomor_sk')?>">
												</div>
											</div>

											<div class="form-group">
												<label class="control-label col-md-3">Tanggal SK</label>
												<div class="col-md-5">
													<input type="date" name="tgl_sk" class="form-control" value="<?=$pegawai->row('tanggal_sk')?>">
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">Tanggal Awal Kontrak</label>
												<div class="col-md-5">
													<input type="date" name="tgl_awal_kontrak" class="form-control" value="<?=$pegawai->row('tanggal_awal_kontrak')?>">
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">Tanggal Akhir Kontrak</label>
												<div class="col-md-5">
													<input type="date" name="tgl_akhir_kontrak" class="form-control" value="<?=$pegawai->row('tanggal_akhir_kontrak')?>">
												</div>
											</div>
										</div>
										<div role="tabpanel" class="tab-pane fade" id="gaji" aria-labelledby="gaji-tab">
											<div class="form-group">
												<label class="control-label col-md-3">Gaji Pokok</label>
												<div class="col-md-5">
													<input type="number" name="gaji_pokok" class="form-control" value="<?=$pegawai->row('gaji_pokok')?>">
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">TGPPW</label>
												<div class="col-md-5">
													<input type="number" name="tgppw" class="form-control" value="<?=$pegawai->row('tgppw')?>">
												</div>
											</div>
										</div>
									</div>
								</div>
								
							</div>
							<div class="col-md-4">
								
							</div>
						</div>
						<div class="row">
							<div class="col-md-8">
								<div class="form-group">
									<div class="col-md-5 col-md-offset-3">
										<button type="submit" class="btn btn-success"><i class="fa fa-edit"></i> Perbarui</button>
									</div>									
								</div>
							</div>
						</div>
					</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include_once( APPPATH.'views/partial/footer.php' ); ?>
