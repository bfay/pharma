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
				*   Templatess
				*------------------------------------------------------------*/
				case "templates": ?>

							<div class="option-inputs">
								<label for="<?php echo $option['id']; ?>"><?php echo $option['name']; ?></label><br/>
								<select class="togglethis noautosave" id="<?php echo $option['id']; ?>">
									<?php foreach ( $option['templates'] as $template ) : ?>

										<option value="template-<?php echo $template['id']; ?>"><?php echo $template['name']; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<br style="clear: both" />

							<?php $count = 0; foreach ( $option['templates'] as $template ) : $count++; ?>
							<?php $db_template = framework_get_template($template['id']); ?>

							<div class="option-template template-<?php echo $template['id']; ?><?php if($count == 1) : ?> toggle_show<?php else: ?> toggle_hide<?php endif; ?>">
								<div class="template-section-name">Template section "<?php echo $template['name']; ?>"</div>
								<span class="section-name" title="<?php echo $template['id']; ?>"></span>

								<div class="active-sections">
									<div class="sections-name"><span>Active Sections</span></div>
									<div class="sections-list sections-list-active connectedSortable">

									<?php foreach ( $template['sections'] as $section ) : ?>
										<?php if ( ($db_template) && (framework_find_in($section['id'], $db_template)) ) : ?>

										<div class="section<?php if( isset($section['required']) ) : ?> section-required<?php endif; ?>" id="section_<?php echo $section['id']; ?>">
											<div class="section-name"><?php if( isset($section['required']) ) : ?><small>(required)</small><?php endif; ?><span><?php echo $section['name']; ?></span></div>
											<div class="section-description"><?php echo $section['desc']; ?></div>
										</div>

										<?php endif; ?>
									<?php endforeach; ?>

									</div>
								</div>

								<div class="available-sections">
									<div class="sections-name"><span>Available Sections</span></div>
									<div class="sections-list sections-list-available connectedSortable">

									<?php foreach ( $template['sections'] as $section ) : ?>
										<?php if ( (!$db_template) || (!framework_find_in($section['id'], $db_template)) ) : ?>

										<div class="section<?php if( isset($section['required']) ) : ?> section-required<?php endif; ?>" id="section_<?php echo $section['id']; ?>">
											<div class="section-name"><?php if( isset($section['required']) ) : ?><small>(required)</small><?php endif; ?><span><?php echo $section['name']; ?></span></div>
											<div class="section-description"><?php echo $section['desc']; ?></div>
										</div>

										<?php endif; ?>
									<?php endforeach; ?>

									</div>
								</div>

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