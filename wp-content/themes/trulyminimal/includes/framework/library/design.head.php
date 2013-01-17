	<?php
	if ( isset($_REQUEST['settings-updated']) && !isset($_REQUEST['send-feedback']) ) echo '<br /><div id="message" class="updated fade"><p><strong>' . THEMENAME . '</strong> settings saved.</p></div>';
	if ( isset($_REQUEST['send-feedback']) ) echo '<br /><div id="message" class="updated fade"><p><strong>Thank you!</strong> Your feedback has been successfully sent.</p></div>';
	if ( isset($_REQUEST['reset']) ) echo '<br /><div id="message" class="updated fade"><p><strong>' . THEMENAME . '</strong> settings reset.</p></div>';
	if ( isset($_REQUEST['error']) ) echo '<br /><div id="message" class="error"><p><strong>Error:</strong> ' . $_REQUEST['error'] . '</p></div>'; 
	if ( isset($_REQUEST['activated']) ) echo '<br /><div id="message" class="updated fade"><p><strong>' . THEMENAME . '</strong> was activated.</p></div>'; 
	?>

	<noscript>
		<br /><div id="message" class="error"><p><strong>Error:</strong> For a properly functioning, you must have javascript enabled!</p></div>
	</noscript>

	<form id="fpForm" method="post" action="options.php">
	<?php settings_fields(SHORTNAME_SETTINGS); ?>

	<div class="fpSaving">
		<div class="message"></div>
		<div class="image"></div>
	</div>

	<div id="fpBody">
		<div id="fpHeader">
			<div id="fpThemename"><?php echo THEMENAME; ?> Settings</div>
			<div id="fpDescription"><span>Welcome to your <?php echo THEMENAME; ?> settings.</span> This section allow you to customize your website look.</div>
			<div id="fpVersion">Theme Version: <?php echo THEMEVERSION; ?><br />Framework Version: <?php echo FRAMEWORK_VERSION; ?></div>

			<ul id="fpMenu">
				<li><a href="<?php bloginfo('url'); ?>" target="_blank"><div class="icon icon-site"></div>View website</a></li>
				<li><a href="<?php echo get_bloginfo('stylesheet_directory'); ?>/documentation.pdf" target="_blank" onclick="window.open (this.href, 'child', 'height=700,width=800,scrollbars'); return false"><div class="icon icon-doc"></div>Documentation</a></li>
			</ul>

			<input class="fpSave button-primary" name="submit" value="Save Options" type="submit" />
		</div>

		<div id="fpContent">