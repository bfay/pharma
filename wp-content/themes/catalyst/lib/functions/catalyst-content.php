<?php
/**
 * Builds and hooks in all the main Content functions.
 *
 * @package Catalyst
 */
 
if( function_exists( 'add_theme_support' ) )
{
	add_theme_support( 'post-thumbnails' );
}
if( function_exists( 'add_image_size' ) )
{
	if( catalyst_get_core( 'custom_image_sizes' ) )
	{
		foreach( catalyst_get_core( 'custom_image_sizes' ) as $custom_image_size )
		{
			if( !empty( $custom_image_size['mode'] ) && !empty( $custom_image_size['width'] ) && !empty( $custom_image_size['height'] ) )
			{
				if( $custom_image_size['mode'] == 'crop' ) { $crop = true; } else { $crop = false; }
				add_image_size( $custom_image_size['name'], $custom_image_size['width'], $custom_image_size['height'], $crop );
			}
		}
	}
}

/**
 * Get any additional thumbnail images sizes that have been added.
 *
 * @since 1.0
 * @return additional thumbnail images sizes if any exist, otherwise an empty array.
 */
function catalyst_get_additional_image_sizes()
{
	global $_wp_additional_image_sizes;
	
	if( $_wp_additional_image_sizes )
		return $_wp_additional_image_sizes;

	return array();
}

/**
 * Get the current image size settings found in Settings > Media.
 *
 * @since 1.0
 * @return the values of the current image size settings found in Settings > Media.
 */
function catalyst_get_image_sizes()
{
	$builtin_sizes = array(
		'thumbnail'	=> array(
			'width' => get_option( 'thumbnail_size_w' ),
			'height' => get_option( 'thumbnail_size_h' )
		),
		'medium'	=> array(
			'width' => get_option( 'medium_size_w' ),
			'height' => get_option( 'medium_size_h' )
		),
		'large'		=> array(
			'width' => get_option( 'large_size_w' ),
			'height' => get_option( 'large_size_h' )
		)
	);
	
	$additional_sizes = catalyst_get_additional_image_sizes();
	
	return array_merge( $builtin_sizes, $additional_sizes );
}

/******************************
	Build Content Loops
******************************/

add_action( 'catalyst_hook_post_loop', 'catalyst_build_loop' );
/**
 * Build/call to the different types of Catalyst content.
 *
 * @since 1.0
 */
function catalyst_build_loop()
{
	if( !is_archive() && !is_search() )
	{
		$featured_post_number = catalyst_get_core( 'default_content_featured_post_number' );
		$hybrid_excerpt_type = catalyst_get_core( 'default_content_hybrid_excerpt_type' );
	}
	else
	{
		$featured_post_number = catalyst_get_core( 'archive_content_featured_post_number' );
		$hybrid_excerpt_type = catalyst_get_core( 'archive_content_hybrid_excerpt_type' );
	}
	
	if( !is_page_template( 'template-blog.php' ) && !is_page_template( 'template-archive.php' ) && !is_page_template( 'template-blank-content.php' ) && !is_404() )
	{
		if( !is_page() && !is_single() &&
			( ( !is_archive() && !is_search() && catalyst_get_core( 'default_content_type' ) == "Hybrid" ) ||
			( is_archive() && catalyst_get_core( 'archive_content_type' ) == "Hybrid" ) ||
			( is_search() && catalyst_get_core( 'archive_content_type' ) == "Hybrid" ) ) )
		{
			catalyst_hybrid_loop( array(
				'loop' => 'standard',
				'features' => $featured_post_number,
				'excerpt_type' => $hybrid_excerpt_type
			) );
		}
		else
		{
			catalyst_standard_loop();
		}
	}
	elseif( is_page_template( 'template-blog.php' ) )
	{
		$include = catalyst_get_core( 'blog_cat_display' );
		$exclude = catalyst_get_core( 'blog_exclude_cats' ) ? explode( ',', str_replace( ' ', '', catalyst_get_core( 'blog_exclude_cats' ) ) ) : '';
		$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
		
		$args = array( 'cat' => $include, 'category__not_in' => $exclude, 'showposts' => catalyst_get_core( 'blog_post_number' ), 'paged' => $paged );
		
		if( catalyst_get_core( 'default_content_type' ) == "Hybrid" )
		{
			catalyst_hybrid_loop( array(
				'loop' => 'custom',
				'features' => $featured_post_number,
				'excerpt_type' => $hybrid_excerpt_type,
				'cat' => $include,
				'category__not_in' => $exclude,
				'showposts' => catalyst_get_core( 'blog_post_number' )
			) );
		}
		else
		{
			catalyst_custom_loop( $args );
		}
	}
	elseif( is_page_template( 'template-archive.php' ) )
	{
		catalyst_archive_loop();
	}
	elseif( is_page_template( 'template-blank-content.php' ) )
	{
		catalyst_blank_content_loop();
	}
	elseif( is_404() )
	{
		catalyst_404_loop();
	}
}

/**
 * Build the Catalyst standeard loop structure.
 *
 * @since 1.0
 */
function catalyst_standard_loop()
{
	global $catalyst_layout_id, $catalyst_loop_count;
	$catalyst_loop_count = 0; ?>
	
	<?php if( have_posts() ) : while( have_posts() ) : the_post();
	$catalyst_loop_count++; ?>
	
	<?php catalyst_hook_before_post( $catalyst_layout_id . '_catalyst_hook_before_post' ); ?>
	
	<article <?php post_class(); ?>>
	
		<header class="entry-header">
			<?php catalyst_hook_before_post_title( $catalyst_layout_id . '_catalyst_hook_before_post_title' ); ?>
			<?php catalyst_hook_post_title( $catalyst_layout_id . '_catalyst_hook_post_title' ); ?>
			<?php catalyst_hook_after_post_title( $catalyst_layout_id . '_catalyst_hook_after_post_title' ); ?>
		</header>
		
		<?php catalyst_hook_before_post_content( $catalyst_layout_id . '_catalyst_hook_before_post_content' ); ?>
		<div class="entry-content">
		<?php catalyst_hook_post_content( $catalyst_layout_id . '_catalyst_hook_post_content' ); ?>
		</div>
		<?php catalyst_hook_after_post_content( $catalyst_layout_id . '_catalyst_hook_after_post_content' ); ?>
		
	</article>
		
	<?php catalyst_hook_after_post( $catalyst_layout_id . '_catalyst_hook_after_post' ); ?>

	<?php
	endwhile;
		catalyst_hook_after_endwhile( $catalyst_layout_id . '_catalyst_hook_after_endwhile' );
	else:
		catalyst_hook_loop_else( $catalyst_layout_id . '_catalyst_hook_loop_else' );
	endif;
}

/**
 * Build the Catalyst custom loop structure.
 *
 * @since 1.0
 */
function catalyst_custom_loop( $args = array() )
{
	global $wp_query, $more, $catalyst_layout_id, $catalyst_loop_count;
	$catalyst_loop_count = 0;
	
	$defaults = array();
	$args = apply_filters( 'catalyst_custom_loop_args', wp_parse_args( $args, $defaults ), $args, $defaults );	
	$save_query = $wp_query;
	$wp_query = new WP_Query( $args );
	
	if( $wp_query->have_posts() ) : while( $wp_query->have_posts() ) : $wp_query->the_post();
	$catalyst_loop_count++;
	$more = 0; ?>

	<?php catalyst_hook_before_post( $catalyst_layout_id . '_catalyst_hook_before_post' ); ?>
	
	<article <?php post_class(); ?>>
	
		<header class="entry-header">
			<?php catalyst_hook_before_post_title( $catalyst_layout_id . '_catalyst_hook_before_post_title' ); ?>
			<?php catalyst_hook_post_title( $catalyst_layout_id . '_catalyst_hook_post_title' ); ?>
			<?php catalyst_hook_after_post_title( $catalyst_layout_id . '_catalyst_hook_after_post_title' ); ?>
		</header>
		
		<?php catalyst_hook_before_post_content( $catalyst_layout_id . '_catalyst_hook_before_post_content' ); ?>
		<div class="entry-content">
		<?php catalyst_hook_post_content( $catalyst_layout_id . '_catalyst_hook_post_content' ); ?>
		</div>
		<?php catalyst_hook_after_post_content( $catalyst_layout_id . '_catalyst_hook_after_post_content' ); ?>
		
	</article>
	
	<?php catalyst_hook_after_post( $catalyst_layout_id . '_catalyst_hook_after_post' );

	endwhile;
		catalyst_hook_after_endwhile( $catalyst_layout_id . '_catalyst_hook_after_endwhile' );
	else:
		catalyst_hook_loop_else( $catalyst_layout_id . '_catalyst_hook_loop_else' );
	endif;
	
	$wp_query = $save_query; wp_reset_query();
}

/**
 * Build the Catalyst archive loop structure.
 *
 * @since 1.0
 */
function catalyst_archive_loop()
{
	global $catalyst_layout_id;
?>
	<article <?php post_class(); ?>>
	
		<header class="entry-header">
			<?php catalyst_hook_before_post_title( $catalyst_layout_id . '_catalyst_hook_before_post_title' ); ?>
			<?php catalyst_hook_post_title( $catalyst_layout_id . '_catalyst_hook_post_title' ); ?>
			<?php catalyst_hook_after_post_title( $catalyst_layout_id . '_catalyst_hook_after_post_title' ); ?>
		</header>
		
		<div class="entry-content">
			<div class="archive-template">
				<h4><?php _e("Authors:", 'catalyst' ); ?></h4>
				<ul>
					<?php wp_list_authors( 'exclude_admin=0&optioncount=1' ); ?>   
				</ul>

				<h4><?php _e("Monthly:", 'catalyst' ); ?></h4>
				<ul>
					<?php wp_get_archives( 'type=monthly' ); ?>
				</ul>

				<h4><?php _e("Recent Posts:", 'catalyst' ); ?></h4>
				<ul>
					<?php wp_get_archives( 'type=postbypost&limit=100' ); ?> 
				</ul>    
			</div>

			<div class="archive-template">
				<h4><?php _e("Pages:", 'catalyst' ); ?></h4>
				<ul>
					<?php wp_list_pages( 'title_li=' ); ?>
				</ul>

				<h4><?php _e("Categories:", 'catalyst' ); ?></h4>
				<ul>
					<?php wp_list_categories( 'sort_column=name&title_li=' ); ?>
				</ul>
			</div>
		</div>
		
		<div style="clear:both;"></div>
	</article>
<?php
}

/**
 * Build the Catalyst Blank Content structure.
 *
 * @since 1.0
 */
function catalyst_blank_content_loop()
{
	global $catalyst_layout_id;

	catalyst_hook_blank_content( $catalyst_layout_id . '_catalyst_hook_blank_content' );
}

/**
 * Build the Catalyst 404 page structure.
 *
 * @since 1.0
 */
function catalyst_404_loop()
{
?>
	<article class="page">

		<header class="entry-header">
			<h1 class="entry-title"><?php _e( 'Page Not Found', 'catalyst' ); ?></h1>
		</header>
		
		<div class="entry-content">
			<p><?php _e( 'The page you are looking for is not here. You can try a Search, use the Site Navigation or', 'catalyst' ); ?>
			<a href="<?php echo get_option( 'home' ) ?>"><?php _e( 'return to the homepage', 'catalyst' ); ?></a>
			<?php _e( 'and try again.', 'catalyst' ); ?></p>
			
			<?php if( catalyst_get_core( 'fourofour_page_content_sitemap' ) ) { ?>
				<p><?php _e( 'You may also find what you\'re looking for below.', 'catalyst' ); ?></p>
				
				<div class="archive-template">
					<h4><?php _e("Authors:", 'catalyst' ); ?></h4>
					<ul>
						<?php wp_list_authors( 'exclude_admin=0&optioncount=1' ); ?>   
					</ul>

					<h4><?php _e("Monthly:", 'catalyst' ); ?></h4>
					<ul>
						<?php wp_get_archives( 'type=monthly' ); ?>
					</ul>

					<h4><?php _e("Recent Posts:", 'catalyst' ); ?></h4>
					<ul>
						<?php wp_get_archives( 'type=postbypost&limit=100' ); ?> 
					</ul>    
				</div>

				<div class="archive-template">
					<h4><?php _e("Pages:", 'catalyst' ); ?></h4>
					<ul>
						<?php wp_list_pages( 'title_li=' ); ?>
					</ul>

					<h4><?php _e("Categories:", 'catalyst' ); ?></h4>
					<ul>
						<?php wp_list_categories( 'sort_column=name&title_li=' ); ?>
					</ul>
				</div>
				
				<div style="clear:both;"></div>
			<?php } ?>
		</div>

	</article>
<?php
}

/**
 * Build the Catalyst hybrid loop structure.
 *
 * @since 1.2
 */
function catalyst_hybrid_loop( $args = array() )
{
	global $_catalyst_loop_args;
	
	$args = apply_filters( 'catalyst_hybrid_loop_args', wp_parse_args( $args, array(
		'loop' => 'standard',
		'features' => 2,
		'excerpt_type' => 'columns',
		'posts_per_page' => get_option('posts_per_page'),
		'paged' => get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1
	) ) );
	
	if ( $args['posts_per_page'] < $args['features'] )
	{
		trigger_error( sprintf( __( 'The %s function\'s arguments are invalid.', 'catalyst' ), __FUNCTION__ ) );
		return;
	}
	
	if ( $args['paged'] > 1 )
	{
		$args['features'] = 0;
	}
	
	//global
	$_catalyst_loop_args = $args;
	
	add_filter( 'post_class', 'catalyst_hybrid_loop_post_class' );

	//loop
	if ( $args['loop'] == 'custom' )
	{
		catalyst_custom_loop( $args );
	}
	else
	{
		catalyst_standard_loop();
	}
	
	//reset
	$_catalyst_loop_args = array();
	remove_filter( 'post_class', 'catalyst_hybrid_loop_post_class' );
}

/**
 * Build the $hybrid_classes array and then merge it into any additional $classes.
 *
 * @since 1.2
 * @return merged and filtered array of hybrid classes.
 */
function catalyst_hybrid_loop_post_class( $classes )
{
	global $_catalyst_loop_args, $catalyst_loop_count;
	
	$hybrid_classes = array();
	
	if ( $_catalyst_loop_args['features'] && ( $catalyst_loop_count - 1 ) < $_catalyst_loop_args['features'] )
	{
		$hybrid_classes[] = 'catalyst-feature';
		$hybrid_classes[] = sprintf( 'catalyst-feature-%s', $catalyst_loop_count );
		$hybrid_classes[] = ( $catalyst_loop_count - 1 )&1 ? 'catalyst-feature-even' : 'catalyst-feature-odd';
	}
	elseif ( $_catalyst_loop_args['features']&1 )
	{
		$hybrid_classes[] = 'catalyst-hybrid';
		$hybrid_classes[] = sprintf( 'catalyst-hybrid-%s', $catalyst_loop_count - $_catalyst_loop_args['features'] );
		$hybrid_classes[] = ( $catalyst_loop_count - 1 )&1 ? 'catalyst-hybrid-odd' : 'catalyst-hybrid-even';
		$hybrid_classes[] = ( $_catalyst_loop_args['excerpt_type'] == 'columns' ) ? 'catalyst-hybrid-columns' : '';
	}
	else
	{
		$hybrid_classes[] = 'catalyst-hybrid';
		$hybrid_classes[] = sprintf( 'catalyst-hybrid-%s', $catalyst_loop_count - $_catalyst_loop_args['features'] );
		$hybrid_classes[] = ( $catalyst_loop_count - 1 )&1 ? 'catalyst-hybrid-even' : 'catalyst-hybrid-odd';
		$hybrid_classes[] = ( $_catalyst_loop_args['excerpt_type'] == 'columns' ) ? 'catalyst-hybrid-columns' : '';
	}
	
	return array_merge( $classes, apply_filters( 'catalyst_hybrid_loop_post_class', $hybrid_classes ) );
}

/******************************
	Build Content Functions
******************************/

add_action( 'catalyst_hook_before_post_title', 'catalyst_maybe_thumbnail_outside' );
/**
 * Place thumbnail image outside of the post title of thumbnail_location is set to "Outside".
 *
 * @since 1.0.4
 */
function catalyst_maybe_thumbnail_outside()
{
	if( is_singular() || catalyst_get_core( 'thumbnail_location' ) != 'Outside' )
		return;
	
	if( !is_singular() && catalyst_get_core( 'archive_thumbnails' ) )
	{
		$thumbnail_alignment = ( catalyst_get_core( 'thumbnail_alignment' ) == 'None' ) ? '' : 'align' . strtolower( catalyst_get_core( 'thumbnail_alignment' ) );
	}
	
	if( ( is_archive() && catalyst_get_core( 'archive_content_type' ) == "Excerpt" ) || ( !is_archive() && catalyst_get_core( 'default_content_type' ) == "Excerpt" ) ||
		( ( ( is_archive() && catalyst_get_core( 'archive_content_type' ) == "Hybrid" ) || ( !is_archive() && catalyst_get_core( 'default_content_type' ) == "Hybrid" ) ) && !in_array( 'catalyst-feature', get_post_class() ) ) )
	{
		if( function_exists( 'has_post_thumbnail' ) )
		{
			if( has_post_thumbnail() && catalyst_get_core( 'archive_thumbnails' ) )
			{
				ob_start();
				the_post_thumbnail( ( catalyst_get_core( 'thumbnail_size' ) ), array( 'class' => $thumbnail_alignment ) );
				$the_post_thumbnail = ob_get_clean();
				
				printf( '<a href="%s" title="%s">%s</a>', get_permalink(), the_title_attribute( 'echo=0' ), $the_post_thumbnail );
			}
		}
	}
}

add_action( 'catalyst_hook_before_post_title', 'catalyst_add_post_format_icon' );
/**
 * Build the Post Format icon HTML.
 *
 * @since 1.2.1
 */
function catalyst_add_post_format_icon()
{
	global $post;

	if ( !current_theme_supports( 'post-formats' ) || !current_theme_supports( 'catalyst-post-format-icons' ) )
		return;

	$post_format = get_post_format( $post );
	
	$post_format_img_dir = ( defined( 'DYNAMIK_ACTIVE' ) || defined('BASIK_CHILD_THEME_VERSION') ) ? 'css' : 'images';

	if ( $post_format && file_exists( sprintf( '%s/%s/post-formats/%s.png', CHILD_ROOT, $post_format_img_dir, $post_format ) ) )
	{
		printf( '<a href="%s" title="%s" rel="bookmark"><img src="%s" class="post-format-icon" alt="%s" /></a>', get_permalink(), the_title_attribute('echo=0'), sprintf( '%s/%s/post-formats/%s.png', CHILD_URL, $post_format_img_dir, $post_format ), $post_format );
	}
	elseif ( file_exists( sprintf( '%s/%s/post-formats/default.png', CHILD_ROOT, $post_format_img_dir ) ) )
	{
		printf( '<a href="%s" title="%s" rel="bookmark"><img src="%s/%s/post-formats/default.png" class="post-format-icon" alt="%s" /></a>', get_permalink(), the_title_attribute('echo=0'), CHILD_URL, $post_format_img_dir, 'post' );
	}
}

add_action( 'catalyst_hook_before_loop', 'catalyst_build_taxonomy_title_box', 15 );
/**
 * Build the taxonomy title box HTML.
 *
 * @since 1.3
 */
function catalyst_build_taxonomy_title_box()
{
	global $wp_query;

	if ( !is_category() && !is_tag() && !is_tax() )
		return;

	if ( get_query_var( 'paged' ) >= 2 )
		return;

	$term = is_tax() ? get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ) : $wp_query->get_queried_object();

	if ( !$term || !isset( $term->meta ) )
		return;

	$title = isset( $term->meta['display_title'] ) ? sprintf( '<h1>%s</h1>', esc_html( $term->name ) ) : '';
	$description = isset( $term->meta['display_description'] ) ? wpautop( wp_kses( $term->description, catalyst_allowed_html_elements() ) ) : '';

	if ( $title || $description )
	{
		printf( '<div class="taxonomy-title-box">%s</div>', $title . $description );
	}
}

add_action( 'catalyst_hook_before_loop', 'catalyst_build_author_title_box', 15 );
/**
 * Build the author title box HTML.
 *
 * @since 1.3
 */
function catalyst_build_author_title_box()
{
	if ( !is_author() )
		return;

	if ( get_query_var( 'paged' ) >= 2 )
		return;

	$heading = get_the_author_meta( 'heading', (int) get_query_var( 'author' ) );
	$author_description = get_the_author_meta( 'author_description', (int) get_query_var( 'author' ) );

	$heading = $heading ? sprintf( '<h1>%s</h1>', esc_html( $heading ) ) : '';
	$author_description = $author_description ? wpautop( wp_kses( $author_description, catalyst_allowed_html_elements() ) ) : '';

	if ( $heading || $author_description )
	{
		printf( '<div class="author-title-box">%s</div>', $heading . $author_description );
	}
}

add_action( 'catalyst_hook_post_title', 'catalyst_post_title' );
/**
 * Build post title HTML, using an H1 or H2 tag depending on whether the display location
 * is singular or not.
 *
 * @since 1.0
 */
function catalyst_post_title()
{
	if( is_singular() || ( class_exists( 'bbPress' ) && is_bbpress() ) )
	{
		$post_title = '<h1 class="entry-title">' . get_the_title() . '</h1>' . "\n";
	}
	else
	{
		$post_title = '<h2 class="entry-title"><a href="' . get_permalink() . '" rel="bookmark">' . get_the_title() . '</a></h2>' . "\n";
	}
	
	echo apply_filters( 'catalyst_post_title', $post_title ) . "\n";
}

add_action( 'wp', 'catalyst_remove_page_titles' );
/**
 * Remove all or specific page titles if specified in Core Options.
 *
 * @since 1.2
 */
function catalyst_remove_page_titles()
{
	global $post;
	
	if( is_page_template( 'template-blog.php' ) || !is_page() )
		return;
		
	if( catalyst_get_core( 'remove_all_page_titles' ) )
	{
		remove_action( 'catalyst_hook_post_title', 'catalyst_post_title' );
		return;
	}
	
	foreach( explode( ',', catalyst_get_core( 'remove_page_titles_ids' ) ) as $remove_page_titles_id )
	{
		if( $post->ID == $remove_page_titles_id )
			remove_action( 'catalyst_hook_post_title', 'catalyst_post_title' );
	}
}

add_filter( 'byline_author_text', 'byline_author_text' );
/**
 * Filter in the byline_author_text custom text.
 *
 * @since 1.5.1
 */
function byline_author_text()
{
	return catalyst_get_core( 'byline_author_text' );
}

add_filter( 'byline_date_text', 'byline_date_text' );
/**
 * Filter in the byline_date_text custom text.
 *
 * @since 1.5.1
 */
function byline_date_text()
{
	return catalyst_get_core( 'byline_date_text' );
}

add_filter( 'catalyst_byline_meta', 'do_shortcode', 20 );
add_action( 'catalyst_hook_after_post_title', 'catalyst_byline_meta' );
/**
 * Build byline meta HTML using the Catalyst byline content shortcodes.
 *
 * @since 1.0
 */
function catalyst_byline_meta()
{
	if( is_page() || ( !catalyst_get_core( 'byline_author' ) && !catalyst_get_core( 'byline_date' ) && !catalyst_get_core( 'byline_comments' ) && !catalyst_get_core( 'byline_edit_link' ) ) )
		return;
	
	if( catalyst_get_core( 'byline_author' ) ) { $byline_author = apply_filters( 'byline_author_text', __( 'Written <em>by</em>', 'catalyst' ) ) . ' [byline_author] '; } else { $byline_author = ''; }
	if( catalyst_get_core( 'byline_date' ) ) { $byline_date = apply_filters( 'byline_date_text', __( '<em>on</em>', 'catalyst' ) ) . ' [byline_date] '; } else { $byline_date = ''; }
	if( catalyst_get_core( 'byline_comments' ) ) { $byline_comments = '[byline_comments] '; } else { $byline_comments = ''; }
	if( catalyst_get_core( 'byline_edit_link' ) ) { $edit_link = '[edit_link]'; } else { $edit_link = ''; }
	
	$byline_meta = $byline_author . $byline_date . $byline_comments . $edit_link;
	
	printf( '<div class="byline-meta">%s</div>', apply_filters( 'catalyst_byline_meta', $byline_meta ) );
}

add_filter( 'read_more_text', 'read_more_text' );
/**
 * Filter in the read_more_text custom text.
 *
 * @since 1.5.1
 */
function read_more_text()
{
	return catalyst_get_core( 'read_more_text' );
}

add_action( 'catalyst_hook_post_content', 'catalyst_build_the_content' );
/**
 * Build the main content structure based on Catalyst options and page/post types/locations.
 *
 * @since 1.0
 */
function catalyst_build_the_content()
{
	$read_more_text = apply_filters( 'read_more_text', __( 'Read more &raquo;', 'catalyst' ) );
		
	if( !is_singular() && catalyst_get_core( 'archive_thumbnails' ) )
	{
		$thumbnail_alignment = ( catalyst_get_core( 'thumbnail_alignment' ) == 'None' ) ? '' : 'align' . strtolower( catalyst_get_core( 'thumbnail_alignment' ) );
	}
	
	if( is_singular() || ( class_exists( 'bbPress' ) && is_bbpress() ) )
	{
		echo the_content( $read_more_text ) . '<div style="clear:both;"></div>' . "\n";
		wp_link_pages( array( 'before' => '<p class="pages">' . __( 'Pages:', 'catalyst' ), 'after' => '</p>' ) );
		
		if( is_single() )
		{
			echo '<!--'; trackback_rdf(); echo '-->' ."\n";
		}
		
		if( is_page() && catalyst_get_core( 'page_edit_link' ) )
		{
			edit_post_link(__( '(Edit)', 'catalyst' ), '', '' );
		}
	}
	elseif( ( is_archive() && catalyst_get_core( 'archive_content_type' ) == "Excerpt" ) ||
			( is_search() && catalyst_get_core( 'archive_content_type' ) == "Excerpt" ) ||
			( !is_archive() && !is_search() && catalyst_get_core( 'default_content_type' ) == "Excerpt" ) ||
			( ( ( is_archive() && catalyst_get_core( 'archive_content_type' ) == "Hybrid" ) || ( is_search() && catalyst_get_core( 'archive_content_type' ) == "Hybrid" ) || ( !is_archive() && !is_search() && catalyst_get_core( 'default_content_type' ) == "Hybrid" ) ) && !in_array( 'catalyst-feature', get_post_class() ) ) )
	{
		if( function_exists( 'has_post_thumbnail' ) )
		{
			if( has_post_thumbnail() && catalyst_get_core( 'archive_thumbnails' ) && catalyst_get_core( 'thumbnail_location' ) == "Inside" )
			{
				ob_start();
				the_post_thumbnail( ( catalyst_get_core( 'thumbnail_size' ) ), array( 'class' => $thumbnail_alignment ) );
				$the_post_thumbnail = ob_get_clean();
				
				printf( '<a href="%s" title="%s">%s</a>', get_permalink(), the_title_attribute( 'echo=0' ), $the_post_thumbnail );
			}
		}
		$excerpt_content = get_the_excerpt();
		if( !empty( $read_more_text ) )
		{
			$read_more_text = ' <a class="excerpt-read-more" href="' . get_permalink() . '">' . $read_more_text . '</a>';
		}
		else
		{
			$read_more_text = '';
		}
		if( catalyst_get_core( 'excerpt_read_more_placement' ) != 'New Line' )
		{
			echo '<p>' . $excerpt_content . $read_more_text . '</p>' . "\n";
		}
		else
		{
			echo '<p>' . $excerpt_content . '</p>' . "\n";
			echo '<p>' . $read_more_text . '</p>' . "\n";
		}
	}
	else
	{
		echo the_content( $read_more_text ) . '<div style="clear:both;"></div>' . "\n";
	}
}

add_filter( 'tag_meta_sep', 'tag_meta_sep' );
/**
 * Filter in the tag_meta_sep custom text.
 *
 * @since 1.5.1
 */
function tag_meta_sep()
{
	return catalyst_get_core( 'tag_meta_sep' );
}

/**
 * Build post meta HTML.
 *
 * @since 1.0
 */
function catalyst_build_post_meta()
{
	if( catalyst_get_core( 'cat_meta_display' ) )
	{
		if( catalyst_get_core( 'tag_meta_display' ) && has_tag() )
			$sep = ' ' . apply_filters( 'tag_meta_sep', __( ',', 'catalyst' ) ) . ' ';
		else
			$sep = '';
			
		$post_categories = '[post_categories]' . $sep;
	}
	else
	{
		$post_categories = '';
	}
	
	if( catalyst_get_core( 'tag_meta_display' ) && has_tag() )
	{
		$post_tags = '[post_tags]';
	}
	else
	{
		$post_tags = '';
	}
	
	$post_meta = $post_categories . $post_tags;
	
	printf( '<footer class="post-meta"><p>%s</p></footer>', apply_filters( 'catalyst_post_meta', $post_meta ) );
}

add_filter( 'catalyst_post_meta', 'do_shortcode', 20);
add_action( 'catalyst_hook_after_post_content', 'catalyst_post_meta' );
/**
 * Only display post meta on non-single pages.
 *
 * @since 1.0
 */
function catalyst_post_meta()
{
	if( is_page() ) return;
	
	catalyst_build_post_meta();
}

add_filter( 'catalyst_excerpt_widget_post_meta', 'do_shortcode', 20 );
add_action( 'catalyst_hook_excerpt_widget_post_meta', 'catalyst_excerpt_widget_post_meta' );
/**
 * Display post meta in Catalyst Excerpt Widgets.
 *
 * @since 1.0
 */
function catalyst_excerpt_widget_post_meta()
{
	catalyst_build_post_meta();
}

add_filter( 'post_author_box_link_text', 'post_author_box_link_text' );
/**
 * Filter in the post_author_box_link_text custom text.
 *
 * @since 1.5.1
 */
function post_author_box_link_text()
{
	return catalyst_get_core( 'post_author_box_link_text' );
}

add_action( 'catalyst_hook_after_post_content', 'catalyst_post_author_info' );
/**
 * Build post author box HTML.
 *
 * @since 1.0
 */
function catalyst_post_author_info()
{
	if( !is_single() )
		return;

	if( catalyst_get_core( 'author_info_display' ) && get_the_author_meta( 'description' ) )
	{
		if( get_the_author_meta( 'author_alt_link', (int) get_query_var( 'author' ) ) == '' )
		{
			$author_link = '<a href="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '" rel="author">';
		}
		else
		{
			$author_link = '<a href="' . get_the_author_meta( 'author_alt_link', (int) get_query_var( 'author' ) ) . '" rel="author">';
		}
	?>
		<div id="entry-author-info">
		<?php if( get_avatar( get_the_author_meta( 'user_email' ) ) == TRUE ) { ?>
			<div id="author-avatar">
				<?php echo get_avatar( get_the_author_meta( 'user_email' ) ); ?>
			</div><!-- #author-avatar -->
		<?php } ?>
			<div id="author-description">
				<p><?php printf( esc_attr__( 'About %s', 'catalyst' ), get_the_author() ); ?></p>
				<div id="author-link">
					<?php the_author_meta( 'description' ); ?>
					<?php echo $author_link; ?>
						<?php printf( __( '%s', 'catalyst' ), do_shortcode( apply_filters( 'post_author_box_link_text', __( 'View all posts by [post_author] &raquo;', 'catalyst' ) ) ) ); ?>
					</a>
				</div><!-- #author-link	-->
			</div><!-- #author-description -->
		</div><!-- #entry-author-info -->
	<?php
	}
}

add_action( 'catalyst_hook_after_endwhile', 'catalyst_build_post_nav' );
/**
 * Display the post navigation type currently selected in Core Options.
 *
 * @since 1.0
 */
function catalyst_build_post_nav()
{
	$post_nav_type = catalyst_get_core( 'post_nav_type' );
	
	if( $post_nav_type == 'prev-next' )
		catalyst_prev_next_post_nav();
	elseif( $post_nav_type == 'numbered' )
		catalyst_numeric_post_nav();
	else
		catalyst_older_newer_post_nav();
}

/**
 * Build the Previous/Next post navigation HTML.
 *
 * @since 1.0
 */
function catalyst_prev_next_post_nav()
{
	$prev_link = get_previous_posts_link();
	$next_link = get_next_posts_link();
	
	$prev = $prev_link ? '<div class="alignleft prev-next-post-nav">' . $prev_link . '</div>' : '';
	$next = $next_link ? '<div class="alignright prev-next-post-nav">' . $next_link . '</div>' : '';
	
	$nav = '<nav class="post-nav">' . $prev . $next . '</nav><!-- end .post-nav -->';
	
	if( !empty( $prev ) || !empty( $next ) )
		echo $nav;
}

/**
 * Build the Numbered post navigation HTML.
 *
 * @since 1.0
 */
function catalyst_numeric_post_nav()
{
	if( is_singular() ) return;
	
	global $wp_query;

	if( $wp_query->max_num_pages <= 1 ) return;
	
	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max = intval( $wp_query->max_num_pages );
	
	echo '<nav class="post-nav"><ul>' . "\n";
		
	if( $paged >= 1 )
		$links[] = $paged;

	if( $paged >= 3 ) {
		$links[] = $paged - 1; $links[] = $paged - 2;
	}
	if( ($paged + 2) <= $max ) { 
		$links[] = $paged + 2; $links[] = $paged + 1;
	}

	if( get_previous_posts_link() )
		printf( '<li>%s</li>' . "\n", get_previous_posts_link( __( '&laquo; Previous', 'catalyst' ) ) );
	
	if( !in_array( 1, $links ) ) {
		if( $paged == 1 ) $current = ' class="active"'; else $current = null;
		printf( '<li %s><a href="%s">%s</a></li>' . "\n", $current, get_pagenum_link( 1 ), '1' );
		
		if( !in_array( 2, $links ) )
			echo '<li>&hellip;</li>';
	}
	
	sort( $links );
	foreach( ( array)$links as $link ) {
		$current = ( $paged == $link ) ? 'class="active"' : '';
		printf( '<li %s><a href="%s">%s</a></li>' . "\n", $current, get_pagenum_link( $link ), $link );
	}
	
	if( !in_array( $max, $links ) ) {
		if( !in_array( $max - 1, $links ) )
			echo '<li>&hellip;</li>' . "\n";
		
		$current = ( $paged == $max ) ? 'class="active"' : '';
		printf( '<li %s><a href="%s">%s</a></li>' . "\n", $current, get_pagenum_link( $max ), $max );
	}
	
	if( get_next_posts_link() )
		printf( '<li>%s</li>' . "\n", get_next_posts_link( __( 'Next &raquo;', 'catalyst' ) ) );
	
	echo '</ul></nav>' . "\n";
}

/**
 * Build the Older/Newer post navigation HTML.
 *
 * @since 1.0
 */
function catalyst_older_newer_post_nav()
{
	$older_link = get_next_posts_link( '&laquo; ' . __( 'Older Posts', 'catalyst' ) );
	$newer_link = get_previous_posts_link(__( 'Newer Posts', 'catalyst' ) . ' &raquo;' );
	
	$older = $older_link ? '<div class="alignleft old-new-post-nav">' . $older_link . '</div>' : '';
	$newer = $newer_link ? '<div class="alignright old-new-post-nav">' . $newer_link . '</div>' : '';
	
	$nav = '<nav class="post-nav">' . $older . $newer . '</nav><!-- end .post-nav -->';
	
	if( !empty( $older ) || !empty( $newer ) )
		echo $nav;
}

add_action( 'catalyst_hook_loop_else', 'catalyst_build_nopost_content' );
/**
 * Build "no post" HTML.
 *
 * @since 1.0
 */
function catalyst_build_nopost_content()
{
	printf( '<p>%s</p>', apply_filters( 'catalyst_nopost_content', __( 'Sorry, no posts matched your criteria.', 'catalyst' ) ) );
}

// Filter the Catalyst Excerpt Lenght setting into the WordPress excerpt_length.
if( catalyst_get_core( 'excerpt_content_limit' ) )
	add_filter( 'excerpt_length', 'catalyst_excerpt_length' );

/**
 * Get the Catalyst excerpt_content_limit value.
 *
 * @since 1.0
 * @return the Catalyst excerpt_content_limit value.
 */
function catalyst_excerpt_length( $length )
{
	return catalyst_get_core( 'excerpt_content_limit' );
}

add_filter( 'post_class', 'catalyst_custom_post_class' );
/**
 * Get the Catalyst _catalyst_custom_post_class value.
 *
 * @since 1.2.1
 * @return the Catalyst _catalyst_custom_post_class value.
 */
function catalyst_custom_post_class( $classes )
{
	$custom_post_class = catalyst_get_custom_field( '_catalyst_custom_post_class' );

	if ( $custom_post_class ) $classes[] = esc_attr( sanitize_html_class( $custom_post_class ) );

	return $classes;
}

/**
 * Restrict the type of HTML elements that can be used in certain content/option areas.
 *
 * @since 1.3
 * @return array of allowable HTML elements.
 */
function catalyst_allowed_html_elements()
{
	return apply_filters( 'catalyst_allowed_html_elements', array(
		'h1' => array( 'align' => array(), 'class' => array(), 'style' => array() ),
		'h2' => array( 'align' => array(), 'class' => array(), 'style' => array() ),
		'h3' => array( 'align' => array(), 'class' => array(), 'style' => array() ),
		'h4' => array( 'align' => array(), 'class' => array(), 'style' => array() ),
		'h5' => array( 'align' => array(), 'class' => array(), 'style' => array() ),
		'h6' => array( 'align' => array(), 'class' => array(), 'style' => array() ),
		'p' => array( 'align' => array(), 'class' => array(), 'style' => array() ),
		'span' => array( 'align' => array(), 'class' => array(), 'style' => array() ),
		'div' => array( 'align' => array(), 'class' => array(), 'style' => array() ),
		'img' => array( 'src' => array(), 'class' => array(), 'alt' => array(), 'width' => array(), 'height' => array(), 'style' => array() ),
		'a' => array( 'href' => array(), 'title' => array(), 'rel' => array() ),
		'b' => array(), 'strong' => array(),
		'i' => array(), 'em' => array(),
		'blockquote' => array(),
		'br' => array()
	) );
}

//end lib/functions/catalyst-content.php