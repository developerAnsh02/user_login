<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 $role_id=$this->session->userdata['logged_in']['role_id'];
 $currentURL = current_url(); 
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
        <h3 class="card-title"> <?= $title ?></h3>
        <div class="pull-right error_msg">
           <a href="<?php echo base_url(); ?>index.php/Orders/payments/<?php echo $id;?>"
                  class="btn btn-xs btn-primary " > Add Payment  <i style="color:#fff;"class="fa fa-money"> </i>
              </a> 
			<?php echo validation_errors();?>

			<?php if (isset($message_display)) {
			echo $message_display;
			} ?>		
		</div>

      </div> <!-- /.card-body -->
      <div class="card-body">
			<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Orders/editorder/<?= $id ?>" enctype="multipart/form-data">
			<input type="hidden" name="backurl" value="<?= $currentURL ?>">
            <input type="hidden" name="edit_id" value="<?= $id?>">
			    <div class="form-group">
		        	<div class="row col-md-12">
                         <?php if($role_id !='2') {  ?>
			            <div class="col-md-4 col-sm-4">
		        			<label class="control-label">Select Customer</label>
                            <?php  echo form_dropdown('user_id', $users,$user_id, '', 'required="required"')
                            ?>	
				        </div>
                     <?php } else { ?>
                        <input type="hidden" name="user_id" value="<?= @$user_id?>">
                    <?php } ?>
			            <div class="col-md-4 col-sm-4">
			            <label  class="control-label">Order ID </label>
			            <input type="text"  name="order_id" class="form-control" value="<?= $order_id?>"  autofocus readonly="readonly">
						<input type="hidden" name="order_type" value="<?php echo $order_type; ?>">
						</div>
			          
			            <div class="col-md-4 col-sm-4">
			            	<label  class="control-label"> Order Date</label>
			            	  <input type="text" data-date-formate="dd-mm-yyyy" name="order_date" class="form-control date-picker order_date" value="<?php echo date('d-m-Y',strtotime($order_date)); ?>" placeholder="dd-mm-yyyy" autofocus autocomplete="off" autocomplete="off" id="first">
			            </div>
		        	</div>
		        </div> 
		          <div class="form-group">
		        	<div class="row col-md-12">
		        		<div class="col-md-4 col-sm-4">
                            <label  class="control-label"> Formatting & Citation Style</label>
                             <select class="form-control" required  name="formatting">
                                <option value="">Please Choose any one</option>
                               <?php
                                 foreach ($formattings as $key => $value) { 
                                    if($formatting==$value['formatting_name']){
                                    ?>
                                      <option value="<?= $value['formatting_name']?>"selected ><?= $value['formatting_name']?></option>
                                  <?php } else { ?>
                                       <option value="<?= $value['formatting_name']?>" ><?= $value['formatting_name']?></option>

                               <?php  }} ?>
                            </select>
                        </div>
		        		
		        		<div class="col-md-8 col-sm-8 ">
		        			<label  class="control-label">Project Title </label>
			            	<input type="text"  name="title" class="form-control"  autofocus placeholder="Enter Project Title" value="<?= $project_title ?>">
		        		</div>

		        	</div>
		        </div>
		        <div class="form-group">
		        	<div class="row col-md-12">
		        		<div class="col-md-4 col-sm-4">
                            <label>Type of service :</label>

                            <select name="typeofservice"  class="form-control typeofservice lockkey">
                                 <option value="" typservice="">Choose type of service</option>
                                <?php
                                 foreach ($services as $key => $value) { 
                                    if($service==$value['service_name']){
                                   
                                    ?>
                                    <option value="<?= $value['service_name']?>" typservice="<?= $value['factor']?>" selected ><?= $value['service_name']?> </option>
                                      <?php } else { ?>
                                      <option value="<?= $value['service_name']?>" typservice="<?= $value['factor']?>"><?= $value['service_name']?></option>

                               <?php  } } ?>
                           </select>
                        </div>
		        		<div class="col-md-4 col-sm-4">
                            <label class="control-label" for="datepicker">Select Deadline</label>
                              <!--   <select class="form-control timeline" required name="deadline">
                                <option value="" deadline="" >Select Timeline</option>
                                <?php
                                 foreach ($timelines as $key => $value) {
                                     if($deadline==$value['timeline']){
                                   
                                  ?>
                                     <option value="<?= $value['timeline']?>" selected deadline="<?= $value['factor']?>"><?= $value['timeline']?></option>
                                    <?php } else { ?>
                                      <option value="<?= $value['timeline']?>" deadline="<?= $value['factor']?>"><?= $value['timeline']?></option>

                               <?php  }} ?>
                                </select> -->
                                <input type="text" data-date-formate="dd-mm-yyyy" name="delivery_date" class="form-control date-picker delivery_date" value="<?php echo  date("d-m-Y", strtotime($delivery_date));; ?>" placeholder="dd-mm-yyyy" autofocus autocomplete="off" id="second" autocomplete="off">
                        </div>
		        		<div class="col-md-4 col-sm-4 ">
                            <label>Type of Paper :</label>
                                <select class="form-control typeofpaper lockkey"required  name="typeofpaper">
                                    <option value="" typpaper="">Click to select</option>
                                    <?php
                                 foreach ($typeofpapers as $key => $value) { 
                                      if($typeofpaper==$value['paper_type']){
                                      
                                    ?>
                                      <option value="<?= $value['paper_type']?>" selected typpaper="<?= $value['factor']?>"><?= $value['paper_type']?></option>
                                       <?php } else { ?>

                                        <option value="<?= $value['paper_type']?>"  typpaper="<?= $value['factor']?>"><?= $value['paper_type']?></option>
                               <?php  } } ?>

                                    
                                </select>
                        </div>

		        	</div>
		        </div>
		 		<div class="form-group">
		        	<div class="row col-md-12">
		        		 <div class="col-md-4 col-sm-4">
                            <label>Type of writing *:</label>
                            <select class="form-control typeofwritting lockkey" required name="typeofwritting">
                                <option value="" typwrtg="" >Choose type of writing</option>
                                <?php
                                    foreach ($typeofwritings as $key => $value) {
                                    if($typeofwritting==$value['type_of_writing']){
                                    
                                     ?>

                                    <option value="<?= $value['type_of_writing']?>" selected typwrtg="<?= $value['factor']?>"><?= $value['type_of_writing']?></option>
                                <?php } else { ?>
                                    <option value="<?= $value['type_of_writing']?>" typwrtg="<?= $value['factor']?>"><?= $value['type_of_writing']?></option>

                            <?php  } } ?>
                            </select>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <label>Pages *:</label>
                            <select class="form-control pages lockkey" name="pages" required>
                               <option value="" pageatr="">Select Pages</option>
                                <?php
                                 foreach ($pages as $key => $value) {
                                    if($page==$value['page']){
                                  ?>
                                    <option value="<?= $value['page']?>" selected pageatr="<?= $value['factor']?>"><?= $value['page']?></option>
                                <?php } else { ?>
                                    <option value="<?= $value['page']?>" pageatr="<?= $value['factor']?>"><?= $value['page']?></option>

                               <?php  }} ?>
                            </select>
                        </div>
                        <?php if($role_id !='2') {  ?>
                         <div class="col-md-4 col-sm-4">
                            <label>Enter Discount (%) </label>
                            <input type="text" name="discount_per" class="form-control discount_per" value="<?= $discount_per ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" />
                        </div>
                    <?php } else{ ?>
                     <div class="col-md-4 col-sm-4">
                        <label>Enter Discount (%) </label>
                            <input type="text" name="discount_per" class="form-control discount_per" value="40" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"  readonly="readonly" />
                             </div>
                    <?php } ?>
                </div>
            </div>
            <div class="form-group">
              <div class="row col-md-12">
		        		<div class="col-md-4 col-sm-4">
		        			 <label> Order Total ( &#163; )</label>
                            <strike class="actualorder" style="font-size: 22px;color:red;"></strike><br>
                            <input type="hidden" name="actualorder" class="actualorder" value="">

                            
                                                        
                           <!--  <input type="text" placeholder="100" name="order_total" class="form-control order_total" readonly="readonly"> -->
		        		</div>
                <div class="col-md-4 col-sm-4">
                    <label> Price After Applying Coupon </label>  
                    <span class="ordershow" style="font-size: 22px;color:green;"> </span> 
                    <i style="font-size: 18px;color:green;" class="fa fa-check"></i>
                    
					<?php if($role_id !='2') {  ?>
						<input type="text" name="order_total" class="order_total" value="">
					<?php }else{ ?>
						<input type="hidden" name="order_total" class="order_total" value="">
					<?php } ?>
							 
                    <input type="hidden" name="no_of_days" class="no_of_days" value="<?php echo $no_of_days ;?>">
                </div>
				<?php if($role_id !='2'){ ?>
				<?php if (@$referal == 'No'){ ?>
					<!-- <div class="col-md-4 col-sm-4">
						<label> Referral Amount Updation :</label>
						 <select class="form-control" name="referal">
						   
							  <option value="No"  <?php if ($referal == 'No'){ echo "selected"; } ?> >No</option>
							  <option value="Yes" <?php if ($referal == 'Yes'){ echo "selected"; } ?>>Yes</option>
						 </select>
					 </div> -->
				<?php } ?>
				<?php }else{ ?><input type="hidden" name="referal" value="<?= @$referal ?>"> <?php } ?>
		        	</div>
		        </div>       
		         <div class="form-group">
		        	<div class="row col-md-12"> 
					   <div class="col-md-4 col-sm-4">
							
							 <?php if($role_id !='3'){ ?>
							 <label>Writer Name </label>
							<input type="text" name="writer_name" class="form-control writer_name" value="<?= @$writer_name ?>" placeholder=" Enter Writer Name"/>
							 <?php }else{ ?>
							 <label>Writer Name </label>
							 <input type="hidden" name="writer_name" class="form-control writer_name" value="<?= @$writer_name ?>" placeholder=" Enter Writer Name"/>
							 <?php } ?>
						</div> 

						<div class="col-md-4 col-sm-4">
						 <?php if($role_id !='3'){ ?>
							<label>Writer Price</label>
							<input type="text" name="writer_price" class="form-control writer_price" value="<?= @$writer_price ?>" placeholder=" Enter Writer Price" oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" />
							 <?php }else{ ?>
							 <label>Writer Price</label>
							<input type="hidden" name="writer_price" class="form-control writer_price" value="<?= @$writer_price ?>" placeholder=" Enter Writer Price" oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" />
							 <?php } ?>
						</div>
						 <div class="col-md-4 col-sm-4">
						  <?php if(!empty($writer_deadline)){ if(@$writer_deadline!='1970-01-01'){  $writer_deadlinenew= date("d-m-Y",strtotime(@$writer_deadline));}else{ $writer_deadlinenew=''; } }else{ $writer_deadlinenew=''; } ?>
							<label>Writer Deadline </label>
							<input type="text" name="writer_deadline" data-date-formate="dd-mm-yyyy" class="form-control writer_deadline date-picker" value="<?= $writer_deadlinenew ?>" placeholder=" Enter Writer Deadline"/>
						</div> 
					</div>
				</div>

              <div class="form-group">
              <div class="row col-md-12">
		        		<div class="col-md-4 col-sm-4 ">
			        		<label class="control-label">  Message</label>
			        		<textarea type="text" placeholder="Enter Message" name="message" class="form-control" rows="3" value="<?= $message ?>"  autofocus autocomplete="off" > <?= $message ?></textarea>
		        		</div>
                <?php if($role_id != '2') {  ?>
                 <div class="col-md-4 col-sm-4">
                  <label> Payment Status :</label>
                 <select class="form-control pages" name="paymentstatus" required>
                   
                      <option value="Pending"  <?php if ($paymentstatus == 'Pending'){ echo "selected"; } ?> >Pending</option>
                     
                      <option value="Completed" <?php if ($paymentstatus == 'Completed'){ echo "selected"; } ?>>Completed</option>
                 </select>
                </div>
                 <div class="col-md-4 col-sm-4">
                  <label> Order Status :</label>
                 <select class="form-control pages" name="projectstatus" required>
                   
					<option value="Pending"  <?php if ($projectstatus == 'Pending'){ echo "selected"; } ?> >Pending</option>
					<option value="In Progress" <?php if ($projectstatus == 'In Progress'){ echo "selected"; } ?> >In Progress</option>
					<option value="Completed"  <?php if ($projectstatus == 'Completed'){ echo "selected"; } ?> >Completed</option>
					<option value="Delivered"  <?php if ($projectstatus == 'Delivered'){ echo "selected"; } ?> >Delivered</option>
					<option value="Feedback"  <?php if ($projectstatus == 'Feedback'){ echo "selected"; } ?> >Feedback</option>
					<option value="Feedback Delivered"  <?php if ($projectstatus == 'Feedback Delivered'){ echo "selected"; } ?> >Feedback Delivered</option>
					<option value="Cancelled"  <?php if ($projectstatus == 'Cancelled'){ echo "selected"; } ?> >Cancelled</option>
					<option value="Draft Ready"  <?php if ($projectstatus == 'Draft Ready'){ echo "selected"; } ?> >Draft Ready</option>
					<option value="Draft Delivered"  <?php if ($projectstatus == 'Draft Delivered'){ echo "selected"; } ?> >Draft Delivered</option>
					<option value="Other"  <?php if ($projectstatus == 'Other'){ echo "selected"; } ?> >Other</option>
					<option value="initiated"  <?php if ($projectstatus == 'initiated'){ echo "selected"; } ?> >initiated</option>
                 </select>
                </div>
				 <div class="col-md-4 col-sm-4">
					<label>College Name</label>
						<input type="text" name="college_name" class="form-control" value="<?= @$college_name ?>"/>
                  </div>
				  <!-- <div class="col-md-4 col-sm-4">
				    <label> Unlock Price section</label><br/>
						<button type="button" class="btn btn-xs btn-primary  unlock"> Unlock Key</button>
					</div>	 -->
				<?php if ($projectstatus == 'Delivered'){ ?>
				  <div class="col-md-4 col-sm-4">
					 <label> File Upload </label>
						 <a class="btn btn-xs btn-success btnEdit"  href="<?php echo base_url(); ?>index.php/Orders/UploadOrder/<?php echo $id;?>" ><i style="color:#fff;"class="fa fa-check"></i></a>
					</div>
				<?php }  ?>

                <?php } ?>
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
				<input type="file" name="bill_image[]" class="form-control upload" >
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
		//$('.lockkey').css('pointer-events','none');
		
		$(document).on('click','.unlock',function(){
			//$('.lockkey').css('pointer-events','fill');
			calculate_total();
		});
		
		$(document).on('keyup','.order_total',function(){
				var discount_price=$(this).val();
				
				var actual_price=$('.actualorder').val();
			
				var divide=(discount_price/actual_price);
				
				var acutal_discount=((1-divide)*100).toFixed(2);
				$('.discount_per').val(acutal_discount);
				$('.ordershow').html(discount_price);
				
			});


        add_row();
        rename_rows();
        add_row1();
        rename_rows1();
        $('body').on('click','.addrow',function(){

            var table=$(this).closest('table');
            add_row();
            rename_rows();
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
         calculate_total();
       /*   $(document).on('change','.pages,.typeofservice,.timeline,.typeofpaper,.typeofwritting,.discount_per,#second',function(){
            calculate_total();
        }); */

          $(document).on('keyup','.discount_per',function(){
            calculate_total();
        });

        //  $(document).on('keyup','.paid_amount',function(){
        //    var order_total = $('.order_total').val();
        //    var paid_amount = $('.paid_amount').val();
        //     if(paid_amount<order_total){
        //        var total_due=order_total-paid_amount;  
        //      }else{
        //       alert("You can not enter amount greater than Due amount");
        //       $('.paid_amount').val('');
        //      }
        //     $('.remaining_amount').val(total_due.toFixed(2));
        // });

        //var pages=typpaper=typwrtg=typservice=deadline=0;
        //var total=0;
        //var pagevalue=0;
        function calculate_total()
        {

            var typservice =  $('.typeofservice').find('option:selected').attr('typservice');
            //var deadline =  $('.timeline').find('option:selected').attr('deadline');
            var typpaper =  $('.typeofpaper').find('option:selected').attr('typpaper');
            var typwrtg =  $('.typeofwritting').find('option:selected').attr('typwrtg');
            var pages =  $('.pages').find('option:selected').attr('pageatr');
            //var pages = $('.pages').find('option:selected').val();
            var discount_per = $('.discount_per').val();
               
            function parseDate(str) {
                var mdy = str.split('-');
                //alert(mdy);
                return new Date(mdy[2], mdy[1]-1, mdy[0]);
            }

          function datediff(first, second) {
             return Math.round((second-first)/(1000*60*60*24));
          }

         if(parseDate(second.value) > parseDate(first.value))
         {
            no_of_days=datediff(parseDate(first.value), parseDate(second.value));
            //alert(no_of_days);
            if(no_of_days == 1){
              var deadline=1.54;
            }
            if(no_of_days == 2){
              var deadline=1.42;
            }
            if(no_of_days == 3){
              var deadline=1.18;
            }
            if(no_of_days > 3 && no_of_days <= 5){
              var deadline=1.05;
            }
            if(no_of_days > 5 && no_of_days <= 7){
              var deadline=0.89;
            }
            if(no_of_days > 7 && no_of_days <= 14){
              var deadline=0.81;
            }
            if(no_of_days > 14 ){
              var deadline=0.75;
            }
        }
      else{
         alert("You can not select Delivery Date less than Order Date");
         $('.delivery_date').val('');
      }

          //alert(typservice);
          if(isNaN(typservice)){typservice =0;}
          if(isNaN(deadline)){deadline =0;}
          if(isNaN(typpaper)){typpaper =0;}
          if(isNaN(typwrtg)){typwrtg =0;}
          if(isNaN(pages)){pages =0;}
          if(isNaN(discount_per)){discount_per =0;}
          
          var pagevalue=pages-(pages*10)/100;
           //alert(pagevalue);
          var actual_price=typservice*deadline*typpaper*typwrtg*pagevalue;
          var discount_price=(typservice*deadline*typpaper*typwrtg*pagevalue)*discount_per/100;
          var total=actual_price-discount_price;
           //alert(total);
          
          $('.order_total').val(total.toFixed(2));
          $('.actualorder').val(actual_price.toFixed(2));
           $('.no_of_days').val(no_of_days);
          $('.ordershow').html(total.toFixed(2));
          $('.actualorder').html(actual_price.toFixed(2));  
        }

    });
</script> 