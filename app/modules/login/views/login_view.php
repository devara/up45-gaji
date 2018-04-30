<!DOCTYPE html>
<html>
<head>
	<title>Aplikasi Penggajian Universitas Proklamasi 45</title>
	<meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
  <link rel="icon" href="<?php echo base_url()."favicon.ico"; ?>" type="image/x-icon" />
  <link rel="shortcut icon" href="<?php echo base_url()."favicon.ico"; ?>" type="image/x-icon" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/frontend/bootstrap/css/bootstrap.min.css"; ?>" media="screen,projection" />
  <link rel="stylesheet" type="text/css" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/frontend/style/css/login.css"; ?>" media="screen,projection" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/frontend/style/css/color.css"; ?>" />

</head>
<body>
	<div class="container">
		<div class="content">
			<div class="row">
				<div class="col-md-7">
					<div class="content-title">
						<div class="title">
							Aplikasi Penggajian<br>Universitas Proklamasi 45
						</div>
					</div>
					<div class="content-copyright">
						<p>&copy; 2018 Universitas Prokalamasi 45 | develope by Devara Eko</p>
					</div>
				</div>
				<div class="col-md-5">
					<form method="POST" action="<?=base_url()?>login/open_login">
					<div class="login-box">						
						<div class="login-title">
	            Login Sistem
	          </div>
	          <div class="panel-body">
	          	
	          		<div class="form-group">
		          		<label>Pilih Level</label>
		          		<select class="form-control" name="level">
		          			<option selected="" disabled="">Pilih</option>
		          			<option value="karyawan">Karyawan</option>
		          			<option value="SDM">SDM</option>
		          			<option value="AKD">Akademik</option>
		          			<option value="KEU">Keuangan</option>
		          			<option value="pimpinan">Pimpinan</option>
		          		</select>
		          	</div>
		            <div class="form-group">
		              <label for="username">Nama Pengguna</label>
		              <div class="input-group">
		                <div class="input-group-addon"><i class="icon ion-person" style="font-size: 18px;"></i></div>
		                <input type="text" class="form-control" name="username" id="username" placeholder="Nama Penguna" autocomplete="off" />
		              </div>
		            </div>
		            <div class="form-group">
		              <label for="password">Kata Sandi</label>
		              <div class="input-group">
		                <div class="input-group-addon"><i class="icon ion-android-lock" style="font-size: 18px;"></i></div>
		                <input type="password" class="form-control" name="password" id="password" placeholder="Kata Sandi" autocomplete="off" />
		              </div>
		            </div>
		            <?php if((isset($flash_message) and !empty($flash_message)) or($this->session->flashdata('flash_message'))): ?>
		            <div class="alert alert-danger alert-dismissible" role="alert">
		              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		              <?php echo $this->session->flashdata('flash_message'); ?>
		            </div>
		            <?php endif; ?>
		            <div class="form-group">
		            	<div class="">
		            		<a class="btn teal lighten-1 white-text z-depth-1" href=""><span class="navicon-left"><i class="ion-ios-locked" style="font-size: 18px;"></i></span>&nbsp;&nbsp;Lupa Password</a>
		            		<button class="btn teal white-text z-depth-1" type="submit" style="float: right;">Masuk&nbsp;&nbsp;<span class="navicon-right"><i class="icon ion-log-in" style="font-size: 18px;"></i></span></button>
		            	</div>
		            </div>
	          </div>
					</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<script src="<?php echo base_url().'assets/frontend/jquery/jquery.min.js'; ?>"></script>
	<script src="<?php echo base_url().'assets/frontend/bootstrap/js/bootstrap.min.js'; ?>"></script>
</body>
</html>