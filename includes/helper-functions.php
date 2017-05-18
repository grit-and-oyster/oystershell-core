<?php
/**
 * Helper functions to accompany the Oystershell library
 *
 * @link       http://grit-oyster.co.uk/
 * @since      1.0.0
 *
 * @package    OSC_Core
 * @subpackage OSC_Core/includes
 */

/**
 * Gets (and toggles) the post format for a particular post. Returns the post format as a value.
 *
 * @package  includes
 * @since    1.0.0
 */
function osc_get_post_format( $post_id ) {

	$post_format = get_post_format( $post_id );

	if ( false === $post_format )
		$post_format = 'standard';

	if ( is_sticky( $post_id ) )
		$post_format = 'sticky';

	if ( is_custom_post_type() )
		$post_format = get_post_type( $post_id );

	return $post_format;
}

/**
 * Determines whether or not the current post is a paginated post.
 *
 * @return   boolean    True if the post is paginated; false, otherwise.
 * @package  includes
 * @since    1.0.0
 * https://tommcfarlin.com/post-is-paginated/
 */
function osc_is_paginated_post() {

	global $multipage;
	return 0 !== $multipage;

} // end oystershell_is_paginated_post

/**
 * Determines the *link* for a post with the link post format
 *
 * @return   string   A URL.
 * @package  includes
 * @since    1.0.0
 */
function osc_post_format_link_get_url( $post_id ) {

	$url = get_post_meta($post_id, '_format_link_url', true);

	if ( empty($url) ) {

		$content_post = get_post($post_id);
		$content = $content_post->post_content;
		$urls = wp_extract_urls( $content );
		$url = $urls[0];
	}

	return $url;
}

/**
 * Cleans a URL for display
 *
 * @return   string    A human readable web address
 * @package  includes
 * @since    1.0.0
 */
function osc_clean_url_for_display( $url_string ) {

	// in case scheme relative URI is passed, e.g., //www.google.com/
	$url_string = trim($url_string, '/');

	// If scheme not included, prepend it
	if (!preg_match('#^http(s)?://#', $url_string)) {
	    $url_string = 'http://' . $url_string;
	}

	$urlParts = parse_url($url_string);

	// remove www
	$domain = preg_replace('/^www\./', '', $urlParts['host']);

	if ( !is_null($urlParts['path']) ) {
		$domain = $domain . $urlParts['path'];
	}

	return $domain;
}

/**
 * Check if a post is a custom post type.
 *
 * @param  mixed $post Post object or ID
 * @return boolean
 * @package  includes
 * @since    1.0.0
 */
function osc_is_custom_post_type( $post = NULL ) {
    $all_custom_post_types = get_post_types( array ( '_builtin' => FALSE ) );

    // there are no custom post types
    if ( empty ( $all_custom_post_types ) )
        return FALSE;

    $custom_types      = array_keys( $all_custom_post_types );
    $current_post_type = get_post_type( $post );

    // could not detect current type
    if ( ! $current_post_type )
        return FALSE;

    return in_array( $current_post_type, $custom_types );
}

/**
 * Check if a post is empty of content.
 *
 * @param  $str
 * @return boolean
 * @package  includes
 * @since    1.2.0
 */
function osc_empty_content($str) {
    return trim(str_replace('&nbsp;','',strip_tags($str))) == '';
}


/**
 * Gets the id of the topmost ancestor of the current page. Returns the current
 * page's id if there is no parent.
 *
 * @uses object $post
 * @return int
 * @package  includes
 * @since    1.0.0
 */
function osc_get_post_top_ancestor_id(){
    global $post;

    if($post->post_parent){
        $ancestors = array_reverse(get_post_ancestors($post->ID));
        return $ancestors[0];
    }

    return $post->ID;

}

/**
 * Gets a connected post. For use with the Post2Posts relationship plugin.
 *
 * @package  includes
 * @since    1.0.0
 */
function osc_get_connections( $connected_type, $meta = '' ) {

	$connected = get_posts( array(
	  'connected_type' => $connected_type,
	  'connected_items' => get_queried_object(),
	  'connected_meta' => $meta,
	  'nopaging' => true,
	  'suppress_filters' => false
	) );

	return $connected;
}

/**
 * Gets a connected user. For use with the Post2Posts relationship plugin.
 *
 * @package  includes
 * @since    1.0.0
 */
function osc_get_user_connections( $connected_type, $meta = '' ) {

	$connected = get_users( array(
	  'connected_type' => $connected_type,
	  'connected_items' => get_queried_object(),
	  'connected_meta' => $meta,
	) );

	return $connected;
}

function osc_display_connections( $connected_type, $heading, $div_id ) {

	$connected = new WP_Query( array(
	  'connected_type' => $connected_type,
	  'connected_items' => get_queried_object(),
	  'nopaging' => true,
	) );

	// Display connected pages
	if ( $connected->have_posts() ) :
	?>

	<div id="<?php echo $div_id; ?>" role="complementary">

		<h3><?php echo $heading; ?></h3>

		<?php while ( $connected->have_posts() ) : $connected->the_post(); ?>
		    <p><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
		<?php endwhile; ?>

	</div>

	<?php
	// Prevent weirdness
	wp_reset_postdata();

	endif;

}


function osc_display_connections_related( $connected_type, $heading, $div_id, $format ) {

	$connected = new WP_Query( array(
	  'connected_type' => $connected_type,
	  'connected_items' => get_queried_object(),
	  'nopaging' => true,
	) );

	// Display connected pages
	if ( $connected->have_posts() ) :
	?>
	<div id="<?php echo $div_id; ?>" role="complementary">

		<h3><?php echo $heading; ?></h3>

		<?php while ( $connected->have_posts() ) : $connected->the_post(); ?>
			<?php get_template_part( 'format', $format ); ?>
		<?php endwhile; ?>

	</div>

	<?php
	// Prevent weirdness
	wp_reset_postdata();

	endif;
}
