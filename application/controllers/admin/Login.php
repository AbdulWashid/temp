<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Login extends CI_Controller{
		public function index(){
			$this->form_validation->set_rules('email','Email','trim|required');
			$this->form_validation->set_rules('password','Password','trim|required');
			if($this->form_validation->run() == TRUE){
				$data = array(
					'email' => $this->input->post('email'),
					'password' => sha1($this->input->post('password')),
				);
				$result = $this->login_model->checkUser($data);
				if($result != false){
					$arr = array(
						'user_id' => $result['user_id'],
						'username' => $result['username']
					);
					$this->session->set_userdata('user',$arr);
					redirect('admin/dashboard');
				}else{
					$this->session->set_flashdata('msg','<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Invalid Email And Password.</div>');
					redirect('admin/login');
				}
				
			}else{
				$this->load->view('admin/login');
			}
			
		}

		public function logout(){
			$user = $this->session->userdata('user');
			$this->session->unset_userdata($user);
			$this->session->sess_destroy();
			redirect('admin/login');
		}
	}
?>