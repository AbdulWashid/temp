<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Area_model extends CI_Model{
		public function add($data){
            if(isset($data['area_id'])){
                $this->db->set($data)->where('area_id',$data['area_id'])->update('area_tbl');
            }else{
                $this->db->insert('area_tbl',$data);
            }
		} 
        public function getAreaList(){
            $res = $this->db->select('*')->from('area_tbl')->order_by('area_id','DESC')->get()->result_array();
            foreach($res as $k => $value){
                $nor = $this->db->select('customer_id')->from('customer_tbl')->where('area_id',$value['area_id'])->get()->num_rows();
                if($nor == 0){
                    $res[$k]['delete'] = 'Yes';
                }else{
                    $res[$k]['delete'] = 'No';
                }
            }
            return $res;
        }
        public function getEditArea($area_id){
            return $this->db->select('*')->from('area_tbl')->where('area_id',$area_id)->get()->row_array();
        }
        public function deleteArea($area_id){
            $nor = $this->db->select('customer_id')->from('customer_tbl')->where('area_id',$area_id)->get()->num_rows();
            if($nor == 0){
                $this->db->where('area_id',$area_id)->delete('area_tbl');
            }
            
        }
	}
?>