<?php
/**
 * Builds the comments structure.
 *
 * @package Catalyst
 */
 
global $catalyst_layout_id;

if( !empty( $_SERVER['SCRIPT_FILENAME'] ) && 'comments.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) )
{
	die( 'Please do not load this page directly. Thanks!' );
}
	
if( post_password_required() )
{
?>
	<p class="nocomments"><?php _e( 'This post is password protected. Enter the password to view comments.', 'catalyst' ); ?></p>
<?php
	return;
}

catalyst_hook_before_comments( $catalyst_layout_id . '_catalyst_hook_before_comments' );
catalyst_hook_comments( $catalyst_layout_id . '_catalyst_hook_comments' );
catalyst_hook_after_comments( $catalyst_layout_id . '_catalyst_hook_after_comments' );

catalyst_hook_before_trackbacks( $catalyst_layout_id . '_catalyst_hook_before_trackbacks' );
catalyst_hook_trackbacks( $catalyst_layout_id . '_catalyst_hook_trackbacks' );
catalyst_hook_after_trackbacks( $catalyst_layout_id . '_catalyst_hook_after_trackbacks' );

catalyst_hook_before_comment_form( $catalyst_layout_id . '_catalyst_hook_before_comment_form' );
catalyst_hook_comment_form( $catalyst_layout_id . '_catalyst_hook_comment_form' );
catalyst_hook_after_comment_form( $catalyst_layout_id . '_catalyst_hook_after_comment_form' );

//end comments.php