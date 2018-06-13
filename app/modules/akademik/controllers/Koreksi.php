<?php defined('BASEPATH') OR exit('');
/**
* 
*/
class Koreksi extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
    if ($this->lib_login->is_akademik()==FALSE) {
    	redirect(base_url());
    }
	}

	function index()
	{
		$data['ujian'] = $this->my_lib->get_data('data_ujian');
		$data['periode'] = $this->my_lib->get_data('master_periode');
		$data['pegawai'] = $this->my_lib->get_data('data_pegawai',array('kode_status_pegawai'=>'MUL'));
		$data['datatables'] = 'yes';
		$data['javascript'] = $this->load->view('datakoreksi/koreksi-js',$data,true);
		$data['aktifTab'] = 'data';
		$this->load->view('datakoreksi/koreksi',$data);
	}

	function input_korektor()
	{
		$idUjian = $this->input->post('ujianlist');
		$nm = $this->input->post('peg_ganda');
		$result = array();
	  foreach($nm AS $key => $val){
	    $result[] = array(
	    	'id_ujian' => $idUjian,
	  	  'nip' 	=> $_POST['peg_ganda'][$key]
	    );
	  }
	  $update = $this->my_lib->edit_row('data_ujian',array('koreksi'=>'sudah'),array('id_ujian'=>$idUjian));
	  $insert= $this->db->insert_batch('data_ujian_korektor',$result);
	  if ($insert) {
	  	$alert_type = "success";
      $alert_title ="Berhasil input korektor Ujian";
			set_header_message($alert_type,'Input Korektor Ujian',$alert_title);
			redirect(akademik().'koreksi');
	  }
	}

	function cek_data_korektor()
	{
		$this->form_validation->set_rules('per', 'Periode Kerja', 'required');
		$this->form_validation->set_rules('nip', 'Nama Pegawai', 'required');
		if ($this->form_validation->run() == TRUE) {
			$per = $this->input->post('per');
			$nip = $this->input->post('nip');
			$param = array(
				'id_periode'=>$per,
				'nip'=>$nip
			);
			$join = 'data_ujian_korektor.id_ujian = data_ujian.id_ujian';
			$data['cekKorektor'] = $this->my_lib->get_data_join('data_ujian_korektor','data_ujian',$param,$join);
			$data['cekPegawai'] = $this->my_lib->get_data('data_pegawai',array('nip'=>$nip));
			$tabel = $this->load->view('datakoreksi/korektor-tabel',$data,true);
			$message[] = array('code'=>200,'message'=>'Data Tersedia.','tabel'=>$tabel);
		}
		else{
			$message[] = array('code'=>404,'message' => validation_errors('<div class="error">', '</div>'));
		}
		$this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($message));
	}
}
