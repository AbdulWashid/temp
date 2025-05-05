<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Report_model extends CI_Model{
		/* Online Supply Report Start */
	
		function make_report_query($customer_id,$from_date,$to_date)  
		{  
			$this->db->select('supply_tbl.*,customer_tbl.customer_name');
			$this->db->from('supply_tbl');
			$this->db->join('customer_tbl', 'supply_tbl.customer_id = customer_tbl.customer_id');
			if($customer_id != ''){
				$this->db->where('supply_tbl.customer_id',$customer_id);
			}
			if($from_date != '' && $to_date != ''){
				$this->db->where('supply_tbl.supply_date BETWEEN "'. date('Y-m-d', strtotime($from_date)). '" and "'. date('Y-m-d', strtotime($to_date)).'"');
			}
			if($_POST["search"]["value"] != '')  
			{  
				$this->db->like("customer_tbl.customer_name", $_POST["search"]["value"]);
				
			}  
			if(isset($_POST["order"]))  
			{  
				$this->db->order_by('supply_tbl.supply_id', $_POST['order']['0']['dir']);  
			}  
			else  
			{  
				$this->db->order_by('supply_tbl.supply_id', 'DESC');  
			}  
		}
		function make_report_datatables($customer_id,$from_date,$to_date){  
			$this->make_report_query($customer_id,$from_date,$to_date);  
			if($_POST["length"] != -1)  
			{  
				$this->db->limit($_POST['length'], $_POST['start']);  
			}  
			$query = $this->db->get();  
			return $query->result();  
		}
		function get_report_filtered_data($customer_id,$from_date,$to_date){  
			$this->make_report_query($customer_id,$from_date,$to_date);
			$query = $this->db->get();  
			return $query->num_rows();  
		}
		
		function get_report_all_data($customer_id,$from_date,$to_date)  
		{  
			$this->make_report_query($customer_id,$from_date,$to_date);
			return $this->db->count_all_results();  
		}
		
		/* Online Supply Report End */

		/* Offline Supply Report Start */
		function make_offlinereport_query($from_date,$to_date)  
		{  
			$this->db->select('offlinesupplytotal_tbl.*,driver_tbl.driver_name');
			$this->db->from('offlinesupplytotal_tbl');
			$this->db->join('driver_tbl', 'offlinesupplytotal_tbl.driver_id = driver_tbl.driver_id');
			if($from_date != '' && $to_date != ''){
				$this->db->where('offlinesupplytotal_tbl.supply_date BETWEEN "'. date('Y-m-d', strtotime($from_date)). '" and "'. date('Y-m-d', strtotime($to_date)).'"');
			}
			if($_POST["search"]["value"] != '')  
			{  
				$this->db->like("driver_tbl.driver_name", $_POST["search"]["value"]);
				
			}  
			if(isset($_POST["order"]))  
			{  
				$this->db->order_by('offlinesupplytotal_tbl.stid', $_POST['order']['0']['dir']);  
			}  
			else  
			{  
				$this->db->order_by('offlinesupplytotal_tbl.stid', 'DESC');  
			}  
		}
		function make_offlinereport_datatables($from_date,$to_date){  
			$this->make_offlinereport_query($from_date,$to_date);  
			if($_POST["length"] != -1)  
			{  
				$this->db->limit($_POST['length'], $_POST['start']);  
			}  
			$query = $this->db->get();  
			return $query->result();  
		}
		function get_offlinereport_filtered_data($from_date,$to_date){  
			$this->make_offlinereport_query($from_date,$to_date);
			$query = $this->db->get();  
			return $query->num_rows();  
		}
		
		function get_offlinereport_all_data($from_date,$to_date)  
		{  
			$this->make_offlinereport_query($from_date,$to_date);
			return $this->db->count_all_results();  
		}
		/* Offline Supply Report Start */

		function getCustomerSupplyDetail($customer_id){
			$this->db->select('*');
			$this->db->from('supplymore_tbl');
			$this->db->where('customer_id',$customer_id);
			$this->db->order_by('supply_date','ASC');
			$query = $this->db->get();
            return $query->result_array();
		}

	}
?>