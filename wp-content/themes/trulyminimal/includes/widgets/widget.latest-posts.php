<?php
add_action( 'widgets_init', 'FT_widget_latest_posts_load_widgets' );

function FT_widget_latest_posts_load_widgets() {
	register_widget( 'FT_widget_Latest_Posts_Widget' );
}

class FT_widget_Latest_Posts_Widget extends WP_Widget {

	function FT_widget_Latest_Posts_Widget() {
		$widget_ops = array( 'classname' => 'latest-posts-widget', 'description' => 'A widget which displays latest posts.' );

		$control_ops = array( 'id_base' => 'latest-posts-widget' );

		$this->WP_Widget( 'latest-posts-widget', THEMENAME.' - Latest Posts', $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );
		
		$title = apply_filters('widget_title', $instance['title'] );
		$count = $instance['count'];

		echo $before_widget;
		
		if ( $title )
			echo $before_title . $title . $after_title;

		$args = array( 'showposts' => $count, 'tax_query' => array(array('taxonomy' => 'post_format', 'field' => 'slug', 'terms' => array( 'post-format-status' ), 'operator' => 'NOT IN')) );
		$latest_posts = new WP_Query($args);

		echo '<ul>';

		if( $latest_posts->have_posts() ) { while ($latest_posts->have_posts()) : $latest_posts->the_post(); ?>

			<li>
				<span class="post-date"><?php the_time('d M'); ?> - </span>
				<a href="<?php echo get_permalink(); ?>" title="Read <?php the_title(); ?>" class="post-title"><?php the_title(); ?></a>
			</li>
		
		<? endwhile;
		}

		wp_reset_query();

		echo '</ul>';

		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['count'] = strip_tags( $new_instance['count'] );
		
		return $instance;
	}

	function form( $instance ) {

		$defaults = array( 'title' => 'Latest Posts', 'count' => '4' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title of your widget:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'count' ); ?>">Number of posts:</label>
			<input id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" value="<?php echo $instance['count']; ?>" class="widefat" type="text" />
		</p>		
	<?php
	}
}
?>