<?php
header( "Content-type: text/javascript" );

$files = array();
$files[] = 'jquery.ui.core.min.js';
$files[] = 'jquery.ui.widget.min.js';
$files[] = 'jquery.ui.tabs.min.js';
$files[] = 'jquery.ui.mouse.min.js';
$files[] = 'jquery.ui.sortable.min.js';
$files[] = 'jquery.colorpicker.min.js';
$files[] = 'jquery.swfobject.min.js';
$files[] = 'jquery.uploadify.min.js';
$files[] = 'admin.core.min.js';

foreach($files as $file) :
    $content = @file_get_contents( $file );
    echo minify( $content );
endforeach;

function minify( $code ) {
        $code = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $code);
        $code = preg_replace(array('(( )+{)','({( )+)'), '{', $code);
        $code = preg_replace(array('(( )+})','(}( )+)','(;( )*})'), '}', $code);
        $code = preg_replace(array('(;( )+)','(( )+;)'), ';', $code);
	return trim( $code );
}
?>