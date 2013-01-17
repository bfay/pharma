<?php
/*-------------------------------------------------------------
*   Include framework global variables
*------------------------------------------------------------*/
require_once ( 'framework.global.php' );

/*-------------------------------------------------------------
*   Include framework options
*------------------------------------------------------------*/
require_once ( 'framework.options.php' );

/*-------------------------------------------------------------
*   Include external functions
*------------------------------------------------------------*/
require_once ( FRAMEWORK_INC_LIBRARY . 'external.functions.php' );

/*-------------------------------------------------------------
*   Include library data
*------------------------------------------------------------*/
require_once ( FRAMEWORK_INC_LIBRARY . 'data.library.php' );

/*-------------------------------------------------------------
*   Include the next files only if is admin page
*------------------------------------------------------------*/
if(is_admin()) :
	/*-------------------------------------------------------------
	*   Include global functions
	*------------------------------------------------------------*/
	require_once ( FRAMEWORK_INC_LIBRARY . 'global.functions.php' );

	/*-------------------------------------------------------------
	*   Include version checker
	*------------------------------------------------------------*/
	require_once ( FRAMEWORK_INC_LIBRARY . 'check.version.php' );

	/*-------------------------------------------------------------
	*   Include function for restore settings to default
	*------------------------------------------------------------*/
	require_once ( FRAMEWORK_INC_LIBRARY . 'restore.settings.php' );

	/*-------------------------------------------------------------
	*   Include admin panel data
	*------------------------------------------------------------*/
	require_once ( FRAMEWORK_INC_LIBRARY . 'global.admin.php' );

	/*-------------------------------------------------------------
	*   Include framework metaboxes
	*------------------------------------------------------------*/
	require_once ( FRAMEWORK_INC_LIBRARY . 'global.metaboxes.php' );
endif;

/*-------------------------------------------------------------
*   Include advertising plugin
*------------------------------------------------------------*/
require_once ( FRAMEWORK_INC_PLUGINS . 'advertising/advertising.php' );
?>