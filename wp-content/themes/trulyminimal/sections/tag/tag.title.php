<h2 class="archive-title">
	<?php global $wp_query; ?>
	<span class="results"><?php printf( __( '%s articles', 'trulyminimal' ), $wp_query->found_posts ); ?></span>

	<?php printf( __( 'Tag <span>%s</span>', 'trulyminimal' ), single_tag_title( '', false ) ); ?>
</h2>