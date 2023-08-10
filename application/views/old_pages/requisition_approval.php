<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//print_r($requisition_data);exit;

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
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th><input type="checkbox" id="master"></th>
              <th >Sr.No.</th>
              <th style="white-space: nowrap;"> Requisition No </th>
              <th style="white-space: nowrap;"> Requisition Date </th>
             <!--  <th style="white-space: nowrap;">Total Quantity </th> -->
              <th style="white-space: nowrap;"> Requisition By </th>
              <th style="white-space: nowrap;"> Status </th>
              <th style="white-space: nowrap;"> Action Date </th>
              <th style="white-space: nowrap;"> Store Approval By <span style="color: white;">Name</span> </th>
              <th style="white-space: nowrap;"> Action Button </th>
            </tr>
          </thead>
          <tbody>
           <?php
          $i=1;foreach($requisition_data as $obj){ ?>
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
                <td><?php echo date('d-M-Y',strtotime($obj['transaction_date'])); ?></td>
               <!--  <td><?php echo $obj['total_qty']; ?></td> -->
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
                <td >
                  <?php if($obj['approved_status']=='Pending'){ ?>
                  <a class="btn btn-xs btn-success btnEdit" data-toggle="modal" data-target="#approve<?php echo $obj['id'];?>" title="Approve Requisition" ><i style="color:#fff;"class="fa fa-check"></i></a>
                 <?php if($obj['approved_status']=='Pending') { ?>
                  <a class="btn btn-xs btn-primary btnEdit" href="<?php echo base_url(); ?>index.php/Requisition_slips/edit/<?php echo $obj['id'];?>" title="Edit Requisition" ><i class="fa fa-edit"></i></a>
                  <?php } ?>
                  <a class="btn btn-xs btn-danger btnEdit" data-toggle="modal" data-target="#reject<?php echo $obj['id'];?>" title="Reject Requisition"><i style="color:#fff;"class="fa fa-window-close"></i></a>
                <?php } ?>
              
                  <a class="btn btn-xs btn-info btnEdit" data-toggle="modal" data-target="#view<?php echo $obj['id'];?>" title="View Details" ><i style="color:#fff;"class="fa fa-eye"></i></a>                  
                </td>
                <div class="modal fade" id="view<?php echo $obj['id'];?>" role="dialog">
                      <div class="modal-dialog modal-lg">
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
                                          <div class="col-md-5"><?= $po_detail['name'].' ('.$po_detail['code'].')' ;?> </div>
                                          <div class="col-md-2"><?= $po_detail['quantity'] ;?> </div>
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
                      </div>
                    </div>

                    <!--------------  Rejected Requisition Slip Modal Code Start  ------------ -->
                    <div class="modal fade" id="reject<?php echo $obj['id'];?>" role="dialog">
                      <div class="modal-dialog">
                        <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Requisition_slips/ActionRequisition">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header" style="background-color:#355fa9  ;color: azure;">
                             <h4 class="modal-title">Confirm Header </h4>
                            <button type="button" class="close" data-dismiss="modal" style="color: azure;">&times;</button>
                           
                          </div>
                          <div class="modal-body">
                            <p> Are you sure, you want to <b style="color:#355fa9  ;">Reject</b>  Requisition Slip <b><?php echo $inv_number1 ;?> </b>? </p>
                            <input type="hidden" name="requisition_id" value="<?php echo $obj['id'];?>">
                            <input type="hidden" name="status" value="Rejected">
                            <input type="hidden" name="rejected_date" value="<?= date('Y-m-d') ?>">
                            <div class="form-group">
                                <div class="row col-md-12">
                                  <label  class="control-label"> Reject Reason</label>
                                <textarea class="form-control Comment" rows="2" placeholder="Enter Reason here" name="rejected_reason" required="required"></textarea>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-danger modal_reject_button" style="background-color: #355fa9  ;">Submit</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                        </form>
                      </div>
                    </div>
                    <!--------------  Rejected Requisition Slip Modal Code End  ------------------>

                     <!-------------- Approved Requisition Slip Modal Code Start  ---------------->
                    <div class="modal fade" id="approve<?php echo $obj['id'];?>" role="dialog">
                      <div class="modal-dialog">
                        <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Requisition_slips/ActionRequisition">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header" style="background-color: #168c56;color: azure;">
                             <h4 class="modal-title" >Confirm Header </h4>
                            <button type="button" class="close" data-dismiss="modal" style="color: azure;">&times;</button>
                          </div>
                          <div class="modal-body">
                            <p>Are you sure, you want to <b style="color:#168c56;">Approve</b> Requisition Slip <b><?php echo $inv_number1 ;?> </b>? </p>
                            <input type="hidden" name="requisition_id" value="<?php echo $obj['id'];?>">
                            <input type="hidden" name="status" value="Approved">
                            <input type="hidden" name="approved_date" value="<?= date('Y-m-d') ?>">
                            <div class="form-group">
                                <div class="row col-md-12">
                                  <label  class="control-label"> Comment </label>
                                <textarea class="form-control Comment" rows="2" placeholder="Enter Reason here" name="approve_comment"></textarea>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-success modal_approve_button" style="background-color: #168c56;">Submit</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                        </form>
                      </div>
                    </div>
                    <!--------------  Rejected Requisition Slip Modal Code End  ------------ -->
                    
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