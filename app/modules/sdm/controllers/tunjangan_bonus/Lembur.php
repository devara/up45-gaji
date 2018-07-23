<?php defined('BASEPATH') OR exit('');
/**
* 
*/
class Lembur extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model("upload_absensi");
    if ($this->lib_login->is_sdm()==FALSE) {
    	redirect(base_url());
    }
	}

	function index()
	{
		$data['periode'] = $this->my_lib->get_data('master_periode');
		$data['unit'] = $this->my_lib->get_data('master_unit_kerja','','nama_unit ASC');
		$data['pegawai'] = $this->my_lib->get_data('data_pegawai','','nama ASC');
		$data['datatables'] = 'yes';
		$data['javascript'] = $this->load->view('tunj_bonus/lembur-js',$data,true);
		$this->load->view('tunj_bonus/lembur',$data);
	}

	function tampil()
	{
		$this->form_validation->set_rules('per', 'Periode Kerja', 'required');
		$this->form_validation->set_rules('unit', 'Unit Kerja', 'required');
		if ($this->form_validation->run() == TRUE) {
			$per = $this->input->post('per');
			$unit = $this->input->post('unit');
			$nip = $this->input->post('nip');
			if ($unit=='all') {
				$param = array(
					'id_periode'=>$per,
					'acc'=>'ya'				
				);
				$data['jenis'] = 'all_unit';
				$join = 'data_pegawai.nip = data_lembur.nip';
				$data['cekLembur'] = $this->my_lib->get_data_join('data_pegawai','data_lembur',$param,$join);
			}
			else{
				if ($nip == NULL || $nip == 'all') {
					$param = array(
						'kode_unit'=>$unit,
						'id_periode'=>$per,
						'acc'=>'ya'
					);
					$data['jenis'] = 'one_unit';
					$join = 'data_pegawai.nip = data_lembur.nip';
					$data['periode'] = $this->my_lib->get_data('master_periode',array('id_periode'=>$per));
					$data['unit'] = $this->my_lib->get_data('master_unit_kerja',array('kode_unit'=>$unit));
					$data['cekLembur'] = $this->my_lib->get_data_join('data_pegawai','data_lembur',$param,$join);
				}
				else{
					$param = array(
						'id_periode'=>$per,
						'data_lembur.nip' => $nip,
						'acc'=>'ya'
					);
					$data['jenis'] = 'one_person';
					$join = 'data_pegawai.nip = data_lembur.nip';
					$data['periode'] = $this->my_lib->get_data('master_periode',array('id_periode'=>$per));
					$data['pegawai'] = $this->my_lib->get_data('data_pegawai',array('nip'=>$nip));
					$data['cekLembur'] = $this->my_lib->get_data_join('data_pegawai','data_lembur',$param,$join);
				}
				
			}
			$tabel = $this->load->view('tunj_bonus/lembur-tabel',$data,true);
			$message[] = array('code'=>200,'message'=>'Data Tersedia.','tabel'=>$tabel);
		}
		else{
			$message[] = array('code'=>404,'message' => validation_errors('<div class="error">', '</div>'));
		}
		$this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($message));
	}

	function input()
	{
		$this->form_validation->set_rules('idPeriode', 'Periode Kerja', 'required');
		$this->form_validation->set_rules('tanggal', 'Tanggal Lembur', 'required');
		$this->form_validation->set_rules('idPegawai', 'Nama Pegawai', 'required');
		$this->form_validation->set_rules('addmulai', 'Jam Mulai', 'required');
		$this->form_validation->set_rules('addsampai', 'Jam Selesai', 'required');
		$this->form_validation->set_rules('addket', 'Keterangan Lembur', 'required');
		if ($this->form_validation->run() == TRUE) {
			$per = $this->input->post('idPeriode');
			$tgl = $this->input->post('tanggal');
			$nip = $this->input->post('idPegawai');
			$mulai = $this->input->post('addmulai');
			$sampai = $this->input->post('addsampai');
			$ket = $this->input->post('addket');

			$nominal = $this->my_lib->get_data_row('master_nominal',array('status'=>'aktif'));

			$time_mulai = explode_time($this->input->post('addmulai'));
			$time_sampai = explode_time($this->input->post('addsampai'));
			$time_durasi = $time_sampai - $time_mulai;
			$satu_jam = explode_time('01:00:00');
			$dua_jam = explode_time('02:00:00');
			$durasi = convert_second($time_durasi);
			if ($time_durasi > $dua_jam) {
				$insentif = (($time_durasi/$satu_jam)*$nominal->row('lembur'))+$nominal->row('uang_makan');
			}
			else{
				$insentif = ($time_durasi/$satu_jam)*$nominal->row('lembur');
			}			
			
			$value = array(
				'id_periode' => $per,
				'nip'	=> $nip,
				'tgl_lembur' => $tgl,
				'jam_mulai' => $mulai,
				'jam_selesai' => $sampai,
				'durasi' => $durasi,
				'total' => $insentif,
				'keterangan' => $ket,
				'acc' => 'ya'
			);
			$param = array(
				'id_periode' => $per,
				'nip' => $nip
			);
			$input_data_lembur = $this->my_lib->add_row('data_lembur',$value);
			if ($input_data_lembur) { #jika berhasil menyimpan data lembur
				$cek_data_insentif = $this->my_lib->cek('gaji_lembur',$param);
				if ($cek_data_insentif == TRUE) { #jika data insentif lembur sudah ada
					$data_insentif = $this->my_lib->get_data_row('gaji_lembur',$param);
					$lembur_old = $data_insentif->row('jml_lembur');
					$insentif_old = $data_insentif->row('jml_insentif');

					$lembur_new = $lembur_old + 1;
					$insentif_new = $insentif_old + $insentif;

					$new_value_insentif = array(
						'jml_lembur' => $lembur_new,
						'jml_insentif' => $insentif_new
					);
					$update_data_insentif = $this->my_lib->edit_row('gaji_lembur',$new_value_insentif,$param);
					if ($update_data_insentif) {
						$message[] = array('code'=>200,'message'=>'Data Lembur Berhasil Disimpan.');
					}
					else{
						$message[] = array('code'=>500,'message'=>'Data Lembur Gagal disimpan.');
					}
				}
				else{ #jika data insentif lembur belum ada
					$value_insentif = array(
						'id_periode' => $per,
						'nip' => $nip,
						'jml_lembur' => 1,
						'jml_insentif' => $insentif
					);
					$input_data_insentif = $this->my_lib->add_row('gaji_lembur',$value_insentif);
					if ($input_data_insentif) {
						$message[] = array('code'=>200,'message'=>'Data Lembur Berhasil Disimpan.');
					}
					else{
						$message[] = array('code'=>500,'message'=>'Data Lembur Gagal disimpan.');
					}
				}
				
			}
			else{ #jika gagal menyimpan data lembur
				$message[] = array('code'=>500,'message'=>'Data Lembur Gagal disimpan.');
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
