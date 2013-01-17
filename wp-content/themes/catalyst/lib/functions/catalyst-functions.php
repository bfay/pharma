<?php
/**
 * This file houses the functions that don't fit in any of the
 * other Catalyst function files.
 *
 * @package Catalyst
 */

/**
 * Display either the RSS link specified in Core Options or the default one.
 *
 * @since 1.0
 * @return the appropriate RSS link.
 */
function catalyst_rss_link()
{
	if( catalyst_get_core( 'rss_link' ) ) return catalyst_get_core( 'rss_link' );
	return get_feed_link();
}

// Add shortcode functionality to WordPress Text Widgets.
add_filter( 'widget_text', 'do_shortcode' );

// Add shortcode functionality to Catalyst PHP Text Widgets.
add_filter( 'widget_execphp', 'do_shortcode' );
		
add_filter( 'avatar_defaults', 'catalyst_default_avatar' );
/**
 * Display a Custom Avatar if one exists with the correct name
 * and in the correct Child Theme images directory.
 *
 * @since 1.0
 * @return custom avatar.
 */
function catalyst_default_avatar( $avatar_defaults )
{
	if( defined( 'DYNAMIK_ACTIVE' ) || defined( 'VANILLA_ACTIVE' ) )
	{
        global $catalyst_multisite;
        
        $id = '';
        if( $catalyst_multisite )
        {
            $id = $catalyst_multisite . '/';
        }
		
		if( file_exists( CHILD_ROOT . '/css/images/' . $id . 'custom-avatar.png' ) )
			$custom_avatar = CHILD_URL . '/css/images/' . $id . 'custom-avatar.png';
		elseif( file_exists( CHILD_ROOT . '/css/images/' . $id . 'custom-avatar.jpg' ) )
			$custom_avatar = CHILD_URL . '/css/images/' . $id . 'custom-avatar.jpg';
		elseif( file_exists( CHILD_ROOT . '/css/images/' . $id . 'custom-avatar.gif' ) )
			$custom_avatar = CHILD_URL . '/css/images/' . $id . 'custom-avatar.gif';
		else
			$custom_avatar = CATALYST_URL . '/images/custom-avatar.jpg';
	}
	else
	{
		$pre = apply_filters( 'catalyst_pre_load_custom_avatar', false );
		
		if( $pre !== false )
			$custom_avatar = $pre;
		elseif( file_exists( CHILD_ROOT . '/images/custom-avatar.png' ) )
			$custom_avatar = CHILD_URL . '/images/custom-avatar.png';
		elseif( file_exists( CHILD_ROOT . '/images/custom-avatar.jpg' ) )
			$custom_avatar = CHILD_URL . '/images/custom-avatar.jpg';
		elseif( file_exists( CHILD_ROOT . '/images/custom-avatar.gif' ) )
			$custom_avatar = CHILD_URL . '/images/custom-avatar.gif';
		else
			$custom_avatar = CATALYST_URL . '/images/custom-avatar.jpg';
	}

	$custom_avatar = apply_filters( 'catalyst_custom_avatar_path', $custom_avatar );
	$avatar_defaults[$custom_avatar] = 'Custom Avatar';
	return $avatar_defaults;
}
	
add_filter( 'get_search_form', 'catalyst_search_form_widget' );
/**
 * Call in the catalyst_search_form() function to filter it into the WordPress search form.
 *
 * @since 1.0
 * @return the catalyst_search_form() function.
 */
function catalyst_search_form_widget()
{
	return catalyst_search_form();
}

add_filter( 'catalyst_search_form_text', 'catalyst_search_form_text' );
/**
 * Filter in the catalyst_search_form_text custom text.
 *
 * @since 1.5.1
 */
function catalyst_search_form_text()
{
	return catalyst_get_core( 'search_form_text' );
}

add_filter( 'catalyst_search_button_text', 'catalyst_search_button_text' );
/**
 * Filter in the catalyst_search_button_text custom text.
 *
 * @since 1.5.1
 */
function catalyst_search_button_text()
{
	return catalyst_get_core( 'search_button_text' );
}

/**
 * Build the Catalyst search form HTML.
 *
 * @since 1.0
 * @return the Catalyst search form HTML.
 */
function catalyst_search_form()
{
	$search_form_text = get_search_query() ? esc_attr( apply_filters( 'the_search_query', get_search_query() ) ) : apply_filters( 'catalyst_search_form_text', __( 'Search this website...', 'catalyst' ) );
	$search_button_text = apply_filters( 'catalyst_search_button_text', __( 'SEARCH', 'catalyst' ) );
	$onfocus = " onfocus=\"if(this.value == '$search_form_text' ) {this.value = '';}\"";
	$onblur = " onblur=\"if(this.value == '' ) {this.value = '$search_form_text';}\"";
	
	if( catalyst_get_core( 'show_search_button' ) )
		$search_button = '<input type="submit" class="searchsubmit" value="' . $search_button_text . '" />';
	else
		$search_button = '';
	
	$search_form = '
		<form method="get" class="searchform" action="' . get_option( 'home' ) . '/" >
			<input type="text" value="'. $search_form_text .'" name="s" class="s"'. $onfocus . $onblur .' />
			' . $search_button . '
		</form>
	';
	
	return apply_filters( 'catalyst_search_form', $search_form, $search_form_text, $search_button_text );
}

add_action( 'init', 'catalyst_open_close_wrap' );
/**
 * Hook in the opening and closing #wrap divs.
 *
 * @since 1.0
 */
function catalyst_open_close_wrap()
{
	if( defined( 'DYNAMIK_ACTIVE' ) )
	{
		if( catalyst_get_dynamik_alt( 'wrap_open_placement' ) == 'wrap_open_before_before_header' ){ add_action( 'catalyst_hook_before_before_header', 'catalyst_open_site_wrap' ); }
		elseif( catalyst_get_dynamik_alt( 'wrap_open_placement' ) == 'wrap_open_after_before_header' ){	add_action( 'catalyst_hook_after_before_header', 'catalyst_open_site_wrap' ); }
		elseif( catalyst_get_dynamik_alt( 'wrap_open_placement' ) == 'wrap_open_before_after_header' ){	add_action( 'catalyst_hook_before_after_header', 'catalyst_open_site_wrap' ); }
		elseif( catalyst_get_dynamik_alt( 'wrap_open_placement' ) == 'wrap_open_after_after_header' ){ add_action( 'catalyst_hook_after_after_header', 'catalyst_open_site_wrap' );	}
		
		if( catalyst_get_dynamik_alt( 'wrap_close_placement' ) == 'wrap_close_before_before_footer' ){ add_action( 'catalyst_hook_before_before_footer', 'catalyst_close_site_wrap' ); }
		elseif( catalyst_get_dynamik_alt( 'wrap_close_placement' ) == 'wrap_close_after_before_footer' ){ add_action( 'catalyst_hook_after_before_footer', 'catalyst_close_site_wrap' ); }
		elseif( catalyst_get_dynamik_alt( 'wrap_close_placement' ) == 'wrap_close_before_after_footer' ){ add_action( 'catalyst_hook_before_after_footer', 'catalyst_close_site_wrap' ); }
		elseif( catalyst_get_dynamik_alt( 'wrap_close_placement' ) == 'wrap_close_after_after_footer' ){ add_action( 'catalyst_hook_after_after_footer', 'catalyst_close_site_wrap' ); }
	}
	else
	{
		add_action( 'catalyst_hook_before_before_header', 'catalyst_open_site_wrap' );
		add_action( 'catalyst_hook_after_after_footer', 'catalyst_close_site_wrap' );
	}
}

/**
 * Build the opening #wrap HTML.
 *
 * @since 1.0
 */
function catalyst_open_site_wrap()
{
	echo apply_filters( 'catalyst_open_wrap', '<div id="wrap" class="clearfix">' . "\n" );
}

/**
 * Build the closing #wrap HTML.
 *
 * @since 1.0
 */
function catalyst_close_site_wrap()
{
	echo apply_filters( 'catalyst_close_wrap', '</div><!-- end #wrap -->' . "\n" );
}

/**
 * List available images that have been updoaded using the Catalyst Image Uploader.
 *
 * @since 1.0
 */
function catalyst_list_images( $current_value = '' )
{
	global $blog_id;
	$files = array();
	$catalyst_multisite = false;
	if( $blog_id > 1 )
	{
		$catalyst_multisite = $blog_id;
	}
	
	if( $catalyst_multisite )
	{
		$images_path = CHILD_ROOT . '/css/images/' . $catalyst_multisite;
	}
	else
	{
		$images_path = CHILD_ROOT . '/css/images';
	}

	$handle = opendir( $images_path );
	while( false !== ( $file = readdir( $handle ) ) )
	{
		$ext = strtolower( substr( strrchr( $file, '.' ), 1) );
		if( $ext == 'jpg' || $ext == 'png' || $ext == 'gif' )
		{
			array_push( $files, $file );
		}
	}
	closedir( $handle );
	
	echo '<option></option>';
	
	if( count( $files) != 0 )
	{
		sort( $files );
		foreach( $files as $file )
		{
			$image_list_option = '<option value="' . $file . '"';
			if( $current_value == $file )
			{
				$image_list_option .= ' selected="selected"';
			}
			$image_list_option .= '>' . $file . '</option>' . "\n";
			echo $image_list_option;
		}
	}
}

/**
 * Test to see if a directory is writable and/or able to
 * be made writable by Catalyst.
 *
 * @since 1.3
 * @return true or false based on the findings of the function.
 */
function catalyst_writable( $dir, $level_open = 0777, $level_close = 0755 )
{
	if( !is_writable( $dir ) )
	{
		@chmod( $dir, $level_open );
	}
	else
	{
		return true;
	}
	
	if( !is_writable( $dir ) )
	{
		return false;
	}
	else
	{
		@chmod( $dir, $level_close );
	}
	
	return true;
}

/**
 * chmod a directory to 0777.
 *
 * @since 1.3
 */
function catalyst_open_permissions( $dir, $level_open = 0777 )
{
	@chmod( $dir, $level_open );
}

/**
 * chmod a directory to 0755.
 *
 * @since 1.3
 */
function catalyst_close_permissions( $dir, $level_close = 0755 )
{
	@chmod( $dir, $level_close );
}

/**
 * Make any unwritable folders writable.
 *
 * NOTE: "folders" meaning Dynamik stylesheet and Image Uploader folders.
 *
 * @since 1.3
 */
function catalyst_child_folders_open_permissions()
{
	global $catalyst_child_unwritable, $catalyst_child_folders;
	
	if( $catalyst_child_unwritable )
	{
		foreach( $catalyst_child_folders as $catalyst_child_folder )
		{
			if( is_dir( $catalyst_child_folder ) )
			{
				catalyst_open_permissions( $catalyst_child_folder );
			}
		}
	}
}

/**
 * Return any folders that were made writable by Catalyst to a permission setting of 0755.
 *
 * NOTE: "folders" meaning Dynamik stylesheet and Image Uploader folders.
 *
 * @since 1.3
 */
function catalyst_child_folders_close_permissions()
{
	global $catalyst_child_unwritable, $catalyst_child_folders;
	
	if( $catalyst_child_unwritable )
	{
		foreach( $catalyst_child_folders as $catalyst_child_folder )
		{
			if( is_dir( $catalyst_child_folder ) )
			{
				catalyst_close_permissions( $catalyst_child_folder );
			}
		}
	}
}

add_action('pre_get_posts', 'kia_exclude_category' );

function kia_exclude_category( ){
  global $wp_query;
  $excluded_id = 15;

  // only exclude on home page
  if( is_home()) {
     $wp_query->query_vars['cat'] = '-' . $excluded_id;
  }
}

//end catalyst-functions.php