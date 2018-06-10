<?php defined('BASEPATH') OR exit('');
/**
 * 
 */
class Checklist extends CI_Controller
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
		$data['javascript'] = $this->load->view('propeka/propeka-cb-js',$data,true);
		$this->load->view('propeka/propeka-cb',$data);
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
			$cek_id_data = $this->my_lib->get_row('data_checklist_laporan_bulanan',$param,'id_cb_lb');

			$data['periode'] = $this->my_lib->get_data('master_periode',array('id_periode'=>$per));
			$data['checklist'] = $this->my_lib->get_data('data_checklist_laporan_bulanan_detail',array('id_cb_lb'=>$cek_id_data));
			$data['pegawai'] = $this->my_lib->get_data('data_pegawai',array('nip'=>$nip));
			$tabel = $this->load->view('propeka/propeka-cb-tabel',$data,true);
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
		if ($this->form_validation->run() == TRUE) {
			$per = $this->input->post('per');
			$nip = $this->input->post('nip');
			$param = array(
				'id_periode' => $per,
				'nip'	=> $nip
			);
			$cekData = $this->my_lib->get_data('data_checklist_laporan_bulanan',$param);
			if ($cekData) {
				$message[] = array('code'=>200,'message'=>'Data Tersedia.','status'=>'Anda sudah membuat Checklist untuk periode ini');
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
}
