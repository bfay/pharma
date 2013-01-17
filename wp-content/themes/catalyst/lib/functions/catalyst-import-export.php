<?php
/**
 * Handels all the Import/Export functionality in Catalyst
 * and the Dynamik Child Theme.
 *
 * @package Catalyst
 */
 
/**
 * Create a string that represnts the current date and time.
 *
 * @since 1.0
 * @return string that represnts the current date and time.
 */
function catalyst_time()
{
	$time = gmdate( 'Y-m-d H:i:s', ( time() + ( get_option( 'gmt_offset' ) * 3600 ) ) );
	return strtotime( $time );
}

/**
 * Create all the appropriate files and content that reflect the exported Child Theme
 * and then zip it up and spit it out into the browser for download.
 *
 * @since 1.0
 */
function catalyst_child_export( $child_name, $at_style = 'no', $author = 'Catalyst Theme', $author_uri = 'http://catalysttheme.com', $child_export_type = 'mysite' )
{
	global $blog_id, $catalyst_child_home;
	catalyst_child_folders_open_permissions();
	require_once( ABSPATH . 'wp-admin/includes/class-pclzip.php' );
	
	$child_export_zip = strtolower( $child_name ) . '.zip';
	$tmp_path = CHILD_ROOT . '/css/tmp';
	$tmp_child = $tmp_path . '/child';
	$tmp_image_folder = $tmp_child . '/images';
	$tmp_post_formats_image_folder = $tmp_child . '/images/post-formats';
	$child_google_fonts = catalyst_child_export_google_fonts();
	$catalyst_layout_id = '';
		
	$catalyst_multisite = false;
	if( $blog_id > 1 )
	{
		$catalyst_multisite = $blog_id;
	}
	
	if( $catalyst_multisite )
	{
		$image_folder = CHILD_ROOT . '/css/images/' . $catalyst_multisite;
	}
	else
	{
		$image_folder = CHILD_ROOT . '/css/images';
	}
	
	$catalyst_image_folder = CATALYST_ROOT . '/images';
	$catalyst_post_formats_image_folder = CHILD_ROOT . '/css/post-formats';
		
	if( !is_dir( $tmp_path ) )
	{
		@mkdir( $tmp_path, 0755, true );
	}
	if( !is_dir( $tmp_child ) )
	{
		@mkdir( $tmp_child, 0755, true );
	}
	if( !is_dir( $tmp_image_folder ) )
	{
		@mkdir( $tmp_image_folder, 0755, true );
	}
	if( !is_dir( $tmp_post_formats_image_folder ) && catalyst_get_dynamik( 'post_formats_active' ) )
	{
		@mkdir( $tmp_post_formats_image_folder, 0755, true );
	}
	
	$style_css = '/*
Theme Name:     ' . $child_name . '
Theme URI:      http: //catalysttheme.com/
Description:    A Catalyst Child Theme 
Author:         ' . $author . '
Author URI:     ' . $author_uri . '
Template:       catalyst
Version:        1.0
*/
';

	if( $at_style == 'yes' )
	{
		$style_css .= '
@import url("../catalyst/style.css");
';
	}
	
	$google_font_call = catalyst_google_font_call();
	if( !empty( $google_font_call ) )
	{
		$style_css .= '
@import url("' . $google_font_call . '");
';
	}
	
	if( $child_export_type == 'distribution' )
	{
		$style_css .= catalyst_build_dynamik_styles( 'distribution' );
	}
	elseif( $child_export_type == 'mysite' )
	{
		$style_css .= catalyst_build_dynamik_styles( 'mysite' );
	}
	
	if( catalyst_get_advanced( 'custom_css' ) != '' )
	{
		$custom_css_prefix = "\n" . '/* ' . __( 'Custom CSS', 'catalyst' ) . ' */' . "\n" . "\n";
		$custom_css = catalyst_get_advanced( 'custom_css' );
		$style_css .= $custom_css_prefix . $custom_css;
	}
	
	if( catalyst_get_dynamik( 'wrap_open_placement' ) == 'wrap_open_before_before_header' ){ $open_wrap_action = "add_action( 'catalyst_hook_before_before_header', 'catalyst_open_site_wrap' );"; }
	elseif( catalyst_get_dynamik( 'wrap_open_placement' ) == 'wrap_open_after_before_header' ){ $open_wrap_action = "add_action( 'catalyst_hook_after_before_header', 'catalyst_open_site_wrap' );"; }
	elseif( catalyst_get_dynamik( 'wrap_open_placement' ) == 'wrap_open_before_after_header' ){ $open_wrap_action = "add_action( 'catalyst_hook_before_after_header', 'catalyst_open_site_wrap' );"; }
	elseif( catalyst_get_dynamik( 'wrap_open_placement' ) == 'wrap_open_after_after_header' ){ $open_wrap_action = "add_action( 'catalyst_hook_after_after_header', 'catalyst_open_site_wrap' );"; }
	
	if( catalyst_get_dynamik( 'wrap_close_placement' ) == 'wrap_close_before_before_footer' ){ $close_wrap_action = "add_action( 'catalyst_hook_before_before_footer', 'catalyst_close_site_wrap' );"; }
	elseif( catalyst_get_dynamik( 'wrap_close_placement' ) == 'wrap_close_after_before_footer' ){ $close_wrap_action = "add_action( 'catalyst_hook_after_before_footer', 'catalyst_close_site_wrap' );"; }
	elseif( catalyst_get_dynamik( 'wrap_close_placement' ) == 'wrap_close_before_after_footer' ){ $close_wrap_action = "add_action( 'catalyst_hook_before_after_footer', 'catalyst_close_site_wrap' );"; }
	elseif( catalyst_get_dynamik( 'wrap_close_placement' ) == 'wrap_close_after_after_footer' ){ $close_wrap_action = "add_action( 'catalyst_hook_after_after_footer', 'catalyst_close_site_wrap' );"; }
	
	if( catalyst_get_responsive( 'navbar_media_query_default' ) == 'tablet_dropdown' || catalyst_get_responsive( 'navbar_media_query_default' ) == 'mobile_dropdown' )
	{
		if( catalyst_get_dynamik( 'nav1_location' ) == "Above Header" ){ $nav_1_action = "add_action( 'catalyst_hook_before_header', 'catalyst_build_navbar1' ); add_action( 'catalyst_hook_before_header', 'catalyst_dropdown_nav_1' );"; }
		elseif( catalyst_get_dynamik( 'nav1_location' ) == "Below Header" ){ $nav_1_action = "add_action( 'catalyst_hook_after_header', 'catalyst_build_navbar1' ); add_action( 'catalyst_hook_after_header', 'catalyst_dropdown_nav_1' );"; }
		elseif( catalyst_get_dynamik( 'nav1_location' ) == "Beside Header" ){ $nav_1_action = "add_action( 'catalyst_hook_header_right', 'catalyst_build_navbar1' ); add_action( 'catalyst_hook_header_right', 'catalyst_dropdown_nav_1' );"; }
		
		if( catalyst_get_dynamik( 'nav2_location' ) == "Above Header" ){ $nav_2_action = "add_action( 'catalyst_hook_before_header', 'catalyst_build_navbar2' ); add_action( 'catalyst_hook_before_header', 'catalyst_dropdown_nav_2' );"; }
		elseif( catalyst_get_dynamik( 'nav2_location' ) == "Below Header" ){ $nav_2_action = "add_action( 'catalyst_hook_after_header', 'catalyst_build_navbar2' ); add_action( 'catalyst_hook_after_header', 'catalyst_dropdown_nav_2' );"; }
	}
	else
	{
		if( catalyst_get_dynamik( 'nav1_location' ) == "Above Header" ){ $nav_1_action = "add_action( 'catalyst_hook_before_header', 'catalyst_build_navbar1' );"; }
		elseif( catalyst_get_dynamik( 'nav1_location' ) == "Below Header" ){ $nav_1_action = "add_action( 'catalyst_hook_after_header', 'catalyst_build_navbar1' );"; }
		elseif( catalyst_get_dynamik( 'nav1_location' ) == "Beside Header" ){ $nav_1_action = "add_action( 'catalyst_hook_header_right', 'catalyst_build_navbar1' );"; }
		
		if( catalyst_get_dynamik( 'nav2_location' ) == "Above Header" ){ $nav_2_action = "add_action( 'catalyst_hook_before_header', 'catalyst_build_navbar2' );"; }
		elseif( catalyst_get_dynamik( 'nav2_location' ) == "Below Header" ){ $nav_2_action = "add_action( 'catalyst_hook_after_header', 'catalyst_build_navbar2' );"; }
	}
	
	$dollar_sign = '$';

	if( catalyst_get_core( 'dynamik_responsive' ) )
	{
		$responsive_define = "
// This lets Catalyst know that a Responsive Child Theme is active.
define( 'CHILD_RESPONSIVE', true );" . "\n";
		$responsive_double_sb_add_remove = "
// Adjust the hook location of Sidebar 2 to accommodate the Responsive Design structure.
remove_action( 'catalyst_hook_after_content_sidebar_wrap', 'catalyst_sidebar_2' );
add_action( 'catalyst_hook_after_content_wrap', 'catalyst_sidebar_2' );" . "\n";
		$responsive_viewport_meta = '<meta name="viewport" content="' . catalyst_get_responsive( 'viewport_meta_content' ) . '"/>';
		$new_line = '"\n"';
		$responsive_viewport = "
add_action( 'catalyst_doctype', 'catalyst_child_responsive_viewport', 11 );
/**
 * Add viewport meta tag to the catalyst_doctype hook
 * to force 'real' scale of site when viewed in mobile devices.
 *
 * @since 1.0
 */
function catalyst_child_responsive_viewport()
{
echo '$responsive_viewport_meta' . $new_line;
}" . "\n";
		$responsive_js = "
add_action( 'get_header', 'catalyst_child_enqueue_scripts' );
/**
 * Enqueue various bits of javascript.
 *
 * @since 1.0
 */
function catalyst_child_enqueue_scripts()
{
	wp_enqueue_script( 'responsive', CATALYST_URL . '/lib/js/catalyst-responsive.js', FALSE, CATALYST_THEME_VERSION, TRUE );
}";
	}
	else
	{
		$responsive_define = "";
		$responsive_double_sb_add_remove = "";
		$responsive_viewport = "";
		$responsive_js = "";
	}
	
	if( catalyst_get_dynamik( 'post_formats_active' ) )
	{
		$post_formats = "

/**
 * Enable Custom Post Format functionality.
 */
add_theme_support( 'post-formats', array( 'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video' ) );
add_theme_support( 'catalyst-post-format-icons' );";
	}
	else
	{
		$post_formats = '';
	}
	
	//Static Homepage
	$ez_homepage_select_value = catalyst_get_dynamik( 'ez_homepage_select' );
	$home_add_action_content = preg_replace( '/\.php$/', '', $ez_homepage_select_value );
	
	if( catalyst_get_dynamik( 'ez_home_slider_display' ) )
	{
		$home_slider_active_classes = '$classes[] = "ez-home-slider";';
			
		// Determine where to hook in the Home Image Slider based on
		// whether or not the Static Homepage is active.
		if( catalyst_get_dynamik( 'dynamik_homepage_type' ) == 'default_home' )
		{
			// Determine where to hook in the Home Image Slider based on
			// Home Slider Layout option setting.
			if( catalyst_get_dynamik( 'ez_home_slider_location' ) == 'outside' )
			{
				$home_slider_inside_classes = '';
				
				$ez_home_slider = "
/****************************************
	Home Slider
****************************************/

// Require the EZ Home Slider structure functions file.
require_once( CATALYST_ROOT . '/lib/ez-structures/home/slider/ez_home_slider.php' );

// Hook the Home Slider structure function into the 'catalyst_hook_before_container' Hook.
add_action( 'catalyst_hook_before_container', 'ez_home_slider' );\n";
			}
			else
			{
				$home_slider_inside_classes = '$classes[] = "slider-inside";';
				
				$ez_home_slider = "
/****************************************
	Home Slider
****************************************/

// Require the EZ Home Slider structure functions file.
require_once( CATALYST_ROOT . '/lib/ez-structures/home/slider/ez_home_slider.php' );

// Hook the Home Slider structure function into the 'catalyst_hook_before_content' Hook.
add_action( 'catalyst_hook_before_content', 'ez_home_slider' );\n";
			}
		}
		else
		{
			// Determine where to hook in the Home Image Slider based on
			// Home Slider Layout option setting.
			if( catalyst_get_dynamik( 'ez_home_slider_location' ) == 'outside' )
			{
				$home_slider_inside_classes = '';
				
				$ez_home_slider = "
/****************************************
	Home Slider
****************************************/

// Require the EZ Home Slider structure functions file.
require_once( CATALYST_ROOT . '/lib/ez-structures/home/slider/ez_home_slider.php' );

// Hook the Home Slider structure function into the 'catalyst_hook_home' Hook.
add_action( 'catalyst_hook_home', 'ez_home_slider', 5 );\n";
			}
			else
			{
				$home_slider_inside_classes = '$classes[] = "slider-inside";';
				
				$ez_home_slider = "
/****************************************
	Home Slider
****************************************/

// Require the EZ Home Slider structure functions file.
require_once( CATALYST_ROOT . '/lib/ez-structures/home/slider/ez_home_slider.php' );

// Hook the Home Slider structure function into the 'catalyst_hook_before_ez_home' Hook.
add_action( 'catalyst_hook_before_ez_home', 'ez_home_slider' );\n";
			}
		}
	}
	else
	{
		$home_slider_active_classes = '';
		$home_slider_inside_classes = '';
		$ez_home_slider = "";
	}
	
	$home_top_defined_classes = '';
	$home_middle_defined_classes = '';
	$home_bottom_defined_classes = '';
	
	if( catalyst_get_dynamik( 'dynamik_homepage_type' ) == 'static_home' && catalyst_get_dynamik( 'ez_homepage_select' ) )
	{
		$home_structure = str_replace( '_', '-', catalyst_get_dynamik( 'ez_homepage_select' ) );
		$home_structure_classes = '$classes[] = "' . substr( $home_structure, 0, -4 ) . '";';
		
		switch ( strlen( catalyst_get_dynamik( 'ez_homepage_select' ) ) )
		{
			case '13':
				switch ( substr( catalyst_get_dynamik( 'ez_homepage_select' ), -5, -4 ) )
				{
					case '1':
						$home_top_defined_classes = '$classes[] = "home-top-single";';
						break;
					case '2':
						$home_top_defined_classes = '$classes[] = "home-top-double";';
						break;
					case '3':
						$home_top_defined_classes = '$classes[] = "home-top-triple";';
						break;
				}
				break;
			case '15':
				switch ( substr( catalyst_get_dynamik( 'ez_homepage_select' ), -7, -6 ) )
				{
					case '1':
						$home_top_defined_classes = '$classes[] = "home-top-single";';
						break;
					case '2':
						$home_top_defined_classes = '$classes[] = "home-top-double";';
						break;
					case '3':
						$home_top_defined_classes = '$classes[] = "home-top-triple";';
						break;
				}
				
				switch ( substr( catalyst_get_dynamik( 'ez_homepage_select' ), -5, -4 ) )
				{
					case '1':
						$home_bottom_defined_classes = '$classes[] = "home-bottom-single";';
						break;
					case '2':
						$home_bottom_defined_classes = '$classes[] = "home-bottom-double";';
						break;
					case '3':
						$home_bottom_defined_classes = '$classes[] = "home-bottom-triple";';
						break;
				}
				break;
			case '17':
				switch ( substr( catalyst_get_dynamik( 'ez_homepage_select' ), -9, -8 ) )
				{
					case '1':
						$home_top_defined_classes = '$classes[] = "home-top-single";';
						break;
					case '2':
						$home_top_defined_classes = '$classes[] = "home-top-double";';
						break;
					case '3':
						$home_top_defined_classes = '$classes[] = "home-top-triple";';
						break;
				}
				
				switch ( substr( catalyst_get_dynamik( 'ez_homepage_select' ), -7, -6 ) )
				{
					case '1':
						$home_middle_defined_classes = '$classes[] = "home-middle-single";';
						break;
					case '2':
						$home_middle_defined_classes = '$classes[] = "home-middle-double";';
						break;
					case '3':
						$home_middle_defined_classes = '$classes[] = "home-middle-triple";';
						break;
				}
				
				switch ( substr( catalyst_get_dynamik( 'ez_homepage_select' ), -5, -4 ) )
				{
					case '1':
						$home_bottom_defined_classes = '$classes[] = "home-bottom-single";';
						break;
					case '2':
						$home_bottom_defined_classes = '$classes[] = "home-bottom-double";';
						break;
					case '3':
						$home_bottom_defined_classes = '$classes[] = "home-bottom-triple";';
						break;
				}
			break;
		}
		
		$ez_homepage = "
/****************************************
	Static Homepage
****************************************/

// Make sure an EZ Home Structure has been selected, the selected EZ Home Structure file is present in the
// specified Catalyst directory and that the " . $dollar_sign . "catalyst_child_home variable has a value of 'true' before
// proceeding to require the specified EZ Home Structure file and corresponding function.
if( file_exists( CATALYST_ROOT . '/lib/ez-structures/home/" . $ez_homepage_select_value . "' ) && " . $dollar_sign . "catalyst_child_home )
{
	// Require the specific Homepage Structure functions files.
	require_once( CATALYST_ROOT . '/lib/ez-structures/home/" . $ez_homepage_select_value . "' );
	
	// Hook the Homepage Structure function into the 'catalyst_hook_home' Hook.
	add_action( 'catalyst_hook_home', '" . $home_add_action_content . "' );
}\n";
	}
	else
	{
		$home_structure_classes = "";
		$home_structures_defined_classes = "";
		$ez_homepage = "";
	}
	
	//Home Sidebar
	if( file_exists( CATALYST_ROOT . '/lib/ez-structures/home/sidebar/ez_home_sidebar_1.php' ) && $catalyst_child_home && catalyst_get_dynamik( 'ez_static_home_sb_display' ) )
	{
		$home_sidebar_active_classes = '$classes[] = "ez-home-sidebar";';
		
		if( catalyst_get_dynamik( 'ez_static_home_sb_location' ) == 'left' )
		{
			$home_sidebar_left_classes = '$classes[] = "home-sidebar-left";';
		}
		else
		{
			$home_sidebar_left_classes = "";
		}
		
		$ez_home_sidebar = "
// Make sure the selected EZ Home Sidebar Structure file is present in the specified Catalyst directory
// and that the " . $dollar_sign . "catalyst_child_home variable has a value of 'true' before proceeding to
// require the specified EZ Home Sidebar Structure file and corresponding function.
if( file_exists( CATALYST_ROOT . '/lib/ez-structures/home/sidebar/ez_home_sidebar_1.php' ) && " . $dollar_sign . "catalyst_child_home )
{
	// Require the Homepage Structure functions file.
	require_once( CATALYST_ROOT . '/lib/ez-structures/home/sidebar/ez_home_sidebar_1.php' );

	// Hook the Homepage Sidebar Structure function into the 'catalyst_hook_home' Hook.
	add_action( 'catalyst_hook_home', 'ez_home_sidebar_1', 15 );
}\n";
	}
	else
	{
		$home_sidebar_active_classes = "";
		$home_sidebar_left_classes = "";
		$ez_home_sidebar = "";
	}

	//Feature Top
	$ez_feature_top_select_value = catalyst_get_dynamik( 'ez_feature_top_select' );
	$feature_top_add_action_content = preg_replace( '/\.php$/', '', $ez_feature_top_select_value );
	
	if( !catalyst_get_dynamik( 'ez_feature_top_display_front_page' ) )
	{
		$feature_top_front_page = 'if( is_front_page() ) { return; }';
	}
	else
	{
		$feature_top_front_page = '';
	}
	if( !catalyst_get_dynamik( 'ez_feature_top_display_posts' ) )
	{
		$feature_top_posts = 'if( is_single() ) { return; }';
	}
	else
	{
		$feature_top_posts = '';
	}
	if( !catalyst_get_dynamik( 'ez_feature_top_display_pages' ) )
	{
		$feature_top_pages = "if( ( is_page() || is_404() ) && !is_front_page() && !is_page_template( 'template-blog.php' ) && !is_page_template( 'template-blank-content.php' ) ) { return; }";
	}
	else
	{
		$feature_top_pages = '';
	}
	if( !catalyst_get_dynamik( 'ez_feature_top_display_archives' ) )
	{
		$feature_top_archives = 'if( is_archive() || is_search() ) { return; }';
	}
	else
	{
		$feature_top_archives = '';
	}
	if( !catalyst_get_dynamik( 'ez_feature_top_display_blog' ) )
	{
		$feature_top_blog = "if( is_page_template( 'template-blog.php' ) ) { return; }";
	}
	else
	{
		$feature_top_blog = '';
	}
	if( !catalyst_get_dynamik( 'ez_feature_top_display_blank_content' ) )
	{
		$feature_top_blank_content = "if( is_page_template( 'template-blank-content.php' ) ) { return; }";
	}
	else
	{
		$feature_top_blank_content = '';
	}
	$feature_top_landing_page = "if( substr( $catalyst_layout_id, 0, 21 ) == 'catalyst_landing_page' ) { return; }";
	
	if( catalyst_get_dynamik( 'ez_feature_top_position' ) && catalyst_get_dynamik( 'ez_feature_top_position' ) == 'outside_wrap' )
	{
		$feature_top_add_action = "add_action( 'catalyst_hook_after_after_header', '" . $feature_top_add_action_content . "', 5 );";
	}
	else
	{
		$feature_top_add_action = "add_action( 'catalyst_hook_after_after_header', '" . $feature_top_add_action_content . "', 15 );";
	}
	
	if( file_exists( CATALYST_ROOT . '/lib/ez-structures/feature-top/' . catalyst_get_dynamik( 'ez_feature_top_select' ) ) &&
		catalyst_get_dynamik( 'ez_feature_top_select' ) && (
		catalyst_get_dynamik( 'ez_feature_top_display_front_page' ) ||
		catalyst_get_dynamik( 'ez_feature_top_display_posts' ) ||
		catalyst_get_dynamik( 'ez_feature_top_display_pages' ) ||
		catalyst_get_dynamik( 'ez_feature_top_display_archives' ) ||
		catalyst_get_dynamik( 'ez_feature_top_display_blog' ) ||
		catalyst_get_dynamik( 'ez_feature_top_display_blank_content' ) ) )
	{
		$feature_top_structure = str_replace( '_', '-', catalyst_get_dynamik( 'ez_feature_top_select' ) );
		$feature_top_classes = '$classes[] = "' . substr( $feature_top_structure, 0, -4 ) . '";';
		
		$ez_feature_top = "
/****************************************
	Feature Top
****************************************/

// Make sure the selected EZ Feature Top Structure file is present in the specified Catalyst directory
// before proceeding to require the specified EZ Feature Top Structure file and corresponding function.
if( file_exists( CATALYST_ROOT . '/lib/ez-structures/feature-top/" . $ez_feature_top_select_value . "' ) )
{
	// Require the specific Feature Top Structure functions file.
	require_once( CATALYST_ROOT . '/lib/ez-structures/feature-top/" . $ez_feature_top_select_value . "' );
	
	// Hook the Feature Top Structure function into the 'wp' Hook.
	add_action( 'wp', 'child_feature_top' );
	/**
	 * Determine where NOT to display the Feature Top section before hooking it in.
	 *
	 * @since 1.0
	 */
	function child_feature_top()
	{
		global " . $dollar_sign . "catalyst_layout_id;
		// Add conditional tags to control where the Feature Top Widget Area displays.
		if( substr( " . $dollar_sign . "catalyst_layout_id, 0, 21 ) == 'catalyst_landing_page' ) { return; }
		" . $feature_top_front_page . " " . $feature_top_posts . " " . $feature_top_pages . " " . $feature_top_archives . " " . $feature_top_blog . " " . $feature_top_blank_content . "
		
		// Hook the specified Feature Top Structure function into the catalyst_hook_after_after_header Hook.
		" . $feature_top_add_action . "
	}
}\n";
	}
	else
	{
		$feature_top_classes = "";
		$ez_feature_top = "";
	}
	
	//Fat Footer
	$ez_fat_footer_select_value = catalyst_get_dynamik( 'ez_fat_footer_select' );
	$fat_footer_add_action_content = preg_replace( '/\.php$/', '', $ez_fat_footer_select_value );
	
	if( !catalyst_get_dynamik( 'ez_fat_footer_display_front_page' ) )
	{
		$fat_footer_front_page = 'if( is_front_page() ) { return; }';
	}
	else
	{
		$fat_footer_front_page = '';
	}
	if( !catalyst_get_dynamik( 'ez_fat_footer_display_posts' ) )
	{
		$fat_footer_posts = 'if( is_single() ) { return; }';
	}
	else
	{
		$fat_footer_posts = '';
	}
	if( !catalyst_get_dynamik( 'ez_fat_footer_display_pages' ) )
	{
		$fat_footer_pages = "if( ( is_page() || is_404() ) && !is_front_page() && !is_page_template( 'template-blog.php' ) && !is_page_template( 'template-blank-content.php' ) ) { return; }";
	}
	else
	{
		$fat_footer_pages = '';
	}
	if( !catalyst_get_dynamik( 'ez_fat_footer_display_archives' ) )
	{
		$fat_footer_archives = 'if( is_archive() || is_search() ) { return; }';
	}
	else
	{
		$fat_footer_archives = '';
	}
	if( !catalyst_get_dynamik( 'ez_fat_footer_display_blog' ) )
	{
		$fat_footer_blog = "if( is_page_template( 'template-blog.php' ) ) { return; }";
	}
	else
	{
		$fat_footer_blog = '';
	}
	if( !catalyst_get_dynamik( 'ez_fat_footer_display_blank_content' ) )
	{
		$fat_footer_blank_content = "if( is_page_template( 'template-blank-content.php' ) ) { return; }";
	}
	else
	{
		$fat_footer_blank_content = '';
	}
	$fat_footer_landing_page = "if( substr( $catalyst_layout_id, 0, 21 ) == 'catalyst_landing_page' ) { return; }";

	if( catalyst_get_dynamik( 'ez_fat_footer_position' ) == 'outside_footer' )
	{
		$fat_footer_add_action = "add_action( 'catalyst_hook_before_before_footer', '" . $fat_footer_add_action_content . "', 5 );";
	}
	else
	{
		$fat_footer_add_action = "add_action( 'catalyst_hook_in_footer', '" . $fat_footer_add_action_content . "' );";
	}
	
	if( file_exists( CATALYST_ROOT . '/lib/ez-structures/fat-footer/' . catalyst_get_dynamik( 'ez_fat_footer_select' ) ) &&
		catalyst_get_dynamik( 'ez_fat_footer_select' ) && (
		catalyst_get_dynamik( 'ez_fat_footer_display_front_page' ) ||
		catalyst_get_dynamik( 'ez_fat_footer_display_posts' ) ||
		catalyst_get_dynamik( 'ez_fat_footer_display_pages' ) ||
		catalyst_get_dynamik( 'ez_fat_footer_display_archives' ) ||
		catalyst_get_dynamik( 'ez_fat_footer_display_blog' ) ||
		catalyst_get_dynamik( 'ez_fat_footer_display_blank_content' ) ) )
	{
		$fat_footer_structure = str_replace( '_', '-', catalyst_get_dynamik( 'ez_fat_footer_select' ) );
		$fat_footer_classes = '$classes[] = "' . substr( $fat_footer_structure, 0, -4 ) . '";';
		
		if( catalyst_get_dynamik( 'ez_fat_footer_position' ) == 'outside_footer' )
		{
			$fat_footer_outside_classes = '$classes[] = "fat-footer-outside";';
		}
		else
		{
			$fat_footer_outside_classes = "";
		}
	
		$ez_fat_footer = "
/****************************************
	Fat Footer
****************************************/

// Make sure the selected EZ Fat Footer Structure file is present in the specified Catalyst directory
// before proceeding to require the specified EZ Fat Footer Structure file and corresponding function.
if( file_exists( CATALYST_ROOT . '/lib/ez-structures/fat-footer/" . $ez_fat_footer_select_value . "' ) )
{
	// Require the specific Fat Footer Structure functions file.
	require_once( CATALYST_ROOT . '/lib/ez-structures/fat-footer/" . $ez_fat_footer_select_value . "' );
	
	// Hook the Fat Footer Structure function into the 'wp' Hook.
	add_action( 'wp', 'child_fat_footer' );
	/**
	 * Determine where NOT to display the Fat Footer section before hooking it in.
	 *
	 * @since 1.0
	 */
	function child_fat_footer()
	{
		global " . $dollar_sign . "catalyst_layout_id;
		// Add conditional tags to control where the Fat Footer Widget Area displays.
		if( substr( " . $dollar_sign . "catalyst_layout_id, 0, 21 ) == 'catalyst_landing_page' ) { return; }
		" . $fat_footer_front_page . " " . $fat_footer_posts . " " . $fat_footer_pages . " " . $fat_footer_archives . " " . $fat_footer_blog . " " . $fat_footer_blank_content . "
		
		// Hook the specified Fat Footer Structure function into the catalyst_hook_after_after_header Hook.
		" . $fat_footer_add_action . "
	}
}\n";
	}
	else
	{
		$fat_footer_classes = "";
		$fat_footer_outside_classes = "";
		$ez_fat_footer = "";
	}
	
	if( !empty( $child_google_fonts ) )
	{
		$child_google_font_output = "\n" . '/* Create the Google Fonts array variable if necessary */' . "\n" . '$catalyst_child_google_fonts = ' . $child_google_fonts . ';' . "\n";
	}
	else
	{
		$child_google_font_output = '';
	}
	
	$custom_fucntions_content = substr( file_get_contents( CHILD_ROOT . '/custom-functions.php' ), 5 ) . "\n";

	$functions_php ="<?php
/**
 * Define and require all the necessary 'bits and pieces'
 * and build all necessary Static Homepage and Featured area functions.
 * 
 * Note that many of the Home and Featured Widget Area functions have already
 * been created and are located in the /catalyst/lib/ez-structures/ directory.
 * In such cases this file only requires/calls these functions in.
 * No need to re-invent the wheel. :)
 *
 * @package Catalyst
 */

// This lets Catalyst know that a non-Dynamik Child Theme is active.
define( 'CHILD_ACTIVE', true );

// This lets Catalyst know that a HTML5 ready Child Theme is active.
define( 'CATALYST_HTML_FIVE', true );
{$responsive_define}
// Call Catalyst's core functions.
require_once( get_template_directory() . '/lib/catalyse.php' );

// Re-Declare the {$dollar_sign}catalyst_child_home global variable
// This variable is declared in /catalyst/lib/catlyse.php based on whether or not
// a Child Theme is active and a home.php file present in that Child Theme's root.
// By re-declaring this variable we can turn the Static Homepage On and Off.
global {$dollar_sign}catalyst_child_home;
{$child_google_font_output}
// Manage the placement of open/close wrap tags.
remove_action( 'init', 'catalyst_open_close_wrap' );
add_action( 'init', 'catalyst_child_open_close_wrap' );
/**
 * Hook in the opening and closgin wrap tags.
 *
 * @since 1.0
 */
function catalyst_child_open_close_wrap()
{
	{$open_wrap_action}
	{$close_wrap_action}
}

// Manage the placement of navbars.
remove_action( 'init', 'catalyst_hook_navbars' );
add_action( 'init', 'catalyst_child_hook_navbars' );
/**
 * Hook in Navbar 1 and Navbar 2.
 *
 * @since 1.0
 */
function catalyst_child_hook_navbars()
{
	{$nav_1_action}
	{$nav_2_action}
}
{$responsive_double_sb_add_remove}{$responsive_viewport}{$responsive_js}{$post_formats}
{$ez_home_slider}{$ez_homepage}{$ez_home_sidebar}{$ez_feature_top}{$ez_fat_footer}
// Filter in specific body classes based on option values.
add_filter( 'body_class', 'catalyst_child_body_classes' );
/**
 * Determine which classes will be filtered into the body class.
 *
 * @since 1.0
 * @return array of all classes to be filtered into the body class.
 */
function catalyst_child_body_classes( {$dollar_sign}classes )
{
	if( is_front_page() )
	{
		{$home_slider_active_classes}
		{$home_slider_inside_classes}
		{$home_structure_classes}
		{$home_top_defined_classes}
		{$home_middle_defined_classes}
		{$home_bottom_defined_classes}
		{$home_sidebar_active_classes}
		{$home_sidebar_left_classes}
	}
	
	{$feature_top_classes}
	{$fat_footer_classes}
	{$fat_footer_outside_classes}
	
	return {$dollar_sign}classes;
}
{$custom_fucntions_content}
//end functions.php";

	$home_php ='<?php

/**
 * Call to the catalyst_framework() function.
 * 
 * What this function does is check to see where it is being called from
 * and then returns the type of content that corresponds with such a location.
 * In this particular case it returns the catalyst_hook_home() hook allowing
 * the content that is hooked into that hook to display in this home.php file.
 *
 * @package Catalyst
 */
 
catalyst_framework();';

	$style_file = $tmp_child . '/style.css';
	$make_style = fopen( $style_file, 'x' );
	fwrite( $make_style, $style_css );
	fclose ( $make_style );
	
	$functions_file = $tmp_child . '/functions.php';
	$make_functions = fopen( $functions_file, 'x' );
	fwrite( $make_functions, $functions_php );
	fclose ( $make_functions );
	
	if( catalyst_get_dynamik( 'dynamik_homepage_type' ) == 'static_home' )
	{
		$home_file = $tmp_child . '/home.php';
		$make_home = fopen( $home_file, 'x' );
		fwrite( $make_home, $home_php );
		fclose ( $make_home );
	}
	else
	{
		$home_file = '';
	}
	
	$export_data['catalyst_dynamik_options'] = catalyst_get_dynamik( null, $args = array( 'cached' => true, 'array' => true ) );
	
	if( catalyst_get_core( 'dynamik_responsive' ) )
	{
		$export_data['catalyst_responsive_options'] = get_option( 'catalyst_responsive_options' );
	}
	
	$catalyst_datestamp = date( 'YmdHis', catalyst_time() );
	$catalyst_export_dat = 'catalyst_dynamik_' . $catalyst_datestamp . '.dat';
	$cheerios = serialize( $export_data );
	
	$dat_file = $tmp_child . '/' . $catalyst_export_dat;
	$make_dat = fopen( $dat_file, 'x' );
	fwrite( $make_dat, $cheerios );
	fclose ( $make_dat );
	
	$handle = opendir( $image_folder );
	while( false !== ( $file = readdir( $handle ) ) )
	{
		$ext = strtolower( substr( strrchr( $file, '.' ), 1 ) );
		if( $ext == 'jpg' || $ext == 'gif' || $ext == 'png' )
		{
			if( $file != 'screenshot.png' )
			{
				copy( $image_folder . '/' . $file, $tmp_image_folder . '/' . $file );
			}
			else
			{
				$screenshot = $file;
				copy( $image_folder . '/' . $file, $tmp_child . '/' . $screenshot );
			}
		}
	}
	closedir( $handle );
	
	$handle2 = opendir( $catalyst_image_folder );
	while( false !== ( $file = readdir( $handle2 ) ) && empty( $screenshot ) )
	{
		if( $file == 'screenshot.png' )
		{
			copy( $catalyst_image_folder . '/' . $file, $tmp_child . '/' . $file );
		}
	}
	closedir( $handle2 );
	
	if( is_dir( $catalyst_post_formats_image_folder ) && catalyst_get_dynamik( 'post_formats_active' ) )
	{
		$handle3 = opendir( $catalyst_post_formats_image_folder );
		while( false !== ( $file = readdir( $handle3 ) ) )
		{
			$ext = strtolower( substr( strrchr( $file, '.' ), 1 ) );
			if( $ext == 'jpg' || $ext == 'gif' || $ext == 'png' )
			{
				copy( $catalyst_post_formats_image_folder . '/' . $file, $tmp_post_formats_image_folder . '/' . $file );
			}
		}
		closedir( $handle3 );
	}
	
	$export_files = array( $style_file, $functions_file, $home_file, $dat_file, $tmp_image_folder );
	if( !empty( $screenshot ) )
	{
		$export_files[] = $tmp_child . '/' . $screenshot;
	}
	else
	{
		$export_files[] = $tmp_child . '/screenshot.png';
	}
	$catalyst_pclzip = new PclZip( $tmp_child . '/' . $child_export_zip );
	$catalyst_zipped = $catalyst_pclzip->create( $export_files, PCLZIP_OPT_REMOVE_PATH, $tmp_child );
	if( $catalyst_zipped == 0 )
	{
		die("Error : ".$catalyst_pclzip->errorInfo(true) );
	}
	
	if( ob_get_level() )
	{
		ob_end_clean();
	}
	header("Cache-Control: public, must-revalidate");
	header("Pragma: hack");
	header("Content-Type: application/zip");
	header("Content-Disposition: attachment; filename=$child_export_zip");
	readfile( $tmp_child . '/' . $child_export_zip );
	catalyst_delete_dir( $tmp_child );
	catalyst_child_folders_close_permissions();
	exit();
}

/**
 * Export the specified Core and Advaned Option settings.
 *
 * @since 1.0
 */
function catalyst_core_export( $export_name = false, $core = '', $layouts = '', $widget_areas = '', $hook_boxes = '', $custom_css = '' )
{
	$export_data = array();
	
	if( !empty( $core ) )
	{
		$export_data['catalyst_core_options'] = get_option( 'catalyst_core_options' );
	}
	
	if( !empty( $layouts ) )
	{
		$export_data['catalyst_layouts'] = get_option( 'catalyst_custom_layouts' );
	}
	
	if( !empty( $widget_areas ) )
	{
		$export_data['catalyst_widgets'] = get_option( 'catalyst_custom_widget_areas' );
	}
	
	if( !empty( $hook_boxes ) )
	{
		$export_data['catalyst_hooks'] = get_option( 'catalyst_custom_hook_boxes' );
		$export_data['catalyst_hook_content'] = get_option( 'catalyst_custom_hook_box_content' );
	}
	
	if( !empty( $custom_css ) )
	{
		$export_data['catalyst_advanced_options'] = get_option( 'catalyst_advanced_options' );
	}

	$catalyst_datestamp = date( 'YmdHis', catalyst_time() );
	if( $export_name )
	{
		$catalyst_export_dat = $export_name . '.dat';
	}
	else
	{
		$catalyst_export_dat = 'catalyst_core_' . $catalyst_datestamp . '.dat';
	}
	
	$cheerios = serialize( $export_data );
	
	header( "Content-type: text/plain" );
	header( "Content-disposition: attachment; filename=$catalyst_export_dat" );
	header( "Content-Transfer-Encoding: binary" );
	header( "Pragma: no-cache" );
	header( "Expires: 0" );
	echo $cheerios; 
	exit();
}

/**
 * Import the specified Core and Advaned Option settings into
 * their appropriate sections of the wp_options table.
 *
 * @since 1.0
 */
function catalyst_core_import( $import_file, $core = '', $layouts = '', $widget_areas = '', $hook_boxes = '', $custom_css = '' )
{
	global $wpdb;
	$catalyst_layouts = get_option( 'catalyst_custom_layouts' );
	$catalyst_widgets = get_option( 'catalyst_custom_widget_areas' );
	$catalyst_hooks = get_option( 'catalyst_custom_hook_boxes' );
	$catalyst_hook_content = get_option( 'catalyst_custom_hook_box_content' );
	
	if( 'dat' == strtolower( substr( strrchr( $import_file['name'], '.' ), 1 ) ) )
	{
		$import_data = file_get_contents( $import_file['tmp_name'] );
		$catalyst_import = unserialize( $import_data );
		$catalyst_import_tables = array();
		
		if( !empty( $core ) )
		{
			if( !empty( $catalyst_import['catalyst_core_options'] ) )
			{
				$core_import = array_merge( catalyst_core_options_defaults( false, $catalyst_import['catalyst_core_options'] ), $catalyst_import['catalyst_core_options'] );
				update_option( 'catalyst_core_options', $core_import );
			}
		}
		
		if( !empty( $layouts ) )
		{
			if( !empty( $catalyst_import['catalyst_layouts'] ) && empty( $catalyst_import['catalyst_layouts'][0] ) )
			{
				$catalyst_layouts_array = array();
				foreach( $catalyst_layouts as $key => $value )
				{
					$catalyst_layouts_array[] = $catalyst_layouts[$key]['layout_id'];
				}
				foreach( $catalyst_import['catalyst_layouts'] as $key => $value )
				{	
					if( in_array( $catalyst_import['catalyst_layouts'][$key]['layout_id'], $catalyst_layouts_array ) )
					{
						unset( $catalyst_import['catalyst_layouts'][$key] );
					}
				}
				$layouts_import = array_merge( $catalyst_layouts, $catalyst_import['catalyst_layouts'] );
				update_option( 'catalyst_custom_layouts', $layouts_import );
			}
			elseif( !empty( $catalyst_import['catalyst_layouts'] ) )
			{
				mysql_query( 'TRUNCATE TABLE ' . $wpdb->prefix . 'catalyst_layouts;' );
				$catalyst_import_tables['catalyst_layouts'] = $catalyst_import['catalyst_layouts'];
				foreach( $catalyst_import_tables as $table => $rows )
				{
					$tablename = $wpdb->prefix . $table;
					foreach( $rows as $row => $columns )
					{
						$wpdb->insert( $tablename, $columns );
					}
				}
				catalyst_update_from_old_layouts();
				$catalyst_import_tables = array();
			}
		}
		
		if( !empty( $widget_areas ) )
		{
			if( !empty( $catalyst_import['catalyst_widgets'] ) && empty( $catalyst_import['catalyst_widgets'][0] ) )
			{
				$catalyst_widgets_array = array();
				foreach( $catalyst_widgets as $key => $value )
				{
					if( !in_array( $catalyst_widgets[$key]['widget_name'], $catalyst_widgets_array ) )
					{
						$catalyst_widgets_array[] = $catalyst_widgets[$key]['widget_name'];
					}
				}
				foreach( $catalyst_import['catalyst_widgets'] as $key => $value )
				{	
					if( in_array( $catalyst_import['catalyst_widgets'][$key]['widget_name'], $catalyst_widgets_array ) )
					{
						unset( $catalyst_import['catalyst_widgets'][$key] );
					}
				}
				$widgets_import = array_merge( $catalyst_widgets, $catalyst_import['catalyst_widgets'] );
				update_option( 'catalyst_custom_widget_areas', $widgets_import );
			}
			elseif( !empty( $catalyst_import['catalyst_widgets'] ) )
			{
				mysql_query( 'TRUNCATE TABLE ' . $wpdb->prefix . 'catalyst_widgets;' );
				$catalyst_import_tables['catalyst_widgets'] = $catalyst_import['catalyst_widgets'];
				foreach( $catalyst_import_tables as $table => $rows )
				{
					$tablename = $wpdb->prefix . $table;
					foreach( $rows as $row => $columns )
					{
						$wpdb->insert( $tablename, $columns );
					}
				}
				catalyst_update_from_old_widget_areas();
				$catalyst_import_tables = array();
			}
		}
		
		if( !empty( $hook_boxes ) )
		{
			if( !empty( $catalyst_import['catalyst_hooks'] ) && empty( $catalyst_import['catalyst_hooks'][0] ) )
			{
				$catalyst_hooks_array = array();
				foreach( $catalyst_hooks as $key => $value )
				{
					if( !in_array( $catalyst_hooks[$key]['hook_name'], $catalyst_hooks_array ) )
					{
						$catalyst_hooks_array[] = $catalyst_hooks[$key]['hook_name'];
					}
				}
				foreach( $catalyst_import['catalyst_hooks'] as $key => $value )
				{	
					if( in_array( $catalyst_import['catalyst_hooks'][$key]['hook_name'], $catalyst_hooks_array ) )
					{
						unset( $catalyst_import['catalyst_hooks'][$key] );
					}
				}
				foreach( $catalyst_import['catalyst_hook_content'] as $key => $value )
				{	
					if( in_array( $key, $catalyst_hooks_array ) )
					{
						unset( $catalyst_import['catalyst_hook_content'][$key] );
					}
				}
				$hooks_import = array_merge( $catalyst_hooks, $catalyst_import['catalyst_hooks'] );
				update_option( 'catalyst_custom_hook_boxes', $hooks_import );
				$hook_content_import = array_merge( $catalyst_hook_content, $catalyst_import['catalyst_hook_content'] );
				update_option( 'catalyst_custom_hook_box_content', $hook_content_import );
			}
			elseif( !empty( $catalyst_import['catalyst_hooks'] ) )
			{
				mysql_query( 'TRUNCATE TABLE ' . $wpdb->prefix . 'catalyst_hooks;' );
				$catalyst_import_tables['catalyst_hooks'] = $catalyst_import['catalyst_hooks'];
				foreach( $catalyst_import_tables as $table => $rows )
				{
					$tablename = $wpdb->prefix . $table;
					foreach( $rows as $row => $columns )
					{
						$wpdb->insert( $tablename, $columns );
					}
				}
				catalyst_update_from_old_hook_boxes();
				$catalyst_import_tables = array();
			}
		}
		
		if( !empty( $custom_css ) )
		{
			if( !empty( $catalyst_import['catalyst_advanced_options'] ) )
			{
				update_option( 'catalyst_advanced_options', $catalyst_import['catalyst_advanced_options'] );
			}
		}
		
		if( defined( 'DYNAMIK_ACTIVE' ) )
		{
			catalyst_write_styles();
		}
		wp_redirect( admin_url( 'admin.php?page=catalyst&activetab=catalyst-core-options-nav-import-export&notice=import-complete' ) );
		exit();
	}	
	else
	{
		wp_redirect( admin_url( 'admin.php?page=catalyst&activetab=catalyst-core-options-nav-import-export&notice=import-error' ) );
		exit();
	}
}

/**
 * Export the Dynamik Option settings.
 *
 * @since 1.0
 */
function catalyst_dynamik_export( $export_name = false, $include_images = 'no' )
{
	global $blog_id;
	
	$export_data = array();
	
	$export_data['catalyst_dynamik_options'] = get_option( 'catalyst_dynamik_options' );
	$export_data['catalyst_responsive_options'] = get_option( 'catalyst_responsive_options' );

	$catalyst_datestamp = date( 'YmdHis', catalyst_time() );
	if( $export_name )
	{
		$catalyst_export_dat = $export_name . '.dat';
	}
	else
	{
		$catalyst_export_dat = 'catalyst_dynamik_' . $catalyst_datestamp . '.dat';
	}
	$cheerios = serialize( $export_data );
	
	if( $include_images == 'no' )
	{
		header( "Content-type: text/plain" );
		header( "Content-disposition: attachment; filename=$catalyst_export_dat" );
		header( "Content-Transfer-Encoding: binary" );
		header( "Pragma: no-cache" );
		header( "Expires: 0" );
		echo $cheerios; 
		exit();
	}
	else
	{
		catalyst_child_folders_open_permissions();
		require_once( ABSPATH . 'wp-admin/includes/class-pclzip.php' );
		if( $export_name )
		{
			$catalyst_export_zip = $export_name . '.zip';
		}
		else
		{
			$catalyst_export_zip = 'catalyst_dynamik_' . $catalyst_datestamp . '.zip';
		}
		$tmp_path = CHILD_ROOT . '/css/tmp';
		$dat_filename = $tmp_path . '/' . $catalyst_export_dat;
		$tmp_image_folder = $tmp_path . '/images';
		$tmp_adthumbs_folder = $tmp_image_folder . '/adminthumbnails';
		
		$catalyst_multisite = false;
		if( $blog_id > 1 )
		{
			$catalyst_multisite = $blog_id;
		}
		
		if( $catalyst_multisite )
		{
			$image_folder = CHILD_ROOT . '/css/images/' . $catalyst_multisite;
			$adthumbs_folder = $image_folder . '/adminthumbnails';
		}
		else
		{
			$image_folder = CHILD_ROOT . '/css/images';
			$adthumbs_folder = $image_folder . '/adminthumbnails';
		}
		
		if( !is_dir( $tmp_path ) )
		{
			@mkdir( $tmp_path, 0755, true );
		}
		if( !is_dir( $tmp_image_folder ) )
		{
			@mkdir( $tmp_image_folder, 0755, true );
		}
		if( !is_dir( $tmp_adthumbs_folder ) )
		{
			@mkdir( $tmp_adthumbs_folder, 0755, true );
		}
		
		$dat_file = fopen( $dat_filename, 'x' );
		fwrite( $dat_file, $cheerios );
		fclose ( $dat_file );
		
		$handle = opendir( $image_folder );
		while( false !== ( $file = readdir( $handle ) ) )
		{
			$ext = strtolower( substr( strrchr( $file, '.' ), 1 ) );
			if( $ext == 'jpg' || $ext == 'gif' || $ext == 'png' )
			{
				copy( $image_folder . '/' . $file, $tmp_image_folder . '/' . $file );
			}
		}
		closedir( $handle );
		
		$handle = opendir( $adthumbs_folder );
		while( false !== ( $file = readdir( $handle ) ) )
		{
			$ext = strtolower( substr( strrchr( $file, '.' ), 1 ) );
			if( $ext == 'jpg' || $ext == 'gif' || $ext == 'png' )
			{
				copy( $adthumbs_folder . '/' . $file, $tmp_adthumbs_folder . '/' . $file );
			}
		}
		closedir( $handle );
	
		if( is_dir( $tmp_image_folder ) )
		{
			$export_files = array( $dat_filename, $tmp_image_folder );
		}
		else
		{
			$export_files = $dat_filename;
		}
		
		$catalyst_pclzip = new PclZip( $tmp_path . '/' . $catalyst_export_zip );
		$catalyst_zipped = $catalyst_pclzip->create( $export_files, PCLZIP_OPT_REMOVE_PATH, $tmp_path );
		if( $catalyst_zipped == 0 )
		{
			die( "Error : " . $catalyst_pclzip->errorInfo( true ) );
		}
		
		if( ob_get_level() )
		{
			ob_end_clean();
		}
		header( "Cache-Control: public, must-revalidate" );
		header( "Pragma: hack" );
		header( "Content-Type: application/zip" );
		header( "Content-Disposition: attachment; filename=$catalyst_export_zip" );
		readfile( $tmp_path . '/' . $catalyst_export_zip );
		unlink( $tmp_path . '/' . $catalyst_export_dat );
		unlink( $tmp_path . '/' . $catalyst_export_zip );
		catalyst_delete_images( $tmp_image_folder );
		catalyst_delete_images( $tmp_adthumbs_folder );
		catalyst_child_folders_close_permissions();
		exit();
	}
}

/**
 * Import the Dynamik Option settings.
 *
 * @since 1.0
 */
function catalyst_dynamik_import( $import_file )
{
	global $blog_id;
	
	$import_notice = 'import-complete';
	
	if( 'zip' == strtolower( substr( strrchr( $import_file['name'], '.' ), 1 ) ) )
	{
		catalyst_child_folders_open_permissions();
		require_once(ABSPATH . 'wp-admin/includes/class-pclzip.php' );

		$tmp_path = CHILD_ROOT . '/css/tmp';
		$tmp_import_folder = $tmp_path . '/import';
		$tmp_image_folder = $tmp_import_folder . '/images';
		$tmp_adthumbs_folder = $tmp_image_folder . '/adminthumbnails';
		
		$catalyst_multisite = false;
		if( $blog_id > 1 )
		{
			$catalyst_multisite = $blog_id;
		}
		
		if( $catalyst_multisite )
		{
			$image_folder = CHILD_ROOT . '/css/images/' . $catalyst_multisite;
			$adthumbs_folder = $image_folder . '/adminthumbnails';
		}
		else
		{
			$image_folder = CHILD_ROOT . '/css/images';
			$adthumbs_folder = $image_folder . '/adminthumbnails';
		}
		
		if( !is_dir( $tmp_path ) )
		{
			@mkdir( $tmp_path, 0755, true );
		}
		if( !is_dir( $tmp_import_folder ) )
		{
			@mkdir( $tmp_import_folder, 0755, true );
		}
		
		$import_tmp_name = $import_file['tmp_name'];
		$zip_file = new PclZip( $import_tmp_name );
		
		if( ( $unzip_result_list = $zip_file->extract( PCLZIP_OPT_PATH, $tmp_import_folder ) ) == 0 )
		{
			die("Error : " . $zip_file->errorInfo( true ) );
		}		
		
		$handle = opendir( $tmp_import_folder );
		while( false !== ( $file = readdir( $handle ) ) )
		{
			$ext = strtolower( substr( strrchr( $file, '.' ), 1 ) );
			if( $ext == 'dat' )
			{				
				$import_data = file_get_contents( $tmp_import_folder . '/' . $file );
				$catalyst_import = unserialize( $import_data );
				
				/* If the Dynamik Options Import file is from a Genesis/Dynamik Export */
				if( isset( $catalyst_import['dynamik_gen_design_options']['body_bg_type'] ) )
				{
					$ez_select_find = array( 'wl', 'wr' );
					$ez_select_replace = array( 'wide_left', 'wide_right' );
					$ez_homepage_select = str_replace( $ez_select_find, $ez_select_replace, $catalyst_import['dynamik_gen_design_options']['ez_homepage_select'] ) . '.php';
					$ez_feature_top_select = str_replace( $ez_select_find, $ez_select_replace, $catalyst_import['dynamik_gen_design_options']['ez_feature_top_select'] ) . '.php';
					$ez_fat_footer_select = str_replace( $ez_select_find, $ez_select_replace, $catalyst_import['dynamik_gen_design_options']['ez_fat_footer_select'] ) . '.php';
					
					if( $catalyst_import['dynamik_gen_design_options']['ez_widget_footer_border_type'] == 'Top' )
					{
						$ez_widget_footer_border_type = 'Bottom';
					}
					elseif( $catalyst_import['dynamik_gen_design_options']['ez_widget_footer_border_type'] == 'Bottom' )
					{
						$ez_widget_footer_border_type = 'Top';
					}
					else
					{
						$ez_widget_footer_border_type = $catalyst_import['dynamik_gen_design_options']['ez_widget_footer_border_type'];
					}
					
					if( $catalyst_import['dynamik_gen_design_options']['wrap_structure'] == 'fluid' )
					{
						/* Wrap Structure is 'fluid' */
						$unique_to_catalyst = array(
							'body_bg_type' => $catalyst_import['dynamik_gen_design_options']['wrap_bg_type'],
							'body_bg_no_color' => !empty( $catalyst_import['dynamik_gen_design_options']['wrap_bg_no_color'] ) ? 1 : 0,
							'body_bg_color' => $catalyst_import['dynamik_gen_design_options']['wrap_bg_color'],
							'body_bg_image' => $catalyst_import['dynamik_gen_design_options']['wrap_bg_image'],
							'wrap_bg_type' => $catalyst_import['dynamik_gen_design_options']['inner_bg_type'],
							'wrap_bg_no_color' => !empty( $catalyst_import['dynamik_gen_design_options']['inner_bg_no_color'] ) ? 1 : 0,
							'wrap_bg_color' => $catalyst_import['dynamik_gen_design_options']['inner_bg_color'],
							'wrap_bg_image' => $catalyst_import['dynamik_gen_design_options']['inner_bg_image'],
							'wrap_border_type' => $catalyst_import['dynamik_gen_design_options']['inner_border_type'],
							'wrap_border_thickness' => $catalyst_import['dynamik_gen_design_options']['inner_border_thickness'],
							'wrap_border_style' => $catalyst_import['dynamik_gen_design_options']['inner_border_style'],
							'wrap_border_color' => $catalyst_import['dynamik_gen_design_options']['inner_border_color'],
							'wrap_shadow_active' => !empty( $catalyst_import['dynamik_gen_design_options']['inner_shadow_active'] ) ? 1 : 0,
							'wrap_shadow_style' => $catalyst_import['dynamik_gen_design_options']['inner_shadow_style'],
							'wrap_radius_active' => !empty( $catalyst_import['dynamik_gen_design_options']['inner_radius_active'] ) ? 1 : 0,
							'wrap_radius_style' => $catalyst_import['dynamik_gen_design_options']['inner_radius_style'],
							'wrap_top_margin' => $catalyst_import['dynamik_gen_design_options']['inner_top_margin'],
							'wrap_bottom_margin' => $catalyst_import['dynamik_gen_design_options']['inner_bottom_margin'],
							'wrap_tb_padding' => $catalyst_import['dynamik_gen_design_options']['container_inner_tb_padding'],
							'wrap_lr_padding' => $catalyst_import['dynamik_gen_design_options']['container_inner_lr_padding'],
							'wrap_open_placement' => 'wrap_open_after_after_header',
							'wrap_close_placement' => 'wrap_close_before_before_footer',
							'header_left_width' => $catalyst_import['dynamik_gen_design_options']['header_title_area_width'],
							'header_right_width' => $catalyst_import['dynamik_gen_design_options']['header_widget_width'],
							'cc_width' => $catalyst_import['dynamik_gen_design_options']['cc_width_dbl_rt_sb'],
							'sb1_width' => $catalyst_import['dynamik_gen_design_options']['sb1_width_dbl_rt_sb'],
							'sb2_width' => $catalyst_import['dynamik_gen_design_options']['sb2_width_dbl_rt_sb'],
							'ez_homepage_select' => $ez_homepage_select,
							'ez_home_slider_height' => substr( $catalyst_import['dynamik_gen_design_options']['ez_home_slider_height'], -2 ) == 'px' ? substr_replace( $catalyst_import['dynamik_gen_design_options']['ez_home_slider_height'], '', -2) : catalyst_get_dynamik( 'ez_home_slider_height' ),
							'ez_feature_top_position' => $catalyst_import['dynamik_gen_design_options']['ez_feature_top_position'] == 'inside_inner' ? 'inside_wrap' : 'outside_wrap',
							'ez_feature_top_select' => $ez_feature_top_select,
							'ez_fat_footer_position' => $catalyst_import['dynamik_gen_design_options']['ez_fat_footer_position'] == 'outside_inner' ? 'inside_footer' : 'outside_footer',
							'ez_fat_footer_select' => $ez_fat_footer_select,
							'ez_widget_footer_border_type' => $ez_widget_footer_border_type,
							'author_info_title_font_size' => $catalyst_import['dynamik_gen_design_options']['author_box_title_font_size'],
							'author_info_title_font_color' => $catalyst_import['dynamik_gen_design_options']['author_box_title_font_color'],
							'author_info_title_font_css' => $catalyst_import['dynamik_gen_design_options']['author_box_title_font_css'],
							'author_info_font_size' => $catalyst_import['dynamik_gen_design_options']['author_box_font_size'],
							'author_info_font_color' => $catalyst_import['dynamik_gen_design_options']['author_box_font_color'],
							'author_info_font_css' => $catalyst_import['dynamik_gen_design_options']['author_box_font_css'],
							'author_info_link_color' => $catalyst_import['dynamik_gen_design_options']['author_box_link_color'],
							'author_info_link_hover_color' => $catalyst_import['dynamik_gen_design_options']['author_box_link_hover_color'],
							'author_info_link_underline' => $catalyst_import['dynamik_gen_design_options']['author_box_link_underline'],
							'author_info_bg_type' => $catalyst_import['dynamik_gen_design_options']['author_box_bg_type'],
							'author_info_bg_no_color' => !empty( $catalyst_import['dynamik_gen_design_options']['author_box_bg_no_color'] ) ? 1 : 0,
							'author_info_bg_color' => $catalyst_import['dynamik_gen_design_options']['author_box_bg_color'],
							'author_info_bg_image' => $catalyst_import['dynamik_gen_design_options']['author_box_bg_image'],
							'author_avatar_bg_type' => $catalyst_import['dynamik_gen_design_options']['author_box_avatar_bg_type'],
							'author_avatar_bg_no_color' => !empty( $catalyst_import['dynamik_gen_design_options']['author_box_avatar_bg_no_color'] ) ? 1 : 0,
							'author_avatar_bg_color' => $catalyst_import['dynamik_gen_design_options']['author_box_avatar_bg_color'],
							'author_avatar_bg_image' => $catalyst_import['dynamik_gen_design_options']['author_box_avatar_bg_image'],
							'author_info_border_type' => $catalyst_import['dynamik_gen_design_options']['author_box_border_type'],
							'author_info_border_thickness' => $catalyst_import['dynamik_gen_design_options']['author_box_border_thickness'],
							'author_info_border_style' => $catalyst_import['dynamik_gen_design_options']['author_box_border_style'],
							'author_info_border_color' => $catalyst_import['dynamik_gen_design_options']['author_box_border_color'],
							'author_avatar_border_thickness' => $catalyst_import['dynamik_gen_design_options']['author_box_avatar_border_thickness'],
							'author_avatar_border_style' => $catalyst_import['dynamik_gen_design_options']['author_box_avatar_border_style'],
							'author_avatar_border_color' => $catalyst_import['dynamik_gen_design_options']['author_box_avatar_border_color'],
							'author_avatar_size' => $catalyst_import['dynamik_gen_design_options']['author_box_avatar_size'],
							'author_avatar_padding' => $catalyst_import['dynamik_gen_design_options']['author_box_avatar_padding'],
							'author_info_margin_top' => $catalyst_import['dynamik_gen_design_options']['author_box_margin_top'],
							'author_info_margin_bottom' => $catalyst_import['dynamik_gen_design_options']['author_box_margin_bottom'],
							'author_info_padding_top' => $catalyst_import['dynamik_gen_design_options']['author_box_padding_top'],
							'author_info_padding_right' => $catalyst_import['dynamik_gen_design_options']['author_box_padding_right'],
							'author_info_padding_bottom' => $catalyst_import['dynamik_gen_design_options']['author_box_padding_bottom'],
							'author_info_padding_left' => $catalyst_import['dynamik_gen_design_options']['author_box_padding_left']
						);
					}
					else
					{
						/* Wrap Structure is 'fixed' */
						$unique_to_catalyst = array(
							'container_wrap_bg_type' => $catalyst_import['dynamik_gen_design_options']['inner_bg_type'],
							'container_wrap_bg_no_color' => !empty( $catalyst_import['dynamik_gen_design_options']['inner_bg_no_color'] ) ? 1 : 0,
							'container_wrap_bg_color' => $catalyst_import['dynamik_gen_design_options']['inner_bg_color'],
							'container_wrap_bg_image' => $catalyst_import['dynamik_gen_design_options']['inner_bg_image'],
							'container_wrap_tb_padding' => $catalyst_import['dynamik_gen_design_options']['inner_tb_padding'],
							'container_wrap_lr_padding' => $catalyst_import['dynamik_gen_design_options']['inner_lr_padding'],
							'wrap_open_placement' => 'wrap_open_before_before_header',
							'wrap_close_placement' => 'wrap_close_after_after_footer',
							'header_left_width' => $catalyst_import['dynamik_gen_design_options']['header_title_area_width'],
							'header_right_width' => $catalyst_import['dynamik_gen_design_options']['header_widget_width'],
							'cc_width' => $catalyst_import['dynamik_gen_design_options']['cc_width_dbl_rt_sb'],
							'sb1_width' => $catalyst_import['dynamik_gen_design_options']['sb1_width_dbl_rt_sb'],
							'sb2_width' => $catalyst_import['dynamik_gen_design_options']['sb2_width_dbl_rt_sb'],
							'ez_homepage_select' => $ez_homepage_select,
							'ez_home_slider_height' => substr( $catalyst_import['dynamik_gen_design_options']['ez_home_slider_height'], -2 ) == 'px' ? substr_replace( $catalyst_import['dynamik_gen_design_options']['ez_home_slider_height'], '', -2) : catalyst_get_dynamik( 'ez_home_slider_height' ),
							'ez_feature_top_position' => $catalyst_import['dynamik_gen_design_options']['ez_feature_top_position'] == 'inside_inner' ? 'inside_wrap' : 'outside_wrap',
							'ez_feature_top_select' => $ez_feature_top_select,
							'ez_fat_footer_position' => $catalyst_import['dynamik_gen_design_options']['ez_fat_footer_position'] == 'outside_inner' ? 'inside_footer' : 'outside_footer',
							'ez_fat_footer_select' => $ez_fat_footer_select,
							'ez_widget_footer_border_type' => $ez_widget_footer_border_type,
							'author_info_title_font_size' => $catalyst_import['dynamik_gen_design_options']['author_box_title_font_size'],
							'author_info_title_font_color' => $catalyst_import['dynamik_gen_design_options']['author_box_title_font_color'],
							'author_info_title_font_css' => $catalyst_import['dynamik_gen_design_options']['author_box_title_font_css'],
							'author_info_font_size' => $catalyst_import['dynamik_gen_design_options']['author_box_font_size'],
							'author_info_font_color' => $catalyst_import['dynamik_gen_design_options']['author_box_font_color'],
							'author_info_font_css' => $catalyst_import['dynamik_gen_design_options']['author_box_font_css'],
							'author_info_link_color' => $catalyst_import['dynamik_gen_design_options']['author_box_link_color'],
							'author_info_link_hover_color' => $catalyst_import['dynamik_gen_design_options']['author_box_link_hover_color'],
							'author_info_link_underline' => $catalyst_import['dynamik_gen_design_options']['author_box_link_underline'],
							'author_info_bg_type' => $catalyst_import['dynamik_gen_design_options']['author_box_bg_type'],
							'author_info_bg_no_color' => !empty( $catalyst_import['dynamik_gen_design_options']['author_box_bg_no_color'] ) ? 1 : 0,
							'author_info_bg_color' => $catalyst_import['dynamik_gen_design_options']['author_box_bg_color'],
							'author_info_bg_image' => $catalyst_import['dynamik_gen_design_options']['author_box_bg_image'],
							'author_avatar_bg_type' => $catalyst_import['dynamik_gen_design_options']['author_box_avatar_bg_type'],
							'author_avatar_bg_no_color' => !empty( $catalyst_import['dynamik_gen_design_options']['author_box_avatar_bg_no_color'] ) ? 1 : 0,
							'author_avatar_bg_color' => $catalyst_import['dynamik_gen_design_options']['author_box_avatar_bg_color'],
							'author_avatar_bg_image' => $catalyst_import['dynamik_gen_design_options']['author_box_avatar_bg_image'],
							'author_info_border_type' => $catalyst_import['dynamik_gen_design_options']['author_box_border_type'],
							'author_info_border_thickness' => $catalyst_import['dynamik_gen_design_options']['author_box_border_thickness'],
							'author_info_border_style' => $catalyst_import['dynamik_gen_design_options']['author_box_border_style'],
							'author_info_border_color' => $catalyst_import['dynamik_gen_design_options']['author_box_border_color'],
							'author_avatar_border_thickness' => $catalyst_import['dynamik_gen_design_options']['author_box_avatar_border_thickness'],
							'author_avatar_border_style' => $catalyst_import['dynamik_gen_design_options']['author_box_avatar_border_style'],
							'author_avatar_border_color' => $catalyst_import['dynamik_gen_design_options']['author_box_avatar_border_color'],
							'author_avatar_size' => $catalyst_import['dynamik_gen_design_options']['author_box_avatar_size'],
							'author_avatar_padding' => $catalyst_import['dynamik_gen_design_options']['author_box_avatar_padding'],
							'author_info_margin_top' => $catalyst_import['dynamik_gen_design_options']['author_box_margin_top'],
							'author_info_margin_bottom' => $catalyst_import['dynamik_gen_design_options']['author_box_margin_bottom'],
							'author_info_padding_top' => $catalyst_import['dynamik_gen_design_options']['author_box_padding_top'],
							'author_info_padding_right' => $catalyst_import['dynamik_gen_design_options']['author_box_padding_right'],
							'author_info_padding_bottom' => $catalyst_import['dynamik_gen_design_options']['author_box_padding_bottom'],
							'author_info_padding_left' => $catalyst_import['dynamik_gen_design_options']['author_box_padding_left']
						);
					}
					
					$catalyst_dynamik_options_defaults = catalyst_dynamik_options_defaults();
					
					$catalyst_import['dynamik_gen_design_options']['font_type'] = array_merge( $catalyst_dynamik_options_defaults['font_type'], $catalyst_import['dynamik_gen_design_options']['font_type'] );
					$design_import_merge_unique = array_merge( $catalyst_import['dynamik_gen_design_options'], $unique_to_catalyst );
					$design_import_catalyst = array_merge( catalyst_dynamik_options_defaults(), $design_import_merge_unique );
					$design_import = array_merge( catalyst_dynamik_options_defaults( false, false, $design_import_catalyst ), $design_import_catalyst );	
					update_option( 'catalyst_dynamik_options', $design_import );
					
					$responsive_import = array_merge( catalyst_responsive_options_defaults(), $catalyst_import['dynamik_gen_responsive_options'] );
					update_option( 'catalyst_responsive_options', $responsive_import );
					
					$import_notice = 'import-genesis-complete';
				}
				else
				{
					if( isset( $catalyst_import['catalyst_dynamik_options']['universal_line_height'] ) )
					{
						$dynamik_import = array_merge( catalyst_dynamik_options_defaults( false, false, $catalyst_import['catalyst_dynamik_options'] ), $catalyst_import['catalyst_dynamik_options'] );
						update_option( 'catalyst_dynamik_options', $dynamik_import );
						
						$responsive_import = array_merge( catalyst_responsive_options_defaults(), $catalyst_import['catalyst_responsive_options'] );
						update_option( 'catalyst_responsive_options', $responsive_import );
					}
					else
					{
						if( $catalyst_import['universal_line_height'] == '160' )
						{
							$catalyst_import['universal_line_height'] = $catalyst_import['universal_line_height'] . '%';
						}
						$catalyst_import['submit_text_hover_color'] = $catalyst_import['comment_submit_font_color'];
						if( isset( $catalyst_import['comment_submit_font_u'] ) )
						{
							$catalyst_import['comment_submit_text_hover_u'] = $catalyst_import['comment_submit_font_u'];
						}
						$catalyst_import['comment_submit_hover_bg_type'] = $catalyst_import['comment_submit_bg_type'];
						if( isset( $catalyst_import['comment_submit_bg_no_color'] ) )
						{
							$catalyst_import['comment_submit_hover_bg_no_color'] = $catalyst_import['comment_submit_bg_no_color'];
						}
						$catalyst_import['comment_submit_hover_bg_color'] = $catalyst_import['comment_submit_bg_color'];
						$catalyst_import['comment_submit_hover_bg_image'] = $catalyst_import['comment_submit_bg_image'];
						$catalyst_import['comment_submit_hover_border_thickness'] = $catalyst_import['comment_submit_border_thickness'];
						$catalyst_import['comment_submit_hover_border_style'] = $catalyst_import['comment_submit_border_style'];
						$catalyst_import['comment_submit_hover_border_color'] = $catalyst_import['comment_submit_border_color'];
						
						$dynamik_import = array_merge( catalyst_dynamik_options_defaults( false, false, $catalyst_import ), $catalyst_import );
						update_option( 'catalyst_dynamik_options', $dynamik_import );
					}
				}
			}
		}
		closedir( $handle );
		
		$handle = opendir( $tmp_image_folder );
		while( false !== ( $file = readdir( $handle ) ) )
		{
			$ext = strtolower( substr( strrchr( $file, '.' ), 1 ) );
			if( $ext == 'jpg' || $ext == 'gif' || $ext == 'png' )
			{
				copy( $tmp_image_folder . '/' . $file, $image_folder . '/' . $file );
			}
		}
		closedir( $handle );
		
		$handle = opendir( $tmp_adthumbs_folder );
		while( false !== ( $file = readdir( $handle ) ) )
		{
			$ext = strtolower( substr( strrchr( $file, '.' ), 1 ) );
			if( $ext == 'jpg' || $ext == 'gif' || $ext == 'png' )
			{
				copy( $tmp_adthumbs_folder . '/' . $file, $adthumbs_folder . '/' . $file );
			}
		}
		closedir( $handle );
		
		catalyst_delete_dir( $tmp_import_folder );
		catalyst_child_folders_close_permissions();
		
		catalyst_write_styles();
		wp_redirect( admin_url( 'admin.php?page=dynamik-options&activetab=catalyst-dynamik-options-nav-import-export&notice=' . $import_notice ) );
		exit();
	}	
	elseif( 'dat' == strtolower( substr( strrchr( $import_file['name'], '.' ), 1 ) ) )
	{
		$import_data = file_get_contents( $import_file['tmp_name'] );
		$catalyst_import = unserialize( $import_data );
		
		/* If the Dynamik Options Import file is from a Genesis/Dynamik Export */
		if( isset( $catalyst_import['dynamik_gen_design_options']['body_bg_type'] ) )
		{
			$ez_select_find = array( 'wl', 'wr' );
			$ez_select_replace = array( 'wide_left', 'wide_right' );
			$ez_homepage_select = str_replace( $ez_select_find, $ez_select_replace, $catalyst_import['dynamik_gen_design_options']['ez_homepage_select'] ) . '.php';
			$ez_feature_top_select = str_replace( $ez_select_find, $ez_select_replace, $catalyst_import['dynamik_gen_design_options']['ez_feature_top_select'] ) . '.php';
			$ez_fat_footer_select = str_replace( $ez_select_find, $ez_select_replace, $catalyst_import['dynamik_gen_design_options']['ez_fat_footer_select'] ) . '.php';
			
			if( $catalyst_import['dynamik_gen_design_options']['ez_widget_footer_border_type'] == 'Top' )
			{
				$ez_widget_footer_border_type = 'Bottom';
			}
			elseif( $catalyst_import['dynamik_gen_design_options']['ez_widget_footer_border_type'] == 'Bottom' )
			{
				$ez_widget_footer_border_type = 'Top';
			}
			else
			{
				$ez_widget_footer_border_type = $catalyst_import['dynamik_gen_design_options']['ez_widget_footer_border_type'];
			}
			
			if( $catalyst_import['dynamik_gen_design_options']['wrap_structure'] == 'fluid' )
			{
				/* Wrap Structure is 'fluid' */
				$unique_to_catalyst = array(
					'body_bg_type' => $catalyst_import['dynamik_gen_design_options']['wrap_bg_type'],
					'body_bg_no_color' => !empty( $catalyst_import['dynamik_gen_design_options']['wrap_bg_no_color'] ) ? 1 : 0,
					'body_bg_color' => $catalyst_import['dynamik_gen_design_options']['wrap_bg_color'],
					'body_bg_image' => $catalyst_import['dynamik_gen_design_options']['wrap_bg_image'],
					'wrap_bg_type' => $catalyst_import['dynamik_gen_design_options']['inner_bg_type'],
					'wrap_bg_no_color' => !empty( $catalyst_import['dynamik_gen_design_options']['inner_bg_no_color'] ) ? 1 : 0,
					'wrap_bg_color' => $catalyst_import['dynamik_gen_design_options']['inner_bg_color'],
					'wrap_bg_image' => $catalyst_import['dynamik_gen_design_options']['inner_bg_image'],
					'wrap_border_type' => $catalyst_import['dynamik_gen_design_options']['inner_border_type'],
					'wrap_border_thickness' => $catalyst_import['dynamik_gen_design_options']['inner_border_thickness'],
					'wrap_border_style' => $catalyst_import['dynamik_gen_design_options']['inner_border_style'],
					'wrap_border_color' => $catalyst_import['dynamik_gen_design_options']['inner_border_color'],
					'wrap_shadow_active' => !empty( $catalyst_import['dynamik_gen_design_options']['inner_shadow_active'] ) ? 1 : 0,
					'wrap_shadow_style' => $catalyst_import['dynamik_gen_design_options']['inner_shadow_style'],
					'wrap_radius_active' => !empty( $catalyst_import['dynamik_gen_design_options']['inner_radius_active'] ) ? 1 : 0,
					'wrap_radius_style' => $catalyst_import['dynamik_gen_design_options']['inner_radius_style'],
					'wrap_top_margin' => $catalyst_import['dynamik_gen_design_options']['inner_top_margin'],
					'wrap_bottom_margin' => $catalyst_import['dynamik_gen_design_options']['inner_bottom_margin'],
					'wrap_tb_padding' => $catalyst_import['dynamik_gen_design_options']['container_inner_tb_padding'],
					'wrap_lr_padding' => $catalyst_import['dynamik_gen_design_options']['container_inner_lr_padding'],
					'wrap_open_placement' => 'wrap_open_after_after_header',
					'wrap_close_placement' => 'wrap_close_before_before_footer',
					'header_left_width' => $catalyst_import['dynamik_gen_design_options']['header_title_area_width'],
					'header_right_width' => $catalyst_import['dynamik_gen_design_options']['header_widget_width'],
					'cc_width' => $catalyst_import['dynamik_gen_design_options']['cc_width_dbl_rt_sb'],
					'sb1_width' => $catalyst_import['dynamik_gen_design_options']['sb1_width_dbl_rt_sb'],
					'sb2_width' => $catalyst_import['dynamik_gen_design_options']['sb2_width_dbl_rt_sb'],
					'ez_homepage_select' => $ez_homepage_select,
					'ez_home_slider_height' => substr( $catalyst_import['dynamik_gen_design_options']['ez_home_slider_height'], -2 ) == 'px' ? substr_replace( $catalyst_import['dynamik_gen_design_options']['ez_home_slider_height'], '', -2) : catalyst_get_dynamik( 'ez_home_slider_height' ),
					'ez_feature_top_position' => $catalyst_import['dynamik_gen_design_options']['ez_feature_top_position'] == 'inside_inner' ? 'inside_wrap' : 'outside_wrap',
					'ez_feature_top_select' => $ez_feature_top_select,
					'ez_fat_footer_position' => $catalyst_import['dynamik_gen_design_options']['ez_fat_footer_position'] == 'outside_inner' ? 'inside_footer' : 'outside_footer',
					'ez_fat_footer_select' => $ez_fat_footer_select,
					'ez_widget_footer_border_type' => $ez_widget_footer_border_type,
					'author_info_title_font_size' => $catalyst_import['dynamik_gen_design_options']['author_box_title_font_size'],
					'author_info_title_font_color' => $catalyst_import['dynamik_gen_design_options']['author_box_title_font_color'],
					'author_info_title_font_css' => $catalyst_import['dynamik_gen_design_options']['author_box_title_font_css'],
					'author_info_font_size' => $catalyst_import['dynamik_gen_design_options']['author_box_font_size'],
					'author_info_font_color' => $catalyst_import['dynamik_gen_design_options']['author_box_font_color'],
					'author_info_font_css' => $catalyst_import['dynamik_gen_design_options']['author_box_font_css'],
					'author_info_link_color' => $catalyst_import['dynamik_gen_design_options']['author_box_link_color'],
					'author_info_link_hover_color' => $catalyst_import['dynamik_gen_design_options']['author_box_link_hover_color'],
					'author_info_link_underline' => $catalyst_import['dynamik_gen_design_options']['author_box_link_underline'],
					'author_info_bg_type' => $catalyst_import['dynamik_gen_design_options']['author_box_bg_type'],
					'author_info_bg_no_color' => !empty( $catalyst_import['dynamik_gen_design_options']['author_box_bg_no_color'] ) ? 1 : 0,
					'author_info_bg_color' => $catalyst_import['dynamik_gen_design_options']['author_box_bg_color'],
					'author_info_bg_image' => $catalyst_import['dynamik_gen_design_options']['author_box_bg_image'],
					'author_avatar_bg_type' => $catalyst_import['dynamik_gen_design_options']['author_box_avatar_bg_type'],
					'author_avatar_bg_no_color' => !empty( $catalyst_import['dynamik_gen_design_options']['author_box_avatar_bg_no_color'] ) ? 1 : 0,
					'author_avatar_bg_color' => $catalyst_import['dynamik_gen_design_options']['author_box_avatar_bg_color'],
					'author_avatar_bg_image' => $catalyst_import['dynamik_gen_design_options']['author_box_avatar_bg_image'],
					'author_info_border_type' => $catalyst_import['dynamik_gen_design_options']['author_box_border_type'],
					'author_info_border_thickness' => $catalyst_import['dynamik_gen_design_options']['author_box_border_thickness'],
					'author_info_border_style' => $catalyst_import['dynamik_gen_design_options']['author_box_border_style'],
					'author_info_border_color' => $catalyst_import['dynamik_gen_design_options']['author_box_border_color'],
					'author_avatar_border_thickness' => $catalyst_import['dynamik_gen_design_options']['author_box_avatar_border_thickness'],
					'author_avatar_border_style' => $catalyst_import['dynamik_gen_design_options']['author_box_avatar_border_style'],
					'author_avatar_border_color' => $catalyst_import['dynamik_gen_design_options']['author_box_avatar_border_color'],
					'author_avatar_size' => $catalyst_import['dynamik_gen_design_options']['author_box_avatar_size'],
					'author_avatar_padding' => $catalyst_import['dynamik_gen_design_options']['author_box_avatar_padding'],
					'author_info_margin_top' => $catalyst_import['dynamik_gen_design_options']['author_box_margin_top'],
					'author_info_margin_bottom' => $catalyst_import['dynamik_gen_design_options']['author_box_margin_bottom'],
					'author_info_padding_top' => $catalyst_import['dynamik_gen_design_options']['author_box_padding_top'],
					'author_info_padding_right' => $catalyst_import['dynamik_gen_design_options']['author_box_padding_right'],
					'author_info_padding_bottom' => $catalyst_import['dynamik_gen_design_options']['author_box_padding_bottom'],
					'author_info_padding_left' => $catalyst_import['dynamik_gen_design_options']['author_box_padding_left']
				);
			}
			else
			{
				/* Wrap Structure is 'fixed' */
				$unique_to_catalyst = array(
					'container_wrap_bg_type' => $catalyst_import['dynamik_gen_design_options']['inner_bg_type'],
					'container_wrap_bg_no_color' => !empty( $catalyst_import['dynamik_gen_design_options']['inner_bg_no_color'] ) ? 1 : 0,
					'container_wrap_bg_color' => $catalyst_import['dynamik_gen_design_options']['inner_bg_color'],
					'container_wrap_bg_image' => $catalyst_import['dynamik_gen_design_options']['inner_bg_image'],
					'container_wrap_tb_padding' => $catalyst_import['dynamik_gen_design_options']['inner_tb_padding'],
					'container_wrap_lr_padding' => $catalyst_import['dynamik_gen_design_options']['inner_lr_padding'],
					'wrap_open_placement' => 'wrap_open_before_before_header',
					'wrap_close_placement' => 'wrap_close_after_after_footer',
					'header_left_width' => $catalyst_import['dynamik_gen_design_options']['header_title_area_width'],
					'header_right_width' => $catalyst_import['dynamik_gen_design_options']['header_widget_width'],
					'cc_width' => $catalyst_import['dynamik_gen_design_options']['cc_width_dbl_rt_sb'],
					'sb1_width' => $catalyst_import['dynamik_gen_design_options']['sb1_width_dbl_rt_sb'],
					'sb2_width' => $catalyst_import['dynamik_gen_design_options']['sb2_width_dbl_rt_sb'],
					'ez_homepage_select' => $ez_homepage_select,
					'ez_home_slider_height' => substr( $catalyst_import['dynamik_gen_design_options']['ez_home_slider_height'], -2 ) == 'px' ? substr_replace( $catalyst_import['dynamik_gen_design_options']['ez_home_slider_height'], '', -2) : catalyst_get_dynamik( 'ez_home_slider_height' ),
					'ez_feature_top_position' => $catalyst_import['dynamik_gen_design_options']['ez_feature_top_position'] == 'inside_inner' ? 'inside_wrap' : 'outside_wrap',
					'ez_feature_top_select' => $ez_feature_top_select,
					'ez_fat_footer_position' => $catalyst_import['dynamik_gen_design_options']['ez_fat_footer_position'] == 'outside_inner' ? 'inside_footer' : 'outside_footer',
					'ez_fat_footer_select' => $ez_fat_footer_select,
					'ez_widget_footer_border_type' => $ez_widget_footer_border_type,
					'author_info_title_font_size' => $catalyst_import['dynamik_gen_design_options']['author_box_title_font_size'],
					'author_info_title_font_color' => $catalyst_import['dynamik_gen_design_options']['author_box_title_font_color'],
					'author_info_title_font_css' => $catalyst_import['dynamik_gen_design_options']['author_box_title_font_css'],
					'author_info_font_size' => $catalyst_import['dynamik_gen_design_options']['author_box_font_size'],
					'author_info_font_color' => $catalyst_import['dynamik_gen_design_options']['author_box_font_color'],
					'author_info_font_css' => $catalyst_import['dynamik_gen_design_options']['author_box_font_css'],
					'author_info_link_color' => $catalyst_import['dynamik_gen_design_options']['author_box_link_color'],
					'author_info_link_hover_color' => $catalyst_import['dynamik_gen_design_options']['author_box_link_hover_color'],
					'author_info_link_underline' => $catalyst_import['dynamik_gen_design_options']['author_box_link_underline'],
					'author_info_bg_type' => $catalyst_import['dynamik_gen_design_options']['author_box_bg_type'],
					'author_info_bg_no_color' => !empty( $catalyst_import['dynamik_gen_design_options']['author_box_bg_no_color'] ) ? 1 : 0,
					'author_info_bg_color' => $catalyst_import['dynamik_gen_design_options']['author_box_bg_color'],
					'author_info_bg_image' => $catalyst_import['dynamik_gen_design_options']['author_box_bg_image'],
					'author_avatar_bg_type' => $catalyst_import['dynamik_gen_design_options']['author_box_avatar_bg_type'],
					'author_avatar_bg_no_color' => !empty( $catalyst_import['dynamik_gen_design_options']['author_box_avatar_bg_no_color'] ) ? 1 : 0,
					'author_avatar_bg_color' => $catalyst_import['dynamik_gen_design_options']['author_box_avatar_bg_color'],
					'author_avatar_bg_image' => $catalyst_import['dynamik_gen_design_options']['author_box_avatar_bg_image'],
					'author_info_border_type' => $catalyst_import['dynamik_gen_design_options']['author_box_border_type'],
					'author_info_border_thickness' => $catalyst_import['dynamik_gen_design_options']['author_box_border_thickness'],
					'author_info_border_style' => $catalyst_import['dynamik_gen_design_options']['author_box_border_style'],
					'author_info_border_color' => $catalyst_import['dynamik_gen_design_options']['author_box_border_color'],
					'author_avatar_border_thickness' => $catalyst_import['dynamik_gen_design_options']['author_box_avatar_border_thickness'],
					'author_avatar_border_style' => $catalyst_import['dynamik_gen_design_options']['author_box_avatar_border_style'],
					'author_avatar_border_color' => $catalyst_import['dynamik_gen_design_options']['author_box_avatar_border_color'],
					'author_avatar_size' => $catalyst_import['dynamik_gen_design_options']['author_box_avatar_size'],
					'author_avatar_padding' => $catalyst_import['dynamik_gen_design_options']['author_box_avatar_padding'],
					'author_info_margin_top' => $catalyst_import['dynamik_gen_design_options']['author_box_margin_top'],
					'author_info_margin_bottom' => $catalyst_import['dynamik_gen_design_options']['author_box_margin_bottom'],
					'author_info_padding_top' => $catalyst_import['dynamik_gen_design_options']['author_box_padding_top'],
					'author_info_padding_right' => $catalyst_import['dynamik_gen_design_options']['author_box_padding_right'],
					'author_info_padding_bottom' => $catalyst_import['dynamik_gen_design_options']['author_box_padding_bottom'],
					'author_info_padding_left' => $catalyst_import['dynamik_gen_design_options']['author_box_padding_left']
				);
			}
			
			$catalyst_dynamik_options_defaults = catalyst_dynamik_options_defaults();
			
			$catalyst_import['dynamik_gen_design_options']['font_type'] = array_merge( $catalyst_dynamik_options_defaults['font_type'], $catalyst_import['dynamik_gen_design_options']['font_type'] );
			$design_import_merge_unique = array_merge( $catalyst_import['dynamik_gen_design_options'], $unique_to_catalyst );
			$design_import_catalyst = array_merge( catalyst_dynamik_options_defaults(), $design_import_merge_unique );
			$design_import = array_merge( catalyst_dynamik_options_defaults( false, false, $design_import_catalyst ), $design_import_catalyst );	
			update_option( 'catalyst_dynamik_options', $design_import );
			
			$responsive_import = array_merge( catalyst_responsive_options_defaults(), $catalyst_import['dynamik_gen_responsive_options'] );
			update_option( 'catalyst_responsive_options', $responsive_import );
			
			$import_notice = 'import-genesis-complete';
		}
		else
		{
			if( isset( $catalyst_import['catalyst_dynamik_options']['universal_line_height'] ) )
			{
				$dynamik_import = array_merge( catalyst_dynamik_options_defaults( false, false, $catalyst_import['catalyst_dynamik_options'] ), $catalyst_import['catalyst_dynamik_options'] );
				update_option( 'catalyst_dynamik_options', $dynamik_import );
				
				$responsive_import = array_merge( catalyst_responsive_options_defaults(), $catalyst_import['catalyst_responsive_options'] );
				update_option( 'catalyst_responsive_options', $responsive_import );
			}
			else
			{
				if( $catalyst_import['universal_line_height'] == '160' )
				{
					$catalyst_import['universal_line_height'] = $catalyst_import['universal_line_height'] . '%';
				}
				$catalyst_import['submit_text_hover_color'] = $catalyst_import['comment_submit_font_color'];
				if( isset( $catalyst_import['comment_submit_font_u'] ) )
				{
					$catalyst_import['comment_submit_text_hover_u'] = $catalyst_import['comment_submit_font_u'];
				}
				$catalyst_import['comment_submit_hover_bg_type'] = $catalyst_import['comment_submit_bg_type'];
				if( isset( $catalyst_import['comment_submit_bg_no_color'] ) )
				{
					$catalyst_import['comment_submit_hover_bg_no_color'] = $catalyst_import['comment_submit_bg_no_color'];
				}
				$catalyst_import['comment_submit_hover_bg_color'] = $catalyst_import['comment_submit_bg_color'];
				$catalyst_import['comment_submit_hover_bg_image'] = $catalyst_import['comment_submit_bg_image'];
				$catalyst_import['comment_submit_hover_border_thickness'] = $catalyst_import['comment_submit_border_thickness'];
				$catalyst_import['comment_submit_hover_border_style'] = $catalyst_import['comment_submit_border_style'];
				$catalyst_import['comment_submit_hover_border_color'] = $catalyst_import['comment_submit_border_color'];
				
				$dynamik_import = array_merge( catalyst_dynamik_options_defaults( false, false, $catalyst_import ), $catalyst_import );
				update_option( 'catalyst_dynamik_options', $dynamik_import );
			}
		}
		
		catalyst_write_styles();
		wp_redirect( admin_url( 'admin.php?page=dynamik-options&activetab=catalyst-dynamik-options-nav-import-export&notice=' . $import_notice ) );
		exit();
	}	
	else
	{
		wp_redirect( admin_url( 'admin.php?page=dynamik-options&activetab=catalyst-dynamik-options-nav-import-export&notice=import-error' ) );
		exit();
	}
}

/**
 * Update the catalyst_dynamik_snapshot_options array with the latest Dynamik Settings.
 *
 * @since 1.5
 */
function catalyst_dynamik_snapshot_update( $activation = false )
{
	$catalyst_dynamik_snapshot_options['dynamik_options'] = catalyst_get_dynamik( null, $args = array( 'cached' => true, 'array' => true ) );
	$catalyst_dynamik_snapshot_options['responsive_options'] = catalyst_get_responsive( null, $args = array( 'cached' => true, 'array' => true ) );
	$catalyst_dynamik_snapshot_options['timestamp'] = gmdate( 'Y-m-d H:i:s', ( time() + ( get_option( 'gmt_offset' ) * 3600 ) ) );
	$catalyst_dynamik_snapshot_options['dynamik_snapshot_options'] = !$activation ? $_POST['catalyst'] : '';

	update_option( 'catalyst_dynamik_snapshot_options', $catalyst_dynamik_snapshot_options );
	
	if( !$activation )
	{
		catalyst_write_styles();
		wp_redirect( admin_url( 'admin.php?page=dynamik-options&activetab=catalyst-dynamik-options-nav-import-export&notice=snapshot-update-complete' ) );
		exit();
	}
}

/**
 * Restore the catalyst_dynamik_snapshot_options array with the most recent Dynamik Settings Snapshot.
 *
 * @since 1.5
 */
function catalyst_dynamik_snapshot_restore()
{
	$catalyst_dynamik_snapshot_options = get_option( 'catalyst_dynamik_snapshot_options' );
	$dynamik_options_restore = array_merge( catalyst_dynamik_options_defaults( false, false, $catalyst_dynamik_snapshot_options['dynamik_options'] ), $catalyst_dynamik_snapshot_options['dynamik_options'] );
	update_option( 'catalyst_dynamik_options', $dynamik_options_restore );
	$responsive_options_restore = array_merge( catalyst_responsive_options_defaults(), $catalyst_dynamik_snapshot_options['responsive_options'] );
	update_option( 'catalyst_responsive_options', $responsive_options_restore );
	
	catalyst_write_styles();
	wp_redirect( admin_url( 'admin.php?page=dynamik-options&activetab=catalyst-dynamik-options-nav-import-export&notice=snapshot-restore-complete' ) );
	exit();
}

add_action( 'admin_init', 'catalyst_import_export_check' );
/**
 * Check for Import/Export $_POST actions and react appropriately.
 *
 * @since 1.0
 */
function catalyst_import_export_check()
{
	if( !empty( $_POST['action'] ) && $_POST['action'] == 'catalyst_core_export' )
	{
		$export_name = $_POST['catalyst_export_name'] != '' ? $_POST['catalyst_export_name'] : false;
		$core = isset( $_POST['export_core'] ) ? $_POST['export_core'] : '';
		$layouts = isset( $_POST['export_layouts'] ) ? $_POST['export_layouts'] : '';
		$widget_areas = isset( $_POST['export_widgets'] ) ? $_POST['export_widgets'] : '';
		$hook_boxes = isset( $_POST['export_hooks'] ) ? $_POST['export_hooks'] : '';
		$custom_css = isset( $_POST['export_css'] ) ? $_POST['export_css'] : '';

		catalyst_core_export( $export_name, $core, $layouts, $widget_areas, $hook_boxes, $custom_css );
	}
	if( !empty( $_POST['action'] ) && $_POST['action'] == 'catalyst_core_import' )
	{
		$core = isset( $_POST['import_core'] ) ? $_POST['import_core'] : '';
		$layouts = isset( $_POST['import_layouts'] ) ? $_POST['import_layouts'] : '';
		$widget_areas = isset( $_POST['import_widgets'] ) ? $_POST['import_widgets'] : '';
		$hook_boxes = isset( $_POST['import_hooks'] ) ? $_POST['import_hooks'] : '';
		$custom_css = isset( $_POST['import_css'] ) ? $_POST['import_css'] : '';
		
		catalyst_core_import( $_FILES['core_import_file'], $core, $layouts, $widget_areas, $hook_boxes, $custom_css );
	}
	if( !empty( $_POST['action'] ) && $_POST['action'] == 'catalyst_dynamik_export' )
	{
		$export_name = $_POST['dynamik_export_name'] != '' ? $_POST['dynamik_export_name'] : false;
		$include_images = !empty( $_POST['include_images'] ) ? 'yes' : 'no';
		catalyst_dynamik_export( $export_name, $include_images );
	}
	if( !empty($_POST['action'] ) && $_POST['action'] == 'catalyst_dynamik_import' )
	{
		catalyst_dynamik_import( $_FILES['dynamik_import_file'] );
	}
	if( !empty( $_POST['action'] ) && $_POST['action'] == 'catalyst_child_export' )
	{		
		if( !empty( $_POST['child_export_type'] ) && $_POST['child_export_type'] == 'mysite' )
		{
			if( !empty( $_POST['catalyst_at_style'] ) )
			{
				catalyst_child_export( $_POST['catalyst_child_name'], 'yes', $_POST['catalyst_child_author'], $_POST['catalyst_child_author_uri'], $_POST['child_export_type'] );
			}
			else
			{
				catalyst_child_export( $_POST['catalyst_child_name'], 'no', $_POST['catalyst_child_author'], $_POST['catalyst_child_author_uri'], $_POST['child_export_type'] );
			}
		}
		elseif( !empty( $_POST['child_export_type'] ) && $_POST['child_export_type'] == 'distribution' )
		{
			if( catalyst_get_core( 'site_layout_type' ) != 'double-sidebar' && catalyst_get_core( 'site_layout_type' ) != 'double-left-sidebar' && catalyst_get_core( 'site_layout_type' ) != 'double-right-sidebar' )
			{
				wp_redirect( admin_url( 'admin.php?page=dynamik-options&activetab=catalyst-dynamik-options-nav-import-export&notice=double-error' ) );
				exit();
			}
			elseif( !empty( $_POST['catalyst_at_style'] ) )
			{
				catalyst_child_export( $_POST['catalyst_child_name'], 'yes', $_POST['catalyst_child_author'], $_POST['catalyst_child_author_uri'], $_POST['child_export_type'] );
			}
			else
			{
				catalyst_child_export( $_POST['catalyst_child_name'], 'no', $_POST['catalyst_child_author'], $_POST['catalyst_child_author_uri'], $_POST['child_export_type'] );
			}
		}
	}
	if( !empty( $_POST['action'] ) && $_POST['action'] == 'catalyst_dynamik_snapshot_update' )
	{
		catalyst_dynamik_snapshot_update();
	}
	if( !empty($_POST['action'] ) && $_POST['action'] == 'catalyst_dynamik_snapshot_restore' )
	{
		catalyst_dynamik_snapshot_restore();
	}
}

/**
 * Create a call to specified Google fonts for Child Theme Export.
 *
 * @since 1.0
 * @return a call to specified Google fonts.
 */
function catalyst_google_font_call()
{
	if( defined( 'DYNAMIK_ACTIVE' ) )
	{
		$dynamik_font_type = catalyst_get_dynamik( 'font_type' );
		if( $dynamik_font_type )
		{
			foreach( $dynamik_font_type as $key => $value )
			{
				$dynamik_font_type[$key] = $value;
			}
		}
		$catalyst_google_font_array = catalyst_google_font_array();
		$google_fonts = '';
		
		foreach( $catalyst_google_font_array as $google_font => $google_font_data )
		{
			if( in_array( $google_font_data['value'], $dynamik_font_type ) )
			{
				$google_fonts .= $google_font_data['url_string'];
			}
		}
		
		if( !empty( $google_fonts ) )
		{
			$google_font_call = 'http://fonts.googleapis.com/css?family=' . $google_fonts;
			return $google_font_call;
		}
		else
		{
			return false;
		}
	}
}

/**
 * Delete images of specified extension and in specific folders.
 *
 * NOTE: This is used to delete the temporary images created
 * when performing a Dynamik Options export.
 *
 * @since 1.0
 */
function catalyst_delete_images( $dir )
{
	$handle = opendir( $dir );
	while( false !== ( $file = readdir( $handle ) ) )
	{
		$ext = strtolower( substr( strrchr( $file, '.' ), 1 ) );
		if( $ext == 'jpg' || $ext == 'gif' || $ext == 'png' )
		{
			unlink( $dir . '/' . $file );
		}
	}
	closedir( $handle );
}

/**
 * Delete specific folders.
 *
 * NOTE: This is used to delete the temporary folders created
 * when performing a Dynamik Options or Child Theme export.
 *
 * @since 1.0
 */
function catalyst_delete_dir( $dir )
{
	$handle = opendir( $dir );
	while( false !== ( $file = readdir( $handle ) ) )
	{
		if( is_dir( $dir . '/' . $file ) )
		{
			if( ( $file != '.' ) && ( $file != '..' ) )
			{
				catalyst_delete_dir( $dir . '/' . $file );
			}
		}
		else
		{
			unlink( $dir . '/' . $file );
		}
	}
	closedir( $handle );
	rmdir( $dir );
}

/**
 * This function is not currently in use, but we'll keep it around
 * in case we need it in the future.
 *
 * @since 1.0
 */
function catalyst_copy_dir( $source, $destination )
{
	if( is_dir( $source ) )
	{
		if( !is_dir( $destination ) )
		{
			@mkdir( $destination, 0755, true );
		}
		$handle = opendir( $source );
		while( false !== ( $readdirectory = readdir( $handle ) ) )
		{
			if( $readdirectory == '.' || $readdirectory == '..' )
			{
				continue;
			}
			$pathdir = $source . '/' . $readdirectory; 
			if( is_dir( $pathdir ) )
			{
				catalyst_copy_dir( $pathdir, $destination . '/' . $readdirectory );
				continue;
			}
			copy( $pathdir, $destination . '/' . $readdirectory );
		}
		closedir( $handle );
	}
	else
	{
		copy( $source, $destination );
	}
}

//end lib/functions/catalyst-import-export.php