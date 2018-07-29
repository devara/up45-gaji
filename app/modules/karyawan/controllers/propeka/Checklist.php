<?php defined('BASEPATH') OR exit('');
/**
 * 
 */
class Checklist extends CI_Controller
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
		$data['javascript'] = $this->load->view('propeka/propeka-cb-js',$data,true);
		$this->load->view('propeka/propeka-cb',$data);
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
			$cek_id_data = $this->my_lib->get_row('data_checklist_laporan_bulanan',$param,'id_cb_lb');
			$data['tgl_buat'] = tanggal_indo($this->my_lib->get_row('data_checklist_laporan_bulanan',$param,'tgl_buat_checklist'));
			$data['periode'] = $this->my_lib->get_data('master_periode',array('id_periode'=>$per));
			$data['checklist'] = $this->my_lib->get_data('data_checklist_laporan_bulanan_detail',array('id_cb_lb'=>$cek_id_data));
			$data['pegawai'] = $this->my_lib->get_data('data_pegawai',array('nip'=>$nip));
			$tabel = $this->load->view('propeka/propeka-cb-tabel',$data,true);
			$message[] = array('code'=>200,'message'=>'Data Tersedia.','tabel'=>$tabel);
		}
		else{
			$message[] = array('code'=>404,'message' => validation_errors('<div class="error">', '</div>'));
		}
		$this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($message));
	}

	function cek()
	{
		$this->form_validation->set_rules('per', 'Periode Kerja', 'required');
		$this->form_validation->set_rules('nip', 'NIP', 'required');
		if ($this->form_validation->run() == TRUE) {
			$per = $this->input->post('per');
			$nip = $this->input->post('nip');
			$min = $this->my_lib->get_row('master_periode',array('id_periode'=>$per),'mulai');
			$max = $this->my_lib->get_row('master_periode',array('id_periode'=>$per),'akhir');
			$min_text = tanggal_indo($min);
			$max_text = tanggal_indo($max);
			$param = array(
				'id_periode' => $per,
				'nip'	=> $nip
			);
			$cekData = $this->my_lib->get_data('data_checklist_laporan_bulanan',$param);
			if ($cekData) {
				$message[] = array('code'=>200,'message'=>'Data Tersedia.','status'=>'Anda sudah membuat Checklist untuk periode ini');
			}
			else {
				$data['minimal'] = $min;
				$data['maksimal'] = $max;
				$formCB = $this->load->view('propeka/propeka-cb-form',$data,true);
				$message[] = array(
					'code'=>500,
					'min'=>$min,
					'max'=>$max,
					'min_text'=>$min_text,
					'max_text'=>$max_text,
					'form'=>$formCB,
					'message'=>'Data Belum Tersedia.',
					'status'=>'tidak');
			}
			
		}
		else{
			$message[] = array('code'=>404,'message' => validation_errors('<div class="error">', '</div>'));
		}
		$this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($message));
	}

	function tambah()
	{
		$periode = $this->input->post('periode');
		$nip = $this->input->post('pegawai');
		$data = array(
			'id_periode'	=> $periode,
			'nip'	=> $nip,
			'tgl_buat_checklist' => date('Y-m-d H:i:s')
		);
		$add_checklist = $this->db->insert('data_checklist_laporan_bulanan',$data);
		if ($add_checklist) {
			$cbID = $this->my_lib->last_insert_id();
			$keg = $this->input->post('keg');
			$result = array();
			foreach ($keg as $key => $val) {
				$result[] = array(
	      'id_cb_lb'	=> $cbID,
	      'kegiatan' 	=> $_POST['keg'][$key],
	      'cb_tgl_mulai'	=> $_POST['dari'][$key],
	      'cb_tgl_selesai' => $_POST['sampai'][$key],
	      'cb_lb_lengkap' => 'tidak'
	    	);
			}
			$add_detail = $this->db->insert_batch('data_checklist_laporan_bulanan_detail', $result);
			if ($add_detail) {
				$alert_type = "success";
	      $alert_message ="Berhasil input checklist bulanan";
				set_header_message($alert_type,'Checklist Bulanan',$alert_message);
				redirect(karyawan().'propeka/checklist');
			}
			else{
				$alert_type = "danger";
		    $alert_message ="Gagal input checklist bulanan";
				set_header_message($alert_type,'Checklist Bulanan',$alert_message);
				redirect(karyawan().'propeka/checklist');
			}
		}
		else{
			$alert_type = "danger";
	    $alert_message ="Gagal input checklist bulanan";
			set_header_message($alert_type,'Checklist Bulanan',$alert_message);
			redirect(karyawan().'propeka/checklist');
		}
	}
}
