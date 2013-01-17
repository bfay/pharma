<?php
add_action( 'widgets_init', 'FT_widget_about_us_load_widgets' );

function FT_widget_about_us_load_widgets() {
	register_widget( 'FT_Widget_About_Us_Widget' );
}

class FT_Widget_About_Us_Widget extends WP_Widget {

	function FT_Widget_About_Us_Widget() {
		$widget_ops = array('classname' => 'about-us-widget', 'description' => 'A widget which allows you to write a few words about yourself.');
		$control_ops = array( 'width' => 400, 'height' => 350, 'id_base' => 'about-us-widget' );
		$this->WP_Widget( 'about-us-widget', THEMENAME.' - About Us', $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract($args);

		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
		$text = apply_filters( 'widget_text', $instance['text'], $instance );

		echo $before_widget;

		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; } ?>

			<div class="textwidget"><?php echo $instance['filter'] ? wpautop($text) : $text; ?></div>
		<?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);

		if ( current_user_can('unfiltered_html') )
			$instance['text'] =  $new_instance['text'];
		else
			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) ); // wp_filter_post_kses() expects slashed

		$instance['filter'] = isset($new_instance['filter']);

		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => 'About Us', 'text' => '', 'filter' => true );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title of your widget:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
		</p>

		<?php if ( current_user_can('unfiltered_html') ) : ?><p>You can use HTML code.</p><?php endif; ?>

		<p>
			<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo esc_textarea($instance['text']); ?></textarea>
		</p>

		<p>
			<input id="<?php echo $this->get_field_id('filter'); ?>" name="<?php echo $this->get_field_name('filter'); ?>" type="checkbox" <?php checked(isset($instance['filter']) ? $instance['filter'] : 0); ?> />&nbsp;<label for="<?php echo $this->get_field_id('filter'); ?>">Automatically add paragraphs</label>
		</p>
<?php
	}

}
?>