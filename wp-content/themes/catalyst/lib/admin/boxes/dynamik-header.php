<?php
/**
 * Builds the Dynamik Header admin content.
 *
 * @package Catalyst
 */
?>

<div id="catalyst-dynamik-options-nav-header-box" class="catalyst-optionbox-outer-1col catalyst-all-options">
	<div class="catalyst-optionbox-inner-1col">
		<h3><?php _e( 'Header | Logo', 'catalyst' ); ?></h3>
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'Header Title Font', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select class="catalyst-universal-font-type-child catalyst-universal-heading-font-type-child" id="catalyst-title-font-type" name="catalyst[font_type][title]" size="1" style="width:98px;">
				<?php catalyst_build_font_menu( $dynamik_font_type['title'] ); ?></select>
				<?php _e( 'Size', 'catalyst' ); ?>
				<input type="text" id="catalyst-title-font-size" name="catalyst[title_font_size]" value="<?php catalyst_dynamik_options_defaults( true, 'title_font_size' ); ?>" style="width:40px;" />
				<select class="catalyst-universal-px-em-child catalyst-universal-heading-px-em-child" id="catalyst-title-px-em" name="catalyst[title_px_em]" size="1" style="width:50px;">
					<option value="px"<?php echo ( catalyst_get_dynamik( 'title_px_em' ) == 'px' ) ? ' selected="selected"' : ''; ?>>px</option>
					<option value="em"<?php echo ( catalyst_get_dynamik( 'title_px_em' ) == 'em' ) ? ' selected="selected"' : ''; ?>>em</option>
				</select>
				<?php _e( 'Color', 'catalyst' ); ?><input type="text" class="catalyst-universal-font-color-child catalyst-universal-heading-font-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-title-font-color" name="catalyst[title_font_color]" value="<?php catalyst_dynamik_options_defaults( true, 'title_font_color' ); ?>" />
				<input type="checkbox" class="universal-check" id="catalyst-title-font-universal" name="catalyst[title_font_u]" value="u" <?php if( checked( 'u', catalyst_get_dynamik( 'title_font_u' ) ) ); ?> /> <?php _e( '(U)', 'catalyst' ); ?>
				<span class="catalyst-custom-fonts-button-wrap"><span id="show-title-font-css" class="catalyst-custom-fonts-button">#Custom</span></span>
				<div style="display:none;" id="show-title-font-css-box" class="catalyst-custom-fonts-box">
				<?php _e( 'Title Font Custom CSS | <code>#title { }</code>', 'catalyst' ); ?><br />
				<textarea class="catalyst-universal-font-css-child catalyst-universal-heading-font-css-child" id="catalyst-title-font-css" name="catalyst[title_font_css]" style="width:100%;" rows="10"><?php echo catalyst_get_dynamik( 'title_font_css' ); ?></textarea>
				</div>
			</p>
		</div>
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'Header Title Link', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Link Hover Color', 'catalyst' ); ?><input type="text" class="catalyst-universal-link-hover-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-title-link-color" name="catalyst[title_link_color]" value="<?php catalyst_dynamik_options_defaults( true, 'title_link_color' ); ?>" />
				<?php _e( 'Link Underline', 'catalyst' ); ?> <select class="catalyst-universal-link-underline-child" id="catalyst-title-link-underline" name="catalyst[title_link_underline]" size="1" style="width:90px;">
					<option value="Never"<?php if (catalyst_get_dynamik( 'title_link_underline' ) == 'Never') echo ' selected="selected"'; ?>><?php _e( 'Never', 'catalyst' ); ?></option>
					<option value="On Hover"<?php if (catalyst_get_dynamik( 'title_link_underline' ) == 'On Hover') echo ' selected="selected"'; ?>><?php _e( 'On Hover', 'catalyst' ); ?></option>
					<option value="Off Hover"<?php if (catalyst_get_dynamik( 'title_link_underline' ) == 'Off Hover') echo ' selected="selected"'; ?>><?php _e( 'Off Hover', 'catalyst' ); ?></option>
					<option value="Always"<?php if (catalyst_get_dynamik( 'title_link_underline' ) == 'Always') echo ' selected="selected"'; ?>><?php _e( 'Always', 'catalyst' ); ?></option>
				</select>
				<input type="checkbox" class="universal-check" id="catalyst-title-link-universal" name="catalyst[title_link_u]" value="u" <?php if( checked( 'u', catalyst_get_dynamik( 'title_link_u' ) ) ); ?> /> <?php _e( '(U)', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'Header Tagline Font', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select class="catalyst-universal-font-type-child catalyst-universal-content-font-type-child" id="catalyst-tagline-font-type" name="catalyst[font_type][tagline]" size="1" style="width:98px;">
				<?php catalyst_build_font_menu( $dynamik_font_type['tagline'] ); ?></select>
				<?php _e( 'Size', 'catalyst' ); ?>
				<input type="text" id="catalyst-tagline-font-size" name="catalyst[tagline_font_size]" value="<?php catalyst_dynamik_options_defaults( true, 'tagline_font_size' ); ?>" style="width:40px;" />
				<select class="catalyst-universal-px-em-child catalyst-universal-content-px-em-child" id="catalyst-tagline-px-em" name="catalyst[tagline_px_em]" size="1" style="width:50px;">
					<option value="px"<?php echo ( catalyst_get_dynamik( 'tagline_px_em' ) == 'px' ) ? ' selected="selected"' : ''; ?>>px</option>
					<option value="em"<?php echo ( catalyst_get_dynamik( 'tagline_px_em' ) == 'em' ) ? ' selected="selected"' : ''; ?>>em</option>
				</select>
				<?php _e( 'Color', 'catalyst' ); ?><input type="text" class="catalyst-universal-font-color-child catalyst-universal-content-font-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-tagline-font-color" name="catalyst[tagline_font_color]" value="<?php catalyst_dynamik_options_defaults( true, 'tagline_font_color' ); ?>" />
				<input type="checkbox" class="universal-check" id="catalyst-tagline-font-universal" name="catalyst[tagline_font_u]" value="u" <?php if( checked( 'u', catalyst_get_dynamik( 'tagline_font_u' ) ) ); ?> /> <?php _e( '(U)', 'catalyst' ); ?>
				<span class="catalyst-custom-fonts-button-wrap"><span id="show-tagline-font-css" class="catalyst-custom-fonts-button">#Custom</span></span>
				<div style="display:none;" id="show-tagline-font-css-box" class="catalyst-custom-fonts-box">
				<?php _e( 'Tagline Font Custom CSS | <code>#tagline { }</code>', 'catalyst' ); ?><br />
				<textarea class="catalyst-universal-font-css-child catalyst-universal-content-font-css-child" id="catalyst-tagline-font-css" name="catalyst[tagline_font_css]" style="width:100%;" rows="10"><?php echo catalyst_get_dynamik( 'tagline_font_css' ); ?></textarea>
				</div>
			</p>
		</div>
		
		<div class="catalyst-bg-option-desc">
			<p><?php _e( 'Header Background', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select id="catalyst-header-bg-type" class="catalyst-bg-type" name="catalyst[header_bg_type]" size="1" style="width:150px;">
				<?php catalyst_list_bg_options( catalyst_get_dynamik( 'header_bg_type' ) ); ?>
				</select> <span style="display:none;" id="catalyst-header-bg-type-checkbox"><?php _e( '(No Color', 'catalyst' ); ?> <input type="checkbox" id="catalyst-header-bg-no-color" name="catalyst[header_bg_no_color]" value="1" <?php if( checked( 1, catalyst_get_dynamik( 'header_bg_no_color' ) ) ); ?> />)</span><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-header-bg-color" name="catalyst[header_bg_color]" value="<?php catalyst_dynamik_options_defaults( true, 'header_bg_color' ); ?>" />
				<?php _e( 'Image', 'catalyst' ); ?> <select id="catalyst-header-bg-image" name="catalyst[header_bg_image]" size="1" style="width:150px;"><?php catalyst_list_images( catalyst_get_dynamik( 'header_bg_image' ) ); ?></select>
			</p>
		</div>
		
		<div class="catalyst-border-option-desc">
			<p><?php _e( 'Header Border', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select id="catalyst-header-border-type" name="catalyst[header_border_type]" size="1" style="width:98px;">
					<option value="Full"<?php if( catalyst_get_dynamik( 'header_border_type' ) == 'Full' ) echo ' selected="selected"'; ?>><?php _e( 'Full', 'catalyst' ); ?></option>
					<option value="Top/Bottom"<?php if( catalyst_get_dynamik( 'header_border_type' ) == 'Top/Bottom' ) echo ' selected="selected"'; ?>><?php _e( 'Top/Bottom', 'catalyst' ); ?></option>
					<option value="Top"<?php if( catalyst_get_dynamik( 'header_border_type' ) == 'Top' ) echo ' selected="selected"'; ?>><?php _e( 'Top', 'catalyst' ); ?></option>
					<option value="Bottom"<?php if( catalyst_get_dynamik( 'header_border_type' ) == 'Bottom' ) echo ' selected="selected"'; ?>><?php _e( 'Bottom', 'catalyst' ); ?></option>
					<option value="Left/Right"<?php if( catalyst_get_dynamik( 'header_border_type' ) == 'Left/Right' ) echo ' selected="selected"'; ?>><?php _e( 'Left/Right', 'catalyst' ); ?></option>
				</select>
				<?php _e( 'Thickness', 'catalyst' ); ?> <input type="text" id="catalyst-header-border-thickness" name="catalyst[header_border_thickness]" value="<?php catalyst_dynamik_options_defaults( true, 'header_border_thickness' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Style', 'catalyst' ); ?> <select id="catalyst-header-border-style" name="catalyst[header_border_style]" size="1" style="width:90px; margin-right:5px;">
					<?php catalyst_list_borders( catalyst_get_dynamik( 'header_border_style' ) ); ?>
				</select>
				<input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-header-border-color" name="catalyst[header_border_color]" value="<?php catalyst_dynamik_options_defaults( true, 'header_border_color' ); ?>" />
			</p>
		</div>
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Select Logo Type', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design" style="padding-top:8px;">
				<?php _e( 'Select a Logo Type', 'catalyst' ); ?>
				<b><a href="<?php echo admin_url( 'admin.php?page=catalyst&activetab=catalyst-core-options-nav-header' ); ?>"><?php _e( 'HERE', 'catalyst' ); ?></a></b>
			</p>
		</div>
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Select Logo Image', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Logo Image', 'catalyst' ); ?> <select id="catalyst-logo-image" name="catalyst[logo_image]" size="1" style="width:175px;"><?php catalyst_list_images( catalyst_get_dynamik( 'logo_image' ) ); ?></select>
			</p>
		</div>
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Header Dimensions', 'catalyst' ); ?> <span id="header-dimensions-tooltip" class="tooltip-mark tooltip-top-right">[?]</span></p>
			
			<div class="tooltip tooltip-400">
				<h5><?php _e( 'Header Left vs Header Right:', 'catalyst' ); ?></h5>
				<p>
					<?php _e( 'The "Header Left" area of your Header is where your Text Title, Tagline and Logo Image are displayed. So by adjusting the "Header Left Width" you are, in effect, adjusting your Text Title or Logo Image width.', 'catalyst' ); ?>
				</p>
				
				<p>
					<?php _e( 'The "Header Right" area of your Header is where the <code>catalyst_hook_header_right</code> hook is located. So by adjusting the "Header Right Width" you are, in effect, adjusting the width of any content hooked into that hook area. So, for example, if you have Navbar 1 set to display in the "Beside Header" location you could control its width by adjusting this width option.', 'catalyst' ); ?>
				</p>
				
				<h5><?php _e( 'Setting Header Left To Full Width', 'catalyst' ); ?></h5>
				<p>
					<?php _e( 'To set your Header Left area to span the full width of your Header go to', 'catalyst' ); ?>
					<b><a href="<?php echo admin_url( 'admin.php?page=catalyst&activetab=catalyst-core-options-nav-header' ); ?>">Core Options > Header</a></b>
					<?php _e( 'and uncheck the box next to "Activate Header Right Area/Hook". This will remove the entire Header Right area and automatically set the Header Left area to the full width of your Header.', 'catalyst' ); ?>
				</p>
			</div>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Header Left Width', 'catalyst' ); ?> <input type="text" id="catalyst-header-left-width" name="catalyst[header_left_width]" value="<?php catalyst_dynamik_options_defaults( true, 'header_left_width' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Header Right Width', 'catalyst' ); ?> <input type="text" id="catalyst-header-right-width" name="catalyst[header_right_width]" value="<?php catalyst_dynamik_options_defaults( true, 'header_right_width' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Header Height', 'catalyst' ); ?> <input type="text" id="catalyst-header-height" name="catalyst[header_height]" value="<?php catalyst_dynamik_options_defaults( true, 'header_height' ); ?>" style="width:35px;" /><?php _e( 'px', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Header-Left Text Title Padding', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Top Padding', 'catalyst' ); ?> <input type="text" id="catalyst-text-logo-top-padding" name="catalyst[text_logo_top_padding]" value="<?php catalyst_dynamik_options_defaults( true, 'text_logo_top_padding' ); ?>" style="width:35px;" /><?php _e( 'px', 'catalyst' ); ?>
				<?php _e( '| Left Padding', 'catalyst' ); ?> <input type="text" id="catalyst-text-logo-left-padding" name="catalyst[text_logo_left_padding]" value="<?php catalyst_dynamik_options_defaults( true, 'text_logo_left_padding' ); ?>" style="width:35px;" /><?php _e( 'px', 'catalyst' ); ?>
				<?php _e( '| Tagline Top Padding', 'catalyst' ); ?> <input type="text" id="catalyst-tagline-top-padding" name="catalyst[tagline_top_padding]" value="<?php catalyst_dynamik_options_defaults( true, 'tagline_top_padding' ); ?>" style="width:35px;" /><?php _e( 'px', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Header-Left Image Logo Margins', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Top Margin', 'catalyst' ); ?> <input type="text" id="catalyst-image-logo-top-margin" name="catalyst[image_logo_top_margin]" value="<?php catalyst_dynamik_options_defaults( true, 'image_logo_top_margin' ); ?>" style="width:35px;" /><?php _e( 'px', 'catalyst' ); ?>
				<?php _e( '| Left Margin', 'catalyst' ); ?> <input type="text" id="catalyst-image-logo-left-margin" name="catalyst[image_logo_left_margin]" value="<?php catalyst_dynamik_options_defaults( true, 'image_logo_left_margin' ); ?>" style="width:35px;" /><?php _e( 'px', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Header-Right Padding', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Top Padding', 'catalyst' ); ?> <input type="text" id="catalyst-header-right-top-padding" name="catalyst[header_right_top_padding]" value="<?php catalyst_dynamik_options_defaults( true, 'header_right_top_padding' ); ?>" style="width:35px;" /><?php _e( 'px', 'catalyst' ); ?>
				<?php _e( '| Right Padding', 'catalyst' ); ?> <input type="text" id="catalyst-header-right-right-padding" name="catalyst[header_right_right_padding]" value="<?php catalyst_dynamik_options_defaults( true, 'header_right_right_padding' ); ?>" style="width:35px;" /><?php _e( 'px', 'catalyst' ); ?>
			</p>
		</div>
	</div>
</div>