<?php
function themef_pagination() {
	global $wp_query;
	if( $wp_query->max_num_pages > 1) : ?>

	<div class="pagination">
		<div class="clear"></div>
		<div class="alignleft button"><?php next_posts_link( __( '&larr; older entries', 'trulyminimal' ) ) ?></div>
		<div class="alignright button"><?php previous_posts_link( __( 'newer entries &rarr;', 'trulyminimal' ) ) ?></div>
		<div class="clear"></div>
	</div>

	<?php
	endif;
}
?>