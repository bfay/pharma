<?php
/**
 * Builds the Dynamik Hide admin content.
 *
 * @package Catalyst
 */
?>

<div id="catalyst-dynamik-options-nav-<?php echo $nav_alt_id; ?>hide-box" class="catalyst-optionbox-outer-1col catalyst-all-options">
	<div class="catalyst-optionbox-inner-1col">
		<h3><?php _e( '<code>display:none;</code>(Hide From View) Specific Site Elements', 'catalyst' ); ?></h3>

		<div class="catalyst-dynamik-option" style="height:auto; margin-left:0; padding-bottom:5px; padding-right:1px; float:left; -webkit-border-radius:3px; border-radius:3px;">
			<p class="bg-box-design">
				<?php _e( 'Hide Specific Page Elements', 'catalyst' ); ?><br />
				<textarea id="catalyst-remove-elements" name="catalyst[remove_elements]" style="width:100%; height:297px;"><?php echo catalyst_get_dynamik( 'remove_elements' ); ?></textarea>
			</p>
		</div>
		
		<div class="catalyst-remove-option-desc" style="height:auto; background:#FFFFFF; -webkit-border-radius:3px; border-radius:3px;">
			<p class="page-cat-id-scrollbox-225">
				<?php $pages = get_pages('orderby=ID&hide_empty=0');
				echo '<strong>Page IDs/Names</strong><br />'; 
					foreach($pages as $page) { 
						echo $page->ID . ' = ' . $page->post_name . '<br />'; 
					} ?>
			</p>
		</div>
		
		<div class="catalyst-remove-option-desc" style="height:auto; background:#FFFFFF; -webkit-border-radius:3px; border-radius:3px;">
			<p class="page-cat-id-scrollbox-225">
				<?php $cats = get_categories('orderby=ID&hide_empty=0');
				echo '<strong>Category IDs/Names</strong><br />'; 
					foreach($cats as $category) { 
						echo $category->cat_ID . ' = ' . $category->cat_name . '<br />'; 
					} ?>
			</p>
		</div>
		
		<div class="catalyst-dynamik-option" style="height:auto; margin-left:0; padding-bottom:5px; padding-right:1px; float:left; -webkit-border-radius:3px; border-radius:3px;">
			<p class="bg-box-design">
				<b><?php _e( 'Examples:', 'catalyst' ); ?></b> <span id="hide-examples-tooltip" class="tooltip-mark tooltip-top-right">[?]</span>
				<div class="tooltip tooltip-400">
					<p>
						<?php _e( 'If used in the above text box, the code examples below will remove (from view, not from the page source) different items from specified pages.', 'catalyst' ); ?>
					</p>
					
					<p>
						<?php _e( 'For example... body.page-id-27 #header-wrap will remove the Header area from a page with the ID of 27. Adjust the page IDs as needed... body.page-id-16 #navbar_wrap, body.page-id-16 #footer_wrap ...will remove the Navbars and Footer areas on a page with an ID of 16.', 'catalyst' ); ?>
					</p>
					
					<p>
						<?php _e( 'Note the comma separation, but no closing comma.', 'catalyst' ); ?>
					</p>
					
					<p>
						<?php _e( 'NOTE: If you want to physically remove Page Titles go to', 'catalyst' ); ?>
						<a href="<?php echo admin_url( 'admin.php?page=catalyst&activetab=catalyst-core-options-nav-content' ); ?>"><?php _e( '<b>(Core Options > Content > Post Options)</b>.', 'catalyst' ); ?></a>
					</p>
				</div>
				<textarea style="width:513px; height:80px; margin:0 10px 5px;">body.page-id-16 #header-wrap, body.page-id-16 #navbar-1-wrap, body.page-id-16 #navbar-2-wrap, body.page-id-16 #footer-wrap</textarea>
			</p>
		</div>
	</div>
</div>