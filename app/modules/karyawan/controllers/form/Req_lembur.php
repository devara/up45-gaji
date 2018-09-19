<?php defined('BASEPATH') OR exit('');
/**
 * 
 */
class Req_lembur extends CI_Controller
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
		$data['javascript'] = $this->load->view('form/req-lembur-js',$data,true);
		$this->load->view('form/req-lembur',$data);
	}

	function pengajuan()
	{
		$this->form_validation->set_rules('nip', 'NIP Pegawai', 'required');
		$this->form_validation->set_rules('idPeriode', 'Periode Kerja', 'required');
		$this->form_validation->set_rules('tanggal', 'Tanggal Lembur', 'required');
		$this->form_validation->set_rules('addmulai', 'Jam Mulai', 'required');
		$this->form_validation->set_rules('addsampai', 'Jam Selesai', 'required');
		$this->form_validation->set_rules('addket', 'Keterangan Lembur', 'required');
		if ($this->form_validation->run() == TRUE) {
			$nip = $this->input->post('nip');
			$per = $this->input->post('idPeriode');
			$tgl = $this->input->post('tanggal');
			$mulai = $this->input->post('addmulai');
			$sampai = $this->input->post('addsampai');
			$ket = $this->input->post('addket');
			$nominal = $this->my_lib->get_data_row('master_nominal',array('status'=>'aktif'));
			$time_mulai = explode_time($this->input->post('addmulai'));
			$time_sampai = explode_time($this->input->post('addsampai'));
			$time_durasi = $time_sampai - $time_mulai;
			$satu_jam = convert_time('01:00');
			$dua_jam = convert_time('02:00');
			$durasi = convert_second($time_durasi);
			if ($time_durasi > $dua_jam) {
				$insentif = (($time_durasi/$satu_jam)*$nominal->row('lembur'))+$nominal->row('uang_makan');
			}
			else{
				$insentif = ($time_durasi/$satu_jam)*$nominal->row('lembur');
			}
			$value = array(
				'id_periode' => $per,
				'nip' => $nip,
				'tgl_lembur' => $tgl,
				'jam_mulai' => $mulai,
				'jam_selesai' => $sampai,
				'durasi' => $durasi,
				'total' => $insentif,
				'keterangan' => $ket,
				'input_tipe' => 'karyawan',
				'acc_kabag'=>'belum',
				'acc' => 'belum'
			);

			$insert_lembur = $this->my_lib->add_row('data_lembur',$value);
			if ($insert_lembur) {
				$alert_type = "success";
	      $alert_message ="Berhasil input pengajuan lembur";
				set_header_message($alert_type,'Pengajuan Lembur',$alert_message);
				redirect(karyawan().'form/req_lembur');
			}
			else{
				$alert_type = "danger";
	      $alert_message ="Gagal input pengajuan lembur";
				set_header_message($alert_type,'Pengajuan Lembur',$alert_message);
				redirect(karyawan().'form/req_lembur');
			}
		}
		else{
			$alert_type = "danger";
	    $alert_message = validation_errors();
			set_header_message($alert_type,'Pengajuan Lembur',$alert_message);
			redirect(karyawan().'form/req_lembur');
			
		}
	}

	function status()
	{
		$this->form_validation->set_rules('per', 'Periode Kerja', 'required');
		$this->form_validation->set_rules('nip', 'NIP Pegawai', 'required');
		if ($this->form_validation->run() == TRUE) {
			$periode = $this->input->post('per');
			$nip = $this->input->post('nip');

			$param = array(
				'id_periode'=>$periode,
				'data_lembur.nip' => $nip,
				'input_tipe' => 'karyawan'
			);
					
			$join = 'data_pegawai.nip = data_lembur.nip';
			$data['periode'] = $this->my_lib->get_data('master_periode',array('id_periode'=>$periode));
			$data['pegawai'] = $this->my_lib->get_data('data_pegawai',array('nip'=>$nip));
			$data['cekLembur'] = $this->my_lib->get_data_join('data_pegawai','data_lembur',$param,$join);

			$tabel = $this->load->view('form/req-lembur-tabel',$data,true);
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
