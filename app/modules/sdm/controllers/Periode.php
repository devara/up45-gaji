<?php defined('BASEPATH') OR exit('');
/**
* 
*/
class Periode extends CI_Controller
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
		$data['periode'] = $this->my_lib->get_data('master_periode','','mulai ASC');
		$data['datatables'] = 'yes';
		$data['javascript'] = $this->load->view('periode/periode-js',$data,true);
		$this->load->view('periode/periode',$data);
	}

	function set_aktif()
	{
		$this->form_validation->set_rules('idperiode', 'Periode Kerja', 'required');
		if ($this->form_validation->run() == TRUE) {
			$idper = $this->input->post('idperiode');
			$param = array('id_periode'=>$idper);
			if ($idper != 0) {
				$get_periode_aktif = $this->my_lib->get_row('master_periode',array('aktif'=>'ya'),'id_periode');
				if ($get_periode_aktif) {
					$this->my_lib->edit_row('master_periode',array('aktif'=>'tidak'),array('id_periode'=>$get_periode_aktif));
					$set_aktif = $this->my_lib->edit_row('master_periode',array('aktif'=>'ya'),$param);
					if ($set_aktif) {
						$alert_type = "success";
			      $alert_title = "Aktivasi periode kerja berhasil";
						set_header_message($alert_type,'Set Aktif Periode Kerja',$alert_title);
						redirect(sdm().'periode');
					}
				}
				else{					
					$set_aktif = $this->my_lib->edit_row('master_periode',array('aktif'=>'ya'),$param);
					if ($set_aktif) {
						$alert_type = "success";
			      $alert_title = "Aktivasi periode kerja berhasil";
						set_header_message($alert_type,'Set Aktif Periode Kerja',$alert_title);
						redirect(sdm().'periode');
					}
				}
			}
			else{
				$alert_type = "danger";
			  $alert_title = "Aktivasi periode kerja gagal";
				set_header_message($alert_type,'Set Aktif Periode Kerja',$alert_title);
				redirect(sdm().'periode');
			}
		}
		else{
			$alert_type = "danger";
			$alert_title = "Aktivasi periode kerja gagal";
			set_header_message($alert_type,'Set Aktif Periode Kerja',$alert_title);
			redirect(sdm().'periode');
		}
	}

	function tambah()
	{
		$this->form_validation->set_rules('thn', 'Tahun Periode', 'required');
		$this->form_validation->set_rules('bln', 'Bulan', 'required');
		$this->form_validation->set_rules('mulai', 'Tanggal Mulai', 'required');
		$this->form_validation->set_rules('akhir', 'Tanggal Akhir', 'required');
		$this->form_validation->set_rules('jum', 'Jumlah Hari', 'required');
		$this->form_validation->set_rules('pemb', 'Pembagi', 'required');
		if ($this->form_validation->run() == TRUE) {
			$thn = $this->input->post('thn');
			$bln = $this->input->post('bln');
			$mul = $this->input->post('mulai');
			$akh = $this->input->post('akhir');
			$jum = $this->input->post('jum');
			$pem = $this->input->post('pemb');
			$val = array(
				'tahun' => $thn,
				'bulan' => $bln,
				'mulai' => $mul,
				'akhir' => $akh,
				'hari_aktif' => $jum,
				'pembagi' => $pem,
				'aktif' => 'tidak'
			);
			$insert = $this->my_lib->add_row('master_periode',$val);
			if ($insert) {
				$message[] = array('code'=>200,'message' => 'Data Periode berhasil ditambahkan ke database');
			}
			else{
				$message[] = array('code'=>404,'message' => 'Gagal menyimpan data periode');
			}
		} else{
			$message[] = array('code'=>500,'message' => validation_errors('<div class="error">', '</div>'));
		}
		$this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($message));
	}
}
