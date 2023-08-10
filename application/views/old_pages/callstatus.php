<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 $role_id=$this->session->userdata['logged_in']['role_id'];
 $currentURL = current_url(); 
?>

<style>
	@media only screen and (max-width: 600px) {
	.mobile-display{
		width:100% !important;
	}
	.mobile-displaynew{
		width:90% !important;
	}
	}
</style>
  <div class="container-fluid">
    <div class="card card-primary card-outline">
      <div class="card-header" style="background: #355fa9;">
        <h3 class="card-title" style="color:white;">Call Status Update</h3>
        <div class="pull-right error_msg">
			<?php echo validation_errors();?>

			<?php if (isset($message_display)) {
			echo $message_display;
			} ?>		
		</div>

      </div> <!-- /.card-body -->
	  
	  
	  
	  
      <div class="card-body">
	  <div>
			<form style="" class="form-horizontal mobile-display" role="form" method="post" action="<?php echo base_url(); ?>index.php/Orders/callstatusadd" enctype="multipart/form-data">
				<input type="hidden" name="order_id" value="<?= @$order_id ?>">
				<input type="hidden" name="backurl" value="<?= $currentURL ?>">
			    <div class="form-group">
		        	<div class="row col-md-12">
                       <div class="col-md-12 col-sm-12">
			            	<label  class="control-label"> Status</label>
			            	  <input type="text"  name="status" class="form-control"  placeholder="Status" id="first" autofocus autocomplete="off" autocomplete="off">
			            </div>
						
		        	</div>
					
					 <div class="row col-md-12">
					  <div class="col-md-12 col-sm-12">
			        		<label class="control-label">  Descriptions</label>
			        		<textarea type="text" placeholder="Enter Descriptions" name="description" class="form-control" rows="2" value=""  autofocus autocomplete="off" style="resize: none;"></textarea>
		        		</div>
					</div>
					 <div class="row col-md-12">
					  <div class="col-md-12 col-sm-12">
					  <br/>
						<button type="submit" class="btn btn-primary btn-block"> Save</button>
							</div>
					</div>
		        </div> 
		        
		              		        
		        
		    </form> <!-- /form -->
			</div>
			</div>
			<br/>
			
			<div class="col-md-12"> 
				
              <!-- /.card-header -->
              <div class="card-body" style="display: block;">
               
			    <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped">
			  <thead>
				<tr>

				  <th >Sr.No.</th>
				  <th> Date & Time</th>
				  <th> Status</th>
				  <th> Description</th>
				</tr>
			 </thead>
          <tbody>
		   <?php
		  
          $i=0;foreach($call_lists as $call_list){ ?>
			<tr>
				<td> <?php echo ++$i; ?></td>
				<td> <?php echo date("d-m-Y H:i:s",strtotime($call_list['created_on'])); ?></td>
				<td> <?php echo $call_list['status']; ?></td>
				<td> <?php echo $call_list['description']; ?></td>
			</tr>
		  <?php } ?>
		  </tbody>
		</table>
              </div>
              <!-- /.card-body -->
             
            </div>
			
			
			
		
	</div>
</div>
 					
<script src="<?php echo base_url()."assets/"; ?>plugins/jquery/jquery.min.js"></script>



<script type="text/javascript">
	$(document).ready(function() {

	});
		
</script> 