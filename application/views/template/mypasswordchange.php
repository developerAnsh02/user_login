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
        <!-- ============================================================== -->
        <div class="toolbar" id="kt_toolbar">
	<!--begin::Container-->
	<div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
		<!--begin::Page title-->
		<div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
			<!--begin::Title-->
			<h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Change My Password</h1>
			<!--end::Title-->
		</div>
	</div>
	<!--end::Container-->
</div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <center>
                <form action="<?php echo base_url(); ?>index.php/User_authentication/UserPasswordChange" method="post">
                    <?php
                    if ($this->session->userdata['logged_in']['role_id'] == '1') {
                    ?>
                        <div class="col-6 mb-2" style="text-align: left !important;">
                            <select name="emp_id" class="form-control select2 drop" required>
                                <option value=""> Select User </option>
                                <?php if ($employees) : ?>
                                    <?php foreach ($employees as $value) : ?>
                                        <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <option value="0">No result</option>
                                <?php endif; ?>
                            </select>
                        </div>
                    <?php } else { ?>
                        <input type="hidden" name="emp_id" value="<?= $this->session->userdata['logged_in']['id']; ?>">
                    <?php } ?>
                    <div class="col-6 mb-2">
                        <input type="password" class="form-control password" placeholder="Enter New Password" name="password" autocomplete="off" required>
                    </div>
                    <div class="col-6 mb-3">
                        <input type="password" class="form-control cpassword" placeholder="Confirm Password" name="confirm_password" required autocomplete="off">
                    </div>
                    <div class="col-6 mb-3">
                        <button type="submit" class="btn  btn-block btn-flat" style="background-color: #355fa9  ;color:#fff;"> Submit </button>
                    </div>
                </form>
            </center>
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
        <div class="row">
            <center>
                <form action="<?php echo base_url(); ?>index.php/User_authentication/UserPasswordChange" method="post">
                    <?php
                    if ($this->session->userdata['logged_in']['role_id'] == '1') {
                    ?>
                        <div class="col-6 mb-2" style="text-align: left !important;">
                            <select name="emp_id" class="form-control select2 drop" required>
                                <option value=""> Select User </option>
                                <?php if ($employees) : ?>
                                    <?php foreach ($employees as $value) : ?>
                                        <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <option value="0">No result</option>
                                <?php endif; ?>
                            </select>
                        </div>
                    <?php } else { ?>
                        <input type="hidden" name="emp_id" value="<?= $this->session->userdata['logged_in']['id']; ?>">
                    <?php } ?>
                    <div class="col-6 mb-2">
                        <input type="password" class="form-control password" placeholder="Enter New Password" name="password" autocomplete="off" required>
                    </div>
                    <div class="col-6 mb-3">
                        <input type="password" class="form-control cpassword" placeholder="Confirm Password" name="confirm_password" required autocomplete="off">
                    </div>
                    <div class="col-6 mb-3">
                        <button type="submit" class="btn  btn-block btn-flat" style="background-color: #355fa9  ;color:#fff;"> Submit </button>
                    </div>
                </form>
            </center>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->
</div>
<?php } ?>
<!-- ============================================================== -->
<!-- End Container fluid  -->

<script src="<?php echo base_url(); ?>assets/node_modules/jquery/dist/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {

        $('#close').on('click', function(e) {
            $(this).parent('.error_mesg').remove();
        });
        $(document).on('blur', '.cpassword', function() {
            var cpassword = $('.cpassword').val();
            var password = $('.password').val();
            if (password != '') {
                if (password != cpassword) {
                    alert("Passwords do not match.");
                    $('.cpassword').val('');
                }
            }
        });

        $(document).on('blur', '.password', function() {
            var cpassword = $('.cpassword').val();
            var password = $('.password').val();
            if (cpassword != '') {
                if (password != cpassword) {
                    alert("Passwords do not match.");
                    $('.password').val('');
                }
            }
        });

    });
</script>