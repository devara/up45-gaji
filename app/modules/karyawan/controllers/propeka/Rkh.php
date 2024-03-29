<?php defined('BASEPATH') OR exit('');
/**
* 
*/
class Rkh extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
    if ($this->lib_login->is_karyawan()==FALSE) {
    	redirect(base_url());
    }
	}

	function index()
	{
		$data['periode'] = $this->my_lib->get_data('master_periode','','mulai ASC');
		$data['javascript'] = $this->load->view('propeka/propeka-rkh-js',$data,true);
		$this->load->view('propeka/propeka-rkh',$data);
	}

	function tampil()
	{
		$this->form_validation->set_rules('per', 'Periode Kerja', 'required');
		$this->form_validation->set_rules('nip', 'NIP', 'required');
		if ($this->form_validation->run() == TRUE) {
			$nip = $this->input->post('nip');
			$per = $this->input->post('per');
			$param = array(
				'id_periode' => $per,
				'nip'	=> $nip
			);
			$data['periode'] = $this->my_lib->get_data('master_periode',array('id_periode'=>$per));
			$data['rkh'] = $this->my_lib->get_data('data_rkhlh',$param);
			$data['pegawai'] = $this->my_lib->get_data('data_pegawai',array('nip'=>$nip));
			$tabel = $this->load->view('propeka/propeka-rkh-tabel',$data,true);
			$message[] = array('code'=>200,'message'=>'Data Tersedia.','tabel'=>$tabel);
		}
		else{
			$message[] = array('code'=>404,'message' => validation_errors('<div class="error">', '</div>'));
		}
		$this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($message));
	}

	function cek()
	{
		$this->form_validation->set_rules('per', 'Periode Kerja', 'required');
		$this->form_validation->set_rules('nip', 'NIP', 'required');
		$this->form_validation->set_rules('tgl', 'Tangal', 'required');
		if ($this->form_validation->run() == TRUE) {
			$per = $this->input->post('per');
			$nip = $this->input->post('nip');
			$tgl = $this->input->post('tgl');
			$param = array(
				'id_periode' => $per,
				'tanggal' => $tgl,
				'nip'	=> $nip
			);
			$cekData = $this->my_lib->get_data('data_rkhlh',$param);
			if ($cekData) {
				$message[] = array('code'=>200,'message'=>'Data Tersedia.','status'=>'Anda sudah membuat RKH untuk tanggal ini');
			}
			else {
				$message[] = array('code'=>500,'message'=>'Data Belum Tersedia.','status'=>'tidak');
			}
			
		}
		else{
			$message[] = array('code'=>404,'message' => validation_errors('<div class="error">', '</div>'));
		}
		$this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($message));
	}

	function tambah()
	{
		$periode = $this->input->post('periode');
		$tgl = $this->input->post('tanggal');
		$nip = $this->input->post('pegawai');
		$data = array(
			'id_periode' => $periode,'tanggal' => $tgl,
			'nip' => $nip,'tgl_buat_rkh' => date('Y-m-d H:i:s')
		);
		$addrkh = $this->db->insert('data_rkhlh',$data);
		if ($addrkh) {
			$rkhID = $this->my_lib->last_insert_id();
			$keg = $this->input->post('keg');
			$result = array();
			foreach ($keg as $key => $val) {
				$result[] = array(
	      'id_rkhlh'	=> $rkhID,'kegiatan' 	=> $_POST['keg'][$key],
	      'mulai_rkh'	=> $_POST['dari'][$key],'sampai_rkh' => $_POST['sampai'][$key]
	    	);				
			}
			$insert_kegiatan = $this->db->insert_batch('data_rkhlh_detail', $result);
			if ($insert_kegiatan) {
				$alert_type = "success";
	      $alert_title ="Berhasil Membuat Rencana Kerja Harian";
				set_header_message($alert_type,'Submit Rencana Kerja Harian',$alert_title);
				redirect(karyawan().'propeka/rkh');
			}else{
				$this->my_lib->delete_row('data_rkhlh',array('id_rkhlh'=>$rkhID));
				$alert_type = "danger";
	      $alert_title ="Gagal Membuat Rencana Kerja Harian";
				set_header_message($alert_type,'Submit Rencana Kerja Harian',$alert_title);
				redirect(karyawan().'propeka/rkh');
			}
		}else{
			$alert_type = "danger";
      $alert_title ="Gagal Membuat Rencana Kerja Harian";
			set_header_message($alert_type,'Submit Rencana Kerja Harian',$alert_title);
			redirect(karyawan().'propeka/rkh');
		}
	}

	function lihat_detail($id)
	{
		$data['detail'] = $this->my_lib->get_data('data_rkhlh_detail',array('id_rkhlh'=>$id));
		$detailRKH = $this->load->view('propeka/propeka-rkh-detail',$data,true);
		$message[] = array('code'=>200,'message'=>'Data Tersedia.','detail'=>$detailRKH);

		$this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($message));
	}
}
