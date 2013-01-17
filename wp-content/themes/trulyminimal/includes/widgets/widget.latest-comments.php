<?php
add_action( 'widgets_init', 'FT_widget_latest_comments_load_widgets' );

function FT_widget_latest_comments_load_widgets() {
	register_widget( 'FT_widget_Latest_Comments_Widget' );
}

class FT_widget_Latest_Comments_Widget extends WP_Widget {

	function FT_widget_Latest_Comments_Widget() {
		$widget_ops = array( 'classname' => 'latest-comments-widget', 'description' => 'A widget which displays your latest comments.' );

		$control_ops = array( 'id_base' => 'latest-comments-widget' );

		$this->WP_Widget( 'latest-comments-widget', THEMENAME.' - Latest Comments', $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );
		
		$title = apply_filters('widget_title', $instance['title'] );
		$count = $instance['count'];

		echo $before_widget;
		
		if ( $title )
			echo $before_title . $title . $after_title;

		$latest_comments = get_comments( array('number'    => $count, 'status'    => 'approve'));
		
		echo '<ul>';
		
		foreach($latest_comments as $comment) : ?>
			<li>
				<span class="comment-author"><?php echo $comment->comment_author; ?> - </span>
				<a href="<?php echo get_permalink($comment->comment_post_ID); ?>"><?php echo themef_limit_characters($comment->comment_content, 90); ?></a>
			</li>

		<?php endforeach;
		
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

		$defaults = array( 'title' => 'Latest Comments', 'count' => '4' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title of your widget:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'count' ); ?>">Number of comments:</label>
			<input id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" value="<?php echo $instance['count']; ?>" class="widefat" type="text" />
		</p>		
	<?php
	}
}
?>