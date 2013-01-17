<?php
/**
 * Builds and adds the shortcodes for the footer content.
 *
 * @package Catalyst
 */
 
add_shortcode( 'left_open', 'catalyst_footer_left_open_shortcode' );
/**
 * Build the Catalyst Footer Left Open shortcode.
 *
 * @since 1.0
 * @return the filtered Catalyst Footer Left Open HTML.
 */
function catalyst_footer_left_open_shortcode()
{
	$footer_left_open = '<p class="footer-content footer-left">';
		
	return apply_filters( 'catalyst_footer_left_open', $footer_left_open );
}

add_shortcode( 'right_open', 'catalyst_footer_right_open_shortcode' );
/**
 * Build the Catalyst Footer Right Open shortcode.
 *
 * @since 1.0
 * @return the filtered Catalyst Footer Right Open HTML.
 */
function catalyst_footer_right_open_shortcode()
{
	$footer_right_open = '<p class="footer-content footer-right">';
		
	return apply_filters( 'catalyst_footer_right_open', $footer_right_open );
}

add_shortcode( 'center_open', 'catalyst_footer_center_open_shortcode' );
/**
 * Build the Catalyst Footer Center Open shortcode.
 *
 * @since 1.0
 * @return the filtered Catalyst Footer Center Open HTML.
 */
function catalyst_footer_center_open_shortcode()
{
	$footer_center_open = '<p class="footer-content footer-center">';
		
	return apply_filters( 'catalyst_footer_center_open', $footer_center_open );
}

add_shortcode( 'close', 'catalyst_footer_p_close_shortcode' );
/**
 * Build the Catalyst Footer P Close shortcode.
 *
 * @since 1.0
 * @return the filtered Catalyst Footer P Close HTML.
 */
function catalyst_footer_p_close_shortcode()
{
	$footer_p_close = '</p>';
		
	return apply_filters( 'catalyst_footer_p_close', $footer_p_close );
}
	
add_shortcode( 'wp_login', 'catalyst_footer_login_shortcode' );
/**
 * Build the Catalyst Footer Login shortcode.
 *
 * @since 1.0
 * @return the filtered Catalyst Footer Login HTML.
 */
function catalyst_footer_login_shortcode()
{
	if( is_user_logged_in() )
		$wp_login = '<a href="' . admin_url() . '">' . __( 'WP Dashboard', 'catalyst' ) . '</a>';
	else
		$wp_login = '<a href="' . admin_url() . '">' . __( 'Admin Login', 'catalyst' ) . '</a>';
		
	return apply_filters( 'catalyst_footer_login', $wp_login );
}

add_shortcode( 'catalyst_attribute', 'catalyst_footer_attribute_shortcode' );
/**
 * Build the Catalyst Footer Attribute shortcode.
 *
 * @since 1.0
 * @return the filtered Catalyst Footer Attribute HTML.
 */
function catalyst_footer_attribute_shortcode()
{
	if( catalyst_get_core( 'affiliate_link' ) != '' )
		$affiliate_link = catalyst_get_core( 'affiliate_link' );
	else
		$affiliate_link = 'http://catalysttheme.com/';	

	$footer_attribute = '<span class="powered-by">' . __( 'Powered by', 'catalyst' ) . ' </span> <span class="catalyst-attribute"><a href="' . $affiliate_link . '" title="Catalyst Premium Wordpress Theme">' . __( 'Catalyst', 'catalyst' ) . '</a></span>';
		
	return apply_filters( 'catalyst_footer_attribute', $footer_attribute );
}

add_shortcode( 'copyright', 'catalyst_footer_copyright_shortcode' );
/**
 * Build the Catalyst Footer Copyright shortcode.
 *
 * @since 1.0
 * @return the filtered Catalyst Footer Copyright HTML.
 */
function catalyst_footer_copyright_shortcode()
{
	$footer_copyright = '<span class="footer-copyright">' . __( 'Copyright', 'catalyst' ) . ' &copy; ' . date( 'Y' ) . ' ' . get_bloginfo( 'name' ) . '</span>';
		
	return apply_filters( 'catalyst_footer_copyright', $footer_copyright );
}

add_shortcode( 'custom_text', 'catalyst_custom_footer_text_shortcode' );
/**
 * Build the Catalyst Footer Text shortcode.
 *
 * @since 1.0
 * @return the filtered Catalyst Footer Text HTML.
 */
function catalyst_custom_footer_text_shortcode()
{
	$custom_footer_text = catalyst_get_core( 'custom_footer_text' );

	$footer_text = '<span class="footer-text">' . $custom_footer_text . '</span>';
		
	return apply_filters( 'catalyst_custom_footer_text', $footer_text );
}

//end lib/shortcodes/catalyst-footer.php