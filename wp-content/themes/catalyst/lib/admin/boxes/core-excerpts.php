<?php
/**
 * Builds the Core Excerpts admin content.
 *
 * @package Catalyst
 */
?>

<div id="catalyst-core-options-nav-excerpts-box" class="catalyst-all-options">

	<h3><?php _e( 'Excerpt Options', 'catalyst' ); ?></h3>

	<div class="catalyst-optionbox-2col-left-wrap">
		
		<div class="catalyst-optionbox-outer-2col">
			<div class="catalyst-optionbox-inner-2col">
				<h4><?php _e( 'Universal Excerpt Options', 'catalyst' ); ?></h4>
				
				<div class="bg-box">
					<p>
						<?php _e( 'Excerpt Word Limit', 'catalyst' ); ?> <input type="text" id="catalyst-excerpt-content-limit" name="catalyst[excerpt_content_limit]" value="<?php echo catalyst_get_core( 'excerpt_content_limit' ) ?>" style="width:45px;" />
					</p>
					
					<p>
						<?php _e( 'Excerpt "Read More" Placement', 'catalyst' ); ?> <select id="catalyst-excerpt-read-more-placement" name="catalyst[excerpt_read_more_placement]" size="1" style="width:100px;">
							<option value="Inline"<?php if( catalyst_get_core( 'excerpt_read_more_placement' ) == 'Inline' ) echo ' selected="selected"'; ?>><?php _e( 'Inline', 'catalyst' ); ?></option>
							<option value="New Line"<?php if( catalyst_get_core( 'excerpt_read_more_placement' ) == 'New Line' ) echo ' selected="selected"'; ?>><?php _e( 'New Line', 'catalyst' ); ?></option>
						</select> <span id="content-read-more-placement-tooltip" class="tooltip-mark tooltip-bottom-right">[?]</span>
					</p>
					
					<div class="tooltip tooltip-400">
						<p>
							<?php _e( '<strong>Inline:</strong> Will display Excerpt "Read More" links in line with the Content text.', 'catalyst' ); ?>
						</p>
						
						<p>
							<?php _e( '<strong>New Line:</strong> Will display Excerpt "Read More" links on a new line below the Content text.', 'catalyst' ); ?>
						</p>
					</div>
				</div>
			</div>
		</div>
		
		<div class="catalyst-optionbox-outer-2col">
			<div class="catalyst-optionbox-inner-2col">
				<h4><?php _e( 'Default &amp; Archive Thumbnail Options', 'catalyst' ); ?> <span id="excerpt-thumbnail-option-tooltip" class="tooltip-mark tooltip-bottom-center">[?]</span></h4>
				
				<div class="tooltip tooltip-500">
					<h5><?php _e( 'Creating Different Thumbnail Sizes:', 'catalyst' ); ?></h5>
					<p>
						<?php _e( 'With Catalyst you can create up to 4 totally unique Thumbnail Image sizes to be used in your Excerpts. You can choose the width, height and even whether or not to Resize or Crop the images. The default Thumbnail options (along with the Medium and Large image sizes) are set in', 'catalyst' ); ?>
						<a href="<?php echo admin_url( 'options-media.php' ); ?>"><?php _e( '<strong>(Settings > Media)</strong>', 'catalyst' ); ?></a>
						<?php _e( 'in your WordPress Dashboard.', 'catalyst' ); ?>
					</p>
					
					<h5><?php _e( 'Inside vs Outside Thumbnail Location:', 'catalyst' ); ?></h5>
					<p>
						<?php _e( 'The Thumbnail Location option allows you to control whether your Excerpt Thumbnail Images display Inside the Post Title Area or Outside of it.', 'catalyst' ) ?>
						<img src="<?php echo get_template_directory_uri(); ?>/lib/css/images/tooltips/tooltip-excerpt-location.png"/>
					</p>
				</div>
					
				<div class="bg-box">
					<p>
						<input type="checkbox" id="catalyst-archive-thumbnails" name="catalyst[archive_thumbnails]" value="1" <?php if( checked( 1, catalyst_get_core( 'archive_thumbnails' ) ) ); ?> /> <?php _e( 'Thumbnail Images In Excerpts', 'catalyst' ); ?>
					</p>
					<p>
						<?php _e( '<strong>Thumbnail:</strong> Alignment', 'catalyst' ); ?>
						<select id="catalyst-thumbnail-alignment" name="catalyst[thumbnail_alignment]" size="1" style="width:70px;">
							<option value="None"<?php if( catalyst_get_core( 'thumbnail_alignment' ) == 'None' ) echo ' selected="selected"'; ?>><?php _e( 'None', 'catalyst' ); ?></option>
							<option value="Left"<?php if( catalyst_get_core( 'thumbnail_alignment' ) == 'Left' ) echo ' selected="selected"'; ?>><?php _e( 'Left', 'catalyst' ); ?></option>
							<option value="Center"<?php if( catalyst_get_core( 'thumbnail_alignment' ) == 'Center' ) echo ' selected="selected"'; ?>><?php _e( 'Center', 'catalyst' ); ?></option>
							<option value="Right"<?php if( catalyst_get_core( 'thumbnail_alignment' ) == 'Right' ) echo ' selected="selected"'; ?>><?php _e( 'Right', 'catalyst' ); ?></option>
						</select>
						<?php _e( 'Location', 'catalyst' ); ?>
						<select id="catalyst-thumbnail-location" name="catalyst[thumbnail_location]" size="1" style="width:75px;">
							<option value="Inside"<?php if( catalyst_get_core( 'thumbnail_location' ) == 'Inside' ) echo ' selected="selected"'; ?>><?php _e( 'Inside', 'catalyst' ); ?></option>
							<option value="Outside"<?php if( catalyst_get_core( 'thumbnail_location' ) == 'Outside' ) echo ' selected="selected"'; ?>><?php _e( 'Outside', 'catalyst' ); ?></option>
						</select>
					</p>
					<p>
						<?php $sizes = catalyst_get_image_sizes(); ?>
						<?php _e( 'Thumbnail Size', 'catalyst' ); ?>
						<select id="catalyst-thumbnail-size" name="catalyst[thumbnail_size]">
							<?php
							foreach((array)$sizes as $name => $size) :
							echo '<option style="padding-right: 10px;" value="' . esc_attr( $name ) . '" ' . selected( $name, catalyst_get_core( 'thumbnail_size' ), FALSE ) . '>' . esc_html( $name ) . ' (' . $size['width'] . 'w x ' . $size['height'] . 'h)</option>';
							endforeach;
							?>
						</select>
					</p>
				</div>
			</div>
		</div>
		
	</div>
	<div class="catalyst-optionbox-2col-right-wrap">
	
		<div class="catalyst-optionbox-outer-2col">
			<div class="catalyst-optionbox-inner-2col">
				<h4><?php _e( 'Custom Thumbnail Sizes', 'catalyst' ); ?> <span id="custom-thumbnail-option-tooltip" class="tooltip-mark tooltip-bottom-left">[?]</span></h4>
				
				<div class="tooltip tooltip-400">
					<h5><?php _e( 'Creating Different Thumbnail Sizes:', 'catalyst' ); ?></h5>
					<p>
						<?php _e( 'To set a Custom Thumbnail Image Size you just set the Mode (Resize or Crop) and both the Width and Height for each Custom Thumbnail option. You do not have to set any of them or you can just set one or two. They are only there if you need them.', 'catalyst' ); ?>
					</p>
					
					<p>
						<?php _e( 'Once set you will be able to access them through both the Thumbnail Size drop-down menu in this options page as well as any of your Catalyst Excerpt Widgets.', 'catalyst' ); ?>
					</p>
					
					<h5><?php _e( 'Resize vs Crop:', 'catalyst' ); ?></h5>
					<p>
						<?php _e( 'Both Mode options resize the images, but the Crop option will actually crop your images, if necessary, to ensure your exact image size is obtained. With the Resize option you will retain the aspect ratio of your images, but therefore not see your exact dimensions reached.', 'catalyst' ); ?>
					</p>
				</div>
					
				<div class="bg-box">
					<p>
						<strong><?php _e( 'custom-thumb-1', 'catalyst' ); ?></strong>
					</p>
					<p>
						<?php _e( 'Mode', 'catalyst' ); ?>
						<input type="hidden" name="catalyst[custom_image_sizes][0][name]" value="custom-thumb-1">
						<?php $custom_image_sizes = catalyst_get_core('custom_image_sizes'); ?>
						<?php if( $custom_image_sizes ) { $custom_image_sizes_zero_mode = $custom_image_sizes[0]['mode']; } else { $custom_image_sizes_zero_mode = ''; } ?>
						<select id="catalyst-custom-image-size-1-mode" name="catalyst[custom_image_sizes][0][mode]" size="1" style="width:70px;">
							<option value="">&nbsp;</option>
							<option value="resize"<?php if( $custom_image_sizes_zero_mode == 'resize' ) echo ' selected="selected"'; ?>><?php _e( 'Resize', 'catalyst' ); ?></option>
							<option value="crop"<?php if( $custom_image_sizes_zero_mode == 'crop' ) echo ' selected="selected"'; ?>><?php _e( 'Crop', 'catalyst' ); ?></option>
						</select>
						<?php if( $custom_image_sizes ) { $custom_image_sizes_zero_width = $custom_image_sizes[0]['width']; } else { $custom_image_sizes_zero_width = ''; } ?>
						<?php _e( 'Width', 'catalyst' ); ?> <input type="text" id="catalyst-custom-image-size-1-width" name="catalyst[custom_image_sizes][0][width]" value="<?php echo $custom_image_sizes_zero_width; ?>" style="width:50px;" /><?php _e( 'px', 'catalyst' ); ?> | 
						<?php if( $custom_image_sizes ) { $custom_image_sizes_zero_height = $custom_image_sizes[0]['height']; } else { $custom_image_sizes_zero_height = ''; } ?>
						<?php _e( 'Height', 'catalyst' ); ?> <input type="text" id="catalyst-custom-image-size-1-height" name="catalyst[custom_image_sizes][0][height]" value="<?php echo $custom_image_sizes_zero_height; ?>" style="width:50px;" /><?php _e( 'px', 'catalyst' ); ?>
					</p>
				</div>
				<div class="bg-box">
					<p>
						<strong><?php _e( 'custom-thumb-2', 'catalyst' ); ?></strong>
					</p>
					<p>
						<?php _e( 'Mode', 'catalyst' ); ?>
						<input type="hidden" name="catalyst[custom_image_sizes][1][name]" value="custom-thumb-2">
						<?php if( $custom_image_sizes ) { $custom_image_sizes_one_mode = $custom_image_sizes[1]['mode']; } else { $custom_image_sizes_one_mode = ''; } ?>
						<select id="catalyst-custom-image-size-1-mode" name="catalyst[custom_image_sizes][1][mode]" size="1" style="width:70px;">
							<option value="">&nbsp;</option>
							<option value="resize"<?php if( $custom_image_sizes_one_mode == 'resize' ) echo ' selected="selected"'; ?>><?php _e( 'Resize', 'catalyst' ); ?></option>
							<option value="crop"<?php if( $custom_image_sizes_one_mode == 'crop' ) echo ' selected="selected"'; ?>><?php _e( 'Crop', 'catalyst' ); ?></option>
						</select>
						<?php if( $custom_image_sizes ) { $custom_image_sizes_one_width = $custom_image_sizes[1]['width']; } else { $custom_image_sizes_one_width = ''; } ?>
						<?php _e( 'Width', 'catalyst' ); ?> <input type="text" id="catalyst-custom-image-size-1-width" name="catalyst[custom_image_sizes][1][width]" value="<?php echo $custom_image_sizes_one_width; ?>" style="width:50px;" /><?php _e( 'px', 'catalyst' ); ?> | 
						<?php if( $custom_image_sizes ) { $custom_image_sizes_one_height = $custom_image_sizes[1]['height']; } else { $custom_image_sizes_one_height = ''; } ?>
						<?php _e( 'Height', 'catalyst' ); ?> <input type="text" id="catalyst-custom-image-size-1-height" name="catalyst[custom_image_sizes][1][height]" value="<?php echo $custom_image_sizes_one_height; ?>" style="width:50px;" /><?php _e( 'px', 'catalyst' ); ?>
					</p>
				</div>
				<div class="bg-box">
					<p>
						<strong><?php _e( 'custom-thumb-3', 'catalyst' ); ?></strong>
					</p>
					<p>
						<?php _e( 'Mode', 'catalyst' ); ?>
						<input type="hidden" name="catalyst[custom_image_sizes][2][name]" value="custom-thumb-3">
						<?php if( $custom_image_sizes ) { $custom_image_sizes_two_mode = $custom_image_sizes[2]['mode']; } else { $custom_image_sizes_two_mode = ''; } ?>
						<select id="catalyst-custom-image-size-1-mode" name="catalyst[custom_image_sizes][2][mode]" size="1" style="width:70px;">
							<option value="">&nbsp;</option>
							<option value="resize"<?php if( $custom_image_sizes_two_mode == 'resize' ) echo ' selected="selected"'; ?>><?php _e( 'Resize', 'catalyst' ); ?></option>
							<option value="crop"<?php if( $custom_image_sizes_two_mode == 'crop' ) echo ' selected="selected"'; ?>><?php _e( 'Crop', 'catalyst' ); ?></option>
						</select>
						<?php if( $custom_image_sizes ) { $custom_image_sizes_two_width = $custom_image_sizes[2]['width']; } else { $custom_image_sizes_two_width = ''; } ?>
						<?php _e( 'Width', 'catalyst' ); ?> <input type="text" id="catalyst-custom-image-size-1-width" name="catalyst[custom_image_sizes][2][width]" value="<?php echo $custom_image_sizes_two_width; ?>" style="width:50px;" /><?php _e( 'px', 'catalyst' ); ?> | 
						<?php if( $custom_image_sizes ) { $custom_image_sizes_two_height = $custom_image_sizes[2]['height']; } else { $custom_image_sizes_two_height = ''; } ?>
						<?php _e( 'Height', 'catalyst' ); ?> <input type="text" id="catalyst-custom-image-size-1-height" name="catalyst[custom_image_sizes][2][height]" value="<?php echo $custom_image_sizes_two_height; ?>" style="width:50px;" /><?php _e( 'px', 'catalyst' ); ?>
					</p>
				</div>
			</div>
		</div>
		
	</div>
</div>