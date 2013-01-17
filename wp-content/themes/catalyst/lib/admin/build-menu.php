<?php
/**
 * Build and hook in the Catalyst and Dynamik (if active) admin menus.
 *
 * @package Catalyst
 */
 
add_action( 'admin_menu', 'catalyst_add_admin_menu' );
/**
 * Add the Catalyst admin menu.
 *
 * @since 1.0
 */
function catalyst_add_admin_menu()
{
	global $menu;
	
	$user = wp_get_current_user();
	if ( get_the_author_meta( 'disable_catalyst_admin_menu', $user->ID ) )
		return;
	
	if ( version_compare(get_bloginfo("version"), '2.9', '>=' ) )
		$menu['55.57'] = array( '', 'manage_options', 'separator-catalyst', '', 'wp-menu-separator' );
	
	add_menu_page( 'Catalyst', 'Catalyst', 'manage_options', 'catalyst', 'catalyst_core_options', get_template_directory_uri() . '/lib/css/images/favicon.png', '55.575' );
}

add_action( 'admin_menu', 'catalyst_add_admin_submenus' );
/**
 * Add the Catalyst admin sub menus.
 *
 * @since 1.0
 */
function catalyst_add_admin_submenus()
{
	$user = wp_get_current_user();
	
	$_catalyst_core_options = add_submenu_page( 'catalyst', __( 'Core Options','catalyst' ), __( 'Core Options','catalyst' ), 'manage_options', 'catalyst', 'catalyst_core_options' );
	
	add_action( 'admin_print_styles-' . $_catalyst_core_options, 'catalyst_admin_styles' );
	add_action( 'admin_print_styles-' . $_catalyst_core_options, 'catalyst_core_options_styles' );
	
	if( defined( 'DYNAMIK_ACTIVE' ) && !get_the_author_meta( 'disable_catalyst_dynamik_submenu', $user->ID ) )
	{
		$_catalyst_dynamik_options = add_submenu_page( 'catalyst', __( 'Dynamik Options','catalyst' ), __( 'Dynamik Options','catalyst' ), 'manage_options', 'dynamik-options', 'catalyst_dynamik_options' );
		
		add_action( 'admin_print_styles-' . $_catalyst_dynamik_options, 'catalyst_admin_styles' );
		add_action( 'admin_print_styles-' . $_catalyst_dynamik_options, 'catalyst_dynamik_options_styles' );

		add_action( 'admin_print_scripts-' . $_catalyst_dynamik_options, 'dynamik_php_vars' );
	}
	if( !get_the_author_meta( 'disable_catalyst_advanced_submenu', $user->ID ) )
	{
		$_catalyst_advanced_options = add_submenu_page( 'catalyst', __( 'Advanced Options','catalyst' ), __( 'Advanced Options','catalyst' ), 'manage_options', 'advanced-options', 'catalyst_advanced_options' );
		
		add_action( 'admin_print_styles-' . $_catalyst_advanced_options, 'catalyst_admin_styles' );
		add_action( 'admin_print_styles-' . $_catalyst_advanced_options, 'catalyst_advanced_styles' );
		
		add_action( 'admin_print_scripts-' . $_catalyst_advanced_options, 'advanced_php_vars' );
	}
}

/**
 * Build the javascript variable to properly display the Dynamik Options > Wrap preview images.
 *
 * @since 1.0
 */
function dynamik_php_vars()
{
?>
<script type="text/javascript">
	var dynamik_wrap_image_url = '<?php echo get_template_directory_uri() . '/lib/css/images/wraps/'; ?>';
</script>
<?php
}

/**
 * Build the javascript variables that are used in Advanced Options.
 *
 * @since 1.0
 */
function advanced_php_vars()
{
?>
<script type="text/javascript">
<?php if( get_bloginfo( 'version' ) < 3.1 ) { $layouts_list_menu_width = '250'; } else { $layouts_list_menu_width = '266'; } ?>
	var layouts_list_menu_width = <?php echo $layouts_list_menu_width ?>;
	var e_custom_layout_options = '<?php _e( 'Custom Layout Options:', 'catalyst' ); ?>';
	var e_name = '<?php _e( 'Name', 'catalyst' ); ?>';
	var e_delete = '<?php _e( 'Delete', 'catalyst' ); ?>';
	var e_hook = '<?php _e( 'Hook', 'catalyst' ); ?>';
	var e_priority = '<?php _e( 'Priority', 'catalyst' ); ?>';
	var e_hooked = '<?php _e( 'Hooked', 'catalyst' ); ?>';
	var e_shortcode = '<?php _e( 'Shortcode', 'catalyst' ); ?>';
	var e_both = '<?php _e( 'Both', 'catalyst' ); ?>';
	var e_deactivate = '<?php _e( 'Deactivate', 'catalyst' ); ?>';
	var e_layouts = '<?php _e( 'Layouts', 'catalyst' ); ?>';
	var e_class = '<?php _e( 'Class', 'catalyst' ); ?>';
	var f_catalyst_list_layout_types = '<?php catalyst_list_layout_types(); ?>';
	var f_catalyst_list_hooks = '<?php catalyst_list_hooks(); ?>';
	var f_catalyst_list_layouts = '<?php catalyst_list_layouts(); ?>';
</script>
<?php
}

add_action( 'admin_init', 'catalyst_admin_init' );
/**
 * Register styles and scripts for the Catalyst admin menus.
 *
 * @since 1.0
 */
function catalyst_admin_init()
{
	$catalyst_template_dir = get_template_directory_uri();
	
	//use old options stylesheet if running a pre WP 3.2 version
	if( get_bloginfo( 'version' ) < 3.2 )
	{
		wp_register_style( 'catalyst_admin_styles', $catalyst_template_dir . '/lib/css/option-styles-pre-wp-3-2.css' );
	}
	else
	{
		wp_register_style( 'catalyst_admin_styles', $catalyst_template_dir . '/lib/css/option-styles.css' );
	}
	
	wp_register_style( 'catalyst_jqui_css', $catalyst_template_dir . '/lib/css/smoothness/jquery-ui-1.7.3.custom.css' );
	//use old multiselect stylesheet if running a pre WP 3.1 version
	if( get_bloginfo( 'version' ) < 3.1 )
	{
		wp_register_style( 'catalyst_ms_css', $catalyst_template_dir . '/lib/js/multiselect/multiselect-pre-wp-3-1.css' );
	}
	else
	{
		wp_register_style( 'catalyst_ms_css', $catalyst_template_dir . '/lib/js/multiselect/multiselect.css' );
	}
	
	wp_register_script( 'catalyst_admin', $catalyst_template_dir . '/lib/js/catalyst-admin-options.js' );
	wp_register_script( 'catalyst_core', $catalyst_template_dir . '/lib/js/catalyst-core-options.js' );
	wp_register_script( 'catalyst_dynamik', $catalyst_template_dir . '/lib/js/catalyst-dynamik-options.js' );
	wp_register_script( 'catalyst_ms_js', $catalyst_template_dir . '/lib/js/multiselect/multiselect.js' );
	wp_register_script( 'catalyst_advanced', $catalyst_template_dir . '/lib/js/catalyst-advanced-options.js' );
	wp_register_script( 'catalyst_jscolor', $catalyst_template_dir . '/lib/js/jscolor/jscolor.js' );
	wp_register_script( 'catalyst_jquery_tooltip', $catalyst_template_dir . '/lib/js/jquery.tools.min.js' );
	wp_register_script( 'catalyst_custom_css_builder', $catalyst_template_dir . '/lib/js/catalyst-custom-css-builder.js' );
}

/**
 * Enqueue styles and scripts for the Catalyst admin menus.
 *
 * @since 1.0
 */
function catalyst_admin_styles()
{
	wp_enqueue_style( 'catalyst_admin_styles' );
	
	wp_enqueue_script( 'catalyst_admin' );
	wp_enqueue_script( 'catalyst_jquery_tooltip' );
}

/**
 * Enqueue styles and scripts for the Catalyst Core Options menu.
 *
 * @since 1.0
 */
function catalyst_core_options_styles()
{	
	wp_enqueue_script( 'catalyst_core' );
}

/**
 * Enqueue styles and scripts for the Catalyst Dynamik Options menu.
 *
 * @since 1.0
 */
function catalyst_dynamik_options_styles()
{	
	wp_enqueue_script( 'catalyst_custom_css_builder' );
	wp_enqueue_script( 'catalyst_dynamik' );
	wp_enqueue_script( 'catalyst_jscolor' );
}

/**
 * Enqueue styles and scripts for the Catalyst Advanced Options menu.
 *
 * @since 1.0
 */
function catalyst_advanced_styles()
{
	wp_enqueue_style( 'catalyst_jqui_css' );
	wp_enqueue_style( 'catalyst_ms_css' );
	
	wp_enqueue_script( 'catalyst_ms_js' );
	wp_enqueue_script( 'catalyst_custom_css_builder' );
	wp_enqueue_script( 'catalyst_advanced' );
	wp_enqueue_script( 'catalyst_jscolor' );
}

//end lib/admin/build-menu.php