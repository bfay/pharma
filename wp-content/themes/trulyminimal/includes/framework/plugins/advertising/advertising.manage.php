<?php
function framework_advertising_manage() {
	global $wpdb;

	$page = isset($_GET['page']) ? $_GET['page'] : '';
	$view = isset($_GET['view']) ? $_GET['view'] : '';

	if ( isset($_REQUEST['saved']) ) echo '<div id="message" class="updated fade"><p><strong>Settings saved.</strong></p></div>';
	if ( isset($_REQUEST['reset']) ) echo '<div id="message" class="updated fade"><p><strong>Settings reset.</strong></p></div>';
	if ( isset($_REQUEST['error']) ) echo '<div id="message" class="updated fade"><p><strong>Error: '.$_REQUEST['error'].'</strong></p></div>'; ?>

<div class="wrap">
	<h2>Ad Management</h2>

	<div class="tablenav">
		<div class="alignleft actions">
			<a class="row-title" href="<?php echo admin_url().'admin.php?page='.$page.'&view=manage';?>">Manage</a> | 
			<a class="row-title" href="<?php echo admin_url().'admin.php?page='.$page.'&view=addnew';?>">Add New</a>
		</div>
	</div>

	<?php
	/*-------------------------------------------------------------
	*   Show if view is not set or is "manage"
	*------------------------------------------------------------*/
	?>
	<?php if( ($view == "") || ($view == "manage") ) : ?>
		<form name="ads" id="post" method="post" action="admin.php?page=<?php echo $page; ?>">
				
		<div class="tablenav">
			<div class="alignleft actions">
					<select name="ads_action" id="cat" class="postform">
					<option value="">Bulk Actions</option>
					<option value="deactivate">Deactivate</option>
					<option value="activate">Activate</option>
					<option value="delete">Delete</option>
					<option value="renew-31536000">Renew for 1 year</option>
					<option value="renew-2592000">Renew for 30 days</option>
					<option value="renew-604800">Renew for 7 days</option>
				</select>

				<input type="submit" id="post-action-submit" name="ads_action_submit" value="Apply" class="button-secondary" />
			</div>
	
			<br class="clear" />
		</div>

		<div class="form-wrap">
		<p><strong>Note:</strong> Any action taken is irreversible. You can not recover any deleted or modified data.</p>
		</div>

		<table class="widefat" style="margin-top: .5em">
		<thead>
	  	<tr>
			<th class="check-column"><input type="checkbox" /></th>
			<th width="2%"><center>ID</center></th>
			<th>Title</th>
			<th width="10%">Status</th>
			<th width="5%">Type</th>
			<th width="10%">Zone</th>
			<th width="13%">Show from</th>
			<th width="13%">Show until</th>
			<th width="5%"><center>Views</center></th>
			<th width="5%"><center>Clicks</center></th>
		</tr>
	  	</thead>
	  	<tbody>

		<?php $ads = $wpdb->get_results("SELECT * FROM `".$wpdb->prefix."frameworkads` ORDER by ad_id DESC"); ?>
		<?php if($ads) { 
			foreach($ads as $ad) { ?>
				<tr id="ad-<?php echo $banner->ad_id; ?>" <?php if(!framework_ad_active($ad->ad_id)) echo ' class="alternate"'; ?>>
					<th class="check-column"><input type="checkbox" name="adcheck[]" value="<?php echo $ad->ad_id; ?>" /></th>
					<td><center><?php echo $ad->ad_id; ?></center></td>
					<td><strong><a class="row-title" href="<?php echo get_option('siteurl').'/wp-admin/admin.php?page='.$_GET['page'].'&view=edit&ad='.$ad->ad_id; ?>" title="Edit"><?php echo stripslashes(html_entity_decode($ad->ad_title)); ?></a></strong><br />
						<div class="row-actions"><span class="edit"><a href="<?php echo get_option('siteurl').'/wp-admin/admin.php?page='.$_GET['page'].'&view=edit&ad='.$ad->ad_id; ?>">Edit</a> | </span><span class="delete"><a class="delete" href="<?php echo get_option('siteurl').'/wp-admin/admin.php?page='.$_GET['page'].'&view=delete&ad='.$ad->ad_id; ?>">Delete</a></span></div>
					</td>
					<td><?php if(framework_ad_active($ad->ad_id)) echo 'Active'; else echo 'Inactive'; ?></td>
					<td><?php echo ucfirst($ad->ad_type); ?></td>
					<td><?php echo framework_ad_get_zone_name($ad->ad_id); ?></td>
					<td><?php echo date("F d, Y", $ad->ad_startshow); ?></td>
					<td><?php echo date("F d, Y", $ad->ad_endshow);?></td>
					<td><center><?php echo $ad->ad_views; ?></center></td>
					<td><center><?php echo $ad->ad_clicks; ?></center></td>
				</tr>

			<?php } ?>
		<?php } else { ?>
			<tr id="no-ads">
				<td colspan="6"><em>No ads created yet!</em></td>
			</tr>
		<?php } ?>

		</table>

		</form>

		<div class="form-wrap">
		<p><strong>Note:</strong><br />Any action taken is irreversible. You can not recover any deleted or modified data.</p>
		</div>
	<?php endif; ?>

	<?php
	/*-------------------------------------------------------------
	*   Show if view is set to "addnew"
	*------------------------------------------------------------*/
	?>
	<?php if( $view == "addnew" ) : ?>
		<h3>New Ad</h3>

		<?php
		$startshow = current_time('timestamp') - 86400;
		$endshow = current_time('timestamp') + 31536000;
		$zones	= $wpdb->get_results("SELECT * FROM `".$wpdb->prefix."frameworkads_zones` WHERE `zone_key` != ''");
		list($startday, $startmonth, $startyear) = explode(" ", gmdate("d m Y", $startshow));
		list($endday, $endmonth, $endyear) = explode(" ", gmdate("d m Y", $endshow)); 
		?>

		<form name="ad_new" id="post" method="post" action="admin.php?page=<?php echo $page; ?>">

		<table class="widefat" style="margin-top: 20px">
		<thead>
		<tr>
			<th colspan="4">General</th>
		</tr>
		</thead>

		<tbody>
		<tr>
			<th>Title:</th>
			<td colspan="3"><input tabindex="1" name="ad_title" type="text" size="80" class="search-input" /></td>
		</tr>

		<tr>
			<th valign="top">HTML Code:</th>
			<td colspan="2"><textarea tabindex="2" name="ad_code" cols="65" rows="15"></textarea></td>
			<td>
				<p><strong>Options:</strong></p>
				<p>- You can use HTML.</p>
				<p><strong>Examples:</strong></p>
				<p>Link: <em>&lt;a href="#link#"&gt;Text&lt;/a&gt;</em></p>
				<p>Image: <em>&lt;a href="http://example.com"&gt;&lt;img src="#image#" /&gt;&lt;/a&gt;</em></p>
				<p>Link and Image: <em>&lt;a href="#link#"&gt;&lt;img src="#image#" /&gt;&lt;/a&gt;</em></p>
			</td>
		</tr>

		<tr>
			<th valign="top">Image:</th>
			<td colspan="3"><input tabindex="3" name="ad_image_file" id="ad_image_file" type="file" size="80" class="search-input" /></td>

			<script type="text/javascript">// <![CDATA[
			jQuery(document).ready(function($){

				var now    = new Date();
				var time   = now.getTime();

				jQuery('#ad_image_file').uploadify({
					'uploader'  : '<?php echo FRAMEWORK_DIR; ?>images/uploadify/uploadify.swf',
					'script'    : '<?php echo FRAMEWORK_DIR; ?>plugins/uploadify.php',
					'cancelImg' : '<?php echo FRAMEWORK_DIR; ?>images/uploadify/cancel.png',
					'buttonImg' : '<?php echo FRAMEWORK_DIR; ?>images/uploadify/button.jpg',
					'folder'    : userSettings.url + 'wp-content/uploads',

					'auto'      : true,
					'height'    : 22,
					'width'     : 82,

					'removeCompleted' : false,

					'scriptData': {'addonfile':time},
					'onError'	: function(e,q,f,errorObj){
							console.log(errorObj.type+"    "+errorObj.info);
							},
					'onComplete': function(event, queueID, fileObj){
							var fileName= userSettings.url + 'wp-content/uploads/' + time + '-' + fileObj.name;
                					jQuery('#ad_image').val(fileName);
		        	       		}
				});
				jQuery(".start-upload").click(function(){
					jQuery('#ad_image').uploadifyUpload();
				});
			});
			// ]]></script>

			<input id="ad_image" name="ad_image" type="hidden" value="" />
		</tr>

		<tr>
			<th>Display From:</th>
			<td>
				<input tabindex="4" name="ad_startday" class="search-input" type="text" size="4" maxlength="2" value="<?php echo $startday;?>" /> /
				<select tabindex="5" name="ad_startmonth">
					<option value="01" <?php if($startmonth == "01") { echo 'selected'; } ?>>January</option>
					<option value="02" <?php if($startmonth == "02") { echo 'selected'; } ?>>February</option>
					<option value="03" <?php if($startmonth == "03") { echo 'selected'; } ?>>March</option>
					<option value="04" <?php if($startmonth == "04") { echo 'selected'; } ?>>April</option>
					<option value="05" <?php if($startmonth == "05") { echo 'selected'; } ?>>May</option>
					<option value="06" <?php if($startmonth == "06") { echo 'selected'; } ?>>June</option>
					<option value="07" <?php if($startmonth == "07") { echo 'selected'; } ?>>July</option>
					<option value="08" <?php if($startmonth == "08") { echo 'selected'; } ?>>August</option>
					<option value="09" <?php if($startmonth == "09") { echo 'selected'; } ?>>September</option>
					<option value="10" <?php if($startmonth == "10") { echo 'selected'; } ?>>October</option>
					<option value="11" <?php if($startmonth == "11") { echo 'selected'; } ?>>November</option>
					<option value="12" <?php if($startmonth == "12") { echo 'selected'; } ?>>December</option>
				</select> /
				<input tabindex="6" name="ad_startyear" class="search-input" type="text" size="4" maxlength="4" value="<?php echo $startyear;?>" />
			</td>
			<th>Until:</th>
			<td>
				<input tabindex="7" name="ad_endday" class="search-input" type="text" size="4" maxlength="2" value="<?php echo $endday;?>"  /> /
				<select tabindex="8" name="ad_endmonth">
					<option value="01" <?php if($endmonth == "01") { echo 'selected'; } ?>>January</option>
					<option value="02" <?php if($endmonth == "02") { echo 'selected'; } ?>>February</option>
					<option value="03" <?php if($endmonth == "03") { echo 'selected'; } ?>>March</option>
					<option value="04" <?php if($endmonth == "04") { echo 'selected'; } ?>>April</option>
					<option value="05" <?php if($endmonth == "05") { echo 'selected'; } ?>>May</option>
					<option value="06" <?php if($endmonth == "06") { echo 'selected'; } ?>>June</option>
					<option value="07" <?php if($endmonth == "07") { echo 'selected'; } ?>>July</option>
					<option value="08" <?php if($endmonth == "08") { echo 'selected'; } ?>>August</option>
					<option value="09" <?php if($endmonth == "09") { echo 'selected'; } ?>>September</option>
					<option value="10" <?php if($endmonth == "10") { echo 'selected'; } ?>>October</option>
					<option value="11" <?php if($endmonth == "11") { echo 'selected'; } ?>>November</option>
					<option value="12" <?php if($endmonth == "12") { echo 'selected'; } ?>>December</option>
				</select> /
				<input tabindex="9" name="ad_endyear" class="search-input" type="text" size="4" maxlength="4" value="<?php echo $endyear;?>" />
			</td>

		</tr>
		<tr>
			<th>Activate:</th>
			<td colspan="3">
				<select tabindex="10" name="ad_active">
					<option value="yes">Yes&nbsp;&nbsp;&nbsp;</option>
					<option value="no">No&nbsp;&nbsp;&nbsp;</option>
				</select>
			</td>
		</tr>
		</tbody>

		<thead>
		<tr>
			<th colspan="4">Advanced</th>
		</tr>
		</thead>
	
		<tbody>
		<tr>
			<th valign="top">Link:</th>
			<td colspan="3">
				<input tabindex="11" name="ad_link" type="text" size="80" class="search-input" value="http://" /><br />
				<em>If you use image you need to enter a link.</em>
			</td>
		</tr>
		<tr>
			<th>Maximum Clicks:</th>
			<td colspan="3">Disable after <input tabindex="12" name="ad_maxclicks" type="text" size="5" class="search-input" /> clicks! <em>Leave empty or 0 to skip this.</em></td>
		</tr>
		<tr>
			<th>Maximum Views:</th>
			<td colspan="3">Disable after <input tabindex="13" name="ad_maxviews" type="text" size="5" class="search-input" /> views! <em>Leave empty or 0 to skip this.</em></td>
		</tr>
		</tbody>

		<?php if($zones) { ?>
		<thead>
	  	<tr>
			<th colspan="4">Select the zone</th>
		</tr>
		</thead>

		<tbody>
		<tr>
			<th>Zone:</th>
			<td colspan="3">
				<select tabindex="14" name="ad_zone">
					<option value="">Select zone&nbsp;&nbsp;&nbsp;</option>
					<?php foreach($zones as $zone) { ?>
					<option value="<?php echo $zone->zone_key; ?>"><?php echo $zone->zone_name; ?> - <?php echo $zone->zone_format; ?>&nbsp;&nbsp;&nbsp;</option>
					<?php } ?>
				</select>
			</td>
		</tr>
		</tbody>
		<?php } ?>
		</table>

		<p class="submit">
			<input tabindex="16" type="submit" name="ads_add_submit" class="button-primary" value="Save ad" />
			<a href="admin.php?page=<?php echo $page; ?>&view=manage" class="button">Cancel</a>
		</p>
		</form>
	<?php endif; ?>

	<?php
	/*-------------------------------------------------------------
	*   Show if view is set to "edit"
	*------------------------------------------------------------*/
	?>
	<?php if( ($view == "edit") && isset($_GET['ad']) ) : ?>
		<h3>Edit Ad</h3>

		<?php
		$id = $_GET['ad'];

		$ad = $wpdb->get_results("SELECT * FROM `".$wpdb->prefix."frameworkads` WHERE `ad_id` = '$id'");

		$startshow = $ad[0]->ad_startshow;
		$endshow = $ad[0]->ad_endshow;
		$zones	= $wpdb->get_results("SELECT * FROM `".$wpdb->prefix."frameworkads_zones` WHERE `zone_key` != ''");
		list($startday, $startmonth, $startyear) = explode(" ", gmdate("d m Y", $startshow));
		list($endday, $endmonth, $endyear) = explode(" ", gmdate("d m Y", $endshow));
		?>

		<form name="ad_edit" id="post" method="post" action="admin.php?page=<?php echo $page; ?>">
		<input id="ad_id" name="ad_id" type="hidden" value="<?php echo $id; ?>" />

		<table class="widefat" style="margin-top: 20px">
		<thead>
		<tr>
			<th colspan="4">General &nbsp;&nbsp;&nbsp;(This ad is <strong><?php echo $ad[0]->ad_type; ?></strong> type.)</th>
		</tr>
		</thead>
	
		<tbody>
		<tr>
			<th>Title:</th>
			<td colspan="3"><input tabindex="1" name="ad_title" type="text" size="80" class="search-input" value="<?php echo $ad[0]->ad_title; ?>" /></td>
		</tr>

		<tr<?php if($ad[0]->ad_type == "image") echo ' style="display: none;"'; ?>>
			<th valign="top">HTML Code:</th>
			<td colspan="2"><textarea tabindex="2" name="ad_code" cols="65" rows="15"><?php echo stripslashes($ad[0]->ad_code); ?></textarea></td>
			<td>
				<p><strong>Options:</strong></p>
				<p>- You can use HTML.</p>
					        
				<p><strong>Examples:</strong></p>
				<p>Link: <em>&lt;a href="#link#"&gt;Text&lt;/a&gt;</em></p>
				<p>Image: <em>&lt;a href="http://example.com"&gt;&lt;img src="#image#" /&gt;&lt;/a&gt;</em></p>
				<p>Link and Image: <em>&lt;a href="#link#"&gt;&lt;img src="#image#" /&gt;&lt;/a&gt;</em></p>
			</td>
		</tr>

		<tr<?php if($ad[0]->ad_type == "html") echo ' style="display: none;"'; ?>>
			<th valign="top">Image:</th>
			<td colspan="1"><input tabindex="3" name="ad_image_file" id="ad_image_file" type="file" size="80" class="search-input" /></td>

			<script type="text/javascript">// <![CDATA[
			jQuery(document).ready(function($){

				var now    = new Date();
				var time   = now.getTime();

				jQuery('#ad_image_file').uploadify({
					'uploader'  : '<?php echo FRAMEWORK_DIR; ?>images/uploadify/uploadify.swf',
					'script'    : '<?php echo FRAMEWORK_DIR; ?>plugins/uploadify.php',
					'cancelImg' : '<?php echo FRAMEWORK_DIR; ?>images/uploadify/cancel.png',
					'buttonImg' : '<?php echo FRAMEWORK_DIR; ?>images/uploadify/button.jpg',
					'folder'    : '/wp-content/uploads',

					'auto'      : true,
					'height'    : 22,
					'width'     : 82,

					'removeCompleted' : false,

					'scriptData': {'addonfile':time},
					'onError'	: function(e,q,f,errorObj){
							console.log(errorObj.type+"    "+errorObj.info);
							},
					'onComplete': function(event, queueID, fileObj){
							var fileName= '/wp-content/uploads/' + time + '-' + fileObj.name;
                					jQuery('#ad_image').val(fileName);
							jQuery(".uploaded-image").html('Uploaded image: <br /><img style="max-width: 300px; max-height: 300px;" src="'+fileName+'"/>');
		        	       		}
				});
				jQuery(".start-upload").click(function(){
					jQuery('#ad_image').uploadifyUpload();
				});
			});
			// ]]></script>

			<?php if($ad[0]->ad_type == "image") : ?>
				<td colspan="2"><div class="uploaded-image">Actual image: <br /><img style="max-width: 300px; max-height: 300px;" src="<?php echo $ad[0]->ad_code; ?>"></div></td>
				<input id="ad_image" name="ad_image" type="hidden" value="<?php echo $ad[0]->ad_code; ?>" />
			<?php else: ?>
				<td colspan="2"><div class="uploaded-image">Upload image!</div></td>
				<input id="ad_image" name="ad_image" type="hidden" value="" />
			<?php endif; ?>
		</tr>

		<tr>
			<th>Display From:</th>
			<td>
				<input tabindex="4" name="ad_startday" class="search-input" type="text" size="4" maxlength="2" value="<?php echo $startday;?>" /> /
				<select tabindex="5" name="ad_startmonth">
					<option value="01" <?php if($startmonth == "01") { echo 'selected'; } ?>>January</option>
					<option value="02" <?php if($startmonth == "02") { echo 'selected'; } ?>>February</option>
					<option value="03" <?php if($startmonth == "03") { echo 'selected'; } ?>>March</option>
					<option value="04" <?php if($startmonth == "04") { echo 'selected'; } ?>>April</option>
					<option value="05" <?php if($startmonth == "05") { echo 'selected'; } ?>>May</option>
					<option value="06" <?php if($startmonth == "06") { echo 'selected'; } ?>>June</option>
					<option value="07" <?php if($startmonth == "07") { echo 'selected'; } ?>>July</option>
					<option value="08" <?php if($startmonth == "08") { echo 'selected'; } ?>>August</option>
					<option value="09" <?php if($startmonth == "09") { echo 'selected'; } ?>>September</option>
					<option value="10" <?php if($startmonth == "10") { echo 'selected'; } ?>>October</option>
					<option value="11" <?php if($startmonth == "11") { echo 'selected'; } ?>>November</option>
					<option value="12" <?php if($startmonth == "12") { echo 'selected'; } ?>>December</option>
				</select> /
				<input tabindex="6" name="ad_startyear" class="search-input" type="text" size="4" maxlength="4" value="<?php echo $startyear;?>" />
			</td>
			<th>Until:</th>
			<td>
				<input tabindex="7" name="ad_endday" class="search-input" type="text" size="4" maxlength="2" value="<?php echo $endday;?>"  /> /
				<select tabindex="8" name="ad_endmonth">
					<option value="01" <?php if($endmonth == "01") { echo 'selected'; } ?>>January</option>
					<option value="02" <?php if($endmonth == "02") { echo 'selected'; } ?>>February</option>
					<option value="03" <?php if($endmonth == "03") { echo 'selected'; } ?>>March</option>
					<option value="04" <?php if($endmonth == "04") { echo 'selected'; } ?>>April</option>
					<option value="05" <?php if($endmonth == "05") { echo 'selected'; } ?>>May</option>
					<option value="06" <?php if($endmonth == "06") { echo 'selected'; } ?>>June</option>
					<option value="07" <?php if($endmonth == "07") { echo 'selected'; } ?>>July</option>
					<option value="08" <?php if($endmonth == "08") { echo 'selected'; } ?>>August</option>
					<option value="09" <?php if($endmonth == "09") { echo 'selected'; } ?>>September</option>
					<option value="10" <?php if($endmonth == "10") { echo 'selected'; } ?>>October</option>
					<option value="11" <?php if($endmonth == "11") { echo 'selected'; } ?>>November</option>
					<option value="12" <?php if($endmonth == "12") { echo 'selected'; } ?>>December</option>
				</select> /
				<input tabindex="9" name="ad_endyear" class="search-input" type="text" size="4" maxlength="4" value="<?php echo $endyear;?>" />
			</td>

		</tr>
		<tr>
			<th>Activate:</th>
			<td colspan="3">
				<select tabindex="10" name="ad_active">
					<option value="yes" <?php if(framework_ad_active($ad[0]->ad_id)) { echo 'selected'; } ?>>Yes&nbsp;&nbsp;&nbsp;</option>
					<option value="no" <?php if(!framework_ad_active($ad[0]->ad_id)) { echo 'selected'; } ?>>No&nbsp;&nbsp;&nbsp;</option>
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
			<td>[frameworkads ad="<?php echo $ad[0]->ad_id; ?>"]</td>
			<th>Directly in a theme:</th>
			<td>&lt;?php echo frameworkads_display_ad(<?php echo $ad[0]->ad_id; ?>); ?&gt;</td>
		</tr>
		</tbody>

		<thead>
		<tr>
			<th colspan="4">Advanced</th>
		</tr>
		</thead>
	
		<tbody>
		<tr<?php if($ad[0]->ad_type == "html") echo ' style="display: none;"'; ?>>
			<th valign="top">Link:</th>
			<td colspan="3">
				<input tabindex="11" name="ad_link" type="text" size="80" class="search-input" value="<?php echo $ad[0]->ad_link; ?>" /><br />
				<em>If you use image you need to enter a link.</em>
			</td>
		</tr>
		<tr>
			<th>Maximum Clicks:</th>
			<td colspan="3">Disable after <input tabindex="12" name="ad_maxclicks" type="text" size="5" class="search-input" value="<?php echo $ad[0]->ad_maxclicks; ?>" /> clicks! <em>Leave empty or 0 to skip this.</em></td>
		</tr>
		<tr>
			<th>Maximum Views:</th>
			<td colspan="3">Disable after <input tabindex="13" name="ad_maxviews" type="text" size="5" class="search-input" value="<?php echo $ad[0]->ad_maxviews; ?>" /> views! <em>Leave empty or 0 to skip this.</em></td>
		</tr>
		</tbody>

		<?php if($zones) { ?>
		<thead>
	  	<tr>
			<th colspan="4">Select the zone</th>
		</tr>
		</thead>

		<tbody>
		<tr>
			<th>Zone:</th>
			<td colspan="3">
				<select tabindex="14" name="ad_zone">
					<option value="">Select zone&nbsp;&nbsp;&nbsp;</option>
					<?php foreach($zones as $zone) { ?>
					<option value="<?php echo $zone->zone_key; ?>" <?php if($ad[0]->ad_zone == $zone->zone_key) { echo 'selected'; } ?>><?php echo $zone->zone_name; ?> - <?php echo $zone->zone_format; ?>&nbsp;&nbsp;&nbsp;</option>
					<?php } ?>
				</select>
			</td>
		</tr>
		</tbody>
		<?php } ?>
		</table>

		<p class="submit">
			<input tabindex="16" type="submit" name="ads_edit_submit" class="button-primary" value="Save ad" />
			<a href="admin.php?page=<?php echo $page; ?>&view=manage" class="button">Cancel</a>
		</p>
		</form>
	<?php endif; ?>
</div>
<?php } ?>