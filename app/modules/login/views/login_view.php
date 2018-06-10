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
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/frontend/style/css/ionicons.min.css";?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/frontend/style/css/login.css"; ?>" media="screen,projection" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/frontend/style/css/color.css"; ?>" />

  <script src="<?php echo base_url().'assets/frontend/jquery/jquery.min.js'; ?>"></script>
	<script src="<?php echo base_url().'assets/frontend/bootstrap/js/bootstrap.min.js'; ?>"></script>
	<script src="<?php echo base_url().'assets/frontend/style/js/sweetalert2.min.js'; ?>"></script>
	<script src="<?php echo base_url().'assets/frontend/style/js/login.js'; ?>"></script>
</head>
<body id="login">
	<div class="container">
		<div class="content">
			<div class="row">
				<div class="col-md-7">
					<div class="content-logo">
						<center>
							<img src="<?=base_url()?>assets/frontend/style/img/logo/logo.png" class="img-responsive">
						</center>
					</div>
					<div class="content-title">
						<div class="">
							<h1 class="title">Sistem Informasi Penggajian<br>Universitas Proklamasi 45</h1>
						</div>
					</div>
					<div class="content-copyright">
						<p>&copy; 2018 Universitas Prokalamasi 45 <br> developed by Devara Eko</p>
					</div>
				</div>
				<div class="col-md-5">
					<div id="action-box">
						<div class="action-section login-section">
							<form method="POST" action="<?=base_url()?>login/open_login">
								<div class="login-box">
									<div class="login-title">
				            <h3>Login Sistem</h3>
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
					            <label for="username">Username</label>
					            <div class="input-group">
					              <div class="input-group-addon"><i class="icon ion-person" style="font-size: 18px;"></i></div>
					              <input type="text" class="form-control" name="username" id="username" placeholder="Username" autocomplete="off" />
					            </div>
					          </div>
					          <div class="form-group">
					            <label for="password">Password</label>
					            <div class="input-group">
					              <div class="input-group-addon"><i class="icon ion-locked" style="font-size: 18px;"></i></div>
					              <input type="password" class="form-control" name="password" id="password" placeholder="Password" autocomplete="off" />
					            </div>
					          </div>
					           <?php if((isset($flash_message) and !empty($flash_message)) or($this->session->flashdata('login_message'))): ?>
					          <div class="alert alert-danger alert-dismissible" role="alert">
					            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					            <?php echo $this->session->flashdata('login_message'); ?>
					          </div>
					          <?php endif; ?>
					          <div class="form-group">
					        	 	<div class="">				          		
					           		<button class="btn blue darken-2 z-depth-1 login-btn" type="submit">Login&nbsp;&nbsp;<span class="navicon-right"><i class="icon ion-log-in"></i></span></button>
					           	</div>
					           	<div>
					           		<a class="white-text activate-section" href="#" data-section="forgot-section">Lupa Password ?</a>
					           		<a class="white-text activate-section" href="#" data-section="aktivasi-section" style="float: right;">Aktivasi Akun</a>
					           	</div>
					          </div>
				          </div>
								</div>
							</form>
						</div>

						<div class="action-section forgot-section">
							<form method="POST" action="<?=base_url()?>login/forget_password/submit">
								<div class="login-box">
									<div class="login-title">
				            <h3>Lupa Password</h3>
				          </div>
				          <div class="panel-body">
					          <div class="form-group">
					            <label for="email">Alamat Email</label>
					            <div class="input-group">
					              <div class="input-group-addon"><i class="icon ion-email" style="font-size: 18px;"></i></div>
					              <input type="text" class="form-control" name="email" id="email" placeholder="Masukan Email Anda" autocomplete="off" required="" />
					            </div>
					          </div>
					         
					          <div class="form-group">
					        	 	<button class="btn blue darken-2 z-depth-1 login-btn" type="submit">Reset Password&nbsp;&nbsp;<span class="navicon-right"><i class="icon ion-unlocked"></i></span></button>
					          </div>
					          <div class="form-group">
					          	<div class="alert alert-danger alert-dismissible text-center" role="alert">
						            Reset token hanya berlaku 24 jam
						          </div>
						          <div>
					           		<a class="white-text activate-section" href="#" data-section="login-section">Login</a>
					           	</div>
					          </div>					           	
				          </div>
								</div>
							</form>
						</div>

						<div class="action-section aktivasi-section">
							<form method="POST" action="<?=base_url()?>login/aktivasi/submit">
								<div class="login-box">
									<div class="login-title">
				            <h3>Aktivasi Akun</h3>
				          </div>
				          <div class="panel-body">
					          <div class="form-group">
					            <label for="nip">NIP Pegawai</label>
					            <div class="input-group">
					              <div class="input-group-addon"><i class="icon ion-person" style="font-size: 18px;"></i></div>
					              <input type="text" class="form-control" name="nip" id="nip" placeholder="Masukan NIP Anda" autocomplete="off" required="" />
					            </div>
					          </div>
					          <div class="form-group">
					          	<div class="input-group">
					              <div class="input-group-addon"><button type="button" id="btn_cek" class="btn btn-sm btn-success">Cek</button></div>
					              <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Anda" readonly="" />
					            </div>
					          </div>
					          <div class="form-group">
					          	<input type="hidden" name="nip_pegawai" id="nip_pegawai">
					            <label for="email_pegawai">Alamat Email Anda</label>
					            <div class="input-group">
					              <div class="input-group-addon"><i class="icon ion-ios-email" style="font-size: 18px;"></i></div>
					              <input type="text" class="form-control" name="email_pegawai" id="email_pegawai" placeholder="Masukan Email Anda" autocomplete="off" required="" />
					            </div>
					          </div>
					         
					          <div class="form-group">
					        	 	<button id="btn_aktivasi" class="btn blue darken-2 z-depth-1 login-btn" type="submit" disabled="">Aktivasi Akun&nbsp;&nbsp;<span class="navicon-right"><i class="icon ion-unlocked"></i></span></button>
					          </div>
					          <div class="form-group">
					          	<div class="alert alert-danger alert-dismissible text-center" role="alert">
						            Format Input NIP<br>
						            Input NIP tanpa tanda titik (.) dan (/)
						          </div>
						          <div>
					           		<a class="white-text activate-section" href="#" data-section="login-section">Login</a>
					           	</div>
					          </div>					           	
				          </div>
								</div>
							</form>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
    (function ($) {
        "use strict";
        var actionBox = $('#action-box'),
            modalSections = actionBox.find('.action-section');

        $('.activate-section').on('click', function (event) {
            var targetSection = $(this).data('section');
            modalSections.slideUp();
            actionBox.find('.' + targetSection).slideDown();
            event.preventDefault();
        });

    })(jQuery);

$('#btn_cek').click(function(e){
	var nip = $('#nip').val();
	$.ajax({
		type  : "POST",
		url   : "<?php echo ajaxpublic_url()?>get_pegawai_by_nip",
		dataType : "json",
		data : {nip:nip},
		beforeSend: function(){
			$("#nama").val("");
		},
		success: function(response){
			if (response[0].code==200) {
				$("#nama").val(response[0].nama);
				$("#nip_pegawai").val(response[0].nip);
				document.getElementById("btn_aktivasi").disabled = false;
			}
			else{
				$("#nama").val("NIP Tidak Valid");
				document.getElementById("btn_aktivasi").disabled = true;
			}
		}
	});
	e.preventDefault();
});
</script>
</body>
</html>
