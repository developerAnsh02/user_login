<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<?php
$role_id = $this->session->userdata['logged_in']['role_id'];
?>
<style type="text/css">
	.select2 {
		height: 45px !important;
		width: 100% !important;
	}

	.btnEdit {
		width: 25%;
		border-radius: 5px;
		margin: 1px;
		padding: 1px;
	}
</style>


<!-- ============================================================== -->
<!-- Page wrapper  -->
<?php if($role_id==2) {?>
<div class="card mb-5 mb-xl-10">
    <div class="post d-flex flex-column-fluid" id="kt_post">
			<!--begin::Container-->
			<div id="kt_content_container" class="container-xxl">
					<!--begin::Card header-->
					<div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
						<!--begin::Card title-->
						<div class="card-title m-0">
							<h3 class="fw-bolder m-0">Profile Details</h3>
						</div>
						<!--end::Card title-->
					</div>
					<!--begin::Card header-->
					<!--begin::Content-->
					<div id="kt_account_settings_profile_details" class="collapse show">
						<!--begin::Form-->
						<form id="kt_account_profile_details_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate">
							<!--begin::Card body-->
							<div class="card-body border-top p-9">
								<!--begin::Input group-->
								<div class="row mb-6">
									<!--begin::Label-->
									<label class="col-lg-4 col-form-label fw-bold fs-6">Avatar</label>
									<!--end::Label-->
									<!--begin::Col-->
									<div class="col-lg-8">
										<!--begin::Image input-->
										<div class="image-input image-input-outline image-input-empty" data-kt-image-input="true" style="background-image: url('https://assignnmentinneed.com/user_login/uploads/customers/logo.png')">
											<!--begin::Preview existing avatar-->
											<div class="image-input-wrapper w-125px h-125px" style="background-image: none;"></div>
											<!--end::Preview existing avatar-->
										
											<!--<label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="" data-bs-original-title="Change avatar">-->
												<!--<i class="bi bi-pencil-fill fs-7"></i>-->
												<!--begin::Inputs-->
												<!--<input type="file" name="avatar" accept=".png, .jpg, .jpeg">-->
												<!--<input type="hidden" name="avatar_remove" value="1">-->
												<!--end::Inputs-->
											<!--</label>-->
											<!--end::Label-->
											<!--begin::Cancel-->
											<span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="" data-bs-original-title="Cancel avatar">
												<i class="bi bi-x fs-2"></i>
											</span>
											<!--end::Cancel-->
											<!--begin::Remove-->
											<span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="" data-bs-original-title="Remove avatar">
												<i class="bi bi-x fs-2"></i>
											</span>
											<!--end::Remove-->
										</div>
										<!--end::Image input-->
										<!--begin::Hint-->
										<div class="form-text">Allowed file types: png, jpg, jpeg.</div>
										<!--end::Hint-->
									</div>
									<!--end::Col-->
								</div>
								<!--end::Input group-->
								<!--begin::Input group-->
								
								<!--end::Input group-->
								<!--begin::Input group-->
								<div class="row mb-6">
									<!--begin::Label-->
									<label class="col-lg-4 col-form-label  fw-bold fs-6">Name</label>
									<!--end::Label-->
									<!--begin::Col-->
									<div class="col-lg-8 fv-row fv-plugins-icon-container">
										<input type="text" name="company" value="<?= $result['name'] ?>" readonly class="form-control form-control-lg form-control-solid" placeholder="Company name" value="Keenthemes">
									<div class="fv-plugins-message-container invalid-feedback"></div></div>
									<!--end::Col-->
								</div>
								<div class="row mb-6">
									<!--begin::Label-->
									<label class="col-lg-4 col-form-label  fw-bold fs-6">Country Mobile No</label>
									<!--end::Label-->
									<!--begin::Col-->
									<div class="col-lg-8">
										<!--begin::Row-->
										<div class="row">
											<!--begin::Col-->
											<div class="col-lg-6 fv-row fv-plugins-icon-container">
												<input type="text" readonly name="fname" value='<?= $result['cnty_name'] ?>' class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="First name" value="Max">
											<div class="fv-plugins-message-container invalid-feedback" "></div></div>
											<!--end::Col-->
											<!--begin::Col-->
											<div class="col-lg-6 fv-row fv-plugins-icon-container">
												<input type="text" name="lname" readonly value='<?= $result['mobile_no'] ?>' class="form-control form-control-lg form-control-solid" placeholder="Last name" value="Smith">
											<div class="fv-plugins-message-container invalid-feedback" ></div></div>
											<!--end::Col-->
										</div>
										<!--end::Row-->
									</div>
									<!--end::Col-->
								</div>
								<!--end::Input group-->
								<!--begin::Input group-->
								<div class="row mb-6">
									<!--begin::Label-->
									<label class="col-lg-4 col-form-label fw-bold fs-6">
										<span class="">emaile</span>
									
									</label>
									<!--end::Label-->
									<!--begin::Col-->
									<div class="col-lg-8 fv-row fv-plugins-icon-container">
										<input readonly value="<?= $result['email'] ?>" type="tel" name="phone" class="form-control form-control-lg form-control-solid" placeholder="Phone number" value="044 3276 454 935">
									<div class="fv-plugins-message-container invalid-feedback"></div></div>
									<!--end::Col-->
								</div>
								<!--end::Input group-->
								<!--begin::Input group-->
								<div class="row mb-6">
									<!--begin::Label-->
									<label class="col-lg-4 col-form-label fw-bold fs-6">Role</label>
									<!--end::Label-->
									<!--begin::Col-->
									<div class="col-lg-8 fv-row">
										<input type="text" readonly value="<?= $result['role'] ?>" name="website" class="form-control form-control-lg form-control-solid" placeholder="Company website" value="keenthemes.com">
									</div>
									<!--end::Col-->
								</div>
								<!--end::Input group-->
								<!--begin::Input group-->
								
							</div>
							<!--end::Card body-->
							<!--begin::Actions-->
							<div class="card-footer d-flex justify-content-end py-6 px-9">
							
								<a type="submit" class="btn btn-primary" href='https://assignnmentinneed.com/user_login/index.php/Orders/index' id="kt_account_profile_details_submit">Back</a>
							</div>
							<!--end::Actions-->
						<input type="hidden"><div></div></form>
						<!--end::Form-->
					</div>
					<!--end::Content-->
				</div>
			</div>
		</div>
<?php } else { ?>
<!-- ============================================================== -->
<div class="page-wrapper">
	<!-- ============================================================== -->
	<!-- Container fluid  -->
	<!-- ============================================================== -->
	<div class="container-fluid">
		<div class="card card-primary card-outline">
			<div class="card-header">
				<h3 class="card-title"><?= $title ?></h3>
				<div class="button-group float-right">
				</div>
			</div>
			<!-- /.card-body -->
			<div class="card-body">
				<div class="row">
					<div class="col-md-2">
						<span>
							<?php if (isset($result['photo']) && !empty($result['photo'])) { ?>
								<img src="<?php echo base_url() . "uploads/" . $result['photo']; ?>" class="img-circle " alt="User Image" style="width: 100%;height: 100%;">
							<?php } ?>
						</span>
					</div>
					<div class="col-md-10 table-responsive">
						<table class="table">
							<tr>
								<th> Full Name </th>
								<td> <?= $result['name'] ?></td>
								<th> User Code </th>
								<td> <?= $result['employee_code'] ?></td>

							</tr>
							<tr>
								<th> Designation </th>
								<td> <?= $result['role'] ?></td>
								<th> Country </th>
								<td> <?= $result['cnty_name'] ?></td>
							</tr>
							<tr>
								<th> Email </th>
								<td> <?= $result['email'] ?></td>
								<th> Mobile </th>
								<td> <?= $result['mobile_no'] ?></td>
							</tr>
							<tr>
								<th> Username </th>
								<td> <?= $result['username'] ?></td>
								<th> Address </th>
								<td> <?= $result['address'] ?></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php } ?>