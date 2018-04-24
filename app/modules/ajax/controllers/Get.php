<?php defined('BASEPATH') OR exit('');
/**
* 
*/
class Get extends CI_Controller
{
	
	function cekper($per=FALSE)
	{
		$periode = $this->my_lib->get_data('master_periode',array('id_periode'=>$per));
		if ($periode) {
			foreach ($periode as $row) {
				$data[] = array(
					'id'			=> $row->id_periode,
          'min'		=> $row->mulai,
          'max'    => $row->akhir
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

	function get_peg_by_unit($unit=FALSE)
	{
		$pegawai = $this->my_lib->get_data('data_pegawai',array('kode_unit'=>$unit));
		if ($pegawai) {
			foreach ($pegawai as $row) {
				$data[] = array(
					'id'	=> $row->id,
					'nip'	=> $row->nip,
					'nama'=> $row->nama
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
}