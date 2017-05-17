<?php
/**
* Plugin Name: 	Oystershell Core
* Plugin URI:  	http://grit-oyster.co.uk/oystershell/
* Description: 	The libraries, classes and functions that form the core of the Oystershell framework. Required by other Oystershell plugins.
* Version: 		1.0
* Author: 		Grit and Oyster Limited
* Author URI: 	http://grit-oyster.co.uk/
*/

/**
 * Core plugin file. Defines functions to load the various Oystershell Core elements.
 *
 * @link       http://grit-oyster.co.uk/
 * @since      1.0.0
 *
 * @package    OSC_Core
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define('OS_CORE_DIR',dirname(__FILE__) . '/');
define('OS_LIB_DIR',OS_CORE_DIR . 'libraries/');

/**
 * Load the Oystershell library
 * This library contains all the default Oystershell core classes.
 */
function osc_load_library_oystershell() {

	require_once OS_LIB_DIR . 'oystershell/init.php';
	require_once OS_CORE_DIR . 'includes/helper-functions.php';
	require_once OS_CORE_DIR . 'includes/postmeta-functions.php';
}

/**
 * Load the CMB2 library
 * CMB2 is a developer's toolkit for building metaboxes, custom fields, and forms for WordPress.
 */
function osc_load_library_cmb2() {

	require_once OS_LIB_DIR . 'CMB2/init.php';
	require_once OS_CORE_DIR . 'includes/cmb-functions.php';

}

/**
 * Load the conditionals extension to the CMB2 library
 * This adds to CMB2 forms the ability to define fields that display conditionally on the response to other fields.
 */
function osc_load_library_cmb2_conditionals() {

	require_once OS_LIB_DIR . 'cmb2-conditionals/cmb2-conditionals.php';

}

/**
 * Load the slider field extension to the CMB2 library
 * This adds an adjustable slider CMB2 field type.
 */
function osc_load_library_cmb2_field_slider() {

	require_once OS_LIB_DIR . 'cmb2-field-slider/cmb2_field_slider.php';

}
