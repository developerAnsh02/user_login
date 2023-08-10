<?php
defined('BASEPATH') or exit('No direct script access allowed');
$base                = base_url();
$hyperlink_ordes     = $base . 'index.php/Orders/failedJobs';
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
            <div class="col-md-12 mb-3">
                <form method="get" id="filterForm">
                    <div class="row">
                        <div class="col-sm-2">
                            <input type="text" data-date-formate="dd-mm-yyyy" name="from_date" class="form-control mdate" value="<?php if (isset($conditions['from_date']) && !empty($conditions['from_date'])) {
                                                                                                                                        echo $conditions['from_date'];
                                                                                                                                    } ?>" placeholder="From Order Date">
                        </div>
                        <div class="col-sm-2">
                            <input type="text" data-date-formate="dd-mm-yyyy" name="upto_date" class="form-control mdate" value="<?php if (isset($conditions['upto_date']) && !empty($conditions['upto_date'])) {
                                                                                                                                        echo $conditions['upto_date'];
                                                                                                                                    } ?>" placeholder="To Order Date">
                        </div>
                        <div class="col-sm-2">

                            <select name="writer_name" class="form-control">
                                <option value="">Select Writer</option>
                                <?php
                                $teams = getWriterTeams();
                                foreach ($teams as $team) {
                                ?>
                                    <option <?php if ($conditions['writer_name'] == $team) {
                                                echo "selected";
                                            } ?> value="<?= $team ?>">
                                        <?= $team ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <input type="text" data-date-formate="dd-mm-yyyy" name="d_from_date" class="form-control mdate" value="<?php if (isset($conditions['d_from_date']) && !empty($conditions['d_from_date'])) {
                                                                                                                                        echo $conditions['d_from_date'];
                                                                                                                                    } ?>" placeholder="From Delivery Date">
                        </div>
                        <div class="col-sm-2">
                            <input type="text" data-date-formate="dd-mm-yyyy" name="d_upto_date" class="form-control mdate" value="<?php if (isset($conditions['d_upto_date']) && !empty($conditions['d_upto_date'])) {
                                                                                                                                        echo $conditions['d_upto_date'];
                                                                                                                                    } ?>" placeholder="To Delivery Date">
                        </div>
                        <div class="col-sm-2">
                            <input type="submit" class="btn btn-primary" value="Search" />
                            <a href="<?php echo $hyperlink_ordes; ?>" class="btn btn-danger"> Reset</a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-12">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="5%"> Sr.No.</th>
                            <th> Order Date </th>
                            <th> Order Code </th>
                            <th> Delivery Date </th>
                            <th> Writer Name </th>
                            <th> Writer Deadline </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($datalists as $datalist) { ?>
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
                                <td>
                                    <?php echo date('d-M-Y', strtotime($datalist['order_date'])); ?>
                                </td>
                                <td>
                                    <?php echo $datalist['order_id']; ?>
                                </td>
                                <td>
                                    <?php echo date('d-M-Y', strtotime($datalist['delivery_date'])); ?>
                                </td>
                                <td>
                                    <?php echo $datalist['writer_name']; ?>
                                </td>
                                <td>
                                    <?php if (isset($datalist['writer_deadline']) && !empty($datalist['writer_deadline'])) {
                                        echo date('d-M-Y', strtotime($datalist['writer_deadline']));
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php $i++;
                        } ?>
                    </tbody>
                    
                </table>
               
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->

    <script src="<?php echo base_url(); ?>assets/node_modules/jquery/dist/jquery.min.js"></script>