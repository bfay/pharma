<?php
add_action( 'widgets_init', 'FrameworkAds_load_widgets' );

function FrameworkAds_load_widgets() {
	register_widget( 'FrameworkAds_Widget' );
}

class FrameworkAds_Widget extends WP_Widget {
	/*-------------------------------------------------------------
	*   Widget details
	*------------------------------------------------------------*/
	function FrameworkAds_Widget() {
		$widget_ops = array( 'classname' => 'frameworkads', 'description' => 'Enables you to display an Ad or Ad Zone created in the Advertisements panel.' );
		$control_ops = array( 'id_base' => 'frameworkads-widget' );
		$this->WP_Widget( 'frameworkads-widget', THEMENAME.' - Ads', $widget_ops, $control_ops );
	}

	/*-------------------------------------------------------------
	*   Show widget
	*------------------------------------------------------------*/
	function widget( $args, $instance ) {
		extract($args, EXTR_SKIP);

		$title = isset($instance['title']) ? $instance['title'] : false;

		list($mode, $id, $format) = explode("_", $instance['show']);

		echo $before_widget;
		
		if ( $title && $instance['show-title'] )
			echo $before_title . $title . $after_title;

		if($mode == "ad") {
			echo frameworkads_display_ad($id);
		} elseif($mode =="zone") {
			echo '<div class="zone_'.$format.' frameworkadslist">';
			echo frameworkads_display_zone($id);
			echo '</div>';
		}

		echo $after_widget;
	}

	/*-------------------------------------------------------------
	*   Update widget
	*------------------------------------------------------------*/
	function update( $new_instance, $old_instance ) {
		$new_instance = (array) $new_instance;
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['show-title'] = isset($new_instance['show-title']);
		$instance['show'] = $new_instance['show'];

		return $instance;
	}

	/*-------------------------------------------------------------
	*   Widget form
	*------------------------------------------------------------*/
	function form( $instance ) {
		global $wpdb;

		$instance = wp_parse_args( (array) $instance, array( 'title' => 'Ads' ) );
		$title = strip_tags($instance['title']);
		$ads	= $wpdb->get_results("SELECT * FROM `".$wpdb->prefix."frameworkads` WHERE `ad_active` = 'yes'");
		$zones	= $wpdb->get_results("SELECT * FROM `".$wpdb->prefix."frameworkads_zones` WHERE `zone_key` != ''"); ?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title of your widget:</label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>

		<p>
			<input id="<?php echo $this->get_field_id('show-title'); ?>" name="<?php echo $this->get_field_name('show-title'); ?>" type="checkbox" <?php checked(isset($instance['show-title']) ? $instance['show-title'] : 0); ?> />&nbsp;<label for="<?php echo $this->get_field_id('show-title'); ?>">Show title</label>
		</p>

		<p>
		<label for="<?php echo $this->get_field_id('show'); ?>">Select Ad / Zone</label>
		<select class="widefat" id="<?php echo $this->get_field_id('show'); ?>" name="<?php echo $this->get_field_name('show'); ?>">
			<option value="">Select ad / zone</option>
			<optgroup label="Ads">
			<?php foreach($ads as $ad) { ?>
				<option value="ad_<?php echo $ad->ad_id; ?>_x" <?php if ( 'ad_'.$ad->ad_id.'_x' == $instance['show'] ) echo 'selected="selected"'; ?>>&nbsp;&nbsp;&nbsp;<?php echo $ad->ad_title; ?></option>
			<?php } ?>
			</optgroup>
			<optgroup label="Zones">
			<?php foreach($zones as $zone) { ?>
				<option value="zone_<?php echo $zone->zone_key; ?>_<?php echo $zone->zone_format; ?>" <?php if ( 'zone_'.$zone->zone_key.'_'.$zone->zone_format == $instance['show'] ) echo 'selected="selected"'; ?>>&nbsp;&nbsp;&nbsp;<?php echo $zone->zone_name; ?> - <?php echo $zone->zone_format; ?></option>
			<?php } ?>
			</optgroup>
		</select>
		</p>
<?php
	}
}
?>