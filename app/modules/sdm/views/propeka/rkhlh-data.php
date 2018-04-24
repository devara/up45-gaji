<?php include_once( APPPATH.'views/partial/header.php' ); ?>

<div class="right_col" role="main">
	<div>
		<div class="page-title">
			<div class="title_left">
				<h3>RKH LH</h3>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Manajemen Data RKH LH</h2>
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
                	<a href="#rkh" role="tab" id="rkh-tab" data-toggle="tab" aria-expanded="true">Rencana Kerja Harian</a>
                </li>
								<li role="presentation" class="">
                	<a href="#lh" role="tab" id="lh-tab" data-toggle="tab" aria-expanded="true">Laporan Harian</a>
                </li>
                <li role="presentation" class="">
                	<a href="#pengajuan" id="pengajuan-tab" role="tab" data-toggle="tab" aria-expanded="false">Laporan</a>
                </li>
              </ul>
              <div id="myTabContent" class="tab-content">
              	<div role="tabpanel" class="tab-pane fade active in" id="rkh" aria-labelledby="rkh-tab">
              		<div role="tabpanel" data-example-id="togglable-tabs">
              			<ul id="rkhTab" class="nav nav-tabs bar_tabs" role="tablist">
											<li role="presentation" class="active">
			                	<a href="#datarkh" role="tab" id="datarkh-tab" data-toggle="tab" aria-expanded="true">Data</a>
			                </li>
											<li role="presentation" class="">
			                	<a href="#tambahrkh" role="tab" id="tambahrkh-tab" data-toggle="tab" aria-expanded="true">Tambah</a>
			                </li>
			              </ul>
			              <div id="rkhTabContent" class="tab-content">
			              	<div role="tabpanel" class="tab-pane fade active in" id="datarkh" aria-labelledby="datarkh-tab">
			              		data RKH
			              	</div>
			              	<div role="tabpanel" class="tab-pane fade" id="tambahrkh" aria-labelledby="tambahrkh-tab">
			              		<form id="demo-form" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="<?=sdm()?>rkhlh/tambah">
			              			<div class="form-group">
		                        <label class="control-label col-md-2 col-sm-3 col-xs-12" for="periode">Periode <span class="required">*</span>
		                        </label>
		                        <div class="col-md-5 col-sm-6 col-xs-12">
		                          <select name="periode" id="periode" class="form-control select2_single" required="required" style="width: 100% !important;padding: 0;" onchange="tglRKH()">
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
		                        <label class="control-label col-md-2 col-sm-3 col-xs-12" for="tanggal">Tanggal <span class="required">*</span>
		                        </label>
		                        <div class="col-md-3 col-sm-6 col-xs-12">
		                          <input type="date" id="tanggal" name="tanggal" required="required" class="form-control col-md-7 col-xs-12" disabled="true">
		                        </div>
		                      </div>
		                      <div class="form-group">
		                        <label class="control-label col-md-2 col-sm-3 col-xs-12" for="pegawai">Pegawai <span class="required">*</span>
		                        </label>
		                        <div class="col-md-5 col-sm-6 col-xs-12">
		                          <select name="pegawai" class="select2_single form-control" required="required" title="Pilih Pegawai" style="width: 100% !important;padding: 0;">
		                            <option selected="" disabled="">Pilih</option>
		                            <?php foreach ($pegawai as $row) { ?>
		                                <option value="<?=$row->nip?>"><?=$row->nama?></option>
		                            <?php } ?>
		                          </select>
		                        </div>
		                      </div>
		                      <div class="form-group">
		                        <label class="control-label col-md-2 col-sm-3 col-xs-12" for="jum">Jumlah Kegiatan <span class="required">*</span>
		                        </label>
		                        <div class="col-md-1 col-sm-6 col-xs-12">
		                          <select name="jum" id="jum" class="select2_single form-control" required="required" title="Pilih" onchange="jumKeg()">
		                            <option selected="" disabled="">Pilih</option>
		                          <?php for ($i=1; $i < 11; $i++) { ?>
		                            <option value="<?=$i?>"><?=$i?></option>
		                          <?php } ?>
		                          </select>
		                        </div>
		                      </div>
		                      <div id="formAdd">

                      		</div>
                      		<div class="form-group">
		                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-2">
		              						<button class="btn btn-primary" type="reset">Reset</button>
		                          <button type="submit" class="btn btn-success">Submit</button>
		                        </div>
		                      </div>
			              		</form>
			              	</div>
			              </div>
              		</div>
              	</div>

              	<div role="tabpanel" class="tab-pane fade" id="lh" aria-labelledby="lh-tab">
              		<br/>
              		<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
              			<div class="form-group">
                      <label class="control-label col-md-2 col-sm-3 col-xs-12" for="cekPer">Periode <span class="required">*</span>
                      </label>
                      <div class="col-md-5 col-sm-6 col-xs-12">
                        <select name="cekPer" id="cekPer" class="form-control select2_single" required="required" style="width: 100% !important;padding: 0;" onchange="getPer()">
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
                    	<label class="control-label col-md-2 col-sm-3 col-xs-12" for="tgl">RKH Tanggal <span class="required">*</span>
                      </label>
                      <div class="col-md-4">
                      	<input type="date" name="tgl" id="tgl" class="form-control" onchange="getTanggal()" disabled="true">
                      </div>
                    </div>
                    <div class="form-group">
                    	<div class="col-md-offset-2 col-md-5">
                    		<div id="loading"></div>
                    	</div>
                    </div>
              		</form>
              		<br>
              		<div id="tampilDetail">
              			
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