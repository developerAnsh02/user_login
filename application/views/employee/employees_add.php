<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!-- ============================================================== -->
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
                <h4 class="text-themecolor">Add New User</h4>
            </div>
            <div class="col-md-7 align-self-center text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb justify-content-end">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Add New User</li>
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
            <div class="col-12">
                <div class="card">
                    <div class="card">
                        <div class="card-body">
                            <form class="floating-labels m-t-40" role="form" method="post" action="<?php echo base_url(); ?>index.php/Employees/add_new_employee" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group has-warning m-b-40">
                                            <input type="text" class="form-control" id="input10" name="name" required>
                                            <span class="bar"></span>
                                            <label for="input10">Name</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group has-success m-b-40">
                                            <input type="email" class="form-control" id="input11" name="email" required>
                                            <span class="bar"></span>
                                            <label for="input11">Email</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group has-error has-danger m-b-40">
                                            <input type="mobile" class="form-control" id="input12" name="mobile_no" required>
                                            <span class="bar"></span>
                                            <label for="input12">Mobile</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group has-warning m-b-40">
                                            <?php echo form_dropdown('role_id', $roles, '', 'required="required"'); ?>
                                            <span class="bar"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group has-success m-b-40">
                                            <?php echo form_dropdown('countrycode', $countries, '', 'required="required"') ?>
                                            <span class="bar"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group has-error has-danger m-b-40">
                                            <?php echo form_dropdown('bank_id', $banks, '', 'required="required"') ?>
                                            <span class="bar"></span>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>