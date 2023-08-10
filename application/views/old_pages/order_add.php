<?php
defined('BASEPATH') or exit('No direct script access allowed');

$role_id = $this->session->userdata['logged_in']['role_id'];

?>
<div class="container-fluid">
	<div class="card card-primary card-outline">
		<div class="card-header">
			<h3 class="card-title"> <?= $title ?></h3>
			<div class="pull-right error_msg">
				<?php echo validation_errors(); ?>

				<?php if (isset($message_display)) {
					echo $message_display;
				} ?>
			</div>

		</div> <!-- /.card-body -->
		<div class="card-body">
			<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Orders/add_new_order" enctype="multipart/form-data">

				<div class="form-group">
					<div class="row col-md-12">

						<?php if ($role_id != '2') {  ?>
							<div class="col-md-4 col-sm-4">
								<label class="control-label">Select Customer</label>
								<?php echo form_dropdown('user_id', $users, '', 'required="required"')
								?>
							</div>
						<?php } else { ?>
							<input type="hidden" name="user_id" value="<?= @$user_id ?>">
						<?php } ?>

						<div class="col-md-4 col-sm-4">
							<label class="control-label">Order ID </label>
							<input type="text" name="order_id" class="form-control" value="<?= $order_id ?>" autofocus readonly="readonly">
							<input type="hidden" name="order_type" value="Back-End">
						</div>

						<div class="col-md-4 col-sm-4">
							<label class="control-label"> Order Date</label>
							<input type="text" data-date-formate="dd-mm-yyyy" name="order_date" class="form-control date-picker order_date" value="<?php echo date('d-m-Y'); ?>" placeholder="dd-mm-yyyy" id="first" autofocus autocomplete="off" autocomplete="off">
						</div>

					</div>
				</div>
				<div class="form-group">
					<div class="row col-md-12">

						<div class="col-md-4 col-sm-4">
							<label class="control-label"> Formatting & Citation Style</label>
							<select class="form-control" required name="formatting">
								<option value="">Please Choose any one</option>
								<?php
								foreach ($formattings as $key => $value) { ?>

									<option value="<?= $value['formatting_name'] ?>" <?php if ('Harvard' == $value['formatting_name']) { ?> Selected <?php } ?>><?= $value['formatting_name'] ?></option>

								<?php  } ?>
							</select>
						</div>

						<div class="col-md-8 col-sm-8 ">
							<label class="control-label">Project Title </label>
							<input type="text" name="title" class="form-control" value="" autofocus placeholder="Enter Project Title">
						</div>

					</div>
				</div>
				<div class="form-group">
					<div class="row col-md-12">

						<div class="col-md-4 col-sm-4" <?php if ($role_id == '2') {  ?> style="display:none" <?php } ?>>
							<label>Type of service :</label>

							<select name="typeofservice" class="form-control typeofservice">
								<option value="" typservice="">Choose type of service</option>
								<?php
								foreach ($services as $key => $value) { ?>

									<option value="<?= $value['service_name'] ?>" typservice="<?= $value['factor'] ?>" <?php if ('First Class Standard' == $value['service_name']) { ?> selected <?php } ?>><?= $value['service_name'] ?></option>

								<?php  } ?>
							</select>
						</div>

						<div class="col-md-4 col-sm-4">
							<label class="control-label" for="datepicker">Select Delivery Date</label>
							<!--  <select class="form-control timeline" required name="deadline">
                                <option value="" deadline="" >Select Timeline</option>
                                <?php
								foreach ($timelines as $key => $value) { ?>

                                      <option value="<?= $value['timeline'] ?>" deadline="<?= $value['factor'] ?>"><?= $value['timeline'] ?></option>

                               <?php  } ?>
                                </select> -->
							<input type="text" data-date-formate="dd-mm-yyyy" name="delivery_date" class="form-control date-picker delivery_date" value="<?php echo  date("d-m-Y", strtotime("+3 day"));; ?>" placeholder="dd-mm-yyyy" autofocus autocomplete="off" id="second" autocomplete="off">
						</div>

						<div class="col-md-4 col-sm-4 ">
							<label>Type of Paper :</label>
							<select class="form-control typeofpaper" required name="typeofpaper">
								<option value="" typpaper="">Click to select</option>
								<?php
								foreach ($typeofpapers as $key => $value) { ?>

									<option value="<?= $value['paper_type'] ?>" typpaper="<?= $value['factor'] ?>" <?php if ('Assignment' == $value['paper_type']) { ?> selected <?php } ?>><?= $value['paper_type'] ?></option>

								<?php  } ?>
							</select>
						</div>

					</div>
				</div>
				<div class="form-group">
					<div class="row col-md-12">

						<div class="col-md-4 col-sm-4" <?php if ($role_id == '2') {  ?> style="display:none" <?php } ?>>
							<label>Type of writing *:</label>
							<select class="form-control typeofwritting" required name="typeofwritting">
								<option value="" typwrtg="">Choose type of writing</option>
								<?php
								foreach ($typeofwritings as $key => $value) { ?>

									<option value="<?= $value['type_of_writing'] ?>" typwrtg="<?= $value['factor'] ?>" <?php if ('Post Graduate' == $value['type_of_writing']) { ?> selected <?php } ?>><?= $value['type_of_writing'] ?></option>

								<?php  } ?>
							</select>
						</div>

						<div class="col-md-4 col-sm-4">
							<label>Pages *:</label>
							
							<select class="form-control pages" name="pages" required>
								<option value="" pageatr="">Select Pages</option>
								<?php foreach ($pages as $key => $value) { ?>

									<option value="<?= $value['page'] ?>" pageatr="<?= $value['factor'] ?>"><?= $value['page'] ?></option>

								<?php  } ?>
							</select>
						</div>

						<?php if ($role_id != '2') {  ?>
							<div class="col-md-4 col-sm-4">
								<label>Enter Discount (%) </label>
								<input type="text" name="discount_per" class="form-control discount_per" value="" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" />
							</div>
						<?php } else { ?>
							<div class="col-md-4 col-sm-4">
								<label>Enter Discount (%) </label>
								<input type="text" name="discount_per" class="form-control discount_per" value="40" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" readonly="readonly" />
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
						</div>

						<div class="col-md-4 col-sm-4">
							<label> Price After Applying Coupon </label>
							<span class="ordershow" style="font-size: 22px;color:green;"> </span>
							<i style="font-size: 18px;color:green;" class="fa fa-check"></i>
							<?php if ($role_id != '2') {  ?>
								<input type="text" name="order_total" class="order_total" value="">
							<?php } else { ?>
								<input type="hidden" name="order_total" class="order_total" value="">
							<?php } ?>
							<input type="hidden" name="no_of_days" class="no_of_days" value="">
						</div>

						<div class="col-md-4 col-sm-4">
							<label>College Name</label>
							<input type="text" name="college_name" class="form-control" />
						</div>

					</div>
				</div>
				<div class="form-group">
					<div class="row col-md-12">

						<div class="col-md-6 col-sm-6 ">
							<fieldset>
								<legend> <b>Upload Files </b></legend>
								<div class="table-responsive">
									<table id="maintable" class="table">
										<thead style="background-color: #355fa9;color: #ffffff;">
											<tr>
												<th>S.No.</th>
												<th style="white-space: nowrap;"> Upload File</th>
												<th style="white-space: nowrap;"> Action</th>
											</tr>
										</thead>
										<tbody id="mainbody">

										</tbody>
									</table>
								</div>
							</fieldset>
						</div>
						
						<div class="col-md-6 col-sm-6 ">
							<label class="control-label"> Message</label>
							<textarea type="text" placeholder="Enter Message" name="message" class="form-control" rows="7" value="" autofocus autocomplete="off" style="resize: none;"></textarea>
						</div>
						
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
			<td>1</td>
			<td>
				<input type="file" name="bill_image[]" class="form-control upload">
			</td>
			<td>
				<button type="button" class="btn btn-xs btn-primary addrow" style="padding:4px;" href="#" role='button'><i class="fa fa-plus"></i></button>
				<button type="button" class="btn btn-xs btn-danger deleterow" href="#" style="padding:4px;" role='button'><i class="fa fa-minus"></i></button>
			</td>
		</tr>
	</tbody>
</table>


<script src="<?php echo base_url() . "assets/"; ?>plugins/jquery/jquery.min.js"></script>

<!-- <script type="text/javascript">
   
var days = daysdifference('10/11/2019', '10/20/2019');
alert(days);
  
function daysdifference(firstDate, secondDate){
    var startDay = new Date(firstDate);
    var endDay = new Date(secondDate);
   
    var millisBetween = startDay.getTime() - endDay.getTime();
    var days = millisBetween / (1000 * 3600 * 24);
   
    return Math.round(Math.abs(days));
}
</script> -->

<script type="text/javascript">
	$(document).ready(function() {

		add_row();
		rename_rows();
		$('body').on('click', '.addrow', function() {

			var table = $(this).closest('table');
			add_row();
			rename_rows();
		});

		function add_row() {
			var tr1 = $("#sample_table1 tbody tr").clone();
			$("#maintable tbody#mainbody").append(tr1);
		}

		$('body').on('click', '.deleterow', function() {

			var table = $(this).closest('table');
			var rowCount = $("#maintable tbody tr.main_tr1").length;
			if (rowCount > 1) {
				if (confirm("Are you sure to remove row ?") == true) {
					$(this).closest("tr").remove();
					rename_rows();
				}
			}
		});



		function rename_rows() {
			var i = 0;

			$("#maintable tbody tr.main_tr1").each(function() {
				$(this).find("td:nth-child(1)").html(++i);
				var rowCount1 = $("#maintable tbody tr.main_tr1").length;
				//alert(rowCount1);
				// $(this).find("td:nth-child(7) input.upload").change(function() {
				// var file = this.files[0];
				// var fileType = file["type"];
				// var size = parseInt(file["size"]/1024);
				// alert(size);
				// var validImageTypes = ["image/jpeg", "image/png"];
				// if ($.inArray(fileType, validImageTypes) < 0) 
				// {
				//     alert('Invalid file type , please select jpg/png file only !');
				//     $(this).val(''); 
				// }
				// if (size > 5000) 
				// {
				//     alert('Image size exceed , please select < 5MB file only !');
				//     $(this).val(''); 
				// }
				// });

			});
		}


		$(document).on('change', '.pages,.typeofservice,.timeline,.typeofpaper,.typeofwritting,.discount_per,#second', function() {
			calculate_total12();
		});

		$(document).on('keyup', '.discount_per', function() {
			calculate_total12();
		});

		$(document).on('keyup', '.order_total', function() {
			var discount_price = $(this).val();

			var actual_price = $('.actualorder').val();

			var divide = (discount_price / actual_price);

			var acutal_discount = ((1 - divide) * 100).toFixed(2);
			$('.discount_per').val(acutal_discount);
			$('.ordershow').html(discount_price);

		});

		//var pages=typpaper=typwrtg=typservice=deadline=0;
		//var total=0;
		//var pagevalue=0;
		function calculate_total12() {

			var typservice = $('.typeofservice').find('option:selected').attr('typservice');
			//var deadline =  $('.timeline').find('option:selected').attr('deadline');
			var typpaper = $('.typeofpaper').find('option:selected').attr('typpaper');
			var typwrtg = $('.typeofwritting').find('option:selected').attr('typwrtg');
			var pages = $('.pages').find('option:selected').attr('pageatr');


			function parseDate(str) {
				var mdy = str.split('-');
				//alert(mdy);
				return new Date(mdy[2], mdy[1] - 1, mdy[0]);
			}

			function datediff(first, second) {
				return Math.round((second - first) / (1000 * 60 * 60 * 24));
			}

			if (parseDate(second.value) > parseDate(first.value)) {
				no_of_days = datediff(parseDate(first.value), parseDate(second.value));
				//alert(no_of_days);
				if (no_of_days == 1) {
					var deadline = 1.54;
				}
				if (no_of_days == 2) {
					var deadline = 1.42;
				}
				if (no_of_days == 3) {
					var deadline = 1.18;
				}
				if (no_of_days > 3 && no_of_days <= 5) {
					var deadline = 1.05;
				}
				if (no_of_days > 5 && no_of_days <= 7) {
					var deadline = 0.89;
				}
				if (no_of_days > 7 && no_of_days <= 14) {
					var deadline = 0.81;
				}
				if (no_of_days > 14) {
					var deadline = 0.75;
				}
			} else {
				alert("You can not select Delivery Date less than Order Date");
				$('.delivery_date').val('');
			}


			//alert(deadline);
			//var pages = $('.pages').find('option:selected').val();
			var discount_per = $('.discount_per').val();
			//alert(discount_per);
			if (isNaN(typservice)) {
				typservice = 0;
			}
			if (isNaN(no_of_days)) {
				no_of_days = 0;
			}
			if (isNaN(typpaper)) {
				typpaper = 0;
			}
			if (isNaN(typwrtg)) {
				typwrtg = 0;
			}
			if (isNaN(pages)) {
				pages = 0;
			}
			if (isNaN(discount_per)) {
				discount_per = 0;
			}

			var pagevalue = pages - (pages * 10) / 100;
			//alert(pagevalue);
			var actual_price = typservice * deadline * typpaper * typwrtg * pagevalue;
			var discount_price = (typservice * deadline * typpaper * typwrtg * pagevalue) * discount_per / 100;
			var total = actual_price - discount_price;
			//alert(total);

			$('.order_total').val(total.toFixed(2));
			$('.actualorder').val(actual_price.toFixed(2));
			$('.no_of_days').val(no_of_days);
			$('.ordershow').html(total.toFixed(2));
			$('.actualorder').html(actual_price.toFixed(2));
		}

	});
</script>