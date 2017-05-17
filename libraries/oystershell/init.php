<?php
/**
 * Init file for the Oystershell library within Oystershell Core.
 *
 * Will load classes with the name OSC_ClassName as required.
 *
 * @link       http://grit-oyster.co.uk/
 * @since      1.0.0
 *
 * @package    OSC_Core
 * @subpackage OSC_Core/libraries/oystershell
 */

/**
 * Define the directory of the library
 */
if ( ! defined( 'OSC_DIR' ) ) {
	define( 'OSC_DIR', trailingslashit( dirname( __FILE__ ) ) );
}

/**
 * Helper function to provide directory path to Oystershell
 * @since  1.0.0
 * @param  string  $path Path to append
 * @return string        Directory with optional path appended
 */
function osc_dir( $path = '' ) {
	return OSC_DIR . $path;
}

/**
 * Autoloads files with Oystershell Core classes when needed
 * @since  1.0.0
 * @param  string $class_name Name of the class being requested
 */
function osc_autoload_classes( $class_name ) {
	if ( 0 !== strpos( $class_name, 'OSC' ) ) {
		return;
	}

	include_once( osc_dir( "{$class_name}.php" ) );
}
spl_autoload_register( 'osc_autoload_classes' );