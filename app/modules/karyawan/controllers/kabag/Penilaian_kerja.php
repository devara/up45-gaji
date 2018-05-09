<?php defined('BASEPATH') OR exit('');
/**
* 
*/
class Penilaian_kerja extends CI_Controller
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
		$data['datatables'] = 'yes';
		$data['javascript'] = $this->load->view('kabag/penilaian-kerja-js',$data,true);
		$param = array(
			'under_of_jabatan'=> $this->session->userdata('jabatan')
		);
		$join = 'master_jabatan.kode_jabatan = data_pegawai.kode_jabatan';
		$data['pegawai'] = $this->my_lib->get_data_join('master_jabatan','data_pegawai',$param,$join);
		$this->load->view('kabag/penilaian-kerja',$data);
	}

	function input_penilaian()
	{
		$IDper = $this->input->post('idPer');
		$nip = $this->input->post('nip');
		$result = array();
		foreach ($nip as $key => $value) {
			$total = $_POST['jam'][$key] + $_POST['disiplin'][$key] + $_POST['loyalitas'][$key] + $_POST['pelayanan'][$key] + $_POST['propeka'][$key];
			if ($total >= 425) {
				$rangking = 1;
			}
			elseif ($total >= 350 && $total <= 424) {
				$rangking = 2;
			}
			elseif ($total >= 275 && $total <= 349) {
				$rangking = 3;
			}
			elseif ($total <= 274) {
				$rangking = 4;
			}
			$result[] = array(
				'id_periode' => $IDper,
	  	  'nip' 	=> $_POST['nip'][$key],
	  	  'jam' 	=> $_POST['jam'][$key],
	  	  'kedisiplinan' 	=> $_POST['disiplin'][$key],
	  	  'loyalitas' 	=> $_POST['loyalitas'][$key],
	  	  'pelayanan' 	=> $_POST['pelayanan'][$key],
	  	  'propeka' 	=> $_POST['propeka'][$key],
	      'total' => $total,
	      'ranking' => $rangking
	    );
		}
		$insert= $this->db->insert_batch('data_penilaian', $result);
	  if ($insert) {
	  	$alert_type = "success";
      $alert_title ="Berhasil input penilaian kerja pegawai";
			set_header_message($alert_type,'Input Penilaian Kerja',$alert_title);
			redirect(karyawan().'kabag/penilaian_kerja');
	  }
	}
}