<?php
/**
 * Builds the Advanced Custom CSS Builder admin content.
 *
 * @package Catalyst
 */
?>

<div style="display:none;" id="catalyst-dynamik-settings-content" class="catalyst-optionbox-outer-1col">
	<div class="catalyst-optionbox-inner-1col">
		<h3><?php _e( 'Additional Dynamik Settings', 'catalyst' ); ?></h3>
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'WordPress Post Formats', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design" style="padding-top:8px;">
				<input type="checkbox" id="catalyst-post-formats-active" name="catalyst[post_formats_active]" value="1" <?php if( checked( 1, catalyst_get_dynamik( 'post_formats_active' ) ) ); ?> /> <?php _e( 'Activate WordPress Post Formats', 'catalyst' ); ?>
				<span id="dynamik-post-formats-active-tooltip" class="tooltip-mark tooltip-center-left">[?]</span>
				<div class="tooltip tooltip-400">
					<p>
						<?php _e( 'By activating this Post Formats Functionality you will be enabling a feature inside your Post Editor that allows the selection of different Post Formats on a Per-Post basis.', 'catalyst' ); ?>
					</p>
					<p>
						<?php _e( 'Activating this feature will also enable a function that looks for a "post-formats" folder inside your /wp-content/themes/dynamik/css/ directory and if it finds this folder it will use any appropriately named icons inside it and display them to the right of your Post Title.', 'catalyst' ); ?>
					</p>
					<p>
						<?php _e( 'By "appropriately named" we mean PNG images given the name of the Post Format (eg. gallery.png, chat.png, etc...)', 'catalyst' ); ?>
					</p>
					<span class="tooltip-credit">
						<?php _e( 'Learn more here:', 'catalyst' ); ?>
						<a href="http://codex.wordpress.org/Post_Formats" target="_blank">WordPress Codex | Post Formats</a>
					</span>
				</div>
			</p>
		</div>
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Responsive Design Options', 'catalyst' ); ?></p>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design" style="padding-top:8px;">
				<?php _e( 'Enable the Dynamik Responsive Design Options', 'catalyst' ); ?>
				<b><a href="<?php echo admin_url( 'admin.php?page=catalyst&activetab=catalyst-core-options-nav-content' ); ?>"><?php _e( 'HERE', 'catalyst' ); ?></a></b>
				<?php _e( '(bottom/right column)', 'catalyst' ); ?>
				<span id="dynamik-responsive-options-enable-tooltip" class="tooltip-mark tooltip-top-left">[?]</span>
				<div class="tooltip tooltip-400">
					<p>
						<?php _e( 'Once you enable the Dynamik Responsive options (in Core Options > Content) a "Responsive" tab will appear in your Dynamik Options.', 'catalyst' ); ?>
					</p>
				</div>
			</p>
		</div>
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Dynamik CSS', 'catalyst' ); ?></p>
		</div>
		
		<?php global $catalyst_multisite; if( $catalyst_multisite ) { $dyn_number = '-' . $catalyst_multisite; } else { $dyn_number = ''; } ?>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design" style="padding-top:8px;">
				<input type="checkbox" id="catalyst-minify-css" name="catalyst[minify_css]" value="1" <?php if( checked( 1, catalyst_get_dynamik( 'minify_css' ) ) ); ?> /> <?php _e( 'Minify the Dynamik Stylesheet', 'catalyst' ); ?>
				<span id="dynamik-css-options-tooltip" class="tooltip-mark tooltip-top-left">[?]</span>
				<span class="tooltip tooltip-400" style="color: #666666 !important;">
					<?php _e( 'This option should be active for general use. When the option is checked, style.css, dynamik.css and any Advanced Options Custom CSS are merged into one stylesheet (dynamik-min.css) and minified for effeciency. When unchecked the un-minified stylesheets are called separately, which is ideal for testing purposes only.', 'catalyst' ); ?>
				</span>
				| <a href="<?php echo CHILD_URL . '/css/dynamik' . $dyn_number . '.css';?>" target="_blank"><span style="font-style:underline;"><?php _e( 'Click here to view the dynamik.css stylesheet', 'catalyst' ); ?></a> 
			</p>
		</div>
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Dynamik Options Control', 'catalyst' ); ?> <span id="dynamik-options-control-tooltip" class="tooltip-mark tooltip-top-right">[?]</span></p>
			
			<div class="tooltip tooltip-500">
				<h5><?php _e( 'Determine which Dynamik Options to display.', 'catalyst' ); ?></h5>
				
				<p>
					<?php _e( 'Here you can determine how basic or in-depth you want your Dynamik Options to be.', 'catalyst' ); ?>
				</p>
				
				<p>
					<?php _e( '<strong>Structure & Settings:</strong> When selected your Dynamik Options will be cut down to only the non-styling options (eg. content structures, placement, settings, etc..).', 'catalyst' ); ?>
				</p>
				
				<p>
					<?php _e( '<strong>Design Standard:</strong> When selected you will find the majority of your Dynamik Options visible with the exception of most of your Margin and Padding options.', 'catalyst' ); ?>
				</p>
				
				<p>
					<?php _e( '<strong>Kitchen Sink:</strong> When selected your Dynamik Options will fully display, including your Margin and Padding options.', 'catalyst' ); ?>
				</p>
			</div>
		</div>
		
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design" style="padding-top:8px;">
				<?php _e( 'Dynamik Options:', 'catalyst' ); ?>
				<input type="radio" class="dynamik-level-option" name="catalyst[dynamik_options_control]" value="structure_settings" <?php if( catalyst_get_dynamik( 'dynamik_options_control' ) == 'structure_settings' ) echo 'checked="checked" '; ?>/><label><?php _e( 'Structure & Settings', 'catalyst' ); ?></label>
				<input type="radio" class="dynamik-level-option" name="catalyst[dynamik_options_control]" value="design_standard" <?php if( catalyst_get_dynamik( 'dynamik_options_control' ) == 'design_standard' ) echo 'checked="checked" '; ?>/><label><?php _e( 'Design Standard', 'catalyst' ); ?></label>
				<input type="radio" class="dynamik-level-option" name="catalyst[dynamik_options_control]" value="kitchen_sink" <?php if( catalyst_get_dynamik( 'dynamik_options_control' ) == 'kitchen_sink' ) echo 'checked="checked" '; ?>/><label><?php _e( 'Kitchen Sink', 'catalyst' ); ?></label>
			</p>
		</div>
	</div>
</div>