<?php defined('BASEPATH') OR exit('');
/**
* 
*/
class Mutasi_pegawai extends CI_Controller
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
		$data['datatables'] = 'yes';
		$data['javascript'] = $this->load->view('pegawai/mutasi-pegawai-js',$data,true);
		$this->load->view('pegawai/mutasi-pegawai',$data);
	}

	function cek($id=FALSE)
	{
		$peg = $this->my_lib->get_data('data_pegawai',array('id'=>$id));
		if ($peg) {
			foreach ($peg as $row) {
				$unit = field_value('master_unit_kerja','kode_unit',$row->kode_unit,'nama_unit');
				$jab = field_value('master_jabatan','kode_jabatan',$row->kode_jabatan,'nama_jabatan');
				$data[] = array(
					'code'	=> '200',
          'id'      => $row->id,
          'nip'		=> $row->nip,
          'nama'    => $row->nama,
          'dep'			=> $row->departemen,
          'unit'	=> $unit,
          'jab'		=> $jab
        );
			}
		}
		else {
			$data = array('code'=>'404','message'=>'Tidak ditemukan...');
		}

		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
	}

	function mutasi()
	{
		$id = $this->input->post('pegawai');
		$unit = $this->input->post('unit');
		$jab	= $this->input->post('jabatan2');

		$jab_before = field_value('data_pegawai','id',$id,'kode_jabatan');
		$cek_jab_before = field_value('master_jabatan','kode_jabatan',$jab_before,'max_satu');
		if ($cek_jab_before == 'ya') {
			$this->my_lib->edit_row('master_jabatan',array('tersedia'=>'ya'),array('kode_jabatan'=>$jab_before));
		}
		
		$param = array(
			'id'	=> $id
		);
		$val = array(
			'kode_unit'	=> $unit,
			'kode_jabatan' => $jab
		);

		$edit = $this->my_lib->edit_row('data_pegawai',$val,$param);
		

		$cek_jab = field_value('master_jabatan','kode_jabatan',$jab,'max_satu');
		if ($cek_jab == 'ya') {
			$this->my_lib->edit_row('master_jabatan',array('tersedia'=>'tidak'),array('kode_jabatan'=>$jab));
		}
		if ($edit) {
			$nama = field_value('data_pegawai','id',$id,'nama');
			$alert_type = "success";
      $alert_title = $nama." berhasil di mutasi";
			set_header_message($alert_type,'Mutasi Pegawai',$alert_title);
			redirect(sdm().'mutasi_pegawai');
		}
	}
}