<?php
/**
 * Create the many hooks that are used in Catalyst.
 *
 * @package Catalyst
 */
 
/**
 * Stupid hooks - Typical WordPress Hook - Mostly for internal use by Catalyst.
 */
function catalyst_doctype() { do_action( 'catalyst_doctype' ); }
function catalyst_site_title() { do_action( 'catalyst_site_title' ); }
function catalyst_meta() { do_action( 'catalyst_meta' ); }

/**
 * Smart hooks - They know which Layout is being used.
 */
function catalyst_hook_before_before_header( $catalyst_this_hook ) { do_action( 'catalyst_hook_before_before_header', $catalyst_this_hook ); }
function catalyst_hook_after_before_header( $catalyst_this_hook ) { do_action( 'catalyst_hook_after_before_header', $catalyst_this_hook ); }
function catalyst_hook_before_after_header( $catalyst_this_hook ) { do_action( 'catalyst_hook_before_after_header', $catalyst_this_hook ); }
function catalyst_hook_after_after_header( $catalyst_this_hook ) { do_action( 'catalyst_hook_after_after_header', $catalyst_this_hook ); }
function catalyst_hook_before_before_footer( $catalyst_this_hook ) { do_action( 'catalyst_hook_before_before_footer', $catalyst_this_hook ); }
function catalyst_hook_after_before_footer( $catalyst_this_hook ) { do_action( 'catalyst_hook_after_before_footer', $catalyst_this_hook ); }
function catalyst_hook_before_after_footer( $catalyst_this_hook ) { do_action( 'catalyst_hook_before_after_footer', $catalyst_this_hook ); }
function catalyst_hook_after_after_footer( $catalyst_this_hook ) { do_action( 'catalyst_hook_after_after_footer', $catalyst_this_hook ); }

function catalyst_hook_blank_canvas( $catalyst_this_hook ) { do_action( 'catalyst_hook_blank_canvas', $catalyst_this_hook ); }
function catalyst_hook_blank_body( $catalyst_this_hook ) { do_action( 'catalyst_hook_blank_body', $catalyst_this_hook ); }
function catalyst_hook_blank_content( $catalyst_this_hook ) { do_action( 'catalyst_hook_blank_content', $catalyst_this_hook ); }

function catalyst_hook_in_head( $catalyst_this_hook ) { do_action( 'catalyst_hook_in_head', $catalyst_this_hook ); }
function catalyst_hook_before_html( $catalyst_this_hook ) { do_action( 'catalyst_hook_before_html', $catalyst_this_hook ); }
function catalyst_hook_after_html( $catalyst_this_hook ) { do_action( 'catalyst_hook_after_html', $catalyst_this_hook ); }

function catalyst_hook_before_header( $catalyst_this_hook ) { do_action( 'catalyst_hook_before_header', $catalyst_this_hook ); }
function catalyst_hook_header( $catalyst_this_hook ) { do_action( 'catalyst_hook_header', $catalyst_this_hook ); }
function catalyst_hook_in_header( $catalyst_this_hook ) { do_action( 'catalyst_hook_in_header', $catalyst_this_hook ); }
function catalyst_hook_after_header( $catalyst_this_hook ) { do_action( 'catalyst_hook_after_header', $catalyst_this_hook ); }

function catalyst_hook_header_title( $catalyst_this_hook ) { do_action( 'catalyst_hook_header_title', $catalyst_this_hook ); }
function catalyst_hook_header_tagline( $catalyst_this_hook ) { do_action( 'catalyst_hook_header_tagline', $catalyst_this_hook ); }
function catalyst_hook_header_right( $catalyst_this_hook ) { do_action( 'catalyst_hook_header_right', $catalyst_this_hook ); }

function catalyst_hook_before_container( $catalyst_this_hook ) { do_action( 'catalyst_hook_before_container', $catalyst_this_hook ); }
function catalyst_hook_after_container( $catalyst_this_hook ) { do_action( 'catalyst_hook_after_container', $catalyst_this_hook ); }

function catalyst_hook_before_content_sidebar_wrap( $catalyst_this_hook ) { do_action( 'catalyst_hook_before_content_sidebar_wrap', $catalyst_this_hook ); }
function catalyst_hook_after_content_sidebar_wrap( $catalyst_this_hook ) { do_action( 'catalyst_hook_after_content_sidebar_wrap', $catalyst_this_hook ); }

function catalyst_hook_before_content_wrap( $catalyst_this_hook ) { do_action( 'catalyst_hook_before_content_wrap', $catalyst_this_hook ); }
function catalyst_hook_after_content_wrap( $catalyst_this_hook ) { do_action( 'catalyst_hook_after_content_wrap', $catalyst_this_hook ); }

function catalyst_hook_before_content( $catalyst_this_hook ) { do_action( 'catalyst_hook_before_content', $catalyst_this_hook ); }
function catalyst_hook_after_content( $catalyst_this_hook ) { do_action( 'catalyst_hook_after_content', $catalyst_this_hook ); }

function catalyst_hook_before_loop( $catalyst_this_hook ) { do_action( 'catalyst_hook_before_loop', $catalyst_this_hook ); }
function catalyst_hook_post_loop( $catalyst_this_hook ) { do_action( 'catalyst_hook_post_loop', $catalyst_this_hook ); }
function catalyst_hook_after_loop( $catalyst_this_hook ) { do_action( 'catalyst_hook_after_loop', $catalyst_this_hook ); }

function catalyst_hook_after_endwhile( $catalyst_this_hook ) { do_action( 'catalyst_hook_after_endwhile', $catalyst_this_hook ); }
function catalyst_hook_loop_else( $catalyst_this_hook ) { do_action( 'catalyst_hook_loop_else', $catalyst_this_hook ); }

function catalyst_hook_home( $catalyst_this_hook ) { do_action( 'catalyst_hook_home', $catalyst_this_hook ); }
function catalyst_hook_before_ez_home( $catalyst_this_hook ) { do_action( 'catalyst_hook_before_ez_home', $catalyst_this_hook ); }
function catalyst_hook_after_ez_home( $catalyst_this_hook ) { do_action( 'catalyst_hook_after_ez_home', $catalyst_this_hook ); }

function catalyst_hook_before_post( $catalyst_this_hook ) { do_action( 'catalyst_hook_before_post', $catalyst_this_hook ); }
function catalyst_hook_after_post( $catalyst_this_hook ) { do_action( 'catalyst_hook_after_post', $catalyst_this_hook ); }

function catalyst_hook_before_post_content( $catalyst_this_hook ) { do_action( 'catalyst_hook_before_post_content', $catalyst_this_hook ); }
function catalyst_hook_post_content( $catalyst_this_hook ) { do_action( 'catalyst_hook_post_content', $catalyst_this_hook ); }
function catalyst_hook_after_post_content( $catalyst_this_hook ) { do_action( 'catalyst_hook_after_post_content', $catalyst_this_hook ); }

function catalyst_hook_before_post_title( $catalyst_this_hook ) { do_action( 'catalyst_hook_before_post_title', $catalyst_this_hook ); }
function catalyst_hook_post_title( $catalyst_this_hook ) { do_action( 'catalyst_hook_post_title', $catalyst_this_hook ); }
function catalyst_hook_after_post_title( $catalyst_this_hook ) { do_action( 'catalyst_hook_after_post_title', $catalyst_this_hook ); }

function catalyst_hook_before_comments( $catalyst_this_hook ) { do_action( 'catalyst_hook_before_comments', $catalyst_this_hook ); }
function catalyst_hook_comments( $catalyst_this_hook ) { do_action( 'catalyst_hook_comments', $catalyst_this_hook ); }
function catalyst_hook_after_comments( $catalyst_this_hook ) { do_action( 'catalyst_hook_after_comments', $catalyst_this_hook ); }

function catalyst_hook_before_trackbacks( $catalyst_this_hook ) { do_action( 'catalyst_hook_before_trackbacks', $catalyst_this_hook ); }
function catalyst_hook_trackbacks( $catalyst_this_hook ) { do_action( 'catalyst_hook_trackbacks', $catalyst_this_hook ); }
function catalyst_hook_after_trackbacks( $catalyst_this_hook ) { do_action( 'catalyst_hook_after_trackbacks', $catalyst_this_hook ); }

function catalyst_hook_before_comment_form( $catalyst_this_hook ) { do_action( 'catalyst_hook_before_comment_form', $catalyst_this_hook ); }
function catalyst_hook_comment_form( $catalyst_this_hook ) { do_action( 'catalyst_hook_comment_form', $catalyst_this_hook ); }
function catalyst_hook_after_comment_form( $catalyst_this_hook ) { do_action( 'catalyst_hook_after_comment_form', $catalyst_this_hook ); }

function catalyst_hook_before_dual_sidebars( $catalyst_this_hook ) { do_action( 'catalyst_hook_before_dual_sidebars', $catalyst_this_hook ); }
function catalyst_hook_after_dual_sidebars( $catalyst_this_hook ) { do_action( 'catalyst_hook_after_dual_sidebars', $catalyst_this_hook ); }

function catalyst_hook_before_sidebar_1( $catalyst_this_hook ) { do_action( 'catalyst_hook_before_sidebar_1', $catalyst_this_hook ); }
function catalyst_hook_after_sidebar_1( $catalyst_this_hook ) { do_action( 'catalyst_hook_after_sidebar_1', $catalyst_this_hook ); }

function catalyst_hook_before_sidebar_2( $catalyst_this_hook ) { do_action( 'catalyst_hook_before_sidebar_2', $catalyst_this_hook ); }
function catalyst_hook_after_sidebar_2( $catalyst_this_hook ) { do_action( 'catalyst_hook_after_sidebar_2', $catalyst_this_hook ); }

function catalyst_hook_before_excerpt_widget( $catalyst_this_hook ) { do_action( 'catalyst_hook_before_excerpt_widget', $catalyst_this_hook ); }
function catalyst_hook_before_excerpt_widget_title( $catalyst_this_hook ) { do_action( 'catalyst_hook_before_excerpt_widget_title', $catalyst_this_hook ); }
function catalyst_hook_after_excerpt_widget_title( $catalyst_this_hook ) { do_action( 'catalyst_hook_after_excerpt_widget_title', $catalyst_this_hook ); }
function catalyst_hook_before_excerpt_widget_content( $catalyst_this_hook ) { do_action( 'catalyst_hook_before_excerpt_widget_content', $catalyst_this_hook ); }
function catalyst_hook_excerpt_widget_post_meta( $catalyst_this_hook ) { do_action( 'catalyst_hook_excerpt_widget_post_meta', $catalyst_this_hook ); }
function catalyst_hook_after_excerpt_widget_content( $catalyst_this_hook ) { do_action( 'catalyst_hook_after_excerpt_widget_content', $catalyst_this_hook ); }
function catalyst_hook_after_excerpt_widget( $catalyst_this_hook ) { do_action( 'catalyst_hook_after_excerpt_widget', $catalyst_this_hook ); }

function catalyst_hook_before_footer( $catalyst_this_hook ) { do_action( 'catalyst_hook_before_footer', $catalyst_this_hook ); }
function catalyst_hook_footer( $catalyst_this_hook ) { do_action( 'catalyst_hook_footer', $catalyst_this_hook ); }
function catalyst_hook_in_footer( $catalyst_this_hook ) { do_action( 'catalyst_hook_in_footer', $catalyst_this_hook ); }
function catalyst_hook_after_footer( $catalyst_this_hook ) { do_action( 'catalyst_hook_after_footer', $catalyst_this_hook ); }

/**
 * Build an options list of Catalyst hooks.
 *
 * @since 1.0
 */
function catalyst_list_hooks( $selected = '' )
{
	$catalyst_hooks = array(
		'-- Page Hooks --' => array(
			'catalyst_hook_in_head',
			'catalyst_hook_before_html',
			'catalyst_hook_after_html',
			'catalyst_hook_blank_content',
			'catalyst_hook_blank_body',
			'catalyst_hook_blank_canvas'			
		),
		'-- Header Hooks --' => array(
			'catalyst_hook_before_before_header',
			'catalyst_hook_before_header',
			'catalyst_hook_after_before_header',
			'catalyst_hook_header',
			'catalyst_hook_in_header',
			'catalyst_hook_before_after_header',
			'catalyst_hook_after_header',
			'catalyst_hook_after_after_header',
			'catalyst_hook_header_title',
			'catalyst_hook_header_tagline',
			'catalyst_hook_header_right'
		),
		'-- Content Hooks --' => array(
			'catalyst_hook_before_container',
			'catalyst_hook_after_container',
			'catalyst_hook_before_content_sidebar_wrap',
			'catalyst_hook_after_content_sidebar_wrap',
			'catalyst_hook_before_content_wrap',
			'catalyst_hook_after_content_wrap',
			'catalyst_hook_before_content',
			'catalyst_hook_after_content',
			'catalyst_hook_before_loop',
			'catalyst_hook_post_loop',
			'catalyst_hook_after_loop',
			'catalyst_hook_after_endwhile',
			'catalyst_hook_loop_else',
			'catalyst_hook_home',
			'catalyst_hook_before_ez_home',
			'catalyst_hook_after_ez_home',
			'catalyst_hook_before_post',
			'catalyst_hook_after_post',
			'catalyst_hook_before_post_content',
			'catalyst_hook_post_content',
			'catalyst_hook_after_post_content',
			'catalyst_hook_before_post_title',
			'catalyst_hook_post_title',
			'catalyst_hook_after_post_title'
		),
		'-- Comment Hooks --' => array(
			'catalyst_hook_before_comments',
			'catalyst_hook_comments',
			'catalyst_hook_after_comments',
			'catalyst_hook_before_trackbacks',
			'catalyst_hook_trackbacks',
			'catalyst_hook_after_trackbacks',
			'catalyst_hook_before_comment_form',
			'catalyst_hook_comment_form',
			'catalyst_hook_after_comment_form'
		),
		'-- Sidebar Hooks --' => array(
			'catalyst_hook_before_dual_sidebars',
			'catalyst_hook_after_dual_sidebars',
			'catalyst_hook_before_sidebar_1',
			'catalyst_hook_after_sidebar_1',
			'catalyst_hook_before_sidebar_2',
			'catalyst_hook_after_sidebar_2'
		),
		'-- Excerpt Widget Hooks --' => array(
			'catalyst_hook_before_excerpt_widget',
			'catalyst_hook_before_excerpt_widget_title',
			'catalyst_hook_after_excerpt_widget_title',
			'catalyst_hook_before_excerpt_widget_content',
			'catalyst_hook_excerpt_widget_post_meta',
			'catalyst_hook_after_excerpt_widget_content',
			'catalyst_hook_after_excerpt_widget'
		),
		'-- Footer Hooks --' => array(
			'catalyst_hook_before_before_footer',
			'catalyst_hook_before_footer',
			'catalyst_hook_after_before_footer',
			'catalyst_hook_footer',
			'catalyst_hook_in_footer',
			'catalyst_hook_before_after_footer',
			'catalyst_hook_after_footer',
			'catalyst_hook_after_after_footer'
		)
	);
	
	foreach( $catalyst_hooks as $optgroup => $options )
	{
		echo '<optgroup style="font-size:14px;color:#57A18D;" label="' . $optgroup . '">';
		foreach( $options as $option )
		{
			$output = '<option style="color:#000000;" value="' . $option . '"';
				
			if( $option == $selected )
			{
				$output .= ' selected="selected"';
			}

			$output .= '>' . $option . '</option>';
			
			echo $output;
		}
		echo '</optgroup>';
	}
}

/**
 * Un-comment the below add_action to highlight and label all hooks on your site in yellow.
 */
//add_action( 'init', 'catalyst_highlight_hooks' );
/**
 * Build Catalyst hook highlight functionality/array.
 *
 * @since 1.0
 */
function catalyst_highlight_hooks()
{
	$catalyst_hooks = array(
		'catalyst_hook_before_html',
		'catalyst_hook_after_html',
		'catalyst_hook_blank_content',
		'catalyst_hook_blank_body',
		'catalyst_hook_blank_canvas',
		'catalyst_hook_before_before_header',
		'catalyst_hook_before_header',
		'catalyst_hook_after_before_header',
		'catalyst_hook_header',
		'catalyst_hook_in_header',
		'catalyst_hook_before_after_header',
		'catalyst_hook_after_header',
		'catalyst_hook_after_after_header',
		'catalyst_hook_header_title',
		'catalyst_hook_header_tagline',
		'catalyst_hook_header_right',
		'catalyst_hook_before_container',
		'catalyst_hook_after_container',
		'catalyst_hook_before_content_sidebar_wrap',
		'catalyst_hook_after_content_sidebar_wrap',
		'catalyst_hook_before_content_wrap',
		'catalyst_hook_after_content_wrap',
		'catalyst_hook_before_content',
		'catalyst_hook_after_content',
		'catalyst_hook_before_loop',
		'catalyst_hook_post_loop',
		'catalyst_hook_after_loop',
		'catalyst_hook_after_endwhile',
		'catalyst_hook_loop_else',
		'catalyst_hook_home',
		'catalyst_hook_before_ez_home',
		'catalyst_hook_after_ez_home',
		'catalyst_hook_before_post',
		'catalyst_hook_after_post',
		'catalyst_hook_before_post_content',
		'catalyst_hook_post_content',
		'catalyst_hook_after_post_content',
		'catalyst_hook_before_post_title',
		'catalyst_hook_post_title',
		'catalyst_hook_after_post_title',
		'catalyst_hook_before_comments',
		'catalyst_hook_comments',
		'catalyst_hook_after_comments',
		'catalyst_hook_before_trackbacks',
		'catalyst_hook_trackbacks',
		'catalyst_hook_after_trackbacks',
		'catalyst_hook_before_comment_form',
		'catalyst_hook_comment_form',
		'catalyst_hook_after_comment_form',
		'catalyst_hook_before_dual_sidebars',
		'catalyst_hook_after_dual_sidebars',
		'catalyst_hook_before_sidebar_1',
		'catalyst_hook_after_sidebar_1',
		'catalyst_hook_before_sidebar_2',
		'catalyst_hook_after_sidebar_2',
		'catalyst_hook_before_excerpt_widget',
		'catalyst_hook_before_excerpt_widget_title',
		'catalyst_hook_after_excerpt_widget_title',
		'catalyst_hook_before_excerpt_widget_content',
		'catalyst_hook_excerpt_widget_post_meta',
		'catalyst_hook_after_excerpt_widget_content',
		'catalyst_hook_after_excerpt_widget',
		'catalyst_hook_before_before_footer',
		'catalyst_hook_before_footer',
		'catalyst_hook_after_before_footer',
		'catalyst_hook_footer',
		'catalyst_hook_in_footer',
		'catalyst_hook_before_after_footer',
		'catalyst_hook_after_footer',
		'catalyst_hook_after_after_footer'
	);
	
	foreach( $catalyst_hooks as $hook_name )
	{
		add_action( $hook_name, 'catalyst_hook_name_echo', 1, 1);
	}
}

/**
 * Build function to highlight and label Catalyst hooks.
 *
 * @since 1.0
 */
function catalyst_hook_name_echo( $layout_hook )
{
	$hook = str_replace( 'catalyst_default_', '', $layout_hook );
	$output = '<div style="background:#FEFB77;border:1px solid #CC0000;text-align:center;font-size:10px;">' . $hook . '</div>';
	echo $output;
}

/**
 * List all items currently hooked into a WordPress or Catalyst hook.
 *
 * @since 1.0
 */
function catalyst_list_hooked( $tag=false )
{
	global $wp_filter;
	
	if( $tag )
	{
		$hook[$tag] = $wp_filter[$tag];
		if( !is_array( $hook[$tag] ) )
		{
			trigger_error( "Nothing found for '$tag' hook", E_USER_WARNING );
			return;
		}
	}
	else
	{
		$hook=$wp_filter;
		ksort( $hook );
	}
	
	echo '<pre>';
	foreach( $hook as $tag => $priority )
	{
		echo "<br />&gt;&gt;&gt;&gt;&gt;\t<strong>$tag</strong><br />";
		ksort( $priority );
		foreach( $priority as $priority => $function )
		{
			echo $priority;
			foreach( $function as $name => $properties ) echo "\t$name<br />";
		}
	}
	echo '</pre>';
	return;
}

//end lib/functions/catalyst-hooks.php