<?php
header( "Content-type: text/css" );

$files = array();
$files[] = 'style.css';
$files[] = 'responsive.css';

foreach($files as $file) :
    $content = @file_get_contents( $file );
    echo minify( $content );
endforeach;

function minify( $code ) {
	$code = preg_replace( '#\s+#', ' ', $code );
	$code = preg_replace( '#/\*.*?\*/#s', '', $code );
	$code = str_replace( '; ', ';', $code );
	$code = str_replace( ': ', ':', $code );
	$code = str_replace( ' {', '{', $code );
	$code = str_replace( '{ ', '{', $code );
	$code = str_replace( ', ', ',', $code );
	$code = str_replace( '} ', '}', $code );
	$code = str_replace( ';}', '}', $code );

	return trim( $code );
}
?>