<?php defined('BASEPATH') OR exit('');
/**
* 
*/
class Rkhlh extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
    if ($this->lib_login->is_sdm()==FALSE) {
    	redirect(base_url());
    }
	}

	function index()
	{
		$data['periode'] = $this->my_lib->get_data('master_periode');
		$data['pegawai'] = $this->my_lib->get_data('data_pegawai','','nama ASC');
		$data['rkhlh'] = $this->my_lib->get_data('data_rkhlh');
		$data['datatables'] = 'yes';
		$data['javascript'] = $this->load->view('propeka/rkhlh-js',$data,true);
		$this->load->view('propeka/rkhlh-data',$data);
	}

	function cekper($per=FALSE)
	{
		$periode = $this->my_lib->get_data('master_periode',array('id_periode'=>$per));
		if ($periode) {
			foreach ($periode as $row) {
				$data[] = array(
					'id'			=> $row->id_periode,
          'min'		=> $row->mulai,
          'max'    => $row->akhir
        );
			}
		}
		else {
			$data = array('code'=>'404','message'=>'Tidak ditemukan...');
		}

		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
	}

	function tambah()
	{
		$periode = $this->input->post('periode');
		$tgl = $this->input->post('tanggal');
		$nip = $this->input->post('pegawai');
		$data = array(
			'id_periode'	=> $periode,
			'tanggal' => $tgl,
			'nip'	=> $nip
		);
		$addrkh = $this->db->insert('data_rkhlh',$data);

		if ($addrkh) {
			$rkhID = $this->my_lib->last_insert_id();
			$keg = $this->input->post('keg');
			$result = array();
			foreach ($keg as $key => $val) {
				$result[] = array(
	      'id_rkhlh'	=> $rkhID,
	      'kegiatan' 	=> $_POST['keg'][$key],
	      'dari'	=> $_POST['dari'][$key],
	      'sampai' => $_POST['sampai'][$key],
	    	);				
			}

			$test= $this->db->insert_batch('data_rkhlh_detail', $result);

		}
		redirect(base_url().'sdm');
	}

	function buat_lh()
	{
		$id = $this->input->post('id');
		$result = array();
		foreach ($id as $key => $val) {
			$result[] = array(
				'id_rkhlh_detail' => $_POST['id'][$key],
				'mulai_lh' => $_POST['lh_mulai'][$key],
				'sampai_lh' => $_POST['lh_sampai'][$key],
				'keterangan' => $_POST['ket'][$key],
			);
		}
		$update= $this->db->update_batch('data_rkhlh_detail', $result,'id_rkhlh_detail');
		if ($update) {
			$alert_type = "success";
      $alert_title ="Berhasil Membuat Laporan Harian";
			set_header_message($alert_type,'Submit Laporan Harian',$alert_title);
			redirect(sdm().'rkhlh');
		}
	}

	function getrkh($id=FALSE)
	{
		$data['detail'] = $this->my_lib->get_data('data_rkhlh_detail',array('id_rkhlh'=>$id));
		$formRKH = $this->load->view('propeka/rkhlh-form',$data,true);
		$message[] = array('code'=>200,'message'=>'Data Tersedia.','form'=>$formRKH);

		$this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($message));
	}

	function getrkh_by_tgl($tgl=FALSE)
	{
		$id = field_value('data_rkhlh','tanggal',$tgl,'id_rkhlh');
		$data['detail'] = $this->my_lib->get_data('data_rkhlh_detail',array('id_rkhlh'=>$id));
		$data['tanggal'] = $tgl;
		$formRKH = $this->load->view('propeka/rkhlh-form',$data,true);
		$message[] = array('code'=>200,'message'=>'Data Tersedia.','form'=>$formRKH);

		$this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($message));
	}
}