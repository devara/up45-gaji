<?php include_once( APPPATH.'views/partial/header.php' ); ?>

<div class="right_col" role="main">
	<div>
		<div class="page-title">
			<div class="title_left">
				<h3>Laporan Kerja Harian</h3>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Manajemen Data LH</h2>
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
                	<a href="#data" role="tab" id="data-tab" data-toggle="tab" aria-expanded="true">Data Laporan Harian</a>
                </li>
								<li role="presentation" class="">
                	<a href="#input" role="tab" id="input-tab" data-toggle="tab" aria-expanded="true">Isi Laporan Kerja Harian</a>
                </li>
              </ul>
              <div id="myTabContent" class="tab-content">
              	<div role="tabpanel" class="tab-pane fade active in" id="data" aria-labelledby="data-tab">
              		<br/>
              		<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
              			<input type="hidden" name="nipPegawai" id="nipPegawai" value="<?php echo $this->session->userdata('nip'); ?>">
              			<div class="form-group">
                      <label class="control-label col-md-1 col-sm-3 col-xs-12" for="cekPer">Periode <span class="required">*</span>
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
                    	<div class="col-md-offset-1 col-md-3">
                    		<button type="button" id="tampilLH" class="btn btn-success btn-sm">Lihat Data</button>
                    	</div>
                    </div>
                    <div class="form-group">
                    	<div class="col-md-offset-1 col-md-5">
                    		<div id="loading"></div>
                    	</div>
                    </div>
              		</form>
              		<br>
              		<div id="tabelLH">
              			
              		</div>
              	</div>

              	<div role="tabpanel" class="tab-pane fade" id="input" aria-labelledby="input-tab">
              		<br>
              		<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
              			<input type="hidden" name="nip" id="nip" value="<?php echo $this->session->userdata('nip'); ?>">
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
                    	<label class="control-label col-md-2 col-sm-3 col-xs-12" for="tanggal">RKH Tanggal <span class="required">*</span>
                      </label>
                      <div class="col-md-4">
                      	<input type="date" name="tanggal" id="tanggal" class="form-control" onchange="getRKH()" disabled="true">
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
