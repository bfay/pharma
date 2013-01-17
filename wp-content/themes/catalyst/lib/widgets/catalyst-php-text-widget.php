<?php
/**
 * Builds and registers the Catalyst PHP Text Widget.
 *
 * @package Catalyst
 */
 
add_action( 'widgets_init', create_function( '', "register_widget( 'catalyst_php_text_widget' );" ) );
/**
 * Build the Catayst PHP Text Widget class and function.
 *
 * @package Catalyst
 * @since 1.0
 */
class catalyst_php_text_widget extends WP_Widget {

	function catalyst_php_text_widget()
	{
		$widget_setup = array( 'classname' => 'php-text', 'description' => __( 'Allows the execution of PHP code', 'catalyst' ) );
		$widget_panel = array( 'width' => 400, 'height' => 350, 'id_base' => 'php-text' );
		$this->WP_Widget( 'php-text', __( 'Catalyst | PHP Text', 'catalyst' ), $widget_setup, $widget_panel );
	}

	function widget( $args, $options )
	{
		extract( $args );
		
		$recovery_mode = 'off';

		$title = apply_filters( 'widget_title', empty( $options['title'] ) ? '' : $options['title'], $options );
		$text = apply_filters( 'widget_execphp', $options['text'], $options );
		
		echo $before_widget;

		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; }
			if( $recovery_mode == 'off' )
			{
				ob_start();
				eval( '?>' . $text );
				$text = ob_get_contents();
				ob_end_clean();
			}
		?>			
			<div class="php-textwidget"><?php echo $options['filter'] ? wpautop( $text ) : $text; ?></div>
		<?php
		
		echo $after_widget;
	}

	function update( $new_options, $old_options )
	{
		$options = $old_options;
		$options['title'] = strip_tags( $new_options['title'] );
		if ( current_user_can( 'unfiltered_html' ) )
			$options['text'] =  $new_options['text'];
		else
			$options['text'] = stripslashes( wp_filter_post_kses( $new_options['text'] ) );
		$options['filter'] = isset( $new_options['filter'] );
		return $options;
	}

	function form( $options )
	{ 
		$options = wp_parse_args( ( array )$options, array( 'title' => '', 'text' => '' ) );
		$title = strip_tags( $options['title'] );
		$text = format_to_edit( $options['text'] );
	?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>

		<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo $text; ?></textarea>

		<p><input id="<?php echo $this->get_field_id( 'filter' ); ?>" name="<?php echo $this->get_field_name( 'filter' ); ?>" type="checkbox" <?php checked( isset( $options['filter'] ) ? $options['filter'] : 0 ); ?> />&nbsp;<label for="<?php echo $this->get_field_id( 'filter' ); ?>"><?php _e( 'Automatically add paragraphs.' ); ?></label></p>
	<?php 
	}
}

//end lib/widgets/catalyst-php-text-widget.php