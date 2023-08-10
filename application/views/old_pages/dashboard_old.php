<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$base= base_url();
$hyperlink_orders=$base.'index.php/Orders/index';
$hyperlink_customers=$base.'index.php/Employees/index';
$referrals=$base.'index.php/Referrals/myRefers';

//echo $role_id;exit;
//print_r($hyperlink_ordes);exit;
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
            <div class="row">
               <?php if($role_id==2){ ?>
              <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3> <?= $total_customers ?> </h3>

                    <p>My Referrals</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-users"></i>
                  </div>
                  <a href="<?php echo @$referrals; ?>" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                  </a>
                </div>
              </div>
            <?php } ?>

            <?php if($role_id==1){ ?>
               <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3> <?= $total_customers ?> </h3>

                    <p> Total Customers</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-users"></i>
                  </div>
                  <a href="<?php echo $hyperlink_customers; ?>" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                  </a>
                </div>
              </div>
            <?php } ?>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3> <?= $TotalOrders ?> <sup style="font-size: 20px"></sup></h3>

                <p> Total Orders</p>
              </div>
              <div class="icon">
                 <i class="fa fa-book"></i>
              </div>
              <a href="<?php echo $hyperlink_orders ;?>" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?= $TotalOrdersToday ?></h3>

                <p>Today's Order</p>
              </div>
              <div class="icon">
               <i class="fa fa-shopping-cart"></i>
              </div>
              <a href="<?php echo $hyperlink_orders ;?>?customer_id=0&order_id=0&from_date=<?php echo date("d-m-Y"); ?>&upto_date=&order_date_filter=order_date&status=&title=" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-danger">
              <div class="inner">
                 <h3><?= $pending_orders ?></h3>

                <p> Pending Orders</p>
              </div>
              <div class="icon">
               <i class="fa fa-clock-o"></i>
              </div>
              <a href="<?php echo $hyperlink_orders ;?>?customer_id=0&order_id=0&from_date=&upto_date=&order_date_filter=order_date&status=Pending&title=" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
        </div>
      </div>
    </div>
  </div>
        <!-- Info boxes -->
        <br></br>
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
              <tr <?php if($obj['order_type']=='Website'){?>  style="background-color:antiquewhite;" <?php } ?> <?php if($obj['flag']==0){?> style="font-weight: 700;" <?php } ?> class="read_order" order_id="<?=$obj['id'] ?>">
                <td><input type="checkbox" class="sub_chk" value="<?php echo $obj['id']; ?>" /></td>
                <td><?php echo $i;?></td>
                <td><?php echo $obj['order_id']; ?></td>
                <td><?php echo date('d-M-Y',strtotime($obj['order_date'])); ?></td>
                <td><?php echo date('d-M-Y',strtotime($obj['delivery_date'])); ?></td>
                <td><?php echo $obj['title']; ?></td>
                 <td><?php $data=$obj['pages'];
                $data1=explode(' (',$data);
                $data_new=explode(' ',$data1['1']);
                 echo $data_new['0'];
                 ?></td>
                <td><?php echo $obj['amount']; ?> &#163;</td>
                 <?php if($role_id==1){ ?>
                <td><?php echo $obj['received_amount']; ?> &#163;</td>
                <td><?php echo $obj['amount']-$obj['received_amount']; ?> &#163;</td>
              <?php } ?>
                <td><?php echo $obj['projectstatus']; ?></td>
                 <td >
				 
				
                     <?php if($role_id==2){ ?>
                        <button class="btn btn-info btnEdit" data-toggle="modal" title="Download File" data-target="#download<?php echo $obj['id'];?>"><i class="fa fa-download"></i></button>
					
					
					<?php } ?>
                        <a class="btn btn-xs btn-success btnEdit"  href="<?php echo base_url(); ?>index.php/Orders/feedback/<?php echo $obj['id'];?>" ><i style="color:#fff;"class="fa fa-comments"></i></a>

                   <a class="btn btn-xs btn-info btnEdit" data-toggle="modal" data-target="#view<?php echo $obj['id'];?>"><i style="color:#fff;"class="fa fa-eye"></i></a>
              <?php if($role_id != 2){ ?>

                <?php if(($obj['projectstatus'] =='Delivered') || ($obj['projectstatus'] =='Feedback Delivered') || ($obj['projectstatus'] =='Draft Delivered')) { ?>
                  <a class="btn btn-xs btn-success btnEdit"  href="<?php echo base_url(); ?>index.php/Orders/UploadOrder/<?php echo $obj['id'];?>" ><i style="color:#fff;"class="fa fa-check"></i></a>

                <?php } ?>

                <a class="btn btn-xs btn-success btnEdit"  href="<?php echo base_url(); ?>index.php/Orders/EditOrderFile/<?php echo $obj['id'];?>" ><i style="color:#fff;"class="fa fa-upload"></i></a>

                <!-- <a class="btn btn-xs btn-info btnEdit" data-toggle="modal" data-target="#view<?php echo $obj['id'];?>"><i style="color:#fff;"class="fa fa-eye"></i></a> -->
            
                <a class="btn btn-xs btn-success btnEdit" href="<?php echo base_url(); ?>index.php/Orders/Emails/<?php echo $obj['uid'];?>"><i class="fa fa-envelope"></i></a>
                  
              <a class="btn btn-xs btn-danger btnEdit" data-toggle="modal" data-target="#delete<?php echo $obj['id'];?>"><i style="color:#fff;"class="fa fa-trash"></i></a>

            <?php if(($obj['projectstatus'] !='Feedback Delivered') || ($obj['paymentstatus'] !='Completed')) { ?>
              <a href="<?php echo base_url(); ?>index.php/Orders/edit/<?php echo $obj['order_id'];?>"
                  class="btn btn-xs btn-primary btnEdit" > <i style="color:#fff;"class="fa fa-edit"></i>
              </a>
              <?php } ?> 
                <?php if($obj['paymentstatus'] !='Completed') { ?> 
               <a href="<?php echo base_url(); ?>index.php/Orders/payments/<?php echo $obj['id'];?>"
                  class="btn btn-xs btn-primary btnPayment" > <i style="color:#fff;"class="fa fa-money"> Add Payment</i>
              </a> 
                
              <?php } }?> 
             
			
                </td>

                      <div class="modal fade" id="download<?php echo $obj['id'];?>" role="dialog" tabindex="-1" aria-labelledby="classInfo" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                             <h4 class="modal-title"><?php echo $obj['order_id'];?> Details </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <div class="modal-body">
                              <div class="row">
                                  <div class="col-md-2 col-sm-2 ">
                                    <label class="control-label"> #  </label>
                                  </div>
                                   <div class="col-md-8 col-sm-8 ">
                                    <label class="control-label"> File Name</label>
                                  </div>
                                   <div class="col-md-2 col-sm-2 ">
                                    <label class="control-label"> Action </label>
                                  </div>
                              </div>
                              <hr>
                              <?php 
                              if(!empty($obj['completed_orders'])){
                                  $k=1;foreach ($obj['completed_orders'] as  $file_details) { ?>
                                     <div class="row">
                                       <div class="col-md-2 col-sm-2 ">
                                        <label class="control-label"> <?= $k ?></label>
                                      </div>
                                       <div class="col-md-8 col-sm-8 ">
                                       <?php $name=explode('/',$file_details['file_path']); echo $name[5]; ?>
                                       
                                      </div>
                                       <div class="col-md-2 col-sm-2 ">
                                        <label class="control-label"> <a href="<?php echo $file_details['file_path']; ?>" download="download" > <i class="fa fa-download"></i></a></label>
                                      </div>
                                    </div>
                                    <hr>
                              <?php $k++;} }?>
                              
                          </div>
                        </div>
                      </div>
                  </div>



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
                                    
                                 <?php if($role_id != '3') { ?>
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
                              <?php } ?>
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
                                 <!--  <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label">Number Of Sources:</label>
                                    <span> <?php echo $obj['numberofsources'];?></span>
                                  </div> -->
                                  <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label">Deadline:</label>
                                    <span> <?php echo $obj['deadline'];?> Day</span>
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
                      
                       <?php 
                     
                        if(!empty($obj['order_file_details'])){
                        $j=1;foreach ($obj['order_file_details'] as  $file_details) { ?>
                          
                          <div class="row">
                               <div class="col-md-12">
                                    <div class="col-md-4 col-sm-4">
                                      <label><?= $j?></label>
                                    </div>
                                    <div class="col-md-8 col-sm-8 ">
                                    <label class="control-label">Uploaded File :</label>
                                    <!-- <div style="height: 10%;width: 100%;">-->
                                    <!--    <?php if($obj['order_type'] == 'Website') { ?>-->
                                    <!--<a href="<?php echo 'https://orders.assignnmentinneed.com/'.$file_details['file']; ?>" target="_blank"> <?php $name=explode('/',$file_details['file']); $name[5]?></a>-->
                                    <!--    <?php } else { ?>-->
                                    <!-- <a href="<?php echo base_url().'/uploads/'.$file_details['file']; ?>" target="_blank"> <?= $file_details['file']?></a>-->
                                    <!-- <?php } ?>-->
                                    <!--</div>-->
                                    <div style="height: 10%;width: 100%;">
                                       <a href="<?php echo $file_details['file']; ?>" target="_blank"> <?php $name=explode('/',$file_details['file']);
                                         if($obj['order_type']=="Website"){
                                          echo $name[4];
                                       }else{
                                         echo $name[5]; 
                                       }
                                       ?>
                                    </a>
                                    </div>
                                    

                                  </div>
                              </div>     
                          </div><hr>
                        
                          <?php $j++;}} ?>
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

                   
                            </tr>
                          <?php  $i++;} ?>
                        </tbody>
                      </table>
					  <div>
					   <p><?php echo $links; ?></p>
					  </div>
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

<script src="<?php echo base_url()."assets/"; ?>plugins/jquery/jquery.min.js"></script>
<script type="text/javascript">
  $( document ).ready(function() {
   $('.read_order').on('click', function(e) {
	   var current =$(this);
	   id=$(this).attr('order_id');
	  
	   $.ajax({   
         
          url: "<?php echo base_url(); ?>index.php/Orders/readorder/"+id,  
          cache:false,  
          success: function(response)  
          {   
           current.css("font-weight", "");
          }   
        });
   });
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
      WRN_PROFILE_DELETE = "Are you sure you want to delete all selected customers?";  
      var check = confirm(WRN_PROFILE_DELETE);  
      if(check == true){  
        var join_selected_values = allVals.join(","); 
        $.ajax({   
          type: "POST",  
          url: "<?php echo base_url(); ?>index.php/Orders/deleteorder",  
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
