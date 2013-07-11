<div class="wrap">
<?php
$did = isset($_GET['did']) ? $_GET['did'] : '0';

// First check if ID exist with requested ID
$sSql = $wpdb->prepare(
	"SELECT COUNT(*) AS `count` FROM ".WP_ctsop_TABLE."
	WHERE `ctsop_id` = %d",
	array($did)
);
$result = '0';
$result = $wpdb->get_var($sSql);

if ($result != '1')
{
	?><div class="error fade"><p><strong>Oops, selected details doesn't exist.</strong></p></div><?php
}
else
{
	$ctsop_errors = array();
	$ctsop_success = '';
	$ctsop_error_found = FALSE;
	
	$sSql = $wpdb->prepare("
		SELECT *
		FROM `".WP_ctsop_TABLE."`
		WHERE `ctsop_id` = %d
		LIMIT 1
		",
		array($did)
	);
	$data = array();
	$data = $wpdb->get_row($sSql, ARRAY_A);
	
	// Preset the form fields
	$form = array(
		'ctsop_text' => $data['ctsop_text'],
		'ctsop_title' => $data['ctsop_title'],
		'ctsop_link' => $data['ctsop_link'],
		'ctsop_order' => $data['ctsop_order'],
		'ctsop_status' => $data['ctsop_status'],
		'ctsop_group' => $data['ctsop_group'],
		'ctsop_id' => $data['ctsop_id']
	);
}
// Form submitted, check the data
if (isset($_POST['ctsop_form_submit']) && $_POST['ctsop_form_submit'] == 'yes')
{
	//	Just security thingy that wordpress offers us
	check_admin_referer('ctsop_form_edit');
	
	$form['ctsop_text'] = isset($_POST['ctsop_text']) ? $_POST['ctsop_text'] : '';
	
	$form['ctsop_title'] = isset($_POST['ctsop_title']) ? $_POST['ctsop_title'] : '';
	$form['ctsop_link'] = isset($_POST['ctsop_link']) ? $_POST['ctsop_link'] : '';
	$form['ctsop_status'] = isset($_POST['ctsop_status']) ? $_POST['ctsop_status'] : '';
	$form['ctsop_group'] = isset($_POST['ctsop_group']) ? $_POST['ctsop_group'] : '';
	$form['ctsop_order'] = isset($_POST['ctsop_order']) ? $_POST['ctsop_order'] : '';
	
	if ($form['ctsop_text'] == '')
	{
		$ctsop_errors[] = __('Please enter the message.', ctsop_UNIQUE_NAME);
		$ctsop_error_found = TRUE;
	}
	
	if ($form['ctsop_group'] == '')
	{
		$ctsop_errors[] = __('Please enter title.select your group.', ctsop_UNIQUE_NAME);
		$ctsop_error_found = TRUE;
	}

	//	No errors found, we can add this Group to the table
	if ($ctsop_error_found == FALSE)
	{	
		$sSql = $wpdb->prepare(
				"UPDATE `".WP_ctsop_TABLE."`
				SET `ctsop_text` = %s,
				`ctsop_title` = %s,
				`ctsop_link` = %s,
				`ctsop_order` = %s,
				`ctsop_status` = %s,
				`ctsop_group` = %s
				WHERE ctsop_id = %d
				LIMIT 1",
				array($form['ctsop_text'], $form['ctsop_title'], $form['ctsop_link'], $form['ctsop_order'], $form['ctsop_status'], $form['ctsop_group'], $did)
			);
		$wpdb->query($sSql);
		
		$ctsop_success = 'Details was successfully updated.';
	}
}

if ($ctsop_error_found == TRUE && isset($ctsop_errors[0]) == TRUE)
{
?>
  <div class="error fade">
    <p><strong><?php echo $ctsop_errors[0]; ?></strong></p>
  </div>
  <?php
}
if ($ctsop_error_found == FALSE && strlen($ctsop_success) > 0)
{
?>
  <div class="updated fade">
    <p><strong><?php echo $ctsop_success; ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/options-general.php?page=content-text-slider-on-post">Click here</a> to view the details</strong></p>
  </div>
  <?php
}
?>
<script language="JavaScript" src="<?php echo get_option('siteurl'); ?>/wp-content/plugins/content-text-slider-on-post/pages/setting.js"></script>
<script language="JavaScript" src="<?php echo get_option('siteurl'); ?>/wp-content/plugins/content-text-slider-on-post/pages/noenter.js"></script>
<div class="form-wrap">
	<div id="icon-edit" class="icon32 icon32-posts-post"><br></div>
	<h2><?php echo WP_ctsop_TITLE; ?></h2>
	<form name="ctsop_form" method="post" action="#" onsubmit="return ctsop_submit()"  >
      <h3>Update details</h3>
	  
		<label for="tag-title">Title</label>
		<input name="ctsop_title" type="text" id="ctsop_title" value="<?php echo esc_html(stripslashes($form['ctsop_title'])); ?>" size="103" />
		<p>Enter your title.</p>
		
		<label for="tag-title">Message/Content</label>
		<textarea name="ctsop_text" id="ctsop_text" cols="100" rows="5"><?php echo esc_html(stripslashes($form['ctsop_text'])); ?></textarea>
		<p>Enter your message/content.</p>
		
		<label for="tag-title">Link</label>
		<input name="ctsop_link" type="text" id="ctsop_link" value="<?php echo esc_html(stripslashes($form['ctsop_link'])); ?>" size="103" />
		<p>Enter your link.</p>
	  
	  	<label for="tag-title">Display status</label>
		<select name="ctsop_status" id="ctsop_status">
			<option value="">Select</option>
            <option value='YES' <?php if($form['ctsop_status'] == 'YES') { echo "selected='selected'" ; } ?>>Yes</option>
            <option value='NO' <?php if($form['ctsop_status'] == 'NO') { echo "selected='selected'" ; } ?>>No</option>
          </select>
		<p>Do you want to show this message in the slider?</p>
		
		<label for="tag-title">Group name</label>
		<select name="ctsop_group" id="ctsop_group">
		<option value="">Select</option>
		<?php
		$sSql = "SELECT distinct(ctsop_group) as ctsop_group FROM `".WP_ctsop_TABLE."` order by ctsop_group";
		$myDistinctData = array();
		$arrDistinctDatas = array();
		$myDistinctData = $wpdb->get_results($sSql, ARRAY_A);
		$i = 0;
		foreach ($myDistinctData as $DistinctData)
		{
			$arrDistinctData[$i]["ctsop_group"] = strtoupper($DistinctData['ctsop_group']);
			$i = $i+1;
		}
		for($j=$i; $j<$i+5; $j++)
		{
			$arrDistinctData[$j]["ctsop_group"] = "GROUP" . $j;
		}
		$arrDistinctDatas = array_unique($arrDistinctData, SORT_REGULAR);
		foreach ($arrDistinctDatas as $arrDistinct)
		{		
			if(strtoupper($form['ctsop_group']) == strtoupper($arrDistinct["ctsop_group"]) ) 
			{ 
				$selected = "selected='selected'"; 
			}
			?>
			<option value='<?php echo $arrDistinct["ctsop_group"]; ?>' <?php echo $selected; ?>><?php echo strtoupper($arrDistinct["ctsop_group"]); ?></option>
			<?php
			$selected = "";
		}
		?>
		</select>
		<p></p>
		
		<label for="tag-title">Order</label>
		<input name="ctsop_order" type="text" id="ctsop_order" value="<?php echo $form['ctsop_order']; ?>" maxlength="3" />
		<p>Enter your display order, only number.</p>
	  
      <input name="ctsop_id" id="ctsop_id" type="hidden" value="<?php echo $form['ctsop_id']; ?>">
      <input type="hidden" name="ctsop_form_submit" value="yes"/>
      <p class="submit">
        <input name="publish" lang="publish" class="button add-new-h2" value="Update Details" type="submit" />&nbsp;
        <input name="publish" lang="publish" class="button add-new-h2" onclick="ctsop_redirect()" value="Cancel" type="button" />&nbsp;
        <input name="Help" lang="publish" class="button add-new-h2" onclick="ctsop_help()" value="Help" type="button" />
      </p>
	  <?php wp_nonce_field('ctsop_form_edit'); ?>
    </form>
</div>
<p class="description"><?php echo WP_ctsop_LINK; ?></p>
</div>