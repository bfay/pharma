<?php
/**
 * Builds the footer structure when the BuddyPress plugin is active.
 *
 * @package Catalyst
 */
 
global $catalyst_layout_id;
?>

				<div style="clear:both;"></div>
				
				<?php catalyst_hook_after_content( $catalyst_layout_id . '_catalyst_hook_after_content' ); ?>

			</div><!-- end #content-wrap -->
			
			<?php catalyst_hook_after_content_wrap( $catalyst_layout_id . '_catalyst_hook_after_content_wrap' ); ?>

		</div><!-- end #content-sidebar-wrap -->
		
		<?php catalyst_hook_after_content_sidebar_wrap( $catalyst_layout_id . '_catalyst_hook_after_content_sidebar_wrap' ); ?>
		
	</div><!-- end #container -->
	
	<div style="clear:both;"></div>
	
	<?php catalyst_hook_after_container( $catalyst_layout_id . '_catalyst_hook_after_container' ); ?>
	
</div><!-- end #container_wrap -->

<div style="clear:both;"></div>

<?php
if( !is_page_template( 'template-blank-body.php' ) )
{
catalyst_hook_before_before_footer( $catalyst_layout_id . '_catalyst_hook_before_before_footer' );
catalyst_hook_before_footer( $catalyst_layout_id . '_catalyst_hook_before_footer' );
catalyst_hook_after_before_footer( $catalyst_layout_id . '_catalyst_hook_after_before_footer' );

catalyst_hook_footer( $catalyst_layout_id . '_catalyst_hook_footer' );

catalyst_hook_before_after_footer( $catalyst_layout_id . '_catalyst_hook_before_after_footer' );
catalyst_hook_after_footer( $catalyst_layout_id . '_catalyst_hook_after_footer' );
catalyst_hook_after_after_footer( $catalyst_layout_id . '_catalyst_hook_after_after_footer' );
}

wp_footer();

catalyst_hook_after_html( $catalyst_layout_id . '_catalyst_hook_after_html' );

/**
 * Un-comment the below function to list all items currently hooked into a WordPress or Catalyst hook.
 */
//catalyst_list_hooked();
/**
 * Un-comment the below function to display the number of database queries during the WordPress execution.
 */
//echo get_num_queries();
?>

</body>

</html>