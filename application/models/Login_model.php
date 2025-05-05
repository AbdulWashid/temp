<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Login_model extends CI_Model{
		public function checkUser($data){
			$this->db->select('*');
			$this->db->from('users_tbl');
			$this->db->where($data);
			$query = $this->db->get();
			if($query->num_rows() == 1){
				return $query->row_array();
			}else{
				return false;
			}
		}

		public function checkDriverLogin($data){
			$this->db->select('*');
			$this->db->from('driver_tbl');
			$this->db->where($data);
			$query = $this->db->get();
			if($query->num_rows() == 1){
				return $query->row_array();
			}else{
				return false;
			}
		}
	}
?>