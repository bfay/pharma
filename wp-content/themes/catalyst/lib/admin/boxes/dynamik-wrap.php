<?php
/**
 * Builds the Dynamik Wrap admin content.
 *
 * @package Catalyst
 */
?>

<div id="catalyst-dynamik-options-nav-wrap-box" class="catalyst-optionbox-outer-1col catalyst-all-options">
	<div class="catalyst-optionbox-inner-1col">
		<h3><?php _e( 'Wrap', 'catalyst' ); ?></h3>
		
		<div class="catalyst-bg-option-desc">
			<p><?php _e( 'Wrap Background', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select id="catalyst-wrap-bg-type" class="catalyst-bg-type" name="catalyst[wrap_bg_type]" size="1" style="width:150px;">
				<?php catalyst_list_bg_options( catalyst_get_dynamik( 'wrap_bg_type' ) ); ?>
				</select> <span style="display:none;" id="catalyst-wrap-bg-type-checkbox"><?php _e( '(No Color', 'catalyst' ); ?> <input type="checkbox" id="catalyst-wrap-bg-no-color" name="catalyst[wrap_bg_no_color]" value="1" <?php if( checked( 1, catalyst_get_dynamik( 'wrap_bg_no_color' ) ) ); ?> />)</span><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-wrap-bg-color" name="catalyst[wrap_bg_color]" value="<?php catalyst_dynamik_options_defaults( true, 'wrap_bg_color' ); ?>" />
				<?php _e( 'Image', 'catalyst' ); ?> <select id="catalyst-wrap-bg-image" name="catalyst[wrap_bg_image]" size="1" style="width:150px;"><?php catalyst_list_images( catalyst_get_dynamik( 'wrap_bg_image' ) ); ?></select>
			</p>
		</div>
		
		<div class="catalyst-bg-option-desc">
			<p><?php _e( 'Container Wrap Background', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select id="catalyst-container-wrap-bg-type" class="catalyst-bg-type" name="catalyst[container_wrap_bg_type]" size="1" style="width:150px;">
				<?php catalyst_list_bg_options( catalyst_get_dynamik( 'container_wrap_bg_type' ) ); ?>
				</select> <span style="display:none;" id="catalyst-container-wrap-bg-type-checkbox"><?php _e( '(No Color', 'catalyst' ); ?> <input type="checkbox" id="catalyst-container-wrap-bg-no-color" name="catalyst[container_wrap_bg_no_color]" value="1" <?php if( checked( 1, catalyst_get_dynamik( 'container_wrap_bg_no_color' ) ) ); ?> />)</span><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-container-wrap-bg-color" name="catalyst[container_wrap_bg_color]" value="<?php catalyst_dynamik_options_defaults( true, 'container_wrap_bg_color' ); ?>" />
				<?php _e( 'Image', 'catalyst' ); ?> <select id="catalyst-container-wrap-bg-image" name="catalyst[container_wrap_bg_image]" size="1" style="width:150px;"><?php catalyst_list_images( catalyst_get_dynamik( 'container_wrap_bg_image' ) ); ?></select>
			</p>
		</div>
		
		<div class="catalyst-border-option-desc">
			<p><?php _e( 'Wrap Border', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select id="catalyst-wrap-border-type" name="catalyst[wrap_border_type]" size="1" style="width:100px;">
					<option value="Full"<?php if (catalyst_get_dynamik( 'wrap_border_type' ) == 'Full') echo ' selected="selected"'; ?>><?php _e( 'Full', 'catalyst' ); ?></option>
					<option value="Top/Bottom"<?php if (catalyst_get_dynamik( 'wrap_border_type' ) == 'Top/Bottom') echo ' selected="selected"'; ?>><?php _e( 'Top/Bottom', 'catalyst' ); ?></option>
					<option value="Left/Right"<?php if (catalyst_get_dynamik( 'wrap_border_type' ) == 'Left/Right') echo ' selected="selected"'; ?>><?php _e( 'Left/Right', 'catalyst' ); ?></option>
				</select>
				<?php _e( 'Thickness', 'catalyst' ); ?> <input type="text" id="catalyst-wrap-border-thickness" name="catalyst[wrap_border_thickness]" value="<?php catalyst_dynamik_options_defaults( true, 'wrap_border_thickness' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Style', 'catalyst' ); ?> <select id="catalyst-wrap-border-style" name="catalyst[wrap_border_style]" size="1" style="width:90px; margin-right:5px;">
					<?php catalyst_list_borders( catalyst_get_dynamik( 'wrap_border_style' ) ); ?>
				</select><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-wrap-border-color" name="catalyst[wrap_border_color]" value="<?php catalyst_dynamik_options_defaults( true, 'wrap_border_color' ); ?>" />
			</p>
		</div>
		
		<div class="catalyst-border-option-desc">
			<p><?php _e( 'Wrap Box Shadow', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Enable Box Shadow', 'catalyst' ); ?> <input type="checkbox" id="catalyst-wrap-shadow-active" name="catalyst[wrap_shadow_active]" value="1" <?php if( checked( 1, catalyst_get_dynamik( 'wrap_shadow_active' ) ) ); ?> />
				<?php _e( 'Style', 'catalyst' ); ?> <input type="text" id="catalyst-wrap-shadow-style" name="catalyst[wrap_shadow_style]" value="<?php catalyst_dynamik_options_defaults( true, 'wrap_shadow_style' ); ?>" style="width:220px;" />
				<span id="wrap-border-shadow-radius" class="tooltip-mark tooltip-center-left">[?]</span>
			</p>
			
			<div class="tooltip tooltip-500">
				<h5><?php _e( 'Adding Style To Your Wrap Border', 'catalyst' ); ?></h5>
				
				<p>
					<?php _e( 'Box Shadow and Border Radius are two Styles that can be tweaked to add more depth and refinement to your Wrap border. Just keep in mind that only CSS3 compatible web browsers will render these styles (eg. Firefox, Chrome, Safari, Opera and Internet Explorer 9).', 'catalyst' ); ?>
				</p>
				
				<h5><?php _e( 'On/Off & Style:', 'catalyst' ); ?></h5>
				
				<p>
					<?php _e( 'You can easily turn these styles On or Off with the checkbox options. If you want to tweak the actual styles you can do so by adjusting the default styles in the textareas provided.', 'catalyst' ); ?>
				</p>
				
				<span class="tooltip-credit">
					<?php _e( 'Read more about:', 'catalyst' ); ?>
					<a href="http://www.w3.org/TR/css3-background/#the-box-shadow" target="_blank"><?php _e( 'Box Shadow', 'catalyst' ); ?></a>
				</span>
				
				<span class="tooltip-credit" style="float:right;">
					<?php _e( 'Read more about:', 'catalyst' ); ?>
					<a href="http://www.w3.org/TR/css3-background/#the-border-radius" target="_blank"><?php _e( 'Border Radius', 'catalyst' ); ?></a>
				</span>
			</div>
		</div>
		
		<div class="catalyst-border-option-desc">
			<p><?php _e( 'Wrap Border Radius', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Enable Border Radius', 'catalyst' ); ?> <input type="checkbox" id="catalyst-wrap-radius-active" name="catalyst[wrap_radius_active]" value="1" <?php if( checked( 1, catalyst_get_dynamik( 'wrap_radius_active' ) ) ); ?> />
				<?php _e( 'Style', 'catalyst' ); ?> <input type="text" id="catalyst-wrap-radius-style" name="catalyst[wrap_radius_style]" value="<?php catalyst_dynamik_options_defaults( true, 'wrap_radius_style' ); ?>" style="width:210px;" />
			</p>
		</div>
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Wrap Margin', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Top Margin', 'catalyst' ); ?>
				<input type="text" id="catalyst-wrap-top-margin" name="catalyst[wrap_top_margin]" value="<?php catalyst_dynamik_options_defaults( true, 'wrap_top_margin' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Bottom Margin', 'catalyst' ); ?>
				<input type="text" id="catalyst-wrap-bottom-margin" name="catalyst[wrap_bottom_margin]" value="<?php catalyst_dynamik_options_defaults( true, 'wrap_bottom_margin' ); ?>" style="width:35px;" /><?php _e( 'px', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Wrap Padding', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Top/Bottom Padding', 'catalyst' ); ?>
				<input type="text" id="catalyst-wrap-tb-padding" name="catalyst[wrap_tb_padding]" value="<?php catalyst_dynamik_options_defaults( true, 'wrap_tb_padding' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Left/Right Padding', 'catalyst' ); ?>
				<input type="text" id="catalyst-wrap-lr-padding" name="catalyst[wrap_lr_padding]" value="<?php catalyst_dynamik_options_defaults( true, 'wrap_lr_padding' ); ?>" style="width:35px;" /><?php _e( 'px', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Container Wrap Padding', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Top/Bottom', 'catalyst' ); ?>
				<input type="text" id="catalyst-container-wrap-tb-padding" name="catalyst[container_wrap_tb_padding]" value="<?php catalyst_dynamik_options_defaults( true, 'container_wrap_tb_padding' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Left/Right', 'catalyst' ); ?>
				<input type="text" class="dynamik-width-option catalyst-widget-width-option" id="catalyst-container-wrap-lr-padding" name="catalyst[container_wrap_lr_padding]" value="<?php catalyst_dynamik_options_defaults( true, 'container_wrap_lr_padding' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Sidebar Separation', 'catalyst' ); ?>
				<input type="text" class="dynamik-width-option" id="catalyst-sb-separation-padding" name="catalyst[sb_separation_padding]" value="<?php catalyst_dynamik_options_defaults( true, 'sb_separation_padding' ); ?>" style="width:35px;" /><?php _e( 'px', 'catalyst' ); ?>
			</p>
		</div>
	</div>
	
	<div style="float:left; width:802px;">
		<div class="catalyst-optionbox-2col-left-wrap">
			<div class="catalyst-optionbox-outer-2col">
				<div class="catalyst-optionbox-inner-2col">
					<h4><?php _e( 'Wrap Preview', 'catalyst' ); ?> <span id="wrap-div-preview" class="tooltip-mark tooltip-center-right">[?]</span></h4>
					
					<div class="tooltip tooltip-500">
						<h5><?php _e( 'Effects Of Different Wrap Placements:', 'catalyst' ); ?></h5>
						<p>
							<?php _e( 'What this dynamically changing image does for you is provide a quick reference as to what the Wrap Div Placement options to the right will do based on their settings.', 'catalyst' ); ?>
						</p>
						
						<p>
							<?php _e( 'The horizontal strips of dark and medium gray represent both the Header and Footer hooks. As you can see, if a particular hook is inside the Wrap its width is fixed inside the Wrap width, but if outside the wrap it becomes fluid. So by moving these Wrap Divs you can control the way content is displayed when hooked into these hook locations.', 'catalyst' ); ?>
						</p>
					</div>
					
					<div id="catalyst-wrap-preview"><img id="catalyst-wrap-preview-img" src=""/></div>
				</div>
			</div>
		</div>
			
		<div class="catalyst-optionbox-2col-right-wrap">
			<div class="catalyst-optionbox-outer-2col">
				<div class="catalyst-optionbox-inner-2col">
					<h4><?php _e( '<code>#wrap</code> Open & Close Div Locations', 'catalyst' ); ?> <span id="wrap-div-placement" class="tooltip-mark tooltip-center-left">[?]</span></h4>

					<div class="tooltip tooltip-500">
						<h5><?php _e( 'Control The Location Of Your Wrap Divs:', 'catalyst' ); ?></h5>
						<p>
							<?php _e( 'Choose where to open and close the main site wrap in conjunction with the header and footer hook locations. One use of this option is to make your header, navbars and/or footer fluid, spanning the full width of the browser. To do so, just set the wrap location inside the catalyst-hook-header and/or catalyst-hook-footer.', 'catalyst' ); ?>
						</p>
						
						<p>
							<?php _e( 'Use the dynamically changing image on the left as a reference to help determine the best setup for your particular site.', 'catalyst' ); ?>
						</p>
					</div>
					
					<p style="width:190px; float:left; margin:0 0 10px 10px; line-height:170%;">
						<input type="radio" class="wrap-div-option wrap-opener" name="catalyst[wrap_open_placement]" value="wrap_open_before_before_header" <?php if( catalyst_get_dynamik( 'wrap_open_placement' ) == 'wrap_open_before_before_header' ) echo 'checked="checked" '; ?>/><input type="hidden" value="wobbh"><label><?php _e( 'Opening <code>#wrap</code>', 'catalyst' ); ?></label><br />
						<?php _e( '<code>catalyst_hook_before_header();</code>', 'catalyst' ); ?><br />
						<input type="radio" class="wrap-div-option wrap-opener" name="catalyst[wrap_open_placement]" value="wrap_open_after_before_header" <?php if( catalyst_get_dynamik( 'wrap_open_placement' ) == 'wrap_open_after_before_header' ) echo 'checked="checked" '; ?>/><input type="hidden" value="woabh"><label><?php _e( 'Opening <code>#wrap</code>', 'catalyst' ); ?></label><br />
						<?php _e( '<code>catalyst_hook_header();</code>', 'catalyst' ); ?><br />
						<input type="radio" class="wrap-div-option wrap-opener" name="catalyst[wrap_open_placement]" value="wrap_open_before_after_header" <?php if( catalyst_get_dynamik( 'wrap_open_placement' ) == 'wrap_open_before_after_header' ) echo 'checked="checked" '; ?>/><input type="hidden" value="wobah"><label><?php _e( 'Opening <code>#wrap</code>', 'catalyst' ); ?></label><br />
						<?php _e( '<code>catalyst_hook_after_header();</code>', 'catalyst' ); ?><br />
						<input type="radio" class="wrap-div-option wrap-opener" name="catalyst[wrap_open_placement]" value="wrap_open_after_after_header" <?php if( catalyst_get_dynamik( 'wrap_open_placement' ) == 'wrap_open_after_after_header' ) echo 'checked="checked" '; ?>/><input type="hidden" value="woaah"><label><?php _e( 'Opening <code>#wrap</code>', 'catalyst' ); ?></label><br />
					</p>


					<p style="width:190px; float:left; margin:0 0 10px; line-height:170%;">
						<input type="radio" class="wrap-div-option wrap-closer" name="catalyst[wrap_close_placement]" value="wrap_close_before_before_footer" <?php if( catalyst_get_dynamik( 'wrap_close_placement' ) == 'wrap_close_before_before_footer' ) echo 'checked="checked" '; ?>/><input type="hidden" value="wcbbf"><label><?php _e( 'Closing <code>#wrap</code>', 'catalyst' ); ?></label><br />
						<?php _e( '<code>catalyst_hook_before_footer();</code>', 'catalyst' ); ?><br />
						<input type="radio" class="wrap-div-option wrap-closer" name="catalyst[wrap_close_placement]" value="wrap_close_after_before_footer" <?php if( catalyst_get_dynamik( 'wrap_close_placement' ) == 'wrap_close_after_before_footer' ) echo 'checked="checked" '; ?>/><input type="hidden" value="wcabf"><label><?php _e( 'Closing <code>#wrap</code>', 'catalyst' ); ?></label><br />
						<?php _e( '<code>catalyst_hook_footer();</code>', 'catalyst' ); ?><br />
						<input type="radio" class="wrap-div-option wrap-closer" name="catalyst[wrap_close_placement]" value="wrap_close_before_after_footer" <?php if( catalyst_get_dynamik( 'wrap_close_placement' ) == 'wrap_close_before_after_footer' ) echo 'checked="checked" '; ?>/><input type="hidden" value="wcbaf"><label><?php _e( 'Closing <code>#wrap</code>', 'catalyst' ); ?></label><br />
						<?php _e( '<code>catalyst_hook_after_footer();</code>', 'catalyst' ); ?><br />
						<input type="radio" class="wrap-div-option wrap-closer" name="catalyst[wrap_close_placement]" value="wrap_close_after_after_footer" <?php if( catalyst_get_dynamik( 'wrap_close_placement' ) == 'wrap_close_after_after_footer' ) echo 'checked="checked" '; ?>/><input type="hidden" value="wcaaf"><label><?php _e( 'Closing <code>#wrap</code>', 'catalyst' ); ?></label>
					</p>
				</div>
			</div>
		</div>
	</div>
</div>