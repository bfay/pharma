<?php
/*-------------------------------------------------------------
*   Add separator in admin menu
*------------------------------------------------------------*/
function add_menu_separator($position) {
	global $menu;
	$index = 0;
	foreach($menu as $offset => $section) {
		if (substr($section[2],0,9)=='separator')
			$index++;

		if ($offset>=$position) {
			$menu[$position] = array('','read',"separator{$index}",'','wp-menu-separator');
			break;
		}
	}
}

/*-------------------------------------------------------------
*   Build framework option interface
*------------------------------------------------------------*/
function framework_build_option_interface() {
	include ( FRAMEWORK_INC_LIBRARY . 'design.template.php' );
}

/*-------------------------------------------------------------
*   Build settings list
*------------------------------------------------------------*/
function framework_build_options_list($type, $tab_options) {
	if (file_exists( FRAMEWORK_INC_LIBRARY . 'library.' . $type . '.php' )) {
		include ( FRAMEWORK_INC_LIBRARY . 'library.' . $type . '.php' );
	}
}

/*-------------------------------------------------------------
*   AJAX Options
*------------------------------------------------------------*/
function framework_register_settings() {
	register_setting(SHORTNAME_SETTINGS, SHORTNAME_SETTINGS);
}
add_action('admin_init', 'framework_register_settings');

function framework_save_template() {
	$framework_template = get_option(SHORTNAME_TEMPLATE);

	$framework_section_order =  $_GET['order'];

	parse_str($framework_section_order);

	$framework_selected_template = esc_attr($_GET['template']);

	$framework_template[$framework_selected_template] = $section;

	update_option(SHORTNAME_TEMPLATE, $framework_template);

	return true;

	die();
}
add_action('wp_ajax_framework_save_template', 'framework_save_template');

/*-------------------------------------------------------------
*   Send Feedback
*------------------------------------------------------------*/
function framework_send_feedback() {
	if( isset($_POST['feedback_name']) && ($_POST['feedback_name'] != "") && ($_POST['feedback_email'] != "") && ($_POST['feedback_text'] != "") ) {
		$headers = 'From:  ' . $_POST['feedback_name'] . ' <' . $_POST['feedback_email'] . '>' . "\r\n";
		
		$message = $_POST['feedback_text'];
		$message .= '
		
		--  Site Info:  ---------------------
		   Theme Name: ' . THEMENAME . '
		   Site Url: ' . get_bloginfo('url') . '
		-------------------------------------';
		   
		wp_mail('feedback@flarethemes.com', THEMENAME . ' Feedback', $message, $headers);
	}
}
add_action('admin_init', 'framework_send_feedback');

/*-------------------------------------------------------------
*   Dismiss Notice
*------------------------------------------------------------*/
function framework_dismiss_notice() {
	if( isset($_GET['page']) && ($_GET['page'] == "framework.php") && isset($_GET['notice']) ) :
		if($_GET['notice'] == "show") :
			update_user_meta( get_current_user_id(), 'framework_dismissed_notice', 0 );
		else :
			update_user_meta( get_current_user_id(), 'framework_dismissed_notice', 1 );
		endif;

		wp_redirect( admin_url() . 'admin.php?page=' . $_GET['page'] );
	endif;
}
add_action('admin_init', 'framework_dismiss_notice');
?>