

                <!--app-content open-->
				<div class="app-content">
					<div class="side-app">

						<!-- PAGE-HEADER -->
						<div class="page-header">
							<ol class="breadcrumb"><!-- breadcrumb -->
								<li class="breadcrumb-item"><a href="#"><h3 class="mb-0 breadcrump-tittle">Welcome To Water Pro</h3></a></li>
							</ol><!-- End breadcrumb -->
							
						</div>
						<!-- PAGE-HEADER END -->


						
						
						<div class="row">
							<div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
								<div class="card bg-primary img-card box-primary-shadow">
									<div class="card-body">
										<div class="d-flex">
											<div class="text-white">
												<h2 class="mb-0 number-font"><?php echo $customerCount; ?></h2>
												<p class="text-white mb-0">Total Customers</p>
											</div>
											<div class="ml-auto"> <i class="fa fa-send-o text-white fs-30 mr-2 mt-2"></i> </div>
										</div>
									</div>
								</div>
							</div><!-- COL END -->
							<div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
								<div class="card bg-success img-card box-success-shadow">
									<div class="card-body">
										<div class="d-flex">
											<div class="text-white">
												<h2 class="mb-0 number-font"><?php echo $driverCount; ?></h2>
												<p class="text-white mb-0">Total Drivers</p>
											</div>
											<div class="ml-auto"> <i class="fa fa-bar-chart text-white fs-30 mr-2 mt-2"></i> </div>
										</div>
									</div>
								</div>
							</div><!-- COL END -->
							<div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
								<div class="card bg-info img-card box-info-shadow">
									<div class="card-body">
										<div class="d-flex">
											<div class="text-white">
												<h2 class="mb-0 number-font">
													<?php 
														if($totalTankiBhari != NULL){
															echo $totalTankiBhari;
														}else{
															echo '0';
														}	
													?>
												</h2>
												<p class="text-white mb-0">Today Tanki Bhari</p>
											</div>
											<div class="ml-auto"> <i class="fa fa-dollar text-white fs-30 mr-2 mt-2"></i> </div>
										</div>
									</div>
								</div>
							</div><!-- COL END -->
							<div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
								<div class="card bg-danger img-card box-danger-shadow">
									<div class="card-body">
										<div class="d-flex">
											<div class="text-white">
												<h2 class="mb-0 number-font">
													<?php 
														if($totalTankiKhali != NULL){
															echo $totalTankiKhali;
														}else{
															echo '0';
														}
													?>
												</h2>
												<p class="text-white mb-0">Today Tanki Khali</p>
											</div>
											<div class="ml-auto"> <i class="fa fa-cart-plus text-white fs-30 mr-2 mt-2"></i> </div>
										</div>
									</div>
								</div>
							</div><!-- COL END -->
							<div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
								<div class="card bg-danger img-card box-danger-shadow">
									<div class="card-body">
										<div class="d-flex">
											<div class="text-white">
												<h2 class="mb-0 number-font">
													<?php 
														if($totalKaneStock != NULL){
															echo $totalKaneStock;
														}else{
															echo '0';
														}
													?>
												</h2>
												<p class="text-white mb-0">Total Stock</p>
											</div>
											<div class="ml-auto"> <i class="fa fa-send-o text-white fs-30 mr-2 mt-2"></i> </div>
										</div>
									</div>
								</div>
							</div><!-- COL END -->
							<div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
								<div class="card bg-info img-card box-info-shadow">
									<div class="card-body">
										<div class="d-flex">
											<div class="text-white">
												<h2 class="mb-0 number-font">
													<?php 
														if($totatCollection != NULL){
															echo $totatCollection;
														}else{
															echo '0';
														}
													?>
												</h2>
												<p class="text-white mb-0">Total Collection</p>
											</div>
											<div class="ml-auto"> <i class="fa fa-bar-chart text-white fs-30 mr-2 mt-2"></i> </div>
										</div>
									</div>
								</div>
							</div><!-- COL END -->
							<div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
								<div class="card bg-primary img-card box-primary-shadow">
									<div class="card-body">
										<div class="d-flex">
											<div class="text-white">
												<h2 class="mb-0 number-font">
													<?php 
														if($totalDueAmount != NULL){
															echo $totalDueAmount;
														}else{
															echo '0';
														}
													?>
												</h2>
												<p class="text-white mb-0">Total Due Amount</p>
											</div>
											<div class="ml-auto"> <i class="fa fa-bar-chart text-white fs-30 mr-2 mt-2"></i> </div>
										</div>
									</div>
								</div>
							</div><!-- COL END -->
							<div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
								<div class="card bg-success img-card box-success-shadow">
									<div class="card-body">
										<div class="d-flex">
											<div class="text-white">
												<h2 class="mb-0 number-font">
													<?php 
														if($totalExpenses != NULL){
															echo $totalExpenses;
														}else{
															echo '0';
														}	
													?>
												</h2>
												<p class="text-white mb-0">Total Expenses</p>
											</div>
											<div class="ml-auto"> <i class="fa fa-dollar text-white fs-30 mr-2 mt-2"></i> </div>
										</div>
									</div>
								</div>
							</div><!-- COL END -->
							<div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
								<div class="card bg-primary img-card box-primary-shadow">
									<div class="card-body">
										<div class="d-flex">
											<div class="text-white">
												<h2 class="mb-0 number-font">
													<?php 
														if($totayCollection != NULL){
															echo $totayCollection;
														}else{
															echo '0';
														}
													?>
												</h2>
												<p class="text-white mb-0">Today Collection</p>
											</div>
											<div class="ml-auto"> <i class="fa fa-cart-plus text-white fs-30 mr-2 mt-2"></i> </div>
										</div>
									</div>
								</div>
							</div><!-- COL END -->
							<div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
								<div class="card bg-warning img-card box-warning-shadow">
									<div class="card-body">
										<div class="d-flex">
											<div class="text-white">
												<h2 class="mb-0 number-font">
													<?php 
														if($todayExpenses != NULL){
															echo $todayExpenses;
														}else{
															echo '0';
														}
													?>
												</h2>
												<p class="text-white mb-0">Today Expenses</p>
											</div>
											<div class="ml-auto"> <i class="fa fa-cart-plus text-white fs-30 mr-2 mt-2"></i> </div>
										</div>
									</div>
								</div>
							</div><!-- COL END -->
							
							<div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
								<div class="card bg-danger img-card box-danger-shadow">
									<div class="card-body">
										<div class="d-flex">
											<div class="text-white">
												<h2 class="mb-0 number-font">
													<?php 
														if($totalDueOffline != NULL){
															echo $totalDueOffline;
														}else{
															echo '0';
														}
													?>
												</h2>
												<p class="text-white mb-0">Today Offline Supply Due</p>
											</div>
											<div class="ml-auto"> <i class="fa fa-cart-plus text-white fs-30 mr-2 mt-2"></i> </div>
										</div>
									</div>
								</div>
							</div><!-- COL END -->
						</div>
					</div>
				</div>
				<!-- CONTAINER END -->
            </div>

			

			<!-- FOOTER -->
			<footer class="footer">
				<div class="container">
					<div class="row align-items-center flex-row-reverse">
						<div class="col-md-12 col-sm-12 text-center">
							Copyright © 2023 <a href="#">Water-Pro</a>. Designed by <a href="#">  Octa Codes Technologies </a> All rights reserved.
						</div>
					</div>
				</div>
			</footer>
			<!-- FOOTER END -->
		</div>

		<!-- BACK-TO-TOP -->
		<a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>

		<!-- JQUERY JS -->
		<script src="<?php echo base_url(); ?>assets/js/jquery-3.4.1.min.js"></script>

		<!-- BOOTSTRAP JS -->
		<script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/popper.min.js"></script>

		<!-- SPARKLINE JS-->
		<script src="<?php echo base_url(); ?>assets/js/jquery.sparkline.min.js"></script>

		<!-- Moment js-->
        <script src="<?php echo base_url(); ?>assets/plugins/moment/moment.min.js"></script>

		<!-- CHART-CIRCLE JS-->
		<script src="<?php echo base_url(); ?>assets/js/circle-progress.min.js"></script>

		<!-- RATING STARJS -->
		<script src="<?php echo base_url(); ?>assets/plugins/rating/jquery.rating-stars.js"></script>

		<!-- CHARTJS CHART JS-->
		<script src="<?php echo base_url(); ?>assets/plugins/chart/Chart.bundle.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/chart/utils.js"></script>

		<!-- FLOT CHART JS -->
		<script src="<?php echo base_url(); ?>assets/plugins/jquery.flot/jquery.flot.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/jquery.flot/jquery.flot.pie.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/jquery.flot/jquery.flot.resize.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/chart.flot.sampledata.js"></script>

		<!-- PIETY CHART JS-->
		<script src="<?php echo base_url(); ?>assets/plugins/peitychart/jquery.peity.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/peitychart/peitychart.init.js"></script>

		<!-- ECHART JS-->
		<script src="<?php echo base_url(); ?>assets/plugins/echarts/echarts.js"></script>

		<!-- SIDE-MENU JS-->
		<script src="<?php echo base_url(); ?>assets/plugins/sidemenu/sidemenu.js"></script>

		<!-- CUSTOM SCROLLBAR JS-->
		<script src="<?php echo base_url(); ?>assets/plugins/p-scroll/perfect-scrollbar.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/p-scroll/p-scroll.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/p-scroll/p-scroll-1.js"></script>

		<!-- SELECT2 JS -->
		<script src="<?php echo base_url(); ?>assets/plugins/select2/select2.full.min.js"></script>

		<!-- DATEPICKER JS -->
		<script src="<?php echo base_url(); ?>assets/plugins/date-picker/spectrum.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/date-picker/jquery-ui.js"></script>

		<!-- SIDEBAR JS -->
		<script src="<?php echo base_url(); ?>assets/plugins/sidebar/sidebar.js"></script>

		<!-- APEXCHART JS -->
		<script src="<?php echo base_url(); ?>assets/js/apexcharts.js"></script>

		<!-- INDEX JS -->
		<script src="<?php echo base_url(); ?>assets/js/index1.js"></script>

		<!-- Switcher js -->
		<script src="<?php echo base_url(); ?>assets/switcher/js/switcher.js"></script>

		<!-- CUSTOM JS -->
		<script src="<?php echo base_url(); ?>assets/js/custom.js"></script>

	</body>

<!-- Mirrored from www.spruko.com/demo/flaira/Flaira/LTR/Leftmenu-Icon-Light-Sidebar/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 13 Jan 2023 11:30:40 GMT -->
</html>
<?php 
$this->session->unset_userdata('msg');
?>