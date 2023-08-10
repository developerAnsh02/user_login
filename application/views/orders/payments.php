<?php
defined('BASEPATH') or exit('No direct script access allowed');
$current_page = current_url();
$data         = explode('?', $current_page);
$role_id      = $this->session->userdata['logged_in']['role_id'];
$url          = current_url();
$currentURL = current_url();
?>

<style>
    input[readonly] {
        pointer-events: none;
    }
</style>

<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor"><?= $title ?></h4>
            </div>
            <div class="col-md-7 align-self-center text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb justify-content-end">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active"><?= $title ?></li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->

        <div class="card-body">
            <h3> Previous Payment Details </h3>
            <hr>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Sr.No.</th>
                            <th> Order ID </th>
                            <th> Payment Date</th>
                            <th> Amount </th>
                            <th> References </th>
                            <?php if ($role_id == '1') { ?>
                                <th> Action </th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($payment_details as $obj) { ?>
                            <tr>
                                <td> <?= $i ?></td>
                                <td> <a href="<?php echo base_url(); ?>index.php/Orders/print/<?php echo $obj['order_id']; ?>"> <?= $order_id ?> </a> </td>
                                <td><?php echo $obj['payment_date']; ?></td>
                                <td><?php echo $obj['paid_amount']; ?></td>
                                <td>
                                    <?php echo $obj['reference']; ?>
                                    <input type="hidden" class="row_id" value="<?php echo $obj['id']; ?>">
                                    <input type="hidden" class="row_paid_amount" value="<?php echo $obj['paid_amount']; ?>">
                                    <input type="hidden" class="row_order_row_id" value="<?= $order_row_id ?>">
                                </td>

                                <?php if ($role_id == '1') { ?>
                                    <td>
                                        <button class="btn btn-primary delete">Delete</button>
                                    </td>
                                <?php } ?>
                            </tr>

                        <?php $i++;
                        } ?>
                    </tbody>
                </table>
            </div>
            <br>
            <hr>
            <h3> Make New Payment Here</h3>
            <hr>

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

            <br>

            <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Orders/addPayment" enctype="multipart/form-data">
                <input type="hidden" class="order_row_id" name="order_row_id" value="<?= $order_row_id ?>">
                <input type="hidden" class="order_total" name="order_total" value="<?= $amount ?>">
                <input type="hidden" class="received_amount" name="received_amount" value="<?= $received_amount ?>">
                <input type="hidden" class="current_page" name="current_page" value="<?= $url ?>">
                <input type="hidden" class="remaining_amount_old" name="remaining_amount_old" value="<?php echo $remaining_amount_old; ?>">
                <input type="hidden" name="backurl" value="<?= $currentURL ?>">

                <div class="row d-flex">
                    <div class="col-md-4">
                        <?php if ($role_id == 1) { ?>
                            <label class="control-label"> Payment Date </label>
                            <input type="text" name="payment_date" value="<?php echo date('l d F Y h:i A'); ?>" class="form-control min-date" required>
                        <?php } else { ?>
                            <label class="control-label"> Payment Date </label>
                            <input type="text" name="payment_date" value="<?php echo date('l d F Y h:i A'); ?>" class="form-control min-date" readonly>
                        <?php } ?>
                    </div>
                    <div class="col-md-4">
                        <label> Paid Amount :</label>
                        <input type="text" placeholder="Enter Paid Amount" name="paid_amount" class="form-control paid_amount" required="required">
                    </div>
                    <div class="col-md-4">
                        <label> Remaining Amount :</label>
                        <input type="text" placeholder="Remaining Amount" name="remaining_amount" class="form-control remaining_amount" value="<?php echo (float)($remaining_amount_old); ?>" readonly="readonly">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <label> Payment Reference :</label>
                        <textarea type="text" placeholder="Enter reference here" name="reference" class="form-control " value="" rows="3" required></textarea>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary btn-block"> Submit Payment</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->

<script src="<?php echo base_url(); ?>assets/node_modules/jquery/dist/jquery.min.js"></script>

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

        $(document).on('click', '.delete', function() {
            var row_id = $(this).closest("tr").find('.row_id').val();
            var row_paid_amount = $(this).closest("tr").find('.row_paid_amount').val();
            var row_order_row_id = $(this).closest("tr").find('.row_order_row_id').val();

            swal({
                title: "Are you sure?",
                text: "Update amount!",
                icon: "warning",
                buttons: [
                    'No, cancel it!',
                    'Yes, I am sure!'
                ],
                dangerMode: true,
            }).then(function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        type: "POST",
                        url: '<?php echo base_url(); ?>index.php/Orders/deletePayment',
                        data: {
                            row_id: row_id,
                            row_paid_amount: row_paid_amount,
                            row_order_row_id: row_order_row_id,
                        },
                        success: function(response) {
                            window.location.reload();
                        }
                    });
                } else {
                    window.location.reload();
                }
            });
        });
    });
</script>