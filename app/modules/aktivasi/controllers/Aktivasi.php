<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
class Aktivasi extends CI_Controller
{
	
	function auth()
	{
		$token = $this->input->get('tokenRef');
		$cek_user = $this->my_lib->cek('data_pegawai',array('aktivasi_token'=>$token));
		if ($cek_user == TRUE) {
			$get_token_expired = $this->my_lib->get_row('data_pegawai',array('aktivasi_token'=>$token),'aktivasi_token_expired');
			
			if ($get_token_expired > date('Y-m-d H:i:s')) {
				$data['nip'] = $this->my_lib->get_row('data_pegawai',array('aktivasi_token'=>$token),'nip');
				$data['nama'] = $this->my_lib->get_row('data_pegawai',array('aktivasi_token'=>$token),'nama');
				$this->load->view('aktivasi-akun',$data);
			}
			else{
				echo "<script>window.alert('Maaf! Token sudah Expired !');window.location=('".base_url()."')</script>";
			}
		}
		else{ #jika token tidak valid
			echo "<script>window.alert('Maaf! Token tidak valid !');window.location=('".base_url()."')</script>";
		}
	}

	function proses()
	{
		$this->form_validation->set_rules('token', 'Token Aktivasi', 'required');
		$this->form_validation->set_rules('nip', 'NIP Pegawai', 'required');
		$this->form_validation->set_rules('username', 'Username Pegawai', 'required');
		$this->form_validation->set_rules('password', 'Password Pegawai', 'required');
		if ($this->form_validation->run() == TRUE) {
			$token = $this->input->post('token');
			$nip = $this->input->post('nip');
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$param = array('nip'=>$nip);
			$value = array(
				'username' => $username,
				'password' => password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]),
				'aktivasi_token' => "",
				'aktivasi_token_expired' => NULL
			);
			$aktivasi = $this->my_lib->edit_row('data_pegawai',$value,$param);
			if ($aktivasi) {
				echo "<script>window.alert('Selamat, Aktivasi Akun Anda berhasil ! Silakan login sistem');window.location=('".base_url()."')</script>";
			}
			else{
				echo "<script>window.alert('Maaf! Gagal melakukan Aktivasi Akun !');window.location=('".base_url()."aktivasi-akun?tokenRef=".$token."')</script>";
			}
		}
		else{
			echo "<script>window.alert('Maaf! Data tidak lengkap !');window.location=('".base_url()."aktivasi-akun?tokenRef=".$token."')</script>";
		}
	}
}
