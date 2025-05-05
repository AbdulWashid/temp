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
        .searchBtn{
            background:#01c3ff;
            color:#fff;
            margin-top:10px;
        }
        .collectAmountDiv{
            display:none;
            margin-top:10px;
        }
        .form-group{
            margin-bottom:3px !important;
        }
        .form-group label{
            font-size:13px;
        }
        .form-control{
            font-size:13px;
        }
        .text-danger{
            font-size:12px;
        }
        .text-danger p{
            margin-bottom:0px;
        }
        .reportTbl{
            margin-top:25px;
        }
        .table td, .table th{
            padding:2px 3px 2px 10px;
            font-size:14px;
        }
    </style>
</head>
<body>

    <?php include('header2.php'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 p-0">
                <div class="text-center">
                    <h4 style="margin-top:15px;">Supply Detail</h4>
                </div>
                <div>
                    <h6 style="margin-top:15px;">Customer:- <?php echo $customer['customer_name']; ?></h6>
                </div>
                <div>
                    <?php 
                        if(!empty($customer_report)){
                            ?>
                            <table class="table table-bordered reportTbl" width="100">
                                <thead>
                                    <tr>
                                        <td>क्र.</td>
                                        <td>तारीख</td>
                                        <td>टंकी भरी</td>
                                        <td>टंकी खाली</td>
                                        <td>स्टॉक</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        
                                        $i = 1;
                                        foreach($customer_report as $value){
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo date('d-m-Y',strtotime($value['supply_date'])); ?></td>
                                                <td><?php echo $value['tanki_bhari']; ?></td>
                                                <td><?php echo $value['tanki_khali']; ?></td>
                                                <td><?php echo $value['stock']; ?></td>
                                            </tr>
                                            <?php
                                            $i++;
                                        }
                                    ?>
                                    
                                </tbody>
                            </table>
                            <?php
                        }
                    ?>
                    
                </div>
            </div>
        </div>
    </div>
    <?php include('footer.php'); ?>