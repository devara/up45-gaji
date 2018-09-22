<?php defined('BASEPATH') OR exit('');
/**
 * 
 */
use \Mailjet\Resources;
class Data_slip extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model("m_slip");
    if ($this->lib_login->is_keuangan()==FALSE) {
    	redirect(base_url());
    }
	}
	
	function index()
	{
		$data['periode'] = $this->my_lib->get_data('master_periode','','mulai ASC');
		$data['unit'] = $this->my_lib->get_data('master_unit_kerja');
		$data['javascript'] = $this->load->view('master/data-slip-js',$data,true);
		$this->load->view('master/data-slip',$data);		
	}

	function tampil_data()
	{
		$this->form_validation->set_rules('per', 'Periode Kerja', 'required');
		$this->form_validation->set_rules('unit', 'Unit Kerja', 'required');
		if ($this->form_validation->run() == TRUE) {
			$per = $this->input->post('per');
			$unit = $this->input->post('unit');
			
			$data['nominal'] = $this->my_lib->get_data_row('master_nominal',array('status'=>'aktif'));
			$data['periode'] = $this->my_lib->get_data_row('master_periode',array('id_periode'=>$per));
			$data['unit'] = $this->my_lib->get_data_row('master_unit_kerja',array('kode_unit'=>$unit));
			$data['pegawai'] = $this->my_lib->get_data('data_pegawai',array('kode_unit'=>$unit));
			$tabel = $this->load->view('master/data-slip-tabel',$data,true);
			$message[] = array('code'=>200,'message'=>'Data Tersedia.','tabel'=>$tabel);
		}
		else{
			$message[] = array('code'=>404,'message' => validation_errors('<div class="error">', '</div>'));
		}
		$this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($message));
	}

	function tampil_detail()
	{
		$this->form_validation->set_rules('id_slip', 'ID Slip Gaji', 'required');
		if ($this->form_validation->run() == TRUE) {
			$IDslip = $this->input->post('id_slip');
			
			$data['slipgaji'] = $this->m_slip->detail_slip($IDslip);
			$detail = $this->load->view('master/data-slip-detail',$data,true);
			$message[] = array('code'=>200,'message'=>'Data Tersedia.','detail'=>$detail);
		}
		else{
			$message[] = array('code'=>404,'message' => validation_errors('<div class="error">', '</div>'));
		}
		$this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($message));
	}

	function tampil_kirim()
	{
		$this->form_validation->set_rules('id_slip', 'ID Slip Gaji', 'required');
		if ($this->form_validation->run() == TRUE) {
			$IDslip = $this->input->post('id_slip');
			
			$nip = $this->my_lib->get_row('data_slip_gaji',array('id_slip_gaji'=>$IDslip),'nip');
			$pegawai = $this->my_lib->get_data_row('data_pegawai',array('nip'=>$nip));
			$message[] = array(
				'code'=>200,
				'message'=>'Data Tersedia.',
				'id'=>$IDslip,
				'nama'=>$pegawai->row('nama'),
				'email'=>$pegawai->row('email')
			);
		}
		else{
			$message[] = array('code'=>404,'message' => validation_errors('<div class="error">', '</div>'));
		}
		$this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($message));
	}

	function kirim_email_slip()
	{
		$mj = new \Mailjet\Client('8c4c7d65acd6ec0449e6f3312e291275','44582ddc644bf30c8368d8369f7e44ac',true,['version' => 'v3.1']);
		$IDslip = $this->input->post('slipid');
		$nama_user = $this->input->post('nama');
		$mail_user = $this->input->post('email');
		$data['slipgaji'] = $this->m_slip->detail_slip($IDslip);
		$slip_html = $this->load->view('master/mail_slip',$data,true);
		$body = [
		    'Messages' => [
		        [
		            'From' => [
		                'Email' => "developer.up45@gmail.com",
		                'Name' => "Sistem Gaji"
		            ],
		            'To' => [
		                [
		                    'Email' => $mail_user,
		                    'Name' => $nama_user
		                ]
		            ],
		            'Subject' => "Slip Gaji Bulan ".$data['slipgaji']->row('bulan')." ".$data['slipgaji']->row('tahun'),
		            'HTMLPart' => $slip_html
		        ]
		    ]
			];
			// Resources are all located in the Resources class
		$response = $mj->post(Resources::$Email, ['body' => $body]);
		if ($response->success())
		  $message[] = array(
				'code'=>200,
				'message'=>'Email berhasil dikirim.'
			);
		else
		  $message[] = array(
				'code'=>404,
				'message'=>'Email tidak terkirim.'
			);
		
		$this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($message));
	}
}
