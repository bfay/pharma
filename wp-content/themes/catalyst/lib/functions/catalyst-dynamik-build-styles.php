<?php
/**
 * Builds and writes the Dynamik stylesheets.
 *
 * Note: This file is only called in if the
 * Dynamik Child Theme is active.
 *
 * @package Catalyst
 */

/**
 * Calculate the Catalyst CSS dimensions based on the current Dynamik settings.
 *
 * @since 1.0
 * @return the Catalyst CSS dimensions based on the current Dynamik settings.
 */
function catalyst_dimensions( $catalyst_layout_type = '', $cc_width = '', $sb1_width = '', $sb2_width = '' )
{
	$catalyst_dimensions = array();
	
	$dynamik_responsive = catalyst_get_core( 'dynamik_responsive' ) ? 1 : 0;

	// Content area widths
	$catalyst_dimensions['catalyst_layout_type'] = $catalyst_layout_type;
	$catalyst_dimensions['cc_width'] = $cc_width;
	$catalyst_dimensions['cc_width_css'] = !empty( $dynamik_responsive ) ? '' : 'width: ' . $cc_width . 'px;';
	$catalyst_dimensions['sb1_width'] = $sb1_width;
	$catalyst_dimensions['sb2_width'] = $sb2_width;
	$catalyst_dimensions['sb1_cat_width'] = $catalyst_dimensions['sb1_width'] - 22;
	$catalyst_dimensions['sb2_cat_width'] = $catalyst_dimensions['sb2_width'] - 22;
	
	if( !catalyst_get_dynamik( 'catalyst_widget_width' ) && catalyst_get_dynamik( 'catalyst_widget_width_type' ) == 'No Set Width' )
	{
		$catalyst_dimensions['catalyst_widget_width'] = '';
	}
	elseif( !catalyst_get_dynamik( 'catalyst_widget_width' ) && catalyst_get_dynamik( 'catalyst_widget_width_type' ) == '100% Width' )
	{
		$catalyst_dimensions['catalyst_widget_width'] = 'width: 100%;';
	}
	else
	{
		$catalyst_dimensions['catalyst_widget_width'] = !empty( $dynamik_responsive ) ? 'max-width: ' . catalyst_get_dynamik( 'catalyst_widget_width' ) . 'px;' : 'width: ' . catalyst_get_dynamik( 'catalyst_widget_width' ) . 'px;';
	}
	
	$catalyst_dimensions['catalyst_widget_float'] = catalyst_get_dynamik( 'catalyst_widget_float' );
	
	// Horizontal padding
	$catalyst_dimensions['wrap_lr_padding'] = catalyst_get_dynamik( 'wrap_lr_padding' );
	$catalyst_dimensions['container_wrap_tb_padding'] = catalyst_get_dynamik( 'container_wrap_tb_padding' );
	$catalyst_dimensions['container_wrap_lr_padding'] = catalyst_get_dynamik( 'container_wrap_lr_padding' );
	$catalyst_dimensions['sb_separation_padding'] = catalyst_get_dynamik( 'sb_separation_padding' );
	
	// Vertical margins and padding
	$catalyst_dimensions['wrap_top_margin'] = catalyst_get_dynamik( 'wrap_top_margin' );
	$catalyst_dimensions['wrap_bottom_margin'] = catalyst_get_dynamik( 'wrap_bottom_margin' );
	$catalyst_dimensions['wrap_tb_padding'] = catalyst_get_dynamik( 'wrap_tb_padding' );
	
	// Site layout if statements
	if( $catalyst_dimensions['catalyst_layout_type'] == 'double-right-sidebar' || $catalyst_dimensions['catalyst_layout_type'] == 'double-left-sidebar' || $catalyst_dimensions['catalyst_layout_type'] == 'double-sidebar' )
	{
		$catalyst_dimensions['cc_plus_sb_width'] = $catalyst_dimensions['cc_width'] + $catalyst_dimensions['sb1_width'] + $catalyst_dimensions['sb2_width'];
		$catalyst_dimensions['total_sb_separation_padding'] = $catalyst_dimensions['sb_separation_padding'] * 2;
	}
	elseif( $catalyst_dimensions['catalyst_layout_type'] == 'right-sidebar' || $catalyst_dimensions['catalyst_layout_type'] == 'left-sidebar' )
	{
		$catalyst_dimensions['cc_plus_sb_width'] = $catalyst_dimensions['cc_width'] + $catalyst_dimensions['sb1_width'];
		$catalyst_dimensions['total_sb_separation_padding'] = $catalyst_dimensions['sb_separation_padding'];
	}
	else
	{
		$catalyst_dimensions['cc_plus_sb_width'] = $catalyst_dimensions['cc_width'];
		$catalyst_dimensions['total_sb_separation_padding'] = 0;
	}
	
	if( catalyst_get_core( 'site_layout_type' ) == 'double-right-sidebar' || catalyst_get_core( 'site_layout_type' ) == 'double-left-sidebar' || catalyst_get_core( 'site_layout_type' ) == 'double-sidebar' )
	{
		$cc_plus_sb_width = catalyst_get_dynamik( 'cc_width' ) + catalyst_get_dynamik( 'sb1_width' ) + catalyst_get_dynamik( 'sb2_width' );
		$total_sb_separation_padding = $catalyst_dimensions['sb_separation_padding'] * 2;
	}
	elseif( catalyst_get_core( 'site_layout_type' ) == 'right-sidebar' || catalyst_get_core( 'site_layout_type' ) == 'left-sidebar' )
	{
		$cc_plus_sb_width = catalyst_get_dynamik( 'cc_width' ) + catalyst_get_dynamik( 'sb1_width' );
		$total_sb_separation_padding = $catalyst_dimensions['sb_separation_padding'];
	}
	else
	{
		$cc_plus_sb_width = catalyst_get_dynamik( 'cc_width' );
		$total_sb_separation_padding = 0;
	}

	// Wrap and containers total width calculations
	$catalyst_dimensions['container_width'] = $catalyst_dimensions['cc_plus_sb_width'] + $catalyst_dimensions['total_sb_separation_padding'];
	$container_width = $cc_plus_sb_width + $total_sb_separation_padding;
	$catalyst_dimensions['content_sb_wrap_width'] = !empty( $dynamik_responsive ) ? '100%' : $catalyst_dimensions['container_width'] . 'px';
	$catalyst_dimensions['content_sb_wrap_alt_width'] = !empty( $dynamik_responsive ) ? 'width: 100%;' : 'width: ' . ( $catalyst_dimensions['cc_width'] + $catalyst_dimensions['sb1_width'] + $catalyst_dimensions['sb_separation_padding'] ) . 'px;';
	$catalyst_dimensions['container_wrap_width'] = $catalyst_dimensions['container_width'];
	$catalyst_dimensions['wrap_width'] = $catalyst_dimensions['container_wrap_width'] + ( $catalyst_dimensions['container_wrap_lr_padding'] * 2 );
	$wrap_width = $container_width + ( $catalyst_dimensions['container_wrap_lr_padding'] * 2 );
	$catalyst_dimensions['media_wrap_width'] = $catalyst_dimensions['wrap_width'] + ( $catalyst_dimensions['wrap_lr_padding'] * 2 );
	$media_wrap_width = $wrap_width + ( $catalyst_dimensions['wrap_lr_padding'] * 2 );

	// Update the catalyst_responsive_options with the latest media_wrap_width value.
	if( get_option( 'catalyst_responsive_options' ) )
	{
		$media_wrap_width_array = array( 'media_wrap_width' => $media_wrap_width );
		$responsive_options_merged = array_merge( catalyst_get_responsive( null, $args = array( 'cached' => true, 'array' => true ) ), $media_wrap_width_array );
		update_option( 'catalyst_responsive_options', $responsive_options_merged );
	}
	else
	{
		update_option( 'catalyst_responsive_options', catalyst_responsive_options_defaults() );
	}
	
	if( !empty( $dynamik_responsive ) )
	{
		$catalyst_dimensions['content_wrap_width'] = '';
		$catalyst_dimensions['content_margins'] = '0 ' . ( $catalyst_dimensions['sb1_width'] + $catalyst_dimensions['sb2_width'] + ( $catalyst_dimensions['sb_separation_padding'] * 2 ) ) . 'px 0 0';
		$catalyst_dimensions['content_margins_dbl_lft_sb'] = 'margin: 0 0 0 ' . ( $catalyst_dimensions['sb1_width'] + $catalyst_dimensions['sb2_width'] + ( $catalyst_dimensions['sb_separation_padding'] * 2 ) ) . 'px;';
		$catalyst_dimensions['content_margins_rt_sb'] = 'margin: 0 ' . ( $catalyst_dimensions['sb1_width'] + $catalyst_dimensions['sb_separation_padding'] ) . 'px 0 0;';
		$catalyst_dimensions['content_margins_lft_sb'] = 'margin: 0 0 0 ' . ( $catalyst_dimensions['sb1_width'] + $catalyst_dimensions['sb_separation_padding'] ) . 'px;';
		$catalyst_dimensions['content_margins_dbl_sb'] = 'margin: 0 ' . ( $catalyst_dimensions['sb2_width'] + $catalyst_dimensions['sb_separation_padding'] ) . 'px 0 ' . ( $catalyst_dimensions['sb1_width'] + $catalyst_dimensions['sb_separation_padding'] ) . 'px;';
		$catalyst_dimensions['content_margins_no_sb'] = 'margin: 0;';
		$catalyst_dimensions['content_float'] = '';
		$catalyst_dimensions['content_clear'] = 'clear: both;';
		$catalyst_dimensions['content_overflow'] = 'overflow: hidden;';
		$catalyst_dimensions['content_wrap_dbl_sb_float'] = 'float: left;';
	}
	else
	{
		$catalyst_dimensions['content_wrap_width'] = 'width: ' . $catalyst_dimensions['cc_width'] . 'px;';
		$catalyst_dimensions['content_margins'] = '0';
		$catalyst_dimensions['content_margins_dbl_lft_sb'] = '';
		$catalyst_dimensions['content_margins_rt_sb'] = '';
		$catalyst_dimensions['content_margins_lft_sb'] = '';
		$catalyst_dimensions['content_margins_dbl_sb'] = '';
		$catalyst_dimensions['content_margins_no_sb'] = '';
		$catalyst_dimensions['content_float'] = 'float: left;';
		$catalyst_dimensions['content_clear'] = '';
		$catalyst_dimensions['content_overflow'] = '';
		$catalyst_dimensions['content_wrap_dbl_sb_float'] = '';
	}
	
	$catalyst_dimensions['media1_home_slider_inside_sb_margin'] = $catalyst_dimensions['sb1_width'] + $catalyst_dimensions['sb_separation_padding'];
	$catalyst_dimensions['media1_content_margins'] = 'margin: 0 ' . ( $catalyst_dimensions['sb1_width'] + $catalyst_dimensions['sb_separation_padding'] ) . 'px 0 0;';
	$catalyst_dimensions['media1_dbl_lft_sb_content_margins'] = 'margin: 0 0 0 ' . ( $catalyst_dimensions['sb1_width'] + $catalyst_dimensions['sb_separation_padding'] ) . 'px;';
		
	$catalyst_dimensions['dual_sidebar_outer_width'] = $catalyst_dimensions['sb1_width'] + $catalyst_dimensions['sb2_width'] + $catalyst_dimensions['sb_separation_padding'];
	if( !empty( $dynamik_responsive ) )
	{
		$catalyst_dimensions['dual_sidebar_outer_margin_left'] = 'margin-left: -' . $catalyst_dimensions['dual_sidebar_outer_width'] . 'px;';
		$catalyst_dimensions['dual_sidebar_outer_margin_left_alt'] = 'margin-left: 0;';
		$catalyst_dimensions['dual_sidebar_outer_margin_right'] = 'margin-right: -' . $catalyst_dimensions['dual_sidebar_outer_width'] . 'px;';
		$catalyst_dimensions['sb1_rt_margins'] = 'margin-left: -' . $catalyst_dimensions['sb1_width'] . 'px;';
		$catalyst_dimensions['sb1_lft_margins'] = 'margin-right: -' . $catalyst_dimensions['sb1_width'] . 'px;';
		$catalyst_dimensions['sb1_dbl_margins'] = 'margin-left: -100%;';
		$catalyst_dimensions['sb2_dbl_margins'] = 'margin-left: -' . $catalyst_dimensions['sb2_width'] . 'px;';
	}
	else
	{		
		$catalyst_dimensions['dual_sidebar_outer_margin_left'] = '';
		$catalyst_dimensions['dual_sidebar_outer_margin_left_alt'] = '';
		$catalyst_dimensions['dual_sidebar_outer_margin_right'] = '';
		$catalyst_dimensions['sb1_rt_margins'] = '';
		$catalyst_dimensions['sb1_lft_margins'] = '';
		$catalyst_dimensions['sb1_dbl_margins'] = '';
		$catalyst_dimensions['sb2_dbl_margins'] = '';
	}
	
	// EZ Widget Area width calculations
	$catalyst_dimensions['ez_widget_home_border_thickness'] = catalyst_get_dynamik( 'ez_widget_home_border_thickness' );
	if( catalyst_get_dynamik( 'ez_widget_home_border_type' ) == 'Full' || catalyst_get_dynamik( 'ez_widget_home_border_type' ) == 'Left/Right' )
	{
		$catalyst_dimensions['ez_widget_home_lr_border_thickness'] = $catalyst_dimensions['ez_widget_home_border_thickness'] * 2;
	}
	else
	{
		$catalyst_dimensions['ez_widget_home_lr_border_thickness'] = 0;
	}
	$catalyst_dimensions['ez_padding_left'] = !empty( $dynamik_responsive ) ? '' : 'padding-left: 29px;';
	$catalyst_dimensions['ez_home_lr_padding'] = catalyst_get_dynamik( 'ez_widget_home_padding_left' ) + catalyst_get_dynamik( 'ez_widget_home_padding_right' );
	$catalyst_dimensions['ez_home_container_wrap_width'] = $catalyst_dimensions['wrap_width'] - $catalyst_dimensions['ez_home_lr_padding'] - $catalyst_dimensions['ez_widget_home_lr_border_thickness'];
	$catalyst_dimensions['ez_home_container_wrap_width_css'] = !empty( $dynamik_responsive ) ? '' : 'width: ' . ( $catalyst_dimensions['wrap_width'] - $catalyst_dimensions['ez_home_lr_padding'] - $catalyst_dimensions['ez_widget_home_lr_border_thickness'] ) . 'px;';
	$catalyst_dimensions['ez_home_container_wrap_with_sb_width'] = $catalyst_dimensions['ez_home_container_wrap_width'] - 300;
	$catalyst_dimensions['ez_home_container_wrap_with_sb_width_css'] = !empty( $dynamik_responsive ) ? '' : 'width: ' . $catalyst_dimensions['ez_home_container_wrap_with_sb_width'] . 'px;';
	$catalyst_dimensions['ez_home_container_wrap_with_sb_rt_spacing'] = !empty( $dynamik_responsive ) ? 'margin-right: 300px;' : 'padding-right: 20px;';
	$catalyst_dimensions['ez_home_container_wrap_with_sb_lft_spacing'] = !empty( $dynamik_responsive ) ? 'margin-left: 300px;' : 'padding-left: 20px;';
	$catalyst_dimensions['ez_home_container_wrap_with_sb_rt_alt_spacing'] = !empty( $dynamik_responsive ) ? 'margin-right: 0;' : 'padding-right: 0;';
	$catalyst_dimensions['ez_home_3_width'] = !empty( $dynamik_responsive ) ? '' : 'width: ' . ( ( $catalyst_dimensions['ez_home_container_wrap_width'] / 3 ) - 20 ) . 'px;';
	$catalyst_dimensions['ez_home_2_width'] = !empty( $dynamik_responsive ) ? '' : 'width: ' . ( ( $catalyst_dimensions['ez_home_container_wrap_width'] / 2 ) - 15 ) . 'px;';
	$catalyst_dimensions['ez_home_wide_width'] = !empty( $dynamik_responsive ) ? '' : 'width: ' . ( ( ( $catalyst_dimensions['ez_home_container_wrap_width'] / 3 ) * 2 ) - 11 ) . 'px;';
	$catalyst_dimensions['ez_home_3_with_sb_width'] = !empty( $dynamik_responsive ) ? '' : 'width: ' . ( ( ( $catalyst_dimensions['ez_home_container_wrap_width'] - 300 ) / 3 ) - 20 ) . 'px;';
	$catalyst_dimensions['ez_home_2_with_sb_width'] = !empty( $dynamik_responsive ) ? '' : 'width: ' . ( ( ( $catalyst_dimensions['ez_home_container_wrap_width'] - 300 ) / 2 ) - 15 ) . 'px;';
	$catalyst_dimensions['ez_home_wide_with_sb_width'] = !empty( $dynamik_responsive ) ? '' : 'width: ' . ( ( ( ( $catalyst_dimensions['ez_home_container_wrap_width'] - 300 ) / 3 ) * 2 ) - 11 ) . 'px;';
	$catalyst_dimensions['ez_home_sb_margin_lft'] = !empty( $dynamik_responsive ) ? 'margin-left: -280px;' : '';
	$catalyst_dimensions['ez_home_sb_margin_rt'] = !empty( $dynamik_responsive ) ? 'margin-right: -280px;' : '';
	$catalyst_dimensions['ez_home_sb_alt_margin_lft'] = !empty( $dynamik_responsive ) ? 'margin-left: 0;' : '';
	$catalyst_dimensions['ez_home_slider_width'] = !empty( $dynamik_responsive ) ? '' : 'width: ' . $catalyst_dimensions['container_width'] . 'px;';
	$catalyst_dimensions['ez_home_slider_child_home_width'] = !empty( $dynamik_responsive ) ? '' : 'width: ' . $catalyst_dimensions['ez_home_container_wrap_width'] . 'px;';
	$catalyst_dimensions['ez_home_slider_inside_home_sb_width'] = !empty( $dynamik_responsive ) ? '' : 'width: ' . $catalyst_dimensions['ez_home_container_wrap_with_sb_width'] . 'px;';
	$catalyst_dimensions['ez_home_slider_cc_width'] = !empty( $dynamik_responsive ) ? '' : 'width: ' . $cc_width . 'px;';
	$catalyst_dimensions['ez_home_slider_inside_dbl_lft_sb_margins'] = !empty( $dynamik_responsive ) ? 'margin: 0 0 20px ' . ( $catalyst_dimensions['sb1_width'] + $catalyst_dimensions['sb2_width'] + ( $catalyst_dimensions['sb_separation_padding'] * 2 ) ) . 'px;' : '';
	$catalyst_dimensions['ez_home_slider_inside_dbl_rt_sb_margins'] = !empty( $dynamik_responsive ) ? 'margin: 0 ' . ( $catalyst_dimensions['sb1_width'] + $catalyst_dimensions['sb2_width'] + ( $catalyst_dimensions['sb_separation_padding'] * 2 ) ) . 'px 20px 0;' : '';
	$catalyst_dimensions['ez_home_slider_inside_dbl_sb_margins'] = !empty( $dynamik_responsive ) ? 'margin: 0 ' . ( $catalyst_dimensions['sb2_width'] + $catalyst_dimensions['sb_separation_padding'] ) . 'px 20px ' . ( $catalyst_dimensions['sb1_width'] + $catalyst_dimensions['sb_separation_padding'] ) . 'px;' : '';
	$catalyst_dimensions['ez_home_slider_inside_lft_sb_margins'] = !empty( $dynamik_responsive ) ? 'margin: 0 0 20px ' . ( $catalyst_dimensions['sb1_width'] + $catalyst_dimensions['sb_separation_padding'] ) . 'px;' : '';
	$catalyst_dimensions['ez_home_slider_inside_rt_sb_margins'] = !empty( $dynamik_responsive ) ? 'margin: 0 ' . ( $catalyst_dimensions['sb1_width'] + $catalyst_dimensions['sb_separation_padding'] ) . 'px 20px 0;' : '';
	
	$catalyst_dimensions['ez_widget_feature_border_thickness'] = catalyst_get_dynamik( 'ez_widget_feature_border_thickness' );
	if( catalyst_get_dynamik( 'ez_widget_feature_border_type' ) == 'Full' || catalyst_get_dynamik( 'ez_widget_feature_border_type' ) == 'Left/Right' )
	{
		$catalyst_dimensions['ez_widget_feature_lr_border_thickness'] = $catalyst_dimensions['ez_widget_feature_border_thickness'] * 2;
	}
	else
	{
		$catalyst_dimensions['ez_widget_feature_lr_border_thickness'] = 0;
	}
	
	$catalyst_dimensions['ez_feature_top_lr_padding'] = catalyst_get_dynamik( 'ez_widget_feature_padding_left' ) + catalyst_get_dynamik( 'ez_widget_feature_padding_right' );
	$catalyst_dimensions['ez_feature_top_total_width'] = $catalyst_dimensions['wrap_width'] - $catalyst_dimensions['ez_feature_top_lr_padding'] - $catalyst_dimensions['ez_widget_feature_lr_border_thickness'];
	$catalyst_dimensions['ez_feature_top_container_width'] = !empty( $dynamik_responsive ) ? 'max-width: ' . $catalyst_dimensions['ez_feature_top_total_width'] . 'px;' : 'width: ' . $catalyst_dimensions['ez_feature_top_total_width'] . 'px;';
	$catalyst_dimensions['ez_feature_top_4_width'] = !empty( $dynamik_responsive ) ? '' : 'width: ' . ( ( $catalyst_dimensions['ez_feature_top_total_width'] / 4 ) - 22 ) . 'px;';
	$catalyst_dimensions['ez_feature_top_3_width'] = !empty( $dynamik_responsive ) ? '' : 'width: ' . ( ( $catalyst_dimensions['ez_feature_top_total_width'] / 3 ) - 20 ) . 'px;';
	$catalyst_dimensions['ez_feature_top_2_width'] = !empty( $dynamik_responsive ) ? '' : 'width: ' . ( ( $catalyst_dimensions['ez_feature_top_total_width'] / 2 ) - 15 ) . 'px;';
	$catalyst_dimensions['ez_feature_top_1_width'] = !empty( $dynamik_responsive ) ? '' : 'width: ' . $catalyst_dimensions['ez_feature_top_total_width'] . 'px;';
	$catalyst_dimensions['ez_feature_top_wide_width'] = !empty( $dynamik_responsive ) ? '' : 'width: ' . ( ( ( $catalyst_dimensions['ez_feature_top_total_width'] / 3 ) * 2 ) - 11 ) . 'px;';
	
	$catalyst_dimensions['ez_widget_footer_border_thickness'] = catalyst_get_dynamik( 'ez_widget_footer_border_thickness' );
	if( catalyst_get_dynamik( 'ez_widget_footer_border_type' ) == 'Full' || catalyst_get_dynamik( 'ez_widget_footer_border_type' ) == 'Left/Right' )
	{
		$catalyst_dimensions['ez_widget_footer_lr_border_thickness'] = $catalyst_dimensions['ez_widget_footer_border_thickness'] * 2;
	}
	else
	{
		$catalyst_dimensions['ez_widget_footer_lr_border_thickness'] = 0;
	}
	
	$catalyst_dimensions['ez_fat_footer_lr_padding'] = catalyst_get_dynamik( 'ez_widget_footer_padding_left' ) + catalyst_get_dynamik( 'ez_widget_footer_padding_right' );
	$catalyst_dimensions['ez_fat_footer_total_width'] = $catalyst_dimensions['wrap_width'] - $catalyst_dimensions['ez_fat_footer_lr_padding'] - $catalyst_dimensions['ez_widget_feature_lr_border_thickness'];
	$catalyst_dimensions['ez_fat_footer_4_width'] = !empty( $dynamik_responsive ) ? '' : 'width: ' . ( ( $catalyst_dimensions['ez_fat_footer_total_width'] / 4 ) - 22 ) . 'px;';
	$catalyst_dimensions['ez_fat_footer_3_width'] = !empty( $dynamik_responsive ) ? '' : 'width: ' . ( ( $catalyst_dimensions['ez_fat_footer_total_width'] / 3 ) - 20 ) . 'px;';
	$catalyst_dimensions['ez_fat_footer_2_width'] = !empty( $dynamik_responsive ) ? '' : 'width: ' . ( ( $catalyst_dimensions['ez_fat_footer_total_width'] / 2 ) - 15 ) . 'px;';
	$catalyst_dimensions['ez_fat_footer_1_width'] = !empty( $dynamik_responsive ) ? '' : 'width: ' . $catalyst_dimensions['ez_fat_footer_total_width'] . 'px;';
	$catalyst_dimensions['ez_fat_footer_wide_width'] = !empty( $dynamik_responsive ) ? '' : 'width: ' . ( ( ( $catalyst_dimensions['ez_fat_footer_total_width'] / 3 ) * 2 ) - 11 ) . 'px;';
	
	// Header/Logo widths/height/margins/padding
	$catalyst_dimensions['header_border_thickness'] = catalyst_get_dynamik( 'header_border_thickness' );
	
	if( catalyst_get_dynamik( 'header_border_type' ) == 'Full' || catalyst_get_dynamik( 'header_border_type' ) == 'Left/Right' )
	{
		$catalyst_dimensions['header_width'] = $catalyst_dimensions['wrap_width'] - ( $catalyst_dimensions['header_border_thickness'] * 2 );
	}
	else
	{
		$catalyst_dimensions['header_width'] = $catalyst_dimensions['wrap_width'];
	}
	
	$catalyst_dimensions['header_height'] = catalyst_get_dynamik( 'header_height' );
	$catalyst_dimensions['header_right_width'] = catalyst_get_dynamik( 'header_right_width' );
	$catalyst_dimensions['text_logo_top_padding'] = catalyst_get_dynamik( 'text_logo_top_padding' );
	$catalyst_dimensions['text_logo_left_padding'] = catalyst_get_dynamik( 'text_logo_left_padding' );
	$catalyst_dimensions['tagline_top_padding'] = catalyst_get_dynamik( 'tagline_top_padding' );
	$catalyst_dimensions['image_logo_top_margin'] = catalyst_get_dynamik( 'image_logo_top_margin' );
	$catalyst_dimensions['image_logo_left_margin'] = catalyst_get_dynamik( 'image_logo_left_margin' );
	$catalyst_dimensions['header_logo_height'] = catalyst_get_dynamik( 'header_height' ) - $catalyst_dimensions['image_logo_top_margin'];
	$catalyst_dimensions['header_right_top_padding'] = catalyst_get_dynamik( 'header_right_top_padding' );
	$catalyst_dimensions['header_right_right_padding'] = catalyst_get_dynamik( 'header_right_right_padding' );
	
	if( catalyst_get_core( 'header_right_active' ) )
	{
		$catalyst_dimensions['header_left_width'] = $catalyst_dimensions['header_left_full_width'] = catalyst_get_dynamik( 'header_left_width' ) . 'px';
	}
	elseif( !catalyst_get_core( 'header_right_active' ) && catalyst_get_core( 'logo_type' ) == 'Image' )
	{
		$catalyst_dimensions['header_left_width'] = $catalyst_dimensions['header_left_full_width'] = $catalyst_dimensions['header_width'] - $catalyst_dimensions['image_logo_left_margin'] . 'px';
	}
	else
	{
		$catalyst_dimensions['header_left_width'] = $catalyst_dimensions['header_left_full_width'] = $catalyst_dimensions['header_width'] - $catalyst_dimensions['text_logo_left_padding'] . 'px';
	}
	
	if( !empty( $dynamik_responsive ) )
	{
		$catalyst_dimensions['header_left_full_width'] = '100%';
	}
	
	// Navbar 1 & Navbar 2 widths
	$catalyst_dimensions['nav1_border_thickness'] = catalyst_get_dynamik( 'nav1_border_thickness' );
	
	if( catalyst_get_dynamik( 'nav1_location' ) != 'Beside Header' )
	{
		if( catalyst_get_dynamik( 'nav1_border_type' ) == 'Full' || catalyst_get_dynamik( 'nav1_border_type' ) == 'Left/Right' )
		{
			if( !empty( $dynamik_responsive ) )
			{
				$catalyst_dimensions['nav1_width'] = 'max-width: ' . ( $catalyst_dimensions['wrap_width'] - ( $catalyst_dimensions['nav1_border_thickness'] * 2 ) ) . 'px;';
			}
			else
			{
				$catalyst_dimensions['nav1_width'] = 'width: ' . ( $catalyst_dimensions['wrap_width'] - ( $catalyst_dimensions['nav1_border_thickness'] * 2 ) ) . 'px;';
			}
		}
		else
		{
			if( !empty( $dynamik_responsive ) )
			{
				$catalyst_dimensions['nav1_width'] = 'max-width: ' . $catalyst_dimensions['wrap_width'] . 'px;';
			}
			else
			{
				$catalyst_dimensions['nav1_width'] = 'width: ' . $catalyst_dimensions['wrap_width'] . 'px;';
			}
		}
	}
	else
	{
		$catalyst_dimensions['nav1_width'] = 'width: 100%;';
	}
	
	$catalyst_dimensions['nav2_border_thickness'] = catalyst_get_dynamik( 'nav2_border_thickness' );
	
	if( catalyst_get_dynamik( 'nav2_border_type' ) == 'Full' || catalyst_get_dynamik( 'nav2_border_type' ) == 'Left/Right' )
	{
		if( !empty( $dynamik_responsive ) )
		{
			$catalyst_dimensions['nav2_width'] = 'max-width: ' . ( $catalyst_dimensions['wrap_width'] - ( $catalyst_dimensions['nav2_border_thickness'] * 2 ) ) . 'px;';
		}
		else
		{
			$catalyst_dimensions['nav2_width'] = 'width: ' . ( $catalyst_dimensions['wrap_width'] - ( $catalyst_dimensions['nav2_border_thickness'] * 2 ) ) . 'px;';
		}
	}
	else
	{
		if( !empty( $dynamik_responsive ) )
		{
			$catalyst_dimensions['nav2_width'] = 'max-width: ' . $catalyst_dimensions['wrap_width'] . 'px;';
		}
		else
		{
			$catalyst_dimensions['nav2_width'] = 'width: ' . $catalyst_dimensions['wrap_width'] . 'px;';
		}
	}
	
	// Breadcrumbs margins/padding
	$catalyst_dimensions['breadcrumbs_margin_top'] = catalyst_get_dynamik( 'breadcrumbs_margin_top' );
	$catalyst_dimensions['breadcrumbs_margin_bottom'] = catalyst_get_dynamik( 'breadcrumbs_margin_bottom' );
	$catalyst_dimensions['breadcrumbs_padding_top'] = catalyst_get_dynamik( 'breadcrumbs_padding_top' );
	$catalyst_dimensions['breadcrumbs_padding_right'] = catalyst_get_dynamik( 'breadcrumbs_padding_right' );
	$catalyst_dimensions['breadcrumbs_padding_bottom'] = catalyst_get_dynamik( 'breadcrumbs_padding_bottom' );
	$catalyst_dimensions['breadcrumbs_padding_left'] = catalyst_get_dynamik( 'breadcrumbs_padding_left' );
	
	// Post Content margins/padding
	$catalyst_dimensions['post_content_margin_top'] = catalyst_get_dynamik( 'post_content_margin_top' );
	$catalyst_dimensions['post_content_margin_bottom'] = catalyst_get_dynamik( 'post_content_margin_bottom' );
	$catalyst_dimensions['post_content_padding_top'] = catalyst_get_dynamik( 'post_content_padding_top' );
	$catalyst_dimensions['post_content_padding_right'] = catalyst_get_dynamik( 'post_content_padding_right' );
	$catalyst_dimensions['post_content_padding_bottom'] = catalyst_get_dynamik( 'post_content_padding_bottom' );
	$catalyst_dimensions['post_content_padding_left'] = catalyst_get_dynamik( 'post_content_padding_left' );
	
	// Page Content margins/padding
	$catalyst_dimensions['page_content_margin_top'] = catalyst_get_dynamik( 'page_content_margin_top' );
	$catalyst_dimensions['page_content_margin_bottom'] = catalyst_get_dynamik( 'page_content_margin_bottom' );
	$catalyst_dimensions['page_content_padding_top'] = catalyst_get_dynamik( 'page_content_padding_top' );
	$catalyst_dimensions['page_content_padding_right'] = catalyst_get_dynamik( 'page_content_padding_right' );
	$catalyst_dimensions['page_content_padding_bottom'] = catalyst_get_dynamik( 'page_content_padding_bottom' );
	$catalyst_dimensions['page_content_padding_left'] = catalyst_get_dynamik( 'page_content_padding_left' );
	
	// Sticky-Post margins/padding
	$catalyst_dimensions['sticky_post_margin_top'] = catalyst_get_dynamik( 'sticky_post_margin_top' );
	$catalyst_dimensions['sticky_post_margin_bottom'] = catalyst_get_dynamik( 'sticky_post_margin_bottom' );
	$catalyst_dimensions['sticky_post_padding_top'] = catalyst_get_dynamik( 'sticky_post_padding_top' );
	$catalyst_dimensions['sticky_post_padding_right'] = catalyst_get_dynamik( 'sticky_post_padding_right' );
	$catalyst_dimensions['sticky_post_padding_bottom'] = catalyst_get_dynamik( 'sticky_post_padding_bottom' );
	$catalyst_dimensions['sticky_post_padding_left'] = catalyst_get_dynamik( 'sticky_post_padding_left' );
	
	// Content Paragraph/List-Style padding
	$catalyst_dimensions['content_paragraph_padding_bottom'] = catalyst_get_dynamik( 'content_paragraph_padding_bottom' );
	$catalyst_dimensions['content_list_style_padding_bottom'] = catalyst_get_dynamik( 'content_list_style_padding_bottom' );
	
	// Hybrid Columns Excerpt Width
	if( !catalyst_get_dynamik( 'hybrid_column_excerpt_width' ) )
	{
		$catalyst_dimensions['hybrid_column_excerpt_width'] = '48%';
	}
	else
	{
		$catalyst_dimensions['hybrid_column_excerpt_width'] = catalyst_get_dynamik( 'hybrid_column_excerpt_width' );
	}
	
	// EZ Widget padding
	$catalyst_dimensions['ez_widget_home_padding_top'] = catalyst_get_dynamik( 'ez_widget_home_padding_top' );
	$catalyst_dimensions['ez_widget_home_padding_right'] = catalyst_get_dynamik( 'ez_widget_home_padding_right' );
	$catalyst_dimensions['ez_widget_home_padding_bottom'] = catalyst_get_dynamik( 'ez_widget_home_padding_bottom' );
	$catalyst_dimensions['ez_widget_home_padding_left'] = catalyst_get_dynamik( 'ez_widget_home_padding_left' );
	$catalyst_dimensions['ez_widget_feature_padding_top'] = catalyst_get_dynamik( 'ez_widget_feature_padding_top' );
	$catalyst_dimensions['ez_widget_feature_padding_right'] = catalyst_get_dynamik( 'ez_widget_feature_padding_right' );
	$catalyst_dimensions['ez_widget_feature_padding_bottom'] = catalyst_get_dynamik( 'ez_widget_feature_padding_bottom' );
	$catalyst_dimensions['ez_widget_feature_padding_left'] = catalyst_get_dynamik( 'ez_widget_feature_padding_left' );
	$catalyst_dimensions['ez_widget_footer_padding_top'] = catalyst_get_dynamik( 'ez_widget_footer_padding_top' );
	$catalyst_dimensions['ez_widget_footer_padding_right'] = catalyst_get_dynamik( 'ez_widget_footer_padding_right' );
	$catalyst_dimensions['ez_widget_footer_padding_bottom'] = catalyst_get_dynamik( 'ez_widget_footer_padding_bottom' );
	$catalyst_dimensions['ez_widget_footer_padding_left'] = catalyst_get_dynamik( 'ez_widget_footer_padding_left' );
	
	// EZ Home Slider height
	$catalyst_dimensions['ez_home_slider_height'] = catalyst_get_dynamik( 'ez_home_slider_height' );
	
	// Catalyst/Excerpt Widget margins/padding
	$catalyst_dimensions['excerpt_widget_margin_top'] = catalyst_get_dynamik( 'excerpt_widget_margin_top' );
	$catalyst_dimensions['excerpt_widget_margin_right'] = catalyst_get_dynamik( 'excerpt_widget_margin_right' );
	$catalyst_dimensions['excerpt_widget_margin_bottom'] = catalyst_get_dynamik( 'excerpt_widget_margin_bottom' );
	$catalyst_dimensions['excerpt_widget_margin_left'] = catalyst_get_dynamik( 'excerpt_widget_margin_left' );
	$catalyst_dimensions['excerpt_widget_padding_top'] = catalyst_get_dynamik( 'excerpt_widget_padding_top' );
	$catalyst_dimensions['excerpt_widget_padding_right'] = catalyst_get_dynamik( 'excerpt_widget_padding_right' );
	$catalyst_dimensions['excerpt_widget_padding_bottom'] = catalyst_get_dynamik( 'excerpt_widget_padding_bottom' );
	$catalyst_dimensions['excerpt_widget_padding_left'] = catalyst_get_dynamik( 'excerpt_widget_padding_left' );
	$catalyst_dimensions['catalyst_widget_margin_top'] = catalyst_get_dynamik( 'catalyst_widget_margin_top' );
	$catalyst_dimensions['catalyst_widget_margin_right'] = catalyst_get_dynamik( 'catalyst_widget_margin_right' );
	$catalyst_dimensions['catalyst_widget_margin_bottom'] = catalyst_get_dynamik( 'catalyst_widget_margin_bottom' );
	$catalyst_dimensions['catalyst_widget_margin_left'] = catalyst_get_dynamik( 'catalyst_widget_margin_left' );
	$catalyst_dimensions['catalyst_widget_padding_top'] = catalyst_get_dynamik( 'catalyst_widget_padding_top' );
	$catalyst_dimensions['catalyst_widget_padding_right'] = catalyst_get_dynamik( 'catalyst_widget_padding_right' );
	$catalyst_dimensions['catalyst_widget_padding_bottom'] = catalyst_get_dynamik( 'catalyst_widget_padding_bottom' );
	$catalyst_dimensions['catalyst_widget_padding_left'] = catalyst_get_dynamik( 'catalyst_widget_padding_left' );
	
	// Post-Nav margins/padding
	$catalyst_dimensions['post_nav_padding_top'] = catalyst_get_dynamik( 'post_nav_padding_top' );
	$catalyst_dimensions['post_nav_padding_bottom'] = catalyst_get_dynamik( 'post_nav_padding_bottom' );
	$catalyst_dimensions['post_nav_numbered_margin_left'] = catalyst_get_dynamik( 'post_nav_numbered_margin_left' );
	$catalyst_dimensions['post_nav_numbered_margin_right'] = catalyst_get_dynamik( 'post_nav_numbered_margin_right' );
	$catalyst_dimensions['post_nav_numbered_tb_padding'] = catalyst_get_dynamik( 'post_nav_numbered_tb_padding' );
	$catalyst_dimensions['post_nav_numbered_lr_padding'] = catalyst_get_dynamik( 'post_nav_numbered_lr_padding' );
	
	// Thumbnails image padding
	$catalyst_dimensions['thumbnail_image_padding'] = catalyst_get_dynamik( 'thumbnail_image_padding' );
	
	// Comment Widths/Margin/Padding
	$catalyst_dimensions['comment_avatar_size'] = catalyst_get_dynamik( 'comment_avatar_size' );
	$catalyst_dimensions['comment_avatar_padding'] = catalyst_get_dynamik( 'comment_avatar_padding' );
	$catalyst_dimensions['comment_author_email_url_width'] = catalyst_get_dynamik( 'comment_author_email_url_width' );
	
	if( catalyst_get_dynamik( 'comment_form_width' ) == '' )
	{
		$catalyst_dimensions['comment_form_width'] = '100%';
	}
	else
	{
		$catalyst_dimensions['comment_form_width'] = catalyst_get_dynamik( 'comment_form_width' ) . 'px';
	}
	
	$catalyst_dimensions['comment_submit_width'] = catalyst_get_dynamik( 'comment_submit_width' );
	
	$catalyst_dimensions['comment_wrap_margin_top'] = catalyst_get_dynamik( 'comment_wrap_margin_top' );
	$catalyst_dimensions['comment_wrap_margin_bottom'] = catalyst_get_dynamik( 'comment_wrap_margin_bottom' );
	$catalyst_dimensions['comment_wrap_padding_top'] = catalyst_get_dynamik( 'comment_wrap_padding_top' );
	$catalyst_dimensions['comment_wrap_padding_right'] = catalyst_get_dynamik( 'comment_wrap_padding_right' );
	$catalyst_dimensions['comment_wrap_padding_bottom'] = catalyst_get_dynamik( 'comment_wrap_padding_bottom' );
	$catalyst_dimensions['comment_wrap_padding_left'] = catalyst_get_dynamik( 'comment_wrap_padding_left' );
	$catalyst_dimensions['comment_list_margin_top'] = catalyst_get_dynamik( 'comment_list_margin_top' );
	$catalyst_dimensions['comment_list_margin_bottom'] = catalyst_get_dynamik( 'comment_list_margin_bottom' );
	$catalyst_dimensions['comment_list_padding_top'] = catalyst_get_dynamik( 'comment_list_padding_top' );
	$catalyst_dimensions['comment_list_padding_right'] = catalyst_get_dynamik( 'comment_list_padding_right' );
	$catalyst_dimensions['comment_list_padding_bottom'] = catalyst_get_dynamik( 'comment_list_padding_bottom' );
	$catalyst_dimensions['comment_list_padding_left'] = catalyst_get_dynamik( 'comment_list_padding_left' );
	
	$catalyst_dimensions['submit_button_padding_top'] = catalyst_get_dynamik( 'submit_button_padding_top' );
	$catalyst_dimensions['submit_button_padding_right'] = catalyst_get_dynamik( 'submit_button_padding_right' );
	$catalyst_dimensions['submit_button_padding_bottom'] = catalyst_get_dynamik( 'submit_button_padding_bottom' );
	$catalyst_dimensions['submit_button_padding_left'] = catalyst_get_dynamik( 'submit_button_padding_left' );
	
	$catalyst_dimensions['comments_nav_margin_top'] = catalyst_get_dynamik( 'comments_nav_margin_top' );
	$catalyst_dimensions['comments_nav_margin_bottom'] = catalyst_get_dynamik( 'comments_nav_margin_bottom' );
	
	// Author Info margins/padding
	$catalyst_dimensions['author_info_margin_top'] = catalyst_get_dynamik( 'author_info_margin_top' );
	$catalyst_dimensions['author_info_margin_bottom'] = catalyst_get_dynamik( 'author_info_margin_bottom' );
	$catalyst_dimensions['author_info_padding_top'] = catalyst_get_dynamik( 'author_info_padding_top' );
	$catalyst_dimensions['author_info_padding_right'] = catalyst_get_dynamik( 'author_info_padding_right' );
	$catalyst_dimensions['author_info_padding_bottom'] = catalyst_get_dynamik( 'author_info_padding_bottom' );
	$catalyst_dimensions['author_info_padding_left'] = catalyst_get_dynamik( 'author_info_padding_left' );
	
	// Author Avatar Widths/Padding
	$catalyst_dimensions['author_avatar_size'] = catalyst_get_dynamik( 'author_avatar_size' );
	$catalyst_dimensions['author_avatar_padding'] = catalyst_get_dynamik( 'author_avatar_padding' );
	
	// Sidebar Widget/Heading/Content/List-Style margins/padding
	$catalyst_dimensions['sb_widget_margin_top'] = catalyst_get_dynamik( 'sb_widget_margin_top' );
	$catalyst_dimensions['sb_widget_margin_bottom'] = catalyst_get_dynamik( 'sb_widget_margin_bottom' );
	$catalyst_dimensions['sb_heading_padding_top'] = catalyst_get_dynamik( 'sb_heading_padding_top' );
	$catalyst_dimensions['sb_heading_padding_right'] = catalyst_get_dynamik( 'sb_heading_padding_right' );
	$catalyst_dimensions['sb_heading_padding_bottom'] = catalyst_get_dynamik( 'sb_heading_padding_bottom' );
	$catalyst_dimensions['sb_heading_padding_left'] = catalyst_get_dynamik( 'sb_heading_padding_left' );
	$catalyst_dimensions['sb_content_padding_top'] = catalyst_get_dynamik( 'sb_content_padding_top' );
	$catalyst_dimensions['sb_content_padding_right'] = catalyst_get_dynamik( 'sb_content_padding_right' );
	$catalyst_dimensions['sb_content_padding_bottom'] = catalyst_get_dynamik( 'sb_content_padding_bottom' );
	$catalyst_dimensions['sb_content_padding_left'] = catalyst_get_dynamik( 'sb_content_padding_left' );
	$catalyst_dimensions['sb_ul_padding_top'] = catalyst_get_dynamik( 'sb_ul_padding_top' );
	$catalyst_dimensions['sb_ul_padding_right'] = catalyst_get_dynamik( 'sb_ul_padding_right' );
	$catalyst_dimensions['sb_ul_padding_bottom'] = catalyst_get_dynamik( 'sb_ul_padding_bottom' );
	$catalyst_dimensions['sb_ul_padding_left'] = catalyst_get_dynamik( 'sb_ul_padding_left' );
	$catalyst_dimensions['sb_search_form_padding_right'] = catalyst_get_dynamik( 'sb_search_form_padding_right' );
	$catalyst_dimensions['sb_search_form_padding_left'] = catalyst_get_dynamik( 'sb_search_form_padding_left' );
	
	// Footer width/height/padding
	$catalyst_dimensions['footer_border_thickness'] = catalyst_get_dynamik( 'footer_border_thickness' );

	if( catalyst_get_dynamik( 'footer_border_type' ) == 'Full' || catalyst_get_dynamik( 'footer_border_type' ) == 'Left/Right' )
	{
		if( !empty( $dynamik_responsive ) )
		{
			$catalyst_dimensions['footer_width'] = 'max-width: ' . ( $catalyst_dimensions['wrap_width'] - ( $catalyst_dimensions['footer_border_thickness'] * 2 ) ) . 'px;';
		}
		else
		{
			$catalyst_dimensions['footer_width'] = 'width: ' . ( $catalyst_dimensions['wrap_width'] - ( $catalyst_dimensions['footer_border_thickness'] * 2 ) ) . 'px;';
		}
	}
	else
	{
		if( !empty( $dynamik_responsive ) )
		{
			$catalyst_dimensions['footer_width'] = 'max-width: ' . $catalyst_dimensions['wrap_width'] . 'px;';
		}
		else
		{
			$catalyst_dimensions['footer_width'] = 'width: ' . $catalyst_dimensions['wrap_width'] . 'px;';
		}
	}
	
	if( catalyst_get_dynamik( 'footer_height' ) == '' )
	{
		$catalyst_dimensions['footer_height'] = 'auto';
	}
	else
	{
		$catalyst_dimensions['footer_height'] = catalyst_get_dynamik( 'footer_height' ) . 'px';
	}
	
	$catalyst_dimensions['footer_padding_top'] = catalyst_get_dynamik( 'footer_padding_top' );
	$catalyst_dimensions['footer_padding_bottom'] = catalyst_get_dynamik( 'footer_padding_bottom' );
	$catalyst_dimensions['footer_left_padding_top'] = catalyst_get_dynamik( 'footer_left_padding_top' );
	$catalyst_dimensions['footer_left_padding_right'] = catalyst_get_dynamik( 'footer_left_padding_right' );
	$catalyst_dimensions['footer_left_padding_bottom'] = catalyst_get_dynamik( 'footer_left_padding_bottom' );
	$catalyst_dimensions['footer_left_padding_left'] = catalyst_get_dynamik( 'footer_left_padding_left' );
	$catalyst_dimensions['footer_right_padding_top'] = catalyst_get_dynamik( 'footer_right_padding_top' );
	$catalyst_dimensions['footer_right_padding_right'] = catalyst_get_dynamik( 'footer_right_padding_right' );
	$catalyst_dimensions['footer_right_padding_bottom'] = catalyst_get_dynamik( 'footer_right_padding_bottom' );
	$catalyst_dimensions['footer_right_padding_left'] = catalyst_get_dynamik( 'footer_right_padding_left' );
	$catalyst_dimensions['footer_center_padding_top'] = catalyst_get_dynamik( 'footer_center_padding_top' );
	$catalyst_dimensions['footer_center_padding_right'] = catalyst_get_dynamik( 'footer_center_padding_right' );
	$catalyst_dimensions['footer_center_padding_bottom'] = catalyst_get_dynamik( 'footer_center_padding_bottom' );
	$catalyst_dimensions['footer_center_padding_left'] = catalyst_get_dynamik( 'footer_center_padding_left' );
	
	// Search Form width/padding
	$catalyst_dimensions['search_form_width'] = catalyst_get_dynamik( 'search_form_width' );
	
	$catalyst_dimensions['search_form_padding_top'] = catalyst_get_dynamik( 'search_form_padding_top' );
	$catalyst_dimensions['search_form_padding_right'] = catalyst_get_dynamik( 'search_form_padding_right' );
	$catalyst_dimensions['search_form_padding_bottom'] = catalyst_get_dynamik( 'search_form_padding_bottom' );
	$catalyst_dimensions['search_form_padding_left'] = catalyst_get_dynamik( 'search_form_padding_left' );
	$catalyst_dimensions['search_button_padding_top'] = catalyst_get_dynamik( 'search_button_padding_top' );
	$catalyst_dimensions['search_button_padding_right'] = catalyst_get_dynamik( 'search_button_padding_right' );
	$catalyst_dimensions['search_button_padding_bottom'] = catalyst_get_dynamik( 'search_button_padding_bottom' );
	$catalyst_dimensions['search_button_padding_left'] = catalyst_get_dynamik( 'search_button_padding_left' );
	
	return $catalyst_dimensions;
}

/**
 * Calculate the Dynamik CSS based on the current Dynamik settings.
 *
 * @since 1.0
 * @return the Dynamik CSS based on the current Dynamik settings.
 */
function catalyst_build_dynamik_styles( $child = 'no' )
{
	catalyst_get_dynamik( null, $args = array( 'cached' => false, 'array' => false ) );
	catalyst_get_responsive( null, $args = array( 'cached' => false, 'array' => false ) );
	catalyst_get_core( null, $args = array( 'cached' => false, 'array' => false ) );
	catalyst_get_advanced( null, $args = array( 'cached' => false, 'array' => false ) );
	$dynamik_font_type = catalyst_get_dynamik( 'font_type' );
	foreach( $dynamik_font_type as $key => $value )
	{
		$dynamik_font_type[$key] = $value;
	}
	$catalyst_layout_info = explode( ' ', catalyst_site_layout() );
	$catalyst_layout_type = $catalyst_layout_info[0];

	// Content area widths
	$cc_width = catalyst_get_dynamik( 'cc_width' );
	$sb1_width = catalyst_get_dynamik( 'sb1_width' );
	$sb2_width = catalyst_get_dynamik( 'sb2_width' );
	
	// Responsive Design Options
	$dynamik_responsive = catalyst_get_core( 'dynamik_responsive' ) ? 1 : 0;
	if( !empty( $dynamik_responsive ) )
	{
		$width = 'max-width: ';
	}
	else
	{
		$width = 'width: ';
	}
	
	/****************************************
			Define Widths & Padding
	****************************************/
	
	$catalyst_dimensions = catalyst_dimensions( $catalyst_layout_type, $cc_width, $sb1_width, $sb2_width );
	
	/****************************************
			Define Background Styles
	****************************************/
	global $blog_id;
	$catalyst_multisite = false;
	if( $blog_id > 1 )
	{
		$catalyst_multisite = $blog_id;
	}
	
	if( $catalyst_multisite && $child == 'no' )
	{
		$image_dir = 'images/' . $catalyst_multisite . '/';
	}
	else
	{
		$image_dir = 'images/';
	}
	// Body Background
	$body_bg_type = catalyst_get_dynamik( 'body_bg_type' );
	$body_bg_color = catalyst_get_dynamik( 'body_bg_color' );
	$body_bg_image = catalyst_get_dynamik( 'body_bg_image' );
	
	if( $body_bg_type != 'color' )
	{
		$body_bg_image_type = ' url(' . $image_dir . $body_bg_image . ') ' . $body_bg_type;
	}
	else
	{
		$body_bg_image_type = '';
	}

	// Wrap background
	$wrap_bg_type = catalyst_get_dynamik( 'wrap_bg_type' );
	$wrap_bg_no_color = catalyst_get_dynamik( 'wrap_bg_no_color' ) ? catalyst_get_dynamik( 'wrap_bg_no_color' ) : '';
	$wrap_bg_color = catalyst_get_dynamik( 'wrap_bg_color' );
	$wrap_bg_image = catalyst_get_dynamik( 'wrap_bg_image' );
	
	if( $wrap_bg_type == 'color' )
	{
		$wrap_bg = 'background: #' . $wrap_bg_color . ';';
	}
	elseif( $wrap_bg_type == 'transparent' )
	{
		$wrap_bg = 'background: transparent;';
	}
	elseif( !empty( $wrap_bg_no_color ) )
	{
		$wrap_bg = 'background: url(' . $image_dir . $wrap_bg_image . ') ' . $wrap_bg_type . ';';
	}
	else
	{
		$wrap_bg = 'background: #' . $wrap_bg_color . ' url(' . $image_dir . $wrap_bg_image . ') ' . $wrap_bg_type . ';';
	}
	
	// Container Wrap background
	$container_wrap_bg_type = catalyst_get_dynamik( 'container_wrap_bg_type' );
	$container_wrap_bg_no_color = catalyst_get_dynamik( 'container_wrap_bg_no_color' ) ? catalyst_get_dynamik( 'container_wrap_bg_no_color' ) : '';
	$container_wrap_bg_color = catalyst_get_dynamik( 'container_wrap_bg_color' );
	$container_wrap_bg_image = catalyst_get_dynamik( 'container_wrap_bg_image' );
	
	if( $container_wrap_bg_type == 'color' )
	{
		$container_wrap_bg = 'background: #' . $container_wrap_bg_color . ';';
	}
	elseif( $container_wrap_bg_type == 'transparent' )
	{
		$container_wrap_bg = 'background: transparent;';
	}
	elseif( !empty( $container_wrap_bg_no_color ) )
	{
		$container_wrap_bg = 'background: url(' . $image_dir . $container_wrap_bg_image . ') ' . $container_wrap_bg_type . ';';
	}
	else
	{
		$container_wrap_bg = 'background: #' . $container_wrap_bg_color . ' url(' . $image_dir . $container_wrap_bg_image . ') ' . $container_wrap_bg_type . ';';
	}
	
	// Header/Logo background
	$header_bg_type = catalyst_get_dynamik( 'header_bg_type' );
	$header_bg_no_color = catalyst_get_dynamik( 'header_bg_no_color' ) ? catalyst_get_dynamik( 'header_bg_no_color' ) : '';
	$header_bg_color = catalyst_get_dynamik( 'header_bg_color' );
	$header_bg_image = catalyst_get_dynamik( 'header_bg_image' );
	
	if( $header_bg_type == 'color' )
	{
		$header_bg = 'background: #' . $header_bg_color . ';';
	}
	elseif( $header_bg_type == 'transparent' )
	{
		$header_bg = 'background: transparent;';
	}
	elseif( !empty( $header_bg_no_color ) )
	{
		$header_bg = 'background: url(' . $image_dir . $header_bg_image . ') ' . $header_bg_type . ';';
	}
	else
	{
		$header_bg = 'background: #' . $header_bg_color . ' url(' . $image_dir . $header_bg_image . ') ' . $header_bg_type . ';';
	}
	
	if( catalyst_get_dynamik( 'logo_image' ) != '' )
	{
		$logo_image = 'background: url(' . $image_dir . catalyst_get_dynamik( 'logo_image' ) . ') left top no-repeat;';
	}
	else
	{
		$logo_image = 'background: none;';
	}
	
	// Navbar 1 backgrounds
	$nav1_bg_type = catalyst_get_dynamik( 'nav1_bg_type' );
	$nav1_bg_no_color = catalyst_get_dynamik( 'nav1_bg_no_color' ) ? catalyst_get_dynamik( 'nav1_bg_no_color' ) : '';
	$nav1_bg_color = catalyst_get_dynamik( 'nav1_bg_color' );
	$nav1_bg_image = catalyst_get_dynamik( 'nav1_bg_image' );
	
	if( $nav1_bg_type == 'color' )
	{
		$nav1_bg = 'background: #' . $nav1_bg_color . ';';
		$nav1_dropdown_webkit_appearance = '';
	}
	elseif( $nav1_bg_type == 'transparent' )
	{
		$nav1_bg = 'background: transparent;';
		$nav1_dropdown_webkit_appearance = '';
	}
	elseif( !empty( $nav1_bg_no_color ) )
	{
		$nav1_bg = 'background: url(' . $image_dir . $nav1_bg_image . ') ' . $nav1_bg_type . ';';
		$nav1_dropdown_webkit_appearance = '-webkit-appearance: none;';
	}
	else
	{
		$nav1_bg = 'background: #' . $nav1_bg_color . ' url(' . $image_dir . $nav1_bg_image . ') ' . $nav1_bg_type . ';';
		$nav1_dropdown_webkit_appearance = '-webkit-appearance: none;';
	}
	
	$nav1_page_bg_type = catalyst_get_dynamik( 'nav1_page_bg_type' );
	$nav1_page_bg_no_color = catalyst_get_dynamik( 'nav1_page_bg_no_color' ) ? catalyst_get_dynamik( 'nav1_page_bg_no_color' ) : '';
	$nav1_page_bg_color = catalyst_get_dynamik( 'nav1_page_bg_color' );
	$nav1_page_bg_image = catalyst_get_dynamik( 'nav1_page_bg_image' );
	
	if( $nav1_page_bg_type == 'color' )
	{
		$nav1_page_bg = 'background: #' . $nav1_page_bg_color . ';';
	}
	elseif( $nav1_page_bg_type == 'transparent' )
	{
		$nav1_page_bg = 'background: transparent;';
	}
	elseif( !empty( $nav1_page_bg_no_color ) )
	{
		$nav1_page_bg = 'background: url(' . $image_dir . $nav1_page_bg_image . ') ' . $nav1_page_bg_type . ';';
	}
	else
	{
		$nav1_page_bg = 'background: #' . $nav1_page_bg_color . ' url(' . $image_dir . $nav1_page_bg_image . ') ' . $nav1_page_bg_type . ';';
	}
	
	$nav1_page_hover_bg_type = catalyst_get_dynamik( 'nav1_page_hover_bg_type' );
	$nav1_page_hover_bg_no_color = catalyst_get_dynamik( 'nav1_page_hover_bg_no_color' ) ? catalyst_get_dynamik( 'nav1_page_hover_bg_no_color' ) : '';
	$nav1_page_hover_bg_color = catalyst_get_dynamik( 'nav1_page_hover_bg_color' );
	$nav1_page_hover_bg_image = catalyst_get_dynamik( 'nav1_page_hover_bg_image' );
	
	if( $nav1_page_hover_bg_type == 'color' )
	{
		$nav1_page_hover_bg = 'background: #' . $nav1_page_hover_bg_color . ';';
	}
	elseif( $nav1_page_hover_bg_type == 'transparent' )
	{
		$nav1_page_hover_bg = 'background: transparent;';
	}
	elseif( !empty( $nav1_page_hover_bg_no_color ) )
	{
		$nav1_page_hover_bg = 'background: url(' . $image_dir . $nav1_page_hover_bg_image . ') ' . $nav1_page_hover_bg_type . ';';
	}
	else
	{
		$nav1_page_hover_bg = 'background: #' . $nav1_page_hover_bg_color . ' url(' . $image_dir . $nav1_page_hover_bg_image . ') ' . $nav1_page_hover_bg_type . ';';
	}
	
	$nav1_page_active_bg_type = catalyst_get_dynamik( 'nav1_page_active_bg_type' );
	$nav1_page_active_bg_no_color = catalyst_get_dynamik( 'nav1_page_active_bg_no_color' ) ? catalyst_get_dynamik( 'nav1_page_active_bg_no_color' ) : '';
	$nav1_page_active_bg_color = catalyst_get_dynamik( 'nav1_page_active_bg_color' );
	$nav1_page_active_bg_image = catalyst_get_dynamik( 'nav1_page_active_bg_image' );
	
	if( $nav1_page_active_bg_type == 'color' )
	{
		$nav1_page_active_bg = 'background: #' . $nav1_page_active_bg_color . ';';
	}
	elseif( $nav1_page_active_bg_type == 'transparent' )
	{
		$nav1_page_active_bg = 'background: transparent;';
	}
	elseif( !empty( $nav1_page_active_bg_no_color ) )
	{
		$nav1_page_active_bg = 'background: url(' . $image_dir . $nav1_page_active_bg_image . ') ' . $nav1_page_active_bg_type . ';';
	}
	else
	{
		$nav1_page_active_bg = 'background: #' . $nav1_page_active_bg_color . ' url(' . $image_dir . $nav1_page_active_bg_image . ') ' . $nav1_page_active_bg_type . ';';
	}
	
	$nav1_sub_page_bg_type = catalyst_get_dynamik( 'nav1_sub_page_bg_type' );
	$nav1_sub_page_bg_no_color = catalyst_get_dynamik( 'nav1_sub_page_bg_no_color' ) ? catalyst_get_dynamik( 'nav1_sub_page_bg_no_color' ) : '';
	$nav1_sub_page_bg_color = catalyst_get_dynamik( 'nav1_sub_page_bg_color' );
	$nav1_sub_page_bg_image = catalyst_get_dynamik( 'nav1_sub_page_bg_image' );
	
	if( $nav1_sub_page_bg_type == 'color' )
	{
		$nav1_sub_page_bg = 'background: #' . $nav1_sub_page_bg_color . ';';
	}
	elseif( $nav1_sub_page_bg_type == 'transparent' )
	{
		$nav1_sub_page_bg = 'background: transparent;';
	}
	elseif( !empty( $nav1_sub_page_bg_no_color ) )
	{
		$nav1_sub_page_bg = 'background: url(' . $image_dir . $nav1_sub_page_bg_image . ') ' . $nav1_sub_page_bg_type . ';';
	}
	else
	{
		$nav1_sub_page_bg = 'background: #' . $nav1_sub_page_bg_color . ' url(' . $image_dir . $nav1_sub_page_bg_image . ') ' . $nav1_sub_page_bg_type . ';';
	}
	
	$nav1_sub_page_hover_bg_type = catalyst_get_dynamik( 'nav1_sub_page_hover_bg_type' );
	$nav1_sub_page_hover_bg_no_color = catalyst_get_dynamik( 'nav1_sub_page_hover_bg_no_color' ) ? catalyst_get_dynamik( 'nav1_sub_page_hover_bg_no_color' ) : '';
	$nav1_sub_page_hover_bg_color = catalyst_get_dynamik( 'nav1_sub_page_hover_bg_color' );
	$nav1_sub_page_hover_bg_image = catalyst_get_dynamik( 'nav1_sub_page_hover_bg_image' );
	
	if( $nav1_sub_page_hover_bg_type == 'color' )
	{
		$nav1_sub_page_hover_bg = 'background: #' . $nav1_sub_page_hover_bg_color . ';';
	}
	elseif( $nav1_sub_page_hover_bg_type == 'transparent' )
	{
		$nav1_sub_page_hover_bg = 'background: transparent;';
	}
	elseif( !empty( $nav1_sub_page_hover_bg_no_color ) )
	{
		$nav1_sub_page_hover_bg = 'background: url(' . $image_dir . $nav1_sub_page_hover_bg_image . ') ' . $nav1_sub_page_hover_bg_type . ';';
	}
	else
	{
		$nav1_sub_page_hover_bg = 'background: #' . $nav1_sub_page_hover_bg_color . ' url(' . $image_dir . $nav1_sub_page_hover_bg_image . ') ' . $nav1_sub_page_hover_bg_type . ';';
	}
	
	// Navbar 2 backgrounds
	$nav2_bg_type = catalyst_get_dynamik( 'nav2_bg_type' );
	$nav2_bg_no_color = catalyst_get_dynamik( 'nav2_bg_no_color' ) ? catalyst_get_dynamik( 'nav2_bg_no_color' ) : '';
	$nav2_bg_color = catalyst_get_dynamik( 'nav2_bg_color' );
	$nav2_bg_image = catalyst_get_dynamik( 'nav2_bg_image' );
	
	if( $nav2_bg_type == 'color' )
	{
		$nav2_bg = 'background: #' . $nav2_bg_color . ';';
		$nav2_dropdown_webkit_appearance = '';
	}
	elseif( $nav2_bg_type == 'transparent' )
	{
		$nav2_bg = 'background: transparent;';
		$nav2_dropdown_webkit_appearance = '';
	}
	elseif( !empty( $nav2_bg_no_color ) )
	{
		$nav2_bg = 'background: url(' . $image_dir . $nav2_bg_image . ') ' . $nav2_bg_type . ';';
		$nav2_dropdown_webkit_appearance = '-webkit-appearance: none;';
	}
	else
	{
		$nav2_bg = 'background: #' . $nav2_bg_color . ' url(' . $image_dir . $nav2_bg_image . ') ' . $nav2_bg_type . ';';
		$nav2_dropdown_webkit_appearance = '-webkit-appearance: none;';
	}
	
	$nav2_page_bg_type = catalyst_get_dynamik( 'nav2_page_bg_type' );
	$nav2_page_bg_no_color = catalyst_get_dynamik( 'nav2_page_bg_no_color' ) ? catalyst_get_dynamik( 'nav2_page_bg_no_color' ) : '';
	$nav2_page_bg_color = catalyst_get_dynamik( 'nav2_page_bg_color' );
	$nav2_page_bg_image = catalyst_get_dynamik( 'nav2_page_bg_image' );
	
	if( $nav2_page_bg_type == 'color' )
	{
		$nav2_page_bg = 'background: #' . $nav2_page_bg_color . ';';
	}
	elseif( $nav2_page_bg_type == 'transparent' )
	{
		$nav2_page_bg = 'background: transparent;';
	}
	elseif( !empty( $nav2_page_bg_no_color ) )
	{
		$nav2_page_bg = 'background: url(' . $image_dir . $nav2_page_bg_image . ') ' . $nav2_page_bg_type . ';';
	}
	else
	{
		$nav2_page_bg = 'background: #' . $nav2_page_bg_color . ' url(' . $image_dir . $nav2_page_bg_image . ') ' . $nav2_page_bg_type . ';';
	}
	
	$nav2_page_hover_bg_type = catalyst_get_dynamik( 'nav2_page_hover_bg_type' );
	$nav2_page_hover_bg_no_color = catalyst_get_dynamik( 'nav2_page_hover_bg_no_color' ) ? catalyst_get_dynamik( 'nav2_page_hover_bg_no_color' ) : '';
	$nav2_page_hover_bg_color = catalyst_get_dynamik( 'nav2_page_hover_bg_color' );
	$nav2_page_hover_bg_image = catalyst_get_dynamik( 'nav2_page_hover_bg_image' );
	
	if( $nav2_page_hover_bg_type == 'color' )
	{
		$nav2_page_hover_bg = 'background: #' . $nav2_page_hover_bg_color . ';';
	}
	elseif( $nav2_page_hover_bg_type == 'transparent' )
	{
		$nav2_page_hover_bg = 'background: transparent;';
	}
	elseif( !empty( $nav2_page_hover_bg_no_color ) )
	{
		$nav2_page_hover_bg = 'background: url(' . $image_dir . $nav2_page_hover_bg_image . ') ' . $nav2_page_hover_bg_type . ';';
	}
	else
	{
		$nav2_page_hover_bg = 'background: #' . $nav2_page_hover_bg_color . ' url(' . $image_dir . $nav2_page_hover_bg_image . ') ' . $nav2_page_hover_bg_type . ';';
	}
	
	$nav2_page_active_bg_type = catalyst_get_dynamik( 'nav2_page_active_bg_type' );
	$nav2_page_active_bg_no_color = catalyst_get_dynamik( 'nav2_page_active_bg_no_color' ) ? catalyst_get_dynamik( 'nav2_page_active_bg_no_color' ) : '';
	$nav2_page_active_bg_color = catalyst_get_dynamik( 'nav2_page_active_bg_color' );
	$nav2_page_active_bg_image = catalyst_get_dynamik( 'nav2_page_active_bg_image' );
	
	if( $nav2_page_active_bg_type == 'color' )
	{
		$nav2_page_active_bg = 'background: #' . $nav2_page_active_bg_color . ';';
	}
	elseif( $nav2_page_active_bg_type == 'transparent' )
	{
		$nav2_page_active_bg = 'background: transparent;';
	}
	elseif( !empty( $nav2_page_active_bg_no_color ) )
	{
		$nav2_page_active_bg = 'background: url(' . $image_dir . $nav2_page_active_bg_image . ') ' . $nav2_page_active_bg_type . ';';
	}
	else
	{
		$nav2_page_active_bg = 'background: #' . $nav2_page_active_bg_color . ' url(' . $image_dir . $nav2_page_active_bg_image . ') ' . $nav2_page_active_bg_type . ';';
	}
	
	$nav2_sub_page_bg_type = catalyst_get_dynamik( 'nav2_sub_page_bg_type' );
	$nav2_sub_page_bg_no_color = catalyst_get_dynamik( 'nav2_sub_page_bg_no_color' ) ? catalyst_get_dynamik( 'nav2_sub_page_bg_no_color' ) : '';
	$nav2_sub_page_bg_color = catalyst_get_dynamik( 'nav2_sub_page_bg_color' );
	$nav2_sub_page_bg_image = catalyst_get_dynamik( 'nav2_sub_page_bg_image' );
	
	if( $nav2_sub_page_bg_type == 'color' )
	{
		$nav2_sub_page_bg = 'background: #' . $nav2_sub_page_bg_color . ';';
	}
	elseif( $nav2_sub_page_bg_type == 'transparent' )
	{
		$nav2_sub_page_bg = 'background: transparent;';
	}
	elseif( !empty( $nav2_sub_page_bg_no_color ) )
	{
		$nav2_sub_page_bg = 'background: url(' . $image_dir . $nav2_sub_page_bg_image . ') ' . $nav2_sub_page_bg_type . ';';
	}
	else
	{
		$nav2_sub_page_bg = 'background: #' . $nav2_sub_page_bg_color . ' url(' . $image_dir . $nav2_sub_page_bg_image . ') ' . $nav2_sub_page_bg_type . ';';
	}
	
	$nav2_sub_page_hover_bg_type = catalyst_get_dynamik( 'nav2_sub_page_hover_bg_type' );
	$nav2_sub_page_hover_bg_no_color = catalyst_get_dynamik( 'nav2_sub_page_hover_bg_no_color' ) ? catalyst_get_dynamik( 'nav2_sub_page_hover_bg_no_color' ) : '';
	$nav2_sub_page_hover_bg_color = catalyst_get_dynamik( 'nav2_sub_page_hover_bg_color' );
	$nav2_sub_page_hover_bg_image = catalyst_get_dynamik( 'nav2_sub_page_hover_bg_image' );
	
	if( $nav2_sub_page_hover_bg_type == 'color' )
	{
		$nav2_sub_page_hover_bg = 'background: #' . $nav2_sub_page_hover_bg_color . ';';
	}
	elseif( $nav2_sub_page_hover_bg_type == 'transparent' )
	{
		$nav2_sub_page_hover_bg = 'background: transparent;';
	}
	elseif( !empty( $nav2_sub_page_hover_bg_no_color ) )
	{
		$nav2_sub_page_hover_bg = 'background: url(' . $image_dir . $nav2_sub_page_hover_bg_image . ') ' . $nav2_sub_page_hover_bg_type . ';';
	}
	else
	{
		$nav2_sub_page_hover_bg = 'background: #' . $nav2_sub_page_hover_bg_color . ' url(' . $image_dir . $nav2_sub_page_hover_bg_image . ') ' . $nav2_sub_page_hover_bg_type . ';';
	}
	
	// Post content background
	$post_content_bg_type = catalyst_get_dynamik( 'post_content_bg_type' );
	$post_content_bg_no_color = catalyst_get_dynamik( 'post_content_bg_no_color' ) ? catalyst_get_dynamik( 'post_content_bg_no_color' ) : '';
	$post_content_bg_color = catalyst_get_dynamik( 'post_content_bg_color' );
	$post_content_bg_image = catalyst_get_dynamik( 'post_content_bg_image' );
	
	if( $post_content_bg_type == 'color' )
	{
		$post_content_bg = 'background: #' . $post_content_bg_color . ';';
	}
	elseif( $post_content_bg_type == 'transparent' )
	{
		$post_content_bg = 'background: transparent;';
	}
	elseif( !empty( $post_content_bg_no_color ) )
	{
		$post_content_bg = 'background: url(' . $image_dir . $post_content_bg_image . ') ' . $post_content_bg_type . ';';
	}
	else
	{
		$post_content_bg = 'background: #' . $post_content_bg_color . ' url(' . $image_dir . $post_content_bg_image . ') ' . $post_content_bg_type . ';';
	}
	
	// Page content background
	$page_content_bg_type = catalyst_get_dynamik( 'page_content_bg_type' );
	$page_content_bg_no_color = catalyst_get_dynamik( 'page_content_bg_no_color' ) ? catalyst_get_dynamik( 'page_content_bg_no_color' ) : '';
	$page_content_bg_color = catalyst_get_dynamik( 'page_content_bg_color' );
	$page_content_bg_image = catalyst_get_dynamik( 'page_content_bg_image' );
	
	if( $page_content_bg_type == 'color' )
	{
		$page_content_bg = 'background: #' . $page_content_bg_color . ';';
	}
	elseif( $page_content_bg_type == 'transparent' )
	{
		$page_content_bg = 'background: transparent;';
	}
	elseif( !empty( $page_content_bg_no_color ) )
	{
		$page_content_bg = 'background: url(' . $image_dir . $page_content_bg_image . ') ' . $page_content_bg_type . ';';
	}
	else
	{
		$page_content_bg = 'background: #' . $page_content_bg_color . ' url(' . $image_dir . $page_content_bg_image . ') ' . $page_content_bg_type . ';';
	}
	
	// Sticky-Post background
	$sticky_post_bg_type = catalyst_get_dynamik( 'sticky_post_bg_type' );
	$sticky_post_bg_no_color = catalyst_get_dynamik( 'sticky_post_bg_no_color' ) ? catalyst_get_dynamik( 'sticky_post_bg_no_color' ) : '';
	$sticky_post_bg_color = catalyst_get_dynamik( 'sticky_post_bg_color' );
	$sticky_post_bg_image = catalyst_get_dynamik( 'sticky_post_bg_image' );
	
	if( $sticky_post_bg_type == 'color' )
	{
		$sticky_post_bg = 'background: #' . $sticky_post_bg_color . ' !important;';
	}
	elseif( $sticky_post_bg_type == 'transparent' )
	{
		$sticky_post_bg = 'background: transparent !important;';
	}
	elseif( !empty( $sticky_post_bg_no_color ) )
	{
		$sticky_post_bg = 'background: url(' . $image_dir . $sticky_post_bg_image . ') ' . $sticky_post_bg_type . ' !important;';
	}
	else
	{
		$sticky_post_bg = 'background: #' . $sticky_post_bg_color . ' url(' . $image_dir . $sticky_post_bg_image . ') ' . $sticky_post_bg_type . ' !important;';
	}
	
	// Blockquote background
	$blockquote_bg_type = catalyst_get_dynamik( 'blockquote_bg_type' );
	$blockquote_bg_no_color = catalyst_get_dynamik( 'blockquote_bg_no_color' ) ? catalyst_get_dynamik( 'blockquote_bg_no_color' ) : '';
	$blockquote_bg_color = catalyst_get_dynamik( 'blockquote_bg_color' );
	$blockquote_bg_image = catalyst_get_dynamik( 'blockquote_bg_image' );
	
	if( $blockquote_bg_type == 'color' )
	{
		$blockquote_bg = 'background: #' . $blockquote_bg_color . ';';
	}
	elseif( $blockquote_bg_type == 'transparent' )
	{
		$blockquote_bg = 'background: transparent;';
	}
	elseif( !empty( $blockquote_bg_no_color ) )
	{
		$blockquote_bg = 'background: url(' . $image_dir . $blockquote_bg_image . ') ' . $blockquote_bg_type . ';';
	}
	else
	{
		$blockquote_bg = 'background: #' . $blockquote_bg_color . ' url(' . $image_dir . $blockquote_bg_image . ') ' . $blockquote_bg_type . ';';
	}
	
	// Image Caption background
	$caption_bg_type = catalyst_get_dynamik( 'caption_bg_type' );
	$caption_bg_no_color = catalyst_get_dynamik( 'caption_bg_no_color' ) ? catalyst_get_dynamik( 'caption_bg_no_color' ) : '';
	$caption_bg_color = catalyst_get_dynamik( 'caption_bg_color' );
	$caption_bg_image = catalyst_get_dynamik( 'caption_bg_image' );
	
	if( $caption_bg_type == 'color' )
	{
		$caption_bg = 'background: #' . $caption_bg_color . ';';
	}
	elseif( $caption_bg_type == 'transparent' )
	{
		$caption_bg = 'background: transparent;';
	}
	elseif( !empty( $caption_bg_no_color ) )
	{
		$caption_bg = 'background: url(' . $image_dir . $caption_bg_image . ') ' . $caption_bg_type . ';';
	}
	else
	{
		$caption_bg = 'background: #' . $caption_bg_color . ' url(' . $image_dir . $caption_bg_image . ') ' . $caption_bg_type . ';';
	}
	
	// Thumbnail Image background
	$thumbnail_bg_type = catalyst_get_dynamik( 'thumbnail_bg_type' );
	$thumbnail_bg_no_color = catalyst_get_dynamik( 'thumbnail_bg_no_color' ) ? catalyst_get_dynamik( 'thumbnail_bg_no_color' ) : '';
	$thumbnail_bg_color = catalyst_get_dynamik( 'thumbnail_bg_color' );
	$thumbnail_bg_image = catalyst_get_dynamik( 'thumbnail_bg_image' );
	
	if( $thumbnail_bg_type == 'color' )
	{
		$thumbnail_bg = 'background: #' . $thumbnail_bg_color . ';';
	}
	elseif( $thumbnail_bg_type == 'transparent' )
	{
		$thumbnail_bg = 'background: transparent;';
	}
	elseif( !empty( $thumbnail_bg_no_color ) )
	{
		$thumbnail_bg = 'background: url(' . $image_dir . $thumbnail_bg_image . ') ' . $thumbnail_bg_type . ';';
	}
	else
	{
		$thumbnail_bg = 'background: #' . $thumbnail_bg_color . ' url(' . $image_dir . $thumbnail_bg_image . ') ' . $thumbnail_bg_type . ';';
	}
	
	// EZ Widget Area backgrounds
	$ez_widget_home_bg_type = catalyst_get_dynamik( 'ez_widget_home_bg_type' );
	$ez_widget_home_bg_no_color = catalyst_get_dynamik( 'ez_widget_home_bg_no_color' ) ? catalyst_get_dynamik( 'ez_widget_home_bg_no_color' ) : '';
	$ez_widget_home_bg_color = catalyst_get_dynamik( 'ez_widget_home_bg_color' );
	$ez_widget_home_bg_image = catalyst_get_dynamik( 'ez_widget_home_bg_image' );
	
	if( $ez_widget_home_bg_type == 'color' )
	{
		$ez_widget_home_bg = 'background: #' . $ez_widget_home_bg_color . ';';
	}
	elseif( $ez_widget_home_bg_type == 'transparent' )
	{
		$ez_widget_home_bg = 'background: transparent;';
	}
	elseif( !empty( $ez_widget_home_bg_no_color ) )
	{
		$ez_widget_home_bg = 'background: url(' . $image_dir . $ez_widget_home_bg_image . ') ' . $ez_widget_home_bg_type . ';';
	}
	else
	{
		$ez_widget_home_bg = 'background: #' . $ez_widget_home_bg_color . ' url(' . $image_dir . $ez_widget_home_bg_image . ') ' . $ez_widget_home_bg_type . ';';
	}
	
	$ez_widget_feature_bg_type = catalyst_get_dynamik( 'ez_widget_feature_bg_type' );
	$ez_widget_feature_bg_no_color = catalyst_get_dynamik( 'ez_widget_feature_bg_no_color' ) ? catalyst_get_dynamik( 'ez_widget_feature_bg_no_color' ) : '';
	$ez_widget_feature_bg_color = catalyst_get_dynamik( 'ez_widget_feature_bg_color' );
	$ez_widget_feature_bg_image = catalyst_get_dynamik( 'ez_widget_feature_bg_image' );
	
	if( $ez_widget_feature_bg_type == 'color' )
	{
		$ez_widget_feature_bg = 'background: #' . $ez_widget_feature_bg_color . ';';
	}
	elseif( $ez_widget_feature_bg_type == 'transparent' )
	{
		$ez_widget_feature_bg = 'background: transparent;';
	}
	elseif( !empty( $ez_widget_feature_bg_no_color ) )
	{
		$ez_widget_feature_bg = 'background: url(' . $image_dir . $ez_widget_feature_bg_image . ') ' . $ez_widget_feature_bg_type . ';';
	}
	else
	{
		$ez_widget_feature_bg = 'background: #' . $ez_widget_feature_bg_color . ' url(' . $image_dir . $ez_widget_feature_bg_image . ') ' . $ez_widget_feature_bg_type . ';';
	}
	
	$ez_widget_footer_bg_type = catalyst_get_dynamik( 'ez_widget_footer_bg_type' );
	$ez_widget_footer_bg_no_color = catalyst_get_dynamik( 'ez_widget_footer_bg_no_color' ) ? catalyst_get_dynamik( 'ez_widget_footer_bg_no_color' ) : '';
	$ez_widget_footer_bg_color = catalyst_get_dynamik( 'ez_widget_footer_bg_color' );
	$ez_widget_footer_bg_image = catalyst_get_dynamik( 'ez_widget_footer_bg_image' );
	
	if( $ez_widget_footer_bg_type == 'color' )
	{
		$ez_widget_footer_bg = 'background: #' . $ez_widget_footer_bg_color . ';';
	}
	elseif( $ez_widget_footer_bg_type == 'transparent' )
	{
		$ez_widget_footer_bg = 'background: transparent;';
	}
	elseif( !empty( $ez_widget_footer_bg_no_color ) )
	{
		$ez_widget_footer_bg = 'background: url(' . $image_dir . $ez_widget_footer_bg_image . ') ' . $ez_widget_footer_bg_type . ';';
	}
	else
	{
		$ez_widget_footer_bg = 'background: #' . $ez_widget_footer_bg_color . ' url(' . $image_dir . $ez_widget_footer_bg_image . ') ' . $ez_widget_footer_bg_type . ';';
	}
	
	// Custom Widget Area background
	$catalyst_widget_bg_type = catalyst_get_dynamik( 'catalyst_widget_bg_type' );
	$catalyst_widget_bg_no_color = catalyst_get_dynamik( 'catalyst_widget_bg_no_color' ) ? catalyst_get_dynamik( 'catalyst_widget_bg_no_color' ) : '';
	$catalyst_widget_bg_color = catalyst_get_dynamik( 'catalyst_widget_bg_color' );
	$catalyst_widget_bg_image = catalyst_get_dynamik( 'catalyst_widget_bg_image' );
	
	if( $catalyst_widget_bg_type == 'color' )
	{
		$catalyst_widget_bg = 'background: #' . $catalyst_widget_bg_color . ';';
	}
	elseif( $catalyst_widget_bg_type == 'transparent' )
	{
		$catalyst_widget_bg = 'background: transparent;';
	}
	elseif( !empty( $catalyst_widget_bg_no_color ) )
	{
		$catalyst_widget_bg = 'background: url(' . $image_dir . $catalyst_widget_bg_image . ') ' . $catalyst_widget_bg_type . ';';
	}
	else
	{
		$catalyst_widget_bg = 'background: #' . $catalyst_widget_bg_color . ' url(' . $image_dir . $catalyst_widget_bg_image . ') ' . $catalyst_widget_bg_type . ';';
	}

	// Sidebar background
	$sb_heading_bg_type = catalyst_get_dynamik( 'sb_heading_bg_type' );
	$sb_heading_bg_no_color = catalyst_get_dynamik( 'sb_heading_bg_no_color' ) ? catalyst_get_dynamik( 'sb_heading_bg_no_color' ) : '';
	$sb_heading_bg_color = catalyst_get_dynamik( 'sb_heading_bg_color' );
	$sb_heading_bg_image = catalyst_get_dynamik( 'sb_heading_bg_image' );
	
	if( $sb_heading_bg_type == 'color' )
	{
		$sb_heading_bg = 'background: #' . $sb_heading_bg_color . ';';
	}
	elseif( $sb_heading_bg_type == 'transparent' )
	{
		$sb_heading_bg = 'background: transparent;';
	}
	elseif( !empty( $sb_heading_bg_no_color ) )
	{
		$sb_heading_bg = 'background: url(' . $image_dir . $sb_heading_bg_image . ') ' . $sb_heading_bg_type . ';';
	}
	else
	{
		$sb_heading_bg = 'background: #' . $sb_heading_bg_color . ' url(' . $image_dir . $sb_heading_bg_image . ') ' . $sb_heading_bg_type . ';';
	}
	
	$sb_content_bg_type = catalyst_get_dynamik( 'sb_content_bg_type' );
	$sb_content_bg_no_color = catalyst_get_dynamik( 'sb_content_bg_no_color' ) ? catalyst_get_dynamik( 'sb_content_bg_no_color' ) : '';
	$sb_content_bg_color = catalyst_get_dynamik( 'sb_content_bg_color' );
	$sb_content_bg_image = catalyst_get_dynamik( 'sb_content_bg_image' );
	
	if( $sb_content_bg_type == 'color' )
	{
		$sb_content_bg = 'background: #' . $sb_content_bg_color . ';';
	}
	elseif( $sb_content_bg_type == 'transparent' )
	{
		$sb_content_bg = 'background: transparent;';
	}
	elseif( !empty( $sb_content_bg_no_color ) )
	{
		$sb_content_bg = 'background: url(' . $image_dir . $sb_content_bg_image . ') ' . $sb_content_bg_type . ';';
	}
	else
	{
		$sb_content_bg = 'background: #' . $sb_content_bg_color . ' url(' . $image_dir . $sb_content_bg_image . ') ' . $sb_content_bg_type . ';';
	}
	
	// Breadcrumbs background
	$breadcrumbs_bg_type = catalyst_get_dynamik( 'breadcrumbs_bg_type' );
	$breadcrumbs_bg_no_color = catalyst_get_dynamik( 'breadcrumbs_bg_no_color' ) ? catalyst_get_dynamik( 'breadcrumbs_bg_no_color' ) : '';
	$breadcrumbs_bg_color = catalyst_get_dynamik( 'breadcrumbs_bg_color' );
	$breadcrumbs_bg_image = catalyst_get_dynamik( 'breadcrumbs_bg_image' );
	
	if( $breadcrumbs_bg_type == 'color' )
	{
		$breadcrumbs_bg = 'background: #' . $breadcrumbs_bg_color . ';';
	}
	elseif( $breadcrumbs_bg_type == 'transparent' )
	{
		$breadcrumbs_bg = 'background: transparent;';
	}
	elseif( !empty( $breadcrumbs_bg_no_color ) )
	{
		$breadcrumbs_bg = 'background: url(' . $image_dir . $breadcrumbs_bg_image . ') ' . $breadcrumbs_bg_type . ';';
	}
	else
	{
		$breadcrumbs_bg = 'background: #' . $breadcrumbs_bg_color . ' url(' . $image_dir . $breadcrumbs_bg_image . ') ' . $breadcrumbs_bg_type . ';';
	}
	
	// Author info backgrounds
	$author_info_bg_type = catalyst_get_dynamik( 'author_info_bg_type' );
	$author_info_bg_no_color = catalyst_get_dynamik( 'author_info_bg_no_color' ) ? catalyst_get_dynamik( 'author_info_bg_no_color' ) : '';
	$author_info_bg_color = catalyst_get_dynamik( 'author_info_bg_color' );
	$author_info_bg_image = catalyst_get_dynamik( 'author_info_bg_image' );
	
	if( $author_info_bg_type == 'color' )
	{
		$author_info_bg = 'background: #' . $author_info_bg_color . ';';
	}
	elseif( $author_info_bg_type == 'transparent' )
	{
		$author_info_bg = 'background: transparent;';
	}
	elseif( !empty( $author_info_bg_no_color ) )
	{
		$author_info_bg = 'background: url(' . $image_dir . $author_info_bg_image . ') ' . $author_info_bg_type . ';';
	}
	else
	{
		$author_info_bg = 'background: #' . $author_info_bg_color . ' url(' . $image_dir . $author_info_bg_image . ') ' . $author_info_bg_type . ';';
	}
	
	$author_avatar_bg_type = catalyst_get_dynamik( 'author_avatar_bg_type' );
	$author_avatar_bg_no_color = catalyst_get_dynamik( 'author_avatar_bg_no_color' ) ? catalyst_get_dynamik( 'author_avatar_bg_no_color' ) : '';
	$author_avatar_bg_color = catalyst_get_dynamik( 'author_avatar_bg_color' );
	$author_avatar_bg_image = catalyst_get_dynamik( 'author_avatar_bg_image' );
	
	if( $author_avatar_bg_type == 'color' )
	{
		$author_avatar_bg = 'background: #' . $author_avatar_bg_color . ';';
	}
	elseif( $author_avatar_bg_type == 'transparent' )
	{
		$author_avatar_bg = 'background: transparent;';
	}
	elseif( !empty( $author_avatar_bg_no_color ) )
	{
		$author_avatar_bg = 'background: url(' . $image_dir . $author_avatar_bg_image . ') ' . $author_avatar_bg_type . ';';
	}
	else
	{
		$author_avatar_bg = 'background: #' . $author_avatar_bg_color . ' url(' . $image_dir . $author_avatar_bg_image . ') ' . $author_avatar_bg_type . ';';
	}
	
	// Post-Nav backgrounds
	$post_nav_numbered_inactive_bg_type = catalyst_get_dynamik( 'post_nav_numbered_inactive_bg_type' );
	$post_nav_numbered_inactive_bg_no_color = catalyst_get_dynamik( 'post_nav_numbered_inactive_bg_no_color' ) ? catalyst_get_dynamik( 'post_nav_numbered_inactive_bg_no_color' ) : '';
	$post_nav_numbered_inactive_bg_color = catalyst_get_dynamik( 'post_nav_numbered_inactive_bg_color' );
	$post_nav_numbered_inactive_bg_image = catalyst_get_dynamik( 'post_nav_numbered_inactive_bg_image' );
	
	if( $post_nav_numbered_inactive_bg_type == 'color' )
	{
		$post_nav_numbered_inactive_bg = 'background: #' . $post_nav_numbered_inactive_bg_color . ';';
	}
	elseif( $post_nav_numbered_inactive_bg_type == 'transparent' )
	{
		$post_nav_numbered_inactive_bg = 'background: transparent;';
	}
	elseif( !empty( $post_nav_numbered_inactive_bg_no_color ) )
	{
		$post_nav_numbered_inactive_bg = 'background: url(' . $image_dir . $post_nav_numbered_inactive_bg_image . ') ' . $post_nav_numbered_inactive_bg_type . ';';
	}
	else
	{
		$post_nav_numbered_inactive_bg = 'background: #' . $post_nav_numbered_inactive_bg_color . ' url(' . $image_dir . $post_nav_numbered_inactive_bg_image . ') ' . $post_nav_numbered_inactive_bg_type . ';';
	}
	
	$post_nav_numbered_active_bg_type = catalyst_get_dynamik( 'post_nav_numbered_active_bg_type' );
	$post_nav_numbered_active_bg_no_color = catalyst_get_dynamik( 'post_nav_numbered_active_bg_no_color' ) ? catalyst_get_dynamik( 'post_nav_numbered_active_bg_no_color' ) : '';
	$post_nav_numbered_active_bg_color = catalyst_get_dynamik( 'post_nav_numbered_active_bg_color' );
	$post_nav_numbered_active_bg_image = catalyst_get_dynamik( 'post_nav_numbered_active_bg_image' );
	
	if( $post_nav_numbered_active_bg_type == 'color' )
	{
		$post_nav_numbered_active_bg = 'background: #' . $post_nav_numbered_active_bg_color . ';';
	}
	elseif( $post_nav_numbered_active_bg_type == 'transparent' )
	{
		$post_nav_numbered_active_bg = 'background: transparent;';
	}
	elseif( !empty( $post_nav_numbered_active_bg_no_color ) )
	{
		$post_nav_numbered_active_bg = 'background: url(' . $image_dir . $post_nav_numbered_active_bg_image . ') ' . $post_nav_numbered_active_bg_type . ';';
	}
	else
	{
		$post_nav_numbered_active_bg = 'background: #' . $post_nav_numbered_active_bg_color . ' url(' . $image_dir . $post_nav_numbered_active_bg_image . ') ' . $post_nav_numbered_active_bg_type . ';';
	}
	
	// Comment backgrounds
	$comment_wrap_bg_type = catalyst_get_dynamik( 'comment_wrap_bg_type' );
	$comment_wrap_bg_no_color = catalyst_get_dynamik( 'comment_wrap_bg_no_color' ) ? catalyst_get_dynamik( 'comment_wrap_bg_no_color' ) : '';
	$comment_wrap_bg_color = catalyst_get_dynamik( 'comment_wrap_bg_color' );
	$comment_wrap_bg_image = catalyst_get_dynamik( 'comment_wrap_bg_image' );
	
	if( $comment_wrap_bg_type == 'color' )
	{
		$comment_wrap_bg = 'background: #' . $comment_wrap_bg_color . ';';
	}
	elseif( $comment_wrap_bg_type == 'transparent' )
	{
		$comment_wrap_bg = 'background: transparent;';
	}
	elseif( !empty( $comment_wrap_bg_no_color ) )
	{
		$comment_wrap_bg = 'background: url(' . $image_dir . $comment_wrap_bg_image . ') ' . $comment_wrap_bg_type . ';';
	}
	else
	{
		$comment_wrap_bg = 'background: #' . $comment_wrap_bg_color . ' url(' . $image_dir . $comment_wrap_bg_image . ') ' . $comment_wrap_bg_type . ';';
	}
	
	$comment_even_bg_type = catalyst_get_dynamik( 'comment_even_bg_type' );
	$comment_even_bg_no_color = catalyst_get_dynamik( 'comment_even_bg_no_color' ) ? catalyst_get_dynamik( 'comment_even_bg_no_color' ) : '';
	$comment_even_bg_color = catalyst_get_dynamik( 'comment_even_bg_color' );
	$comment_even_bg_image = catalyst_get_dynamik( 'comment_even_bg_image' );
	
	if( $comment_even_bg_type == 'color' )
	{
		$comment_even_bg = 'background: #' . $comment_even_bg_color . ';';
	}
	elseif( $comment_even_bg_type == 'transparent' )
	{
		$comment_even_bg = 'background: transparent;';
	}
	elseif( !empty( $comment_even_bg_no_color ) )
	{
		$comment_even_bg = 'background: url(' . $image_dir . $comment_even_bg_image . ') ' . $comment_even_bg_type . ';';
	}
	else
	{
		$comment_even_bg = 'background: #' . $comment_even_bg_color . ' url(' . $image_dir . $comment_even_bg_image . ') ' . $comment_even_bg_type . ';';
	}
	
	$comment_odd_bg_type = catalyst_get_dynamik( 'comment_odd_bg_type' );
	$comment_odd_bg_no_color = catalyst_get_dynamik( 'comment_odd_bg_no_color' ) ? catalyst_get_dynamik( 'comment_odd_bg_no_color' ) : '';
	$comment_odd_bg_color = catalyst_get_dynamik( 'comment_odd_bg_color' );
	$comment_odd_bg_image = catalyst_get_dynamik( 'comment_odd_bg_image' );
	
	if( $comment_odd_bg_type == 'color' )
	{
		$comment_odd_bg = 'background: #' . $comment_odd_bg_color . ';';
	}
	elseif( $comment_odd_bg_type == 'transparent' )
	{
		$comment_odd_bg = 'background: transparent;';
	}
	elseif( !empty( $comment_odd_bg_no_color ) )
	{
		$comment_odd_bg = 'background: url(' . $image_dir . $comment_odd_bg_image . ') ' . $comment_odd_bg_type . ';';
	}
	else
	{
		$comment_odd_bg = 'background: #' . $comment_odd_bg_color . ' url(' . $image_dir . $comment_odd_bg_image . ') ' . $comment_odd_bg_type . ';';
	}
	
	$comment_reply_bg_type = catalyst_get_dynamik( 'comment_reply_bg_type' );
	$comment_reply_bg_no_color = catalyst_get_dynamik( 'comment_reply_bg_no_color' ) ? catalyst_get_dynamik( 'comment_reply_bg_no_color' ) : '';
	$comment_reply_bg_color = catalyst_get_dynamik( 'comment_reply_bg_color' );
	$comment_reply_bg_image = catalyst_get_dynamik( 'comment_reply_bg_image' );
	
	if( $comment_reply_bg_type == 'color' )
	{
		$comment_reply_bg = 'background: #' . $comment_reply_bg_color . ';';
	}
	elseif( $comment_reply_bg_type == 'transparent' )
	{
		$comment_reply_bg = 'background: transparent;';
	}
	elseif( !empty( $comment_reply_bg_no_color ) )
	{
		$comment_reply_bg = 'background: url(' . $image_dir . $comment_reply_bg_image . ') ' . $comment_reply_bg_type . ';';
	}
	else
	{
		$comment_reply_bg = 'background: #' . $comment_reply_bg_color . ' url(' . $image_dir . $comment_reply_bg_image . ') ' . $comment_reply_bg_type . ';';
	}
	
	$comment_avatar_bg_type = catalyst_get_dynamik( 'comment_avatar_bg_type' );
	$comment_avatar_bg_no_color = catalyst_get_dynamik( 'comment_avatar_bg_no_color' ) ? catalyst_get_dynamik( 'comment_avatar_bg_no_color' ) : '';
	$comment_avatar_bg_color = catalyst_get_dynamik( 'comment_avatar_bg_color' );
	$comment_avatar_bg_image = catalyst_get_dynamik( 'comment_avatar_bg_image' );
	
	if( $comment_avatar_bg_type == 'color' )
	{
		$comment_avatar_bg = 'background: #' . $comment_avatar_bg_color . ';';
	}
	elseif( $comment_avatar_bg_type == 'transparent' )
	{
		$comment_avatar_bg = 'background: transparent;';
	}
	elseif( !empty( $comment_avatar_bg_no_color ) )
	{
		$comment_avatar_bg = 'background: url(' . $image_dir . $comment_avatar_bg_image . ') ' . $comment_avatar_bg_type . ';';
	}
	else
	{
		$comment_avatar_bg = 'background: #' . $comment_avatar_bg_color . ' url(' . $image_dir . $comment_avatar_bg_image . ') ' . $comment_avatar_bg_type . ';';
	}
	
	$comment_form_bg_type = catalyst_get_dynamik( 'comment_form_bg_type' );
	$comment_form_bg_no_color = catalyst_get_dynamik( 'comment_form_bg_no_color' ) ? catalyst_get_dynamik( 'comment_form_bg_no_color' ) : '';
	$comment_form_bg_color = catalyst_get_dynamik( 'comment_form_bg_color' );
	$comment_form_bg_image = catalyst_get_dynamik( 'comment_form_bg_image' );
	
	if( $comment_form_bg_type == 'color' )
	{
		$comment_form_bg = 'background: #' . $comment_form_bg_color . ';';
	}
	elseif( $comment_form_bg_type == 'transparent' )
	{
		$comment_form_bg = 'background: transparent;';
	}
	elseif( !empty( $comment_form_bg_no_color ) )
	{
		$comment_form_bg = 'background: url(' . $image_dir . $comment_form_bg_image . ') ' . $comment_form_bg_type . ';';
	}
	else
	{
		$comment_form_bg = 'background: #' . $comment_form_bg_color . ' url(' . $image_dir . $comment_form_bg_image . ') ' . $comment_form_bg_type . ';';
	}
	
	$comment_submit_bg_type = catalyst_get_dynamik( 'comment_submit_bg_type' );
	$comment_submit_bg_no_color = catalyst_get_dynamik( 'comment_submit_bg_no_color' ) ? catalyst_get_dynamik( 'comment_submit_bg_no_color' ) : '';
	$comment_submit_bg_color = catalyst_get_dynamik( 'comment_submit_bg_color' );
	$comment_submit_bg_image = catalyst_get_dynamik( 'comment_submit_bg_image' );
	
	if( $comment_submit_bg_type == 'color' )
	{
		$comment_submit_bg = 'background: #' . $comment_submit_bg_color . ';';
	}
	elseif( $comment_submit_bg_type == 'transparent' )
	{
		$comment_submit_bg = 'background: transparent;';
	}
	elseif( !empty( $comment_submit_bg_no_color ) )
	{
		$comment_submit_bg = 'background: url(' . $image_dir . $comment_submit_bg_image . ') ' . $comment_submit_bg_type . ';';
	}
	else
	{
		$comment_submit_bg = 'background: #' . $comment_submit_bg_color . ' url(' . $image_dir . $comment_submit_bg_image . ') ' . $comment_submit_bg_type . ';';
	}
	
	$comment_submit_hover_bg_type = catalyst_get_dynamik( 'comment_submit_hover_bg_type' );
	$comment_submit_hover_bg_no_color = catalyst_get_dynamik( 'comment_submit_hover_bg_no_color' ) ? catalyst_get_dynamik( 'comment_submit_hover_bg_no_color' ) : '';
	$comment_submit_hover_bg_color = catalyst_get_dynamik( 'comment_submit_hover_bg_color' );
	$comment_submit_hover_bg_image = catalyst_get_dynamik( 'comment_submit_hover_bg_image' );
	
	if( $comment_submit_hover_bg_type == 'color' )
	{
		$comment_submit_hover_bg = 'background: #' . $comment_submit_hover_bg_color . ';';
	}
	elseif( $comment_submit_hover_bg_type == 'transparent' )
	{
		$comment_submit_hover_bg = 'background: transparent;';
	}
	elseif( !empty( $comment_submit_hover_bg_no_color ) )
	{
		$comment_submit_hover_bg = 'background: url(' . $image_dir . $comment_submit_hover_bg_image . ') ' . $comment_submit_hover_bg_type . ';';
	}
	else
	{
		$comment_submit_hover_bg = 'background: #' . $comment_submit_hover_bg_color . ' url(' . $image_dir . $comment_submit_hover_bg_image . ') ' . $comment_submit_hover_bg_type . ';';
	}
	
	// Footer background
	$footer_bg_type = catalyst_get_dynamik( 'footer_bg_type' );
	$footer_bg_no_color = catalyst_get_dynamik( 'footer_bg_no_color' ) ? catalyst_get_dynamik( 'footer_bg_no_color' ) : '';
	$footer_bg_color = catalyst_get_dynamik( 'footer_bg_color' );
	$footer_bg_image = catalyst_get_dynamik( 'footer_bg_image' );
	
	if( $footer_bg_type == 'color' )
	{
		$footer_bg = 'background: #' . $footer_bg_color . ';';
	}
	elseif( $footer_bg_type == 'transparent' )
	{
		$footer_bg = 'background: transparent;';
	}
	elseif( !empty( $footer_bg_no_color ) )
	{
		$footer_bg = 'background: url(' . $image_dir . $footer_bg_image . ') ' . $footer_bg_type . ';';
	}
	else
	{
		$footer_bg = 'background: #' . $footer_bg_color . ' url(' . $image_dir . $footer_bg_image . ') ' . $footer_bg_type . ';';
	}
	
	// Search Form background
	$search_form_bg_type = catalyst_get_dynamik( 'search_form_bg_type' );
	$search_form_bg_no_color = catalyst_get_dynamik( 'search_form_bg_no_color' ) ? catalyst_get_dynamik( 'search_form_bg_no_color' ) : '';
	$search_form_bg_color = catalyst_get_dynamik( 'search_form_bg_color' );
	$search_form_bg_image = catalyst_get_dynamik( 'search_form_bg_image' );
	
	if( $search_form_bg_type == 'color' )
	{
		$search_form_bg = 'background: #' . $search_form_bg_color . ';';
	}
	elseif( $search_form_bg_type == 'transparent' )
	{
		$search_form_bg = 'background: transparent;';
	}
	elseif( !empty( $search_form_bg_no_color ) )
	{
		$search_form_bg = 'background: url(' . $image_dir . $search_form_bg_image . ') ' . $search_form_bg_type . ';';
	}
	else
	{
		$search_form_bg = 'background: #' . $search_form_bg_color . ' url(' . $image_dir . $search_form_bg_image . ') ' . $search_form_bg_type . ';';
	}
	
	$search_button_bg_type = catalyst_get_dynamik( 'search_button_bg_type' );
	$search_button_bg_no_color = catalyst_get_dynamik( 'search_button_bg_no_color' ) ? catalyst_get_dynamik( 'search_button_bg_no_color' ) : '';
	$search_button_bg_color = catalyst_get_dynamik( 'search_button_bg_color' );
	$search_button_bg_image = catalyst_get_dynamik( 'search_button_bg_image' );
	
	if( $search_button_bg_type == 'color' )
	{
		$search_button_bg = 'background: #' . $search_button_bg_color . ';';
	}
	elseif( $search_button_bg_type == 'transparent' )
	{
		$search_button_bg = 'background: transparent;';
	}
	elseif( !empty( $search_button_bg_no_color ) )
	{
		$search_button_bg = 'background: url(' . $image_dir . $search_button_bg_image . ') ' . $search_button_bg_type . ';';
	}
	else
	{
		$search_button_bg = 'background: #' . $search_button_bg_color . ' url(' . $image_dir . $search_button_bg_image . ') ' . $search_button_bg_type . ';';
	}
	
	$search_button_hover_bg_type = catalyst_get_dynamik( 'search_button_hover_bg_type' );
	$search_button_hover_bg_no_color = catalyst_get_dynamik( 'search_button_hover_bg_no_color' ) ? catalyst_get_dynamik( 'search_button_hover_bg_no_color' ) : '';
	$search_button_hover_bg_color = catalyst_get_dynamik( 'search_button_hover_bg_color' );
	$search_button_hover_bg_image = catalyst_get_dynamik( 'search_button_hover_bg_image' );
	
	if( $search_button_hover_bg_type == 'color' )
	{
		$search_button_hover_bg = 'background: #' . $search_button_hover_bg_color . ';';
	}
	elseif( $search_button_hover_bg_type == 'transparent' )
	{
		$search_button_hover_bg = 'background: transparent;';
	}
	elseif( !empty( $search_button_hover_bg_no_color ) )
	{
		$search_button_hover_bg = 'background: url(' . $image_dir . $search_button_hover_bg_image . ') ' . $search_button_hover_bg_type . ';';
	}
	else
	{
		$search_button_hover_bg = 'background: #' . $search_button_hover_bg_color . ' url(' . $image_dir . $search_button_hover_bg_image . ') ' . $search_button_hover_bg_type . ';';
	}
	
	/****************************************
			Define Border Styles
	****************************************/
	
	// Wrap border
	$wrap_border_thickness = catalyst_get_dynamik( 'wrap_border_thickness' );
	$wrap_border_style = catalyst_get_dynamik( 'wrap_border_style' );
	$wrap_border_color = catalyst_get_dynamik( 'wrap_border_color' );
	
	if( catalyst_get_dynamik( 'wrap_border_type' ) == 'Full' )
	{
		$wrap_tb_border_thickness = $wrap_border_thickness;
		$wrap_lr_border_thickness = $wrap_border_thickness;
	}
	elseif( catalyst_get_dynamik( 'wrap_border_type' ) == 'Top/Bottom' )
	{
		$wrap_tb_border_thickness = $wrap_border_thickness;
		$wrap_lr_border_thickness = 0;
	}
	else
	{
		$wrap_tb_border_thickness = 0;
		$wrap_lr_border_thickness = $wrap_border_thickness;
	}
	
	$wrap_shadow_style = catalyst_get_dynamik( 'wrap_shadow_style' );
	$wrap_radius_style = catalyst_get_dynamik( 'wrap_radius_style' );
	
	if( catalyst_get_dynamik( 'wrap_shadow_active' ) )
	{
		$wrap_box_shadow = '-webkit-box-shadow: ' . $wrap_shadow_style . ';' . "\n";
		$wrap_box_shadow .= "\t" . 'box-shadow: ' . $wrap_shadow_style . ';';
	}
	else
	{
		$wrap_box_shadow = '';
	}
	
	if( catalyst_get_dynamik( 'wrap_radius_active' ) )
	{
		$wrap_border_radius = '-webkit-border-radius: ' . $wrap_radius_style . ';' . "\n";
		$wrap_border_radius .= "\t" . 'border-radius: ' . $wrap_radius_style . ';';
	}
	else
	{
		$wrap_border_radius = '';
	}
	
	// Header border (Thickness is defined in Widths section)
	$header_border_style = catalyst_get_dynamik( 'header_border_style' );
	$header_border_color = catalyst_get_dynamik( 'header_border_color' );
	
	if( catalyst_get_dynamik( 'header_border_type' ) == 'Top' )
	{
		$header_top_border_thickness = $catalyst_dimensions['header_border_thickness'];
		$header_bottom_border_thickness = 0;
		$header_lr_border_thickness = 0;
	}
	elseif( catalyst_get_dynamik( 'header_border_type' ) == 'Bottom' )
	{
		$header_top_border_thickness = 0;
		$header_bottom_border_thickness = $catalyst_dimensions['header_border_thickness'];
		$header_lr_border_thickness = 0;
	}
	elseif( catalyst_get_dynamik( 'header_border_type' ) == 'Top/Bottom' )
	{
		$header_top_border_thickness = $catalyst_dimensions['header_border_thickness'];
		$header_bottom_border_thickness = $catalyst_dimensions['header_border_thickness'];
		$header_lr_border_thickness = 0;
	}
	elseif( catalyst_get_dynamik( 'header_border_type' ) == 'Left/Right' )
	{
		$header_top_border_thickness = 0;
		$header_bottom_border_thickness = 0;
		$header_lr_border_thickness = $catalyst_dimensions['header_border_thickness'];
	}
	else
	{
		$header_top_border_thickness = $catalyst_dimensions['header_border_thickness'];
		$header_bottom_border_thickness = $catalyst_dimensions['header_border_thickness'];
		$header_lr_border_thickness = $catalyst_dimensions['header_border_thickness'];
	}
	
	// Nav1 borders (Thickness is defined in Widths section)
	$nav1_border_style = catalyst_get_dynamik( 'nav1_border_style' );
	$nav1_border_color = catalyst_get_dynamik( 'nav1_border_color' );
	$nav1_page_border_style = catalyst_get_dynamik( 'nav1_page_border_style' );
	$nav1_page_border_color = catalyst_get_dynamik( 'nav1_page_border_color' );
	$nav1_page_hover_border_color = catalyst_get_dynamik( 'nav1_page_hover_border_color' );
	$nav1_page_active_border_color = catalyst_get_dynamik( 'nav1_page_active_border_color' );
	$nav1_submenu_border_color = catalyst_get_dynamik( 'nav1_submenu_border_color' );
	
	if( catalyst_get_dynamik( 'nav1_border_type' ) == 'Bottom' )
	{
		$nav1_top_border_thickness = 0;
		$nav1_bottom_border_thickness = $catalyst_dimensions['nav1_border_thickness'];
		$nav1_left_border_thickness = 0;
		$nav1_right_border_thickness = 0;
	}
	elseif( catalyst_get_dynamik( 'nav1_border_type' ) == 'Top' )
	{
		$nav1_top_border_thickness = $catalyst_dimensions['nav1_border_thickness'];
		$nav1_bottom_border_thickness = 0;
		$nav1_left_border_thickness = 0;
		$nav1_right_border_thickness = 0;
	}
	elseif( catalyst_get_dynamik( 'nav1_border_type' ) == 'Top/Bottom' )
	{
		$nav1_top_border_thickness = $catalyst_dimensions['nav1_border_thickness'];
		$nav1_bottom_border_thickness = $catalyst_dimensions['nav1_border_thickness'];
		$nav1_left_border_thickness = 0;
		$nav1_right_border_thickness = 0;
	}
	elseif( catalyst_get_dynamik( 'nav1_border_type' ) == 'Left/Right' )
	{
		$nav1_top_border_thickness = 0;
		$nav1_bottom_border_thickness = 0;
		$nav1_left_border_thickness = $catalyst_dimensions['nav1_border_thickness'];
		$nav1_right_border_thickness = $catalyst_dimensions['nav1_border_thickness'];
	}
	else
	{
		$nav1_top_border_thickness = $catalyst_dimensions['nav1_border_thickness'];
		$nav1_bottom_border_thickness = $catalyst_dimensions['nav1_border_thickness'];
		$nav1_left_border_thickness = $catalyst_dimensions['nav1_border_thickness'];
		$nav1_right_border_thickness = $catalyst_dimensions['nav1_border_thickness'];
	}
	
	//*** Nav1 Page Border Thickness options are defined below ***//
	
	// Nav2 borders (Thickness is defined in Widths section)
	$nav2_border_style = catalyst_get_dynamik( 'nav2_border_style' );
	$nav2_border_color = catalyst_get_dynamik( 'nav2_border_color' );
	$nav2_page_border_style = catalyst_get_dynamik( 'nav2_page_border_style' );
	$nav2_page_border_color = catalyst_get_dynamik( 'nav2_page_border_color' );
	$nav2_page_hover_border_color = catalyst_get_dynamik( 'nav2_page_hover_border_color' );
	$nav2_page_active_border_color = catalyst_get_dynamik( 'nav2_page_active_border_color' );
	$nav2_submenu_border_color = catalyst_get_dynamik( 'nav2_submenu_border_color' );
	
	if( catalyst_get_dynamik( 'nav2_border_type' ) == 'Bottom' )
	{
		$nav2_top_border_thickness = 0;
		$nav2_bottom_border_thickness = $catalyst_dimensions['nav2_border_thickness'];
		$nav2_left_border_thickness = 0;
		$nav2_right_border_thickness = 0;
	}
	elseif( catalyst_get_dynamik( 'nav2_border_type' ) == 'Top' )
	{
		$nav2_top_border_thickness = $catalyst_dimensions['nav2_border_thickness'];
		$nav2_bottom_border_thickness = 0;
		$nav2_left_border_thickness = 0;
		$nav2_right_border_thickness = 0;
	}
	elseif( catalyst_get_dynamik( 'nav2_border_type' ) == 'Top/Bottom' )
	{
		$nav2_top_border_thickness = $catalyst_dimensions['nav2_border_thickness'];
		$nav2_bottom_border_thickness = $catalyst_dimensions['nav2_border_thickness'];
		$nav2_left_border_thickness = 0;
		$nav2_right_border_thickness = 0;
	}
	elseif( catalyst_get_dynamik( 'nav2_border_type' ) == 'Left/Right' )
	{
		$nav2_top_border_thickness = 0;
		$nav2_bottom_border_thickness = 0;
		$nav2_left_border_thickness = $catalyst_dimensions['nav2_border_thickness'];
		$nav2_right_border_thickness = $catalyst_dimensions['nav2_border_thickness'];
	}
	else
	{
		$nav2_top_border_thickness = $catalyst_dimensions['nav2_border_thickness'];
		$nav2_bottom_border_thickness = $catalyst_dimensions['nav2_border_thickness'];
		$nav2_left_border_thickness = $catalyst_dimensions['nav2_border_thickness'];
		$nav2_right_border_thickness = $catalyst_dimensions['nav2_border_thickness'];
	}
	
	//*** Nav2 Page Border Thickness options are defined below ***//
	
	// Post content borders
	$post_content_border_thickness = catalyst_get_dynamik( 'post_content_border_thickness' );
	$post_content_border_style = catalyst_get_dynamik( 'post_content_border_style' );
	$post_content_border_color = catalyst_get_dynamik( 'post_content_border_color' );
	
	if( catalyst_get_dynamik( 'post_content_border_type' ) == 'Top/Bottom' )
	{
		$post_content_top_border_thickness = $post_content_border_thickness;
		$post_content_bottom_border_thickness = $post_content_border_thickness;
		$post_content_left_border_thickness = 0;
		$post_content_right_border_thickness = 0;
	}
	elseif( catalyst_get_dynamik( 'post_content_border_type' ) == 'Bottom' )
	{
		$post_content_top_border_thickness = 0;
		$post_content_bottom_border_thickness = $post_content_border_thickness;
		$post_content_left_border_thickness = 0;
		$post_content_right_border_thickness = 0;
	}
	elseif( catalyst_get_dynamik( 'post_content_border_type' ) == 'Left/Right' )
	{
		$post_content_top_border_thickness = 0;
		$post_content_bottom_border_thickness = 0;
		$post_content_left_border_thickness = $post_content_border_thickness;
		$post_content_right_border_thickness = $post_content_border_thickness;
	}
	elseif( catalyst_get_dynamik( 'post_content_border_type' ) == 'Left' )
	{
		$post_content_top_border_thickness = 0;
		$post_content_bottom_border_thickness = 0;
		$post_content_left_border_thickness = $post_content_border_thickness;
		$post_content_right_border_thickness = 0;
	}
	elseif( catalyst_get_dynamik( 'post_content_border_type' ) == 'Right' )
	{
		$post_content_top_border_thickness = 0;
		$post_content_bottom_border_thickness = 0;
		$post_content_left_border_thickness = 0;
		$post_content_right_border_thickness = $post_content_border_thickness;
	}
	else
	{
		$post_content_top_border_thickness = $post_content_border_thickness;
		$post_content_bottom_border_thickness = $post_content_border_thickness;
		$post_content_left_border_thickness = $post_content_border_thickness;
		$post_content_right_border_thickness = $post_content_border_thickness;
	}
	
	// Page content borders
	$page_content_border_thickness = catalyst_get_dynamik( 'page_content_border_thickness' );
	$page_content_border_style = catalyst_get_dynamik( 'page_content_border_style' );
	$page_content_border_color = catalyst_get_dynamik( 'page_content_border_color' );
	
	if( catalyst_get_dynamik( 'page_content_border_type' ) == 'Top/Bottom' )
	{
		$page_content_top_border_thickness = $page_content_border_thickness;
		$page_content_bottom_border_thickness = $page_content_border_thickness;
		$page_content_left_border_thickness = 0;
		$page_content_right_border_thickness = 0;
	}
	elseif( catalyst_get_dynamik( 'page_content_border_type' ) == 'Bottom' )
	{
		$page_content_top_border_thickness = 0;
		$page_content_bottom_border_thickness = $page_content_border_thickness;
		$page_content_left_border_thickness = 0;
		$page_content_right_border_thickness = 0;
	}
	elseif( catalyst_get_dynamik( 'page_content_border_type' ) == 'Left/Right' )
	{
		$page_content_top_border_thickness = 0;
		$page_content_bottom_border_thickness = 0;
		$page_content_left_border_thickness = $page_content_border_thickness;
		$page_content_right_border_thickness = $page_content_border_thickness;
	}
	elseif( catalyst_get_dynamik( 'page_content_border_type' ) == 'Left' )
	{
		$page_content_top_border_thickness = 0;
		$page_content_bottom_border_thickness = 0;
		$page_content_left_border_thickness = $page_content_border_thickness;
		$page_content_right_border_thickness = 0;
	}
	elseif( catalyst_get_dynamik( 'page_content_border_type' ) == 'Right' )
	{
		$page_content_top_border_thickness = 0;
		$page_content_bottom_border_thickness = 0;
		$page_content_left_border_thickness = 0;
		$page_content_right_border_thickness = $page_content_border_thickness;
	}
	else
	{
		$page_content_top_border_thickness = $page_content_border_thickness;
		$page_content_bottom_border_thickness = $page_content_border_thickness;
		$page_content_left_border_thickness = $page_content_border_thickness;
		$page_content_right_border_thickness = $page_content_border_thickness;
	}
	
	// Sticky-Post borders
	$sticky_post_border_thickness = catalyst_get_dynamik( 'sticky_post_border_thickness' );
	$sticky_post_border_style = catalyst_get_dynamik( 'sticky_post_border_style' );
	$sticky_post_border_color = catalyst_get_dynamik( 'sticky_post_border_color' );
	
	if( catalyst_get_dynamik( 'sticky_post_border_type' ) == 'Top/Bottom' )
	{
		$sticky_post_top_border_thickness = $sticky_post_border_thickness;
		$sticky_post_bottom_border_thickness = $sticky_post_border_thickness;
		$sticky_post_left_border_thickness = 0;
		$sticky_post_right_border_thickness = 0;
	}
	elseif( catalyst_get_dynamik( 'sticky_post_border_type' ) == 'Bottom' )
	{
		$sticky_post_top_border_thickness = 0;
		$sticky_post_bottom_border_thickness = $sticky_post_border_thickness;
		$sticky_post_left_border_thickness = 0;
		$sticky_post_right_border_thickness = 0;
	}
	elseif( catalyst_get_dynamik( 'sticky_post_border_type' ) == 'Left/Right' )
	{
		$sticky_post_top_border_thickness = 0;
		$sticky_post_bottom_border_thickness = 0;
		$sticky_post_left_border_thickness = $sticky_post_border_thickness;
		$sticky_post_right_border_thickness = $sticky_post_border_thickness;
	}
	elseif( catalyst_get_dynamik( 'sticky_post_border_type' ) == 'Left' )
	{
		$sticky_post_top_border_thickness = 0;
		$sticky_post_bottom_border_thickness = 0;
		$sticky_post_left_border_thickness = $sticky_post_border_thickness;
		$sticky_post_right_border_thickness = 0;
	}
	else
	{
		$sticky_post_top_border_thickness = $sticky_post_border_thickness;
		$sticky_post_bottom_border_thickness = $sticky_post_border_thickness;
		$sticky_post_left_border_thickness = $sticky_post_border_thickness;
		$sticky_post_right_border_thickness = $sticky_post_border_thickness;
	}
	
	// EZ Widget borders
	$ez_widget_home_heading_bottom_border_thickness = catalyst_get_dynamik( 'ez_widget_home_heading_bottom_border_thickness' );
	$ez_widget_home_heading_bottom_border_style = catalyst_get_dynamik( 'ez_widget_home_heading_bottom_border_style' );
	$ez_widget_home_heading_bottom_border_color = catalyst_get_dynamik( 'ez_widget_home_heading_bottom_border_color' );
	
	$ez_widget_home_border_thickness = catalyst_get_dynamik( 'ez_widget_home_border_thickness' );
	$ez_widget_home_border_style = catalyst_get_dynamik( 'ez_widget_home_border_style' );
	$ez_widget_home_border_color = catalyst_get_dynamik( 'ez_widget_home_border_color' );
	
	if( catalyst_get_dynamik( 'ez_widget_home_border_type' ) == 'Full' )
	{
		$ez_widget_home_tb_border_thickness = $ez_widget_home_border_thickness;
		$ez_widget_home_lr_border_thickness = $ez_widget_home_border_thickness;
	}
	elseif( catalyst_get_dynamik( 'ez_widget_home_border_type' ) == 'Top/Bottom' )
	{
		$ez_widget_home_tb_border_thickness = $ez_widget_home_border_thickness;
		$ez_widget_home_lr_border_thickness = 0;
	}
	else
	{
		$ez_widget_home_tb_border_thickness = 0;
		$ez_widget_home_lr_border_thickness = $ez_widget_home_border_thickness;
	}
	
	$ez_widget_feature_heading_bottom_border_thickness = catalyst_get_dynamik( 'ez_widget_feature_heading_bottom_border_thickness' );
	$ez_widget_feature_heading_bottom_border_style = catalyst_get_dynamik( 'ez_widget_feature_heading_bottom_border_style' );
	$ez_widget_feature_heading_bottom_border_color = catalyst_get_dynamik( 'ez_widget_feature_heading_bottom_border_color' );
	
	$ez_widget_feature_border_thickness = catalyst_get_dynamik( 'ez_widget_feature_border_thickness' );
	$ez_widget_feature_border_style = catalyst_get_dynamik( 'ez_widget_feature_border_style' );
	$ez_widget_feature_border_color = catalyst_get_dynamik( 'ez_widget_feature_border_color' );
	
	if( catalyst_get_dynamik( 'ez_widget_feature_border_type' ) == 'Top' )
	{
		$ez_widget_feature_top_border_thickness = $ez_widget_feature_border_thickness;
		$ez_widget_feature_bottom_border_thickness = 0;
		$ez_widget_feature_left_border_thickness = 0;
		$ez_widget_feature_right_border_thickness = 0;
	}
	elseif( catalyst_get_dynamik( 'ez_widget_feature_border_type' ) == 'Bottom' )
	{
		$ez_widget_feature_top_border_thickness = 0;
		$ez_widget_feature_bottom_border_thickness = $ez_widget_feature_border_thickness;
		$ez_widget_feature_left_border_thickness = 0;
		$ez_widget_feature_right_border_thickness = 0;
	}
	elseif( catalyst_get_dynamik( 'ez_widget_feature_border_type' ) == 'Top/Bottom' )
	{
		$ez_widget_feature_top_border_thickness = $ez_widget_feature_border_thickness;
		$ez_widget_feature_bottom_border_thickness = $ez_widget_feature_border_thickness;
		$ez_widget_feature_left_border_thickness = 0;
		$ez_widget_feature_right_border_thickness = 0;
	}
	elseif( catalyst_get_dynamik( 'ez_widget_feature_border_type' ) == 'Left/Right' )
	{
		$ez_widget_feature_top_border_thickness = 0;
		$ez_widget_feature_bottom_border_thickness = 0;
		$ez_widget_feature_left_border_thickness = $ez_widget_feature_border_thickness;
		$ez_widget_feature_right_border_thickness = $ez_widget_feature_border_thickness;
	}
	else
	{
		$ez_widget_feature_top_border_thickness = $ez_widget_feature_border_thickness;
		$ez_widget_feature_bottom_border_thickness = $ez_widget_feature_border_thickness;
		$ez_widget_feature_left_border_thickness = $ez_widget_feature_border_thickness;
		$ez_widget_feature_right_border_thickness = $ez_widget_feature_border_thickness;
	}
	
	$ez_widget_footer_heading_bottom_border_thickness = catalyst_get_dynamik( 'ez_widget_footer_heading_bottom_border_thickness' );
	$ez_widget_footer_heading_bottom_border_style = catalyst_get_dynamik( 'ez_widget_footer_heading_bottom_border_style' );
	$ez_widget_footer_heading_bottom_border_color = catalyst_get_dynamik( 'ez_widget_footer_heading_bottom_border_color' );
	
	$ez_widget_footer_border_thickness = catalyst_get_dynamik( 'ez_widget_footer_border_thickness' );
	$ez_widget_footer_border_style = catalyst_get_dynamik( 'ez_widget_footer_border_style' );
	$ez_widget_footer_border_color = catalyst_get_dynamik( 'ez_widget_footer_border_color' );
	
	if( catalyst_get_dynamik( 'ez_widget_footer_border_type' ) == 'Top' )
	{
		$ez_widget_footer_top_border_thickness = $ez_widget_footer_border_thickness;
		$ez_widget_footer_bottom_border_thickness = 0;
		$ez_widget_footer_left_border_thickness = 0;
		$ez_widget_footer_right_border_thickness = 0;
	}
	elseif( catalyst_get_dynamik( 'ez_widget_footer_border_type' ) == 'Bottom' )
	{
		$ez_widget_footer_top_border_thickness = 0;
		$ez_widget_footer_bottom_border_thickness = $ez_widget_footer_border_thickness;
		$ez_widget_footer_left_border_thickness = 0;
		$ez_widget_footer_right_border_thickness = 0;
	}
	elseif( catalyst_get_dynamik( 'ez_widget_footer_border_type' ) == 'Top/Bottom' )
	{
		$ez_widget_footer_top_border_thickness = $ez_widget_footer_border_thickness;
		$ez_widget_footer_bottom_border_thickness = $ez_widget_footer_border_thickness;
		$ez_widget_footer_left_border_thickness = 0;
		$ez_widget_footer_right_border_thickness = 0;
	}
	elseif( catalyst_get_dynamik( 'ez_widget_footer_border_type' ) == 'Left/Right' )
	{
		$ez_widget_footer_top_border_thickness = 0;
		$ez_widget_footer_bottom_border_thickness = 0;
		$ez_widget_footer_left_border_thickness = $ez_widget_footer_border_thickness;
		$ez_widget_footer_right_border_thickness = $ez_widget_footer_border_thickness;
	}
	else
	{
		$ez_widget_footer_top_border_thickness = $ez_widget_footer_border_thickness;
		$ez_widget_footer_bottom_border_thickness = $ez_widget_footer_border_thickness;
		$ez_widget_footer_left_border_thickness = $ez_widget_footer_border_thickness;
		$ez_widget_footer_right_border_thickness = $ez_widget_footer_border_thickness;
	}
	
	// Catalyst Widget borders
	$catalyst_widget_border_thickness = catalyst_get_dynamik( 'catalyst_widget_border_thickness' );
	$catalyst_widget_border_style = catalyst_get_dynamik( 'catalyst_widget_border_style' );
	$catalyst_widget_border_color = catalyst_get_dynamik( 'catalyst_widget_border_color' );
	
	if( catalyst_get_dynamik( 'catalyst_widget_border_type' ) == 'Top' )
	{
		$catalyst_widget_top_border_thickness = $catalyst_widget_border_thickness;
		$catalyst_widget_bottom_border_thickness = 0;
		$catalyst_widget_left_border_thickness = 0;
		$catalyst_widget_right_border_thickness = 0;
	}
	elseif( catalyst_get_dynamik( 'catalyst_widget_border_type' ) == 'Bottom' )
	{
		$catalyst_widget_top_border_thickness = 0;
		$catalyst_widget_bottom_border_thickness = $catalyst_widget_border_thickness;
		$catalyst_widget_left_border_thickness = 0;
		$catalyst_widget_right_border_thickness = 0;
	}
	elseif( catalyst_get_dynamik( 'catalyst_widget_border_type' ) == 'Left' )
	{
		$catalyst_widget_top_border_thickness = 0;
		$catalyst_widget_bottom_border_thickness = 0;
		$catalyst_widget_left_border_thickness = $catalyst_widget_border_thickness;
		$catalyst_widget_right_border_thickness = 0;
	}
	elseif( catalyst_get_dynamik( 'catalyst_widget_border_type' ) == 'Right' )
	{
		$catalyst_widget_top_border_thickness = 0;
		$catalyst_widget_bottom_border_thickness = 0;
		$catalyst_widget_left_border_thickness = 0;
		$catalyst_widget_right_border_thickness = $catalyst_widget_border_thickness;
	}
	else
	{
		$catalyst_widget_top_border_thickness = $catalyst_widget_border_thickness;
		$catalyst_widget_bottom_border_thickness = $catalyst_widget_border_thickness;
		$catalyst_widget_left_border_thickness = $catalyst_widget_border_thickness;
		$catalyst_widget_right_border_thickness = $catalyst_widget_border_thickness;
	}
	
	// Breadcrumb borders
	$breadcrumbs_border_thickness = catalyst_get_dynamik( 'breadcrumbs_border_thickness' );
	$breadcrumbs_border_style = catalyst_get_dynamik( 'breadcrumbs_border_style' );
	$breadcrumbs_border_color = catalyst_get_dynamik( 'breadcrumbs_border_color' );
	
	if( catalyst_get_dynamik( 'breadcrumbs_border_type' ) == 'Top/Bottom' )
	{
		$breadcrumbs_top_border_thickness = $breadcrumbs_border_thickness;
		$breadcrumbs_bottom_border_thickness = $breadcrumbs_border_thickness;
		$breadcrumbs_left_border_thickness = 0;
		$breadcrumbs_right_border_thickness = 0;
	}
	elseif( catalyst_get_dynamik( 'breadcrumbs_border_type' ) == 'Bottom' )
	{
		$breadcrumbs_top_border_thickness = 0;
		$breadcrumbs_bottom_border_thickness = $breadcrumbs_border_thickness;
		$breadcrumbs_left_border_thickness = 0;
		$breadcrumbs_right_border_thickness = 0;
	}
	elseif( catalyst_get_dynamik( 'breadcrumbs_border_type' ) == 'Left/Right' )
	{
		$breadcrumbs_top_border_thickness = 0;
		$breadcrumbs_bottom_border_thickness = 0;
		$breadcrumbs_left_border_thickness = $breadcrumbs_border_thickness;
		$breadcrumbs_right_border_thickness = $breadcrumbs_border_thickness;
	}
	elseif( catalyst_get_dynamik( 'breadcrumbs_border_type' ) == 'Left' )
	{
		$breadcrumbs_top_border_thickness = 0;
		$breadcrumbs_bottom_border_thickness = 0;
		$breadcrumbs_left_border_thickness = $breadcrumbs_border_thickness;
		$breadcrumbs_right_border_thickness = 0;
	}
	else
	{
		$breadcrumbs_top_border_thickness = $breadcrumbs_border_thickness;
		$breadcrumbs_bottom_border_thickness = $breadcrumbs_border_thickness;
		$breadcrumbs_left_border_thickness = $breadcrumbs_border_thickness;
		$breadcrumbs_right_border_thickness = $breadcrumbs_border_thickness;
	}
	
	// Author avatar borders
	$author_avatar_border_thickness = catalyst_get_dynamik( 'author_avatar_border_thickness' );
	$author_avatar_border_style = catalyst_get_dynamik( 'author_avatar_border_style' );
	$author_avatar_border_color = catalyst_get_dynamik( 'author_avatar_border_color' );
	
	// Author info borders
	$author_info_border_thickness = catalyst_get_dynamik( 'author_info_border_thickness' );
	$author_info_border_style = catalyst_get_dynamik( 'author_info_border_style' );
	$author_info_border_color = catalyst_get_dynamik( 'author_info_border_color' );
	
	if( catalyst_get_dynamik( 'author_info_border_type' ) == 'Full' )
	{
		$author_info_top_border_thickness = $author_info_border_thickness;
		$author_info_bottom_border_thickness = $author_info_border_thickness;
		$author_info_left_border_thickness = $author_info_border_thickness;
		$author_info_right_border_thickness = $author_info_border_thickness;
	}
	elseif( catalyst_get_dynamik( 'author_info_border_type' ) == 'Top' )
	{
		$author_info_top_border_thickness = $author_info_border_thickness;
		$author_info_bottom_border_thickness = 0;
		$author_info_left_border_thickness = 0;
		$author_info_right_border_thickness = 0;
	}
	elseif( catalyst_get_dynamik( 'author_info_border_type' ) == 'Top/Bottom' )
	{
		$author_info_top_border_thickness = $author_info_border_thickness;
		$author_info_bottom_border_thickness = $author_info_border_thickness;
		$author_info_left_border_thickness = 0;
		$author_info_right_border_thickness = 0;
	}
	elseif( catalyst_get_dynamik( 'author_info_border_type' ) == 'Left/Right' )
	{
		$author_info_top_border_thickness = 0;
		$author_info_bottom_border_thickness = 0;
		$author_info_left_border_thickness = $author_info_border_thickness;
		$author_info_right_border_thickness = $author_info_border_thickness;
	}
	else
	{
		$author_info_top_border_thickness = 0;
		$author_info_bottom_border_thickness = 0;
		$author_info_left_border_thickness = $author_info_border_thickness;
		$author_info_right_border_thickness = 0;
	}
	
	// Post-Nav borders
	$post_nav_border_thickness = catalyst_get_dynamik( 'post_nav_border_thickness' );
	$post_nav_border_style = catalyst_get_dynamik( 'post_nav_border_style' );
	$post_nav_border_color = catalyst_get_dynamik( 'post_nav_border_color' );
	
	// Thumbnail borders
	$thumbnail_border_thickness = catalyst_get_dynamik( 'thumbnail_border_thickness' );
	$thumbnail_border_style = catalyst_get_dynamik( 'thumbnail_border_style' );
	$thumbnail_border_color = catalyst_get_dynamik( 'thumbnail_border_color' );
	
	// Blockquote borders
	$blockquote_border_thickness = catalyst_get_dynamik( 'blockquote_border_thickness' );
	$blockquote_border_style = catalyst_get_dynamik( 'blockquote_border_style' );
	$blockquote_border_color = catalyst_get_dynamik( 'blockquote_border_color' );
	
	if( catalyst_get_dynamik( 'blockquote_border_type' ) == 'Left' )
	{
		$blockquote_tb_border_thickness = 0;
		$blockquote_left_border_thickness = $blockquote_border_thickness;
		$blockquote_right_border_thickness = 0;
	}
	elseif( catalyst_get_dynamik( 'blockquote_border_type' ) == 'Left/Right' )
	{
		$blockquote_tb_border_thickness = 0;
		$blockquote_left_border_thickness = $blockquote_border_thickness;
		$blockquote_right_border_thickness = $blockquote_border_thickness;
	}
	elseif( catalyst_get_dynamik( 'blockquote_border_type' ) == 'Top/Bottom' )
	{
		$blockquote_tb_border_thickness = $blockquote_border_thickness;
		$blockquote_left_border_thickness = 0;
		$blockquote_right_border_thickness = 0;
	}
	else
	{
		$blockquote_tb_border_thickness = $blockquote_border_thickness;
		$blockquote_left_border_thickness = $blockquote_border_thickness;
		$blockquote_right_border_thickness = $blockquote_border_thickness;
	}
	
	// Content Caption borders
	$caption_border_thickness = catalyst_get_dynamik( 'caption_border_thickness' );
	$caption_border_style = catalyst_get_dynamik( 'caption_border_style' );
	$caption_border_color = catalyst_get_dynamik( 'caption_border_color' );
	
	// Content Bottom borders
	$cc_bottom_border_thickness = catalyst_get_dynamik( 'cc_bottom_border_thickness' );
	$cc_bottom_border_style = catalyst_get_dynamik( 'cc_bottom_border_style' );
	$cc_bottom_border_color = catalyst_get_dynamik( 'cc_bottom_border_color' );
	
	// Sidebar Heading/Content borders
	$sb_heading_border_thickness = catalyst_get_dynamik( 'sb_heading_border_thickness' );
	$sb_heading_border_style = catalyst_get_dynamik( 'sb_heading_border_style' );
	$sb_heading_border_color = catalyst_get_dynamik( 'sb_heading_border_color' );
	
	if( catalyst_get_dynamik( 'sb_heading_border_type' ) == 'Bottom' )
	{
		$sb_heading_top_border_thickness = 0;
		$sb_heading_bottom_border_thickness = $sb_heading_border_thickness;
		$sb_heading_lr_border_thickness = 0;
	}
	elseif( catalyst_get_dynamik( 'sb_heading_border_type' ) == 'Top/Bottom' )
	{
		$sb_heading_top_border_thickness = $sb_heading_border_thickness;
		$sb_heading_bottom_border_thickness = $sb_heading_border_thickness;
		$sb_heading_lr_border_thickness = 0;
	}
	else
	{
		$sb_heading_top_border_thickness = $sb_heading_border_thickness;
		$sb_heading_bottom_border_thickness = $sb_heading_border_thickness;
		$sb_heading_lr_border_thickness = $sb_heading_border_thickness;
	}
	
	$sb_content_border_thickness = catalyst_get_dynamik( 'sb_content_border_thickness' );
	$sb_content_border_style = catalyst_get_dynamik( 'sb_content_border_style' );
	$sb_content_border_color = catalyst_get_dynamik( 'sb_content_border_color' );
	
	if( catalyst_get_dynamik( 'sb_content_border_type' ) == 'Bottom' )
	{
		$sb_content_top_border_thickness = 0;
		$sb_content_bottom_border_thickness = $sb_content_border_thickness;
		$sb_content_lr_border_thickness = 0;
	}
	elseif( catalyst_get_dynamik( 'sb_content_border_type' ) == 'Top/Bottom' )
	{
		$sb_content_top_border_thickness = $sb_content_border_thickness;
		$sb_content_bottom_border_thickness = $sb_content_border_thickness;
		$sb_content_lr_border_thickness = 0;
	}
	else
	{
		$sb_content_top_border_thickness = $sb_content_border_thickness;
		$sb_content_bottom_border_thickness = $sb_content_border_thickness;
		$sb_content_lr_border_thickness = $sb_content_border_thickness;
	}
	
	// Comment borders
	$comment_wrap_border_thickness = catalyst_get_dynamik( 'comment_wrap_border_thickness' );
	$comment_wrap_border_style = catalyst_get_dynamik( 'comment_wrap_border_style' );
	$comment_wrap_border_color = catalyst_get_dynamik( 'comment_wrap_border_color' );
	
	$comment_body_border_thickness = catalyst_get_dynamik( 'comment_body_border_thickness' );
	$comment_body_border_style = catalyst_get_dynamik( 'comment_body_border_style' );
	$comment_body_border_color = catalyst_get_dynamik( 'comment_body_border_color' );
	
	if( catalyst_get_dynamik( 'comment_body_border_type' ) == 'Top/Bottom' )
	{
		$comment_body_top_border_thickness = $comment_body_border_thickness;
		$comment_body_bottom_border_thickness = $comment_body_border_thickness;
		$comment_body_lr_border_thickness = 0;
	}
	else
	{
		$comment_body_top_border_thickness = $comment_body_border_thickness;
		$comment_body_bottom_border_thickness = $comment_body_border_thickness;
		$comment_body_lr_border_thickness = $comment_body_border_thickness;
	}
	
	$comment_avatar_border_thickness = catalyst_get_dynamik( 'comment_avatar_border_thickness' );
	$comment_avatar_border_style = catalyst_get_dynamik( 'comment_avatar_border_style' );
	$comment_avatar_border_color = catalyst_get_dynamik( 'comment_avatar_border_color' );
	
	$comment_form_border_thickness = catalyst_get_dynamik( 'comment_form_border_thickness' );
	$comment_form_border_style = catalyst_get_dynamik( 'comment_form_border_style' );
	$comment_form_border_color = catalyst_get_dynamik( 'comment_form_border_color' );
	
	$comment_submit_border_thickness = catalyst_get_dynamik( 'comment_submit_border_thickness' );
	$comment_submit_border_style = catalyst_get_dynamik( 'comment_submit_border_style' );
	$comment_submit_border_color = catalyst_get_dynamik( 'comment_submit_border_color' );
	
	$comment_submit_hover_border_thickness = catalyst_get_dynamik( 'comment_submit_hover_border_thickness' );
	$comment_submit_hover_border_style = catalyst_get_dynamik( 'comment_submit_hover_border_style' );
	$comment_submit_hover_border_color = catalyst_get_dynamik( 'comment_submit_hover_border_color' );
	
	// Footer border (Thickness is defined in Widths section)
	$footer_border_style = catalyst_get_dynamik( 'footer_border_style' );
	$footer_border_color = catalyst_get_dynamik( 'footer_border_color' );
	
	if( catalyst_get_dynamik( 'footer_border_type' ) == 'Top' )
	{
		$footer_top_border_thickness = $catalyst_dimensions['footer_border_thickness'];
		$footer_bottom_border_thickness = 0;
		$footer_lr_border_thickness = 0;
	}
	elseif( catalyst_get_dynamik( 'footer_border_type' ) == 'Bottom' )
	{
		$footer_top_border_thickness = 0;
		$footer_bottom_border_thickness = $catalyst_dimensions['footer_border_thickness'];
		$footer_lr_border_thickness = 0;
	}
	elseif( catalyst_get_dynamik( 'footer_border_type' ) == 'Top/Bottom' )
	{
		$footer_top_border_thickness = $catalyst_dimensions['footer_border_thickness'];
		$footer_bottom_border_thickness = $catalyst_dimensions['footer_border_thickness'];
		$footer_lr_border_thickness = 0;
	}
	elseif( catalyst_get_dynamik( 'footer_border_type' ) == 'Left/Right' )
	{
		$footer_top_border_thickness = 0;
		$footer_bottom_border_thickness = 0;
		$footer_lr_border_thickness = $catalyst_dimensions['footer_border_thickness'];
	}
	else
	{
		$footer_top_border_thickness = $catalyst_dimensions['footer_border_thickness'];
		$footer_bottom_border_thickness = $catalyst_dimensions['footer_border_thickness'];
		$footer_lr_border_thickness = $catalyst_dimensions['footer_border_thickness'];
	}
	
	// Search Form borders
	$search_form_border_thickness = catalyst_get_dynamik( 'search_form_border_thickness' );
	$search_form_border_style = catalyst_get_dynamik( 'search_form_border_style' );
	$search_form_border_color = catalyst_get_dynamik( 'search_form_border_color' );
	
	$search_button_border_thickness = catalyst_get_dynamik( 'search_button_border_thickness' );
	$search_button_border_style = catalyst_get_dynamik( 'search_button_border_style' );
	$search_button_border_color = catalyst_get_dynamik( 'search_button_border_color' );
	
	$search_button_hover_border_thickness = catalyst_get_dynamik( 'search_button_hover_border_thickness' );
	$search_button_hover_border_style = catalyst_get_dynamik( 'search_button_hover_border_style' );
	$search_button_hover_border_color = catalyst_get_dynamik( 'search_button_hover_border_color' );
	
	/****************************************
			Define Font Styles
	****************************************/
	
	// Universal/Body fonts
	$universal_font_type = $dynamik_font_type['universal'];
	$universal_font_color = catalyst_get_dynamik( 'universal_font_color' );
	$universal_link_color = catalyst_get_dynamik( 'universal_link_color' );
	$universal_link_hover_color = catalyst_get_dynamik( 'universal_link_hover_color' );
	$universal_line_height = catalyst_get_dynamik( 'universal_line_height' );
	$body_font_size = catalyst_get_dynamik( 'body_font_size' );
	
	if( catalyst_get_dynamik( 'universal_link_underline' ) == 'On Hover' )
	{
		$universal_link_underline_visited = 'none';
		$universal_link_underline_hover = 'underline';
	}
	elseif( catalyst_get_dynamik( 'universal_link_underline' ) == 'Off Hover' )
	{
		$universal_link_underline_visited = 'underline';
		$universal_link_underline_hover = 'none';
	}
	elseif( catalyst_get_dynamik( 'universal_link_underline' ) == 'Always' )
	{
		$universal_link_underline_visited = 'underline';
		$universal_link_underline_hover = 'underline';
	}
	else
	{
		$universal_link_underline_visited = 'none';
		$universal_link_underline_hover = 'none';
	}

	// Header fonts
	$title_font_type = $dynamik_font_type['title'];
	$title_font_size = catalyst_get_dynamik( 'title_font_size' ) . catalyst_get_dynamik( 'title_px_em' );
	$title_font_color = catalyst_get_dynamik( 'title_font_color' );
	$title_link_color = catalyst_get_dynamik( 'title_link_color' );

	if( catalyst_get_dynamik( 'title_link_underline' ) == 'On Hover' )
	{
		$title_link_underline_visited = 'none';
		$title_link_underline_hover = 'underline';
	}
	elseif( catalyst_get_dynamik( 'title_link_underline' ) == 'Off Hover' )
	{
		$title_link_underline_visited = 'underline';
		$title_link_underline_hover = 'none';
	}
	elseif( catalyst_get_dynamik( 'title_link_underline' ) == 'Always' )
	{
		$title_link_underline_visited = 'underline';
		$title_link_underline_hover = 'underline';
	}
	else
	{
		$title_link_underline_visited = 'none';
		$title_link_underline_hover = 'none';
	}
	
	$tagline_font_type = $dynamik_font_type['tagline'];
	$tagline_font_size = catalyst_get_dynamik( 'tagline_font_size' ) . catalyst_get_dynamik( 'tagline_px_em' );
	$tagline_font_color = catalyst_get_dynamik( 'tagline_font_color' );
	
	// Navbar 1 fonts
	$nav1_font_type = $dynamik_font_type['nav1'];
	$nav1_font_size = catalyst_get_dynamik( 'nav1_font_size' ) . catalyst_get_dynamik( 'nav1_px_em' );
	if( catalyst_get_dynamik( 'nav1_px_em' ) == 'em' )
	{
		$nav1_font_size_px = round( catalyst_get_dynamik( 'nav1_font_size' ) * $body_font_size, 0 );
	}
	else
	{
		$nav1_font_size_px = catalyst_get_dynamik( 'nav1_font_size' );
	}
	
	if( catalyst_get_dynamik( 'nav1_link_underline' ) == 'On Hover' )
	{
		$nav1_link_underline_visited = 'none';
		$nav1_link_underline_hover = 'underline';
	}
	elseif( catalyst_get_dynamik( 'nav1_link_underline' ) == 'Off Hover' )
	{
		$nav1_link_underline_visited = 'underline';
		$nav1_link_underline_hover = 'none';
	}
	elseif( catalyst_get_dynamik( 'nav1_link_underline' ) == 'Always' )
	{
		$nav1_link_underline_visited = 'underline';
		$nav1_link_underline_hover = 'underline';
	}
	else
	{
		$nav1_link_underline_visited = 'none';
		$nav1_link_underline_hover = 'none';
	}
	
	$nav1_page_font_color = catalyst_get_dynamik( 'nav1_page_font_color' );
	$nav1_page_hover_font_color = catalyst_get_dynamik( 'nav1_page_hover_font_color' );
	$nav1_page_active_font_color = catalyst_get_dynamik( 'nav1_page_active_font_color' );
	$nav1_sub_page_font_color = catalyst_get_dynamik( 'nav1_sub_page_font_color' );
	$nav1_sub_page_hover_font_color = catalyst_get_dynamik( 'nav1_sub_page_hover_font_color' );
	
	$nav1_right_font_type = $dynamik_font_type['nav1_right'];
	$nav1_right_font_size = catalyst_get_dynamik( 'nav1_right_font_size' ) . catalyst_get_dynamik( 'nav1_right_px_em' );
	$nav1_right_font_color = catalyst_get_dynamik( 'nav1_right_font_color' );
	$nav1_right_link_color = catalyst_get_dynamik( 'nav1_right_link_color' );
	$nav1_right_link_hover_color = catalyst_get_dynamik( 'nav1_right_link_hover_color' );
	
	if( catalyst_get_dynamik( 'nav1_right_link_underline' ) == 'On Hover' )
	{
		$nav1_right_link_underline_visited = 'none';
		$nav1_right_link_underline_hover = 'underline';
	}
	elseif( catalyst_get_dynamik( 'nav1_right_link_underline' ) == 'Off Hover' )
	{
		$nav1_right_link_underline_visited = 'underline';
		$nav1_right_link_underline_hover = 'none';
	}
	elseif( catalyst_get_dynamik( 'nav1_right_link_underline' ) == 'Always' )
	{
		$nav1_right_link_underline_visited = 'underline';
		$nav1_right_link_underline_hover = 'underline';
	}
	else
	{
		$nav1_right_link_underline_visited = 'none';
		$nav1_right_link_underline_hover = 'none';
	}
	
	// Navbar 2 fonts
	$nav2_font_type = $dynamik_font_type['nav2'];
	$nav2_font_size = catalyst_get_dynamik( 'nav2_font_size' ) . catalyst_get_dynamik( 'nav2_px_em' );
	if( catalyst_get_dynamik( 'nav2_px_em' ) == 'em' )
	{
		$nav2_font_size_px = round( catalyst_get_dynamik( 'nav2_font_size' ) * $body_font_size, 0 );
	}
	else
	{
		$nav2_font_size_px = catalyst_get_dynamik( 'nav2_font_size' );
	}
	
	if( catalyst_get_dynamik( 'nav2_link_underline' ) == 'On Hover' )
	{
		$nav2_link_underline_visited = 'none';
		$nav2_link_underline_hover = 'underline';
	}
	elseif( catalyst_get_dynamik( 'nav2_link_underline' ) == 'Off Hover' )
	{
		$nav2_link_underline_visited = 'underline';
		$nav2_link_underline_hover = 'none';
	}
	elseif( catalyst_get_dynamik( 'nav2_link_underline' ) == 'Always' )
	{
		$nav2_link_underline_visited = 'underline';
		$nav2_link_underline_hover = 'underline';
	}
	else
	{
		$nav2_link_underline_visited = 'none';
		$nav2_link_underline_hover = 'none';
	}
	
	$nav2_page_font_color = catalyst_get_dynamik( 'nav2_page_font_color' );
	$nav2_page_hover_font_color = catalyst_get_dynamik( 'nav2_page_hover_font_color' );
	$nav2_page_active_font_color = catalyst_get_dynamik( 'nav2_page_active_font_color' );
	$nav2_sub_page_font_color = catalyst_get_dynamik( 'nav2_sub_page_font_color' );
	$nav2_sub_page_hover_font_color = catalyst_get_dynamik( 'nav2_sub_page_hover_font_color' );
	
	$nav2_right_font_type = $dynamik_font_type['nav2_right'];
	$nav2_right_font_size = catalyst_get_dynamik( 'nav2_right_font_size' ) . catalyst_get_dynamik( 'nav2_right_px_em' );
	$nav2_right_font_color = catalyst_get_dynamik( 'nav2_right_font_color' );
	$nav2_right_link_color = catalyst_get_dynamik( 'nav2_right_link_color' );
	$nav2_right_link_hover_color = catalyst_get_dynamik( 'nav2_right_link_hover_color' );
	
	if( catalyst_get_dynamik( 'nav2_right_link_underline' ) == 'On Hover' )
	{
		$nav2_right_link_underline_visited = 'none';
		$nav2_right_link_underline_hover = 'underline';
	}
	elseif( catalyst_get_dynamik( 'nav2_right_link_underline' ) == 'Off Hover' )
	{
		$nav2_right_link_underline_visited = 'underline';
		$nav2_right_link_underline_hover = 'none';
	}
	elseif( catalyst_get_dynamik( 'nav2_right_link_underline' ) == 'Always' )
	{
		$nav2_right_link_underline_visited = 'underline';
		$nav2_right_link_underline_hover = 'underline';
	}
	else
	{
		$nav2_right_link_underline_visited = 'none';
		$nav2_right_link_underline_hover = 'none';
	}
	
	// Content fonts
	$content_heading_font_type = $dynamik_font_type['content_heading'];
	
	$content_heading_h1_font_size = catalyst_get_dynamik( 'content_heading_h1_font_size' ) . catalyst_get_dynamik( 'h1_px_em' );
	$content_heading_h2_font_size = catalyst_get_dynamik( 'content_heading_h2_font_size' ) . catalyst_get_dynamik( 'h2_px_em' );
	$content_heading_h3_font_size = catalyst_get_dynamik( 'content_heading_h3_font_size' ) . catalyst_get_dynamik( 'h3_px_em' );
	$content_heading_h4_font_size = catalyst_get_dynamik( 'content_heading_h4_font_size' ) . catalyst_get_dynamik( 'h4_px_em' );
	$content_heading_h5_font_size = catalyst_get_dynamik( 'content_heading_h5_font_size' ) . catalyst_get_dynamik( 'h5_px_em' );
	$content_heading_h6_font_size = catalyst_get_dynamik( 'content_heading_h6_font_size' ) . catalyst_get_dynamik( 'h6_px_em' );
	
	$content_heading_h1_font_color = catalyst_get_dynamik( 'content_heading_h1_font_color' );
	$content_heading_h2_font_color = catalyst_get_dynamik( 'content_heading_h2_font_color' );
	$content_heading_h2_link_color = catalyst_get_dynamik( 'content_heading_h2_link_color' );
	$content_heading_h2_hover_color = catalyst_get_dynamik( 'content_heading_h2_hover_color' );
	$content_heading_h3_font_color = catalyst_get_dynamik( 'content_heading_h3_font_color' );
	$content_heading_h4_font_color = catalyst_get_dynamik( 'content_heading_h4_font_color' );
	$content_heading_h5_font_color = catalyst_get_dynamik( 'content_heading_h5_font_color' );
	$content_heading_h6_font_color = catalyst_get_dynamik( 'content_heading_h6_font_color' );
	
	if( catalyst_get_dynamik( 'content_heading_h2_link_underline' ) == 'On Hover' )
	{
		$content_heading_h2_link_underline_visited = 'none';
		$content_heading_h2_link_underline_hover = 'underline';
	}
	elseif( catalyst_get_dynamik( 'content_heading_h2_link_underline' ) == 'Off Hover' )
	{
		$content_heading_h2_link_underline_visited = 'underline';
		$content_heading_h2_link_underline_hover = 'none';
	}
	elseif( catalyst_get_dynamik( 'content_heading_h2_link_underline' ) == 'Always' )
	{
		$content_heading_h2_link_underline_visited = 'underline';
		$content_heading_h2_link_underline_hover = 'underline';
	}
	else
	{
		$content_heading_h2_link_underline_visited = 'none';
		$content_heading_h2_link_underline_hover = 'none';
	}
	
	$content_p_font_type = $dynamik_font_type['content_p'];
	$content_p_font_size = catalyst_get_dynamik( 'content_p_font_size' ) . catalyst_get_dynamik( 'content_p_px_em' );
	$content_p_font_color = catalyst_get_dynamik( 'content_p_font_color' );
	$content_p_link_color = catalyst_get_dynamik( 'content_p_link_color' );
	$content_p_link_hover_color = catalyst_get_dynamik( 'content_p_link_hover_color' );
	
	if( catalyst_get_dynamik( 'content_p_link_underline' ) == 'On Hover' )
	{
		$content_p_link_underline_visited = 'none';
		$content_p_link_underline_hover = 'underline';
	}
	elseif( catalyst_get_dynamik( 'content_p_link_underline' ) == 'Off Hover' )
	{
		$content_p_link_underline_visited = 'underline';
		$content_p_link_underline_hover = 'none';
	}
	elseif( catalyst_get_dynamik( 'content_p_link_underline' ) == 'Always' )
	{
		$content_p_link_underline_visited = 'underline';
		$content_p_link_underline_hover = 'underline';
	}
	else
	{
		$content_p_link_underline_visited = 'none';
		$content_p_link_underline_hover = 'none';
	}
	
	$content_byline_font_type = $dynamik_font_type['content_byline'];
	$content_byline_font_size = catalyst_get_dynamik( 'content_byline_font_size' ) . catalyst_get_dynamik( 'content_byline_px_em' );
	$content_byline_font_color = catalyst_get_dynamik( 'content_byline_font_color' );
	$content_byline_link_color = catalyst_get_dynamik( 'content_byline_link_color' );
	$content_byline_link_hover_color = catalyst_get_dynamik( 'content_byline_link_hover_color' );
	
	if( catalyst_get_dynamik( 'content_byline_link_underline' ) == 'On Hover' )
	{
		$content_byline_link_underline_visited = 'none';
		$content_byline_link_underline_hover = 'underline';
	}
	elseif( catalyst_get_dynamik( 'content_byline_link_underline' ) == 'Off Hover' )
	{
		$content_byline_link_underline_visited = 'underline';
		$content_byline_link_underline_hover = 'none';
	}
	elseif( catalyst_get_dynamik( 'content_byline_link_underline' ) == 'Always' )
	{
		$content_byline_link_underline_visited = 'underline';
		$content_byline_link_underline_hover = 'underline';
	}
	else
	{
		$content_byline_link_underline_visited = 'none';
		$content_byline_link_underline_hover = 'none';
	}
	
	// Sidebar fonts
	$sb_heading_font_type = $dynamik_font_type['sb_heading'];
	$sb_heading_font_size = catalyst_get_dynamik( 'sb_heading_font_size' ) . catalyst_get_dynamik( 'sb_heading_px_em' );
	$sb_heading_font_color = catalyst_get_dynamik( 'sb_heading_font_color' );
	
	$sb_content_font_type = $dynamik_font_type['sb_content'];
	$sb_content_font_size = catalyst_get_dynamik( 'sb_content_font_size' ) . catalyst_get_dynamik( 'sb_content_px_em' );
	$sb_content_font_color = catalyst_get_dynamik( 'sb_content_font_color' );
	$sb_content_link_color = catalyst_get_dynamik( 'sb_content_link_color' );
	$sb_content_link_hover_color = catalyst_get_dynamik( 'sb_content_link_hover_color' );
	
	if( catalyst_get_dynamik( 'sb_content_link_underline' ) == 'On Hover' )
	{
		$sb_content_link_underline_visited = 'none';
		$sb_content_link_underline_hover = 'underline';
	}
	elseif( catalyst_get_dynamik( 'sb_content_link_underline' ) == 'Off Hover' )
	{
		$sb_content_link_underline_visited = 'underline';
		$sb_content_link_underline_hover = 'none';
	}
	elseif( catalyst_get_dynamik( 'sb_content_link_underline' ) == 'Always' )
	{
		$sb_content_link_underline_visited = 'underline';
		$sb_content_link_underline_hover = 'underline';
	}
	else
	{
		$sb_content_link_underline_visited = 'none';
		$sb_content_link_underline_hover = 'none';
	}
	
	$sb_pages_font_type = $dynamik_font_type['sb_pages'];
	$sb_pages_font_size = catalyst_get_dynamik( 'sb_pages_font_size' ) . catalyst_get_dynamik( 'sb_pages_px_em' );
	$sb_pages_font_color = catalyst_get_dynamik( 'sb_pages_font_color' );
	$sb_pages_link_color = catalyst_get_dynamik( 'sb_pages_link_color' );
	$sb_pages_link_hover_color = catalyst_get_dynamik( 'sb_pages_link_hover_color' );
	
	if( catalyst_get_dynamik( 'sb_pages_link_underline' ) == 'On Hover' )
	{
		$sb_pages_link_underline_visited = 'none';
		$sb_pages_link_underline_hover = 'underline';
	}
	elseif( catalyst_get_dynamik( 'sb_pages_link_underline' ) == 'Off Hover' )
	{
		$sb_pages_link_underline_visited = 'underline';
		$sb_pages_link_underline_hover = 'none';
	}
	elseif( catalyst_get_dynamik( 'sb_pages_link_underline' ) == 'Always' )
	{
		$sb_pages_link_underline_visited = 'underline';
		$sb_pages_link_underline_hover = 'underline';
	}
	else
	{
		$sb_pages_link_underline_visited = 'none';
		$sb_pages_link_underline_hover = 'none';
	}
	
	if( !catalyst_get_dynamik( 'sb_pages_heading_display' ) )
		$sb_pages_heading_display = '.widget_pages h4 { display:none !important; }';
	else
		$sb_pages_heading_display = '';

	// Breadcrumb fonts
	$breadcrumbs_font_type = $dynamik_font_type['breadcrumbs'];
	$breadcrumbs_font_size = catalyst_get_dynamik( 'breadcrumbs_font_size' ) . catalyst_get_dynamik( 'breadcrumbs_px_em' );
	$breadcrumbs_font_color = catalyst_get_dynamik( 'breadcrumbs_font_color' );
	$breadcrumbs_link_color = catalyst_get_dynamik( 'breadcrumbs_link_color' );
	$breadcrumbs_link_hover_color = catalyst_get_dynamik( 'breadcrumbs_link_hover_color' );
	
	if( catalyst_get_dynamik( 'breadcrumbs_link_underline' ) == 'On Hover' )
	{
		$breadcrumbs_link_underline_visited = 'none';
		$breadcrumbs_link_underline_hover = 'underline';
	}
	elseif( catalyst_get_dynamik( 'breadcrumbs_link_underline' ) == 'Off Hover' )
	{
		$breadcrumbs_link_underline_visited = 'underline';
		$breadcrumbs_link_underline_hover = 'none';
	}
	elseif( catalyst_get_dynamik( 'breadcrumbs_link_underline' ) == 'Always' )
	{
		$breadcrumbs_link_underline_visited = 'underline';
		$breadcrumbs_link_underline_hover = 'underline';
	}
	else
	{
		$breadcrumbs_link_underline_visited = 'none';
		$breadcrumbs_link_underline_hover = 'none';
	}
	
	// Author info fonts
	$author_info_title_font_type = $dynamik_font_type['author_info_title'];
	$author_info_title_font_size = catalyst_get_dynamik( 'author_info_title_font_size' ) . catalyst_get_dynamik( 'author_info_title_px_em' );
	$author_info_title_font_color = catalyst_get_dynamik( 'author_info_title_font_color' );
	
	$author_info_font_type = $dynamik_font_type['author_info'];
	$author_info_font_size = catalyst_get_dynamik( 'author_info_font_size' ) . catalyst_get_dynamik( 'author_info_px_em' );
	$author_info_font_color = catalyst_get_dynamik( 'author_info_font_color' );
	$author_info_link_color = catalyst_get_dynamik( 'author_info_link_color' );
	$author_info_link_hover_color = catalyst_get_dynamik( 'author_info_link_hover_color' );
	
	if( catalyst_get_dynamik( 'author_info_link_underline' ) == 'On Hover' )
	{
		$author_info_link_underline_visited = 'none';
		$author_info_link_underline_hover = 'underline';
	}
	elseif( catalyst_get_dynamik( 'author_info_link_underline' ) == 'Off Hover' )
	{
		$author_info_link_underline_visited = 'underline';
		$author_info_link_underline_hover = 'none';
	}
	elseif( catalyst_get_dynamik( 'author_info_link_underline' ) == 'Always' )
	{
		$author_info_link_underline_visited = 'underline';
		$author_info_link_underline_hover = 'underline';
	}
	else
	{
		$author_info_link_underline_visited = 'none';
		$author_info_link_underline_hover = 'none';
	}
	
	// Post-Nav fonts
	$post_nav_font_type = $dynamik_font_type['post_nav'];
	$post_nav_font_size = catalyst_get_dynamik( 'post_nav_font_size' ) . catalyst_get_dynamik( 'post_nav_px_em' );
	$post_nav_link_color = catalyst_get_dynamik( 'post_nav_link_color' );
	$post_nav_link_hover_color = catalyst_get_dynamik( 'post_nav_link_hover_color' );
	
	if( catalyst_get_dynamik( 'post_nav_link_underline' ) == 'On Hover' )
	{
		$post_nav_link_underline_visited = 'none';
		$post_nav_link_underline_hover = 'underline';
	}
	elseif( catalyst_get_dynamik( 'post_nav_link_underline' ) == 'Off Hover' )
	{
		$post_nav_link_underline_visited = 'underline';
		$post_nav_link_underline_hover = 'none';
	}
	elseif( catalyst_get_dynamik( 'post_nav_link_underline' ) == 'Always' )
	{
		$post_nav_link_underline_visited = 'underline';
		$post_nav_link_underline_hover = 'underline';
	}
	else
	{
		$post_nav_link_underline_visited = 'none';
		$post_nav_link_underline_hover = 'none';
	}
	
	// Blockquote fonts
	$blockquote_font_type = $dynamik_font_type['blockquote'];
	$blockquote_font_size = catalyst_get_dynamik( 'blockquote_font_size' ) . catalyst_get_dynamik( 'blockquote_px_em' );
	$blockquote_font_color = catalyst_get_dynamik( 'blockquote_font_color' );
	$blockquote_link_color = catalyst_get_dynamik( 'blockquote_link_color' );
	$blockquote_link_hover_color = catalyst_get_dynamik( 'blockquote_link_hover_color' );
	
	if( catalyst_get_dynamik( 'blockquote_link_underline' ) == 'On Hover' )
	{
		$blockquote_link_underline_visited = 'none';
		$blockquote_link_underline_hover = 'underline';
	}
	elseif( catalyst_get_dynamik( 'blockquote_link_underline' ) == 'Off Hover' )
	{
		$blockquote_link_underline_visited = 'underline';
		$blockquote_link_underline_hover = 'none';
	}
	elseif( catalyst_get_dynamik( 'blockquote_link_underline' ) == 'Always' )
	{
		$blockquote_link_underline_visited = 'underline';
		$blockquote_link_underline_hover = 'underline';
	}
	else
	{
		$blockquote_link_underline_visited = 'none';
		$blockquote_link_underline_hover = 'none';
	}
	
	// Content Caption fonts
	$caption_font_type = $dynamik_font_type['caption'];
	$caption_font_size = catalyst_get_dynamik( 'caption_font_size' ) . catalyst_get_dynamik( 'caption_px_em' );
	$caption_font_color = catalyst_get_dynamik( 'caption_font_color' );
	
	// Post-Meta fonts
	$post_meta_font_type = $dynamik_font_type['post_meta'];
	$post_meta_font_size = catalyst_get_dynamik( 'post_meta_font_size' ) . catalyst_get_dynamik( 'post_meta_px_em' );
	$post_meta_font_color = catalyst_get_dynamik( 'post_meta_font_color' );
	$post_meta_link_color = catalyst_get_dynamik( 'post_meta_link_color' );
	$post_meta_link_hover_color = catalyst_get_dynamik( 'post_meta_link_hover_color' );
	
	if( catalyst_get_dynamik( 'post_meta_link_underline' ) == 'On Hover' )
	{
		$post_meta_link_underline_visited = 'none';
		$post_meta_link_underline_hover = 'underline';
	}
	elseif( catalyst_get_dynamik( 'post_meta_link_underline' ) == 'Off Hover' )
	{
		$post_meta_link_underline_visited = 'underline';
		$post_meta_link_underline_hover = 'none';
	}
	elseif( catalyst_get_dynamik( 'post_meta_link_underline' ) == 'Always' )
	{
		$post_meta_link_underline_visited = 'underline';
		$post_meta_link_underline_hover = 'underline';
	}
	else
	{
		$post_meta_link_underline_visited = 'none';
		$post_meta_link_underline_hover = 'none';
	}
	
	// EZ Widget Fonts
	$ez_widget_home_title_font_type = $dynamik_font_type['ez_widget_home_title'];
	$ez_widget_home_title_font_size = catalyst_get_dynamik( 'ez_widget_home_title_font_size' ) . catalyst_get_dynamik( 'ez_widget_home_title_px_em' );
	$ez_widget_home_title_font_color = catalyst_get_dynamik( 'ez_widget_home_title_font_color' );
	
	$ez_widget_home_content_font_type = $dynamik_font_type['ez_widget_home_content'];
	$ez_widget_home_content_font_size = catalyst_get_dynamik( 'ez_widget_home_content_font_size' ) . catalyst_get_dynamik( 'ez_widget_home_content_px_em' );
	$ez_widget_home_content_font_color = catalyst_get_dynamik( 'ez_widget_home_content_font_color' );
	$ez_widget_home_content_link_color = catalyst_get_dynamik( 'ez_widget_home_content_link_color' );
	$ez_widget_home_content_link_hover_color = catalyst_get_dynamik( 'ez_widget_home_content_link_hover_color' );
	
	if( catalyst_get_dynamik( 'ez_widget_home_content_link_underline' ) == 'On Hover' )
	{
		$ez_widget_home_content_link_underline_visited = 'none';
		$ez_widget_home_content_link_underline_hover = 'underline';
	}
	elseif( catalyst_get_dynamik( 'ez_widget_home_content_link_underline' ) == 'Off Hover' )
	{
		$ez_widget_home_content_link_underline_visited = 'underline';
		$ez_widget_home_content_link_underline_hover = 'none';
	}
	elseif( catalyst_get_dynamik( 'ez_widget_home_content_link_underline' ) == 'Always' )
	{
		$ez_widget_home_content_link_underline_visited = 'underline';
		$ez_widget_home_content_link_underline_hover = 'underline';
	}
	else
	{
		$ez_widget_home_content_link_underline_visited = 'none';
		$ez_widget_home_content_link_underline_hover = 'none';
	}
	
	$ez_widget_feature_title_font_type = $dynamik_font_type['ez_widget_feature_title'];
	$ez_widget_feature_title_font_size = catalyst_get_dynamik( 'ez_widget_feature_title_font_size' ) . catalyst_get_dynamik( 'ez_widget_feature_title_px_em' );
	$ez_widget_feature_title_font_color = catalyst_get_dynamik( 'ez_widget_feature_title_font_color' );
	
	$ez_widget_feature_content_font_type = $dynamik_font_type['ez_widget_feature_content'];
	$ez_widget_feature_content_font_size = catalyst_get_dynamik( 'ez_widget_feature_content_font_size' ) . catalyst_get_dynamik( 'ez_widget_feature_content_px_em' );
	$ez_widget_feature_content_font_color = catalyst_get_dynamik( 'ez_widget_feature_content_font_color' );
	$ez_widget_feature_content_link_color = catalyst_get_dynamik( 'ez_widget_feature_content_link_color' );
	$ez_widget_feature_content_link_hover_color = catalyst_get_dynamik( 'ez_widget_feature_content_link_hover_color' );
	
	if( catalyst_get_dynamik( 'ez_widget_feature_content_link_underline' ) == 'On Hover' )
	{
		$ez_widget_feature_content_link_underline_visited = 'none';
		$ez_widget_feature_content_link_underline_hover = 'underline';
	}
	elseif( catalyst_get_dynamik( 'ez_widget_feature_content_link_underline' ) == 'Off Hover' )
	{
		$ez_widget_feature_content_link_underline_visited = 'underline';
		$ez_widget_feature_content_link_underline_hover = 'none';
	}
	elseif( catalyst_get_dynamik( 'ez_widget_feature_content_link_underline' ) == 'Always' )
	{
		$ez_widget_feature_content_link_underline_visited = 'underline';
		$ez_widget_feature_content_link_underline_hover = 'underline';
	}
	else
	{
		$ez_widget_feature_content_link_underline_visited = 'none';
		$ez_widget_feature_content_link_underline_hover = 'none';
	}
	
	$ez_widget_footer_title_font_type = $dynamik_font_type['ez_widget_footer_title'];
	$ez_widget_footer_title_font_size = catalyst_get_dynamik( 'ez_widget_footer_title_font_size' ) . catalyst_get_dynamik( 'ez_widget_footer_title_px_em' );
	$ez_widget_footer_title_font_color = catalyst_get_dynamik( 'ez_widget_footer_title_font_color' );
	
	$ez_widget_footer_content_font_type = $dynamik_font_type['ez_widget_footer_content'];
	$ez_widget_footer_content_font_size = catalyst_get_dynamik( 'ez_widget_footer_content_font_size' ) . catalyst_get_dynamik( 'ez_widget_footer_content_px_em' );
	$ez_widget_footer_content_font_color = catalyst_get_dynamik( 'ez_widget_footer_content_font_color' );
	$ez_widget_footer_content_link_color = catalyst_get_dynamik( 'ez_widget_footer_content_link_color' );
	$ez_widget_footer_content_link_hover_color = catalyst_get_dynamik( 'ez_widget_footer_content_link_hover_color' );
	
	if( catalyst_get_dynamik( 'ez_widget_footer_content_link_underline' ) == 'On Hover' )
	{
		$ez_widget_footer_content_link_underline_visited = 'none';
		$ez_widget_footer_content_link_underline_hover = 'underline';
	}
	elseif( catalyst_get_dynamik( 'ez_widget_footer_content_link_underline' ) == 'Off Hover' )
	{
		$ez_widget_footer_content_link_underline_visited = 'underline';
		$ez_widget_footer_content_link_underline_hover = 'none';
	}
	elseif( catalyst_get_dynamik( 'ez_widget_footer_content_link_underline' ) == 'Always' )
	{
		$ez_widget_footer_content_link_underline_visited = 'underline';
		$ez_widget_footer_content_link_underline_hover = 'underline';
	}
	else
	{
		$ez_widget_footer_content_link_underline_visited = 'none';
		$ez_widget_footer_content_link_underline_hover = 'none';
	}
	
	// Catalyst Widget fonts
	$excerpt_widget_heading_font_type = $dynamik_font_type['excerpt_widget_heading'];
	$excerpt_widget_heading_font_size = catalyst_get_dynamik( 'excerpt_widget_heading_font_size' ) . catalyst_get_dynamik( 'excerpt_widget_heading_px_em' );
	$excerpt_widget_heading_link_color = catalyst_get_dynamik( 'excerpt_widget_heading_link_color' );
	$excerpt_widget_heading_link_hover_color = catalyst_get_dynamik( 'excerpt_widget_heading_link_hover_color' );
	
	if( catalyst_get_dynamik( 'excerpt_widget_heading_link_underline' ) == 'On Hover' )
	{
		$excerpt_widget_heading_link_underline_visited = 'none';
		$excerpt_widget_heading_link_underline_hover = 'underline';
	}
	elseif( catalyst_get_dynamik( 'excerpt_widget_heading_link_underline' ) == 'Off Hover' )
	{
		$excerpt_widget_heading_link_underline_visited = 'underline';
		$excerpt_widget_heading_link_underline_hover = 'none';
	}
	elseif( catalyst_get_dynamik( 'excerpt_widget_heading_link_underline' ) == 'Always' )
	{
		$excerpt_widget_heading_link_underline_visited = 'underline';
		$excerpt_widget_heading_link_underline_hover = 'underline';
	}
	else
	{
		$excerpt_widget_heading_link_underline_visited = 'none';
		$excerpt_widget_heading_link_underline_hover = 'none';
	}
	
	$excerpt_widget_p_font_type = $dynamik_font_type['excerpt_widget_p'];
	$excerpt_widget_p_font_size = catalyst_get_dynamik( 'excerpt_widget_p_font_size' ) . catalyst_get_dynamik( 'excerpt_widget_p_px_em' );
	$excerpt_widget_p_font_color = catalyst_get_dynamik( 'excerpt_widget_p_font_color' );
	$excerpt_widget_p_link_color = catalyst_get_dynamik( 'excerpt_widget_p_link_color' );
	$excerpt_widget_p_link_hover_color = catalyst_get_dynamik( 'excerpt_widget_p_link_hover_color' );
	
	if( catalyst_get_dynamik( 'excerpt_widget_p_link_underline' ) == 'On Hover' )
	{
		$excerpt_widget_p_link_underline_visited = 'none';
		$excerpt_widget_p_link_underline_hover = 'underline';
	}
	elseif( catalyst_get_dynamik( 'excerpt_widget_p_link_underline' ) == 'Off Hover' )
	{
		$excerpt_widget_p_link_underline_visited = 'underline';
		$excerpt_widget_p_link_underline_hover = 'none';
	}
	elseif( catalyst_get_dynamik( 'excerpt_widget_p_link_underline' ) == 'Always' )
	{
		$excerpt_widget_p_link_underline_visited = 'underline';
		$excerpt_widget_p_link_underline_hover = 'underline';
	}
	else
	{
		$excerpt_widget_p_link_underline_visited = 'none';
		$excerpt_widget_p_link_underline_hover = 'none';
	}
	
	$excerpt_widget_byline_font_type = $dynamik_font_type['excerpt_widget_byline'];
	$excerpt_widget_byline_font_size = catalyst_get_dynamik( 'excerpt_widget_byline_font_size' ) . catalyst_get_dynamik( 'excerpt_widget_byline_px_em' );
	$excerpt_widget_byline_font_color = catalyst_get_dynamik( 'excerpt_widget_byline_font_color' );
	$excerpt_widget_byline_link_color = catalyst_get_dynamik( 'excerpt_widget_byline_link_color' );
	$excerpt_widget_byline_link_hover_color = catalyst_get_dynamik( 'excerpt_widget_byline_link_hover_color' );
	
	if( catalyst_get_dynamik( 'excerpt_widget_byline_link_underline' ) == 'On Hover' )
	{
		$excerpt_widget_byline_link_underline_visited = 'none';
		$excerpt_widget_byline_link_underline_hover = 'underline';
	}
	elseif( catalyst_get_dynamik( 'excerpt_widget_byline_link_underline' ) == 'Off Hover' )
	{
		$excerpt_widget_byline_link_underline_visited = 'underline';
		$excerpt_widget_byline_link_underline_hover = 'none';
	}
	elseif( catalyst_get_dynamik( 'excerpt_widget_byline_link_underline' ) == 'Always' )
	{
		$excerpt_widget_byline_link_underline_visited = 'underline';
		$excerpt_widget_byline_link_underline_hover = 'underline';
	}
	else
	{
		$excerpt_widget_byline_link_underline_visited = 'none';
		$excerpt_widget_byline_link_underline_hover = 'none';
	}
	
	$catalyst_widget_title_font_type = $dynamik_font_type['catalyst_widget_title'];
	$catalyst_widget_title_font_size = catalyst_get_dynamik( 'catalyst_widget_title_font_size' ) . catalyst_get_dynamik( 'catalyst_widget_title_px_em' );
	$catalyst_widget_title_font_color = catalyst_get_dynamik( 'catalyst_widget_title_font_color' );
	
	$catalyst_widget_content_font_type = $dynamik_font_type['catalyst_widget_content'];
	$catalyst_widget_content_font_size = catalyst_get_dynamik( 'catalyst_widget_content_font_size' ) . catalyst_get_dynamik( 'catalyst_widget_content_px_em' );
	$catalyst_widget_content_font_color = catalyst_get_dynamik( 'catalyst_widget_content_font_color' );
	$catalyst_widget_content_link_color = catalyst_get_dynamik( 'catalyst_widget_content_link_color' );
	$catalyst_widget_content_link_hover_color = catalyst_get_dynamik( 'catalyst_widget_content_link_hover_color' );
	
	if( catalyst_get_dynamik( 'catalyst_widget_content_link_underline' ) == 'On Hover' )
	{
		$catalyst_widget_content_link_underline_visited = 'none';
		$catalyst_widget_content_link_underline_hover = 'underline';
	}
	elseif( catalyst_get_dynamik( 'catalyst_widget_content_link_underline' ) == 'Off Hover' )
	{
		$catalyst_widget_content_link_underline_visited = 'underline';
		$catalyst_widget_content_link_underline_hover = 'none';
	}
	elseif( catalyst_get_dynamik( 'catalyst_widget_content_link_underline' ) == 'Always' )
	{
		$catalyst_widget_content_link_underline_visited = 'underline';
		$catalyst_widget_content_link_underline_hover = 'underline';
	}
	else
	{
		$catalyst_widget_content_link_underline_visited = 'none';
		$catalyst_widget_content_link_underline_hover = 'none';
	}
	
	// Comment fonts
	$comment_heading_font_type = $dynamik_font_type['comment_heading'];
	$comment_heading_font_size = catalyst_get_dynamik( 'comment_heading_font_size' ) . catalyst_get_dynamik( 'comment_heading_px_em' );
	$comment_heading_font_color = catalyst_get_dynamik( 'comment_heading_font_color' );
	$comment_heading_font_css = catalyst_get_dynamik( 'comment_heading_font_css' );
	
	$comment_author_font_type = $dynamik_font_type['comment_author'];
	$comment_author_font_size = catalyst_get_dynamik( 'comment_author_font_size' ) . catalyst_get_dynamik( 'comment_author_px_em' );
	$comment_author_font_color = catalyst_get_dynamik( 'comment_author_font_color' );
	$comment_author_font_css = catalyst_get_dynamik( 'comment_author_font_css' );
	
	$comment_meta_font_type = $dynamik_font_type['comment_meta'];
	$comment_meta_font_size = catalyst_get_dynamik( 'comment_meta_font_size' ) . catalyst_get_dynamik( 'comment_meta_px_em' );
	$comment_meta_link_color = catalyst_get_dynamik( 'comment_meta_link_color' );
	$comment_meta_link_hover_color = catalyst_get_dynamik( 'comment_meta_link_hover_color' );
	$comment_meta_font_css = catalyst_get_dynamik( 'comment_meta_font_css' );
	
	if( catalyst_get_dynamik( 'comment_meta_link_underline' ) == 'On Hover' )
	{
		$comment_meta_link_underline_visited = 'none';
		$comment_meta_link_underline_hover = 'underline';
	}
	elseif( catalyst_get_dynamik( 'comment_meta_link_underline' ) == 'Off Hover' )
	{
		$comment_meta_link_underline_visited = 'underline';
		$comment_meta_link_underline_hover = 'none';
	}
	elseif( catalyst_get_dynamik( 'comment_meta_link_underline' ) == 'Always' )
	{
		$comment_meta_link_underline_visited = 'underline';
		$comment_meta_link_underline_hover = 'underline';
	}
	else
	{
		$comment_meta_link_underline_visited = 'none';
		$comment_meta_link_underline_hover = 'none';
	}
	
	$comment_body_font_type = $dynamik_font_type['comment_body'];
	$comment_body_font_size = catalyst_get_dynamik( 'comment_body_font_size' ) . catalyst_get_dynamik( 'comment_body_px_em' );
	$comment_body_font_color = catalyst_get_dynamik( 'comment_body_font_color' );
	$comment_body_font_css = catalyst_get_dynamik( 'comment_body_font_css' );
	
	$comment_form_font_type = $dynamik_font_type['comment_form'];
	$comment_form_font_size = catalyst_get_dynamik( 'comment_form_font_size' ) . catalyst_get_dynamik( 'comment_form_px_em' );
	$comment_form_font_color = catalyst_get_dynamik( 'comment_form_font_color' );
	$comment_form_font_css = catalyst_get_dynamik( 'comment_form_font_css' );
	
	$comment_link_color = catalyst_get_dynamik( 'comment_link_color' );
	$comment_link_hover_color = catalyst_get_dynamik( 'comment_link_hover_color' );
	
	if( catalyst_get_dynamik( 'comment_link_underline' ) == 'On Hover' )
	{
		$comment_link_underline_visited = 'none';
		$comment_link_underline_hover = 'underline';
	}
	elseif( catalyst_get_dynamik( 'comment_link_underline' ) == 'Off Hover' )
	{
		$comment_link_underline_visited = 'underline';
		$comment_link_underline_hover = 'none';
	}
	elseif( catalyst_get_dynamik( 'comment_link_underline' ) == 'Always' )
	{
		$comment_link_underline_visited = 'underline';
		$comment_link_underline_hover = 'underline';
	}
	else
	{
		$comment_link_underline_visited = 'none';
		$comment_link_underline_hover = 'none';
	}
	
	$comment_submit_font_type = $dynamik_font_type['comment_submit'];
	$comment_submit_font_size = catalyst_get_dynamik( 'comment_submit_font_size' ) . catalyst_get_dynamik( 'comment_submit_px_em' );
	$comment_submit_font_color = catalyst_get_dynamik( 'comment_submit_font_color' );
	$comment_submit_font_css = catalyst_get_dynamik( 'comment_submit_font_css' );

	$submit_text_hover_color = catalyst_get_dynamik( 'submit_text_hover_color' );
	
	if( catalyst_get_dynamik( 'submit_text_hover_underline' ) == 'On Hover' )
	{
		$submit_link_underline_visited = 'none';
		$submit_link_underline_hover = 'underline';
	}
	elseif( catalyst_get_dynamik( 'submit_text_hover_underline' ) == 'Off Hover' )
	{
		$submit_link_underline_visited = 'underline';
		$submit_link_underline_hover = 'none';
	}
	elseif( catalyst_get_dynamik( 'submit_text_hover_underline' ) == 'Always' )
	{
		$submit_link_underline_visited = 'underline';
		$submit_link_underline_hover = 'underline';
	}
	else
	{
		$submit_link_underline_visited = 'none';
		$submit_link_underline_hover = 'none';
	}
	
	// Footer fonts
	$footer_font_type = $dynamik_font_type['footer'];
	$footer_font_size = catalyst_get_dynamik( 'footer_font_size' ) . catalyst_get_dynamik( 'footer_px_em' );
	$footer_font_color = catalyst_get_dynamik( 'footer_font_color' );
	$footer_link_color = catalyst_get_dynamik( 'footer_link_color' );
	$footer_link_hover_color = catalyst_get_dynamik( 'footer_link_hover_color' );
	
	if( catalyst_get_dynamik( 'footer_link_underline' ) == 'On Hover' )
	{
		$footer_link_underline_visited = 'none';
		$footer_link_underline_hover = 'underline';
	}
	elseif( catalyst_get_dynamik( 'footer_link_underline' ) == 'Off Hover' )
	{
		$footer_link_underline_visited = 'underline';
		$footer_link_underline_hover = 'none';
	}
	elseif( catalyst_get_dynamik( 'footer_link_underline' ) == 'Always' )
	{
		$footer_link_underline_visited = 'underline';
		$footer_link_underline_hover = 'underline';
	}
	else
	{
		$footer_link_underline_visited = 'none';
		$footer_link_underline_hover = 'none';
	}
	
	// Search Form fonts
	$search_form_font_type = $dynamik_font_type['search_form'];
	$search_form_font_size = catalyst_get_dynamik( 'search_form_font_size' ) . catalyst_get_dynamik( 'search_form_px_em' );
	$search_form_font_color = catalyst_get_dynamik( 'search_form_font_color' );
	
	$search_button_font_type = $dynamik_font_type['search_button'];
	$search_button_font_size = catalyst_get_dynamik( 'search_button_font_size' ) . catalyst_get_dynamik( 'search_button_px_em' );
	$search_button_font_color = catalyst_get_dynamik( 'search_button_font_color' );
		
	/****************************************
			Define Misc Styles
	****************************************/
	
	// Navbar 1 dimensions
	$nav1_page_top_border_thickness = catalyst_get_dynamik( 'nav1_page_top_border_thickness' );
	$nav1_page_bottom_border_thickness = catalyst_get_dynamik( 'nav1_page_bottom_border_thickness' );
	$nav1_page_left_border_thickness = catalyst_get_dynamik( 'nav1_page_left_border_thickness' );
	$nav1_page_right_border_thickness = catalyst_get_dynamik( 'nav1_page_right_border_thickness' );
	
	$nav1_right_text_padding_top = catalyst_get_dynamik( 'nav1_right_text_padding_top' );
	$nav1_right_text_padding_right = catalyst_get_dynamik( 'nav1_right_text_padding_right' );
	$nav1_right_search_padding_top = catalyst_get_dynamik( 'nav1_right_search_padding_top' );
	$nav1_right_search_padding_right = catalyst_get_dynamik( 'nav1_right_search_padding_right' );
	
	$nav1_submenu_width = catalyst_get_dynamik( 'nav1_submenu_width' );
	$nav1_submenu_tb_padding = catalyst_get_dynamik( 'nav1_submenu_tb_padding' );
	$nav1_submenu_lr_padding = catalyst_get_dynamik( 'nav1_submenu_lr_padding' );
	
	$nav1_wrap_top_margin = catalyst_get_dynamik( 'nav1_wrap_top_margin' );
	$nav1_wrap_bottom_margin = catalyst_get_dynamik( 'nav1_wrap_bottom_margin' );
	
	$nav1_page_left_margin = catalyst_get_dynamik( 'nav1_page_left_margin' );
	$nav1_page_right_margin = catalyst_get_dynamik( 'nav1_page_right_margin' );
	$nav1_page_tb_padding = catalyst_get_dynamik( 'nav1_page_tb_padding' );
	$nav1_page_lr_padding = catalyst_get_dynamik( 'nav1_page_lr_padding' );
	
	$nav1_sf_right_padding = $nav1_page_lr_padding + 10;
	
	$nav1_page_tb_border_thickness_combined = $nav1_page_top_border_thickness + $nav1_page_bottom_border_thickness;
	$nav1_page_tb_padding_combined = $nav1_page_tb_padding * 2;
	$nav1_submenu_lr_padding_combined = $nav1_submenu_lr_padding * 2;
	$nav1_submenu_tb_padding_combined = $nav1_submenu_tb_padding * 2;
	
	$nav1_submenu_width_plus = $nav1_submenu_width + $nav1_submenu_lr_padding_combined + $nav1_page_left_margin + 5;

	$nav1_wrap_height = $nav1_font_size_px + $nav1_page_tb_padding_combined + $nav1_page_tb_border_thickness_combined;
	$nav1_liulul_left_margin = $nav1_submenu_width + $nav1_submenu_lr_padding_combined + 1;
	$nav1_liulul_top_margin = ($nav1_font_size_px + $nav1_submenu_tb_padding_combined + 1) * -1;
	
	$nav1_sub_indicator_type = catalyst_get_dynamik( 'nav1_sub_indicator_type' );
	$nav1_sub_indicator_image = catalyst_get_dynamik( 'nav1_sub_indicator_image' );
	$nav1_sub_indicator_width = catalyst_get_dynamik( 'nav1_sub_indicator_width' );
	$nav1_sub_indicator_height = catalyst_get_dynamik( 'nav1_sub_indicator_height' );
	$nav1_sub_indicator_top = catalyst_get_dynamik( 'nav1_sub_indicator_top' );
	$nav1_sub_indicator_right = catalyst_get_dynamik( 'nav1_sub_indicator_right' );
	
	if( $nav1_sub_indicator_type == 'Text' )
	{
		$nav1_sub_indicator_styles = '#nav-1 li a .sf-sub-indicator {
	top: ' . $nav1_page_tb_padding . 'px;
	right: ' . $nav1_page_lr_padding . 'px;
	position: absolute;
	float: right;
	display: block;
	overflow: hidden;
}
#nav-1 li li a .sf-sub-indicator {
	top: ' . $nav1_submenu_tb_padding . 'px;
	right: ' . $nav1_submenu_lr_padding . 'px;
}';
	}
	else
	{
		$nav1_sub_indicator_styles = '#nav-1 li a .sf-sub-indicator,
#nav-1 li li a .sf-sub-indicator,
#nav-1 li li li a .sf-sub-indicator {
	background: url(' . $image_dir . $nav1_sub_indicator_image . ') no-repeat;
	width: ' . $nav1_sub_indicator_width . 'px;
	height: ' . $nav1_sub_indicator_height . 'px;
	top: ' . $nav1_sub_indicator_top . 'px;
	right: ' . $nav1_sub_indicator_right . 'px;
	position: absolute;
	text-indent: -9999px;
}';
	}
	
	// Navbar 2 dimensions
	$nav2_page_top_border_thickness = catalyst_get_dynamik( 'nav2_page_top_border_thickness' );
	$nav2_page_bottom_border_thickness = catalyst_get_dynamik( 'nav2_page_bottom_border_thickness' );
	$nav2_page_left_border_thickness = catalyst_get_dynamik( 'nav2_page_left_border_thickness' );
	$nav2_page_right_border_thickness = catalyst_get_dynamik( 'nav2_page_right_border_thickness' );
	
	$nav2_right_text_padding_top = catalyst_get_dynamik( 'nav2_right_text_padding_top' );
	$nav2_right_text_padding_right = catalyst_get_dynamik( 'nav2_right_text_padding_right' );
	$nav2_right_search_padding_top = catalyst_get_dynamik( 'nav2_right_search_padding_top' );
	$nav2_right_search_padding_right = catalyst_get_dynamik( 'nav2_right_search_padding_right' );
	
	$nav2_submenu_width = catalyst_get_dynamik( 'nav2_submenu_width' );
	$nav2_submenu_tb_padding = catalyst_get_dynamik( 'nav2_submenu_tb_padding' );
	$nav2_submenu_lr_padding = catalyst_get_dynamik( 'nav2_submenu_lr_padding' );
	
	$nav2_wrap_top_margin = catalyst_get_dynamik( 'nav2_wrap_top_margin' );
	$nav2_wrap_bottom_margin = catalyst_get_dynamik( 'nav2_wrap_bottom_margin' );
	
	$nav2_page_left_margin = catalyst_get_dynamik( 'nav2_page_left_margin' );
	$nav2_page_right_margin = catalyst_get_dynamik( 'nav2_page_right_margin' );
	$nav2_page_tb_padding = catalyst_get_dynamik( 'nav2_page_tb_padding' );
	$nav2_page_lr_padding = catalyst_get_dynamik( 'nav2_page_lr_padding' );
	
	$nav2_sf_right_padding = $nav2_page_lr_padding + 10;
	
	$nav2_page_tb_border_thickness_combined = $nav2_page_top_border_thickness + $nav2_page_bottom_border_thickness;
	$nav2_page_tb_padding_combined = $nav2_page_tb_padding * 2;
	$nav2_submenu_lr_padding_combined = $nav2_submenu_lr_padding * 2;
	$nav2_submenu_tb_padding_combined = $nav2_submenu_tb_padding * 2;
	
	$nav2_submenu_width_plus = $nav2_submenu_width + $nav2_submenu_lr_padding_combined + $nav2_page_left_margin + 5;

	$nav2_wrap_height = $nav2_font_size_px + $nav2_page_tb_padding_combined + $nav2_page_tb_border_thickness_combined;
	$nav2_liulul_left_margin = $nav2_submenu_width + $nav2_submenu_lr_padding_combined + 1;
	$nav2_liulul_top_margin = ($nav2_font_size_px + $nav2_submenu_tb_padding_combined + 1) * -1;
	
	$nav2_sub_indicator_type = catalyst_get_dynamik( 'nav2_sub_indicator_type' );
	$nav2_sub_indicator_image = catalyst_get_dynamik( 'nav2_sub_indicator_image' );
	$nav2_sub_indicator_width = catalyst_get_dynamik( 'nav2_sub_indicator_width' );
	$nav2_sub_indicator_height = catalyst_get_dynamik( 'nav2_sub_indicator_height' );
	$nav2_sub_indicator_top = catalyst_get_dynamik( 'nav2_sub_indicator_top' );
	$nav2_sub_indicator_right = catalyst_get_dynamik( 'nav2_sub_indicator_right' );
	
	if( $nav2_sub_indicator_type == 'Text' )
	{
		$nav2_sub_indicator_styles = '#nav-2 li a .sf-sub-indicator {
	top: ' . $nav2_page_tb_padding . 'px;
	right: ' . $nav2_page_lr_padding . 'px;
	position: absolute;
	float: right;
	display: block;
	overflow: hidden;
}
#nav-2 li li a .sf-sub-indicator {
	top: ' . $nav2_submenu_tb_padding . 'px;
	right: ' . $nav2_submenu_lr_padding . 'px;
}';
	}
	else
	{
		$nav2_sub_indicator_styles = '#nav-2 li a .sf-sub-indicator,
#nav-2 li li a .sf-sub-indicator,
#nav-2 li li li a .sf-sub-indicator {
	background: url(' . $image_dir . $nav2_sub_indicator_image . ') no-repeat;
	width: ' . $nav2_sub_indicator_width . 'px;
	height: ' . $nav2_sub_indicator_height . 'px;
	top: ' . $nav2_sub_indicator_top . 'px;
	right: ' . $nav2_sub_indicator_right . 'px;
	position: absolute;
	text-indent: -9999px;
}';
	}
	
	// Create custom font styles
	$universal_font_css = '';
	if( catalyst_get_dynamik( 'universal_font_css' ) )
	{
		$universal_font_css = catalyst_get_dynamik( 'universal_font_css' );
	}
	
	$body_font_css = '';
	if( catalyst_get_dynamik( 'body_font_css' ) && empty( $universal_font_css ) )
	{
		$body_font_css = catalyst_get_dynamik( 'body_font_css' );
	}
	
	$title_font_css = '';
	if( catalyst_get_dynamik( 'title_font_css' ) )
	{
		$title_font_css = catalyst_get_dynamik( 'title_font_css' );
	}
	
	$tagline_font_css = '';
	if( catalyst_get_dynamik( 'tagline_font_css' ) )
	{
		$tagline_font_css = catalyst_get_dynamik( 'tagline_font_css' );
	}
	
	$nav1_font_css = '';
	if( catalyst_get_dynamik( 'nav1_font_css' ) )
	{
		$nav1_font_css = catalyst_get_dynamik( 'nav1_font_css' );
	}
	
	$nav1_right_font_css = '';
	if( catalyst_get_dynamik( 'nav1_right_font_css' ) )
	{
		$nav1_right_font_css = catalyst_get_dynamik( 'nav1_right_font_css' );
	}
	
	$nav2_font_css = '';
	if( catalyst_get_dynamik( 'nav2_font_css' ) )
	{
		$nav2_font_css = catalyst_get_dynamik( 'nav2_font_css' );
	}
	
	$nav2_right_font_css = '';
	if( catalyst_get_dynamik( 'nav2_right_font_css' ) )
	{
		$nav2_right_font_css = catalyst_get_dynamik( 'nav2_right_font_css' );
	}
	
	$content_heading_font_css = '';
	if( catalyst_get_dynamik( 'content_heading_font_css' ) )
	{
		$content_heading_font_css = catalyst_get_dynamik( 'content_heading_font_css' );
	}
	
	$content_byline_font_css = '';
	if( catalyst_get_dynamik( 'content_byline_font_css' ) )
	{
		$content_byline_font_css = catalyst_get_dynamik( 'content_byline_font_css' );
	}
	
	$content_p_font_css = '';
	if( catalyst_get_dynamik( 'content_p_font_css' ) )
	{
		$content_p_font_css = catalyst_get_dynamik( 'content_p_font_css' );
	}
	
	$breadcrumbs_font_css = '';
	if( catalyst_get_dynamik( 'breadcrumbs_font_css' ) )
	{
		$breadcrumbs_font_css = catalyst_get_dynamik( 'breadcrumbs_font_css' );
	}
	
	$author_info_title_font_css = '';
	if( catalyst_get_dynamik( 'author_info_title_font_css' ) )
	{
		$author_info_title_font_css = catalyst_get_dynamik( 'author_info_title_font_css' );
	}
	
	$author_info_font_css = '';
	if( catalyst_get_dynamik( 'author_info_font_css' ) )
	{
		$author_info_font_css = catalyst_get_dynamik( 'author_info_font_css' );
	}
	
	$post_nav_font_css = '';
	if( catalyst_get_dynamik( 'post_nav_font_css' ) )
	{
		$post_nav_font_css = catalyst_get_dynamik( 'post_nav_font_css' );
	}
	
	$blockquote_font_css = '';
	if( catalyst_get_dynamik( 'blockquote_font_css' ) )
	{
		$blockquote_font_css = catalyst_get_dynamik( 'blockquote_font_css' );
	}
	
	$caption_font_css = '';
	if( catalyst_get_dynamik( 'caption_font_css' ) )
	{
		$caption_font_css = catalyst_get_dynamik( 'caption_font_css' );
	}
	
	$post_meta_font_css = '';
	if( catalyst_get_dynamik( 'post_meta_font_css' ) )
	{
		$post_meta_font_css = catalyst_get_dynamik( 'post_meta_font_css' );
	}
	
	$ez_widget_home_title_font_css = '';
	if( catalyst_get_dynamik( 'ez_widget_home_title_font_css' ) )
	{
		$ez_widget_home_title_font_css = catalyst_get_dynamik( 'ez_widget_home_title_font_css' );
	}
	
	$ez_widget_home_content_font_css = '';
	if( catalyst_get_dynamik( 'ez_widget_home_content_font_css' ) )
	{
		$ez_widget_home_content_font_css = catalyst_get_dynamik( 'ez_widget_home_content_font_css' );
	}
	
	$ez_widget_feature_title_font_css = '';
	if( catalyst_get_dynamik( 'ez_widget_feature_title_font_css' ) )
	{
		$ez_widget_feature_title_font_css = catalyst_get_dynamik( 'ez_widget_feature_title_font_css' );
	}
	
	$ez_widget_feature_content_font_css = '';
	if( catalyst_get_dynamik( 'ez_widget_feature_content_font_css' ) )
	{
		$ez_widget_feature_content_font_css = catalyst_get_dynamik( 'ez_widget_feature_content_font_css' );
	}
	
	$ez_widget_footer_title_font_css = '';
	if( catalyst_get_dynamik( 'ez_widget_footer_title_font_css' ) )
	{
		$ez_widget_footer_title_font_css = catalyst_get_dynamik( 'ez_widget_footer_title_font_css' );
	}
	
	$ez_widget_footer_content_font_css = '';
	if( catalyst_get_dynamik( 'ez_widget_footer_content_font_css' ) )
	{
		$ez_widget_footer_content_font_css = catalyst_get_dynamik( 'ez_widget_footer_content_font_css' );
	}
	
	$excerpt_widget_heading_font_css = '';
	if( catalyst_get_dynamik( 'excerpt_widget_heading_font_css' ) )
	{
		$excerpt_widget_heading_font_css = catalyst_get_dynamik( 'excerpt_widget_heading_font_css' );
	}
	
	$excerpt_widget_p_font_css = '';
	if( catalyst_get_dynamik( 'excerpt_widget_p_font_css' ) )
	{
		$excerpt_widget_p_font_css = catalyst_get_dynamik( 'excerpt_widget_p_font_css' );
	}
	
	$excerpt_widget_byline_font_css = '';
	if( catalyst_get_dynamik( 'excerpt_widget_byline_font_css' ) )
	{
		$excerpt_widget_byline_font_css = catalyst_get_dynamik( 'excerpt_widget_byline_font_css' );
	}
	
	$catalyst_widget_title_font_css = '';
	if( catalyst_get_dynamik( 'catalyst_widget_title_font_css' ) )
	{
		$catalyst_widget_title_font_css = catalyst_get_dynamik( 'catalyst_widget_title_font_css' );
	}
	
	$catalyst_widget_content_font_css = '';
	if( catalyst_get_dynamik( 'catalyst_widget_content_font_css' ) )
	{
		$catalyst_widget_content_font_css = catalyst_get_dynamik( 'catalyst_widget_content_font_css' );
	}
	
	$sb_heading_font_css = '';
	if( catalyst_get_dynamik( 'sb_heading_font_css' ) )
	{
		$sb_heading_font_css = catalyst_get_dynamik( 'sb_heading_font_css' );
	}
	
	$sb_content_font_css = '';
	if( catalyst_get_dynamik( 'sb_content_font_css' ) )
	{
		$sb_content_font_css = catalyst_get_dynamik( 'sb_content_font_css' );
	}
	
	$sb_pages_font_css = '';
	if( catalyst_get_dynamik( 'sb_pages_font_css' ) )
	{
		$sb_pages_font_css = catalyst_get_dynamik( 'sb_pages_font_css' );
	}
	
	$comment_heading_font_css = '';
	if( catalyst_get_dynamik( 'comment_heading_font_css' ) )
	{
		$comment_heading_font_css = catalyst_get_dynamik( 'comment_heading_font_css' );
	}
	
	$comment_author_font_css = '';
	if( catalyst_get_dynamik( 'comment_author_font_css' ) )
	{
		$comment_author_font_css = catalyst_get_dynamik( 'comment_author_font_css' );
	}
	
	$comment_meta_font_css = '';
	if( catalyst_get_dynamik( 'comment_meta_font_css' ) )
	{
		$comment_meta_font_css = catalyst_get_dynamik( 'comment_meta_font_css' );
	}
	
	$comment_body_font_css = '';
	if( catalyst_get_dynamik( 'comment_body_font_css' ) )
	{
		$comment_body_font_css = catalyst_get_dynamik( 'comment_body_font_css' );
	}
	
	$comment_form_font_css = '';
	if( catalyst_get_dynamik( 'comment_form_font_css' ) )
	{
		$comment_form_font_css = catalyst_get_dynamik( 'comment_form_font_css' );
	}
	
	$comment_submit_font_css = '';
	if( catalyst_get_dynamik( 'comment_submit_font_css' ) )
	{
		$comment_submit_font_css = catalyst_get_dynamik( 'comment_submit_font_css' );
	}
	
	$footer_font_css = '';
	if( catalyst_get_dynamik( 'footer_font_css' ) )
	{
		$footer_font_css = catalyst_get_dynamik( 'footer_font_css' );
	}
	
	$search_form_font_css = '';
	if( catalyst_get_dynamik( 'search_form_font_css' ) )
	{
		$search_form_font_css = catalyst_get_dynamik( 'search_form_font_css' );
	}
	
	$search_button_font_css = '';
	if( catalyst_get_dynamik( 'search_button_font_css' ) )
	{
		$search_button_font_css = catalyst_get_dynamik( 'search_button_font_css' );
	}
	
	//** List Styles **//
	
	$content_list_style = catalyst_get_dynamik( 'content_list_style' );
	
	if( $content_list_style != "none" )
		$content_list_style_left_margin = 20;
	else
		$content_list_style_left_margin = 10;
	
	$sb_list_style = catalyst_get_dynamik( 'sb_list_style' );
	
	//** Remove Elements Styles **//
	
	$remove_elements = catalyst_get_dynamik( 'remove_elements' );
	
	if( $remove_elements != '' )
	{
		$remove_elements_css = ' { display: none !important; }';
	}
	else
	{
		$remove_elements_css = '';
	}
	
	//** Media Query Default Styles **//
	
	if( catalyst_get_responsive( 'wrap_media_query_default' ) == 'default' )
	{
		$wrap_mq_first = '#wrap { margin: 0 auto; border: 0; -webkit-border-radius: 0; border-radius: 0; -webkit-box-shadow: none; box-shadow: none; }' . "\n";
	}
	else
	{
		$wrap_mq_first = '';
	}
	
	$header_left_mq_height = $catalyst_dimensions['header_height'] - $catalyst_dimensions['text_logo_top_padding'];
	
	if( catalyst_get_responsive( 'header_media_query_default' ) == 'default' )
	{
		$header_mq_first = '#header { height: auto; }' . "\n";
		$header_mq_first .= '#header-left { height: ' . $header_left_mq_height . 'px; padding-left: 0; text-align: center; float: none; }' . "\n";
		$header_mq_first .= '#header-left, #header-right { max-width: none; width: 100%; }' . "\n";
		$header_mq_first .= '#header-right { padding: 0; }' . "\n";
		$header_mq_first .= '.logo-image #header #header-left { margin: 0 auto; float: none; }' . "\n";
	}
	else
	{
		$header_mq_first = '';
	}
	
	if( catalyst_get_responsive( 'navbar_media_query_default' ) == 'default' )
	{
		$navbar_mq_first = '#navbar-1-wrap, #navbar-2-wrap { height: auto; }' . "\n";
		$navbar_mq_first .= '#navbar-1-left, #navbar-2-left { width: 100%; }' . "\n";
		$navbar_mq_first .= '#navbar-1-right, #navbar-2-right { display: none; }' . "\n";
		$navbar_mq_first .= 'ul#nav-1, ul#nav-2 { float: none; text-align: center; }' . "\n";
		$navbar_mq_first .= '#nav-1 li, #nav-2 li { display: inline-block; float: none; }' . "\n";
		$navbar_mq_first .= '#nav-1 li li, #nav-2 li li { text-align: left; }' . "\n";
		$navbar_mq_sixth = '';
	}
	elseif( catalyst_get_responsive( 'navbar_media_query_default' ) == 'vertical' )
	{
		$navbar_mq_first = '#navbar-1-wrap, #navbar-2-wrap { height: auto; }' . "\n";
		$navbar_mq_first .= '#navbar-1-left, #navbar-2-left { width: 100%; }' . "\n";
		$navbar_mq_first .= '#navbar-1-right, #navbar-2-right { display: none; }' . "\n";
		$navbar_mq_first .= 'ul#nav-1, ul#nav-2 { float: none; text-align: center; }' . "\n";
		$navbar_mq_first .= '#nav-1 li, #nav-2 li { display: inline-block; float: none; }' . "\n";
		$navbar_mq_first .= '#nav-1 li li, #nav-2 li li { text-align: left; }' . "\n";
		$navbar_mq_sixth = '#navbar-1-wrap, #navbar-2-wrap { height: 100%; border-bottom: 0; }' . "\n";
		$navbar_mq_sixth .= '#navbar-1, #navbar-2, #navbar-1-left, #navbar-2-left, #nav-1 li, #nav-2 li, #nav-1 li ul, #nav-2 li ul { width: 100%; }' . "\n";
		$navbar_mq_sixth .= '#nav-1 li ul, #nav-2 li ul { display: block; visibility: visible; height: 100%; left: 0; position: relative; }' . "\n";
		$navbar_mq_sixth .= '#nav-1 li a, #nav-1 li a:link, #nav-1 li a:visited { border-right: 0 !important; border-bottom: ' . $nav1_bottom_border_thickness . 'px ' . $nav1_border_style . ' #' . $nav1_border_color . '; }' . "\n";
		$navbar_mq_sixth .= '#nav-2 li a, #nav-2 li a:link, #nav-2 li a:visited { border-right: 0 !important; border-bottom: ' . $nav2_bottom_border_thickness . 'px ' . $nav2_border_style . ' #' . $nav2_border_color . '; }' . "\n";
		$navbar_mq_sixth .= '#nav-1 li li, #nav-2 li li { text-align: center; }' . "\n";
		$navbar_mq_sixth .= '#nav-1 li li a, #nav-1 li li a:link, #nav-1 li li a:visited, #nav-2 li li a, #nav-2 li li a:link, #nav-2 li li a:visited { width: auto; }' . "\n";
		$navbar_mq_sixth .= '#nav-1 li ul ul, #nav-2 li ul ul { margin: 0; }' . "\n";
	}
	elseif( catalyst_get_responsive( 'navbar_media_query_default' ) == 'tablet_dropdown' )
	{
		$navbar_mq_first = '#navbar-1-wrap, #navbar-2-wrap { display: none; }' . "\n";
		$navbar_mq_first .= '#dropdown-nav-1-wrap, #dropdown-nav-2-wrap { padding: 0 ' . $catalyst_dimensions['container_wrap_lr_padding'] . 'px 0 ' . $catalyst_dimensions['container_wrap_lr_padding'] . 'px; display: block; }' . "\n";
		$navbar_mq_sixth = '';
	}
	elseif( catalyst_get_responsive( 'navbar_media_query_default' ) == 'mobile_dropdown' )
	{
		$navbar_mq_first = '#navbar-1-wrap, #navbar-2-wrap { height: auto; }' . "\n";
		$navbar_mq_first .= '#navbar-1-left, #navbar-2-left { width: 100%; }' . "\n";
		$navbar_mq_first .= '#navbar-1-right, #navbar-2-right { display: none; }' . "\n";
		$navbar_mq_first .= 'ul#nav-1, ul#nav-2 { float: none; text-align: center; }' . "\n";
		$navbar_mq_first .= '#nav-1 li, #nav-2 li { display: inline-block; float: none; }' . "\n";
		$navbar_mq_first .= '#nav-1 li li, #nav-2 li li { text-align: left; }' . "\n";
		$navbar_mq_sixth = '#navbar-1-wrap, #navbar-2-wrap { display: none; }' . "\n";
		$navbar_mq_sixth .= '#dropdown-nav-1-wrap, #dropdown-nav-2-wrap { padding: 0 ' . $catalyst_dimensions['container_wrap_lr_padding'] . 'px 0 ' . $catalyst_dimensions['container_wrap_lr_padding'] . 'px; display: block; }' . "\n";
	}
	else
	{
		$navbar_mq_first = '';
		$navbar_mq_sixth = '';
	}
	
	if( catalyst_get_responsive( 'content_media_query_default' ) == 'default' )
	{
		$content_mq_first = '.catalyst-hybrid-odd.catalyst-hybrid-columns, .catalyst-hybrid-even.catalyst-hybrid-columns { width: 100%; }' . "\n";
		$content_mq_first .= '.double-left-sidebar #container-wrap, .double-right-sidebar #container-wrap,' . "\n";
		$content_mq_first .= '.left-sidebar #container-wrap, .right-sidebar #container-wrap,' . "\n";
		$content_mq_first .= '.double-sidebar #container-wrap { padding-bottom: 0; }' . "\n";
		$content_mq_first .= '#content, .left-sidebar #content, .right-sidebar #content, .double-left-sidebar #content, .double-sidebar #content { margin: 0; }' . "\n";
		$content_mq_first .= '#dual-sidebar-outer, .double-left-sidebar #dual-sidebar-outer { width: 100%; margin: 20px 0 0; float: left; }' . "\n";
		$content_mq_first .= '.right-sidebar #sidebar-1-wrap, .left-sidebar #sidebar-1-wrap, .double-sidebar #sidebar-1-wrap { width: 100%; margin: 20px 0 0; }' . "\n";
		$content_mq_first .= '#sidebar-1, .double-left-sidebar #sidebar-1, .right-sidebar #sidebar-1, .left-sidebar #sidebar-1, .double-sidebar #sidebar-1,' . "\n";
		$content_mq_first .= '#sidebar-2, .double-left-sidebar #sidebar-2, .double-sidebar #sidebar-2 { width: 100%; }' . "\n";
		$content_mq_first .= '#catalyst-125-ads { margin: 0 0 0 5px; }' . "\n";
		$content_mq_second = '.double-sidebar #sidebar-2-wrap { margin: 20px 0 0; }' . "\n";
		$content_mq_second .= '#sidebar-1-wrap, .double-left-sidebar #sidebar-1-wrap, .double-sidebar #sidebar-1-wrap,' . "\n";
		$content_mq_second .= '#sidebar-2-wrap, .double-left-sidebar #sidebar-2-wrap, .double-sidebar #sidebar-2-wrap { width: 48.7%; }' . "\n";
		$content_mq_fourth = '#sidebar-1-wrap, .double-left-sidebar #sidebar-1-wrap, .double-sidebar #sidebar-1-wrap,' . "\n";
		$content_mq_fourth .= '#sidebar-2-wrap, .double-left-sidebar #sidebar-2-wrap, .double-sidebar #sidebar-2-wrap { width: 100%; }' . "\n";
	}
	elseif( catalyst_get_responsive( 'content_media_query_default' ) == 'progressive' )
	{
		$content_mq_first = '.catalyst-hybrid-odd.catalyst-hybrid-columns, .catalyst-hybrid-even.catalyst-hybrid-columns { width: 100%; }' . "\n";
		$content_mq_second = '.double-sidebar #container-wrap { padding-bottom: 0; }' . "\n";
		$content_mq_second .= '#content { ' . $catalyst_dimensions['media1_content_margins'] . ' }' . "\n";
		$content_mq_second .= '.double-left-sidebar #content { ' . $catalyst_dimensions['media1_dbl_lft_sb_content_margins'] . ' }' . "\n";
		$content_mq_second .= '.double-sidebar #content { margin: 0; }' . "\n";
		$content_mq_second .= '#dual-sidebar-outer, .double-left-sidebar #dual-sidebar-outer { width: ' . $catalyst_dimensions['sb1_width'] . 'px; margin: 0 0 0 -' . $catalyst_dimensions['sb1_width'] . 'px; }' . "\n";
		$content_mq_second .= '.double-left-sidebar #dual-sidebar-outer { margin: 0 -' . $catalyst_dimensions['sb1_width'] . 'px 0 0; }' . "\n";
		$content_mq_second .= '#sidebar-1-wrap, #sidebar-2-wrap, .double-left-sidebar #sidebar-1-wrap, .double-left-sidebar #sidebar-2-wrap,' . "\n";
		$content_mq_second .= '#sidebar-1, #sidebar-2, .double-left-sidebar  #sidebar-1, .double-left-sidebar #sidebar-2 { width: ' . $catalyst_dimensions['sb1_width'] . 'px; }' . "\n";
		$content_mq_second .= '.double-sidebar #sidebar-1-wrap, .double-sidebar #sidebar-2-wrap { margin: 20px 0 0; width: 49%; }' . "\n";
		$content_mq_second .= '.double-sidebar #sidebar-1, .double-sidebar #sidebar-2 { width: 100%; }' . "\n";
		$content_mq_second .= '#catalyst-125-ads { margin: 0 0 0 5px; }' . "\n";
		$content_mq_fourth = '.double-left-sidebar #container-wrap, .double-right-sidebar #container-wrap,' . "\n";
		$content_mq_fourth .= '.left-sidebar #container-wrap, .right-sidebar #container-wrap,' . "\n";
		$content_mq_fourth .= '.double-sidebar #container-wrap { padding-bottom: 0; }' . "\n";
		$content_mq_fourth .= '#content, .left-sidebar #content, .right-sidebar #content, .double-left-sidebar #content, .double-sidebar #content { margin: 0; }' . "\n";
		$content_mq_fourth .= '#dual-sidebar-outer, .double-left-sidebar #dual-sidebar-outer { margin: 20px 0 0; float: left; }' . "\n";
		$content_mq_fourth .= '.left-sidebar #sidebar-1-wrap, .right-sidebar #sidebar-1-wrap, .double-sidebar #sidebar-1-wrap { margin: 20px 0 0; }' . "\n";
		$content_mq_fourth .= '#dual-sidebar-outer, .double-left-sidebar #dual-sidebar-outer, #sidebar-1-wrap, .double-left-sidebar #sidebar-1-wrap,' . "\n";
		$content_mq_fourth .= '.left-sidebar #sidebar-1-wrap, .right-sidebar #sidebar-1-wrap, .double-sidebar #sidebar-1-wrap,' . "\n";
		$content_mq_fourth .= '#sidebar-2-wrap, .double-left-sidebar #sidebar-2-wrap, .double-sidebar #sidebar-2-wrap,' . "\n";
		$content_mq_fourth .= '#sidebar-1, .double-left-sidebar #sidebar-1, .right-sidebar #sidebar-1, .left-sidebar #sidebar-1, .double-sidebar #sidebar-1,' . "\n";
		$content_mq_fourth .= '#sidebar-2, .double-left-sidebar #sidebar-2, .double-sidebar #sidebar-2 { width: 100%; }' . "\n";
	}
	else
	{
		$content_mq_first = '';
		$content_mq_second = '';
		$content_mq_fourth = '';
	}
	
	if( catalyst_get_responsive( 'ez_media_query_default' ) == 'default' && catalyst_get_responsive( 'content_media_query_default' ) == 'progressive' )
	{
		$ez_mq_first = '#ez-home-container-wrap, #ez-home-sidebar-1-wrap { width: 100%; }' . "\n";
		$ez_mq_first .= '#ez-home-sidebar-1-wrap { margin: 20px 0 0; float: left; }' . "\n";
		$ez_mq_first .= '.ez-five-sixths, .ez-four-fifths, .ez-four-sixths, .ez-one-fifth, .ez-one-fourth,' . "\n";
		$ez_mq_first .= '.ez-one-half, .ez-one-sixth, .ez-one-third, .ez-three-fifths, .ez-three-fourths,' . "\n";
		$ez_mq_first .= '.ez-three-sixths, .ez-two-fifths, .ez-two-fourths, .ez-two-sixths, .ez-two-thirds { width: 100%; padding: 0 0 ' . $catalyst_dimensions['content_paragraph_padding_bottom'] . 'px; }' . "\n";
		$ez_mq_first .= '#ez-home-slider.ez-widget-area, .slider-inside #ez-home-slider.ez-widget-area { padding-bottom: 0; }' . "\n";
		$ez_mq_first .= '#home-hook-wrap { padding-bottom: 0; }' . "\n";
		$ez_mq_first .= '#ez-home-container-wrap, .ez-home-container-area,' . "\n";
		$ez_mq_first .= '#ez-feature-top-container, #ez-fat-footer-container { margin: 0 auto; padding-bottom: 0; }' . "\n";
		$ez_mq_first .= '#ez-home-container-wrap .ez-widget-area,' . "\n";
		$ez_mq_first .= '#ez-feature-top-container .ez-widget-area,' . "\n";
		$ez_mq_first .= '#ez-fat-footer-container .ez-widget-area { width: 100%; padding-bottom: 20px; padding-left: 0 !important; }' . "\n";
		$ez_mq_first .= '#ez-home-sidebar-1-wrap { margin: 0; }' . "\n";
		$ez_mq_second = 'body.double-left-sidebar.slider-inside #ez-home-slider-container-wrap { margin: 0 0 20px ' . $catalyst_dimensions['media1_home_slider_inside_sb_margin'] . 'px; }' . "\n";
		$ez_mq_second .= 'body.double-right-sidebar.slider-inside #ez-home-slider-container-wrap { margin: 0 ' . $catalyst_dimensions['media1_home_slider_inside_sb_margin'] . 'px 20px 0; }' . "\n";
		$ez_mq_second .= 'body.double-sidebar.slider-inside #ez-home-slider-container-wrap { margin: 0 0 20px; }' . "\n";
		$ez_mq_second .= 'body.left-sidebar.slider-inside #ez-home-slider-container-wrap { margin: 0 0 20px ' . $catalyst_dimensions['media1_home_slider_inside_sb_margin'] . 'px; }' . "\n";
		$ez_mq_second .= 'body.right-sidebar.slider-inside #ez-home-slider-container-wrap { margin: 0 ' . $catalyst_dimensions['media1_home_slider_inside_sb_margin'] . 'px 20px 0; }' . "\n";
		$ez_mq_fourth = 'body.double-left-sidebar.slider-inside #ez-home-slider-container-wrap,' . "\n";
		$ez_mq_fourth .= 'body.double-right-sidebar.slider-inside #ez-home-slider-container-wrap,' . "\n";
		$ez_mq_fourth .= 'body.double-sidebar.slider-inside #ez-home-slider-container-wrap,' . "\n";
		$ez_mq_fourth .= 'body.left-sidebar.slider-inside #ez-home-slider-container-wrap,' . "\n";
		$ez_mq_fourth .= 'body.right-sidebar.slider-inside #ez-home-slider-container-wrap { margin: 0 0 20px; }' . "\n";
	}
	elseif( catalyst_get_responsive( 'ez_media_query_default' ) == 'delayed' && catalyst_get_responsive( 'content_media_query_default' ) == 'progressive' )
	{
		$ez_mq_first = '#ez-home-container-wrap, #ez-home-sidebar-1-wrap { width: 100%; }' . "\n";
		$ez_mq_first .= '#ez-home-sidebar-1-wrap { margin: 20px 0 0; float: left; }' . "\n";
		$ez_mq_second = 'body.double-left-sidebar.slider-inside #ez-home-slider-container-wrap { margin: 0 0 20px ' . $catalyst_dimensions['media1_home_slider_inside_sb_margin'] . 'px; }' . "\n";
		$ez_mq_second .= 'body.double-right-sidebar.slider-inside #ez-home-slider-container-wrap { margin: 0 ' . $catalyst_dimensions['media1_home_slider_inside_sb_margin'] . 'px 20px 0; }' . "\n";
		$ez_mq_second .= 'body.double-sidebar.slider-inside #ez-home-slider-container-wrap { margin: 0 0 20px; }' . "\n";
		$ez_mq_second .= 'body.left-sidebar.slider-inside #ez-home-slider-container-wrap { margin: 0 0 20px ' . $catalyst_dimensions['media1_home_slider_inside_sb_margin'] . 'px; }' . "\n";
		$ez_mq_second .= 'body.right-sidebar.slider-inside #ez-home-slider-container-wrap { margin: 0 ' . $catalyst_dimensions['media1_home_slider_inside_sb_margin'] . 'px 20px 0; }' . "\n";
		$ez_mq_fourth = '.ez-five-sixths, .ez-four-fifths, .ez-four-sixths, .ez-one-fifth, .ez-one-fourth,' . "\n";
		$ez_mq_fourth .= '.ez-one-half, .ez-one-sixth, .ez-one-third, .ez-three-fifths, .ez-three-fourths,' . "\n";
		$ez_mq_fourth .= '.ez-three-sixths, .ez-two-fifths, .ez-two-fourths, .ez-two-sixths, .ez-two-thirds { width: 100%; padding: 0 0 ' . $catalyst_dimensions['content_paragraph_padding_bottom'] . 'px; }' . "\n";
		$ez_mq_fourth .= 'body.double-left-sidebar.slider-inside #ez-home-slider-container-wrap,' . "\n";
		$ez_mq_fourth .= 'body.double-right-sidebar.slider-inside #ez-home-slider-container-wrap,' . "\n";
		$ez_mq_fourth .= 'body.double-sidebar.slider-inside #ez-home-slider-container-wrap,' . "\n";
		$ez_mq_fourth .= 'body.left-sidebar.slider-inside #ez-home-slider-container-wrap,' . "\n";
		$ez_mq_fourth .= 'body.right-sidebar.slider-inside #ez-home-slider-container-wrap { margin: 0 0 20px; }' . "\n";
		$ez_mq_fourth .= '#ez-home-slider.ez-widget-area, .slider-inside #ez-home-slider.ez-widget-area { padding-bottom: 0; }' . "\n";
		$ez_mq_fourth .= '#home-hook-wrap { padding-bottom: 0; }' . "\n";
		$ez_mq_fourth .= '#ez-home-container-wrap, .ez-home-container-area,' . "\n";
		$ez_mq_fourth .= '#ez-feature-top-container, #ez-fat-footer-container { margin: 0 auto; padding-bottom: 0; }' . "\n";
		$ez_mq_fourth .= '#ez-home-container-wrap .ez-widget-area,' . "\n";
		$ez_mq_fourth .= '#ez-feature-top-container .ez-widget-area,' . "\n";
		$ez_mq_fourth .= '#ez-fat-footer-container .ez-widget-area { width: 100%; padding-bottom: 20px; padding-left: 0 !important; }' . "\n";
		$ez_mq_fourth .= '#ez-home-sidebar-1-wrap { margin: 0; }' . "\n";
	}
	elseif( catalyst_get_responsive( 'ez_media_query_default' ) == 'default' )
	{
		$ez_mq_first = '#ez-home-container-wrap, #ez-home-sidebar-1-wrap { width: 100%; }' . "\n";
		$ez_mq_first .= '#ez-home-sidebar-1-wrap { margin: 20px 0 0; float: left; }' . "\n";
		$ez_mq_first .= '.ez-five-sixths, .ez-four-fifths, .ez-four-sixths, .ez-one-fifth, .ez-one-fourth,' . "\n";
		$ez_mq_first .= '.ez-one-half, .ez-one-sixth, .ez-one-third, .ez-three-fifths, .ez-three-fourths,' . "\n";
		$ez_mq_first .= '.ez-three-sixths, .ez-two-fifths, .ez-two-fourths, .ez-two-sixths, .ez-two-thirds { width: 100%; padding: 0 0 ' . $catalyst_dimensions['content_paragraph_padding_bottom'] . 'px; }' . "\n";
		$ez_mq_first .= '#ez-home-slider.ez-widget-area, .slider-inside #ez-home-slider.ez-widget-area { padding-bottom: 0; }' . "\n";
		$ez_mq_first .= '#home-hook-wrap { padding-bottom: 0; }' . "\n";
		$ez_mq_first .= '#ez-home-container-wrap, .ez-home-container-area,' . "\n";
		$ez_mq_first .= '#ez-feature-top-container, #ez-fat-footer-container { margin: 0 auto; padding-bottom: 0; }' . "\n";
		$ez_mq_first .= '#ez-home-container-wrap .ez-widget-area,' . "\n";
		$ez_mq_first .= '#ez-feature-top-container .ez-widget-area,' . "\n";
		$ez_mq_first .= '#ez-fat-footer-container .ez-widget-area { width: 100%; padding-bottom: 20px; padding-left: 0 !important; }' . "\n";
		$ez_mq_first .= '#ez-home-sidebar-1-wrap { margin: 0; }' . "\n";
		$ez_mq_first .= 'body.double-left-sidebar.slider-inside #ez-home-slider-container-wrap,' . "\n";
		$ez_mq_first .= 'body.double-right-sidebar.slider-inside #ez-home-slider-container-wrap,' . "\n";
		$ez_mq_first .= 'body.double-sidebar.slider-inside #ez-home-slider-container-wrap,' . "\n";
		$ez_mq_first .= 'body.left-sidebar.slider-inside #ez-home-slider-container-wrap,' . "\n";
		$ez_mq_first .= 'body.right-sidebar.slider-inside #ez-home-slider-container-wrap { margin: 0 0 20px; }' . "\n";
		$ez_mq_second = '';
		$ez_mq_fourth = '';
	}
	elseif( catalyst_get_responsive( 'ez_media_query_default' ) == 'delayed' )
	{
		$ez_mq_first = '#ez-home-container-wrap, #ez-home-sidebar-1-wrap { width: 100%; }' . "\n";
		$ez_mq_first .= '#ez-home-sidebar-1-wrap { margin: 20px 0 0; float: left; }' . "\n";
		$ez_mq_first .= 'body.double-left-sidebar.slider-inside #ez-home-slider-container-wrap,' . "\n";
		$ez_mq_first .= 'body.double-right-sidebar.slider-inside #ez-home-slider-container-wrap,' . "\n";
		$ez_mq_first .= 'body.double-sidebar.slider-inside #ez-home-slider-container-wrap,' . "\n";
		$ez_mq_first .= 'body.left-sidebar.slider-inside #ez-home-slider-container-wrap,' . "\n";
		$ez_mq_first .= 'body.right-sidebar.slider-inside #ez-home-slider-container-wrap { margin: 0 0 20px; }' . "\n";
		$ez_mq_second = '';
		$ez_mq_fourth = '.ez-five-sixths, .ez-four-fifths, .ez-four-sixths, .ez-one-fifth, .ez-one-fourth,' . "\n";
		$ez_mq_fourth .= '.ez-one-half, .ez-one-sixth, .ez-one-third, .ez-three-fifths, .ez-three-fourths,' . "\n";
		$ez_mq_fourth .= '.ez-three-sixths, .ez-two-fifths, .ez-two-fourths, .ez-two-sixths, .ez-two-thirds { width: 100%; padding: 0 0 ' . $catalyst_dimensions['content_paragraph_padding_bottom'] . 'px; }' . "\n";
		$ez_mq_fourth .= '#ez-home-slider.ez-widget-area, .slider-inside #ez-home-slider.ez-widget-area { padding-bottom: 0; }' . "\n";
		$ez_mq_fourth .= '#home-hook-wrap { padding-bottom: 0; }' . "\n";
		$ez_mq_fourth .= '#ez-home-container-wrap, .ez-home-container-area,' . "\n";
		$ez_mq_fourth .= '#ez-feature-top-container, #ez-fat-footer-container { margin: 0 auto; padding-bottom: 0; }' . "\n";
		$ez_mq_fourth .= '#ez-home-container-wrap .ez-widget-area,' . "\n";
		$ez_mq_fourth .= '#ez-feature-top-container .ez-widget-area,' . "\n";
		$ez_mq_fourth .= '#ez-fat-footer-container .ez-widget-area { width: 100%; padding-bottom: 20px; padding-left: 0 !important; }' . "\n";
		$ez_mq_fourth .= '#ez-home-sidebar-1-wrap { margin: 0; }' . "\n";
	}
	else
	{
		$ez_mq_first = '';
		$ez_mq_second = '';
		$ez_mq_fourth = '';
	}
	
	if( catalyst_get_responsive( 'footer_media_query_default' ) == 'default' )
	{
		$footer_mq_first = '.footer-left, .footer-right { padding: 0; float: none; text-align: center; clear: both; }' . "\n";
	}
	else
	{
		$footer_mq_first = '';
	}
	
	if( catalyst_get_advanced( 'custom_css' ) == '' )
	{
		$media_query_large_cascading_content = catalyst_get_responsive( 'media_query_large_cascading_content' );
		$media_query_large_content = catalyst_get_responsive( 'media_query_large_content' );
		$media_query_medium_large_content = catalyst_get_responsive( 'media_query_medium_large_content' );
		$media_query_medium_cascading_content = catalyst_get_responsive( 'media_query_medium_cascading_content' );
		$media_query_medium_content = catalyst_get_responsive( 'media_query_medium_content' );
		$media_query_small_content = catalyst_get_responsive( 'media_query_small_content' );
	}
	else
	{
		$media_query_large_cascading_content = '';
		$media_query_large_content = '';
		$media_query_medium_large_content = '';
		$media_query_medium_cascading_content = '';
		$media_query_medium_content = '';
		$media_query_small_content = '';
	}
	
	// Build dynamik CSS content
	$css = '
/* reset css */
html, body, div, span, applet, object, iframe, h1, h2, h3, h4, h5, h6, p, blockquote, pre, a, abbr, acronym, address, big, cite, code, del, dfn, em, font, img, ins, kbd, q, s, samp, small, strike, strong, sub, sup, tt, var, b, u, i, center, dl, dt, dd, ol, ul, li, fieldset, form, label, legend, table, caption, tbody, tfoot, thead, tr, th, td {
	margin: 0; padding: 0; outline: 0;
}

/* Remove possible quote marks (") from <q>, <blockquote>. */
blockquote:before, blockquote:after, q:before, q:after { content: ""; }
blockquote, q { quotes: "" ""; }

/* clearfix css */
.clearfix:after { visibility: hidden; display: block; height: 0; font-size: 0; line-height: 0; content: " "; clear: both; }
.clearfix { display: block; }
/* IE6 */
* html .clearfix { height: 1%; }
/* IE7 */
*:first-child + html .clearfix { min-height: 1%; }

/* HTML5 display rule */
article, aside, canvas, details, figcaption, figure, footer, header, hgroup, menu, nav, section, summary {
	display: block;
}

/************************* 
	Global Elements 
*************************/

/*** Frame ***/

body {
	background: #' . $body_bg_color . $body_bg_image_type . ';
	margin: 0 auto;
	color: #' . $universal_font_color . ';
	font-size: ' . $body_font_size . 'px;
	font-family: ' . $universal_font_type . ';
	line-height: ' . $universal_line_height . ';
	' . $body_font_css . '
	' . $universal_font_css . '
}
#wrap {
	' . $wrap_bg . '
	' . $width . $catalyst_dimensions['wrap_width'] . 'px;
	border-top: ' . $wrap_tb_border_thickness . 'px ' . $wrap_border_style . ' #' . $wrap_border_color . ';
	border-bottom: ' . $wrap_tb_border_thickness . 'px ' . $wrap_border_style . ' #' . $wrap_border_color . ';
	border-left: ' . $wrap_lr_border_thickness . 'px ' . $wrap_border_style . ' #' . $wrap_border_color . ';
	border-right: ' . $wrap_lr_border_thickness . 'px ' . $wrap_border_style . ' #' . $wrap_border_color . ';
	margin: ' . $catalyst_dimensions['wrap_top_margin'] . 'px auto ' . $catalyst_dimensions['wrap_bottom_margin'] . 'px;
	padding: ' . $catalyst_dimensions['wrap_tb_padding'] . 'px ' . $catalyst_dimensions['wrap_lr_padding'] . 'px ' . $catalyst_dimensions['wrap_tb_padding'] . 'px ' . $catalyst_dimensions['wrap_lr_padding'] . 'px;
	clear: both;
	' . $wrap_box_shadow . '
	' . $wrap_border_radius . '
}

/*** Hyperlinks ***/

a, a:visited {
	color: #' . $universal_link_color . ';
	text-decoration: ' . $universal_link_underline_visited . ';
}
a:hover {
	color: #' . $universal_link_hover_color . ';
	text-decoration: ' . $universal_link_underline_hover . ';
}
a img {
	border: none;
}

/*** Images/Alignment ***/

img.alignnone {
	margin: 0 0 10px 0 !important;
	display: inline;
}
img.alignleft {
	margin: 0 10px 10px 0 !important;
	display: inline;
}
img.centered, .aligncenter {
	margin: 0 auto 10px !important;
	display: block;
}
img.alignright {
	margin: 0 0 10px 10px !important;
	display: inline;
}
.alignleft {
	margin: 0 10px 0 0;
	float: left;
}
.alignright {
	margin: 0 0 0 10px;
	float: right;
}
.wp-caption {
	' . $caption_bg . '
	border: ' . $caption_border_thickness . 'px ' . $caption_border_style . ' #' . $caption_border_color . ';
	padding: 10px 5px 0 5px;
	text-align: center;
}
.wp-caption p.wp-caption-text, .catalyst-excerpt-widget .wp-caption p.wp-caption-text {
	margin: 0;
	padding: 0 0 10px !important;
	color: #' . $caption_font_color . ' !important;
	font-family: ' . $caption_font_type . ' !important;
	font-size: ' . $caption_font_size . ' !important;
	line-height: 120%;
	' . $caption_font_css . '
}
.wp-post-image, #sidebar-1 .catalyst-excerpt-widget img, #sidebar-2 .catalyst-excerpt-widget img, #ez-home-sidebar-1 .catalyst-excerpt-widget img {
	' . $thumbnail_bg . '
	border: ' . $thumbnail_border_thickness . 'px ' . $thumbnail_border_style . ' #' . $thumbnail_border_color . ';
	padding: ' . $catalyst_dimensions['thumbnail_image_padding'] . 'px !important;
}
#sidebar-1 .catalyst-excerpt-widget img, #sidebar-2 .catalyst-excerpt-widget img, .ez-widget-area img.wp-post-image {
	margin-bottom: 0 !important;
}
img.wp-smiley, img.wp-wink {
	border: none;
	margin: 0;
	padding: 0;
	float: none;
}
img#wpstats {
    width: 0;
    height: 0;
    overflow: hidden;
	display: none;
}
.post-format-icon {
	background: none;
	margin: 0 0 0 10px;
	float: right;
	display: block;
}
.page .post-format-icon {
	display: none;
}
body.page-template-template-blog-php .post-format-icon {
	display: block;
}

/*** Search Form ***/

#header-right .widget_search {
	padding: 0;
	float: right;
}
.searchform {
	margin: 0;
	padding: 0;
	display: inline;
	overflow: hidden;
}
#sidebar-1 .searchform, #sidebar-2 .searchform {
	padding: 0 10px;
}
.s {
	' . $search_form_bg . '
	border: ' . $search_form_border_thickness . 'px ' . $search_form_border_style . ' #' . $search_form_border_color . ';
	margin: 10px 0;
	padding: ' . $catalyst_dimensions['search_form_padding_top'] . 'px ' . $catalyst_dimensions['search_form_padding_right'] . 'px ' . $catalyst_dimensions['search_form_padding_bottom'] . 'px ' . $catalyst_dimensions['search_form_padding_left'] . 'px;
	color: #' . $search_form_font_color . ';
	font-family: ' . $search_form_font_type . ';
	font-size: ' . $search_form_font_size . ';
	display: inline;
	' . $search_form_font_css . '
}
#header .s, #navbar-1 .s, #navbar-2 .s {
	margin: 0;
}
.s, #header .s, #sidebar-1 .s, #sidebar-2 .s {
	width: ' . $catalyst_dimensions['search_form_width'] . 'px;
}
.searchsubmit {
	' . $search_button_bg . '
	border: ' . $search_button_border_thickness . 'px ' . $search_button_border_style . ' #' . $search_button_border_color . ';
	margin: 0;
	padding: ' . $catalyst_dimensions['search_button_padding_top'] . 'px ' . $catalyst_dimensions['search_button_padding_right'] . 'px ' . $catalyst_dimensions['search_button_padding_bottom'] . 'px ' . $catalyst_dimensions['search_button_padding_left'] . 'px;
	color: #' . $search_button_font_color . ';
	font-family: ' . $search_button_font_type . ';
	font-size: ' . $search_button_font_size . ';
	cursor: pointer;
	' . $search_button_font_css . '
}
.searchsubmit:hover {
	' . $search_button_hover_bg . '
	border: ' . $search_button_hover_border_thickness . 'px ' . $search_button_hover_border_style . ' #' . $search_button_hover_border_color . ';
}

/*** Calendar ***/

#wp-calendar {
	margin: 0;
	padding: 0;
	width: 100%;
}
#wp-calendar caption {
	margin: 0;
	padding: 5px 0 0 0;
	color: #333333;
	font-size: 13px;
}
#wp-calendar th {
	color: #333333;
}
#wp-calendar td {
	margin: 0;
	padding: 2px;
	text-align: center;
}
#wp-calendar tfoot td {
	margin: 0;
	padding: 0 0 5px;
}

/************************* 
	Header 
*************************/

#header-wrap {
	' . $header_bg . '
	margin: 0 auto;
	border-top: ' . $header_top_border_thickness . 'px ' . $header_border_style . ' #' . $header_border_color . ';
	border-bottom: ' . $header_bottom_border_thickness . 'px ' . $header_border_style . ' #' . $header_border_color . ';
	border-left: ' . $header_lr_border_thickness . 'px ' . $header_border_style . ' #' . $header_border_color . ';
	border-right: ' . $header_lr_border_thickness . 'px ' . $header_border_style . ' #' . $header_border_color . ';
	clear: both;
}
#header {
	' . $width . $catalyst_dimensions['header_width'] . 'px;
	height: ' . $catalyst_dimensions['header_height'] . 'px;
	margin: 0 auto;
	padding: 0;
	font-size: 12px;
	float: none;
	overflow: hidden;
}
#header-left {
	' . $width . $catalyst_dimensions['header_left_width'] . ';
	height: ' . $catalyst_dimensions['header_logo_height'] . 'px;
	padding: ' . $catalyst_dimensions['text_logo_top_padding'] . 'px 0 0 ' . $catalyst_dimensions['text_logo_left_padding'] . 'px;
	float: left;
	overflow: hidden;
}
#title {
	color: #' . $title_font_color . ';
	font-family: ' . $title_font_type . ';
	font-size: ' . $title_font_size . ';
	font-weight: normal;
	text-decoration: none;
	' . $title_font_css . '
}
#title a, #title a:visited {
	color: #' . $title_font_color . ';
	text-decoration: ' . $title_link_underline_visited . ';
}
#title a:hover {
	color: #' . $title_link_color . ';
	text-decoration: ' . $title_link_underline_hover . ';
}
#tagline {
	margin: 0;
	padding: ' . $catalyst_dimensions['tagline_top_padding'] . 'px 0 0;
	color: #' . $tagline_font_color . ';
	font-family: ' . $tagline_font_type . ';
	font-size: ' . $tagline_font_size . ';
	font-weight: normal;
	' . $tagline_font_css . '
}
.logo-image #header #header-left {
	' . $logo_image . '
	margin: ' . $catalyst_dimensions['image_logo_top_margin'] . 'px 0 0 ' . $catalyst_dimensions['image_logo_left_margin'] . 'px;
}
.logo-image #header-left, .logo-image #header-left #title, .logo-image #header-left #title a {
	width: ' . $catalyst_dimensions['header_left_width'] . ';
	height: ' . $catalyst_dimensions['header_logo_height'] . 'px;
	padding: 0;
	float: left;
	display: block; 
	text-indent: -9999px;
	overflow: hidden;
}
.logo-image #header-left #tagline {
	display: block;
	overflow: hidden;
}
#header-right {
	' . $width . $catalyst_dimensions['header_right_width'] . 'px;
	padding: ' . $catalyst_dimensions['header_right_top_padding'] . 'px ' . $catalyst_dimensions['header_right_right_padding'] . 'px 0 0;
	float: right;
}
#header-right p {
	margin: 0;
	padding: 0 0 5px 0;
}
#header-right h4 {
	margin: 0; 
	padding: 0;
	color: #333333;
	font-size: 12px;
}
#header-right img {
	display: block;
}
.header-left-full-width #header-left, .header-left-full-width #header-left #title, .header-left-full-width #header-left #title a {
	width: ' . $catalyst_dimensions['header_left_full_width'] . ';
}

/************************* 
	Navigation 
*************************/

/*** Navbar 1 ***/

#navbar-1-wrap {
	' . $nav1_bg . '
	border-top: ' . $nav1_top_border_thickness . 'px ' . $nav1_border_style . ' #' . $nav1_border_color . ';
	border-bottom: ' . $nav1_bottom_border_thickness . 'px ' . $nav1_border_style . ' #' . $nav1_border_color . ';
	border-left: ' . $nav1_left_border_thickness . 'px ' . $nav1_border_style . ' #' . $nav1_border_color . ';
	border-right: ' . $nav1_right_border_thickness . 'px ' . $nav1_border_style . ' #' . $nav1_border_color . ';
	height: ' . $nav1_wrap_height . 'px;
	margin: ' . $nav1_wrap_top_margin . 'px 0 ' . $nav1_wrap_bottom_margin . 'px 0;
	color: #' . $nav1_page_font_color . ';
	font-family: ' . $nav1_font_type . ';
	font-size: ' . $nav1_font_size . ';
	line-height: 1em;
	clear: both;
	' . $nav1_font_css . '
}
#navbar-1 {
	' . $catalyst_dimensions['nav1_width'] . '
	margin: 0 auto;
	padding: 0;
	float: none;
	display: block;
}
#navbar-1-left, #navbar-2-left {
	margin: 0;
	padding: 0;
	float: left;
}
#navbar-1-right, #navbar-2-right {
	margin: 0;
	padding: 0;
	text-transform: none;
	float: right;
}
#navbar-1-right {
	color: #' . $nav1_right_font_color . ';
	font-family: ' . $nav1_right_font_type . ';
	font-size: ' . $nav1_right_font_size . ';
	' . $nav1_right_font_css . '
}
#navbar-1-right a, #navbar-1-right a:visited {
	color: #' . $nav1_right_link_color . ';
	text-decoration: ' . $nav1_right_link_underline_visited . ';
}
#navbar-1-right a:hover {
	color: #' . $nav1_right_link_hover_color . ';
	text-decoration: ' . $nav1_right_link_underline_hover . ';
}
#navbar-1-right.navbar-right-text {
	padding: ' . $nav1_right_text_padding_top . 'px ' . $nav1_right_text_padding_right . 'px 0 0;
}
#navbar-1-right.navbar-right-search {
	padding: ' . $nav1_right_search_padding_top . 'px ' . $nav1_right_search_padding_right . 'px 0 0;
}
#nav-1, #nav-2 {
	margin: 0;
	padding: 0;
}
#nav-1 ul, #nav-2 ul {
	margin: 0;
	padding: 0;
	float: left;
	list-style: none;
}
#nav-1 li, #nav-2 li {
	margin: 0;
	padding: 0;
	float: left;
	list-style: none;
}
#nav-1 li a, #nav-1 li a:link, #nav-1 li a:visited {
	' . $nav1_page_bg . '
	border-top: ' . $nav1_page_top_border_thickness . 'px ' . $nav1_page_border_style . ' #' . $nav1_page_border_color . ';
	border-bottom: ' . $nav1_page_bottom_border_thickness . 'px ' . $nav1_page_border_style . ' #' . $nav1_page_border_color . ';
	border-left: ' . $nav1_page_left_border_thickness . 'px ' . $nav1_page_border_style . ' #' . $nav1_page_border_color . ';
	border-right: ' . $nav1_page_right_border_thickness . 'px ' . $nav1_page_border_style . ' #' . $nav1_page_border_color . ';
	margin: 0 ' . $nav1_page_right_margin . 'px 0 ' . $nav1_page_left_margin . 'px;
	padding: ' . $nav1_page_tb_padding . 'px ' . $nav1_page_lr_padding . 'px ' . $nav1_page_tb_padding . 'px ' . $nav1_page_lr_padding . 'px;
	color: #' . $nav1_page_font_color . ';
	text-decoration: ' . $nav1_link_underline_visited . ';
	display: block;
	position: relative;
}
#nav-1 li a:hover, #nav-1 li a:active {
	' . $nav1_page_hover_bg . '
	border-top: ' . $nav1_page_top_border_thickness . 'px ' . $nav1_page_border_style . ' #' . $nav1_page_hover_border_color . ';
	border-bottom: ' . $nav1_page_bottom_border_thickness . 'px ' . $nav1_page_border_style . ' #' . $nav1_page_hover_border_color . ';
	border-left: ' . $nav1_page_left_border_thickness . 'px ' . $nav1_page_border_style . ' #' . $nav1_page_hover_border_color . ';
	border-right: ' . $nav1_page_right_border_thickness . 'px ' . $nav1_page_border_style . ' #' . $nav1_page_hover_border_color . ';
	color: #' . $nav1_page_hover_font_color . ';
	text-decoration: ' . $nav1_link_underline_hover . ';
}
#nav-1 li a.sf-with-ul {
	padding-right: ' . $nav1_sf_right_padding . 'px;
}
' . $nav1_sub_indicator_styles . '
#nav-1 li li a, #nav-1 li li a:link, #nav-1 li li a:visited {
	' . $nav1_sub_page_bg . '
	width: ' . $nav1_submenu_width . 'px;
	border-top: 0;
	border-right: 1px solid #' . $nav1_submenu_border_color . ';
	border-bottom: 1px solid #' . $nav1_submenu_border_color . ';
	border-left: 1px solid #' . $nav1_submenu_border_color . ';
	margin: 0 0 0 ' . $nav1_page_left_margin . 'px;
	padding: ' . $nav1_submenu_tb_padding . 'px ' . $nav1_submenu_lr_padding . 'px ' . $nav1_submenu_tb_padding . 'px ' . $nav1_submenu_lr_padding . 'px;
	color: #' . $nav1_sub_page_font_color . ';
	text-decoration: ' . $nav1_link_underline_visited . ';
	float: none;
}
#nav-1 li li a:hover, #nav-1 li li a:active {
	' . $nav1_sub_page_hover_bg . '
	color: #' . $nav1_sub_page_hover_font_color . ';
	text-decoration: ' . $nav1_link_underline_hover . ';
}
#nav-1 li ul {
	width: ' . $nav1_submenu_width_plus . 'px;
	height: auto;
	margin: 0;
	padding: 0;
	z-index: 9999;
	left: -999em;
	position: absolute;
}
#nav-1 li ul ul {
	margin: ' . $nav1_liulul_top_margin . 'px 0 0 ' . $nav1_liulul_left_margin . 'px;
}
#nav-1 li:hover ul ul, #nav-2 li:hover ul ul, #nav-1 li:hover ul ul ul, #nav-2 li:hover ul ul ul {
	left: -999em;
}
#nav-1 li:hover ul, #nav-1 li.sfHover ul, #nav-2 li:hover ul, #nav-2 li.sfHover ul, #nav-1 li li:hover ul, #nav-2 li li:hover ul, #nav-1 li li li:hover ul, #nav-2 li li li:hover ul {
	left: auto;
}
#nav-1 li:hover, #nav-1 li.sfHover, #nav-2 li:hover, #nav-2 li.sfHover {
	position: static;
}
#nav-1 li.current_page_item a, #nav-1 li.current-menu-item a, #nav-1 li.current-cat a {
	' . $nav1_page_active_bg . '
	border-top: ' . $nav1_page_top_border_thickness . 'px ' . $nav1_page_border_style . ' #' . $nav1_page_active_border_color . ';
	border-bottom: ' . $nav1_page_bottom_border_thickness . 'px ' . $nav1_page_border_style . ' #' . $nav1_page_active_border_color . ';
	border-left: ' . $nav1_page_left_border_thickness . 'px ' . $nav1_page_border_style . ' #' . $nav1_page_active_border_color . ';
	border-right: ' . $nav1_page_right_border_thickness . 'px ' . $nav1_page_border_style . ' #' . $nav1_page_active_border_color . ';
	color: #' . $nav1_page_active_font_color . ';
	text-decoration: ' . $nav1_link_underline_hover . ';
}

/*** Navbar 2 ***/

#navbar-2-wrap {
	' . $nav2_bg . '
	border-top: ' . $nav2_top_border_thickness . 'px ' . $nav2_border_style . ' #' . $nav2_border_color . ';
	border-bottom: ' . $nav2_bottom_border_thickness . 'px ' . $nav2_border_style . ' #' . $nav2_border_color . ';
	border-left: ' . $nav2_left_border_thickness . 'px ' . $nav2_border_style . ' #' . $nav2_border_color . ';
	border-right: ' . $nav2_right_border_thickness . 'px ' . $nav2_border_style . ' #' . $nav2_border_color . ';
	height: ' . $nav2_wrap_height . 'px;
	margin: ' . $nav2_wrap_top_margin . 'px 0 ' . $nav2_wrap_bottom_margin . 'px 0;
	color: #' . $nav2_page_font_color . ';
	font-family: ' . $nav2_font_type . ';
	font-size: ' . $nav2_font_size . ';
	line-height: 1em;
	clear: both;
	' . $nav2_font_css . '
}
#navbar-2 {
	' . $catalyst_dimensions['nav2_width'] . '
	margin: 0 auto;
	padding: 0;
	float: none;
	display: block;
}
#navbar-2-right {
	color: #' . $nav2_right_font_color . ';
	font-family: ' . $nav2_right_font_type . ';
	font-size: ' . $nav2_right_font_size . ';
	' . $nav2_right_font_css . '
}
#navbar-2-right a, #navbar-2-right a:visited {
	color: #' . $nav2_right_link_color . ';
	text-decoration: ' . $nav2_right_link_underline_visited . ';
}
#navbar-2-right a:hover {
	color: #' . $nav2_right_link_hover_color . ';
	text-decoration: ' . $nav2_right_link_underline_hover . ';
}
#navbar-2-right.navbar-right-text {
	padding: ' . $nav2_right_text_padding_top . 'px ' . $nav2_right_text_padding_right . 'px 0 0;
}
#navbar-2-right.navbar-right-search {
	padding: ' . $nav2_right_search_padding_top . 'px ' . $nav2_right_search_padding_right . 'px 0 0;
}
#nav-2 li a, #nav-2 li a:link, #nav-2 li a:visited {
	' . $nav2_page_bg . '
	border-top: ' . $nav2_page_top_border_thickness . 'px ' . $nav2_page_border_style . ' #' . $nav2_page_border_color . ';
	border-bottom: ' . $nav2_page_bottom_border_thickness . 'px ' . $nav2_page_border_style . ' #' . $nav2_page_border_color . ';
	border-left: ' . $nav2_page_left_border_thickness . 'px ' . $nav2_page_border_style . ' #' . $nav2_page_border_color . ';
	border-right: ' . $nav2_page_right_border_thickness . 'px ' . $nav2_page_border_style . ' #' . $nav2_page_border_color . ';
	margin: 0px ' . $nav2_page_right_margin . 'px 0px ' . $nav2_page_left_margin . 'px;
	padding: ' . $nav2_page_tb_padding . 'px ' . $nav2_page_lr_padding . 'px ' . $nav2_page_tb_padding . 'px ' . $nav2_page_lr_padding . 'px;
	color: #' . $nav2_page_font_color . ';
	text-decoration: ' . $nav2_link_underline_visited . ';
	display: block;
	position: relative;
}
#nav-2 li a:hover, #nav-2 li a:active {
	' . $nav2_page_hover_bg . '
	border-top: ' . $nav2_page_top_border_thickness . 'px ' . $nav2_page_border_style . ' #' . $nav2_page_hover_border_color . ';
	border-bottom: ' . $nav2_page_bottom_border_thickness . 'px ' . $nav2_page_border_style . ' #' . $nav2_page_hover_border_color . ';
	border-left: ' . $nav2_page_left_border_thickness . 'px ' . $nav2_page_border_style . ' #' . $nav2_page_hover_border_color . ';
	border-right: ' . $nav2_page_right_border_thickness . 'px ' . $nav2_page_border_style . ' #' . $nav2_page_hover_border_color . ';
	color: #' . $nav2_page_hover_font_color . ';
	text-decoration: ' . $nav2_link_underline_hover . ';
}
#nav-2 li a.sf-with-ul {
	padding-right: ' . $nav2_sf_right_padding . 'px;
}
' . $nav2_sub_indicator_styles . '
#nav-2 li li a, #nav-2 li li a:link, #nav-2 li li a:visited {
	' . $nav2_sub_page_bg . '
	width: ' . $nav2_submenu_width . 'px;
	border-top: 0;
	border-right: 1px solid #' . $nav2_submenu_border_color . ';
	border-bottom: 1px solid #' . $nav2_submenu_border_color . ';
	border-left: 1px solid #' . $nav2_submenu_border_color . ';
	margin: 0 0 0 ' . $nav2_page_left_margin . 'px;
	padding: ' . $nav2_submenu_tb_padding . 'px ' . $nav2_submenu_lr_padding . 'px ' . $nav2_submenu_tb_padding . 'px ' . $nav2_submenu_lr_padding . 'px;
	color: #' . $nav2_sub_page_font_color . ';
	text-decoration: ' . $nav2_link_underline_visited . ';
	float: none;
}
#nav-2 li li a:hover, #nav-2 li li a:active {
	' . $nav2_sub_page_hover_bg . '
	color: #' . $nav2_sub_page_hover_font_color . ';
	text-decoration: ' . $nav2_link_underline_hover . ';
}
#nav-2 li ul {
	width: ' . $nav2_submenu_width_plus . 'px;
	height: auto;
	margin: 0;
	padding: 0;
	z-index: 9999;
	left: -999em;
	position: absolute;
}
#nav-2 li ul ul {
	margin: ' . $nav2_liulul_top_margin . 'px 0 0 ' . $nav2_liulul_left_margin . 'px;
}
#nav-2 li.current_page_item a, #nav-2 li.current-menu-item a, #nav-2 li.current-cat a {
	' . $nav2_page_active_bg . '
	border-top: ' . $nav2_page_top_border_thickness . 'px ' . $nav2_page_border_style . ' #' . $nav2_page_active_border_color . ';
	border-bottom: ' . $nav2_page_bottom_border_thickness . 'px ' . $nav2_page_border_style . ' #' . $nav2_page_active_border_color . ';
	border-left: ' . $nav2_page_left_border_thickness . 'px ' . $nav2_page_border_style . ' #' . $nav2_page_active_border_color . ';
	border-right: ' . $nav2_page_right_border_thickness . 'px ' . $nav2_page_border_style . ' #' . $nav2_page_active_border_color . ';
	color: #' . $nav2_page_active_font_color . ';
	text-decoration: ' . $nav2_link_underline_hover . ';
}

/*** Responsive Dropdown Navbars ***/

#dropdown-nav-1-wrap, #dropdown-nav-2-wrap {
	display: none;
}

.nav-1-chosen-select, .nav-2-chosen-select {
	width: 100%;
	margin: 0;
	padding: 7px;
}

.nav-1-chosen-select {
	' . $nav1_bg . '
	border: ' . $nav1_bottom_border_thickness . 'px ' . $nav1_border_style . ' #' . $nav1_border_color . ';
	color: #' . $nav1_page_font_color . ';
	font-family: ' . $nav1_font_type . ';
	font-size: ' . $nav1_font_size . ';
	' . $nav1_dropdown_webkit_appearance . '
}

.nav-2-chosen-select {
	' . $nav2_bg . '
	border: ' . $nav2_bottom_border_thickness . 'px ' . $nav2_border_style . ' #' . $nav2_border_color . ';
	color: #' . $nav2_page_font_color . ';
	font-family: ' . $nav2_font_type . ';
	font-size: ' . $nav2_font_size . ';
	' . $nav2_dropdown_webkit_appearance . '
}

/************************* 
	Content 
*************************/

#container-wrap {
	' . $container_wrap_bg . '
	margin: 0;
	padding: ' . $catalyst_dimensions['container_wrap_tb_padding'] . 'px ' . $catalyst_dimensions['container_wrap_lr_padding'] . 'px ' . $catalyst_dimensions['container_wrap_tb_padding'] . 'px ' . $catalyst_dimensions['container_wrap_lr_padding'] . 'px;
	clear: both;
}
#container {
	' . $width . $catalyst_dimensions['container_width'] . 'px;
	margin: 0;
	padding: 0;
	' . $catalyst_dimensions['content_float'] . '
}
#content-sidebar-wrap {
	width: ' . $catalyst_dimensions['content_sb_wrap_width'] . ';
	float: left;
}
.double-sidebar #content-sidebar-wrap {
	' . $catalyst_dimensions['content_sb_wrap_alt_width'] . '
}
#content-wrap {
	width: 100%;
	margin: 0;
	padding: 0;
	float: left;
}
.left-sidebar #content-wrap, .double-left-sidebar #content-wrap, .double-sidebar #content-wrap {
	float: right;
}
.double-sidebar #content-wrap {
	' . $catalyst_dimensions['content_wrap_dbl_sb_float'] . '
}
#content-wrap, .left-sidebar #content-wrap, .right-sidebar #content-wrap, .no-sidebar #content-wrap {
	' . $catalyst_dimensions['content_wrap_width'] . '
}
#content {
	margin: ' . $catalyst_dimensions['content_margins'] . ';
	padding: 0;
	' . $catalyst_dimensions['content_float'] . '
	' . $catalyst_dimensions['content_clear'] . '
	' . $catalyst_dimensions['content_overflow'] . '
}
.double-left-sidebar #content {
	' . $catalyst_dimensions['content_margins_dbl_lft_sb'] . '
}
.right-sidebar #content {
	' . $catalyst_dimensions['content_margins_rt_sb'] . '
}
.left-sidebar #content {
	' . $catalyst_dimensions['content_margins_lft_sb'] . '
}
.double-sidebar #content {
	' . $catalyst_dimensions['content_margins_dbl_sb'] . '
}
.no-sidebar #content {
	' . $catalyst_dimensions['content_margins_no_sb'] . '
}
#content, .left-sidebar #content, .right-sidebar #content, .no-sidebar #content {
	' . $catalyst_dimensions['cc_width_css'] . '
}
#content img, #content p img {
	max-width: 100%;
	height: auto;
}
#content .nivoSlider img {
    max-width: none;
}
#content .post, #content article {
	' . $post_content_bg . '
	border-top: ' . $post_content_top_border_thickness . 'px ' . $post_content_border_style . ' #' . $post_content_border_color . ';
	border-bottom: ' . $post_content_bottom_border_thickness . 'px ' . $post_content_border_style . ' #' . $post_content_border_color . ';
	border-left: ' . $post_content_left_border_thickness . 'px ' . $post_content_border_style . ' #' . $post_content_border_color . ';
	border-right: ' . $post_content_right_border_thickness . 'px ' . $post_content_border_style . ' #' . $post_content_border_color . ';
	margin: ' . $catalyst_dimensions['post_content_margin_top'] . 'px 0 ' . $catalyst_dimensions['post_content_margin_bottom'] . 'px 0;
	padding: ' . $catalyst_dimensions['post_content_padding_top'] . 'px ' . $catalyst_dimensions['post_content_padding_right'] . 'px ' . $catalyst_dimensions['post_content_padding_bottom'] . 'px ' . $catalyst_dimensions['post_content_padding_left'] . 'px;
}
#content .page {
	' . $page_content_bg . '
	border-top: ' . $page_content_top_border_thickness . 'px ' . $page_content_border_style . ' #' . $page_content_border_color . ';
	border-bottom: ' . $page_content_bottom_border_thickness . 'px ' . $page_content_border_style . ' #' . $page_content_border_color . ';
	border-left: ' . $page_content_left_border_thickness . 'px ' . $page_content_border_style . ' #' . $page_content_border_color . ';
	border-right: ' . $page_content_right_border_thickness . 'px ' . $page_content_border_style . ' #' . $page_content_border_color . ';
	margin: ' . $catalyst_dimensions['page_content_margin_top'] . 'px 0 ' . $catalyst_dimensions['page_content_margin_bottom'] . 'px 0;
	padding: ' . $catalyst_dimensions['page_content_padding_top'] . 'px ' . $catalyst_dimensions['page_content_padding_right'] . 'px ' . $catalyst_dimensions['page_content_padding_bottom'] . 'px ' . $catalyst_dimensions['page_content_padding_left'] . 'px;
}
#content .post p, #content .page p, #content article p {
	margin: 0;
	padding: 0 0 ' . $catalyst_dimensions['content_paragraph_padding_bottom'] . 'px;
}
#content .entry-title {
	padding: 5px 0 0;
}
#content .archive-template {
	float: left;
	width: 50%;
	padding: 10px 0;
}
.entry-content p, .entry-content ul li, .entry-content ol li {
	color: #' . $content_p_font_color . ';
	font-family: ' . $content_p_font_type . ';
	font-size: ' . $content_p_font_size . ';
	' . $content_p_font_css . '
}
.entry-content a, .entry-content a:visited {
	color: #' . $content_p_link_color . ';
	text-decoration: ' . $content_p_link_underline_visited . ';
}
.entry-content a:hover {
	color: #' . $content_p_link_hover_color . ';
	text-decoration: ' . $content_p_link_underline_hover . ';
}
.breadcrumbs, .taxonomy-title-box, .author-title-box {
	' . $breadcrumbs_bg . '
	border-top: ' . $breadcrumbs_top_border_thickness . 'px ' . $breadcrumbs_border_style . ' #' . $breadcrumbs_border_color . ';
	border-bottom: ' . $breadcrumbs_bottom_border_thickness . 'px ' . $breadcrumbs_border_style . ' #' . $breadcrumbs_border_color . ';
	border-left: ' . $breadcrumbs_left_border_thickness . 'px ' . $breadcrumbs_border_style . ' #' . $breadcrumbs_border_color . ';
	border-right: ' . $breadcrumbs_right_border_thickness . 'px ' . $breadcrumbs_border_style . ' #' . $breadcrumbs_border_color . ';
	margin: ' . $catalyst_dimensions['breadcrumbs_margin_top'] . 'px 0 ' . $catalyst_dimensions['breadcrumbs_margin_bottom'] . 'px 0;
	padding: ' . $catalyst_dimensions['breadcrumbs_padding_top'] . 'px ' . $catalyst_dimensions['breadcrumbs_padding_right'] . 'px ' . $catalyst_dimensions['breadcrumbs_padding_bottom'] . 'px ' . $catalyst_dimensions['breadcrumbs_padding_left'] . 'px;
	color: #' . $breadcrumbs_font_color . ';
	font-family: ' . $breadcrumbs_font_type . ';
	font-size: ' . $breadcrumbs_font_size . ';
	' . $breadcrumbs_font_css . '
}
.breadcrumbs a, .breadcrumbs a:visited, .taxonomy-title-box a, .taxonomy-title-box a:visited, .author-title-box a, .author-title-box a:visited {
	color: #' . $breadcrumbs_link_color . ';
	text-decoration: ' . $breadcrumbs_link_underline_visited . ';
}
.breadcrumbs a:hover, .taxonomy-title-box a:hover, .author-title-box a:hover {
	color: #' . $breadcrumbs_link_hover_color . ';
	text-decoration: ' . $breadcrumbs_link_underline_hover . ';
}
#content .taxonomy-title-box h1, #content .author-title-box h1 {
	color: #' . $breadcrumbs_font_color . ';
}

/*** Author Info Box ***/

#entry-author-info {
	' . $author_info_bg . '
	border-top: ' . $author_info_top_border_thickness . 'px ' . $author_info_border_style . ' #' . $author_info_border_color . ';
	border-bottom: ' . $author_info_bottom_border_thickness . 'px ' . $author_info_border_style . ' #' . $author_info_border_color . ';
	border-left: ' . $author_info_left_border_thickness . 'px ' . $author_info_border_style . ' #' . $author_info_border_color . ';
	border-right: ' . $author_info_right_border_thickness . 'px ' . $author_info_border_style . ' #' . $author_info_border_color . ';
	margin: ' . $catalyst_dimensions['author_info_margin_top'] . 'px 0 ' . $catalyst_dimensions['author_info_margin_bottom'] . 'px 0;
	padding: ' . $catalyst_dimensions['author_info_padding_top'] . 'px ' . $catalyst_dimensions['author_info_padding_right'] . 'px ' . $catalyst_dimensions['author_info_padding_bottom'] . 'px ' . $catalyst_dimensions['author_info_padding_left'] . 'px;
	color: #' . $author_info_font_color . ';
	font-family: ' . $author_info_font_type . ';
	font-size: ' . $author_info_font_size . ';
	overflow: hidden;
	clear: both;
	' . $author_info_font_css . '
}
#entry-author-info a, #entry-author-info a:visited {
	color: #' . $author_info_link_color . ' !important;
	text-decoration: ' . $author_info_link_underline_visited . ' !important;
}
#entry-author-info a:hover {
	color: #' . $author_info_link_hover_color . ' !important;
	text-decoration: ' . $author_info_link_underline_hover . ' !important;
}
#entry-author-info #author-avatar {
	' . $author_avatar_bg . '
	border: ' . $author_avatar_border_thickness . 'px ' . $author_avatar_border_style . ' #' . $author_avatar_border_color . ';
	width: ' . $catalyst_dimensions['author_avatar_size'] . 'px;
	height: ' . $catalyst_dimensions['author_avatar_size'] . 'px;
	margin: 0 10px 0 0;
	padding: ' . $catalyst_dimensions['author_avatar_padding'] . 'px;
	float: left;
}
#entry-author-info #author-avatar .avatar {
	width: ' . $catalyst_dimensions['author_avatar_size'] . 'px;
	height: ' . $catalyst_dimensions['author_avatar_size'] . 'px;
}
#entry-author-info #author-description {
	margin: 0;
	padding: 0;
}
#entry-author-info p {
	color: #' . $author_info_title_font_color . ';
	font-family: ' . $author_info_title_font_type . ';
	font-size: ' . $author_info_title_font_size . ';
	font-weight: bold;
	padding-bottom: 0 !important;
	' . $author_info_title_font_css . '
}

/*** Catalyst Hybrid Loop ***/

.catalyst-hybrid-odd,
.catalyst-hybrid-even{
    float: left;
}
.catalyst-hybrid-odd.catalyst-hybrid-columns {
    clear: both;
}
.catalyst-hybrid-even.catalyst-hybrid-columns {
    float: right;
}
.catalyst-hybrid-odd.catalyst-hybrid-columns,
.catalyst-hybrid-even.catalyst-hybrid-columns {
	width: ' . $catalyst_dimensions['hybrid_column_excerpt_width'] . ';
}

/*** Content Headlines ***/

#content h1, #content h2, #content h3, #content h4, #content h5, #content h6 {
	margin: 0 0 4px;
	padding: 0;
	font-family: ' . $content_heading_font_type . ';
	font-weight: normal;
	line-height: 120%;
	' . $content_heading_font_css . '
}
#content h1 {
	color: #' . $content_heading_h1_font_color . ';
	font-size: ' . $content_heading_h1_font_size . ';
}
#content h2 a, #content h2 a:visited {
	color: #' . $content_heading_h2_link_color . ';
	text-decoration: ' . $content_heading_h2_link_underline_visited . ';
}
#content h2 a:hover {
	color: #' . $content_heading_h2_hover_color . ';
	text-decoration: ' . $content_heading_h2_link_underline_hover . ';
}
#content h2 {
	color: #' . $content_heading_h2_font_color . ';
	font-size: ' . $content_heading_h2_font_size . ';
}
#content h3 {
	color: #' . $content_heading_h3_font_color . ';
	font-size: ' . $content_heading_h3_font_size . ';
}
#content h4 {
	color: #' . $content_heading_h4_font_color . ';
	font-size: ' . $content_heading_h4_font_size . ';
}
#content h5 {
	color: #' . $content_heading_h5_font_color . ';
	font-size: ' . $content_heading_h5_font_size . ';
}
#content h6 {
	color: #' . $content_heading_h6_font_color . ';
	font-size: ' . $content_heading_h6_font_size . ';
}

/*** Sticky Posts ***/

#content .sticky {
	' . $sticky_post_bg . '
	border-top: ' . $sticky_post_top_border_thickness . 'px ' . $sticky_post_border_style . ' #' . $sticky_post_border_color . ' !important;
	border-bottom: ' . $sticky_post_bottom_border_thickness . 'px ' . $sticky_post_border_style . ' #' . $sticky_post_border_color . ' !important;
	border-left: ' . $sticky_post_left_border_thickness . 'px ' . $sticky_post_border_style . ' #' . $sticky_post_border_color . ' !important;
	border-right: ' . $sticky_post_right_border_thickness . 'px ' . $sticky_post_border_style . ' #' . $sticky_post_border_color . ' !important;
	margin: ' . $catalyst_dimensions['sticky_post_margin_top'] . 'px 0 ' . $catalyst_dimensions['sticky_post_margin_bottom'] . 'px 0 !important;
	padding: ' . $catalyst_dimensions['sticky_post_padding_top'] . 'px ' . $catalyst_dimensions['sticky_post_padding_right'] . 'px ' . $catalyst_dimensions['sticky_post_padding_bottom'] . 'px ' . $catalyst_dimensions['sticky_post_padding_left'] . 'px !important;
}

/*** Content UL\'s/OL\'s ***/

#content .post ul, #content .page ul, #content article ul, .catalyst-widget-area ul, #content .post ol, #content .page ol, #content article ol, .catalyst-widget-area ol {
	margin: 0;
	padding: 0 0 15px 0;
}
#content .post ul li, #content .page ul li, #content article ul li, #content .post ol li, #content .page ol li, #content article ol li, .catalyst-widget-area ul li, .catalyst-widget-area ol li {
	margin: 0 0 0 20px;
	padding: 0 0 ' . $catalyst_dimensions['content_list_style_padding_bottom'] . 'px;
}
#content .post ul li, #content .page ul li, #content article ul li, .catalyst-widget-area ul li {
	margin: 0 0 0 ' . $content_list_style_left_margin . 'px;
	list-style-type: ' . $content_list_style . ';
}
#content .post ul ul, #content .page ul ul, #content article ul ul, .catalyst-widget-area ul ul {
	padding: 0 0 0 20px;
}
#content .post ol ol, #content .page ol ol, #content article ol ol, .catalyst-widget-area ol ol {
	padding: 0;
}

/*** Blockquote ***/

#content blockquote {
	' . $blockquote_bg . '
	border-top: ' . $blockquote_tb_border_thickness . 'px ' . $blockquote_border_style . ' #' . $blockquote_border_color . ';
	border-bottom: ' . $blockquote_tb_border_thickness . 'px ' . $blockquote_border_style . ' #' . $blockquote_border_color . ';
	border-left: ' . $blockquote_left_border_thickness . 'px ' . $blockquote_border_style . ' #' . $blockquote_border_color . ';
	border-right: ' . $blockquote_right_border_thickness . 'px ' . $blockquote_border_style . ' #' . $blockquote_border_color . ';
	margin: 0 25px 15px 25px;
	padding: 10px 15px 0 15px;
}
#content blockquote p {
	color: #' . $blockquote_font_color . ' !important;
	font-family: ' . $blockquote_font_type . ' !important;
	font-size: ' . $blockquote_font_size . ' !important;
	' . $blockquote_font_css . '
}
#content blockquote a, #content blockquote a:visited {
	color: #' . $blockquote_link_color . ' !important;
	text-decoration: ' . $blockquote_link_underline_visited . ' !important;
}
#content blockquote a:hover {
	color: #' . $blockquote_link_hover_color . ' !important;
	text-decoration: ' . $blockquote_link_underline_hover . ' !important;
}

/*** Meta Classes ***/

.byline-meta {
	width: 100%;
	margin: 0 0 8px;
	color: #' . $content_byline_font_color . ';
	font-family: ' . $content_byline_font_type . ';
	font-size: ' . $content_byline_font_size . ';
	line-height: 120%;
	' . $content_byline_font_css . '
}
.byline-meta a, .byline-meta a:visited {
	color: #' . $content_byline_link_color . ';
	text-decoration: ' . $content_byline_link_underline_visited . ';
}
.byline-meta a:hover {
	color: #' . $content_byline_link_hover_color . ';
	text-decoration: ' . $content_byline_link_underline_hover . ';
}
.post-meta {
	border-top: ' . $cc_bottom_border_thickness . 'px ' . $cc_bottom_border_style . ' #' . $cc_bottom_border_color . ';
	margin: 5px 0 0;
	padding: 5px 0 0;
	font-style: italic;
	clear: both;
}
.post-meta p {
	color: #' . $post_meta_font_color . ' !important;
	font-family: ' . $post_meta_font_type . ' !important;
	font-size: ' . $post_meta_font_size . ' !important;
	' . $post_meta_font_css . '
}
.post-meta a, .post-meta a:visited {
	color: #' . $post_meta_link_color . ' !important;
	text-decoration: ' . $post_meta_link_underline_visited . ' !important;
}
.post-meta a:hover {
	color: #' . $post_meta_link_hover_color . ' !important;
	text-decoration: ' . $post_meta_link_underline_hover . ' !important;
}

/*** Post Navigation ***/

.post-nav {
	width: 100%;
	margin: 0;
	padding: ' . $catalyst_dimensions['post_nav_padding_top'] . 'px 0 ' . $catalyst_dimensions['post_nav_padding_bottom'] . 'px 0;
	overflow: hidden;
}
.post-nav ul {
	margin: 10px 0;
	padding: 0;
	list-style-type: none;
}
.post-nav li {
	display: inline;
}
.post-nav a, .post-nav a:visited {
	color: #' . $post_nav_link_color . ';
	font-family: ' . $post_nav_font_type . ';
	font-size: ' . $post_nav_font_size . ';
	text-decoration: ' . $post_nav_link_underline_visited . ';
	' . $post_nav_font_css . '
}
.post-nav a:hover {
	color: #' . $post_nav_link_hover_color . ';
	text-decoration: ' . $post_nav_link_underline_hover . ';
}
.post-nav li a, .post-nav li a:visited, .post-nav li.disabled, .post-nav li a:hover, .post-nav li.active a {
	' . $post_nav_numbered_inactive_bg . '
	border: ' . $post_nav_border_thickness . 'px ' . $post_nav_border_style . ' #' . $post_nav_border_color . ';
	margin: 0 ' . $catalyst_dimensions['post_nav_numbered_margin_right'] . 'px 0 ' . $catalyst_dimensions['post_nav_numbered_margin_left'] . 'px;
	padding: ' . $catalyst_dimensions['post_nav_numbered_tb_padding'] . 'px ' . $catalyst_dimensions['post_nav_numbered_lr_padding'] . 'px ' . $catalyst_dimensions['post_nav_numbered_tb_padding'] . 'px ' . $catalyst_dimensions['post_nav_numbered_lr_padding'] . 'px;
	color: #' . $post_nav_link_color . ';
	font-family: ' . $post_nav_font_type . ';
	font-size: ' . $post_nav_font_size . ';
	text-decoration: ' . $post_nav_link_underline_visited . ';
	' . $post_nav_font_css . '
}
.post-nav li.active a, .post-nav li a:hover {
	' . $post_nav_numbered_active_bg . '
	color: #' . $post_nav_link_hover_color . ';
	text-decoration: ' . $post_nav_link_underline_visited . ';
}
.post-nav li a:hover {
	text-decoration: ' . $post_nav_link_underline_hover . ';
}

/*** Catalyst Widget Areas ***/

.catalyst-widget-area {
	' . $catalyst_widget_bg . '
	border-top: ' . $catalyst_widget_top_border_thickness . 'px ' . $catalyst_widget_border_style . ' #' . $catalyst_widget_border_color . ';
	border-bottom: ' . $catalyst_widget_bottom_border_thickness . 'px ' . $catalyst_widget_border_style . ' #' . $catalyst_widget_border_color . ';
	border-left: ' . $catalyst_widget_left_border_thickness . 'px ' . $catalyst_widget_border_style . ' #' . $catalyst_widget_border_color . ';
	border-right: ' . $catalyst_widget_right_border_thickness . 'px ' . $catalyst_widget_border_style . ' #' . $catalyst_widget_border_color . ';
	' . $catalyst_dimensions['catalyst_widget_width'] . '
	float: ' . $catalyst_dimensions['catalyst_widget_float'] . ';
	margin: ' . $catalyst_dimensions['catalyst_widget_margin_top'] . 'px ' . $catalyst_dimensions['catalyst_widget_margin_right'] . 'px ' . $catalyst_dimensions['catalyst_widget_margin_bottom'] . 'px ' . $catalyst_dimensions['catalyst_widget_margin_left'] . 'px;
	padding: ' . $catalyst_dimensions['catalyst_widget_padding_top'] . 'px ' . $catalyst_dimensions['catalyst_widget_padding_right'] . 'px ' . $catalyst_dimensions['catalyst_widget_padding_bottom'] . 'px ' . $catalyst_dimensions['catalyst_widget_padding_left'] . 'px;
	color: #' . $catalyst_widget_content_font_color . ';
	font-family: ' . $catalyst_widget_content_font_type . ';
	font-size: ' . $catalyst_widget_content_font_size . ';
	' . $catalyst_widget_content_font_css . '
}
.catalyst-widget-area h4 {
	padding: 0 0 5px !important;
	color: #' . $catalyst_widget_title_font_color . ' !important;
	font-family: ' . $catalyst_widget_title_font_type . ' !important;
	font-size: ' . $catalyst_widget_title_font_size . ' !important;
	font-weight: normal;
	line-height: 120%;
	' . $catalyst_widget_title_font_css . '
}
.catalyst-widget-area a, .catalyst-widget-area a:visited {
	color: #' . $catalyst_widget_content_link_color . ' !important;
	text-decoration: ' . $catalyst_widget_content_link_underline_visited . ' !important;
}
.catalyst-widget-area a:hover {
	color: #' . $catalyst_widget_content_link_hover_color . ' !important;
	text-decoration: ' . $catalyst_widget_content_link_underline_hover . ' !important;
}
.catalyst-widget-area #wp-calendar caption, .catalyst-widget-area #wp-calendar th {
	color: #' . $catalyst_widget_content_font_color . ';
}

/*** Catalyst Excerpt Widget ***/

.catalyst-excerpt-widget, #content .catalyst-excerpt-widget {
	margin: ' . $catalyst_dimensions['excerpt_widget_margin_top'] . 'px ' . $catalyst_dimensions['excerpt_widget_margin_right'] . 'px ' . $catalyst_dimensions['excerpt_widget_margin_bottom'] . 'px ' . $catalyst_dimensions['excerpt_widget_margin_left'] . 'px;
	padding: ' . $catalyst_dimensions['excerpt_widget_padding_top'] . 'px ' . $catalyst_dimensions['excerpt_widget_padding_right'] . 'px ' . $catalyst_dimensions['excerpt_widget_padding_bottom'] . 'px ' . $catalyst_dimensions['excerpt_widget_padding_left'] . 'px;
	float: left;
}
.catalyst-excerpt-widget .entry-content p {
	color: #' . $excerpt_widget_p_font_color . ' !important;
	font-family: ' . $excerpt_widget_p_font_type . ' !important;
	font-size: ' . $excerpt_widget_p_font_size . ' !important;
	' . $excerpt_widget_p_font_css . '
}
.catalyst-excerpt-widget .entry-content a, .catalyst-excerpt-widget .entry-content a:visited {
	color: #' . $excerpt_widget_p_link_color . ' !important;
	text-decoration: ' . $excerpt_widget_p_link_underline_visited . ' !important;
}
.catalyst-excerpt-widget .entry-content a:hover {
	color: #' . $excerpt_widget_p_link_hover_color . ' !important;
	text-decoration: ' . $excerpt_widget_p_link_underline_hover . ' !important;
}
.catalyst-excerpt-widget h2 {
	margin: 0 0 5px;
	padding: 0;
	color: #333333 !important;
	font-family: ' . $excerpt_widget_heading_font_type . ' !important;
	font-size: ' . $excerpt_widget_heading_font_size . ' !important;
	font-weight: normal;
	line-height: 120%;
	' . $excerpt_widget_heading_font_css . '
}
.catalyst-excerpt-widget h2 a, .catalyst-excerpt-widget h2 a:visited {
	color: #' . $excerpt_widget_heading_link_color . ' !important;
	text-decoration: ' . $excerpt_widget_heading_link_underline_visited . ' !important;
}
.catalyst-excerpt-widget h2 a:hover {
	color: #' . $excerpt_widget_heading_link_hover_color . ' !important;
	text-decoration: ' . $excerpt_widget_heading_link_underline_hover . ' !important;
}
.catalyst-excerpt-widget .byline-meta {
	color: #' . $excerpt_widget_byline_font_color . ';
	font-family: ' . $excerpt_widget_byline_font_type . ';
	font-size: ' . $excerpt_widget_byline_font_size . ';
	' . $excerpt_widget_byline_font_css . '
}
.catalyst-excerpt-widget .byline-meta a, .catalyst-excerpt-widget .byline-meta a:visited {
	color: #' . $excerpt_widget_byline_link_color . ' !important;
	text-decoration: ' . $excerpt_widget_byline_link_underline_visited . ' !important;
}
.catalyst-excerpt-widget .byline-meta a:hover {
	color: #' . $excerpt_widget_byline_link_hover_color . ' !important;
	text-decoration: ' . $excerpt_widget_byline_link_underline_hover . ' !important;
}

/*** Catalyst 125 Ad Widget ***/

#catalyst-125-ads {
	width: 270px;
	margin: 10px auto 0;
	padding: 0 0 5px;
}
.catalyst-125-ads-inner {
	margin-top: 5px;
}
#catalyst-125-ads span, .catalyst-125-ads-inner span {
	padding: 0 5px;
}

/*** EZ Column Styles ***/

.ez-five-sixths,
.ez-four-fifths,
.ez-four-sixths,
.ez-one-fifth,
.ez-one-fourth,
.ez-one-half,
.ez-one-sixth,
.ez-one-third,
.ez-three-fifths,
.ez-three-fourths,
.ez-three-sixths,
.ez-two-fifths,
.ez-two-fourths,
.ez-two-sixths,
.ez-two-thirds {
	padding-left: 3%;
	float: left;
}
.ez-one-half,
.ez-three-sixths,
.ez-two-fourths {
	width: 48%;
}
.ez-one-third,
.ez-two-sixths {
	width: 31%;
}
.ez-four-sixths,
.ez-two-thirds {
	width: 65%;
}
.ez-one-fourth {
	width: 22.5%;
}
.ez-three-fourths {
	width: 73.5%;
}
.ez-one-fifth {
	width: 17.4%;
}
.ez-two-fifths {
	width: 37.8%;
}
.ez-three-fifths {
	width: 58.2%;
}
.ez-four-fifths {
	width: 78.6%;
}
.ez-one-sixth {
	width: 14%;
}
.ez-five-sixths {
	width: 82%;
}
.ez-first {
	padding-left: 0 !important;
	clear: both;
}
.ez-only {
	width: 100%;
	padding-left: 0 !important;
	float: left;
}
.ez-row-wrap {
	width: 100%;
	margin-bottom: 20px;
	float: left;
	clear: both;
}
.ez-row-wrap-border {
	border-bottom: 1px solid #E8E8E8;
	width: 100%;
	margin-bottom: 15px;
	padding-bottom: 15px;
	float: left;
	clear: both;
}

/************************* 
	EZ Widget Areas
*************************/

/*** EZ Widget Area Class ***/

.ez-widget-area h4 {
	border-bottom: 1px solid #E8E8E8;
	margin: 0 0 10px;
	padding: 0 0 5px;
	color: #111111;
	font-size: 18px;
	font-weight: normal;
}
.ez-widget-area ul, .ez-widget-area ol {
	margin: 0;
	padding: 0 0 15px 0;
}
.ez-widget-area ul li, .ez-widget-area ol li {
	margin: 0 0 0 20px;
	padding: 0;
}
.ez-widget-area ul li {
	list-style-type: square;
}
.ez-widget-area ul ul, .ez-widget-area ol ol {
	padding: 0;
}

/*** EZ Home Widget Areas ***/

#home-hook-wrap {
	' . $ez_widget_home_bg . '
	border-top: ' . $ez_widget_home_tb_border_thickness . 'px ' . $ez_widget_home_border_style . ' #' . $ez_widget_home_border_color . ';
	border-bottom: ' . $ez_widget_home_tb_border_thickness . 'px ' . $ez_widget_home_border_style . ' #' . $ez_widget_home_border_color . ';
	border-left: ' . $ez_widget_home_lr_border_thickness . 'px ' . $ez_widget_home_border_style . ' #' . $ez_widget_home_border_color . ';
	border-right: ' . $ez_widget_home_lr_border_thickness . 'px ' . $ez_widget_home_border_style . ' #' . $ez_widget_home_border_color . ';
	padding: ' . $catalyst_dimensions['ez_widget_home_padding_top'] . 'px ' . $catalyst_dimensions['ez_widget_home_padding_right'] . 'px ' . $catalyst_dimensions['ez_widget_home_padding_bottom'] . 'px ' . $catalyst_dimensions['ez_widget_home_padding_left'] . 'px;
	clear: both;
}
#ez-home-container-wrap .post {
	margin: 0 0 20px;
}
#ez-home-container-wrap .post p {
	padding: 0 0 ' . $catalyst_dimensions['content_paragraph_padding_bottom'] . 'px;
}
#ez-home-container-wrap .page p {
	padding: 0 0 ' . $catalyst_dimensions['content_paragraph_padding_bottom'] . 'px;
}
#ez-home-container-wrap .ez-widget-area img.wp-post-image {
	margin-bottom: 10px !important;
}
#ez-home-container-wrap .ez-widget-area h4 {
	border-bottom: ' . $ez_widget_home_heading_bottom_border_thickness . 'px ' . $ez_widget_home_heading_bottom_border_style . ' #' . $ez_widget_home_heading_bottom_border_color . ';
	color: #' . $ez_widget_home_title_font_color . ';
	font-family: ' . $ez_widget_home_title_font_type . ';
	font-size: ' . $ez_widget_home_title_font_size . ';
	' . $ez_widget_home_title_font_css . '
}
#ez-home-container-wrap .ez-widget-area {
	color: #' . $ez_widget_home_content_font_color . ';
	font-family: ' . $ez_widget_home_content_font_type . ';
	font-size: ' . $ez_widget_home_content_font_size . ';
	' . $ez_widget_home_content_font_css . '
}
#ez-home-container-wrap .ez-widget-area a, #ez-home-container-wrap .ez-widget-area a:visited {
	color: #' . $ez_widget_home_content_link_color . ';
	text-decoration: ' . $ez_widget_home_content_link_underline_visited . ';
}
#ez-home-container-wrap .ez-widget-area a:hover {
	color: #' . $ez_widget_home_content_link_hover_color . ';
	text-decoration: ' . $ez_widget_home_content_link_underline_hover . ';
}
#ez-home-container-wrap .ez-widget-area #wp-calendar caption, #ez-home-container-wrap .ez-widget-area #wp-calendar th {
	color: #' . $ez_widget_home_content_font_color . ';
}
#ez-home-container-wrap img, #ez-home-container-wrap p img {
	max-width: 100%;
	height: auto;
}
#ez-home-container-wrap .nivoSlider img {
    max-width: none;
}
body.ez-home-sidebar #ez-home-container-wrap {
	' . $catalyst_dimensions['ez_home_container_wrap_with_sb_width_css'] . '
	' . $catalyst_dimensions['ez_home_container_wrap_with_sb_rt_spacing'] . '
	float: left;
}
body.ez-home-sidebar.home-sidebar-left #ez-home-container-wrap {
	' . $catalyst_dimensions['ez_home_container_wrap_with_sb_lft_spacing'] . '
	' . $catalyst_dimensions['ez_home_container_wrap_with_sb_rt_alt_spacing'] . '
	float: right;
}
#ez-home-top-container .ez-widget-area,
#ez-home-middle-container .ez-widget-area,
#ez-home-bottom-container .ez-widget-area {
	' . $catalyst_dimensions['ez_home_3_width'] . '
	' . $catalyst_dimensions['ez_padding_left'] . '
}
body.home-top-single #ez-home-top-container .ez-widget-area,
body.home-middle-single #ez-home-middle-container .ez-widget-area,
body.home-bottom-single #ez-home-bottom-container .ez-widget-area {
	' . $catalyst_dimensions['ez_home_container_wrap_width_css'] . '
}
body.home-top-double #ez-home-top-container .ez-widget-area,
body.home-middle-double #ez-home-middle-container .ez-widget-area,
body.home-bottom-double #ez-home-bottom-container .ez-widget-area {
	' . $catalyst_dimensions['ez_home_2_width'] . '
}
body.ez-home-wide-left-2-3 #ez-home-top-1, body.ez-home-wide-right-2-3 #ez-home-top-2,
body.ez-home-wide-left-2-3-3 #ez-home-top-1, body.ez-home-wide-right-2-3-3 #ez-home-top-2,
body.ez-home-wide-left-3-2 #ez-home-bottom-1, body.ez-home-wide-right-3-2 #ez-home-bottom-2,
body.ez-home-wide-left-3-2-3 #ez-home-middle-1, body.ez-home-wide-right-3-2-3 #ez-home-middle-2,
body.ez-home-wide-left-3-3-2 #ez-home-bottom-1, body.ez-home-wide-right-3-3-2 #ez-home-bottom-2 {
	' . $catalyst_dimensions['ez_home_wide_width'] . '
}
body.ez-home-sidebar #ez-home-top-container .ez-widget-area,
body.ez-home-sidebar #ez-home-middle-container .ez-widget-area,
body.ez-home-sidebar #ez-home-bottom-container .ez-widget-area {
	' . $catalyst_dimensions['ez_home_3_with_sb_width'] . '
}
body.home-top-single.ez-home-sidebar #ez-home-top-container .ez-widget-area,
body.home-middle-single.ez-home-sidebar #ez-home-middle-container .ez-widget-area,
body.home-bottom-single.ez-home-sidebar #ez-home-bottom-container .ez-widget-area {
	' . $catalyst_dimensions['ez_home_container_wrap_with_sb_width_css'] . '
}
body.home-top-double.ez-home-sidebar #ez-home-top-container .ez-widget-area,
body.home-middle-double.ez-home-sidebar #ez-home-middle-container .ez-widget-area,
body.home-bottom-double.ez-home-sidebar #ez-home-bottom-container .ez-widget-area {
	' . $catalyst_dimensions['ez_home_2_with_sb_width'] . '
}
body.ez-home-wide-left-2-3.ez-home-sidebar #ez-home-top-1, body.ez-home-wide-right-2-3.ez-home-sidebar #ez-home-top-2,
body.ez-home-wide-left-2-3-3.ez-home-sidebar #ez-home-top-1, body.ez-home-wide-right-2-3-3.ez-home-sidebar #ez-home-top-2,
body.ez-home-wide-left-3-2.ez-home-sidebar #ez-home-bottom-1, body.ez-home-wide-right-3-2.ez-home-sidebar #ez-home-bottom-2,
body.ez-home-wide-left-3-2-3.ez-home-sidebar #ez-home-middle-1, body.ez-home-wide-right-3-2-3.ez-home-sidebar #ez-home-middle-2,
body.ez-home-wide-left-3-3-2.ez-home-sidebar #ez-home-bottom-1, body.ez-home-wide-right-3-3-2.ez-home-sidebar #ez-home-bottom-2 {
	' . $catalyst_dimensions['ez_home_wide_with_sb_width'] . '
}
.ez-home-container-area {
	margin: 0 0 20px;
	overflow: hidden;
}
.ez-home-bottom {
	margin: 0;
}

/*** Homepage Slider Styles ***/

#ez-home-slider-container-wrap {
	margin: 0 0 20px;
	overflow: hidden;
}
#ez-home-slider-container-wrap, #ez-home-slider {
	' . $catalyst_dimensions['ez_home_slider_width'] . '
}
body.child_home #ez-home-slider-container-wrap, body.child_home #ez-home-slider {
	' . $catalyst_dimensions['ez_home_slider_child_home_width'] . '
}
body.slider-inside.ez-home-sidebar #ez-home-slider-container-wrap,
body.slider-inside.ez-home-sidebar #ez-home-slider {
	' . $catalyst_dimensions['ez_home_slider_inside_home_sb_width'] . '
}
body.double-left-sidebar.slider-inside #ez-home-slider-container-wrap,
body.double-right-sidebar.slider-inside #ez-home-slider-container-wrap,
body.double-sidebar.slider-inside #ez-home-slider-container-wrap,
body.left-sidebar.slider-inside #ez-home-slider-container-wrap,
body.right-sidebar.slider-inside #ez-home-slider-container-wrap,
body.no-sidebar.slider-inside #ez-home-slider-container-wrap,
body.double-left-sidebar.slider-inside #ez-home-slider,
body.double-right-sidebar.slider-inside #ez-home-slider,
body.double-sidebar.slider-inside #ez-home-slider,
body.left-sidebar.slider-inside #ez-home-slider,
body.right-sidebar.slider-inside #ez-home-slider,
body.no-sidebar.slider-inside #ez-home-slider {
	' . $catalyst_dimensions['ez_home_slider_cc_width'] . '
}
body.double-left-sidebar.slider-inside #ez-home-slider-container-wrap {
	' . $catalyst_dimensions['ez_home_slider_inside_dbl_lft_sb_margins'] . '
}
body.double-right-sidebar.slider-inside #ez-home-slider-container-wrap {
	' . $catalyst_dimensions['ez_home_slider_inside_dbl_rt_sb_margins'] . '
}
body.double-sidebar.slider-inside #ez-home-slider-container-wrap {
	' . $catalyst_dimensions['ez_home_slider_inside_dbl_sb_margins'] . '
}
body.left-sidebar.slider-inside #ez-home-slider-container-wrap {
	' . $catalyst_dimensions['ez_home_slider_inside_lft_sb_margins'] . '
}
body.right-sidebar.slider-inside #ez-home-slider-container-wrap {
	' . $catalyst_dimensions['ez_home_slider_inside_rt_sb_margins'] . '
}
#ez-home-slider {
	width: 100%;
	height: ' . $catalyst_dimensions['ez_home_slider_height'] . 'px;
}
#ez-home-slider .nivoSlider img {
    max-width: none;
}

/*** Homepage Sidebar Styles ***/

#ez-home-sidebar-1-wrap {
	width: 280px;
	' . $catalyst_dimensions['ez_home_sb_margin_lft'] . '
	float: right;
}
body.home-sidebar-left #ez-home-sidebar-1-wrap {
	' . $catalyst_dimensions['ez_home_sb_alt_margin_lft'] . '
	' . $catalyst_dimensions['ez_home_sb_margin_rt'] . '
	float: left;
}
#ez-home-sidebar-1 #cat, #ez-home-sidebar-1 .widget_archive select {
	width: 258px;
}

/*** EZ Feature Top Widget Areas ***/

#ez-feature-top-container-wrap {
	' . $ez_widget_feature_bg . '
	border-top: ' . $ez_widget_feature_top_border_thickness . 'px ' . $ez_widget_feature_border_style . ' #' . $ez_widget_feature_border_color . ';
	border-bottom: ' . $ez_widget_feature_bottom_border_thickness . 'px ' . $ez_widget_feature_border_style . ' #' . $ez_widget_feature_border_color . ';
	border-left: ' . $ez_widget_feature_left_border_thickness . 'px ' . $ez_widget_feature_border_style . ' #' . $ez_widget_feature_border_color . ';
	border-right: ' . $ez_widget_feature_right_border_thickness . 'px ' . $ez_widget_feature_border_style . ' #' . $ez_widget_feature_border_color . ';
}
#ez-feature-top-container {
	' . $catalyst_dimensions['ez_feature_top_container_width'] . '
	margin: 0 auto;
	padding: ' . $catalyst_dimensions['ez_widget_feature_padding_top'] . 'px ' . $catalyst_dimensions['ez_widget_feature_padding_right'] . 'px ' . $catalyst_dimensions['ez_widget_feature_padding_bottom'] . 'px ' . $catalyst_dimensions['ez_widget_feature_padding_left'] . 'px;
}
#ez-feature-top-container .ez-widget-area h4 {
	border-bottom: ' . $ez_widget_feature_heading_bottom_border_thickness . 'px ' . $ez_widget_feature_heading_bottom_border_style . ' #' . $ez_widget_feature_heading_bottom_border_color . ';
	color: #' . $ez_widget_feature_title_font_color . ';
	font-family: ' . $ez_widget_feature_title_font_type . ';
	font-size: ' . $ez_widget_feature_title_font_size . ';
	' . $ez_widget_feature_title_font_css . '
}
#ez-feature-top-container .ez-widget-area {
	' . $catalyst_dimensions['ez_feature_top_3_width'] . '
	' . $catalyst_dimensions['ez_padding_left'] . '
	color: #' . $ez_widget_feature_content_font_color . ';
	font-family: ' . $ez_widget_feature_content_font_type . ';
	font-size: ' . $ez_widget_feature_content_font_size . ';
	' . $ez_widget_feature_content_font_css . '
}
#ez-feature-top-container .ez-widget-area a, #ez-feature-top-container .ez-widget-area a:visited {
	color: #' . $ez_widget_feature_content_link_color . ';
	text-decoration: ' . $ez_widget_feature_content_link_underline_visited . ';
}
#ez-feature-top-container .ez-widget-area a:hover {
	color: #' . $ez_widget_feature_content_link_hover_color . ';
	text-decoration: ' . $ez_widget_feature_content_link_underline_hover . ';
}
#ez-feature-top-container .ez-widget-area #wp-calendar caption, #ez-feature-top-container .ez-widget-area #wp-calendar th {
	color: #' . $ez_widget_feature_content_font_color . ';
}
#ez-feature-top-container img, #ez-feature-top-container p img {
	max-width: 100%;
	height: auto;
}
#ez-feature-top-container .nivoSlider img {
    max-width: none;
}
body.ez-feature-top-1 #ez-feature-top-container .ez-widget-area {
	' . $catalyst_dimensions['ez_feature_top_1_width'] . '
}
body.ez-feature-top-2 #ez-feature-top-container .ez-widget-area {
	' . $catalyst_dimensions['ez_feature_top_2_width'] . '
}
body.ez-feature-top-4 #ez-feature-top-container .ez-widget-area {
	' . $catalyst_dimensions['ez_feature_top_4_width'] . '
}
body.ez-feature-top-wide-left-2 #ez-feature-top-1.ez-widget-area, body.ez-feature-top-wide-right-2 #ez-feature-top-2.ez-widget-area {
	' . $catalyst_dimensions['ez_feature_top_wide_width'] . '
}

/*** EZ Fat Footer Widget Areas ***/

#ez-fat-footer-container-wrap, .fat-footer-outside #ez-fat-footer-container-wrap {
	' . $ez_widget_footer_bg . '
	border-top: ' . $ez_widget_footer_top_border_thickness . 'px ' . $ez_widget_footer_border_style . ' #' . $ez_widget_footer_border_color . ';
	border-bottom: ' . $ez_widget_footer_bottom_border_thickness . 'px ' . $ez_widget_footer_border_style . ' #' . $ez_widget_footer_border_color . ';
	border-left: ' . $ez_widget_footer_left_border_thickness . 'px ' . $ez_widget_footer_border_style . ' #' . $ez_widget_footer_border_color . ';
	border-right: ' . $ez_widget_footer_right_border_thickness . 'px ' . $ez_widget_footer_border_style . ' #' . $ez_widget_footer_border_color . ';
}
#ez-fat-footer-container-wrap {
	margin: 0 0 5px;
}
.fat-footer-outside #ez-fat-footer-container-wrap {
	margin: 0;
}
#ez-fat-footer-container {
	padding: ' . $catalyst_dimensions['ez_widget_footer_padding_top'] . 'px ' . $catalyst_dimensions['ez_widget_footer_padding_right'] . 'px ' . $catalyst_dimensions['ez_widget_footer_padding_bottom'] . 'px ' . $catalyst_dimensions['ez_widget_footer_padding_left'] . 'px;
}
#ez-fat-footer-container .ez-widget-area h4 {
	border-bottom: ' . $ez_widget_footer_heading_bottom_border_thickness . 'px ' . $ez_widget_footer_heading_bottom_border_style . ' #' . $ez_widget_footer_heading_bottom_border_color . ';
	color: #' . $ez_widget_footer_title_font_color . ';
	font-family: ' . $ez_widget_footer_title_font_type . ';
	font-size: ' . $ez_widget_footer_title_font_size . ';
	' . $ez_widget_footer_title_font_css . '
}
#ez-fat-footer-container .ez-widget-area {
	' . $catalyst_dimensions['ez_fat_footer_3_width'] . '
	' . $catalyst_dimensions['ez_padding_left'] . '
	color: #' . $ez_widget_footer_content_font_color . ';
	font-family: ' . $ez_widget_footer_content_font_type . ';
	font-size: ' . $ez_widget_footer_content_font_size . ';
	' . $ez_widget_footer_content_font_css . '
}
#ez-fat-footer-container .ez-widget-area a, #ez-fat-footer-container .ez-widget-area a:visited {
	color: #' . $ez_widget_footer_content_link_color . ';
	text-decoration: ' . $ez_widget_footer_content_link_underline_visited . ';
}
#ez-fat-footer-container .ez-widget-area a:hover {
	color: #' . $ez_widget_footer_content_link_hover_color . ';
	text-decoration: ' . $ez_widget_footer_content_link_underline_hover . ';
}
#ez-fat-footer-container .ez-widget-area #wp-calendar caption, #ez-fat-footer-container .ez-widget-area #wp-calendar th {
	color: #' . $ez_widget_footer_content_font_color . ';
}
#ez-fat-footer-container img, #ez-fat-footer-container p img {
	max-width: 100%;
	height: auto;
}
#ez-fat-footer-container .nivoSlider img {
    max-width: none;
}
body.ez-fat-footer-1 #ez-fat-footer-container .ez-widget-area {
	' . $catalyst_dimensions['ez_fat_footer_1_width'] . '
}
body.ez-fat-footer-2 #ez-fat-footer-container .ez-widget-area {
	' . $catalyst_dimensions['ez_fat_footer_2_width'] . '
}
body.ez-fat-footer-4 #ez-fat-footer-container .ez-widget-area {
	' . $catalyst_dimensions['ez_fat_footer_4_width'] . '
}
body.ez-fat-footer-wide-left-2 #ez-fat-footer-1.ez-widget-area, body.ez-fat-footer-wide-right-2 #ez-fat-footer-2.ez-widget-area {
	' . $catalyst_dimensions['ez_fat_footer_wide_width'] . '
}

/************************* 
	Sidebars
*************************/

#dual-sidebar-outer {
	width: ' . $catalyst_dimensions['dual_sidebar_outer_width'] . 'px;
	' . $catalyst_dimensions['dual_sidebar_outer_margin_left'] . '
	float: right;
}
.double-left-sidebar #dual-sidebar-outer {
	' . $catalyst_dimensions['dual_sidebar_outer_margin_left_alt'] . '
	' . $catalyst_dimensions['dual_sidebar_outer_margin_right'] . '
	float: left;
}
#dual-sidebar-inner {
	width: 100%;
	float: left;
}
#sidebar-1-wrap {
	width: ' . $sb1_width . 'px;
	float: left;
}
.right-sidebar #sidebar-1-wrap {
	' . $catalyst_dimensions['sb1_rt_margins'] . '
	float: right;
}
.left-sidebar #sidebar-1-wrap {
	' . $catalyst_dimensions['sb1_lft_margins'] . '
}
.double-sidebar #sidebar-1-wrap {
	' . $catalyst_dimensions['sb1_dbl_margins'] . '
}
#sidebar-2-wrap {
	width: ' . $sb2_width . 'px;
	float: right;
}
.double-sidebar #sidebar-2-wrap {
	' . $catalyst_dimensions['sb2_dbl_margins'] . ';
}
#sidebar-1 {
	width: ' . $sb1_width . 'px;
	margin: 0;
	padding: 0;
}
#sidebar-2 {
	width: ' . $sb2_width . 'px;
	margin: 0;
	padding: 0;
}
#sidebar-1 .widget, #sidebar-2 .widget, #ez-home-sidebar-1 .widget {
	margin: 0 0 15px;
	padding: 0;
	clear: both;
}
#sidebar-1, #sidebar-2, #ez-home-sidebar-1 {
	color: #' . $sb_content_font_color . ';
	font-family: ' . $sb_content_font_type . ';
	font-size: ' . $sb_content_font_size . ';
	' . $sb_content_font_css . '
}
#sidebar-1 a, #sidebar-1 a:visited, #sidebar-2 a, #sidebar-2 a:visited, #ez-home-sidebar-1 a, #ez-home-sidebar-1 a:visited {
	color: #' . $sb_content_link_color . ';
	text-decoration: ' . $sb_content_link_underline_visited . ';
}
#sidebar-1 a:hover, #sidebar-2 a:hover, #ez-home-sidebar-1 a:hover {
	color: #' . $sb_content_link_hover_color . ';
	text-decoration: ' . $sb_content_link_underline_hover . ';
}
#sidebar-1 .widget, #sidebar-2 .widget, #ez-home-sidebar-1 .widget {
	' . $sb_content_bg . '
	border-top: ' . $sb_content_top_border_thickness . 'px ' . $sb_content_border_style . ' #' . $sb_content_border_color . ';
	border-bottom: ' . $sb_content_bottom_border_thickness . 'px ' . $sb_content_border_style . ' #' . $sb_content_border_color . ';
	border-left: ' . $sb_content_lr_border_thickness . 'px ' . $sb_content_border_style . ' #' . $sb_content_border_color . ';
	border-right: ' . $sb_content_lr_border_thickness . 'px ' . $sb_content_border_style . ' #' . $sb_content_border_color . ';
	margin: ' . $catalyst_dimensions['sb_widget_margin_top'] . 'px 0 ' . $catalyst_dimensions['sb_widget_margin_bottom'] . 'px 0;
}
#sidebar-1 h4, #sidebar-2 h4, #ez-home-sidebar-1 h4 {
	' . $sb_heading_bg . '
	border-top: ' . $sb_heading_top_border_thickness . 'px ' . $sb_heading_border_style . ' #' . $sb_heading_border_color . ';
	border-bottom: ' . $sb_heading_bottom_border_thickness . 'px ' . $sb_heading_border_style . ' #' . $sb_heading_border_color . ';
	border-left: ' . $sb_heading_lr_border_thickness . 'px ' . $sb_heading_border_style . ' #' . $sb_heading_border_color . ';
	border-right: ' . $sb_heading_lr_border_thickness . 'px ' . $sb_heading_border_style . ' #' . $sb_heading_border_color . ';
	margin: 0;
	padding: ' . $catalyst_dimensions['sb_heading_padding_top'] . 'px ' . $catalyst_dimensions['sb_heading_padding_right'] . 'px ' . $catalyst_dimensions['sb_heading_padding_bottom'] . 'px ' . $catalyst_dimensions['sb_heading_padding_left'] . 'px;
	color: #' . $sb_heading_font_color . ';
	font-family: ' . $sb_heading_font_type . ';
	font-size: ' . $sb_heading_font_size . ';
	font-weight: normal;
	' . $sb_heading_font_css . '
}
#sidebar-1 .widget p, #sidebar-2 .widget p, #ez-home-sidebar-1 .widget p {
	margin: 0;
	padding: 0;
}
#sidebar-1 .textwidget, #sidebar-2 .textwidget, #sidebar-1 .php-textwidget, #sidebar-2 .php-textwidget, #sidebar-1 .widget_tag_cloud div div, #sidebar-2 .widget_tag_cloud div div, #sidebar-1 .catalyst-excerpt-widget-inner, #sidebar-2 .catalyst-excerpt-widget-inner, #sidebar-1 .author-bio-widget, #sidebar-2 .author-bio-widget,
#ez-home-sidebar-1 .textwidget, #ez-home-sidebar-1 .php-textwidget, #ez-home-sidebar-1 .widget_tag_cloud div div, #ez-home-sidebar-1 .catalyst-excerpt-widget-inner, #ez-home-sidebar-1 .author-bio-widget {
	padding: ' . $catalyst_dimensions['sb_content_padding_top'] . 'px ' . $catalyst_dimensions['sb_content_padding_right'] . 'px ' . $catalyst_dimensions['sb_content_padding_bottom'] . 'px ' . $catalyst_dimensions['sb_content_padding_left'] . 'px;
}
#sidebar-1 #wp-calendar caption, #sidebar-2 #wp-calendar caption, #sidebar-1 #wp-calendar th, #sidebar-2 #wp-calendar th, #ez-home-sidebar-1 #wp-calendar caption, #ez-home-sidebar-1 #wp-calendar th {
	color: #' . $sb_content_font_color . ';
}
#cat, .widget_archive select, #sidebar-1 .widget_archive select, #sidebar-2 .widget_archive select, #ez-home-sidebar-1 .widget_archive select {
	background: #F6F6F6;
	border: 1px solid #E8E8E8;
	margin: 10px 0 10px 10px;
	padding: 3px;
	font-size: 12px;
	display: inline;
}
#sidebar-1 #cat, #sidebar-1 .widget_archive select {
	width: ' . $catalyst_dimensions['sb1_cat_width'] . 'px;
}
#sidebar-2 #cat, #sidebar-2 .widget_archive select {
	width: ' . $catalyst_dimensions['sb2_cat_width'] . 'px;
}
#sidebar-1 a img, #sidebar-2 a img, #ez-home-sidebar-1 a img {
	border: none;
	margin: 0;
	padding: 0;
}
#sidebar-1 ul li, #sidebar-2 ul li, #ez-home-sidebar-1 ul li {
	list-style-type: ' . $sb_list_style . ';
}
#sidebar-1 ol li, #sidebar-2 ol li, #ez-home-sidebar-1 ol li {
	list-style-type: decimal;
}
#sidebar-1 ul, #sidebar-1 ol, #sidebar-2 ul, #sidebar-2 ol, #ez-home-sidebar-1 ul, #ez-home-sidebar-1 ol {
	margin: 0;
	padding: ' . $catalyst_dimensions['sb_ul_padding_top'] . 'px ' . $catalyst_dimensions['sb_ul_padding_right'] . 'px ' . $catalyst_dimensions['sb_ul_padding_bottom'] . 'px ' . $catalyst_dimensions['sb_ul_padding_left'] . 'px;
}
#sidebar-1 .searchform, #sidebar-2 .searchform, #ez-home-sidebar-1 .searchform {
	padding: 0 ' . $catalyst_dimensions['sb_search_form_padding_right'] . 'px 0 ' . $catalyst_dimensions['sb_search_form_padding_left'] . 'px;
}
#sidebar-1 ul ul, #sidebar-1 ol ol, #sidebar-2 ul ul, #sidebar-2 ol ol, #ez-home-sidebar-1 ul ul, #ez-home-sidebar-1 ol ol {
	margin: 0;
	padding: 0 0 0 15px;
}

/*** Sidebar Pages Widget ***/

.widget_pages {
	color: #' . $sb_pages_font_color . ';
	font-family: ' . $sb_pages_font_type . ';
	font-size: ' . $sb_pages_font_size . ';
	' . $sb_pages_font_css . '
}
.widget_pages a, .widget_pages a:visited {
	color: #' . $sb_pages_link_color . ' !important;
	text-decoration: ' . $sb_pages_link_underline_visited . ' !important;
}
.widget_pages a:hover {
	color: #' . $sb_pages_link_hover_color . ' !important;
	text-decoration: ' . $sb_pages_link_underline_hover . ' !important;
}
' . $sb_pages_heading_display . '

/************************* 
	Comments
*************************/

#comment-wrap {
	' . $comment_wrap_bg . '
	border: ' . $comment_wrap_border_thickness . 'px ' . $comment_wrap_border_style . ' #' . $comment_wrap_border_color . ';
	margin: ' . $catalyst_dimensions['comment_wrap_margin_top'] . 'px 0 ' . $catalyst_dimensions['comment_wrap_margin_bottom'] . 'px 0;
	padding: ' . $catalyst_dimensions['comment_wrap_padding_top'] . 'px ' . $catalyst_dimensions['comment_wrap_padding_right'] . 'px ' . $catalyst_dimensions['comment_wrap_padding_bottom'] . 'px ' . $catalyst_dimensions['comment_wrap_padding_left'] . 'px;
}
#comment, #author, #email, #url {
	margin: 10px 0 5px;
	padding: 3px 0 3px 5px;
	font-weight: normal;
	display: inline;
}
#author, #email, #url {
	margin: 10px 0 0;
}
#respond {
	display: block;
}
#respond:after {
	visibility: hidden;
	display: block;
	height: 0;
	font-size: 0;
	line-height: 0;
	content: " ";
	clear: both;
}
#commentform {
	margin: 5px 10px 0 0;
}
#commentform #author, #commentform #email, #commentform #url {
	width: ' . $catalyst_dimensions['comment_author_email_url_width'] . 'px;
}
#commentform textarea {
	width: ' . $catalyst_dimensions['comment_form_width'] . ';
}
#commentform textarea, #commentform #author, #commentform #email, #commentform #url {
	' . $comment_form_bg . '
	border: ' . $comment_form_border_thickness . 'px ' . $comment_form_border_style . ' #' . $comment_form_border_color . ';
	color: #' . $comment_form_font_color . ';
	font-family: ' . $comment_form_font_type . ';
	font-size: ' . $comment_form_font_size . ';
	' . $comment_form_font_css . '
}
#commentform p {
	margin: 5px 0;
}
#commentform #submit {
	' . $comment_submit_bg . '
	border: ' . $comment_submit_border_thickness . 'px ' . $comment_submit_border_style . ' #' . $comment_submit_border_color . ';
	width: ' . $catalyst_dimensions['comment_submit_width'] . 'px;
	padding: ' . $catalyst_dimensions['submit_button_padding_top'] . 'px ' . $catalyst_dimensions['submit_button_padding_right'] . 'px ' . $catalyst_dimensions['submit_button_padding_bottom'] . 'px ' . $catalyst_dimensions['submit_button_padding_left'] . 'px;
	color: #' . $comment_submit_font_color . ';
	font-family: ' . $comment_submit_font_type . ';
	font-size: ' . $comment_submit_font_size . ';
	float: left;
	cursor: pointer;
	text-decoration: ' . $submit_link_underline_visited . ';
	' . $comment_submit_font_css . '
}
#commentform #submit:hover {
	' . $comment_submit_hover_bg . '
	border: ' . $comment_submit_hover_border_thickness . 'px ' . $comment_submit_hover_border_style . ' #' . $comment_submit_hover_border_color . ';
	color: #' . $submit_text_hover_color . ';
	text-decoration: ' . $submit_link_underline_hover . ';
}
#commentform input {
	width: 200px;
	margin: 5px 5px 1px 0;
	padding: 2px;
}
.commentlist li .avatar {
	' . $comment_avatar_bg . '
	border: ' . $comment_avatar_border_thickness . 'px ' . $comment_avatar_border_style . ' #' . $comment_avatar_border_color . ';
	width: ' . $catalyst_dimensions['comment_avatar_size'] . 'px;
	height: ' . $catalyst_dimensions['comment_avatar_size'] . 'px;
	margin: 0 5px 0 10px;
	padding: ' . $catalyst_dimensions['comment_avatar_padding'] . 'px;
	float: right;
}
.commentlist cite, .commentlist cite a, .commentlist .says {
	font-size: 12px;
	font-weight: bold;
	font-style: normal;
}
.commentlist p {
	margin: 10px 5px 10px 0;
	font-weight: normal;
	text-transform: none;
}
.commentlistmetadata {
	font-weight: normal;
}
.comment-body-text, .commentlist p, .reply, #respond p {
	color: #' . $comment_body_font_color . ';
	font-family: ' . $comment_body_font_type . ';
	font-size: ' . $comment_body_font_size . ';
	' . $comment_body_font_css . '
}
#reply-title, .comment-heading {
	color: #' . $comment_heading_font_color . ' !important;
	font-family: ' . $comment_heading_font_type . ' !important;
	font-size: ' . $comment_heading_font_size . ' !important;
	' . $comment_heading_font_css . '
}
.comment-author {
	color: #' . $comment_author_font_color . ';
	font-family: ' . $comment_author_font_type . ';
}
.comment-author cite, .comment-author cite a, .comment-author .says {
	font-size: ' . $comment_author_font_size . ';
	' . $comment_author_font_css . '
}
.commentmetadata {
	color: #' . $comment_meta_link_color . ';
	font-family: ' . $comment_meta_font_type . ';
	font-size: ' . $comment_meta_font_size . ';
	' . $comment_meta_font_css . '
}
.commentmetadata a, .commentmetadata a:visited {
	color: #' . $comment_meta_link_color . ' !important;
	text-decoration: ' . $comment_meta_link_underline_visited . ' !important;
}
.commentmetadata a:hover {
	color: #' . $comment_meta_link_hover_color . ' !important;
	text-decoration: ' . $comment_meta_link_underline_hover . ' !important;
}
.commentlist a, .commentlist a:visited, .comments-nav a, .comments-nav a:visited, #respond a, #respond a:visited {
	color: #' . $comment_link_color . ';
	text-decoration: ' . $comment_link_underline_visited . ';
}
.commentlist a:hover, .comments-nav a:hover, #respond a:hover {
	color: #' . $comment_link_hover_color . ';
	text-decoration: ' . $comment_link_underline_hover . ';
}
.comment-list, .children {
	margin: 0;
	padding: 0;
}
.commentlist ol {
	padding: 10px;
}
.commentlist li {
	margin: ' . $catalyst_dimensions['comment_list_margin_top'] . 'px 0 ' . $catalyst_dimensions['comment_list_margin_bottom'] . 'px 0;
	padding: ' . $catalyst_dimensions['comment_list_padding_top'] . 'px ' . $catalyst_dimensions['comment_list_padding_right'] . 'px ' . $catalyst_dimensions['comment_list_padding_bottom'] . 'px ' . $catalyst_dimensions['comment_list_padding_left'] . 'px;
	list-style: none;
}
.commentlist li ul li {
	' . $comment_reply_bg . '
	margin-left: 10px;
	margin-right: -5px;
}
.nocomments {
	text-align: center;
}
.comments-nav {
	margin: ' . $catalyst_dimensions['comments_nav_margin_top'] . 'px 0 ' . $catalyst_dimensions['comments_nav_margin_bottom'] . 'px 0;
}
.thread-even {
	' . $comment_even_bg . '
}
.thread-odd {
	' . $comment_odd_bg . '
}
.even, .alt {
	border-top: ' . $comment_body_top_border_thickness . 'px ' . $comment_body_border_style . ' #' . $comment_body_border_color . ';
	border-bottom: ' . $comment_body_bottom_border_thickness . 'px ' . $comment_body_border_style . ' #' . $comment_body_border_color . ';
	border-left: ' . $comment_body_lr_border_thickness . 'px ' . $comment_body_border_style . ' #' . $comment_body_border_color . ';
	border-right: ' . $comment_body_lr_border_thickness . 'px ' . $comment_body_border_style . ' #' . $comment_body_border_color . ';
}
.commentlist .depth-2, .commentlist .depth-3, .commentlist .depth-4, .commentlist .depth-5, .commentlist .depth-6 {
	border-top: ' . $comment_body_top_border_thickness . 'px ' . $comment_body_border_style . ' #' . $comment_body_border_color . ';
	border-bottom: ' . $comment_body_bottom_border_thickness . 'px ' . $comment_body_border_style . ' #' . $comment_body_border_color . ';
	border-left: ' . $comment_body_lr_border_thickness . 'px ' . $comment_body_border_style . ' #' . $comment_body_border_color . ';
	border-right: 0;
}

/************************* 
	Footer
*************************/

#footer-wrap {
	' . $footer_bg . '
	border-top: ' . $footer_top_border_thickness . 'px ' . $footer_border_style . ' #' . $footer_border_color . ';
	border-bottom: ' . $footer_bottom_border_thickness . 'px ' . $footer_border_style . ' #' . $footer_border_color . ';
	border-left: ' . $footer_lr_border_thickness . 'px ' . $footer_border_style . ' #' . $footer_border_color . ';
	border-right: ' . $footer_lr_border_thickness . 'px ' . $footer_border_style . ' #' . $footer_border_color . ';
	margin: 0 auto;
	clear: both;
}
#footer {
	' . $catalyst_dimensions['footer_width'] . '
	height: ' . $catalyst_dimensions['footer_height'] . ';
	margin: 0 auto;
	padding: ' . $catalyst_dimensions['footer_padding_top'] . 'px 0 ' . $catalyst_dimensions['footer_padding_bottom'] . 'px 0;
	clear: both;
	float: none;
	display: block;
}
#footer p.footer-content {
	color: #' . $footer_font_color . ';
	font-family: ' . $footer_font_type . ';
	font-size: ' . $footer_font_size . ';
	' . $footer_font_css . '
}
#footer .footer-content a, #footer .footer-content a:visited {
	color: #' . $footer_link_color . ';
	text-decoration: ' . $footer_link_underline_visited . ';
}
#footer .footer-content a:hover {
	color: #' . $footer_link_hover_color . ';
	text-decoration: ' . $footer_link_underline_hover . ';
}
.footer-left {
	padding: ' . $catalyst_dimensions['footer_left_padding_top'] . 'px ' . $catalyst_dimensions['footer_left_padding_right'] . 'px ' . $catalyst_dimensions['footer_left_padding_bottom'] . 'px ' . $catalyst_dimensions['footer_left_padding_left'] . 'px !important;
	float: left;
}
.footer-right {
	padding: ' . $catalyst_dimensions['footer_right_padding_top'] . 'px ' . $catalyst_dimensions['footer_right_padding_right'] . 'px ' . $catalyst_dimensions['footer_right_padding_bottom'] . 'px ' . $catalyst_dimensions['footer_right_padding_left'] . 'px !important;
	float: right;
}
.footer-center {
	padding: ' . $catalyst_dimensions['footer_center_padding_top'] . 'px ' . $catalyst_dimensions['footer_center_padding_right'] . 'px ' . $catalyst_dimensions['footer_center_padding_bottom'] . 'px ' . $catalyst_dimensions['footer_center_padding_left'] . 'px !important;
	text-align: center;
	clear: both;
}
.catalyst-attribute {
	font-style: italic;
}
';

	if( $remove_elements != '' )
	{	
		$css .= '
/************************* 
	Remove Elements Styles
*************************/

' . $remove_elements . $remove_elements_css . "\n";
	}

	if( $child == 'no' || $child == 'mysite' )
	{	
		$catalyst_custom_layout_css = catalyst_custom_layout_css();
		$css .= '
/************************* 
	Custom Layout Dimensions
*************************/
' . $catalyst_custom_layout_css;
	}
	elseif( $child == 'distribution' )
	{	
		$catalyst_child_content_widths = catalyst_child_content_widths( $catalyst_dimensions );
		$css .= '
/************************* 
	Child Theme Content Widths
*************************/
' . $catalyst_child_content_widths;
	}
	
	if( !empty( $dynamik_responsive ) )
	{
		$catalyst_custom_layout_media_query_css = catalyst_custom_layout_media_query_css();
		$css .= '
' . $catalyst_custom_layout_media_query_css;

		$css .= "\n" . '
/************************* 
	Default Responsive Styles
*************************/
';

		$css .= '
@media screen and (min-device-width: 320px) and (max-device-width: 1024px)
{
/* CSS for iPhone and iPad only */
html { -webkit-text-size-adjust: none; /* Prevent font scaling in landscape */ }
}

@media only screen and (max-width: ' . catalyst_get_responsive( 'media_wrap_width' ) . 'px) {
' . $wrap_mq_first . $header_mq_first . $navbar_mq_first . $content_mq_first . $ez_mq_first . $footer_mq_first . $media_query_large_cascading_content . '
}

@media only screen and (min-width: 768px) and (max-width: ' . catalyst_get_responsive( 'media_wrap_width' ) . 'px) {
' . $content_mq_second . $ez_mq_second . $media_query_large_content . '
}

@media only screen and (min-width: 480px) and (max-width: ' . catalyst_get_responsive( 'media_wrap_width' ) . 'px) {
' . $media_query_medium_large_content . '
}

@media only screen and (max-width: 767px) {
' . $content_mq_fourth . $ez_mq_fourth . $media_query_medium_cascading_content . '
}

@media only screen and (min-width: 480px) and (max-width: 767px) {
' . $media_query_medium_content . '
}

@media only screen and (max-width: 479px) {
' . $navbar_mq_sixth . $media_query_small_content . '
}';
	}
	
	return $css;
}

/**
 * Calculate the child content width CSS dimensions based on the current Dynamik settings.
 *
 * @since 1.0
 * @return the child content width CSS dimensions based on the current Dynamik settings.
 */
function catalyst_child_content_widths( $catalyst_dimensions )
{
	$dynamik_responsive = catalyst_get_core( 'dynamik_responsive' );
	$no_sidebar_content_wrap = !empty( $dynamik_responsive ) ? 'width: 100%;' : 'width: ' . ( $catalyst_dimensions['wrap_width'] - ( $catalyst_dimensions['container_wrap_lr_padding'] * 2 ) ) . 'px;';
	$no_sidebar_content = !empty( $dynamik_responsive ) ? '' : 'width: ' . ( $catalyst_dimensions['wrap_width'] - ( $catalyst_dimensions['container_wrap_lr_padding'] * 2 ) ) . 'px;';
	$single_sidebar_content_wrap = !empty( $dynamik_responsive ) ? 'width: 100%;' : 'width: ' . ( $catalyst_dimensions['wrap_width'] - ( $catalyst_dimensions['container_wrap_lr_padding'] * 2 ) - $catalyst_dimensions['sb_separation_padding'] - $catalyst_dimensions['sb1_width'] ) . 'px;';
	$single_sidebar_content = !empty( $dynamik_responsive ) ? '' : 'width: ' . ( $catalyst_dimensions['wrap_width'] - ( $catalyst_dimensions['container_wrap_lr_padding'] * 2 ) - $catalyst_dimensions['sb_separation_padding'] - $catalyst_dimensions['sb1_width'] ) . 'px;';
	$double_sidebar_content_wrap = !empty( $dynamik_responsive ) ? 'width: 100%;' : 'width: ' . ( $catalyst_dimensions['wrap_width'] - ( $catalyst_dimensions['container_wrap_lr_padding'] * 2 ) - ( $catalyst_dimensions['sb_separation_padding'] * 2 ) - $catalyst_dimensions['sb1_width'] - $catalyst_dimensions['sb2_width'] ) . 'px;';
	$double_sidebar_content = !empty( $dynamik_responsive ) ? '' : 'width: ' . ( $catalyst_dimensions['wrap_width'] - ( $catalyst_dimensions['container_wrap_lr_padding'] * 2 ) - ( $catalyst_dimensions['sb_separation_padding'] * 2 ) - $catalyst_dimensions['sb1_width'] - $catalyst_dimensions['sb2_width'] ) . 'px;';
	
	$child_content_css = '
.no-sidebar #content-wrap { ' . $no_sidebar_content_wrap . ' }
.no-sidebar #content { ' . $no_sidebar_content . ' }
.left-sidebar #content-wrap, .right-sidebar #content-wrap { ' . $single_sidebar_content_wrap . ' }
.left-sidebar #content, .right-sidebar #content { ' . $single_sidebar_content . ' }
.double-sidebar #content-wrap, .double-left-sidebar #content-wrap, .double-right-sidebar #content-wrap { width:' . $double_sidebar_content_wrap . 'px; }
.double-sidebar #content, .double-left-sidebar #content, .double-right-sidebar #content { width:' . $double_sidebar_content . 'px; }
';
	return $child_content_css;
}

/**
 * Calculate the Custom Layout CSS based on the current Dynamik settings.
 *
 * @since 1.0
 * @return the Custom Layout CSS based on the current Dynamik settings.
 */
function catalyst_custom_layout_css()
{
	$custom_layouts = catalyst_get_layouts();
	if( !empty( $custom_layouts ) )
	{
		$custom_layout_css = '';
		
		foreach( $custom_layouts as $custom_layout )
		{
			$custom_dimensions = catalyst_dimensions( $custom_layout['type'], $custom_layout['content_width'], $custom_layout['sb1_width'], $custom_layout['sb2_width'] );
			$custom_layout_id = $custom_layout['layout_id'];
			
			$dynamik_responsive = catalyst_get_core( 'dynamik_responsive' ) ? 1 : 0;
			$width = !empty( $dynamik_responsive ) ? 'max-width: ' : 'width: ';
			
			$custom_dimensions['ez_home_slider_container_width'] = !empty( $dynamik_responsive ) ? '' : 'width: ' . $custom_dimensions['container_width'] . 'px;';
			$custom_dimensions['ez_home_slider_inside_container_width'] = !empty( $dynamik_responsive ) ? '' : 'width: ' . $custom_dimensions['cc_width'] . 'px;';
			
			$custom_dimensions['ez_widget_feature_border_thickness'] = catalyst_get_dynamik( 'ez_widget_feature_border_thickness' );
			if( catalyst_get_dynamik( 'ez_widget_feature_border_type' ) == 'Full' || catalyst_get_dynamik( 'ez_widget_feature_border_type' ) == 'Left/Right' )
			{
				$custom_dimensions['ez_widget_feature_lr_border_thickness'] = $custom_dimensions['ez_widget_feature_border_thickness'] * 2;
			}
			else
			{
				$custom_dimensions['ez_widget_feature_lr_border_thickness'] = 0;
			}
			
			$custom_dimensions['ez_feature_top_lr_padding'] = catalyst_get_dynamik( 'ez_widget_feature_padding_left' ) + catalyst_get_dynamik( 'ez_widget_feature_padding_right' );
			$custom_dimensions['ez_feature_top_total_width'] = $custom_dimensions['wrap_width'] - $custom_dimensions['ez_feature_top_lr_padding'] - $custom_dimensions['ez_widget_feature_lr_border_thickness'];
			$custom_dimensions['ez_feature_top_4_width'] = !empty( $dynamik_responsive ) ? '' : 'width: ' . ( ( $custom_dimensions['ez_feature_top_total_width'] / 4 ) - 22 ) . 'px;';
			$custom_dimensions['ez_feature_top_3_width'] = !empty( $dynamik_responsive ) ? '' : 'width: ' . ( ( $custom_dimensions['ez_feature_top_total_width'] / 3 ) - 20 ) . 'px;';
			$custom_dimensions['ez_feature_top_2_width'] = !empty( $dynamik_responsive ) ? '' : 'width: ' . ( ( $custom_dimensions['ez_feature_top_total_width'] / 2 ) - 15 ) . 'px;';
			$custom_dimensions['ez_feature_top_1_width'] = !empty( $dynamik_responsive ) ? '' : 'width: ' . $custom_dimensions['ez_feature_top_total_width'] . 'px;';
			$custom_dimensions['ez_feature_top_wide_width'] = !empty( $dynamik_responsive ) ? '' : 'width: ' . ( ( ( $custom_dimensions['ez_feature_top_total_width'] / 3 ) * 2 ) - 11 ) . 'px;';
			
			$custom_dimensions['ez_widget_footer_border_thickness'] = catalyst_get_dynamik( 'ez_widget_footer_border_thickness' );
			if( catalyst_get_dynamik( 'ez_widget_footer_border_type' ) == 'Full' || catalyst_get_dynamik( 'ez_widget_footer_border_type' ) == 'Left/Right' )
			{
				$custom_dimensions['ez_widget_footer_lr_border_thickness'] = $custom_dimensions['ez_widget_footer_border_thickness'] * 2;
			}
			else
			{
				$custom_dimensions['ez_widget_footer_lr_border_thickness'] = 0;
			}
			
			$custom_dimensions['ez_fat_footer_lr_padding'] = catalyst_get_dynamik( 'ez_widget_footer_padding_left' ) + catalyst_get_dynamik( 'ez_widget_footer_padding_right' );
			$custom_dimensions['ez_fat_footer_total_width'] = $custom_dimensions['wrap_width'] - $custom_dimensions['ez_fat_footer_lr_padding'] - $custom_dimensions['ez_widget_footer_lr_border_thickness'];
			$custom_dimensions['ez_fat_footer_4_width'] = !empty( $dynamik_responsive ) ? '' : 'width: ' . ( ( $custom_dimensions['ez_fat_footer_total_width'] / 4 ) - 22 ) . 'px;';
			$custom_dimensions['ez_fat_footer_3_width'] = !empty( $dynamik_responsive ) ? '' : 'width: ' . ( ( $custom_dimensions['ez_fat_footer_total_width'] / 3 ) - 20 ) . 'px;';
			$custom_dimensions['ez_fat_footer_2_width'] = !empty( $dynamik_responsive ) ? '' : 'width: ' . ( ( $custom_dimensions['ez_fat_footer_total_width'] / 2 ) - 15 ) . 'px;';
			$custom_dimensions['ez_fat_footer_1_width'] = !empty( $dynamik_responsive ) ? '' : 'width: ' . $custom_dimensions['ez_fat_footer_total_width'] . 'px;';
			$custom_dimensions['ez_fat_footer_wide_width'] = !empty( $dynamik_responsive ) ? '' : 'width: ' . ( ( ( $custom_dimensions['ez_fat_footer_total_width'] / 3 ) * 2 ) - 11 ) . 'px;';
			
			$custom_layout_css .= '
.' . $custom_layout_id . ' #wrap { ' . $width . $custom_dimensions['wrap_width'] . 'px; }
.' . $custom_layout_id . ' #header { ' . $width . $custom_dimensions['header_width'] . 'px; }
.' . $custom_layout_id . '.header-left-full-width #header-left, .' . $custom_layout_id . '.header-left-full-width #header-left #title, .' . $custom_layout_id . '.header-left-full-width #header-left #title a { width: ' . $custom_dimensions['header_left_full_width'] . '; }
.' . $custom_layout_id . ' #navbar-1 { ' . $custom_dimensions['nav1_width'] . ' }
.' . $custom_layout_id . ' #navbar-2 { ' . $custom_dimensions['nav2_width'] . ' }
.' . $custom_layout_id . ' #container { ' . $width . $custom_dimensions['container_width'] . 'px; }
.' . $custom_layout_id . ' #ez-home-slider-container-wrap, .' . $custom_layout_id . ' #ez-home-slider { ' . $custom_dimensions['ez_home_slider_container_width'] . ' }
.' . $custom_layout_id . ' #content-sidebar-wrap { width: ' . $custom_dimensions['content_sb_wrap_width'] . '; }
.' . $custom_layout_id . '.double-sidebar #content-sidebar-wrap { ' . $custom_dimensions['content_sb_wrap_alt_width'] . ' }
.' . $custom_layout_id . ' #content-wrap, .' . $custom_layout_id . '.left-sidebar #content-wrap, .' . $custom_layout_id . '.right-sidebar #content-wrap, .' . $custom_layout_id . '.no-sidebar #content-wrap { ' . $custom_dimensions['content_wrap_width'] . ' }
.' . $custom_layout_id . ' #content, .' . $custom_layout_id . '.left-sidebar #content, .' . $custom_layout_id . '.right-sidebar #content, .' . $custom_layout_id . '.no-sidebar #content { ' . $custom_dimensions['cc_width_css'] . ' }
.' . $custom_layout_id . ' #content { margin: ' . $custom_dimensions['content_margins'] . '; }
.' . $custom_layout_id . '.double-left-sidebar #content { ' . $custom_dimensions['content_margins_dbl_lft_sb'] . ' }
.' . $custom_layout_id . '.right-sidebar #content { ' . $custom_dimensions['content_margins_rt_sb'] . ' }
.' . $custom_layout_id . '.left-sidebar #content { ' . $custom_dimensions['content_margins_lft_sb'] . ' }
.' . $custom_layout_id . '.double-sidebar #content { ' . $custom_dimensions['content_margins_dbl_sb'] . ' }
.' . $custom_layout_id . '.no-sidebar #content { ' . $custom_dimensions['content_margins_no_sb'] . ' }
body.' . $custom_layout_id . '.slider-inside #ez-home-slider-container-wrap, .' . $custom_layout_id . '.slider-inside #ez-home-slider { ' . $custom_dimensions['ez_home_slider_inside_container_width'] . ' }
body.' . $custom_layout_id . '.double-left-sidebar.slider-inside #ez-home-slider-container-wrap { ' . $custom_dimensions['ez_home_slider_inside_dbl_lft_sb_margins'] . ' }
body.' . $custom_layout_id . '.double-right-sidebar.slider-inside #ez-home-slider-container-wrap { ' . $custom_dimensions['ez_home_slider_inside_dbl_rt_sb_margins'] . ' }
body.' . $custom_layout_id . '.double-sidebar.slider-inside #ez-home-slider-container-wrap { ' . $custom_dimensions['ez_home_slider_inside_dbl_sb_margins'] . ' }
body.' . $custom_layout_id . '.left-sidebar.slider-inside #ez-home-slider-container-wrap { ' . $custom_dimensions['ez_home_slider_inside_lft_sb_margins'] . ' }
body.' . $custom_layout_id . '.right-sidebar.slider-inside #ez-home-slider-container-wrap { ' . $custom_dimensions['ez_home_slider_inside_rt_sb_margins'] . ' }
.' . $custom_layout_id . ' #ez-feature-top-container { ' . $custom_dimensions['ez_feature_top_container_width'] . ' }
.' . $custom_layout_id . ' #ez-feature-top-container .ez-widget-area { ' . $custom_dimensions['ez_feature_top_3_width'] . ' }
.' . $custom_layout_id . '.ez-feature-top-1 #ez-feature-top-container .ez-widget-area { ' . $custom_dimensions['ez_feature_top_1_width'] . ' }
.' . $custom_layout_id . '.ez-feature-top-2 #ez-feature-top-container .ez-widget-area { ' . $custom_dimensions['ez_feature_top_2_width'] . ' }
.' . $custom_layout_id . '.ez-feature-top-4 #ez-feature-top-container .ez-widget-area { ' . $custom_dimensions['ez_feature_top_4_width'] . ' }
.' . $custom_layout_id . '.ez-feature-top-wide-left-2 #ez-feature-top-1.ez-widget-area, .' . $custom_layout_id . '.ez-feature-top-wide-right-2 #ez-feature-top-2.ez-widget-area { ' . $custom_dimensions['ez_feature_top_wide_width'] . ' }
.' . $custom_layout_id . ' #ez-fat-footer-container .ez-widget-area { ' . $custom_dimensions['ez_fat_footer_3_width'] . ' }
.' . $custom_layout_id . '.ez-fat-footer-1 #ez-fat-footer-container .ez-widget-area { ' . $custom_dimensions['ez_fat_footer_1_width'] . ' }
.' . $custom_layout_id . '.ez-fat-footer-2 #ez-fat-footer-container .ez-widget-area { ' . $custom_dimensions['ez_fat_footer_2_width'] . ' }
.' . $custom_layout_id . '.ez-fat-footer-4 #ez-fat-footer-container .ez-widget-area { ' . $custom_dimensions['ez_fat_footer_4_width'] . ' }
.' . $custom_layout_id . '.ez-fat-footer-wide-left-2 #ez-fat-footer-1.ez-widget-area, .' . $custom_layout_id . '.ez-fat-footer-wide-right-2 #ez-fat-footer-2.ez-widget-area { ' . $custom_dimensions['ez_fat_footer_wide_width'] . ' }
.' . $custom_layout_id . ' #dual-sidebar-outer { width: ' . $custom_dimensions['dual_sidebar_outer_width'] . 'px; ' . $custom_dimensions['dual_sidebar_outer_margin_left'] . ' }
.' . $custom_layout_id . '.double-left-sidebar #dual-sidebar-outer { 	' . $custom_dimensions['dual_sidebar_outer_margin_left_alt'] . ' ' . $custom_dimensions['dual_sidebar_outer_margin_right'] . ' }
.' . $custom_layout_id . ' #sidebar-1-wrap, .' . $custom_layout_id . ' #sidebar-1 { width: ' . $custom_dimensions['sb1_width'] . 'px; }
.' . $custom_layout_id . '.right-sidebar #sidebar-1-wrap { ' . $custom_dimensions['sb1_rt_margins'] . ' }
.' . $custom_layout_id . '.left-sidebar #sidebar-1-wrap { ' . $custom_dimensions['sb1_lft_margins'] . ' }
.' . $custom_layout_id . '.double-sidebar #sidebar-1-wrap { ' . $custom_dimensions['sb1_dbl_margins'] . ' }
.' . $custom_layout_id . ' #sidebar-2-wrap, .' . $custom_layout_id . ' #sidebar-2 { width: ' . $custom_dimensions['sb2_width'] . 'px; }
.' . $custom_layout_id . '.double-sidebar #sidebar-2-wrap { ' . $custom_dimensions['sb2_dbl_margins'] . ' }
.' . $custom_layout_id . ' #sidebar-1 #cat { width: ' . $custom_dimensions['sb1_cat_width'] . 'px; }
.' . $custom_layout_id . ' #sidebar-2 #cat { width: ' . $custom_dimensions['sb2_cat_width'] . 'px; }
.' . $custom_layout_id . ' #footer { ' . $custom_dimensions['footer_width'] . ' }';
		}
		
		return $custom_layout_css;
	}
	else
	{
		return false;
	}
}

/**
 * Calculate the Custom Layout Meida Query CSS based on the current Dynamik settings.
 *
 * @since 1.5
 * @return the Custom Layout Media Query CSS based on the current Dynamik settings.
 */
function catalyst_custom_layout_media_query_css()
{
	$custom_layouts = catalyst_get_layouts();
	if( !empty( $custom_layouts ) )
	{
		$custom_layout_media_query_css = '';
		
		foreach( $custom_layouts as $custom_layout )
		{
			$custom_dimensions = catalyst_dimensions( $custom_layout['type'], $custom_layout['content_width'], $custom_layout['sb1_width'], $custom_layout['sb2_width'] );
			$custom_layout_id = $custom_layout['layout_id'];
			
			if( catalyst_get_responsive( 'content_media_query_default' ) == 'default' )
			{
				$content_mq_first = '.' . $custom_layout_id . '.double-left-sidebar #container-wrap, .' . $custom_layout_id . '.double-right-sidebar #container-wrap,' . "\n";
				$content_mq_first .= '.' . $custom_layout_id . '.left-sidebar #container-wrap, .' . $custom_layout_id . '.right-sidebar #container-wrap,' . "\n";
				$content_mq_first .= '.' . $custom_layout_id . '.double-sidebar #container-wrap { padding-bottom: 0; }' . "\n";
				$content_mq_first .= '.' . $custom_layout_id . ' #content, .' . $custom_layout_id . '.left-sidebar #content, .' . $custom_layout_id . '.right-sidebar #content, .' . $custom_layout_id . '.double-left-sidebar #content, .' . $custom_layout_id . '.double-sidebar #content { margin: 0; }' . "\n";
				$content_mq_first .= '.' . $custom_layout_id . ' #dual-sidebar-outer, .' . $custom_layout_id . '.double-left-sidebar #dual-sidebar-outer { width: 100%; margin: 20px 0 0; float: left; }' . "\n";
				$content_mq_first .= '.' . $custom_layout_id . '.right-sidebar #sidebar-1-wrap, .' . $custom_layout_id . '.left-sidebar #sidebar-1-wrap, .' . $custom_layout_id . '.double-sidebar #sidebar-1-wrap { width: 100%; margin: 20px 0 0; }' . "\n";
				$content_mq_first .= '.' . $custom_layout_id . ' #sidebar-1, .' . $custom_layout_id . '.double-left-sidebar #sidebar-1, .' . $custom_layout_id . '.right-sidebar #sidebar-1, .' . $custom_layout_id . '.left-sidebar #sidebar-1, .' . $custom_layout_id . '.double-sidebar #sidebar-1,' . "\n";
				$content_mq_first .= '.' . $custom_layout_id . ' #sidebar-2, .' . $custom_layout_id . '.double-left-sidebar #sidebar-2, .' . $custom_layout_id . '.double-sidebar #sidebar-2 { width: 100%; }' . "\n";
				$content_mq_second = '.' . $custom_layout_id . '.double-sidebar #sidebar-2-wrap { margin: 20px 0 0; }' . "\n";
				$content_mq_second .= '.' . $custom_layout_id . ' #sidebar-1-wrap, .' . $custom_layout_id . '.double-left-sidebar #sidebar-1-wrap, .' . $custom_layout_id . '.double-sidebar #sidebar-1-wrap,' . "\n";
				$content_mq_second .= '.' . $custom_layout_id . ' #sidebar-2-wrap, .' . $custom_layout_id . '.double-left-sidebar #sidebar-2-wrap, .' . $custom_layout_id . '.double-sidebar #sidebar-2-wrap { width: 48.7%; }' . "\n";
				$content_mq_fourth = '.' . $custom_layout_id . ' #sidebar-1-wrap, .' . $custom_layout_id . '.double-left-sidebar #sidebar-1-wrap, .' . $custom_layout_id . '.double-sidebar #sidebar-1-wrap,' . "\n";
				$content_mq_fourth .= '.' . $custom_layout_id . ' #sidebar-2-wrap, .' . $custom_layout_id . '.double-left-sidebar #sidebar-2-wrap, .' . $custom_layout_id . '.double-sidebar #sidebar-2-wrap { width: 100%; }' . "\n";
			}
			elseif( catalyst_get_responsive( 'content_media_query_default' ) == 'progressive' )
			{
				$content_mq_first = '';
				$content_mq_second = '.' . $custom_layout_id . '.double-sidebar #container-wrap { padding-bottom: 0; }' . "\n";
				$content_mq_second .= '.' . $custom_layout_id . ' #content { ' . $custom_dimensions['media1_content_margins'] . ' }' . "\n";
				$content_mq_second .= '.' . $custom_layout_id . '.double-left-sidebar #content { ' . $custom_dimensions['media1_dbl_lft_sb_content_margins'] . ' }' . "\n";
				$content_mq_second .= '.' . $custom_layout_id . '.double-sidebar #content { margin: 0; }' . "\n";
				$content_mq_second .= '.' . $custom_layout_id . ' #dual-sidebar-outer, .' . $custom_layout_id . '.double-left-sidebar #dual-sidebar-outer { width: ' . $custom_dimensions['sb1_width'] . 'px; margin: 0 0 0 -' . $custom_dimensions['sb1_width'] . 'px; }' . "\n";
				$content_mq_second .= '.' . $custom_layout_id . '.double-left-sidebar #dual-sidebar-outer { margin: 0 -' . $custom_dimensions['sb1_width'] . 'px 0 0; }' . "\n";
				$content_mq_second .= '.' . $custom_layout_id . ' #sidebar-1-wrap, .' . $custom_layout_id . ' #sidebar-2-wrap, .' . $custom_layout_id . '.double-left-sidebar #sidebar-1-wrap, .' . $custom_layout_id . '.double-left-sidebar #sidebar-2-wrap,' . "\n";
				$content_mq_second .= '.' . $custom_layout_id . ' #sidebar-1, .' . $custom_layout_id . ' #sidebar-2, .' . $custom_layout_id . '.double-left-sidebar  #sidebar-1, .' . $custom_layout_id . '.double-left-sidebar #sidebar-2 { width: ' . $custom_dimensions['sb1_width'] . 'px; }' . "\n";
				$content_mq_second .= '.' . $custom_layout_id . '.double-sidebar #sidebar-1-wrap, .' . $custom_layout_id . '.double-sidebar #sidebar-2-wrap { margin: 20px 0 0; width: 49%; }' . "\n";
				$content_mq_second .= '.' . $custom_layout_id . '.double-sidebar #sidebar-1, .' . $custom_layout_id . '.double-sidebar #sidebar-2 { width: 100%; }' . "\n";
				$content_mq_fourth = '.' . $custom_layout_id . '.double-left-sidebar #container-wrap, .' . $custom_layout_id . '.double-right-sidebar #container-wrap,' . "\n";
				$content_mq_fourth .= '.' . $custom_layout_id . '.left-sidebar #container-wrap, .' . $custom_layout_id . '.right-sidebar #container-wrap,' . "\n";
				$content_mq_fourth .= '.' . $custom_layout_id . '.double-sidebar #container-wrap { padding-bottom: 0; }' . "\n";
				$content_mq_fourth .= '.' . $custom_layout_id . ' #content, .' . $custom_layout_id . '.left-sidebar #content, .' . $custom_layout_id . '.right-sidebar #content, .' . $custom_layout_id . '.double-left-sidebar #content, .' . $custom_layout_id . '.double-sidebar #content { margin: 0; }' . "\n";
				$content_mq_fourth .= '.' . $custom_layout_id . ' #dual-sidebar-outer, .' . $custom_layout_id . '.double-left-sidebar #dual-sidebar-outer { margin: 20px 0 0; float: left; }' . "\n";
				$content_mq_fourth .= '.' . $custom_layout_id . '.left-sidebar #sidebar-1-wrap, .' . $custom_layout_id . '.right-sidebar #sidebar-1-wrap, .' . $custom_layout_id . '.double-sidebar #sidebar-1-wrap { margin: 20px 0 0; }' . "\n";
				$content_mq_fourth .= '.' . $custom_layout_id . ' #dual-sidebar-outer, .' . $custom_layout_id . '.double-left-sidebar #dual-sidebar-outer, .' . $custom_layout_id . ' #sidebar-1-wrap, .' . $custom_layout_id . '.double-left-sidebar #sidebar-1-wrap,' . "\n";
				$content_mq_fourth .= '.' . $custom_layout_id . ' .left-sidebar #sidebar-1-wrap, .' . $custom_layout_id . '.right-sidebar #sidebar-1-wrap, .' . $custom_layout_id . '.double-sidebar #sidebar-1-wrap,' . "\n";
				$content_mq_fourth .= '.' . $custom_layout_id . ' #sidebar-2-wrap, .' . $custom_layout_id . '.double-left-sidebar #sidebar-2-wrap, .' . $custom_layout_id . '.double-sidebar #sidebar-2-wrap,' . "\n";
				$content_mq_fourth .= '.' . $custom_layout_id . ' #sidebar-1, .' . $custom_layout_id . '.double-left-sidebar #sidebar-1, .' . $custom_layout_id . '.right-sidebar #sidebar-1, .' . $custom_layout_id . '.left-sidebar #sidebar-1, .' . $custom_layout_id . '.double-sidebar #sidebar-1,' . "\n";
				$content_mq_fourth .= '.' . $custom_layout_id . ' #sidebar-2, .' . $custom_layout_id . '.double-left-sidebar #sidebar-2, .' . $custom_layout_id . '.double-sidebar #sidebar-2 { width: 100%; }' . "\n";
			}
			else
			{
				$content_mq_first = '';
				$content_mq_second = '';
				$content_mq_fourth = '';
			}

			if( catalyst_get_responsive( 'ez_media_query_default' ) == 'default' && catalyst_get_responsive( 'content_media_query_default' ) == 'progressive' )
			{
				$ez_mq_first = '.' . $custom_layout_id . ' #ez-home-slider.ez-widget-area, .' . $custom_layout_id . '.slider-inside #ez-home-slider.ez-widget-area { padding-bottom: 0; }' . "\n";
				$ez_mq_first .= '.' . $custom_layout_id . ' #ez-feature-top-container, .' . $custom_layout_id . ' #ez-fat-footer-container { margin: 0 auto; padding-bottom: 0; float: left; }' . "\n";
				$ez_mq_first .= '.' . $custom_layout_id . '#ez-feature-top-container .ez-widget-area,' . "\n";
				$ez_mq_first .= '.' . $custom_layout_id . '#ez-fat-footer-container .ez-widget-area { width: 100%; padding-bottom: 20px; padding-left: 0 !important; }' . "\n";
				$ez_mq_second = 'body.' . $custom_layout_id . '.double-left-sidebar.slider-inside #ez-home-slider-container-wrap { margin: 0 0 20px ' . $custom_dimensions['media1_home_slider_inside_sb_margin'] . 'px; }' . "\n";
				$ez_mq_second .= 'body.' . $custom_layout_id . '.double-right-sidebar.slider-inside #ez-home-slider-container-wrap { margin: 0 ' . $custom_dimensions['media1_home_slider_inside_sb_margin'] . 'px 20px 0; }' . "\n";
				$ez_mq_second .= 'body.' . $custom_layout_id . '.double-sidebar.slider-inside #ez-home-slider-container-wrap { margin: 0 0 20px; }' . "\n";
				$ez_mq_second .= 'body.' . $custom_layout_id . '.left-sidebar.slider-inside #ez-home-slider-container-wrap { margin: 0 0 20px ' . $custom_dimensions['media1_home_slider_inside_sb_margin'] . 'px; }' . "\n";
				$ez_mq_second .= 'body.' . $custom_layout_id . '.right-sidebar.slider-inside #ez-home-slider-container-wrap { margin: 0 ' . $custom_dimensions['media1_home_slider_inside_sb_margin'] . 'px 20px 0; }' . "\n";
				$ez_mq_fourth = 'body.' . $custom_layout_id . '.double-left-sidebar.slider-inside #ez-home-slider-container-wrap,' . "\n";
				$ez_mq_fourth .= 'body.' . $custom_layout_id . '.double-right-sidebar.slider-inside #ez-home-slider-container-wrap,' . "\n";
				$ez_mq_fourth .= 'body.' . $custom_layout_id . '.double-sidebar.slider-inside #ez-home-slider-container-wrap,' . "\n";
				$ez_mq_fourth .= 'body.' . $custom_layout_id . '.left-sidebar.slider-inside #ez-home-slider-container-wrap,' . "\n";
				$ez_mq_fourth .= 'body.' . $custom_layout_id . '.right-sidebar.slider-inside #ez-home-slider-container-wrap { margin: 0 0 20px; }' . "\n";
			}
			elseif( catalyst_get_responsive( 'ez_media_query_default' ) == 'delayed' && catalyst_get_responsive( 'content_media_query_default' ) == 'progressive' )
			{
				$ez_mq_first = '';
				$ez_mq_second = 'body.' . $custom_layout_id . '.double-left-sidebar.slider-inside #ez-home-slider-container-wrap { margin: 0 0 20px ' . $custom_dimensions['media1_home_slider_inside_sb_margin'] . 'px; }' . "\n";
				$ez_mq_second .= 'body.' . $custom_layout_id . '.double-right-sidebar.slider-inside #ez-home-slider-container-wrap { margin: 0 ' . $custom_dimensions['media1_home_slider_inside_sb_margin'] . 'px 20px 0; }' . "\n";
				$ez_mq_second .= 'body.' . $custom_layout_id . '.double-sidebar.slider-inside #ez-home-slider-container-wrap { margin: 0 0 20px; }' . "\n";
				$ez_mq_second .= 'body.' . $custom_layout_id . '.left-sidebar.slider-inside #ez-home-slider-container-wrap { margin: 0 0 20px ' . $custom_dimensions['media1_home_slider_inside_sb_margin'] . 'px; }' . "\n";
				$ez_mq_second .= 'body.' . $custom_layout_id . '.right-sidebar.slider-inside #ez-home-slider-container-wrap { margin: 0 ' . $custom_dimensions['media1_home_slider_inside_sb_margin'] . 'px 20px 0; }' . "\n";
				$ez_mq_fourth = 'body.' . $custom_layout_id . '.double-left-sidebar.slider-inside #ez-home-slider-container-wrap,' . "\n";
				$ez_mq_fourth .= 'body.' . $custom_layout_id . '.double-right-sidebar.slider-inside #ez-home-slider-container-wrap,' . "\n";
				$ez_mq_fourth .= 'body.' . $custom_layout_id . '.double-sidebar.slider-inside #ez-home-slider-container-wrap,' . "\n";
				$ez_mq_fourth .= 'body.' . $custom_layout_id . '.left-sidebar.slider-inside #ez-home-slider-container-wrap,' . "\n";
				$ez_mq_fourth .= 'body.' . $custom_layout_id . '.right-sidebar.slider-inside #ez-home-slider-container-wrap { margin: 0 0 20px; }' . "\n";
				$ez_mq_fourth .= '.' . $custom_layout_id . ' #ez-home-slider.ez-widget-area, .' . $custom_layout_id . '.slider-inside #ez-home-slider.ez-widget-area { padding-bottom: 0; }' . "\n";
				$ez_mq_fourth .= '.' . $custom_layout_id . ' #ez-feature-top-container, .' . $custom_layout_id . ' #ez-fat-footer-container { margin: 0 auto; padding-bottom: 0; float: left; }' . "\n";
				$ez_mq_fourth .= '.' . $custom_layout_id . '#ez-feature-top-container .ez-widget-area,' . "\n";
				$ez_mq_fourth .= '.' . $custom_layout_id . '#ez-fat-footer-container .ez-widget-area { width: 100%; padding-bottom: 20px; padding-left: 0 !important; }' . "\n";
			}
			elseif( catalyst_get_responsive( 'ez_media_query_default' ) == 'default' )
			{					
				$ez_mq_first = '.' . $custom_layout_id . ' #ez-home-slider.ez-widget-area, .' . $custom_layout_id . '.slider-inside #ez-home-slider.ez-widget-area { padding-bottom: 0; }' . "\n";
				$ez_mq_first .= '.' . $custom_layout_id . ' #ez-feature-top-container, .' . $custom_layout_id . ' #ez-fat-footer-container { margin: 0 auto; padding-bottom: 0; float: left; }' . "\n";
				$ez_mq_first .= '.' . $custom_layout_id . '#ez-feature-top-container .ez-widget-area,' . "\n";
				$ez_mq_first .= '.' . $custom_layout_id . '#ez-fat-footer-container .ez-widget-area { width: 100%; padding-bottom: 20px; padding-left: 0 !important; }' . "\n";
				$ez_mq_first .= 'body.' . $custom_layout_id . '.double-left-sidebar.slider-inside #ez-home-slider-container-wrap,' . "\n";
				$ez_mq_first .= 'body.' . $custom_layout_id . '.double-right-sidebar.slider-inside #ez-home-slider-container-wrap,' . "\n";
				$ez_mq_first .= 'body.' . $custom_layout_id . '.double-sidebar.slider-inside #ez-home-slider-container-wrap,' . "\n";
				$ez_mq_first .= 'body.' . $custom_layout_id . '.left-sidebar.slider-inside #ez-home-slider-container-wrap,' . "\n";
				$ez_mq_first .= 'body.' . $custom_layout_id . '.right-sidebar.slider-inside #ez-home-slider-container-wrap { margin: 0 0 20px; }' . "\n";
				$ez_mq_second = '';
				$ez_mq_fourth = '';
			}
			elseif( catalyst_get_responsive( 'ez_media_query_default' ) == 'delayed' )
			{
				$ez_mq_first = 'body.' . $custom_layout_id . '.double-left-sidebar.slider-inside #ez-home-slider-container-wrap,' . "\n";
				$ez_mq_first .= 'body.' . $custom_layout_id . '.double-right-sidebar.slider-inside #ez-home-slider-container-wrap,' . "\n";
				$ez_mq_first .= 'body.' . $custom_layout_id . '.double-sidebar.slider-inside #ez-home-slider-container-wrap,' . "\n";
				$ez_mq_first .= 'body.' . $custom_layout_id . '.left-sidebar.slider-inside #ez-home-slider-container-wrap,' . "\n";
				$ez_mq_first .= 'body.' . $custom_layout_id . '.right-sidebar.slider-inside #ez-home-slider-container-wrap { margin: 0 0 20px; }' . "\n";
				$ez_mq_second = '';
				$ez_mq_fourth = '.' . $custom_layout_id . ' #ez-home-slider.ez-widget-area, .' . $custom_layout_id . '.slider-inside #ez-home-slider.ez-widget-area { padding-bottom: 0; }' . "\n";
				$ez_mq_fourth .= '.' . $custom_layout_id . ' #ez-feature-top-container, .' . $custom_layout_id . ' #ez-fat-footer-container { margin: 0 auto; padding-bottom: 0; float: left; }' . "\n";
				$ez_mq_fourth .= '.' . $custom_layout_id . '#ez-feature-top-container .ez-widget-area,' . "\n";
				$ez_mq_fourth .= '.' . $custom_layout_id . '#ez-fat-footer-container .ez-widget-area { width: 100%; padding-bottom: 20px; padding-left: 0 !important; }' . "\n";
			}
			else
			{
				$ez_mq_first = '';
				$ez_mq_second = '';
				$ez_mq_fourth = '';
			}

			$custom_layout_media_query_css .= '
/************************* 
	Responsive Custom Layout Styles
*************************/

@media only screen and (max-width: ' . $custom_dimensions['media_wrap_width'] . 'px) {
' . $content_mq_first . $ez_mq_first . '
}

@media only screen and (min-width: 768px) and (max-width: ' . $custom_dimensions['media_wrap_width'] . 'px) {
' . $content_mq_second . $ez_mq_second . '
}

@media only screen and (max-width: 767px) {
' . $content_mq_fourth . $ez_mq_fourth . '
}';
		}
		
		return $custom_layout_media_query_css;
	}
	else
	{
		return false;
	}
}

/**
 * Write the Dynamik stylesheet file.
 *
 * @since 1.0
 */
function catalyst_write_dynamik_styles()
{
    $css_prefix = '/* ' . __( 'Dynamik Styles', 'catalyst' ) . ' */' . "\n";
    $css = catalyst_build_dynamik_styles();
	$css = $css_prefix . $css;

	$door = @fopen( catalyst_get_dynamik_stylesheet_path(), 'w' );
	@fwrite( $door, $css );
	@fclose( $door );
	if( substr( sprintf( '%o', fileperms( catalyst_get_dynamik_stylesheet_path() ) ), -4 ) != '0644' &&
		substr( sprintf( '%o', fileperms( catalyst_get_dynamik_stylesheet_path() ) ), -4 ) != '0666' )
	{
		@chmod( catalyst_get_dynamik_stylesheet_path(), 0644 );
	}
}

/**
 * Write the minified Dynamik stylesheet file.
 *
 * @since 1.0
 */
function catalyst_write_minified_styles()
{
	$css_prefix = '/* ' . __( 'This file is auto-generated from the Dynamik Options settings and custom.css content (if file exists). Any direct edits here will be lost if the settings page is saved', 'catalyst' ) .' */'."\n";
    $css = catalyst_build_dynamik_styles();
	if( file_exists( catalyst_get_custom_stylesheet_path() ) )
	{
		$css .= file_get_contents( catalyst_get_custom_stylesheet_path() );
	}
    $css = $css_prefix . catalyst_minify_css( $css );

	$door = @fopen( catalyst_get_minified_stylesheet_path(), 'w' );
	@fwrite( $door, $css );
	@fclose( $door );
	if( substr( sprintf( '%o', fileperms( catalyst_get_minified_stylesheet_path() ) ), -4 ) != '0644' &&
		substr( sprintf( '%o', fileperms( catalyst_get_minified_stylesheet_path() ) ), -4 ) != '0666' )
	{
		@chmod( catalyst_get_minified_stylesheet_path(), 0644 );
	}
}

/**
 * Build the Custom stylesheet file.
 *
 * @since 1.5
 */
function catalyst_build_custom_styles()
{
	$css = '/* ' . __( 'Custom CSS', 'catalyst' ) . ' */' . "\n" . "\n";
	$css .= catalyst_get_advanced( 'custom_css' );
	
	if( catalyst_get_core( 'dynamik_responsive' ) )
	{
		$css .= "\n" . "\n" . '/* ' . __( 'Custom Responsive CSS', 'catalyst' ) . ' */' . "\n";
		$css .= '
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
	}
	
	return $css;
}

/**
 * Write the Custom stylesheet file.
 *
 * @since 1.3
 */
function catalyst_write_custom_styles()
{
	$css = catalyst_build_custom_styles();
	
	$door = @fopen( catalyst_get_custom_stylesheet_path(), 'w' );
	@fwrite( $door, $css );
	@fclose( $door );
	if( substr( sprintf( '%o', fileperms( catalyst_get_custom_stylesheet_path() ) ), -4 ) != '0644' &&
		substr( sprintf( '%o', fileperms( catalyst_get_custom_stylesheet_path() ) ), -4 ) != '0666' )
	{
		@chmod( catalyst_get_custom_stylesheet_path(), 0644 );
	}
}

/**
 * Call to all necessary functions to create both the
 * Dynamik and Custom stylesheets.
 *
 * @since 1.0
 */
function catalyst_write_styles()
{
	catalyst_child_folders_open_permissions();
	catalyst_write_dynamik_styles();
	catalyst_write_custom_styles();
	catalyst_write_minified_styles();
	catalyst_child_folders_close_permissions();
	catalyst_update_dynamik_alt_options();
}

/**
 * Minify (strip out unnecessary stuff) the stylesheets.
 *
 * @since 1.0
 * @return a minified version of the stylesheets.
 */
function catalyst_minify_css( $css )
{
    $css = preg_replace( '/\s+/', ' ', $css );
    $css = preg_replace( '/\/\*[^\!](.*?)\*\//', '', $css );
    $css = preg_replace( '/(,|:|;|\{|}) /', '$1', $css );
    $css = preg_replace( '/ (,|;|\{|})/', '$1', $css );
    $css = preg_replace( '/(:| )0\.([0-9]+)(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}.${2}${3}', $css );
    $css = preg_replace( '/0 0 0 0/', '0', $css );

    return apply_filters( 'catalyst_minify_css', $css );
}

//end lib/functions/catalyst-dynamik-build-styles.php