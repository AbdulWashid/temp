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
            margin-top:20px;
        }
        .collectAmountDiv{
            display:none;
            margin-top:10px;
        }
    </style>
</head>
<body>

    <?php include('header2.php'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 p-0">
                <div class="text-center">
                    <h4 style="margin-top:15px;">Select Supply Area</h4>
                </div>
                <form method="POST" action="<?php echo base_url('app/searchArea'); ?>" style="margin-top:20px;">
                    <?php 
                        if($this->session->flashdata('msg')){
                            echo $this->session->flashdata('msg'); 
                        } 
                    ?>
                    <div class="form-group">
                        <label for="supply_date">Select Supply Date</label>
                        <input type="date" name="supply_date" class="form-control" value="<?php echo date('Y-m-d'); ?>" id="supply_date" max="<?php echo date('Y-m-d'); ?>">
                        <span class="text-danger"><?php echo form_error('supply_date'); ?></span>
                    </div>
                    <div class="form-group">
                        <label for="loan_id">Select Area</label>
                        <select name="area_id" id="area_id" class="form-control select2-show-search">
                            <option value="">Select</option>
                            <?php 
                                if(!empty($area_list)){
                                    foreach($area_list as $value){
                                        echo '<option value="'.$value['area_id'].'">'.$value['area_name'].'</option>';
                                    }
                                }
                            ?>
                        </select>
                        <span class="text-danger"><?php echo form_error('area_id'); ?></span>
                    </div>
                    
                    <div class="text-center">
                        <button type="submit" class="btn btn-block searchBtn" style="color:#fff !important;">Search</button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
    <?php include('footer.php'); ?>