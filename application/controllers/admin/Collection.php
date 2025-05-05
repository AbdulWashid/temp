<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Collection extends CI_Controller{
		public function __construct() {
            parent::__construct();
            date_default_timezone_set('Asia/Kolkata');
            $user = $this->session->userdata('user');
            if (!isset($user)) { 
                redirect('admin/login');
            } 
        }

		public function add(){
			$this->form_validation->set_rules('customer_id','Customer','trim|required');
			$this->form_validation->set_rules('collect_amount','Collect Amount','trim|required');
			if($this->form_validation->run() == TRUE){
                $customer_id = $this->input->post('customer_id');
                $collect_amount = $this->input->post('collect_amount');
                $due = $this->db->select('due_amount')->from('customer_tbl')->where('customer_id',$customer_id)->get()->row_array();
                if($due['due_amount'] >= $collect_amount){
                    $due_amount = $due['due_amount'] - $collect_amount;
                    $data = array(
                        'customer_id' => $this->input->post('customer_id'),
                        'collect_amount' => $this->input->post('collect_amount'),
                        'balance' => $due_amount,
                        'collect_date' => date('Y-m-d')
                    );
                    //  ======================= Transaction Details =======================
                        $trans_date = date('Y-m-d');

                        $in = $this->db->get_where('transaction', [
                            'customer_id' => $customer_id,
                            'date' => $trans_date,
                            'type' => 'in'
                        ])->row_array();
                        
                        if(empty($in)) {
                            $lastTrans = $this->db->select('balance, balance_status,amount')
                                                ->from('transaction')
                                                ->where('customer_id', $customer_id)
                                                ->order_by('id', 'DESC')
                                                ->limit(1)
                                                ->get()
                                                ->row_array();

                            $in_balance_old = isset($lastTrans['balance']) ? $lastTrans['balance'] : 0;
                            $in_status_old = isset($lastTrans['balance_status']) ? $lastTrans['balance_status'] : 'clear';
                            $in_amount_old = 0;
                            $this->db->insert('transaction', array(
                                'customer_id' => $customer_id,
                                'driver_id' => 0,
                                'type' => 'out',
                                'amount' => $in_amount_old,
                                'balance' => $in_balance_old,
                                'balance_status' => $in_status_old,
                                'date' => date('Y-m-d')
                            ));
                            $this->db->insert('transaction', array(
                                'customer_id' => $customer_id,
                                'driver_id' => 0,
                                'type' => 'in',
                                'amount' => $in_amount_old,
                                'balance' => $in_balance_old,
                                'balance_status' => $in_status_old,
                                'date' => date('Y-m-d')
                            ));
                            $insert_id = $this->db->insert_id();

                            $in = $this->db->select('*')
                                            ->from('transaction')
                                            ->where('id', $insert_id)                
                                            ->get()
                                            ->row_array();
                            // $in = $this->db->get_where('transaction', [
                            //                 'customer_id' => $customer_id,
                            //                 'date' => $trans_date,
                            //                 'type' => 'in'
                            //             ])->row_array();
                        }else{
                            $in_amount_old = isset($in['amount']) ? $in['amount'] : 0;
                            $in_balance_old = isset($in['balance']) ? $in['balance'] : 0;
                            $in_status_old = isset($in['balance_status']) ? $in['balance_status'] : 'clear';
                        }
                            
                        if(!empty($collect_amount) && $collect_amount > 0){
                            if ($in_status_old == 'overpaid' || $in_status_old == 'clear') {
                                $balance_in = $in_balance_old + $collect_amount;
                                $status_in = 'overpaid';
                            } elseif ($in_status_old == 'pending') {
                                if ($collect_amount > $in_balance_old) {
                                    $balance_in = $collect_amount - $in_balance_old;
                                    $status_in = 'overpaid';
                                } elseif ($collect_amount == $in_balance_old) {
                                    $balance_in = 0;
                                    $status_in = 'clear';
                                } else {
                                    $balance_in = $in_balance_old - $collect_amount;
                                    $status_in = 'pending';
                                }
                            }

                            $this->db->where('id', $in['id'])->update('transaction', [
                                'balance' => $balance_in,
                                'balance_status' => $status_in,
                                'amount' => $collect_amount + $in_amount_old
                            ]);
                            
                        }
                    //  ======================= Transaction Details =======================

                    $this->collection_model->add($data);
                    $this->db->set('due_amount',$due_amount)->where('customer_id',$customer_id)->update('customer_tbl');
                    $this->session->set_flashdata('msg','<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Payment Collect Successfully.</div>');
                    redirect('admin/collection/add');
                }else{
                    $this->session->set_flashdata('msg','<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Collected Amount Greater than due amount.</div>');
				    redirect('admin/collection/add');
                }
                
			}else{
				$data['customer_list'] = $this->customer_model->getCustomerList();
				$this->load->view('admin/header');
				$this->load->view('admin/add-collection',$data);
			}
			
		}

        public function list(){
            $data['getCollectionReport'] = [];
            $this->form_validation->set_rules('from_date','From Date','trim|required');
		    $this->form_validation->set_rules('to_date','To Date','trim|required');
            if($this->form_validation->run() == TRUE){
                $data['customer_id'] = $this->input->post('customer_id');
                $data['from_date'] = $this->input->post('from_date');
                $data['to_date'] = $this->input->post('to_date');
            }else{
                $data['customer_id'] = '';
                $data['from_date'] = date('Y-m-d');
                $data['to_date'] = date('Y-m-d');
            }
            $data['customer_list'] = $this->customer_model->getCustomerList();
            
            $this->load->view('admin/header');
            $this->load->view('admin/collection-list',$data);
        }

        public function getCollectionReport(){
            $customer_id = $this->input->post('customer_id');
            $from_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            $fetch_data = $this->collection_model->make_collection_datatables($customer_id,$from_date,$to_date);  
            $data = array();  
            
            $i = 1;
            foreach($fetch_data as $row)  
            {  
                if($row->driver_name != ''){
                    $driver = $row->driver_name;
                }else{
                    $driver = 'Admin';
                }
                $sub_array = array();  
                $sub_array[] = $i;
                $sub_array[] = $row->customer_name; 
                $sub_array[] = $row->collect_amount; 
                $sub_array[] = $driver;
                $sub_array[] = date('d-m-Y',strtotime($row->collect_date));
                $sub_array[] = '<a href="'.$row->collect_id.'" class="btn btn-primary btn-sm printReceipt">Print</a>';
                $data[] = $sub_array;
                $i++;
            }  
            $output = array(  
                "draw" => intval($_POST["draw"]),  
                "recordsTotal" => $this->collection_model->get_collection_all_data($customer_id,$from_date,$to_date),  
                "recordsFiltered"=>$this->collection_model->get_collection_filtered_data($customer_id,$from_date,$to_date),  
                "data"=>$data  
            );  
            echo json_encode($output);
        }

		public function getCustomerDue(){
			$customer_id = $this->input->post('customer_id');
			$data = $this->db->select('due_amount')->from('customer_tbl')->where('customer_id',$customer_id)->get()->row_array();
			$arr = array(
				'status' => 200,
				'data' => $data
			);
			$this->output->set_content_type('application/json')->set_output(json_encode($arr));
		}

        public function print(){
			$collect_id = $this->input->post('collect_id');
			$data['receipt'] = $this->db->select('collection_tbl.*,customer_tbl.customer_name,customer_tbl.mobileno,customer_tbl.address')->from('collection_tbl')->join('customer_tbl','collection_tbl.customer_id=customer_tbl.customer_id')->where('collection_tbl.collect_id',$collect_id)->get()->row_array();
		    $this->load->view('admin/print',$data);
		}
		
	}
?>