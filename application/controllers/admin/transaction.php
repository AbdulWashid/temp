<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	class transaction extends CI_Controller{
		public function __construct() {
            parent::__construct();
			date_default_timezone_set('Asia/Kolkata');
            $user = $this->session->userdata('user');
            if (!isset($user)) { 
                redirect('admin/login');
            } 
        }

        public function index(){ 
            $data['customer_list'] = $this->db->select('*')->from('customer_tbl')->get()->result_array();
            // print_r($data['customer_list']);die();
            $this->load->view('admin/header');
            $this->load->view('admin/transaction',$data);
        }

        public function get_report(){
            $customer_id = $this->input->post('customer_id');
            $from_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');

            

            // Start building the query
            $this->db->select('transaction.*,IF(transaction.driver_id = 0, "Admin", driver_tbl.driver_name) AS driver_name'); //IF(transaction.driver_id = 0, "Admin", driver_tbl.driver_name) AS driver_name'
            $this->db->from('transaction'); 
            $this->db->join('driver_tbl', 'transaction.driver_id = driver_tbl.driver_id', 'left');

            // Add filters only if fields are filled
            if (!empty($customer_id)) {
                $this->db->where('customer_id', $customer_id);
            }

            if (!empty($from_date)) {
                $this->db->where('date >=', $from_date);
            }

            if (!empty($to_date)) {
                $this->db->where('date <=', $to_date);
            }

            // Run the query
            $query = $this->db->where('amount >',0);
            $query = $this->db->get();
            $result = $query->result();
           
            $html = '';
            $sn = 1;
            if (!empty($result)) {
                foreach ($result as $row) {
                    $html .= '<tr>';
                    $html .= '<td>' . $sn++ . '</td>';
                
                    // In amount with green color
                    if ($row->type == 'in') {
                        $html .= '<td><span class="text text-success">' . htmlspecialchars($row->amount) . '</span></td>';
                        $html .= '<td>------</td>';
                    } 
                    // Out amount with red color
                    else if ($row->type == 'out') {
                        $html .= '<td>------</td>';
                        $html .= '<td><span class="text text-danger">' . htmlspecialchars($row->amount) . '</span></td>';
                    } 
                    else {
                        $html .= '<td>------</td><td>------</td>';
                    }
                
                    // Other fields
                    $html .= '<td>' . htmlspecialchars($row->balance) . '</td>';
                    $html .= '<td>' . htmlspecialchars(ucfirst($row->balance_status)) . '</td>';
                    $html .= '<td>' . htmlspecialchars($row->driver_name) . '</td>';
                    $html .= '<td>' . htmlspecialchars(date('d-m-Y',strtotime($row->date))) . '</td>';
                    $html .= '</tr>';
                }
            }else {
                $html .= '<tr>';
                $html .= '<td colspan="7" style="text-align:center;">No data found.</td>';
                $html .= '</tr>';
            }
            

            echo json_encode(['html' => $html]);
            exit;
        }
    }