<?php

define( 'DOCREDUX_VERSION', '0.0' );

include_once( 'php/class.docredux_doc.php' );
include_once( 'php/class.docredux_staff.php' );

if ( !class_exists( 'docredux' ) ) {

class docredux {
	
	/**
	 * __construct()
	 */
	function __construct() {
		
		$this->documentation = new docredux_doc();
		$this->staff = new docredux_staff();
		
		// Add support for post formats
		add_action( 'after_setup_theme', array( &$this, 'add_post_formats' ) );
		
		add_action( 'init', array( &$this, 'create_taxonomies' ) );
		
	} // END __construct()
	
	/**
	 * init()
	 */
	function init() {
		
	} // END init()
	
	/**
	 * create_taxonomies()
	 * Register taxonomies for all of our post types
	 */
	function create_taxonomies() {
		
		// Register the Courses taxonomy
		$args = array(
			'label' => 'Courses',
			'labels' => array(
				'name' => 'Courses',
				'singular_name' => 'Course',
				'search_items' =>  'Search Courses',
				'popular_items' => 'Popular Courses',
				'all_items' => 'All Courses',
				'parent_item' => 'Parent Courses',
				'parent_item_colon' => 'Parent Courses:',
				'edit_item' => 'Edit Course', 
				'update_item' => 'Update Course',
				'add_new_item' => 'Add New Course',
				'new_item_name' => 'New Course',
				'separate_items_with_commas' => 'Separate courses with commas',
				'add_or_remove_items' => 'Add or remove courses',
				'choose_from_most_used' => 'Choose from the most common courses',
				'menu_name' => 'Courses',
			),
			'show_tagcloud' => false,
			'rewrite' => array(
				'slug' => 'courses',
				'hierarchical' => true,
			),
		);
		
		$post_types = array(
			'post',
			'docredux_doc',
		);
		register_taxonomy( 'docredux_courses', $post_types, $args );
		
		// Register the Topics taxonomy
		$args = array(
			'label' => 'Topics',
			'labels' => array(
				'name' => 'Topics',
				'singular_name' => 'Topic',
				'search_items' =>  'Search Topics',
				'popular_items' => 'Popular Topics',
				'all_items' => 'All Topics',
				'parent_item' => 'Parent Topics',
				'parent_item_colon' => 'Parent Topics:',
				'edit_item' => 'Edit Topic', 
				'update_item' => 'Update Topic',
				'add_new_item' => 'Add New Topic',
				'new_item_name' => 'New Topic',
				'separate_items_with_commas' => 'Separate topics with commas',
				'add_or_remove_items' => 'Add or remove topics',
				'choose_from_most_used' => 'Choose from the most common topics',
				'menu_name' => 'Topics',
			),
			'show_tagcloud' => false,
			'rewrite' => array(
				'slug' => 'topics',
				'hierarchical' => true,
			),
		);
		
		$post_types = array(
			'post',
			'docredux_doc',
			'docredux_staff',
		);
		register_taxonomy( 'docredux_topics', $post_types, $args );
		
	} // END create_taxonomies()
	
	/**
	 * add_post_formats()
	 */
	function add_post_formats() {
		
		$post_formats = array(
			'aside',
			'gallery',
			'status',
			'quote',
			'image',
			'link',
		);
		add_theme_support( 'post-formats', $post_formats );
		add_post_type_support( 'post', 'post-formats' );
		
	} // END add_post_formats()
	
	
} // END class docredux
	
} // END if ( !class_exists( 'docredux' ) )

global $docredux;
$docredux = new docredux();

?>