<?php
/**
 * Builds the Advanced Options admin page.
 *
 * @package Catalyst
 */
 
/**
 * Build the Catalyst Advanced Options admin page.
 *
 * @since 1.0
 */
function catalyst_advanced_options()
{
	$custom_layouts = catalyst_get_layouts();
	$custom_widgets = catalyst_get_widgets();
	$custom_hooks = catalyst_get_hooks();
?>
	<div class="wrap">
		
		<div id="catalyst-advanced-saved" class="catalyst-update-box"></div>
		
		<?php
		if( !empty( $_GET['activetab'] ) )
		{ ?>
			<script type="text/javascript">jQuery(document).ready(function($) { $('#<?php echo $_GET['activetab']; ?>').click(); });</script>	
		<?php
		} ?>
		
		<div id="icon-options-general" class="icon32"></div>
		
		<h2 id="catalyst-admin-heading"><?php _e( 'Catalyst - Advanced Options', 'catalyst' ); ?></h2>
		
		<div class="catalyst-css-builder-button-wrap">
			<span id="show-hide-custom-css-builder" class="show-hide-custom-css-builder-styles"><?php _e( 'CSS Builder', 'catalyst' ); ?></span>
		</div>
		
		<div id="catalyst-admin-wrap">
		
			<?php require_once( CATALYST_ADMIN . '/boxes/advanced-custom-css-builder.php' ); ?>
			
			<form action="/" id="advanced-options-form" name="advanced-options-form">
			
				<input type="hidden" name="action" value="catalyst_advanced_options_save" />
				<input type="hidden" name="security" value="<?php echo wp_create_nonce( 'advanced-options' ); ?>" />
			
				<div id="catalyst-floating-save" class="catalyst-layouts">
					<img id="ajax-save-no-throb" src="<?php echo WP_CONTENT_URL . '/themes/catalyst/lib/css/images/no-throb.png'; ?>" style="margin-bottom:8px;" /><img id="ajax-save-throbber" src="<?php echo WP_CONTENT_URL . '/themes/catalyst/lib/css/images/throbber.gif'; ?>" style="display:none;margin-bottom:8px;" /><input type="image" src="<?php echo WP_CONTENT_URL . '/themes/catalyst/lib/css/images/save-changes.png'; ?>" value="<?php _e( 'Save Changes', 'catalyst' ); ?>" class="catalyst-save-button" name="Submit" alt="Save Changes" />
				</div>
					
				<div id="catalyst-advanced-options-nav">
					<ul>
						<li id="catalyst-advanced-options-nav-layouts" class="catalyst-options-nav-all catalyst-options-nav-active"><a href="#">Custom Layouts</a></li><li id="catalyst-advanced-options-nav-widget-areas" class="catalyst-options-nav-all"><a href="#">Custom Widget Areas</a></li></li><li id="catalyst-advanced-options-nav-hook-boxes" class="catalyst-options-nav-all"><a href="#">Custom Hook Boxes</a></li><li id="catalyst-advanced-options-nav-css" class="catalyst-options-nav-all"><a class="catalyst-options-nav-last" href="#">Custom CSS</a></li>
					</ul>
				</div>
				
				<div class="catalyst-advanced-options-wrap">
					<?php require_once( CATALYST_ADMIN . '/boxes/advanced-custom-layouts.php' ); ?>
					<?php require_once( CATALYST_ADMIN . '/boxes/advanced-custom-widget-areas.php' ); ?>
					<?php require_once( CATALYST_ADMIN . '/boxes/advanced-custom-hook-boxes.php' ); ?>
					<?php require_once( CATALYST_ADMIN . '/boxes/advanced-custom-css.php' ); ?>
				</div>
			
			</form>
			
			<div id="catalyst-admin-footer">
				<p>
					<a href="http://catalysttheme.com" target="_blank">CatalystTheme.com</a> | <a href="http://catalysttheme.com/resources" target="_blank">Resources</a> | <a href="http://catalysttheme.com/forum" target="_blank">Support Forum</a> | <a href="http://catalysttheme.com/affiliates" target="_blank">Affiliates</a>
				</p>
			</div>
		</div>
	</div> <!-- Close Wrap -->
<?php
}

add_action( 'wp_ajax_catalyst_advanced_options_save', 'catalyst_advanced_options_save' );
/**
 * Use ajax to update the Advaned Options based on the posted values.
 *
 * @since 1.0
 */
function catalyst_advanced_options_save()
{
	check_ajax_referer( 'advanced-options', 'security' );
	
	if( !empty( $_POST['catalyst']['css_builder_popup_active'] ) || catalyst_get_advanced( 'css_builder_popup_active' ) )
	{
		$update = array(
			'custom_css' => catalyst_get_advanced( 'custom_css' ),
			'css_builder_popup_active' => !empty( $_POST['catalyst']['css_builder_popup_active'] ) ? 1 : 0,
			'css_builder_popup_editor_only' => !empty( $_POST['catalyst']['css_builder_popup_editor_only'] ) ? 1 : 0
		);
		$update_merged = array_merge( catalyst_advanced_options_defaults(), $update );
		update_option( 'catalyst_advanced_options', $update_merged );
	}
	else
	{
		$update = $_POST['catalyst'];
		update_option( 'catalyst_advanced_options', $update );
		if ( defined( 'DYNAMIK_ACTIVE' ) )
		{
			catalyst_write_styles();
		}
	}
	
	if( !empty( $_POST['custom_layouts_list'] ) )
	{
		$custom_layouts_list = $_POST['custom_layouts_list'];
	}
	else
	{
		$custom_layouts_list = array();
	}
	
	if( !empty( $_POST['custom_hook_layouts_list'] ) )
	{
		$custom_hook_layouts_list = $_POST['custom_hook_layouts_list'];
	}
	else
	{
		$custom_hook_layouts_list = array();
	}
	
	if( !empty( $_POST['custom_layout_ids'] ) )
	{
		$layout_ids_empty = true;
		foreach( $_POST['custom_layout_ids'] as $key )
		{
			if( !empty( $key ) )
			{
				$layout_ids_empty = false;
			}
		}
		foreach( $_POST['custom_layout_ids'] as $key )
		{
			if( empty( $key ) && !$layout_ids_empty )
			{
				echo 'Please fill in ALL "Name" fields';
				exit();
			}
		}
		catalyst_update_layouts( $_POST['custom_layout_ids'], $_POST['custom_layout_types'] );
	}
	if( !empty( $_POST['custom_widget_ids'] ) )
	{
		$widget_ids_empty = true;
		foreach( $_POST['custom_widget_ids'] as $key )
		{
			if( !empty( $key ) )
			{
				$widget_ids_empty = false;
			}
		}
		foreach( $_POST['custom_widget_ids'] as $key )
		{
			if( empty( $key ) && !$widget_ids_empty )
			{
				echo 'Please fill in ALL "Name" fields';
				exit();
			}
		}
		catalyst_update_widgets( $_POST['custom_widget_ids'], $custom_layouts_list, $_POST['custom_widget_hook'], $_POST['custom_widget_class'], $_POST['custom_widget_active'], $_POST['custom_widget_priority'] );
	}
	if( !empty( $_POST['custom_hook_ids'] ) )
	{
		$hook_ids_empty = true;
		foreach( $_POST['custom_hook_ids'] as $key )
		{
			if( !empty( $key ) )
			{
				$hook_ids_empty = false;
			}
		}
		foreach( $_POST['custom_hook_ids'] as $key )
		{
			if( empty( $key ) && !$hook_ids_empty )
			{
				echo 'Please fill in ALL "Name" fields';
				exit();
			}
		}
		catalyst_update_hooks( $_POST['custom_hook_ids'], $custom_hook_layouts_list, $_POST['custom_hook_hook'], $_POST['custom_hook_active'], $_POST['custom_hook_priority'], $_POST['custom_hook_textarea'] );
	}
	
	echo 'Advanced Options Updated';
	exit();
}

/**
 * Create an array of Advanced Options default values.
 *
 * @since 1.5.1
 * @return an array of Advanced Options default values.
 */
function catalyst_advanced_options_defaults()
{
	$defaults = array(
		'custom_css' => '',
		'css_builder_popup_active' => 0,
		'css_builder_popup_editor_only' => 0
	);
	
	return apply_filters( 'catalyst_advanced_options_defaults', $defaults );
}

//end lib/admin/advanced-options.php