<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Report extends CI_Controller{
		public function __construct() {
            parent::__construct();
            date_default_timezone_set('Asia/Kolkata');
            $user = $this->session->userdata('user');
            if (!isset($user)) { 
                redirect('admin/login');
            } 
        }
		
		public function list(){
            $data['getSupplyReport'] = [];
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
            $this->load->view('admin/report-list',$data);
		}

        public function getSupplyReport(){
            $customer_id = $this->input->post('customer_id');
            $from_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            $fetch_data = $this->report_model->make_report_datatables($customer_id,$from_date,$to_date);  
            $data = array();  
            
            $i = 1;
            foreach($fetch_data as $row)  
            {  
                
                $sub_array = array();  
                $sub_array[] = $i;
                $sub_array[] = $row->customer_name; 
                $sub_array[] = $row->tanki_bhari; 
                $sub_array[] = $row->tanki_khali;
                $sub_array[] = $row->stock; 
                $sub_array[] = $row->amount; 
                $sub_array[] = date('d-m-Y',strtotime($row->supply_date));
                $data[] = $sub_array;
                $i++;
            }  
            $output = array(  
                "draw" => intval($_POST["draw"]),  
                "recordsTotal" => $this->report_model->get_report_all_data($customer_id,$from_date,$to_date),  
                "recordsFiltered"=>$this->report_model->get_report_filtered_data($customer_id,$from_date,$to_date),  
                "data"=>$data  
            );  
            echo json_encode($output);
        }

        public function offlineSupplyReport(){
            $data['getOfflineSupplyReport'] = [];
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
			$this->load->view('admin/header');
            $this->load->view('admin/offline-supply-list',$data);
        }

        public function getOfflineSupplyReport(){
            $from_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            $fetch_data = $this->report_model->make_offlinereport_datatables($from_date,$to_date);  
            $data = array();  
            $return = "return confirm('Do You Really Want To Collect Payment ?')";
            $i = 1;
            foreach($fetch_data as $row)  
            {  
                if($row->pay_status == 0){
                    $pay_status = 'Pending';
                    $action = '<a href="'.base_url('admin/report/collectPayment/'.$row->driver_id.'/'.$row->supply_date).'" onclick="'.$return.'" class="btn btn-primary btn-sm" style="margin-right:10px;">Collect Payment</a><a href="'.base_url('admin/report/viewOfflineDetail/'.$row->driver_id.'/'.$row->supply_date).'" class="btn btn-success btn-sm">View Detail</a>';
                }else{
                    $pay_status = 'Collect';
                    $action = '<a href="'.base_url('admin/report/viewOfflineDetail/'.$row->driver_id.'/'.$row->supply_date).'" class="btn btn-success btn-sm" style="margin-right:10px;">View Detail</a>';
                }



                $sub_array = array();  
                $sub_array[] = $i;
                $sub_array[] = $row->driver_name; 
                $sub_array[] = $row->total_tanki; 
                $sub_array[] = $row->total_amount;
                $sub_array[] = $pay_status;  
                $sub_array[] = date('d-m-Y',strtotime($row->supply_date));
                $sub_array[] = $action;
                $data[] = $sub_array;
                $i++;
            }  
            $output = array(  
                "draw" => intval($_POST["draw"]),  
                "recordsTotal" => $this->report_model->get_offlinereport_all_data($from_date,$to_date),  
                "recordsFiltered"=>$this->report_model->get_offlinereport_filtered_data($from_date,$to_date),  
                "data"=>$data  
            );  
            echo json_encode($output);
        }

        public function collectPayment($driver_id,$supply_date){
            $this->db->set('pay_status','1')->where(array('driver_id'=>$driver_id,'supply_date'=>$supply_date))->update('offlinesupplytotal_tbl');
            $this->session->set_flashdata('msg','<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Payment Collected Successfully.</div>');
            redirect('admin/report/offlineSupplyReport');
        }

        public function viewOfflineDetail($driver_id,$supply_date){
            $data['supply_list'] = $this->db->select('offlinesupply_tbl.*,driver_tbl.driver_name')->from('offlinesupply_tbl')->join('driver_tbl','offlinesupply_tbl.driver_id=driver_tbl.driver_id')->where(array('offlinesupply_tbl.driver_id'=>$driver_id,'supply_date'=>$supply_date))->get()->result_array();
            $this->load->view('admin/header');
			$this->load->view('admin/offline-supply-detail',$data);
        }

        public function viewReceipt($customer_id,$from_date,$to_date){
            $nor = $this->db->select('rid')->from('receiptno_tbl')->get()->num_rows();
            if($nor == 0){
                $arr = array(
                    'receipt_no' => '1',
                    'customer_id' => $customer_id,
                    'from_date' => $from_date,
                    'to_date' => $to_date
                );
                $this->db->insert('receiptno_tbl',$arr);
            }else{
                $nor2 = $this->db->select('rid')->from('receiptno_tbl')->where(array('customer_id' => $customer_id,'from_date' => $from_date,'to_date' => $to_date))->get()->num_rows();
                if($nor2 == 0){
                    $rec = $this->db->select('receipt_no')->from('receiptno_tbl')->order_by('rid','DESC')->limit(1)->get()->row_array();
                    $receipt_no = $rec['receipt_no'] + 1;
                    $arr2 = array(
                        'receipt_no' => $receipt_no,
                        'customer_id' => $customer_id,
                        'from_date' => $from_date,
                        'to_date' => $to_date
                    );
                    $this->db->insert('receiptno_tbl',$arr2);
                }
                
            }
            $data['receipt'] = $this->db->select('receipt_no')->from('receiptno_tbl')->order_by('rid','DESC')->limit(1)->get()->row()->receipt_no;
            $data['customer'] = $this->db->select('customer_name,kane_charge,address')->from('customer_tbl')->where('customer_id',$customer_id)->get()->row_array();
            $data['totalBhariKane'] = $this->db->select_sum('tanki_bhari')->from('supply_tbl')->where('supply_date BETWEEN "'.$from_date. '" and "'.$to_date.'"')->where('customer_id',$customer_id)->get()->row()->tanki_bhari;
            $totalAMount = $data['totalBhariKane'] * $data['customer']['kane_charge'];
            $data['totalAMount'] = $totalAMount;
            $data['from_date'] = $from_date;
            $data['to_date'] = $to_date;
            $this->load->view('admin/receipt-print',$data);
        }

        public function customerReportEdit(){
            $data['customer_list'] = $this->customer_model->getCustomerList();
            $this->form_validation->set_rules('customer_id','Customer','trim|required');
            if($this->form_validation->run() == TRUE){
                $customer_id = $this->input->post('customer_id');
                $data['customer_id'] = $customer_id;
                $data['supply_list'] = $this->report_model->getCustomerSupplyDetail($customer_id);
                $this->load->view('admin/header');
                $this->load->view('admin/customer-report-edit',$data);
            }else{
                $data['customer_id'] = '';
                $data['supply_list'] = '';
                $this->load->view('admin/header');
                $this->load->view('admin/customer-report-edit',$data);
            }
        }

        public function reportUpdate(){
            $customer_id = $this->input->post('customer_id');
            $sid = $this->input->post('sid');
            $supply_date = $this->input->post('supply_date');
            $supplyDate = array_unique($supply_date); 
            // echo '<pre>';
            // var_dump($sid);
            // echo '</pre>';
            // die;
            $this->db->where('customer_id',$customer_id)->delete('collection_tbl');

            $kaneCharge = $this->db->select('kane_charge')->from('customer_tbl')->where('customer_id',$customer_id)->get()->row_array();
            $due = 0;
            $sumited = 0;
            
            foreach($sid as $k => $v){
                $supplyMdate = $this->input->post('supply_date'.$v);
                $arr = array(
                    'tanki_bhari' => $this->input->post('tanki_bhari'.$v),
                    'tanki_khali' => $this->input->post('tanki_khali'.$v),
                    'stock' => $this->input->post('stock'.$v),
                    'amount' => $this->input->post('amount'.$v)
                );
                $sumited = $sumited+$this->input->post('amount'.$v);
                $this->db->set($arr)->where(array('sid'=>$v,'customer_id'=>$customer_id))->update('supplymore_tbl');
                $due = $due+$this->input->post('tanki_bhari'.$v)*$kaneCharge['kane_charge'];
                if($this->input->post('amount'.$v) > 0){
                    $remaining = $due-$this->input->post('amount'.$v);
                    $this->db->insert('collection_tbl',array('customer_id'=>$customer_id,'collect_amount' =>$this->input->post('amount'.$v),'balance' =>$remaining ,'collect_date' =>date('Y-m-d',strtotime($supplyMdate)),'driver_id' => '1','supplymore_id' =>''  ));
                    $due = $remaining;
                }

            }
            $totalStock = 0;
            foreach($supplyDate as $val){
                $total = $this->db->select_sum('tanki_bhari')->select_sum('tanki_khali')->select_sum('amount')->from('supplymore_tbl')->where(array('supply_date'=>$val,'customer_id'=>$customer_id))->get()->row_array();
                $totStock = $total['tanki_bhari'] - $total['tanki_khali'];
                $totalStock += $totStock;
                $this->db->set(array('tanki_bhari'=>$total['tanki_bhari'],'tanki_khali'=>$total['tanki_khali'],'amount'=>$total['amount'],'stock'=>$totalStock))->where(array('supply_date'=>$val,'customer_id'=>$customer_id))->update('supply_tbl');
            }
            $kaneTotal = $this->db->select_sum('amount')->select_sum('tanki_bhari')->from('supplymore_tbl')->where('customer_id',$customer_id)->get()->row_array();
            $dueAmount = $kaneTotal['tanki_bhari'] * $kaneCharge['kane_charge'];
            $totalDue = $dueAmount - $kaneTotal['amount'];
            $cusArr = array(
                'due_amount' => $totalDue,
                'kane_stock' => $totalStock,
            );
            $this->db->set($cusArr)->where('customer_id',$customer_id)->update('customer_tbl');
            $this->session->set_flashdata('msg','<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Report Update Successfully.</div>');
            redirect('admin/report/customerReportEdit');
        }

        function generateCart($customer_id,$from_date,$to_date) {
           //$data['data'] = $this->report_model->make_report_datatables($customer_id,$from_date,$to_date);  
           $data['data'] = $this->db->select()->from('supply_tbl')->where('customer_id',$customer_id)->where('supply_tbl.supply_date BETWEEN "'. date('Y-m-d', strtotime($from_date)). '" and "'. date('Y-m-d', strtotime($to_date)).'"')->get()->result();
           $this->load->view('admin/cardPrint',$data);
        }
	}

    
?>