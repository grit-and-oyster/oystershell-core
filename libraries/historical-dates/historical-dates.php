<?php

/**
 * Functions for handling dates outside the normal range
 *
 * @link       http://grit-oyster.co.uk/
 * @since      1.0.0
 *
 * @package    OSC_Core
 * @subpackage OSC_Core/includes/historical-dates
 */

/**
 * Functions for handling dates outside the normal range.
 *
 * Various functions for handling dates outside the years 1901-2038 on Unix and 1970-2038 on Windows.
 *
 * @since      1.0.0
 * @package    OSC_Core
 * @subpackage OSC_Core/includes/historical-dates
 * @author     Grit & Oyster <code@grit-oyster.co.uk>
 */


/**
 * Converts a date string into a timestamp
 *
 * @since    1.0.0
 */
function osc_histdate_to_timestamp( $histDate, $format = '') {

	$timeStamp = '';

	if ( ! empty( $histDate )) {
		switch ($format) {
			case 'm/d/Y':
				list($month, $day, $year) = split('/', $histDate);
				break;
			default:
				list($day, $month, $year) = split('-', $histDate); 
				break;
		}
		$timeStamp = adodb_mktime(0, 0, 0, $month, $day, $year); 
	}

	return $timeStamp;

}

/**
 * Converts a timestamp into a date string
 *
 * @since    1.0.0
 */
function osc_timestamp_to_histdate( $timeStamp, $format = 'd/m/Y') {

	$histDate = '';

	$histDate = adodb_date($format, $timeStamp );

	return $histDate;
}

/**
 * Create the "historical-date" CMB2 field type
 */

/**
 * Renders the field type
 *
 * Renders the "historical-date" field type using the CMB2 object type of Text Date Timestamp.
 * Converts the value from timestamp to string before displaying. 
 *
 * @since    1.0.0
 */
function cmb2_render_callback_for_historical_date( $field, $escaped_value, $object_id, $object_type, $field_type_object ) {

	$field->escaped_value = osc_timestamp_to_histdate( $field->escaped_value, 'm/d/Y' );
    
    echo $field_type_object->text_date_timestamp();


}

/**
 * Sanitizes the field type
 *
 * Takes the value from the metabox field and converts it into a timestamp before saving. 
 *
 * @since    1.0.0
 */
function cmb2_sanitize_historical_date_callback( $override_value, $value ) {

	$value = osc_histdate_to_timestamp( $value, 'm/d/Y');

    return $value;
}

add_action( 'cmb2_render_historical_date', 'cmb2_render_callback_for_historical_date', 10, 5 );
add_filter( 'cmb2_sanitize_historical_date', 'cmb2_sanitize_historical_date_callback', 10, 2 );

?>