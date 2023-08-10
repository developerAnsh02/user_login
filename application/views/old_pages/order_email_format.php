<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//print_r($items);exit;
//$fmt = new NumberFormatter('en_IN', NumberFormatter::CURRENCY);
setlocale(LC_MONETARY, 'en_IN');
//$amount = number_format($obj['grand_total'],2);
//echo $amount; 

?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title><?= $subject ?></title>
        <style type="text/css">
            p{
                text-color:#000;
                font-family: "Times New Roman","serif";
                font-size: 15px;
            }   
            h3{
                text-color:#000;
                font-family: "Times New Roman","serif";  
            } 
            th{
                /*background-color: #3683d6;*/
                background-color: #bab3dc;
                color:#fff;
                padding: 2px;
            }   
        </style>
    </head>
    <body>        

        <!-- <h3><?= $heading ?></h3> -->
        <p class="MsoNormal">
            Hello <?= $result['0']['c_name']?> ! <br>Greetings From Assignment In Need,<br>
            Thanks for Your Order. We have completed your order as per your requirements. Please find order details below and let us know if have any queries.<br><br></p>

        <table style="width:100%;border-collapse: collapse;">   
            <thead>
                <tr style="border: 1px solid black;">
                       <th style="border: 1px solid black;"> S.No.</th>
                       <th style="border: 1px solid black;"> Order ID</th>
                       <th style="border: 1px solid black;"> Order Type</th>
                       <th style="border: 1px solid black;"> Title</th>
                        <th style="border: 1px solid black;"> Time Period </th>
                        <th style="border: 1px solid black;"> Pages </th>
                       <th style="border: 1px solid black;"> Amount </th>
                </tr> 
            </thead>
            <tbody>

    <?php $i=1;foreach($result as $key=> $invoice_details) { ?>                         
        <tr style="border: 1px solid black;">
            <td style="border: 1px solid black;"><?= $i ?></td>
            <td style="border: 1px solid black;"><b> <?= $invoice_details['order_id']?></b></td>
            <td style="border: 1px solid black;"><b> <?= $invoice_details['typeofpaper']?></b></td>
            <td style="border: 1px solid black;"><?= $invoice_details['title']?></td>
            <td style="border: 1px solid black;"><?= $invoice_details['deadline']?></td>
            <td style="border: 1px solid black;"><?= $invoice_details['pages']?></td>
            <td style="border: 1px solid black;"><?php echo number_format($invoice_details['amount'],2);?> <?= $result['0']['payment_terms']?></td>
        </tr>                
        <?php $i++;} ?>             
    </tbody>
</table>
<br>
        <p class="MsoNormal"> 
           <h3> <u>Bank Details are below</u> : </h3>
            <table style="width:50%;border-collapse: collapse;">   
            <thead>
                <?php if(!empty($result['0']['bank_details']['0']['bank_name'])) { ?>
                <tr style="border: 1px solid black;">
                   <th style="border: 1px solid black;"> Bank Name</th>
                   <td style="border: 1px solid black;"> <?= $result['0']['bank_details']['0']['bank_name'] ?></td>
                </tr>
            <?php } ?>
             <?php if(!empty($result['0']['bank_details']['0']['account_holder'])) { ?>
                <tr style="border: 1px solid black;">
                   <th style="border: 1px solid black;"> Account Holder</th>
                   <td style="border: 1px solid black;"> <?= $result['0']['bank_details']['0']['account_holder'] ?></td>
                </tr>
            <?php } ?>

             <?php if(!empty($result['0']['bank_details']['0']['bsb_code'])) { ?>
                <tr style="border: 1px solid black;">
                   <th style="border: 1px solid black;"> BSB Code</th>
                   <td style="border: 1px solid black;"> <?= $result['0']['bank_details']['0']['bsb_code'] ?></td>
                </tr>
            <?php } ?>
            <?php if(!empty($result['0']['bank_details']['0']['account_number'])) { ?>
                <tr style="border: 1px solid black;">
                   <th style="border: 1px solid black;"> Account Number </th>
                   <td style="border: 1px solid black;"> <?= $result['0']['bank_details']['0']['account_number'] ?></td>
                </tr>
            <?php } ?>
             <?php if(!empty($result['0']['bank_details']['0']['sort_code'])) { ?>
                <tr style="border: 1px solid black;">
                   <th style="border: 1px solid black;"> Sort Code</th>
                   <td style="border: 1px solid black;"> <?= $result['0']['bank_details']['0']['sort_code'] ?></td>
                </tr>
            <?php } ?>

            <?php if(!empty($result['0']['bank_details']['0']['bic_code'])) { ?>
                <tr style="border: 1px solid black;">
                   <th style="border: 1px solid black;"> BIC Code</th>
                   <td style="border: 1px solid black;"> <?= $result['0']['bank_details']['0']['bic_code'] ?></td>
                </tr>
            <?php } ?>
            <?php if(!empty($result['0']['bank_details']['0']['iban_no'])) { ?>
                <tr style="border: 1px solid black;">
                   <th style="border: 1px solid black;"> IBAN No</th>
                   <td style="border: 1px solid black;"> <?= $result['0']['bank_details']['0']['iban_no'] ?></td>
                </tr>
            <?php } ?>
            <?php if(!empty($result['0']['bank_details']['0']['ifsc_code'])) { ?>
                <tr style="border: 1px solid black;">
                   <th style="border: 1px solid black;"> IFS Code</th>
                   <td style="border: 1px solid black;"> <?= $result['0']['bank_details']['0']['ifsc_code'] ?></td>
                </tr>
            <?php } ?>
                
            </thead>
        </table>
    </p>
        <h3> <u>Your login details are below</u> : </h3>
        <p class="MsoNormal" > 
            <table style="width:75%;">
                 <thead>
                     <tr style="border: 1px solid black;">
                        <th style="padding: 15px;"><b>Username </b>: <label style="color:#fff;" ><?= $result['0']['c_email']?> </label> </th>
                        <th style="padding: 15px;"> &nbsp;&nbsp;&nbsp;&nbsp; <b>Password </b>: user@123</th>
                    </tr>
                </thead>
                <tr >
                    <td colspan="2" >  For Login 
                        <a href="http://assignnmentinneed.com/terms/" style="font-weight: 600;font-size:17px;"> Click Here </a></td>
                </tr>
            </table>
           <!--  <b>Username </b>: <?= $result['0']['c_email']?> &nbsp; &nbsp; &nbsp; &nbsp;
            <b>Password </b>: user@123<br>
          For Login <a href="http://assignnmentinneed.com/terms/"> Click Here </a>
        </p> --> 
       
        <p class="MsoNormal"> 
                    <br><br>
                    Regards, <br>
                    Assignment In Need <br>
                    Website: https://www.assignnmentinneed.com <br>
                    Phone:  +44-7520626128  <br>
                    Email: order@assignnmentinneed.com <br>
                    </p>

        <p class="MsoNormal"><?= @$footer ?></p>
         

    </body>
</html>
