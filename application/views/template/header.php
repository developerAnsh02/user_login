
<?php
defined('BASEPATH') or exit('No direct script access allowed');
$base = base_url();
$hyperlink_orders = $base . 'index.php/Orders/add';
$notification_orders = $base . 'index.php/Orders/feedbackall';
$this->load->model('order_model');
$notify_url = $base . 'index.php/Orders/feedback';
$notification = $this->order_model->feedback_notification();
$notificationw = $this->order_model->writer_notification();
$notificationc = $this->order_model->client_notification();
$notificationadmin = $this->order_model->adminwriter_notification();



$user_details = $this->session->userdata('logged_in');


?>
<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<?php
if (isset($this->session->userdata['logged_in'])) {
    $user_id = $this->session->userdata['logged_in']['id'];
    $email = $this->session->userdata['logged_in']['email'];
    $email = $this->session->userdata['logged_in']['email'];
    $name = $this->session->userdata['logged_in']['name'];
    $role_id = $this->session->userdata['logged_in']['role_id'];
    $role = $this->session->userdata['logged_in']['role'];
   
} else {
    header("location: login");
}
?>
<style>
@media screen and (max-device-width:640px), screen and (max-width:992px)

  {

    .hide-mb
    {
      display: none;
    }

    .colo {
         background: #4f5467;
    }
    .logo-mb
    {
        width: 25px;
    }
        .logo-mb2
        {
            width: 60% !important;
        }

  }
</style>

<?php if($role_id == 2) {?>


    
		<!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" /> -->
		<!--end::Fonts-->
		<!--begin::Page Vendor Stylesheets(used by this page)-->
		<!-- <link href="<?php echo base_url(); ?>assets1/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" /> -->
		<!-- <link href="<?php echo base_url(); ?>assets1/plugins/custom/vis-timeline/vis-timeline.bundle.css" rel="stylesheet" type="text/css" /> -->
		<!--end::Page Vendor Stylesheets-->
		<!--begin::Global Stylesheets Bundle(used by all pages)-->
		<!-- <link href="<?php echo base_url(); ?>assets1/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" /> -->
		<link href="<?php echo base_url(); ?>assets1/css/style.bundle.css" rel="stylesheet" type="text/css" />

    <div id="kt_header" style="" class="header align-items-stretch">
		<!--begin::Container-->
		<div class="container-fluid d-flex align-items-stretch justify-content-between">
			<!--begin::Aside mobile toggle-->
			<div class="d-flex align-items-center d-lg-none ms-n2 me-2" title="Show aside menu">
				<div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px" id="kt_aside_mobile_toggle">
					<!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
					<span class="svg-icon svg-icon-1">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
							<path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="black" />
							<path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="black" />
						</svg>
					</span>
					<!--end::Svg Icon-->
				</div>
			</div>
			<!--end::Aside mobile toggle-->
			<!--begin::Mobile logo-->
			<div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
				<a href="../../demo1/dist/index.html" class="d-lg-none">
					<img alt="Logo" src="<?php echo base_url(); ?>uploads_old/assignment_logo.png" class="w-50px" />
				</a>
			</div>
			<!--end::Mobile logo-->
			<!--begin::Wrapper-->

            <div class="card-toolbar mt-5" >
				<a href="<?php echo base_url()?>/Orders/add" class="btn btn-sm btn-light btn-active-primary" >
				<!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
				<span class="svg-icon svg-icon-3">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
						<rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" />
						<rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
					</svg>
				</span>
				<!--end::Svg Icon-->New Orders</a>
			</div>
			
				<div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
					<!--begin::Navbar-->
					<div class="d-flex align-items-stretch" id="kt_header_nav">
						<!--begin::Menu wrapper-->
						<div class="header-menu align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_header_menu_mobile_toggle" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav'}">
							<!--begin::Menu-->
							<div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch" id="#kt_header_menu" data-kt-menu="true">
								
							</div>
							<!--end::Menu-->
						</div>
						<!--end::Menu wrapper-->
					</div>
                    
					<!--end::Navbar-->
					<!--begin::Toolbar wrapper-->
					
					<!--end::Toolbar wrapper-->
			</div>
			<div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
					<!--begin::Navbar-->
					<div class="d-flex align-items-stretch" id="kt_header_nav">
						<!--begin::Menu wrapper-->
						<div class="header-menu align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_header_menu_mobile_toggle" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav'}">
							<!--begin::Menu-->
							<div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch" id="#kt_header_menu" data-kt-menu="true">
								
							</div>
							<!--end::Menu-->
						</div>
						<!--end::Menu wrapper-->
					</div>
                    
					<!--end::Navbar-->
					<!--begin::Toolbar wrapper-->
					
					<!--end::Toolbar wrapper-->
			</div>
			<div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
					<!--begin::Navbar-->
					<div class="d-flex align-items-stretch" id="kt_header_nav">
						<!--begin::Menu wrapper-->
						<div class="header-menu align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_header_menu_mobile_toggle" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav'}">
							<!--begin::Menu-->
							<div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch" id="#kt_header_menu" data-kt-menu="true">
								
							</div>
							<!--end::Menu-->
						</div>
						<!--end::Menu wrapper-->
					</div>
                    
					<!--end::Navbar-->
					<!--begin::Toolbar wrapper-->
					
					<!--end::Toolbar wrapper-->
			</div>
			<div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
					<!--begin::Navbar-->
					<div class="d-flex align-items-stretch" id="kt_header_nav">
						<!--begin::Menu wrapper-->
						<div class="header-menu align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_header_menu_mobile_toggle" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav'}">
							<!--begin::Menu-->
							<div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch" id="#kt_header_menu" data-kt-menu="true">
								
							</div>
							<!--end::Menu-->
						</div>
						<!--end::Menu wrapper-->
					</div>
                    
					<!--end::Navbar-->
					<!--begin::Toolbar wrapper-->
					
					<!--end::Toolbar wrapper-->
			</div>
			<div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
					<!--begin::Navbar-->
					<div class="d-flex align-items-stretch" id="kt_header_nav">
						<!--begin::Menu wrapper-->
						<div class="header-menu align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_header_menu_mobile_toggle" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav'}">
							<!--begin::Menu-->
							<div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch" id="#kt_header_menu" data-kt-menu="true">
								
							</div>
							<!--end::Menu-->
						</div>
						<!--end::Menu wrapper-->
					</div>
                    
					<!--end::Navbar-->
					<!--begin::Toolbar wrapper-->
					
					<!--end::Toolbar wrapper-->
			</div>
			<div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
					<!--begin::Navbar-->
					<div class="d-flex align-items-stretch" id="kt_header_nav">
						<!--begin::Menu wrapper-->
						<div class="header-menu align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_header_menu_mobile_toggle" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav'}">
							<!--begin::Menu-->
							<div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch" id="#kt_header_menu" data-kt-menu="true">
								
							</div>
							<!--end::Menu-->
						</div>
						<!--end::Menu wrapper-->
					</div>
                    
					<!--end::Navbar-->
					<!--begin::Toolbar wrapper-->
					
					<!--end::Toolbar wrapper-->
			</div><div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
					<!--begin::Navbar-->
					<div class="d-flex align-items-stretch" id="kt_header_nav">
						<!--begin::Menu wrapper-->
						<div class="header-menu align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_header_menu_mobile_toggle" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav'}">
							<!--begin::Menu-->
							<div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch" id="#kt_header_menu" data-kt-menu="true">
								
							</div>
							<!--end::Menu-->
						</div>
						<!--end::Menu wrapper-->
					</div>
                    
					<!--end::Navbar-->
					<!--begin::Toolbar wrapper-->
					
					<!--end::Toolbar wrapper-->
			</div>
			<div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
					<!--begin::Navbar-->
					<div class="d-flex align-items-stretch" id="kt_header_nav">
						<!--begin::Menu wrapper-->
						<div class="header-menu align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_header_menu_mobile_toggle" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav'}">
							<!--begin::Menu-->
							<div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch" id="#kt_header_menu" data-kt-menu="true">
								
							</div>
							<!--end::Menu-->
						</div>
						<!--end::Menu wrapper-->
					</div>
                    
					<!--end::Navbar-->
					<!--begin::Toolbar wrapper-->
					
					<!--end::Toolbar wrapper-->
			</div>
			<div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
					<!--begin::Navbar-->
					<div class="d-flex align-items-stretch" id="kt_header_nav">
						<!--begin::Menu wrapper-->
						<div class="header-menu align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_header_menu_mobile_toggle" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav'}">
							<!--begin::Menu-->
							<div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch" id="#kt_header_menu" data-kt-menu="true">
								
							</div>
							<!--end::Menu-->
						</div>
						<!--end::Menu wrapper-->
					</div>
                    
					<!--end::Navbar-->
					<!--begin::Toolbar wrapper-->
					
					<!--end::Toolbar wrapper-->
			</div>
			
		
			<div class="d-flex align-items-stretch flex-shrink-0">
			    
			    
                        
						<div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
							<!--begin::Menu wrapper-->
							<div style='font-size:25px' class="cursor-pointer symbol symbol-30px symbol-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
								<i class="fa fa-bell" aria-hidden="true" ><?php echo sizeof($notification); ?></i>
							</div>
							<!--begin::User account menu-->
							<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px" data-kt-menu="true">
								<!--begin::Menu item-->
							
								<!--end::Menu item-->
								<!--begin::Menu separator-->
								<div class="separator my-2"></div>
								<!--end::Menu separator-->
								<!--begin::Menu item-->
								<div class="menu-item px-5">
								<span class="dropdown-item dropdown-header"><?php echo sizeof($notification); ?> Notifications</span>
								<?php if(sizeof($notification)>0){ 
                        			foreach($notification as $notify){
                        			?>
								</div>
								<!--end::Menu item-->
								<!--begin::Menu item-->
								
								<!--end::Menu item-->
								<!--begin::Menu item-->
								<div class="menu-item px-5">
								<a href="<?php echo $notify_url ?>/<?php echo $notify['order_id'];?>/notify" class="dropdown-item">
                                    <?= $notify['code']; ?>  <?= $notify['title']; ?>
                                   
                                  </a>
                        			<?php } } ?>
								</div>
								<!--end::Menu item-->
								<!--begin::Menu item-->
							
								<!--end::Menu item-->
								<!--begin::Menu separator-->
								<div class="separator my-2"></div>
								<!--end::Menu separator-->
								<!--begin::Menu item-->
						    	<!--<a href="<?= $notification_orders ?>/notify" class="dropdown-item dropdown-footer">See All Notifications</a>-->
								<!--end::Menu item-->
								<!--begin::Menu item-->
							
								<!--end::Menu item-->
								<!--begin::Menu item-->
								
								<!--end::Menu item-->
								<!--begin::Menu separator-->
								<div class="separator my-2"></div>
								<!--end::Menu separator-->
								<!--begin::Menu item-->
								
								<!--end::Menu item-->
							</div>
							<!--end::User account menu-->
							<!--end::Menu wrapper-->
						</div>
						<!--end::User menu-->
				
						<!--end::Header menu toggle-->
					</div>
					
					
					<div class="d-flex align-items-stretch flex-shrink-0">
			    
			    
                        
						<div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
							<!--begin::Menu wrapper-->
							<!--<div style='font-size:25px' class="cursor-pointer symbol symbol-30px symbol-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">-->
							<!--	<i class="fa fa-bell" aria-hidden="true" ></i>-->
							<!--</div>-->
							<!--begin::User account menu-->
							<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px" data-kt-menu="true">
								<!--begin::Menu item-->
							
								<!--end::Menu item-->
								<!--begin::Menu separator-->
								<div class="separator my-2"></div>
								<!--end::Menu separator-->
								<!--begin::Menu item-->
								<div class="menu-item px-5">
								<span class="dropdown-item dropdown-header"><?= sizeof($notificationc); ?> Writer Message</span>
                					<?php
                					// Retrieve distinct notifications based on order_code
                					$distinctNotificationsw = array_unique(array_column($notificationc, 'order_code'));
                
                					foreach ($distinctNotificationsw as $order_code) {
                						$notify = null;
                						// Replace 'your_login_id' with the actual login ID or retrieve it from your authentication system
                						// Assuming you have a $logged_in_user variable that holds the ID of the currently logged-in user
                						foreach ($notificationc as $item) {
                							if ($item['order_code'] == $order_code && $item['created_by'] !=  $user_id) {
                								$notify = $item;
                								break;
                							}
                						}
                						
                						if ($notify) {
                							?>
                							<div class="dropdown-divider"></div>
                							<a href="<?= base_url() ?>Orders/updateclient/<?= $notify['order_code']; ?>" class="dropdown-item">
                								<?= $notify['order_code']; ?>
                							</a>
                							<?php
                						}
                					}
                					?>
								</div>
								<!--end::Menu item-->
								<!--begin::Menu item-->
								
								<!--end::Menu item-->
								<!--begin::Menu item-->
								<div class="menu-item px-5">
								
								</div>
								<!--end::Menu item-->
								<!--begin::Menu item-->
							
								<!--end::Menu item-->
								<!--begin::Menu separator-->
								<div class="separator my-2"></div>
								<!--end::Menu separator-->
								<!--begin::Menu item-->
						    
								<!--end::Menu item-->
								<!--begin::Menu item-->
							
								<!--end::Menu item-->
								<!--begin::Menu item-->
								
								<!--end::Menu item-->
								<!--begin::Menu separator-->
								<div class="separator my-2"></div>
								<!--end::Menu separator-->
								<!--begin::Menu item-->
								
								<!--end::Menu item-->
							</div>
							<!--end::User account menu-->
							<!--end::Menu wrapper-->
						</div>
						<!--end::User menu-->
				
						<!--end::Header menu toggle-->
					</div>
			
			
			<div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
					<!--begin::Navbar-->
					<div class="d-flex align-items-stretch" id="kt_header_nav">
						<!--begin::Menu wrapper-->
						<div class="header-menu align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_header_menu_mobile_toggle" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav'}">
							<!--begin::Menu-->
							<div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch" id="#kt_header_menu" data-kt-menu="true">
								
							</div>
							<!--end::Menu-->
						</div>
						<!--end::Menu wrapper-->
					</div>
                    
					<!--end::Navbar-->
					<!--begin::Toolbar wrapper-->
					<div class="d-flex align-items-stretch flex-shrink-0">
                        
						<div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
							<!--begin::Menu wrapper-->
							<div class="cursor-pointer symbol symbol-30px symbol-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
								<img src="<?php echo base_url() ?>uploads/customers/logo.png" alt="user" />
							</div>
							<!--begin::User account menu-->
							<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px" data-kt-menu="true">
								<!--begin::Menu item-->
								<div class="menu-item px-3">
									<div class="menu-content d-flex align-items-center px-3">
										<!--begin::Avatar-->
										<div class="symbol symbol-50px me-5">
											<img alt="Logo" src="<?php echo base_url() ?>uploads/customers/logo.png" />
										</div>
										<!--end::Avatar-->
										<!--begin::Username-->
										<div class="d-flex flex-column">
											<div class="fw-bolder d-flex align-items-center fs-5"><?php echo  $name ?>
											<span class="badge badge-light-success fw-bolder fs-8 px-2 py-1 ms-2">User</span></div>
											<a href="#" class="fw-bold text-muted text-hover-primary fs-7"><?php echo  $email ?></a>
										</div>
										<!--end::Username-->
									</div>
								</div>
								<!--end::Menu item-->
								<!--begin::Menu separator-->
								<div class="separator my-2"></div>
								<!--end::Menu separator-->
								<!--begin::Menu item-->
								<div class="menu-item px-5">
									<a href="<?php echo base_url(); ?>index.php/Employees/MyProfile/<?= $user_id ?>" class="menu-link px-5">My Profile</a>
								</div>
								<!--end::Menu item-->
								<!--begin::Menu item-->
								
								<!--end::Menu item-->
								<!--begin::Menu item-->
								
								<!--end::Menu item-->
								<!--begin::Menu item-->
								<div class="menu-item px-5">
									<a href="<?php echo base_url(); ?>index.php/User_authentication/MyPasswordChangeView" class="menu-link px-5">Change Password</a>
								</div>
								<!--end::Menu item-->
								<!--begin::Menu separator-->
								<div class="separator my-2"></div>
								<!--end::Menu separator-->
								<!--begin::Menu item-->
							
								<!--end::Menu item-->
								<!--begin::Menu item-->
							
								<!--end::Menu item-->
								<!--begin::Menu item-->
								<div class="menu-item px-5">
									<a href="<?php echo base_url(); ?>index.php/User_authentication/logout" class="menu-link px-5">Sign Out</a>
								</div>
								<!--end::Menu item-->
								<!--begin::Menu separator-->
								<div class="separator my-2"></div>
								<!--end::Menu separator-->
								<!--begin::Menu item-->
								
								<!--end::Menu item-->
							</div>
							<!--end::User account menu-->
							<!--end::Menu wrapper-->
						</div>
						<!--end::User menu-->
				
						<!--end::Header menu toggle-->
					</div>
					<!--end::Toolbar wrapper-->
			</div>
			<!--end::Wrapper-->
		</div>
		<!--end::Container-->
	</div>


    <script>var hostUrl = "assets/";</script>
		<!--begin::Global Javascript Bundle(used by all pages)-->
		<script src="<?php echo base_url(); ?>assets1/plugins/global/plugins.bundle.js"></script>
		<script src="<?php echo base_url(); ?>assets1/js/scripts.bundle.js"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Page Vendors Javascript(used by this page)-->
		<script src="<?php echo base_url(); ?>assets1/plugins/custom/datatables/datatables.bundle.js"></script>
		<script src="<?php echo base_url(); ?>assets1/plugins/custom/vis-timeline/vis-timeline.bundle.js"></script>
		<!--end::Page Vendors Javascript-->
		<!--begin::Page Custom Javascript(used by this page)-->
		<script src="<?php echo base_url(); ?>assets1/js/widgets.bundle.js"></script>
		<script src="<?php echo base_url(); ?>assets1/js/custom/widgets.js"></script>
		<script src="<?php echo base_url(); ?>assets1/js/custom/apps/chat/chat.js"></script>
		<script src="<?php echo base_url(); ?>assets1/js/custom/utilities/modals/upgrade-plan.js"></script>
		<script src="<?php echo base_url(); ?>assets1/js/custom/utilities/modals/create-campaign.js"></script>
		<script src="<?php echo base_url(); ?>assets1/js/custom/utilities/modals/create-app.js"></script>
		<script src="<?php echo base_url(); ?>assets1/js/custom/utilities/modals/users-search.js"></script>

<?php } else { ?>
<body class="skin-default-dark fixed-layout">
  
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label"></p>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark colo" >
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header logo-mb" style="text-align:center;">
                    <!-- <div class="user-profile" style="margin-top: 5px !important;">
                        <div class="user-pro-body">
                            <div>
                                <img style="height:150%; weight: 100%;" src="<?php echo base_url(); ?>uploads/assignment_logo.png" alt="" class="img-circle">
                            </div>
                        </div>
                    </div> -->
                    <?php if($role_id == 6 || $role_id ==7) {?>
                     
                     <img src="https://www.assignnmentinneed.com/user_login/uploads/warlogo.jpeg" alt="" class="img-circle logo-mb2" style="width: 32%; background-color: #0c58b0; border-style: dotted;">
                    <?php } else { ?>
                    <img src="https://www.assignnmentinneed.com/user_login/uploads/logo-white.png" alt="" class="img-circle logo-mb2" style="width: 32%; ">
                    <?php } ?>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav me-auto">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler d-block d-md-none waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                        <li class="nav-item">
                            <a class="nav-link sidebartoggler d-none d-lg-block d-md-block waves-effect waves-dark" href="javascript:void(0)">
                                <i class="icon-menu" style="color: red;"></i>
                            </a>
                        </li>
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        <li class="nav-item mt-3 hide-mb">
                            <a href="<?php echo $hyperlink_orders; ?>" class="btn btn-md btn-info float-left" >
                                Place New Order
                            </a>
                        </li>
                    </ul>
                    
                    
                    
                    <ul class="navbar-nav ml-auto">
	
            		  <li class="nav-item dropdown" style="font-size: 30px; color:blue;">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                     
                     
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="width: 500px;">
                     
                    </div>
                  </li>
                  
                  
	  
	  
     
	  <!-- Notifications Dropdown Menu -->
    
	  
	  
    </ul>
    
      <ul class="navbar-nav my-lg-0">
                        <!-- ============================================================== -->
                        <!-- Comment -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false"> 
                                 <span class="badge badge-primary  navbar-badge btn" style="margin-top: -8px;border-radius:42%;background-color: #00bf5e"> <i style="font-size:20px;" class="fa fa-bell"></i> <sup style="color: #fff;"> <?php echo sizeof($notification); ?></sup></span>
                                <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end mailbox animated bounceInDown">
                               <ul>
                                <span class="dropdown-item dropdown-header"><?php echo sizeof($notification); ?> Feedback Message</span>
                                <?php
                                $distinctNotifications = array_unique(array_column($notification, 'order_id')); // Retrieve distinct notifications based on order_id
                                
                                foreach ($distinctNotifications as $order_id) {
                                    $notify = null;
                                    foreach ($notification as $item) {
                                        if ($item['order_id'] == $order_id) {
                                            $notify = $item;
                                            break;
                                        }
                                    }
                                    if ($notify) {
                                ?>
                                    <div class="dropdown-divider"></div>
                                    <a href="<?php echo $notify_url ?>/<?php echo $notify['order_id']; ?>/notify" class="dropdown-item">
                                        <?= $notify['code']; ?>  <?= $notify['title']; ?>
                                    </a>
                                <?php
                                    }
                                }
                                ?>
                                <div class="dropdown-divider"></div>
                                <!--<a href="<?= $notification_orders ?>/notify" class="dropdown-item dropdown-footer">See All Notifications</a>-->
                            </ul>







                            </div>
                        </li>
                        <?php if($role_id == 1 ||$role_id == 6 || $role_id == 7 || $role_id == 8 ) { ?>
                        
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false"> 
                                 <span class="badge badge-primary  navbar-badge btn" style="margin-top: -8px;border-radius:42%;background-color: yellow; color:black"> <i style="font-size:20px;" class="fa fa-bell">Writer</i> <sup style="color: black;"> <?php echo sizeof($notificationw); ?></sup></span>
                                <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end mailbox animated bounceInDown">
							<ul>
					<span class="dropdown-item dropdown-header"><?= sizeof($notificationw); ?> Writer Message</span>
					<?php
					// Retrieve distinct notifications based on order_code
					$distinctNotificationsw = array_unique(array_column($notificationw, 'order_code'));

					foreach ($distinctNotificationsw as $order_code) {
						$notify = null;
						// Replace 'your_login_id' with the actual login ID or retrieve it from your authentication system
						// Assuming you have a $logged_in_user variable that holds the ID of the currently logged-in user
						foreach ($notificationw as $item) {
							if ($item['order_code'] == $order_code && $item['created_by'] !=  $user_id) {
								$notify = $item;
								break;
							}
						}
						
						if ($notify) {
							?>
							<div class="dropdown-divider"></div>
							<a href="<?= base_url() ?>Orders/updateCallsData/<?= $notify['order_code']; ?>" class="dropdown-item">
								<?= $notify['order_code']; ?>
							</a>
							<?php
						}
					}
					?>
            <div class="dropdown-divider"></div>
            <!--<a href="<?= $notification_orders ?>/notify" class="dropdown-item dropdown-footer">See All Notifications</a>-->
        </ul>






                            </div>
                        </li>
                        <?php } ?>
                        <?php if($role_id == 1 ||  $role_id == 6 || $role_id == 8  ) { ?>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-bs-toggle="dropdown"
								aria-haspopup="true" aria-expanded="false"> 
								<span class="badge badge-primary  navbar-badge btn" style="margin-top: -8px;border-radius:42%;background-color: #6699CC; color:black"> <i style="font-size:20px;" class="fa fa-bell">Admin</i> <sup style="color: black;"> <?php echo sizeof($notificationadmin); ?></sup></span>
								<div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
							</a>
							 <div class="dropdown-menu dropdown-menu-end mailbox animated bounceInDown">
								<ul>
									<span class="dropdown-item dropdown-header"><?= sizeof($notificationadmin); ?> Writer Admin Message</span>
									<?php
										$distinctNotificationsa = array_unique(array_column($notificationadmin, 'order_code'));
										foreach ($distinctNotificationsa as $order_code) {
											$notify = null;
											foreach ($notificationadmin as $item) {
												if ($item['order_code'] == $order_code && $item['created_by'] !=  $user_id) {
													$notify = $item;
													break;
												}
											}
											
											if ($notify) {
												?>
												<div class="dropdown-divider"></div>
												<a href="<?= base_url() ?>Orders/updateadmin/<?= $notify['order_code']; ?>" class="dropdown-item">
													<?= $notify['order_code']; ?>
												</a>
												<?php
											}
										}
									?>
		 								<div class="dropdown-divider"></div>
	 							</ul>
							</div>
						</li>
					<?php } ?>
                        
                             <?php if($role_id == 1 ||$role_id == 6 || $role_id == 7 || $role_id == 5 ) { ?>
                        
                           <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false"> 
                                 <span class="badge badge-primary  navbar-badge btn" style="margin-top: -8px;border-radius:42%;background-color: #8888da; color:black"> <i style="font-size:20px;" class="fa fa-bell">Client</i> <sup style="color: black;"> <?php echo sizeof($notificationc); ?></sup></span>
                                <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end mailbox animated bounceInDown">
							<ul>
					<span class="dropdown-item dropdown-header"><?= sizeof($notificationc); ?>Client Message</span>
					<?php
					// Retrieve distinct notifications based on order_code
					$distinctNotificationsw = array_unique(array_column($notificationc, 'order_code'));

					foreach ($distinctNotificationsw as $order_code) {
						$notify = null;
						// Replace 'your_login_id' with the actual login ID or retrieve it from your authentication system
						// Assuming you have a $logged_in_user variable that holds the ID of the currently logged-in user
						foreach ($notificationc as $item) {
							if ($item['order_code'] == $order_code && $item['created_by'] !=  $user_id) {
								$notify = $item;
								break;
							}
						}
						
						if ($notify) {
							?>
							<div class="dropdown-divider"></div>
							<a href="<?= base_url() ?>Orders/updateclient/<?= $notify['order_code']; ?>" class="dropdown-item">
								<?= $notify['order_code']; ?>
							</a>
							<?php
						}
					}
					?>
            <div class="dropdown-divider"></div>
            <!--<a href="<?= $notification_orders ?>/notify" class="dropdown-item dropdown-footer">See All Notifications</a>-->
        </ul>






                            </div>
                        </li>
                     
                     <?php } ?>


					 
                        <!-- ============================================================== -->
                        <!-- End Comment -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- Messages -->
                        <!-- ============================================================== -->
                        
                        <!-- ============================================================== -->
                        <!-- End Messages -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- mega menu -->
                        <!-- ============================================================== -->
                        
                        <!-- ============================================================== -->
                        <!-- End mega menu -->
                        <!-- ============================================================== -->
                        <li class="nav-item right-side-toggle"> <a class="nav-link  waves-effect waves-light"
                                href="javascript:void(0)"><i class="ti-settings"></i></a></li>
                    </ul>
    
    
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                   
                </div>
            </nav>
        </header>
        
        <?php } ?>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <script src="<?php echo base_url(); ?>assets/node_modules/jquery/dist/jquery.min.js"></script>
        <script>
            $(".user-pro-bodys").hover(function() {
                alert('hii');
            }, function() {
                alert('byy');
            });
        </script>
        
       
        