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
		$data['pegawai'] = $this->my_lib->get_data('data_pegawai');
		$data['datatables'] = 'yes';
		$data['javascript'] = $this->load->view('datakoreksi/koreksi-js',$data,true);
		$data['aktifTab'] = 'data';
		$this->load->view('datakoreksi/koreksi',$data);
	}

	function get_ujian($periode=FALSE)
	{
		$param = array(
			'id_periode' => $periode,
			'koreksi' => 'belum'
		);
		$join = 'data_ujian.kode_matakuliah = master_matakuliah.kode_matakuliah';
		$ujian = $this->my_lib->get_data_join('data_ujian','master_matakuliah',$param,$join);
		if ($ujian) {
			foreach ($ujian as $row) {
				$data[] = array(
					'code'	=> '200',
					'id_ujian' => $row->id_ujian,
					'nama_ujian' => $row->nama_matakuliah,
				);
			}
		}
		else{
			$data[] = array('code'=>'404','message'=>'Tidak ditemukan...');
		}
		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
	}

	function input_korektor()
	{
		$this->form_validation->set_rules('periode', 'Periode Kerja', 'required');
		$this->form_validation->set_rules('ujianlist', 'Nama Ujian', 'required');
		$this->form_validation->set_rules('peg_single', 'NIP Pegawai', 'required');
		if ($this->form_validation->run() == TRUE) {
			$periode = $this->input->post('periode');
			$idUjian = $this->input->post('ujianlist');
			$nip = $this->input->post('peg_single');
			$nominal = $this->my_lib->get_data_row('master_nominal',array('status'=>'aktif'));
			$jml_mhs = $this->my_lib->get_row('data_ujian',array('id_ujian'=>$idUjian),'jumlah_mahasiswa');
			$insentif = $jml_mhs*$nominal->row('koreksi');
			$param = array(
				'id_periode' => $periode,
				'nip' => $nip
			);
			$cek_data_insentif = $this->my_lib->cek('data_upah_korektor',$param);
			if ($cek_data_insentif == TRUE) {
				$data_insentif = $this->my_lib->get_data_row('data_upah_korektor',$param);
					$koreksi_old = $data_insentif->row('jml_koreksi');
					$insentif_old = $data_insentif->row('jml_upah');

					$koreksi_new = $koreksi_old + 1;
					$insentif_new = $insentif_old + $insentif;

					$new_value_insentif = array(
						'jml_koreksi' => $koreksi_new,
						'jml_upah' => $insentif_new
					);
					$this->my_lib->edit_row('data_upah_korektor',$new_value_insentif,$param);
			}
			else{
				$value_insentif = array(
						'id_periode' => $periode,
						'nip' => $nip,
						'jml_koreksi' => 1,
						'jml_upah' => $insentif
					);
					$this->my_lib->add_row('data_upah_korektor',$value_insentif);
			}
			
			$data = array(
				'id_ujian' => $idUjian,
				'nip' => $nip
			);
			$input_data_korektor = $this->my_lib->add_row('data_ujian_korektor',$data);
		  $update_status_ujian = $this->my_lib->edit_row('data_ujian',array('koreksi'=>'sudah'),array('id_ujian'=>$idUjian));
		  if ($input_data_korektor && $update_status_ujian) {
		  	$alert_type = "success";
	      $alert_title ="Berhasil input korektor Ujian";
				set_header_message($alert_type,'Input Korektor Ujian',$alert_title);
				redirect(akademik().'koreksi');
		  }
		}
		else{

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
