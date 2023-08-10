<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$current_page=current_url();
$data=explode('?', $current_page);
$role_id=$this->session->userdata['logged_in']['role_id'];
/*echo $category_id=$_GET['categories_id'];
echo $supplier_id=$_GET['supplier_id'];
echo $category_of_approval=$_GET['category_of_approval'];*/
//print_r($conditions);
?>

<style type="text/css">
  .btnEdit{
    width: 25%;
    border-radius: 5px;
    margin: 1px;
    padding: 1px;
  }
  .col-sm-6 ,.col-md-6,.col-md-4,.col-md-3{
      float: left;
  }
  

</style>

<?php // echo $data; exit; ?>
<div class="container-fluid">
  <div class="card card-primary card-outline">
    <div class="card-header">
      <label class="card-title"><?php  echo $title; ?></label>
       <div class="pull-right error_msg">
        <form method="post" action="<?php echo base_url(); ?>index.php/Orders/createXLS">

          <?php 
          if(!empty($conditions)){
            foreach ($conditions as $key => $value) { ?>
            <input type="hidden" name="<?= $key ?>" value="<?=$value ?>">
          <?php } }?>
           <button type="submit" class="btn btn-info"> Export </button>
         </form>
        <!-- <a class="btn btn-info" href="<?php echo base_url(); ?>index.php/Suppliers/createXLS">Export</a>   -->
      </div>
    </div> <!-- /.card-body -->
    <div class="card-body">
        <form method="get" id="filterForm">
      <div class="row">
           <?php if($role_id=='1') { ?>
              <div class="col-md-4 col-sm-4 ">
                <label  class="control-label">Name of Customer <span class="required">*</span></label>
                <select name="customer_id" class="form-control select2 suppliers" >
                    <option value="0">Select Customer</option>
                    <?php
                         if ($all_customers): ?> 
                          <?php 
                            foreach ($all_customers as $value) : ?>
                              <?php 
                                  if ($value['id'] == $customer_id): ?>
                                      <option value="<?= $value['id'] ?>" selected><?= $value['name'] ?></option>
                                  <?php else: ?>
                                      <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                  <?php endif;   ?>
                                   <?php   endforeach;  ?>
                        <?php else: ?>
                            <option value="0">No result</option>
                        <?php endif; ?>
                </select>
              </div>
            <?php } ?>
             <div class="col-md-4 col-sm-4">
                      <label  class="control-label"> From Date</label>
                        <input type="text" data-date-formate="dd-mm-yyyy" name="from_date" class="form-control date-picker" value="" placeholder="dd-mm-yyyy" autofocus autocomplete="off" autocomplete="off">
                  </div>
                  <div class="col-md-4 col-sm-4">
                    <label  class="control-label"> Upto Date</label>
                      <input type="text" data-date-formate="dd-mm-yyyy" name="upto_date" class="form-control date-picker" value="" placeholder="dd-mm-yyyy" autofocus autocomplete="off" autocomplete="off">
                </div>
              </div>
                <div class="row">
                  
                 <div class="col-md-4 col-sm-4 ">
                   <label  class="control-label" style="visibility: hidden;"> Grade</label><br>
                  <input type="submit" class="btn btn-primary" value="Search" /> 
                  <!-- <label  class="control-label" style="visibility: hidden;"> Grade</label> -->
                  <a href="<?php echo $data[0]?>" class="btn btn-danger" > Reset</a>
              </div>
          </div>
            
        </form>
            <hr>

      <div class="table-responsive">
          <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th><input type="checkbox" id="master"></th>
              <th >Sr.No.</th>
              <th style="white-space: nowrap;"> Order Code </th>
              <th style="white-space: nowrap;"> Order Date</th>
              <th style="white-space: nowrap;"> Delivery Date</th>
              <th>  Title </th>
              <th>  Words</th>
              <th> Amount </th>
              <?php if($role_id==1){ ?>
              <th> Paid </th>
              <th> Remaining </th>
            <?php } ?>
              <th style="white-space: nowrap;"> Project Status</th>
              <th style="white-space: nowrap;width: 20%;"> Action Button</th>
            </tr>
          </thead>
          <tbody>
           <?php
          $i=1;foreach($orders as $obj){ ?>
              <tr <?php if($obj['order_type']=='Website'){?>  style="background-color:antiquewhite;" <?php } ?> >
                <td><input type="checkbox" class="sub_chk" value="<?php echo $obj['id']; ?>" /></td>
                <td><?php echo $i;?></td>
                <td><?php echo $obj['order_id']; ?></td>
                <td><?php echo date('d-M-Y',strtotime($obj['order_date'])); ?></td>
                <td><?php echo date('d-M-Y',strtotime($obj['delivery_date'])); ?></td>
                <td><?php echo $obj['title']; ?></td>
                 <td><?php $data=$obj['pages'];
                $data1=explode(' (',$data);
                $data_new=explode(' ',$data1['1']);
                print_r ($data_new['0']);
                 ?></td>
                <td><?php echo $obj['amount']; ?> &#163;</td>
                 <?php if($role_id==1){ ?>
                <td><?php echo $obj['received_amount']; ?> &#163;</td>
                <td><?php echo $obj['amount']-$obj['received_amount']; ?> &#163;</td>
              <?php } ?>
                <td><?php echo $obj['projectstatus']; ?></td>
                 <td >
                   <a class="btn btn-xs btn-info btnEdit" data-toggle="modal" data-target="#view<?php echo $obj['id'];?>"><i style="color:#fff;"class="fa fa-eye"></i></a>
              <?php if($role_id==1){ ?>

                <?php if($obj['projectstatus'] =='Approved') { ?>
                  <a class="btn btn-xs btn-success btnEdit" data-toggle="modal" data-target="#approve<?php echo $obj['id'];?>" title="Approve Order" ><i style="color:#fff;"class="fa fa-check"></i></a>

                <?php } ?>

               <!--  <a class="btn btn-xs btn-success btnEdit" href="<?php echo base_url(); ?>index.php/Orders/print/<?php echo $obj['id'];?>"><i class="fa fa-print"></i></a> -->
                  
              <a class="btn btn-xs btn-danger btnEdit" data-toggle="modal" data-target="#delete<?php echo $obj['id'];?>"><i style="color:#fff;"class="fa fa-trash"></i></a>

            <?php if(($obj['projectstatus'] !='Feedback Delivered') || ($obj['paymentstatus'] !='Completed')) { ?>
              <a href="<?php echo base_url(); ?>index.php/Orders/edit/<?php echo $obj['id'];?>"
                  class="btn btn-xs btn-primary btnEdit" > <i style="color:#fff;"class="fa fa-edit"></i>
              </a>
              <?php } ?> 
                <?php if($obj['paymentstatus'] !='Completed') { ?> 
               <a href="<?php echo base_url(); ?>index.php/Orders/payments/<?php echo $obj['id'];?>"
                  class="btn btn-xs btn-primary btnPayment" > <i style="color:#fff;"class="fa fa-money"> Add Payment</i>
              </a> 
                
              <?php } }?> 
             
                </td>
                 <div class="modal fade" id="view<?php echo $obj['id'];?>" role="dialog" tabindex="-1" aria-labelledby="classInfo" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                             <h4 class="modal-title"><?php echo $obj['order_id'];?> Details </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                           
                          </div>
                          <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                  <fieldset>
                                    <legend> Customer Details</legend>
                                     <div class="row">
                                         <div class="col-md-6 col-sm-6 ">
                                          <label class="control-label">Customer Name :</label>
                                          <span> <?php echo $obj['c_name'];?></span>
                                        </div>
                                         <div class="col-md-6 col-sm-6 ">
                                          <label class="control-label">Email :</label>
                                          <span> <?php echo $obj['c_email'];?></span>
                                        </div>
                                        <div class="col-md-6 col-sm-6 ">
                                          <label class="control-label">Mobile :</label>
                                          <span> <?php echo '+'.$obj['countrycode'].' - '.$obj['c_mobile'];?></span>
                                      </div>                         
                                  </div>
                              </fieldset>
                              <fieldset>
                                    <legend> Order Details</legend>
                                   <div class="col-md-6 col-sm-6 ">
                                      <label class="control-label">Order Type :</label>
                                      <span> <?php echo $obj['order_type'];?></span>
                                  </div>
                                   <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label">Project Title:</label>
                                    <span> <?php echo $obj['title'];?></span>
                                  </div>
                                   <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label">Order Id :</label>
                                    <span> <?php echo $obj['order_id'];?></span>
                                  </div>
                                   <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label">Order Date :</label>
                                    <span> <?php echo date('d-M-Y',strtotime($obj['order_date'])); ?></span>
                                  </div>
                                  <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label">Delivery Date :</label>
                                    <span> <?php echo date('d-M-Y',strtotime($obj['delivery_date'])); ?></span>
                                  </div>
                                   <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label">Type Of Service :</label>
                                    <span> <?php echo $obj['services'];?></span>
                                  </div>
                                   <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label">Formatting:</label>
                                    <span> <?php echo $obj['formatting'];?></span>
                                  </div>
                                  <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label">Type Of Paper:</label>
                                    <span> <?php echo $obj['typeofpaper'];?></span>
                                  </div>
                                  <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label">Type Of Writting:</label>
                                    <span> <?php echo $obj['typeofwritting'];?></span>
                                  </div>
                                  <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label">Pages:</label>
                                    <span> <?php echo $obj['pages'];?></span>
                                  </div>
                                  <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label">Number Of Sources:</label>
                                    <span> <?php echo $obj['numberofsources'];?></span>
                                  </div>
                                  <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label">Deadline:</label>
                                    <span> <?php echo $obj['deadline'];?></span>
                                  </div>
                                 <!--  <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label">Actual Amount:</label>
                                    <span> <?php echo $obj['actual_amount'];?> &#163;</span>
                                  </div> -->
                                  <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label">Discount % :</label>
                                    <span> <?php echo $obj['discount_per'];?> %</span>
                                  </div>
                                  <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label">Final Amount:</label>
                                    <span> <?php echo $obj['amount'];?> &#163;</span>
                                  </div> 
                                  <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label">Paid Amount:</label>
                                    <span> <?php echo $obj['received_amount'];?> &#163;</span>
                                  </div> 
                                   <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label">Due Amount:</label>
                                    <span> <?php echo $obj['amount']-$obj['received_amount'];?> &#163;</span>
                                  </div> 
                                  <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label">Payment Status:</label>
                                    <span> <?php echo $obj['paymentstatus'];?></span>
                                  </div>
                                  <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label">Project Status:</label>
                                    <span> <?php echo $obj['projectstatus'];?></span>
                                  </div> 
                                  <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label">Message:</label>
                                    <span> <?php echo $obj['message'];?></span>
                                  </div>
                                </div>
                            </div>
                            
                      
                      <fieldset>
                        <legend> Documents Details</legend>
                      
                        <?php $j=1;foreach ($obj['order_file_details'] as  $file_details) { ?>
                          
                          <div class="row">
                               <div class="col-md-12">
                                    <div class="col-md-4 col-sm-4">
                                      <label><?= $j?></label>
                                    </div>
                                    <div class="col-md-8 col-sm-8 ">
                                    <label class="control-label">Uploaded File :</label>
                                     <div style="height: 10%;width: 100%;">
                                     <a href="<?php echo base_url().'/uploads/'.$file_details['file']; ?>" target="_blank"> <?= $file_details['file']?></a>
                                    </div>

                                  </div>
                              </div>     
                          </div><hr>
                        
                          <?php $j++;} ?>
                      </fieldset>
                      <?php if($obj['projectstatus']=='Completed') { ?>
                       <fieldset>
                        <legend> Completed Assignment File </legend>
                          
                          <div class="row">
                               <div class="col-md-12">
                                    <div class="col-md-4 col-sm-4">
                                      <label> Uploaded File from Assignmentinneed.com</label>
                                    </div>
                                    <div class="col-md-8 col-sm-8 ">
                                    <label class="control-label"> File :</label>
                                     <div style="height: 10%;width: 100%;">
                                     <a href="<?php echo base_url().'/uploads/'.$obj['assignment_file']; ?>" target="_blank"> <?= $obj['assignment_file']?></a>
                                    </div>

                                  </div>
                              </div>     
                          </div><hr>                   
                      </fieldset>

                    <?php } ?>
                     
                        </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal fade" id="delete<?php echo $obj['id'];?>" role="dialog">
                      <div class="modal-dialog">
                        <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Orders/deleteorder/<?php echo $obj['id'];?>">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                             <h4 class="modal-title">Confirm Header </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                           
                          </div>
                          <div class="modal-body">
                            <p>Are you sure, you want to delete Order <b><?php echo $obj['order_id'];?> </b>? </p>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary ">Submit</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                        </form>
                      </div>
                    </div>

                     <!-------------- Approved Requisition Slip Modal Code Start  ---------------->
                    <div class="modal fade" id="approve<?php echo $obj['id'];?>" role="dialog">
                      <div class="modal-dialog">
                        <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Orders/ActionOrder" enctype="multipart/form-data">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header" style="background-color: #168c56;color: azure;">
                             <h4 class="modal-title" >Confirm Header </h4>
                            <button type="button" class="close" data-dismiss="modal" style="color: azure;">&times;</button>
                          </div>
                          <div class="modal-body">
                            <p>Are you sure, you want to <b style="color:#168c56;"> Complete </b>this  Order <b><?php echo $obj['order_id'] ;?> </b>? </p>
                            <input type="hidden" name="user_id" value="<?php echo $obj['uid'];?>">
                            <input type="hidden" name="order_id" value="<?php echo $obj['id'];?>">
                            <input type="hidden" name="status" value="Completed">
                            <input type="hidden" name="approved_date" value="<?= date('Y-m-d') ?>">
                            <div class="form-group">
                                <div class="row col-md-12">
                                  <label  class="control-label"> Comment </label>
                                  <textarea class="form-control Comment" rows="2" placeholder="Enter comment here" name="completed_comment"></textarea>
                              </div>
                              <div class="row col-md-12">
                                  <label  class="control-label"> Upload Assignment </label>
                                  <input type="file" name="assignment_file" class="form-control">
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
                    <!--------------  Approved Requisition Slip Modal Code End  ------------ -->
                    
              </tr>
            <?php  $i++;} ?>
          </tbody>
        </table>
    </div>
    </div>
  </div>
</div>
