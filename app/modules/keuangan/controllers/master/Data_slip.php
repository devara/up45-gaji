<?php defined('BASEPATH') OR exit('');
/**
 * 
 */
class Data_slip extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model("m_slip");
    if ($this->lib_login->is_keuangan()==FALSE) {
    	redirect(base_url());
    }
	}
	
	function index()
	{
		$data['periode'] = $this->my_lib->get_data('master_periode','','mulai ASC');
		$data['unit'] = $this->my_lib->get_data('master_unit_kerja');
		$data['javascript'] = $this->load->view('master/data-slip-js',$data,true);
		$this->load->view('master/data-slip',$data);		
	}

	function tampil_data()
	{
		$this->form_validation->set_rules('per', 'Periode Kerja', 'required');
		$this->form_validation->set_rules('unit', 'Unit Kerja', 'required');
		if ($this->form_validation->run() == TRUE) {
			$per = $this->input->post('per');
			$unit = $this->input->post('unit');
			
			$data['nominal'] = $this->my_lib->get_data_row('master_nominal',array('status'=>'aktif'));
			$data['periode'] = $this->my_lib->get_data_row('master_periode',array('id_periode'=>$per));
			$data['unit'] = $this->my_lib->get_data_row('master_unit_kerja',array('kode_unit'=>$unit));
			$data['pegawai'] = $this->my_lib->get_data('data_pegawai',array('kode_unit'=>$unit));
			$tabel = $this->load->view('master/data-slip-tabel',$data,true);
			$message[] = array('code'=>200,'message'=>'Data Tersedia.','tabel'=>$tabel);
		}
		else{
			$message[] = array('code'=>404,'message' => validation_errors('<div class="error">', '</div>'));
		}
		$this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($message));
	}

	function tampil_detail()
	{
		$this->form_validation->set_rules('id_slip', 'ID Slip Gaji', 'required');
		if ($this->form_validation->run() == TRUE) {
			$IDslip = $this->input->post('id_slip');
			
			$data['slipgaji'] = $this->m_slip->detail_slip($IDslip);
			$detail = $this->load->view('master/data-slip-detail',$data,true);
			$message[] = array('code'=>200,'message'=>'Data Tersedia.','detail'=>$detail);
		}
		else{
			$message[] = array('code'=>404,'message' => validation_errors('<div class="error">', '</div>'));
		}
		$this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($message));
	}
}
