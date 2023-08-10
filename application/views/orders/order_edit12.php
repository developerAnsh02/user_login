
<?php
defined('BASEPATH') or exit('No direct script access allowed');
$current_page = current_url();
$data = explode('?', $current_page);
$role_id = $this->session->userdata['logged_in']['role_id'];
$currentURL = current_url();
?>

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
                <h4 class="text-themecolor"><?php echo $title; ?></h4>
            </div>
            <div class="col-md-7 align-self-center text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb justify-content-end">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active"><?php echo $title; ?></li>
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
                    <div class="card-body">

                        <h4>Order ID: <?= $order_id ?></h4>

                        <form class="floating-labels m-t-40" role="form" method="post" action="<?php echo base_url(); ?>index.php/Orders/editorder/<?= $id ?>" enctype="multipart/form-data">

                            <?php if ($role_id != '2') { ?>
                                <?php if (@$referal == 'No') { ?>

                                <?php } ?>
                            <?php } else { ?>
                                <input type="hidden" name="referal" value="<?= @$referal ?>">
                            <?php } ?>

                            <input type="hidden" name="backurl" value="<?= $currentURL ?>">
                            <input type="hidden" name="edit_id" value="<?= $id ?>">

                            <input type="text" style="display:none;" name="order_id" class="form-control" value="<?= $order_id ?>" autofocus readonly="readonly">
                            <input type="text" style="display:none;" name="order_type" value="Back-End">

                            <div class="row">
                                <?php if($role_id != '5') { ?>
                                <div class="col-lg-4">
                                    <div class="form-group has-warning m-b-40">
                                        <input type="text" class="form-control" name="u_name" value="<?= $user_name ?>" required="required">
                                        <span class="bar"></span>
                                        <label for="input10">Name</label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group has-warning m-b-40">
                                        <input type="text" class="form-control" name="u_email" value="<?= $email ?>" required="required">
                                        <span class="bar"></span>
                                        <label for="input10">Email</label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group has-warning m-b-40">
                                        <input type="text" class="form-control" name="u_mobile_no" value="<?= $mobile_no ?>" required="required">
                                        <span class="bar"></span>
                                        <label for="input10">Mobile No</label>
                                    </div>
                                </div>

                                <!-- Select Customer -->
                                <?php if ($role_id != '2') {  ?>
                                    <?php if ($role_id == '1') {  ?>
                                        <div class="col-lg-4">
                                            <div class="form-group has-warning m-b-40">
                                                <?php echo form_dropdown('user_id', $users, $user_id, '', 'required="required"') ?>
                                                <span class="bar"></span>
                                                <label for="input10">Select customer</label>
                                            </div>
                                        </div>
                                    <?php } else { ?>
                                        <div class="col-lg-4">
                                            <div class="form-group has-warning m-b-40">
                                                <input type="text" value="<?php if (isset($user_name) && !empty($user_name)) {
                                                                                echo $user_name;
                                                                            } ?>" class="form-control" id="input10" readonly>
                                                <span class="bar"></span>
                                                <label for="input10">Select customer</label>
                                            </div>
                                        </div>
                                    <?php } ?>
                                <?php } else { ?>
                                    <input type="text" style="display:none;" name="user_id" value="<?= @$user_id ?>">
                                <?php } } ?>

                                <!-- Project Title -->
                                <div class="col-lg-4">
                                    <div class="form-group has-warning m-b-40">
                                        <input type="text" class="form-control" name="title" value="<?= $project_title ?>" required="required">
                                        <span class="bar"></span>
                                        <label for="input10">Project title</label>
                                    </div>
                                </div>

                                <!-- Select pages -->
                                <div class="col-lg-4">
                                    <div class="form-group has-warning m-b-40">
                                        <input type="text" class="form-control pages" name="pages" value="<?= $page ?>" required="required">
                                        <span class="bar"></span>
                                        <label for="input10">Select pages</label>
                                    </div>
                                </div>

                                <!-- Enter Discount -->
                                <?php if ($role_id != '2') {  ?>
                                    <div class="col-lg-4">
                                        <div class="form-group has-warning m-b-40">
                                            <input type="text" name="discount_per" class="form-control discount_per" value="<?php $discount_per ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" />
                                            <span class="bar"></span>
                                            <label for="input10">Enter discount</label>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-lg-4">
                                        <div class="form-group has-warning">
                                            <input type="text" name="discount_per" class="form-control discount_per" value="40" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" readonly="readonly" />
                                            <span class="bar"></span>
                                            <label for="input10">Enter discount</label>
                                        </div>
                                    </div>
                                <?php } ?>

                                <!-- Order total -->
                                <div class="col-lg-4" hidden>
                                    <div class="form-group has-warning">
                                        <input type="text" name="actualorder" class="actualorder form-control" id="input10" value="<?php echo $actual_amount; ?>">
                                        <span class="bar"></span>
                                        <strike class="actualorder" style="font-size: 22px;color:red;"></strike>
                                    </div>
                                </div>
                                <?php if($role_id != '5') {?>
                                <!-- Price after applying coupon -->
                                <div class="col-lg-4">
                                    <div class="form-group has-warning">
                                        <?php if ($role_id != '2') {  ?>
                                            <input type="text" name="order_total" class="form-control order_total" value="<?php echo $amount; ?>" required>
                                        <?php } else { ?>
                                            <input type="hidden" name="order_total" class="order_total" value="<?php echo $amount; ?>">
                                        <?php } ?>

                                        <input type="hidden" name="no_of_days" class="no_of_days" value="">

                                        <span class="bar"></span>
                                        <label for="input10">Price after applying coupon</label>
                                        <strike class="actualorder" style="font-size: 22px;color:red;">
                                            <?php echo $actual_amount; ?>
                                        </strike> Order total
                                        <!-- <span class="ordershow" style="font-size: 22px;color:green;"> </span> -->
                                        <!-- <i style="font-size: 18px;color:green;" class="fa fa-check"></i> -->
                                    </div>
                                </div>
                                <?php } ?>

                                <!-- Delivery Date -->
                                <div class="col-lg-4" style="display: flex;">
                                    <div class="col-6">
                                        <div class="form-group has-warning m-b-40">
                                            <input type="text" class="form-control second delivery_date mdate" name="delivery_date" value="<?php echo  date("Y-m-d", strtotime($delivery_date)); ?>">
                                            <span class="bar"></span>
                                            <label for="input10">Delivery date</label>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <!-- blank -->
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group has-warning m-b-40">
                                            <input type="text" class="form-control timepicker" name="delivery_time" value="<?php if(isset($delivery_time) && !empty($delivery_time)) { echo $delivery_time; } ?>">
                                            <span class="bar"></span>
                                            <label for="input10">Time</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Writer name -->
                                <?php if($role_id != '4')  { ?>
                                <div class="col-lg-4">
                                    <div class="form-group has-warning m-b-40">
                                        <?php if ($role_id != '3') { ?>
                                            <?php if ($projectstatus == 'In Progress') { ?>
                                                <select name="writer_name" class="form-control" required>
                                                    <option value=""></option>
                                                    <?php
                                                    $teams = getWriterTeams();
                                                    foreach ($teams as $team) {
                                                    ?>
                                                        <option <?php if (@$writer_name == $team) {
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
                                                        <option <?php if (@$writer_name == $team) {
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
                                            <input type="hidden" name="writer_name" id="input10" class="form-control writer_name" value="<?= @$writer_name ?>" />
                                        <?php } ?>
                                    </div>
                                </div>
                                <?php  } ?>

                                <!-- Writer price -->
                                <div class="col-lg-4" style="display: none;">
                                    <div class="form-group has-warning m-b-40">
                                        <?php if ($role_id != '3') { ?>
                                            <input type="text" name="writer_price" class="form-control writer_price" value="<?= @$writer_price ?>" oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" />
                                        <?php } else { ?>
                                            <input type="hidden" name="writer_price" class="form-control writer_price" value="<?= @$writer_price ?>" oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" />
                                        <?php } ?>
                                        <span class="bar"></span>
                                        <label for="input10">Writer price</label>
                                    </div>
                                </div>

                                <!-- Writer deadline -->
                                <div class="col-lg-4 writer_deadline">
                                    <div class="form-group has-warning m-b-40">
                                        <?php if (!empty($writer_deadline)) {
                                            if (@$writer_deadline != '1970-01-01') {
                                                $writer_deadlinenew = date("Y-m-d", strtotime(@$writer_deadline));
                                            } else {
                                                $writer_deadlinenew = date("Y-m-d");
                                            }
                                        } else {
                                            $writer_deadlinenew = date("Y-m-d");
                                        } ?>

                                        <input type="text" class="form-control mdate" name="writer_deadline" value="">
                                        <span class="bar"></span>
                                        <label for="input10">Writer deadline</label>
                                    </div>
                                </div>

                                <!-- College Name -->
                                <div class="col-lg-4">
                                    <div class="form-group has-warning m-b-40">
                                        <input type="text" class="form-control" id="input10" name="college_name" value="<?= @$college_name ?>">
                                        <span class="bar"></span>
                                        <label for="input10">College name</label>
                                    </div>
                                </div>

                                <!-- Order Date -->
                                <div class="col-lg-4">
                                    <div class="form-group has-warning m-b-40">
                                        <input type="text" class="form-control first mdate" name="order_date" value="<?php echo date('Y-m-d', strtotime($order_date)); ?>">
                                        <span class="bar"></span>
                                        <label for="input10">Order date</label>
                                    </div>
                                </div>

                                <!-- Formatting & Citation Style -->
                                <div class="col-lg-4">
                                    <div class="form-group has-warning m-b-40">
                                        <select class="form-control " name="formatting" required="required">
                                            <option value=""></option>
                                            <?php
                                            foreach ($formattings as $key => $value) {
                                                if ($formatting == $value['formatting_name']) {
                                            ?>
                                                    <option value="<?= $value['formatting_name'] ?>" selected><?= $value['formatting_name'] ?></option>
                                                <?php } else { ?>
                                                    <option value="<?= $value['formatting_name'] ?>"><?= $value['formatting_name'] ?></option>

                                            <?php  }
                                            } ?>
                                        </select>
                                        <span class="bar"></span>
                                        <label for="input10">Formatting and citation style</label>
                                    </div>
                                </div>

                                <!-- Choose type of service -->
                                <div class="col-lg-4">
                                    <div class="form-group has-warning m-b-40">
                                        <select class="form-control typeofservice" name="typeofservice" required="required">
                                            <option value=""></option>
                                            <?php
                                            foreach ($services as $key => $value) {
                                                if ($service == $value['service_name']) {
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

                                <!-- Choose type of paper -->
                                <div class="col-lg-4">
                                    <div class="form-group has-warning m-b-40">
                                        <select class="form-control typeofpaper" name="typeofpaper" required="required">
                                            <option value=""></option>
                                            <?php
                                            foreach ($typeofpapers as $key => $value) {
                                                if ($typeofpaper == $value['paper_type']) {
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

                                <!-- Choose type of writing -->
                                <div class="col-lg-4">
                                    <div class="form-group has-warning m-b-40">
                                        <select class="form-control typeofwritting" name="typeofwritting" required="required">
                                            <option value=""></option>
                                            <?php
                                            foreach ($typeofwritings as $key => $value) {
                                                if ($typeofwritting == $value['type_of_writing']) {
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

                                <?php if($role_id != 1) { ?>
                                <?php if ($projectstatus != 'Cancelled') { ?>
                                <!-- Order status -->
                                <div class="col-lg-4">
                                    <div class="form-group has-warning m-b-40">
                                        <select class="form-control pages" name="projectstatus" required>

                                            <option value="Pending" <?php if ($projectstatus == 'Pending') {
                                                                        echo "selected";
                                                                    } ?>>Pending</option>

                                            <option value="Hold Work" <?php if ($projectstatus == 'Hold Work') {
                                                                        echo "selected";
                                                                    } ?>>Hold Work</option>

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


                                            <option value="Hold Work" <?php if ($projectstatus == 'Hold Work') {
                                                                        echo "selected";
                                                                    } ?>>Hold Work</option>

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

                                <!-- Payment status -->
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

                            </div>
                            <!-- / row -->

                            <!-- Enter message -->
                            <div class="col-lg-12">
                                <div class="form-group has-warning m-b-40">
                                    <textarea type="text" name="message" class="form-control" rows="3" value="" autofocus autocomplete="off" style="resize: none;"><?= $message ?></textarea>
                                    <span class="bar"></span>
                                    <label for="input10">Enter message</label>
                                </div>
                            </div>

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

                                                </tbody>
                                            </table>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>

                    </div>
                    <!-- / row -->

                    <div class="row">
                        <button type="submit" class="btn btn-primary btn-block">Update</button>
                    </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Page Content -->
</div>
<!-- ============================================================== -->
<!-- End PAge Content -->
<!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->

<script src="<?php echo base_url(); ?>assets/node_modules/jquery/dist/jquery.min.js"></script>

<table id="sample_table1" style="display: none;">
    <tbody>
        <tr class="main_tr1">
            <td>1.</td>
            <td>
                <input type="file" name="bill_image[]" class="form-control upload">
            </td>
            <td>
                <button type="button" class="btn btn-xs btn-primary addrow" style="padding:4px;" href="#" role='button'>
                    <i class="fa fa-plus"></i>
                </button>
                <button type="button" class="btn btn-xs btn-danger deleterow" href="#" style="padding:4px;" role='button'>
                    <i class="fa fa-minus"></i>
                </button>
            </td>
        </tr>
    </tbody>
</table>

<script type="text/javascript">
    $(document).ready(function() {

        add_row();
        rename_rows();
        $('body').on('click', '.addrow', function() {

            var table = $(this).closest('table');
            add_row();
            rename_rows();
        });

        function add_row() {
            var tr1 = $("#sample_table1 tbody tr").clone();
            $("#maintable tbody#mainbody").append(tr1);
        }

        $('body').on('click', '.deleterow', function() {

            var table = $(this).closest('table');
            var rowCount = $("#maintable tbody tr.main_tr1").length;
            if (rowCount > 1) {
                if (confirm("Are you sure to remove row ?") == true) {
                    $(this).closest("tr").remove();
                    rename_rows();
                }
            }
        });

        function rename_rows() {
            var i = 0;

            $("#maintable tbody tr.main_tr1").each(function() {
                $(this).find("td:nth-child(1)").html(++i);
                var rowCount1 = $("#maintable tbody tr.main_tr1").length;
            });
        }

        $(document).on('change', '.pages,.typeofservice,.timeline,.typeofpaper,.typeofwritting,.discount_per,.second', function() {
            calculate_total12();
        });

        $(document).on('keyup', '.discount_per', function() {
            calculate_total12();
        });

        $(document).on('keyup', '.order_total', function() {
            var discount_price = $(this).val();

            var actual_price = $('.actualorder').val();

            var divide = (discount_price / actual_price);

            var acutal_discount = ((1 - divide) * 100).toFixed(2);
            $('.discount_per').val(acutal_discount);
            $('.ordershow').html(discount_price);

        });

        // function calculate_total12() {
        //     var typservice = $('.typeofservice').find('option:selected').attr('typservice');
        //     var typpaper = $('.typeofpaper').find('option:selected').attr('typpaper');
        //     var typwrtg = $('.typeofwritting').find('option:selected').attr('typwrtg');
        //     var pages = $('.pages').find('option:selected').attr('pageatr');
        //     var first = $('.first').val();
        //     var second = $('.second').val();

        //     function parseDate(str) {
        //         var mdy = str.split("-");
        //         return new Date(mdy[0], mdy[1] - 1, mdy[2]);
        //     }

        //     function datediff(first, second) {
        //         return Math.round((second - first) / (1000 * 60 * 60 * 24));
        //     }

        //     if (parseDate(second) > parseDate(first)) {
        //         no_of_days = datediff(parseDate(first), parseDate(second));
        //         // alert(no_of_days);
        //         if (no_of_days == 1) {
        //             var deadline = 1.54;
        //         }
        //         if (no_of_days == 2) {
        //             var deadline = 1.42;
        //         }
        //         if (no_of_days == 3) {
        //             var deadline = 1.18;
        //         }
        //         if (no_of_days > 3 && no_of_days <= 5) {
        //             var deadline = 1.05;
        //         }
        //         if (no_of_days > 5 && no_of_days <= 7) {
        //             var deadline = 0.89;
        //         }
        //         if (no_of_days > 7 && no_of_days <= 14) {
        //             var deadline = 0.81;
        //         }
        //         if (no_of_days > 14) {
        //             var deadline = 0.75;
        //         }
        //     } else {
        //         alert("You can not select Delivery Date less than Order Date");
        //         $('.delivery_date').val('');
        //     }

        //     var discount_per = $('.discount_per').val();
        //     if (isNaN(typservice)) {
        //         typservice = 0;
        //     }
        //     if (isNaN(no_of_days)) {
        //         no_of_days = 0;
        //     }
        //     if (isNaN(typpaper)) {
        //         typpaper = 0;
        //     }
        //     if (isNaN(typwrtg)) {
        //         typwrtg = 0;
        //     }
        //     if (isNaN(pages)) {
        //         pages = 0;
        //     }
        //     if (isNaN(discount_per)) {
        //         discount_per = 0;
        //     }

        //     var pagevalue = pages - (pages * 10) / 100;
        //     var actual_price = typservice * deadline * typpaper * typwrtg * pagevalue;
        //     var discount_price = (typservice * deadline * typpaper * typwrtg * pagevalue) * discount_per / 100;
        //     var total = actual_price - discount_price;

        //     $('.order_total').val(total.toFixed(2));
        //     $('.actualorder').val(actual_price.toFixed(2));
        //     $('.no_of_days').val(no_of_days);
        //     $('.ordershow').html(total.toFixed(2));
        //     $('.actualorder').html(actual_price.toFixed(2));
        // }

    });
</script>