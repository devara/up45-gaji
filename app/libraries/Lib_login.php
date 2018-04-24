<?php

class Lib_login{
	public function __construct(){
    $this->ci =& get_instance();
    $this->ci->load->library('my_lib');
  }

	function is_karyawan()
	{
		if ($this->ci->session->userdata('level')=='karyawan') {
			return true;
		}
		else{
			return false;
		}
	}

	function is_sdm()
	{
		if ($this->ci->session->userdata('level')=='SDM') {
			return true;
		}
		else{
			return false;
		}
	}

	function is_akademik()
	{
		if ($this->ci->session->userdata('level')=='AKD') {
			return true;
		}
		else{
			return false;
		}
	}

	function is_keuangan()
	{
		if ($this->ci->session->userdata('level')=='KEU') {
			return true;
		}
		else{
			return false;
		}
	}

	function cek_login($uname,$pwd,$level)
	{
		$user = $this->ci->m_user->get_user_by_username($uname);
		
		if ($level=='karyawan') {
			if ($user) {
				if ($user->row('password') == md5($pwd)) {
					$this->ci->session->set_userdata(array(
            'username'  => $user->row('username'),
            'password'   => $user->row('password')
          ));
          $hasil['status'] = 200;
          $hasil['level'] = 'karyawan';
				}
				else{
					$hasil['status'] = 404;
				}
			}
			else{
				$hasil['status'] = 404;
			}
		}
		
		else {
			if ($user) {
				if ($user->row('kode_unit') == $level) {
					if ($user->row('password') == md5($pwd)) {
						$this->ci->session->set_userdata(array(
              'nama'	=> $user->row('nama'),
              'username'  => $user->row('username'),
              'password'   => $user->row('password'),
              'level'  => $user->row('kode_unit')
            ));
            $hasil['status'] = 200;
            $hasil['level'] = $user->row('kode_unit');
					}
					else{
						$hasil['status'] = 404;
					}
				}
				else{
					$hasil['status'] = 500;
				}
			}
			else{
				$hasil['status'] = 404;
			}
		}

		return $hasil;
	}

	function logout()
	{
		$this->ci->session->sess_destroy();
	}
}