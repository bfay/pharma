<?php
/**
 * Builds the Dynamik Widgets admin content.
 *
 * @package Catalyst
 */
?>

<div id="catalyst-dynamik-options-nav-widgets-box" class="catalyst-optionbox-outer-1col catalyst-all-options">
	<div class="catalyst-optionbox-inner-1col">	
		<h3><?php _e( 'Custom Widget Areas', 'catalyst' ); ?> <span id="catalyst-custom-widget-areas-design-tooltip" class="tooltip-mark tooltip-center-left">[?]</span></h3>
		
		<div class="tooltip tooltip-400">
			<p>
				<?php _e( 'The Dynamik Options under this heading control the design of the Custom Widget Areas you create in Advanced Options.', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'Catalyst Widget Heading Fonts', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select class="catalyst-universal-font-type-child catalyst-universal-heading-font-type-child" id="catalyst-catalyst-widget-title-font-type" name="catalyst[font_type][catalyst_widget_title]" size="1" style="width:98px;">
				<?php catalyst_build_font_menu( $dynamik_font_type['catalyst_widget_title'] ); ?></select>
				<input type="text" id="catalyst-catalyst-widget-title-font-size" name="catalyst[catalyst_widget_title_font_size]" value="<?php catalyst_dynamik_options_defaults( true, 'catalyst_widget_title_font_size' ); ?>" style="width:40px;" />
				<select class="catalyst-universal-px-em-child catalyst-universal-heading-px-em-child" id="catalyst-catalyst-widget-title-px-em" name="catalyst[catalyst_widget_title_px_em]" size="1" style="width:50px;">
					<option value="px"<?php echo ( catalyst_get_dynamik( 'catalyst_widget_title_px_em' ) == 'px' ) ? ' selected="selected"' : ''; ?>>px</option>
					<option value="em"<?php echo ( catalyst_get_dynamik( 'catalyst_widget_title_px_em' ) == 'em' ) ? ' selected="selected"' : ''; ?>>em</option>
				</select>
				<?php _e( 'Color', 'catalyst' ); ?><input type="text" class="catalyst-universal-font-color-child catalyst-universal-heading-font-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-catalyst-widget-title-font-color" name="catalyst[catalyst_widget_title_font_color]" value="<?php catalyst_dynamik_options_defaults( true, 'catalyst_widget_title_font_color' ); ?>" />
				<input type="checkbox" class="universal-check" id="catalyst-catalyst-widget-title-font-universal" name="catalyst[catalyst_widget_title_font_u]" value="u" <?php if( checked( 'u', catalyst_get_dynamik( 'catalyst_widget_title_font_u' ) ) ); ?> /> <?php _e( '(U)', 'catalyst' ); ?>
				<span class="catalyst-custom-fonts-button-wrap"><span id="show-catalyst-widget-title-font-css" class="catalyst-custom-fonts-button">#Custom</span></span>
				<div style="display:none;" id="show-catalyst-widget-title-font-css-box" class="catalyst-custom-fonts-box">
				<?php _e( 'Text Widget Content Font Custom CSS | <code>.catalyst-widget-area h4 { }</code>', 'catalyst' ); ?><br />
				<textarea class="catalyst-universal-font-css-child catalyst-universal-heading-font-css-child" id="catalyst-catalyst-widget-title-font-css" name="catalyst[catalyst_widget_title_font_css]" style="width:100%;" rows="10"><?php echo catalyst_get_dynamik( 'catalyst_widget_title_font_css' ); ?></textarea>
				</div>
			</p>
		</div>
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'Catalyst Widget Content Fonts', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select class="catalyst-universal-font-type-child catalyst-universal-content-font-type-child" id="catalyst-catalyst-widget-content-font-type" name="catalyst[font_type][catalyst_widget_content]" size="1" style="width:98px;">
				<?php catalyst_build_font_menu( $dynamik_font_type['catalyst_widget_content'] ); ?></select>
				<input type="text" id="catalyst-catalyst-widget-content-font-size" name="catalyst[catalyst_widget_content_font_size]" value="<?php catalyst_dynamik_options_defaults( true, 'catalyst_widget_content_font_size' ); ?>" style="width:40px;" />
				<select class="catalyst-universal-px-em-child catalyst-universal-content-px-em-child" id="catalyst-catalyst-widget-content-px-em" name="catalyst[catalyst_widget_content_px_em]" size="1" style="width:50px;">
					<option value="px"<?php echo ( catalyst_get_dynamik( 'catalyst_widget_content_px_em' ) == 'px' ) ? ' selected="selected"' : ''; ?>>px</option>
					<option value="em"<?php echo ( catalyst_get_dynamik( 'catalyst_widget_content_px_em' ) == 'em' ) ? ' selected="selected"' : ''; ?>>em</option>
				</select>
				<?php _e( 'Color', 'catalyst' ); ?><input type="text" class="catalyst-universal-font-color-child catalyst-universal-content-font-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-catalyst-widget-content-font-color" name="catalyst[catalyst_widget_content_font_color]" value="<?php catalyst_dynamik_options_defaults( true, 'catalyst_widget_content_font_color' ); ?>" />
				<input type="checkbox" class="universal-check" id="catalyst-catalyst-widget-content-font-universal" name="catalyst[catalyst_widget_content_font_u]" value="u" <?php if( checked( 'u', catalyst_get_dynamik( 'catalyst_widget_content_font_u' ) ) ); ?> /> <?php _e( '(U)', 'catalyst' ); ?>
				<span class="catalyst-custom-fonts-button-wrap"><span id="show-catalyst-widget-content-font-css" class="catalyst-custom-fonts-button">#Custom</span></span>
				<div style="display:none;" id="show-catalyst-widget-content-font-css-box" class="catalyst-custom-fonts-box">
				<?php _e( 'Text Widget Content Font Custom CSS | <code>.catalyst-widget-area { }</code>', 'catalyst' ); ?><br />
				<textarea class="catalyst-universal-font-css-child catalyst-universal-content-font-css-child" id="catalyst-catalyst-widget-content-font-css" name="catalyst[catalyst_widget_content_font_css]" style="width:100%;" rows="10"><?php echo catalyst_get_dynamik( 'catalyst_widget_content_font_css' ); ?></textarea>
				</div>
			</p>
		</div>
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'Catalyst Widget Content Link', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Link', 'catalyst' ); ?><input type="text" class="catalyst-universal-link-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-catalyst-widget-content-link-color" name="catalyst[catalyst_widget_content_link_color]" value="<?php catalyst_dynamik_options_defaults( true, 'catalyst_widget_content_link_color' ); ?>" />
				<?php _e( 'Link Hover', 'catalyst' ); ?><input type="text" class="catalyst-universal-link-hover-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-catalyst-widget-content-link-hover-color" name="catalyst[catalyst_widget_content_link_hover_color]" value="<?php catalyst_dynamik_options_defaults( true, 'catalyst_widget_content_link_hover_color' ); ?>" />
				<?php _e( 'Link Underline', 'catalyst' ); ?> <select class="catalyst-universal-link-underline-child" id="catalyst-catalyst-widget-content-link-underline" name="catalyst[catalyst_widget_content_link_underline]" size="1" style="width:90px;">
					<option value="Never"<?php if (catalyst_get_dynamik( 'catalyst_widget_content_link_underline' ) == 'Never') echo ' selected="selected"'; ?>><?php _e( 'Never', 'catalyst' ); ?></option>
					<option value="On Hover"<?php if (catalyst_get_dynamik( 'catalyst_widget_content_link_underline' ) == 'On Hover') echo ' selected="selected"'; ?>><?php _e( 'On Hover', 'catalyst' ); ?></option>
					<option value="Off Hover"<?php if (catalyst_get_dynamik( 'catalyst_widget_content_link_underline' ) == 'Off Hover') echo ' selected="selected"'; ?>><?php _e( 'Off Hover', 'catalyst' ); ?></option>
					<option value="Always"<?php if (catalyst_get_dynamik( 'catalyst_widget_content_link_underline' ) == 'Always') echo ' selected="selected"'; ?>><?php _e( 'Always', 'catalyst' ); ?></option>
				</select>
				<input type="checkbox" class="universal-check" id="catalyst-catalyst-widget-content-link-universal" name="catalyst[catalyst_widget_content_link_u]" value="u" <?php if( checked( 'u', catalyst_get_dynamik( 'catalyst_widget_content_link_u' ) ) ); ?> /> <?php _e( '(U)', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="catalyst-bg-option-desc">
			<p><?php _e( 'Catalyst Widget Background', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select id="catalyst-catalyst-widget-bg-type" class="catalyst-bg-type" name="catalyst[catalyst_widget_bg_type]" size="1" style="width:150px;">
				<?php catalyst_list_bg_options( catalyst_get_dynamik( 'catalyst_widget_bg_type' ) ); ?>
				</select> <span style="display:none;" id="catalyst-catalyst-widget-bg-type-checkbox"><?php _e( '(No Color', 'catalyst' ); ?> <input type="checkbox" id="catalyst-catalyst-widget-bg-no-color" name="catalyst[catalyst_widget_bg_no_color]" value="1" <?php if( checked( 1, catalyst_get_dynamik( 'catalyst_widget_bg_no_color' ) ) ); ?> />)</span><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-catalyst-widget-bg-color" name="catalyst[catalyst_widget_bg_color]" value="<?php catalyst_dynamik_options_defaults( true, 'catalyst_widget_bg_color' ); ?>" />
				<?php _e( 'Image', 'catalyst' ); ?> <select id="catalyst-catalyst-widget-bg-image" name="catalyst[catalyst_widget_bg_image]" size="1" style="width:150px;"><?php catalyst_list_images( catalyst_get_dynamik( 'catalyst_widget_bg_image' ) ); ?></select>
			</p>
		</div>
		
		<div class="catalyst-border-option-desc">
			<p><?php _e( 'Catalyst Widget Border', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select id="catalyst-catalyst-widget-border-type" class="catalyst-widget-width-option" name="catalyst[catalyst_widget_border_type]" size="1" style="width:98px;">
					<option value="Full"<?php if (catalyst_get_dynamik( 'catalyst_widget_border_type' ) == 'Full') echo ' selected="selected"'; ?>><?php _e( 'Full', 'catalyst' ); ?></option>
					<option value="Top"<?php if (catalyst_get_dynamik( 'catalyst_widget_border_type' ) == 'Top') echo ' selected="selected"'; ?>><?php _e( 'Top', 'catalyst' ); ?></option>
					<option value="Bottom"<?php if (catalyst_get_dynamik( 'catalyst_widget_border_type' ) == 'Bottom') echo ' selected="selected"'; ?>><?php _e( 'Bottom', 'catalyst' ); ?></option>
					<option value="Left"<?php if (catalyst_get_dynamik( 'catalyst_widget_border_type' ) == 'Left') echo ' selected="selected"'; ?>><?php _e( 'Left', 'catalyst' ); ?></option>
					<option value="Right"<?php if (catalyst_get_dynamik( 'catalyst_widget_border_type' ) == 'Right') echo ' selected="selected"'; ?>><?php _e( 'Right', 'catalyst' ); ?></option>
				</select>
				<?php _e( 'Thickness', 'catalyst' ); ?> <input type="text" class="catalyst-widget-width-option" id="catalyst-catalyst-widget-border-thickness" name="catalyst[catalyst_widget_border_thickness]" value="<?php catalyst_dynamik_options_defaults( true, 'catalyst_widget_border_thickness' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Style', 'catalyst' ); ?> <select id="catalyst-catalyst-widget-border-style" name="catalyst[catalyst_widget_border_style]" size="1" style="width:95px; margin-right:5px;">
					<?php catalyst_list_borders( catalyst_get_dynamik( 'catalyst_widget_border_style' ) ); ?>
				</select>
				<input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-catalyst-widget-border-color" name="catalyst[catalyst_widget_border_color]" value="<?php catalyst_dynamik_options_defaults( true, 'catalyst_widget_border_color' ); ?>" />
			</p>
		</div>
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Catalyst Widget Width Calculator', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p>
				<?php _e( 'Site Width', 'catalyst' ); ?>
				<input type="text" class="catalyst-widget-width-option" id="catalyst-widget-site-width" value="" style="width:40px;" />
				<?php _e( 'Total Number of Catalyst Widgets in Widget Area', 'catalyst' ); ?>
				<input type="text" class="catalyst-widget-width-option" id="catalyst-widget-count" value="" style="width:40px;" />
			</p>
		</div>
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Catalyst Widget Width', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p>
				<?php _e( 'Widget Width', 'catalyst' ); ?>
				<input type="text" id="catalyst-widget-width" name="catalyst[catalyst_widget_width]" value="<?php catalyst_dynamik_options_defaults( true, 'catalyst_widget_width' ); ?>" style="width:40px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( '( Blank = ', 'catalyst' ); ?> <select id="catalyst-catalyst-widget-width-type" name="catalyst[catalyst_widget_width_type]" size="1" style="width:105px;">
					<option value="No Set Width"<?php if (catalyst_get_dynamik( 'catalyst_widget_width_type' ) == 'No Set Width') echo ' selected="selected"'; ?>><?php _e( 'No Set Width', 'catalyst' ); ?></option>
					<option value="100% Width"<?php if (catalyst_get_dynamik( 'catalyst_widget_width_type' ) == '100% Width') echo ' selected="selected"'; ?>><?php _e( '100% Width', 'catalyst' ); ?></option>
				</select><?php _e( ' ) |', 'catalyst' ); ?>
				<?php _e( 'Widget Float', 'catalyst' ); ?> <select id="catalyst-widget-float" name="catalyst[catalyst_widget_float]" size="1" style="width:60px;">
					<option value="none"<?php if (catalyst_get_dynamik( 'catalyst_widget_float' ) == 'none') echo ' selected="selected"'; ?>><?php _e( 'None', 'catalyst' ); ?></option>
					<option value="left"<?php if (catalyst_get_dynamik( 'catalyst_widget_float' ) == 'left') echo ' selected="selected"'; ?>><?php _e( 'Left', 'catalyst' ); ?></option>
					<option value="right"<?php if (catalyst_get_dynamik( 'catalyst_widget_float' ) == 'right') echo ' selected="selected"'; ?>><?php _e( 'Right', 'catalyst' ); ?></option>
				</select>
			</p>
		</div>
		
		<div class="dynamik-design-standard-hide">
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Catalyst Widget Margins', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p>
				<?php _e( 'Margin: Top', 'catalyst' ); ?>
				<input type="text" id="catalyst-widget-margin-top" name="catalyst[catalyst_widget_margin_top]" value="<?php catalyst_dynamik_options_defaults( true, 'catalyst_widget_margin_top' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Right', 'catalyst' ); ?>
				<input type="text" class="catalyst-widget-width-option" id="catalyst-widget-margin-right" name="catalyst[catalyst_widget_margin_right]" value="<?php catalyst_dynamik_options_defaults( true, 'catalyst_widget_margin_right' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Bottom', 'catalyst' ); ?>
				<input type="text" id="catalyst-widget-margin-bottom" name="catalyst[catalyst_widget_margin_bottom]" value="<?php catalyst_dynamik_options_defaults( true, 'catalyst_widget_margin_bottom' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Left', 'catalyst' ); ?>
				<input type="text" class="catalyst-widget-width-option" id="catalyst-widget-margin-left" name="catalyst[catalyst_widget_margin_left]" value="<?php catalyst_dynamik_options_defaults( true, 'catalyst_widget_margin_left' ); ?>" style="width:35px;" /><?php _e( 'px', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Catalyst Widget Padding', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p>
				<?php _e( 'Padding: Top', 'catalyst' ); ?>
				<input type="text" id="catalyst-widget-padding-top" name="catalyst[catalyst_widget_padding_top]" value="<?php catalyst_dynamik_options_defaults( true, 'catalyst_widget_padding_top' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Right', 'catalyst' ); ?>
				<input type="text" class="catalyst-widget-width-option" id="catalyst-widget-padding-right" name="catalyst[catalyst_widget_padding_right]" value="<?php catalyst_dynamik_options_defaults( true, 'catalyst_widget_padding_right' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Bottom', 'catalyst' ); ?>
				<input type="text" id="catalyst-widget-padding-bottom" name="catalyst[catalyst_widget_padding_bottom]" value="<?php catalyst_dynamik_options_defaults( true, 'catalyst_widget_padding_bottom' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Left', 'catalyst' ); ?>
				<input type="text" class="catalyst-widget-width-option" id="catalyst-widget-padding-left" name="catalyst[catalyst_widget_padding_left]" value="<?php catalyst_dynamik_options_defaults( true, 'catalyst_widget_padding_left' ); ?>" style="width:35px;" /><?php _e( 'px', 'catalyst' ); ?>
			</p>
		</div>
		
		</div><!-- End .dynamik-design-standard-hide -->

		<h3 style="margin-top:15px; float:left;"><?php _e( 'Catalyst Excerpt Widget', 'catalyst' ); ?> <span id="catalyst-excerpt-widget-design-tooltip" class="tooltip-mark tooltip-center-left">[?]</span></h3>
		
		<div class="tooltip tooltip-400">
			<p>
				<?php _e( '<strong>Note:</strong> When adding Excerpt Widgets to Sidebar 1 and/or Sidebar 2 some of the styling will be inherited by the sidebars. Only when added to a Custom Widget Area will all the Excerpt Widget styling take effect.', 'catalyst' ); ?>
			</p>
		</div>

		<div class="catalyst-font-option-desc">
			<p><?php _e( 'Excerpt Widget Heading Fonts', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select class="catalyst-universal-font-type-child catalyst-universal-heading-font-type-child" id="catalyst-excerpt-widget-heading-font-type" name="catalyst[font_type][excerpt_widget_heading]" size="1" style="width:98px;">
				<?php catalyst_build_font_menu( $dynamik_font_type['excerpt_widget_heading'] ); ?></select>
				<input type="text" id="catalyst-excerpt-widget-heading-font-size" name="catalyst[excerpt_widget_heading_font_size]" value="<?php catalyst_dynamik_options_defaults( true, 'excerpt_widget_heading_font_size' ); ?>" style="width:40px;" />
				<select class="catalyst-universal-px-em-child catalyst-universal-heading-px-em-child" id="catalyst-excerpt-widget-heading-px-em" name="catalyst[excerpt_widget_heading_px_em]" size="1" style="width:50px;">
					<option value="px"<?php echo ( catalyst_get_dynamik( 'excerpt_widget_heading_px_em' ) == 'px' ) ? ' selected="selected"' : ''; ?>>px</option>
					<option value="em"<?php echo ( catalyst_get_dynamik( 'excerpt_widget_heading_px_em' ) == 'em' ) ? ' selected="selected"' : ''; ?>>em</option>
				</select>
				<input type="checkbox" class="universal-check" id="catalyst-excerpt-widget-heading-font-universal" name="catalyst[excerpt_widget_heading_font_u]" value="u" <?php if( checked( 'u', catalyst_get_dynamik( 'excerpt_widget_heading_font_u' ) ) ); ?> /> <?php _e( '(U)', 'catalyst' ); ?>
				<span class="catalyst-custom-fonts-button-wrap"><span id="show-excerpt-widget-heading-font-css" class="catalyst-custom-fonts-button">#Custom</span></span>
				<div style="display:none;" id="show-excerpt-widget-heading-font-css-box" class="catalyst-custom-fonts-box">
				<?php _e( 'Excerpt Widget Heading Font Custom CSS | <code>.catalyst-excerpt-widget h2 { }</code>', 'catalyst' ); ?><br />
				<textarea class="catalyst-universal-font-css-child catalyst-universal-heading-font-css-child" id="catalyst-excerpt-widget-heading-font-css" name="catalyst[excerpt_widget_heading_font_css]" style="width:100%;" rows="10"><?php echo catalyst_get_dynamik( 'excerpt_widget_heading_font_css' ); ?></textarea>
				</div>
			</p>
		</div>
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'Excerpt Widget (H) Link', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Link', 'catalyst' ); ?><input type="text" class="catalyst-universal-link-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-excerpt-widget-heading-link-color" name="catalyst[excerpt_widget_heading_link_color]" value="<?php catalyst_dynamik_options_defaults( true, 'excerpt_widget_heading_link_color' ); ?>" />
				<?php _e( 'Link Hover', 'catalyst' ); ?><input type="text" class="catalyst-universal-link-hover-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-excerpt-widget-heading-link-hover-color" name="catalyst[excerpt_widget_heading_link_hover_color]" value="<?php catalyst_dynamik_options_defaults( true, 'excerpt_widget_heading_link_hover_color' ); ?>" />
				<?php _e( 'Link Underline', 'catalyst' ); ?> <select class="catalyst-universal-link-underline-child" id="catalyst-excerpt-widget-heading-link-underline" name="catalyst[excerpt_widget_heading_link_underline]" size="1" style="width:90px;">
					<option value="Never"<?php if (catalyst_get_dynamik( 'excerpt_widget_heading_link_underline' ) == 'Never') echo ' selected="selected"'; ?>><?php _e( 'Never', 'catalyst' ); ?></option>
					<option value="On Hover"<?php if (catalyst_get_dynamik( 'excerpt_widget_heading_link_underline' ) == 'On Hover') echo ' selected="selected"'; ?>><?php _e( 'On Hover', 'catalyst' ); ?></option>
					<option value="Off Hover"<?php if (catalyst_get_dynamik( 'excerpt_widget_heading_link_underline' ) == 'Off Hover') echo ' selected="selected"'; ?>><?php _e( 'Off Hover', 'catalyst' ); ?></option>
					<option value="Always"<?php if (catalyst_get_dynamik( 'excerpt_widget_heading_link_underline' ) == 'Always') echo ' selected="selected"'; ?>><?php _e( 'Always', 'catalyst' ); ?></option>
				</select>
				<input type="checkbox" class="universal-check" id="catalyst-excerpt-widget-heading-link-universal" name="catalyst[excerpt_widget_heading_link_u]" value="u" <?php if( checked( 'u', catalyst_get_dynamik( 'excerpt_widget_heading_link_u' ) ) ); ?> /> <?php _e( '(U)', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'Excerpt Widget Byline Fonts', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select class="catalyst-universal-font-type-child catalyst-universal-content-font-type-child" id="catalyst-excerpt-widget-byline-font-type" name="catalyst[font_type][excerpt_widget_byline]" size="1" style="width:98px;">
				<?php catalyst_build_font_menu( $dynamik_font_type['excerpt_widget_byline'] ); ?></select>
				<input type="text" id="catalyst-excerpt-widget-byline-font-size" name="catalyst[excerpt_widget_byline_font_size]" value="<?php catalyst_dynamik_options_defaults( true, 'excerpt_widget_byline_font_size' ); ?>" style="width:40px;" />
				<select class="catalyst-universal-px-em-child catalyst-universal-content-px-em-child" id="catalyst-excerpt-widget-byline-px-em" name="catalyst[excerpt_widget_byline_px_em]" size="1" style="width:50px;">
					<option value="px"<?php echo ( catalyst_get_dynamik( 'excerpt_widget_byline_px_em' ) == 'px' ) ? ' selected="selected"' : ''; ?>>px</option>
					<option value="em"<?php echo ( catalyst_get_dynamik( 'excerpt_widget_byline_px_em' ) == 'em' ) ? ' selected="selected"' : ''; ?>>em</option>
				</select>
				<?php _e( 'Color', 'catalyst' ); ?><input type="text" class="catalyst-universal-font-color-child catalyst-universal-content-font-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-excerpt-widget-byline-font-color" name="catalyst[excerpt_widget_byline_font_color]" value="<?php catalyst_dynamik_options_defaults( true, 'excerpt_widget_byline_font_color' ); ?>" />
				<input type="checkbox" class="universal-check" id="catalyst-excerpt-widget-byline-font-universal" name="catalyst[excerpt_widget_byline_font_u]" value="u" <?php if( checked( 'u', catalyst_get_dynamik( 'excerpt_widget_byline_font_u' ) ) ); ?> /> <?php _e( '(U)', 'catalyst' ); ?>
				<span class="catalyst-custom-fonts-button-wrap"><span id="show-excerpt-widget-byline-font-css" class="catalyst-custom-fonts-button">#Custom</span></span>
				<div style="display:none;" id="show-excerpt-widget-byline-font-css-box" class="catalyst-custom-fonts-box">
				<?php _e( 'Excerpt Widget Byline Font Custom CSS<code>.catalyst-excerpt-widget .bylinemeta {}</code>', 'catalyst' ); ?><br />
				<textarea class="catalyst-universal-font-css-child catalyst-universal-content-font-css-child" id="catalyst-excerpt-widget-byline-font-css" name="catalyst[excerpt_widget_byline_font_css]" style="width:100%;" rows="10"><?php echo catalyst_get_dynamik( 'excerpt_widget_byline_font_css' ); ?></textarea>
				</div>
			</p>
		</div>
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'Excerpt Widget (B) Link', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Link', 'catalyst' ); ?><input type="text" class="catalyst-universal-link-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-excerpt-widget-byline-link-color" name="catalyst[excerpt_widget_byline_link_color]" value="<?php catalyst_dynamik_options_defaults( true, 'excerpt_widget_byline_link_color' ); ?>" />
				<?php _e( 'Link Hover', 'catalyst' ); ?><input type="text" class="catalyst-universal-link-hover-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-excerpt-widget-byline-link-hover-color" name="catalyst[excerpt_widget_byline_link_hover_color]" value="<?php catalyst_dynamik_options_defaults( true, 'excerpt_widget_byline_link_hover_color' ); ?>" />
				<?php _e( 'Link Underline', 'catalyst' ); ?> <select class="catalyst-universal-link-underline-child" id="catalyst-excerpt-widget-byline-link-underline" name="catalyst[excerpt_widget_byline_link_underline]" size="1" style="width:90px;">
					<option value="Never"<?php if (catalyst_get_dynamik( 'excerpt_widget_byline_link_underline' ) == 'Never') echo ' selected="selected"'; ?>><?php _e( 'Never', 'catalyst' ); ?></option>
					<option value="On Hover"<?php if (catalyst_get_dynamik( 'excerpt_widget_byline_link_underline' ) == 'On Hover') echo ' selected="selected"'; ?>><?php _e( 'On Hover', 'catalyst' ); ?></option>
					<option value="Off Hover"<?php if (catalyst_get_dynamik( 'excerpt_widget_byline_link_underline' ) == 'Off Hover') echo ' selected="selected"'; ?>><?php _e( 'Off Hover', 'catalyst' ); ?></option>
					<option value="Always"<?php if (catalyst_get_dynamik( 'excerpt_widget_byline_link_underline' ) == 'Always') echo ' selected="selected"'; ?>><?php _e( 'Always', 'catalyst' ); ?></option>
				</select>
				<input type="checkbox" class="universal-check" id="catalyst-excerpt-widget-byline-link-universal" name="catalyst[excerpt_widget_byline_link_u]" value="u" <?php if( checked( 'u', catalyst_get_dynamik( 'excerpt_widget_byline_link_u' ) ) ); ?> /> <?php _e( '(U)', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'Excerpt Widget Paragraph Fonts', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select class="catalyst-universal-font-type-child catalyst-universal-content-font-type-child" id="catalyst-excerpt-widget-p-font-type" name="catalyst[font_type][excerpt_widget_p]" size="1" style="width:98px;">
				<?php catalyst_build_font_menu( $dynamik_font_type['excerpt_widget_p'] ); ?></select>
				<input type="text" id="catalyst-excerpt-widget-p-font-size" name="catalyst[excerpt_widget_p_font_size]" value="<?php catalyst_dynamik_options_defaults( true, 'excerpt_widget_p_font_size' ); ?>" style="width:40px;" />
				<select class="catalyst-universal-px-em-child catalyst-universal-content-px-em-child" id="catalyst-excerpt-widget-p-px-em" name="catalyst[excerpt_widget_p_px_em]" size="1" style="width:50px;">
					<option value="px"<?php echo ( catalyst_get_dynamik( 'excerpt_widget_p_px_em' ) == 'px' ) ? ' selected="selected"' : ''; ?>>px</option>
					<option value="em"<?php echo ( catalyst_get_dynamik( 'excerpt_widget_p_px_em' ) == 'em' ) ? ' selected="selected"' : ''; ?>>em</option>
				</select>
				<?php _e( 'Color', 'catalyst' ); ?><input type="text" class="catalyst-universal-font-color-child catalyst-universal-content-font-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-excerpt-widget-p-font-color" name="catalyst[excerpt_widget_p_font_color]" value="<?php catalyst_dynamik_options_defaults( true, 'excerpt_widget_p_font_color' ); ?>" />
				<input type="checkbox" class="universal-check" id="catalyst-excerpt-widget-p-font-universal" name="catalyst[excerpt_widget_p_font_u]" value="u" <?php if( checked( 'u', catalyst_get_dynamik( 'excerpt_widget_p_font_u' ) ) ); ?> /> <?php _e( '(U)', 'catalyst' ); ?>
				<span class="catalyst-custom-fonts-button-wrap"><span id="show-excerpt-widget-p-font-css" class="catalyst-custom-fonts-button">#Custom</span></span>
				<div style="display:none;" id="show-excerpt-widget-p-font-css-box" class="catalyst-custom-fonts-box">
				<?php _e( 'Excerpt Widget Paragraph Font Custom CSS | <code>.catalyst-excerpt-widget p { }</code>', 'catalyst' ); ?><br />
				<textarea class="catalyst-universal-font-css-child catalyst-universal-content-font-css-child" id="catalyst-excerpt-widget-p-font-css" name="catalyst[excerpt_widget_p_font_css]" style="width:100%;" rows="10"><?php echo catalyst_get_dynamik( 'excerpt_widget_p_font_css' ); ?></textarea>
				</div>
			</p>
		</div>
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'Excerpt Widget (P) Link', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Link', 'catalyst' ); ?><input type="text" class="catalyst-universal-link-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-excerpt-widget-p-link-color" name="catalyst[excerpt_widget_p_link_color]" value="<?php catalyst_dynamik_options_defaults( true, 'excerpt_widget_p_link_color' ); ?>" />
				<?php _e( 'Link Hover', 'catalyst' ); ?><input type="text" class="catalyst-universal-link-hover-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-excerpt-widget-p-link-hover-color" name="catalyst[excerpt_widget_p_link_hover_color]" value="<?php catalyst_dynamik_options_defaults( true, 'excerpt_widget_p_link_hover_color' ); ?>" />
				<?php _e( 'Link Underline', 'catalyst' ); ?> <select class="catalyst-universal-link-underline-child" id="catalyst-excerpt-widget-p-link-underline" name="catalyst[excerpt_widget_p_link_underline]" size="1" style="width:90px;">
					<option value="Never"<?php if (catalyst_get_dynamik( 'excerpt_widget_p_link_underline' ) == 'Never') echo ' selected="selected"'; ?>><?php _e( 'Never', 'catalyst' ); ?></option>
					<option value="On Hover"<?php if (catalyst_get_dynamik( 'excerpt_widget_p_link_underline' ) == 'On Hover') echo ' selected="selected"'; ?>><?php _e( 'On Hover', 'catalyst' ); ?></option>
					<option value="Off Hover"<?php if (catalyst_get_dynamik( 'excerpt_widget_p_link_underline' ) == 'Off Hover') echo ' selected="selected"'; ?>><?php _e( 'Off Hover', 'catalyst' ); ?></option>
					<option value="Always"<?php if (catalyst_get_dynamik( 'excerpt_widget_p_link_underline' ) == 'Always') echo ' selected="selected"'; ?>><?php _e( 'Always', 'catalyst' ); ?></option>
				</select>
				<input type="checkbox" class="universal-check" id="catalyst-excerpt-widget-p-link-universal" name="catalyst[excerpt_widget_p_link_u]" value="u" <?php if( checked( 'u', catalyst_get_dynamik( 'excerpt_widget_p_link_u' ) ) ); ?> /> <?php _e( '(U)', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="dynamik-design-standard-hide">
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Excerpt Widget Margins', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p>
				<?php _e( 'Margin: Top', 'catalyst' ); ?>
				<input type="text" id="catalyst-excerpt-widget-margin-top" name="catalyst[excerpt_widget_margin_top]" value="<?php catalyst_dynamik_options_defaults( true, 'excerpt_widget_margin_top' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Right', 'catalyst' ); ?>
				<input type="text" id="catalyst-excerpt-widget-margin-right" name="catalyst[excerpt_widget_margin_right]" value="<?php catalyst_dynamik_options_defaults( true, 'excerpt_widget_margin_right' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Bottom', 'catalyst' ); ?>
				<input type="text" id="catalyst-excerpt-widget-margin-bottom" name="catalyst[excerpt_widget_margin_bottom]" value="<?php catalyst_dynamik_options_defaults( true, 'excerpt_widget_margin_bottom' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Left', 'catalyst' ); ?>
				<input type="text" id="catalyst-excerpt-widget-margin-left" name="catalyst[excerpt_widget_margin_left]" value="<?php catalyst_dynamik_options_defaults( true, 'excerpt_widget_margin_left' ); ?>" style="width:35px;" /><?php _e( 'px', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Excerpt Widget Padding', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p>
				<?php _e( 'Padding: Top', 'catalyst' ); ?>
				<input type="text" id="catalyst-excerpt-widget-padding-top" name="catalyst[excerpt_widget_padding_top]" value="<?php catalyst_dynamik_options_defaults( true, 'excerpt_widget_padding_top' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Right', 'catalyst' ); ?>
				<input type="text" id="catalyst-excerpt-widget-padding-right" name="catalyst[excerpt_widget_padding_right]" value="<?php catalyst_dynamik_options_defaults( true, 'excerpt_widget_padding_right' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Bottom', 'catalyst' ); ?>
				<input type="text" id="catalyst-excerpt-widget-padding-bottom" name="catalyst[excerpt_widget_padding_bottom]" value="<?php catalyst_dynamik_options_defaults( true, 'excerpt_widget_padding_bottom' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Left', 'catalyst' ); ?>
				<input type="text" id="catalyst-excerpt-widget-padding-left" name="catalyst[excerpt_widget_padding_left]" value="<?php catalyst_dynamik_options_defaults( true, 'excerpt_widget_padding_left' ); ?>" style="width:35px;" /><?php _e( 'px', 'catalyst' ); ?>
			</p>
		</div>
		
		</div><!-- End .dynamik-design-standard-hide -->
		
		<h3 style="margin-top:15px; float:left;"><?php _e( 'WordPress "Pages" Widget', 'catalyst' ); ?></h3>
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'WordPress "Pages" Widget Fonts', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select class="catalyst-universal-font-type-child catalyst-universal-content-font-type-child" id="catalyst-sb-pages-font-type" name="catalyst[font_type][sb_pages]" size="1" style="width:98px;">
				<?php catalyst_build_font_menu( $dynamik_font_type['sb_pages'] ); ?></select>
				<input type="text" id="catalyst-sb-pages-font-size" name="catalyst[sb_pages_font_size]" value="<?php catalyst_dynamik_options_defaults( true, 'sb_pages_font_size' ); ?>" style="width:40px;" />
				<select class="catalyst-universal-px-em-child catalyst-universal-content-px-em-child" id="catalyst-sb-pages-px-em" name="catalyst[sb_pages_px_em]" size="1" style="width:50px;">
					<option value="px"<?php echo ( catalyst_get_dynamik( 'sb_pages_px_em' ) == 'px' ) ? ' selected="selected"' : ''; ?>>px</option>
					<option value="em"<?php echo ( catalyst_get_dynamik( 'sb_pages_px_em' ) == 'em' ) ? ' selected="selected"' : ''; ?>>em</option>
				</select>
				<?php _e( 'Color', 'catalyst' ); ?><input type="text" class="catalyst-universal-font-color-child catalyst-universal-content-font-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-sb-pages-font-color" name="catalyst[sb_pages_font_color]" value="<?php catalyst_dynamik_options_defaults( true, 'sb_pages_font_color' ); ?>" />
				<input type="checkbox" class="universal-check" id="catalyst-sb-pages-font-universal" name="catalyst[sb_pages_font_u]" value="u" <?php if( checked( 'u', catalyst_get_dynamik( 'sb_pages_font_u' ) ) ); ?> /> <?php _e( '(U)', 'catalyst' ); ?>
				<span class="catalyst-custom-fonts-button-wrap"><span id="show-sb-pages-font-css" class="catalyst-custom-fonts-button">#Custom</span></span>
				<div style="display:none;" id="show-sb-pages-font-css-box" class="catalyst-custom-fonts-box">
				<?php _e( 'WordPress "Pages" Widget Font Custom CSS | <code>.widget_pages { }</code>', 'catalyst' ); ?><br />
				<textarea class="catalyst-universal-font-css-child catalyst-universal-content-font-css-child" id="catalyst-sb-pages-font-css" name="catalyst[sb_pages_font_css]" style="width:100%;" rows="10"><?php echo catalyst_get_dynamik( 'sb_pages_font_css' ); ?></textarea>
				</div>
			</p>
		</div>
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'WordPress "Pages" Widget Links', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Link', 'catalyst' ); ?><input type="text" class="catalyst-universal-link-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-sb-pages-link-color" name="catalyst[sb_pages_link_color]" value="<?php catalyst_dynamik_options_defaults( true, 'sb_pages_link_color' ); ?>" />
				<?php _e( 'Link Hover', 'catalyst' ); ?><input type="text" class="catalyst-universal-link-hover-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-sb-pages-link-hover-color" name="catalyst[sb_pages_link_hover_color]" value="<?php catalyst_dynamik_options_defaults( true, 'sb_pages_link_hover_color' ); ?>" />
				<?php _e( 'Link Underline', 'catalyst' ); ?> <select class="catalyst-universal-link-underline-child" id="catalyst-sb-pages-link-underline" name="catalyst[sb_pages_link_underline]" size="1" style="width:90px;">
					<option value="Never"<?php if (catalyst_get_dynamik( 'sb_pages_link_underline' ) == 'Never') echo ' selected="selected"'; ?>><?php _e( 'Never', 'catalyst' ); ?></option>
					<option value="On Hover"<?php if (catalyst_get_dynamik( 'sb_pages_link_underline' ) == 'On Hover') echo ' selected="selected"'; ?>><?php _e( 'On Hover', 'catalyst' ); ?></option>
					<option value="Off Hover"<?php if (catalyst_get_dynamik( 'sb_pages_link_underline' ) == 'Off Hover') echo ' selected="selected"'; ?>><?php _e( 'Off Hover', 'catalyst' ); ?></option>
					<option value="Always"<?php if (catalyst_get_dynamik( 'sb_pages_link_underline' ) == 'Always') echo ' selected="selected"'; ?>><?php _e( 'Always', 'catalyst' ); ?></option>
				</select>
				<input type="checkbox" class="universal-check" id="catalyst-sb-pages-link-universal" name="catalyst[sb_pages_link_u]" value="u" <?php if( checked( 'u', catalyst_get_dynamik( 'sb_pages_link_u' ) ) ); ?> /> <?php _e( '(U)', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'WordPress "Pages" Widget Heading', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design" style="padding-top:10px;">
				<?php _e( 'WordPress "Pages" Widget Heading Display', 'catalyst' ); ?> <input type="checkbox" id="catalyst-sb-pages-heading-display" name="catalyst[sb_pages_heading_display]" value="1" <?php if( checked( 1, catalyst_get_dynamik( 'sb_pages_heading_display' ) ) ); ?> />
			</p>
		</div>
	</div>
</div>