<?php
/**
 * Creates the Catalyst Custom Layouts, Widget Areas
 * and Hook Boxes tables.
 *
 * Note: As of Catalyst 1.4 these tables are only used
 * as a kind of "filter" to allow pre-1.4 Core Options
 * Export files to be properl imported into 1.4 or later versions.
 *
 * @package Catalyst
 */
 
/**
 * Create the Catalyst Custom Layouts, Widget Areas and
 * Hook Boxes database tables.
 *
 * NOTE: These tables are no longer used to store current Advanced Option
 * content, but instead are used merely as a way to "filter" pre-1.4
 * Advanced Options Import files. This change took place (eg. the Advanced
 * Options database content being moved into the wp_options table)
 * in version 1.4 of Catalyst.
 *
 * @since 1.0
 */
function catalyst_create_tables()
{
	global $wpdb;
	
	$catalyst_layouts = $wpdb->prefix . 'catalyst_layouts';
	$catalyst_layouts_create = "
	CREATE TABLE IF NOT EXISTS `$catalyst_layouts` (
		`layout_id` varchar(255) NOT NULL,
		`type` varchar(255) NOT NULL,
		`content_width` varchar(255) NOT NULL,
		`sb1_width` varchar(255) NOT NULL,
		`sb2_width` varchar(255) NOT NULL,
		PRIMARY KEY  (`layout_id`)
	);";
	$wpdb->query( $catalyst_layouts_create );
	
	$catalyst_widgets = $wpdb->prefix . 'catalyst_widgets';
	$catalyst_widgets_create = "
	CREATE TABLE IF NOT EXISTS `$catalyst_widgets` (
		`widget_id` varchar(255) NOT NULL,
		`widget_name` varchar(255) NOT NULL,
		`layout_id` varchar(255) NOT NULL,
		`layouts` text NOT NULL,
		`hook_location` varchar(255) NOT NULL,
		`layout_hook` varchar(255) NOT NULL,
		`class` varchar(255) NOT NULL,
		`is_active` varchar(3) NOT NULL,
		`priority` varchar(3) NOT NULL,
		PRIMARY KEY (`widget_id`)
	);";
	$wpdb->query( $catalyst_widgets_create );
	
	$catalyst_hooks = $wpdb->prefix . 'catalyst_hooks';
	$catalyst_hooks_create = "
	CREATE TABLE IF NOT EXISTS `$catalyst_hooks` (
		`hook_id` varchar(255) NOT NULL,
		`hook_name` varchar(255) NOT NULL,
		`layout_id` varchar(255) NOT NULL,
		`layouts` text NOT NULL,
		`hook_location` varchar(255) NOT NULL,
		`layout_hook` varchar(255) NOT NULL,
		`class` varchar(255) NOT NULL,
		`is_active` varchar(3) NOT NULL,
		`priority` varchar(3) NOT NULL,
		`hook_textarea` text NOT NULL,
		PRIMARY KEY (`hook_id`)
	);";
	$wpdb->query( $catalyst_hooks_create );
}

//end lib/functions/catalyst-create-tables.php