<?php
/**
 * Courtesy of the WP Sphinx Search plugin: http://wordpress.org/extend/plugins/wp-sphinx-search/
 */

class sphinxsearch {

	private $last_error;
	private $last_warning;
	
	var $search_options = array(
		'server' => '127.0.0.1',
		'port' => '9312',
		'index' => "idx_tech_daniel_dev",
		'timeout' => 15
	);

	/**
	 * Returns the options for sphinx
	 *
	 * @return array
	 */
	private function get_options() {

		return $this->search_options;
	} // END get_options()

	/**
	 * Updates the options with the given options array
	 *
	 * @param array $options
	 */
	private function update_options($options = array()) {
		update_option('sphinx_options', $options);
	}

	/**
	 * Initialization function, registers needed hooks.
	 * Runs on 'init'
	 *
	 */
	public function initialize() {
		add_action( 'parse_query', array($this, 'parse_query'), 10, 1 );
		add_filter( 'found_posts', array($this, 'search_filter_found_posts'), 10, 2 );
		add_filter( 'the_posts', array($this, 'search_filter_posts_order'), 10, 2 );
	}

	/**
	 * Checks query to see if it is a search, and if so, kicks off the
	 * Sphinx search
	 *
	 * @param WP_Query $wp_query
	 */
	public function parse_query(&$wp_query) {
		if($wp_query->is_search) {
			if(class_exists('SphinxClient')) {
				switch($wp_query->get('sort')) {
					case 'date':
						$wp_query->query_vars['orderby'] = 'date';
						$wp_query->query_vars['order'] = 'DESC';
						break;
					case 'title':
						$wp_query->query_vars['orderby'] = 'title';
						$wp_query->query_vars['order'] = 'ASC';
						break;
					default:
						$wp_query->query_vars['sort'] = 'match'; //setting this so sort link will be hilighted
				}
				$results = $this->search_posts($wp_query->query_vars);
				if($results) {
					$matching_ids = array();
					if(intval($results['total']) > 0 ) {
						foreach($results['matches'] as $result) {
							$matching_ids[] = intval($result['attrs']['post_id']);
						}
					} else {
						$matching_ids[] = -1;
					}
					//clear the search query var so posts aren't filtered based on the search
					$wp_query->query_vars['sphinx_search_term'] = $wp_query->query_vars['s'];
					unset($wp_query->query_vars['s']);
					if(isset($wp_query->query_vars['paged'])) {
						//set our own copy of paged so that wordpress doesn't try to page a query already limiting posts
						$wp_query->query_vars['sphinx_paged'] = $wp_query->query_vars['paged'];
						unset($wp_query->query_vars['paged']);
					}
					$wp_query->query_vars['post__in'] = $matching_ids;
					$wp_query->query_vars['sphinx_num_matches'] = intval($results['total']);
				}
			}
		}
	}

	/**
	 * Runs a search against sphinx
	 *
	 * @param array $args
	 * @return array Sphinx result set
	 */
	public function search_posts($args) {
		$options = $this->get_options();
		$defaults = array(
			'search_using' => 'any',
			'sort' => 'match',
			'paged' => 1,
			'posts_per_page' => 0,
			'showposts' => 0
		);
		$args = wp_parse_args($args, $defaults);
		$sphinx = new SphinxClient();
		$sphinx->setServer($options['server'], $options['port']);

		$search = $args['s'];
		switch($args['search_using']) {
			case 'all':
				$sphinx->setMatchMode(SPH_MATCH_ALL);
				break;
			case 'exact':
				$sphinx->setMatchMode(SPH_MATCH_PHRASE);
				break;
			default:
				$sphinx->setMatchMode(SPH_MATCH_ANY);
		}

		switch($args['sort']) {
			case 'date':
				$sphinx->setSortMode(SPH_SORT_ATTR_DESC, 'date_added');
				break;
			case 'title':
				$sphinx->setSortMode(SPH_SORT_ATTR_ASC, 'title');
				break;
			default:
				$sphinx->setSortMode(SPH_SORT_RELEVANCE);
		}

		$page = isset($args['paged']) && (intval($args['paged']) > 0) ? intval($args['paged']) : 1;
		$per_page = max(array($args['posts_per_page'], $args['showposts']));
		if($per_page < 1) {
			$per_page = get_option('posts_per_page');
		}

		$sphinx->setLimits(($page - 1) * $per_page, $per_page);
		$sphinx->setMaxQueryTime(intval($options['timeout']));
		$result = $sphinx->query($search, $options['index']);
		$this->last_error = $sphinx->getLastError();
		$this->last_warning = $sphinx->getLastWarning();
		return $result;
	}

	/**
	 * Filters the found posts to reflect the number and order returned by sphinx
	 *
	 * @param int $found_posts
	 * @param WP_Query $wp_query
	 */
	public function search_filter_found_posts($found_posts, &$wp_query = null) {
		if(!is_null($wp_query)) {
			if(isset($wp_query->query_vars['sphinx_num_matches'])) {
				$found_posts = intval($wp_query->query_vars['sphinx_num_matches']);
			}
			if(isset($wp_query->query_vars['sphinx_search_term'])) {
				$wp_query->query_vars['s'] = $wp_query->query_vars['sphinx_search_term'];
			}
			if(isset($wp_query->query_vars['sphinx_paged'])) {
				$wp_query->query_vars['paged'] = $wp_query->query_vars['sphinx_paged'];
			}
		}

		return $found_posts;
	}

	public function search_filter_posts_order($posts, $wp_query = null) {
		if( !is_null($wp_query) && isset($wp_query->query_vars['post__in']) && isset($wp_query->query_vars['sphinx_num_matches']) ) {
			$sphinx_id_order = $wp_query->query_vars['post__in'];
			$reordered_posts = array();
			foreach ($sphinx_id_order as $sphinx_post_id) {
				foreach ($posts as $post) {
					if ($post->ID == $sphinx_post_id) {
						$reordered_posts[] = $post;
						break;
					}
				}
			}
			return $reordered_posts;
		}
		return $posts;
	}

} // END class sphinxsearch