<?php if($action == 'forget'): ?>
<form>
	<div class="login-box">
		<div class="login-title">
		  Lupa Password
		</div>
		<div class="panel-body">
			<div class="form-group">
				<label for="nip">NIP</label>
			  <div class="input-group">
			    <div class="input-group-addon"><i class="icon ion-person" style="font-size: 18px;"></i></div>
			    <input type="text" class="form-control" name="nip" id="nip" placeholder="NIP" autocomplete="off" />
			  </div>
			</div>
			<div class="form-group">
				<label for="email">Email</label>
			  <div class="input-group">
			    <div class="input-group-addon"><i class="icon ion-ios-email" style="font-size: 18px;"></i></div>
			    <input type="text" class="form-control" name="email" id="email" placeholder="Email Anda" autocomplete="off" />
			  </div>
			</div>
			<div class="form-group">
			        	 	<div class="">
			          		<a class="btn teal lighten-1 white-text z-depth-1" id="login_btn"><span class="navicon-left"><i class="ion-ios-locked" style="font-size: 18px;"></i></span>&nbsp;&nbsp;Batal</a>
			           		<button class="btn teal white-text z-depth-1" type="submit" style="float: right;">Lupa Password&nbsp;&nbsp;<span class="navicon-right"><i class="icon ion-log-in" style="font-size: 18px;"></i></span></button>
			           	</div>
			           	<div id="loading"></div>
			          </div>
		</div>
	</div>
</form>

<?php else: ?>
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
			          		<a class="btn teal lighten-1 white-text z-depth-1" id="forget_btn2"><span class="navicon-left"><i class="ion-ios-locked" style="font-size: 18px;"></i></span>&nbsp;&nbsp;Lupa Password</a>
			           		<button class="btn teal white-text z-depth-1" type="submit" style="float: right;">Masuk&nbsp;&nbsp;<span class="navicon-right"><i class="icon ion-log-in" style="font-size: 18px;"></i></span></button>
			           	</div>
			           	<div id="loading"></div>
			          </div>
		          </div>
						</div>
					</form>

<?php endif; ?>

<script type="text/javascript">
$('#login_btn').click(function(e){
	var action = 'login';
  $.ajax({
    type  : "POST",
    url   : "<?php echo base_url()?>login/action_form",
    dataType : "json",
    data : {act:action},
    beforeSend: function(){
      $("#loading").html(loader_green);
    },
    success: function(response){
      $("#loading").html("");
      if (response[0].code==200) {
        $("#action-box").html(response[0].form);
        
      }
      else{
        $("#loading").html(alert_red(response[0].message));
      }
    }
  });
  e.preventDefault();
});
$('#forget_btn2').click(function(e){
	var action = 'forget';
  $.ajax({
    type  : "POST",
    url   : "<?php echo base_url()?>login/action_form",
    dataType : "json",
    data : {act:action},
    beforeSend: function(){
      $("#loading").html(loader_green);
    },
    success: function(response){
      $("#loading").html("");
      if (response[0].code==200) {
        $("#action-box").html(response[0].form);
        
      }
      else{
        $("#loading").html(alert_red(response[0].message));
      }
    }
  });
  e.preventDefault();
});

</script>