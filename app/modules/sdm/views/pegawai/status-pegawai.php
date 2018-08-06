<?php include_once( APPPATH.'views/partial/header.php' ); ?>

<div class="right_col" role="main">
	<div>
		<div class="page-title">
			<div class="title_left">
				<h3>Status Pegawai</h3>
			</div>
		</div>
		<div class="clearfix"></div>

		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Manajemen Status Pegawai</h2>
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
                	<a href="#ganda" role="tab" id="ganda-tab" data-toggle="tab" aria-expanded="true">Update Ganda</a>
                </li>
                <li role="presentation" class="">
                	<a href="#tunggal" id="tunggal-tab" role="tab" data-toggle="tab" aria-expanded="false">Update Tunggal</a>
                </li>                                        
              </ul>
              <div id="myTabContent" class="tab-content">
              	<div role="tabpanel" class="tab-pane fade active in" id="ganda" aria-labelledby="ganda-tab">
              		<p class="red">Update ganda memungkinkan Anda untuk meng-update status banyak pegawai sekaligus.</p><br>
              		<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="<?=sdm()?>status_pegawai/ganda">
              			<div class="form-group">
              				<label for="middle-name" class="control-label col-md-2 col-sm-3 col-xs-12">Pilih Pegawai <span class="required">*</span></label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select name="peg_ganda[]" class="select2_single form-control" multiple required="required" title="Pilih Pegawai" style="width: 100% !important;padding: 0;">
                        <?php foreach ($pegawai as $row) { ?>
                          <option value="<?=$row->nip?>"><?=$row->nama?></option>
                        <?php } ?>
                       	</select>
                      </div>
              			</div>
              			<div class="form-group">
                      <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Status <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                      	<select name="stat_ganda" class="select2_single form-control" required="required" title="Pilih Status" style="width: 100% !important;padding: 0;">
                        <?php 
                        $status = $this->my_lib->get_data('master_status_pegawai','','nama_status ASC');
                        foreach ($status as $stat) { ?>
                          <option value="<?=$stat->kode_status_pegawai?>"><?=$stat->nama_status?></option>
                        <?php } ?>
                       	</select>
                      </div>
                    </div>
                    <div class="form-group">
                    	<div class="col-md-offset-2 col-md-6">
                    		<button type="submit" class="btn btn-sm btn-success">Update</button>
                    	</div>
                    </div>
              		</form>
              	</div>

              	<div role="tabpanel" class="tab-pane fade" id="tunggal" aria-labelledby="tunggal-tab">
              		<p class="red">Update tunggal berarti Anda hanya dapat meng-update status satu orang pegawai</p><br>
              		<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="<?=sdm()?>status_pegawai/tunggal">
              			<div class="form-group">
              				<label for="middle-name" class="control-label col-md-2 col-sm-3 col-xs-12">Pilih Pegawai <span class="required">*</span></label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select name="peg_tunggal" class="select2_single form-control" required="required" title="Pilih Pegawai" style="width: 100% !important;padding: 0;">
                        	<option selected="" disabled="">Pilih</option>
                        <?php foreach ($pegawai as $row) { ?>
                          <option value="<?=$row->nip?>"><?=$row->nama?></option>
                        <?php } ?>
                       	</select>
                      </div>
              			</div>
              			<div class="form-group">
                      <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Status <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                      	<select name="stat_tunggal" class="select2_single form-control" required="required" title="Pilih Status" style="width: 100% !important;padding: 0;">
                        <?php 
                        $status = $this->my_lib->get_data('master_status_pegawai','','nama_status ASC');
                        foreach ($status as $stat) { ?>
                          <option value="<?=$stat->kode_status_pegawai?>"><?=$stat->nama_status?></option>
                        <?php } ?>
                       	</select>
                      </div>
                    </div>
                    <div class="form-group">
                    	<div class="col-md-offset-2 col-md-6">
                    		<button type="submit" class="btn btn-sm btn-success">Update</button>
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
	</div>
</div>

<?php include_once( APPPATH.'views/partial/footer.php' ); ?>
