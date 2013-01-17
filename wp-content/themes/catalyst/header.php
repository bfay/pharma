<?php
/**
 * Builds the header structure.
 *
 * @package Catalyst
 */
 
global $catalyst_layout_id;

catalyst_hook_widget_areas( $catalyst_layout_id );
catalyst_hook_hook_boxes( $catalyst_layout_id );

catalyst_doctype();
catalyst_site_title();
catalyst_meta();

wp_head();
catalyst_hook_in_head( $catalyst_layout_id . '_catalyst_hook_in_head' );
?>
	
</head>

<body <?php body_class(); ?>>

<?php
if( !is_page_template( 'template-blank-body.php' ) )
{
catalyst_hook_before_html( $catalyst_layout_id . '_catalyst_hook_before_html' );

catalyst_hook_before_before_header( $catalyst_layout_id . '_catalyst_hook_before_before_header' );
catalyst_hook_before_header( $catalyst_layout_id . '_catalyst_hook_before_header' );
catalyst_hook_after_before_header( $catalyst_layout_id . '_catalyst_hook_after_before_header' );

catalyst_hook_header( $catalyst_layout_id . '_catalyst_hook_header' );

catalyst_hook_before_after_header( $catalyst_layout_id . '_catalyst_hook_before_after_header' );
catalyst_hook_after_header( $catalyst_layout_id . '_catalyst_hook_after_header' );
catalyst_hook_after_after_header( $catalyst_layout_id . '_catalyst_hook_after_after_header' );
}
?>