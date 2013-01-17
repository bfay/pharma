<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <h2 class="post-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf( esc_attr__( 'Permalink to %s', 'trulyminimal' ), the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a></h2>

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

    <div class="post-content"><?php the_content(__('Continue reading &rarr;', 'trulyminimal')); ?></div>

    <div class="clear"></div>
</div><!-- #post-## -->