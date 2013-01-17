<?php
if( isset($_POST['ads_action_submit'])) add_action('init', 'framework_ads_action_submit');
if( isset($_POST['ads_add_submit'])) add_action('init', 'framework_ads_add_submit');
if( isset($_POST['ads_edit_submit'])) add_action('init', 'framework_ads_edit_submit');

if( isset($_POST['zones_action_submit'])) add_action('init', 'framework_zones_action_submit');
if( isset($_POST['zones_add_submit'])) add_action('init', 'framework_zones_add_submit');
if( isset($_POST['zones_edit_submit'])) add_action('init', 'framework_zones_edit_submit');

if( isset($_GET['page']) && ($_GET['page'] =="advertising-manage") && isset($_GET['view']) && ($_GET['view'] =="delete")) add_action('init', 'framework_ad_delete_submit');
if( isset($_GET['page']) && ($_GET['page'] =="advertising-zones") && isset($_GET['view']) && ($_GET['view'] =="delete")) add_action('init', 'framework_zone_delete_submit');

function framework_ads_action_submit() {
	global $wpdb;

	if(isset($_POST['adcheck'])) $ads_ids = $_POST['adcheck'];

	$action = $_POST['ads_action'];
	list($action, $time) = explode("-", $action);	

	if($ads_ids != '') {
		foreach($ads_ids as $ad_id) {
			if($action == 'deactivate') framework_ad_deactivate($ad_id);
			if($action == 'activate') framework_ad_activate($ad_id);
			if($action == 'delete') framework_ad_delete($ad_id);
			if($action == 'renew') framework_ad_renew($ad_id, $time);
		}
	}
	
	wp_redirect( admin_url().'admin.php?page='.$_GET['page'].'&saved=true' );
}

/*-------------------------------------------------------------
*   Call function to add new ad
*------------------------------------------------------------*/
function framework_ads_add_submit() {
	framework_ad_new($_POST);
	wp_redirect( admin_url().'admin.php?page='.$_GET['page'].'&saved=true' );
}

/*-------------------------------------------------------------
*   Call function to update ad
*------------------------------------------------------------*/
function framework_ads_edit_submit() {
	$edit = array();
	$edit['ad_title'] = strip_tags(htmlspecialchars(trim($_POST['ad_title'], "\t\n "), ENT_QUOTES));
	$edit['ad_code'] = $_POST['ad_image'] != "" ? $_POST['ad_image'] : htmlspecialchars(trim($_POST['ad_code'], "\t\n "), ENT_QUOTES);
	$edit['ad_startshow'] = gmmktime(date("H"), date("i"), 0, $_POST['ad_startmonth'], $_POST['ad_startday'], $_POST['ad_startyear']);
	$edit['ad_endshow'] = gmmktime(date("H"), date("i"), 0, $_POST['ad_endmonth'], $_POST['ad_endday'], $_POST['ad_endyear']);
	$edit['ad_link'] = strip_tags(htmlspecialchars(trim($_POST['ad_link'], "\t\n "), ENT_QUOTES));
	$edit['ad_maxclicks'] = $_POST['ad_maxclicks'];
	$edit['ad_maxviews'] = $_POST['ad_maxviews'];
	$edit['ad_type'] = $_POST['ad_image'] != "" ? 'image' : 'html';
	$edit['ad_active'] = $_POST['ad_active'];
	$edit['ad_zone'] = $_POST['ad_zone'];

	$id = $_POST['ad_id'];

	framework_ad_update($edit, $id);

	wp_redirect( admin_url().'admin.php?page='.$_GET['page'].'&saved=true' );
}

/*-------------------------------------------------------------
*   Call function to delete ad
*------------------------------------------------------------*/
function framework_ad_delete_submit() {
	if( ($_GET['view'] == "delete") && isset($_GET['ad']) ) {
		framework_ad_delete($_GET['ad']);
	}

	wp_redirect( admin_url().'admin.php?page='.$_GET['page'].'&saved=true' );
}

function framework_zones_action_submit() {
	global $wpdb;

	if(isset($_POST['zonecheck'])) $zones_key = $_POST['zonecheck'];

	$action = $_POST['zones_action'];	

	if($zones_key != '') {
		foreach($zones_key as $zone_key) {
			if($action == 'delete') framework_zone_delete($zone_key);
		}
	}
	
	wp_redirect( admin_url().'admin.php?page='.$_GET['page'].'&saved=true' );
}

/*-------------------------------------------------------------
*   Call function to add new zone
*------------------------------------------------------------*/
function framework_zones_add_submit() {
	global $wpdb;

	$new_zone_key = strtolower(str_replace(" ","-",$_POST['zone_name']));

	$czone = $wpdb->get_var("SELECT COUNT(*) FROM `".$wpdb->prefix."frameworkads_zones` WHERE `zone_key` = '$new_zone_key' LIMIT 1;");

	if($czone < 1) {
		framework_zone_new($_POST);
		wp_redirect( admin_url().'admin.php?page='.$_GET['page'].'&saved=true' );
	} else {
		wp_redirect( admin_url().'admin.php?page='.$_GET['page'].'&error=This+zone+already+exist' );
	}

}

/*-------------------------------------------------------------
*   Call function to update zone
*------------------------------------------------------------*/
function framework_zones_edit_submit() {
	$edit = array();
	$edit['zone_name'] = strip_tags(htmlspecialchars(trim($_POST['zone_name'], "\t\n "), ENT_QUOTES));
	$edit['zone_description'] = htmlspecialchars(trim($_POST['zone_description'], "\t\n "), ENT_QUOTES);
	$edit['zone_maxads'] = intval($_POST['zone_maxads']);
	$edit['zone_mode'] = $_POST['zone_mode'];
	$edit['zone_format'] = $_POST['zone_format'];

	$key = $_POST['zone_key'];

	framework_zone_update($edit, $key);

	wp_redirect( admin_url().'admin.php?page='.$_GET['page'].'&saved=true' );
}

/*-------------------------------------------------------------
*   Call function to delete zone
*------------------------------------------------------------*/
function framework_zone_delete_submit() {
	if( ($_GET['view'] == "delete") && isset($_GET['zone']) ) {
		framework_zone_delete($_GET['zone']);
	}

	wp_redirect( admin_url().'admin.php?page='.$_GET['page'].'&saved=true' );
}

/*-------------------------------------------------------------
*   Function to check if ad is active
*------------------------------------------------------------*/
function framework_ad_active($id) {
	global $wpdb;

	$ad = $wpdb->get_results("SELECT ad_active FROM `".$wpdb->prefix."frameworkads` WHERE `ad_id` = '$id'");
	if($ad) {
		$ad_active = $ad[0]->ad_active == "yes" ? true : false;
	} else {
		$ad_active = false;
	}

	return $ad_active;
}

/*-------------------------------------------------------------
*   Function to activate ad
*------------------------------------------------------------*/
function framework_ad_activate($id) {
	global $wpdb;

	$ad = $wpdb->get_results("SELECT ad_active FROM `".$wpdb->prefix."frameworkads` WHERE `ad_id` = '$id'");
	if($ad) {
		$wpdb->query("UPDATE `".$wpdb->prefix."frameworkads` SET `ad_active` = 'yes' WHERE `ad_id` = '$id'");
	}
}

/*-------------------------------------------------------------
*   Function to dezactivate ad
*------------------------------------------------------------*/
function framework_ad_deactivate($id) {
	global $wpdb;

	$ad = $wpdb->get_results("SELECT ad_active FROM `".$wpdb->prefix."frameworkads` WHERE `ad_id` = '$id'");
	if($ad) {
		$wpdb->query("UPDATE `".$wpdb->prefix."frameworkads` SET `ad_active` = 'no' WHERE `ad_id` = '$id'");
	}
}

/*-------------------------------------------------------------
*   Function to delete ad
*------------------------------------------------------------*/
function framework_ad_delete($id) {
	global $wpdb;

	$ad = $wpdb->get_results("SELECT ad_id,ad_code,ad_type FROM `".$wpdb->prefix."frameworkads` WHERE `ad_id` = '$id'");
	if($ad) {
		$wpdb->query("DELETE FROM `".$wpdb->prefix."frameworkads` WHERE `ad_id` = '$id'");

		if($ad[0]->ad_type == "image") unlink("..".$ad[0]->ad_code);
	}
}

/*-------------------------------------------------------------
*   Function to renew ad
*------------------------------------------------------------*/
function framework_ad_renew($id, $time = 1) {
	global $wpdb;

	$ad = $wpdb->get_results("SELECT ad_endshow FROM `".$wpdb->prefix."frameworkads` WHERE `ad_id` = '$id'");
	if($ad) {
		$new_endshow = $ad[0]->ad_endshow + $time;
		$wpdb->query("UPDATE `".$wpdb->prefix."frameworkads` SET `ad_endshow` = '$new_endshow' WHERE `ad_id` = '$id'");

	}
}

/*-------------------------------------------------------------
*   Function to add new ad
*------------------------------------------------------------*/
function framework_ad_new($args) {
	global $wpdb;

	$add = array();
	$add['ad_id'] = NULL;
	$add['ad_title'] = strip_tags(htmlspecialchars(trim($args[ad_title], "\t\n "), ENT_QUOTES));
	$add['ad_code'] = $args[ad_image] != "" ? $args[ad_image] : htmlspecialchars(trim($args[ad_code], "\t\n "), ENT_QUOTES);
	$add['ad_startshow'] = gmmktime(date("H"), date("i"), 0, $args[ad_startmonth], $args[ad_startday], $args[ad_startyear]);
	$add['ad_endshow'] = gmmktime(date("H"), date("i"), 0, $args[ad_endmonth], $args[ad_endday], $args[ad_endyear]);
	$add['ad_link'] = strip_tags(htmlspecialchars(trim($args[ad_link], "\t\n "), ENT_QUOTES));
	$add['ad_views'] = 0;
	$add['ad_clicks'] = 0;
	$add['ad_maxclicks'] = $args[ad_maxclicks];
	$add['ad_maxviews'] = $args[ad_maxviews];
	$add['ad_type'] = $args[ad_image] != "" ? 'image' : 'html';
	$add['ad_active'] = $args[ad_active];
	$add['ad_zone'] = $args[ad_zone];

	foreach ($add as $field=>$value) {
		$fields[] = '`' . $field . '`';
		$values[] = "'" . mysql_real_escape_string($value) . "'";
	}

	$field_list = join(',', $fields);
	$value_list = join(', ', $values);

	$wpdb->query("INSERT INTO `".$wpdb->prefix."frameworkads` (" . $field_list . ") VALUES (" . $value_list . ")"); 
}

/*-------------------------------------------------------------
*   Function to update ad
*------------------------------------------------------------*/
function framework_ad_update($args, $id) {
	global $wpdb;

	$fields = array();

	foreach ($args as $field=>$value) {
		$fields[] = sprintf("`%s` = '%s'", $field, mysql_real_escape_string($value));
	}

	$field_list = join(',', $fields);
	
	$query = sprintf("UPDATE `".$wpdb->prefix."frameworkads` SET %s WHERE `ad_id` = %s", $field_list, intval($id));

	$wpdb->query($query); 
}

/*-------------------------------------------------------------
*   Function to return ad zone name
*------------------------------------------------------------*/
function framework_ad_get_zone_name($id) {
	global $wpdb;

	$ad = $wpdb->get_results("SELECT ad_zone FROM `".$wpdb->prefix."frameworkads` WHERE `ad_id` = '$id'");

	if($ad[0]->ad_zone != "") {
		$zone_key = $ad[0]->ad_zone;
		$zone = $wpdb->get_results("SELECT * FROM `".$wpdb->prefix."frameworkads_zones` WHERE `zone_key` = '$zone_key'");

		if($zone) return $zone[0]->zone_name . '<br />' . $zone[0]->zone_format;
	}

	return 'No zone';
}

/*-------------------------------------------------------------
*   Function to delete zone
*------------------------------------------------------------*/
function framework_zone_delete($key) {
	global $wpdb;

	$zone = $wpdb->get_results("SELECT zone_key FROM `".$wpdb->prefix."frameworkads_zones` WHERE `zone_key` = '$key'");
	if($zone) {
		$wpdb->query("DELETE FROM `".$wpdb->prefix."frameworkads_zones` WHERE `zone_key` = '$key'");
	}
}

/*-------------------------------------------------------------
*   Function to add new zone
*------------------------------------------------------------*/
function framework_zone_new($args) {
	global $wpdb;

	$czone = $wpdb->get_var("SELECT COUNT(*) FROM `".$wpdb->prefix."frameworkads_zones` WHERE `zone_key` = '$args[zone_key]' LIMIT 1;");

	if($czone < 1) {
		$add = array();
		$add['zone_name'] = strip_tags(htmlspecialchars(trim($args[zone_name], "\t\n "), ENT_QUOTES));
		$add['zone_key'] = strtolower(str_replace(" ","-",$add[zone_name]));
		$add['zone_description'] = htmlspecialchars(trim($args[zone_description], "\t\n "), ENT_QUOTES);
		$add['zone_maxads'] = $args[zone_maxads];
		$add['zone_mode'] = $args[zone_mode];
		$add['zone_format'] = $args[zone_format];

		foreach ($add as $field=>$value) {
			$fields[] = '`' . $field . '`';
			$values[] = "'" . mysql_real_escape_string($value) . "'";
		}

		$field_list = join(',', $fields);
		$value_list = join(', ', $values);

		$wpdb->query("INSERT INTO `".$wpdb->prefix."frameworkads_zones` (" . $field_list . ") VALUES (" . $value_list . ")"); 
	}
}

/*-------------------------------------------------------------
*   Function to update zone
*------------------------------------------------------------*/
function framework_zone_update($args, $key) {
	global $wpdb;

	$fields = array();

	foreach ($args as $field=>$value) {
		$fields[] = sprintf("`%s` = '%s'", $field, mysql_real_escape_string($value));
	}

	$field_list = join(',', $fields);
	
	$query = sprintf("UPDATE `".$wpdb->prefix."frameworkads_zones` SET %s WHERE `zone_key` = '%s'", $field_list, $key);

	$wpdb->query($query); 
}
?>