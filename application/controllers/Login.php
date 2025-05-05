<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Login extends CI_Controller{
		public function __construct() {
            parent::__construct();
        }
		public function index(){
			$driver = $this->session->userdata('driver');
			if(!empty($driver)){
				redirect('app/dashboard');
			}
            $this->form_validation->set_rules('mobileno','Mobile Number','trim|required');
			$this->form_validation->set_rules('password','Password','trim|required');
			if($this->form_validation->run() == TRUE){
				$data = array(
					'mobileno' => $this->input->post('mobileno'),
					'password' => $this->input->post('password'),
				);
				$result = $this->login_model->checkDriverLogin($data);
				if($result != false){
					$arr = array(
						'driver_id' => $result['driver_id'],
						'driver_name' => $result['driver_name']
					);
					$this->session->set_userdata('driver',$arr);
					redirect('app/dashboard');
				}else{
					$this->session->set_flashdata('msg','<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Invalid Mobile Number And Password.</div>');
					redirect('login');
				}
			}else{
				$this->load->view('app/login');
			}
			
		}

		public function logout(){
			$driver = $this->session->userdata('driver');
			$this->session->unset_userdata($driver);
			$this->session->sess_destroy();
			redirect('/');
		}
		
	}
?>