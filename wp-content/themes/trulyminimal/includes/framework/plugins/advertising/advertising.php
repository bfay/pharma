<?php
/*-------------------------------------------------------------
*   Function to add javascript in admin_head
*------------------------------------------------------------*/
function framework_ads_add_scripts_admin() {
	if( isset($_GET['page']) ) :
		if( ($_GET['page'] == "advertising-manage") || ($_GET['page'] == "advertising-zones") ) :

			wp_deregister_script('swfobject');

			wp_enqueue_style('framework-style.css', FRAMEWORK_DIR_CSS . 'style.css');

			wp_enqueue_script('jquery-swfobject', FRAMEWORK_DIR_JS . 'jquery.swfobject.js', array('jquery'));
			wp_enqueue_script('jquery-uploadify', FRAMEWORK_DIR_JS . 'jquery.uploadify.js', array('jquery'));

			wp_enqueue_script('jquery-swfobject');
			wp_enqueue_script('jquery-uploadify');
		endif;
	endif;
}
add_action( 'admin_enqueue_scripts', 'framework_ads_add_scripts_admin');

/*--------------------------
*   Check if admin page
*-------------------------*/
if(is_admin()) :
	/*-------------------------------------------------------------
	*   Include functions
	*------------------------------------------------------------*/
	require_once ( 'advertising.functions.php' );

	/*-------------------------------------------------------------
	*   Function to build admin menus
	*------------------------------------------------------------*/
	function framework_advertising_add_admin_menu() {
		add_menu_page('Advertising', 'Advertising', 'administrator', 'advertising-manage', 'framework_advertising_manage', '' , 52);
		add_submenu_page('advertising-manage' , 'Manage Ads', 'Manage Ads', 'administrator', 'advertising-manage', 'framework_advertising_manage');
		add_submenu_page('advertising-manage' , 'Manage Zones', 'Manage Zones', 'administrator', 'advertising-zones', 'framework_advertising_zones');
	}
	add_action('admin_menu', 'framework_advertising_add_admin_menu');

	/*-------------------------------------------------------------
	*   Include manage and zones
	*------------------------------------------------------------*/
	require_once ( 'advertising.manage.php' );
	require_once ( 'advertising.zones.php' );
endif;

/*-------------------------------------------------------------
*   Include widget, external functions and install file
*------------------------------------------------------------*/
require_once ( 'advertising.extern.functions.php' );
require_once ( 'advertising.install.php' );
require_once ( 'advertising.widget.php' );
?>
