<?php
/*-------------------------------------------------------------
*   Include settings files
*------------------------------------------------------------*/
require_once ($incPath . '/framework/framework.init.php');

require_once ($incPath . '/settings.menus.php');

require_once ($incPath . '/settings.pagination.php');

require_once ($incPath . '/settings.scripts.php');

require_once ($incPath . '/settings.sidebars.php');

require_once ($incPath . '/settings.thumbnails.php');

require_once ($incPath . '/settings.plugins.php');

require_once ($incPath . '/settings.widgets.php');

require_once ($incPath . '/settings.shortcodes.php');

require_once ($incPath . '/class.required_plugins.php');


/*-------------------------------------------------------------
*   Include Scripts
*------------------------------------------------------------*/
require_once ($incPath . '/script.fancybox.php');

require_once ($incPath . '/script.imagefit.php');

require_once ($incPath . '/script.youtubefit.php');

require_once ($incPath . '/script.focusform.php');


/*-------------------------------------------------------------
*   Check Minimum Requirements
*------------------------------------------------------------*/
function themef_check_minimum_requirements() {
	//Check WP Version
	if (version_compare( get_bloginfo('version') , '3.0', '<')) {
		wp_die( 'You must have at least version 3.0 for WordPress.<br />Your WordPress version is ' .get_bloginfo('version') );
	}

	//Check PHP Version
	if (version_compare(PHP_VERSION, '5.0.0', '<')) {
		wp_die( 'You must have at least version 5.0.0 for PHP.<br />Your PHP version is ' . PHP_VERSION );
	}
}
add_action( 'get_header', 'themef_check_minimum_requirements');


/*-------------------------------------------------------------
*   Setup languages
*------------------------------------------------------------*/
load_theme_textdomain('trulyminimal' , get_template_directory() . '/languages');


/*-------------------------------------------------------------
*   Set content width
*------------------------------------------------------------*/
if ( ! isset( $content_width ) ) $content_width = 955;


/*-------------------------------------------------------------
*   Add automatic feed links
*------------------------------------------------------------*/
add_theme_support( 'automatic-feed-links' );


/*-------------------------------------------------------------
*   Function to limit the characters from a string
*------------------------------------------------------------*/
function themef_limit_characters($content, $limit = 50, $p = false) {
	$thiscontent = strip_tags( $content );
	$content_length = strlen($thiscontent);
	
	if($content_length <= $limit) {
		$thisexcerpt = $thiscontent;
	} else {
		$thisexcerpt = $thiscontent . ' ';
		$thisexcerpt = substr($thisexcerpt, 0, $limit);
		$thisexcerpt = substr($thisexcerpt, 0, strrpos($thisexcerpt, ' '));
		$thisexcerpt .= ' ... ';
	}

	if( !$p )
		return $thisexcerpt;
	else
		return '<p>' . $thisexcerpt . '</p>';
}


/*-------------------------------------------------------------
*   Set wp_title
*------------------------------------------------------------*/
function themef_wp_title( $title ) {
	global $paged;

	//Add page title
	$site_name = $title;

	//Add blogname
	$site_name .= get_bloginfo('name');

	//Add page number
	if( isset($paged) && ($paged >= 2) )
		$site_name .= ' | ' . sprintf( __( 'Page %s', 'trulyminimal' ), $paged );

	return $site_name;
}
add_filter( 'wp_title', 'themef_wp_title' );


/*-------------------------------------------------------------
*   The Excerpt settings
*------------------------------------------------------------*/
function themef_new_excerpt_length($length) {
	return 75;
}

function themef_new_excerpt_more($more) {
       global $post;
	return ' ...';
}

add_filter('excerpt_more', 'themef_new_excerpt_more');
add_filter('excerpt_length', 'themef_new_excerpt_length');


/*-------------------------------------------------------------
*   Comments number
*------------------------------------------------------------*/
function themef_comment_count( $count ) {
	if ( !is_admin() ) :
		global $id;
		$comments_by_type = &separate_comments(get_comments('status=approve&post_id=' . $id));
		return count($comments_by_type['comment']);
	else :
		return $count;
	endif;
}
add_filter('get_comments_number', 'themef_comment_count', 0);


function themef_get_pings_number() {
	global $id;

	$comments_by_type = &separate_comments(get_comments('status=approve&post_id=' . $id));

	return count($comments_by_type['pings']);
}


/*-------------------------------------------------------------
*   A bug in wordpress
*------------------------------------------------------------*/
function themef_valid_search_form ($form) {
	return str_replace('role="search" ', '', $form);
}
add_filter('get_search_form', 'themef_valid_search_form');


/*-------------------------------------------------------------
*   A bug in wordpress
*------------------------------------------------------------*/
function themef_img_caption( $empty_string, $attributes, $content ) {
	extract(shortcode_atts(array(
		'id' => '',
		'align' => 'alignnone',
		'width' => '',
		'caption' => ''
	), $attributes));

	if ( empty($caption) )
		return $content;
	
	if ( $id ) $id = 'id="' . esc_attr($id) . '" ';
	return '<div ' . $id . 'style="width:' . $width . 'px;" class="wp-caption ' . esc_attr($align) . '">' . do_shortcode( $content ) . '<span class="wp-caption-text">' . $caption . '</span></div>';
}
add_filter( 'img_caption_shortcode', 'themef_img_caption', 10, 3 );


/*-------------------------------------------------------------
*   Change Protected Post Form
*------------------------------------------------------------*/
function themef_custom_password_form() {
	global $post;
	$label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
	$o = '<form class="protected-post-form" action="' . get_option('siteurl') . '/wp-pass.php" method="post">
		<p>' . __( "This post is password protected. To view it please enter your password below:", 'trulyminimal' ) . '</p>
		<label for="' . $label . '">' . __( "Password:", 'trulyminimal' ) . ' </label>
		<input name="post_password" id="' . $label . '" type="password" size="20" />
		<input type="submit" name="Submit" value="' . esc_attr__( "&nbsp;&nbsp;submit &rarr;", 'trulyminimal' ) . '" />
	</form>
	';
	return $o;
}
add_filter( 'the_password_form', 'themef_custom_password_form' );


/*-------------------------------------------------------------
*   Required Plugins
*------------------------------------------------------------*/
function themef_required_plugins() {
	$plugins = array(
		array(
			'name' 		=> 'Regenerate Thumbnails',
			'slug' 		=> 'regenerate-thumbnails',
			'required' 	=> false,
		),

		array(
			'name' 		=> 'Easy Theme and Plugin Upgrades',
			'slug' 		=> 'easy-theme-and-plugin-upgrades',
			'required' 	=> false,
		),
	);

	$config = array(
		'domain'       		=> 'tgmpa',         	// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
		'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
		'is_automatic'    	=> false,					   	// Automatically activate plugins after installation or not
		'message' 			=> '',							// Message to output right before the plugins table
		'strings'      		=> array(
			'page_title'                       			=> 'Install Required Plugins',
			'menu_title'                       			=> 'Install Plugins',
			'installing'                       			=> 'Installing Plugin: %s', // %1$s = plugin name
			'oops'                             			=> 'Something went wrong with the plugin API.',
			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_install'  				=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_activate' 				=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
			'notice_ask_to_update' 					=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_update' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
			'install_link' 					  	=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link' 				  	=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return'                           			=> 'Return to Required Plugins Installer',
			'plugin_activated'                 			=> 'Plugin activated successfully.',
			'complete' 						=> 'All plugins installed and activated successfully. %s', // %1$s = dashboard link
			'nag_type'						=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
	);
	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'themef_required_plugins' );
?>