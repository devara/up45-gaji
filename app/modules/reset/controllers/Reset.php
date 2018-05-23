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
				$this->load->view('reset_password');
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
		
	}
}
