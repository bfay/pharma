<?php
add_action( 'widgets_init', 'FT_widget_search_load_widgets' );

function FT_widget_search_load_widgets() {
	register_widget( 'FT_widget_Search_Widget' );
}

class FT_widget_Search_Widget extends WP_Widget {

	function FT_widget_Search_Widget() {
		$widget_ops = array( 'classname' => 'widget_search', 'description' => 'A widget which displays the search form.' );

		$control_ops = array( 'id_base' => 'search-widget' );

		$this->WP_Widget( 'search-widget', THEMENAME.' - Search', $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		$default = $instance['default'];

		echo $before_widget; ?>

			<form method="get" id="searchform" action="<?php bloginfo('home'); ?>/">
				<input type="text" name="s" class="s" value="<?php echo $default; ?>" />
				<input type="submit" class="b" value="<?php _e('Search', 'trulyminimal'); ?>" />
			</form>

		<?php echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		
		$instance['default'] = $new_instance['default'];
		
		return $instance;
	}

	function form( $instance ) {

		$defaults = array( 'default' => 'enter search term' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'default' ); ?>">Default text:</label>
			<input id="<?php echo $this->get_field_id( 'default' ); ?>" name="<?php echo $this->get_field_name( 'default' ); ?>" value="<?php echo $instance['default']; ?>" class="widefat" type="text" />
		</p>
	<?php
	}
}
?>