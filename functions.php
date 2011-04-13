<?php

define( 'DOCREDUX_VERSION', '0.0' );

include_once( 'php/class.docredux_documentation.php' );
include_once( 'php/class.docredux_staff.php' );

if ( !class_exists( 'docredux' ) ) {

class docredux {
	
	/**
	 * __construct()
	 */
	function __construct() {
		
		$this->documentation = new docredux_documentation();
		$this->staff = new docredux_staff();
		
		// Add support for post formats
		add_hook( 'after_setup_theme', array( &$this, 'add_post_formats' ) );
		
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