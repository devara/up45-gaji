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
		if (!empty($this->input->get('ref'))) {
			$data['aktifTab'] = $this->input->get('ref');
		}
		else{
			$data['aktifTab'] = 'data';
		}
		$data['periode'] = $this->my_lib->get_data('master_periode','','mulai ASC');
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
					'acc_kabag'=>'ya',
					'acc'=>'ya'				
				);
				$data['jenis'] = 'all_unit';
				$join = 'data_pegawai.nip = data_lembur.nip';
				$data['cekLembur'] = $this->my_lib->get_data_join('data_pegawai','data_lembur',$param,$join,'tgl_lembur ASC');
				$data['periode'] = $this->my_lib->get_data_row('master_periode',array('id_periode'=>$per));
			}
			else{
				if ($nip == NULL || $nip == 'all') {
					$param = array(
						'kode_unit'=>$unit,
						'id_periode'=>$per,
						'acc_kabag'=>'ya',
						'acc'=>'ya'
					);
					$data['jenis'] = 'one_unit';
					$join = 'data_pegawai.nip = data_lembur.nip';
					$data['periode'] = $this->my_lib->get_data_row('master_periode',array('id_periode'=>$per));
					$data['unit'] = $this->my_lib->get_data_row('master_unit_kerja',array('kode_unit'=>$unit));
					$data['cekLembur'] = $this->my_lib->get_data_join('data_pegawai','data_lembur',$param,$join,'tgl_lembur ASC');
				}
				else{
					$param = array(
						'id_periode'=>$per,
						'data_lembur.nip' => $nip,
						'acc_kabag'=>'ya',
						'acc'=>'ya'
					);
					$data['jenis'] = 'one_person';
					$join = 'data_pegawai.nip = data_lembur.nip';
					$data['periode'] = $this->my_lib->get_data_row('master_periode',array('id_periode'=>$per));
					$data['pegawai'] = $this->my_lib->get_data_row('data_pegawai',array('nip'=>$nip));
					$data['cekLembur'] = $this->my_lib->get_data_join('data_pegawai','data_lembur',$param,$join,'tgl_lembur ASC');
					$data['upah'] = $this->my_lib->get_data_row('data_upah_lembur',array('id_periode'=>$per,'nip'=>$nip));
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

			$time_mulai = convert_time($this->input->post('addmulai'));
			$time_sampai = convert_time($this->input->post('addsampai'));
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
				'nip'	=> $nip,
				'tgl_lembur' => $tgl,
				'jam_mulai' => $mulai,
				'jam_selesai' => $sampai,
				'durasi' => $durasi,
				'total' => $insentif,
				'keterangan' => $ket,
				'acc_kabag'=>'ya',
				'acc' => 'ya'
			);
			$param = array(
				'id_periode' => $per,
				'nip' => $nip
			);
			$input_data_lembur = $this->my_lib->add_row('data_lembur',$value);
			if ($input_data_lembur) { #jika berhasil menyimpan data lembur
				$cek_data_insentif = $this->my_lib->cek('data_upah_lembur',$param);
				if ($cek_data_insentif == TRUE) { #jika data insentif lembur sudah ada
					$data_insentif = $this->my_lib->get_data_row('data_upah_lembur',$param);
					$lembur_old = $data_insentif->row('jml_lembur');
					$insentif_old = $data_insentif->row('jml_upah');

					$lembur_new = $lembur_old + 1;
					$insentif_new = $insentif_old + $insentif;

					$new_value_insentif = array(
						'jml_lembur' => $lembur_new,
						'jml_upah' => $insentif_new
					);
					$update_data_insentif = $this->my_lib->edit_row('data_upah_lembur',$new_value_insentif,$param);
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
						'jml_upah' => $insentif
					);
					$input_data_insentif = $this->my_lib->add_row('data_upah_lembur',$value_insentif);
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

	function tampil_edit($id=FALSE)
	{
		$join = 'data_lembur.nip = data_pegawai.nip';
		$lembur = $this->my_lib->get_data_row_join('data_lembur','data_pegawai',$join,array('id_lembur'=>$id));
		if ($lembur) {
			$data[] = array(
				'code' => 200,
				'id' => $lembur->row('id_lembur'),
				'periode' => $lembur->row('id_periode'),
				'tanggal' => $lembur->row('tgl_lembur'),
				'nip' => $lembur->row('nip'),
				'nama' => $lembur->row('nama'),
				'mulai' => $lembur->row('jam_mulai'),
				'selesai' => $lembur->row('jam_selesai'),
				'keterangan' => $lembur->row('keterangan')
      );
		}
		else{
			$data[] = array('code'=>500,'message'=>'Data Tidak Valid.');
		}
		$this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($data));
	}

	function update_lembur()
	{
		$this->form_validation->set_rules('id_periode', 'ID Periode', 'required');
		$this->form_validation->set_rules('nip', 'NIP Karyawan', 'required');
		$this->form_validation->set_rules('idlembur', 'ID Lembur', 'required');
		$this->form_validation->set_rules('tgl_lembur', 'Tanggal Lembur', 'required');
		$this->form_validation->set_rules('jam_mulai', 'Jam Mulai', 'required');
		$this->form_validation->set_rules('jam_selesai', 'Jam Selesai', 'required');
		$this->form_validation->set_rules('ket_lembur', 'Keterangan Lembur', 'required');
		if ($this->form_validation->run() == TRUE) {
			$idlembur = $this->input->post('idlembur');
			$upah_lama = $this->my_lib->get_row('data_lembur',array('id_lembur'=>$idlembur),'total');
			$per = $this->input->post('id_periode');
			$tgl = $this->input->post('tgl_lembur');
			$nip = $this->input->post('nip');
			$mulai = $this->input->post('jam_mulai');
			$sampai = $this->input->post('jam_selesai');
			$ket = $this->input->post('ket_lembur');

			$nominal = $this->my_lib->get_data_row('master_nominal',array('status'=>'aktif'));

			$time_mulai = explode_time($this->input->post('jam_mulai'));
			$time_sampai = explode_time($this->input->post('jam_selesai'));
			$time_durasi = $time_sampai - $time_mulai;
			$satu_jam = explode_time('01:00:00');
			$dua_jam = explode_time('02:00:00');
			$durasi = convert_second($time_durasi);
			if ($time_durasi > $dua_jam) {
				$upah_baru = (($time_durasi/$satu_jam)*$nominal->row('lembur'))+$nominal->row('uang_makan');
			}
			else{
				$upah_baru = ($time_durasi/$satu_jam)*$nominal->row('lembur');
			}

			$val_edit = array(
				'jam_mulai' => $mulai,
				'jam_selesai' => $sampai,
				'durasi' => $durasi,
				'total' => $upah_baru,
				'keterangan' => $ket
			);
			$edit_lembur = $this->my_lib->edit_row('data_lembur',$val_edit,array('id_lembur'=>$idlembur));
			if ($edit_lembur) {
				$param = array(
					'id_periode' => $per,
					'nip' => $nip
				);
				$data_upah = $this->my_lib->get_data_row('data_upah_lembur',$param);
				$total_lama = $data_upah->row('jml_upah');
				$total_baru = ($total_lama + $upah_baru) - $upah_lama;

				$new_value_upah = array(
						'jml_upah' => $total_baru
				);
				$edit_upah = $this->my_lib->edit_row('data_upah_lembur',$new_value_upah,$param);
				if ($edit_upah) {
					$message[] = array('code'=>200,'message'=>'Data lembur berhasil diperbarui.');
				}
				else{
					$message[] = array('code'=>404,'message'=>'Data lembur gagal diperbarui.');
				}
			}
			else{
				$message[] = array('code'=>404,'message'=>'Data lembur gagal diperbarui.');
			}

		}
		else{
			$message[] = array('code'=>500,'message' => validation_errors('<div class="error">', '</div>'));
		}
		$this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($message));
	}

	function cek_hapus($id=FALSE)
	{
		$lembur = $this->my_lib->get_data_row('data_lembur',array('id_lembur'=>$id));
		$message[] = array(
				'code' => 200,
				'id' => $lembur->row('id_lembur'),
				'periode'=>$lembur->row('id_periode'),
				'nip'=>$lembur->row('nip')
      );
		$this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($message));
	}

	function hapus_lembur()
	{
		$idlembur = $this->input->post('idlembur');
		$per = $this->input->post('per');
		$nip = $this->input->post('nip');
		$upah_lembur = $this->my_lib->get_row('data_lembur',array('id_lembur'=>$idlembur),'total');
		$hapus_lembur = $this->my_lib->delete_row('data_lembur',array('id_lembur'=>$idlembur));
		if ($hapus_lembur) {
			$param = array(
				'id_periode' => $per,
				'nip' => $nip
			);
			$data_upah = $this->my_lib->get_data_row('data_upah_lembur',$param);
			if ($data_upah->row('jml_lembur') == 1) {
				$hapus_data_upah = $this->my_lib->delete_row('data_upah_lembur',$param);
				if ($hapus_data_upah) {
					$data[] = array('code'=>200,'message'=>'Data lembur dan data upah lembur berhasil dihapus.');
				}
				else{
					$data[] = array('code'=>404,'message'=>'Data lembur berhasil dihapus, akan tetapi data upah lembur gagal dihapus.');
				}
			}
			else{
				$total_lembur_sekarang = $data_upah->row('jml_lembur') - 1;
				$total_upah_sekarang = $data_upah->row('jml_upah') - $upah_lembur;
				$val_edit = array(
					'jml_lembur'=>$total_lembur_sekarang,
					'jml_upah'=>$total_upah_sekarang
				);
				$edit_data_upah = $this->my_lib->edit_row('data_upah_lembur',$val_edit,$param);
				if ($edit_data_upah) {
					$data[] = array('code'=>200,'message'=>'Data lembur berhasil dihapus dan data upah lembur berhasil diperbarui.');
				}
				else{
					$data[] = array('code'=>404,'message'=>'Data lembur berhasil dihapus, akan tetapi data upah lembur gagal diperbarui.');
				}
			}
		}
		else{
			$data[] = array('code'=>404,'message'=>'Data lembur gagal dihapus.');
		}
		$this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($data));
	}

	function cek_pengajuan()
	{
		$this->form_validation->set_rules('per', 'Periode Kerja', 'required');
		$this->form_validation->set_rules('unit', 'Unit Kerja', 'required');
		if ($this->form_validation->run() == TRUE) {
			$per = $this->input->post('per');
			$unit = $this->input->post('unit');
			if ($unit=='all') {
				$param = array(
					'id_periode'=>$per,
					'input_tipe'=>'karyawan',
					'acc'=>'belum'
				);
				$data['jenis'] = 'all_unit';
				$join = 'data_pegawai.nip = data_lembur.nip';
				$data['cekLembur'] = $this->my_lib->get_data_join('data_pegawai','data_lembur',$param,$join,'tgl_lembur ASC');
				$data['periode'] = $this->my_lib->get_data_row('master_periode',array('id_periode'=>$per));
			}
			else{
				$param = array(
					'kode_unit'=>$unit,
					'id_periode'=>$per,
					'input_tipe'=>'karyawan',
					'acc'=>'belum'
				);
				$data['jenis'] = 'one_unit';
				$join = 'data_pegawai.nip = data_lembur.nip';
				$data['periode'] = $this->my_lib->get_data_row('master_periode',array('id_periode'=>$per));
				$data['unit'] = $this->my_lib->get_data_row('master_unit_kerja',array('kode_unit'=>$unit));
				$data['cekLembur'] = $this->my_lib->get_data_join('data_pegawai','data_lembur',$param,$join,'tgl_lembur ASC');				
			}
			$tabel = $this->load->view('tunj_bonus/pengajuan-tabel',$data,true);
			$message[] = array('code'=>200,'message'=>'Data Tersedia.','tabel'=>$tabel);
		}
		else{
			$message[] = array('code'=>404,'message' => validation_errors('<div class="error">', '</div>'));
		}
		$this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($message));
	}

	function eksekusi_pengajuan_lembur()
	{
		$this->form_validation->set_rules('lembur_id', 'ID Lembur', 'required');
		$this->form_validation->set_rules('tindakan', 'Tindakan Pengajuan', 'required');
		if ($this->form_validation->run() == TRUE) {
			$idlembur = $this->input->post('lembur_id');
			$tindakan = $this->input->post('tindakan');
			$data_lembur = $this->my_lib->get_data_row('data_lembur',array('id_lembur'=>$idlembur));
			$param = array(
				'id_periode'=>$data_lembur->row('id_periode'),
				'nip'=>$data_lembur->row('nip')
			);
			if ($data_lembur->row('acc') == 'belum') {
				if ($tindakan == 'ya') {
					$update_lembur = $this->my_lib->edit_row('data_lembur',array('acc'=>'ya'),array('id_lembur'=>$idlembur));
					if ($update_lembur) {
						$cek_upah_lembur = $this->my_lib->cek('data_upah_lembur',$param);
						if ($cek_upah_lembur) {
							$data_upah_lembur = $this->my_lib->get_data_row('data_upah_lembur',$param);
							$total_upah_lama = $data_upah_lembur->row('jml_upah');
							$jml_lembur_lama = $data_upah_lembur->row('jml_lembur');
							$total_upah_baru = $total_upah_lama + $data_lembur->row('total');
							$jml_lembur_baru = $jml_lembur_lama + 1;
							$data_update = array(
								'jml_lembur'=> $jml_lembur_baru,
								'jml_upah'=> $total_upah_baru
							);
							$update_upah_lembur = $this->my_lib->edit_row('data_upah_lembur',$data_update,$param);
							$message[] = array('code'=>200,'message'=>'Eksekusi pengajuan berhasil.');
						}
						else{
							$data_add = array(
								'jml_lembur'=> 1,
								'jml_upah'=> $data_lembur->row('total')
							);
							$add_upah_lembur = $this->my_lib->add_row('data_upah_lembur',$data_add);
							$message[] = array('code'=>200,'message'=>'Eksekusi pengajuan berhasil.');
						}
					}
					else{
						$message[] = array('code'=>404,'message'=>'Eksekusi pengajuan gagal.');
					}
				}
				else{
					$update_lembur = $this->my_lib->edit_row('data_lembur',array('acc'=>'tidak'),array('id_lembur'=>$idlembur));
					if ($update_lembur) {
						$message[] = array('code'=>200,'message'=>'Eksekusi pengajuan berhasil.');
					}
					else{
						$message[] = array('code'=>404,'message'=>'Eksekusi pengajuan gagal.');
					}
				}
			}
			else{
				$message[] = array('code'=>404,'message'=>'Eksekusi sudah dilakukan sebelumnya.');
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
