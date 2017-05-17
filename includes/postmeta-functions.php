<?php
/**
 * Display functions for working with post meta
 *
 * @link       http://grit-oyster.co.uk/
 * @since      1.0.0
 *
 * @package    OSC_Core
 * @subpackage OSC_Core/includes
 */

//------------------------------------------------------------------------------------
/**
 * Gets a persons name using standard name post meta fields.
 * Requires the post id and the meta field prefix.
 * Optionally choose a display format: 'index', 'short', 'short-index'
 *
 */
function osc_get_persons_name( $prefix, $post_id, $format = '' ) {

	$name_prefix = get_post_meta( $post_id, $prefix . 'name_prefix', true );
	$name_firstname = get_post_meta( $post_id, $prefix . 'name_firstname', true );
	$name_lastname = get_post_meta( $post_id, $prefix . 'name_lastname', true );
	$name_suffix = get_post_meta( $post_id, $prefix . 'name_suffix', true );
	$name_nickname = get_post_meta( $post_id, $prefix . 'name_nickname', true );

	$person_name = '';

	if ( $format == 'index' ) {

		if ( ! empty($name_lastname)) { 
			$person_name = $person_name . esc_html( $name_lastname ) . ', ';
		}
		if ( ! empty($name_prefix)) { 
			$person_name = $person_name . esc_html( $name_prefix ) . ' ';
		}
		if ( ! empty($name_firstname)) { 
			$person_name = $person_name . esc_html( $name_firstname ) . ' ';
		}
		if ( ! empty($name_suffix)) { 
			$person_name = $person_name . '(';
			$person_name = $person_name . esc_html( $name_suffix );
			$person_name = $person_name . ')';
		}

	} elseif ( $format == 'short' ) {

		if ( ! empty($name_firstname)) { 
			$person_name = $person_name . esc_html( $name_firstname ) . ' ';
		}
		if ( ! empty($name_lastname)) { 
			$person_name = $person_name . esc_html( $name_lastname );
		}

	} elseif ( $format == 'short-index' ) {

		if ( ! empty($name_lastname)) { 
			$person_name = $person_name . esc_html( $name_lastname ) . ', ';
		}
		if ( ! empty($name_prefix)) { 
			$person_name = $person_name . esc_html( $name_prefix ) . ' ';
		}
		if ( ! empty($name_firstname)) { 
			$person_name = $person_name . esc_html( $name_firstname );
		}

	} elseif ( $format == 'h-card' ) {

		if ( ! empty($name_prefix)) { 
			$person_name = $person_name . '<span class="p-honorific-prefix honorific-prefix">' . esc_html( $name_prefix ) . '</span> ';
		}
		if ( ! empty($name_firstname)) { 
			$person_name = $person_name . '<span class="p-given-name given-name">' . esc_html( $name_firstname ) . '</span> ';
		}
		if ( ! empty($name_nickname)) { 
			$person_name = $person_name . '&ldquo;<span class="p-nickname nickname">' . esc_html( $name_nickname ) . '</span>&rdquo; ';
		}		
		if ( ! empty($name_lastname)) { 
			$person_name = $person_name . '<span class="p-family-name family-name">' . esc_html( $name_lastname ) . '</span> ';
		}
		if ( ! empty($name_suffix)) { 
			$person_name = $person_name . '<span class="p-honorific-suffix honorific-suffix">' . esc_html( $name_suffix ) . '</span>';
		}

	} else {

		if ( ! empty($name_prefix)) { 
			$person_name = $person_name . esc_html( $name_prefix ) . ' ';
		}
		if ( ! empty($name_firstname)) { 
			$person_name = $person_name . esc_html( $name_firstname ) . ' ';
		}
		if ( ! empty($name_nickname)) { 
			$person_name = $person_name . '&ldquo;' . esc_html( $name_nickname ) . '&rdquo; ';
		}		
		if ( ! empty($name_lastname)) { 
			$person_name = $person_name . esc_html( $name_lastname ) . ' ';
		}
		if ( ! empty($name_suffix)) { 
			$person_name = $person_name . esc_html( $name_suffix );
		}

	}

	return $person_name;
} // end oystershell_get_persons_name


//------------------------------------------------------------------------------------
/**
 * Displays a persons name using standard name post meta fields.
 * Requires the meta field prefix.
 * Optionally choose a display format: 'index', 'short', 'short-index'
 *
 */
function osc_display_persons_name( $prefix = '_', $post_id = '', $format = '' ) {

	if ( empty($post_id) ) {
		$post_id = get_the_ID();
	}

	$person_name = osc_get_persons_name( $prefix, $post_id, $format );

	echo $person_name;

} // end oystershell_display_persons_name


//------------------------------------------------------------------------------------
/**
 * Gets a persons job title using standard post meta fields.
 * Requires the post id and the meta field prefix.
 *
 */
function osc_get_persons_job_title( $prefix, $post_id ) {

	$job_title = get_post_meta( $post_id, $prefix . 'job_title', true );

	return $job_title;
} // end oystershell_get_persons_job_title


//------------------------------------------------------------------------------------
/**
 * Displays a persons job title using standard post meta fields.
 * Requires the meta field prefix.
 *
 */
function osc_display_persons_job_title( $prefix = '_', $post_id = '' ) {

	if ( empty($post_id) ) {
		$post_id = get_the_ID();
	}

	$job_title = osc_get_persons_job_title( $prefix, $post_id );

	$output = '';

	if ( ! empty($job_title)) {

		if ( is_array($job_title)) {

			$output = $output .'<ul class="os-job-title-list">';

			foreach ($job_title as $key => $title) {
				$output = $output . '<li class="p-job-title title">' . esc_html( $title ) . '</li>';
			}

			$output = $output . '</ul>';

		} else {

			$output = '<span class="p-job-title title">' . esc_html( $job_title ) . '</span>';

		}

	}

	echo $output;
} // end oystershell_display_persons_job_title


//------------------------------------------------------------------------------------
/**
 * Formats and displays an email address
 * Requires a variable passed to it containing an email address or array of email addresses.
 *
 */
function osc_display_email( $email_data ) {

	$output = '';

	if ( !empty( $email_data )) {

		if ( is_array($email_data)) {

			$output = $output .'<ul class="os-email-list">';

			foreach ( $email_data as $key => $email ) {

				if ( is_email( $email )) {

					$output = $output . '<li><a href="mailto:' . antispambot( $email ) . '" target="_blank" >' . antispambot( $email ) . '</a></li>';
				}
			}

			$output = $output . '</ul>';

		} else {

			if ( is_email( $email_data )) {

				$output = '<a href="mailto:' . antispambot( $email_data ) . '" target="_blank" >' . antispambot( $email_data ) . '</a>';
			}
		}
	}

	echo $output;
} // end oystershell_display_email


//------------------------------------------------------------------------------------
/**
 * Displays a 'portrait' defined by a meta field containing details of an attachment.
 * Requires the meta field prefix.
 *
 */
function osc_display_portrait( $prefix = '_', $post_id = '', $size = 'thumbnail' ) {

	if ( empty($post_id) ) {
		$post_id = get_the_ID();
	}

	$portrait = get_post_meta( $post_id, $prefix . 'portrait_image', true );

	$portrait_image = wp_get_attachment_image( get_post_meta( $post_id, $prefix . 'portrait_image_id', 1 ), $size, false, array( "class" => "os-portrait-image" ) );

	$output = '';

	if (! empty($portrait_image)) { 

		$output = '<div class="os-portrait-image">';

		if ( ! is_single()) {
			$output = $output . '<a href="' . get_the_permalink() . '" >';
		}

		$output = $output . $portrait_image;
		
		if ( ! is_single()) {
			$output = $output . '</a>';
		}

		$output = $output . '</div>';
	}

	echo $output;
} // end oystershell_display_portrait


//------------------------------------------------------------------------------------
/**
 * Prints a link to a file attachment
 *
 * @since    1.0.0
 */
function osc_display_file_link( $field_id = '', $post_id = '' ) {

	$output = '';

	if ( !empty( $field_id ) ) {

		if ( empty($post_id) ) {
			$post_id = get_the_ID();
		}

		$file = get_post_meta( $post_id, $field_id, true );

		if (! empty($file)) { 

			$file_link = '';

			$att_url = wp_get_attachment_url( get_post_meta( $post_id, $field_id . '_id', 1 ) );
			$filetype = wp_check_filetype($att_url);
			$filesize = size_format(filesize( get_attached_file( get_post_meta( $post_id, $field_id . '_id', 1 ) ) ) );	
			$attachment = oystershell_get_attachment( get_post_meta( $post_id, $field_id . '_id', 1 ) );
			
			$file_link = '<span class="os-file-link"><a href="' . $att_url . '" title="Download file" target="_blank"><span class="genericon genericon-size-24 genericon-attachment"></span>' . $attachment['title'] . '</a></span> <span class="os-file-type">[' . $filetype['ext'] . '</span> <span class="os-file-size">' . $filesize . ']</span>';

			$output = $output . $file_link;
		}
	}
	echo $output; 
} // oystershell_display_file_link


/**
 * Function for outputting a cmb2 file_list
 *
 * @since  1.0.1
 * @param  string  $field_id 	The field meta key. ('field_id')
 * @param  string  $post_id     The post the files are attached to
 */
function osc_display_file_link_list( $field_id = '', $post_id = '' ) {

	$output = '';

	if ( !empty( $field_id ) ) {

		if ( empty($post_id) ) {
			$post_id = get_the_ID();
		}

	    // Get the list of files
	    $files = get_post_meta( $post_id, $field_id, 1 );

		if (! empty($files)) { 

			$output = $output . '<div class="file-list-wrap"><ol>';

    		foreach ( (array) $files as $attachment_id => $att_url ) {

				$filetype = wp_check_filetype($att_url);
				$filesize = size_format(filesize( get_attached_file( $attachment_id ) ) );	
				$attachment = oystershell_get_attachment( $attachment_id );
				
				$file_link = '<li><span class="os-file-link"><a href="' . $att_url . '" title="Download file" target="_blank"><span class="genericon genericon-size-24 genericon-attachment"></span>' . $attachment['title'] . '</a></span> <span class="os-file-type">[' . $filetype['ext'] . '</span> <span class="os-file-size">' . $filesize . ']</span></li>';

				$output = $output . $file_link;
    		}

    		$output = $output . '</ol></div>';
		}
	}
	echo $output; 
}