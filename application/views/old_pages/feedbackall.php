<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 $role_id=$this->session->userdata['logged_in']['role_id'];

?>
  <div class="container-fluid">
    <div class="card card-primary card-outline">
      <div class="card-header" style="background: #355fa9;">
        <h3 class="card-title" style="color:white;"> <?= $title ?></h3>
        <div class="pull-right error_msg">
			<?php echo validation_errors();?>

			<?php if (isset($message_display)) {
			echo $message_display;
			} ?>		
		</div>

      </div> <!-- /.card-body -->
	  
	  
	  
	  
     <div class="card-body">
	   <table id="example1" class="table table-bordered table-striped">
		   <thead>
				<tr>
					<th >Sr.No.</th>
					<th>Date </th>
					<th >Order Code</th> 
					<th >User Name</th>
					<th >Title</th>
					<th >description</th>
					<th>Document</th>
					<th>Action</th>
				 </tr>
			</thead>
			 <tbody>
			 <?php $i=0; foreach($feedback_lits as $feedback_lit){ ?>
				 <tr <?php if($feedback_lit['status']==0){?> style="font-weight: 700;" <?php } ?> class="feedbackall" feedback_id="<?= $feedback_lit['id']; ?>">
					<td><?= ++$i ?></td>
					<td><?= date("d-m-Y",strtotime($feedback_lit['created_at'])) ?></td>
					<td><?= $feedback_lit['code'] ?></td>
				 	<td><?= $feedback_lit['c_name'] ?></td>
				 	<td><?= $feedback_lit['title'] ?></td>
				 	<td><?= $feedback_lit['description'] ?></td>
					 <td> <a href="<?php echo base_url(); ?>/uploads/customers/<?php echo $feedback_lit['image']; ?>" target="_blank"> <?php echo $feedback_lit['image']; ?> </a></td>
					<td> 
					<a class="btn btn-xs btn-danger btnEdit" data-toggle="modal" data-target="#delete<?php echo $feedback_lit['id'];?>"><i style="color:#fff;"class="fa fa-trash"></i></a>
						<div class="modal fade" id="delete<?php echo $feedback_lit['id'];?>" role="dialog">
						  <div class="modal-dialog">
							<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Orders/deletefeedback/<?php echo $feedback_lit['id'];?>">
							<!-- Modal content-->
							<div class="modal-content">
							  <div class="modal-header">
								 <h5 class="modal-title">Confirm Header </h5>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							   
							  </div>
							  <div class="modal-body">
								<p>Are you sure, you want to delete Feedback ? </p>
							  </div>
							  <div class="modal-footer">
								<button type="submit" class="btn btn-primary ">Yes</button>
								<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
							  </div>
							</div>
							</form>
						  </div>
						</div>
					</td>
				 </tr>
			 <?php } ?>
			 </tbody>
	   </table>
		
	</div>
</div>
 					
<script src="<?php echo base_url()."assets/"; ?>plugins/jquery/jquery.min.js"></script>



<script type="text/javascript">
	$(document).ready(function() {
		$('.feedbackall').on('click',function(){
			
		})
	});
		
</script> 