<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 $role_id=$this->session->userdata['logged_in']['role_id'];
 $email=$this->session->userdata['logged_in']['email'];
 //echo $role_id;exit;
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
							<form class="form-horizontal saveform" role="form" method="post" action="<?php echo base_url(); ?>index.php/Referrals/add_new_record" enctype="multipart/form-data">
				    		
					        <div class="form-group">
					        	
					        	<div class="row col-md-12">
					        		<div class="table-responsive">
					                <table id="maintable" class="table table-bordered table-striped">
					                  <thead>
					                    <tr>
					                      <th  >Sr.No.</th>
					                      <th style="white-space: nowrap;"> Name </th>
					                      <th style="white-space: nowrap;"> Email</th>
					                      <th> Country Code </th>
					                      <th style="white-space: nowrap;"> Mobile</th>
					                      <?php if($role_id != 2) { ?>
					                      <th  style="white-space: nowrap;"> Refer By </th>
					                    <?php }?>
					                      <th colspan="2" style="white-space: nowrap;\;"> Action Button</th>
					                    </tr>
					                  </thead>
					                 <tbody id="mainbody">
					                  	
					                  </tbody>
					              </table>
					          </div>
					      </div>
					  </div>
			           <div class="row col-md-12">
				            <div class="col-md-12 col-sm-12 ">
				            	<label class="control-label" style="visibility: hidden;"> Name</label><br>
				            	<button type="submit" class="btn btn-primary btn-block save">Save</button>
				            </div>
				        </div>
			        </form>
		        </div>				
			</div>
		</div>
	</div>
</div>

<table id="sample_table1" style="display: none;">
	<tbody>
		<tr class="main_tr1">
			<td >1</td>
      		<td > <input type="text" style="width:150px;" placeholder="Enter Full Name" name="name[]" class="form-control"  required autofocus></td>
      		<td >  <input type="text" style="width:250px;" placeholder="Enter email" name="email[]" class="form-control email" value=""  required autofocus></td>
      		<td >  <?php  echo form_dropdown('countrycode[]', $countries, '', 'required="required" id="my_drop" style="width:150px;"') ?></td>
      		<td > <input type="text" style="width:200px;"  placeholder="Enter mobile" name="mobile_no[]" class="form-control mobile" 
		oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"   value="" required autofocus></td>
		<?php if($role_id != 2) { ?>
		<td >  <?php  echo form_dropdown('refer_by_email[]', $useremails, '', 'required="required" id="my_drop" style="width:250px;"') ?></td>
	<?php } else{?>
	<td >  <input type="hidden" style="width:150px;" value="<?php echo $email; ?>" name="refer_by_email[]" class="form-control" readonly></td>
	<?php } ?>
		<td >
			<button type="button" class="btn btn-xs btn-primary addrow"  href="#" role='button'><i class="fa fa-plus"></i></button> 
			<button type="button" class="btn btn-xs btn-danger deleterow" href="#" role='button'><i class="fa fa-minus"></i></button>
		</td>
		</tr>
	</tbody>
</table>

<script src="<?php echo base_url()."assets/"; ?>plugins/jquery/jquery.min.js"></script>

<script type="text/javascript">
	$( document ).ready(function() {
		
		$('.saveform').submit(function() {
			
			var email_available="true";
			var mobile_available="true";
			$("#mainbody .email").each(function(){ 
				var email=$(this).val();
			
				$.ajax({
	                type: "Post",
	                url:"<?php echo base_url('index.php/Referrals/checkemail/'); ?>",
	                data: {email:email},
	                dataType: 'html',
					async: false, 
	                success: function (response) {
						
	                	if(response>0){
							email_available="false";
							return false;
						}
	                  
	                }
            	});
				
				
			});
			if(email_available=="false"){
				alert('Email is already exits.');
				return false;
			}
			
			$("#mainbody .mobile").each(function(){ 
				var mobile=$(this).val();
			
				$.ajax({
	                type: "Post",
	                url:"<?php echo base_url('index.php/Referrals/checkmobile/'); ?>",
	                data: {mobile:mobile},
	                dataType: 'html',
					async: false, 
	                success: function (response) {
						
	                	if(response>0){
							mobile_available="false";
							return false;
						}
	                  
	                }
            	});
				
				
			});
			if(mobile_available=="false"){
				alert('Mobile No. is already exits.');
				return false;
			}
			  
		});
		add_row();
		$('body').on('click','.addrow',function(){

			var table=$(this).closest('table');
			add_row();
			 rename_rows();
			 calculate_total(table);
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
				calculate_total(table);
			} 
		}
		}); 

		function rename_rows(){
		var i=0;
		$("#maintable tbody tr.main_tr1").each(function(){ 
			$(this).find("td:nth-child(1)").html(++i);
			//$(this).find("td:nth-child(4) select#my_drop").select2();
			//$(this).find("td:nth-child(4) select#select2-my_drop-container").hide();

			//$(this).find("td:nth-child(3) select.select2").select2();
			/*$(this).find("td:nth-child(2).code").attr({name:"labour_rows["+i+"][code_description]", id:"labour_rows-"+i+"-code_description"});*/
			
		});
	}

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