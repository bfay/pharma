<?php
/**
 * Builds and adds the shortcodes for the content area.
 *
 * @package Catalyst
 */
 
// byline
add_shortcode( 'byline_author', 'catalyst_byline_author_shortcode' );
/**
 * Build the Catalyst Byline Author shortcode.
 *
 * @since 1.0
 * @return the filtered Catalyst Byline Author HTML.
 */
function catalyst_byline_author_shortcode( $atts )
{
	$defaults = array(
		'before' => '',
		'after' => ''
	);
	$atts = shortcode_atts( $defaults, $atts );

	if( get_the_author_meta( 'author_alt_link', (int) get_query_var( 'author' ) ) == '' )
	{
		ob_start();
		the_author();
		$author = '<a href="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '" rel="author">' . ob_get_clean() . '</a>';
	}
	else
	{
		ob_start();
		the_author();
		$author = '<a href="' . get_the_author_meta( 'author_alt_link', (int) get_query_var( 'author' ) ) . '" rel="author">' . ob_get_clean() . '</a>';
	}
	
	$output = sprintf( '<span class="author vcard">%2$s<span class="fn">%1$s</span>%3$s</span>', $author, $atts['before'], $atts['after'] );
	
	return apply_filters( 'catalyst_byline_author', $output, $atts );
}

add_shortcode( 'byline_date', 'catalyst_byline_date_shortcode' );
/**
 * Build the Catalyst Byline Date shortcode.
 *
 * @since 1.0
 * @return the filtered Catalyst Byline Date HTML.
 */
function catalyst_byline_date_shortcode( $atts )
{
	$defaults = array(
		'format' => get_option('date_format'),
		'before' => '',
		'after' => '',
		'label' => ''
	);
	$atts = shortcode_atts( $defaults, $atts );
	
	$output = sprintf( '<time class="date time published" title="%5$s">%1$s%3$s%4$s%2$s</time> ', $atts['before'], $atts['after'], $atts['label'], get_the_time( $atts['format'] ), get_the_time( 'Y-m-d\TH:i:sO' ) );
	
	return apply_filters( 'catalyst_byline_date', $output, $atts );
}

add_filter( 'byline_zero_comment_text', 'byline_zero_comment_text' );
/**
 * Filter in the byline_zero_comment_text custom text.
 *
 * @since 1.5.1
 */
function byline_zero_comment_text()
{
	return catalyst_get_core( 'byline_zero_comment_text' );
}

add_filter( 'byline_comment_sep_text', 'byline_comment_sep_text' );
/**
 * Filter in the byline_comment_sep_text custom text.
 *
 * @since 1.5.1
 */
function byline_comment_sep_text()
{
	return catalyst_get_core( 'byline_comment_sep_text' );
}

add_shortcode( 'byline_comments', 'catalyst_byline_comments_shortcode' );
/**
 * Build the Catalyst Byline Comments shortcode.
 *
 * @since 1.0
 * @return the filtered Catalyst Byline Comments HTML.
 */
function catalyst_byline_comments_shortcode( $atts )
{
	$defaults = array(
		'zero' => apply_filters( 'byline_zero_comment_text', __( 'Leave a Comment', 'catalyst' ) ),
		'one' => __( '1 Comment', 'catalyst' ),
		'multiple' => __( '% Comments', 'catalyst' ),
		'separator' => ' ' . apply_filters( 'byline_comment_sep_text', __( '&middot;', 'catalyst' ) ) . ' ',
		'before' => '',
		'after' => ''
	);
	$atts = shortcode_atts( $defaults, $atts );
	
	if ( !catalyst_get_core( 'comment_display_posts' ) || !comments_open() )
		return;
	
	ob_start();
	comments_number( $atts['zero'], $atts['one'], $atts['multiple'] );
	$comments = ob_get_clean();
	
	$comments = sprintf( '<a href="%s">%s</a>', get_comments_link(), $comments );

	$output = sprintf( '<span class="post-comments">%2$s%3$s%1$s%4$s</span>', $comments, $atts['separator'], $atts['before'], $atts['after'] );
	
	return apply_filters( 'catalyst_byline_comments', $output, $atts );
}

add_shortcode( 'edit_link', 'catalyst_edit_link_shortcode' );
/**
 * Build the Catalyst Edit Link shortcode.
 *
 * @since 1.0
 * @return the filtered Catalyst Edit Link HTML.
 */
function catalyst_edit_link_shortcode( $atts )
{
	$defaults = array(
		'text' => __( '(Edit)', 'catalyst' ),
		'before' => '',
		'after' => ''
	);
	$atts = shortcode_atts( $defaults, $atts );
	
	ob_start();
	edit_post_link( $atts['text'], $atts['before'], $atts['after'] );
	$edit = ob_get_clean();
	
	$output = $edit;
	
	return apply_filters( 'catalyst_edit_link', $output, $atts );
}

add_filter( 'cat_tag_meta_sep', 'cat_tag_meta_sep' );
/**
 * Filter in the cat_tag_meta_sep custom text.
 *
 * @since 1.5.1
 */
function cat_tag_meta_sep()
{
	return catalyst_get_core( 'cat_tag_meta_sep' );
}

add_filter( 'cat_meta_text', 'cat_meta_text' );
/**
 * Filter in the cat_meta_text custom text.
 *
 * @since 1.5.1
 */
function cat_meta_text()
{
	return catalyst_get_core( 'cat_meta_text' );
}

add_filter( 'tag_meta_text', 'tag_meta_text' );
/**
 * Filter in the tag_meta_text custom text.
 *
 * @since 1.5.1
 */
function tag_meta_text()
{
	return catalyst_get_core( 'tag_meta_text' );
}

//postmeta
add_shortcode( 'post_categories', 'catalyst_post_categories_shortcode' );
/**
 * Build the Catalyst Post Categories shortcode.
 *
 * @since 1.0
 * @return the filtered Catalyst Post Categories HTML.
 */
function catalyst_post_categories_shortcode( $atts )
{
	$defaults = array(
		'sep' => apply_filters( 'cat_tag_meta_sep', __( '-', 'catalyst' ) ) . ' ',
		'before' => apply_filters( 'cat_meta_text', __( 'Categories:', 'catalyst' ) ) . ' ',
		'after' => ''
	);
	$atts = shortcode_atts( $defaults, $atts );
	
	$cats = get_the_category_list( trim( $atts['sep'] ) . ' ' );
	
	$output = sprintf( '<span class="categories">%2$s%1$s%3$s</span> ', $cats, $atts['before'], $atts['after'] );
	
	return apply_filters( 'catalyst_post_categories_shortcode', $output, $atts );
	
}

add_shortcode( 'post_tags', 'catalyst_post_tags_shortcode' );
/**
 * Build the Catalyst Post Tags shortcode.
 *
 * @since 1.0
 * @return the filtered Catalyst Post Tags HTML.
 */
function catalyst_post_tags_shortcode( $atts )
{
	$defaults = array(
		'sep' => apply_filters( 'cat_tag_meta_sep', __( '-', 'catalyst' ) ) . ' ',
		'before' => apply_filters( 'tag_meta_text', __( 'Tags:', 'catalyst' ) ) . ' ',
		'after' => ''
	);
	$atts = shortcode_atts( $defaults, $atts );
	
	$tags = get_the_tag_list( $atts['before'], trim( $atts['sep'] ) . ' ', $atts['after'] );
	
	if ( !$tags ) return;
	
	$output = sprintf( '<span class="tags">%s</span> ', $tags );
	
	return apply_filters( 'catalyst_post_tags_shortcode', $output, $atts );
}

// misc
add_shortcode( 'post_author', 'catalyst_post_author_shortcode' );
/**
 * Build the Catalyst Post Author shortcode.
 *
 * @since 1.0
 * @return the filtered Catalyst Post Author HTML.
 */
function catalyst_post_author_shortcode( $atts )
{
	$defaults = array(
		'before' => '',
		'after' => ''
	);
	$atts = shortcode_atts( $defaults, $atts );

	ob_start();
	the_author();
	$author = ob_get_clean();
	
	$output = sprintf( '<span class="author vcard">%2$s<span class="fn">%1$s</span>%3$s</span>', $author, $atts['before'], $atts['after'] );
	
	return apply_filters( 'catalyst_post_author', $output, $atts );
}

//end lib/shortcodes/catalyst-content.php