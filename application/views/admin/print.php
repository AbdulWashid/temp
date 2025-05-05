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
            height:1200px;
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
            height:350px;
            text-align:center;
            padding:10px;
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
                    <td width="50%">
                        <img src="<?php echo base_url('assets/images/brand/logo.png'); ?>" width="100%">
                    </td>
                    <td width="50%">
                        <div class="headRight">
                            <p>6260409699<br>9827217361</p>
                            <p style="margin-top:0px;">14-बी इंडस्ट्रीय एरिया<br> नीमच (म.प्र.)</p>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        
        <div class="headerMiddle">
            <p><span style="display:inline-block;margin-right:50px;">क्रमांक</span><span style="display:inline-block;width:520px;"><?php echo $receipt['collect_id']; ?></span> <span>दिनांक </span><span style="border-bottom:2px solid blue;padding:0px 10px;"><?php echo date('d/m/Y',strtotime($receipt['collect_date'])); ?></span></p>
            <p><span>श्रीमान</span> <span style="display:inline-block;border-bottom:2px solid blue;padding:0px 10px;width:735px;">&nbsp;<?php echo $receipt['customer_name']; ?></span></p>
            <p><span>पता</span> <span style="display:inline-block;border-bottom:2px solid blue;padding:0px 10px;width:755px;">&nbsp;<?php echo $receipt['address']; ?></span></p>
        </div>
        <div class="headerEnd">
            <table width="100%" border="1">
                <thead>
                    <tr>
                        <th>क्र.</th>
                        <th>विवरण</th>
                        <!--
                        <th>नग</th>
                        <th>दर</th>
                        -->
                        <th>रकम</th>
                    </tr>
                </thead>
                <tbody>
                    <tr valign="top">
                        <td></td>
                        <td width="70%">
                            <span>पानी केन</span>
                        </td>
                        <!--
                        <td>
                            <span>&nbsp;</span>
                        </td>
                        <td>
                            <span>&nbsp;</span>
                            <p style="margin-top:300px;border-bottom:2px solid blue;padding-bottom:10px;height:35px;">योग</p>
                            <p>बाकि</p>
                        </td>
                        -->
                        <td>
                            <span><?php echo $receipt['collect_amount']; ?></span>
                            <p style="margin-top:300px;border-bottom:2px solid blue;padding-bottom:10px;height:35px;">योग :- <?php echo $receipt['collect_amount']; ?></p>
                            <p>बाकि :- <?php echo $receipt['balance']; ?></p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="divFooter">
            <p>भूल-चूक लेनी देनी |</p>
            <p>केन की टूट-फूट व गुम होने की जवाबदारी ग्राहक की होगी |</p>
            <div style="margin-top:20px;">
                <p><span>ह. ग्राहक</span> <span style="display:inline-block;width:250px;border-bottom:2px solid blue;"></span> <span style="display:inline-block;margin-left:400px;">हस्ताक्षर</span></p>
            </div>
        </div>
    </div>
</body>
</html>