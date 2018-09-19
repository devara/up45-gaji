<?php defined('BASEPATH') OR exit('');
/**
 * 
 */
use \Mailjet\Resources;
class Mail extends CI_Controller
{
	
	function index()
	{
		// use your saved credentials
		$mj = new \Mailjet\Client('8c4c7d65acd6ec0449e6f3312e291275','44582ddc644bf30c8368d8369f7e44ac',true,['version' => 'v3.1']);
		$mail_user = "devaraekokm@gmail.com";
		$nama_user = "Devara Eko";
		$cek_email = $this->my_lib->cek('data_pegawai',array('email'=>$mail_user));
		if ($cek_email == TRUE) {
			$nip = $this->my_lib->get_row('data_pegawai',array('email'=>$mail_user),'nip');
			$encrypted_id = bin2hex(random_bytes(32));
			$token_enkripsi = password_hash($mail_user,PASSWORD_DEFAULT);
			$startDate = time();
			$expired = date('Y-m-d H:i:s', strtotime('+1 day', $startDate));
			$data['token'] = $token_enkripsi;
			$data['nama'] = $this->my_lib->get_row('data_pegawai',array('email'=>$mail_user),'nama');
			$data['username'] = $this->my_lib->get_row('data_pegawai',array('email'=>$mail_user),'username');
			$value = array(
				'token' => $token_enkripsi,
				'token_expired' => $expired
			);
			$param = array(
				'nip' => $nip
			);
			$add_token = $this->my_lib->edit_row('data_pegawai',$value,$param);
			$pesan_html = $this->load->view('mail_template/forget_password',$data,true);
			$body = [
		    'Messages' => [
		        [
		            'From' => [
		                'Email' => "developer.up45@gmail.com",
		                'Name' => "Sistem Gaji"
		            ],
		            'To' => [
		                [
		                    'Email' => $mail_user,
		                    'Name' => $nama_user
		                ]
		            ],
		            'Subject' => "Reset Password",
		            'HTMLPart' => $pesan_html
		        ]
		    ]
			];
			// Resources are all located in the Resources class
			$response = $mj->post(Resources::$Email, ['body' => $body]);

		/*
		  Read the response
		*/
			if ($response->success())
		  	echo $response->getStatus();
			else
		  	var_dump($response->getStatus());
		}
		else{

		}
		
	}
}
