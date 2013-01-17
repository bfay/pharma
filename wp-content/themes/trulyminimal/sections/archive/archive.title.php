<h2 class="archive-title">
	<?php if ( is_day() ) : ?>
		<?php printf( __( 'Daily Archives: <span>%s</span>', 'trulyminimal' ), get_the_date() ); ?>
	<?php elseif ( is_month() ) : ?>
		<?php printf( __( 'Monthly Archives: <span>%s</span>', 'trulyminimal' ), get_the_date( 'F Y' ) ); ?>
	<?php elseif ( is_year() ) : ?>
		<?php printf( __( 'Yearly Archives: <span>%s</span>', 'trulyminimal' ), get_the_date( 'Y' ) ); ?>
	<?php else : ?>
		<?php _e( 'Blog Archives', 'trulyminimal' ); ?>
	<?php endif; ?>
</h2>