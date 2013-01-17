<?php
/**
 * Builds the Advanced Custom Hook Boxes admin content.
 *
 * @package Catalyst
 */
?>

<div id="catalyst-advanced-options-nav-hook-boxes-box" class="catalyst-optionbox-outer-1col catalyst-all-options">
	<div class="catalyst-optionbox-inner-1col">
		<h3><?php _e( 'Custom Hook Boxes', 'catalyst' ); ?><span style="margin:-3px 10px 0 -75px !important; font-weight:normal; float:right;" class="button add-hook"><?php _e( 'Add', 'catalyst' ); ?></span> <span id="custom-hooks-tooltip" class="tooltip-mark tooltip-bottom-center">[?]</span></h3>
		
		<div class="tooltip tooltip-500 tooltip-scroll-500">
			<h5><?php _e( 'Taking WordPress Hooks To A Whole New Level!', 'catalyst' ); ?></h5>
			
			<p>
				<?php _e( 'The Custom Hook Box option makes it not only super easy to create an unlimited number of Custom Hook Boxes, but then place them in any one, multiple or all of your Layouts.', 'catalyst' ); ?>
			</p>
			
			<h5><?php _e( 'How To Use...', 'catalyst' ); ?></h5>
			
			<p>
				<?php _e( 'Give your Custom Hook Box a Name, select a Hook Location from the drop-down menu provided and select the Layouts you want your Custom Hook Box to display in by checking the boxes in the Layouts drop-down menu. Finally it\'s just a matter of adding your custom content to the Hook Box Textarea. Here you can add any type of plain text and/or HTML and even javascript and PHP code!', 'catalyst' ); ?>
			</p>
			
			<h5><?php _e( '**Important NOTE**', 'catalyst' ); ?></h5>
			
			<p>
				<?php _e( 'Be sure that each of your Custom Hook Boxes has a name given to it and is assigned to at least one Layout. Failure to do this may result in the inability to Save your Advanced Option settings.', 'catalyst' ); ?>
			</p>
			
			<h5><?php _e( 'What Happens When You Change The Name of A Custom Hook Box?', 'catalyst' ); ?></h5>
			
			<p>
				<?php _e( 'The name of a Custom Hook Box acts as it\'s ID so when you change that name it does not rename the Hook Box, but instead it creates a duplicate Custom Hook Box with the new name.', 'catalyst' ); ?>
			</p>
			
			<h5><?php _e( 'About the "EZ Home|Child Theme Home" Layout', 'catalyst' ); ?></h5>
			
			<p>
				<?php _e( 'Like the "Default" Layout this Layout always exists. What makes this Layout unique, however, is that it is only active when either the Dynamik Child Theme is active and is using an EZ Static Homepage, or when a non-Dynamik Child Theme is active and has a home.php file in its root directory. So only when these criteria are true will this Layout be able to display content on your site\'s homepage.', 'catalyst' ); ?>
			</p>
		
			<h5><?php _e( 'More Advanced...', 'catalyst' ); ?></h5>
			
			<p>
				<?php _e( 'The Custom Hook Boxes option provides an advanced feature that you may find useful at some point. By setting a Priority you can gain even more control over the placement of your Custom Hook Boxes.', 'catalyst' ); ?>
			</p>
			
			<p>
				<?php _e( 'Sometimes you may add multiple Custom Hook Boxes and/or Custom Widgets to the same Hook Location. In these cases the Priority option becomes useful. When adding a Priority you should start with the number 10 as a baseline as this is usually the default Priority level in WordPress. You could give one Hook Box or Widget a Priority of 10 and another 11 or 9 and these Custom Content areas will display before or after accordingly.', 'catalyst' ); ?>
			</p>
			
			<p>
				<?php _e( 'Finally, you\'ll notice that you can easily turn these Custom Hook Boxes on or off with the "Activate" option. This is useful when you don\'t want to delete your Custom Hook Box, but would like to remove it from your site for the time being.', 'catalyst' ); ?>
			</p>
			
			<h5><?php _e( 'Can I Add PHP Code To My Custom Hook Boxes?', 'catalyst' ); ?></h5>
			
			<p>
				<?php _e( 'Absolutely you can!  Just be careful as you can temporarily "break" your site with incorrect PHP code.', 'catalyst' ); ?>
			</p>
			
			<h5><?php _e( 'Shortcode', 'catalyst' ); ?></h5>
			
			<p>
				<?php _e( 'To use a Shortcode to display a Hook Box, use: [catalyst_hook_box name="_____"]', 'catalyst' ); ?>
			</p>
		</div>
		
		<div id="catalyst-hooks-wrap">
<?php
		if( !empty( $custom_hooks ) )
		{
			$hook_counter = 0;
			foreach( $custom_hooks as $custom_hook )
			{
				$hook_counter++;
?>				<div id="hook-<?php echo $hook_counter; ?>" class="catalyst-all-hook-boxes">
					<div class="catalyst-custom-hook-option">
						<p class="bg-box-design">
							<?php _e( 'Name', 'catalyst' ); ?> <input type="text" id="custom-hook-id-<?php echo $hook_counter; ?>" name="custom_hook_ids[<?php echo $hook_counter; ?>]" value="<?php echo $custom_hook['hook_name']; ?>" style="width:250px;" class="forbid-chars" /> <?php _e( 'Hook', 'catalyst' ); ?> <select id="custom-hook-hook-<?php echo $hook_counter; ?>" name="custom_hook_hook[<?php echo $hook_counter; ?>]" size="1" style="width:250px;"><?php catalyst_list_hooks( $custom_hook['hook_location'] ); ?></select> <?php _e( 'Priority', 'catalyst' ); ?> <input type="text" id="custom-hook-priority-<?php echo $hook_counter; ?>" name="custom_hook_priority[<?php echo $hook_counter; ?>]" value="<?php echo $custom_hook['priority']; ?>" style="width:30px;" /> |  <select id="custom-hook-active-<?php echo $hook_counter; ?>" name="custom_hook_active[<?php echo $hook_counter; ?>]" ><option value="hkd"<?php echo ( $custom_hook['is_active'] == 'hkd' ) ? ' selected="selected"' : ''; ?>><?php _e( 'Hooked', 'catalyst' ); ?></option><option value="sht"<?php echo ( $custom_hook['is_active'] == 'sht' ) ? ' selected="selected"' : ''; ?>><?php _e( 'Shortcode', 'catalyst' ); ?></option><option value="bth"<?php echo ( $custom_hook['is_active'] == 'bth' ) ? ' selected="selected"' : ''; ?>><?php _e( 'Both', 'catalyst' ); ?></option><option value="no"<?php echo ( $custom_hook['is_active'] == 'no' ) ? ' selected="selected"' : ''; ?>><?php _e( 'Deactivate', 'catalyst' ); ?></option></select>
						</p>
						<p>
							<?php _e( 'Layouts', 'catalyst' ); ?> <select class="layouts-list-multiselect" id="custom-hook-layouts-list-<?php echo $hook_counter; ?>" name="custom_hook_layouts_list[<?php echo $hook_counter; ?>][]" multiple="multiple" style="width:250px;"><?php catalyst_list_layouts( $custom_hook['layouts'] ); ?></select> <span id="<?php echo $hook_counter; ?>" class="button delete-hook"> <?php _e( 'Delete', 'catalyst' ); ?></span> <span class="view-only-hook"><?php _e( 'View Only', 'catalyst' ); ?> <span class="button" style="width:100px !important;"><a href="#wpwrap"><?php _e( 'This Hook Box', 'catalyst' ); ?></a></span></span> <span class="view-all-hooks"><?php _e( 'View', 'catalyst' ); ?> <span class="button" style="width:100px !important;"><a href="#wpwrap"><?php _e( 'All Hook Boxes', 'catalyst' ); ?></a></span></span>
						</p>
						<p>
							<textarea class="resizable" id="custom-hook-textarea-<?php echo $hook_counter; ?>" name="custom_hook_textarea[<?php echo $hook_counter; ?>]" style="width:778px;height:100px;text-align:left;"><?php echo $custom_hook['hook_textarea']; ?></textarea>
						</p>
					</div>
				</div>
<?php		}
		}
		else
		{
	?>		<div id="hook-1" class="catalyst-all-hook-boxes">
				<div class="catalyst-custom-hook-option">
					<p class="bg-box-design">
						<?php _e( 'Name', 'catalyst' ); ?> <input type="text" id="custom-hook-id-1" name="custom_hook_ids[1]" value="" style="width:250px;" class="forbid-chars" /> <?php _e( 'Hook', 'catalyst' ); ?> <select id="custom-hook-hook-1" name="custom_hook_hook[1]" size="1" style="width:250px;"><?php catalyst_list_hooks(); ?></select> <?php _e( 'Priority', 'catalyst' ); ?> <input type="text" id="custom-hook-priority-1" name="custom_hook_priority[1]" value="10" style="width:30px;" /> | <select id="custom-hook-active-1" name="custom_hook_active[1]" ><option value="hkd"><?php _e( 'Hooked', 'catalyst' ); ?></option><option value="sht"><?php _e( 'Shortcode', 'catalyst' ); ?></option><option value="bth"><?php _e( 'Both', 'catalyst' ); ?></option><option value="no"><?php _e( 'Deactivate', 'catalyst' ); ?></option></select>
					</p>
					<p>
						<?php _e( 'Layouts', 'catalyst' ); ?> <select class="layouts-list-multiselect" id="custom-hook-layouts-list-1" name="custom_hook_layouts_list[1][]" multiple="multiple" style="width:250px;"><?php catalyst_list_layouts(); ?></select> <span id="1" class="button delete-hook"> <?php _e( 'Delete', 'catalyst' ); ?></span>
					</p>
					<p>
						<textarea class="resizable" id="custom-hook-textarea-1" name="custom_hook_textarea[1]" style="width:778px;height:100px;text-align:left;"></textarea>
					</p>
				</div>
			</div>
<?php	}
?>		</div>
	</div>
</div>