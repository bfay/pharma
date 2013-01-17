<?php
/**
 * Builds the Dynamik EZ admin content.
 *
 * @package Catalyst
 */
?>

<div id="catalyst-dynamik-options-nav-<?php echo $nav_alt_id; ?>ez-box" class="catalyst-optionbox-outer-1col catalyst-all-options">
	<div class="catalyst-optionbox-inner-1col">
		<h3><?php _e( 'Static Homepage EZ-Widget Areas', 'catalyst' ); ?> <span id="catalyst-ez-widget-areas-design-tooltip" class="tooltip-mark tooltip-bottom-center">[?]</span></h3>
		
		<div class="tooltip tooltip-500">
			<h5><?php _e( 'EZ Widget Area Layout Naming Convention', 'catalyst' ); ?></h5>
			<p>
				<?php _e( 'For any of the following EZ Widget Areas, you are provided with a drop-down menu to select the desired Layout. The Layouts are named according to the number of horizontal Widget Areas. So, for example, home_2_3_3 means that you are selecting one of the Static Homepage Layouts with 2 Horizontal Widget Areas at the Top, 3 in the Middle and 3 in the Bottom of the page.', 'catalyst' ); ?>
			</p>
			
			<h5><?php _e( 'Homepage EZ Widget Areas', 'catalyst' ); ?></h5>
			<p>
				<?php _e( 'WordPress Default Homepage = Either a list of blog posts or whatever you set as your "Static page" in Settings > Reading.', 'catalyst' ); ?>
			</p>
			
			<p>
				<?php _e( 'Static Homepage = The home.php file in the Dynamik Child Theme kicks in and allows you to display any one of the selected Static Homepage Layouts below.', 'catalyst' ); ?>
			</p>
			
			<p>
				<?php _e( 'Static Homepage Sidebar = A Home Sidebar Widget Area that only displays when the above Homepage Type is set to "Static Homepage".', 'catalyst' ); ?>
			</p>
			
			<p>
				<?php _e( 'Homepage Slider = A Home Slider Widget Area that, when set to "Activate", will display on the Homepage, regardless of whether or not you are using the Static Homepage feature.', 'catalyst' ); ?>
			</p>
			
			<h5><?php _e( 'Feature Top EZ Widget Areas', 'catalyst' ); ?></h5>
			<p>
				<?php _e( 'The Feature Top EZ Widget Areas are displayed just above your Content and Sidebars.', 'catalyst' ); ?>
			</p>
			
			<h5><?php _e( 'Fat Footer EZ Widget Areas', 'catalyst' ); ?></h5>
			<p>
				<?php _e( 'The Fat Footer Widget Areas are displayed just after your Content and Sidebars.', 'catalyst' ); ?>
			</p>
			
			<p>
				<?php _e( '<strong>NOTE:</strong> With the "Inside Footer" / "Outside Footer" option you are telling Catalyst to either display these Widget Areas Inside the actual Footer Div (hook into the catalyst_hook_in_footer hook) or display them Outside the Footer Div (hook into the catalyst_hook_after_container hook).', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Homepage Type', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p style="margin-top:4px;" class="bg-box-design">
				<input type="radio" name="catalyst[dynamik_homepage_type]" value="default_home" <?php if (catalyst_get_dynamik( 'dynamik_homepage_type' ) == 'default_home') echo 'checked="checked" '; ?>/><label> <?php _e( 'WordPress Default Homepage', 'catalyst' ); ?></label>
				<input type="radio" name="catalyst[dynamik_homepage_type]" value="static_home" <?php if (catalyst_get_dynamik( 'dynamik_homepage_type' ) == 'static_home') echo 'checked="checked" '; ?>/><label> <?php _e( 'Static Homepage', 'catalyst' ); ?></label>
			</p>
		</div>
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Static Homepage Structure', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Select A Static Homepage Layout', 'catalyst' ); ?> <select id="catalyst-ez-homepage-select" name="catalyst[ez_homepage_select]" size="1" style="width:250px;">
				<?php if( catalyst_get_dynamik( 'ez_homepage_select' ) ) { $ez_homepage_select_default = catalyst_get_dynamik( 'ez_homepage_select' ); } else { $ez_homepage_select_default = 'ez_home_3_3_3.php'; } ?>
				<option value="<?php echo $ez_homepage_select_default ?>"<?php if( $ez_homepage_select_default == $ez_homepage_select_default ) echo ' selected="selected"'; ?>><?php echo 'Selected: ' . $ez_homepage_select_default ?></option>
					<?php $alt_homepage_path = CATALYST_ROOT . '/lib/ez-structures/home/';

					if( is_dir( $alt_homepage_path ) ) {
						if( $alt_homepage_dir = opendir( $alt_homepage_path ) ) { 
							while( ( $alt_homepage_file = readdir( $alt_homepage_dir ) ) !== false ) {
								if( stristr( $alt_homepage_file, ".php" ) !== false) {
									$alt_homepage = $alt_homepage_file;
									?><option value="<?php echo $alt_homepage ?>"><?php echo $alt_homepage ?></option><?php
								}
							}    
						}
					} ?>
				</select> <span id="catalyst-ez-home-wa-reference-tooltip" class="tooltip-mark tooltip-center-left">[<?php _e( 'Examples', 'catalyst' ); ?>]</span>
			</p>
			
			<div class="tooltip tooltip-500">
				<h5><?php _e( 'EZ Static Home Layout Reference Examples:', 'catalyst' ); ?></h5>
				<p><img src="<?php echo get_template_directory_uri(); ?>/lib/css/images/tooltips/tooltip-home-wa-reference.png"/></p>
			</div>
		</div>
		
		<div class="dynamik-structure-settings-hide">
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'EZ Home Widget Heading Fonts', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select class="catalyst-universal-font-type-child catalyst-universal-heading-font-type-child" id="catalyst-ez-widget-home-title-font-type" name="catalyst[font_type][ez_widget_home_title]" size="1" style="width:98px;">
				<?php catalyst_build_font_menu( $dynamik_font_type['ez_widget_home_title'] ); ?></select>
				<input type="text" id="catalyst-ez-widget-home-title-font-size" name="catalyst[ez_widget_home_title_font_size]" value="<?php catalyst_dynamik_options_defaults( true, 'ez_widget_home_title_font_size' ); ?>" style="width:40px;" />
				<select class="catalyst-universal-px-em-child catalyst-universal-heading-px-em-child" id="catalyst-ez-widget-home-title-px-em" name="catalyst[ez_widget_home_title_px_em]" size="1" style="width:50px;">
					<option value="px"<?php echo ( catalyst_get_dynamik( 'ez_widget_home_title_px_em' ) == 'px' ) ? ' selected="selected"' : ''; ?>>px</option>
					<option value="em"<?php echo ( catalyst_get_dynamik( 'ez_widget_home_title_px_em' ) == 'em' ) ? ' selected="selected"' : ''; ?>>em</option>
				</select>
				<?php _e( 'Color', 'catalyst' ); ?><input type="text" class="catalyst-universal-font-color-child catalyst-universal-heading-font-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-ez-widget-home-title-font-color" name="catalyst[ez_widget_home_title_font_color]" value="<?php catalyst_dynamik_options_defaults( true, 'ez_widget_home_title_font_color' ); ?>" />
				<input type="checkbox" class="universal-check" id="catalyst-ez-widget-home-title-font-universal" name="catalyst[ez_widget_home_title_font_u]" value="u" <?php if( checked( 'u', catalyst_get_dynamik( 'ez_widget_home_title_font_u' ) ) ); ?> /> <?php _e( '(U)', 'catalyst' ); ?>
				<span class="catalyst-custom-fonts-button-wrap"><span id="show-ez-widget-home-title-font-css" class="catalyst-custom-fonts-button">#Custom</span></span>
				<div style="display:none;" id="show-ez-widget-home-title-font-css-box" class="catalyst-custom-fonts-box">
				<?php _e( 'EZ Home Heading Font Custom CSS | <code>#ez-home-container-wrap .ez-widget-area h4 { }</code>', 'catalyst' ); ?><br />
				<textarea class="catalyst-universal-font-css-child catalyst-universal-heading-font-css-child" id="catalyst-ez-widget-home-title-font-css" name="catalyst[ez_widget_home_title_font_css]" style="width:100%;" rows="10"><?php echo catalyst_get_dynamik( 'ez_widget_home_title_font_css' ); ?></textarea>
				</div>
			</p>
		</div>
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'EZ Home Widget Content Fonts', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select class="catalyst-universal-font-type-child catalyst-universal-content-font-type-child" id="catalyst-ez-widget-home-content-font-type" name="catalyst[font_type][ez_widget_home_content]" size="1" style="width:98px;">
				<?php catalyst_build_font_menu( $dynamik_font_type['ez_widget_home_content'] ); ?></select>
				<input type="text" id="catalyst-ez-widget-home-content-font-size" name="catalyst[ez_widget_home_content_font_size]" value="<?php catalyst_dynamik_options_defaults( true, 'ez_widget_home_content_font_size' ); ?>" style="width:40px;" />
				<select class="catalyst-universal-px-em-child catalyst-universal-content-px-em-child" id="catalyst-ez-widget-home-content-px-em" name="catalyst[ez_widget_home_content_px_em]" size="1" style="width:50px;">
					<option value="px"<?php echo ( catalyst_get_dynamik( 'ez_widget_home_content_px_em' ) == 'px' ) ? ' selected="selected"' : ''; ?>>px</option>
					<option value="em"<?php echo ( catalyst_get_dynamik( 'ez_widget_home_content_px_em' ) == 'em' ) ? ' selected="selected"' : ''; ?>>em</option>
				</select>
				<?php _e( 'Color', 'catalyst' ); ?><input type="text" class="catalyst-universal-font-color-child catalyst-universal-content-font-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-ez-widget-home-content-font-color" name="catalyst[ez_widget_home_content_font_color]" value="<?php catalyst_dynamik_options_defaults( true, 'ez_widget_home_content_font_color' ); ?>" />
				<input type="checkbox" class="universal-check" id="catalyst-ez-widget-home-content-font-universal" name="catalyst[ez_widget_home_content_font_u]" value="u" <?php if( checked( 'u', catalyst_get_dynamik( 'ez_widget_home_content_font_u' ) ) ); ?> /> <?php _e( '(U)', 'catalyst' ); ?>
				<span class="catalyst-custom-fonts-button-wrap"><span id="show-ez-widget-home-content-font-css" class="catalyst-custom-fonts-button">#Custom</span></span>
				<div style="display:none;" id="show-ez-widget-home-content-font-css-box" class="catalyst-custom-fonts-box">
				<?php _e( 'EZ Home Content Font Custom CSS | <code>#ez-home-container-wrap .ez-widget-area { }</code>', 'catalyst' ); ?><br />
				<textarea class="catalyst-universal-font-css-child catalyst-universal-content-font-css-child" id="catalyst-ez-widget-home-content-font-css" name="catalyst[ez_widget_home_content_font_css]" style="width:100%;" rows="10"><?php echo catalyst_get_dynamik( 'ez_widget_home_content_font_css' ); ?></textarea>
				</div>
			</p>
		</div>
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'EZ Home Widget Content Link', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Link', 'catalyst' ); ?><input type="text" class="catalyst-universal-link-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-ez-widget-home-content-link-color" name="catalyst[ez_widget_home_content_link_color]" value="<?php catalyst_dynamik_options_defaults( true, 'ez_widget_home_content_link_color' ); ?>" />
				<?php _e( 'Link Hover', 'catalyst' ); ?><input type="text" class="catalyst-universal-link-hover-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-ez-widget-home-content-link-hover-color" name="catalyst[ez_widget_home_content_link_hover_color]" value="<?php catalyst_dynamik_options_defaults( true, 'ez_widget_home_content_link_hover_color' ); ?>" />
				<?php _e( 'Link Underline', 'catalyst' ); ?> <select class="catalyst-universal-link-underline-child" id="catalyst-ez-widget-home-content-link-underline" name="catalyst[ez_widget_home_content_link_underline]" size="1" style="width:90px;">
					<option value="Never"<?php if (catalyst_get_dynamik( 'ez_widget_home_content_link_underline' ) == 'Never') echo ' selected="selected"'; ?>><?php _e( 'Never', 'catalyst' ); ?></option>
					<option value="On Hover"<?php if (catalyst_get_dynamik( 'ez_widget_home_content_link_underline' ) == 'On Hover') echo ' selected="selected"'; ?>><?php _e( 'On Hover', 'catalyst' ); ?></option>
					<option value="Off Hover"<?php if (catalyst_get_dynamik( 'ez_widget_home_content_link_underline' ) == 'Off Hover') echo ' selected="selected"'; ?>><?php _e( 'Off Hover', 'catalyst' ); ?></option>
					<option value="Always"<?php if (catalyst_get_dynamik( 'ez_widget_home_content_link_underline' ) == 'Always') echo ' selected="selected"'; ?>><?php _e( 'Always', 'catalyst' ); ?></option>
				</select>
				<input type="checkbox" class="universal-check" id="catalyst-ez-widget-home-content-link-universal" name="catalyst[ez_widget_home_content_link_u]" value="u" <?php if( checked( 'u', catalyst_get_dynamik( 'ez_widget_home_content_link_u' ) ) ); ?> /> <?php _e( '(U)', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="catalyst-bg-option-desc">
			<p><?php _e( 'EZ Home Background', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select id="catalyst-ez-widget-home-bg-type" class="catalyst-bg-type" name="catalyst[ez_widget_home_bg_type]" size="1" style="width:150px;">
				<?php catalyst_list_bg_options( catalyst_get_dynamik( 'ez_widget_home_bg_type' ) ); ?>
				</select> <span style="display:none;" id="catalyst-ez-widget-home-bg-type-checkbox"><?php _e( '(No Color', 'catalyst' ); ?> <input type="checkbox" id="catalyst-ez-widget-home-bg-no-color" name="catalyst[ez_widget_home_bg_no_color]" value="1" <?php if( checked( 1, catalyst_get_dynamik( 'ez_widget_home_bg_no_color' ) ) ); ?> />)</span><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-ez-widget-home-bg-color" name="catalyst[ez_widget_home_bg_color]" value="<?php catalyst_dynamik_options_defaults( true, 'ez_widget_home_bg_color' ); ?>" />
				<?php _e( 'Image', 'catalyst' ); ?> <select id="catalyst-ez-widget-home-bg-image" name="catalyst[ez_widget_home_bg_image]" size="1" style="width:150px;"><?php catalyst_list_images( catalyst_get_dynamik( 'ez_widget_home_bg_image' ) ); ?></select>
			</p>
		</div>
		
		<div class="catalyst-border-option-desc">
			<p><?php _e( 'EZ Home Heading Bottom Border', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Thickness', 'catalyst' ); ?>
				<input type="text" id="catalyst-ez-widget-home-heading-bottom-border-thickness" name="catalyst[ez_widget_home_heading_bottom_border_thickness]" value="<?php catalyst_dynamik_options_defaults( true, 'ez_widget_home_heading_bottom_border_thickness' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Style', 'catalyst' ); ?> <select id="catalyst-ez-widget-home-heading-bottom-border-style" name="catalyst[ez_widget_home_heading_bottom_border_style]" size="1" style="width:80px;">
					<?php catalyst_list_borders( catalyst_get_dynamik( 'ez_widget_home_heading_bottom_border_style' ) ); ?>
				</select>
				<?php _e( 'Color', 'catalyst' ); ?> <input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-ez-widget-home-heading-bottom-border-color" name="catalyst[ez_widget_home_heading_bottom_border_color]" value="<?php catalyst_dynamik_options_defaults( true, 'ez_widget_home_heading_bottom_border_color' ); ?>" />
			</p>
		</div>
		
		<div class="catalyst-border-option-desc">
			<p><?php _e( 'EZ Home Border', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select id="catalyst-ez-widget-home-border-type" name="catalyst[ez_widget_home_border_type]" size="1" style="width:100px;">
					<option value="Full"<?php if (catalyst_get_dynamik( 'ez_widget_home_border_type' ) == 'Full') echo ' selected="selected"'; ?>><?php _e( 'Full', 'catalyst' ); ?></option>
					<option value="Top/Bottom"<?php if (catalyst_get_dynamik( 'ez_widget_home_border_type' ) == 'Top/Bottom') echo ' selected="selected"'; ?>><?php _e( 'Top/Bottom', 'catalyst' ); ?></option>
					<option value="Left/Right"<?php if (catalyst_get_dynamik( 'ez_widget_home_border_type' ) == 'Left/Right') echo ' selected="selected"'; ?>><?php _e( 'Left/Right', 'catalyst' ); ?></option>
				</select>
				<?php _e( 'Thickness', 'catalyst' ); ?> <input type="text" id="catalyst-ez-widget-home-border-thickness" name="catalyst[ez_widget_home_border_thickness]" value="<?php catalyst_dynamik_options_defaults( true, 'ez_widget_home_border_thickness' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Style', 'catalyst' ); ?> <select id="catalyst-ez-widget-home-border-style" name="catalyst[ez_widget_home_border_style]" size="1" style="width:90px; margin-right:5px;">
					<?php catalyst_list_borders( catalyst_get_dynamik( 'ez_widget_home_border_style' ) ); ?>
				</select><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-ez-widget-home-border-color" name="catalyst[ez_widget_home_border_color]" value="<?php catalyst_dynamik_options_defaults( true, 'ez_widget_home_border_color' ); ?>" />
			</p>
		</div>
		
		<div class="dynamik-design-standard-hide">
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Static Homepage Wrap Padding', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p>
				<?php _e( 'Padding: Top', 'catalyst' ); ?>
				<input type="text" id="ez-widget-home-padding-top" name="catalyst[ez_widget_home_padding_top]" value="<?php catalyst_dynamik_options_defaults( true, 'ez_widget_home_padding_top' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Right', 'catalyst' ); ?>
				<input type="text" class="ez-widget-home-width-option" id="ez-widget-home-padding-right" name="catalyst[ez_widget_home_padding_right]" value="<?php catalyst_dynamik_options_defaults( true, 'ez_widget_home_padding_right' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Bottom', 'catalyst' ); ?>
				<input type="text" id="ez-widget-home-padding-bottom" name="catalyst[ez_widget_home_padding_bottom]" value="<?php catalyst_dynamik_options_defaults( true, 'ez_widget_home_padding_bottom' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Left', 'catalyst' ); ?>
				<input type="text" class="ez-widget-home-width-option" id="ez-widget-home-padding-left" name="catalyst[ez_widget_home_padding_left]" value="<?php catalyst_dynamik_options_defaults( true, 'ez_widget_home_padding_left' ); ?>" style="width:35px;" /><?php _e( 'px', 'catalyst' ); ?>
			</p>
		</div>
		
		</div><!-- End .dynamik-design-standard-hide -->
		
		</div><!-- End .dynamik-structure-settings-hide -->
		
		<h3 style="margin-top:15px; float:left;"><?php _e( 'Homepage EZ-Widget Area Extras', 'catalyst' ); ?></h3>
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Static Homepage Sidebar', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p style="margin-top:5px;" class="bg-box-design">
				<?php _e( 'Activate', 'catalyst' ); ?> <input type="checkbox" id="catalyst-ez-static-home-sb-display" name="catalyst[ez_static_home_sb_display]" value="1" <?php if( checked( 1, catalyst_get_dynamik( 'ez_static_home_sb_display' ) ) ); ?> /> |
				<?php _e( 'Display Location', 'catalyst' ); ?> <input type="radio" name="catalyst[ez_static_home_sb_location]" value="right" <?php if (catalyst_get_dynamik( 'ez_static_home_sb_location' ) == 'right') echo 'checked="checked" '; ?>/><label><?php _e( 'Right of Content', 'catalyst' ); ?></label>
				<input type="radio" name="catalyst[ez_static_home_sb_location]" value="left" <?php if (catalyst_get_dynamik( 'ez_static_home_sb_location' ) == 'left') echo 'checked="checked" '; ?>/><label><?php _e( 'Left of Content', 'catalyst' ); ?></label>
			</p>
		</div>
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Homepage Slider', 'catalyst' ); ?> <span id="catalyst-home-slider-tooltip" class="tooltip-mark tooltip-center-right">[?]</span></p>
			
			<div class="tooltip tooltip-500">
				<h5><?php _e( 'How To Use The Home Slider:', 'catalyst' ); ?></h5>
				<p><?php _e( 'The Home Slider is really just another Widget Area, but styled in such a way that makes it an ideal location for an Image Slider. By default the Home Slider is coded to work with the WP-Cycle Image Slider Plugin. We chose this Pluin for its ease of use and reliability.', 'catalyst' ); ?></p>
				<p style="margin-top:-10px;"><?php _e( 'Note, however, that this does not mean you have to use the WP-Cycle Plugin. You can use any WordPress Slider Plugin you like, adding it by way of "Text" or "PHP Text" Widget in Appearance > Widgets.', 'catalyst' ); ?></p>
				<span class="tooltip-credit">
					<?php _e( 'If you would like to use the WP-Cycle Plugin you can either search for it in the Plugins > "Add New" section or you can download it from WordPress.org here:', 'catalyst' ); ?>
					<a href="http://wordpress.org/extend/plugins/wp-cycle/" target="_blank">WP-Cycle Plugin</a>
				</span>
				<span class="tooltip-credit" style="margin-top:10px;">
					<?php _e( 'Note that all Catalyst Personal and Developer Edition members have access to the Nivo Premium Slider Plugin which offers more features and greater flexibility than WP-Cycle. Find out more here:', 'catalyst' ); ?>
					<a href="http://marketplace.catalysttheme.com/plugins/nivo-slider/" target="_blank">Nivo Slider Plugin</a>
				</span>
			</div>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Activate', 'catalyst' ); ?> <input type="checkbox" id="catalyst-ez-home-slider-display" name="catalyst[ez_home_slider_display]" value="1" <?php if( checked( 1, catalyst_get_dynamik( 'ez_home_slider_display' ) ) ); ?> /> |
				<?php _e( 'Display Location', 'catalyst' ); ?> <input type="radio" name="catalyst[ez_home_slider_location]" value="outside" <?php if (catalyst_get_dynamik( 'ez_home_slider_location' ) == 'outside') echo 'checked="checked" '; ?>/><label><?php _e( 'Outside Sidebar', 'catalyst' ); ?></label>
				<input type="radio" name="catalyst[ez_home_slider_location]" value="inside" <?php if (catalyst_get_dynamik( 'ez_home_slider_location' ) == 'inside') echo 'checked="checked" '; ?>/><label><?php _e( 'Inside Sidebar', 'catalyst' ); ?></label> |
				<?php _e( 'Height', 'catalyst' ); ?> <input type="text" id="ez-home-slider-height" name="catalyst[ez_home_slider_height]" value="<?php catalyst_dynamik_options_defaults( true, 'ez_home_slider_height' ); ?>" style="width:40px;" /><?php _e( 'px', 'catalyst' ); ?>
				<span id="catalyst-home-slider-display-reference-tooltip" class="tooltip-mark tooltip-center-left">[<?php _e( 'Examples', 'catalyst' ); ?>]</span>
			</p>
			
			<div class="tooltip tooltip-500">
				<h5><?php _e( 'Home Slider Display Location Reference Examples:', 'catalyst' ); ?></h5>
				<p><img src="<?php echo get_template_directory_uri(); ?>/lib/css/images/tooltips/tooltip-home-slider-display-reference.png"/></p>
			</div>
		</div>
		
		<h3 style="margin-top:15px; float:left;"><?php _e( 'Feature Top EZ-Widget Areas', 'catalyst' ); ?></h3>
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Feature Top Display Locations', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p style="margin-top:5px;" class="bg-box-design">
				<?php _e( 'Home', 'catalyst' ); ?> <input class="ez-feature-check" type="checkbox" id="catalyst-ez-feature-top-display-front-page" name="catalyst[ez_feature_top_display_front_page]" value="1" <?php if( checked( 1, catalyst_get_dynamik( 'ez_feature_top_display_front_page' ) ) ); ?> /> |
				<?php _e( 'Posts', 'catalyst' ); ?> <input class="ez-feature-check" type="checkbox" id="catalyst-ez-feature-top-display-posts" name="catalyst[ez_feature_top_display_posts]" value="1" <?php if( checked( 1, catalyst_get_dynamik( 'ez_feature_top_display_posts' ) ) ); ?> /> |
				<?php _e( 'Pages', 'catalyst' ); ?> <input class="ez-feature-check" type="checkbox" id="catalyst-ez-feature-top-display-pages" name="catalyst[ez_feature_top_display_pages]" value="1" <?php if( checked( 1, catalyst_get_dynamik( 'ez_feature_top_display_pages' ) ) ); ?> /> |
				<?php _e( 'Archives', 'catalyst' ); ?> <input class="ez-feature-check" type="checkbox" id="catalyst-ez-feature-top-display-archives" name="catalyst[ez_feature_top_display_archives]" value="1" <?php if( checked( 1, catalyst_get_dynamik( 'ez_feature_top_display_archives' ) ) ); ?> /> |
				<?php _e( 'Blog Template', 'catalyst' ); ?> <input class="ez-feature-check" type="checkbox" id="catalyst-ez-feature-top-display-blog" name="catalyst[ez_feature_top_display_blog]" value="1" <?php if( checked( 1, catalyst_get_dynamik( 'ez_feature_top_display_blog' ) ) ); ?> /> |
				<?php _e( 'Blank Template', 'catalyst' ); ?> <input class="ez-feature-check" type="checkbox" id="catalyst-ez-feature-top-display-blank-content" name="catalyst[ez_feature_top_display_blank_content]" value="1" <?php if( checked( 1, catalyst_get_dynamik( 'ez_feature_top_display_blank_content' ) ) ); ?> />
				<span style="float:right;">(<span id="ez-feature-check-all" style="color:#21759B; cursor:pointer;"><?php _e( 'Check', 'catalyst' ); ?></span> | <span id="ez-feature-uncheck-all" style="color:#21759B; cursor:pointer;"><?php _e( 'Uncheck', 'catalyst' ); ?></span>)</span>
			</p>
		</div>
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Feature Top Display Position', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p style="margin-top:3px;" class="bg-box-design">
				<input type="radio" name="catalyst[ez_feature_top_position]" value="inside_wrap" <?php if (catalyst_get_dynamik( 'ez_feature_top_position' ) == 'inside_wrap') echo 'checked="checked" '; ?>/><label><?php _e( 'Inside Wrap', 'catalyst' ); ?></label>
				<input type="radio" name="catalyst[ez_feature_top_position]" value="outside_wrap" <?php if (catalyst_get_dynamik( 'ez_feature_top_position' ) == 'outside_wrap') echo 'checked="checked" '; ?>/><label><?php _e( 'Outside Wrap', 'catalyst' ); ?></label>
				<span id="catalyst-feature-top-display-position-tooltip" class="tooltip-mark tooltip-bottom-center">[?]</span>
			</p>
			
			<div class="tooltip tooltip-500">
				<h5><?php _e( 'Inside Wrap vs Outside Wrap', 'catalyst' ); ?></h5>
				<p><?php _e( 'By default you won\'t see much difference between these two options. It is only when you make your Header Area fluid (in Dynamik Options > Wrap) that these options come in handy.', 'catalyst' ); ?>
				
				<p><?php _e( 'When you set the "Opening #wrap" to it\'s bottom most setting (in Dynamik Options > Wrap > #wrap Open & Close Div Locations) your Header and Navbars display outside of your main wrap div. In this case you can use these options to either display your Feature Top Inside your main wrap, in which case it will not be effected by this change, or Outside your main wrap, in which case it will display fluid, just below your Header and Navbars.', 'catalyst' ); ?></p>
			</div>
		</div>
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Feature Top Structure', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Select A Feature Top Layout', 'catalyst' ); ?> <select id="catalyst-ez-feature-top-select" name="catalyst[ez_feature_top_select]" size="1" style="width:250px;">
				<?php if( catalyst_get_dynamik( 'ez_feature_top_select' ) ) { $ez_feature_top_select_default = catalyst_get_dynamik( 'ez_feature_top_select' ); } else { $ez_feature_top_select_default = 'ez_feature_top_3.php'; } ?>
				<option value="<?php echo $ez_feature_top_select_default ?>"<?php if( $ez_feature_top_select_default == $ez_feature_top_select_default ) echo ' selected="selected"'; ?>><?php echo 'Selected: ' . $ez_feature_top_select_default ?></option>
					<?php $alt_feature_top_path = CATALYST_ROOT . '/lib/ez-structures/feature-top/';

					if( is_dir( $alt_feature_top_path ) ) {
						if( $alt_feature_top_dir = opendir( $alt_feature_top_path ) ) { 
							while( ( $alt_feature_top_file = readdir( $alt_feature_top_dir ) ) !== false ) {
								if( stristr( $alt_feature_top_file, ".php" ) !== false) {
									$alt_feature_top = $alt_feature_top_file;
									?><option value="<?php echo $alt_feature_top ?>"><?php echo $alt_feature_top ?></option><?php
								}
							}    
						}
					} ?>
				</select> <span id="catalyst-ez-feature-top-wa-reference-tooltip" class="tooltip-mark tooltip-center-left">[<?php _e( 'Examples', 'catalyst' ); ?>]</span>
			</p>
			
			<div class="tooltip tooltip-500">
				<h5><?php _e( 'EZ Feature Top Layout Reference Examples:', 'catalyst' ); ?></h5>
				<p><img src="<?php echo get_template_directory_uri(); ?>/lib/css/images/tooltips/tooltip-feature-top-wa-reference.png"/></p>
			</div>
		</div>
		
		<div class="dynamik-structure-settings-hide">
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'Feature Top Widget Heading Fonts', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select class="catalyst-universal-font-type-child catalyst-universal-heading-font-type-child" id="catalyst-ez-widget-feature-title-font-type" name="catalyst[font_type][ez_widget_feature_title]" size="1" style="width:98px;">
				<?php catalyst_build_font_menu( $dynamik_font_type['ez_widget_feature_title'] ); ?></select>
				<input type="text" id="catalyst-ez-widget-feature-title-font-size" name="catalyst[ez_widget_feature_title_font_size]" value="<?php catalyst_dynamik_options_defaults( true, 'ez_widget_feature_title_font_size' ); ?>" style="width:40px;" />
				<select class="catalyst-universal-px-em-child catalyst-universal-heading-px-em-child" id="catalyst-ez-widget-feature-title-px-em" name="catalyst[ez_widget_feature_title_px_em]" size="1" style="width:50px;">
					<option value="px"<?php echo ( catalyst_get_dynamik( 'ez_widget_feature_title_px_em' ) == 'px' ) ? ' selected="selected"' : ''; ?>>px</option>
					<option value="em"<?php echo ( catalyst_get_dynamik( 'ez_widget_feature_title_px_em' ) == 'em' ) ? ' selected="selected"' : ''; ?>>em</option>
				</select>
				<?php _e( 'Color', 'catalyst' ); ?><input type="text" class="catalyst-universal-font-color-child catalyst-universal-heading-font-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-ez-widget-feature-title-font-color" name="catalyst[ez_widget_feature_title_font_color]" value="<?php catalyst_dynamik_options_defaults( true, 'ez_widget_feature_title_font_color' ); ?>" />
				<input type="checkbox" class="universal-check" id="catalyst-ez-widget-feature-title-font-universal" name="catalyst[ez_widget_feature_title_font_u]" value="u" <?php if( checked( 'u', catalyst_get_dynamik( 'ez_widget_feature_title_font_u' ) ) ); ?> /> <?php _e( '(U)', 'catalyst' ); ?>
				<span class="catalyst-custom-fonts-button-wrap"><span id="show-ez-widget-feature-title-font-css" class="catalyst-custom-fonts-button">#Custom</span></span>
				<div style="display:none;" id="show-ez-widget-feature-title-font-css-box" class="catalyst-custom-fonts-box">
				<?php _e( 'EZ Feature Top Heading Font Custom CSS | <code>#feature-top-container .ez-widget-area h4 { }</code>', 'catalyst' ); ?><br />
				<textarea class="catalyst-universal-font-css-child catalyst-universal-heading-font-css-child" id="catalyst-ez-widget-feature-title-font-css" name="catalyst[ez_widget_feature_title_font_css]" style="width:100%;" rows="10"><?php echo catalyst_get_dynamik( 'ez_widget_feature_title_font_css' ); ?></textarea>
				</div>
			</p>
		</div>
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'Feature Top Widget Content Fonts', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select class="catalyst-universal-font-type-child catalyst-universal-content-font-type-child" id="catalyst-ez-widget-feature-content-font-type" name="catalyst[font_type][ez_widget_feature_content]" size="1" style="width:98px;">
				<?php catalyst_build_font_menu( $dynamik_font_type['ez_widget_feature_content'] ); ?></select>
				<input type="text" id="catalyst-ez-widget-feature-content-font-size" name="catalyst[ez_widget_feature_content_font_size]" value="<?php catalyst_dynamik_options_defaults( true, 'ez_widget_feature_content_font_size' ); ?>" style="width:40px;" />
				<select class="catalyst-universal-px-em-child catalyst-universal-content-px-em-child" id="catalyst-ez-widget-feature-content-px-em" name="catalyst[ez_widget_feature_content_px_em]" size="1" style="width:50px;">
					<option value="px"<?php echo ( catalyst_get_dynamik( 'ez_widget_feature_content_px_em' ) == 'px' ) ? ' selected="selected"' : ''; ?>>px</option>
					<option value="em"<?php echo ( catalyst_get_dynamik( 'ez_widget_feature_content_px_em' ) == 'em' ) ? ' selected="selected"' : ''; ?>>em</option>
				</select>
				<?php _e( 'Color', 'catalyst' ); ?><input type="text" class="catalyst-universal-font-color-child catalyst-universal-content-font-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-ez-widget-feature-content-font-color" name="catalyst[ez_widget_feature_content_font_color]" value="<?php catalyst_dynamik_options_defaults( true, 'ez_widget_feature_content_font_color' ); ?>" />
				<input type="checkbox" class="universal-check" id="catalyst-ez-widget-feature-content-font-universal" name="catalyst[ez_widget_feature_content_font_u]" value="u" <?php if( checked( 'u', catalyst_get_dynamik( 'ez_widget_feature_content_font_u' ) ) ); ?> /> <?php _e( '(U)', 'catalyst' ); ?>
				<span class="catalyst-custom-fonts-button-wrap"><span id="show-ez-widget-feature-content-font-css" class="catalyst-custom-fonts-button">#Custom</span></span>
				<div style="display:none;" id="show-ez-widget-feature-content-font-css-box" class="catalyst-custom-fonts-box">
				<?php _e( 'EZ Feature Top Content Font Custom CSS | <code>#feature-top-container .ez-widget-area { }</code>', 'catalyst' ); ?><br />
				<textarea class="catalyst-universal-font-css-child catalyst-universal-content-font-css-child" id="catalyst-ez-widget-feature-content-font-css" name="catalyst[ez_widget_feature_content_font_css]" style="width:100%;" rows="10"><?php echo catalyst_get_dynamik( 'ez_widget_feature_content_font_css' ); ?></textarea>
				</div>
			</p>
		</div>
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'Feature Top Widget Content Link', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Link', 'catalyst' ); ?><input type="text" class="catalyst-universal-link-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-ez-widget-feature-content-link-color" name="catalyst[ez_widget_feature_content_link_color]" value="<?php catalyst_dynamik_options_defaults( true, 'ez_widget_feature_content_link_color' ); ?>" />
				<?php _e( 'Link Hover', 'catalyst' ); ?><input type="text" class="catalyst-universal-link-hover-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-ez-widget-feature-content-link-hover-color" name="catalyst[ez_widget_feature_content_link_hover_color]" value="<?php catalyst_dynamik_options_defaults( true, 'ez_widget_feature_content_link_hover_color' ); ?>" />
				<?php _e( 'Link Underline', 'catalyst' ); ?> <select class="catalyst-universal-link-underline-child" id="catalyst-ez-widget-feature-content-link-underline" name="catalyst[ez_widget_feature_content_link_underline]" size="1" style="width:90px;">
					<option value="Never"<?php if (catalyst_get_dynamik( 'ez_widget_feature_content_link_underline' ) == 'Never') echo ' selected="selected"'; ?>><?php _e( 'Never', 'catalyst' ); ?></option>
					<option value="On Hover"<?php if (catalyst_get_dynamik( 'ez_widget_feature_content_link_underline' ) == 'On Hover') echo ' selected="selected"'; ?>><?php _e( 'On Hover', 'catalyst' ); ?></option>
					<option value="Off Hover"<?php if (catalyst_get_dynamik( 'ez_widget_feature_content_link_underline' ) == 'Off Hover') echo ' selected="selected"'; ?>><?php _e( 'Off Hover', 'catalyst' ); ?></option>
					<option value="Always"<?php if (catalyst_get_dynamik( 'ez_widget_feature_content_link_underline' ) == 'Always') echo ' selected="selected"'; ?>><?php _e( 'Always', 'catalyst' ); ?></option>
				</select>
				<input type="checkbox" class="universal-check" id="catalyst-ez-widget-feature-content-link-universal" name="catalyst[ez_widget_feature_content_link_u]" value="u" <?php if( checked( 'u', catalyst_get_dynamik( 'ez_widget_feature_content_link_u' ) ) ); ?> /> <?php _e( '(U)', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="catalyst-bg-option-desc">
			<p><?php _e( 'Feature Top Container Wrap Background', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select id="catalyst-ez-widget-feature-bg-type" class="catalyst-bg-type" name="catalyst[ez_widget_feature_bg_type]" size="1" style="width:150px;">
				<?php catalyst_list_bg_options( catalyst_get_dynamik( 'ez_widget_feature_bg_type' ) ); ?>
				</select> <span style="display:none;" id="catalyst-ez-widget-feature-bg-type-checkbox"><?php _e( '(No Color', 'catalyst' ); ?> <input type="checkbox" id="catalyst-ez-widget-feature-bg-no-color" name="catalyst[ez_widget_feature_bg_no_color]" value="1" <?php if( checked( 1, catalyst_get_dynamik( 'ez_widget_feature_bg_no_color' ) ) ); ?> />)</span><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-ez-widget-feature-bg-color" name="catalyst[ez_widget_feature_bg_color]" value="<?php catalyst_dynamik_options_defaults( true, 'ez_widget_feature_bg_color' ); ?>" />
				<?php _e( 'Image', 'catalyst' ); ?> <select id="catalyst-ez-widget-feature-bg-image" name="catalyst[ez_widget_feature_bg_image]" size="1" style="width:150px;"><?php catalyst_list_images( catalyst_get_dynamik( 'ez_widget_feature_bg_image' ) ); ?></select>
			</p>
		</div>
		
		<div class="catalyst-border-option-desc">
			<p><?php _e( 'Feature Top Heading Bottom Border', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Thickness', 'catalyst' ); ?>
				<input type="text" id="catalyst-ez-widget-feature-heading-bottom-border-thickness" name="catalyst[ez_widget_feature_heading_bottom_border_thickness]" value="<?php catalyst_dynamik_options_defaults( true, 'ez_widget_feature_heading_bottom_border_thickness' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Style', 'catalyst' ); ?> <select id="catalyst-ez-widget-feature-heading-bottom-border-style" name="catalyst[ez_widget_feature_heading_bottom_border_style]" size="1" style="width:80px;">
					<?php catalyst_list_borders( catalyst_get_dynamik( 'ez_widget_feature_heading_bottom_border_style' ) ); ?>
				</select>
				<?php _e( 'Color', 'catalyst' ); ?> <input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-ez-widget-feature-heading-bottom-border-color" name="catalyst[ez_widget_feature_heading_bottom_border_color]" value="<?php catalyst_dynamik_options_defaults( true, 'ez_widget_feature_heading_bottom_border_color' ); ?>" />
			</p>
		</div>
		
		<div class="catalyst-border-option-desc">
			<p><?php _e( 'Feature Top Container Wrap Border', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select id="catalyst-ez-widget-feature-border-type" name="catalyst[ez_widget_feature_border_type]" size="1" style="width:100px;">
					<option value="Full"<?php if (catalyst_get_dynamik( 'ez_widget_feature_border_type' ) == 'Full') echo ' selected="selected"'; ?>><?php _e( 'Full', 'catalyst' ); ?></option>
					<option value="Top"<?php if (catalyst_get_dynamik( 'ez_widget_feature_border_type' ) == 'Top') echo ' selected="selected"'; ?>><?php _e( 'Top', 'catalyst' ); ?></option>
					<option value="Bottom"<?php if (catalyst_get_dynamik( 'ez_widget_feature_border_type' ) == 'Bottom') echo ' selected="selected"'; ?>><?php _e( 'Bottom', 'catalyst' ); ?></option>
					<option value="Top/Bottom"<?php if (catalyst_get_dynamik( 'ez_widget_feature_border_type' ) == 'Top/Bottom') echo ' selected="selected"'; ?>><?php _e( 'Top/Bottom', 'catalyst' ); ?></option>
					<option value="Left/Right"<?php if (catalyst_get_dynamik( 'ez_widget_feature_border_type' ) == 'Left/Right') echo ' selected="selected"'; ?>><?php _e( 'Left/Right', 'catalyst' ); ?></option>
				</select>
				<?php _e( 'Thickness', 'catalyst' ); ?> <input type="text" id="catalyst-ez-widget-feature-border-thickness" name="catalyst[ez_widget_feature_border_thickness]" value="<?php catalyst_dynamik_options_defaults( true, 'ez_widget_feature_border_thickness' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Style', 'catalyst' ); ?> <select id="catalyst-ez-widget-feature-border-style" name="catalyst[ez_widget_feature_border_style]" size="1" style="width:90px; margin-right:5px;">
					<?php catalyst_list_borders( catalyst_get_dynamik( 'ez_widget_feature_border_style' ) ); ?>
				</select><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-ez-widget-feature-border-color" name="catalyst[ez_widget_feature_border_color]" value="<?php catalyst_dynamik_options_defaults( true, 'ez_widget_feature_border_color' ); ?>" />
			</p>
		</div>
		
		<div class="dynamik-design-standard-hide">
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Feature Top Container Padding', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p>
				<?php _e( 'Padding: Top', 'catalyst' ); ?>
				<input type="text" id="ez-widget-feature-padding-top" name="catalyst[ez_widget_feature_padding_top]" value="<?php catalyst_dynamik_options_defaults( true, 'ez_widget_feature_padding_top' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Right', 'catalyst' ); ?>
				<input type="text" class="ez-widget-feature-width-option" id="ez-widget-feature-padding-right" name="catalyst[ez_widget_feature_padding_right]" value="<?php catalyst_dynamik_options_defaults( true, 'ez_widget_feature_padding_right' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Bottom', 'catalyst' ); ?>
				<input type="text" id="ez-widget-feature-padding-bottom" name="catalyst[ez_widget_feature_padding_bottom]" value="<?php catalyst_dynamik_options_defaults( true, 'ez_widget_feature_padding_bottom' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Left', 'catalyst' ); ?>
				<input type="text" class="ez-widget-feature-width-option" id="ez-widget-feature-padding-left" name="catalyst[ez_widget_feature_padding_left]" value="<?php catalyst_dynamik_options_defaults( true, 'ez_widget_feature_padding_left' ); ?>" style="width:35px;" /><?php _e( 'px', 'catalyst' ); ?>
			</p>
		</div>
		
		</div><!-- End .dynamik-design-standard-hide -->
		
		</div><!-- End .dynamik-structure-settings-hide -->
		
		<h3 style="margin-top:15px; float:left;"><?php _e( 'Fat Footer EZ-Widget Areas', 'catalyst' ); ?></h3>
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Fat Footer Display Locations', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p style="margin-top:5px;" class="bg-box-design">
				<?php _e( 'Home', 'catalyst' ); ?> <input class="ez-footer-check" type="checkbox" id="catalyst-ez-fat-footer-display-front-page" name="catalyst[ez_fat_footer_display_front_page]" value="1" <?php if( checked( 1, catalyst_get_dynamik( 'ez_fat_footer_display_front_page' ) ) ); ?> /> |
				<?php _e( 'Posts', 'catalyst' ); ?> <input class="ez-footer-check" type="checkbox" id="catalyst-ez-fat-footer-display-posts" name="catalyst[ez_fat_footer_display_posts]" value="1" <?php if( checked( 1, catalyst_get_dynamik( 'ez_fat_footer_display_posts' ) ) ); ?> /> |
				<?php _e( 'Pages', 'catalyst' ); ?> <input class="ez-footer-check" type="checkbox" id="catalyst-ez-fat-footer-display-pages" name="catalyst[ez_fat_footer_display_pages]" value="1" <?php if( checked( 1, catalyst_get_dynamik( 'ez_fat_footer_display_pages' ) ) ); ?> /> |
				<?php _e( 'Archives', 'catalyst' ); ?> <input class="ez-footer-check" type="checkbox" id="catalyst-ez-fat-footer-display-archives" name="catalyst[ez_fat_footer_display_archives]" value="1" <?php if( checked( 1, catalyst_get_dynamik( 'ez_fat_footer_display_archives' ) ) ); ?> /> |
				<?php _e( 'Blog Template', 'catalyst' ); ?> <input class="ez-footer-check" type="checkbox" id="catalyst-ez-fat-footer-display-blog" name="catalyst[ez_fat_footer_display_blog]" value="1" <?php if( checked( 1, catalyst_get_dynamik( 'ez_fat_footer_display_blog' ) ) ); ?> /> |
				<?php _e( 'Blank Template', 'catalyst' ); ?> <input class="ez-footer-check" type="checkbox" id="catalyst-ez-fat-footer-display-blank-content" name="catalyst[ez_fat_footer_display_blank_content]" value="1" <?php if( checked( 1, catalyst_get_dynamik( 'ez_fat_footer_display_blank_content' ) ) ); ?> />
				<span style="float:right;">(<span id="ez-footer-check-all" style="color:#21759B; cursor:pointer;"><?php _e( 'Check', 'catalyst' ); ?></span> | <span id="ez-footer-uncheck-all" style="color:#21759B; cursor:pointer;"><?php _e( 'Uncheck', 'catalyst' ); ?></span>)</span>
			</p>
		</div>
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Fat Footer Display Position', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p style="margin-top:3px;" class="bg-box-design">
				<input type="radio" name="catalyst[ez_fat_footer_position]" value="inside_footer" <?php if (catalyst_get_dynamik( 'ez_fat_footer_position' ) == 'inside_footer') echo 'checked="checked" '; ?>/><label><?php _e( 'Inside Footer', 'catalyst' ); ?></label>
				<input type="radio" name="catalyst[ez_fat_footer_position]" value="outside_footer" <?php if (catalyst_get_dynamik( 'ez_fat_footer_position' ) == 'outside_footer') echo 'checked="checked" '; ?>/><label><?php _e( 'Outside Footer', 'catalyst' ); ?></label>
				<span id="catalyst-fat-footer-display-position-tooltip" class="tooltip-mark tooltip-bottom-center">[?]</span>
			</p>
			
			<div class="tooltip tooltip-500">
				<h5><?php _e( 'Inside Footer vs Outside Footer', 'catalyst' ); ?></h5>
				<p><?php _e( 'By default you won\'t see much difference between these two options. It is only when you make your Footer fluid (in Dynamik Options > Wrap) that these options come in handy.', 'catalyst' ); ?>
				
				<p><?php _e( 'When set to fluid your Footer displays outside of your main wrap div. In this case you can use these options to either display your Fat Footer Inside your Footer, in which case it will ALSO display outside of your main wrap div, or Outside the Footer, in which case it will stay inside your main wrap div.', 'catalyst' ); ?></p>
			</div>
		</div>
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Fat Footer Structure', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Select A Fat Footer Layout', 'catalyst' ); ?> <select id="catalyst-ez-fat-footer-select" name="catalyst[ez_fat_footer_select]" size="1" style="width:250px;">
				<?php if( catalyst_get_dynamik( 'ez_fat_footer_select' ) ) { $ez_fat_footer_select_default = catalyst_get_dynamik( 'ez_fat_footer_select' ); } else { $ez_fat_footer_select_default = 'ez_fat_footer_3.php'; } ?>
				<option value="<?php echo $ez_fat_footer_select_default ?>"<?php if( $ez_fat_footer_select_default == $ez_fat_footer_select_default ) echo ' selected="selected"'; ?>><?php echo 'Selected: ' . $ez_fat_footer_select_default ?></option>
					<?php $alt_fat_footer_path = CATALYST_ROOT . '/lib/ez-structures/fat-footer/';

					if( is_dir( $alt_fat_footer_path ) ) {
						if( $alt_fat_footer_dir = opendir( $alt_fat_footer_path ) ) { 
							while( ( $alt_fat_footer_file = readdir( $alt_fat_footer_dir ) ) !== false ) {
								if( stristr( $alt_fat_footer_file, ".php" ) !== false) {
									$alt_fat_footer = $alt_fat_footer_file;
									?><option value="<?php echo $alt_fat_footer ?>"><?php echo $alt_fat_footer ?></option><?php
								}
							}    
						}
					} ?>
				</select> <span id="catalyst-ez-fat-footer-wa-reference-tooltip" class="tooltip-mark tooltip-center-left">[<?php _e( 'Examples', 'catalyst' ); ?>]</span>
			</p>
			
			<div class="tooltip tooltip-500">
				<h5><?php _e( 'EZ Fat Footer Layout Reference Examples:', 'catalyst' ); ?></h5>
				<p><img src="<?php echo get_template_directory_uri(); ?>/lib/css/images/tooltips/tooltip-fat-footer-wa-reference.png"/></p>
			</div>
		</div>
		
		<div class="dynamik-structure-settings-hide">
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'Fat Footer Widget Heading Fonts', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select class="catalyst-universal-font-type-child catalyst-universal-heading-font-type-child" id="catalyst-ez-widget-footer-title-font-type" name="catalyst[font_type][ez_widget_footer_title]" size="1" style="width:98px;">
				<?php catalyst_build_font_menu( $dynamik_font_type['ez_widget_footer_title'] ); ?></select>
				<input type="text" id="catalyst-ez-widget-footer-title-font-size" name="catalyst[ez_widget_footer_title_font_size]" value="<?php catalyst_dynamik_options_defaults( true, 'ez_widget_footer_title_font_size' ); ?>" style="width:40px;" />
				<select class="catalyst-universal-px-em-child catalyst-universal-heading-px-em-child" id="catalyst-ez-widget-footer-title-px-em" name="catalyst[ez_widget_footer_title_px_em]" size="1" style="width:50px;">
					<option value="px"<?php echo ( catalyst_get_dynamik( 'ez_widget_footer_title_px_em' ) == 'px' ) ? ' selected="selected"' : ''; ?>>px</option>
					<option value="em"<?php echo ( catalyst_get_dynamik( 'ez_widget_footer_title_px_em' ) == 'em' ) ? ' selected="selected"' : ''; ?>>em</option>
				</select>
				<?php _e( 'Color', 'catalyst' ); ?><input type="text" class="catalyst-universal-font-color-child catalyst-universal-heading-font-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-ez-widget-footer-title-font-color" name="catalyst[ez_widget_footer_title_font_color]" value="<?php catalyst_dynamik_options_defaults( true, 'ez_widget_footer_title_font_color' ); ?>" />
				<input type="checkbox" class="universal-check" id="catalyst-ez-widget-footer-title-font-universal" name="catalyst[ez_widget_footer_title_font_u]" value="u" <?php if( checked( 'u', catalyst_get_dynamik( 'ez_widget_footer_title_font_u' ) ) ); ?> /> <?php _e( '(U)', 'catalyst' ); ?>
				<span class="catalyst-custom-fonts-button-wrap"><span id="show-ez-widget-footer-title-font-css" class="catalyst-custom-fonts-button">#Custom</span></span>
				<div style="display:none;" id="show-ez-widget-footer-title-font-css-box" class="catalyst-custom-fonts-box">
				<?php _e( 'EZ Fat Footer Heading Font Custom CSS | <code>#fat-footer-container .ez-widget-area h4 { }</code>', 'catalyst' ); ?><br />
				<textarea class="catalyst-universal-font-css-child catalyst-universal-heading-font-css-child" id="catalyst-ez-widget-footer-title-font-css" name="catalyst[ez_widget_footer_title_font_css]" style="width:100%;" rows="10"><?php echo catalyst_get_dynamik( 'ez_widget_footer_title_font_css' ); ?></textarea>
				</div>
			</p>
		</div>
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'Fat Footer Widget Content Fonts', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select class="catalyst-universal-font-type-child catalyst-universal-content-font-type-child" id="catalyst-ez-widget-footer-content-font-type" name="catalyst[font_type][ez_widget_footer_content]" size="1" style="width:98px;">
				<?php catalyst_build_font_menu( $dynamik_font_type['ez_widget_footer_content'] ); ?></select>
				<input type="text" id="catalyst-ez-widget-footer-content-font-size" name="catalyst[ez_widget_footer_content_font_size]" value="<?php catalyst_dynamik_options_defaults( true, 'ez_widget_footer_content_font_size' ); ?>" style="width:40px;" />
				<select class="catalyst-universal-px-em-child catalyst-universal-content-px-em-child" id="catalyst-ez-widget-footer-content-px-em" name="catalyst[ez_widget_footer_content_px_em]" size="1" style="width:50px;">
					<option value="px"<?php echo ( catalyst_get_dynamik( 'ez_widget_footer_content_px_em' ) == 'px' ) ? ' selected="selected"' : ''; ?>>px</option>
					<option value="em"<?php echo ( catalyst_get_dynamik( 'ez_widget_footer_content_px_em' ) == 'em' ) ? ' selected="selected"' : ''; ?>>em</option>
				</select>
				<?php _e( 'Color', 'catalyst' ); ?><input type="text" class="catalyst-universal-font-color-child catalyst-universal-content-font-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-ez-widget-footer-content-font-color" name="catalyst[ez_widget_footer_content_font_color]" value="<?php catalyst_dynamik_options_defaults( true, 'ez_widget_footer_content_font_color' ); ?>" />
				<input type="checkbox" class="universal-check" id="catalyst-ez-widget-footer-content-font-universal" name="catalyst[ez_widget_footer_content_font_u]" value="u" <?php if( checked( 'u', catalyst_get_dynamik( 'ez_widget_footer_content_font_u' ) ) ); ?> /> <?php _e( '(U)', 'catalyst' ); ?>
				<span class="catalyst-custom-fonts-button-wrap"><span id="show-ez-widget-footer-content-font-css" class="catalyst-custom-fonts-button">#Custom</span></span>
				<div style="display:none;" id="show-ez-widget-footer-content-font-css-box" class="catalyst-custom-fonts-box">
				<?php _e( 'EZ Fat Footer Content Font Custom CSS | <code>#fat-footer-container .ez-widget-area { }</code>', 'catalyst' ); ?><br />
				<textarea class="catalyst-universal-font-css-child catalyst-universal-content-font-css-child" id="catalyst-ez-widget-footer-content-font-css" name="catalyst[ez_widget_footer_content_font_css]" style="width:100%;" rows="10"><?php echo catalyst_get_dynamik( 'ez_widget_footer_content_font_css' ); ?></textarea>
				</div>
			</p>
		</div>
		
		<div class="catalyst-font-option-desc">
			<p><?php _e( 'Fat Footer Widget Content Link', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Link', 'catalyst' ); ?><input type="text" class="catalyst-universal-link-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-ez-widget-footer-content-link-color" name="catalyst[ez_widget_footer_content_link_color]" value="<?php catalyst_dynamik_options_defaults( true, 'ez_widget_footer_content_link_color' ); ?>" />
				<?php _e( 'Link Hover', 'catalyst' ); ?><input type="text" class="catalyst-universal-link-hover-color-child color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-ez-widget-footer-content-link-hover-color" name="catalyst[ez_widget_footer_content_link_hover_color]" value="<?php catalyst_dynamik_options_defaults( true, 'ez_widget_footer_content_link_hover_color' ); ?>" />
				<?php _e( 'Link Underline', 'catalyst' ); ?> <select class="catalyst-universal-link-underline-child" id="catalyst-ez-widget-footer-content-link-underline" name="catalyst[ez_widget_footer_content_link_underline]" size="1" style="width:90px;">
					<option value="Never"<?php if (catalyst_get_dynamik( 'ez_widget_footer_content_link_underline' ) == 'Never') echo ' selected="selected"'; ?>><?php _e( 'Never', 'catalyst' ); ?></option>
					<option value="On Hover"<?php if (catalyst_get_dynamik( 'ez_widget_footer_content_link_underline' ) == 'On Hover') echo ' selected="selected"'; ?>><?php _e( 'On Hover', 'catalyst' ); ?></option>
					<option value="Off Hover"<?php if (catalyst_get_dynamik( 'ez_widget_footer_content_link_underline' ) == 'Off Hover') echo ' selected="selected"'; ?>><?php _e( 'Off Hover', 'catalyst' ); ?></option>
					<option value="Always"<?php if (catalyst_get_dynamik( 'ez_widget_footer_content_link_underline' ) == 'Always') echo ' selected="selected"'; ?>><?php _e( 'Always', 'catalyst' ); ?></option>
				</select>
				<input type="checkbox" class="universal-check" id="catalyst-ez-widget-footer-content-link-universal" name="catalyst[ez_widget_footer_content_link_u]" value="u" <?php if( checked( 'u', catalyst_get_dynamik( 'ez_widget_footer_content_link_u' ) ) ); ?> /> <?php _e( '(U)', 'catalyst' ); ?>
			</p>
		</div>
		
		<div class="catalyst-bg-option-desc">
			<p><?php _e( 'Fat Footer Container Wrap Background', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select id="catalyst-ez-widget-footer-bg-type" class="catalyst-bg-type" name="catalyst[ez_widget_footer_bg_type]" size="1" style="width:150px;">
				<?php catalyst_list_bg_options( catalyst_get_dynamik( 'ez_widget_footer_bg_type' ) ); ?>
				</select> <span style="display:none;" id="catalyst-ez-widget-footer-bg-type-checkbox"><?php _e( '(No Color', 'catalyst' ); ?> <input type="checkbox" id="catalyst-ez-widget-footer-bg-no-color" name="catalyst[ez_widget_footer_bg_no_color]" value="1" <?php if( checked( 1, catalyst_get_dynamik( 'ez_widget_footer_bg_no_color' ) ) ); ?> />)</span><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-ez-widget-footer-bg-color" name="catalyst[ez_widget_footer_bg_color]" value="<?php catalyst_dynamik_options_defaults( true, 'ez_widget_footer_bg_color' ); ?>" />
				<?php _e( 'Image', 'catalyst' ); ?> <select id="catalyst-ez-widget-footer-bg-image" name="catalyst[ez_widget_footer_bg_image]" size="1" style="width:150px;"><?php catalyst_list_images( catalyst_get_dynamik( 'ez_widget_footer_bg_image' ) ); ?></select>
			</p>
		</div>
		
		<div class="catalyst-border-option-desc">
			<p><?php _e( 'Fat Footer Heading Bottom Border', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Thickness', 'catalyst' ); ?>
				<input type="text" id="catalyst-ez-widget-footer-heading-bottom-border-thickness" name="catalyst[ez_widget_footer_heading_bottom_border_thickness]" value="<?php catalyst_dynamik_options_defaults( true, 'ez_widget_footer_heading_bottom_border_thickness' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Style', 'catalyst' ); ?> <select id="catalyst-ez-widget-footer-heading-bottom-border-style" name="catalyst[ez_widget_footer_heading_bottom_border_style]" size="1" style="width:80px;">
					<?php catalyst_list_borders( catalyst_get_dynamik( 'ez_widget_footer_heading_bottom_border_style' ) ); ?>
				</select>
				<?php _e( 'Color', 'catalyst' ); ?> <input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-ez-widget-footer-heading-bottom-border-color" name="catalyst[ez_widget_footer_heading_bottom_border_color]" value="<?php catalyst_dynamik_options_defaults( true, 'ez_widget_footer_heading_bottom_border_color' ); ?>" />
			</p>
		</div>
		
		<div class="catalyst-border-option-desc">
			<p><?php _e( 'Fat Footer Container Wrap Border', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<?php _e( 'Type', 'catalyst' ); ?> <select id="catalyst-ez-widget-footer-border-type" name="catalyst[ez_widget_footer_border_type]" size="1" style="width:100px;">
					<option value="Full"<?php if( catalyst_get_dynamik( 'ez_widget_footer_border_type' ) == 'Full' ) echo ' selected="selected"'; ?>><?php _e( 'Full', 'catalyst' ); ?></option>
					<option value="Top"<?php if( catalyst_get_dynamik( 'ez_widget_footer_border_type' ) == 'Top' ) echo ' selected="selected"'; ?>><?php _e( 'Top', 'catalyst' ); ?></option>
					<option value="Bottom"<?php if( catalyst_get_dynamik( 'ez_widget_footer_border_type' ) == 'Bottom' ) echo ' selected="selected"'; ?>><?php _e( 'Bottom', 'catalyst' ); ?></option>
					<option value="Top/Bottom"<?php if( catalyst_get_dynamik( 'ez_widget_footer_border_type' ) == 'Top/Bottom' ) echo ' selected="selected"'; ?>><?php _e( 'Top/Bottom', 'catalyst' ); ?></option>
					<option value="Left/Right"<?php if( catalyst_get_dynamik( 'ez_widget_footer_border_type' ) == 'Left/Right' ) echo ' selected="selected"'; ?>><?php _e( 'Left/Right', 'catalyst' ); ?></option>
				</select>
				<?php _e( 'Thickness', 'catalyst' ); ?> <input type="text" id="catalyst-ez-widget-footer-border-thickness" name="catalyst[ez_widget_footer_border_thickness]" value="<?php catalyst_dynamik_options_defaults( true, 'ez_widget_footer_border_thickness' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Style', 'catalyst' ); ?> <select id="catalyst-ez-widget-footer-border-style" name="catalyst[ez_widget_footer_border_style]" size="1" style="width:90px; margin-right:5px;">
					<?php catalyst_list_borders( catalyst_get_dynamik( 'ez_widget_footer_border_style' ) ); ?>
				</select><input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box" id="catalyst-ez-widget-footer-border-color" name="catalyst[ez_widget_footer_border_color]" value="<?php catalyst_dynamik_options_defaults( true, 'ez_widget_footer_border_color' ); ?>" />
			</p>
		</div>
		
		<div class="dynamik-design-standard-hide">
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Fat Footer Container Padding', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p>
				<?php _e( 'Padding: Top', 'catalyst' ); ?>
				<input type="text" id="ez-widget-footer-padding-top" name="catalyst[ez_widget_footer_padding_top]" value="<?php catalyst_dynamik_options_defaults( true, 'ez_widget_footer_padding_top' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Right', 'catalyst' ); ?>
				<input type="text" class="ez-widget-footer-width-option" id="ez-widget-footer-padding-right" name="catalyst[ez_widget_footer_padding_right]" value="<?php catalyst_dynamik_options_defaults( true, 'ez_widget_footer_padding_right' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Bottom', 'catalyst' ); ?>
				<input type="text" id="ez-widget-footer-padding-bottom" name="catalyst[ez_widget_footer_padding_bottom]" value="<?php catalyst_dynamik_options_defaults( true, 'ez_widget_footer_padding_bottom' ); ?>" style="width:35px;" /><?php _e( 'px |', 'catalyst' ); ?>
				<?php _e( 'Left', 'catalyst' ); ?>
				<input type="text" class="ez-widget-footer-width-option" id="ez-widget-footer-padding-left" name="catalyst[ez_widget_footer_padding_left]" value="<?php catalyst_dynamik_options_defaults( true, 'ez_widget_footer_padding_left' ); ?>" style="width:35px;" /><?php _e( 'px', 'catalyst' ); ?>
			</p>
		</div>
		
		</div><!-- End .dynamik-design-standard-hide -->
		
		</div><!-- End .dynamik-structure-settings-hide -->
		
	</div>
</div>