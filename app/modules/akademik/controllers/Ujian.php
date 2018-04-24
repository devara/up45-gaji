<?php defined('BASEPATH') OR exit('');
/**
* 
*/
class Ujian extends CI_Controller
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
		$data['datatables'] = 'yes';
		$data['javascript'] = $this->load->view('dataujian/ujian-js',$data,true);
		$this->load->view('dataujian/ujian',$data);
	}

	function getUjian()
	{
		$data['ujian'] = $this->my_lib->get_data('data_ujian');
		$tabel = $this->load->view('dataujian/ujian-tabel',$data,true);
		$message[] = array('code'=>200,'message'=>'Data Tersedia.','tabel'=>$tabel);
		$this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($message));

	}

	function tambah()
	{
		$this->form_validation->set_rules('idper', 'Periode', 'required');
		$this->form_validation->set_rules('tgl', 'Tanggal Ujian', 'required');
		$this->form_validation->set_rules('tipe', 'Tipe Ujian', 'required');
		$this->form_validation->set_rules('makul', 'Mata Kuliah', 'required');
		$this->form_validation->set_rules('ket', 'Keterangan Ujian', 'required');
		if ($this->form_validation->run() == TRUE) {
			$per = $this->input->post('idper');
			$tgl = $this->input->post('tgl');
			$tipe = $this->input->post('tipe');
			$makul = $this->input->post('makul');
			$ket = $this->input->post('ket');

			$val = array(
				'id_periode' => $per,
				'tanggal' => $tgl,
				'tipe'	=> $tipe,
				'kode_matakuliah' => $makul,
				'keterangan' => $ket
			);
			$insert = $this->my_lib->add_row('data_ujian',$val);
			if ($insert) {
				$message[] = array('code'=>200,'message' => 'Data ujian berhasil disimpan ke database');
			}
			else{
				$message[] = array('code'=>404,'message' => 'Gagal menyimpan data ujian');
			}
		}
		else{
			$message[] = array('code'=>500,'message' => validation_errors('<div class="error">', '</div>'));
		}
		$this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($message));
	}

	function getmakul($prodi=FALSE)
	{
		$makul = $this->my_lib->get_data('master_matakuliah',array('kode_program_studi'=>$prodi));
		if ($makul) {
			foreach ($makul as $row) {
				$data[] = array(
					'code'	=> '200',
					'kd_makul' => $row->kode_matakuliah,
					'nm_makul' => $row->nama_matakuliah,
					'sks_makul' => $row->sks_matakuliah
				);
			}
		}
		else{
			$data = array('code'=>'404','message'=>'Tidak ditemukan...');
		}
		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
	}
}