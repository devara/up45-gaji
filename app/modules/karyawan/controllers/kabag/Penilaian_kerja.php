<?php defined('BASEPATH') OR exit('');
/**
* 
*/
class Penilaian_kerja extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
    if ($this->lib_login->is_kabag()==FALSE) {
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

	function cek()
	{
		$this->form_validation->set_rules('per', 'Periode Kerja', 'required');
		$this->form_validation->set_rules('jab', 'Jabatan', 'required');
		if ($this->form_validation->run() == TRUE) {
			$per = $this->input->post('per');
			$jab = $this->input->post('jab');
			$param = array(
				'id_periode' => $per,
				'pemberi_nilai'	=> $jab
			);
			$cekData = $this->my_lib->cek('data_penilaian',$param);
			if ($cekData == FALSE) {
				$message[] = array('code'=>200,'message'=>'Available.','status'=>'Anda dapat mengisi penilaian');
			}
			else {
				$message[] = array('code'=>500,'message'=>'Not available.','status'=>'Anda sudah memberikan penilaian untuk periode ini');
			}
			
		}
		else{
			$message[] = array('code'=>404,'message' => validation_errors('<div class="error">', '</div>'));
		}
		$this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($message));
	}

	function input_penilaian()
	{
		$IDper = $this->input->post('idPer');
		$nip = $this->input->post('nip');
		$jab = $this->input->post('kd_jabatan');
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
	  	  'kode_unit' => $_POST['kd_unit'][$key],
	  	  'jam' 	=> $_POST['jam'][$key],
	  	  'kedisiplinan' 	=> $_POST['disiplin'][$key],
	  	  'loyalitas' 	=> $_POST['loyalitas'][$key],
	  	  'pelayanan' 	=> $_POST['pelayanan'][$key],
	  	  'propeka' 	=> $_POST['propeka'][$key],
	      'total' => $total,
	      'ranking' => $rangking,
	      'pemberi_nilai' => $jab
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
