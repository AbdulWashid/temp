

<!--app-content open-->
<div class="app-content">
    <div class="side-app">

        <!-- PAGE-HEADER -->
        <div class="page-header">
            <ol class="breadcrumb"><!-- breadcrumb -->
                <li class="breadcrumb-item"><a href="#">Customer</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Customer</li>
            </ol><!-- End breadcrumb -->
            <div class="ml-auto">
                <div class="input-group">
                    
                    <a href="<?php echo base_url('admin/customer/list'); ?>" class="btn btn-primary button-icon mr-3 mt-1 mb-1">
                        <span><i class="fe fe-user"></i>Customers List</span>
                    </a>
                </div>
            </div>
        </div>
        <!-- PAGE-HEADER END -->

        <!-- ROW-1 OPEN -->
        <div class="row">
            <div class="col-md-12">
                
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0 card-title">Edit Customer</h3>
                    </div>
                    <div class="card-body">
                        <?php 
                            if(!empty($this->session->flashdata('msg'))){
                                echo $this->session->flashdata('msg');
                            }
                        ?>
                        <form action="<?php echo base_url('admin/customer/edit/'.$edit['customer_id']); ?>" method="POST">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="area_id">Select Area</label>
                                        <select name="area_id" id="area_id" class="form-control">
                                            <option value="">Select</option>
                                            <?php 
                                                foreach($area_list as $value){
                                                    if($edit['area_id'] == $value['area_id']){
                                                        echo '<option value="'.$value['area_id'].'" selected>'.$value['area_name'].'</option>';
                                                    }else{
                                                        echo '<option value="'.$value['area_id'].'">'.$value['area_name'].'</option>';
                                                    }
                                                    
                                                }
                                            ?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('area_id'); ?></span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="customer_name">Customer Name</label>
                                        <input type="text" class="form-control" name="customer_name" value="<?php echo $edit['customer_name']; ?>" placeholder="Customer Name">
                                        <span class="text-danger"><?php echo form_error('customer_name'); ?></span>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="mobileno">Mobile Number</label>
                                        <input type="number" class="form-control" name="mobileno" value="<?php echo $edit['mobileno']; ?>" placeholder="Mobile Number">
                                        <span class="text-danger"><?php echo form_error('mobileno'); ?></span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="type">Type</label>
                                        <select name="type" id="type" class="form-control">
                                            <option value="">Select Type</option>
                                            <option value="1" <?php echo $edit['type'] == '1' ? 'selected':''; ?>>Firm</option>
                                            <option value="2" <?php echo $edit['type'] == '2' ? 'selected':''; ?>>Home</option>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('type'); ?></span>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="kane_charge">Per Kane Charge</label>
                                        <input type="number" class="form-control" name="kane_charge" value="<?php echo $edit['kane_charge']; ?>" placeholder="Per Kane Charge">
                                        <span class="text-danger"><?php echo form_error('kane_charge'); ?></span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="address">Address</label>
                                        <input type="text" name="address" value="<?php echo $edit['address']; ?>" placeholder="Address" class="form-control">
                                        <span class="text-danger"><?php echo form_error('address'); ?></span>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-md">SUBMIT</button>
                        </form>
                    </div>
                </div>
            </div><!-- COL END -->
            
            
        </div>
        <!-- ROW-1 CLOSED -->
    </div>
</div>
<!-- CONTAINER CLOSED -->
</div>


<!-- FOOTER -->
<footer class="footer">
<div class="container">
    <div class="row align-items-center flex-row-reverse">
        <div class="col-md-12 col-sm-12 text-center">
            Copyright © 2023 <a href="#">Water-Pro</a>. Designed by <a href="#">  Octa Codes Technologies </a> All rights reserved.
        </div>
    </div>
</div>
</footer>
<!-- FOOTER END -->
</div>

<!-- BACK-TO-TOP -->
<a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>

<!-- JQUERY JS -->
<script src="<?php echo base_url(); ?>assets/js/jquery-3.4.1.min.js"></script>

<!-- BOOTSTRAP JS -->
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/popper.min.js"></script>

<!-- RATING STAR JS-->
<script src="<?php echo base_url(); ?>assets/plugins/rating/jquery.rating-stars.js"></script>

<!-- CHARTJS CHART JS-->
<script src="<?php echo base_url(); ?>assets/plugins/chart/Chart.bundle.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/chart/utils.js"></script>

<!-- C3 CHART JS -->
<script src="<?php echo base_url(); ?>assets/plugins/charts-c3/d3.v5.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/charts-c3/c3-chart.js"></script>

<!-- INPUT MASK JS-->
<script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.mask.min.js"></script>

<!-- CUSTOM SCROLLBAR JS-->
<script src="<?php echo base_url(); ?>assets/plugins/p-scroll/perfect-scrollbar.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/p-scroll/p-scroll.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/p-scroll/p-scroll-1.js"></script>

<!-- SIDE-MENU JS-->
<script src="<?php echo base_url(); ?>assets/plugins/sidemenu/sidemenu.js"></script>

<!-- SIDEBAR JS -->
<script src="<?php echo base_url(); ?>assets/plugins/sidebar/sidebar.js"></script>

<!-- FILE UPLOADES JS -->
<script src="<?php echo base_url(); ?>assets/plugins/fileuploads/js/fileupload.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/fileuploads/js/file-upload.js"></script>

<!-- SELECT2 JS -->
<script src="<?php echo base_url(); ?>assets/plugins/select2/select2.full.min.js"></script>

<!-- BOOTSTRAP-DATERANGEPICKER JS -->
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-daterangepicker/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

<!-- TIMEPICKER JS -->
<script src="<?php echo base_url(); ?>assets/plugins/time-picker/jquery.timepicker.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/time-picker/toggles.min.js"></script>

<!-- DATEPICKER JS -->
<script src="<?php echo base_url(); ?>assets/plugins/date-picker/spectrum.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/date-picker/jquery-ui.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.maskedinput.js"></script>

<!-- MULTI SELECT JS-->
<script src="<?php echo base_url(); ?>assets/plugins/multipleselect/multiple-select.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/multipleselect/multi-select.js"></script>

<!-- FORMELEMENTS JS -->
<script src="<?php echo base_url(); ?>assets/js/form-elements.js"></script>

<!-- Switcher js -->
<script src="<?php echo base_url(); ?>assets/switcher/js/switcher.js"></script>

<!-- CUSTOM JS -->
<script src="<?php echo base_url(); ?>assets/js/custom.js"></script>

</body>

</html>


<?php 
$this->session->unset_userdata('msg');
?>