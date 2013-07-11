<div class="wrap">
  <div class="form-wrap">
    <div id="icon-edit" class="icon32 icon32-posts-post"><br>
    </div>
    <h2><?php echo WP_ctsop_TITLE; ?></h2>
    <?php
	$ctsop_height_display_length_s1 = get_option('ctsop_height_display_length_s1');
	$ctsop_height_display_length_s2 = get_option('ctsop_height_display_length_s2');
	$ctsop_height_display_length_s3 = get_option('ctsop_height_display_length_s3');
	
	$ctsop_height_display_length_s1_new = explode("_", $ctsop_height_display_length_s1);
	$ctsop_height_1 = @$ctsop_height_display_length_s1_new[0];
	$ctsop_display_1 = @$ctsop_height_display_length_s1_new[1];
	$ctsop_length_1 = @$ctsop_height_display_length_s1_new[2];
	
	$ctsop_height_display_length_s2 = explode("_", $ctsop_height_display_length_s2);
	$ctsop_height_2 = @$ctsop_height_display_length_s2[0];
	$ctsop_display_2 = @$ctsop_height_display_length_s2[1];
	$ctsop_length_2 = @$ctsop_height_display_length_s2[2];
	
	$ctsop_height_display_length_s3 = explode("_", $ctsop_height_display_length_s3);
	$ctsop_height_3 = @$ctsop_height_display_length_s3[0];
	$ctsop_display_3 = @$ctsop_height_display_length_s3[1];
	$ctsop_length_3 = @$ctsop_height_display_length_s3[2];
	
	if (isset($_POST['ctsop_form_submit']) && $_POST['ctsop_form_submit'] == 'yes')
	{
		$ctsop_height_1 = stripslashes($_POST['ctsop_height_1']);
		$ctsop_display_1 = stripslashes($_POST['ctsop_display_1']);
		$ctsop_length_1 = stripslashes($_POST['ctsop_length_1']);
		
		$ctsop_height_2 = stripslashes($_POST['ctsop_height_2']);
		$ctsop_display_2 = stripslashes($_POST['ctsop_display_2']);
		$ctsop_length_2 = stripslashes($_POST['ctsop_length_2']);
		
		$ctsop_height_3 = stripslashes($_POST['ctsop_height_3']);
		$ctsop_display_3 = stripslashes($_POST['ctsop_display_3']);
		$ctsop_length_3 = stripslashes($_POST['ctsop_length_3']);
		
		$ctsop_height_display_length_s1 = $ctsop_height_1 . "_" . $ctsop_display_1. "_" . $ctsop_length_1;
		$ctsop_height_display_length_s2 = $ctsop_height_2 . "_" . $ctsop_display_2. "_" . $ctsop_length_2;
		$ctsop_height_display_length_s3 = $ctsop_height_3 . "_" . $ctsop_display_3. "_" . $ctsop_length_3;
		
		update_option('ctsop_height_display_length_s1', $ctsop_height_display_length_s1 );
		update_option('ctsop_height_display_length_s2', $ctsop_height_display_length_s2 );
		update_option('ctsop_height_display_length_s3', $ctsop_height_display_length_s3 );
		
		?>
		<div class="updated fade">
			<p><strong>Details successfully updated.</strong></p>
		</div>
		<?php
	}
	?>
	<script language="JavaScript" src="<?php echo get_option('siteurl'); ?>/wp-content/plugins/content-text-slider-on-post/pages/setting.js"></script>
	<form name="ctsop_form" method="post" action="">
		
		<h3>Setting 1</h3>
		
		<label for="tag-title">Record height in scroll</label>
		<input name="ctsop_height_1" type="text" id="ctsop_height_1" value="<?php echo $ctsop_height_1; ?>" maxlength="4" />
		<p>This is the height of the each record in the scroll.</p>
		
		<label for="tag-title">Display records</label>
		<input name="ctsop_display_1" type="text" id="ctsop_display_1" value="<?php echo $ctsop_display_1; ?>" maxlength="4" />
		<p>No of records you want to show in the screen at same time.</p>
		
		<label for="tag-title">Text Length</label>
		<input name="ctsop_length_1" type="text" id="ctsop_length_1" value="<?php echo $ctsop_length_1; ?>" maxlength="4" />
		<p>This is to maintain the record description length in the scroll. </p>
		
		<h3>Setting 2</h3>
		
		<label for="tag-title">Record height in scroll</label>
		<input name="ctsop_height_2" type="text" id="ctsop_height_2" value="<?php echo $ctsop_height_2; ?>" maxlength="4" />
		<p>This is the height of the each record in the scroll.</p>
		
		<label for="tag-title">Display records</label>
		<input name="ctsop_display_2" type="text" id="ctsop_display_2" value="<?php echo $ctsop_display_2; ?>" maxlength="4" />
		<p>No of records you want to show in the screen at same time.</p>
		
		<label for="tag-title">Text Length</label>
		<input name="ctsop_length_2" type="text" id="ctsop_length_2" value="<?php echo $ctsop_length_2; ?>" maxlength="4" />
		<p>This is to maintain the record description length in the scroll. </p>
		
		<h3>Setting 3</h3>
		
		<label for="tag-title">Record height in scroll</label>
		<input name="ctsop_height_3" type="text" id="ctsop_height_3" value="<?php echo $ctsop_height_3; ?>" maxlength="4" />
		<p>This is the height of the each record in the scroll.</p>
		
		<label for="tag-title">Display records</label>
		<input name="ctsop_display_3" type="text" id="ctsop_display_3" value="<?php echo $ctsop_display_3; ?>" maxlength="4" />
		<p>No of records you want to show in the screen at same time.</p>
		
		<label for="tag-title">Text Length</label>
		<input name="ctsop_length_3" type="text" id="ctsop_length_3" value="<?php echo $ctsop_length_3; ?>" maxlength="4" />
		<p>This is to maintain the record description length in the scroll. </p>
		
		
		<div style="height:5px;"></div>
		<input type="hidden" name="ctsop_form_submit" value="yes"/>
		<input name="ctsop_submit" id="ctsop_submit" class="button add-new-h2" value="Submit" type="submit" />&nbsp;
		<input name="publish" lang="publish" class="button add-new-h2" onclick="ctsop_redirect()" value="Cancel" type="button" />&nbsp;
		<input name="Help" lang="publish" class="button add-new-h2" onclick="ctsop_help()" value="Help" type="button" />
		<div style="height:5px;"></div>
		<?php wp_nonce_field('ctsop_form_setting'); ?>
    </form>
	 </div>
  <p class="description"><?php echo WP_ctsop_LINK; ?></p>
</div>