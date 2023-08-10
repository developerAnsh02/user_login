<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//print_r($menuList);exit;
function time_Ago($time) { 
  
    // Calculate difference between current 
    // time and given timestamp in seconds 
    $diff     = time() - $time; 
      
    // Time difference in seconds 
    $sec     = $diff; 
      
    // Convert time difference in minutes 
    $min     = round($diff / 60 ); 
      
    // Convert time difference in hours 
    $hrs     = round($diff / 3600); 
      
    // Convert time difference in days 
    $days     = round($diff / 86400 ); 
      
    // Convert time difference in weeks 
    $weeks     = round($diff / 604800); 
      
    // Convert time difference in months 
    $mnths     = round($diff / 2600640 ); 
      
    // Convert time difference in years 
    $yrs     = round($diff / 31207680 ); 
      
    // Check for seconds 
    if($sec <= 60) { 
        echo "$sec seconds ago"; 
    } 
      
    // Check for minutes 
    else if($min <= 60) { 
        if($min==1) { 
            echo "one minute ago"; 
        } 
        else { 
            echo "$min minutes ago"; 
        } 
    } 
      
    // Check for hours 
    else if($hrs <= 24) { 
        if($hrs == 1) {  
            echo "an hour ago"; 
        } 
        else { 
            echo "$hrs hours ago"; 
        } 
    } 
      
    // Check for days 
    else if($days <= 7) { 
        if($days == 1) { 
            echo "Yesterday"; 
        } 
        else { 
            echo "$days days ago"; 
        } 
    } 
      
    // Check for weeks 
    else if($weeks <= 4.3) { 
        if($weeks == 1) { 
            echo "a week ago"; 
        } 
        else { 
            echo "$weeks weeks ago"; 
        } 
    } 
      
    // Check for months 
    else if($mnths <= 12) { 
        if($mnths == 1) { 
            echo "a month ago"; 
        } 
        else { 
            echo "$mnths months ago"; 
        } 
    } 
      
    // Check for years 
    else { 
        if($yrs == 1) { 
            echo "one year ago"; 
        } 
        else { 
            echo "$yrs years ago"; 
        } 
    } 
}  
// Initialize current time 
/*$curr_time="2019-01-05 09:09:09"; 
  
$time_ago =strtotime($curr_time); 
// Display the time ago 
time_Ago($time_ago); */
?>
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
            <div class="pull-right ">
                
            </div>
        </div>
        <div class="card-body">
           <div class="row">
            <div class="col-md-12">
              <div class="card card-info">
              <div class="card-header"  style="background-color: #2576ce    !important;">
                <h5 class="card-title"> 
                  <i class="fa fa-bell"  ></i> Your Notifications </h5>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                 <div class="table-responsive">
                 <table id="example1" class="table table-bordered table-striped">
                  <thead>
                        <tr>
                          <th >Sr.No.</th>
                          <th >Notification </th>
                          <th >Action Time.</th>
                        </tr>
                    </thead>
                      <tbody>
                         <?php $i=1; foreach ($allnotifications as $key => $value) { ?>
                          <tr>
                            <td> <?= $i ?></td>
                                <td> 
                                  <?php if($value['employee_id']!='0') { ?>

                                      <b><?= $value['created_by']?> </b> <?= $value['message']?> <b><?= $value['requestor']?> </b>.Click here to 
                                  <a class="mark_read" href="<?php echo base_url(); ?>index.php/<?= $value['page_url']?>"> <b>View</b></a>

                                  <?php }else{ ?>

                                      <b><?= $value['created_by']?> </b> <?= $value['message']?> .Click here to 
                                  <a class="mark_read" href="<?php echo base_url(); ?>index.php/<?= $value['page_url']?>"> <b>View</b></a>

                                  <?php } ?>
                                </td>
                                <td>
                                  <span class="float-right " >
                                    <?php
                                      $curr_time=$value['created_on'];
                                      $timea=strtotime($curr_time);
                                      echo time_Ago($timea); 
                                      ?>
                                    </span>
                                </td>
                                 <!--  <td>
                                   <a class="btn btn-xs btn-defaul btnEdit" data-toggle="modal" data-target="#delete<?= $value['id']?>"><b style="color:#0c6ed8;"> Clear notification</b></a>

                                    <div class="modal fade" id="delete<?= $value['id']?>" role="dialog">
                                    <div class="modal-dialog">
                                      <form class="form-horizontal" role="form" method="post" action="<?php //echo base_url(); ?>index.php/Notifications/deleteNotification/<?= $value['id']?>">
                                      
                                      <div class="modal-content">
                                        <div class="modal-header">
                                           <h4 class="modal-title">Confirm Header </h4>
                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                         
                                        </div>
                                        <div class="modal-body">
                                          <p>Are you sure, you want to Clear this notification ? </p>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="submit" class="btn btn-primary delete_submit"> Yes </button>
                                          <button type="button" class="btn btn-danger" data-dismiss="modal"> No </button>
                                        </div>
                                      </div>
                                      </form>
                                    </div>
                                  </div>
                              </td> -->

                          </tr>
                         
                           <?php  $i++; } ?> 

                      </tbody>
                    </table>
                 </div>
              </div>
            </div>
          </div>
        </div>
          <!--   <div class="row">
            <div class="col-md-12">
            <div class="card card-info">
              <div class="card-header"  style="background-color: #484843 !important;">
                <h5 class="card-title"> 
                <i class="fa fa-bell"  ></i> Notification Panel (<?= $total_notifications?>)</h5>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <?php foreach ($allnotifications as $key => $value) { ?>
                    <div class="progress-group" >
                      <fieldset>
                        <legend style="padding: 0px;"> <?= $value['subject']?> </legend>
                       <?= $value['message']?>  <b><?= $value['employee']?> </b>.
                      <a href="<?php echo base_url(); ?>index.php/<?= $value['page_url']?>"> View</a>
                      <span class="float-right " >
                      
                      <?php
                        $curr_time=$value['created_on'];
                        $timea=strtotime($curr_time);
                        echo time_Ago($timea); 
                        ?>
                      </span>

                      </fieldset> 

                        
                    </div>
               <?php  } ?>  -->
              <!-- /.progress-group -->
              <!-- <div class="progress-group">
                <span class="progress-text">Visit Premium Page</span>
                <span class="float-right"><b>480</b>/800</span>
                <div class="progress progress-sm">
                  <div class="progress-bar bg-success" style="width: 60%"></div>
                </div>
              </div> 
              </div>
             
            </div>
          </div>
          </div>-->

          <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fa fa-gear"></i></span>

              <div class="info-box-content">
                <span class="info-box-text"> Total Products</span>
                <span class="info-box-number">
                  <?= $TotalProducts ?>
                  <small></small>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-google-plus"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Employees</span>
                <span class="info-box-number"><?= $TotalEmployees ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fa fa-shopping-cart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Purchase Orders</span>
                <span class="info-box-number"><?= $TotalOrders ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text"> Total Suppliers</span>
                <span class="info-box-number"><?= $total_suupliers ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
         <div class="card-footer">
                <div class="row">
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-success"><i class="fa fa-caret-up"></i> 17%</span>
                      <h5 class="description-header"> &#8377; 35,210.43</h5>
                      <span class="description-text">TOTAL REVENUE</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-warning"><i class="fa fa-caret-left"></i> 0%</span>
                      <h5 class="description-header">&#8377; 10,390.90</h5>
                      <span class="description-text">TOTAL COST</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-success"><i class="fa fa-caret-up"></i> 20%</span>
                      <h5 class="description-header"> &#8377;24,813.53</h5>
                      <span class="description-text">TOTAL PROFIT</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 col-6">
                    <div class="description-block">
                      <span class="description-percentage text-danger"><i class="fa fa-caret-down"></i> 18%</span>
                      <h5 class="description-header">1200</h5>
                      <span class="description-text">GOAL COMPLETIONS</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                </div>
                <!-- /.row -->
              </div>
              <br>
        <div class="row">
             <div class="col-md-6">
            <!-- Bar chart -->
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fa fa-bar-chart-o"></i>
                  Bar Chart
                </h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-widget="collapse">
                    <i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-widget="remove">
                    <i class="fa fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div id="bar-chart" style="height: 300px;"></div>
              </div>
              <!-- /.card-body-->
            </div>
          </div>
            <!-- /.card -->
          <div class="col-md-6">
            <!-- Donut chart -->
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fa fa-bar-chart-o"></i>
                  Donut Chart
                </h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div id="donut-chart" style="height: 300px;"></div>
                </div>
              </div>
            </div>
          <div class="col-md-12">
            <!-- AREA CHART -->
            <div class="card card-primary">
              <div class="card-header">
                <h5 class="card-title">Monthly Recap Report</h5>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="areaChart" style="height:250px"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <div class="col-md-12">
            <div class="card card-info">
              <div class="card-header">
                <h5 class="card-title">Goal Completion</h5>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <div class="progress-group">
                  Add Products to Cart
                  <span class="float-right"><b>160</b>/200</span>
                    <div class="progress progress-sm">
                      <div class="progress-bar bg-primary" style="width: 80%"></div>
                    </div>
                </div>
                 <div class="progress-group">Complete Purchase
                    <span class="float-right"><b>310</b>/400</span>
                    <div class="progress progress-sm">
                      <div class="progress-bar bg-danger" style="width: 75%"></div>
                    </div>
                </div>
                 <!-- /.progress-group -->
              <div class="progress-group">
                <span class="progress-text">Visit Premium Page</span>
                <span class="float-right"><b>480</b>/800</span>
                <div class="progress progress-sm">
                  <div class="progress-bar bg-success" style="width: 60%"></div>
                </div>
              </div>

              <!-- /.progress-group -->
              <div class="progress-group">
                Send Inquiries
                <span class="float-right"><b>250</b>/500</span>
                <div class="progress progress-sm">
                  <div class="progress-bar bg-warning" style="width: 50%"></div>
                </div>
              </div>
              <!-- /.progress-group -->
              </div>
              <!-- /.card-body -->
            </div>
          </div>
       
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
