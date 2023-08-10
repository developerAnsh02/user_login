<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//print_r($items);exit;
//$fmt = new NumberFormatter('en_IN', NumberFormatter::CURRENCY);
?>

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
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  <img src="<?= base_url()?>/uploads/assignment_logo.png" height="120" width="300"/>
                </div>
               <div class="col-sm-4 invoice-col">
                <h3 style="padding-top: 20px;"> Choudhary & Company </h3>
                </div>
                <div class="col-sm-4 invoice-col">
                <strong><u>Company Details:</u></strong><br>
                  <b>GSTIN : </b>08AABFC2155P1ZA<br>
                  <b>PAN : </b> AABFC2155P<br>
                  <!-- <b>State : </b> Rajasthan <b>State Code :</b> 08<br> -->
                  <b> Address : </b> B-133, Mewar Industrial Area (MIA), Madri, Transport Nagar, Udaipur, Rajasthan 313003.
                </div>
              </div>
              <br>
              <!-- Table row -->
                <div class="row">
                    <div class="col-12">
                      <table class="table">
                        <tbody>
                           <tr>
                            <th colspan="6"> <h4 style="text-align: center">Supplier's Personal details : </h4></th>
                          </tr>
                            <tr>
                            <th> Supplier Category : </th>
                            <td> <?= $current['category']?> </td>
                            <th> Registration Date : </th>
                            <td> <?= date('d-m-Y',strtotime($current['reg_date']))?> </td>
                          </tr>
                          <tr>
                            <th> Supplier Name : </th>
                            <td> <?= $current['supplier_name'].' ('.$vendor_code.')'?> </td>
                            <th> Contact Person : </th>
                            <td> <?= $current['prefix'].' '.$current['contact_person']?> </td>
                          </tr>
                          <tr>
                            <th> Email : </th>
                            <td> <?= $current['email']?> </td>
                            <th> Mobile Number : </th>
                            <td> <?= $current['mobile_no']?> </td>
                          </tr>
                          <tr>
                            <th> Website : </th>
                            <td> 
                              <?php if(!empty($current['website'])) { ?>
                              <?= $current['website']?>
                              <?php } else{ 
                                  echo "Not Available";
                                ?>
                              <?php } ?> 
                            </td>
                            <th> Category Of Approval : </th>
                            <td> <?= $current['category_of_approval']?> </td>
                          </tr>
                          <tr>
                            <th> PAN No : </th>
                            <td> <?= $current['pan_no']?> </td>
                            <th> GSTIN : </th>
                            <td> <?= $current['gst_no']?> </td>
                          </tr>
                          <tr>
                            <th> TAN No : </th>
                            <td> <?= $current['tds']?> </td>
                            <th> Country : </th>
                            <td> <?= $current['country']?> </td>
                          </tr>
                          <tr>
                            <th> State : </th>
                            <td> <?= $current['state']?> </td>
                            <th> City : </th>
                            <td> <?= $current['city']?> </td>
                          </tr>
                           <tr>
                            <th> Date Of Approval : </th>
                            <td> <?= date('d-m-Y',strtotime($current['date_of_approval']))?> </td>
                            <th> Date Of Next Evaluation : </th>
                            <td> <?= date('d-m-Y',strtotime($current['date_of_evalution']))?> </td>
                          </tr>
                          
                           <tr>
                            <th colspan=""> Address : </th>
                            <td colspan="4"> <?= $current['address']?>  </td>
                          </tr>
                            <tr>
                            <th colspan="4"> <h4 style="text-align: center">Supplier's Account details : </h4> </th>
                          </tr>
                         <tr>
                            <th>  Bank Name :</th>
                            <td> <?= $current['bank_name']?> </td>
                            <th> Branch : </th>
                            <td> <?= $current['branch_name']?> </td>
                          </tr>
                          <tr>
                            <th> IFSC : </th>
                            <td> <?= $current['ifsc_code']?> </td>
                             <th> Account Number : </th>
                            <td> <?= $current['account_no']?> </td>
                          </tr>
                         <tr><td colspan="4"> <br></td></tr>
                        </tbody>
                      </table>
                  </div>
                </div>
                 <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  <b> Declaration : </b> We declare that this copy shows the actual information of this supplier and that all particulars are true and correct to the best of our knowledge.
                </div>
               <div class="col-sm-4 invoice-col">
               <!--  <h3 style="padding-top: 20px;"> Choudhary & Company </h3> -->
                </div>
                <div class="col-sm-4 invoice-col">
                <strong><u>For Choudhary & Company :</u></strong>
                <br></br><br></br>

                   <b>( Authorised Signatory)</b>
                </div>
              </div>
                <!-- /.col -->
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
