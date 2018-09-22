<?php defined('BASEPATH') OR exit('');
/**
* 
*/
class Laporan_penggajian extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
    if ($this->lib_login->is_pimpinan()==FALSE) {
    	redirect(base_url());
    }
	}
	
	function index()
	{
		$data['periode'] = $this->my_lib->get_data('master_periode');
		$data['pegawai'] = $this->my_lib->get_data('data_pegawai');
		$data['javascript'] = $this->load->view('laporan/laporan-js',$data,true);
		$this->load->view('laporan/laporan-view',$data);		
	}
	
}
