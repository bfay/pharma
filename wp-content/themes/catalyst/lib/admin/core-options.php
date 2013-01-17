<?php
/**
 * Builds the Core Options admin page.
 *
 * @package Catalyst
 */
 
/**
 * Build the Catalyst Core Options admin page.
 *
 * @since 1.0
 */
function catalyst_core_options()
{
	global $catalyst_seo_active;
	$user = wp_get_current_user();
	?>
	<div class="wrap">
		
		<div id="catalyst-core-saved" class="catalyst-update-box"></div>
		
		<?php
		if( !empty( $_POST['action'] ) && $_POST['action'] == 'reset' )
		{
			update_option( 'catalyst_core_undo_options', catalyst_get_dynamik( null, $args = array( 'cached' => true, 'array' => true ) ) );
			update_option( 'catalyst_core_options', catalyst_core_options_defaults() );
			if( defined( 'DYNAMIK_ACTIVE' ) )
			{
				catalyst_write_styles();
			}
			catalyst_get_core( null, $args = array( 'cached' => false, 'array' => false ) );
		?>
			<script type="text/javascript">jQuery(document).ready(function($){ $('#catalyst-core-saved').html('Core Options Reset').center().fadeIn('slow');window.setTimeout(function(){$('#catalyst-core-saved').fadeOut('slow');}, 2222); });</script>
		<?php
		}
		if( !empty( $_POST['action'] ) && $_POST['action'] == 'undo' )
		{
			update_option( 'catalyst_core_options', get_option( 'catalyst_core_undo_options' ) );
			if( defined( 'DYNAMIK_ACTIVE' ) )
			{
				catalyst_write_styles();
			}
			catalyst_get_core( null, $args = array( 'cached' => false, 'array' => false ) );
		?>
			<script type="text/javascript">jQuery(document).ready(function($){ $('#catalyst-core-saved').html('Core Options Undone').center().fadeIn('slow');window.setTimeout(function(){$('#catalyst-core-saved').fadeOut('slow');}, 2222); });</script>
		<?php
		}
		if( !empty( $_GET['activetab'] ) )
		{ ?>
			<script type="text/javascript">jQuery(document).ready(function($) { $('#<?php echo $_GET['activetab']; ?>').click(); });</script>	
		<?php
		} ?>
		
		<div id="icon-options-general" class="icon32"></div>
		
		<h2 id="catalyst-admin-heading"><?php _e( 'Catalyst - Core Options', 'catalyst' ); ?></h2>
		
		<div id="catalyst-admin-wrap">
			
			<form action="/" id="core-options-form" name="core-options-form">
		
				<input type="hidden" name="action" value="catalyst_core_options_save" />
				<input type="hidden" name="security" value="<?php echo wp_create_nonce( 'core-options' ); ?>" />
				
				<div id="catalyst-floating-save">
					<img id="ajax-save-no-throb" src="<?php echo WP_CONTENT_URL . '/themes/catalyst/lib/css/images/no-throb.png'; ?>" style="margin-bottom:8px;" /><img id="ajax-save-throbber" src="<?php echo WP_CONTENT_URL . '/themes/catalyst/lib/css/images/throbber.gif'; ?>" style="display:none;margin-bottom:8px;" /><input type="image" src="<?php echo WP_CONTENT_URL . '/themes/catalyst/lib/css/images/save-changes.png'; ?>" value="<?php _e( 'Save Changes', 'catalyst' ); ?>" class="catalyst-save-button" name="Submit" alt="Save Changes" />
				</div>
				
				<div id="catalyst-core-options-nav">
					<ul>
						<li id="catalyst-core-options-nav-info" class="catalyst-options-nav-all catalyst-options-nav-active"><a href="#">Info</a></li><li id="catalyst-core-options-nav-seo" class="catalyst-options-nav-all"><a href="#">SEO</a></li><li id="catalyst-core-options-nav-header" class="catalyst-options-nav-all"><a href="#">Header</a></li><li id="catalyst-core-options-nav-navbars" class="catalyst-options-nav-all"><a href="#">Navbars</a></li><li id="catalyst-core-options-nav-content" class="catalyst-options-nav-all"><a href="#">Content</a></li><li id="catalyst-core-options-nav-excerpts" class="catalyst-options-nav-all"><a href="#">Excerpts</a></li><li id="catalyst-core-options-nav-comments" class="catalyst-options-nav-all"><a href="#">Comments</a></li><li id="catalyst-core-options-nav-footer" class="catalyst-options-nav-all"><a href="#">Footer</a></li><li id="catalyst-core-options-nav-scripts" class="catalyst-options-nav-all"><a href="#">Scripts</a></li><li id="catalyst-core-options-nav-import-export" class="catalyst-options-nav-all"><a class="catalyst-options-nav-last" href="#">Import/Export</a></li>
					</ul>
				</div>
<?php			if( !empty( $_GET['unwritable'] ) )
				{
?>					<div id="notice-box" style="background-color:#FFFBCC;border:1px solid #E6DB55;color:red;text-align:center;margin:15px 0px;padding:5px;clear:both;"><strong><?php _e( 'Catalyst Was Unable To Adjust File Permissions. Please refer to <a href="http://catalysttheme.com/forum/showthread.php?3422-Does-Catalyst-have-any-special-file-permissions-requirements-or-recommendations" target="_blank">THIS FORUM POST</a> for further instruction.', 'catalyst' ); ?></strong></div>
<?php			}
?>				<div class="catalyst-core-options-wrap">
					<?php require_once( CATALYST_ADMIN . '/boxes/core-seo.php' ); ?>
					<?php require_once( CATALYST_ADMIN . '/boxes/core-header.php' ); ?>
					<?php require_once( CATALYST_ADMIN . '/boxes/core-navbars.php' ); ?>
					<?php require_once( CATALYST_ADMIN . '/boxes/core-content.php' ); ?>
					<?php require_once( CATALYST_ADMIN . '/boxes/core-excerpts.php' ); ?>
					<?php require_once( CATALYST_ADMIN . '/boxes/core-comments.php' ); ?>
					<?php require_once( CATALYST_ADMIN . '/boxes/core-footer.php' ); ?>
					<?php require_once( CATALYST_ADMIN . '/boxes/core-scripts.php' ); ?>
				</div>
			
			</form>
		
			<div class="catalyst-core-options-wrap">
				<?php require_once( CATALYST_ADMIN . '/boxes/core-info.php' ); ?>
				<?php require_once( CATALYST_ADMIN . '/boxes/core-import-export.php' ); ?>
			</div>
			
			<div id="catalyst-admin-footer">
				<p>
					<a href="http://catalysttheme.com" target="_blank">CatalystTheme.com</a> | <a href="http://catalysttheme.com/resources" target="_blank">Resources</a> | <a href="http://catalysttheme.com/forum" target="_blank">Support Forum</a> | <a href="http://catalysttheme.com/affiliates" target="_blank">Affiliates</a> &middot;
					<a><span id="show-options-reset" class="catalyst-custom-fonts-button" style="background:none; border:0; padding:0; margin:0; float:none;"><?php _e( '[Core Options Reset]', 'catalyst' ); ?></span></a>
				</p>
			</div>
			<div style="display:none; position:inherit; height:25px; width:570px; margin:-11px 0 0 95px; float:left;" id="show-options-reset-box" class="catalyst-custom-fonts-box">
				<form style="width:450px; float:left;" id="catalyst-reset-core-options" method="post">
					<strong><?php _e( '**This Will Reset ALL Your Core Options**', 'catalyst' ); ?></strong>
					<input style="background:#D54E21; color:#FFFFFF;" type="submit" value="<?php _e( 'Reset Core Options', 'catalyst' ); ?>" class="catalyst-reset" name="Submit" onClick='return confirm("<?php _e( 'Are you sure your want to reset your Core Options?', 'catalyst' ); ?>")'/><input type="hidden" name="action" value="reset" />
				
				</form>
				
				<form style="width:110px; float:left;" id="catalyst-undo-core-options" method="post">
					<input type="submit" value="<?php _e( 'Undo Last Save', 'catalyst' ); ?>" class="catalyst-undo" name="Submit" onClick='return confirm("<?php _e( 'Are you sure your want to undo your last Core Options Save?', 'catalyst' ); ?>")'/><input type="hidden" name="action" value="undo" />
				</form>
			</div>
		</div>
	</div> <!-- Close Wrap -->
	<?php 
}

add_action( 'wp_ajax_catalyst_core_options_save', 'catalyst_core_options_save' );
/**
 * Use ajax to update the Core Options based on the posted values.
 *
 * @since 1.0
 */
function catalyst_core_options_save()
{
	check_ajax_referer( 'core-options', 'security' );
	
	if( catalyst_get_core( 'comment_submit_text' ) != '' && catalyst_get_core( 'footer_content' ) != '' )
	{
		update_option( 'catalyst_core_undo_options', catalyst_get_core( null, $args = array( 'cached' => true, 'array' => true ) ) );
	}
	
	$update = $_POST['catalyst'];
	update_option( 'catalyst_core_options', $update );
	
	if ( defined( 'DYNAMIK_ACTIVE' ) )
	{
		catalyst_write_styles();
	}
	
	echo 'Core Options Updated';
	exit();
}

/**
 * Create an array of Core Options default values.
 *
 * @since 1.0
 * @return an array of Core Options default values.
 */
function catalyst_core_options_defaults( $defaults = true, $import = false )
{	
	$defaults = array(
		'site_layout_type' => 'double-right-sidebar',
		'page_layout_type' => 'catalyst_default',
		'post_layout_type' => 'catalyst_default',
		'archive_layout_type' => 'catalyst_default',
		'category_layout_type' => 'catalyst_default',
		'tag_layout_type' => 'catalyst_default',
		'author_layout_type' => 'catalyst_default',
		'search_layout_type' => 'catalyst_default',
		'buddypress_layout_type' => 'catalyst_default',
		'bbpress_layout_type' => 'catalyst_default',
		'woocommerce_layout_type' => 'catalyst_default',
		'404_layout_type' => 'catalyst_default',
		'logo_type' => 'Text',
		'logo_links_to' => 'homepage',
		'alt_logo_link' => '',
		'alt_logo_link_title' => '',
		'header_right_active' => ( $defaults || !empty( $import['header_right_active'] ) ) ? 1 : 0,
		'default_content_type' => 'Full Content',
		'default_content_featured_post_number' => '2',
		'default_content_hybrid_excerpt_type' => 'columns',
		'archive_content_type' => 'Excerpt',
		'archive_content_featured_post_number' => '2',
		'archive_content_hybrid_excerpt_type' => 'columns',
		'read_more_text' => 'Read more &raquo;',
		'post_nav_type' => 'prev-next',
		'remove_all_page_titles' => ( !$defaults && !empty( $import['remove_all_page_titles'] ) ) ? 1 : 0,
		'remove_page_titles_ids' => '',
		'include_inpost_cpt_names' => '',
		'blog_cat_display' => 'All Categories',
		'blog_exclude_cats' => '',
		'blog_post_number' => '6',
		'fourofour_page_content_sitemap' => ( !$defaults && !empty( $import['fourofour_page_content_sitemap'] ) ) ? 1 : 0,
		'breadcrumbs_front_page' => ( $defaults || !empty( $import['breadcrumbs_front_page'] ) ) ? 1 : 0,
		'breadcrumbs_posts' => ( $defaults || !empty( $import['breadcrumbs_posts'] ) ) ? 1 : 0,
		'breadcrumbs_pages' => ( $defaults || !empty( $import['breadcrumbs_pages'] ) ) ? 1 : 0,
		'breadcrumbs_archives' => ( $defaults || !empty( $import['breadcrumbs_archives'] ) ) ? 1 : 0,
		'breadcrumbs_404' => ( !$defaults && !empty( $import['breadcrumbs_404'] ) ) ? 1 : 0,
		'breadcrumbs_blog' => ( $defaults || !empty( $import['breadcrumbs_blog'] ) ) ? 1 : 0,
		'breadcrumbs_blank_content' => ( $defaults || !empty( $import['breadcrumbs_blank_content'] ) ) ? 1 : 0,
		'breadcrumbs_text_main' => 'You are here:',
		'breadcrumbs_text_home' => 'Home',
		'breadcrumbs_text_archives' => 'Archives for',
		'breadcrumbs_text_search' => 'Search for',
		'breadcrumbs_text_404' => 'Page Not Found',
		'breadcrumbs_text_sep' => '&raquo;',
		'byline_author' => ( $defaults || !empty( $import['byline_author'] ) ) ? 1 : 0,
		'byline_date' => ( $defaults || !empty( $import['byline_date'] ) ) ? 1 : 0,
		'byline_comments' => ( $defaults || !empty( $import['byline_comments'] ) ) ? 1 : 0,
		'byline_edit_link' => ( $defaults || !empty( $import['byline_edit_link'] ) ) ? 1 : 0,
		'byline_author_text' => 'Written <em>by</em>',
		'byline_date_text' => '<em>on</em>',
		'byline_comment_sep_text' => '&middot;',
		'byline_zero_comment_text' => 'Leave a Comment',
		'cat_meta_display' => ( $defaults || !empty( $import['cat_meta_display'] ) ) ? 1 : 0,
		'tag_meta_display' => ( $defaults || !empty( $import['tag_meta_display'] ) ) ? 1 : 0,
		'author_info_display' => ( $defaults || !empty( $import['author_info_display'] ) ) ? 1 : 0,
		'cat_meta_text' => 'Categories:',
		'tag_meta_text' => 'Tags:',
		'tag_meta_sep' => '-',
		'cat_tag_meta_sep' => ',',
		'post_author_box_link_text' => 'View all posts by [post_author] &raquo;',
		'page_edit_link' => ( $defaults || !empty( $import['page_edit_link'] ) ) ? 1 : 0,
		'dynamik_responsive' => ( !$defaults && !empty( $import['dynamik_responsive'] ) ) ? 1 : 0,
		'excerpt_content_limit' => '50',
		'excerpt_read_more_placement' => 'Inline',
		'archive_thumbnails' => ( $defaults || !empty( $import['archive_thumbnails'] ) ) ? 1 : 0,
		'thumbnail_alignment' => 'Left',
		'thumbnail_location' => 'Inside',
		'thumbnail_size' => 'thumbnail',
		'comment_display_posts' => ( $defaults || !empty( $import['comment_display_posts'] ) ) ? 1 : 0,
		'comment_display_pages' => ( !$defaults && !empty( $import['comment_display_pages'] ) ) ? 1 : 0,
		'comment_trackbacks_display_posts' => ( $defaults || !empty( $import['comment_trackbacks_display_posts'] ) ) ? 1 : 0,
		'comment_trackbacks_display_pages' => ( !$defaults && !empty( $import['comment_trackbacks_display_pages'] ) ) ? 1 : 0,
		'comment_attributes' => ( !$defaults && !empty( $import['comment_attributes'] ) ) ? 1 : 0,
		'comment_author_form_label' => 'Name',
		'comment_email_form_label' => 'Email',
		'comment_url_form_label' => 'Website',
		'text_above_comment_box' => 'Leave A Comment...',
		'comment_submit_text' => 'Submit',
		'footer_content' => '[left_open] [custom_text] [wp_login] [close] [right_open] [catalyst_attribute] [close]' . "\n" . '[center_open] [copyright] [close]',
		'custom_footer_text' => '',
		'affiliate_link' => '',
		'append_description_title' => ( $defaults || !empty( $import['append_description_title'] ) ) ? 1 : 0,
		'append_site_name' => ( $defaults || !empty( $import['append_site_name'] ) ) ? 1 : 0,
		'title_append_location' => 'Right',
		'title_tag_separator' => '|',
		'h1_tag_placement' => 'h1_wrap_tagline',
		'home_title' => '',
		'home_description' => '',
		'home_keywords' => '',
		'noindex_home' => ( !$defaults && !empty( $import['noindex_home'] ) ) ? 1 : 0,
		'nofollow_home' => ( !$defaults && !empty( $import['nofollow_home'] ) ) ? 1 : 0,
		'noarchive_home' => ( !$defaults && !empty( $import['noarchive_home'] ) ) ? 1 : 0,
		'canonical_archives' => ( $defaults || !empty( $import['canonical_archives'] ) ) ? 1 : 0,
		'noindex_archives' => ( $defaults || !empty( $import['noindex_archives'] ) ) ? 1 : 0,
		'noindex_cats' => ( !$defaults && !empty( $import['noindex_cats'] ) ) ? 1 : 0,
		'noindex_tags' => ( $defaults || !empty( $import['noindex_tags'] ) ) ? 1 : 0,
		'noindex_authors' => ( $defaults || !empty( $import['noindex_authors'] ) ) ? 1 : 0,
		'nofollow_comment_author' => ( $defaults || !empty( $import['nofollow_comment_author'] ) ) ? 1 : 0,
		'noarchive_site' => ( !$defaults && !empty( $import['noarchive_site'] ) ) ? 1 : 0,
		'noarchive_archives' => ( !$defaults && !empty( $import['noarchive_archives'] ) ) ? 1 : 0,
		'noarchive_cats' => ( !$defaults && !empty( $import['noarchive_cats'] ) ) ? 1 : 0,
		'noarchive_tags' => ( !$defaults && !empty( $import['noarchive_tags'] ) ) ? 1 : 0,
		'noarchive_authors' => ( !$defaults && !empty( $import['noarchive_authors'] ) ) ? 1 : 0,
		'seo_kill_switch' => ( !$defaults && !empty( $import['seo_kill_switch'] ) ) ? 1 : 0,
		'nav1_type' => 'Default',
		'nav1_enable_superfish' => ( $defaults || !empty( $import['nav1_enable_superfish'] ) ) ? 1 : 0,
		'navbar_superfish_arrows' => ( $defaults || !empty( $import['navbar_superfish_arrows'] ) ) ? 1 : 0,
		'nav1_content' => 'pages',
		'nav1_submenu_depth' => 'No Limit',
		'nav1_home_tab_text' => 'Home',
		'nav1_include_pages' => '',
		'nav1_exclude_pages' => '',
		'nav2_type' => 'None',
		'nav2_enable_superfish' => ( $defaults || !empty( $import['nav2_enable_superfish'] ) ) ? 1 : 0,
		'nav2_content' => 'categories',
		'nav2_submenu_depth' => 'No Limit',
		'nav2_home_tab_text' => '',
		'nav2_include_pages' => '',
		'nav2_exclude_pages' => '',
		'rss_link' => '',
		'email_feed_link' => '',
		'twitter_id' => '',
		'twitter_text' => 'Follow On',
		'search_button_text' => 'SEARCH',
		'search_form_text' => 'Search this website...',
		'show_search_button' => ( !$defaults && !empty( $import['show_search_button'] ) ) ? 1 : 0,
		'nav1_right_content' => 'Empty',
		'nav1_right_text' => '',
		'nav2_right_content' => 'Empty',
		'nav2_right_text' => '',
		'modernizr_script_active' => ( !$defaults && !empty( $import['modernizr_script_active'] ) ) ? 1 : 0,
		'respond_script_active' => ( !$defaults && !empty( $import['respond_script_active'] ) ) ? 1 : 0,
		'header_scripts' => '',
		'footer_scripts' => ''
	);
	
	return apply_filters( 'catalyst_core_options_defaults', $defaults );
}

//end lib/admin/core-options.php