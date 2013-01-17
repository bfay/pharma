<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<h2 class="post-title"><?php the_title(); ?></h2>

	<div class="post-content">
	    <?php the_content(); ?>

	    <div class="clear"></div>

	    <?php wp_link_pages( array('before' => '<p><strong>' . __( 'Pages:', 'trulyminimal' ) . '</strong> ', 'after' => '</p>', 'next_or_number' => 'number') ); ?>
	</div><!-- END .post-content -->

    <div class="clear"></div>
</div><!-- #post-## -->