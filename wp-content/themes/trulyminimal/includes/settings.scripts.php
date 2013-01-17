<?php
/*-------------------------------------------------------------
*   Function to load scripts
*------------------------------------------------------------*/
$themef_scripts = array();
function themef_enqueue_script($slug = null, $file = null) {
	global $themef_scripts;

	if( $slug && $file )
		$themef_scripts[$slug] = $file;
}

/*-------------------------------------------------------------
*   Add scripts in wp_head
*------------------------------------------------------------*/
function themef_add_scripts() {
	global $themef_scripts;

	// Change/add css/javascript only if not admin
	if ( !is_admin() && !is_feed()) :
		wp_enqueue_style( 'font-Droid-Serif', 'http://fonts.googleapis.com/css?family=Droid+Serif' , false, '1.0');
		wp_enqueue_style( 'font-Droid-Sans', 'http://fonts.googleapis.com/css?family=Droid+Sans:400,700' , false, '1.0');

		$load_scripts = get_bloginfo('stylesheet_directory') . '/js/load-scripts.php?load=';

		themef_enqueue_script('jquery-hoverintent', 'jquery.hoverintent.min.js');
		themef_enqueue_script('jquery-superfish', 'jquery.superfish.min.js');
		themef_enqueue_script('jquery-supersubs', 'jquery.supersubs.min.js');
		
		themef_enqueue_script('theme-core', 'theme.core.min.js');
		
		foreach( $themef_scripts as $slug => $file ) :
			$load_scripts .= $file . ',';
		endforeach;

		wp_register_script('load-scripts', $load_scripts, array('jquery'), THEMEVERSION);

		wp_enqueue_script('jquery');

		wp_enqueue_script('load-scripts');
	endif;
}
add_action( 'get_header', 'themef_add_scripts', 1000);


/*-------------------------------------------------------------
*   Add favicon if exist
*------------------------------------------------------------*/
function themef_favicon() {
	echo '<link rel="shortcut icon" href="' . framework_get_option('favicon') . '" />';
}

if( framework_get_option('favicon') )
	add_action('wp_head', 'themef_favicon');


/*-------------------------------------------------------------
*   Add fonts in wp_head
*------------------------------------------------------------*/
$themef_has_custom_fonts = false;
$themef_custom_fonts = array(
	"font_homepage" => ".home .hentry .post-content, .blog .hentry .post-content",
	"font_search" => ".search .hentry .post-content",
	"font_archive" => ".archive .hentry .post-content",
	"font_page" => ".page .hentry .post-content",
	"font_single" => ".single .hentry .post-content, .error404 .hentry .post-content",
	"font_comments" => "#comments ul.commentlist li.comment .comment-main .comment-content");

foreach( $themef_custom_fonts as $font_id => $font_class) :
	if( framework_get_default($font_id) != framework_get_option($font_id) )
		$themef_has_custom_fonts = true;
endforeach;

if( $themef_has_custom_fonts ) {
	add_action('wp_head', 'themef_wp_head');
	add_action( 'get_header', 'themef_init_fonts');
}

//Add custom css
function themef_wp_head() {
	global $themef_custom_fonts; ?>
<style type="text/css">
<?php foreach($themef_custom_fonts as $font_id => $font_class) :
	if( framework_get_default($font_id) != framework_get_option($font_id) ) : ?>
<?php echo $font_class; ?> {<?php foreach( framework_get_option($font_id) as $style => $value ) : ?><?php echo $style; ?>: <?php echo $value; ?>; <?php endforeach; ?>
}
<?php endif; endforeach; ?>
</style>
<?php
}

//Check if is google font and add the css from google source
function themef_init_fonts() {
	global $framework_font_family, $themef_custom_fonts;

	foreach($themef_custom_fonts as $font_id => $font_class) :
		if( framework_get_default($font_id) != framework_get_option($font_id) ) :
			$font = framework_get_option($font_id);

			if(array_key_exists($font['font-family'], $framework_font_family[1]['fonts']))
				wp_enqueue_style( str_replace('+', '-', 'font-' . $framework_font_family[1]['fonts'][$font['font-family']]), 'http://fonts.googleapis.com/css?family=' . $framework_font_family[1]['fonts'][$font['font-family']] , false, '1.0');
	endif; endforeach;
}
add_action( 'get_header', 'themef_init_fonts');


/*-------------------------------------------------------------
*   Detect browser and os and add a class in body class
*------------------------------------------------------------*/
function themef_browser_body_class($classes) {
	global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
	
	$user = $_SERVER["HTTP_USER_AGENT"];

	if($is_lynx) $classes[] = 'lynx-browser';
	elseif($is_gecko) $classes[] = 'gecko-browser';
	elseif($is_opera) $classes[] = 'opera-browser';
	elseif($is_NS4) $classes[] = 'ns4-browser';
	elseif($is_safari) $classes[] = 'safari-browser';
	elseif($is_chrome) $classes[] = 'chrome-browser';
	elseif($is_IE) $classes[] = 'ie-browser';
	elseif($is_iphone) $classes[] = 'iphone-browser';
	else $classes[] = 'unknown-browser';

	if( strpos($user, 'Linux') ) $classes[] = 'linux-os';
	elseif( strpos($user, 'Macintosh') ) $classes[] = 'mac-os';
	elseif( strpos($user, 'Windows') ) $classes[] = 'windows-os';
	elseif( strpos($user, 'iPhone') ) $classes[] = 'iphone-os';
	else $classes[] = 'unknown-os';

	return $classes;
}
add_filter('body_class','themef_browser_body_class');


/*-------------------------------------------------------------
*   Add custom css in wp_head
*------------------------------------------------------------*/
function themef_customcss() {
	echo framework_get_option('code_customcss');
}

if( framework_get_option('code_customcss') )
	add_action('wp_head', 'themef_customcss');


/*-------------------------------------------------------------
*   Add custom scripts in wp_head
*------------------------------------------------------------*/
function themef_headerscripts() {
	echo framework_get_option('code_headerscripts');
}

if( framework_get_option('code_headerscripts') )
	add_action('wp_head', 'themef_headerscripts');


/*-------------------------------------------------------------
*   Add custom scripts in wp_footer
*------------------------------------------------------------*/
function themef_footerscripts() {
	echo framework_get_option('code_footerscripts');
}

if( framework_get_option('code_footerscripts') )
	add_action('wp_footer', 'themef_footerscripts');
?>