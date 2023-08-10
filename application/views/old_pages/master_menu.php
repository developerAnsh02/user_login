<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<style type="text/css">
	.row {
		margin-bottom: 10px;
	}
</style>
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
<div class="container-fluid">
	<div class="card card-primary card-outline">
		<div class="card-header">
			<h3 class="card-title"><?= $title ?></h3>
			<div class="pull-right ">

			</div>
		</div> <!-- /.card-body -->
		<div class="card-body">
			<div class="row">
				<div class="col-md-5">
					<?php  //echo $title; exit; 
					?>
					<?php if (!empty($id)) { ?>
						<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Meenus/editmenu/<?= $id ?>">
							<input type="hidden" name="menu_id" value="<?= $id ?>">
						<?php } else { ?>
							<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Meenus/add_new_menu">
							<?php } ?>

							<input type="hidden" name="url" value="<?php echo base_url(); ?>">
							<div class="form-group">
								<div class="row col-md-12">
									<div class="col-md-12 col-sm-12 ">
										<!-- <span class="control-span">menu Name</span>  -->
										<input type="text" placeholder="Enter menu name" name="menu_name" class="form-control" value="<?= $menu_name ?>" required autofocus>
									</div>
								</div>
								<div class="row col-md-12">
									<div class="col-md-12 col-sm-12 ">
										<!-- <span class="control-span">Parent</span> -->
										<?php
										echo form_dropdown('parent_id', $parentMenus, $parent_id)
										?>
									</div>
								</div>
								<div class="row col-md-12">
									<div class="col-md-12 col-sm-12 ">
										<!-- <span class="control-span"> Controller </span> -->
										<input type="text" placeholder="Enter Controller name" name="controller" class="form-control" value="<?= $controller ?>" autofocus>
									</div>
								</div>
								<div class="row col-md-12">
									<div class="col-md-12 col-sm-12 ">
										<!-- <span class="control-span"> Action </span> -->
										<input type="text" placeholder="Enter Action name" name="action" class="form-control" value="<?= $action ?>" autofocus>
									</div>
								</div>

								<div class="row col-md-12">
									<div class="col-md-12 col-sm-12 ">
										<!--  <span > Icon Class Name </span> -->
										<input type="text" placeholder="Enter Icon Class" name="icon_class" class="form-control" value="<?= $icon_class ?>" autofocus>
									</div>
								</div>

								<div class="row col-md-12">
									<div class="col-md-12 col-sm-12 ">
										<span> Show Menu </span>
										<select class="form-control" name="show_menu">
											<option value="Y" <?php if ($show_menu == 'Y') {
																	echo 'selected';
																} ?>> Y</option>
											<option value="N" <?php if ($show_menu == 'N') {
																	echo 'selected';
																} ?>> N</option>


										</select>
									</div>
								</div>

								<div class="row col-md-12">
									<div class="col-md-12 col-sm-12 ">
										<span> Is Parent </span>
										<select class="form-control" name="is_parent">
											<option value="Y" <?php if ($is_parent == 'Y') {
																	echo 'selected';
																} ?>> Y</option>
											<option value="N" <?php if ($is_parent == 'N') {
																	echo 'selected';
																} ?>> N</option>

										</select>
									</div>
								</div>
								<div class="row col-md-12">
									<div class="col-md-12 col-sm-12 ">
										<!--  <span > Icon Class Name </span> -->
										<input type="text" placeholder="Enter Target" name="target" class="form-control" value="<?= $target ?>" autofocus>
									</div>
								</div>

								<div class="row col-md-12">
									<div class="col-md-12 col-sm-12 ">
										<span class="control-span" style="visibility: hidden;"> Name</span><br>
										<button type="submit" class="btn btn-primary btn-block">Save</button>
									</div>
								</div>
							</div>
							</form>
				</div>
				<!-- /form -->
				<div class="col-md-7">
					<h5> menu List</h5>
					<div class="table-responsive">
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th style="width: 5%;"> Sr.No.</th>
									<th style="width: 10%;"> Parent</th>
									<th style="width: 10%;"> Menu</th>
									<th style="width: 10%;"> Action</th>
									<th style="width: 10%;"> Button</th>
								</tr>
							</thead>
							<tbody>
								<?php $i = 1;
								foreach ($menus as $menu) { ?>
									<tr>
										<td style="width: 5%;"><?= $i ?></td>
										<td style="width: 10%;"><?= $menu['parent'] ?></td>
										<td style="width: 10%;"><?= $menu['menu_name'] ?></td>
										<!-- <td><?= $menu['controller'] ?></td> -->
										<td><?= $menu['action'] ?></td>
										<td>
											<a class="btn btn-xs btn-info btnEdit" href="<?php echo base_url(); ?>index.php/Meenus/index/<?php echo $menu['id']; ?>"><i class="fa fa-edit"></i>
											</a>
											<a class="btn btn-xs btn-danger btnEdit" data-toggle="modal" data-target="#delete<?php echo $menu['id']; ?>"><i style="color:#fff;" class="fa fa-trash"></i>
											</a>
										</td>
										<div class="modal fade" id="delete<?php echo $menu['id']; ?>" role="dialog">
											<div class="modal-dialog">
												<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Meenus/delete/<?php echo $menu['id']; ?>">
													<!-- Modal content-->
													<div class="modal-content">
														<div class="modal-header">
															<h4 class="modal-title">Confirm Header </h4>
															<button type="button" class="close" data-dismiss="modal">&times;</button>

														</div>
														<div class="modal-body">
															<p>Are you sure, you want to delete menu <b><?php echo $menu['menu_name']; ?> </b>? </p>
														</div>
														<div class="modal-footer">
															<button type="submit" class="btn btn-primary ">Submit</button>
															<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
														</div>
													</div>
												</form>
											</div>
										</div>
									</tr>
								<?php $i++;
								} ?>
							</tbody>

						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>