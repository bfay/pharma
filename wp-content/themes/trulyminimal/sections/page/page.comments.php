<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<?php comments_template( '', true ); ?>
<?php endwhile; ?>
<?php endif; ?>