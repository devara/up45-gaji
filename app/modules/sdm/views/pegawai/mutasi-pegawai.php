<?php include_once( APPPATH.'views/partial/header.php' ); ?>

<div class="right_col" role="main">
	<div>
		<div class="page-title">
			<div class="title_left">
				<h3>Mutasi Karyawan</h3>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Mutasi Karyawan</h2>
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
						<div>
							<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="<?=sdm()?>mutasi_pegawai/mutasi">
								<div class="form-group">
									<label for="pegawai" class="control-label col-lg-1">Karyawan</label>
                  <div class="col-lg-4">
                    <select name="pegawai" id="pegawai" class="select2_single form-control" required="required" title="Pilih Pegawai" onchange="cek()">
                    	<option selected="" disabled="">Pilih Karyawan</option>
                    <?php foreach ($pegawai as $row) { ?>
                      <option value="<?=$row->nip?>"><?=$row->nama?></option>
                    <?php } ?>
                    </select>
                  </div>
								</div>
								<div id="loading"></div>
								<div class="form-group">
									<label for="posisi" class="control-label col-lg-1">Unit Kerja</label>
									<div class="col-lg-4">
										<input type="text" name="posisi" id="posisi" class="form-control" readonly="">
									</div>
									<label class="control-label col-lg-2">Mutasi ke Unit&nbsp;&nbsp;<i class="fa fa-arrow-right"></i></label>
									<div class="col-lg-4">
										<select name="unit" id="unit" class="select2_single form-control" required="required" title="Pilih Unit">
                    	<option selected="" disabled="">Pilih Unit Kerja</option>
                    <?php 
                    $unit = $this->my_lib->get_data('master_unit_kerja','','nama_unit ASC');
                  	foreach ($unit as $un) { ?>
                      <option value="<?=$un->kode_unit?>"><?=$un->nama_unit?></option>
                    <?php } ?>
                    </select>
									</div>
								</div>
								<div class="form-group">
									<label for="jabatan" class="control-label col-lg-1">Jabatan</label>
									<div class="col-lg-4">
										<input type="text" name="jabatan" id="jabatan" class="form-control" readonly="">
									</div>
									<label class="control-label col-lg-2">Mutasi ke Jabatan&nbsp;&nbsp;<i class="fa fa-arrow-right"></i></label>
									<div class="col-lg-4">
										<select name="jabatan2" id="jabatan2" class="select2_single form-control" required="required" title="Pilih Jabatan">
                    	<option selected="" disabled="">Pilih Jabatan</option>
                    <?php 
                    $jabatan = $this->my_lib->get_data('master_jabatan',array('tersedia'=>'ya'),'nama_jabatan ASC');
                  	foreach ($jabatan as $jab) { ?>
                      <option value="<?=$jab->kode_jabatan?>"><?=$jab->nama_jabatan?></option>
                    <?php } ?>
                    </select>
									</div>
								</div>
								<div class="form-group">
									<div class="col-lg-11">
										<div class="text-right">
											<button type="submit" class="btn btn-sm btn-success"><i class="fa fa-arrow-right"></i>&nbsp;&nbsp;Terapkan Mutasi</button>
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
</div>

<?php include_once( APPPATH.'views/partial/footer.php' ); ?>
