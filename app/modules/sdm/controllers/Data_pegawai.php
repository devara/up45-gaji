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
