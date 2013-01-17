<?php
/*------------------------------------------------
*  Add shortcode for show the author details
*-----------------------------------------------*/
function themef_aboutauthor_shortcode($atts, $content = null) {
	$return = "";

	$return .= '<div class="section-about-the-author">';
	$return .= '<div class="author-avatar">';
	$return .= '<span class="author-avatar-overlay"></span>';
	$return .= get_avatar(get_the_author_email(), '77');
	$return .= '</div><!-- END .author-avatar -->';
	$return .= '<div class="author-content">';
	$return .= '<div class="author-name">';
	$return .= '<a href="' . get_author_posts_url( get_the_author_meta('ID') ) . '" title="' . sprintf( __( '%1$s Posts', 'trulyminimal' ), get_the_author() ) . '">' . get_the_author(). '</a>';
	$return .= '</div>';
	$return .= '<p>' . get_the_author_meta('description') . '</p>';
	$return .= '<div class="author-posts">';
	$return .= '<a href="' . get_author_posts_url( get_the_author_meta('ID') ) . '" title="' . sprintf( __( '%1$s Posts', 'trulyminimal' ), get_the_author() ) . '">' . __('View all posts &rarr;', 'trulyminimal') . '</a>';
	$return .= '</div>';
	$return .= '</div><!-- END .author-content -->';
	$return .= '<div class="clear"></div>';
	$return .= '</div><!-- END .section-about-the-author -->';

	return $return;
}
add_shortcode('aboutauthor', 'themef_aboutauthor_shortcode');
?>