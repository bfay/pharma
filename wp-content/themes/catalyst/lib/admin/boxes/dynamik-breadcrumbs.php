<?php
/**
 * Builds the Dynamik Breadcrumbs admin content.
 *
 * @package Catalyst
 */
?>

<div id="catalyst-dynamik-options-nav-breadcrumbs-box" class="catalyst-optionbox-outer-1col catalyst-all-options">
	<div class="catalyst-optionbox-inner-1col">
		<h3><?php _e( 'Breadcrumbs | Taxonomy/Author Title Box', 'catalyst' ); ?> <span id="catalyst-tax-title-box-tooltip" class="tooltip-mark tooltip-bottom-left">[?]</span></h3>
		
		<div class="tooltip tooltip-500">
			<p>
				<?php _e( 'The following options control the design of both Breadcrumbs and Taxonomy/Author Title Boxes. To control the size of the Taxonomy/Author Title Box Heading go to Dynmaik Options > Content Heading Font Sizes H1-H2 and adjust the "H1" option according to your needs. Just note that this will also change other H1 text in your Content area.', 'catalyst' ); ?>
			</p>
			
			<p>
				<?php _e( 'If you would like to style either your Taxonomy or Author Title Boxes in a way that is different than your Breadcrumbs you can always use Custom CSS to do so. The Taxonomy Title Box div has a class of .taxonomy-title-box and the Author Title Box has a class of .author-title-box', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'Breadcrumbs Font', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select class="catalyst-universal-font-type-child catalyst-universal-content-font-type-child" id="catalyst-breadcrumbs-font-type" name="catalyst[font_type][breadcrumbs]" size="1" style="width:98px;">
				<?php catalyst_build_font_menu( $dynamik_font_type['breadcrumbs'] ); ?></select>
				<input type="text" id="catalyst-breadcrumbs-font-size" name="catalyst[breadcrumbs_font_size]" value="<?php catalyst_dynamik_options_defaults( true, 'breadcrumbs_font_size' ); ?>" style="width:40px;" />
				<select class="catalyst-universal-px-em-child catalyst-universal-content-px-em-child" id="catalyst-breadcrumbs-px-em" name="catalyst[breadcrumbs_px_em]" size="1" style="width:50px;">
					<option value="px"<?php echo ( catalyst_get_dynamik( 'breadcrumbs_px_em' ) == 'px' ) ? ' selected="selected"' : ''; ?>>px</option>
					<option value="em"<?php echo ( catalyst_get_dynamik( 'breadcrumbs_px_em' ) == 'em' ) ? ' selected="selected"' : ''; ?>>em</option>
				</select>
				<?php _e( 'Color', 'catalyst' ); ?><input type="text" class="catalyst-universal-font-color-child catalyst-universal-content-font-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-breadcrumbs-font-color" name="catalyst[breadcrumbs_font_color]" value="<?php catalyst_dynamik_options_defaults( true, 'breadcrumbs_font_color' ); ?>" />
				<input type="checkbox" class="universal-check" id="catalyst-breadcrumbs-font-universal" name="catalyst[breadcrumbs_font_u]" value="u" <?php if( checked( 'u', catalyst_get_dynamik( 'breadcrumbs_font_u' ) ) ); ?> /> <?php _e( '(U)', 'catalyst' ); ?>
				<span class="catalyst-custom-fonts-button-wrap"><span id="show-breadcrumbs-font-css" class="catalyst-custom-fonts-button">#Custom</span></span>
				<div style="display:none;" id="show-breadcrumbs-font-css-box" class="catalyst-custom-fonts-box">
				<?php _e( 'Breadcrumbs Font Custom CSS | <code>.breadcrumbs { }</code>', 'catalyst' ); ?><br />
				<textarea class="catalyst-universal-font-css-child catalyst-universal-content-font-css-child" id="catalyst-breadcrumbs-font-css" name="catalyst[breadcrumbs_font_css]" style="width:100%;" rows="10"><?php echo catalyst_get_dynamik( 'breadcrumbs_font_css' ); ?></textarea>
				</div>
			</p>
		</div>
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'Breadcrumbs Link', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Link', 'catalyst' ); ?><input type="text" class="catalyst-universal-link-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-breadcrumbs-link-color" name="catalyst[breadcrumbs_link_color]" value="<?php catalyst_dynamik_options_defaults( true, 'breadcrumbs_link_color' ); ?>" />
				<?php _e( 'Link Hover', 'catalyst' ); ?><input type="text" class="catalyst-universal-link-hover-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-breadcrumbs-link-hover-color" name="catalyst[breadcrumbs_link_hover_color]" value="<?php catalyst_dynamik_options_defaults( true, 'breadcrumbs_link_hover_color' ); ?>" />
				<?php _e( 'Link Underline', 'catalyst' ); ?> <select class="catalyst-universal-link-underline-child" id="catalyst-breadcrumbs-link-underline" name="catalyst[breadcrumbs_link_underline]" size="1" style="width:90px;">
					<option value="Never"<?php if (catalyst_get_dynamik( 'breadcrumbs_link_underline' ) == 'Never') echo ' selected="selected"'; ?>><?php _e( 'Never', 'catalyst' ); ?></option>
					<option value="On Hover"<?php if (catalyst_get_dynamik( 'breadcrumbs_link_underline' ) == 'On Hover') echo ' selected="selected"'; ?>><?php _e( 'On Hover', 'catalyst' ); ?></option>
					<option value="Off Hover"<?php if (catalyst_get_dynamik( 'breadcrumbs_link_underline' ) == 'Off Hover') echo ' selected="selected"'; ?>><?php _e( 'Off Hover', 'catalyst' ); ?></option>
					<option value="Always"<?php if (catalyst_get_dynamik( 'breadcrumbs_link_underline' ) == 'Always') echo ' selected="selected"'; ?>><?php _e( 'Always', 'catalyst' ); ?></option>
				</select>
				<input type="checkbox" class="universal-check" id="breadcrumbs-link-universal" name="catalyst[breadcrumbs_link_u]" value="u" <?php if( checked( 'u', catalyst_get_dynamik( 'breadcrumbs_link_u' ) ) ); ?> /> <?php _e( '(U)', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="catalyst-bg-option-desc">
			<p><?php _e( 'Breadcrumbs Background', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select id="catalyst-breadcrumbs-bg-type" class="catalyst-bg-type" name="catalyst[breadcrumbs_bg_type]" size="1" style="width:150px;">
				<?php catalyst_list_bg_options( catalyst_get_dynamik( 'breadcrumbs_bg_type' ) ); ?>
				</select> <span style="display:none;" id="catalyst-breadcrumbs-bg-type-checkbox"><?php _e( '(No Color', 'catalyst' ); ?> <input type="checkbox" id="catalyst-breadcrumbs-bg-no-color" name="catalyst[breadcrumbs_bg_no_color]" value="1" <?php if( checked( 1, catalyst_get_dynamik( 'breadcrumbs_bg_no_color' ) ) ); ?> />)</span><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-breadcrumbs-bg-color" name="catalyst[breadcrumbs_bg_color]" value="<?php catalyst_dynamik_options_defaults( true, 'breadcrumbs_bg_color' ); ?>" />
				<?php _e( 'Image', 'catalyst' ); ?> <select id="catalyst-breadcrumbs-bg-image" name="catalyst[breadcrumbs_bg_image]" size="1" style="width:150px;"><?php catalyst_list_images( catalyst_get_dynamik( 'breadcrumbs_bg_image' ) ); ?></select>
			</p>
		</div>
		
		<div class="catalyst-border-option-desc">
			<p><?php _e( 'Breadcrumbs Border', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select id="catalyst-breadcrumbs-border-type" name="catalyst[breadcrumbs_border_type]" size="1" style="width:98px;">
					<option value="Full"<?php if (catalyst_get_dynamik( 'breadcrumbs_border_type' ) == 'Full') echo ' selected="selected"'; ?>><?php _e( 'Full', 'catalyst' ); ?></option>
					<option value="Top/Bottom"<?php if (catalyst_get_dynamik( 'breadcrumbs_border_type' ) == 'Top/Bottom') echo ' selected="selected"'; ?>><?php _e( 'Top/Bottom', 'catalyst' ); ?></option>
					<option value="Bottom"<?php if (catalyst_get_dynamik( 'breadcrumbs_border_type' ) == 'Bottom') echo ' selected="selected"'; ?>><?php _e( 'Bottom', 'catalyst' ); ?></option>
					<option value="Left/Right"<?php if (catalyst_get_dynamik( 'breadcrumbs_border_type' ) == 'Left/Right') echo ' selected="selected"'; ?>><?php _e( 'Left/Right', 'catalyst' ); ?></option>
					<option value="Left"<?php if (catalyst_get_dynamik( 'breadcrumbs_border_type' ) == 'Left') echo ' selected="selected"'; ?>><?php _e( 'Left', 'catalyst' ); ?></option>
				</select>
				<?php _e( 'Thickness', 'catalyst' ); ?> <input type="text" id="catalyst-breadcrumbs-border-thickness" name="catalyst[breadcrumbs_border_thickness]" value="<?php catalyst_dynamik_options_defaults( true, 'breadcrumbs_border_thickness' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Style', 'catalyst' ); ?> <select id="catalyst-breadcrumbs-border-style" name="catalyst[breadcrumbs_border_style]" size="1" style="width:80px; margin-right:5px;">
					<?php catalyst_list_borders( catalyst_get_dynamik( 'breadcrumbs_border_style' ) ); ?>
				</select>
				<input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-breadcrumbs-border-color" name="catalyst[breadcrumbs_border_color]" value="<?php catalyst_dynamik_options_defaults( true, 'breadcrumbs_border_color' ); ?>" />
			</p>
		</div>
		
		<div class="dynamik-design-standard-hide">
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Breadcrumbs Margins', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p>
				<?php _e( 'Top Margin', 'catalyst' ); ?>
				<input type="text" id="catalyst-breadcrumbs-margin-top" name="catalyst[breadcrumbs_margin_top]" value="<?php catalyst_dynamik_options_defaults( true, 'breadcrumbs_margin_top' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Bottom Margin', 'catalyst' ); ?>
				<input type="text" id="catalyst-breadcrumbs-margin-bottom" name="catalyst[breadcrumbs_margin_bottom]" value="<?php catalyst_dynamik_options_defaults( true, 'breadcrumbs_margin_bottom' ); ?>" style="width:35px;" /><?php _e( 'px', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Breadcrumbs Padding', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p>
				<?php _e( 'Padding: Top', 'catalyst' ); ?>
				<input type="text" id="catalyst-breadcrumbs-padding-top" name="catalyst[breadcrumbs_padding_top]" value="<?php catalyst_dynamik_options_defaults( true, 'breadcrumbs_padding_top' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Right', 'catalyst' ); ?>
				<input type="text" id="catalyst-breadcrumbs-padding-right" name="catalyst[breadcrumbs_padding_right]" value="<?php catalyst_dynamik_options_defaults( true, 'breadcrumbs_padding_right' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Bottom', 'catalyst' ); ?>
				<input type="text" id="catalyst-breadcrumbs-padding-bottom" name="catalyst[breadcrumbs_padding_bottom]" value="<?php catalyst_dynamik_options_defaults( true, 'breadcrumbs_padding_bottom' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Left', 'catalyst' ); ?>
				<input type="text" id="catalyst-breadcrumbs-padding-left" name="catalyst[breadcrumbs_padding_left]" value="<?php catalyst_dynamik_options_defaults( true, 'breadcrumbs_padding_left' ); ?>" style="width:35px;" /><?php _e( 'px', 'catalyst' ); ?>
			</p>
		</div>
		
		</div><!-- End .dynamik-design-standard-hide -->
		
	</div>
</div>