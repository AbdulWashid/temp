<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Driver extends CI_Controller{
		public function __construct() {
            parent::__construct();
			date_default_timezone_set('Asia/Kolkata');
            $user = $this->session->userdata('user');
            if (!isset($user)) { 
                redirect('admin/login');
            } 
        }
		public function add(){
			$this->form_validation->set_rules('driver_name','Driver Name','trim|required');
			$this->form_validation->set_rules('mobileno','Mobile Number','trim|required|regex_match[/^[6-9]\d{9}$/]|is_unique[driver_tbl.mobileno]');
			$this->form_validation->set_rules('password','Password','trim|required');
            $this->form_validation->set_message('is_unique', 'The %s is already taken');
			if($this->form_validation->run() == TRUE){
                if($_FILES['driver_image']['name'] != ''){
                    if(($_FILES['driver_image']['type'] == 'image/png') || ($_FILES['driver_image']['type'] == 'image/jpg') || ($_FILES['driver_image']['type'] == 'image/jpeg')){
                        $driver_image = rand(100000000,999999999).'.'.pathinfo($_FILES["driver_image"]["name"])['extension']; 
                        $source = $_FILES['driver_image']['tmp_name'];
                        $destination = 'uploads/driver/'.$driver_image;
                        move_uploaded_file($source,$destination);
                    }else{
                        $this->session->set_flashdata('msg','<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Please Add Only Image.</div>');
                        redirect('admin/driver/add');
                    }
                }else{
                    $driver_image = '';
                }
                
				$data = array(
					'driver_name' => $this->input->post('driver_name'),
                    'driver_image' => $driver_image,
					'mobileno' => $this->input->post('mobileno'),
					'password' => $this->input->post('password'),
				);
				$this->driver_model->add($data);
				$this->session->set_flashdata('msg','<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Driver Added Successfully.</div>');
				redirect('admin/driver/add');
			}else{
				$this->load->view('admin/header');
				$this->load->view('admin/add-driver');
			}
			
		}
        
		public function list(){
			$data['customer_list'] = $this->driver_model->getDriverList();
			$this->load->view('admin/header');
			$this->load->view('admin/driver-list',$data);
		}
		
		public function edit($driver_id){
			$original_value = $this->db->query("select mobileno from driver_tbl where driver_id = ".$driver_id)->row()->mobileno;
			if($this->input->post('mobileno') != $original_value) {
				$is_unique =  '|is_unique[driver_tbl.mobileno]';
			}else{
				$is_unique =  '';
			}
			$this->form_validation->set_rules('driver_name','Driver Name','trim|required');
			$this->form_validation->set_rules('mobileno','Mobile Number','trim|required|regex_match[/^[6-9]\d{9}$/]'.$is_unique);
			$this->form_validation->set_rules('password','Password','trim|required');
			$this->form_validation->set_message('is_unique', 'The %s is already taken');
			if($this->form_validation->run() == TRUE){
				if($_FILES['driver_image']['name'] != ''){
                    if(($_FILES['driver_image']['type'] == 'image/png') || ($_FILES['driver_image']['type'] == 'image/jpg') || ($_FILES['driver_image']['type'] == 'image/jpeg')){
                        $row = $this->db->select('driver_image')->from('driver_tbl')->where('driver_id',$driver_id)->get()->row_array();
						if($row['driver_image'] != ''){
							unlink('uploads/driver/'.$row['driver_image']);
						}
						$driver_image = rand(100000000,999999999).'.'.pathinfo($_FILES["driver_image"]["name"])['extension']; 
                        $source = $_FILES['driver_image']['tmp_name'];
                        $destination = 'uploads/driver/'.$driver_image;
                        move_uploaded_file($source,$destination);
						$this->db->set('driver_image',$driver_image)->where('driver_id',$driver_id)->update('driver_tbl');
                    }else{
                        $this->session->set_flashdata('msg','<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Please Add Only Image.</div>');
                        redirect('admin/driver/edit/'.$driver_id);
                    }
                }
                
				$data = array(
					'driver_id' => $driver_id,
					'driver_name' => $this->input->post('driver_name'),
					'mobileno' => $this->input->post('mobileno'),
					'password' => $this->input->post('password'),
				);
				$this->driver_model->add($data);
				$this->session->set_flashdata('msg','<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Driver Edit Successfully.</div>');
				redirect('admin/driver/edit/'.$driver_id);

			}else{
				$data['edit'] = $this->driver_model->getEditDriverRec($driver_id);
				$this->load->view('admin/header');
				$this->load->view('admin/edit-driver',$data);
			}
		}
		

		public function delete($driver_id){
			$this->driver_model->deleteDriver($driver_id);
			$this->session->set_flashdata('msg','<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Driver Delete Successfully.</div>');
			redirect('admin/driver/list');
		}

		public function changeStatus($driver_id,$status){
			if($status == '0'){
				$arr = array('status'=>'1');
			}else{
				$arr = array('status'=>'0');
			}
			$this->db->set($arr)->where('driver_id',$driver_id)->update('driver_tbl');
			$this->session->set_flashdata('msg','<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Status Change Successfully.</div>');
			redirect('admin/driver/list');
		}
       
	}
?>