<?php
/**
 * Builds the Advanced Custom Widget Areas admin content.
 *
 * @package Catalyst
 */
?>

<div id="catalyst-advanced-options-nav-widget-areas-box" class="catalyst-optionbox-outer-1col catalyst-all-options">
	<div class="catalyst-optionbox-inner-1col">
		<h3><?php _e( 'Custom Widget Areas', 'catalyst' ); ?><span style="margin:-3px 10px 0 -75px !important; font-weight:normal; float:right;" class="button add-widget"><?php _e( 'Add', 'catalyst' ); ?></span> <span id="custom-widgets-tooltip" class="tooltip-mark tooltip-bottom-center">[?]</span></h3>
		
		<div class="tooltip tooltip-500 tooltip-scroll-500">
			<h5><?php _e( 'Widgets, Widgets and More Widgets!', 'catalyst' ); ?></h5>
			
			<p>
				<?php _e( 'The Custom Widgets option makes it not only super easy to create an unlimited number of Custom Widgets, but then place them in any one, multiple or all of your Layouts.', 'catalyst' ); ?>
			</p>
			
			<h5><?php _e( 'How To Use...', 'catalyst' ); ?></h5>
			
			<p>
				<?php _e( 'Give your Custom Widget a Name, select a Hook Location from the drop-down menu provided and select the Layouts you want your Custom Widget to display in by checking the boxes in the Layouts drop-down menu. Those few steps are all you need to take to successfully create a Custom Widget.', 'catalyst' ); ?>
			</p>
			
			<p>
				<?php _e( 'Once created you can add Widgets to this new Widget Area by going to', 'catalyst' ); ?>
				<a href="<?php echo admin_url( 'widgets.php' ); ?>"><?php _e( '<b>(Appearance > Widgets)</b>', 'catalyst' ); ?></a>
				<?php _e( 'and dragging the Widgets into your Widget Area.', 'catalyst' ); ?>
			</p>
			
			<h5><?php _e( '**Important NOTE**', 'catalyst' ); ?></h5>
			
			<p>
				<?php _e( 'Be sure that each of your Custom Widget Areas has a name given to it and is assigned to at least one Layout. Failure to do this may result in the inability to Save your Advanced Option settings.', 'catalyst' ); ?>
			</p>
			
			<h5><?php _e( 'What Happens When You Change The Name of A Custom Widget Area?', 'catalyst' ); ?></h5>
			
			<p>
				<?php _e( 'The name of a Custom Widget Area acts as it\'s ID so when you change that name it does not rename the Widget Area, but instead it creates a duplicate Custom Widget Area with the new name.', 'catalyst' ); ?>
			</p>
			
			<h5><?php _e( 'About the "EZ Home|Child Theme Home" Layout', 'catalyst' ); ?></h5>
			
			<p>
				<?php _e( 'Like the "Default" Layout this Layout always exists. What makes this Layout unique, however, is that it is only active when either the Dynamik Child Theme is active and is using an EZ Static Homepage, or when a non-Dynamik Child Theme is active and has a home.php file in its root directory. So only when these criteria are true will this Layout be able to display content on your site\'s homepage.', 'catalyst' ); ?>
			</p>
		
			<h5><?php _e( 'More Advanced...', 'catalyst' ); ?></h5>
			
			<p>
				<?php _e( 'The Custom Widgets option provides a few advanced features that you may find useful at some point. First, you can give these Widgets a Custom Class so you can uniquely style it with CSS if you need to. Also, by setting a Priority you can gain even more control over the placement of your Custom Widgets.', 'catalyst' ); ?>
			</p>
			
			<p>
				<?php _e( 'Sometimes you may add multiple Custom Widgets and/or Hook Boxes to the same Hook Location. In these cases the Priority option becomes useful. When adding a Priority you should start with the number 10 as a baseline as this is usually the defualt Priority level in WordPress. You could give one Widget or Hook Box a Priority of 10 and another 11 or 9 and these Custom Content areas will display before or after accordingly.', 'catalyst' ); ?>
			</p>
			
			<p>
				<?php _e( 'Finally, you\'ll notice that you can easily turn these Custom Widgets on or off with the "Activate" option. This is useful when you don\'t want to delete your Custom Widget, but would like to remove it from your site for the time being.', 'catalyst' ); ?>
			</p>
			
			<h5><?php _e( 'Shortcode', 'catalyst' ); ?></h5>
			
			<p>
				<?php _e( 'To use a Shortcode to display a Widget Area, use: [catalyst_widget_area name="_____"]', 'catalyst' ); ?>
			</p>
		</div>
		
		<div id="catalyst-widgets-wrap">
<?php
		if( !empty( $custom_widgets ) )
		{
			$widget_counter = 0;
			foreach( $custom_widgets as $custom_widget )
			{
				$widget_counter++;
?>				<div id="widget-<?php echo $widget_counter; ?>">
				<div class="catalyst-custom-widget-option">
					<p class="bg-box-design">
						<?php _e( 'Name', 'catalyst' ); ?> <input type="text" id="custom-widget-id-<?php echo $widget_counter; ?>" name="custom_widget_ids[<?php echo $widget_counter; ?>]" value="<?php echo $custom_widget['widget_name']; ?>" style="width:250px;" class="forbid-chars" />	 <?php _e( 'Hook', 'catalyst' ); ?> <select id="custom-widget-hook-<?php echo $widget_counter; ?>" name="custom_widget_hook[<?php echo $widget_counter; ?>]" size="1" style="width:250px;"><?php catalyst_list_hooks( $custom_widget['hook_location'] ); ?></select> <?php _e( 'Priority', 'catalyst' ); ?> <input type="text" id="custom-widget-priority-<?php echo $widget_counter; ?>" name="custom_widget_priority[<?php echo $widget_counter; ?>]" value="<?php echo $custom_widget['priority']; ?>" style="width:30px;" /> | <select id="custom-widget-active-<?php echo $widget_counter; ?>" name="custom_widget_active[<?php echo $widget_counter; ?>]" ><option value="hkd"<?php echo ( $custom_widget['is_active'] == 'hkd' ) ? ' selected="selected"' : ''; ?>><?php _e( 'Hooked', 'catalyst' ); ?></option><option value="sht"<?php echo ( $custom_widget['is_active'] == 'sht' ) ? ' selected="selected"' : ''; ?>><?php _e( 'Shortcode', 'catalyst' ); ?></option><option value="bth"<?php echo ( $custom_widget['is_active'] == 'bth' ) ? ' selected="selected"' : ''; ?>><?php _e( 'Both', 'catalyst' ); ?></option><option value="no"<?php echo ( $custom_widget['is_active'] == 'no' ) ? ' selected="selected"' : ''; ?>><?php _e( 'Deactivate', 'catalyst' ); ?></option></select>
					</p>
					<p>
					<?php _e( 'Layouts', 'catalyst' ); ?> <select class="layouts-list-multiselect" id="custom-layouts-list-<?php echo $widget_counter; ?>" name="custom_layouts_list[<?php echo $widget_counter; ?>][]" multiple="multiple" style="width:250px;"><?php catalyst_list_layouts( $custom_widget['layouts'] ); ?></select> <?php _e( 'Class', 'catalyst' ); ?> <input type="text" id="custom-widget-class-<?php echo $widget_counter; ?>" name="custom_widget_class[<?php echo $widget_counter; ?>]" value="<?php echo $custom_widget['class']; ?>" style="width:250px;" /> <span id="<?php echo $widget_counter; ?>" class="button delete-widget"> <?php _e( 'Delete', 'catalyst' ); ?></span>
					</p>
				</div>
				</div>
<?php		}
		}
		else
		{
	?>		<div id="widget-1">
			<div class="catalyst-custom-widget-option">
				<p class="bg-box-design">
					<?php _e( 'Name', 'catalyst' ); ?> <input type="text" id="custom-widget-id-1" name="custom_widget_ids[1]" value="" style="width:250px;" class="forbid-chars" /> <?php _e( 'Hook', 'catalyst' ); ?> <select id="custom-widget-hook-1" name="custom_widget_hook[1]" size="1" style="width:250px;"><?php catalyst_list_hooks(); ?></select> <?php _e( 'Priority', 'catalyst' ); ?> <input type="text" id="custom-widget-priority-1" name="custom_widget_priority[1]" value="10" style="width:30px;" /> | <select id="custom-widget-active-1" name="custom_widget_active[1]" ><option value="hkd"><?php _e( 'Hooked', 'catalyst' ); ?></option><option value="sht"><?php _e( 'Shortcode', 'catalyst' ); ?></option><option value="bth"><?php _e( 'Both', 'catalyst' ); ?></option><option value="no"><?php _e( 'Deactivate', 'catalyst' ); ?></option></select>
				</p>
				<p>
				<?php _e( 'Layouts', 'catalyst' ); ?> <select class="layouts-list-multiselect" name="custom_layouts_list[1][]" multiple="multiple" style="width:250px;"><?php catalyst_list_layouts(); ?></select> <?php _e( 'Class', 'catalyst' ); ?> <input type="text" id="custom-widget-class-1" name="custom_widget_class[1]" value="" style="width:250px;" /> <span id="1" class="button delete-widget"> <?php _e( 'Delete', 'catalyst' ); ?></span>
				</p>
			</div>
			</div>
<?php	}
?>		</div>
	</div>
</div>