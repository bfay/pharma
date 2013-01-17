<?php
/**
 * Builds and filters in body class content.
 *
 * @package Catalyst
 */
 
add_filter( 'body_class', 'catalyst_body_class' );
/**
 * Create an array of body classes that specify which browser
 * is being used to view any given page.
 *
 * @since 1.0
 * @return an array of browser type body classes.
 */
function catalyst_body_class( $c )
{
	$browser = $_SERVER['HTTP_USER_AGENT'];

	if( preg_match( '/Mac/', $browser ) )
		$c[] = 'mac';
	elseif( preg_match( '/Windows/', $browser ) )
		$c[] = 'windows';
	elseif( preg_match( '/Linux/', $browser ) )
		$c[] = 'linux';
	else
		$c[] = 'unknown-os';

	if( preg_match( '/Chrome/', $browser ) )
	{
		$c[] = 'chrome';
	}
	elseif( preg_match( '/Safari/', $browser ) )
	{
		$c[] = 'safari';
		
		preg_match( '/Version\/(\d.\d)/si', $browser, $matches );
		$sf_version = 'sf' . str_replace( '.', '-', $matches[1] );      
		$c[] = $sf_version;
	}
	elseif( preg_match( '/Opera/', $browser ) )
	{
		$c[] = 'opera';
		
		preg_match( '/Opera\/(\d.\d)/si', $browser, $matches );
		$op_version = 'op' . str_replace( '.', '-', $matches[1] );      
		$c[] = $op_version;
	}
	elseif( preg_match( '/MSIE/', $browser ) )
	{
		$c[] = 'msie';
		
		if( preg_match( '/MSIE 6.0/', $browser ) )
				$c[] = 'ie6';
		elseif( preg_match( '/MSIE 7.0/', $browser ) )
				$c[] = 'ie7';
		elseif( preg_match( '/MSIE 8.0/', $browser ) )
				$c[] = 'ie8';
		elseif( preg_match( '/MSIE 9.0/', $browser ) )
				$c[] = 'ie9';
		elseif( preg_match( '/MSIE 10.0/', $browser ) )
				$c[] = 'ie10';
	}	
	elseif( preg_match( '/Firefox/', $browser ) && preg_match( '/Gecko/', $browser ) )
	{
		$c[] = 'firefox';
		
		preg_match( '/Firefox\/(\d)/si', $browser, $matches );
		$ff_version = 'ff' . str_replace( '.', '-', $matches[1] );      
		$c[] = $ff_version;
	}
	else
	{
			$c[] = 'unknown-browser';
	}

	return $c;
}

/**
 * Create an array of body classes to reflect the current
 * Layout being used for any given page.
 *
 * @since 1.0
 * @return an array of layout body classes.
 */
function catalyst_site_layout()
{
	global $catalyst_child_home;
	
	if( is_front_page() && $catalyst_child_home )
	{	
		$site_layout_type = 'home-layout child_home';
	}
	elseif( class_exists( 'BuddyPress' ) && !bp_is_blog_page() )
	{
		if( catalyst_get_core( 'buddypress_layout_type' ) != 'catalyst_default' )
		{
			$site_layout_type = catalyst_get_this_layout_type( catalyst_get_core( 'buddypress_layout_type' ) );
		}
		else
		{
			$site_layout_type = catalyst_get_core( 'site_layout_type' ) . ' catalyst_default';
		}
	}
	elseif( class_exists( 'bbPress' ) && is_bbpress() )
	{
		if( catalyst_get_core( 'bbpress_layout_type' ) != 'catalyst_default' )
		{
			$site_layout_type = catalyst_get_this_layout_type( catalyst_get_core( 'bbpress_layout_type' ) );
		}
		else
		{
			$site_layout_type = catalyst_get_core( 'site_layout_type' ) . ' catalyst_default';
		}
	}
	elseif( class_exists( 'Woocommerce' ) && ( is_woocommerce() || is_cart() || is_checkout() || is_account_page() || is_page( 'order-received' ) || is_page( 'order-tracking' ) ) )
	{
		if( catalyst_get_core( 'woocommerce_layout_type' ) != 'catalyst_default' )
		{
			$site_layout_type = catalyst_get_this_layout_type( catalyst_get_core( 'woocommerce_layout_type' ) );
		}
		else
		{
			$site_layout_type = catalyst_get_core( 'site_layout_type' ) . ' catalyst_default';
		}
	}
	elseif( is_page() || is_single() )
	{
		if( is_page() )
		{
			if( $site_layout_type = catalyst_layout_check() )
			{
				$site_layout_type = $site_layout_type;
			}
			elseif( catalyst_get_core( 'page_layout_type' ) != 'catalyst_default' )
			{
				$site_layout_type = catalyst_get_this_layout_type( catalyst_get_core( 'page_layout_type' ) );
			}
			else
			{
				$site_layout_type = catalyst_get_core( 'site_layout_type' ) . ' catalyst_default';
			}
		}
		elseif( is_single() )
		{
			if( $site_layout_type = catalyst_layout_check() )
			{
				$site_layout_type = $site_layout_type;
			}
			elseif( catalyst_get_core( 'post_layout_type' ) != 'catalyst_default' )
			{
				$site_layout_type = catalyst_get_this_layout_type( catalyst_get_core( 'post_layout_type' ) );
			}
			else
			{
				$site_layout_type = catalyst_get_core( 'site_layout_type' ) . ' catalyst_default';
			}
		}
	}
	elseif ( is_category() || is_tag() || is_tax() )
	{
		global $wp_query;
		
		$term = $wp_query->get_queried_object();
		
		if( is_category() )
		{
			if( $term && !empty( $term->meta['layout'] ) && $term->meta['layout'] != 'catalyst_default' )
			{
				$site_layout_type = catalyst_get_this_layout_type( $term->meta['layout'] );
			}
			elseif( catalyst_get_core( 'category_layout_type' ) != 'catalyst_default' )
			{
				$site_layout_type = catalyst_get_this_layout_type( catalyst_get_core( 'category_layout_type' ) );
			}
			else
			{
				$site_layout_type = catalyst_get_core( 'site_layout_type' ) . ' catalyst_default';
			}
		}
		elseif( is_tag() )
		{
			if( $term && !empty( $term->meta['layout'] ) && $term->meta['layout'] != 'catalyst_default' )
			{
				$site_layout_type = catalyst_get_this_layout_type( $term->meta['layout'] );
			}
			elseif( catalyst_get_core( 'tag_layout_type' ) != 'catalyst_default' )
			{
				$site_layout_type = catalyst_get_this_layout_type( catalyst_get_core( 'tag_layout_type' ) );
			}
			else
			{
				$site_layout_type = catalyst_get_core( 'site_layout_type' ) . ' catalyst_default';
			}
		}
		else
		{
			if( $term && !empty( $term->meta['layout'] ) && $term->meta['layout'] != 'catalyst_default' )
			{
				$site_layout_type = catalyst_get_this_layout_type( $term->meta['layout'] );
			}
			elseif( catalyst_get_core( 'archive_layout_type' ) != 'catalyst_default' )
			{
				$site_layout_type = catalyst_get_this_layout_type( catalyst_get_core( 'archive_layout_type' ) );
			}
			else
			{
				$site_layout_type = catalyst_get_core( 'site_layout_type' ) . ' catalyst_default';
			}
		}
	}
	elseif( is_search() )
	{
		if( catalyst_get_core( 'search_layout_type' ) != 'catalyst_default' )
		{
			$site_layout_type = catalyst_get_this_layout_type( catalyst_get_core( 'search_layout_type' ) );
		}
		else
		{
			$site_layout_type = catalyst_get_core( 'site_layout_type' ) . ' catalyst_default';
		}
	}
	elseif( is_404() )
	{
		if( catalyst_get_core( '404_layout_type' ) != 'catalyst_default' )
		{
			$site_layout_type = catalyst_get_this_layout_type( catalyst_get_core( '404_layout_type' ) );
		}
		else
		{
			$site_layout_type = catalyst_get_core( 'site_layout_type' ) . ' catalyst_default';
		}
	}
	elseif( is_author() )
	{
		$author_layout = get_the_author_meta( 'user_author_archive_layout', (int)get_query_var( 'author' ) );
		if( !empty( $author_layout ) && $author_layout != 'catalyst_default' )
		{
			$site_layout_type = catalyst_get_this_layout_type( $author_layout );
		}
		elseif( catalyst_get_core( 'author_layout_type' ) != 'catalyst_default' )
		{
			$site_layout_type = catalyst_get_this_layout_type( catalyst_get_core( 'author_layout_type' ) );
		}
		else
		{
			$site_layout_type = catalyst_get_core( 'site_layout_type' ) . ' catalyst_default';
		}
	}
	elseif( is_archive() )
	{
		if( catalyst_get_core( 'archive_layout_type' ) != 'catalyst_default' )
		{
			$site_layout_type = catalyst_get_this_layout_type( catalyst_get_core( 'archive_layout_type' ) );
		}
		else
		{
			$site_layout_type = catalyst_get_core( 'site_layout_type' ) . ' catalyst_default';
		}
	}
	else
	{
		$site_layout_type = catalyst_get_core( 'site_layout_type' ) . ' catalyst_default';
	}
	
	return esc_attr( apply_filters( 'catalyst_site_layout', $site_layout_type ) );
}

/**
 * Check to see if a Custom Layout is being used for a given page.
 *
 * @since 1.0
 * @return either the selected Custom Layout or false if none are selected.
 */
function catalyst_layout_check()
{
	global $wp_query;
	
	$this_page = $wp_query->get_queried_object();
	$this_page_id = $this_page->ID;
	$catalyst_layout = get_post_meta( $this_page_id, '_catalyst_layout' );

	if( !empty( $catalyst_layout[0] ) )
	{
		$layout_type = catalyst_get_this_layout_type( $catalyst_layout[0] );
		return $layout_type;
	}
	else
	{
		return false;
	}
}

add_action( 'wp','catalyst_layout_globals' );
/**
 * Create Custom Layout globals.
 *
 * @since 1.0
 */
function catalyst_layout_globals()
{
	global $catalyst_this_layout, $catalyst_layout_info, $catalyst_layout_type, $catalyst_layout_id;
	
	$catalyst_this_layout = catalyst_site_layout();
	$catalyst_layout_info = explode( ' ', $catalyst_this_layout );
	$catalyst_layout_type = $catalyst_layout_info[0];
	$catalyst_layout_id = $catalyst_layout_info[1];
}

add_filter( 'body_class', 'catalyst_add_body_classes' );
/**
 * Create an array of body classes that reflect various Catalyst settings.
 *
 * @since 1.0
 * @return an array of various body classes.
 */
function catalyst_add_body_classes( $classes )
{
	global $catalyst_this_layout, $catalyst_layout_id;
	
	if( $catalyst_layout_id != 'catalyst_default' && $catalyst_layout_id != 'child_home' )
		$classes[] = 'custom-layout';
	
	if( $catalyst_this_layout )
		$classes[] = $catalyst_this_layout;
	
	if( !catalyst_get_core( 'header_right_active' ) )
		$classes[] = 'header-left-full-width';
		
	if( catalyst_get_core( 'logo_type' ) == 'Image' )
		$classes[] = 'logo-image';
		
	if( defined( 'DYNAMIK_ACTIVE' ) )
	{
		if( is_front_page() && catalyst_get_dynamik_alt( 'ez_home_slider_display' ) )
		{
			$classes[] = 'ez-home-slider';
			
			if( catalyst_get_dynamik_alt( 'ez_home_slider_location' ) == 'inside' )
			{
				$classes[] = 'slider-inside';
			}
		}
		
		if( is_front_page() && catalyst_get_dynamik_alt( 'dynamik_homepage_type' ) == 'static_home' &&
			catalyst_get_dynamik_alt( 'ez_homepage_select' ) )
		{
			$home_structure = str_replace( '_', '-', catalyst_get_dynamik_alt( 'ez_homepage_select' ) );
			$classes[] = substr( $home_structure, 0, -4 );
			
			switch ( strlen( catalyst_get_dynamik_alt( 'ez_homepage_select' ) ) )
			{
				case '13':
					switch ( substr( catalyst_get_dynamik_alt( 'ez_homepage_select' ), -5, -4 ) )
					{
						case '1':
							$classes[] = 'home-top-single';
							break;
						case '2':
							$classes[] = 'home-top-double';
							break;
						case '3':
							$classes[] = 'home-top-triple';
							break;
					}
					break;
				case '15':
					switch ( substr( catalyst_get_dynamik_alt( 'ez_homepage_select' ), -7, -6 ) )
					{
						case '1':
							$classes[] = 'home-top-single';
							break;
						case '2':
							$classes[] = 'home-top-double';
							break;
						case '3':
							$classes[] = 'home-top-triple';
							break;
					}
					
					switch ( substr( catalyst_get_dynamik_alt( 'ez_homepage_select' ), -5, -4 ) )
					{
						case '1':
							$classes[] = 'home-bottom-single';
							break;
						case '2':
							$classes[] = 'home-bottom-double';
							break;
						case '3':
							$classes[] = 'home-bottom-triple';
							break;
					}
					break;
				case '17':
					switch ( substr( catalyst_get_dynamik_alt( 'ez_homepage_select' ), -9, -8 ) )
					{
						case '1':
							$classes[] = 'home-top-single';
							break;
						case '2':
							$classes[] = 'home-top-double';
							break;
						case '3':
							$classes[] = 'home-top-triple';
							break;
					}
					
					switch ( substr( catalyst_get_dynamik_alt( 'ez_homepage_select' ), -7, -6 ) )
					{
						case '1':
							$classes[] = 'home-middle-single';
							break;
						case '2':
							$classes[] = 'home-middle-double';
							break;
						case '3':
							$classes[] = 'home-middle-triple';
							break;
					}
					
					switch ( substr( catalyst_get_dynamik_alt( 'ez_homepage_select' ), -5, -4 ) )
					{
						case '1':
							$classes[] = 'home-bottom-single';
							break;
						case '2':
							$classes[] = 'home-bottom-double';
							break;
						case '3':
							$classes[] = 'home-bottom-triple';
							break;
					}
				break;
			}

			if( catalyst_get_dynamik_alt( 'ez_static_home_sb_display' ) )
			{
				$classes[] = 'ez-home-sidebar';
			}
			
			if( catalyst_get_dynamik_alt( 'ez_static_home_sb_location' ) == 'left' )
			{
				$classes[] = 'home-sidebar-left';
			}
		}
		
		if( catalyst_get_dynamik_alt( 'ez_feature_top_select' ) && (
			catalyst_get_dynamik_alt( 'ez_feature_top_display_front_page' ) ||
			catalyst_get_dynamik_alt( 'ez_feature_top_display_posts' ) ||
			catalyst_get_dynamik_alt( 'ez_feature_top_display_pages' ) ||
			catalyst_get_dynamik_alt( 'ez_feature_top_display_archives' ) ||
			catalyst_get_dynamik_alt( 'ez_feature_top_display_blog' ) ||
			catalyst_get_dynamik_alt( 'ez_feature_top_display_blank_content' ) ) )
		{
			$feature_top_structure = str_replace( '_', '-', catalyst_get_dynamik_alt( 'ez_feature_top_select' ) );
			$classes[] = substr( $feature_top_structure, 0, -4 );
		}
		
		if( catalyst_get_dynamik_alt( 'ez_fat_footer_select' ) && (
			catalyst_get_dynamik_alt( 'ez_fat_footer_display_front_page' ) ||
			catalyst_get_dynamik_alt( 'ez_fat_footer_display_posts' ) ||
			catalyst_get_dynamik_alt( 'ez_fat_footer_display_pages' ) ||
			catalyst_get_dynamik_alt( 'ez_fat_footer_display_archives' ) ||
			catalyst_get_dynamik_alt( 'ez_fat_footer_display_blog' ) ||
			catalyst_get_dynamik_alt( 'ez_fat_footer_display_blank_content' ) ) )
		{
			$fat_footer_structure = str_replace( '_', '-', catalyst_get_dynamik_alt( 'ez_fat_footer_select' ) );
			$classes[] = substr( $fat_footer_structure, 0, -4 );
		}
		
		if( catalyst_get_dynamik_alt( 'ez_fat_footer_position' ) == 'outside_footer' )
			$classes[] = 'fat-footer-outside';
	}
	
	if( defined( 'CHILD_ACTIVE' ) )
	{
		global $fat_footer_outside_class;
		
		if( $fat_footer_outside_class )
			$classes[] = 'fat-footer-outside';
	}
	
	if( substr( $catalyst_layout_id, 0, 21 ) == 'catalyst_landing_page' )
		$classes[] = 'landing-page';

	$custom_body_class = is_singular() ? catalyst_get_custom_field( '_catalyst_custom_body_class' ) : null;

	if ( $custom_body_class ) $classes[] = esc_attr( sanitize_html_class( $custom_body_class ) );

	return $classes;
}

//end lib/functions/catalyst-body-classes.php