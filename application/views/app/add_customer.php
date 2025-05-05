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
        .form-group{
            margin-bottom:7px !important;
        }
        .form-group label{
            font-size:13px;
            margin-bottom:3px;
        }
        .form-control{
            font-size:13px;
        }
        .text-danger p{
            font-size:13px;
            margin-bottom:0px;
        }
    </style>
</head>
<body>

    <?php include('header2.php'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 p-0">
                <div class="text-center">
                    <h4 style="margin-top:15px;">Add Customer</h4>
                </div>
                
                <div>
                    <form action="<?php echo base_url('app/addCustomer'); ?>" method="POST" class="addCustomerForm">
                        <div class="form-group">
                            <label class="form-label" for="area_id">Select Area</label>
                            <select name="area_id" id="area_id" class="form-control select2-show-search">
                                <option value="">Select</option>
                                <?php 
                                    foreach($area_list as $value){
                                        echo '<option value="'.$value['area_id'].'">'.$value['area_name'].'</option>';
                                    }
                                ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('area_id'); ?></span>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="customer_name">Customer Name</label>
                            <input type="text" class="form-control" name="customer_name" value="<?php echo set_value('customer_name'); ?>" placeholder="Customer Name">
                            <span class="text-danger"><?php echo form_error('customer_name'); ?></span>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="mobileno">Mobile Number</label>
                            <input type="number" class="form-control" name="mobileno" value="<?php echo set_value('mobileno'); ?>" placeholder="Mobile Number">
                            <span class="text-danger"><?php echo form_error('mobileno'); ?></span>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="type">Type</label>
                            <select name="type" id="type" class="form-control">
                                <option value="">Select Type</option>
                                <option value="1">Firm</option>
                                <option value="2">Indiviual</option>
                            </select>
                            <span class="text-danger"><?php echo form_error('type'); ?></span>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="kane_charge">Per Kane Charge</label>
                            <input type="number" class="form-control" name="kane_charge" value="<?php echo set_value('kane_charge'); ?>" placeholder="Per Kane Charge">
                            <span class="text-danger"><?php echo form_error('kane_charge'); ?></span>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="address">Address</label>
                            <input type="text" name="address" value="<?php echo set_value('address'); ?>" placeholder="Address" class="form-control">
                            <span class="text-danger"><?php echo form_error('address'); ?></span>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block btn-md addCustomerBtn2 mt-4">SAVE</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include('footer.php'); ?>