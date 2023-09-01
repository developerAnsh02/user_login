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
                <h4 class="text-themecolor">Edit New User</h4>
            </div>
            <div class="col-md-7 align-self-center text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb justify-content-end">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Edit New User</li>
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
                            <form class="floating-labels m-t-40 " role="form" method="post" action="<?php echo base_url(); ?>index.php/Employees/editwriter/<?= $id ?>" enctype="multipart/form-data">
                                <input type="hidden" name="employees_id" value="<?= $id ?>">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group has-warning m-b-40">
                                            <input type="text" value="<?= $name; ?>" class="form-control" id="input10" name="name" required>
                                            <span class="bar"></span>
                                            <label for="input10">Name</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group has-success m-b-40">
                                            <input type="email" value="<?= $email; ?>" class="form-control" id="input11" name="email" required>
                                            <span class="bar"></span>
                                            <label for="input11">Email</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group has-error has-danger m-b-40">
                                            <input type="mobile" oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" value="<?= $mobile_no; ?>" class="form-control" id="input12" name="mobile_no" required>
                                            <span class="bar"></span>
                                            <label for="input12">Mobile</label>
                                        </div>
                                    </div>
                                   
                                    <div class="col-lg-4">
                                        <div class="form-group has-success m-b-40">
                                            <?php echo form_dropdown('countrycode', $countries, $countrycode, '', 'required="required"') ?>
                                            <span class="bar"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group has-error has-danger m-b-40">
                                            <?php echo form_dropdown('bank_id', $banks, $bank_id, '', 'required="required"') ?>
                                            <span class="bar"></span>
                                        </div>
                                    </div>
                                   
                                    <div class="col-lg-4">
                                        <div class="form-group has-error has-danger m-b-40">
                                            <select name="writer_name_new" class="form-control" >
                                                <option value="">Select an employee</option>
                                                <option value="8392" <?php if ($tl_id== 8392) { echo "selected"; } ?>>Admin</option>
                                                <?php foreach ($writerTL as $employee) : ?>
                                                    <option value="<?php echo $employee['id']; ?>" <?php if ($tl_id== $employee['id']) { echo "selected"; } ?>><?php echo $employee['name']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <span class="bar"></span>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
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
            //alert(size);
            var validImageTypes = ["image/jpeg", "image/png"];
            if ($.inArray(fileType, validImageTypes) < 0) {
                alert('Invalid file type , please select jpg/png file only !');
                $(this).val('');
            }
            if (size > 5000) {
                alert('Image size exceed , please select < 5 MB file only !');
                $(this).val('');
            }

            readURL(this);
        });
    });
</script>