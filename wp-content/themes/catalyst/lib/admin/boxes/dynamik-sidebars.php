<?php
/**
 * Builds the Dynamik Sidebars admin content.
 *
 * @package Catalyst
 */
?>

<div id="catalyst-dynamik-options-nav-sidebars-box" class="catalyst-optionbox-outer-1col catalyst-all-options">
	<div class="catalyst-optionbox-inner-1col">
		<h3><?php _e( 'Sidebars', 'catalyst' ); ?></h3>
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'Sidebar Heading Font', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select class="catalyst-universal-font-type-child catalyst-universal-heading-font-type-child" id="catalyst-sb-heading-font-type" name="catalyst[font_type][sb_heading]" size="1" style="width:98px;">
				<?php catalyst_build_font_menu( $dynamik_font_type['sb_heading'] ); ?></select>
				<input type="text" id="catalyst-sb-heading-font-size" name="catalyst[sb_heading_font_size]" value="<?php catalyst_dynamik_options_defaults( true, 'sb_heading_font_size' ); ?>" style="width:40px;" />
				<select class="catalyst-universal-px-em-child catalyst-universal-heading-px-em-child" id="catalyst-sb-heading-px-em" name="catalyst[sb_heading_px_em]" size="1" style="width:50px;">
					<option value="px"<?php echo ( catalyst_get_dynamik( 'sb_heading_px_em' ) == 'px' ) ? ' selected="selected"' : ''; ?>>px</option>
					<option value="em"<?php echo ( catalyst_get_dynamik( 'sb_heading_px_em' ) == 'em' ) ? ' selected="selected"' : ''; ?>>em</option>
				</select>
				<?php _e( 'Color', 'catalyst' ); ?><input type="text" class="catalyst-universal-font-color-child catalyst-universal-heading-font-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-sb-heading-font-color" name="catalyst[sb_heading_font_color]" value="<?php catalyst_dynamik_options_defaults( true, 'sb_heading_font_color' ); ?>" />
				<input type="checkbox" class="universal-check" id="catalyst-sb-heading-font-universal" name="catalyst[sb_heading_font_u]" value="u" <?php if( checked( 'u', catalyst_get_dynamik( 'sb_heading_font_u' ) ) ); ?> /> <?php _e( '(U)', 'catalyst' ); ?>
				<span class="catalyst-custom-fonts-button-wrap"><span id="show-sb-heading-font-css" class="catalyst-custom-fonts-button">#Custom</span></span>
				<div style="display:none;" id="show-sb-heading-font-css-box" class="catalyst-custom-fonts-box">
				<?php _e( 'Sidebar Heading Font Custom CSS | <code>#sidebar-1 h4, #sidebar-2 h4 { }</code>', 'catalyst' ); ?><br />
				<textarea class="catalyst-universal-font-css-child catalyst-universal-heading-font-css-child" id="catalyst-sb-heading-font-css" name="catalyst[sb_heading_font_css]" style="width:100%;" rows="10"><?php echo catalyst_get_dynamik( 'sb_heading_font_css' ); ?></textarea>
				</div>
			</p>
		</div>
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'Sidebar Content Font', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select class="catalyst-universal-font-type-child catalyst-universal-content-font-type-child" id="catalyst-sb-content-font-type" name="catalyst[font_type][sb_content]" size="1" style="width:98px;">
				<?php catalyst_build_font_menu( $dynamik_font_type['sb_content'] ); ?></select>
				<input type="text" id="catalyst-sb-content-font-size" name="catalyst[sb_content_font_size]" value="<?php catalyst_dynamik_options_defaults( true, 'sb_content_font_size' ); ?>" style="width:40px;" />
				<select class="catalyst-universal-px-em-child catalyst-universal-content-px-em-child" id="catalyst-sb-content-px-em" name="catalyst[sb_content_px_em]" size="1" style="width:50px;">
					<option value="px"<?php echo ( catalyst_get_dynamik( 'sb_content_px_em' ) == 'px' ) ? ' selected="selected"' : ''; ?>>px</option>
					<option value="em"<?php echo ( catalyst_get_dynamik( 'sb_content_px_em' ) == 'em' ) ? ' selected="selected"' : ''; ?>>em</option>
				</select>
				<?php _e( 'Color', 'catalyst' ); ?><input type="text" class="catalyst-universal-font-color-child catalyst-universal-content-font-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-sb-content-font-color" name="catalyst[sb_content_font_color]" value="<?php catalyst_dynamik_options_defaults( true, 'sb_content_font_color' ); ?>" />
				<input type="checkbox" class="universal-check" id="catalyst-sb-content-font-universal" name="catalyst[sb_content_font_u]" value="u" <?php if( checked( 'u', catalyst_get_dynamik( 'sb_content_font_u' ) ) ); ?> /> <?php _e( '(U)', 'catalyst' ); ?>
				<span class="catalyst-custom-fonts-button-wrap"><span id="show-sb-content-font-css" class="catalyst-custom-fonts-button">#Custom</span></span>
				<div style="display:none;" id="show-sb-content-font-css-box" class="catalyst-custom-fonts-box">
				<?php _e( 'Sidebar Content Font Custom CSS | <code>#sidebar-1, #sidebar-2 { }</code>', 'catalyst' ); ?><br />
				<textarea class="catalyst-universal-font-css-child catalyst-universal-content-font-css-child" id="catalyst-sb-content-font-css" name="catalyst[sb_content_font_css]" style="width:100%;" rows="10"><?php echo catalyst_get_dynamik( 'sb_content_font_css' ); ?></textarea>
				</div>
			</p>
		</div>
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'Sidebar Content Link', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Link', 'catalyst' ); ?><input type="text" class="catalyst-universal-link-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-sb-content-link-color" name="catalyst[sb_content_link_color]" value="<?php catalyst_dynamik_options_defaults( true, 'sb_content_link_color' ); ?>" />
				<?php _e( 'Link Hover', 'catalyst' ); ?><input type="text" class="catalyst-universal-link-hover-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-sb-content-link-hover-color" name="catalyst[sb_content_link_hover_color]" value="<?php catalyst_dynamik_options_defaults( true, 'sb_content_link_hover_color' ); ?>" />
				<?php _e( 'Link Underline', 'catalyst' ); ?> <select class="catalyst-universal-link-underline-child" id="catalyst-sb-content-link-underline" name="catalyst[sb_content_link_underline]" size="1" style="width:90px;">
					<option value="Never"<?php if (catalyst_get_dynamik( 'sb_content_link_underline' ) == 'Never') echo ' selected="selected"'; ?>><?php _e( 'Never', 'catalyst' ); ?></option>
					<option value="On Hover"<?php if (catalyst_get_dynamik( 'sb_content_link_underline' ) == 'On Hover') echo ' selected="selected"'; ?>><?php _e( 'On Hover', 'catalyst' ); ?></option>
					<option value="Off Hover"<?php if (catalyst_get_dynamik( 'sb_content_link_underline' ) == 'Off Hover') echo ' selected="selected"'; ?>><?php _e( 'Off Hover', 'catalyst' ); ?></option>
					<option value="Always"<?php if (catalyst_get_dynamik( 'sb_content_link_underline' ) == 'Always') echo ' selected="selected"'; ?>><?php _e( 'Always', 'catalyst' ); ?></option>
				</select>
				<input type="checkbox" class="universal-check" id="catalyst-sb-content-link-universal" name="catalyst[sb_content_link_u]" value="u" <?php if( checked( 'u', catalyst_get_dynamik( 'sb_content_link_u' ) ) ); ?> /> <?php _e( '(U)', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="catalyst-bg-option-desc">
			<p><?php _e( 'Sidebar Heading Background', 'catalyst' ); ?></p>
		</div>
	
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select id="catalyst-sb-heading-bg-type" class="catalyst-bg-type" name="catalyst[sb_heading_bg_type]" size="1" style="width:150px;">
				<?php catalyst_list_bg_options( catalyst_get_dynamik( 'sb_heading_bg_type' ) ); ?>
				</select> <span style="display:none;" id="catalyst-sb-heading-bg-type-checkbox"><?php _e( '(No Color', 'catalyst' ); ?> <input type="checkbox" id="catalyst-sb-heading-bg-no-color" name="catalyst[sb_heading_bg_no_color]" value="1" <?php if( checked( 1, catalyst_get_dynamik( 'sb_heading_bg_no_color' ) ) ); ?> />)</span><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-sb-heading-bg-color" name="catalyst[sb_heading_bg_color]" value="<?php catalyst_dynamik_options_defaults( true, 'sb_heading_bg_color' ); ?>" />
				<?php _e( 'Image', 'catalyst' ); ?> <select id="catalyst-sb-heading-bg-image" name="catalyst[sb_heading_bg_image]" size="1" style="width:150px;"><?php catalyst_list_images( catalyst_get_dynamik( 'sb_heading_bg_image' ) ); ?></select>
			</p>
		</div>
		
		<div class="catalyst-bg-option-desc">
			<p><?php _e( 'Sidebar Content Background', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select id="catalyst-sb-content-bg-type" class="catalyst-bg-type" name="catalyst[sb_content_bg_type]" size="1" style="width:150px;">
				<?php catalyst_list_bg_options( catalyst_get_dynamik( 'sb_content_bg_type' ) ); ?>
				</select> <span style="display:none;" id="catalyst-sb-content-bg-type-checkbox"><?php _e( '(No Color', 'catalyst' ); ?> <input type="checkbox" id="catalyst-sb-content-bg-no-color" name="catalyst[sb_content_bg_no_color]" value="1" <?php if( checked( 1, catalyst_get_dynamik( 'sb_content_bg_no_color' ) ) ); ?> />)</span><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-sb-content-bg-color" name="catalyst[sb_content_bg_color]" value="<?php catalyst_dynamik_options_defaults( true, 'sb_content_bg_color' ); ?>" />
				<?php _e( 'Image', 'catalyst' ); ?> <select id="catalyst-sb-content-bg-image" name="catalyst[sb_content_bg_image]" size="1" style="width:150px;"><?php catalyst_list_images( catalyst_get_dynamik( 'sb_content_bg_image' ) ); ?></select>
			</p>
		</div>
		
		<div class="catalyst-border-option-desc">
			<p><?php _e( 'Sidebar Heading Border', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select id="catalyst-sb-heading-border-type" name="catalyst[sb_heading_border_type]" size="1" style="width:100px;">
					<option value="Full"<?php if (catalyst_get_dynamik( 'sb_heading_border_type' ) == 'Full') echo ' selected="selected"'; ?>><?php _e( 'Full', 'catalyst' ); ?></option>
					<option value="Top/Bottom"<?php if (catalyst_get_dynamik( 'sb_heading_border_type' ) == 'Top/Bottom') echo ' selected="selected"'; ?>><?php _e( 'Top/Bottom', 'catalyst' ); ?></option>
					<option value="Bottom"<?php if (catalyst_get_dynamik( 'sb_heading_border_type' ) == 'Bottom') echo ' selected="selected"'; ?>><?php _e( 'Bottom', 'catalyst' ); ?></option>
				</select>
				<?php _e( 'Thickness', 'catalyst' ); ?> <input type="text" id="catalyst-sb-heading-border-thickness" name="catalyst[sb_heading_border_thickness]" value="<?php catalyst_dynamik_options_defaults( true, 'sb_heading_border_thickness' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Style', 'catalyst' ); ?> <select id="catalyst-sb-heading-border-style" name="catalyst[sb_heading_border_style]" size="1" style="width:90px; margin-right:5px;">
					<?php catalyst_list_borders( catalyst_get_dynamik( 'sb_heading_border_style' ) ); ?>
				</select>
				<input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-sb-heading-border-color" name="catalyst[sb_heading_border_color]" value="<?php catalyst_dynamik_options_defaults( true, 'sb_heading_border_color' ); ?>" />
			</p>
		</div>
		
		<div class="catalyst-border-option-desc">
			<p><?php _e( 'Sidebar Content Border', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select id="catalyst-sb-content-border-type" name="catalyst[sb_content_border_type]" size="1" style="width:100px;">
					<option value="Full"<?php if (catalyst_get_dynamik( 'sb_content_border_type' ) == 'Full') echo ' selected="selected"'; ?>><?php _e( 'Full', 'catalyst' ); ?></option>
					<option value="Top/Bottom"<?php if (catalyst_get_dynamik( 'sb_content_border_type' ) == 'Top/Bottom') echo ' selected="selected"'; ?>><?php _e( 'Top/Bottom', 'catalyst' ); ?></option>
					<option value="Bottom"<?php if (catalyst_get_dynamik( 'sb_content_border_type' ) == 'Bottom') echo ' selected="selected"'; ?>><?php _e( 'Bottom', 'catalyst' ); ?></option>
				</select>
				<?php _e( 'Thickness', 'catalyst' ); ?>
				<input type="text" id="catalyst-sb-content-border-thickness" name="catalyst[sb_content_border_thickness]" value="<?php catalyst_dynamik_options_defaults( true, 'sb_content_border_thickness' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Style', 'catalyst' ); ?> <select id="catalyst-sb-content-border-style" name="catalyst[sb_content_border_style]" size="1" style="width:90px; margin-right:5px;">
					<?php catalyst_list_borders( catalyst_get_dynamik( 'sb_content_border_style' ) ); ?>
				</select>
				<?php _e( 'Color', 'catalyst' ); ?> <input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-sb-content-border-color" name="catalyst[sb_content_border_color]" value="<?php catalyst_dynamik_options_defaults( true, 'sb_content_border_color' ); ?>" />
			</p>
		</div>
		
		<div class="dynamik-design-standard-hide">
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Sidebar Widget Margins', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p>
				<?php _e( 'Top Margin', 'catalyst' ); ?>
				<input type="text" id="catalyst-sb-widget-margin-top" name="catalyst[sb_widget_margin_top]" value="<?php catalyst_dynamik_options_defaults( true, 'sb_widget_margin_top' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Bottom Margin', 'catalyst' ); ?>
				<input type="text" id="catalyst-sb-widget-margin-bottom" name="catalyst[sb_widget_margin_bottom]" value="<?php catalyst_dynamik_options_defaults( true, 'sb_widget_margin_bottom' ); ?>" style="width:35px;" /><?php _e( 'px', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Sidebar Heading Padding', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p>
				<?php _e( 'Padding: Top', 'catalyst' ); ?>
				<input type="text" id="catalyst-sb-heading-padding-top" name="catalyst[sb_heading_padding_top]" value="<?php catalyst_dynamik_options_defaults( true, 'sb_heading_padding_top' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Right', 'catalyst' ); ?>
				<input type="text" id="catalyst-sb-heading-padding-right" name="catalyst[sb_heading_padding_right]" value="<?php catalyst_dynamik_options_defaults( true, 'sb_heading_padding_right' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Bottom', 'catalyst' ); ?>
				<input type="text" id="catalyst-sb-heading-padding-bottom" name="catalyst[sb_heading_padding_bottom]" value="<?php catalyst_dynamik_options_defaults( true, 'sb_heading_padding_bottom' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Left', 'catalyst' ); ?>
				<input type="text" id="catalyst-sb-heading-padding-left" name="catalyst[sb_heading_padding_left]" value="<?php catalyst_dynamik_options_defaults( true, 'sb_heading_padding_left' ); ?>" style="width:35px;" /><?php _e( 'px', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Sidebar Content Padding', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p>
				<?php _e( 'Padding: Top', 'catalyst' ); ?>
				<input type="text" id="catalyst-sb-content-padding-top" name="catalyst[sb_content_padding_top]" value="<?php catalyst_dynamik_options_defaults( true, 'sb_content_padding_top' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Right', 'catalyst' ); ?>
				<input type="text" id="catalyst-sb-content-padding-right" name="catalyst[sb_content_padding_right]" value="<?php catalyst_dynamik_options_defaults( true, 'sb_content_padding_right' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Bottom', 'catalyst' ); ?>
				<input type="text" id="catalyst-sb-content-padding-bottom" name="catalyst[sb_content_padding_bottom]" value="<?php catalyst_dynamik_options_defaults( true, 'sb_content_padding_bottom' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Left', 'catalyst' ); ?>
				<input type="text" id="catalyst-sb-content-padding-left" name="catalyst[sb_content_padding_left]" value="<?php catalyst_dynamik_options_defaults( true, 'sb_content_padding_left' ); ?>" style="width:35px;" /><?php _e( 'px', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Sidebar List-Style Padding', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p>
				<?php _e( 'Padding: Top', 'catalyst' ); ?>
				<input type="text" id="catalyst-sb-ul-padding-top" name="catalyst[sb_ul_padding_top]" value="<?php catalyst_dynamik_options_defaults( true, 'sb_ul_padding_top' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Right', 'catalyst' ); ?>
				<input type="text" id="catalyst-sb-ul-padding-right" name="catalyst[sb_ul_padding_right]" value="<?php catalyst_dynamik_options_defaults( true, 'sb_ul_padding_right' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Bottom', 'catalyst' ); ?>
				<input type="text" id="catalyst-sb-ul-padding-bottom" name="catalyst[sb_ul_padding_bottom]" value="<?php catalyst_dynamik_options_defaults( true, 'sb_ul_padding_bottom' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Left', 'catalyst' ); ?>
				<input type="text" id="catalyst-sb-ul-padding-left" name="catalyst[sb_ul_padding_left]" value="<?php catalyst_dynamik_options_defaults( true, 'sb_ul_padding_left' ); ?>" style="width:35px;" /><?php _e( 'px', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Sidebar Search Widget Padding', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p>
				<?php _e( 'Left Padding', 'catalyst' ); ?>
				<input type="text" id="catalyst-sb-search-form-padding-left" name="catalyst[sb_search_form_padding_left]" value="<?php catalyst_dynamik_options_defaults( true, 'sb_search_form_padding_left' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Right Padding', 'catalyst' ); ?>
				<input type="text" id="catalyst-sb-search-form-padding-right" name="catalyst[sb_search_form_padding_right]" value="<?php catalyst_dynamik_options_defaults( true, 'sb_search_form_padding_right' ); ?>" style="width:35px;" /><?php _e( 'px', 'catalyst' ); ?>
			</p>
		</div>
		
		</div><!-- End .dynamik-design-standard-hide -->
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Sidebar List-Style', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Sidebar List Style', 'catalyst' ); ?>
				<select id="catalyst-sb-list-style" name="catalyst[sb_list_style]" size="1" style="width:70px;">
					<option value="none"<?php if (catalyst_get_dynamik( 'sb_list_style' ) == 'none') echo ' selected="selected"'; ?>><?php _e( 'none', 'catalyst' ); ?></option>
					<option value="disc"<?php if (catalyst_get_dynamik( 'sb_list_style' ) == 'disc') echo ' selected="selected"'; ?>><?php _e( 'disc', 'catalyst' ); ?></option>
					<option value="circle"<?php if (catalyst_get_dynamik( 'sb_list_style' ) == 'circle') echo ' selected="selected"'; ?>><?php _e( 'circle', 'catalyst' ); ?></option>
					<option value="square"<?php if (catalyst_get_dynamik( 'sb_list_style' ) == 'square') echo ' selected="selected"'; ?>><?php _e( 'square', 'catalyst' ); ?></option>
				</select>
			</p>
		</div>
	</div>
</div>