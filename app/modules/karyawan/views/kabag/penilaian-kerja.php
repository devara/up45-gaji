<?php include_once( APPPATH.'views/partial/header.php' ); ?>

<div class="right_col" role="main">
	<div>
		<div class="page-title">
			<div class="title_left">
				<h3>Penilaian Kinerja</h3>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Beri Penilaian Kinerja Pegawai</h2>
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
							<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="<?=karyawan()?>kabag/penilaian_kerja/input_penilaian">
								<input type="hidden" name="kd_jabatan" id="kd_jabatan" value="<?=$this->session->userdata('jabatan')?>">
								<div class="form-group">
									<label class="control-label col-md-2 col-sm-3 col-xs-12" for="idPer">Periode <span class="required">*</span></label>
									<div class="col-md-4 col-sm-6 col-xs-12">
										<select class="form-control select2_single" name="idPer" id="idPer" required="required" onchange="cekData()">
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
									<div class="col-md-4 col-md-offset-2">
										<div id="cekloading"></div>
									</div>
								</div>
								<table class="table table-striped table-bordered">
								<?php foreach($pegawai as $peg): ?>
								<tr>
									<td>
										<input type="hidden" name="nip[]" value="<?=$peg->nip?>">
										<input type="hidden" name="kd_unit[]" value="<?=$peg->kode_unit?>">
										<?=$peg->nama?><br>
										( <?=$peg->nama_jabatan?> )
									</td>
									<td><input type="number" max="100" name="jam[]" class="form-control" placeholder="40jam/minggu" required=""></td>
									<td><input type="number" max="100" name="disiplin[]" class="form-control" placeholder="kedisiplinan" required=""></td>
									<td><input type="number" max="100" name="loyalitas[]" class="form-control" placeholder="loyalitas" required=""></td>
									<td><input type="number" max="100" name="pelayanan[]" class="form-control" placeholder="pelayanan" required=""></td>
									<td><input type="number" max="100" name="propeka[]" class="form-control" placeholder="propeka" required=""></td>

								</tr>
								<?php endforeach; ?>
								</table>
								<div class="form-group">
									<div class="col-md-4">
										<button type="submit" id="btnsimpan" class="btn btn-sm btn-primary">Simpan Penilaian</button>
									</div>
								</div>
							</form>
							<div id="loading"></div>
							<br><br>
						</div>
						<div class="referensi">
							<img src="<?=base_url()?>assets/images/penilaian-kerja.PNG" class="img-responsive">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include_once( APPPATH.'views/partial/footer.php' ); ?>
