

<!--app-content open-->
<div class="app-content">
    <div class="side-app">

        <!-- PAGE-HEADER -->
        <div class="page-header">
            <ol class="breadcrumb"><!-- breadcrumb -->
                <li class="breadcrumb-item"><a href="#">Collection</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Collection</li>
            </ol><!-- End breadcrumb -->
            <div class="ml-auto">
                <div class="input-group">
                    
                    <a href="<?php echo base_url('admin/collection/list'); ?>" class="btn btn-primary button-icon mr-3 mt-1 mb-1">
                        <span><i class="fe fe-user"></i>Collection List</span>
                    </a>
                </div>
            </div>
        </div>
        <!-- PAGE-HEADER END -->

        <!-- ROW-1 OPEN -->
        <div class="row">
            <div class="col-md-5">
                
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0 card-title">Add Collection</h3>
                    </div>
                    <div class="card-body">
                        <?php 
                            if(!empty($this->session->flashdata('msg'))){
                                echo $this->session->flashdata('msg');
                            }
                        ?>
                        <form action="<?php echo base_url('admin/collection/add'); ?>" method="POST" class="collectionForm">
                            <div class="form-group">
                                <label class="form-label" for="detail">Select Customer</label>
                                <select name="customer_id" id="customer_id" class="form-control select2-show-search">
                                    <option value="">Select</option>
                                    <?php 
                                        foreach($customer_list as $value){
                                            echo '<option value="'.$value['customer_id'].'">'.$value['customer_name'].'</option>';
                                        }
                                    ?>
                                </select>
                                <span class="text-danger"><?php echo form_error('customer_id'); ?></span>
                                <div id="customer_due" style="margin-top:10px;font-weight:bold;color:red;"></div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="collect_amount">Collect Amount</label>
                                <input type="number" class="form-control" name="collect_amount" value="<?php echo set_value('collect_amount'); ?>" placeholder="Collect Amount">
                                <span class="text-danger"><?php echo form_error('collect_amount'); ?></span>
                            </div>
                            <button type="submit" class="btn btn-primary btn-md submitBtn">SUBMIT</button>
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
<script>
  $(document).ready(function(){
    $(document).on('change','#customer_id',function(){
        var base_url = '<?php echo base_url() ?>';
        var customer_id = $(this).val();
        $.ajax({
            url:base_url + 'admin/collection/getCustomerDue',
            type:'POST',
            data:{
                customer_id:customer_id
            },
            dataType: 'json', 
            success:function(res){
                if(res.status == 200){
                    $('#customer_due').html('Due Amount:-  ' + res.data.due_amount);
                }
            }
        });
    });
  });
  
</script>
<script>
    $(document).ready(function () {
        $(".collectionForm").submit(function () {
            $(".submitBtn").css("pointer-events","none");
        });
    });
</script>

</body>

</html>

<?php 
$this->session->unset_userdata('msg');
?>
