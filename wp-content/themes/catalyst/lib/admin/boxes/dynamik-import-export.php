<?php
/**
 * Builds the Dynamik Import/Export admin content.
 *
 * @package Catalyst
 */
?>

<div id="catalyst-dynamik-options-nav-<?php echo $nav_alt_id; ?>import-export-box" class="catalyst-optionbox-outer-1col catalyst-all-options">
	<div class="catalyst-optionbox-inner-1col">
		<h3><?php _e( 'Dynamik Import/Export Options', 'catalyst' ); ?></h3>
		
<?php	if( !empty( $_GET['notice'] ) )
		{
			if( $_GET['notice'] == 'double-error' )
			{
?>				<div id="notice-box" style="background:#FFFBCC;border:1px solid #E6DB55;color:red;text-align:center;margin:15px 0 0;padding:5px;"><strong><?php _e( 'Child Theme Export for Distribution requires Double Sidebars', 'catalyst' ); ?></strong></div>
<?php		}
			elseif( $_GET['notice'] == 'import-error' )
			{
?>				<div id="notice-box" style="background:#FFFBCC;border:1px solid #E6DB55;color:#555555;text-align:center;margin:15px 0 0;padding:5px;"><strong><?php _e( 'Dynamik Import Error: Import File Must Be In .zip or .dat Format (ie. my_backup.zip or my_backup.dat)', 'catalyst' ); ?></strong></div>
<?php		}
			elseif( $_GET['notice'] == 'import-genesis-complete' )
			{
?>				<div id="notice-box" style="background:#FFFBCC;border:1px solid #E6DB55;color:#555555;text-align:center;margin:15px 0 0;padding:5px;clear:both;"><strong><?php _e( 'Dynamik Import Complete: Please note that since this was a Genesis/Dynamik Skin, and therefore not 100% transferable, you may need to tweak the options a bit to get the design just right.', 'catalyst' ); ?></strong></div>
<?php		}
			elseif( $_GET['notice'] == 'import-complete' )
			{
?>				<div id="notice-box" style="background:#FFFBCC;border:1px solid #E6DB55;color:#555555;text-align:center;margin:15px 0 0;padding:5px;"><strong><?php _e( 'Dynamik Import Complete', 'catalyst' ); ?></strong></div>
<?php		}
		}
?>		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Dynamik Options Export', 'catalyst' ); ?></p>
		</div>
		
		<form method="post">
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<strong><?php _e( 'Export File Name:', 'catalyst' ); ?></strong> <input type="text" id="dynamik-export-name" name="dynamik_export_name" value="" style="width:190px; margin-bottom:5px;" class="forbid-chars" />
				<input type="checkbox" value="include_images" name="include_images[]" value="1" checked > <?php _e( 'Include Images?', 'catalyst' ); ?>
				<input type="submit" name="clicked_button" value="<?php _e( 'Dynamik Export', 'catalyst' ); ?>" class="button-highlighted"/>
				<input type="hidden" name="action" value="catalyst_dynamik_export">
			</p>
		</div>
		</form>
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Dynamik Options Import', 'catalyst' ); ?></p>
		</div>
		
		<form method="post" style="padding-bottom:10px;" enctype="multipart/form-data">
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<strong><?php _e( 'Dynamik Import File:', 'catalyst' ); ?></strong> <input style="width:225px;" name="dynamik_import_file" type="file" />
				<input type="submit" name="clicked_button" value="<?php _e( 'Dynamik Import', 'catalyst' ); ?>" class="button-highlighted"/>
				<input type="hidden" name="action" value="catalyst_dynamik_import">	
			</p>
		</div>
		</form>
	</div>
	
	<div class="catalyst-optionbox-inner-1col">
		<h3><?php _e( 'Dynamik Options Snapshot', 'catalyst' ); ?> <span id="dynamik-options-snapshot-tooltip" class="tooltip-mark tooltip-center-left">[?]</span></h3>
		
		<div class="tooltip tooltip-400">
			<h5><?php _e( 'Creating A Snapshot of Your Dynamik Options:', 'catalyst' ); ?></h5>
			<p style="padding-top:10px !important;">
				<?php _e( 'These Snapshot options allow you to take a snapshot of your current Dynamik Options, locking them down in case you ever want or need to revert back to them.', 'catalyst' ); ?>
			</p>
			<p style="padding-top:0 !important;">
				<?php _e( 'It\'s easy to do. Just type into the "Snapshot Notes" box a simple reminder of what your current Dynamik Options reflect (eg. "Light blue background with thick gray #wrap border" etc..) then click the "Update Snapshot" button below. The "Snapshot Notes" are totally optional, there if you need them, but the timestamp will update as well which may be all the info you need.', 'catalyst' ); ?>
			</p>
			
			<p style="padding-top:0 !important;">
				<?php _e( 'Restoring to your current Snapshot is even easier. Just click the "Restore From Snapshot" button and you\'re done.', 'catalyst' ); ?>
			</p>
			
			<p style="padding-top:0 !important;">
				<?php _e( '<strong>TIP #1:</strong> This is a great tool for getting to a good place in your design, taking a Snapshot and then trying some different design changes that may or may not work out. If they do, great! If not, just restore back to your Snapshot and move on.', 'catalyst' ); ?>
			</p>
			
			<p style="padding-top:0 !important;">
				<?php _e( '<strong>TIP #2:</strong> Though this can certainly be used as a simple backup solution for your Dynamik Options it\'s really not ideal for this. If your website\'s database were to ever become corrupt this would most likely effect ALL your Catalyst/WordPress settings, destroying this Snapshot. The best way to backup your Dynamik Options using the tools Catalyst provides is with a Dynamik Options Export.', 'catalyst' ); ?>
			</p>
		</div>
		
<?php	if( !empty( $_GET['notice'] ) )
		{
			if( $_GET['notice'] == 'snapshot-update-complete' )
			{
?>				<div id="notice-box" style="background-color:#FFFBCC;border:1px solid #E6DB55;color:#555555;text-align:center;margin:15px 0px 0px 0px;padding:5px;"><strong><?php _e( 'Dynamik Options Snapshot Update Complete', 'catalyst' ); ?></strong></div>
<?php		}
			elseif( $_GET['notice'] == 'snapshot-restore-complete' )
			{
?>				<div id="notice-box" style="background-color:#FFFBCC;border:1px solid #E6DB55;color:#555555;text-align:center;margin:15px 0px 0px 0px;padding:5px;"><strong><?php _e( 'Dynamik Options Snapshot Restore Complete', 'catalyst' ); ?></strong></div>
<?php		}
		}
?>		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Update Dynamik Options Snapshot', 'catalyst' ); ?></p>
		</div>
		
		<form method="post">
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<input type="submit" name="clicked_button" value="<?php _e( 'Update Snapshot', 'catalyst' ); ?>" onClick='return confirm("<?php _e( 'Note: This will overwrite your previous Snapshot state with your current Dynamik settings. Click OK to proceed?', 'catalyst' ); ?>")' class="button-highlighted"/>
				<input type="hidden" name="action" value="catalyst_dynamik_snapshot_update">
				<?php _e( 'Current Snapshot Timestamp: ', 'catalyst' ); echo $catalyst_dynamik_snapshot_options['timestamp']; ?>
				<span class="catalyst-custom-fonts-button-wrap"><span id="show-dynamik-snapshot-notes" class="catalyst-custom-fonts-button">Snapshot Notes</span></span>
				<div style="display:none;" id="show-dynamik-snapshot-notes-box" class="catalyst-custom-fonts-box">
				<textarea id="catalyst-dynamik-snapshot-notes" name="catalyst[dynamik_snapshot_notes]" style="width:100%; margin-bottom:-3px;" rows="10"><?php if( $catalyst_dynamik_snapshot_options['dynamik_snapshot_options']['dynamik_snapshot_notes'] ) echo stripslashes( $catalyst_dynamik_snapshot_options['dynamik_snapshot_options']['dynamik_snapshot_notes'] ); ?></textarea>
				</div>
			</p>
		</div>
		</form>
		
		<div class="catalyst-dynamik-option-desc">
			<p><?php _e( 'Restore From Dynamik Options Snapshot', 'catalyst' ); ?></p>
		</div>
		
		<form method="post">
		<div class="catalyst-dynamik-option">
			<p class="bg-box-design">
				<input type="submit" name="clicked_button" value="<?php _e( 'Restore From Snapshot', 'catalyst' ); ?>" onClick='return confirm("<?php _e( 'Are you sure your want to restore your Dynamik Options to your current Snapshot state?', 'catalyst' ); ?>")' class="button-highlighted"/>
				<input type="hidden" name="action" value="catalyst_dynamik_snapshot_restore">
			</p>
		</div>
		</form>
	</div>
		
	<div class="catalyst-optionbox-inner-1col">
		<h3 style="-webkit-border-radius:6px 6px 0 0; border-radius:6px 6px 0 0;"><?php _e( 'Catalyst Child Theme Export', 'catalyst' ); ?> <span id="child-theme-export-tooltip" class="tooltip-mark tooltip-center-left">[?]</span></h3>
		
		<div class="tooltip tooltip-400">
			<h5><?php _e( 'Exporting Your Dynamik Designs as Catalyst Child Themes:', 'catalyst' ); ?></h5>
			<p style="padding-top:10px !important;">
				<?php _e( 'This feature allows you to export your design from Dynamik as a Catalyst Child Theme which can then be installed and activated on any site that has Catalyst installed. You can use the exported Child Theme "as-is", or as a starting point for refining styles and adding custom functionality.', 'catalyst' ); ?>
			</p>
			<span class="tooltip-credit">
				<?php _e( 'You can read more about WordPress Child Themes here:', 'catalyst' ); ?>
				<br /><a href="http://codex.wordpress.org/Child_Themes">http://codex.wordpress.org/Child_Themes</a>
			</span>
		</div>
				
		<div style="width:792px; float:left; padding:10px 10px 10px 0; border:1px solid #E3E3E3; border-top:0; background:#FFFFFF;">
			<div style="width:60%; float:left;">
				<div id="readme-box" style="margin-right:0; margin-bottom:0; height:237px;">
					<h5><?php _e( 'How To Use Catalyst Child Theme Export:', 'catalyst' ); ?></h5>
					<p style="margin-top:-15px;">
						<?php _e( '<span style="font-family:verdana, sans-serif; font-weight:bold; font-size:14px; color:#014662;">Step 1:</span> Fill in the Form Fields.', 'catalyst' ); ?>
						<span id="child-theme-export-step1-tooltip" class="tooltip-mark tooltip-center-right">[?]</span>
					</p>
								
					<div class="tooltip tooltip-400">							
						<h5><?php _e( 'Filling In The Form Fields:', 'catalyst' ); ?></h5>
						
						<p>
							<?php _e( '<strong>Theme Name:</strong> Pick a name for your Child Theme.<br /><strong>Author:</strong> This is for your name or the name of your organization.<br /><strong>Author URI:</strong> Place your website address here.', 'catalyst' ); ?>
						</p>
						
						<h5><?php _e( 'Including Child Theme Images:', 'catalyst' ); ?></h5>
						
						<p>
							<?php _e( 'In order to be included in the export, your Child Theme\'s images must all be uploaded using the Dynamik Image Uploader.', 'catalyst' ); ?>
						</p>
						<p>
							<?php _e( 'If you want to have a custom image appear for your Child Theme in Appearance > Themes (once your Child Theme has been uploaded for activation), create a .png image 300 pixels wide by 225 pixels tall, and name it screenshot.png.', 'catalyst' ); ?>
						</p>
						<p>
							<?php _e( 'Note that this image will be automatically separated by Dynamik upon Child Theme Export so it will not be included in your Exported Child Theme\'s /images/ folder.', 'catalyst' ); ?>
						</p>
					</div>
					
					<p>
						<?php _e( '<span style="font-family:verdana, sans-serif; font-weight:bold; font-size:14px; color:#014662;">Step 2:</span> Choose whether or not to include a reference to Catalyst\'s style.css in your Child Theme stylesheet.', 'catalyst' ); ?>
						<span id="child-theme-export-step2-tooltip" class="tooltip-mark tooltip-center-right">[?]</span>
					</p>
					
					<div class="tooltip tooltip-400">							
						<h5><?php _e( 'Include Reference to Catalyst style.css?', 'catalyst' ); ?></h5>
						
						<p>
							<?php _e( 'If checked, this pulls in Catalyst\'s default CSS styles as a fallback for your child theme/custom styles. If you are not sure then it is recommended that you leave this unchecked as by default Dynamik already provides all the necessary styles.', 'catalyst' ); ?>
						</p>
					</div>
					
					<p>
						<?php _e( '<span style="font-family:verdana, sans-serif; font-weight:bold; font-size:14px; color:#014662;">Step 3:</span> Choose which type of Export you would like to perform.', 'catalyst' ); ?>
						<span id="child-theme-export-step3-tooltip" class="tooltip-mark tooltip-top-left">[?]</span>
					</p>
					
					<div class="tooltip tooltip-400">							
						<h5><?php _e( 'Choosing A Catalyst Child Theme Export Type:', 'catalyst' ); ?></h5>
						
						<p>
							<?php _e( '<strong>Distribution:</strong> If you want to Export a Child Theme that is completely portable in that it will be fully functional with any Catalyst installation then this is the Type to choose. With this option you are required to set your', 'catalyst' ); ?>
							<b><a href="<?php echo admin_url( 'admin.php?page=catalyst&activetab=catalyst-core-options-nav-content' ); ?>"><?php _e( '(Core Options > Content > Site Default Layout)', 'catalyst' ); ?></a></b>
							<?php _e( 'to a Double Sidebar variant (ie. Double, Double Right, Double Left). This forces you to provide specific values for each Sidebar Width to account for every possible layout the end user of your Child Theme may choose. Note: This option does NOT include your Custom Layout dimensions.', 'catalyst' ); ?>
						</p>
						
						<p>
							<?php _e( '<strong>My Site / Client Site:</strong> If you want to Export a Child Theme that will essentially "Lock Down" your current design and layouts (both Default and Custom Layouts) then this is the Type to choose. This option does not require any specific layout type and does include your Custom Layout dimensions.', 'catalyst' ); ?>
						</p>
					</div>
					
					<p>
						<?php _e( '<span style="font-family:verdana, sans-serif; font-weight:bold; font-size:14px; color:#014662;">Step 4:</span> Click the "Export Catalyst Child Theme" button.', 'catalyst' ); ?>
					</p>
				</div>
			</div>
			
			<div style="width:40%; float:right;">
				<div class="bg-box" style="margin-right:0; margin-bottom:0; height:237px;">
				<form method="post" enctype="multipart/form-data">
					<p>
						<input type="text" id="catalyst-child-name" name="catalyst_child_name" value="" style="width:190px; margin-bottom:5px;" class="forbid-chars" /> <?php _e( 'Theme Name', 'catalyst' ); ?><br />
						<input type="text" id="catalyst-child-author" name="catalyst_child_author" value="" style="width:190px; margin-bottom:5px;" /> <?php _e( 'Author', 'catalyst' ); ?><br />
						<input type="text" id="catalyst-child-author-uri" name="catalyst_child_author_uri" value="" style="width:190px;" /> <?php _e( 'Author URI', 'catalyst' ); ?><br /><br />

						<input type="checkbox" id="catalyst-at-style" name="catalyst_at_style" value="1" > <?php _e( 'Include Reference To Catalyst style.css? ', 'catalyst' ); ?><br /><br />

						<?php _e( 'Which type of export is this?', 'catalyst' ); ?><br /><input type="radio" name="child_export_type" value="distribution" checked="checked" /><label><?php _e( 'Distribution', 'catalyst' ); ?></label>
						| <input type="radio" name="child_export_type" value="mysite" /><label><?php _e( 'My Site / Client Site', 'catalyst' ); ?></label><br /><br />
						<input type="submit" name="clicked_button" value="<?php _e( 'Export Catalyst Child Theme', 'catalyst' ); ?>" class="button-highlighted"/>
						<input type="hidden" name="action" value="catalyst_child_export">	
					</p>
				</form>
				</div>
			</div>
			</form>
		</div>
	</div>
</div>