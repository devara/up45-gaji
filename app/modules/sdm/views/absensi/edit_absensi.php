<!DOCTYPE html>
<html>
<head>
	<title>Edit Absensi</title>
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/frontend/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/frontend/datetimepicker/bootstrap-datetimepicker.min.css">
	<script type="text/javascript" src="<?=base_url()?>assets/frontend/jquery/jquery.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/frontend/datetimepicker/moment.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/frontend/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/frontend/datetimepicker/bootstrap-datetimepicker.min.js"></script>
</head>
<body>
<?php foreach ($absensi as $row) {
	$id_ab = $row->id_absensi;
	$tgl = $row->tanggal;
	$hari = $row->hari;
	$in = $row->datang;
	$out = $row->pulang;
} ?>
<div class="container" style="margin-top: 20px;">
	<div class="row">
		<div class="col-md-6 col-sm-6 col-xs-12">
			<table class="table table-striped table-bordered">
				
				<?php foreach ($pegawai as $peg) { ?>
				<tr>
					<td>NIP</td>
					<td><?=$peg->nip?></td>
				</tr>
				<tr>
					<td>Nama</td>
					<td><?=$peg->nama?></td>
				</tr>
				<?php } ?>			
			</table>		
			<br>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<form class="form-horizontal" method="POST" action="<?=sdm()?>absensi/kelola/edit_absensi_submit">
				<input type="hidden" name="id_periode" value="<?=$periode?>">
				<input type="hidden" name="nip" value="<?=$nip?>">
				<input type="hidden" name="id_absensi" value="<?=$id_ab?>">
				<div class="form-group">
					<label class="control-label col-md-2 col-sm-2 col-xs-2" for="tgl">Tanggal :</label>
					<div class="col-md-5 col-sm-4 col-xs-6">
						<input type="date" name="tgl_absensi" class="form-control" value="<?=$tgl?>" readonly>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2 col-sm-2 col-xs-2" for="hari">Hari :</label>
					<div class="col-md-5 col-sm-4 col-xs-6">
						<input type="text" name="hari_absensi" class="form-control" value="<?=$hari?>" readonly>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2 col-sm-2 col-xs-2" for="datang">Time IN :</label>
					<div class="col-md-3 col-sm-4">
           	<div class='input-group' id='in'>
              <input type="text" name="datang" id="datang" class="form-control" value="<?=$in?>" />
              <span class="input-group-addon">
               	<span class="glyphicon glyphicon-time"></span>
             	</span>
            </div>
          </div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2 col-sm-2 col-xs-2" for="pulang">Time OUT :</label>
					<div class="col-md-3 col-sm-4">
           	<div class='input-group' id='out'>
          	  <input type="text" name="pulang" id="pulang" class="form-control" value="<?=$out?>" />
              <span class="input-group-addon">
               	<span class="glyphicon glyphicon-time"></span>
             	</span>
            </div>
          </div>
				</div>
				<div class="form-group">
					<div class="col-md-offset-2 col-sm-offset-2 col-sm-4">
						<button type="submit" class="btn btn-sm btn-success">Simpan Perubahan</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
$('#in').datetimepicker({
  format: 'HH:mm:ss'
});
$('#out').datetimepicker({
  format: 'HH:mm:ss'
});
</script>
</body>
</html>
