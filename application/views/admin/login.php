<!doctype html>
<html lang="en" dir="ltr">
<head>
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<!-- TITLE -->
		<title>Water-Pro</title>

		<!-- BOOTSTRAP CSS -->
		<link href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

		<!-- STYLE CSS -->
		<link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet"/>
		<link href="<?php echo base_url(); ?>assets/css/skin-modes.css" rel="stylesheet"/>

		<!-- SIDE-MENU CSS -->
		<link href="<?php echo base_url(); ?>assets/css/sidemenu.css" rel="stylesheet">

		<!-- SINGLE-PAGE CSS -->
		<link href="<?php echo base_url(); ?>assets/plugins/single-page/css/main.css" rel="stylesheet" type="text/css">

		<!--C3 CHARTS CSS -->
		<link href="<?php echo base_url(); ?>assets/plugins/charts-c3/c3-chart.css" rel="stylesheet"/>

		<!-- CUSTOM SCROLL BAR CSS-->
		<link href="<?php echo base_url(); ?>assets/plugins/p-scroll/perfect-scrollbar.css" rel="stylesheet"/>

		<!-- SELECT2 CSS -->
		<link href="<?php echo base_url(); ?>assets/plugins/select2/select2.min.css" rel="stylesheet"/>

		<!--- FONT-ICONS CSS -->
		<link href="<?php echo base_url(); ?>assets/css/icons.css" rel="stylesheet"/>

		<!-- Switcher css -->
		<link  href="<?php echo base_url(); ?>assets/switcher/css/switcher.css" rel="stylesheet" id="switcher-css" type="text/css" media="all"/>
		<link  href="<?php echo base_url(); ?>assets/switcher/css/demo.css" rel="stylesheet"/>

		<!-- COLOR SKIN CSS -->
		<link id="theme" rel="stylesheet" type="text/css" media="all" href="<?php echo base_url(); ?>assets/colors/color1.css" />

	</head>

	<body>

		<!-- BACKGROUND-IMAGE -->
		<div class="login-img">

			
			<!-- PAGE -->
			<div class="page h-100">
				<div class="">
				    <!-- CONTAINER OPEN -->
					<div class="col col-login mx-auto">
						<div class="text-center">
							<img src="<?php echo base_url(); ?>assets/images/brand/logo-white.png" height="100">
						</div>
					</div>
					<div class="container-login100">
						<div class="wrap-login100 p-6">
							<form class="login100-form" action="<?php echo base_url('/admin/login'); ?>" method="POST">
								<span class="login100-form-title">
									Login
								</span>
								<div class="wrap-input100">
									<input class="input100" type="text" name="email" placeholder="Email" autocomplete="off">
									<span class="focus-input100"></span>
									<span class="symbol-input100">
										<i class="zmdi zmdi-email" aria-hidden="true"></i>
									</span>
									<div class="text-danger"><?php echo form_error('email'); ?></div>
								</div>
								<div class="wrap-input100">
									<input class="input100" type="password" name="password" placeholder="Password" autocomplete="off">
									<span class="focus-input100"></span>
									<span class="symbol-input100">
										<i class="zmdi zmdi-lock" aria-hidden="true"></i>
									</span>
									<div class="text-danger"><?php echo form_error('password'); ?></div>
								</div>
								
								<div class="container-login100-form-btn">
									<button type="submit" class="login100-form-btn btn-primary">
										Login
									</button>
								</div>
								
							</form>
						</div>
					</div>
					<!-- CONTAINER CLOSED -->
				</div>
			</div>
			<!-- End PAGE -->

		</div>
		<!-- BACKGROUND-IMAGE CLOSED -->

		<!-- JQUERY JS -->
		<script src="<?php echo base_url(); ?>assets/js/jquery-3.4.1.min.js"></script>

		<!-- BOOTSTRAP JS -->
		<script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/popper.min.js"></script>

		<!-- SPARKLINE JS -->
		<script src="<?php echo base_url(); ?>assets/js/jquery.sparkline.min.js"></script>

		<!-- CHART-CIRCLE JS -->
		<script src="<?php echo base_url(); ?>assets/js/circle-progress.min.js"></script>

		<!-- RATING STAR JS -->
		<script src="<?php echo base_url(); ?>assets/plugins/rating/jquery.rating-stars.js"></script>

		<!-- INPUT MASK JS -->
		<script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.mask.min.js"></script>

		<!-- CUSTOM SCROLL BAR JS-->
		<script src="<?php echo base_url(); ?>assets/plugins/p-scroll/perfect-scrollbar.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/p-scroll/p-scroll.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/p-scroll/p-scroll-1.js"></script>

		<!-- SELECT2 JS -->
		<script src="<?php echo base_url(); ?>assets/plugins/select2/select2.full.min.js"></script>

		<!-- Switcher js -->
		<script src="<?php echo base_url(); ?>assets/switcher/js/switcher.js"></script>

		<!-- CUSTOM JS -->
		<script src="<?php echo base_url(); ?>assets/js/custom.js"></script>

	</body>

<!-- Mirrored from www.spruko.com/demo/flaira/Flaira/LTR/Leftmenu-Icon-Light-Sidebar/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 13 Jan 2023 11:30:53 GMT -->
</html>
