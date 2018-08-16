<?php
/**
* 
*/
class M_pegawai extends CI_Model
{
	function detail_pegawai($nip){
		$this->db->select('*');
		$this->db->from('data_pegawai');
		$this->db->join('data_pegawai_detail','data_pegawai.nip = data_pegawai_detail.nip');
		$this->db->join('master_jam_kerja','data_pegawai.kode_jam_kerja = master_jam_kerja.kode_jam_kerja');

		$this->db->where('data_pegawai.nip',$nip);
		$result=$this->db->get();
		if($result->num_rows() > 0){
			return $result;
		}else{
			return null;
		}
	}
}
