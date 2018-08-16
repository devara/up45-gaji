<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @author Devara Eko
 * @copyright 2017 UP45 YK
 */

class My_lib {
	protected $CI;

	function __construct()
	{
		$this->CI=& get_instance();
		$this->CI->load->database();
	}

	function noTable(){
		die('Gunakan nama table terlebih dahulu pada parameter');
	}

	function add_row($table,$data=array()){

		if(empty($table)){
			$this->noTable();
		}else{
			if(!empty($data))
			{
				$this->CI->db->insert($table,$data);
				if($this->CI->db->affected_rows()>0){
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}
	}

	function edit_row($table,$data=array(),$where=array()){
		if(empty($table)){
			$this->noTable();
		}else{
			if(!empty($where)){
				$this->CI->db->where($where);
			}

			if(!empty($data))
			{
				$this->CI->db->update($table,$data);
				if($this->CI->db->affected_rows()>-1){
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}
	}

	function delete_row($table,$where=array()){
		if(empty($table)){
			$this->noTable();
		}else{
			if(!empty($where)){
				$this->CI->db->where($where);
			}

			$this->CI->db->delete($table);
			if($this->CI->db->affected_rows() > 0){
				return true;
			}else{
				return false;
			}

		}
	}

	function row_count($table,$where=array()){
		if(empty($table)){
			$this->noTable();
		}else{
			if(!empty($where)){
				$this->CI->db->where($where);
			}
			$sql = $this->CI->db->get($table);
			$count=$sql->num_rows();
			return $count;
		}
	}

	function row_count_like($table,$like=array()){
		if(empty($table)){
			$this->noTable();
		}else{
			if(!empty($like)){
				$this->CI->db->like($like);
			}
			$sql = $this->CI->db->get($table);
			$count=$sql->num_rows();
			return $count;
		}
	}

	function get_row($table,$where=array(),$field,$order=array()){
		if(empty($table)){
			$this->noTable();
		}else{
			if(!empty($order)){
				$this->CI->db->order_by($order);
			}
			if(!empty($where)){
				$this->CI->db->where($where);
			}
			$sql = $this->CI->db->get($table);
			if($sql->num_rows() > 0){
				return $sql->row()->$field;
			} else {
				return "";
			}
		}
	}

	function get_sum_row($table,$where=array(),$field){
		if(empty($table)){
			$this->noTable();
		}else{
			if(!empty($where)){
				$this->CI->db->where($where);
			}
			$this->CI->db->select_sum($field);
			$sql = $this->CI->db->get($table);
			if($sql->num_rows() > 0){
				return $sql->row()->$field;
			} else {
				return 0;
			}
		}
	}

	function get_data($table,$where=array(),$order='',$group='',$limit=null,$start=null){


		if(!empty($table))	{
			if(!empty($where)){
				$this->CI->db->where($where);
			}

			if(!empty($order)){
				$this->CI->db->order_by($order);
			}

			if(!empty($group)){
				$this->CI->db->group_by($group);
			}

			if(!empty($limit)){
				$this->CI->db->limit($limit,$start);
			}

			$result=$this->CI->db->get($table);
			if($result->num_rows() > 0){
				return $result->result();
			}else{
				return null;
			}
		}else{
			$this->noTable();
		}
	}

	function get_data_row($table,$where=array(),$order='',$group='',$limit=null,$start=null){


		if(!empty($table))	{
			if(!empty($where)){
				$this->CI->db->where($where);
			}

			if(!empty($order)){
				$this->CI->db->order_by($order);
			}

			if(!empty($group)){
				$this->CI->db->group_by($group);
			}

			if(!empty($limit)){
				$this->CI->db->limit($limit,$start);
			}

			$result=$this->CI->db->get($table);
			if($result->num_rows() > 0){
				return $result;
			}else{
				return null;
			}
		}else{
			$this->noTable();
		}
	}

	function get_data_join($table1,$table2,$where=array(),$join,$order=''){


		if(!empty($table1) && !empty($table2))	{
			
			$this->CI->db->select('*');
			$this->CI->db->from($table1);
			$this->CI->db->join($table2,$join);
			if(!empty($where)){
				$this->CI->db->where($where);
			}
			if(!empty($order)){
				$this->CI->db->order_by($order);
			}
						
			$result=$this->CI->db->get();
			if($result->num_rows() > 0){
				return $result->result();
			}else{
				return null;
			}
		}else{
			$this->noTable();
		}
	}

	function get_data_join_triple($table1,$table2,$table3,$join1,$join2,$where=array()){


		if(!empty($table1) && !empty($table2))	{
			
			$this->CI->db->select('*');
			$this->CI->db->from($table1);
			$this->CI->db->join($table2,$join1);
			$this->CI->db->join($table3,$join2);
			if(!empty($where)){
				$this->CI->db->where($where);
			}
						
			$result=$this->CI->db->get();
			if($result->num_rows() > 0){
				return $result->result();
			}else{
				return null;
			}
		}else{
			$this->noTable();
		}
	}

	function get_data_join_quad($table1,$table2,$table3,$table4,$join1,$join2,$join3,$where=array()){

		if(!empty($table1) && !empty($table2))	{
			
			$this->CI->db->select('*');
			$this->CI->db->from($table1);
			$this->CI->db->join($table2,$join1);
			$this->CI->db->join($table3,$join2);
			$this->CI->db->join($table4,$join3);
			if(!empty($where)){
				$this->CI->db->where($where);
			}
						
			$result=$this->CI->db->get();
			if($result->num_rows() > 0){
				return $result->result();
			}else{
				return null;
			}
		}else{
			$this->noTable();
		}
	}

	function search_data($table,$like=array(),$order='',$group='',$limit=null,$start=null){
		if(!empty($table))	{
			if(!empty($like)){
				$this->CI->db->like($like);
			}

			if(!empty($order)){
				$this->CI->db->order_by($order);
			}

			if(!empty($group)){
				$this->CI->db->group_by($group);
			}

			if(!empty($limit)){
				$this->CI->db->limit($limit,$start);
			}

			$result=$this->CI->db->get($table);
			if($result->num_rows() > 0){
				return $result->result();
			}else{
				return null;
			}
		}else{
			$this->noTable();
		}
	}

	function cek($table,$where=array()){
		if(empty($table)){
			$this->noTable();
		}else{
			if(!empty($where)){
				$this->CI->db->where($where);
			}

			$sql = $this->CI->db->get($table);
			if($sql->num_rows() > 0){
				return true;
			} else {
				return false;
			}
		}
	}

	function last_insert_id(){
		$id=$this->CI->db->insert_id();
		return $id;
	}
}
