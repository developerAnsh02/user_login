<?php
defined('BASEPATH') or exit('No direct script access allowed');
$current_page = current_url();
//$current_page='https://www.muskowl.com/chaudhary_minerals/index.php/Meenus/UserRights';
$data = explode('?', $current_page);
$role_id = $this->session->userdata['logged_in']['role_id'];
//echo $session_data['role_id'];exit;
//print_r($data[0]);exit;
?>


<?php if ($this->session->flashdata('success')) : ?>
  <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fa fa-check"></i> Success!</h5>
    <?php echo $this->session->flashdata('success'); ?>
  </div>
  <span class="successs_mesg"><?php echo $this->session->flashdata('success'); ?></span>
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
        <button class="btn btn-success sendmail" data-toggle="tooltip" title="Send Mail"> Send To mail <i class="fa fa-envelope"></i></button>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th><input type="checkbox" id="master"></th>
              <th>Sr.No.</th>
              <th style="white-space: nowrap;"> Order Code </th>
              <th style="white-space: nowrap;"> Order Date</th>
              <th style="white-space: nowrap;"> Delivery Date</th>
              <th> Title </th>
              <th> Words</th>
              <th> Amount </th>
              <?php if ($role_id == 1) { ?>
                <th> Paid </th>
                <th> Remaining </th>
              <?php } ?>
              <th style="white-space: nowrap;"> Project Status</th>
              <th style="white-space: nowrap;width: 20%;"> Action Button</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $i = 1;
            foreach ($orders as $obj) { ?>
              <tr>
                <td><input type="checkbox" class="sub_chk" checked value="<?php echo $obj['id']; ?>" /></td>
                <td><?php echo $i; ?></td>
                <td><?php echo $obj['order_id']; ?></td>
                <td><?php echo date('d-M-Y', strtotime($obj['order_date'])); ?></td>
                <td><?php echo date('d-M-Y', strtotime($obj['delivery_date'])); ?></td>
                <td><?php echo $obj['title']; ?></td>
                <td><?php $data = $obj['pages'];
                    $data1 = explode(' (', $data);
                    $data_new = explode(' ', $data1['1']);
                    print_r($data_new['0']);
                    ?></td>
                <td><?php echo $obj['amount']; ?> &#163;</td>
                <?php if ($role_id == 1) { ?>
                  <td><?php echo $obj['received_amount']; ?> &#163;</td>
                  <td><?php echo $obj['amount'] - $obj['received_amount']; ?> &#163;</td>
                <?php } ?>
                <td><?php echo $obj['projectstatus']; ?></td>
                <td>
                  <a class="btn btn-xs btn-info btnEdit" data-toggle="modal" data-target="#view<?php echo $obj['id']; ?>"><i style="color:#fff;" class="fa fa-eye"></i></a>
                </td>
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

                              <div class="col-md-6 col-sm-6 ">
                                <label class="control-label">Deadline:</label>
                                <span> <?php echo $obj['deadline']; ?></span>
                              </div>
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

                          <?php $j = 1;
                          foreach ($obj['order_file_details'] as  $file_details) { ?>

                            <div class="row">
                              <div class="col-md-12">
                                <div class="col-md-4 col-sm-4">
                                  <label><?= $j ?></label>
                                </div>
                                <div class="col-md-8 col-sm-8 ">
                                  <label class="control-label">Uploaded File :</label>
                                  <div style="height: 10%;width: 100%;">
                                    <a href="<?php echo base_url() . '/uploads/' . $file_details['file']; ?>" target="_blank"> <?= $file_details['file'] ?></a>
                                  </div>

                                </div>
                              </div>
                            </div>
                            <hr>

                          <?php $j++;
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

              </tr>
            <?php $i++;
            } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<script src="<?php echo base_url() . "assets/"; ?>plugins/jquery/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {

    jQuery('#master').on('click', function(e) {
      if ($(this).is(':checked', true)) {
        $(".sub_chk").prop('checked', true);
      } else {
        $(".sub_chk").prop('checked', false);
      }
    });
    jQuery('.sendmail').on('click', function(e) {
      var allVals = [];
      $(".sub_chk:checked").each(function() {
        allVals.push($(this).val());
      });
      //alert(allVals.length); return false;  
      if (allVals.length <= 0) {
        alert("Please select row.");
      } else {
        WRN_PROFILE_DELETE = "Are you sure you want to send all selected order into mail?";
        var check = confirm(WRN_PROFILE_DELETE);
        if (check == true) {
          var join_selected_values = allVals.join(",");
          $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>index.php/Orders/sendMail",
            cache: false,
            data: 'ids=' + join_selected_values,
            success: function(response) {

              console.log(response);
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