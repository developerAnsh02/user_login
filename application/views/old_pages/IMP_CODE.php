<?php
if(!empty($subsubmenu->sub))
	{
	$checked='';
	if(in_array($subsubmenu->id, $userRightsIds))
	{
		$checked='checked';
	}
	?>
<li  style="margin-top: 5px;">
 	<label>
 		<input type="checkbox" name="menu_id[]" value="<?php echo $subsubmenu->id ; ?>" <?= $checked ?> class="menu_check" >
 		<?php echo $subsubmenu->menu_name; ?>
     </label>
    <ul class="treeview-menu inner" style="display: none;">
    <?php
        foreach ($subsubmenu->sub as $subsubsubmenu) {
        	$checked='';
	    	if(in_array($subsubsubmenu->id, $userRightsIds))
	    	{
	    		$checked='checked';
	    	}
            ?>
        	<li  style="margin-top: 5px;">
         		<label>
         			<input type="checkbox" name="menu_id[]" value="<?php echo $subsubsubmenu->id ; ?>" <?= $checked ?> class="menu_check" >
         		<?php echo $subsubsubmenu->menu_name; ?>
             	</label>
            </li>
        <?php } ?>
        </ul>
  </li>