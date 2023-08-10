<?php
defined('BASEPATH') or exit('No direct script access allowed');
$base                = base_url();
$hyperlink_ordes     = $base . 'index.php/Orders/index';
$hyperlink_customers = $base . 'index.php/Employees/index';
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
            <div class="col-md-5">
                <?php if (!empty($id)) { ?>
                    <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Meenus/editmenu/<?= $id ?>">
                        <input type="hidden" name="menu_id" value="<?= $id ?>">
                    <?php } else { ?>
                        <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Meenus/add_new_menu">
                        <?php } ?>
                        <input type="hidden" name="url" value="<?php echo base_url(); ?>">
                        <div class="row">
                            <div class="col-md-12 mt-1">
                                <input type="text" placeholder="Enter menu name" name="menu_name" class="form-control" value="<?= $menu_name ?>" required autofocus>
                            </div>
                            <div class="col-md-12 mt-1">
                                <?php
                                echo form_dropdown('parent_id', $parentMenus, $parent_id)
                                ?>
                            </div>
                            <div class="col-md-12 mt-1">
                                <input type="text" placeholder="Enter Controller name" name="controller" class="form-control" value="<?= $controller ?>" autofocus>
                            </div>
                            <div class="col-md-12 mt-1">
                                <input type="text" placeholder="Enter Action name" name="action" class="form-control" value="<?= $action ?>" autofocus>
                            </div>
                            <div class="col-md-12 mt-1">
                                <input type="text" placeholder="Enter Icon Class" name="icon_class" class="form-control" value="<?= $icon_class ?>" autofocus>
                            </div>
                            <div class="col-md-12 mt-1">
                                <select class="form-control" name="show_menu" required>
                                    <option value="" selected>Show menu</option>
                                    <option value="Y" <?php if ($show_menu == 'Y') {
                                                            echo 'selected';
                                                        } ?>> Y</option>
                                    <option value="N" <?php if ($show_menu == 'N') {
                                                            echo 'selected';
                                                        } ?>> N</option>
                                </select>
                            </div>
                            <div class="col-md-12 mt-1">
                                <select class="form-control" name="is_parent" required>
                                    <option value="" selected>Is Parent</option>
                                    <option value="Y" <?php if ($is_parent == 'Y') {
                                                            echo 'selected';
                                                        } ?>> Y</option>
                                    <option value="N" <?php if ($is_parent == 'N') {
                                                            echo 'selected';
                                                        } ?>> N</option>
                                </select>
                            </div>
                            <div class="col-md-12 mt-1">
                                <input type="text" placeholder="Enter Target" name="target" class="form-control" value="<?= $target ?>" autofocus>
                            </div>
                            <div class="col-md-12 mt-1">
                                <span class="control-span" style="visibility: hidden;"> Name</span><br>
                                <button type="submit" class="btn btn-primary btn-block">Save</button>
                            </div>
                        </div>
                        </form>
            </div>
            <div class="col-md-7">
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width: 5%;"> Sr.No.</th>
                                <th style="width: 10%;"> Parent</th>
                                <th style="width: 10%;"> Menu</th>
                                <th style="width: 10%;"> Action</th>
                                <th style="width: 10%;"> Button</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($menus as $menu) { ?>
                                <tr>
                                    <td style="width: 5%;"><?= $i ?></td>
                                    <td style="width: 10%;"><?= $menu['parent'] ?></td>
                                    <td style="width: 10%;"><?= $menu['menu_name'] ?></td>
                                    <td><?= $menu['action'] ?></td>
                                    <td class="d-flex">
                                        <a class="btn btn-xs btn-info btnEdit m-1" href="<?php echo base_url(); ?>index.php/Meenus/index/<?php echo $menu['id']; ?>">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a class="btn btn-xs btn-danger btnEdit m-1" data-bs-toggle="modal" data-bs-target="#delete<?php echo $menu['id']; ?>">
                                            <i style="color:#fff;" class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                    <div class="modal fade" id="delete<?php echo $menu['id']; ?>" role="dialog">
                                        <div class="modal-dialog">
                                            <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Meenus/delete/<?php echo $menu['id']; ?>">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Confirm Header </h4>
                                                        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Are you sure, you want to delete menu <b><?php echo $menu['menu_name']; ?> </b>? </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary ">Submit</button>
                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </tr>
                            <?php $i++;
                            } ?>
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