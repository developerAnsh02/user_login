<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$base= base_url();
$hyperlink_orders=$base.'index.php/Orders/add';
$notification_orders=$base.'index.php/Orders/feedbackall';
$this->load->model('order_model');
$notify_url=$base.'index.php/Orders/feedback';
$notification=$this->order_model->feedback_notification();
//print_r($notification); exit;
//print_r($hyperlink_ordes);exit;
?>

  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
     <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
      <!--  <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo $hyperlink_orders ;?>" class="btn btn-md btn-info float-left">Place New Order</a>
      </li> -->
     
    </ul>
     <ul class="navbar-nav" style="padding-left:20%;">
        <li class="nav-item">
            <a href="<?php echo $hyperlink_orders ;?>" class="btn btn-md btn-info float-left">Place New Order</a>
        </li>
     </ul> 
    <ul class="navbar-nav ml-auto">
	
		  <li class="nav-item dropdown" style="font-size: 30px;">
        <a class="nav-link" data-toggle="dropdown" href="#">
         
          <span class="badge badge-primary  navbar-badge btn" style="margin-top: -8px;border-radius:42%"> <i style="color:#fff;" class="fa fa-comments"></i> <sup style="color: #fff;"> <?php echo sizeof($notification); ?></sup></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="width: 500px;">
          <span class="dropdown-item dropdown-header"><?php echo sizeof($notification); ?> Notifications</span>
		  <?php if(sizeof($notification)>0){ 
			foreach($notification as $notify){
			?>
          <div class="dropdown-divider"></div>
          <a href="<?php echo $notify_url ?>/<?php echo $notify['order_id'];?>/notify" class="dropdown-item">
            <?= $notify['code']; ?>  <?= $notify['title']; ?>
           
          </a>
			<?php } } ?>
          <div class="dropdown-divider"></div>
          <a href="<?= $notification_orders ?>/notify" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
	  
	  
      <li class="nav-item" >
        <a href="<?php echo base_url();?>index.php/User_authentication/logout" class="btn btn-info" style="background-color: #355fa9   !important;border-color:#355fa9  ;"><i class="fa fa-power-off" ></i></a>
      </li>
     
	  <!-- Notifications Dropdown Menu -->
    
	  
	  
    </ul>

  </nav>

    <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #ffffff !important;">

    <!-- Brand Logo -->
    <a href="<?php echo base_url(); ?>index.php/User_authentication/dashboard" class="brand-link">
      <img src="<?php echo base_url(); ?>uploads/assignment_logo.png" alt="AdminLTE Logo" class="brand-image img-square " >
    </a>
    <a href="" class="brand-link">
     <span class="brand-text font-weight-bold" style="font-size: 19px !important;color: #000;">Assignment In Need</span>
   </a>
