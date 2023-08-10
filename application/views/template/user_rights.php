<?php
defined('BASEPATH') or exit('No direct script access allowed');
$base                = base_url();
$hyperlink_ordes     = $base . 'index.php/Orders/index';
$hyperlink_customers = $base . 'index.php/Employees/index';
?>

<style type="text/css">
    .box .overlay>.fa,
    .overlay-wrapper .overlay>.fa {
        top: 79%;
        left: 49%;
    }
</style>
<style type="text/css">
    #bread {
        width: 50%;
    }

    #bread ul.treeview-menu {
        margin-right: 5px;
    }

    #bread ul {
        margin-bottom: 5px;
        margin-top: 5px;
    }

    #bread ul li label a.toggle {
        transition: background .3s ease;
        color: #b7f099 !important;
    }

    #bread ul li label {
        width: 100%;
        display: block;
        background: rgb(77, 55, 75);
        color: #fefefe;
        padding: 0.75em;
        margin-bottom: 0px;
        border-radius: 0.15em;
        transition: background 0.3s ease;
    }

    #bread ul li.treeview {
        border: 1px solid #383838;
        margin-top: 5px;
        border-radius: 4px;
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
        <div class="card-body">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link" href="#rolewise" data-toggle="tab" style="color: black;">
                        Role Wise
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="#empwise" data-toggle="tab">
                        Employee Wise
                    </a>
                </li> -->
            </ul>
            <div class="tab-content">
                <div class="tab-pane active show" id="rolewise">
                    <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Meenus/addRoleRights">
                        <div class="col-md-6 rolewise">
                            <?php
                            echo form_dropdown('role_id', $roles)
                            ?>
                        </div>
                        <div id="rolewisedatashow">
                            <!-- blank -->
                        </div>
                    </form>
                </div>
                <div class="tab-pane show" id="empwise">
                    <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Meenus/addEmployeeRights">
                        <div class="row">
                            <label> Select Employee</label>
                            <div class="col-md-6 empwise">
                                <?php
                                echo form_dropdown('employee_id', $employees)
                                ?>
                            </div>
                        </div>
                        <div id="empwisedatashow">
                            <!-- blank -->
                        </div>
                    </form>
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

<script type="text/javascript">
    $(document).ready(function() {
        var base_url = '<?php echo base_url(); ?>';
        $(document).on('change', '.rolewise', function() {
            var role_id = $('.rolewise').find('option:selected').val();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('index.php/Meenus/rolewisedata/') ?>" + role_id,
                dataType: 'html',
                success: function(response) {
                    $("#rolewisedatashow").html(response);
                }
            });
        });

        $(document).on('change', '.empwise', function() {
            var employee_id = $('.empwise').find('option:selected').val();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('index.php/Meenus/employeewisedata/') ?>" + employee_id,
                dataType: 'html',
                success: function(response) {
                    $("#empwisedatashow").html(response);
                }
            });
        });

        $(document).on('change', '.menu_check', function() {
            var now = $(this);
            $(this).closest('li').find(' input[type=checkbox]').prop('checked', $(this).is(':checked'));
            var sibs = false;
            $(this).closest('ul').children('li').each(function() {
                if ($(this).find('input[type=checkbox]').is(':checked')) sibs = true;
            });
            $(this).parents('ul').prev().find('input[type=checkbox]').prop('checked', sibs);
        });

        $(document).on('click', '.toggle', function(e) {
            var now = $(this);
            if (now.parent().next().hasClass('show')) {
                now.parent().next().slideUp(350);
                now.parent().next().removeClass('show');
            } else {
                now.parent().parent().parent().find('.inner').removeClass('show');
                now.parent().parent().find('.inner').slideUp(350);
                now.parent().next().toggleClass('show');
                now.parent().next().slideToggle(350);
            }
        });
    });
</script>