<?php defined('BASEPATH') OR exit('');
/**
* 
*/
class Akademik extends CI_Controller
{
	
	function index()
	{
		if ($this->lib_login->is_akademik()==TRUE) {
			$this->load->view('dashboard');
		}
		else{
			redirect(base_url());
		}
	}
}