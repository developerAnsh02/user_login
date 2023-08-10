<?php
defined('BASEPATH') or exit('No direct script access allowed');

$role_id = $this->session->userdata['logged_in']['role_id'];

?>

<style>
	@media only screen and (max-width: 600px) {
		.mobile-display {
			width: 100% !important;
		}

		.mobile-displaynew {
			width: 90% !important;
		}
	}
</style>
<div class="container-fluid">
	<div class="card card-primary card-outline">
		<div class="card-header" style="background: #355fa9;">
			<h3 class="card-title" style="color:white;"> <?= $title ?></h3>
			<div class="pull-right error_msg">
				<?php echo validation_errors(); ?>

				<?php if (isset($message_display)) {
					echo $message_display;
				} ?>
			</div>

		</div> <!-- /.card-body -->




		<div class="card-body" style="background: aliceblue;">
			<div>
				<form style="width: 50%;margin: auto;background: #d6e8bdbf;padding: 28px;" class="form-horizontal mobile-display" role="form" method="post" action="<?php echo base_url(); ?>index.php/Orders/add_feedback" enctype="multipart/form-data">
					<input type="hidden" name="order_id" value="<?= $order_id ?>">
					<div class="form-group">
						<div class="row col-md-12">
							<div class="col-md-12 col-sm-12">
								<label class="control-label"> Title</label>
								<input type="text" name="title" class="form-control" placeholder="Title" id="first" autofocus autocomplete="off" autocomplete="off">
							</div>

						</div>
						<div class="row col-md-12">
							<div class="col-md-12 col-sm-12">
								<label class="control-label"> Document Upload</label>
								<input type="file" name="feedback_file" class="form-control">
							</div>
						</div>
						<div class="row col-md-12">
							<div class="col-md-12 col-sm-12">
								<label class="control-label"> Descriptions</label>
								<textarea type="text" placeholder="Enter Descriptions" name="description" class="form-control" rows="2" value="" autofocus autocomplete="off" style="resize: none;"></textarea>
							</div>
						</div>
						<div class="row col-md-12">
							<div class="col-md-12 col-sm-12">
								<br />
								<button type="submit" class="btn btn-primary btn-block"> Save</button>
							</div>
						</div>
					</div>



				</form> <!-- /form -->
			</div>
		</div>
		<br />

		<div class="row col-md-12">
			<div class="card direct-chat direct-chat-primary mobile-displaynew" style="width:80%;margin:auto;">
				<div class="card-header ui-sortable-handle" style="cursor: move;">
					<h3 class="card-title">Feedback List</h3>


				</div>
				<!-- /.card-header -->
				<div class="card-body" style="display: block;">
					<!-- Conversations are loaded here -->
					<div class="direct-chat-messages">
						<!-- Message. Default to the left -->

						<?php $i = 0;
						foreach ($feedback_lits as $feedback_lit) { ?>
							<!-- Message to the right -->
							<div class="direct-chat-msg right">
								<div class="direct-chat-infos clearfix">
									<span class="direct-chat-name float-right"><a href="<?php echo base_url(); ?>/uploads/customers/<?php echo $feedback_lit['image']; ?>" target="_blank"> <?php echo $feedback_lit['image']; ?> </a>
									</span>
									<span class="direct-chat-timestamp float-left"><?php echo date("d-m-Y", strtotime($feedback_lit['created_at'])); ?> <?php echo $feedback_lit['title']; ?></span>
								</div>
								<!-- /.direct-chat-infos -->

								<!-- /.direct-chat-img -->
								<div class="direct-chat-text">
									<?php echo $feedback_lit['description']; ?>
								</div>
								<!-- /.direct-chat-text -->
							</div>

						<?php } ?>
					</div>
					<!--/.direct-chat-messages-->


				</div>
				<!-- /.card-body -->
				<div class="card-footer" style="display: block;">

				</div>
				<!-- /.card-footer-->
			</div>
		</div>




	</div>
</div>

<script src="<?php echo base_url() . "assets/"; ?>plugins/jquery/jquery.min.js"></script>



<script type="text/javascript">
	$(document).ready(function() {

	});
</script>