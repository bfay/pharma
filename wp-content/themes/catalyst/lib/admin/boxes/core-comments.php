<?php
/**
 * Builds the Core Comments admin content.
 *
 * @package Catalyst
 */
?>

<div id="catalyst-core-options-nav-comments-box" class="catalyst-all-options">

	<h3><?php _e( 'Comment Options', 'catalyst' ); ?></h3>

	<div class="catalyst-optionbox-2col-left-wrap">
		
		<div class="catalyst-optionbox-outer-2col">
			<div class="catalyst-optionbox-inner-2col"> 
				<h4><?php _e( 'Comment Display Options', 'catalyst' ); ?></h4>
				
				<div class="bg-box">	
					<p>
						<input type="checkbox" id="catalyst-comment-display-posts" name="catalyst[comment_display_posts]" value="1" <?php if( checked( 1, catalyst_get_core( 'comment_display_posts' ) ) ); ?> />
						<?php _e( 'Display Comments In Posts', 'catalyst' ); ?>
					</p>
					
					<p>
						<input type="checkbox" id="catalyst-comment-display-pages" name="catalyst[comment_display_pages]" value="1" <?php if( checked( 1, catalyst_get_core( 'comment_display_pages' ) ) ); ?> />
						<?php _e( 'Display Comments In Pages', 'catalyst' ); ?>
					</p>
					
					<p>
						<input type="checkbox" id="catalyst-comment-trackbacks-display-posts" name="catalyst[comment_trackbacks_display_posts]" value="1" <?php if( checked( 1, catalyst_get_core( 'comment_trackbacks_display_posts' ) ) ); ?> />
						<?php _e( 'Display Trackbacks In Posts', 'catalyst' ); ?>
					</p>
					
					<p>
						<input type="checkbox" id="catalyst-comment-trackbacks-display-pages" name="catalyst[comment_trackbacks_display_pages]" value="1" <?php if( checked( 1, catalyst_get_core( 'comment_trackbacks_display_pages' ) ) ); ?> />
						<?php _e( 'Display Trackbacks In Pages', 'catalyst' ); ?>
					</p>
					
					<p>
						<input type="checkbox" style="margin-left:0px;" id="catalyst-comment-attributes" name="catalyst[comment_attributes]" value="1" <?php if( checked( 1, catalyst_get_core( 'comment_attributes' ) ) ); ?> />
						<?php _e( 'Display Allowed HTML Below Comment Form', 'catalyst' ); ?>
					</p>
				</div>
			</div>
		</div>

	</div>
	<div class="catalyst-optionbox-2col-right-wrap">
	
		<div class="catalyst-optionbox-outer-2col">
			<div class="catalyst-optionbox-inner-2col"> 
				<h4><?php _e( 'Comment Text Options', 'catalyst' ); ?></h4>
				
				<div class="bg-box">
					<p>
						<?php _e( 'Author Form Label', 'catalyst' ); ?>
						<input type="text" id="catalyst-comment-author-form-label" name="catalyst[comment_author_form_label]" value="<?php echo catalyst_get_core( 'comment_author_form_label' ) ?>" style="width:224px;" />
					</p>
					
					<p>
						<?php _e( 'Email Form Label', 'catalyst' ); ?>
						<input type="text" id="catalyst-comment-email-form-label" name="catalyst[comment_email_form_label]" value="<?php echo catalyst_get_core( 'comment_email_form_label' ) ?>" style="width:233px;" />
					</p>
					
					<p>
						<?php _e( 'URL Form Label', 'catalyst' ); ?>
						<input type="text" id="catalyst-comment-url-form-label" name="catalyst[comment_url_form_label]" value="<?php echo catalyst_get_core( 'comment_url_form_label' ) ?>" style="width:242px;" />
					</p>
					
					<p>
						<?php _e( 'Text Above Comment Form', 'catalyst' ); ?>
						<input type="text" id="catalyst-text-above-comment-box" name="catalyst[text_above_comment_box]" value="<?php echo catalyst_get_core( 'text_above_comment_box' ) ?>" style="width:170px;" />
					</p>
					
					<p>
						<?php _e( 'Submit Button Text', 'catalyst' ); ?>
						<input type="text" id="catalyst-comment-submit-text" name="catalyst[comment_submit_text]" value="<?php echo catalyst_get_core( 'comment_submit_text' ) ?>" style="width:219px;" />
					</p>
				</div>
			</div>
		</div>
	
	</div>
</div>