<?php
/**
 * Builds the Dynamik Footer admin content.
 *
 * @package Catalyst
 */
?>

<div id="catalyst-dynamik-options-nav-footer-box" class="catalyst-optionbox-outer-1col catalyst-all-options">
	<div class="catalyst-optionbox-inner-1col">
		<h3><?php _e( 'Footer', 'catalyst' ); ?></h3>
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'Footer Font', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select class="catalyst-universal-font-type-child catalyst-universal-content-font-type-child" id="catalyst-footer-font-type" name="catalyst[font_type][footer]" size="1" style="width:98px;">
				<?php catalyst_build_font_menu( $dynamik_font_type['footer'] ); ?></select>
				<input type="text" id="catalyst-footer-font-size" name="catalyst[footer_font_size]" value="<?php catalyst_dynamik_options_defaults( true, 'footer_font_size' ); ?>" style="width:40px;" />
				<select class="catalyst-universal-px-em-child catalyst-universal-content-px-em-child" id="catalyst-footer-px-em" name="catalyst[footer_px_em]" size="1" style="width:50px;">
					<option value="px"<?php echo ( catalyst_get_dynamik( 'footer_px_em' ) == 'px' ) ? ' selected="selected"' : ''; ?>>px</option>
					<option value="em"<?php echo ( catalyst_get_dynamik( 'footer_px_em' ) == 'em' ) ? ' selected="selected"' : ''; ?>>em</option>
				</select>
				<?php _e( 'Color', 'catalyst' ); ?><input type="text" class="catalyst-universal-font-color-child catalyst-universal-content-font-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-footer-font-color" name="catalyst[footer_font_color]" value="<?php catalyst_dynamik_options_defaults( true, 'footer_font_color' ); ?>" />
				<input type="checkbox" class="universal-check" id="catalyst-footer-font-universal" name="catalyst[footer_font_u]" value="u" <?php if( checked( 'u', catalyst_get_dynamik( 'footer_font_u' ) ) ); ?> /> <?php _e( '(U)', 'catalyst' ); ?>
				<span class="catalyst-custom-fonts-button-wrap"><span id="show-footer-font-css" class="catalyst-custom-fonts-button">#Custom</span></span>
				<div style="display:none;" id="show-footer-font-css-box" class="catalyst-custom-fonts-box">
				<?php _e( 'Footer Font Custom CSS | <code>#footer p { }</code>', 'catalyst' ); ?><br />
				<textarea class="catalyst-universal-font-css-child catalyst-universal-content-font-css-child" id="catalyst-footer-font-css" name="catalyst[footer_font_css]" style="width:100%;" rows="10"><?php echo catalyst_get_dynamik( 'footer_font_css' ); ?></textarea>
				</div>
			</p>
		</div>
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'Footer Link', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Link', 'catalyst' ); ?><input type="text" class="catalyst-universal-link-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-footer-link-color" name="catalyst[footer_link_color]" value="<?php catalyst_dynamik_options_defaults( true, 'footer_link_color' ); ?>" />
				<?php _e( 'Link Hover', 'catalyst' ); ?><input type="text" class="catalyst-universal-link-hover-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-footer-link-hover-color" name="catalyst[footer_link_hover_color]" value="<?php catalyst_dynamik_options_defaults( true, 'footer_link_hover_color' ); ?>" />
				<?php _e( 'Link Underline', 'catalyst' ); ?> <select class="catalyst-universal-link-underline-child" id="catalyst-footer-link-underline" name="catalyst[footer_link_underline]" size="1" style="width:90px;">
					<option value="Never"<?php if (catalyst_get_dynamik( 'footer_link_underline' ) == 'Never') echo ' selected="selected"'; ?>><?php _e( 'Never', 'catalyst' ); ?></option>
					<option value="On Hover"<?php if (catalyst_get_dynamik( 'footer_link_underline' ) == 'On Hover') echo ' selected="selected"'; ?>><?php _e( 'On Hover', 'catalyst' ); ?></option>
					<option value="Off Hover"<?php if (catalyst_get_dynamik( 'footer_link_underline' ) == 'Off Hover') echo ' selected="selected"'; ?>><?php _e( 'Off Hover', 'catalyst' ); ?></option>
					<option value="Always"<?php if (catalyst_get_dynamik( 'footer_link_underline' ) == 'Always') echo ' selected="selected"'; ?>><?php _e( 'Always', 'catalyst' ); ?></option>
				</select>
				<input type="checkbox" class="universal-check" id="catalyst-footer-link-universal" name="catalyst[footer_link_u]" value="u" <?php if( checked( 'u', catalyst_get_dynamik( 'footer_link_u' ) ) ); ?> /> <?php _e( '(U)', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="catalyst-bg-option-desc">
			<p><?php _e( 'Footer Background', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select id="catalyst-footer-bg-type" class="catalyst-bg-type" name="catalyst[footer_bg_type]" size="1" style="width:150px;">
				<?php catalyst_list_bg_options( catalyst_get_dynamik( 'footer_bg_type' ) ); ?>
				</select> <span style="display:none;" id="catalyst-footer-bg-type-checkbox"><?php _e( '(No Color', 'catalyst' ); ?> <input type="checkbox" id="catalyst-footer-bg-no-color" name="catalyst[footer_bg_no_color]" value="1" <?php if( checked( 1, catalyst_get_dynamik( 'footer_bg_no_color' ) ) ); ?> />)</span><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-footer-bg-color" name="catalyst[footer_bg_color]" value="<?php catalyst_dynamik_options_defaults( true, 'footer_bg_color' ); ?>" />
				<?php _e( 'Image', 'catalyst' ); ?> <select id="catalyst-footer-bg-image" name="catalyst[footer_bg_image]" size="1" style="width:150px;"><?php catalyst_list_images( catalyst_get_dynamik( 'footer_bg_image' ) ); ?></select>
			</p>
		</div>
		
		<div class="catalyst-border-option-desc">
			<p><?php _e( 'Footer Border', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select id="catalyst-footer-border-type" name="catalyst[footer_border_type]" size="1" style="width:98px;">
					<option value="Full"<?php if (catalyst_get_dynamik( 'footer_border_type' ) == 'Full') echo ' selected="selected"'; ?>><?php _e( 'Full', 'catalyst' ); ?></option>
					<option value="Top/Bottom"<?php if (catalyst_get_dynamik( 'footer_border_type' ) == 'Top/Bottom') echo ' selected="selected"'; ?>><?php _e( 'Top/Bottom', 'catalyst' ); ?></option>
					<option value="Top"<?php if (catalyst_get_dynamik( 'footer_border_type' ) == 'Top') echo ' selected="selected"'; ?>><?php _e( 'Top', 'catalyst' ); ?></option>
					<option value="Bottom"<?php if (catalyst_get_dynamik( 'footer_border_type' ) == 'Bottom') echo ' selected="selected"'; ?>><?php _e( 'Bottom', 'catalyst' ); ?></option>
					<option value="Left/Right"<?php if (catalyst_get_dynamik( 'footer_border_type' ) == 'Left/Right') echo ' selected="selected"'; ?>><?php _e( 'Left/Right', 'catalyst' ); ?></option>
				</select>
				<?php _e( 'Thickness', 'catalyst' ); ?> <input type="text" id="catalyst-footer-border-thickness" name="catalyst[footer_border_thickness]" value="<?php catalyst_dynamik_options_defaults( true, 'footer_border_thickness' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Style', 'catalyst' ); ?> <select id="catalyst-footer-border-style" name="catalyst[footer_border_style]" size="1" style="width:90px; margin-right:5px;">
					<?php catalyst_list_borders( catalyst_get_dynamik( 'footer_border_style' ) ); ?>
				</select>
				<input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-footer-border-color" name="catalyst[footer_border_color]" value="<?php catalyst_dynamik_options_defaults( true, 'footer_border_color' ); ?>" />
			</p>
		</div>
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Footer Height / Padding', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Height', 'catalyst' ); ?> <input type="text" id="catalyst-footer-height" name="catalyst[footer_height]" value="<?php catalyst_dynamik_options_defaults( true, 'footer_height' ); ?>" style="width:35px;" /><?php _e( 'px (Blank = auto)', 'catalyst' ); ?>
				<span class="dynamik-design-standard-hide">
				<?php _e( '| Top Padding', 'catalyst' ); ?>
				<input type="text" id="catalyst-footer-padding-top" name="catalyst[footer_padding_top]" value="<?php catalyst_dynamik_options_defaults( true, 'footer_padding_top' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Bottom Padding', 'catalyst' ); ?>
				<input type="text" id="catalyst-footer-padding-bottom" name="catalyst[footer_padding_bottom]" value="<?php catalyst_dynamik_options_defaults( true, 'footer_padding_bottom' ); ?>" style="width:35px;" /><?php _e( 'px', 'catalyst' ); ?>
				</span><!-- End .dynamik-design-standard-hide -->
			</p>
		</div>
		
		<div class="dynamik-design-standard-hide">
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Footer Left Padding', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p>
				<?php _e( 'Padding: Top', 'catalyst' ); ?>
				<input type="text" id="catalyst-footer-left-padding-top" name="catalyst[footer_left_padding_top]" value="<?php catalyst_dynamik_options_defaults( true, 'footer_left_padding_top' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Right', 'catalyst' ); ?>
				<input type="text" id="catalyst-footer-left-padding-right" name="catalyst[footer_left_padding_right]" value="<?php catalyst_dynamik_options_defaults( true, 'footer_left_padding_right' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Bottom', 'catalyst' ); ?>
				<input type="text" id="catalyst-footer-left-padding-bottom" name="catalyst[footer_left_padding_bottom]" value="<?php catalyst_dynamik_options_defaults( true, 'footer_left_padding_bottom' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Left', 'catalyst' ); ?>
				<input type="text" id="catalyst-footer-left-padding-left" name="catalyst[footer_left_padding_left]" value="<?php catalyst_dynamik_options_defaults( true, 'footer_left_padding_left' ); ?>" style="width:35px;" /><?php _e( 'px', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Footer Right Padding', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p>
				<?php _e( 'Padding: Top', 'catalyst' ); ?>
				<input type="text" id="catalyst-footer-right-padding-top" name="catalyst[footer_right_padding_top]" value="<?php catalyst_dynamik_options_defaults( true, 'footer_right_padding_top' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Right', 'catalyst' ); ?>
				<input type="text" id="catalyst-footer-right-padding-right" name="catalyst[footer_right_padding_right]" value="<?php catalyst_dynamik_options_defaults( true, 'footer_right_padding_right' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Bottom', 'catalyst' ); ?>
				<input type="text" id="catalyst-footer-right-padding-bottom" name="catalyst[footer_right_padding_bottom]" value="<?php catalyst_dynamik_options_defaults( true, 'footer_right_padding_bottom' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Left', 'catalyst' ); ?>
				<input type="text" id="catalyst-footer-right-padding-left" name="catalyst[footer_right_padding_left]" value="<?php catalyst_dynamik_options_defaults( true, 'footer_right_padding_left' ); ?>" style="width:35px;" /><?php _e( 'px', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Footer Center Padding', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p>
				<?php _e( 'Padding: Top', 'catalyst' ); ?>
				<input type="text" id="catalyst-footer-center-padding-top" name="catalyst[footer_center_padding_top]" value="<?php catalyst_dynamik_options_defaults( true, 'footer_center_padding_top' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Right', 'catalyst' ); ?>
				<input type="text" id="catalyst-footer-center-padding-right" name="catalyst[footer_center_padding_right]" value="<?php catalyst_dynamik_options_defaults( true, 'footer_center_padding_right' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Bottom', 'catalyst' ); ?>
				<input type="text" id="catalyst-footer-center-padding-bottom" name="catalyst[footer_center_padding_bottom]" value="<?php catalyst_dynamik_options_defaults( true, 'footer_center_padding_bottom' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Left', 'catalyst' ); ?>
				<input type="text" id="catalyst-footer-center-padding-left" name="catalyst[footer_center_padding_left]" value="<?php catalyst_dynamik_options_defaults( true, 'footer_center_padding_left' ); ?>" style="width:35px;" /><?php _e( 'px', 'catalyst' ); ?>
			</p>
		</div>
		
		</div><!-- End .dynamik-design-standard-hide -->
		
	</div>
</div>