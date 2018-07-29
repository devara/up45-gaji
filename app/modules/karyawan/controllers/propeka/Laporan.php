<?php defined('BASEPATH') OR exit('');
/**
 * 
 */
class Laporan extends CI_Controller
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
		$data['javascript'] = $this->load->view('propeka/propeka-lb-js',$data,true);
		$this->load->view('propeka/propeka-lb',$data);
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
			$id_cblb = $this->my_lib->get_row('data_checklist_laporan_bulanan',$param,'id_cb_lb');
			$data['periode'] = $this->my_lib->get_data('master_periode',array('id_periode'=>$per));
			$data['laporan'] = $this->my_lib->get_data('data_checklist_laporan_bulanan_detail',array('id_cb_lb'=>$id_cblb,'cb_lb_lengkap'=>'ya'));
			$data['pegawai'] = $this->my_lib->get_data('data_pegawai',array('nip'=>$nip));
			$tabel = $this->load->view('propeka/propeka-lb-tabel',$data,true);
			$message[] = array('code'=>200,'message'=>'Data Tersedia.','tabel'=>$tabel);
		}
		else{
			$message[] = array('code'=>404,'message' => validation_errors('<div class="error">', '</div>'));
		}
		$this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($message));
	}

	function get_checklist_by_periode($periode=FALSE)
	{
		$nip = $this->session->userdata('nip');
		$param = array(
			'id_periode' => $periode,
			'nip' => $nip
		);
		$id_cblb = $this->my_lib->get_row('data_checklist_laporan_bulanan',$param,'id_cb_lb');
		$cek_cb = $this->my_lib->cek('data_checklist_laporan_bulanan',$param);
		if ($cek_cb == TRUE) {
			$cek_lb = $this->my_lib->cek('data_checklist_laporan_bulanan_detail',array('id_cb_lb'=>$id_cblb,'cb_lb_lengkap'=>'tidak'));
			if ($cek_lb == TRUE) {
				$data['status'] = 1; // RKH sudah ada dan LH belum terisi
			}
			else{
				$data['status'] = 2; // RKH sudah ada dan LH sudah terisi
			}
		}
		else{
			$data['status'] = 0; // RKH belum ada
		}

		$data['detail'] = $this->my_lib->get_data('data_checklist_laporan_bulanan_detail',array('id_cb_lb'=>$id_cblb));
		$data['periode'] = $periode;
		$data['min_tgl'] = $this->my_lib->get_row('master_periode',array('id_periode'=>$periode),'mulai');
		$data['max_tgl'] = $this->my_lib->get_row('master_periode',array('id_periode'=>$periode),'akhir');
		$formRKH = $this->load->view('propeka/propeka-lb-form',$data,true);
		$message[] = array('code'=>200,'message'=>'Data Tersedia.','form'=>$formRKH);

		$this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($message));
	}

	function buat_laporan()
	{
		$periode = $this->input->post('periode');
		$nip = $this->session->userdata('nip');
		$id = $this->input->post('id');
		$result = array();
		foreach ($id as $key => $val) {
			$result[] = array(
				'id_data_detail' => $_POST['id'][$key],
				'lb_tgl_mulai' => $_POST['lb_mulai'][$key],
				'lb_tgl_selesai' => $_POST['lb_sampai'][$key],
				'keterangan' => $_POST['ket'][$key],
				'cb_lb_lengkap' => 'ya'
			);
		}
		$update_detail = $this->db->update_batch('data_checklist_laporan_bulanan_detail', $result,'id_data_detail');
		$param = array(
			'id_periode' => $periode,
			'nip' => $nip
		);
		$val = array('tgl_buat_laporan_bulanan' => date('Y-m-d H:i:s'));
		$update_cblb = $this->my_lib->edit_row('data_checklist_laporan_bulanan',$val,$param);
		if ($update_detail && $update_cblb) {
			$alert_type = "success";
      $alert_title ="Berhasil Membuat Laporan Bulanan";
			set_header_message($alert_type,'Submit Laporan Harian',$alert_title);
			redirect(karyawan().'propeka/laporan');
		}
	}
}
