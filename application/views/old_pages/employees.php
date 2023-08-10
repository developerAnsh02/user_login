<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<style type="text/css">
	.select2{
		height:45px !important;
		width: 100% !important;
	}
  .btnEdit{
    width: 25%;
    border-radius: 5px;
    margin: 1px;
    padding: 1px;
  }

</style>
  <div class="container-fluid">
    <div class="card card-primary card-outline">
      <div class="card-header">
        <h3 class="card-title"><?= $title ?></h3>
        <div class="pull-right error_msg">
			<?php echo validation_errors();?>

			<?php if (isset($message_display)) {
			echo $message_display;
			} ?>
			<?php if (isset($error)) {
			echo $error;
			} ?>	
			<?php if (isset($success)) {
			echo $success;
			} ?>			
		</div>
	      </div> <!-- /.card-body -->
	      	<div class="card-body">
		      	<div class="row">
		      		<div class="col-md-12">
		      			<?php  //echo $title; exit; ?>
							<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Employees/add_new_employee" enctype="multipart/form-data">
				    		
					        <div class="form-group">
					        	<div class="row col-md-12">
					        		<div class="col-md-4 col-sm-4 ">
						            	<label class="control-label"> Name <span class="required">*</span></label>
						                <input type="text"  placeholder="Enter Full Name" name="name" class="form-control"  required autofocus>
						            </div>
						            <div class="col-md-4 col-sm-4 ">
						            	<label class="control-label"> Email <span class="required">*</span></label>
						                <input type="text"  placeholder="Enter email" name="email" class="form-control email" value=""  required autofocus>
						            </div>
						            <div class="col-md-4 col-sm-4 ">
						            	<label  class="control-label"> Role <span class="required">*</span></label>
						               <?php  echo form_dropdown('role_id', $roles, '', 'required="required"')
						            	?>
						            </div>
				        		</div>
				        	</div>
					        <div class="form-group"> 
						        <div class="row col-md-12">
						            <div class="col-md-4 col-sm-4 ">
						            	<label  class="control-label"> Country Code <span class="required">*</span></label>
						            
						            	<?php  echo form_dropdown('countrycode', $countries, '', 'required="required"')
						            	?>
						            </div>
						            <div class="col-md-4 col-sm-4 ">
						            	<label class="control-label"> Mobile No <span class="required">*</span></label>
						               	<input type="text" placeholder="Enter mobile" name="mobile_no" class="form-control mobile"  
			                			oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"   value="" required autofocus>
						            </div>
						            <div class="col-md-4 col-sm-4 ">
						            	<label  class="control-label"> Banks <span class="required">*</span></label>
						               <?php  echo form_dropdown('bank_id', $banks, '', 'required="required"')
						            	?>
						            </div>
						        </div>
						     </div>
						  
					        <div class="form-group"> 
						        <div class="row col-md-12">
					        		<div class="col-md-4 col-sm-4 ">
						            	<label class="control-label"> Upload Photo </label>
						                
						                <input type="file"  name="photo" class="form-control upload"  autofocus>
						            </div>
						            <div class="col-md-4 col-sm-4">
						            	<img id="blah" src="#" alt="your image"  class="hide" width="40%" />
						            </div>
						        </div>
					        </div>
				           <div class="row col-md-12">
					            <div class="col-md-12 col-sm-12 ">
					            	<label class="control-label" style="visibility: hidden;"> Name</label><br>
					            	<button type="submit" class="btn btn-primary btn-block">Save</button>
					            </div>
					        </div>
					        </form>
				        </div>
				 <!-- /form -->
				
			</div>
		</div>
	</div>
</div>

<script src="<?php echo base_url(); ?>assets/node_modules/jquery/dist/jquery.min.js"></script>

<script type="text/javascript">
	$( document ).ready(function() {
		function readURL(input) {

		  if (input.files && input.files[0]) {
		    var reader = new FileReader();

		    reader.onload = function(e) {
		    	$('#blah').removeClass('hide');
		    	$('#blah').addClass('show');
		      $('#blah').attr('src', e.target.result);
		    }

		    reader.readAsDataURL(input.files[0]);
		  }
		}
		$(".upload").change(function() {
			var file = this.files[0];
			var fileType = file["type"];
			var size = parseInt(file["size"]/1024);
			//alert(size);
			var validImageTypes = ["image/jpeg", "image/png"];
			if ($.inArray(fileType, validImageTypes) < 0) 
			{
			    alert('Invalid file type , please select jpg/png file only !');
			    $(this).val(''); 
			}
			if (size > 5000) 
			{
			    alert('Image size exceed , please select < 5MB file only !');
			    $(this).val(''); 
			}

		  readURL(this);
		});
	});
</script>