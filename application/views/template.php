<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<?php
if (isset($this->session->userdata['logged_in'])) {
	$username 		= ($this->session->userdata['logged_in']['username']);
	$email 			= ($this->session->userdata['logged_in']['email']);
	$role_id 		= $this->session->userdata['logged_in']['role_id'];
	$employee_id 	= $this->session->userdata['logged_in']['id'];
} else {
	header("location: login");
}

$curr_url 		= current_url();
$result 		= $this->user_rights_url->getUrlList($role_id, $employee_id);
$last 			= [];
$current_page 	= current_url();
$data 			= explode('index.php', $current_page);

$auth_page_old = $data[1];
$edit_data 	   = explode('/', $data[1]);

if (!empty($edit_data[3])) {
	$auth_page = '/' . $edit_data[1] . '/' . $edit_data[2];
} else {
	$auth_page = $auth_page_old;
}

?>
	<!DOCTYPE html>
	<html>
	<?php $this->load->view('template/css'); ?>

    <?php if($role_id == 2) {?>

	<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
		<div class="d-flex flex-column flex-root">
			<!-- include your header view here -->
			<div class="page d-flex flex-row flex-column-fluid">
				<?php $this->load->view('template/menu'); ?>
				<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
					<?php $this->load->view('template/header'); ?>

					<div class="content-wrapper">
						<section class="content">
							<?= $contents ?>
						</section>
					</div>
				</div>
			</div>
		</div>
	</body>


	<?php } else {?>


	<body class="hold-transition sidebar-mini">
		<div class="wrapper">
			<!-- include your header view here -->
			<?php $this->load->view('template/header'); ?>
			<?php $this->load->view('template/menu'); ?>

			<div class="content-wrapper">
				<section class="content">
					<?= $contents ?>
				</section>
			</div>
			<?php $this->load->view('template/footer'); ?>

		</div>
	</body>
	<?php $this->load->view('template/js'); ?>

	</html>
	<?php } ?>

