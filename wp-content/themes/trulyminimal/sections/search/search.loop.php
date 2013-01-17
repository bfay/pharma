<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'loop' ); ?>

	<?php endwhile; ?>
<?php else : ?>

	<?php global $wp_query; if( $wp_query->found_posts == 0 ) : ?>
		<?php get_template_part( 'loop', 'error404-search' ); ?>
	<?php endif; ?>

<?php endif; ?>