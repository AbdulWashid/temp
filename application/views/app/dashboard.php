<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WATER PRO</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend/css/'); ?>bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend/css/'); ?>fontawesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend/css/'); ?>solid.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend/css/'); ?>brands.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend/css/'); ?>style.css">
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
    </style>
</head>
<body>
    <?php include('header2.php'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 p-0">
                <div class="dashBoardBtnDiv">
                    <div class="row">
                        <div class="col-6 pl-0 box1">
                            <div class="dashCard btn-success">
                                <h3>
                                    <?php 
                                        if($tankiBhariCount != NULL){
                                            echo $tankiBhariCount;
                                        }else{
                                            echo '0';
                                        }
                                    ?>
                                </h3>
                                <p class="m-0">टंकी भरी</p>
                            </div>
                        </div>
                        <div class="col-6 pr-0 box2">
                            <div class="dashCard btn-danger">
                                <h3>
                                    <?php 
                                        if($tankikhaliCount != NULL){
                                            echo $tankikhaliCount;
                                        }else{
                                            echo '0';
                                        }
                                    ?>
                                </h3>
                                <p class="m-0">टंकी खाली</p>
                            </div>
                        </div>
                        <div class="col-12 p-0">
                            <div class="dashCard btn-primary">
                                <h3>
                                    <?php 
                                        if($collectAmt != NULL){
                                            echo $collectAmt;
                                        }else{
                                            echo '0';
                                        }
                                    ?>
                                </h3>
                                <p class="m-0">अमाउंट जमा</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="delList">
                    <div>
                        <h5 style="margin-top:15px;font-weight:bold;">Today Supply</h5>
                    </div>
                    <?php 
                        if(!empty($delivery_list)){
                            foreach($delivery_list as $value){
                                ?>
                                <div class="deliveryCard">
                                    <div class="row">
                                        <div class="col-7 p-0">
                                            <strong><?php echo $value['customer_name']; ?></strong>
                                        </div>
                                        <div class="col-5 p-0">
                                            <span><?php echo date('d-m-Y',strtotime($value['supply_date'])); ?></span>
                                            <a href="<?php echo base_url('app/supplyReportEdit/'.$value['customer_id'].'/'.$value['supply_date']); ?>" class="btn btn-success btn-sm float-right" style="padding:0px 5px;font-size:12px;margin-top:-2px;">Edit</a>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-4 p-0">
                                            <span>टंकी भरी :- <?php echo $value['tanki_bhari']; ?></span>
                                        </div>
                                        <div class="col-4 p-0">
                                            <span>टंकी खाली :- <?php echo $value['tanki_khali']; ?></span>
                                        </div>
                                        <div class="col-4 p-0">
                                            <span>स्टॉक :- <?php echo $value['stock']; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                    ?>
                    
                </div>
                <div class="fixed-bottom">
                    <div class="row">
                        <div class="col-6 p-0">
                            <a href="<?php echo base_url('app/searchArea'); ?>" class="btn btn-success btn-block fixBtn">SUPPLY</a>
                        </div>
                        <div class="col-6 p-0">
                        <a href="<?php echo base_url('app/customerReport'); ?>" class="btn btn-danger btn-block fixBtn">REPORT</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('footer.php'); ?>