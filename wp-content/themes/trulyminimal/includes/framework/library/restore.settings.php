<?php
function framework_set_default( $secure = null ) {

if( !$secure ) return false;

// Set variables to be array
$restore_settings_options = array();
$restore_settings_template = array();

// Use global variable
global $panel_options;

/*-------------------------------------------------------------
*   Add to array defaults options
*------------------------------------------------------------*/
// START "all options foreach"
foreach( $panel_options as $tab ) :
	switch( $tab['type'] ) :

	/*-------------------------------------------------------------
	*   Add to array "options"
	*------------------------------------------------------------*/
	case "options":

	// START "all options foreach as option"
	foreach( $tab['options'] as $option ) :
		switch( $option['type'] ) :

		/*-------------------------------------------------------------
		*   Add to array hidden options
		*------------------------------------------------------------*/
		case "hidden":
			$restore_settings_options[$option['id']] = $option['default'];
		break;

		/*-------------------------------------------------------------
		*   Add to array text options
		*------------------------------------------------------------*/
		case "text":
			$restore_settings_options[$option['id']] = $option['default'];
		break;

		/*-------------------------------------------------------------
		*   Add to array tiny-text options
		*------------------------------------------------------------*/
		case "tiny-text":
			$restore_settings_options[$option['id']] = $option['default'];
		break;

		/*-------------------------------------------------------------
		*   Add to array textarea options
		*------------------------------------------------------------*/
		case "textarea":
			$restore_settings_options[$option['id']] = $option['default'];
		break;

		/*-------------------------------------------------------------
		*   Add to array select options
		*------------------------------------------------------------*/
		case "select":
			$restore_settings_options[$option['id']] = $option['default'];
		break;

		/*-------------------------------------------------------------
		*   Add to array checkbox options
		*------------------------------------------------------------*/
		case "checkbox":
			$restore_settings_options[$option['id']] = $option['default'];
		break;

		/*-------------------------------------------------------------
		*   Add to array radio options
		*------------------------------------------------------------*/
		case "radio":
			$restore_settings_options[$option['id']] = $option['default'];
		break;

		/*-------------------------------------------------------------
		*   Add to array font options
		*------------------------------------------------------------*/
		case "font":
			foreach( $option['default'] as $id => $value ) :
				$restore_settings_options[$option['id']][$id] = $value;
			endforeach;
		break;

		/*-------------------------------------------------------------
		*   Add to array colorpicker options
		*------------------------------------------------------------*/
		case "colorpicker":
			$restore_settings_options[$option['id']] = $option['default'];
		break;

		/*-------------------------------------------------------------
		*   Add to array upload options
		*------------------------------------------------------------*/
		case "upload":
			$restore_settings_options[$option['id']] = $option['default'];
		break;

		endswitch;

	// END "all options foreach as option"
	endforeach;

	break;

	/*-------------------------------------------------------------
	*   Add to array "layouts"
	*------------------------------------------------------------*/
	case "layout":

	// START "all layouts foreach as layout"
	foreach( $tab['options'] as $option ) :
		switch( $option['type'] ) :

		/*-------------------------------------------------------------
		*   Add to array layouts options
		*------------------------------------------------------------*/
		case "layouts":

			/*-------------------------------------------------------------
			*   Add to array default layouts options
			*------------------------------------------------------------*/
			foreach( $option['default'] as $id => $value ) :
				$restore_settings_options['layout'][$id] = $value;
			endforeach;
		break;
		endswitch;

	// END "all layouts foreach as layout"
	endforeach;

	break;

	/*-------------------------------------------------------------
	*   Add to array template default options
	*------------------------------------------------------------*/
	case "template":

	// START "all templates foreach as template"
	foreach( $tab['options'] as $option ) :
		switch( $option['type'] ) :

		/*-------------------------------------------------------------
		*   Add to array template options
		*------------------------------------------------------------*/
		case "templates":

			/*-------------------------------------------------------------
			*   Add to array default layouts options
			*------------------------------------------------------------*/

			foreach ( $option['templates'] as $template ) :
				foreach( $template['default'] as $section ) :
					$restore_settings_template[$template['id']][] = $section;
				endforeach;
			endforeach;
		break;

		endswitch;

	// END "all templates foreach as template"
	endforeach;

	break;

	endswitch;

// END "all options foreach"
endforeach;

/*-------------------------------------------------------------
*   Check if options already exist and remove them
*------------------------------------------------------------*/
if( get_option( SHORTNAME_SETTINGS ) ) delete_option( SHORTNAME_SETTINGS );
if( get_option( SHORTNAME_TEMPLATE ) ) delete_option( SHORTNAME_TEMPLATE );

/*-------------------------------------------------------------
*   Check if arrays are empty and if not add settings to db
*------------------------------------------------------------*/
if ( !empty( $restore_settings_options ) ) update_option( SHORTNAME_SETTINGS, $restore_settings_options );
if ( !empty( $restore_settings_template ) ) update_option( SHORTNAME_TEMPLATE, $restore_settings_template );
} ?>