<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$base= base_url();
$hyperlink_ordes=$base.'index.php/Orders/index';
$hyperlink_customers=$base.'index.php/Employees/index';
//print_r($hyperlink_ordes);exit;
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
<section class="content">
  <div class="container-fluid">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title"><?= $title ?></h3>
            <div class="pull-right ">
                
            </div>
        </div>
         <div class="card-footer">
            <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fa fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Customers</span>
                <span class="info-box-number">
                 <?= $total_customers ?>
                  <!-- <small>%</small> -->
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-book"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Orders</span>
                <span class="info-box-number"><?= $TotalOrders ?> </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fa fa-shopping-cart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Today's Order</span>
                <span class="info-box-number"><?= $TotalOrdersToday ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-clock-o"></i></span>

              <div class="info-box-content">
                <span class="info-box-text"> Pending Orders</span>
                <span class="info-box-number"> <?= $pending_orders ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </br>
        <div class="row">     
          <div class="col-md-12">
            <div class="card card-info">
              <div class="card-header">
                <h5 class="card-title">My Orders</h5>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
               <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th><input type="checkbox" id="master"></th>
                      <th >Sr.No.</th>
                      <th> Order ID </th>
                      <th> Order Date</th>
                      <th> Order By </th>
                      <th> Order By Email</th>
                      <th> Amount </th>
                      <th style="white-space: nowrap;width: 20%;"> Action Button</th>
                    </tr>
                  </thead>
                  <tbody>
                   <?php
                  $i=1;foreach($orders as $obj){ ?>
                      <tr>
                <td><input type="checkbox" class="sub_chk" value="<?php echo $obj['id']; ?>" /></td>
                <td><?php echo $i;?></td>
                <td><?php echo $obj['order_id']; ?></td>
                <td><?php echo date('d-M-Y',strtotime($obj['order_date'])); ?></td>
                <td><?php echo $obj['c_name']; ?></td>
                <td><?php echo $obj['c_email']; ?></td>
                <td><?php echo $obj['amount']; ?> &#163;</td>
                <td >
                  <?php if($obj['projectstatus']=='Pending') { ?>
                  <a class="btn btn-xs btn-success btnEdit" data-toggle="modal" data-target="#approve<?php echo $obj['id'];?>" title="Approve Order" ><i style="color:#fff;"class="fa fa-check"></i></a>
                <?php } ?>
                   <a class="btn btn-xs btn-info btnEdit" data-toggle="modal" data-target="#view<?php echo $obj['id'];?>"><i style="color:#fff;"class="fa fa-eye"></i></a>

                <a class="btn btn-xs btn-success btnEdit" href="<?php echo base_url(); ?>index.php/Orders/print/<?php echo $obj['id'];?>"><i class="fa fa-print"></i></a>
                  
                <a class="btn btn-xs btn-danger btnEdit" data-toggle="modal" data-target="#delete<?php echo $obj['id'];?>"><i style="color:#fff;"class="fa fa-trash"></i></a>
               
               <a href="<?php echo base_url(); ?>index.php/Orders/edit/<?php echo $obj['id'];?>"
                  class="btn btn-xs btn-primary btnEdit" > <i style="color:#fff;"class="fa fa-edit"></i> </a> 
                
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
                                    <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label">Actual Amount:</label>
                                    <span> <?php echo $obj['actual_amount'];?> &#163;</span>
                                  </div>
                                  <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label">Discount % :</label>
                                    <span> <?php echo $obj['discount_per'];?> %</span>
                                  </div>
                                  <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label">Final Amount:</label>
                                    <span> <?php echo $obj['amount'];?> &#163;</span>
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
              <!-- /.card-body -->
            </div>
          </div>
       
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
