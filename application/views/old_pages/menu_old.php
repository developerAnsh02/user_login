<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//print_r($menuList);exit;
?>

<?php
if (isset($this->session->userdata['logged_in'])) {
$user_id = $this->session->userdata['logged_in']['id'];
$username = $this->session->userdata['logged_in']['username'];
$email = $this->session->userdata['logged_in']['email'];
$name = $this->session->userdata['logged_in']['name'];
$role_id = $this->session->userdata['logged_in']['role_id'];
$role = $this->session->userdata['logged_in']['role'];
//$photo = $this->session->userdata['logged_in']['photo'];

//echo $username;exit;

}
else {
header("location: login");
}
 
?>
<div class="sidebar" style="background-color: #011111 !important;">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div>
         <!--  <img src="<?php echo base_url()."uploads/".$photo; ?>" class="img-circle " alt="User Image" style="width: 90%"> -->
          <div class="info" >
            <a href="#" class="d-block"> Name : <?php echo $name ;?></a>
            <a href="#" class="d-block"> Role : <?php echo $role ;?></a>
          </div>

        </div>
        <div class="info" >
        
          <a href="<?php echo base_url();?>index.php/User_authentication/MyPasswordChangeView" class="c-block"> Change Password</a>
        </div>
          <div class="info" >
         <!--  <a href="#" class="d-block"><?php echo $name ;?></a>
          <a href="#" class="d-block">(<?php echo $role ;?>)</a> -->
          <a href="<?php echo base_url();?>index.php/Employees/MyProfile/<?= $user_id ?>" class="d-block"> Profile</a>
        </div>
        
      </div>
      

      <!-- Sidebar Menu -->
       <nav class="mt-2">
        <?php  //echo base_url();
          echo $this->dynamic_menu->build_menu();
          //echo $userRightsIds;
        ?>
      </nav>


      <nav class="mt-2">
      
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
         
          <!--<li class="nav-item">
            <a href="<?php //echo base_url()."assets/"; ?>pages/widgets.html" class="nav-link">
              <i class="nav-icon fa fa-th"></i>
              <p>
                Widgets
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>-->
        
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>

  </aside>
 