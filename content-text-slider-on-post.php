<?php

/*
Plugin Name: Content text slider on post
Plugin URI: http://www.gopiplus.com/work/2012/01/02/content-text-slider-on-post-wordpress-plugin/
Description: Content text slider on post is a WordPress plugin from gopiplus.com website. We can use this plugin to scroll the content vertically in the posts and pages. We have option to enter content title, description and link for the content. All entered details scroll vertically into the posts and pages.
Author: Gopi.R
Version: 2.0
Author URI: http://www.gopiplus.com/work/2012/01/02/content-text-slider-on-post-wordpress-plugin/
Donate link: http://www.gopiplus.com/work/2012/01/02/content-text-slider-on-post-wordpress-plugin/
Tags: Wordpress, plugin, Content, Text, Slider
*/

/**
 *     Content text slider on post
 *     Copyright (C) 2012  www.gopiplus.com
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
 *     http://www.gopiplus.com/work/2012/01/02/content-text-slider-on-post-wordpress-plugin/
 */

global $wpdb, $wp_version;
define("WP_ctsop_TABLE", $wpdb->prefix . "ctsop_plugin");

function ctsop_add_javascript_files() 
{
	if (!is_admin())
	{
		wp_enqueue_script( 'javascript', get_option('siteurl').'/wp-content/plugins/content-text-slider-on-post/content-text-slider-on-post.js');
	}	
}
add_action('init', 'ctsop_add_javascript_files');


function ctsop_install() 
{
	global $wpdb;
	
	if($wpdb->get_var("show tables like '". WP_ctsop_TABLE . "'") != WP_ctsop_TABLE) 
	{
		$wpdb->query("
			CREATE TABLE IF NOT EXISTS `". WP_ctsop_TABLE . "` (
			  `ctsop_id` int(11) NOT NULL auto_increment,
			  `ctsop_title` VARCHAR( 1024 ) NOT NULL,
			  `ctsop_text` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
			  `ctsop_link` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
			  `ctsop_order` int(11) NOT NULL default '0',
			  `ctsop_status` char(3) NOT NULL default 'No',
			  `ctsop_group` VARCHAR( 100 ) NOT NULL,
			  `ctsop_date` datetime NOT NULL default '0000-00-00 00:00:00',
			  PRIMARY KEY  (`ctsop_id`) )
			");
		$iIns = "INSERT INTO `". WP_ctsop_TABLE . "` (`ctsop_title`, `ctsop_text`, `ctsop_link`, `ctsop_order`, `ctsop_status`, `ctsop_group`, `ctsop_date`)"; 
		$DummyTitle = "WordPress Plugin";
		$DummyText = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.";
		$DummyLink = "http://www.gopiplus.com/work/";
		$DummyImg = '<img src="'.get_option('siteurl').'/wp-content/plugins/content-text-slider-on-post/images/100x100_1.jpg" style="float:left;padding:5px;" /> '. $DummyText;
		
		$sSql = $iIns . "VALUES ('$DummyTitle', '$DummyText','$DummyLink', '1', 'YES', 'GROUP1', '0000-00-00 00:00:00');";
		$wpdb->query($sSql);
		$sSql = $iIns . "VALUES ('$DummyTitle', '$DummyText','$DummyLink', '2', 'YES', 'GROUP1', '0000-00-00 00:00:00');";
		$wpdb->query($sSql);
		$sSql = $iIns . "VALUES ('$DummyTitle', '$DummyImg','$DummyLink', '3', 'YES', 'GROUP1', '0000-00-00 00:00:00');";
		$wpdb->query($sSql);
		$sSql = $iIns . "VALUES ('$DummyTitle', '$DummyText','$DummyLink', '4', 'YES', 'GROUP2', '0000-00-00 00:00:00');";
		$wpdb->query($sSql);
		$sSql = $iIns . "VALUES ('$DummyTitle', '$DummyText' ,'$DummyLink', '5', 'YES', 'GROUP2', '0000-00-00 00:00:00');";
		$wpdb->query($sSql);
	}
	
	add_option('ctsop_height_display_length_s1', "200_2_500");
	add_option('ctsop_height_display_length_s2', "190_1_500");
	add_option('ctsop_height_display_length_s3', "190_3_500");	
}


function ctsop_admin_options() 
{
	global $wpdb;
	?>
<div class="wrap">
  <h2>Content text slider on post</h2>
</div>
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
	
	if (@$_POST['ctsop_submit']) 
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
		
	}
	
	?>
<form name="ctsop_form" method="post" action="">
<table width="620" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="3"><h3>Setting 1</h3></td>
  </tr>
  <tr>
    <td>Each Record Height</td>
    <td>Display Records #</td>
    <td>Text Length</td>
  </tr>
  <tr>
    <td><input  style="width: 100px;" type="text" value="<?php echo @$ctsop_height_1; ?>" name="ctsop_height_1" id="ctsop_height_1" /></td>
    <td><input  style="width: 100px;" type="text" value="<?php echo @$ctsop_display_1; ?>" name="ctsop_display_1" id="ctsop_display_1" /></td>
    <td><input  style="width: 100px;" type="text" value="<?php echo @$ctsop_length_1; ?>" name="ctsop_length_1" id="ctsop_length_1" /></td>
  </tr>
  <tr>
    <td colspan="3"><h3>Setting 2</h3></td>
  </tr>
  <tr>
    <td>Each Record Height</td>
    <td>Display Records #</td>
    <td>Text Length</td>
  </tr>
  <tr>
    <td><input  style="width: 100px;" type="text" value="<?php echo @$ctsop_height_2; ?>" name="ctsop_height_2" id="ctsop_height_2" /></td>
    <td><input  style="width: 100px;" type="text" value="<?php echo @$ctsop_display_2; ?>" name="ctsop_display_2" id="ctsop_display_2" /></td>
    <td><input  style="width: 100px;" type="text" value="<?php echo @$ctsop_length_2; ?>" name="ctsop_length_2" id="ctsop_length_2" /></td>
  </tr>
  <tr>
    <td colspan="3"><h3>Setting 3</h3></td>
  </tr>
  <tr>
    <td>Each Record Height</td>
    <td>Display Records #</td>
    <td>Text Length</td>
  </tr>
  <tr>
    <td><input  style="width: 100px;" type="text" value="<?php echo @$ctsop_height_3; ?>" name="ctsop_height_3" id="ctsop_height_3" /></td>
    <td><input  style="width: 100px;" type="text" value="<?php echo @$ctsop_display_3; ?>" name="ctsop_display_3" id="ctsop_display_3" /></td>
    <td><input  style="width: 100px;" type="text" value="<?php echo @$ctsop_length_3; ?>" name="ctsop_length_3" id="ctsop_length_3" /></td>
  </tr>
   <tr>
    <td colspan="3" height="40" align="left"><input name="ctsop_submit" id="ctsop_submit" lang="publish" class="button-primary" value="Update All Settings" type="Submit" /></td>
  </tr>
</table>
</form>
<table width="100%">
  <tr>
    <td align="right">
    <input name="text_management" lang="text_management" class="button-primary" onClick="location.href='options-general.php?page=content-text-slider-on-post/content-management.php'" value="Go to - Text Management Page" type="button" />
    <input name="setting_management" lang="setting_management" class="button-primary" onClick="location.href='options-general.php?page=content-text-slider-on-post/content-text-slider-on-post.php'" value="Go to - Setting Page" type="button" /></td>
  </tr>
</table>
<?php include_once("help.php"); ?>
<?php
}

add_filter('the_content','ctsop_Show_Filter');

function ctsop_Show_Filter($content)
{
	return 	preg_replace_callback('/\[CTSOP=(.*?)\]/sim','ctsop_Show_Filter_Callback',$content);
}

function ctsop_Show_Filter_Callback($matches) 
{
	global $wpdb;
	
	$scode = $matches[1];
	
	$newscode = explode("-", $scode);
	$ctsop_setting = @$newscode[0];
	$ctsop_group = @$newscode[1];
	
	if($ctsop_setting == "SETTING1")
	{
		$ctsop_newsetting = get_option('ctsop_height_display_length_s1');
	}
	elseif($ctsop_setting == "SETTING2")
	{
		$ctsop_newsetting = get_option('ctsop_height_display_length_s2');
	}
	elseif($ctsop_setting == "SETTING3")
	{
		$ctsop_newsetting = get_option('ctsop_height_display_length_s3');
	}
	else
	{
		$ctsop_newsetting = get_option('ctsop_height_display_length_s1');
	}
	
	
	$ctsop_height_display_length = explode("_", $ctsop_newsetting);
	$ctsop_scrollheight = @$ctsop_height_display_length[0];
	$ctsop_sametimedisplay = @$ctsop_height_display_length[1];
	$ctsop_textlength = @$ctsop_height_display_length[2];
	
	if(!is_numeric(@$ctsop_textlength)){ @$ctsop_textlength = 250; }
	if(!is_numeric(@$ctsop_sametimedisplay)){ @$ctsop_sametimedisplay = 2; }
	if(!is_numeric(@$ctsop_scrollheight)){ @$ctsop_scrollheight = 150; }
	
	$sSql = "select ctsop_id,ctsop_title,ctsop_text,ctsop_link from ".WP_ctsop_TABLE." where 1=1 and ctsop_status='YES'";
	if(@$ctsop_group == "ALL" ) 
	{ 
		// display all
	}
	elseif(@$ctsop_group != "" ) 
	{ 
		$sSql = $sSql . " and ctsop_group='".$ctsop_group."'"; 
	}
	//if($IR_random == "YES"){ $sSql = $sSql . " ORDER BY RAND()"; }else{ $sSql = $sSql . " ORDER BY IR_order"; }
	$sSql = $sSql . " ORDER BY ctsop_order";
	
	$ctsop_data = $wpdb->get_results($sSql);

	if ( ! empty($ctsop_data) ) 
	{
		$ctsop_count = 0;
		$ctsop_html = "";
		$IRjsjs = "";
		$ctsop_x = "";
		foreach ( $ctsop_data as $ctsop_data ) 
		{
			//$IR_path = mysql_real_escape_string(trim($ctsop_data->IR_path));
			$ctsop_link = mysql_real_escape_string(trim($ctsop_data->ctsop_link));
			$ctsop_target = "_blank";
			$ctsop_title = mysql_real_escape_string(trim($ctsop_data->ctsop_title));
			$ctsop_text = trim($ctsop_data->ctsop_text);
			
			if(is_numeric($ctsop_textlength))
			{
				if($ctsop_textlength <> "" && $ctsop_textlength > 0 )
				{
					$ctsop_text = substr($ctsop_text, 0, $ctsop_textlength);
				}
			}
			
			$ctsop_scrollheights = $ctsop_scrollheight."px";	
			
			$ctsop_html = $ctsop_html . "<div class='ctsop_div' style='height:".$ctsop_scrollheights.";padding:1px 0px 1px 0px;'>"; 
			
			//if($IR_path <> "" )
//			{
//				$ctsop_html = $ctsop_html . "<div class='IR-regimage'>"; 
//				$IRjsjs = "<div class=\'IR-regimage\'>"; 
//				if($ctsop_link <> "" ) 
//				{ 
//					$ctsop_html = $ctsop_html . "<a href='$ctsop_link'>"; 
//					$IRjsjs = $IRjsjs . "<a href=\'$ctsop_link\'>";
//				} 
//				$ctsop_html = $ctsop_html . "<img src='$IR_path' al='Test' />"; 
//				$IRjsjs = $IRjsjs . "<img src=\'$IR_path\' al=\'Test\' />";
//				if($ctsop_link <> "" ) 
//				{ 
//					$ctsop_html = $ctsop_html . "</a>"; 
//					$IRjsjs = $IRjsjs . "</a>";
//				}
//				$ctsop_html = $ctsop_html . "</div>";
//				$IRjsjs = $IRjsjs . "</div>";
//			}
			
			if($ctsop_title <> "" )
			{
				$ctsop_html = $ctsop_html . "<div style='padding-left:4px;'><strong>";	
				$IRjsjs = $IRjsjs . "<div style=\'padding-left:4px;\'><strong>";				
				if($ctsop_link <> "" ) 
				{ 
					$ctsop_html = $ctsop_html . "<a href='$ctsop_link'>"; 
					$IRjsjs = $IRjsjs . "<a href=\'$ctsop_link\'>";
				} 
				$ctsop_html = $ctsop_html . $ctsop_title;
				$IRjsjs = $IRjsjs . $ctsop_title;
				if($ctsop_link <> "" ) 
				{ 
					$ctsop_html = $ctsop_html . "</a>"; 
					$IRjsjs = $IRjsjs . "</a>";
				}
				$ctsop_html = $ctsop_html . "</strong></div>";
				$IRjsjs = $IRjsjs . "</strong></div>";
			}
			
			if($ctsop_text <> "" )
			{
				$ctsop_html = $ctsop_html . "<div style='padding-left:4px;'>$ctsop_text</div>";	
				$IRjsjs = $IRjsjs . "<div style=\'padding-left:4px;\'>$ctsop_text</div>";	
			}
			
			$ctsop_html = $ctsop_html . "</div>";
			
			
			$ctsop_x = $ctsop_x . "ctsop[$ctsop_count] = '<div class=\'ctsop_div\' style=\'height:".$ctsop_scrollheights.";padding:1px 0px 1px 0px;\'>$IRjsjs</div>'; ";	
			$ctsop_count++;
			$IRjsjs = "";
		}
		
		$ctsop_scrollheight = $ctsop_scrollheight + 4;
		if($ctsop_count >= $ctsop_sametimedisplay)
		{
			$ctsop_count = $ctsop_sametimedisplay;
			$ctsop_scrollheight_New = ($ctsop_scrollheight * $ctsop_sametimedisplay);
		}
		else
		{
			$ctsop_count = $ctsop_count;
			$ctsop_scrollheight_New = ($ctsop_count  * $ctsop_scrollheight);
		}
	}
	
	$ctsop = "";
	$ctsop = $ctsop . '<div style="padding-top:8px;padding-bottom:8px;">';
	$ctsop = $ctsop . '<div style="text-align:left;vertical-align:middle;text-decoration: none;overflow: hidden; position: relative; margin-left: 3px; height: '. @$ctsop_scrollheight .'px;" id="IRHolder">'.@$ctsop_html.'</div>';
	$ctsop = $ctsop . '</div>';
	$ctsop = $ctsop . '<script type="text/javascript">';
	$ctsop = $ctsop . 'var ctsop = new Array();';
	$ctsop = $ctsop . "var objctsop	= '';";
	$ctsop = $ctsop . "var ctsop_scrollPos 	= '';";
	$ctsop = $ctsop . "var ctsop_numScrolls	= '';";
	$ctsop = $ctsop . 'var ctsop_heightOfElm = '. @$ctsop_scrollheight. ';';
	$ctsop = $ctsop . 'var ctsop_numberOfElm = '. @$ctsop_count. ';';
	$ctsop = $ctsop . "var ctsop_scrollOn 	= 'true';";
	$ctsop = $ctsop . 'function ctsopScroll() ';
	$ctsop = $ctsop . '{';
	$ctsop = $ctsop . @$ctsop_x;
	$ctsop = $ctsop . "objctsop	= document.getElementById('IRHolder');";
	$ctsop = $ctsop . "objctsop.style.height = (ctsop_numberOfElm * ctsop_heightOfElm) + 'px';";
	$ctsop = $ctsop . 'ctsopContent();';
	$ctsop = $ctsop . '}';
	$ctsop = $ctsop . '</script>';
	$ctsop = $ctsop . '<script type="text/javascript">';
	$ctsop = $ctsop . 'ctsopScroll();';
	$ctsop = $ctsop . '</script>';
	
	return $ctsop;
		
	
}

function ctsop_add_to_menu() 
{
	add_options_page('Content text slider on post', 'Content text slider on post', 'manage_options', __FILE__, 'ctsop_admin_options' );
	add_options_page('Content text slider on post', '', 'manage_options', "content-text-slider-on-post/content-management.php",'' );
}

if (is_admin()) 
{
	add_action('admin_menu', 'ctsop_add_to_menu');
}

function ctsop_deactivation() 
{

}

register_activation_hook(__FILE__, 'ctsop_install');
register_deactivation_hook(__FILE__, 'ctsop_deactivation');
add_action('admin_menu', 'ctsop_add_to_menu');


?>
