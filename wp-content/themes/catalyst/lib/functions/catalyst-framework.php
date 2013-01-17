<?php
/**
 * Builds the entire structure of Catalyst's framework.
 *
 * @package Catalyst
 */

/**
 * Build the Catalyst framework HTML.
 *
 * @since 1.0
 */
function catalyst_framework()
{
	global $catalyst_layout_id, $catalyst_child_home;
	
	if( is_front_page() && $catalyst_child_home )
	{
		$display_child_home = true;
	}
	else
	{
		$display_child_home = false;
	}
	
	if( !is_page_template( 'template-blank-canvas.php' ) && !is_page_template( 'template-blank-body.php' ) && !$display_child_home )
	{
		get_header();
		?>

		<div id="container-wrap">
		
			<?php catalyst_hook_before_container( $catalyst_layout_id . '_catalyst_hook_before_container' ); ?>

			<div id="container">
			
				<?php catalyst_hook_before_content_sidebar_wrap( $catalyst_layout_id . '_catalyst_hook_before_content_sidebar_wrap' ); ?>
			
				<div id="content-sidebar-wrap">
				
					<?php catalyst_hook_before_content_wrap( $catalyst_layout_id . '_catalyst_hook_before_content_wrap' ); ?>
					
					<div id="content-wrap">

						<?php catalyst_hook_before_content( $catalyst_layout_id . '_catalyst_hook_before_content' ); ?>
						
						<div id="content" class="hfeed" role="main">
						
						<?php
						catalyst_hook_before_loop( $catalyst_layout_id . '_catalyst_hook_before_loop' );
						catalyst_hook_post_loop( $catalyst_layout_id . '_catalyst_hook_post_loop' );
						catalyst_hook_after_loop( $catalyst_layout_id . '_catalyst_hook_after_loop' );
						?>

						</div><!-- end #content -->
						
						<div style="clear:both;"></div>
						
						<?php catalyst_hook_after_content( $catalyst_layout_id . '_catalyst_hook_after_content' ); ?>

					</div><!-- end #content-wrap -->
					
					<?php catalyst_hook_after_content_wrap( $catalyst_layout_id . '_catalyst_hook_after_content_wrap' ); ?>

				</div><!-- end #content-sidebar-wrap -->
				
				<?php catalyst_hook_after_content_sidebar_wrap( $catalyst_layout_id . '_catalyst_hook_after_content_sidebar_wrap' ); ?>
				
			</div><!-- end #container -->
			
			<div style="clear:both;"></div>
			
			<?php catalyst_hook_after_container( $catalyst_layout_id . '_catalyst_hook_after_container' ); ?>
			
		</div><!-- end #container-wrap -->
		
		<div style="clear:both;"></div>

		<?php
		get_footer();
	}
	elseif( is_page_template( 'template-blank-body.php' ) )
	{
		get_header();
		catalyst_hook_blank_body( $catalyst_layout_id . '_catalyst_hook_blank_body' );
		get_footer();
	}
	elseif( is_page_template( 'template-blank-canvas.php' ) )
	{
		catalyst_hook_widget_areas( $catalyst_layout_id );
		catalyst_hook_hook_boxes( $catalyst_layout_id );
		catalyst_hook_blank_canvas( $catalyst_layout_id . '_catalyst_hook_blank_canvas' );
	}
	elseif( $display_child_home )
	{
		get_header();
		?>
		<div id="home-hook-wrap" class="clearfix">
			<?php catalyst_hook_home( $catalyst_layout_id . '_catalyst_hook_home' ); ?>
		</div><!-- end #home-hook-wrap -->
		<?php
		get_footer();
	}
}

/**
 * Call to get_header() function.
 *
 * NOTE: This function was created to allow backward compatibility
 * width some old Catalyst custom page templates that are still in use.
 *
 * @since 1.3
 */
function catalyst_head()
{
	get_header();
}

/**
 * Call to get_footer() function.
 *
 * NOTE: This function was created to allow backward compatibility
 * width some old Catalyst custom page templates that are still in use.
 *
 * @since 1.3
 */
function catalyst_foot()
{
	get_footer();
}

//end lib/functions/catalyst-framework.php