<?php

define( 'DOCREDUX_VERSION', '0.4a' );

include_once( 'php/class.docredux_doc.php' );
include_once( 'php/class.docredux_staff.php' );
include_once( 'php/sphinxapi.php' );
include_once( 'php/class.sphinxsearch.php' );

if ( !class_exists( 'docredux' ) ) {

class docredux {
	
	var $theme_taxonomies = array();
	var $options_group = 'docredux_';
	var $options_group_name = 'docredux_options';
	var $settings_page = 'docredux_settings';	
	
	/**
	 * __construct()
	 */
	function __construct() {
		
		$this->documentation = new docredux_doc();
		$this->staff = new docredux_staff();
		$this->sphinxsearch = new sphinxsearch();
		
		$this->options = get_option( $this->options_group_name );		
		
		// Add support for post formats
		add_action( 'after_setup_theme', array( &$this, 'add_post_formats' ) );
		add_action( 'after_setup_theme', array( &$this, 'init' ) );

		add_action( 'init', array( &$this, 'create_taxonomies' ) );
		add_action( 'init', array( &$this, 'enqueue_resources' ) );
		add_action( 'init', array( &$this, 'register_menus' ) );
		
		if ( isset( $this->options['sphinx_enabled'] ) && $this->options['sphinx_enabled'] == 'on' ) {
			add_action( 'init', array( &$this->sphinxsearch, 'initialize' ) );
		}
		
		add_action( 'admin_init', array( &$this, 'admin_init' ) );
		
		// Add the current options to our object
		
	} // END __construct()
	
	/**
	 * init()
	 */
	function init() {
		
		$args = array(
    		'name' => 'Home Left Column',
    		'id'   => 'home-left-column',
    		'description'   => 'This is a widgetized area.',
    		'before_widget' => '<div id="%1$s" class="widget %2$s">',
    		'after_widget'  => '</div>',
    		'before_title'  => '<h4>',
    		'after_title'   => '</h4>'
        );
        register_sidebar( $args );

        $args = array(
    		'name' => 'Home Right Column',
    		'id'   => 'home-right-column',
    		'description'   => 'This is a widgetized area.',
    		'before_widget' => '<div id="%1$s" class="widget %2$s">',
    		'after_widget'  => '</div>',
    		'before_title'  => '<h4>',
    		'after_title'   => '</h4>'
        );
        register_sidebar( $args );
	    
		add_theme_support( 'post-thumbnails' );
		
		add_post_type_support( 'page', 'excerpt' );
		
		if ( is_admin() ) {
			add_action( 'admin_menu', array(&$this, 'add_admin_menu_items') );
			add_action( 'right_now_content_table_end', 'add_counts_to_dashboard' );
		}
		
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
	 * admin_init()
	 */
	function admin_init() {

		$this->register_settings();

	} // END admin_init()
	
	/**
	 * add_admin_menu_items()
	 * Any admin menu items we need
	 */
	function add_admin_menu_items() {

		add_submenu_page( 'themes.php', 'Documentation Redux Theme Options', 'Theme Options', 'manage_options', 'docredux_options', array( &$this, 'options_page' ) );			

	} // END add_admin_menu_items()	
	
	/**
	 * enqueue_resources()
	 * Enqueue any resources we need
	 */
	function enqueue_resources() {
		
		if ( !is_admin() ) {
			wp_enqueue_style( 'docredux_primary_css', get_bloginfo('template_directory') . '/style.css', false, DOCREDUX_VERSION );
		} else {
			wp_enqueue_style( 'docredux_staff_admin_css', get_bloginfo('template_directory') . '/css/staff_admin.css', false, DOCREDUX_VERSION );
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
				'slug' => 'contexts',
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
	
	/**
	 * register_settings()
	 */
	function register_settings() {

		register_setting( $this->options_group, $this->options_group_name, array( &$this, 'settings_validate' ) );

		// Global options
		add_settings_section( 'docredux_home', 'Home', array(&$this, 'settings_home_section'), $this->settings_page );
		add_settings_field( 'home_description', 'Description above the search box', array(&$this, 'settings_home_description_option'), $this->settings_page, 'docredux_home' );
		
		// Sphinx options
		add_settings_section( 'docredux_sphinx', 'Sphinx', array(&$this, 'settings_sphinx_section'), $this->settings_page );
		add_settings_field( 'sphinx_enabled', 'Enable Sphinx?', array(&$this, 'settings_sphinx_enabled_option'), $this->settings_page, 'docredux_sphinx' );	
		add_settings_field( 'sphinx_index', 'Sphinx index to use', array(&$this, 'settings_sphinx_index_option'), $this->settings_page, 'docredux_sphinx' );			

	} // END register_settings()
	
	/**
	 * settings_home_description_option()
	 * Option to configure the text that appears on the homepage
	 */
	function settings_home_description_option() {
		
		$options = $this->options;
		$allowed_tags = htmlentities( '<b><strong><em><i><span><a><br>' );

		echo '<textarea id="home_description" name="' . $this->options_group_name . '[home_description]" cols="80" rows="6">';
		if ( isset( $options['home_description'] ) && $options['home_description'] ) {
			echo $options['home_description'];
		}
		echo '</textarea>';
		echo '<p class="description">The following tags are permitted: ' . $allowed_tags . '</p>';
		
	} // END settings_home_description_option()	
	
	/**
	 * settings_sphinx_enabled_option()
	 * Whether or not Sphinx is used as the search engine
	 */
	function settings_sphinx_enabled_option() {

		$options = $this->options;

		echo '<select id="sphinx_enabled" name="' . $this->options_group_name . '[sphinx_enabled]">';
		echo '<option value="off"';
		if ( isset( $options['sphinx_enabled'] ) && $options['sphinx_enabled'] == 'off' ) {
			echo ' selected="selected"';
		}		
		echo '>Disabled</option>';
		echo '<option value="on"';
		if ( isset( $options['sphinx_enabled'] ) && $options['sphinx_enabled'] == 'on' ) {
			echo ' selected="selected"';
		}		
		echo '>Enabled</option>';
		echo '</select>';

	} // END settings_sphinx_enabled_option()
	
	/**
	 * settings_sphinx_index_option()
	 * Sphinx index to use
	 */
	function settings_sphinx_index_option() {
		
		$options = $this->options;

		echo '<input id="sphinx_index" name="' . $this->options_group_name . '[sphinx_index]"';
		if ( isset( $options['sphinx_index'] ) ) {
			echo ' value="' . $options['sphinx_index'] . '"';
		}		
		echo ' size="80" />';
		echo '<p class="description">(optional) Defaults to "*"</p>';
		
	} // END settings_sphinx_index_option()
	
	/**
	 * settings_validate()
	 * Validation and sanitization on the settings field
	 */
	function settings_validate( $input ) {
		
		$allowed_tags = htmlentities( '<b><strong><em><i><span><a><br>' );

		$input['home_description'] = strip_tags( $input['home_description'], $allowed_tags );
		
		if ( $input['sphinx_enabled'] != 'on' ) {
			$input['sphinx_enabled'] != 'off';
		}		
			
		$input['sphinx_index'] = wp_kses( $input['sphinx_index'] );

		return $input;

	} // END settings_validate()
	
	/**
	 * Options page for the theme
	 */
	function options_page() {
		?>                                   
		<div class="wrap">
			<div class="icon32" id="icon-options-general"><br/></div>

			<h2><?php _e('Documentation Redux Options', 'docredux-theme') ?></h2>

			<form action="options.php" method="post">

				<?php settings_fields( $this->options_group ); ?>
				<?php do_settings_sections( $this->settings_page ); ?>

				<p class="submit"><input name="submit" type="submit" class="button-primary" value="<?php esc_attr_e('Save Changes'); ?>" /></p>

			</form>
		</div>
		<?php
	} // END options_page()
	
	function add_counts_to_dashboard() {
    		// Custom post types counts
    		$post_types = get_post_types( array( '_builtin' => false ), 'objects' );
    		foreach ( $post_types as $post_type ) {
        		$num_posts = wp_count_posts( $post_type->name );
			$num = number_format_i18n( $num_posts->publish );
			$text = _n( $post_type->labels->singular_name, $post_type->labels->name, $num_posts->publish );
			if ( current_user_can( 'edit_posts' ) ) {
				$num = '<a href="edit.php?post_type=' . $post_type->name . '">' . $num . '</a>';
				$text = '<a href="edit.php?post_type=' . $post_type->name . '">' . $text . '</a>';
			}
			echo '<td class="first b b-' . $post_type->name . 's">' . $num . '</td>';
			echo '<td class="t ' . $post_type->name . 's">' . $text . '</td>';
			echo '</tr>';

			if ( $num_posts->pending > 0 ) {
				$num = number_format_i18n( $num_posts->pending );
				$text = _n( $post_type->labels->singular_name . ' pending', $post_type->labels->name . ' pending', $num_posts->pending );
				if ( current_user_can( 'edit_posts' ) ) {
					$num = '<a href="edit.php?post_status=pending&post_type=' . $post_type->name . '">' . $num . '</a>';
				$text = '<a href="edit.php?post_status=pending&post_type=' . $post_type->name . '">' . $text . '</a>';
				}
				echo '<td class="first b b-' . $post_type->name . 's">' . $num . '</td>';
				echo '<td class="t ' . $post_type->name . 's">' . $text . '</td>';
				echo '</tr>';
			}
		}
    
		// Custom taxonomies counts
		$taxonomies = get_taxonomies( array( '_builtin' => false ), 'objects' );
		foreach ( $taxonomies as $taxonomy ) {
			$num_terms  = wp_count_terms( $taxonomy->name );
			$num = number_format_i18n( $num_terms );
			$text = _n( $taxonomy->labels->singular_name, $taxonomy->labels->name, $num_terms );
			$associated_post_type = $taxonomy->object_type;
			if ( current_user_can( 'manage_categories' ) ) {
				$num = '<a href="edit-tags.php?taxonomy=' . $taxonomy->name . '&post_type=' . $associated_post_type[0] . '">' . $num . '</a>';
				$text = '<a href="edit-tags.php?taxonomy=' . $taxonomy->name . '&post_type=' . $associated_post_type[0] . '">' . $text . '</a>';
			}
			echo '<td class="first b b-' . $taxonomy->name . 's">' . $num . '</td>';
			echo '<td class="t ' . $taxonomy->name . 's">' . $text . '</td>';
			echo '</tr><tr>';
		}
	}

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
 * docredux_home_description()
 * Print the home description
 */
function docredux_home_description() {
	global $docredux;
	
	if ( !empty( $docredux->options['home_description'] ) ) {
		echo $docredux->options['home_description'];		
	} else {
		echo "Please add a home description in theme options.";
	}
	
} // END docredux_home_description()

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

/**
 * docredux_pagination()
 * Standardized pagination we can use anywhere in the loop
 */
function docredux_pagination( $pages = '', $range = 2 ) {
	global $wp_query, $paged;	
	
	$showitems = ( $range * 2 ) + 1;  

	if ( empty( $paged ) ) $paged = 1;

	if ( '' == $pages ) {
		$pages = $wp_query->max_num_pages;
		if ( !$pages ) {
			$pages = 1;
		}
	}	 

	if ( 1 != $pages ) {
		echo "<div class='pagination paper'><span class='right'>Total results: " . $wp_query->found_posts;
		echo "</span>Pages:";
		if ( $paged > 2 && $paged > $range+1 && $showitems < $pages )
			echo "<a href='" . get_pagenum_link(1) . "'>&laquo;</a>";
		if ( $paged > 1 && $showitems < $pages )
			echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

		for ( $i=1; $i <= $pages; $i++ ) {
			if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) {
				 echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
			}
		}

		if ( $paged < $pages && $showitems < $pages )
			echo "<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";  
		if ( $paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages )
			echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
		echo "</div>\n";
	 }
} // END docredux_pagination()

// Add custom taxonomies and custom post types counts to dashboard
add_action( 'right_now_content_table_end', 'my_add_counts_to_dashboard' );
function my_add_counts_to_dashboard() {
    // Custom post types counts
    $post_types = get_post_types( array( '_builtin' => false ), 'objects' );
    foreach ( $post_types as $post_type ) {
        $num_posts = wp_count_posts( $post_type->name );
        $num = number_format_i18n( $num_posts->publish );
        $text = _n( $post_type->labels->singular_name, $post_type->labels->name, $num_posts->publish );
        if ( current_user_can( 'edit_posts' ) ) {
            $num = '<a href="edit.php?post_type=' . $post_type->name . '">' . $num . '</a>';
            $text = '<a href="edit.php?post_type=' . $post_type->name . '">' . $text . '</a>';
        }
        echo '<td class="first b b-' . $post_type->name . 's">' . $num . '</td>';
        echo '<td class="t ' . $post_type->name . 's">' . $text . '</td>';
        echo '</tr>';

        if ( $num_posts->pending > 0 ) {
            $num = number_format_i18n( $num_posts->pending );
            $text = _n( $post_type->labels->singular_name . ' pending', $post_type->labels->name . ' pending', $num_posts->pending );
            if ( current_user_can( 'edit_posts' ) ) {
                $num = '<a href="edit.php?post_status=pending&post_type=' . $post_type->name . '">' . $num . '</a>';
                $text = '<a href="edit.php?post_status=pending&post_type=' . $post_type->name . '">' . $text . '</a>';
            }
            echo '<td class="first b b-' . $post_type->name . 's">' . $num . '</td>';
            echo '<td class="t ' . $post_type->name . 's">' . $text . '</td>';
            echo '</tr>';
        }
    }
    
    // Custom taxonomies counts
    $taxonomies = get_taxonomies( array( '_builtin' => false ), 'objects' );
    foreach ( $taxonomies as $taxonomy ) {
        $num_terms  = wp_count_terms( $taxonomy->name );
        $num = number_format_i18n( $num_terms );
        $text = _n( $taxonomy->labels->singular_name, $taxonomy->labels->name, $num_terms );
        $associated_post_type = $taxonomy->object_type;
        if ( current_user_can( 'manage_categories' ) ) {
            $num = '<a href="edit-tags.php?taxonomy=' . $taxonomy->name . '&post_type=' . $associated_post_type[0] . '">' . $num . '</a>';
            $text = '<a href="edit-tags.php?taxonomy=' . $taxonomy->name . '&post_type=' . $associated_post_type[0] . '">' . $text . '</a>';
        }
        echo '<td class="first b b-' . $taxonomy->name . 's">' . $num . '</td>';
        echo '<td class="t ' . $taxonomy->name . 's">' . $text . '</td>';
        echo '</tr><tr>';
    }
}
