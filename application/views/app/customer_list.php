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
    
</head>
<body>

    <?php include('header2.php'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 p-0">
                <div class="text-center">
                    <h4 style="margin-top:15px;">Customer List</h4>
                </div>
                
                <div>
                    <?php 
                        if(!empty($customer_list)){
                            foreach($customer_list as $value){
                                ?>
                                <div class="customerCard">
                                    <div class="row">
                                        <div class="col-6">
                                            <span>Customer Name:-</span>
                                        </div>
                                        <div class="col-6">
                                            <span><?php echo $value['customer_name']; ?></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <span>Area:-</span>
                                        </div>
                                        <div class="col-6">
                                            <span><?php echo $value['area_name']; ?></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <span>Mobile Number:-</span>
                                        </div>
                                        <div class="col-6">
                                            <span><?php echo $value['mobileno']; ?></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <span>Kane Charge:-</span>
                                        </div>
                                        <div class="col-6">
                                            <span><?php echo $value['kane_charge']; ?></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <span>Ad Date:-</span>
                                        </div>
                                        <div class="col-6">
                                            <span><?php echo date('d-m-Y',strtotime($value['created_at'])); ?></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <span>Status:-</span>
                                        </div>
                                        <div class="col-6">
                                            <span>
                                                <?php 
                                                    if($value['status'] == 0){
                                                        echo 'Un Approve';
                                                    }else{
                                                        echo 'Approve';
                                                    }
                                                ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        
                    ?>
                    <a href="<?php echo base_url('app/addCustomer'); ?>" class="addCustomerBtn">
                        <i class="fas fa-plus"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php include('footer.php'); ?>