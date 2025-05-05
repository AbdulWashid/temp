

<!--app-content open-->
<div class="app-content">
    <div class="side-app">

        <!-- PAGE-HEADER -->
        <div class="page-header">
            <ol class="breadcrumb"><!-- breadcrumb -->
                <li class="breadcrumb-item"><a href="#">Expenses</a></li>
                <li class="breadcrumb-item active" aria-current="page">Expenses List</li>
            </ol><!-- End breadcrumb -->
            <div class="ml-auto">
                <div class="input-group">
                    
                    <a href="<?php echo base_url('admin/expenses/add'); ?>" class="btn btn-primary button-icon mr-3 mt-1 mb-1">
                        <span><i class="fe fe-user"></i>Add Expenses</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- ROW-1 OPEN -->
        <div class="row">
            
            <div class="col-md-12">

            <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Search</h3>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo base_url('admin/expenses/list'); ?>" method="POST">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="from_date">From Date</label>
                                        <input type="date" name="from_date" value="<?php echo $from_date ?>" class="form-control" id="from_date" max="<?php echo date('Y-m-d'); ?>">
                                        <span class="text-danger"><?php echo form_error('from_date'); ?></span>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="to_date">To Date</label>
                                        <input type="date" name="to_date" value="<?php echo $to_date ?>" class="form-control" id="to_date" max="<?php echo date('Y-m-d'); ?>">
                                        <span class="text-danger"><?php echo form_error('to_date'); ?></span>
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
                        <h3 class="mb-0 card-title">Expenses List</h3>
                    </div>
                    <div class="card-body">
                        <?php 
                            if(!empty($this->session->flashdata('delmsg'))){
                                echo $this->session->flashdata('delmsg');
                            }
                        ?>
                       <div class="table-responsive">
                            <table id="report_list" class="table table-striped table-bordered text-nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Expenses Head</th>
                                        <th>Detail</th>
                                        <th>Expense Amount</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
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
    $(document).ready(function(){  
        var from_date = "<?php echo $from_date; ?>";
        var to_date = "<?php echo $to_date; ?>";
        var dataTable = $('#report_list').DataTable({  
            "dom": 'lBfrtip',
            "processing":true,  
            "serverSide":true,
            "lengthMenu": [[25, 100, -1], [25, 100, "All"]],  
            "pageLength": 25,
            "order":[],  
            "ajax":{  
                url:"<?php echo base_url('admin/expenses/getExpensesReport'); ?>",  
                type:"POST",
                data: {from_date: from_date,to_date: to_date}
            },  
            "columnDefs":[  
                {  
                    "targets":[3],  
                    "orderable":true,  
                },  
            ],  
            
        });  
    });
</script>
</body>

</html>


<?php 
$this->session->unset_userdata('msg');
?>