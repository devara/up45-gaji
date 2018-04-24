<?php include_once( APPPATH.'views/partial/header.php' ); ?>
<div class="right_col" role="main">
	<div>
		<div class="page-title">
			<div class="title_left">
				<h3>Jabatan/Posisi</h3>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>List Jabatan <small>Berdasar database sistem</small></h2>
						<ul class="nav navbar-right panel_toolbox">
              <li>
              	<a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
					</div>
					<div class="x_content">
						<a href="<?php echo sdm()?>unit_kerja/tambah" class="btn btn-danger">Tambah Jabatan</a>
						<br/><br/>
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>Nama Jabatan</th>
									<th>Tunjangan Jabatan</th>
									<th>Dibawahi Oleh</th>
									<th>Keterangan</th>
									<th>Pilihan</th>
								</tr>
							</thead>
							<tbody>
								<?php if($jabatan): foreach($jabatan as $row): $max=$row->max_satu; ?>
								<tr>
									<td><?php echo $row->nama_jabatan ?></td>
									<td><?php echo $row->tunjangan_jabatan ?></td>									
									<td><?php echo $row->under_of_jabatan ?></td>
									<td>
										<?php if ($max == 'ya') {
											echo "Maksimal terisi satu orang";
										} else{
											echo "Bisa terisi lebih dari satu orang";
										} ?>
									</td>
									<td></td>
								</tr>
								<?php endforeach; endif; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include_once( APPPATH.'views/partial/footer.php' ); ?>