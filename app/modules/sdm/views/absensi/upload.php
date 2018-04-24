<?php include_once( APPPATH.'views/partial/header.php' ); ?>

<div class="right_col" role="main">
	<div>
		<div class="page-title">
			<div class="title_left">
				<h3>Absensi</h3>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Import/Upload Data Absensi</h2>
						<ul class="nav navbar-right panel_toolbox">
              <li>
              	<a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
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
						<div>
							<h5 class="red"><b>Penting</b>: Dianjurkan upload file dibagi menjadi per Unit Kerja, <b>agar SERVER tidak kelebihan beban</b>.</h5>
						</div>
						<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data" method="POST" action="<?=sdm()?>absensi/upload/do_upload">
							<div class="form-group">
				        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="idPer">Pilih Periode <span class="required">*</span>
				        </label>
				        <div class="col-md-5 col-sm-6 col-xs-12">
				          <select class="form-control select2_single" name="idPer" id="idPer" required="required">
				          	<option selected="" disabled="">Pilih</option>
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
				      	<label class="control-label col-md-3 col-sm-3 col-xs-12" for="addfile">Pilih File <span class="required">*</span>
				        </label>
				        <div class="col-md-5 col-sm-6 col-xs-12">
				        	<input type="file" name="addfile" id="addfile" class="form-control" required="required">
				        </div>
				      </div>
				      <div class="form-group">
				      	<div class="col-md-offset-3 col-md-6">
				      		<button type="submit" class="btn btn-sm btn-success">Upload</button>
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