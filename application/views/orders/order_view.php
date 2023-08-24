<?php
defined('BASEPATH') or exit('No direct script access allowed');
$current_page   = current_url();
$data           = explode('?', $current_page);
$role_id        = $this->session->userdata['logged_in']['role_id'];
$loginid        = $this->session->userdata['logged_in']['id'];
?>

<style>
    fieldset.scheduler-border {
        border-radius: 8px;
        border: 2px groove #ddd !important;
        padding: 0 1.4em 1.4em 1.4em !important;
        margin: 0 0 1.5em 0 !important;
        -webkit-box-shadow: 0px 0px 0px 0px #000;
        box-shadow: 0px 0px 0px 0px #000;
        margin-top: 30px !important;
    }

    legend.scheduler-border {
        text-align: left !important;
        width: auto;
        margin-top: -30px;
        margin-left: 15px;
        color: #144277;
        font-size: 17px;
        margin-bottom: 0px;
        border: none;
        background: #fff;
        padding: 15px;
    }

    label:not(.form-check-label):not(.custom-file-label) {
        font-weight: 700;
    }

    .col-md-6 {
        margin-bottom: 10px;
    }

    .page-titles {
        margin: 0 !important;
    }

    .card-body {
        padding: 0 !important;
    }
    
  /*  @media screen and (max-device-width:640px), screen and (max-width:992px)*/
  /*{*/
  /*  .hide-mb*/
  /*  {*/
  /*    display: none;*/
  /*  }*/
  }
  
 
</style>

<?php if($role_id ==2){?>
    
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
		<!--begin::Toolbar-->
		<div class="toolbar" id="kt_toolbar">
			<!--begin::Container-->
			<div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
				<!--begin::Page title-->
				<div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
									<!--begin::Title-->
									<h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Order List
									<!--begin::Separator-->
									<span class="h-20px border-gray-200 border-start ms-3 mx-2">Home</span>
									<!--end::Separator-->
									<!--begin::Description-->
									
									<!--end::Description--></h1>
                                    
									<!--end::Title-->
				</div>
                
				<!--end::Page title-->
				<!--begin::Actions-->
				<div class="card-toolbar" >
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
				<!--end::Actions-->
			</div>
			<!--end::Container-->
		</div>

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
		<!--end::Toolbar-->
		<!--begin::Post-->
		<div class="post d-flex flex-column-fluid" id="kt_post">
			<!--begin::Container-->
			<div id="kt_content_container" class="container-xxl">
				<div class="card">
					<div class="p-10">
                        <div class="col-xl-12">
							<div class="card card-xl-stretch mb-5 mb-xl-12">
								<div class="card-body py-3">
									<div class="table-responsive">
										<table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
											<thead>
											    <tr class="fw-bolder text-muted">
    
											    	<th class="min-w-150px">Order Id /Delivery Date/ Title</th>
											    	<th class="min-w-140px">Action</th>
    
											    </tr>
											</thead>
											<tbody>
											     <?php foreach ($leads as $obj ) { ?>
                                                   <tr>
                                                         <td>
                                                           <a href="#" class="text-dark fw-bolder text-hover-primary d-block fs-6 d-flex"><?php echo $obj['order_id']; ?> <span class="label label-primary" style="background-color:#ff8acc" > Pending </span> </a>
                                                           <b><span style="color:blue" class="">(<?php echo date('d-M-Y', strtotime($obj['deadline'])); ?>)</span></b>
                                                           <span class="text-muted fw-bold text-muted d-block fs-7"><?php echo $obj['project_title']; ?></span>
                                                           
                                                       </td>
                                                       <td>
                                                       <div class="d-flex flex-shrink-0">
																 <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 " data-bs-toggle="modal" data-bs-target="#kt_modal_new_targetleads<?php echo $obj['order_id']; ?>">
																	<span class="svg-icon svg-icon-3">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																			<path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="black" />
																			<path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="black" />
																		</svg>
																	</span>
                                                                   
																</a>
                                                                <div class="modal fade" id="kt_modal_new_targetleads<?php echo $obj['order_id']; ?>" tabindex="-1" aria-hidden="true">
                                                                        <!--begin::Modal dialog-->
                                                                        <div class="modal-dialog modal-dialog-centered mw-650px">
                                                                            <!--begin::Modal content-->
                                                                            <div class="modal-content rounded">
                                                                                <!--begin::Modal header-->
                                                                                <div class="modal-header pb-0 border-0 justify-content-end">
                                                                                    <!--begin::Close-->
                                                                                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                                                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                                                                        <span class="svg-icon svg-icon-1">
                                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                                                                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                                                                                            </svg>
                                                                                        </span>
                                                                                        <!--end::Svg Icon-->
                                                                                    </div>
                                                                                    <!--end::Close-->
                                                                                </div>
                                                                                <!--begin::Modal header-->
                                                                                <!--begin::Modal body-->
                                                                                <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                                                                                    <!--begin:Form-->
                                                                                    <form id="kt_modal_new_target_form" class="form" action="#">
                                                                                        <!--begin::Heading-->
                                                                                        <div class="mb-13 text-center">
                                                                                       
                                                                                            <!--begin::Title-->
                                                                                            <h1 class="mb-3">Order View <?php echo $obj['id']; ?> </h1>
                                                                                            <!--end::Title-->
                                                                                            <!--begin::Description-->
                                                                                            <div class="text-muted fw-bold fs-5"><?php echo $obj['order_id']; ?>
                                                                                            <a href="#" class="fw-bolder link-primary"> <span class="label label-primary" style="background-color:#ff8acc;">Pending</span></a></div>
                                                                                            <!--end::Description-->
                                                                                        </div>
                                                                                        <!--end::Heading-->
                                                                                        <!--begin::Input group-->
                                                                                        <div class="d-flex flex-column mb-8 fv-row">
                                                                                            <!--end::Label-->
                                                                                             <label class=" fs-6 fw-bold mb-2">Title</label>
                                                                                            <input type="text" readonly class="form-control form-control-solid" placeholder="" value="<?php echo $obj['project_title']; ?>" name="target_title" />
                                                                                        </div>
                                                                                        <!--end::Input group-->
                                                                                        <!--begin::Input group-->
                                                                                        <div class="row g-9 mb-8">
                                                                                            <!--begin::Col-->
                                                                                           
                                                                                            <div class="col-md-6 fv-row">
                                                                                                <label class=" fs-6 fw-bold mb-2">Order Date</label>
                                                                                            <input type="text" readonly class="form-control form-control-solid" placeholder="" value="<?php echo date('d-M-Y', strtotime($obj['create_at'])); ?>" name="target_title" />
                                                                                               
                                                                                            </div>
                                                                                            <!--end::Col-->
                                                                                            <!--begin::Col-->
                                                                                            <div class="col-md-6 fv-row">
                                                                                                <label class=" fs-6 fw-bold mb-2">Delivery  Date</label>
                                                                                                <input type="text" readonly class="form-control form-control-solid" placeholder="" value="<?php echo date('d-M-Y', strtotime($obj['deadline'])); ?>" name="target_title" />
                                                                                           
                                                                                            </div>
                                                                                            <!--end::Col-->
                                                                                        </div>

                                                                                       

                                                                                        <div class="row g-9 mb-8">
                                                                                            <!--begin::Col-->
                                                                                            <div class="col-md-6 fv-row">
                                                                                                <label class=" fs-6 fw-bold mb-2">Pages</label>
                                                                                            <input type="text" readonly class="form-control form-control-solid" placeholder="" value="<?php echo $obj['pages']; ?>" name="target_title" />
                                                                                               
                                                                                            </div>
                                                                                            <!--end::Col-->
                                                                                            <!--begin::Col-->
                                                                                            <!-- <div class="col-md-6 fv-row">
                                                                                                <label class=" fs-6 fw-bold mb-2">Total Amount</label>
                                                                                                <input type="text" readonly class="form-control form-control-solid" placeholder="" value="<?php echo $obj['amount']; ?>" name="target_title" />
                                                                                           
                                                                                            </div> -->
                                                                                            <!--end::Col-->
                                                                                        </div>

                                                                                        <div class="row g-9 mb-8">
                                                                                            <!--begin::Col-->
                                                                                            <!-- <div class="col-md-6 fv-row">
                                                                                                <label class=" fs-6 fw-bold mb-2">Paid Amount</label>
                                                                                            <input type="text" readonly class="form-control form-control-solid" placeholder="" value="<?php echo $obj['received_amount']; ?>" name="target_title" />
                                                                                               
                                                                                            </div> -->
                                                                                            <!--end::Col-->
                                                                                            <!--begin::Col-->
                                                                                            <!-- <div class="col-md-6 fv-row">
                                                                                                <label class=" fs-6 fw-bold mb-2">Due amount</label>
                                                                                                <input readonly type="text" class="form-control form-control-solid" placeholder="" value=" <?php
                                                                                                if (!isset($obj['amount']) && empty($obj['amount'])) {
                                                                                                    $obj['amount'] = 0;
                                                                                                }
                                                                                                echo (int)$obj['amount'] - (int)$obj['received_amount'];
                                                                                                ?>" name="target_title" />
                                                                                           
                                                                                            </div> -->
                                                                                            <!--end::Col-->
                                                                                        </div>

                                                                                       
                                                                                    </form>
                                                                                    <!--end:Form-->
                                                                                </div>
                                                                                <!--end::Modal body-->
                                                                            </div>
                                                                            <!--end::Modal content-->
                                                                        </div>
                                                                        <!--end::Modal dialog-->
                                                            </div>
                                                                
                                                                <!-- <a href="<?php echo base_url(); ?>index.php/Orders/feedback/<?php echo $obj['id']; ?>" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 " ><i style='font: size 10px;' class="	fas fa-comments"></i></a>
                                                               <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 " data-bs-toggle="modal" data-bs-target="#kt_modal_new_target1<?php echo $obj['order_id']; ?>">
																<i style='font: size 10px;' class="	fas fa-download"></i> -->
                                                                   
																</a>
															</div>
															
                                                       </td>
                                                       
                                                   </tr> 
                                                    
                                                <?php  }?>
                                                <?php foreach ($orders as $obj) { ?>
                                                    <?php
                                                        if ($obj['projectstatus'] == 'Pending') {
                                                            $color = "#ff8acc";
                                                        }elseif ($obj['projectstatus'] == 'Hold Work') {
                                                            $color = "red";
                                                        } elseif ($obj['projectstatus'] == 'Cancelled') {
                                                            $color = "red";
                                                        } elseif ($obj['projectstatus'] == 'Completed' || $obj['projectstatus'] == 'Draft Ready') {
                                                            $color = "#fec107";
                                                        } elseif ($obj['projectstatus'] == 'In Progress') {
                                                            $color = "#5b69bc";
                                                        } elseif ($obj['projectstatus'] == 'Feedback') {
                                                            $color = "black";
                                                        } elseif ($obj['projectstatus'] == 'Delivered' || $obj['projectstatus'] == 'Draft Delivered' || $obj['projectstatus'] == 'Feedback Delivered') {
                                                            $color = "green";
                                                        } elseif ($obj['projectstatus'] == 'initiated') {
                                                            $color = "#fb9678";
                                                        } else {
                                                            $color = "#35b8e0";
                                                        }
                                                    ?>
													<tr>
														<td>
														   
															<a href="#" class="text-dark fw-bolder text-hover-primary d-block fs-6 d-flex"><?php echo $obj['order_id']; ?>   <span class="label label-primary" style="background-color:<?= $color ?>;"><?= $obj['projectstatus'] ?> </span> </a>
															<b><span style="color:blue" class="">(<?php echo date('d-M-Y', strtotime($obj['delivery_date'])); ?>)</span></b>
															<span class="text-muted fw-bold text-muted d-block fs-7"><?php echo $obj['title']; ?></span>

															
															
														</td>
														<td>
															<div class="d-flex flex-shrink-0">
																<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 " data-bs-toggle="modal" data-bs-target="#kt_modal_new_target<?php echo $obj['order_id']; ?>">
																	<span class="svg-icon svg-icon-3">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																			<path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="black" />
																			<path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="black" />
																		</svg>
																	</span>
                                                                   
																</a>
																
																	<!--<a href="<?php echo base_url(); ?>index.php/Orders/orderchatc/<?php echo $obj['order_id']; ?>" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 " >-->
																	<!--<span class="svg-icon svg-icon-3">-->
																	<!--W-->
																	<!--</span>-->
                                                                   
															
                                                                <a href="<?php echo base_url(); ?>index.php/Orders/feedback/<?php echo $obj['id']; ?>" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 " ><i style='font: size 10px;' class="	fas fa-comments"></i></a>
                                                               <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 " data-bs-toggle="modal" data-bs-target="#kt_modal_new_target1<?php echo $obj['order_id']; ?>">
																<i style='font: size 10px;' class="	fas fa-download"></i>
                                                                   
																</a>
															</div>
                                                            <div class="modal fade" id="kt_modal_new_target<?php echo $obj['order_id']; ?>" tabindex="-1" aria-hidden="true">
                                                                        <!--begin::Modal dialog-->
                                                                        <div class="modal-dialog modal-dialog-centered mw-650px">
                                                                            <!--begin::Modal content-->
                                                                            <div class="modal-content rounded">
                                                                                <!--begin::Modal header-->
                                                                                <div class="modal-header pb-0 border-0 justify-content-end">
                                                                                    <!--begin::Close-->
                                                                                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                                                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                                                                        <span class="svg-icon svg-icon-1">
                                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                                                                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                                                                                            </svg>
                                                                                        </span>
                                                                                        <!--end::Svg Icon-->
                                                                                    </div>
                                                                                    <!--end::Close-->
                                                                                </div>
                                                                                <!--begin::Modal header-->
                                                                                <!--begin::Modal body-->
                                                                                <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                                                                                    <!--begin:Form-->
                                                                                    <form id="kt_modal_new_target_form" class="form" action="#">
                                                                                        <!--begin::Heading-->
                                                                                        <div class="mb-13 text-center">
                                                                                       
                                                                                            <!--begin::Title-->
                                                                                            <h1 class="mb-3">Order View <?php echo $obj['id']; ?> </h1>
                                                                                            <!--end::Title-->
                                                                                            <!--begin::Description-->
                                                                                            <div class="text-muted fw-bold fs-5"><?php echo $obj['order_id']; ?>
                                                                                            <a href="#" class="fw-bolder link-primary"> <span class="label label-primary" style="background-color:<?= $color ?>;"><?= $obj['projectstatus'] ?></span></a></div>
                                                                                            <!--end::Description-->
                                                                                        </div>
                                                                                        <!--end::Heading-->
                                                                                        <!--begin::Input group-->
                                                                                        <div class="d-flex flex-column mb-8 fv-row">
                                                                                            <!--end::Label-->
                                                                                             <label class=" fs-6 fw-bold mb-2">Title</label>
                                                                                            <input type="text" readonly class="form-control form-control-solid" placeholder="" value="<?php echo $obj['title']; ?>" name="target_title" />
                                                                                        </div>
                                                                                        <!--end::Input group-->
                                                                                        <!--begin::Input group-->
                                                                                        <div class="row g-9 mb-8">
                                                                                            <!--begin::Col-->
                                                                                           
                                                                                            <div class="col-md-6 fv-row">
                                                                                                <label class=" fs-6 fw-bold mb-2">Order Date</label>
                                                                                            <input type="text" readonly class="form-control form-control-solid" placeholder="" value="<?php echo date('d-M-Y', strtotime($obj['order_date'])); ?>" name="target_title" />
                                                                                               
                                                                                            </div>
                                                                                            <!--end::Col-->
                                                                                            <!--begin::Col-->
                                                                                            <div class="col-md-6 fv-row">
                                                                                                <label class=" fs-6 fw-bold mb-2">Delivery  Date</label>
                                                                                                <input type="text" readonly class="form-control form-control-solid" placeholder="" value="<?php echo date('d-M-Y', strtotime($obj['delivery_date'])); ?>" name="target_title" />
                                                                                           
                                                                                            </div>
                                                                                            <!--end::Col-->
                                                                                        </div>

                                                                                       

                                                                                        <div class="row g-9 mb-8">
                                                                                            <!--begin::Col-->
                                                                                            <div class="col-md-6 fv-row">
                                                                                                <label class=" fs-6 fw-bold mb-2">Pages</label>
                                                                                            <input type="text" readonly class="form-control form-control-solid" placeholder="" value="<?php echo $obj['pages']; ?>" name="target_title" />
                                                                                               
                                                                                            </div>
                                                                                            <!--end::Col-->
                                                                                            <!--begin::Col-->
                                                                                            <div class="col-md-6 fv-row">
                                                                                                <label class=" fs-6 fw-bold mb-2">Total Amount</label>
                                                                                                <input type="text" readonly class="form-control form-control-solid" placeholder="" value="<?php echo $obj['amount']; ?>" name="target_title" />
                                                                                           
                                                                                            </div>
                                                                                            <!--end::Col-->
                                                                                        </div>

                                                                                        <div class="row g-9 mb-8">
                                                                                            <!--begin::Col-->
                                                                                            <div class="col-md-6 fv-row">
                                                                                                <label class=" fs-6 fw-bold mb-2">Paid Amount</label>
                                                                                            <input type="text" readonly class="form-control form-control-solid" placeholder="" value="<?php echo $obj['received_amount']; ?>" name="target_title" />
                                                                                               
                                                                                            </div>
                                                                                            <!--end::Col-->
                                                                                            <!--begin::Col-->
                                                                                            <div class="col-md-6 fv-row">
                                                                                                <label class=" fs-6 fw-bold mb-2">Due amount</label>
                                                                                                <input readonly type="text" class="form-control form-control-solid" placeholder="" value=" <?php
                                                                                                if (!isset($obj['amount']) && empty($obj['amount'])) {
                                                                                                    $obj['amount'] = 0;
                                                                                                }
                                                                                                echo (int)$obj['amount'] - (int)$obj['received_amount'];
                                                                                                ?>" name="target_title" />
                                                                                           
                                                                                            </div>
                                                                                            <!--end::Col-->
                                                                                        </div>

                                                                                       
                                                                                    </form>
                                                                                    <!--end:Form-->
                                                                                </div>
                                                                                <!--end::Modal body-->
                                                                            </div>
                                                                            <!--end::Modal content-->
                                                                        </div>
                                                                        <!--end::Modal dialog-->
                                                            </div>
                                                            
                                                            
                                                            <div class="modal fade" id="kt_modal_new_target1<?php echo $obj['order_id']; ?>" tabindex="-1" aria-hidden="true">
                                                                        <!--begin::Modal dialog-->
                                                                        <div class="modal-dialog modal-dialog-centered mw-650px">
                                                                            <!--begin::Modal content-->
                                                                            <div class="modal-content rounded">
                                                                                <!--begin::Modal header-->
                                                                                <div class="modal-header pb-0 border-0 justify-content-end">
                                                                                    <!--begin::Close-->
                                                                                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                                                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                                                                        <span class="svg-icon svg-icon-1">
                                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                                                                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                                                                                            </svg>
                                                                                        </span>
                                                                                        <!--end::Svg Icon-->
                                                                                    </div>
                                                                                    <!--end::Close-->
                                                                                </div>
                                                                                <!--begin::Modal header-->
                                                                                <!--begin::Modal body-->
                                                                                <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                                                                                   <fieldset class="scheduler-border">
                                                                <legend class="scheduler-border"> Documents Details</legend>
                                                                <?php
                                                                if (!empty($obj['order_file_details'])) {
                                                                    $j = 1;
                                                                    foreach ($obj['order_file_details'] as  $file_details) {  ?>
                                                                        <div class="row">
                                                                            <div class="col-md-4">
                                                                                <label><?= $j ?></label>
                                                                            </div>
                                                                            <div class="col-md-8">
                                                                                <label class="control-label">Uploaded File :</label>
                                                                                 <div style="height: 10%;width: 100%;">
                                                                                    <a href="<?php echo $file_details['file']; ?>" target="_blank">
                                                                                        <?php
                                                                                        $name = explode('/', $file_details['file']);

                                                                                        if ($obj['order_type'] == "Website") {
                                                                                            echo $name[4];
                                                                                        } else {
                                                                                            echo $name[5];
                                                                                        }
                                                                                        ?>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <hr>
                                                                <?php $j++;
                                                                    }
                                                                } ?>
                                                            </fieldset>
                                                                                </div>
                                                                                <!--end::Modal body-->
                                                                            </div>
                                                                            <!--end::Modal content-->
                                                                        </div>
                                                                        <!--end::Modal dialog-->
                                                            </div>
														</td>
													</tr>
                                                <?php } ?>
											</tbody>
											<!--end::Table body-->
										</table>
										 <?php if ($role_id == 1 || $role_id == 2) { ?>
                                            <?php if (empty($from_date)) { ?>
                                                <div class="pagination">
                                                    <?php echo $links; ?> </p>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
									</div>
								</div>
							</div>
					    </div>
				    </div>
				</div>
			</div>
			<!--end::Container-->
		</div>
		<!--end::Post-->
	</div>
<?php } else { ?>
<!-- Page wrapper  -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">


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

        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Orders List</h4>
                <?php
                $params   = $_SERVER['QUERY_STRING'];
                $fullURL  = $current_page . '?' . $params;
                $_SESSION['fullURL'] = $fullURL;
                ?>
            </div>
            
            <div class="col-md-7 align-self-center text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb justify-content-end">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Order List</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">

            <!-- Start : Filters -->
            <div class="accordion" id="accordionExample">
                <div class="card m-b-0">
                    <div class="card-body">
                        
                          <?php if($role_id == '6' || $role_id == '8') { ?>
                        <form method="get" id="filterForm">
                            <div class="row">

                                    <div class="col-md-3 col-sm-3">
                                        <select name="order_id" class="form-control select2 ">
                                            <option value="0"> Search By Order Id</option>
                                            <?php
                                            if ($getOrderIDsw) : ?>
                                                <?php
                                                foreach ($getOrderIDsw as $value) : ?>

                                                    <option value="<?= $value['order_id'] ?>"><?= $value['order_id'] ?></option>
                                                <?php endforeach;  ?>
                                            <?php else : ?>
                                                <option value="0">No result</option>
                                            <?php endif; ?>
                                        </select>
                                    </div>

                                <div class="col-md-3 col-sm-3">
                                    <input type="text" data-date-formate="dd-mm-yyyy" name="from_date" class="form-control mdate" value="<?php echo @$from_date; ?>" placeholder="From Date">
                                </div>
                                <div class="col-md-3 col-sm-3">
                                    <input type="text" data-date-formate="dd-mm-yyyy" name="upto_date" class="form-control mdate" value="<?php echo @$upto_date; ?>" placeholder="Upto Date">
                                </div>
                                <div class="col-md-3 col-sm-3">
                                   
                                        
                                        <select name="swid" class="form-control" >
                                            <option value="">Select an Writer</option>
                                            <?php foreach ($writerTL as $employee) : ?>
                                                <option value="<?php echo $employee['id']; ?>"><?php echo $employee['name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                   
                                </div>
                            </div>
                            
                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="row mt-3">
                                    <div class="col-md-3 col-sm-3">
                                        <select class="form-control" name="order_date_filter">
                                            <option value="order_date">Order Date</option>
                                            <option value="writer_delivery">Writer Deadline</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                        <select class="form-control" name="status">
                                            <option value="" <?php if (@$obj['writer_status'] == 'NULL') {echo "selected";} ?>>Select a status</option>
                                            <option value="Quality Accepted" <?php if (@$obj['writer_status'] == 'Quality Accepted') {echo "selected";} ?>>Quality Accepted</option>
                                            <option value="Quality Rejected" <?php if (@$obj['writer_status'] == 'Quality Rejected') {echo "selected";} ?> >Quality Rejected</option>
                                            <option value="In Progress" <?php if (@$obj['writer_status'] == 'In Progress') {echo "selected";} ?>>In Progres</option>
                                            <option value="Completed" <?php if (@$obj['writer_status'] == 'Completed') {echo "selected";} ?>>Completed</option>
                                            <option value="Delivered" <?php if (@$obj['writer_status'] == 'Delivered') {echo "selected";} ?>>Delivered</option>
                                        </select>
                                    </div>
                                   
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <label class="control-label" style="visibility: hidden;"> Grade</label>
                                    <br>

                                    <input type="submit" class="btn btn-primary" value="Search" />

                                    <label class="control-label" style="visibility: hidden;"> Grade</label>

                                    <a href="<?php echo $data[0] ?>" class="btn btn-danger"> Reset</a>

                                    <label class="control-label" style="visibility: hidden;"> Grade</label>

                                    <button style="background-color: green; color:white;" id="headingOne" class="btn btn-link collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Show Filters
                                    </button>
                                </div>

                                <?php if ($role_id == 1) { ?>
                                    <div class="col-md-6 col-sm-6" style="text-align: right;">
                                        <label class="control-label" style="visibility: hidden;">Hidden</label>
                                        <br>
                                        <a href="<?php echo base_url('index.php/Orders/ordersCSV'); ?>" class="btn btn-success" type="button" style="border:none; background-color: red; color:white;">
                                            Export
                                        </a>
                                    </div>
                                <?php } ?>

                            </div>
                        </form>
                    <?php } ?>
                        <?php if($role_id != '2' && $role_id != 6 && $role_id != 7 && $role_id != 8) { ?>
                        <form method="get" id="filterForm">
                            <div class="row">
                                
                                <?php if ($role_id == '1' || $role_id == '3' || $role_id == '4'  ) {  ?>
                                    <div class="col-md-3 col-sm-3">
                                        <select name="customer_id" class="form-control select2 customers">
                                            <option value="0"> Select customer name</option>
                                            <?php
                                            if ($all_customers) : ?>
                                                <?php
                                                foreach ($all_customers as $value) : ?>
                                                    <?php
                                                    if (isset($customer_id) && !empty($customer_id) && $value['id'] == $customer_id) : ?>
                                                        <option value="<?= $value['id'] ?>"><?= $value['name'] ?> <?= $value['email'] ?> <?= $value['mobile_no'] ?></option>
                                                    <?php else : ?>
                                                        <option value="<?= $value['id'] ?>"><?= $value['name'] ?> <?= $value['email'] ?> <?= $value['mobile_no'] ?></option>
                                                    <?php endif;   ?>
                                                <?php endforeach;  ?>
                                            <?php else : ?>
                                                <option value="0">No result</option>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                <?php } elseif( $role_id == '5') { ?>
                                    <div class="col-md-3 col-sm-3 d-none ">
                                        <select name="customer_id" class="form-control select2 customers">
                                            <option value="0"> Select customer name</option>
                                            <?php
                                            if ($all_customers) : ?>
                                                <?php
                                                foreach ($all_customers as $value) : ?>
                                                    <?php
                                                    if (isset($customer_id) && !empty($customer_id) && $value['id'] == $customer_id) : ?>
                                                        <option value="<?= $value['id'] ?>"><?= $value['name'] ?> <?= $value['email'] ?> <?= $value['mobile_no'] ?></option>
                                                    <?php else : ?>
                                                        <option value="<?= $value['id'] ?>"><?= $value['name'] ?> <?= $value['email'] ?> <?= $value['mobile_no'] ?></option>
                                                    <?php endif;   ?>
                                                <?php endforeach;  ?>
                                            <?php else : ?>
                                                <option value="0">No result</option>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                    <?php }?>

                                <?php if ($role_id == '1' || $role_id == '3' || $role_id == '4' || $role_id == '5') { ?>
                                    <div class="col-md-3 col-sm-3">
                                        <select name="order_id" class="form-control select2 ">
                                            <option value="0"> Search By Order Id</option>
                                            <?php
                                            if ($OrderIDs) : ?>
                                                <?php
                                                foreach ($OrderIDs as $value) : ?>

                                                    <option value="<?= $value['order_id'] ?>"><?= $value['order_id'] ?></option>
                                                <?php endforeach;  ?>
                                            <?php else : ?>
                                                <option value="0">No result</option>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                <?php } ?>

                                <div class="col-md-3 col-sm-3">
                                    <input type="text" data-date-formate="dd-mm-yyyy" name="from_date" class="form-control mdate" value="<?php echo @$from_date; ?>" placeholder="From Date">
                                </div>
                                <div class="col-md-3 col-sm-3">
                                    <input type="text" data-date-formate="dd-mm-yyyy" name="upto_date" class="form-control mdate" value="<?php echo @$upto_date; ?>" placeholder="Upto Date">
                                </div>
                            </div>
                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="row mt-3">
                                    <div class="col-md-3 col-sm-3">
                                        <select class="form-control" name="order_date_filter">
                                            <option value="order_date">Order Date</option>
                                            <option value="delivery_date">Delivery Date</option>
                                            <option value="writer">Writer deadline</option>
                                            <option value="draft_deadline">Draft deadline</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                        <select class="form-control" name="status">
                                            <option value="">Select Order Status</option>
                                            <option value="Pending">Pending</option>
                                             <option value="Hold Work">Hold Work</option>
                                            <option value="In Progress">In Progress</option>
                                            <option value="Completed">Completed</option>
                                            <option value="Delivered">Delivered</option>
                                            <option value="Feedback">Feedback</option>
                                            <option value="Feedback Delivered">Feedback Delivered</option>
                                            <option value="Cancelled">Cancelled</option>
                                            <option value="Draft Ready">Draft Ready</option>
                                            <option value="Draft Delivered">Draft Delivered</option>
                                            <option value="Other">Other</option>
                                            <option value="initiated">initiated</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                        <select id='purpose' class="form-control purpose" name="filter_check">
                                            <option value="title">Title</option>
                                            <option value="writer">Writer Name</option>
                                            <option value="college">College Name</option>
                                        </select>
                                    </div>
                                    <div id='hideqw' class="col-md-3 col-sm-3">
                                        <input type="text" name="title" class="form-control" value="" placeholder="Title, College, ">
                                    </div>

                                    <div class="col-md-3 col-sm-3" id='business' style='display:none'>
                                        <select name="writer_name" class="form-control" required>
                                            <option value=" " <?php if (@$obj['writer_name'] == ' ') {
                                                            echo "selected";
                                                        } ?>> </option>
                                            <option value="team 01" <?php if (@$obj['writer_name'] == 'team 01') {
                                                            echo "selected";
                                                        } ?>>team 1</option>
                                            <option value="team 02" <?php if (@$obj['writer_name'] == 'team 02') {
                                                            echo "selected";
                                                        } ?>>team 2</option>
                                            <option value="team 03" <?php if (@$obj['writer_name'] == 'team 03') {
                                                            echo "selected";
                                                        } ?>>team 3</option>
                                            <option value="team 04" <?php if (@$obj['writer_name'] == 'team 04') {
                                                            echo "selected";
                                                        } ?>>team 4</option>
                                            <option value="team 05" <?php if (@$obj['writer_name'] == 'team 05') {
                                                            echo "selected";
                                                        } ?>>team 5</option>
                                            <option value="team 06" <?php if (@$obj['writer_name'] == 'team 06') {
                                                            echo "selected";
                                                        } ?>>team 6</option>
                                            <option value="team 07" <?php if (@$obj['writer_name'] == 'team 07') {
                                                            echo "selected";
                                                        } ?>>team 7</option>
                                            <option value="team 08" <?php if (@$obj['writer_name'] == 'team 08') {
                                                            echo "selected";
                                                        } ?>>team 8</option>
                                            <option value="team 09" <?php if (@$obj['writer_name'] == 'team 09') {
                                                            echo "selected";
                                                        } ?>>team  9</option>
                                            <option value="team 010" <?php if (@$obj['writer_name'] == 'team 010') {
                                                        } ?>>team 10</option>
                                            <option value="team 011" <?php if (@$obj['writer_name'] == 'team 011') {
                                            } ?>>team 11</option>

                                            <option value="team 012" <?php if (@$obj['writer_name'] == 'team 012') {
                                            } ?>>team 12</option>
                                             <option value="team 013" <?php if (@$obj['writer_name'] == 'team 013') {
                                                                                                } ?>>team 13</option>
                                        </select>
                                    </div>
                                     <div class="col-md-3 col-sm-3" style= "margin-top: 10px">
                                        <select name="wid" class="form-control" >
                                            <option value="">Select an employee</option>
                                            <?php foreach ($writerTL as $employee) : ?>
                                                <option value="<?php echo $employee['id']; ?>"><?php echo $employee['name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <label class="control-label" style="visibility: hidden;"> Grade</label>
                                    <br>

                                    <input type="submit" class="btn btn-primary" value="Search" />

                                    <label class="control-label" style="visibility: hidden;"> Grade</label>

                                    <a href="<?php echo $data[0] ?>" class="btn btn-danger"> Reset</a>

                                    <label class="control-label" style="visibility: hidden;"> Grade</label>

                                    <button style="background-color: green; color:white;" id="headingOne" class="btn btn-link collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Show Filters
                                    </button>
                                </div>

                                <?php if ($role_id == 1) { ?>
                                    <div class="col-md-6 col-sm-6" style="text-align: right;">
                                        <label class="control-label" style="visibility: hidden;">Hidden</label>
                                        <br>
                                        <a href="<?php echo base_url('index.php/Orders/ordersCSV'); ?>" class="btn btn-success" type="button" style="border:none; background-color: red; color:white;">
                                            Export
                                        </a>
                                    </div>
                                <?php } ?>

                            </div>
                        </form>
                        <?php } ?>
                    </div>
                </div>
            </div>
            
            <?php if($role_id == 1 || $role_id == 4) {?>
            
            <div class="col-12">
                <div class="card">
                    <?php if (!empty($customer_id)): ?>
                    <div class='row' style="justify-content: center;">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModalw<?= $customer_id ?>" style="width:10%;text:end;justify-content: end;">
                            <i class="fas fa-phone-alt"></i> Call
                        </button>
                        <div class="modal fade bd-example-modal-xl" id="editModalw<?= $customer_id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content" style="width: 80%;">
                                    <div class="modal-header">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <!-- <h4 class="modal-title" id="exampleModalLabel1">Call Status Update</h4>  -->
                                            <h4>Drop Call Message</h4>
                                        </div>
                                        <div class="modal-body"> <!-- Added missing opening tag -->
                                            <div class="row col-md-12" >
                                                <div class="card-body" style="height:350px; overflow-y: auto; background-color:white;">
                                                    <div class="message mCustomScrollbar" data-mcs-theme="minimal-dark">
                                                        <div class="call_message">
                                                            <!-- Display messages will be shown here -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <div class="row col-md-12 m_form" id="m_form">
                                                        <div class="row col-md-12">
                                                            <div class="col-md-12 col-sm-12">
                                                                <div style="display:flex">
                                                                    <textarea type="text" id="m_des" placeholder="Type message" name="description" class="form-control" rows="2" value="" autofocus autocomplete="off" style="resize: none;"></textarea>
                                                                    <input type="hidden" name='c_id' value="<?php echo $customer_id ?>">
                                                                    <button id="send_message" type="button"><i class="fas fa-paper-plane"></i></button>
                                                                </div>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                </div> 
                                            </div>  
                                        </div>                 
                                    </div>                 
                                </div>                 
                            </div>                 
                        </div>                 
                    </div>                 
                </div>                 
            </div>                 
            <?php endif; ?>
            
            <?php } ?>
            <!-- Closed : Filters -->
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="demo-foo-addrow" class="table table-bordered m-t-30 table-hover contact-list" data-paging="true" data-paging-size="7">
                                <thead>
                                    <tr>
                                        <th style="white-space: nowrap; " class="hide-mb"> #</th>
                                        <th style="white-space: nowrap;"  > Order Code</th>
                                        <th style="white-space: nowrap;" class="hide-mb"> Order Date</th>
                                        <th style="white-space: nowrap;"  class="hide-mb"> Delivery Date</th>
                                        <th style="white-space: nowrap;"class="hide-mb"> Title</th>
                                        <?php if($role_id != 6 && $role_id != 7 && $role_id != 8) { ?>
                                        <th style="white-space: nowrap;"  class="hide-mb"> Status</th>
                                        <?php } ?>
                                          <?php if($role_id == 6  || $role_id == 7 || $role_id == 8) { ?>
                                        <th style="white-space: nowrap;"  class="hide-mb">Writer Status</th>
                                        <?php } ?>
                                        
                                        <th style="white-space: nowrap;" class="hide-mb"> Words</th>
                                        <?php if($role_id != '5' &&  $role_id != '6' && $role_id != '7' && $role_id != '8') {  ?>
                                        <th style="white-space: nowrap;" class="hide-mb"> Amount</th>
                                        <th style="white-space: nowrap;" class="hide-mb"> Paid </th>
                                        <th style="white-space: nowrap;" class="hide-mb"> Due </th>
                                        <?php } if( $role_id == '1' || $role_id == '8') { ?>

                                        <th style="white-space: nowrap;" class="hide-mb"> Writer Team Leader </th> <?php } ?>

                                        <?php if( $role_id == '1' || $role_id == '8' || $role_id == '6') { ?>

                                        <th style="white-space: nowrap;" class="hide-mb"> Writer </th> <?php } ?>

                                        <?php  if ($role_id != 2 && $role_id != 4) { ?>
                                            <?php  if ($role_id != 7 && $role_id != 6 && $role_id != 8) { ?>
                                            <th style="white-space: nowrap;"class="hide-mb"> Writer Name</th>
                                            <?php } ?>
                                             <?php  if ($role_id != 7 && $role_id != 6 && $role_id != 8) { ?>
                                            <th style="white-space: nowrap;" class="hide-mb">Writer Deadline</th>
                                            <?php } ?>
                                           
                                        <?php } ?>
                                        <!-- <th style="white-space: nowrap;" > Action </th> -->
                                        <?php if($role_id != '2') { ?>
                                        <th style="white-space: nowrap;" class="hide-mb">Action</th>
                                     
                                       <?php  } else { ?>
                                           <th style="white-space: nowrap; " class="" >  <i class="fa fa-check btn bg-primary" style="font-size: 15px;"></i> </th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($orders as $obj) { ?>
                                   <?php
                                     if($role_id != 6 && $role_id != 7 && $role_id != 8)
                                     {
                                          if ($obj['c_is_fail'] == 1 && $obj['is_fail'] == 1) {
                                            $class = "red-background";
                                        } elseif ($obj['c_is_fail'] == 1 && $obj['is_fail'] == 0) {
                                            $class = "lite-blue-background";
                                        } else {
                                            $class = "";  // No background color
                                        }
                                    
                                     }else
                                     {
                                          $class = "";
                                     }

                                     ?>

                                    <style>
                                            .lite-blue-background {
                                                color: blue;
                                            }
                                            
                                            .red-background {
                                                color: red;
                                            }
                                        </style>
                                    



                                        <tr <?php if ($obj['is_read'] == 0) { ?> style="font-weight: 700;" <?php } ?> class="read_order <?php echo $class ?> " order_id="<?= $obj['id']  ?>">
                                            <input type="hidden" class="row_id" value="<?= $obj['id'] ?>">
                                            <input type="hidden" class="uid" value="<?= $obj['uid'] ?>">
                                            <td class="hide-mb">
                                                <?php echo $i; ?>
                                            </td>
                                            <td style="white-space: nowrap;">
                                                <?php echo $obj['order_id']; ?>
                                            </td >
                                            <td class="hide-mb" style="white-space: nowrap;">
                                                <?php echo date('d-M-Y', strtotime($obj['order_date'])); ?>
                                            </td >
                                            <td class="hide-mb" id='v' style="white-space: nowrap;">
                                                <?php
                                                echo date('d-M-Y', strtotime($obj['delivery_date']));
                                                if (isset($obj['delivery_time']) && !empty($obj['delivery_time'])) {echo ' ( ' . $obj['delivery_time'] . ' )';}
                                                ?>
                                                <div style="color:green">
                                                <?php if($obj['draftrequired'] == 'Yes') 
                                                {
                                                    echo date('d-M-Y', strtotime($obj['draft_date']));
                                                    if (isset($obj['draft_time']) && !empty($obj['draft_time'])) {
                                                        echo ' ( ' . $obj['draft_time'] . ' )';
                                                    }
                                                }
                                                ?>
                                                </div>

                                                
                                            </td>
                                           
                                            
                                               
                                               
                                            <td class="hide-mb">
                                                <?php echo $obj['title']; 
                                                ?>
                                                <div style='color:red'>
                                                <?php 
                                                if ($obj['typeofpaper'] == 'Dissertation (all chapters)' ||$obj['typeofpaper'] == 'Thesis (all chapters)' || $obj['typeofpaper'] == 'Research Paper')
                                                {
                                                    echo $obj['chapter'];
                                                }
                                                ?>
                                                </div>
                                                
                                            </td>

                                            <td class="hide-mb" style="white-space: nowrap;">
                                                <?php
                                                if ($obj['projectstatus'] == 'Pending') {
                                                    $color = "#ff8acc";
                                                } elseif ($obj['projectstatus'] == 'Cancelled') {
                                                    $color = "red";
                                                    
                                                } elseif ($obj['projectstatus'] == 'Hold Work') {
                                                    $color = "red";
                                                    
                                                } elseif ($obj['projectstatus'] == 'Completed' || $obj['projectstatus'] == 'Draft Ready') {
                                                    $color = "#fec107";
                                                } elseif ($obj['projectstatus'] == 'In Progress') {
                                                    $color = "#5b69bc";
                                                } elseif ($obj['projectstatus'] == 'Feedback') {
                                                    $color = "black";
                                                } elseif ($obj['projectstatus'] == 'Delivered' || $obj['projectstatus'] == 'Draft Delivered' || $obj['projectstatus'] == 'Feedback Delivered') {
                                                    $color = "green";
                                                } elseif ($obj['projectstatus'] == 'initiated') {
                                                    $color = "#fb9678";
                                                } else {
                                                    $color = "#35b8e0";
                                                }
                                                ?>
                                                <?php if($role_id != 6 && $role_id != 7 && $role_id != 8) { ?>
                                                <span class="label label-primary" style="background-color:<?= $color ?>;">
                                                    <?= $obj['projectstatus'] ?>
                                                </span>
                                                <?php } ?>
                                                
                                                <?php
                                                if ($obj['writer_status'] == 'Quality Accepted') {
                                                    $colorwrier = "blue";
                                                } elseif ($obj['writer_status'] == 'Quality Rejected') {
                                                    $colorwrier = "red";
                                                    
                                                } elseif ($obj['writer_status'] == 'In Progress') {
                                                    $colorwrier = "#5b69bc";
                                                    
                                                } elseif ($obj['writer_status'] == 'Completed' ) {
                                                    $colorwrier = "#fec107";
                                                } 
                                                else {
                                                    $colorwrier = "green";
                                                }
                                                ?>
                                                 <?php if($role_id == 6 || $role_id == 7 || $role_id == 8) { ?>
                                                <span class="label label-primary" style="background-color:<?= $colorwrier ?>;">
                                                    <?= $obj['writer_status'] ?>
                                                </span>
                                                <?php } ?>
                                            </td>

                                            <td style="white-space: nowrap; " class="hide-mb">
                                                <?php
                                                $data = $obj['pages'];
                                                $data1 = explode(' (', $data);
                                                @$data_new = explode(' ', $data1['1']);
                                                if (isset($data_new['0']) && !empty($data_new['0'])) {
                                                    echo $data_new['0'];
                                                } else {
                                                    echo $obj['pages'];
                                                }
                                                ?>
                                            </td>
 
                                            <?php if($role_id != 5 && $role_id != '6' && $role_id != '7' && $role_id != '8') { ?>
                                            <td style="white-space: nowrap;" class="hide-mb">
                                                <?php echo @$obj['amount']; ?> &#163;
                                            </td>
                                            <?php } ?>
                                            <?php
                                            if (!isset($obj['amount']) && empty($obj['amount'])) {
                                                $obj['amount'] = 0;
                                            }
                                            ?>
                                             <?php if($role_id != 5 && $role_id != '6' && $role_id != '7' && $role_id != '8') { ?>
                                            <td style="white-space: nowrap;" class="hide-mb">
                                                <?php echo @$obj['received_amount']; ?> &#163;
                                            </td>
                                            
                                            
                                            <td style="white-space: nowrap;" class="hide-mb">
                                                <?php
                                                if (!isset($obj['amount']) && empty($obj['amount'])) {
                                                    $obj['amount'] = 0;
                                                }
                                                echo (float)$obj['amount'] - (float)$obj['received_amount'];
                                                ?>
                                                &#163;
                                            </td>
                                            <?php } ?>

                                            <?php if ($role_id == 1|| $role_id == 8 ) { ?>
                                            <td class="hide-mb">

                                               <?php foreach ($writerTL as $employee) : ?>
                                                    <?php if (@$employee['id'] == $obj['wid']) {
                                                        echo $employee['name'];
                                                    } ?>
                                                <?php endforeach; ?>
                                            </td>
                                       
                                            <?php } ?>
                                            <?php if ($role_id == 8 || $role_id == 1 || $role_id == 6) { ?>
                                                <td class="hide-mb">
                                                
                                                <?php if($obj['swid'] != 0  ){  ?>
                                                <?php if($obj['swid'] == $obj['wid']  ){ ?>
                                                    Self
                                                <?php } }?>
                                                <?php foreach ($subwrtier as $employee) : ?>
                                                        <?php if (@$employee['id'] == $obj['swid']) {
                                                            echo $employee['name'];
                                                        } ?>
                                                    <?php endforeach; ?>
                                                </td>
                                            <?php } ?>
                                            <?php
                                                if($role_id != 4) {
                                                ?>
                                                  <?php if($role_id != 6 && $role_id != 7 && $role_id != 8) { ?>
                                                <td class="hide-mb">
                                                    <?php echo $obj['writer_name']; ?>
     
                                                </td>
                                                <?php }?>
                                                
                                            
                                                 <?php  if ($role_id != 7 && $role_id != 6 && $role_id != 8) { ?>
                                                <td class="hide-mb" >
                                                    <?php if (($obj['writer_deadline'] != '1970-01-01') and (!empty($obj['writer_deadline']))) {
                                                        echo date('d-M-Y', strtotime($obj['writer_deadline']));
                                                    }   ?>
                                                </td>
                                                <?php }  }?>
                                           

                                            <td style="display:none;"><?php echo $obj['c_name']; ?></td>
                                            <td style="display:none;"><?php echo $obj['c_mobile']; ?></td>
                                            <td style="display:none;"><?php echo $obj['c_email']; ?></td>

                                            <!-- Action Buttons -->
                                            <td style="white-space: nowrap;">
                                                    
                                            <?php if($role_id != '2') { ?>
                                                <a class="btn btn-xs btn-info btn-sm m-1" data-bs-toggle="modal" data-bs-target="#view<?php echo $obj['id']; ?>">
                                                    <i style="color:#fff;" class="fa fa-eye"></i>
                                                </a>
                                                <?php  }   ?>

                                                <?php if ($role_id == 1) { ?>
                                                    
                                                    <a href="<?php echo base_url(); ?>index.php/Orders/edit/<?php echo $obj['order_id']; ?>" type="button" class="btn btn-xs btn-dark btn-sm m-1"  title="Order Edit">
                                                        <i style="color:#fff;" class="fa fa-edit"></i>
                                                    </a>
                                                <?php }  ?>
                                                       
                                                       <?php if($role_id == 6 || $role_id == 7 || $role_id == 8) {?> 
                                                       <a type="button" class="btn btn-xs btn-dark btn-sm m-1" data-bs-toggle="modal" data-bs-target="#editModalw<?= $obj['id'] ?>" title="Order Edit">
                                                        <i style="color:#fff;" class="fa fa-edit"></i>
                                                        </a>
                                                        <div class="modal fade bd-example-modal-xl" id="editModalw<?= $obj['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-xl">
                                                                
                                                                <div class="modal-content" style="width: 80%;">
                                                                    <div class="modal-header">
                                                                        <h3 class="modal-title" id="exampleModalLabel">
                                                                            <a href="<?php echo base_url(); ?>index.php/Orders/edit/<?php echo $obj['order_id']; ?>" target="_blank">
                                                                                <i class="fa fa-external-link"></i>
                                                                            </a>
                                                                            Update Order <a href=""> <span style="color:lightsalmon"> Order ID : <?= $obj['order_id'] ?> </span></a>

                                                                        </h3>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <form class="floating-labels m-t-40" role="form" method="post" action="<?php echo base_url(); ?>index.php/Orders/writeEdit/<?= $obj['id'] ?>" enctype="multipart/form-data">
                                                                <div class="modal-body">
                                                                    <div class="card-body">
                                                                        <input type="hidden" name="backurl" value="<?= $current_page ?>">
                                                                        <input type="hidden" name="edit_id" value="<?= $obj['id'] ?>">
                                                                        <input type="text" style="display:none;" name="order_id" class="form-control" value="<?= $obj['order_id'] ?>" autofocus readonly="readonly">
                                                                        <input type="text" style="display:none;" name="order_type" value="Back-End">

                                                                        <div class="row">
                                                                            <div class="col-lg-4">
                                                                                <?php if ($role_id == 8): ?>
                                                                                <div class="form-group has-warning m-b-40">
                                                                                    <label class="control-label">Select Writer</label>
                                                                                    <select name="writer_name_new" class="form-control" id="writerSelect<?php echo $obj['order_id'] ?>">
                                                                                        <option value="">Select a Writer</option>
                                                                                        <?php if ($role_id == 8) { ?><option value="<?php echo $loginid ?>">Select Self Writer</option><?php } ?>
                                                                                        <?php foreach ($writerTL as $employeeS): ?>
                                                                                        <option value="<?= $employeeS['id']; ?>" <?= @$employeeS['id'] == $obj['wid'] ? "selected" : ""; ?>>
                                                                                            <?= $employeeS['name']; ?>
                                                                                        </option>
                                                                                        <?php endforeach; ?>
                                                                                    </select>
                                                                                </div>
                                                                                <?php else: ?>
                                                                                <input type="hidden" name="writer_name_new" value="<?= $obj['wid'] ?>">
                                                                                <?php endif; ?>

                                                                                <script>
                                                                                    $(document).ready(function () {
                                                                                        $('#writerSelect<?php echo $obj['order_id'] ?>').change(function () {
                                                                                            var selectedValue = $(this).val();
                                                                                            $('#selectedWriterDisplay<?php echo $obj['order_id'] ?>').text(selectedValue);

                                                                                            if (selectedValue !== "") {
                                                                                                $('#subwriterDropdown<?php echo $obj['order_id'] ?>').show(); // Corrected typo: changed 'shw' to 'show'
                                                                                            } else {
                                                                                                $('#subwriterDropdown<?php echo $obj['order_id'] ?>').hide(); // Corrected typo: changed 'hde' to 'hide'
                                                                                            }

                                                                                            var subwriterDropdown = $('#subwriterDropdown<?php echo $obj['order_id'] ?> select');
                                                                                            subwriterDropdown.find('option').hide();
                                                                                            subwriterDropdown.find('option[data-tl-id="' + selectedValue + '"]').show();
                                                                                        });
                                                                                    });
                                                                                </script>

                                                                                <?php if ($obj['wid'] != 0 && $role_id != 7) { ?>
                                                                                <div id="subwriterDropdown<?php echo $obj['order_id'] ?>" class="form-group has-warning m-b-40" onchange="toggleDropdown()" style="display: ;">
                                                                                    <label class="control-label">Select Subwriter</label>
                                                                                    <select name="subwriter_name_new" id="subwriterDropdownss<?php echo $obj['order_id'] ?>" class="form-control">
                                                                                        <option value="">Select a Subwriter</option>
                                                                                        <option value="<?= $loginid ?>" <?= $loginid == $obj['swid'] ? "selected" : ""; ?>>Select yourself as Writer</option>
                                                                                        <?php foreach ($subwrtier as $employee): ?>
                                                                                        <option value="<?= $employee['id']; ?>" data-tl-id="<?= $employee['tl_id']; ?>" <?= @$employee['id'] == $obj['swid'] ? "selected" : ""; ?>>
                                                                                            <?= $employee['name']; ?>
                                                                                        </option>
                                                                                        <?php endforeach; ?>
                                                                                    </select>
                                                                                </div>
                                                                                <?php } else { ?>
                                                                                <div id="subwriterDropdown<?php echo $obj['order_id'] ?>" class="form-group has-warning m-b-40" style="display: none;">
                                                                                    <label class="control-label">Select Subwriter</label>
                                                                                    <select name="subwriter_name_new" class="form-control">
                                                                                        <option value="">Select a Subwriter</option>
                                                                                        <?php foreach ($subwrtier as $employee): ?>
                                                                                        <option value="<?= $employee['id']; ?>" data-tl-id="<?= $employee['tl_id']; ?>" <?= @$employee['id'] == $obj['swid'] ? "selected" : ""; ?>>
                                                                                            <?= $employee['name']; ?>
                                                                                        </option>
                                                                                        <?php endforeach; ?>
                                                                                    </select>
                                                                                </div>
                                                                                <?php } ?>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row">
                                                                            <?php if ($role_id == 6) { ?>
                                                                            <div class="col-lg-4">
                                                                                <div class="form-group has-warning m-b-40">
                                                                                    <?php if ($obj['swid'] == $loginid) { ?>
                                                                                    <select id="firstDropdown<?php echo $obj['order_id'] ?>" name="writer_status" class="form-control" style="display:none">
                                                                                        <option value="">Select a status</option>
                                                                                        <option value="Quality Accepted">Quality Accepted</option>
                                                                                        <option value="Quality Rejected">Quality Rejected</option>
                                                                                    </select>
                                                                                    <select id="secondDropdownLOGIN<?php echo $obj['order_id'] ?>" name="writer_status" class="form-control">
                                                                                        <option value="" <?php if (@$obj['writer_status'] == 'NULL ') {echo "selected";} ?>>Select a status</option>
                                                                                        <option value="In Progress" <?php if (@$obj['writer_status'] == 'In Progress') {echo "selected";} ?>>In Progress</option>
                                                                                        <option value="Completed" <?php if (@$obj['writer_status'] == 'Completed') {echo "selected";} ?>>Completed</option>
                                                                                        <option value="Delivered" <?php if (@$obj['writer_status'] == 'Delivered') {echo "selected";} ?>>Delivered</option>
                                                                                    </select>
                                                                                    <?php } else { ?>
                                                                                    <select id="secondDropdown<?php echo $obj['order_id'] ?>" name="writer_status" style="display:none" class="form-control">
                                                                                        <option value="">Select a status</option>
                                                                                        <option value="In Progress">In Progress</option>
                                                                                        <option value="Completed">Completed</option>
                                                                                        <option value="Delivered">Delivered</option>
                                                                                    </select>
                                                                                    <select id="firstDropdownlogin<?php echo $obj['order_id'] ?>" name="writer_status" class="form-control">
                                                                                        <option value="">Select a status</option>
                                                                                        <option value="Quality Accepted"><?php if (@$obj['writer_status'] == 'Quality Accepted') {echo "selected";} ?>Quality Accepted</option>
                                                                                        <option value="Quality Rejected"><?php if (@$obj['writer_status'] == 'Quality Rejected') {echo "selected";} ?>Quality Rejected</option>
                                                                                    </select>
                                                                                    <?php } ?>
                                                                                </div>
                                                                            </div>
                                                                            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                                                            <script>
                                                                                document.addEventListener("DOMContentLoaded", function () {
                                                                                    var subwriterDropdown = document.getElementById("subwriterDropdownss<?php echo $obj['order_id'] ?>");
                                                                                    var selectedValueDisplay = document.getElementById("selectedValueDisplay");
                                                                                    var firstDropdown = $('#firstDropdown<?php echo $obj['order_id'] ?>');
                                                                                    var firstDropdownlogin = $('#firstDropdownlogin<?php echo $obj['order_id'] ?>');
                                                                                    var secondDropdownLOGIN = $('#secondDropdownLOGIN<?php echo $obj['order_id'] ?>');
                                                                                    var secondDropdown = $('#secondDropdown<?php echo $obj['order_id'] ?>');
                                                                                    subwriterDropdown.addEventListener("change", function () {
                                                                                        var selectedValue = subwriterDropdown.value;
                                                                                        if (selectedValue == <?= $loginid ?>) {
                                                                                            firstDropdown.hide();
                                                                                            secondDropdownLOGIN.show();
                                                                                            secondDropdown.show();
                                                                                            firstDropdownlogin.hide();
                                                                                        } else {
                                                                                            firstDropdown.show();
                                                                                            secondDropdown.hide();
                                                                                            secondDropdownLOGIN.hide();
                                                                                            firstDropdownlogin.hide();
                                                                                        }
                                                                                    });
                                                                                });
                                                                            </script>
                                                                            <?php } ?>

                                                                            <?php if ($role_id == 8) { ?>
                                                                            <div class="col-lg-4">
                                                                                <select name="writer_status" class="form-control">
                                                                                    <option value="" <?php if (@$obj['writer_status'] == 'NULL') {echo "selected";} ?>>Select a status</option>
                                                                                    <option value="Quality Accepted" <?php if (@$obj['writer_status'] == 'Quality Accepted') {echo "selected";} ?>>Quality Accepted</option>
                                                                                    <option value="Quality Rejected" <?php if (@$obj['writer_status'] == 'Quality Rejected') {echo "selected";} ?>>Quality Rejected</option>
                                                                                    <option value="In Progress" <?php if (@$obj['writer_status'] == 'In Progress') {echo "selected";} ?>>In Progress</option>
                                                                                    <option value="Completed" <?php if (@$obj['writer_status'] == 'Completed') {echo "selected";} ?>>Completed</option>
                                                                                    <option value="Delivered" <?php if (@$obj['writer_status'] == 'Delivered') {echo "selected";} ?>>Delivered</option>
                                                                                </select>
                                                                            </div>
                                                                            <?php } ?>

                                                                            <?php if ($role_id == 7) { ?>
                                                                            <div class="col-lg-4">
                                                                                <select name="writer_status" class="form-control" required>
                                                                                    <option value="" <?php if (@$obj['writer_status'] == 'NULL ') {echo "selected";} ?>>Select a status</option>
                                                                                    <option value="In Progress" <?php if (@$obj['writer_status'] == 'In Progress') {echo "selected";} ?>>In Progress</option>
                                                                                    <option value="Completed" <?php if (@$obj['writer_status'] == 'Completed') {echo "selected";} ?>>Completed</option>
                                                                                    <option value="Delivered" <?php if (@$obj['writer_status'] == 'Delivered') {echo "selected";} ?>>Delivered</option>
                                                                                </select>
                                                                            </div>
                                                                            <?php } ?>
                                                                        </div>

                                                                        <div class="row">
                                                                            <input style="display:none" type="button" id="d<?php echo $obj['order_id']; ?>" class="btn btn-primary btn-block" value="Update" onclick="myFunction<?php echo $obj['order_id']; ?>()">
                                                                            <button type="submit" id='nd<?php echo $obj['order_id']; ?>' class="btn btn-primary btn-block">Update</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>


                                                                        </div> 
                                                                    </div> 
                                                                </div> 
                                                            </div>  
                                                         </div>   
                                                        <?php } ?>

                                                <?php if ($role_id != 2) { ?>

                                                    <?php
                                                    if (isset($obj['quotation_status']) && $obj['quotation_status'] == 1) {
                                                        $btn_class = 'success';
                                                    } else {
                                                        $btn_class = 'danger';
                                                    }
                                                    ?>
                                                    <?php if($role_id !=6 && $role_id !=7 && $role_id !=8) { ?>
                                                    <?php if (($obj['projectstatus'] == 'Other') |  ($obj['projectstatus'] == 'Other') || ($obj['projectstatus'] == 'In Progress') || ($obj['projectstatus'] == 'Pending')  || ($obj['projectstatus'] == 'initiated'  ) ) { ?>
                                                        <a class="btn btn-xs btn-<?= $btn_class ?> btn-sm m-1 sendmail"   >
                                                            <input type="hidden" value = "<?= $obj['id'] ?>" name='id'  >
                                                            <input type="checkbox" id="master"  style="display:none" >
                                                            <input type="checkbox" class="sub_chk"   value="<?php echo $obj['id']; ?>" style="display:none" />
                                                            <i class="fa fa-envelope"></i>
                                                        </a>
                                                    <?php } } ?>

                                                
                                                        <?php if ($role_id == 3 || $role_id == 4 || $role_id == 5) { ?>
                                                            <a href="<?php echo base_url(); ?>index.php/Orders/edit/<?php echo $obj['order_id']; ?>" type="button" class="btn btn-xs btn-dark btn-sm m-1"  title="Order Edit">
                                                                <i style="color:#fff;" class="fa fa-edit"></i>
                                                            </a>
                                                        <?php } ?>
                                                  

                                                  

                                                        <?php if($role_id != 6 && $role_id != 5 &&  $role_id != 7 &&  $role_id != 8)  { ?>
                                                        <a href="<?php echo base_url(); ?>index.php/Orders/payments/<?php echo $obj['id']; ?>" type="button" class="btn btn-xs btn-primary btn-sm m-1"  title="Order Payment" style="background-color: red;">
                                                            <i style="color:#fff;" class="fa fa-money"></i>
                                                        </a>
                                                        <?php } ?>

                                                    <?php if($role_id != 6 && $role_id != 7 &&$role_id != 8) { ?>
                                                    <?php if ($obj['projectstatus'] == 'Pending' || $obj['projectstatus'] == 'Cancelled') { ?>
                                                        <a class="btn btn-xs btn-warning btn-sm m-1" href="<?php echo base_url(); ?>index.php/Orders/callstatus/<?php echo $obj['id']; ?>">
                                                            <i style="color:#fff;" class="fa fa-phone"></i>
                                                        </a>
                                                        
                                                    <?php } ?>

                                                    <?php } } ?>

                                                <!-- Mark Job Failed -->
                                                
                                                <?php if($role_id != '2' && $role_id != '6' &&  $role_id != '7'  &&  $role_id != '8' ) { ?>
                                                <a type="button" class="btn btn-xs btn-primary btn-sm m-1 mark_as_failed" title="Mark as failed job" style="background-color:tomato;">
                                                    <i style="color:#fff;" class="fa fa-close"></i>
                                                </a>
                                                <?php } ?>

                                               
                                                <!-- / Mark Job Failed -->

                                                <!-- Button trigger modal -->
                                                <?php if($role_id != 6 && $role_id != 7 && $role_id != 8)  { ?>
                                                <a type="button" class="btn btn-xs btn-primary btn-sm m-1" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $obj['id'] ?>" title="More buttons">
                                                    <i style="color:#fff;" class="fa fa-list"></i>
                                                </a>
                                                <?php } ?>
                                                <?php if($obj['swid'] != $loginid && $obj['swid'] != 0) {?>
                                                <?php if($role_id == 6 || $role_id == 7 || $role_id == 1) {?>
                                                <a href="<?php echo base_url(); ?>index.php/Orders/updateCallsData/<?php echo $obj['order_id']; ?>"  type="button" class="btn btn-xs btn-primary btn-sm m-1 " title="" style="background-color:green;">
                                                   W
                                                </a>
                                                <?php } } ?>
                                                
                                                <?php if( $role_id == 7 ) {?>
                                                 <a href="<?php echo base_url(); ?>index.php/Orders/updateCallsData/<?php echo $obj['order_id']; ?>"  type="button" class="btn btn-xs btn-primary btn-sm m-1 " title="" style="background-color:green;">
                                                   W
                                                </a>
                                                <?php } ?>
                                               
                                                <?php if($role_id == 6 ||  $role_id == 1 || $role_id == 5 ){ ?> 
                                                    <a href="<?php echo base_url(); ?>index.php/Orders/orderchatc/<?php echo $obj['order_id']; ?>"  type="button" class="btn btn-xs btn-primary btn-sm m-1 " title="" style="background-color:green;">
                                                      C
                                                    </a>
                                                    <?php }
                                                ?>

                                                <?php if($obj['admin_id'] != 0 ) {?>
                                                    <?php if($role_id == 6 || $role_id == 8 || $role_id == 1) {?>
                                                        <a href="<?php echo base_url(); ?>index.php/Orders/updateadmin/<?php echo $obj['order_id']; ?>"  type="button" class="btn btn-xs btn-primary btn-sm m-1 " title="" style=";background-color:#6699CC;">
                                                        A
                                                        </a>
                                                    <?php } 
                                                } ?>

                                                
                                                <!-- Button trigger modal -->

                                                <!-- More Buttons Modal -->
                                                <div class="modal fade" id="exampleModal<?= $obj['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">More Buttons</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-bodwy">
                                                                <?php if ($role_id == 1) { ?>
                                                                    <a style="color:#fff;" class="btn btn-xs btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#duplicate<?php echo $obj['id']; ?>">
                                                                        <i class="fa fa-first-order" aria-hidden="true"></i>
                                                                    </a>
                                

                                                                    <!-- Duplicate row modal -->
                                                                    <div class="modal fade" id="duplicate<?php echo $obj['id']; ?>" role="dialog">
                                                                        <div class="modal-dialog">
                                                                            <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Orders/duplicate/<?php echo $obj['id']; ?>">
                                                                                <!-- Modal content-->
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h4 class="modal-title">Confirm Header </h4>
                                                                                        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <p>Are you sure, you want to create duplicate Order ? </p>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="submit" class="btn btn-primary ">Submit</button>
                                                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>

                                                                <?php } ?>

                                                                <?php if ($role_id == 2) { ?>
                                                                    <button class="btn btn-info btn-sm" data-bs-toggle="modal" title="Download File" data-bs-target="#download<?php echo $obj['id']; ?>"><i class="fa fa-download"></i></button>
                                                                <?php } ?>

 
                                                                <?php if($role_id == '2') { ?>
                                                                <a class="btn btn-xs btn-info btn-sm m-1" data-bs-toggle="modal" data-bs-target="#view<?php echo $obj['id']; ?> " >
                                                                    <i style="color:#fff;" class="fa fa-eye"></i>
                                                                </a>    
                                                                <?php } ?>
                                                                
                                                                <?php if ($role_id != 2) { ?>

                                                                    <?php 
                                                                    // if (($obj['projectstatus'] == 'Delivered') ||  ($obj['projectstatus'] == 'Feedback Delivered') || ($obj['projectstatus'] == 'Draft Delivered')|| ($obj['projectstatus'] == 'Completed')) {
                                                                    ?>
                                                                        <a class="btn btn-xs btn-success btn-sm" href="<?php echo base_url(); ?>index.php/Orders/UploadOrder/<?php echo $obj['id']; ?>">
                                                                            <i style="color:#fff;" class="fa fa-check"></i>
                                                                        </a>
                                                                    <?php
                                                                    // }
                                                                    ?>

                                                                    <a class="btn btn-xs  btn-secondary btn-sm m-1" href="<?php echo base_url(); ?>index.php/Orders/callstatus/<?php echo $obj['id']; ?>">
                                                                        <i style="color:#fff;" class="fa fa-phone"></i>
                                                                    </a>

                                                                    <a class="btn btn-xs btn-success btn-sm" href="<?php echo base_url(); ?>index.php/Orders/EditOrderFile/<?php echo $obj['id']; ?>">
                                                                        <i style="color:#fff;" class="fa fa-upload"></i>
                                                                    </a>

                                                                    <?php if ($role_id != 1) { ?>
                                                                        <a style="color:#fff;" class="btn btn-xs btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#duplicate<?php echo $obj['id']; ?>">
                                                                            <i class="fa fa-first-order" aria-hidden="true"></i>
                                                                        </a>

                                                                        <!-- Duplicate row modal -->
                                                                        <div class="modal fade" id="duplicate<?php echo $obj['id']; ?>" role="dialog">
                                                                            <div class="modal-dialog">
                                                                                <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Orders/duplicate/<?php echo $obj['id']; ?>">
                                                                                    <!-- Modal content-->
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h4 class="modal-title">Confirm Header </h4>
                                                                                            <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <p>Are you sure, you want to create duplicate Order ? </p>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="submit" class="btn btn-primary ">Submit</button>
                                                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    <?php } ?>

                                                                    <?php if ($role_id == 1) { ?>
                                                                        <a class="btn btn-xs btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete<?php echo $obj['id']; ?>">
                                                                            <i style="color:#fff;" class="fa fa-trash"></i>
                                                                        </a>
                                                                    <?php } ?>

                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- / More Buttons Modal -->
                                            </td>
                                            

                                            <!-- View Modal -->
                                            <div class="modal fade" id="view<?php echo $obj['id']; ?>" role="dialog" tabindex="-1" aria-labelledby="classInfo" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title"><?php echo $obj['order_id']; ?> Details </h4>
                                                            <button type="button" class="close btn" data-bs-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <?php if($role_id != '5' && $role_id != '6' && $role_id != '7' && $role_id != '8') { ?> 
                                                                    
                                                                    <fieldset class="scheduler-border">
                                                                        <legend class="scheduler-border"> Customer Details <?= $obj['c_name'] ?></legend>
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Customer Name :</label>
                                                                                <span> <?php echo $obj['c_name']; ?></span>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Email :</label>
                                                                                <span> <?php echo $obj['c_email']; ?></span>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Mobile :</label>
                                                                                <span> <?php echo '+' . $obj['countrycode'] . ' - ' . $obj['c_mobile']; ?></span>
                                                                            </div>
                                                                        </div>
                                                                    </fieldset>
                                                                    <?php }  ?>
                                                                    <fieldset class="scheduler-border">
                                                                        <legend class="scheduler-border"> Order Details</legend>
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Order Type :</label>
                                                                                <span> <?php echo $obj['order_type']; ?></span>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Project Title:</label>
                                                                                <span> <?php echo $obj['title']; ?></span>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Order Id :</label>
                                                                                <span> <?php echo $obj['order_id']; ?></span>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Order Date :</label>
                                                                                <span> <?php echo date('d-M-Y', strtotime($obj['order_date'])); ?></span>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Delivery Date :</label>
                                                                                <span> <?php echo date('d-M-Y', strtotime($obj['delivery_date'])); ?></span>
                                                                            </div>
                                                                            <?php if($role_id != 5 && $role_id != 4) { ?>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Type Of Service :</label>
                                                                                <span> <?php echo $obj['services']; ?></span>
                                                                            </div>
                                                                           
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Formatting:</label>
                                                                                <span> <?php echo $obj['formatting']; ?></span>
                                                                            </div>
                                                                            <?php } ?>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Type Of Paper:</label>
                                                                                <span> <?php echo $obj['typeofpaper']; ?></span>
                                                                            </div>
                                                                            <?php if($role_id != 4){ ?>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Type Of Writting:</label>
                                                                                <span> <?php echo $obj['typeofwritting']; ?></span>
                                                                            </div>
                                                                            <?php } ?>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Pages:</label>
                                                                                <span> <?php echo $obj['pages']; ?></span>
                                                                            </div>
                                                                              <?php if($role_id != '6' &&  $role_id != '7' && $role_id != '8') { ?>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Deadline:</label>
                                                                                <span> <?php echo $obj['deadline']; ?> Day</span>
                                                                            </div>
                                                                            <?php if($role_id != '5') { ?>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Discount % :</label>
                                                                                <span> <?php echo $obj['discount_per']; ?> %</span>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Final Amount:</label>
                                                                                <span> <?php echo $obj['amount']; ?> &#163;</span>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Paid Amount:</label>
                                                                                <span> <?php echo $obj['received_amount']; ?> &#163;</span>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Due Amount:</label>
                                                                                <span>
                                                                                    <?php
                                                                                    if (!isset($obj['amount']) && empty($obj['amount'])) {
                                                                                        $obj['amount'] = 0;
                                                                                    }
                                                                                    echo (int)$obj['amount'] - (int)$obj['received_amount'];
                                                                                    ?>
                                                                                    &#163;
                                                                                </span>
                                                                            </div>
                                                                           <?php } ?>
                                                                           <?php if($role_id != '5' && $role_id != '4'){ ?>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Payment Status:</label>
                                                                                <span> <?php echo $obj['paymentstatus']; ?></span>
                                                                            </div>
                                                                            <?php } } ?>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Project Status:</label>
                                                                                <span> <?php echo $obj['projectstatus']; ?></span>
                                                                            </div>
                                                                          

                                                                            <?php if($obj['typeofpaper'] == 'Dissertation (all chapters)' ||$obj['typeofpaper'] == 'Thesis (all chapters)' || $obj['typeofpaper'] == 'Research Paper') { ?>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Chapter:</label>
                                                                                <span> <?php echo $obj['chapter']; ?></span>
                                                                            </div>
                                                                            <?php } ?>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Message:</label>
                                                                                <span> <?php echo $obj['message']; ?></span>
                                                                            </div>

                                                                        </div>
                                                                    </fieldset>
                                                                </div>
                                                            </div>
                                                            <fieldset class="scheduler-border">
                                                                <legend class="scheduler-border"> Documents Details</legend>
                                                                <?php
                                                                if (!empty($obj['order_file_details'])) {
                                                                    $j = 1;
                                                                    foreach ($obj['order_file_details'] as  $file_details) {  ?>
                                                                        <div class="row">
                                                                            <div class="col-md-4">
                                                                                <label><?= $j ?></label>
                                                                            </div>
                                                                            <div class="col-md-8">
                                                                                <label class="control-label">Uploaded File :</label>
                                                                                 <div style="height: 10%;width: 100%;">
                                                                                    <a href="<?php echo $file_details['file']; ?>" target="_blank">
                                                                                        <?php
                                                                                        $name = explode('/', $file_details['file']);

                                                                                        if ($obj['order_type'] == "Website") {
                                                                                            echo $name[4];
                                                                                        } else {
                                                                                            echo $name[5];
                                                                                        }
                                                                                        ?>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <hr>
                                                                <?php $j++;
                                                                    }
                                                                } ?>
                                                            </fieldset>
                                                            <?php if ($obj['projectstatus'] == 'Completed'||$obj['projectstatus'] == 'Delivered') { ?>
                                                                 <fieldset class="scheduler-border">
                                                                    <legend class="scheduler-border">Completed Assignment File</legend>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="col-md-4 col-sm-4">
                                                                                <label> Uploaded File from Assignmentinneed.com </label>
                                                                            </div>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <?php 
                                                                    if (!empty($obj['completed_orders'])) {
                                                                    $j = 1;
                                                                    foreach ($obj['completed_orders'] as  $file_details) {  ?>
                                                                        <div class="row">
                                                                            <div class="col-md-4">
                                                                                <label><?= $j ?></label>
                                                                            </div>
                                                                            
                                                                            <div class="col-md-8">
                                                                                <label class="control-label"> File :</label>
                                                                                 <div style="height: 10%;width: 100%;">
                                                                                    <a href="<?php echo $file_details['file_path']; ?>" target="_blank">
                                                                                        <?php
                                                                                        $name = explode('/', $file_details['file_path']);

                                                                                        if ($obj['order_type'] == "Website") {
                                                                                            echo $name[4];
                                                                                        } else {
                                                                                            echo $name[5];
                                                                                        }
                                                                                        ?>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <hr>
                                                                <?php $j++;
                                                                    }
                                                                } ?>

                                                                </fieldset>
                                                            <?php } ?>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- / Modal -->

                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="delete<?php echo $obj['id']; ?>" role="dialog">
                                                <div class="modal-dialog">
                                                    <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Orders/deleteorder/<?php echo $obj['id']; ?>">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title"> Delete Order </h4>
                                                                <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Are you sure, you want to delete Order <b><?php echo $obj['order_id']; ?> </b>? </p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-primary ">Submit</button>
                                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <!-- / Modal -->
                                        </tr>

                                    <?php $i++;
                                    } ?>
                                </tbody>
                            </table>

                            <?php if ($role_id == 1 || $role_id == 2) { ?>
                                <?php if (empty($from_date)) { ?>
                                    <div class="pagination">
                                        <?php echo $links; ?> </p>
                                    </div>
                                <?php } ?>
                            <?php } ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->
 
</div>

<?php } ?>

    
 


<!-- ============================================================== -->
<!-- End Container fluid  -->

<!-- Start : Models -->

<!-- Closed : Models -->

<script src="<?php echo base_url(); ?>assets/node_modules/jquery/dist/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.read_order').on('click', function(e) {
            var current = $(this);
            id = $(this).attr('order_id');
            $.ajax({
                url: "<?php echo base_url(); ?>index.php/Orders/readorder/" + id,
                cache: false,
                success: function(response) {
                    current.css("font-weight", "");
                }
            });
        });
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
            if (allVals.length <= 0) {
                alert("Please select row.");
            } else {
                WRN_PROFILE_DELETE = "Are you sure you want to delete all selected customers?";
                var check = confirm(WRN_PROFILE_DELETE);
                if (check == true) {
                    var join_selected_values = allVals.join(",");
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>index.php/Orders/deleteorder",
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

        $(document).on('click', '.mark_as_failed', function() {
            var row_id = $(this).closest("tr").find('.row_id').val();
            var uid = $(this).closest("tr").find('.uid').val();
            swal({
                title: "Are you sure?",
                text: "Mark this order as failed job!",
                icon: "warning",
                buttons: [
                    'No, cancel it!',
                    'Yes, I am sure!'
                ],
                dangerMode: true,
            }).then(function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        type: "POST",
                        url: '<?php echo base_url(); ?>index.php/Orders/markAsFailed',
                        data: {
                            row_id: row_id,
                            uid: uid,
                        },
                        success: function(response) {
                            window.location.reload();
                        }
                    });
                } else {
                    // window.location.reload();
                }
            });
        });

     
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        var base_url = '<?php echo base_url(); ?>';
        $(document).on('change', '.category', function() {
            var category_id = $('.category').find('option:selected').val();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('index.php/Customers/getcustomerByCategory/') ?>" + category_id,
                dataType: 'html',
                success: function(response) {
                    $(".customers").html(response);
                    $('.select2').select2();
                }
            });
        });
    });
</script>

        <script>
           $(document).ready(function(){
               $('.purpose').on('change', function() {
                   var chapterhide = $(this).val();
               if ( chapterhide =='writer');
                   {
                   // $("#business").show();
                   // $("#hideqw").hide();
                   document.getElementById("hideqw").style.display = "none";;
                   document.getElementById("business").style.display = "block";;
               }

               if(chapterhide =='title' || chapterhide =='college' )
               {
                   document.getElementById("hideqw").style.display = "block";;
                   document.getElementById("business").style.display = "none";;
               }
           });

          
           });

           
           </script>
           
         <script src="<?php echo base_url(); ?>assets/node_modules/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        jQuery('.sendmail').on('click', function(e) {
            e.preventDefault();

            // Get the obj['id'] from the hidden input field
            var id = $(this).find('input[name="id"]').val();
            if (!id) {
                alert("Please select a valid order.");
            } else {
                WRN_PROFILE_DELETE = "Are you sure you want to send this order into mail?";
                var check = confirm(WRN_PROFILE_DELETE);
                if (check == true) {
                    var join_selected_values = id;
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>index.php/Orders/sendMail",
                        cache: false,
                        data: 'ids=' + join_selected_values,
                        success: function(response) {
                            $(".successs_mesg").html(response);
                            location.reload();
                        },
                        error: function(xhr, status, error) {
                            console.error("AJAX error:", error);
                            // Handle AJAX errors here if needed
                        }
                    });
                }
            }
        });

        // Master checkbox - Check all checkboxes
        $('#master').on('click', function(e) {
            if ($(this).is(':checked')) {
                $(".sub_chk").prop('checked', true);
            } else {
                $(".sub_chk").prop('checked', false);
            }
        });

        // Individual checkboxes - Send mail for selected orders
        $('.sub_chk').on('click', function(e) {
            e.stopPropagation();
        });
    });
</script>

<script>
    $(document).ready(function() {
        function fetchMessages() {
            var c_id = $('input[name="c_id"]').val();
                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url(); ?>index.php/orders/get_admin_chat',
                    data: {
                        c_id: c_id,
                    },
                    success: function(response) {
                        $('.call_message').html(response);
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX error:", error);
                        // Handle AJAX errors here if needed
                    }
                });
            }

            fetchMessages();
           function sendMessage() {
            var c_id = $('input[name="c_id"]').val();
            var description = $('textarea[name="description"]').val();

            var formData = new FormData();
            formData.append('c_id', c_id);
            formData.append('description', description);

            $.ajax({
                type: "POST",
                url: '<?php echo base_url(); ?>index.php/orders/callstatusaddwrite',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // Clear the textarea after sending the message
                    $('textarea[name="description"]').val('');
                    // Fetch and display updated messages after sending
                    fetchMessages();
                },
                error: function(xhr, status, error) {
                    console.error("AJAX error:", error);
                    // Handle AJAX errors here if needed
                }
            });
        }

            $('#send_message').on('click', function() {
                sendMessage();
            });

            $('textarea[name="description"]').on('keydown', function(event) {
                if (event.which == 13 && !event.shiftKey) {
                    event.preventDefault();
                    sendMessage();
                }
            });
        });
    </script>



                                               