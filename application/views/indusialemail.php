<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 $role_id=$this->session->userdata['logged_in']['role_id'];

?>
<div class="page-wrapper">
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
			<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Orders/emailindusial" enctype="multipart/form-data">

		          <div class="form-group">
		        	<div class="row col-md-12">
		        		<div class="col-md-6 col-sm-6">
		        			<label  class="control-label"> To </label>
		        			<input type="text"  name="to" class="form-control" value=""  autofocus placeholder="Enter to">
							<input type="hidden" name="order_id" value="<?= $id ?>">
							<input type="hidden" name="word" value="<?= $pages ?>">
							<input type="hidden" name="deadline" value="<?= $writer_deadline ?>">
							<input type="hidden" name="formatting" value="<?= $formatting ?>">
							
							<textarea name="message" style="display:none;"><?= $message ?>"</textarea>
		        		</div>
		        	
		        		<div class="col-md-6 col-sm-6 ">
		        			<label  class="control-label">Subject</label>
			            	<input type="text"  name="subject" class="form-control" value="<?= $order_id ?>"  autofocus placeholder="Subject">
		        		</div>

		        	</div>
					<div class="col-md-12">
						<label  class="control-label"> Email Content </label>
							<div>
								<p><br/> Hi,<br/><br/>

								Kindly find the details of the work:<br/><br/> 

								Word count: <?= $pages ?>  <br/><br/>

								Deadline:  <?= $writer_deadline ?>   <br/><br/>

								

								Additional Details: <br/> <?= $message ?> <br/><br/>

								Still, if you need any other information please let us know. <br/><br/>
								
								****************************************************************<br/><br/>
								Thanks & Regards,<br/>
		
								</p>
							</div>
					</div>
					<div class="col-md-12">
							<label  class="control-label">Attachment Files</label><br/>
							<?php  foreach($files as $file){ ?>
							<input type="hidden" name="files[]" value="<?php echo $file['file']; ?>">
							 <a href="<?php echo $file['file']; ?>" target="_blank">
                                        <?php
                                         $name=explode('/',$file['file']);
                                        
                                         if($order_type=="Website"){
                                            echo $name[4];
                                         }else{
                                           echo $name[5]; 
                                         }
                                         ?>
                                    </a><br/>
							<?php } ?>
					</div>
		        </div>
		       
		 		
            
		              		        
		        <button type="submit" class="btn btn-primary btn-block"> Send Email</button>
		    </form> <!-- /form -->
		</div>
	</div>
</div>
</div>

 					
<script src="<?php echo base_url()."assets/"; ?>plugins/jquery/jquery.min.js"></script>
