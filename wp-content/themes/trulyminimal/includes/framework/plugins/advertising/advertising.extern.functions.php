<?php
//Start session
session_start();

/*-------------------------------------------------------------
*   Function to register new zone
*------------------------------------------------------------*/
function frameworkads_register_zone($zones) {
	global $wpdb;

	foreach($zones as $zone) {
		$fields = array();
		$values = array();
		$field_list = "";
		$value_list = "";

		$czone = $wpdb->get_var("SELECT COUNT(*) FROM `".$wpdb->prefix."frameworkads_zones` WHERE `zone_key` = '$zone[zone_key]' LIMIT 1;");

		if($czone < 1) {
			foreach ($zone as $field => $value) {
				$fields[] = '`' . $field . '`';
				$values[] = "'" . mysql_real_escape_string($value) . "'";
			}

			$field_list = join(',', $fields);
			$value_list = join(', ', $values);

			$wpdb->query("INSERT INTO `".$wpdb->prefix."frameworkads_zones` (" . $field_list . ") VALUES (" . $value_list . ")"); 
		}
	}
}

/*-------------------------------------------------------------
*   Function to display default ad
*------------------------------------------------------------*/
function frameworkads_get_display_default($size = '125x125', $count = 0) {
	global $wpdb;

	return '<div class="frameworkad ad-'.$count.'" id="frameworkad-default-'.rand(100,1000).'"><img src="http://placehold.it/' . $size . '/2a2a2a/d3d2d2" alt="Default banner" /></div>';
}

/*-------------------------------------------------------------
*   Function to get ad html code
*------------------------------------------------------------*/
function frameworkads_get_display_ad($id, $count = 0) {
	global $wpdb;

	if($id) {
		$ad = $wpdb->get_results("SELECT * FROM `".$wpdb->prefix."frameworkads` WHERE `ad_id` = '$id' LIMIT 1");

		if($ad) {
			if( !isset($_SESSION['frameworkads_'.$id]) || ($_SESSION['frameworkads_'.$id] <= time()) ) {
				$wpdb->query("UPDATE `".$wpdb->prefix."frameworkads` SET `ad_views` = `ad_views` + 1 WHERE `ad_id` = '$id'");

				$_SESSION["frameworkads_" . $id] = time()+3600;
			}

			if($ad[0]->ad_type == "html") {
				return '<div class="frameworkad ad-'.$count.'" id="frameworkad-'.$ad[0]->ad_id.'">'.stripslashes(htmlspecialchars_decode($ad[0]->ad_code, ENT_QUOTES)).'</div>';
			}

			if($ad[0]->ad_type == "image") {
				return '<div class="frameworkad ad-'.$count.'" id="frameworkad-'.$ad[0]->ad_id.'"><a href="'.$ad[0]->ad_link.'" title="'.$ad[0]->ad_title.'" target="_blank"><img src="'.$ad[0]->ad_code.'" alt="'.$ad[0]->ad_title.'" /></a></div>';
			}
		}
	}

	return false;
}

/*-------------------------------------------------------------
*   Function to display ad
*------------------------------------------------------------*/
function frameworkads_display_ad($id) {
	global $wpdb;

	if($id) {
		$ad = $wpdb->get_results("SELECT * FROM `".$wpdb->prefix."frameworkads` WHERE `ad_id` = '$id'");

		if($ad) {
			return frameworkads_get_display_ad($id);
		}
	}

	return false;
}

/*-------------------------------------------------------------
*   Function to display zone
*------------------------------------------------------------*/
function frameworkads_display_zone($key) {
	global $wpdb;

	$count = 0;

	$now = current_time('timestamp');

	if($key) {
		$zone = $wpdb->get_results("SELECT * FROM `".$wpdb->prefix."frameworkads_zones` WHERE `zone_key` = '$key'");
		
		if($zone) {
			$zone_key = $zone[0]->zone_key;
			$zone_maxads = $zone[0]->zone_maxads;
			$zone_mode = $zone[0]->zone_mode;
			$zone_format = $zone[0]->zone_format;

			$return = "";

			if($zone_mode == "latest") {
				$ads = $wpdb->get_results("SELECT * FROM `".$wpdb->prefix."frameworkads` WHERE `ad_zone` = '$zone_key' AND `ad_active` = 'yes' AND `ad_startshow` <= '$now' AND `ad_endshow` >= '$now' ORDER BY ad_id DESC LIMIT $zone_maxads");
			} elseif($zone_mode == "random") {
				$ads = $wpdb->get_results("SELECT * FROM `".$wpdb->prefix."frameworkads` WHERE `ad_zone` = '$zone_key' AND `ad_active` = 'yes' AND `ad_startshow` <= '$now' AND `ad_endshow` >= '$now' ORDER BY rand() LIMIT $zone_maxads");
			}

			if($ads) {
				foreach($ads as $ad) {
					$count++;
					$return .= frameworkads_get_display_ad($ad->ad_id, $count);
				}


				if( (count($ads) < $zone_maxads) && ($zone_format != "custom") ) {
					for($i = count($ads)+1; $i <= $zone_maxads; $i++) {
						$count++;
						$return .= frameworkads_get_display_default($zone_format, $count);
					}
				}

			} else {
				if($zone_format != "custom") {
					for($i = 1; $i <= $zone_maxads; $i++) {
						$count++;
						$return .= frameworkads_get_display_default($zone_format, $count);
					}
				}
			}

			return $return;
		}
	}

	return false;
}

/*-------------------------------------------------------------
*   Function to check ads and disable them
*------------------------------------------------------------*/
function frameworkads_check_ads() {
	global $wpdb;

	$nextcheck = current_time('timestamp') + 18000;
	$now = current_time('timestamp');

	if(get_option('frameworkads_nextcheck') <= $now) {
		update_option( 'frameworkads_nextcheck', $nextcheck );

		$ads = $wpdb->get_results("SELECT * FROM `".$wpdb->prefix."frameworkads`");
		if($ads) {
			foreach($ads as $ad) {
				if( ($ad->ad_endshow <= $now) ) {
					$id = $ad->ad_id;
					$wpdb->query("UPDATE `".$wpdb->prefix."frameworkads` SET `ad_active` = 'no' WHERE `ad_id` = '$id'");
				}

				if( ($ad->ad_maxclicks <= $ad->ad_clicks) && ($ad->ad_maxclicks != 0) ) {
					$id = $ad->ad_id;
					$wpdb->query("UPDATE `".$wpdb->prefix."frameworkads` SET `ad_active` = 'no' WHERE `ad_id` = '$id'");
				}

				if( ($ad->ad_maxviews <= $ad->ad_views) && ($ad->ad_maxviews != 0) ) {
					$id = $ad->ad_id;
					$wpdb->query("UPDATE `".$wpdb->prefix."frameworkads` SET `ad_active` = 'no' WHERE `ad_id` = '$id'");
				}
			}
		}

		$clicks = $wpdb->get_results("SELECT * FROM `".$wpdb->prefix."frameworkads_clicks`");
		if($clicks) {
			foreach($clicks as $click) {
				$click_id = $click->click_id;
				if($click->click_time + 86400 < $now)
					$wpdb->query("DELETE FROM `".$wpdb->prefix."frameworkads_clicks` WHERE `click_id` = '$click_id'");
			}
		}
	}
}
add_action('init', 'frameworkads_check_ads');

/*-------------------------------------------------------------
*   Add shortcodes
*------------------------------------------------------------*/
function frameworkads_shortcode($atts, $content = null) {
	if(!empty($atts['ad'])) return frameworkads_display_ad($atts['ad']);
	if(!empty($atts['zone'])) return frameworkads_display_zone($atts['zone']);
}
add_shortcode('frameworkads', 'frameworkads_shortcode');

/*-------------------------------------------------------------
*   Function to add javascript in wp_head
*------------------------------------------------------------*/
function frameworkads_load_jsclick() { ?>

	<script type="text/javascript">jQuery(function(){jQuery('.frameworkad').click(function() {var id = jQuery(this).attr("id");var split = id.split("-");jQuery.get("<?php echo FRAMEWORK_DIR_PLUGINS; ?>advertising/advertising.out.php?ad="+split[1]);});});</script>
<?php
}
add_action('wp_footer', 'frameworkads_load_jsclick');
?>