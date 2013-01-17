<?php
/**
 * Builds the Core Footer admin content.
 *
 * @package Catalyst
 */
?>

<div id="catalyst-core-options-nav-footer-box" class="catalyst-all-options">

	<h3><?php _e( 'Footer Options', 'catalyst' ); ?></h3>
	
	<h3 class="catalyst-wide-option-heading"><?php _e( 'Footer Content Area', 'catalyst' ); ?> <span id="footer-content-tooltip" class="tooltip-mark tooltip-bottom-center">[?]</span></h3>
	<div class="tooltip tooltip-500">
		<h5><?php _e( 'Control The Content In Your Footer:', 'catalyst' ); ?></h5>
		<p>
			<?php _e( 'By default your footer will have an Admin Login link, Catalyst attribution link and Copyright info. The below Shortcodes provide you with control over these bits of content as well as the ability to add Custom Text.', 'catalyst' ); ?>
		</p>
		
		<p>
			<?php _e( 'The footer styling is broken down in such a way that you have a Left, Right and Center section to add content to. By moving around the Shortcodes below you can change which bits of content display in which sections.', 'catalyst' ); ?>
		</p>
		
		<h5><?php _e( 'What The Shortcodes = In Terms Of HTML:', 'catalyst' ); ?></h5>
		
		<p>
			<?php _e( '[left_open] = &lt;p class="footer-content footer-left"&gt;', 'catalyst' ); ?>
		</p>
		
		<p>
			<?php _e( '[right_open] = &lt;p class="footer-content footer-right"&gt;', 'catalyst' ); ?>
		</p>
		
		<p>
			<?php _e( '[center_open] = &lt;p class="footer-content footer-center"&gt;', 'catalyst' ); ?>
		</p>
		
		<p>
			<?php _e( '[close] = &lt;/p&gt;', 'catalyst' ); ?>
		</p>
		
		<p>
			<?php _e( '[custom_text] = Any plain text and/or HTML you add to the "Custom Footer Text" box below.', 'catalyst' ); ?>
		</p>
		
		<p>
			<?php _e( '[wp_login] = A text link for logging into your WordPress Dashboard.', 'catalyst' ); ?>
		</p>
		
		<p>
			<?php _e( '[catalyst_attribute] = A "Powered by Catalyst" link that points to http://catalysttheme.com and which you can add your Affiliate Link to (more info on this in the tooltip next to "Add Affiliate Link".', 'catalyst' ); ?>
		</p>
		
		<p>
			<?php _e( '[copyright] = Your site copyright text.', 'catalyst' ); ?>
		</p>
		
		<h5><?php _e( 'If you need to restore your footer content...', 'catalyst' ); ?></h5>
		
		<p>
			<?php _e( 'At any time you can copy the "Shortcode Defaults" content below and paste it into this "Footer Content Area" box and once you save your changes you will have restored your footer layout to the default.', 'catalyst' ); ?>
		</p>
	</div>
	<div style="padding-top:10px; margin-bottom:15px; border:1px solid #E3E3E3; border-top:0; background:#FFFFFF; width:802px;">
		<div class="bg-box">
			<p>
				<?php _e( 'Control Your Footer Content Using Shortcodes', 'catalyst' ); ?><br />
				<textarea id="catalyst-footer-content" name="catalyst[footer_content]" style="width:100%; height:110px; margin-bottom:5px;"><?php if( catalyst_get_core( 'footer_content' ) ) echo catalyst_get_core( 'footer_content' ); ?></textarea>
			</p>
		</div>
	</div>
	
	<h3 class="catalyst-wide-option-heading"><?php _e( 'Custom Footer Text for [custom_text] shortcode', 'catalyst' ); ?></h3>
	<div style="padding-top:10px; margin-bottom:15px; border:1px solid #E3E3E3; border-top:0; background:#FFFFFF; width:802px;">
		<div class="bg-box">
			<p>
				<?php _e( 'Add Custom Text/Links/Embeds Here:', 'catalyst' ); ?><br />
				<textarea id="catalyst-custom-footer-text" name="catalyst[custom_footer_text]" style="width:100%; height:110px; margin-bottom:5px;"><?php if( catalyst_get_core( 'custom_footer_text' ) ) echo catalyst_get_core( 'custom_footer_text' ); ?></textarea><br />
			</p>
		</div>
	</div>

	<div class="catalyst-optionbox-2col-left-wrap">
	
		<div class="catalyst-optionbox-outer-2col">
			<div class="catalyst-optionbox-inner-2col">
				<h4><?php _e( 'Shortcode Defaults | Add Affiliate Link', 'catalyst' ); ?> <span id="footer-options-tooltip" class="tooltip-mark tooltip-center-right">[?]</span></h4>
				
				<div class="tooltip tooltip-400">
					<h5><?php _e( 'Adding Your Affiliate Link To the Footer:', 'catalyst' ); ?></h5>
					
					<p>
						<?php _e( 'The Catalyst footer link attribute allows your site visitors to click over to the site that created your WordPress Theme. By becomeing a Catalyst Affiliate and then pasting your affiliate link to the appropriate text field below you are changing the actual Catalyst footer link to become your affiliate link.', 'catalyst' ); ?>
					</p>
					
					<p>
						<?php _e( 'Then if your visitors click on the link to come to our site and then purchase the Catalyst Theme you will be credited with the sale and will receive a commission for it. Some restrictions may apply so be sure to read all the details durring the sign up process.', 'catalyst' ); ?>
					</p>

					<span class="tooltip-credit">
						<?php _e( 'Be sure to', 'catalyst' ); ?>
						<a href="http://catalysttheme.com/affiliates/" target="_blank">Sign Up as a Catalyst Affiliate!</a>
					</span>
				</div>
				
				<div class="bg-box">
					<p class="code-box">
						<b><?php _e( 'Default Shortcodes', 'catalyst' ); ?></b>
						<textarea style="width:100%; height:84px; margin:0;">[left_open] [custom_text] [wp_login] [close] [right_open] [catalyst_attribute] [close] [center_open] [copyright] [close]</textarea>
					</p>
				</div>
				
				<div class="bg-box">
					<p>
						<?php _e( 'Catalyst Footer Affiliate Link', 'catalyst' ); ?> (<a href="http://catalysttheme.com/affiliates/" /><?php _e( 'Sign Up', 'catalyst' ); ?></a>)<br />
						<input type="text" id="catalyst-affiliate-link" name="catalyst[affiliate_link]" value="<?php echo catalyst_get_core( 'affiliate_link' ) ?>" style="width:100%;" />
					</p>
				</div>
			</div>
		</div>
		
	</div>
	<div class="catalyst-optionbox-2col-right-wrap">
		
		<div class="catalyst-optionbox-outer-2col">
			<div class="catalyst-optionbox-inner-2col">
				<h4><?php _e( 'Footer Text Example', 'catalyst' ); ?></h4>
				
				<div class="bg-box">
					<p class="code-box">
						<b><?php _e( 'Example...', 'catalyst' ); ?></b>
						<textarea style="width:100%; height:157px; margin:0;">&lt;a href=&quot;http://your-site.com/about/&quot;&gt;About&lt;/a&gt; | &lt;a href=&quot;http://your-site.com/contact/&quot;&gt;Contact&lt;/a&gt; | &lt;a href=&quot;http://your-site.com/terms/&quot;&gt;Terms & Conditions&lt;/a&gt;</textarea>
					</p>
				</div>
			</div>
		</div>
		
	</div>
</div>