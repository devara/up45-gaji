<?php include_once( APPPATH.'views/partial/header.php' ); ?>

<div class="right_col" role="main">
	<div>
		<div class="page-title">
			<div class="title_left">
				<h3>Manajemen Data Rapat</h3>
			</div>
		</div>
		<div class="clearfix"></div>

		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Data Rapat</h2>
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
						<div class="" role="tabpanel" data-example-id="togglable-tabs">
							<ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                <li role="presentation" class="active">
                	<a href="#tambah" id="tambah-tab" role="tab" data-toggle="tab" aria-expanded="true">Tambah Data</a>
                </li>
                <li role="presentation" class="">
                	<a href="#peserta" id="peserta-tab" role="tab" data-toggle="tab" aria-expanded="false">Data Rapat Karyawan</a>
                </li>
              </ul>
              <div id="myTabContent" class="tab-content">
              	
              	<div role="tabpanel" class="tab-pane fade active in" id="tambah" aria-labelledby="tambah-tab">
              		<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="<?=sdm()?>tunjangan_bonus/rapat/tambah">
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nama Rapat <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" name="nama_rapat" id="first-name" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Periode <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select name="periode" id="periode" class="form-control select2_single" required="required" style="width: 100% !important;padding: 0;" onchange="get_tanggal()">
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
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tanggal">Tanggal <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="tanggal" name="tanggal" required="required" class="form-control col-md-7 col-xs-12" disabled="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Peserta</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select name="peserta[]" class="select2_single form-control" multiple required="required" title="Pilih Pegawai" style="width: 100% !important;padding: 0;">
                          <?php foreach ($pegawai as $row) { ?>
                              <option value="<?=$row->nip?>"><?=$row->nama?></option>
                            <?php } ?>
                        </select>
                    	</div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Keterangan <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <textarea name="keterangan" class="form-control"></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button class="btn btn-primary" type="reset">Reset</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                      </div>
                    </div>
                  </form>
              	</div>

              	<div role="tabpanel" class="tab-pane fade" id="peserta" aria-labelledby="peserta-tab">
              		<form id="demo-form" data-parsley-validate class="form-horizontal form-label-left">
              			<div class="form-group">
                      <label class="control-label col-md-2 col-sm-3 col-xs-12" for="cekPer">Periode <span class="required">*</span>
                      </label>
                      <div class="col-md-5 col-sm-6 col-xs-12">
                        <select name="cekPer" id="cekPer" class="form-control select2_single" required="required" style="width: 100% !important;padding: 0;">
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
                      <label for="cekPeg" class="control-label col-md-2 col-sm-3 col-xs-12">Karyawan <span class="required">*</span></label>
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <select name="cekPeg" id="cekPeg" class="select2_single form-control" required="required" title="Pilih Karyawan" style="width: 100% !important;padding: 0;">
                        	<option value="all">Semua Data</option>
                          <?php foreach ($pegawai as $row) { ?>
                              <option value="<?=$row->nip?>"><?=$row->nama?></option>
                            <?php } ?>
                        </select>
                    	</div>
                    </div>
                    <div class="form-group">
                    	<div class="col-md-offset-2 col-md-4">
                    		<button type="button" id="btn_cek" class="btn btn-sm btn-success">Tampilkan Data</button>
                    	</div>
                    </div>
                    <div class="form-group">
                    	<div class="col-md-offset-1 col-md-5">
                    		<div id="loading"></div>
                    	</div>
                    </div>
              		</form>
              		<br>
              		<br>
              		<div id="tampilCekRapat">
              			
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
