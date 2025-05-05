<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body{
            -webkit-print-color-adjust:exact !important;
            print-color-adjust:exact !important;
        }
        .invoiceBack{
            width:848px;
            min-height:100px;
            margin-left:auto;
            margin-right:auto;
            border:2px solid blue;
            border-radius:10px;
        }
        .header{
            border-bottom:2px solid blue;
            padding:10px;
        }
        .headRight p{
            text-align:right;
            font-size:22px;
        }
        .headerMiddle{
            padding:10px;
        }
        .headerMiddle p{
            font-size:22px;
        }
        .headerEnd table{
            border-collapse:collapse;
        }
        .headerEnd table tr th{
            font-size:22px;
            border:2px solid blue;
        }
        .headerEnd table tr td{
            font-size:22px;
            border:2px solid blue;
            
            text-align:center;
            padding:2px;
        }
        .divFooter{
            padding:10px;
        }
        .divFooter p{
            font-size:22px;
            margin:0px;
        }
    </style>
</head>
<body>
    <div class="invoiceBack">
        <div class="header">
            <table width="100%">
                <tr>
                    <td width="" style="display:flex; justify-content: center;">
                        <img src="<?php echo base_url('assets/images/brand/logo.png'); ?>" width="20%" style="">
                    </td>
                    
                </tr>
            </table>
        </div>
        
        
        <div class="headerEnd">
            <table width="100%" >
                <thead>
                    <tr>
                        <th width="40%">दिनांक</th>
                        <th width="10%">भरी</th>
                        <th width="10%">खाली</th>
                        <th width="20%">अमाउंट</th>
                        <th width="20%">स्टॉक</th>
                        
                    </tr>
                </thead>
                <tbody>
                    
                    <?php
                        foreach ($data as $key => $value) {
                            ?>
                            <tr>
                                <td><?php echo date('d-M-Y',strtotime($value->supply_date)) ?></td>
                                <td><?php echo $value->tanki_bhari; ?></td>
                                <td><?php echo $value->tanki_khali; ?></td>
                                <td><?php echo $value->amount; ?></td>
                                <td><?php echo $value->stock; ?></td>
                            </tr>
                            <?php
                        }
                    ?>
                    <!-- <tr valign="top">
                        <td></td>
                        <td width="70%">
                            <span>पानी केन</span>
                        </td>
                        <td>
                            <span><?php //echo $receipt['collect_amount']; ?></span>
                            <p style="margin-top:300px;border-bottom:2px solid blue;padding-bottom:10px;height:35px;">योग :- <?php echo $receipt['collect_amount']; ?></p>
                            <p>बाकि :- <?php //echo $receipt['balance']; ?></p>
                        </td>
                    </tr> -->
                </tbody>
            </table>
        </div>
        
    </div>
</body>
</html>
<?php 
$this->session->unset_userdata('msg');
?>