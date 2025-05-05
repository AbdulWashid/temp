<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Driver_model extends CI_Model{
		public function add($data){
            if(isset($data['driver_id'])){
                $this->db->set($data)->where('driver_id',$data['driver_id'])->update('driver_tbl');
            }else{
                $this->db->insert('driver_tbl',$data);
            }
		}
        
        public function getDriverList(){
            $res = $this->db->select('*')->from('driver_tbl')->order_by('driver_id','DESC')->get()->result_array();
            foreach($res as $k => $value){
                $nor = $this->db->select('customer_id')->from('supply_tbl')->where('driver_id',$value['driver_id'])->get()->num_rows();
                if($nor == 0){
                    $res[$k]['delete'] = 'Yes';
                }else{
                    $res[$k]['delete'] = 'No';
                }
            }
            return $res;
        }

        public function getEditDriverRec($driver_id){
            return $this->db->select('*')->from('driver_tbl')->where('driver_id',$driver_id)->get()->row_array();
        }
        

        public function deleteDriver($driver_id){
            $nor = $this->db->select('customer_id')->from('supply_tbl')->where('driver_id',$driver_id)->get()->num_rows();
            if($nor == 0){
                $row = $this->db->select('driver_image')->from('driver_tbl')->where('driver_id',$driver_id)->get()->row_array();
                if($row['driver_image'] != ''){
                    unlink('uploads/driver/'.$row['driver_image']);
                }
                $this->db->where('driver_id',$driver_id)->delete('driver_tbl');
            }
            
        }
	}
?>