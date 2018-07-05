<?php defined('BASEPATH') OR exit('');
/**
* 
*/
class Ujian extends CI_Controller
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
		$data['javascript'] = $this->load->view('master/ujian-js',$data,true);
		$this->load->view('master/ujian',$data);
	}

	function tampil()
	{
		$this->form_validation->set_rules('per', 'Periode Kerja', 'required');
		$this->form_validation->set_rules('nip', 'Nama Pegawai', 'required');
		$this->form_validation->set_rules('elemen', 'Elemen Data', 'required');
		if ($this->form_validation->run() == TRUE) {
			$per = $this->input->post('per');
			$nip = $this->input->post('nip');
			$ele = $this->input->post('elemen');
			if ($ele == 'pengawas') {
				$param = array(
					'data_ujian.id_periode'=>$per,
					'data_ujian_pengawas.nip'=>$nip
				);
				$join1 = 'data_ujian.id_ujian = data_ujian_pengawas.id_ujian';
				$join2 = 'data_ujian.kode_matakuliah = master_matakuliah.kode_matakuliah';
				$data['periode'] = $this->my_lib->get_data('master_periode',array('id_periode'=>$per));
				$data['cekData'] = $this->my_lib->get_data_join_triple('data_ujian','data_ujian_pengawas','master_matakuliah',$join1,$join2,$param);
				$data['pegawai'] = $this->my_lib->get_data('data_pegawai',array('nip'=>$nip));
				$data['tipe'] = 'Pengawas Ujian';
				$tabel = $this->load->view('master/ujian-tabel',$data,true);
				$message[] = array('code'=>200,'message'=>'Data Tersedia.','tabel'=>$tabel);
			}
			elseif ($ele == 'korektor') {
				$param = array(
					'data_ujian.id_periode'=>$per,
					'data_ujian_korektor.nip'=>$nip
				);
				$join1 = 'data_ujian.id_ujian = data_ujian_korektor.id_ujian';
				$join2 = 'data_ujian.kode_matakuliah = master_matakuliah.kode_matakuliah';
				$data['periode'] = $this->my_lib->get_data('master_periode',array('id_periode'=>$per));
				$data['cekData'] = $this->my_lib->get_data_join_triple('data_ujian','data_ujian_korektor','master_matakuliah',$join1,$join2,$param);
				$data['pegawai'] = $this->my_lib->get_data('data_pegawai',array('nip'=>$nip));
				$data['tipe'] = 'Korektor Ujian';
				$tabel = $this->load->view('master/ujian-tabel',$data,true);
				$message[] = array('code'=>200,'message'=>'Data Tersedia.','tabel'=>$tabel);
			}
			else{
				$message[] = array('code'=>404,'message'=>'Elemen Data Dibutuhkan.');
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
