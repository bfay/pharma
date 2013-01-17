<?php
/**
 * Handels both the activation and update functionality.
 *
 * @package Catalyst
 */
 
if( !empty( $_POST['catalyst_update_check'] ) && $_POST['catalyst_update_check'] == 'trigger' )
{
	delete_transient( 'catalyst-update' );
	set_site_transient( 'update_themes', null );
}
// Debug Auto-Update.
//set_site_transient( 'update_themes', null );

add_filter( 'pre_site_transient_update_themes', 'catalyst_update_push' );
add_filter( 'site_transient_update_themes', 'catalyst_update_push' );
add_filter( 'transient_update_themes', 'catalyst_update_push' );
/**
 * Update Catalyst to latest version.
 *
 * @since 1.0
 * @return latest Catalyst files.
 */
function catalyst_update_push( $data )
{
	$catalyst_update = catalyst_update_check();
	
	if( $catalyst_update )
	{
		if( version_compare( CATALYST_THEME_VERSION, $catalyst_update['new_version'], '>=' ) )
			return $data;
		
		$data->response['catalyst'] = $catalyst_update;
	}

	return $data;
}

/**
 * Check to see if a new version of Catayst is available.
 *
 * @since 1.0
 * @return either response or transient.
 */
function catalyst_update_check( $checked_data = '' )
{
	global $wp_version;
	// Debug Auto-Update.
	//delete_transient( 'catalyst-update' );
	$catalyst_transient = get_transient( 'catalyst-update' );
	
	if( $catalyst_transient == false )
	{
		$api_url = 'http://api.catalysttheme.com/update/';
		$theme_base = 'catalyst';
		
		// Start checking for an update
		$send_for_check = array(
			'body' => array(
				'action' => 'theme_update', 
				'request' => array(
					'slug' => 'catalyst',
					'version' => CATALYST_THEME_VERSION
				)
			),
			'user-agent' => 'WordPress/' . $wp_version . '; ' . home_url()
		);

		$raw_response = wp_remote_post( $api_url, $send_for_check );
		
		if( !is_wp_error( $raw_response ) && ( $raw_response['response']['code'] == 200 ) && is_serialized( $raw_response['body'] ) )
		{
			$response = unserialize( $raw_response['body'] );			
		}
		else
		{
			set_transient( 'catalyst-update', array( 'new_version' => CATALYST_THEME_VERSION ), 60*60*24 ); // store for 24 hours
		}
		
		if( !empty( $response ) )
		{
			set_transient( 'catalyst-update', $response, 60*60*24); // store for 24 hours			
			return $response;
		}
	}
	else
	{
		return $catalyst_transient;
	}
}

add_action( 'admin_notices', 'catalyst_update_nag' );
/**
 * Build Catalyst Update Nag HTML.
 *
 * @since 1.0
 */
function catalyst_update_nag()
{
	$user = wp_get_current_user();
	
	if( get_the_author_meta( 'disable_catalyst_update_nag', $user->ID ) )
		return;
		
	$catalyst_update = catalyst_update_check();
		
	if( !current_user_can( 'update_themes' ) )
		return false;
	
	if( version_compare( CATALYST_THEME_VERSION, $catalyst_update['new_version'], '>=' ) || empty( $catalyst_update['package'] ) )
		return false;
	
	$update_url = wp_nonce_url( 'update.php?action=upgrade-theme&amp;theme=catalyst', 'upgrade-theme_catalyst' );
	$update_onclick = __( 'All Catalyst files will be overwritten. Are you sure you want to continue?', 'catalyst' );
	
	echo '<div id="update-nag">';
	printf( __( '<strong>Catalyst %s</strong> is Available! <a href="%s" onclick="return confirm(\'%s\' );">Update Now</a> or <a href="%s">Find Out More</a>.', 'catalyst' ), esc_html( $catalyst_update['new_version'] ), $update_url, esc_js( $update_onclick ), esc_url( $catalyst_update['url'] ), esc_html( $catalyst_update['new_version'] ) );
	echo '</div>';
}

add_filter( 'update_theme_complete_actions', 'catalyst_update_action_links', 10, 2);
/**
 * Build update action link HTML.
 *
 * @since 1.0
 * @return Catalyst update finalize link.
 */
function catalyst_update_action_links( $actions, $theme )
{
	if( $theme != 'catalyst' )
		return $actions;
		
	return '<a href="' . admin_url( 'admin.php?page=catalyst' ) . '">'. __( 'Click here to complete your Catalyst Update', 'catalyst' ) .'</a>';	
}

add_action( 'admin_notices', 'catalyst_updated_notice' );
/**
 * Build "Catalyst Update Success" notice HTML.
 *
 * @since 1.0
 */
function catalyst_updated_notice()
{
	if( !isset( $_GET['page'] ) || $_GET['page'] != 'catalyst' )
		return;
	
	if( isset( $_GET['updated'] ) && $_GET['updated'] == 'catalyst' )
	{
		echo '<div id="update-nag">' . sprintf( __( 'Congratulations! Your update to <strong>Catalyst %s</strong> is complete.', 'catalyst' ), get_option( 'catalyst_version_number' ) ) . '</div>';
	}
}

add_action( 'admin_init', 'catalyst_update' );
/**
 * Perform Catalyst updates based on current version number.
 *
 * @since 1.0
 */
function catalyst_update()
{
	// Don't do anything if we're on the latest version.
	if( version_compare( get_option( 'catalyst_version_number' ), CATALYST_THEME_VERSION, '>=' ) )
		return;

	// Update to Catalyst 1.0.1.
	if( version_compare( get_option( 'catalyst_version_number' ), '1.0.1', '<' ) )
	{
		$core_settings = get_option( 'catalyst_core_options' );
		$new_core_settings = array(
			'breadcrumbs_text_home' => 'Home',
			'byline_edit_link' => 1,
			'excerpt_widget_byline_edit_link' => 1
		);
		$settings = wp_parse_args( $new_core_settings, $core_settings );
		update_option( 'catalyst_core_options', $settings );
		update_option( 'catalyst_version_number', '1.0.1' );
	}
	
	// Update to Catalyst 1.0.2
	if( version_compare( get_option( 'catalyst_version_number' ), '1.0.2', '<' ) )
	{
		update_option( 'catalyst_version_number', '1.0.2' );
	}
	
	// Update to Catalyst 1.0.3
	if( version_compare( get_option( 'catalyst_version_number' ), '1.0.3', '<' ) )
	{
		update_option( 'catalyst_version_number', '1.0.3' );
	}
	
	// Update to Catalyst 1.0.4
	if( version_compare( get_option( 'catalyst_version_number' ), '1.0.4', '<' ) )
	{
		$core_settings = get_option( 'catalyst_core_options' );
		$new_core_settings = array(
			'thumbnail_location' => 'Inside',
			'thumbnail_size' => 'thumbnail',
			'home_title' => '',
			'default_content_type' => 'Full Content',
			'page_edit_link' => 1
		);
		$settings = wp_parse_args( $new_core_settings, $core_settings );
		
		$excerpt_widgets = get_option( 'widget_excerpt-widget' );
		foreach( $excerpt_widgets as $k => $v )
		{
			if( is_array( $v ) && !empty( $v ) )
			{
				$excerpt_widgets[$k]['display-title'] = 1;
				$excerpt_widgets[$k]['display-thumbnails'] = $settings['excerpt_widget_thumbnails'];
				$excerpt_widgets[$k]['thumbnail-alignment'] = strtolower( $settings['excerpt_widget_thumbnail_alignment'] );
				$excerpt_widgets[$k]['byline-author'] = $settings['excerpt_widget_byline_author'];
				$excerpt_widgets[$k]['byline-date'] = $settings['excerpt_widget_byline_date'];
				$excerpt_widgets[$k]['byline-comments'] = $settings['excerpt_widget_byline_comments'];
				$excerpt_widgets[$k]['byline-edit-link'] = $settings['excerpt_widget_byline_edit_link'];
				$excerpt_widgets[$k]['byline-author-text'] = $settings['excerpt_widget_byline_author_text'];
				$excerpt_widgets[$k]['byline-date-text'] = $settings['excerpt_widget_byline_date_text'];
				$excerpt_widgets[$k]['more-text'] = $settings['read_more_text'];
				$excerpt_widgets[$k]['content-type'] = 'excerpt';
				$excerpt_widgets[$k]['thumbnail-size'] = 'thumbnail';
				$excerpt_widgets[$k]['thumbnail-location'] = 'inside';
				$excerpt_widgets[$k]['post-meta'] = 0;
			}
		}
		update_option( 'widget_excerpt-widget', $excerpt_widgets );
		
		update_option( 'catalyst_core_options', $settings );
		update_option( 'catalyst_version_number', '1.0.4' );
	}
	
	// Update to Catalyst 1.1
	if( version_compare( get_option( 'catalyst_version_number' ), '1.1', '<' ) )
	{
		global $wpdb;
		
		$catalyst_widgets = $wpdb->prefix . 'catalyst_widgets';
		$wpdb->query( "UPDATE `$catalyst_widgets` SET `is_active` = replace(`is_active`,'yes','hkd' )" );
		
		$catalyst_hooks = $wpdb->prefix . 'catalyst_hooks';
		$wpdb->query( "UPDATE `$catalyst_hooks` SET `is_active` = replace(`is_active`,'yes','hkd' )" );
		
		if( defined( 'DYNAMIK_ACTIVE' ) )
		{
			$dynamik_settings = get_option( 'catalyst_dynamik_options' );
			$new_dynamik_settings = array(
				'universal_line_height' => $dynamik_settings['universal_line_height'] . '%',
				'content_paragraph_padding_bottom' => '15',
				'content_list_style_padding_bottom' => '0',
				'catalyst_widget_width_type' => 'No Set Width',
				'dynamik_homepage_type' => 'default_home',
				'ez_homepage_select' => 'ez_home_3_3_3.php',
				'ez_widget_home_title_font_size' => '18',
				'ez_widget_home_title_font_color' => '111111',
				'ez_widget_home_title_font_css' => '',
				'ez_widget_home_content_font_size' => '13',
				'ez_widget_home_content_font_color' => '111111',
				'ez_widget_home_content_font_css' => '',
				'ez_widget_home_content_link_color' => '21759B',
				'ez_widget_home_content_link_hover_color' => 'D54E21',
				'ez_widget_home_content_link_underline' => 'On Hover',
				'ez_widget_home_bg_type' => 'color',
				'ez_widget_home_bg_color' => 'FFFFFF',
				'ez_widget_home_bg_image' => '',
				'ez_widget_home_heading_bottom_border_thickness' => '1',
				'ez_widget_home_heading_bottom_border_style' => 'solid',
				'ez_widget_home_heading_bottom_border_color' => 'E8E8E8',
				'ez_widget_home_border_type' => 'Full',
				'ez_widget_home_border_thickness' => '0',
				'ez_widget_home_border_style' => 'solid',
				'ez_widget_home_border_color' => 'E8E8E8',
				'ez_widget_home_padding_top' => '20',
				'ez_widget_home_padding_right' => '0',
				'ez_widget_home_padding_bottom' => '20',
				'ez_widget_home_padding_left' => '0',
				'ez_feature_top_display_front_page' => '0',
				'ez_feature_top_display_posts' => '0',
				'ez_feature_top_display_pages' => '0',
				'ez_feature_top_display_archives' => '0',
				'ez_feature_top_display_blank_content' => '0',
				'ez_feature_top_select' => 'ez_feature_top_3.php',
				'ez_widget_feature_title_font_size' => '18',
				'ez_widget_feature_title_font_color' => '111111',
				'ez_widget_feature_title_font_css' => '',
				'ez_widget_feature_content_font_size' => '13',
				'ez_widget_feature_content_font_color' => '111111',
				'ez_widget_feature_content_font_css' => '',
				'ez_widget_feature_content_link_color' => '21759B',
				'ez_widget_feature_content_link_hover_color' => 'D54E21',
				'ez_widget_feature_content_link_underline' => 'On Hover',
				'ez_widget_feature_bg_type' => 'color',
				'ez_widget_feature_bg_color' => 'FFFFFF',
				'ez_widget_feature_bg_image' => '',
				'ez_widget_feature_heading_bottom_border_thickness' => '1',
				'ez_widget_feature_heading_bottom_border_style' => 'solid',
				'ez_widget_feature_heading_bottom_border_color' => 'E8E8E8',
				'ez_widget_feature_border_type' => 'Bottom',
				'ez_widget_feature_border_thickness' => '1',
				'ez_widget_feature_border_style' => 'solid',
				'ez_widget_feature_border_color' => 'E8E8E8',
				'ez_widget_feature_padding_top' => '20',
				'ez_widget_feature_padding_right' => '0',
				'ez_widget_feature_padding_bottom' => '20',
				'ez_widget_feature_padding_left' => '0',
				'ez_fat_footer_display_front_page' => '0',
				'ez_fat_footer_display_posts' => '0',
				'ez_fat_footer_display_pages' => '0',
				'ez_fat_footer_display_archives' => '0',
				'ez_fat_footer_display_blank_content' => '0',
				'ez_fat_footer_position' => 'inside_footer',
				'ez_fat_footer_select' => 'ez_fat_footer_3.php',
				'ez_widget_footer_title_font_size' => '18',
				'ez_widget_footer_title_font_color' => '111111',
				'ez_widget_footer_title_font_css' => '',
				'ez_widget_footer_content_font_size' => '13',
				'ez_widget_footer_content_font_color' => '111111',
				'ez_widget_footer_content_font_css' => '',
				'ez_widget_footer_content_link_color' => '21759B',
				'ez_widget_footer_content_link_hover_color' => 'D54E21',
				'ez_widget_footer_content_link_underline' => 'On Hover',
				'ez_widget_footer_bg_type' => 'color',
				'ez_widget_footer_bg_color' => 'FFFFFF',
				'ez_widget_footer_bg_image' => '',
				'ez_widget_footer_heading_bottom_border_thickness' => '1',
				'ez_widget_footer_heading_bottom_border_style' => 'solid',
				'ez_widget_footer_heading_bottom_border_color' => 'E8E8E8',
				'ez_widget_footer_border_type' => 'Bottom',
				'ez_widget_footer_border_thickness' => '1',
				'ez_widget_footer_border_style' => 'solid',
				'ez_widget_footer_border_color' => 'E8E8E8',
				'ez_widget_footer_padding_top' => '15',
				'ez_widget_footer_padding_right' => '0',
				'ez_widget_footer_padding_bottom' => '20',
				'ez_widget_footer_padding_left' => '0',
				'ez_widget_home_title_font_u' => 'u',
				'ez_widget_home_content_font_u' => 'u',
				'ez_widget_home_content_link_u' => 'u',
				'ez_widget_feature_title_font_u' => 'u',
				'ez_widget_feature_content_font_u' => 'u',
				'ez_widget_feature_content_link_u' => 'u',
				'ez_widget_footer_title_font_u' => 'u',
				'ez_widget_footer_content_font_u' => 'u',
				'ez_widget_footer_content_link_u' => 'u',
				'ez_widget_home_title_px_em' => 'px',
				'ez_widget_home_content_px_em' => 'px',
				'ez_widget_feature_title_px_em' => 'px',
				'ez_widget_feature_content_px_em' => 'px',
				'ez_widget_footer_title_px_em' => 'px',
				'ez_widget_footer_content_px_em' => 'px'
			);
			$new_font_type_settings = array(
				'ez_widget_home_title' => 'Arial, sans-serif',
				'ez_widget_home_content' => 'Arial, sans-serif',
				'ez_widget_feature_title' => 'Arial, sans-serif',
				'ez_widget_feature_content' => 'Arial, sans-serif',
				'ez_widget_footer_title' => 'Arial, sans-serif',
				'ez_widget_footer_content' => 'Arial, sans-serif'
			);
			$dynamik_settings['font_type'] = wp_parse_args( $new_font_type_settings, $dynamik_settings['font_type'] );
			$one_o_five_dynamik_settings = wp_parse_args( $new_dynamik_settings, $dynamik_settings );
			update_option( 'catalyst_dynamik_options', $one_o_five_dynamik_settings );
		}
		
		update_option( 'catalyst_version_number', '1.1' );
	}
	
	// Update to Catalyst 1.1.1
	if( version_compare( get_option( 'catalyst_version_number' ), '1.1.1', '<' ) )
	{
		update_option( 'catalyst_version_number', '1.1.1' );
	}
	
	// Update to Catalyst 1.1.2
	if( version_compare( get_option( 'catalyst_version_number' ), '1.1.2', '<' ) )
	{
		$core_settings = get_option( 'catalyst_core_options' );
		if( !empty( $core_settings['breadcrumbs_pages'] ) ) { $crumbs_blog = '1'; } else { $crumbs_blog = '0'; }
		$new_core_settings = array(
			'archive_layout_type' => 'catalyst_default',
			'category_layout_type' => 'catalyst_default',
			'tag_layout_type' => 'catalyst_default',
			'search_layout_type' => 'catalyst_default',
			'404_layout_type' => 'catalyst_default',
			'breadcrumbs_blog' => $crumbs_blog,
			'byline_zero_comment_text' => 'Leave a Comment'
		);
		$settings = wp_parse_args( $new_core_settings, $core_settings );
		update_option( 'catalyst_core_options', $settings );
		
		if( defined( 'DYNAMIK_ACTIVE' ) )
		{
			$dynamik_settings = get_option( 'catalyst_dynamik_options' );
			if( !empty( $dynamik_settings['ez_feature_top_display_pages'] ) ) { $ft_blog = '1'; } else { $ft_blog = '0'; }
			if( !empty( $dynamik_settings['ez_fat_footer_display_pages'] ) ) { $ff_blog = '1'; } else { $ff_blog = '0'; }
			$new_dynamik_settings = array(
				'double_sb_custom_layout_cc_width' => '480',
				'double_sb_custom_layout_sb1_width' => '280',
				'double_sb_custom_layout_sb2_width' => '160',
				'single_sb_custom_layout_cc_width' => '660',
				'single_sb_custom_layout_sb1_width' => '280',
				'no_sb_custom_layout_cc_width' => '960',
				'ez_feature_top_display_blog' => $ft_blog,
				'ez_fat_footer_display_blog' => $ff_blog
			);
			$dynamik_settings = wp_parse_args( $new_dynamik_settings, $dynamik_settings );
			update_option( 'catalyst_dynamik_options', $dynamik_settings );
		}
		
		update_option( 'catalyst_version_number', '1.1.2' );
	}
	
	// Update to Catalyst 1.2
	if( version_compare( get_option( 'catalyst_version_number' ), '1.2', '<' ) )
	{
		$core_settings = get_option( 'catalyst_core_options' );
		$new_core_settings = array(	
			'nav1_enable_superfish' => 0,
			'nav2_enable_superfish' => 0,
			'author_layout_type' => 'catalyst_default',
			'default_content_featured_post_number' => '2',
			'default_content_hybrid_excerpt_type' => 'columns',
			'archive_content_featured_post_number' => '2',
			'archive_content_hybrid_excerpt_type' => 'columns',
			'remove_all_page_titles' => 0,
			'remove_page_titles_ids' => '',
			'excerpt_read_more_placement' => 'Inline'
		);
		$settings = wp_parse_args( $new_core_settings, $core_settings );
		update_option( 'catalyst_core_options', $settings );
		update_option( 'catalyst_version_number', '1.2' );
	}
	
	// Update to Catalyst 1.2.1
	if( version_compare( get_option( 'catalyst_version_number' ), '1.2.1', '<' ) )
	{
		if( defined( 'DYNAMIK_ACTIVE' ) )
		{
			$dynamik_settings = get_option( 'catalyst_dynamik_options' );
			$new_dynamik_settings = array(
				'post_formats_active' => 0
			);
			$dynamik_settings = wp_parse_args( $new_dynamik_settings, $dynamik_settings );
			update_option( 'catalyst_dynamik_options', $dynamik_settings );
		}
		
		update_option( 'catalyst_version_number', '1.2.1' );
	}
	
	// Update to Catalyst 1.2.2
	if( version_compare( get_option( 'catalyst_version_number' ), '1.2.2', '<' ) )
	{
		update_option( 'catalyst_version_number', '1.2.2' );
	}
	
	// Update to Catalyst 1.3
	if( version_compare( get_option( 'catalyst_version_number' ), '1.3', '<' ) )
	{
		$core_settings = get_option( 'catalyst_core_options' );
		$new_core_settings = array(
			'seo_kill_switch' => 0,
			'navbar_superfish_arrows' => 1,
			'page_layout_type' => 'catalyst_default',
			'post_layout_type' => 'catalyst_default',
			'include_inpost_all_cpts' => 0,
			'include_inpost_cpt_names' => '',
			'fourofour_page_content_sitemap' => 1
		);
		$core_settings = wp_parse_args( $new_core_settings, $core_settings );
		update_option( 'catalyst_core_options', $core_settings );
		
		if( defined( 'DYNAMIK_ACTIVE' ) )
		{
			$dynamik_settings = get_option( 'catalyst_dynamik_options' );
			$new_dynamik_settings = array(
				'ez_static_home_sb_display' => '0',
				'ez_static_home_sb_location' => 'right',
				'ez_home_slider_display' => '0',
				'ez_home_slider_location' => 'outside',
				'ez_home_slider_height' => '300'
			);
			$dynamik_settings = wp_parse_args( $new_dynamik_settings, $dynamik_settings );
			update_option( 'catalyst_dynamik_options', $dynamik_settings );
		}
		
		update_option( 'catalyst_version_number', '1.3' );
	}
	
	// Update to Catalyst 1.3.1
	if( version_compare( get_option( 'catalyst_version_number' ), '1.3.1', '<' ) )
	{
		update_option( 'catalyst_version_number', '1.3.1' );
	}
	
	// Update to Catalyst 1.3.2
	if( version_compare( get_option( 'catalyst_version_number' ), '1.3.2', '<' ) )
	{
		if( defined( 'DYNAMIK_ACTIVE' ) )
		{
			$dynamik_settings = get_option( 'catalyst_dynamik_options' );
			$new_dynamik_settings = array(
				'ez_feature_top_position' => 'inside_wrap'
			);
			$dynamik_settings = wp_parse_args( $new_dynamik_settings, $dynamik_settings );
			update_option( 'catalyst_dynamik_options', $dynamik_settings );
		}
		
		update_option( 'catalyst_version_number', '1.3.2' );
	}
	
	// Update to Catalyst 1.3.3
	if( version_compare( get_option( 'catalyst_version_number' ), '1.3.3', '<' ) )
	{
		$core_settings = get_option( 'catalyst_core_options' );
		$new_core_settings = array(
			'byline_comment_sep_text' => '&middot;',
			'tag_meta_sep' => '-',
			'cat_tag_meta_sep' => ','
		);
		$core_settings = wp_parse_args( $new_core_settings, $core_settings );
		update_option( 'catalyst_core_options', $core_settings );
		
		update_option( 'catalyst_version_number', '1.3.3' );
	}
	
	// Update to Catalyst 1.3.4
	if( version_compare( get_option( 'catalyst_version_number' ), '1.3.4', '<' ) )
	{
		$core_settings = get_option( 'catalyst_core_options' );
		$new_core_settings = array(
			'post_author_box_link_text' => 'View all posts by [post_author] &raquo;'
		);
		$core_settings = wp_parse_args( $new_core_settings, $core_settings );
		update_option( 'catalyst_core_options', $core_settings );
		
		update_option( 'catalyst_version_number', '1.3.4' );
	}
	
	// Update to Catalyst 1.3.5
	if( version_compare( get_option( 'catalyst_version_number' ), '1.3.5', '<' ) )
	{
		$core_settings = get_option( 'catalyst_core_options' );
		$new_core_settings = array(
			'logo_links_to' => 'homepage',
			'alt_logo_link' => '',
			'alt_logo_link_title' => '',
			'post_author_box_link_text' => 'View all posts by [post_author] &raquo;',
			'gzip_compression_enable' => 0
		);
		$core_settings = wp_parse_args( $new_core_settings, $core_settings );
		update_option( 'catalyst_core_options', $core_settings );
		
		update_option( 'catalyst_version_number', '1.3.5' );
	}
	
	// Update to Catalyst 1.4
	if( version_compare( get_option( 'catalyst_version_number' ), '1.4', '<' ) )
	{
		if( !get_option( 'catalyst_custom_layouts' ) )
		{
			update_option( 'catalyst_custom_layouts', array() );
		}
		
		if( !get_option( 'catalyst_custom_widget_areas' ) )
		{
			update_option( 'catalyst_custom_widget_areas', array() );
		}
		
		if( !get_option( 'catalyst_custom_hook_boxes' ) )
		{
			update_option( 'catalyst_custom_hook_boxes', array() );
		}
		
		if( !get_option( 'catalyst_custom_hook_box_content' ) )
		{
			update_option( 'catalyst_custom_hook_box_content', array() );
		}
		
		catalyst_update_from_old_layouts();
		catalyst_update_from_old_widget_areas();
		catalyst_update_from_old_hook_boxes();
		
		update_option( 'catalyst_version_number', '1.4' );
	}
	
	// Update to Catalyst 1.4.1
	if( version_compare( get_option( 'catalyst_version_number' ), '1.4.1', '<' ) )
	{
		update_option( 'catalyst_version_number', '1.4.1' );
	}
	
	// Update to Catalyst 1.4.2
	if( version_compare( get_option( 'catalyst_version_number' ), '1.4.2', '<' ) )
	{
		$core_settings = get_option( 'catalyst_core_options' );
		$new_core_settings = array(
			'comment_author_form_label' => 'Name',
			'comment_email_form_label' => 'Email'
		);
		$core_settings = wp_parse_args( $new_core_settings, $core_settings );
		update_option( 'catalyst_core_options', $core_settings );
		
		update_option( 'catalyst_version_number', '1.4.2' );
	}
	
	// Update to Catalyst 1.5
	if( version_compare( get_option( 'catalyst_version_number' ), '1.5', '<' ) )
	{
		$core_settings = get_option( 'catalyst_core_options' );
		$new_core_settings = array(
			'dynamik_responsive' => 0,
			'modernizr_script_active' => 0,
			'respond_script_active' => 0
		);
		$core_settings = wp_parse_args( $new_core_settings, $core_settings );
		update_option( 'catalyst_core_options', $core_settings );
		
		if( defined( 'DYNAMIK_ACTIVE' ) )
		{
			$dynamik_settings = get_option( 'catalyst_dynamik_options' );
			$catalyst_dynamik_options = $dynamik_settings;
			$new_dynamik_settings = array(
				'body_font_size' => '13',
				'body_font_css' => '',
				'submit_text_hover_color' => $catalyst_dynamik_options['comment_submit_font_color'],
				'submit_text_hover_underline' => 'Never',
				'comment_submit_text_hover_u' => $catalyst_dynamik_options['comment_submit_font_u'],
				'comment_submit_hover_bg_type' => $catalyst_dynamik_options['comment_submit_bg_type'],
				'comment_submit_hover_bg_no_color' => $catalyst_dynamik_options['comment_submit_bg_no_color'],
				'comment_submit_hover_bg_color' => $catalyst_dynamik_options['comment_submit_bg_color'],
				'comment_submit_hover_bg_image' => $catalyst_dynamik_options['comment_submit_bg_image'],
				'comment_submit_hover_border_thickness' => $catalyst_dynamik_options['comment_submit_border_thickness'],
				'comment_submit_hover_border_style' => $catalyst_dynamik_options['comment_submit_border_style'],
				'comment_submit_hover_border_color' => $catalyst_dynamik_options['comment_submit_border_color'],
				'submit_button_padding_top' => '2',
				'submit_button_padding_right' => '2',
				'submit_button_padding_bottom' => '2',
				'submit_button_padding_left' => '2'
			);
			$dynamik_settings = wp_parse_args( $new_dynamik_settings, $dynamik_settings );
			update_option( 'catalyst_dynamik_options', $dynamik_settings );
		}
		
		update_option( 'catalyst_version_number', '1.5' );
	}
	
	// Update to Catalyst 1.5.1
	if( version_compare( get_option( 'catalyst_version_number' ), '1.5.1', '<' ) )
	{
		if( defined( 'DYNAMIK_ACTIVE' ) )
		{
			$dynamik_settings = get_option( 'catalyst_dynamik_options' );
			$catalyst_dynamik_options = $dynamik_settings;
			$new_dynamik_settings = array(
				'universal_heading_font_color' => '333333',
				'universal_heading_font_css' => '',
				'universal_content_font_color' => '111111',
				'universal_content_font_css' => '',
				'universal_px_em' => 'px',
				'universal_heading_px_em' => 'px',
				'universal_content_px_em' => 'px',
				'dynamik_options_control' => 'kitchen_sink',
				'nav1_px_em' => 'px',
				'nav1_right_px_em' => 'px',
				'nav1_sub_indicator_type' => 'Text',
				'nav1_sub_indicator_image' => '',
				'nav1_sub_indicator_width' => '16',
				'nav1_sub_indicator_height' => '16',
				'nav1_sub_indicator_top' => '11',
				'nav1_sub_indicator_right' => '8',
				'nav2_px_em' => 'px',
				'nav2_right_px_em' => 'px',
				'nav2_sub_indicator_type' => 'Text',
				'nav2_sub_indicator_image' => '',
				'nav2_sub_indicator_width' => '16',
				'nav2_sub_indicator_height' => '16',
				'nav2_sub_indicator_top' => '11',
				'nav2_sub_indicator_right' => '8',
				'content_heading_h1_h2_px_em_u' => 'u',
				'content_heading_h3_h6_px_em_u' => 'u'
			);
			$dynamik_settings = wp_parse_args( $new_dynamik_settings, $dynamik_settings );
			update_option( 'catalyst_dynamik_options', $dynamik_settings );
		}
		
		$catalyst_css_builder_options = get_option( 'catalyst_css_builder_options' );
		$advanced_settings = get_option( 'catalyst_advanced_options' );
		$new_advanced_settings = array(
			'custom_css' => $advanced_settings['custom_css'],
			'css_builder_popup_active' => $catalyst_css_builder_options['css_builder_popup_active'],
			'css_builder_popup_editor_only' => 0
		);
		$advanced_settings = wp_parse_args( $new_advanced_settings, $advanced_settings );
		update_option( 'catalyst_advanced_options', $advanced_settings );
		
		update_option( 'catalyst_version_number', '1.5.1' );
	}

	// Update to Catalyst 1.5.2
	if( version_compare( get_option( 'catalyst_version_number' ), '1.5.2', '<' ) )
	{
		$core_settings = get_option( 'catalyst_core_options' );
		$new_core_settings = array(
			'buddypress_layout_type' => 'catalyst_default',
			'bbpress_layout_type' => 'catalyst_default',
			'woocommerce_layout_type' => 'catalyst_default',
			'breadcrumbs_404' => 0,
			'breadcrumbs_text_404' => 'Page Not Found'
		);
		$core_settings = wp_parse_args( $new_core_settings, $core_settings );
		update_option( 'catalyst_core_options', $core_settings );

		update_option( 'catalyst_version_number', '1.5.2' );
	}

	// Update to Catalyst 1.5.3
	if( version_compare( get_option( 'catalyst_version_number' ), '1.5.3', '<' ) )
	{
		update_option( 'catalyst_version_number', '1.5.3' );
	}
	
	// Finish the update sequence.
	delete_transient( 'catalyst-update' );
	catalyst_activate();
	wp_redirect( admin_url( 'admin.php?page=catalyst&updated=catalyst' ) );
}

/**
 * Perform Catalyst activation actions.
 *
 * @since 1.0
 */
function catalyst_activate()
{
	global $catalyst_multisite, $catalyst_child_folders;
	
	require_once( CATALYST_FUNCTIONS . '/catalyst-create-tables.php' );
	catalyst_create_tables();
	
	if( !get_option( 'catalyst_version_number' ) )
	{
		update_option( 'catalyst_version_number', '1.5.3' );
	}
	
	if( !get_option( 'catalyst_core_options' ) )
	{
		update_option( 'catalyst_core_options', catalyst_core_options_defaults() );
	}
	
	if( !get_option( 'catalyst_custom_layouts' ) )
	{
		update_option( 'catalyst_custom_layouts', array() );
	}
	
	if( !get_option( 'catalyst_custom_widget_areas' ) )
	{
		update_option( 'catalyst_custom_widget_areas', array() );
	}
	
	if( !get_option( 'catalyst_custom_hook_boxes' ) )
	{
		update_option( 'catalyst_custom_hook_boxes', array() );
	}
	
	if( !get_option( 'catalyst_custom_hook_box_content' ) )
	{
		update_option( 'catalyst_custom_hook_box_content', array() );
	}
	
	if( defined( 'DYNAMIK_ACTIVE' ) )
	{
		if( !get_option( 'catalyst_dynamik_options' ) )
		{
			update_option( 'catalyst_dynamik_options', catalyst_dynamik_options_defaults() );
			$dynamik_font_type = catalyst_get_dynamik( 'font_type' );
			if( $dynamik_font_type )
			{
				foreach( $dynamik_font_type as $key => $value )
				{
					$dynamik_font_type[$key] = $value;
				}
			}
		}
		if( !get_option( 'catalyst_responsive_options' ) )
		{
			update_option( 'catalyst_responsive_options', catalyst_responsive_options_defaults() );
		}
		if( !get_option( 'catalyst_dynamik_snapshot_options' ) )
		{
			catalyst_dynamik_snapshot_update( $activation = true );
		}
		if( $catalyst_multisite )
		{
			if( !is_dir( CHILD_ROOT . '/css/images/' . $catalyst_multisite ) )
			{
				mkdir( CHILD_ROOT . '/css/images/' . $catalyst_multisite );
				@chmod( CHILD_ROOT . '/css/images/' . $catalyst_multisite, 0755 );
			}
			if( !is_dir( CHILD_ROOT . '/css/images/' . $catalyst_multisite . '/adminthumbnails' ) )
			{
				mkdir( CHILD_ROOT . '/css/images/' . $catalyst_multisite . '/adminthumbnails' );
				@chmod( CHILD_ROOT . '/css/images/' . $catalyst_multisite . '/adminthumbnails', 0755);
			}			
		}
		catalyst_write_styles();
	}
	
	if( defined( 'DYNAMIK_ACTIVE' ) )
	{
		$catalyst_unwritable = false;
		foreach( $catalyst_child_folders as $catalyst_child_folder )
		{
			if( is_dir( $catalyst_child_folder ) && !catalyst_writable( $catalyst_child_folder ) )
			{
				$catalyst_unwritable = true;
			}
		}
		if( $catalyst_unwritable )
		{
			wp_redirect( admin_url( 'admin.php?page=catalyst&unwritable=1' ) );
		}
	}
}

// ManageWP premium update functions.
if( !function_exists('catalyst_premium_update_push') )
{
	function catalyst_premium_update_push( $premium_update )
	{
		if( !function_exists( 'get_theme_data' ) )
			include_once( ABSPATH . 'wp-admin/includes/theme.php' );
		
		$catalyst = catalyst_update_check();
		if( version_compare( CATALYST_THEME_VERSION, $catalyst['new_version'], '<' ) && !empty( $catalyst['package'] ) )
		{
			$mytheme = get_theme_data( CATALYST_ROOT . '/style.css' );
			$mytheme['type'] = 'theme'; 
			$mytheme['Template'] = 'catalyst'; // If not set by default, always pass theme template
			$mytheme['new_version'] = isset( $catalyst['new_version'] ) ? $catalyst['new_version'] : false; // your theme's new version
			$premium_update[] = $mytheme;
		}
		
		return $premium_update;
	}
}

if( !function_exists( 'catalyst_premium_update' ) )
{
	function catalyst_premium_update( $premium_update )
	{
		if( !function_exists( 'get_theme_data' ) )
			include_once( ABSPATH.'wp-admin/includes/theme.php' );

		$catalyst = catalyst_update_check();
		if( version_compare( CATALYST_THEME_VERSION, $catalyst['new_version'], '<' ) && !empty( $catalyst['package'] ) )
		{
			$theme = get_theme_data( CATALYST_ROOT . '/style.css' );
			$theme['Template'] = 'catalyst'; // If not set by default, always pass theme template
			$theme['type'] = 'theme';
			$theme['url'] = isset( $catalyst["package"] ) ? $catalyst["package"] : false; // OR provide your own callback function for managing the update
			
			$premium_update[] = $theme;
		}
		
		return $premium_update;
	}
}

// ManageWP premium update filters.
add_filter( 'mwp_premium_update_notification', 'catalyst_premium_update_push' );
add_filter( 'mwp_premium_perform_update', 'catalyst_premium_update' );

//end lib/functions/catalyst-update.php