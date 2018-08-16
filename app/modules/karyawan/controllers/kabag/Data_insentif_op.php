<?php defined('BASEPATH') OR exit('');
/**
 * 
 */
class Data_insentif_op extends CI_Controller
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
		$data['javascript'] = $this->load->view('kabag/insentif-op-js',$data,true);
		$this->load->view('kabag/data-insentif-op',$data);
	}

	function lihat_insentif()
	{
		$this->form_validation->set_rules('per', 'Periode Kerja', 'required');
		$this->form_validation->set_rules('jab', 'Kode Jabatan', 'required');
		if ($this->form_validation->run() == TRUE) {
			$per = $this->input->post('per');
			$jab = $this->input->post('jab');
			$param = array(
				'id_periode' => $per,
				'pemberi_insentif'	=> $jab
			);
			$join = 'data_pegawai.nip = data_insentif_op.nip';
			$data['periode'] = $this->my_lib->get_data_row('master_periode',array('id_periode'=>$per));
			$data['insentif'] = $this->my_lib->get_data_join('data_pegawai','data_insentif_op',$param,$join);
			$tabel = $this->load->view('kabag/data-insentif-op-tabel',$data,true);
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
