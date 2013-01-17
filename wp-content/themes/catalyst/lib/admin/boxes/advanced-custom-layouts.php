<?php
/**
 * Builds the Advanced Custom Layouts admin content.
 *
 * @package Catalyst
 */
?>

<div id="catalyst-advanced-options-nav-layouts-box" class="catalyst-optionbox-outer-1col catalyst-all-options catalyst-options-display">
	<div class="catalyst-optionbox-inner-1col">
		<h3><?php _e( 'Custom Layouts', 'catalyst' ); ?>
		<?php if ( defined('DYNAMIK_ACTIVE') ) { ?>
		<b><a href="<?php echo admin_url( 'admin.php?page=dynamik-options&activetab=catalyst-dynamik-options-nav-widths' ); ?>"><?php _e( '[Set Layout Widths Here]', 'catalyst' ); ?></a></b>
		<?php } ?>
		<span style="margin:-3px 10px 0 -75px !important; font-weight:normal; float:right;" class="button add-layout"><?php _e( 'Add', 'catalyst' ); ?></span><span id="custom-layouts-tooltip" class="tooltip-mark tooltip-bottom-center">[?]</span></h3>
	
		<div class="tooltip tooltip-500 tooltip-scroll-500">
			<h5><?php _e( 'Unlimited Possibilities!', 'catalyst' ); ?></h5>
			
			<p>
				<?php _e( 'The Custom Layout option, in conjunction with the Custom Widgets and Custom Hook Boxes features provide you with truly unlimited possibilities when it comes to displaying your content.', 'catalyst' ); ?>
			</p>
			
			<h5><?php _e( 'How To Use...', 'catalyst' ); ?></h5>
			
			<p>
				<?php _e( 'It couldn\'t be simpler. Just give your Custom Layout a name, choose a Layout from the drop-down menu and then click the big, blue "Save Changes" button and you\'re done. Then, when you\'re', 'catalyst' ); ?>
				<a href="<?php echo admin_url( 'edit.php?post_type=page' ); ?>"><?php _e( '<b>Editing A Page</b>', 'catalyst' ); ?></a>
				<?php _e( 'or', 'catalyst' ); ?>
				<a href="<?php echo admin_url( 'edit.php?post_type=post' ); ?>"><?php _e( '<b>Editing A Post</b>', 'catalyst' ); ?></a>
				<?php _e( 'you can select your Custom Layouts from the Catalyst Layout drop-down menu provided.', 'catalyst' ); ?>
				<img src="<?php echo get_template_directory_uri(); ?>/lib/css/images/tooltips/tooltip-custom-layouts.png"/>
			</p>
			
			<h5><?php _e( '**Important Information About Naming Your Custom Layout**', 'catalyst' ); ?></h5>
			
			<p>
				<?php _e( 'When you name your Custom Layout you are not only giving that Layout an "ID" based on the name, but you are also creating a new body class for all pages that use that Custom Layout. This can be useful as it allows you to create Custom CSS that can focus specifically on such pages, but it can also cause problems if you use certain names.', 'catalyst' ); ?>
			</p>
			
			<p>
				<?php _e( 'The reason for this is because WordPres also adds certain body classes for specific page types. So if you name your Custom Layout the same as one of those WordPress body class names you may cause some conflicts with the CSS for such pages. So the simple point to this is that you should not name your Custom Layout the same as the following names:', 'catalyst' ); ?>
			</p>
			
			<p>
				<?php _e( 'blog, home, post, page, single, archive, date, category, tag, search, error404', 'catalyst' ); ?>
			</p>
			
			<p>
				<?php _e( 'This doesn\'t mean you can\'t use those words, just not ONLY those words. So it\'s OK to use homepage or home_1, just not home. Or you could use blogpage or blog_page or blog1, just not blog by itself.', 'catalyst' ); ?>
			</p>
			
			<p>
				<?php _e( 'Also, because your Custom Layout "Name" creates a new body class it cannot start with a number (in CSS you cannot start a class with a number). So layout_1 is OK, but 1_layout is not.', 'catalyst' ); ?>
			</p>
			
			<h5><?php _e( 'What Happens When You Change The Name of A Custom Layout?', 'catalyst' ); ?></h5>
			
			<p>
				<?php _e( 'The name of a Custom Layout acts as it\'s ID so when you change that name it does not rename the Layout, but instead it creates a duplicate Custom Layout with the new name. Because the name acts as the ID that name is connected to any pages/posts you assign it to as well as any Custom Widget Areas and Hook Boxes that have been assigned to it. Because of this you should be careful not to delete Custom Layouts before making sure they are not connected to any pages, posts, Widget Areas or Hook Boxes.', 'catalyst' ); ?>
			</p>
			
			<h5><?php _e( 'Catalyst "Special Layouts"', 'catalyst' ); ?></h5>
			
			<p>
				<?php _e( 'There are currently two types of "Special Layouts" that you can create with the Custom Layouts feature.', 'catalyst' ); ?>
				<ul>
					<li>
						<?php _e( '<strong>Catalyst Landing Page</strong> | When you create a Custom Layout with a name that starts with catalyst_landing_page you will be presented with a layout that strips out your Header, Navbars, Breadcrumbs and Footer, leaving you with a nice, simple "Box" to create your Landing or Squeeze Page with. <strong><a href="http://catalysttheme.com/how-to-create-landing-page-custom-layouts-using-catalyst/" target="_blank">Learn More About This Here</a></strong>', 'catalyst' ); ?>
					</li>
					
					<li>
						<?php _e( '<strong>Using Default Sidebars</strong> | When you create a Custom Layout with a name that starts with default_sidebars this layout will use the Default Sidebars and the Widgets that reside in them. This is ideal when you want to create a Custom Layout that has it\'s own layout structure, but not it\'s own unique sidebars. <strong><a href="http://catalysttheme.com/how-to-create-a-custom-layout-that-uses-the-default-sidebars/" target="_blank">Learn More About This Here</a></strong>', 'catalyst' ); ?>
					</li>
				</ul>
			</p>
		
			<h5><?php _e( 'Just The Beginning...', 'catalyst' ); ?></h5>
			
			<p>
				<?php _e( 'Once you\'ve created a Custom Layout or two you will see that these layouts are perfect placeholders for the unlimited number of Custom Widgets and Hook Boxes available to you through these Advanced Options.', 'catalyst' ); ?>
			</p>
		</div>
				
		<div id="catalyst-layouts-wrap">
<?php
		if( !empty( $custom_layouts ) )
		{
			$layout_counter = 0;
			foreach( $custom_layouts as $custom_layout )
			{
				$layout_counter++;
?>				<div id="layout-<?php echo $layout_counter; ?>">
					<div class="catalyst-custom-layout-option-desc">
						<p>
							<?php _e( 'Custom Layout Options:', 'catalyst' ); ?>
						</p>
					</div>
					
					<div class="catalyst-custom-layout-option">
						<p class="bg-box-design">
							<?php _e( 'Name', 'catalyst' ); ?>
							<input type="text" id="custom-layout-id-<?php echo $layout_counter; ?>" name="custom_layout_ids[]" value="<?php echo $custom_layout['layout_id']; ?>" style="width:235px;" class="forbid-chars forbid-names" />
							<select id="custom-layout-type-<?php echo $layout_counter; ?>" name="custom_layout_types[]" size="1" style="width:155px;"><?php catalyst_list_layout_types( $custom_layout['type'] ); ?></select>
							<span id="<?php echo $layout_counter; ?>" class="button delete-layout"><?php _e( 'Delete', 'catalyst' ); ?></span>
						</p>
					</div>
				</div>
<?php		}
		}
		else
		{
	?>		<div id="layout-1">
				<div class="catalyst-custom-layout-option-desc">
					<p>
						<?php _e( 'Custom Layout Options:', 'catalyst' ); ?>
					</p>
				</div>
				
				<div class="catalyst-custom-layout-option">
					<p class="bg-box-design">
						<?php _e( 'Name', 'catalyst' ); ?>
						<input type="text" id="custom-layout-id-1" name="custom_layout_ids[]" value="" style="width:235px;" class="forbid-chars forbid-names" />
						<select id="custom-layout-type-1" name="custom_layout_types[]" size="1" style="width:155px;"><?php catalyst_list_layout_types(); ?></select>
						<span id="1" class="button delete-layout"><?php _e( 'Delete', 'catalyst' ); ?></span>
					</p>
				</div>
			</div>
<?php	}
?>
		</div>	
	</div>
</div>