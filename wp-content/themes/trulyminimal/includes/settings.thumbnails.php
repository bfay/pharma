<?php
/*-------------------------------------------------------------
*   Add Thumbnails Support
*------------------------------------------------------------*/
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 150, 150, true );

	add_image_size( 'blog-thumb', 627, 278, true );
	add_image_size( 'blog-thumb-small', 200, 125, true );
}

/*-------------------------------------------------------------
*   Get Post Thumbnail
*------------------------------------------------------------*/
function post_thumbnail($w = null , $h = null, $postid = null, $rfalse = null) {
	if($postid) { $check = has_post_thumbnail($postid); } else { $check = has_post_thumbnail(); }

	if ( $check ) {
		return get_featured_thumbnail($w, $h, $postid);
	} else {
		return get_thumbnail($w, $h, $postid, $rfalse);
	}
}

/*-------------------------------------------------------------
*   Get Featured Thumbnail
*------------------------------------------------------------*/
function get_featured_thumbnail($w, $h, $postid) {
	if($postid) { $postid = get_post_thumbnail_id($postid); } else { $postid = get_post_thumbnail_id(); }

	if( is_numeric($w) ) :
		$main = wp_get_attachment_image_src($postid, 'large');

		$out = get_bloginfo('stylesheet_directory') . '/timthumb.php?';
		$out .= 'src=' . $main[0];

		if($w) $out .= '&amp;w=' . $w;
		if($h) $out .= '&amp;h=' . $h;

		$out .= '&amp;zc=1';

		return $out;
	else :
		$main = wp_get_attachment_image_src($postid, $w);

		return $main[0];
	endif;
}

/*-------------------------------------------------------------
*   Get First Image Thumbnail
*------------------------------------------------------------*/
function get_thumbnail($w, $h, $postid, $rfalse) {
	if(!$postid) { $postid = get_the_ID(); }

	$files = get_children('post_parent='.$postid.'&post_type=attachment&post_mime_type=image&order=desc');

	if( !$files && $rfalse ) return false;


	if($files) :
		if( is_numeric($w) ) :
			$keys = array_reverse(array_keys($files));
			$num = $keys[0];

			$main = wp_get_attachment_image_src($num, 'large');

			$out = get_bloginfo('stylesheet_directory') . '/timthumb.php?';
			$out .= 'src=' . $main[0];

			if($w) $out .= '&amp;w=' . $w;
			if($h) $out .= '&amp;h=' . $h;

			$out .= '&amp;zc=1';

			return $out;
		else :
			$keys = array_reverse(array_keys($files));
			$num = $keys[0];

			$main = wp_get_attachment_image_src($num, $w);

			return $main[0];
		endif;
	else:
		if( $rfalse ) return false;

		if( is_numeric($w) ) :
			if( ($w < 226) && ($h < 151) ) {
				$src = get_bloginfo('stylesheet_directory') . '/images/no-img_small.png';
			} else {
				$src = get_bloginfo('stylesheet_directory') . '/images/no-img_big.png';
			}
			
			$out = get_bloginfo('stylesheet_directory') . '/timthumb.php?';
			$out .= 'src=' . $src;
			
			if($w) $out .= '&amp;w=' . $w;
			if($h) $out .= '&amp;h=' . $h;
			
			$out .= '&amp;zc=1';
		
			return $out;
		else :
			return get_bloginfo('stylesheet_directory') . '/images/default_' . $w . '.png';
		endif;
	endif;
}

/*-------------------------------------------------------------
*   Cache an immage with timthumb
*------------------------------------------------------------*/
function cache_image($w = 200, $h = 80, $src) {
	if( !$src ) return false;

	$out = get_bloginfo('stylesheet_directory') . '/timthumb.php?';
	$out .= 'src=' . $src;
	
	if($w) $out .= '&amp;w=' . $w;
	if($h) $out .= '&amp;h=' . $h;
	
	$out .= '&amp;zc=1';

	return $out;
}
?>