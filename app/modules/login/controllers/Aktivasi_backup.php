<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
use PHPMailer\PHPMailer\PHPMailer;
class Aktivasi_backup extends CI_Controller
{
	
	function submit()
	{
		$this->form_validation->set_rules('nip_pegawai', 'NIP Pegawai', 'required');
		$this->form_validation->set_rules('email_pegawai', 'Alamat Email', 'required');
		if ($this->form_validation->run() == TRUE) {
			$nip = $this->input->post('nip_pegawai');
			$email = $this->input->post('email_pegawai');
			$cek_nip = $this->my_lib->cek('data_pegawai',array('nip'=>$nip));
			if ($cek_nip == TRUE) {
				$id = $this->my_lib->get_row('data_pegawai',array('nip'=>$nip),'id');
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
					'id' => $id
				);
				$pesan_html = $this->load->view('aktivasi_akun',$data,true);
				$mail = new PHPMailer;
				$mail->isSMTP();
				$mail->SMTPDebug = false;
				$mail->do_debug = 0;
				$mail->SMTPAuth = true;
				$mail->SMTPSecure = 'tls';
				$mail->Host = 'ssl://smtp.gmail.com';
				$mail->Port = 465;
				$mail->Username = "web.bisindo@gmail.com";
				$mail->Password = "@Devara1995";
				$mail->setFrom('web.bisindo@gmail.com', 'Universitas Proklamasi 45');
				$mail->addAddress($email);
				$mail->Subject = 'Aktivasi Akun';
				$mail->isHTML(true);
			  $mail->Body = $pesan_html;
			  if ($mail->send()) { #Jika email berhasil dikirim
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
