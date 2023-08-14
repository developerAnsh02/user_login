<?php
defined('BASEPATH') or exit('No direct script access allowed');
$base = base_url();
$hyperlink_ordes = $base . 'index.php/Orders/index';
$hyperlink_customers = $base . 'index.php/Employees/index';
$role_id = $this->session->userdata['logged_in']['role_id'];
?>

<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <?php if ($this->session->flashdata('success')) : ?>
            <div class="alert alert-success">
                <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')) : ?>
            <div class="alert alert-danger">
                <?php echo $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>

        <!-- Rest of your code -->
    <!-- </div> -->
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
            </div>
            <div class="col-md-7 align-self-center text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb justify-content-end">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
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
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Orders/insert_sub_writer">
                            <div class="form-group">
                                <div class="row col-md-12">
                                    <div class="col-md-8 col-sm-8">
                                        <label class="control-label">Writer Email</label>
                                        <input type="text" placeholder="Enter Writer email" name="writer_email" class="form-control" value="" required autofocus>
                                    </div>
                                </div>
                                <?php if($role_id == 1) { ?>
                                <div class="row col-md-12">
                                    <div class="col-md-8 col-sm-8">
                                        <label class="control-label">Writer TL</label>
                                        <select name="writer_name_new" class="form-control" >
                                            <option value="">Select an employee</option>
                                            <?php foreach ($writerTL as $employee) : ?>
                                                <option value="<?php echo $employee['id']; ?>" <?php if (@$obj['writer_name_new'] == $employee['id']) { echo "selected"; } ?>><?php echo $employee['name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <?php } ?>
                                       
                                <br>
                                <span class="help-block"></span>
                                <div class="row col-md-12">
                                    <div class="col-md-8 col-sm-8">
                                        <button type="submit" class="btn btn-primary btn-block">Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <h5>Category List</h5>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Sr.No.</th>
                                    <th>Writer Name/Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($writers as $index => $writer) : ?>
                                    <tr>
                                        <td><?php echo $index + 1; ?></td>
                                        <td><?php echo $writer['name'] . ' (' . $writer['email'] . ')'; ?></td>
                                        <td>
                                            <?php if($role_id ==2){ ?>
                                            <a href="https://www.assignnmentinneed.com/user_login/index.php/Employees/edit/<?php echo $writer['id'] ?>"><i class="fa fa-edit"></i></a>
                                           <?php } ?>
                                            <a class="btn btn-xs btn-danger btnEdit" data-bs-toggle="modal" data-bs-target="#delete<?php echo $writer['id']; ?>"><i style="color:#fff;" class="fa fa-trash"></i></a>
                                        </td>
                                        <div class="modal fade" id="delete<?php echo $writer['id']; ?>" role="dialog">
                                            <div class="modal-dialog">
                                                <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Employees/deleteEmployee/<?php echo $writer['id']; ?>">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Delete User</h4>
                                                            <button type="button" class="btn btn-danger btn-xm close" data-bs-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Are you sure, you want to delete User <b><?php echo $writer['email']; ?> </b>?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
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
            <?php if ($this->session->flashdata('success')) : ?>
                // Show success alert
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: '<?php echo $this->session->flashdata('success'); ?>',
                    timer: 3000,
                    showConfirmButton: false
                });
            <?php endif; ?>
        });
    </script>
