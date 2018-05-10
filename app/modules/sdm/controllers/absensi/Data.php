<?php defined('BASEPATH') OR exit('');
/**
* 
*/
class Data extends CI_Controller
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
		$data['unit'] = $this->my_lib->get_data('master_unit_kerja');
		$data['datatables'] = 'yes';
		$data['javascript'] = $this->load->view('absensi/data-js',$data,true);
		$this->load->view('absensi/data',$data);
	}

	function pegawai($unit=FALSE)
	{
		$pegawai = $this->my_lib->get_data('data_pegawai',array('kode_unit'=>$unit));
		if ($pegawai) {
			foreach ($pegawai as $row) {
				$data[] = array(
					'code'	=> '200',
					'nip' => $row->nip,
					'nama' => $row->nama
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

	function tampil()
	{
		$this->form_validation->set_rules('per', 'Periode Kerja', 'required');
		$this->form_validation->set_rules('unit', 'Unit Kerja', 'required');
		if ($this->form_validation->run() == TRUE) {
			$per = $this->input->post('per');
			$unit = $this->input->post('unit');
			$nip = $this->input->post('nip');
			if ($nip == 'all') {
				$param = array(
					'id_periode'=>$per,
					'kode_unit'=>$unit
				);
				$join = 'absensi_data.nip = data_pegawai.nip';
				$data['absensi'] = $this->my_lib->get_data_join('absensi_data','data_pegawai',$param,$join);
				$data['jenis'] = 'multiple';
			}
			else{
				$param = array(
					'id_periode'=>$per,
					'nip'=>$nip
				);
				$data['periode'] = $this->my_lib->get_data('master_periode',array('id_periode'=>$per));
				$data['absensi'] = $this->my_lib->get_data('absensi_data',$param);
				$data['rekap'] = $this->my_lib->get_data('absensi_rekap',$param);
				$data['jenis'] = 'single';
				$data['pegawai'] = $this->my_lib->get_data('data_pegawai',array('nip'=>$nip));
				$data['nip'] = $nip;
				$data['id_per'] = $per;
			}
			$tabel = $this->load->view('absensi/data-tabel',$data,true);
			$message[] = array('code'=>200,'message'=>'Data Tersedia.','tabel'=>$tabel);
		}
		else{
			$message[] = array('code'=>404,'message' => validation_errors('<div class="error">', '</div>'));
		}

		$this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($message));
	}

	function absensi_pdf()
	{
		$periode = $_GET['per'];
		$nip = $_GET['nip'];
		$param = array(
					'id_periode'=>$periode,
					'nip'=>$nip
		);
		$data['periode'] = $this->my_lib->get_data('master_periode',array('id_periode'=>$periode));
		$data['absensi'] = $this->my_lib->get_data('absensi_data',$param);
		$data['rekap'] = $this->my_lib->get_data('absensi_rekap',$param);
		$data['pegawai'] = $this->my_lib->get_data('data_pegawai',array('nip'=>$nip));
		$pdf_content = $this->load->view('absensi/absensi-pdf',$data,true);
		$nama = field_value('data_pegawai','nip',$nip,'nama');
		$mpdf = new \Mpdf\Mpdf();
		$mpdf->WriteHTML($pdf_content);
		$mpdf->Output('Rekap Absensi '.$nama.'.pdf','D');
	}
}