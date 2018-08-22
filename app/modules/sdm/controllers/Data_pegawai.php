<?php defined('BASEPATH') OR exit('');
/**
* 
*/
class Data_pegawai extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model("m_pegawai");
    if ($this->lib_login->is_sdm()==FALSE) {
    	redirect(base_url());
    }
	}

	function print()
	{
		$mpdf = new \Mpdf\Mpdf();
		$mpdf->WriteHTML('<h1>Hello world!</h1>');
		$mpdf->Output('Contoh print','D');
	}
	
	function index()
	{
		$join1 = 'data_pegawai.nip = data_pegawai_detail.nip';
		$join2 = 'data_pegawai.kode_unit = master_unit_kerja.kode_unit';
		$join3 = 'data_pegawai.kode_jabatan = master_jabatan.kode_jabatan';
		$data['pegawai'] = $this->my_lib->get_data_join_quad('data_pegawai','data_pegawai_detail','master_unit_kerja','master_jabatan',$join1,$join2,$join3);
		$data['datatables'] = 'yes';
		$data['javascript'] = $this->load->view('pegawai/data-pegawai-js',$data,true);
		$this->load->view('pegawai/data-pegawai',$data);
	}

	function detail_pegawai()
	{
		$nip = $this->input->get('nip');
		if (!empty($nip)) {
			$cek_data = $this->my_lib->get_data_row('data_pegawai',array('nip'=>$nip));
			if ($cek_data) {				
				$data['pegawai'] = $this->m_pegawai->detail_pegawai($nip);
				$data['agama'] = $this->my_lib->get_data('master_agama');
				$data['javascript'] = $this->load->view('pegawai/detail-pegawai-js',$data,true);
				$this->load->view('pegawai/detail-pegawai',$data);
			}
			else{
				redirect(sdm()."data_pegawai");
			}
		}
		else{
			redirect(sdm()."data_pegawai");
		}
	}

	function edit_pegawai_submit()
	{
		$nip = $this->input->post('nip');
		$this->form_validation->set_rules('nama', 'Nama Karyawan', 'required');
		$this->form_validation->set_rules('gaji_pokok', 'Gaji Pokok', 'required');
		$this->form_validation->set_rules('tgppw', 'TGPPW', 'required');
		if ($this->form_validation->run() == TRUE) {			
			$nama = $this->input->post('nama');
			$gender = $this->input->post('gender');
			$agama = $this->input->post('agama');
			$tmpt_lahir = $this->input->post('tempat_lahir');
			$tgl_lahir = $this->input->post('tgl_lahir');
			$telp = $this->input->post('telepon');
			$email = $this->input->post('email');
			$tgl_masuk = $this->input->post('tgl_masuk');
			$no_sk = $this->input->post('no_sk');
			$tgl_sk = $this->input->post('tgl_sk');
			$tgl_awal_kontrak = $this->input->post('tgl_awal_kontrak');
			$tgl_akhir_kontrak = $this->input->post('tgl_akhir_kontrak');
			$gapok = $this->input->post('gaji_pokok');
			$tgppw = $this->input->post('tgppw');

			$param = array('nip'=>$nip);
			$val1 = array(
				'nama' => $nama,
				'email' => $email
			);
			$val2 = array(
				'gender' => $gender,
				'kode_agama' => $agama,
				'hp' => $telp,
				'tempat_lahir' => $tmpt_lahir,
				'tanggal_lahir' => $tgl_lahir,
				'tanggal_masuk' => $tgl_masuk,
				'nomor_sk' => $no_sk,
				'tanggal_sk' => $tgl_sk,
				'tanggal_awal_kontrak' => $tgl_awal_kontrak,
				'tanggal_akhir_kontrak' => $tgl_akhir_kontrak
			);
			$update_karyawan = $this->my_lib->edit_row('data_pegawai',$val1,$param);
			$update_karyawan_detail = $this->my_lib->edit_row('data_pegawai_detail',$val2,$param);
			if ($update_karyawan && $update_karyawan_detail) {
				$alert_type = "success";
	      $alert_title ="Berhasil perbarui data ".$nama;
				set_header_message($alert_type,'Perbarui Data Karyawan',$alert_title);
				redirect(sdm().'data_pegawai/detail_pegawai?nip='.$nip);
			}
			else{
				$alert_type = "danger";
	      $alert_title ="Gagal perbarui data ".$nama;
				set_header_message($alert_type,'Perbarui Data Karyawan',$alert_title);
				redirect(sdm().'data_pegawai/detail_pegawai?nip='.$nip);
			}
		}
		else{
			$alert_type = "danger";
      $alert_title ="Gagal perbarui data ".$nama;
			set_header_message($alert_type,'Perbarui Data Karyawan',$alert_title);
			redirect(sdm().'data_pegawai/detail_pegawai?nip='.$nip);
		}
	}

	function detail($id=FALSE)
	{
		$nip = field_value('data_pegawai','id',$id,'nip');
		$join1 = 'data_pegawai.nip = data_pegawai_detail.nip';
		$join2 = 'data_pegawai.kode_unit = master_unit_kerja.kode_unit';
		$join3 = 'data_pegawai.kode_jabatan = master_jabatan.kode_jabatan';
		$param = array(
			'data_pegawai.nip' => $nip
		);
		$pegawai = $this->my_lib->get_data_join_quad('data_pegawai','data_pegawai_detail','master_unit_kerja','master_jabatan',$join1,$join2,$join3,$param);
		if ($pegawai) {
			foreach ($pegawai as $row) {
				$data[] = array(
					'id'			=> $row->id,
          'nip'		=> $row->nip,
          'nama'    => $row->nama,
          'unit'		=> $row->nama_unit,
          'jabatan'			=> $row->nama_jabatan
        );
			}
		}
		else{
			$data = array('code'=>'404','message'=>'Tidak ditemukan...');
		}
		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
	}

	function edit($id=FALSE)
	{

	}
}
