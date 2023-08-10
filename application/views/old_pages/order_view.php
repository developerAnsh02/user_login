<?php
defined('BASEPATH') or exit('No direct script access allowed');
$current_page = current_url();
//$current_page='https://www.muskowl.com/chaudhary_minerals/index.php/Meenus/UserRights';
$data = explode('?', $current_page);
$role_id = $this->session->userdata['logged_in']['role_id'];
//echo $session_data['role_id'];exit;
//print_r($data[0]);exit;
?>

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

<?php if ($this->session->flashdata('success')) : ?>
  <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fa fa-check"></i> Success!</h5>
    <?php echo $this->session->flashdata('success'); ?>
  </div>
  <!-- <span class="successs_mesg"><?php echo $this->session->flashdata('success'); ?></span> -->
<?php endif; ?>

<?php if ($this->session->flashdata('failed')) : ?>
  <div class="alert alert-error alert-dismissible ">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fa fa-check"></i> Alert!</h5>
    <?php echo $this->session->flashdata('failed'); ?>
  </div>
<?php endif; ?>
<div class="container-fluid">
  <div class="card card-primary card-outline">
    <div class="card-header">
      <span class="card-title"><?php echo $title; ?></span>
      <div class="pull-right error_msg">
        <a href="<?php echo base_url(); ?>index.php/Orders/add" class="btn btn-success" data-toggle="tooltip" title="Create New Order"><i class="fa fa-plus"></i></a>

        <button class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="location.reload();"><i class="fa fa-refresh"></i></button>

        <button class="btn btn-danger delete_all" data-toggle="tooltip" title="Bulk Delete"><i class="fa fa-trash"></i></button>
      </div>
    </div> <!-- /.card-body -->
    <div class="card-body">
      <form method="get" id="filterForm">
        <div class="row">
          <?php if ($role_id == '1' || $role_id == '3') {  ?>
            <div class="col-md-3 col-sm-3 ">
              <label class="control-label">Name of Customer <span class="required">*</span></label>
              <select name="customer_id" class="form-control select2 customers">
                <option value="0"> Select customer</option>
                <?php
                if ($all_customers) : ?>
                  <?php
                  foreach ($all_customers as $value) : ?>
                    <?php
                    if ($value['id'] == $customer_id) : ?>
                      <option value="<?= $value['id'] ?>" selected><?= $value['name'] ?> <?= $value['email'] ?> <?= $value['mobile_no'] ?></option>
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

          <?php if ($role_id == '1' || $role_id == '3') { ?>
            <div class="col-md-3 col-sm-3 ">
              <label class="control-label"> Search By Order Id <span class="required">*</span></label>
              <select name="order_id" class="form-control select2 ">
                <option value="0"> Select Order Id</option>
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
            <label class="control-label"> From Date</label>
            <input type="text" data-date-formate="dd-mm-yyyy" name="from_date" class="form-control date-picker" value="<?php echo @$from_date; ?>" placeholder="dd-mm-yyyy">
          </div>
          <div class="col-md-3 col-sm-3">
            <label class="control-label"> Upto Date</label>
            <input type="text" data-date-formate="dd-mm-yyyy" name="upto_date" class="form-control date-picker" value="<?php echo @$upto_date; ?>" placeholder="dd-mm-yyyy">
          </div>
          <div class="col-md-2 col-sm-2">
            <label> Order Date :</label>
            <select class="form-control pages" name="order_date_filter">
              <option value="order_date">Order Date</option>
              <option value="delivery_date">Delivery Date</option>
              <option value="writer">Writer deadline</option>
            </select>
          </div>

          <div class="col-md-2 col-sm-2">
            <label> Order Status :</label>
            <select class="form-control pages" name="status">
              <option value=""></option>
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
          <div class="col-md-2 col-sm-2">
            <label> Title :</label>
            <select class="form-control" name="filter_check">
              <option value="title">Title</option>
              <option value="writer">Writer Name</option>
              <option value="college">College Name</option>
            </select>
          </div>
          <div class="col-md-3 col-sm-3">
            <label class="control-label"> Search</label>
            <input type="text" name="title" class="form-control" value="" placeholder="Title,College,Writer">
          </div>

          <div class="col-md-3 col-sm-3 ">
            <label class="control-label" style="visibility: hidden;"> Grade</label><br>
            <input type="submit" class="btn btn-primary" value="Search" />
            <label class="control-label" style="visibility: hidden;"> Grade</label>
            <a href="<?php echo $data[0] ?>" class="btn btn-danger"> Reset</a>
          </div>
        </div>
    </div>
    </form>
    <hr>

    <div class="table-responsive">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <!-- <th><input type="checkbox" id="master"></th>-->
            <th>Sr.<br />No.</th>
            <th style="white-space: nowrap;"> Order Code </th>
            <th style="white-space: nowrap;"> Order Date</th>
            <th style="white-space: nowrap;"> Delivery Date</th>
            <th> Title </th>
            <th> Words</th>
            <th> Amount </th>
            <?php if ($role_id == 1) { ?>
              <th> Paid </th>
              <th> Due </th>
              <th>Writer Name</th>
              <th>Writer Deadline</th>
              <th>College Name</th>
            <?php } ?>
            <?php if ($role_id == 3) { ?>
              <th>Writer Deadline</th>
            <?php } ?>
            <th style="white-space: nowrap;"> Project Status</th>
            <th style="display:none;">Name</th>
            <th style="display:none;">Mobile</th>
            <th style="display:none;">Email</th>
            <th style="white-space: nowrap;width: 20%;"> Action Button</th>
          </tr>
        </thead>
        <tbody>
          <?php

          $i = 1;
          foreach ($orders as $obj) { ?>
            <tr <?php if ($obj['flag'] == 0) { ?> style="font-weight: 700;" <?php } ?> class="read_order" order_id="<?= $obj['id'] ?>">
              <!-- <td><input type="checkbox" class="sub_chk" value="<?php echo $obj['id']; ?>" /></td> -->
              <td><?php echo $i; ?></td>
              <td><?php echo $obj['order_id']; ?></td>
              <td><?php echo date('d-M-Y', strtotime($obj['order_date'])); ?></td>
              <td><?php echo date('d-M-Y', strtotime($obj['delivery_date'])); ?></td>
              <td><?php echo $obj['title']; ?></td>
              <td><?php $data = $obj['pages'];
                  $data1 = explode(' (', $data);
                  @$data_new = explode(' ', $data1['1']);
                  echo $data_new['0'];
                  ?></td>
              <td><?php echo @$obj['amount']; ?> &#163;</td>
              <?php if ($role_id == 1) { ?>
                <td><?php echo @$obj['received_amount']; ?> &#163;</td>
                <td><?php echo $obj['amount'] - $obj['received_amount']; ?> &#163;</td>
                <td style=""><?php echo @$obj['writer_name']; ?></td>
                <td><?php if (($obj['writer_deadline'] != '1970-01-01') and (!empty($obj['writer_deadline']))) {
                      echo date('d-M-Y', strtotime($obj['writer_deadline']));
                    }  ?></td>
                <td style=""><?php echo @$obj['college_name']; ?></td>
              <?php } ?>
              <?php if ($role_id == 3) { ?>
                <td><?php if (($obj['writer_deadline'] != '1970-01-01') and (!empty($obj['writer_deadline']))) {
                      echo date('d-M-Y', strtotime($obj['writer_deadline']));
                    }  ?></td>
              <?php } ?>
              <td><?php echo $obj['projectstatus']; ?></td>
              <td style="display:none;"><?php echo $obj['c_name']; ?></td>
              <td style="display:none;"><?php echo $obj['c_mobile']; ?></td>
              <td style="display:none;"><?php echo $obj['c_email']; ?></td>
              <td>

                <?php if ($role_id == 1) { ?>
                  <a style="color:#fff;" class="btn btn-xs btn-primary btnEdit" data-toggle="modal" data-target="#duplicate<?php echo $obj['id']; ?>"><i class="fa fa-first-order" aria-hidden="true"></i></a>

                  <a href="<?php echo base_url(); ?>index.php/Orders/indusialemail/<?php echo $obj['id']; ?>" style="color:#fff;" class="btn btn-xs btn-warning btnEdit"><i class="fa fa-envelope-open-o" aria-hidden="true"></i></a>

                  <div class="modal fade" id="duplicate<?php echo $obj['id']; ?>" role="dialog">
                    <div class="modal-dialog">
                      <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Orders/duplicate/<?php echo $obj['id']; ?>">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Confirm Header </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                          </div>
                          <div class="modal-body">
                            <p>Are you sure, you want to create duplicate Order ? </p>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary ">Submit</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>

                <?php } ?>

                <?php if ($role_id == 2) { ?>
                  <button class="btn btn-info btnEdit" data-toggle="modal" title="Download File" data-target="#download<?php echo $obj['id']; ?>"><i class="fa fa-download"></i></button>
                <?php } ?>
                <a class="btn btn-xs btn-success btnEdit" href="<?php echo base_url(); ?>index.php/Orders/feedback/<?php echo $obj['id']; ?>"><i style="color:#fff;" class="fa fa-comments"></i></a>

                <a class="btn btn-xs btn-info btnEdit" data-toggle="modal" data-target="#view<?php echo $obj['id']; ?>"><i style="color:#fff;" class="fa fa-eye"></i></a>
                <?php if ($role_id != 2) { ?>

                  <?php if (($obj['projectstatus'] == 'Delivered') ||  ($obj['projectstatus'] == 'Feedback Delivered') || ($obj['projectstatus'] == 'Draft Delivered')) { ?>
                    <a class="btn btn-xs btn-success btnEdit" href="<?php echo base_url(); ?>index.php/Orders/UploadOrder/<?php echo $obj['id']; ?>"><i style="color:#fff;" class="fa fa-check"></i></a>

                  <?php }
                  ?>

                  <a class="btn btn-xs btn-success btnEdit" href="<?php echo base_url(); ?>index.php/Orders/EditOrderFile/<?php echo $obj['id']; ?>"><i style="color:#fff;" class="fa fa-upload"></i></a>

                  <a class="btn btn-xs  btn-secondary btnEdit" href="<?php echo base_url(); ?>index.php/Orders/callstatus/<?php echo $obj['id']; ?>"><i style="color:#fff;" class="fa fa-phone"></i></a>

                  <!-- <a class="btn btn-xs btn-info btnEdit" data-toggle="modal" data-target="#view<?php echo $obj['id']; ?>"><i style="color:#fff;"class="fa fa-eye"></i></a> -->

                  <a class="btn btn-xs btn-success btnEdit" href="<?php echo base_url(); ?>index.php/Orders/Emails/<?php echo $obj['uid']; ?>"><i class="fa fa-envelope"></i></a>

                  <a class="btn btn-xs btn-danger btnEdit" data-toggle="modal" data-target="#delete<?php echo $obj['id']; ?>"><i style="color:#fff;" class="fa fa-trash"></i></a>

                  <?php if (($obj['projectstatus'] != 'Feedback Delivered') || ($obj['paymentstatus'] != 'Completed')) { ?>
                    <?php if ($role_id == 1) { ?>
                      <a href="<?php echo base_url(); ?>index.php/Orders/edit/<?php echo $obj['order_id']; ?>" class="btn btn-xs btn-primary btnEdit"> <i style="color:#fff;" class="fa fa-edit"></i>
                      </a>
                    <?php } ?>
                  <?php } ?>
                  <?php if ($obj['paymentstatus'] != 'Completed') { ?>
                    <a href="<?php echo base_url(); ?>index.php/Orders/payments/<?php echo $obj['id']; ?>" class="btn btn-xs btn-primary btnPayment"> <i style="color:#fff;" class="fa fa-money"> Add Payment</i>
                    </a>

                <?php }
                } ?>

              </td>
              <div class="modal fade" id="download<?php echo $obj['id']; ?>" role="dialog" tabindex="-1" aria-labelledby="classInfo" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title"><?php echo $obj['order_id']; ?> Details </h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
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
              <div class="modal fade" id="view<?php echo $obj['id']; ?>" role="dialog" tabindex="-1" aria-labelledby="classInfo" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title"><?php echo $obj['order_id']; ?> Details </h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>

                    </div>
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-md-12">
                          <?php //if($role_id != '3') { 
                          ?>
                          <fieldset>
                            <legend> Customer Details</legend>
                            <div class="row">
                              <div class="col-md-6 col-sm-6 ">
                                <label class="control-label">Customer Name :</label>
                                <span> <?php echo $obj['c_name']; ?></span>
                              </div>
                              <div class="col-md-6 col-sm-6 ">
                                <label class="control-label">Email :</label>
                                <span> <?php echo $obj['c_email']; ?></span>
                              </div>
                              <div class="col-md-6 col-sm-6 ">
                                <label class="control-label">Mobile :</label>
                                <span> <?php echo '+' . $obj['countrycode'] . ' - ' . $obj['c_mobile']; ?></span>
                              </div>
                            </div>
                          </fieldset>
                          <?php // } 
                          ?>
                          <fieldset>
                            <legend> Order Details</legend>
                            <div class="col-md-6 col-sm-6 ">
                              <label class="control-label">Order Type :</label>
                              <span> <?php echo $obj['order_type']; ?></span>
                            </div>
                            <div class="col-md-6 col-sm-6 ">
                              <label class="control-label">Project Title:</label>
                              <span> <?php echo $obj['title']; ?></span>
                            </div>
                            <div class="col-md-6 col-sm-6 ">
                              <label class="control-label">Order Id :</label>
                              <span> <?php echo $obj['order_id']; ?></span>
                            </div>
                            <div class="col-md-6 col-sm-6 ">
                              <label class="control-label">Order Date :</label>
                              <span> <?php echo date('d-M-Y', strtotime($obj['order_date'])); ?></span>
                            </div>
                            <div class="col-md-6 col-sm-6 ">
                              <label class="control-label">Delivery Date :</label>
                              <span> <?php echo date('d-M-Y', strtotime($obj['delivery_date'])); ?></span>
                            </div>
                            <div class="col-md-6 col-sm-6 ">
                              <label class="control-label">Type Of Service :</label>
                              <span> <?php echo $obj['services']; ?></span>
                            </div>
                            <div class="col-md-6 col-sm-6 ">
                              <label class="control-label">Formatting:</label>
                              <span> <?php echo $obj['formatting']; ?></span>
                            </div>
                            <div class="col-md-6 col-sm-6 ">
                              <label class="control-label">Type Of Paper:</label>
                              <span> <?php echo $obj['typeofpaper']; ?></span>
                            </div>
                            <div class="col-md-6 col-sm-6 ">
                              <label class="control-label">Type Of Writting:</label>
                              <span> <?php echo $obj['typeofwritting']; ?></span>
                            </div>
                            <div class="col-md-6 col-sm-6 ">
                              <label class="control-label">Pages:</label>
                              <span> <?php echo $obj['pages']; ?></span>
                            </div>
                            <!--  <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label">Number Of Sources:</label>
                                    <span> <?php echo $obj['numberofsources']; ?></span>
                                  </div> -->
                            <div class="col-md-6 col-sm-6 ">
                              <label class="control-label">Deadline:</label>
                              <span> <?php echo $obj['deadline']; ?> Day</span>
                            </div>
                            <!--  <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label">Actual Amount:</label>
                                    <span> <?php echo $obj['actual_amount']; ?> &#163;</span>
                                  </div> -->
                            <div class="col-md-6 col-sm-6 ">
                              <label class="control-label">Discount % :</label>
                              <span> <?php echo $obj['discount_per']; ?> %</span>
                            </div>
                            <div class="col-md-6 col-sm-6 ">
                              <label class="control-label">Final Amount:</label>
                              <span> <?php echo $obj['amount']; ?> &#163;</span>
                            </div>
                            <div class="col-md-6 col-sm-6 ">
                              <label class="control-label">Paid Amount:</label>
                              <span> <?php echo $obj['received_amount']; ?> &#163;</span>
                            </div>
                            <div class="col-md-6 col-sm-6 ">
                              <label class="control-label">Due Amount:</label>
                              <span> <?php echo $obj['amount'] - $obj['received_amount']; ?> &#163;</span>
                            </div>
                            <div class="col-md-6 col-sm-6 ">
                              <label class="control-label">Payment Status:</label>
                              <span> <?php echo $obj['paymentstatus']; ?></span>
                            </div>
                            <div class="col-md-6 col-sm-6 ">
                              <label class="control-label">Project Status:</label>
                              <span> <?php echo $obj['projectstatus']; ?></span>
                            </div>
                            <div class="col-md-6 col-sm-6 ">
                              <label class="control-label">Message:</label>
                              <span> <?php echo $obj['message']; ?></span>
                            </div>
                        </div>
                      </div>


                      <fieldset>
                        <legend> Documents Details</legend>

                        <?php

                        if (!empty($obj['order_file_details'])) {
                          $j = 1;
                          foreach ($obj['order_file_details'] as  $file_details) {  ?>

                            <div class="row">
                              <div class="col-md-12">
                                <div class="col-md-4 col-sm-4">
                                  <label><?= $j ?></label>
                                </div>
                                <div class="col-md-8 col-sm-8 ">
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
                            </div>
                            <hr>

                        <?php $j++;
                          }
                        } ?>
                      </fieldset>
                      <?php if ($obj['projectstatus'] == 'Completed') { ?>
                        <fieldset>
                          <legend> Completed Assignment File </legend>

                          <div class="row">
                            <div class="col-md-12">
                              <div class="col-md-4 col-sm-4">
                                <label> Uploaded File from Assignmentinneed.com</label>
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
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal fade" id="delete<?php echo $obj['id']; ?>" role="dialog">
                <div class="modal-dialog">
                  <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Orders/deleteorder/<?php echo $obj['id']; ?>">
                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Confirm Header </h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                      </div>
                      <div class="modal-body">
                        <p>Are you sure, you want to delete Order <b><?php echo $obj['order_id']; ?> </b>? </p>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary ">Submit</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>

              <!-------------- Approved Requisition Slip Modal Code Start  ---------------->
              <div class="modal fade" id="approve<?php echo $obj['id']; ?>" role="dialog">
                <div class="modal-dialog">
                  <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Orders/ActionOrder" enctype="multipart/form-data">
                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header" style="background-color: #168c56;color: azure;">
                        <h4 class="modal-title">Confirm Header </h4>
                        <button type="button" class="close" data-dismiss="modal" style="color: azure;">&times;</button>
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
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <!--------------  Approved Requisition Slip Modal Code End  ------------ -->

            </tr>
          <?php $i++;
          } ?>
        </tbody>
      </table>
      <?php if (empty($from_date)) { ?>
        <div class="pagination">
          <?php echo $links; ?> </p>
        </div>
      <?php } ?>
    </div>
  </div>
</div>
</div>


<script src="<?php echo base_url() . "assets/"; ?>plugins/jquery/jquery.min.js"></script>
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
      //alert(allVals.length); return false;  
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

  });
</script>
<script type="text/javascript">
  $(document).ready(function() {
    var base_url = '<?php echo base_url(); ?>';
    //alert(base_url);
    $(document).on('change', '.category', function() {
      var category_id = $('.category').find('option:selected').val();
      //var aa= base_url+"index.php/Meenus/rolewisedata/"+role_id;
      //alert(category_id);
      $.ajax({
        type: "POST",
        url: "<?php echo base_url('index.php/Customers/getcustomerByCategory/') ?>" + category_id,
        //data: {id:role_id},
        dataType: 'html',
        success: function(response) {
          //alert(response);
          $(".customers").html(response);
          $('.select2').select2();
          //$('.category').find('option:selected').prop('required',true);

        }
      });
    });
  });
</script>