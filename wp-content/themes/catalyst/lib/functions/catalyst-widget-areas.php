<?php
/**
 * Builds the functions required to create, update, delete and display
 * Custom Widget Areas in Advanced Options.
 *
 * @package Catalyst
 */

add_action( 'init', 'catalyst_spawn_widget_areas' );
/**
 * Register each Custom Widget Area based on their current database settings.
 *
 * @since 1.0
 */
function catalyst_spawn_widget_areas()
{
	$catalyst_layouts = get_option( 'catalyst_custom_layouts' );
	
	if( empty( $catalyst_layouts ) )
	{
		$catalyst_layouts = array();
	}
	
	array_multisort( $catalyst_layouts );
	
	foreach( $catalyst_layouts as $catalyst_layout => $layout )
	{	
		if( $layout['type'] == 'left-sidebar' || $layout['type'] == 'right-sidebar' || $layout['type'] == 'double-left-sidebar' || $layout['type'] == 'double-right-sidebar' || $layout['type'] == 'double-sidebar' )
		{	
			if( substr( $layout['layout_id'], 0, 16 ) != 'default_sidebars' )
			{
				$this_sidebar_1 = array(
					'name'	=> $layout['layout_id'] . ' Sidebar 1',
					'id'	=> $layout['layout_id'] . '_sidebar_1',
				);
				catalyst_register_sidebar( $this_sidebar_1 );
			}
		}
		
		if( $layout['type'] == 'double-left-sidebar' || $layout['type'] == 'double-right-sidebar' || $layout['type'] == 'double-sidebar' )
		{	
			if( substr( $layout['layout_id'], 0, 16 ) != 'default_sidebars' )
			{
				$this_sidebar_2 = array(
					'name'	=> $layout['layout_id'] . ' Sidebar 2',
					'id'	=> $layout['layout_id'] . '_sidebar_2',
				);
				catalyst_register_sidebar( $this_sidebar_2 );
			}
		}
	}
	
	$catalyst_widgets = get_option( 'catalyst_custom_widget_areas' );
	
	if( empty( $catalyst_widgets ) )
	{
		$catalyst_widgets = array();
	}
	
	array_multisort( $catalyst_widgets );
	
	foreach( $catalyst_widgets as $catalyst_widget => $widget_bits )
	{
		if( !empty( $widget_bits['class'] ) )
		{
			$widget_bits['class'] = ' ' . $widget_bits['class'];
		}
		$this_widget = array(
			'name'			=> $widget_bits['widget_name'],
			'id'            => $widget_bits['widget_name'],
			'before_widget' => '<aside id="%1$s" class="widget %2$s catalyst-widget-area' . $widget_bits['class'] . '"><div class="widget-wrap">',
		);
		catalyst_register_sidebar( $this_widget );
	}
}

/**
 * Hook all Custom Widget Areas that area set to be hooked into a Hook Location.
 *
 * @since 1.0
 */
function catalyst_hook_widget_areas( $layout_id )
{
	$catalyst_widgets = get_option( 'catalyst_custom_widget_areas' );
	
	foreach( $catalyst_widgets as $catalyst_widget => $widget_bits )
	{
		if( $widget_bits['is_active'] == 'hkd' || $widget_bits['is_active'] == 'bth' )
		{
			add_action( $widget_bits['hook_location'], 'catalyst_dynamic_sidebar', $widget_bits['priority'], 1 );
		}
	}
}

/**
 * Display each Custom Widget Area based on their current database settings.
 *
 * @since 1.0
 */
function catalyst_dynamic_sidebar( $layout_hook )
{
	global $wp_filter, $wp_current_filter, $catalyst_widget_priority;
	
	$this_catalyst_widget = end( $wp_current_filter );
	
	if( ! isset( $catalyst_widget_priority[$this_catalyst_widget] ) )
	{
		$catalyst_widget_priority[$this_catalyst_widget] = $wp_filter[$this_catalyst_widget];
		
		foreach( $catalyst_widget_priority[$this_catalyst_widget] as $priority => $action )
		{
			foreach( $action as $k => $v )
			{
				if( $k != 'catalyst_dynamic_sidebar' )
				{
					unset( $catalyst_widget_priority[$this_catalyst_widget][$priority][$k] );
					if( empty( $catalyst_widget_priority[$this_catalyst_widget][$priority] ) )
					{
						unset( $catalyst_widget_priority[$this_catalyst_widget][$priority] );
					}
				}
			}
		}
	}

	foreach( $catalyst_widget_priority[$this_catalyst_widget] as $k => $v )
	{
		$priority = $k;
		break;
	}			
	unset( $catalyst_widget_priority[$this_catalyst_widget][$priority] );
	
	if( empty( $catalyst_widget_priority[$this_catalyst_widget] ) )
	{
		unset( $catalyst_widget_priority[$this_catalyst_widget] );
	}
	
	$catalyst_widgets = get_option( 'catalyst_custom_widget_areas' );
	$these_widget_areas = $catalyst_widgets;
	
	foreach( $these_widget_areas as $key => $value )
	{
		if( $these_widget_areas[$key]['layout_hook'] == $layout_hook && $these_widget_areas[$key]['priority'] == $priority && ( $these_widget_areas[$key]['is_active'] == 'hkd' || $these_widget_areas[$key]['is_active'] == 'bth' ) )
		{
			dynamic_sidebar( $these_widget_areas[$key]['widget_name'] );
		}
	}
}

/**
 * Get Custom Widget Areas from the database, if any exist, and then return
 * them in a sorted array.
 *
 * @since 1.0
 * @return soreted array of all Custom Widget Areas from the database if they exist.
 */
function catalyst_get_widgets()
{
	$catalyst_widgets = get_option( 'catalyst_custom_widget_areas' );

	if( !empty( $catalyst_widgets ) )
	{
		$custom_widgets = $catalyst_widgets;

		$custom_widget_name_compare = array();
		foreach( $custom_widgets as $k => $v )
		{
			if( empty( $custom_widgets_count ) )
			{
				$custom_widgets[$k]['layouts'] = explode( '|', $v['layouts'] );
				$custom_widgets_count = true;
				$custom_widget_name_compare[] = $custom_widgets[$k]['widget_name'];
			}
			elseif( in_array( $custom_widgets[$k]['widget_name'], $custom_widget_name_compare ) )
			{
				unset( $custom_widgets[$k] );
			}
			else
			{
				$custom_widgets[$k]['layouts'] = explode( '|', $v['layouts'] );
				$custom_widget_name_compare[] = $custom_widgets[$k]['widget_name'];
			}
		}
		$custom_widgets = catalyst_array_sort( $custom_widgets, 'widget_name' );	
		return $custom_widgets;
	}
	else
	{
		return false;
	}
}

/**
 * Update Custom Widget Areas in the database from current settings posted
 * in the Advanced Options > Custom Widget Areas admin page.
 *
 * @since 1.0
 */
function catalyst_update_widgets( $names = '', $layouts = '', $hooks = '', $classes = '', $actives = '', $priorities = '' )
{
	$catalyst_widgets = get_option( 'catalyst_custom_widget_areas' );
	$these_widgets = array();
	$widget_id_array = array();
	$widget_name_array = array();
	
	if( !empty( $names[1] ) )
	{
		foreach( $names as $key => $value )
		{
			$these_widgets[$key]['name'] = $value;
		}
		if( !empty( $layouts ) )
		{
			foreach( $layouts as $key => $value )
			{
				$these_widgets[$key]['layouts'] = $value;
			}
		}
		if( !empty( $hooks ) )
		{
			foreach( $hooks as $key => $value )
			{
				$these_widgets[$key]['hook'] = $value;
			}
		}
		if( !empty( $classes ) )
		{
			foreach( $classes as $key => $value )
			{
				$these_widgets[$key]['class'] = $value;
			}
		}
		if( !empty( $actives ) )
		{
			foreach( $actives as $key => $value )
			{
				$these_widgets[$key]['active'] = $value;
			}
		}
		if( !empty( $priorities ) )
		{
			foreach( $priorities as $key => $value )
			{
				$these_widgets[$key]['priority'] = $value;
			}
		}
	}
	
	if( !empty( $these_widgets ) )
	{
		foreach( $these_widgets as $this_widget )
		{
			$widget_name = $this_widget['name'];
			
			if( empty( $this_widget['layouts'] ) )
			{
				$this_widget['layouts'] = array( 'catalyst_default' );
			}
			
			foreach( $this_widget['layouts'] as $key => $layout_id )
			{
				$widget_id_array[] = $widget_name . '|' . $layout_id;
				if( !in_array( $widget_name, $widget_name_array ) )
				{
					$widget_name_array[] = $widget_name;
				}
			}
		}

		foreach( $catalyst_widgets as $key => $value )
		{
			if( !in_array( $catalyst_widgets[$key]['widget_id'], $widget_id_array ) &&
				in_array( $catalyst_widgets[$key]['widget_name'], $widget_name_array ) )
			{
				unset( $catalyst_widgets[$key] );
			}
		}

		update_option( 'catalyst_custom_widget_areas', $catalyst_widgets );
	
		foreach( $these_widgets as $this_widget )
		{
			$widget_name = $this_widget['name'];
			$hook_location = $this_widget['hook'];
			$class = $this_widget['class'];
			$priority = $this_widget['priority'];
			if( !empty( $this_widget['layouts'] ) )
			{
				$layouts = implode( '|', $this_widget['layouts'] );
				$is_active = $this_widget['active'];
			}
			else
			{
				$this_widget['layouts'] = array( 'catalyst_default' );
				$layouts = 'catalyst_default';
				$is_active = 'no';
			}
				
			foreach( $this_widget['layouts'] as $key => $layout_id )
			{
				$catalyst_widgets = get_option( 'catalyst_custom_widget_areas' );
				$widget_id = $widget_name . '|' . $layout_id;
				$layout_hook = $layout_id . '_' . $hook_location;
				if( !empty( $widget_id ) )
				{
					if( !empty( $catalyst_widgets[$widget_id]['widget_id'] ) && $catalyst_widgets[$widget_id]['widget_id'] == $widget_id )
					{
						$updated_values = array( $widget_id => array( 'widget_id' => $widget_id, 'widget_name' => $catalyst_widgets[$widget_id]['widget_name'], 'layout_id' => $layout_id, 'layouts' => $layouts, 'hook_location' => $hook_location, 'layout_hook' => $layout_hook, 'class' => $class, 'is_active' => $is_active, 'priority' => $priority ) );
						$merged_widget_area = array_merge( $catalyst_widgets, $updated_values );
						update_option( 'catalyst_custom_widget_areas', $merged_widget_area );
					}
					else
					{
						$new_widget = array( $widget_id => array( 'widget_id' => $widget_id, 'widget_name' => $widget_name, 'layout_id' => $layout_id, 'layouts' => $layouts, 'hook_location' => $hook_location, 'layout_hook' => $layout_hook, 'class' => $class, 'is_active' => $is_active, 'priority' => $priority ) );
						$merged_widget_area = array_merge( $catalyst_widgets, $new_widget );
						update_option( 'catalyst_custom_widget_areas', $merged_widget_area );
					}
				}
			}
		}
	}
}

/**
 * Uses the pre-1.4 Catalyst Custom Widget Area database tables to "filter"/merge pre-1.4
 * Custom Widget Area Export data into the catalyst_custom_widget_area options array.
 *
 * @since 1.4
 */
function catalyst_update_from_old_widget_areas()
{
	global $wpdb;

	$catalyst_widgets_old_table = $wpdb->prefix . 'catalyst_widgets';
	$catalyst_widgets_old = $wpdb->get_results( "SELECT * FROM `$catalyst_widgets_old_table`", ARRAY_A );
	$catalyst_widgets_new = get_option( 'catalyst_custom_widget_areas' );
	
	$catalyst_widgets_array = array();
	foreach( $catalyst_widgets_new as $key => $value )
	{
		if( !in_array( $catalyst_widgets_new[$key]['widget_name'], $catalyst_widgets_array ) )
		{
			$catalyst_widgets_array[] = $catalyst_widgets_new[$key]['widget_name'];
		}
	}

	$widget_name_check = '';
	foreach( $catalyst_widgets_old as $key => $value )
	{
		$widget_id = $catalyst_widgets_old[$key]['widget_id'];
		$widget_name = $catalyst_widgets_old[$key]['widget_name'];
		$layout_id = $catalyst_widgets_old[$key]['layout_id'];
		$layouts = $catalyst_widgets_old[$key]['layouts'];
		$hook_location = $catalyst_widgets_old[$key]['hook_location'];
		$layout_hook = $catalyst_widgets_old[$key]['layout_hook'];
		$class = $catalyst_widgets_old[$key]['class'];
		$is_active = $catalyst_widgets_old[$key]['is_active'];
		$priority = $catalyst_widgets_old[$key]['priority'];
		
		$new_widget = array( $widget_id => array( 'widget_id' => $widget_id, 'widget_name' => $widget_name, 'layout_id' => $layout_id, 'layouts' => $layouts, 'hook_location' => $hook_location, 'layout_hook' => $layout_hook, 'class' => $class, 'is_active' => $is_active, 'priority' => $priority ) );
		
		foreach( $new_widget as $key => $value )
		{
			if( !in_array( $widget_name, $catalyst_widgets_array ) || $widget_name_check == $widget_name )
			{
				$widget_name_check = $widget_name;
			}
			else
			{
				unset( $new_widget[$key] );
			}
		}
		
		$catalyst_widgets_new = get_option( 'catalyst_custom_widget_areas' );
		$merged_widget_area = array_merge( $catalyst_widgets_new, $new_widget );
		update_option( 'catalyst_custom_widget_areas', $merged_widget_area );
	}
}

/**
 * Delete Custom Widget Areas from the database that are posted for deletion
 * in Advanced Options > Custom Widget Areas.
 * 
 *
 * @since 1.0
 */
add_action( 'wp_ajax_catalyst_widget_delete', 'catalyst_delete_widget' );
function catalyst_delete_widget()
{
	$catalyst_widgets = get_option( 'catalyst_custom_widget_areas' );
	
	$widget_name = $_POST['widget_name'];
	
	foreach( $catalyst_widgets as $key => $value )
	{
		if( in_array( $widget_name, $catalyst_widgets[$key] ) )
		{
			unset( $catalyst_widgets[$key] );
		}
	}

	update_option( 'catalyst_custom_widget_areas', $catalyst_widgets );
	echo 'deleted';
}

// Allow Custom Widget Areas to be turned into shortcodes.
add_shortcode( 'catalyst_widget_area', 'catalyst_widget_area_shortcode' );
/**
 * Get Custom Layouts from the database, if any exist, and then return
 * them in a sorted array.
 *
 * @since 1.0
 * @return soreted array of all Custom Layouts from the database if they exist.
 */
function catalyst_widget_area_shortcode( $atts )
{
	extract( shortcode_atts( array (
	"name" => '',
	), $atts));
	
	$catalyst_widgets = get_option( 'catalyst_custom_widget_areas' );
	
	foreach( $catalyst_widgets as $key => $value )
	{
		if( $catalyst_widgets[$key]['widget_name'] == $name && ( $catalyst_widgets[$key]['is_active'] == 'hkd' || $catalyst_widgets[$key]['is_active'] == 'no' ) )
			return;
	}
	
	ob_start();
	dynamic_sidebar( $name );
	$dynamic_sidebar = ob_get_clean();
	
	return $dynamic_sidebar;
}

/**
 * Build drop-down menu for Custom Widget Area classes for the CSS Builder tool.
 *
 * @since 1.0
 */
function catalyst_widget_class_dropdown()
{
	$catalyst_widgets = get_option( 'catalyst_custom_widget_areas' );
	
	if( !empty( $catalyst_widgets ) )
	{
		foreach( $catalyst_widgets as $k => $v )
		{
			if( $catalyst_widgets[$k]['class'] != '' )
			{
				echo '<option value="' . $catalyst_widgets[$k]['class'] . '">' . $catalyst_widgets[$k]['class'] . '</option>';
			}
		}
	}
}

//end lib/functions/catalyst-widget-areas.php