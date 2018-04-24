<?php
/**
* 
*/
class M_user extends CI_Model
{
	function get_user_by_username($username){
    $q = $this->db->query("select * from data_pegawai where username='$username'");
    if($q->num_rows()==1) return $q;else return false;
  }
}