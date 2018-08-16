<?php
/**
* 
*/
class M_slip extends CI_Model
{
	function detail_slip($slip){
		$this->db->select('*');
		$this->db->from('data_slip_gaji');
		$this->db->join('data_pegawai','data_slip_gaji.nip = data_pegawai.nip');
		$this->db->join('master_periode','data_slip_gaji.id_periode = master_periode.id_periode');
		$this->db->where('data_slip_gaji.id_slip_gaji',$slip);
		$result=$this->db->get();
		if($result->num_rows() > 0){
			return $result;
		}else{
			return null;
		}
	}
}
