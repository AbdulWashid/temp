<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	class App extends CI_Controller{
		public function __construct() {
            parent::__construct();
			$driver = $this->session->userdata('driver');
			date_default_timezone_set('Asia/Kolkata');
			$drive = $this->db->select('status')->from('driver_tbl')->where('driver_id',$driver['driver_id'])->get()->row_array();
			if($drive['status'] == 0){
				redirect('login/logout');
			}
			if(empty($driver)){
				redirect('login');
			}
        }
		public function dashboard(){
			$data['back'] = 'No';
			$driver = $this->session->userdata('driver');
			$data['delivery_list'] = $this->app_model->getDeliveryByDriver($driver['driver_id']);
			$data['tankiBhariCount'] = $this->db->select_sum('tanki_bhari')->from('supply_tbl')->where(array('driver_id'=>$driver['driver_id'],'supply_date'=>date('Y-m-d')))->get()->row()->tanki_bhari;
			$data['tankikhaliCount'] = $this->db->select_sum('tanki_khali')->from('supply_tbl')->where(array('driver_id'=>$driver['driver_id'],'supply_date'=>date('Y-m-d')))->get()->row()->tanki_khali;
			$data['collectAmt'] = $this->db->select_sum('amount')->from('supply_tbl')->where(array('driver_id'=>$driver['driver_id'],'supply_date'=>date('Y-m-d')))->get()->row()->amount;
            $this->load->view('app/dashboard',$data);
		}

		public function searchArea(){
			$data['back'] = 'Yes';
			$this->form_validation->set_rules('supply_date','Supply Date','trim|required');
			$this->form_validation->set_rules('area_id','Area','trim|required');
			if($this->form_validation->run() == TRUE){
				$area_id = $this->input->post('area_id');
				$supply_date = $this->input->post('supply_date');
				$nor = $this->app_model->checkCustomerByArea($area_id);
				if($nor != 0){
					redirect('app/areaCustomer/'.$area_id.'/'.$supply_date);
				}else{
					$this->session->set_flashdata('msg','<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>No Customer Found this area.</div>');
					redirect('app/searchArea');
				}
			}else{
				$data['area_list'] = $this->area_model->getAreaList();
				$this->load->view('app/search-by-area',$data);
			}	
		}

		public function customerList(){
			$data['back'] = 'Yes';
			$driver = $this->session->userdata('driver');
			$data['customer_list'] = $this->app_model->getCustomerAddedByDriver($driver['driver_id']);
			$this->load->view('app/customer_list',$data);
		}

		public function addCustomer(){
			$data['back'] = 'Yes';
			$driver = $this->session->userdata('driver');
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
					'driver_id' => $driver['driver_id']
				);
				$this->customer_model->add($data);
				$this->session->set_flashdata('msg','customerAdd');
				redirect('app/addCustomer');
			}else{
				$data['area_list'] = $this->area_model->getAreaList();
				$this->load->view('app/add_customer',$data);
			}
		}
		

		public function areaCustomer($area_id,$supply_date){
			$data['back'] = 'Yes';
			$data['area'] = $this->app_model->getAreaNameById($area_id);
			$data['customer_list'] = $this->app_model->getSuppliedCustomerByAreaId($area_id);
			$data['supply_date'] = $supply_date;
			$this->load->view('app/area-customer',$data);
		}

		public function supplyTanki(){
			$data = array('success' => false,'messages' => array());
			$this->form_validation->set_rules('supply_date','Supply Date','trim|required');
			$this->form_validation->set_rules('customer_id','Customer Id','trim|required');
			$this->form_validation->set_rules('tanki_bhari','टंकी भरी','trim|required');
			$this->form_validation->set_rules('tanki_khali','टंकी खाली','trim|required');
			$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
			if($this->form_validation->run()){
				$driver = $this->session->userdata('driver');
				$customer_id = $this->input->post('customer_id');
				$supply_date = $this->input->post('supply_date');
				$customer = $this->db->select('kane_charge,due_amount,kane_stock,mobileno,customer_name')->from('customer_tbl')->where('customer_id',$customer_id)->get()->row_array();
				$res = $this->db->select('*')->from('supply_tbl')->where(array('customer_id'=>$customer_id,'supply_date'=>date('Y-m-d',strtotime($supply_date))))->get()->row_array();
				if($res == NULL){
					
					$addedRecord = '';
					$lastSupply = $this->db->select('supply_date')->from('supply_tbl')->where('customer_id',$customer_id)->order_by('supply_id','DESC')->get()->row_array();
					if(!empty($lastSupply)){
						$currentSupplyDate = date('Y-m-d',strtotime($supply_date));
						if($lastSupply['supply_date'] < $currentSupplyDate){
							$addedRecord = 'Yes';
						}else{
							$addedRecord = 'No';
						}
					}else{
						$addedRecord = 'Yes';
					}
					if($addedRecord == 'Yes'){
						$amount = $this->input->post('amount');
						if($amount != '' && $amount > 0){
							$collectAmt = $amount;
						}else{
							$collectAmt = '0';
						}
						$tanki_bhari = $this->input->post('tanki_bhari');
						$tanki_khali = $this->input->post('tanki_khali');

						$kane_stock = $customer['kane_stock'] + $tanki_bhari - $tanki_khali;
						if($customer['kane_stock'] >= $tanki_khali){
							$tankiTotal = $customer['kane_charge'] * $tanki_bhari;
							$due_amount = $customer['due_amount'] + $tankiTotal - $collectAmt;
							$due_amount2 = $customer['due_amount'] + $tankiTotal;
							if($due_amount2 >= $collectAmt){
								
								$data = array(
									'customer_id' => $customer_id,
									'tanki_bhari' => $tanki_bhari,
									'tanki_khali' => $tanki_khali,
									'stock' => $kane_stock,
									'per_kane_amt' => $customer['kane_charge'],
									'amount' => $this->input->post('amount'),
									'driver_id' => $driver['driver_id'],
									'supply_date' => $this->input->post('supply_date')
								);
								$this->db->insert('supply_tbl',$data);
								$this->db->insert('supplymore_tbl',$data);
								$supplymore_id = $this->db->insert_id();
								// transaction per day ==================
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
										
										$this->db->insert('transaction', array(
											'customer_id' => $customer_id,
											'driver_id' => $driver['driver_id'],
											'type' => 'out',
											'amount' => 0,
											'balance' => $in_balance_old,
											'balance_status' => $in_status_old,
											'date' => date('Y-m-d')
										));
										$this->db->insert('transaction', array(
											'customer_id' => $customer_id,
											'driver_id' => $driver['driver_id'],
											'type' => 'in',
											'amount' => 0,
											'balance' => $in_balance_old,
											'balance_status' => $in_status_old,
											'date' => date('Y-m-d')
										));
									}

									// Get last transaction details
									// $lastTrans = $this->db->select('balance,balance_status,amount')
									// 					->from('transaction')
									// 					->where('customer_id', $customer_id)
									// 					->order_by('id', 'DESC')
									// 					->limit(1)
									// 					->get()
									// 					->row_array();

									
									if ($tanki_bhari > 0) {
										
										$new_amount = $customer['kane_charge'] * $tanki_bhari;

										$lastTrans = $this->db->get_where('transaction', [
											'customer_id' => $customer_id,
											'date' => $trans_date,
											'type' => 'out'
										])->row_array();
	
										$previous_balance = $lastTrans['balance'] ;
										$balance_status = $lastTrans['balance_status'];
										$collect_amount = $lastTrans['amount'];
										

										if ($balance_status == 'pending' || $balance_status == 'clear') {
											$new_balance = $previous_balance + $new_amount;
											$status = 'pending';
										} elseif ($balance_status == 'overpaid') {
											if ($new_amount > $previous_balance) {
												$new_balance = $new_amount - $previous_balance;
												$status = 'pending';
											} elseif ($new_amount == $previous_balance) {
												$new_balance = 0;
												$status = 'clear';
											} else {
												$new_balance = $previous_balance - $new_amount;
												$status = 'overpaid';
											}
										}
										$this->db->where('id', $lastTrans['id'])->update('transaction', [
											'balance' => $new_balance,
											'balance_status' => $status,
											'amount' => $collect_amount + $new_amount
										]);

										$lastTrans = $this->db->get_where('transaction', [
											'customer_id' => $customer_id,
											'date' => $trans_date,
											'type' => 'in'
										])->row_array();
	
										$previous_balance = $lastTrans['balance'] ;
										$balance_status = $lastTrans['balance_status'];
										$collect_amount = $lastTrans['amount'];

										if ($balance_status == 'overpaid') {
										
											if ($new_amount > $collect_amount) {
												$balance_in = $new_amount - $previous_balance;
												$status_in = 'pending';
											} elseif ($new_amount == $collect_amount) {
												$balance_in = 0;
												$status_in = 'clear';
											} else {
												$balance_in = $previous_balance - $new_amount;
												$status_in = 'overpaid';
											}
										} 
										elseif($balance_status == 'clear' || $balance_status == 'pending'){
											$balance_in = $previous_balance + $new_amount;
											$status_in = 'pending';
	
										}
										
										$this->db->where('id', $lastTrans['id'])->update('transaction', [
											'balance' => $balance_in,
											'balance_status' => $status_in,
										]);
									}

									// IN transaction (payment/collection)
									if ($amount > 0) {

										$lastTrans = $this->db->get_where('transaction', [
											'customer_id' => $customer_id,
											'date' => $trans_date,
											'type' => 'in'
										])->row_array();
	
										$previous_balance = $lastTrans['balance'] ;
										$balance_status = $lastTrans['balance_status'];
										$collect_amount = $lastTrans['amount'];


										if ($balance_status == 'overpaid' || $balance_status == 'clear') {
											$new_balance = $previous_balance + $amount;
											$status = 'overpaid';
										} elseif ($balance_status == 'pending') {
											if ($amount > $previous_balance) {
												$new_balance = $amount - $previous_balance;
												$status = 'overpaid';
											} elseif ($amount == $previous_balance) {
												$new_balance = 0;
												$status = 'clear';
											} else {
												$new_balance = $previous_balance - $amount;
												$status = 'pending';
											}
										}

										$this->db->where('id', $lastTrans['id'])->update('transaction', [
											'balance' => $new_balance,
											'balance_status' => $status,
											'amount' => $collect_amount + $amount
										]);
									}

								// transaction per day ==================
								$this->db->set(array('due_amount'=>$due_amount,'kane_stock'=>$kane_stock))->where('customer_id',$customer_id)->update('customer_tbl');
								if($amount != '' && $amount > 0){
									$coll = array(
										'customer_id' => $customer_id,
										'collect_amount' => $amount,
										'balance' => $due_amount,
										'collect_date' => date('Y-m-d',strtotime($supply_date)),
										'driver_id' => $driver['driver_id'],
										'supplymore_id' => $supplymore_id
									);
									$this->db->insert('collection_tbl',$coll);
								}
								//https://wappsms.com/api/send?number=919630136688&type=text&message=test+message&instance_id=6469E2FC6B521&access_token=64694b2b3c74d
								$number = $customer['mobileno'];
								$name=  $customer["customer_name"];
								$date = date('d M Y',strtotime($supply_date)); 
								//$msg = urlencode("नमस्कार $name , दिनांक  $date को  भरी केन $tanki_bhari एवं  खाली केन $tanki_khali एवं स्टॉक $kane_stock  एवं अमाउंट जमा   $collectAmt ");
								//$msg = urlencode("नमस्कार $name , दिनांक  $date को\nभरी केन - $tanki_bhari\nखाली केन - $tanki_khali\nस्टॉक - $kane_stock\nअमाउंट जमा - $collectAmt ");
								//$url = "https://wappsms.com/api/send?number=91$number&type=text&message=$msg&instance_id=6469E2FC6B521&access_token=64694b2b3c74d";
								//$url = "https://wappsms.com/api/send.php?number=91$number&type=text&message=$msg&instance_id=6469FB4FC3169&access_token=b2e516ae3ba2cf771e65bffccc0869d2";
								//$url = "https://wappsms.com/api/send?number=91$number&type=text&message=$msg&instance_id=64C7DE153A463&access_token=646ee6ef416ff";
								//file_get_contents($url);
								$data['success'] = true;
								
							}else{
								$data['success'] = 'greaterAmt';
							}
							
						}else{
							$data['success'] = 'greater';
						}
					}else{
						$data['success'] = 'previousDate';
					}
					
				}else{
					$data['success'] = null;
				}
				
			}else{
				foreach($_POST as $key => $value){
					$data['messages'][$key] = form_error($key);
				}
			}

			echo json_encode($data);
		}

		public function supplyMoreTanki(){
			$data = array('success' => false,'messages' => array());
			$this->form_validation->set_rules('supply_date','Supply Date','trim|required');
			$this->form_validation->set_rules('customer_id','Customer Id','trim|required');
			$this->form_validation->set_rules('tanki_bhari2','टंकी भरी','trim|required');
			$this->form_validation->set_rules('tanki_khali','टंकी खाली','trim|required');
			$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
			if($this->form_validation->run()){
				$driver = $this->session->userdata('driver');
				$customer_id = $this->input->post('customer_id');
				$supply_date = $this->input->post('supply_date');
				$customer = $this->db->select('kane_charge,due_amount,kane_stock,mobileno,customer_name')->from('customer_tbl')->where('customer_id',$customer_id)->get()->row_array();
				$res = $this->db->select('*')->from('supply_tbl')->where(array('customer_id'=>$customer_id,'supply_date'=>date('Y-m-d',strtotime($supply_date))))->get()->row_array();
				$addedRecord = '';
				$lastSupply = $this->db->select('supply_date')->from('supply_tbl')->where('customer_id',$customer_id)->order_by('supply_id','DESC')->get()->row_array();
				if(!empty($lastSupply)){
					$currentSupplyDate = date('Y-m-d',strtotime($supply_date));
					if($lastSupply['supply_date'] <= $currentSupplyDate){
						$addedRecord = 'Yes';
					}else{
						$addedRecord = 'No';
					}
				}else{
					$addedRecord = 'Yes';
				}
				
				if($addedRecord == 'Yes'){
					$amount = $this->input->post('amount');
					if($amount != '' && $amount > 0){
						$collectAmt = $amount;
					}else{
						$collectAmt = '0';
					}
					$tanki_bhari = $this->input->post('tanki_bhari2');
					$tanki_khali = $this->input->post('tanki_khali');
					$kane_stock = $customer['kane_stock'] + $tanki_bhari - $tanki_khali;
					if($customer['kane_stock'] >= $tanki_khali){
						$tankiTotal = $customer['kane_charge'] * $tanki_bhari;
						$due_amount = $customer['due_amount'] + $tankiTotal - $collectAmt;
						$due_amount2 = $customer['due_amount'] + $tankiTotal;
						if($due_amount2 >= $collectAmt){
							$data = array(
								'customer_id' => $customer_id,
								'tanki_bhari' => $tanki_bhari,
								'tanki_khali' => $tanki_khali,
								'stock' => $kane_stock,
								'per_kane_amt' => $customer['kane_charge'],
								'amount' => $this->input->post('amount'),
								'driver_id' => $driver['driver_id'],
								'supply_date' => $this->input->post('supply_date')
							);

							
							
							$this->db->insert('supplymore_tbl',$data);
							$supplymore_id = $this->db->insert_id();
							$this->db->set(array('due_amount'=>$due_amount,'kane_stock'=>$kane_stock))->where('customer_id',$customer_id)->update('customer_tbl');
							//  ======================= Transaction Details =======================
								$trans_date = date('Y-m-d', strtotime($supply_date));

								// Fetch existing OUT (supply) entry
								$out = $this->db->get_where('transaction', [
									'customer_id' => $customer_id,
									'date' => $trans_date,
									'type' => 'out'
								])->row_array();

								// Fetch existing IN (payment) entry
								$in = $this->db->get_where('transaction', [
									'customer_id' => $customer_id,
									'date' => $trans_date,
									'type' => 'in'
								])->row_array();


								$out_amount_old = isset($out['amount']) ? $out['amount'] : 0;
								$out_balance_old = isset($out['balance']) ? $out['balance'] : 0;
								$out_status_old = isset($out['balance_status']) ? $out['balance_status'] : 0;
								$in_amount_old = isset($in['amount']) ? $in['amount'] : 0;
								$in_balance_old = isset($in['balance']) ? $in['balance'] : 0;
								$in_status_old = isset($in['balance_status']) ? $in['balance_status'] : 0;
								// out
								if($tanki_bhari > 0){
									$amount_out = $customer['kane_charge'] * $tanki_bhari;
									if ($out_status_old == 'pending' || $out_status_old == 'clear') {
										$balance_out = $out_balance_old + $amount_out;
										$status_out = 'pending';
									} elseif ($out_status_old == 'overpaid') {
										if ($amount_out > $out_balance_old) {
											$balance_out = $amount_out - $out_balance_old;
											$status_out = 'pending';
										} elseif ($amount_out == $out_balance_old) {
											$balance_out = 0;
											$status_out = 'clear';
										} else {
											$balance_out = $out_balance_old - $amount_out;
											$status_out = 'overpaid';
										}
									}

									$amount_out_new = $amount_out + $out_amount_old;
									$this->db->where('id', $out['id'])->update('transaction', [
										'balance' => $balance_out,
										'balance_status' => $status_out,
										'amount' => $amount_out_new
									]);

									if ($in_status_old == 'overpaid') {
										
										if ($amount_out > $in_amount_old) {
											$balance_in = $amount_out - $in_balance_old;
											$status_in = 'pending';
										} elseif ($amount_out == $in_amount_old) {
											$balance_in = 0;
											$status_in = 'clear';
										} else {
											$balance_in = $in_balance_old - $amount_out;
											$status_in = 'overpaid';
										}
									} 
									elseif($in_status_old == 'clear' || $in_status_old == 'pending'){
										$balance_in = $in_balance_old + $amount_out;
										$status_in = 'pending';

									}
									
									$this->db->where('id', $in['id'])->update('transaction', [
										'balance' => $balance_in,
										'balance_status' => $status_in,
									]);
								}
								if(!empty($amount) && $amount > 0){
									$in = $this->db->get_where('transaction', [
										'customer_id' => $customer_id,
										'date' => $trans_date,
										'type' => 'in'
									])->row_array();

									$in_amount_old = isset($in['amount']) ? $in['amount'] : 0;
									$in_balance_old = isset($in['balance']) ? $in['balance'] : 0;
									$in_status_old = isset($in['balance_status']) ? $in['balance_status'] : 0;

									if ($in_status_old == 'overpaid' || $in_status_old == 'clear') {
										$balance_in = $in_balance_old + $amount;
										$status_in = 'overpaid';
									} elseif ($in_status_old == 'pending') {
										if ($amount > $in_balance_old) {
											$balance_in = $amount - $in_balance_old;
											$status_in = 'overpaid';
										} elseif ($amount == $in_balance_old) {
											$balance_in = 0;
											$status_in = 'clear';
										} else {
											$balance_in = $in_balance_old - $amount;
											$status_in = 'pending';
										}
									}

									$this->db->where('id', $in['id'])->update('transaction', [
										'balance' => $balance_in,
										'balance_status' => $status_in,
										'amount' => $amount + $in_amount_old
									]);
									
								}
							//  ======================= Transaction Details =======================
							/* Supply Update */
							$uptanki_bhari = $res['tanki_bhari'] + $tanki_bhari;
							$uptanki_khali = $res['tanki_khali'] + $tanki_khali;
							$upkane_stock = $kane_stock;
							$upcollectAmt = $res['amount'] + $collectAmt;
							$updArr = array(
								'tanki_bhari' => $uptanki_bhari,
								'tanki_khali' => $uptanki_khali,
								'stock' => $upkane_stock,
								'amount' => $upcollectAmt,
							);
							$this->db->set($updArr)->where(array('customer_id'=>$customer_id,'supply_date'=>date('Y-m-d',strtotime($supply_date))))->update('supply_tbl');
							/* Supply Update */
							if($amount != '' && $amount > 0){
								$coll = array(
									'customer_id' => $customer_id,
									'collect_amount' => $amount,
									'balance' => $due_amount,
									'collect_date' => date('Y-m-d',strtotime($supply_date)),
									'driver_id' => $driver['driver_id'],
									'supplymore_id' => $supplymore_id
								);
								$this->db->insert('collection_tbl',$coll);
							}
							$number = $customer['mobileno'];
							$name=  $customer["customer_name"];
							$date = date('d M Y',strtotime($supply_date)); 
							//$msg = urlencode("नमस्कार $name , दिनांक  $date को\nभरी केन - $tanki_bhari\nखाली केन - $tanki_khali\nस्टॉक - $kane_stock\nअमाउंट जमा - $collectAmt ");
							//$url = "https://wappsms.com/api/send.php?number=91$number&type=text&message=$msg&instance_id=6469FB4FC3169&access_token=b2e516ae3ba2cf771e65bffccc0869d2";
							//$url = "https://wappsms.com/api/send?number=91$number&type=text&message=$msg&instance_id=64C7DE153A463&access_token=646ee6ef416ff";
							
							//file_get_contents($url);
							$data['success'] = true;
						}else{
							$data['success'] = 'greaterAmt';
						}
						
					}else{
						$data['success'] = 'greater';
					}
				}else{
					$data['success'] = 'previousDate';
				}

				
			}else{
				foreach($_POST as $key => $value){
					$data['messages'][$key] = form_error($key);
				}
			}

			echo json_encode($data);
		}

		public function customerReport(){
			$data['back'] = 'Yes';
			$this->form_validation->set_rules('customer_id','Customer','trim|required');
			$this->form_validation->set_rules('from_date','From Date','trim|required');
			$this->form_validation->set_rules('to_date','To Date','trim|required');
			if($this->form_validation->run() == TRUE){
				$customer_id = $this->input->post('customer_id');
				$from_date = $this->input->post('from_date');
				$to_date = $this->input->post('to_date');
				$data['customer_id'] = $customer_id;
				$data['from_date'] = $from_date;
				$data['to_date'] = $to_date;
				$data['customer_report'] = $this->app_model->getCustomerReportByDate($customer_id,$from_date,$to_date);
				$data['customer_list'] = $this->db->select('customer_id,customer_name')->from('customer_tbl')->where('status','1')->order_by('customer_id','DESC')->get()->result_array();
				$this->load->view('app/customer-report',$data);
			}else{
				$data['customer_id'] = '';
				$data['from_date'] = date('Y-m-01');
				$data['to_date'] = date('Y-m-d');
				$data['customer_report'] = '';
				$data['customer_list'] = $this->db->select('customer_id,customer_name')->from('customer_tbl')->where('status','1')->order_by('customer_id','DESC')->get()->result_array();
				$this->load->view('app/customer-report',$data);
			}
		}

		public function offlineSupplyReport(){
			$data['back'] = 'Yes';
			$driver = $this->session->userdata('driver');
			$this->form_validation->set_rules('from_date','From Date','trim|required');
			$this->form_validation->set_rules('to_date','To Date','trim|required');
			if($this->form_validation->run() == TRUE){
				$from_date = $this->input->post('from_date');
				$to_date = $this->input->post('to_date');
				$data['from_date'] = $from_date;
				$data['to_date'] = $to_date;
				$data['supply_report'] = $this->app_model->getOfflineSupplyReportByDate($driver['driver_id'],$from_date,$to_date);
				$this->load->view('app/offline-supply-report',$data);
			}else{
				$data['from_date'] = date('Y-m-01');
				$data['to_date'] = date('Y-m-d');
				$data['supply_report'] = '';
				$this->load->view('app/offline-supply-report',$data);
			}
		}

		public function profile(){
			$data['back'] = 'Yes';
			$driver = $this->session->userdata('driver');
			$data['driver'] = $this->db->select('*')->from('driver_tbl')->where('driver_id',$driver['driver_id'])->get()->row_array();
			$this->load->view('app/profile',$data);
		}

		public function supplyDetail($customer_id,$supply_date){
			$data['back'] = 'Yes';
			$data['customer'] = $this->db->select('customer_name')->from('customer_tbl')->where('customer_id',$customer_id)->get()->row_array();
			$data['customer_report'] = $this->db->select('*')->from('supplymore_tbl')->where(array('customer_id'=>$customer_id,'supply_date'=>$supply_date))->get()->result_array();
			$this->load->view('app/supply-detail',$data);
		}

		public function supplyOffline(){
			$data['back'] = 'Yes';
			$driver = $this->session->userdata('driver');
			$this->form_validation->set_rules('tanki_bhari','टंकी भरी','trim|required');
			$this->form_validation->set_rules('amount','अमाउंट','trim|required');
			$this->form_validation->set_rules('pay_type','Payment Type','trim|required');
			if($this->form_validation->run() == TRUE){
				$nor = $this->db->select('oid')->from('offlinesupply_tbl')->where(array('driver_id'=>$driver['driver_id'],'supply_date' => date('Y-m-d')))->get()->num_rows();
				$data = array(
					'driver_id' => $driver['driver_id'],
					'tanki_bhari' => $this->input->post('tanki_bhari'),
					'amount' => $this->input->post('amount'),
					'pay_type' => $this->input->post('pay_type'),
					'supply_date' => date('Y-m-d')
				);
				
				$this->app_model->addOfflineSupply($data);
				if($nor == 0){
					$insArr = array(
						'driver_id' => $driver['driver_id'],
						'total_tanki' => $this->input->post('tanki_bhari'),
						'total_amount' => $this->input->post('amount'),
						'supply_date' => date('Y-m-d')
					);
					$this->db->insert('offlinesupplytotal_tbl',$insArr);
				}else{
					$total = $this->db->select_sum('tanki_bhari')->select_sum('amount')->from('offlinesupply_tbl')->where(array('driver_id'=>$driver['driver_id'],'supply_date' => date('Y-m-d')))->get()->row_array();
					$updArr = array(
						'total_tanki' => $total['tanki_bhari'],
						'total_amount' => $total['amount']
					);
					$this->db->set($updArr)->where(array('driver_id'=>$driver['driver_id'],'supply_date' => date('Y-m-d')))->update('offlinesupplytotal_tbl');
				}
				$this->session->set_flashdata('msg','offlineAdd');
				redirect('app/supplyOffline');
			}else{
				$data['area_list'] = $this->area_model->getAreaList();
				$this->load->view('app/add-offline-supply',$data);
			}
		}

		public function supplyMoreShow(){
			$customer_id = $this->input->post('customer_id');
			$supply_date = $this->input->post('supply_date');
			$result = $this->db->select('*')->from('supplymore_tbl')->where(array('customer_id'=>$customer_id,'supply_date'=>$supply_date))->order_by('sid','ASC')->get()->result_array();
			if(!empty($result)){
				echo json_encode(array('response'=>'200','result'=>$result));
			}else{
				echo json_encode(array('response'=>'400'));
			}
		}

		public function supplyReportEdit($customer_id,$supply_date){
			if($supply_date != date('Y-m-d')){
				redirect('app/supplyReportEdit/'.$customer_id.'/'.date('Y-m-d'));
			}
			$driver = $this->session->userdata('driver');
			$data['back'] = 'Yes';
			$data['customer_id'] = $customer_id;
			$data['supply_date'] = $supply_date;
			$customer = $this->db->select("*")->from('customer_tbl')->where(array('customer_id'=>$customer_id))->get()->row_array();
			$this->form_validation->set_rules('old_stock','Old Stock','trim|required');
			if($this->form_validation->run() == TRUE){
				$old_stock = $this->input->post('old_stock');
				$old_dueamount = $this->input->post('old_dueamount');
				$sid = $this->input->post('sid');
				$tankiBhari = 0;
				$tankiKhali = 0;
				$totalAmount = 0;
				$due = $old_dueamount;
				$sumited = 0;
				$this->db->where('customer_id',$customer_id)->where('collect_date',date('Y-m-d',strtotime($supply_date)))->delete('collection_tbl');
				foreach($sid as $v){
					
					$tBhari = $this->input->post('tanki_bhari_'.$v);
					$tKhali = $this->input->post('tanki_khali_'.$v);
					$tAmount = $this->input->post('amount_'.$v);
					$tankiBhari += $tBhari;
					$tankiKhali += $tKhali;
					$totalAmount += $tAmount;
					$arr = array(
						'tanki_bhari' => $this->input->post('tanki_bhari_'.$v),
						'tanki_khali' => $this->input->post('tanki_khali_'.$v),
						'stock' => $this->input->post('stock_'.$v),
						'amount' => $this->input->post('amount_'.$v),
					);
					$this->db->set($arr)->where(array('sid'=>$v,'customer_id'=>$customer_id))->update('supplymore_tbl');
					$sumited = $sumited+$this->input->post('amount'.$v);
					$due = $due+$this->input->post('tanki_bhari'.$v) * $kaneCharge['kane_charge'];

					if($this->input->post('amount_'.$v) > 0){
						$remaining = $due-$this->input->post('amount_'.$v);
						$this->db->insert('collection_tbl',array('customer_id'=>$customer_id,'collect_amount' =>$this->input->post('amount_'.$v),'balance' =>$remaining ,'collect_date' =>date('Y-m-d',strtotime($supply_date)),'driver_id' => $driver['driver_id'],'supplymore_id' =>$v  ));
						$due = $remaining;
					}
				}
				
				//  ======================= Transaction Details =======================
					$trans_date = date('Y-m-d', strtotime($supply_date));

					$lastTrans = $this->db->select('balance, balance_status')
														->from('transaction')
														->where('customer_id', $customer_id)
														->where('type','in')
														->where('date',date('Y-m-d', strtotime($supply_date . ' -1 day')))
														->order_by('id', 'DESC')
														->limit(1)
														->get()
														->row_array();

					$previous_balance = isset($lastTrans['balance']) ? $lastTrans['balance'] : 0;
					$balance_status = isset($lastTrans['balance_status']) ? $lastTrans['balance_status'] : 'clear';
					
					// OUT transaction (supply/tanki)
					if ($tankiBhari > 0) {
						$new_amount = $customer['kane_charge'] * $tankiBhari;

						if ($balance_status == 'pending' || $balance_status == 'clear') {
							$new_balance = $previous_balance + $new_amount;
							$status = 'pending';
						} elseif ($balance_status == 'overpaid') {
							if ($new_amount > $previous_balance) {
								$new_balance = $new_amount - $previous_balance;
								$status = 'pending';
							} elseif ($new_amount == $previous_balance) {
								$new_balance = 0;
								$status = 'clear';
							} else {
								$new_balance = $previous_balance - $new_amount;
								$status = 'overpaid';
							}
						}
						
						$arr = array(
							'amount' => $new_amount,
							'balance' => $new_balance,
							'balance_status' => $status
						);
						$this->db->set($arr)->where(array('customer_id'=>$customer_id,'type'=>"out",'date'=>$trans_date))->update('transaction');

						// update for next step
						$previous_balance = $new_balance;
						$balance_status = $status;
					}
					else{
						$arr = array(
							'amount' => 0,
							'balance' => $previous_balance,
							'balance_status' => $balance_status
						);
						$this->db->set($arr)->where(array('customer_id'=>$customer_id,'type'=>"out",'date'=>$trans_date))->update('transaction');

					}

					// IN transaction (payment/collection)
					if ($totalAmount > 0) {
						if ($balance_status == 'overpaid' || $balance_status == 'clear') {
							$new_balance = $previous_balance + $totalAmount;
							$status = 'overpaid';
						} elseif ($balance_status == 'pending') {
							if ($totalAmount > $previous_balance) {
								$new_balance = $totalAmount - $previous_balance;
								$status = 'overpaid';
							} elseif ($totalAmount == $previous_balance) {
								$new_balance = 0;
								$status = 'clear';
							} else {
								$new_balance = $previous_balance - $totalAmount;
								$status = 'pending';
							}
						}

						$arr = array(
							'amount' => $totalAmount,
							'balance' => $new_balance,
							'balance_status' => $status
						);
						$this->db->set($arr)->where(array('customer_id'=>$customer_id,'type'=>"in",'date'=>$trans_date))->update('transaction');

					}else{
						$arr = array(
							'amount' => 0,
							'balance' => $previous_balance,
							'balance_status' => $balance_status
						);
						$this->db->set($arr)->where(array('customer_id'=>$customer_id,'type'=>"in",'date'=>$trans_date))->update('transaction');

					}

				//  ======================= Transaction Details =======================
				$newStock = $tankiBhari - $tankiKhali;
				$updateStock = $old_stock + $newStock;
				$totalCharge = $customer['kane_charge'] * $tankiBhari;
				$dueTotal = $old_dueamount + $totalCharge - $totalAmount;
				$this->db->set(array('tanki_bhari'=>$tankiBhari,'tanki_khali'=>$tankiKhali,'stock'=>$updateStock))->where(array('customer_id'=>$customer_id,'supply_date'=>$supply_date,'amount' => $totalAmount))->update('supply_tbl');
				$this->db->set(array('due_amount'=>$dueTotal,'kane_stock'=>$updateStock))->where('customer_id',$customer_id)->update('customer_tbl');
				$this->session->set_flashdata('msg','supplyEdit');
				redirect('app/supplyReportEdit/'.$customer_id.'/'.$supply_date);
			}else{
				$data['previous'] = $this->db->select('*')->from('supplymore_tbl')->where(array('customer_id'=>$customer_id,'supply_date <'=>$supply_date))->order_by('sid','DESC')->limit(1)->get()->row_array();
				
				$data['supply_list'] = $this->db->select('*')->from('supplymore_tbl')->where(array('customer_id'=>$customer_id,'supply_date'=>$supply_date))->get()->result_array();
				$supply = $this->db->select("*")->from('supply_tbl')->where(array('customer_id'=>$customer_id,'supply_date'=>$supply_date))->get()->row_array();
				$res  = $this->db->select('sum((`tanki_bhari`*`per_kane_amt`-`amount`)) as last_due')->from('supply_tbl')->where('DATE(supply_date) <',$supply_date)->where('customer_id',$customer_id)->get()->row();
				if (!empty($res) && isset($res->last_due)) {
					$data['last_due_amount'] = $res->last_due;
				} else {
					$data['last_due_amount'] = "0";
				}
				$this->load->view('app/edit-supply',$data);
			}
			
		}

		function testing(){
		    $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://app.wappsms.com/api/create-message',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS => array(
              'appkey' => 'cb640413-05dc-4b78-bf61-49a84e876276',
              'authkey' => 'Tj5vlxkIWd49Xa387nWYYjAal4OpJxYhOGHoCxgXHDusLFyZGs',
              'to' => '919630136688',
              'message' => 'Example message',
              'sandbox' => 'false'
              ),
            ));
            
            $response = curl_exec($curl);
            
            curl_close($curl);
            echo $response;

		}
		
		function testingAgain(){
		    $name = 'pratyush';
		    $date = '20 jun';
		    $tanki_bhari = '2';
		     $tanki_khali = '2';
		    $kane_stock = '4';
		    $collectAmt = '200';
		    $number = "9630136688";
		    
		    
		    //$msg = urlencode("नमस्कार $name , दिनांक  $date को\nभरी केन - $tanki_bhari\nखाली केन - $tanki_khali\nस्टॉक - $kane_stock\nअमाउंट जमा - $collectAmt ");
						//$url = "https://wappsms.com/api/send.php?number=91$number&type=text&message=$msg&instance_id=6469FB4FC3169&access_token=b2e516ae3ba2cf771e65bffccc0869d2";
						//$url = "https://wappsms.com/api/send?number=91$number&type=text&message=$msg&instance_id=64C7DE153A463&access_token=646ee6ef416ff";
						
						//file_get_contents($url);
		}
	}
?>