<?php
/**
 * Builds the Dynamik Comments admin content.
 *
 * @package Catalyst
 */
?>

<div id="catalyst-dynamik-options-nav-comments-box" class="catalyst-optionbox-outer-1col catalyst-all-options">
	<div class="catalyst-optionbox-inner-1col">
		<h3><?php _e( 'Comments', 'catalyst' ); ?></h3>
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'Comment Heading Font', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select class="catalyst-universal-font-type-child catalyst-universal-heading-font-type-child" id="catalyst-comment-heading-font-type" name="catalyst[font_type][comment_heading]" size="1" style="width:98px;">
				<?php catalyst_build_font_menu( $dynamik_font_type['comment_heading'] ); ?></select>
				<input type="text" id="catalyst-comment-heading-font-size" name="catalyst[comment_heading_font_size]" value="<?php catalyst_dynamik_options_defaults( true, 'comment_heading_font_size' ); ?>" style="width:40px;" />
				<select class="catalyst-universal-px-em-child catalyst-universal-heading-px-em-child" id="catalyst-comment-heading-px-em" name="catalyst[comment_heading_px_em]" size="1" style="width:50px;">
					<option value="px"<?php echo ( catalyst_get_dynamik( 'comment_heading_px_em' ) == 'px' ) ? ' selected="selected"' : ''; ?>>px</option>
					<option value="em"<?php echo ( catalyst_get_dynamik( 'comment_heading_px_em' ) == 'em' ) ? ' selected="selected"' : ''; ?>>em</option>
				</select>
				<?php _e( 'Color', 'catalyst' ); ?><input type="text" class="catalyst-universal-font-color-child catalyst-universal-heading-font-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-comment-heading-font-color" name="catalyst[comment_heading_font_color]" value="<?php catalyst_dynamik_options_defaults( true, 'comment_heading_font_color' ); ?>" />
				<input type="checkbox" class="universal-check" id="catalyst-comment-heading-font-universal" name="catalyst[comment_heading_font_u]" value="u" <?php if( checked( 'u', catalyst_get_dynamik( 'comment_heading_font_u' ) ) ); ?> /> <?php _e( '(U)', 'catalyst' ); ?>
				<span class="catalyst-custom-fonts-button-wrap"><span id="show-comment-heading-font-css" class="catalyst-custom-fonts-button">#Custom</span></span>
				<div style="display:none;" id="show-comment-heading-font-css-box" class="catalyst-custom-fonts-box">
				<?php _e( 'Comment Heading Font Custom CSS | <code>.comment-heading { }</code>', 'catalyst' ); ?><br />
				<textarea class="catalyst-universal-font-css-child catalyst-universal-heading-font-css-child" id="catalyst-comment-heading-font-css" name="catalyst[comment_heading_font_css]" style="width:100%;" rows="10"><?php echo catalyst_get_dynamik( 'comment_heading_font_css' ); ?></textarea>
				</div>
			</p>
		</div>
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'Comment Author Font', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select class="catalyst-universal-font-type-child catalyst-universal-content-font-type-child" id="catalyst-comment-author-font-type" name="catalyst[font_type][comment_author]" size="1" style="width:98px;">
				<?php catalyst_build_font_menu( $dynamik_font_type['comment_author'] ); ?></select>
				<input type="text" id="catalyst-comment-author-font-size" name="catalyst[comment_author_font_size]" value="<?php catalyst_dynamik_options_defaults( true, 'comment_author_font_size' ); ?>" style="width:40px;" />
				<select class="catalyst-universal-px-em-child catalyst-universal-content-px-em-child" id="catalyst-comment-author-px-em" name="catalyst[comment_author_px_em]" size="1" style="width:50px;">
					<option value="px"<?php echo ( catalyst_get_dynamik( 'comment_author_px_em' ) == 'px' ) ? ' selected="selected"' : ''; ?>>px</option>
					<option value="em"<?php echo ( catalyst_get_dynamik( 'comment_author_px_em' ) == 'em' ) ? ' selected="selected"' : ''; ?>>em</option>
				</select>
				<?php _e( 'Color', 'catalyst' ); ?><input type="text" class="catalyst-universal-font-color-child catalyst-universal-content-font-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-comment-author-font-color" name="catalyst[comment_author_font_color]" value="<?php catalyst_dynamik_options_defaults( true, 'comment_author_font_color' ); ?>" />
				<input type="checkbox" class="universal-check" id="catalyst-comment-author-font-universal" name="catalyst[comment_author_font_u]" value="u" <?php if( checked( 'u', catalyst_get_dynamik( 'comment_author_font_u' ) ) ); ?> /> <?php _e( '(U)', 'catalyst' ); ?>
				<span class="catalyst-custom-fonts-button-wrap"><span id="show-comment-author-font-css" class="catalyst-custom-fonts-button">#Custom</span></span>
				<div style="display:none;" id="show-comment-author-font-css-box" class="catalyst-custom-fonts-box">
				<?php _e( 'Comment Author Custom CSS | <code>.comment-author { }</code>', 'catalyst' ); ?><br />
				<textarea class="catalyst-universal-font-css-child catalyst-universal-content-font-css-child" id="catalyst-comment-author-font-css" name="catalyst[comment_author_font_css]" style="width:100%;" rows="10"><?php echo catalyst_get_dynamik( 'comment_author_font_css' ); ?></textarea>
				</div>
			</p>
		</div>
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'Comment Meta Font', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select class="catalyst-universal-font-type-child catalyst-universal-content-font-type-child" id="catalyst-comment-meta-font-type" name="catalyst[font_type][comment_meta]" size="1" style="width:98px;">
				<?php catalyst_build_font_menu( $dynamik_font_type['comment_meta'] ); ?></select>
				<input type="text" id="catalyst-comment-meta-font-size" name="catalyst[comment_meta_font_size]" value="<?php catalyst_dynamik_options_defaults( true, 'comment_meta_font_size' ); ?>" style="width:35px;">
				<select class="catalyst-universal-px-em-child catalyst-universal-content-px-em-child" id="catalyst-comment-meta-px-em" name="catalyst[comment_meta_px_em]" size="1" style="width:50px;">
					<option value="px"<?php echo ( catalyst_get_dynamik( 'comment_meta_px_em' ) == 'px' ) ? ' selected="selected"' : ''; ?>>px</option>
					<option value="em"<?php echo ( catalyst_get_dynamik( 'comment_meta_px_em' ) == 'em' ) ? ' selected="selected"' : ''; ?>>em</option>
				</select>
				<input type="checkbox" class="universal-check" id="catalyst-comment-meta-font-universal" name="catalyst[comment_meta_font_u]" value="u" <?php if( checked( 'u', catalyst_get_dynamik( 'comment_meta_font_u' ) ) ); ?> /> <?php _e( '(U)', 'catalyst' ); ?>
				<span class="catalyst-custom-fonts-button-wrap"><span id="show-comment-meta-font-css" class="catalyst-custom-fonts-button">#Custom</span></span>
				<div style="display:none;" id="show-comment-meta-font-css-box" class="catalyst-custom-fonts-box">
				<?php _e( 'Comment Meta Font Custom CSS | <code>.commentmetadata { }</code>', 'catalyst' ); ?><br />
				<textarea class="catalyst-universal-font-css-child catalyst-universal-content-font-css-child" id="catalyst-comment-meta-font-css" name="catalyst[comment_meta_font_css]" style="width:100%;" rows="10"><?php echo catalyst_get_dynamik( 'comment_meta_font_css' ); ?></textarea>
				</div>
			</p>
		</div>
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'Comment Meta Link', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Link', 'catalyst' ); ?><input type="text" class="catalyst-universal-link-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-comment-meta-link-color" name="catalyst[comment_meta_link_color]" value="<?php catalyst_dynamik_options_defaults( true, 'comment_meta_link_color' ); ?>" />
				<?php _e( 'Link Hover', 'catalyst' ); ?><input type="text" class="catalyst-universal-link-hover-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-comment-meta-link-hover-color" name="catalyst[comment_meta_link_hover_color]" value="<?php catalyst_dynamik_options_defaults( true, 'comment_meta_link_hover_color' ); ?>" />
				<?php _e( 'Link Underline', 'catalyst' ); ?> <select class="catalyst-universal-link-underline-child" id="catalyst-comment-meta-link-underline" name="catalyst[comment_meta_link_underline]" size="1" style="width:90px;">
					<option value="Never"<?php if (catalyst_get_dynamik( 'comment_meta_link_underline' ) == 'Never') echo ' selected="selected"'; ?>><?php _e( 'Never', 'catalyst' ); ?></option>
					<option value="On Hover"<?php if (catalyst_get_dynamik( 'comment_meta_link_underline' ) == 'On Hover') echo ' selected="selected"'; ?>><?php _e( 'On Hover', 'catalyst' ); ?></option>
					<option value="Off Hover"<?php if (catalyst_get_dynamik( 'comment_meta_link_underline' ) == 'Off Hover') echo ' selected="selected"'; ?>><?php _e( 'Off Hover', 'catalyst' ); ?></option>
					<option value="Always"<?php if (catalyst_get_dynamik( 'comment_meta_link_underline' ) == 'Always') echo ' selected="selected"'; ?>><?php _e( 'Always', 'catalyst' ); ?></option>
				</select>
				<input type="checkbox" class="universal-check" id="catalyst-comment-meta-link-universal" name="catalyst[comment_meta_link_u]" value="u" <?php if( checked( 'u', catalyst_get_dynamik( 'comment_meta_link_u' ) ) ); ?> /> <?php _e( '(U)', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'Comment Body Font', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select class="catalyst-universal-font-type-child catalyst-universal-content-font-type-child" id="catalyst-comment-body-font-type" name="catalyst[font_type][comment_body]" size="1" style="width:98px;">
				<?php catalyst_build_font_menu( $dynamik_font_type['comment_body'] ); ?></select>
				<input type="text" id="catalyst-comment-body-font-size" name="catalyst[comment_body_font_size]" value="<?php catalyst_dynamik_options_defaults( true, 'comment_body_font_size' ); ?>" style="width:40px;" />
				<select class="catalyst-universal-px-em-child catalyst-universal-content-px-em-child" id="catalyst-comment-body-px-em" name="catalyst[comment_body_px_em]" size="1" style="width:50px;">
					<option value="px"<?php echo ( catalyst_get_dynamik( 'comment_body_px_em' ) == 'px' ) ? ' selected="selected"' : ''; ?>>px</option>
					<option value="em"<?php echo ( catalyst_get_dynamik( 'comment_body_px_em' ) == 'em' ) ? ' selected="selected"' : ''; ?>>em</option>
				</select>
				<?php _e( 'Color', 'catalyst' ); ?><input type="text" class="catalyst-universal-font-color-child catalyst-universal-content-font-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-comment-body-font-color" name="catalyst[comment_body_font_color]" value="<?php catalyst_dynamik_options_defaults( true, 'comment_body_font_color' ); ?>" />
				<input type="checkbox" class="universal-check" id="catalyst-comment-body-font-universal" name="catalyst[comment_body_font_u]" value="u" <?php if( checked( 'u', catalyst_get_dynamik( 'comment_body_font_u' ) ) ); ?> /> <?php _e( '(U)', 'catalyst' ); ?>
				<span class="catalyst-custom-fonts-button-wrap"><span id="show-comment-body-font-css" class="catalyst-custom-fonts-button">#Custom</span></span>
				<div style="display:none;" id="show-comment-body-font-css-box" class="catalyst-custom-fonts-box">
				<?php _e( 'Comment Body Font Custom CSS <code>.comment-body-text, .commentlist p, .reply { }</code>', 'catalyst' ); ?><br />
				<textarea class="catalyst-universal-font-css-child catalyst-universal-content-font-css-child" id="catalyst-comment-body-font-css" name="catalyst[comment_body_font_css]" style="width:100%;" rows="10"><?php echo catalyst_get_dynamik( 'comment_body_font_css' ); ?></textarea>
				</div>
			</p>
		</div>
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'Comment Form Font', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select class="catalyst-universal-font-type-child catalyst-universal-content-font-type-child" id="catalyst-comment-form-font-type" name="catalyst[font_type][comment_form]" size="1" style="width:98px;">
				<?php catalyst_build_font_menu( $dynamik_font_type['comment_form'] ); ?></select>
				<input type="text" id="catalyst-comment-form-font-size" name="catalyst[comment_form_font_size]" value="<?php catalyst_dynamik_options_defaults( true, 'comment_form_font_size' ); ?>" style="width:40px;" />
				<select class="catalyst-universal-px-em-child catalyst-universal-content-px-em-child" id="catalyst-comment-form-px-em" name="catalyst[comment_form_px_em]" size="1" style="width:50px;">
					<option value="px"<?php echo ( catalyst_get_dynamik( 'comment_form_px_em' ) == 'px' ) ? ' selected="selected"' : ''; ?>>px</option>
					<option value="em"<?php echo ( catalyst_get_dynamik( 'comment_form_px_em' ) == 'em' ) ? ' selected="selected"' : ''; ?>>em</option>
				</select>
				<?php _e( 'Color', 'catalyst' ); ?><input type="text" class="catalyst-universal-font-color-child catalyst-universal-content-font-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-comment-form-font-color" name="catalyst[comment_form_font_color]" value="<?php catalyst_dynamik_options_defaults( true, 'comment_form_font_color' ); ?>" />
				<input type="checkbox" class="universal-check" id="catalyst-comment-form-font-universal" name="catalyst[comment_form_font_u]" value="u" <?php if( checked( 'u', catalyst_get_dynamik( 'comment_form_font_u' ) ) ); ?> /> <?php _e( '(U)', 'catalyst' ); ?>
				<span class="catalyst-custom-fonts-button-wrap"><span id="show-comment-form-font-css" class="catalyst-custom-fonts-button">#Custom</span></span>
				<div style="display:none;" id="show-comment-form-font-css-box" class="catalyst-custom-fonts-box">
				<?php _e( 'Comment Form Font Custom CSS | <code>#commentform textarea, #commentform #author, #commentform #email, #commentform #url { }</code>', 'catalyst' ); ?><br />
				<textarea class="catalyst-universal-font-css-child catalyst-universal-content-font-css-child" id="catalyst-comment-form-font-css" name="catalyst[comment_form_font_css]" style="width:100%;" rows="10"><?php echo catalyst_get_dynamik( 'comment_form_font_css' ); ?></textarea>
				</div>
			</p>
		</div>
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'Comment Link', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Link', 'catalyst' ); ?><input type="text" class="catalyst-universal-link-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-comment-link-color" name="catalyst[comment_link_color]" value="<?php catalyst_dynamik_options_defaults( true, 'comment_link_color' ); ?>" />
				<?php _e( 'Link Hover', 'catalyst' ); ?><input type="text" class="catalyst-universal-link-hover-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-comment-link-hover-color" name="catalyst[comment_link_hover_color]" value="<?php catalyst_dynamik_options_defaults( true, 'comment_link_hover_color' ); ?>" />
				<?php _e( 'Link Underline', 'catalyst' ); ?> <select class="catalyst-universal-link-underline-child" id="catalyst-comment-link-underline" name="catalyst[comment_link_underline]" size="1" style="width:90px;">
					<option value="Never"<?php if (catalyst_get_dynamik( 'comment_link_underline' ) == 'Never') echo ' selected="selected"'; ?>><?php _e( 'Never', 'catalyst' ); ?></option>
					<option value="On Hover"<?php if (catalyst_get_dynamik( 'comment_link_underline' ) == 'On Hover') echo ' selected="selected"'; ?>><?php _e( 'On Hover', 'catalyst' ); ?></option>
					<option value="Off Hover"<?php if (catalyst_get_dynamik( 'comment_link_underline' ) == 'Off Hover') echo ' selected="selected"'; ?>><?php _e( 'Off Hover', 'catalyst' ); ?></option>
					<option value="Always"<?php if (catalyst_get_dynamik( 'comment_link_underline' ) == 'Always') echo ' selected="selected"'; ?>><?php _e( 'Always', 'catalyst' ); ?></option>
				</select>
				<input type="checkbox" class="universal-check" id="catalyst-comment-link-universal" name="catalyst[comment_link_u]" value="u" <?php if( checked( 'u', catalyst_get_dynamik( 'comment_link_u' ) ) ); ?> /> <?php _e( '(U)', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'Submit Button Font', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select class="catalyst-universal-font-type-child catalyst-universal-content-font-type-child" id="catalyst-comment-submit-font-type" name="catalyst[font_type][comment_submit]" size="1" style="width:98px;">
				<?php catalyst_build_font_menu( $dynamik_font_type['comment_submit'] ); ?></select>
				<input type="text" id="catalyst-comment-submit-font-size" name="catalyst[comment_submit_font_size]" value="<?php catalyst_dynamik_options_defaults( true, 'comment_submit_font_size' ); ?>" style="width:40px;" />
				<select class="catalyst-universal-px-em-child catalyst-universal-content-px-em-child" id="catalyst-comment-submit-px-em" name="catalyst[comment_submit_px_em]" size="1" style="width:50px;">
					<option value="px"<?php echo ( catalyst_get_dynamik( 'comment_submit_px_em' ) == 'px' ) ? ' selected="selected"' : ''; ?>>px</option>
					<option value="em"<?php echo ( catalyst_get_dynamik( 'comment_submit_px_em' ) == 'em' ) ? ' selected="selected"' : ''; ?>>em</option>
				</select>
				<?php _e( 'Color', 'catalyst' ); ?><input type="text" class="catalyst-universal-font-color-child catalyst-universal-content-font-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-comment-submit-font-color" name="catalyst[comment_submit_font_color]" value="<?php catalyst_dynamik_options_defaults( true, 'comment_submit_font_color' ); ?>" />
				<input type="checkbox" class="universal-check" id="catalyst-comment-submit-font-universal" name="catalyst[comment_submit_font_u]" value="u" <?php if( checked( 'u', catalyst_get_dynamik( 'comment_submit_font_u' ) ) ); ?> /> <?php _e( '(U)', 'catalyst' ); ?>
				<span class="catalyst-custom-fonts-button-wrap"><span id="show-comment-submit-font-css" class="catalyst-custom-fonts-button">#Custom</span></span>
				<div style="display:none;" id="show-comment-submit-font-css-box" class="catalyst-custom-fonts-box">
				<?php _e( 'Submit Button Font Custom CSS | <code>#commentform #submit { }</code>', 'catalyst' ); ?><br />
				<textarea class="catalyst-universal-font-css-child catalyst-universal-content-font-css-child" id="catalyst-comment-submit-font-css" name="catalyst[comment_submit_font_css]" style="width:100%;" rows="10"><?php echo catalyst_get_dynamik( 'comment_submit_font_css' ); ?></textarea>
				</div>
			</p>
		</div>
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'Submit Button Text Hover', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Text Hover', 'catalyst' ); ?><input type="text" class="catalyst-universal-link-hover-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-submit-text-hover-color" name="catalyst[submit_text_hover_color]" value="<?php catalyst_dynamik_options_defaults( true, 'submit_text_hover_color' ); ?>" />
				<?php _e( 'Text Hover Underline', 'catalyst' ); ?> <select class="catalyst-universal-link-underline-child" id="catalyst-submit-link-underline" name="catalyst[submit_text_hover_underline]" size="1" style="width:90px;">
					<option value="Never"<?php if (catalyst_get_dynamik( 'submit_text_hover_underline' ) == 'Never') echo ' selected="selected"'; ?>><?php _e( 'Never', 'catalyst' ); ?></option>
					<option value="On Hover"<?php if (catalyst_get_dynamik( 'submit_text_hover_underline' ) == 'On Hover') echo ' selected="selected"'; ?>><?php _e( 'On Hover', 'catalyst' ); ?></option>
					<option value="Off Hover"<?php if (catalyst_get_dynamik( 'submit_text_hover_underline' ) == 'Off Hover') echo ' selected="selected"'; ?>><?php _e( 'Off Hover', 'catalyst' ); ?></option>
					<option value="Always"<?php if (catalyst_get_dynamik( 'submit_text_hover_underline' ) == 'Always') echo ' selected="selected"'; ?>><?php _e( 'Always', 'catalyst' ); ?></option>
				</select>
				<input type="checkbox" class="universal-check" id="catalyst-submit-link-universal" name="catalyst[submit_link_u]" value="u" <?php if( checked( 'u', catalyst_get_dynamik( 'submit_link_u' ) ) ); ?> /> <?php _e( '(U)', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="catalyst-bg-option-desc">
			<p><?php _e( 'Comment Wrap Background', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select id="catalyst-comment-wrap-bg-type" class="catalyst-bg-type" name="catalyst[comment_wrap_bg_type]" size="1" style="width:150px;">
				<?php catalyst_list_bg_options( catalyst_get_dynamik( 'comment_wrap_bg_type' ) ); ?>
				</select> <span style="display:none;" id="catalyst-comment-wrap-bg-type-checkbox"><?php _e( '(No Color', 'catalyst' ); ?> <input type="checkbox" id="catalyst-comment-wrap-bg-no-color" name="catalyst[comment_wrap_bg_no_color]" value="1" <?php if( checked( 1, catalyst_get_dynamik( 'comment_wrap_bg_no_color' ) ) ); ?> />)</span><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-comment-wrap-bg-color" name="catalyst[comment_wrap_bg_color]" value="<?php catalyst_dynamik_options_defaults( true, 'comment_wrap_bg_color' ); ?>" />
				<?php _e( 'Image', 'catalyst' ); ?> <select id="catalyst-comment-wrap-bg-image" name="catalyst[comment_wrap_bg_image]" size="1" style="width:150px;"><?php catalyst_list_images( catalyst_get_dynamik( 'comment_wrap_bg_image' ) ); ?></select>
			</p>
		</div>
		
		<div class="catalyst-bg-option-desc">
			<p><?php _e( 'Comment Even Background', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select id="catalyst-comment-even-bg-type" class="catalyst-bg-type" name="catalyst[comment_even_bg_type]" size="1" style="width:150px;">
				<?php catalyst_list_bg_options( catalyst_get_dynamik( 'comment_even_bg_type' ) ); ?>
				</select> <span style="display:none;" id="catalyst-comment-even-bg-type-checkbox"><?php _e( '(No Color', 'catalyst' ); ?> <input type="checkbox" id="catalyst-comment-even-bg-no-color" name="catalyst[comment_even_bg_no_color]" value="1" <?php if( checked( 1, catalyst_get_dynamik( 'comment_even_bg_no_color' ) ) ); ?> />)</span><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-comment-even-bg-color" name="catalyst[comment_even_bg_color]" value="<?php catalyst_dynamik_options_defaults( true, 'comment_even_bg_color' ); ?>" />
				<?php _e( 'Image', 'catalyst' ); ?> <select id="catalyst-comment-even-bg-image" name="catalyst[comment_even_bg_image]" size="1" style="width:150px;"><?php catalyst_list_images( catalyst_get_dynamik( 'comment_even_bg_image' ) ); ?></select>
			</p>
		</div>
		
		<div class="catalyst-bg-option-desc">
			<p><?php _e( 'Comment Odd Background', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select id="catalyst-comment-odd-bg-type" class="catalyst-bg-type" name="catalyst[comment_odd_bg_type]" size="1" style="width:150px;">
				<?php catalyst_list_bg_options( catalyst_get_dynamik( 'comment_odd_bg_type' ) ); ?>
				</select> <span style="display:none;" id="catalyst-comment-odd-bg-type-checkbox"><?php _e( '(No Color', 'catalyst' ); ?> <input type="checkbox" id="catalyst-comment-odd-bg-no-color" name="catalyst[comment_odd_bg_no_color]" value="1" <?php if( checked( 1, catalyst_get_dynamik( 'comment_odd_bg_no_color' ) ) ); ?> />)</span><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-comment-odd-bg-color" name="catalyst[comment_odd_bg_color]" value="<?php catalyst_dynamik_options_defaults( true, 'comment_odd_bg_color' ); ?>" />
				<?php _e( 'Image', 'catalyst' ); ?> <select id="catalyst-comment-odd-bg-image" name="catalyst[comment_odd_bg_image]" size="1" style="width:150px;"><?php catalyst_list_images( catalyst_get_dynamik( 'comment_odd_bg_image' ) ); ?></select>
			</p>
		</div>
		
		<div class="catalyst-bg-option-desc">
			<p><?php _e( 'Comment Reply Background', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select id="catalyst-comment-reply-bg-type" class="catalyst-bg-type" name="catalyst[comment_reply_bg_type]" size="1" style="width:150px;">
				<?php catalyst_list_bg_options( catalyst_get_dynamik( 'comment_reply_bg_type' ) ); ?>
				</select> <span style="display:none;" id="catalyst-comment-reply-bg-type-checkbox"><?php _e( '(No Color', 'catalyst' ); ?> <input type="checkbox" id="catalyst-comment-reply-bg-no-color" name="catalyst[comment_reply_bg_no_color]" value="1" <?php if( checked( 1, catalyst_get_dynamik( 'comment_reply_bg_no_color' ) ) ); ?> />)</span><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-comment-reply-bg-color" name="catalyst[comment_reply_bg_color]" value="<?php catalyst_dynamik_options_defaults( true, 'comment_reply_bg_color' ); ?>" />
				<?php _e( 'Image', 'catalyst' ); ?> <select id="catalyst-comment-reply-bg-image" name="catalyst[comment_reply_bg_image]" size="1" style="width:150px;"><?php catalyst_list_images( catalyst_get_dynamik( 'comment_reply_bg_image' ) ); ?></select>
			</p>
		</div>
		
		<div class="catalyst-bg-option-desc">
			<p><?php _e( 'Comment Avatar Background', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select id="catalyst-comment-avatar-bg-type" class="catalyst-bg-type" name="catalyst[comment_avatar_bg_type]" size="1" style="width:150px;">
				<?php catalyst_list_bg_options( catalyst_get_dynamik( 'comment_avatar_bg_type' ) ); ?>
				</select> <span style="display:none;" id="catalyst-comment-avatar-bg-type-checkbox"><?php _e( '(No Color', 'catalyst' ); ?> <input type="checkbox" id="catalyst-comment-avatar-bg-no-color" name="catalyst[comment_avatar_bg_no_color]" value="1" <?php if( checked( 1, catalyst_get_dynamik( 'comment_avatar_bg_no_color' ) ) ); ?> />)</span><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-comment-avatar-bg-color" name="catalyst[comment_avatar_bg_color]" value="<?php catalyst_dynamik_options_defaults( true, 'comment_avatar_bg_color' ); ?>" />
				<?php _e( 'Image', 'catalyst' ); ?> <select id="catalyst-comment-avatar-bg-image" name="catalyst[comment_avatar_bg_image]" size="1" style="width:150px;"><?php catalyst_list_images( catalyst_get_dynamik( 'comment_avatar_bg_image' ) ); ?></select>
			</p>
		</div>
		
		<div class="catalyst-bg-option-desc">
			<p><?php _e( 'Comment Form Background', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select id="catalyst-comment-form-bg-type" class="catalyst-bg-type" name="catalyst[comment_form_bg_type]" size="1" style="width:150px;">
				<?php catalyst_list_bg_options( catalyst_get_dynamik( 'comment_form_bg_type' ) ); ?>
				</select> <span style="display:none;" id="catalyst-comment-form-bg-type-checkbox"><?php _e( '(No Color', 'catalyst' ); ?> <input type="checkbox" id="catalyst-comment-form-bg-no-color" name="catalyst[comment_form_bg_no_color]" value="1" <?php if( checked( 1, catalyst_get_dynamik( 'comment_form_bg_no_color' ) ) ); ?> />)</span><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-comment-form-bg-color" name="catalyst[comment_form_bg_color]" value="<?php catalyst_dynamik_options_defaults( true, 'comment_form_bg_color' ); ?>" />
				<?php _e( 'Image', 'catalyst' ); ?> <select id="catalyst-comment-form-bg-image" name="catalyst[comment_form_bg_image]" size="1" style="width:150px;"><?php catalyst_list_images( catalyst_get_dynamik( 'comment_form_bg_image' ) ); ?></select>
			</p>
		</div>
		
		<div class="catalyst-bg-option-desc">
			<p><?php _e( 'Submit Button Background', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select id="catalyst-comment-submit-bg-type" class="catalyst-bg-type" name="catalyst[comment_submit_bg_type]" size="1" style="width:150px;">
				<?php catalyst_list_bg_options( catalyst_get_dynamik( 'comment_submit_bg_type' ) ); ?>
				</select> <span style="display:none;" id="catalyst-comment-submit-bg-type-checkbox"><?php _e( '(No Color', 'catalyst' ); ?> <input type="checkbox" id="catalyst-comment-submit-bg-no-color" name="catalyst[comment_submit_bg_no_color]" value="1" <?php if( checked( 1, catalyst_get_dynamik( 'comment_submit_bg_no_color' ) ) ); ?> />)</span><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-comment-submit-bg-color" name="catalyst[comment_submit_bg_color]" value="<?php catalyst_dynamik_options_defaults( true, 'comment_submit_bg_color' ); ?>" />
				<?php _e( 'Image', 'catalyst' ); ?> <select id="catalyst-comment-submit-bg-image" name="catalyst[comment_submit_bg_image]" size="1" style="width:150px;"><?php catalyst_list_images( catalyst_get_dynamik( 'comment_submit_bg_image' ) ); ?></select>
			</p>
		</div>
		
		<div class="catalyst-bg-option-desc">
			<p><?php _e( 'Submit Button Hover Background', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select id="catalyst-comment-submit-hover-bg-type" class="catalyst-bg-type" name="catalyst[comment_submit_hover_bg_type]" size="1" style="width:150px;">
				<?php catalyst_list_bg_options( catalyst_get_dynamik( 'comment_submit_hover_bg_type' ) ); ?>
				</select> <span style="display:none;" id="catalyst-comment-submit-hover-bg-type-checkbox"><?php _e( '(No Color', 'catalyst' ); ?> <input type="checkbox" id="catalyst-comment-submit-hover-bg-no-color" name="catalyst[comment_submit_hover_bg_no_color]" value="1" <?php if( checked( 1, catalyst_get_dynamik( 'comment_submit_hover_bg_no_color' ) ) ); ?> />)</span><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-comment-submit-hover-bg-color" name="catalyst[comment_submit_hover_bg_color]" value="<?php catalyst_dynamik_options_defaults( true, 'comment_submit_hover_bg_color' ); ?>" />
				<?php _e( 'Image', 'catalyst' ); ?> <select id="catalyst-comment-submit-hover-bg-image" name="catalyst[comment_submit_hover_bg_image]" size="1" style="width:150px;"><?php catalyst_list_images( catalyst_get_dynamik( 'comment_submit_hover_bg_image' ) ); ?></select>
			</p>
		</div>
		
		<div class="catalyst-border-option-desc">
			<p><?php _e( 'Comment Wrap Border', 'catalyst' ); ?></p>
		</div>

		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Thickness', 'catalyst' ); ?>
				<input type="text" id="catalyst-comment-wrap-border-thickness" name="catalyst[comment_wrap_border_thickness]" value="<?php catalyst_dynamik_options_defaults( true, 'comment_wrap_border_thickness' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Style', 'catalyst' ); ?> <select id="catalyst-comment-wrap-border-style" name="catalyst[comment_wrap_border_style]" size="1" style="width:80px; margin-right:5px;">
					<?php catalyst_list_borders( catalyst_get_dynamik( 'comment_wrap_border_style' ) ); ?>
				</select>
				<?php _e( 'Color', 'catalyst' ); ?> <input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-comment-wrap-border-color" name="catalyst[comment_wrap_border_color]" value="<?php catalyst_dynamik_options_defaults( true, 'comment_wrap_border_color' ); ?>" />
			</p>
		</div>
		
		<div class="catalyst-border-option-desc">
			<p><?php _e( 'Comment Body Border', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select id="catalyst-comment-body-border-type" name="catalyst[comment_body_border_type]" size="1" style="width:98px;">
					<option value="Full"<?php if (catalyst_get_dynamik( 'comment_body_border_type' ) == 'Full') echo ' selected="selected"'; ?>><?php _e( 'Full', 'catalyst' ); ?></option>
					<option value="Top/Bottom"<?php if (catalyst_get_dynamik( 'comment_body_border_type' ) == 'Top/Bottom') echo ' selected="selected"'; ?>><?php _e( 'Top/Bottom', 'catalyst' ); ?></option>
				</select>
				<?php _e( 'Thickness', 'catalyst' ); ?>
				<input type="text" id="catalyst-comment-body-border-thickness" name="catalyst[comment_body_border_thickness]" value="<?php catalyst_dynamik_options_defaults( true, 'comment_body_border_thickness' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Style', 'catalyst' ); ?> <select id="catalyst-comment-body-border-style" name="catalyst[comment_body_border_style]" size="1" style="width:80px; margin-right:5px;">
					<?php catalyst_list_borders( catalyst_get_dynamik( 'comment_body_border_style' ) ); ?>
				</select>
				<?php _e( 'Color', 'catalyst' ); ?> <input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-comment-body-border-color" name="catalyst[comment_body_border_color]" value="<?php catalyst_dynamik_options_defaults( true, 'comment_body_border_color' ); ?>" />
			</p>
		</div>
		
		<div class="catalyst-border-option-desc">
			<p><?php _e( 'Comment Avatar Border', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Thickness', 'catalyst' ); ?>
				<input type="text" id="catalyst-comment-avatar-border-thickness" name="catalyst[comment_avatar_border_thickness]" value="<?php catalyst_dynamik_options_defaults( true, 'comment_avatar_border_thickness' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Style', 'catalyst' ); ?> <select id="catalyst-comment-avatar-border-style" name="catalyst[comment_avatar_border_style]" size="1" style="width:80px; margin-right:5px;">
					<?php catalyst_list_borders( catalyst_get_dynamik( 'comment_avatar_border_style' ) ); ?>
				</select>
				<?php _e( 'Color', 'catalyst' ); ?> <input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-comment-avatar-border-color" name="catalyst[comment_avatar_border_color]" value="<?php catalyst_dynamik_options_defaults( true, 'comment_avatar_border_color' ); ?>" />
				<span class="dynamik-design-standard-hide">
				<?php _e( 'Padding', 'catalyst' ); ?>
				<input type="text" id="catalyst-comment-avatar-padding" name="catalyst[comment_avatar_padding]" value="<?php catalyst_dynamik_options_defaults( true, 'comment_avatar_padding' ); ?>" style="width:25px;" /><?php _e( 'px', 'catalyst' ); ?>
				</span><!-- End .dynamik-design-standard-hide -->
			</p>
		</div>
		
		<div class="catalyst-border-option-desc">
			<p><?php _e( 'Comment Form Border', 'catalyst' ); ?></p>
		</div>

		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Thickness', 'catalyst' ); ?>
				<input type="text" id="catalyst-comment-form-border-thickness" name="catalyst[comment_form_border_thickness]" value="<?php catalyst_dynamik_options_defaults( true, 'comment_form_border_thickness' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Style', 'catalyst' ); ?> <select id="catalyst-comment-form-border-style" name="catalyst[comment_form_border_style]" size="1" style="width:80px; margin-right:5px;">
					<?php catalyst_list_borders( catalyst_get_dynamik( 'comment_form_border_style' ) ); ?>
				</select>
				<?php _e( 'Color', 'catalyst' ); ?> <input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-comment-form-border-color" name="catalyst[comment_form_border_color]" value="<?php catalyst_dynamik_options_defaults( true, 'comment_form_border_color' ); ?>" />
			</p>
		</div>
		
		<div class="catalyst-border-option-desc">
			<p><?php _e( 'Submit Button Border', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Thickness', 'catalyst' ); ?>
				<input type="text" id="catalyst-comment-submit-border-thickness" name="catalyst[comment_submit_border_thickness]" value="<?php catalyst_dynamik_options_defaults( true, 'comment_submit_border_thickness' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Style', 'catalyst' ); ?> <select id="catalyst-comment-submit-border-style" name="catalyst[comment_submit_border_style]" size="1" style="width:80px; margin-right:5px;">
					<?php catalyst_list_borders( catalyst_get_dynamik( 'comment_submit_border_style' ) ); ?>
				</select>
				<?php _e( 'Color', 'catalyst' ); ?> <input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-comment-submit-border-color" name="catalyst[comment_submit_border_color]" value="<?php catalyst_dynamik_options_defaults( true, 'comment_submit_border_color' ); ?>" />
			</p>
		</div>
		
		<div class="catalyst-border-option-desc">
			<p><?php _e( 'Submit Button Hover Border', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Thickness', 'catalyst' ); ?>
				<input type="text" id="catalyst-comment-submit-hover-border-thickness" name="catalyst[comment_submit_hover_border_thickness]" value="<?php catalyst_dynamik_options_defaults( true, 'comment_submit_hover_border_thickness' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Style', 'catalyst' ); ?> <select id="catalyst-comment-submit-hover-border-style" name="catalyst[comment_submit_hover_border_style]" size="1" style="width:80px; margin-right:5px;">
					<?php catalyst_list_borders( catalyst_get_dynamik( 'comment_submit_hover_border_style' ) ); ?>
				</select>
				<?php _e( 'Color', 'catalyst' ); ?> <input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-comment-submit-hover-border-color" name="catalyst[comment_submit_hover_border_color]" value="<?php catalyst_dynamik_options_defaults( true, 'comment_submit_hover_border_color' ); ?>" />
			</p>
		</div>
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Comment Widths', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p>
				<?php _e( 'Author/Email/Url Form Widths', 'catalyst' ); ?>
				<input type="text" id="catalyst-comment-author-email-url-width" name="catalyst[comment_author_email_url_width]" value="<?php catalyst_dynamik_options_defaults( true, 'comment_author_email_url_width' ); ?>" style="width:40px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Comment Avatar Size', 'catalyst' ); ?>
				<input type="text" id="catalyst-comment-avatar-size" name="catalyst[comment_avatar_size]" value="<?php catalyst_dynamik_options_defaults( true, 'comment_avatar_size' ); ?>" style="width:40px;" /><?php _e( 'px', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Comment Widths', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p>
				<?php _e( 'Comment Form Width', 'catalyst' ); ?>
				<input type="text" id="catalyst-comment-form-width" name="catalyst[comment_form_width]" value="<?php catalyst_dynamik_options_defaults( true, 'comment_form_width' ); ?>" style="width:40px;" /><?php _e( 'px (Blank = 100%) |', 'catalyst' ); ?>
				<?php _e( 'Submit Button Width', 'catalyst' ); ?>
				<input type="text" id="catalyst-comment-submit-width" name="catalyst[comment_submit_width]" value="<?php catalyst_dynamik_options_defaults( true, 'comment_submit_width' ); ?>" style="width:40px;" /><?php _e( 'px', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="dynamik-design-standard-hide">
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Comment Wrap Margins', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p>
				<?php _e( 'Top Margin', 'catalyst' ); ?>
				<input type="text" id="catalyst-comment-wrap-margin-top" name="catalyst[comment_wrap_margin_top]" value="<?php catalyst_dynamik_options_defaults( true, 'comment_wrap_margin_top' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Bottom Margin', 'catalyst' ); ?>
				<input type="text" id="catalyst-comment-wrap-margin-bottom" name="catalyst[comment_wrap_margin_bottom]" value="<?php catalyst_dynamik_options_defaults( true, 'comment_wrap_margin_bottom' ); ?>" style="width:35px;" /><?php _e( 'px', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Comment Wrap Padding', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p>
				<?php _e( 'Padding: Top', 'catalyst' ); ?>
				<input type="text" id="catalyst-comment-wrap-padding-top" name="catalyst[comment_wrap_padding_top]" value="<?php catalyst_dynamik_options_defaults( true, 'comment_wrap_padding_top' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Right', 'catalyst' ); ?>
				<input type="text" id="catalyst-comment-wrap-padding-right" name="catalyst[comment_wrap_padding_right]" value="<?php catalyst_dynamik_options_defaults( true, 'comment_wrap_padding_right' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Bottom', 'catalyst' ); ?>
				<input type="text" id="catalyst-comment-wrap-padding-bottom" name="catalyst[comment_wrap_padding_bottom]" value="<?php catalyst_dynamik_options_defaults( true, 'comment_wrap_padding_bottom' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Left', 'catalyst' ); ?>
				<input type="text" id="catalyst-comment-wrap-padding-left" name="catalyst[comment_wrap_padding_left]" value="<?php catalyst_dynamik_options_defaults( true, 'comment_wrap_padding_left' ); ?>" style="width:35px;" /><?php _e( 'px', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Comment List Margins', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p>
				<?php _e( 'Top Margin', 'catalyst' ); ?>
				<input type="text" id="catalyst-comment-list-margin-top" name="catalyst[comment_list_margin_top]" value="<?php catalyst_dynamik_options_defaults( true, 'comment_list_margin_top' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Bottom Margin', 'catalyst' ); ?>
				<input type="text" id="catalyst-comment-list-margin-bottom" name="catalyst[comment_list_margin_bottom]" value="<?php catalyst_dynamik_options_defaults( true, 'comment_list_margin_bottom' ); ?>" style="width:35px;" /><?php _e( 'px', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Comment List Padding', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p>
				<?php _e( 'Padding: Top', 'catalyst' ); ?>
				<input type="text" id="catalyst-comment-list-padding-top" name="catalyst[comment_list_padding_top]" value="<?php catalyst_dynamik_options_defaults( true, 'comment_list_padding_top' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Right', 'catalyst' ); ?>
				<input type="text" id="catalyst-comment-list-padding-right" name="catalyst[comment_list_padding_right]" value="<?php catalyst_dynamik_options_defaults( true, 'comment_list_padding_right' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Bottom', 'catalyst' ); ?>
				<input type="text" id="catalyst-comment-list-padding-bottom" name="catalyst[comment_list_padding_bottom]" value="<?php catalyst_dynamik_options_defaults( true, 'comment_list_padding_bottom' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Left', 'catalyst' ); ?>
				<input type="text" id="catalyst-comment-list-padding-left" name="catalyst[comment_list_padding_left]" value="<?php catalyst_dynamik_options_defaults( true, 'comment_list_padding_left' ); ?>" style="width:35px;" /><?php _e( 'px', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Submit Button Padding', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p>
				<?php _e( 'Padding: Top', 'catalyst' ); ?>
				<input type="text" id="catalyst-submit-button-padding-top" name="catalyst[submit_button_padding_top]" value="<?php catalyst_dynamik_options_defaults( true, 'submit_button_padding_top' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Right', 'catalyst' ); ?>
				<input type="text" id="catalyst-submit-button-padding-right" name="catalyst[submit_button_padding_right]" value="<?php catalyst_dynamik_options_defaults( true, 'submit_button_padding_right' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Bottom', 'catalyst' ); ?>
				<input type="text" id="catalyst-submit-button-padding-bottom" name="catalyst[submit_button_padding_bottom]" value="<?php catalyst_dynamik_options_defaults( true, 'submit_button_padding_bottom' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Left', 'catalyst' ); ?>
				<input type="text" id="catalyst-submit-button-padding-left" name="catalyst[submit_button_padding_left]" value="<?php catalyst_dynamik_options_defaults( true, 'submit_button_padding_left' ); ?>" style="width:35px;" /><?php _e( 'px', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Comment\'s Bottom Nav Margins', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p>
				<?php _e( 'Top Margin', 'catalyst' ); ?>
				<input type="text" id="catalyst-comments-nav-margin-top" name="catalyst[comments_nav_margin_top]" value="<?php catalyst_dynamik_options_defaults( true, 'comments_nav_margin_top' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Bottom Margin', 'catalyst' ); ?>
				<input type="text" id="catalyst-comments-nav-margin-bottom" name="catalyst[comments_nav_margin_bottom]" value="<?php catalyst_dynamik_options_defaults( true, 'comments_nav_margin_bottom' ); ?>" style="width:35px;" /><?php _e( 'px', 'catalyst' ); ?>
			</p>
		</div>
		
		</div><!-- End .dynamik-design-standard-hide -->
		
	</div>
</div>