<?php
/**
 * Builds the Dynamik Options admin page.
 *
 * Note: This file is only called in if the
 * Dynamik Child Theme is active.
 *
 * @package Catalyst
 */
 
/**
 * Build the Catalyst Dynamik Options admin page.
 *
 * @since 1.0
 */
function catalyst_dynamik_options()
{
	global $message;
	$catalyst_dynamik_snapshot_options = get_option( 'catalyst_dynamik_snapshot_options' );
	$dynamik_font_type = catalyst_get_dynamik( 'font_type' );

	if( $dynamik_font_type )
	{
		foreach( $dynamik_font_type as $key => $value )
		{
			$dynamik_font_type[$key] = $value;
		}
	}
	
	$catalyst_layout_info = explode( ' ', catalyst_site_layout() );
	$catalyst_layout_type = $catalyst_layout_info[0];
	?>
	<div class="wrap">
	
		<div id="catalyst-dynamik-saved" class="catalyst-update-box"></div>
		
		<?php
		if( !empty( $_POST['action'] ) && $_POST['action'] == 'reset' )
		{
			update_option( 'catalyst_dynamik_undo_options', catalyst_get_dynamik( null, $args = array( 'cached' => true, 'array' => true ) ) );
			update_option( 'catalyst_responsive_undo_options', catalyst_get_responsive( null, $args = array( 'cached' => true, 'array' => true ) ) );
			update_option( 'catalyst_dynamik_options', catalyst_dynamik_options_defaults() );
			update_option( 'catalyst_responsive_options', catalyst_responsive_options_defaults() );
			catalyst_write_styles();
			$dynamik_font_type = catalyst_get_dynamik( 'font_type' );
		?>
			<script type="text/javascript">jQuery(document).ready(function($){ $('#catalyst-dynamik-saved').html('Dynamik Options Reset').center().fadeIn('slow');window.setTimeout(function(){$('#catalyst-dynamik-saved').fadeOut( 'slow' );}, 2222); });</script>
		<?php
		}
		if( !empty( $_POST['action'] ) && $_POST['action'] == 'undo' )
		{
			update_option( 'catalyst_dynamik_options', get_option( 'catalyst_dynamik_undo_options' ) );
			update_option( 'catalyst_responsive_options', get_option( 'catalyst_responsive_undo_options' ) );
			catalyst_write_styles();
			catalyst_get_responsive( null, $args = array( 'cached' => false, 'array' => false ) );
			$dynamik_font_type = catalyst_get_dynamik( 'font_type' );
		?>
			<script type="text/javascript">jQuery(document).ready(function($){ $('#catalyst-dynamik-saved').html('Dynamik Options Undone').center().fadeIn('slow');window.setTimeout(function(){$('#catalyst-dynamik-saved').fadeOut( 'slow' );}, 2222); });</script>
		<?php
		}
		if( !empty( $_GET['activetab'] ) )
		{
		?>
			<script type="text/javascript">jQuery(document).ready(function($) { $('#<?php echo $_GET['activetab']; ?>').click(); });</script>	
		<?php
		}
		?>
		
		<div id="icon-options-general" class="icon32"></div>
		
		<h2 id="catalyst-admin-heading" style="width:310px;"><?php _e( 'Catalyst - Dynamik Options', 'catalyst' ); ?></h2>
		
		<div class="catalyst-css-builder-button-wrap" style="margin-right:10px;">
			<span id="show-hide-dynamik-settings-button" class="show-hide-custom-css-builder-styles"><?php _e( 'Additional Settings', 'catalyst' ); ?></span>
		</div>
		
		<div class="catalyst-css-builder-button-wrap">
			<span id="show-hide-custom-css-builder" class="show-hide-custom-css-builder-styles"><?php _e( 'CSS Builder', 'catalyst' ); ?></span>
		</div>
		<?php
		$dynamik_nav_add_page_padding = '';
		if( catalyst_get_dynamik( 'dynamik_options_control' ) == 'structure_settings' )
		{
			$admin_wrap_class = ' class="catalyst-wrap-structure-settings"';
			$nav_alt_id = 'alt-';
			$body_display = '';
			$nav_display = ' catalyst-options-display';
			$hide_mini_nav = false;
			if( !catalyst_get_core( 'dynamik_responsive' ) )
			{
				$dynamik_nav_add_page_padding = 'dynamik-nav-add-page-padding ';
			}
		}
		elseif( catalyst_get_dynamik( 'dynamik_options_control' ) == 'design_standard' )
		{
			$admin_wrap_class = ' class="catalyst-wrap-design-standard"';
			$nav_alt_id = '';
			$body_display = ' catalyst-options-display';
			$nav_display = '';
			$hide_mini_nav = true;
		}
		else
		{
			$admin_wrap_class = '';
			$nav_alt_id = '';
			$body_display = ' catalyst-options-display';
			$nav_display = '';
			$hide_mini_nav = true;
		}
		?>
		<div id="catalyst-admin-wrap"<?php echo $admin_wrap_class ?>>
		
			<?php require_once( CATALYST_ADMIN . '/boxes/advanced-custom-css-builder.php' ); ?>
			
			<form action="/" id="dynamik-options-form" name="dynamik-options-form">
			
				<input type="hidden" name="action" value="catalyst_dynamik_options_save" />
				<input type="hidden" name="security" value="<?php echo wp_create_nonce( 'dynamik-options' ); ?>" />
				
				<div id="catalyst-floating-save">
					<img id="ajax-save-no-throb" src="<?php echo WP_CONTENT_URL . '/themes/catalyst/lib/css/images/no-throb.png'; ?>" style="margin-bottom:8px;" /><img id="ajax-save-throbber" src="<?php echo WP_CONTENT_URL . '/themes/catalyst/lib/css/images/throbber.gif'; ?>" style="display:none;margin-bottom:8px;" /><input type="image" src="<?php echo WP_CONTENT_URL . '/themes/catalyst/lib/css/images/save-changes.png'; ?>" value="<?php _e( 'Save Changes', 'catalyst' ); ?>" class="catalyst-save-button" name="Submit" alt="Save Changes" />
				</div>
				
				<div class="dynamik-structure-settings-hide">
			
				<div id="catalyst-dynamik-options-nav1" class="catalyst-dynamik-options-nav">
					<ul>
						<li id="catalyst-dynamik-options-nav-body" class="catalyst-options-nav-all catalyst-options-nav-active"><a href="#">Body</a></li><li id="catalyst-dynamik-options-nav-wrap" class="catalyst-options-nav-all"><a href="#">Wrap</a></li><li id="catalyst-dynamik-options-nav-header" class="catalyst-options-nav-all"><a href="#">Header</a></li><li id="catalyst-dynamik-options-nav-nav1" class="catalyst-options-nav-all"><a href="#">Navbar 1</a></li><li id="catalyst-dynamik-options-nav-nav2" class="catalyst-options-nav-all"><a href="#">Navbar 2</a></li><li id="catalyst-dynamik-options-nav-content" class="catalyst-options-nav-all"><a href="#">Content</a></li><li id="catalyst-dynamik-options-nav-comments" class="catalyst-options-nav-all"><a href="#">Comments</a></li><li id="catalyst-dynamik-options-nav-sidebars" class="catalyst-options-nav-all"><a href="#">Sidebars</a></li><li id="catalyst-dynamik-options-nav-footer" class="catalyst-options-nav-all"><a class="catalyst-options-nav-last" href="#">Footer</a></li>
					</ul>
				</div>
				
				<div id="catalyst-dynamik-options-nav2" class="catalyst-dynamik-options-nav">
					<ul>
						<li id="catalyst-dynamik-options-nav-widths" class="catalyst-options-nav-all dynamik-update-wrap-widths"><a href="#">Widths</a></li><?php $child_info = function_exists( 'wp_get_theme' ) ? wp_get_theme() : get_theme_data( CHILD_ROOT . '/style.css' ); if( ( function_exists( 'wp_get_theme' ) && $child_info->Version > '1.0.1' ) || ( !function_exists( 'wp_get_theme' ) && esc_attr( $child_info['Version'] ) > '1.0.1' ) ) { ?><li id="catalyst-dynamik-options-nav-ez" class="catalyst-options-nav-all"><a href="#">EZ</a></li><?php } ?><li id="catalyst-dynamik-options-nav-widgets" class="catalyst-options-nav-all"><a href="#">Widgets</a><li id="catalyst-dynamik-options-nav-search" class="catalyst-options-nav-all"><a href="#">Search</a></li><li id="catalyst-dynamik-options-nav-breadcrumbs" class="catalyst-options-nav-all"><a href="#"><?php if( catalyst_get_core( 'dynamik_responsive') ) { ?>Crumbs<?php } else { ?>Breadcrumbs<?php } ?></a></li><li id="catalyst-dynamik-options-nav-author" class="catalyst-options-nav-all"><a href="#">Author</a></li><li id="catalyst-dynamik-options-nav-post-nav" class="catalyst-options-nav-all"><a href="#">Post Nav</a></li><li id="catalyst-dynamik-options-nav-hide" class="catalyst-options-nav-all"><a href="#">Hide</a></li><?php if( catalyst_get_core( 'dynamik_responsive') ) { ?><li id="catalyst-dynamik-options-nav-responsive" class="catalyst-options-nav-all dynamik-update-wrap-widths"><a href="#">Responsive</a></li><?php } ?><li id="catalyst-dynamik-options-nav-image-uploader" class="catalyst-options-nav-all"><a href="#"><?php if( catalyst_get_core( 'dynamik_responsive') ) { ?>Images<?php } else { ?>Image Uploader<?php } ?></a></li><li id="catalyst-dynamik-options-nav-import-export" class="catalyst-options-nav-all"><a class="catalyst-options-nav-last" href="#">Import/Export</a></li>
					</ul>
				</div>
				
				</div><!-- End .dynamik-structure-settings-hide -->
				
				<div id="catalyst-core-options-nav" class="<?php echo $dynamik_nav_add_page_padding; ?>dynamik-design-control-hide dynamik-structure-settings-show" style="display:<?php echo $hide_mini_nav ? 'none' : 'blcok'; ?>">
					<ul>
						<li id="catalyst-dynamik-options-nav-alt-nav1" class="catalyst-options-nav-all catalyst-options-nav-active"><a href="#">Navbar 1</a></li><li id="catalyst-dynamik-options-nav-alt-nav2" class="catalyst-options-nav-all"><a href="#">Navbar 2</a></li><li id="catalyst-dynamik-options-nav-alt-ez" class="catalyst-options-nav-all"><a href="#">EZ Widget Areas</a></li><li id="catalyst-dynamik-options-nav-alt-hide" class="catalyst-options-nav-all"><a href="#">Hide HTML</a></li><?php if( catalyst_get_core( 'dynamik_responsive') ) { ?><li id="catalyst-dynamik-options-nav-alt-responsive" class="catalyst-options-nav-all"><a href="#">Responsive Design</a></li><?php } ?><li id="catalyst-dynamik-options-nav-alt-image-uploader" class="catalyst-options-nav-all"><a href="#">Image Uploader</a></li><li id="catalyst-dynamik-options-nav-alt-import-export" class="catalyst-options-nav-all"><a class="catalyst-options-nav-last" href="#">Import / Export</a></li>
					</ul>
				</div>
				
				<div class="catalyst-dynamik-options-wrap">
					<?php require_once( CATALYST_ADMIN . '/boxes/dynamik-settings.php' ); ?>
					<?php require_once( CATALYST_ADMIN . '/boxes/dynamik-body.php' ); ?>
					<?php require_once( CATALYST_ADMIN . '/boxes/dynamik-wrap.php' ); ?>
					<?php require_once( CATALYST_ADMIN . '/boxes/dynamik-header.php' ); ?>
					<?php require_once( CATALYST_ADMIN . '/boxes/dynamik-navbar-1.php' ); ?>
					<?php require_once( CATALYST_ADMIN . '/boxes/dynamik-navbar-2.php' ); ?>
					<?php require_once( CATALYST_ADMIN . '/boxes/dynamik-content.php' ); ?>
					<?php require_once( CATALYST_ADMIN . '/boxes/dynamik-comments.php' ); ?>
					<?php require_once( CATALYST_ADMIN . '/boxes/dynamik-sidebars.php' ); ?>
					<?php require_once( CATALYST_ADMIN . '/boxes/dynamik-footer.php' ); ?>
					<?php require_once( CATALYST_ADMIN . '/boxes/dynamik-widths.php' ); ?>
					<?php require_once( CATALYST_ADMIN . '/boxes/dynamik-ez.php' ); ?>
					<?php require_once( CATALYST_ADMIN . '/boxes/dynamik-widgets.php' ); ?>
					<?php require_once( CATALYST_ADMIN . '/boxes/dynamik-search.php' ); ?>
					<?php require_once( CATALYST_ADMIN . '/boxes/dynamik-breadcrumbs.php' ); ?>
					<?php require_once( CATALYST_ADMIN . '/boxes/dynamik-author.php' ); ?>
					<?php require_once( CATALYST_ADMIN . '/boxes/dynamik-post-nav.php' ); ?>
					<?php require_once( CATALYST_ADMIN . '/boxes/dynamik-hide.php' ); ?>
				</div>
			
			</form>
		
			<div class="catalyst-dynamik-options-wrap">
				<?php
				if( catalyst_get_core( 'dynamik_responsive') )
				{
					require_once( CATALYST_ADMIN . '/boxes/dynamik-responsive.php' );
				}
				?>
				<?php require_once( CATALYST_ADMIN . '/boxes/dynamik-import-export.php' ); ?>
			</div>
		
			<?php require_once( CATALYST_ADMIN . '/boxes/dynamik-image-uploader.php' ); ?>
			
			<div id="catalyst-admin-footer">
				<p>
					<a href="http://catalysttheme.com" target="_blank">CatalystTheme.com</a> | <a href="http://catalysttheme.com/resources" target="_blank">Resources</a> | <a href="http://catalysttheme.com/forum" target="_blank">Support Forum</a> | <a href="http://catalysttheme.com/affiliates" target="_blank">Affiliates</a> &middot;
					<a><span id="show-options-reset" class="catalyst-custom-fonts-button" style="background:none; border:0; padding:0; margin:0; float:none;"><?php _e( '[Dynamik Options Reset]', 'catalyst' ); ?></span></a>
				</p>
			</div>
			
			<div style="display:none; position:inherit; height:25px; width:610px; margin:-11px 0 0 90px; float:left;" id="show-options-reset-box" class="catalyst-custom-fonts-box">
				<form style="width:490px; float:left;" id="catalyst-reset-dynamik-options" method="post">
					<strong><?php _e( '**This Will Reset ALL Your Dynamik Options**', 'catalyst' ); ?></strong>
					<input style="background:#D54E21; color:#FFFFFF;" type="submit" value="<?php _e( 'Reset Dynamik Options', 'catalyst' ); ?>" class="catalyst-reset" name="Submit" onClick='return confirm("<?php _e( 'Are you sure your want to reset your Dynamik Options?', 'catalyst' ); ?>")'/><input type="hidden" name="action" value="reset" />
				</form>
				
				<form style="width:110px; float:left;" id="catalyst-undo-dynamik-options" method="post">
					<input type="submit" value="<?php _e( 'Undo Last Save', 'catalyst' ); ?>" class="catalyst-undo" name="Submit" onClick='return confirm("<?php _e( 'Are you sure your want to undo your last Dynamik Options Save?', 'catalyst' ); ?>")'/><input type="hidden" name="action" value="undo" />
				</form>
			</div>
		</div>
	</div> <!-- Close Wrap -->
<?php
}

add_action( 'wp_ajax_catalyst_dynamik_options_save', 'catalyst_dynamik_options_save' );
/**
 * Use ajax to update the Dynamik Options based on the posted values.
 *
 * @since 1.0
 */
function catalyst_dynamik_options_save()
{
	check_ajax_referer( 'dynamik-options', 'security' );
	
	if( !empty( $_POST['custom_layout_widths'] ) )
	{
		catalyst_update_custom_layout_widths( $_POST['custom_layout_widths'] );
	}
	
	if( catalyst_get_dynamik('post_nav_padding_top' ) != '' && catalyst_get_dynamik( 'post_nav_padding_bottom' ) != '' )
	{
		update_option( 'catalyst_dynamik_undo_options', catalyst_get_dynamik( null, $args = array( 'cached' => true, 'array' => true ) ) );
	}
	
	$update = $_POST['catalyst'];
	update_option( 'catalyst_dynamik_options', $update );
	
	catalyst_write_styles();
	
	echo 'Dynamik Options Updated';
	exit();
}

add_action( 'wp_ajax_catalyst_responsive_options_save', 'catalyst_responsive_options_save' );
/**
 * Use ajax to update the Dynamik Responsive Options based on the posted values.
 *
 * @since 1.5
 */
function catalyst_responsive_options_save()
{
	check_ajax_referer( 'responsive-options', 'security' );
	
	if( catalyst_get_dynamik('post_nav_padding_top' ) != '' && catalyst_get_dynamik( 'post_nav_padding_bottom' ) != '' )
	{
		update_option( 'catalyst_responsive_undo_options', catalyst_get_responsive( null, $args = array( 'cached' => true, 'array' => true ) ) );
	}
	
	$update = $_POST['catalyst'];
	update_option( 'catalyst_responsive_options', $update );

	echo 'Responsive Options Updated';
	exit();
}

/**
 * Create an array of Responsive Options default values.
 *
 * @since 1.5
 * @return an array of Responsive Options default values.
 */
function catalyst_responsive_options_defaults()
{
	$defaults = array(
		'viewport_meta_content' => 'width=device-width, initial-scale=1.0',
		'wrap_media_query_default' => 'default',
		'header_media_query_default' => 'default',
		'navbar_media_query_default' => 'default',
		'content_media_query_default' => 'default',
		'ez_media_query_default' => 'default',
		'footer_media_query_default' => 'default',
		'dropdown_menu_1_text' => 'Navigation',
		'dropdown_menu_2_text' => 'Navigation',
		'media_wrap_width' => '960',
		'media_query_large_cascading_content' => '',
		'media_query_large_content' => '',
		'media_query_medium_large_content' => '',
		'media_query_medium_cascading_content' => '',
		'media_query_medium_content' => '',
		'media_query_small_content' => ''
	);
	
	return apply_filters( 'catalyst_responsive_options_defaults', $defaults );
}

/**
 * Create an array of specific Dynamik Options values that
 * are required on the front-end.
 *
 * @since 1.4
 * @return an array of specific Dynamik Options values.
 */
function catalyst_update_dynamik_alt_options()
{
	$dynamik_alt_options = array(
		'minify_css' => catalyst_get_dynamik( 'minify_css' ),
		'post_formats_active' => catalyst_get_dynamik( 'post_formats_active' ),
		'wrap_open_placement' => catalyst_get_dynamik( 'wrap_open_placement' ),
		'wrap_close_placement' => catalyst_get_dynamik( 'wrap_close_placement' ),
		'nav1_location' => catalyst_get_dynamik( 'nav1_location' ),
		'nav2_location' => catalyst_get_dynamik( 'nav2_location' ),
		'dynamik_homepage_type' => catalyst_get_dynamik( 'dynamik_homepage_type' ),
		'ez_homepage_select' => catalyst_get_dynamik( 'ez_homepage_select' ),
		'ez_static_home_sb_display' => catalyst_get_dynamik( 'ez_static_home_sb_display' ),
		'ez_static_home_sb_location' => catalyst_get_dynamik( 'ez_static_home_sb_location' ),
		'ez_home_slider_display' => catalyst_get_dynamik( 'ez_home_slider_display' ),
		'ez_home_slider_location' => catalyst_get_dynamik( 'ez_home_slider_location' ),
		'ez_feature_top_display_front_page' => catalyst_get_dynamik( 'ez_feature_top_display_front_page' ),
		'ez_feature_top_display_posts' => catalyst_get_dynamik( 'ez_feature_top_display_posts' ),
		'ez_feature_top_display_pages' => catalyst_get_dynamik( 'ez_feature_top_display_pages' ),
		'ez_feature_top_display_archives' => catalyst_get_dynamik( 'ez_feature_top_display_archives' ),
		'ez_feature_top_display_blog' => catalyst_get_dynamik( 'ez_feature_top_display_blog' ),
		'ez_feature_top_display_blank_content' => catalyst_get_dynamik( 'ez_feature_top_display_blank_content' ),
		'ez_feature_top_position' => catalyst_get_dynamik( 'ez_feature_top_position' ),
		'ez_feature_top_select' => catalyst_get_dynamik( 'ez_feature_top_select' ),
		'ez_fat_footer_display_front_page' => catalyst_get_dynamik( 'ez_fat_footer_display_front_page' ),
		'ez_fat_footer_display_posts' => catalyst_get_dynamik( 'ez_fat_footer_display_posts' ),
		'ez_fat_footer_display_pages' => catalyst_get_dynamik( 'ez_fat_footer_display_pages' ),
		'ez_fat_footer_display_archives' => catalyst_get_dynamik( 'ez_fat_footer_display_archives' ),
		'ez_fat_footer_display_blog' => catalyst_get_dynamik( 'ez_fat_footer_display_blog' ),
		'ez_fat_footer_display_blank_content' => catalyst_get_dynamik( 'ez_fat_footer_display_blank_content' ),
		'ez_fat_footer_position' => catalyst_get_dynamik( 'ez_fat_footer_position' ),
		'ez_fat_footer_select' => catalyst_get_dynamik( 'ez_fat_footer_select' ),
		'font_type' => catalyst_get_dynamik( 'font_type' )
	);
	
	update_option( 'catalyst_dynamik_alt_options', $dynamik_alt_options );
}

/**
 * Create an array of Dynamik Options default values.
 *
 * @since 1.0
 * @return an array of Dynamik Options default values.
 */
function catalyst_dynamik_options_defaults( $defaults = true, $option_check = false, $import = false )
{
	$defaults = array(
		'universal_font_color' => '111111',
		'universal_font_css' => '',
		'universal_heading_font_color' => '333333',
		'universal_heading_font_css' => '',
		'universal_content_font_color' => '111111',
		'universal_content_font_css' => '',
		'universal_link_color' => '21759B',
		'universal_link_hover_color' => 'D54E21',
		'universal_link_underline' => 'On Hover',
		'body_font_size' => '14',
		'universal_line_height' => '23px',
		'body_font_css' => '',
		'body_bg_type' => 'color',
		'body_bg_color' => 'FAFAFA',
		'body_bg_image' => '',
		'post_formats_active' => ( !$defaults && !empty( $import['post_formats_active'] ) ) ? 1 : 0,
		'minify_css' => ( $defaults || !empty( $import['minify_css'] ) ) ? 1 : 0,
		'dynamik_options_control' => 'kitchen_sink',
		'wrap_bg_type' => 'color',
		'wrap_bg_no_color' => ( !$defaults && !empty( $import['wrap_bg_no_color'] ) ) ? 1 : 0,
		'wrap_bg_color' => 'FFFFFF',
		'wrap_bg_image' => '',
		'container_wrap_bg_type' => 'color',
		'container_wrap_bg_no_color' => ( !$defaults && !empty( $import['container_wrap_bg_no_color'] ) ) ? 1 : 0,
		'container_wrap_bg_color' => 'FFFFFF',
		'container_wrap_bg_image' => '',
		'wrap_border_type' => 'Full',
		'wrap_border_thickness' => '1',
		'wrap_border_style' => 'solid',
		'wrap_border_color' => 'E8E8E8',
		'wrap_shadow_active' => ( $defaults || !empty( $import['wrap_shadow_active'] ) ) ? 1 : 0,
		'wrap_shadow_style' => '0px 5px 10px #DDDDDD',
		'wrap_radius_active' => ( !$defaults && !empty( $import['wrap_radius_active'] ) ) ? 1 : 0,
		'wrap_radius_style' => '6px',
		'wrap_top_margin' => '20',
		'wrap_bottom_margin' => '20',
		'wrap_tb_padding' => '0',
		'wrap_lr_padding' => '0',
		'container_wrap_tb_padding' => '20',
		'container_wrap_lr_padding' => '20',
		'sb_separation_padding' => '20',
		'wrap_open_placement' => 'wrap_open_before_before_header',
		'wrap_close_placement' => 'wrap_close_after_after_footer',
		'text_logo_top_padding' => '26',
		'text_logo_left_padding' => '20',
		'tagline_top_padding' => '8',
		'image_logo_top_margin' => '0',
		'image_logo_left_margin' => '0',
		'header_right_top_padding' => '0',
		'header_right_right_padding' => '0',
		'header_left_width' => '320',
		'header_right_width' => '550',
		'header_height' => '100',
		'logo_image' => '',
		'header_bg_type' => 'color',
		'header_bg_no_color' => ( !$defaults && !empty( $import['header_bg_no_color'] ) ) ? 1 : 0,
		'header_bg_color' => 'FFFFFF',
		'header_bg_image' => '',
		'title_font_size' => '34',
		'title_font_color' => '333333',
		'title_font_css' => '',
		'title_link_color' => 'D54E21',
		'title_link_underline' => 'Never',
		'tagline_font_size' => '16',
		'tagline_font_color' => '888888',
		'tagline_font_css' => '',
		'header_border_type' => 'Bottom',
		'header_border_thickness' => '0',
		'header_border_style' => 'solid',
		'header_border_color' => 'E8E8E8',
		'nav1_font_size' => '14',
		'nav1_font_css' => '',
		'nav1_link_underline' => 'Never',
		'nav1_page_font_color' => '333333',
		'nav1_page_hover_font_color' => '333333',
		'nav1_page_active_font_color' => '333333',
		'nav1_sub_page_font_color' => '333333',
		'nav1_sub_page_hover_font_color' => '333333',
		'nav1_right_font_size' => '14',
		'nav1_right_font_color' => '333333',
		'nav1_right_font_css' => '',
		'nav1_right_link_color' => '21759B',
		'nav1_right_link_hover_color' => 'D54E21',
		'nav1_right_link_underline' => 'On Hover',
		'nav1_bg_type' => 'color',
		'nav1_bg_no_color' => ( !$defaults && !empty( $import['nav1_bg_no_color'] ) ) ? 1 : 0,
		'nav1_bg_color' => 'FAFAFA',
		'nav1_bg_image' => '',
		'nav1_page_bg_type' => 'color',
		'nav1_page_bg_no_color' => ( !$defaults && !empty( $import['nav1_page_bg_no_color'] ) ) ? 1 : 0,
		'nav1_page_bg_color' => 'FAFAFA',
		'nav1_page_bg_image' => '',
		'nav1_page_hover_bg_type' => 'color',
		'nav1_page_hover_bg_no_color' => ( !$defaults && !empty( $import['nav1_page_hover_bg_no_color'] ) ) ? 1 : 0,
		'nav1_page_hover_bg_color' => 'FFFFFF',
		'nav1_page_hover_bg_image' => '',
		'nav1_page_active_bg_type' => 'color',
		'nav1_page_active_bg_no_color' => ( !$defaults && !empty( $import['nav1_page_active_bg_no_color'] ) ) ? 1 : 0,
		'nav1_page_active_bg_color' => 'FFFFFF',
		'nav1_page_active_bg_image' => '',
		'nav1_sub_page_bg_type' => 'color',
		'nav1_sub_page_bg_no_color' => ( !$defaults && !empty( $import['nav1_sub_page_bg_no_color'] ) ) ? 1 : 0,
		'nav1_sub_page_bg_color' => 'FAFAFA',
		'nav1_sub_page_bg_image' => '',
		'nav1_sub_page_hover_bg_type' => 'color',
		'nav1_sub_page_hover_bg_no_color' => ( !$defaults && !empty( $import['nav1_sub_page_hover_bg_no_color'] ) ) ? 1 : 0,
		'nav1_sub_page_hover_bg_color' => 'FFFFFF',
		'nav1_sub_page_hover_bg_image' => '',
		'nav1_border_type' => 'Top/Bottom',
		'nav1_border_thickness' => '1',
		'nav1_border_style' => 'solid',
		'nav1_border_color' => 'E8E8E8',
		'nav1_page_top_border_thickness' => '0',
		'nav1_page_bottom_border_thickness' => '0',
		'nav1_page_left_border_thickness' => '0',
		'nav1_page_right_border_thickness' => '0',
		'nav1_page_border_style' => 'solid',
		'nav1_page_border_color' => 'E8E8E8',
		'nav1_page_hover_border_color' => 'E8E8E8',
		'nav1_page_active_border_color' => 'E8E8E8',
		'nav1_location' => 'Below Header',
		'nav1_wrap_top_margin' => '0',
		'nav1_wrap_bottom_margin' => '0',
		'nav1_page_left_margin' => '0',
		'nav1_page_right_margin' => '0',
		'nav1_page_tb_padding' => '11',
		'nav1_page_lr_padding' => '15',
		'nav1_right_text_padding_top' => '10',
		'nav1_right_text_padding_right' => '10',
		'nav1_right_search_padding_top' => '4',
		'nav1_right_search_padding_right' => '4',
		'nav1_submenu_border_color' => 'E8E8E8',
		'nav1_submenu_width' => '150',
		'nav1_submenu_tb_padding' => '11',
		'nav1_submenu_lr_padding' => '10',
		'nav1_sub_indicator_type' => 'Text',
		'nav1_sub_indicator_image' => '',
		'nav1_sub_indicator_width' => '16',
		'nav1_sub_indicator_height' => '16',
		'nav1_sub_indicator_top' => '11',
		'nav1_sub_indicator_right' => '8',
		'nav2_font_size' => '14',
		'nav2_font_css' => '',
		'nav2_link_underline' => 'Never',
		'nav2_page_font_color' => '333333',
		'nav2_page_hover_font_color' => '333333',
		'nav2_page_active_font_color' => '333333',
		'nav2_sub_page_font_color' => '333333',
		'nav2_sub_page_hover_font_color' => '333333',
		'nav2_right_font_size' => '14',
		'nav2_right_font_color' => '333333',
		'nav2_right_font_css' => '',
		'nav2_right_link_color' => '21759B',
		'nav2_right_link_hover_color' => 'D54E21',
		'nav2_right_link_underline' => 'On Hover',
		'nav2_bg_type' => 'color',
		'nav2_bg_no_color' => ( !$defaults && !empty( $import['nav2_bg_no_color'] ) ) ? 1 : 0,
		'nav2_bg_color' => 'FFFFFF',
		'nav2_bg_image' => '',
		'nav2_page_bg_type' => 'color',
		'nav2_page_bg_no_color' => ( !$defaults && !empty( $import['nav2_page_bg_no_color'] ) ) ? 1 : 0,
		'nav2_page_bg_color' => 'FFFFFF',
		'nav2_page_bg_image' => '',
		'nav2_page_hover_bg_type' => 'color',
		'nav2_page_hover_bg_no_color' => ( !$defaults && !empty( $import['nav2_page_hover_bg_no_color'] ) ) ? 1 : 0,
		'nav2_page_hover_bg_color' => 'FAFAFA',
		'nav2_page_hover_bg_image' => '',
		'nav2_page_active_bg_type' => 'color',
		'nav2_page_active_bg_no_color' => ( !$defaults && !empty( $import['nav2_page_active_bg_no_color'] ) ) ? 1 : 0,
		'nav2_page_active_bg_color' => 'FAFAFA',
		'nav2_page_active_bg_image' => '',
		'nav2_sub_page_bg_type' => 'color',
		'nav2_sub_page_bg_no_color' => ( !$defaults && !empty( $import['nav2_sub_page_bg_no_color'] ) ) ? 1 : 0,
		'nav2_sub_page_bg_color' => 'FFFFFF',
		'nav2_sub_page_bg_image' => '',
		'nav2_sub_page_hover_bg_type' => 'color',
		'nav2_sub_page_hover_bg_no_color' => ( !$defaults && !empty( $import['nav2_sub_page_hover_bg_no_color'] ) ) ? 1 : 0,
		'nav2_sub_page_hover_bg_color' => 'FAFAFA',
		'nav2_sub_page_hover_bg_image' => '',
		'nav2_border_type' => 'Bottom',
		'nav2_border_thickness' => '1',
		'nav2_border_style' => 'solid',
		'nav2_border_color' => 'E8E8E8',
		'nav2_page_top_border_thickness' => '0',
		'nav2_page_bottom_border_thickness' => '0',
		'nav2_page_left_border_thickness' => '0',
		'nav2_page_right_border_thickness' => '0',
		'nav2_page_border_style' => 'solid',
		'nav2_page_border_color' => 'E8E8E8',
		'nav2_page_hover_border_color' => 'E8E8E8',
		'nav2_page_active_border_color' => 'E8E8E8',
		'nav2_location' => 'Below Header',
		'nav2_wrap_top_margin' => '0',
		'nav2_wrap_bottom_margin' => '0',
		'nav2_page_left_margin' => '0',
		'nav2_page_right_margin' => '0',
		'nav2_page_tb_padding' => '11',
		'nav2_page_lr_padding' => '15',
		'nav2_right_text_padding_top' => '10',
		'nav2_right_text_padding_right' => '10',
		'nav2_right_search_padding_top' => '4',
		'nav2_right_search_padding_right' => '4',
		'nav2_submenu_border_color' => 'E8E8E8',
		'nav2_submenu_width' => '150',
		'nav2_submenu_tb_padding' => '11',
		'nav2_submenu_lr_padding' => '10',
		'nav2_sub_indicator_type' => 'Text',
		'nav2_sub_indicator_image' => '',
		'nav2_sub_indicator_width' => '16',
		'nav2_sub_indicator_height' => '16',
		'nav2_sub_indicator_top' => '11',
		'nav2_sub_indicator_right' => '8',
		'double_sb_custom_layout_cc_width' => '440',
		'double_sb_custom_layout_sb1_width' => '280',
		'double_sb_custom_layout_sb2_width' => '160',
		'single_sb_custom_layout_cc_width' => '620',
		'single_sb_custom_layout_sb1_width' => '280',
		'no_sb_custom_layout_cc_width' => '920',
		'cc_width' => '440',
		'sb1_width' => '280',
		'sb2_width' => '160',
		'content_heading_font_css' => '',
		'content_heading_h1_font_size' => '22',
		'content_heading_h2_font_size' => '22',
		'content_heading_h3_font_size' => '20',
		'content_heading_h4_font_size' => '18',
		'content_heading_h5_font_size' => '16',
		'content_heading_h6_font_size' => '14',
		'content_heading_h1_font_color' => '333333',
		'content_heading_h2_font_color' => '333333',
		'content_heading_h3_font_color' => '333333',
		'content_heading_h4_font_color' => '333333',
		'content_heading_h5_font_color' => '333333',
		'content_heading_h6_font_color' => '333333',
		'content_heading_h2_link_color' => '333333',
		'content_heading_h2_hover_color' => 'D54E21',
		'content_heading_h2_link_underline' => 'Never',
		'content_byline_font_size' => '12',
		'content_byline_font_color' => '888888',
		'content_byline_font_css' => '',
		'content_byline_link_color' => '888888',
		'content_byline_link_hover_color' => '888888',
		'content_byline_link_underline' => 'On Hover',
		'content_p_font_size' => '14',
		'content_p_font_color' => '111111',
		'content_p_font_css' => '',
		'content_p_link_color' => '21759B',
		'content_p_link_hover_color' => 'D54E21',
		'content_p_link_underline' => 'On Hover',
		'blockquote_font_size' => '14',
		'blockquote_font_color' => '111111',
		'blockquote_font_css' => '',
		'blockquote_link_color' => '21759B',
		'blockquote_link_hover_color' => 'D54E21',
		'blockquote_link_underline' => 'On Hover',
		'caption_font_size' => '12',
		'caption_font_color' => '111111',
		'caption_font_css' => '',
		'post_meta_font_size' => '14',
		'post_meta_font_color' => '333333',
		'post_meta_font_css' => '',
		'post_meta_link_color' => '21759B',
		'post_meta_link_hover_color' => 'D54E21',
		'post_meta_link_underline' => 'On Hover',
		'content_list_style' => 'square',
		'post_content_bg_type' => 'color',
		'post_content_bg_no_color' => ( !$defaults && !empty( $import['post_content_bg_no_color'] ) ) ? 1 : 0,
		'post_content_bg_color' => 'FFFFFF',
		'post_content_bg_image' => '',
		'page_content_bg_type' => 'color',
		'page_content_bg_no_color' => ( !$defaults && !empty( $import['page_content_bg_no_color'] ) ) ? 1 : 0,
		'page_content_bg_color' => 'FFFFFF',
		'page_content_bg_image' => '',
		'sticky_post_bg_type' => 'color',
		'sticky_post_bg_no_color' => ( !$defaults && !empty( $import['sticky_post_bg_no_color'] ) ) ? 1 : 0,
		'sticky_post_bg_color' => 'FAFAFA',
		'sticky_post_bg_image' => '',
		'blockquote_bg_type' => 'color',
		'blockquote_bg_no_color' => ( !$defaults && !empty( $import['blockquote_bg_no_color'] ) ) ? 1 : 0,
		'blockquote_bg_color' => 'FAFAFA',
		'blockquote_bg_image' => '',
		'caption_bg_type' => 'color',
		'caption_bg_no_color' => ( !$defaults && !empty( $import['caption_bg_no_color'] ) ) ? 1 : 0,
		'caption_bg_color' => 'FAFAFA',
		'caption_bg_image' => '',
		'thumbnail_bg_type' => 'color',
		'thumbnail_bg_no_color' => ( !$defaults && !empty( $import['thumbnail_bg_no_color'] ) ) ? 1 : 0,
		'thumbnail_bg_color' => 'FAFAFA',
		'thumbnail_bg_image' => '',
		'post_content_border_type' => 'Full',
		'post_content_border_thickness' => '0',
		'post_content_border_style' => 'solid',
		'post_content_border_color' => 'E8E8E8',
		'page_content_border_type' => 'Full',
		'page_content_border_thickness' => '0',
		'page_content_border_style' => 'solid',
		'page_content_border_color' => 'E8E8E8',
		'sticky_post_border_type' => 'Top/Bottom',
		'sticky_post_border_thickness' => '1',
		'sticky_post_border_style' => 'solid',
		'sticky_post_border_color' => 'E8E8E8',
		'thumbnail_border_thickness' => '1',
		'thumbnail_border_style' => 'solid',
		'thumbnail_border_color' => 'E8E8E8',
		'thumbnail_image_padding' => '4',
		'blockquote_border_type' => 'Top/Bottom',
		'blockquote_border_thickness' => '1',
		'blockquote_border_style' => 'solid',
		'blockquote_border_color' => 'E8E8E8',
		'caption_border_thickness' => '1',
		'caption_border_style' => 'solid',
		'caption_border_color' => 'E8E8E8',
		'cc_bottom_border_thickness' => '1',
		'cc_bottom_border_style' => 'solid',
		'cc_bottom_border_color' => 'E8E8E8',
		'content_wrap_padding_top' => '0',
		'content_wrap_padding_bottom' => '0',
		'post_content_margin_top' => '0',
		'post_content_margin_bottom' => '20',
		'post_content_padding_top' => '0',
		'post_content_padding_right' => '0',
		'post_content_padding_bottom' => '0',
		'post_content_padding_left' => '0',
		'page_content_margin_top' => '0',
		'page_content_margin_bottom' => '20',
		'page_content_padding_top' => '0',
		'page_content_padding_right' => '0',
		'page_content_padding_bottom' => '0',
		'page_content_padding_left' => '0',
		'sticky_post_margin_top' => '0',
		'sticky_post_margin_bottom' => '30',
		'sticky_post_padding_top' => '10',
		'sticky_post_padding_right' => '10',
		'sticky_post_padding_bottom' => '10',
		'sticky_post_padding_left' => '10',
		'content_paragraph_padding_bottom' => '20',
		'content_list_style_padding_bottom' => '0',
		'hybrid_column_excerpt_width' => '',
		'comment_heading_font_size' => '18',
		'comment_heading_font_color' => '333333',
		'comment_heading_font_css' => '',
		'comment_author_font_size' => '13',
		'comment_author_font_color' => '111111',
		'comment_author_font_css' => '',
		'comment_meta_font_size' => '12',
		'comment_meta_link_color' => '21759B',
		'comment_meta_link_hover_color' => 'D54E21',
		'comment_meta_link_underline' => 'On Hover',
		'comment_meta_font_css' => '',
		'comment_body_font_size' => '13',
		'comment_body_font_color' => '111111',
		'comment_body_font_css' => '',
		'comment_form_font_size' => '13',
		'comment_form_font_color' => '111111',
		'comment_form_font_css' => '',
		'comment_link_color' => '21759B',
		'comment_link_hover_color' => 'D54E21',
		'comment_link_underline' => 'On Hover',
		'comment_submit_font_size' => '13',
		'comment_submit_font_color' => '111111',
		'comment_submit_font_css' => '',
		'submit_text_hover_color' => '111111',
		'submit_text_hover_underline' => 'Never',
		'comment_wrap_bg_type' => 'color',
		'comment_wrap_bg_no_color' => ( !$defaults && !empty( $import['comment_wrap_bg_no_color'] ) ) ? 1 : 0,
		'comment_wrap_bg_color' => 'FFFFFF',
		'comment_wrap_bg_image' => '',
		'comment_even_bg_type' => 'color',
		'comment_even_bg_no_color' => ( !$defaults && !empty( $import['comment_even_bg_no_color'] ) ) ? 1 : 0,
		'comment_even_bg_color' => 'FFFFFF',
		'comment_even_bg_image' => '',
		'comment_odd_bg_type' => 'color',
		'comment_odd_bg_no_color' => ( !$defaults && !empty( $import['comment_odd_bg_no_color'] ) ) ? 1 : 0,
		'comment_odd_bg_color' => 'FFFFFF',
		'comment_odd_bg_image' => '',
		'comment_reply_bg_type' => 'color',
		'comment_reply_bg_no_color' => ( !$defaults && !empty( $import['comment_reply_bg_no_color'] ) ) ? 1 : 0,
		'comment_reply_bg_color' => 'FAFAFA',
		'comment_reply_bg_image' => '',
		'comment_avatar_bg_type' => 'color',
		'comment_avatar_bg_no_color' => ( !$defaults && !empty( $import['comment_avatar_bg_no_color'] ) ) ? 1 : 0,
		'comment_avatar_bg_color' => 'FFFFFF',
		'comment_avatar_bg_image' => '',
		'comment_form_bg_type' => 'color',
		'comment_form_bg_no_color' => ( !$defaults && !empty( $import['comment_form_bg_no_color'] ) ) ? 1 : 0,
		'comment_form_bg_color' => 'FAFAFA',
		'comment_form_bg_image' => '',
		'comment_submit_bg_type' => 'color',
		'comment_submit_bg_no_color' => ( !$defaults && !empty( $import['comment_submit_bg_no_color'] ) ) ? 1 : 0,
		'comment_submit_bg_color' => 'FAFAFA',
		'comment_submit_bg_image' => '',
		'comment_submit_hover_bg_type' => 'color',
		'comment_submit_hover_bg_no_color' => ( !$defaults && !empty( $import['comment_submit_bg_no_color'] ) ) ? 1 : 0,
		'comment_submit_hover_bg_color' => 'FFFFFF',
		'comment_submit_hover_bg_image' => '',
		'comment_wrap_border_thickness' => '0',
		'comment_wrap_border_style' => 'solid',
		'comment_wrap_border_color' => 'E8E8E8',
		'comment_body_border_type' => 'Top/Bottom',
		'comment_body_border_thickness' => '1',
		'comment_body_border_style' => 'solid',
		'comment_body_border_color' => 'E8E8E8',
		'comment_avatar_border_thickness' => '1',
		'comment_avatar_border_style' => 'solid',
		'comment_avatar_border_color' => 'E8E8E8',
		'comment_avatar_padding' => '4',
		'comment_form_border_thickness' => '1',
		'comment_form_border_style' => 'solid',
		'comment_form_border_color' => 'E8E8E8',
		'comment_submit_border_thickness' => '1',
		'comment_submit_border_style' => 'solid',
		'comment_submit_border_color' => 'E8E8E8',
		'comment_submit_hover_border_thickness' => '1',
		'comment_submit_hover_border_style' => 'solid',
		'comment_submit_hover_border_color' => 'E8E8E8',
		'comment_author_email_url_width' => '200',
		'comment_avatar_size' => '60',
		'comment_form_width' => '',
		'comment_submit_width' => '110',
		'comment_wrap_margin_top' => '0',
		'comment_wrap_margin_bottom' => '0',
		'comment_wrap_padding_top' => '0',
		'comment_wrap_padding_right' => '0',
		'comment_wrap_padding_bottom' => '0',
		'comment_wrap_padding_left' => '0',
		'comment_list_margin_top' => '15',
		'comment_list_margin_bottom' => '10',
		'comment_list_padding_top' => '10',
		'comment_list_padding_right' => '5',
		'comment_list_padding_bottom' => '10',
		'comment_list_padding_left' => '10',
		'submit_button_padding_top' => '3',
		'submit_button_padding_right' => '3',
		'submit_button_padding_bottom' => '3',
		'submit_button_padding_left' => '3',
		'comments_nav_margin_top' => '10',
		'comments_nav_margin_bottom' => '40',
		'sb_heading_font_size' => '13',
		'sb_heading_font_color' => '333333',
		'sb_heading_font_css' => '',
		'sb_content_font_size' => '14',
		'sb_content_font_color' => '111111',
		'sb_content_font_css' => '',
		'sb_content_link_color' => '21759B',
		'sb_content_link_hover_color' => 'D54E21',
		'sb_content_link_underline' => 'On Hover',
		'sb_pages_font_size' => '14',
		'sb_pages_font_color' => '111111',
		'sb_pages_heading_display' => ( $defaults || !empty( $import['sb_pages_heading_display'] ) ) ? 1 : 0,
		'sb_pages_font_css' => '',
		'sb_pages_link_color' => '21759B',
		'sb_pages_link_hover_color' => 'D54E21',
		'sb_pages_link_underline' => 'On Hover',
		'sb_list_style' => 'square',
		'sb_heading_bg_type' => 'color',
		'sb_heading_bg_no_color' => ( !$defaults && !empty( $import['sb_heading_bg_no_color'] ) ) ? 1 : 0,
		'sb_heading_bg_color' => 'FAFAFA',
		'sb_heading_bg_image' => '',
		'sb_content_bg_type' => 'color',
		'sb_content_bg_no_color' => ( !$defaults && !empty( $import['sb_content_bg_no_color'] ) ) ? 1 : 0,
		'sb_content_bg_color' => 'FFFFFF',
		'sb_content_bg_image' => '',
		'sb_heading_border_type' => 'Top/Bottom',
		'sb_heading_border_thickness' => '1',
		'sb_heading_border_style' => 'solid',
		'sb_heading_border_color' => 'E8E8E8',
		'sb_content_border_type' => 'Full',
		'sb_content_border_thickness' => '0',
		'sb_content_border_style' => 'solid',
		'sb_content_border_color' => 'E8E8E8',
		'sb_widget_margin_top' => '0',
		'sb_widget_margin_bottom' => '15',
		'sb_heading_padding_top' => '4',
		'sb_heading_padding_right' => '5',
		'sb_heading_padding_bottom' => '4',
		'sb_heading_padding_left' => '10',
		'sb_content_padding_top' => '10',
		'sb_content_padding_right' => '10',
		'sb_content_padding_bottom' => '10',
		'sb_content_padding_left' => '10',
		'sb_ul_padding_top' => '10',
		'sb_ul_padding_right' => '10',
		'sb_ul_padding_bottom' => '10',
		'sb_ul_padding_left' => '25',
		'sb_search_form_padding_right' => '10',
		'sb_search_form_padding_left' => '10',
		'footer_font_size' => '14',
		'footer_font_color' => '888888',
		'footer_font_css' => '',
		'footer_link_color' => '888888',
		'footer_link_hover_color' => '555555',
		'footer_link_underline' => 'Never',
		'footer_bg_type' => 'color',
		'footer_bg_no_color' => ( !$defaults && !empty( $import['footer_bg_no_color'] ) ) ? 1 : 0,
		'footer_bg_color' => 'FAFAFA',
		'footer_bg_image' => '',
		'footer_border_type' => 'Top',
		'footer_border_thickness' => '1',
		'footer_border_style' => 'solid',
		'footer_border_color' => 'E8E8E8',
		'footer_height' => '',
		'footer_padding_top' => '10',
		'footer_padding_bottom' => '10',
		'footer_left_padding_top' => '0',
		'footer_left_padding_right' => '20',
		'footer_left_padding_bottom' => '0',
		'footer_left_padding_left' => '20',
		'footer_right_padding_top' => '0',
		'footer_right_padding_right' => '20',
		'footer_right_padding_bottom' => '0',
		'footer_right_padding_left' => '20',
		'footer_center_padding_top' => '0',
		'footer_center_padding_right' => '0',
		'footer_center_padding_bottom' => '0',
		'footer_center_padding_left' => '0',
		'dynamik_homepage_type' => 'default_home',
		'ez_homepage_select' => 'ez_home_3_3_3.php',
		'ez_widget_home_title_font_size' => '18',
		'ez_widget_home_title_font_color' => '111111',
		'ez_widget_home_title_font_css' => '',
		'ez_widget_home_content_font_size' => '14',
		'ez_widget_home_content_font_color' => '111111',
		'ez_widget_home_content_font_css' => '',
		'ez_widget_home_content_link_color' => '21759B',
		'ez_widget_home_content_link_hover_color' => 'D54E21',
		'ez_widget_home_content_link_underline' => 'On Hover',
		'ez_widget_home_bg_type' => 'color',
		'ez_widget_home_bg_no_color' => ( !$defaults && !empty( $import['ez_widget_home_bg_no_color'] ) ) ? 1 : 0,
		'ez_widget_home_bg_color' => 'FFFFFF',
		'ez_widget_home_bg_image' => '',
		'ez_widget_home_heading_bottom_border_thickness' => '1',
		'ez_widget_home_heading_bottom_border_style' => 'solid',
		'ez_widget_home_heading_bottom_border_color' => 'E8E8E8',
		'ez_widget_home_border_type' => 'Full',
		'ez_widget_home_border_thickness' => '0',
		'ez_widget_home_border_style' => 'solid',
		'ez_widget_home_border_color' => 'E8E8E8',
		'ez_widget_home_padding_top' => '20',
		'ez_widget_home_padding_right' => '20',
		'ez_widget_home_padding_bottom' => '20',
		'ez_widget_home_padding_left' => '20',
		'ez_static_home_sb_display' => '0',
		'ez_static_home_sb_location' => 'right',
		'ez_home_slider_display' => '0',
		'ez_home_slider_location' => 'outside',
		'ez_home_slider_height' => '300',
		'ez_feature_top_display_front_page' => '0',
		'ez_feature_top_display_posts' => '0',
		'ez_feature_top_display_pages' => '0',
		'ez_feature_top_display_archives' => '0',
		'ez_feature_top_display_blog' => '0',
		'ez_feature_top_display_blank_content' => '0',
		'ez_feature_top_position' => 'inside_wrap',
		'ez_feature_top_select' => 'ez_feature_top_3.php',
		'ez_widget_feature_title_font_size' => '18',
		'ez_widget_feature_title_font_color' => '111111',
		'ez_widget_feature_title_font_css' => '',
		'ez_widget_feature_content_font_size' => '14',
		'ez_widget_feature_content_font_color' => '111111',
		'ez_widget_feature_content_font_css' => '',
		'ez_widget_feature_content_link_color' => '21759B',
		'ez_widget_feature_content_link_hover_color' => 'D54E21',
		'ez_widget_feature_content_link_underline' => 'On Hover',
		'ez_widget_feature_bg_type' => 'color',
		'ez_widget_feature_bg_no_color' => ( !$defaults && !empty( $import['ez_widget_feature_bg_no_color'] ) ) ? 1 : 0,
		'ez_widget_feature_bg_color' => 'FFFFFF',
		'ez_widget_feature_bg_image' => '',
		'ez_widget_feature_heading_bottom_border_thickness' => '1',
		'ez_widget_feature_heading_bottom_border_style' => 'solid',
		'ez_widget_feature_heading_bottom_border_color' => 'E8E8E8',
		'ez_widget_feature_border_type' => 'Bottom',
		'ez_widget_feature_border_thickness' => '1',
		'ez_widget_feature_border_style' => 'solid',
		'ez_widget_feature_border_color' => 'E8E8E8',
		'ez_widget_feature_padding_top' => '20',
		'ez_widget_feature_padding_right' => '20',
		'ez_widget_feature_padding_bottom' => '20',
		'ez_widget_feature_padding_left' => '20',
		'ez_fat_footer_display_front_page' => '0',
		'ez_fat_footer_display_posts' => '0',
		'ez_fat_footer_display_pages' => '0',
		'ez_fat_footer_display_archives' => '0',
		'ez_fat_footer_display_blog' => '0',
		'ez_fat_footer_display_blank_content' => '0',
		'ez_fat_footer_position' => 'inside_footer',
		'ez_fat_footer_select' => 'ez_fat_footer_3.php',
		'ez_widget_footer_title_font_size' => '18',
		'ez_widget_footer_title_font_color' => '111111',
		'ez_widget_footer_title_font_css' => '',
		'ez_widget_footer_content_font_size' => '14',
		'ez_widget_footer_content_font_color' => '111111',
		'ez_widget_footer_content_font_css' => '',
		'ez_widget_footer_content_link_color' => '21759B',
		'ez_widget_footer_content_link_hover_color' => 'D54E21',
		'ez_widget_footer_content_link_underline' => 'On Hover',
		'ez_widget_footer_bg_type' => 'color',
		'ez_widget_footer_bg_no_color' => ( !$defaults && !empty( $import['ez_widget_footer_bg_no_color'] ) ) ? 1 : 0,
		'ez_widget_footer_bg_color' => 'FAFAFA',
		'ez_widget_footer_bg_image' => '',
		'ez_widget_footer_heading_bottom_border_thickness' => '1',
		'ez_widget_footer_heading_bottom_border_style' => 'solid',
		'ez_widget_footer_heading_bottom_border_color' => 'E8E8E8',
		'ez_widget_footer_border_type' => 'Bottom',
		'ez_widget_footer_border_thickness' => '1',
		'ez_widget_footer_border_style' => 'solid',
		'ez_widget_footer_border_color' => 'E8E8E8',
		'ez_widget_footer_padding_top' => '15',
		'ez_widget_footer_padding_right' => '20',
		'ez_widget_footer_padding_bottom' => '20',
		'ez_widget_footer_padding_left' => '20',
		'catalyst_widget_title_font_size' => '18',
		'catalyst_widget_title_font_color' => '111111',
		'catalyst_widget_title_font_css' => '',
		'catalyst_widget_content_font_size' => '14',
		'catalyst_widget_content_font_color' => '111111',
		'catalyst_widget_content_font_css' => '',
		'catalyst_widget_content_link_color' => '21759B',
		'catalyst_widget_content_link_hover_color' => 'D54E21',
		'catalyst_widget_content_link_underline' => 'On Hover',
		'catalyst_widget_bg_type' => 'color',
		'catalyst_widget_bg_no_color' => ( !$defaults && !empty( $import['catalyst_widget_bg_no_color'] ) ) ? 1 : 0,
		'catalyst_widget_bg_color' => 'FFFFFF',
		'catalyst_widget_bg_image' => '',
		'catalyst_widget_border_type' => 'Full',
		'catalyst_widget_border_thickness' => '0',
		'catalyst_widget_border_style' => 'solid',
		'catalyst_widget_border_color' => 'E8E8E8',
		'catalyst_widget_width' => '',
		'catalyst_widget_width_type' => 'No Set Width',
		'catalyst_widget_float' => 'none',
		'catalyst_widget_margin_top' => '0',
		'catalyst_widget_margin_right' => '0',
		'catalyst_widget_margin_bottom' => '0',
		'catalyst_widget_margin_left' => '0',
		'catalyst_widget_padding_top' => '0',
		'catalyst_widget_padding_right' => '0',
		'catalyst_widget_padding_bottom' => '0',
		'catalyst_widget_padding_left' => '0',
		'excerpt_widget_heading_font_size' => '18',
		'excerpt_widget_heading_font_css' => '',
		'excerpt_widget_heading_link_color' => '333333',
		'excerpt_widget_heading_link_hover_color' => 'D54E21',
		'excerpt_widget_heading_link_underline' => 'Never',
		'excerpt_widget_byline_font_size' => '12',
		'excerpt_widget_byline_font_color' => '888888',
		'excerpt_widget_byline_font_css' => '',
		'excerpt_widget_byline_link_color' => '888888',
		'excerpt_widget_byline_link_hover_color' => '888888',
		'excerpt_widget_byline_link_underline' => 'On Hover',
		'excerpt_widget_p_font_size' => '14',
		'excerpt_widget_p_font_color' => '111111',
		'excerpt_widget_p_font_css' => '',
		'excerpt_widget_p_link_color' => '21759B',
		'excerpt_widget_p_link_hover_color' => 'D54E21',
		'excerpt_widget_p_link_underline' => 'On Hover',
		'excerpt_widget_margin_top' => '0',
		'excerpt_widget_margin_right' => '0',
		'excerpt_widget_margin_bottom' => '0',
		'excerpt_widget_margin_left' => '0',
		'excerpt_widget_padding_top' => '0',
		'excerpt_widget_padding_right' => '0',
		'excerpt_widget_padding_bottom' => '0',
		'excerpt_widget_padding_left' => '0',
		'search_form_font_size' => '12',
		'search_form_font_color' => 'AAAAAA',
		'search_form_font_css' => '',
		'search_button_font_size' => '12',
		'search_button_font_color' => '888888',
		'search_button_font_css' => '',
		'search_form_bg_type' => 'color',
		'search_form_bg_no_color' => ( !$defaults && !empty( $import['search_form_bg_no_color'] ) ) ? 1 : 0,
		'search_form_bg_color' => 'FFFFFF',
		'search_form_bg_image' => '',
		'search_button_bg_type' => 'color',
		'search_button_bg_no_color' => ( !$defaults && !empty( $import['search_button_bg_no_color'] ) ) ? 1 : 0,
		'search_button_bg_color' => 'FAFAFA',
		'search_button_bg_image' => '',
		'search_button_hover_bg_type' => 'color',
		'search_button_hover_bg_no_color' => ( !$defaults && !empty( $import['search_button_hover_bg_no_color'] ) ) ? 1 : 0,
		'search_button_hover_bg_color' => 'FFFFFF',
		'search_button_hover_bg_image' => '',
		'search_form_border_thickness' => '1',
		'search_form_border_style' => 'solid',
		'search_form_border_color' => 'E8E8E8',
		'search_button_border_thickness' => '1',
		'search_button_border_style' => 'solid',
		'search_button_border_color' => 'E8E8E8',
		'search_button_hover_border_thickness' => '1',
		'search_button_hover_border_style' => 'solid',
		'search_button_hover_border_color' => 'E8E8E8',
		'search_form_width' => '130',
		'search_form_padding_top' => '6',
		'search_form_padding_right' => '0',
		'search_form_padding_bottom' => '5',
		'search_form_padding_left' => '6',
		'search_button_padding_top' => '6',
		'search_button_padding_right' => '6',
		'search_button_padding_bottom' => '5',
		'search_button_padding_left' => '6',
		'breadcrumbs_font_size' => '13',
		'breadcrumbs_font_color' => '111111',
		'breadcrumbs_font_css' => '',
		'breadcrumbs_link_color' => '21759B',
		'breadcrumbs_link_hover_color' => 'D54E21',
		'breadcrumbs_link_underline' => 'On Hover',
		'breadcrumbs_bg_type' => 'color',
		'breadcrumbs_bg_no_color' => ( !$defaults && !empty( $import['breadcrumbs_bg_no_color'] ) ) ? 1 : 0,
		'breadcrumbs_bg_color' => 'FFFFFF',
		'breadcrumbs_bg_image' => '',
		'breadcrumbs_border_type' => 'Top/Bottom',
		'breadcrumbs_border_thickness' => '1',
		'breadcrumbs_border_style' => 'solid',
		'breadcrumbs_border_color' => 'E8E8E8',
		'breadcrumbs_margin_top' => '0',
		'breadcrumbs_margin_bottom' => '20',
		'breadcrumbs_padding_top' => '4',
		'breadcrumbs_padding_right' => '10',
		'breadcrumbs_padding_bottom' => '4',
		'breadcrumbs_padding_left' => '10',
		'author_info_title_font_size' => '14',
		'author_info_title_font_color' => '111111',
		'author_info_title_font_css' => '',
		'author_info_font_size' => '13',
		'author_info_font_color' => '111111',
		'author_info_font_css' => '',
		'author_info_link_color' => '21759B',
		'author_info_link_hover_color' => 'D54E21',
		'author_info_link_underline' => 'On Hover',
		'author_info_bg_type' => 'color',
		'author_info_bg_no_color' => ( !$defaults && !empty( $import['author_info_bg_no_color'] ) ) ? 1 : 0,
		'author_info_bg_color' => 'FAFAFA',
		'author_info_bg_image' => '',
		'author_avatar_bg_type' => 'color',
		'author_avatar_bg_no_color' => ( !$defaults && !empty( $import['author_avatar_bg_no_color'] ) ) ? 1 : 0,
		'author_avatar_bg_color' => 'FFFFFF',
		'author_avatar_bg_image' => '',
		'author_info_border_type' => 'Top/Bottom',
		'author_info_border_thickness' => '1',
		'author_info_border_style' => 'solid',
		'author_info_border_color' => 'E8E8E8',
		'author_avatar_border_thickness' => '1',
		'author_avatar_border_style' => 'solid',
		'author_avatar_border_color' => 'E8E8E8',
		'author_avatar_size' => '80',
		'author_avatar_padding' => '5',
		'author_info_margin_top' => '20',
		'author_info_margin_bottom' => '30',
		'author_info_padding_top' => '10',
		'author_info_padding_right' => '10',
		'author_info_padding_bottom' => '10',
		'author_info_padding_left' => '10',
		'post_nav_font_size' => '14',
		'post_nav_font_css' => '',
		'post_nav_link_color' => '21759B',
		'post_nav_link_hover_color' => 'D54E21',
		'post_nav_link_underline' => 'On Hover',
		'post_nav_numbered_inactive_bg_type' => 'color',
		'post_nav_numbered_inactive_bg_no_color' => ( !$defaults && !empty( $import['post_nav_numbered_inactive_bg_no_color'] ) ) ? 1 : 0,
		'post_nav_numbered_inactive_bg_color' => 'FFFFFF',
		'post_nav_numbered_inactive_bg_image' => '',
		'post_nav_numbered_active_bg_type' => 'color',
		'post_nav_numbered_active_bg_no_color' => ( !$defaults && !empty( $import['post_nav_numbered_active_bg_no_color'] ) ) ? 1 : 0,
		'post_nav_numbered_active_bg_color' => 'FAFAFA',
		'post_nav_numbered_active_bg_image' => '',
		'post_nav_border_thickness' => '1',
		'post_nav_border_style' => 'solid',
		'post_nav_border_color' => 'E8E8E8',
		'post_nav_padding_top' => '0',
		'post_nav_padding_bottom' => '0',
		'post_nav_numbered_margin_left' => '0',
		'post_nav_numbered_margin_right' => '0',
		'post_nav_numbered_tb_padding' => '6',
		'post_nav_numbered_lr_padding' => '10',
		'remove_elements' => '',
		'author_info_title_font_u' => ( $defaults || !empty( $import['author_info_title_font_u'] ) ) ? 'u' : 0,
		'author_info_font_u' => ( $defaults || !empty( $import['author_info_font_u'] ) ) ? 'u' : 0,
		'author_info_link_u' => ( $defaults || !empty( $import['author_info_link_u'] ) ) ? 'u' : 0,
		'post_nav_font_u' => ( $defaults || !empty( $import['post_nav_font_u'] ) ) ? 'u' : 0,
		'post_nav_link_u' => ( $defaults || !empty( $import['post_nav_link_u'] ) ) ? 'u' : 0,
		'breadcrumbs_font_u' => ( $defaults || !empty( $import['breadcrumbs_font_u'] ) ) ? 'u' : 0,
		'breadcrumbs_link_u' => ( $defaults || !empty( $import['breadcrumbs_link_u'] ) ) ? 'u' : 0,
		'comment_heading_font_u' => ( $defaults || !empty( $import['comment_heading_font_u'] ) ) ? 'u' : 0,
		'comment_author_font_u' => ( $defaults || !empty( $import['comment_author_font_u'] ) ) ? 'u' : 0,
		'comment_meta_font_u' => ( $defaults || !empty( $import['comment_meta_font_u'] ) ) ? 'u' : 0,
		'comment_meta_link_u' => ( $defaults || !empty( $import['comment_meta_link_u'] ) ) ? 'u' : 0,
		'comment_body_font_u' => ( $defaults || !empty( $import['comment_body_font_u'] ) ) ? 'u' : 0,
		'comment_form_font_u' => ( $defaults || !empty( $import['comment_form_font_u'] ) ) ? 'u' : 0,
		'comment_link_u' => ( $defaults || !empty( $import['comment_link_u'] ) ) ? 'u' : 0,
		'comment_submit_font_u' => ( $defaults || !empty( $import['comment_submit_font_u'] ) ) ? 'u' : 0,
		'comment_submit_text_hover_u' => ( $defaults || !empty( $import['comment_submit_text_hover_u'] ) ) ? 'u' : 0,
		'content_heading_font_u' => ( $defaults || !empty( $import['content_heading_font_u'] ) ) ? 'u' : 0,
		'content_heading_h1_h2_px_em_u' => ( $defaults || !empty( $import['content_heading_h1_h2_px_em_u'] ) ) ? 'u' : 0,
		'content_heading_h3_h6_px_em_u' => ( $defaults || !empty( $import['content_heading_h3_h6_px_em_u'] ) ) ? 'u' : 0,
		'content_heading_h1_h2_font_color_u' => ( $defaults || !empty( $import['content_heading_h1_h2_font_color_u'] ) ) ? 'u' : 0,
		'content_heading_h3_h6_font_color_u' => ( $defaults || !empty( $import['content_heading_h3_h6_font_color_u'] ) ) ? 'u' : 0,
		'content_heading_h2_link_u' => ( $defaults || !empty( $import['content_heading_h2_link_u'] ) ) ? 'u' : 0,
		'content_byline_font_u' => ( $defaults || !empty( $import['content_byline_font_u'] ) ) ? 'u' : 0,
		'content_byline_link_u' => ( $defaults || !empty( $import['content_byline_link_u'] ) ) ? 'u' : 0,
		'content_paragraph_font_u' => ( $defaults || !empty( $import['content_paragraph_font_u'] ) ) ? 'u' : 0,
		'content_paragraph_link_u' => ( $defaults || !empty( $import['content_paragraph_link_u'] ) ) ? 'u' : 0,
		'blockquote_font_u' => ( $defaults || !empty( $import['blockquote_font_u'] ) ) ? 'u' : 0,
		'blockquote_link_u' => ( $defaults || !empty( $import['blockquote_link_u'] ) ) ? 'u' : 0,
		'caption_font_u' => ( $defaults || !empty( $import['caption_font_u'] ) ) ? 'u' : 0,
		'post_meta_font_u' => ( $defaults || !empty( $import['post_meta_font_u'] ) ) ? 'u' : 0,
		'post_meta_link_u' => ( $defaults || !empty( $import['post_meta_link_u'] ) ) ? 'u' : 0,
		'ez_widget_home_title_font_u' => ( $defaults || !empty( $import['ez_widget_home_title_font_u'] ) ) ? 'u' : 0,
		'ez_widget_home_content_font_u' => ( $defaults || !empty( $import['ez_widget_home_content_font_u'] ) ) ? 'u' : 0,
		'ez_widget_home_content_link_u' => ( $defaults || !empty( $import['ez_widget_home_content_link_u'] ) ) ? 'u' : 0,
		'ez_widget_feature_title_font_u' => ( $defaults || !empty( $import['ez_widget_feature_title_font_u'] ) ) ? 'u' : 0,
		'ez_widget_feature_content_font_u' => ( $defaults || !empty( $import['ez_widget_feature_content_font_u'] ) ) ? 'u' : 0,
		'ez_widget_feature_content_link_u' => ( $defaults || !empty( $import['ez_widget_feature_content_link_u'] ) ) ? 'u' : 0,
		'ez_widget_footer_title_font_u' => ( $defaults || !empty( $import['ez_widget_footer_title_font_u'] ) ) ? 'u' : 0,
		'ez_widget_footer_content_font_u' => ( $defaults || !empty( $import['ez_widget_footer_content_font_u'] ) ) ? 'u' : 0,
		'ez_widget_footer_content_link_u' => ( $defaults || !empty( $import['ez_widget_footer_content_link_u'] ) ) ? 'u' : 0,
		'catalyst_widget_title_font_u' => ( $defaults || !empty( $import['catalyst_widget_title_font_u'] ) ) ? 'u' : 0,
		'catalyst_widget_content_font_u' => ( $defaults || !empty( $import['catalyst_widget_content_font_u'] ) ) ? 'u' : 0,
		'catalyst_widget_content_link_u' => ( $defaults || !empty( $import['catalyst_widget_content_link_u'] ) ) ? 'u' : 0,
		'excerpt_widget_heading_font_u' => ( $defaults || !empty( $import['excerpt_widget_heading_font_u'] ) ) ? 'u' : 0,
		'excerpt_widget_heading_link_u' => ( $defaults || !empty( $import['excerpt_widget_heading_link_u'] ) ) ? 'u' : 0,
		'excerpt_widget_byline_font_u' => ( $defaults || !empty( $import['excerpt_widget_byline_font_u'] ) ) ? 'u' : 0,
		'excerpt_widget_byline_link_u' => ( $defaults || !empty( $import['excerpt_widget_byline_link_u'] ) ) ? 'u' : 0,
		'excerpt_widget_p_font_u' => ( $defaults || !empty( $import['excerpt_widget_p_font_u'] ) ) ? 'u' : 0,
		'excerpt_widget_p_link_u' => ( $defaults || !empty( $import['excerpt_widget_p_link_u'] ) ) ? 'u' : 0,
		'search_form_font_u' => ( $defaults || !empty( $import['search_form_font_u'] ) ) ? 'u' : 0,
		'search_button_font_u' => ( $defaults || !empty( $import['search_button_font_u'] ) ) ? 'u' : 0,
		'footer_font_u' => ( $defaults || !empty( $import['footer_font_u'] ) ) ? 'u' : 0,
		'footer_link_u' => ( $defaults || !empty( $import['footer_link_u'] ) ) ? 'u' : 0,
		'title_font_u' => ( $defaults || !empty( $import['title_font_u'] ) ) ? 'u' : 0,
		'title_link_u' => ( $defaults || !empty( $import['title_link_u'] ) ) ? 'u' : 0,
		'tagline_font_u' => ( $defaults || !empty( $import['tagline_font_u'] ) ) ? 'u' : 0,
		'nav1_font_u' => ( $defaults || !empty( $import['nav1_font_u'] ) ) ? 'u' : 0,
		'nav1_page_font_u' => ( $defaults || !empty( $import['nav1_page_font_u'] ) ) ? 'u' : 0,
		'nav1_sub_page_font_u' => ( $defaults || !empty( $import['nav1_sub_page_font_u'] ) ) ? 'u' : 0,
		'nav1_right_font_u' => ( $defaults || !empty( $import['nav1_right_font_u'] ) ) ? 'u' : 0,
		'nav1_right_link_u' => ( $defaults || !empty( $import['nav1_right_link_u'] ) ) ? 'u' : 0,
		'nav2_font_u' => ( $defaults || !empty( $import['nav2_font_u'] ) ) ? 'u' : 0,
		'nav2_page_font_u' => ( $defaults || !empty( $import['nav2_page_font_u'] ) ) ? 'u' : 0,
		'nav2_sub_page_font_u' => ( $defaults || !empty( $import['nav2_sub_page_font_u'] ) ) ? 'u' : 0,
		'nav2_right_font_u' => ( $defaults || !empty( $import['nav2_right_font_u'] ) ) ? 'u' : 0,
		'nav2_right_link_u' => ( $defaults || !empty( $import['nav2_right_link_u'] ) ) ? 'u' : 0,
		'sb_heading_font_u' => ( $defaults || !empty( $import['sb_heading_font_u'] ) ) ? 'u' : 0,
		'sb_content_font_u' => ( $defaults || !empty( $import['sb_content_font_u'] ) ) ? 'u' : 0,
		'sb_content_link_u' => ( $defaults || !empty( $import['sb_content_link_u'] ) ) ? 'u' : 0,
		'sb_pages_font_u' => ( $defaults || !empty( $import['sb_pages_font_u'] ) ) ? 'u' : 0,
		'sb_pages_link_u' => ( $defaults || !empty( $import['sb_pages_link_u'] ) ) ? 'u' : 0,
		'universal_px_em' => 'px',
		'universal_heading_px_em' => 'px',
		'universal_content_px_em' => 'px',
		'author_info_title_px_em' => 'px',
		'author_info_px_em' => 'px',
		'post_nav_px_em' => 'px',
		'breadcrumbs_px_em' => 'px',
		'comment_heading_px_em' => 'px',
		'comment_author_px_em' => 'px',
		'comment_meta_px_em' => 'px',
		'comment_body_px_em' => 'px',
		'comment_form_px_em' => 'px',
		'comment_submit_px_em' => 'px',
		'h1_px_em' => 'px',
		'h2_px_em' => 'px',
		'h3_px_em' => 'px',
		'h4_px_em' => 'px',
		'h5_px_em' => 'px',
		'h6_px_em' => 'px',
		'content_byline_px_em' => 'px',
		'content_p_px_em' => 'px',
		'blockquote_px_em' => 'px',
		'caption_px_em' => 'px',
		'post_meta_px_em' => 'px',
		'ez_widget_home_title_px_em' => 'px',
		'ez_widget_home_content_px_em' => 'px',
		'ez_widget_feature_title_px_em' => 'px',
		'ez_widget_feature_content_px_em' => 'px',
		'ez_widget_footer_title_px_em' => 'px',
		'ez_widget_footer_content_px_em' => 'px',
		'catalyst_widget_title_px_em' => 'px',
		'catalyst_widget_content_px_em' => 'px',
		'excerpt_widget_heading_px_em' => 'px',
		'excerpt_widget_byline_px_em' => 'px',
		'excerpt_widget_p_px_em' => 'px',
		'search_form_px_em' => 'px',
		'search_button_px_em' => 'px',
		'footer_px_em' => 'px',
		'title_px_em' => 'px',
		'tagline_px_em' => 'px',
		'nav1_px_em' => 'px',
		'nav1_right_px_em' => 'px',
		'nav2_px_em' => 'px',
		'nav2_right_px_em' => 'px',
		'sb_heading_px_em' => 'px',
		'sb_content_px_em' => 'px',
		'sb_pages_px_em' => 'px',
		'font_type' => array(
			'universal' => 'Arial, sans-serif',
			'universal_heading' => 'Arial, sans-serif',
			'universal_content' => 'Arial, sans-serif',
			'title' => 'Arial, sans-serif',
			'tagline' => 'Arial, sans-serif',
			'nav1' => 'Arial, sans-serif',
			'nav1_right' => 'Arial, sans-serif',
			'nav2' => 'Arial, sans-serif',
			'nav2_right' => 'Arial, sans-serif',
			'content_heading' => 'Arial, sans-serif',
			'content_byline' => 'Arial, sans-serif',
			'content_p' => 'Arial, sans-serif',
			'breadcrumbs' => 'Arial, sans-serif',
			'author_info_title' => 'Arial, sans-serif',
			'author_info' => 'Arial, sans-serif',
			'post_nav' => 'Arial, sans-serif',
			'blockquote' => 'Arial, sans-serif',
			'caption' => 'Arial, sans-serif',
			'post_meta' => 'Arial, sans-serif',
			'ez_widget_home_title' => 'Arial, sans-serif',
			'ez_widget_home_content' => 'Arial, sans-serif',
			'ez_widget_feature_title' => 'Arial, sans-serif',
			'ez_widget_feature_content' => 'Arial, sans-serif',
			'ez_widget_footer_title' => 'Arial, sans-serif',
			'ez_widget_footer_content' => 'Arial, sans-serif',
			'catalyst_widget_title' => 'Arial, sans-serif',
			'catalyst_widget_content' => 'Arial, sans-serif',
			'excerpt_widget_heading' => 'Arial, sans-serif',
			'excerpt_widget_p' => 'Arial, sans-serif',
			'excerpt_widget_byline' => 'Arial, sans-serif',
			'search_form' => 'Arial, sans-serif',
			'search_button' => 'Arial, sans-serif',
			'sb_heading' => 'Arial, sans-serif',
			'sb_content' => 'Arial, sans-serif',
			'sb_pages' => 'Arial, sans-serif',
			'comment_heading' => 'Arial, sans-serif',
			'comment_author' => 'Arial, sans-serif',
			'comment_meta' => 'Arial, sans-serif',
			'comment_body' => 'Arial, sans-serif',
			'comment_form' => 'Arial, sans-serif',
			'comment_submit' => 'Arial, sans-serif',
			'footer' => 'Arial, sans-serif'
		)
	);
	
	if( $option_check )
	{
		if( catalyst_get_dynamik( $option_check ) != '' ) { echo catalyst_get_dynamik( $option_check ); } else { echo $defaults[$option_check]; }
	}
	else
	{
		return apply_filters( 'catalyst_dynamik_options_defaults', $defaults );
	}
}

//end lib/admin/dynamik-options.php