
<!--app-content open-->
<div class="app-content">
    <div class="side-app">

        <!-- PAGE-HEADER -->
        <div class="page-header">
            <ol class="breadcrumb"><!-- breadcrumb -->
                <li class="breadcrumb-item"><a href="#">Offline Supply Detail</a></li>
                <li class="breadcrumb-item active" aria-current="page">Report</li>
            </ol><!-- End breadcrumb -->
            
        </div>
        <!-- PAGE-HEADER END -->

        <!-- ROW-1 OPEN -->
        <div class="row">
            <div class="col-md-12 col-lg-12">
                
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Offline Supply Detail List</h3>
                        
                    </div>
                    <div class="card-body">
                        <?php 
                            if(!empty($this->session->flashdata('msg'))){
                                echo $this->session->flashdata('msg');
                            }
                        ?>
                        <div class="table-responsive">
                            <table id="report_list" class="table table-striped table-bordered text-nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>क्र.</th>
                                        <th>ड्राईवर का नाम</th>
                                        <th>भरी टंकी</th>
                                        <th>अमाउंट</th>
                                        <th>पेमेंट टाइप</th>
                                        <th>तारीख</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $i = 1;
                                        foreach($supply_list as $value){
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $value['driver_name']; ?></td>
                                                <td><?php echo $value['tanki_bhari']; ?></td>
                                                <td><?php echo $value['amount']; ?></td>
                                                <td>
                                                    <?php
                                                        if($value['pay_type'] == 1){
                                                            echo 'केश';
                                                        }else{
                                                            echo 'बैंक';
                                                        }
                                                    ?>
                                                </td>
                                                <td><?php echo date('d-m-Y',strtotime($value['supply_date'])); ?></td>
                                            </tr>
                                            <?php
                                            $i++;
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- TABLE WRAPPER -->
                </div>
                <!-- SECTION WRAPPER -->
            </div>
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
<!-- FOOTER CLOSED -->
</div>

<!-- BACK-TO-TOP -->
<a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>

<!-- JQUERY JS -->
<script src="<?php echo base_url(); ?>assets/js/jquery-3.4.1.min.js"></script>

<!-- BOOTSTRAP JS -->
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/popper.min.js"></script>

<!-- SPARKLINE JS-->
<script src="<?php echo base_url(); ?>assets/js/jquery.sparkline.min.js"></script>

<!-- CHART-CIRCLE JS-->
<script src="<?php echo base_url(); ?>assets/js/circle-progress.min.js"></script>

<!-- RATING STAR JS-->
<script src="<?php echo base_url(); ?>assets/plugins/rating/jquery.rating-stars.js"></script>

<!-- C3 CHART JS -->
<script src="<?php echo base_url(); ?>assets/plugins/charts-c3/d3.v5.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/charts-c3/c3-chart.js"></script>

<!-- INPUT MASK JS-->
<script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.mask.min.js"></script>
<!-- SIDE-MENU JS -->
<script src="<?php echo base_url(); ?>assets/plugins/sidemenu/sidemenu.js"></script>

<!-- CUSTOM SCROLL BAR JS-->
<script src="<?php echo base_url(); ?>assets/plugins/p-scroll/perfect-scrollbar.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/p-scroll/p-scroll.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/p-scroll/p-scroll-1.js"></script>

<!-- DATA TABLE JS-->
<script src="<?php echo base_url(); ?>assets/plugins/datatable/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatable/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatable/datatable.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatable/datatable-2.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatable/dataTables.responsive.min.js"></script>

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
    
    $(function(e) {
        $('#report_list').DataTable();
    });
    
</script>

</body>

</html>
<?php 
$this->session->unset_userdata('msg');
?>