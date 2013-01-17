<?php
/**
 * Builds the Dynamik Search admin content.
 *
 * @package Catalyst
 */
?>

<div id="catalyst-dynamik-options-nav-search-box" class="catalyst-optionbox-outer-1col catalyst-all-options">
	<div class="catalyst-optionbox-inner-1col">
		<h3><?php _e( 'Search', 'catalyst' ); ?></h3>
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'Search Form Font', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select class="catalyst-universal-font-type-child catalyst-universal-content-font-type-child" id="catalyst-search-form-font-type" name="catalyst[font_type][search_form]" size="1" style="width:98px;">
				<?php catalyst_build_font_menu( $dynamik_font_type['search_form'] ); ?></select>
				<?php _e( 'Size', 'catalyst' ); ?>
				<input type="text" id="catalyst-search-form-font-size" name="catalyst[search_form_font_size]" value="<?php catalyst_dynamik_options_defaults( true, 'search_form_font_size' ); ?>" style="width:40px;" />
				<select class="catalyst-universal-px-em-child catalyst-universal-content-px-em-child" id="catalyst-search-form-px-em" name="catalyst[search_form_px_em]" size="1" style="width:50px;">
					<option value="px"<?php echo ( catalyst_get_dynamik( 'search_form_px_em' ) == 'px' ) ? ' selected="selected"' : ''; ?>>px</option>
					<option value="em"<?php echo ( catalyst_get_dynamik( 'search_form_px_em' ) == 'em' ) ? ' selected="selected"' : ''; ?>>em</option>
				</select>
				<?php _e( 'Color', 'catalyst' ); ?><input type="text" class="catalyst-universal-font-color-child catalyst-universal-content-font-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-search-form-font-color" name="catalyst[search_form_font_color]" value="<?php catalyst_dynamik_options_defaults( true, 'search_form_font_color' ); ?>" />
				<input type="checkbox" class="universal-check" id="catalyst-search-form-font-universal" name="catalyst[search_form_font_u]" value="u" <?php if( checked( 'u', catalyst_get_dynamik( 'search_form_font_u' ) ) ); ?> /> <?php _e( '(U)', 'catalyst' ); ?>
				<span class="catalyst-custom-fonts-button-wrap"><span id="show-search-form-font-css" class="catalyst-custom-fonts-button">#Custom</span></span>
				<div style="display:none;" id="show-search-form-font-css-box" class="catalyst-custom-fonts-box">
				<?php _e( 'Search Form Font Custom CSS | <code>.s { }</code>', 'catalyst' ); ?><br />
				<textarea class="catalyst-universal-font-css-child catalyst-universal-content-font-css-child" id="catalyst-search-form-font-css" name="catalyst[search_form_font_css]" style="width:100%;" rows="10"><?php echo catalyst_get_dynamik( 'search_form_font_css' ); ?></textarea>
				</div>
			</p>
		</div>
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'Search Button Font', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select class="catalyst-universal-font-type-child catalyst-universal-content-font-type-child" id="catalyst-search-button-font-type" name="catalyst[font_type][search_button]" size="1" style="width:98px;">
				<?php catalyst_build_font_menu( $dynamik_font_type['search_button'] ); ?></select>
				<?php _e( 'Size', 'catalyst' ); ?>
				<input type="text" id="catalyst-search-button-font-size" name="catalyst[search_button_font_size]" value="<?php catalyst_dynamik_options_defaults( true, 'search_button_font_size' ); ?>" style="width:40px;" />
				<select class="catalyst-universal-px-em-child catalyst-universal-content-px-em-child" id="catalyst-search-button-px-em" name="catalyst[search_button_px_em]" size="1" style="width:50px;">
					<option value="px"<?php echo ( catalyst_get_dynamik( 'search_button_px_em' ) == 'px' ) ? ' selected="selected"' : ''; ?>>px</option>
					<option value="em"<?php echo ( catalyst_get_dynamik( 'search_button_px_em' ) == 'em' ) ? ' selected="selected"' : ''; ?>>em</option>
				</select>
				<?php _e( 'Color', 'catalyst' ); ?><input type="text" class="catalyst-universal-font-color-child catalyst-universal-content-font-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-search-button-font-color" name="catalyst[search_button_font_color]" value="<?php catalyst_dynamik_options_defaults( true, 'search_button_font_color' ); ?>" />
				<input type="checkbox" class="universal-check" id="catalyst-search-button-font-universal" name="catalyst[search_button_font_u]" value="u" <?php if( checked( 'u', catalyst_get_dynamik( 'search_button_font_u' ) ) ); ?> /> <?php _e( '(U)', 'catalyst' ); ?>
				<span class="catalyst-custom-fonts-button-wrap"><span id="show-search-button-font-css" class="catalyst-custom-fonts-button">#Custom</span></span>
				<div style="display:none;" id="show-search-button-font-css-box" class="catalyst-custom-fonts-box">
				<?php _e( 'Search Button Font Custom CSS | <code>.searchsubmit { }</code>', 'catalyst' ); ?><br />
				<textarea class="catalyst-universal-font-css-child catalyst-universal-content-font-css-child" id="catalyst-search-button-font-css" name="catalyst[search_button_font_css]" style="width:100%;" rows="10"><?php echo catalyst_get_dynamik( 'search_button_font_css' ); ?></textarea>
				</div>
			</p>
		</div>
		
		<div class="catalyst-bg-option-desc">
			<p><?php _e( 'Search Form Background', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select id="catalyst-search-form-bg-type" class="catalyst-bg-type" name="catalyst[search_form_bg_type]" size="1" style="width:150px;">
				<?php catalyst_list_bg_options( catalyst_get_dynamik( 'search_form_bg_type' ) ); ?>
				</select> <span style="display:none;" id="catalyst-search-form-bg-type-checkbox"><?php _e( '(No Color', 'catalyst' ); ?> <input type="checkbox" id="catalyst-search-form-bg-no-color" name="catalyst[search_form_bg_no_color]" value="1" <?php if( checked( 1, catalyst_get_dynamik( 'search_form_bg_no_color' ) ) ); ?> />)</span><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-search-form-bg-color" name="catalyst[search_form_bg_color]" value="<?php catalyst_dynamik_options_defaults( true, 'search_form_bg_color' ); ?>" />
				<?php _e( 'Image', 'catalyst' ); ?> <select id="catalyst-search-form-bg-image" name="catalyst[search_form_bg_image]" size="1" style="width:150px;"><?php catalyst_list_images( catalyst_get_dynamik( 'search_form_bg_image' ) ); ?></select>
			</p>
		</div>
		
		<div class="catalyst-bg-option-desc">
			<p><?php _e( 'Search Button Background', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select id="catalyst-search-button-bg-type" class="catalyst-bg-type" name="catalyst[search_button_bg_type]" size="1" style="width:150px;">
				<?php catalyst_list_bg_options( catalyst_get_dynamik( 'search_button_bg_type' ) ); ?>
				</select> <span style="display:none;" id="catalyst-search-button-bg-type-checkbox"><?php _e( '(No Color', 'catalyst' ); ?> <input type="checkbox" id="catalyst-search-button-bg-no-color" name="catalyst[search_button_bg_no_color]" value="1" <?php if( checked( 1, catalyst_get_dynamik( 'search_button_bg_no_color' ) ) ); ?> />)</span><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-search-button-bg-color" name="catalyst[search_button_bg_color]" value="<?php catalyst_dynamik_options_defaults( true, 'search_button_bg_color' ); ?>" />
				<?php _e( 'Image', 'catalyst' ); ?> <select id="catalyst-search-button-bg-image" name="catalyst[search_button_bg_image]" size="1" style="width:150px;"><?php catalyst_list_images( catalyst_get_dynamik( 'search_button_bg_image' ) ); ?></select>
			</p>
		</div>
		
		<div class="catalyst-bg-option-desc">
			<p><?php _e( 'Search Button Hover Background', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select id="catalyst-search-button-hover-bg-type" class="catalyst-bg-type" name="catalyst[search_button_hover_bg_type]" size="1" style="width:150px;">
				<?php catalyst_list_bg_options( catalyst_get_dynamik( 'search_button_hover_bg_type' ) ); ?>
				</select> <span style="display:none;" id="catalyst-search-button-hover-bg-type-checkbox"><?php _e( '(No Color', 'catalyst' ); ?> <input type="checkbox" id="catalyst-search-button-hover-bg-no-color" name="catalyst[search_button_hover_bg_no_color]" value="1" <?php if( checked( 1, catalyst_get_dynamik( 'search_button_hover_bg_no_color' ) ) ); ?> />)</span><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-search-button-hover-bg-color" name="catalyst[search_button_hover_bg_color]" value="<?php catalyst_dynamik_options_defaults( true, 'search_button_hover_bg_color' ); ?>" />
				<?php _e( 'Image', 'catalyst' ); ?> <select id="catalyst-search-button-hover-bg-image" name="catalyst[search_button_hover_bg_image]" size="1" style="width:150px;"><?php catalyst_list_images( catalyst_get_dynamik( 'search_button_hover_bg_image' ) ); ?></select>
			</p>
		</div>
		
		<div class="catalyst-border-option-desc">
			<p><?php _e( 'Search Form Border', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Thickness', 'catalyst' ); ?> <input type="text" id="catalyst-search-form-border-thickness" name="catalyst[search_form_border_thickness]" value="<?php catalyst_dynamik_options_defaults( true, 'search_form_border_thickness' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Style', 'catalyst' ); ?> <select id="catalyst-search-form-border-style" name="catalyst[search_form_border_style]" size="1" style="width:90px; margin-right:5px;">
					<?php catalyst_list_borders( catalyst_get_dynamik( 'search_form_border_style' ) ); ?>
				</select>
				<input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-search-form-border-color" name="catalyst[search_form_border_color]" value="<?php catalyst_dynamik_options_defaults( true, 'search_form_border_color' ); ?>" />
			</p>
		</div>
		
		<div class="catalyst-border-option-desc">
			<p><?php _e( 'Search Button Border', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Thickness', 'catalyst' ); ?> <input type="text" id="catalyst-search-button-border-thickness" name="catalyst[search_button_border_thickness]" value="<?php catalyst_dynamik_options_defaults( true, 'search_button_border_thickness' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Style', 'catalyst' ); ?> <select id="catalyst-search-button-border-style" name="catalyst[search_button_border_style]" size="1" style="width:90px; margin-right:5px;">
					<?php catalyst_list_borders( catalyst_get_dynamik( 'search_button_border_style' ) ); ?>
				</select>
				<input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-search-button-border-color" name="catalyst[search_button_border_color]" value="<?php catalyst_dynamik_options_defaults( true, 'search_button_border_color' ); ?>" />
			</p>
		</div>
		
		<div class="catalyst-border-option-desc">
			<p><?php _e( 'Search Button Hover Border', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Thickness', 'catalyst' ); ?> <input type="text" id="catalyst-search-button-hover-border-thickness" name="catalyst[search_button_hover_border_thickness]" value="<?php catalyst_dynamik_options_defaults( true, 'search_button_hover_border_thickness' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Style', 'catalyst' ); ?> <select id="catalyst-search-button-hover-border-style" name="catalyst[search_button_hover_border_style]" size="1" style="width:90px; margin-right:5px;">
					<?php catalyst_list_borders( catalyst_get_dynamik( 'search_button_hover_border_style' ) ); ?>
				</select>
				<input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-search-button-hover-border-color" name="catalyst[search_button_hover_border_color]" value="<?php catalyst_dynamik_options_defaults( true, 'search_button_hover_border_color' ); ?>" />
			</p>
		</div>
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Search Form Width', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Width', 'catalyst' ); ?> <input type="text" id="catalyst-search-form-width" name="catalyst[search_form_width]" value="<?php catalyst_dynamik_options_defaults( true, 'search_form_width' ); ?>" style="width:35px;" /><?php _e( 'px', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="dynamik-design-standard-hide">
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Search Form Padding', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p>
				<?php _e( 'Padding: Top', 'catalyst' ); ?>
				<input type="text" id="catalyst-search-form-padding-top" name="catalyst[search_form_padding_top]" value="<?php catalyst_dynamik_options_defaults( true, 'search_form_padding_top' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Right', 'catalyst' ); ?>
				<input type="text" id="catalyst-search-form-padding-right" name="catalyst[search_form_padding_right]" value="<?php catalyst_dynamik_options_defaults( true, 'search_form_padding_right' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Bottom', 'catalyst' ); ?>
				<input type="text" id="catalyst-search-form-padding-bottom" name="catalyst[search_form_padding_bottom]" value="<?php catalyst_dynamik_options_defaults( true, 'search_form_padding_bottom' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Left', 'catalyst' ); ?>
				<input type="text" id="catalyst-search-form-padding-left" name="catalyst[search_form_padding_left]" value="<?php catalyst_dynamik_options_defaults( true, 'search_form_padding_left' ); ?>" style="width:35px;" /><?php _e( 'px', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Search Button Padding', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p>
				<?php _e( 'Padding: Top', 'catalyst' ); ?>
				<input type="text" id="catalyst-search-button-padding-top" name="catalyst[search_button_padding_top]" value="<?php catalyst_dynamik_options_defaults( true, 'search_button_padding_top' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Right', 'catalyst' ); ?>
				<input type="text" id="catalyst-search-button-padding-right" name="catalyst[search_button_padding_right]" value="<?php catalyst_dynamik_options_defaults( true, 'search_button_padding_right' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Bottom', 'catalyst' ); ?>
				<input type="text" id="catalyst-search-button-padding-bottom" name="catalyst[search_button_padding_bottom]" value="<?php catalyst_dynamik_options_defaults( true, 'search_button_padding_bottom' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Left', 'catalyst' ); ?>
				<input type="text" id="catalyst-search-button-padding-left" name="catalyst[search_button_padding_left]" value="<?php catalyst_dynamik_options_defaults( true, 'search_button_padding_left' ); ?>" style="width:35px;" /><?php _e( 'px', 'catalyst' ); ?>
			</p>
		</div>
		
		</div><!-- End .dynamik-design-standard-hide -->
		
	</div>
</div>