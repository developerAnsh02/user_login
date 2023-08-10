<?php
defined('BASEPATH') or exit('No direct script access allowed');
$current_page = current_url();
$data         = explode('?', $current_page);
$role_id      = $this->session->userdata['logged_in']['role_id'];
$loginid      = $this->session->userdata['logged_in']['id'];
$current_page = current_url();

?>

<style>
  .custom-file-upload {
    display: inline-block;
    padding: 10px 20px;
    cursor: pointer;
    border: 1px solid #ccc;
    border-radius: 4px;
    background-color: #f1f1f1;
}

#selected-files-container {
    margin-top: 20px;
    display: flex;
    flex-wrap: wrap;
}

.selected-file {
    display: flex;
    align-items: center;
    margin: 5px;
    padding: 5px 10px;
    background-color: #f9f9f9;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.selected-file-name {
    margin-right: 10px;
}

.selected-file-delete {
    color: red;
    cursor: pointer;
}

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

    @media (min-width: 992px)
    {
    .modal-lg, .modal-xl {
    max-width: 1000px;
    max-height:100%
}}

.file-attachment-btn {
      margin-left: 10px;
      padding: 5px;
      background-color: #f2f2f2;
      border: 1px solid #ccc;
      cursor: pointer;
    }
    
</style>

<!-- Page wrapper  -->
<?php if($role_id == 2) {?>

  <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
		<!--begin::Toolbar-->
		<div class="toolbar" id="kt_toolbar">
			<div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
				<div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
					<h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Chat With Writer </h1>
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
						<a href="#" class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 mb-2 lh-1">Chat Box</a>
						<!--begin::Info-->
						<div class="mb-0 lh-1">
							<span class="badge badge-success badge-circle w-10px h-10px me-1"></span>
							<span class="fs-7 fw-bold text-muted">Active(After send message click on send button)</span>
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
													
				<div class="call_message">
												
				</div>
				<!--end::Messages-->
		    </div>
		    <!--end::Card body-->
		    <!--begin::Card footer-->
		    <div class="card-footer pt-4" id="kt_chat_messenger_footer">
				<!--begin::Input-->
                
                 
                        <textarea type="text" id="m_des" placeholder="Type message" name="description" class="form-control" rows="2" value="" autofocus autocomplete="off" style="resize: none;"></textarea>
                           
                    <!--end::Input-->
                    <!--begin:Toolbar-->
                    <div class="d-flex flex-stack">
                        <!--begin::Actions-->
                        <input type="hidden" name="order_id" value="<?= $order_id ?>">
                        <div class="d-flex align-items-center me-2">
                           <div class="file-attachment-btn">
                                            
                                            <a type="button" class="btn btn-xs btn-dark btn-sm m-1" data-bs-toggle="modal" data-bs-target="#editModalw" title="Order Edit">
                                                <i style="color:#fff;" class="fas fa-paperclip"></i>
                                            </a>
                                            <div class="modal fade bd-example-modal-xl" id="editModalw" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                    
                                                    <div class="modal-content" style="width: 100%;">
                                                        <div class="modal-header">
                                                            <h3 class="modal-title" id="exampleModalLabel">
                                                               
                                                                 File Send<a href=""> <span style="color:lightsalmon"> Order ID <?= $order_id ?> </span></a>
                                                            </h3>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form class="floating-labels m-t-40" role="form" method="post" action="<?php echo base_url(); ?>index.php/leads/writefile/" enctype="multipart/form-data">
                                                        <input type="hidden" class="m_lead_id" name="order_id" value="<?= $id ?>">
                                                        <input type="hidden" class="" name="url" value="<?= base_url() ?>Orders/orderchatc/<?= $order_id ?>">
                                                        <input type="hidden"  name="order_code" value="<?= $order_id ?>">
                                                            <?php if($role_id == 6){ ?>
                                                                <input type="text" class="" name="reciever_id" value="<?= $swid ?>">
                                                            <?php } elseif($role_id==7 ){?>
                                                                <input type="hidden" class="" name="reciever_id" value="<?= $wid ?>">
                                                            <?php } ?>
                                                            <div class="modal-body">
                                                                <div class="card-body">
                                                                    <label class="custom-file-upload">
                                                                        <input type="file" class="filepond" name="file_call[]" multiple data-max-file-size="3MB" data-max-files="3" onchange="displaySelectedFiles(event)" />
                                                                        <span>Choose Files</span>
                                                                    </label>
                                                                    <div id="selected-files-container"></div>
                                                                </div>
                                                                <button type="submit" id="" class="btn btn-primary btn-block">Update</button>
                                                            </div>
                                                           
                                                        </form>
                                                    </div>
                                                 </div>
                                             </div>
                                        </div>
                        </div>
                        <!--end::Actions-->
                        <!--begin::Send-->
                        <div class=""></div>
                      
                        <button id="send_message" type="button" class="btn btn-primary" type="submit">Send</button>
                        <!--end::Send-->
                    </div>
               
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
<!-- ============================================================== -->
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- Display success message if any -->
        <span class="successs_mesg"><?= $this->session->flashdata('success'); ?></span>
        <?php if ($this->session->flashdata('success')) : ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <h3 class="text-success">
                    <i class="fa fa-check-circle"></i> Success
                </h3>
                <?= $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>

        <!-- Display failed message if any -->
        <?php if ($this->session->flashdata('failed')) : ?>
            <div class="alert alert-warning alert-dismissible">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <h3 class="text-warning">
                    <i class="fa fa-exclamation-triangle"></i> Warning
                </h3>
                <?= $this->session->flashdata('failed'); ?>
            </div>
        <?php endif; ?>

        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Send Mail before Refresh</h4>
            </div>
            <div class="col-md-7 align-self-center text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb justify-content-end">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">All Your Orders Details</li>
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
        <div class="modal-dialog modal-lg" role="document" style="hight:100%">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <h4 class="modal-title" id="exampleModalLabel1">Call Status Update</h4>  -->
                <h4> Chat  <?= $order_id ?> </h4>
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
                        <!-- <form class="form-horizontal mobile-display" role="form" method="post" action="<?php echo base_url(); ?>index.php/Leads/callstatusadd" enctype="multipart/form-data"> -->
                        <div class="row col-md-12 m_form" id="m_form">
                            <div class="row col-md-12">
                                <div class="col-md-12 col-sm-12">
                                    <!-- ... Rest of your code ... -->
                                    <div style="display:flex">
                                        <textarea type="text" id="m_des" placeholder="Type message" name="description" class="form-control" rows="2" value="" autofocus autocomplete="off" style="resize: none;"></textarea>
                                        <button id="send_message" type="button"><i class="fas fa-paper-plane"></i></button>
                                        <div class="file-attachment-btn">
                                            <label for="file-input">
                                            <i class="fas fa-paperclip"></i>
                                            </label>
                                            <a type="button" class="btn btn-xs btn-dark btn-sm m-1" data-bs-toggle="modal" data-bs-target="#editModalw" title="Order Edit">
                                                <i style="color:#fff;" class="fas fa-paperclip"></i>
                                            </a>
                                            <div class="modal fade bd-example-modal-xl" id="editModalw" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                    
                                                    <div class="modal-content" style="width: 80%;">
                                                        <div class="modal-header">
                                                            <h3 class="modal-title" id="exampleModalLabel">
                                                               
                                                                 File Send<a href=""> <span style="color:lightsalmon"> Order ID <?= $order_id ?> </span></a>
                                                            </h3>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form class="floating-labels m-t-40" role="form" method="post" action="<?php echo base_url(); ?>index.php/leads/writefile/" enctype="multipart/form-data">
                                                        <input type="hidden" class="m_lead_id" name="order_id" value="<?= $id ?>">
                                                         <input type="hidden"  name="order_code" value="<?= $order_id ?>">
                                                        <input type="hidden" class="" name="url" value="<?= base_url() ?>Orders/orderchatc/<?= $order_id ?>">
                                                        
                                                            <?php if($role_id == 6){ ?>
                                                                <input type="text" class="" name="reciever_id" value="<?= $swid ?>">
                                                            <?php } elseif($role_id==7 ){?>
                                                                <input type="hidden" class="" name="reciever_id" value="<?= $wid ?>">
                                                            <?php } ?>
                                                            <div class="modal-body">
                                                                <div class="card-body">
                                                                    <label class="custom-file-upload">
                                                                        <input type="file" class="filepond" name="file_call[]" multiple data-max-file-size="3MB" data-max-files="3" onchange="displaySelectedFiles(event)" />
                                                                        <span>Choose Files</span>
                                                                    </label>
                                                                    <div id="selected-files-container"></div>
                                                                </div>
                                                                <button type="submit" id="" class="btn btn-primary btn-block">Update</button>
                                                            </div>
                                                           
                                                        </form>
                                                    </div>
                                                 </div>
                                             </div>
                                        </div>

                        <!-- </form> -->
                    </div>
                </div>
            </div> <!-- Added missing closing tag -->
        </div>
    </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Page Content -->
    <!-- ============================================================== -->
</div>
<?php } ?>
<!-- ============================================================== -->
<!-- End Container fluid  -->



<script>
        $(document).ready(function() {
            // Function to fetch and display messages from the server
            function fetchMessages() {
                var order_id = $('input[name="order_id"]').val();
                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url(); ?>index.php/Leads/get_call_listwriterc',
                    data: {
                        order_id: order_id,
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

            // Fetch and display messages on page load
            fetchMessages();

            // Function to send a message to the server
                    function sendMessage() {
            var order_id = $('input[name="order_id"]').val();
            var description = $('textarea[name="description"]').val();
            var reciever_id = $('input[name="reciever_id"]').val();
              var order_code = $('input[name="order_code"]').val();
            

            var formData = new FormData();
            formData.append('order_id', order_id);
            formData.append('description', description);
            formData.append('reciever_id', reciever_id);
            formData.append('order_code', order_code);

          

            // Log the data being sent in the AJAX request
           

            $.ajax({
                type: "POST",
                url: '<?php echo base_url(); ?>index.php/Leads/callstatusaddwritecint',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    // Clear the textarea after sending the message
                    $('textarea[name="description"]').val('');
                    // Fetch and display updated messages after sending
                    fetchMessages();
                },
                error: function (xhr, status, error) {
                    console.error("AJAX error:", error);
                    // Handle AJAX errors here if needed
                }
            });
        }


        // Send message when the "send_message" button is clicked
        $('#send_message').on('click', function() {
            sendMessage();
        });

        // Send message when pressing the "Enter" key in the textarea
        $('textarea[name="description"]').on('keydown', function(event) {
            if (event.which == 13 && !event.shiftKey) {
                event.preventDefault();
                sendMessage();
            }
        });
    });
    </script>
    
    <script>
    function displaySelectedFiles(event) {
        const container = document.getElementById('selected-files-container');
        container.innerHTML = '';

        const files = event.target.files;
        for (let i = 0; i < files.length; i++) {
            const file = files[i];

            const fileDiv = document.createElement('div');
            fileDiv.classList.add('selected-file');

            const fileNameSpan = document.createElement('span');
            fileNameSpan.classList.add('selected-file-name');
            fileNameSpan.textContent = file.name;

            const deleteSpan = document.createElement('span');
            deleteSpan.classList.add('selected-file-delete');
            deleteSpan.textContent = 'Delete';
            deleteSpan.addEventListener('click', () => {
                container.removeChild(fileDiv);
            });

            fileDiv.appendChild(fileNameSpan);
            fileDiv.appendChild(deleteSpan);
            container.appendChild(fileDiv);
        }
    }
</script>

 

    



