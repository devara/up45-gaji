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
				$encrypted_id = md5($email);
				$data['token'] = md5($email);
				$data['nama'] = $this->my_lib->get_row('data_pegawai',array('email'=>$email),'nama');
				$pesan_html = $this->load->view('reset_password_mail_template',$data,true);
				
				$mail = new PHPMailer;
				$mail->isSMTP();
				$mail->SMTPDebug = false;
				$mail->do_debug = 0;
				$mail->SMTPAuth = true;
				$mail->SMTPSecure = 'tls';
				$mail->Host = 'mail.gaji.up45.ac.id';
				$mail->Port = 587;
				$mail->Username = "info@gaji.up45.ac.id";
				$mail->Password = "@Devara1995";
				$mail->setFrom('info@gaji.up45.ac.id', 'Universitas Proklamasi 45');
				$mail->addAddress($email);
				$mail->Subject = 'Reset Password';
				$mail->isHTML(true);
			  $mail->Body    = $pesan_html;
			  if ($mail->send()) { #Jika email berhasil dikirim
			  	echo "<script>window.alert('Selamat! Periksa email anda untuk verifikasi !');window.location=('".base_url()."')</script>";
			  }
			  else{ #Jika email gagal dikirim
			  	echo "<script>window.alert('Maaf! Email tidak terkirim !');window.location=('".base_url()."')</script>";
			  }
			}
			else{
				#Jika data email tidak tersedia di database
				echo "<script>window.alert('Maaf! Email tidak tersedia !');window.location=('".base_url()."')</script>";
			}		  
		}
		else{
			#Form email harus di isi
		}
	}
}
