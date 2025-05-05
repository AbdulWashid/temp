<style>
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
<div id="preloader">
  <img src="<?php echo base_url('assets/frontend/img/loader.gif'); ?>" width="80">
</div>
<header>
    <div class="row">
        <?php 
            if($back == 'Yes'){
                ?>
                <div class="col-2" style="padding-left:0px !important;">
                    <div class="backaero" style="font-size:20px;margin-top:6px;">
                        <button onclick="goBack()">
                            <i class="fas fa-arrow-left"></i>
                        </button>
                    </div>
                </div>
                <?php
            }
        ?>
        
        
        <div class="<?php echo $back == 'Yes' ? 'col-6':'col-8'; ?> p-0">
            <div>
                <a href="<?php echo base_url('app/dashboard'); ?>" class="appTitle">
                    <!-- <img src="<?php echo base_url('assets/frontend/img/logo.png'); ?>" width="10040"> -->
                    <h2 class="" style="font-size:20px;margin-top:10px;">WATER-PRO</h2>
                </a>
            </div>
        </div>
        <div class="col-4 p-0">
            <div>
                <ul class="headerList" style="float:right;">
                    <li>
                        <a href="<?php echo base_url('app/profile'); ?>" class="text-right" style="display:inline-block;margin-top:5px;font-size:20px;">
                            <i class="fas fa-user"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
<!-- The Modal -->
