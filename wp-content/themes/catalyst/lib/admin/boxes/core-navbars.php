<?php
/**
 * Builds the Core Navbars admin content.
 *
 * @package Catalyst
 */
?>

<div id="catalyst-core-options-nav-navbars-box" class="catalyst-all-options">

	<h3><?php _e( 'Navbar Options', 'catalyst' ); ?></h3>

	<div class="catalyst-optionbox-2col-left-wrap">

		<div class="catalyst-optionbox-outer-2col">
			<div class="catalyst-optionbox-inner-2col">
				<h4><?php _e( 'Navbar 1 Options', 'catalyst' ); ?></h4>
				<?php
				if( version_compare(get_bloginfo("version"), '2.9.2', '>') )
				{ ?>
				<div class="catalyst-optionset">
					<p>
						<?php _e( 'Navbar 1 Type', 'catalyst' ); ?> <select id="catalyst-nav1-type" name="catalyst[nav1_type]" size="1" style="width:95px;">
							<option value="Default"<?php if (catalyst_get_core( 'nav1_type' ) == 'Default') echo ' selected="selected"'; ?>><?php _e( 'Default', 'catalyst' ); ?></option>
							<option value="Custom"<?php if (catalyst_get_core( 'nav1_type' ) == 'Custom') echo ' selected="selected"'; ?>><?php _e( 'Custom', 'catalyst' ); ?></option>
							<option value="None"<?php if (catalyst_get_core( 'nav1_type' ) == 'None') echo ' selected="selected"'; ?>><?php _e( 'None', 'catalyst' ); ?></option>
						</select> <span id="navbar-type-tooltip" class="tooltip-mark tooltip-bottom-right">[?]</span>
					</p>
					
					<div class="tooltip tooltip-500">
						<h5><?php _e( 'Default vs Custom Navigation Menus:', 'catalyst' ); ?></h5>
						<p>
							<?php _e( 'Here you can choose to either use the Default Catalyst Navbar or a Custom WordPress Menu for this Navbar, or None. If you choose "Default" then the <b>Display Options</b> below will apply. If you choose "Custom" then these options will not apply and you\'ll need to create a WordPress Custom Menu by going to', 'catalyst' ); ?>
							<a href="<?php echo admin_url( 'nav-menus.php' ); ?>"><?php _e( '<b>(Appearance > Menus)</b>', 'catalyst' ); ?></a>
							<?php _e( 'in your WordPress Dashboard.', 'catalyst' ); ?>
						</p>
						
						<h5><?php _e( 'Once A Custom Menu Is Created...', 'catalyst' ); ?></h5>
						<p>
							<?php _e( '...you will need to assign that Menu to a "Theme Location" as shown here:', 'catalyst' ); ?>
							<img src="<?php echo get_template_directory_uri(); ?>/lib/css/images/tooltips/tooltip-custom-menu.png"/>
							<?php _e( '<b>NOTE</b> the reference to "Navbar 1" and "Navbar 2" in the screenshot, refering to which of the two built-in Catalyst Navbars will receive the Custom Menu. Just make sure that if you select a Custom Menu for either Navbar that the "Custom" Navbar Type is selected for that Navbar.', 'catalyst' ); ?>
						</p>
					</div>
					
					<p>
						<input type="checkbox" id="catalyst-nav1-enable-superfish" name="catalyst[nav1_enable_superfish]" value="1" <?php if( checked( 1, catalyst_get_core( 'nav1_enable_superfish' ) ) ); ?> /> <?php _e( 'Enable jQuery Dropdowns', 'catalyst' ); ?><br />
						<input type="checkbox" id="catalyst-navbar-superfish-arrows" name="catalyst[navbar_superfish_arrows]" value="1" <?php if( checked( 1, catalyst_get_core( 'navbar_superfish_arrows' ) ) ); ?> /> <?php _e( 'Enable jQuery Sub-Indicators >> (This effects both Navbars)', 'catalyst' ); ?>
					</p>
				</div>
				<?php
				}
				?>
				
				<div id="catalyst-display-default-nav1-box" style="display:none;">
					<div class="bg-box">
						<p>
							<b><?php _e( 'Navbar 1 Display Options:', 'catalyst' ); ?></b>
						</p>
						
						<p>
							<?php _e( 'Content To Display', 'catalyst' ); ?> <select id="catalyst-nav1-content" name="catalyst[nav1_content]" size="1" style="width:115px;">
								<option value="pages"<?php if (catalyst_get_core( 'nav1_content' ) == 'pages') echo ' selected="selected"'; ?>><?php _e( 'Pages', 'catalyst' ); ?></option>
								<option value="categories"<?php if (catalyst_get_core( 'nav1_content' ) == 'categories') echo ' selected="selected"'; ?>><?php _e( 'Categories', 'catalyst' ); ?></option>
							</select>
						</p>
						
						<p>
							<?php _e( 'Submenu Navigation Depth', 'catalyst' ); ?> <select id="catalyst-nav1-submenu-depth" name="catalyst[nav1_submenu_depth]" size="1" style="width:80px;">
								<option value="No Limit"<?php if (catalyst_get_core( 'nav1_submenu_depth' ) == 'No Limit') echo ' selected="selected"'; ?>><?php _e( 'No Limit', 'catalyst' ); ?></option>
								<option value="1"<?php if (catalyst_get_core( 'nav1_submenu_depth' ) == '1') echo ' selected="selected"'; ?>>1</option>
								<option value="2"<?php if (catalyst_get_core( 'nav1_submenu_depth' ) == '2') echo ' selected="selected"'; ?>>2</option>
								<option value="3"<?php if (catalyst_get_core( 'nav1_submenu_depth' ) == '3') echo ' selected="selected"'; ?>>3</option>
								<option value="4"<?php if (catalyst_get_core( 'nav1_submenu_depth' ) == '4') echo ' selected="selected"'; ?>>4</option>
							</select>
						</p>
					</div>
					
					<div class="bg-box">
						<p><?php _e( '\'Home\' Tab Text', 'catalyst' ); ?>
							<input type="text" id="catalyst-nav1-home-tab-text" name="catalyst[nav1_home_tab_text]" value="<?php echo catalyst_get_core( 'nav1_home_tab_text' ) ?>" style="width:180px;" />
						</p>
						
						<p style="margin-top:-10px; font-size:10px;">
							<?php _e( 'Delete text to remove the home link from navbar.', 'catalyst' ); ?>
						</p>
					</div>
					
					<div class="bg-box">
						<p>
							<?php _e( 'Include Navbar 1 Page or Category IDs:', 'catalyst' ); ?><br />
							<input type="text" id="catalyst-nav1-include-pages" name="catalyst[nav1_include_pages]" value="<?php echo catalyst_get_core( 'nav1_include_pages' )?>" style="width:310px;" />
							<span id="navbar-include-exclude-tooltip" class="tooltip-mark tooltip-center-right">[?]</span>
						</p>
						
						<div class="tooltip tooltip-400">
							<h5><?php _e( 'Control The Content In Your Navbars', 'catalyst' ); ?></h5>
							<p>
								<?php _e( 'When using the "Default" Navbar Type in Catalyst you are able to control what Pages and Categories display in your Navbars. With these Include and Exclude options you are able to choose what displays and what does not by adding Page and Category ID\'s into their corresponding fields.', 'catalyst' ); ?>
							</p>
							
							<p>
								<?php _e( 'As you can see by the example in this screenshot you need to comma separate your ID\'s and leave no spaces:', 'catalyst' ); ?>
								<img src="<?php echo get_template_directory_uri(); ?>/lib/css/images/tooltips/tooltip-navbar-include-exclude.png"/>
							</p>
							
							<h5><?php _e( 'Include vs Exclude:', 'catalyst' ); ?></h5>
							<p>
								<?php _e( 'If you leave both options blank your Navbar will, by default, display ALL Pages or Categories. By adding ID\'s to the Include option you are saying include ONLY these Pages or Categories. By adding ID\'s to the Exclude option you are saying exclude ONLY these Pages or Categories.', 'catalyst' ); ?>
							</p>
						</div>
						
						<p>
							<?php _e( 'Exclude Navbar 1 Page or Category IDs:', 'catalyst' ); ?><br />	
							<input type="text" id="catalyst-nav1-exclude-pages" name="catalyst[nav1_exclude_pages]" value="<?php echo catalyst_get_core( 'nav1_exclude_pages' )?>" style="width:310px;" />
							<span id="navbar-page-cat-ids-tooltip" class="tooltip-mark tooltip-center-right">[IDs]</span>
						</p>
						
						<div class="tooltip tooltip-400">
							<h5><?php _e( 'Page/Category ID Reference:', 'catalyst' ); ?></h5>
							<p class="page-cat-id-scrollbox-378">
								<?php $pages = get_pages('orderby=ID&hide_empty=0');
								echo '<strong>Page IDs/Names</strong><br />'; 
									foreach($pages as $page) { 
										echo $page->ID . ' = ' . $page->post_name . '<br />'; 
									} ?>
							</p>
						
							<p class="page-cat-id-scrollbox-378">
								<?php $cats = get_categories('orderby=ID&hide_empty=0');
								echo '<strong>Category IDs/Names</strong><br />'; 
									foreach($cats as $category) { 
										echo $category->cat_ID . ' = ' . $category->cat_name . '<br />'; 
									} ?>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="catalyst-optionbox-outer-2col">
			<div class="catalyst-optionbox-inner-2col">
				<h4><?php _e( 'Navbar 2 Options', 'catalyst' ); ?></h4>
				<?php
				if( version_compare(get_bloginfo("version"), '2.9.2', '>') )
				{ ?>
				<div class="catalyst-optionset">
					<p>
						<?php _e( 'Navbar 2 Type', 'catalyst' ); ?> <select id="catalyst-nav2-type" name="catalyst[nav2_type]" size="1" style="width:95px;">
							<option value="Default"<?php if (catalyst_get_core( 'nav2_type' ) == 'Default') echo ' selected="selected"'; ?>><?php _e( 'Default', 'catalyst' ); ?></option>
							<option value="Custom"<?php if (catalyst_get_core( 'nav2_type' ) == 'Custom') echo ' selected="selected"'; ?>><?php _e( 'Custom', 'catalyst' ); ?></option>
							<option value="None"<?php if (catalyst_get_core( 'nav2_type' ) == 'None') echo ' selected="selected"'; ?>><?php _e( 'None', 'catalyst' ); ?></option>
						</select>
					</p>
					
					<p>
						<input type="checkbox" id="catalyst-nav2-enable-superfish" name="catalyst[nav2_enable_superfish]" value="1" <?php if( checked( 1, catalyst_get_core( 'nav2_enable_superfish' ) ) ); ?> /> <?php _e( 'Enable jQuery Dropdowns', 'catalyst' ); ?>
					</p>
				</div>
				<?php
				}
				?>
				
				<div id="catalyst-display-default-nav2-box" style="display:none;">
					<div class="bg-box">
						<p>
							<b><?php _e( 'Navbar 2 Display Options:', 'catalyst' ); ?></b><br />
						</p>
						
						<p>
							<?php _e( 'Content To Display', 'catalyst' ); ?> <select id="catalyst-nav2-content" name="catalyst[nav2_content]" size="1" style="width:115px;">
								<option value="pages"<?php if (catalyst_get_core( 'nav2_content' ) == 'pages') echo ' selected="selected"'; ?>><?php _e( 'Pages', 'catalyst' ); ?></option>
								<option value="categories"<?php if (catalyst_get_core( 'nav2_content' ) == 'categories') echo ' selected="selected"'; ?>><?php _e( 'Categories', 'catalyst' ); ?></option>
							</select>
						</p>
						
						<p>
							<?php _e( 'Submenu Navigation Depth', 'catalyst' ); ?> <select id="catalyst-nav2-submenu-depth" name="catalyst[nav2_submenu_depth]" size="1" style="width:80px;">
								<option value="No Limit"<?php if (catalyst_get_core( 'nav2_submenu_depth' ) == 'No Limit') echo ' selected="selected"'; ?>><?php _e( 'No Limit', 'catalyst' ); ?></option>
								<option value="1"<?php if (catalyst_get_core( 'nav2_submenu_depth' ) == '1') echo ' selected="selected"'; ?>><?php _e( '1', 'catalyst' ); ?></option>
								<option value="2"<?php if (catalyst_get_core( 'nav2_submenu_depth' ) == '2') echo ' selected="selected"'; ?>><?php _e( '2', 'catalyst' ); ?></option>
								<option value="3"<?php if (catalyst_get_core( 'nav2_submenu_depth' ) == '3') echo ' selected="selected"'; ?>><?php _e( '3', 'catalyst' ); ?></option>
								<option value="4"<?php if (catalyst_get_core( 'nav2_submenu_depth' ) == '4') echo ' selected="selected"'; ?>><?php _e( '4', 'catalyst' ); ?></option>
							</select>
						</p>
					</div>
					
					<div class="bg-box">
						<p><?php _e( '\'Home\' Tab Text', 'catalyst' ); ?>
							<input type="text" id="catalyst-nav2-home-tab-text" name="catalyst[nav2_home_tab_text]" value="<?php echo catalyst_get_core( 'nav2_home_tab_text' ) ?>" style="width:180px;" />
						</p>
						<p style="margin-top:-10px; font-size:10px;">
							<?php _e( 'Delete text to remove the home link from navbar.', 'catalyst' ); ?>
						</p>
					</div>
					
					<div class="bg-box">
						<p>
							<?php _e( 'Include Navbar 2 Page or Category IDs:', 'catalyst' ); ?><br />
							<input type="text" id="catalyst-nav2-include-pages" name="catalyst[nav2_include_pages]" value="<?php echo catalyst_get_core( 'nav2_include_pages' )?>" style="width:100%;" />
						</p>
						
						<p>
							<?php _e( 'Exclude Navbar 2 Page or Category IDs:', 'catalyst' ); ?><br />
							<input type="text" id="catalyst-nav2-exclude-pages" name="catalyst[nav2_exclude_pages]" value="<?php echo catalyst_get_core( 'nav2_exclude_pages' )?>" style="width:100%;" />
						</p>
					</div>
				</div>
			</div>
		</div>
		
	</div>
	<div class="catalyst-optionbox-2col-right-wrap">
	
		<div class="catalyst-optionbox-outer-2col">
			<div class="catalyst-optionbox-inner-2col">
				<h4><?php _e( 'Navbar Right Display Options', 'catalyst' ); ?></h4>
				<div class="bg-box">
					<p>
						<b><?php _e( 'Navbar 1 Right Side Display Options:', 'catalyst' ); ?></b>
					</p>
					
					<p>
						<?php _e( 'Right Side Content', 'catalyst' ); ?> <select id="catalyst-nav1-right-content" name="catalyst[nav1_right_content]" size="1" style="width:100px;">
							<option value="Empty"<?php if( catalyst_get_core( 'nav1_right_content' ) == 'Empty' ) echo ' selected="selected"'; ?>><?php _e( 'Empty', 'catalyst' ); ?></option>
							<option value="Blog Feeds"<?php if( catalyst_get_core( 'nav1_right_content' ) == 'Blog Feeds' ) echo ' selected="selected"'; ?>><?php _e( 'Blog Feeds', 'catalyst' ); ?></option>
							<option value="Twitter"<?php if( catalyst_get_core( 'nav1_right_content' ) == 'Twitter' ) echo ' selected="selected"'; ?>><?php _e( 'Twitter', 'catalyst' ); ?></option>
							<option value="Search"<?php if( catalyst_get_core( 'nav1_right_content' ) == 'Search' ) echo ' selected="selected"'; ?>><?php _e( 'Search', 'catalyst' ); ?></option>
							<option value="Text"<?php if( catalyst_get_core( 'nav1_right_content' ) == 'Text' ) echo ' selected="selected"'; ?>><?php _e( 'Text', 'catalyst' ); ?></option>
						</select> <span id="navbar-right-content-tooltip" class="tooltip-mark tooltip-center-left">[?]</span>
					</p>
					
					<div class="tooltip tooltip-400">
						<h5><?php _e( 'Navbar "Extras"', 'catalyst' ); ?></h5>
						<p>
							<?php _e( 'Use this option to display different types of content in the right side of your Navbars. Note that the "Text" option allows you to insert any type of plain text, HTML and/or PHP code into the right side of your Navbars by adding it to the <b>Navbar Text</b> option boxes below.', 'catalyst' ); ?>
						</p>
						
						<p>
							<img src="<?php echo get_template_directory_uri(); ?>/lib/css/images/tooltips/tooltip-navbar-right.png"/>
						</p>

						<p>
							<?php _e( 'When using this option you\'ll want to add any corresponding information into the <b>Navbar Right Links/Text</b> options below.', 'catalyst' ); ?>
						</p>
					</div>
					
					<p id="catalyst-display-nav1-text-box" style="display:none;">
						<?php _e( 'Navbar 1 Right Text:', 'catalyst' ); ?><br />
						<textarea id="catalyst-nav1-right-text" name="catalyst[nav1_right_text]" style="width:100%; height:145px;"><?php if( catalyst_get_core( 'nav1_right_text' )) echo catalyst_get_core( 'nav1_right_text' ); ?></textarea>
					</p>
				</div>
				
				<div class="bg-box">
					<p>
						<b><?php _e( 'Navbar 2 Right Side Display Options:', 'catalyst' ); ?></b>
					</p>
					
					<p>
						<?php _e( 'Right Side Content', 'catalyst' ); ?> <select id="catalyst-nav2-right-content" name="catalyst[nav2_right_content]" size="1" style="width:100px;">
							<option value="Empty"<?php if( catalyst_get_core( 'nav2_right_content' ) == 'Empty' ) echo ' selected="selected"'; ?>><?php _e( 'Empty', 'catalyst' ); ?></option>
							<option value="Blog Feeds"<?php if( catalyst_get_core( 'nav2_right_content' ) == 'Blog Feeds' ) echo ' selected="selected"'; ?>><?php _e( 'Blog Feeds', 'catalyst' ); ?></option>
							<option value="Twitter"<?php if( catalyst_get_core( 'nav2_right_content' ) == 'Twitter' ) echo ' selected="selected"'; ?>><?php _e( 'Twitter', 'catalyst' ); ?></option>
							<option value="Search"<?php if( catalyst_get_core( 'nav2_right_content' ) == 'Search' ) echo ' selected="selected"'; ?>><?php _e( 'Search', 'catalyst' ); ?></option>
							<option value="Text"<?php if( catalyst_get_core( 'nav2_right_content' ) == 'Text' ) echo ' selected="selected"'; ?>><?php _e( 'Text', 'catalyst' ); ?></option>
						</select>
					</p>
					
					<p id="catalyst-display-nav2-text-box" style="display:none;">
						<?php _e( 'Navbar 2 Right Text:', 'catalyst' ); ?><br />
						<textarea id="catalyst-nav2-right-text" name="catalyst[nav2_right_text]" style="width:100%; height:145px;"><?php if( catalyst_get_core( 'nav2_right_text' ) ) echo catalyst_get_core( 'nav2_right_text' ); ?></textarea>
					</p>
				</div>
			</div>
		</div>
	
		<div class="catalyst-optionbox-outer-2col">
			<div class="catalyst-optionbox-inner-2col">
				<h4><?php _e( 'Navbar Right Links/Text', 'catalyst' ); ?> <span id="navbar-right-links-tooltip" class="tooltip-mark tooltip-center-left">[?]</span></h4>
				
				<div class="tooltip tooltip-400">
					<h5><?php _e( 'RSS Subscription Link:', 'catalyst' ); ?></h5>
					
					<p>
						<?php _e( 'This would be the link to your blog\'s RSS feed such as the default one (ie. http://your-blog.com/feed) or from something like', 'catalyst' ); ?>
						<a href="http://feedburner.google.com/"><?php _e( '<strong>Feedburner</strong>.', 'catalyst' ); ?></a>
					</p>
					
					<h5><?php _e( 'Email Subscription Link:', 'catalyst' ); ?></h5>
					
					<p>
						<?php _e( 'This would be the link to your blog\'s Email feed (eg.', 'catalyst' ); ?>
						<a href="http://feedburner.google.com/"><?php _e( '<strong>Feedburner</strong>', 'catalyst' ); ?></a> <?php _e( 'Email Subscription).', 'catalyst' ); ?>
					</p>
					
					<h5><?php _e( 'Twitter ID:', 'catalyst' ); ?></h5>
					
					<p>
						<?php _e( 'This would be your actual Twitter ID, not the entire URL to your Twitter ID (eg. catalysttheme NOT http://twitter.com/catalysttheme).', 'catalyst' ); ?></a>
					</p>
				</div>
				
				<div class="bg-box">
					<p>
						<?php _e( 'RSS Subscription Link:', 'catalyst' ); ?><br />
						<input type="text" id="catalyst-rss-link" name="catalyst[rss_link]" value="<?php echo catalyst_get_core( 'rss_link' ) ?>" style="width:100%;" />
					</p>
					
					<p>
						<?php _e( 'Email Subscription Link:', 'catalyst' ); ?><br />
						<input type="text" id="catalyst-email-feed-link" name="catalyst[email_feed_link]" value="<?php echo catalyst_get_core( 'email_feed_link' ) ?>" style="width:100%;" />
					</p>
					
					<p>
						<?php _e( 'Twitter ID:', 'catalyst' ); ?><br />
						<input type="text" id="catalyst-twitter-id" name="catalyst[twitter_id]" value="<?php echo catalyst_get_core( 'twitter_id' ) ?>" style="width:100%;" />
					</p>
					
					<p>
						<?php _e( 'Navbar Right Twitter Text:', 'catalyst' ); ?><br />
						<input type="text" id="catalyst-twitter-text" name="catalyst[twitter_text]" value="<?php echo catalyst_get_core( 'twitter_text' ) ?>" style="width:100%;" />
					</p>
					
					<p>
						<?php _e( 'Search Button Text:', 'catalyst' ); ?><br />
						<input type="text" id="catalyst-search-button-text" name="catalyst[search_button_text]" value="<?php echo catalyst_get_core( 'search_button_text' ) ?>" style="width:100%;" />
					</p>
					
					<p>
						<?php _e( 'Search Form Text:', 'catalyst' ); ?><br />
						<input type="text" id="catalyst-search-form-text" name="catalyst[search_form_text]" value="<?php echo catalyst_get_core( 'search_form_text' ) ?>" style="width:100%;" />
					</p>
					
					<p>
						<input type="checkbox" id="catalyst-show-search-button" name="catalyst[show_search_button]" value="1" <?php if( checked( 1, catalyst_get_core( 'show_search_button' ) ) ); ?> /> <?php _e( 'Show Search Button', 'catalyst' ); ?>
						<span id="search-button-tooltip" class="tooltip-mark tooltip-top-left">[?]</span>
					</p>
					
					<div class="tooltip tooltip-300">
						<p>
							<img src="<?php echo get_template_directory_uri(); ?>/lib/css/images/tooltips/tooltip-search-button.png"/>
						</p>
					</div>
				</div>
			</div>
		</div>
		
	</div>
</div>