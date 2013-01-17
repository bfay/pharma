<?php
/**
 * Builds and hooks in all the Comment functions.
 *
 * @package Catalyst
 */
 
add_action( 'catalyst_hook_before_comments', 'catalyst_comment_wrap_open', 1 );
/**
 * Build the Catalyst comments opening #comment-wrap div.
 *
 * @since 1.0
 */
function catalyst_comment_wrap_open()
{
	if( comments_open() )
		echo apply_filters( 'catalyst_comment_open', '<div id="comment-wrap">' . "\n" );
}

add_action( 'catalyst_hook_after_comment_form', 'catalyst_comment_wrap_close', 20 );
/**
 * Build the Catalyst comments closing #comment-wrap div.
 *
 * @since 1.0
 */
function catalyst_comment_wrap_close()
{
	if( comments_open() )
		echo apply_filters( 'catalyst_comment_close', '<div style="clear:both;"></div>' . "\n" . '</div>' . "\n" );
}

add_action( 'catalyst_hook_after_post', 'catalyst_get_comments_template' );
/**
 * Determine whether or not to display the comments on pages and/or posts.
 *
 * @since 1.0
 */
function catalyst_get_comments_template()
{
	if( is_single() && catalyst_get_core( 'comment_display_posts' ) )
	{
		comments_template( '', TRUE);
	}
		
	if( is_page() && catalyst_get_core( 'comment_display_pages' ) )
	{
		comments_template( '', TRUE);
	}
}

/**
 * Build the comments HTML.
 *
 * @since 1.0
 */
function catalyst_build_comments( $comment, $args, $depth )
{
	$GLOBALS['comment'] = $comment;
	?>

		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<div id="comment-<?php comment_ID(); ?>">
			<div class="comment-author vcard">
				<?php echo get_avatar($comment); ?>
				<?php printf( __( '%s <span class="says">says:</span>', 'catalyst' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
			</div>
			
			<?php if( $comment->comment_approved == '0' ) : ?>
				<em><?php _e( 'Your comment is awaiting moderation.' ) ?></em>
				<br />
			<?php endif; ?>
	 
			<div class="comment-meta commentmetadata">
				<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>" rel="nofollow"><?php printf( __( '%1$s at %2$s' ), get_comment_date(),  get_comment_time() ) ?></a><?php edit_comment_link( __( '(Edit)' ),'  ','' ) ?>
			</div>
			<?php comment_text() ?>
				<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ) ?>
				</div>
			</div>
<?php
}

add_action( 'catalyst_hook_comments', 'catalyst_comments' );
/**
 * Build the comments HTML.
 *
 * @since 1.0
 */
function catalyst_comments()
{
	global $post;
	
	if( have_comments() )
	{
	?>
		<div id="comments">
			<h3 class="comment-heading"><?php comments_number(__( 'No Responses', 'catalyst' ), __( 'One Response', 'catalyst' ), __( '% Responses', 'catalyst' ) );?> <?php _e( 'to', 'catalyst' ); ?> &#8220;<?php the_title(); ?>&#8221;</h3>
			<p class="commentlist comment-body-text"><?php _e( 'Read below or', 'catalyst' ); ?> <a href="#respond" rel="nofollow"><?php _e( 'add a comment...', 'catalyst' ); ?></a></p>
			<ol class="commentlist">
				<?php wp_list_comments( 'type=comment&callback=catalyst_build_comments' ); ?>
			</ol>
			<div class="comments-nav">
				<div class="alignleft"><?php previous_comments_link() ?></div>
				<div class="alignright"><?php next_comments_link() ?></div>
			</div>
		</div>
	<?php
	}
	else // This is displayed if there are no comments so far.
	{
	?>
		<div id="comments">
		<?php
			if( 'open' == $post->comment_status )
			{
			?>
				<!-- If comments are open, but there are no comments. -->
				<?php echo apply_filters( 'catalyst_no_comments_text', '' );
			}
			else // comments are closed
			{
				?>
				<!-- If comments are closed. -->
				<?php echo apply_filters( 'catalyst_comments_closed_text', '' );
			}
		?>
		</div>
	<?php
	}
}

add_action( 'catalyst_hook_trackbacks', 'catalyst_trackbacks' );
/**
 * Build the trackbacks HTML.
 *
 * @since 1.0
 */
function catalyst_trackbacks()
{
	global $wp_query;
	
	if( !catalyst_get_core( 'comment_trackbacks_display_posts' ) && !catalyst_get_core( 'comment_trackbacks_display_pages' ) )
		return;

	if( have_comments() && !empty( $wp_query->comments_by_type['pings'] ) )
	{
		echo '<div id="trackbacks">' . "\n";
		echo apply_filters( 'catalyst_trackbacks_heading', __( '<h3 class="comment-heading">Trackbacks</h3>', 'catalyst' ) );
		echo '<ol class="commentlist">' . "\n";
		wp_list_comments( 'type=pings' );
		echo '</ol><br /><br />' . "\n";
		echo '</div>' . "\n";
	}
	else
	{
		echo '<div id="trackbacks">' . "\n";
		echo apply_filters( 'catalyst_no_pings_text', '' );
		echo '</div>' . "\n";
	}
}

add_filter( 'text_above_comment_box', 'text_above_comment_box' );
/**
 * Filter in the text_above_comment_box custom text.
 *
 * @since 1.5.1
 */
function text_above_comment_box()
{
	return catalyst_get_core( 'text_above_comment_box' );
}

add_filter( 'comment_author_form_label', 'comment_author_form_label' );
/**
 * Filter in the comment_author_form_label custom text.
 *
 * @since 1.5.1
 */
function comment_author_form_label()
{
	return catalyst_get_core( 'comment_author_form_label' );
}

add_filter( 'comment_email_form_label', 'comment_email_form_label' );
/**
 * Filter in the comment_email_form_label custom text.
 *
 * @since 1.5.1
 */
function comment_email_form_label()
{
	return catalyst_get_core( 'comment_email_form_label' );
}

add_filter( 'comment_url_form_label', 'comment_url_form_label' );
/**
 * Filter in the comment_url_form_label custom text.
 *
 * @since 1.5.1
 */
function comment_url_form_label()
{
	return catalyst_get_core( 'comment_url_form_label' );
}

add_filter( 'comment_submit_text', 'comment_submit_text' );
/**
 * Filter in the comment_submit_text custom text.
 *
 * @since 1.5.1
 */
function comment_submit_text()
{
	return catalyst_get_core( 'comment_submit_text' );
}

add_action( 'catalyst_hook_comment_form', 'catalyst_comment_form' );
/**
 * Build the comment form HTML.
 *
 * @since 1.0
 */
function catalyst_comment_form()
{
	global $user_identity, $id;

	if( ( is_single() && !catalyst_get_core( 'comment_display_posts' ) ) || ( is_page() && !catalyst_get_core( 'comment_display_pages' ) ) )
		return;
	
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? ' aria-required="true"' : '' );
	$form_allowed_tags = ( catalyst_get_core( 'comment_attributes' ) ? '<p class="form-allowed-tags">' . sprintf( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s' ), ' <code>' . allowed_tags() . '</code>' ) . '</p>' : '' );

	$args = array(
		'comment_notes_before' => apply_filters( 'catalyst_comment_notes_before', '' ),
		
		'title_reply' => apply_filters( 'text_above_comment_box', __( 'Leave A Comment...', 'catalyst' ) ),
		
		'fields' => array(
			'author' =>	'<p class="comment-form-author">' .
						'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="22" tabindex="1"' . $aria_req . ' />' .
						'<label class="comment-body-text" for="author"><small>' . apply_filters( 'comment_author_form_label', __( 'Name', 'catalyst' ) ) . '</small></label> ' .
						( $req ? '<span class="required">*</span>' : '' ) .
						'</p>',

			'email' =>	'<p class="comment-form-email">' .
						'<input id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="22" tabindex="2"' . $aria_req . ' />' .
						'<label class="comment-body-text" for="email"><small>' . apply_filters( 'comment_email_form_label', __( 'Email', 'catalyst' ) ) . '</small></label> ' .
						( $req ? '<span class="required">*</span>' : '' ) .
						'</p>',

			'url' =>	'<p class="comment-form-url">' .
						'<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="22" tabindex="3" />' .
						'<label class="comment-body-text" for="url"><small>' . apply_filters( 'comment_url_form_label', __( 'Website', 'catalyst' ) ) . '</small></label>' .
						'</p>'
		),

		'comment_field' =>	'<p class="comment-form-comment">' .
							'<textarea id="comment" name="comment" cols="80" rows="10" tabindex="4" aria-required="true"></textarea>' .
							'</p>',

		'label_submit' => apply_filters( 'comment_submit_text', __( 'Submit' ) ),
		
		'comment_notes_after' => apply_filters( 'catalyst_comment_notes_after', $form_allowed_tags ),
	);

	comment_form( apply_filters( 'catalyst_comment_form_args', $args, $user_identity, $id, $commenter, $req, $aria_req ), $id );
}

//end lib/functions/catalyst-comments.php