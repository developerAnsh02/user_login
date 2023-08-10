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
       <div class="pull-right error_msg">
        <form method="post" action="<?php echo base_url(); ?>index.php/Area_cleaning_records/createXLS">

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

             
              <div class="col-md-4 col-sm-3 ">
                <label  class="control-label">Filter By Area Name <span class="required">*</span></label>
                <select name="area_id" class="form-control select2 employees" >
                   <option value=" "> Select Area</option>
                    <?php
                         if ($areas): ?> 
                          <?php 
                            foreach ($areas as $key=>$value) : ?>
                               <option value="<?= $value['id'] ?>"><?= $value['area_name'] ?></option>
                            <?php   endforeach;  ?>
                        <?php else: ?>
                            <option value="0">No result</option>
                        <?php endif; ?>
                </select>
              </div>
               
             
             <div class="col-md-4 col-sm-3">
                      <label  class="control-label"> From Date</label>
                        <input type="text" data-date-formate="dd-mm-yyyy" name="from_date" class="form-control date-picker" value="" placeholder="dd-mm-yyyy" autofocus autocomplete="off" autocomplete="off">
                  </div>
                  <div class="col-md-4 col-sm-3">
                    <label  class="control-label"> Upto Date</label>
                      <input type="text" data-date-formate="dd-mm-yyyy" name="upto_date" class="form-control date-picker" value="" placeholder="dd-mm-yyyy" autofocus autocomplete="off" autocomplete="off">
                </div>
              </div>
                <div class="row">
                   <div class="col-md-6 col-sm-6 ">
                   </div>
                   <div class="col-sm-4 col-sm-4   ">
                      <label  class="control-label" style="visibility: hidden;"> Grade</label><br>
                      <input type="submit" class="btn btn-primary" value="Search" /> 
                      <!-- <label  class="control-label" style="visibility: hidden;"> Grade</label> -->
                      <a href="<?php echo base_url(); ?>index.php/Area_cleaning_records/report" class="btn btn-danger" > Reset</a>
                  </div>
                </div>
            
        </form>
      <div class="table-responsive">
       <table id="example1" class="table table-bordered ">
          <thead>
            <tr>
             <!--  <th><input type="checkbox" id="master"></th> -->
              <th >Sr.No.</th>
              <th style="white-space: nowrap;"> Date Of Cleaning</th>
              <th style="white-space: nowrap;"> ACR Number </th>
              <th style="white-space: nowrap;"> Reported By </th>
              <th style="white-space: nowrap;"> Action Button </th>
            </tr>
          </thead>
          <tbody>
           <?php
          $i=1;foreach($area_cleaning_records as $obj){ ?>
              <tr>
                <!-- <td><input type="checkbox" class="sub_chk" value="<?php echo $obj['id']; ?>" /></td> -->
                <td><?php echo $i;?></td>
                 <td>
                  <?php 
                    if($obj['transaction_date']=='0000-00-00'){
                      echo 'NA';
                    }
                    else{
                      echo date('d-m-Y',strtotime($obj['transaction_date']));
                    }?>
                </td>
                <td><?php echo $obj['voucher_code']; ?></td>
             <!--    <td style="white-space: nowrap;"><?php  
                    $voucher_no= $obj['worker_code']; 
                    if($voucher_no<10){
                    $worker_id_code='WC000'.$voucher_no;
                    }
                    else if(($voucher_no>=10) && ($voucher_no<=99)){
                      $worker_id_code='WC00'.$voucher_no;
                    }
                    else if(($voucher_no>=100) && ($voucher_no<=999)){
                      $worker_id_code='WC0'.$voucher_no;
                    }
                    else{
                      $worker_id_code='WC'.$voucher_no;
                    }
                    echo $obj['worker_name'].' ('.$worker_id_code.')';

                ?></td> -->
               <!--  <td style="white-space: nowrap;"><?php  
                    $voucher_no= $obj['emp_code']; 
                    if($voucher_no<10){
                    $employee_id_code='EC000'.$voucher_no;
                    }
                    else if(($voucher_no>=10) && ($voucher_no<=99)){
                      $employee_id_code='EC00'.$voucher_no;
                    }
                    else if(($voucher_no>=100) && ($voucher_no<=999)){
                      $employee_id_code='EC0'.$voucher_no;
                    }
                    else{
                      $employee_id_code='EC'.$voucher_no;
                    }
                    echo $obj['emp_name'].' ('.$employee_id_code.')';

                ?>
                </td> -->
                <td><?php echo $obj['employee']; ?></td>
                <td >
                   <a class="btn btn-xs btn-info btnEdit" data-toggle="modal" data-target="#view<?php echo $obj['id'];?>"><i style="color:#fff;"class="fa fa-eye"></i></a>
                 <a class="btn btn-xs btn-primary btnEdit" href="<?php echo base_url(); ?>index.php/Area_cleaning_records/edit/<?php echo $obj['id'];?>"><i class="fa fa-edit"></i></a>
                 <a class="btn btn-xs btn-danger btnEdit" data-toggle="modal" data-target="#delete<?php echo $obj['id'];?>"><i style="color:#fff;"class="fa fa-trash"></i></a>
               
                </td>

                    <div class="modal fade" id="view<?php echo $obj['id'];?>" role="dialog">
                      <div class="modal-dialog modal-lg">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                             <h4 class="modal-title"> Area Cleaning Record (<?php echo $obj['voucher_code'] ?>) Details </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                           
                          </div>
                          <div class="modal-body">
                              <div class="row" style="border: 1px solid #f3ecec;
                                  height: 45px;
                                  padding: 10px;
                                  margin: 0px;
                                  margin-bottom: 6px; font-weight: 500;" >
                                                             
                                <div class="col-md-1">#</div>
                                <div class="col-md-3">Area Name </div>
                                <div class="col-md-2">Work Status </div>
                                <div class="col-md-3">Completed By </div>
                                <div class="col-md-3">Remarks</div>
                              </div>

                                    <?php
                                      $j=1;foreach($obj['area_cleaning_details'] as $po_detail)
                                      { 
                                            $voucher_no= $po_detail['worker_code']; 
                                            if($voucher_no<10){
                                            $worker_id_code='WC000'.$voucher_no;
                                            }
                                            else if(($voucher_no>=10) && ($voucher_no<=99)){
                                              $worker_id_code='WC00'.$voucher_no;
                                            }
                                            else if(($voucher_no>=100) && ($voucher_no<=999)){
                                              $worker_id_code='WC0'.$voucher_no;
                                            }
                                            else{
                                              $worker_id_code='WC'.$voucher_no;
                                            }

                                        ?>
                                        <div class="row" style="border: 0px solid #f3ecec;
                                  height: 45px;
                                  padding: 10px;
                                  margin: 0px;
                                  margin-bottom: 6px;">
                                          <div class="col-md-1"><?= $j;?> </div>
                                          <div class="col-md-3"><?= $po_detail['area_name'] ;?> </div>
                                          <div class="col-md-2"><?= $po_detail['status_of_work'];?> </div>
                                          <div class="col-md-3">
                                            <?php 
                                              if($worker_id_code!='WC000')
                                            {
                                              echo $po_detail['worker_name'].' ('.$worker_id_code.')'; 
                                            }
                                            else{
                                                echo 'NA'; 
                                            }
                                            ?> 
                                          </div>
                                          <div class="col-md-3"><?= $po_detail['remark'] ;?> </div>
                                        </div>
                                  <?php $j++; }  ?>
                              </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="modal fade" id="delete<?php echo $obj['id'];?>" role="dialog">
                      <div class="modal-dialog">
                        <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Area_cleaning_records/deleteRecord/<?php echo $obj['id'];?>">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                             <h4 class="modal-title">Confirm Header </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                           
                          </div>
                          <div class="modal-body">
                            <p>Are you sure, you want to delete this Record ? </p>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary delete_submit"> Yes </button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"> No </button>
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

<script src="<?php echo base_url(); ?>assets/node_modules/jquery/dist/jquery.min.js"></script>
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
          url: "<?php echo base_url(); ?>index.php/Area_cleaning_records/deleteRecord",  
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