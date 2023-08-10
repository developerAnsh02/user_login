<?php
defined('BASEPATH') or exit('No direct script access allowed');
$role_id = $this->session->userdata['logged_in']['role_id'];
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
                <h4 class="text-themecolor">Users List</h4>
            </div>
            <div class="col-md-7 align-self-center text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb justify-content-end">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Users List</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="col-lg-12 mb-3">
                            <form method="get" id="filterForm">
                                <div class="row">
                                    <div class="col-md-4 col-sm-4">
                                        <select name="customer_id" class="form-control customers select2">
                                            <option value="0"> Select user</option>
                                            <?php
                                            if ($all_customers) : ?>
                                                <?php
                                                foreach ($all_customers as $value) : ?>
                                                    <?php
                                                    if (isset($conditions) && $value['id'] == $conditions['customer_id']) : ?>
                                                        <option value="<?= $value['id'] ?>" selected>
                                                            <?php echo $value['name'] . ' &nbsp;&nbsp;&nbsp; (' . $value['email'] . ') &nbsp;&nbsp;&nbsp; (' . $value['mobile_no'] . ')'; ?>
                                                        </option>
                                                    <?php else : ?>
                                                        <option value="<?= $value['id'] ?>">
                                                            <?php echo $value['name'] . ' &nbsp;&nbsp;&nbsp; (' . $value['email'] . ') &nbsp;&nbsp;&nbsp; (' . $value['mobile_no'] . ')'; ?>
                                                        </option>
                                                    <?php endif;   ?>
                                                <?php endforeach;  ?>
                                            <?php else : ?>
                                                <option value="0">No result</option>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2 col-sm-2">
                                        <input type="submit" class="btn btn-primary" value="Search" />
                                        <a href="index" class="btn btn-danger"> Reset</a>
                                    </div>
                                    <div class="col-md-6 col-sm-6" style="text-align: right;">

                                        <?php if ($role_id == 1) { ?>
                                            <a href="<?php echo base_url('index.php/Employees/export_csv'); ?>" class="btn" style="background-color: red; color:white;">
                                                Export
                                            </a>
                                        <?php } ?>

                                        <a href="<?php echo base_url('index.php/Employees/add'); ?>" class="btn" style="background-color: green; color:white;">
                                            Add New User
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="table-responsive">
                            <table class="table color-table purple-table">
                                <thead>
                                    <tr>
                                        <!-- <th><input type="checkbox" id="master"></th> -->
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($employees as $obj) { ?>
                                        <tr>
                                            <!-- <td><input type="checkbox" class="sub_chk" value="<?php echo $obj['id']; ?>" /></td> -->
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $obj['name']; ?></td>
                                            <td><?php echo $obj['email']; ?></td>
                                            <td><?php echo ' (+' . $obj['cnty_code'] . ') ' . $obj['mobile_no']; ?></td>
                                            <td>
                                                <a class="btn btn-xs btn-primary btnEdit" href="<?php echo base_url(); ?>index.php/Employees/edit/<?php echo $obj['id']; ?>"><i class="fa fa-edit"></i></a>
                                                <?php if ($role_id == 1) { ?>
                                                    <a class="btn btn-xs btn-danger btnEdit" data-bs-toggle="modal" data-bs-target="#delete<?php echo $obj['id']; ?>"><i style="color:#fff;" class="fa fa-trash"></i></a>
                                                <?php } ?>
                                            </td>
                                            <!-- Modal : Delete User -->
                                            <div class="modal fade" id="delete<?php echo $obj['id']; ?>" role="dialog">
                                                <div class="modal-dialog">
                                                    <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Employees/deleteEmployee/<?php echo $obj['id']; ?>">
                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title"> Delete User </h4>
                                                                <button type="button" class="btn btn-danger btn-xm close" data-bs-dismiss="modal">&times;</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Are you sure, you want to delete User <b><?php echo $obj['name']; ?> </b>? </p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-primary ">Submit</button>
                                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <!-- / Modal : Delete User -->
                                        </tr>
                                    <?php $i++;
                                    } ?>
                                </tbody>
                            </table>
                            <?php if ($role_id == 1) { ?>
                                <div class="pagination">
                                    <?php echo $links; ?> </p>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->

<script>
    $(document).ready(function() {

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
                WRN_PROFILE_DELETE = "Are you sure you want to delete all selected records?";
                var check = confirm(WRN_PROFILE_DELETE);
                if (check == true) {
                    var join_selected_values = allVals.join(",");
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>index.php/Employees/deleteEmployee",
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

    });
</script>