			<?php foreach( $tab_options as $option ) : ?>
				<?php switch( $option['type'] ) :

				/*-------------------------------------------------------------
				*   Design for open/close
				*------------------------------------------------------------*/
				case "open": ?>

					<div class="fpOption">
						<div class="option-title">
							<strong><?php echo $option['name']; ?></strong><br />
							<small><?php echo $option['desc']; ?></small>
						</div>

						<div class="option-content">
				<?php break;

				case "open-inputs": ?>
							<div class="option-inputs">
				<?php break;

				case "open-inputs-full": ?>

							<div class="option-inputs option-inputs-full">
				<?php break;

				case "close-inputs": ?>

							</div>
				<?php break;

				case "close": ?>

							<br style="clear: both" />
						</div>
					</div>
				<?php break;

				/*-------------------------------------------------------------
				*   Hidden input
				*------------------------------------------------------------*/
				case "hidden": ?>

								<input name="<?php echo SHORTNAME_SETTINGS . '[' . $option['id'] . ']'; ?>" value="<?php echo framework_get_option($option['id']); ?>" id="<?php echo $option['id']; ?>" />
				<?php break;

				/*-------------------------------------------------------------
				*   Text input
				*------------------------------------------------------------*/
				case "text": ?>

								<label for="<?php echo $option['id']; ?>"><?php echo $option['name']; ?></label><br/>
								<input class="regular-text" type="text" name="<?php echo SHORTNAME_SETTINGS . '[' . $option['id'] . ']'; ?>" value="<?php echo framework_get_option($option['id']); ?>" id="<?php echo $option['id']; ?>" /><br /><br />
				<?php break;

				/*-------------------------------------------------------------
				*   Tiny text input
				*------------------------------------------------------------*/
				case "tiny-text": ?>

								<label for="<?php echo $option['id']; ?>"><?php echo $option['name']; ?></label><br/>
								<input class="regular-text tiny-text" type="text" name="<?php echo SHORTNAME_SETTINGS . '[' . $option['id'] . ']'; ?>" value="<?php echo framework_get_option($option['id']); ?>" id="<?php echo $option['id']; ?>" /><br /><br />
				<?php break;

				/*-------------------------------------------------------------
				*   Textarea input
				*------------------------------------------------------------*/
				case "textarea": ?>

								<label for="<?php echo $option['id']; ?>"><?php echo $option['name']; ?></label><br/>
								<textarea class="html-textarea" name="<?php echo SHORTNAME_SETTINGS . '[' . $option['id'] . ']'; ?>" id="<?php echo $option['id']; ?>" cols="40" rows="5"><?php echo framework_get_option($option['id']); ?></textarea><br /><br />
				<?php break;

				/*-------------------------------------------------------------
				*   Select input
				*------------------------------------------------------------*/
				case "select": ?>

								<label for="<?php echo $option['id']; ?>"><?php echo $option['name']; ?></label><br/>
								<select name="<?php echo SHORTNAME_SETTINGS . '[' . $option['id'] . ']'; ?>" id="<?php echo $option['id']; ?>">
									<?php foreach ( $option['select'] as $value => $text ) : ?>
										<?php $selected = framework_get_option($option['id']) == $value ? ' selected="selected"' : ''; ?>

										<option value="<?php echo $value; ?>"<?php echo $selected; ?>><?php echo $text; ?></option>
									<?php endforeach; ?>

								</select>
								<br style="clear: both" />
				<?php break;

				/*-------------------------------------------------------------
				*   Checkbox input
				*------------------------------------------------------------*/
				case "checkbox": ?>
								<?php $selected = framework_get_option($option['id']) ? ' checked="yes"' : ''; ?>

								<input name="<?php echo SHORTNAME_SETTINGS . '[' . $option['id'] . ']'; ?>" id="<?php echo $option['id']; ?>" type="checkbox"<?php echo $selected; ?> />
								<label for="<?php echo $option['id']; ?>" class="labelcheckbox"><?php echo $option['name']; ?></label>
								<br style="clear: both" />
				<?php break;

				/*-------------------------------------------------------------
				*   Radio input
				*------------------------------------------------------------*/
				case "radio": ?>
								<?php $selected = framework_get_option($option['id']) == $option['value'] ? ' checked="checked"' : ''; ?>
								<?php $random = rand(); ?>
								<input name="<?php echo SHORTNAME_SETTINGS . '[' . $option['id'] . ']'; ?>" id="<?php echo $option['id']; ?>-<?php echo $random; ?>" value="<?php echo $option['value']; ?>" type="radio"<?php echo $selected; ?> />
								<label for="<?php echo $option['id']; ?>-<?php echo $random; ?>" class="labelcheckbox"><?php echo $option['name']; ?></label>
								<br style="clear: both" />
				<?php break;

				/*-------------------------------------------------------------
				*   Font select
				*------------------------------------------------------------*/
				case "font": ?>

								<?php $font_options = framework_get_option($option['id']); ?>
								<div class="option-font">
									<label for="<?php echo $option['id']; ?>"><?php echo $option['name']; ?></label><br />
									<select class="noautosave" title="font-family" name="<?php echo SHORTNAME_SETTINGS . '[' . $option['id'] . '][font-family]'; ?>">
										<?php global $framework_font_family; ?>
										<?php foreach ( $framework_font_family as $optgroup ) : ?>

										<optgroup label="<?php echo $optgroup['name']; ?>">
											<?php foreach ( $optgroup['fonts'] as $value => $title ) : ?>
											<?php $selected = $font_options['font-family'] == $value ? ' selected="selected"' : ''; ?>

											<option value="<?php echo $value; ?>" title="<?php echo $title; ?>"<?php echo $selected; ?>><?php echo str_replace('+', ' ', $title); ?></option>
											<?php endforeach; ?>
										</optgroup>
										<?php endforeach; ?>
									</select><br />


									<link href="http://fonts.googleapis.com/css?family=<?php echo $font_options['font-family']; ?>" rel="stylesheet" type="text/css" />
									<label>Preview</label><br />
									<div style="font-family: <?php echo $font_options['font-family']; ?>; font-size: <?php echo $font_options['font-size']; ?>; letter-spacing: <?php echo $font_options['letter-spacing']; ?>; text-transform: <?php echo $font_options['text-transform']; ?>; text-decoration: <?php echo $font_options['text-decoration']; ?>; font-style: <?php echo $font_options['font-style']; ?>; font-weight: <?php echo $font_options['font-weight']; ?>;" class="font-preview">
										Lorem Ipsum is simply dummy 1895
									</div><br />

									<span class="button editfont">Edit Font Styling</span>

									<div class="option-font-style" style="display: none;">
										<table>
										<tr>
											<td>
												<span>Letter Spacing</span><br />
												<select class="noautosave" title="letter-spacing" name="<?php echo SHORTNAME_SETTINGS . '[' . $option['id'] . '][letter-spacing]'; ?>">

												<?php global $framework_font_letter_spacing; ?>
												<?php foreach ( $framework_font_letter_spacing as $letter_spacing ) : ?>
													<?php $selected = $font_options['letter-spacing'] == $letter_spacing ? ' selected="selected"' : ''; ?>
													<?php if( ($letter_spacing == "0.00em") && (!$font_options['letter-spacing']) ) $selected = ' selected="selected"'; ?>

													<option value="<?php echo $letter_spacing; ?>"<?php echo $selected; ?>><?php echo $letter_spacing; ?></option>
												<?php endforeach; ?>

												</select>
											</td>
	
											<td>
												<span>Text Transform</span><br />
												<select class="noautosave" title="text-transform" name="<?php echo SHORTNAME_SETTINGS . '[' . $option['id'] . '][text-transform]'; ?>">

												<?php global $framework_font_text_transform; ?>
												<?php foreach ( $framework_font_text_transform as $value => $title ) : ?>
													<?php $selected = $font_options['text-transform'] == $value ? ' selected="selected"' : ''; ?>

													<option value="<?php echo $value; ?>"<?php echo $selected; ?>><?php echo $title; ?></option>
												<?php endforeach; ?>

												</select>
											</td>

											<td>
												<span>Font Size</span><br />
												<select class="noautosave" title="font-size" name="<?php echo SHORTNAME_SETTINGS . '[' . $option['id'] . '][font-size]'; ?>">

												<?php global $framework_font_size; ?>
												<?php foreach ( $framework_font_size as $value ) : ?>
													<?php $selected = $font_options['font-size'] == $value ? ' selected="selected"' : ''; ?>

													<option value="<?php echo $value; ?>"<?php echo $selected; ?>><?php echo $value; ?></option>
												<?php endforeach; ?>

												</select>
											</td>
										</tr>

										<tr>
											<td>
												<span>Weight</span><br />
												<select class="noautosave" title="font-weight" name="<?php echo SHORTNAME_SETTINGS . '[' . $option['id'] . '][font-weight]'; ?>">

												<?php global $framework_font_weight; ?>
												<?php foreach ( $framework_font_weight as $value => $title ) : ?>
													<?php $selected = $font_options['font-weight'] == $value ? ' selected="selected"' : ''; ?>

													<option value="<?php echo $value; ?>"<?php echo $selected; ?>><?php echo $title; ?></option>
												<?php endforeach; ?>

												</select>
											</td>

											<td>
												<span>Style</span><br />
												<select class="noautosave" title="font-style" name="<?php echo SHORTNAME_SETTINGS . '[' . $option['id'] . '][font-style]'; ?>">

												<?php global $framework_font_style; ?>
												<?php foreach ( $framework_font_style as $value => $title ) : ?>
													<?php $selected = $font_options['font-style'] == $value ? ' selected="selected"' : ''; ?>

													<option value="<?php echo $value; ?>"<?php echo $selected; ?>><?php echo $title; ?></option>
												<?php endforeach; ?>

												</select>
											</td>

											<td>
												<span>Decoration</span><br />
												<select class="noautosave" title="text-decoration" name="<?php echo SHORTNAME_SETTINGS . '[' . $option['id'] . '][text-decoration]'; ?>">

												<?php global $framework_font_text_decoration; ?>
												<?php foreach ( $framework_font_text_decoration as $value => $title ) : ?>
													<?php $selected = $font_options['text-decoration'] == $value ? ' selected="selected"' : ''; ?>

													<option value="<?php echo $value; ?>"<?php echo $selected; ?>><?php echo $title; ?></option>
												<?php endforeach; ?>

												</select>
											</td>
										</tr>
										</table>
									</div>
								</div>
				<?php break;

				/*-------------------------------------------------------------
				*   Color Picker
				*------------------------------------------------------------*/
				case "colorpicker": ?>

								<div class="picker<?php if( isset($option['left']) ) : ?> pickerleft<?php endif; ?>">
									<label for="<?php echo $option['id']; ?>" class="colorpicker_label"><?php echo $option['name']; ?></label>
									<div id="<?php echo $option['id']; ?>_picker" class="colorSelector"><div style="background-color: rgb(0, 0, 0);"></div></div>
									<input class="colorpickerclass" name="<?php echo SHORTNAME_SETTINGS . '[' . $option['id'] . ']'; ?>" id="<?php echo $option['id']; ?>" value="<?php echo framework_get_option($option['id']); ?>" type="text" />
								</div>
				<?php break;

				/*-------------------------------------------------------------
				*   Upload
				*------------------------------------------------------------*/
				case "upload": ?>

								<label for="<?php echo $option['id']; ?>"><?php echo $option['name']; ?></label><br/>
								<input class="regular-text" type="text" name="<?php echo SHORTNAME_SETTINGS . '[' . $option['id'] . ']'; ?>" id="<?php echo $option['id']; ?>" value="<?php echo framework_get_option($option['id']); ?>" /><br /><br />
								<input id="<?php echo $option['id']; ?>_upload" type="file" />

								<div class="image-preview" id="<?php echo $option['id']; ?>_preview">
									<img src="<?php echo framework_get_option($option['id']); ?>" />
								</div>
				<?php break;

				/*-------------------------------------------------------------
				*   Info design
				*------------------------------------------------------------*/
				case "info": ?>

							<div class="option-info">
								<div class="title">More Info</div>
								<?php echo $option['info']; ?>

								<?php if( isset($option['example']) ) : ?>
								<div class="example">Example:<br> <strong><?php echo $option['example']; ?></strong></div>
								<?php endif; ?>
							</div>
				<?php break;

				/*  Large info  */
				case "large-info": ?>

							<div class="option-info option-info-large">
								<?php if( isset($option['example']) ) : ?>
								<div class="example">Example:<br> <strong><?php echo $option['example']; ?></strong></div>
								<?php endif; ?>

								<div class="title">More Info</div>
								<?php echo $option['info']; ?>
								<br style="clear: both" />
							</div>
				<?php break; ?>

				<?php endswitch; ?>
			<?php endforeach; ?>