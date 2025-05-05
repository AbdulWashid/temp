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
        .table td, .table th{
            padding:4px 3px 4px 10px;
            font-size:12px;
        }
        .cmnInp{
            width:50px;
        }
    </style>
</head>
<body>

    <?php include('header2.php'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 p-0">
                <div class="text-center">
                    <h4 style="margin-top:15px;margin-bottom:10px;">Supply Edit</h4>
                </div>
                
                <div>
                    <div class="text-center">
                        <h6 style="color:#d10000;font-weight:bold;margin-bottom:15px;">Old Stock <?php echo date('d-m-Y',strtotime($previous['supply_date'])); ?> :- <?php echo $previous['stock']; ?> and amount is Rs. <?php echo $last_due_amount; ?> </h6>
                    </div>
                    <?php 
                    if(!empty($supply_list)){
                    $i = 1;
                    foreach($supply_list as $value){
                    ?>
                        <form action="<?php echo base_url('app/supplyReportEdit1/'.$customer_id.'/'.$supply_date); ?>" method="POST" class="addCustomerForm supplyeditForm">
                            <input type="hidden" name="old_stock" value="<?php echo $previous['stock']; ?>" id="old_stock">
                            <input type="hidden" name="old_dueamount" value="<?php echo $last_due_amount; ?>" id="last_due">

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped align-middle text-center">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>क्र.</th>
                                            <th>टंकी भरी</th>
                                            <th>टंकी खाली</th>
                                            <th>स्टॉक</th>
                                            <th>अमाउंट</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <?php echo $i; ?>
                                                <input type="hidden" name="sid" value="<?php echo $value['sid']; ?>">
                                            </td>
                                            <td>
                                                <input type="text" name="tanki_bhari" value="<?php echo $value['tanki_bhari']; ?>" class="form-control tankiBhari">
                                                <input type="hidden" value="<?php echo $value['per_kane_amt']; ?>" name="kanecharge" class="kanecharge">
                                            </td>
                                            <td>
                                                <input type="text" name="tanki_khali" value="<?php echo $value['tanki_khali']; ?>" class="form-control tankiKhali">
                                            </td>
                                            <td>
                                                <input type="text" name="stock" value="<?php echo $value['stock']; ?>" class="form-control" readonly style="opacity: 0.6;">
                                            </td>
                                            <td>
                                                <input type="text" name="amount" value="<?php echo $value['amount']; ?>" class="form-control tankiAmount">
                                            </td>
                                            <td>
                                                <button type="submit" class="btn btn-primary w-100 submitBtn" disabled>Supply Edit</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    <?php
                    $i++;
                    }
                    }
                    ?>
                    <p class="text-danger text-center error_con"></p>
                </div>
            </div>
        </div>
    </div>
    <?php include('footer.php'); ?>