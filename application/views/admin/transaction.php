<style>
.table-responsive::-webkit-scrollbar {
    width: 8px;
}
.table-responsive::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 5px;
}
.table-responsive::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 5px;
}
.table-responsive::-webkit-scrollbar-thumb:hover {
    background: #555;
}
thead th {
    position: sticky;
    top: 0;
    z-index: 10;
}

</style>

<div class="app-content">
    <div class="side-app">
        <!-- PAGE-HEADER -->
        <div class="page-header">
            <ol class="breadcrumb"><!-- breadcrumb -->
                <!-- <li class="breadcrumb-item"><a href="#">Area</a></li> -->
                <li class="breadcrumb-item active" aria-current="page">Customer Report</li>
            </ol><!-- End breadcrumb -->
            
        </div>
        <!-- PAGE-HEADER END -->

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Search</h3>
                    </div>
                    <div class="card-body">
                        <form id="customerSearchForm">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="">Select Customer</label>
                                        <select name="customer_id" id="customer_id" class="form-control select2-show-search" required>
                                            <option value="">--Select--</option>
                                            <?php 
                                                foreach($customer_list as $value){
                                                    if($value['customer_id'] == $customer_id){
                                                        echo '<option value="'.$value['customer_id'].'" selected>'.$value['customer_name'].'</option>';
                                                    }else{
                                                        echo '<option value="'.$value['customer_id'].'">'.$value['customer_name'].'</option>';
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="from_date">From Date</label>
                                        <input type="date" name="from_date" value="" class="form-control" id="from_date">
                                        
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="to_date">To Date</label>
                                        <input type="date" name="to_date" value="" class="form-control" id="to_date">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <button type="submit" class="btn btn-success btn-md" style="margin-top:28px;">SEARCH</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0 card-title">Customer Report</h3>
                    </div>
                    <div class="card-body">
                       <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                            <table id="report_list" class="table table-striped table-bordered text-nowrap w-100">
                                <thead>
                                    <tr>
                                        <th class="bg-white">S.No.</th>
                                        <th class="bg-white">In</th>
                                        <th class="bg-white">Out</th>
                                        <th class="bg-white">balance</th>
                                        <th class="bg-white">Status</th>
                                        <th class="bg-white">Driver</th>
                                        <th class="bg-white">Date</th>
                                    </tr>
                                </thead>
                                <tbody id="report_data">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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

<!-- DATA TABLE JS-->
<script src="<?php echo base_url(); ?>assets/plugins/datatable/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatable/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatable/datatable.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatable/datatable-2.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatable/dataTables.responsive.min.js"></script>

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
$(document).ready(function() {
    $('#customerSearchForm').on('submit', function(e) {
        e.preventDefault(); // Prevent form from reloading the page

        var formData = $(this).serialize(); // Get all form fields

        $.ajax({
            url: "<?php echo base_url();?>/admin/transaction/get_report", // Change to your PHP processing file
            type: 'POST',
            data: formData,
            dataType: 'json',
            beforeSend: function() {
                $('#report_data').hide(); 
            },
            success: function(response) {
                $('#report_data').html(response.html).fadeIn();
            },
            error: function(xhr, status, error) {
                alert("Something went wrong. Please try again.");
            }
        });
    });
});
</script>


</body>

</html>

<?php 
$this->session->unset_userdata('msg');
?>
