<?php
if ( function_exists('register_sidebar') ) {
    register_sidebar(array(
		'name' => 'Sidebar',
        	'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '<div class="clear"></div></div>',
		'before_title' => '<h3 class="widget-title">',
        	'after_title' => '</h3>',
    ));
}
?>