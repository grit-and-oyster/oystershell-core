<?php
/**
 * Custom metabox functions to accompany the CMB2 library
 *
 * @link       http://grit-oyster.co.uk/
 * @since      1.0.0
 *
 * @package    OSC_Core
 * @subpackage OSC_Core/includes
 */

/**
 * Hides user metaboxes on the new user page
 *
 * Determines whether we are on the user profile screen in the WordPress admin.
 *
 * Used as a callback when defining fields for users so that individual fields
 * can be hidden from the new users screen.
 *
 * @since  1.0.0
 * @param  string   $field Name of the field
 * @return false if on user profile otherwise true
 */
function osc_cmb_only_show_on_admin_user_profile( $field ) {
	$screen = get_current_screen();

	if ( $screen->id == 'user' )
	        return false;

	return true;
}

/**
 * Wrapper function around cmb2_get_option.
 *
 * @param  string $key     Options array key
 * @param  string $key     Options array key
 * @param  mixed  $default Optional default value
 * @return mixed           Option value
 */
function osc_cmb_get_option( $metabox_array, $key, $default = false ) {
	if ( function_exists( 'cmb2_get_option' ) ) {
		// Use cmb2_get_option as it passes through some key filters.
		return cmb2_get_option( $metabox_array, $key, $default );
	}
	// Fallback to get_option if CMB2 is not loaded yet.
	$opts = get_option( $metabox_array, $default );
	$val = $default;
	if ( 'all' == $key ) {
		$val = $opts;
	} elseif ( array_key_exists( $key, $opts ) && false !== $opts[ $key ] ) {
		$val = $opts[ $key ];
	}
	return $val;
}

/**
 * Gets the available options for a users display_name field
 *
 * @since  1.0.0
 * @param  string   $user_id The ID of the user
 * @return an array of options
 */
function osc_get_display_name_options( $user_id ) {

		$user = get_userdata( $user_id );

		$public_display = array();
		$public_display['display_nickname']  = $user->nickname;
		$public_display['display_username']  = $user->user_login;

		if ( ! empty( $user->first_name ) )
			$public_display['display_firstname'] = $user->first_name;

		if ( ! empty( $user->last_name ) )
			$public_display['display_lastname'] = $user->last_name;

		if ( ! empty( $user->first_name ) && ! empty( $user->last_name ) ) {
			$public_display['display_firstlast'] = $user->first_name . ' ' . $user->last_name;
			$public_display['display_lastfirst'] = $user->last_name . ' ' . $user->first_name;
		}

		if ( ! in_array( $user->display_name, $public_display ) )// Only add this if it isn't duplicated elsewhere
			$public_display = array( 'display_displayname' => $user->display_name ) + $public_display;

		$public_display = array_map( 'trim', $public_display );
		$public_display = array_unique( $public_display );

		return $public_display;
}

/**
 * Returns the available options for a users display_name field for use in a custom meta box
 *
 * @since  1.0.0
 * @param  array   $field The properties of the metabox field
 * @return an array of options
 */
function osc_cmb_show_user_display_name_options( $field ) {

	$display_name_options = osc_get_display_name_options( $field->object_id );

	$output = array();

	foreach ($display_name_options as $key => $value) {
		$output[$value] = $value;
	}

	return $output;
}
