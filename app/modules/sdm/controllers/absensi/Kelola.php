<?php defined('BASEPATH') OR exit('');
/**
* 
*/
class Kelola extends CI_Controller
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
		$data['pegawai'] = $this->my_lib->get_data('data_pegawai');
		$data['datatables'] = 'yes';
		$data['javascript'] = $this->load->view('absensi/kelola-js',$data,true);
		$this->load->view('absensi/kelola',$data);
	}

	function tampil()
	{
		$this->form_validation->set_rules('per', 'Periode Kerja', 'required');
		$this->form_validation->set_rules('nip', 'NIP Pegawai', 'required');
		if ($this->form_validation->run() == TRUE) {
			$per = $this->input->post('per');
			$nip = $this->input->post('nip');
			
			$param = array(
				'id_periode'=>$per,
				'nip'=>$nip
			);
			$data['periode'] = $this->my_lib->get_data('master_periode',array('id_periode'=>$per));
			$data['absensi'] = $this->my_lib->get_data('absensi_data',$param);
			$data['rekap'] = $this->my_lib->get_data('absensi_rekap',$param);
			$data['pegawai'] = $this->my_lib->get_data('data_pegawai',array('nip'=>$nip));
			$data['nip'] = $nip;
			$data['id_per'] = $per;
			$tabel = $this->load->view('absensi/kelola-tabel',$data,true);
			$message[] = array('code'=>200,'message'=>'Data Tersedia.','tabel'=>$tabel);
		}
		else{
			$message[] = array('code'=>404,'message' => validation_errors('<div class="error">', '</div>'));
		}

		$this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($message));
	}

	function edit_absensi()
	{
		$id_periode = $this->input->get('id_periode');
		$id_absensi = $this->input->get('id_absensi');
		$nip = $this->input->get('nip');
		$data['absensi'] = $this->my_lib->get_data('absensi_data',array('id_absensi'=>$id_absensi));
		$data['pegawai'] = $this->my_lib->get_data('data_pegawai',array('nip'=>$nip));
		$data['periode'] = $this->input->get('id_periode');
		$data['nip'] = $this->input->get('nip');
		$this->load->view('absensi/edit_absensi',$data);
	}

	function edit_absensi_submit()
	{
		$this->form_validation->set_rules('id_periode', 'ID Periode', 'required');
		$this->form_validation->set_rules('nip', 'NIP Pegawai', 'required');
		$this->form_validation->set_rules('id_absensi', 'ID Absensi', 'required');
		$this->form_validation->set_rules('tgl_absensi', 'Tanggal Absensi', 'required');
		$this->form_validation->set_rules('hari_absensi', 'Hari Absensi', 'required');
		$this->form_validation->set_rules('datang', 'Jam Datang', 'required');
		$this->form_validation->set_rules('pulang', 'Jam Pulang', 'required');
		if ($this->form_validation->run() == TRUE) {
			$per = $this->input->post('id_periode');
			$nip = $this->input->post('nip');
			$id_abs = $this->input->post('id_absensi');
			$tgl = $this->input->post('tgl_absensi');
			$hari = $this->input->post('hari_absensi');
			$in = $this->input->post('datang');
			$out = $this->input->post('pulang');

			if ($hari == 'Sabtu') {
				$break = explode_time('00:00:00');
			}
			else{
				$break = explode_time('01:00:00');
			}
			$in_time = explode_time($in);
			$out_time = explode_time($out);
			
			$lama = $out_time - $in_time - $break;
      $lama_kerja = convert_second($lama);

      $nilai_toleransi = explode_time('08:15:00');
      if ($in_time <= $nilai_toleransi) {
        $telat = 0;
      }
      else {
        $telat = 1;
      }

      $param = array('id_absensi'=>$id_abs);
      $value = array(
      	'datang' => $in,
      	'pulang' => $out,
      	'lama_kerja' => $lama_kerja,
      	'telat' => $telat
      );
      $update_absensi = $this->my_lib->edit_row('absensi_data',$value,$param);
      if ($update_absensi) {
      	$tot =0;
    		$tepat_waktu = $this->my_lib->row_count('absensi_data',array('id_periode'=>$per,'nip'=>$nip,'telat'=>0));
    		$data_absen = $this->my_lib->get_data('absensi_data',array('id_periode'=>$per,'nip'=>$nip));
      	foreach ($data_absen as $absen) {
          $tot += explode_time($absen->lama_kerja);
        }
        $total_lama = convert_second($tot);

        $rata2 = $tot / 4;
        $new_rata2 = convert_second($rata2);

        $param_rekap = array('id_periode'=>$per,'nip'=>$nip);
        $value_rekap = array(
        	'total_jam' => $total_lama,
        	'rerata' => $new_rata2,
        	'tepat_waktu' => $tepat_waktu
        );
        $update_rekap = $this->my_lib->edit_row('absensi_rekap',$value_rekap,$param_rekap);
        if ($update_rekap) {
        	redirect(sdm().'absensi/kelola/edit_absensi?id_periode='.$per.'&id_absensi='.$id_abs.'&nip='.$nip);
        }
      }
      else{
      	redirect(sdm().'absensi/kelola/edit_absensi?id_periode='.$per.'&id_absensi='.$id_abs.'&nip='.$nip);
      }
		}
		else{

		}
	}

}
