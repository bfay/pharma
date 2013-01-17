<?php
/*-------------------------------------------------------------
*   Define framework directory path
*------------------------------------------------------------*/
define('FRAMEWORK_DIR', get_bloginfo('stylesheet_directory') . '/includes/framework/');
define('FRAMEWORK_DIR_JS', get_bloginfo('stylesheet_directory') . '/includes/framework/js/');
define('FRAMEWORK_DIR_CSS', get_bloginfo('stylesheet_directory') . '/includes/framework/css/');
define('FRAMEWORK_DIR_IMAGES', get_bloginfo('stylesheet_directory') . '/includes/framework/images/');
define('FRAMEWORK_DIR_LIBRARY', get_bloginfo('stylesheet_directory') . '/includes/framework/library/');
define('FRAMEWORK_DIR_PLUGINS', get_bloginfo('stylesheet_directory') . '/includes/framework/plugins/');

/*-------------------------------------------------------------
*   Define framework include path
*------------------------------------------------------------*/
define('FRAMEWORK_INC', $incPath . 'framework/');
define('FRAMEWORK_INC_JS', $incPath . 'framework/js/');
define('FRAMEWORK_INC_CSS', $incPath . 'framework/css/');
define('FRAMEWORK_INC_IMAGES', $incPath . 'framework/images/');
define('FRAMEWORK_INC_LIBRARY', $incPath . 'framework/library/');
define('FRAMEWORK_INC_PLUGINS', $incPath . 'framework/plugins/');

/*-------------------------------------------------------------
*   Definde framework shortpaths
*------------------------------------------------------------*/
define('FRAMEWORK_VERSION', '1.5.2');
define('SHORTNAME_SETTINGS', SHORTNAME . '-settings');
define('SHORTNAME_TEMPLATE', SHORTNAME . '-template');

/*-------------------------------------------------------------
*   Get array with categories
*------------------------------------------------------------*/
$framework_cats = get_categories('hide_empty=0&orderby=name');
$framework_categories = array();
$framework_categories[] = "--- Select ---";
foreach ($framework_cats as $category ) {
       $framework_categories[$category->cat_ID] = $category->cat_name;
}

/*-------------------------------------------------------------
*   Get array with posts
*------------------------------------------------------------*/
$framework_postsa = get_posts();
$framework_posts = array();
$framework_posts[] = "--- Select ---";
foreach ($framework_postsa as $post ) {
       $framework_posts[$post->ID] = $post->post_title;
}

/*-------------------------------------------------------------
*   Get array with pages
*------------------------------------------------------------*/
$framework_pagesa = get_pages();
$framework_pages = array();
$framework_pages[] = "--- Select ---";
foreach ($framework_pagesa as $page ) {
       $framework_pages[$page->ID] = $page->post_title;
}
?>