<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Customer_model extends CI_Model{
		public function add($data){
			$this->db->insert('customer_tbl',$data);
            $insert_id = $this->db->insert_id();
            $unique_id = date('Ymd').$insert_id;
            $this->db->set('unique_id',$unique_id)->where('customer_id',$insert_id)->update('customer_tbl');
		}

        public function getCustomerList(){
            $this->db->select('customer_tbl.*,area_tbl.area_name,driver_tbl.driver_name');
            $this->db->from('customer_tbl');
            $this->db->join('area_tbl','customer_tbl.area_id=area_tbl.area_id');
            $this->db->join('driver_tbl','customer_tbl.driver_id=driver_tbl.driver_id','left');
            $this->db->order_by('customer_tbl.customer_id','DESC');
            $query = $this->db->get();
            $res = $query->result_array();
            foreach($res as $k => $value){
                $nor = $this->db->select('customer_id')->from('supply_tbl')->where('customer_id',$value['customer_id'])->get()->num_rows();
                if($nor == 0){
                    $res[$k]['delete'] = 'Yes';
                }else{
                    $res[$k]['delete'] = 'No';
                }
            }
            return $res;
        }

        public function edit($data){
            $this->db->set($data)->where('customer_id',$data['customer_id'])->update('customer_tbl');
        }

        public function getEditCustomerRec($customer_id){
            return $this->db->select('*')->from('customer_tbl')->where('customer_id',$customer_id)->get()->row_array();
        }

        public function deleteCustomer($customer_id){
            $nor = $this->db->select('customer_id')->from('supply_tbl')->where('customer_id',$customer_id)->get()->num_rows();
            if($nor == 0){
                $this->db->where('customer_id',$customer_id)->delete('customer_tbl');
            }
            
        }
	}
?>