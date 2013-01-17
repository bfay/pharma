<?php
//error_reporting(E_ALL);
error_reporting(0);

$themedata = get_theme_data( get_template_directory() . '/style.css' );

$shortname = "trulymini";

define('THEMENAME', $themedata['Name']);
define('THEMEVERSION', $themedata['Version']);
define('SHORTNAME', $shortname);

$incPath = get_template_directory() . '/includes/';

require_once ($incPath . 'functions.php');
?>