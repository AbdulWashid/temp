<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Expenses_model extends CI_Model{
		public function add($data){
            if(isset($data['exp_id'])){
                $this->db->set($data)->where('exp_id',$data['exp_id'])->update('expenses_tbl');
            }else{
                $this->db->insert('expenses_tbl',$data);
            }
		} 

        public function addExpenseHead($data){
            if(isset($data['eid'])){
                $this->db->set($data)->where('eid',$data['eid'])->update('expensehead_tbl');
            }else{
                $this->db->insert('expensehead_tbl',$data);
            }
        }

        public function deleteExpenses($exp_id){
            $this->db->where('exp_id',$exp_id)->delete('expenses_tbl');
        }

        public function deleteExpensesHead($eid){
            $this->db->where('eid',$eid)->delete('expensehead_tbl');
        }

        public function getExpenseEditRec($exp_id){
            return $this->db->select('*')->from('expenses_tbl')->where('exp_id',$exp_id)->get()->row_array();
        }

        public function getEditExpenseHead($eid){
            return $this->db->select('*')->from('expensehead_tbl')->where('eid',$eid)->get()->row_array();
        }

        public function getExpenseHeadList(){
            $res = $this->db->select('*')->from('expensehead_tbl')->order_by('eid','DESC')->get()->result_array();
            foreach($res as $k => $value){
                $nor = $this->db->select('exp_id')->from('expenses_tbl')->where('head_id',$value['eid'])->get()->num_rows();
                if($nor == 0){
                    $res[$k]['delete'] = 'Yes';
                }else{
                    $res[$k]['delete'] = 'No';
                }
            }
            return $res;
        }

        function make_expenses_query($from_date,$to_date)  
        {  
            $this->db->select('expenses_tbl.*,expensehead_tbl.head_name');
            $this->db->from('expenses_tbl');
            $this->db->join('expensehead_tbl','expenses_tbl.head_id=expensehead_tbl.eid');
            if($from_date != '' && $to_date != ''){
                $this->db->where('expenses_tbl.exp_date BETWEEN "'. date('Y-m-d', strtotime($from_date)). '" and "'. date('Y-m-d', strtotime($to_date)).'"');
            }
            if($_POST["search"]["value"] != '')  
            {  
                $this->db->like("expenses_tbl.detail", $_POST["search"]["value"]);
                $this->db->or_like("expensehead_tbl.head_name", $_POST["search"]["value"]);
            }  
            if(isset($_POST["order"]))  
            {  
                $this->db->order_by('expenses_tbl.exp_id', $_POST['order']['0']['dir']);  
            }  
            else  
            {  
                $this->db->order_by('expenses_tbl.exp_id', 'DESC');  
            }  
        }
        function make_expenses_datatables($from_date,$to_date){  
            $this->make_expenses_query($from_date,$to_date);  
            if($_POST["length"] != -1)  
            {  
                $this->db->limit($_POST['length'], $_POST['start']);  
            }  
            $query = $this->db->get();  
            return $query->result();  
        }
        function get_expenses_filtered_data($from_date,$to_date){  
            $this->make_expenses_query($from_date,$to_date);
            $query = $this->db->get();  
            return $query->num_rows();  
        }
        
        function get_expenses_all_data($from_date,$to_date)  
        {  
            $this->make_expenses_query($from_date,$to_date);
            return $this->db->count_all_results();  
        }
	}
?>