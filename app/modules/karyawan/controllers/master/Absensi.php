<?php defined('BASEPATH') OR exit('');
/**
* 
*/
class Absensi extends CI_Controller
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
		$data['periode'] = $this->my_lib->get_data('master_periode','','mulai ASC');
		$data['javascript'] = $this->load->view('master/absensi-js',$data,true);
		$this->load->view('master/absensi',$data);
	}

	function tampil()
	{
		$this->form_validation->set_rules('per', 'Periode Kerja', 'required');
		$this->form_validation->set_rules('nip', 'NIP', 'required');
		if ($this->form_validation->run() == TRUE) {
			$nip = $this->input->post('nip');
			$per = $this->input->post('per');
			$param = array(
				'id_periode' => $per,
				'nip'	=> $nip
			);
			$data['periode'] = $this->my_lib->get_data('master_periode',array('id_periode'=>$per));
			$data['absensi'] = $this->my_lib->get_data('absensi_data',$param);
			$data['rekap'] = $this->my_lib->get_data('absensi_rekap',$param);
			$data['pegawai'] = $this->my_lib->get_data('data_pegawai',array('nip'=>$nip));
			$tabel = $this->load->view('master/absensi-tabel',$data,true);
			$message[] = array('code'=>200,'message'=>'Data Tersedia.','tabel'=>$tabel);
		}
		else{
			$message[] = array('code'=>404,'message' => validation_errors('<div class="error">', '</div>'));
		}
		$this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($message));
	}

	function pengajuan($id=FALSE)
	{
		$join = 'absensi_data.nip = data_pegawai.nip';
		$absensi = $this->my_lib->get_data_row_join('absensi_data','data_pegawai',$join,array('id_absensi'=>$id));
		if ($absensi) {
			$data[] = array(
				'code' => 200,
				'id' => $absensi->row('id_absensi'),
				'periode' => $absensi->row('id_periode'),
				'tanggal' => $absensi->row('tanggal'),
				'hari' => $absensi->row('hari'),
				'nip' => $absensi->row('nip'),
				'nama' => $absensi->row('nama'),
				'datang' => $absensi->row('datang'),
				'pulang' => $absensi->row('pulang'),
				'keterangan' => $absensi->row('keterangan')
      );
		}
		else{
			$data[] = array('code'=>500,'message'=>'Data Tidak Valid.');
		}
		$this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($data));
	}
}
