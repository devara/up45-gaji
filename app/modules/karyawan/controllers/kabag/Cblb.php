<?php defined('BASEPATH') OR exit('');
/**
 * 
 */
class Cblb extends CI_Controller
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
		$data['periode'] = $this->my_lib->get_data('master_periode','','mulai ASC');
		$param = array(
			'under_of_jabatan'=> $this->session->userdata('jabatan')
		);
		$join = 'master_jabatan.kode_jabatan = data_pegawai.kode_jabatan';
		$data['pegawai'] = $this->my_lib->get_data_join('master_jabatan','data_pegawai',$param,$join);
		$data['javascript'] = $this->load->view('kabag/cblb-js',$data,true);
		$this->load->view('kabag/cblb',$data);
	}

	function tampil()
	{
		$this->form_validation->set_rules('per', 'Periode Kerja', 'required');
		$this->form_validation->set_rules('nip', 'Nama Pegawai', 'required');
		if ($this->form_validation->run() == TRUE) {
			$per = $this->input->post('per');
			$nip = $this->input->post('nip');
			$param = array(
				'id_periode' => $per,
				'nip'	=> $nip
			);
			$data['periode'] = $this->my_lib->get_data_row('master_periode',array('id_periode'=>$per));
			$data['checklist'] = $this->my_lib->get_data_row('data_checklist_laporan_bulanan',$param);
			$data['pegawai'] = $this->my_lib->get_data_row('data_pegawai',array('nip'=>$nip));
			$tabel = $this->load->view('kabag/cblb-tabel',$data,true);
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
