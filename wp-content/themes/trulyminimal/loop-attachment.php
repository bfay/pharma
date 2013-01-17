<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<h2 class="post-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf( esc_attr__( 'Permalink to %s', 'trulyminimal' ), the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a></h2>

	<div class="post-meta">
		<span class="post-author">
			<?php _e( 'by', 'trulyminimal' ); ?>
			<?php the_author_posts_link(); ?>
		</span><!-- .post-author -->

		<span class="post-date">
			<?php _e( 'on', 'trulyminimal' ); ?>
			<?php echo get_the_date(); ?>
		</span><!-- .post-author -->

		<?php if ( wp_attachment_is_image() ) : ?>
		<span class="post-attachment-size"> | 
			<?php
			$metadata = wp_get_attachment_metadata();
			printf( __( 'Full size is %s pixels', 'trulyminimal' ), sprintf( '<a href="%1$s" title="%2$s" target="_blank">%3$s &times; %4$s</a>', wp_get_attachment_url(), esc_attr( __( 'Link to full-size image', 'trulyminimal' ) ), $metadata['width'], $metadata['height']));
			?>
		</span><!-- .post-attachment-size -->
		<?php endif; ?>
		
	</div><!-- END .post-meta -->

	<div class="post-content">
		<?php if ( ! empty( $post->post_parent ) ) : ?>
			<p><a href="<?php echo get_permalink( $post->post_parent ); ?>" title="<?php echo esc_attr( sprintf( __( 'Return to %s', 'trulyminimal' ), strip_tags( get_the_title( $post->post_parent ) ) ) ); ?>" rel="gallery" style="text-decoration: none;"><?php printf( '&larr; %s', get_the_title( $post->post_parent ) ); ?></a></p>
		<?php endif; ?>

		<?php if ( wp_attachment_is_image() ) :
			$attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
			foreach ( $attachments as $k => $attachment ) {
				if ( $attachment->ID == $post->ID )
					break;
			}
			$k++;
			if ( count( $attachments ) > 1 ) {
				if ( isset( $attachments[ $k ] ) )
					$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
				else
					$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
			} else {
				$next_attachment_url = wp_get_attachment_url();
			} ?>

			<p class="attachment"><a href="<?php echo $next_attachment_url; ?>" title="<?php the_title_attribute(); ?>" rel="attachment"><?php
				$attachment_width  = apply_filters( 'trulyminimal_attachment_size', 900 );
				$attachment_height = apply_filters( 'trulyminimal_attachment_height', 900 );
				echo wp_get_attachment_image( $post->ID, array( $attachment_width, $attachment_height ) );
			?></a></p>
		
			<div class="pagination">
				<div class="nav-previous alignleft"><?php previous_image_link( false ); ?></div>
				<div class="nav-next alignright"><?php next_image_link( false ); ?></div>
				<div class="clear"></div>
			</div><!-- .pagination -->
		<?php else : ?>
			<a href="<?php echo wp_get_attachment_url(); ?>" title="<?php the_title_attribute(); ?>" rel="attachment"><?php echo basename( get_permalink() ); ?></a>
		<?php endif; ?>
	</div><!-- END .post-content -->

</div>
<?php endwhile; ?>