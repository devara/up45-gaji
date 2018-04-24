<?php defined('BASEPATH') OR exit('');
/**
* 
*/
class Keuangan extends CI_Controller
{
	
	function index()
	{
		if ($this->lib_login->is_keuangan()==TRUE) {
			$this->load->view('tes');
		}
		else{
			redirect(base_url());
		}
	}
}