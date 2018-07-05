<div  class="left_col scroll-view">	
	<div class="navbar nav_title" style="border: 0;">
    <a href="" class="site_title">
    	<i class="fa fa-users"></i>
    	<span>SI Penggajian</span>
    </a>
  </div>
	<div class="clearfix"></div>
  <div class="profile clearfix">
    
    <div class="profile_info">
      <span>Selamat datang, <b><?php echo $this->session->userdata('nama'); ?></b></span>
    </div>
  </div>
	<br />
	<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
		<?php 
		if($this->session->userdata('level') == 'SDM'): ?>
		<div class="menu_section">
			<a href="<?php echo sdm()?>"><h3><i class="fa fa-home"></i> Dashboard</h3></a>
		</div>
		<div class="menu_section">
			<h3>Modul SDM</h3>
			<ul class="nav side-menu">
				<li>
					<a><i class="fa fa-users"></i> Master Pegawai <span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu">
	          <li><a href="<?php echo sdm()?>data_pegawai">Data Pegawai</a></li>
	          <li><a href="<?php echo sdm()?>mutasi_pegawai">Mutasi Pegawai</a></li>
	          <li><a href="<?php echo sdm()?>status_pegawai">Status Pegawai</a></li>
	          <li><a href="<?php echo sdm()?>pemberhentian_pegawai">Pemberhentian Pegawai</a></li>
	          <li><a href="<?php echo sdm()?>akun_pegawai">Generate Akun</a></li>
	        </ul>
				</li>
				<li>
					<a><i class="fa fa-user"></i> Referensi Pegawai <span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu">
						<li><a href="<?php echo sdm()?>unit_kerja">Unit Kerja</a></li>
	          <li><a href="<?php echo sdm()?>jabatan">Jabatan</a></li>
	        </ul>
				</li>
				<li>
					<a><i class="fa fa-calendar"></i> Master Periode <span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu">
	          <li><a href="<?php echo sdm()?>periode">Periode Kerja</a></li>
	          <li><a href="<?php echo sdm()?>jam_kerja">Jam Kerja</a></li>
	          <li><a href="<?php echo sdm()?>pengaturan">Pengaturan</a></li>
	        </ul>
				</li>
				<li>
					<a><i class="fa fa-clock-o"></i> Absensi <span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu">
	          <li><a href="<?php echo sdm()?>absensi/upload">Import/Upload Absensi</a></li>
	          <li><a href="<?php echo sdm()?>absensi/data">Data Absensi</a></li>
	          <li><a href="<?php echo sdm()?>absensi/kelola">Kelola Absensi</a></li>
	          <li><a href="<?php echo sdm()?>absensi/susulan">Absensi Susulan</a></li>
	        </ul>
				</li>
				<li>
					<a><i class="fa fa-clock-o"></i> Tunjangan & Bonus <span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu">
	          <li><a href="<?php echo sdm()?>tunjangan_bonus/lembur">Lembur</a></li>
	          <li><a href="<?php echo sdm()?>tunjangan_bonus/rapat">Rapat</a></li>
	        </ul>
				</li>
				<li>
					<a>Propeka (Cooming Soon)<span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu">
	          <li><a href="<?php echo sdm()?>rkh">Rencana Kerja Harian</a></li>
	          <li><a href="<?php echo sdm()?>rkhlh">Laporan Harian</a></li>
	          <li><a href="<?php echo sdm()?>checklist_lap">Checklist & Laporan Bulanan</a></li>
	        </ul>
				</li>
			</ul>
		</div>
		<?php endif;?>
		
		<?php 
		if($this->session->userdata('level') == 'AKD'): ?>
		<div class="menu_section">
			<a href=""><h3><i class="fa fa-home"></i> Dashboard</h3></a>
		</div>
		<div class="menu_section">
			<h3>Modul Akademik</h3>
			<ul class="nav side-menu">
				<li>
					<a><i class="fa fa-home"></i> Master Akademik <span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu">
	          <li><a href="#">Fakultas</a></li>
	          <li><a href="#">Program Studi</a></li>
	          <li><a href="#">Mata Kuliah</a></li>
	        </ul>
				</li>
				<li>
					<a><i class="fa fa-home"></i> Data Ujian <span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu">
	          <li><a href="<?php echo akademik()?>ujian">UTS/UAS</a></li>
	          <li><a href="<?php echo akademik()?>koreksi">Koreksi UTS/UAS</a></li>
	        </ul>
				</li>
			</ul>
		</div>
		<?php endif;?>

		<?php 
		if($this->session->userdata('level') == 'karyawan'): ?>
		<div class="menu_section" style="padding: 10px;background-color: #2B5DD1;box-shadow: rgba(0,0,0,.25) 0 1px 0, inset rgba(255,255,255,.16) 0 1px 0;">
			<div style="padding-left: 30px;"><a href=""><h3><i class="fa fa-home"></i> Dashboard</h3></a></div>
		</div>
		<div class="menu_section">
			<h3>Modul Karyawan</h3>
			<ul class="nav side-menu">
				<li>
					<a><i class="fa fa-database"></i> Master Data <span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu">
	          <li><a href="<?=karyawan()?>master/absensi">Data Absensi</a></li>
	          <li><a href="<?=karyawan()?>master/lembur">Data Lembur</a></li>
	          <li><a href="<?=karyawan()?>master/rapat">Data Rapat</a></li>
	          <li><a href="<?=karyawan()?>master/ujian">Pengawas & Koreksi Ujian</a></li>
	          <li><a href="<?=karyawan()?>master/penilaian">Data Penilaian Kerja</a></li>
	        </ul>
				</li>
				<li>
					<a><i class="fa fa-pencil"></i> Form Pengajuan <span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu">
	          <li><a href="<?=karyawan()?>form/req_lembur">Pengajuan Lembur</a></li>
	          <li><a href="#">Absensi Susulan (Coming Soon)</a></li>
	          <li><a href="#">Ijin (Coming Soon)</a></li>
	          <li><a href="#">Cuti (Coming Soon)</a></li>
	        </ul>
				</li>
				<li>
					<a><i class="fa fa-file-o"></i> Propeka Pribadi <span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu">
	          <li><a href="<?=karyawan()?>propeka/rkh">Rencana Kerja Harian</a></li>
	          <li><a href="<?=karyawan()?>propeka/lh">Laporan Harian</a></li>
	          <li><a href="<?=karyawan()?>propeka/checklist">Checklist Bulanan</a></li>
	          <li><a href="<?=karyawan()?>propeka/laporan">Laporan Bulanan</a></li>
	        </ul>
				</li>
				<li>
					<a><i class="fa fa-money"></i> Penggajian <span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu">
						<li><a href="<?=karyawan()?>penggajian/tunjangan">Tunjangan/Tambahan</a></li>
						<li><a href="<?=karyawan()?>penggajian/potongan">Potongan</a></li>
						<li><a href="<?=karyawan()?>penggajian/slip">Slip Gaji</a></li>
					</ul>
				</li>
			</ul>
		</div>
		<?php endif;?>
		<?php 
		if($this->session->userdata('kabag') == 'yes'): ?>
		<div class="menu_section">
			<h3>Modul Kepala Bagian/Unit</h3>
			<ul class="nav side-menu">
				<li>
					<a><i class="fa fa-files-o"></i> Propeka Staff <span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu">
	          <li><a href="<?=karyawan()?>kabag/cek_rkhlh">RKH & LH Staff</a></li>
	          <li><a href="<?=karyawan()?>kabag/cek_checklist">Checklist Bulanan Staff</a></li>
	          <li><a href="<?=karyawan()?>kabag/cek_laporan">Laporan Bulanan Staff</a></li>
	        </ul>
				</li>
				<li>
					<a><i class="fa fa-files-o"></i> Penilaian Kinerja <span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu">
						<li><a href="<?=karyawan()?>kabag/penilaian_kerja">Isi Penilaian Kinerja</a></li>
						<li><a href="<?=karyawan()?>kabag/data_penilaian_kerja">Data Penilaian Kinerja</a></li>
					</ul>
				</li>
				<li><a href="<?=karyawan()?>kabag/cek_absensi_susulan"><i class="fa fa-clock-o"></i> Permintaan Absensi Susulan</a></li>
			</ul>
		</div>
		<?php endif;?>
	</div>
	<div class="sidebar-footer hidden-small">
		<a data-toggle="tooltip" data-placement="top" title="Logout" href="<?php echo base_url()?>keluar">
	    <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>
	  </a>
	  <a data-toggle="tooltip" data-placement="top" title="FullScreen" onclick="toggleFullScreen()">
	    <span class="glyphicon glyphicon-resize-full" aria-hidden="true"></span>
	  </a>
	  <a data-toggle="tooltip" data-placement="top" title="Lock">
	    <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
	  </a>
	  <?php if($this->session->userdata('level') == 'karyawan'): ?>
	  <a data-toggle="tooltip" data-placement="top" title="Profil" href="<?=karyawan()?>profil">
	    <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
	  </a>
		<?php elseif($this->session->userdata('level') == 'SDM'): ?>
		<a data-toggle="tooltip" data-placement="top" title="Profil" href="<?=sdm()?>profil">
	    <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
	  </a>
		<?php elseif($this->session->userdata('level') == 'AKD'): ?>
		<a data-toggle="tooltip" data-placement="top" title="Profil" href="<?=akademik()?>profil">
	    <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
	  </a>
		<?php endif; ?>
	</div>
</div>
