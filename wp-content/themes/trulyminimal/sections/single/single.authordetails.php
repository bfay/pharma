<?php if( get_the_author_meta('description') ) : ?>
<div class="section-about-the-author">
	<div class="author-avatar">
		<span class="author-avatar-overlay"></span>
		<?php echo get_avatar(get_the_author_email(), '77'); ?>
	</div><!-- END .author-avatar -->

	<div class="author-content">
		<div class="author-name"><?php the_author_posts_link(); ?></div>

		<p><?php echo get_the_author_meta('description'); ?></p>

		<div class="author-posts"><a href="<?php echo get_author_posts_url( get_the_author_meta('ID') ); ?>" title="<?php printf( __( '%1$s Posts', 'trulyminimal' ), get_the_author() ); ?>"><?php _e( 'View all posts &rarr;', 'trulyminimal' ); ?></a></div>
	</div><!-- END .author-content -->

	<div class="clear"></div>
</div><!-- END .section-about-the-author -->
<?php endif; ?>