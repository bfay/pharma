<?php
/**
 * Builds the Dynamik Body admin content.
 *
 * @package Catalyst
 */
?>

<div id="catalyst-dynamik-options-nav-body-box" class="catalyst-optionbox-outer-1col catalyst-all-options<?php echo $body_display; ?>">
	<div class="catalyst-optionbox-inner-1col">
		<h3><?php _e( 'Body', 'catalyst' ); ?></h3>
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'Universal Font Control', 'catalyst' ); ?> <span id="universal-font-control-tooltip" class="tooltip-mark tooltip-bottom-right">[?]</span></p>
		
			<div class="tooltip tooltip-500">
				<h5><?php _e( 'Control all your Font Settings with Universal Font Control.', 'catalyst' ); ?></h5>
				
				<p>
					<?php _e( 'Any change you make to one of these options will be applied to all Font options of the same kind. For instance, changing the Universal Font Type Georgia does the same thing as if you were to change each of Dynamik\'s Font Type dropdowns to Georgia one-by-one.', 'dynamik' ); ?>
				</p>
				
				<p>
					<?php _e( 'All of the Design Option Sets that contain font options have a checkbox followed by "(U)". The "(U)" is shorthand for "Under Universal Control". If you do not want changes to the Universal Control options to be reflected in a particular Design Option Set, uncheck the box next to the "(U)" in that option set.', 'dynamik' ); ?>
				</p>
				
				<h5><?php _e( 'Note About Switching Font Units From PX To EM', 'catalyst' ); ?></h5>
				
				<p>
					<?php _e( 'When you switch from PX to EM your Font Size value will automatically adjust to a PX equivalent EM value. The way it does this is by dividing your current Body Font Size value by the PX value of the Font Size you are currently working with.', 'dynamik' ); ?>
				</p>
				
				<p>
					<?php _e( '<strong>Note</strong> that every EM value is relative to its parent value. So in most cases, where the Body Font Size <em>is</em> the parent value, this conversion process is accurate, but in some cases where it\'s not the parent (eg. the Sidebar Content Font Size is the parent of the Sidebar Heading Font Size) the process is only a good starting point and may require some manual tweaking on your part.', 'dynamik' ); ?>
				</p>
			</div>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select id="catalyst-universal-font-type" class="universal-font-master" name="catalyst[font_type][universal]" size="1" style="width:98px;">
				<?php catalyst_build_font_menu( $dynamik_font_type['universal'] ); ?></select> <a href="http://code.google.com/webfonts" target="_blank" title="Click to view the Google Font Directory">[G]</a>
				<?php _e( 'Unit', 'catalyst' ); ?> <select id="catalyst-universal-px-em" class="universal-font-master" name="catalyst[universal_px_em]" size="1" style="width:50px;">
					<option value="px"<?php echo ( catalyst_get_dynamik( 'universal_px_em' ) == 'px' ) ? ' selected="selected"' : ''; ?>>px</option>
					<option value="em"<?php echo ( catalyst_get_dynamik( 'universal_px_em' ) == 'em' ) ? ' selected="selected"' : ''; ?>>em</option>
				</select>
				<?php _e( 'Color', 'catalyst' ); ?><input type="text" class="universal-font-master color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-universal-font-color" name="catalyst[universal_font_color]" value="<?php catalyst_dynamik_options_defaults( true, 'universal_font_color' ); ?>" />
				<span class="catalyst-custom-fonts-button-wrap"><span id="show-universal-font-css" class="catalyst-custom-fonts-button">#Custom</span></span>
				<div style="display:none;" id="show-universal-font-css-box" class="catalyst-custom-fonts-box">
				<?php _e( 'Universal Font Custom CSS', 'catalyst' ); ?><br />
				<textarea id="catalyst-universal-font-css" class="universal-font-master catalyst-universal-font-css-child" name="catalyst[universal_font_css]" style="width:100%;" rows="10"><?php echo catalyst_get_dynamik( 'universal_font_css' ); ?></textarea>
				</div>
			</p>
		</div>
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'Universal Heading Font Control', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select id="catalyst-universal-heading-font-type" class="universal-font-master" name="catalyst[font_type][universal_heading]" size="1" style="width:98px;">
				<?php catalyst_build_font_menu( $dynamik_font_type['universal'] ); ?></select>
				<?php _e( 'Unit', 'catalyst' ); ?> <select id="catalyst-universal-heading-px-em" class="universal-font-master" name="catalyst[universal_heading_px_em]" size="1" style="width:50px;">
					<option value="px"<?php echo ( catalyst_get_dynamik( 'universal_heading_px_em' ) == 'px' ) ? ' selected="selected"' : ''; ?>>px</option>
					<option value="em"<?php echo ( catalyst_get_dynamik( 'universal_heading_px_em' ) == 'em' ) ? ' selected="selected"' : ''; ?>>em</option>
				</select>
				<?php _e( 'Color', 'catalyst' ); ?><input type="text" class="universal-font-master color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-universal-heading-font-color" name="catalyst[universal_heading_font_color]" value="<?php catalyst_dynamik_options_defaults( true, 'universal_heading_font_color' ); ?>" />
				<span class="catalyst-custom-fonts-button-wrap"><span id="show-universal-heading-font-css" class="catalyst-custom-fonts-button">#Custom</span></span>
				<div style="display:none;" id="show-universal-heading-font-css-box" class="catalyst-custom-fonts-box">
				<?php _e( 'Universal Heading Font Custom CSS', 'catalyst' ); ?><br />
				<textarea id="catalyst-universal-heading-font-css" class="universal-font-master catalyst-universal-font-css-child" name="catalyst[universal_heading_font_css]" style="width:100%;" rows="10"><?php echo catalyst_get_dynamik( 'universal_heading_font_css' ); ?></textarea>
				</div>
			</p>
		</div>
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'Universal Content Font Control', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select id="catalyst-universal-content-font-type" class="universal-font-master" name="catalyst[font_type][universal_content]" size="1" style="width:98px;">
				<?php catalyst_build_font_menu( $dynamik_font_type['universal'] ); ?></select>
				<?php _e( 'Unit', 'catalyst' ); ?> <select id="catalyst-universal-content-px-em" class="universal-font-master" name="catalyst[universal_content_px_em]" size="1" style="width:50px;">
					<option value="px"<?php echo ( catalyst_get_dynamik( 'universal_content_px_em' ) == 'px' ) ? ' selected="selected"' : ''; ?>>px</option>
					<option value="em"<?php echo ( catalyst_get_dynamik( 'universal_content_px_em' ) == 'em' ) ? ' selected="selected"' : ''; ?>>em</option>
				</select>
				<?php _e( 'Color', 'catalyst' ); ?><input type="text" class="universal-font-master color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-universal-content-font-color" name="catalyst[universal_content_font_color]" value="<?php catalyst_dynamik_options_defaults( true, 'universal_content_font_color' ); ?>" />
				<span class="catalyst-custom-fonts-button-wrap"><span id="show-universal-content-font-css" class="catalyst-custom-fonts-button">#Custom</span></span>
				<div style="display:none;" id="show-universal-content-font-css-box" class="catalyst-custom-fonts-box">
				<?php _e( 'Universal Content Font Custom CSS', 'catalyst' ); ?><br />
				<textarea id="catalyst-universal-content-font-css" class="universal-font-master catalyst-universal-font-css-child" name="catalyst[universal_content_font_css]" style="width:100%;" rows="10"><?php echo catalyst_get_dynamik( 'universal_content_font_css' ); ?></textarea>
				</div>
			</p>
		</div>
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'Universal Link Control', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Link', 'catalyst' ); ?><input type="text" class="universal-font-master color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-universal-link-color" name="catalyst[universal_link_color]" value="<?php catalyst_dynamik_options_defaults( true, 'universal_link_color' ); ?>" />
				<?php _e( 'Link Hover', 'catalyst' ); ?><input type="text" class="universal-font-master color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-universal-link-hover-color" name="catalyst[universal_link_hover_color]" value="<?php catalyst_dynamik_options_defaults( true, 'universal_link_hover_color' ); ?>" />
				<?php _e( 'Link Underline', 'catalyst' ); ?> <select id="catalyst-universal-link-underline" class="universal-font-master" name="catalyst[universal_link_underline]" size="1" style="width:90px;">
					<option value="Never"<?php if( catalyst_get_dynamik( 'universal_link_underline' ) == 'Never' ) echo ' selected="selected"'; ?>><?php _e( 'Never', 'catalyst' ); ?></option>
					<option value="On Hover"<?php if( catalyst_get_dynamik( 'universal_link_underline' ) == 'On Hover' ) echo ' selected="selected"'; ?>><?php _e( 'On Hover', 'catalyst' ); ?></option>
					<option value="Off Hover"<?php if( catalyst_get_dynamik( 'universal_link_underline' ) == 'Off Hover' ) echo ' selected="selected"'; ?>><?php _e( 'Off Hover', 'catalyst' ); ?></option>
					<option value="Always"<?php if( catalyst_get_dynamik( 'universal_link_underline' ) == 'Always' ) echo ' selected="selected"'; ?>><?php _e( 'Always', 'catalyst' ); ?></option>
				</select>
			</p>
		</div>
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'Body Font', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Size', 'catalyst' ); ?>
				<input type="text" id="catalyst-body-font-size" name="catalyst[body_font_size]" value="<?php catalyst_dynamik_options_defaults( true, 'body_font_size' ); ?>" style="width:40px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Line Height', 'catalyst' ); ?> <input type="text" id="catalyst-universal-line-height" name="catalyst[universal_line_height]" value="<?php catalyst_dynamik_options_defaults( true, 'universal_line_height' ); ?>" style="width:50px;" />
				<span class="catalyst-custom-fonts-button-wrap"><span id="show-body-font-css" class="catalyst-custom-fonts-button">#Custom</span></span>
				<div style="display:none;" id="show-body-font-css-box" class="catalyst-custom-fonts-box">
				<?php _e( 'Body Font Custom CSS | <code>body { }</code>', 'catalyst' ); ?><br />
				<textarea id="catalyst-body-font-css" class="catalyst-universal-font-css-child" name="catalyst[body_font_css]" style="width:100%;" rows="10"><?php echo catalyst_get_dynamik( 'body_font_css' ); ?></textarea>
				</div>
			</p>
		</div>
		
		<div class="catalyst-bg-option-desc">
			<p><?php _e( 'Body Background', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select id="catalyst-body-bg-type" name="catalyst[body_bg_type]" class="iewide bg-option" style="width:175px;">
					<option value="color"<?php if( catalyst_get_dynamik( 'body_bg_type' ) == 'color' ) echo ' selected="selected"'; ?>><?php _e( 'Color', 'catalyst' ); ?></option>
					<option value="top left no-repeat"<?php if( catalyst_get_dynamik( 'body_bg_type' ) == 'top left no-repeat' ) echo ' selected="selected"'; ?>><?php _e( 'No-Repeat Image (Left)', 'catalyst' ); ?></option>
					<option value="top center no-repeat"<?php if( catalyst_get_dynamik( 'body_bg_type' ) == 'top center no-repeat' ) echo ' selected="selected"'; ?>><?php _e( 'No-Repeat Image (Center)', 'catalyst' ); ?></option>
					<option value="top right no-repeat"<?php if( catalyst_get_dynamik( 'body_bg_type' ) == 'top right no-repeat' ) echo ' selected="selected"'; ?>><?php _e( 'No-Repeat Image (Right)', 'catalyst' ); ?></option>
					<option value="top left fixed no-repeat"<?php if( catalyst_get_dynamik( 'body_bg_type' ) == 'top left fixed no-repeat' ) echo ' selected="selected"'; ?>><?php _e( 'No-Repeat Image (Left Fixed)', 'catalyst' ); ?></option>
					<option value="top center fixed no-repeat"<?php if( catalyst_get_dynamik( 'body_bg_type' ) == 'top center fixed no-repeat' ) echo ' selected="selected"'; ?>><?php _e( 'No-Repeat Image (Center Fixed)', 'catalyst' ); ?></option>
					<option value="top right fixed no-repeat"<?php if( catalyst_get_dynamik( 'body_bg_type' ) == 'top right fixed no-repeat' ) echo ' selected="selected"'; ?>><?php _e( 'No-Repeat Image (Right Fixed)', 'catalyst' ); ?></option>
					<option value="top left repeat-x"<?php if( catalyst_get_dynamik( 'body_bg_type' ) == 'top left repeat-x' ) echo ' selected="selected"'; ?>><?php _e( 'Horizontal-Repeat Image (Left)', 'catalyst' ); ?></option>
					<option value="top center repeat-x"<?php if( catalyst_get_dynamik( 'body_bg_type' ) == 'top center repeat-x' ) echo ' selected="selected"'; ?>><?php _e( 'Horizontal-Repeat Image (Center)', 'catalyst' ); ?></option>
					<option value="top right repeat-x"<?php if( catalyst_get_dynamik( 'body_bg_type' ) == 'top right repeat-x' ) echo ' selected="selected"'; ?>><?php _e( 'Horizontal-Repeat Image (Right)', 'catalyst' ); ?></option>
					<option value="top left fixed repeat-x"<?php if( catalyst_get_dynamik( 'body_bg_type' ) == 'top left fixed repeat-x' ) echo ' selected="selected"'; ?>><?php _e( 'Horizontal-Repeat Image (Left Fixed)', 'catalyst' ); ?></option>
					<option value="top center fixed repeat-x"<?php if( catalyst_get_dynamik( 'body_bg_type' ) == 'top center fixed repeat-x' ) echo ' selected="selected"'; ?>><?php _e( 'Horizontal-Repeat Image (Center Fixed)', 'catalyst' ); ?></option>
					<option value="top right fixed repeat-x"<?php if( catalyst_get_dynamik( 'body_bg_type' ) == 'top right fixed repeat-x' ) echo ' selected="selected"'; ?>><?php _e( 'Horizontal-Repeat Image (Right Fixed)', 'catalyst' ); ?></option>
					<option value="top left repeat-y"<?php if( catalyst_get_dynamik( 'body_bg_type' ) == 'top left repeat-y' ) echo ' selected="selected"'; ?>><?php _e( 'Vertical-Repeat Image (Left)', 'catalyst' ); ?></option>
					<option value="top center repeat-y"<?php if( catalyst_get_dynamik( 'body_bg_type' ) == 'top center repeat-y' ) echo ' selected="selected"'; ?>><?php _e( 'Vertical-Repeat Image (Center)', 'catalyst' ); ?></option>
					<option value="top right repeat-y"<?php if( catalyst_get_dynamik( 'body_bg_type' ) == 'top right repeat-y' ) echo ' selected="selected"'; ?>><?php _e( 'Vertical-Repeat Image (Right)', 'catalyst' ); ?></option>
					<option value="top left fixed repeat-y"<?php if( catalyst_get_dynamik( 'body_bg_type' ) == 'top left fixed repeat-y' ) echo ' selected="selected"'; ?>><?php _e( 'Vertical-Repeat Image (Left Fixed)', 'catalyst' ); ?></option>
					<option value="top center fixed repeat-y"<?php if( catalyst_get_dynamik( 'body_bg_type' ) == 'top center fixed repeat-y' ) echo ' selected="selected"'; ?>><?php _e( 'Vertical-Repeat Image (Center Fixed)', 'catalyst' ); ?></option>
					<option value="top right fixed repeat-y"<?php if( catalyst_get_dynamik( 'body_bg_type' ) == 'top right fixed repeat-y' ) echo ' selected="selected"'; ?>><?php _e( 'Vertical-Repeat Image (Right Fixed)', 'catalyst' ); ?></option>
					<option value="top repeat"<?php if( catalyst_get_dynamik( 'body_bg_type' ) == 'top repeat' ) echo ' selected="selected"'; ?>><?php _e( 'Horizontal & Vertical-Repeat Image', 'catalyst' ); ?></option>
					<option value="top fixed repeat"<?php if( catalyst_get_dynamik( 'body_bg_type' ) == 'top fixed repeat' ) echo ' selected="selected"'; ?>><?php _e( 'Horizontal & Vertical-Repeat Image (Fixed)', 'catalyst' ); ?></option>
				</select><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-body-bg-color" name="catalyst[body_bg_color]" value="<?php catalyst_dynamik_options_defaults( true, 'body_bg_color' ); ?>" />
				<?php _e( 'Image', 'catalyst' ); ?> <select id="catalyst-body-bg-image" name="catalyst[body_bg_image]" size="1" style="width:175px;"><?php catalyst_list_images( catalyst_get_dynamik( 'body_bg_image' ) ); ?></select>
			</p>
		</div>
	</div>
</div>