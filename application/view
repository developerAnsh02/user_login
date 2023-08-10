</div>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$role_id=$this->session->userdata['logged_in']['role_id'];
$url= current_url();
//print_r($completed_orders); exit;
?>

<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
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
        <h3 class="card-title"> <?= $title ?></h3>
        <div class="pull-right error_msg">
      <?php echo validation_errors();?>

      <?php if (isset($message_display)) {
      echo $message_display;
      } ?>    
    </div>

      </div> <!-- /.card-body -->
      <div class="card-body">

        <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Orders/ActionOrder" enctype="multipart/form-data">
			<input type="hidden" name="order_id" value="<?php echo $id;?>">
			<input type="hidden" name="uks_order_id" value="<?php echo $order_id;?>">
			<input type="hidden" name="status" value="<?php echo $projectstatus;?>">
			<input type="hidden" name="backurl" value="<?php echo $url;?>">
			<input type="hidden" name="c_email" value="<?php echo $c_email;?>">
			<input type="hidden" name="approved_date" value="<?= date('Y-m-d') ?>">
			<center> <b> <span> Order Id : <a href="<?php echo base_url(); ?>Orders/index?customer_id=0&order_id=<?php echo  $order_id ?>&from_date=&upto_date=&order_date_filter=order_date&status=&filter_check=title&title="> <?php echo $order_id;  ?> </a> </span> </b> </center>
           <div class="form-group">
              <div class="row col-md-12">
              <div class="col-md-12">
                <label  class="control-label"> Comment </label>
                    <textarea class="form-control Comment" rows="2" placeholder="Enter comment here" name="completed_comment"></textarea>
                </div>
              </div>
              <div class="col-md-12">
                  <fieldset>
                    <legend> <b>Upload Order Files </b></legend>
                    <div class="table-responsive">
                      <table id="maintable" class="table">
                        <thead style="background-color: #355fa9;color: #ffffff;">
                          <tr>
                            <th >S.No.</th>
                        <th style="white-space: nowrap;"> Upload Order Files</th> 
                            <th style="white-space: nowrap;"> Action Button</th>
                          </tr>
                        </thead>
                        <tbody id="mainbody">
                        
                        </tbody>
                      </table>
                    </div>
                  </fieldset>
               </div>

              </div>
            <div class="form-group">
              <div class="row col-md-12">
                <div class="col-md-12">
                  <button type="submit" class="btn btn-primary btn-block"> Click Here To Upload Files</button>
                </div>
            </div>
          </div>
        </form>

          <div class="form-group">
              <div class="row col-md-12">
                <div class="col-md-12">
                    <h4> Draft Delivered Files</h4>
                </div>
				
				<table class="table table-bordered table-striped">
					<tr>
					<td> Name</td>
						<td> Date Time</td>
						
						<td> Action</td>
					</tr>
					  <?php foreach ($completed_orders as $key => $value) { ?>
					  <tr>
					  <td>
							 <a href="<?php echo $value['file_path']; ?>" target="_blank"><?php $name=explode('/',$value['file_path']); echo $name[5];  ?></a>
						</td>
						<td> <?= date("d-m-Y H:i:s",strtotime($value['updated_on'])) ?></td>
						
						<td>
							 <?php if($role_id == '1'){ ?>
								<a class="btn btn-xs btn-danger" style="margin-bottom: 5px;" data-toggle="modal" data-target="#delete<?php echo $value['id'];?>"><i style="color:#fff;"class="fa fa-trash"></i></a>
							<?php } ?>
								 <div class="modal fade" id="delete<?php echo $value['id'];?>" role="dialog">
								  <div class="modal-dialog">
									<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Orders/deleteCompletedFile/<?php echo $value['id'];?>">
									<!-- Modal content-->
									<div class="modal-content">
									  <div class="modal-header">
										 <h4 class="modal-title">Confirm Header </h4>
										<button type="button" class="close" data-dismiss="modal">&times;</button>
									  </div>
									  <div class="modal-body">
									      <input type="hidden" name="urlll" value="<?php echo $url;?>">
										<p>Are you sure, you want to delete Order file <b><?php echo $value['file_path'];?> </b>? </p>
									  </div>
									  <div class="modal-footer">
										<button type="submit" class="btn btn-primary ">Submit</button>
										<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
									  </div>
									</div>
									</form>
								  </div>
								</div>
						</td>
					  </tr>
					 <?php } ?>
				</table>
				
				
               
              </div>
              <div class="form-group">
              <div class="row col-md-12">
                <div class="col-md-12">
                    <h4> Order Delivered Files</h4>
                </div>
				
				<table class="table table-bordered table-striped">
					<tr>
					<td> Name</td>
						<td> Date Time</td>
						
						<td> Action</td>
					</tr>
					  <?php foreach ($delivered_orders as $key => $value) { ?>
					  <tr>
					  <td>
							 <a href="<?php echo $value['file_path']; ?>" target="_blank"><?php $name=explode('/',$value['file_path']); echo $name[5];  ?></a>
						</td>
						<td> <?= date("d-m-Y H:i:s",strtotime($value['updated_on'])) ?></td>
						
						<td>
							 <?php if($role_id == '1'){ ?>
								<a class="btn btn-xs btn-danger" style="margin-bottom: 5px;" data-toggle="modal" data-target="#delete<?php echo $value['id'];?>"><i style="color:#fff;"class="fa fa-trash"></i></a>
							<?php } ?>
								 <div class="modal fade" id="delete<?php echo $value['id'];?>" role="dialog">
								  <div class="modal-dialog">
									<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Orders/deleteCompletedFile/<?php echo $value['id'];?>">
									<!-- Modal content-->
									<div class="modal-content">
									  <div class="modal-header">
										 <h4 class="modal-title">Confirm Header </h4>
										<button type="button" class="close" data-dismiss="modal">&times;</button>
									  </div>
									  <div class="modal-body">
									      <input type="hidden" name="urlll" value="<?php echo $url;?>">
										<p>Are you sure, you want to delete Order file <b><?php echo $value['file_path'];?> </b>? </p>
									  </div>
									  <div class="modal-footer">
										<button type="submit" class="btn btn-primary ">Submit</button>
										<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
									  </div>
									</div>
									</form>
								  </div>
								</div>
						</td>
					  </tr>
					 <?php } ?>
				</table>
				
				
               
              </div>
              <div class="form-group">
              <div class="row col-md-12">
                <div class="col-md-12">
                    <h4> Feedback Delivered Files</h4>
                </div>
				
				<table class="table table-bordered table-striped">
					<tr>
					<td> Name</td>
						<td> Date Time</td>
						
						<td> Action</td>
					</tr>
					  <?php foreach ($feedback_delivered_file as $key => $value) { ?>
					  <tr>
					  <td>
							 <a href="<?php echo $value['file_path']; ?>" target="_blank"><?php $name=explode('/',$value['file_path']); echo $name[5];  ?></a>
						</td>
						<td> <?= date("d-m-Y H:i:s",strtotime($value['updated_on'])) ?></td>
						
						<td>
							 <?php if($role_id == '1'){ ?>
								<a class="btn btn-xs btn-danger" style="margin-bottom: 5px;" data-toggle="modal" data-target="#delete<?php echo $value['id'];?>"><i style="color:#fff;"class="fa fa-trash"></i></a>
							<?php } ?>
								 <div class="modal fade" id="delete<?php echo $value['id'];?>" role="dialog">
								  <div class="modal-dialog">
									<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Orders/deleteCompletedFile/<?php echo $value['id'];?>">
									<!-- Modal content-->
									<div class="modal-content">
									  <div class="modal-header">
										 <h4 class="modal-title">Confirm Header </h4>
										<button type="button" class="close" data-dismiss="modal">&times;</button>
									  </div>
									  <div class="modal-body">
									      <input type="hidden" name="urlll" value="<?php echo $url;?>">
										<p>Are you sure, you want to delete Order file <b><?php echo $value['file_path'];?> </b>? </p>
									  </div>
									  <div class="modal-footer">
										<button type="submit" class="btn btn-primary ">Submit</button>
										<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
									  </div>
									</div>
									</form>
								  </div>
								</div>
						</td>
					  </tr>
					 <?php } ?>
				</table>
				
				
               
              </div>
            </div>


      </div>
    </div>
  </div>

  <table id="sample_table1" style="display: none;">
  <tbody>
    <tr class="main_tr1">
      <td >1</td>
      <td>
        <input type="file" name="offer_images[]" class="form-control upload" required="required" >
      </td>
      <td>
        <button type="button" class="btn btn-xs btn-primary addrow"  href="#" role='button'><i class="fa fa-plus"></i></button> 
        <button type="button" class="btn btn-xs btn-danger deleterow" href="#" role='button'><i class="fa fa-minus"></i></button>
      </td>
    </tr>
  </tbody>
</table>

    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="<?php echo base_url()."assets/"; ?>plugins/jquery/jquery.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {

    add_row();
    rename_rows();
   
    $('body').on('click','.addrow',function(){

      var table=$(this).closest('table');
      add_row();
      rename_rows();
      });
     
    
    function add_row(){ 
      var tr1=$("#sample_table1 tbody tr").clone();
      $("#maintable tbody#mainbody").append(tr1);
    }
    
    $('body').on('click','.deleterow',function(){
      
    var table=$(this).closest('table');
    var rowCount = $("#maintable tbody tr.main_tr1").length;
    if (rowCount>1){
      if (confirm("Are you sure to remove row ?") == true) {
        $(this).closest("tr").remove();
        rename_rows();
      } 
    }
    }); 


    function rename_rows(){
    var i=0;

    $("#maintable tbody tr.main_tr1").each(function(){ 
      $(this).find("td:nth-child(1)").html(++i);
      //var rowCount1 = $("#maintable tbody tr.main_tr1").length;
      //alert(rowCount1);
     
    });
  }
 });

</script>

