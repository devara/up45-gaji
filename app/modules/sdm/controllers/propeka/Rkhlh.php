<?php defined('BASEPATH') OR exit('');
/**
 * 
 */
class Rkhlh extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
    if ($this->lib_login->is_sdm()==FALSE) {
    	redirect(base_url());
    }
	}

	function index()
	{
		$data['periode'] = $this->my_lib->get_data('master_periode','','mulai ASC');
		$data['unit'] = $this->my_lib->get_data('master_unit_kerja');
		$data['javascript'] = $this->load->view('propeka/rkhlh-js',$data,true);
		$this->load->view('propeka/rkhlh',$data);
	}

	function tampil()
	{
		$this->form_validation->set_rules('per', 'Periode Kerja', 'required');
		$this->form_validation->set_rules('unit', 'Unit Kerja', 'required');
		$this->form_validation->set_rules('nip', 'Nama Pegawai', 'required');
		if ($this->form_validation->run() == TRUE) {
			$per = $this->input->post('per');
			$unit = $this->input->post('unit');
			$nip = $this->input->post('nip');
			$param = array(
				'id_periode' => $per,
				'nip' => $nip
			);
			$data['periode'] = $this->my_lib->get_data_row('master_periode',array('id_periode'=>$per));
			$data['pegawai'] = $this->my_lib->get_data_row('data_pegawai',array('nip'=>$nip));
			$data['rkhlh'] = $this->my_lib->get_data('data_rkhlh',$param);
			$tabel = $this->load->view('propeka/rkhlh-tabel',$data,true);
			$message[] = array('code'=>200,'message'=>'Data Tersedia.','tabel'=>$tabel);
		}
		else{
			$message[] = array('code'=>404,'message' => validation_errors('<div class="error">', '</div>'));
		}
		$this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($message));
	}

	function lihat_rkh($id)
	{
		$data['detail'] = $this->my_lib->get_data('data_rkhlh_detail',array('id_rkhlh'=>$id));
		$detailRKH = $this->load->view('propeka/rkh-detail',$data,true);
		$message[] = array('code'=>200,'message'=>'Data Tersedia.','detail'=>$detailRKH);

		$this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($message));
	}

	function lihat_detail($id)
	{
		$data['detail'] = $this->my_lib->get_data('data_rkhlh_detail',array('id_rkhlh'=>$id));
		$detailRKH = $this->load->view('propeka/rkhlh-detail',$data,true);
		$message[] = array('code'=>200,'message'=>'Data Tersedia.','detail'=>$detailRKH);

		$this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($message));
	}
}
