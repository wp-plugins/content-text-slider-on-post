<!--/**
 *     Content text slider on post
 *     Copyright (C) 2012  www.gopipulse.com
 * 
 *     This program is free software: you can redistribute it and/or modify
 *     it under the terms of the GNU General Public License as published by
 *     the Free Software Foundation, either version 3 of the License, or
 *     (at your option) any later version.
 * 
 *     This program is distributed in the hope that it will be useful,
 *     but WITHOUT ANY WARRANTY; without even the implied warranty of
 *     MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *     GNU General Public License for more details.
 * 
 *     You should have received a copy of the GNU General Public License
 *     along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 *     http://www.gopipulse.com/work/2012/01/02/content-text-slider-on-post-wordpress-plugin/
 */-->

<div class="wrap">
  <?php
  	global $wpdb;
    @$mainurl = get_option('siteurl')."/wp-admin/options-general.php?page=content-text-slider-on-post/content-management.php";
    @$DID=@$_GET["DID"];
    @$AC=@$_GET["AC"];
    @$submittext = "Insert Message";
	if($AC <> "DEL" and trim(@$_POST['ctsop_text']) <>"")
    {
			if($_POST['ctsop_id'] == "" )
			{
					$sql = "insert into ".WP_ctsop_TABLE.""
					. " set `ctsop_text` = '" . mysql_real_escape_string(trim($_POST['ctsop_text']))
					. "', `ctsop_title` = '" . $_POST['ctsop_title']
					. "', `ctsop_link` = '" . $_POST['ctsop_link']
					. "', `ctsop_order` = '" . $_POST['ctsop_order']
					. "', `ctsop_status` = '" . $_POST['ctsop_status']
					. "', `ctsop_group` = '" . $_POST['ctsop_group']
					. "'";	
			}
			else
			{
					$sql = "update ".WP_ctsop_TABLE.""
					. " set `ctsop_text` = '" . mysql_real_escape_string(trim($_POST['ctsop_text']))
					. "', `ctsop_title` = '" . $_POST['ctsop_title']
					. "', `ctsop_link` = '" . $_POST['ctsop_link']
					. "', `ctsop_order` = '" . $_POST['ctsop_order']
					. "', `ctsop_status` = '" . $_POST['ctsop_status']
					. "', `ctsop_group` = '" . $_POST['ctsop_group']
					. "' where `ctsop_id` = '" . $_POST['ctsop_id'] 
					. "'";	
			}
			$wpdb->get_results($sql);
    }
    
    if($AC=="DEL" && $DID > 0)
    {
        $wpdb->get_results("delete from ".WP_ctsop_TABLE." where ctsop_id=".$DID);
    }
    
    if($DID<>"" and $AC <> "DEL")
    {
        $data = $wpdb->get_results("select * from ".WP_ctsop_TABLE." where ctsop_id=$DID limit 1");
        if ( empty($data) ) 
        {
           echo "<div id='message' class='error'><p>No data available! use below form to create!</p></div>";
           return;
        }
        $data = $data[0];
        if ( !empty($data) ) $ctsop_id_x = htmlspecialchars(stripslashes($data->ctsop_id)); 
		if ( !empty($data) ) $ctsop_title_x = htmlspecialchars(stripslashes($data->ctsop_title));
        if ( !empty($data) ) $ctsop_text_x = htmlspecialchars(stripslashes($data->ctsop_text));
		if ( !empty($data) ) $ctsop_link_x = htmlspecialchars(stripslashes($data->ctsop_link));
        if ( !empty($data) ) $ctsop_status_x = htmlspecialchars(stripslashes($data->ctsop_status));
		if ( !empty($data) ) $ctsop_group_x = htmlspecialchars(stripslashes($data->ctsop_group));
		if ( !empty($data) ) $ctsop_order_x = htmlspecialchars(stripslashes($data->ctsop_order));
        $submittext = "Update Message";
    }
    ?>
  <h2>Content text slider on post</h2>
  <script language="JavaScript" src="<?php echo get_option('siteurl'); ?>/wp-content/plugins/content-text-slider-on-post/setting.js"></script>
  <script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl'); ?>/wp-content/plugins/content-text-slider-on-post/noenter.js"></script>
  <form name="ctsop_form" method="post" action="<?php echo $mainurl; ?>" onsubmit="return ctsop_submit()"  >
    <table width="100%">
    <tr>
        <td colspan="3" align="left" valign="middle">Enter the Title:</td>
      </tr>
      <tr>
        <td colspan="3" align="left" valign="middle"><input name="ctsop_title" type="text" id="ctsop_title" value="<?php echo @$ctsop_title_x; ?>" size="120" maxlength="1000" /></td>
      </tr>
      <tr>
        <td colspan="3" align="left" valign="middle">Enter the message:</td>
      </tr>
      <tr>
        <td colspan="3" align="left" valign="middle">
        <textarea name="ctsop_text" id="ctsop_text" cols="130" rows="5"><?php echo @$ctsop_text_x; ?></textarea></td>
      </tr>
      <tr>
        <td colspan="3" align="left" valign="middle">Enter Link:</td>
      </tr>
      <tr>
        <td colspan="3" align="left" valign="middle"><input name="ctsop_link" type="text" id="ctsop_link" value="<?php echo @$ctsop_link_x; ?>" size="120" /></td>
      </tr>
      <tr>
        <td align="left" valign="middle">Display Status:</td>
        <td align="left" valign="middle">Group Name:</td>
        <td align="left" valign="middle">Display Order:</td>
      </tr>
      <tr>
        <td width="12%" align="left" valign="middle"><select name="ctsop_status" id="ctsop_status">
            <option value="">Select</option>
            <option value='YES' <?php if(@$ctsop_status_x=='YES') { echo 'selected' ; } ?>>Yes</option>
            <option value='NO' <?php if(@$ctsop_status_x=='NO') { echo 'selected' ; } ?>>No</option>
          </select>
        </td>
        <td width="15%" align="left" valign="middle">
        <select name="ctsop_group" id="ctsop_group">
            <option value='GROUP1' <?php if(@$ctsop_group_x=='GROUP1') { echo 'selected' ; } ?>>GROUP1</option>
            <option value='GROUP2' <?php if(@$ctsop_group_x=='GROUP2') { echo 'selected' ; } ?>>GROUP2</option>
            <option value='GROUP3' <?php if(@$ctsop_group_x=='GROUP3') { echo 'selected' ; } ?>>GROUP3</option>
            <option value='GROUP4' <?php if(@$ctsop_group_x=='GROUP4') { echo 'selected' ; } ?>>GROUP4</option>
            <option value='GROUP5' <?php if(@$ctsop_group_x=='GROUP5') { echo 'selected' ; } ?>>GROUP5</option>
            <option value='GROUP6' <?php if(@$ctsop_group_x=='GROUP6') { echo 'selected' ; } ?>>GROUP6</option>
            <option value='GROUP7' <?php if(@$ctsop_group_x=='GROUP7') { echo 'selected' ; } ?>>GROUP7</option>
            <option value='GROUP8' <?php if(@$ctsop_group_x=='GROUP8') { echo 'selected' ; } ?>>GROUP8</option>
            <option value='GROUP9' <?php if(@$ctsop_group_x=='GROUP9') { echo 'selected' ; } ?>>GROUP9</option>
            <option value='GROUP10' <?php if(@$ctsop_group_x=='GROUP10') { echo 'selected' ; } ?>>GROUP10</option>
          </select>
        </td>
        <td width="73%" align="left" valign="middle"><input name="ctsop_order" type="text" id="ctsop_order" size="10" value="<?php echo @$ctsop_order_x; ?>" maxlength="3" /></td>
      </tr>
      <tr>
        <td height="35" colspan="3" align="left" valign="bottom"><table width="100%">
            <tr>
              <td width="50%" align="left"><input name="publish" lang="publish" class="button-primary" value="<?php echo @$submittext?>" type="submit" />
                <input name="publish" lang="publish" class="button-primary" onclick="_ctsop_redirect()" value="Cancel" type="button" />
              </td>
              <td width="50%" align="right">
			  <input name="text_management1" lang="text_management" class="button-primary" onClick="location.href='options-general.php?page=content-text-slider-on-post/content-management.php'" value="Go to - Text Management Page" type="button" />
        	  <input name="setting_management1" lang="setting_management" class="button-primary" onClick="location.href='options-general.php?page=content-text-slider-on-post/content-text-slider-on-post.php'" value="Go to - Setting Page" type="button" />
			  <input name="Help1" lang="publish" class="button-primary" onclick="_ctsop_help()" value="Help" type="button" />
			  </td>
            </tr>
          </table></td>
      </tr>
      <input name="ctsop_id" id="ctsop_id" type="hidden" value="<?php echo @$ctsop_id_x; ?>">
    </table>
  </form>
  <div class="tool-box">
    <?php
	$data = $wpdb->get_results("select * from ".WP_ctsop_TABLE." order by ctsop_order");
	if ( empty($data) ) 
	{ 
		echo "<div id='message' class='error'>No data available! use below form to create!</div>";
		return;
	}
	?>
    <form name="ctsop_Display" method="post">
      <table width="100%" class="widefat" id="straymanage">
        <thead>
          <tr>
            <th width="3%" align="left" scope="col">ID
              </td>
            <th width="65%" align="left" scope="col">Message
              </td>
            <th width="11%" align="left" scope="col">Group            
            <th width="6%" align="left" scope="col"> Order
              </td>
            <th width="7%" align="left" scope="col">Display
              </td>
            <th width="8%" align="left" scope="col">Action
              </td>
          </tr>
        </thead>
        <?php 
        $i = 0;
        foreach ( $data as $data ) { 
		if($data->ctsop_status=='YES') { $displayisthere="True"; }
        ?>
        <tbody>
          <tr class="<?php if ($i&1) { echo'alternate'; } else { echo ''; }?>">
            <td align="left" valign="middle"><?php echo(stripslashes($data->ctsop_id)); ?></td>
            <td align="left" valign="middle"><?php echo(stripslashes($data->ctsop_text)); ?></td>
            <td align="left" valign="middle"><?php echo(stripslashes($data->ctsop_group)); ?></td>
            <td align="left" valign="middle"><?php echo(stripslashes($data->ctsop_order)); ?></td>
            <td align="left" valign="middle"><?php echo(stripslashes($data->ctsop_status)); ?></td>
            <td align="left" valign="middle"><a href="options-general.php?page=content-text-slider-on-post/content-management.php&DID=<?php echo($data->ctsop_id); ?>">Edit</a> &nbsp; <a onClick="javascript:_ctsop_delete('<?php echo($data->ctsop_id); ?>')" href="javascript:void(0);">Delete</a> </td>
          </tr>
        </tbody>
        <?php $i = $i+1; } ?>
        <?php if($displayisthere<>"True") { ?>
        <tr>
          <td colspan="6" align="center" style="color:#FF0000" valign="middle">No message available with display status 'Yes'!' </td>
        </tr>
        <?php } ?>
      </table>
    </form>
  </div>
  <table width="100%">
    <tr>
      <td align="right"><input name="text_management" lang="text_management" class="button-primary" onClick="location.href='options-general.php?page=content-text-slider-on-post/content-management.php'" value="Go to - Text Management Page" type="button" />
        <input name="setting_management" lang="setting_management" class="button-primary" onClick="location.href='options-general.php?page=content-text-slider-on-post/content-text-slider-on-post.php'" value="Go to - Setting Page" type="button" />
		<input name="Help" lang="publish" class="button-primary" onclick="_ctsop_help()" value="Help" type="button" />
      </td>
    </tr>
  </table>
  <?php include_once("help.php"); ?>
</div>
