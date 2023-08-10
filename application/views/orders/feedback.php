<?php
defined('BASEPATH') or exit('No direct script access allowed');
$role_id = $this->session->userdata['logged_in']['role_id'];
$user_id = $this->session->userdata['logged_in']['id'];
?>

<style>
    @media only screen and (max-width: 600px) {
        .mobile-display {
            width: 100% !important;
        }

        .mobile-display_list {
            width: 90% !important;
        }
    }

    .left-section {
        width: calc(30% - 1px);
        float: left;
        height: 500px;
        border-right: 1px solid #E6E6E6;
        background-color: #FFF;
        z-index: 1;
        position: relative;
    }

    .left-section ul {
        padding: 0px;
        margin: 0px;
        list-style: none;
    }

    .left-section ul li {
        padding: 15px 0px;
        cursor: pointer;
    }

    .left-section ul li.active {
        background: #009EF7;
        color: #fff;
        position: relative;
    }

    .mCustomScrollBox,
    .mCSB_container {
        overflow: unset !important;
    }

    .left-section ul li.active .desc .time {
        color: #fff;
    }

    .left-section ul li.active:before {
        position: absolute;
        content: '';
        right: -10px;
        border: 5px solid #009EF7;
        top: 0px;
        bottom: 0px;
        border-radius: 0px 3px 3px 0px;
    }

    .left-section ul li.active:after {
        position: absolute;
        content: "";
        bottom: 0px;
        right: 0px;
        left: auto;
        width: 100%;
        top: 0px;
        -webkit-box-shadow: -8px 4px 10px #a1a1a1;
        -moz-box-shadow: -8px 4px 10px #a1a1a1;
        box-shadow: -8px 4px 10px #a1a1a1;
    }

    .left-section .chatList {
        overflow: hidden;
    }

    .left-section .chatList .img {
        width: 60px;
        float: left;
        text-align: center;
        position: relative;
    }

    .left-section .chatList .img img {
        width: 30px;
        border-radius: 50%;
    }

    .left-section .chatList .img i {
        position: absolute;
        font-size: 10px;
        color: #52E2A7;
        border: 1px solid #fff;
        border-radius: 50%;
        left: 10px;
    }

    .left-section .chatList .desc {
        width: calc(100% - 60px);
        float: left;
        position: relative;
    }

    .left-section .chatList .desc h5 {
        margin-top: 6px;
        line-height: 5px;
    }

    .left-section .chatList .desc .time {
        position: absolute;
        right: 15px;
        color: #c1c1c1;
    }

    .right-section {
        width: 70%;
        float: left;
        height: 500px;
        background-color: #F6F6F6;
        position: relative;
    }

    .message {
        height: calc(100% - 68px);
        font-family: sans-serif;
    }

    .message ul {
        padding: 0px;
        list-style: none;
        margin: 0px auto;
        width: 100%;
        overflow: hidden;
    }

    .message ul li {
        position: relative;
        width: 80%;
        padding: 15px 0px;
        clear: both;
    }

    .message ul li.msg-left {
        float: left;
        text-align: left;
    }

    .message ul li.msg-left img {
        position: absolute;
        width: 40px;
        bottom: 30px;
        text-align: left;
    }

    .message ul li.msg-left .msg-desc {
        margin-left: 70px;
        font-size: 12px;
        background: #E8E8E8;
        padding: 5px 10px;
        border-radius: 5px 5px 5px 0px;
        position: relative;
        text-align: left;
    }

    .message ul li.msg-left .msg-desc:before {
        position: absolute;
        content: '';
        border: 10px solid transparent;
        border-bottom-color: #E8E8E8;
        bottom: 0px;
        left: -10px;
        text-align: left;
    }

    .message ul li.msg-left small {
        float: left;
        color: #c1c1c1;
        margin-left: 70px;
    }

    .message ul li.msg-right {
        float: right;
        text-align: right;
    }

    .message ul li.msg-right img {
        position: absolute;
        width: 40px;
        right: 0px;
        bottom: 30px;
        text-align: right;
    }

    .message ul li.msg-right .msg-desc {
        margin-right: 70px;
        font-size: 12px;
        background: #cce5ff;
        color: #004085;
        padding: 5px 10px;
        border-radius: 5px 5px 5px 0px;
        position: relative;
        text-align: right;
    }

    .message ul li.msg-right .msg-desc:before {
        position: absolute;
        content: '';
        border: 10px solid transparent;
        border-bottom-color: #cce5ff;
        bottom: 0px;
        right: -10px;
        text-align: right;
    }

    .message ul li.msg-right small {
        float: right;
        color: #c1c1c1;
        margin-right: 70px;
    }

    .message ul li.msg-day {
        border-top: 1px solid #EBEBEB;
        width: 100%;
        padding: 0px;
        margin: 15px 0px;
    }

    .message ul li.msg-day small {
        position: absolute;
        top: -10px;
        background: #F6F6F6;
        color: #c1c1c1;
        padding: 3px 10px;
        left: 50%;
        transform: translateX(-50%);
    }
    
    .file-input-design {
    position: relative;
    display: inline-block;
    overflow: hidden;
}

.file-name {
    display: inline-block;
    padding-left: 5px;
    vertical-align: middle;
}

.auto-resize-textarea {
  resize: none;
  overflow: hidden;
}




</style>
<?php if($role_id ==2) {?>
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
		<!--begin::Toolbar-->
		<div class="toolbar" id="kt_toolbar">
			<div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
				<div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
					<h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Drop Your Feedback</h1>
				</div>
				<div class="d-flex align-items-center gap-2 gap-lg-3">
					<a href="<?php echo base_url() ?>Orders/index" class="btn btn-sm btn-primary">View All Orcer</a>
				</div>
			</div>
		</div>
		<div class="post d-flex flex-column-fluid" id="kt_post">
			<div id="kt_content_container" class="container-xxl">
				<div class="row g-5 g-xl-10 mb-xl-10">
                  
                <div class="flex-lg-row-fluid ms-lg-7 ms-xl-10">
		<!--begin::Messenger-->
		<div class="card" id="kt_chat_messenger">
		    <!--begin::Card header-->
		    <div class="card-header" id="kt_chat_messenger_header">
				<!--begin::Title-->
				<div class="card-title">
					<!--begin::User-->
					<div class="d-flex justify-content-center flex-column me-3">
						<a href="#" class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 mb-2 lh-1">Drop Your Feedback</a>
						<!--begin::Info-->
						<div class="mb-0 lh-1">
							<span class="badge badge-success badge-circle w-10px h-10px me-1"></span>
							<span class="fs-7 fw-bold text-muted">Active</span>
						</div>
						<!--end::Info-->
					</div>
					<!--end::User-->
				</div>
												
		    </div>
		    <!--end::Card header-->
		    <!--begin::Card body-->
		    <div class="card-body" id="kt_chat_messenger_body">
				<!--begin::Messages-->

				<div class="scroll-y me-n5 pe-5 h-300px h-lg-auto" data-kt-element="messages" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_header, #kt_toolbar, #kt_footer, #kt_chat_messenger_header, #kt_chat_messenger_footer" data-kt-scroll-wrappers="#kt_content, #kt_chat_messenger_body" data-kt-scroll-offset="5px" style="">
													
					<!--end::Message(in)-->
					<!--begin::Message(out)-->
                    <?php
                    $i = 0;
                    foreach ($feedback_lits as $feedback_lit) {
                    ?>

                        <?php
                        if ($feedback_lit['user_id'] == $user_id) {
                        ?>
                            <div class="d-flex justify-content-end mb-10">
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-column align-items-end">
                                    <!--begin::User-->
                                    <div class="d-flex align-items-center mb-2">
                                        <!--begin::Details-->
                                        <div class="me-3">
                                            <span class="text-muted fs-7 mb-1"> <?php echo date('d-M-y h:i:s A', strtotime($feedback_lit['created_at'])); ?></span>
                                            <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary ms-1">You</a>
                                        </div>
                                        <!--end::Details-->
                                        <!--begin::Avatar-->
                                        <div class="symbol symbol-35px symbol-circle">
                                            <img alt="Pic" src="<?php echo base_url() ?>uploads/customers/logo.png">
                                        </div>
                                        <!--end::Avatar-->
                                    </div>
                                    <!--end::User-->
                                    <!--begin::Text-->
                                    <div class="p-5 rounded bg-light-primary text-dark fw-bold mw-lg-400px text-end" data-kt-element="message-text"><?php echo $feedback_lit['description']; ?>
                                        <a href="<?php echo base_url(); ?>/uploads/customers/<?php echo $feedback_lit['image']; ?>" target="_blank" style="color:blue !important">
                                            <?php echo $feedback_lit['image']; ?>
                                        </a>
                                    </div>
                                    <!--end::Text-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            

                         <?php } else { ?>
					
                            <div class="d-flex justify-content-start mb-10">
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-column align-items-start">
                                    <!--begin::User-->
                                    <div class="d-flex align-items-center mb-2">
                                        <!--begin::Avatar-->
                                        <div class="symbol symbol-35px symbol-circle">
                                            <img alt="Pic" src="<?php echo base_url() ?>uploads/customers/logo.png">
                                        </div>
                                        <!--end::Avatar-->
                                        <!--begin::Details-->
                                        <div class="ms-3">
                                            <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary me-1"><?php echo $feedback_lit['c_name']; ?></a>
                                            <span class="text-muted fs-7 mb-1"><?php echo date('d-M-y h:i:s A', strtotime($feedback_lit['created_at'])); ?> </span>
                                        </div>
                                        <!--end::Details-->
                                    </div>
                                    <!--end::User-->
                                    <!--begin::Text-->
                                    <div class="p-5 rounded bg-light-info text-dark fw-bold mw-lg-400px text-start" data-kt-element="message-text"><?php echo $feedback_lit['description']; ?>
                                                                <a href="<?php echo base_url(); ?>/uploads/customers/<?php echo $feedback_lit['image']; ?>" target="_blank" style="color:blue !important">
                                                                    <?php echo $feedback_lit['image']; ?>
                                                                </a></div>
                                    <!--end::Text-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                        <?php } ?>
                            
                    <?php } ?>
												
				</div>
				<!--end::Messages-->
		    </div>
		    <!--end::Card body-->
		    <!--begin::Card footer-->
		    <div class="card-footer pt-4" id="kt_chat_messenger_footer">
				<!--begin::Input-->
                <form class="form-horizontal mobile-display" role="form" method="post" action="<?php echo base_url(); ?>index.php/Orders/add_feedback" enctype="multipart/form-data">
                    <textarea class="form-control form-control-flush mb-3 auto-resize-textarea" name="description" rows="1" data-kt-element="input" placeholder="Type a message"></textarea>

                    <!--end::Input-->
                    <!--begin:Toolbar-->
                    <div class="d-flex flex-stack">
                        <!--begin::Actions-->
                        <input type="hidden" name="order_id" value="<?= $order_id ?>">
                        <div class="d-flex align-items-center me-2">
                            <label for="file">
                                <div class="file-input-design">
                                    <i class="btn btn-secondary btn-block fa fa-paperclip" style="font-size:15px"></i>
                                    <input type="file" id="file" style="display: none" name="feedback_file[]" accept="image/gif,image/jpeg,image/jpg,image/png" multiple="" data-original-title="upload photos">
                                </div>
                                <div id="file-name" class="file-name"></div>
                            </label>
                        </div>
                        <!--end::Actions-->
                        <!--begin::Send-->
                        <div class=""></div>
                        <button class="btn btn-primary" type="submit">Send</button>
                        <!--end::Send-->
                    </div>
                </form>
				<!--end::Toolbar-->
		    </div>
		    <!--end::Card footer-->
		</div>
		<!--end::Messenger-->
	</div>
				</div>
			</div>
		</div>
		<!--end::Post-->
	</div>
<?php } else { ?>
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Feedback</h4>
            </div>
            <div class="col-md-7 align-self-center text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb justify-content-end">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Feedback</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row col-md-12">
            <div class="card-body" style="display: block; height:200px; overflow-y: auto; background-color:white;">
                <div class="message mCustomScrollbar" data-mcs-theme="minimal-dark">
                    <ul>
                        <?php
                        $i = 0;
                        foreach ($feedback_lits as $feedback_lit) {
                        ?>
                            <div class="col-md-12">
                                <?php
                                if ($feedback_lit['user_id'] == $user_id) {
                                ?>
                                    <li class="msg-right">
                                        <div class="msg-left-sub">
                                            <img src="<?php echo base_url() ?>uploads/customers/logo.png" alt="userImg">
                                            <div class="msg-desc">
                                                <?php echo $feedback_lit['description']; ?>
                                                <a href="<?php echo base_url(); ?>/uploads/customers/<?php echo $feedback_lit['image']; ?>" target="_blank" style="color:blue !important">
                                                    <?php echo $feedback_lit['image']; ?>
                                                </a>
                                            </div>
                                            <small>
                                                <?php echo date('d-M-y h:i:s A', strtotime($feedback_lit['created_at'])); ?>
                                                <b><?php echo $feedback_lit['c_name']; ?></b>
                                            </small>
                                        </div>
                                    </li>
                                    <br>
                                <?php } else { ?>
                                    <li class="msg-left">
                                        <div class="msg-left-sub">
                                            <img src="<?php echo base_url() ?>uploads/customers/logo.png" alt="userImg">
                                            <div class="msg-desc">
                                                <?php echo $feedback_lit['description']; ?>
                                                <a href="<?php echo base_url(); ?>/uploads/customers/<?php echo $feedback_lit['image']; ?>" target="_blank" style="color:blue !important">
                                                    <?php echo $feedback_lit['image']; ?>
                                                </a>
                                            </div>
                                            <small>
                                                <b><?php echo $feedback_lit['c_name']; ?></b>
                                                <?php echo date('d-M-y h:i:s A', strtotime($feedback_lit['created_at'])); ?>
                                            </small>
                                        </div>
                                    </li>
                                    <br>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="card-footer">
                <form class="form-horizontal mobile-display" role="form" method="post" action="<?php echo base_url(); ?>index.php/Orders/add_feedback" enctype="multipart/form-data">
                    <input type="hidden" name="order_id" value="<?= $order_id ?>">
                    <div class="form-group">

                        <div class="row">
                            <div class="col-md-12">
                                <textarea class="form-control" id="exampleTextarea" rows="3" placeholder="Enter description..." name="description"></textarea>
                            </div>
                            <div class="col-md-1">
                                <label for="file">
                                    <i class="btn btn-primary btn-block">Upload</i>
                                    <input type="file" id="file" style="display: none" name="feedback_file[]" accept="image/gif,image/jpeg,image/jpg,image/png" multiple="" data-original-title="upload photos">
                                </label>
                            </div>
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-primary btn-block">Send</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
        <?php }?>
        
        
        
        
        <script>
        
        $(document).ready(function() {
    $('#file').change(function() {
        var fileNames = '';
        $.each(this.files, function(index, file) {
            fileNames += file.name + ', ';
        });
        fileNames = fileNames.substring(0, fileNames.length - 2);
        $('#file-name').text(fileNames);
    });
});
        
        
        document.addEventListener('input', function(event) {
  if (event.target.tagName.toLowerCase() !== 'textarea') return;
  autoResizeTextarea(event.target);
});

function autoResizeTextarea(textarea) {
  textarea.style.height = 'auto';
  textarea.style.height = textarea.scrollHeight + 'px';
}

        </script>
           