<?php
/*-------------------------------------------------------------
*   Function to check the version
*------------------------------------------------------------*/
function framework_version_check() {
	$option = get_option( SHORTNAME . '-version' );
	
	$new_version = false;

	$server_version = file_get_contents('http://www.flarethemes.com/api/index.php?mod=license&task=get_license_info&php=y&api_key=' . THEMENAME);
	$server_version = @unserialize($server_version);

	if( $server_version !== false )
		if( $server_version['version_decimal'] != '')
			if( THEMEVERSION < $server_version['version_decimal'] ) $new_version = true;

	if( $new_version ) update_option( SHORTNAME . '-version', array('new' => 'true', 'version' => THEMEVERSION, 'new_version' => $server_version['version_formatted'], 'new_version_details' => $server_version['release_url'], 'lastcheck' => current_time( 'timestamp' ) ) );
		else update_option( SHORTNAME . '-version', array('new' => 'false', 'version' => THEMEVERSION, 'lastcheck' => current_time( 'timestamp' ) ) );

	return false;
}

/*-------------------------------------------------------------
*   Function to run cronjob twice a day
*------------------------------------------------------------*/
function framework_version_cron() {
	$option = get_option( SHORTNAME . '-version' );
	
	if( !$option ) update_option( SHORTNAME . '-version', array('new' => 'false', 'version' => THEMEVERSION, 'lastcheck' => current_time( 'timestamp' ) ) );

	$current_time = current_time( 'timestamp' );
	
	if( $option['lastcheck'] <= ($current_time - 43200) )
		framework_version_check();

	if( $option['version'] != THEMEVERSION )
		framework_version_check();
}

/*-------------------------------------------------------------
*   Run the version checker
*------------------------------------------------------------*/
function framework_version_run() {
	//Run the cron
	framework_version_cron();

	$option = get_option( SHORTNAME . '-version' );
	
	if( $option['new'] == 'false' )
		define('FRAMEWORK_HAS_UPDATE', false);
	else
		define('FRAMEWORK_HAS_UPDATE', true);
}
framework_version_run();
?>