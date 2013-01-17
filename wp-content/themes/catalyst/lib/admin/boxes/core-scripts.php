<?php
/**
 * Builds the Core Scripts admin content.
 *
 * @package Catalyst
 */
?>

<div id="catalyst-core-options-nav-scripts-box" class="catalyst-all-options">

	<h3><?php _e( 'Script Options', 'catalyst' ); ?></h3>
	
	<h3 class="catalyst-wide-option-heading"><?php _e( 'Enable/Disable Scripts', 'catalyst' ); ?></h3>
	<div style="padding-top:10px; margin-bottom:15px; border:1px solid #E3E3E3; border-top:0; background:#FFFFFF; width:802px;">
		<div class="bg-box" style="width:364px; margin-right:0; float:left;">
			<p>
				<input type="checkbox" id="catalyst-modernizr-script-active" name="catalyst[modernizr_script_active]" value="1" <?php if( checked( 1, catalyst_get_core( 'modernizr_script_active' ) ) ); ?> /> <?php _e( 'Enable the modernizr.min.js Script', 'catalyst' ); ?>
				<span id="modernizr-script-active-tooltip" class="tooltip-mark tooltip-center-right">[?]</span>
				<div class="tooltip tooltip-400">
					<h5><?php _e( 'What Is Modernizr?', 'catalyst' ); ?></h5>
					<p>
						<?php _e( '<em>"Modernizr is a small JavaScript library that detects the availability of native implementations for next-generation web technologies, i.e. features that stem from the HTML5 and CSS3 specifications. Many of these features are already implemented in at least one major browser (most of them in two or more), and what Modernizr does is, very simply, tell you whether the current browser has this feature natively implemented or not."</em>', 'catalyst' ); ?>
					</p>
					
					<p>
						<?php _e( 'The most basic use of the Modernizr script is to make your website\'s HTML5 elements display properly in pre-IE9 browsers. This is done with the included html5shiv script.', 'catalyst' ); ?>
					</p>
					
					<p>
						<?php _e( '<strong>Please Note:</strong> If the Modernizr script is disabled then Catalyst will replace it with the', 'catalyst' ); ?>
						<a href="" target="_blank"><?php _e( 'html5shiv', 'catalyst' ); ?></a>
						<?php _e( 'script by itself, to ensure pre-IE9 HTML5 compatibility. Note that this script is only used when someone is viewing your site on a pre-IE9 browser.', 'catalyst' ); ?>
					</p>
						
					<span class="tooltip-credit">
						<?php _e( 'Learn more about Modernizr here:', 'catalyst' ); ?>
						<a href="http://www.modernizr.com/docs/" target="_blank">What is Modernizr?</a>
					</span>
				</div>
			</p>
		</div>
		
		<div class="bg-box" style="width:364px; margin-left:0; float:right;">
			<p>
				<input type="checkbox" id="catalyst-respond-script-active" name="catalyst[respond_script_active]" value="1" <?php if( checked( 1, catalyst_get_core( 'respond_script_active' ) ) ); ?> /> <?php _e( 'Enable the respond.min.js Script', 'catalyst' ); ?>
				<span id="respond-script-active-tooltip" class="tooltip-mark tooltip-center-left">[?]</span>
				<div class="tooltip tooltip-400">
					<h5><?php _e( 'What Is respond.js?', 'catalyst' ); ?></h5>					
					<p>
						<?php _e( 'respond.js is a simple javascript file which makes it so pre-IE9 browsers can properly "respond" to CSS3 Media Queries.', 'catalyst' ); ?>
					</p>
						
					<span class="tooltip-credit">
						<?php _e( 'Learn more about respond.js here:', 'catalyst' ); ?>
						<a href="https://github.com/scottjehl/Respond#readme" target="_blank">README</a>
					</span>
				</div>
			</p>
		</div>
		<div style="clear:both;"></div>
	</div>

	<div class="catalyst-optionbox-2col-left-wrap">

		<div class="catalyst-optionbox-outer-2col">
			<div class="catalyst-optionbox-inner-2col">
				<h4><?php _e( 'Header Scripts', 'catalyst' ); ?></h4>
				
				<div class="bg-box">
					<p>
						<?php _e( 'Scripts/Code Output to <code>wp_head();</code>', 'catalyst' ); ?><br />
						<textarea id="catalyst-header-scripts" name="catalyst[header_scripts]" style="width:100%; height:200px;"><?php if( catalyst_get_core( 'header_scripts' ) ) echo catalyst_get_core( 'header_scripts' ); ?></textarea>
					</p>
				</div>
			</div>
		</div>
		
	</div>
	<div class="catalyst-optionbox-2col-right-wrap">
	
		<div class="catalyst-optionbox-outer-2col">
			<div class="catalyst-optionbox-inner-2col">
				<h4><?php _e( 'Footer Scripts', 'catalyst' ); ?></h4>
				
				<div class="bg-box">
					<p>
						<?php _e( 'Scripts/Code Output to <code>wp_footer();</code>', 'catalyst' ); ?><br />
						<textarea id="catalyst-footer-scripts" name="catalyst[footer_scripts]" style="width:100%; height:200px;"><?php if( catalyst_get_core( 'footer_scripts' ) ) echo catalyst_get_core( 'footer_scripts' ); ?></textarea>
					</p>
				</div>
			</div>
		</div>
		
	</div>
</div>