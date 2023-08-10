<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//print_r($po_data);exit;
?>
              <?php if ($this->session->flashdata('success')) : ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="btn-close" data-bs-dismiss="alert" class="btn-close" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
                <h3 class="text-success">
                    <i class="fa fa-check-circle"></i> Success
                </h3>
                <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('failed')) : ?>
            <div class="alert alert-warning alert-dismissible">
                <button type="button" class="btn-close" data-bs-dismiss="alert" class="btn-close" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
                <h3 class="text-warning">
                    <i class="fa fa-exclamation-triangle"></i> Warning
                </h3>
                <?php echo $this->session->flashdata('failed'); ?>
            </div>
        <?php endif; ?>
<div class="container-fluid">
  <div class="card card-primary card-outline">
    <div class="card-header">

      <span class="card-title"><?php  echo $title; ?>
      </span>
       <div class="button-group float-right">

         <a href="<?php echo base_url(); ?>index.php/Invoice/add" class="btn btn-success" data-toggle="tooltip" title="New Invoice"><i class="fa fa-plus"></i></a>

         <button class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="location.reload();"><i class="fa fa-refresh"></i></button>

          <button class="btn btn-danger delete_all" data-toggle="tooltip" title="Bulk Delete" ><i class="fa fa-trash"></i></button>
        
      </div>
    </div> <!-- /.card-body -->
    <div class="card-body">
      <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th><input type="checkbox" id="master"></th>
              <th >Sr.No.</th>
              <th style="white-space: nowrap;"> Invoice No </th>
              <th style="white-space: nowrap;"> Invoice Date </th>
              <th style="white-space: nowrap;"> Vendor Code</th>
              <th style="white-space: nowrap;"> Grand Total</th>
              <th style="white-space: nowrap;width: 20%;"> Action Button</th>
            </tr>
          </thead>
          <tbody>
           <?php
          $i=1;foreach($invoice_data as $obj){ ?>
              <tr>
                <td><input type="checkbox" class="sub_chk" value="<?php echo $obj['id']; ?>" /></td>
                <td><?php echo $i;?></td>
                <td>
                  <?php 
                         $inv_number=$obj['invoice_no'];
                          if($inv_number<10){
                            $inv_number1='CNC/A/000'.$inv_number;
                            }
                            else if(($inv_number>=10) && ($inv_number<=99)){
                              $inv_number1='CNC/A/00'.$inv_number;
                            }
                            else if(($inv_number>=100) && ($inv_number<=999)){
                              $inv_number1='CNC/A/0'.$inv_number;
                            }
                            else{
                              $inv_number1='CNC/A/'.$inv_number;
                            }
                            echo $inv_number1; ?>
                </td>
                <td ><?php echo date('d-M-Y',strtotime($obj['transaction_date'])); ?></td>
                <td>
                 
                     <?php 
                         $cus_number=$obj['vendor_code'];
                          if($cus_number<10){
                            $cus_number1='CUS000'.$cus_number;
                            }
                            else if(($cus_number>=10) && ($cus_number<=99)){
                              $cus_number1='CUS00'.$cus_number;
                            }
                            else if(($cus_number>=100) && ($cus_number<=999)){
                              $cus_number1='CUS0'.$cus_number;
                            }
                            else{
                              $cus_number1='CUS'.$cus_number;
                            }
                            echo $cus_number1; ?>
                  </td>
                <td>
                  <?php 
                $fmt = new NumberFormatter('en_IN', NumberFormatter::CURRENCY);
                echo $fmt->formatCurrency($obj['grand_total'], "INR");
                ?></td>
                <td >
                   <a class="btn btn-xs btn-info btnEdit" href="<?php echo base_url(); ?>index.php/Invoice/print_invoice/<?php echo $obj['id'];?>" ><i style="color:#fff;"class="fa fa-print"></i></a>

                  <!-- <a class="btn btn-xs btn-primary btnEdit" href="<?php echo base_url(); ?>index.php/Invoice/edit/<?php echo $obj['id'];?>"><i class="fa fa-edit"></i></a> -->
                  
                  <a class="btn btn-xs btn-danger btnEdit" data-toggle="modal" data-target="#delete<?php echo $obj['id'];?>"><i style="color:#fff;"class="fa fa-trash"></i></a>
                </td>
          
                    <div class="modal fade" id="delete<?php echo $obj['id'];?>" role="dialog">
                      <div class="modal-dialog">
                        <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Invoice/deleteInvoice/<?php echo $obj['id'];?>">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                             <h4 class="modal-title">Confirm Header </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                           
                          </div>
                          <div class="modal-body">
                            <p>Are you sure, you want to delete Invoice <b><?php echo $obj['invoice_no'];?> </b>? </p>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary ">Submit</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                        </form>
                      </div>
                    </div>
                    
              </tr>
            <?php  $i++;} ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<script src="<?php echo base_url()."assets/"; ?>plugins/jquery/jquery.min.js"></script>
<script type="text/javascript">
  $( document ).ready(function() {
     
    jQuery('#master').on('click', function(e) {
    if($(this).is(':checked',true))  
    {
      $(".sub_chk").prop('checked', true);  
    }  
    else  
    {  
      $(".sub_chk").prop('checked',false);  
    }  
  });
    jQuery('.delete_all').on('click', function(e) { 
    var allVals = [];  
    $(".sub_chk:checked").each(function() {  
      allVals.push($(this).val());
    });  
    //alert(allVals.length); return false;  
    if(allVals.length <=0)  
    {  
      alert("Please select row.");  
    }  
    else {  
      WRN_PROFILE_DELETE = "Are you sure you want to delete all selected records?";  
      var check = confirm(WRN_PROFILE_DELETE);  
      if(check == true){  
        var join_selected_values = allVals.join(","); 
        $.ajax({   
          type: "POST",  
          url: "<?php echo base_url(); ?>index.php/Invnoice/deleteInvoice",  
          cache:false,  
          data: 'ids='+join_selected_values,  
          success: function(response)  
          {   
            $(".successs_mesg").html(response);
            location.reload();
          }   
        });
           
      }  
    }  
  });

  });

</script>