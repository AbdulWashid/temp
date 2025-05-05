<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Dashboard extends CI_Controller{
		public function __construct() {
            parent::__construct();
			date_default_timezone_set('Asia/Kolkata');
            $user = $this->session->userdata('user');
            if (!isset($user)) { 
                redirect('admin/login');
            } 
        }
		public function index(){
			$data['customerCount'] = $this->db->count_all_results('customer_tbl');
			$data['driverCount'] = $this->db->count_all_results('driver_tbl');
			$data['totalTankiBhari'] = $this->db->select_sum('tanki_bhari')->from('supply_tbl')->where('supply_date',date('Y-m-d'))->get()->row()->tanki_bhari;
			$data['totalTankiKhali'] = $this->db->select_sum('tanki_khali')->from('supply_tbl')->where('supply_date',date('Y-m-d'))->get()->row()->tanki_khali;
			$data['totalKaneStock'] = $this->db->select_sum('kane_stock')->from('customer_tbl')->get()->row()->kane_stock;
			$data['totalDueAmount'] = $this->db->select_sum('due_amount')->from('customer_tbl')->get()->row()->due_amount;
			$data['totalDueOffline'] = $this->db->select_sum('total_amount')->from('offlinesupplytotal_tbl')->where(array('pay_status'=>'0','supply_date'=>date('Y-m-d')))->get()->row()->total_amount;
			$data['totatCollection'] = $this->db->select_sum('collect_amount')->from('collection_tbl')->get()->row()->collect_amount;
			$data['totalExpenses'] = $this->db->select_sum('amount')->from('expenses_tbl')->get()->row()->amount;
			$data['totayCollection'] = $this->db->select_sum('collect_amount')->from('collection_tbl')->where('collect_date',date('Y-m-d'))->get()->row()->collect_amount;
			$data['todayExpenses'] = $this->db->select_sum('amount')->from('expenses_tbl')->where('exp_date',date('Y-m-d'))->get()->row()->amount;
			$this->load->view('admin/header');
			$this->load->view('admin/dashboard',$data);
		}
		
	}

?>