<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<?php
defined('BASEPATH') or exit('No direct script access allowed');
$current_page   = current_url();
$data           = explode('?', $current_page);
$role_id        = $this->session->userdata['logged_in']['role_id'];
?>

<style>
    fieldset.scheduler-border {
        border-radius: 8px;
        border: 2px groove #ddd !important;
        padding: 0 1.4em 1.4em 1.4em !important;
        margin: 0 0 1.5em 0 !important;
        -webkit-box-shadow: 0px 0px 0px 0px #000;
        box-shadow: 0px 0px 0px 0px #000;
        margin-top: 30px !important;
    }

    legend.scheduler-border {
        text-align: left !important;
        width: auto;
        margin-top: -30px;
        margin-left: 15px;
        color: #144277;
        font-size: 17px;
        margin-bottom: 0px;
        border: none;
        background: #fff;
        padding: 15px;
    }

    label:not(.form-check-label):not(.custom-file-label) {
        font-weight: 700;
    }

    .col-md-6 {
        margin-bottom: 10px;
    }

    .page-titles {
        margin: 0 !important;
    }

    .card-body {
        padding: 0 !important;
    }
</style>

<!-- Page wrapper  -->
<?php include('template/css.php') ?>
<?php include('template/header.php') ?>
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
                <h4 class="text-themecolor">Orders List</h4>
                <?php
                $params   = $_SERVER['QUERY_STRING'];
                $fullURL  = $current_page . '?' . $params;
                $_SESSION['fullURL'] = $fullURL;
                ?>
            </div>
            <div class="col-md-7 align-self-center text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb justify-content-end">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Order List</li>
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

         
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->

<!-- Start : Models -->

<!-- Closed : Models -->

<script src="<?php echo base_url(); ?>assets/node_modules/jquery/dist/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.read_order').on('click', function(e) {
            var current = $(this);
            id = $(this).attr('order_id');
            $.ajax({
                url: "<?php echo base_url(); ?>index.php/Orders/readorder/" + id,
                cache: false,
                success: function(response) {
                    current.css("font-weight", "");
                }
            });
        });
        jQuery('#master').on('click', function(e) {
            if ($(this).is(':checked', true)) {
                $(".sub_chk").prop('checked', true);
            } else {
                $(".sub_chk").prop('checked', false);
            }
        });
        jQuery('.delete_all').on('click', function(e) {
            var allVals = [];
            $(".sub_chk:checked").each(function() {
                allVals.push($(this).val());
            });
            if (allVals.length <= 0) {
                alert("Please select row.");
            } else {
                WRN_PROFILE_DELETE = "Are you sure you want to delete all selected customers?";
                var check = confirm(WRN_PROFILE_DELETE);
                if (check == true) {
                    var join_selected_values = allVals.join(",");
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>index.php/Orders/deleteorder",
                        cache: false,
                        data: 'ids=' + join_selected_values,
                        success: function(response) {
                            $(".successs_mesg").html(response);
                            location.reload();
                        }
                    });

                }
            }
        });

        $(document).on('click', '.mark_as_failed', function() {
            var row_id = $(this).closest("tr").find('.row_id').val();
            swal({
                title: "Are you sure?",
                text: "Mark this order as failed job!",
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
                        url: '<?php echo base_url(); ?>index.php/Orders/markAsFailed',
                        data: {
                            row_id: row_id,
                        },
                        success: function(response) {
                            window.location.reload();
                        }
                    });
                } else {
                    // window.location.reload();
                }
            });
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        var base_url = '<?php echo base_url(); ?>';
        $(document).on('change', '.category', function() {
            var category_id = $('.category').find('option:selected').val();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('index.php/Customers/getcustomerByCategory/') ?>" + category_id,
                dataType: 'html',
                success: function(response) {
                    $(".customers").html(response);
                    $('.select2').select2();
                }
            });
        });
    });
</script>