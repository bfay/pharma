<?php
/**
 * This is the initialization file for Catalyst,
 * defining constants, globaling database option arrays
 * and requiring other function files.
 *
 * @package Catalyst
 */
 
/**
 * Define Catalyst paths.
 */
define( 'CATALYST_ROOT', get_template_directory() );
define( 'CHILD_ROOT', get_stylesheet_directory() );
define( 'CATALYST_LIB', CATALYST_ROOT . '/lib' );
define( 'CATALYST_ADMIN', CATALYST_LIB . '/admin' );
define( 'CATALYST_BOXES', CATALYST_ADMIN . '/boxes' );
define( 'CATALYST_FUNCTIONS', CATALYST_LIB . '/functions' );
define( 'CATALYST_JS', CATALYST_LIB . '/js' );
define( 'CATALYST_SHORTCODES', CATALYST_LIB . '/shortcodes' );
define( 'CATALYST_WIDGETS', CATALYST_LIB . '/widgets' );
define( 'CATALYST_CSS', CATALYST_LIB . '/css' );
define( 'CATALYST_THEME_NAME', 'Catalyst' );
define( 'CATALYST_THEME_VERSION', '1.5.3' );
define( 'CATALYST_URL', get_template_directory_uri() );
define( 'CHILD_URL', get_stylesheet_directory_uri() );

// Localization.
load_theme_textdomain( 'catalyst', CATALYST_LIB . '/languages' );

// Require the Catalyst Options function file.
require_once( CATALYST_FUNCTIONS . '/catalyst-options.php' );

// Define Catalyst globals.
global $blog_id;
$catalyst_multisite = false;
if( $blog_id > 1 )
{
    $catalyst_multisite = $blog_id;
}
$catalyst_core_options = catalyst_get_core( null, $args = array( 'cached' => true, 'array' => true ) );

if( defined( 'DYNAMIK_ACTIVE' ) )
{
	$catalyst_dynamik_options = catalyst_get_dynamik_alt( null, $args = array( 'cached' => true, 'array' => true ) );
	if( !empty( $catalyst_dynamik_options['font_type'] ) )
	{
		foreach( $catalyst_dynamik_options['font_type'] as $key => $value )
		{
			$catalyst_dynamik_options['font_type'][$key] = $value;
		}
	}
}

$catalyst_advanced_options = catalyst_get_advanced( null, $args = array( 'cached' => true, 'array' => true ) );

// Create a global to define whether or not the CSS Buidler Popup tool is active.
$catalyst_css_builder_popup = false;

if( catalyst_get_advanced( 'css_builder_popup_active' ) && current_user_can( 'administrator' ) )
{
	$catalyst_css_builder_popup = true;
}

// Define Catalyst HTML5 status.
if( !defined( 'CHILD_ACTIVE' ) )
{
	define( 'CATALYST_HTML_FIVE', true );
}

// Set $catalyst_child_... globals.
$catalyst_child_home = false;

// Change the $catalyst_child_home global variable value to true if a Child Theme Static Homepage should display.
if(	( defined( 'DYNAMIK_ACTIVE' ) && catalyst_get_dynamik_alt( 'dynamik_homepage_type' ) == 'static_home' ) ||
	( defined( 'CHILD_ACTIVE' ) && file_exists( CHILD_ROOT . '/home.php' ) ) )
{
	$catalyst_child_home = true;
}

$catalyst_child_unwritable = false;
$catalyst_child_folders = array( CHILD_ROOT . '/css', CHILD_ROOT . '/css/images', CHILD_ROOT . '/css/images/adminthumbnails', CHILD_ROOT . '/css/tmp', CHILD_ROOT . '/css/tmp/images', CHILD_ROOT . '/css/tmp/images/adminthumbnails' );

// Require necessary function files.
require_once( CATALYST_FUNCTIONS . '/catalyst-functions.php' );
if( is_admin() )
{
	if ( defined( 'DYNAMIK_ACTIVE' ) || defined( 'VANILLA_ACTIVE' ) )
	{
		foreach( $catalyst_child_folders as $catalyst_child_folder )
		{
			if( is_dir( $catalyst_child_folder ) && !is_writable( $catalyst_child_folder ) )
			{
				// Update $catalyst_child_unwritable global
				$catalyst_child_unwritable = true;
			}
		}
	}
}
if( defined( 'DYNAMIK_ACTIVE' ) )
{
	require_once( CATALYST_FUNCTIONS . '/catalyst-dynamik-add-styles.php' );
}
require_once( CATALYST_FUNCTIONS . '/catalyst-hooks.php' );
require_once( CATALYST_FUNCTIONS . '/catalyst-layouts.php' );
require_once( CATALYST_FUNCTIONS . '/catalyst-widget-areas.php' );
require_once( CATALYST_FUNCTIONS . '/catalyst-hook-boxes.php' );
require_once( CATALYST_FUNCTIONS . '/catalyst-body-classes.php' );
require_once( CATALYST_FUNCTIONS . '/catalyst-fonts.php' );
require_once( CATALYST_FUNCTIONS . '/catalyst-option-lists.php' );
require_once( CATALYST_FUNCTIONS . '/catalyst-framework.php' );
require_once( CATALYST_FUNCTIONS . '/catalyst-header.php' );
require_once( CATALYST_FUNCTIONS . '/catalyst-navbars.php' );
require_once( CATALYST_FUNCTIONS . '/catalyst-comments.php' );
require_once( CATALYST_FUNCTIONS . '/catalyst-sidebars.php' );
require_once( CATALYST_FUNCTIONS . '/catalyst-footer.php' );
require_once( CATALYST_FUNCTIONS . '/catalyst-content.php' );
require_once( CATALYST_FUNCTIONS . '/catalyst-meta-box.php' );
require_once( CATALYST_FUNCTIONS . '/catalyst-seo.php' );
require_once( CATALYST_FUNCTIONS . '/catalyst-breadcrumbs.php' );
require_once( CATALYST_SHORTCODES . '/catalyst-content.php' );
require_once( CATALYST_SHORTCODES . '/catalyst-footer.php' );
require_once( CATALYST_WIDGETS . '/catalyst-ad-widget.php' );
require_once( CATALYST_WIDGETS . '/catalyst-author-bio-widget.php' );
require_once( CATALYST_WIDGETS . '/catalyst-excerpt-widget.php' );
require_once( CATALYST_WIDGETS . '/catalyst-php-text-widget.php' );

if( $catalyst_css_builder_popup )
{
	require_once( CATALYST_ADMIN . '/css-builder-popup.php' );
}

// Require files only needed for admin.
if( is_admin() )
{
	require_once( CATALYST_ADMIN . '/build-menu.php' );
	require_once( CATALYST_ADMIN . '/core-options.php' );
	if ( defined( 'DYNAMIK_ACTIVE' ) )
	{
		require_once( CATALYST_ADMIN . '/dynamik-options.php' );
		require_once( CATALYST_FUNCTIONS . '/catalyst-dynamik-build-styles.php' );
	}
	require_once( CATALYST_ADMIN . '/advanced-options.php' );
	require_once( CATALYST_FUNCTIONS . '/catalyst-image-uploader.php' );
	require_once( CATALYST_FUNCTIONS . '/catalyst-update.php' );
	require_once( CATALYST_FUNCTIONS . '/catalyst-import-export.php' );
}

// Run if Catalyst or a Child Theme was just activated.
if( is_admin() && isset( $_GET['activated'] ) && $pagenow == "themes.php" )
{
	catalyst_activate();
}

// ManageWP Premium Theme Update.
add_action( 'init', 'catalyst_premium_update_check' );
if( !function_exists( 'catalyst_premium_update_check' ) )
{
	function catalyst_premium_update_check()
	{
		global $mmb_core;
		if( !empty( $mmb_core ) )
		{
			require_once( CATALYST_FUNCTIONS . '/catalyst-update.php' );
		}
	}
}

//end lib/catalyse.php