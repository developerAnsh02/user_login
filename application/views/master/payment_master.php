<?php
defined('BASEPATH') or exit('No direct script access allowed');
$base                = base_url();
$hyperlink_ordes     = $base . 'index.php/Orders/index';
$hyperlink_customers = $base . 'index.php/Employees/index';
$role_id             = $this->session->userdata['logged_in']['role_id'];
?>

<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">

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

        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor"> <?= $title ?> </h4>
            </div>
            <div class="col-md-7 align-self-center text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb justify-content-end">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active"> <?= $title ?> </li>
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
        <div class="row">
            <div class="col-md-12">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="5%"> Sr.No.</th>
                            <th> Date </th>
                            <th> Order Code </th>
                            <th> Client </th>
                            <th> Amount </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($datalists as $datalist) { ?>
                            <?php if ($datalist['account_status'] == '0') { ?>
                                <tr>
                                    <td>
                                        <?php
                                        if (!empty($this->uri->segment(3))) {
                                            $page_count = $this->uri->segment(3);
                                            echo $i + $page_count;
                                        } else {
                                            echo $i;
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $datalist['payment_date'] ?></td>
                                    <td>
                                        <?php echo $datalist['order_id']; ?>
                                    </td>
                                    <td>
                                        <?php echo $datalist['name'] . ' ( ' . $datalist['mobile_no'] . ' ) '; ?>
                                    </td>
                                    <td>
                                        <?php echo $datalist['paid_amount']; ?>
                                    </td>
                                    <td>
                                        <input type="text" class="payment_row_id" value="<?php echo $datalist['id']; ?>" style="display: none;">
                                        <button class="btn btn-success confirm_payment">
                                            <i class="fa fa-check"></i>
                                        </button>
                                    </td>
                                </tr>
                        <?php
                                $i++;
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <div class="pagination">
                    <?php echo $links; ?> </p>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->

    <script src="<?php echo base_url(); ?>assets/node_modules/jquery/dist/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            $(document).on('click', '.confirm_payment', function() {
                var id = $(this).closest("tr").find('.payment_row_id').val();
                swal({
                    title: "Are you sure?",
                    text: "Confirm this payment!",
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
                            url: '<?php echo base_url(); ?>index.php/Payments/confirmPayment',
                            data: {
                                id: id,
                            },
                            success: function(response) {
                                window.location.reload();
                            }
                        });
                    } else {

                    }
                });
            });
        });
    </script>