<?php
add_action( 'widgets_init', 'FT_widget_tags_load_widgets' );

function FT_widget_tags_load_widgets() {
	register_widget( 'FT_widget_Tags_Widget' );
}

class FT_widget_Tags_Widget extends WP_Widget {

	function FT_widget_Tags_Widget() {
		$widget_ops = array( 'classname' => 'tags-widget', 'description' => 'A widget which displays the post tags.' );

		$control_ops = array( 'id_base' => 'tags-widget' );

		$this->WP_Widget( 'tags-widget', THEMENAME.' - Tags', $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract($args);

		$title = apply_filters('widget_title', $instance['title'] );

		$max = $instance['max'];
		
		if($max == "") $max = 0;

		echo $before_widget;

		if ( $title )
			echo $before_title . $title . $after_title;

		$tags = array('order' => 'DESC', 'number' => $max, 'orderby' => 'count');

		echo '<div class="tagcloud">';
			wp_tag_cloud( apply_filters('widget_tag_cloud_args', $tags ) );
		echo "</div>\n";





		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance['title'] = strip_tags(stripslashes($new_instance['title']));
		$instance['max'] = strip_tags( $new_instance['max'] );
		return $instance;
	}

	function form( $instance ) {

		$defaults = array( 'title' => 'Tags' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title of your widget:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'max' ); ?>">Maximum tags: (leave blank for all)</label>
			<input id="<?php echo $this->get_field_id( 'max' ); ?>" name="<?php echo $this->get_field_name( 'max' ); ?>" value="<?php echo $instance['max']; ?>" class="widefat" type="text" />
		</p>

	<?php
	}

}

?>