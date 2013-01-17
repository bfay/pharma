
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

				case "close": ?>

							<br style="clear: both" />
						</div>
					</div>
				<?php break;

				/*-------------------------------------------------------------
				*   Layouts
				*------------------------------------------------------------*/
				case "layouts": ?>

							<?php $layout_options = framework_get_option('layout'); ?>
							<div class="option-inputs">
								<label for="<?php echo $option['id']; ?>"><?php echo $option['name']; ?></label><br/>
								<select class="togglethis noautosave" id="<?php echo $option['id']; ?>">
									<?php foreach ( $option['layouts'] as $value => $text ) : ?>

										<option value="layout-<?php echo $value; ?>"><?php echo $text; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<br style="clear: both" />

							<?php $count = 0; foreach ( $option['layouts'] as $value => $text ) : $count++; ?>

							<div class="option-layout layout-<?php echo $value; ?><?php if($count == 1) : ?> toggle_show<?php else: ?> toggle_hide<?php endif; ?>">

								<?php foreach ( $option['options'] as $option_id => $option_name ) : ?>
								<?php $selected = $layout_options[$value] == $option_id ? ' checked="checked"' : ''; ?>
								<?php $active = $layout_options[$value] == $option_id ? 'active' : ''; ?>

								<div class="layout-image <?php echo $option_id; ?>">
									<input class="layout-input" id="<?php echo $option['id'] . '['.$value.']['.$option_id.']'; ?>" name="<?php echo SHORTNAME_SETTINGS . '[layout][' . $value . ']'; ?>" value="<?php echo $option_id; ?>" type="radio"<?php echo $selected; ?> />
									<label for="<?php echo $option['id'] . '['.$value.']['.$option_id.']'; ?>" class="<?php echo $active; ?>"><?php echo $option_name; ?></label>
									<span class="layout-title"><?php echo $option_name; ?><br />&nbsp;</span>
								</div>

								<?php endforeach; ?>

								<br style="clear: both" />
							</div>

							<?php endforeach; ?>

				<?php break;

				/*-------------------------------------------------------------
				*   Info design
				*------------------------------------------------------------*/
				case "info": ?>

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