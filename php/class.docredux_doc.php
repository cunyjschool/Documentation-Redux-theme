<?php
/**
 * Documentation custom post type
 * @author danielbachhuber
 * @since 0.1
 */

if ( !class_exists( 'docredux_doc' ) ) {
	
class docredux_doc
{
	
	/**
	 * __construct()
	 */
	function __construct() {
		
		// Add Database post type
		$this->create_post_type();		
		
	} // END __construct()
	
	/**
	 * create_post_type()
	 * Register the database post type with WordPress
	 */
	function create_post_type() {
		
		$args = array(
			'labels' => array(
	        	'name' => 'Documentation',
	        	'singular_name' => 'Documentation',
				'add_new_item' => 'Add New Documentation',
				'edit_item' => 'Edit Documentation',
				'new_item' => 'New Documentation',
				'view' => 'View Documentation',
				'view_item' => 'View Documentation',
				'search_items' => 'Search Documentation',
				'not_found' => 'No documentation found',
				'not_found_in_trash' => 'No documentation found in Trash',
				'parent' => 'Parent Documentation'
	      	),
			'menu_position' => 8,
			'public' => true,
			'has_archive' => true,
			'rewrite' => array(
				'slug' => 'documentation'
			),
			'supports' => array(
				'title',
				'editor',
				'excerpt',
				'author'
			),
			'taxonomies' => array(
				'docredux_courses',
				'docredux_wpthemes',
				'docredux_wpplugins',
				'docredux_topics',
				'docredux_software',
				'docredux_hardware',
			)
	    );
		
		register_post_type( 'docredux_doc', $args );
		
	} // END - create_post_type()
	
} // END class docredux_doc
	
	
} // END if !class_exists( 'docredux_doc' )


?>