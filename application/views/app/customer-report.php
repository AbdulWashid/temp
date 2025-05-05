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
    <link href="<?php echo base_url(); ?>assets/plugins/select2/select2.min.css" rel="stylesheet"/>
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
            padding:4px 3px 4px 10px;
            font-size:10px;
        }
    </style>
</head>
<body>

    <?php include('header2.php'); ?>
    <!-- Supply More List -->
    <div class="modal" id="myModal" style="">
        <div class="modal-dialog" style="margin-left:15px;margin-top:90px;width:330px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Supply More</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered" width="100%">
                        <thead>
                            <tr>
                                <td>क्र.</td>
                                <td>तारीख</td>
                                <td>टंकी भरी</td>
                                <td>टंकी खाली</td>
                                <td>स्टॉक</td>
                            </tr>
                        </thead>
                        <tbody class="viewMoreTbl"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Supply More List -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 p-0">
                <div class="text-center">
                    <h4 style="margin-top:15px;">Customer Report</h4>
                </div>
                <form method="POST" action="<?php echo base_url('app/customerReport'); ?>" style="margin-top:20px;">
                    <?php 
                        if($this->session->flashdata('msg')){
                            echo $this->session->flashdata('msg'); 
                        } 
                    ?>
                    <div class="row">
                        <div class="col-12" style="padding:3px !important;">
                            <div class="form-group">
                                <label for="customer_id">Select Customer</label>
                                <select name="customer_id" id="customer_id" class="form-control select2-show-search">
                                    <option value="">Select</option>
                                    <?php 
                                        if(!empty($customer_list)){
                                            foreach($customer_list as $value){
                                                if($value['customer_id'] == $customer_id){
                                                    echo '<option value="'.$value['customer_id'].'" selected>'.$value['customer_name'].'</option>';
                                                }else{
                                                    echo '<option value="'.$value['customer_id'].'">'.$value['customer_name'].'</option>';
                                                }
                                            }
                                        }
                                    ?>
                                </select>
                                <span class="text-danger"><?php echo form_error('customer_id'); ?></span>
                            </div>
                        </div>
                    </div>
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
                                        <td>अमाउंट</td>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $i = 1;
                                        foreach($customer_report as $value){
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo date('d-m-y',strtotime($value['supply_date'])); ?></td>
                                                <td><?php echo $value['tanki_bhari']; ?></td>
                                                <td><?php echo $value['tanki_khali']; ?></td>
                                                <td><?php echo $value['stock']; ?></td>
                                                <td><?php echo $value['amount']; ?></td>
                                                <td>
                                                    <a customer_id="<?php echo $value['customer_id']; ?>" supply_date="<?php echo $value['supply_date']; ?>" class="btn btn-primary btn-sm viewSupplyMore" style="padding:0px 5px;font-size:11px;" data-toggle="modal" data-target="#myModal"><i class="fas fa-eye"></i></a>
                                                </td>
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