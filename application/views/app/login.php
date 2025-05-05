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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
    <style>   
        body{
            background-image:url('<?php echo base_url('assets/frontend/img/background.jpg'); ?>');
            background-size:cover;
            background-position:fixed;
            background-repeat:no-repeat;
            height:100vh;
        } 
        .container-fluid{
            padding: 0px;
        }
        .row{
            margin:0px;
        }
        .loginDiv{
            padding:60px 15px;
            margin-top:50px;
        }
        h1{
            margin-top:20px;
            margin-bottom:20px;
        }
        .loginDiv form input{
            height:45px;
            padding:0px 20px;
        }
        #preloader {
            position: fixed;
            left: 0;
            top: 0;
            z-index: 10000;
            width: 100%;
            height: 100%;
            overflow: visible;
            background: #333333d6 no-repeat center center;
            align-items:center;
            justify-content:center;
            display:flex;
        }
    </style>
    <style>
        .passwordinp{
            position:relative;
        }
        .field_icon{
            position:absolute;
            top:15px;
            right:10px;
        }
    </style>
</head>
<body>
    <div id="preloader">
        <img src="<?php echo base_url('assets/frontend/img/loader.gif'); ?>" width="80">
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="loginDiv">
                    <div class="text-center">
                        <img src="<?php echo base_url('assets/frontend/img/logo.png'); ?>" width="300" style="margin-bottom:50px;">
                    </div>
                    <div>
                        <?php 
                            if($this->session->flashdata('msg')){
                                echo $this->session->flashdata('msg'); 
                            } 
                        ?>
                    </div>
                    <form method="POST" action="<?php echo base_url('login'); ?>">
                        <div class="form-group">
                            <input type="number" name="mobileno" class="form-control rounded-pill" id="mobileno" placeholder="Enter Mobile Number" autocomplete="off">
                            <span class="text-danger"><?php echo form_error('mobileno'); ?></span>
                        </div>
                        <div class="form-group passwordinp">
                            <input type="password" name="password" class="form-control rounded-pill" value="<?php echo set_value('password'); ?>" id="pass_log_id" placeholder="Enter Password" autocomplete="off">
                            <span toggle="#password-field" class="fa fa-fw fa-eye-slash field_icon toggle-password"></span>
                            <span class="text-danger"><?php echo form_error('password'); ?></span>
                        </div>
                        <input type="submit" name="submit" value="SIGN IN" class="btn rounded-pill btn-block btn-lg" style="background:#01c3ff;color:#fff;">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo base_url('assets/frontend/js/'); ?>jquery-3.6.0.min.js"></script>
    <script src="<?php echo base_url('assets/frontend/js/'); ?>bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url('assets/frontend/js/'); ?>fontawesome.min.js"></script>
    <script>  
        $(window).on('load', function() {
			$('#preloader').fadeOut('slow',function(){$(this).remove();});
		})
    </script>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
    <script>
        $("body").on('click', '.toggle-password', function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $("#pass_log_id");
            if (input.attr("type") === "password") {
            input.attr("type", "text");
            } else {
            input.attr("type", "password");
            }
    
        });
        $("body").on('click', '.toggle-password2', function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $("#cpass_log_id");
            if (input.attr("type") === "password") {
            input.attr("type", "text");
            } else {
            input.attr("type", "password");
            }
    
        });
    </script>
</body>
</html>