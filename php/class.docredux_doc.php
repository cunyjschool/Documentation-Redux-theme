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
		
		add_filter( 'manage_users_columns', array( &$this, 'manage_user_columns' ) );
		add_filter( 'manage_users_custom_column', array( &$this, 'handle_docredux_docs_num_column'), 10, 3 );
		
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
				'author',
				'thumbnail'
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
	
	/**
	 * Add a column to the manage users view for all of the documentation created by the user
	 */
	function manage_user_columns( $user_columns ) {
		$user_columns[ __( '_docredux_docs_num' ) ] = __( 'Documentation' );
		return $user_columns;
	}
	
	/**
	 * Show number of documentation for each user
	 */
	function handle_docredux_docs_num_column( $default, $column_name, $user_id ) {
		if ( $column_name == __( '_docredux_docs_num' ) ) {
			$args = array(
				'posts_per_page' => '-1',
				'post_type' => array(
					'docredux_doc',
				),
				'author' => $user_id,
			);
			$total = new WP_Query( $args );
			if ( $total->post_count > 0 )
				return '<a href="' . get_admin_url( null, 'edit.php?post_type=docredux_doc&author=' . $user_id ) . '">' . $total->post_count . '</a>';
			else
				return $total->post_count;
		}
		return $default;
	}
	
} // END class docredux_doc
	
	
} // END if !class_exists( 'docredux_doc' )


?>