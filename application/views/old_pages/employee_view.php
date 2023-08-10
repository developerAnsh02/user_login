<?php
defined('BASEPATH') or exit('No direct script access allowed');
$role_id = $this->session->userdata['logged_in']['role_id'];
//print_r($employees);exit;
?>

<style type="text/css">
  .btnEdit {
    width: 25%;
    border-radius: 5px;
    margin: 1px;
    padding: 1px;
  }

  .col-sm-6,
  .col-md-6 {
    float: left;
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
      <span class="card-title"><?php echo $title; ?>
      </span>
      <div class="button-group float-right">

        <a href="<?php echo base_url(); ?>index.php/Employees/add" class="btn btn-success" data-toggle="tooltip" title="New Employee"><i class="fa fa-plus"></i></a>

        <button class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="location.reload();"><i class="fa fa-refresh"></i></button>

        <button class="btn btn-danger delete_all" data-toggle="tooltip" title="Bulk Delete"><i class="fa fa-trash"></i></button>

      </div>
    </div> <!-- /.card-body -->
    <div class="card-body">
      <form method="get" id="filterForm">
        <div class="row">
          <div class="col-md-6 col-sm-6 ">
            <label class="control-label">Name of user <span class="required">*</span></label>
            <select name="customer_id" class="form-control select2 customers">
              <option value="0"> Select User</option>
              <?php
              if ($all_customers) : ?>
                <?php
                foreach ($all_customers as $value) : ?>
                  <?php
                  if ($value['id'] == @$customer_id) : ?>
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

          <div class="col-md-3 col-sm-3 ">
            <label class="control-label" style="visibility: hidden;"> Grade</label><br>
            <input type="submit" class="btn btn-primary" value="Search" />
            <label class="control-label" style="visibility: hidden;"> Grade</label>
            <a href="index" class="btn btn-danger"> Reset</a>
          </div>

        </div>
      </form>
      <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th><input type="checkbox" id="master"></th>
              <th>Sr.No.</th>
              <th> Name </th>
              <th style="white-space: nowrap;"> Email </th>
              <th style="white-space: nowrap;"> Mobile</th>
              <th style="white-space: nowrap;"> Role</th>
              <th style="white-space: nowrap;"> Photo</th>
              <th style="white-space: nowrap;width: 20%;"> Action Button</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $i = 1;
            foreach ($employees as $obj) { ?>
              <tr>
                <td><input type="checkbox" class="sub_chk" value="<?php echo $obj['id']; ?>" /></td>
                <td><?php echo $i; ?></td>
                <td><?php echo $obj['name']; ?></td>
                <td><?php echo $obj['email']; ?></td>

                <td><?php echo ' (+' . $obj['cnty_code'] . ') ' . $obj['mobile_no']; ?></td>
                <td><?php echo $obj['role']; ?></td>
                <td>
                  <?php if (!empty($obj['photo'])) { ?>
                    <div style="height: 10%;width: 100%;">
                      <img src="<?php echo base_url() . '/uploads/' . $obj['photo']; ?>" width="100%;" />
                    </div>
                  <?php } ?>
                </td>
                <td>
                  <!-- <a class="btn btn-xs btn-info btnEdit" data-toggle="modal" data-target="#view<?php echo $obj['id']; ?>"><i style="color:#fff;"class="fa fa-eye"></i></a> -->

                  <a class="btn btn-xs btn-primary btnEdit" href="<?php echo base_url(); ?>index.php/Employees/edit/<?php echo $obj['id']; ?>"><i class="fa fa-edit"></i></a>
                  <?php if ($role_id == 1) { ?>
                    <a class="btn btn-xs btn-danger btnEdit" data-toggle="modal" data-target="#delete<?php echo $obj['id']; ?>"><i style="color:#fff;" class="fa fa-trash"></i></a>
                  <?php } ?>
                  <!--   <a href="<?php //echo base_url(); 
                                  ?>index.php/welcome/deleteSupplier/<?php echo $obj['id']; ?>"
                   onclick="return confirm(\'Confirm Deletion.\')">Delete</a> -->
                </td>
                <div class="modal fade" id="delete<?php echo $obj['id']; ?>" role="dialog">
                  <div class="modal-dialog">
                    <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Employees/deleteEmployee/<?php echo $obj['id']; ?>">
                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Confirm Header </h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>

                        </div>
                        <div class="modal-body">
                          <p>Are you sure, you want to delete User <b><?php echo $obj['name']; ?> </b>? </p>
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-primary ">Submit</button>
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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

        <div>
          <p><?php echo $links; ?></p>
        </div>

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
    jQuery('.delete_all').on('click', function(e) {
      var allVals = [];
      $(".sub_chk:checked").each(function() {
        allVals.push($(this).val());
      });
      //alert(allVals.length); return false;  
      if (allVals.length <= 0) {
        alert("Please select row.");
      } else {
        WRN_PROFILE_DELETE = "Are you sure you want to delete all selected records?";
        var check = confirm(WRN_PROFILE_DELETE);
        if (check == true) {
          var join_selected_values = allVals.join(",");
          $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>index.php/Employees/deleteEmployee",
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