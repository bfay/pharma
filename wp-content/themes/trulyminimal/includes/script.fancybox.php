<?php
if ( framework_get_option('script_fancybox_active') ) :
	if ( !is_admin() && !is_feed() )
		themef_enqueue_script('jquery-fancybox', 'jquery.fancybox.min.js');

	add_filter('the_content', 'themef_rel_fancybox', 99);
endif;

/*-------------------------------------------------------------
*   Edit images from content and add rel
*------------------------------------------------------------*/
function themef_rel_fancybox($content) {
	global $post;
	$pattern = "/(<a(?![^>]*?rel=['\"]image_group.*)[^>]*?href=['\"][^'\"]+?\.(?:bmp|gif|jpg|jpeg|png)['\"][^\>]*)>/i";
	$replacement = '$1 rel="image_group">';
	$content = preg_replace($pattern, $replacement, $content);
	return $content;
}
?>