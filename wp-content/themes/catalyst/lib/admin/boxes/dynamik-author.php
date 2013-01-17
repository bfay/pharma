<?php
/**
 * Builds the Dynamik Author admin content.
 *
 * @package Catalyst
 */
?>

<div id="catalyst-dynamik-options-nav-author-box" class="catalyst-optionbox-outer-1col catalyst-all-options">
	<div class="catalyst-optionbox-inner-1col">
		<h3><?php _e( 'Author Info', 'catalyst' ); ?></h3>
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'Author Info Title Font', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select class="catalyst-universal-font-type-child catalyst-universal-heading-font-type-child" id="catalyst-author-info-title-font-type" name="catalyst[font_type][author_info_title]" size="1" style="width:98px;">
				<?php catalyst_build_font_menu( $dynamik_font_type['author_info_title'] ); ?></select>
				<input type="text" id="catalyst-author-info-title-font-size" name="catalyst[author_info_title_font_size]" value="<?php catalyst_dynamik_options_defaults( true, 'author_info_title_font_size' ); ?>" style="width:40px;" />
				<select class="catalyst-universal-px-em-child catalyst-universal-heading-px-em-child" id="catalyst-author-info-title-px-em" name="catalyst[author_info_title_px_em]" size="1" style="width:50px;">
					<option value="px"<?php echo ( catalyst_get_dynamik( 'author_info_title_px_em' ) == 'px' ) ? ' selected="selected"' : ''; ?>>px</option>
					<option value="em"<?php echo ( catalyst_get_dynamik( 'author_info_title_px_em' ) == 'em' ) ? ' selected="selected"' : ''; ?>>em</option>
				</select>		
				<?php _e( 'Color', 'catalyst' ); ?><input type="text" class="catalyst-universal-font-color-child catalyst-universal-heading-font-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-author-info-title-font-color" name="catalyst[author_info_title_font_color]" value="<?php catalyst_dynamik_options_defaults( true, 'author_info_title_font_color' ); ?>" />
				<input type="checkbox" class="universal-check" id="catalyst-author-info-title-font-universal" name="catalyst[author_info_title_font_u]" value="u" <?php if( checked( 'u', catalyst_get_dynamik( 'author_info_title_font_u' ) ) ); ?> /> <?php _e( '(U)', 'catalyst' ); ?>
				<span class="catalyst-custom-fonts-button-wrap"><span id="show-author-info-title-font-css" class="catalyst-custom-fonts-button">#Custom</span></span>
				<div style="display:none;" id="show-author-info-title-font-css-box" class="catalyst-custom-fonts-box">
				<?php _e( 'Author Info Title Font Custom CSS | <code>#entry-author-info p { }</code>', 'catalyst' ); ?><br />
				<textarea class="catalyst-universal-font-css-child catalyst-universal-heading-font-css-child" id="catalyst-author-info-title-font-css" name="catalyst[author_info_title_font_css]" style="width:100%;" rows="10"><?php echo catalyst_get_dynamik( 'author_info_title_font_css' ); ?></textarea>
				</div>
			</p>
		</div>
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'Author Info Font', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select class="catalyst-universal-font-type-child catalyst-universal-content-font-type-child" id="catalyst-author-info-font-type" name="catalyst[font_type][author_info]" size="1" style="width:98px;">
				<?php catalyst_build_font_menu( $dynamik_font_type['author_info'] ); ?></select>
				<input type="text" id="catalyst-author-info-font-size" name="catalyst[author_info_font_size]" value="<?php catalyst_dynamik_options_defaults( true, 'author_info_font_size' ); ?>" style="width:40px;" />
				<select class="catalyst-universal-px-em-child catalyst-universal-content-px-em-child" id="catalyst-author-info-px-em" name="catalyst[author_info_px_em]" size="1" style="width:50px;">
					<option value="px"<?php echo ( catalyst_get_dynamik( 'author_info_px_em' ) == 'px' ) ? ' selected="selected"' : ''; ?>>px</option>
					<option value="em"<?php echo ( catalyst_get_dynamik( 'author_info_px_em' ) == 'em' ) ? ' selected="selected"' : ''; ?>>em</option>
				</select>
				<?php _e( 'Color', 'catalyst' ); ?><input type="text" class="catalyst-universal-font-color-child catalyst-universal-content-font-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-author-info-font-color" name="catalyst[author_info_font_color]" value="<?php catalyst_dynamik_options_defaults( true, 'author_info_font_color' ); ?>" />
				<input type="checkbox" class="universal-check" id="catalyst-author-info-font-universal" name="catalyst[author_info_font_u]" value="u" <?php if( checked( 'u', catalyst_get_dynamik( 'author_info_font_u' ) ) ); ?> /> <?php _e( '(U)', 'catalyst' ); ?>
				<span class="catalyst-custom-fonts-button-wrap"><span id="show-author-info-font-css" class="catalyst-custom-fonts-button">#Custom</span></span>
				<div style="display:none;" id="show-author-info-font-css-box" class="catalyst-custom-fonts-box">
				<?php _e( 'Author Info Font Custom CSS | <code>#entry-author-info { }</code>', 'catalyst' ); ?><br />
				<textarea class="catalyst-universal-font-css-child catalyst-universal-content-font-css-child" id="catalyst-author-info-font-css" name="catalyst[author_info_font_css]" style="width:100%;" rows="10"><?php echo catalyst_get_dynamik( 'author_info_font_css' ); ?></textarea>
				</div>
			</p>
		</div>
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'Author Info Link', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Link', 'catalyst' ); ?><input type="text" class="catalyst-universal-link-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-author-info-link-color" name="catalyst[author_info_link_color]" value="<?php catalyst_dynamik_options_defaults( true, 'author_info_link_color' ); ?>" />
				<?php _e( 'Link Hover', 'catalyst' ); ?><input type="text" class="catalyst-universal-link-hover-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-author-info-link-hover-color" name="catalyst[author_info_link_hover_color]" value="<?php catalyst_dynamik_options_defaults( true, 'author_info_link_hover_color' ); ?>" />
				<?php _e( 'Link Underline', 'catalyst' ); ?> <select class="catalyst-universal-link-underline-child" id="catalyst-author-info-link-underline" name="catalyst[author_info_link_underline]" size="1" style="width:90px;">
					<option value="Never"<?php if (catalyst_get_dynamik( 'author_info_link_underline' ) == 'Never') echo ' selected="selected"'; ?>><?php _e( 'Never', 'catalyst' ); ?></option>
					<option value="On Hover"<?php if (catalyst_get_dynamik( 'author_info_link_underline' ) == 'On Hover') echo ' selected="selected"'; ?>><?php _e( 'On Hover', 'catalyst' ); ?></option>
					<option value="Off Hover"<?php if (catalyst_get_dynamik( 'author_info_link_underline' ) == 'Off Hover') echo ' selected="selected"'; ?>><?php _e( 'Off Hover', 'catalyst' ); ?></option>
					<option value="Always"<?php if (catalyst_get_dynamik( 'author_info_link_underline' ) == 'Always') echo ' selected="selected"'; ?>><?php _e( 'Always', 'catalyst' ); ?></option>
				</select>
				<input type="checkbox" class="universal-check" id="catalyst-author-info-link-universal" name="catalyst[author_info_link_u]" value="u" <?php if( checked( 'u', catalyst_get_dynamik( 'author_info_link_u' ) ) ); ?> /> <?php _e( '(U)', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="catalyst-bg-option-desc">
			<p><?php _e( 'Author Info Background', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select id="catalyst-author-info-bg-type" class="catalyst-bg-type" name="catalyst[author_info_bg_type]" size="1" style="width:150px;">
				<?php catalyst_list_bg_options( catalyst_get_dynamik( 'author_info_bg_type' ) ); ?>
				</select> <span style="display:none;" id="catalyst-author-info-bg-type-checkbox"><?php _e( '(No Color', 'catalyst' ); ?> <input type="checkbox" id="catalyst-author-info-bg-no-color" name="catalyst[author_info_bg_no_color]" value="1" <?php if( checked( 1, catalyst_get_dynamik( 'author_info_bg_no_color' ) ) ); ?> />)</span><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-author-info-bg-color" name="catalyst[author_info_bg_color]" value="<?php catalyst_dynamik_options_defaults( true, 'author_info_bg_color' ); ?>" />
				<?php _e( 'Image', 'catalyst' ); ?> <select id="catalyst-author-info-bg-image" name="catalyst[author_info_bg_image]" size="1" style="width:150px;"><?php catalyst_list_images( catalyst_get_dynamik( 'author_info_bg_image' ) ); ?></select>
			</p>
		</div>
		
		<div class="catalyst-bg-option-desc">
			<p><?php _e( 'Author Avatar Background', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select id="catalyst-author-avatar-bg-type" class="catalyst-bg-type" name="catalyst[author_avatar_bg_type]" size="1" style="width:150px;">
				<?php catalyst_list_bg_options( catalyst_get_dynamik( 'author_avatar_bg_type' ) ); ?>
				</select> <span style="display:none;" id="catalyst-author-avatar-bg-type-checkbox"><?php _e( '(No Color', 'catalyst' ); ?> <input type="checkbox" id="catalyst-author-avatar-bg-no-color" name="catalyst[author_avatar_bg_no_color]" value="1" <?php if( checked( 1, catalyst_get_dynamik( 'author_avatar_bg_no_color' ) ) ); ?> />)</span><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-author-avatar-bg-color" name="catalyst[author_avatar_bg_color]" value="<?php catalyst_dynamik_options_defaults( true, 'author_avatar_bg_color' ); ?>" />
				<?php _e( 'Image', 'catalyst' ); ?> <select id="catalyst-author-avatar-bg-image" name="catalyst[author_avatar_bg_image]" size="1" style="width:150px;"><?php catalyst_list_images( catalyst_get_dynamik( 'author_avatar_bg_image' ) ); ?></select>
			</p>
		</div>
		
		<div class="catalyst-border-option-desc">
			<p><?php _e( 'Author Info Border', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select id="catalyst-author-info-border-type" name="catalyst[author_info_border_type]" size="1" style="width:98px;">
					<option value="Full"<?php if (catalyst_get_dynamik( 'author_info_border_type' ) == 'Full') echo ' selected="selected"'; ?>><?php _e( 'Full', 'catalyst' ); ?></option>
					<option value="Top"<?php if (catalyst_get_dynamik( 'author_info_border_type' ) == 'Top') echo ' selected="selected"'; ?>><?php _e( 'Top', 'catalyst' ); ?></option>
					<option value="Top/Bottom"<?php if (catalyst_get_dynamik( 'author_info_border_type' ) == 'Top/Bottom') echo ' selected="selected"'; ?>><?php _e( 'Top/Bottom', 'catalyst' ); ?></option>
					<option value="Left/Right"<?php if (catalyst_get_dynamik( 'author_info_border_type' ) == 'Left/Right') echo ' selected="selected"'; ?>><?php _e( 'Left/Right', 'catalyst' ); ?></option>
					<option value="Left"<?php if (catalyst_get_dynamik( 'author_info_border_type' ) == 'Left') echo ' selected="selected"'; ?>><?php _e( 'Left', 'catalyst' ); ?></option>
				</select>
				<?php _e( 'Thickness', 'catalyst' ); ?> <input type="text" id="catalyst-author-info-border-thickness" name="catalyst[author_info_border_thickness]" value="<?php catalyst_dynamik_options_defaults( true, 'author_info_border_thickness' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Style', 'catalyst' ); ?> <select id="catalyst-author-info-border-style" name="catalyst[author_info_border_style]" size="1" style="width:80px; margin-right:5px;">
					<?php catalyst_list_borders( catalyst_get_dynamik( 'author_info_border_style' ) ); ?>
				</select>
				<input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-author-info-border-color" name="catalyst[author_info_border_color]" value="<?php catalyst_dynamik_options_defaults( true, 'author_info_border_color' ); ?>" />
			</p>
		</div>
		
		<div class="catalyst-border-option-desc">
			<p><?php _e( 'Author Avatar Border', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Thickness', 'catalyst' ); ?>
				<input type="text" id="catalyst-author-avatar-border-thickness" name="catalyst[author_avatar_border_thickness]" value="<?php catalyst_dynamik_options_defaults( true, 'author_avatar_border_thickness' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Style', 'catalyst' ); ?> <select id="catalyst-author-avatar-border-style" name="catalyst[author_avatar_border_style]" size="1" style="width:80px; margin-right:5px;">
					<?php catalyst_list_borders( catalyst_get_dynamik( 'author_avatar_border_style' ) ); ?>
				</select>
				<?php _e( 'Color', 'catalyst' ); ?> <input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-author-avatar-border-color" name="catalyst[author_avatar_border_color]" value="<?php catalyst_dynamik_options_defaults( true, 'author_avatar_border_color' ); ?>" />
			</p>
		</div>
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Author Avatar Size/Padding', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p>
				<?php _e( 'Author Avatar Size', 'catalyst' ); ?>
				<input type="text" id="catalyst-author-avatar-size" name="catalyst[author_avatar_size]" value="<?php catalyst_dynamik_options_defaults( true, 'author_avatar_size' ); ?>" style="width:40px;" /><?php _e( 'px', 'catalyst' ); ?>
				<span class="dynamik-design-standard-hide">
				<?php _e( '| Padding', 'catalyst' ); ?>
				<input type="text" id="catalyst-author-avatar-padding" name="catalyst[author_avatar_padding]" value="<?php catalyst_dynamik_options_defaults( true, 'author_avatar_padding' ); ?>" style="width:25px;" /><?php _e( 'px', 'catalyst' ); ?>
				</span><!-- End .dynamik-design-standard-hide -->
			</p>
		</div>
		
		<div class="dynamik-design-standard-hide">
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Author Info Margins', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p>
				<?php _e( 'Top Margin', 'catalyst' ); ?>
				<input type="text" id="catalyst-author-info-margin-top" name="catalyst[author_info_margin_top]" value="<?php catalyst_dynamik_options_defaults( true, 'author_info_margin_top' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Bottom Margin', 'catalyst' ); ?>
				<input type="text" id="catalyst-author-info-margin-bottom" name="catalyst[author_info_margin_bottom]" value="<?php catalyst_dynamik_options_defaults( true, 'author_info_margin_bottom' ); ?>" style="width:35px;" /><?php _e( 'px', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Author Info Padding', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p>
				<?php _e( 'Padding: Top', 'catalyst' ); ?>
				<input type="text" id="catalyst-author-info-padding-top" name="catalyst[author_info_padding_top]" value="<?php catalyst_dynamik_options_defaults( true, 'author_info_padding_top' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Right', 'catalyst' ); ?>
				<input type="text" id="catalyst-author-info-padding-right" name="catalyst[author_info_padding_right]" value="<?php catalyst_dynamik_options_defaults( true, 'author_info_padding_right' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Bottom', 'catalyst' ); ?>
				<input type="text" id="catalyst-author-info-padding-bottom" name="catalyst[author_info_padding_bottom]" value="<?php catalyst_dynamik_options_defaults( true, 'author_info_padding_bottom' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Left', 'catalyst' ); ?>
				<input type="text" id="catalyst-author-info-padding-left" name="catalyst[author_info_padding_left]" value="<?php catalyst_dynamik_options_defaults( true, 'author_info_padding_left' ); ?>" style="width:35px;" /><?php _e( 'px', 'catalyst' ); ?>
			</p>
		</div>
		
		</div><!-- End .dynamik-design-standard-hide -->
		
	</div>
</div>