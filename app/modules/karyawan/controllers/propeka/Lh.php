<?php defined('BASEPATH') OR exit('');
/**
* 
*/
class Lh extends CI_Controller
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
		$data['periode'] = $this->my_lib->get_data('master_periode');
		$data['datatables'] = 'yes';
		$data['javascript'] = $this->load->view('propeka/propeka-lh-js',$data,true);
		$this->load->view('propeka/propeka-lh',$data);
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
			$tabel = $this->load->view('propeka/propeka-lh-tabel',$data,true);
			$message[] = array('code'=>200,'message'=>'Data Tersedia.','tabel'=>$tabel);
		}
		else{
			$message[] = array('code'=>404,'message' => validation_errors('<div class="error">', '</div>'));
		}
		$this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($message));
	}

	function getrkh_by_tgl($tgl=FALSE)
	{
		$nip = $this->session->userdata('nip');
		$param = array(
			'tanggal' => $tgl,
			'nip' => $nip
		);
		$id_rkhlh = $this->my_lib->get_row('data_rkhlh',$param,'id_rkhlh');
		$cek_rkh = $this->my_lib->cek('data_rkhlh_detail',array('id_rkhlh'=>$id_rkhlh));
		if ($cek_rkh == TRUE) {
			$cek_lh = $this->my_lib->cek('data_rkhlh_detail',array('id_rkhlh'=>$id_rkhlh,'rkh_lh_lengkap'=>'tidak'));
			if ($cek_lh == TRUE) {
				$data['status'] = 1; // RKH sudah ada dan LH belum terisi
			}
			else{
				$data['status'] = 2; // RKH sudah ada dan LH sudah terisi
			}
		}
		else{
			$data['status'] = 0; // RKH belum ada
		}

		$data['detail'] = $this->my_lib->get_data('data_rkhlh_detail',array('id_rkhlh'=>$id_rkhlh));
		$data['tanggal'] = $tgl;
		$formRKH = $this->load->view('propeka/propeka-lh-form',$data,true);
		$message[] = array('code'=>200,'message'=>'Data Tersedia.','form'=>$formRKH);

		$this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($message));
	}

	function buat_lh()
	{
		$tgl = $this->input->post('tanggal');
		$tgl_indo = $this->lib_calendar->convert($tgl);
		$id = $this->input->post('id');
		$result = array();
		foreach ($id as $key => $val) {
			$result[] = array(
				'id_rkhlh_detail' => $_POST['id'][$key],
				'mulai_lh' => $_POST['lh_mulai'][$key],
				'sampai_lh' => $_POST['lh_sampai'][$key],
				'keterangan' => $_POST['ket'][$key],
				'rkh_lh_lengkap' => 'ya'
			);
		}
		$update= $this->db->update_batch('data_rkhlh_detail', $result,'id_rkhlh_detail');
		if ($update) {
			$alert_type = "success";
      $alert_title ="Berhasil Membuat Laporan Harian ".$tgl_indo."";
			set_header_message($alert_type,'Submit Laporan Harian',$alert_title);
			redirect(karyawan().'propeka/lh');
		}
	}

	function lihat_detail($id)
	{
		$data['detail'] = $this->my_lib->get_data('data_rkhlh_detail',array('id_rkhlh'=>$id));
		$detailRKH = $this->load->view('propeka/propeka-lh-detail',$data,true);
		$message[] = array('code'=>200,'message'=>'Data Tersedia.','detail'=>$detailRKH);

		$this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($message));
	}

}
