<?php defined('BASEPATH') OR exit('');
/**
* 
*/
class Unit_kerja extends CI_Controller
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
		$data['unit'] = $this->my_lib->get_data('master_unit_kerja');
		$data['datatables'] = 'yes';
		$data['javascript'] = $this->load->view('referensi/unit-kerja-js',$data,true);
		$data['unit'] = $this->my_lib->get_data('master_unit_kerja');
		$this->load->view('referensi/unit-kerja',$data);
	}

	function ajax_list()
	{
		$unit = $this->my_lib->get_data('master_unit_kerja');
		echo json_encode($unit);

	}

	function tambah()
	{
		$this->form_validation->set_rules('kode', 'Kode Unit', 'required');
		$this->form_validation->set_rules('bidang', 'Bidang', 'required');
		$this->form_validation->set_rules('nama', 'Nama Unit', 'required');
		$this->form_validation->set_rules('ket', 'Keterangan Unit', 'required');
		if ($this->form_validation->run() == TRUE) {
			$kode = $this->input->post('kode');
			$bid = $this->input->post('bidang');
			$nama = $this->input->post('nama');
			$ket = $this->input->post('ket');

			$val = array(
				'kode_unit' => $kode,
				'kode_bidang' => $bid,
				'nama_unit' => $nama,
				'keterangan' => $ket
			);

			$insert = $this->my_lib->add_row('master_unit_kerja',$val);
			if ($insert) {
				$message[] = array('code'=>200,'message' => 'Unit Kerja <b>'.$nama.'</b> berhasil ditambahkan ke database Master Unit Kerja');
			}
			else {
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
		$this->form_validation->set_rules('kode', 'Kode Unit', 'required');
		$this->form_validation->set_rules('bidang', 'Bidang', 'required');
		$this->form_validation->set_rules('nama', 'Nama Unit', 'required');
		$this->form_validation->set_rules('ket', 'Keterangan Unit', 'required');
		if ($this->form_validation->run() == TRUE) {
			$kode = $this->input->post('kode');
			$bid = $this->input->post('bidang');
			$nama = $this->input->post('nama');
			$ket = $this->input->post('ket');

			$param = array(
				'kode_unit' => $kode
			);
			$val = array(
				'kode_unit' => $kode,
				'kode_bidang' => $bid,
				'nama_unit' => $nama,
				'keterangan' => $ket
			);

			$edit = $this->my_lib->edit_row('master_unit_kerja',$val,$param);
			if ($edit) {
				$message[] = array('code'=>200,'message' => 'Unit Kerja <b>'.$nama.'</b> berhasil diperbarui ke database Master Unit Kerja');
			}
			else {
				$message[] = array('code'=>404,'message' => 'Gagal mengubah data...');
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
		$kode = $this->input->post('kd');
		$nama = $this->input->post('nama');

		$del = $this->my_lib->delete_row('master_unit_kerja',array('kode_unit'=>$kode));
		if ($del) {
			$message[] = array('code'=>200,'message' => 'Unit Kerja '.$nama.' berhasil dihapus dari database Master Unit Kerja');
		}
		else {
			$message[] = array('code'=>404,'message' => 'Gagal menghapus data...');
		}

		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($message));
	}

	function cek_edit($kode=FALSE)
	{
		$unit = $this->my_lib->get_data('master_unit_kerja',array('kode_unit'=>$kode));
		if ($unit) {
			foreach ($unit as $row) {
				$data[] = array(
					'code'		=> 200,
          'kode'		=> $row->kode_unit,
          'bidang'	=> $row->kode_bidang,
          'nama'    => $row->nama_unit,
          'ket'			=> $row->keterangan
        );
			}
		}
		else {
			$data[] = array('code'=>'404','message'=>'Tidak ditemukan...');
		}

		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
	}

	function cek_hapus($kode=FALSE)
	{
		$unit = $this->my_lib->get_data('master_unit_kerja',array('kode_unit'=>$kode));
		if ($unit) {
			$cek = $this->my_lib->get_data('data_pegawai',array('kode_unit'=>$kode));
			if ($cek) {
				$data[] = array('code'=>'500','message'=>'Unit Kerja tidak dapat dihapus.','list'=>$cek);
			}
			else {
				foreach ($unit as $row) {
					$data[] = array(
						'code'		=> '200',
	          'kode'		=> $row->kode_unit,
	          'bidang'	=> $row->kode_bidang,
	          'nama'    => $row->nama_unit,
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
