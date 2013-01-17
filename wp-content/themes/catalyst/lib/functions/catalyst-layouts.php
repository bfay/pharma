<?php
/**
 * Builds the functions required to create, update, delete and display
 * Custom Layouts in Advanced Options.
 *
 * @package Catalyst
 */

/**
 * Get Custom Layouts from the database, if any exist, and then return
 * them in a sorted array.
 *
 * @since 1.0
 * @return soreted array of all Custom Layouts from the database if they exist.
 */
function catalyst_get_layouts()
{
	$catalyst_layouts = get_option( 'catalyst_custom_layouts' );
	
	if( !empty( $catalyst_layouts ) )
	{
		$custom_layouts = catalyst_array_sort( $catalyst_layouts, 'layout_id' );
		return $custom_layouts;
	}
	else
	{
		return false;
	}
}

/**
 * Get Custom Layouts from the database, if any exist, and then return
 * pairs of Layout types and IDs.
 *
 * @since 1.0
 * @return types and IDs of Custom Layouts from the database if they exist.
 */
function catalyst_get_this_layout_type( $layout_id )
{
	$catalyst_layouts = get_option( 'catalyst_custom_layouts' );

	if( !empty( $catalyst_layouts[$layout_id]['layout_id'] ) && $catalyst_layouts[$layout_id]['layout_id'] == $layout_id )
	{
		return $catalyst_layouts[$layout_id]['type'] . ' ' . $catalyst_layouts[$layout_id]['layout_id'];
	}
	else
	{
		return false;
	}
}

/**
 * Update Custom Layouts in the database from current settings posted
 * in the Advanced Options > Custom Layouts admin page.
 *
 * @since 1.0
 */
function catalyst_update_layouts( $layout_ids, $types )
{
	foreach( $layout_ids as $key => $value )
	{
		$these_layouts[$key]['layout_id'] = $value;
	}
	
	foreach( $types as $key => $value )
	{
		$these_layouts[$key]['type'] = $value;
	}
	
	foreach( $these_layouts as $this_layout )
	{
		$layout_id = $this_layout['layout_id'];
		$type = $this_layout['type'];
		if( $type == 'double-right-sidebar' || $type == 'double-left-sidebar' || $type == 'double-sidebar' )
		{
			if( defined( 'DYNAMIK_ACTIVE' ) )
			{				
				if( catalyst_get_dynamik( 'double_sb_custom_layout_cc_width' ) &&
					catalyst_get_dynamik( 'double_sb_custom_layout_sb1_width' ) &&
					catalyst_get_dynamik( 'double_sb_custom_layout_sb2_width' ) )
				{
					$content_width = catalyst_get_dynamik( 'double_sb_custom_layout_cc_width' );
					$sb1_width = catalyst_get_dynamik( 'double_sb_custom_layout_sb1_width' );
					$sb2_width = catalyst_get_dynamik( 'double_sb_custom_layout_sb2_width' );
				}
				else
				{
					$content_width = 440;
					$sb1_width = 280;
					$sb2_width = 160;
				}
			}
			else
			{
				$content_width = 440;
				$sb1_width = 280;
				$sb2_width = 160;
			}
		}
		elseif( $type == 'right-sidebar' || $type == 'left-sidebar' )
		{
			if( defined( 'DYNAMIK_ACTIVE' ) )
			{
				if( catalyst_get_dynamik( 'single_sb_custom_layout_cc_width' ) &&
					catalyst_get_dynamik( 'single_sb_custom_layout_sb1_width' ) )
				{
					$content_width = catalyst_get_dynamik( 'single_sb_custom_layout_cc_width' );
					$sb1_width = catalyst_get_dynamik( 'single_sb_custom_layout_sb1_width' );
					$sb2_width = 160;
				}
				else
				{
					$content_width = 620;
					$sb1_width = 280;
					$sb2_width = 160;
				}
			}
			else
			{
				$content_width = 620;
				$sb1_width = 280;
				$sb2_width = 160;
			}
		}
		else
		{
			if( defined( 'DYNAMIK_ACTIVE' ) )
			{
				if( catalyst_get_dynamik( 'no_sb_custom_layout_cc_width' ) )
				{
					$content_width = catalyst_get_dynamik( 'no_sb_custom_layout_cc_width' );
					$sb1_width = 280;
					$sb2_width = 160;
				}
				else
				{
					$content_width = 920;
					$sb1_width = 280;
					$sb2_width = 160;
				}
			}
			else
			{
				$content_width = 920;
				$sb1_width = 280;
				$sb2_width = 160;
			}
		}
		if( !empty( $layout_id ) )
		{
			$catalyst_layouts = get_option( 'catalyst_custom_layouts' );
			if( !empty( $catalyst_layouts[$layout_id]['layout_id'] ) && $catalyst_layouts[$layout_id]['layout_id'] == $layout_id )
			{
				$updated_values = array( $layout_id => array( 'layout_id' => $layout_id, 'type' => $type, 'content_width' => $catalyst_layouts[$layout_id]['content_width'], 'sb1_width' => $catalyst_layouts[$layout_id]['sb1_width'], 'sb2_width' => $catalyst_layouts[$layout_id]['sb2_width'] ) );
				$merged_layout = array_merge( $catalyst_layouts, $updated_values );
				update_option( 'catalyst_custom_layouts', $merged_layout );
			}
			else
			{
				$new_layout = array( $layout_id => array( 'layout_id' => $layout_id, 'type' => $type, 'content_width' => $content_width, 'sb1_width' => $sb1_width, 'sb2_width' => $sb2_width ) );
				$merged_layout = array_merge( $catalyst_layouts, $new_layout );
				update_option( 'catalyst_custom_layouts', $merged_layout );
			}
		}
	}
}

/**
 * Update Custom Layout widths in the database with values given in
 * Dynamik Options > Widths.
 *
 * Note: This function is only used by the Dynamik Child Theme.
 *
 * @since 1.0
 */
function catalyst_update_custom_layout_widths( $custom_layout_widths )
{
	foreach( $custom_layout_widths as $this_layout )
	{
		$catalyst_layouts = get_option( 'catalyst_custom_layouts' );
		$layout_id = $this_layout['layout_id'];
		$type = $this_layout['type'];
		$content_width = $this_layout['content_width'];
		
		if( $this_layout['type'] != 'no-sidebar' )
		{
			$sb1_width = $this_layout['sb1_width'];
		}
		else
		{
			$sb1_width = 280;
		}
		if( $this_layout['type'] == 'double-right-sidebar' || $this_layout['type'] == 'double-left-sidebar' || $this_layout['type'] == 'double-sidebar' )
		{
			$sb2_width = $this_layout['sb2_width'];
		}
		else
		{
			$sb2_width = 160;
		}
		
		$update_values = array( $layout_id => array( 'layout_id' => $layout_id, 'type' => $type, 'content_width' => $content_width, 'sb1_width' => $sb1_width, 'sb2_width' => $sb2_width ) );
		$merged_layout = array_merge( $catalyst_layouts, $update_values );
		update_option( 'catalyst_custom_layouts', $merged_layout );
	}
}

/**
 * Uses the pre-1.4 Catalyst Custom Layout database tables to "filter"/merge pre-1.4
 * Custom Layout Export data into the catalyst_custom_layout options array.
 *
 * @since 1.4
 */
function catalyst_update_from_old_layouts()
{
	global $wpdb;

	$catalyst_layouts_old_table = $wpdb->prefix . 'catalyst_layouts';
	$catalyst_layouts_old = $wpdb->get_results( "SELECT * FROM `$catalyst_layouts_old_table`", ARRAY_A );

	foreach( $catalyst_layouts_old as $key => $value )
	{
		$layout_id = $catalyst_layouts_old[$key]['layout_id'];
		$type = $catalyst_layouts_old[$key]['type'];
		$content_width = $catalyst_layouts_old[$key]['content_width'];
		$sb1_width = $catalyst_layouts_old[$key]['sb1_width'];
		$sb2_width = $catalyst_layouts_old[$key]['sb2_width'];
		
		$catalyst_layouts_new = get_option( 'catalyst_custom_layouts' );
		$new_layout = array( $layout_id => array( 'layout_id' => $layout_id, 'type' => $type, 'content_width' => $content_width, 'sb1_width' => $sb1_width, 'sb2_width' => $sb2_width ) );
		
		$catalyst_layouts_array = array();
		foreach( $catalyst_layouts_new as $key => $value )
		{
			$catalyst_layouts_array[] = $catalyst_layouts_new[$key]['layout_id'];
		}
		foreach( $new_layout as $key => $value )
		{	
			if( in_array( $new_layout[$key]['layout_id'], $catalyst_layouts_array ) )
			{
				unset( $new_layout[$key] );
			}
		}
		
		$merged_layout = array_merge( $catalyst_layouts_new, $new_layout );
		update_option( 'catalyst_custom_layouts', $merged_layout );
	}
}

/**
 * Delete Custom Layouts from the database that are posted for deletion
 * in Advanced Options > Custom Layouts.
 * 
 *
 * @since 1.0
 */
add_action( 'wp_ajax_catalyst_layout_delete', 'catalyst_delete_layout' );
function catalyst_delete_layout()
{
	$catalyst_layouts = get_option( 'catalyst_custom_layouts' );
	$layout_id = $_POST['layout_id'];

	unset( $catalyst_layouts[$layout_id] );
	update_option( 'catalyst_custom_layouts', $catalyst_layouts );
	echo 'deleted';
}

/**
 * Build the Custom Layouts drop-down list for various admin drop-down menus.
 *
 * @since 1.0
 */
function catalyst_list_layouts( $selected = '' )
{
	global $catalyst_child_home;

	$catalyst_layouts = get_option( 'catalyst_custom_layouts' );
	
	if( !is_array( $selected ) )
	{
		echo '<option value="catalyst_default"';
		if( $selected == 'catalyst_default' || $selected == '' )
		{
			echo ' selected="selected"';
		}
		echo '>' . __( 'Default', 'catalyst' ) . '</option>';
		if( defined( 'DYNAMIK_ACTIVE' ) && $catalyst_child_home )
		{
			echo '<option class="no-display" value="child_home"';
			if( $selected == 'child_home' )
			{
				echo ' selected="selected"';
			}
			echo '>' . __( 'EZ Static Homepage', 'catalyst' ) . '</option>';
		}
		elseif( defined( 'CHILD_ACTIVE' ) && $catalyst_child_home )
		{
			echo '<option class="no-display" value="child_home"';
			if( $selected == 'child_home' )
			{
				echo ' selected="selected"';
			}
			echo '>' . __( 'Child Theme Static Homepage', 'catalyst' ) . '</option>';
		}
		elseif( defined( 'DYNAMIK_ACTIVE' ) && !$catalyst_child_home )
		{
			echo '<option class="no-display" value="child_home"';
			if( $selected == 'child_home' )
			{
				echo ' selected="selected"';
			}
			echo '>' . __( 'EZ Home Currently Unavailable', 'catalyst' ) . '</option>';
		}
		else
		{
			echo '<option class="no-display" value="child_home"';
			if( $selected == 'child_home' )
			{
				echo ' selected="selected"';
			}
			echo '>' . __( 'Child Home Currently Unavailable', 'catalyst' ) . '</option>';
		}

		if( !empty( $catalyst_layouts ) )
		{
			$layouts = $catalyst_layouts;
			
			foreach( $layouts as $layout_id => $a['layout_id'] )
			{
				$option = '<option value="' . $layout_id . '"';
				
				if( $layout_id == $selected )
				{
					$option .= ' selected="selected"';
				}
				
				$option .= '>' . $layout_id . '</option>';
				
				echo $option;
			}
		}
	}
	elseif( is_array( $selected ) )
	{
		echo '<option value="catalyst_default"';
		if( in_array( 'catalyst_default', $selected ) )
		{
			echo ' selected="selected"';
		}
		echo '>' . __( 'Default', 'catalyst' ) . '</option>';
		if( defined( 'DYNAMIK_ACTIVE' ) && $catalyst_child_home )
		{
			echo '<option class="no-display" value="child_home"';
			if( in_array( 'child_home', $selected ) )
			{
				echo ' selected="selected"';
			}
			echo '>' . __( 'EZ Static Homepage', 'catalyst' ) . '</option>';
		}
		elseif( defined( 'CHILD_ACTIVE' ) && $catalyst_child_home )
		{
			echo '<option class="no-display" value="child_home"';
			if( in_array( 'child_home', $selected ) )
			{
				echo ' selected="selected"';
			}
			echo '>' . __( 'Child Theme Static Homepage', 'catalyst' ) . '</option>';
		}
		elseif( defined( 'DYNAMIK_ACTIVE' ) && !$catalyst_child_home )
		{
			echo '<option class="no-display" value="child_home"';
			if( in_array( 'child_home', $selected ) )
			{
				echo ' selected="selected"';
			}
			echo '>' . __( 'EZ Home Currently Unavailable', 'catalyst' ) . '</option>';
		}
		else
		{
			echo '<option class="no-display" value="child_home"';
			if( in_array( 'child_home', $selected ) )
			{
				echo ' selected="selected"';
			}
			echo '>' . __( 'Child Home Currently Unavailable', 'catalyst' ) . '</option>';
		}

		if( !empty( $catalyst_layouts ) )
		{		
			$layouts = $catalyst_layouts;
			
			foreach( $layouts as $layout_id => $a['layout_id'] )
			{
				$option = '<option value="' . $layout_id . '"';
				
				if( in_array( $layout_id, $selected ) )
				{
					$option .= ' selected="selected"';
				}
				
				$option .= '>' . $layout_id . '</option>';
				
				echo $option;
			}
		}	
	}
}

/**
 * Sort arrays alphabetically.
 *
 * @since 1.0
 * @return arrays sorted alphabetically..
 */
function catalyst_array_sort( $a, $subkey )
{
	foreach( $a as $k => $v ) {
		$b[$k] = strtolower( $v[$subkey] );
	}
	asort( $b );
	foreach( $b as $key => $val ) {
		$c[] = $a[$key];
	}
	return $c;
}

/**
 * Build Custom Layout Types list for various admin drop-down menus.
 *
 * @since 1.0
 */
function catalyst_list_layout_types( $selected = '' )
{
?><option value="double-right-sidebar"<?php if( $selected == 'double-right-sidebar' ) echo ' selected="selected"'; ?>><?php _e( 'Double Right Sidebar', 'catalyst' ); ?></option><option value="double-left-sidebar"<?php if( $selected == 'double-left-sidebar' ) echo ' selected="selected"'; ?>><?php _e( 'Double Left Sidebar', 'catalyst' ); ?></option><option value="right-sidebar"<?php if( $selected == 'right-sidebar' ) echo ' selected="selected"'; ?>><?php _e( 'Right Sidebar', 'catalyst' ); ?></option><option value="left-sidebar"<?php if( $selected == 'left-sidebar' ) echo ' selected="selected"'; ?>><?php _e( 'Left Sidebar', 'catalyst' ); ?></option><option value="double-sidebar"<?php if( $selected == 'double-sidebar' ) echo ' selected="selected"'; ?>><?php _e( 'Double Sidebar', 'catalyst' ); ?></option><option value="no-sidebar"<?php if( $selected == 'no-sidebar' ) echo ' selected="selected"'; ?>><?php _e( 'No Sidebar', 'catalyst' ); ?></option><?php
}

//end lib/functions/catalyst-layouts.php