<h2 class="archive-title">
	<?php global $wp_query; ?>
	<span class="results"><?php printf( __( '%s results', 'trulyminimal' ), $wp_query->found_posts ); ?></span>

	<?php printf( __( 'Search results for <span>%s</span>', 'trulyminimal' ), get_search_query() ); ?>
</h2>