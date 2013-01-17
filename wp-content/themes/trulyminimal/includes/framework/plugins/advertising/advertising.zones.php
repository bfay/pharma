<?php
function framework_advertising_zones() {
	global $wpdb;

	$page = isset($_GET['page']) ? $_GET['page'] : '';
	$view = isset($_GET['view']) ? $_GET['view'] : '';

	if ( isset($_REQUEST['saved']) ) echo '<div id="message" class="updated fade"><p><strong>Settings saved.</strong></p></div>';
	if ( isset($_REQUEST['reset']) ) echo '<div id="message" class="updated fade"><p><strong>Settings reset.</strong></p></div>';
	if ( isset($_REQUEST['error']) ) echo '<div id="message" class="updated fade"><p><strong>Error: '.$_REQUEST['error'].'</strong></p></div>'; ?>

<div class="wrap nosubsub">
	<h2>Zones Management</h2>

	<?php
	/*-------------------------------------------------------------
	*   Show if view is not set or is "manage"
	*------------------------------------------------------------*/
	?>
	<?php if( ($view == "") || ($view == "manage") ) : ?>
	<div id="col-container">
		<div id="col-right">
		<form name="zones" id="post" method="post" action="admin.php?page=<?php echo $page; ?>">

		<div class="tablenav">
			<div class="alignleft actions">
					<select name="zones_action" id="cat" class="postform">
					<option value="">Bulk Actions</option>
					<option value="delete">Delete</option>
				</select>

				<input type="submit" id="post-action-submit" name="zones_action_submit" value="Apply" class="button-secondary" />
			</div>
	
			<br class="clear" />
		</div>

		<div class="form-wrap">
		<p><strong>Note:</strong> Deleting a zone does not delete the ads in that zone. Any action taken is irreversible. You can not recover any deleted or modified data.</p>
		</div>

		<table class="widefat tag fixed" cellspacing="0">
		<thead>
	  	<tr>
			<th class="check-column"><input type="checkbox" /></th>
			<th>Name</th>
			<th width="20%">Description</th>
			<th width="15%">Slug</th>
			<th width="8%">Max Ads</th>
			<th width="7%"><center>Mode</center></th>
			<th width="10%"><center>Format</center></th>
		</tr>
	  	</thead>

		<?php $zones = $wpdb->get_results("SELECT * FROM `".$wpdb->prefix."frameworkads_zones`"); ?>
		<?php if($zones) { 
			$i=0;
			foreach($zones as $zone) { $i++; ?>
				<tr id="zone-<?php echo $zone->zone_key; ?>" <?php if($i%2==0) echo ' class="alternate"'; ?>>
					<th class="check-column"><input type="checkbox" name="zonecheck[]" value="<?php echo $zone->zone_key; ?>" /></th>
					<td><strong><a class="row-title" href="<?php echo get_option('siteurl').'/wp-admin/admin.php?page='.$_GET['page'].'&view=edit&zone='.$zone->zone_key; ?>" title="Edit"><?php echo stripslashes(html_entity_decode($zone->zone_name)); ?></a></strong><br />
						<div class="row-actions"><span class="edit"><a href="<?php echo get_option('siteurl').'/wp-admin/admin.php?page='.$_GET['page'].'&view=edit&zone='.$zone->zone_key; ?>">Edit</a> | </span><span class="delete"><a class="delete" href="<?php echo get_option('siteurl').'/wp-admin/admin.php?page='.$_GET['page'].'&view=delete&zone='.$zone->zone_key; ?>">Delete</a></span></div>
					</td>
					<td><?php echo $zone->zone_description; ?></td>
					<td><?php echo $zone->zone_key; ?></td>
					<td><center><?php echo $zone->zone_maxads; ?></center></td>
					<td><center><?php echo ucfirst($zone->zone_mode); ?></center></td>
					<td><center><?php echo $zone->zone_format; ?></center></td>
				</tr>

			<?php } ?>
		<?php } else { ?>
			<tr id="no-ads">
				<td colspan="7"><em>No zones created yet!</em></td>
			</tr>
		<?php } ?>

		</table>

		</form>

		<div class="form-wrap">
		<p><strong>Note:</strong><br />Deleting a zone does not delete the ads in that zone. Any action taken is irreversible. You can not recover any deleted or modified data.</p>
		</div>

		</div>

		<div id="col-left">
		<div class="col-wrap">
		<div class="form-wrap">

			<h3>Add New Zone</h3>

			<form name="zones" id="post" method="post" action="admin.php?page=<?php echo $page; ?>">

			<div class="form-field">
				<label for="zone_name">Name</label>
				<input tabindex="1" name="zone_name" id="zone_name" type="text" value="" size="40" />
				<p>The name of zone.</p>
			</div>

			<div class="form-field">
				<label for="zone_maxads">Maximum ads</label>
				<input tabindex="2" name="zone_maxads" id="zone_maxads" type="text" value="" size="40" />
				<p>The number of ads to show in the zone. If you have more ads than the set number, the system will use the applied <strong>Display Mode</strong> setting.</p>
			</div>

			<div class="form-field">
				<label for="zone_mode">Display Mode</label>
				<select tabindex="3" name="zone_mode">
					<option value="latest">Latest&nbsp;&nbsp;&nbsp;</option>
					<option value="random">Random&nbsp;&nbsp;&nbsp;</option>
				</select>
				<p>Select the display mode of banners.</p>
			</div>

			<div class="form-field">
				<label for="zone_format">Format</label>
				<select tabindex="4" name="zone_format">
					<optgroup label="Default">
						<option value=""> Select format</option>
					</optgroup>

					<optgroup label="Horizontal">
						<option value="728x90">&nbsp;&nbsp;&nbsp;728 x 90 Leaderboard</option>
						<option value="468x60">&nbsp;&nbsp;&nbsp;468 x 60 Banner</option>
						<option value="234x60">&nbsp;&nbsp;&nbsp;234 x 60 Half Banner</option> 
					</optgroup>
					<optgroup label="Vertical">
						<option value="160x600">&nbsp;&nbsp;&nbsp;160 x 600 Wide Skyscraper</option>
						<option value="120x600">&nbsp;&nbsp;&nbsp;120 x 600 Skyscraper</option>
					</optgroup>
					<optgroup label="Square">
						<option value="200x200">&nbsp;&nbsp;&nbsp;200 x 200 Small Square</option>
						<option value="250x250">&nbsp;&nbsp;&nbsp;250 x 250 Square</option>
						<option value="300x250">&nbsp;&nbsp;&nbsp;300 x 250 Medium Rectangle</option>
						<option value="125x125">&nbsp;&nbsp;&nbsp;125 x 125 Button</option>
					</optgroup>

					<optgroup label="Custom width and height">
						<option value="custom">&nbsp;&nbsp;&nbsp;Custom width and height</option>
					</optgroup>
				</select>
				<p>Select the format of banners from the zone.</p>
			</div>

			<div class="form-field">
				<label for="zone_description">Description</label>
				<textarea tabindex="5" name="zone_description" id="zone_description" rows="5" cols="40"></textarea>
			</div>

			<p class="submit"><input tabindex="6" type="submit" class="button" name="zones_add_submit" id="submit" value="Add New Zone" /></p>
			</form>

		</div>
		</div>
		</div>

	</div>
	<?php endif; ?>

	<?php
	/*-------------------------------------------------------------
	*   Show if view is set to "edit"
	*------------------------------------------------------------*/
	?>
	<?php if( ($view == "edit") && isset($_GET['zone']) ) : ?>

		<h3>Edit Zone</h3>

		<?php
		$key = $_GET['zone'];

		$zone = $wpdb->get_results("SELECT * FROM `".$wpdb->prefix."frameworkads_zones` WHERE `zone_key` = '$key'");
		?>

		<form name="zone_edit" id="post" method="post" action="admin.php?page=<?php echo $page; ?>">
		<input id="zone_key" name="zone_key" type="hidden" value="<?php echo $key; ?>" />

		<table class="widefat" style="margin-top: 20px">
		<thead>
		<tr>
			<th colspan="4">General</th>
		</tr>
		</thead>

		<tbody>
		<tr>
			<th>Name:</th>
			<td colspan="3"><input tabindex="1" name="zone_name" type="text" size="80" class="search-input" value="<?php echo $zone[0]->zone_name; ?>" /></td>
		</tr>

		<tr>
			<th valign="top">Description:</th>
			<td colspan="4"><textarea tabindex="2" name="zone_description" cols="65" rows="15"><?php echo stripslashes($zone[0]->zone_description); ?></textarea></td>
		</tr>

		<tr>
			<th>Maximum ads:</th>
			<td colspan="3"><input tabindex="3" name="zone_maxads" type="text" size="80" class="search-input" value="<?php echo $zone[0]->zone_maxads; ?>" /></td>
		</tr>

		<tr>
			<th>Mode:</th>
			<td colspan="3">
				<select tabindex="4" name="zone_mode">
					<option value="latest" <?php if($zone[0]->zone_mode == "latest") { echo 'selected'; } ?>>Latest&nbsp;&nbsp;&nbsp;</option>
					<option value="random" <?php if($zone[0]->zone_mode == "random") { echo 'selected'; } ?>>Random&nbsp;&nbsp;&nbsp;</option>
				</select>
			</td>
		</tr>

		<tr>
			<th>Format:</th>
			<td colspan="3">
				<select tabindex="5" name="zone_format">
					<optgroup label="Default">
						<option value=""> Select format</option>
					</optgroup>

					<optgroup label="Horizontal">
						<option value="728x90" <?php if($zone[0]->zone_format == "728x90") { echo 'selected'; } ?>>&nbsp;&nbsp;&nbsp;728 x 90 Leaderboard</option>
						<option value="468x60" <?php if($zone[0]->zone_format == "468x60") { echo 'selected'; } ?>>&nbsp;&nbsp;&nbsp;468 x 60 Banner</option>
						<option value="234x60" <?php if($zone[0]->zone_format == "234x60") { echo 'selected'; } ?>>&nbsp;&nbsp;&nbsp;234 x 60 Half Banner</option> 
					</optgroup>
					<optgroup label="Vertical">
						<option value="160x600" <?php if($zone[0]->zone_format == "160x600") { echo 'selected'; } ?>>&nbsp;&nbsp;&nbsp;160 x 600 Wide Skyscraper</option>
						<option value="120x600" <?php if($zone[0]->zone_format == "120x600") { echo 'selected'; } ?>>&nbsp;&nbsp;&nbsp;120 x 600 Skyscraper</option>
					</optgroup>
					<optgroup label="Square">
						<option value="200x200" <?php if($zone[0]->zone_format == "200x200") { echo 'selected'; } ?>>&nbsp;&nbsp;&nbsp;200 x 200 Small Square</option>
						<option value="250x250" <?php if($zone[0]->zone_format == "250x250") { echo 'selected'; } ?>>&nbsp;&nbsp;&nbsp;250 x 250 Square</option>
						<option value="300x250" <?php if($zone[0]->zone_format == "300x250") { echo 'selected'; } ?>>&nbsp;&nbsp;&nbsp;300 x 250 Medium Rectangle</option>
						<option value="125x125" <?php if($zone[0]->zone_format == "125x125") { echo 'selected'; } ?>>&nbsp;&nbsp;&nbsp;125 x 125 Button</option>
					</optgroup>

					<optgroup label="Custom width and height">
						<option value="custom" <?php if($zone[0]->zone_format == "custom") { echo 'selected'; } ?>>&nbsp;&nbsp;&nbsp;Custom width and height</option>
					</optgroup>
				</select>

			</td>
		</tr>
		</tbody>

		<thead>
		<tr>
			<th colspan="4">Usage</th>
		</tr>
		</thead>
	
		<tbody>
		<tr>
			<th>In a post or page:</th>
			<td>[frameworkads zone="<?php echo $zone[0]->zone_key; ?>"]</td>
			<th>Directly in a theme:</th>
			<td>&lt;?php echo frameworkads_display_zone('<?php echo $zone[0]->zone_key; ?>'); ?&gt;</td>
		</tr>
		</tbody>

		</table>

		<p class="submit">
			<input tabindex="16" type="submit" name="zones_edit_submit" class="button-primary" value="Save ad" />
			<a href="admin.php?page=<?php echo $page; ?>&view=manage" class="button">Cancel</a>
		</p>
		</form>
	<?php endif; ?>
</div>
<?php } ?>