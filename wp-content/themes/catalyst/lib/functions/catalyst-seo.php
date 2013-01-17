<?php
/**
 * Handels all the SEO content that is added to the <head>.
 *
 * @package Catalyst
 */
 
if( catalyst_get_core( 'seo_kill_switch' ) || class_exists( 'All_in_One_SEO_Pack' ) || class_exists( 'HeadSpace_Plugin' ) || class_exists( 'Platinum_SEO_Pack' ) || defined( 'WPSEO_VERSION' ) || defined( 'SU_VERSION' ) )
{
	$catalyst_seo_active = false;
}
else
{
	$catalyst_seo_active = true;
}

add_action( 'init', 'catalyst_if_seo_plugin', 15 );
/**
 * Remove specific Catalyst SEO functionality if the $catalyst_seo_active
 * global variable is true.
 *
 * @since 1.0
 */
function catalyst_if_seo_plugin()
{
	global $catalyst_seo_active;
	
	if( !$catalyst_seo_active )
	{
		remove_filter( 'wp_title', 'catalyst_build_site_title', 10, 3 );
		remove_action( 'catalyst_meta','catalyst_build_seo_description' );
		remove_action( 'catalyst_meta','catalyst_build_seo_keywords' );
		remove_action( 'catalyst_meta','catalyst_build_robots_meta' );
		remove_action( 'wp_head','catalyst_build_canonical_urls' );
	}

	if( function_exists( 'seo_title_tag' ) )
	{
		remove_filter( 'wp_title', 'catalyst_build_site_title', 10, 3 );
		remove_action( 'catalyst_site_title', 'wp_title' );
		add_action( 'catalyst_site_title', 'seo_title_tag' );
	}
}

add_action( 'catalyst_site_title', 'wp_title' );
add_filter( 'wp_title', 'catalyst_build_site_title', 10, 3 );
/**
 * Byild the SEO'afied site title based on settings and location.
 *
 * @since 1.0
 * @return the SEO'afied site title.
 */
function catalyst_build_site_title( $title, $separator, $separator_location )
{
	global $wp_query;
	
	if( is_feed() ) return trim( $title );
	
	$separator = catalyst_get_core( 'title_tag_separator' ) ? catalyst_get_core( 'title_tag_separator' ) : '|';
	$separator_location = catalyst_get_core( 'title_append_location' ) == 'Right' ? 'Right' : 'Left';
	
	if( is_front_page() )
	{
		$title = catalyst_get_core( 'home_title' ) ? catalyst_get_core( 'home_title' ) : get_bloginfo( 'name' );
		$title = catalyst_get_core( 'append_description_title' ) ? $title . " $separator " . get_bloginfo( 'description' ) : $title;
	}
	
	if( is_singular() )
	{	
		// Catalyst
		if( catalyst_get_custom_field( '_catalyst_title' ) )
		{
			$title = catalyst_get_custom_field( '_catalyst_title' );
		}
		// Frugal
		elseif( catalyst_get_custom_field( '_title' ) )
		{
			$title = catalyst_get_custom_field( '_title' );
		}
		// All-In-One SEO
		elseif( catalyst_get_custom_field( '_aioseop_title' ) )
		{
			$title = catalyst_get_custom_field( '_aioseop_title' );
		}
		// Headspace2
		elseif( catalyst_get_custom_field( '_headspace_page_title' ) )
		{
			$title = catalyst_get_custom_field( '_headspace_page_title' );
		}
		// Genesis
		elseif( catalyst_get_custom_field( '_catalyst_title' ) )
		{
			$title = catalyst_get_custom_field( '_catalyst_title' );
		}
		// Thesis
		elseif( catalyst_get_custom_field( 'thesis_title' ) )
		{
			$title = catalyst_get_custom_field( 'thesis_title' );
		}
		// SEO Title Tag
		elseif( catalyst_get_custom_field( 'title_tag' ) )
		{
			$title = catalyst_get_custom_field( 'title_tag' );
		}
		// All-In-One SEO (Old)
		elseif( catalyst_get_custom_field( 'title' ) )
		{
			$title = catalyst_get_custom_field( 'title' );
		}
	}
	
	if( is_category() )
	{
		$term = $wp_query->get_queried_object();
		$title = !empty( $term->meta['doctitle'] ) ? $term->meta['doctitle'] : $title;
	}
	
	if( is_tag() )
	{
		$term = $wp_query->get_queried_object();
		$title = !empty( $term->meta['doctitle'] ) ? $term->meta['doctitle'] : $title;
	}
	
	if( is_tax() )
	{
		$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
		$title = !empty( $term->meta['doctitle'] ) ? wp_kses_stripslashes( wp_kses_decode_entities( $term->meta['doctitle'] ) ) : $title;
	}
	
	if( is_author() )
	{
		$user_title = get_the_author_meta( 'doctitle', (int)get_query_var( 'author' ) );
		$title = $user_title ? $user_title : $title;
	}
	
	if( !catalyst_get_core( 'append_site_name' ) || is_front_page() )
		return esc_html ( trim( $title ) );
	
	$title = $separator_location == 'Right' ? $title . " $separator " . get_bloginfo( 'name' ) : get_bloginfo( 'name' ) . " $separator " . $title;
		return esc_html( trim( $title ) );
}

add_filter( 'get_comment_author_link', 'comment_author_nofollow' );
/**
 * Determine whether or not to nofollow the comment author link.
 *
 * @since 1.0
 * @return follow or nofollow comment author link.
 */
function comment_author_nofollow( $url )
{
	if( catalyst_get_core( 'nofollow_comment_author' ) )
	{
		return $url;
	}
	
	$url = str_replace( "rel='external nofollow'","rel='external'", $url );
	return $url;
}

add_action( 'catalyst_meta','catalyst_build_robots_meta' );
/**
 * Build robots meta info based on Catalyst SEO settings.
 *
 * @since 1.0
 */
function catalyst_build_robots_meta()
{
	global $wp_query, $post;

	if( get_option( 'blog_public' ) == 0 ) return;
	
	$meta = array(
		'noindex' => '',
		'nofollow' => '',
		'noarchive' => catalyst_get_core( 'noarchive_site' ) ? 'noarchive' : ''
	);
	
	if( is_front_page() )
	{
		$meta['noindex'] = catalyst_get_core( 'noindex_home' ) ? 'noindex' : $meta['noindex'];
		$meta['nofollow'] = catalyst_get_core( 'nofollow_home' ) ? 'nofollow' : $meta['nofollow'];
		$meta['noarchive'] = catalyst_get_core( 'noarchive_home' ) ? 'noarchive' : $meta['noarchive'];
	}

	if( is_category() )
	{
		$term = $wp_query->get_queried_object();
		
		$meta['noindex'] = !empty( $term->meta['noindex'] ) ? 'noindex' : $meta['noindex'];
		$meta['nofollow'] = !empty( $term->meta['nofollow'] ) ? 'nofollow' : $meta['nofollow'];
		$meta['noarchive'] = !empty( $term->meta['noarchive'] ) ? 'noarchive' : $meta['noarchive'];
		
		$meta['noindex'] = catalyst_get_core( 'noindex_cats' ) ? 'noindex' : $meta['noindex'];
		$meta['noarchive'] = catalyst_get_core( 'noarchive_cats' ) ? 'noarchive' : $meta['noarchive'];
	}
	
	if( is_tag() )
	{
		$term = $wp_query->get_queried_object();
		
		$meta['noindex'] = !empty( $term->meta['noindex'] ) ? 'noindex' : $meta['noindex'];
		$meta['nofollow'] = !empty( $term->meta['nofollow'] ) ? 'nofollow' : $meta['nofollow'];
		$meta['noarchive'] = !empty( $term->meta['noarchive'] ) ? 'noarchive' : $meta['noarchive'];
		
		$meta['noindex'] = catalyst_get_core( 'noindex_tags' ) ? 'noindex' : $meta['noindex'];
		$meta['noarchive'] = catalyst_get_core( 'noarchive_tags' ) ? 'noarchive' : $meta['noarchive'];
	}
	
	if( is_tax() )
	{
		$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
		
		$meta['noindex'] = !empty( $term->meta['noindex'] ) ? 'noindex' : $meta['noindex'];
		$meta['nofollow'] = !empty( $term->meta['nofollow'] ) ? 'nofollow' : $meta['nofollow'];
		$meta['noarchive'] = !empty( $term->meta['noarchive'] ) ? 'noarchive' : $meta['noarchive'];
	}
	
	if( is_author() )
	{
		$meta['noindex'] = get_the_author_meta( 'noindex', (int) get_query_var( 'author' ) ) ? 'noindex' : $meta['noindex'];
		$meta['nofollow'] = get_the_author_meta( 'nofollow', (int) get_query_var( 'author' ) ) ? 'nofollow' : $meta['nofollow'];
		$meta['noarchive'] = get_the_author_meta( 'noarchive', (int) get_query_var( 'author' ) ) ? 'noarchive' : $meta['noarchive'];
		
		$meta['noindex'] = catalyst_get_core( 'noindex_authors' ) ? 'noindex' : $meta['noindex'];
		$meta['noarchive'] = catalyst_get_core( 'noarchive_authors' ) ? 'noarchive' : $meta['noarchive'];
	}
	
	if( is_date() || is_search() )
	{
		$meta['noindex'] = catalyst_get_core( 'noindex_archives' ) ? 'noindex' : $meta['noindex'];
		$meta['noarchive'] = catalyst_get_core( 'noarchive_archives' ) ? 'noarchive' : $meta['noarchive'];
	}

	if( is_singular() )
	{
		$meta['noindex'] = catalyst_get_custom_field( '_catalyst_noindex' ) ? 'noindex' : $meta['noindex'];
		$meta['nofollow'] = catalyst_get_custom_field( '_catalyst_nofollow' ) ? 'nofollow' : $meta['nofollow'];
		$meta['noarchive'] = catalyst_get_custom_field( '_catalyst_noarchive' ) ? 'noarchive' : $meta['noarchive'];
	}
		
	if( empty( $meta['noindex'] ) && empty( $meta['nofollow'] ) && empty( $meta['noarchive'] ) )
		return;

	printf( '<meta name="robots" content="%s" />' . "\n", implode( ",", array_filter( $meta ) ) );
}

add_action( 'catalyst_meta', 'catalyst_build_seo_description' );
/**
 * Build Catalyst SEO description HTML.
 *
 * @since 1.0
 */
function catalyst_build_seo_description()
{
	global $wp_query, $post;
	
	$description = '';
	
	if( is_front_page() )
	{
		$description = catalyst_get_core( 'home_description' ) ? catalyst_get_core( 'home_description' ) : get_bloginfo( 'description' );
	}
	
	if( is_singular() )
	{
		// Catalyst
		if( catalyst_get_custom_field( '_catalyst_description' ) )
		{
			$description = catalyst_get_custom_field( '_catalyst_description' );
		}
		// Frugal
		elseif( catalyst_get_custom_field( '_description' ) )
		{
			$description = catalyst_get_custom_field( '_description' );
		}
		// All-In-One SEO
		elseif( catalyst_get_custom_field( '_aioseop_description' ) )
		{
			$description = catalyst_get_custom_field( '_aioseop_description' );
		}
		//Headspace2
		elseif( catalyst_get_custom_field( '_headspace_description' ) )
		{
			$description = catalyst_get_custom_field( '_headspace_description' );
		}
		// Genesis
		elseif( catalyst_get_custom_field( '_catalyst_description' ) )
		{
			$description = catalyst_get_custom_field( '_catalyst_description' );
		}
		// Thesis
		elseif( catalyst_get_custom_field( 'thesis_description' ) )
		{
			$description = catalyst_get_custom_field( 'thesis_description' );
		}
		// All-In-One SEO (Old)
		elseif( catalyst_get_custom_field( 'description' ) )
		{
			$description = catalyst_get_custom_field( 'description' );
		}
	}

	if( is_category() )
	{
		$term = $wp_query->get_queried_object();
		$description = !empty( $term->meta['description'] ) ? $term->meta['description'] : '';
	}
	
	if( is_tag() )
	{
		$term = $wp_query->get_queried_object();
		$description = !empty( $term->meta['description'] ) ? $term->meta['description'] : '';
	}

	if( is_tax() )
	{
		$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
		$description = !empty( $term->meta['description'] ) ? wp_kses_stripslashes( wp_kses_decode_entities( $term->meta['description'] ) ) : '';
	}
	
	if( is_author() )
	{
		$user_description = get_the_author_meta( 'meta_description', (int)get_query_var( 'author' ) );
		$description = $user_description ? $user_description : '';
	}
	
	if( !empty( $description ) )
	{
		echo '<meta name="description" content="' . esc_attr( stripslashes( $description ) ) . '" />' . "\n";
	}
}

add_action( 'catalyst_meta', 'catalyst_build_seo_keywords' );
/**
 * Build Catalyst SEO keywords HTML.
 *
 * @since 1.0
 */
function catalyst_build_seo_keywords()
{
	global $wp_query, $post;

	$keywords = '';
	
	if( is_front_page() )
	{
		$keywords = catalyst_get_core( 'home_keywords' );
	}
	
	if( is_singular() )
	{
		// Catalyst
		if( catalyst_get_custom_field( '_catalyst_keywords' ) )
		{
			$keywords = catalyst_get_custom_field( '_catalyst_keywords' );
		}
		// Frugal
		elseif( catalyst_get_custom_field( '_keywords' ) )
		{
			$keywords = catalyst_get_custom_field( '_keywords' );
		}
		// All-In-One SEO
		elseif( catalyst_get_custom_field( '_aioseop_keywords' ) )
		{
			$keywords = catalyst_get_custom_field( '_aioseop_keywords' );
		}
		// Genesis
		elseif( catalyst_get_custom_field( '_catalyst_keywords' ) )
		{
			$keywords = catalyst_get_custom_field( '_catalyst_keywords' );
		}
		// Thesis
		elseif( catalyst_get_custom_field( 'thesis_keywords' ) )
		{
			$keywords = catalyst_get_custom_field( 'thesis_keywords' );
		}
		// All-In-One SEO (Old)
		elseif( catalyst_get_custom_field( 'keywords' ) )
		{
			$keywords = catalyst_get_custom_field( 'keywords' );
		}
	}
	
	if( is_category() )
	{
		$term = $wp_query->get_queried_object();
		$keywords = !empty( $term->meta['keywords'] ) ? $term->meta['keywords'] : '';
	}
	
	if( is_tag() )
	{
		$term = $wp_query->get_queried_object();
		$keywords = !empty( $term->meta['keywords'] ) ? $term->meta['keywords'] : '';
	}
	
	if( is_tax() )
	{
		$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
		$keywords = !empty( $term->meta['keywords'] ) ? wp_kses_stripslashes( wp_kses_decode_entities( $term->meta['keywords'] ) ) : '';
	}
	
	if( is_author() )
	{
		$user_keywords = get_the_author_meta( 'meta_keywords', (int)get_query_var( 'author' ) );
		$keywords = $user_keywords ? $user_keywords : '';
	}

	if( empty( $keywords ) )
		return;
	
	echo '<meta name="keywords" content="' . esc_attr( $keywords ) . '" />' . "\n";
}

if( $catalyst_seo_active )
{
	remove_action( 'wp_head', 'rel_canonical' );
}
add_action( 'wp_head','catalyst_build_canonical_urls' );
/**
 * Build canonical url HTML based on Catalyst SEO settings.
 *
 * @since 1.0
 */
function catalyst_build_canonical_urls()
{
	global $wp_query;
	
	$canonical = '';
	
	if( is_front_page() )
	{
		$canonical = trailingslashit( home_url() );
	}
		
	if( is_singular() )
	{
		if( !$id = $wp_query->get_queried_object_id() )
			return;
		
		$canonical = get_permalink( $id );
	}
	
	if( is_category() || is_tag() || is_tax() )
	{
		if( !$id = $wp_query->get_queried_object_id() )
			return;
			
		$taxonomy = $wp_query->queried_object->taxonomy;
		
		$canonical = catalyst_get_core( 'canonical_archives' ) ? get_term_link( (int)$id, $taxonomy ) : 0;
	}
	
	if( is_author() )
	{
		if( !$id = $wp_query->get_queried_object_id() )
			return;
		
		$canonical = catalyst_get_core( 'canonical_archives' ) ? get_author_posts_url( $id ) : 0;
	}
	
	if( !$canonical ) return;
		
	printf( '<link rel="canonical" href="%s" />'."\n", esc_url( $canonical ) );
}

//end lib/functions/catalyst-seo.php