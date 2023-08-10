<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>assets/images/favicon.png">
    <title>Assignment In Need &#8211; Admin Panel</title>
    <!-- Date Piker -->
    <link href="<?php echo base_url(); ?>assets/node_modules/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/node_modules/clockpicker/dist/jquery-clockpicker.min.css" rel="stylesheet">
    <!-- Color picker plugins css -->
    <link href="<?php echo base_url(); ?>assets/node_modules/jquery-asColorPicker-master/dist/css/asColorPicker.css" rel="stylesheet">
    <!-- Date picker plugins css -->
    <link href="<?php echo base_url(); ?>assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker plugins css -->
    <link href="<?php echo base_url(); ?>assets/node_modules/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/node_modules/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- chartist CSS -->
    <link href="<?php echo base_url(); ?>assets/node_modules/morrisjs/morris.css" rel="stylesheet">
    <!--Toaster Popup message CSS -->
    <link href="<?php echo base_url(); ?>assets/node_modules/toast-master/css/jquery.toast.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>assets/dist/css/style.min.css" rel="stylesheet">
    <!-- Dashboard 1 Page CSS -->
    <link href="<?php echo base_url(); ?>assets/dist/css/pages/dashboard1.css" rel="stylesheet">
    <!-- Font awesome -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css">
    <!-- Floating Lable-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/pages/floating-label.css">
    <!-- select2 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/pages/select2.min.css">
    <!-- Datatables -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link data-require="sweet-alert@*" data-semver="0.4.2" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />

</head>
<style>
    .pagination {
        display: inline-block;
        padding-left: 0;
        margin: 17px 0;
        border-radius: 3px;
    }

    .pagination>li {
        display: inline;
    }

    .pagination>li>a,
    .pagination>li>span {
        position: relative;
        float: left;
        padding: 6px 12px;
        line-height: 1.42857143;
        text-decoration: none;
        color: #373e4a;
        background-color: #fff;
        border: 1px solid #ddd;
        margin-left: -1px;
    }

    .pagination>li:first-child>a,
    .pagination>li:first-child>span {
        margin-left: 0;
        border-bottom-left-radius: 3px;
        border-top-left-radius: 3px;
    }

    .pagination>li:last-child>a,
    .pagination>li:last-child>span {
        border-bottom-right-radius: 3px;
        border-top-right-radius: 3px;
    }

    .pagination>li>a:hover,
    .pagination>li>span:hover,
    .pagination>li>a:focus,
    .pagination>li>span:focus {
        z-index: 2;
        color: #818da2;
        background-color: #eeeeee;
        border-color: #ddd;
    }

    .pagination>.active>a,
    .pagination>.active>span,
    .pagination>.active>a:hover,
    .pagination>.active>span:hover,
    .pagination>.active>a:focus,
    .pagination>.active>span:focus {
        z-index: 3;
        color: #fff;
        background-color: #373e4a;
        border-color: #949494;
        cursor: default;
    }

    .pagination>.disabled>span,
    .pagination>.disabled>span:hover,
    .pagination>.disabled>span:focus,
    .pagination>.disabled>a,
    .pagination>.disabled>a:hover,
    .pagination>.disabled>a:focus {
        color: #999999;
        background-color: #fff;
        border-color: #ddd;
        cursor: not-allowed;
    }

    .pagination-lg>li>a,
    .pagination-lg>li>span {
        padding: 10px 16px;
        font-size: 15px;
        line-height: 1.3333333;
    }

    .pagination-lg>li:first-child>a,
    .pagination-lg>li:first-child>span {
        border-bottom-left-radius: 3px;
        border-top-left-radius: 3px;
    }

    .pagination-lg>li:last-child>a,
    .pagination-lg>li:last-child>span {
        border-bottom-right-radius: 3px;
        border-top-right-radius: 3px;
    }

    .pagination-sm>li>a,
    .pagination-sm>li>span {
        padding: 5px 10px;
        font-size: 11px;
        line-height: 1.5;
    }

    .pagination-sm>li:first-child>a,
    .pagination-sm>li:first-child>span {
        border-bottom-left-radius: 2px;
        border-top-left-radius: 2px;
    }

    .pagination-sm>li:last-child>a,
    .pagination-sm>li:last-child>span {
        border-bottom-right-radius: 2px;
        border-top-right-radius: 2px;
    }

    .pager {
        padding-left: 0;
        margin: 17px 0;
        list-style: none;
        text-align: center;
    }

    .pager li {
        display: inline;
    }

    .pager li>a,
    .pager li>span {
        display: inline-block;
        padding: 5px 14px;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 3px;
    }

    .pager li>a:hover,
    .pager li>a:focus {
        text-decoration: none;
        background-color: #eeeeee;
    }

    .pager .next>a,
    .pager .next>span {
        float: right;
    }

    .pager .previous>a,
    .pager .previous>span {
        float: left;
    }

    .pager .disabled>a,
    .pager .disabled>a:hover,
    .pager .disabled>a:focus,
    .pager .disabled>span {
        color: #999999;
        background-color: #fff;
        cursor: not-allowed;
    }
</style>

<style>

    .select2-hidden-accessible {
        border: 0 !important;
        clip: rect(0 0 0 0) !important;
        height: 1px !important;
        margin: -1px !important;
        overflow: hidden !important;
        padding: 0 !important;
        position: absolute !important;
        width: 1px !important
    }

    .select2-container--default .select2-selection--single,
    .select2-selection .select2-selection--single {
        border: 1px solid #d2d6de;
        border-radius: 0;
        padding: 6px 12px;
        height: 34px
    }

    .select2-container--default .select2-selection--single {
        background-color: #fff;
        border: 1px solid #aaa;
        border-radius: 4px
    }

    .select2-container .select2-selection--single {
        box-sizing: border-box;
        cursor: pointer;
        display: block;
        height: 28px;
        user-select: none;
        -webkit-user-select: none
    }

    .select2-container .select2-selection--single .select2-selection__rendered {
        padding-right: 10px
    }

    .select2-container .select2-selection--single .select2-selection__rendered {
        padding-left: 0;
        padding-right: 0;
        height: auto;
        margin-top: -3px
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #444;
        line-height: 28px
    }

    .select2-container--default .select2-selection--single,
    .select2-selection .select2-selection--single {
        border: 1px solid #d2d6de;
        border-radius: 5px !important;
        padding: 6px 12px;
        height: 40px !important
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 26px;
        position: absolute;
        top: 6px !important;
        right: 1px;
        width: 20px
    }
</style>