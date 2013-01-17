<?php
/*-------------------------------------------------------------
*   Add scripts in admin panel
*------------------------------------------------------------*/
function framework_add_scripts_admin() {
	wp_enqueue_style('framework-style.css', FRAMEWORK_DIR_CSS . 'style.php');

	// Change/add css/javascript only if is framework page
	if( isset($_GET['page']) && ($_GET['page'] == "framework.php") ) :
		wp_deregister_script('jquery-ui-core');
		wp_deregister_script('jquery-ui-widget');
		wp_deregister_script('jquery-ui-tabs');
		wp_deregister_script('jquery-ui-mouse');
		wp_deregister_script('jquery-ui-sortable');
		wp_deregister_script('swfobject');

		wp_enqueue_script('admin-js', FRAMEWORK_DIR_JS . 'javascript.php', array('jquery'));
	endif;
}
add_action( 'admin_enqueue_scripts', 'framework_add_scripts_admin');

/*-------------------------------------------------------------
*   Add javascript in admin_head
*------------------------------------------------------------*/
function framework_admin_head() {
	if( isset($_GET['page']) && ($_GET['page'] == "framework.php") ) : ?>

<script type="text/javascript">
jQuery(document).ready(function(){
<?php global $panel_options; ?>
<?php foreach( $panel_options as $tab ) : ?>
	<?php if( !empty($tab['options'])) : ?>
	<?php foreach( $tab['options'] as $option ) : ?>
		<?php if( isset($option['type']) && ($option['type'] == "colorpicker") ) : ?>

	setColorPicker('<?php echo $option['id']; ?>', '<?php echo framework_get_option($option['id']); ?>');
		<?php endif; ?>
		<?php if( isset($option['type']) && ($option['type'] == "upload") ) : ?>

	setUpload('<?php echo $option['id']; ?>', '<?php echo FRAMEWORK_DIR; ?>');
		<?php endif; ?>
	<?php endforeach; ?>
	<?php endif; ?>
<?php endforeach; ?>

});
</script>
<?php
	endif;
}
add_action('admin_head', 'framework_admin_head');

/*-------------------------------------------------------------
*   Redirect to theme panel when theme is activated
*------------------------------------------------------------*/
if( isset( $_GET['activated'] ) && ( $_GET['activated'] == "true" ) && ($pagenow == "themes.php") ) {
	wp_redirect( admin_url().'admin.php?page=framework.php&activated=true' );
}

/*-------------------------------------------------------------
*   Restore default settings
*------------------------------------------------------------*/
if( isset( $_GET['page'] ) && ( $_GET['page'] == "framework.php" ) && ( isset($_POST['action']) == "reset" ) ) {
	framework_set_default(true);
	wp_redirect( admin_url().'admin.php?page=' . $_GET['page'] . '&reset=true' );
}

/*-------------------------------------------------------------
*   Set default settings on install
*------------------------------------------------------------*/
if( !get_option( SHORTNAME_SETTINGS ) && !get_option( SHORTNAME_TEMPLATE ) ) {
	framework_set_default(true);
	wp_redirect( admin_url().'admin.php?page=framework.php' );
}

/*-------------------------------------------------------------
*   Framework option interface
*------------------------------------------------------------*/
function framework_add_admin_menu() {
	global $panel_options;

	add_menu_separator(49);
 
	add_menu_page(THEMENAME, THEMENAME, 'edit_theme_options', 'framework.php', 'framework_build_option_interface', '' , 50);
	
	foreach( $panel_options as $nav ) :
		if( ($nav['type'] != 'feedback') && ($nav['type'] != 'affiliate') )
			if( $nav['type'] == 'welcome' )
				add_submenu_page('framework.php' , $nav['name'], $nav['name'], 'edit_theme_options', 'framework.php', 'framework_build_option_interface');
			else
				add_submenu_page('framework.php' , $nav['name'], $nav['name'], 'edit_theme_options', 'framework.php&tab=' . $nav['id'], 'framework_build_option_interface');
	endforeach;
}
add_action('admin_menu', 'framework_add_admin_menu');

/*-------------------------------------------------------------
*   Add a message if there is a new update
*------------------------------------------------------------*/
function framework_update_message() {
	$option = get_option( SHORTNAME . '-version' );

	echo '<div id="message" class="updated"><p>
		<span style="float:right"><strong><a href="' . admin_url() . 'admin.php?page=' . $_GET['page'] . '&notice=dismiss' . '">Dismiss this notice</a></strong></span>
		<strong>Warning!</strong> There is a new version for this theme. You have version v' . THEMEVERSION . ' installed. Update to ' . $option['new_version'] . '.';

	if( $option['new_version_details'] != '' )
		echo '  <a href="' . $option['new_version_details'] . '" target="_blank">View new version details.</a>';

	echo '</p></div>';
}
if (FRAMEWORK_HAS_UPDATE && !get_user_meta( get_current_user_id(), 'framework_dismissed_notice', true ))
	add_action('admin_notices', 'framework_update_message');
?>