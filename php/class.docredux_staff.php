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
				'thumbnail' 
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
		
		add_meta_box( 'docredux_staff', __( 'Staff Member Information', 'docredux_staff' ), array( &$this, 'post_meta_box' ), 'docredux_staff', 'normal', 'high' );
		
	} // END add_post_meta_box()
	
	/**
	 * The HTML representation of our meta box.
	 */
	function post_meta_box() {
		global $post, $docredux;

		$wordpress_user = get_post_meta( $post->ID, '_docredux_staff_wordpress_user', true );		
		$room_number = get_post_meta( $post->ID, '_docredux_staff_room_number', true );
		$title = get_post_meta( $post->ID, '_docredux_staff_title', true );		

		?>

		<div class="inner">
			
			<p><label for="docredux_staff-wordpress_user">WordPress User:</label>
				<select id="docredux_staff-wordpress_user" name="docredux_staff-wordpress_user">
					<option value="0">-- Please select a user --</option>
				<?php
				$all_users = get_users();
				foreach ( $all_users as $single_user ) {
					echo '<option value="' . $single_user->ID . '"';
					if ( $single_user->ID == $wordpress_user ) {
						echo ' selected="selected"';
					}
					echo '>' . $single_user->display_name . '</option>';
				}
				?>
				</select>
			</p>			

			<p><label for="docredux_staff-room_number">Room:</label>
				<input type="text" id="docredux_staff-room_number" name="docredux_staff-room_number" value="<?php echo $room_number; ?>" size="40" />
			</p>
			
			<div class="clear-both"></div>
			
			<p><label for="docredux_staff-title">Title:</label>
				<input type="text" id="docredux_staff-title" name="docredux_staff-title" value="<?php echo $title; ?>" size="40" />
			</p>			

			<input type="hidden" name="docredux_staff-nonce" id="docredux_staff-nonce" value="<?php echo wp_create_nonce('docredux_staff-nonce'); ?>" />

		</div>

		<?php		
		
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
			
			$wordpress_user = (int)$_POST['docredux_staff-wordpress_user'];
			update_post_meta( $post_id, '_docredux_staff_wordpress_user', $wordpress_user );
			
			$room_number = wp_kses( $_POST['docredux_staff-room_number'], false );
			update_post_meta( $post_id, '_docredux_staff_room_number', $room_number );
			
			$title = wp_kses( $_POST['docredux_staff-title'], false );
			update_post_meta( $post_id, '_docredux_staff_title', $title );			
			
		}		
	} // END save_post_meta_box()
	
} // END class docredux_staff
	
	
} // END if !class_exists( 'docredux_staff' )


?>