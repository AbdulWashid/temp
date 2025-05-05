<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Customer extends CI_Controller{
		public function __construct() {
            parent::__construct();
			date_default_timezone_set('Asia/Kolkata');
            $user = $this->session->userdata('user');
            if (!isset($user)) { 
                redirect('admin/login');
            } 
        }
		public function add(){
			$this->form_validation->set_rules('area_id','Area','trim|required');
			$this->form_validation->set_rules('customer_name','Customer Name','trim|required');
			$this->form_validation->set_rules('mobileno','Mobile Number','trim|required|regex_match[/^[6-9]\d{9}$/]');
			$this->form_validation->set_rules('type','Type','trim|required');
			$this->form_validation->set_rules('kane_charge','Per Kane Charge','trim|required');
			$this->form_validation->set_rules('address','Address','trim|required');
			if($this->form_validation->run() == TRUE){
				$data = array(
					'area_id' => $this->input->post('area_id'),
					'customer_name' => $this->input->post('customer_name'),
					'mobileno' => $this->input->post('mobileno'),
					'type' => $this->input->post('type'),
					'kane_charge' => $this->input->post('kane_charge'),
					'address' => $this->input->post('address'),
					'status'  => '1'
				);
				$this->customer_model->add($data);
				$this->session->set_flashdata('msg','<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Customer Added Successfully.</div>');
				redirect('admin/customer/add');
			}else{
				$data['area_list'] = $this->area_model->getAreaList();
				$this->load->view('admin/header');
				$this->load->view('admin/add-customer',$data);
			}
			
		}

		public function list(){
			$data['customer_list'] = $this->customer_model->getCustomerList();
			$this->load->view('admin/header');
			$this->load->view('admin/customer-list',$data);
		}
		
		public function edit($customer_id){
			$this->form_validation->set_rules('area_id','Area','trim|required');
			$this->form_validation->set_rules('customer_name','Customer Name','trim|required');
			$this->form_validation->set_rules('mobileno','Mobile Number','trim|required|regex_match[/^[6-9]\d{9}$/]');
			$this->form_validation->set_rules('type','Type','trim|required');
			$this->form_validation->set_rules('kane_charge','Per Kane Charge','trim|required');
			$this->form_validation->set_rules('address','Address','trim|required');
			$this->form_validation->set_message('is_unique', 'The %s is already taken');
			if($this->form_validation->run() == TRUE){
				$data = array(
					'customer_id' => $customer_id,
					'area_id' => $this->input->post('area_id'),
					'customer_name' => $this->input->post('customer_name'),
					'mobileno' => $this->input->post('mobileno'),
					'type' => $this->input->post('type'),
					'kane_charge' => $this->input->post('kane_charge'),
					'address' => $this->input->post('address')
				);
				$this->customer_model->edit($data);
				$this->session->set_flashdata('msg','<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Customer Edit Successfully.</div>');
				redirect('admin/customer/edit/'.$customer_id);

			}else{
				$data['area_list'] = $this->area_model->getAreaList();
				$data['edit'] = $this->customer_model->getEditCustomerRec($customer_id);
				$this->load->view('admin/header');
				$this->load->view('admin/edit-customer',$data);
			}
		}

		public function delete($customer_id){
			$this->customer_model->deleteCustomer($customer_id);
			$this->session->set_flashdata('msg','<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Customer Delete Successfully.</div>');
			redirect('admin/customer/list');
		}

		public function changeStatus($customer_id,$status){
			if($status == '0'){
				$arr = array('status'=>'1');
			}else{
				$arr = array('status'=>'0');
			}
			$this->db->set($arr)->where('customer_id',$customer_id)->update('customer_tbl');
			$this->session->set_flashdata('msg','<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Status Change Successfully.</div>');
			redirect('admin/customer/list');
		}


		
	}
?>