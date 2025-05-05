<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Area extends CI_Controller{
		public function __construct() {
            parent::__construct();
			date_default_timezone_set('Asia/Kolkata');
            $user = $this->session->userdata('user');
            if (!isset($user)) { 
                redirect('admin/login');
            } 
        }
		public function add(){
			$this->form_validation->set_rules('area_name','Area Name','trim|required|is_unique[area_tbl.area_name]');
			$this->form_validation->set_message('is_unique', 'The %s is already taken');
			if($this->form_validation->run() == TRUE){
				$data = array(
					'area_name' => $this->input->post('area_name')
				);
				$this->area_model->add($data);
				$this->session->set_flashdata('msg','<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Area Added Successfully.</div>');
				redirect('admin/area/add');
			}else{
                $data['area_list'] = $this->area_model->getAreaList();
				$this->load->view('admin/header');
				$this->load->view('admin/area',$data);
			}
			
		}
        
		
		public function edit($area_id){
			$this->form_validation->set_rules('area_name','Area Name','trim|required|is_unique[area_tbl.area_name]');
			$this->form_validation->set_message('is_unique', 'The %s is already taken');
			if($this->form_validation->run() == TRUE){
				$data = array(
					'area_id' => $area_id,
					'area_name' => $this->input->post('area_name'),
				);
				$this->area_model->add($data);
				$this->session->set_flashdata('msg','<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Area Edit Successfully.</div>');
				redirect('admin/area/edit/'.$area_id);

			}else{
				$data['edit'] = $this->area_model->getEditArea($area_id);
                $data['area_list'] = $this->area_model->getAreaList();
				$this->load->view('admin/header');
				$this->load->view('admin/edit-area',$data);
			}
		}
        
		public function delete($area_id){
			$this->area_model->deleteArea($area_id);
			$this->session->set_flashdata('delmsg','<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Area Delete Successfully.</div>');
			redirect('admin/area/add');
		}
        

		
	}
?>