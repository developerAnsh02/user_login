<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->model('Invoice_model');
//print_r($items);exit;
//$fmt = new NumberFormatter('en_IN', NumberFormatter::CURRENCY);
?>
<style type="text/css">
	th,td{
		padding: 10px;
    border:1px solid #000;
	}
  thead {display: table-header-group;}
  tfoot {display: table-header-group;}
</style>
<?php  $data = $this->session->userdata('invoice'); ?>
  <div class="container-fluid">
    <div class="card card-primary card-outline">
       <div class="card-header no-print">
          
          <div class="pull-right no-print">
               <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Invoice/edit/<?php echo $invoice_data[0]['id']; ?>" >
                <button class="btn btn-primary"><i class="fa fa-edit"></i>Edit Form</button>
              </form>
          </div>

          <div class="pull-right">
              <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Invoice/form_submit/<?php echo $invoice_data[0]['id']; ?>" >
                <button class="btn btn-info"><i class="fa fa-paincil"></i>Final Submit </button>
              </form>
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
                  <b> INVOICE No :</b><?= $invoice_no?>  <stong class="float-right"> <b>Date: </b><?= date('d-m-Y',strtotime($data['transaction_date'])) ?></strong>
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
                <!-- <td style="width:40%;border-bottom: #fff;">
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
                </td> -->
                <td style="width:60%;border-bottom: #fff;"> 
                  <b>Document Through : </b><br>
                  <b>Freight  : </b>
                  <?= $data['frieght_status']?>
                <!--   <img src="<?= base_url()?>/uploads/square_box.png" height="25" width="25"> To Pay 
                  <img src="<?= base_url()?>/uploads/square_box.png" height="25" width="25"> Paid  --><br>
                  <b> Transporter : </b>  <?= $data['transporter_id']?> &nbsp; &nbsp; 
                  <b> G.R. No:</b>  <?= $data['gr_no']?><br> 
                  <b>Date : </b> <?= date('d-m-Y',strtotime($invoice_data['0']['transaction_date'])) ?> &nbsp; &nbsp;
                  <b>Truck No : </b> <?= $data['truck_no']?><br> 
                  <b>Destination : </b> <?= $data['destination']?><br>
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
                  <b> Vendor Code No : </b>vendor code<br>
                  <b> Order No :</b>  <?= $data['po_no']?><br>
                  <b> Date : </b> <?= date('d-m-Y',strtotime($data['po_date'])) ?><br>
                  <b>Buyer Item Code No :</b> <?= $data['buyer_item_code']?> <br>
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
                    <?php $i=1;foreach($data['detail'] as $invoice_details) { ?>
	                    <tr>
	                      <td><?= $i ?></td>
                        <td>
	                         <?php echo $this->Invoice_model->getFGmineralName($invoice_details['finish_good_id'])?>

                        </td>
                         <td>
                          <label> <?php echo $this->Invoice_model->getFGmineralName($invoice_details['finish_good_id']) ?></label><br>
                          Lot no: <?= $invoice_details['lot_no']?><br>
                          Batch No : <?= $invoice_details['batch_no']?><br>
                          Packing Size :<?= $invoice_details['packing_size']?>Kg
                        </td>

                        <td><?= $invoice_details['batch_no']?></td>
                        <td><?= $invoice_details['no_of_bags']?></td>
                        <td><?= $invoice_details['qty']?></td>
                        <td><?= $invoice_details['rate']?></td>
                        <td><?= $invoice_details['amount']?></td>

	                    </tr>
	                <?php $i++;} ?>
                   </tbody>
                  
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
