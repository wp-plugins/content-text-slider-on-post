<?php
// Form submitted, check the data
if (isset($_POST['frm_ctsop_display']) && $_POST['frm_ctsop_display'] == 'yes')
{
	$did = isset($_GET['did']) ? $_GET['did'] : '0';
	
	$ctsop_success = '';
	$ctsop_success_msg = FALSE;
	
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
		?><div class="error fade"><p><strong>Oops, selected details doesn't exist (1).</strong></p></div><?php
	}
	else
	{
		// Form submitted, check the action
		if (isset($_GET['ac']) && $_GET['ac'] == 'del' && isset($_GET['did']) && $_GET['did'] != '')
		{
			//	Just security thingy that wordpress offers us
			check_admin_referer('ctsop_form_show');
			
			//	Delete selected record from the table
			$sSql = $wpdb->prepare("DELETE FROM `".WP_ctsop_TABLE."`
					WHERE `ctsop_id` = %d
					LIMIT 1", $did);
			$wpdb->query($sSql);
			
			//	Set success message
			$ctsop_success_msg = TRUE;
			$ctsop_success = __('Selected record was successfully deleted.', ctsop_UNIQUE_NAME);
		}
	}
	
	if ($ctsop_success_msg == TRUE)
	{
		?><div class="updated fade"><p><strong><?php echo $ctsop_success; ?></strong></p></div><?php
	}
}
?>
<div class="wrap">
  <div id="icon-edit" class="icon32 icon32-posts-post"></div>
    <h2><?php echo WP_ctsop_TITLE; ?><a class="add-new-h2" href="<?php echo get_option('siteurl'); ?>/wp-admin/options-general.php?page=content-text-slider-on-post&amp;ac=add">Add New</a></h2>
    <div class="tool-box">
	<?php
		$sSql = "SELECT * FROM `".WP_ctsop_TABLE."` order by ctsop_id desc";
		$myData = array();
		$myData = $wpdb->get_results($sSql, ARRAY_A);
		?>
		<script language="JavaScript" src="<?php echo get_option('siteurl'); ?>/wp-content/plugins/content-text-slider-on-post/pages/setting.js"></script>
		<form name="frm_ctsop_display" method="post">
      <table width="100%" class="widefat" id="straymanage">
        <thead>
          <tr>
            <th class="check-column" scope="col" style="width:15px;"><input type="checkbox" name="ctsop_group_item[]" /></th>
			<th scope="col" style="width:15px;">Id</th>
			<th scope="col" style="width:220px;">Title</th>
            <th scope="col">Message</th>
			<th scope="col">Group</th>
          </tr>
        </thead>
		<tfoot>
          <tr>
            <th class="check-column" scope="col" style="height:15px;"><input type="checkbox" name="ctsop_group_item[]" /></th>
			<th scope="col" style="width:15px;">Id</th>
			<th scope="col" style="width:220px;">Title</th>
            <th scope="col">Message</th>
			<th scope="col">Group</th>
          </tr>
        </tfoot>
		<tbody>
			<?php 
			$i = 0;
			if(count($myData) > 0 )
			{
				foreach ($myData as $data)
				{
					?>
					<tr class="<?php if ($i&1) { echo'alternate'; } else { echo ''; }?>">
						<td align="left"><input type="checkbox" value="<?php echo $data['ctsop_id']; ?>" name="ctsop_group_item[]"></th>
						<td><?php echo stripslashes($data['ctsop_id']); ?></td>
						<td><?php echo stripslashes($data['ctsop_title']); ?>
						<div class="row-actions">
							<span class="edit"><a title="Edit" href="<?php echo get_option('siteurl'); ?>/wp-admin/options-general.php?page=content-text-slider-on-post&amp;ac=edit&amp;did=<?php echo $data['ctsop_id']; ?>">Edit</a> | </span>
							<span class="trash"><a onClick="javascript:ctsop_delete('<?php echo $data['ctsop_id']; ?>')" href="javascript:void(0);">Delete</a></span> 
						</div>
						</td>
						<td><?php echo stripslashes($data['ctsop_text']); ?></td>
						<td><?php echo stripslashes($data['ctsop_group']); ?></td>
					</tr>
					<?php 
					$i = $i+1; 
				} 	
			}
			else
			{
				?><tr><td colspan="4" align="center">No records available.</td></tr><?php 
			}
			?>
		</tbody>
        </table>
		<?php wp_nonce_field('ctsop_form_show'); ?>
		<input type="hidden" name="frm_ctsop_display" value="yes"/>
      </form>	
	  <div class="tablenav">
	  <h2>
	  <a class="button add-new-h2" href="<?php echo get_option('siteurl'); ?>/wp-admin/options-general.php?page=content-text-slider-on-post&amp;ac=add">Add New</a>
	  <a class="button add-new-h2" href="<?php echo get_option('siteurl'); ?>/wp-admin/options-general.php?page=content-text-slider-on-post&amp;ac=set">Plugin setting</a>
	  <a class="button add-new-h2" target="_blank" href="<?php echo WP_ctsop_FAV; ?>">Help</a>
	  </h2>
	  </div>
	  <div style="height:5px"></div>
	<h3>Plugin configuration option</h3>
	<ol>
		<li>Add the plugin in the posts or pages using short code.</li>
		<li>Add directly in to the theme using PHP code.</li>
	</ol>
	<p class="description"><?php echo WP_ctsop_LINK; ?></p>
	</div>
</div>