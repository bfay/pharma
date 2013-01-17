<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : the_post(); ?>

		<?php if(framework_get_option('index_post_display_full_content'))
			get_template_part( 'loop', 'full' );
		else
			get_template_part( 'loop' );
		?>

	<?php endwhile; ?>
<?php else : ?>

	<?php global $wp_query; if( $wp_query->found_posts == 0 ) : ?>
		<?php get_template_part( 'loop', 'error404' ); ?>
	<?php endif; ?>

<?php endif; ?>