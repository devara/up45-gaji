<div class="nav_menu">
	<nav>
		<div class="nav toggle">
			<a id="menu_toggle"><i class="fa fa-bars"></i></a>
		</div>
		
		<ul class="nav navbar-nav navbar-right">
			<!-- Dropdown profile menu -->
			<li>
				<a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
          <img src="<?php echo base_url()?>assets/images/picture.jpg" alt=""><?php echo $this->session->userdata('nama'); ?>
          <span class=" fa fa-angle-down"></span>
        </a>
        <ul class="dropdown-menu dropdown-usermenu pull-right">
          <li><a href="javascript:;"> Profil</a></li>
          <li><a href="<?php echo base_url()?>keluar"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
        </ul>
			</li>
			<!-- /Dropdown profile menu -->

			<!-- Dropdown notification 
			<li role="presentation" class="dropdown">
				<a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
					<i class="fa fa-envelope-o"></i>
					<span class="badge bg-green">6</span>
				</a>
				<ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
					<li>
            <a>
              <span class="image"><img src="<?php echo base_url()?>assets/images/img.jpg" alt="Profile Image" /></span>
              <span>
                <span>John Smith</span>
                <span class="time">3 mins ago</span>
              </span>
              <span class="message">
                Film festivals used to be do-or-die moments for movie makers. They were where...
              </span>
            </a>
          </li>
          <li>
            <a>
              <span class="image"><img src="<?php echo base_url()?>assets/images/img.jpg" alt="Profile Image" /></span>
              <span>
                <span>John Smith</span>
                <span class="time">3 mins ago</span>
              </span>
              <span class="message">
                Film festivals used to be do-or-die moments for movie makers. They were where...
              </span>
            </a>
          </li>
          <li>
            <div class="text-center">
              <a>
                <strong>See All Alerts</strong>
                <i class="fa fa-angle-right"></i>
              </a>
            </div>
          </li>
				</ul>
			</li>
			 /Dropdown notification -->
		</ul>
	</nav>
</div>
