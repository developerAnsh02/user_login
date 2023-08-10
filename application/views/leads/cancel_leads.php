<?php
defined('BASEPATH') or exit('No direct script access allowed');
$base                = base_url();
$hyperlink_ordes     = $base . 'index.php/Orders/index';
$hyperlink_customers = $base . 'index.php/Employees/index';
$role_id             = $this->session->userdata['logged_in']['role_id'];
$user_id             = $this->session->userdata['logged_in']['id'];
$currentURL          = current_url();
$data = explode('?', $currentURL);
?>

<style>
    .inputField {
        width: 150px !important;
    }

    .form-control {
        border: 0px solid #e9ecef !important;
        font-size: 1rem !important;
    }

    pre {
        font-size: 140%;
    }

    .page-titles {
        margin: 0px;
    }

    .card-body {
        padding: 0px;
    }
</style>

<style>
    @media only screen and (max-width: 600px) {
        .mobile-display {
            width: 100% !important;
        }

        .mobile-display_list {
            width: 90% !important;
        }
    }

    .left-section {
        width: calc(30% - 1px);
        float: left;
        height: 500px;
        border-right: 1px solid #E6E6E6;
        background-color: #FFF;
        z-index: 1;
        position: relative;
    }

    .left-section ul {
        padding: 0px;
        margin: 0px;
        list-style: none;
    }

    .left-section ul li {
        padding: 15px 0px;
        cursor: pointer;
    }

    .left-section ul li.active {
        background: #009EF7;
        color: #fff;
        position: relative;
    }

    .mCustomScrollBox,
    .mCSB_container {
        overflow: unset !important;
    }

    .left-section ul li.active .desc .time {
        color: #fff;
    }

    .left-section ul li.active:before {
        position: absolute;
        content: '';
        right: -10px;
        border: 5px solid #009EF7;
        top: 0px;
        bottom: 0px;
        border-radius: 0px 3px 3px 0px;
    }

    .left-section ul li.active:after {
        position: absolute;
        content: "";
        bottom: 0px;
        right: 0px;
        left: auto;
        width: 100%;
        top: 0px;
        -webkit-box-shadow: -8px 4px 10px #a1a1a1;
        -moz-box-shadow: -8px 4px 10px #a1a1a1;
        box-shadow: -8px 4px 10px #a1a1a1;
    }

    .left-section .chatList {
        overflow: hidden;
    }

    .left-section .chatList .img {
        width: 60px;
        float: left;
        text-align: center;
        position: relative;
    }

    .left-section .chatList .img img {
        width: 30px;
        border-radius: 50%;
    }

    .left-section .chatList .img i {
        position: absolute;
        font-size: 10px;
        color: #52E2A7;
        border: 1px solid #fff;
        border-radius: 50%;
        left: 10px;
    }

    .left-section .chatList .desc {
        width: calc(100% - 60px);
        float: left;
        position: relative;
    }

    .left-section .chatList .desc h5 {
        margin-top: 6px;
        line-height: 5px;
    }

    .left-section .chatList .desc .time {
        position: absolute;
        right: 15px;
        color: #c1c1c1;
    }

    .right-section {
        width: 70%;
        float: left;
        height: 500px;
        background-color: #F6F6F6;
        position: relative;
    }

    .message {
        height: calc(100% - 68px);
        font-family: sans-serif;
    }

    .message ul {
        padding: 0px;
        list-style: none;
        margin: 0px auto;
        width: 100%;
        overflow: hidden;
    }

    .message ul li {
        position: relative;
        width: 90%;
        padding: 15px 0px;
        clear: both;
    }

    .message ul li.msg-left {
        float: left;
        text-align: left;
    }

    .message ul li.msg-left img {
        position: absolute;
        width: 40px;
        bottom: 30px;
        text-align: left;
    }

    .message ul li.msg-left .msg-desc {
        margin-left: 70px;
        font-size: 12px;
        background: #E8E8E8;
        padding: 5px 10px;
        border-radius: 5px 5px 5px 0px;
        position: relative;
        text-align: left;
    }

    .message ul li.msg-left .msg-desc:before {
        position: absolute;
        content: '';
        border: 10px solid transparent;
        border-bottom-color: #E8E8E8;
        bottom: 0px;
        left: -10px;
        text-align: left;
    }

    .message ul li.msg-left small {
        float: left;
        color: #c1c1c1;
        margin-left: 70px;
    }

    .message ul li.msg-right {
        float: right;
        text-align: right;
    }

    .message ul li.msg-right img {
        position: absolute;
        width: 40px;
        right: 0px;
        bottom: 30px;
        text-align: right;
    }

    .message ul li.msg-right .msg-desc {
        margin-right: 70px;
        font-size: 12px;
        background: #cce5ff;
        color: #004085;
        padding: 5px 10px;
        border-radius: 5px 5px 5px 0px;
        position: relative;
        text-align: right;
    }

    .message ul li.msg-right .msg-desc:before {
        position: absolute;
        content: '';
        border: 10px solid transparent;
        border-bottom-color: #cce5ff;
        bottom: 0px;
        right: -10px;
        text-align: right;
    }

    .message ul li.msg-right small {
        float: right;
        color: #c1c1c1;
        margin-right: 70px;
    }

    .message ul li.msg-day {
        border-top: 1px solid #EBEBEB;
        width: 100%;
        padding: 0px;
        margin: 15px 0px;
    }

    .message ul li.msg-day small {
        position: absolute;
        top: -10px;
        background: #F6F6F6;
        color: #c1c1c1;
        padding: 3px 10px;
        left: 50%;
        transform: translateX(-50%);
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
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <form method="get" id="filterForm">
                        <div class="row">
                            
                            <div class="col-md-3 col-sm-3">
                                <select name="project_title" id="" class="form-control select2">
                                    <option value="">Select Title</option>
                                    <?php
                                    if (isset($filter) && !empty($filter)) {
                                        foreach ($filter as $lead) { ?>
                                            <option <?php if (isset($lead['project_title']) && !empty($lead['project_title']) && $conditions['project_title'] == $lead['project_title']) {
                                                        echo "selected";
                                                    } ?> value="<?php echo $lead['project_title'] ?>">
                                                <?php echo $lead['project_title'] ?>
                                            </option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-3">
                                <select name="mobile" id="" class="form-control select2">
                                    <option value="">Select Mobile</option>
                                    <?php
                                    if (isset($filter) && !empty($filter)) {
                                        foreach ($filter as $lead) { ?>
                                            <option <?php if ($conditions['mobile'] == $lead['mobile']) {
                                                        echo "selected";
                                                    } ?> value="<?php echo $lead['mobile'] ?>">
                                                <?php echo $lead['mobile'] ?>
                                            </option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-2 col-sm-2">
                                <select name="l_status" id="" class="form-control l_status" style="width: 150px; border: 1px solid #d2d6de !important;">
                                    <option value="">Filter by Status</option>
                                    <option <?php if ($conditions['l_status'] == 'Waiting') {
                                                echo 'selected';
                                            } ?> value="Waiting">Waiting</option>
                                    <option <?php if ($conditions['l_status'] == 'Quote') {
                                                echo 'selected';
                                            } ?> value="Quote">Quote</option>
                                    <option <?php if ($conditions['l_status'] == 'Confirmation') {
                                                echo 'selected';
                                            } ?> value="Confirmation">Confirmation</option>
                                </select>
                            </div>
                            <div class="col-md-2 col-sm-2" style="margin-right:-100px">
                                <input  type="submit" class="btn btn-primary" value="Search" />
                            </div>
                            <div class="col-md-2 col-sm-2">
                                <a href="<?php echo $data[0] ?>" class="btn btn-danger"> Reset</a>
                            </div>
                             <div class="col-md-3 col-sm-3" style="margin-top: 10px;">
                                <select name="order_id" id="" class="form-control select2">
                                    <option value="" selected>Selcet Orders</option>
                                    <?php
                                    if (isset($filter) && !empty($filter)) {
                                        foreach ($orders as $lead) { ?>
                                            <option <?php if (isset($lead['order_id']) && !empty($lead['order_id']) && $conditions['order_id'] == $lead['order_id']) {
                                                        echo "selected";
                                                    } ?> value="<?php echo $lead['order_id'] ?>">
                                                <?php echo $lead['order_id'] ?>
                                            </option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-3" style="margin-top: 10px;" >
                                <input type="text" data-date-formate="dd-mm-yyyy" name="from" class="form-control mdate" value="<?php echo @$from_date; ?>" placeholder="From Date">
                            </div>
                            <div class="col-md-3 col-sm-3" style="margin-top: 10px;">
                                <input type="text" data-date-formate="dd-mm-yyyy" name="to" class="form-control mdate" value="<?php echo @$upto_date; ?>" placeholder="Upto Date">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="demo-foo-addrow" class="table table-bordered m-t-30 table-hover contact-list" data-paging="true" data-paging-size="7">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th><input type="checkbox" class="all_checked" checked></th>
                                    <th>Order ID</th>
                                    <th>Status</th>
                                    <th>Order Date</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Country Code</th>
                                    <th>Mobile</th>
                                    <th>Project Title</th>
                                    <th>Words</th>
                                    <th>Price</th>
                                    <th>Delivery Date</th>
                                    <th>UK Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                if (isset($leads) && !empty($leads)) {
                                    foreach ($leads as $lead) {
                                        $i++;
                                ?>
                                        <form class="floating-labels m-t-40" id="c_form" role="form" method="post" action="<?php echo base_url(); ?>index.php/Leads/convert_lead" enctype="multipart/form-data">
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
                                                    <input type="hidden" class="id" name="id" value="<?php echo $lead['id']; ?>">
                                                    <input type="hidden" class="emp_id" name="emp_id" value="<?php echo $lead['emp_id']; ?>">
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="c_status" id="c_status" class="c_status" <?php if ($lead['c_status'] != 1) {
                                                                                                                                echo "checked value='on'";
                                                                                                                            } else {
                                                                                                                                echo "value='off'";
                                                                                                                            } ?>>
                                                </td>
                                                <td>
                                                    <input type="text" name="order_id" class="form-control order_id inputField" value="<?= $lead['order_id']; ?>" style="width: 100px !important;" readonly>
                                                </td>
                                                <?php
                                                if ($lead['l_status'] == 'Waiting') {
                                                    $color = "#fff647";
                                                } else if ($lead['l_status'] == 'Quote') {
                                                    $color = "#87f3ff";
                                                } else if ($lead['l_status'] == 'Confirmation') {
                                                    $color = "#85ff9d";
                                                } else {
                                                    $color = "#fff";
                                                }
                                                ?>
                                                <td>
                                                    <select name="l_status" id="" class="form-control l_status" style="width: 90px; background-color:<?php echo $color; ?>;">
                                                        <option value=""></option>
                                                        <option <?php if ($lead['l_status'] == 'Waiting') {
                                                                    echo 'selected';
                                                                } ?> value="Waiting">Waiting</option>
                                                        <option <?php if ($lead['l_status'] == 'Quote') {
                                                                    echo 'selected';
                                                                } ?> value="Quote">Quote</option>
                                                        <option <?php if ($lead['l_status'] == 'Confirmation') {
                                                                    echo 'selected';
                                                                } ?> value="Confirmation">Confirmation</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" name="create_at" value="<?php echo date("Y-m-d", strtotime($lead['create_at'])); ?>" class="inputField create_at mdate form-control" style="width: 120px !important;">
                                                </td>
                                                <td>
                                                    <input type="text" name="user_name" value="<?php echo $lead['user_name']; ?>" class="inputField user_name form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="email" value="<?php echo $lead['email']; ?>" class="inputField email form-control">
                                                </td>
                                                <td>
                                                    <?php echo form_dropdown('countrycode', $countries, $lead['countrycode'], 'style="width:150px" required') ?>
                                                </td>
                                                <td>
                                                    <?php if ($role_id == 1) { ?>
                                                        <input type="text" name="mobile" value="<?php echo $lead['mobile']; ?>" class="inputField mobile form-control" style="width: 120px !important;">
                                                    <?php } else { ?>
                                                        <input type="text" name="mobile" value="<?php echo $lead['mobile']; ?>" class="inputField mobile form-control" readonly>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <input type="text" name="project_title" value="<?php echo $lead['project_title']; ?>" class="inputField project_title form-control">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control inputField pages" name="pages" value="<?= $lead['pages'] ?>" style="width: 70px !important;" required="required">
                                                <td>
                                                    <input type="text" name="price" value="<?php echo $lead['price']; ?>" style="width: 70px;" class=" price form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="deadline" value="<?php if (isset($lead['deadline'])) {
                                                                                                    echo date("Y-m-d", strtotime($lead['deadline']));
                                                                                                } ?>" class="inputField deadline mdate form-control" style="width: 120px !important;">
                                                </td>
                                                <td>
                                                    <input class="form-control delivery_time timepicker" name="delivery_time" value="<?php echo $lead['delivery_time']; ?>" style="width: 70px;">
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div style="margin-right: 2px;">
                                                            <div class="form-check form-switch">
                                                                <input type="checkbox" <?php if ($lead['status'] != 1) {
                                                                                            echo "checked value='on'";
                                                                                        } else {
                                                                                            echo "value='off'";
                                                                                        } ?> class="form-check-input checked" id="customSwitch1" title="Canceled / Uncanceled">
                                                            </div>
                                                        </div>
                                                        <div style="margin-right: 2px;">
                                                        <button type="button" class="btn btn-xs btn-warning btn-sm m-1 call_modal" data-bs-toggle="modal" data-id="<?php echo $lead['id']; ?>" data-bs-target="#exampleModal<?php echo $lead['id']; ?>" data-whatever="@getbootstrap">
                                                                Call
                                                            </button>
                                                        </div>
                                                         <?php if ($role_id == 1) { ?>
                                                            <div style="margin-right: 2px;">
                                                                <a class="btn btn-xs btn-dark deleteLead btn-sm m-1" title="Delete lead">D</a>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </td>
                                        </form>

                                        <!-- Callback Modal -->
                                        <div class="modal" id="exampleModal<?php echo $lead['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <!-- <h4 class="modal-title" id="exampleModalLabel1">Call Status Update</h4>  -->
                                                        <h4> <?php echo $lead['order_id']; ?> </h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true"></span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <div class="row col-md-12">
                                                            <div class="card-body" style="height:200px; overflow-y: auto; background-color:white;">
                                                                <div class="message mCustomScrollbar" data-mcs-theme="minimal-dark">
                                                                    <div class="call_message">
                                                                        <!--  -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card-footer">
                                                                <!-- <form class="form-horizontal mobile-display" role="form" method="post" action="<?php echo base_url(); ?>index.php/Leads/callstatusadd" enctype="multipart/form-data"> -->
                                                                <div class="form-group">
                                                                    <div class="row col-md-12 m_form" id="m_form">
                                                                        <div class="row col-md-12">
                                                                            <div class="col-md-12 col-sm-12">
                                                                                <input type="hidden" name="backurl" value="<?= $currentURL ?>">
                                                                                <input type="hidden" class="m_lead_id" name="lead_id" value="<?= $lead['id'] ?>">
                                                                                <textarea type="text" id="m_des" placeholder="Type message" name="description" class="form-control" rows="2" value="" autofocus autocomplete="off" style="resize: none;"></textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row col-md-12">
                                                                            <div class="col-md-12 col-sm-12">
                                                                                <br />
                                                                                <button type="submit" class="btn btn-primary btn-block" id="send_message">Send</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- </form> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.Callback Modal -->
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                        <div class="pagination">
                            <?php echo $links; ?>
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

    <script src="<?php echo base_url(); ?>assets/node_modules/jquery/dist/jquery.min.js"></script>

    <script>
        $("#countrycode_select2").addClass("select2");
        $("#countrycode").addClass("select2");
    </script>

    <script type="text/javascript">
        function myFunction() {
            x = confirm("Are you sure convert lead to order!");
            if (x === true) {

            } else {
                $(this).submit(function(e) {
                    // window.location.reload();
                    return false;
                });
            }
        }

        $(document).ready(function() {

            $(".user_mobile").focusout(function() {
                var mobile = $(this).val();
                if (mobile) {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>index.php/Leads/getUserDetails",
                        cache: false,
                        dataType: "json",
                        data: 'mobile=' + mobile,
                        success: function(response) {
                            if (response.name) {
                                $('#user_name').val(response.name);
                                $('#user_email').val(response.email);
                                $('#countrycode').val(response.countrycode);
                            } else {
                                $('#user_name').val('');
                                $('#user_email').val('');
                                $('#countrycode').val('');
                            }
                        }
                    });
                } else {
                    var mobile = $(this).val('');
                }
            });

            $(document).on('click', '.update', function() {
                var id = $(this).closest("tr").find('.id').val();
                var user_name = $(this).closest("tr").find('.user_name').val();
                var user_email = $(this).closest("tr").find('.email').val();
                var phonecode = $(this).closest("tr").find('[name=countrycode]').val();
                var mobile = $(this).closest("tr").find('.mobile').val();
                var project_title = $(this).closest("tr").find('.project_title').val();
                var pages = $(this).closest("tr").find('.pages').val();
                var price = $(this).closest("tr").find('.price').val();
                var deadline = $(this).closest("tr").find('.deadline').val();
                var delivery_time = $(this).closest("tr").find('.delivery_time').val();
                var create_at = $(this).closest("tr").find('.create_at').val();
                var l_status = $(this).closest("tr").find('.l_status').val();

                swal({
                    title: "Are you sure?",
                    text: "You want to update this record!",
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
                            url: '<?php echo base_url(); ?>index.php/Leads/updateLead',
                            data: {
                                id: id,
                                user_name: user_name,
                                user_email: user_email,
                                phonecode: phonecode,
                                mobile: mobile,
                                project_title: project_title,
                                pages: pages,
                                price: price,
                                deadline: deadline,
                                delivery_time: delivery_time,
                                create_at: create_at,
                                l_status: l_status,
                            },
                            success: function(response) {
                                // window.location.reload();
                            }
                        });
                    } else {
                        // 
                    }
                });
            });

            $(document).on('click', '.deleteLead', function() {
                var id = $(this).closest("tr").find('.id').val();
                swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover this record!",
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
                            url: '<?php echo base_url(); ?>index.php/Leads/delete',
                            data: {
                                id: id,
                            },
                            success: function(response) {
                                // window.location.reload();
                            }
                        });
                    } else {

                    }
                });
            });

            $(document).on('change', '#customSwitch1', function() {
                var status = $(this).val();

                if (status == 'off') {
                    status = 1; // from off to on
                } else {
                    status = 2; // from on to off
                }

                var id = $(this).closest("tr").find('.id').val();
                swal({
                    title: "Are you sure?",
                    text: "Want to update status!",
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
                            url: '<?php echo base_url(); ?>index.php/Leads/updateStatus',
                            data: {
                                id: id,
                                status: status,
                            },
                            success: function(response) {
                                // window.location.reload();
                            }
                        });
                    } else {

                    }
                });
            });

            $(document).on('change', '.c_status', function() {
                var status = $(this).val();

                if (status == 'off') {
                    status = 1; // from off to on
                } else {
                    status = 2; // from on to off
                }

                var id = $(this).closest("tr").find('.id').val();
                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url(); ?>index.php/Leads/updateCheckStatus',
                    data: {
                        id: id,
                        c_status: status,
                    },
                    success: function(response) {
                        // window.location.reload();
                    }
                });

            });

            $(document).on('change', '.all_checked', function() {
                swal({
                    title: "Are you sure?",
                    text: "Want to unchecked all leads!",
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
                            url: '<?php echo base_url(); ?>index.php/Leads/unChecked',
                            success: function(response) {
                                window.location.reload();
                            }
                        });
                    } else {

                    }
                });
            });

        });
    </script>

    <script>
        function check() {
            var mobile = document.getElementById('mobile');
            var message = document.getElementById('message');
            var goodColor = "#0C6";
            var badColor = "#FF9B37";
            if (mobile.value.length < 8 || mobile.value.length > 12) {
                mobile.style.backgroundColor = badColor;
                message.style.color = badColor;
                message.innerHTML = "required 10 to 12 digits!"
            } else {
                var goodColor = "";
                var badColor = "";
                message.innerHTML = ""
            }
        }
    </script>

    <script>
         $(document).on('click', '.call_modal', function() {
                var lead_id = $(this).attr("data-id");
                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url(); ?>index.php/Leads/get_call_list',
                    data: {
                        lead_id: lead_id,
                    },
                    success: function(response) {
                        $('.call_message').html(response);
                    }
                });
            });

            $(document).on('click', '#send_message', function() {
                var lead_id = $(this).closest("div.m_form").find("input[name='lead_id']").val();
                var description = $(this).closest("div.m_form").find("textarea[name='description']").val();

                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url(); ?>index.php/Leads/callstatusadd',
                    data: {
                        lead_id: lead_id,
                        description: description,
                    },
                    success: function(response) {
                        $.ajax({
                            type: "POST",
                            url: '<?php echo base_url(); ?>index.php/Leads/get_call_list',
                            data: {
                                lead_id: lead_id,
                            },
                            success: function(response) {
                                $('.call_message').html(response);
                            }
                        });
                    }
                });
            });

       
    </script>