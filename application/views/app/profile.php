<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Water-Pro</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend/css/'); ?>bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend/css/'); ?>fontawesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend/css/'); ?>solid.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend/css/'); ?>brands.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend/css/'); ?>style.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>bower_components/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
    <style>
        .dashBoardBtnDiv a{
            display:block;
            margin-top:20px;
            margin-bottom:20px;
            padding:15px;
            font-size:18px;
            color:#fff !important;
        }
        
        .userDetail{
            padding:10px;
        }
        .userDetail img{
            width:100px;
            height:100px;
            border-radius:60px;
            border:5px solid #01c3ff;
            overflow:hidden;
            margin-top:20px;
        }
        .userDetail h2{
            color:#000;
            margin:0px;
        }
        .list{
            padding:15px;
        }
        .list ul{
            padding-left:0px;
        }
        .list ul li{
            list-style:none;
            padding:10px;
            border-bottom:1px solid #ccc;
        }
        .list ul li a{
            color:#000 !important;
            font-size:17px;
        }
        .customBtn{
            background:#01c3ff;
            color:#fff;
        }
    </style>
</head>
<body>

    <?php include('header2.php'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 p-0">
                <div class="text-center userDetail">
                    <?php 
                        if($driver['driver_image'] != ''){
                            ?>
                            <img src="<?php echo base_url('uploads/driver/'.$driver['driver_image']); ?>">
                            <?php
                        }else{
                            ?>
                            <img src="<?php echo base_url('assets/frontend/img/user.png'); ?>">
                            <?php
                        }
                    ?>
                    
                    
                    <h2><?php echo $driver['driver_name']; ?></h2>
                    <h4><?php echo $driver['mobileno']; ?></h4>
                </div>
                <div class="list">
                    <ul>
                        <li>
                            <a href="<?php echo base_url('app/dashboard'); ?>"><i class="fas fa-home"></i>&nbsp; Home</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('app/customerList'); ?>"><i class="fas fa-user-plus"></i>&nbsp; Add Customer</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('app/searchArea'); ?>"><i class="fas fa-truck"></i>&nbsp;Supply</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('app/supplyOffline'); ?>"><i class="fas fa-truck"></i>&nbsp;Supply Offline</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('app/offlineSupplyReport'); ?>"><i class="fas fa-truck"></i>&nbsp;Offline Supply Report</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('app/customerReport'); ?>"><i class="fas fa-file"></i>&nbsp; Customer Report</a>
                        </li>
                    </ul>
                </div>
                <div class="text-center">
                    <a href="<?php echo base_url('login/logout'); ?>" class="btn btn-md customBtn">LOGOUT</a>
                </div>
            </div>
        </div>
    </div>
    <?php include('footer.php'); ?>