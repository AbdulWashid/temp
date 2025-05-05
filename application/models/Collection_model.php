<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Collection_model extends CI_Model{
		public function add($data){
            $this->db->insert('collection_tbl',$data);
		}
        /*public function getCollectionList(){
            $this->db->select('collection_tbl.*,customer_tbl.customer_name');
            $this->db->from('collection_tbl');
            $this->db->join('customer_tbl','collection_tbl.customer_id=customer_tbl.customer_id');
            $this->db->order_by('collection_tbl.collect_id','DESC');
            $query = $this->db->get();
            return $query->result_array();
        }*/

        function make_collection_query($customer_id,$from_date,$to_date)  
        {  
            $this->db->select('collection_tbl.*,customer_tbl.customer_name,driver_tbl.driver_name');
            $this->db->from('collection_tbl');
            $this->db->join('customer_tbl','collection_tbl.customer_id=customer_tbl.customer_id');
            $this->db->join('driver_tbl','collection_tbl.driver_id=driver_tbl.driver_id','left');
            if($customer_id != ''){
                $this->db->where('collection_tbl.customer_id',$customer_id);
            }
            if($from_date != '' && $to_date != ''){
                $this->db->where('collection_tbl.collect_date BETWEEN "'. date('Y-m-d', strtotime($from_date)). '" and "'. date('Y-m-d', strtotime($to_date)).'"');
            }
            if($_POST["search"]["value"] != '')  
            {  
                $this->db->like("customer_tbl.customer_name", $_POST["search"]["value"]);
                
            }  
            if(isset($_POST["order"]))  
            {  
                $this->db->order_by('collection_tbl.collect_id', $_POST['order']['0']['dir']);  
            }  
            else  
            {  
                $this->db->order_by('collection_tbl.collect_id', 'DESC');  
            }  
        }
        function make_collection_datatables($customer_id,$from_date,$to_date){  
            $this->make_collection_query($customer_id,$from_date,$to_date);  
            if($_POST["length"] != -1)  
            {  
                $this->db->limit($_POST['length'], $_POST['start']);  
            }  
            $query = $this->db->get();  
            return $query->result();  
        }
        function get_collection_filtered_data($customer_id,$from_date,$to_date){  
            $this->make_collection_query($customer_id,$from_date,$to_date);
            $query = $this->db->get();  
            return $query->num_rows();  
        }
        
        function get_collection_all_data($customer_id,$from_date,$to_date)  
        {  
            $this->make_collection_query($customer_id,$from_date,$to_date);
            return $this->db->count_all_results();  
        }
            
    }
?>