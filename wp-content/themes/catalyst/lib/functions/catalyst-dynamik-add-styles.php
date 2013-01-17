<?php
/**
 * Enqueue's the Dynamik stylesheets.
 *
 * Note: This file is only called in if the
 * Dynamik Child Theme is active.
 *
 * @package Catalyst
 */
 
/**
 * Get the stylesheet location based on the type of stylesheet.
 *
 * @since 1.0
 * @return the stylesheet location.
 */
function catalyst_get_stylesheet_location( $type )
{      
    $dir = ( 'url' == $type) ? CHILD_URL : CHILD_ROOT;
    $location = $dir . '/css/';
    return apply_filters( 'catalyst_get_stylesheet_location', $location );
}

/**
 * Get the stylesheet name based on the name value passed into the function.
 *
 * @since 1.0
 * @return the stylesheet name.
 */
function catalyst_get_stylesheet_name( $slug='stylesheet' )
{
    global $catalyst_multisite;
    
	$id = '';
	if( $catalyst_multisite )
	{
        $id = '-' . $catalyst_multisite;
    }
	
    return apply_filters( 'catalyst_get_stylesheet_name', $slug . $id . '.css' );
}

/**
 * Get the Dynamik stylesheet name.
 *
 * @since 1.0
 * @return the Dynamik stylesheet name.
 */
function catalyst_get_dynamik_stylesheet_name()
{
    return apply_filters( 'catalyst_get_dynamik_stylesheet_name', catalyst_get_stylesheet_name( 'dynamik' ) );
}

/**
 * Get the minified Dynamik stylesheet name.
 *
 * @since 1.0
 * @return the minified Dynamik stylesheet name.
 */
function catalyst_get_minified_stylesheet_name()
{
    return apply_filters( 'catalyst_get_minified_stylesheet_name', catalyst_get_stylesheet_name( 'dynamik-min' ) );
}

/**
 * Get the Custom stylesheet name.
 *
 * @since 1.3
 * @return the Custom stylesheet name.
 */
function catalyst_get_custom_stylesheet_name()
{
    return apply_filters( 'catalyst_get_custom_stylesheet_name', catalyst_get_stylesheet_name( 'catalyst-custom' ) );
}

/**
 * Get the Dynamik stylesheet path.
 *
 * @since 1.0
 * @return the Dynamik stylesheet path.
 */
function catalyst_get_dynamik_stylesheet_path()
{
    return apply_filters( 'catalyst_get_dynamik_stylesheet_path', catalyst_get_stylesheet_location( 'path' ) . catalyst_get_dynamik_stylesheet_name() );
}

/**
 * Get the minified Dynamik stylesheet path.
 *
 * @since 1.0
 * @return the minified Dynamik stylesheet path.
 */
function catalyst_get_minified_stylesheet_path()
{
    return apply_filters( 'catalyst_get_minified_stylesheet_path', catalyst_get_stylesheet_location( 'path' ) . catalyst_get_minified_stylesheet_name() );
}

/**
 * Get the Custom stylesheet path.
 *
 * @since 1.3
 * @return the Custom stylesheet path.
 */
function catalyst_get_custom_stylesheet_path()
{
    return apply_filters( 'catalyst_get_custom_stylesheet_path', catalyst_get_stylesheet_location( 'path' ) . catalyst_get_custom_stylesheet_name() );
}

/**
 * Get the Dynamik stylesheet url.
 *
 * @since 1.0
 * @return the Dynamik stylesheet url.
 */
function catalyst_get_dynamik_stylesheet_url() {
    return apply_filters( 'catalyst_get_dynamik_stylesheet_url', catalyst_get_stylesheet_location( 'url' ) . catalyst_get_dynamik_stylesheet_name() );
}

/**
 * Get the minified Dynamik stylesheet url.
 *
 * @since 1.0
 * @return the minified Dynamik stylesheet url.
 */
function catalyst_get_minified_stylesheet_url() {
    return apply_filters( 'catalyst_get_minified_stylesheet_url', catalyst_get_stylesheet_location( 'url' ) . catalyst_get_minified_stylesheet_name() );
}

/**
 * Get the Custom stylesheet url.
 *
 * @since 1.3
 * @return the Custom stylesheet url.
 */
function catalyst_get_custom_stylesheet_url() {
    return apply_filters( 'catalyst_get_custom_stylesheet_url', catalyst_get_stylesheet_location( 'url' ) . catalyst_get_custom_stylesheet_name() );
}

add_action( 'template_redirect', 'catalyst_add_stylesheets' );
/**
 * Determine which stylesheet should be displayed and where
 * based on the Dynamik options.
 *
 * @since 1.0
 */
function catalyst_add_stylesheets()
{
	global $catalyst_css_builder_popup;
	
    if( !catalyst_get_dynamik_alt( 'minify_css' ) || $catalyst_css_builder_popup )
	{
		if( file_exists( catalyst_get_dynamik_stylesheet_path() ) )
		{
			wp_enqueue_style( 'catalyst_dynamik_stylesheet', catalyst_get_dynamik_stylesheet_url(), false, filemtime( catalyst_get_dynamik_stylesheet_path() ) );
		}
		if( catalyst_get_advanced( 'custom_css' ) != '' && file_exists( catalyst_get_custom_stylesheet_path() ) && !$catalyst_css_builder_popup )
		{
			wp_enqueue_style( 'catalyst_custom_stylesheet', catalyst_get_custom_stylesheet_url(), false, filemtime( catalyst_get_custom_stylesheet_path() ) );
		}
		remove_action( 'catalyst_meta', 'catalyst_default_css', 11 );
    }
    elseif( catalyst_get_dynamik_alt( 'minify_css' ) )
	{
		if( file_exists( catalyst_get_minified_stylesheet_path() ) )
		{
			wp_enqueue_style( 'catalyst_minified_stylesheet', catalyst_get_minified_stylesheet_url(), false, filemtime( catalyst_get_minified_stylesheet_path() ) );
		}
		remove_action( 'catalyst_meta', 'catalyst_default_css', 11 );
    }
}

//end lib/functions/catalyst-dynamik-add-styles.php