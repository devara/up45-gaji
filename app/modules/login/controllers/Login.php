<?php defined('BASEPATH') OR exit('');
/**
* 
*/
class Login extends CI_Controller
{
	function index(){
    if($this->lib_login->is_karyawan()==true){
      redirect(karyawan());
    }
    elseif ($this->lib_login->is_sdm()==true) {
    	redirect(sdm());
    }
    elseif ($this->lib_login->is_akademik()==true) {
    	redirect(akademik());
    }
    elseif ($this->lib_login->is_keuangan()==true) {
    	redirect(keuangan());
    }
    else{
      $this->load->view('login_view');
    }
  }

  function open_login()
  {
    $this->form_validation->set_rules('level', 'Level Akses', 'required');
  	$this->form_validation->set_rules('username', 'Nama Pengguna', 'required');
    $this->form_validation->set_rules('password', 'Kata Sandi', 'required');
    if ($this->form_validation->run() == true) {
    	$uname = $this->input->post('username');
    	$pwd = $this->input->post('password');
    	$level = $this->input->post('level');
    	$login = $this->lib_login->cek_login($uname,$pwd,$level);
    	if ($login['status']==200) {
    		if ($login['level']=='SDM') {
          redirect(base_url().'sdm/');
        }
        elseif ($login['level']=='Akademik') {
          redirect(base_url().'akademik/');
        }
        elseif ($login['level']=='Keuangan') {
          redirect(base_url().'keuangan/');
        }
        elseif ($login['level']=='karyawan') {
          redirect(base_url().'karyawan/');
        }
    	}
      elseif ($login['status']==404) {
        $this->session->set_flashdata('flash_message','Username atau password Anda salah.');
        redirect(base_url().'login/');
      }
    	elseif ($login['status']==500) {    		
        $this->session->set_flashdata('flash_message','Akun Anda bukan level '.$level.'.');
        redirect(base_url().'login/');
    	}
    	elseif ($login['status']==505) {
    		$this->session->set_flashdata('flash_message','Akun Anda tidak aktif.');
        redirect(base_url().'login/');
    	}
    }
    else{
    	$this->session->set_flashdata('flash_message','Semua data harus diisi.');
      redirect(base_url().'login/');
    }
  }

  function logout()
  {
    $this->lib_login->logout();
    redirect(base_url());
  }
}