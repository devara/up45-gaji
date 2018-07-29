<?php defined('BASEPATH') OR exit('');
/**
 * 
 */
class Pengawas extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
    if ($this->lib_login->is_akademik()==FALSE) {
    	redirect(base_url());
    }
	}

	function index()
	{
		$data['ujian'] = $this->my_lib->get_data('data_ujian');
		$data['periode'] = $this->my_lib->get_data('master_periode');
		$data['pegawai'] = $this->my_lib->get_data('data_pegawai');
		$data['datatables'] = 'yes';
		$data['javascript'] = $this->load->view('datapengawas/pengawas-js',$data,true);
		$data['aktifTab'] = 'pengawas';
		$this->load->view('datapengawas/pengawas',$data);
	}

	function get_ujian($periode=FALSE)
	{
		$param = array(
			'id_periode' => $periode,
			'selesai' => 'belum'
		);
		$join = 'data_ujian.kode_matakuliah = master_matakuliah.kode_matakuliah';
		$ujian = $this->my_lib->get_data_join('data_ujian','master_matakuliah',$param,$join);
		if ($ujian) {
			foreach ($ujian as $row) {
				$data[] = array(
					'code'	=> '200',
					'id_ujian' => $row->id_ujian,
					'nama_ujian' => $row->nama_matakuliah,
				);
			}
		}
		else{
			$data[] = array('code'=>'404','message'=>'Tidak ditemukan...');
		}
		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
	}

	function input_pengawas()
	{
		$this->form_validation->set_rules('periode', 'Periode Kerja', 'required');
		$this->form_validation->set_rules('ujianlist', 'Nama Ujian', 'required');
		if ($this->form_validation->run() == TRUE) {
			$periode = $this->input->post('periode');
			$idUjian = $this->input->post('ujianlist');
			$nominal = $this->my_lib->get_data_row('master_nominal',array('status'=>'aktif'));
			$jam_ujian = $this->my_lib->get_row('data_ujian',array('id_ujian'=>$idUjian),'jam_ujian');
			if ($jam_ujian == 'reguler') {
				$insentif = $nominal->row('pengawas_reguler');
			}
			else{
				$insentif = $nominal->row('pengawas_malam');
			}
			$nm = $this->input->post('peg_ganda');
			$result = array();
		  foreach($nm AS $key => $val){
		    $result[] = array(
		    	'id_ujian' => $idUjian,
		  	  'nip' 	=> $_POST['peg_ganda'][$key]
		    );
		    $nip = $_POST['peg_ganda'][$key];
		    $cek_data_insentif = $this->my_lib->cek('data_upah_pengawas',array('id_periode'=>$periode,'nip'=>$nip));
		    if ($cek_data_insentif == TRUE) {
		    	$data_insentif = $this->my_lib->get_data_row('data_upah_pengawas',array('id_periode'=>$periode,'nip'=>$nip));
					$hadir_old = $data_insentif->row('jml_hadir');
					$insentif_old = $data_insentif->row('jml_upah');

					$hadir_new = $hadir_old + 1;
					$insentif_new = $insentif_old + $insentif;

					$new_value_insentif = array(
						'jml_hadir' => $hadir_new,
						'jml_upah' => $insentif_new
					);
					$this->my_lib->edit_row('data_upah_pengawas',$new_value_insentif,array('id_periode'=>$periode,'nip'=>$nip));
		    }
		    else{
		    	$value_insentif = array(
						'id_periode' => $periode,
						'nip' => $nip,
						'jml_hadir' => 1,
						'jml_upah' => $insentif
					);
					$this->my_lib->add_row('data_upah_pengawas',$value_insentif);
		    }

		  }
		  $update = $this->my_lib->edit_row('data_ujian',array('selesai'=>'sudah'),array('id_ujian'=>$idUjian));
		  $insert= $this->db->insert_batch('data_ujian_pengawas',$result);
		  if ($insert) {
		  	$alert_type = "success";
	      $alert_title ="Berhasil input pengawas Ujian";
				set_header_message($alert_type,'Input Pengawas Ujian',$alert_title);
				redirect(akademik().'pengawas');
		  }
		}
		else{

		}
		
	}

	function cek_data_pengawas()
	{
		$this->form_validation->set_rules('per', 'Periode Kerja', 'required');
		$this->form_validation->set_rules('nip', 'Nama Pegawai', 'required');
		if ($this->form_validation->run() == TRUE) {
			$per = $this->input->post('per');
			$nip = $this->input->post('nip');
			$param = array(
				'id_periode'=>$per,
				'nip'=>$nip
			);
			$join = 'data_ujian_pengawas.id_ujian = data_ujian.id_ujian';
			$data['cekPengawas'] = $this->my_lib->get_data_join('data_ujian_pengawas','data_ujian',$param,$join);
			$data['cekPegawai'] = $this->my_lib->get_data('data_pegawai',array('nip'=>$nip));
			$tabel = $this->load->view('dataujian/ujian-pengawas-tabel',$data,true);
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
