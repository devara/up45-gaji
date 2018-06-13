<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
class Reset extends CI_Controller
{
	
	function auth($uname)
	{
		$token = $this->input->get('tokenRef');
		$cek_user = $this->my_lib->cek('data_pegawai',array('username'=>$uname,'token'=>$token));
		if ($cek_user == TRUE) {
			$get_token_expired = $this->my_lib->get_row('data_pegawai',array('username'=>$uname),'token_expired');
			
			if ($get_token_expired > date('Y-m-d H:i:s')) {
				$data['token'] = $token;
				$data['username'] = $uname;
				$this->load->view('reset_password',$data);
			}
			else{
				echo "<script>window.alert('Maaf! Token sudah Expired !');window.location=('".base_url()."')</script>";
			}
		}
		else{ #jika token tidak valid
			echo "<script>window.alert('Maaf! Token tidak valid !');window.location=('".base_url()."')</script>";
		}
	}

	function submit()
	{
		$this->form_validation->set_rules('token', 'Token Aktivasi', 'required');
		$this->form_validation->set_rules('username', 'Username Pegawai', 'required');
		$this->form_validation->set_rules('new_pass', 'Password Pegawai', 'required');
		if ($this->form_validation->run() == TRUE) {
			$token = $this->input->post('token');
			$username = $this->input->post('username');
			$new_pass = $this->input->post('new_pass');

			$param = array('username'=>$username);
			$value = array(
				'password'=>md5($new_pass)
			);
			$update_password = $this->my_lib->edit_row('data_pegawai',$value,$param);
			if ($update_password) {
				echo "<script>window.alert('Password berhasil diperbarui ! Silakan login Sistem !');window.location=('".base_url()."')</script>";
			}
			else{
				echo "<script>window.alert('Maaf! Password gagal diperbarui !');window.location=('".base_url()."reset-password/".$username."?tokenRef=".$token."')</script>";
			}
		}
		else{
			echo "<script>window.alert('Maaf! Data tidak lengkap !');window.location=('".base_url()."reset-password/".$username."?tokenRef=".$token."')</script>";
		}
	}
}
