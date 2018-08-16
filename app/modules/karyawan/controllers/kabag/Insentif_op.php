<?php defined('BASEPATH') OR exit('');
/**
 * 
 */
class Insentif_op extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
    if ($this->lib_login->is_kabag()==FALSE) {
    	redirect(base_url());
    }
	}

	function index()
	{
		$data['periode'] = $this->my_lib->get_data('master_periode','','mulai ASC');
		$data['javascript'] = $this->load->view('kabag/insentif-op-js',$data,true);		
		$this->load->view('kabag/insentif-op',$data);
	}

	function cek()
	{
		$this->form_validation->set_rules('per', 'Periode Kerja', 'required');
		$this->form_validation->set_rules('jab', 'Jabatan', 'required');
		if ($this->form_validation->run() == TRUE) {
			$per = $this->input->post('per');
			$jab = $this->input->post('jab');
			$param = array(
				'id_periode' => $per,
				'pemberi_insentif'	=> $jab
			);
			$cekData = $this->my_lib->cek('data_insentif_op',$param);
			if ($cekData == FALSE) {
				$data['periode'] = $this->my_lib->get_data_row('master_periode',array('id_periode'=>$per));
				$param2 = array(
					'under_of_jabatan'=> $this->session->userdata('jabatan')
				);
				$join = 'master_jabatan.kode_jabatan = data_pegawai.kode_jabatan';
				$data['pegawai'] = $this->my_lib->get_data_join('master_jabatan','data_pegawai',$param2,$join);
				$form = $this->load->view('kabag/insentif-op-form',$data,true);
				$message[] = array('code'=>200,'message'=>'Available.','form'=>$form);
			}
			else {
				$message[] = array('code'=>500,'message'=>'Not available.','status'=>'Anda sudah memberikan insentif untuk periode ini');
			}
		}
		else{
			$message[] = array('code'=>404,'message' => validation_errors('<div class="error">', '</div>'));
		}
		$this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($message));
	}

	function input_insentif()
	{
		$IDper = $this->input->post('periode');
		$jab = $this->input->post('jabatan');
		$nip = $this->input->post('nip');
		$result = array();
		foreach ($nip as $key => $value) {
			$total = $_POST['penilaian'][$key] + $_POST['tepatwaktu'][$key] + $_POST['propeka'][$key] + $_POST['mt'][$key];
			$result[] = array(
				'id_periode' => $IDper,
	  	  'nip' 	=> $_POST['nip'][$key],
	  	  'ins_penilaian' 	=> $_POST['penilaian'][$key],
	  	  'ins_tepat_waktu' 	=> $_POST['tepatwaktu'][$key],
	  	  'ins_propeka' 	=> $_POST['propeka'][$key],
	  	  'ins_mt' 	=> $_POST['mt'][$key],
	      'total_insentif' => $total,
	      'pemberi_insentif' => $jab
	    );
		}
		$insert= $this->db->insert_batch('data_insentif_op', $result);
	  if ($insert) {
	  	$alert_type = "success";
      $alert_title ="Berhasil input insentif operasional karyawan";
			set_header_message($alert_type,'Input Insentif Operasional',$alert_title);
			redirect(karyawan().'kabag/insentif_op');
	  }
	}

	function edit_insentif()
	{
		$this->form_validation->set_rules('periode', 'Periode Kerja', 'required');
		if ($this->form_validation->run() == TRUE) {
			$IDper = $this->input->post('periode');
			$nip = $this->input->post('nip');
			$result = array();
			foreach ($nip as $key => $value) {
				$total = $_POST['penilaian'][$key] + $_POST['tepatwaktu'][$key] + $_POST['propeka'][$key] + $_POST['mt'][$key];
				$result[] = array(
					'id_periode' => $IDper,
		  	  'nip' 	=> $_POST['nip'][$key],
		  	  'ins_penilaian' 	=> $_POST['penilaian'][$key],
		  	  'ins_tepat_waktu' 	=> $_POST['tepatwaktu'][$key],
		  	  'ins_propeka' 	=> $_POST['propeka'][$key],
		  	  'ins_mt' 	=> $_POST['mt'][$key],
		      'total_insentif' => $total,
		      'pemberi_insentif' => $this->session->userdata('jabatan')
		    );
			}
			$this->db->where('id_periode',$IDper);
			$update = $this->db->update_batch('data_insentif_op', $result,'nip');
			if ($update) {
		  	$alert_type = "success";
	      $alert_title ="Berhasil edit insentif operasional karyawan";
				set_header_message($alert_type,'Edit Insentif Operasional',$alert_title);
				redirect(karyawan().'kabag/data_insentif_op');
		  }
		  else{
		  	$alert_type = "warning";
	      $alert_title ="Tidak ada data yang diperbarui";
				set_header_message($alert_type,'Edit Insentif Operasional',$alert_title);
				redirect(karyawan().'kabag/data_insentif_op');
		  }
		}
		else{
			$alert_type = "danger";
      $alert_title = validation_errors('<div class="error">', '</div>');
			set_header_message($alert_type,'Edit Insentif Operasional',$alert_title);
			redirect(karyawan().'kabag/data_insentif_op');
		}
	}
}
