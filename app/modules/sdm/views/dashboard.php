<?php include_once( APPPATH.'views/partial/header.php' ); ?>
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>Dashboard</h3>
			</div>
		</div>
		<div class="clearfix"></div>

		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Form Design <small>different form elements</small></h2>
						<ul class="nav navbar-right panel_toolbox">
                <li>
                  <a href="" class="btn btn-primary">tambah</a>
                </li>
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
            <div class="clearfix"></div>
					</div>

					<div class="x_content">
						<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="<?=sdm()?>rkhlh/tambah">

                     
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12" for="periode">Periode <span class="required">*</span>
                        </label>
                        <div class="col-md-5 col-sm-6 col-xs-12">
                          <select name="periode" id="periode" class="form-control select2_single" required="required" style="width: 100% !important;padding: 0;" onchange="cekPer()">
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
                          <input type="date" id="tanggal" name="tanggal" required="required" class="form-control col-md-7 col-xs-12">
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
                          <button class="btn btn-primary" type="button">Cancel</button>
              <button class="btn btn-primary" type="reset">Reset</button>
                          <button type="submit" class="btn btn-success">Submit</button>
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