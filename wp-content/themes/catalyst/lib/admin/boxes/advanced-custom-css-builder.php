<?php
/**
 * Builds the Advanced Custom CSS Builder admin content.
 *
 * @package Catalyst
 */
?>

<div style="display:none;" id="catalyst-custom-css-builder" class="catalyst-optionbox-outer-1col">
	<div class="catalyst-optionbox-inner-1col">
		<h3 style="cursor:pointer; -webkit-border-radius: 3px 3px 0px 0px; border-radius: 3px 3px 0px 0px;"><?php _e( 'Custom CSS Builder', 'catalyst' ); ?> <span id="custom-css-builder-tooltip" class="tooltip-mark tooltip-bottom-center">[?]</span></h3>
		
		<div class="tooltip tooltip-600">
			<h5><?php _e( 'A CSS Building Tool', 'catalyst' ); ?></h5>
			
			<p>
				<?php _e( 'The Custom CSS Builder is a great little tool that can be used as a simple reference or a full blown CSS coding factory.', 'catalyst' ); ?>
			</p>
			
			<h5><?php _e( '#Custom CSS For Your Fonts', 'catalyst' ); ?></h5>
				
			<p>
				<?php _e( 'You\'ll find that most of the font options have a #Custom button to the right. When clicked a textarea will slide down. Here you can add any font styling you like and it will be applied to that font type in the dynamik stylesheet. You will see that the exact CSS ID/class that will be effected is shown at the top of each textarea. And don\'t forget that if you need any CSS assistance the Custom CSS Builder is only a mouse click away!', 'catalyst' ); ?>
				<center><img src="<?php echo get_template_directory_uri(); ?>/lib/css/images/tooltips/tooltip-custom-buttons.png"/></center>
			</p>
		</div>

		<div id="catalyst-custom-css-builder-wrap">
		<form name="form">
			<div id="catalyst-custom-css-builder-wrap-inner" class="bg-box">
				<div id="catalyst-custom-css-builder-nav">
					<ul>
						<li id="custom-css-builder-nav-open-close-elements" class="catalyst-css-builder-nav-all"><a href="#">Elements</a></li><li id="custom-css-builder-nav-backgrounds" class="catalyst-css-builder-nav-all"><a href="#">Backgrounds</a></li><li id="custom-css-builder-nav-borders" class="catalyst-css-builder-nav-all"><a href="#">Borders</a></li><li id="custom-css-builder-nav-margins-padding" class="catalyst-css-builder-nav-all"><a href="#">Margins & Padding</a></li><li id="custom-css-builder-nav-fonts" class="catalyst-css-builder-nav-all catalyst-options-nav-active"><a href="#">Fonts</a></li><li id="custom-css-builder-nav-dimensions-position" class="catalyst-css-builder-nav-all"><a href="#">Dimensions & Position</a></li><li id="custom-css-builder-nav-shadows" class="catalyst-css-builder-nav-all"><a href="#">Shadows</a></li><li id="custom-css-builder-nav-widgets" class="catalyst-css-builder-nav-all"><a class="catalyst-options-nav-last" href="#">Widgets</a></li>
					</ul>
				</div>
				
				<div id="custom-css-builder-nav-open-close-elements-box" class="catalyst-all-css-builder">
					<p style="float:left;">
						<span style="color:#444; font-size:13px; font-weight:bold; line-height:21px;"><?php _e( 'Select and Insert [&raquo;] Elements to be styled:', 'catalyst' ); ?><br /></span>
						<?php _e( 'General Elements', 'catalyst' ); ?><br />
						<select id="custom_css_divs" class="css-builder-elements-select" name="custom_css_divs" size="1">
						<?php catalyst_build_css_elements_menu(); ?>
						</select>
						<input class="custom-css-builder-button-elements custom-css-builder-buttons" type="button" value="&raquo;" onclick="insertAtCaret(this.form.text, this.form.custom_css_divs.value+'\n\n}\n')"><br />
						<?php _e( 'Navbar Elements', 'catalyst' ); ?><br />
						<select id="nav_css_divs" class="css-builder-elements-select" name="nav_css_divs" size="1">
						<?php catalyst_build_nav_elements_menu(); ?>
						</select>
						<input class="custom-css-builder-button-elements custom-css-builder-buttons" type="button" value="&raquo;" onclick="insertAtCaret(this.form.text, this.form.nav_css_divs.value+'\n\n}\n')"><br />
						<?php _e( 'EZ Widget Area Elements', 'catalyst' ); ?><br />
						<select id="ez_widget_areas_css_divs" class="css-builder-elements-select" name="ez_widget_areas_css_divs" size="1">
						<?php catalyst_build_ez_elements_menu(); ?>
						</select>
						<input class="custom-css-builder-button-elements custom-css-builder-buttons" type="button" value="&raquo;" onclick="insertAtCaret(this.form.text, this.form.ez_widget_areas_css_divs.value+'\n\n}\n')"><br />
						<?php _e( 'Main Content Elements', 'catalyst' ); ?><br />
						<select id="content_css_divs" class="css-builder-elements-select" name="content_css_divs" size="1">
						<?php catalyst_build_generalcontent_elements_menu(); ?>
						</select>
						<input class="custom-css-builder-button-elements custom-css-builder-buttons" type="button" value="&raquo;" onclick="insertAtCaret(this.form.text, this.form.content_css_divs.value+'\n\n}\n')"><br />
						<span id="highlighted-css-divs-span" style="display:none;">
						<?php _e( 'Currently Highlighted Element (via &lt;HTML&gt; Inspector)', 'catalyst' ); ?><br />
						<input type="text" id="highlighted-css-divs" class="css-builder-elements-select" name="highlighted_css_divs" style="width:273px;" />
						<input class="custom-css-builder-button-elements custom-css-builder-buttons" type="button" value="&raquo;" onclick="insertAtCaret(this.form.text, this.form.highlighted_css_divs.value+' {\n\n}\n')"><br />
						</span>
					</p>
				</div>
				
				<div id="custom-css-builder-nav-backgrounds-box" class="catalyst-all-css-builder">
					<p style="float:left;">
						<select id="background_type" name="background_type" size="1" class="iewide" style="width:230px;">
							<option value="no-repeat"><?php _e( 'No-Repeat Image (Left)', 'catalyst' ); ?></option>
							<option value="top center no-repeat"><?php _e( 'No-Repeat Image (Center)', 'catalyst' ); ?></option>
							<option value="top right no-repeat"><?php _e( 'No-Repeat Image (Right)', 'catalyst' ); ?></option>
							<option value="fixed no-repeat"><?php _e( 'No-Repeat Image (Left Fixed)', 'catalyst' ); ?></option>
							<option value="top center fixed no-repeat"><?php _e( 'No-Repeat Image (Center Fixed)', 'catalyst' ); ?></option>
							<option value="top right fixed no-repeat"><?php _e( 'No-Repeat Image (Right Fixed)', 'catalyst' ); ?></option>
							<option value="top left repeat-x"><?php _e( 'Horizontal-Repeat Image (Left)', 'catalyst' ); ?></option>
							<option value="top center repeat-x"><?php _e( 'Horizontal-Repeat Image (Center)', 'catalyst' ); ?></option>
							<option value="top right repeat-x"><?php _e( 'Horizontal-Repeat Image (Right)', 'catalyst' ); ?></option>
							<option value="top left fixed repeat-x"><?php _e( 'Horizontal-Repeat Image (Left Fixed)', 'catalyst' ); ?></option>
							<option value="top center fixed repeat-x"><?php _e( 'Horizontal-Repeat Image (Center Fixed)', 'catalyst' ); ?></option>
							<option value="top right fixed repeat-x"><?php _e( 'Horizontal-Repeat Image (Right Fixed)', 'catalyst' ); ?></option>				
							<option value="top left repeat-y"><?php _e( 'Vertical-Repeat Image (Left)', 'catalyst' ); ?></option>
							<option value="top center repeat-y"><?php _e( 'Vertical-Repeat Image (Center)', 'catalyst' ); ?></option>
							<option value="top right repeat-y"><?php _e( 'Vertical-Repeat Image (Right)', 'catalyst' ); ?></option>
							<option value="top left fixed repeat-y"><?php _e( 'Vertical-Repeat Image (Left Fixed)', 'catalyst' ); ?></option>
							<option value="top center fixed repeat-y"><?php _e( 'Vertical-Repeat Image (Center Fixed)', 'catalyst' ); ?></option>
							<option value="top right fixed repeat-y"><?php _e( 'Vertical-Repeat Image (Right Fixed)', 'catalyst' ); ?></option>						
							<option value="repeat"><?php _e( 'Horizontal & Vertical-Repeat Image', 'catalyst' ); ?></option>
							<option value="fixed repeat"><?php _e( 'Horizontal & Vertical-Repeat Image (Fixed)', 'catalyst' ); ?></option>
						</select> <?php _e( 'Type', 'catalyst' ); ?><br />
						<input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box-230" id="background_color" name="background_color" value="" /> <?php _e( 'Color', 'catalyst' ); ?><br />
						<?php if( defined( 'DYNAMIK_ACTIVE' ) ) { ?>
						<select id="background_image" name="background_image" size="1" style="width:230px; margin-bottom:10px;"><?php catalyst_list_images(); ?></select> <?php _e( 'Image', 'catalyst' ); ?><br />
						<input class="custom-css-builder-button-bgs custom-css-builder-buttons" type="button" value="Insert Image Background CSS" onclick="insertAtCaret(this.form.text, '\tbackground: #'+this.form.background_color.value+' url(images/'+this.form.background_image.value+') '+this.form.background_type.value+';\n')"><br />
						<?php } elseif( defined( 'VANILLA_ACTIVE' ) ) { ?>
						<script type="text/javascript">
							var ImagesUrl = ' url(<?php echo get_stylesheet_directory_uri() . '/css/images/'; ?>';
						</script>
						<select id="background_image" name="background_image" size="1" style="width:230px; margin-bottom:10px;"><?php catalyst_list_images(); ?></select> <?php _e( 'Image', 'catalyst' ); ?><br />
						<input class="custom-css-builder-button-bgs custom-css-builder-buttons" type="button" value="Insert Image Background CSS" onclick="insertAtCaret(this.form.text, '\tbackground: #'+this.form.background_color.value+ImagesUrl+this.form.background_image.value+') '+this.form.background_type.value+';\n')"><br />
						<?php } else { ?>
						<input type="text" id="background_image" name="background_image" value="" style="width:230px; margin-bottom:10px;" /> <?php _e( 'Image Path*', 'catalyst' ); ?><br />
						<span style="margin-top:-5px; float: left;"><?php _e( '*Either full URL or relative (eg. images/image-name.jpg)', 'catalyst' ); ?></span><br />
						<input class="custom-css-builder-button-bgs custom-css-builder-buttons" type="button" value="Insert Image Background CSS" onclick="insertAtCaret(this.form.text, '\tbackground: #'+this.form.background_color.value+' url('+this.form.background_image.value+') '+this.form.background_type.value+';\n')"><br />
						<?php } ?>
						
						<input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box-230" id="background_color2" name="background_color2" value="" style="margin-bottom:10px;" /> <?php _e( 'Color', 'catalyst' ); ?><br />
						<input class="custom-css-builder-button-bgs custom-css-builder-buttons" type="button" value="Insert Color Background CSS" onclick="insertAtCaret(this.form.text, '\tbackground: #'+this.form.background_color2.value+';\n')"><br />
						
						<input class="custom-css-builder-button-bgs custom-css-builder-buttons" type="button" value="Insert Transparent Background CSS" onclick="insertAtCaret(this.form.text, '\tbackground: transparent;\n')"><br />
						
						<?php _e( 'Gradients? Check out this', 'catalyst' ); ?> <a href="http://www.colorzilla.com/gradient-editor/" target="_blank"><?php _e( 'CSS Gradient Generator &raquo;', 'catalyst' ); ?></a>
					</p>
				</div>
				
				<div id="custom-css-builder-nav-borders-box" class="catalyst-all-css-builder">
					<p style="float:left;">
						<?php _e( 'Type', 'catalyst' ); ?>
						<select id="border_type" name="border_type" size="1" style="width:100px;">
							<option value="border"><?php _e( 'Full', 'catalyst' ); ?></option>
							<option value="border-top"><?php _e( 'Top', 'catalyst' ); ?></option>
							<option value="border-bottom"><?php _e( 'Bottom', 'catalyst' ); ?></option>
							<option value="border-left"><?php _e( 'Left', 'catalyst' ); ?></option>
							<option value="border-right"><?php _e( 'Right', 'catalyst' ); ?></option>
						</select>
						<?php _e( 'Thickness', 'catalyst' ); ?>
						<input type="text" id="border_thickness" name="border_thickness" value="0" style="width:35px;" /><?php _e( 'px', 'catalyst' ); ?><br />
						<?php _e( 'Style', 'catalyst' ); ?>
						<select id="border_style" name="border_style" size="1" style="width:100px;">
							<?php catalyst_list_borders(); ?>
						</select>
						<?php _e( 'Color', 'catalyst' ); ?>
						<input type="text" class="color {pickerFaceColor:'#FFFFFF'}" style="width:70px;" id="border_color" name="border_color" value="" /><br />
						<input class="custom-css-builder-button-bgs custom-css-builder-buttons" type="button" value="Insert Border CSS" style="margin-top:10px;" onclick="insertAtCaret(this.form.text, '\t'+this.form.border_type.value+': '+this.form.border_thickness.value+'px '+this.form.border_style.value+' #'+this.form.border_color.value+';\n')"><br />
					
						<?php _e( 'Tp-Lft', 'catalyst' ); ?>
						<input type="text" id="border_radius_top" name="border_radius_top" value="0" style="width:30px;" />
						<?php _e( 'Tp-Rt', 'catalyst' ); ?>
						<input type="text" id="border_radius_right" name="border_radius_right" value="0" style="width:30px;" />
						<?php _e( 'Btm-Rt', 'catalyst' ); ?>
						<input type="text" id="border_radius_bottom" name="border_radius_bottom" value="0" style="width:30px;" />
						<?php _e( 'Btm-Lft', 'catalyst' ); ?>
						<input type="text" id="border_radius_left" name="border_radius_left" value="0" style="width:30px; margin-bottom:10px;" /><br />
						<input class="custom-css-builder-button-bgs custom-css-builder-buttons" type="button" value="Insert Border Radius CSS (in pixels)" onclick="insertAtCaret(this.form.text, '\t-webkit-border-radius: '+this.form.border_radius_top.value+'px '+this.form.border_radius_right.value+'px '+this.form.border_radius_bottom.value+'px '+this.form.border_radius_left.value+'px;\n\tborder-radius: '+this.form.border_radius_top.value+'px '+this.form.border_radius_right.value+'px '+this.form.border_radius_bottom.value+'px '+this.form.border_radius_left.value+'px;\n')">
					</p>
				</div>
				
				<div id="custom-css-builder-nav-margins-padding-box" class="catalyst-all-css-builder">
					<p style="float:left;">
						<?php _e( 'Top', 'catalyst' ); ?>
						<input type="text" id="margin_top" name="margin_top" value="0" style="width:35px;" />
						<?php _e( 'Right', 'catalyst' ); ?>
						<input type="text" id="margin_right" name="margin_right" value="0" style="width:35px;" />
						<?php _e( 'Bottom', 'catalyst' ); ?>
						<input type="text" id="margin_bottom" name="margin_bottom" value="0" style="width:35px;" />
						<?php _e( 'Left', 'catalyst' ); ?>
						<input type="text" id="margin_left" name="margin_left" value="0" style="width:35px; margin-bottom:10px;" /><br />
						<input class="custom-css-builder-button-bgs custom-css-builder-buttons" type="button" value="Insert Margin CSS" onclick="insertAtCaret(this.form.text, '\tmargin: '+this.form.margin_top.value+'px '+this.form.margin_right.value+'px '+this.form.margin_bottom.value+'px '+this.form.margin_left.value+'px;\n')"><br />

						<?php _e( 'Top', 'catalyst' ); ?>
						<input type="text" id="padding_top" name="padding_top" value="0" style="width:35px;" />
						<?php _e( 'Right', 'catalyst' ); ?>
						<input type="text" id="padding_right" name="padding_right" value="0" style="width:35px;" />
						<?php _e( 'Bottom', 'catalyst' ); ?>
						<input type="text" id="padding_bottom" name="padding_bottom" value="0" style="width:35px;" />
						<?php _e( 'Left', 'catalyst' ); ?>
						<input type="text" id="padding_left" name="padding_left" value="0" style="width:35px; margin-bottom:10px;" /><br />
						<input class="custom-css-builder-button-bgs custom-css-builder-buttons" type="button" value="Insert Padding CSS" onclick="insertAtCaret(this.form.text, '\tpadding: '+this.form.padding_top.value+'px '+this.form.padding_right.value+'px '+this.form.padding_bottom.value+'px '+this.form.padding_left.value+'px;\n')">
					</p>
				</div>

				<div id="custom-css-builder-nav-fonts-box" class="catalyst-all-css-builder catalyst-options-display">
					<p style="float:left;">
						<input id="font-type-button" class="custom-css-builder-button custom-css-builder-buttons" type="button" value="Insert Font Type" onclick="insertAtCaret(this.form.text, '\tfont-family: '+this.form.font_type.value+';\n')">
						<select id="font_type" name="font_type" size="1" style="width:150px;">
							<option value="Arial, sans-serif"><?php _e( 'Arial', 'catalyst' ); ?></option>
							<option value="'Arial Black', sans-serif"><?php _e( 'Arial Black', 'catalyst' ); ?></option>
							<option value="'Courier New', sans-serif"><?php _e( 'Courier New', 'catalyst' ); ?></option>
							<option value="Georgia, serif"><?php _e( 'Georgia', 'catalyst' ); ?></option>
							<option value="Helvetica, sans-serif"><?php _e( 'Helvetica', 'catalyst' ); ?></option>
							<option value="Impact, sans-serif"><?php _e( 'Impact', 'catalyst' ); ?></option>
							<option value="'Lucida Console', sans-serif"><?php _e( 'Lucida Console', 'catalyst' ); ?></option>
							<option value="'Lucida Sans Unicode', sans-serif"><?php _e( 'Lucida Sans Unicode', 'catalyst' ); ?></option>
							<option value="Tahoma, sans-serif"><?php _e( 'Tahoma', 'catalyst' ); ?></option>
							<option value="'Times New Roman', serif"><?php _e( 'Times New Roman', 'catalyst' ); ?></option>
							<option value="'Trebuchet MS', sans-serif"><?php _e( 'Trebuchet MS', 'catalyst' ); ?></option>
							<option value="Verdana, sans-serif"><?php _e( 'Verdana', 'catalyst' ); ?></option>
						</select><br />
						<input class="custom-css-builder-button custom-css-builder-buttons" type="button" value="Insert Font Size" onclick="insertAtCaret(this.form.text, '\tfont-size: '+this.form.font_size.value+'px;\n')">
						<input type="text" id="font_size" name="font_size" value="12" style="width:35px;" /><?php _e( 'px', 'catalyst' ); ?> (<a href="http://pxtoem.com/" target="_blank">convert px to em</a>)<br />
						<input class="custom-css-builder-button custom-css-builder-buttons" type="button" value="Insert Font Color" onclick="insertAtCaret(this.form.text, '\tcolor: #'+this.form.font_color.value+';\n')">
						<input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box-150" id="font_color" name="font_color" value="" /><br />
						<input class="custom-css-builder-button custom-css-builder-buttons" type="button" value="Insert Font Weight" onclick="insertAtCaret(this.form.text, '\tfont-weight: '+this.form.font_weight.value+';\n')">
						<select id="font_weight" name="font_weight" size="1" class="iewide" style="width:150px;">
							<option value="normal"><?php _e( 'Normal', 'catalyst' ); ?></option>
							<option value="bold"><?php _e( 'Bold', 'catalyst' ); ?></option>
						</select><br />
						<input class="custom-css-builder-button custom-css-builder-buttons" type="button" value="Insert Font Style" onclick="insertAtCaret(this.form.text, '\tfont-style: '+this.form.font_style.value+';\n')">
						<select id="font_style" name="font_style" size="1" class="iewide" style="width:150px;">
							<option value="normal"><?php _e( 'Normal', 'catalyst' ); ?></option>
							<option value="italic"><?php _e( 'Italic', 'catalyst' ); ?></option>
						</select><br />
						<input class="custom-css-builder-button custom-css-builder-buttons" type="button" value="Insert Text Align" onclick="insertAtCaret(this.form.text, '\ttext-align: '+this.form.text_align.value+';\n')">
						<select id="text_align" name="text_align" size="1" class="iewide" style="width:150px;">
							<option value="left"><?php _e( 'Left', 'catalyst' ); ?></option>
							<option value="center"><?php _e( 'Center', 'catalyst' ); ?></option>
							<option value="right"><?php _e( 'Right', 'catalyst' ); ?></option>
						</select><br />
						<input class="custom-css-builder-button custom-css-builder-buttons" type="button" value="Insert Transform" onclick="insertAtCaret(this.form.text, '\ttext-transform: '+this.form.font_caps.value+';\n')">
						<select id="font_caps" name="font_caps" size="1" class="iewide" style="width:150px;">
							<option value="none"><?php _e( 'None', 'catalyst' ); ?></option>
							<option value="uppercase"><?php _e( 'Uppercase', 'catalyst' ); ?></option>
							<option value="lowercase"><?php _e( 'Lowercase', 'catalyst' ); ?></option>
							<option value="capitalize"><?php _e( 'Capitalize', 'catalyst' ); ?></option>
						</select><br />
						<input class="custom-css-builder-button custom-css-builder-buttons" type="button" value="Insert Letter Spacing" onclick="insertAtCaret(this.form.text, '\tletter-spacing: '+this.form.letter_spacing.value+';\n')">
						<select id="letter_spacing" name="letter_spacing" size="1" class="iewide" style="width:150px;">
							<option value=".5px"><?php _e( '.5px', 'catalyst' ); ?></option>
							<option value="1px"><?php _e( '1px', 'catalyst' ); ?></option>
							<option value="1.5px"><?php _e( '1.5px', 'catalyst' ); ?></option>
							<option value="2px"><?php _e( '2px', 'catalyst' ); ?></option>
							<option value="2.5px"><?php _e( '2.5px', 'catalyst' ); ?></option>
							<option value="3px"><?php _e( '3px', 'catalyst' ); ?></option>
							<option value="3.5px"><?php _e( '3.5px', 'catalyst' ); ?></option>
							<option value="4px"><?php _e( '4px', 'catalyst' ); ?></option>
						</select><br />
						<input class="custom-css-builder-button custom-css-builder-buttons" type="button" value="Insert Line Height" onclick="insertAtCaret(this.form.text, '\tline-height: '+this.form.line_height.value+';\n')">
						<select id="line_height" name="line_height" size="1" class="iewide" style="width:150px;">
							<option value="100%"><?php _e( '100%', 'catalyst' ); ?></option>
							<option value="110%"><?php _e( '110%', 'catalyst' ); ?></option>
							<option value="120%"><?php _e( '120%', 'catalyst' ); ?></option>
							<option value="130%"><?php _e( '130%', 'catalyst' ); ?></option>
							<option value="140%"><?php _e( '140%', 'catalyst' ); ?></option>
							<option value="150%"><?php _e( '150%', 'catalyst' ); ?></option>
							<option value="160%"><?php _e( '160%', 'catalyst' ); ?></option>
							<option value="170%"><?php _e( '170%', 'catalyst' ); ?></option>
							<option value="180%"><?php _e( '180%', 'catalyst' ); ?></option>
							<option value="190%"><?php _e( '190%', 'catalyst' ); ?></option>
							<option value="200%"><?php _e( '200%', 'catalyst' ); ?></option>
						</select><br />
						<input class="custom-css-builder-button custom-css-builder-buttons" type="button" value="Insert Txt Decoration" onclick="insertAtCaret(this.form.text, '\ttext-decoration: '+this.form.text_decoration.value+';\n')">
						<select id="text_decoration" name="text_decoration" size="1" class="iewide" style="width:150px;">
							<option value="none"><?php _e( 'none', 'catalyst' ); ?></option>
							<option value="underline"><?php _e( 'underline', 'catalyst' ); ?></option>
							<option value="overline"><?php _e( 'overline', 'catalyst' ); ?></option>
							<option value="line-through"><?php _e( 'line-through', 'catalyst' ); ?></option>
							<option value="blink"><?php _e( 'blink', 'catalyst' ); ?></option>
							<option value="inherit"><?php _e( 'inherit', 'catalyst' ); ?></option>
						</select><br />
					</p>
				</div>

				<div id="custom-css-builder-nav-dimensions-position-box" class="catalyst-all-css-builder">
					<p style="float:left;">		
						<input class="custom-css-builder-button custom-css-builder-buttons" type="button" value="Insert Width CSS" onclick="insertAtCaret(this.form.text, '\twidth: '+this.form.width.value+'px;\n')">
						<input type="text" id="width" name="width" value="" style="width:40px;" /><?php _e( 'px', 'catalyst' ); ?><br />
						<input class="custom-css-builder-button custom-css-builder-buttons" type="button" value="Insert Height CSS" onclick="insertAtCaret(this.form.text, '\theight: '+this.form.height.value+'px;\n')">
						<input type="text" id="height" name="height" value="" style="width:40px;" /><?php _e( 'px', 'catalyst' ); ?><br />
						<input class="custom-css-builder-button custom-css-builder-buttons" type="button" value="Insert Float CSS" onclick="insertAtCaret(this.form.text, '\tfloat: '+this.form.float_direction.value+';\n')">
						<select id="float_direction" name="float_direction" size="1" class="iewide" style="width:100px;">
							<option value="none"><?php _e( 'None', 'catalyst' ); ?></option>
							<option value="left"><?php _e( 'Left', 'catalyst' ); ?></option>
							<option value="right"><?php _e( 'Right', 'catalyst' ); ?></option>
						</select><br />
						<input class="custom-css-builder-button custom-css-builder-buttons" type="button" value="Insert Position" onclick="insertAtCaret(this.form.text, '\tposition: '+this.form.position.value+';\n')">
						<select id="position" name="position" size="1" class="iewide" style="width:150px;">
							<option value="absolute"><?php _e( 'absolute', 'catalyst' ); ?></option>
							<option value="fixed"><?php _e( 'fixed', 'catalyst' ); ?></option>
							<option value="relative"><?php _e( 'relative', 'catalyst' ); ?></option>
							<option value="static"><?php _e( 'static', 'catalyst' ); ?></option>
							<option value="inherit"><?php _e( 'inherit', 'catalyst' ); ?></option>
						</select><br />
						<input class="custom-css-builder-button custom-css-builder-buttons" type="button" value="Insert Display" onclick="insertAtCaret(this.form.text, '\tdisplay: '+this.form.display.value+';\n')">
						<select id="display" name="display" size="1" class="iewide" style="width:150px;">
							<option value="none"><?php _e( 'none', 'catalyst' ); ?></option>
							<option value="block"><?php _e( 'block', 'catalyst' ); ?></option>
							<option value="inline"><?php _e( 'inline', 'catalyst' ); ?></option>
							<option value="inline-block"><?php _e( 'inline-block', 'catalyst' ); ?></option>
							<option value="inline-table"><?php _e( 'inline-table', 'catalyst' ); ?></option>
							<option value="list-item"><?php _e( 'list-item', 'catalyst' ); ?></option>
							<option value="run-in"><?php _e( 'run-in', 'catalyst' ); ?></option>
							<option value="table"><?php _e( 'table', 'catalyst' ); ?></option>
							<option value="table-caption"><?php _e( 'table-caption', 'catalyst' ); ?></option>
							<option value="table-cell"><?php _e( 'table-cell', 'catalyst' ); ?></option>
							<option value="table-column"><?php _e( 'table-column', 'catalyst' ); ?></option>
							<option value="table-column-group"><?php _e( 'table-column-group', 'catalyst' ); ?></option>
							<option value="table-footer-group"><?php _e( 'table-footer-group', 'catalyst' ); ?></option>
							<option value="table-header-group"><?php _e( 'table-header-group', 'catalyst' ); ?></option>
							<option value="table-row"><?php _e( 'table-row', 'catalyst' ); ?></option>
							<option value="table-row-group"><?php _e( 'table-row-group', 'catalyst' ); ?></option>
							<option value="inherit"><?php _e( 'inherit', 'catalyst' ); ?></option>
						</select>
					</p>
				</div>
				
				<div id="custom-css-builder-nav-shadows-box" class="catalyst-all-css-builder">
					<p style="float:left;">
						<?php _e( 'Lft-Rt', 'catalyst' ); ?>
						<input type="text" id="box_shadow_lr" name="box_shadow_lr" value="0" style="width:40px;" />
						<?php _e( 'Tp-Btm', 'catalyst' ); ?>
						<input type="text" id="box_shadow_tb" name="box_shadow_tb" value="0" style="width:40px;" /><br />
						<?php _e( 'Blur', 'catalyst' ); ?>
						<input type="text" id="box_shadow_blur" name="box_shadow_blur" value="0" style="width:30px;" />
						<?php _e( 'Spread', 'catalyst' ); ?>
						<input type="text" id="box_shadow_spread" name="box_shadow_spread" value="0" style="width:30px; margin-bottom:10px;" />
						<?php _e( 'Color', 'catalyst' ); ?>
						<input type="text" class="color {pickerFaceColor:'#FFFFFF'}" style="width:70px;" id="box_shadow_color" name="box_shadow_color" value="" style="margin-bottom:10px;"/><br />
						<input class="custom-css-builder-button-bgs custom-css-builder-buttons" type="button" value="Insert Box Shadow CSS (in pixels)" onclick="insertAtCaret(this.form.text, '\t-webkit-box-shadow: '+this.form.box_shadow_lr.value+'px '+this.form.box_shadow_tb.value+'px '+this.form.box_shadow_blur.value+'px '+this.form.box_shadow_spread.value+'px #'+this.form.box_shadow_color.value+';\n\tbox-shadow: '+this.form.box_shadow_lr.value+'px '+this.form.box_shadow_tb.value+'px '+this.form.box_shadow_blur.value+'px '+this.form.box_shadow_spread.value+'px #'+this.form.box_shadow_color.value+';\n')"><br />
						
						<?php _e( 'Lft-Rt', 'catalyst' ); ?>
						<input type="text" id="text_shadow_lr" name="text_shadow_lr" value="0" style="width:40px;" />
						<?php _e( 'Tp-Btm', 'catalyst' ); ?>
						<input type="text" id="text_shadow_tb" name="text_shadow_tb" value="0" style="width:40px;" /><br />
						<?php _e( 'Blur', 'catalyst' ); ?>
						<input type="text" id="text_shadow_blur" name="text_shadow_blur" value="0" style="width:30px; margin-bottom:10px;" />
						<?php _e( 'Color', 'catalyst' ); ?>
						<input type="text" class="color {pickerFaceColor:'#FFFFFF'}" style="width:70px;" id="text_shadow_color" name="text_shadow_color" value="" style="margin-bottom:10px;"/><br />
						<input class="custom-css-builder-button-bgs custom-css-builder-buttons" type="button" value="Insert Text Shadow CSS (in pixels)" onclick="insertAtCaret(this.form.text, '\ttext-shadow: '+this.form.text_shadow_lr.value+'px '+this.form.text_shadow_tb.value+'px '+this.form.text_shadow_blur.value+'px #'+this.form.text_shadow_color.value+';\n')">
					</p>
				</div>

				<div id="custom-css-builder-nav-widgets-box" class="catalyst-all-css-builder">
					<p style="float:left; margin-bottom:0;">
						<span style="font-weight:bold;"><?php _e( 'Class:', 'catalyst' ); ?></span>
						<select id="widget_class" name="widget_class" size="1" class="iewide" style="width:273px; margin-bottom:5px;">
							<?php catalyst_widget_class_dropdown(); ?>
						</select><br />
						
						<span style="font-weight:bold;"><?php _e( 'Width Calc:', 'catalyst' ); ?></span> <?php _e( '("Parent" = Widget Area Container)', 'catalyst' ); ?><br />
						<?php _e( 'Parent Width', 'catalyst' ); ?>
						<input type="text" class="custom-widget-width-option" id="site_width" name="site_width" value="0" style="width:45px; margin-top:5px;" /> |
						<?php _e( '# of Horizontal Widgets', 'catalyst' ); ?>
						<input type="text" class="custom-widget-width-option" id="widgets_number" name="widgets_number" value="0" style="width:35px; margin-bottom:10px;" /><br />
						
						<span style="font-weight:bold;"><?php _e( 'Border:', 'catalyst' ); ?></span>
						<?php _e( 'Type', 'catalyst' ); ?>
						<select class="custom-widget-width-option" id="widget_border_type" name="widget_border_type" size="1" style="width:80px;">
							<option value="border"><?php _e( 'Full', 'catalyst' ); ?></option>
							<option value="border-top"><?php _e( 'Top', 'catalyst' ); ?></option>
							<option value="border-bottom"><?php _e( 'Bottom', 'catalyst' ); ?></option>
							<option value="border-left"><?php _e( 'Left', 'catalyst' ); ?></option>
							<option value="border-right"><?php _e( 'Right', 'catalyst' ); ?></option>
						</select>
						<?php _e( 'Thickness', 'catalyst' ); ?>
						<input type="text" class="custom-widget-width-option" id="widget_border_thickness" name="widget_border_thickness" value="0" style="width:35px;" /><?php _e( 'px', 'catalyst' ); ?><br />
						<?php _e( 'Style', 'catalyst' ); ?>
						<select id="widget_border_style" name="widget_border_style" size="1" style="width:80px;">
							<?php catalyst_list_borders(); ?>
						</select>
						<?php _e( 'Color', 'catalyst' ); ?>
						<input type="text" class="color {pickerFaceColor:'#FFFFFF'}" style="width:70px;" id="widget_border_color" name="widget_border_color" value="" style="margin-bottom:10px;"/><br />
						
						<span style="font-weight:bold;"><?php _e( 'Margin:', 'catalyst' ); ?></span>
						<?php _e( 'Top', 'catalyst' ); ?><input type="text" id="widget_margin_top" name="widget_margin_top" value="0" style="width:35px;" />
						<?php _e( 'Rt', 'catalyst' ); ?><input type="text" class="custom-widget-width-option" id="widget_margin_right" name="widget_margin_right" value="0" style="width:35px;" />
						<?php _e( 'Btm', 'catalyst' ); ?><input type="text" id="widget_margin_bottom" name="widget_margin_bottom" value="0" style="width:35px;" />
						<?php _e( 'Lft', 'catalyst' ); ?><input type="text" class="custom-widget-width-option" id="widget_margin_left" name="widget_margin_left" value="0" style="width:35px;" /><br />

						<span style="font-weight:bold;"><?php _e( 'Padding:', 'catalyst' ); ?></span>
						<?php _e( 'Top', 'catalyst' ); ?><input type="text" id="widget_padding_top" name="widget_padding_top" value="0" style="width:35px;" />
						<?php _e( 'Rt', 'catalyst' ); ?><input class="custom-widget-width-option" type="text" id="widget_padding_right" name="widget_padding_right" value="0" style="width:35px;" />
						<?php _e( 'Btm', 'catalyst' ); ?><input type="text" id="widget_padding_bottom" name="widget_padding_bottom" value="0" style="width:35px;" />
						<?php _e( 'Lft', 'catalyst' ); ?><input class="custom-widget-width-option" type="text" id="widget_padding_left" name="widget_padding_left" value="0" style="width:35px; margin-bottom:10px;" /><br />
						
						<span style="font-weight:bold;"><?php _e( 'Widget Width:', 'catalyst' ); ?></span>
						<input type="text" id="widget_width" name="widget_width" value="0" style="width:45px;" readonly="readonly" /><?php _e( 'px', 'catalyst' ); ?>
						<span style="font-weight:bold;"><?php _e( 'Float:', 'catalyst' ); ?></span>
						<select id="widget_float_direction" name="widget_float_direction" size="1" class="iewide" style="width:60px; margin-bottom:10px;">
							<option value="left"><?php _e( 'Left', 'catalyst' ); ?></option>
							<option value="right"><?php _e( 'Right', 'catalyst' ); ?></option>
							<option value="none"><?php _e( 'None', 'catalyst' ); ?></option>
						</select><br />
						<input class="custom-css-builder-button-bgs custom-css-builder-buttons" type="button" value="Insert Custom Widget Area CSS" onclick="insertAtCaret(this.form.text, '.'+this.form.widget_class.value+' {\n\twidth: '+this.form.widget_width.value+'px;\n\tfloat: '+this.form.widget_float_direction.value+';\n\t'+this.form.widget_border_type.value+': '+this.form.widget_border_thickness.value+'px '+this.form.widget_border_style.value+' #'+this.form.widget_border_color.value+';\n\tmargin: '+this.form.widget_margin_top.value+'px '+this.form.widget_margin_right.value+'px '+this.form.widget_margin_bottom.value+'px '+this.form.widget_margin_left.value+'px;\n\tpadding: '+this.form.widget_padding_top.value+'px '+this.form.widget_padding_right.value+'px '+this.form.widget_padding_bottom.value+'px '+this.form.widget_padding_left.value+'px;\n}\n')">
					</p>
				</div>

				<div id="css-builder-output-wrap">
					<textarea wrap="off" id="css-builder-output" name="text"></textarea>
					<input id="css-builder-output-insert" type="button" value="Click To Insert Into Custom CSS Editor &raquo;">
					<input id="css-builder-output-insert-alt" type="button" value="Click To Highlight Custom CSS For Copy/Paste">
				</div>
			</div>
		</form>
		</div>
	</div>
</div>