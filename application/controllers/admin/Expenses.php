<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Expenses extends CI_Controller{
		public function __construct() {
            parent::__construct();
			date_default_timezone_set('Asia/Kolkata');
            $user = $this->session->userdata('user');
            if (!isset($user)) { 
                redirect('admin/login');
            } 
        }
		public function add(){
			$this->form_validation->set_rules('head_id','Expenses Head','trim|required');
			$this->form_validation->set_rules('detail','Detail','trim|required');
            $this->form_validation->set_rules('amount','Amount','trim|required');
			if($this->form_validation->run() == TRUE){
				$data = array(
					'head_id' => $this->input->post('head_id'),
					'detail' => $this->input->post('detail'),
					'amount' => $this->input->post('amount'),
					'exp_date' => date('Y-m-d'),
				);
				$this->expenses_model->add($data);
				$this->session->set_flashdata('msg','<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Expenses Added Successfully.</div>');
				redirect('admin/expenses/add');
			}else{
				$data['head_list'] = $this->expenses_model->getExpenseHeadList();
				$this->load->view('admin/header');
				$this->load->view('admin/expenses',$data);
			}
			
		}

		public function list(){
			$data['getExpensesReport'] = [];
			$this->form_validation->set_rules('from_date','From Date','trim|required');
		    $this->form_validation->set_rules('to_date','To Date','trim|required');
			if($this->form_validation->run() == TRUE){
                $data['from_date'] = $this->input->post('from_date');
                $data['to_date'] = $this->input->post('to_date');
            }else{
                $data['from_date'] = date('Y-m-d');
                $data['to_date'] = date('Y-m-d');
            }
			$this->load->view('admin/header');
			$this->load->view('admin/expenses-list',$data);
		}

		public function getExpensesReport(){
            $from_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            $fetch_data = $this->expenses_model->make_expenses_datatables($from_date,$to_date);  
            $data = array();  
            $return = "return confirm('Do You Really Want To Delete This Record ?')";
            $i = 1;
            foreach($fetch_data as $row)  
            {  
                
                $sub_array = array();  
                $sub_array[] = $i;
                $sub_array[] = $row->head_name; 
                $sub_array[] = $row->detail; 
                $sub_array[] = $row->amount; 
                $sub_array[] = date('d-m-Y',strtotime($row->exp_date));
                $sub_array[] = '<a href="'.base_url('admin/expenses/edit/'.$row->exp_id).'" class="btn btn-sm btn-success" style="margin-right:10px;">Edit</a><a href="'.base_url('admin/expenses/delete/'.$row->exp_id).'" onclick="'.$return.'" class="btn btn-sm btn-danger">Delete</a>';
                $data[] = $sub_array;
                $i++;
            }  
            $output = array(  
                "draw" => intval($_POST["draw"]),  
                "recordsTotal" => $this->expenses_model->get_expenses_all_data($from_date,$to_date),  
                "recordsFiltered"=>$this->expenses_model->get_expenses_filtered_data($from_date,$to_date),  
                "data"=>$data  
            );  
            echo json_encode($output);
		}

        public function delete($exp_id){
			$this->expenses_model->deleteExpenses($exp_id);
			$this->session->set_flashdata('delmsg','<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Expenses Delete Successfully.</div>');
			redirect('admin/expenses/list');
		}

		public function deleteExpenseHead($eid){
			$this->expenses_model->deleteExpensesHead($eid);
			$this->session->set_flashdata('delmsg','<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Expenses Head Delete Successfully.</div>');
			redirect('admin/expenses/addExpenseHead');
		}
        
		public function edit($exp_id){
			$this->form_validation->set_rules('head_id','Expenses Head','trim|required');
			$this->form_validation->set_rules('detail','Detail','trim|required');
            $this->form_validation->set_rules('amount','Amount','trim|required');
			if($this->form_validation->run() == TRUE){
				$data = array(
                    'exp_id' => $exp_id,
					'head_id' => $this->input->post('head_id'),
					'detail' => $this->input->post('detail'),
					'amount' => $this->input->post('amount')
				);
				$this->expenses_model->add($data);
				$this->session->set_flashdata('msg','<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Expenses Edit Successfully.</div>');
				redirect('admin/expenses/edit/'.$exp_id);
			}else{
                $data['edit'] = $this->expenses_model->getExpenseEditRec($exp_id);
				$data['head_list'] = $this->expenses_model->getExpenseHeadList();
				$this->load->view('admin/header');
				$this->load->view('admin/edit-expenses',$data);
			}
		}

		public function addExpenseHead(){
			$this->form_validation->set_rules('head_name','Head Name','trim|required');
			if($this->form_validation->run() == TRUE){
				$data = array(
					'head_name' => $this->input->post('head_name')
				);
				$this->expenses_model->addExpenseHead($data);
				$this->session->set_flashdata('msg','<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Expenses Head Added Successfully.</div>');
				redirect('admin/expenses/addExpenseHead');
			}else{
				$data['head_list'] = $this->expenses_model->getExpenseHeadList();
				$this->load->view('admin/header');
				$this->load->view('admin/add-expenses-head',$data);
			}
			
		}

		public function editExpenseHead($eid){
			$this->form_validation->set_rules('head_name','Head Name','trim|required');
			if($this->form_validation->run() == TRUE){
				$data = array(
					'eid' => $eid,
					'head_name' => $this->input->post('head_name')
				);
				$this->expenses_model->addExpenseHead($data);
				$this->session->set_flashdata('msg','<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Expenses Head Edit Successfully.</div>');
				redirect('admin/expenses/editExpenseHead/'.$eid);
			}else{
				$data['edit'] = $this->expenses_model->getEditExpenseHead($eid);
				$data['head_list'] = $this->expenses_model->getExpenseHeadList();
				$this->load->view('admin/header');
				$this->load->view('admin/edit-expenses-head',$data);
			}
			
		}
        		
	}
?>