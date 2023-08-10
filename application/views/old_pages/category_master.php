<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
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
		      		<div class="col-md-6">
		      			<?php  //echo $title; exit; ?>
		      			<?php if(!empty($id)) { ?>
				    		<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Categories/editCategory/<?= $id ?>">
				    			<input type="hidden" name="category_id" value="<?= $id?>">
				    			<?php } else { ?>
							<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Categories/add_new_category">
				    			<?php } ?>
				        <div class="form-group">
				        	<div class="row col-md-12">
				        		<div class="col-md-8 col-sm-8 ">
					            	<label class="control-label">Category Name</label>
					                <input type="text"  placeholder="Enter category name" name="category_name" class="form-control" value="<?= $category_name?>" required autofocus>
					            </div>
					        </div>
					        <span class="help-block"></span>
					        <?php if(!empty($id)) { ?>
				           <div class="row col-md-12">
				        		<div class="col-md-8 col-sm-8 ">
					            	<label class="control-label">Status</label>
					               <select class="form-control" name="flag">
					               		<option value="0"> Active</option>
					               		<option value="1"> De-active</option>
					               </select>
					            </div>
				        	</div>
				        <?php } ?>
				           <div class="row col-md-12">
					            <div class="col-md-8 col-sm-8 ">
					            	<label class="control-label" style="visibility: hidden;"> Name</label><br>
					            	<button type="submit"  class="btn btn-primary btn-block" >Save</button>
					            </div>
					        </div>
				        </div>
				        </form>
					</div>
				 <!-- /form -->
				<div class="col-md-6">
					<h5> Category List</h5>
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th> Sr.No.</th>
								<th> Category</th>
								<th> Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $i=1;foreach($categories as $category) { ?>
							<tr>
								<td><?= $i ?></td>
								<td><?= $category['category_name']?></td>
								<td> <a class="btn btn-xs btn-info btnEdit" href="<?php echo base_url(); ?>index.php/Categories/index/<?php echo $category['id'];?>"><i class="fa fa-edit"></i></a></td>
							</tr>
						<?php $i++;} ?>
						</tbody>
						
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
