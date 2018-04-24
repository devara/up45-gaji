<?php include_once( APPPATH.'views/partial/header.php' ); ?>

<div class="right_col" role="main">
	<div>
		<div class="page-title">
			<div class="title_left">
				<h3>Lembur</h3>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Manajemen Data Lembur</h2>
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
                	<a href="#data" role="tab" id="data-tab" data-toggle="tab" aria-expanded="true">Data Lembur</a>
                </li>
                <li role="presentation" class="">
                	<a href="#pengajuan" id="pengajuan-tab" role="tab" data-toggle="tab" aria-expanded="false">Data Pengajuan Lembur</a>
                </li>
              </ul>
              <div id="myTabContent" class="tab-content">
              	<div role="tabpanel" class="tab-pane fade active in" id="data" aria-labelledby="data-tab">
              		<br/>
              		<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
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
                      <label for="cekUnit" class="control-label col-md-2 col-sm-3 col-xs-12">Unit Kerja <span class="required">*</span></label>
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <select name="cekUnit" id="cekUnit" class="select2_single form-control" required="required" title="Pilih Pegawai" style="width: 100% !important;padding: 0;">
                        	<option value="all" selected="">Semua</option>
                          <?php foreach ($unit as $un) { ?>
                              <option value="<?=$un->kode_unit?>"><?=$un->nama_unit?></option>
                            <?php } ?>
                        </select>
                    	</div>
                    </div>
                    <div class="form-group">
                    	<div class="col-md-offset-2 col-md-4">
                    		<button type="button" id="btn_tampil" class="btn btn-sm btn-success">Cek Data</button>
                    	</div>
                    </div>
                    <div class="form-group">
                    	<div class="col-md-offset-2 col-md-5">
                    		<div id="loading"></div>
                    	</div>
                    </div>
              		</form>

              		<br>
              		<br>
              		<div id="tampilLembur">
              			
              		</div>
              	</div>

              	<div role="tabpanel" class="tab-pane fade" id="pengajuan" aria-labelledby="pengajuan-tab">
              		
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