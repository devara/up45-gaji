<?php defined('BASEPATH') OR exit('');
/**
* 
*/
class Rapat extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model("upload_absensi");
    if ($this->lib_login->is_sdm()==FALSE) {
    	redirect(base_url());
    }
	}

	function index()
	{
		$data['rapat'] = $this->my_lib->get_data('data_rapat');
		$data['periode'] = $this->my_lib->get_data('master_periode');
		$data['pegawai'] = $this->my_lib->get_data('data_pegawai','','nama ASC');
		$data['datatables'] = 'yes';
		$data['javascript'] = $this->load->view('tunj_bonus/rapat-js',$data,true);
		$this->load->view('tunj_bonus/rapat',$data);
	}

	function tambah()
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
		$alert_type = "success";
    $alert_title = "Berhasil disimpan";
		set_header_message($alert_type,'Input Data Rapat',$alert_title);
		redirect(sdm().'tunjangan_bonus/rapat');
	}

	function cek()
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
			$join = 'data_rapat_peserta.id_rapat = data_rapat.id_rapat';
			$data['cekRapat'] = $this->my_lib->get_data_join('data_rapat_peserta','data_rapat',$param,$join);
			$data['cekPegawai'] = $this->my_lib->get_data('data_pegawai',array('nip'=>$nip));
			$tabel = $this->load->view('tunj_bonus/rapat-tabel',$data,true);
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