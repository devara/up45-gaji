<?php include_once( APPPATH.'views/partial/header.php' ); ?>

<div class="right_col" role="main">
	<div>
		<div class="page-title">
			<div class="title_left">
				<h3>Checklist Bulanan</h3>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Manajemen Data Checklist Bulanan</h2>
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
                	<a href="#data" role="tab" id="data-tab" data-toggle="tab" aria-expanded="true">Data Checklist Bulanan</a>
                </li>
								<li role="presentation" class="">
                	<a href="#input" role="tab" id="input-tab" data-toggle="tab" aria-expanded="true">Buat Checklist Bulanan</a>
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
                    		<button type="button" id="tampilChecklist" class="btn btn-success btn-sm">Lihat Data</button>
                    	</div>
                    </div>
                    <div class="form-group">
                    	<div class="col-md-offset-1 col-md-5">
                    		<div id="loading"></div>
                    	</div>
                    </div>
              		</form>
              		<br>
              		<div id="tabelChecklist">
              			
              		</div>
              	</div>

              	<div role="tabpanel" class="tab-pane fade" id="input" aria-labelledby="input-tab">
              		<div class="row">
              			<div class="col-md-10">
              				<form id="demo-form" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="<?=karyawan()?>propeka/checklist/tambah">
              					<input type="hidden" name="pegawai" id="pegawai" value="<?php echo $this->session->userdata('nip'); ?>">
			              			<div class="form-group">
		                        <label class="control-label col-md-1 col-sm-3 col-xs-12" for="periode">Periode
		                        </label>
		                        <div class="col-md-5 col-sm-6 col-xs-12">
		                          <select name="periode" id="periode" class="form-control select2_single" required="required" style="width: 100% !important;padding: 0;" onchange="cekData()">
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
		                      	<div class="col-md-5 col-md-offset-1">
		                      		<div id="cekloading"></div>
		                      	</div>
		                      </div>		                      
		                      <div id="formAdd">
			                      <div class="form-group">
			                      	<div class="col-md-offset-1 col-md-5 col-sm-6 col-xs-12">
			                      		<input type="text" name="keg[]" class="form-control" placeholder="Nama Kegiatan" required="required">
			                      	</div>
			                      	<div class="col-md-3">
			                      		<input type="date" name="dari[]" class="form-control" placeholder="Dari tanggal" required="required">
			                      	</div>
			                      	<div class="col-md-3">
			                      		<input type="date" name="sampai[]" class="form-control" placeholder="Sampai tanggal" required="required">
			                      	</div>
			                      </div>
                      		</div>
                      		<div class="form-group">
		                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-1">
		                          <button type="submit" id="btnSubmit" class="btn btn-success">Submit</button>
		                        </div>
		                      </div>
			              		</form>
              			</div>
              			<div class="col-md-2">
              				<a id="btnTambah" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Tambah Kegiatan</a>
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
</div>

<?php include_once( APPPATH.'views/partial/footer.php' ); ?>
