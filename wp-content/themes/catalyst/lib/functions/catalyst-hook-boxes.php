<?php
/**
 * Builds the functions required to create, update, delete and display
 * Custom Hook Boxes in Advanced Options.
 *
 * @package Catalyst
 */

/**
 * Hook all Custom Hook Boxes that area set to be hooked into a Hook Location.
 *
 * @since 1.0
 */
function catalyst_hook_hook_boxes( $layout_id )
{
	$catalyst_hooks = get_option( 'catalyst_custom_hook_boxes' );
	
	foreach( $catalyst_hooks as $catalyst_hook => $hook_bits )
	{
		if( $hook_bits['is_active'] == 'hkd' || $hook_bits['is_active'] == 'bth' )
		{
			add_action( $hook_bits['hook_location'], 'catalyst_echo_hook_box', $hook_bits['priority'], 1 );
		}
	}
}

// Enable shortcodes in Custom Hook Boxes.
add_filter( 'catalyst_echo_hook_box', 'do_shortcode' );
/**
 * Determine where to echo the content of each Custom Hook Box.
 *
 * @since 1.0
 */
function catalyst_echo_hook_box( $layout_hook )
{
	global $wp_filter, $wp_current_filter, $catalyst_hook_priority;
	
	$this_catalyst_hook = end( $wp_current_filter );
	
	if( !isset( $catalyst_hook_priority[$this_catalyst_hook] ) )
	{
		$catalyst_hook_priority[$this_catalyst_hook] = $wp_filter[$this_catalyst_hook];
		
		foreach( $catalyst_hook_priority[$this_catalyst_hook] as $priority => $action )
		{
			foreach( $action as $k => $v )
			{
				if( $k != 'catalyst_echo_hook_box' )
				{
					unset( $catalyst_hook_priority[$this_catalyst_hook][$priority][$k] );
					if( empty( $catalyst_hook_priority[$this_catalyst_hook][$priority] ) )
					{
						unset( $catalyst_hook_priority[$this_catalyst_hook][$priority] );
					}
				}
			}
		}
	}
	
	foreach( $catalyst_hook_priority[$this_catalyst_hook] as $k => $v )
	{
		$priority = $k;
		break;
	}			
	unset( $catalyst_hook_priority[$this_catalyst_hook][$priority] );
	
	if( empty( $catalyst_hook_priority[$this_catalyst_hook] ) )
	{
		unset( $catalyst_hook_priority[$this_catalyst_hook] );
	}
	
	$catalyst_hooks = get_option( 'catalyst_custom_hook_boxes' );
	$catalyst_hook_content = get_option( 'catalyst_custom_hook_box_content' );
	$these_hook_boxes = $catalyst_hooks;
	
	$recovery_mode = 'off';

	foreach( $these_hook_boxes as $key => $value )
	{
		if( $these_hook_boxes[$key]['layout_hook'] == $layout_hook && $these_hook_boxes[$key]['priority'] == $priority && ( $these_hook_boxes[$key]['is_active'] == 'hkd' || $these_hook_boxes[$key]['is_active'] == 'bth' ) )
		{
			$text = apply_filters( 'catalyst_echo_hook_box', htmlspecialchars_decode( stripslashes( $catalyst_hook_content[$these_hook_boxes[$key]['hook_name']] ) ) );
			
			if( $recovery_mode == 'off' )
			{
				ob_start();
				eval( '?>'.$text);
				$text = ob_get_contents();
				ob_end_clean();
			}
			
			echo $text;
		}
	}
}

/**
 * Get Custom Hook Boxes from the database, if any exist, and then return
 * them in a sorted array.
 *
 * @since 1.0
 * @return soreted array of all Custom Hook Boxes from the database if they exist.
 */
function catalyst_get_hooks()
{
	$catalyst_hooks = get_option( 'catalyst_custom_hook_boxes' );
	$catalyst_hook_content = get_option( 'catalyst_custom_hook_box_content' );
	
	if( !empty( $catalyst_hooks ) )
	{
		$custom_hooks = $catalyst_hooks;
		
		$custom_hook_name_compare = array();
		foreach( $custom_hooks as $k => $v )
		{
			if( empty( $custom_hooks_count ) )
			{
				$custom_hooks[$k]['layouts'] = explode( '|', $v['layouts'] );
				$custom_hooks[$k]['hook_textarea'] = stripslashes( $catalyst_hook_content[$custom_hooks[$k]['hook_name']] );
				$custom_hooks_count = true;
				$custom_hook_name_compare[] = $custom_hooks[$k]['hook_name'];
			}
			elseif( in_array( $custom_hooks[$k]['hook_name'], $custom_hook_name_compare ) )
			{
				unset( $custom_hooks[$k] );
			}
			else
			{
				$custom_hooks[$k]['layouts'] = explode( '|', $v['layouts'] );
				$custom_hooks[$k]['hook_textarea'] = stripslashes( $catalyst_hook_content[$custom_hooks[$k]['hook_name']] );
				$custom_hook_name_compare[] = $custom_hooks[$k]['hook_name'];
			}
		}
		$custom_hooks = catalyst_array_sort( $custom_hooks, 'hook_name' );		
		return $custom_hooks;
	}
	else
	{
		return false;
	}
}

/**
 * Update Custom Hook Boxes in the database from current settings posted
 * in the Advanced Options > Custom Hook Boxes admin page.
 *
 * @since 1.0
 */
function catalyst_update_hooks( $names = '', $layouts = '', $hooks = '', $actives = '', $priorities = '', $textareas = '' )
{
	$catalyst_hooks = get_option( 'catalyst_custom_hook_boxes' );
	$these_hooks = array();
	$hook_id_array = array();
	$hook_name_array = array();
	
	if( !empty( $names[1] ) )
	{
		foreach( $names as $key => $value )
		{
			$these_hooks[$key]['name'] = $value;
		}
		if( !empty( $layouts ) )
		{
			foreach( $layouts as $key => $value )
			{
				$these_hooks[$key]['layouts'] = $value;
			}
		}
		if( !empty( $hooks ) )
		{
			foreach( $hooks as $key => $value )
			{
				$these_hooks[$key]['hook'] = $value;
			}
		}
		if( !empty( $actives ) )
		{
			foreach( $actives as $key => $value )
			{
				$these_hooks[$key]['active'] = $value;
			}
		}
		if( !empty( $priorities ) )
		{
			foreach( $priorities as $key => $value )
			{
				$these_hooks[$key]['priority'] = $value;
			}
		}
		if( !empty( $textareas ) )
		{
			foreach( $textareas as $key => $value )
			{
				$these_hooks[$key]['hook_textarea'] = $value;
			}
		}
	}

	if( !empty( $these_hooks ) )
	{
		foreach( $these_hooks as $this_hook )
		{
			$hook_name = $this_hook['name'];
			
			if( empty( $this_hook['layouts'] ) )
			{
				$this_hook['layouts'] = array( 'catalyst_default' );
			}
			
			foreach( $this_hook['layouts'] as $key => $layout_id )
			{
				$hook_id_array[] = $hook_name . '|' . $layout_id;
				if( !in_array( $hook_name, $hook_name_array ) )
				{
					$hook_name_array[] = $hook_name;
				}
			}
		}

		foreach( $catalyst_hooks as $key => $value )
		{
			if( !in_array( $catalyst_hooks[$key]['hook_id'], $hook_id_array ) &&
				in_array( $catalyst_hooks[$key]['hook_name'], $hook_name_array ) )
			{
				unset( $catalyst_hooks[$key] );
			}
		}

		update_option( 'catalyst_custom_hook_boxes', $catalyst_hooks );

		foreach( $these_hooks as $this_hook )
		{
			$catalyst_hook_content = get_option( 'catalyst_custom_hook_box_content' );
			$hook_name = $this_hook['name'];
			$hook_location = $this_hook['hook'];
			$priority = $this_hook['priority'];
			$hook_textarea = htmlspecialchars( $this_hook['hook_textarea'] );
			
			$updated_content_values = array( $hook_name => $hook_textarea );
			$merged_hook_content = array_merge( $catalyst_hook_content, $updated_content_values );
			update_option( 'catalyst_custom_hook_box_content', $merged_hook_content );

			if( !empty( $this_hook['layouts'] ) )
			{
				$layouts = implode( '|', $this_hook['layouts'] );
				$is_active = $this_hook['active'];
			}
			else
			{
				$this_hook['layouts'] = array( 'catalyst_default' );
				$layouts = 'catalyst_default';
				$is_active = 'no';
			}
				
			foreach( $this_hook['layouts'] as $key => $layout_id )
			{
				$catalyst_hooks = get_option( 'catalyst_custom_hook_boxes' );
				$hook_id = $hook_name . '|' . $layout_id;
				$layout_hook = $layout_id . '_' . $hook_location;
				if( !empty( $hook_id ) )
				{
					if( !empty( $catalyst_hooks[$hook_id]['hook_id'] ) && $catalyst_hooks[$hook_id]['hook_id'] == $hook_id )
					{
						$updated_values = array( $hook_id => array( 'hook_id' => $hook_id, 'hook_name' => $catalyst_hooks[$hook_id]['hook_name'], 'layout_id' => $layout_id, 'layouts' => $layouts, 'hook_location' => $hook_location, 'layout_hook' => $layout_hook, 'is_active' => $is_active, 'priority' => $priority ) );
						$merged_hook_box = array_merge( $catalyst_hooks, $updated_values );
						update_option( 'catalyst_custom_hook_boxes', $merged_hook_box );
					}
					else
					{
						$new_hook = array( $hook_id => array( 'hook_id' => $hook_id, 'hook_name' => $hook_name, 'layout_id' => $layout_id, 'layouts' => $layouts, 'hook_location' => $hook_location, 'layout_hook' => $layout_hook, 'is_active' => $is_active, 'priority' => $priority ) );
						$merged_hook_box = array_merge( $catalyst_hooks, $new_hook );
						update_option( 'catalyst_custom_hook_boxes', $merged_hook_box );
					}
				}
			}
		}
	}
}

/**
 * Uses the pre-1.4 Catalyst Custom Hook Box database tables to "filter"/merge pre-1.4
 * Custom Hook Box Export data into the catalyst_custom_hook_box options array.
 *
 * @since 1.4
 */
function catalyst_update_from_old_hook_boxes()
{
	global $wpdb;

	$catalyst_hooks_old_table = $wpdb->prefix . 'catalyst_hooks';
	$catalyst_hooks_old = $wpdb->get_results( "SELECT * FROM `$catalyst_hooks_old_table`", ARRAY_A );
	$catalyst_hooks_new = get_option( 'catalyst_custom_hook_boxes' );
	
	$catalyst_hooks_array = array();
	foreach( $catalyst_hooks_new as $key => $value )
	{
		if( !in_array( $catalyst_hooks_new[$key]['hook_name'], $catalyst_hooks_array ) )
		{
			$catalyst_hooks_array[] = $catalyst_hooks_new[$key]['hook_name'];
		}
	}
	
	$hook_name_check = '';
	foreach( $catalyst_hooks_old as $key => $value )
	{
		$hook_id = $catalyst_hooks_old[$key]['hook_id'];
		$hook_name = $catalyst_hooks_old[$key]['hook_name'];
		$layout_id = $catalyst_hooks_old[$key]['layout_id'];
		$layouts = $catalyst_hooks_old[$key]['layouts'];
		$hook_location = $catalyst_hooks_old[$key]['hook_location'];
		$layout_hook = $catalyst_hooks_old[$key]['layout_hook'];
		$is_active = $catalyst_hooks_old[$key]['is_active'];
		$priority = $catalyst_hooks_old[$key]['priority'];
		$hook_textarea = $catalyst_hooks_old[$key]['hook_textarea'];
		
		$new_hook = array( $hook_id => array( 'hook_id' => $hook_id, 'hook_name' => $hook_name, 'layout_id' => $layout_id, 'layouts' => $layouts, 'hook_location' => $hook_location, 'layout_hook' => $layout_hook, 'is_active' => $is_active, 'priority' => $priority ) );
		$new_hook_content = array( $hook_name => $hook_textarea );
		
		foreach( $new_hook as $key => $value )
		{
			if( !in_array( $hook_name, $catalyst_hooks_array ) || $hook_name_check == $hook_name )
			{
				$hook_name_check = $hook_name;
			}
			else
			{
				unset( $new_hook[$key] );
			}
		}
		foreach( $new_hook_content as $key => $value )
		{
			if( !in_array( $hook_name, $catalyst_hooks_array ) || $hook_name_check == $hook_name )
			{
				$hook_name_check = $hook_name;
			}
			else
			{
				unset( $new_hook_content[$key] );
			}
		}
		
		$catalyst_hooks_new = get_option( 'catalyst_custom_hook_boxes' );
		$merged_hook_box = array_merge( $catalyst_hooks_new, $new_hook );
		update_option( 'catalyst_custom_hook_boxes', $merged_hook_box );
		$catalyst_hook_content_new = get_option( 'catalyst_custom_hook_box_content' );
		$merged_hook_content = array_merge( $catalyst_hook_content_new, $new_hook_content );
		update_option( 'catalyst_custom_hook_box_content', $merged_hook_content );
	}
}

/**
 * Delete Custom Hook Boxes from the database that are posted for deletion
 * in Advanced Options > Custom Hook Boxes.
 * 
 *
 * @since 1.0
 */
add_action( 'wp_ajax_catalyst_hook_delete', 'catalyst_delete_hook' );
function catalyst_delete_hook()
{
	$catalyst_hooks = get_option( 'catalyst_custom_hook_boxes' );
	$catalyst_hook_content = get_option( 'catalyst_custom_hook_box_content' );
	
	$hook_name = $_POST['hook_name'];
	
	foreach( $catalyst_hooks as $key => $value )
	{
		if( in_array( $hook_name, $catalyst_hooks[$key] ) )
		{
			unset( $catalyst_hooks[$key] );
		}
	}

	update_option( 'catalyst_custom_hook_boxes', $catalyst_hooks );
	
	unset( $catalyst_hook_content[$hook_name] );
	
	update_option( 'catalyst_custom_hook_box_content', $catalyst_hook_content );
		
	echo 'deleted';
}

// Allow Custom Hook Boxes to be turned into shortcodes.
add_shortcode( 'catalyst_hook_box', 'catalyst_hook_box_shortcode' );
// Enable shortcodes in Custom Hook Boxe textareas.
add_filter( 'catalyst_hook_box_shortcode', 'do_shortcode' );
/**
 * Determine which Custom Hook Boxes are set to become shortcodes, if any,
 * and then return their textarea content.
 *
 * @since 1.0
 * @return Custom Hook Box textarea content.
 */
function catalyst_hook_box_shortcode( $atts )
{
	extract( shortcode_atts( array(
	"name" => '',
	), $atts ) );
	
	$catalyst_hooks = get_option( 'catalyst_custom_hook_boxes' );
	$catalyst_hook_content = get_option( 'catalyst_custom_hook_box_content' );
	$text = '';
	
	foreach( $catalyst_hooks as $key => $value )
	{
		if( $catalyst_hooks[$key]['hook_name'] == $name && ( $catalyst_hooks[$key]['is_active'] == 'hkd' || $catalyst_hooks[$key]['is_active'] == 'no' ) )
			return;
			
		$text = apply_filters( 'catalyst_hook_box_shortcode', htmlspecialchars_decode( stripslashes( $catalyst_hook_content[$name] ) ) );
	}
	
	// Allow PHP code to execute in Custom Hook Boxes.
	ob_start();
	eval( '?>'.$text);
	$text = ob_get_contents();
	ob_end_clean();
	
	return $text;
}

//end lib/functions/catalyst-hook-boxes.php