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
						
						<table id="tblabsensi" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>Tanggal</th>
									<th>NIP</th>
									<th>Nama</th>
									<th>Time IN</th>
									<th>Time OUT</th>
									<th>Keterangan</th>
								</tr>
							</thead>
							<tbody>
							<?php if($worksheet): $numRows = count($worksheet); ?>
							<?php for ($i=1; $i < ($numRows+1) ; $i++) { ?>
								<tr>
									<td><?=$worksheet[$i]["A"]?></td>
									<td><?=$worksheet[$i]["D"]?></td>
									<td><?=$worksheet[$i]["E"]?></td>
									<td><?=$worksheet[$i]["G"]?></td>
									<td><?=$worksheet[$i]["H"]?></td>
									<td><?=$worksheet[$i]["I"]?></td>
								</tr>
							<?php } ?>
							<?php endif; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include_once( APPPATH.'views/partial/footer.php' ); ?>