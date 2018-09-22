<?php defined('BASEPATH') OR exit('');
/**
* 
*/
class Laporan_penggajian extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
    if ($this->lib_login->is_keuangan()==FALSE) {
    	redirect(base_url());
    }
	}
	
	function index()
	{
		$data['periode'] = $this->my_lib->get_data('master_periode','','mulai ASC');
		$data['unit'] = $this->my_lib->get_data('master_unit_kerja');
		$data['javascript'] = $this->load->view('laporan/laporan-js',$data,true);
		$this->load->view('laporan/laporan-view',$data);		
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
			$tabel = $this->load->view('laporan/laporan-table',$data,true);
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
