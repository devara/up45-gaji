<?php defined('BASEPATH') OR exit('');
/**
* 
*/
class Jabatan extends CI_Controller
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
		$data['jabatan'] = $this->my_lib->get_data('master_jabatan');
		$data['datatables'] = 'yes';
		$data['javascript'] = $this->load->view('jabatan/data-jabatan-js',$data,true);
		$this->load->view('jabatan/data-jabatan',$data);
	}

	function tambah()
	{
		$this->form_validation->set_rules('kode', 'Kode Jabatan', 'required');
		$this->form_validation->set_rules('nama', 'Nama Jabatan', 'required');
		$this->form_validation->set_rules('tunj', 'Tunjangan Jabatan', 'required');
		$this->form_validation->set_rules('under', 'Dibawahi Oleh', 'required');
		$this->form_validation->set_rules('kap', 'Kapasitas Jabatan', 'required');
		$this->form_validation->set_rules('ket', 'Keterangan Jabatan', 'required');
		if ($this->form_validation->run() == TRUE) {
			$kode = $this->input->post('kode');
			$nama = $this->input->post('nama');
			$tunj = $this->input->post('tunj');
			$ket	= $this->input->post('ket');
			$under = $this->input->post('under');
			$max	= $this->input->post('kap');

			$val = array(
				'kode_jabatan' => $kode,
				'nama_jabatan' => $nama,
				'tunjangan_jabatan' => $tunj,
				'keterangan'	=> $ket,
				'under_of_jabatan'	=> $under,
				'max_satu'	=> $max,
				'tersedia'	=> 'ya'
			);
			$insert = $this->my_lib->add_row('master_jabatan',$val);
			if ($insert) {
				$message[] = array('code'=>200,'message' => 'Jabatan <b>'.$nama.'</b> berhasil disimpan ke database Master Jabatan');
			}
			else{
				$message[] = array('code'=>404,'message' => 'Gagal menyimpan data...');
			}
		}
		else{
			$message[] = array('code'=>500,'message' => validation_errors('<div class="error">', '</div>'));
		}

		$this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($message));
	}

	function edit()
	{
		$this->form_validation->set_rules('id_jab', 'ID Jabatan', 'required');
		$this->form_validation->set_rules('kd_jab', 'Kode Jabatan', 'required');
		$this->form_validation->set_rules('nm_jab', 'Nama Jabatan', 'required');
		$this->form_validation->set_rules('tunj_jab', 'Tunjangan Jabatan', 'required');
		$this->form_validation->set_rules('under_jab', 'Dibawahi Oleh', 'required');
		$this->form_validation->set_rules('kap_jab', 'Kapasitas Jabatan', 'required');
		$this->form_validation->set_rules('ket_jab', 'Keterangan Jabatan', 'required');
		if ($this->form_validation->run() == TRUE) {
			$id = $this->input->post('id_jab');
			$kode = $this->input->post('kd_jab');
			$nama = $this->input->post('nm_jab');
			$tunj = $this->input->post('tunj_jab');
			$ket	= $this->input->post('ket_jab');
			$under = $this->input->post('under_jab');
			$max	= $this->input->post('kap_jab');

			$param = array(
				'id_jabatan' => $id
			);

			if ($max == 'tidak') {
				$val = array(
					'kode_jabatan' => $kode,
					'nama_jabatan' => $nama,
					'tunjangan_jabatan' => $tunj,
					'keterangan'	=> $ket,
					'under_of_jabatan'	=> $under,
					'max_satu'	=> $max,
					'tersedia'	=> 'ya'
				);
			} else {
				$val = array(
					'kode_jabatan' => $kode,
					'nama_jabatan' => $nama,
					'tunjangan_jabatan' => $tunj,
					'keterangan'	=> $ket,
					'under_of_jabatan'	=> $under,
					'max_satu'	=> $max
				);
			}			
			
			$edit = $this->my_lib->edit_row('master_jabatan',$val,$param);
			if ($edit) {
				$message[] = array('code'=>200,'message' => 'Jabatan <b>'.$nama.'</b> berhasil diperbarui ke database Master Jabatan');
			}
			else{
				$message[] = array('code'=>404,'message' => 'Gagal mengubah data jabatan');
			}
		}
		else{
			$message[] = array('code'=>500,'message' => validation_errors('<div class="error">', '</div>'));
		}

		$this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($message));
	}

	function hapus()
	{
		$id = $this->input->post('id');
		$nama = $this->input->post('nama');
		$del = $this->my_lib->delete_row('master_jabatan',array('id_jabatan'=>$id));
		if ($del) {
			$message[] = array('code'=>200,'message' => 'Jabatan '.$nama.' berhasil dihapus');
		}
		else {
			$message[] = array('code'=>404,'message' => 'Gagal menghapus data...');
		}

		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($message));
	}

	function cek_edit($id=FALSE)
	{
		$jab = $this->my_lib->get_data('master_jabatan',array('id_jabatan'=>$id));
		if ($jab) {
			foreach ($jab as $row) {
				$data[] = array(
					'id'			=> $row->id_jabatan,
          'kode'		=> $row->kode_jabatan,
          'nama'    => $row->nama_jabatan,
          'tunj'		=> $row->tunjangan_jabatan,
          'ket'			=> $row->keterangan,
          'under'		=> $row->under_of_jabatan,
          'max'			=> $row->max_satu
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

	function cek_hapus($id=FALSE)
	{
		$jab = $this->my_lib->get_data('master_jabatan',array('id_jabatan'=>$id));
		if ($jab) {
			$kode = field_value('master_jabatan','id_jabatan',$id,'kode_jabatan');
			$cek = $this->my_lib->get_data('data_pegawai',array('kode_jabatan'=>$kode));
			if ($cek) {
				$data[] = array('code'=>'500','message'=>'Jabatan tidak dapat dihapus.','list'=>$cek);
			}
			else {
				foreach ($jab as $row) {
					$data[] = array(
						'code'		=> '200',
	          'id'      => $row->id_jabatan,
	          'kode'		=> $row->kode_jabatan,
	          'nama'    => $row->nama_jabatan,
	          'ket'			=> $row->keterangan
	        );
				}
			}			
		}
		else {
			$data[] = array('code'=>'404','message'=>'Tidak ditemukan...');
		}

		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
	}
}
