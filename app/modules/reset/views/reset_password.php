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
						<p>&copy; 2018 Universitas Prokalamasi 45 <br> made with &#128147; by Devara Eko</p>
					</div>
				</div>
				<div class="col-md-5">
					<div id="action-box">
						<div class="action-section">
							<form method="POST" action="<?=base_url()?>reset/submit">
								<div class="login-box">
									<div class="login-title">
				            <h3>Reset Password</h3>
				          </div>
				          <div class="panel-body">
					          <div class="form-group">
					            <label for="email">Password Baru</label>
					            <div class="input-group">
					              <div class="input-group-addon"><i class="icon ion-locked" style="font-size: 18px;"></i></div>
					              <input type="text" class="form-control" name="new_pass" id="new_pass" placeholder="Masukan password baru Anda" autocomplete="off" required="" />
					            </div>
					          </div>
					          <div class="form-group">
					            <label for="email">Ulangi Password</label>
					            <div class="input-group">
					              <div class="input-group-addon"><i class="icon ion-locked" style="font-size: 18px;"></i></div>
					              <input type="text" class="form-control" name="verif_pass" id="verif_pass" placeholder="Ulangi password" autocomplete="off" required="" />
					            </div>
					          </div>
					         
					          <div class="form-group">
					        	 	<button class="btn blue darken-2 z-depth-1 login-btn" type="submit">Reset Password&nbsp;&nbsp;<span class="navicon-right"><i class="icon ion-unlocked"></i></span></button>
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
	<div id="cookieConsent">
    <div id="closeCookieConsent"><i class="ion ion-close-circled"></i></div>
    Token Anda tersimpan dalam <i>Browser Session</i>. <a href="#" target="_blank">Info detail</a>. <a class="cookieConsentOK">Oke, Saya mengerti!</a>
	</div>

	<script src="<?php echo base_url().'assets/frontend/jquery/jquery.min.js'; ?>"></script>
	<script src="<?php echo base_url().'assets/frontend/bootstrap/js/bootstrap.min.js'; ?>"></script>
	<script src="<?php echo base_url().'assets/frontend/style/js/login.js'; ?>"></script>
	<script type="text/javascript">
		$(document).ready(function(){   
	    setTimeout(function () {
	      $("#cookieConsent").fadeIn(300);
	    }, 1000);
	    $("#closeCookieConsent, .cookieConsentOK").click(function() {
	        $("#cookieConsent").fadeOut(200);
	    }); 
		}); 
	</script>
</body>
</html>
