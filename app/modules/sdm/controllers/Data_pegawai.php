<?php defined('BASEPATH') OR exit('');
/**
* 
*/
class Data_pegawai extends CI_Controller
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
		$join1 = 'data_pegawai.nip = data_pegawai_detail.nip';
		$join2 = 'data_pegawai.kode_unit = master_unit_kerja.kode_unit';
		$data['pegawai'] = $this->my_lib->get_data_join_triple('data_pegawai','data_pegawai_detail','master_unit_kerja',$join1,$join2);
		$data['datatables'] = 'yes';
		$data['javascript'] = $this->load->view('pegawai/data-pegawai-js',$data,true);
		$this->load->view('pegawai/data-pegawai',$data);
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