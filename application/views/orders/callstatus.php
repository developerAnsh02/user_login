<?php
defined('BASEPATH') or exit('No direct script access allowed');
$role_id = $this->session->userdata['logged_in']['role_id'];
$user_id = $this->session->userdata['logged_in']['id'];
$currentURL = current_url();
?>

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
        width: 80%;
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
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Call Status Update</h4>
            </div>
            <div class="col-md-7 align-self-center text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb justify-content-end">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Call Status Update</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->

        <div class="row col-md-12">
            <div class="card-body" style="display: block; height:200px; overflow-y: auto; background-color:white;">
                <div class="message mCustomScrollbar" data-mcs-theme="minimal-dark">
                    <ul>
                        <?php
                        $i = 0;
                        foreach ($call_lists as $call_list) {
                        ?>
                            <div class="col-md-12">
                                <?php
                                if ($call_list['created_by'] == $user_id) {
                                ?>
                                    <li class="msg-right">
                                        <div class="msg-left-sub">
                                            <img src="<?php echo base_url() ?>uploads/customers/logo.png" alt="userImg">
                                            <div class="msg-desc">
                                                <?php echo $call_list['description']; ?>
                                            </div>
                                            <small>
                                                <?php echo date('d-M-y h:i:s A', strtotime($call_list['created_on'])); ?>
                                                <b><?php echo $call_list['ename']; ?></b>
                                            </small>
                                        </div>
                                    </li>
                                    <br>
                                <?php } else { ?>
                                    <li class="msg-left">
                                        <div class="msg-left-sub">
                                            <img src="<?php echo base_url() ?>uploads/customers/logo.png" alt="userImg">
                                            <div class="msg-desc">
                                                <?php echo $call_list['description']; ?>
                                            </div>
                                            <small>
                                                <b><?php echo $call_list['ename']; ?></b>
                                                <?php echo date('d-M-y h:i:s A', strtotime($call_list['created_on'])); ?>
                                            </small>
                                        </div>
                                    </li>
                                    <br>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="card-footer">
                <form style="" class="form-horizontal mobile-display" role="form" method="post" action="<?php echo base_url(); ?>index.php/Orders/callstatusadd" enctype="multipart/form-data">
                    <input type="hidden" name="order_id" value="<?= @$order_id ?>">
                    <input type="hidden" name="backurl" value="<?= $currentURL ?>">
                    <div class="form-group">
                        <div class="row col-md-12">
                            <!-- <div class="col-md-12 col-sm-12">
                                <label class="control-label"> Status</label>
                                <input type="text" name="status" class="form-control" placeholder="Status" id="first" autofocus autocomplete="off" autocomplete="off">
                            </div>
                        </div> -->
                            <div class="row col-md-12">
                                <div class="col-md-12 col-sm-12">
                                    <textarea type="text" placeholder="Type message" name="description" class="form-control" rows="2" value="" autofocus autocomplete="off" style="resize: none;"></textarea>
                                </div>
                            </div>
                            <div class="row col-md-12">
                                <div class="col-md-12 col-sm-12">
                                    <br />
                                    <button type="submit" class="btn btn-primary btn-block">Send</button>
                                </div>
                            </div>
                        </div>
                </form>
            </div>
        </div>