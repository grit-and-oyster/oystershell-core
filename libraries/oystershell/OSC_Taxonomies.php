<?php

/**
 * Helps with custom taxonomies
 *
 * @link       http://grit-oyster.co.uk/
 * @since      1.0.0
 *
 * @package    OSC_Core
 * @subpackage OSC_Core/libraries/oystershell
 */

/**
 * Helps with custom taxonomies.
 *
 * This class defines and adds custom taxonomies.
 *
 * @since      1.0.0
 * @package    OSC_Core
 * @subpackage OSC_Core/libraries/oystershell
 * @author     Grit & Oyster <code@grit-oyster.co.uk>
 */
class OSC_Taxonomies {

	/**
	 * Sets up the arguments for a taxomony of the 'category' type
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public function category_args( $tax_label_singular, $tax_label_plural, $slug, $description ) {

		$labels = array(

					'name' => _x( $tax_label_plural, 'taxonomy general name' ),
					'singular_name' => _x( $tax_label_singular, 'taxonomy singular name' ),
					'search_items' =>  __( 'Search '.$tax_label_plural ),
					'all_items' => __( 'All '.$tax_label_plural ),
					'parent_item' => __( 'Parent '.$tax_label_singular ),
					'parent_item_colon' => __( 'Parent '.$tax_label_singular.':' ),
					'edit_item' => __( 'Edit '.$tax_label_singular ),
					'update_item' => __( 'Update '.$tax_label_singular ),
					'add_new_item' => __( 'Add New '.$tax_label_singular ),
					'new_item_name' => __( 'New '.$tax_label_singular ),
					'menu_name' => __( $tax_label_plural )
			);


		$args = array(

			'labels' => $labels,

			// If the taxonomy should be publicly queryable.
			'public' => true,
            
            // Whether to generate a default UI for managing this taxonomy.
            'show_ui' => true,

			// Where to show the taxonomy in the admin menu.
            'show_in_menu' => true,

            // Makes this taxonomy available for selection in navigation menus.
			'show_in_nav_menus' => true,

			// Whether to allow the Tag Cloud widget to use this taxonomy.
			'show_tagcloud' => true,

			// Whether to show the taxonomy in the quick/bulk edit panel.
			'show_in_quick_edit' => true,

			// Provide a callback function name for the meta box display. If null uses default for categories or tags.
			'meta_box_cb' => null,

			// Whether to allow automatic creation of taxonomy columns on associated post-types table. 
			'show_admin_column' => true,

			// Include a description of the taxonomy.
			'description' => $description,

			// Hierarchical taxonomy (like categories)
			'hierarchical' => true,

			'query_var' => true,
            'rewrite' => array(
					'slug' => $slug, // This controls the base slug that will display before each term
					'with_front' => true, // Display the category base before "/locations/"
					'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
					),
		);

		return $args;

	}

	/**
	 * Sets up the arguments for a taxomony of the 'tag' type
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public function tag_args( $tax_label_singular, $tax_label_plural, $slug, $description ) {


		$labels = array(

				'name' => _x( $tax_label_plural, 'taxonomy general name' ),
				'singular_name' => _x( $tax_label_singular, 'taxonomy singular name' ),
				'search_items' =>  __( 'Search '.$tax_label_plural ),
				'popular_items' => __( 'Popular '.$tax_label_plural ),
				'all_items' => __( 'All '.$tax_label_plural ),
				'parent_item'                => null,
				'parent_item_colon'          => null,
				'edit_item' => __( 'Edit '.$tax_label_singular ),
				'update_item' => __( 'Update '.$tax_label_singular ),
				'add_new_item' => __( 'Add New '.$tax_label_singular ),
				'new_item_name' => __( 'New '.$tax_label_singular ),
				'separate_items_with_commas' => __( 'Separate '. strtolower($tax_label_plural) . ' with commas' ),
				'add_or_remove_items'        => __( 'Add or remove ' . strtolower($tax_label_plural) ),
				'choose_from_most_used'      => __( 'Choose from the most used ' . strtolower($tax_label_plural) ),
				'not_found'                  => __( 'No '. strtolower($tax_label_plural) . ' found.' ),
				'menu_name' => __( $tax_label_plural )
		);


		$args = array(

			'labels' => $labels,

			// If the taxonomy should be publicly queryable.
			'public' => true,
            
            // Whether to generate a default UI for managing this taxonomy.
            'show_ui' => true,

			// Where to show the taxonomy in the admin menu.
            'show_in_menu' => true,

            // Makes this taxonomy available for selection in navigation menus.
			'show_in_nav_menus' => false,

			// Whether to allow the Tag Cloud widget to use this taxonomy.
			'show_tagcloud' => true,

			// Whether to show the taxonomy in the quick/bulk edit panel.
			'show_in_quick_edit' => true,

			// Provide a callback function name for the meta box display. If null uses default for categories or tags.
			'meta_box_cb' => null,

			// Whether to allow automatic creation of taxonomy columns on associated post-types table. 
			'show_admin_column' => false,

			// Include a description of the taxonomy.
			'description' => $description,

			// Hierarchical taxonomy (like categories)
			'hierarchical' => false,

			'update_count_callback' => '_update_post_term_count',
			'query_var'             => true,
            'rewrite' => array(
					'slug' => $slug, // This controls the base slug that will display before each term
					'with_front' => true, // Display the category base before "/locations/"
					'hierarchical' => false // This will allow URL's like "/locations/boston/cambridge/"
					),
		);

		return $args;

	}

	/**
	 * Sets up the arguments for a taxomony of the 'hidden' type
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public function hidden_args( $tax_label_singular, $tax_label_plural, $slug, $description ) {


		$labels = array(

					'name' => _x( $tax_label_plural, 'taxonomy general name' ),
					'singular_name' => _x( $tax_label_singular, 'taxonomy singular name' ),
					'search_items' =>  __( 'Search '.$tax_label_plural ),
					'all_items' => __( 'All '.$tax_label_plural ),
					'parent_item' => __( 'Parent '.$tax_label_singular ),
					'parent_item_colon' => __( 'Parent '.$tax_label_singular.':' ),
					'edit_item' => __( 'Edit '.$tax_label_singular ),
					'update_item' => __( 'Update '.$tax_label_singular ),
					'add_new_item' => __( 'Add New '.$tax_label_singular ),
					'new_item_name' => __( 'New '.$tax_label_singular ),
					'menu_name' => __( $tax_label_plural )
			);


		$args = array(

			'labels' => $labels,

			// If the taxonomy should be publicly queryable.
			'public' => true,
            
            // Whether to generate a default UI for managing this taxonomy.
            'show_ui' => false,

			// Where to show the taxonomy in the admin menu.
            'show_in_menu' => null,

            // Makes this taxonomy available for selection in navigation menus.
			'show_in_nav_menus' => false,

			// Whether to allow the Tag Cloud widget to use this taxonomy.
			'show_tagcloud' => null,

			// Whether to show the taxonomy in the quick/bulk edit panel.
			'show_in_quick_edit' => null,

			// Provide a callback function name for the meta box display. If null uses default for categories or tags.
			'meta_box_cb' => null,

			// Whether to allow automatic creation of taxonomy columns on associated post-types table. 
			'show_admin_column' => false,

			// Include a description of the taxonomy.
			'description' => $description,

			// Hierarchical taxonomy (like categories)
			'hierarchical' => true,

			'query_var' => true,
            'rewrite' => array(
					'slug' => $slug, // This controls the base slug that will display before each term
					'with_front' => true, // Display the category base before "/locations/"
					'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
					),
		);

		return $args;

	}

	/**
	 * Sets up the arguments for a taxomony of the 'custom_metabox' type
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public function custom_metabox_args( $tax_label_singular, $tax_label_plural, $slug, $description ) {

		$labels = array(

					'name' => _x( $tax_label_plural, 'taxonomy general name' ),
					'singular_name' => _x( $tax_label_singular, 'taxonomy singular name' ),
					'search_items' =>  __( 'Search '.$tax_label_plural ),
					'all_items' => __( 'All '.$tax_label_plural ),
					'parent_item' => __( 'Parent '.$tax_label_singular ),
					'parent_item_colon' => __( 'Parent '.$tax_label_singular.':' ),
					'edit_item' => __( 'Edit '.$tax_label_singular ),
					'update_item' => __( 'Update '.$tax_label_singular ),
					'add_new_item' => __( 'Add New '.$tax_label_singular ),
					'new_item_name' => __( 'New '.$tax_label_singular ),
					'menu_name' => __( $tax_label_plural )
			);


		$args = array(

			'labels' => $labels,

			// If the taxonomy should be publicly queryable.
			'public' => true,
            
            // Whether to generate a default UI for managing this taxonomy.
            'show_ui' => true,

			// Where to show the taxonomy in the admin menu.
            'show_in_menu' => true,

            // Makes this taxonomy available for selection in navigation menus.
			'show_in_nav_menus' => false,

			// Whether to allow the Tag Cloud widget to use this taxonomy.
			'show_tagcloud' => false,

			// Whether to show the taxonomy in the quick/bulk edit panel.
			'show_in_quick_edit' => false,

			// Provide a callback function name for the meta box display. If null uses default for categories or tags.
			'meta_box_cb' => false,

			// Whether to allow automatic creation of taxonomy columns on associated post-types table. 
			'show_admin_column' => true,

			// Include a description of the taxonomy.
			'description' => $description,

			// Hierarchical taxonomy (like categories)
			'hierarchical' => true,

			'query_var' => true,
            'rewrite' => array(
					'slug' => $slug, // This controls the base slug that will display before each term
					'with_front' => true, // Display the category base before "/locations/"
					'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
					),
		);

		return $args;

	}

	/**
	 * Sets up the arguments for a taxomony of the 'alpha' type
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public function alpha_args( $tax_label_singular, $tax_label_plural, $slug, $description ) {


		$labels = array(

				'name' => _x( $tax_label_plural, 'taxonomy general name' ),
				'singular_name' => _x( $tax_label_singular, 'taxonomy singular name' ),
				'search_items' =>  __( 'Search '.$tax_label_plural ),
				'popular_items' => __( 'Popular '.$tax_label_plural ),
				'all_items' => __( 'All '.$tax_label_plural ),
				'parent_item'                => null,
				'parent_item_colon'          => null,
				'edit_item' => __( 'Edit '.$tax_label_singular ),
				'update_item' => __( 'Update '.$tax_label_singular ),
				'add_new_item' => __( 'Add New '.$tax_label_singular ),
				'new_item_name' => __( 'New '.$tax_label_singular ),
				'separate_items_with_commas' => __( 'Separate '. strtolower($tax_label_plural) . ' with commas' ),
				'add_or_remove_items'        => __( 'Add or remove ' . strtolower($tax_label_plural) ),
				'choose_from_most_used'      => __( 'Choose from the most used ' . strtolower($tax_label_plural) ),
				'not_found'                  => __( 'No '. strtolower($tax_label_plural) . ' found.' ),
				'menu_name' => __( $tax_label_plural )
		);


		$args = array(

			'labels' => $labels,

			// If the taxonomy should be publicly queryable.
			'public' => true,
            
            // Whether to generate a default UI for managing this taxonomy.
            'show_ui' => false,

			// Where to show the taxonomy in the admin menu.
            'show_in_menu' => null,

            // Makes this taxonomy available for selection in navigation menus.
			'show_in_nav_menus' => false,

			// Whether to allow the Tag Cloud widget to use this taxonomy.
			'show_tagcloud' => null,

			// Whether to show the taxonomy in the quick/bulk edit panel.
			'show_in_quick_edit' => null,

			// Provide a callback function name for the meta box display. If null uses default for categories or tags.
			'meta_box_cb' => null,

			// Whether to allow automatic creation of taxonomy columns on associated post-types table. 
			'show_admin_column' => false,

			// Include a description of the taxonomy.
			'description' => $description,

			// Hierarchical taxonomy (like categories)
			'hierarchical' => false,

			'update_count_callback' => '_update_post_term_count',
			'query_var'             => true,
            'rewrite' => array(
					'slug' => $slug, // This controls the base slug that will display before each term
					'with_front' => true, // Display the category base before "/locations/"
					'hierarchical' => false // This will allow URL's like "/locations/boston/cambridge/"
					),
		);

		return $args;

	}

	/**
	 * Registers the custom taxonomies with WordPress
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public function register_taxonomy( $taxonomy_name, $object_type, $oystershell_taxonomy_type, $tax_label_singular, $tax_label_plural, $slug, $description ) {

		if (is_array( $oystershell_taxonomy_type )) {

			$args = $oystershell_taxonomy_type;

		} else {

			switch ( $oystershell_taxonomy_type ) {
				case 'category':
					$args = $this->category_args( $tax_label_singular, $tax_label_plural, $slug, $description );
					break;
				case 'tag':
					$args = $this->tag_args( $tax_label_singular, $tax_label_plural, $slug, $description );
					break;			
				case 'hidden':
					$args = $this->hidden_args( $tax_label_singular, $tax_label_plural, $slug, $description );
					break;		
				case 'custom_metabox':
					$args = $this->custom_metabox_args( $tax_label_singular, $tax_label_plural, $slug, $description );
					break;		
				case 'alpha':
					$args = $this->alpha_args( $tax_label_singular, $tax_label_plural, $slug, $description );
					break;	
				default:
					# code...
					break;
			}
		}

		register_taxonomy( $taxonomy_name, null, $args );
	
		if (is_array( $object_type )) {
			foreach ( $object_type as $object ) {
				register_taxonomy_for_object_type( $taxonomy_name, $object );
			}
		} else {
			register_taxonomy_for_object_type( $taxonomy_name, $object_type );
		}

	}

}
