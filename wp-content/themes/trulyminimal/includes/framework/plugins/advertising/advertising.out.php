<?php
/*-------------------------------------------------------------
*   File to call and increase clicks
*------------------------------------------------------------*/
include( '../../../../../../../wp-blog-header.php' );
global $wpdb;

if(isset($_GET['ad']) OR $_GET['ad'] > 0 OR $_GET['ad'] != '') {
	$id = $_GET['ad'];	

	$ip = $_SERVER["REMOTE_ADDR"];

	$now = date('U');
	$tomorrow = $now + 86400;

	$ad = $wpdb->get_row("SELECT ad_id FROM `".$wpdb->prefix."frameworkads` WHERE `ad_id` = '$id' LIMIT 1");

	if($ad) {
		$cip = $wpdb->get_var("SELECT COUNT(*) FROM `".$wpdb->prefix."frameworkads_clicks` WHERE `click_ip` = '$ip' AND `click_time` < '$tomorrow' AND `click_ad` = '$id' LIMIT 1;");

		if($cip < 1) {
			$wpdb->query("UPDATE `".$wpdb->prefix."frameworkads` SET `ad_clicks` = `ad_clicks` + 1 WHERE `ad_id` = '$id'");
			$wpdb->query("INSERT INTO `".$wpdb->prefix."frameworkads_clicks` (`click_ip`, `click_time`, `click_ad`) VALUES ('$ip', '$now', '$id')");
		}
	}
}
?>