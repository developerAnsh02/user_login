<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$current_page=current_url();
//$current_page='https://www.muskowl.com/chaudhary_minerals/index.php/Meenus/UserRights';
$data=explode('?', $current_page);
//print_r($data[0]);exit;
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
<div class="container-fluid">
  <div class="card card-primary card-outline">
    <div class="card-header">
      <span class="card-title"><?php  echo $title; ?></span>
       <div class="pull-right error_msg">
          <a href="<?php echo base_url(); ?>index.php/Engineers/add" class="btn btn-success" data-toggle="tooltip" title="New customer"><i class="fa fa-plus"></i></a>

         <button class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="location.reload();"><i class="fa fa-refresh"></i></button>

          <button class="btn btn-danger delete_all" data-toggle="tooltip" title="Bulk Delete" ><i class="fa fa-trash"></i></button>  
      </div>
    </div> <!-- /.card-body -->
    <div class="card-body">
      <!-- <form method="get" id="filterForm">
      <div class="row">
              <div class="col-md-3 col-sm-3 ">
                <label  class="control-label">Name of Customer <span class="required">*</span></label>
                <select name="customer_id" class="form-control select2 customers" >
                    <option value="0"> Select customer</option>
                    <?php
                         if ($all_customers): ?> 
                          <?php 
                            foreach ($all_customers as $value) : ?>
                              <?php 
                                  if ($value['id'] == $customer_id): ?>
                                      <option value="<?= $value['id'] ?>" selected><?= $value['customer_name'] ?></option>
                                  <?php else: ?>
                                      <option value="<?= $value['id'] ?>"><?= $value['customer_name'] ?></option>
                                  <?php endif;   ?>
                                   <?php   endforeach;  ?>
                        <?php else: ?>
                            <option value="0">No result</option>
                        <?php endif; ?>
                </select>
              </div>
                  <div class="col-md-3 col-sm-3">
                      <label  class="control-label"> From Date</label>
                        <input type="text" data-date-formate="dd-mm-yyyy" name="from_date" class="form-control date-picker" value="" placeholder="dd-mm-yyyy" autofocus autocomplete="off" autocomplete="off">
                  </div>
                  <div class="col-md-3 col-sm-3">
                    <label  class="control-label"> Upto Date</label>
                      <input type="text" data-date-formate="dd-mm-yyyy" name="upto_date" class="form-control date-picker" value="" placeholder="dd-mm-yyyy" autofocus autocomplete="off" autocomplete="off">
                </div>
                 <div class="col-md-3 col-sm-3 ">
                   <label  class="control-label" style="visibility: hidden;"> Grade</label><br>
                  <input type="submit" class="btn btn-primary" value="Search" /> 
                   <label  class="control-label" style="visibility: hidden;"> Grade</label>
                  <a href="<?php echo $data[0]?>" class="btn btn-danger" > Reset</a>
              </div>
          </div>
          </div>
        </form> <hr>-->
      
      <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th><input type="checkbox" id="master"></th>
              <th >Sr.No.</th>
              <th> Name </th>
              <th> Categories </th>
              <th> Email</th>
              <th> Mobile</th>
              <th> City</th>
              <th> Photo</th>
              <th style="white-space: nowrap;width: 20%;"> Action Button</th>
            </tr>
          </thead>
          <tbody>
           <?php $i=1;foreach($engineers as $obj){ ?>
              <tr>
                <td><input type="checkbox" class="sub_chk" value="<?php echo $obj['id']; ?>" /></td>
                <td><?php echo $i;?></td>
                <td><?php echo $obj['engineer_name'].' ('.$obj['engineer_code'].')';?></td>
                <td><?php echo $obj['categories_ids']; ?></td>
                <td><?php echo $obj['email']; ?></td>
                <td><?php echo $obj['mobile_no']; ?></td>
                <td><?php echo $obj['city']; ?></td>
                <td><img src="<?php echo base_url();?><?php echo'/uploads/customers/'.$obj['profile_photo']; ?>" height="80px;" width="80px;"></td>
                
                <td >
                   <a class="btn btn-xs btn-info btnEdit" data-toggle="modal" data-target="#view<?php echo $obj['id'];?>"><i style="color:#fff;"class="fa fa-eye"></i></a>
	              
               <!--  <a class="btn btn-xs btn-success btnEdit" href="<?php echo base_url(); ?>index.php/Customers/print/<?php echo $obj['id'];?>"><i class="fa fa-print"></i></a>
                 -->
                  <!-- <a class="btn btn-xs btn-primary btnEdit" href="<?php echo base_url(); ?>index.php/Customers/edit_customer_view/<?php echo $obj['id'];?>"><i class="fa fa-edit"></i></a> -->
                  
                  <a class="btn btn-xs btn-danger btnEdit" data-toggle="modal" data-target="#delete<?php echo $obj['id'];?>"><i style="color:#fff;"class="fa fa-trash"></i></a>
                <!--   <a href="<?php //echo base_url(); ?>index.php/welcome/deletecustomer/<?php echo $obj['id'];?>"
                   onclick="return confirm(\'Confirm Deletion.\')">Delete</a> -->
                </td>
                 <div class="modal fade" id="view<?php echo $obj['id'];?>" role="dialog" tabindex="-1" aria-labelledby="classInfo" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                             <h4 class="modal-title"><?php echo $obj['engineer_name'].' ('.$obj['engineer_code'].')';?> Details </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                           
                          </div>
                          <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                   <div class="col-md-6 col-sm-6 ">
                                      <label class="control-label">Profile Photo :</label>
                                      <span> <img src="<?php echo base_url();?><?php echo'/uploads/customers/'.$obj['profile_photo']; ?>" height="80px;" width="80px;"></span>
                                  </div>
                                   <div class="col-md-6 col-sm-6 ">
                                      <label class="control-label">Passport File :</label>
                                      <?php if(!empty($obj['passport_file'])){?>
                                        <span> <a href="<?php echo base_url();?><?php echo'/uploads/customers/'.$obj['passport_file']; ?>" target="_blank"> <img src="<?php echo base_url();?><?php echo'/uploads/customers/'.$obj['passport_file']; ?>" height="80px;" width="80px;"></a></span>
                                    <?php }else{ ?>
                                      <span> Paasport File Not uploaded.</span>
                                    <?php } ?>
                                  </div>

                                    <div class="col-md-6 col-sm-6 ">
                                      <label class="control-label">Type Of Category :</label>
                                      <span> <?php echo $obj['categories_ids'];?></span>
                                  </div>
                                   <div class="col-md-6 col-sm-6 ">
                                      <label class="control-label">Services :</label>
                                      <span> <?php echo $obj['services_ids'];?></span>
                                  </div>
                                  <div class="col-md-6 col-sm-6 ">
                                      <label class="control-label">Short Bio :</label>
                                      <span> <?php echo $obj['short_bio'];?></span>
                                  </div>
                                   <div class="col-md-6 col-sm-6 ">
                                      <label class="control-label">Account Holder Name :</label>
                                      <span> <?php echo $obj['account_name'];?></span>
                                  </div>
                                   <div class="col-md-6 col-sm-6 ">
                                      <label class="control-label">A/c Number :</label>
                                      <span> <?php echo $obj['account_no'];?></span>
                                  </div>
                                   <div class="col-md-6 col-sm-6 ">
                                      <label class="control-label">IFS code :</label>
                                      <span> <?php echo $obj['ifsc_code'];?></span>
                                  </div>

                                    <div class="col-md-6 col-sm-6 ">
                                      <label class="control-label">Mobile :</label>
                                      <span> <?php echo $obj['country_code'].' - '.$obj['mobile_no'];?></span>
                                  </div>
                                  <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label">Email :</label>
                                    <span> <?php echo $obj['email'];?></span>
                                  </div>
                                   <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label">Joining Date :</label>
                                    <span> <?php echo date('d-M-Y',strtotime($obj['reg_date']));?></span>
                                  </div>
                                    <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label"> Date Of Birth:</label>
                                    <span> <?php echo date('d-M-Y',strtotime($obj['dob']));?></span>
                                  </div>
                                </div>
                            </div>
                            
                          <fieldset>
                            <legend> Engineer Address</legend>
                             <div class="row">
                                <div class="col-md-12">
                                  <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label">Postal Code :</label>
                                    <span> <?php echo $obj['postal_code'];?></span>
                                  </div>
                                 <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label">Address :</label>
                                    <span> <?php echo $obj['address'];?></span>
                                  </div>
                              </div>                              
                          </div>
                          <div class="row">
                                <div class="col-md-12">
                                  <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label">City :</label>
                                    <span> <?php echo $obj['city'];?></span>
                                  </div> 
                                  <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label">State:</label>
                                    <span> <?php echo @$obj['state'];?></span>
                                  </div>
                                   <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label">Country:</label>
                                    <span> <?php echo $obj['country'];?></span>
                                  </div>
                               
                              </div>                              
                          </div>
                      </fieldset>
                      <fieldset>
                        <legend> Documents Details</legend>
                        
                        <?php 
                        if(empty($obj['engineer_docs'])){
                          echo "No Document uploaded yet.";
                        }
                        else{
                         
                        $j=1;foreach ($obj['engineer_docs'] as  $card_detail) { ?>
                          
                          <div class="row">
                               <div class="col-md-12">
                                    <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label">Document Name:</label>
                                    <span> <?php echo $card_detail['document_name'];?></span>
                                  </div>
                                   <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label"> Document File :</label>
                                    <span> 
                                    <a href="<?php echo base_url();?><?php echo'/uploads/customers/'.$card_detail['document_path']; ?>" target="_blank"> Download File</a></span>
                                  </div> 
                                 
                              </div>     
                          </div><hr>
                            
                          <?php $j++;}} ?>
                      </fieldset>

                      
                        </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal fade" id="delete<?php echo $obj['id'];?>" role="dialog">
                      <div class="modal-dialog">
                        <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Engineers/deleteEngineer/<?php echo $obj['id'];?>">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                             <h4 class="modal-title">Confirm Header </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                           
                          </div>
                          <div class="modal-body">
                            <p>Are you sure, you want to delete engineer <b><?php echo $obj['engineer_name'];?> </b>? </p>
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
      WRN_PROFILE_DELETE = "Are you sure you want to delete all selected engineers?";  
      var check = confirm(WRN_PROFILE_DELETE);  
      if(check == true){  
        var join_selected_values = allVals.join(","); 
        $.ajax({   
          type: "POST",  
          url: "<?php echo base_url(); ?>index.php/Engineers/deleteEngineer",  
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
<script type="text/javascript">
  $(document).ready(function() {
    var base_url='<?php echo base_url() ;?>';
    //alert(base_url);
    $(document).on('change','.category',function(){
        var category_id = $('.category').find('option:selected').val();
        //var aa= base_url+"index.php/Meenus/rolewisedata/"+role_id;
        //alert(category_id);
        $.ajax({
                  type: "POST",
                  url:"<?php echo base_url('index.php/Customers/getcustomerByCategory/') ?>"+category_id,
                  //data: {id:role_id},
                  dataType: 'html',
                  success: function (response) {
                    //alert(response);
                      $(".customers").html(response);
                      $('.select2').select2();
                      //$('.category').find('option:selected').prop('required',true);

                  }
              });
      }); 
  });
</script> 