<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<?php get_template_part( 'loop', 'page' ); ?>

<?php endwhile; ?>

<?php else : ?>

	<?php get_template_part( 'loop', 'error404' ); ?>

<?php endif; ?>