<?php
/**
 * Builds and hooks in the Breadcrumbs functionality.
 *
 * @package Catalyst
 */

/**
 * Class to control breadcrumbs display.
 *
 * @since 1.5.2
 */
class Catalyst_Breadcrumbs
{
	/**
	 * Private.
	 */
	var $args = array();

	/**
	 * Cache get_option call. Private.
	 */
	var $on_front;

	/**
	 * Set up cacheable values and settings.
	 *
	 * @since 1.5.2
	 */
	function __construct()
	{
		$this->on_front = get_option( 'show_on_front' );

		$this->args = array(
			'home'						=> apply_filters( 'breadcrumbs_text_home', __( 'Home', 'catalyst' ) ),
			'sep'						=> apply_filters( 'breadcrumbs_text_sep', __( ' &raquo; ', 'catalyst' ) ),
			'list_sep'					=> ', ',
			'prefix'					=> '<div class="breadcrumbs">',
			'suffix'					=> '</div>',
			'heirarchial_attachments'	=> true,
			'heirarchial_categories'	=> true,
			'display'					=> true,
			'labels' => array(
				'prefix'	=> apply_filters( 'breadcrumbs_text_main', __( 'You are here: ', 'catalyst' ) ),
				'author'	=> apply_filters( 'breadcrumbs_text_archives', __( 'Archives for ', 'catalyst' ) ),
				'category'	=> apply_filters( 'breadcrumbs_text_archives', __( 'Archives for ', 'catalyst' ) ),
				'tag'		=> apply_filters( 'breadcrumbs_text_archives', __( 'Archives for ', 'catalyst' ) ),
				'date'		=> apply_filters( 'breadcrumbs_text_archives', __( 'Archives for ', 'catalyst' ) ),
				'search'	=> apply_filters( 'breadcrumbs_text_search', __( 'Search for ', 'catalyst' ) ),
				'tax'		=> apply_filters( 'breadcrumbs_text_archives', __( 'Archives for ', 'catalyst' ) ),
				'post_type'	=> apply_filters( 'breadcrumbs_text_archives', __( 'Archives for ', 'catalyst' ) ),
				'404'		=> apply_filters( 'breadcrumbs_text_404', __( 'Page Not Found', 'catalyst' ) )
			)
		);
	}

	/**
	 * Return the "final product" of the Breadcrubms by wrapping them in HTML markup. Public.
	 *
	 * @since 1.5.2
	 * @return string HTML markup
	 */
	function get_output( $args = array() )
	{
		$this->args = apply_filters( 'catalyst_breadcrumb_args', wp_parse_args( $args, $this->args ) );

		return $this->args['prefix'] . $this->args['labels']['prefix'] . $this->build_crumbs() . $this->args['suffix'];
	}

	/**
	 * Echo the "final product" of the Breadcrubms by wrapping them in HTML markup. Public.
	 *
	 * @since 1.5.2
	 */
	function output( $args = array() )
	{
		echo $this->get_output( $args );
	}

	/**
	 * Return home breadcrumb. Private.
	 *
	 * @since 1.5.2
	 * @return string HTML markup
	 */
	function get_home_crumb()
	{
		$url   = 'page' == $this->on_front ? get_permalink( get_option( 'page_on_front' ) ) : trailingslashit( home_url() );
		$crumb = ( is_home() && is_front_page() ) ? $this->args['home'] : $this->get_breadcrumb_link( $url, sprintf( __( 'View %s', 'catalyst' ), $this->args['home'] ), $this->args['home'] );

		return apply_filters( 'catalyst_home_crumb', $crumb, $this->args );
	}

	/**
	 * Return blog posts page breadcrumb. Private.
	 *
	 * @since 1.5.2
	 * @return string HTML markup
	 */
	function get_blog_crumb()
	{
		$crumb = $this->get_home_crumb();
		if ( 'page' == $this->on_front )
			$crumb = get_the_title( get_option( 'page_for_posts' ) );

		return apply_filters( 'catalyst_blog_crumb', $crumb, $this->args );
	}

	/**
	 * Return search results page breadcrumb. Private.
	 *
	 * @since 1.5.2
	 *
	 * @return string HTML markup
	 */
	function get_search_crumb()
	{
		$crumb = $this->args['labels']['search'] . '"' . esc_html( apply_filters( 'the_search_query', get_search_query() ) ) . '"';

		return apply_filters( 'catalyst_search_crumb', $crumb, $this->args );
	}

	/**
	 * Return 404 breadcrumb. Private.
	 *
	 * @since 1.5.2
	 *
	 * @return string HTML markup
	 */
	function get_404_crumb()
	{
		global $wp_query;

		$crumb = $this->args['labels']['404'];

		return apply_filters( 'catalyst_404_crumb', $crumb, $this->args );
	}

	/**
	 * Return content page breadcrumb. Private.
	 *
	 * @since 1.5.2
	 * @return string HTML markup
	 */
	function get_page_crumb()
	{
		global $wp_query;

		if( 'page' == $this->on_front && is_front_page() )
		{
			$crumb = $this->get_home_crumb();
		}
		else
		{
			$post = $wp_query->get_queried_object();

			if( 0 == $post->post_parent )
			{
				$crumb = get_the_title();
			}
			else
			{
				if( isset( $post->ancestors ) )
				{
					if( is_array( $post->ancestors ) )
						$ancestors = array_values( $post->ancestors );
					else
						$ancestors = array( $post->ancestors );
				}
				else
				{
					$ancestors = array( $post->post_parent );
				}

				$crumbs = array();
				foreach ( $ancestors as $ancestor )
				{
					array_unshift(
						$crumbs,
						$this->get_breadcrumb_link(
							get_permalink( $ancestor ),
							sprintf( __( 'View %s', 'catalyst' ), get_the_title( $ancestor ) ),
							get_the_title( $ancestor )
						)
					);
				}

				$crumbs[] = get_the_title( $post->ID );

				$crumb = join( $this->args['sep'], $crumbs );
			}
		}

		return apply_filters( 'catalyst_page_crumb', $crumb, $this->args );
	}

	/**
	 * Return archive breadcrumb. Private
	 *
	 * @since 1.5.2
	 * @return string HTML markup
	 */
	function get_archive_crumb()
	{
		global $wp_query, $wp_locale;

		if( is_category() )
		{
			$crumb  = $this->args['labels']['category'] . $this->get_term_parents( get_query_var( 'cat' ), 'category' );
		}
		elseif( is_tag() )
		{
			$crumb  = $this->args['labels']['tag'] . single_term_title( '', false );
		}
		elseif( is_tax() )
		{
			$term   = $wp_query->get_queried_object();
			$crumb  = $this->args['labels']['tax'] . $this->get_term_parents( $term->term_id, $term->taxonomy );
		}
		elseif( is_year() )
		{
			$crumb = $this->args['labels']['date'] . get_query_var( 'year' );
		}
		elseif( is_month() )
		{
			$crumb  = $this->get_breadcrumb_link(
				get_year_link( get_query_var( 'year' ) ),
				sprintf( __( 'View archives for %s', 'catalyst' ), get_query_var( 'year' ) ),
				get_query_var( 'year' ),
				$this->args['sep']
			);
			$crumb .= $this->args['labels']['date'] . single_month_title( ' ', false );
		}
		elseif( is_day() )
		{
			$crumb  = $this->get_breadcrumb_link(
				get_year_link( get_query_var( 'year' ) ),
				sprintf( __( 'View archives for %s', 'catalyst' ), get_query_var( 'year' ) ),
				get_query_var( 'year' ),
				$this->args['sep']
			);
			$crumb .= $this->get_breadcrumb_link(
				get_month_link( get_query_var( 'year' ), get_query_var( 'monthnum' ) ),
				sprintf( __( 'View archives for %s %s', 'catalyst' ), $wp_locale->get_month( get_query_var( 'monthnum' ) ), get_query_var( 'year' ) ),
				$wp_locale->get_month( get_query_var( 'monthnum' ) ),
				$this->args['sep']
			);
			$crumb .= $this->args['labels']['date'] . get_query_var( 'day' ) . date( 'S', mktime( 0, 0, 0, 1, get_query_var( 'day' ) ) );
		}
		elseif( is_author() )
		{
			$crumb = $this->args['labels']['author'] . esc_html( $wp_query->queried_object->display_name );
		}
		elseif( is_post_type_archive() )
		{
			$crumb = $this->args['labels']['post_type'] . esc_html( post_type_archive_title( '', false ) );
		}

		return apply_filters( 'catalyst_archive_crumb', $crumb, $this->args );
	}

	/**
	 * Get single breadcrumb, including any parent crumbs. Private.
	 *
	 * @since 1.5.2
	 * @return string HTML markup
	 */
	function get_single_crumb()
	{
		global $post;

		if( is_attachment() )
		{
			$crumb = '';
			if( $this->args['heirarchial_attachments'] )
			{
				$attachment_parent = get_post( $post->post_parent );
				$crumb = $this->get_breadcrumb_link(
					get_permalink( $post->post_parent ),
					sprintf( __( 'View %s', 'catalyst' ), $attachment_parent->post_title ),
					$attachment_parent->post_title,
					$this->args['sep']
				);
			}
			$crumb .= single_post_title( '', false );
		}
		elseif( is_singular( 'post' ) )
		{
			$categories = get_the_category( $post->ID );

			if( 1 == count( $categories ) )
			{
				$crumb = $this->get_term_parents( $categories[0]->cat_ID, 'category', true ) . $this->args['sep'];
			}
			if( count( $categories ) > 1 )
			{
				if( !$this->args['heirarchial_categories'] )
				{
					foreach ( $categories as $category )
					{
						$crumbs[] = $this->get_breadcrumb_link(
							get_category_link( $category->term_id ),
							sprintf( __( 'View all posts in %s', 'catalyst' ), $category->name ),
							$category->name
						);
					}
					$crumb = join( $this->args['list_sep'], $crumbs ) . $this->args['sep'];
				}
				else
				{
					$primary_category_id = get_post_meta( $post->ID, '_category_permalink', true ); /** Support for sCategory Permalink plugin */
					if( $primary_category_id )
					{
						$crumb = $this->get_term_parents( $primary_category_id, 'category', true ) . $this->args['sep'];
					}
					else
					{
						$crumb = $this->get_term_parents( $categories[0]->cat_ID, 'category', true ) . $this->args['sep'];
					}
				}
			}
			$crumb .= single_post_title( '', false );
		}
		else
		{
			$post_type = get_query_var( 'post_type' );
			$post_type_object = get_post_type_object( $post_type );

			if ( $cpt_archive_link = get_post_type_archive_link( $post_type ) )
				$crumb = $this->get_breadcrumb_link( $cpt_archive_link, sprintf( __( 'View all %s', 'catalyst' ), $post_type_object->labels->name ), $post_type_object->labels->name );
			else
				$crumb = $post_type_object->labels->name;

			$crumb .= $this->args['sep'] . single_post_title( '', false );
		}

		return apply_filters( 'catalyst_single_crumb', $crumb, $this->args );
	}

	/**
	 * Return the correct crumbs for this query, combined together. Private.
	 *
	 * @since 1.5.2
	 * @return string HTML markup
	 */
	function build_crumbs()
	{
		$crumbs[] = $this->get_home_crumb();

		if( is_home() )
			$crumbs[] = $this->get_blog_crumb();
		elseif( is_search() )
			$crumbs[] = $this->get_search_crumb();
		elseif( is_404() )
			$crumbs[] = $this->get_404_crumb();
		elseif( is_page() )
			$crumbs[] = $this->get_page_crumb();
		elseif( is_archive() )
			$crumbs[] = $this->get_archive_crumb();
		elseif( is_singular() )
			$crumbs[] = $this->get_single_crumb();

		return join( $this->args['sep'], array_filter( array_unique( $crumbs ) ) );
	}

	/**
	 * Return recursive linked crumbs of category, tag or custom taxonomy parents. Private.
	 *
	 * @since 1.5.2
	 * @return string HTML markup of crumbs
	 */
	function get_term_parents( $parent_id, $taxonomy, $link = false, $visited = array() )
	{
		$parent = &get_term( (int)$parent_id, $taxonomy );

		if( is_wp_error( $parent ) )
			return array();

		if( $parent->parent && ( $parent->parent != $parent->term_id ) && !in_array( $parent->parent, $visited ) )
		{
			$visited[] = $parent->parent;
			$chain[]   = $this->get_term_parents( $parent->parent, $taxonomy, true, $visited );
		}

		if ( $link && !is_wp_error( get_term_link( get_term( $parent->term_id, $taxonomy ), $taxonomy ) ) )
		{
			$chain[] = $this->get_breadcrumb_link( get_term_link( get_term( $parent->term_id, $taxonomy ), $taxonomy ), sprintf( __( 'View all items in %s', 'catalyst' ), $parent->name ), $parent->name );
		}
		else
		{
			$chain[] = $parent->name;
		}

		return join( $this->args['sep'], $chain );
	}

	/**
	 * Return anchor link for a single crumb. Private.
	 *
	 * @since 1.5.2
	 * @return string HTML markup for anchor link and optional separator.
	 */
	function get_breadcrumb_link( $url, $title, $content, $sep = false ) 
	{
		$link = sprintf( '<a href="%s" title="%s">%s</a>', esc_attr( $url ), esc_attr( $title ), esc_html( $content ) );

		if ( $sep )
			$link .= $sep;

		return $link;
	}
}

/**
 * Helper function for the Catalyst Breadcrumb Class.
 *
 * @since 1.5.2
 */
function catalyst_breadcrumb( $args = array() )
{
	global $_catalyst_breadcrumb;

	if( !$_catalyst_breadcrumb )
	{
		$_catalyst_breadcrumb = new Catalyst_Breadcrumbs;
	}

	$_catalyst_breadcrumb->output( $args );
}

add_action( 'catalyst_hook_before_loop', 'catalyst_build_breadcrumbs' );
/**
 * Determine if and when to display the Catalyst breadcrumbs.
 *
 * @since 1.0
 */
function catalyst_build_breadcrumbs()
{
	global $catalyst_layout_id;
	
	if( is_front_page() && !catalyst_get_core( 'breadcrumbs_front_page' ) )
		return;
	if( is_home() && !catalyst_get_core( 'breadcrumbs_pages' ) )
		return;
	if( is_single() && !catalyst_get_core( 'breadcrumbs_posts' ) )
		return;
	if( is_page() && !is_front_page() && !catalyst_get_core( 'breadcrumbs_pages' ) && !is_page_template( 'template-blog.php' ) && !is_page_template( 'template-blank-content.php' ) )
		return;
	if( ( is_archive() || is_search() ) && !catalyst_get_core( 'breadcrumbs_archives' ) )
		return;
	if( is_page_template( 'template-blog.php' ) && !catalyst_get_core( 'breadcrumbs_blog' ) )
		return;
	if( is_page_template( 'template-blank-content.php' ) && !catalyst_get_core( 'breadcrumbs_blank_content' ) )
		return;
	if( is_404() && !catalyst_get_core( 'breadcrumbs_404' ) )
		return;
	if( substr( $catalyst_layout_id, 0, 21 ) == 'catalyst_landing_page' )
		return;

	if( function_exists( 'bcn_display' ) )
	{
		echo '<div class="breadcrumb">';
		bcn_display();
		echo '</div>';
	}
	elseif( function_exists( 'yoast_breadcrumb' ) )
	{
		yoast_breadcrumb( '<div class="breadcrumb">', '</div>' );
	}
	elseif( function_exists( 'breadcrumbs' ) )
	{
		breadcrumbs();
	}
	elseif( function_exists( 'crumbs' ) )
	{
		crumbs();
	}
	else
	{
		catalyst_breadcrumb();
	}
}

add_filter( 'breadcrumbs_text_main', 'breadcrumbs_text_main' );
/**
 * Filter in the breadcrumbs_text_main custom text.
 *
 * @since 1.5.1
 */
function breadcrumbs_text_main()
{
	return catalyst_get_core( 'breadcrumbs_text_main' ) . ' ';
}

add_filter( 'breadcrumbs_text_home', 'breadcrumbs_text_home' );
/**
 * Filter in the breadcrumbs_text_home custom text.
 *
 * @since 1.5.1
 */
function breadcrumbs_text_home()
{
	return catalyst_get_core( 'breadcrumbs_text_home' );
}

add_filter( 'breadcrumbs_text_archives', 'breadcrumbs_text_archives' );
/**
 * Filter in the breadcrumbs_text_archives custom text.
 *
 * @since 1.5.1
 */
function breadcrumbs_text_archives()
{
	return catalyst_get_core( 'breadcrumbs_text_archives' ) . ' ';
}

add_filter( 'breadcrumbs_text_search', 'breadcrumbs_text_search' );
/**
 * Filter in the breadcrumbs_text_search custom text.
 *
 * @since 1.5.1
 */
function breadcrumbs_text_search()
{
	return catalyst_get_core( 'breadcrumbs_text_search' ) . ' ';
}

add_filter( 'breadcrumbs_text_404', 'breadcrumbs_text_404' );
/**
 * Filter in the breadcrumbs_text_404 custom text.
 *
 * @since 1.5.1
 */
function breadcrumbs_text_404()
{
	return catalyst_get_core( 'breadcrumbs_text_404' );
}

add_filter( 'breadcrumbs_text_sep', 'breadcrumbs_text_sep' );
/**
 * Filter in the breadcrumbs_text_sep custom text.
 *
 * @since 1.5.1
 */
function breadcrumbs_text_sep()
{
	return ' ' . catalyst_get_core( 'breadcrumbs_text_sep' ) . ' ';
}