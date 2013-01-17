<?php
/*-------------------------------------------------------------
*   Function to return theme option
*------------------------------------------------------------*/
function framework_get_option( $option = null ) {
	$db_options = get_option(SHORTNAME_SETTINGS);

	if( isset($db_options) ) {
		if( isset($option) && isset($db_options[$option]) ) return $db_options[$option];
	}

	return false;
}

/*-------------------------------------------------------------
*   Function to return default theme option
*------------------------------------------------------------*/
function framework_get_default( $default = null ) {
	global $panel_options;
	
	foreach( $panel_options as $tab ) :
	foreach( $tab['options'] as $option) :
		if( isset($option['id']) )
			if( $option['id'] == $default)
				return $option['default'];
	endforeach;
	endforeach;
	
	return false;
}

/*-------------------------------------------------------------
*   Function to return template order
*------------------------------------------------------------*/
function framework_get_template( $template = null ) {
	$db_template = get_option(SHORTNAME_TEMPLATE);

	if($db_template) {
		if($template) return $db_template[$template];
		else return $db_template;
	}

	return false;
}

/*-------------------------------------------------------------
*   Function to return layout type
*------------------------------------------------------------*/
function framework_get_layout( $layout = null ) {
	$db_options = get_option(SHORTNAME_SETTINGS);

	$get_layout = get_body_class();
	$get_layout = isset($get_layout[0]) ? $get_layout[0] : '';

	if( isset($layout) ) $get_layout = $layout;
	if( $get_layout == "blog" ) $get_layout = "home";

	if( is_page() || is_single() ) {
		$postmeta = get_post_custom(get_the_ID());
		if( isset($postmeta['fplayout']) && ($postmeta['fplayout'][0] != "default") && ($postmeta['fplayout'][0] != "") ) return $postmeta['fplayout'][0];
	}

	if($db_options && $get_layout) {
		if( isset($db_options['layout'][$get_layout]) ) return $db_options['layout'][$get_layout];
		elseif($db_options['layout']['defaultp']) return $db_options['layout']['defaultp'];
	}

	return false;
}

/*-------------------------------------------------------------
*   Function to get sections
*------------------------------------------------------------*/
function framework_get_section_base($section = null) {
	if( !$section ) return false;

	if ( file_exists( TEMPLATEPATH . '/sections/' . $section . '/' . $section . '.php' ) ) {
		include ( TEMPLATEPATH . '/sections/' . $section . '/' . $section . '.php' );
	}
}

function framework_get_section($section_base = null, $section = null) {
	if( !$section_base ) return false;
	if( !$section ) return false;

	if ( file_exists( TEMPLATEPATH . '/sections/' . $section_base . '/' . $section . '.php' ) ) {
		include ( TEMPLATEPATH . '/sections/' . $section_base . '/' . $section . '.php' );
	}
}

/*-------------------------------------------------------------
*   Function to return page type
*------------------------------------------------------------*/
function framework_get_page_type() {
	$page_type = get_body_class();
	$page_type = $page_type[0];

	if($page_type) return $page_type;

	return false;
}

/*-------------------------------------------------------------
*   Function to check if a string is in the array
*------------------------------------------------------------*/
function framework_find_in($haystack, $needle) {
	if (is_array($needle)) {
		foreach ($needle as $need) {
			if (strpos($haystack, $need) !== false) return true;
		}
	} else {
		if (strpos($haystack, $need) !== false) return true;
	}

	return false;
}

/*-------------------------------------------------------------
*   Function to add a link in admin bar
*------------------------------------------------------------*/
function framework_admin_bar_menu() {
	global $wp_admin_bar, $shortname, $panel_options;
	if ( !is_super_admin() || !is_admin_bar_showing() )
		return;

	$wp_admin_bar->add_menu( array(
		'id' => $shortname,
		'title' => THEMENAME . ' Settings',
		'href' => admin_url('admin.php?page=framework.php') 
	));

	foreach( $panel_options as $nav ) :
		if( ($nav['type'] != 'feedback') && ($nav['type'] != 'affiliate') )
			$wp_admin_bar->add_menu( array(
				'id' => $shortname.'-'.$nav['id'],
				'parent' => $shortname,
				'title' => $nav['name'],
				'href' => admin_url('admin.php?page=framework.php&tab=' . $nav['id']) 
			));
	endforeach;
}
add_action('admin_bar_menu', 'framework_admin_bar_menu', 999);
?>