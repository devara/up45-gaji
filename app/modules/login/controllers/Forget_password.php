<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
use PHPMailer\PHPMailer\PHPMailer;
class Forget_password extends CI_Controller
{
	function submit()
	{
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
				
				$mail = new PHPMailer;
				$mail->isSMTP();
				$mail->SMTPDebug = false;
				$mail->do_debug = 0;
				$mail->SMTPAuth = true;
				$mail->SMTPSecure = 'tls';
				$mail->Host = 'ssl://smtp.gmail.com';
				$mail->Port = 465;
				$mail->Username = "developer.up45@gmail.com";
				$mail->Password = "@Devara1995";
				$mail->setFrom('developer.up45@gmail.com', 'Sistem Informasi Penggajian UP45');
				$mail->addAddress($email);
				$mail->Subject = 'Reset Password';
				$mail->isHTML(true);
			  $mail->Body = $pesan_html;
			  if ($mail->send()) { #Jika email berhasil dikirim
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
