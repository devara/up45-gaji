<?php include_once( APPPATH.'views/partial/header.php' ); ?>

<div class="right_col" role="main">
	<div>
		<div class="page-title">
			<div class="title_left">
				<h3>Rapat</h3>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Data Rapat Karyawan</h2>
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
							<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
								<input type="hidden" name="nip" id="nip" value="<?php echo $this->session->userdata('nip'); ?>">
								<div class="form-group">
									<label class="control-label col-md-2 col-sm-3 col-xs-12" for="idPer">Pilih Periode <span class="required">*</span></label>
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
									<div class="col-md-offset-2 col-md-4">
										<button type="button" id="btn_tampil" class="btn btn-sm btn-success">Tampilkan</button>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-offset-2 col-md-4">
										<div id="loading"></div>
									</div>
								</div>
							</form>
							<br><br>
						</div>
						<div id="tampilRapat">
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include_once( APPPATH.'views/partial/footer.php' ); ?>
