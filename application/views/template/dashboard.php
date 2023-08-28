<?php
$role_id = $this->session->userdata['logged_in']['role_id'];
?>
<!-- <style>
    .alert-dismissible {
        padding-right: 3rem;
        animation: hideMe 10s forwards !important;
    }

    @keyframes hideMe {
        0% {
            opacity: 1;
        }

        100% {
            opacity: 0;
        }
    }
</style> -->
<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<?php if($role_id ==2){ ?>
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
		<!--begin::Toolbar-->
		<div class="toolbar" id="kt_toolbar">
			<!--begin::Container-->
			<div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
				<!--begin::Page title-->
				<div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
					<!--begin::Title-->
					<h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">User Dashboard</h1>
					<!--end::Title-->
				</div>
			</div>
			<!--end::Container-->
		</div>
		<!--end::Toolbar-->
		<!--begin::Post-->
		
		<div class="post d-flex flex-column-fluid" id="kt_post">
			<!--begin::Container-->
			<div id="kt_content_container" class="container-xxl">
				<!--begin::Row-->
				<div class="row g-5 g-xl-10 mb-xl-10">
					<div class="col-md-6 col-lg-6 col-xl-12 col-xxl-3 mb-md-5 mb-xl-10">
						<!--begin::Card widget 4-->
						<a href="<?= base_url('index.php/Orders/index'); ?>">
						<div class="card card-flush h-md-50 mb-5 mb-xl-10">
							<!--begin::Header-->
							<div class="card-header pt-5">
								<!--begin::Title-->
								<div class="card-title d-flex flex-column">
									<!--begin::Info-->
									<div class="d-flex align-items-center">
										<!--begin::Currency-->
										<span class="fs-4 fw-bold text-gray-400 me-1 align-self-start"></span>
										<!--end::Currency-->
										<!--begin::Amount-->
										<span class="fs-2hx fw-bolder text-dark me-2 lh-1"><?php echo  $TotalOrders + $leads_total ?></span>
										<!--end::Amount-->
										<!--begin::Badge-->
										<span class="badge badge-success fs-6 lh-1 py-1 px-2 d-flex flex-center" style="height: 22px">
										<!--begin::Svg Icon | path: icons/duotune/arrows/arr067.svg-->
										<span class="svg-icon svg-icon-7 svg-icon-white ms-n1">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<path opacity="0.5" d="M13 9.59998V21C13 21.6 12.6 22 12 22C11.4 22 11 21.6 11 21V9.59998H13Z" fill="black" />
												<path d="M5.7071 7.89291C5.07714 8.52288 5.52331 9.60002 6.41421 9.60002H17.5858C18.4767 9.60002 18.9229 8.52288 18.2929 7.89291L12.7 2.3C12.3 1.9 11.7 1.9 11.3 2.3L5.7071 7.89291Z" fill="black" />
											</svg>
										</span>
										<!--end::Svg Icon--></span>
										<!--end::Badge-->
									</div>
									<!--end::Info-->
									<!--begin::Subtitle-->
									<span class="text-gray-400 pt-1 fw-bold fs-6">  Your Total Orders</span>
									<!--end::Subtitle-->
								</div>
								<!--end::Title-->
							</div>
							<!--end::Header-->
							<!--begin::Card body-->
							
							<!--end::Card body-->
						</div>
						</a>
						<!--end::Card widget 4-->
						<!--begin::Card widget 5-->
						
						<div class="col-md-6 col-lg-6 col-xl-12 col-xxl-3 mb-md-5 mb-xl-10">
						 <a href="<?= base_url('index.php/Orders/index') ;?>?customer_id=0&order_id=0&from_date=<?php echo date("d-m-Y"); ?>&upto_date=<?php echo date("d-m-Y"); ?>&order_date_filter=order_date&status=&title=">

						<!--begin::Card widget 6-->
						<div class="card card-flush h-md-50 mb-5 mb-xl-10">
							<!--begin::Header-->
							<div class="card-header pt-5">
								<!--begin::Title-->
								<div class="card-title d-flex flex-column">
									<!--begin::Info-->
									<div class="d-flex align-items-center">
										<!--begin::Currency-->
										<span class="fs-4 fw-bold text-gray-400 me-1 align-self-start"></span>
										<!--end::Currency-->
										<!--begin::Amount-->
										<span class="fs-2hx fw-bolder text-dark me-2 lh-1"><?php echo  $TotalOrdersToday +$totalleadstoday ?></span>
										<!--end::Amount-->
										<!--begin::Badge-->
										<span class="badge badge-success fs-6 lh-1 py-1 px-2 d-flex flex-center" style="height: 22px">
										<!--begin::Svg Icon | path: icons/duotune/arrows/arr067.svg-->
										<span class="svg-icon svg-icon-7 svg-icon-white ms-n1">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<path opacity="0.5" d="M13 9.59998V21C13 21.6 12.6 22 12 22C11.4 22 11 21.6 11 21V9.59998H13Z" fill="black" />
												<path d="M5.7071 7.89291C5.07714 8.52288 5.52331 9.60002 6.41421 9.60002H17.5858C18.4767 9.60002 18.9229 8.52288 18.2929 7.89291L12.7 2.3C12.3 1.9 11.7 1.9 11.3 2.3L5.7071 7.89291Z" fill="black" />
											</svg>
										</span>
										<!--end::Svg Icon--></span>
										<!--end::Badge-->
									</div>
									<!--end::Info-->
									<!--begin::Subtitle-->
									<span class="text-gray-400 pt-1 fw-bold fs-6">Today's Order</span>
									<!--end::Subtitle-->
								</div>
								<!--end::Title-->
							</div>
							<!--end::Header-->
							<!--begin::Card body-->
							
							<!--end::Card body-->
						</div>
						</a>
						<!--end::Card widget 6-->
						<!--begin::Card widget 7-->
					
					</div>
						
						<a href="">
						<div class="card card-flush h-md-50 mb-5 mb-xl-10">
							<!--begin::Header-->
							<div class="card-header pt-5">
								<!--begin::Title-->
								<div class="card-title d-flex flex-column">
									<!--begin::Info-->
									<div class="d-flex align-items-center">
										<!--begin::Currency-->
										<span class="fs-4 fw-bold text-gray-400 me-1 align-self-start"></span>
										<!--end::Currency-->
										<!--begin::Amount-->
										<span class="fs-2hx fw-bolder text-dark me-2 lh-1"><?php echo  $pending_orders +$leads_total ?></span>
										<!--end::Amount-->
										<!--begin::Badge-->
										<span class="badge badge-success fs-6 lh-1 py-1 px-2 d-flex flex-center" style="height: 22px">
										<!--begin::Svg Icon | path: icons/duotune/arrows/arr067.svg-->
										<span class="svg-icon svg-icon-7 svg-icon-white ms-n1">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<path opacity="0.5" d="M13 9.59998V21C13 21.6 12.6 22 12 22C11.4 22 11 21.6 11 21V9.59998H13Z" fill="black" />
												<path d="M5.7071 7.89291C5.07714 8.52288 5.52331 9.60002 6.41421 9.60002H17.5858C18.4767 9.60002 18.9229 8.52288 18.2929 7.89291L12.7 2.3C12.3 1.9 11.7 1.9 11.3 2.3L5.7071 7.89291Z" fill="black" />
											</svg>
										</span>
										<!--end::Svg Icon--></span>
										<!--end::Badge-->
									</div>
									
									
									<!--end::Info-->
									<!--begin::Subtitle-->
								
									<!--end::Subtitle-->
								</div>
								<!--end::Title-->
							</div>
							<div class="card-body pt-2 pb-4 d-flex align-items-center">
								<!--begin::Chart-->
								<div class="d-flex flex-center me-5 pt-2">
									<div id="kt_card_widget_4_chart" style="min-width: 70px; min-height: 70px" data-kt-size="90" data-kt-line="15"></div>
								</div>
								<!--end::Chart-->
								<!--begin::Labels-->
								<div class="d-flex flex-column content-justify-center w-100">
									<!--begin::Label-->
									<div class="d-flex fs-6 fw-bold align-items-center">
										<!--begin::Bullet-->
										<div class="bullet w-8px h-6px rounded-2 bg-danger me-3"></div>
										<!--end::Bullet-->
										<!--begin::Label-->
										<div class="text-gray-500 flex-grow-1 me-4">PendingOrders</div>
										<!--end::Label-->
										<!--begin::Stats-->
									
										<!--end::Stats-->
									</div>
									<!--end::Label-->
									<!--begin::Label-->
								
								</div>
								<!--end::Labels-->
							</div>
							<!--end::Header-->
							<!--begin::Card body-->
							
							<!--end::Card body-->
						</div>
						<!--end::Card widget 5-->
					</div>
					</a>
					
					<!--begin::Col-->
									
				</div>
								
			</div>
			<!--end::Container-->
		</div>
		<!--end::Post-->
	</div>

<?php } else { ?>
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
                <h4 class="text-themecolor">Dashboard</h4>
            </div>
            <div class="col-md-7 align-self-center text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb justify-content-end">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                    <!-- <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white">
                                <i class="fa fa-plus-circle"></i> Create New
                            </button> -->
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Info box -->
        <!-- ============================================================== -->
        <!-- Row -->
        <?php if ($role_id == 1) { ?>
            <div class="row " style="justify-content: center; ">
                <!-- Column -->
                <div class="col-md-3 col-md-3 " >
                    <a href="<?= base_url('index.php/Employees/index'); ?>">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-success">
                                        <i class="ti-user"></i>
                                    </div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0">
                                            <?= $total_customers ?>
                                        </h3>
                                        <h5 class="text-muted m-b-0">Total Customers</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Column -->
                <!-- Column -->
                <div class="col-md-3 col-md-3">
                    <a href="<?= base_url('index.php/Orders/index'); ?>">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-info">
                                        <i class="ti-book"></i>
                                    </div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0"><?= $TotalOrders ?></h3>
                                        <h5 class="text-muted m-b-0">Total Orders</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Column -->
                <!-- Column -->
                <div class="col-md-3 col-md-3">
                    <a href="https://www.assignnmentinneed.com/user_login/index.php/Orders/index?customer_id=0&order_id=0&from_date=<?php $firstDayOfMonth = date('Y-m-01'); ?>&upto_date= <?php $currentDay = date('Y-m-d'); ?>&order_date_filter=order_date&status=Pending&filter_check=title&title=">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-danger">
                                        <i class="icon-clock"></i>
                                    </div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0"><?= $pending_orders ?></h3>
                                        <h5 class="text-muted m-b-0">Pending Orders</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Column -->
                <!-- Column -->
                <div class="col-md-3 col-md-3">
                    <a href="<?= base_url('index.php/Orders/index') ;?>?customer_id=0&order_id=0&from_date=<?php echo date("d-m-Y"); ?>&upto_date=<?php echo date("d-m-Y"); ?>&order_date_filter=order_date&status=&title=">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-success">
                                        <i class="ti-shopping-cart"></i>
                                    </div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0"><?= $TotalOrdersToday ?></h3>
                                        <h5 class="text-muted m-b-0">Today's Order</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Column -->
            </div>
        <?php } ?>

        <?php if($role_id ==8) {?>
          <div class="row " style="justify-content: center; ">
                <!-- Column -->
                <div class="col-md-3 col-md-3 " >
                    <a href="<?= base_url('index.php/Orders/Write_tl'); ?>">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-success">
                                        <i class="ti-user"></i>
                                    </div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0">
                                            <?= $total_customers ?>
                                        </h3>
                                        <h5 class="text-muted m-b-0">Total Writer Tl </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Column -->
                <!-- Column -->
                <div class="col-md-3 col-md-3">
                    <a href="<?= base_url('index.php/Orders/index'); ?>">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-info">
                                        <i class="ti-book"></i>
                                    </div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0"><?= $TotalOrders ?></h3>
                                        <h5 class="text-muted m-b-0">Total Orders</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Column -->
                <!-- Column -->
                <div class="col-md-3 col-md-3">
                    <a href="<?= base_url('index.php/Orders/index'); ?>?order_id=0&from_date=&upto_date=&swid=&order_date_filter=order_date&status=In+Progress">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round" style="background: #3e3e76;">
                                        <i class="icon-clock"></i>
                                    </div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0"><?= $pending_orders ?></h3>
                                        <h5 class="text-muted m-b-0">In Progress Order</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Column -->
                <!-- Column -->
                <div class="col-md-3 col-md-3">
                    <a href="<?= base_url('index.php/Orders/index') ;?>?customer_id=0&order_id=0&from_date=<?php echo date("d-m-Y"); ?>&upto_date=<?php echo date("d-m-Y"); ?>&order_date_filter=order_date&status=&title=">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-success">
                                        <i class="ti-shopping-cart"></i>
                                    </div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0"><?= $TotalOrdersToday ?></h3>
                                        <h5 class="text-muted m-b-0">Today's Order</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Order Code</th>
                                        <th>Title</th>
                                        <th>Writer Deadline</th>
                                        <th>Assign Time/date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                  
                                        $i = 1;
                                        foreach ($recent_orders as $order) {
                                    ?>
                                            <tr>
                                                <td><?= $i++ ?></td>
                                                <td><?= $order['order_id'] ?></td>
                                                <td><?= $order['title'] ?></td>
                                                <td><?php echo date('d-M-Y', strtotime($order['writer_deadline'])); ?></td>
                                                <td><?php echo date('d-M-Y (h-i-s)' , strtotime($order['edited_on'])); ?></td>

                                            </tr>
                                    <?php
                                        }
                                    
                                    ?>
                                </tbody>
                            </table>
                        </div>
                <!-- Column -->
            </div>
        <?php } ?>
        
        <?php if($role_id == 6 || $role_id == 7){ ?>
        <div class="row " style="justify-content: center; ">
                <!-- Column -->
                <?php if($role_id == 6){ ?>
                <div class="col-md-3 col-md-3 " >
                    <a href="https://www.assignnmentinneed.com/user_login/index.php/Orders/subwriter">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-success">
                                        <i class="ti-user"></i>
                                    </div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0">
                                            <?= $total_writer ?>
                                        </h3>
                                        <h5 class="text-muted m-b-0">Total Writer</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <?php } ?>
                <!-- Column -->
                <!-- Column -->
                <div class="col-md-3 col-md-3">
                    <a href="https://www.assignnmentinneed.com/user_login/index.php/Orders/index">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-info">
                                        <i class="ti-book"></i>
                                    </div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0"><?= $total_writer_order ?></h3>
                                        <h5 class="text-muted m-b-0">Total Orders</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Column -->
                <!-- Column -->
                <div class="col-md-3 col-md-3">
                    <a href="https://www.assignnmentinneed.com/user_login/index.php/Orders/index?order_id=0&from_date=&upto_date=&swid=&order_date_filter=order_date&status=In+Progress">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-danger">
                                        <i class="icon-clock"></i>
                                    </div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0"><?= $total_writer_order_pending ?></h3>
                                        <h5 class="text-muted m-b-0">In Progress Orders</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Column -->
                <!-- Column -->
                <div class="col-md-3 col-md-3">
                    <a href="https://www.assignnmentinneed.com/user_login/index.php/Orders/index?order_id=0&from_date=<?php echo date("d-m-Y"); ?>&upto_date=<?php echo date("d-m-Y"); ?>&swid=&order_date_filter=writer_delivery&status=">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-success">
                                        <i class="ti-shopping-cart"></i>
                                    </div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0"><?= $todays_deadline_orders ?></h3>
                                        <h5 class="text-muted m-b-0">Today's Deadline Orders</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Column -->
            </div>

           
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <!-- <h5 class="card-title m-b-0">New Customers List</h5>
                        <p class="text-muted">list of last top 10 orders</p> -->
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Order Code</th>
                                        <th>Title</th>
                                        <th>Writer Deadline</th>
                                        <th>Assign Time/date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                  
                                        $i = 1;
                                        foreach ($recent_orders as $order) {
                                    ?>
                                            <tr>
                                                <td><?= $i++ ?></td>
                                                <td><?= $order['order_id'] ?></td>
                                                <td><?= $order['title'] ?></td>
                                                <td><?php echo date('d-M-Y', strtotime($order['writer_deadline'])); ?></td>
                                                <td><?php echo date('d-M-Y (h-i-s)' , strtotime($order['edited_on'])); ?></td>

                                            </tr>
                                    <?php
                                        }
                                    
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
           
        <?php }?>
        <!-- Row -->
        <!-- ============================================================== -->
        <!-- End Info box -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Over Visitor, Our income , slaes different and  sales prediction -->
        <!-- ============================================================== -->
        <?php if ($role_id == 1) { ?>
            <div class="row">
                <!-- Column -->
                <div class="col-lg-4 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title ">Orders</h5>
                            <div id="morris-donut-chart" class="ecomm-donute" style="height: 317px;">
                            </div>
                            <ul class="list-inline m-t-30 text-center">
                                <li class="p-r-20">
                                    <h5 class="text-muted">
                                        <i class="fa fa-circle" style="color: #01c0c8;"></i>
                                        Total Orders
                                    </h5>
                                    <h4 class="m-b-0">
                                        <span id="tocm">
                                            <?= $TotalOrdersCurrentMonth ?>
                                        </span>
                                    </h4>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <div class="col-lg-8 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Last 6 Month Orders</h5>
                            <ul class="list-inline text-center">
                                <li>
                                    <h5>
                                        <i class="fa fa-circle m-r-5" style="color: #b4becb;"></i>
                                        Pending
                                    </h5>
                                </li>
                                <li>
                                    <h5>
                                        <i class="fa fa-circle m-r-5" style="color: #00bfc7;"></i>
                                        Total
                                    </h5>
                                </li>
                            </ul>
                            <div id="morris-bar-chart" style="height: 370px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <!-- ============================================================== -->
        <!-- New Customers List and New Products List -->
        <!-- ============================================================== -->
        <!-- /row -->
        <?php if($role_id != 6 && $role_id != 7 && $role_id != 8) {?>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <!-- <h5 class="card-title m-b-0">New Customers List</h5>
                        <p class="text-muted">list of last top 10 orders</p> -->
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Order Code</th>
                                        <th>Title</th>
                                        <th>Order Date</th>
                                        <th>Project Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($orders_10)) {
                                        $i = 1;
                                        foreach ($orders_10 as $order) {
                                    ?>
                                            <tr>
                                                <td><?= $i++ ?></td>
                                                <td><?= $order['order_id'] ?></td>
                                                <td><?= $order['title'] ?></td>
                                                <td><?= $order['order_date'] ?></td>
                                                <td>
                                                    <?php
                                                    if ($order['projectstatus'] == 'Pending') {
                                                        $color = "#ff8acc";
                                                    } elseif ($order['projectstatus'] == 'Cancelled') {
                                                        $color = "#ff5b5b";
                                                    } elseif ($order['projectstatus'] == 'Completed' || $order['projectstatus'] == 'Delivered') {
                                                        $color = "#10c469";
                                                    } elseif ($order['projectstatus'] == 'In Progress') {
                                                        $color = "#5b69bc";
                                                    } elseif ($order['projectstatus'] == 'Feedback' || $order['projectstatus'] == 'Feedback Delivered') {
                                                        $color = "#71b6f9";
                                                    } elseif ($order['projectstatus'] == 'Draft Ready' || $order['projectstatus'] == 'Draft Delivered') {
                                                        $color = "#0062cc";
                                                    } else {
                                                        $color = "#35b8e0";
                                                    }
                                                    ?>
                                                    <span class="label label-primary" style="background-color:<?= $color ?>;">
                                                        <?= $order['projectstatus'] ?>
                                                    </span>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
            <!-- <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title m-b-0">New Product List</h5>
                        <p class="text-muted">this is the sample data here for crm</p>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Products</th>
                                        <th>Popularity</th>
                                        <th>Sales</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Milk Powder</td>
                                        <td><span class="peity-line" data-width="120" data-peity='{ "fill": ["#13dafe"], "stroke":["#13dafe"]}' data-height="40">0,-3,-2,-4,-5,-4,-3,-2,-5,-1</span> </td>
                                        <td><span class="text-danger text-semibold"><i class="fa fa-level-down" aria-hidden="true"></i> 28.76%</span> </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Air Conditioner</td>
                                        <td><span class="peity-line" data-width="120" data-peity='{ "fill": ["#13dafe"], "stroke":["#13dafe"]}' data-height="40">0,-1,-1,-2,-3,-1,-2,-3,-1,-2</span> </td>
                                        <td><span class="text-warning text-semibold"><i class="fa fa-level-down" aria-hidden="true"></i> 8.55%</span> </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>RC Cars</td>
                                        <td><span class="peity-line" data-width="120" data-peity='{ "fill": ["#13dafe"], "stroke":["#13dafe"]}' data-height="40">0,3,6,1,2,4,6,3,2,1</span> </td>
                                        <td><span class="text-success text-semibold"><i class="fa fa-level-up" aria-hidden="true"></i> 58.56%</span> </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Down Coat</td>
                                        <td><span class="peity-line" data-width="120" data-peity='{ "fill": ["#13dafe"], "stroke":["#13dafe"]}' data-height="40">0,3,6,4,5,4,7,3,4,2</span> </td>
                                        <td><span class="text-info text-semibold"><i class="fa fa-level-up" aria-hidden="true"></i> 35.76%</span> </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
        <!-- /.row -->
        <!-- ============================================================== -->
        <!-- End Page Content -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right sidebar -->
        <!-- ============================================================== -->
        <!-- .right-sidebar -->
        <div class="right-sidebar">
            <div class="slimscrollright">
                <div class="rpanel-title"> Service Panel <span><i class="ti-close right-side-toggle"></i></span> </div>
                <div class="r-panel-body">
                    <ul id="themecolors" class="m-t-20">
                        <li><b>With Light sidebar</b></li>
                        <li><a href="javascript:void(0)" data-skin="skin-default" class="default-theme">1</a></li>
                        <li><a href="javascript:void(0)" data-skin="skin-green" class="green-theme">2</a></li>
                        <li><a href="javascript:void(0)" data-skin="skin-red" class="red-theme">3</a></li>
                        <li><a href="javascript:void(0)" data-skin="skin-blue" class="blue-theme">4</a></li>
                        <li><a href="javascript:void(0)" data-skin="skin-purple" class="purple-theme">5</a></li>
                        <li><a href="javascript:void(0)" data-skin="skin-megna" class="megna-theme">6</a></li>
                        <li class="d-block m-t-30"><b>With Dark sidebar</b></li>
                        <li><a href="javascript:void(0)" data-skin="skin-default-dark" class="default-dark-theme working">7</a></li>
                        <li><a href="javascript:void(0)" data-skin="skin-green-dark" class="green-dark-theme">8</a></li>
                        <li><a href="javascript:void(0)" data-skin="skin-red-dark" class="red-dark-theme">9</a></li>
                        <li><a href="javascript:void(0)" data-skin="skin-blue-dark" class="blue-dark-theme">10</a></li>
                        <li><a href="javascript:void(0)" data-skin="skin-purple-dark" class="purple-dark-theme">11</a></li>
                        <li><a href="javascript:void(0)" data-skin="skin-megna-dark" class="megna-dark-theme ">12</a></li>
                    </ul>
                    <ul class="m-t-20 chatonline">
                        <li><b>Chat option</b></li>
                        <li>
                            <a href="javascript:void(0)"><img src="<?php echo base_url(); ?>assets/images/users/1.jpg" alt="user-img" class="img-circle"> <span>Varun Dhavan <small class="text-success">online</small></span></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><img src="<?php echo base_url(); ?>assets/images/users/2.jpg" alt="user-img" class="img-circle"> <span>Genelia Deshmukh <small class="text-warning">Away</small></span></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><img src="<?php echo base_url(); ?>assets/images/users/3.jpg" alt="user-img" class="img-circle"> <span>Ritesh Deshmukh <small class="text-danger">Busy</small></span></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><img src="<?php echo base_url(); ?>assets/images/users/4.jpg" alt="user-img" class="img-circle"> <span>Arijit Sinh <small class="text-muted">Offline</small></span></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><img src="<?php echo base_url(); ?>assets/images/users/5.jpg" alt="user-img" class="img-circle"> <span>Govinda Star <small class="text-success">online</small></span></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><img src="<?php echo base_url(); ?>assets/images/users/6.jpg" alt="user-img" class="img-circle"> <span>John Abraham<small class="text-success">online</small></span></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><img src="<?php echo base_url(); ?>assets/images/users/7.jpg" alt="user-img" class="img-circle"> <span>Hritik Roshan<small class="text-success">online</small></span></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><img src="<?php echo base_url(); ?>assets/images/users/8.jpg" alt="user-img" class="img-circle"> <span>Pwandeep rajan <small class="text-success">online</small></span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Right sidebar -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
</div>
<?php } ?>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->

<script>    
    var tocmc = <?= $TotalOrdersCurrentMonthCancelled ?>;
    var tocmp = <?= $TotalOrdersCurrentMonthPending ?>;
    var tocmo = <?= $TotalOrdersCurrentMonthOther ?>;
    var tocm  = <?= $TotalOrdersCurrentMonth ?>;
    var one   = <?= $one ?>;
    var two   = <?= $two ?>;
    var three = <?= $three ?>;
    var four  = <?= $four ?>;
    var five  = <?= $five ?>;
    var six   = <?= $six ?>;
</script>

<script src="<?php echo base_url(); ?>assets/dist/js/dashboard1.js"></script>
