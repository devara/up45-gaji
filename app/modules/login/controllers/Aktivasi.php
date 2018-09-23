<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
use \Mailjet\Resources;
class Aktivasi extends CI_Controller
{
	
	function submit()
	{
		$mj = new \Mailjet\Client('8c4c7d65acd6ec0449e6f3312e291275','44582ddc644bf30c8368d8369f7e44ac',true,['version' => 'v3.1']);
		$this->form_validation->set_rules('nip_pegawai', 'NIP Pegawai', 'required');
		$this->form_validation->set_rules('email_pegawai', 'Alamat Email', 'required');
		if ($this->form_validation->run() == TRUE) {
			$nip = $this->input->post('nip_pegawai');
			$email = $this->input->post('email_pegawai');
			$cek_nip = $this->my_lib->cek('data_pegawai',array('nip'=>$nip));
			if ($cek_nip == TRUE) {
				$token_enkripsi = password_hash($nip,PASSWORD_DEFAULT);
				$encrypted_id = bin2hex(random_bytes(32));
				$startDate = time();
				$expired = date('Y-m-d H:i:s', strtotime('+1 day', $startDate));
				$data['token'] = $encrypted_id;
				$data['nip'] = $nip;
				$data['nama'] = $this->my_lib->get_row('data_pegawai',array('nip'=>$nip),'nama');

				$value = array(
					'email' => $email,
					'aktivasi_token' => $encrypted_id,
					'aktivasi_token_expired' => $expired
				);
				$param = array(
					'nip' => $nip
				);
				$pesan_html = $this->load->view('aktivasi',$data,true);
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
			      	'Subject' => "Aktivasi Akun",
			      	'HTMLPart' => $pesan_html
			      ]
			    ]
				];
				$response = $mj->post(Resources::$Email, ['body' => $body]);
			  if ($response->success()) { #Jika email berhasil dikirim
			  	$add_token = $this->my_lib->edit_row('data_pegawai',$value,$param);
			  	if ($add_token) {
			  		echo "<script>window.alert('Selamat! Periksa email anda untuk aktivasi !');window.location=('".base_url()."')</script>";
			  	}
			  	
			  }
			  else{ #Jika email gagal dikirim
			  	echo "<script>window.alert('Maaf! Email tidak terkirim !');window.location=('".base_url()."')</script>";
			  }
			}
			else{
				echo "<script>window.alert('Maaf! NIP tidak terdaftar !');window.location=('".base_url()."')</script>";
			}
		}
		else{
			#Form email harus di isi
			echo "<script>window.alert('Maaf! Data tidak lengkap !');window.location=('".base_url()."')</script>";
		}
	}
}
