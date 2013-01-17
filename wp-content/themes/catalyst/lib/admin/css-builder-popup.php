<?php
/**
 * Builds the main Custom CSS Editor and Ajax save
 * functionality as well as pulls in the necessary js code
 * required for the Front-end CSS Builder.
 *
 * @package Catalyst
 */
 
/**
 * Build the front-end CSS builder Custom CSS editor form.
 *
 * @since 1.3.1
 */
function catalyst_css_builder_custom_css()
{
?>
	<div id="catalyst-custom-css-editor"<?php if( catalyst_get_advanced( 'css_builder_popup_editor_only' ) ) { echo 'style="display:none;"'; } ?>>
		<form action="/" id="css-builder-custom-css-form" name="css-builder-custom-css-form">
		
			<div id="catalyst-css-builder-saved" class="catalyst-update-box"></div>
			<h3 id="css-editor-h3" style="-webkit-border-radius: 3px 3px 0px 0px; border-radius: 3px 3px 0px 0px;"><?php _e( 'Custom CSS Editor', 'catalyst' ); ?> <span style="display:none;" id="custom-css-popout-link" class="css-editor-popout-links"><?php _e( '[Pop-out &raquo;]', 'catalyst' ); ?></span> <span style="display:none;" id="custom-css-popin-link" class="css-editor-popout-links"><?php _e( '[&laquo; Pop-in]', 'catalyst' ); ?></span> <span style="display:none;" id="custom-css-show-hide-sidebar-link" class="css-editor-popout-links"><?php _e( '[Show/Hide Sidebar]', 'catalyst' ); ?></span></h3>
			<div id="catalyst-custom-css-editor-wrap-inner" class="bg-box">
				
				<input type="hidden" name="action" value="catalyst_css_builder_save" />
				<input type="hidden" name="security" value="<?php echo wp_create_nonce( 'css-builder-popup' ); ?>" />
			
				<div id="catalyst-floating-save">
					<img id="ajax-save-no-throb" src="<?php echo WP_CONTENT_URL . '/themes/catalyst/lib/css/images/no-throb.png'; ?>" /><img id="ajax-save-throbber" src="<?php echo WP_CONTENT_URL . '/themes/catalyst/lib/css/images/throbber.gif'; ?>" /><input type="image" src="<?php echo WP_CONTENT_URL . '/themes/catalyst/lib/css/images/save-changes.png'; ?>" value="<?php _e( 'Save Changes', 'catalyst' ); ?>" class="catalyst-save-button" name="Submit" alt="Save Changes" />
				</div>
				
				<div id="custom-css-builder-nav-css-box">
					<textarea wrap="off" id="catalyst-custom-css" name="catalyst[custom_css]"><?php echo catalyst_get_advanced( 'custom_css' ); ?></textarea>
				</div>

			</div>
		
		</form>
	</div>
<?php
}

add_action( 'wp_ajax_catalyst_css_builder_save', 'catalyst_css_builder_save' );
/**
 * Use ajax to update the Custom CSS based on the posted values.
 *
 * @since 1.3.1
 */
function catalyst_css_builder_save()
{
	check_ajax_referer( 'css-builder-popup', 'security' );
	
	$update = array(
		'custom_css' => $_POST['catalyst']['custom_css'],
		'css_builder_popup_active' => catalyst_get_advanced( 'css_builder_popup_active' ),
		'css_builder_popup_editor_only' => catalyst_get_advanced( 'css_builder_popup_editor_only' )
	);
	$update_merged = array_merge( catalyst_advanced_options_defaults(), $update );
	update_option( 'catalyst_advanced_options', $update_merged );
	
	if ( defined( 'DYNAMIK_ACTIVE' ) )
	{
		catalyst_write_styles();
	}
	
	echo 'Custom CSS Updated';
	exit();
}

add_action( 'wp_head', 'css_builder_popup' );
/**
 * Add scripts and HTML to the <head> that are necessary
 * for the front-end CSS builder to function.
 *
 * @since 1.3.1
 */
function css_builder_popup()
{
	if( defined( 'DYNAMIK_ACTIVE' ) || defined( 'VANILLA_ACTIVE' ) )
	{
?>
<script type="text/javascript">
var cssBuilderImagesUrl = 'url(<?php echo get_stylesheet_directory_uri() . '/css/images'; ?>';
var cssBuilderLabelsUrl = '<?php echo get_template_directory_uri() . '/lib/css/images/css-builder-element-labels'; ?>';
var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
</script>
<?php
	}
	else
	{
?>
<script type="text/javascript">
var cssBuilderImagesUrl = 'url(<?php echo get_stylesheet_directory_uri() . '/images'; ?>';
var cssBuilderLabelsUrl = '<?php echo get_template_directory_uri() . '/lib/css/images/css-builder-element-labels'; ?>';
var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
</script>
<?php
	}
	if( catalyst_get_advanced( 'css_builder_popup_editor_only' ) )
	{
		echo '<span id="css-builder-custom-css-only"></span>' . "\n";
	}
	else
	{
		echo '<span id="css-builder-custom-css"></span>' . "\n";
	}
	echo '<span id="css-builder-editor-css"></span>' . "\n";
	echo '<span id="css-builder-highlight-css"></span>' . "\n";
	require_once( CATALYST_ADMIN . '/boxes/advanced-custom-css-builder-popup.php' );
}

add_action( 'wp_print_styles', 'add_css_builder_popup_styles' );
/**
 * Register and Enqueue the front-end CSS builder stylesheet.
 *
 * @since 1.3.1
 */
function add_css_builder_popup_styles()
{
	if( is_admin() )
		return;
		
	$css_builder_styles_url = CATALYST_URL . '/lib/css/css-builder-popup.css';
	$css_builder_styles_file = CATALYST_CSS . '/css-builder-popup.css';
	if ( file_exists( $css_builder_styles_file ) )
	{
		wp_register_style( 'css_builder_php_styles', $css_builder_styles_url );
		wp_enqueue_style( 'css_builder_php_styles' );
	}
}

//end lib/admin/css-builder-popup.php