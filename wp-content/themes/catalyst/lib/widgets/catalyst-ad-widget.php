<?php
/**
 * Builds and registers the Catalyst Ad Widget.
 *
 * @package Catalyst
 */
 
add_action( 'widgets_init', create_function( '', "register_widget( 'catalyst_ad_widget' );" ) );
/**
 * Build the Catayst Ad Widget class and function.
 *
 * @package Catalyst
 * @since 1.0
 */
class catalyst_ad_widget extends WP_Widget {

	function catalyst_ad_widget()
	{
		$widget_setup = array( 'classname' => 'catalyst-ads', 'description' => __( 'Displays 125x125 ads neatly in pairs.', 'catalyst' ) );
		$widget_panel = array( 'width' => 200, 'height' => 250, 'id_base' => 'catalyst-ads' );
		$this->WP_Widget( 'catalyst-ads', __( 'Catalyst | 125x125 Ads', 'catalyst' ), $widget_setup, $widget_panel );
	}

	function widget( $args, $options )
	{
		extract( $args );
		
		$options = wp_parse_args( ( array )$options, array(
			'title' => '',
			'ad_here_url' => '',
			'ad_here_target' => '',
			'ad_code1' => '',
			'ad_code2' => '',
			'ad_code3' => '',
			'ad_code4' => '',
			'ad_code5' => '',
			'ad_code6' => '',
			'ad_code7' => '',
			'ad_code8' => '',
			'ad_code9' => '',
			'ad_code10' => ''
		) );
		
		echo $before_widget;
		
		if( !empty( $options['title'] ) )
			echo $before_title . apply_filters( 'widget_title', $options['title'] ) . $after_title;
			
		if( $options['ad_here_target'] == TRUE )
		{
			$target = ' target="_blank"';
		}
		else
		{
			$target = '';
		}
		
		$catalystadurl = CATALYST_URL;
		
		$content = '<div id="catalyst-125-ads">';
		$content .= '<div><span>' . $options['ad_code1'] . '</span>';
		
		if( !empty( $options['ad_here_url'] ) && empty( $options['ad_code2'] ) )
		{
			$content .= '<span><a href="' . $options['ad_here_url'] . '"' . $target . '><img border="0" src="' . $catalystadurl . '/images/ad-here.png" width="125" height="125" alt=""></a></span></div>';
		}
		else
		{
			$content .= '<span>' . $options['ad_code2'] . '</span></div>';
		}
		
		if( !empty( $options['ad_code3'] ) )
		{
			$content .= '<div class="catalyst-125-ads-inner"><span>' . $options['ad_code3'] . '</span>';
			
			if( !empty( $options['ad_here_url'] ) && empty( $options['ad_code4'] ) )
			{
				$content .= '<span><a href="' . $options['ad_here_url'] . '"' . $target . '><img border="0" src="' . $catalystadurl . '/images/ad-here.png" width="125" height="125" alt=""></a></span></div>';
			}
			else
			{
				$content .= '<span>' . $options['ad_code4'] . '</span></div>';
			}
		}
		
		if( !empty( $options['ad_code5'] ) )
		{
			$content .= '<div class="catalyst-125-ads-inner"><span>' . $options['ad_code5'] . '</span>';
			
			if( !empty( $options['ad_here_url'] ) && empty( $options['ad_code6'] ) )
			{
				$content .= '<span><a href="' . $options['ad_here_url'] . '"' . $target . '><img border="0" src="' . $catalystadurl . '/images/ad-here.png" width="125" height="125" alt=""></a></span></div>';
			}
			else
			{
				$content .= '<span>' . $options['ad_code6'] . '</span></div>';
			}
		}
		
		if( !empty( $options['ad_code7'] ) )
		{
			$content .= '<div class="catalyst-125-ads-inner"><span>' . $options['ad_code7'] . '</span>';
			
			if( !empty( $options['ad_here_url'] ) && empty( $options['ad_code8'] ) )
			{
				$content .= '<span><a href="' . $options['ad_here_url'] . '"' . $target . '><img border="0" src="' . $catalystadurl . '/images/ad-here.png" width="125" height="125" alt=""></a></span></div>';
			}
			else
			{
				$content .= '<span>' . $options['ad_code8'] . '</span></div>';
			}
		}
		
		if( !empty( $options['ad_code9'] ) )
		{
			$content .= '<div class="catalyst-125-ads-inner"><span>' . $options['ad_code9'] . '</span>';
			
			if( !empty( $options['ad_here_url'] ) && empty( $options['ad_code10'] ) )
			{
				$content .= '<span><a href="' . $options['ad_here_url'] . '"' . $target . '><img border="0" src="' . $catalystadurl . '/images/ad-here.png" width="125" height="125" alt=""></a></span></div>';
			}
			else
			{
				$content .= '<span>' . $options['ad_code10'] . '</span></div>';
			}
		}
		
		$content .= '</div>';
		
		echo $content;
		
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
			'ad_here_url' => '',
			'ad_here_target' => '',
			'ad_code1' => '',
			'ad_code2' => '',
			'ad_code3' => '',
			'ad_code4' => '',
			'ad_code5' => '',
			'ad_code6' => '',
			'ad_code7' => '',
			'ad_code8' => '',
			'ad_code9' => '',
			'ad_code10' => ''
		) );
		
	?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title' ); ?>:</label>
				<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $options['title'] ); ?>" style="width:100%;" />
		</p>
		
		<p>
			<?php _e( 'To display an "Advertise Here" banner you have to add your Advertise Page URL below and there must be an ODD number of Banner Ad Code added below.', 'catalyst' ); ?>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Advertise page URL', 'catalyst' ); ?>:</label>
				<textarea id="<?php echo $this->get_field_id( 'ad_here_url' ); ?>" name="<?php echo $this->get_field_name( 'ad_here_url' ); ?>" style="width: 100%;" rows="1"><?php echo htmlspecialchars( $options['ad_here_url'] ); ?></textarea>
		</p>
		
		<p>
			<input id="<?php echo $this->get_field_id( 'ad_here_target' ); ?>" type="checkbox" name="<?php echo $this->get_field_name( 'ad_here_target' ); ?>" value="1" <?php checked( 1, $options['ad_here_target'] ); ?>/> <label for="<?php echo $this->get_field_id( 'ad_here_target' ); ?>"><?php _e( 'Open advertise page in new window?', 'catalyst' ); ?></label>
		</p>
			
		<p><?php _e( 'Paste your 125x125 ad embed code here (up to 10 ads):', 'catalyst' ); ?></p>
		
		<div style="background:#EEEEEE;">
		<p>
			<textarea id="<?php echo $this->get_field_id( 'ad_code1' ); ?>" name="<?php echo $this->get_field_name( 'ad_code1' ); ?>" style="width: 99%;" rows="1"><?php echo htmlspecialchars( $options['ad_code1'] ); ?></textarea>
		</p>
		<p style="margin:-13px 0 0 0; text-align:center; color:#888888;"><?php _e( 'Ad #1 | Ad#2', 'catalyst' ); ?></p>
		<p>
			<textarea id="<?php echo $this->get_field_id( 'ad_code2' ); ?>" name="<?php echo $this->get_field_name( 'ad_code2' ); ?>" style="width: 99%;" rows="1"><?php echo htmlspecialchars( $options['ad_code2'] ); ?></textarea>
		</p>
		</div>
		
		<div style="background:#EEEEEE;">
		<p>
			<textarea id="<?php echo $this->get_field_id( 'ad_code3' ); ?>" name="<?php echo $this->get_field_name( 'ad_code3' ); ?>" style="width: 99%;" rows="1"><?php echo htmlspecialchars( $options['ad_code3'] ); ?></textarea>
		</p>
		<p style="margin:-13px 0 0 0; text-align:center; color:#888888;"><?php _e( 'Ad #3 | Ad#4', 'catalyst' ); ?></p>
		<p>
			<textarea id="<?php echo $this->get_field_id( 'ad_code4' ); ?>" name="<?php echo $this->get_field_name( 'ad_code4' ); ?>" style="width: 99%;" rows="1"><?php echo htmlspecialchars( $options['ad_code4'] ); ?></textarea>
		</p>
		</div>
		
		<div style="background:#EEEEEE;">
		<p>
			<textarea id="<?php echo $this->get_field_id( 'ad_code5' ); ?>" name="<?php echo $this->get_field_name( 'ad_code5' ); ?>" style="width: 99%;" rows="1"><?php echo htmlspecialchars( $options['ad_code5'] ); ?></textarea>
		</p>
		<p style="margin:-13px 0 0 0; text-align:center; color:#888888;"><?php _e( 'Ad #5 | Ad#6', 'catalyst' ); ?></p>
		<p>
			<textarea id="<?php echo $this->get_field_id( 'ad_code6' ); ?>" name="<?php echo $this->get_field_name( 'ad_code6' ); ?>" style="width: 99%;" rows="1"><?php echo htmlspecialchars( $options['ad_code6'] ); ?></textarea>
		</p>
		</div>
		
		<div style="background:#EEEEEE;">
		<p>
			<textarea id="<?php echo $this->get_field_id( 'ad_code7' ); ?>" name="<?php echo $this->get_field_name( 'ad_code7' ); ?>" style="width: 99%;" rows="1"><?php echo htmlspecialchars( $options['ad_code7'] ); ?></textarea>
		</p>
		<p style="margin:-13px 0 0 0; text-align:center; color:#888888;"><?php _e( 'Ad #7 | Ad#8', 'catalyst' ); ?></p>
		<p>
			<textarea id="<?php echo $this->get_field_id( 'ad_code8' ); ?>" name="<?php echo $this->get_field_name( 'ad_code8' ); ?>" style="width: 99%;" rows="1"><?php echo htmlspecialchars( $options['ad_code8'] ); ?></textarea>
		</p>
		</div>
		
		<div style="background:#EEEEEE;">
		<p>
			<textarea id="<?php echo $this->get_field_id( 'ad_code9' ); ?>" name="<?php echo $this->get_field_name( 'ad_code9' ); ?>" style="width: 99%;" rows="1"><?php echo htmlspecialchars( $options['ad_code9'] ); ?></textarea>
		</p>
		<p style="margin:-13px 0 0 0; text-align:center; color:#888888;"><?php _e( 'Ad #9 | Ad#10', 'catalyst' ); ?></p>
		<p>
			<textarea id="<?php echo $this->get_field_id( 'ad_code10' ); ?>" name="<?php echo $this->get_field_name( 'ad_code10' ); ?>" style="width: 99%;" rows="1"><?php echo htmlspecialchars( $options['ad_code10'] ); ?></textarea>
		</p>
		</div>
	<?php 
	}
}

//end lib/widgets/catalyst-ad-widget.php