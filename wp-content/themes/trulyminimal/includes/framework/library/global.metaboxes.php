<?php
global $panel_options;

$framework_showmetaboxes = false;

/*-------------------------------------------------------------
*   Check if layout option exists
*------------------------------------------------------------*/
foreach( $panel_options as $tab ) :
	if( $tab['type'] == "layout" ) : foreach( $tab['options'] as $option ):
		if( isset($option['options']) ) :

			$framework_showmetaboxes = true;

		endif;
	endforeach; endif;
endforeach;

/*-------------------------------------------------------------
*   Create metaboxes
*------------------------------------------------------------*/
function framework_create_metaboxes() {
	add_meta_box("layout-info", "Theme Options", "framework_init_metaboxes_fp", "post");
	add_meta_box("layout-info", "Theme Options", "framework_init_metaboxes_fp", "page");

	add_action('save_post','framework_save_metaboxes');
}

if($framework_showmetaboxes)
	add_action('admin_init', 'framework_create_metaboxes');

/*-------------------------------------------------------------
*   Metaboxes design
*------------------------------------------------------------*/
function framework_init_metaboxes_fp() {
	global $post;

	$customData = get_post_custom($post->ID); ?>

	<div class="fpMetaboxes">
		<div class="option-title">
			<strong>Layout</strong><br>
			<small>Select The Layout Style For This Post.</small>
		</div>

		<div class="option-content">
							
			<label for="fplayout">Layout</label><br>
			<select name="fplayout" id="fplayout">
				<option name="fplayout" value="default">Default</option>

				<?php global $panel_options;
				foreach( $panel_options as $tab ) :
					if( $tab['type'] == "layout" ) : foreach( $tab['options'] as $option ):
						if( isset($option['options']) ) : foreach( $option['options'] as $slug => $name ) : ?>

								<option name="fplayout" value="<?php echo $slug; ?>"<?php if( isset($customData['fplayout']) && ($customData['fplayout'][0] == $slug) ) : ?> selected="selected"<?php endif; ?>><?php echo $name; ?></option>

						<?php endforeach; endif;
					endforeach; endif;
				endforeach; ?>

			</select>
			<br style="clear: both;">
		</div>
	</div>

	<input type="hidden" name="framework_noncename" value="<?php echo wp_create_nonce(__FILE__); ?>" />
	<?php	
}

/*-------------------------------------------------------------
*   Save metaboxes
*------------------------------------------------------------*/
function framework_save_metaboxes($postId) {
	if ( !isset($_POST['post_type']) ) return $postId;
	if ( !isset($_POST['framework_noncename']) ) return $postId;

	if ( (!wp_verify_nonce($_POST['framework_noncename'],__FILE__)) ) return $postId;

	if ( ($_POST['post_type'] == 'post') || ($_POST['post_type'] == 'page') ) {
		if (!current_user_can('edit_post', $postId)) return $postId;
		if (!current_user_can('edit_page', $postId)) return $postId;
	} else {
		return $postId;
	}

	update_post_meta($postId, 'fplayout', $_POST['fplayout']);

	return $postId;
}
?>