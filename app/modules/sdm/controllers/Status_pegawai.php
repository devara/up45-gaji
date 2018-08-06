<?php defined('BASEPATH') OR exit('');
/**
* 
*/
class Status_pegawai extends CI_Controller
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
		$data['pegawai'] = $this->my_lib->get_data('data_pegawai','','nama ASC');
		$this->load->view('pegawai/status-pegawai',$data);
	}

	function tunggal()
	{
		$nip = $this->input->post('peg_tunggal');
		$stat = $this->input->post('stat_tunggal');

		$param = array(
			'nip' => $nip
		);
		$val = array(
			'kode_status_pegawai' => $stat
		);

		$update = $this->my_lib->edit_row('data_pegawai',$val,$param);
		if ($update) {
			$alert_type = "success";
      $alert_title ="Berhasil update status pegawai";
			set_header_message($alert_type,'Update Status Pegawai',$alert_title);
			redirect(sdm().'status_pegawai');
		}
	}

	function ganda()
	{
		$stat = $this->input->post('stat_ganda');

		$nm = $this->input->post('peg_ganda');
		$result = array();
	  foreach($nm AS $key => $val){
	    $result[] = array(
	  	  'nip' 	=> $_POST['peg_ganda'][$key],
	      'kode_status_pegawai' => $stat
	    );
	  }
	  $update= $this->db->update_batch('data_pegawai', $result,'nip');
	  if ($update) {
	  	$alert_type = "success";
      $alert_title ="Berhasil update status pegawai";
			set_header_message($alert_type,'Update Status Pegawai',$alert_title);
			redirect(sdm().'status_pegawai');
	  }
	}
}
