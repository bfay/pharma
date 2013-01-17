<?php global $wp_query, $curauth; ?>
<?php if( $curauth->user_description ) : ?>
<div class="section-about-the-author author-archive">
	<div class="author-avatar">
		<span class="author-avatar-overlay"></span>
		<?php echo get_avatar($curauth->user_email, '77'); ?>
	</div><!-- END .author-avatar -->

	<div class="author-content">
		<h2 class="author-name"><?php echo $curauth->nickname; ?></h2>
		<span class="results">-&nbsp;&nbsp;<?php printf( __( '%s posts', 'trulyminimal' ), $wp_query->found_posts ); ?></span>

		<p><?php echo $curauth->user_description; ?></p>
	</div><!-- END .author-content -->

	<div class="clear"></div>
</div><!-- END .section-about-the-author -->
<?php else : ?>
<h2 class="archive-title">
	<span class="results"><?php printf( __( '%s posts', 'trulyminimal' ), $wp_query->found_posts ); ?></span>

	<?php global $curauth; printf( __( 'Posts by <span>%s</span>', 'trulyminimal' ), $curauth->nickname ); ?>
</h2>
<?php endif; ?>