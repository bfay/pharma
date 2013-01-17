<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<title><?php wp_title( '|', true, 'right' ); ?></title>

	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />

	<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" media="screen" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<?php if( (framework_get_option('color_scheme') != 'default.css') && (framework_get_option('color_scheme') != 'custom') ) : ?>
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/<?php echo framework_get_option('color_scheme'); ?>" type="text/css" media="all" />
	<?php elseif ( (framework_get_option('color_scheme') == 'custom') ) : ?>
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/custom.php" type="text/css" media="all" />
	<?php endif; ?>

	<?php wp_get_archives('type=monthly&format=link'); ?>

	<?php
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	wp_head(); ?>
</head>
<body <?php body_class( framework_get_layout() ); ?>>
<div id="header">
	<h1><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
	<h2><?php bloginfo( 'description' ); ?></h2>
	<?php if( (framework_get_option('logo')) && (framework_get_option('logo') != "") ) : ?>
		<a class="top-logo" href="<?php echo home_url(); ?>"><img src="<?php echo stripslashes(framework_get_option('logo')); ?>" alt="<?php bloginfo('name'); ?>" /></a>
	<?php endif; ?>

	<?php wp_nav_menu(array('menu_id' => 'top-menu', 'container' => 'top-menu', 'theme_location' => 'top-menu', 'fallback_cb' => 'wp_page_menu')); ?>
	
	<div class="clear"></div>
</div><!-- END #header -->