<?php
/**
 * Staff custom post type
 * @author danielbachhuber
 * @since 0.1
 */

if ( !class_exists( 'docredux_staff' ) ) {
	
class docredux_staff
{
	
	/**
	 * __construct()
	 */
	function __construct() {
		
		// Add Staff post type
		$this->create_post_type();
		
		// Set up metabox and related actions
		add_action('admin_menu', array(&$this, 'add_post_meta_box'));
		add_action('save_post', array(&$this, 'save_post_meta_box'));
		add_action('edit_post', array(&$this, 'save_post_meta_box'));
		add_action('publish_post', array(&$this, 'save_post_meta_box'));		
		
	} // END __construct()
	
	/**
	 * create_post_type()
	 * Register the database post type with WordPress
	 */
	function create_post_type() {
		
		$args = array(
			'labels' => array(
	        	'name' => 'Staff',
	        	'singular_name' => 'Staff Member',
				'add_new_item' => 'Add New Staff Member',
				'edit_item' => 'Edit Staff Member',
				'new_item' => 'New Staff Member',
				'view' => 'View Staff',
				'view_item' => 'View Staff',
				'search_items' => 'Search Staff Members',
				'not_found' => 'No Staff Members found',
				'not_found_in_trash' => 'No staff found in Trash',
				'parent' => 'Parent Staff Member'
	      	),
			'menu_position' => 9,
			'public' => true,
			'has_archive' => true,
			'rewrite' => array(
				'slug' => 'staff'
			),
			'supports' => array(
				'title',
				'editor',
				'excerpt',
			),
			'taxonomies' => array(
				'docredux_topics',
				'docredux_software',
				'docredux_hardware',
			)
	    );
		
		register_post_type( 'docredux_staff', $args );
		
	} // END - create_post_type()
	
	/**
	 * add_post_meta_box()
	 */
	function add_post_meta_box() {
		
		add_meta_box( 'docredux_staff', __( 'Metadata', 'docredux_staff' ), array( &$this, 'post_meta_box' ), 'docredux_staff', 'side', 'high' );
		
	} // END add_post_meta_box()
	
	/**
	 * The HTML representation of our meta box.
	 */
	function post_meta_box() {
		global $post, $docredux;
		
	} // END post_meta_box()
	
	/**
	 * Save new values entered by the user
	 */
	function save_post_meta_box( $post_id ) {
		global $docredux, $post;
		
		if ( isset( $_POST['docredux_staff-nonce'] ) && !wp_verify_nonce( $_POST['docredux_staff-nonce'], 'docredux_staff-nonce')) {
			return $post_id;  
		}
		
		if ( !wp_is_post_revision( $post_id ) && !wp_is_post_autosave( $post_id ) ) {
			
			// @todo Save whatever you need to save
		
		}		
	} // END save_post_meta_box()
	
} // END class docredux_staff
	
	
} // END if !class_exists( 'docredux_staff' )


?>