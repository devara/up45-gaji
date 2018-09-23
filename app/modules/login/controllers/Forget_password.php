<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
use \Mailjet\Resources;
class Forget_password extends CI_Controller
{
	function submit()
	{
		$mj = new \Mailjet\Client('8c4c7d65acd6ec0449e6f3312e291275','44582ddc644bf30c8368d8369f7e44ac',true,['version' => 'v3.1']);
		$this->form_validation->set_rules('email', 'Alamat Email', 'required');
		if ($this->form_validation->run() == TRUE) {
			$email = $this->input->post('email');
			$cek_email = $this->my_lib->cek('data_pegawai',array('email'=>$email));
			if ($cek_email == TRUE) {
				$nip = $this->my_lib->get_row('data_pegawai',array('email'=>$email),'nip');
				$encrypted_id = bin2hex(random_bytes(32));
				$token_enkripsi = password_hash($email,PASSWORD_DEFAULT);
				$startDate = time();
				$expired = date('Y-m-d H:i:s', strtotime('+1 day', $startDate));
				$data['token'] = $token_enkripsi;
				$data['nama'] = $this->my_lib->get_row('data_pegawai',array('email'=>$email),'nama');
				$data['username'] = $this->my_lib->get_row('data_pegawai',array('email'=>$email),'username');
				$value = array(
					'token' => $token_enkripsi,
					'token_expired' => $expired
				);
				$param = array(
					'nip' => $nip
				);
				$pesan_html = $this->load->view('reset',$data,true);
				$body = [
			    'Messages' => [
			      [
			      	'From' => [
			      		'Email' => "developer.up45@gmail.com",
			      		'Name' => "Sistem Gaji"
			      	],
			      	'To' => [
			      		[
			      			'Email' => $email,
			      			'Name' => $data['nama']
			      		]
			      	],
			      	'Subject' => "Reset Password",
			      	'HTMLPart' => $pesan_html
			      ]
			    ]
				];
				$response = $mj->post(Resources::$Email, ['body' => $body]);
			  if ($response->success()) { #Jika email berhasil dikirim
			  	$add_token = $this->my_lib->edit_row('data_pegawai',$value,$param);
			  	if ($add_token) {
			  		echo "<script>window.alert('Selamat! Periksa email anda untuk verifikasi !');window.location=('".base_url()."')</script>";
			  	}
			  	
			  }
			  else{ #Jika email gagal dikirim
			  	echo "<script>window.alert('Maaf! Email tidak terkirim !');window.location=('".base_url()."')</script>";
			  }
			}
			else{
				echo "<script>window.alert('Maaf! Email tidak terdaftar !');window.location=('".base_url()."')</script>";
			}		  
		}
		else{
			#Form email harus di isi

		}
	}
}
