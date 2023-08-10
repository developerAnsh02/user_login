<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
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
			<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Engineers/add_new_engineer" enctype="multipart/form-data">

			    <div class="form-group">
		        	<div class="form-group row col-md-12">
			            <div class="col-md-4 col-sm-4">
		        			<label class="control-label">Engineer Name</label>
				                  <input type="text" id="engineer_name" placeholder="Enter name" name="engineer_name" class="form-control" value=""  autofocus autocomplete="off" autocomplete="off" >
				            </div>
			            
			            <div class="col-md-4 col-sm-4">
			            	<label  class="control-label">Engineer Code</label>
			                <!--<input type="text" id="lastName" placeholder="Enter vendor code" name="vendor_code" class="form-control customer_code" value=""  autofocus autocomplete="off">-->
			            <input type="text"  name="e_code" class="form-control" value="<?= $engineer_code?>"  autofocus readonly="readonly">
						<input type="hidden" name="engineer_code" value="<?php echo $engineer_code;?>">
						</div>
			          
			            <div class="col-md-4 col-sm-4">
			            	<label  class="control-label"> Registration Date</label>
			            	  <input type="text" data-date-formate="dd-mm-yyyy" name="reg_date" class="form-control date-picker" value="<?php echo date('d-m-Y'); ?>" placeholder="dd-mm-yyyy" autofocus autocomplete="off" autocomplete="off">
			            </div>
			             <div class="col-md-4 col-sm-4">
			            	<label  class="control-label"> Date Of Birth</label>
			            	  <input type="text" data-date-formate="dd-mm-yyyy" name="dob" class="form-control date-picker" value="" placeholder="dd-mm-yyyy" autofocus autocomplete="off" autocomplete="off">
			            </div>
			           	<div class="col-md-8 col-sm-8">
			           	    <label class="control-label"> Phone</label>
			           	    <div class="input-group input-group-sm mb-6">
				                  <div class="input-group-prepend">
					           		<select name="country_code"  required="required" >
						                <?php
						                 if ($country_codes): ?>  
						                  <?php 
						                    foreach ($country_codes as $value) : ?>
							                    <option value="+<?= $value['isd_code'] ?>"><?= $value['country_name'].' ('.$value['isd_code'].')'?></option>
						                    <?php   endforeach;  ?>
						                <?php else: ?>
						                    <option value="0">No result</option>
						                <?php endif; ?>
						            </select> &nbsp;
				                	<input type="text"  placeholder="Enter phone number" name="mobile_no" class="form-control" value=""  autofocus autocomplete="off" style="width: 280px;">
			            		</div>
			            	</div>
			            </div>
		    
		        		<div class="col-md-4 col-sm-4">
			            	<label  class="control-label"> Email</label>
			                <input type="email" id="lastName" placeholder="Ex. abc@gmail.com" name="email" class="form-control email" value="" autofocus autocomplete="off">
			            </div>
			            <div class="col-md-4 col-sm-4">
			            	<label  class="control-label"> Category</label>
			                <?php  
			            		echo form_multiselect('categories_ids[]', $categories)
			            	?>	
			            </div>
			            <div class="col-md-4 col-sm-4">
			            	<label  class="control-label"> Services</label>
			               <?php  
			            		echo form_multiselect('services_ids[]', $services)
			            	?>	
			            </div>
			       	</div>
			        <div class="form-group row col-md-12">

		        		<div class="col-md-4 col-sm-4">
			            	<label class="control-label"> Postal Code </label>
			                <input type="text"  placeholder="Enter Postal Code" name="postal_code" class="form-control " value="" autofocus autocomplete="off"  maxlength="6" minlength="6" >
			            </div>
		        		<div class="col-md-8 col-sm-8 ">
			        		<label class="control-label">  Address </label>
			        		<textarea type="text" placeholder="Enter  address" name="address" class="form-control"  value=""  autofocus autocomplete="off" style="resize: none;"></textarea>
		        		</div>
		        		<div class="col-md-4 col-sm-4 country">
			            	<label  class="control-label"> Country</label>
			            	<?php  
			            		echo form_dropdown('country_id', $countries)
			            	?>	
			            </div>
			             <div class="col-md-4 col-sm-4 state">
			            	
			            </div>
			            <div class="col-md-4 col-sm-4 city">
			            
			            </div>
		        	
		        	</div>
		        	<div class="form-group row col-md-12">
		        		<div class="col-md-6 col-sm-6 passport_div">
			        		<label class="control-label"> Upload  Passport <span style="color:red;"> *</span></label>
			        		<input type="file" name="passport_file" class="form-control passport" style="width:350px !important;">
		        		</div>
		        		<div class="col-md-4 col-sm-4 profile_photo">
			        		<label class="control-label"> Profile Photo <span style="color:red;"> *</span></label>
			        		<input type="file" name="profile_photo" class="form-control profile_photo" >
		        		</div>
		        		<div class="col-md-8 col-sm-8 ">
			        		<label class="control-label">  Short Bio </label><span> (100 word minimum)</span>
			        		<textarea type="text" placeholder="Write Something About Yourself" name="short_bio" class="form-control"  value=""  autofocus autocomplete="off" style="resize: none;"></textarea>
		        		</div>
		        	</div>
		        </div>
		         
		         <div class="form-group">
		        		<fieldset>
		        			<legend> <b> Bank Details</b></legend>
		        				<div class="row col-md-12">
				        			<div class="col-md-4 col-sm-4">
				        				<label class="control-label"> Account Holder Name </label>
						                <input type="text" id="account_name" placeholder="Enter Account Holder Name" name="account_name" class="form-control" value=""  autofocus autocomplete="off" autocomplete="off" >
						            </div>
						            <div class="col-md-4 col-sm-4">
				        				<label class="control-label"> IFS/SORT/SWIFT/BIC Code </label>
						                <input type="text" id="firstName" placeholder="Enter code here" name="ifsc_code" class="form-control" value=""  autofocus autocomplete="off" autocomplete="off" >
						            </div>
						             <div class="col-md-4 col-sm-4">
				        				<label class="control-label"> Account Number </label>
						                <input type="text" id="firstName" placeholder="Enter account number" name="account_no" class="form-control" value=""  autofocus autocomplete="off" autocomplete="off" >
						            </div>
						        </div>
		        		</fieldset>
		        	</div>
		        
		         <div class="form-group">
		        		<fieldset>
		        			<legend> <b> Upload Documents</b></legend>
		        			<div class="form-group row col-md-12">
		        				<div class="table-responsive">
					        		<table id="maintable" class="table">
					        			<thead style="background-color: #355fa9;color: #ffffff;">
					        				<tr>
					        					<th >S.No.</th>
					        					<th style="white-space: nowrap;"> Document Name</th>
												<th style="white-space: nowrap;"> Upload File</th> 
					        					<th style="white-space: nowrap;"> Action Button</th>
					        				</tr>
					        			</thead>
					        			<tbody id="mainbody">
					        			
					        			</tbody>
					        		</table>
				        		</div>
				        	</div>
		        		</fieldset>
		        	</div>
		        </div>	      		        
		        <button type="submit" class="btn btn-primary btn-block"> Save</button>
		    </form> <!-- /form -->
		</div>
	</div>
</div>
<table id="sample_table1" style="display: none;">
	<tbody>
		<tr class="main_tr1">
			<td >1</td>
			<td> 
			  	<select name="document_id[]" class="form-control " required="required" style="width:350px !important;">
	                <?php
	                 if ($documents): ?> 
	                  <?php 
	                    foreach ($documents as $value) : ?>
	                        <?php 
								if ($value['id'] == $current[0]->categories_id): ?>
		                            <option value="<?= $value['id'] ?>" selected><?= $value['document_name'] ?></option>
		                        <?php else: ?>
		                            <option value="<?= $value['id'] ?>"><?= $value['document_name'] ?></option>
		                        <?php endif;   ?>
	                    <?php   endforeach;  ?>
	                <?php else: ?>
	                    <option value="0">No result</option>
	                <?php endif; ?>
	            </select>
   			</td>
			<td>
				<input type="file" name="files[]" class="form-control upload" style="width:350px !important;">
			</td>
			<td>
				<button type="button" class="btn btn-xs btn-primary addrow"  href="#" role='button'><i class="fa fa-plus"></i></button> 
				<button type="button" class="btn btn-xs btn-danger deleterow" href="#" role='button'><i class="fa fa-minus"></i></button>
			</td>
		</tr>
	</tbody>
</table>



 					
<script src="<?php echo base_url()."assets/"; ?>plugins/jquery/jquery.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {

		add_row();
		rename_rows();
		add_row1();
		rename_rows1();
		$('body').on('click','.addrow',function(){

			var table=$(this).closest('table');
			add_row();
			rename_rows();
			calculate_total(table);
	    });
	    $('body').on('click','.addrow1',function(){

			var table=$(this).closest('table');
			add_row1();
			rename_rows1();
	    });
		
		function add_row(){ 
			var tr1=$("#sample_table1 tbody tr").clone();
			$("#maintable tbody#mainbody").append(tr1);
		}
		function add_row1(){ 
			var tr2=$("#sample_table2 tbody tr").clone();
			$("#maintable1 tbody#mainbody1").append(tr2);
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
		$('body').on('click','.deleterow1',function(){
			
		var table=$(this).closest('table');
		var rowCount = $("#maintable1 tbody tr.main_tr2").length;
		if (rowCount>1){
			if (confirm("Are you sure to remove row ?") == true) {
				$(this).closest("tr").remove();
				rename_rows1();
			} 
		}
		}); 


		function rename_rows(){
		var i=0;

		$("#maintable tbody tr.main_tr1").each(function(){ 
			$(this).find("td:nth-child(1)").html(++i);
			var rowCount1 = $("#maintable tbody tr.main_tr1").length;
			//alert(rowCount1);
			$(this).find("td:nth-child(7) input.upload").change(function() {
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
			});

			$('.total_workers').val(rowCount1);

		});
	}

	function rename_rows1(){
		var i=0;

		$("#maintable1 tbody tr.main_tr2").each(function(){ 
			$(this).find("td:nth-child(1)").html(++i);
		});
	}

		$(document).on('change','.country',function(){
				var country_id = $('.country').find('option:selected').val();
				//var aa= base_url+"index.php/Meenus/rolewisedata/"+role_id;
				//alert(country_id);
				if(country_id=='230'){
					$('.passport_div').addClass('hide');
					$(".passport").removeAttr('required');

				}else{
					$('.passport_div').removeClass('hide');
					$(".passport").attr('required');
				}
				$.ajax({
	                type: "POST",
	                url:"<?php echo base_url('index.php/Engineers/getStates/') ?>"+country_id,
	                //data: {id:role_id},
	                dataType: 'html',
	                success: function (response) {
	                	//alert(response);
	                    $(".state").html(response);
	                    $('.select2').select2();
	                    
	                }
            	});
			}); 

		$(document).on('blur','#account_name',function(){
			var account_name=$(this).val();
			var engineer_name=$('#engineer_name').val();

			if(account_name != engineer_name){
				alert(" Account Name should be same as Engineer Name");
				$(this).val('');
			}

		});
		$(document).on('change','.state',function(){
				var state_id = $('.state').find('option:selected').val();
				//var aa= base_url+"index.php/Meenus/rolewisedata/"+role_id;
				//alert(state_id);
				$.ajax({
	                type: "POST",
	                url:"<?php echo base_url('index.php/Engineers/getCities/') ?>"+state_id,
	                //data: {id:role_id},
	                dataType: 'html',
	                success: function (response) {
	                	//alert(response);
	                    $(".city").html(response);
	                    $('.select2').select2();
	                    
	                }
            	});
			}); 

	
	});
</script> 