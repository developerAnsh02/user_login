<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 

?>
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
			<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Orders/add_new_order" enctype="multipart/form-data">

			    <div class="form-group">
		        	<div class="row col-md-12">
		        		 
			            <div class="col-md-4 col-sm-4">
		        			<label class="control-label">Customer Name</label>
				                  <input type="text" id="firstName" placeholder="Enter name" name="customer_name" class="form-control" value=""  autofocus autocomplete="off" required="">
				            </div>
			            
			            <div class="col-md-4 col-sm-4">
			            	<label  class="control-label">Order ID </label>
			            <input type="text"  name="c_code" class="form-control" value="<?= $customer_code?>"  autofocus readonly="readonly">
						<input type="hidden" name="customer_code" value="<?php echo $c_code;?>">
						</div>
			          
			            <div class="col-md-4 col-sm-4">
			            	<label  class="control-label"> Registration Date</label>
			            	  <input type="text" data-date-formate="dd-mm-yyyy" name="reg_date" class="form-control date-picker" value="<?php echo date('d-m-Y'); ?>" placeholder="dd-mm-yyyy" autofocus autocomplete="off" autocomplete="off">
			            </div>
		        	</div>
		        </div> 

		        <div class="form-group">
		        	<div class="row col-md-12">
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
			            
		        	</div>
		        </div>
		        <div class="form-group">
		        	<div class="row col-md-12">
		        		<div class="col-md-4 col-sm-4 ">
			        		<label class="control-label"> Billing Address Line 1</label>
			        		<textarea type="text" placeholder="Enter Billing address" name="billing_address1" class="form-control" rows="3" value=""  autofocus autocomplete="off" style="resize: none;"></textarea>
		        		</div>
		        		<div class="col-md-4 col-sm-4 ">
			        		<label class="control-label"> Billing Address Line 2</label>
			        		<textarea type="text" placeholder="Enter shipping address" name="billing_address2" class="form-control" rows="3" value=""  autofocus autocomplete="off" style="resize: none;"></textarea>
		        		</div>
		        		<div class="col-md-4 col-sm-4">
			            	<label class="control-label"> Postal Code </label>
			                <input type="text"  placeholder="Enter Postal Code" name="postal_code" class="form-control " value="" autofocus autocomplete="off"  maxlength="6" minlength="6" >
			            </div>
			            <div class="col-md-4 col-sm-4">
			            	<label class="control-label"> Tax Id </label>
			                <input type="text"  placeholder="Enter Tax ID" name="tax_id" class="form-control " value="" autofocus autocomplete="off"  >
			            </div>
		        	</div>
		        </div>
				 
				 <div class="form-group">
		        	<div class="row col-md-12">
		        		<div class="col-md-4 col-sm-4 country">
			            	<label  class="control-label"> Country</label>
			            	<?php  
			            		echo form_dropdown('country_id', $countries)
			            	?>	
			            </div>
			             <div class="col-md-4 col-sm-4 state">
			            	
			            </div>
			            <div class="col-md-4 col-sm-4 city">
			            	<!-- <label  class="control-label"> City</label> -->
			            	<?php  
			            		//echo form_dropdown('city_id', $cities)
			            	?>

			            </div>
		        	</div>
		        </div>	
		         <div class="form-group">
		        	<div class="row col-md-12">
		        		<fieldset>
		        			<legend> <b> Card Details </b></legend>
		        			<div class="table-responsive">
				        		<table id="maintable1" class="table">
				        			<thead style="background-color: #355fa9;color: #ffffff;">
				        				<tr>
				        					<th >S.No.</th>
				        					<th style="white-space: nowrap;"> Memorial Name</th>
				        					<th style="white-space: nowrap;"> Type Of Card</th>
				        					<th style="white-space: nowrap;"> Name On Card</th>
											<th style="white-space: nowrap;"> Card Number</th> 
											<th style="white-space: nowrap;"> Expiry</th> 
											<th style="white-space: nowrap;"> CVV</th> 
				        					<th style="white-space: nowrap;"> Action Button</th>
				        				</tr>
				        			</thead>
				        			<tbody id="mainbody1">
				        			
				        			</tbody>
				        		</table>
			        		</div>
		        		</fieldset>
		        	</div>
		        </div>	
		         <div class="form-group">
		        	<div class="row col-md-12">
		        		<fieldset>
		        			<legend> <b>Asset Profile Details </b></legend>
		        			<div class="table-responsive">
				        		<table id="maintable" class="table">
				        			<thead style="background-color: #355fa9;color: #ffffff;">
				        				<tr>
				        					<th >S.No.</th>
				        					<th style="white-space: nowrap;"> Custom Name</th>
				        					<th style="white-space: nowrap;"> Manufacturer Name</th>
				        					<th style="white-space: nowrap;"> Model Number</th>
											<th style="white-space: nowrap;"> SI Number</th> 
											<th style="white-space: nowrap;"> Location</th> 
											<th style="white-space: nowrap;"> Upload Bill</th> 
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
			  	<input type="text"  placeholder="Custom Name" name="name_of_asset[]" class="form-control " value="" style="width:250px !important;" autocomplete="off">
   			</td>
			<td> 
			  	<input type="text"  placeholder="Manufacturer Name" name="manufacturer_name[]" class="form-control " value="" style="width:250px !important;" autocomplete="off">
   			</td>
   			<td> 
			  	<input type="text"  placeholder="Model Number" name="model_number[]" class="form-control " value="" style="width:250px !important;" autocomplete="off">
   			</td>
   			<td> 
			  	<input type="text"  placeholder="SI Number" name="si_number[]" class="form-control " value="" style="width:250px !important;" autocomplete="off">
   			</td>
   			
			<td>
				<textarea type="text"  placeholder="Location" name="location[]" class="form-control " style="width:250px !important;" ></textarea>
			</td>
			<td>
				<input type="file" name="bill_image[]" class="form-control upload" style="width:250px !important;">
			</td>
			<td>
				<button type="button" class="btn btn-xs btn-primary addrow"  href="#" role='button'><i class="fa fa-plus"></i></button> 
				<button type="button" class="btn btn-xs btn-danger deleterow" href="#" role='button'><i class="fa fa-minus"></i></button>
			</td>
		</tr>
	</tbody>
</table>

<table id="sample_table2" style="display: none;">
	<tbody>
		<tr class="main_tr2">
			<td >1</td>
			<td> 
			  	<input type="text"  placeholder="Memorial Name For Card" name="card_memorial_name[]" class="form-control " value="" autofocus autocomplete="off" style="width:250px !important;" >
   			</td>
			<td> 
			  	 <select class="form-control" name="type_of_card[]" style="width:250px !important;">
               		<option value="Master Card"> Master Card</option>
               		<option value="Visa"> Visa</option>
               </select>
   			</td>
   			<td> 
			  	  <input type="text"  placeholder="Ex: Card Holder Name" name="name_on_card[]" class="form-control " value="" autofocus autocomplete="off" style="width:250px !important;">
   			</td>
   			<td> 
			  	<input type="text"  placeholder="Ex : 1234 6789 1010 2525" name="card_number[]" class="form-control " value="" autofocus autocomplete="off" style="width:250px !important;">
   			</td>
   			
			<td>
				<input type="text"  placeholder="Ex: MM/YY" name="expiry[]" class="form-control " value="" autofocus autocomplete="off" style="width:250px !important;">
			</td>
			<td>
				<input type="text"  placeholder="Ex: 456" name="cvv_code[]" class="form-control " value="" autofocus autocomplete="off" style="width:250px !important;">
			</td>
			<td>
				<button type="button" class="btn btn-xs btn-primary addrow1"  href="#" role='button'><i class="fa fa-plus"></i></button> 
				<button type="button" class="btn btn-xs btn-danger deleterow1" href="#" role='button'><i class="fa fa-minus"></i></button>
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
				$.ajax({
	                type: "POST",
	                url:"<?php echo base_url('index.php/Customers/getStates/') ?>"+country_id,
	                //data: {id:role_id},
	                dataType: 'html',
	                success: function (response) {
	                	//alert(response);
	                    $(".state").html(response);
	                    $('.select2').select2();
	                }
            	});
			}); 

		$(document).on('change','.state',function(){
				var state_id = $('.state').find('option:selected').val();
				//var aa= base_url+"index.php/Meenus/rolewisedata/"+role_id;
				//alert(state_id);
				$.ajax({
	                type: "POST",
	                url:"<?php echo base_url('index.php/Customers/getCities/') ?>"+state_id,
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