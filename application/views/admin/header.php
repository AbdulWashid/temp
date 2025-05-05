<!doctype html>
<html lang="en" dir="ltr">

<head>
		<!-- META DATA -->
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<!-- TITLE -->
		<title>Water Pro</title>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		
		<!-- BOOTSTRAP CSS -->
		<link href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

		<!-- STYLE CSS -->
		<link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet"/>
		<link href="<?php echo base_url(); ?>assets/css/skin-modes.css" rel="stylesheet"/>

		<!-- SIDE-MENU CSS -->
		<link href="<?php echo base_url(); ?>assets/css/sidemenu.css" rel="stylesheet">

		<!-- C3 CHARTS CSS -->
		<link href="<?php echo base_url(); ?>assets/plugins/charts-c3/c3-chart.css" rel="stylesheet"/>

		<!-- CUSTOM SCROLL BAR CSS--->
		<link href="<?php echo base_url(); ?>assets/plugins/p-scroll/perfect-scrollbar.css" rel="stylesheet"/>

		<!-- SELECT2 CSS -->
		<link href="<?php echo base_url(); ?>assets/plugins/select2/select2.min.css" rel="stylesheet"/>

        <!-- DATA TABLE CSS -->
        <link href="<?php echo base_url(); ?>assets/plugins/datatable/dataTables.bootstrap4.min.css" rel="stylesheet"/>

		<!--- FONT-ICONS CSS -->
		<link href="<?php echo base_url(); ?>assets/css/icons.css" rel="stylesheet"/>

		<!-- Switcher css -->
		<link  href="<?php echo base_url(); ?>assets/switcher/css/switcher.css" rel="stylesheet" id="switcher-css" type="text/css" media="all"/>
		<link  href="<?php echo base_url(); ?>assets/switcher/css/demo.css" rel="stylesheet"/>

		<!-- COLOR SKIN CSS -->
		<link id="theme" rel="stylesheet" type="text/css" media="all" href="<?php echo base_url(); ?>assets/colors/color1.css" />

	  </head>
	   <body class="app sidebar-mini Left-menu-Default  Sidemenu-left-icons">

		<!-- PAGE -->
		<div class="page">
			<div class="page-main">

				<!--APP-SIDEBAR-->
				<div class="app-header header-search-icon">
					<div class="header-style1">
						<a class="header-brand" href="<?php echo base_url(); ?>admin/dashboard">
							<img src="<?php echo base_url(); ?>assets/images/brand/logo.png" class="header-brand-img desktop-logo" alt="logo">
							<img src="<?php echo base_url(); ?>assets/images/brand/logo-1.png" class="header-brand-img mobile-logo" alt="logo">
						</a><!-- LOGO -->
						<a class="header-brand header-brand1" href="index.html">
							<img src="<?php echo base_url(); ?>assets/images/brand/logo-white.png" class="header-brand-img desktop-logo" alt="logo">
							<img src="<?php echo base_url(); ?>assets/images/brand/logo-1.png" class="header-brand-img mobile-logo" alt="logo">
						</a><!-- LOGO -->
					</div>
					<div class="app-sidebar__toggle" data-toggle="sidebar">
						<a class="open-toggle" href="#"><i class="fe fe-align-left"></i></a>
						<a class="close-toggle" href="#"><i class="fe fe-x"></i></a>
					</div>
					<div class="d-flex  ml-auto header-right-icons">
						
						<div class="dropdown d-md-flex">
							<a class="nav-link icon full-screen-link nav-link-bg">
								<i class="fe fe-minimize fullscreen-button"></i>
							</a>
						</div><!-- FULL-SCREEN -->
						
						
						<div class="dropdown profile-1">
							<a href="#" data-toggle="dropdown" class="nav-link pr-2 leading-none d-flex">
								<span>
									<img src="<?php echo base_url(); ?>assets/images/users/15.jpg" alt="profile-user" class="avatar  profile-user brround cover-image">
								</span>
							</a>
							<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
								<div class="drop-heading">
									<div class="text-center">
										<h5 class="text-dark mb-0">Water-Pro</h5>
										<small class="text-muted">Administrator</small>
									</div>
								</div>
								<div class="dropdown-divider m-0"></div>
								
								<a class="dropdown-item" href="login.html">
									<i class="dropdown-icon mdi  mdi-logout-variant"></i> Sign out
								</a>
							</div>
						</div>
						
					</div>
				</div>
				<!--APP-SIDEBAR-->

				<!--APP-SIDEBAR-->
				<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
				<aside class="app-sidebar">
					<div class="sidebar-user-settings">
						<div class="app-sidebar__user mb-4 mt-4">
							<div class="dropdown user-pro-body text-center">
								<a href="#" class="user-box">
									<div class="user-pic">
										<span class="avatar avatar-md brround cover-image" data-image-src="<?php echo base_url(); ?>assets/images/users/15.jpg">
											<span class="avatar-status bg-primary"></span><span class="avatar-border"></span>
										</span>
									</div>
									<div class="user-info">
										<h5 class=" mb-1 font-weight-bold text-dark">Water Pro</h5>
										<span class="text-muted app-sidebar__user-name text-sm">Administrator</span>
									</div>
								</a>
							</div>
						</div>
					</div>
					<ul class="side-menu">
						<li>
							<a class="side-menu__item" href="<?php echo base_url('admin/dashboard'); ?>"><span class="side-menu__label">Dashboard</span><i class="side-menu__icon fe fe-airplay"></i></a>
						</li>
						<li>
							<a class="side-menu__item" href="<?php echo base_url('admin/area/add'); ?>"><span class="side-menu__label">Area</span><i class="side-menu__icon fe fe-airplay"></i></a>
						</li>
						<li class="slide">
							<a class="side-menu__item" data-toggle="slide" href="#"><i class="angle fe fe-chevron-right"></i><span class="side-menu__label">Customers</span><i class="side-menu__icon fe fe-user-plus"></i></a>
							<ul class="slide-menu">
								<li><a href="<?php echo base_url('admin/customer/add'); ?>" class="slide-item"><i class="sidemenu-icon fe fe-chevrons-right"></i> Add Customer</a></li>
								<li><a href="<?php echo base_url('admin/customer/list'); ?>" class="slide-item"><i class="sidemenu-icon fe fe-chevrons-right"></i> Customer List</a></li>
							</ul>
						</li>
						<li class="slide">
							<a class="side-menu__item" data-toggle="slide" href="#"><i class="angle fe fe-chevron-right"></i><span class="side-menu__label">Drivers</span><i class="side-menu__icon fe fe-truck"></i></a>
							<ul class="slide-menu">
								<li><a href="<?php echo base_url('admin/driver/add'); ?>" class="slide-item"><i class="sidemenu-icon fe fe-chevrons-right"></i> Add Driver</a></li>
								<li><a href="<?php echo base_url('admin/driver/list'); ?>" class="slide-item"><i class="sidemenu-icon fe fe-chevrons-right"></i> Driver List</a></li>
							</ul>
						</li>
						<li>
							<a class="side-menu__item" href="<?php echo base_url('admin/report/list'); ?>"><span class="side-menu__label">Supply Report List</span><i class="side-menu__icon fe fe-airplay"></i></a>
						</li>
						<li>
							<a class="side-menu__item" href="<?php echo base_url('admin/report/customerReportEdit'); ?>"><span class="side-menu__label">Customer Report Edit</span><i class="side-menu__icon fe fe-airplay"></i></a>
						</li>
						<li>
							<a class="side-menu__item" href="<?php echo base_url('admin/report/offlineSupplyReport'); ?>"><span class="side-menu__label">Offline Supply Report</span><i class="side-menu__icon fe fe-airplay"></i></a>
						</li>
						<li class="slide">
							<a class="side-menu__item" data-toggle="slide" href="#"><i class="angle fe fe-chevron-right"></i><span class="side-menu__label">Collect Payment</span><i class="side-menu__icon fe fe-truck"></i></a>
							<ul class="slide-menu">
								<li><a href="<?php echo base_url('admin/collection/add'); ?>" class="slide-item"><i class="sidemenu-icon fe fe-chevrons-right"></i> Add Collection</a></li>
								<li><a href="<?php echo base_url('admin/collection/list'); ?>" class="slide-item"><i class="sidemenu-icon fe fe-chevrons-right"></i> Collection Report</a></li>
							</ul>
						</li>
						<li class="slide">
							<a class="side-menu__item" data-toggle="slide" href="#"><i class="angle fe fe-chevron-right"></i><span class="side-menu__label">Expenses</span><i class="side-menu__icon fe fe-truck"></i></a>
							<ul class="slide-menu">
								<li><a href="<?php echo base_url('admin/expenses/addExpenseHead'); ?>" class="slide-item"><i class="sidemenu-icon fe fe-chevrons-right"></i> Add Expenses Head</a></li>
								<li><a href="<?php echo base_url('admin/expenses/add'); ?>" class="slide-item"><i class="sidemenu-icon fe fe-chevrons-right"></i> Add Expenses</a></li>
								<li><a href="<?php echo base_url('admin/expenses/list'); ?>" class="slide-item"><i class="sidemenu-icon fe fe-chevrons-right"></i> Expenses Report</a></li>
							</ul>
						</li>
						<li>
							<a class="side-menu__item" href="<?php echo base_url('admin/transaction/index'); ?>"><span class="side-menu__label"> Customer report </span><i class="side-menu__icon fe fe-database"></i></a>
						</li>
						<li>
							<a class="side-menu__item" href="<?php echo base_url('admin/login/logout'); ?>"><span class="side-menu__label">Log Out</span><i class="side-menu__icon fe fe-power"></i></a>
						</li>
					</ul>
				</aside>
				<!--/APP-SIDEBAR-->

				<!-- Mobile Header -->
				<div class="mobile-header">
					<div class="container-fluid">
						<div class="d-flex">
							<div class="app-sidebar__toggle" data-toggle="sidebar">
								<a class="open-toggle" href="#"><i class="fe fe-align-left"></i></a>
								<a class="close-toggle" href="#"><i class="fe fe-x"></i></a>
							</div>
							<a class="header-brand" href="index.html">
								<img src="<?php echo base_url(); ?>assets/images/brand/logo.png" class="header-brand-img desktop-logo" alt="logo">
							</a>
							<a class="header-brand header-brand1" href="index.html">
								<img src="<?php echo base_url(); ?>assets/images/brand/logo-white.png" class="header-brand-img desktop-logo" alt="logo">
							</a><!-- LOGO -->
							<div class="d-flex order-lg-2 ml-auto header-right-icons">
								
								<div class="dropdown profile-1">
									<a href="#" data-toggle="dropdown" class="nav-link pr-2 leading-none d-flex">
										<span>
											<img src="<?php echo base_url(); ?>assets/images/users/15.jpg" alt="profile-user" class="avatar  profile-user brround cover-image">
										</span>
									</a>
									<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
										<div class="drop-heading">
											<div class="text-center">
												<h5 class="text-dark mb-0">Water-Pro</h5>
												<small class="text-muted">Administrator</small>
											</div>
										</div>
										<div class="dropdown-divider m-0"></div>
										
										<a class="dropdown-item" href="login.html">
											<i class="dropdown-icon mdi  mdi-logout-variant"></i> Sign out
										</a>
									</div>
								</div>
								
							</div>
						</div>
					</div>
				</div>
				<div class="mb-1 navbar navbar-expand-lg  responsive-navbar navbar-dark d-md-none bg-white">
					<div class="collapse navbar-collapse" id="navbarSupportedContent-4">
						<div class="d-flex order-lg-2 ml-auto">
							<div class="d-sm-flex">
								<a href="#" class="nav-link icon search-btn">
									<i class="fe fe-search"></i>
								</a>
								<div class="search-area">
									<div class="close-btn pull-right"><button class="btn"><i class="fe fe-x"></i></button></div>
									<form>
										<div class="row">
											<div class="input-group form-btn">
												<div class="input-group-append">
													<button class="btn" type="button" id="button-addon3"><i class="fa fa-search"></i></button>
												</div>
												<input type="text" class="form-control" placeholder="Search here..." aria-label="Recipient's username" aria-describedby="button-addon2">
											</div>
										</div>
									</form>
								</div>
							</div><!-- SEARCH -->
							<div class="dropdown d-md-flex">
								<a class="nav-link icon full-screen-link nav-link-bg">
									<i class="fe fe-maximize fullscreen-button"></i>
								</a>
							</div><!-- FULL-SCREEN -->
							
						</div>
					</div>
				</div>
				<!-- /Mobile Header -->