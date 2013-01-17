<?php
/**
 * Builds the Dynamik Post Nav admin content.
 *
 * @package Catalyst
 */
?>

<div id="catalyst-dynamik-options-nav-post-nav-box" class="catalyst-optionbox-outer-1col catalyst-all-options">
	<div class="catalyst-optionbox-inner-1col">
		<h3><?php _e( 'Post Navigation', 'catalyst' ); ?></h3>
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'Post Nav Font', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select class="catalyst-universal-font-type-child catalyst-universal-content-font-type-child" id="catalyst-post-nav-font-type" name="catalyst[font_type][post_nav]" size="1" style="width:98px;">
				<?php catalyst_build_font_menu( $dynamik_font_type['post_nav'] ); ?></select>
				<input type="text" id="catalyst-post-nav-font-size" name="catalyst[post_nav_font_size]" value="<?php catalyst_dynamik_options_defaults( true, 'post_nav_font_size' ); ?>" style="width:40px;" />
				<select class="catalyst-universal-px-em-child catalyst-universal-content-px-em-child" id="catalyst-post-nav-px-em" name="catalyst[post_nav_px_em]" size="1" style="width:50px;">
					<option value="px"<?php echo ( catalyst_get_dynamik( 'post_nav_px_em' ) == 'px' ) ? ' selected="selected"' : ''; ?>>px</option>
					<option value="em"<?php echo ( catalyst_get_dynamik( 'post_nav_px_em' ) == 'em' ) ? ' selected="selected"' : ''; ?>>em</option>
				</select>
				<input type="checkbox" class="universal-check" id="catalyst-post-nav-font-universal" name="catalyst[post_nav_font_u]" value="u" <?php if( checked( 'u', catalyst_get_dynamik( 'post_nav_font_u' ) ) ); ?> /> <?php _e( '(U)', 'catalyst' ); ?>
				<span class="catalyst-custom-fonts-button-wrap"><span id="show-post-nav-font-css" class="catalyst-custom-fonts-button">#Custom</span></span>
				<div style="display:none;" id="show-post-nav-font-css-box" class="catalyst-custom-fonts-box">
				<?php _e( 'Post Nav Font Custom CSS | <code>.post-nav li a, .post-nav li.disabled, .post-nav li a:hover, .post-nav li.active a { }</code>', 'catalyst' ); ?><br />
				<textarea class="catalyst-universal-font-css-child catalyst-universal-content-font-css-child" id="catalyst-post-nav-font-css" name="catalyst[post_nav_font_css]" style="width:100%;" rows="10"><?php echo catalyst_get_dynamik( 'post_nav_font_css' ); ?></textarea>
				</div>
			</p>
		</div>
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'Post Nav Link', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Link', 'catalyst' ); ?><input type="text" class="catalyst-universal-link-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-post-nav-link-color" name="catalyst[post_nav_link_color]" value="<?php catalyst_dynamik_options_defaults( true, 'post_nav_link_color' ); ?>" />
				<?php _e( 'Link Hover', 'catalyst' ); ?><input type="text" class="catalyst-universal-link-hover-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-post-nav-link-hover-color" name="catalyst[post_nav_link_hover_color]" value="<?php catalyst_dynamik_options_defaults( true, 'post_nav_link_hover_color' ); ?>" />
				<?php _e( 'Link Underline', 'catalyst' ); ?> <select class="catalyst-universal-link-underline-child" id="catalyst-post-nav-link-underline" name="catalyst[post_nav_link_underline]" size="1" style="width:90px;">
					<option value="Never"<?php if (catalyst_get_dynamik( 'post_nav_link_underline' ) == 'Never') echo ' selected="selected"'; ?>><?php _e( 'Never', 'catalyst' ); ?></option>
					<option value="On Hover"<?php if (catalyst_get_dynamik( 'post_nav_link_underline' ) == 'On Hover') echo ' selected="selected"'; ?>><?php _e( 'On Hover', 'catalyst' ); ?></option>
					<option value="Off Hover"<?php if (catalyst_get_dynamik( 'post_nav_link_underline' ) == 'Off Hover') echo ' selected="selected"'; ?>><?php _e( 'Off Hover', 'catalyst' ); ?></option>
					<option value="Always"<?php if (catalyst_get_dynamik( 'post_nav_link_underline' ) == 'Always') echo ' selected="selected"'; ?>><?php _e( 'Always', 'catalyst' ); ?></option>
				</select>
				<input type="checkbox" class="universal-check" id="post-nav-link-universal" name="catalyst[post_nav_link_u]" value="u" <?php if( checked( 'u', catalyst_get_dynamik( 'post_nav_link_u' ) ) ); ?> /> <?php _e( '(U)', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="catalyst-bg-option-desc">
			<p><?php _e( 'Post Nav Inactive Numbered BG', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select id="catalyst-post-nav-numbered-inactive-bg-type" class="catalyst-bg-type" name="catalyst[post_nav_numbered_inactive_bg_type]" size="1" style="width:150px;">
				<?php catalyst_list_bg_options( catalyst_get_dynamik( 'post_nav_numbered_inactive_bg_type' ) ); ?>
				</select> <span style="display:none;" id="catalyst-post-nav-numbered-inactive-bg-type-checkbox"><?php _e( '(No Color', 'catalyst' ); ?> <input type="checkbox" id="catalyst-post-nav-numbered-inactive-bg-no-color" name="catalyst[post_nav_numbered_inactive_bg_no_color]" value="1" <?php if( checked( 1, catalyst_get_dynamik( 'post_nav_numbered_inactive_bg_no_color' ) ) ); ?> />)</span><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-post-nav-numbered-inactive-bg-color" name="catalyst[post_nav_numbered_inactive_bg_color]" value="<?php catalyst_dynamik_options_defaults( true, 'post_nav_numbered_inactive_bg_color' ); ?>" />
				<?php _e( 'Image', 'catalyst' ); ?> <select id="catalyst-post-nav-numbered-inactive-bg-image" name="catalyst[post_nav_numbered_inactive_bg_image]" size="1" style="width:150px;"><?php catalyst_list_images( catalyst_get_dynamik( 'post_nav_numbered_inactive_bg_image' ) ); ?></select>
			</p>
		</div>
		
		<div class="catalyst-bg-option-desc">
			<p><?php _e( 'Post Nav Active Numbered BG', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select id="catalyst-post-nav-numbered-active-bg-type" class="catalyst-bg-type" name="catalyst[post_nav_numbered_active_bg_type]" size="1" style="width:150px;">
				<?php catalyst_list_bg_options( catalyst_get_dynamik( 'post_nav_numbered_active_bg_type' ) ); ?>
				</select> <span style="display:none;" id="catalyst-post-nav-numbered-active-bg-type-checkbox"><?php _e( '(No Color', 'catalyst' ); ?> <input type="checkbox" id="catalyst-post-nav-numbered-active-bg-no-color" name="catalyst[post_nav_numbered_active_bg_no_color]" value="1" <?php if( checked( 1, catalyst_get_dynamik( 'post_nav_numbered_active_bg_no_color' ) ) ); ?> />)</span><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-post-nav-numbered-active-bg-color" name="catalyst[post_nav_numbered_active_bg_color]" value="<?php catalyst_dynamik_options_defaults( true, 'post_nav_numbered_active_bg_color' ); ?>" />
				<?php _e( 'Image', 'catalyst' ); ?> <select id="catalyst-post-nav-numbered-active-bg-image" name="catalyst[post_nav_numbered_active_bg_image]" size="1" style="width:150px;"><?php catalyst_list_images( catalyst_get_dynamik( 'post_nav_numbered_active_bg_image' ) ); ?></select>
			</p>
		</div>
		
		<div class="catalyst-border-option-desc">
			<p><?php _e( 'Post Nav Numbered Border', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Thickness', 'catalyst' ); ?> <input type="text" id="catalyst-post-nav-border-thickness" name="catalyst[post_nav_border_thickness]" value="<?php catalyst_dynamik_options_defaults( true, 'post_nav_border_thickness' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Style', 'catalyst' ); ?> <select id="catalyst-post-nav-border-style" name="catalyst[post_nav_border_style]" size="1" style="width:80px; margin-right:5px;">
					<?php catalyst_list_borders( catalyst_get_dynamik( 'post_nav_border_style' ) ); ?>
				</select>
				<input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-post-nav-border-color" name="catalyst[post_nav_border_color]" value="<?php catalyst_dynamik_options_defaults( true, 'post_nav_border_color' ); ?>" />
			</p>
		</div>
		
		<div class="dynamik-design-standard-hide">
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Post Nav Padding', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p>
				<?php _e( 'Padding: Top', 'catalyst' ); ?>
				<input type="text" id="catalyst-post-nav-padding-top" name="catalyst[post_nav_padding_top]" value="<?php echo catalyst_get_dynamik( 'post_nav_padding_top' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Bottom', 'catalyst' ); ?>
				<input type="text" id="catalyst-post-nav-padding-bottom" name="catalyst[post_nav_padding_bottom]" value="<?php echo catalyst_get_dynamik( 'post_nav_padding_bottom' ); ?>" style="width:35px;" /><?php _e( 'px', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Post Nav Numbered Margins/Padding', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p>
				<?php _e( 'Margin: Left', 'catalyst' ); ?>
				<input type="text" id="catalyst-post-nav-numbered-margin-left" name="catalyst[post_nav_numbered_margin_left]" value="<?php catalyst_dynamik_options_defaults( true, 'post_nav_numbered_margin_left' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Right', 'catalyst' ); ?>
				<input type="text" id="catalyst-post-nav-numbered-margin-right" name="catalyst[post_nav_numbered_margin_right]" value="<?php catalyst_dynamik_options_defaults( true, 'post_nav_numbered_margin_right' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Padding: Top/Btm', 'catalyst' ); ?>
				<input type="text" id="catalyst-post-nav-numbered-tb-padding" name="catalyst[post_nav_numbered_tb_padding]" value="<?php catalyst_dynamik_options_defaults( true, 'post_nav_numbered_tb_padding' ); ?>" style="width:35px;" /><?php _e( 'px', 'catalyst' ); ?>
				<?php _e( 'Lft/Rt', 'catalyst' ); ?>
				<input type="text" id="catalyst-post-nav-numbered-lr-padding" name="catalyst[post_nav_numbered_lr_padding]" value="<?php catalyst_dynamik_options_defaults( true, 'post_nav_numbered_lr_padding' ); ?>" style="width:35px;" /><?php _e( 'px', 'catalyst' ); ?>
			</p>
		</div>
		
		</div><!-- End .dynamik-design-standard-hide -->
		
	</div>
</div>