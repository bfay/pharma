<?php
function get_comment_author_link_new() {
	$url = get_comment_author_url();
	$author = get_comment_author();

	if (empty( $url ) || 'http://' == $url)
		$return = $author;
	else
		$return = "<a href='$url' rel='external nofollow' class='url' target='_blank'>$author</a>";

	return apply_filters('get_comment_author_link_new', $return);
}
add_filter( 'get_comment_author_link', 'get_comment_author_link_new' );

function themef_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;

	switch ( $comment->comment_type ) :
		case '' : ?>

	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">

		<table id="comment-<?php comment_ID(); ?>" class="comment-wrapper"><tr>
			<td class="comment-avatar">
				<div style="position: relative;">
					<?php echo get_avatar( $comment, 58 ); ?>
					<span class="comment-avatar-overlay"></span>
				</div>
			</td><!-- END .comment-avatar -->
			
			<td class="comment-main">
				<div class="comment-meta">
					<span class="comment-author"><?php comment_author_link(); ?></span>
					<span class="comment-date"><?php printf( __( 'on %s at %s', 'trulyminimal'), get_comment_date(), get_comment_time() ); ?></span>	
				</div><!-- END .comment-meta -->
				
				<div class="comment-content">
					<?php if ( $comment->comment_approved == '0' ) : ?>
						<p><strong><em><?php _e( 'Your comment is awaiting moderation.', 'trulyminimal'); ?></em></strong></p>
					<?php endif; ?>
	
					<?php comment_text(); ?>
	
					<div class="clear"></div>
				</div><!-- END .comment-content -->

				<?php comment_reply_link( array( 'reply_text' => __('Reply &rarr;', 'trulyminimal'), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ); ?>
				<div class="clear"></div>
			</td><!-- END .comment-main -->
		</tr></table><!-- #comment-<?php comment_ID(); ?>  -->

		<div class="clear"></div>

	<?php
		break;

		case 'pingback' :
		case 'trackback' : ?>

        <li class="pingback" id="li-comment-<?php comment_ID(); ?>">
		<div class="comment-content">
			<p>Pingback: <?php comment_author_link(); ?></p>

			<div class="clear"></div>
		</div><!-- END .comment-content -->

		<?php break;
	endswitch;
} ?>

		<div id="comments">
			<?php if ( have_comments() && !post_password_required() && comments_open() ) : ?>
				<div class="comments-top">
					<a href="#respond" class="comment-reply-link"><?php _e( 'Leave a reply &rarr;', 'trulyminimal' ); ?></a>
					<span><?php comments_number( __('0 comments', 'trulyminimal'), __('1 comment', 'trulyminimal'), __('% comments', 'trulyminimal') ); ?></span>
				</div>
			<?php endif; ?>

			<?php if ( post_password_required() ) : ?>
				<div class="comments-box"><p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'trulyminimal' ); ?></p></div>

				</div><!-- #comments -->
			<?php return;
				endif; ?>

<?php if ( have_comments() ) : ?>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<div class="pagination">
				<div class="alignleft button nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'trulyminimal' ) ); ?></div>
				<div class="alignright button nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'trulyminimal' ) ); ?></div>
				<div class="clear"></div>
			</div><!-- .navigation -->
	<?php endif; ?>

			<ul class="commentlist">
				<?php wp_list_comments( array( 'type' => 'comment', 'callback' => 'themef_comment' ) ); ?>
			</ul>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<div class="pagination">
				<div class="alignleft button nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'trulyminimal' ) ); ?></div>
				<div class="alignright button nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'trulyminimal' ) ); ?></div>
				<div class="clear"></div>
			</div> <!-- .navigation -->
	<?php endif; ?>

	<div class="clear"></div>

<?php else :

	if ( ! comments_open() ) : ?>
		<div class="comments-box"><p><?php _e( 'Comments are closed.', 'trulyminimal' ); ?></p></div>
	<?php endif; ?>

<?php endif; ?>


<?php if ( themef_get_pings_number() != 0 ) : ?>

	<div class="comments-top pingbacks">
		<span><?php echo themef_get_pings_number(); ?> <?php echo _n('pingback', 'pingbacks', themef_get_pings_number(), 'trulyminimal'); ?></span>
	</div>

	<ul class="commentlist">
		<?php wp_list_comments( array( 'type' => 'pings', 'callback' => 'themef_comment' ) ); ?>
	</ul>

<?php endif; ?>


<div id="cForm">
<?php $defaults = array( 'fields' => apply_filters( 'comment_form_default_fields', array(
    'author' => '<div class="comment-form-author">' .
			'<label for="author">' . __( 'your name', 'trulyminimal' ) . '</label>' .
			'<input id="author" name="author" type="text" value="" size="30" tabindex="1" />' .
                '</div><!-- .comment-form-author -->',

    'email'  => '<div class="comment-form-email">' .
                	'<label for="email">' . __( 'e-mail address', 'trulyminimal' ) . '</label>' .
			'<input id="email" name="email" type="text" value="" size="30" tabindex="2" />' .
                '</div><!-- .comment-form-email -->',

    'url'    => '<div class="comment-form-url">' .
	                '<label for="url">' . __( 'website url', 'trulyminimal' ) . '</label>' .
			'<input id="url" name="url" type="text" value="" size="30" tabindex="3" />' .
                '</div><!-- .comment-form-url -->' ) ),

    'comment_field' => '<div class="comment-form-comment">' .
			'<label for="comment">' . __( 'your comment', 'trulyminimal' ) . '</label>' .
			'<textarea id="comment" name="comment" cols="45" rows="8" tabindex="4"></textarea>' .
                '</div><!-- .comment-form-comment -->',

    'must_log_in' => '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'trulyminimal' ), wp_login_url( apply_filters( 'the_permalink', get_permalink() ) ) ) . '</p>',

    'logged_in_as' => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%s">%s</a>. <a href="%s" title="Log out of this account">Log out?</a></p>', 'trulyminimal' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink() ) ) ),

    'comment_notes_before' => '<p class="comment-notes">' . __( 'Your email is <em>never</em> published or shared.', 'trulyminimal' ) . '</p>',
    'comment_notes_after' => '<dl class="form-allowed-tags"><dt>' . __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes:', 'trulyminimal' ) . '</dt> <dd><code>' . allowed_tags() . '</code></dd></dl>',

    'id_form' => 'commentform',
    'id_submit' => 'submit',
    'title_reply' => '<span>' . __( 'Leave a comment', 'trulyminimal' ) . '</span>',
    'title_reply_to' => __( 'Leave a reply', 'trulyminimal' ),
    'cancel_reply_link' => __( 'Cancel reply', 'trulyminimal' ),
    'label_submit' => __( 'submit your reply', 'trulyminimal' ),
); ?>

<?php comment_form($defaults); ?>
</div><!-- END #cForm -->
</div><!-- #comments -->