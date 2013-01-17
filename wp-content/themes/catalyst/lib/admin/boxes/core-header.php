<?php
/**
 * Builds the Core Header admin content.
 *
 * @package Catalyst
 */
?>

<div id="catalyst-core-options-nav-header-box" class="catalyst-all-options">

	<h3><?php _e( 'Header Options', 'catalyst' ); ?></h3>

	<div class="catalyst-optionbox-2col-left-wrap">
		
		<div class="catalyst-optionbox-outer-2col">
			<div class="catalyst-optionbox-inner-2col">
				<h4><?php _e( 'Header Left Options', 'catalyst' ); ?> <span id="header-left-options-tooltip" class="tooltip-mark tooltip-center-right">[?]</span></h4>
				
				<div class="tooltip tooltip-400">
					<p>
						<?php _e( 'If "Image" is selected your Logo Image path will default to:<br /><b>/themes/catalyst/images/logo.png</b>', 'catalyst' ); ?>
					</p>
					
					<p>
						<?php _e( 'If the Dynamik child theme is active and a Logo Image is selected then your Logo Image path will change to:<br /><b>/themes/dynamik/css/images/[logo-name]</b>', 'catalyst' ); ?>
					</p>
				</div>
				
				<div class="bg-box">
					<p>
						<?php _e( 'Logo Type', 'catalyst' ); ?> <select id="catalyst-logo-type" name="catalyst[logo_type]" size="1" style="width:70px; margin-right:5px;">
							<option value="Text"<?php if( catalyst_get_core( 'logo_type' ) == 'Text' ) echo ' selected="selected"'; ?>><?php _e( 'Text', 'catalyst' ); ?></option>
							<option value="Image"<?php if( catalyst_get_core( 'logo_type' ) == 'Image' ) echo ' selected="selected"'; ?>><?php _e( 'Image', 'catalyst' ); ?></option>
						</select>
						<?php if ( defined( 'DYNAMIK_ACTIVE' ) ) { ?>
						<?php _e( 'Style Your Header/Logo', 'catalyst' ); ?>
						<b><a href="<?php echo admin_url( 'admin.php?page=dynamik-options&activetab=catalyst-dynamik-options-nav-header' ); ?>"><?php _e( 'HERE', 'catalyst' ); ?></a></b>
						<?php } ?>
						<?php if ( defined( 'BASIK_CHILD_THEME_VERSION' ) ) { ?>
						<?php _e( 'Style Your Header/Logo', 'catalyst' ); ?>
						<b><a href="<?php echo admin_url( 'admin.php?page=child-options&activetab=catalyst-child-options-nav-header' ); ?>"><?php _e( 'HERE', 'catalyst' ); ?></a></b>
						<?php } ?>
					</p>
				</div>
				
				<div class="bg-box">	
					<p>
						<?php _e( 'Logo Links To...', 'catalyst' ); ?> <select id="catalyst-logo-links-to" name="catalyst[logo_links_to]" size="1" style="width:110px;">
							<option value="homepage"<?php if( catalyst_get_core( 'logo_links_to' ) == 'homepage' ) echo ' selected="selected"'; ?>><?php _e( 'Homepage', 'catalyst' ); ?></option>
							<option value="custom_url"<?php if( catalyst_get_core( 'logo_links_to' ) == 'custom_url' ) echo ' selected="selected"'; ?>><?php _e( 'Custom URL', 'catalyst' ); ?></option>
							<option value="nothing"<?php if( catalyst_get_core( 'logo_links_to' ) == 'nothing' ) echo ' selected="selected"'; ?>><?php _e( 'Nothing', 'catalyst' ); ?></option>
						</select>
						<span id="logo-links-to-tooltip" class="tooltip-mark tooltip-top-right">[?]</span>
					</p>
					
					<div class="tooltip tooltip-400">
						<p>
							<?php _e( 'Sometimes you may want your Logo Text or Image to link to something other than your site\'s homepage, or maybe to nothing at all.', 'catalyst' ); ?>
						</p>
						
						<p>
							<?php _e( 'In these cases you can either select "Custom URL" and then add your alternate Logo URL and Link Title in the textfields that will appear below or select "Nothing" to unlink your Logo.', 'catalyst' ); ?>
						</p>
					</div>
					
					<p style="display:none;" id="catalyst-logo-links-to-box">
						<?php _e( 'Add Your Alternate Logo URL Here', 'catalyst' ); ?><br />
						<input type="text" id="catalyst-alt-logo-link" name="catalyst[alt_logo_link]" value="<?php echo catalyst_get_core( 'alt_logo_link' ) ?>" style="width:310px; margin-bottom:10px;" /><br />
						<?php _e( 'Add Your Alternate Logo Link <code><strong>title=" "</strong></code> Here', 'catalyst' ); ?><br />
						<input type="text" id="catalyst-alt-logo-link-title" name="catalyst[alt_logo_link_title]" value="<?php echo catalyst_get_core( 'alt_logo_link_title' ) ?>" style="width:310px;" />
					</p>
				</div>
			</div>
		</div>
		
	</div>
	<div class="catalyst-optionbox-2col-right-wrap">
		
		<div class="catalyst-optionbox-outer-2col">
			<div class="catalyst-optionbox-inner-2col">
				<h4><?php _e( 'Header Right Options', 'catalyst' ); ?> <span id="header-right-options-tooltip" class="tooltip-mark tooltip-center-left">[?]</span></h4>
				
				<div class="tooltip tooltip-400">
					<p>
						<?php _e( 'The Header Right area houses the catalyst_hook_header_right hook. This hook allows you to hook widgets into the right side of your header. When using the Dynamik Child Theme this hook also allows you to place Navbar 1 to the right of your Header.', 'catalyst' ); ?>
					</p>
					
					<p>
						<?php _e( 'When this Header Right Area/Hook is not set to be active then the entire Header Right area is removed, only leaving the Header Left area, set to span the full width of your Header.', 'catalyst' ); ?>
					</p>
				</div>
				
				<div class="bg-box">
					<p>
						<input type="checkbox" id="catalyst-header-right-active" name="catalyst[header_right_active]" value="1" <?php if( checked( 1, catalyst_get_core( 'header_right_active' ) ) ); ?> /> <?php _e( 'Activate Header Right Area/Hook', 'catalyst' ); ?>
					</p>
				</div>
			</div>
		</div>
		
	</div>
</div>