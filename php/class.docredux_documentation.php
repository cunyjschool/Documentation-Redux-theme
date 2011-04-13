<?php
/**
 * Documentation custom post type
 * @author danielbachhuber
 * @since 0.1
 */

if ( !class_exists( 'docredux_documentation' ) ) {
	
class docredux_documentation
{
	
	/**
	 * __construct()
	 */
	function __construct() {
		
		// Add Database post type
		add_action( 'init', array(&$this, 'create_post_type') );
		
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
		
		register_post_type( 'docredux_documentation',
		    array(
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
				'menu_position' => 11,
				'public' => true,
				'has_archive' => true,
				'rewrite' => array(
					'slug' => 'documentation'
				),
				'supports' => array(
					'title',
					'editor',
					'excerpt',
				),
				'taxonomies' => array(
					
				)
		    )
		  );
		
	} // END - create_post_type()
	
	/**
	 * add_post_meta_box()
	 */
	function add_post_meta_box() {
		
		add_meta_box( 'docredux_documentation', __( 'Metadata', 'docredux_documentation' ), array( &$this, 'post_meta_box' ), 'docredux_documentation', 'side', 'high' );
		
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
		
		if ( !wp_verify_nonce( $_POST['docredux_documentation-nonce'], 'docredux_documentation-nonce')) {
			return $post_id;  
		}
		
		if ( !wp_is_post_revision( $post_id ) && !wp_is_post_autosave( $post_id ) ) {
			
			// @todo Save whatever you need to save
		
		}		
	} // END save_post_meta_box()
	
} // END class docredux_documentation
	
	
} // END if !class_exists( 'docredux_documentation' )


?>