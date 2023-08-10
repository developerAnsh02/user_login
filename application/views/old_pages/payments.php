<?php
defined('BASEPATH') or exit('No direct script access allowed');
$current_page = current_url();
$url = base_url() . 'index.php/Orders/edit/' . $order_id;
//$current_page='https://www.muskowl.com/chaudhary_minerals/index.php/Meenus/UserRights';
$data = explode('?', $current_page);
$role_id = $this->session->userdata['logged_in']['role_id'];
//echo $session_data['role_id'];exit;
//print_r($data[0]);exit;
?>

<style type="text/css">
	.col-sm-6,
	.col-md-6,
	.col-md-4,
	.col-md-3 {
		float: left;
	}
</style>

<div class="container-fluid">
	<div class="card card-primary card-outline">
		<div class="card-header">
			<span class="card-title"><?php echo $title; ?></span>
			<div class="pull-right error_msg">
				<a href="<?php echo base_url(); ?>index.php/Orders/edit/<?= $order_id ?>" class="btn btn-success" data-toggle="tooltip" title="Edit  Order">Edit Order <i class="fa fa-edit"></i></a>
			</div>
		</div> <!-- /.card-body -->
		<div class="card-body">
			<h3> Previous Payment Details </h3>
			<hr>
			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-bordered table-striped">
							<thead>
								<tr>

									<th>Sr.No.</th>
									<th> Order ID </th>
									<th> Payment Date</th>
									<th> Amount </th>
									<th> References </th>
								</tr>
							</thead>
							<tbody>
								<?php
								$i = 1;
								foreach ($payment_details as $obj) { ?>
									<tr>
										<td> <?= $i ?></td>
										<td> <a href="<?php echo base_url(); ?>index.php/Orders/print/<?php echo $obj['order_id']; ?>"> <?= $order_id ?> </a> </td>
										<td><?php echo date('d-M-Y', strtotime($obj['payment_date'])); ?></td>
										<td><?php echo $obj['paid_amount']; ?></td>
										<td><?php echo $obj['reference']; ?></td>
									</tr>

								<?php $i++;
								} ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<br>
			<hr>
			<h3> Make New Payment Here</h3>
			<hr>
			<?php if ($this->session->flashdata('success')) : ?>
				<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h5><i class="icon fa fa-check"></i> Success!</h5>
					<?php echo $this->session->flashdata('success'); ?>
				</div>
				<!-- <span class="successs_mesg"><?php echo $this->session->flashdata('success'); ?></span> -->
			<?php endif; ?>

			<?php if ($this->session->flashdata('failed')) : ?>
				<div class="alert alert-error alert-dismissible ">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h5><i class="icon fa fa-check"></i> Alert!</h5>
					<?php echo $this->session->flashdata('failed'); ?>
				</div>
			<?php endif; ?>

			<br>
			<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Orders/addPayment" enctype="multipart/form-data">
				<input type="hidden" name="order_row_id" value="<?= $order_row_id ?>">
				<input type="hidden" class="order_total" name="order_total" value="<?= $amount ?>">
				<input type="hidden" class="received_amount" name="received_amount" value="<?= $received_amount ?>">
				<input type="hidden" class="current_page" name="current_page" value="<?= $url ?>">
				<input type="hidden" class="remaining_amount_old" name="remaining_amount_old" value="<?php echo $amount - $received_amount; ?>">

				<div class="row">
					<div class="col-md-12 col-sm-12">
						<div class="col-md-4 col-sm-4">
							<label class="control-label"> Payment Date</label>
							<input type="text" data-date-formate="dd-mm-yyyy" name="payment_date" class="form-control date-picker" value="<?php echo date('d-m-Y'); ?>" placeholder="dd-mm-yyyy" autofocus autocomplete="off" autocomplete="off">
						</div>

						<div class="col-md-4 col-sm-4">
							<label> Paid Amount :</label>
							<input type="text" placeholder="Enter Paid Amount" name="paid_amount" class="form-control paid_amount" required="required">
						</div>
						<div class="col-md-4 col-sm-4">
							<label> Remaining Amount :</label>
							<input type="text" placeholder="Remaining Amount" name="remaining_amount" class="form-control remaining_amount" value="<?php echo $amount - $received_amount; ?>" readonly="readonly">
						</div>
					</div>
				</div><br>
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<label> Payment Reference :</label>
						<textarea type="text" placeholder="Enter reference here" name="reference" class="form-control " value="" rows="3"></textarea>

					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-12 col-sm-12 ">
						<button type="submit" class="btn btn-primary btn-block"> Submit Payment</button>

					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<script src="<?php echo base_url() . "assets/"; ?>plugins/jquery/jquery.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {

		$(document).on('blur', '.paid_amount', function() {
			var remaining_amount_old = parseFloat($('.remaining_amount_old').val());
			var order_total = parseFloat($('.order_total').val());
			var paid_amount = parseFloat($('.paid_amount').val());
			if (paid_amount <= remaining_amount_old) {
				var new_remaining_amount = remaining_amount_old - paid_amount;
			} else {
				alert("You can not enter amount greater than Due amount");
				$('.paid_amount').val('');
			}
			$('.remaining_amount').val(new_remaining_amount);
		});
	});
</script>