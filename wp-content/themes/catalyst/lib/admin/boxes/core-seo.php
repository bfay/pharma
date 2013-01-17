<?php
/**
 * Builds the Core SEO admin content.
 *
 * @package Catalyst
 */
?>

<div id="catalyst-core-options-nav-seo-box" class="catalyst-all-options">

	<h3><?php _e( 'SEO Options', 'catalyst' ); ?> <?php echo !$catalyst_seo_active ? '<span id="seo-disable-if-plugin-tooltip" class="tooltip-mark tooltip-bottom-center">[Active SEO Plugin or Manual Override]</span>' : ''; ?></h3>
	
	<div class="tooltip tooltip-300">
		<p>
			<?php _e( '<b>Note:</b> It appears you have an SEO Plugin active or you have manually disabled the Catalyst SEO Options with the "Kill Switch" below. As a result the SEO options below (as well as Catalyst In-Post/In-Page, Author, Category, Tag and Custom Taxonomy SEO options) will be automatically disabled.', 'catalyst' ); ?>
		</p>
	</div>

	<div class="catalyst-optionbox-2col-left-wrap">

		<div class="catalyst-optionbox-outer-2col">
			<div class="catalyst-optionbox-inner-2col">
				<h4><?php _e( 'Title Tag SEO Options', 'catalyst' ); ?> <span id="seo-title-tag-tooltip" class="tooltip-mark tooltip-bottom-right">[?]</span></h4>
				
				<div class="tooltip tooltip-500">
					<h5><?php _e( 'Home Title Tags:', 'catalyst' ); ?></h5>
					
					<p>
						<?php _e( 'In your WordPress Dashboard if you go to', 'catalyst' ); ?>
						<a href="<?php echo admin_url( 'options-general.php' ); ?>"><?php _e( '<b>(Settings > General)</b>', 'catalyst' ); ?></a>
						<?php _e( 'you will find an option called "Site Title". This is your Site Name and will become your Homepage Site Title. Just under the Site Title you will see the "Tagline" option. This will become the Site Description for your Homepage.', 'catalyst' ); ?>
					</p>
					
					<h5><?php _e( 'Page/Post Title Tags:', 'catalyst' ); ?></h5>
					
					<p>
						<?php _e( 'You can control the Title Tag attribute for Pages and Posts by adding content to the "Catalyst Page Title" or "Catalyst Post Title" options when editing a page or post.', 'catalyst' ); ?>
					</p>
				
					<h5><?php _e( 'About Title Tags:', 'catalyst' ); ?></h5>
					
					<span class="tooltip-quote">
						<p>
							<?php _e( '"From an SEO perspective, the title of the webpage is very important. These are the words that describe what your page is about and are the first words that a search engine sees when it crawls your webpage looking for content to add to its index.', 'catalyst' ); ?>
						</p>
					
						<p>
							<?php _e( 'The page title is also what the searcher sees in a search result - so the page title is very important in describing what the page is about and if the title meets the searcher\'s criteria, then it is more likely to be clicked on and your page opened."', 'catalyst' ); ?>
						</p>
					</span>
					
					<span class="tooltip-credit">
						<?php _e( 'Read more of this article here:', 'catalyst' ); ?>
						<a href="http://www.sitepronews.com/2010/08/25/meta-title-tags-are-gold/" target="_blank">Meta Title Tags Are Gold</a>
					</span>
				</div>
					
				<div class="bg-box">	
					<p>
						<input type="checkbox" id="catalyst-append-description-title" name="catalyst[append_description_title]" value="1" <?php if( checked( 1, catalyst_get_core( 'append_description_title' ) ) ); ?> /> <?php _e( 'Append Site Description To Title Tag On Homepage', 'catalyst' ); ?><br />
						<input type="checkbox" id="catalyst-append-site-name" name="catalyst[append_site_name]" value="1" <?php if( checked( 1, catalyst_get_core( 'append_site_name' ) ) ); ?> /> <?php _e( 'Append Site Name To Title Tag On Inner Pages', 'catalyst' ); ?>
					</p>
					
					<p>
						<?php _e( 'Title Tag Append Location', 'catalyst' ); ?> <select id="catalyst-title-append-location" name="catalyst[title_append_location]" size="1" style="width:60px; margin-right:5px;">
							<option value="Right"<?php if (catalyst_get_core( 'title_append_location' ) == 'Right') echo ' selected="selected"'; ?>><?php _e( 'Right', 'catalyst' ); ?></option>
							<option value="Left"<?php if (catalyst_get_core( 'title_append_location' ) == 'Left') echo ' selected="selected"'; ?>><?php _e( 'Left', 'catalyst' ); ?></option>
						</select>
					</p>
					
					<p>
						<?php _e( 'Title Tag Separator', 'catalyst' ); ?> <input type="text" id="catalyst-title-tag-separator" name="catalyst[title_tag_separator]" value="<?php echo catalyst_get_core( 'title_tag_separator' ) ?>" style="width:102px;" />
					</p>
				</div>
				
				<div class="bg-box">
					<p style="margin-bottom:0;">
						<b><?php _e( 'Placement of <code>&lt;h1&gt;</code> Tags On Homepage', 'catalyst' ); ?></b> <span id="seo-h1-placement-tooltip" class="tooltip-mark tooltip-center-right">[?]</span>
					</p>
					
					<div class="tooltip tooltip-400">
						<h5><?php _e( 'Where To Place Your H1\'s On Your Homepage?', 'catalyst' ); ?></h5>
						
						<p>
							<?php _e( 'With this option you get the choice of wrapping an H1 around your Homepage Title, Tagline or nothing. The latter option gives you the freedom to place the H1 tag in the exact place of your choosing.', 'catalyst' ); ?>
						</p>
						
						<p>
							<?php _e( 'Adding the H1 yourself can be done many different ways. You can accomplish this by adding open and close H1 tags into your site using tools like the WordPress Page/Post editor, a Text Widget, Custom Hook Box, etc...', 'catalyst' ); ?>
						</p>
					</div>
					
					<p>
						<input type="radio" name="catalyst[h1_tag_placement]" value="h1_wrap_title" <?php if( catalyst_get_core( 'h1_tag_placement' ) == 'h1_wrap_title' ) echo 'checked="checked" '; ?>/> <label><?php _e( 'Wrap Title With H1\'s', 'catalyst' ); ?></label><br />
						<input type="radio" name="catalyst[h1_tag_placement]" value="h1_wrap_tagline" <?php if( catalyst_get_core( 'h1_tag_placement' ) == 'h1_wrap_tagline' ) echo 'checked="checked" '; ?>/> <label><?php _e( 'Wrap Tagline With H1\'s', 'catalyst' ); ?></label><br />
						<input type="radio" name="catalyst[h1_tag_placement]" value="h1_wrap_neither" <?php if( catalyst_get_core( 'h1_tag_placement' ) == 'h1_wrap_neither' ) echo 'checked="checked" '; ?>/> <label><?php _e( 'Neither: Let Me Do It Myself', 'catalyst' ); ?></label>
					</p>
				</div>
			</div>
		</div>
		
		<div class="catalyst-optionbox-outer-2col">
			<div class="catalyst-optionbox-inner-2col">
				<h4><?php _e( 'Robots Meta SEO Options', 'catalyst' ); ?> <span id="seo-robots-tooltip" class="tooltip-mark tooltip-center-right">[?]</span></h4>
				
				<div class="tooltip tooltip-400">
					<h5><?php _e( 'Give Search Engines Direction:', 'catalyst' ); ?></h5>
					
					<p>
						<?php _e( 'When a Search Engine crawls your site it can be directed as to where it should and should not go, what pages it should and should not index as well as archive for search results (among other things). Use the below options to help guide Search Engines as they view your site.', 'catalyst' ); ?>
					</p>
					
					<span class="tooltip-credit">
						<?php _e( 'Read more about Robots Meta Tags here:', 'catalyst' ); ?>
						<a href="http://www.seoconsultants.com/meta-tags/robots/" target="_blank">http://www.seoconsultants.com/meta-tags/robots/</a>
					</span>
				</div>

				<div class="bg-box">
					<p style="margin-bottom:0;">
						<b><?php _e( 'Noindex...', 'catalyst' ); ?></b>
					</p>
					
					<p>
						<input type="checkbox" id="catalyst-noindex-archives" name="catalyst[noindex_archives]" value="1" <?php if( checked( 1, catalyst_get_core( 'noindex_archives' ) ) ); ?> /> <?php _e( 'Noindex Archive Pages', 'catalyst' ); ?><br />
						<input type="checkbox" id="catalyst-noindex-cats" name="catalyst[noindex_cats]" value="1" <?php if( checked( 1, catalyst_get_core( 'noindex_cats' ) ) ); ?> /> <?php _e( 'Noindex Category Pages', 'catalyst' ); ?><br />
						<input type="checkbox" id="catalyst-noindex-tags" name="catalyst[noindex_tags]" value="1" <?php if( checked( 1, catalyst_get_core( 'noindex_tags' ) ) ); ?> /> <?php _e( 'Noindex Tag Pages', 'catalyst' ); ?><br />
						<input type="checkbox" id="catalyst-noindex-authors" name="catalyst[noindex_authors]" value="1" <?php if( checked( 1, catalyst_get_core( 'noindex_authors' ) ) ); ?> /> <?php _e( 'Noindex Author Pages', 'catalyst' ); ?>
					</p>
				</div>
				
				<div class="bg-box">
					<p style="margin-bottom:0;">
						<b><?php _e( 'Nofollow...', 'catalyst' ); ?></b>
					</p>
					<p>
						<input type="checkbox" id="catalyst-nofollow-comment-author" name="catalyst[nofollow_comment_author]" value="1" <?php if( checked( 1, catalyst_get_core( 'nofollow_comment_author' ) ) ); ?> /> <?php _e( 'Nofollow Comment Author Links', 'catalyst' ); ?>
					</p>
				</div>
				
				<div class="bg-box">
					<p style="margin-bottom:0;">
						<b><?php _e( 'Noarchive...', 'catalyst' ); ?></b>
					</p>
					
					<p>
						<input type="checkbox" id="catalyst-noarchive-site" name="catalyst[noarchive_site]" value="1" <?php if( checked( 1, catalyst_get_core( 'noarchive_site' ) ) ); ?> /> <?php _e( 'Noarchive Entire Site', 'catalyst' ); ?>
					</p>
					
					<p>
						<input type="checkbox" id="catalyst-noarchive-archives" name="catalyst[noarchive_archives]" value="1" <?php if( checked( 1, catalyst_get_core( 'noarchive_archives' ) ) ); ?> /> <?php _e( 'Noarchive Archive Pages', 'catalyst' ); ?><br />
						<input type="checkbox" id="catalyst-noarchive-cats" name="catalyst[noarchive_cats]" value="1" <?php if( checked( 1, catalyst_get_core( 'noarchive_cats' ) ) ); ?> /> <?php _e( 'Noarchive Category Pages', 'catalyst' ); ?><br />
						<input type="checkbox" id="catalyst-noarchive-tags" name="catalyst[noarchive_tags]" value="1" <?php if( checked( 1, catalyst_get_core( 'noarchive_tags' ) ) ); ?> /> <?php _e( 'Noarchive Tag Pages', 'catalyst' ); ?><br />
						<input type="checkbox" id="catalyst-noarchive-authors" name="catalyst[noarchive_authors]" value="1" <?php if( checked( 1, catalyst_get_core( 'noarchive_authors' ) ) ); ?> /> <?php _e( 'Noarchive Author Pages', 'catalyst' ); ?>
					</p>
				</div>
			</div>
		</div>
		
	</div>
	<div class="catalyst-optionbox-2col-right-wrap">

		<div class="catalyst-optionbox-outer-2col">
			<div class="catalyst-optionbox-inner-2col">
				<h4><?php _e( 'Homepage SEO Options', 'catalyst' ); ?> <span id="seo-basics-tooltip" class="tooltip-mark tooltip-center-left">[?]</span></h4>
				
				<div class="tooltip tooltip-500">
					<h5><?php _e( 'Search Engine Optimization Basics:', 'catalyst' ); ?></h5>
					
					<p>
						<?php _e( 'Search Engine Optmization is an important part of web design and with a few basic concepts you can create websites that are attractive to Search Engines and easy for your potential visitors to locate.', 'catalyst' ); ?>
					</p>
					
					<span class="tooltip-credit">
						<?php _e( 'Learn more:', 'catalyst' ); ?>
						<a href="http://guides.seomoz.org/chapter-4-basics-of-search-engine-friendly-design-and-development" target="_blank">The Basics of Search Engine Friendly Design & Development</a>
					</span>
				</div>
				
				<div class="bg-box">
					<p>
						<?php _e( 'Homepage Title (Leave Blank To Defer To Site Title)', 'catalyst' ); ?><br />
						<input type="text" id="catalyst-home-title" name="catalyst[home_title]" value="<?php echo catalyst_get_core( 'home_title' )?>" style="width:100%;" />
					</p>
				</div>
				
				<div class="bg-box">
					<p>
						<?php _e( 'Homepage Meta Description', 'catalyst' ); ?><br />
						<textarea id="catalyst-home-description" name="catalyst[home_description]" style="width:100%; height:133px;"><?php if( catalyst_get_core( 'home_description' ) ) echo catalyst_get_core( 'home_description' ); ?></textarea>
					</p>
				</div>
					
				<div class="bg-box">
					<p>
						<?php _e( 'Homepage Meta Keywords', 'catalyst' ); ?><br />
						<textarea id="catalyst-home-keywords" name="catalyst[home_keywords]" style="width:100%; height:133px;"><?php if( catalyst_get_core( 'home_keywords' ) ) echo catalyst_get_core( 'home_keywords' ); ?></textarea>
					</p>
				</div>
				
				<div class="bg-box">
					<p style="margin-bottom:0;">
						<b><?php _e( 'Homepage Robots Meta...', 'catalyst' ); ?></b>
					</p>
					
					<p>
						<input type="checkbox" id="catalyst-noindex-home" name="catalyst[noindex_home]" value="1" <?php if( checked( 1, catalyst_get_core( 'noindex_home' ) ) ); ?> /> <?php _e( 'Noindex Homepage', 'catalyst' ); ?><br />
						<input type="checkbox" id="catalyst-nofollow-home" name="catalyst[nofollow_home]" value="1" <?php if( checked( 1, catalyst_get_core( 'nofollow_home' ) ) ); ?> /> <?php _e( 'Nofollow Homepage', 'catalyst' ); ?><br />
						<input type="checkbox" id="catalyst-noarchive-home" name="catalyst[noarchive_home]" value="1" <?php if( checked( 1, catalyst_get_core( 'noarchive_home' ) ) ); ?> /> <?php _e( 'Noarchive Homepage', 'catalyst' ); ?>
					</p>
				</div>
			</div>
		</div>
		
		<div class="catalyst-optionbox-outer-2col">
			<div class="catalyst-optionbox-inner-2col">
				<h4><?php _e( 'Canonical SEO Options', 'catalyst' ); ?> <span id="seo-canonical-tooltip" class="tooltip-mark tooltip-top-left">[?]</span></h4>
				
				<div class="tooltip tooltip-500">
					<h5><?php _e( 'Catalyst Canonical URL Options:', 'catalyst' ); ?></h5>
					<p>
						<?php _e( 'By default your homepage and single pages and posts are displaying Canonical URL\'s in the Head of your site. The option below allows you to turn this same feature on or off for your Pagenated Archives. If you\'re unsure of whether or not to enable this option you should probably just leave it alone.', 'catalyst' ); ?>
					</p>
					
					<h5><?php _e( 'About The Canonical URL Tag:', 'catalyst' ); ?></h5>
					
					<span class="tooltip-quote">
						<p>
							<?php _e( '"The tag is part of the HTML header on a web page, the same section you\'d find the Title attribute and Meta Description tag. In fact, this tag isn\'t new, but like nofollow, simply uses a new rel parameter...', 'catalyst' ); ?>
						</p>
					
						<p>
							<?php _e( '...This would tell Yahoo!, Live & Google that the page in question should be treated as though it were a copy of the URL www.seomoz.org/blog and that all of the link & content metrics the engines apply should technically flow back to that URL."', 'catalyst' ); ?>
						</p>
					</span>
					
					<span class="tooltip-credit">
						<?php _e( 'Read more of this article here:', 'catalyst' ); ?>
						<a href="http://www.seomoz.org/blog/canonical-url-tag-the-most-important-advancement-in-seo-practices-since-sitemaps" target="_blank">Canonical URL Tag - The Most Important Advancement in SEO Practices Since Sitemaps</a>
					</span>
				</div>
				
				<div class="bg-box">
					<p>
						<input type="checkbox" id="catalyst-canonical-archives" name="catalyst[canonical_archives]" value="1" <?php if( checked( 1, catalyst_get_core( 'canonical_archives' ) ) ); ?> /> <?php _e( 'Canonical Paginated Archives', 'catalyst' ); ?>
					</p>
				</div>
			</div>
		</div>
		
		<div class="catalyst-optionbox-outer-2col">
			<div class="catalyst-optionbox-inner-2col">
				<h4><?php _e( 'Catalyst SEO Kill Switch', 'catalyst' ); ?> <span id="seo-kill-switch-tooltip" class="tooltip-mark tooltip-top-left">[?]</span></h4>
				
				<div class="tooltip tooltip-500">
					<h5><?php _e( 'About The Catalyst SEO Kill Switch:', 'catalyst' ); ?></h5>
					<p>
						<?php _e( 'Catalyst has a full setup of SEO Options including what\'s on this page and the In-Post/In-Page SEO options. When Catalyst detects that an SEO Plugin is active it will disable ALL of these SEO options to ensure there are no conflicts with such Plugins and let the Plugin do it\'s job.', 'catalyst' ); ?>
					</p>
					
					<p>
						<?php _e( 'In some cases, however, you may find that manually disabling these Catalyst SEO options is necessary. An example of this would be if you have activated an SEO Plugin that Catalyst doesn\'t recognize and therefore Catalyst\'s SEO options are still active. Either way this "Kill Switch" option gives you the ability to fully disable these Catalyst SEO options if and when you might need to do so.', 'catalyst' ); ?>
					</p>
				</div>
				
				<div class="bg-box">
					<p>
						<input type="checkbox" id="catalyst-seo-kill-switch" name="catalyst[seo_kill_switch]" value="1" <?php if( checked( 1, catalyst_get_core( 'seo_kill_switch' ) ) ); ?> /> <?php _e( 'Manually Disable ALL Catalyst SEO Options', 'catalyst' ); ?>
					</p>
				</div>
			</div>
		</div>
		
	</div>
</div>