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
            <div class="col-md-12">
                <form class="form-horizontal saveform" role="form" method="post" action="<?php echo base_url(); ?>index.php/Referrals/add_new_record" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="row col-md-12">
                            <div class="table-responsive">
                                <table id="maintable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sr.No.</th>
                                            <th style="white-space: nowrap;"> Name </th>
                                            <th style="white-space: nowrap;"> Email</th>
                                            <th> Country Code </th>
                                            <th style="white-space: nowrap;"> Mobile</th>
                                            <?php if ($role_id != 2) { ?>
                                                <th style="white-space: nowrap;"> Refer By </th>
                                            <?php } ?>
                                            <th colspan="2" style="white-space: nowrap;"> Action Button</th>
                                        </tr>
                                    </thead>
                                    <tbody id="mainbody">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row col-md-12">
                        <div class="col-md-12 col-sm-12 ">
                            <button type="submit" class="btn btn-primary btn-block save">Save</button>
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


    <table id="sample_table1" style="display: none;">
        <tbody>
            <tr class="main_tr1">
                <td>1</td>
                <td> <input type="text" style="width:150px;" placeholder="Enter Full Name" name="name[]" class="form-control" required autofocus></td>
                <td> <input type="text" style="width:250px;" placeholder="Enter email" name="email[]" class="form-control email" value="" required autofocus></td>
                <td> <?php echo form_dropdown('countrycode[]', $countries, '', 'required="required" id="my_drop" style="width:150px;"') ?></td>
                <td> <input type="text" style="width:200px;" placeholder="Enter mobile" name="mobile_no[]" class="form-control mobile" oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" value="" required autofocus></td>
                <?php if ($role_id != 2) { ?>
                    <td> <?php echo form_dropdown('refer_by_email[]', $useremails, '', 'required="required" id="my_drop" style="width:250px;"') ?></td>
                <?php } else { ?>
                    <td> <input type="hidden" style="width:150px;" value="<?php echo $email; ?>" name="refer_by_email[]" class="form-control" readonly></td>
                <?php } ?>
                <td>
                    <button type="button" class="btn btn-xs btn-primary addrow" href="#" role='button'><i class="fa fa-plus"></i></button>
                    <button type="button" class="btn btn-xs btn-danger deleterow" href="#" role='button'><i class="fa fa-minus"></i></button>
                </td>
            </tr>
        </tbody>
    </table>

    <script src="<?php echo base_url() . "assets/"; ?>plugins/jquery/jquery.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.saveform').submit(function() {
                var email_available = "true";
                var mobile_available = "true";
                $("#mainbody .email").each(function() {
                    var email = $(this).val();
                    $.ajax({
                        type: "Post",
                        url: "<?php echo base_url('index.php/Referrals/checkemail/'); ?>",
                        data: {
                            email: email
                        },
                        dataType: 'html',
                        async: false,
                        success: function(response) {
                            if (response > 0) {
                                email_available = "false";
                                return false;
                            }
                        }
                    });
                });

                if (email_available == "false") {
                    alert('Email is already exits.');
                    return false;
                }

                $("#mainbody .mobile").each(function() {
                    var mobile = $(this).val();
                    $.ajax({
                        type: "Post",
                        url: "<?php echo base_url('index.php/Referrals/checkmobile/'); ?>",
                        data: {
                            mobile: mobile
                        },
                        dataType: 'html',
                        async: false,
                        success: function(response) {
                            if (response > 0) {
                                mobile_available = "false";
                                return false;
                            }
                        }
                    });
                });
                if (mobile_available == "false") {
                    alert('Mobile No. is already exits.');
                    return false;
                }
            });

            add_row();
            $('body').on('click', '.addrow', function() {

                var table = $(this).closest('table');
                add_row();
                rename_rows();
                calculate_total(table);
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
                        calculate_total(table);
                    }
                }
            });

            function rename_rows() {
                var i = 0;
                $("#maintable tbody tr.main_tr1").each(function() {
                    $(this).find("td:nth-child(1)").html(++i);
                });
            }

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#blah').removeClass('hide');
                        $('#blah').addClass('show');
                        $('#blah').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $(".upload").change(function() {
                var file = this.files[0];
                var fileType = file["type"];
                var size = parseInt(file["size"] / 1024);
                var validImageTypes = ["image/jpeg", "image/png"];
                if ($.inArray(fileType, validImageTypes) < 0) {
                    alert('Invalid file type , please select jpg/png file only !');
                    $(this).val('');
                }
                if (size > 5000) {
                    alert('Image size exceed , please select < 5MB file only !');
                    $(this).val('');
                }
                readURL(this);
            });
        });
    </script>