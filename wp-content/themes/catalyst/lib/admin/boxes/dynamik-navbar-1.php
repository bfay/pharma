<?php
/**
 * Builds the Dynamik Navbar 1 admin content.
 *
 * @package Catalyst
 */
?>

<div id="catalyst-dynamik-options-nav-<?php echo $nav_alt_id; ?>nav1-box" class="catalyst-optionbox-outer-1col catalyst-all-options<?php echo $nav_display; ?>">
	<div class="catalyst-optionbox-inner-1col">
		<h3><?php _e( 'Navbar 1', 'catalyst' ); ?></h3>
		
		<div class="dynamik-structure-settings-hide">
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'Main Font', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select class="catalyst-universal-font-type-child" id="catalyst-nav1-font-type" name="catalyst[font_type][nav1]" size="1" style="width:98px;">
				<?php catalyst_build_font_menu( $dynamik_font_type['nav1'] ); ?></select>
				<input type="text" id="catalyst-nav1-font-size" name="catalyst[nav1_font_size]" value="<?php catalyst_dynamik_options_defaults( true, 'nav1_font_size' ); ?>" style="width:40px;" />
				<select class="catalyst-universal-px-em-child" id="catalyst-nav1-px-em" name="catalyst[nav1_px_em]" size="1" style="width:50px;">
					<option value="px"<?php echo ( catalyst_get_dynamik( 'nav1_px_em' ) == 'px' ) ? ' selected="selected"' : ''; ?>>px</option>
					<option value="em"<?php echo ( catalyst_get_dynamik( 'nav1_px_em' ) == 'em' ) ? ' selected="selected"' : ''; ?>>em</option>
				</select>
				<?php _e( 'Link Underline', 'catalyst' ); ?> <select class="catalyst-universal-link-underline-child" id="catalyst-nav1-link-underline" name="catalyst[nav1_link_underline]" size="1" style="width:90px;">
					<option value="Never"<?php if (catalyst_get_dynamik( 'nav1_link_underline' ) == 'Never') echo ' selected="selected"'; ?>><?php _e( 'Never', 'catalyst' ); ?></option>
					<option value="On Hover"<?php if (catalyst_get_dynamik( 'nav1_link_underline' ) == 'On Hover') echo ' selected="selected"'; ?>><?php _e( 'On Hover', 'catalyst' ); ?></option>
					<option value="Off Hover"<?php if (catalyst_get_dynamik( 'nav1_link_underline' ) == 'Off Hover') echo ' selected="selected"'; ?>><?php _e( 'Off Hover', 'catalyst' ); ?></option>
					<option value="Always"<?php if (catalyst_get_dynamik( 'nav1_link_underline' ) == 'Always') echo ' selected="selected"'; ?>><?php _e( 'Always', 'catalyst' ); ?></option>
				</select>
				<input type="checkbox" class="universal-check" id="catalyst-nav1-font-universal" name="catalyst[nav1_font_u]" value="u" <?php if( checked( 'u', catalyst_get_dynamik( 'nav1_font_u' ) ) ); ?> /> <?php _e( '(U)', 'catalyst' ); ?>
				<span class="catalyst-custom-fonts-button-wrap"><span id="show-nav1-font-css" class="catalyst-custom-fonts-button">#Custom</span></span>
				<div style="display:none;" id="show-nav1-font-css-box" class="catalyst-custom-fonts-box">
				<?php _e( 'Nav1 Font Custom CSS | <code>#navbar-1-wrap { }</code>', 'catalyst' ); ?><br />
				<textarea class="catalyst-universal-font-css-child" id="catalyst-nav1-font-css" name="catalyst[nav1_font_css]" style="width:100%;" rows="10"><?php echo catalyst_get_dynamik( 'nav1_font_css' ); ?></textarea>
				</div>
			</p>
		</div>
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'Inactive/Hover/Active Page Fonts', 'catalyst' ); ?></p>
		</div>

		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Inactive Color', 'catalyst' ); ?><input type="text" class="catalyst-universal-font-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-nav1-page-font-color" name="catalyst[nav1_page_font_color]" value="<?php catalyst_dynamik_options_defaults( true, 'nav1_page_font_color' ); ?>" />
				<?php _e( 'Hover Color', 'catalyst' ); ?><input type="text" class="catalyst-universal-link-hover-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-nav1-page-hover-font-color" name="catalyst[nav1_page_hover_font_color]" value="<?php catalyst_dynamik_options_defaults( true, 'nav1_page_hover_font_color' ); ?>" />
				<?php _e( 'Active Color', 'catalyst' ); ?><input type="text" class="catalyst-universal-font-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-nav1-page-active-font-color" name="catalyst[nav1_page_active_font_color]" value="<?php catalyst_dynamik_options_defaults( true, 'nav1_page_active_font_color' ); ?>" />
				<input type="checkbox" class="universal-check" id="catalyst-nav1-page-font-universal" name="catalyst[nav1_page_font_u]" value="u" <?php if( checked( 'u', catalyst_get_dynamik( 'nav1_page_font_u' ) ) ); ?> /> <?php _e( '(U)', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'Sub-Page Fonts', 'catalyst' ); ?></p>
		</div>

		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Color', 'catalyst' ); ?><input type="text" class="catalyst-universal-font-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-nav1-sub-page-font-color" name="catalyst[nav1_sub_page_font_color]" value="<?php catalyst_dynamik_options_defaults( true, 'nav1_sub_page_font_color' ); ?>" />
				<?php _e( 'Hover Color', 'catalyst' ); ?><input type="text" class="catalyst-universal-link-hover-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-nav1-sub-page-hover-font-color" name="catalyst[nav1_sub_page_hover_font_color]" value="<?php catalyst_dynamik_options_defaults( true, 'nav1_sub_page_hover_font_color' ); ?>" />
				<input type="checkbox" class="universal-check" id="catalyst-nav1-sub-page-font-universal" name="catalyst[nav1_sub_page_font_u]" value="u" <?php if( checked( 'u', catalyst_get_dynamik( 'nav1_sub_page_font_u' ) ) ); ?> /> <?php _e( '(U)', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'Navbar 1 Right Font', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select class="catalyst-universal-font-type-child" id="catalyst-nav1-right-font-type" name="catalyst[font_type][nav1_right]" size="1" style="width:98px;">
				<?php catalyst_build_font_menu( $dynamik_font_type['nav1_right'] ); ?></select>
				<input type="text" id="catalyst-nav1-right-font-size" name="catalyst[nav1_right_font_size]" value="<?php catalyst_dynamik_options_defaults( true, 'nav1_right_font_size' ); ?>" style="width:40px;" />
				<select class="catalyst-universal-px-em-child" id="catalyst-nav1-right-px-em" name="catalyst[nav1_right_px_em]" size="1" style="width:50px;">
					<option value="px"<?php echo ( catalyst_get_dynamik( 'nav1_right_px_em' ) == 'px' ) ? ' selected="selected"' : ''; ?>>px</option>
					<option value="em"<?php echo ( catalyst_get_dynamik( 'nav1_right_px_em' ) == 'em' ) ? ' selected="selected"' : ''; ?>>em</option>
				</select>
				<?php _e( 'Color', 'catalyst' ); ?><input type="text" class="catalyst-universal-font-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-nav1-right-font-color" name="catalyst[nav1_right_font_color]" value="<?php catalyst_dynamik_options_defaults( true, 'nav1_right_font_color' ); ?>" />
				<input type="checkbox" class="universal-check" id="catalyst-nav1-right-font-universal" name="catalyst[nav1_right_font_u]" value="u" <?php if( checked( 'u', catalyst_get_dynamik( 'nav1_right_font_u' ) ) ); ?> /> <?php _e( '(U)', 'catalyst' ); ?>
				<span class="catalyst-custom-fonts-button-wrap"><span id="show-nav1-right-font-css" class="catalyst-custom-fonts-button">#Custom</span></span>
				<div style="display:none;" id="show-nav1-right-font-css-box" class="catalyst-custom-fonts-box">
				<?php _e( 'Nav1 Right Font Custom CSS | <code>.navbar-1-right { }</code>', 'catalyst' ); ?><br />
				<textarea class="catalyst-universal-font-css-child" id="catalyst-nav1-right-font-css" name="catalyst[nav1_right_font_css]" style="width:100%;" rows="10"><?php echo catalyst_get_dynamik( 'nav1_right_font_css' ); ?></textarea>
				</div>
			</p>
		</div>
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'Navbar 1 Right Link', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Link', 'catalyst' ); ?><input type="text" class="catalyst-universal-link-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-nav1-right-link-color" name="catalyst[nav1_right_link_color]" value="<?php catalyst_dynamik_options_defaults( true, 'nav1_right_link_color' ); ?>" />
				<?php _e( 'Link Hover', 'catalyst' ); ?><input type="text" class="catalyst-universal-link-hover-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-nav1-right-link-hover-color" name="catalyst[nav1_right_link_hover_color]" value="<?php catalyst_dynamik_options_defaults( true, 'nav1_right_link_hover_color' ); ?>" />
				<?php _e( 'Link Underline', 'catalyst' ); ?> <select class="catalyst-universal-link-underline-child" id="catalyst-nav1-right-link-underline" name="catalyst[nav1_right_link_underline]" size="1" style="width:90px;">
					<option value="Never"<?php if (catalyst_get_dynamik( 'nav1_right_link_underline' ) == 'Never') echo ' selected="selected"'; ?>><?php _e( 'Never', 'catalyst' ); ?></option>
					<option value="On Hover"<?php if (catalyst_get_dynamik( 'nav1_right_link_underline' ) == 'On Hover') echo ' selected="selected"'; ?>><?php _e( 'On Hover', 'catalyst' ); ?></option>
					<option value="Off Hover"<?php if (catalyst_get_dynamik( 'nav1_right_link_underline' ) == 'Off Hover') echo ' selected="selected"'; ?>><?php _e( 'Off Hover', 'catalyst' ); ?></option>
					<option value="Always"<?php if (catalyst_get_dynamik( 'nav1_right_link_underline' ) == 'Always') echo ' selected="selected"'; ?>><?php _e( 'Always', 'catalyst' ); ?></option>
				</select>
				<input type="checkbox" class="universal-check" id="catalyst-nav1-right-link-universal" name="catalyst[nav1_right_link_u]" value="u" <?php if( checked( 'u', catalyst_get_dynamik( 'nav1_right_link_u' ) ) ); ?> /> <?php _e( '(U)', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="catalyst-bg-option-desc">
			<p><?php _e( 'Main Background', 'catalyst' ); ?></p>
		</div>

		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select id="catalyst-nav1-bg-type" class="catalyst-bg-type" name="catalyst[nav1_bg_type]" size="1" style="width:150px;">
				<?php catalyst_list_bg_options( catalyst_get_dynamik( 'nav1_bg_type' ) ); ?>
				</select> <span style="display:none;" id="catalyst-nav1-bg-type-checkbox"><?php _e( '(No Color', 'catalyst' ); ?> <input type="checkbox" id="catalyst-nav1-bg-no-color" name="catalyst[nav1_bg_no_color]" value="1" <?php if( checked( 1, catalyst_get_dynamik( 'nav1_bg_no_color' ) ) ); ?> />)</span><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-nav1-bg-color" name="catalyst[nav1_bg_color]" value="<?php catalyst_dynamik_options_defaults( true, 'nav1_bg_color' ); ?>" />
				<?php _e( 'Image', 'catalyst' ); ?> <select id="catalyst-nav1-bg-image" name="catalyst[nav1_bg_image]" size="1" style="width:150px;"><?php catalyst_list_images( catalyst_get_dynamik( 'nav1_bg_image' ) ); ?></select>
			</p>
		</div>
		
		<div class="catalyst-bg-option-desc">
			<p><?php _e( 'Inactive Page Background', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select id="catalyst-nav1-page-bg-type" class="catalyst-bg-type" name="catalyst[nav1_page_bg_type]" size="1" style="width:150px;">
				<?php catalyst_list_bg_options( catalyst_get_dynamik( 'nav1_page_bg_type' ) ); ?>
				</select> <span style="display:none;" id="catalyst-nav1-page-bg-type-checkbox"><?php _e( '(No Color', 'catalyst' ); ?> <input type="checkbox" id="catalyst-nav1-page-bg-no-color" name="catalyst[nav1_page_bg_no_color]" value="1" <?php if( checked( 1, catalyst_get_dynamik( 'nav1_page_bg_no_color' ) ) ); ?> />)</span><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-nav1-page-bg-color" name="catalyst[nav1_page_bg_color]" value="<?php catalyst_dynamik_options_defaults( true, 'nav1_page_bg_color' ); ?>" />
				<?php _e( 'Image', 'catalyst' ); ?> <select id="catalyst-nav1-page-bg-image" name="catalyst[nav1_page_bg_image]" size="1" style="width:150px;"><?php catalyst_list_images( catalyst_get_dynamik( 'nav1_page_bg_image' ) ); ?></select>
			</p>
		</div>
		
		<div class="catalyst-bg-option-desc">
			<p><?php _e( 'Page Hover Background', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select id="catalyst-nav1-page-hover-bg-type" class="catalyst-bg-type" name="catalyst[nav1_page_hover_bg_type]" size="1" style="width:150px;">
				<?php catalyst_list_bg_options( catalyst_get_dynamik( 'nav1_page_hover_bg_type' ) ); ?>
				</select> <span style="display:none;" id="catalyst-nav1-page-hover-bg-type-checkbox"><?php _e( '(No Color', 'catalyst' ); ?> <input type="checkbox" id="catalyst-nav1-page-hover-bg-no-color" name="catalyst[nav1_page_hover_bg_no_color]" value="1" <?php if( checked( 1, catalyst_get_dynamik( 'nav1_page_hover_bg_no_color' ) ) ); ?> />)</span><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-nav1-page-hover-bg-color" name="catalyst[nav1_page_hover_bg_color]" value="<?php catalyst_dynamik_options_defaults( true, 'nav1_page_hover_bg_color' ); ?>" />
				<?php _e( 'Image', 'catalyst' ); ?> <select id="catalyst-nav1-page-hover-bg-image" name="catalyst[nav1_page_hover_bg_image]" size="1" style="width:150px;"><?php catalyst_list_images( catalyst_get_dynamik( 'nav1_page_hover_bg_image' ) ); ?></select>
			</p>
		</div>
		
		<div class="catalyst-bg-option-desc">
			<p><?php _e( 'Active Page Background', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select id="catalyst-nav1-page-active-bg-type" class="catalyst-bg-type" name="catalyst[nav1_page_active_bg_type]" size="1" style="width:150px;">
				<?php catalyst_list_bg_options( catalyst_get_dynamik( 'nav1_page_active_bg_type' ) ); ?>
				</select> <span style="display:none;" id="catalyst-nav1-page-active-bg-type-checkbox"><?php _e( '(No Color', 'catalyst' ); ?> <input type="checkbox" id="catalyst-nav1-page-active-bg-no-color" name="catalyst[nav1_page_active_bg_no_color]" value="1" <?php if( checked( 1, catalyst_get_dynamik( 'nav1_page_active_bg_no_color' ) ) ); ?> />)</span><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-nav1-page-active-bg-color" name="catalyst[nav1_page_active_bg_color]" value="<?php catalyst_dynamik_options_defaults( true, 'nav1_page_active_bg_color' ); ?>" />
				<?php _e( 'Image', 'catalyst' ); ?> <select id="catalyst-nav1-page-active-bg-image" name="catalyst[nav1_page_active_bg_image]" size="1" style="width:150px;"><?php catalyst_list_images( catalyst_get_dynamik( 'nav1_page_active_bg_image' ) ); ?></select>
			</p>
		</div>
		
		<div class="catalyst-bg-option-desc">
			<p><?php _e( 'Sub-Page Background', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select id="catalyst-nav1-sub-page-bg-type" class="catalyst-bg-type" name="catalyst[nav1_sub_page_bg_type]" size="1" style="width:150px;">
				<?php catalyst_list_bg_options( catalyst_get_dynamik( 'nav1_sub_page_bg_type' ) ); ?>
				</select> <span style="display:none;" id="catalyst-nav1-sub-page-bg-type-checkbox"><?php _e( '(No Color', 'catalyst' ); ?> <input type="checkbox" id="catalyst-nav1-sub-page-bg-no-color" name="catalyst[nav1_sub_page_bg_no_color]" value="1" <?php if( checked( 1, catalyst_get_dynamik( 'nav1_sub_page_bg_no_color' ) ) ); ?> />)</span><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-nav1-sub-page-bg-color" name="catalyst[nav1_sub_page_bg_color]" value="<?php catalyst_dynamik_options_defaults( true, 'nav1_sub_page_bg_color' ); ?>" />
				<?php _e( 'Image', 'catalyst' ); ?> <select id="catalyst-nav1-sub-page-bg-image" name="catalyst[nav1_sub_page_bg_image]" size="1" style="width:150px;"><?php catalyst_list_images( catalyst_get_dynamik( 'nav1_sub_page_bg_image' ) ); ?></select>
			</p>
		</div>
		
		<div class="catalyst-bg-option-desc">
			<p><?php _e( 'Sub-Page Hover Background', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select id="catalyst-nav1-sub-page-hover-bg-type" class="catalyst-bg-type" name="catalyst[nav1_sub_page_hover_bg_type]" size="1" style="width:150px;">
				<?php catalyst_list_bg_options( catalyst_get_dynamik( 'nav1_sub_page_hover_bg_type' ) ); ?>
				</select> <span style="display:none;" id="catalyst-nav1-sub-page-hover-bg-type-checkbox"><?php _e( '(No Color', 'catalyst' ); ?> <input type="checkbox" id="catalyst-nav1-sub-page-hover-bg-no-color" name="catalyst[nav1_sub_page_hover_bg_no_color]" value="1" <?php if( checked( 1, catalyst_get_dynamik( 'nav1_sub_page_hover_bg_no_color' ) ) ); ?> />)</span><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-nav1-sub-page-hover-bg-color" name="catalyst[nav1_sub_page_hover_bg_color]" value="<?php catalyst_dynamik_options_defaults( true, 'nav1_sub_page_hover_bg_color' ); ?>" />
				<?php _e( 'Image', 'catalyst' ); ?> <select id="catalyst-nav1-sub-page-hover-bg-image" name="catalyst[nav1_sub_page_hover_bg_image]" size="1" style="width:150px;"><?php catalyst_list_images( catalyst_get_dynamik( 'nav1_sub_page_hover_bg_image' ) ); ?></select>
			</p>
		</div>
		
		<div class="catalyst-border-option-desc">
			<p><?php _e( 'Main Border', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select id="catalyst-nav1-border-type" name="catalyst[nav1_border_type]" size="1" style="width:98px;">
					<option value="Full"<?php if (catalyst_get_dynamik( 'nav1_border_type' ) == 'Full') echo ' selected="selected"'; ?>><?php _e( 'Full', 'catalyst' ); ?></option>
					<option value="Top/Bottom"<?php if (catalyst_get_dynamik( 'nav1_border_type' ) == 'Top/Bottom') echo ' selected="selected"'; ?>><?php _e( 'Top/Bottom', 'catalyst' ); ?></option>
					<option value="Top"<?php if (catalyst_get_dynamik( 'nav1_border_type' ) == 'Top') echo ' selected="selected"'; ?>><?php _e( 'Top', 'catalyst' ); ?></option>
					<option value="Bottom"<?php if (catalyst_get_dynamik( 'nav1_border_type' ) == 'Bottom') echo ' selected="selected"'; ?>><?php _e( 'Bottom', 'catalyst' ); ?></option>
					<option value="Left/Right"<?php if (catalyst_get_dynamik( 'nav1_border_type' ) == 'Left/Right') echo ' selected="selected"'; ?>><?php _e( 'Left/Right', 'catalyst' ); ?></option>
				</select>
				<?php _e( 'Thickness', 'catalyst' ); ?> <input type="text" id="catalyst-nav1-border-thickness" name="catalyst[nav1_border_thickness]" value="<?php catalyst_dynamik_options_defaults( true, 'nav1_border_thickness' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Style', 'catalyst' ); ?> <select id="catalyst-nav1-border-style" name="catalyst[nav1_border_style]" size="1" style="width:90px; margin-right:5px;">
					<?php catalyst_list_borders( catalyst_get_dynamik( 'nav1_border_style' ) ); ?>
				</select>
				<input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-nav1-border-color" name="catalyst[nav1_border_color]" value="<?php catalyst_dynamik_options_defaults( true, 'nav1_border_color' ); ?>" />
			</p>
		</div>
		
		<div class="catalyst-border-option-desc">
			<p><?php _e( 'Individual Page Border', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Thickness:', 'catalyst' ); ?>
				<?php _e( 'Top', 'catalyst' ); ?> <input type="text" id="catalyst-nav1-page-top-border-thickness" name="catalyst[nav1_page_top_border_thickness]" value="<?php catalyst_dynamik_options_defaults( true, 'nav1_page_top_border_thickness' ); ?>" style="width:35px;" /><?php _e( 'px', 'catalyst' ); ?>
				<?php _e( '| Btm', 'catalyst' ); ?> <input type="text" id="catalyst-nav1-page-bottom-border-thickness" name="catalyst[nav1_page_bottom_border_thickness]" value="<?php catalyst_dynamik_options_defaults( true, 'nav1_page_bottom_border_thickness' ); ?>" style="width:35px;" /><?php _e( 'px', 'catalyst' ); ?>
				<?php _e( '| Lft', 'catalyst' ); ?> <input type="text" id="catalyst-nav1-page-left-border-thickness" name="catalyst[nav1_page_left_border_thickness]" value="<?php catalyst_dynamik_options_defaults( true, 'nav1_page_left_border_thickness' ); ?>" style="width:35px;" /><?php _e( 'px', 'catalyst' ); ?>
				<?php _e( '| Rt', 'catalyst' ); ?> <input type="text" id="catalyst-nav1-page-right-border-thickness" name="catalyst[nav1_page_right_border_thickness]" value="<?php catalyst_dynamik_options_defaults( true, 'nav1_page_right_border_thickness' ); ?>" style="width:35px;" /><?php _e( 'px', 'catalyst' ); ?>
				<?php _e( '| Style', 'catalyst' ); ?> <select id="catalyst-nav1-page-border-style" name="catalyst[nav1_page_border_style]" size="1" style="width:70px;">
					<?php catalyst_list_borders( catalyst_get_dynamik( 'nav1_page_border_style' ) ); ?>
				</select>
			</p>
		</div>
		
		<div class="catalyst-border-option-desc">
			<p><?php _e( 'Individual Page Border', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Colors: Inactive', 'catalyst' ); ?> <input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-nav1-page-border-color" name="catalyst[nav1_page_border_color]" value="<?php catalyst_dynamik_options_defaults( true, 'nav1_page_border_color' ); ?>" />
				<?php _e( 'Hover', 'catalyst' ); ?> <input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-nav1-page-hover-border-color" name="catalyst[nav1_page_hover_border_color]" value="<?php catalyst_dynamik_options_defaults( true, 'nav1_page_hover_border_color' ); ?>" />
				<?php _e( 'Active', 'catalyst' ); ?> <input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-nav1-page-active-border-color" name="catalyst[nav1_page_active_border_color]" value="<?php catalyst_dynamik_options_defaults( true, 'nav1_page_active_border_color' ); ?>" />
			</p>
		</div>
		
		</div><!-- End .dynamik-structure-settings-hide -->
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Navbar 1 Placement', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Location Of Navbar 1', 'catalyst' ); ?> <select id="catalyst-nav1-location" name="catalyst[nav1_location]" size="1" style="width:115px;">
					<option value="Above Header"<?php if( catalyst_get_dynamik( 'nav1_location' ) == 'Above Header' ) echo ' selected="selected"'; ?>><?php _e( 'Above Header', 'catalyst' ); ?></option>
					<option value="Below Header"<?php if( catalyst_get_dynamik( 'nav1_location' ) == 'Below Header' ) echo ' selected="selected"'; ?>><?php _e( 'Below Header', 'catalyst' ); ?></option>
					<option value="Beside Header"<?php if( catalyst_get_dynamik( 'nav1_location' ) == 'Beside Header' ) echo ' selected="selected"'; ?>><?php _e( 'Beside Header', 'catalyst' ); ?></option>
				</select> <span id="navbar-1-location-tooltip" class="tooltip-mark tooltip-top-left">[?]</span>
				
				<div class="tooltip tooltip-400">
					<h5><?php _e( 'Moving Your Navbar Around', 'catalyst' ); ?></h5>
					
					<p>
						<?php _e( 'This option makes it super easy for you to change the physcial location of Navbar 1. When you change the location Catalyst changes the hook in which this Navbar is hooked into. For "Above Header" Navbar 1 is hooked into the catalyst_hook_before_header hook. For "Below Header" it is hooked into the catalyst_hook_after_header hook. And for "Beside Header" it is hooked into the catalyst_hook_header_right hook.', 'catalyst' ); ?>
					</p>
					
					<h5><?php _e( 'If Placing Navbar 1 "Beside Header"...', 'catalyst' ); ?></h5>
					
					<p>
						<?php _e( 'You may want to change the Width and Top and/or Right Padding of the Header Right section to adjust your Navbar\'s position more to your liking. If so you can do this by going to the', 'catalyst' ); ?>
						<a href="<?php echo admin_url( 'admin.php?page=dynamik-options&activetab=catalyst-dynamik-options-nav-header' ); ?>"><?php _e( '<b>"Header"</b>', 'catalyst' ); ?></a>
						<?php _e( 'tab in Dynamik Options where you will find the "Header-Right Padding" options.', 'catalyst' ); ?>
					</p>
				</div>
			</p>
		</div>
		
		<div class="dynamik-structure-settings-hide">
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Navbar 1 Wrap Margins', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p>
				<?php _e( 'Top Margin', 'catalyst' ); ?>
				<input type="text" id="catalyst-nav1-wrap-top-margin" name="catalyst[nav1_wrap_top_margin]" value="<?php catalyst_dynamik_options_defaults( true, 'nav1_wrap_top_margin' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Bottom Margin', 'catalyst' ); ?>
				<input type="text" id="catalyst-nav1-wrap-bottom-margin" name="catalyst[nav1_wrap_bottom_margin]" value="<?php catalyst_dynamik_options_defaults( true, 'nav1_wrap_bottom_margin' ); ?>" style="width:35px;" /><?php _e( 'px', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Individual Page Margins/Padding', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Margin: Left', 'catalyst' ); ?> <input type="text" id="catalyst-nav1-page-left-margin" name="catalyst[nav1_page_left_margin]" value="<?php catalyst_dynamik_options_defaults( true, 'nav1_page_left_margin' ); ?>" style="width:30px;" /><?php _e( 'px', 'catalyst' ); ?>
				<?php _e( 'Right', 'catalyst' ); ?> <input type="text" id="catalyst-nav1-page-right-margin" name="catalyst[nav1_page_right_margin]" value="<?php catalyst_dynamik_options_defaults( true, 'nav1_page_right_margin' ); ?>" style="width:30px;" /><?php _e( 'px', 'catalyst' ); ?>
				<?php _e( '| Padding: Top/Btm', 'catalyst' ); ?> <input type="text" id="catalyst-nav1-page-tb-padding" name="catalyst[nav1_page_tb_padding]" value="<?php catalyst_dynamik_options_defaults( true, 'nav1_page_tb_padding' ); ?>" style="width:30px;" /><?php _e( 'px', 'catalyst' ); ?>
				<?php _e( 'Lft/Rt', 'catalyst' ); ?> <input type="text" id="catalyst-nav1-page-lr-padding" name="catalyst[nav1_page_lr_padding]" value="<?php catalyst_dynamik_options_defaults( true, 'nav1_page_lr_padding' ); ?>" style="width:30px;" /><?php _e( 'px', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Navbar 1 Right Text Padding', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p>
				<?php _e( 'Top Padding', 'catalyst' ); ?>
				<input type="text" id="catalyst-nav1-right-text-padding-top" name="catalyst[nav1_right_text_padding_top]" value="<?php catalyst_dynamik_options_defaults( true, 'nav1_right_text_padding_top' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Right Padding', 'catalyst' ); ?>
				<input type="text" id="catalyst-nav1-right-text-padding-bottom" name="catalyst[nav1_right_text_padding_right]" value="<?php catalyst_dynamik_options_defaults( true, 'nav1_right_text_padding_right' ); ?>" style="width:35px;" /><?php _e( 'px', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Navbar 1 Right Search Padding', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p>
				<?php _e( 'Top Padding', 'catalyst' ); ?>
				<input type="text" id="catalyst-nav1-right-search-padding-top" name="catalyst[nav1_right_search_padding_top]" value="<?php catalyst_dynamik_options_defaults( true, 'nav1_right_search_padding_top' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Right Padding', 'catalyst' ); ?>
				<input type="text" id="catalyst-nav1-right-search-padding-bottom" name="catalyst[nav1_right_search_padding_right]" value="<?php catalyst_dynamik_options_defaults( true, 'nav1_right_search_padding_right' ); ?>" style="width:35px;" /><?php _e( 'px', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Submenu', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Border Color', 'catalyst' ); ?> <input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-nav1-submenu-border-color" name="catalyst[nav1_submenu_border_color]" value="<?php catalyst_dynamik_options_defaults( true, 'nav1_submenu_border_color' ); ?>" />
				<?php _e( 'Width', 'catalyst' ); ?> <input type="text" id="catalyst-nav1-submenu-width" name="catalyst[nav1_submenu_width]" value="<?php catalyst_dynamik_options_defaults( true, 'nav1_submenu_width' ); ?>" style="width:40px;" /><?php _e( 'px', 'catalyst' ); ?>
				<?php _e( 'Padding: Top/Btm', 'catalyst' ); ?> <input type="text" id="catalyst-nav1-submenu-tb-padding" name="catalyst[nav1_submenu_tb_padding]" value="<?php catalyst_dynamik_options_defaults( true, 'nav1_submenu_tb_padding' ); ?>" style="width:30px;" /><?php _e( 'px', 'catalyst' ); ?>
				<?php _e( 'Lft/Rt', 'catalyst' ); ?> <input type="text" id="catalyst-nav1-submenu-lr-padding" name="catalyst[nav1_submenu_lr_padding]" value="<?php catalyst_dynamik_options_defaults( true, 'nav1_submenu_lr_padding' ); ?>" style="width:30px;" /><?php _e( 'px', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Sub-Indicator', 'dynamik' ); ?> <span id="nav1-sub-indicator-tooltip" class="tooltip-mark tooltip-top-right">[?]</span></p>
			
			<div class="tooltip tooltip-400">
				<p>
					<?php _e( 'When set to "Image" you will be provided with several dimension and position settings as well as a drop-down menu to select your custom sub-indicator image.', 'dynamik' ); ?>
				</p>
			</div>
		</div>

		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'dynamik' ); ?> <select id="catalyst-nav1-sub-indicator-type" class="catalyst-nav-sub-indicator-type" name="catalyst[nav1_sub_indicator_type]" size="1" style="width:65px;">
					<option value="Text"<?php if( catalyst_get_dynamik( 'nav1_sub_indicator_type' ) == 'Text' ) echo ' selected="selected"'; ?>><?php _e( 'Text', 'dynamik' ); ?></option>
					<option value="Image"<?php if( catalyst_get_dynamik( 'nav1_sub_indicator_type' ) == 'Image' ) echo ' selected="selected"'; ?>><?php _e( 'Image', 'dynamik' ); ?></option>
				</select>
				<span style="display: none;" id="catalyst-nav1-sub-indicator-type-options">
				<select id="catalyst-nav1-sub-indicator-image" name="catalyst[nav1_sub_indicator_image]" size="1" style="width:85px;"><?php catalyst_list_images( catalyst_get_dynamik( 'nav1_sub_indicator_image' ) ); ?></select>
				<?php _e( 'Width', 'dynamik' ); ?>
				<input type="text" id="catalyst-nav1-sub-indicator-width" name="catalyst[nav1_sub_indicator_width]" value="<?php catalyst_dynamik_options_defaults( true, 'nav1_sub_indicator_width' ); ?>" style="width:30px;" /><?php _e( 'px |', 'dynamik' ); ?>
				<?php _e( 'Height', 'dynamik' ); ?>
				<input type="text" id="catalyst-nav1-sub-indicator-height" name="catalyst[nav1_sub_indicator_height]" value="<?php catalyst_dynamik_options_defaults( true, 'nav1_sub_indicator_height' ); ?>" style="width:30px;" /><?php _e( 'px |', 'dynamik' ); ?>
				<?php _e( 'Top', 'dynamik' ); ?>
				<input type="text" id="catalyst-nav1-sub-indicator-top" name="catalyst[nav1_sub_indicator_top]" value="<?php catalyst_dynamik_options_defaults( true, 'nav1_sub_indicator_top' ); ?>" style="width:30px;" /><?php _e( 'px |', 'dynamik' ); ?>
				<?php _e( 'Right', 'dynamik' ); ?>
				<input type="text" id="catalyst-nav1-sub-indicator-right" name="catalyst[nav1_sub_indicator_right]" value="<?php catalyst_dynamik_options_defaults( true, 'nav1_sub_indicator_right' ); ?>" style="width:30px;" /><?php _e( 'px', 'dynamik' ); ?>
				</span>
			</p>
		</div>
		
		</div><!-- End .dynamik-structure-settings-hide -->
		
	</div>
</div>