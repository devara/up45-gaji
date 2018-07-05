<?php defined('BASEPATH') OR exit('');
/**
 * 
 */
class Data_penilaian_kerja extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
    if ($this->lib_login->is_kabag()==FALSE) {
    	redirect(base_url());
    }
	}

	function index()
	{
		$data['periode'] = $this->my_lib->get_data('master_periode');
		$data['javascript'] = $this->load->view('kabag/penilaian-kerja-js',$data,true);
		$param = array(
			'under_of_jabatan'=> $this->session->userdata('jabatan')
		);
		$join = 'master_jabatan.kode_jabatan = data_pegawai.kode_jabatan';
		$data['pegawai'] = $this->my_lib->get_data_join('master_jabatan','data_pegawai',$param,$join);
		$this->load->view('kabag/data-penilaian-kerja',$data);
	}

	function lihat_penilaian()
	{
		$this->form_validation->set_rules('per', 'Periode Kerja', 'required');
		$this->form_validation->set_rules('jab', 'Kode Jabatan', 'required');
		if ($this->form_validation->run() == TRUE) {
			$per = $this->input->post('per');
			$jab = $this->input->post('jab');
			$param = array(
				'id_periode' => $per,
				'pemberi_nilai'	=> $jab
			);
			$join = 'data_pegawai.nip = data_penilaian.nip';
			$data['periode'] = $this->my_lib->get_data('master_periode',array('id_periode'=>$per));
			$data['penilaian'] = $this->my_lib->get_data_join('data_pegawai','data_penilaian',$param,$join);
			$tabel = $this->load->view('kabag/data-penilaian-kerja-tabel',$data,true);
			$message[] = array('code'=>200,'message'=>'Data Tersedia.','tabel'=>$tabel);
		}
		else{
			$message[] = array('code'=>404,'message' => validation_errors('<div class="error">', '</div>'));
		}
		$this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($message));
	}
}
