<?php
/**
 * Builds the Core Info admin content.
 *
 * @package Catalyst
 */
?>

<div id="catalyst-core-options-nav-info-box" class="catalyst-all-options catalyst-options-display">
	<?php $child_info = function_exists( 'wp_get_theme' ) ? wp_get_theme() : get_theme_data( CHILD_ROOT . '/style.css' ); ?>
	<div class="catalyst-optionbox-2col-left-wrap">
	
		<div class="catalyst-optionbox-outer-2col">
			<div class="catalyst-optionbox-inner-2col">
				<h4><?php _e( 'Catalyst General Information', 'catalyst' ); ?></h4>
				<div id="readme-box">
					<h5><?php _e( 'Using The Catalyst [?]Tooltips', 'catalyst' ); ?></h5>
					
					<p style="margin-top:-15px;">
						<?php _e( 'Catalyst has valuable documentation spread through the admin interface in the form of [?]Tooltips. If you find an option or setting to be unclear, chances are the nearest Tooltip will provide explanation.', 'catalyst' ); ?>
					</p>
					<p>
						<?php _e( 'To use the Tooltips just click on the [?] symbol to bring up the Tooltip Content Box. To close the Tooltip move your mouse pointer away from the [?] symbol. If you move your mouse pointer into the Tooltip itself then you must hover your mouse pointer over the [?] symbol to close the tooltip.', 'catalyst' ); ?>
					</p>
					
					<h5><?php _e( 'Installing A Catalyst Child Theme', 'catalyst' ); ?></h5>
					
					<p style="margin-top:-15px;">
						<?php _e( 'Because Child Themes are dependent on their Parents for core functionality, you must install Catalyst before activating any Catalyst Child Themes.', 'catalyst' ); ?>
					</p>
					
					<h5><?php _e( 'Catalyst Theme Updates', 'catalyst' ); ?></h5>
					
					<p style="margin-top:-15px;">
						<?php _e( 'Catalyst Theme will notify you any time an update is available. Catalyst checks automatically for updates every 24 hours, and you can check for updates manually by clicking the "Check Now" button below.', 'catalyst' ); ?>
					</p>
					<p>
						<?php _e( 'A complete backup of your Core & Child Theme settings is strongly recommended before performing an update.', 'catalyst' ); ?>
					</p>
				</div>
			</div>
		</div>
		
		<?php
		if( !get_the_author_meta( 'disable_catalyst_update_nag', $user->ID ) )
		{ ?>
		<form method="post" action="admin.php?page=catalyst&activetab=catalyst-core-options-nav-info" >
		<div class="catalyst-optionbox-outer-2col">
			<div class="catalyst-optionbox-inner-2col">
				<h4><?php _e( 'Check for Updates', 'catalyst' ); ?></h4>
				<div class="bg-box">
					<p>
						<?php _e( 'Manually Trigger Auto-Update Check: ', 'catalyst' ); ?>
						<input type="submit" name="clicked_button" value="<?php _e( 'Check Now', 'catalyst' ); ?>" class="button-highlighted"/>
						<input type="hidden" name="catalyst_update_check" value="trigger">
					</p>
				</div>
			</div>
		</div>
		</form>
		<?php
		} ?>
	
	</div>

	<div class="catalyst-optionbox-2col-right-wrap">
	
		<div class="catalyst-optionbox-outer-2col">
			<div class="catalyst-optionbox-inner-2col">
				<h4><?php _e( 'Catalyst Links & Resources', 'catalyst' ); ?></h4>
				<div id="resource-box">
					<h5><?php _e( 'Catalyst Resources', 'catalyst' ); ?></h5>
					
					<p style="margin-top:-15px;">
						<?php _e( 'For a selection of informational resources, including screencasts and tutorials, visit:', 'catalyst' ); ?>
					</p>
					<p style="margin-top:-5px;">
						<a href="http://catalysttheme.com/resources/">http://catalysttheme.com/resources/</a>
					</p>
					
					<h5><?php _e( 'Catalyst Support', 'catalyst' ); ?></h5>
					
					<p style="margin-top:-15px;">
						<?php _e( 'For Catalyst support, visit the Catalyst Forum:', 'catalyst' ); ?>
					</p>
					<p style="margin-top:-5px;">
						<a href="http://catalysttheme.com/forum/">http://catalysttheme.com/forum/</a>
					</p>
					
					<h5><?php _e( 'Make Money Promoting Catalyst', 'catalyst' ); ?></h5>
					
					<p style="margin-top:-15px;">
						<?php _e( 'To help promote Catalyst and get a share of all sales you help to generate, join our affiliate program:', 'catalyst' ); ?>
					</p>
					<p style="margin-top:-5px;">
						<a href="http://catalysttheme.com/affiliates/">http://catalysttheme.com/affiliates/</a>
					</p>
				</div>
			</div>
		</div>
		
		<div class="catalyst-optionbox-outer-2col">
			<div class="catalyst-optionbox-inner-2col">
				<h4><?php _e( 'Version Information', 'catalyst' ); ?></h4>
				<div class="bg-box">
					<p>
						<?php _e( 'PHP Version:', 'catalyst' ); ?> <b><code><?php echo PHP_VERSION ?></code></b>
					</p>
					
					<p>
						<?php _e( 'WordPress Version:', 'catalyst' ); ?> <b><code><?php echo bloginfo('version') ?></code></b>
					</p>
					
					<p>
						<?php _e( 'Theme Version:', 'catalyst' ); ?> <b><code><?php echo esc_attr(CATALYST_THEME_NAME) .' '. esc_attr(CATALYST_THEME_VERSION) ?></code></b>
					</p>
					
					<?php if ( CHILD_ROOT != CATALYST_ROOT ) { ?>
					<p>
						<?php _e( 'Child Theme Version:', 'catalyst' ); ?> <b><code><?php if( function_exists( 'wp_get_theme' ) ) { echo $child_info->Name . ' ' . $child_info->Version; } else { echo esc_attr($child_info['Name']) . ' ' . esc_attr($child_info['Version']); } ?></code></b>
					</p>
					<?php } ?>
				</div>
			</div>
		</div>
		
		<div class="catalyst-optionbox-outer-2col">
			<div class="catalyst-optionbox-inner-2col">
				<h4><?php _e( 'Core Stylesheet', 'catalyst' ); ?></h4>
				<div class="bg-box">
					<p>
						<a href="<?php echo CATALYST_URL . '/style.css';?>" target="_blank"><span style="font-style:underline;"><?php _e( 'Click here to view the style.css stylesheet', 'catalyst' ); ?></a> 
					</p>
				</div>
			</div>
		</div>

	</div>
	
</div>