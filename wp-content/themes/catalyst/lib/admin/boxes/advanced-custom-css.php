<?php
/**
 * Builds the Advanced Custom CSS admin content.
 *
 * @package Catalyst
 */
?>

<div id="catalyst-advanced-options-nav-css-box" class="catalyst-optionbox-outer-1col catalyst-all-options">
	<div class="catalyst-optionbox-inner-1col">
		<h3><?php _e( 'Custom CSS', 'catalyst' ); ?>
		<span style="color:#777777;">( <?php _e( 'Activate Front-end CSS Builder', 'catalyst' ); ?>
		<input type="checkbox" id="catalyst-css-builder-popup-active" name="catalyst[css_builder_popup_active]" value="1" <?php if( checked( 1, catalyst_get_advanced( 'css_builder_popup_active' ) ) ); ?> />
		<span id="catalyst-css-builder-popup-editor-only-wrap"<?php if( !catalyst_get_advanced( 'css_builder_popup_active' ) ) { echo 'style="display:none;"'; } ?>><?php _e( 'Editor Only', 'catalyst' ); ?>
		<input type="checkbox" id="catalyst-css-builder-popup-editor-only" name="catalyst[css_builder_popup_editor_only]" value="1" <?php if( checked( 1, catalyst_get_advanced( 'css_builder_popup_editor_only' ) ) ); ?> /></span> )</span>
		<span id="custom-css-tooltip" class="tooltip-mark tooltip-bottom-left">[?]</span></h3>
		
		<div class="tooltip tooltip-500">
			<h5><?php _e( 'Powerful Custom CSS Tools', 'catalyst' ); ?></h5>
			
			<p>
				<?php _e( 'To add Custom CSS to your Catalyst Powered website just add it below or Activate the Front-end CSS Builder feature. This will display a "Show/Hide CSS Builder" tab on the front-end of your website where you can click to display the CSS Builder Tool included with Catalyst.', 'catalyst' ); ?>
			</p>
			
			<p>
				<?php _e( 'With this tool displaying on your site\'s front-end you will be able to utilize both the CSS Builder Tool as well as the Custom CSS Editor. But what makes this feature so intuitive and powerful is the fact that your CSS will result in real-time changes to the style of your website. Just add your Custom Styles and watch the changes take place as you type in the code!', 'catalyst' ); ?>
			</p>
			
			<h5><?php _e( 'CSS Builder vs Custom CSS', 'catalyst' ); ?></h5>
			
			<p>
				<?php _e( 'The "CSS Builder" section is only for helping you create the CSS. It is the "Custom CSS Editor" popup that actually provides a place to add/edit/save Custom CSS that will effect your site\'s design for all visitors.', 'catalyst' ); ?>
			</p>
			
			<p>
				<?php _e( 'The CSS Builder changes are only temporary and the Custom CSS Editor changes are temporary until you click "Save Changes" to write them to your actual Custom Stylesheet. So no one but you will see these changes until you save them in the Custom CSS Editor.', 'catalyst' ); ?>
			</p>
		
			<h5><?php _e( 'Editor Only?', 'catalyst' ); ?></h5>
			
			<p>
				<?php _e( 'Just want a simple Front-end CSS Editor? Then select this option.', 'catalyst' ); ?>
			</p>
			
			<h5><?php _e( 'Who Sees The CSS Builder Tool', 'catalyst' ); ?></h5>
			
			<p>
				<?php _e( 'To be able to see the "Show/Hide CSS Builder" tab, let alone be able to display and use the CSS Builder Tool, the "Activate Front-end CSS Builder" option must be selected and you must be currently logged in as an Administrator. So basically, no one but you will see these items.', 'catalyst' ); ?>
			</p>
		</div>
		
		<div style="display:none;" id="css-builder-click-to-view">
			<a href="<?php echo home_url(); ?>" target="_blank"><?php _e( 'Click To View Front-end', 'catalyst' ); ?></a>
		</div>
		
		<div id="catalyst-custom-css-admin-p" class="catalyst-custom-option">
			<p>
				<textarea wrap="off" id="catalyst-custom-css" name="catalyst[custom_css]" style="width:804px; float:left; margin:5px 0 0; -webkit-border-radius: 3px 3px 3px 3px; border-radius: 3px 3px 3px 3px;" rows="20"><?php echo catalyst_get_advanced( 'custom_css' ); ?></textarea>
			</p>
		</div>
	</div>
</div>