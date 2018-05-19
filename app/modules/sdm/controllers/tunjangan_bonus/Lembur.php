<?php defined('BASEPATH') OR exit('');
/**
* 
*/
class Lembur extends CI_Controller
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
		$data['periode'] = $this->my_lib->get_data('master_periode');
		$data['unit'] = $this->my_lib->get_data('master_unit_kerja','','nama_unit ASC');
		$data['pegawai'] = $this->my_lib->get_data('data_pegawai','','nama ASC');
		$data['datatables'] = 'yes';
		$data['javascript'] = $this->load->view('tunj_bonus/lembur-js',$data,true);
		$this->load->view('tunj_bonus/lembur',$data);
	}

	function tampil()
	{
		$this->form_validation->set_rules('per', 'Periode Kerja', 'required');
		$this->form_validation->set_rules('unit', 'Unit Kerja', 'required');
		if ($this->form_validation->run() == TRUE) {
			$per = $this->input->post('per');
			$unit = $this->input->post('unit');
			if ($unit=='all') {
				$param = array(
					'id_periode'=>$per,
					'acc'=>'ya'				
				);
				$join = 'data_pegawai.nip = data_lembur.nip';
				$data['cekLembur'] = $this->my_lib->get_data_join('data_pegawai','data_lembur',$param,$join);
			}
			else{
				$param = array(
					'kode_unit'=>$unit,
					'id_periode'=>$per,
					'acc'=>'ya'
				);
				$join = 'data_pegawai.nip = data_lembur.nip';
				$data['cekLembur'] = $this->my_lib->get_data_join('data_pegawai','data_lembur',$param,$join);
			}
			$tabel = $this->load->view('tunj_bonus/lembur-tabel',$data,true);
			$message[] = array('code'=>200,'message'=>'Data Tersedia.','tabel'=>$tabel);
		}
		else{
			$message[] = array('code'=>404,'message' => validation_errors('<div class="error">', '</div>'));
		}
		$this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($message));
	}

	function input()
	{
		$this->form_validation->set_rules('idPeriode', 'Periode Kerja', 'required');
		$this->form_validation->set_rules('tanggal', 'Tanggal Lembur', 'required');
		$this->form_validation->set_rules('idPegawai', 'Nama Pegawai', 'required');
		$this->form_validation->set_rules('addmulai', 'Jam Mulai', 'required');
		$this->form_validation->set_rules('addsampai', 'Jam Selesai', 'required');
		$this->form_validation->set_rules('addket', 'Keterangan Lembur', 'required');
		if ($this->form_validation->run() == TRUE) {
			$per = $this->input->post('idPeriode');
			$tgl = $this->input->post('tanggal');
			$nip = $this->input->post('idPegawai');
			$mulai = $this->input->post('addmulai');
			$sampai = $this->input->post('addsampai');
			$ket = $this->input->post('addket');

			$time_mulai = explode_time($this->input->post('addmulai'));
			$time_sampai = explode_time($this->input->post('addsampai'));
			$time_durasi = $time_sampai - $time_mulai;
			$durasi = convert_second($time_durasi);
			
			$value = array(
				'id_periode' => $per,
				'nip'	=> $nip,
				'tgl_lembur' => $tgl,
				'jam_mulai' => $mulai,
				'jam_selesai' => $sampai,
				'durasi' => $durasi,
				'keterangan' => $ket,
				'acc' => 'ya'
			);
			$insert = $this->my_lib->add_row('data_lembur',$value);
			if ($insert) {
				$message[] = array('code'=>200,'message'=>'Data Lembur Berhasil Disimpan.');
			}
			else{
				$message[] = array('code'=>500,'message'=>'Data Lembur Gagal disimpan.');
			}
		}
		else{
			$message[] = array('code'=>404,'message' => validation_errors('<div class="error">', '</div>'));
		}
		$this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($message));
	}
}
