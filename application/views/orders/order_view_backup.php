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
</style>

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

            <!-- Accordian -->
            <div class="accordion" id="accordionExample">
                <div class="card m-b-0">
                    <div class="card-body">
                        <form method="get" id="filterForm">
                            <div class="row">
                                <?php if ($role_id == '1' || $role_id == '3' || $role_id == '4' || $role_id == '5') {  ?>
                                    <div class="col-md-3 col-sm-3">
                                        <!-- <label class="control-label">Name of Customer <span class="required">*</span></label> -->
                                        <select name="customer_id" class="form-control select2 customers">
                                            <option value="0"> Select customer name</option>
                                            <?php
                                            if ($all_customers) : ?>
                                                <?php
                                                foreach ($all_customers as $value) : ?>
                                                    <?php
                                                    if (isset($customer_id) && !empty($customer_id) && $value['id'] == $customer_id) : ?>
                                                        <option value="<?= $value['id'] ?>"><?= $value['name'] ?> <?= $value['email'] ?> <?= $value['mobile_no'] ?></option>
                                                    <?php else : ?>
                                                        <option value="<?= $value['id'] ?>"><?= $value['name'] ?> <?= $value['email'] ?> <?= $value['mobile_no'] ?></option>
                                                    <?php endif;   ?>
                                                <?php endforeach;  ?>
                                            <?php else : ?>
                                                <option value="0">No result</option>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                <?php } ?>

                                <?php if ($role_id == '1' || $role_id == '3' || $role_id == '4' || $role_id == '5') { ?>
                                    <div class="col-md-3 col-sm-3">
                                        <!-- <label class="control-label"> Search By Order Id <span class="required">*</span></label> -->
                                        <select name="order_id" class="form-control select2 ">
                                            <option value="0"> Search By Order Id</option>
                                            <?php
                                            if ($OrderIDs) : ?>
                                                <?php
                                                foreach ($OrderIDs as $value) : ?>

                                                    <option value="<?= $value['order_id'] ?>"><?= $value['order_id'] ?></option>
                                                <?php endforeach;  ?>
                                            <?php else : ?>
                                                <option value="0">No result</option>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                <?php } ?>

                                <div class="col-md-3 col-sm-3">
                                    <!-- <label class="control-label"> From Date</label> -->
                                    <input type="text" data-date-formate="dd-mm-yyyy" name="from_date" class="form-control mdate" value="<?php echo @$from_date; ?>" placeholder="From Date">
                                </div>
                                <div class="col-md-3 col-sm-3">
                                    <!-- <label class="control-label"> Upto Date</label> -->
                                    <input type="text" data-date-formate="dd-mm-yyyy" name="upto_date" class="form-control mdate" value="<?php echo @$upto_date; ?>" placeholder="Upto Date">
                                </div>
                            </div>
                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="row mt-3">
                                    <div class="col-md-3 col-sm-3">
                                        <!-- <label> Order Date :</label> -->
                                        <select class="form-control" name="order_date_filter">
                                            <option value="order_date">Order Date</option>
                                            <option value="delivery_date">Delivery Date</option>
                                            <option value="writer">Writer deadline</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                        <!-- <label> Order Status :</label> -->
                                        <select class="form-control" name="status">
                                            <option value="">Order Status</option>
                                            <option value="Pending">Pending</option>
                                            <option value="In Progress">In Progress</option>
                                            <option value="Completed">Completed</option>
                                            <option value="Delivered">Delivered</option>
                                            <option value="Feedback">Feedback</option>
                                            <option value="Feedback Delivered">Feedback Delivered</option>
                                            <option value="Cancelled">Cancelled</option>
                                            <option value="Draft Ready">Draft Ready</option>
                                            <option value="Draft Delivered">Draft Delivered</option>
                                            <option value="Other">Other</option>
                                            <option value="initiated">initiated</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                        <!-- <label> Title :</label> -->
                                        <select class="form-control" name="filter_check">
                                            <option value="title">Title</option>
                                            <option value="writer">Writer Name</option>
                                            <option value="college">College Name</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                        <!-- <label class="control-label"> Search</label> -->
                                        <input type="text" name="title" class="form-control" value="" placeholder="Title,College,Writer">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <label class="control-label" style="visibility: hidden;"> Grade</label>
                                    <br>

                                    <input type="submit" class="btn btn-primary" value="Search" />

                                    <label class="control-label" style="visibility: hidden;"> Grade</label>

                                    <a href="<?php echo $data[0] ?>" class="btn btn-danger"> Reset</a>

                                    <label class="control-label" style="visibility: hidden;"> Grade</label>

                                    <button style="background-color: green; color:white;" id="headingOne" class="btn btn-link collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Show Filters
                                    </button>
                                </div>

                                <?php if ($role_id == 1) { ?>
                                    <div class="col-md-6 col-sm-6" style="text-align: right;">
                                        <label class="control-label" style="visibility: hidden;">Hidden</label>
                                        <br>
                                        <a href="<?php echo base_url('index.php/Orders/ordersCSV'); ?>" class="btn btn-success" type="button" style="border:none; background-color: red; color:white;">
                                            Export
                                        </a>
                                    </div>
                                <?php } ?>

                            </div>
                        </form>
                    </div>

                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="demo-foo-addrow" class="table table-bordered m-t-30 table-hover contact-list" data-paging="true" data-paging-size="7">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th style="white-space: nowrap;">Order Code</th>
                                        <th>Order Date</th>
                                        <th>Delivery Date</th>
                                        <th>Title</th>
                                        <th> Status</th>
                                        <th>Words</th>
                                        <th>Amount</th>
                                        <th> Paid </th>
                                        <th> Due </th>
                                        <?php if ($role_id != 2) { ?>
                                            <th style="white-space: nowrap;">Writer Name</th>
                                            <th style="white-space: nowrap;">Writer Deadline</th>
                                        <?php } ?>
                                        <th style="white-space: nowrap;">Action Button</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $i = 1;
                                    foreach ($orders as $obj) { ?>
                                        <tr <?php if ($obj['is_read'] == 0) { ?> style="font-weight: 700;" <?php } ?> class="read_order" order_id="<?= $obj['id'] ?>">
                                            <input type="hidden" class="row_id" value="<?= $obj['id'] ?>">
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $obj['order_id']; ?></td>
                                            <td style="white-space: nowrap;">
                                                <?php echo date('d-M-Y', strtotime($obj['order_date'])); ?>
                                            </td>
                                            <td style="white-space: nowrap;">
                                                <?php
                                                echo date('d-M-Y', strtotime($obj['delivery_date']));
                                                if (isset($obj['delivery_time']) && !empty($obj['delivery_time'])) {
                                                    echo ' ( ' . $obj['delivery_time'] . ' )';
                                                }
                                                ?>
                                            </td>
                                            <td style="white-space: nowrap;">
                                                <?php echo $obj['title']; ?>
                                            </td>

                                            <?php
                                            if ($obj['projectstatus'] == 'Pending') {
                                                $color = "#ff8acc";
                                            } elseif ($obj['projectstatus'] == 'Cancelled') {
                                                $color = "red";
                                            } elseif ($obj['projectstatus'] == 'Completed' || $obj['projectstatus'] == 'Draft Ready') {
                                                $color = "#fec107";
                                            } elseif ($obj['projectstatus'] == 'In Progress') {
                                                $color = "#5b69bc";
                                            } elseif ($obj['projectstatus'] == 'Feedback') {
                                                $color = "black";
                                            } elseif ($obj['projectstatus'] == 'Delivered' || $obj['projectstatus'] == 'Draft Delivered' || $obj['projectstatus'] == 'Feedback Delivered') {
                                                $color = "green";
                                            } elseif ($obj['projectstatus'] == 'initiated') {
                                                $color = "#fb9678";
                                            } else {
                                                $color = "#35b8e0";
                                            }
                                            ?>
                                            <td style="white-space: nowrap;">
                                                <span class="label label-primary" style="background-color:<?= $color ?>;">
                                                    <?= $obj['projectstatus'] ?>
                                                </span>
                                            </td>

                                            <td style="white-space: nowrap;">
                                                <?php
                                                $data = $obj['pages'];
                                                $data1 = explode(' (', $data);
                                                @$data_new = explode(' ', $data1['1']);
                                                if (isset($data_new['0']) && !empty($data_new['0'])) {
                                                    echo $data_new['0'];
                                                } else {
                                                    echo $obj['pages'];
                                                }
                                                ?>
                                            </td>

                                            <td style="white-space: nowrap;">
                                                <?php echo @$obj['amount']; ?> &#163;
                                            </td>

                                            <?php
                                            if (!isset($obj['amount']) && empty($obj['amount'])) {
                                                $obj['amount'] = 0;
                                            }
                                            ?>
                                            <td style="white-space: nowrap;">
                                                <?php echo @$obj['received_amount']; ?> &#163;
                                            </td>

                                            <td style="white-space: nowrap;">
                                                <?php

                                                if (!isset($obj['amount']) && empty($obj['amount'])) {
                                                    $obj['amount'] = 0;
                                                }

                                                echo (float)$obj['amount'] - (float)$obj['received_amount'];

                                                ?>
                                                &#163;
                                            </td>

                                            <?php
                                            if ($role_id != 2) { ?>
                                                <td style="white-space: nowrap;">
                                                    <?php echo $obj['writer_name']; ?>
                                                </td>
                                                <td style="white-space: nowrap;">
                                                    <?php if (($obj['writer_deadline'] != '1970-01-01') and (!empty($obj['writer_deadline']))) {
                                                        echo date('d-M-Y', strtotime($obj['writer_deadline']));
                                                    }  ?>
                                                </td>
                                            <?php } ?>

                                            <td style="display:none;"><?php echo $obj['c_name']; ?></td>
                                            <td style="display:none;"><?php echo $obj['c_mobile']; ?></td>
                                            <td style="display:none;"><?php echo $obj['c_email']; ?></td>

                                            <!-- Action Buttons -->
                                            <td style="white-space: nowrap;">

                                                <a class="btn btn-xs btn-info btn-sm m-1" data-bs-toggle="modal" data-bs-target="#view<?php echo $obj['id']; ?>">
                                                    <i style="color:#fff;" class="fa fa-eye"></i>
                                                </a>

                                                <?php if ($role_id == 1) { ?>
                                                    <!-- <a href="<?php echo base_url(); ?>index.php/Orders/edit/<?php echo $obj['order_id']; ?>" class="btn btn-xs btn-dark btn-sm m-1">
                                                        <i style="color:#fff;" class="fa fa-edit"></i>
                                                    </a> -->
                                                    <a type="button" class="btn btn-xs btn-dark btn-sm m-1" data-bs-toggle="modal" data-bs-target="#editModal<?= $obj['id'] ?>" title="Order Edit">
                                                        <i style="color:#fff;" class="fa fa-edit"></i>
                                                    </a>
                                                <?php } ?>

                                                <?php if ($role_id != 2) { ?>

                                                    <?php
                                                    if (isset($obj['quotation_status']) && $obj['quotation_status'] == 1) {
                                                        $btn_class = 'success';
                                                    } else {
                                                        $btn_class = 'danger';
                                                    }
                                                    ?>
                                                    <a class="btn btn-xs btn-<?= $btn_class ?> btn-sm m-1" href="<?php echo base_url(); ?>index.php/Orders/Emails/<?php echo $obj['uid']; ?>">
                                                        <i class="fa fa-envelope"></i>
                                                    </a>

                                                    <?php if (($obj['projectstatus'] != 'Feedback Delivered') || ($obj['paymentstatus'] != 'Completed')) { ?>
                                                        <?php if ($role_id == 3 || $role_id == 4 || $role_id == 5) { ?>
                                                            <!-- <a href="<?php echo base_url(); ?>index.php/Orders/edit/<?php echo $obj['order_id']; ?>" class="btn btn-xs btn-dark btn-sm m-1">
                                                                <i style="color:#fff;" class="fa fa-edit"></i>
                                                            </a> -->
                                                            <a type="button" class="btn btn-xs btn-dark btn-sm m-1" data-bs-toggle="modal" data-bs-target="#editModal<?= $obj['id'] ?>" title="Order Edit">
                                                                <i style="color:#fff;" class="fa fa-edit"></i>
                                                            </a>
                                                        <?php } ?>
                                                    <?php } ?>

                                                    <?php if ($obj['paymentstatus'] != 'Completed') { ?>
                                                        <!-- <a href="<?php echo base_url(); ?>index.php/Orders/payments/<?php echo $obj['id']; ?>" class="btn btn-xs btn-light btnPayment m-1" title="Add Payment" style="background-color: red;">
                                                            <i style="color:#fff;" class="fa fa-money"></i>
                                                        </a> -->
                                                        <a type="button" class="btn btn-xs btn-primary btn-sm m-1" data-bs-toggle="modal" data-bs-target="#paymentModal<?= $obj['id'] ?>" title="Order Payment" style="background-color: red;">
                                                            <i style="color:#fff;" class="fa fa-money"></i>
                                                        </a>
                                                    <?php } ?>

                                                    <?php if ($obj['projectstatus'] == 'Pending' || $obj['projectstatus'] == 'Cancelled') { ?>
                                                        <a class="btn btn-xs btn-warning btn-sm m-1" href="<?php echo base_url(); ?>index.php/Orders/callstatus/<?php echo $obj['id']; ?>">
                                                            <i style="color:#fff;" class="fa fa-phone"></i>
                                                        </a>
                                                    <?php } ?>

                                                <?php } ?>

                                                <!-- Mark Job Failed -->
                                                <a type="button" class="btn btn-xs btn-primary btn-sm m-1 mark_as_failed" title="Mark as failed job" style="background-color:tomato;">
                                                    <i style="color:#fff;" class="fa fa-close"></i>
                                                </a>
                                                <!-- / Mark Job Failed -->

                                                <!-- Button trigger modal -->
                                                <a type="button" class="btn btn-xs btn-primary btn-sm m-1" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $obj['id'] ?>" title="More buttons">
                                                    <i style="color:#fff;" class="fa fa-list"></i>
                                                </a>
                                                <!-- Button trigger modal -->

                                                <!-- More Buttons Modal -->
                                                <div class="modal fade" id="exampleModal<?= $obj['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">More Buttons</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <?php if ($role_id == 1) { ?>
                                                                    <a style="color:#fff;" class="btn btn-xs btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#duplicate<?php echo $obj['id']; ?>">
                                                                        <i class="fa fa-first-order" aria-hidden="true"></i>
                                                                    </a>

                                                                    <a href="<?php echo base_url(); ?>index.php/Orders/indusialemail/<?php echo $obj['id']; ?>" style="color:#fff;" class="btn btn-xs btn-warning btn-sm">
                                                                        <i class="fa fa-envelope-open-o" aria-hidden="true"></i>
                                                                    </a>

                                                                    <!-- <a href="<?php echo base_url(); ?>index.php/Orders/payments/<?php echo $obj['id']; ?>" class="btn btn-xs btn-light btnPayment m-1" title="Add Payment" style="background-color: red;">
                                                                        <i style="color:#fff;" class="fa fa-money"></i>
                                                                    </a> -->
                                                                    <a type="button" class="btn btn-xs btn-primary btn-sm m-1" data-bs-toggle="modal" data-bs-target="#paymentModal<?= $obj['id'] ?>" title="Order Payment" style="background-color: red;">
                                                                        <i style="color:#fff;" class="fa fa-money"></i>
                                                                    </a>

                                                                    <!-- Duplicate row modal -->
                                                                    <div class="modal fade" id="duplicate<?php echo $obj['id']; ?>" role="dialog">
                                                                        <div class="modal-dialog">
                                                                            <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Orders/duplicate/<?php echo $obj['id']; ?>">
                                                                                <!-- Modal content-->
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h4 class="modal-title">Confirm Header </h4>
                                                                                        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <p>Are you sure, you want to create duplicate Order ? </p>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="submit" class="btn btn-primary ">Submit</button>
                                                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>

                                                                <?php } ?>

                                                                <?php if ($role_id == 2) { ?>
                                                                    <button class="btn btn-info btn-sm" data-bs-toggle="modal" title="Download File" data-bs-target="#download<?php echo $obj['id']; ?>"><i class="fa fa-download"></i></button>
                                                                <?php } ?>

                                                                <a class="btn btn-xs btn-success btn-sm" href="<?php echo base_url(); ?>index.php/Orders/feedback/<?php echo $obj['id']; ?>">
                                                                    <i style="color:#fff;" class="fa fa-comments"></i>
                                                                </a>

                                                                <?php if ($role_id != 2) { ?>

                                                                    <?php if (($obj['projectstatus'] == 'Delivered') ||  ($obj['projectstatus'] == 'Feedback Delivered') || ($obj['projectstatus'] == 'Draft Delivered')) { ?>
                                                                        <a class="btn btn-xs btn-success btn-sm" href="<?php echo base_url(); ?>index.php/Orders/UploadOrder/<?php echo $obj['id']; ?>">
                                                                            <i style="color:#fff;" class="fa fa-check"></i>
                                                                        </a>
                                                                    <?php }
                                                                    ?>

                                                                    <a class="btn btn-xs  btn-secondary btn-sm m-1" href="<?php echo base_url(); ?>index.php/Orders/callstatus/<?php echo $obj['id']; ?>">
                                                                        <i style="color:#fff;" class="fa fa-phone"></i>
                                                                    </a>

                                                                    <a class="btn btn-xs btn-success btn-sm" href="<?php echo base_url(); ?>index.php/Orders/EditOrderFile/<?php echo $obj['id']; ?>">
                                                                        <i style="color:#fff;" class="fa fa-upload"></i>
                                                                    </a>

                                                                    <?php if ($role_id != 1) { ?>
                                                                        <a style="color:#fff;" class="btn btn-xs btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#duplicate<?php echo $obj['id']; ?>">
                                                                            <i class="fa fa-first-order" aria-hidden="true"></i>
                                                                        </a>

                                                                        <!-- Duplicate row modal -->
                                                                        <div class="modal fade" id="duplicate<?php echo $obj['id']; ?>" role="dialog">
                                                                            <div class="modal-dialog">
                                                                                <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Orders/duplicate/<?php echo $obj['id']; ?>">
                                                                                    <!-- Modal content-->
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h4 class="modal-title">Confirm Header </h4>
                                                                                            <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <p>Are you sure, you want to create duplicate Order ? </p>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="submit" class="btn btn-primary ">Submit</button>
                                                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    <?php } ?>

                                                                    <?php if ($role_id == 1) { ?>
                                                                        <a class="btn btn-xs btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete<?php echo $obj['id']; ?>">
                                                                            <i style="color:#fff;" class="fa fa-trash"></i>
                                                                        </a>
                                                                    <?php } ?>

                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- / More Buttons Modal -->

                                            </td>
                                            <!-- / Action Buttons -->

                                            <!-- Modal -->
                                            <div class="modal fade" id="download<?php echo $obj['id']; ?>" role="dialog" tabindex="-1" aria-labelledby="classInfo" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title"><?php echo $obj['order_id']; ?> Details </h4>
                                                            <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-2 col-sm-2 ">
                                                                    <label class="control-label"> # </label>
                                                                </div>
                                                                <div class="col-md-6 col-sm-6 ">
                                                                    <label class="control-label"> Name</label>
                                                                </div>
                                                                <div class="col-md-2 col-sm-2 ">
                                                                    <label class="control-label"> Date time </label>
                                                                </div>
                                                                <div class="col-md-2 col-sm-2 ">
                                                                    <label class="control-label"> Action </label>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <?php
                                                            if (!empty($obj['completed_orders'])) {
                                                                $k = 1;
                                                                foreach ($obj['completed_orders'] as  $file_details) { ?>
                                                                    <div class="row">
                                                                        <div class="col-md-2 col-sm-2 ">
                                                                            <label class="control-label"> <?= $k ?></label>
                                                                        </div>
                                                                        <div class="col-md-6 col-sm-6">
                                                                            <?php $name = explode('/', $file_details['file_path']);
                                                                            echo $name[5]; ?>
                                                                        </div>
                                                                        <div class="col-md-2 col-sm-2 ">
                                                                            <?= date("d-m-Y H:i:s", strtotime($file_details['updated_on'])) ?>
                                                                        </div>
                                                                        <div class="col-md-2 col-sm-2 ">
                                                                            <label class="control-label"> <a href="<?php echo base_url() . '/uploads/' . $file_details['file_path']; ?>" download="download"> <i class="fa fa-download"></i></a></label>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                            <?php $k++;
                                                                }
                                                            } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- / Modal -->
                                            <!-- Modal -->
                                            <div class="modal fade" id="view<?php echo $obj['id']; ?>" role="dialog" tabindex="-1" aria-labelledby="classInfo" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title"><?php echo $obj['order_id']; ?> Details </h4>
                                                            <button type="button" class="close btn" data-bs-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <fieldset class="scheduler-border">
                                                                        <legend class="scheduler-border"> Customer Details <?= $obj['c_name'] ?></legend>
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Customer Name :</label>
                                                                                <span> <?php echo $obj['c_name']; ?></span>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Email :</label>
                                                                                <span> <?php echo $obj['c_email']; ?></span>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Mobile :</label>
                                                                                <span> <?php echo '+' . $obj['countrycode'] . ' - ' . $obj['c_mobile']; ?></span>
                                                                            </div>
                                                                        </div>
                                                                    </fieldset>
                                                                    <fieldset class="scheduler-border">
                                                                        <legend class="scheduler-border"> Order Details</legend>
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Order Type :</label>
                                                                                <span> <?php echo $obj['order_type']; ?></span>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Project Title:</label>
                                                                                <span> <?php echo $obj['title']; ?></span>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Order Id :</label>
                                                                                <span> <?php echo $obj['order_id']; ?></span>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Order Date :</label>
                                                                                <span> <?php echo date('d-M-Y', strtotime($obj['order_date'])); ?></span>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Delivery Date :</label>
                                                                                <span> <?php echo date('d-M-Y', strtotime($obj['delivery_date'])); ?></span>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Type Of Service :</label>
                                                                                <span> <?php echo $obj['services']; ?></span>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Formatting:</label>
                                                                                <span> <?php echo $obj['formatting']; ?></span>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Type Of Paper:</label>
                                                                                <span> <?php echo $obj['typeofpaper']; ?></span>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Type Of Writting:</label>
                                                                                <span> <?php echo $obj['typeofwritting']; ?></span>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Pages:</label>
                                                                                <span> <?php echo $obj['pages']; ?></span>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Deadline:</label>
                                                                                <span> <?php echo $obj['deadline']; ?> Day</span>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Discount % :</label>
                                                                                <span> <?php echo $obj['discount_per']; ?> %</span>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Final Amount:</label>
                                                                                <span> <?php echo $obj['amount']; ?> &#163;</span>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Paid Amount:</label>
                                                                                <span> <?php echo $obj['received_amount']; ?> &#163;</span>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Due Amount:</label>
                                                                                <span>
                                                                                    <?php
                                                                                    if (!isset($obj['amount']) && empty($obj['amount'])) {
                                                                                        $obj['amount'] = 0;
                                                                                    }
                                                                                    echo (int)$obj['amount'] - (int)$obj['received_amount'];
                                                                                    ?>
                                                                                    &#163;
                                                                                </span>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Payment Status:</label>
                                                                                <span> <?php echo $obj['paymentstatus']; ?></span>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Project Status:</label>
                                                                                <span> <?php echo $obj['projectstatus']; ?></span>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Message:</label>
                                                                                <span> <?php echo $obj['message']; ?></span>
                                                                            </div>
                                                                        </div>
                                                                    </fieldset>
                                                                </div>
                                                            </div>
                                                            <fieldset class="scheduler-border">
                                                                <legend class="scheduler-border"> Documents Details</legend>
                                                                <?php
                                                                if (!empty($obj['order_file_details'])) {
                                                                    $j = 1;
                                                                    foreach ($obj['order_file_details'] as  $file_details) {  ?>
                                                                        <div class="row">
                                                                            <div class="col-md-4">
                                                                                <label><?= $j ?></label>
                                                                            </div>
                                                                            <div class="col-md-8">
                                                                                <label class="control-label">Uploaded File :</label>
                                                                                <div style="height: 10%;width: 100%;">
                                                                                    <a href="<?php echo $file_details['file']; ?>" target="_blank">
                                                                                        <?php
                                                                                        $name = explode('/', $file_details['file']);

                                                                                        if ($obj['order_type'] == "Website") {
                                                                                            echo $name[4];
                                                                                        } else {
                                                                                            echo $name[5];
                                                                                        }
                                                                                        ?>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <hr>
                                                                <?php $j++;
                                                                    }
                                                                } ?>
                                                            </fieldset>
                                                            <?php if ($obj['projectstatus'] == 'Completed') { ?>
                                                                <fieldset class="scheduler-border">
                                                                    <legend class="scheduler-border"> Completed Assignment File </legend>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="col-md-4 col-sm-4">
                                                                                <label> Uploaded File from Assignmentinneed.com </label>
                                                                            </div>
                                                                            <div class="col-md-8 col-sm-8 ">
                                                                                <label class="control-label"> File :</label>
                                                                                <div style="height: 10%;width: 100%;">
                                                                                    <a href="<?php echo base_url() . '/uploads/' . $obj['assignment_file']; ?>" target="_blank"> <?= $obj['assignment_file'] ?></a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                </fieldset>
                                                            <?php } ?>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- / Modal -->
                                            <div class="modal fade" id="delete<?php echo $obj['id']; ?>" role="dialog">
                                                <div class="modal-dialog">
                                                    <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Orders/deleteorder/<?php echo $obj['id']; ?>">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title"> Delete Order </h4>
                                                                <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Are you sure, you want to delete Order <b><?php echo $obj['order_id']; ?> </b>? </p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-primary ">Submit</button>
                                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <!-- / Modal -->
                                            <!-- Modal -->
                                            <div class="modal fade" id="approve<?php echo $obj['id']; ?>" role="dialog">
                                                <div class="modal-dialog">
                                                    <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Orders/ActionOrder" enctype="multipart/form-data">
                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color: #168c56;color: azure;">
                                                                <h4 class="modal-title"> Complete Order </h4>
                                                                <button type="button" class="close" data-bs-dismiss="modal" style="color: azure;">&times;</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Are you sure, you want to <b style="color:#168c56;"> Complete </b>this Order <b><?php echo $obj['order_id']; ?> </b>? </p>
                                                                <input type="hidden" name="user_id" value="<?php echo $obj['uid']; ?>">
                                                                <input type="hidden" name="order_id" value="<?php echo $obj['id']; ?>">
                                                                <input type="hidden" name="status" value="Completed">
                                                                <input type="hidden" name="approved_date" value="<?= date('Y-m-d') ?>">
                                                                <div class="form-group">
                                                                    <div class="row col-md-12">
                                                                        <label class="control-label"> Comment </label>
                                                                        <textarea class="form-control Comment" rows="2" placeholder="Enter comment here" name="completed_comment"></textarea>
                                                                    </div>
                                                                    <div class="row col-md-12">
                                                                        <label class="control-label"> Upload Assignment </label>
                                                                        <input type="file" name="assignment_file[]" multiple="multiple" class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-success modal_approve_button" style="background-color: #168c56;">Submit</button>
                                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <!-- / Modal -->
                                        </tr>
                                    <?php $i++;
                                    } ?>
                                </tbody>
                            </table>
                            <?php if ($role_id == 1 || $role_id == 2) { ?>
                                <?php if (empty($from_date)) { ?>
                                    <div class="pagination">
                                        <?php echo $links; ?> </p>
                                    </div>
                                <?php } ?>
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
<!-- ============================================================== -->
<!-- End Container fluid  -->

<?php foreach ($orders as $order) { ?>
    <!-- Payment Details Model -->
    <div class="modal fade bd-example-modal-xl" id="paymentModal<?= $order['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">
                        <a href="<?php echo base_url(); ?>index.php/Orders/payments/<?php echo $order['id']; ?>" target="_blank">
                            <i class="fa fa-external-link"></i>
                        </a>
                        Payment Details <span style="color:lightsalmon"> Order ID : <?= $order['order_id'] ?> </span>
                    </h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <!-- <th>Sr.No.</th> -->
                                        <th> Payment Date</th>
                                        <th> Amount </th>
                                        <th> References </th>
                                        <th> Status </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($order['payment_details'])) {
                                        $i = 1;
                                        foreach ($order['payment_details'] as $obj) { ?>
                                            <tr>
                                                <!-- <td> <?= $i ?></td> -->
                                                <td><?php echo $obj['payment_date']; ?></td>
                                                <td><?php echo $obj['paid_amount']; ?></td>
                                                <td>
                                                    <?php echo $obj['reference']; ?>
                                                    <input type="hidden" class="row_id" value="<?php echo $obj['id']; ?>">
                                                    <input type="hidden" class="row_paid_amount" value="<?php echo $obj['paid_amount']; ?>">
                                                    <input type="hidden" class="row_order_row_id" value="<?= $obj['order_id'] ?>">
                                                </td>
                                                <td>
                                                    <?php if ($obj['account_status'] == 1) {
                                                        echo "Verified";
                                                    } else {
                                                        echo "Not Verified";
                                                    } ?>
                                                </td>
                                            </tr>

                                    <?php $i++;
                                        }
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <hr>
                        <h3> Make New Payment Here </h3>
                        <span style="color:lightsalmon">
                            Order Amount : <?php echo $order['amount']; ?>
                        </span>
                        <hr>

                        <?php
                        $amt   = $order['amount'];
                        $r_amt = $order['received_amount'];
                        if (isset($order['received_amount']) && !empty($order['received_amount']) && isset($order['amount']) && !empty($order['amount'])) {
                            $r_a_new = (float)$amt - (float)$r_amt;
                        } else {
                            $r_a_new = '0';
                        }
                        $remaining_amount_old = $r_a_new;
                        ?>

                        <form class="form-horizontal" id="myForm" role="form" method="post" action="<?php echo base_url(); ?>index.php/Orders/addPayment" enctype="multipart/form-data">
                            <input type="hidden" name="from_order_list" value="1">
                            <input type="hidden" class="order_row_id" name="order_row_id" value="<?= $order['id'] ?>">
                            <input type="hidden" class="order_total" name="order_total" value="<?= $order['amount'] ?>">
                            <input type="hidden" class="received_amount" name="received_amount" value="<?= $order['received_amount'] ?>">
                            <input type="hidden" class="current_page" name="current_page" value="<?= $current_page ?>">
                            <input type="hidden" class="remaining_amount_old" name="remaining_amount_old" value="<?php echo $remaining_amount_old; ?>">
                            <input type="hidden" name="backurl" value="<?= $current_page ?>">

                            <div class="row d-flex">
                                <div class="col-md-4">
                                    <?php if ($role_id == 1) { ?>
                                        <label class="control-label"> Payment Date </label>
                                        <input type="text" name="payment_date" value="<?php echo date('l d F Y h:i A'); ?>" class="form-control min-date" required>
                                    <?php } else { ?>
                                        <label class="control-label"> Payment Date </label>
                                        <input type="text" name="payment_date" value="<?php echo date('l d F Y h:i A'); ?>" class="form-control min-date" readonly>
                                    <?php } ?>
                                </div>
                                <div class="col-md-4">
                                    <label> Paid Amount :</label>
                                    <input type="text" placeholder="Enter Paid Amount" name="paid_amount" class="form-control paid_amount" required="required">
                                </div>
                                <div class="col-md-4">
                                    <label> Remaining Amount :</label>
                                    <input type="text" placeholder="Remaining Amount" name="remaining_amount" class="form-control remaining_amount" value="<?php echo (float)($remaining_amount_old); ?>" readonly="readonly">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <label> Payment Reference :</label>
                                    <textarea type="text" placeholder="Enter reference here" name="reference" class="form-control " value="" rows="3" required></textarea>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-block"> Submit Payment</button>
                                </div>
                            </div>
                        </form>

                    </div>
                    <!-- card-body -->
                </div>
                <!-- modal-body -->
            </div>
        </div>
    </div>
    <!-- / Payment Details Model -->

    <!-- Update Order Model -->
    <div class="modal fade bd-example-modal-xl" id="editModal<?= $order['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">
                        <a href="<?php echo base_url(); ?>index.php/Orders/edit/<?php echo $order['order_id']; ?>" target="_blank">
                            <i class="fa fa-external-link"></i>
                        </a>
                        Update Order <span style="color:lightsalmon"> Order ID : <?= $order['order_id'] ?> </span>
                    </h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">

                        <form class="floating-labels m-t-40" role="form" method="post" action="<?php echo base_url(); ?>index.php/Orders/editorder/<?= $order['id'] ?>" enctype="multipart/form-data">

                            <?php if ($role_id != '2') { ?>
                                <?php if (@$referal == 'No') { ?>
                                    <!-- blank -->
                                <?php } ?>
                            <?php } else { ?>
                                <input type="hidden" name="referal" value="<?= @$referal ?>">
                            <?php } ?>

                            <input type="hidden" name="backurl" value="<?= $current_page ?>">
                            <input type="hidden" name="edit_id" value="<?= $order['id'] ?>">
                            <input type="text" style="display:none;" name="order_id" class="form-control" value="<?= $order['order_id'] ?>" autofocus readonly="readonly">
                            <input type="text" style="display:none;" name="order_type" value="Back-End">

                            <div class="row">

                                <!-- Select Customer -->
                                <?php if ($role_id != '2') {  ?>
                                    <?php if ($role_id == '1') {  ?>
                                        <div class="col-lg-4">
                                            <div class="form-group has-warning m-b-40">
                                                <?php echo form_dropdown('user_id', $users, $order['uid'], '', 'required="required"') ?>
                                                <span class="bar"></span>
                                                <label for="input10">Select customer</label>
                                            </div>
                                        </div>
                                    <?php } else { ?>
                                        <div class="col-lg-4">
                                            <div class="form-group has-warning m-b-40">
                                                <input type="text" value="<?php if (isset($order['c_name']) && !empty($order['c_name'])) {
                                                                                echo $order['c_name'];
                                                                            } ?>" class="form-control" id="input10" readonly>
                                                <span class="bar"></span>
                                                <label for="input10">Select customer</label>
                                            </div>
                                        </div>
                                    <?php } ?>
                                <?php } else { ?>
                                    <input type="text" style="display:none;" name="user_id" value="<?= @$order['uid'] ?>">
                                <?php } ?>
                                <!-- Select Customer -->

                                <!-- Project Title -->
                                <div class="col-lg-4">
                                    <div class="form-group has-warning m-b-40">
                                        <input type="text" class="form-control" name="title" value="<?= $order['title'] ?>" required="required">
                                        <span class="bar"></span>
                                        <label for="input10">Project title</label>
                                    </div>
                                </div>
                                <!-- / Project Title -->

                                <!-- Select pages -->
                                <div class="col-lg-4">
                                    <div class="form-group has-warning m-b-40">
                                        <input type="text" class="form-control pages" name="pages" value="<?= $order['pages'] ?>" required="required">
                                        <span class="bar"></span>
                                        <label for="input10">Select pages</label>
                                    </div>
                                </div>
                                <!-- / Select pages -->

                                <!-- Order total -->
                                <div class="col-lg-4" hidden>
                                    <div class="form-group has-warning">
                                        <input type="text" name="actualorder" class="actualorder form-control" id="input10" value="<?php echo $order['amount']; ?>">
                                        <span class="bar"></span>
                                        <strike class="actualorder" style="font-size: 22px;color:red;"></strike>
                                    </div>
                                </div>
                                <!-- / Order total -->

                                <!-- Price -->
                                <div class="col-lg-4">
                                    <div class="form-group has-warning">
                                        <?php if ($role_id != '2') {  ?>
                                            <input type="text" name="order_total" class="form-control order_total" value="<?php echo $order['amount']; ?>" required>
                                        <?php } else { ?>
                                            <input type="hidden" name="order_total" class="order_total" value="<?php echo $order['amount']; ?>">
                                        <?php } ?>
                                        <span class="bar"></span>
                                        <label for="input10">Price </label>
                                    </div>
                                </div>
                                <!-- / Price -->

                                <!-- Delivery Date Time -->
                                <div class="col-lg-4" style="display: flex;">
                                    <div class="col-6">
                                        <div class="form-group has-warning m-b-40">
                                            <input type="text" class="form-control second delivery_date mdate" name="delivery_date" value="<?php echo  date("Y-m-d", strtotime($order['delivery_date'])); ?>">
                                            <span class="bar"></span>
                                            <label for="input10">Delivery date</label>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <!-- blank -->
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group has-warning m-b-40">
                                            <input type="text" class="form-control timepicker" name="delivery_time" value="<?php if (isset($order['delivery_time']) && !empty($order['delivery_time'])) {
                                                                                                                                echo $order['delivery_time'];
                                                                                                                            } ?>">
                                            <span class="bar"></span>
                                            <label for="input10">Time</label>
                                        </div>
                                    </div>
                                </div>
                                <!-- / Delivery Date Time -->

                                <!-- Writer name -->
                                <div class="col-lg-4">
                                    <div class="form-group has-warning m-b-40">
                                        <?php if ($role_id != '3') { ?>
                                            <?php if ($order['projectstatus'] == 'In Progress') { ?>
                                                <select name="writer_name" class="form-control" required>
                                                    <option value=""></option>
                                                    <?php
                                                    $teams = getWriterTeams();
                                                    foreach ($teams as $team) {
                                                    ?>
                                                        <option <?php if (@$order['writer_name'] == $team) {
                                                                    echo "selected";
                                                                } ?> value="<?= $team ?>">
                                                            <?= $team ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                                <span class="bar"></span>
                                                <label for="input10">Writer name (Select team)</label>
                                            <?php } else { ?>
                                                <select name="writer_name" class="form-control">
                                                    <option value=""></option>
                                                    <?php
                                                    $teams = getWriterTeams();
                                                    foreach ($teams as $team) {
                                                    ?>
                                                        <option <?php if (@$order['writer_name'] == $team) {
                                                                    echo "selected";
                                                                } ?> value="<?= $team ?>">
                                                            <?= $team ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                                <span class="bar"></span>
                                                <label for="input10">Writer name (Select team)</label>
                                            <?php } ?>

                                        <?php } else { ?>
                                            <input type="hidden" name="writer_name" id="input10" class="form-control writer_name" value="<?= @$order['writer_name'] ?>" />
                                        <?php } ?>
                                    </div>
                                </div>
                                <!-- / Writer name -->

                                <!-- Writer price -->
                                <div class="col-lg-4" style="display: none;">
                                    <div class="form-group has-warning m-b-40">
                                        <?php if ($role_id != '3') { ?>
                                            <input type="text" name="writer_price" class="form-control writer_price" value="<?= @$order['writer_price'] ?>" oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" />
                                        <?php } else { ?>
                                            <input type="hidden" name="writer_price" class="form-control writer_price" value="<?= @$order['writer_price'] ?>" oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" />
                                        <?php } ?>
                                        <span class="bar"></span>
                                        <label for="input10">Writer price</label>
                                    </div>
                                </div>
                                <!-- / Writer price -->

                                <!-- Writer deadline -->
                                <div class="col-lg-4 writer_deadline">
                                    <div class="form-group has-warning m-b-40">
                                        <?php if (!empty($order['writer_deadline'])) {
                                            if (@$order['writer_deadline'] != '1970-01-01') {
                                                $writer_deadlinenew = date("Y-m-d", strtotime(@$order['writer_deadline']));
                                            } else {
                                                $writer_deadlinenew = date("Y-m-d");
                                            }
                                        } else {
                                            $writer_deadlinenew = date("Y-m-d");
                                        } ?>

                                        <input type="text" class="form-control mdate" name="writer_deadline" value="<?php if (isset($writer_deadlinenew) && !empty($writer_deadlinenew)) {
                                                                                                                        echo $writer_deadlinenew;
                                                                                                                    } ?>">
                                        <span class="bar"></span>
                                        <label for="input10">Writer deadline</label>
                                    </div>
                                </div>
                                <!-- / Writer deadline -->

                                <!-- College Name -->
                                <div class="col-lg-4">
                                    <div class="form-group has-warning m-b-40">
                                        <input type="text" class="form-control" id="input10" name="college_name" value="<?= @$order['college_name'] ?>">
                                        <span class="bar"></span>
                                        <label for="input10">College name</label>
                                    </div>
                                </div>
                                <!-- / College Name -->

                                <!-- Order Date -->
                                <div class="col-lg-4">
                                    <div class="form-group has-warning m-b-40">
                                        <input type="text" class="form-control first mdate" name="order_date" value="<?php echo date('Y-m-d', strtotime($order['order_date'])); ?>">
                                        <span class="bar"></span>
                                        <label for="input10">Order date</label>
                                    </div>
                                </div>
                                <!-- / Order Date -->

                                <!-- Formatting & Citation Style -->
                                <div class="col-lg-4">
                                    <div class="form-group has-warning m-b-40">
                                        <select class="form-control " name="formatting">
                                            <option value=""></option>
                                            <?php
                                            foreach ($formattings as $key => $value) {
                                                if ($order['formatting'] == $value['formatting_name']) {
                                            ?>
                                                    <option value="<?= $value['formatting_name'] ?>" selected><?= $value['formatting_name'] ?></option>
                                                <?php } else { ?>
                                                    <option value="<?= $value['formatting_name'] ?>"><?= $value['formatting_name'] ?></option>

                                            <?php  }
                                            } ?>
                                        </select>
                                        <span class="bar"></span>
                                        <label for="input10">Formatting style</label>
                                    </div>
                                </div>
                                <!-- / Formatting & Citation Style -->

                                <!-- Choose type of service -->
                                <div class="col-lg-4">
                                    <div class="form-group has-warning m-b-40">
                                        <select class="form-control typeofservice" name="typeofservice">
                                            <option value=""></option>
                                            <?php
                                            foreach ($services as $key => $value) {
                                                if ($order['services'] == $value['service_name']) {
                                            ?>
                                                    <option value="<?= $value['service_name'] ?>" typservice="<?= $value['factor'] ?>" selected><?= $value['service_name'] ?> </option>
                                                <?php } else { ?>
                                                    <option value="<?= $value['service_name'] ?>" typservice="<?= $value['factor'] ?>"><?= $value['service_name'] ?></option>
                                            <?php  }
                                            } ?>
                                        </select>
                                        <span class="bar"></span>
                                        <label for="input10">Choose type of service</label>
                                    </div>
                                </div>
                                <!-- / Choose type of service -->

                                <!-- Choose type of paper -->
                                <div class="col-lg-4">
                                    <div class="form-group has-warning m-b-40">
                                        <select class="form-control typeofpaper" name="typeofpaper">
                                            <option value=""></option>
                                            <?php
                                            foreach ($typeofpapers as $key => $value) {
                                                if ($order['typeofpaper'] == $value['paper_type']) {
                                            ?>
                                                    <option value="<?= $value['paper_type'] ?>" selected typpaper="<?= $value['factor'] ?>"><?= $value['paper_type'] ?></option>
                                                <?php } else { ?>
                                                    <option value="<?= $value['paper_type'] ?>" typpaper="<?= $value['factor'] ?>"><?= $value['paper_type'] ?></option>
                                            <?php  }
                                            } ?>
                                        </select>
                                        <span class="bar"></span>
                                        <label for="input10">Choose type of paper</label>
                                    </div>
                                </div>
                                <!-- / Choose type of paper -->

                                <!-- Choose type of writing -->
                                <div class="col-lg-4">
                                    <div class="form-group has-warning m-b-40">
                                        <select class="form-control typeofwritting" name="typeofwritting">
                                            <option value=""></option>
                                            <?php
                                            foreach ($typeofwritings as $key => $value) {
                                                if ($order['typeofwritting'] == $value['type_of_writing']) {
                                            ?>
                                                    <option value="<?= $value['type_of_writing'] ?>" selected typwrtg="<?= $value['factor'] ?>"><?= $value['type_of_writing'] ?></option>
                                                <?php } else { ?>
                                                    <option value="<?= $value['type_of_writing'] ?>" typwrtg="<?= $value['factor'] ?>"><?= $value['type_of_writing'] ?></option>
                                            <?php  }
                                            } ?>
                                        </select>
                                        <span class="bar"></span>
                                        <label for="input10">Choose type of writing</label>
                                    </div>
                                </div>
                                <!-- / Choose type of writing -->

                                <!-- Project status -->
                                <?php $projectstatus = $order['projectstatus']; ?>
                                <?php if ($role_id != 1) { ?>
                                    <?php if ($projectstatus != 'Cancelled') { ?>
                                        <!-- Order status -->
                                        <div class="col-lg-4">
                                            <div class="form-group has-warning m-b-40">
                                                <select class="form-control pages" name="projectstatus" required>

                                                    <option value="Pending" <?php if ($projectstatus == 'Pending') {
                                                                                echo "selected";
                                                                            } ?>>Pending</option>
                                                    <option value="In Progress" <?php if ($projectstatus == 'In Progress') {
                                                                                    echo "selected";
                                                                                } ?>>In Progress</option>
                                                    <option value="Completed" <?php if ($projectstatus == 'Completed') {
                                                                                    echo "selected";
                                                                                } ?>>Completed</option>
                                                    <option value="Delivered" <?php if ($projectstatus == 'Delivered') {
                                                                                    echo "selected";
                                                                                } ?>>Delivered</option>
                                                    <option value="Feedback" <?php if ($projectstatus == 'Feedback') {
                                                                                    echo "selected";
                                                                                } ?>>Feedback</option>
                                                    <option value="Feedback Delivered" <?php if ($projectstatus == 'Feedback Delivered') {
                                                                                            echo "selected";
                                                                                        } ?>>Feedback Delivered</option>
                                                    <option value="Cancelled" <?php if ($projectstatus == 'Cancelled') {
                                                                                    echo "selected";
                                                                                } ?>>Cancelled</option>
                                                    <option value="Draft Ready" <?php if ($projectstatus == 'Draft Ready') {
                                                                                    echo "selected";
                                                                                } ?>>Draft Ready</option>
                                                    <option value="Draft Delivered" <?php if ($projectstatus == 'Draft Delivered') {
                                                                                        echo "selected";
                                                                                    } ?>>Draft Delivered</option>
                                                    <option value="Other" <?php if ($projectstatus == 'Other') {
                                                                                echo "selected";
                                                                            } ?>>Other</option>
                                                    <option value="initiated" <?php if ($projectstatus == 'initiated') {
                                                                                    echo "selected";
                                                                                } ?>>initiated</option>
                                                </select>
                                                <span class="bar"></span>
                                                <label for="input10">Order status</label>
                                            </div>
                                        </div>
                                    <?php } ?>
                                <?php } else { ?>
                                    <!-- Order status -->
                                    <div class="col-lg-4">
                                        <div class="form-group has-warning m-b-40">
                                            <select class="form-control pages" name="projectstatus" required>

                                                <option value="Pending" <?php if ($projectstatus == 'Pending') {
                                                                            echo "selected";
                                                                        } ?>>Pending</option>
                                                <option value="In Progress" <?php if ($projectstatus == 'In Progress') {
                                                                                echo "selected";
                                                                            } ?>>In Progress</option>
                                                <option value="Completed" <?php if ($projectstatus == 'Completed') {
                                                                                echo "selected";
                                                                            } ?>>Completed</option>
                                                <option value="Delivered" <?php if ($projectstatus == 'Delivered') {
                                                                                echo "selected";
                                                                            } ?>>Delivered</option>
                                                <option value="Feedback" <?php if ($projectstatus == 'Feedback') {
                                                                                echo "selected";
                                                                            } ?>>Feedback</option>
                                                <option value="Feedback Delivered" <?php if ($projectstatus == 'Feedback Delivered') {
                                                                                        echo "selected";
                                                                                    } ?>>Feedback Delivered</option>
                                                <option value="Cancelled" <?php if ($projectstatus == 'Cancelled') {
                                                                                echo "selected";
                                                                            } ?>>Cancelled</option>
                                                <option value="Draft Ready" <?php if ($projectstatus == 'Draft Ready') {
                                                                                echo "selected";
                                                                            } ?>>Draft Ready</option>
                                                <option value="Draft Delivered" <?php if ($projectstatus == 'Draft Delivered') {
                                                                                    echo "selected";
                                                                                } ?>>Draft Delivered</option>
                                                <option value="Other" <?php if ($projectstatus == 'Other') {
                                                                            echo "selected";
                                                                        } ?>>Other</option>
                                                <option value="initiated" <?php if ($projectstatus == 'initiated') {
                                                                                echo "selected";
                                                                            } ?>>initiated</option>
                                            </select>
                                            <span class="bar"></span>
                                            <label for="input10">Order status</label>
                                        </div>
                                    </div>
                                <?php } ?>
                                <!-- / Project status -->

                                <!-- Payment status -->
                                <?php $paymentstatus = $order['paymentstatus']; ?>
                                <div class="col-lg-4">
                                    <div class="form-group has-warning m-b-40">
                                        <select class="form-control" name="paymentstatus" required>
                                            <option value="Pending" <?php if ($paymentstatus == 'Pending') {
                                                                        echo "selected";
                                                                    } ?>>Pending</option>

                                            <option value="Completed" <?php if ($paymentstatus == 'Completed') {
                                                                            echo "selected";
                                                                        } ?>>Completed</option>
                                        </select>
                                        <span class="bar"></span>
                                        <label for="input10">Payment status</label>
                                    </div>
                                </div>
                                <!-- / Payment status -->
                            </div>
                            <!-- row -->

                            <!-- Enter message -->
                            <div class="col-lg-12">
                                <div class="form-group has-warning m-b-40">
                                    <textarea type="text" name="message" class="form-control" rows="3" value="" autofocus autocomplete="off" style="resize: none;"><?= $order['message'] ?></textarea>
                                    <span class="bar"></span>
                                    <label for="input10">Enter message</label>
                                </div>
                            </div>
                            <!-- Enter message -->


                            <!-- Upload Files -->
                            <div class="col-lg-12" style="display: none;">
                                <div class="form-group has-warning m-b-40">
                                    <fieldset>
                                        <legend> <b>Upload Files </b></legend>
                                        <div class="table-responsive">
                                            <table id="maintable" class="table">
                                                <thead style="background-color: #355fa9;color: #ffffff;">
                                                    <tr>
                                                        <th style="width:5%;">S.No.</th>
                                                        <th style="width:90%;"> Upload File</th>
                                                        <th style="width:5%;"> Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="mainbody">
                                                    <!-- js -->
                                                </tbody>
                                            </table>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>

                            <div class="row">
                                <button type="submit" class="btn btn-primary btn-block">Update</button>
                            </div>

                        </form>
                        <!-- form -->
                    </div>
                    <!-- card-body -->
                </div>
                <!-- modal-body -->
            </div>
        </div>
    </div>
    <!-- / Update Order Model -->
<?php } ?>

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