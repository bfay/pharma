<?php
/**
 * Define and require all the necessary "bits and pieces"
 * and build all necessary Static Homepage and Featured area functions.
 * 
 * Note that many of the Home and Featured Widget Area functions have already
 * been created and are located in the /catalyst/lib/ez-structures/ directory.
 * In such cases this file only requires/calls these functions in.
 * No need to re-invent the wheel. :)
 *
 * Note: This file is only called in if the
 * Dynamik Child Theme is active.
 *
 * @package Catalyst
 */

// Adjust the hook location of Sidebar 2 to accommodate the Responsive Design structure.
if( catalyst_get_core( 'dynamik_responsive' ) )
{
	remove_action( 'catalyst_hook_after_content_sidebar_wrap', 'catalyst_sidebar_2' );
	add_action( 'catalyst_hook_after_content_wrap', 'catalyst_sidebar_2' );
}

// Add support for Post Formats.
if( catalyst_get_dynamik_alt( 'post_formats_active' ) )
{
	add_theme_support( 'post-formats', array( 'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video' ) );
	add_theme_support( 'catalyst-post-format-icons' );
}

/****************************************
	Static Homepage
****************************************/

// Make sure the EZ Home Slider is currently active
// before proceeding to require the EZ Home Slider Structure file and corresponding function.
if( catalyst_get_dynamik_alt( 'ez_home_slider_display' ) )
{
	require_once( CATALYST_LIB . '/ez-structures/home/slider/ez_home_slider.php' );
	
	// Determine where to hook in the Home Image Slider based on
	// whether or not the Static Homepage is active.
	if( catalyst_get_dynamik_alt( 'dynamik_homepage_type' ) == 'default_home' )
	{
		// Determine where to hook in the Home Image Slider based on
		// Home Slider Layout option setting.
		if( catalyst_get_dynamik_alt( 'ez_home_slider_location' ) == 'outside' )
		{
			add_action( 'catalyst_hook_before_container', 'ez_home_slider' );
		}
		else
		{
			add_action( 'catalyst_hook_before_content', 'ez_home_slider' );
		}
	}
	else
	{
		// Determine where to hook in the Home Image Slider based on
		// Home Slider Layout option setting.
		if( catalyst_get_dynamik_alt( 'ez_home_slider_location' ) == 'outside' )
		{
			add_action( 'catalyst_hook_home', 'ez_home_slider', 5 );
		}
		else
		{
			add_action( 'catalyst_hook_before_ez_home', 'ez_home_slider' );
		}
	}
}

// Define the $home_structure variable.
// This variable is used to determine which Static Home structure file and function to call.
$home_structure = catalyst_get_dynamik_alt( 'ez_homepage_select' );

// Make sure an EZ Home Structure has been selected, the selected EZ Home Structure file is present in the
// specified Catalyst directory and that the $catalyst_child_home variable has a value of "true" before
// proceeding to require the specified EZ Home Structure file and corresponding function.
if( $home_structure && file_exists( CATALYST_LIB . '/ez-structures/home/' . $home_structure ) && $catalyst_child_home )
{
	require_once( CATALYST_LIB . '/ez-structures/home/' . $home_structure );
	add_action( 'catalyst_hook_home', preg_replace( '/\.php$/', '', $home_structure ) );
}

// Make sure the selected EZ Home Sidebar Structure file is present in the specified Catalyst directory,
// that the $catalyst_child_home variable has a value of "true" and that the optoin to display the Home Sidebar
// is selected before proceeding to require the specified EZ Home Sidebar Structure file and corresponding function.
if( file_exists( CATALYST_LIB . '/ez-structures/home/sidebar/ez_home_sidebar_1.php' ) && $catalyst_child_home && catalyst_get_dynamik_alt( 'ez_static_home_sb_display' ) )
{
	// Require the Homepage Structure functions file.
	require_once( CATALYST_LIB . '/ez-structures/home/sidebar/ez_home_sidebar_1.php' );
	
	// Hook the Homepage Sidebar Structure function into the 'catalyst_hook_home' Hook.
	add_action( 'catalyst_hook_home', 'ez_home_sidebar_1', 15 ); 
}

/****************************************
	Feature Top
****************************************/

// Make sure an EZ Feature Top Structure file is selected, the selected EZ Feature Top Structure file is present
// in the specified Catalyst directory and that at least one Location is checked
// before proceeding to require the specified EZ Feature Top Structure file.
if( file_exists( CATALYST_LIB . '/ez-structures/feature-top/' . catalyst_get_dynamik_alt( 'ez_feature_top_select' ) ) &&
	catalyst_get_dynamik_alt( 'ez_feature_top_select' ) && (
	catalyst_get_dynamik_alt( 'ez_feature_top_display_front_page' ) ||
	catalyst_get_dynamik_alt( 'ez_feature_top_display_posts' ) ||
	catalyst_get_dynamik_alt( 'ez_feature_top_display_pages' ) ||
	catalyst_get_dynamik_alt( 'ez_feature_top_display_archives' ) ||
	catalyst_get_dynamik_alt( 'ez_feature_top_display_blog' ) ||
	catalyst_get_dynamik_alt( 'ez_feature_top_display_blank_content' ) ) )
{
	require_once( CATALYST_LIB . '/ez-structures/feature-top/' . catalyst_get_dynamik_alt( 'ez_feature_top_select' ) );
}

// Hook the Feature Top Structure function into the 'wp' Hook.
add_action( 'wp', 'ez_feature_top_structure' );
/**
 * Determine where NOT to display the Feature Top section before hooking it in.
 *
 * @since 1.0
 */
function ez_feature_top_structure()
{
	global $catalyst_layout_id;

	if( catalyst_get_dynamik_alt( 'ez_feature_top_select' ) && (
		catalyst_get_dynamik_alt( 'ez_feature_top_display_front_page' ) ||
		catalyst_get_dynamik_alt( 'ez_feature_top_display_posts' ) ||
		catalyst_get_dynamik_alt( 'ez_feature_top_display_pages' ) ||
		catalyst_get_dynamik_alt( 'ez_feature_top_display_archives' ) ||
		catalyst_get_dynamik_alt( 'ez_feature_top_display_blog' ) ||
		catalyst_get_dynamik_alt( 'ez_feature_top_display_blank_content' ) ) )
	{
		if( is_front_page() && !catalyst_get_dynamik_alt( 'ez_feature_top_display_front_page' ) )
			return;
		if( is_single() && !catalyst_get_dynamik_alt( 'ez_feature_top_display_posts' ) )
			return;
		if( ( is_page() || is_404() ) && !is_front_page() && !is_page_template( 'template-blog.php' ) && !is_page_template( 'template-blank-content.php' ) && !catalyst_get_dynamik_alt( 'ez_feature_top_display_pages' ) )
			return;
		if( ( is_archive() || is_search() ) && !catalyst_get_dynamik_alt( 'ez_feature_top_display_archives' ) )
			return;
		if( is_page_template( 'template-blog.php' ) && !catalyst_get_dynamik_alt( 'ez_feature_top_display_blog' ) )
			return;
		if( is_page_template( 'template-blank-content.php' ) && !catalyst_get_dynamik_alt( 'ez_feature_top_display_blank_content' ) )
			return;
		if( substr( $catalyst_layout_id, 0, 21 ) == 'catalyst_landing_page' )
			return;
		
		if( catalyst_get_dynamik_alt( 'ez_feature_top_position' ) && catalyst_get_dynamik_alt( 'ez_feature_top_position' ) == 'outside_wrap' )
		{
			add_action( 'catalyst_hook_after_after_header', preg_replace( '/\.php$/', '', catalyst_get_dynamik_alt( 'ez_feature_top_select' ) ), 5 );
		}
		else
		{
			add_action( 'catalyst_hook_after_after_header', preg_replace( '/\.php$/', '', catalyst_get_dynamik_alt( 'ez_feature_top_select' ) ), 15 );
		}
	}
}

/****************************************
	Fat Footer
****************************************/

// Make sure an EZ Fat Footer Structure file is selected, the selected EZ Fat Footer Structure file is present
// in the specified Catalyst directory and that at least one Location is checked
// before proceeding to require the specified EZ Fat Footer Structure file.
if( file_exists( CATALYST_LIB . '/ez-structures/fat-footer/' . catalyst_get_dynamik_alt( 'ez_fat_footer_select' ) ) &&
	catalyst_get_dynamik_alt( 'ez_fat_footer_select' ) && (
	catalyst_get_dynamik_alt( 'ez_fat_footer_display_front_page' ) ||
	catalyst_get_dynamik_alt( 'ez_fat_footer_display_posts' ) ||
	catalyst_get_dynamik_alt( 'ez_fat_footer_display_pages' ) ||
	catalyst_get_dynamik_alt( 'ez_fat_footer_display_archives' ) ||
	catalyst_get_dynamik_alt( 'ez_fat_footer_display_blog' ) ||
	catalyst_get_dynamik_alt( 'ez_fat_footer_display_blank_content' ) ) )
{
	require_once( CATALYST_LIB . '/ez-structures/fat-footer/' . catalyst_get_dynamik_alt( 'ez_fat_footer_select' ) );
}

// Hook the Fat Footer structure function into the 'wp' Hook.
add_action( 'wp', 'ez_fat_footer_structure' );
/**
 * Determine where NOT to display the Fat Footer section before hooking it in.
 *
 * @since 1.0
 */
function ez_fat_footer_structure()
{
	global $catalyst_layout_id;

	if( catalyst_get_dynamik_alt( 'ez_fat_footer_select' ) && (
		catalyst_get_dynamik_alt( 'ez_fat_footer_display_front_page' ) ||
		catalyst_get_dynamik_alt( 'ez_fat_footer_display_posts' ) ||
		catalyst_get_dynamik_alt( 'ez_fat_footer_display_pages' ) ||
		catalyst_get_dynamik_alt( 'ez_fat_footer_display_archives' ) ||
		catalyst_get_dynamik_alt( 'ez_fat_footer_display_blog' ) ||
		catalyst_get_dynamik_alt( 'ez_fat_footer_display_blank_content' ) ) )
	{
		if( is_front_page() && !catalyst_get_dynamik_alt( 'ez_fat_footer_display_front_page' ) )
			return;
		if( is_single() && !catalyst_get_dynamik_alt( 'ez_fat_footer_display_posts' ) )
			return;
		if( ( is_page() || is_404() ) && !is_front_page() && !is_page_template( 'template-blog.php' ) && !is_page_template( 'template-blank-content.php' ) && !catalyst_get_dynamik_alt( 'ez_fat_footer_display_pages' ) )
			return;
		if( ( is_archive() || is_search() ) && !catalyst_get_dynamik_alt( 'ez_fat_footer_display_archives' ) )
			return;
		if( is_page_template( 'template-blank-content.php' ) && !catalyst_get_dynamik_alt( 'ez_fat_footer_display_blank_content' ) )
			return;
		if( is_page_template( 'template-blog.php' ) && !catalyst_get_dynamik_alt( 'ez_fat_footer_display_blog' ) )
			return;
		if( substr( $catalyst_layout_id, 0, 21 ) == 'catalyst_landing_page' )
			return;
			
		if( catalyst_get_dynamik_alt( 'ez_fat_footer_position' ) == 'outside_footer' )
		{
			add_action( 'catalyst_hook_before_before_footer', preg_replace( '/\.php$/', '', catalyst_get_dynamik_alt( 'ez_fat_footer_select' ) ), 5 );
		}
		else
		{
			add_action( 'catalyst_hook_in_footer', preg_replace( '/\.php$/', '', catalyst_get_dynamik_alt( 'ez_fat_footer_select' ) ) );
		}
	}
}

// Check to see if the custom-functions.php file exists before including it.
if( file_exists( CHILD_ROOT . '/custom-functions.php' ) )
{
	require_once( CHILD_ROOT . '/custom-functions.php' );
}
	
//end catalyst-dynamik-functions.php