<?php defined('BASEPATH') OR exit('');
/**
* 
*/
class Rapat extends CI_Controller
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
		$data['datatables'] = 'yes';
		$data['javascript'] = $this->load->view('master/rapat-js',$data,true);
		$this->load->view('master/rapat',$data);
	}

	function tampil()
	{
		$this->form_validation->set_rules('per', 'Periode Kerja', 'required');
		$this->form_validation->set_rules('nip', 'Nama Pegawai', 'required');
		if ($this->form_validation->run() == TRUE) {
			$per = $this->input->post('per');
			$nip = $this->input->post('nip');
			$param = array(
				'id_periode'=>$per,
				'nip'=>$nip
			);
			$join = 'data_rapat_peserta.id_rapat = data_rapat.id_rapat';
			$data['periode'] = $this->my_lib->get_data_row('master_periode',array('id_periode'=>$per));
			$data['cekRapat'] = $this->my_lib->get_data_join('data_rapat_peserta','data_rapat',$param,$join);
			$data['nominal'] = $this->my_lib->get_data_row('master_nominal',array('status'=>'aktif'));
			$data['pegawai'] = $this->my_lib->get_data_row('data_pegawai',array('nip'=>$nip));
			$tabel = $this->load->view('master/rapat-tabel',$data,true);
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
