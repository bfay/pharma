<?php
/*-------------------------------------------------------------
*   Check if advertising plugin is already installed
*------------------------------------------------------------*/
if(!get_option('frameworkads_installed')) {
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

	$nextcheck = current_time('timestamp') + 18000;
	update_option( 'frameworkads_nextcheck', $nextcheck );

	/*-------------------------------------------------------------
	*   Create "frameworkads" table if not exist
	*------------------------------------------------------------*/
	if(!$wpdb->get_var("SHOW TABLES LIKE '".$wpdb->prefix."frameworkads'")) {
		$sql = "CREATE TABLE IF NOT EXISTS `".$wpdb->prefix."frameworkads` (
			`ad_id` int(20) unsigned NOT NULL AUTO_INCREMENT,
			`ad_title` longtext NOT NULL,
			`ad_code` longtext CHARACTER SET utf8 NOT NULL,
			`ad_startshow` int(15) NOT NULL DEFAULT '0',
			`ad_endshow` int(15) NOT NULL DEFAULT '0',
			`ad_link` longtext NOT NULL,
			`ad_views` int(15) NOT NULL DEFAULT '0',
			`ad_clicks` int(15) NOT NULL DEFAULT '0',
			`ad_maxclicks` int(15) NOT NULL DEFAULT '0',
			`ad_maxviews` int(15) NOT NULL DEFAULT '0',
			`ad_type` varchar(10) NOT NULL,
			`ad_active` varchar(5) NOT NULL DEFAULT 'yes',
			`ad_zone` varchar(255) NOT NULL,
			PRIMARY KEY (`ad_id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

		dbDelta($sql);
	}

	/*-------------------------------------------------------------
	*   Create "frameworkads_clicks" table if not exist
	*------------------------------------------------------------*/
	if(!$wpdb->get_var("SHOW TABLES LIKE '".$wpdb->prefix."frameworkads_clicks'")) {
		$sql = "CREATE TABLE IF NOT EXISTS `".$wpdb->prefix."frameworkads_clicks` (
			`click_id` int(20) NOT NULL AUTO_INCREMENT,
			`click_ip` varchar(255) NOT NULL,
			`click_time` int(15) NOT NULL,
			`click_ad` int(15) NOT NULL,
			PRIMARY KEY (`click_id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

		dbDelta($sql);
	}

	/*-------------------------------------------------------------
	*   Create "frameworkads_zones" table if not exist
	*------------------------------------------------------------*/
	if(!$wpdb->get_var("SHOW TABLES LIKE '".$wpdb->prefix."frameworkads_zones'")) {
		$sql = "CREATE TABLE IF NOT EXISTS `".$wpdb->prefix."frameworkads_zones` (
			`zone_key` varchar(255) NOT NULL,
			`zone_name` longtext NOT NULL,
			`zone_description` longtext NOT NULL,
			`zone_maxads` varchar(255) NOT NULL DEFAULT '1',
			`zone_mode` varchar(255) NOT NULL DEFAULT 'latest',
			`zone_format` varchar(255) NOT NULL,
			PRIMARY KEY (`zone_key`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8;";

		dbDelta($sql);
	}

	/*-------------------------------------------------------------
	*   Set installed plugin option to "true"
	*------------------------------------------------------------*/
	update_option( 'frameworkads_installed', 'true' );
}

/*-------------------------------------------------------------
*   Check if zones are created
*------------------------------------------------------------*/
if(!get_option(SHORTNAME . '_frameworkzones_installed')) {
	global $default_ads;

	/*-------------------------------------------------------------
	*   Add framework zones
	*------------------------------------------------------------*/
	if( !empty($default_ads) )
		frameworkads_register_zone($default_ads);

	/*-------------------------------------------------------------
	*   Set installed option to "true"
	*------------------------------------------------------------*/
	update_option( SHORTNAME . '_frameworkzones_installed', 'true' );
}
?>