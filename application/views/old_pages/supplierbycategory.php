<?php if (!empty($states)){ ?>
        <label  class="control-label"> State</label>
            <?php  
              echo form_dropdown('state_id', $states)
            ?>
	 <?php } ?>

    <?php if (!empty($cities)){ ?>
        <label  class="control-label"> City</label>
            <?php  
              echo form_dropdown('city_id', $cities)
            ?>

   <?php } ?>

