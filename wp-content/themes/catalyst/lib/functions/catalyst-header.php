<?php
/**
 * Creates and hooks in the many functions that build
 * the <head> and header structure.
 *
 * @package Catalyst
 */

add_action( 'catalyst_doctype', 'catalyst_build_doctype' );
/**
 * Build the Catalyst doctype HTML.
 *
 * @since 1.0
 */
function catalyst_build_doctype()
{
if( catalyst_get_core( 'modernizr_script_active' ) )
{
	$no_js = 'class="no-js" ';
}
else
{
	$no_js = '';
}
?>
<!DOCTYPE HTML>
<html <?php echo $no_js; language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<?php
}

add_action( 'catalyst_doctype', 'catalyst_responsive_viewport', 11 );
/**
 * Add viewport meta tag to the catalyst_doctype
 * to force "real" scale of site when viewed in mobile devices.
 *
 * @since 1.5
 */
function catalyst_responsive_viewport()
{
	if( defined( 'DYNAMIK_ACTIVE' ) && catalyst_get_core( 'dynamik_responsive' ) )
	{
echo '<meta name="viewport" content="' . catalyst_get_responsive( 'viewport_meta_content' ) . '"/>' . "\n";
	}
	else
	{
		return;
	}
}

add_filter( 'wp_title', 'catalyst_site_title_wrap', 20 );
/**
 * Wrap the site title appropriately based on whether or not it is displaying inside a feed.
 *
 * @since 1.0
 * @return wrapped or not wrapped site title.
 */
function catalyst_site_title_wrap( $title )
{
	return is_feed() ? $title : sprintf( "<title>%s</title>\n", $title );
}

add_action( 'catalyst_meta', 'catalyst_favicon', 11 );
/**
 * Display a Custom favicon if one exists with the correct name
 * and in the correct Child Theme images directory.
 *
 * @since 1.0
 */
function catalyst_favicon()
{
    if( defined( 'DYNAMIK_ACTIVE' ) || defined( 'VANILLA_ACTIVE' ) )
    {
        global $catalyst_multisite;
        
        $id = '';
        if( $catalyst_multisite )
        {
            $id = $catalyst_multisite . '/';
        }
        
        if( file_exists( CHILD_ROOT . '/css/images/' . $id . 'favicon.png' ) )
            $fav = CHILD_URL . '/css/images/' . $id . 'favicon.png';
        elseif( file_exists( CHILD_ROOT . '/css/images/' . $id . 'favicon.gif' ) )
            $fav = CHILD_URL . '/css/images/' . $id . 'favicon.gif';
        elseif( file_exists( CHILD_ROOT . '/css/images/' . $id . 'favicon.jpg' ) )
            $fav = CHILD_URL . '/css/images/' . $id . 'favicon.jpg';
        elseif( file_exists( CHILD_ROOT . '/css/images/' . $id . 'favicon.ico' ) )
            $fav = CHILD_URL . '/css/images/' . $id . 'favicon.ico';
        else
            $fav = CATALYST_URL . '/images/favicon.ico';
    }
    else
    {    
        $pre = apply_filters( 'catalyst_pre_load_favicon', false );
    
        if( $pre !== false )
            $fav = $pre;
        elseif( file_exists( CHILD_ROOT . '/images/favicon.ico' ) )
            $fav = CHILD_URL . '/images/favicon.ico';
        elseif( file_exists( CHILD_ROOT . '/images/favicon.png' ) )
            $fav = CHILD_URL . '/images/favicon.png';
        elseif( file_exists( CHILD_ROOT . '/images/favicon.gif' ) )
            $fav = CHILD_URL . '/images/favicon.gif';
        elseif( file_exists( CHILD_ROOT . '/images/favicon.jpg' ) )
            $fav = CHILD_URL . '/images/favicon.jpg';
        else
            $fav = CATALYST_URL . '/images/favicon.ico';
    }

    $fav = apply_filters( 'catalyst_favicon_url', $fav );

    if( $fav )
    echo '<link rel="Shortcut Icon" href="' . esc_url( $fav ) . '" type="image/x-icon" />' . "\n";
}

add_action( 'catalyst_meta', 'catalyst_default_css', 11 );
/**
 * Build the default Catalyst stylesheet link.
 *
 * @since 1.0
 */
function catalyst_default_css()
{
	echo '<link rel="stylesheet" href="' . get_stylesheet_uri() . '" type="text/css" media="screen, projection" />' . "\n";
}

remove_action( 'wp_head', 'feed_links', 2 );
add_action( 'wp_head', 'catalyst_feed_links', 2 );
/**
 * Build custom feed links that can link to custom feeds specified in Core Options.
 *
 * @since 1.0
 */
function catalyst_feed_links($args = array())
{
	$defaults = array(
		/* translators: Separator between blog name and feed type in feed links */
		'separator'	=> _x( '&raquo;', 'feed link' ),
		/* translators: 1: blog title, 2: separator (raquo) */
		'feedtitle'	=> __( '%1$s %2$s Feed' ),
		/* translators: %s: blog title, 2: separator (raquo) */
		'comstitle'	=> __( '%1$s %2$s Comments Feed' ),
	);

	$args = wp_parse_args( $args, $defaults );

	echo '<link rel="alternate" type="' . feed_content_type() . '" title="' . esc_attr(sprintf( $args['feedtitle'], get_bloginfo( 'name' ), $args['separator'] )) . '" href="' . catalyst_rss_link() . "\" />\n";
	echo '<link rel="alternate" type="' . feed_content_type() . '" title="' . esc_attr(sprintf( $args['comstitle'], get_bloginfo( 'name' ), $args['separator'] )) . '" href="' . get_feed_link( 'comments_' . get_default_feed() ) . "\" />\n";
}

add_action( 'wp_head', 'catalyst_meta_pingback', 9 );
/**
 * Build the meta pingback HTML.
 *
 * @since 1.0
 */
function catalyst_meta_pingback()
{
	echo '<link rel="pingback" href="' . get_bloginfo( 'pingback_url' ) . '" />' . "\n";
}

add_action( 'catalyst_meta', 'catalyst_build_deprecated_browser_css' );
/**
 * Get the Custom Catalyst stylesheet content.
 *
 * @since 1.5
 */
function catalyst_build_deprecated_browser_css()
{
	if( defined( 'CATALYST_HTML_FIVE' ) )
		return;
		
	echo '<link rel="stylesheet" href="' . CATALYST_URL . '/lib/css/deprecated-browser.css" type="text/css" media="screen, projection" />' . "\n";
}

add_action( 'wp_head', 'catalyst_build_custom_css', 15 );
/**
 * Get the Custom Catalyst stylesheet content.
 *
 * @since 1.0
 */
function catalyst_build_custom_css()
{
	global $catalyst_css_builder_popup;
	
	if( defined( 'DYNAMIK_ACTIVE' ) && !$catalyst_css_builder_popup )
		return;
	
	$output = '';
    $custom_css = catalyst_get_advanced( 'custom_css' );

	if( $custom_css != '' )
	{
		$output .= $custom_css . "\n";
	}
	
	if( defined( 'DYNAMIK_ACTIVE' ) && catalyst_get_core( 'dynamik_responsive' ) )
	{
		$media_query_css = '
@media only screen and (max-width: ' . catalyst_get_responsive( 'media_wrap_width' ) . 'px) {
' . catalyst_get_responsive( 'media_query_large_cascading_content' ) . '
}
@media only screen and (min-width: 768px) and (max-width: ' . catalyst_get_responsive( 'media_wrap_width' ) . 'px) {
' . catalyst_get_responsive( 'media_query_large_content' ) . '
}
@media only screen and (min-width: 480px) and (max-width: ' . catalyst_get_responsive( 'media_wrap_width' ) . 'px) {
' . catalyst_get_responsive( 'media_query_medium_large_content' ) . '
}
@media only screen and (max-width: 767px) {
' . catalyst_get_responsive( 'media_query_medium_cascading_content' ) . '
}
@media only screen and (min-width: 480px) and (max-width: 767px) {
' . catalyst_get_responsive( 'media_query_medium_content' ) . '
}
@media only screen and (max-width: 479px) {
' . catalyst_get_responsive( 'media_query_small_content' ) . '
}';

		$output = "\n\n<!-- Begin Catalyst Custom CSS -->\n<style id=\"custom-css-echo\" type=\"text/css\">\n" . $output . "</style>\n<!-- End Catalyst Custom CSS -->\n";
		$media_query_css = "\n<!-- Begin Media Query Custom CSS -->\n<style id=\"media-query-custom-css-echo\" type=\"text/css\">" . $media_query_css . "\n</style>\n<!-- End Media Query Custom CSS -->\n\n";
		echo stripslashes( $output . $media_query_css );
	}
	elseif( $output <> '' )
	{
		$output = "\n<!-- Begin Catalyst Custom CSS -->\n<style id=\"custom-css-echo\" type=\"text/css\">\n" . $output . "</style>\n<!-- End Catalyst Custom CSS -->\n";
		echo stripslashes( $output );
	}
}

// Keeps your site from broadcasting its currnet Wordpress version (better security).
remove_action( 'wp_head', 'wp_generator' );

add_action( 'wp_head', 'catalyst_htmlfive_ie_script', 16 );
/**
 * Build the pre-IE9 browser conditional script call for html5 compatibility.
 *
 * @since 1.5
 */
function catalyst_htmlfive_ie_script()
{
	if( catalyst_get_core( 'modernizr_script_active' ) )
		return;
?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/lib/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php
}

add_action( 'catalyst_hook_header_title', 'catalyst_build_header_title' );
/**
 * Build the header title HTML.
 *
 * @since 1.0
 */
function catalyst_build_header_title()
{
	$logo_url = ( catalyst_get_core( 'logo_links_to' ) != 'custom_url' ) ? home_url() : catalyst_get_core( 'alt_logo_link' );
	$logo_title = ( catalyst_get_core( 'logo_links_to' ) != 'custom_url' ) ? get_bloginfo( 'name' ) : catalyst_get_core( 'alt_logo_link_title' );
	if( catalyst_get_core( 'logo_links_to' ) != 'nothing' )
	{
		$content = sprintf( '<a href="%s" title="%s">%s</a>', trailingslashit( $logo_url ), esc_attr( $logo_title ), get_bloginfo( 'name' ) );
	}
	else
	{
		$content = sprintf( '%s', get_bloginfo( 'name' ) );
	}
	$tags = is_home() && catalyst_get_core( 'h1_tag_placement' ) == 'h1_wrap_title' ? 'h1' : 'p';
	$tags = is_home() && !catalyst_get_core( 'h1_tag_placement' ) ? 'h1' : $tags;
	$title = sprintf( '<%s id="title">%s</%s>', $tags, $content, $tags );
	
	echo apply_filters( 'catalyst_header_title', $title, $content, $tags );
}

add_action( 'catalyst_hook_header_tagline', 'catalyst_build_header_tagline' );
/**
 * Build the header tagline HTML.
 *
 * @since 1.0
 */
function catalyst_build_header_tagline()
{
	$content = esc_html ( get_bloginfo( 'description' ) );
	$tags = is_home() && catalyst_get_core( 'h1_tag_placement' ) == 'h1_wrap_tagline' ? 'h1' : 'p';
	$tagline = sprintf( '<%s id="tagline">%s</%s>', $tags, $content, $tags );
	
	echo apply_filters( 'catalyst_header_tagline', $tagline, $content, $tags );
}

add_action( 'catalyst_hook_header', 'catalyst_build_header' );
/**
 * Build the header HTML.
 *
 * @since 1.0
 */
function catalyst_build_header()
{
	global $catalyst_layout_id;
	
	if( substr( $catalyst_layout_id, 0, 21 ) == 'catalyst_landing_page' )
		return;

	echo '<div id="header-wrap">' . "\n";

		echo '<header id="header" role="banner">' . "\n";
			catalyst_hook_in_header( $catalyst_layout_id . '_catalyst_hook_in_header' );
			echo '<div id="header-left">' . "\n";
				catalyst_hook_header_title( $catalyst_layout_id . '_catalyst_hook_header_title' );
				catalyst_hook_header_tagline( $catalyst_layout_id . '_catalyst_hook_header_tagline' );
			echo '</div>' . "\n";
		
			if( catalyst_get_core( 'header_right_active' ) )
			{
				echo '<div id="header-right">' . "\n";
						catalyst_hook_header_right( $catalyst_layout_id . '_catalyst_hook_header_right' );
				echo '</div>' . "\n";
			}
		
		echo '</header>' . "\n";

	echo '</div>' . "\n";
}

add_filter( 'catalyst_header_scripts', 'do_shortcode' );
add_action( 'wp_head', 'catalyst_header_scripts', 20 );
/**
 * Get the header script content based on both Core Options and In-Post/In-Page options.
 *
 * @since 1.0
 */
function catalyst_header_scripts()
{
	if( catalyst_get_core( 'header_scripts' ) || is_singular() && catalyst_get_custom_field( '_catalyst_header_scripts' ) )
	{
		echo "\n" . '<!-- Begin Catalyst Header Scripts -->' . "\n";
		echo apply_filters( 'catalyst_header_scripts', catalyst_get_core( 'header_scripts' ) );
		
		if( is_singular() )
		{
			echo "\n" . catalyst_get_custom_field( '_catalyst_header_scripts' );
		}
		
		echo "\n" . '<!-- End Catalyst Header Scripts -->' . "\n";
	}
}

add_action( 'get_header', 'catalyst_enqueue_scripts' );
/**
 * Enqueue various bits of javascript.
 *
 * @since 1.0
 */
function catalyst_enqueue_scripts()
{
	global $catalyst_css_builder_popup;
	
	if( is_singular() && get_option( 'thread_comments' ) && comments_open() )
		wp_enqueue_script( 'comment-reply' );
		
	if( catalyst_get_core( 'nav1_enable_superfish' ) || catalyst_get_core( 'nav2_enable_superfish' ) )
	{
		if( catalyst_get_core( 'navbar_superfish_arrows' ) )
		{
			wp_enqueue_script( 'superfish', CATALYST_URL . '/lib/js/navbars/superfish.js', array( 'jquery' ), CATALYST_THEME_VERSION, true );
		}
		else
		{
			wp_enqueue_script( 'superfish-noarrows', CATALYST_URL . '/lib/js/navbars/superfish-noarrows.js', array( 'jquery' ), CATALYST_THEME_VERSION, true );
		}
	}
	
	if( $catalyst_css_builder_popup && !is_admin() )
	{
		wp_enqueue_script( 'css-builder-popup', CATALYST_URL . '/lib/js/catalyst-custom-css-builder-popup.js', false, CATALYST_THEME_VERSION, true );
		wp_enqueue_script( 'js-color-popup', CATALYST_URL . '/lib/js/jscolor/jscolor-popup.js', false, CATALYST_THEME_VERSION, true );
		wp_enqueue_script( 'jquery-ui-draggable' );
	}
	
	if( defined( 'DYNAMIK_ACTIVE' ) && catalyst_get_core( 'dynamik_responsive' ) )
	{
		wp_enqueue_script( 'responsive', CATALYST_URL . '/lib/js/catalyst-responsive.js', false, CATALYST_THEME_VERSION, true );
	}
	
	if( catalyst_get_core( 'modernizr_script_active' ) )
	{
		wp_enqueue_script( 'modernizr', CATALYST_URL . '/lib/js/modernizr.min.js', false, CATALYST_THEME_VERSION, false );
	}
	
	if( catalyst_get_core( 'respond_script_active' ) )
	{
		wp_enqueue_script( 'respond', CATALYST_URL . '/lib/js/respond/respond.min.js', false, CATALYST_THEME_VERSION, false );
	}
}

//end lib/functions/catalyst-header.php