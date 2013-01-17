<?php
/**
 * Builds the Dynamik Widths admin content.
 *
 * @package Catalyst
 */
?>

<div id="catalyst-dynamik-options-nav-widths-box" class="catalyst-optionbox-outer-1col catalyst-all-options">
	<div class="catalyst-optionbox-inner-1col">
		<div style="margin-bottom:15px; float:left;" id="catalyst-custom-layout-width-defaults" class="catalyst-all-options">
			<h3><?php _e( 'Custom Layout Default Widths', 'catalyst' ); ?></h3>
			
			<div id="catalyst-width-option-wrap-9999" class="catalyst-width-option-wrap">
				<div class="catalyst-dynamik-option-desc">
					<p><?php _e( 'Double Sidebar Layouts', 'catalyst' ); ?></p>
				</div>
				
				<div class="catalyst-dynamik-option">
					<p>
						<?php _e( 'Content', 'catalyst' ); ?>
						<input type="text" id="catalyst-content-width-9999" class="dynamik-width-option" name="catalyst[double_sb_custom_layout_cc_width]" value="<?php catalyst_dynamik_options_defaults( true, 'double_sb_custom_layout_cc_width' ); ?>" style="width:40px;" /><?php _e( 'px', 'catalyst' ); ?>
						<?php _e( ' | Sidebar 1', 'catalyst' ); ?>
						<input type="text" id="catalyst-sb1-width-9999" class="dynamik-width-option" name="catalyst[double_sb_custom_layout_sb1_width]" value="<?php catalyst_dynamik_options_defaults( true, 'double_sb_custom_layout_sb1_width' ); ?>" style="width:40px;" /><?php _e( 'px', 'catalyst' ); ?>
						<?php _e( ' | Sidebar 2', 'catalyst' ); ?>
						<input type="text" id="catalyst-sb2-width-9999" class="dynamik-width-option" name="catalyst[double_sb_custom_layout_sb2_width]" value="<?php catalyst_dynamik_options_defaults( true, 'double_sb_custom_layout_sb2_width' ); ?>" style="width:40px;" /><?php _e( 'px', 'catalyst' ); ?>
						<input type="hidden" id="catalyst-layout-type-9999" value="<?php echo 'double-sidebar'; ?>">
						<?php _e( ' | Wrap Width: ', 'catalyst' ); ?>
						<strong><span id="calculated-width-9999">960</span></strong>px
					</p>
				</div>
			</div>
			
			<div id="catalyst-width-option-wrap-9998" class="catalyst-width-option-wrap">
				<div class="catalyst-dynamik-option-desc">
					<p><?php _e( 'Single Sidebar Layouts', 'catalyst' ); ?></p>
				</div>
				
				<div class="catalyst-dynamik-option">
					<p>
						<?php _e( 'Content', 'catalyst' ); ?>
						<input type="text" id="catalyst-content-width-9998" class="dynamik-width-option" name="catalyst[single_sb_custom_layout_cc_width]" value="<?php catalyst_dynamik_options_defaults( true, 'single_sb_custom_layout_cc_width' ); ?>" style="width:40px;" /><?php _e( 'px', 'catalyst' ); ?>
						<?php _e( ' | Sidebar 1', 'catalyst' ); ?>
						<input type="text" id="catalyst-sb1-width-9998" class="dynamik-width-option" name="catalyst[single_sb_custom_layout_sb1_width]" value="<?php catalyst_dynamik_options_defaults( true, 'single_sb_custom_layout_sb1_width' ); ?>" style="width:40px;" /><?php _e( 'px', 'catalyst' ); ?>
						<input type="hidden" id="catalyst-layout-type-9998" value="<?php echo 'right-sidebar'; ?>">
						<?php _e( ' | Wrap Width: ', 'catalyst' ); ?>
						<strong><span id="calculated-width-9998">960</span></strong>px
					</p>
				</div>
			</div>
				
			<div id="catalyst-width-option-wrap-9997" class="catalyst-width-option-wrap">
				<div class="catalyst-dynamik-option-desc">
					<p><?php _e( 'No Sidebar Layouts', 'catalyst' ); ?></p>
				</div>
				
				<div class="catalyst-dynamik-option">
					<p>
						<?php _e( 'Content', 'catalyst' ); ?>
						<input type="text" id="catalyst-content-width-9997" class="dynamik-width-option" name="catalyst[no_sb_custom_layout_cc_width]" value="<?php catalyst_dynamik_options_defaults( true, 'no_sb_custom_layout_cc_width' ); ?>" style="width:40px;" /><?php _e( 'px', 'catalyst' ); ?>
						<input type="hidden" id="catalyst-layout-type-9997" value="<?php echo 'no-sidebar'; ?>">
						<?php _e( ' | Wrap Width: ', 'catalyst' ); ?>
						<strong><span id="calculated-width-9997">960</span></strong>px
					</p>
				</div>
			</div>
		</div>
		
		<h3><?php _e( 'Layout Widths', 'catalyst' ); ?> <b><a href="<?php echo admin_url( 'admin.php?page=advanced-options&activetab=catalyst-advanced-options-nav-layouts' ); ?>"><?php _e( '[Add New Layouts Here]', 'catalyst' ); ?></a></b><span id="show-hide-custom-layout-width-defaults" class="show-hide-custom-layout-width-defaults-styles"><?php _e( 'Show / Hide Custom Layout Width Defaults', 'catalyst' ); ?></span> <span id="wrap-width-calc-tooltip" class="tooltip-mark tooltip-bottom-left">[?]</span></h3>
		
		<div class="tooltip tooltip-400">
			<h5><?php _e( 'Wrap Width:', 'catalyst' ); ?></h5>
			
			<p>
				<?php _e( 'This "Wrap Width" value is calculated by adding together the Content Width, Sidebar Widths (if any) and widths of Dynamik Options > Wrap > Container Wrap Padding > (Left/Right x 2 AND Sidebar Separation x The Number of Sidebars In The Layout).', 'catalyst' ); ?>
			</p>
			
			<p>
				<?php _e( 'So, for example, if you had a Double Sidebar Layout with a Content Width of 440px, a Sidebar 1 Width of 280px, a Sidebar 2 Width of 160px, a Left/Right Container Wrap Padding value of 20px and a Sidebar Separation value of 20px the Wrap Width would be calculated as follows:', 'catalyst' ); ?>
			</p>
			
			<p>
				<?php _e( '440 + 280 + 160 + (20 x 2) + (20 x 2) = 960', 'catalyst' ); ?>
			</p>
		</div>
		
		<div id="catalyst-width-option-wrap-1" class="catalyst-width-option-wrap">
			<div class="catalyst-dynamik-option-desc">
				<p><?php _e( 'Catalyst Default Layout Widths', 'catalyst' ); ?></p>
			</div>
			
			<div class="catalyst-dynamik-option">
				<p>
					<?php _e( 'Content', 'catalyst' ); ?>
					<input type="text" id="catalyst-content-width-1" class="dynamik-width-option" name="catalyst[cc_width]" value="<?php echo catalyst_get_dynamik( 'cc_width' ); ?>" style="width:40px;" /><?php _e( 'px', 'catalyst' ); ?>
					<?php if( $catalyst_layout_type != 'no-sidebar' ) { ?>
					<?php _e( ' | Sidebar 1', 'catalyst' ); ?>
					<input type="text" id="catalyst-sb1-width-1" class="dynamik-width-option" name="catalyst[sb1_width]" value="<?php echo catalyst_get_dynamik( 'sb1_width' ); ?>" style="width:40px;" /><?php _e( 'px', 'catalyst' ); ?>
					<?php } else { ?>
					<input type="hidden" id="catalyst-sb1-width-1" name="catalyst[sb1_width]" value="<?php echo catalyst_get_dynamik( 'sb1_width' ) ? catalyst_get_dynamik( 'sb1_width' ) : '280'; ?>" />
					<?php } if( $catalyst_layout_type != 'no-sidebar' && $catalyst_layout_type != 'left-sidebar' && $catalyst_layout_type != 'right-sidebar' ) { ?>
					<?php _e( ' | Sidebar 2', 'catalyst' ); ?>
					<input type="text" id="catalyst-sb2-width-1" class="dynamik-width-option" name="catalyst[sb2_width]" value="<?php echo catalyst_get_dynamik( 'sb2_width' ); ?>" style="width:40px;" /><?php _e( 'px', 'catalyst' ); ?>
					<?php } else { ?>
					<input type="hidden" id="catalyst-sb2-width-1" name="catalyst[sb2_width]" value="<?php echo catalyst_get_dynamik( 'sb2_width' ) ? catalyst_get_dynamik( 'sb2_width' ) : '160'; ?>" />
					<?php } ?>
					<input type="hidden" id="catalyst-layout-type-1" value="<?php echo $catalyst_layout_type; ?>">
					<?php _e( ' | Wrap Width: ', 'catalyst' ); ?>
					<strong><span id="calculated-width-1">960</span></strong>px
				</p>
			</div>
		</div>
		
<?php
		$custom_layouts = catalyst_get_layouts();
		if( !empty( $custom_layouts ) )
		{
			$counter = 1;
			foreach( $custom_layouts as $custom_layout )
			{
			$counter++; ?>
			<div id="catalyst-width-option-wrap-<?php echo $counter ?>" class="catalyst-width-option-wrap">
			<div class="catalyst-dynamik-option-desc">
				<p><?php echo $custom_layout['layout_id']; _e( ' Widths', 'catalyst' ); ?></p>
			</div>
			
			<div class="catalyst-dynamik-option">
				<p>
					<?php _e( 'Content', 'catalyst' ); ?>
					<input type="text" id="catalyst-content-width-<?php echo $counter ?>" class="dynamik-width-option" name="custom_layout_widths[<?php echo $counter ?>][content_width]" value="<?php echo ( !empty( $custom_layout['content_width'] ) ) ? $custom_layout['content_width'] : catalyst_get_dynamik( 'cc_width' ); ?>" style="width:40px;" /><?php _e( 'px', 'catalyst' ); ?>
					<?php if( $custom_layout['type'] != 'no-sidebar' ) { ?>
					<?php _e( ' | Sidebar 1', 'catalyst' ); ?>
					<input type="text" id="catalyst-sb1-width-<?php echo $counter ?>" class="dynamik-width-option" name="custom_layout_widths[<?php echo $counter ?>][sb1_width]" value="<?php echo ( !empty( $custom_layout['sb1_width'] ) ) ? $custom_layout['sb1_width'] : catalyst_get_dynamik( 'sb1_width' ); ?>" style="width:40px;" /><?php _e( 'px', 'catalyst' ); ?>
					<?php } ?>
					<?php if( $custom_layout['type'] != 'no-sidebar' && $custom_layout['type'] != 'left-sidebar' && $custom_layout['type'] != 'right-sidebar' ) { ?>
					<?php _e( ' | Sidebar 2', 'catalyst' ); ?>
					<input type="text" id="catalyst-sb2-width-<?php echo $counter ?>" class="dynamik-width-option" name="custom_layout_widths[<?php echo $counter ?>][sb2_width]" value="<?php echo ( !empty( $custom_layout['sb2_width'] ) ) ? $custom_layout['sb2_width'] : catalyst_get_dynamik( 'sb2_width' ); ?>" style="width:40px;" /><?php _e( 'px', 'catalyst' ); ?>
					<?php } ?>
					<input type="hidden" id="catalyst-layout-id-<?php echo $counter ?>" name="custom_layout_widths[<?php echo $counter ?>][layout_id]" value="<?php echo $custom_layout['layout_id']; ?>">
					<input type="hidden" id="catalyst-layout-type-<?php echo $counter ?>" name="custom_layout_widths[<?php echo $counter ?>][type]" value="<?php echo $custom_layout['type']; ?>">
					<?php _e( ' | Wrap Width: ', 'catalyst' ); ?>
					<strong><span id="calculated-width-<?php echo $counter ?>">960</span></strong>px
				</p>
			</div>
			</div>
<?php		}
		}
		?>
	</div>
</div>