<?php
/**
 * Builds and registers the Catalyst Author Bio Widget.
 *
 * @package Catalyst
 */
 
add_action( 'widgets_init', create_function( '', "register_widget( 'catalyst_author_bio_widget' );" ) );
/**
 * Build the Catayst Author Bio Widget class and function.
 *
 * @package Catalyst
 * @since 1.0
 */
class catalyst_author_bio_widget extends WP_Widget {

	function catalyst_author_bio_widget()
	{
		$widget_setup = array( 'classname' => 'author-bio', 'description' => __( 'Displays an Author Bio with Gravatar', 'catalyst' ) );
		$widget_panel = array( 'width' => 200, 'height' => 250, 'id_base' => 'author-bio' );
		$this->WP_Widget( 'author-bio', __( 'Catalyst | Author Bio', 'catalyst' ), $widget_setup, $widget_panel );
	}

	function widget( $args, $options )
	{
		extract( $args );
		
		$options = wp_parse_args( ( array )$options, array(
			'title' => '',
			'user' => '',
			'alignment' => 'left',
			'grav-size' => '65',
			'bio' => '',
			'more_page' => ''
		) );
		
		echo $before_widget;
		
			if( !empty( $options['title'] ) )
			{
				echo $before_title . apply_filters( 'widget_title', $options['title'] ) . $after_title;
			}
			
			if( !empty( $options['alignment'] ) && get_avatar( get_the_author_meta( 'user_email' ) ) == TRUE )
			{
				$content = '<span class="align' . esc_attr( $options['alignment'] ) . '">';
			}

				$content .= get_avatar( $options['user'], $options['grav-size'] );
			
			if( !empty( $options['alignment'] ) && get_avatar( get_the_author_meta( 'user_email' ) ) == TRUE )
			{
				$content .= '</span>';
			}
				
			if( !empty( $options['bio'] ) )
			{
				$content .= esc_html( $options['bio'] );
			}
			else
			{
				$content .= get_the_author_meta( 'description', $options['user'] );
			}
				
			$content .= ( $options['more_page'] ) ? ' <a class="pagelink" href="' . get_page_link( $options['more_page'] ) . '">Read more &raquo;</a>' : '';
			
			?>
			<div class="author-bio-widget clearfix"><?php echo wpautop( $content ); ?></div>
			<?php
		
		echo $after_widget;
	}

	function update( $new_options, $old_options )
	{
		return $new_options;
	}

	function form( $options )
	{ 
		$options = wp_parse_args( ( array )$options, array(
			'title' => '',
			'user' => '',
			'alignment' => 'left',
			'grav-size' => '65',
			'bio' => '',
			'more_page' => ''
		) );
		
	?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'catalyst' ); ?>:</label>
				<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $options['title'] ); ?>" style="width:100%;" />
		</p>
		
		<p>
			<?php _e( 'Author:', 'catalyst' ); ?>
			<?php wp_dropdown_users( array( 'name' => $this->get_field_name( 'user' ), 'selected' => $options['user'] ) ); ?><br />

			<label for="<?php echo $this->get_field_id( 'grav-size' ); ?>"><?php _e( 'Author Gravatar Size:', 'catalyst' ); ?></label>
				<select id="<?php echo $this->get_field_id( 'grav-size' ); ?>" name="<?php echo $this->get_field_name( 'grav-size' ); ?>" style="width:65px;">
					<option value="45"<?php selected( '45', $options['grav-size'] ); ?>><?php _e( '45px', 'catalyst' ); ?></option>
					<option value="65"<?php selected( '65', $options['grav-size'] ); ?>><?php _e( '65px', 'catalyst' ); ?></option>
					<option value="85"<?php selected( '85', $options['grav-size'] ); ?>><?php _e( '85px', 'catalyst' ); ?></option>
					<option value="105"<?php selected( '105', $options['grav-size'] ); ?>><?php _e( '105px', 'catalyst' ); ?></option>
					<option value="125"<?php selected( '125', $options['grav-size'] ); ?>><?php _e( '125px', 'catalyst' ); ?></option>
				</select><br />

			<label for="<?php echo $this->get_field_id( 'alignment' ); ?>"><?php _e( 'Gravatar Alignment:', 'catalyst' ); ?></label>
				<select id="<?php echo $this->get_field_id( 'alignment' ); ?>" name="<?php echo $this->get_field_name( 'alignment' ); ?>" style="width:60px;">
					<option value=""><?php _e( 'None', 'catalyst' ); ?></option>
					<option value="left"<?php selected( 'left', $options['alignment'] ); ?>><?php _e( 'Left', 'catalyst' ); ?></option>
					<option value="right"<?php selected( 'right', $options['alignment'] ); ?>><?php _e( 'Right', 'catalyst' ); ?></option>
				</select>
		</p>
		
		<p>
			<?php _e( 'Author Description (if empty the WP User Profile Bio will be used):', 'catalyst' ); ?><br />
			<textarea id="<?php echo $this->get_field_id( 'bio' ); ?>" name="<?php echo $this->get_field_name( 'bio' ); ?>" style="width: 100%;" rows="5"><?php echo htmlspecialchars( $options['bio'] ); ?></textarea>
		</p>
		
		<p>
			<?php _e( 'Add a "Read more" link and connect it to the following Page:', 'catalyst' ); ?><br />
			<?php wp_dropdown_pages( array( 'name' => $this->get_field_name( 'more_page' ), 'show_option_none' => '- None -', 'selected' => $options['more_page'] ) ); ?>
		</p>
	<?php 
	}
}

//end lib/widgets/catalyst-author-bio-widget.php