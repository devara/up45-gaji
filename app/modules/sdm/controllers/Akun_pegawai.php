<?php defined('BASEPATH') OR exit('');
/**
* 
*/
class Akun_pegawai extends CI_Controller
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
		$this->load->view('pegawai/akun-pegawai',$data);
	}

	function single_generate()
	{
		$nip = $this->input->post('peg_tunggal');

		$nama = field_value('data_pegawai','nip',$nip,'nama');
		$nama_kcl = strtolower($nama);
		$nama_exp = explode(" ", $nama_kcl);
		$username = $nama_exp[0];
		$password = password_hash($username, PASSWORD_BCRYPT, ['cost' => 10]);

		$param = array(
			'nip' => $nip
		);
		$val = array(
			'username' => $username,
			'password' => $password
		);

		$update = $this->my_lib->edit_row('data_pegawai',$val,$param);
		if ($update) {
			$alert_type = "success";
      $alert_title ="Berhasil generate akun ".$nama;
			set_header_message($alert_type,'Generate Akun Pegawai',$alert_title);
			redirect(sdm().'akun_pegawai');
		}
	}

	function multi_generate()
	{
		$nm = $this->input->post('peg_ganda');
		$result = array();
	  foreach($nm AS $key => $val){
	  	$nama = field_value('data_pegawai','nip',$_POST['peg_ganda'][$key],'nama');
			$nama_kcl = strtolower($nama);
			$nama_exp = explode(" ", $nama_kcl);
			$username = $nama_exp[0];
			$password = password_hash($username, PASSWORD_BCRYPT, ['cost' => 10]);
	    $result[] = array(
	  	  'nip' 	=> $_POST['peg_ganda'][$key],
	      'username' => $username,
				'password' => $password
	    );
	  }
	  $update= $this->db->update_batch('data_pegawai', $result,'nip');
	  if ($update) {
	  	$alert_type = "success";
      $alert_title ="Berhasil generate akun pegawai";
			set_header_message($alert_type,'Generate Akun Pegawai',$alert_title);
			redirect(sdm().'akun_pegawai');
	  }
	}
}
