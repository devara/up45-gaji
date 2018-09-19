<?php defined('BASEPATH') OR exit('');
/**
* 
*/
class Get extends CI_Controller
{
	
	function cekper($per=FALSE)
	{
		$periode = $this->my_lib->get_data_row('master_periode',array('id_periode'=>$per));
		if ($periode) {
				$data[] = array(
					'code'	=> '200',
					'id'		=> $periode->row('id_periode'),
          'min'		=> $periode->row('mulai'),
          'max'   => $periode->row('akhir')
        );
		}
		else {
			$data[] = array('code'=>'404','message'=>'Tidak ditemukan...');
		}
		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
	}

	function get_peg_by_unit($unit=FALSE)
	{
		$pegawai = $this->my_lib->get_data('data_pegawai',array('kode_unit'=>$unit));
		if ($pegawai) {
			foreach ($pegawai as $row) {
				$data[] = array(
					'nip'	=> $row->nip,
					'nama'=> $row->nama
				);
			}
		}
		else{
			$data[] = array('code'=>'404','message'=>'Data tidak ditemukan...');
		}
		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
	}

	function get_pegawai_by_nip()
	{
		$nip = $this->input->post('nip');
		$get_pegawai = $this->my_lib->get_data('data_pegawai');
		foreach ($get_pegawai as $row) {
			$cari  = array('/', '.');
			$nip_pegawai = str_replace($cari, '', $row->nip);
			if ($nip == $nip_pegawai) {
				$hasil[] = 1;
				$nip_hasil = $row->nip;
				$nama = $row->nama;
			}
			else{
				$hasil[] = 0;
			}
		}
		if (array_sum($hasil) == 1) {
			$data[] = array(
					'code'=> 200,
					'nip'=> $nip_hasil,
					'nama'=> $nama
				);
		}
		else{
			$data[] = array('code'=>'404','message'=>'Data tidak ditemukan...');
		}
		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
	}

	function get_pegawai_by_nip2()
	{
		$nip = $this->input->post('nip');
		$get_pegawai = $this->my_lib->get_data('data_pegawai');
		foreach ($get_pegawai as $row) {
			$cari  = array('/', '.');
			$nip_pegawai = str_replace($cari, '', $row->nip);
		}
		$pegawai = $this->my_lib->get_data('data_pegawai',array('nip'=>$nip));
		if ($pegawai) {
			foreach ($pegawai as $row) {
				$data[] = array(
					'code'=> 200,
					'id'	=> $row->id,
					'nip'	=> $row->nip,
					'nama'=> $row->nama
				);
			}
		}
		else{
			$data[] = array('code'=>'404','message'=>'Data tidak ditemukan...');
		}
		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
	}
}
