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
                    <h4 style="margin-top:15px;">Offline Supply Report</h4>
                </div>
                <form method="POST" action="<?php echo base_url('app/offlineSupplyReport'); ?>" style="margin-top:20px;">
                    <?php 
                        if($this->session->flashdata('msg')){
                            echo $this->session->flashdata('msg'); 
                        } 
                    ?>
                    
                    <div class="row">
                        <div class="col-6" style="padding:3px !important;">
                            <div class="form-group">
                                <label for="from_date">From Date</label>
                                <input type="date" name="from_date" class="form-control" value="<?php echo $from_date; ?>" id="from_date" max="<?php echo date('Y-m-d'); ?>">
                                <span class="text-danger"><?php echo form_error('from_date'); ?></span>
                            </div>
                        </div>
                        <div class="col-6" style="padding:3px !important;">
                            <div class="form-group">
                                <label for="to_date">To Date</label>
                                <input type="date" name="to_date" class="form-control" value="<?php echo $to_date; ?>" id="from_date" max="<?php echo date('Y-m-d'); ?>">
                                <span class="text-danger"><?php echo form_error('to_date'); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-block searchBtn" style="color:#fff;">Search</button>
                    </div>
                </form>
                <div>
                    <?php 
                        if(!empty($supply_report)){
                            ?>
                            <table class="table table-bordered reportTbl" width="100">
                                <thead>
                                    <tr>
                                        <td>क्र.</td>
                                        <td>तारीख</td>
                                        <td>टंकी भरी</td>
                                        <td>अमाउंट</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        
                                        $i = 1;
                                        foreach($supply_report as $value){
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo date('d-m-Y',strtotime($value['supply_date'])); ?></td>
                                                <td><?php echo $value['tanki_bhari']; ?></td>
                                                <td><?php echo $value['amount']; ?></td>
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