<?php
/**
 * Builds the Catalyst Options functions.
 *
 * @package Catalyst
 */
 
/**
 * Get the latest catalyst_core_options array from the database
 * and then cache it, if not otherwise specified, so specific
 * Core Options values (or the entire array) can be efficiently accessed.
 *
 * @since 1.5
 * @return either the entire catalyst_core_options array or a specific key/value.
 */
function catalyst_get_core( $key, $args = false )
{
	// Make the following variables static so they retain their values.
	static $options_cache = array();
	static $options_set = false;
	
	// If the $args variable is not false then process the values provided.
	if( $args )
	{
		// If the $options_cache variable is not an empty array or the $args['cahed'] key is false
		// then update the $options_cache variable with the latest copy of the catalyst_core_options array.
		if( empty( $options_cache ) || !$args['cached'] )
		{
			$options_cache = get_option( 'catalyst_core_options' );
		}
		// If the $args['array'] key is not false then return the entire
		// catalyst_core_options array through the $options_cache variable.
		if( $args['array'] )
		{
			return $options_cache;
		}
		// Otherwise if the $args['array'] key IS false then return nothing.
		// This is useful if you just want to clear the cache (setting the $args['cahed'] key
		// to false, as mentioned above) but don't want to return any actual values.
		else
		{
			return;
		}
	}

	// If $options_cache[$key] is set then stripslash and return the cached value for that key.
	if( isset( $options_cache[$key] ) )
	{
		return is_array( $options_cache[$key] ) ? stripslashes_deep( $options_cache[$key] ) : stripslashes( wp_kses_decode_entities( $options_cache[$key] ) );
	}
	// Otherwise if the $options_set variable is not false, but $options_cache[$key] is NOT set,
	// then give that particular key a blank value and then return it.
	elseif( $options_set )
	{
		$options_cache[$key] = '';
		return $options_cache[$key];
	}
	// Otherwise if none of the above is true then update the $options_cache variable with the
	// latest copy of the catalyst_core_options array and set the $options_set variable to true.
	else
	{
		$options_cache = get_option( 'catalyst_core_options' );
		$options_set = true;
	}
	
	// If $options_cache[$key] is NOT set then give that particular key a blank value.
	if ( !isset( $options_cache[$key] ) )
	{
		$options_cache[$key] = '';
	}
	// Otherwise stripslash the set value.
	else
	{
		$options_cache[$key] = is_array( $options_cache[$key] ) ? stripslashes_deep( $options_cache[$key] ) : stripslashes( wp_kses_decode_entities( $options_cache[$key] ) );
	}

	// Return $options_cache[$key] if it hasn't already been returned above.
	return $options_cache[$key];
}

/**
 * Get the latest catalyst_dynamik_options array from the database
 * and then cache it, if not otherwise specified, so specific
 * Dynamik Options values (or the entire array) can be efficiently accessed.
 *
 * @since 1.5
 * @return either the entire catalyst_dynamik_options array or a specific key/value.
 */
function catalyst_get_dynamik( $key, $args = false )
{
	static $options_cache = array();
	static $options_set = false;
	
	if( $args )
	{
		if( empty( $options_cache ) || !$args['cached'] )
		{
			$options_cache = get_option( 'catalyst_dynamik_options' );
		}
		if( $args['array'] )
		{
			return $options_cache;
		}
		else
		{
			return;
		}
	}

	if( isset( $options_cache[$key] ) )
	{
		return is_array( $options_cache[$key] ) ? stripslashes_deep( $options_cache[$key] ) : stripslashes( wp_kses_decode_entities( $options_cache[$key] ) );
	}
	elseif( $options_set )
	{
		$options_cache[$key] = '';
		return $options_cache[$key];
	}
	else
	{
		$options_cache = get_option( 'catalyst_dynamik_options' );
		$options_set = true;
	}
	
	if ( !isset( $options_cache[$key] ) )
	{
		$options_cache[$key] = '';
	}
	else
	{
		$options_cache[$key] = is_array( $options_cache[$key] ) ? stripslashes_deep( $options_cache[$key] ) : stripslashes( wp_kses_decode_entities( $options_cache[$key] ) );
	}

	return $options_cache[$key];
}

/**
 * Get the latest catalyst_dynamik_alt_options array from the database
 * and then cache it, if not otherwise specified, so specific
 * Dynamik Options values (or the entire array) can be efficiently accessed.
 *
 * @since 1.5
 * @return either the entire catalyst_dynamik_alt_options array or a specific key/value.
 */
function catalyst_get_dynamik_alt( $key, $args = false )
{
	static $options_cache = array();
	static $options_set = false;
	
	if( $args )
	{
		if( empty( $options_cache ) || !$args['cached'] )
		{
			$options_cache = get_option( 'catalyst_dynamik_alt_options' );
		}
		if( $args['array'] )
		{
			return $options_cache;
		}
		else
		{
			return;
		}
	}

	if( isset( $options_cache[$key] ) )
	{
		return is_array( $options_cache[$key] ) ? stripslashes_deep( $options_cache[$key] ) : stripslashes( wp_kses_decode_entities( $options_cache[$key] ) );
	}
	elseif( $options_set )
	{
		$options_cache[$key] = '';
		return $options_cache[$key];
	}
	else
	{
		$options_cache = get_option( 'catalyst_dynamik_alt_options' );
		$options_set = true;
	}
	
	if ( !isset( $options_cache[$key] ) )
	{
		$options_cache[$key] = '';
	}
	else
	{
		$options_cache[$key] = is_array( $options_cache[$key] ) ? stripslashes_deep( $options_cache[$key] ) : stripslashes( wp_kses_decode_entities( $options_cache[$key] ) );
	}

	return $options_cache[$key];
}

/**
 * Get the latest catalyst_responsive_options array from the database
 * and then cache it, if not otherwise specified, so specific
 * Responsive Options values (or the entire array) can be efficiently accessed.
 *
 * @since 1.5
 * @return either the entire catalyst_responsive_options array or a specific key/value.
 */
function catalyst_get_responsive( $key, $args = false )
{
	static $options_cache = array();
	static $options_set = false;
	
	if( $args )
	{
		if( empty( $options_cache ) || !$args['cached'] )
		{
			$options_cache = get_option( 'catalyst_responsive_options' );
		}
		if( $args['array'] )
		{
			return $options_cache;
		}
		else
		{
			return;
		}
	}

	if( isset( $options_cache[$key] ) )
	{
		return is_array( $options_cache[$key] ) ? stripslashes_deep( $options_cache[$key] ) : stripslashes( wp_kses_decode_entities( $options_cache[$key] ) );
	}
	elseif( $options_set )
	{
		$options_cache[$key] = '';
		return $options_cache[$key];
	}
	else
	{
		$options_cache = get_option( 'catalyst_responsive_options' );
		$options_set = true;
	}
	
	if ( !isset( $options_cache[$key] ) )
	{
		$options_cache[$key] = '';
	}
	else
	{
		$options_cache[$key] = is_array( $options_cache[$key] ) ? stripslashes_deep( $options_cache[$key] ) : stripslashes( wp_kses_decode_entities( $options_cache[$key] ) );
	}

	return $options_cache[$key];
}

/**
 * Get the latest catalyst_advanced_options array from the database
 * and then cache it, if not otherwise specified, so specific
 * Advanced Options values (or the entire array) can be efficiently accessed.
 *
 * NOTE: The catalyst_advanced_options array only houses the Custom CSS options
 * and not the Custom Layouts, Widget Areas and Hook Box option/values.
 * These are stored in their own arrays inside the wp_options table.
 *
 * @since 1.5
 * @return either the entire catalyst_advanced_options array or a specific key/value.
 */
function catalyst_get_advanced( $key, $args = false )
{
	static $options_cache = array();
	static $options_set = false;
	
	if( $args )
	{
		if( empty( $options_cache ) || !$args['cached'] )
		{
			$options_cache = get_option( 'catalyst_advanced_options' );
		}
		if( $args['array'] )
		{
			return $options_cache;
		}
		else
		{
			return;
		}
	}

	if( isset( $options_cache[$key] ) )
	{
		return is_array( $options_cache[$key] ) ? stripslashes_deep( $options_cache[$key] ) : stripslashes( wp_kses_decode_entities( $options_cache[$key] ) );
	}
	elseif( $options_set )
	{
		$options_cache[$key] = '';
		return $options_cache[$key];
	}
	else
	{
		$options_cache = get_option( 'catalyst_advanced_options' );
		$options_set = true;
	}
	
	if ( !isset( $options_cache[$key] ) )
	{
		$options_cache[$key] = '';
	}
	else
	{
		$options_cache[$key] = is_array( $options_cache[$key] ) ? stripslashes_deep( $options_cache[$key] ) : stripslashes( wp_kses_decode_entities( $options_cache[$key] ) );
	}

	return $options_cache[$key];
}

//end lib/functions/catalyst-options.php