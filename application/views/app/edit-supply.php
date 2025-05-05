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
                    <form action="<?php echo base_url('app/supplyReportEdit/'.$customer_id.'/'.$supply_date); ?>" method="POST" class="addCustomerForm supplyeditForm" id="supplyEditForm">
                        <div class="text-center">
                            <!-- <h6 style="color:#d10000;font-weight:bold;margin-bottom:15px;">Old Stock <?php echo date('d-m-Y',strtotime($previous['supply_date'])); ?> :- <?php echo $previous['stock']; ?> and amount is Rs. <?php echo $last_due_amount; ?> </h6> -->
                            <?php if (!empty($previous)) : ?>
                                <h6 style="color:#d10000;font-weight:bold;margin-bottom:15px;">
                                    Old Stock <?php echo date('d-m-Y', strtotime($previous['supply_date'])); ?> :- 
                                    <?php echo $previous['stock']; ?> and amount is Rs. 
                                    <?php echo $last_due_amount; ?>
                                </h6>
                            <?php else: ?>
                                <h6 style="color:#d10000;font-weight:bold;margin-bottom:15px;">
                                    No previous stock record found. Last due is Rs. <?php echo $last_due_amount; ?>
                                </h6>
                            <?php endif; ?>
                            
                        </div>
                        <!-- <input type="hidden" name="old_stock" value="<?php echo $previous['stock']; ?>" id="old_stock">
                        <input type="hidden" name="old_dueamount" value="<?php echo $last_due_amount; ?>" id="last_due"> -->
                        <input type="hidden" name="old_stock" value="<?php echo !empty($previous) ? $previous['stock'] : 0; ?>" id="old_stock">
                        <input type="hidden" name="old_dueamount" value="<?php echo $last_due_amount ?? 0; ?>" id="last_due">

                        <table class="table table-bordered edit_tbl" width="100%"  id="my-tbody">
                            <thead>
                                <tr>
                                    <th>क्र.</th>
                                    <th>टंकी भरी</th>
                                    <th>टंकी खाली</th>
                                    <th>स्टॉक</th>
                                    <th>अमाउंट</th>
                                </tr>
                            </thead>
                            <tbody id="">
                                
                                <?php 
                                    if(!empty($supply_list)){
                                        $i = 1;
                                        foreach($supply_list as $value){
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $i; ?>
                                                    <input type="hidden" name="sid[]" value="<?php echo $value['sid']; ?>">
                                                </td>
                                                <td class="bhari_tanki"><input type="text" name="tanki_bhari_<?php echo $value['sid']; ?>" value="<?php echo $value['tanki_bhari']; ?>" class="cmnInp tankiBhari">
                                                    <input type="hidden" value="<?php echo $value['per_kane_amt']; ?>" class="cmnInp kanecharge">
                                                </td>
                                                <td class="khali_tanki"><input type="text" name="tanki_khali_<?php echo $value['sid']; ?>" value="<?php echo $value['tanki_khali']; ?>" class="cmnInp tankiKhali"></td>
                                                <td><input type="text" name="stock_<?php echo $value['sid']; ?>" value="<?php echo $value['stock']; ?>" class="cmnInp stock" style="opacity:0.5;" readonly></td>
                                                <td class="tanki_amount"><input type="text" name="amount_<?php echo $value['sid']; ?>" value="<?php echo $value['amount']; ?>" class="cmnInp tankiAmount"></td>
                                            </tr>
                                            <?php
                                            $i++;
                                        }
                                    }
                                ?>
                                
                            </tbody>
                        </table>
                        <p class="text-danger text-center error_con"></p>
                        <button type="submit" id="submitBtn" class="btn btn-primary btn-block btn-md addCustomerBtn2 mt-4" disabled>Supply Edit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include('footer.php'); ?>