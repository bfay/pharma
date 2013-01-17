<?php
/**
 * Builds the footer structure.
 *
 * @package Catalyst
 */
 
global $catalyst_layout_id;

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