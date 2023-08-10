<?php
//print_r($menus);exit;
?>

<div id="bread">
	<ul class="accordion">
		<?php
		foreach ($menus as $menu) {
			if (empty($menu->sub)) {
				$checked = '';
				if (in_array($menu->id, $userRightsIds)) {
					$checked = 'checked';
				}
		?>
				<li style="margin-top: 5px;">
					<label>
						<input type="checkbox" name="menu_id[]" value="<?php echo $menu->id; ?>" <?= $checked ?> class="menu_check">
						<?php echo $menu->menu_name; ?>


					</label>
				</li>
			<?php
			} else if (!empty($menu->sub)) {
				$checked = '';
				if (in_array($menu->id, $userRightsIds)) {
					$checked = 'checked';
				}
			?>
				<li class="treeview ">
					<label>
						<input type="checkbox" name="menu_id[]" value="<?php echo $menu->id; ?>" <?= $checked ?> class="menu_check">
						<a href="javascript:void(0)" class="toggle">
							<?php echo $menu->menu_name; ?>
						</a>
					</label>
					<ul class="treeview-menu inner" style="display: none;">
						<?php
						foreach ($menu->sub as $submenu) {
							if (!empty($submenu->sub)) {
								$checked = '';
								if (in_array($submenu->id, $userRightsIds)) {
									$checked = 'checked';
								}
						?>
								<li class="treeview">
									<label>
										<input type="checkbox" name="menu_id[]" value="<?php echo $submenu->id; ?>" <?= $checked ?> class="menu_check">
										<a href="javascript:void(0)" class="toggle">
											<?php echo $submenu->menu_name; ?>
										</a>
									</label>
									<ul class="treeview-menu inner" style="display: none;">
										<?php
										foreach ($submenu->sub as $subsubmenu) {
											if (!empty($subsubmenu->sub)) {
												$checked = '';
												if (in_array($subsubmenu->id, $userRightsIds)) {
													$checked = 'checked';
												}
										?>
												<li class="treeview">
													<label>
														<input type="checkbox" name="menu_id[]" value="<?php echo $subsubmenu->id; ?>" <?= $checked ?> class="menu_check">
														<a href="javascript:void(0)" class="toggle">
															<?php echo $subsubmenu->menu_name; ?>
														</a>
													</label>
													<ul class="treeview-menu inner" style="display: none;">
														<?php
														foreach ($subsubmenu->sub as $subsubsubmenu) {

															$checked = '';
															if (in_array($subsubsubmenu->id, $userRightsIds)) {
																$checked = 'checked';
															}
														?>
															<li style="margin-top: 5px;">
																<label>
																	<input type="checkbox" name="menu_id[]" value="<?php echo $subsubsubmenu->id; ?>" <?= $checked ?> class="menu_check">
																	<?php echo $subsubsubmenu->menu_name; ?>
																</label>
															</li>
														<?php } ?>
													</ul>
												</li>
											<?php } else {

												$checked = '';
												if (in_array($subsubmenu->id, $userRightsIds)) {
													$checked = 'checked';
												} ?>
												<li style="margin-top: 5px;"><label>
														<input type="checkbox" name="menu_id[]" value="<?php echo $subsubmenu->id; ?>" <?= $checked ?> class="menu_check">
														<?php echo $subsubmenu->menu_name; ?>
													</label>
												</li>
										<?php  }
										}
										?>
									</ul>
								</li>
							<?php } else {
								$checked = '';
								if (in_array($submenu->id, $userRightsIds)) {
									$checked = 'checked';
								}
							?>
								<li style="margin-top: 5px;"><label>
										<input type="checkbox" name="menu_id[]" value="<?php echo $submenu->id; ?>" <?= $checked ?> class="menu_check">
										<?php echo $submenu->menu_name; ?>
									</label>
								</li>
						<?php
							}
						}
						?>
					</ul>
				</li>
		<?php
			}
		}
		?>
	</ul>
</div>

<div class="col-md-6">
	<label class="control-label" style="visibility: hidden;"> Name</label><br>
	<button type="submit" class="btn btn-primary btn-block">Update</button>
</div>