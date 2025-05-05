    <script src="<?php echo base_url('assets/frontend/js/'); ?>jquery-3.6.0.min.js"></script>
    <script src="<?php echo base_url('assets/'); ?>bower_components/jquery-ui/jquery-ui.min.js"></script>
    <script src="<?php echo base_url('assets/frontend/js/'); ?>bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url('assets/'); ?>js/sweetalert2.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/select2/select2.full.min.js"></script>
    <script src="<?php echo base_url('assets/frontend/js/'); ?>fontawesome.min.js"></script>
    <script src="<?php echo base_url('assets/frontend/js/'); ?>otp.js"></script>
    <?php 
        if(!empty($this->session->flashdata('msg'))){
            if($this->session->flashdata('msg') == 'customerAdd'){
                ?>
                <script>
                    Swal.fire('Customer Added Successfully.', '', 'success').then( () => {
                        window.location.href = '<?php echo base_url('app/customerList'); ?>';
                    })
                </script>
                <?php
            }

            if($this->session->flashdata('msg') == 'offlineAdd'){
                ?>
                <script>
                    Swal.fire('Tanki Supply Successfully.', '', 'success').then( () => {
                        window.location.href = '<?php echo base_url('app/supplyOffline'); ?>';
                    })
                </script>
                <?php
            }

            if($this->session->flashdata('msg') == 'supplyEdit'){
                ?>
                <script>
                    Swal.fire('Record Edit Successfully.', '', 'success').then( () => {
                        window.location.reload();
                    })
                </script>
                <?php
            }

            

            
        }
        $this->session->unset_userdata('msg');
    ?>
    <script>  
        $(window).on('load', function() {
			$('#preloader').fadeOut('slow',function(){$(this).remove();});
		})
    </script>
    <!-- <script>
        $('.supplyeditForm :input').on('change', function() {
            $(this).closest('form').find('.submitBtn').prop('disabled', false);
        });
    </script> -->
    <script>
        $('#supplyEditForm :input').on('change', function() {
            $('#submitBtn').prop('disabled', false);
        });
    </script>
    <script>
        $('.select2').select2({
            minimumResultsForSearch: Infinity
        });
        
        $('.select2-show-search').select2({
            minimumResultsForSearch: ''
        });
    </script>
    <script>
    $(document).ready(function () {
        $(".supplyForm").submit(function () {
            $(".supplyBtn").css("pointer-events","none");
        });
        $(".supplyForm2").submit(function () {
            $(".supplyBtn2").css("pointer-events","none");
        });
        
        $(".addCustomerForm").submit(function () {
            $(".addCustomerBtn2").css("pointer-events","none");
        });

        $("input").click(function(){
            $(".supplyBtn").css("pointer-events","auto");
            $(".supplyBtn2").css("pointer-events","auto");
        });
        
    });
</script>
    <script>
        $(document).ready(function(){
            $(document).on("click",".supplyKaneBtn",function(e){
                e.preventDefault();
                var customer_id = $(this).attr('href');
                var stock = $(this).attr('stock');
                var due = $(this).attr('due');
                $('#customer_id').val(customer_id);
                //$('.tanki_khali').val(stock);
                $('.stackCount').html(stock);
                $('.dueAmount').html(due);
            });
            
            $(document).on("click",".supplyKaneBtn2",function(e){
                e.preventDefault();
                var customer_id = $(this).attr('href');
                var stock = $(this).attr('stock');
                var due = $(this).attr('due');
                $('#customer_id2').val(customer_id);
                //$('.tanki_khali').val(stock);
                $('.stackCount2').html(stock);
                $('.dueAmount2').html(due);
            });
        });

        $('#supplyFormId').submit(function(e){
            e.preventDefault();
            var me = $(this);
            $.ajax({
                url:me.attr('action'),
                type:'post',
                data:me.serialize(),
                dataType:'json',
                success:function(response){
                    if(response.success == true){
                        Swal.fire('Tanki Supply Successfully.', '', 'success').then( () => {
                            window.location.reload();
                        })
                    }else if(response.success == 'greater'){
                        Swal.fire('Thanki Khali Greater Stock', '', 'error');
                    }else if(response.success == 'greaterAmt'){
                        Swal.fire('Collect Amount Greater Due Amount', '', 'error');
                    }else if(response.success == 'previousDate'){
                        Swal.fire('Tanki Will not be supplied on the previous date.', '', 'error');
                    }else{
                        $.each(response.messages,function(key,value){
                            var element = $('#' + key);
                            element.closest('div.form-group')
                            .removeClass('has-error')
                            .addClass(value.length > 0 ? 'has-error' : 'has-success')
                            .find('.text-danger')
                            .remove();

                            element.after(value);
                        });
                    }
                }
                
            });
        });
        
        $('#supplyFormId2').submit(function(e){
            e.preventDefault();
            var me = $(this);
            $.ajax({
                url:me.attr('action'),
                type:'post',
                data:me.serialize(),
                dataType:'json',
                success:function(response){
                    if(response.success == true){
                        Swal.fire('Supply More Tanki Successfully.', '', 'success').then( () => {
                            window.location.reload();
                        })
                    }else if(response.success == 'greater'){
                        Swal.fire('Thanki Khali Greater Stock', '', 'error');
                    }else if(response.success == 'greaterAmt'){
                        Swal.fire('Collect Amount Greater Due Amount', '', 'error');
                    }else if(response.success == 'previousDate'){
                        Swal.fire('Tanki Will not be supplied on the previous date.', '', 'error');
                    }else{
                        $.each(response.messages,function(key,value){
                            var element = $('#' + key);
                            element.closest('div.form-group')
                            .removeClass('has-error')
                            .addClass(value.length > 0 ? 'has-error' : 'has-success')
                            .find('.text-danger')
                            .remove();

                            element.after(value);
                        });
                    }
                }
                
            });
        });

    </script>    
    
    <script>
        function goBack() {
            window.history.back();
        }
        function myFunction(type){
            var input, filter, ul, li, a, i, txtValue;
            
            if(type == 'non_sup'){
                input = document.getElementById("myInput");
                filter = input.value.toUpperCase();
                ul = document.getElementById("my_con");
                li = ul.getElementsByClassName("deliveryCard-nonsup");
                for (i = 0; i < li.length; i++) {
                    a = li[i].getElementsByTagName("strong")[0];
                    txtValue = a.textContent || a.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        li[i].style.display = "";
                    } else {
                        li[i].style.display = "none";
                    }
                }    
            }else{
                input = document.getElementById("myInput2");
                filter = input.value.toUpperCase();
                ul = document.getElementById("my_con2");
                li = ul.getElementsByClassName("deliveryCard-sup");
                
                for (i = 0; i < li.length; i++) {
                    a = li[i].getElementsByTagName("strong")[0];
                    txtValue = a.textContent || a.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        li[i].style.display = "";
                    } else {
                        li[i].style.display = "none";
                    }
                }  
            }
            
        }
    </script>

    <script>
        $(document).ready(function(){
            $(document).on("click",".viewSupplyMore",function(){
                var customer_id = $(this).attr("customer_id");
                var supply_date = $(this).attr("supply_date");
                $.ajax({
                    url:"<?php echo base_url('app/supplyMoreShow'); ?>",
                    type: "post",
                    dataType: 'json',
                    data: {customer_id:customer_id,supply_date:supply_date},
                    success:function(res){
                        if(res.response == '200'){
                            var srch = res.result;
                            html = '';
                            for(var i=0;i<srch.length;i++){
                                var inc = parseInt(i) + parseInt(1);
                                html += '<tr><td>'+inc+'</td><td>'+srch[i].supply_date+'</td><td>'+srch[i].tanki_bhari+'</td><td>'+srch[i].tanki_khali+'</td><td>'+srch[i].stock+'</td></tr>';
                            }
                            $('.viewMoreTbl').html(html);
                        }
                    }
                });
            });
            // $(document)
            // $(".edit_tbl > tbody > tr")
            $('.supplyeditForm').submit(function(){
                var old_stock = $('#old_stock').val();
                var bhari ;
                var khali ;
                var charge ;
                var amount ;
                var error = false;
                var row = 1;
                var last_due  =$('#last_due').val() ;
                var caneTotal=0;
                $('#my-tbody > tbody  > tr').each(function(index, tr) { 
                    bhari =  $(this).find("input.cmnInp.tankiBhari").val();
                    khali = $(this).find("input.cmnInp.tankiKhali").val();
                    amount = $(this).find("input.cmnInp.tankiAmount").val();
                    charge = $(this).find("input.cmnInp.kanecharge").val();
                    caneTotal = parseInt(bhari)*parseInt(charge);
                    last_due = parseInt(last_due)+parseInt(caneTotal);
                    
                    if(bhari=='' || khali=='' || amount==''){
                        $(".error_con").text("Field Required in row number "+row);
                        error = true;
                        return false;
                    }
                    if(parseInt(old_stock) < parseInt(khali)){
                        $(".error_con").text("Khali return is greater then last stock in row number "+row);
                        error = true;
                        $(".addCustomerBtn2").css({"pointer-events":""});
                        return false;
                    }
                    old_stock = parseInt(old_stock)+parseInt(bhari);
                    old_stock = parseInt(old_stock)-parseInt(khali);
                    $(this).find("input.cmnInp.stock").val(old_stock);
                    row++;
                    if(amount > last_due){
                        console.log(index);
                        $(".error_con").text("Collecting amount is greater then current due in row number "+row);
                        error = true;
                        $(".addCustomerBtn2").css({"pointer-events":""});
                        return false;
                    }
                    last_due  = last_due-amount;
                   
                    //alert(old_stock);

                });
                
                if(error){
                    $(".addCustomerBtn2").css({"pointer-events":""});
                    return false;
                }
                $(".addCustomerBtn2").css({"pointer-events":""});

                
                $('.supplyeditForm').submit();
                //$(".error_con").text("done");
                return false;
            })
        });
    </script>
</body>
</html>