<?php
/**
 * Builds the Dynamik Image Uploader admin content.
 *
 * @package Catalyst
 */
?>

<?php global $catalyst_multisite; if( defined( 'DYNAMIK_ACTIVE' ) ) { $child_name = 'dynamik'; $child_dir = 'dynamik'; } else { $nav_alt_id = ''; $child_name = 'child'; $child_dir = '[Child Theme Directory]'; } ?>
<div id="catalyst-<?php echo $child_name; ?>-options-nav-<?php echo $nav_alt_id; ?>image-uploader-box" class="catalyst-optionbox-outer-1col catalyst-all-options">
	<div class="catalyst-optionbox-inner-1col catalyst-uploader-inner-1col">
		<h3 style="-webkit-border-radius:3px 3px 0 0; border-radius:3px 3px 0 0;"><?php _e( 'Image Uploader: Images are uploaded to the', 'catalyst' ); ?> <code>/wp-content/themes/<?php echo $child_dir; ?>/css/images/<?php if( $catalyst_multisite ) { echo $catalyst_multisite; ?>/<?php } ?></code><?php _e( 'directory.', 'catalyst' ); ?></h3>
		<div style="float:left; padding:10px 10px 10px 0; border:1px solid #E3E3E3; border-top:0; background:#FFFFFF;">
			<div class='placeholder'>
			
				<div class='containercontent'>
					<div class='containercontent-input'>
						<p>
							<form method="post" action="?page=<?php echo $child_name; ?>-options&activetab=catalyst-<?php echo $child_name; ?>-options-nav-image-uploader&fct=upload" enctype="multipart/form-data" >
								<input type="file" name="image" size="60" class="fileinput" ></input>
							<div id="upload-progress" style="display:none" class="uploadprogress">
								<?php _e( 'Please wait, uploading image.', 'catalyst' ); ?>
							</div>
						</p>
					</div>
			
					<?php if( !empty( $message ) ) { echo $message; } ?>
			
					<div class="buttoncontainer">
						<input type="submit" name="upload" value="Upload Image" class="upload-button" onClick="displayLoading();"></input>
					</div>
						</form>
				<!--This code displays success and error messages when they occur-->
				</div>

			</div>
			<form method="post" action="?page=<?php echo $child_name; ?>-options&activetab=catalyst-<?php echo $child_name; ?>-options-nav-image-uploader&fct=bulkdelete" onSubmit="return verify()">
			<?php listimages(); ?>
			<div class="buttoncontainer">
				<p style="margin-left:7px;">
					<input class="upload-button" type="submit" value="Delete Selected Images" name="action"/>
				</p>
				
				<span onclick="jQuery('input[type=checkbox].image_check').removeAttr('checked')" class="button"><?php _e( 'Deselect All', 'catalyst' ); ?></span>		
				<span onclick="jQuery('input[type=checkbox].image_check').attr('checked', 'checked')" class="button"><?php _e( 'Select All', 'catalyst' ); ?></span>				
			</div>
			</form>
		</div>
	</div>
</div>