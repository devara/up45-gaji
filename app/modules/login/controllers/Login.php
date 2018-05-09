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
      $data['datatables'] = 'no';
      $data['javascript'] = $this->load->view('login-js',$data,true);
      $this->load->view('login_view',$data);
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
        elseif ($login['level']=='AKD') {
          redirect(base_url().'akademik/');
        }
        elseif ($login['level']=='KEU') {
          redirect(base_url().'keuangan/');
        }
        elseif ($login['level']=='karyawan') {
          redirect(base_url().'karyawan/');
        }
    	}
      elseif ($login['status']==404) {
        $this->session->set_flashdata('login_message','Username atau password Anda salah.');
        redirect(base_url().'login/');
      }
    	elseif ($login['status']==500) {    		
        $this->session->set_flashdata('login_message','Akun Anda bukan level '.$level.'.');
        redirect(base_url().'login/');
    	}
    	elseif ($login['status']==505) {
    		$this->session->set_flashdata('login_message','Akun Anda tidak aktif.');
        redirect(base_url().'login/');
    	}
    }
    else{
    	$this->session->set_flashdata('login_message','Semua data harus diisi.');
      redirect(base_url().'login/');
    }
  }

  function logout()
  {
    $this->lib_login->logout();
    redirect(base_url());
  }

  function action_form()
  {
    $act = $this->input->post('act');
    if ($act == 'forget') {
      $data['action'] = 'forget';      
    }
    else{
      $data['action'] = 'login';
    }
    $action_form = $this->load->view('action-form',$data,true);
    $message[] = array('code'=>200,'message'=>'Data Tersedia.','form'=>$action_form);

    $this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($message));
  }
}