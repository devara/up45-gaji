<?php defined('BASEPATH') OR exit('');
/**
* 
*/
class Karyawan extends CI_Controller
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
		$data['datatables'] = 'yes';
		$data['nama'] = 
		$this->load->view('dashboard',$data);
	}
}