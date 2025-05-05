<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	class App_model extends CI_Model{
		public function checkCustomerByArea($area_id){
            return $this->db->select('customer_id')->from('customer_tbl')->where('area_id',$area_id)->get()->num_rows();
        }
        public function getAreaNameById($area_id){
            return $this->db->select('area_name')->from('area_tbl')->where('area_id',$area_id)->get()->row_array();
        }
        public function getSuppliedCustomerByAreaId($area_id){
            $this->db->select('customer_tbl.customer_id,customer_name,mobileno,due_amount,kane_stock');
            $this->db->from('customer_tbl');
            $this->db->where('status','1');
            $this->db->where('area_id',$area_id);
            $this->db->order_by('customer_name',"ASC");
            $query = $this->db->get();
            return $query->result_array();
        }

        public function getDeliveryByDriver($driver_id){
            $this->db->select('supply_tbl.tanki_bhari,supply_tbl.tanki_khali,supply_tbl.stock,supply_tbl.supply_date,customer_tbl.customer_id,customer_tbl.customer_name');
            $this->db->from('supply_tbl');
            $this->db->join('customer_tbl','supply_tbl.customer_id=customer_tbl.customer_id');
            $this->db->where(array('supply_tbl.driver_id'=>$driver_id,'supply_tbl.supply_date'=>date('Y-m-d')));
            $query = $this->db->get();
            return $query->result_array();
        }

        public function checkSupplied($customer_id,$date)
        {
            $nor = $this->db->select('customer_id')->from('supply_tbl')->where(array('customer_id'=>$customer_id,'supply_date'=>$date))->get()->num_rows();
            if($nor != 0){
                return true;
            }else{
                return false;
            }
        }

        public function getCustomerReportByDate($customer_id,$from_date,$to_date){
            $this->db->select('*');
            $this->db->from('supply_tbl');
            $this->db->where('customer_id',$customer_id);
            if($from_date != '' && $to_date != ''){
                $this->db->where('supply_date BETWEEN "'.date('Y-m-d',strtotime($from_date)). '" and "'.date('Y-m-d',strtotime($to_date)).'"');
            }
            $query = $this->db->get();
            return $query->result_array();
        }

        public function getOfflineSupplyReportByDate($driver_id,$from_date,$to_date){
            $this->db->select('*');
            $this->db->from('offlinesupply_tbl');
            $this->db->where('driver_id',$driver_id);
            if($from_date != '' && $to_date != ''){
                $this->db->where('supply_date BETWEEN "'.date('Y-m-d',strtotime($from_date)). '" and "'.date('Y-m-d',strtotime($to_date)).'"');
            }
            $query = $this->db->get();
            return $query->result_array();
        }

        public function getCustomerAddedByDriver($driver_id){
            $this->db->select('customer_tbl.*,area_tbl.area_name');
            $this->db->from('customer_tbl');
            $this->db->join('area_tbl','customer_tbl.area_id=area_tbl.area_id');
            $this->db->where('customer_tbl.driver_id',$driver_id);
            $this->db->order_by('customer_tbl.customer_id','DESC');
            $query = $this->db->get();
            return $query->result_array();
        }

        public function addOfflineSupply($data){
            $this->db->insert('offlinesupply_tbl',$data);
        }

	}
?>