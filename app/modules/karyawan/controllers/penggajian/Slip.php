<?php defined('BASEPATH') OR exit('');
/**
 * 
 */
class Slip extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
    if ($this->lib_login->is_karyawan()==FALSE) {
    	redirect(base_url());
    }
	}

	function index()
	{
		$data['periode'] = $this->my_lib->get_data('master_periode','','mulai ASC');
		$data['javascript'] = $this->load->view('penggajian/slip-js',$data,true);
		$this->load->view('penggajian/slip',$data);		
	}

	function tampil_data()
	{
		$this->form_validation->set_rules('per', 'Periode Kerja', 'required');
		$this->form_validation->set_rules('nip', 'NIP', 'required');
		if ($this->form_validation->run() == TRUE) {
			$per = $this->input->post('per');
			$nip = $this->input->post('nip');
			$cek_slip = $this->my_lib->cek('data_slip_gaji',array('id_periode'=>$per,'nip'=>$nip));
			if ($cek_slip == TRUE) {
				$data['periode'] = $this->my_lib->get_data_row('master_periode',array('id_periode'=>$per));
				$data['pegawai'] = $this->my_lib->get_data_row('data_pegawai',array('nip'=>$nip));
				$data['slipgaji'] = $this->my_lib->get_data_row('data_slip_gaji',array('id_periode'=>$per,'nip'=>$nip));
				$tabel = $this->load->view('penggajian/slip-tabel',$data,true);
				$message[] = array('code'=>200,'message'=>'Data Tersedia.','tabel'=>$tabel);
			}
			else{
				$message[] = array('code'=>500,'message'=>'Data Belum Tersedia.');
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
