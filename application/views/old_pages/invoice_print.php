<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//print_r($items);exit;
$fmt = new NumberFormatter('en_IN', NumberFormatter::CURRENCY);
?>
<style type="text/css">
	th,td{
		padding: 10px;
    border:1px solid #000;
	}
  thead {display: table-header-group;}
  tfoot {display: table-header-group;}
</style>
  <div class="container-fluid">
    <div class="card card-primary card-outline">
       <div class="card-header no-print">
          <div class="pull-right no-print">
              <button onclick="window.print()" class="btn btn-danger"><i class="fa fa-print"></i> Print</button>
          </div>
      </div> <!-- /.card-body -->
      <div class="card-body">
			  <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                   <h4 style="text-align:center"><u><?= $title?></u></h4>

                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-6 invoice-col">
                  <strong><u>Consignor Details:</u></strong><br>
                  <b>GSTIN : </b>08AABFC2155P1ZA<br>
                  <b>PAN : </b> AABFC2155P<br>
                  <b>State : </b> Rajasthan <b>State Code :</b> 08<br>
                  <b> INVOICE No :</b><?= $invoice_no?>  <stong class="float-right"> <b>Date: </b><?= date('d-m-Y',strtotime($invoice_data['0']['transaction_date'])) ?></strong>
                </div>
               <div class="col-sm-2 invoice-col">
                </div>
                <div class="col-sm-4 invoice-col">
                 <b>  <img src="<?= base_url()?>/uploads/square_box.png" height="25" width="25"/> (ORIGINAL FOR BUYER)</b><br>
                 <b>  <img src="<?= base_url()?>/uploads/square_box.png" height="25" width="25"/> (EXTRA COPY FOR BUYER)</b><br>
                 <b>  <img src="<?= base_url()?>/uploads/square_box.png" height="25" width="25"/> (DUPLICATE FOR TRANSPORTER</b><br>
                 <b> <img src="<?= base_url()?>/uploads/square_box.png" height="25" width="25"/>  (TRIPLICATE FOR CONSIGNOR)</b><br>
                  <b> <img src="<?= base_url()?>/uploads/square_box.png" height="25" width="25"/>  (EXTRA COPY-CONSIGNOR)</b><br>
                </div>
              </div><br>
              <!-- /.row -->
              <table style="width:100%;">
              <tr>
                <td style="width:40%;border-bottom: #fff;">
                  <b>Shipping Address Consigner:</b><br>
                  <?= $invoice_data['0']['prefix']?> <?= $invoice_data['0']['c_name']?> ,<?= $invoice_data['0']['shipping_address']?> <br>
                  <b>State Code :</b> <?php 
                  if(!empty($invoice_data['0']['c_gst_no'])){
                    $state_code=substr($invoice_data['0']['c_gst_no'], 0, 2);
                    echo $state_code;
                  }else{
                      echo 'NA';
                  }
                  ?> <br> 
                  <b>GSTIN : </b><?= $invoice_data['0']['c_gst_no']?> <hr>
                  <b>Billing Address/Buyer:</b> <br>
                 <?= $invoice_data['0']['prefix']?> <?= $invoice_data['0']['c_name']?>, <?= $invoice_data['0']['billing_address']?><br>
                  <b>GSTIN :</b> <?= $invoice_data['0']['c_gst_no']?> 
                  <hr> 
                  <b>Buyer's PAN :</b> <?= $invoice_data['0']['c_pan']?><br> 
                </td>
                <td style="width:60%;border-bottom: #fff;"> 
                  <b>Document Through : </b><br>
                  <b>Freight  : </b>
                  <?= $invoice_data['0']['frieght_status']?>
                <!--   <img src="<?= base_url()?>/uploads/square_box.png" height="25" width="25"> To Pay 
                  <img src="<?= base_url()?>/uploads/square_box.png" height="25" width="25"> Paid  --><br>
                  <b> Transporter : </b>  <?= $invoice_data['0']['transporter_name']?> &nbsp; &nbsp; 
                  <b> G.R. No:</b>  <?= $invoice_data['0']['gr_no']?><br> 
                  <b>Date : </b> <?= date('d-m-Y',strtotime($invoice_data['0']['transaction_date'])) ?> &nbsp; &nbsp;
                  <b>Truck No : </b> <?= $invoice_data['0']['truck_no']?><br> 
                  <b>Destination : </b> <?= $invoice_data['0']['destination']?><br>
                  <!-- <?php 
                  $voucher_no=$invoice_data['0']['vendor_code'];
                  if($voucher_no<10){
                    $vendor_code='CUS000'.$voucher_no;
                    }
                    else if(($voucher_no>=10) && ($voucher_no<=99)){
                      $vendor_code='CUS00'.$voucher_no;
                    }
                    else if(($voucher_no>=100) && ($voucher_no<=999)){
                      $vendor_code='CUS'.$voucher_no;
                    }
                    else{
                      $vendor_code='CUS'.$voucher_no;
                    }
                  ?> -->
                  <b> Vendor Code No : </b><?= $vendor_code?><br>
                  <b> Order No :</b>  <?= $invoice_data['0']['po_no']?><br>
                  <b> Date : </b> <?= date('d-m-Y',strtotime($invoice_data['0']['po_date'])) ?><br>
                  <b>Buyer Item Code No :</b> <?= $invoice_data['0']['buyer_item_code']?> <br>
                  <medium>Packing in new PP Woven bags of 50/25 kgs,capacity each 
                    Weight of empty bag <100 gms Laminated/Non-laminated /Liner.
                  </medium>
                </td>
              </tr>
              </table>

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th style="border:1px solid #000;">S.NO.</th>
                      <th style="border:1px solid #000;">DESCRIPTION</th>
                      <th style="border:1px solid #000;">HSN CODE</th>
                      <th style="border:1px solid #000;">No. of Bags</th>
                      <th style="border:1px solid #000;">QTY(MT)</th>
                      <th style="border:1px solid #000;">RATE/MT</th>
                      <th style="border:1px solid #000;">AMOUNT</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=1;foreach($invoice_data['0']['invoice_details'] as $invoice_details) { ?>
	                    <tr>
	                      <td><?= $i ?></td>
	                      <td>
	                      	<label> <?= $invoice_details['mineral_name']?></label><br>
	                      	Grade: <?= $invoice_details['grade_name']?> <br>
	                      	Lot no: <?= $invoice_details['lot_no']?><br>
	                      	Batch No : <?= $invoice_details['batch_no']?><br>
                          Packing Size :<?= $invoice_details['packing_size']?>Kg
	                      </td>
	                      <td><?= $invoice_details['hsn_code']?></td>
                        <td><?= $invoice_details['no_of_bags']?></td>
                        <td><?= $invoice_details['quantity']?></td>
	                      <td><?php echo $fmt->formatCurrency($invoice_details['rate'], "INR");?></td>
	                      <td>
                          <?php echo $fmt->formatCurrency($invoice_details['amount'], "INR");?>
                          </td>
	                    </tr>
	                <?php $i++;} ?>
                   </tbody>
                   <tfoot>
                      <tr>
                          <td colspan="3"></td>
                          <td colspan="3"><b>Total Taxable Value </b> </td>
                          <td> <?php echo $fmt->formatCurrency($invoice_data['0']['total_amount'], "INR");?></td>
                      </tr>
                    <?php  if($invoice_data['0']['type_of_tax']=='Other') { ?>
                      <tr>
                        <td colspan="2">
                          <b>Remarks : </b><?= $invoice_data['0']['remarks'] ?>
                        </td>0
                        <td colspan="2">
                        <b> Way Bill No :</b> <?= $invoice_data['0']['way_billno'] ?><br>
                        <b> TP No : </b><?= $invoice_data['0']['tp_no'] ?>
                        </td>
                        <td colspan="2">
                         <b>Add Tax </b><span style="font-weight: 400">(CGST  <?= $invoice_data['0']['tax_per_cgst']?> %) </span></td>
                        <td colspan="2">
                        <?php echo $fmt->formatCurrency($invoice_data['0']['cgst_amount'], "INR");?>
                        </td>
                      </tr>
                      <tr>
                        <td colspan="4">
                          <b> Laboratory Test Report No: </b> <?= $invoice_data['0']['test_report_no'] ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                          <b> Date : </b> <?= date('d-m-Y',strtotime($invoice_data['0']['testing_date'])) ?><br>
                          <b>Report Sending Status : </b><?= $invoice_data['0']['report_sending_status'] ?> 
                        </td>
                        <td colspan="2">
                        <b> Add Tax</b> <span style="font-weight: 400">(SGST  <?= $invoice_data['0']['tax_per_sgst']?> %) </span></td>
                        <td colspan="2">
                          <?php echo $fmt->formatCurrency($invoice_data['0']['sgst_amount'], "INR");?>                
                        </td>
                      </tr>
                       <tr>
                        <td colspan="4"> </td>
                         <td colspan="2"><b>Total Tax</b></td>
                        <td colspan="2">
                          <?php 
                            $total_tax=$invoice_data['0']['cgst_amount']+$invoice_data['0']['sgst_amount'];
                            echo $fmt->formatCurrency($total_tax, "INR");?>
                        </td>
                      </tr> 
                    <?php } else { ?>
                       <tr>
                        <td colspan="2">
                          <b>Remarks : </b><?= $invoice_data['0']['remarks'] ?>
                        </td>
                        <td colspan="">
                        <b> Way Bill No :</b> <?= $invoice_data['0']['way_billno'] ?><br>
                        <b> TP No : </b><?= $invoice_data['0']['tp_no'] ?>
                        </td>
                        <td colspan="3">
                         <b>Add Tax </b><span style="font-weight: 400">(IGST <?= $invoice_data['0']['tax_per_igst']?>%) </span></td>
                        <td colspan="2">
                        <?php echo $fmt->formatCurrency($invoice_data['0']['igst_amount'], "INR");?>
                        </td>
                      </tr>
                       <tr>
                        <td colspan="3">
                          <b> Laboratory Test Report No: </b> <?= $invoice_data['0']['test_report_no'] ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                          <b> Date : </b> <?= date('d-m-Y',strtotime($invoice_data['0']['testing_date'])) ?><br>
                          <b>Report Sending Status : </b><?= $invoice_data['0']['report_sending_status'] ?> 
                        </td>
                        <td colspan="3">
                          <b>Total Tax</b>
                        </td>
                        <td colspan="2">
                          <?php echo $fmt->formatCurrency($invoice_data['0']['igst_amount'], "INR");?>
                        </td>
                      </tr>
                    <?php } ?>
                      <tr>
                        <td colspan="3"> </td>
                         <td colspan="3"><b> GRAND TOTAL</b></td>
                        <td colspan="2">
                          <?php echo $fmt->formatCurrency($invoice_data['0']['grand_total'], "INR");?>
                        </td>
                      </tr>
                      <tr>
                        <td colspan="7">
                        <b> Amount in words : <span style="text-transform: capitalize;"> <?= $amount_in_words?> Only </span></b></td>
                      </tr>
                      <tr>
                        <td colspan="2"> <b> <u>Prepared By : </u></b><!--  <br></br><br><br><?= $invoice_data['0']['creater'] ?> --></td>
                        <td colspan="2"> <b> <u>Chekced By : </u></b></td>
                        <td colspan="3"> <b> <u>For Choudhary & Company : </u></b><br></br><br><br>
                          <b>( Authorised Signatory)</b>
                        </td>
                      </tr>
                      <tr>
                        <td colspan="4"> <b> <u>Note : </u></b> <br>
                          <ul>
                            <li> Material once dispatched will not be taken back.</li>
                            <li> All transit risk are on buyer's account.</li>
                            <li> Our responsibility ceases once goods are handed over to carrier.</li>
                            <li> Proper care has been taken on choosing HSN code.</li>
                            <li> Subject to Udaipur Jurisdiction only.</li>
                          </ul>
                          <b> Declaration : </b> We declare that this invoice shows the actual price of the goods described and that all particulars are true and correct to the best of our knowledge.
                        </td>
                        <td colspan="3"></td>
                        </td>
                      </tr>
                   </tfoot>
                  </table>
                </div>
                <!-- /.col -->
              </div>
            </div>
		</div>
	</div>
</div>

<script src="<?php echo base_url()."assets/"; ?>plugins/jquery/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    moneyFormat(x){
      //var x=3300000.00;
      x=x.toString();
      var lastThree = x.substring(x.length-3);
      var otherNumbers = x.substring(0,x.length-3);
      if(otherNumbers != '')
          lastThree = ',' + lastThree;
      var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
     // alert(res);
    }
    
  });
</script>
