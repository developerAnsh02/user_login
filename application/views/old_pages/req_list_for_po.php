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

      </div>
    </div> <!-- /.card-body -->
    <div class="card-body">
      <div class="table-responsive">
        <table id="example2" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th><input type="checkbox" id="master"></th>
              <th >Sr.No.</th>
              <th style="white-space: nowrap;"> Requisition No </th>
              <th style="white-space: nowrap;"> Requisition Date </th>
             <!--  <th style="white-space: nowrap;">Total Quantity </th> -->
              <th style="white-space: nowrap;">Request By </th>
              <th style="white-space: nowrap;"> Status </th>
              <th style="white-space: nowrap;"> Action Date </th>
              <th style="white-space: nowrap;"> Action By <span style="color: white;">Name</span></th>
              <th style="white-space: nowrap;"> Action Button</th>
            </tr>
          </thead>
          <tbody>
           <?php
           if(!empty($requisition_data)){
              $i=1;foreach($requisition_data as $obj){ 
                //print_r($obj);exit;
                ?>
              <tr>
                <td><input type="checkbox" class="sub_chk" value="<?php echo $obj['id']; ?>" /></td>
                <td><?php echo $i;?></td>
                <td>
                  <?php 
                         $inv_number=$obj['requisition_slip_no'];
                          if($inv_number<10){
                            $inv_number1='RS000'.$inv_number;
                            }
                            else if(($inv_number>=10) && ($inv_number<=99)){
                              $inv_number1='RS00'.$inv_number;
                            }
                            else if(($inv_number>=100) && ($inv_number<=999)){
                              $inv_number1='RS0'.$inv_number;
                            }
                            else{
                              $inv_number1='RS'.$inv_number;
                            }
                            echo $inv_number1; ?>
                </td>
                <td ><?php echo date('d-M-Y',strtotime($obj['transaction_date'])); ?></td>
                <!-- <td><?php echo $obj['total_qty']; ?></td> -->
                <td><?php echo $obj['requestor']; ?></td>
                <td><?php echo $obj['approved_status']; ?></td>
                <td><?php 
                if($obj['approved_status']=='Pending'){
                    echo 'NA';
                } else if($obj['approved_status']=='Rejected'){
                    echo date('d-m-y',strtotime($obj['rejected_date']));
                }else if($obj['approved_status']=='Approved'){
                    echo date('d-m-y',strtotime($obj['approved_date']));
                }
                ?>
                </td>
                <td>
                <?php 
                if($obj['approved_status']=='Pending'){
                    echo 'NA';
                } else if($obj['approved_status']=='Rejected'){
                    echo $obj['rejector'];
                }else if($obj['approved_status']=='Approved'){
                    echo $obj['approver'];
                }
                ?>
                </td>
                <td>
                   <a class="btn btn-xs btn-info " data-toggle="modal" data-target="#view<?php echo $obj['id'];?>" title="View Details" ><i style="color:#fff;"class="fa fa-eye"></i> </a>

                    <a class="btn btn-xs btn-primary btnView" href="<?php echo base_url(); ?>index.php/Purchase_order/add/ <?php echo $obj['id'];?>" data-toggle="tooltip" title="Convert to Purchase Order" ><i class="fa fa-refresh"></i></a>
                    <!--  <a class="btn btn-xs btn-danger " data-toggle="modal" data-target="#delete<?php echo $obj['id'];?>"><i style="color:#fff;"class="fa fa-trash"></i></a> -->
                </td>
                <div class="modal fade" id="view<?php echo $obj['id'];?>" role="dialog">
                      <div class="modal-dialog modal-lg">
                        <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Requisition_slips/deletePO/<?php echo $obj['id'];?>">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                             <h4 class="modal-title"> Requisition Slip (<?php echo $inv_number1 ?>) Details </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                           
                          </div>
                          <div class="modal-body">
                              <div class="row col-md-12" style="border: 1px solid #f3ecec;
                                  height: 45px;
                                  padding: 10px;
                                  margin: 0px;
                                  margin-bottom: 6px; font-weight: 500;" >
                                                             
                                <div class="col-md-1">#</div>
                                <div class="col-md-5">Item Name </div>
                                <div class="col-md-2">Qty </div>
                                <div class="col-md-4">Description </div>
                              </div>

                                    <?php
                                      $j=1;foreach($obj['requisition_details'] as $po_detail)
                                      { ?>
                                        <div class="row col-md-12" style="border: 0px solid #f3ecec;
                                  height: 45px;
                                  padding: 10px;
                                  margin: 0px;
                                  margin-bottom: 6px;">
                                          <div class="col-md-1"><?= $j;?> </div>
                                          <div class="col-md-5"><?= $po_detail['item'].' ('.$po_detail['code'].')' ;?> </div>
                                          <div class="col-md-2"><?= $po_detail['quantity']-$po_detail['issue_qty'] ;?> </div>
                                          <div class="col-md-4"><?= $po_detail['description'] ;?> </div>
                                        </div>
                                  <?php $j++; }  ?>
                              </div>

                           <div class="row col-md-12" >
                              <div class="col-md-12">
                                <label class="control-label"> Total Qty : </label>
                                <span > <?php echo $obj['total_qty']?></span>
                              </div>
                            </div>
                             <div class="row col-md-12" >
                              <div class="col-md-12">
                                <label class="control-label"> Requisition slip for :  </label>
                                  <span > 
                                      <?php 
                                          echo $obj['rs_for']; 
                                        ?>
                                  </span>
                              </div>
                            </div>
                           <?php if(($obj['rs_for']=='Raw Material') || ($obj['rs_for']=='Packing Material')) {  ?>
                                 <div class="row col-md-12" >
                                  <div class="col-md-6">
                                    <label class="control-label"> Mineral Name: </label>
                                    <span > <?php echo $obj['mineral_name']?></span>
                                  </div>
                                  <div class="col-md-6">
                                    <label class="control-label"> Grade Name: </label>
                                    <span > <?php echo $obj['grade_name'] ?></span>
                                  </div>
                                </div>
                                <div class="row col-md-12" >
                                  <div class="col-md-6">
                                    <label class="control-label"> Lot No : </label>
                                    <span > <?php echo $obj['lot_no']?></span>
                                  </div>
                                  <div class="col-md-6">
                                    <label class="control-label"> Batch No: </label>
                                    <span > <?php echo $obj['batch_no'] ?></span>
                                  </div>
                                </div>
                           <?php } else{ ?>
                                 <div class="row col-md-12" >
                                  <div class="col-md-6">
                                    <label class="control-label"> Equipment Name : </label>
                                    <span > <?php echo $obj['equipment_name']?></span>
                                  </div>
                                  <div class="col-md-6">
                                    <label class="control-label"> Purpose: </label>
                                    <span > <?php echo $obj['purpose'] ?></span>
                                  </div>
                                </div>
                           <?php } ?>

                           
                            <div class="row col-md-12" >
                              <div class="col-md-12">
                                <label class="control-label"> Comment : </label>
                                  <span > 
                                      <?php 
                                          echo $obj['comment']; 
                                        ?>
                                  </span>
                              </div>
                            </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                        </form>
                      </div>
                    </div>


                    <div class="modal fade" id="delete<?php echo $obj['id'];?>" role="dialog">
                      <div class="modal-dialog">
                        <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Requisition_slips/deleteRequisition/<?php echo $obj['id'];?>">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                             <h4 class="modal-title">Confirm Header </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                           
                          </div>
                          <div class="modal-body">
                            <p>Are you sure, you want to delete Requisition Slip <b><?php echo $obj['requisition_slip_no'];?> </b>? </p>
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
            <?php  $i++;} } ?>
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
          url: "<?php echo base_url(); ?>index.php/Requisition_slips/deleteRequisition",  
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