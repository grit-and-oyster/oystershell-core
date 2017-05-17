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
