<?php
defined('BASEPATH') or exit('No direct script access allowed');
$base                = base_url();
$hyperlink_ordes     = $base . 'index.php/Orders/index';
$hyperlink_customers = $base . 'index.php/Employees/index';
$role_id             = $this->session->userdata['logged_in']['role_id'];
?>

<!-- Page wrapper  -->
<?php if($role_id ==2){ ?>



    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
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

<!-- Start Page Content -->

<div class="row">
    <div class="toolbar" id="kt_toolbar">
	<!--begin::Container-->
	<div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
		<!--begin::Page title-->
		<div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
			<!--begin::Title-->
			<h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">My Offer</h1>
			<!--end::Title-->
		</div>
	</div>
	<!--end::Container-->
</div>
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title"> <?= $title ?></h3>
            <div class="pull-right error_msg">
                <?php echo validation_errors(); ?>
                <?php if (isset($message_display)) {
                    echo $message_display;
                } ?>
            </div>
        </div>
        <div class="card-body">
            <?php if ($role_id == '1') { ?>
                <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Offers/add_new_offer" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="row col-md-12">
                            <div class="col-md-12">
                                <fieldset>
                                    <legend> <b>Upload Offer Images </b></legend>
                                    <div class="table-responsive">
                                        <table id="maintable" class="table">
                                            <thead style="background-color: #ffd8cc; color: #000000;">
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th style="white-space: nowrap;"> Upload File</th>
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
                    </div>
                    <div class="form-group">
                        <div class="row col-md-12">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-block"> Click Here To Upload Banner Images</button>
                            </div>
                        </div>
                    </div>
                </form>
                <hr>
            <?php } ?>
            <div class="form-group">
                <div class="row col-md-12">
                    <div class="col-md-12">
                        <h3> Offer Images</h3>
                    </div>
                    <?php foreach ($result as $key => $value) {
                    ?>
                        <div class="col-md-12">
                            <?php if ($role_id == '1') { ?>
                                <a class="btn btn-xs btn-danger" style="margin-bottom: 5px;" data-bs-toggle="modal" data-bs-target="#delete<?php echo $value['id']; ?>"><i style="color:#fff;" class="fa fa-trash"></i></a>
                            <?php } ?>
                            <div style="width:100%;">
                                <img style="margin-bottom:30px;" src="<?php echo base_url() . '/uploads/' . $value['file_path']; ?>" height="100%" width="100%" />
                            </div>
                            <div class="modal fade" id="delete<?php echo $value['id']; ?>" role="dialog">
                                <div class="modal-dialog">
                                    <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Offers/deleteoffer/<?php echo $value['id']; ?>">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Confirm Header </h4>
                                                <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure, you want to delete Offer Image <b><?php echo $value['file_path']; ?> </b>? </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary ">Submit</button>
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
	</div>
<?php } else { ?>
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
                <h4 class="text-themecolor">My Offers</h4>
            </div>
            <div class="col-md-7 align-self-center text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb justify-content-end">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">My Offers</li>
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
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title"> <?= $title ?></h3>
                    <div class="pull-right error_msg">
                        <?php echo validation_errors(); ?>
                        <?php if (isset($message_display)) {
                            echo $message_display;
                        } ?>
                    </div>
                </div>
                <div class="card-body">
                    <?php if ($role_id == '1') { ?>
                        <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Offers/add_new_offer" enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="row col-md-12">
                                    <div class="col-md-12">
                                        <fieldset>
                                            <legend> <b>Upload Offer Images </b></legend>
                                            <div class="table-responsive">
                                                <table id="maintable" class="table">
                                                    <thead style="background-color: #ffd8cc; color: #000000;">
                                                        <tr>
                                                            <th>S.No.</th>
                                                            <th style="white-space: nowrap;"> Upload File</th>
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
                            </div>
                            <div class="form-group">
                                <div class="row col-md-12">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary btn-block"> Click Here To Upload Banner Images</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <hr>
                    <?php } ?>
                    <div class="form-group">
                        <div class="row col-md-12">
                            <div class="col-md-12">
                                <h3> Offer Images</h3>
                            </div>
                            <?php foreach ($result as $key => $value) {
                            ?>
                                <div class="col-md-12">
                                    <?php if ($role_id == '1') { ?>
                                        <a class="btn btn-xs btn-danger" style="margin-bottom: 5px;" data-bs-toggle="modal" data-bs-target="#delete<?php echo $value['id']; ?>"><i style="color:#fff;" class="fa fa-trash"></i></a>
                                    <?php } ?>
                                    <div style="width:100%;">
                                        <img style="margin-bottom:30px;" src="<?php echo base_url() . '/uploads/' . $value['file_path']; ?>" height="100%" width="100%" />
                                    </div>
                                    <div class="modal fade" id="delete<?php echo $value['id']; ?>" role="dialog">
                                        <div class="modal-dialog">
                                            <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Offers/deleteoffer/<?php echo $value['id']; ?>">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Confirm Header </h4>
                                                        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Are you sure, you want to delete Offer Image <b><?php echo $value['file_path']; ?> </b>? </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary ">Submit</button>
                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->
</div>
<?php } ?>
<!-- ============================================================== -->
<!-- End Container fluid  -->

<table id="sample_table1" style="display: none;">
    <tbody>
        <tr class="main_tr1">
            <td>1</td>
            <td>
                <input type="file" name="offer_images[]" class="form-control upload" required="required">
            </td>
            <td>
                <button type="button" class="btn btn-xs btn-primary addrow" href="#" role='button'><i class="fa fa-plus"></i></button>
                <button type="button" class="btn btn-xs btn-danger deleterow" href="#" role='button'><i class="fa fa-minus"></i></button>
            </td>
        </tr>
    </tbody>
</table>

<script src="<?php echo base_url(); ?>assets/node_modules/jquery/dist/jquery.min.js"></script>

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
            });
        }
    });
</script>