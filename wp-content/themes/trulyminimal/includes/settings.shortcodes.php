<?php
/*-------------------------------------------------------------
*   Related posts Shortcode
*------------------------------------------------------------*/
function themef_related_posts_shortcode( $atts ) {
	extract(shortcode_atts(array(
		'limit' => '5',
	), $atts));

	global $wpdb, $post, $table_prefix;

	if ($post->ID) {
		$retval = '<ul>';
		$tags = wp_get_post_tags($post->ID);
		$tagsarray = array();

		foreach ($tags as $tag) {
			$tagsarray[] = $tag->term_id;
		}

		$tagslist = implode(',', $tagsarray);

		$q = "SELECT p.*, count(tr.object_id) as count
			FROM $wpdb->term_taxonomy AS tt, $wpdb->term_relationships AS tr, $wpdb->posts AS p WHERE tt.taxonomy ='post_tag' AND tt.term_taxonomy_id = tr.term_taxonomy_id AND tr.object_id  = p.ID AND tt.term_id IN ($tagslist) AND p.ID != $post->ID
				AND p.post_status = 'publish'
				AND p.post_date_gmt < NOW()
 			GROUP BY tr.object_id
			ORDER BY count DESC, p.post_date_gmt DESC
			LIMIT $limit;";

		$related = $wpdb->get_results($q);

 		if ( $related ) {
			foreach($related as $r) {
				$retval .= '<li><a title="'.wptexturize($r->post_title).'" href="'.get_permalink($r->ID).'">'.wptexturize($r->post_title).'</a></li>';
			}
		} else {
			$retval .= '<li>' . __('No related posts found', 'trulyminimal' ) . '</li>';
		}

		$retval .= '</ul>';
		return $retval;
	}
	return;
}
add_shortcode('related_posts', 'themef_related_posts_shortcode');

/*-------------------------------------------------------------
*   Note for admins Shortcode
*------------------------------------------------------------*/
function themef_admin_note_shortcode( $atts, $content = null ) {
	if ( current_user_can( 'publish_posts' ) )
		return '<p class="admin-note">'.$content.'</p>';

	return '';
}
add_shortcode( 'admin_note', 'themef_admin_note_shortcode' );

/*-------------------------------------------------------------
*   PDF Link Shortcode
*------------------------------------------------------------*/
function themef_pdflink_shortcode($attr, $content) {
	if ($attr['url']) {
		return '<a class="pdf" href="http://docs.google.com/viewer?url=' . $attr['url'] . '" target="_blank">'.$content.'</a>';
	} else {
		$src = str_replace("=", "", $attr[0]);
		return '<a class="pdf" href="http://docs.google.com/viewer?url=' . $src . '" target="_blank">'.$content.'</a>';
	}
}
add_shortcode('pdflink', 'themef_pdflink_shortcode');

/*-------------------------------------------------------------
*   Mailto Shortcode
*------------------------------------------------------------*/
function themef_mailto_shortcode( $atts , $content=null ) {  
	for ($i = 0; $i < strlen($content); $i++) $encodedmail .= "&#" . ord($content[$i]) . ';';
 
	return '<a href="mailto:'.$encodedmail.'">'.$encodedmail.'</a>';  
}
add_shortcode('mailto', 'themef_mailto_shortcode');  

/*-------------------------------------------------------------
*   Only for members Shortcode
*------------------------------------------------------------*/
function themef_member_shortcode( $atts, $content = null ) {  
	if ( is_user_logged_in() && !is_null( $content ) && !is_feed() )  
		return $content;

	return '<p class="only-members">' . __('You must be registered to see this text', 'trulyminimal' ) . '</p>';
}
add_shortcode( 'member', 'themef_member_shortcode' );

/*-------------------------------------------------------------
*   Site snapshot Shortcode
*------------------------------------------------------------*/
function themef_snapshot_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
		"snap" => 'http://s.wordpress.com/mshots/v1/',
		"url" => 'http://',
		"alt" => 'Image',
		"width" => '400', // width
		"height" => '300' // height
	), $atts));

	$img = '<img src="' . $snap . '' . urlencode($url) . '?w=' . $width . '&h=' . $height . '" height="' . $height . '" width="' . $width . '" alt="' . $alt . '"/>';
	return $img;
}
add_shortcode("snapshot", "themef_snapshot_shortcode");

/*-------------------------------------------------------------
*   PDF Frame Shortcode
*------------------------------------------------------------*/
function themef_pdfembed_shortcode($attr) {
	extract(shortcode_atts(array(
		"url" => 'http://',
		"width" => '400',
		"height" => '255',
	), $attr));

	return '<p style="text-align: center;"><iframe src="http://docs.google.com/viewer?url=' . $url . '&embedded=true" frameborder="0" width="' . $width . '" height="' . $height . '">Your browser should support iFrame to view this PDF document</iframe></p>';
}
add_shortcode('pdfembed', 'themef_pdfembed_shortcode');

/*-------------------------------------------------------------
*   Youtube Shortcode
*------------------------------------------------------------*/
function themef_youtube_shortcode($attr) {
	extract(shortcode_atts(array(
		"url" => 'http://',
		"width" => '400',
		"height" => '255',
	), $attr));

	parse_str( parse_url( $url, PHP_URL_QUERY ) );

	return '<p style="text-align: center;"><iframe src="http://www.youtube.com/embed/' . $v . '" frameborder="0" width="' . $width . '" height="' . $height . '">Your browser should support iFrame to view this PDF document</iframe></p>';
}
add_shortcode("youtube", "themef_youtube_shortcode");

/*-------------------------------------------------------------
*   Code Shortcode
*------------------------------------------------------------*/
function themef_code_shortcode( $attr, $content = null ) {
        $content = clean_pre($content);
        return '<pre><code>' .
               str_replace('<', '<', $content) .
               '</code></pre>';
}
add_shortcode('code', 'themef_code_shortcode');
add_shortcode('codeincode', 'themef_code_shortcode');
?>