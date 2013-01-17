<?php
/**
 * Builds and hooks in the Catalyst Meta Boxes for
 * their integration into the WordPress Dashboard.
 *
 * @package Catalyst
 */
 
add_action( 'admin_menu', 'catalyst_add_post_boxes' );
/**
 * Add meta boxes to the Write Post, Write Page and Write Custom Post Type (if enabled) pages.
 *
 * @since 1.0
 */
function catalyst_add_post_boxes()
{
	foreach( ( array )get_post_types( array( 'public' => true ) ) as $type )
	{
		if( post_type_supports( $type, 'catalyst-inpost' ) || $type == 'post' || $type = 'page' )
		{
			add_meta_box( 'catalyst_choose_template', __( 'Catalyst Post/Page Options', 'catalyst_textdomain' ), 'catalyst_inner_post_box', $type, 'normal', 'high' );
		}
	}
}

add_action( 'init', 'catalyst_add_post_type_support' );
/**
 * Add Catalyst In-Post options into Custom Post Types
 * post page if enabled in Core Options.
 *
 * @since 1.3
 */
function catalyst_add_post_type_support()
{
	$cpts = catalyst_get_core( 'include_inpost_cpt_names' );
	$cpt = explode( ',', $cpts );
	
	foreach ( $cpt as $type )
	{
		add_post_type_support( $type, 'catalyst-inpost' );
	}
}

/**
 * Build Catalyst In-Post/In-Page meta box.
 *
 * @since 1.0
 */
function catalyst_inner_post_box()
{
	global $catalyst_seo_active;
?>
	<div id="catalyst_options_table">
	<script type="text/javascript">
	jQuery(document).ready(function($) {
		$( '.count-me' ).keyup(function() {
			var $field = $(this), target = parseInt($( '#' + $field.attr( 'id' ) + '_target' ).text()), $ticker = $( '#' + $field.attr( 'id' ) + '_ticker' ), count = $field.val().length;
			$ticker.text(count);
			if( count <= target){ $ticker.css({'font-weight':'normal', 'color':'#666666'}); }
			else { $ticker.css({'font-weight':'bold', 'color':'#6B051F'}); }
		});
		$( '.count-me' ).keyup();
	});
	</script>
	<style type="text/css">#catalyst-post-meta-table { width:100%; } #catalyst-post-meta-table td { width:50%; vertical-align:top; }</style>
	<table id="catalyst-post-meta-table">
		<?php $seo_style = ''; if( !$catalyst_seo_active ) { $seo_style = ' style="display:none;"'; } ?>
		<tr>
			<td<?php echo $seo_style ?>>				
				<p><label for="catalyst_title"><strong><?php _e( 'Catalyst Document Title', 'catalyst' ); ?></strong><br><code>&lt;title&gt;</code></label></p>
				<p><input type="text" class="count-me" value="<?php $catalyst_title = catalyst_get_custom_field( '_catalyst_title' ); echo ( !empty( $catalyst_title ) ) ? esc_attr( $catalyst_title ) : ''; ?>" id="catalyst_title" name="catalyst_options[_catalyst_title]" style="width: 99%;"></p>
				<p style="margin-bottom:0;"><span style="font-size:9px;color:#666666;"><?php _e( 'The max. title length for most search engines is ', 'catalyst' ) ?><span id="catalyst_title_target">60</span><?php _e( ' characters.<br />You have entered ', 'catalyst' ) ?><span id="catalyst_title_ticker">0</span></span></p>
			</td>
			<style type="text/css">body.post-php .no-display, body.post-new-php .no-display { display:none; }</style>
			<td>				
				<p><label for="catalyst_layout"><strong><?php _e( 'Layout', 'catalyst' ); ?></strong><br><?php _e( 'Use Default Layout or a Custom Layout?', 'catalyst' ); ?></label></p>
				<p><select id="catalyst_layout" name="catalyst_options[_catalyst_layout]" style="width: 99%;"><?php $catalyst_layout = catalyst_get_custom_field( '_catalyst_layout' ); catalyst_list_layouts( $catalyst_layout ); ?></select></p>
			</td>
		</tr>
		<tr<?php echo $seo_style ?>>
			<td>
				<p><label for="catalyst_description"><strong><?php _e( 'Catalyst Description', 'catalyst' ); ?></strong><br><code>&lt;meta name="description"&gt;</code></label></p>
				<p><textarea class="count-me" id="catalyst_description" name="catalyst_options[_catalyst_description]" style="width: 99%;"><?php $catalyst_description = catalyst_get_custom_field( '_catalyst_description' ); echo ( !empty( $catalyst_description ) ) ? $catalyst_description : ''; ?></textarea></p>
				<p style="margin-bottom:0;"><span style="font-size:9px;color:#666666;"><?php _e( 'The max. description length for most search engines is ', 'catalyst' ) ?><span id="catalyst_description_target">160</span><?php _e( ' characters.<br />You have entered ', 'catalyst' ) ?><span id="catalyst_description_ticker">0</span></span></p>
			</td>
			<td>
				<p><label for="catalyst_keywords"><strong><?php _e( 'Catalyst Keywords', 'catalyst' ); ?></strong><br><code>&lt;meta name="keywords"&gt;</code></label></p>
				<p><textarea id="catalyst_keywords" name="catalyst_options[_catalyst_keywords]" style="width: 99%;"><?php $catalyst_keywords = catalyst_get_custom_field( '_catalyst_keywords' ); echo ( !empty( $catalyst_keywords ) ) ? $catalyst_keywords : ''; ?></textarea></p>
			</td>
		</tr>
		<tr>
			<td>
				<p><label for="catalyst_header_scripts"><strong><?php _e( 'Header Scripts', 'catalyst' ); ?></strong></label></p>
				<p><textarea id="catalyst_header_scripts" name="catalyst_options[_catalyst_header_scripts]" style="width: 99%;"><?php $catalyst_header_scripts = catalyst_get_custom_field( '_catalyst_header_scripts' ); echo ( !empty( $catalyst_header_scripts ) ) ? $catalyst_header_scripts : ''; ?></textarea></p>
			</td>
			<td>
				<p><label for="catalyst_footer_scripts"><strong><?php _e( 'Footer Scripts', 'catalyst' ); ?></strong></label></p>
				<p><textarea id="catalyst_footer_scripts" name="catalyst_options[_catalyst_footer_scripts]" style="width: 99%;"><?php $catalyst_footer_scripts = catalyst_get_custom_field( '_catalyst_footer_scripts' ); echo ( !empty( $catalyst_footer_scripts ) ) ? $catalyst_footer_scripts : ''; ?></textarea></p>
			</td>
		</tr>
		<tr>
			<td>				
				<p><label for="catalyst_custom_body_class"><strong><?php _e( 'Custom Body Class', 'catalyst' ); ?></strong><br><code>&lt;body class=""&gt;</code></label></p>
				<p><input type="text" value="<?php $catalyst_custom_body_class = catalyst_get_custom_field( '_catalyst_custom_body_class' ); echo ( !empty( $catalyst_custom_body_class ) ) ? esc_attr( $catalyst_custom_body_class ) : ''; ?>" id="catalyst_custom_body_class" name="catalyst_options[_catalyst_custom_body_class]" style="width: 99%;"></p>
			</td>
			<td>				
				<p><label for="catalyst_custom_post_class"><strong><?php _e( 'Custom Post Class', 'catalyst' ); ?></strong><br><code>&lt;article class=""&gt;</code></label></p>
				<p><input type="text" value="<?php $catalyst_custom_post_class = catalyst_get_custom_field( '_catalyst_custom_post_class' ); echo ( !empty( $catalyst_custom_post_class ) ) ? esc_attr( $catalyst_custom_post_class ) : ''; ?>" id="catalyst_custom_post_class" name="catalyst_options[_catalyst_custom_post_class]" style="width: 99%;"></p>
			</td>
		</tr>
		<tr<?php echo $seo_style ?>>
			<td>
				<p><input type="checkbox" name="catalyst_options[_catalyst_noindex]" id="catalyst_noindex" value="1" <?php checked(1, catalyst_get_custom_field( '_catalyst_noindex' ) ); ?> /> 
				<label for="catalyst_noindex"><?php printf( __( 'Apply %s to this post/page', 'catalyst' ), '<code>noindex</code>' ); ?> <a href="http://www.seoconsultants.com/meta-tags/robots/" target="_blank">[?]</a></label><br />
				<input type="checkbox" name="catalyst_options[_catalyst_nofollow]" id="catalyst_nofollow" value="1" <?php checked(1, catalyst_get_custom_field( '_catalyst_nofollow' ) ); ?> /> 
				<label for="catalyst_nofollow"><?php printf( __( 'Apply %s to this post/page', 'catalyst' ), '<code>nofollow</code>' ); ?> <a href="http://www.seoconsultants.com/meta-tags/robots/" target="_blank">[?]</a></label><br />
				<input type="checkbox" name="catalyst_options[_catalyst_noarchive]" id="catalyst_noarchive" value="1" <?php checked(1, catalyst_get_custom_field( '_catalyst_noarchive' ) ); ?> /> 
				<label for="catalyst_noarchive"><?php printf( __( 'Apply %s to this post/page', 'catalyst' ), '<code>noarchive</code>' ); ?> <a href="http://www.seoconsultants.com/meta-tags/robots/" target="_blank">[?]</a></label></p>
			</td>
		</tr>
	</table>
	</div>
<?php
}

add_action( 'save_post', 'catalyst_save_postdata' );
/**
 * Provide Catalyst In-Post/In-Page options with save/update functionality.
 *
 * @since 1.0
 */
function catalyst_save_postdata( $post_id )
{
	global $post;
	
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if( defined( 'DOING_AJAX' ) && DOING_AJAX ) return;
	if( defined( 'DOING_CRON' ) && DOING_CRON ) return;
	
	$catalyst_options_defaults = array(
		'_catalyst_title' => '',
		'_catalyst_description' => '',
		'_catalyst_keywords' => '',
		'_catalyst_noindex' => 0,
		'_catalyst_nofollow' => 0,
		'_catalyst_noarchive' => 0,
		'_catalyst_header_scripts' => '',
		'_catalyst_footer_scripts' => ''
	); 

	if( !empty( $_POST['catalyst_options'] ) )
	{
		$catalyst_options = wp_parse_args( $_POST['catalyst_options'], $catalyst_options_defaults );
		
		foreach( $catalyst_options as $key => $value )
		{
			if( $post->post_type == 'revision' ) return;

			if( $value )
			{
				update_post_meta( $post->ID, $key, $value );
			}
			else
			{
				delete_post_meta( $post->ID, $key );
			}
		}
	}
}

/**
 * Provides a "filtered" value for each Catalyst In-Post/In-Page option.
 *
 * @since 1.0
 * @return "filtered" value for each Catalyst In-Post/In-Page option or nothing if value is empty.
 */
function catalyst_get_custom_field( $field )
{
	global $post;
	
	if( null === $post ) return false;
	
	$custom_field = get_post_meta( $post->ID, $field, true );
	
	if( $custom_field )
	{
		return wp_kses_stripslashes( wp_kses_decode_entities( $custom_field ) );
	}
	else
	{
		return false;
	}
}

add_action( 'show_user_profile', 'catalyst_user_archive_options' );
add_action( 'edit_user_profile', 'catalyst_user_archive_options' );
/**
 * Build archive options for User Profile area.
 *
 * @since 1.0
 */
function catalyst_user_archive_options( $user )
{
	if( ! current_user_can( 'edit_users', $user->ID ) )
		return false;
		
?>
		<h3><?php _e('Catalyst Author Archive Options', 'catalyst'); ?></h3>
		<p><span class="description"><?php _e('These Archive Options will be applied to this author\'s archive pages.', 'catalyst'); ?></span></p>
		<table class="form-table"><tbody>

		<tr>
			<th scope="row" valign="top"><label for="heading"><?php _e( 'Author Archive Heading', 'catalyst' ); ?></label></th>
			<td><input name="meta[heading]" id="heading" type="text" value="<?php echo esc_attr( get_the_author_meta('heading', $user->ID) ); ?>" class="regular-text" /><br />
			<span class="description"><?php printf( __('Displays inside %s tags at the top of the first page', 'catalyst'), '<code>&lt;h1&gt;</code>' ); ?></span></td>
		</tr>

		<tr>
			<th scope="row" valign="top"><label for="author_description"><?php _e( 'Author Archive Description', 'catalyst' ); ?></label></th>
			<td><textarea name="meta[author_description]" id="author_description" rows="5" cols="30"><?php echo esc_textarea( get_the_author_meta('author_description', $user->ID) ); ?></textarea><br />
			<span class="description"><?php _e('Displays at the top of the first page', 'catalyst'); ?></span></td>
		</tr>
		
		<style type="text/css">body.profile-php .no-display { display:none; }</style>
		
		<tr>
			<th scope="row" valign="top"><label><?php _e( 'Author Archive Layout', 'catalyst' ); ?></label></th>
			<td>
				<select id="catalyst_layout" name="meta[user_author_archive_layout]"><?php $catalyst_layout = get_the_author_meta( 'user_author_archive_layout', $user->ID); catalyst_list_layouts( $catalyst_layout ); ?></select>
			</td>
		</tr>
		
		<tr>
			<th scope="row" valign="top"><label for="author_alt_link"><?php _e( 'Alternate Author Link', 'catalyst' ); ?></label></th>
			<td><input name="meta[author_alt_link]" id="author_alt_link" type="text" value="<?php echo esc_attr( get_the_author_meta('author_alt_link', $user->ID) ); ?>" class="regular-text" /><br />
			<span class="description"><?php _e('Add custom URL to link author to page other than author archive', 'catalyst'); ?></span></td>
		</tr>

		</tbody></table>
<?php
}

add_action( 'show_user_profile', 'catalyst_user_seo_options' );
add_action( 'edit_user_profile', 'catalyst_user_seo_options' );
/**
 * Build SEO options for User Profile area.
 *
 * @since 1.0
 */
function catalyst_user_seo_options( $user )
{
	global $catalyst_seo_active;
	if( !current_user_can( 'edit_users', $user->ID ) )
		return false;
	
	if( !$catalyst_seo_active )
		return;
?>
		<h3><?php _e('Catalyst SEO Options', 'catalyst'); ?></h3>
		<p><span class="description"><?php _e('These SEO options will be applied to this author\'s archive pages.', 'catalyst'); ?></span></p>
		<table class="form-table"><tbody>

		<tr>
			<th scope="row" valign="top"><label for="doctitle"><?php _e( 'Document Title', 'catalyst' ); ?></label></th>
			<td><input name="meta[doctitle]" id="doctitle" type="text" value="<?php echo esc_attr( get_the_author_meta( 'doctitle', $user->ID ) ); ?>" class="regular-text" /></td>
		</tr>

		<tr>
			<th scope="row" valign="top"><label for="meta-description"><?php _e( 'Meta Description', 'catalyst' ); ?></label></th>
			<td><textarea name="meta[meta_description]" id="meta-description" rows="5" cols="30"><?php echo esc_textarea( get_the_author_meta( 'meta_description', $user->ID ) ); ?></textarea></td>
		</tr>

		<tr>
			<th scope="row" valign="top"><label for="meta-keywords"><?php _e( 'Meta Keywords', 'catalyst' ); ?></label></th>
			<td><input name="meta[meta_keywords]" id="meta-keywords" type="text" value="<?php echo esc_attr( get_the_author_meta( 'meta_keywords', $user->ID ) ); ?>" class="regular-text" /><br />
			<span class="description"><?php _e('Comma separated list', 'catalyst'); ?></span></td>
		</tr>

		<tr>
			<th scope="row" valign="top"><label><?php _e('Robots Meta', 'catalyst'); ?></label></th>
			<td>
				<label><input name="meta[noindex]" id="noindex" type="checkbox" value="1" <?php checked( 1, get_the_author_meta( 'noindex', $user->ID ) ); ?> /> <?php printf( __('Apply %s to this archive?', 'catalyst'), '<code>noindex</code>' ); ?></label><br />
				<label><input name="meta[nofollow]" id="nofollow" type="checkbox" value="1" <?php checked( 1, get_the_author_meta( 'nofollow', $user->ID ) ); ?> /> <?php printf( __('Apply %s to this archive?', 'catalyst'), '<code>nofollow</code>' ); ?></label><br />
				<label><input name="meta[noarchive]" id="noarchive" type="checkbox" value="1" <?php checked( 1, get_the_author_meta( 'noarchive', $user->ID ) ); ?> /> <?php printf( __('Apply %s to this archive?', 'catalyst'), '<code>noarchive</code>' ); ?></label>
			</td>
		</tr>

		</tbody></table>
<?php
}

add_action( 'show_user_profile', 'catalyst_user_options' );
add_action( 'edit_user_profile', 'catalyst_user_options' );
/**
 * Build general options for User Profile area.
 *
 * @since 1.0
 */
function catalyst_user_options( $user )
{
	if( !current_user_can( 'edit_users', $user->ID ) )
		return false;
?>
	<h3><?php _e( 'Catalyst User Options', 'catalyst' ); ?></h3>
	<table class="form-table">
		
		<tr>
			<th scope="row" valign="top"><label><?php _e( 'Catalyst Admin Menus', 'catalyst' ); ?></label></th>
			<td>
				<label><input name="meta[disable_catalyst_admin_menu]" type="checkbox" value="1" <?php checked( 1, get_the_author_meta( 'disable_catalyst_admin_menu', $user->ID ) ); ?> /> <?php _e( 'Disable Entire Catalyst Admin Menu?', 'catalyst' ); ?></label><br />
				<label><input name="meta[disable_catalyst_dynamik_submenu]" type="checkbox" value="1" <?php checked( 1, get_the_author_meta( 'disable_catalyst_dynamik_submenu', $user->ID ) ); ?> /> <?php _e( 'Disable Catalyst Dynamik Options Submenu?', 'catalyst' ); ?></label><br />
				<label><input name="meta[disable_catalyst_advanced_submenu]" type="checkbox" value="1" <?php checked( 1, get_the_author_meta( 'disable_catalyst_advanced_submenu', $user->ID ) ); ?> /> <?php _e( 'Disable Catalyst Advanced Options Submenu?', 'catalyst' ); ?></label>
			</td>
		</tr>
		
		<tr>
			<th scope="row" valign="top"><label><?php _e( 'Catalyst Auto-Update', 'catalyst' ); ?></label></th>
			<td>
				<label><input name="meta[disable_catalyst_update_nag]" type="checkbox" value="1" <?php checked( 1, get_the_author_meta( 'disable_catalyst_update_nag', $user->ID ) ); ?> /> <?php _e( 'Disable Catalyst Auto-Update Nag?', 'catalyst' ); ?></label>
			</td>
		</tr>
	
	</table>
<?php
}

add_action( 'personal_options_update', 'catalyst_user_meta_save' );
add_action( 'edit_user_profile_update', 'catalyst_user_meta_save' );
/**
 * Provide Catalyst User Profile options with save/update functionality.
 *
 * @since 1.0
 */
function catalyst_user_meta_save( $user_id )
{
	if( !current_user_can( 'edit_users', $user_id ) )
		return;
		
	if( !isset( $_POST['meta'] ) || !is_array( $_POST['meta'] ) )
		return;
		
	$meta = wp_parse_args( $_POST['meta'], array(
		'heading' => '',
		'author_description' => '',
		'user_author_archive_layout' => 'catalyst_default',
		'author_alt_link' => '',
		'doctitle' => '',
		'meta_description' => '',
		'meta_keywords' => '',
		'noindex' => '',
		'nofollow' => '',
		'noarchive' => '',
		'disable_catalyst_admin_menu' => '',
		'disable_catalyst_dynamik_submenu' => '',
		'disable_catalyst_advanced_submenu' => '',
		'disable_catalyst_update_nag' => ''
	) );
		
	foreach( $meta as $key => $value )
	{
		update_user_meta( $user_id, $key, $value );
	}
	
}

add_action( 'admin_init', 'catalyst_add_taxonomy_seo_options' );
/**
 * Add Catalyst SEO options to the taxonomy edit pages.
 *
 * @since 1.0
 */
function catalyst_add_taxonomy_seo_options()
{
	global $catalyst_seo_active;
	
	if( !$catalyst_seo_active )
		return;
		
	foreach ( get_taxonomies( array( 'show_ui' => true ) ) as $tax_name )
	{
		add_action( $tax_name . '_edit_form', 'catalyst_taxonomy_seo_options', 11, 2 );
	}
}

/**
 * Build the Catalyst SEO options for the taxonomy edit pages.
 *
 * @since 1.0
 */
function catalyst_taxonomy_seo_options( $tag, $taxonomy )
{
	$tax = get_taxonomy( $taxonomy );
?>
	<h3><?php _e('Catalyst SEO Options', 'catalyst'); ?></h3>
	<p><span class="description"><?php _e('These SEO options will be applied to this Taxonomy\'s archive pages.', 'catalyst'); ?></span></p>
	<table class="form-table"><tbody>
	<?php if( isset( $tag->meta['doctitle'] ) ) { $doctitle = esc_attr( $tag->meta['doctitle'] ); } else { $doctitle = ''; } ?>
	<tr class="form-field">
		<th scope="row" valign="top"><label for="meta[doctitle]"><?php _e( 'Document Title', 'catalyst' ); ?></label></th>
		<td><input name="meta[doctitle]" id="meta[doctitle]" type="text" value="<?php echo $doctitle; ?>" size="40" />
		</td>
	</tr>
	<?php if( isset( $tag->meta['description'] ) ) { $description = esc_attr( $tag->meta['description'] ); } else { $description = ''; } ?>
	<tr class="form-field">
		<th scope="row" valign="top"><label for="meta[description]"><?php _e( 'Meta Description', 'catalyst' ); ?></label></th>
		<td><textarea name="meta[description]" id="meta[description]" rows="3" cols="50"><?php echo $description; ?></textarea></td>
	</tr>
	<?php if( isset( $tag->meta['keywords'] ) ) { $keywords = esc_attr( $tag->meta['keywords'] ); } else { $keywords = ''; } ?>
	<tr class="form-field">
		<th scope="row" valign="top"><label for="meta[keywords]"><?php _e( 'Meta Keywords', 'catalyst' ); ?></label></th>
		<td><input name="meta[keywords]" id="meta[keywords]" type="text" value="<?php echo $keywords; ?>" size="40" />
		<p class="description"><?php _e('Comma separated list', 'catalyst'); ?></p></td>
	</tr>

	<tr>
		<th scope="row" valign="top"><label><?php _e('Robots Meta', 'catalyst'); ?></label></th>
		<td>
			<label><input name="meta[noindex]" id="meta[noindex]" type="checkbox" value="1" <?php if( isset( $tag->meta['noindex'] ) && checked( 1, $tag->meta['noindex'] ) ); ?> /> <?php printf( __('Apply %s to this archive?', 'catalyst'), '<code>noindex</code>' ); ?></label><br />
			<label><input name="meta[nofollow]" id="meta[nofollow]" type="checkbox" value="1" <?php if( isset( $tag->meta['nofollow'] ) && checked( 1, $tag->meta['nofollow'] ) ); ?> /> <?php printf( __('Apply %s to this archive?', 'catalyst'), '<code>nofollow</code>' ); ?></label><br />
			<label><input name="meta[noarchive]" id="meta[noarchive]" type="checkbox" value="1" <?php if( isset( $tag->meta['noarchive'] ) && checked( 1, $tag->meta['noarchive'] ) ); ?> /> <?php printf( __('Apply %s to this archive?', 'catalyst'), '<code>noarchive</code>' ); ?></label>
		</td>
	</tr>

	</tbody></table>
<?php
}

add_action( 'admin_init', 'catalyst_add_taxonomy_archive_options' );
/**
 * Add Catalyst archive options to the taxonomy edit pages.
 *
 * @since 1.0
 */
function catalyst_add_taxonomy_archive_options()
{
	foreach ( get_taxonomies( array( 'show_ui' => true ) ) as $tax_name)
	{
		add_action( $tax_name . '_edit_form', 'catalyst_taxonomy_archive_options', 10, 2 );
	}
}

/**
 * Build the Catalyst archive options for the taxonomy edit pages.
 *
 * @since 1.0
 */
function catalyst_taxonomy_archive_options( $tag, $taxonomy )
{
	$tax = get_taxonomy( $taxonomy );
?>
	<h3><?php _e('Catalyst Archive Options', 'catalyst'); ?></h3>
	<table class="form-table"><tbody>

	<tr>
		<th scope="row" valign="top"><label><?php _e('Display Title/Description', 'catalyst'); ?></label></th>
		<td>
			<label><input name="meta[display_title]" type="checkbox" value="1" <?php if( isset( $tag->meta['display_title'] ) && checked( 1, $tag->meta['display_title'] ) ); ?> /> <?php printf( __('Display the %s Name at the top of its archive pages?', 'catalyst'), esc_html( $tax->labels->singular_name ) ); ?></label><br />
			<label><input name="meta[display_description]" type="checkbox" value="1" <?php if( isset( $tag->meta['display_description'] ) && checked( 1, $tag->meta['display_description'] ) ); ?> /> <?php printf( __('Display the %s Description at the top of its archive pages?', 'catalyst'), esc_html( $tax->labels->singular_name ) ); ?></label>
		</td>
	</tr>
	<style type="text/css">body.edit-tags-php .no-display { display:none; }</style>
	<tr>
		<th scope="row" valign="top"><label><?php _e( 'Select Archive Layout', 'catalyst' ); ?></label></th>
		<td>			
			<p style="clear: both;">
			
			<select id="catalyst-taxonomy-layout" name="meta[layout]"><?php $catalyst_layout = $tag->meta['layout']; catalyst_list_layouts( $catalyst_layout ); ?></select>
			<br style="clear: both;" /></p>
		</td>
	</tr>

	</tbody></table>
<?php
}

add_action( 'edit_term', 'catalyst_save_term_meta', 10, 2 );
/**
 * Provide Catalyst taxonomy options with save/update functionality.
 *
 * @since 1.0
 */
function catalyst_save_term_meta( $term_id, $tt_id )
{
	$term_meta = ( array ) get_option( 'catalyst_term_meta_options' );
	
	$term_meta[$term_id] = isset( $_POST['meta'] ) ? ( array ) $_POST['meta'] : array();
	
	update_option( 'catalyst_term_meta_options', $term_meta );
}

add_action( 'delete_term', 'catalyst_delete_term_meta', 10, 2 );
/**
 * Provide Catalyst taxonomy options with delete functionality.
 *
 * @since 1.0
 */
function catalyst_delete_term_meta( $term_id, $tt_id )
{
	$term_meta = ( array ) get_option( 'catalyst_term_meta_options' );
	
	unset( $term_meta[$term_id] );
	
	update_option( 'catalyst_term_meta_options', ( array ) $term_meta );
}

add_filter( 'get_term', 'catalyst_filter_get_term', 10, 2 );
/**
 * Filter Catalyst term-meta into the options table.
 *
 * @since 1.0
 * @return "filtered" term-meta value.
 */
function catalyst_filter_get_term( $term, $taxonomy )
{
	$db = get_option( 'catalyst_term_meta_options' );
	$term_meta = isset( $db[$term->term_id] ) ? $db[$term->term_id] : array();
	
	$term->meta = wp_parse_args( $term_meta, array(
			'layout' => ''
	) );
	
	foreach ( $term->meta as $field => $value )
	{
		$term->meta[$field] = stripslashes( wp_kses_decode_entities( $value ) );
	}
	
	return $term;
}

//end lib/functions/catalyst-meta-box.php