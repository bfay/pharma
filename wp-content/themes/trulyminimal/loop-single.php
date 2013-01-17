<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<h2 class="post-title"><?php the_title(); ?></h2>

	<div class="post-meta">
		<span class="post-author">
			<?php _e( 'by', 'trulyminimal' ); ?>
			<?php the_author_posts_link(); ?>
		</span><!-- .post-author -->

		<span class="post-date">
			<?php _e( 'on', 'trulyminimal' ); ?>
			<?php echo get_the_date(); ?>,
		</span><!-- .post-author -->

		<span class="post-comments">
			<a href="<?php comments_link(); ?>"><?php comments_number( __('0 comments', 'trulyminimal'), __('1 comment', 'trulyminimal'), __('% comments', 'trulyminimal') ); ?></a>
		</span><!-- .post-author -->
	</div><!-- END .post-meta -->

	<div class="post-content">
		<?php the_content(); ?>

		<div class="clear"></div>

		<?php wp_link_pages( array('before' => '<p><strong>' . __( 'Pages:', 'trulyminimal' ) . '</strong> ', 'after' => '</p>', 'next_or_number' => 'number') ); ?>
	</div><!-- END .post-content -->

	<div class="post-taxonomies">
		<?php _e( 'Categories:', 'trulyminimal' ); ?> <span class="post-categories"><?php the_category(', '); ?></span><?php the_tags('&nbsp;&nbsp;/&nbsp;&nbsp;' . __('Tags:', 'trulyminimal') . ' <span class="post-tags">', ', ', '</span>'); ?> 
	</div><!-- END .post-taxonomies -->

	<div class="clear"></div>
</div><!-- #post-## -->