<?php defined('BASEPATH') OR exit('');
/**
 * 
 */
class Req_lmebur extends CI_Contoller
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
		$data['javascript'] = $this->load->view('form/req-lembur-js',$data,true);
		$this->load->view('form/req-lembur',$data);
	}
}
