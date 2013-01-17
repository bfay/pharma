<?php
header( "Content-type: text/javascript" );

$load = explode(',', $_GET['load']);

if ( empty($load) )
	exit;

$files = array();

foreach( $load as $id => $file ) :
	if( $file != '' )
		$files[] = $file;
endforeach;

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