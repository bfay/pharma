<?php
/**
 * Builds the Core Content admin content.
 *
 * @package Catalyst
 */
?>

<div id="catalyst-core-options-nav-content-box" class="catalyst-all-options">

	<h3><?php _e( 'Content Options', 'catalyst' ); ?></h3>

	<div class="catalyst-optionbox-2col-left-wrap">

		<div class="catalyst-optionbox-outer-2col">
			<div class="catalyst-optionbox-inner-2col"> 
				<h4><?php _e( 'Site Layout Options', 'catalyst' ); ?> <span id="content-site-layout-tooltip" class="tooltip-mark tooltip-bottom-right">[?]</span></h4>
				
				<div class="tooltip tooltip-400">
					<p>
						<?php _e( 'The following options allow you to select a Custom Layout for different non-singular page/post types. What this means is that you can create a Custom Layout in', 'catalyst' ); ?>
						<a href="<?php echo admin_url( 'admin.php?page=advanced-options' ); ?>"><?php _e( '<strong>Advanced Options</strong>', 'catalyst' ); ?></a>
						<?php _e( 'and then use that Layout to structure specific page types such as Archives, Search Results pages, etc...', 'catalyst' ); ?>
					</p>
					
					<p>
						<?php _e( 'When any of the following Layouts are given the "Default" layout they will take on the Layout Given to the "Default Site Layout" option.', 'catalyst' ); ?>
					</p>
					
					<p>
						<?php _e( 'To set the Layout type for individual Category or Tag Archives you can go to any individual Category or Tag edit page where you will find this option at the bottom of the page under the "Catalyst Layout Options" title.', 'catalyst' ); ?>
					</p>
					
					<p>
						<?php _e( 'To set the Layout type for individual user Author Archives you can go to their User Profile page where you will find this option at the bottom of the page under the "Catalyst User Settings" title.', 'catalyst' ); ?>
					</p>
					
					<p>
						<?php _e( 'Individual Category, Tag or Author Profile page layouts will trump these universal ones. Only when these individual page layouts are set to "Default" will they take on the Layouts selected here.', 'catalyst' ); ?>
					</p>
					
					<p>
						<?php _e( '<strong>Note:</strong> "General Archive Layout" will effect all Archive pages except Category, Tag and Author Archives which have their own Layout Options.', 'catalyst' ); ?>
					</p>
				</div>
				
				<div class="bg-box">
					<p>
						<?php _e( 'Default Site Layout', 'catalyst' ); ?> <select id="catalyst-site-layout-type" name="catalyst[site_layout_type]" size="1" style="width:230px;"><?php catalyst_list_layout_types( catalyst_get_core( 'site_layout_type' ) ); ?></select>
					</p>
					
					<p>
						<?php _e( 'General Page Layout', 'catalyst' ); ?> <select id="catalyst-page-layout-type" name="catalyst[page_layout_type]" size="1" style="width:220px;"><?php $page_layout = catalyst_get_core( 'page_layout_type' ); catalyst_list_layouts( $page_layout ); ?></select>
					</p>
					
					<p>
						<?php _e( 'General Post Layout', 'catalyst' ); ?> <select id="catalyst-post-layout-type" name="catalyst[post_layout_type]" size="1" style="width:223px;"><?php $post_layout = catalyst_get_core( 'post_layout_type' ); catalyst_list_layouts( $post_layout ); ?></select>
					</p>
					
					<p>
						<?php _e( 'General Archive Layout', 'catalyst' ); ?> <select id="catalyst-archive-layout-type" name="catalyst[archive_layout_type]" size="1" style="width:206px;"><?php $archive_layout = catalyst_get_core( 'archive_layout_type' ); catalyst_list_layouts( $archive_layout ); ?></select>
					</p>
					
					<p>
						<?php _e( 'Category Archive Layout', 'catalyst' ); ?> <select id="catalyst-category-layout-type" name="catalyst[category_layout_type]" size="1" style="width:200px;"><?php $category_layout = catalyst_get_core( 'category_layout_type' ); catalyst_list_layouts( $category_layout ); ?></select>
					</p>
				
					<p>
						<?php _e( 'Tag Archive Layout', 'catalyst' ); ?> <select id="catalyst-tag-layout-type" name="catalyst[tag_layout_type]" size="1" style="width:226px;"><?php $tag_layout = catalyst_get_core( 'tag_layout_type' ); catalyst_list_layouts( $tag_layout ); ?></select>
					</p>
					
					<p>
						<?php _e( 'Author Archive Layout', 'catalyst' ); ?> <select id="catalyst-author-layout-type" name="catalyst[author_layout_type]" size="1" style="width:211px;"><?php $author_layout = catalyst_get_core( 'author_layout_type' ); catalyst_list_layouts( $author_layout ); ?></select>
					</p>
		
					<p>
						<?php _e( 'Search Page Layout', 'catalyst' ); ?> <select id="catalyst-search-layout-type" name="catalyst[search_layout_type]" size="1" style="width:223px;"><?php $search_layout = catalyst_get_core( 'search_layout_type' ); catalyst_list_layouts( $search_layout ); ?></select>
					</p>

					<p<?php if ( !class_exists( 'BuddyPress' ) ) { echo ' style="display:none;"'; } ?>>
						<?php _e( 'BuddyPress Page Layout', 'catalyst' ); ?> <select id="catalyst-buddypress-layout-type" name="catalyst[buddypress_layout_type]" size="1" style="width:198px;"><?php $buddypress_layout = catalyst_get_core( 'buddypress_layout_type' ); catalyst_list_layouts( $buddypress_layout ); ?></select>
					</p>

					<p<?php if ( !class_exists( 'bbPress' ) ) { echo ' style="display:none;"'; } ?>>
						<?php _e( 'BBPress Page Layout', 'catalyst' ); ?> <select id="catalyst-bbpress-layout-type" name="catalyst[bbpress_layout_type]" size="1" style="width:215px;"><?php $bbpress_layout = catalyst_get_core( 'bbpress_layout_type' ); catalyst_list_layouts( $bbpress_layout ); ?></select>
					</p>

					<p<?php if ( !class_exists( 'Woocommerce' ) ) { echo ' style="display:none;"'; } ?>>
						<?php _e( 'WooCommerce Page Layout', 'catalyst' ); ?> <select id="catalyst-woocommerce-layout-type" name="catalyst[woocommerce_layout_type]" size="1" style="width:182px;"><?php $woocommerce_layout = catalyst_get_core( 'woocommerce_layout_type' ); catalyst_list_layouts( $woocommerce_layout ); ?></select>
					</p>
					
					<p>
						<?php _e( '404 Page Layout', 'catalyst' ); ?> <select id="catalyst-404-layout-type" name="catalyst[404_layout_type]" size="1" style="width:240px;"><?php $four_o_four_layout = catalyst_get_core( '404_layout_type' ); catalyst_list_layouts( $four_o_four_layout ); ?></select>
					</p>
				</div>
			</div>
		</div>
		
		<div class="catalyst-optionbox-outer-2col">
			<div class="catalyst-optionbox-inner-2col">
				<h4><?php _e( 'Post Options', 'catalyst' ); ?> <span id="content-post-options-tooltip" class="tooltip-mark tooltip-bottom-right">[?]</span></h4>
				
				<div class="tooltip tooltip-400">
					<h5><?php _e( 'Content Types:', 'catalyst' ); ?></h5>
					<p>
						<?php _e( '<strong>Excerpt:</strong> Will display posts in Excerpt format.', 'catalyst' ); ?>
					</p>
					
					<p>
						<?php _e( '<strong>Full Content:</strong> Will display the Full Content of each post listed.', 'catalyst' ); ?>
					</p>
					
					<p>
						<?php _e( '<strong>Hybrid:</strong> Will first display a specified number of "Featured" Posts in Full Content format and then will display the remaining posts in an Excerpt format. You can also set the Hybrid Excerpt Types to either "Full Width" which will be Excerpts that span the full width of the post area or "Columns" which will be Excerpts in two columns, side-by-side.', 'catalyst' ); ?>
					</p>
				</div>
				
				<div class="bg-box">
					<p>
						<?php _e( 'Default Content Type', 'catalyst' ); ?> <select id="catalyst-default-content-type" name="catalyst[default_content_type]" size="1" style="width:100px;">
							<option value="Excerpt"<?php if (catalyst_get_core( 'default_content_type' ) == 'Excerpt') echo ' selected="selected"'; ?>><?php _e( 'Excerpt', 'catalyst' ); ?></option>
							<option value="Full Content"<?php if (catalyst_get_core( 'default_content_type' ) == 'Full Content') echo ' selected="selected"'; ?>><?php _e( 'Full Content', 'catalyst' ); ?></option>
							<option value="Hybrid"<?php if (catalyst_get_core( 'default_content_type' ) == 'Hybrid') echo ' selected="selected"'; ?>><?php _e( 'Hybrid', 'catalyst' ); ?></option>
						</select>
					</p>
					
					<div style="display:none;" id="catalyst-display-default-hybrid-box">
						<p>
							<strong><?php _e( 'Default Hybrid Content Options:', 'catalyst' ); ?></strong>
							<?php _e( 'Featured Post #', 'catalyst' ); ?> <input type="text" id="catalyst-default-content-featured-post-number" name="catalyst[default_content_featured_post_number]" value="<?php echo catalyst_get_core( 'default_content_featured_post_number' )?>" style="width:30px;" /><br />
							<?php _e( 'Hybrid Excerpt Type:', 'catalyst' ); ?>
							<input type="radio" name="catalyst[default_content_hybrid_excerpt_type]" value="full_width" <?php if (catalyst_get_core( 'default_content_hybrid_excerpt_type' ) == 'full_width') echo 'checked="checked" '; ?>/><label><?php _e( 'Full Width', 'catalyst' ); ?></label>
							<input type="radio" name="catalyst[default_content_hybrid_excerpt_type]" value="columns" <?php if (catalyst_get_core( 'default_content_hybrid_excerpt_type' ) == 'columns') echo 'checked="checked" '; ?>/><label><?php _e( 'Columns', 'catalyst' ); ?></label>
						</p>
					</div>
					
					<p>
						<?php _e( 'Archive Content Type', 'catalyst' ); ?> <select id="catalyst-archive-content-type" name="catalyst[archive_content_type]" size="1" style="width:100px;">
							<option value="Excerpt"<?php if (catalyst_get_core( 'archive_content_type' ) == 'Excerpt') echo ' selected="selected"'; ?>><?php _e( 'Excerpt', 'catalyst' ); ?></option>
							<option value="Full Content"<?php if (catalyst_get_core( 'archive_content_type' ) == 'Full Content') echo ' selected="selected"'; ?>><?php _e( 'Full Content', 'catalyst' ); ?></option>
							<option value="Hybrid"<?php if (catalyst_get_core( 'archive_content_type' ) == 'Hybrid') echo ' selected="selected"'; ?>><?php _e( 'Hybrid', 'catalyst' ); ?></option>
						</select>
					</p>
					
					<div style="display:none;" id="catalyst-display-archive-hybrid-box">
						<p>
							<strong><?php _e( 'Archive Hybrid Content Options:', 'catalyst' ); ?></strong>
							<?php _e( 'Featured Post #', 'catalyst' ); ?> <input type="text" id="catalyst-archive-content-featured-post-number" name="catalyst[archive_content_featured_post_number]" value="<?php echo catalyst_get_core( 'archive_content_featured_post_number' )?>" style="width:30px;" /><br />
							<?php _e( 'Hybrid Excerpt Type:', 'catalyst' ); ?>
							<input type="radio" name="catalyst[archive_content_hybrid_excerpt_type]" value="full_width" <?php if (catalyst_get_core( 'archive_content_hybrid_excerpt_type' ) == 'full_width') echo 'checked="checked" '; ?>/><label><?php _e( 'Full Width', 'catalyst' ); ?></label>
							<input type="radio" name="catalyst[archive_content_hybrid_excerpt_type]" value="columns" <?php if (catalyst_get_core( 'archive_content_hybrid_excerpt_type' ) == 'columns') echo 'checked="checked" '; ?>/><label><?php _e( 'Columns', 'catalyst' ); ?></label>
						</p>
					</div>
					
					<p>
						<?php _e( 'Read More Text', 'catalyst' ); ?>
						<input type="text" id="catalyst-read-more-text" name="catalyst[read_more_text]" value="<?php echo catalyst_get_core( 'read_more_text' ) ?>" style="width:209px;" />
					</p>
					
					<p>
						<?php _e( 'Post Navigation Type', 'catalyst' ); ?> <select id="catalyst-post-nav-type" name="catalyst[post_nav_type]" size="1" style="width:110px;">
							<option value="prev-next"<?php if (catalyst_get_core( 'post_nav_type' ) == 'prev-next') echo ' selected="selected"'; ?>><?php _e( 'Previous/Next', 'catalyst' ); ?></option>
							<option value="numbered"<?php if (catalyst_get_core( 'post_nav_type' ) == 'numbered') echo ' selected="selected"'; ?>><?php _e( 'Numbered', 'catalyst' ); ?></option>
							<option value="older-newer"<?php if (catalyst_get_core( 'post_nav_type' ) == 'older-newer') echo ' selected="selected"'; ?>><?php _e( 'Older/Newer', 'catalyst' ); ?></option>
						</select> <span id="post-nav-tooltip" class="tooltip-mark tooltip-center-right">[?]</span>
					</p>
					
					<div class="tooltip tooltip-500">
						<p>
							<img src="<?php echo get_template_directory_uri(); ?>/lib/css/images/tooltips/tooltip-post-nav.png"/>
						</p>
					</div>
					
				</div>
				
				<div class="bg-box">	
					<p>
						<input type="checkbox" id="catalyst-remove-all-page-titles" name="catalyst[remove_all_page_titles]" value="1" <?php if( checked( 1, catalyst_get_core( 'remove_all_page_titles' ) ) ); ?> /> <?php _e( 'Remove All Page Titles', 'catalyst' ); ?>
						<span id="remove-all-page-titles-tooltip" class="tooltip-mark tooltip-top-right">[?]</span>
					</p>
					
					<div class="tooltip tooltip-500">
						<h5><?php _e( 'Why Remove Page Titles:', 'catalyst' ); ?></h5>
						<p>
							<?php _e( 'Sometimes you just don\'t want certain Page Titles to display. Maybe you want to add your own H1 wrapped Title or maybe your Page content just doesn\'t need or work well with a Title. Either way, these options provide a quick and easy solution to this need. And note that this does not just Hide your Page Titles from view as the Dynamik Options > Hide option would do, but instead this physically removes your Page Titles from the source code.', 'catalyst' ); ?>
						</p>
						
						<h5><?php _e( 'How To Remove Page Titles:', 'catalyst' ); ?></h5>
						<p>
							<?php _e( 'You have two choices here. Remove ALL Page Titles or just ones specified by their Page ID\'s. Note that you can reference your current Page ID\'s by clicking on the [IDs] link below. Also, be sure to comma separate your ID\'s (with no spaces), but leave off the trailing comma. So if you wanted to remove a Page Title from a Page with an ID of 27 and one with an ID of 113 and one with an ID of 279 you would add this below: <strong>27,113,279</strong>', 'catalyst' ); ?>
						</p>
					</div>
					
					<p style="display:none;" id="catalyst-remove-all-page-titles-box">
						<?php _e( 'Remove Specific Page Titles By IDs: (ie. 2,17 etc.)', 'catalyst' ); ?><br />
						<input type="text" id="catalyst-remove-page-titles-ids" name="catalyst[remove_page_titles_ids]" value="<?php echo catalyst_get_core( 'remove_page_titles_ids' )?>" style="width:310px;" />
						<span id="content-page-ids" class="tooltip-mark tooltip-center-right">[IDs]</span>
					</p>
					
					<div class="tooltip tooltip-400">
						<h5><?php _e( 'Page ID Reference:', 'catalyst' ); ?></h5>
						<p class="page-cat-id-scrollbox-378">
							<?php $pages = get_pages('orderby=ID&hide_empty=0');
							echo '<strong>Page IDs/Names</strong><br />'; 
								foreach($pages as $page) { 
									echo $page->ID . ' = ' . $page->post_name . '<br />'; 
								} ?>
						</p>
					</div>
				</div>
				
				<div class="bg-box">
					<p>
						<?php _e( 'Include Catalyst In-Post Options With Specific Custom Post Types', 'catalyst' ); ?> <span id="include-inpost-all-cpts-tooltip" class="tooltip-mark tooltip-center-right">[?]</span>
					</p>
					
					<div class="tooltip tooltip-400">
						<h5><?php _e( 'How To Include Catalyst In-Post Options With Your Custom Post Types:', 'catalyst' ); ?></h5>
						<p>
							<?php _e( 'With the option below you can include Catalyst In-Post Options with certain Custom Post Types by including their Custom Post Type Names. Note that you can reference your current Custom Post Type Names by clicking on the [Names] link below.', 'catalyst' ); ?>
						</p>
						
						<p>
							<?php _e( 'Also, be sure to comma separate your Names (with no spaces), but leave off the trailing comma. So if you wanted to Include Catalyst In-Post Options with a Custom Post Type with a Name of product and one with a Name of recipes and one with a Name of songs you would add this below: <strong>products,recipes,songs</strong>', 'catalyst' ); ?>
						</p>
						
						<p>
							<?php _e( '<strong>Note:</strong> Some Plugins use Custom Post Types for their options and functionality so you may see names in the [Names] reference box that are not your own. In these cases just ignore those names and use the ones you know are yours.', 'catalyst' ); ?>
						</p>
						
						<span class="tooltip-credit">
							<?php _e( 'Learn more about Custom Post Types here:', 'catalyst' ); ?>
							<a href="http://codex.wordpress.org/Post_Types#Custom_Types" target="_blank">http://codex.wordpress.org/Post_Types#Custom_Types</a>
						</span>
					</div>
					
					<p>
						<?php _e( 'Add Custom Post Type Names Below: (ie. products,recipes etc.)', 'catalyst' ); ?><br />
						<input type="text" id="catalyst-include-inpost-cpt-names" name="catalyst[include_inpost_cpt_names]" value="<?php echo catalyst_get_core( 'include_inpost_cpt_names' )?>" style="width:288px;" />
						<span id="custom-post-type-names" class="tooltip-mark tooltip-center-right">[Names]</span>
					</p>
					
					<div class="tooltip tooltip-400">
						<h5><?php _e( 'Custom Post Type Name Reference', 'catalyst' ); ?></h5>
						<p class="page-cat-id-scrollbox-378">
						<?php
						$args=array(
							'public'   => true,
							'_builtin' => false
						);
						$output = 'names';
						$operator = 'and';
						$post_types = get_post_types( $args, $output, $operator ); 
						echo '<strong>Custom Post Type Names:</strong><br />'; 
						foreach( $post_types as $post_type )
						{
							echo '- ' . $post_type . '<br />';
						} ?>
						</p>
					</div>
				</div>
			</div>
		</div>
		
		<div class="catalyst-optionbox-outer-2col">
			<div class="catalyst-optionbox-inner-2col">
				<h4><?php _e( 'Blog Page Template Options', 'catalyst' ); ?></h4>
				
				<div class="bg-box">
					<p>
						<?php _e( 'Display ', 'catalyst' ); ?><?php wp_dropdown_categories(array('selected' => catalyst_get_core( 'blog_cat_display' ), 'name' => 'catalyst[blog_cat_display]', 'orderby' => 'Name' , 'hierarchical' => 1, 'show_option_all' => __("All Categories", 'catalyst'), 'hide_empty' => '0' )); ?>
					</p>
					
					<p>
						<?php _e( 'Exclude Category IDs: (ie. 2,17 etc.)', 'catalyst' ); ?><br />
						<input type="text" id="catalyst-blog-exclude-cats" name="catalyst[blog_exclude_cats]" value="<?php echo catalyst_get_core( 'blog_exclude_cats' )?>" style="width:310px;" />
						<span id="content-cat-ids" class="tooltip-mark tooltip-center-right">[IDs]</span>
					</p>
					
					<div class="tooltip tooltip-400">
						<h5><?php _e( 'Category ID Reference:', 'catalyst' ); ?></h5>
						
						<p class="page-cat-id-scrollbox-378">
							<?php $cats = get_categories('orderby=ID&hide_empty=0');
							echo '<strong>Category IDs/Names</strong><br />'; 
								foreach($cats as $category) { 
									echo $category->cat_ID . ' = ' . $category->cat_name . '<br />'; 
								} ?>
						</p>
					</div>
					
					<p>
						<?php _e( 'Number of Blog Posts To Display', 'catalyst' ); ?> <input type="text" id="catalyst-blog-post-number" name="catalyst[blog_post_number]" value="<?php echo catalyst_get_core( 'blog_post_number' )?>" style="width:35px;" />
					</p>
				</div>
			</div>
		</div>
		
		<div class="catalyst-optionbox-outer-2col">
			<div class="catalyst-optionbox-inner-2col">
				<h4><?php _e( '404 Page Content Options', 'catalyst' ); ?></h4>
				<div class="bg-box">
					<p>
						<input type="checkbox" id="catalyst-fourofour-page-content-sitemap" name="catalyst[fourofour_page_content_sitemap]" value="1" <?php if( checked( 1, catalyst_get_core( 'fourofour_page_content_sitemap' ) ) ); ?> /> <?php _e( 'Include Sitemap in 404 Page Content.', 'catalyst' ); ?>
					</p>
				</div>
			</div>
		</div>
		
	</div>
	<div class="catalyst-optionbox-2col-right-wrap">
	
		<div class="catalyst-optionbox-outer-2col">
			<div class="catalyst-optionbox-inner-2col">
				<h4><?php _e( 'Breadcrumbs Display Options', 'catalyst' ); ?></h4>
				
				<div class="bg-box">
					<p>
						<input type="checkbox" id="catalyst-breadcrumbs-front-page" name="catalyst[breadcrumbs_front_page]" value="1" <?php if( checked( 1, catalyst_get_core( 'breadcrumbs_front_page' ) ) ); ?> /> <?php _e( 'Breadcrumbs On Front Page', 'catalyst' ); ?><br />
						<input type="checkbox" id="catalyst-breadcrumbs-posts" name="catalyst[breadcrumbs_posts]" value="1" <?php if( checked( 1, catalyst_get_core( 'breadcrumbs_posts' ) ) ); ?> /> <?php _e( 'Breadcrumbs On Posts', 'catalyst' ); ?><br />
						<input type="checkbox" id="catalyst-breadcrumbs-pages" name="catalyst[breadcrumbs_pages]" value="1" <?php if( checked( 1, catalyst_get_core( 'breadcrumbs_pages' ) ) ); ?> /> <?php _e( 'Breadcrumbs On Pages', 'catalyst' ); ?><br />
						<input type="checkbox" id="catalyst-breadcrumbs-archives" name="catalyst[breadcrumbs_archives]" value="1" <?php if( checked( 1, catalyst_get_core( 'breadcrumbs_archives' ) ) ); ?> /> <?php _e( 'Breadcrumbs On Archives', 'catalyst' ); ?><br />
						<input type="checkbox" id="catalyst-breadcrumbs-blog" name="catalyst[breadcrumbs_blog]" value="1" <?php if( checked( 1, catalyst_get_core( 'breadcrumbs_blog' ) ) ); ?> /> <?php _e( 'Breadcrumbs On Blog Template', 'catalyst' ); ?><br />
						<input type="checkbox" id="catalyst-breadcrumbs-blank-content" name="catalyst[breadcrumbs_blank_content]" value="1" <?php if( checked( 1, catalyst_get_core( 'breadcrumbs_blank_content' ) ) ); ?> /> <?php _e( 'Breadcrumbs On Blank Content Template', 'catalyst' ); ?><br />
						<input type="checkbox" id="catalyst-breadcrumbs-404" name="catalyst[breadcrumbs_404]" value="1" <?php if( checked( 1, catalyst_get_core( 'breadcrumbs_404' ) ) ); ?> /> <?php _e( 'Breadcrumbs On 404 Page', 'catalyst' ); ?><br />
					</p>
					
					<p>
						<?php _e( 'Main Breadcrumbs Text', 'catalyst' ); ?> <input type="text" id="catalyst-breadcrumbs-text-main" name="catalyst[breadcrumbs_text_main]" value="<?php echo catalyst_get_core( 'breadcrumbs_text_main' ) ?>" style="width:199px;" />
					</p>
					
					<p>
						<?php _e( 'Home Breadcrumbs Text', 'catalyst' ); ?> <input type="text" id="catalyst-breadcrumbs-text-home" name="catalyst[breadcrumbs_text_home]" value="<?php echo catalyst_get_core( 'breadcrumbs_text_home' ) ?>" style="width:194px;" />
					</p>
					
					<p>
						<?php _e( 'Archive Breadcrumbs Text', 'catalyst' ); ?> <input type="text" id="catalyst-breadcrumbs-text-archives" name="catalyst[breadcrumbs_text_archives]" value="<?php echo catalyst_get_core( 'breadcrumbs_text_archives' ) ?>" style="width:183px;" />
					</p>
					
					<p>
						<?php _e( 'Search Breadcrumbs Text', 'catalyst' ); ?> <input type="text" id="catalyst-breadcrumbs-text-search" name="catalyst[breadcrumbs_text_search]" value="<?php echo catalyst_get_core( 'breadcrumbs_text_search' ) ?>" style="width:186px;" />
					</p>

					<p>
						<?php _e( '404 Breadcrumbs Text', 'catalyst' ); ?> <input type="text" id="catalyst-breadcrumbs-text-404" name="catalyst[breadcrumbs_text_404]" value="<?php echo catalyst_get_core( 'breadcrumbs_text_404' ) ?>" style="width:186px;" />
					</p>
					
					<p>
						<?php _e( 'Breadcrumbs Word Separator', 'catalyst' ); ?> <input type="text" id="catalyst-breadcrumbs-text-sep" name="catalyst[breadcrumbs_text_sep]" value="<?php echo catalyst_get_core( 'breadcrumbs_text_sep' ) ?>" style="width:168px;" />
					</p>
				</div>
			</div>
		</div>
		
		<div class="catalyst-optionbox-outer-2col">
			<div class="catalyst-optionbox-inner-2col">
				<h4><?php _e( 'Content Meta Options', 'catalyst' ); ?></h4>
				<div class="bg-box">
					<p>
						<b><?php _e( 'Post Byline Meta Display Options', 'catalyst' ); ?></b> <span id="post-byline-meta-tooltip" class="tooltip-mark tooltip-center-left">[?]</span>
					</p>
					
					<div class="tooltip tooltip-300">
						<p>
							<img src="<?php echo get_template_directory_uri(); ?>/lib/css/images/tooltips/tooltip-post-byline-meta.png"/>
						</p>
					</div>
					
					<p>
						<input type="checkbox" id="catalyst-byline-author" name="catalyst[byline_author]" value="1" <?php if( checked( 1, catalyst_get_core( 'byline_author' ) ) ); ?> /> <?php _e( 'Author', 'catalyst' ); ?>
						<input type="checkbox" style="margin-left:25px;" id="catalyst-byline-date" name="catalyst[byline_date]" value="1" <?php if( checked( 1, catalyst_get_core( 'byline_date' ) ) ); ?> /> <?php _e( 'Date', 'catalyst' ); ?>
						<input type="checkbox" style="margin-left:25px;" id="catalyst-byline-comments" name="catalyst[byline_comments]" value="1" <?php if( checked( 1, catalyst_get_core( 'byline_comments' ) ) ); ?> /> <?php _e( 'Comments', 'catalyst' ); ?>
						<input type="checkbox" style="margin-left:25px;" id="catalyst-byline-edit-link" name="catalyst[byline_edit_link]" value="1" <?php if( checked( 1, catalyst_get_core( 'byline_edit_link' ) ) ); ?> /> <?php _e( 'Edit Link', 'catalyst' ); ?>
					</p>
					
					<p>
						<?php _e( 'Text Before Author', 'catalyst' ); ?> <input type="text" id="catalyst-byline-author-text" name="catalyst[byline_author_text]" value="<?php echo catalyst_get_core( 'byline_author_text' ) ?>" style="width:220px;" />
					</p>
					
					<p>
						<?php _e( 'Text Before Date', 'catalyst' ); ?> <input type="text" id="catalyst-byline-date-text" name="catalyst[byline_date_text]" value="<?php echo catalyst_get_core( 'byline_date_text' ) ?>" style="width:231px;" />
					</p>
					
					<p>
						<?php _e( 'Separator Before Comments', 'catalyst' ); ?> <input type="text" id="catalyst-byline-comment-sep-text" name="catalyst[byline_comment_sep_text]" value="<?php echo catalyst_get_core( 'byline_comment_sep_text' ) ?>" style="width:176px;" />
					</p>

					<p>
						<?php _e( 'Zero Comment Text', 'catalyst' ); ?> <input type="text" id="catalyst-byline-zero-comment-text" name="catalyst[byline_zero_comment_text]" value="<?php echo catalyst_get_core( 'byline_zero_comment_text' ) ?>" style="width:219px;" />
					</p>
				</div>
				
				<div class="bg-box">
					<p>
						<b><?php _e( 'Post Bottom Meta Display Options', 'catalyst' ); ?></b> <span id="post-bottom-meta-tooltip" class="tooltip-mark tooltip-top-left">[?]</span>
					</p>
					
					<div class="tooltip tooltip-500">
						<p>
							<img src="<?php echo get_template_directory_uri(); ?>/lib/css/images/tooltips/tooltip-post-bottom-meta.png"/>
						</p>
					</div>
					
					<p>
						<input type="checkbox" id="catalyst-cat-meta-display" name="catalyst[cat_meta_display]" value="1" <?php if( checked( 1, catalyst_get_core( 'cat_meta_display' ) ) ); ?> /> <?php _e( 'Categories', 'catalyst' ); ?>
						<input type="checkbox" style="margin-left:30px;" id="catalyst-tag-meta-display" name="catalyst[tag_meta_display]" value="1" <?php if( checked( 1, catalyst_get_core( 'tag_meta_display' ) ) ); ?> /> <?php _e( 'Tags', 'catalyst' ); ?>
						<input type="checkbox" style="margin-left:30px;" id="catalyst-author-info-display" name="catalyst[author_info_display]" value="1" <?php if( checked( 1, catalyst_get_core( 'author_info_display' ) ) ); ?> /> <?php _e( 'Author Info', 'catalyst' ); ?>
					</p>
					
					<p>
						<?php _e( 'Text Before Categories', 'catalyst' ); ?> <input type="text" id="catalyst-cat-meta-text" name="catalyst[cat_meta_text]" value="<?php echo catalyst_get_core( 'cat_meta_text' ) ?>" style="width:199px;" />
					</p>
					
					<p>
						<?php _e( 'Text Before Tags', 'catalyst' ); ?> <input type="text" id="catalyst-tag-meta-text" name="catalyst[tag_meta_text]" value="<?php echo catalyst_get_core( 'tag_meta_text' ) ?>" style="width:227px;" />
					</p>
					
					<p>
						<?php _e( 'Separator Before Tags', 'catalyst' ); ?> <input type="text" id="catalyst-tag-meta-sep" name="catalyst[tag_meta_sep]" value="<?php echo catalyst_get_core( 'tag_meta_sep' ) ?>" style="width:200px;" />
					</p>
					
					<p>
						<?php _e( 'Categories & Tags Separator', 'catalyst' ); ?> <input type="text" id="catalyst-cat-tag-meta-sep" name="catalyst[cat_tag_meta_sep]" value="<?php echo catalyst_get_core( 'cat_tag_meta_sep' ) ?>" style="width:171px;" />
					</p>
				</div>
				
				<div class="bg-box">		
					<p>
						<?php _e( 'Post Author Box Link Text', 'catalyst' ); ?> <input type="text" id="catalyst-post-author-box-link-text" name="catalyst[post_author_box_link_text]" value="<?php echo catalyst_get_core( 'post_author_box_link_text' ) ?>" style="width:185px;" />
					</p>
				</div>
				
				<div class="bg-box">
					<p>
						<b><?php _e( 'Page Bottom Meta Display Options: ', 'catalyst' ); ?></b>
						<input type="checkbox" id="catalyst-page-edit-link" name="catalyst[page_edit_link]" value="1" <?php if( checked( 1, catalyst_get_core( 'page_edit_link' ) ) ); ?> /> <?php _e( 'Edit Link', 'catalyst' ); ?>
					</p>
				</div>
			</div>
		</div>
		<?php $dynamik_display_none = ' style="display:none;"'; if( defined( 'DYNAMIK_ACTIVE' ) ) { $dynamik_display_none = ''; } ?>
		<div class="catalyst-optionbox-outer-2col"<?php echo $dynamik_display_none; ?>>
			<div class="catalyst-optionbox-inner-2col">
				<h4><?php _e( 'Dynamik Child Theme Responsive Design Options', 'catalyst' ); ?></h4>
				<div class="bg-box">
					<p>
						<input type="checkbox" id="catalyst-dynamik-responsive-design" name="catalyst[dynamik_responsive]" value="1" <?php if( checked( 1, catalyst_get_core( 'dynamik_responsive' ) ) ); ?> /> <?php _e( 'Activate Responsive Design Options In Dynamik.', 'catalyst' ); ?>
						<span id="dynamik-responsive-tooltip" class="tooltip-mark tooltip-top-left">[?]</span>
					</p>
					
					<div class="tooltip tooltip-400">
						<p>
							<?php _e( 'By enabling this option you will be switching the Dynamik Child Theme from it\'s default fixed width styling to a responsive styling that will respond to the width of the browser window (your site width won\'t increase beyond it\'s set max width, but it will shrink as needed).', 'catalyst' ); ?>
						</p>
						
						<p>
							<?php _e( 'Responsive Design is a great way to make your website more mobile friendly, adjusting to the size of your different smart phone and tablet browser sizes while still looking great in a regular desktop browser.', 'catalyst' ); ?>
						</p>
						
						<p>
							<?php _e( 'Also note that when you enable this option a Viewport Meta Tag will be added to your site\'s <code>&lt;head&gt;</code> to help ensure your responsive styling takes effect in mobile browsers. You can learn more about this by reading the [?]Tooltip for the "Mobile Viewport Meta Tag" option found in', 'catalyst' ); ?>
							<a href="<?php echo admin_url( 'admin.php?page=dynamik-options&activetab=catalyst-dynamik-options-nav-responsive' ); ?>"><?php _e( 'Dynamik Options > Responsive', 'catalyst' ); ?></a>
						</p>
							
						<span class="tooltip-credit">
							<?php _e( 'Learn more about Responsive Design here:', 'catalyst' ); ?>
							<a href="http://thinkvitamin.com/design/beginners-guide-to-responsive-web-design/" target="_blank">Beginner's Guide to Responsive Web Design</a>
						</span>
					</div>
				</div>
			</div>
		</div>
		
	</div>
</div>