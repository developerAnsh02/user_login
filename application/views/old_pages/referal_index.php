<?php
defined('BASEPATH') or exit('No direct script access allowed');
$base = base_url();
$hyperlink_ordes = $base . 'index.php/Orders/index';
$hyperlink_customers = $base . 'index.php/Employees/index';
//print_r($hyperlink_ordes);exit;
?>

<style type="text/css">
  .col-md-4 {
    float: left;
  }
</style>
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
<section class="content">
  <div class="container-fluid">
    <div class="card card-primary card-outline">
      <div class="card-header">
        <h3 class="card-title"><?= $title ?></h3>
        <div class="pull-left" style="background: #60f19a;padding: 6px;"> Wallet Amount: <?php echo @$wallets[0]['referral_amount']; ?></div>
        <div class="pull-right error_msg">
          <a href="<?php echo base_url(); ?>index.php/Referrals/add" class="btn btn-success" data-toggle="tooltip" title="Create New Order"><i class="fa fa-plus"></i></a>

          <button class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="location.reload();"><i class="fa fa-refresh"></i></button>

          <!--  <button class="btn btn-danger delete_all" data-toggle="tooltip" title="Bulk Delete" ><i class="fa fa-trash"></i></button>   -->
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <!--  <th><input type="checkbox" id="master"></th> -->
                <th>Sr.No.</th>
                <th> Friend Name</th>
                <th> Friend Email </th>
                <th> Mobile Number</th>
                <th> Refer By </th>
                <!-- <th style="white-space: nowrap;width: 20%;"> Action Button</th> -->
              </tr>
            </thead>
            <tbody>
              <?php $i = 1;
              foreach ($referals as $obj) { ?>
                <tr>
                  <!-- <td><input type="checkbox" class="sub_chk" value="<?php echo $obj['id']; ?>" /></td> -->
                  <td><?php echo $i; ?></td>
                  <td><?php echo $obj['friendname']; ?></td>
                  <td><?php echo $obj['friendemail']; ?></td>
                  <td><?php echo $obj['country_name'] . ' - ' . $obj['phone']; ?></td>
                  <td><?php echo $obj['referby']; ?></td>
                </tr>
              <?php $i++;
              } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>