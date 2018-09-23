<?php defined('BASEPATH') OR exit('');
/**
 * 
 */
class Jam_kerja extends CI_Controller
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
		$data['jamkerja'] = $this->my_lib->get_data('master_jam_kerja');
		$data['datatables'] = 'yes';
		$data['javascript'] = $this->load->view('jamkerja/jamkerja-js',$data,true);
		$this->load->view('jamkerja/jamkerja',$data);
	}
}