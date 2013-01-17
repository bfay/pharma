<?php
function register_menus() {
	register_nav_menus(
		array(
			'top-menu' => 'Top Menu'
	));
}
add_action('init', 'register_menus');
?>