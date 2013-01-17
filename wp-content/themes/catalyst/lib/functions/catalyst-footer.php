<?php
/**
 * Creates and hooks in the many functions that build
 * the footer structure.
 *
 * @package Catalyst
 */
 
add_filter( 'catalyst_footer_content', 'do_shortcode' );
/**
 * Get the footer content based on the current Core Options settings.
 *
 * @since 1.0
 */
function catalyst_footer_content()
{
	$footer_content = catalyst_get_core( 'footer_content' );
		
	echo apply_filters( 'catalyst_footer_content', $footer_content );
}

add_action ( 'catalyst_hook_footer', 'catalyst_build_footer' );
/**
 * Build the footer content HTML.
 *
 * @since 1.0
 */
function catalyst_build_footer()
{
	global $catalyst_layout_id;
	
	if( substr( $catalyst_layout_id, 0, 21 ) == 'catalyst_landing_page' )
		return;
	
	echo '<div id="footer-wrap">' . "\n";
		echo '<footer id="footer" class="clearfix" role="contentinfo">' . "\n";
			catalyst_hook_in_footer( $catalyst_layout_id . '_catalyst_hook_in_footer' );
			catalyst_footer_content();
		echo "\n" . '</footer>' . "\n";
	echo '</div>' . "\n";
}

add_filter( 'catalyst_footer_scripts', 'do_shortcode' );
add_action( 'wp_footer', 'catalyst_footer_scripts' );
/**
 * Get the footer script content based on both Core Options and In-Post/In-Page options.
 *
 * @since 1.0
 */
function catalyst_footer_scripts()
{
	if( catalyst_get_core( 'footer_scripts' ) || is_singular() && catalyst_get_custom_field( '_catalyst_footer_scripts' ) )
	{
		echo "\n" . '<!-- Begin Catalyst Footer Scripts -->' . "\n";
		echo apply_filters( 'catalyst_footer_scripts', catalyst_get_core( 'footer_scripts' ) );
		
		if( is_singular() )
		{
			echo "\n" . catalyst_get_custom_field( '_catalyst_footer_scripts' );
		}
		
		echo "\n" . '<!-- End Catalyst Footer Scripts -->' . "\n";
	}
}

//end lib/functions/catalyst-footer.php