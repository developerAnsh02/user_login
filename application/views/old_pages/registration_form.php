
<html lang="en">
	<!--begin::Head-->
	<head><base href="../../../">
		<title>Sign Up</title>
		<meta charset="utf-8" />
		<meta name="description" content="The most advanced Bootstrap Admin Theme on Themeforest trusted by 94,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue &amp; Laravel versions. Grab your copy now and get life-time updates for free." />
		<meta name="keywords" content="Metronic, bootstrap, bootstrap 5, Angular, VueJs, React, Laravel, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta property="og:locale" content="en_US" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="Metronic - Bootstrap 5 HTML, VueJS, React, Angular &amp; Laravel Admin Dashboard Theme" />
		<meta property="og:url" content="https://keenthemes.com/metronic" />
		<meta property="og:site_name" content="Keenthemes | Metronic" />
		<link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
		<link rel="shortcut icon" href="http://assignnmentinneed.com/user_login/uploads_old/assignment_logo.png" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Global Stylesheets Bundle(used by all pages)-->
		<link href="<?php echo base_url() ?>assets1/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="bg-body">
		<!--begin::Main-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Authentication - Sign-up -->
			<div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-image: url(assets/media/illustrations/sketchy-1/14.png">
				<!--begin::Content-->
				<div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
					<!--begin::Logo-->

					<a href="http://assignnmentinneed.com/user_login/uploads_old/assignment_logo.png" class="mb-12">
						<img alt="Logo" src="http://assignnmentinneed.com/user_login/uploads_old/assignment_logo.png" class="h-150px" />
					</a>
					<!--end::Logo-->
					<!--begin::Wrapper-->
					<div class="w-lg-600px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
						<!--begin::Form-->

						<div class="" style="color:white;">
								<?php echo validation_errors();?>
								
								<?php if($this->session->flashdata('success')): ?>
								<div class="alert alert-success alert-dismissible" >
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
										<h5><i class="icon fa fa-check"></i> Success!</h5>
										<?php echo $this->session->flashdata('success'); ?>
									</div>
								<!-- <span class="successs_mesg"><?php echo $this->session->flashdata('success'); ?></span> -->
							<?php endif; ?>

							<?php if($this->session->flashdata('failed')): ?>
								<div class="alert alert-error alert-dismissible " >
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
										<h5><i class="icon fa fa-check"></i> Alert!</h5>
										<?php echo $this->session->flashdata('failed'); ?>
									</div>
							<?php endif; ?>

						</div>
						<form  action="<?php echo base_url() ;?>index.php/User_authentication/new_user_registration" method="post">
							<!--begin::Heading-->
							<input type="hidden" name="role_id" value="2">
							<div class="mb-10 text-center">
								<!--begin::Title-->
								<h1 class="text-dark mb-3">Create an Account</h1>
								<!--end::Title-->
								<!--begin::Link-->
								<div class="text-gray-400 fw-bold fs-4">Already have an account?
								<a href="<?php echo base_url() ;?>User_authentication/index" class="link-primary fw-bolder">Sign in here</a></div>
								<!--end::Link-->
							</div>
							<!--end::Heading-->
							<!--begin::Action-->
							<!--end::Action-->
							<!--begin::Separator-->
							<div class="d-flex align-items-center mb-10">
								<div class="border-bottom border-gray-300 mw-50 w-100"></div>
								<span class="fw-bold text-gray-400 fs-7 mx-2">OR</span>
								<div class="border-bottom border-gray-300 mw-50 w-100"></div>
							</div>
							<!--end::Separator-->
							
							<div class="fv-row mb-7">
								<label class="form-label fw-bolder text-dark fs-6">Name</label>
								<input class="form-control form-control-lg form-control-solid" type="text" placeholder="" name="name" autocomplete="off" />
							</div>

							<div class="fv-row mb-7">
								<label class="form-label fw-bolder text-dark fs-6">Email</label>
								<input class="form-control form-control-lg form-control-solid" type="email" placeholder="" name="email" autocomplete="off" />
							</div>

							<!--begin::Input group-->
							<div class="row fv-row mb-7">
								<!--begin::Col-->
								<div class="col-xl-6">
									<label class="form-label fw-bolder text-dark fs-6">Select Country </label>
									
									<?php  echo form_dropdown('countrycode', $countries)
										  ?>								</div>
								<!--end::Col-->
								<!--begin::Col-->
								<div class="col-xl-6">
									<label class="form-label fw-bolder text-dark fs-6">Mobile Number</label>
									<input class="form-control form-control-lg form-control-solid" type="number" placeholder="" name="mobile_no" autocomplete="off" />
								</div>
								<!--end::Col-->
							</div>
							<!--end::Input group-->
							<!--begin::Input group-->
							
							<!--end::Input group-->
							<!--begin::Input group-->
							
							<!--end::Input group-->
							<!--begin::Input group-->
							<!-- <div class="fv-row mb-10">
								<label class="form-check form-check-custom form-check-solid form-check-inline">
									<input class="form-check-input" type="checkbox" name="toc" value="1" />
									<span class="form-check-label fw-bold text-gray-700 fs-6">I Agree
									<a href="#" class="ms-1 link-primary">Terms and conditions</a>.</span>
								</label>
							</div> -->
							<!--end::Input group-->
							<!--begin::Actions-->
							<div class="text-center">
							
								<input type="submit" value="Register" class="btn btn-lg btn-primary " style="width:100%">
								
							</div>
							<!--end::Actions-->
						</form>
						<!--end::Form-->
					</div>
					<!--end::Wrapper-->
				</div>
				<!--end::Content-->
				<!--begin::Footer-->
				<div class="d-flex flex-center flex-column-auto p-10">
					<!--begin::Links-->
					<div class="d-flex align-items-center fw-bold fs-6">
						<a href="https://assignnmentinneed.com/" class="text-muted text-hover-primary px-2">About</a>
						<a href="mailto:info@assignnmentinneed.com" class="text-muted text-hover-primary px-2">Contact</a>
						<a href="https://www.assignnmentinneed.com/contact-us/" class="text-muted text-hover-primary px-2">Contact Us</a>
					</div>
					<!--end::Links-->
				</div>
				<!--end::Footer-->
			</div>
			<!--end::Authentication - Sign-up-->
		</div>
		<!--end::Root-->
		<!--end::Main-->
		<!--begin::Javascript-->
		<script>var hostUrl = "assets/";</script>
		<!--begin::Global Javascript Bundle(used by all pages)-->
		<script src="assets/plugins/global/plugins.bundle.js"></script>
		<script src="assets/js/scripts.bundle.js"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Page Custom Javascript(used by this page)-->
		<script src="assets/js/custom/authentication/sign-up/general.js"></script>
		<!--end::Page Custom Javascript-->
		<!--end::Javascript-->
	</body>
	<!--end::Body-->
</html>



</html>

<script src="<?php echo base_url()."assets/"; ?>plugins/jquery/jquery.min.js"></script>
<script>
  $('#close').on('click', function(e) { 
   $(this).parent('.error_mesg').remove(); 
});
</script>