<?php defined('BASEPATH') OR exit('');
/**
 * 
 */
class Pengajuan_lembur extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model("upload_absensi");
    if ($this->lib_login->is_kabag()==FALSE) {
    	redirect(base_url());
    }
	}

	function index()
	{
		$data['periode'] = $this->my_lib->get_data('master_periode','','mulai ASC');
		$data['pegawai'] = $this->my_lib->get_data('data_pegawai','','nama ASC');
		$data['javascript'] = $this->load->view('kabag/pengajuan-lembur-js',$data,true);
		$this->load->view('kabag/pengajuan-lembur',$data);
	}

	public function cek_pengajuan()
	{
		$this->form_validation->set_rules('per', 'Periode Kerja', 'required');
		if ($this->form_validation->run() == TRUE) {
			$per = $this->input->post('per');
			$param = array(
				'id_periode'=>$per,
				'input_tipe'=>'karyawan',
				'under_of_jabatan'=> $this->session->userdata('jabatan')
			);
			$join1 = 'data_pegawai.kode_jabatan = master_jabatan.kode_jabatan';
			$join2 = 'data_pegawai.nip = data_lembur.nip';
			$data['cekLembur'] = $this->my_lib->get_data_join_triple('data_pegawai','master_jabatan','data_lembur',$join1,$join2,$param,'tgl_lembur ASC');
			$data['periode'] = $this->my_lib->get_data_row('master_periode',array('id_periode'=>$per));
			
			$tabel = $this->load->view('kabag/pengajuan-lembur-tabel',$data,true);
			$message[] = array('code'=>200,'message'=>'Data Tersedia.','tabel'=>$tabel);
		}
		else{
			$message[] = array('code'=>404,'message' => validation_errors('<div class="error">', '</div>'));
		}
		$this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($message));
	}

	public function eksekusi_pengajuan_lembur()
	{
		$this->form_validation->set_rules('lembur_id', 'ID Lembur', 'required');
		$this->form_validation->set_rules('tindakan', 'Tindakan Pengajuan', 'required');
		if ($this->form_validation->run() == TRUE) {
			$idlembur = $this->input->post('lembur_id');
			$tindakan = $this->input->post('tindakan');
			$update_data_lembur = $this->my_lib->edit_row('data_lembur',array('acc_kabag'=>$tindakan),array('id_lembur'=>$idlembur));
			if ($update_data_lembur) {
				$message[] = array('code'=>200,'message'=>'Eksekusi pengajuan lembur karyawan berhasil.');
			}
			else{
				$message[] = array('code'=>404,'message'=>'Eksekusi pengajuan lembur karyawan gagal.');
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
