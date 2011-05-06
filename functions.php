<?php

define( 'DOCREDUX_VERSION', '0.1' );

include_once( 'php/class.docredux_doc.php' );
include_once( 'php/class.docredux_staff.php' );

if ( !class_exists( 'docredux' ) ) {

class docredux {
	
	var $theme_taxonomies = array();
	
	/**
	 * __construct()
	 */
	function __construct() {
		
		$this->documentation = new docredux_doc();
		$this->staff = new docredux_staff();
		
		// Add support for post formats
		add_action( 'after_setup_theme', array( &$this, 'add_post_formats' ) );
		add_action( 'after_setup_theme', array( &$this, 'init' ) );

		add_action( 'init', array( &$this, 'create_taxonomies' ) );
		add_action( 'init', array( &$this, 'enqueue_resources' ) );
		add_action( 'init', array( &$this, 'register_menus' ) );
		
	} // END __construct()
	
	/**
	 * init()
	 */
	function init() {
	    
		add_theme_support( 'post-thumbnails' );
		
	} // END init()
	
	/**
	 * register_menus()
	 * Register menus
	 */
	function register_menus() {
		register_nav_menus(
	    	array( 
				'header-menu' => __( 'Header Menu' ) 
			)
		);
	} // END register_menus()
	
	
	/**
	 * enqueue_resources()
	 * Enqueue any resources we need
	 */
	function enqueue_resources() {
		
		if ( !is_admin() ) {
			wp_enqueue_style( 'docredux_primary_css', get_bloginfo('template_directory') . '/style.css', false, DOCREDUX_VERSION );
		}
		
	} // END enqueue_resources()
	
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
			'hierarchical' => true,
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
		$this->theme_taxonomies[] = 'docredux_courses';		
		
		// Register the Contexts taxonomy
		$args = array(
			'label' => 'Contexts',
			'labels' => array(
				'name' => 'Contexts',
				'singular_name' => 'Context',
				'search_items' =>  'Search Contexts',
				'popular_items' => 'Popular Contexts',
				'all_items' => 'All Contexts',
				'parent_item' => 'Parent Contexts',
				'parent_item_colon' => 'Parent Contexts:',
				'edit_item' => 'Edit Context', 
				'update_item' => 'Update Context',
				'add_new_item' => 'Add New Context',
				'new_item_name' => 'New Context',
				'separate_items_with_commas' => 'Separate contexts with commas',
				'add_or_remove_items' => 'Add or remove contexts',
				'choose_from_most_used' => 'Choose from the most common contexts',
				'menu_name' => 'Contexts',
			),
			'hierarchical' => true,
			'show_tagcloud' => false,
			'rewrite' => array(
				'slug' => 'Contexts',
				'hierarchical' => true,
			),
		);
		
		$post_types = array(
			'post',
			'docredux_doc',
		);
		register_taxonomy( 'docredux_contexts', $post_types, $args );
		$this->theme_taxonomies[] = 'docredux_contexts';		
		
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
		$this->theme_taxonomies[] = 'docredux_topics';			
		
		// Register the Software taxonomy
		$args = array(
			'label' => 'Software',
			'labels' => array(
				'name' => 'Software',
				'singular_name' => 'Software',
				'search_items' =>  'Search Software',
				'popular_items' => 'Popular Software',
				'all_items' => 'All Software',
				'parent_item' => 'Parent Software',
				'parent_item_colon' => 'Parent Software:',
				'edit_item' => 'Edit Software', 
				'update_item' => 'Update Software',
				'add_new_item' => 'Add New Software',
				'new_item_name' => 'New Software',
				'separate_items_with_commas' => 'Separate software with commas',
				'add_or_remove_items' => 'Add or remove software',
				'choose_from_most_used' => 'Choose from the most common software',
				'menu_name' => 'Software',
			),
			'show_tagcloud' => false,
			'rewrite' => array(
				'slug' => 'software',
				'hierarchical' => true,
			),
		);
		
		$post_types = array(
			'post',
			'docredux_doc',
			'docredux_staff',
		);
		register_taxonomy( 'docredux_software', $post_types, $args );
		$this->theme_taxonomies[] = 'docredux_software';			
		
		// Register the Hardware taxonomy
		$args = array(
			'label' => 'Hardware',
			'labels' => array(
				'name' => 'Hardware',
				'singular_name' => 'Hardware',
				'search_items' =>  'Search Hardware',
				'popular_items' => 'Popular Hardware',
				'all_items' => 'All Hardware',
				'parent_item' => 'Parent Hardware',
				'parent_item_colon' => 'Parent Hardware:',
				'edit_item' => 'Edit Hardware', 
				'update_item' => 'Update Hardware',
				'add_new_item' => 'Add New Hardware',
				'new_item_name' => 'New Hardware',
				'separate_items_with_commas' => 'Separate hardware with commas',
				'add_or_remove_items' => 'Add or remove hardware',
				'choose_from_most_used' => 'Choose from the most common hardware',
				'menu_name' => 'Hardware',
			),
			'show_tagcloud' => false,
			'rewrite' => array(
				'slug' => 'hardware',
				'hierarchical' => true,
			),
		);
		
		$post_types = array(
			'post',
			'docredux_doc',
			'docredux_staff',
		);
		register_taxonomy( 'docredux_hardware', $post_types, $args );
		$this->theme_taxonomies[] = 'docredux_hardware';			
		
		// Register the WordPress themes taxonomy
		$args = array(
			'label' => 'WordPress themes',
			'labels' => array(
				'name' => 'WordPress themes',
				'singular_name' => 'WordPress theme',
				'search_items' =>  'Search WordPress themes',
				'popular_items' => 'Popular WordPress themes',
				'all_items' => 'All WordPress themes',
				'parent_item' => 'Parent WordPress themes',
				'parent_item_colon' => 'Parent WordPress themes:',
				'edit_item' => 'Edit WordPress theme', 
				'update_item' => 'Update WordPress theme',
				'add_new_item' => 'Add New WordPress theme',
				'new_item_name' => 'New WordPress theme',
				'separate_items_with_commas' => 'Separate WordPress themes with commas',
				'add_or_remove_items' => 'Add or remove WordPress themes',
				'choose_from_most_used' => 'Choose from the most common WordPress themes',
				'menu_name' => 'WordPress themes',
			),
			'show_tagcloud' => false,
			'rewrite' => array(
				'slug' => 'themes',
				'hierarchical' => true,
			),
		);
		
		$post_types = array(
			'post',
			'docredux_doc',
		);
		register_taxonomy( 'docredux_wpthemes', $post_types, $args );
		$this->theme_taxonomies[] = 'docredux_wpthemes';			
		
		// Register the WordPress plugins taxonomy
		$args = array(
			'label' => 'WordPress plugins',
			'labels' => array(
				'name' => 'WordPress plugins',
				'singular_name' => 'WordPress plugin',
				'search_items' =>  'Search WordPress plugins',
				'popular_items' => 'Popular WordPress plugins',
				'all_items' => 'All WordPress plugins',
				'parent_item' => 'Parent WordPress plugins',
				'parent_item_colon' => 'Parent WordPress plugins:',
				'edit_item' => 'Edit WordPress plugin', 
				'update_item' => 'Update WordPress plugin',
				'add_new_item' => 'Add New WordPress plugin',
				'new_item_name' => 'New WordPress plugin',
				'separate_items_with_commas' => 'Separate WordPress themes with plugins',
				'add_or_remove_items' => 'Add or remove WordPress plugins',
				'choose_from_most_used' => 'Choose from the most common WordPress plugins',
				'menu_name' => 'WordPress plugins',
			),
			'show_tagcloud' => false,
			'rewrite' => array(
				'slug' => 'plugins',
				'hierarchical' => true,
			),
		);
		
		$post_types = array(
			'post',
			'docredux_doc',
		);
		register_taxonomy( 'docredux_wpplugins', $post_types, $args );
		$this->theme_taxonomies[] = 'docredux_wpplugins';			
		
	} // END create_taxonomies()

	/**
	 * add_post_formats()
	 */
	function add_post_formats() {
		
		$post_formats = array(
			'aside',
			'status',
			'quote',
			'image',
		);
		add_theme_support( 'post-formats', $post_formats );
		add_post_type_support( 'post', 'post-formats' );
		
	} // END add_post_formats()
	
	
} // END class docredux
	
} // END if ( !class_exists( 'docredux' ) )

global $docredux;
$docredux = new docredux();

/**
 * docredux_head_title()
 */
function docredux_head_title() {
	
	$title = get_bloginfo('name') . ' | ' . get_bloginfo('description');
	
	if ( is_single() ) {
		global $post;
		$title = get_the_title( $post->ID );
	} else if ( is_tax() ) {
		$title = single_term_title( false, false ) . ' | ' . get_bloginfo('name');
	}
	
	echo '<title>' . $title . '</title>';
	
} // END docredux_head_title()

/**
 * docredux_get_term_base()
 */
function docredux_get_term_base( $term_object ) {
	
	if ( !is_object( $term_object ) ) {
		return false;
	}
	
	switch( $term_object->taxonomy ) {
		case 'docredux_courses':
			return 'courses';
			break;
		case 'docredux_contexts':
			return 'contexts';
			break;
		case 'docredux_topics':
			return 'topics';
			break;
		case 'docredux_software':
			return 'software';
			break;
		case 'docredux_hardware':
			return 'hardware';
			break;
		case 'docredux_wpthemes':
			return 'themes';
			break;
		case 'docredux_plugins':
			return 'plugins';
			break;							
		default:
			return false;
	}
	
} // END docredux_get_term_base()


/**
 * docredux_timestamp()
 * Relative timestamps for use within the loop or elsewhere
 */
function docredux_timestamp( $post_id = null, $type = 'published' ) {
	
	if ( !isset( $post_id ) ) {
		global $post;
		$post_id = $post->ID;
	}
	
	if ( $type == 'published' ) {
		$post_timestamp = get_the_time( 'U', $post_id );
	} else if ( $type == 'modified' ) {
		$post_timestamp = get_the_modified_time( 'U', $post_id );
	} else {
		return false;
	}
	$current_timestamp = time();

	// Only do the relative timestamps for 7 days or less, then just the month and day
	if ( $post_timestamp > ( $current_timestamp - 604800 ) ) {
		echo human_time_diff( $post_timestamp ) . ' ago';
	} else if ( $post_timestamp > ( $current_timestamp - 220752000 ) ) {
		the_time( 'F jS' );
	} else {
		the_time( 'F j, Y' );
	}

	
} // END docredux_timestamp()

?>