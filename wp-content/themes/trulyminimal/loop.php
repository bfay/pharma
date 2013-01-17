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

    <?php if(framework_get_option('index_post_thumbnail_type') == 'big') : ?>

	<?php if( post_thumbnail('blog-thumb', false, false, true) ) : ?>
	    <div class="post-thumb"><a href="<?php the_permalink(); ?>"><img src="<?php echo post_thumbnail('blog-thumb'); ?>" width="627" height="278" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" /></a></div>
	<?php endif; ?>

    <?php elseif(framework_get_option('index_post_thumbnail_type') == 'small') : ?>

	<?php if( post_thumbnail('blog-thumb-small', false, false, true) ) : ?>
	    <div class="post-thumb small"><a href="<?php the_permalink(); ?>"><img src="<?php echo post_thumbnail('blog-thumb-small'); ?>" width="200" height="125" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" /></a></div>
	<?php endif; ?>
 
    <?php endif; ?>

    <div class="post-content"><?php the_excerpt(); ?></div>

    <a class="more-link" href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'trulyminimal' ), the_title_attribute( 'echo=0' ) ); ?>"><?php _e( 'Continue reading &rarr;', 'trulyminimal' ); ?></a>

    <div class="clear"></div>
</div><!-- #post-## -->