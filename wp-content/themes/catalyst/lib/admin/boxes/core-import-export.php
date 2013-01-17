<?php
/**
 * Builds the Core Import/Export admin content.
 *
 * @package Catalyst
 */
?>

<div id="catalyst-core-options-nav-import-export-box" class="catalyst-all-options">

	<h3><?php _e( 'Import/Export Options', 'catalyst' ); ?></h3>

<?php	if( !empty( $_GET['notice'] ) )
		{
			if( $_GET['notice'] == 'import-error' )
			{
?>				<div id="notice-box" style="background:#FFFBCC;border:1px solid #E6DB55;color:#555555;text-align:center;margin:15px 0px;padding:5px;"><strong><?php _e( 'Core Import Error: Import File Must Be In .dat Format (ie. my_backup.dat)', 'catalyst' ); ?></strong></div>
<?php		}
			elseif( $_GET['notice'] == 'import-complete' )
			{
?>				<div id="notice-box" style="background:#FFFBCC;border:1px solid #E6DB55;color:#555555;text-align:center;margin:15px 0px;padding:5px;"><strong><?php _e( 'Core Import Complete', 'catalyst' ); ?></strong></div>
<?php		}
		}
?>	

	<form method="post">
	<div class="catalyst-optionbox-2col-left-wrap">
	
		<div class="catalyst-optionbox-outer-2col">
			<div class="catalyst-optionbox-inner-2col">
				<h4><?php _e( 'Export Core & Advanced', 'catalyst' ); ?></h4>
					
				<div class="bg-box">
					<p>
						<input type="checkbox" id="export-core" name="export_core" value="1" checked /> <?php _e( 'Core Options', 'catalyst' ); ?> <strong style="float:right; width:190px;"><?php _e( 'Export File Name:', 'catalyst' ); ?></strong><input type="text" id="catalyst-export-name" name="catalyst_export_name" value="" style="float:right; width:190px;" class="forbid-chars" />
					</p>
					<p>
						<input type="checkbox" id="export-layouts" name="export_layouts" value="1" checked /> <?php _e( 'Custom Layouts', 'catalyst' ); ?>
					</p>
					<p>
						<input type="checkbox" id="export-widgets" name="export_widgets" value="1" checked /> <?php _e( 'Custom Widget Areas', 'catalyst' ); ?>
					</p>
					<p>
						<input type="checkbox" id="export-hooks" name="export_hooks" value="1" checked /> <?php _e( 'Custom Hook Boxes', 'catalyst' ); ?>
					</p>
					<p>
						<input type="checkbox" id="export-css" name="export_css" value="1" checked /> <?php _e( 'Custom CSS', 'catalyst' ); ?> <input style="float:right;" type="submit" name="clicked_button" value="<?php _e( 'Export Core & Advanced', 'catalyst' ); ?>" class="button-highlighted"/>
						<input type="hidden" name="action" value="catalyst_core_export">
					</p>
				</div>
			</div>
		</div>
		
	</div>
	</form>

	<form method="post" enctype="multipart/form-data">
	<div class="catalyst-optionbox-2col-right-wrap">
	
		<div class="catalyst-optionbox-outer-2col">
			<div class="catalyst-optionbox-inner-2col">
				<h4><?php _e( 'Import Core & Advanced', 'catalyst' ); ?></h4>
			
				<div class="bg-box">
					<p>
						<input type="checkbox" id="import-core" name="import_core" value="1" checked /> <?php _e( 'Core Options', 'catalyst' ); ?> <input style="float:right; width:200px;" name="core_import_file" type="file" />
					</p>
					<p>
						<input type="checkbox" id="import-layouts" name="import_layouts" value="1" checked /> <?php _e( 'Custom Layouts', 'catalyst' ); ?>
					</p>
					<p>
						<input type="checkbox" id="import-widgets" name="import_widgets" value="1" checked /> <?php _e( 'Custom Widget Areas', 'catalyst' ); ?>
					</p>
					<p>
						<input type="checkbox" id="import-hooks" name="import_hooks" value="1" checked /> <?php _e( 'Custom Hook Boxes', 'catalyst' ); ?>
					</p>
					<p>
						<input type="checkbox" id="import-css" name="import_css" value="1" checked /> <?php _e( 'Custom CSS', 'catalyst' ); ?> <input style="float:right;" type="submit" name="clicked_button" value="<?php _e( 'Import Core & Advanced', 'catalyst' ); ?>" class="button-highlighted"/>
						<input type="hidden" name="action" value="catalyst_core_import">
					</p>
				</div>
			</div>
		</div>
		
	</div>
	</form>
	
</div>