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
                    <h4 style="margin-top:15px;">Offline Supply</h4>
                </div>
                
                <div>
                    <form action="<?php echo base_url('app/supplyOffline'); ?>" method="POST" class="addCustomerForm">
                        <div class="form-group">
                            <label class="form-label" for="tanki_bhari">टंकी भरी</label>
                            <input type="text" class="form-control" name="tanki_bhari" value="<?php echo set_value('tanki_bhari'); ?>" placeholder="टंकी भरी">
                            <span class="text-danger"><?php echo form_error('tanki_bhari'); ?></span>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="amount">अमाउंट</label>
                            <input type="number" class="form-control" name="amount" value="<?php echo set_value('amount'); ?>" placeholder="अमाउंट">
                            <span class="text-danger"><?php echo form_error('amount'); ?></span>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="pay_type">पेमेंट टाइप</label>
                            <select name="pay_type" id="pay_type" class="form-control">
                                <option value="">Select Type</option>
                                <option value="1" selected>केश</option>
                                <option value="2">बैंक</option>
                            </select>
                            <span class="text-danger"><?php echo form_error('type'); ?></span>
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-block btn-md addCustomerBtn2 mt-4">SUPPLY</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include('footer.php'); ?>