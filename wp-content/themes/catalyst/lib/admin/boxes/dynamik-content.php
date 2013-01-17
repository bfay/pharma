<?php
/**
 * Builds the Dynamik Content admin content.
 *
 * @package Catalyst
 */
?>

<div id="catalyst-dynamik-options-nav-content-box" class="catalyst-optionbox-outer-1col catalyst-all-options">
	<div class="catalyst-optionbox-inner-1col">
		<h3><?php _e( 'Content', 'catalyst' ); ?></h3>
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'Content Heading Font', 'catalyst' ); ?></p>
		</div>

		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'H1 - H6 Font Type', 'catalyst' ); ?> <select class="catalyst-universal-font-type-child catalyst-universal-heading-font-type-child" id="catalyst-content-heading-font-type" name="catalyst[font_type][content_heading]" size="1" style="width:98px;">
				<?php catalyst_build_font_menu( $dynamik_font_type['content_heading'] ); ?></select>
				<input type="checkbox" class="universal-check" id="catalyst-content-heading-font-universal" name="catalyst[content_heading_font_u]" value="u" <?php if( checked( 'u', catalyst_get_dynamik( 'content_heading_font_u' ) ) ); ?> /> <?php _e( '(U)', 'catalyst' ); ?>
				<span class="catalyst-custom-fonts-button-wrap"><span id="show-content-heading-font-css" class="catalyst-custom-fonts-button">#Custom</span></span>
				<div style="display:none;" id="show-content-heading-font-css-box" class="catalyst-custom-fonts-box">
				<?php _e( 'Content Heading Font Custom CSS | <code>#content h1, #content h2, #content h3, #content h4, #content h5, #content h6 { }</code>', 'catalyst' ); ?><br />
				<textarea class="catalyst-universal-font-css-child catalyst-universal-heading-font-css-child" id="catalyst-content-heading-font-css" name="catalyst[content_heading_font_css]" style="width:100%;" rows="10"><?php echo catalyst_get_dynamik( 'content_heading_font_css' ); ?></textarea>
				</div>
			</p>
		</div>
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'Content Heading Font Sizes H1-H2', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'H1', 'catalyst' ); ?>
				<input type="text" id="catalyst-content-heading-h1-font-size" name="catalyst[content_heading_h1_font_size]" value="<?php catalyst_dynamik_options_defaults( true, 'content_heading_h1_font_size' ); ?>" style="width:40px;" />
				<select class="catalyst-universal-px-em-child catalyst-universal-heading-px-em-child" id="catalyst-content-heading-h1-px-em" name="catalyst[h1_px_em]" size="1" style="width:50px;">
					<option value="px"<?php echo ( catalyst_get_dynamik( 'h1_px_em' ) == 'px' ) ? ' selected="selected"' : ''; ?>>px</option>
					<option value="em"<?php echo ( catalyst_get_dynamik( 'h1_px_em' ) == 'em' ) ? ' selected="selected"' : ''; ?>>em</option>
				</select>
				<?php _e( 'H2', 'catalyst' ); ?>
				<input type="text" id="catalyst-content-heading-h2-font-size" name="catalyst[content_heading_h2_font_size]" value="<?php catalyst_dynamik_options_defaults( true, 'content_heading_h2_font_size' ); ?>" style="width:40px;" />
				<select class="catalyst-universal-px-em-child catalyst-universal-heading-px-em-child" id="catalyst-content-heading-h2-px-em" name="catalyst[h2_px_em]" size="1" style="width:50px;">
					<option value="px"<?php echo ( catalyst_get_dynamik( 'h2_px_em' ) == 'px' ) ? ' selected="selected"' : ''; ?>>px</option>
					<option value="em"<?php echo ( catalyst_get_dynamik( 'h2_px_em' ) == 'em' ) ? ' selected="selected"' : ''; ?>>em</option>
				</select>
				<input type="checkbox" class="universal-check" id="catalyst-content-heading-h1-h2-px-em-universal" name="catalyst[content_heading_h1_h2_px_em_u]" value="u" <?php if( checked( 'u', catalyst_get_dynamik( 'content_heading_h1_h2_px_em_u' ) ) ); ?> /> <?php _e( '(U)', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'Content Heading Font Sizes H3-H6', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'H3', 'catalyst' ); ?>
				<input type="text" id="catalyst-content-heading-h3-font-size" name="catalyst[content_heading_h3_font_size]" value="<?php catalyst_dynamik_options_defaults( true, 'content_heading_h3_font_size' ); ?>" style="width:40px;" />
				<select class="catalyst-universal-px-em-child catalyst-universal-heading-px-em-child" id="catalyst-content-heading-h3-px-em" name="catalyst[h3_px_em]" size="1" style="width:50px;">
					<option value="px"<?php echo ( catalyst_get_dynamik( 'h3_px_em' ) == 'px' ) ? ' selected="selected"' : ''; ?>>px</option>
					<option value="em"<?php echo ( catalyst_get_dynamik( 'h3_px_em' ) == 'em' ) ? ' selected="selected"' : ''; ?>>em</option>
				</select>
				<?php _e( 'H4', 'catalyst' ); ?>
				<input type="text" id="catalyst-content-heading-h4-font-size" name="catalyst[content_heading_h4_font_size]" value="<?php catalyst_dynamik_options_defaults( true, 'content_heading_h4_font_size' ); ?>" style="width:40px;" />
				<select class="catalyst-universal-px-em-child catalyst-universal-heading-px-em-child" id="catalyst-content-heading-h4-px-em" name="catalyst[h4_px_em]" size="1" style="width:50px;">
					<option value="px"<?php echo ( catalyst_get_dynamik( 'h4_px_em' ) == 'px' ) ? ' selected="selected"' : ''; ?>>px</option>
					<option value="em"<?php echo ( catalyst_get_dynamik( 'h4_px_em' ) == 'em' ) ? ' selected="selected"' : ''; ?>>em</option>
				</select>
				<?php _e( 'H5', 'catalyst' ); ?>
				<input type="text" id="catalyst-content-heading-h5-font-size" name="catalyst[content_heading_h5_font_size]" value="<?php catalyst_dynamik_options_defaults( true, 'content_heading_h5_font_size' ); ?>" style="width:40px;" />
				<select class="catalyst-universal-px-em-child catalyst-universal-heading-px-em-child" id="catalyst-content-heading-h5-px-em" name="catalyst[h5_px_em]" size="1" style="width:50px;">
					<option value="px"<?php echo ( catalyst_get_dynamik( 'h5_px_em' ) == 'px' ) ? ' selected="selected"' : ''; ?>>px</option>
					<option value="em"<?php echo ( catalyst_get_dynamik( 'h5_px_em' ) == 'em' ) ? ' selected="selected"' : ''; ?>>em</option>
				</select>
				<?php _e( 'H6', 'catalyst' ); ?>
				<input type="text" id="catalyst-content-heading-h6-font-size" name="catalyst[content_heading_h6_font_size]" value="<?php catalyst_dynamik_options_defaults( true, 'content_heading_h6_font_size' ); ?>" style="width:40px;" />
				<select class="catalyst-universal-px-em-child catalyst-universal-heading-px-em-child" id="catalyst-content-heading-h6-px-em" name="catalyst[h6_px_em]" size="1" style="width:50px;">
					<option value="px"<?php echo ( catalyst_get_dynamik( 'h6_px_em' ) == 'px' ) ? ' selected="selected"' : ''; ?>>px</option>
					<option value="em"<?php echo ( catalyst_get_dynamik( 'h6_px_em' ) == 'em' ) ? ' selected="selected"' : ''; ?>>em</option>
				</select>
				<input type="checkbox" class="universal-check" id="catalyst-content-heading-h3-h6-px-em-universal" name="catalyst[content_heading_h3_h6_px_em_u]" value="u" <?php if( checked( 'u', catalyst_get_dynamik( 'content_heading_h3_h6_px_em_u' ) ) ); ?> /> <?php _e( '(U)', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'Content Heading Font Colors H1-H2', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( '(H1)', 'catalyst' ); ?> <input type="text" class="catalyst-universal-font-color-child catalyst-universal-heading-font-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-content-heading-h1-font-color" name="catalyst[content_heading_h1_font_color]" value="<?php catalyst_dynamik_options_defaults( true, 'content_heading_h1_font_color' ); ?>" />
				<?php _e( '(H2)', 'catalyst' ); ?> <input type="text" class="catalyst-universal-font-color-child catalyst-universal-heading-font-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-content-heading-h2-font-color" name="catalyst[content_heading_h2_font_color]" value="<?php catalyst_dynamik_options_defaults( true, 'content_heading_h2_font_color' ); ?>" />
				<input type="checkbox" class="universal-check" id="catalyst-content-heading-h1-h2-font-color-font-universal" name="catalyst[content_heading_h1_h2_font_color_u]" value="u" <?php if( checked( 'u', catalyst_get_dynamik( 'content_heading_h1_h2_font_color_u' ) ) ); ?> /> <?php _e( '(U)', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'Content Heading Font Colors H3-H6', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( '(H3)', 'catalyst' ); ?> <input type="text" class="catalyst-universal-font-color-child catalyst-universal-heading-font-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-content-heading-h3-font-color" name="catalyst[content_heading_h3_font_color]" value="<?php catalyst_dynamik_options_defaults( true, 'content_heading_h3_font_color' ); ?>" />
				<?php _e( '(H4)', 'catalyst' ); ?> <input type="text" class="catalyst-universal-font-color-child catalyst-universal-heading-font-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-content-heading-h4-font-color" name="catalyst[content_heading_h4_font_color]" value="<?php catalyst_dynamik_options_defaults( true, 'content_heading_h4_font_color' ); ?>" />
				<?php _e( '(H5)', 'catalyst' ); ?> <input type="text" class="catalyst-universal-font-color-child catalyst-universal-heading-font-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-content-heading-h5-font-color" name="catalyst[content_heading_h5_font_color]" value="<?php catalyst_dynamik_options_defaults( true, 'content_heading_h5_font_color' ); ?>" />
				<?php _e( '(H6)', 'catalyst' ); ?> <input type="text" class="catalyst-universal-font-color-child catalyst-universal-heading-font-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-content-heading-h6-font-color" name="catalyst[content_heading_h6_font_color]" value="<?php catalyst_dynamik_options_defaults( true, 'content_heading_h6_font_color' ); ?>" />
				<input type="checkbox" class="universal-check" id="catalyst-content-heading-h3-h6-font-color-universal" name="catalyst[content_heading_h3_h6_font_color_u]" value="u" <?php if( checked( 'u', catalyst_get_dynamik( 'content_heading_h3_h6_font_color_u' ) ) ); ?> /> <?php _e( '(U)', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'Content Heading Link Options H2', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( '(H2) Link', 'catalyst' ); ?><input type="text" class="catalyst-universal-link-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-content-heading-h2-link-color" name="catalyst[content_heading_h2_link_color]" value="<?php catalyst_dynamik_options_defaults( true, 'content_heading_h2_link_color' ); ?>" />
				<?php _e( '(H2) Hover', 'catalyst' ); ?><input type="text" class="catalyst-universal-link-hover-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-content-heading-h2-hover-color" name="catalyst[content_heading_h2_hover_color]" value="<?php catalyst_dynamik_options_defaults( true, 'content_heading_h2_hover_color' ); ?>" />
				<?php _e( '(H2) Link Underline', 'catalyst' ); ?> <select class="catalyst-universal-link-underline-child" id="catalyst-content-heading-h2-link-underline" name="catalyst[content_heading_h2_link_underline]" size="1" style="width:90px;">
					<option value="Never"<?php if (catalyst_get_dynamik( 'content_heading_h2_link_underline' ) == 'Never') echo ' selected="selected"'; ?>><?php _e( 'Never', 'catalyst' ); ?></option>
					<option value="On Hover"<?php if (catalyst_get_dynamik( 'content_heading_h2_link_underline' ) == 'On Hover') echo ' selected="selected"'; ?>><?php _e( 'On Hover', 'catalyst' ); ?></option>
					<option value="Off Hover"<?php if (catalyst_get_dynamik( 'content_heading_h2_link_underline' ) == 'Off Hover') echo ' selected="selected"'; ?>><?php _e( 'Off Hover', 'catalyst' ); ?></option>
					<option value="Always"<?php if (catalyst_get_dynamik( 'content_heading_h2_link_underline' ) == 'Always') echo ' selected="selected"'; ?>><?php _e( 'Always', 'catalyst' ); ?></option>
				</select>
				<input type="checkbox" class="universal-check" id="catalyst-content-heading-h2-link-universal" name="catalyst[content_heading_h2_link_u]" value="u" <?php if( checked( 'u', catalyst_get_dynamik( 'content_heading_h2_link_u' ) ) ); ?> /> <?php _e( '(U)', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'Content Byline Font', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select class="catalyst-universal-font-type-child catalyst-universal-content-font-type-child" id="catalyst-content-byline-font-type" name="catalyst[font_type][content_byline]" size="1" style="width:98px;">
				<?php catalyst_build_font_menu( $dynamik_font_type['content_byline'] ); ?></select>
				<?php _e( 'Size', 'catalyst' ); ?>
				<input type="text" id="catalyst-content-byline-font-size" name="catalyst[content_byline_font_size]" value="<?php catalyst_dynamik_options_defaults( true, 'content_byline_font_size' ); ?>" style="width:40px;" />
				<select class="catalyst-universal-px-em-child catalyst-universal-content-px-em-child" id="catalyst-content-byline-px-em" name="catalyst[content_byline_px_em]" size="1" style="width:50px;">
					<option value="px"<?php echo ( catalyst_get_dynamik( 'content_byline_px_em' ) == 'px' ) ? ' selected="selected"' : ''; ?>>px</option>
					<option value="em"<?php echo ( catalyst_get_dynamik( 'content_byline_px_em' ) == 'em' ) ? ' selected="selected"' : ''; ?>>em</option>
				</select>
				<?php _e( 'Color', 'catalyst' ); ?><input type="text" class="catalyst-universal-font-color-child catalyst-universal-content-font-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-content-byline-font-color" name="catalyst[content_byline_font_color]" value="<?php catalyst_dynamik_options_defaults( true, 'content_byline_font_color' ); ?>" />
				<input type="checkbox" class="universal-check" id="catalyst-content-byline-font-universal" name="catalyst[content_byline_font_u]" value="u" <?php if( checked( 'u', catalyst_get_dynamik( 'content_byline_font_u' ) ) ); ?> /> <?php _e( '(U)', 'catalyst' ); ?>
				<span class="catalyst-custom-fonts-button-wrap"><span id="show-content-byline-font-css" class="catalyst-custom-fonts-button">#Custom</span></span>
				<div style="display:none;" id="show-content-byline-font-css-box" class="catalyst-custom-fonts-box">
				<?php _e( 'Content Byline Font Custom CSS | <code>.bylinemeta { }</code>', 'catalyst' ); ?><br />
				<textarea class="catalyst-universal-font-css-child catalyst-universal-content-font-css-child" id="catalyst-content-byline-font-css" name="catalyst[content_byline_font_css]" style="width:100%;" rows="10"><?php echo catalyst_get_dynamik( 'content_byline_font_css' ); ?></textarea>
				</div>
			</p>
		</div>
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'Content Byline Link', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Link', 'catalyst' ); ?><input type="text" class="catalyst-universal-link-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-content-byline-link-color" name="catalyst[content_byline_link_color]" value="<?php catalyst_dynamik_options_defaults( true, 'content_byline_link_color' ); ?>" />
				<?php _e( 'Link Hover', 'catalyst' ); ?><input type="text" class="catalyst-universal-link-hover-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-content-byline-link-hover-color" name="catalyst[content_byline_link_hover_color]" value="<?php catalyst_dynamik_options_defaults( true, 'content_byline_link_hover_color' ); ?>" />
				<?php _e( 'Link Underline', 'catalyst' ); ?> <select class="catalyst-universal-link-underline-child" id="catalyst-content-byline-link-underline" name="catalyst[content_byline_link_underline]" size="1" style="width:90px;">
					<option value="Never"<?php if (catalyst_get_dynamik( 'content_byline_link_underline' ) == 'Never') echo ' selected="selected"'; ?>><?php _e( 'Never', 'catalyst' ); ?></option>
					<option value="On Hover"<?php if (catalyst_get_dynamik( 'content_byline_link_underline' ) == 'On Hover') echo ' selected="selected"'; ?>><?php _e( 'On Hover', 'catalyst' ); ?></option>
					<option value="Off Hover"<?php if (catalyst_get_dynamik( 'content_byline_link_underline' ) == 'Off Hover') echo ' selected="selected"'; ?>><?php _e( 'Off Hover', 'catalyst' ); ?></option>
					<option value="Always"<?php if (catalyst_get_dynamik( 'content_byline_link_underline' ) == 'Always') echo ' selected="selected"'; ?>><?php _e( 'Always', 'catalyst' ); ?></option>
				</select>
				<input type="checkbox" class="universal-check" id="catalyst-content-byline-link-universal" name="catalyst[content_byline_link_u]" value="u" <?php if( checked( 'u', catalyst_get_dynamik( 'content_byline_link_u' ) ) ); ?> /> <?php _e( '(U)', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'Content Paragraph Font', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select class="catalyst-universal-font-type-child catalyst-universal-content-font-type-child" id="catalyst-content-p-font-type" name="catalyst[font_type][content_p]" size="1" style="width:98px;">
				<?php catalyst_build_font_menu( $dynamik_font_type['content_p'] ); ?></select>
				<?php _e( 'Size', 'catalyst' ); ?>
				<input type="text" id="catalyst-content-p-font-size" name="catalyst[content_p_font_size]" value="<?php catalyst_dynamik_options_defaults( true, 'content_p_font_size' ); ?>" style="width:40px;" />
				<select class="catalyst-universal-px-em-child catalyst-universal-content-px-em-child" id="catalyst-content-p-px-em" name="catalyst[content_p_px_em]" size="1" style="width:50px;">
					<option value="px"<?php echo ( catalyst_get_dynamik( 'content_p_px_em' ) == 'px' ) ? ' selected="selected"' : ''; ?>>px</option>
					<option value="em"<?php echo ( catalyst_get_dynamik( 'content_p_px_em' ) == 'em' ) ? ' selected="selected"' : ''; ?>>em</option>
				</select>
				<?php _e( 'Color', 'catalyst' ); ?><input type="text" class="catalyst-universal-font-color-child catalyst-universal-content-font-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-content-p-font-color" name="catalyst[content_p_font_color]" value="<?php catalyst_dynamik_options_defaults( true, 'content_p_font_color' ); ?>" />
				<input type="checkbox" class="universal-check" id="catalyst-content-paragraph-font-universal" name="catalyst[content_paragraph_font_u]" value="u" <?php if( checked( 'u', catalyst_get_dynamik( 'content_paragraph_font_u' ) ) ); ?> /> <?php _e( '(U)', 'catalyst' ); ?>
				<span class="catalyst-custom-fonts-button-wrap"><span id="show-content-font-css" class="catalyst-custom-fonts-button">#Custom</span></span>
				<div style="display:none;" id="show-content-font-css-box" class="catalyst-custom-fonts-box">
				<?php _e( 'Content Paragraph Font Custom CSS | <code>#content .post p, #content .page p { }</code>', 'catalyst' ); ?><br />
				<textarea class="catalyst-universal-font-css-child catalyst-universal-content-font-css-child" id="catalyst-content-p-font-css" name="catalyst[content_p_font_css]" style="width:100%;" rows="10"><?php echo catalyst_get_dynamik( 'content_p_font_css' ); ?></textarea>
				</div>
			</p>
		</div>
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'Content Paragraph Link', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Link', 'catalyst' ); ?><input type="text" class="catalyst-universal-link-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-content-p-link-color" name="catalyst[content_p_link_color]" value="<?php catalyst_dynamik_options_defaults( true, 'content_p_link_color' ); ?>" />
				<?php _e( 'Link Hover', 'catalyst' ); ?><input type="text" class="catalyst-universal-link-hover-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-content-p-link-hover-color" name="catalyst[content_p_link_hover_color]" value="<?php catalyst_dynamik_options_defaults( true, 'content_p_link_hover_color' ); ?>" />
				<?php _e( 'Link Underline', 'catalyst' ); ?> <select class="catalyst-universal-link-underline-child" id="catalyst-content-p-link-underline" name="catalyst[content_p_link_underline]" size="1" style="width:90px;">
					<option value="Never"<?php if (catalyst_get_dynamik( 'content_p_link_underline' ) == 'Never') echo ' selected="selected"'; ?>><?php _e( 'Never', 'catalyst' ); ?></option>
					<option value="On Hover"<?php if (catalyst_get_dynamik( 'content_p_link_underline' ) == 'On Hover') echo ' selected="selected"'; ?>><?php _e( 'On Hover', 'catalyst' ); ?></option>
					<option value="Off Hover"<?php if (catalyst_get_dynamik( 'content_p_link_underline' ) == 'Off Hover') echo ' selected="selected"'; ?>><?php _e( 'Off Hover', 'catalyst' ); ?></option>
					<option value="Always"<?php if (catalyst_get_dynamik( 'content_p_link_underline' ) == 'Always') echo ' selected="selected"'; ?>><?php _e( 'Always', 'catalyst' ); ?></option>
				</select>
				<input type="checkbox" class="universal-check" id="content-paragraph-link-universal" name="catalyst[content_paragraph_link_u]" value="u" <?php if( checked( 'u', catalyst_get_dynamik( 'content_paragraph_link_u' ) ) ); ?> /> <?php _e( '(U)', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'Blockquote Font', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select class="catalyst-universal-font-type-child catalyst-universal-content-font-type-child" id="catalyst-blockquote-font-type" name="catalyst[font_type][blockquote]" size="1" style="width:98px;">
				<?php catalyst_build_font_menu( $dynamik_font_type['blockquote'] ); ?></select>
				<?php _e( 'Size', 'catalyst' ); ?>
				<input type="text" id="catalyst-blockquote-font-size" name="catalyst[blockquote_font_size]" value="<?php catalyst_dynamik_options_defaults( true, 'blockquote_font_size' ); ?>" style="width:40px;" />
				<select class="catalyst-universal-px-em-child catalyst-universal-content-px-em-child" id="catalyst-blockquote-px-em" name="catalyst[blockquote_px_em]" size="1" style="width:50px;">
					<option value="px"<?php echo ( catalyst_get_dynamik( 'blockquote_px_em' ) == 'px' ) ? ' selected="selected"' : ''; ?>>px</option>
					<option value="em"<?php echo ( catalyst_get_dynamik( 'blockquote_px_em' ) == 'em' ) ? ' selected="selected"' : ''; ?>>em</option>
				</select>
				<?php _e( 'Color', 'catalyst' ); ?><input type="text" class="catalyst-universal-font-color-child catalyst-universal-content-font-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-blockquote-font-color" name="catalyst[blockquote_font_color]" value="<?php catalyst_dynamik_options_defaults( true, 'blockquote_font_color' ); ?>" />
				<input type="checkbox" class="universal-check" id="catalyst-blockquote-font-universal" name="catalyst[blockquote_font_u]" value="u" <?php if( checked( 'u', catalyst_get_dynamik( 'blockquote_font_u' ) ) ); ?> /> <?php _e( '(U)', 'catalyst' ); ?>
				<span class="catalyst-custom-fonts-button-wrap"><span id="show-blockquote-font-css" class="catalyst-custom-fonts-button">#Custom</span></span>
				<div style="display:none;" id="show-blockquote-font-css-box" class="catalyst-custom-fonts-box">
				<?php _e( 'Blockquote Font Custom CSS | <code>#content blockquote p { }</code>', 'catalyst' ); ?><br />
				<textarea class="catalyst-universal-font-css-child catalyst-universal-content-font-css-child" id="catalyst-blockquote-font-css" name="catalyst[blockquote_font_css]" style="width:100%;" rows="10"><?php echo catalyst_get_dynamik( 'blockquote_font_css' ); ?></textarea>
				</div>
			</p>
		</div>
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'Blockquote Link', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Link', 'catalyst' ); ?><input type="text" class="catalyst-universal-link-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-blockquote-link-color" name="catalyst[blockquote_link_color]" value="<?php catalyst_dynamik_options_defaults( true, 'blockquote_link_color' ); ?>" />
				<?php _e( 'Link Hover', 'catalyst' ); ?><input type="text" class="catalyst-universal-link-hover-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-blockquote-link-hover-color" name="catalyst[blockquote_link_hover_color]" value="<?php catalyst_dynamik_options_defaults( true, 'blockquote_link_hover_color' ); ?>" />
				<?php _e( 'Link Underline', 'catalyst' ); ?> <select class="catalyst-universal-link-underline-child" id="catalyst-blockquote-link-underline" name="catalyst[blockquote_link_underline]" size="1" style="width:90px;">
					<option value="Never"<?php if (catalyst_get_dynamik( 'blockquote_link_underline' ) == 'Never') echo ' selected="selected"'; ?>><?php _e( 'Never', 'catalyst' ); ?></option>
					<option value="On Hover"<?php if (catalyst_get_dynamik( 'blockquote_link_underline' ) == 'On Hover') echo ' selected="selected"'; ?>><?php _e( 'On Hover', 'catalyst' ); ?></option>
					<option value="Off Hover"<?php if (catalyst_get_dynamik( 'blockquote_link_underline' ) == 'Off Hover') echo ' selected="selected"'; ?>><?php _e( 'Off Hover', 'catalyst' ); ?></option>
					<option value="Always"<?php if (catalyst_get_dynamik( 'blockquote_link_underline' ) == 'Always') echo ' selected="selected"'; ?>><?php _e( 'Always', 'catalyst' ); ?></option>
				</select>
				<input type="checkbox" class="universal-check" id="catalyst-blockquote-link-universal" name="catalyst[blockquote_link_u]" value="u" <?php if( checked( 'u', catalyst_get_dynamik( 'blockquote_link_u' ) ) ); ?> /> <?php _e( '(U)', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'Image Caption Font', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select class="catalyst-universal-font-type-child catalyst-universal-content-font-type-child" id="catalyst-caption-font-type" name="catalyst[font_type][caption]" size="1" style="width:98px;">
				<?php catalyst_build_font_menu( $dynamik_font_type['caption'] ); ?></select>
				<?php _e( 'Size', 'catalyst' ); ?>
				<input type="text" id="catalyst-caption-font-size" name="catalyst[caption_font_size]" value="<?php catalyst_dynamik_options_defaults( true, 'caption_font_size' ); ?>" style="width:40px;" />
				<select class="catalyst-universal-px-em-child catalyst-universal-content-px-em-child" id="catalyst-caption-px-em" name="catalyst[caption_px_em]" size="1" style="width:50px;">
					<option value="px"<?php echo ( catalyst_get_dynamik( 'caption_px_em' ) == 'px' ) ? ' selected="selected"' : ''; ?>>px</option>
					<option value="em"<?php echo ( catalyst_get_dynamik( 'caption_px_em' ) == 'em' ) ? ' selected="selected"' : ''; ?>>em</option>
				</select>
				<?php _e( 'Color', 'catalyst' ); ?><input type="text" class="catalyst-universal-font-color-child catalyst-universal-content-font-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-caption-font-color" name="catalyst[caption_font_color]" value="<?php catalyst_dynamik_options_defaults( true, 'caption_font_color' ); ?>" />
				<input type="checkbox" class="universal-check" id="catalyst-caption-font-universal" name="catalyst[caption_font_u]" value="u" <?php if( checked( 'u', catalyst_get_dynamik( 'caption_font_u' ) ) ); ?> /> <?php _e( '(U)', 'catalyst' ); ?>
				<span class="catalyst-custom-fonts-button-wrap"><span id="show-caption-font-css" class="catalyst-custom-fonts-button">#Custom</span></span>
				<div style="display:none;" id="show-caption-font-css-box" class="catalyst-custom-fonts-box">
				<?php _e( 'Image Caption Font Custom CSS | <code>.wp-caption { }</code>', 'catalyst' ); ?><br />
				<textarea class="catalyst-universal-font-css-child catalyst-universal-content-font-css-child" id="catalyst-caption-font-css" name="catalyst[caption_font_css]" style="width:100%;" rows="10"><?php echo catalyst_get_dynamik( 'caption_font_css' ); ?></textarea>
				</div>
			</p>
		</div>
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'Post-Meta Font', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select class="catalyst-universal-font-type-child catalyst-universal-content-font-type-child" id="catalyst-post-meta-font-type" name="catalyst[font_type][post_meta]" size="1" style="width:98px;">
				<?php catalyst_build_font_menu( $dynamik_font_type['post_meta'] ); ?></select>
				<?php _e( 'Size', 'catalyst' ); ?>
				<input type="text" id="catalyst-post-meta-font-size" name="catalyst[post_meta_font_size]" value="<?php catalyst_dynamik_options_defaults( true, 'post_meta_font_size' ); ?>" style="width:40px;" />
				<select class="catalyst-universal-px-em-child catalyst-universal-content-px-em-child" id="catalyst-post-meta-px-em" name="catalyst[post_meta_px_em]" size="1" style="width:50px;">
					<option value="px"<?php echo ( catalyst_get_dynamik( 'post_meta_px_em' ) == 'px' ) ? ' selected="selected"' : ''; ?>>px</option>
					<option value="em"<?php echo ( catalyst_get_dynamik( 'post_meta_px_em' ) == 'em' ) ? ' selected="selected"' : ''; ?>>em</option>
				</select>
				<?php _e( 'Color', 'catalyst' ); ?><input type="text" class="catalyst-universal-font-color-child catalyst-universal-content-font-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-post-meta-font-color" name="catalyst[post_meta_font_color]" value="<?php catalyst_dynamik_options_defaults( true, 'post_meta_font_color' ); ?>" />
				<input type="checkbox" class="universal-check" id="catalyst-post-meta-font-universal" name="catalyst[post_meta_font_u]" value="u" <?php if( checked( 'u', catalyst_get_dynamik( 'post_meta_font_u' ) ) ); ?> /> <?php _e( '(U)', 'catalyst' ); ?>
				<span class="catalyst-custom-fonts-button-wrap"><span id="show-post-meta-font-css" class="catalyst-custom-fonts-button">#Custom</span></span>
				<div style="display:none;" id="show-post-meta-font-css-box" class="catalyst-custom-fonts-box">
				<?php _e( 'Post-Meta Font Custom CSS | <code>.post-meta p { }</code>', 'catalyst' ); ?><br />
				<textarea class="catalyst-universal-font-css-child catalyst-universal-content-font-css-child" id="catalyst-post-meta-font-css" name="catalyst[post_meta_font_css]" style="width:100%;" rows="10"><?php echo catalyst_get_dynamik( 'post_meta_font_css' ); ?></textarea>
				</div>
			</p>
		</div>
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'Post-Meta Link', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Link', 'catalyst' ); ?><input type="text" class="catalyst-universal-link-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-post-meta-link-color" name="catalyst[post_meta_link_color]" value="<?php catalyst_dynamik_options_defaults( true, 'post_meta_link_color' ); ?>" />
				<?php _e( 'Link Hover', 'catalyst' ); ?><input type="text" class="catalyst-universal-link-hover-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-post-meta-link-hover-color" name="catalyst[post_meta_link_hover_color]" value="<?php catalyst_dynamik_options_defaults( true, 'post_meta_link_hover_color' ); ?>" />
				<?php _e( 'Link Underline', 'catalyst' ); ?> <select class="catalyst-universal-link-underline-child" id="catalyst-post-meta-link-underline" name="catalyst[post_meta_link_underline]" size="1" style="width:90px;">
					<option value="Never"<?php if (catalyst_get_dynamik( 'post_meta_link_underline' ) == 'Never') echo ' selected="selected"'; ?>><?php _e( 'Never', 'catalyst' ); ?></option>
					<option value="On Hover"<?php if (catalyst_get_dynamik( 'post_meta_link_underline' ) == 'On Hover') echo ' selected="selected"'; ?>><?php _e( 'On Hover', 'catalyst' ); ?></option>
					<option value="Off Hover"<?php if (catalyst_get_dynamik( 'post_meta_link_underline' ) == 'Off Hover') echo ' selected="selected"'; ?>><?php _e( 'Off Hover', 'catalyst' ); ?></option>
					<option value="Always"<?php if (catalyst_get_dynamik( 'post_meta_link_underline' ) == 'Always') echo ' selected="selected"'; ?>><?php _e( 'Always', 'catalyst' ); ?></option>
				</select>
				<input type="checkbox" class="universal-check" id="catalyst-post-meta-link-universal" name="catalyst[post_meta_link_u]" value="u" <?php if( checked( 'u', catalyst_get_dynamik( 'post_meta_link_u' ) ) ); ?> /> <?php _e( '(U)', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="catalyst-bg-option-desc">
			<p><?php _e( 'Post Content Background', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select id="catalyst-post-content-bg-type" class="catalyst-bg-type" name="catalyst[post_content_bg_type]" size="1" style="width:150px;">
				<?php catalyst_list_bg_options( catalyst_get_dynamik( 'post_content_bg_type' ) ); ?>
				</select> <span style="display:none;" id="catalyst-post-content-bg-type-checkbox"><?php _e( '(No Color', 'catalyst' ); ?> <input type="checkbox" id="catalyst-post-content-bg-no-color" name="catalyst[post_content_bg_no_color]" value="1" <?php if( checked( 1, catalyst_get_dynamik( 'post_content_bg_no_color' ) ) ); ?> />)</span><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-post-content-bg-color" name="catalyst[post_content_bg_color]" value="<?php catalyst_dynamik_options_defaults( true, 'post_content_bg_color' ); ?>" />
				<?php _e( 'Image', 'catalyst' ); ?> <select id="catalyst-post-content-bg-image" name="catalyst[post_content_bg_image]" size="1" style="width:150px;"><?php catalyst_list_images( catalyst_get_dynamik( 'post_content_bg_image' ) ); ?></select>
			</p>
		</div>
		
		<div class="catalyst-bg-option-desc">
			<p><?php _e( 'Page Content Background', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select id="catalyst-page-content-bg-type" class="catalyst-bg-type" name="catalyst[page_content_bg_type]" size="1" style="width:150px;">
				<?php catalyst_list_bg_options( catalyst_get_dynamik( 'page_content_bg_type' ) ); ?>
				</select> <span style="display:none;" id="catalyst-page-content-bg-type-checkbox"><?php _e( '(No Color', 'catalyst' ); ?> <input type="checkbox" id="catalyst-page-content-bg-no-color" name="catalyst[page_content_bg_no_color]" value="1" <?php if( checked( 1, catalyst_get_dynamik( 'page_content_bg_no_color' ) ) ); ?> />)</span><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-page-content-bg-color" name="catalyst[page_content_bg_color]" value="<?php catalyst_dynamik_options_defaults( true, 'page_content_bg_color' ); ?>" />
				<?php _e( 'Image', 'catalyst' ); ?> <select id="catalyst-page-content-bg-image" name="catalyst[page_content_bg_image]" size="1" style="width:150px;"><?php catalyst_list_images( catalyst_get_dynamik( 'page_content_bg_image' ) ); ?></select>
			</p>
		</div>
		
		<div class="catalyst-bg-option-desc">
			<p><?php _e( 'Sticky Post Background', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select id="catalyst-sticky-post-bg-type" class="catalyst-bg-type" name="catalyst[sticky_post_bg_type]" size="1" style="width:150px;">
				<?php catalyst_list_bg_options( catalyst_get_dynamik( 'sticky_post_bg_type' ) ); ?>
				</select> <span style="display:none;" id="catalyst-sticky-post-bg-type-checkbox"><?php _e( '(No Color', 'catalyst' ); ?> <input type="checkbox" id="catalyst-sticky-post-bg-no-color" name="catalyst[sticky_post_bg_no_color]" value="1" <?php if( checked( 1, catalyst_get_dynamik( 'sticky_post_bg_no_color' ) ) ); ?> />)</span><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-sticky-post-bg-color" name="catalyst[sticky_post_bg_color]" value="<?php catalyst_dynamik_options_defaults( true, 'sticky_post_bg_color' ); ?>" />
				<?php _e( 'Image', 'catalyst' ); ?> <select id="catalyst-sticky-post-bg-image" name="catalyst[sticky_post_bg_image]" size="1" style="width:150px;"><?php catalyst_list_images( catalyst_get_dynamik( 'sticky_post_bg_image' ) ); ?></select>
			</p>
		</div>
		
		<div class="catalyst-bg-option-desc">
			<p><?php _e( 'Blockquote Background', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select id="catalyst-blockquote-bg-type" class="catalyst-bg-type" name="catalyst[blockquote_bg_type]" size="1" style="width:150px;">
				<?php catalyst_list_bg_options( catalyst_get_dynamik( 'blockquote_bg_type' ) ); ?>
				</select> <span style="display:none;" id="catalyst-blockquote-bg-type-checkbox"><?php _e( '(No Color', 'catalyst' ); ?> <input type="checkbox" id="catalyst-blockquote-bg-no-color" name="catalyst[blockquote_bg_no_color]" value="1" <?php if( checked( 1, catalyst_get_dynamik( 'blockquote_bg_no_color' ) ) ); ?> />)</span><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-blockquote-bg-color" name="catalyst[blockquote_bg_color]" value="<?php catalyst_dynamik_options_defaults( true, 'blockquote_bg_color' ); ?>" />
				<?php _e( 'Image', 'catalyst' ); ?> <select id="catalyst-blockquote-bg-image" name="catalyst[blockquote_bg_image]" size="1" style="width:150px;"><?php catalyst_list_images( catalyst_get_dynamik( 'blockquote_bg_image' ) ); ?></select>
			</p>
		</div>
		
		<div class="catalyst-bg-option-desc">
			<p><?php _e( 'Image Caption Background', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select id="catalyst-caption-bg-type" class="catalyst-bg-type" name="catalyst[caption_bg_type]" size="1" style="width:150px;">
				<?php catalyst_list_bg_options( catalyst_get_dynamik( 'caption_bg_type' ) ); ?>
				</select> <span style="display:none;" id="catalyst-caption-bg-type-checkbox"><?php _e( '(No Color', 'catalyst' ); ?> <input type="checkbox" id="catalyst-caption-bg-no-color" name="catalyst[caption_bg_no_color]" value="1" <?php if( checked( 1, catalyst_get_dynamik( 'caption_bg_no_color' ) ) ); ?> />)</span><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-caption-bg-color" name="catalyst[caption_bg_color]" value="<?php catalyst_dynamik_options_defaults( true, 'caption_bg_color' ); ?>" />
				<?php _e( 'Image', 'catalyst' ); ?> <select id="catalyst-caption-bg-image" name="catalyst[caption_bg_image]" size="1" style="width:150px;"><?php catalyst_list_images( catalyst_get_dynamik( 'caption_bg_image' ) ); ?></select>
			</p>
		</div>
		
		<div class="catalyst-bg-option-desc">
			<p><?php _e( 'Thumbnail Image Background', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select id="catalyst-thumbnail-bg-type" class="catalyst-bg-type" name="catalyst[thumbnail_bg_type]" size="1" style="width:150px;">
				<?php catalyst_list_bg_options( catalyst_get_dynamik( 'thumbnail_bg_type' ) ); ?>
				</select> <span style="display:none;" id="catalyst-thumbnail-bg-type-checkbox"><?php _e( '(No Color', 'catalyst' ); ?> <input type="checkbox" id="catalyst-thumbnail-bg-no-color" name="catalyst[thumbnail_bg_no_color]" value="1" <?php if( checked( 1, catalyst_get_dynamik( 'thumbnail_bg_no_color' ) ) ); ?> />)</span><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-thumbnail-bg-color" name="catalyst[thumbnail_bg_color]" value="<?php catalyst_dynamik_options_defaults( true, 'thumbnail_bg_color' ); ?>" />
				<?php _e( 'Image', 'catalyst' ); ?> <select id="catalyst-thumbnail-bg-image" name="catalyst[thumbnail_bg_image]" size="1" style="width:150px;"><?php catalyst_list_images( catalyst_get_dynamik( 'thumbnail_bg_image' ) ); ?></select>
			</p>
		</div>
		
		<div class="catalyst-border-option-desc">
			<p><?php _e( 'Post Content Border', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select id="catalyst-post-content-border-type" name="catalyst[post_content_border_type]" size="1" style="width:98px;">
					<option value="Full"<?php if (catalyst_get_dynamik( 'post_content_border_type' ) == 'Full') echo ' selected="selected"'; ?>><?php _e( 'Full', 'catalyst' ); ?></option>
					<option value="Top/Bottom"<?php if (catalyst_get_dynamik( 'post_content_border_type' ) == 'Top/Bottom') echo ' selected="selected"'; ?>><?php _e( 'Top/Bottom', 'catalyst' ); ?></option>
					<option value="Bottom"<?php if (catalyst_get_dynamik( 'post_content_border_type' ) == 'Bottom') echo ' selected="selected"'; ?>><?php _e( 'Bottom', 'catalyst' ); ?></option>
					<option value="Left"<?php if (catalyst_get_dynamik( 'post_content_border_type' ) == 'Left') echo ' selected="selected"'; ?>><?php _e( 'Left', 'catalyst' ); ?></option>
					<option value="Right"<?php if (catalyst_get_dynamik( 'post_content_border_type' ) == 'Right') echo ' selected="selected"'; ?>><?php _e( 'Right', 'catalyst' ); ?></option>
					<option value="Left/Right"<?php if (catalyst_get_dynamik( 'post_content_border_type' ) == 'Left/Right') echo ' selected="selected"'; ?>><?php _e( 'Left/Right', 'catalyst' ); ?></option>
				</select>
				<?php _e( 'Thickness', 'catalyst' ); ?>
				<input type="text" id="catalyst-post-content-border-thickness" name="catalyst[post_content_border_thickness]" value="<?php catalyst_dynamik_options_defaults( true, 'post_content_border_thickness' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Style', 'catalyst' ); ?> <select id="catalyst-post-content-border-style" name="catalyst[post_content_border_style]" size="1" style="width:80px; margin-right:5px;">
					<?php catalyst_list_borders( catalyst_get_dynamik( 'post_content_border_style' ) ); ?>
				</select>
				<?php _e( 'Color', 'catalyst' ); ?> <input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-post-content-border-color" name="catalyst[post_content_border_color]" value="<?php catalyst_dynamik_options_defaults( true, 'post_content_border_color' ); ?>" />
			</p>
		</div>
		
		<div class="catalyst-border-option-desc">
			<p><?php _e( 'Page Content Border', 'catalyst' ); ?></p>
		</div>

		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select id="catalyst-page-content-border-type" name="catalyst[page_content_border_type]" size="1" style="width:98px;">
					<option value="Full"<?php if (catalyst_get_dynamik( 'page_content_border_type' ) == 'Full') echo ' selected="selected"'; ?>><?php _e( 'Full', 'catalyst' ); ?></option>
					<option value="Top/Bottom"<?php if (catalyst_get_dynamik( 'page_content_border_type' ) == 'Top/Bottom') echo ' selected="selected"'; ?>><?php _e( 'Top/Bottom', 'catalyst' ); ?></option>
					<option value="Bottom"<?php if (catalyst_get_dynamik( 'page_content_border_type' ) == 'Bottom') echo ' selected="selected"'; ?>><?php _e( 'Bottom', 'catalyst' ); ?></option>
					<option value="Left"<?php if (catalyst_get_dynamik( 'page_content_border_type' ) == 'Left') echo ' selected="selected"'; ?>><?php _e( 'Left', 'catalyst' ); ?></option>
					<option value="Right"<?php if (catalyst_get_dynamik( 'page_content_border_type' ) == 'Right') echo ' selected="selected"'; ?>><?php _e( 'Right', 'catalyst' ); ?></option>
					<option value="Left/Right"<?php if (catalyst_get_dynamik( 'page_content_border_type' ) == 'Left/Right') echo ' selected="selected"'; ?>><?php _e( 'Left/Right', 'catalyst' ); ?></option>
				</select>
				<?php _e( 'Thickness', 'catalyst' ); ?>
				<input type="text" id="catalyst-page-content-border-thickness" name="catalyst[page_content_border_thickness]" value="<?php catalyst_dynamik_options_defaults( true, 'page_content_border_thickness' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Style', 'catalyst' ); ?> <select id="catalyst-page-content-border-style" name="catalyst[page_content_border_style]" size="1" style="width:80px; margin-right:5px;">
					<?php catalyst_list_borders( catalyst_get_dynamik( 'page_content_border_style' ) ); ?>
				</select>
				<?php _e( 'Color', 'catalyst' ); ?> <input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-page-content-border-color" name="catalyst[page_content_border_color]" value="<?php catalyst_dynamik_options_defaults( true, 'page_content_border_color' ); ?>" />
			</p>
		</div>
		
		<div class="catalyst-border-option-desc">
			<p><?php _e( 'Sticky Post Border', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select id="catalyst-sticky-post-border-type" name="catalyst[sticky_post_border_type]" size="1" style="width:98px;">
					<option value="Full"<?php if (catalyst_get_dynamik( 'sticky_post_border_type' ) == 'Full') echo ' selected="selected"'; ?>><?php _e( 'Full', 'catalyst' ); ?></option>
					<option value="Top/Bottom"<?php if (catalyst_get_dynamik( 'sticky_post_border_type' ) == 'Top/Bottom') echo ' selected="selected"'; ?>><?php _e( 'Top/Bottom', 'catalyst' ); ?></option>
					<option value="Bottom"<?php if (catalyst_get_dynamik( 'sticky_post_border_type' ) == 'Bottom') echo ' selected="selected"'; ?>><?php _e( 'Bottom', 'catalyst' ); ?></option>
					<option value="Left"<?php if (catalyst_get_dynamik( 'sticky_post_border_type' ) == 'Left') echo ' selected="selected"'; ?>><?php _e( 'Left', 'catalyst' ); ?></option>
					<option value="Left/Right"<?php if (catalyst_get_dynamik( 'sticky_post_border_type' ) == 'Left/Right') echo ' selected="selected"'; ?>><?php _e( 'Left/Right', 'catalyst' ); ?></option>
				</select>
				<?php _e( 'Thickness', 'catalyst' ); ?> <input type="text" id="catalyst-sticky-post-border-thickness" name="catalyst[sticky_post_border_thickness]" value="<?php catalyst_dynamik_options_defaults( true, 'sticky_post_border_thickness' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Style', 'catalyst' ); ?> <select id="catalyst-sticky_post-border-style" name="catalyst[sticky_post_border_style]" size="1" style="width:95px; margin-right:5px;">
					<?php catalyst_list_borders( catalyst_get_dynamik( 'sticky_post_border_style' ) ); ?>
				</select>
				<input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-sticky-post-border-color" name="catalyst[sticky_post_border_color]" value="<?php catalyst_dynamik_options_defaults( true, 'sticky_post_border_color' ); ?>" />
			</p>
		</div>
		
		<div class="catalyst-border-option-desc">
			<p><?php _e( 'Blockquote Border', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select id="catalyst-blockquote-border-type" name="catalyst[blockquote_border_type]" size="1" style="width:98px;">
					<option value="Full"<?php if (catalyst_get_dynamik( 'blockquote_border_type' ) == 'Full') echo ' selected="selected"'; ?>><?php _e( 'Full', 'catalyst' ); ?></option>
					<option value="Top/Bottom"<?php if (catalyst_get_dynamik( 'blockquote_border_type' ) == 'Top/Bottom') echo ' selected="selected"'; ?>><?php _e( 'Top/Bottom', 'catalyst' ); ?></option>
					<option value="Left"<?php if (catalyst_get_dynamik( 'blockquote_border_type' ) == 'Left') echo ' selected="selected"'; ?>><?php _e( 'Left', 'catalyst' ); ?></option>
					<option value="Left/Right"<?php if (catalyst_get_dynamik( 'blockquote_border_type' ) == 'Left/Right') echo ' selected="selected"'; ?>><?php _e( 'Left/Right', 'catalyst' ); ?></option>
				</select>
				<?php _e( 'Thickness', 'catalyst' ); ?> <input type="text" id="catalyst-blockquote-border-thickness" name="catalyst[blockquote_border_thickness]" value="<?php catalyst_dynamik_options_defaults( true, 'blockquote_border_thickness' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Style', 'catalyst' ); ?> <select id="catalyst-blockquote-border-style" name="catalyst[blockquote_border_style]" size="1" style="width:95px; margin-right:5px;">
					<?php catalyst_list_borders( catalyst_get_dynamik( 'blockquote_border_style' ) ); ?>
				</select>
				<input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-blockquote-border-color" name="catalyst[blockquote_border_color]" value="<?php catalyst_dynamik_options_defaults( true, 'blockquote_border_color' ); ?>" />
			</p>
		</div>
		
		<div class="catalyst-border-option-desc">
			<p><?php _e( 'Image Caption Border', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Thickness', 'catalyst' ); ?>
				<input type="text" id="catalyst-caption-border-thickness" name="catalyst[caption_border_thickness]" value="<?php catalyst_dynamik_options_defaults( true, 'caption_border_thickness' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Style', 'catalyst' ); ?> <select id="catalyst-caption-border-style" name="catalyst[caption_border_style]" size="1" style="width:80px;">
					<?php catalyst_list_borders( catalyst_get_dynamik( 'caption_border_style' ) ); ?>
				</select>
				<?php _e( 'Color', 'catalyst' ); ?> <input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-caption-border-color" name="catalyst[caption_border_color]" value="<?php catalyst_dynamik_options_defaults( true, 'caption_border_color' ); ?>" />
			</p>
		</div>
		
		<div class="catalyst-border-option-desc">
			<p><?php _e( 'Thumbnail Image Border', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Thickness', 'catalyst' ); ?>
				<input type="text" id="catalyst-thumbnail-border-thickness" name="catalyst[thumbnail_border_thickness]" value="<?php catalyst_dynamik_options_defaults( true, 'thumbnail_border_thickness' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Style', 'catalyst' ); ?> <select id="catalyst-thumbnail-border-style" name="catalyst[thumbnail_border_style]" size="1" style="width:80px;">
					<?php catalyst_list_borders( catalyst_get_dynamik( 'thumbnail_border_style' ) ); ?>
				</select>
				<?php _e( 'Color', 'catalyst' ); ?> <input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-thumbnail-border-color" name="catalyst[thumbnail_border_color]" value="<?php catalyst_dynamik_options_defaults( true, 'thumbnail_border_color' ); ?>" />
				<span class="dynamik-design-standard-hide">
				<?php _e( 'Padding', 'catalyst' ); ?>
				<input type="text" id="catalyst-thumbnail-image-padding" name="catalyst[thumbnail_image_padding]" value="<?php catalyst_dynamik_options_defaults( true, 'thumbnail_image_padding' ); ?>" style="width:35px;" /><?php _e( 'px', 'catalyst' ); ?>
				</span><!-- End .dynamik-design-standard-hide -->
			</p>
		</div>
		
		<div class="catalyst-border-option-desc">
			<p><?php _e( 'Content Bottom Border', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Thickness', 'catalyst' ); ?>
				<input type="text" id="catalyst-cc-bottom-border-thickness" name="catalyst[cc_bottom_border_thickness]" value="<?php catalyst_dynamik_options_defaults( true, 'cc_bottom_border_thickness' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Style', 'catalyst' ); ?> <select id="catalyst-cc-bottom-border-style" name="catalyst[cc_bottom_border_style]" size="1" style="width:80px;">
					<?php catalyst_list_borders( catalyst_get_dynamik( 'cc_bottom_border_style' ) ); ?>
				</select>
				<?php _e( 'Color', 'catalyst' ); ?> <input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-cc-bottom-border-color" name="catalyst[cc_bottom_border_color]" value="<?php catalyst_dynamik_options_defaults( true, 'cc_bottom_border_color' ); ?>" />
			</p>
		</div>
		
		<div class="dynamik-design-standard-hide">
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Post Content Margins', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p>
				<?php _e( 'Top Margin', 'catalyst' ); ?>
				<input type="text" id="catalyst-post-content-margin-top" name="catalyst[post_content_margin_top]" value="<?php catalyst_dynamik_options_defaults( true, 'post_content_margin_top' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Bottom Margin', 'catalyst' ); ?>
				<input type="text" id="catalyst-post-content-margin-bottom" name="catalyst[post_content_margin_bottom]" value="<?php catalyst_dynamik_options_defaults( true, 'post_content_margin_bottom' ); ?>" style="width:35px;" /><?php _e( 'px', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Post Content Padding', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p>
				<?php _e( 'Padding: Top', 'catalyst' ); ?>
				<input type="text" id="catalyst-post-content-padding-top" name="catalyst[post_content_padding_top]" value="<?php catalyst_dynamik_options_defaults( true, 'post_content_padding_top' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Right', 'catalyst' ); ?>
				<input type="text" id="catalyst-post-content-padding-right" name="catalyst[post_content_padding_right]" value="<?php catalyst_dynamik_options_defaults( true, 'post_content_padding_right' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Bottom', 'catalyst' ); ?>
				<input type="text" id="catalyst-post-content-padding-bottom" name="catalyst[post_content_padding_bottom]" value="<?php catalyst_dynamik_options_defaults( true, 'post_content_padding_bottom' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Left', 'catalyst' ); ?>
				<input type="text" id="catalyst-post-content-padding-left" name="catalyst[post_content_padding_left]" value="<?php catalyst_dynamik_options_defaults( true, 'post_content_padding_left' ); ?>" style="width:35px;" /><?php _e( 'px', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Page Content Margins', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p>
				<?php _e( 'Top Margin', 'catalyst' ); ?>
				<input type="text" id="catalyst-page-content-margin-top" name="catalyst[page_content_margin_top]" value="<?php catalyst_dynamik_options_defaults( true, 'page_content_margin_top' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Bottom Margin', 'catalyst' ); ?>
				<input type="text" id="catalyst-page-content-margin-bottom" name="catalyst[page_content_margin_bottom]" value="<?php catalyst_dynamik_options_defaults( true, 'page_content_margin_bottom' ); ?>" style="width:35px;" /><?php _e( 'px', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Page Content Padding', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p>
				<?php _e( 'Padding: Top', 'catalyst' ); ?>
				<input type="text" id="catalyst-page-content-padding-top" name="catalyst[page_content_padding_top]" value="<?php catalyst_dynamik_options_defaults( true, 'page_content_padding_top' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Right', 'catalyst' ); ?>
				<input type="text" id="catalyst-page-content-padding-right" name="catalyst[page_content_padding_right]" value="<?php catalyst_dynamik_options_defaults( true, 'page_content_padding_right' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Bottom', 'catalyst' ); ?>
				<input type="text" id="catalyst-page-content-padding-bottom" name="catalyst[page_content_padding_bottom]" value="<?php catalyst_dynamik_options_defaults( true, 'page_content_padding_bottom' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Left', 'catalyst' ); ?>
				<input type="text" id="catalyst-page-content-padding-left" name="catalyst[page_content_padding_left]" value="<?php catalyst_dynamik_options_defaults( true, 'page_content_padding_left' ); ?>" style="width:35px;" /><?php _e( 'px', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Sticky Post Margins', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p>
				<?php _e( 'Top Margin', 'catalyst' ); ?>
				<input type="text" id="catalyst-sticky-post-margin-top" name="catalyst[sticky_post_margin_top]" value="<?php catalyst_dynamik_options_defaults( true, 'sticky_post_margin_top' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Bottom Margin', 'catalyst' ); ?>
				<input type="text" id="catalyst-sticky-post-margin-bottom" name="catalyst[sticky_post_margin_bottom]" value="<?php catalyst_dynamik_options_defaults( true, 'sticky_post_margin_bottom' ); ?>" style="width:35px;" /><?php _e( 'px', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Sticky Post Padding', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p>
				<?php _e( 'Padding: Top', 'catalyst' ); ?>
				<input type="text" id="catalyst-sticky-post-padding-top" name="catalyst[sticky_post_padding_top]" value="<?php catalyst_dynamik_options_defaults( true, 'sticky_post_padding_top' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Right', 'catalyst' ); ?>
				<input type="text" id="catalyst-sticky-post-padding-right" name="catalyst[sticky_post_padding_right]" value="<?php catalyst_dynamik_options_defaults( true, 'sticky_post_padding_right' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Bottom', 'catalyst' ); ?>
				<input type="text" id="catalyst-sticky-post-padding-bottom" name="catalyst[sticky_post_padding_bottom]" value="<?php catalyst_dynamik_options_defaults( true, 'sticky_post_padding_bottom' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Left', 'catalyst' ); ?>
				<input type="text" id="catalyst-sticky-post-padding-left" name="catalyst[sticky_post_padding_left]" value="<?php catalyst_dynamik_options_defaults( true, 'sticky_post_padding_left' ); ?>" style="width:35px;" /><?php _e( 'px', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Paragraph / List-Style Padding', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p>
				<?php _e( 'Paragraph Bottom Padding', 'catalyst' ); ?>
				<input type="text" id="catalyst-content-paragraph-padding-bottom" name="catalyst[content_paragraph_padding_bottom]" value="<?php catalyst_dynamik_options_defaults( true, 'content_paragraph_padding_bottom' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'List-Style Bottom Padding', 'catalyst' ); ?>
				<input type="text" id="catalyst-content-list-style-padding-bottom" name="catalyst[content_list_style_padding_bottom]" value="<?php catalyst_dynamik_options_defaults( true, 'content_list_style_padding_bottom' ); ?>" style="width:35px;" /><?php _e( 'px', 'catalyst' ); ?>
			</p>
		</div>
		
		</div><!-- End .dynamik-design-standard-hide -->
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Hybrid Column Excerpt Width', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p>
				<?php _e( 'Hybrid Excerpt Width When Set To "Columns":', 'catalyst' ); ?>
				<input type="text" id="catalyst-hybrid-column-excerpt-width" name="catalyst[hybrid_column_excerpt_width]" value="<?php catalyst_dynamik_options_defaults( true, 'hybrid_column_excerpt_width' ); ?>" style="width:50px;" /> <?php _e( '( Blank = Default value of 48% )', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Content List Style Type', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Content List Style', 'catalyst' ); ?>
				<select id="catalyst-content-list-style" name="catalyst[content_list_style]" size="1" style="width:70px;">
					<option value="none"<?php if (catalyst_get_dynamik( 'content_list_style' ) == 'none') echo ' selected="selected"'; ?>><?php _e( 'none', 'catalyst' ); ?></option>
					<option value="disc"<?php if (catalyst_get_dynamik( 'content_list_style' ) == 'disc') echo ' selected="selected"'; ?>><?php _e( 'disc', 'catalyst' ); ?></option>
					<option value="circle"<?php if (catalyst_get_dynamik( 'content_list_style' ) == 'circle') echo ' selected="selected"'; ?>><?php _e( 'circle', 'catalyst' ); ?></option>
					<option value="square"<?php if (catalyst_get_dynamik( 'content_list_style' ) == 'square') echo ' selected="selected"'; ?>><?php _e( 'square', 'catalyst' ); ?></option>
				</select>
			</p>
		</div>
	</div>
</div>