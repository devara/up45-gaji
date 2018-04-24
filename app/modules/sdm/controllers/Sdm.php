<?php defined('BASEPATH') OR exit('');
/**
* 
*/
class Sdm extends CI_Controller
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
		$data['datatables'] = 'yes';
		$data['javascript'] = $this->load->view('dashboard-js',$data,true);
		$data['periode'] = $this->my_lib->get_data('master_periode');
		$data['pegawai'] = $this->my_lib->get_data('data_pegawai');
		$this->load->view('dashboard',$data);		
	}

	function insert_rapat()
	{
		$rapat = $this->input->post('nama_rapat');
		$periode = $this->input->post('periode');
		$tgl = $this->input->post('tanggal');
		$ket = $this->input->post('keterangan');
		
		$data = array(
			'id_periode'	=> $periode,
			'tanggal_rapat' => $tgl,
			'nama_rapat'	=> $rapat,
			'keterangan'	=> $ket
		);
		$add_rapat = $this->db->insert('data_rapat',$data);
		if ($add_rapat) {
			$rapatID = $this->my_lib->last_insert_id();
			$nm = $this->input->post('peserta');
			$result = array();
	    foreach($nm AS $key => $val){
	     $result[] = array(
	      'id_rapat'		=> $rapatID,
	      'nip' 	=> $_POST['peserta'][$key]
	     );
	    }
	    $test= $this->db->insert_batch('data_rapat_peserta', $result);
		}
    
		redirect(base_url().'sdm');
	}
}