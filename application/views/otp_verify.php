<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php //echo base_url(); exit;?>
<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head><base href="../../../">
		<title>OTP Verification</title>
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
		<link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Global Stylesheets Bundle(used by all pages)-->
		<link href="<?php echo base_url()?>assets1/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url()?>assets1/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="bg-body">
		<!--begin::Main-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Authentication - Two-stes -->
			<div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-image: url(assets/media/illustrations/sketchy-1/14.png">
				<!--begin::Content-->
				<div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
					<!--begin::Logo-->
					<a href="../../demo1/dist/index.html" class="mb-12">
						<img alt="Logo"src="http://assignnmentinneed.com/user_login/uploads_old/assignment_logo.png" class="h-150px" />
					</a>
					<!--end::Logo-->
					<!--begin::Wrapper-->
					<div class="w-lg-600px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
						<!--begin::Form-->
						<form class="form w-100 mb-10"  action="<?php echo base_url() ;?>index.php/User_authentication/otpVerify" method="post">
							<!--begin::Icon-->
						
							<!--end::Icon-->
							<!--begin::Heading-->
							<div class="text-center mb-10">
								<!--begin::Title-->
								<h1 class="text-dark mb-3">OTP Verification</h1>
								<!--end::Title-->
								<!--begin::Sub-title-->
								<div class="text-muted fw-bold fs-5 mb-5">Enter the verification code we sent to</div>
								<!--end::Sub-title-->
								<!--begin::Mobile no-->
								<div class="fw-bolder text-dark fs-3"><?php echo $email ?></div>
								<!--end::Mobile no-->
							</div>
							<!--end::Heading-->
							<!--begin::Section-->
							<div class="mb-10 px-md-10">
								<!--begin::Label-->
								<div class="fw-bolder text-start text-dark fs-6 mb-1 ms-1">Type your 6 digit security code</div>
								<!--end::Label-->
								<!--begin::Input group-->
								<div class="d-flex flex-wrap flex-stack">
								 <input type="otp" class="form-control" placeholder="Enter OTP here" name="otp" minlenght="6" maxlength="6" oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" autocomplete="off">
								</div>
								<input type="hidden" name="email" value="<?= $email ?>">
								<!--begin::Input group-->
							</div>
							<!--end::Section-->
							<!--begin::Submit-->
							<div class="d-flex flex-center">
								
								 <button type="submit" class="btn btn-lg btn-primary fw-bolder" style="background-color: #355fa9  ;color:#fff;">Submit</button>
							
							</div>
							<!--end::Submit-->
						</form>
						<!--end::Form-->
						<!--begin::Notice-->
						<div class="text-center fw-bold fs-5">
							<span class="text-muted me-1">Didn’t get the code ?</span>
							<a href="http://assignnmentinneed.com/user_login/User_authentication/ForgotPassword" class="link-primary fw-bolder fs-5 me-1">Resend</a>
							<span class="text-muted me-1">or</span>
							<a href="http://assignnmentinneed.com/user_login" class="link-primary fw-bolder fs-5">Log In</a>
						</div>
						<!--end::Notice-->
					</div>
					<!--end::Wrapper-->
				</div>
				<!--end::Content-->
				<!--begin::Footer-->
				<div class="d-flex flex-center flex-column-auto p-10">
					<!--begin::Links-->
					<div class="d-flex align-items-center fw-bold fs-6">
							<a href="https://assignnmentinneed.com/" class="text-muted text-hover-primary px-2">Home</a>
						<a href="mailto:info@assignnmentinneed.com" class="text-muted text-hover-primary px-2">Contact</a>
						<a href="https://www.assignnmentinneed.com/contact-us/" class="text-muted text-hover-primary px-2">Contact Us</a>
					</div>
					<!--end::Links-->
				</div>
				<!--end::Footer-->
			</div>
			<!--end::Authentication - Two-stes-->
		</div>
	


<!-- jQuery -->
<script src="<?php echo base_url()."assets/"; ?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url()."assets/"; ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url()."assets/"; ?>plugins/iCheck/icheck.min.js"></script>

<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass   : 'iradio_square-blue',
      increaseArea : '20%' // optional
    })
  })

  $('#close').on('click', function(e) { 
   $(this).parent('.error_mesg').remove(); 
});
/*
    $(function() {
    setTimeout(function() {
        $(".error_mesg").hide('blind', {}, 500)
    }, 3000);
  });*/
</script>
</body>
</html>
