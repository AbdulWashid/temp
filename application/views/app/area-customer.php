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
    <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>css/sweetalert2.min.css">
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
        .supplyBtn{
            background:#01c3ff;
            color:#fff;
            margin-top:20px;
        }
        .supplyBtn2{
            background:#01c3ff;
            color:#fff;
            margin-top:20px;
        }
        .supplyForm .form-group{
            margin-bottom:7px !important;
            border-radius:0px;
            
        }
        .form-group label{
            font-size:13px;
            margin-bottom:0px;
        }
        .form-control{
            border:1px solid transparent;
            border-bottom:1px solid #000;
            font-size:13px;
        }
        .nav-tabs{
            border:none !important;
        }
        .nav-tabs li{
            width:50%;
            text-align:center;
        }
        .nav-tabs li a{
            display:inline-block;
            width:95%;
        }
        .supplyForm p{
            margin-bottom:0px !important;
        }
        .searchForm{
            position: relative;
            margin-bottom:20px;
        }
        .searchForm .form-control{
            border:1px solid #000 !important;
        }
        .searchForm button{
            position:absolute;
            background:none;
            border:none;
            right:5px;
            top:5px;
        }
        .swal2-popup{
            transform: scale(0.7) !important;
        }
    </style>
</head>
<body>
    <?php 
        $suppliedhtml = '';
        $nonsuppliedhtml = '';
        if(!empty($customer_list)){
            foreach($customer_list as $value){
                $result = $this->app_model->checkSupplied($value['customer_id'],$supply_date);
                if($result == true){
                    $suppliedhtml .= '<div class="deliveryCard deliveryCard-sup">
                                            <div class="row">
                                                <div class="col-8 p-0">
                                                    <strong style="display:inline-block;margin-top:2px;">'.$value['customer_name'].'</strong>
                                                </div>
                                                <div class="col-4 p-0">
                                                    <a class="btn btn-sm btn-success" style="padding:0px 5px;font-size:11px;"><i class="fas fa-check-circle"></i></a>
                                                    <a href="'.$value['customer_id'].'" stock="'.$value['kane_stock'].'" due="'.$value['due_amount'].'" class="btn btn-sm btn-danger supplyKaneBtn2" style="padding:0px 5px;font-size:11px;" data-toggle="modal" data-target="#myModal2"><i class="fas fa-plus"></i></a>
                                                    <a href="'.base_url('app/supplyDetail/'.$value['customer_id'].'/'.$supply_date).'" class="btn btn-sm btn-primary supplyDetail" style="padding:0px 5px;font-size:11px;"><i class="fas fa-eye"></i></a>
                                                    <!--<a href="'.$value['customer_id'].'" stock="'.$value['kane_stock'].'" due="'.$value['due_amount'].'" class="btn btn-sm btn-primary supplyKaneBtn2" style="padding:0px 5px;font-size:11px;" data-toggle="modal" data-target="#myModal2"><i class="fas fa-edit"></i></a>-->
                                                </div>
                                            </div>
                                        </div>';
                }else{
                    $nonsuppliedhtml .= '<div class="deliveryCard deliveryCard-nonsup">
                                            <div class="row">
                                                <div class="col-8 p-0">
                                                    <strong style="display:inline-block;margin-top:2px;">'.$value['customer_name'].'</strong>
                                                </div>
                                                <div class="col-4 p-0">
                                                    <a href="'.$value['customer_id'].'" stock="'.$value['kane_stock'].'" due="'.$value['due_amount'].'" class="btn btn-sm btn-primary btn-block supplyKaneBtn p-0" data-toggle="modal" data-target="#myModal">+ Add</a>
                                                </div>
                                            </div>
                                        </div>';
                }
                
            }
        }
    ?>
    <?php include('header2.php'); ?>
    <!-- Model -->
    <!-- Add Modal Start -->
    <div class="modal" id="myModal" style="">
        <div class="modal-dialog" style="margin-left:40px;margin-top:90px;width:280px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Supply</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <h6 style="color:red;font-weight:bold;">स्टॉक :- <span class="stackCount"></span></h6>
                        <h6 style="color:red;font-weight:bold;">अमाउंट बाकि :- <span class="dueAmount"></span></h6>
                    </div>
                    <form action="<?php echo base_url('app/supplyTanki'); ?>" class="supplyForm" id="supplyFormId">
                        <input type="hidden" name="customer_id" id="customer_id">
                        <input type="hidden" name="supply_date" value="<?php echo $supply_date; ?>">
                        <div class="form-group">
                            <label for="tanki_bhari">टंकी भरी</label>
                            <input type="number" name="tanki_bhari" id="tanki_bhari" value="0" class="form-control" placeholder="टंकी भरी" autofocus>
                        </div>
                        <div class="form-group">
                            <label for="tanki_khali">टंकी खाली</label>
                            <input type="number" name="tanki_khali" id="tanki_khali" value="0" class="form-control tanki_khali" placeholder="टंकी खाली">
                        </div>
                        <div class="form-group">
                            <label for="amount">अमाउंट</label>
                            <input type="number" name="amount" value="0" class="form-control" placeholder="अमाउंट">
                        </div>
                        <button type="submit" class="btn btn-block supplyBtn">SUPPLY</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Add Model End -->

    <!-- Supply More Model Start -->
    
    <div class="modal" id="myModal2">
        <div class="modal-dialog" style="margin-left:40px;margin-top:90px;width:280px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Supply More</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <h6 style="color:red;font-weight:bold;">स्टॉक :- <span class="stackCount2"></span></h6>
                        <h6 style="color:red;font-weight:bold;">अमाउंट बाकि :- <span class="dueAmount2"></span></h6>
                    </div>
                    <form action="<?php echo base_url('app/supplyMoreTanki'); ?>" class="supplyForm2" id="supplyFormId2">
                        <input type="hidden" name="customer_id" id="customer_id2">
                        <input type="hidden" name="supply_date" value="<?php echo $supply_date; ?>">
                        <div class="form-group">
                            <label for="tanki_bhari2">टंकी भरी</label>
                            <input type="number" name="tanki_bhari2" id="tanki_bhari2" value="0" class="form-control" placeholder="टंकी भरी" autofocus>
                        </div>
                        <div class="form-group">
                            <label for="tanki_khali">टंकी खाली</label>
                            <input type="number" name="tanki_khali" id="tanki_khali" value="0" class="form-control tanki_khali" placeholder="टंकी खाली">
                        </div>
                        <div class="form-group">
                            <label for="amount">अमाउंट</label>
                            <input type="number" name="amount" value="0" class="form-control" placeholder="अमाउंट">
                        </div>
                        <button type="submit" class="btn btn-block supplyBtn2">SUPPLY</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Supply More Model End -->

    <!-- View Supply -->

    <div class="modal" id="myModal3">
        <div class="modal-dialog" style="margin-left:40px;margin-top:90px;width:280px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tanki Supply List</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="tankiList"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- View Supply -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 p-0">
                
                <div class="delList">
                    <div>
                        <h5 style="margin-top:15px;font-weight:bold;text-align:center;"><?php echo $area['area_name']; ?></h5>
                        <h6 style="text-align:center;">(<?php echo date('d M Y' ,strtotime($supply_date)) ?>)</h6>
                    </div>
                    
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#home" class="btn btn-danger">Pending</a></li>
                        <li><a data-toggle="tab" href="#menu1" class="btn btn-success">Supply</a></li>
                    </ul>

                    <div class="tab-content" style="margin-top:20px;">
                        <div id="home" class="tab-pane fade in active show">
                            <div>
                                <form action="" class="searchForm">
                                    <input type="text" id="myInput" name="customer_name" onkeyup="myFunction('non_sup')" placeholder="Search Customer By Name" class="form-control" autocomplete="off">
                                    <button type="submit"><i class="fas fa-search"></i></button>
                                </form>
                            </div>
                            <div id="my_con">
                                <?php echo $nonsuppliedhtml; ?>
                            </div>
                        </div>
                        <div id="menu1" class="tab-pane fade">
                            <div>
                                <form action="" class="searchForm">
                                    <input type="text" id="myInput2" onkeyup="myFunction()"  name="customer_name" placeholder="Search Customer By Name" class="form-control" autocomplete="off">
                                    <button type="submit"><i class="fas fa-search"></i></button>
                                </form>
                            </div>
                            <div id="my_con2">
                                <?php echo $suppliedhtml; ?>    
                            </div>
                            
                        </div>
                    </div>
                    
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
    